<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html style="overflow: hidden;">
<head>
<meta charset="UTF-8">
<link href="../../../lib/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />   
	<link href="../../../lib/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/se7en-font.css" media="all" rel="stylesheet" type="text/css" />  
	<link href="../../../lib/css/style.css" media="all" rel="stylesheet" type="text/css" />
	<!-- bootstrap para subir archivo-->
	<link href="../../../lib/css/bootstrap-editable.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/jquery.fileupload-ui.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/datatables.css" media="all" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/estiloCrear.css">

	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<script src="../../../lib/js/jquery.dataTables.min.js" type="text/javascript"></script>	
	<script src="../../../lib/js/datatable-editable.js" type="text/javascript"></script>
	<script src="../../../lib/js/bootstrap-fileupload.js" type="text/javascript"></script>
	<script src="../../../lib/js/modernizr.custom.js"></script>


	<script src="../controlador/cliente/controladorAcceso.js"></script>	
	<script src="js/delete.js"></script>

	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
</head>
	<body>
		<div class="container-fluid main-content" id="createMenu" data-role="popup" data-theme="a" class="ui-corner-all">

		<div class="row" id="dataPrincipal">
		  <div class="col-md-12">
		    <div class="widget-container">
		       <div class="heading">
			        <i class="glyphicon glyphicon-th-large"></i>
			        <label style="margin-left: 1%;"> Eliminar Menu</label>
		       </div>

		        <div class="widget-content padded">
			        <div class="form-horizontal"  id="Principal">
			        	<div class="form-group">
				            <label class="control-label col-md-2" style="margin-left: 14%;font-size: 134%;color: blue;">
				            ¿Está Seguro de eliminar el menu?</label>        
	   		          	</div>

	   		          	<div style="margin-left: 29%;">
			       			<br>		       		
			       			<button class="btn btn-primary" style="width: 26%;" id="eliminar">Si</button> 
			       			<button class="btn btn-primary" style="width: 26%;" id="cerrandoMenu">No</button> 		       		
			       		</div>
			       			<span  id="msgboxError" style="color: red;"> </span>
			       			<span  id="msgboxOk" style="color: green;"> </span>	
	   		        </div>

	   		        <div class="form-horizontal"  id="EliminadoCorrecto">
		        		<div class="col-md-3 mostrarForm" style="text-align: center;">
		        			<label class="textoSuccess"> Se ha eliminado el menu correctamente</label>	
			        	</div>       	
			        	<div class="col-md-3" style="margin-left: 41%;">		        
			        		<button class="btn btn-primary" id="CloseSuccess"> Aceptar </button> 
			        	</div>
			        </div>	
	             	
		        </div>
		       	
		  </div>
			     
				</div>
		 </div>

		<div id="contenido">		
		</div>

		</div>
	      		
		
	</body>
</html>