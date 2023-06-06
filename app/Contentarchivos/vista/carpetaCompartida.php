<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html style="overflow: hidden;">
<head>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	    <!--  EXTRAE TODA LA DATA DL COMPONENTE PRINCIPAL-->
  		<?php include_once("../../../lib/components.php");?>

	<script src='js/enviandoData.js'></script>
	</head>
	<body>
		<div class="widget-container padded">
		<input type='hidden' value='<?php echo $_SESSION['username'];?>' id='usuario' />
		<input type='hidden' value='<?php echo $_SESSION['clave'];?>' id='clave'>
		<iframe  src="" id="contenido" style="width: 99%;height: 68em;"></iframe>
		
		</div><!-- DIV PRINCIPAL  -->
</body>
</html>