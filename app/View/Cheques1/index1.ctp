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
	<h2>
            <?php  #debug($cheques); 
                
        $_SESSION['varia']=1;
        echo __('Relación Diaria '.date('d-m-Y h:i:s')); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			
			<th><?php echo $this->Paginator->sort('banco_id'); ?></th>
			<th><?php echo $this->Paginator->sort('cliente_id'); ?></th>
			<th><?php echo $this->Paginator->sort('numerodecheque','Numero de cheque'); ?></th>
			<th><?php echo $this->Paginator->sort('monto'); ?></th>
			<th><?php echo $this->Paginator->sort('interese_id','intrs/porc'); ?></th>
			<th><?php echo $this->Paginator->sort('dias'); ?></th>
                        <th><?php echo $this->Paginator->sort('montointeres'); ?></th>
                        <th><?php echo $this->Paginator->sort('Monto intereses / dia'); ?></th>
                        <th><?php echo $this->Paginator->sort('M.apag.cheq'); ?></th>
			<th><?php echo $this->Paginator->sort('fecharecibido'); ?></th>
			<th><?php echo $this->Paginator->sort('fechacobro'); ?></th>
			<th><?php echo $this->Paginator->sort('estado'); ?></th>
                        <th><?php echo $this->Paginator->sort('cheque caja cambio'); ?></th>
			<th><?php echo $this->Paginator->sort('id_cheque'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($cheques as $cheque): ?>
			<?php if($cheque['Cheque']['cobrado']==0){ ?>

        <tr style="background: orangered; color: white;">
		<td>
			<?php echo $this->Html->link($cheque['Banco']['nombre'], array('controller' => 'bancos', 'action' => 'view', $cheque['Banco']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($cheque['Cliente']['nombre']." ".$cheque['Cliente']['apellido'], array('controller' => 'clientes', 'action' => 'view', $cheque['Cliente']['id'])); ?>
		</td>
		
		
		<td><?php 
                 echo $this->Html->link($cheque['Cheque']['numerodecheque'], array('action' => 'view', $cheque['Cheque']['id'])); 
                #echo h($cheque['Cheque']['numerodecheque']); ?>&nbsp;</td>
		<td><?php echo h($cheque['Cheque']['monto']); ?>&nbsp;</td>
		<td>
                        
                    <?php 
                        if($cheque['Interese']['porcentaje']==null)
                    echo $this->Html->link($cheque['Interese']['montofijo'], array('controller' => 'interese', 'action' => 'view', $cheque['Interese']['id']))." Bs"; 
                        else
                    echo $this->Html->link($cheque['Interese']['porcentaje'], array('controller' => 'interese', 'action' => 'view', $cheque['Interese']['id']))." %"; ?>
                       
                        
                    
		</td>
                <td><?php 
                            
                            $date1 = $cheque['Cheque']['fecharecibido'];
                            $date2 = $cheque['Cheque']['fechacobro'];
                            $diff = abs(strtotime($date2) - strtotime($date1));
                            $years = floor($diff / (365*60*60*24));
                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                            $dias1 = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                            $dias1++;
                            
                            $date1 = $cheque['Cheque']['fechacobro'];
                            $date2 = date('Y-m-d');
                            $diff = abs(strtotime($date2) - strtotime($date1));
                            $years = floor($diff / (365*60*60*24));
                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                            $dias = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                            
                            if($date1<$date2){
                                $dias=$dias1+$dias+1;
                            }else{
                                $dias=$dias1;
                            }        
                            echo h($dias); 
                            
                     ?></td>
                <td><?php 
                           if($cheque['Interese']['porcentaje']==null){
                               echo h(0); 
                           }else{
                               $montointeres=($cheque['Cheque']['monto']*($cheque['Interese']['porcentaje']/100));
                               round($montointeres)+1;
                               echo h($montointeres);
                           }
                     ?></td>
                <td><?php 
                        if($cheque['Interese']['porcentaje']==null){
                            $montototalintereses=$cheque['Interese']['montofijo']*$dias;
                            echo h($montototalintereses);
                        }else{
                            $montototalintereses=$montointeres*$dias;
                            
                            echo h($montototalintereses);
                        }
                  ?></td>
		<td><?php 
                        $z=$cheque['Cheque']['monto']-$montototalintereses;
                        echo h($z);
                #echo h($cheque['Cheque']['fecharecibido']); ?>&nbsp;</td>
                <td><?php echo h($cheque['Cheque']['fecharecibido']); ?>&nbsp;</td>
		<td><?php echo h($cheque['Cheque']['fechacobro']); ?>&nbsp;</td>
		<td><?php 
                        if($cheque['Cheque']['cobrado']==1)
                        echo h('Por Cobrar'); 
                        else
                        if($cheque['Cheque']['cobrado']==2)
                        echo h('Cobrado');
                        else
                        echo ('Devuelto');
                ?>&nbsp;</td>
                <?php if($cheque['ChequeEstadocheque'][0]['Estadocheque']['id']==5){ ?>
                <td><?php
                
                          echo h($cheque['ChequeEstadocheque'][0]['Estadocheque']['nomenclatura']); ?>&nbsp;</td>
                <?php }else{ ?>
                <td>
                    <?php echo h($cheque['ChequeEstadocheque'][0]['Estadocheque']['nomenclatura']); ?>
                </td>
                <?php } ?>
		<td><?php echo h($cheque['Cheque']['id_cheque']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($cheque['User']['username'], array('controller' => 'users', 'action' => 'view', $cheque['User']['id'])); ?>
		</td>
               
		<td class="actions">
                        <?php echo $this->Html->link(__('Devuelto'), array('action' => 'editadevuelto/'. $cheque['Cheque']['id'],0)); ?>
			<?php echo $this->Html->link(__('Cobrado'), array('action' => 'editadevuelto/'. $cheque['Cheque']['id'],2)); ?>
                        
                        <?php #echo $this->Html->link(__('Ver'), array('action' => 'view', $cheque['Cheque']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $cheque['Cheque']['id'])); ?>
			<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $cheque['Cheque']['id']), null, __('Are you sure you want to delete # %s?', $cheque['Cheque']['id'])); ?>
		</td>
	</tr>
         <?php }else{//casos contrarios para acordarme
             if($cheque['Cheque']['cobrado']==1){
             ?>
              <tr >
		<td>
			<?php echo $this->Html->link($cheque['Banco']['nombre'], array('controller' => 'bancos', 'action' => 'view', $cheque['Banco']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($cheque['Cliente']['nombre']." ".$cheque['Cliente']['apellido'], array('controller' => 'clientes', 'action' => 'view', $cheque['Cliente']['id'])); ?>
		</td>
		
		
		<td><?php 
                echo $this->Html->link($cheque['Cheque']['numerodecheque'], array('action' => 'view', $cheque['Cheque']['id'])); 
#echo h($cheque['Cheque']['numerodecheque']); ?>&nbsp;</td>
		<td><?php echo h($cheque['Cheque']['monto']); ?>&nbsp;</td>
		<td>
                        
                    <?php 
                        if($cheque['Interese']['porcentaje']==null)
                    echo $this->Html->link($cheque['Interese']['montofijo'], array('controller' => 'interese', 'action' => 'view', $cheque['Interese']['id']))." Bs"; 
                        else
                    echo $this->Html->link($cheque['Interese']['porcentaje'], array('controller' => 'interese', 'action' => 'view', $cheque['Interese']['id']))." %"; ?>
                       
                        
                    
		</td>
                <td><?php 
                            $date1 = $cheque['Cheque']['fecharecibido'];
                            $date2 = $cheque['Cheque']['fechacobro'];
                            $diff = abs(strtotime($date2) - strtotime($date1));
                            $years = floor($diff / (365*60*60*24));
                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                            $dias1 = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                            $dias1++;
                            
                            $date1 = $cheque['Cheque']['fechacobro'];
                            $date2 = date('Y-m-d');
                            $diff = abs(strtotime($date2) - strtotime($date1));
                            $years = floor($diff / (365*60*60*24));
                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                            $dias = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                            #$dias++;
                            
                            if($date1<$date2){
                                $dias=$dias1+$dias+1;
                            }else{
                                $dias=$dias1;
                            }        
                            echo h($dias); 
                          
                     ?></td>
                <td><?php 
                           if($cheque['Interese']['porcentaje']==null){
                               echo h(0); 
                           }else{
                               $montointeres=($cheque['Cheque']['monto']*($cheque['Interese']['porcentaje']/100));
                               round($montointeres)+1;
                               echo h($montointeres);
                           }
                     ?></td>
                <td><?php 
                        if($cheque['Interese']['porcentaje']==null){
                            $montototalintereses=$cheque['Interese']['montofijo']*$dias;
                            echo h($montototalintereses);
                        }else{
                            $montototalintereses=$montointeres*$dias;
                            
                            echo h($montototalintereses);
                        }
                  ?></td>
                <?php if($cheque['ChequeEstadocheque'][0]['Estadocheque']['id']==5){ ?>
                <td style="background: greenyellow;"><?php
                
                          $z=$cheque['Cheque']['monto']-$montototalintereses;
                          echo h($z);
                        ?>&nbsp;</td>
                <?php }else{ ?>
                <td><?php
                          $z=$cheque['Cheque']['monto']-$montototalintereses;
                          echo h($z);
                        ?>&nbsp;</td>
                <?php } ?>
                
		<td><?php echo h($cheque['Cheque']['fecharecibido']); ?>&nbsp;</td>
		<td><?php echo h($cheque['Cheque']['fechacobro']); ?>&nbsp;</td>
		<td><?php 
                        if($cheque['Cheque']['cobrado']==1)
                        echo h('Por Cobrar'); 
                        else
                        if($cheque['Cheque']['cobrado']==2)
                        echo h('Cobrado');
                        else
                        echo ('Devuelto');
                ?>&nbsp;</td>
                
                <td><?php
                
                          echo h($cheque['ChequeEstadocheque'][0]['Estadocheque']['nomenclatura']); ?>&nbsp;</td>
                
                
		<td><?php echo h($cheque['Cheque']['id_cheque']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($cheque['User']['username'], array('controller' => 'users', 'action' => 'view', $cheque['User']['id'])); ?>
		</td>
               
		<td class="actions">
			<?php echo $this->Html->link(__('Devuelto'), array('action' => 'editadevuelto/'. $cheque['Cheque']['id'],0)); ?>
			<?php echo $this->Html->link(__('Cobrado'), array('action' => 'editadevuelto/'. $cheque['Cheque']['id'],2)); ?>
                    
                        <?php #echo $this->Html->link(__('Ver'), array('action' => 'view', $cheque['Cheque']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $cheque['Cheque']['id'])); ?>
			<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $cheque['Cheque']['id']), null, __('Are you sure you want to delete # %s?', $cheque['Cheque']['id'])); ?>
		</td>
	</tr>
         <?php } }  ?>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de {:count} en total, Empezando desde el registro {:start}, finalizando en el registro  {:end}')
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

