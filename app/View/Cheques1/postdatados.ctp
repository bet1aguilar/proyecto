<style>
    div.form, div.index, div.view {
float: left;
width: 76%;
border-left: 0px solid #666;
padding: 10px 1%;
}
</style>
<div id="search_box"> 
 
<?php echo $this->Form->create('Cheque', array('url' => array('action' => 'index'))); ?> 
<div style="float:left; width:30%">
    <?php 

echo $this->Form->label('Búsqueda') ?>
<?php echo $this->Form->input('search_text', array('style' => 'width: 70%;', 'div'=> false,'label' => false)); ?> 
<?php echo $this->Form->end('Buscar'); ?>      
</div> 
<div style="float: left;width:30%">

     </div>
</div> 
<div class="cheques index">
	
    
    <?php if($sumas!=null){ ?>
    <h3>Monto de cheques postdatado</h3>
    <table cellpadding="0" cellspacing="0" style="width: 400px; background: activeborder">
        <tr>
            <th>Estado del cheque</th>
            <th>Monto total cheques devueltos</th>
            
        </tr>
        <tr>
            <th><?php if(!empty($sumas[0])){
                echo "Cheque por cobrar:";
            
            ?></th>
            
            <th><?php echo h(number_format(floatval($sumas[0][0]['sumato']),2,',','.')); }?></th>
        </tr>
    </table>
    <?php } ?>
    <h2><?php #debug($sumas); 
        echo __('Cheques Postdatado'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
			
			<th><?php echo $this->Paginator->sort('banco_id'); ?></th>
			<th><?php echo $this->Paginator->sort('cliente_id'); ?></th>
			<th><?php echo $this->Paginator->sort('numerodecheque');?></th>
                        <th><?php echo $this->Paginator->sort('dias'); ?></th>
			<th><?php echo $this->Paginator->sort('interese_id'); ?></th>
			<th><?php echo $this->Paginator->sort('monto'); ?></th>
                        <th><?php echo $this->Paginator->sort('montointereses'); ?></th>
                        <th><?php echo $this->Paginator->sort('montoentregado'); ?></th>
			<th><?php echo $this->Paginator->sort('fecharecibido'); ?></th>
			<th><?php echo $this->Paginator->sort('fechacobro'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('cheque'); ?></th>
                        <th><?php echo $this->Paginator->sort('estado'); ?></th>
			<th><?php echo $this->Paginator->sort('id_cheque'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($cheques as $cheque): ?>
	<?php 
                
                
               # debug($dias);
        if($cheque['Cheque']['cobrado']==1){ ?>
        <tr>
		
		<td>
			<?php echo $this->Html->link($cheque['Banco']['nombre'], array('controller' => 'bancos', 'action' => 'view', $cheque['Banco']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($cheque['Cliente']['nombre'], array('controller' => 'clientes', 'action' => 'view', $cheque['Cliente']['id'])); ?>
		</td>
                
		
		
		<td><?php echo $this->Html->link(__($cheque['Cheque']['numerodecheque']), array('action' => 'view', $cheque['Cheque']['id']));
                          #echo h(); ?>&nbsp;</td>
                <td><?php echo h($cheque['Cheque']['dias']); ?>&nbsp;</td>
		<td>
			<?php 
                        if($cheque['Interese']['porcentaje']==null)
                        echo $this->Html->link($cheque['Interese']['montofijo'], array('controller' => 'interese', 'action' => 'view', $cheque['Interese']['id']))." Bs"; 
                        else
                        echo $this->Html->link($cheque['Interese']['porcentaje'], array('controller' => 'interese', 'action' => 'view', $cheque['Interese']['id']))." %"; 
                        ?>
                        
		</td>
		<td><?php 
                echo h(number_format(floatval($cheque['Cheque']['monto']),2,',','.'));
                #echo h(money_format("%i",  )); ?>&nbsp;</td>
                <td><?php 
                echo h(number_format(floatval($cheque['Chequeinterese'][0]['montodescuentointeres']),2,',','.'));
                #echo h($cheque['Chequeinterese'][0]['montodescuentointeres']); ?>&nbsp;</td>
                <td><?php 
                echo h(number_format(floatval($cheque['Chequeinterese'][0]['montoentregado']),2,',','.'));
                #echo h($cheque['Chequeinterese'][0]['montoentregado']); ?>&nbsp;</td>
                
		<td><?php echo h($cheque['Cheque']['fecharecibido']); ?>&nbsp;</td>
		<td><?php echo h($cheque['Cheque']['fechacobro']); ?>&nbsp;</td>
		
                <td><?php echo h($cheque['Cheque']['created']); ?>&nbsp;</td>
		<td><?php echo h($cheque['Cheque']['modified']); ?>&nbsp;</td>
                
		<td><?php 
                            if($cheque['Cheque']['cobrado']==1)
                                echo h('Por Cobrar');
                            else
                                if($cheque['Cheque']['cobrado']==2)
                                    echo h('Cobrado');
                                else
                                    echo h('Devuelto');
                                    ?>&nbsp;</td>
		<td><?php echo h($cheque['User']['Estadocheque']['0']['nomenclatura']); ?>&nbsp;</td>
                <td><?php echo h($cheque['Cheque']['cheque_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($cheque['User']['username'], array('controller' => 'users', 'action' => 'view', $cheque['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php #echo $this->Html->link(__('Devuelto'), array('action' => 'editadevuelto/'. $cheque['Cheque']['id'],0)); ?>
                        <?php echo $this->Html->link(__('Cobrado'), array('action' => 'editadevuelto/'. $cheque['Cheque']['id'],2)); ?>
                        <?php echo $this->Html->link(__('Ver'), array('action' => 'view', $cheque['Cheque']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $cheque['Cheque']['id'])); ?>
			<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $cheque['Cheque']['id']), null, __('Está seguro de que desea eliminar el cheque numero # %s?', $cheque['Cheque']['numerodecheque'])); ?>
		</td>
	</tr>
        <?php } ?>
<?php  endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('Atras'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>