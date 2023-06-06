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
	<script src="js/perfiles.js"></script>

	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
</head>
	<body>
		<div class="container-fluid main-content"  style="margin-top: 2%;" id="createMenu" data-role="popup" data-theme="a" class="ui-corner-all">

		<div class="row">
		  <div class="col-md-12">
		    <div class="widget-container">
		       <div class="heading">
			        <i class="glyphicon glyphicon-th-large"></i>
			        <label style="margin-left: 1%;"> Asignar Perfiles</label>
		       </div>

		        <div class="widget-content padded">
		        	<div class="form-horizontal"  id="Principal">
		        		<div class="form-group">
			            <label class="control-label col-md-2">Perfiles</label>
			            <div class="col-md-3">
			             	<select class="form-control" name="perfiles" id="perfiles">
							</select>
			            </div>
	   		          	</div>

			        	<div class="form-group">
				            <label class="control-label col-md-2">Menu</label>
				            <div class="col-md-3">
				             	<select class="form-control" name="nombreMenu" id="nombreMenu">
								</select>
				            </div>
	   		          	</div>

	   		          	<br>
		   		        <div style="margin-left: 38%;">
				       		<br>		       		
				       		<button class="btn btn-primary" id="agregar">Agregar a Perfil</button> 	
				       		<button class='btn btn-primary' style='width: 27%;' id='cerrarMenu'> Cancelar </button>	       		
				       	</div>	
				       	<span  id="msgboxError" style="color: red;"></span>
				       	<span  id="msgboxOk" style="color: green;"> </span>	

		        	</div>

		        	<div class="form-horizontal"  id="AsignadoCorrecto">
		        		<div class="col-md-3 mostrarForm" style="margin-top: 2em; margin-left: 4%;">
		        			<label class="textoSuccess"> Se ha Asignado el menu correctamente</label>	
			        	</div>       	
			        	<div class="col-md-3" style="margin-left: 41%;">		        
			        		<button class="btn btn-primary" id="CloseSuccess"> Aceptar </button> 
			        	</div>

		        	</div>	


		        				
		 		</div>

		 		
			     
				</div>
			</div>
		</div>
	      		
		</div>
	</body>
</html>