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
		$this->Cheque->recursive = 2;
                $sumas=  $this->Cheque->query("SELECT cobrado, 
                                            SUM( monto ) as sumato 
                                            FROM cheques
                                            WHERE cobrado =1
                                            OR cobrado =0
                                            GROUP BY cobrado
                                            ORDER BY COBRADO");

              //debug($sumas);
               //jose y bet son novios ahora yo jose
                if($this->data){  
                    
                    if($this->data['Cheque']['selector']=="1"){
                        $valor = $this->data['search_text1'];
                       $yabusco=1;
                       $this->request->data['search_text1']='';
                         $this->set('cheques',  

                        $this->paginate('Cheque', array('or' => 
                            array('Cheque.numerodecheque LIKE' => '%'.$valor.'%',
                            'Cheque.numerodecuenta LIKE' => '%'.$valor.'%',
                            'Cheque1.numerodecheque LIKE' => '%'.$valor.'%',
                            'Cliente.cedula LIKE'=> '%'.$valor.'%',
                            'Banco.codigo LIKE'=>'%'.$valor.'%',
                           'Cliente.nombre LIKE'=>'%'.$valor.'%',
                            'Cliente.apellido LIKE'=>'%'.$valor.'%',
                           'Cliente.apodo LIKE'=>'%'.$valor.'%'
                            ),'and'=>array('or'=>array(array('Cheque.cobrado'=>'1'),
                                    array('Cheque.cobrado'=>'0')))))); 
                         $this->set(compact('yabusco'));
                    }
                else{
                    
                    $yabusco=0;
                    if(!$this->data['Cheque']['search_text']==''){
                        
                        $fecha = new DateTime($this->data['Cheque']['search_text']);
                        $fecha = $fecha->format('Y-m-d');
                        $this->request->data['Cheque']['search_text']='';
                        $this->set('cheques',$this->paginate('Cheque', array('or' => 
                            array('DATE_FORMAT(Cheque.fechacobro,"%Y-%m-%d") LIKE' => '%'.$fecha.'%'
                            ),'and'=>array('or'=>array(array('Cheque.cobrado'=>'1'),
                                    array('Cheque.cobrado'=>'0')))))); 
                        $this->set(compact('yabusco'));
                    }
                    else{
                         $this->set('cheques', $this->paginate('Cheque',
                                array('or'=>array(array('Cheque.cobrado'=>'1'),
                                    array('Cheque.cobrado'=>'0')))));
                     $this->set(compact('sumas','yabusco'));
                    }
                }
                 
                  }else{
                      $yabusco=2;
                    $this->set('cheques', $this->paginate('Cheque',
                                array('or'=>array(array('Cheque.cobrado'=>'1'),
                                    array('Cheque.cobrado'=>'0')))));
                     $this->set(compact('sumas','yabusco'));
                  }
	 	
               
	}
        public function index2() {
                $this->Cheque->recursive = 2;
                $sumas=  $this->Cheque->query("SELECT estadocheque, SUM( montocheque ) as sumato, sum(Montodescuentointeres) as interes
                                            FROM chequeinterese
                                            WHERE estadocheque =2
                                            GROUP BY estadocheque");
                
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
		$this->set('cheques', $this->Paginator->paginate());
                $this->set(compact('sumas'));
        }
        public function devueltos() {
                $this->Cheque->recursive = 2;
                $sumas=  $this->Cheque->query("SELECT cobrado, SUM( monto ) as sumato
                                            FROM cheques
                                            WHERE cobrado =0
                                            GROUP BY cobrado");
                
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
		$this->set('cheques', $this->Paginator->paginate());
                $this->set(compact('sumas'));
        }
        public function postdatados() {
                $this->Cheque->recursive = 2;
                $sumas=  $this->Cheque->query("SELECT cobrado, SUM( monto ) as sumato
                                            FROM cheques
                                            WHERE cobrado =1
                                            GROUP BY cobrado");
                
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
		$this->set('cheques', $this->Paginator->paginate());
                $this->set(compact('sumas'));
        }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
            $this->recursive = 2;
		if (!$this->Cheque->exists($id)) {
			throw new NotFoundException(__('Invalid cheque'));
		}
		$options = array('conditions' => array('Cheque.' . $this->Cheque->primaryKey => $id));
                $cheque=$this->Cheque->find('first', $options);
                $opciones2= array('conditions' => array('Cheque.cheque_id' => $id));
                $relacionados = $this->Cheque->find('first',$opciones2);
                #debug($relacionados);
		$this->set(compact('cheque','relacionados'));
	}

/**
 * add method
 *
 * @return void
 */     
        private function chequeinteresesinsert(){
            $cheque_ids=  $this->Cheque->getLastInsertID();
            $this->request->data['Chequeinterese']['user_id'] = $this->Auth->user('id');
            $this->request->data['Chequeinterese']['cheque_id'] = $cheque_ids;
            $this->request->data['Chequeinterese']['montocheque'] = $this->request->data['Cheque']['monto'];    
            $this->request->data['Chequeinterese']['estadocheque'] = $this->request->data['Cheque']['cobrado'];
            $sql="select dias, cobrado from cheques where id=".$cheque_ids;
            $y=  $this->Cheque->query($sql);
            //debug($y);
            $sql="SELECT PORCENTAJE, MONTOFIJO
                    FROM INTERESES I, CHEQUES C
                    WHERE INTERESE_ID = I.ID
                    AND C.ID=".$cheque_ids."";
            $x=$this->Cheque->query($sql);
            if($x[0]['I']['PORCENTAJE']==null){
                $this->request->data['Chequeinterese']['montodescuentointeres'] = $x[0]['I']['MONTOFIJO']*$y[0]['cheques']['dias'];
                $this->request->data['Chequeinterese']['montoentregado']=$this->request->data['Cheque']['monto']-($x[0]['I']['MONTOFIJO']*$y[0]['cheques']['dias']);
            }
            else{
                $p=(round(($x[0]['I']['PORCENTAJE']/100)*$this->request->data['Cheque']['monto']))*$y[0]['cheques']['dias'];    
                if($p%2!=0)
                  $p++;
                $this->request->data['Chequeinterese']['montodescuentointeres'] = $p;
                $this->request->data['Chequeinterese']['montoentregado']=$this->request->data['Cheque']['monto']-$p;
            }
            $this->Cheque->Chequeinterese->save($this->request->data);
            #debug($this->request->data['Chequeinterese']['montodescuentointeres']);
            $ss="INSERT INTO 
                capital ( created, 
                         modified, 
                         montocheque, 
                         montointeres, 
                         montoentregado,
                         estadocheque,
                         pago, 
                         pagotercero, 
                         total, 
                         motivo, 
                         provienede, 
                         codigo, 
                         cheque_id, 
                         user_id)

                         VALUES(now(),
                               now(),
                               ".$this->request->data['Chequeinterese']['montocheque'].",
                               ".$this->request->data['Chequeinterese']['montodescuentointeres'].",
                               ".$this->request->data['Chequeinterese']['montoentregado'].",
                               ".$this->request->data['Chequeinterese']['estadocheque'].",
                               null,
                               null,
                               ".$this->request->data['Chequeinterese']['montodescuentointeres'].",
                               null,
                               'Cheque',
                               null,
                               ".$cheque_ids.",
                               ".$this->Auth->user('id').") ";
            $revision=  $this->Cheque->query($ss);
        }
        public function add2($id=null) {
		if ($this->request->is('post')) {
			$this->Cheque->create();
                        
                        $dias=$this->diferencia($this->request->data['Cheque']['fecharecibido'],$this->request->data['Cheque']['fechacobro']);
                        $this->request->data['Cheque']['dias']=$dias;
                        
                        #debug($dias);
                        
                        #debug($this->request->data['Cheque']['dias']);
                        
                      #  debug($this->data);
                        $fecha1= new DateTime($this->data['Cheque']['fecharecibido']);
                        $fecha2 = new DateTime($this->data['Cheque']['fechacobro']);
                        $this->request->data['Cheque']['fecharecibido']=$fecha1->format('Y-m-d');
                        $this->request->data['Cheque']['fechacobro']=$fecha2->format('Y-m-d');
                       
                     	if ($this->Cheque->save($this->request->data)) {
                                $this->chequeinteresesinsert();
                                $cheque_ids=  $this->Cheque->getLastInsertID();
                                $this->Session->setFlash(__('El cheque ha sido guardado.'));
				return $this->redirect(array('action' => 'view',$this->request->data['Cheque']['cheque_id']));
			} else {
				$this->Session->setFlash(__('El cheque no ha sido guardado'));
			}
		}
		$bancos = $this->Cheque->Banco->find('list');
                $muestra=0;
		
                    $clientes = $this->Cheque->Cliente->find('list',array('fields'=>array('id','nombres')));
                    
               
                $id_cheque = $this->Cheque->find('list',array('fields'=>array('id','numerodecheque'),'conditions'=>array(
                    'Cheque.id'=>$id)));
		$interese = $this->Cheque->Interese->find('list',array('fields'=>array('id','rango')));
		$users = $this->Cheque->User->find('list');
                $x=$this->Cheque->query("select id, username from users where id=".$this->Auth->user('id')."");
                $users=array($x[0]['users']['id']=>$x[0]['users']['username']);
		$this->set(compact('bancos', 'clientes', 'interese', 'users','id_cheque','id'));
	}
        public function add($id=null) {
		if ($this->request->is('post')) {
			$this->Cheque->create();
                        
                        $dias=$this->diferencia($this->request->data['Cheque']['fecharecibido'],$this->request->data['Cheque']['fechacobro']);
                        $this->request->data['Cheque']['dias']=$dias;
                        
                        #debug($dias);
                        
                        #debug($this->request->data['Cheque']['dias']);
                        
                        $fecha1= new DateTime($this->data['Cheque']['fecharecibido']);
                        $fecha2 = new DateTime($this->data['Cheque']['fechacobro']);
                        $this->request->data['Cheque']['fecharecibido']=$fecha1->format('Y-m-d');
                        $this->request->data['Cheque']['fechacobro']=$fecha2->format('Y-m-d');
                      	if ($this->Cheque->save($this->request->data)) {
                                $this->chequeinteresesinsert();
                                $cheque_ids=  $this->Cheque->getLastInsertID();
                                $this->Session->setFlash(__('El cheque ha sido guardado.'));
				return $this->redirect(array('controller'=>'chequeestadocheques','action' => 'add',$cheque_ids));
			} else {
				$this->Session->setFlash(__('El cheque no ha sido guardado'));
			}
		}
		$bancos = $this->Cheque->Banco->find('list');
                $muestra=0;
		if($id==null){
                    $clientes = $this->Cheque->Cliente->find('list',array('fields'=>array('id','nombres')));
                    
                }
                else
                {
                    $muestra=1;
                    $conditions=array('Cliente.id'=>$id);
         	    $clientes = $this->Cheque->Cliente->find('list',array('fields'=>array('id','nombres'),
                                                                                   'conditions'=>$conditions));
                    debug($clientes);
                   
                }
		$interese = $this->Cheque->Interese->find('list',array('fields'=>array('id','rango')));
		$users = $this->Cheque->User->find('list');
                $x=$this->Cheque->query("select id, username from users where id=".$this->Auth->user('id')."");
                $users=array($x[0]['users']['id']=>$x[0]['users']['username']);
		$this->set(compact('bancos', 'clientes', 'interese', 'users'));
	}
        
        private function diferencia($fecha1,$fecha2){
                
                $fecha1=new DateTime($fecha1);
                $fecha2=new DateTime($fecha2);
                $fecha1=$fecha1->format('Y-m-d');
                $fecha2=$fecha2->format('Y-m-d');
                /*debug($fecha1);
                debug($fecha2);*/
                #$y=new DateTime($fecha1);
                #$y=$y->format('Y-m-d');
                $date1 = $fecha1;
                $date2 = $fecha2;
                $diff = abs(strtotime($date2) - strtotime($date1));
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $dias = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                $dias++;
                return $dias;
         }
         public function editadevuelto($id=null){
            
             $id=  $this->params['pass'][0];
            $tipo=  $this->params['pass'][1];
            
            
            
            
            if($tipo==0){
                
                $options = array('conditions' => array('Cheque.' . $this->Cheque->primaryKey => $id));
                $this->request->data = $this->Cheque->find('first', $options);
                
                $x=$this->Cheque->query("SELECT montocheque, montodescuentointeres, montoentregado
                                      FROM chequeinterese
                                      WHERE cheque_id=".$id);
                 $cobrado=$this->request->data['Cheque']['cobrado'] = $tipo;
                 
                 $dias=$this->request->data['Cheque']['dias']=  intval($this->request->data['Cheque']['dias'])+1;
                 $monto=$this->request->data['Cheque']['monto'] = intval($x[0]['chequeinterese']['montocheque'])+intval($x[0]['chequeinterese']['montodescuentointeres']);
                
                 $que=$this->Cheque->save($this->request->data);
                  if(!$que){
                      $this->Cheque->query("UPDATE cheques SET cobrado=".$cobrado.", dias=".$dias.", 
                          monto=".$monto.", modified=NOW() WHERE id = ".$id);
                  }
                 $sql2="select dias,monto from cheques where id=".$id;
                 $y=  $this->Cheque->query($sql2);
                 
                 #debug($y[0]['cheques']['dias']);
                 $sql="select * from chequeinterese where cheque_id=".$id."";
                 $xx=  $this->Cheque->query($sql);
                 //debug($xx);
                 #exit(0);
                 
                 //copiamos el codigo
                 $monto=$xx;
                 //modificar el estado actual
                 
                
                $this->request->data['Chequeinterese']['user_id'] = $this->Auth->user('id');
                $this->request->data['Chequeinterese']['cheque_id'] = $id;
                $this->request->data['Chequeinterese']['montocheque'] = $this->request->data['Cheque']['monto'];    
                $this->request->data['Chequeinterese']['estadocheque'] = $this->request->data['Cheque']['cobrado']; 
                 
                 
                $sql="SELECT PORCENTAJE, MONTOFIJO
                    FROM INTERESES I, CHEQUES C
                    WHERE INTERESE_ID = I.ID
                    AND C.ID=".$id."";
                $x=$this->Cheque->query($sql);
                if($x[0]['I']['PORCENTAJE']==null){
                    $this->request->data['Chequeinterese']['montodescuentointeres'] = $x[0]['I']['MONTOFIJO']*$y[0]['cheques']['dias'];
                    $this->request->data['Chequeinterese']['montoentregado']=0;
                }
                else{
                    $p=(round(($x[0]['I']['PORCENTAJE']/100)*$y[0]['cheques']['monto']))*$y[0]['cheques']['dias'];    
                    if($p%2!=0)
                      $p++;
                    $this->request->data['Chequeinterese']['montodescuentointeres'] = $p;
                    $this->request->data['Chequeinterese']['montoentregado']=0;
                }
                $this->request->data['Chequeinterese']['created']= $monto[0]['chequeinterese']['created'];
                $sql3="UPDATE chequeinterese 
                        SET montocheque=".$this->request->data['Cheque']['monto'].",
                            montodescuentointeres=".$this->request->data['Chequeinterese']['montodescuentointeres'].",
                            montoentregado=".$this->request->data['Chequeinterese']['montoentregado'].",
                            estadocheque=".$this->request->data['Cheque']['cobrado'].",
                            created=now()
                           
                        WHERE id=".$xx[0]['chequeinterese']['id']."";
                
                $c=  $this->Cheque->query($sql3);
                
                $this->request->data['Chequeinterese']['user_id'] = $this->Auth->user('id');
                $this->request->data['Chequeinterese']['cheque_id'] = $id;
                $this->request->data['Chequeinterese']['montocheque'] = $monto[0]['chequeinterese']['montocheque'];    
                $this->request->data['Chequeinterese']['estadocheque'] = $monto[0]['chequeinterese']['estadocheque'];
                $this->request->data['Chequeinterese']['montodescuentointeres']= $monto[0]['chequeinterese']['montodescuentointeres'];
                $this->request->data['Chequeinterese']['montoentregado']= $monto[0]['chequeinterese']['montoentregado'];
                $this->request->data['Chequeinterese']['created']= $xx[0]['chequeinterese']['created'];
                
                $this->Cheque->Chequeinterese->save($this->request->data);
                /*
                $this->request->data['Cheque']['cobrado'] = $tipo;
                $this->Cheque->save($this->request->data);
                $this->Session->setFlash(__('The estado de uno de los cheques ha pasado al estado "Devuelto".'));
            }else
                $this->Session->setFlash(__('The estado de uno de los cheques ha pasado al estado "Cobrado". '));*/
                return $this->redirect(array('action' => 'index'));
            }
            else{
                 //cambiar el estado en la tabla cheque
                 $options = array('conditions' => array('Cheque.' . $this->Cheque->primaryKey => $id));
                 $this->request->data = $this->Cheque->find('first', $options);
                 $monto=  $this->Cheque->query("select * from chequeinterese where cheque_id=".$id." order by id asc");
                 /*debug($selecta);
                 exit(0);*/
                 $this->request->data['Cheque']['cobrado'] = $tipo;
                 $this->Cheque->save($this->request->data);
                 $this->request->data['Chequeinterese']['user_id'] = $this->Auth->user('id');
                $this->request->data['Chequeinterese']['cheque_id'] = $id;
                $this->request->data['Chequeinterese']['montocheque'] = $monto[0]['chequeinterese']['montocheque'];    
                $this->request->data['Chequeinterese']['estadocheque'] = $tipo;
                $this->request->data['Chequeinterese']['montodescuentointeres']= $monto[0]['chequeinterese']['montodescuentointeres'];
                $this->request->data['Chequeinterese']['montoentregado']= $monto[0]['chequeinterese']['montoentregado'];
                $this->request->data['Chequeinterese']['created']= date("Y-m-d h:i:s");
                 #extraer datos de la informacion de cheque intereses de todos lo cheques en
                 #cobrado=
                $this->Cheque->Chequeinterese->save($this->request->data);
                 
                 return $this->redirect(array('action' => 'index'));
            }
            
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
				$this->Session->setFlash(__('The cheque has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cheque could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cheque.' . $this->Cheque->primaryKey => $id));
			$this->request->data = $this->Cheque->find('first', $options);
		}
              
                
                
		$bancos = $this->Cheque->Banco->find('list');
		$clientes = $this->Cheque->Cliente->find('list',array('fields'=>array('id','nombres')));
		$interese = $this->Cheque->Interese->find('list',array('fields'=>array('id','rango')));
		$users = $this->Cheque->User->find('list');
                $x=$this->Cheque->query("select id, username from users where id=".$this->Auth->user('id')."");
                $users=array($x[0]['users']['id']=>$x[0]['users']['username']);
		$this->set(compact('bancos', 'clientes', 'interese', 'users','estadochequess'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Cheque->id = $id;
		if (!$this->Cheque->exists()) {
			throw new NotFoundException(__('Invalid cheque'));
		}
		#$this->request->onlyAllow('post', 'delete');
		if ($this->Cheque->delete()) {
			$this->Session->setFlash(__('The cheque has been deleted.'));
		} else {
			$this->Session->setFlash(__('The cheque could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
