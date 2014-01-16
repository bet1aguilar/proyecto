<?php
App::uses('AppController', 'Controller');
/**
 * Cheques Controller
 *
 * @property Cheque $Cheque
 * @property PaginatorComponent $Paginator
 */
class ChequesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Cheque->recursive = 3;
                //debug($this->Paginator->paginate());
                  if($this->data){  
                    if ($this->data['Cheque']['search_text']) { 
                        $this->set('cheques',  
                        $this->paginate('Cheque', array('or' => array('Cheque.numerodecheque LIKE' => '%' .  
                        $this->data['Cheque']['search_text'] . '%')))); 
                    } 
                    else { 
                        $this->set('cheques', $this->Paginator->paginate());
                    } 
                  }else{
                      
                     $this->set('cheques', $this->Paginator->paginate()); 
                  }
          } 
		
	

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 * 
 */
	public function view($id = null) {
		if (!$this->Cheque->exists($id)) {
			throw new NotFoundException(__('Invalid cheque'));
		}
		$options = array('conditions' => array('Cheque.' . $this->Cheque->primaryKey => $id));
		$this->set('cheque', $this->Cheque->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id=null) {
		if ($this->request->is('post')) {
			$this->Cheque->create();
                        #debug($this->request->data);
			if ($this->Cheque->save($this->request->data)) {
                                $cheque_ids=  $this->Cheque->getLastInsertID();
                                $this->request->data['Chequeinterese']['user_id'] = $this->Auth->user('id');
                                $this->request->data['Chequeinterese']['cheque_id'] = $cheque_ids;
                                $this->request->data['Chequeinterese']['montocheque'] = $this->request->data['Cheque']['monto'];
                                $sql="select dias from cheques where id=".$cheque_ids;
                                $y=  $this->Cheque->query($sql);
                                $sql="SELECT PORCENTAJE, MONTOFIJO
                                        FROM INTERESES I, CHEQUES C
                                        WHERE INTERESE_ID = I.ID
                                        AND C.ID=".$cheque_ids."";
                                $x=$this->Cheque->query($sql);
                                /*debug($y);
                                
                                debug($dias);
                                debug($x);**/
                                if($x[0]['I']['PORCENTAJE']==null){
                                    $this->request->data['Chequeinterese']['montodescuentointeres'] = $x[0]['I']['MONTOFIJO']*$y[0]['dias'];
                                    $this->request->data['Chequeinterese']['montoentregado']=$this->request->data['Cheque']['monto']-($x[0]['I']['MONTOFIJO']*$y[0]['dias']);
                                }
                                else{
                                    $p=(round(($x[0]['I']['PORCENTAJE']/100)*$this->request->data['Cheque']['monto']))*$y[0]['dias'];
                                    
                                    if($p%2!=0)
                                      $p++;
                                        
                                    $this->request->data['Chequeinterese']['montodescuentointeres'] = $p;
                                    $this->request->data['Chequeinterese']['montoentregado']=$this->request->data['Cheque']['monto']-$p;
                                }
                                $ss="INSERT INTO 
                                    capital ( created, 
                                             modified, montocheque, 
                                             montointeres, montoentregado,
                                             estadocheque,
                                             pago, pagotercero, 
                                             total, motivo, provienede, 
                                             codigo, chequecodigo, 
                                             user_id)
                                             
                                             VALUES(now(),
                                                   now(),
                                                   ".$this->request->data['Chequeinterese']['montocheque'].",
                                                   ".$this->request->data['Chequeinterese']['montodescuentointeres'].",
                                                   ".$this->request->data['Chequeinterese']['montoentregado'].",
                                                   ".$y[0]['cheques']['cobrado'].",
                                                   null,
                                                   null,
                                                   ".$this->request->data['Chequeinterese']['montodescuentointeres'].",
                                                   null,
                                                   'Cheque',
                                                   null,
                                                   ".$cheque_ids.",
                                                   ".$this->Auth->user('id').") ";
                                debug($ss);
                                $revision=  $this->Cheque->query($ss);
                                if($revision==null)
                                    $this->Session->setFlash(__('No fué guardado en el capital.'));
                                else
                                    $this->Session->setFlash(__('El cheque guardado. en capital'));    
                                $this->Cheque->Chequeinterese->save($this->request->data);
                                $this->Session->setFlash(__('El cheque ha sido guardado.'));    
				return $this->redirect(array('controller'=>'chequeestadocheques','action' => 'add',$cheque_ids));
			} else {
				$this->Session->setFlash(__('The cheque could not be saved. Please, try again.'));
			}
		}
		$bancos = $this->Cheque->Banco->find('list');
                if($id==null)
		$clientes = $this->Cheque->Cliente->find('list',array('fields'=>array('id','nombres')));
                else
                {
                    $conditions=array('Cliente.id'=>$id);
         	    $clientes = $this->Cheque->Cliente->find('list',array('fields'=>array('id','nombres'),
                                                                                    'conditions'=>$conditions));
                }
		$interese = $this->Cheque->Interese->find('list',array('fields'=>array('id','rango')));
		$users = $this->Cheque->User->find('list');
                $x=$this->Cheque->query("select id, username from users where id=".$this->Auth->user('id')."");
                
                $users=array($x[0]['users']['id']=>$x[0]['users']['username']);
		$this->set(compact('bancos', 'clientes', 'interese', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Cheque->exists($id)) {
			throw new NotFoundException(__('Invalid cheque'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cheque->save($this->request->data)) {
				$options = array('conditions' => array('Cheque.' . $this->Cheque->primaryKey => $id));
                                $this->request->data = $this->Cheque->find('first', $options);
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cheque could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cheque.' . $this->Cheque->primaryKey => $id));
			$this->request->data = $this->Cheque->find('first', $options);
		}
		$bancos = $this->Cheque->Banco->find('list');
		$clientes = $this->Cheque->Cliente->find('list');
		$interese = $this->Cheque->Interese->find('list');
		$users = $this->Cheque->User->find('list');
                $x=$this->Cheque->query("select id, username from users where id=".$this->Auth->user('id')."");
                
                $users=array($x[0]['users']['id']=>$x[0]['users']['username']);
		$this->set(compact('bancos', 'clientes', 'interese', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function editadevuelto($id=null){
            $id=  $this->params['pass'][0];
            $tipo=  $this->params['pass'][1];
            
            $options = array('conditions' => array('Cheque.' . $this->Cheque->primaryKey => $id));
            $this->request->data = $this->Cheque->find('first', $options);
            $this->request->data['Cheque']['cobrado'] = $tipo;
            $this->Cheque->save($this->request->data);
            if($tipo==0)
                $this->Session->setFlash(__('The estado de uno de los cheques ha pasado al estado "Devuelto".'));
            else
                $this->Session->setFlash(__('The estado de uno de los cheques ha pasado al estado "Cobrado". '));
            return $this->redirect(array('action' => 'index'));
        }


        public function delete($id = null) {
		$this->Cheque->id = $id;
		if (!$this->Cheque->exists()) {
			throw new NotFoundException(__('Invalid cheque'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Cheque->delete()) {
			$this->Session->setFlash(__('The cheque has been deleted.'));
		} else {
			$this->Session->setFlash(__('The cheque could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
