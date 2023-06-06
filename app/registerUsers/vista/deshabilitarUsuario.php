<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
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

	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<script src="../../../lib/js/jquery.dataTables.min.js" type="text/javascript"></script>	
	<script src="../../../lib/js/datatable-editable.js" type="text/javascript"></script>
	<script src="../../../lib/js/bootstrap-fileupload.js" type="text/javascript"></script>
	<script src="../../../lib/js/modernizr.custom.js"></script>


	<script src="../controlador/cliente/estadoController.js"></script>	
	<script src="js/estado.js"></script>

	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
</head>
	<body>
		<div class="container-fluid main-content"  style="margin-top: 2%;" id="createMenu" data-role="popup" data-theme="a" class="ui-corner-all">

		<div class="row" id="modificano">
		  <div class="col-md-12">
		    <div class="widget-container">
		       <div class="heading">
			        <i class="glyphicon glyphicon-th-large"></i>
			        <label style="margin-left: 1%;"> Deshabilitar Usuario</label>
		       </div>

		        <div class="widget-content padded">
		        <div class="form-group">
                  <label for="username">Estado</label>
                  <select class="form-control" style="cursor: pointer;" name="estado" id="estado">
		              <option value="0"> Seleccione ... </option>
				      <option value="A">Activo</option>
				      <option value="B"> Bolqueado</option>      
	          	  </select>
                </div>				   			             	
		        </div>
		       	<div style="margin-left: 29%;">
		       		<button style="width: 30%;" class="btn btn-primary" id="deshabilitar">
		       		Aceptar
		       		</button>     		
		       		<button class='btn btn-primary' style='width: 28%;' id='cerrar'> Cancelar </button>
		       	</div>

		       		<span  id="msgboxError" style="color: red;margin-left: 19%;"> </span>
		       		<span  id="msgboxOk" style="color: green;margin-left: 19%;"> </span>	
		  </div>
			     
				</div>
		 </div>

		 	<div id="datos">					
			</div>
		</div>
	      		
	</body>
</html>