<div class="cheques view">
<h2><?php echo __('Cheque'); ?></h2>
	<dl>
		
		
		<dt><?php echo __('Banco'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cheque['Banco']['codigo'], array('controller' => 'bancos', 'action' => 'view', $cheque['Banco']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cliente'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cheque['Cliente']['nombre'], array('controller' => 'clientes', 'action' => 'view', $cheque['Cliente']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($cheque['Cheque']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($cheque['Cheque']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Numerodecuenta'); ?></dt>
		<dd>
			<?php echo h($cheque['Cheque']['numerodecuenta']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Numerodecheque'); ?></dt>
		<dd>
			<?php echo h($cheque['Cheque']['numerodecheque']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Monto'); ?></dt>
		<dd>
			<?php echo h($cheque['Cheque']['monto']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Interese'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cheque['Interese']['rango'], array('controller' => 'interese', 'action' => 'view', $cheque['Interese']['id'])); ?>
			&nbsp;
		</dd>
                <?php if($cheque['Cheque']['filename']!=null){ ?>
		<dt><?php echo __('imagen'); ?></dt>
		<dd>
			<?php 
                        
                         echo $this->Html->image('uploads/cheque/filename/'.$cheque['Cheque']['filename'],array('width'=>500,'heigth'=>400)); ?>
			&nbsp;
		</dd>
                <?php } ?>
		<dt><?php echo __('Fecharecibido'); ?></dt>
		<dd>
			<?php echo h($cheque['Cheque']['fecharecibido']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fechacobro'); ?></dt>
		<dd>
			<?php echo h($cheque['Cheque']['fechacobro']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dias'); ?></dt>
		<dd>
			<?php echo h($cheque['Cheque']['dias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cobrado'); ?></dt>
		<dd>
			<?php  if($cheque['Cheque']['cobrado']==1)
                                echo h('Por Cobrar');
                            else
                                if($cheque['Cheque']['cobrado']==2)
                                    echo h('Cobrado');
                                else
                                    echo h('Devuelto');; ?>
			&nbsp;
		</dd>
                <?php if($cheque['Cheque']['cheque_id']!=null){?>
		<dt><?php echo __('Cheque a Pagar'); ?></dt>
		<dd>
			<?php 
                         echo $this->Html->link($cheque['Cheque']['numerodecheque'], array('controller' => 'cheques', 'action' => 'view', $cheque['Cheque']['id'])); 
                        ?>
			&nbsp;
		</dd>
                <?php } ?>
		<dt><?php echo __('Usuario'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cheque['User']['username'], array('controller' => 'users', 'action' => 'view', $cheque['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cheque'), array('action' => 'edit', $cheque['Cheque']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cheque'), array('action' => 'delete', $cheque['Cheque']['id']), null, __('Are you sure you want to delete # %s?', $cheque['Cheque']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cheques'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cheque'), array('action' => 'add')); ?> </li>
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

<div class="related">
	<h3><?php echo __('Pagos con Cheque'); 
        
         ?></h3>
<?php if(!empty($relacionados)): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		
		<th><?php echo __('Banco'); ?></th>
		<th><?php echo __('Nro de Cheque'); ?></th>
		<th><?php echo __('Días'); ?></th>
		<th><?php echo __('Interes'); ?></th>
		<th><?php echo __('Monto'); ?></th>
                <th><?php echo __('Interes'); ?></th>
                 <th><?php echo __('Descontado'); ?></th>
                 <th><?php echo __('Fecha Recib.'); ?></th>
                 <th><?php echo __('Fecha Cobro'); ?></th>
		<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($relacionados as $chequeEstadocheque): ?>
		<tr>
			
			<td><?php echo $chequeEstadocheque['created']; ?></td>
			<td><?php echo $chequeEstadocheque['modified']; ?></td>
			<td><?php echo $chequeEstadocheque['cheque_id']; ?></td>
			<td><?php echo $chequeEstadocheque['estadocheque_id']; ?></td>
			<td><?php echo $chequeEstadocheque['user_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cheque_estadocheques', 'action' => 'view', $chequeEstadocheque['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cheque_estadocheques', 'action' => 'edit', $chequeEstadocheque['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cheque_estadocheques', 'action' => 'delete', $chequeEstadocheque['id']), null, __('Are you sure you want to delete # %s?', $chequeEstadocheque['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Nuevo Cheque'), array('action' => 'add2',$cheque['Cheque']['id'])); ?> </li>
		</ul>
	</div>
</div>

<div class="related">
	<h3><?php echo __('Related Cheque Estadocheques'); ?></h3>
	<?php if (!empty($cheque['ChequeEstadocheque'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Cheque Id'); ?></th>
		<th><?php echo __('Estadocheque Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($cheque['ChequeEstadocheque'] as $chequeEstadocheque): ?>
		<tr>
			<td><?php echo $chequeEstadocheque['id']; ?></td>
			<td><?php echo $chequeEstadocheque['created']; ?></td>
			<td><?php echo $chequeEstadocheque['modified']; ?></td>
			<td><?php echo $chequeEstadocheque['cheque_id']; ?></td>
			<td><?php echo $chequeEstadocheque['estadocheque_id']; ?></td>
			<td><?php echo $chequeEstadocheque['user_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cheque_estadocheques', 'action' => 'view', $chequeEstadocheque['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cheque_estadocheques', 'action' => 'edit', $chequeEstadocheque['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cheque_estadocheques', 'action' => 'delete', $chequeEstadocheque['id']), null, __('Are you sure you want to delete # %s?', $chequeEstadocheque['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Cheque Estadocheque'), array('controller' => 'cheque_estadocheques', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Chequeinterese'); ?></h3>
	<?php if (!empty($cheque['Chequeinterese'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Montocheque'); ?></th>
		<th><?php echo __('Montodescuentointeres'); ?></th>
		<th><?php echo __('Montoentregado'); ?></th>
                <th><?php echo __('Estado cheque'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Cheque Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($cheque['Chequeinterese'] as $chequeinterese): ?>
		<tr>
			<td><?php echo $chequeinterese['id']; ?></td>
			<td><?php echo $chequeinterese['montocheque']; ?></td>
			<td><?php echo $chequeinterese['montodescuentointeres']; ?></td>
			<td><?php echo $chequeinterese['montoentregado']; ?></td>
                                    
                        <td><?php 
                        if($chequeinterese['estadocheque']==1)
                            echo "Por cobrar";
                        else
                            if($chequeinterese['estadocheque']==0)
                                echo "Devuelto";
                            else
                                echo 'cobrado';
                        ?></td>
			<td><?php echo $chequeinterese['created']; ?></td>
			<td><?php echo $chequeinterese['cheque_id']; ?></td>
			<td><?php echo $chequeinterese['user_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'chequeinterese', 'action' => 'view', $chequeinterese['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'chequeinterese', 'action' => 'edit', $chequeinterese['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'chequeinterese', 'action' => 'delete', $chequeinterese['id']), null, __('Are you sure you want to delete # %s?', $chequeinterese['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Chequeinterese'), array('controller' => 'chequeinterese', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Gestiondecobranzas'); ?></h3>
	<?php if (!empty($cheque['Gestiondecobranza'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Descripcion'); ?></th>
		<th><?php echo __('Cheque Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($cheque['Gestiondecobranza'] as $gestiondecobranza): ?>
		<tr>
			<td><?php echo $gestiondecobranza['id']; ?></td>
			<td><?php echo $gestiondecobranza['created']; ?></td>
			<td><?php echo $gestiondecobranza['descripcion']; ?></td>
			<td><?php echo $gestiondecobranza['cheque_id']; ?></td>
			<td><?php echo $gestiondecobranza['user_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'gestiondecobranzas', 'action' => 'view', $gestiondecobranza['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'gestiondecobranzas', 'action' => 'edit', $gestiondecobranza['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'gestiondecobranzas', 'action' => 'delete', $gestiondecobranza['id']), null, __('Are you sure you want to delete # %s?', $gestiondecobranza['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Gestiondecobranza'), array('controller' => 'gestiondecobranzas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<?php if($cheque['Cheque']['cobrado']==0){ ?>
<div class="related">
	<h3><?php echo __('Related Pagos'); ?></h3>
	<?php if (!empty($cheque['Pago'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Cliente Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Monto'); ?></th>
		<th><?php echo __('Conceptode'); ?></th>
		<th><?php echo __('Edodeuda'); ?></th>
		<th><?php echo __('Pagointerese Deuda'); ?></th>
		<th><?php echo __('Chequeinterese Id'); ?></th>
		<th><?php echo __('Cheque Id'); ?></th>
		<th><?php echo __('Cheque Estadocheque Id'); ?></th>
		<th><?php echo __('Tipopago Id'); ?></th>
		<th><?php echo __('Pagotercero Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($cheque['Pago'] as $pago): ?>
		<tr>
			<td><?php echo $pago['id']; ?></td>
			<td><?php echo $pago['cliente_id']; ?></td>
			<td><?php echo $pago['created']; ?></td>
			<td><?php echo $pago['modified']; ?></td>
			<td><?php echo $pago['monto']; ?></td>
			<td><?php echo $pago['conceptode']; ?></td>
			<td><?php echo $pago['edodeuda']; ?></td>
			<td><?php echo $pago['pagointerese_deuda']; ?></td>
			<td><?php echo $pago['chequeinterese_id']; ?></td>
			<td><?php echo $pago['cheque_id']; ?></td>
			<td><?php echo $pago['cheque_estadocheque_id']; ?></td>
			<td><?php echo $pago['tipopago_id']; ?></td>
			<td><?php echo $pago['pagotercero_id']; ?></td>
			<td><?php echo $pago['user_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'pagos', 'action' => 'view', $pago['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'pagos', 'action' => 'edit', $pago['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'pagos', 'action' => 'delete', $pago['id']), null, __('Are you sure you want to delete # %s?', $pago['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Pago'), array('controller' => 'pagos', 'action' => 'add/'.$cheque['Cheque']['id'].'/1/'.$cheque['Cheque']['cobrado'],$cheque['Cliente']['id'])); ?> </li>
		</ul>
	</div>
</div>
<?php } ?>
<div class="related">
	<h3><?php echo __('Related Pagoterceros'); ?></h3>
	<?php if (!empty($cheque['Pagotercero'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Dia'); ?></th>
		<th><?php echo __('Monto'); ?></th>
		<th><?php echo __('Conceptode'); ?></th>
		<th><?php echo __('Cliente Id'); ?></th>
		<th><?php echo __('Cliente Id1'); ?></th>
		<th><?php echo __('Cheque Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($cheque['Pagotercero'] as $pagotercero): ?>
		<tr>
			<td><?php echo $pagotercero['id']; ?></td>
			<td><?php echo $pagotercero['created']; ?></td>
			<td><?php echo $pagotercero['dia']; ?></td>
			<td><?php echo $pagotercero['monto']; ?></td>
			<td><?php echo $pagotercero['conceptode']; ?></td>
			<td><?php echo $pagotercero['cliente_id']; ?></td>
			<td><?php echo $pagotercero['cliente_id1']; ?></td>
			<td><?php echo $pagotercero['cheque_id']; ?></td>
			<td><?php echo $pagotercero['user_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'pagoterceros', 'action' => 'view', $pagotercero['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'pagoterceros', 'action' => 'edit', $pagotercero['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'pagoterceros', 'action' => 'delete', $pagotercero['id']), null, __('Are you sure you want to delete # %s?', $pagotercero['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Pagotercero'), array('controller' => 'pagoterceros', 'action' => 'add/'.$cheque['Cheque']['id'],$cheque['Cliente']['id'])); ?> </li>
		</ul>
	</div>
</div>
