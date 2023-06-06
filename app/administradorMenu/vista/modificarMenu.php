<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html style="overflow: hidden;">
<head>
<meta charset="UTF-8">
<link href="../../../lib/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />   
	<link href="../../../lib/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/se7en-font.css" media="all" rel="stylesheet" type="text/css" />  
	<link href="../../../lib/css/style.css" media="all" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/estiloCrear.css">
	<!-- bootstrap para subir archivo-->
	<link href="../../../lib/css/bootstrap-editable.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/jquery.fileupload-ui.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/datatables.css" media="all" rel="stylesheet" type="text/css" />

	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<script src="../../../lib/js/jquery.dataTables.min.js" type="text/javascript"></script>	
	<script src="../../../lib/js/datatable-editable.js" type="text/javascript"></script>
	<script src="../../../lib/js/bootstrap-fileupload.js" type="text/javascript"></script>
	<script src="../../../lib/js/modernizr.custom.js"></script>


	<script src="../controlador/cliente/controladorAcceso.js"></script>	
	<script src="js/navMod.js"></script>

	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
</head>
	<body>
		<div class="container-fluid main-content"  style="margin-top: 2%;" id="createMenu" data-role="popup" data-theme="a" class="ui-corner-all">

		<div class="row" id="dataPrincipal">
		  <div class="col-md-12">
		    <div class="widget-container">
		       <div class="heading">
			        <i class="glyphicon glyphicon-pencil"></i>
			        <label style="margin-left: 1%;"> Modificar Menu</label>
		       </div>	      

		     <div class="widget-content padded">
		        <div class="form-horizontal"> 
		        	<input class="form-control"  id="idmenu" type="hidden" >
		        	<div class="form-group">
			            <label class="control-label col-md-2">Nombre del menu</label>
			            <div class="col-md-5">
			              <input class="form-control"  id="nombre" type="text"  autocomplete="off">
			            </div>
   		          	</div>

   		          	<div class="form-group">
			            <label class="control-label col-md-2">Ruta del Archivo</label>
			            <div class="col-md-5">
			              <input class="form-control" placeholder="ej: ejemplo/vista/tst.php" id="detalleRuta" type="text" autocomplete="off">
			            </div>
   		          	</div>

   		          	<div class="form-group">
		            	<label class="control-label col-md-2">Seleccione Icono Menu</label>
			            <div class="col-md-3">
			              <div class="fileupload fileupload-new" data-provides="fileupload" id="image">
			               <span class="btn btn-default btn-file"><span class="fileupload-new">
			                Seleccione Una Imagen
			            	</span>
			                <span class="fileupload-exists">Cambiar Imagen</span>
			                <input type="file" id="imagen" accept="image/*"></span>
			                <span class="fileupload-preview"></span>
			                <button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">&times;</button>	          
			              </div>

			            </div>
			            
			            <div class="col-md-3" style="margin-top: -4%; margin-left: 48%;">		
			            	<!--<input type="text" name="" id="mostrar">-->
			            	<label class="control-label col-md-2" id="mostrar">. </label>
			                <label class="control-label col-md-2" id="estado">. </label>

  

			            </div>
		          </div>             	
		        </div>
		       	<div style="margin-left: 26%;">
		       		<br>
		       		<button class="btn btn-primary" id="modificarMenu">Modificar Menu</button> 
		       		<button class='btn btn-primary' style='width: 27%;' id='cerrarMenu'> Cancelar </button> 		       		
		       	</div>	
		       	<span  id="msgboxError" style="color: red;"> </span>
		       	<span  id="msgboxOk" style="color: green;"> </span>
		  </div>
			     
				</div>
			</div>
		</div>
		<!-- end row -->

		<div id="contenido">
			
		</div>


		<div id="MensajeModificacion">
			<div class="form-horizontal">
	        	<div class="col-md-3 mostrarForm" style="margin-top: 7em; margin-left: 16%;">
	        		<label class="textoSuccess"> Se ha ingresado correctamente</label>	
	        	</div>       	
	        	<div class="col-md-3" style="margin-left: 41%;">		        
	        		<button class="btn btn-primary" id="CloseSuccess"> Aceptar </button> 
	        	</div>
		    </div>
			
		</div>
	      		
		</div>
	</body>
</html>