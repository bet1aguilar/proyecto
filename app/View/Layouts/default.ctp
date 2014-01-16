<?php


$cakeDescription = __d('cake_dev', 'Gravimon C.A.');
?>
<script>
    $(document).ready(function(){
        
    
 $(function () {

$("#datepicker").datepicker();
});

  });
  </script>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
                echo $this->Html->css('styles1');
                echo $this->Html->css('jquery-ui-1.10.3.custom');
                echo $this->Html->css('jquery-ui-1.10.3.custom.min');
                echo $this->Html->script('jquery-1.9.1');
                echo $this->Html->script('jquery-ui-1.10.3.custom');
                echo $this->Html->script('jquery-ui-1.10.3.custom.min');
               
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
		</div>
            <div id='cssmenu'>
<ul>
   <li class='has-sub'><a href='#'><span>Relacion Diaria</span></a>
      <ul>
         <li><?php echo $this->Html->link("De Cheque", array('controller'=>'cheques','action' => 'index'), array('escape' => false));?></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Servicios</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Cheques</span></a>
            <ul>
               <li><?php echo $this->Html->link("Nuevo Cheque", array('controller'=>'cheques','action' => 'add'), array('escape' => false));?></li>
               <li><?php echo $this->Html->link("Listar Cheque", array('controller'=>'cheques','action' => 'index'), array('escape' => false));?></a></li>
               <li><?php echo $this->Html->link("Pago", array('controller'=>'pagos','action' => 'add'), array('escape' => false));?></li>
               
            </ul>
         </li>
         
         
         <li class='has-sub'><a href='#'><span>Pagos a Terceros</span></a>
            <ul>
               <li><?php echo $this->Html->link("Nuevo pago", array('controller'=>'pagoterceros','action' => 'add'), array('escape' => false));?></li>
               <li><?php echo $this->Html->link("Lista pago", array('controller'=>'pagoterceros','action' => 'index'), array('escape' => false));?></li>
            </ul>
         </li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Clientes</span></a>
      <ul>
         <li><?php echo $this->Html->link("Registrar Cliente", array('controller'=>'clientes','action' => 'add'), array('escape' => false));?></a></li>
         <li class='last'><?php echo $this->Html->link("Listar Clientes", array('controller'=>'clientes','action' => 'index'), array('escape' => false));?></a></li>
      </ul>
   </li>
   
   <li class='has-sub'><a href='#'><span>Reportes</span></a>
      <ul>
         <li><?php echo $this->Html->link("Cheques Devueltos", array('controller'=>'cheques','action' => 'devueltos'), array('escape' => false));?></li>         
         <li><?php echo $this->Html->link("Cheques Postdatado", array('controller'=>'cheques','action' => 'postdatados'), array('escape' => false));?></li>
         <li><?php echo $this->Html->link("Cheques Cobrados", array('controller'=>'cheques','action' => 'index2'), array('escape' => false));?></li>
      </ul>
   </li>
   <li class='has-sub last'><a href='#'><span>Parametros</span></a>
      <ul>
         <li><a href='#'><span>Cliente</span></a></li>
         <li><a href='#'><span>Usuarios</span></a></li>
         <li><a href='#'><span>Denominacion de Billetes</span></a></li>
         <li><a href='#'><span>Bancos</span></a></li>
         <li><a href='#'><span>Estado de Cheques</span></a></li>
         <li><a href='#'><span>Roles</span></a></li>
         <li><a href='#'><span>Formas de Pago</span></a></li>
         <li class='last'><a href='#'><span>Intereses</span></a></li>
      </ul>
   </li>
   <li><?php 
  
        echo $this->Html->link("Cerrar Sesión", array('controller'=>'users','action' => 'logout'), array('escape' => false));?></span></a></li>
</ul>
</div>

		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
            
		<div id="footer">
			<?php echo 'Derechos reservados Gravimon C.A.';
					
				
			?>
		</div>
	</div>
	<?php #echo $this->element('sql_dump'); ?>
</body>
</html>
