<?php date_default_timezone_set("America/Caracas")?>

<script>
    $(document).ready(function(){
        
    
 $(function () {

$("#datepicker").datepicker();
$("#datepicker1").datepicker();
});

  });
  </script>
<div class="cheques form">
<?php echo $this->Form->create('Cheque',array('type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Agregar Cheque a Pago'); ?></legend>
	<?php
        
        echo $this->Form->input('banco_id');
        echo $this->Form->input('id',array('type'=>'hidden'));
		echo $this->Form->input('cliente_id');
		echo $this->Form->input('numerodecuenta',array('label'=>'Nro. de Cuenta'));
		echo $this->Form->input('numerodecheque',array('label'=>'Nro. de Cheque'));
		echo $this->Form->input('monto');
		echo $this->Form->input('interese_id',array('label'=>'Interes'));
		echo $this->Form->input('filename',array('type'=>'file','label'=>'Imagen del Cheque'));
		echo $this->Form->input('dir',array('type'=>'hidden'));
		echo $this->Form->input('fecharecibido',array('label'=>'Fecha de Recibido','id'=>'datepicker','type'=>'text','style'=>'width:50%;','placeholder'=>'Haz Click aquí','readonly'=>'readonly','value'=> date('d-m-Y')));
		echo $this->Form->input('fechacobro',array('label'=>'Fecha de Cobro','id'=>'datepicker1','type'=>'text','style'=>'width:50%;','placeholder'=>'Haz Click aquí','readonly'=>'readonly'));
		echo $this->Form->input('dias',array('type'=>'hidden'));
		echo $this->Form->input('cobrado',array('options'=>array(
                               ''=>'Seleccione','1'=>'Por Cobrar','2'=>'Cobrado','0'=>'Devuelto'
                )));
                echo $this->Form->input('cheque_id',array('label'=>'Cheque a Pagar','type'=>'select','options'=>$id_cheque));
		echo $this->Form->input('user_id', array('label'=>'Usuario de Registro'));
		
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Cheques'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Listar Bancos'), array('controller' => 'bancos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Banco'), array('controller' => 'bancos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Clientes'), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Usuarios'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
</div>
