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

	<script src="../controlador/cliente/searchtoModify.js"></script>	
	<script src="js/confirmacion.js"></script>

	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
</head>
	<body id="contenido">
		<div class="container-fluid main-content"  style="margin-top: 2%;" id="createMenu" data-role="popup" data-theme="a" class="ui-corner-all">
		<div class="row" id="modificano">
		  <div class="col-md-12">
			    <div class="widget-container">
			    	<div class="heading">
				        <i class="fa fa-user"></i>
				        <label style="margin-left: 1%;"> Modificar Contraseña</label>
				      </div>
				      <div class="widget-content padded">
				        <div id="validate-form">
				          <fieldset>
				            <div class="row" id="ModificarData">
				            	<label>Modificación para el usuario: <label id="usuarios"></label></label>

				            	<!-- PRIMERA COLUMNA-->
								<div class="col-md-4">
									<div class="form-group">
					                  <label for="clave">Contraseña</label>
					                  <input class="form-control" id="clave" name="clave" type="text" placeholder="contraseña">
					                </div>		                             
				             	</div>

				            </div>
				            <div class="row" id="ModificarData">
				            	<!-- PRIMERA COLUMNA-->
								<div class="col-md-4">
									<div class="form-group">
					                  <label for="reingClave">Reingrese Su Contraseña</label>
					                  <input class="form-control" id="reingClave" name="reingClave" type="text" placeholder="contraseña">
					                </div>		                             
				             	</div>
				             	
				            </div>

				             <div id="pswd_info">								   
							    <ul>
							      <li id="minuscula" class="incorrecto"> Debe contener <strong> minúsculas </strong>
							      </li>
							      <li id="mayuscula" class="incorrecto"> Debe contener <strong>una Mayúscula</strong>
							      </li>
							      <li id="numero" class="incorrecto"> Debe contener <strong>un Número</strong>
							      </li>
							      <li id="largo" class="incorrecto"> Debe contener <strong>8 caracteres</strong>
							      </li>
							    </ul>
						  	</div>
				            
				        <div style="margin-left: 29%;margin-top: 5%;">
				       		<button style="width: 30%;" class="btn btn-primary" id="aceptar">
				       		Aceptar
				       		</button>     		
				       		<button class='btn btn-primary' style='width: 28%;' id='cerrar'> Cancelar </button>				       		
			       		</div>
			       		<span  id="msgboxError" style="color: red;"> </span>
				       	<span  id="msgboxOk" style="color: green;"> </span>				       	
			            </fieldset>

			         </div>
			       
			  </div>			     
		  </div>
		</div>
		</div>
	      		
		<div id="datos">					
		</div>

		</div>
	</body>
</html>