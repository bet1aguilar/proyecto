<script>
    $(document).ready(function(){
        
    
 $(function () {

$("#datepicker").datepicker();
$("#datepicker1").datepicker();
});

  });
  </script>
<div class="cheques form">
<?php echo $this->Form->create('Cheque'); ?>
	<fieldset>
		<legend><?php echo __('Editar Cheque'); ?></legend>
                
                <br>
                <table>
                    <tr>
                        <th colspan="3"><?php echo $this->Form->input('cliente_id'); ?></th>
                    </tr>
                    <tr>
                        <th><?php echo $this->Form->input('banco_id'); ?></th>
<<<<<<< HEAD
                        <th><?php echo $this->Form->input('numerodecuenta'); ?></th>
                        <th><?php echo $this->Form->input('numerodecheque'); ?></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </table>
	<?php
=======
                        <th><?php echo $this->Form->input('numerodecuenta',array('label'=>'Nro. de Cuenta')); ?></th>
                        <th><?php echo $this->Form->input('numerodecheque',array('label'=>'Nro. de Cheque')); ?></th>
                    </tr>
                    <tr>
                        <th><?php echo $this->Form->input('monto'); ?></th>
                        <th><?php echo $this->Form->input('interese_id',array('label'=>'Interes')); ?></th>
                        <th><?php echo $this->Form->input('cobrado',array('options'=>array(
                               ''=>'Seleccione','1'=>'Por Cobrar','2'=>'Cobrado','0'=>'Devuelto'
                ))); ?></th>
                    </tr>
                    <tr>
                        <th><?php
                        //debug($this->data);
                        $fecharecibido=$this->data['Cheque']['fecharecibido'];
                        $fecharecibido = new DateTime($fecharecibido);
                        $fecharecibido = $fecharecibido->format('d-m-Y');
                        $fechacobro =$this->data['Cheque']['fechacobro'];
                        $fechacobro = new DateTime($fechacobro);
                        $fechacobro = $fechacobro->format('d-m-Y');
                        echo $this->Form->input('fecharecibido',array('label'=>'Fecha de Recibido','id'=>'datepicker','type'=>'text','style'=>'width:50%;','placeholder'=>'Haz Click aquí','readonly'=>'readonly','value'=>$fecharecibido)); ?></th>
                        <th><?php echo $this->Form->input('fechacobro',array('label'=>'Fecha de Cobro','id'=>'datepicker1','type'=>'text','style'=>'width:50%;','placeholder'=>'Haz Click aquí','readonly'=>'readonly','value'=>$fechacobro)); ?></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th colspan="2"><?php echo $this->Form->input('user_id'); ?></th>
                        <th><?php echo $this->Form->end(__('Submit')); ?></th>
                        
                    </tr>
                </table>
	<?php
		
		
		echo $this->Form->input('dir',array('type'=>'hidden'));
		
		
		echo $this->Form->input('dias',array('type'=>'hidden'));
		
		
	?>
	<?php
>>>>>>> origin/master
		/*echo $this->Form->input('id');
		echo $this->Form->input('banco_id');
		echo $this->Form->input('cliente_id');
		echo $this->Form->input('numerodecuenta');
		echo $this->Form->input('numerodecheque');*/
<<<<<<< HEAD
		echo $this->Form->input('monto');
		echo $this->Form->input('interese_id');
		/*echo $this->Form->input('filename');
		echo $this->Form->input('dir');*/
		echo $this->Form->input('fecharecibido');
=======
		/*echo $this->Form->input('monto');
		echo $this->Form->input('interese_id');
		/*echo $this->Form->input('filename');
		echo $this->Form->input('dir');*/
		/*echo $this->Form->input('fecharecibido');
>>>>>>> origin/master
		echo $this->Form->input('fechacobro');
		echo $this->Form->input('dias');
                echo $this->Form->input('cobrado',array('options'=>array(
                               ''=>'Seleccione','1'=>'Por Cobrar','2'=>'Cobrado','0'=>'Devuelto'
                ))); 
		echo $this->Form->input('id_cheque');
		echo $this->Form->input('user_id');*/
	?>
	</fieldset>

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Cheque.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Cheque.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cheques'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Bancos'), array('controller' => 'bancos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Banco'), array('controller' => 'bancos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientes'), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Interese'), array('controller' => 'interese', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Interese'), array('controller' => 'interese', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cheque Estadocheques'), array('controller' => 'cheque_estadocheques', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cheque Estadocheque'), array('controller' => 'cheque_estadocheques', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Chequeinterese'), array('controller' => 'chequeinterese', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Chequeinterese'), array('controller' => 'chequeinterese', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gestiondecobranzas'), array('controller' => 'gestiondecobranzas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gestiondecobranza'), array('controller' => 'gestiondecobranzas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pagos'), array('controller' => 'pagos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pago'), array('controller' => 'pagos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pagoterceros'), array('controller' => 'pagoterceros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pagotercero'), array('controller' => 'pagoterceros', 'action' => 'add')); ?> </li>
	</ul>
</div>
