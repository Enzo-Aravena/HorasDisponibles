<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />	
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		

	<link href="css/stilosCss.css" media="all" rel="stylesheet" type="text/css" />
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
		<!--  EXTRAE TODA LA DATA DL COMPONENTE PRINCIPAL-->
	<?php include_once("../../../lib/components.php");?>
	<script src="../controlador/cliente/controladorActualizacionStock.js"></script>
	<script src="js/navActualizacionStock.js"></script>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
</head>
	<body>
		<div class="row">
		  <div class="col-md-12">
		    <div class="widget-container">
		      <div class="heading">
		        <i class="glyphicon glyphicon-edit"></i>
		        <label style="margin-left: 1%;"> Actualización Stocks Farmacia</label>
		      </div>
		       <div class="widget-content padded">
		       	<div class="form-horizontal"> &nbsp;</div>
	    		<div class="form-horizontal">
	    			<div class="col-md-2">
						<button class="btn btn-success" id="abrirPopUp">Manual de Usuario</button>
					</div>
	    		</div>
		       	<div class="form-horizontal"> &nbsp;</div>
		       	<div class="form-horizontal">
		       		<div class="row">
		       			<div class="col-md-3">
	       					<div class="form-group">			            	  
						        <label class="control-label col-md-3">Medicamento  </label>
						        <div class="col-md-8" class="medicina">
					              <select class="select2able" name="medicamento" id="medicamento">
					              	<option value ="0"> Seleccione ...</option>
					              </select>
						        </div>
					    	</div>
					        <div class="form-group">
					            <label class="control-label col-md-3"> Almacén  </label>
					            <div class="col-md-8">
					                <select class="form-control" name="almacen" id="almacen">
						              	<option value ="0"> Seleccione ...</option>
						              	<option value="3"> LO HERMIDA FARMACIA </option>
						              	<option value="4"> CARDENAL SILVA H. FARMACIA </option>
						              	<option value="6"> CAROL URZUA FARMACIA </option>
						              	<option value="8"> LA FAENA FARMACIA </option>
						              	<option value="10"> SAN LUIS FARMACIA </option>
						              	<option value="36"> COSAM FARMACIA </option>
			            			</select>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-3">Stock Máximo </label>
					            <div class="col-md-8">
					              <input class="form-control" placeholder="Ingrese Máximo" type="text"  id="maximo" autocomplete="off">
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-3">Stock Crítico  </label>
					            <div class="col-md-8">
					              <input class="form-control" placeholder="Ingrese Crítico" type="text" id="critico"  autocomplete="off">
					            </div>
					        </div>

						</div>

						<div class="col-md-3">
			            	<label class="control-label col-md-3"> Código </label>
							<div class="col-md-6">
								<input class="form-control" id="codigo" name="codigo" type="text" placeholder="Ingrese Código" autocomplete="off">
							</div>
		            	</div>
		       		</div>
		       	</div>

		       	<div class="form-horizontal"> &nbsp;</div>
		       	<div class="form-horizontal">
		       		<div class="col-md-3"></div>
		       		<div class="col-md-3">
		       			<button class="btn btn-primary" id="ejecutar">Actualizar Stock</button>
		       		</div>
		       	</div>
								        
				</div> <!-- DIV PRINCIPAL-->


				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header" style="background: #007aff;">
								<button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
								<h4 class="modal-title" style="color:white;">Stock Farmacia</h4>
							</div>
							<div class="modal-body" style="text-align: center;">
								<label class="control-label" id="mensaje">

								</label>
							</div>
							<div class="modal-footer">
								<button type="button" style="background: #007aff;" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade" id="manualUsuario" role="dialog">
					<div class="modal-dialog" style="width: 50%;">
						<div class="modal-content">
							<div class="modal-header" style="background: #007aff;">
								<button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
								<h4 class="modal-title" style="color:white;">Manual de usuario</h4>
							</div>
							<div class="modal-body" style="height:400px; overflow:auto;">
								<div class="col-md-12">
									<label>
										 - En el módulo de actualización de stock, usted puede actualizar el stock de su centro, sin tener la necesidad de solicitar a registro clínico la actualización de esta. El formulario es el  que se muestra a continuación:<br />
									</label>
									<br>
									<img src="../../../lib/images/manuales/ActualizacionStock/inicio.png" style="display:block;margin:auto;min-width: 20em;width: 35em;" />
								</div>
								<br>
								<div class="col-md-12">
									<label>
										-Al completar el formulario, usted podrá escoger entre las opciones de escribir el código del medicamento o buscarlo en el campo seleccionable con filtro, debe completar los demás campos como el almacén que muestra la farmacia del centro al cual usted pertenece, el stock máximo y crítico de ese medicamento, como se muestra en la siguiente imagen.
									</label>
									<br>
									<img src="../../../lib/images/manuales/ActualizacionStock/actualizaer.png"  style="display:block;margin:auto;min-width: 20em;width: 35em;" />
								</div>
								<br>
								<div class="col-md-12">
									<label>
										- Al presionar el botón Actualizar stock, el sistema procesa y actualiza los datos ingresados en el sistema que podrán ser vistos al día siguiente de haber ingresado los datos y  se muestra finalmente el mensaje que se refleja en la siguiente imagen:
									</label>
									<br>
									<img src="../../../lib/images/manuales/ActualizacionStock/actualiza.png" style="display:block;margin:auto;min-width: 20em;width: 35em;" />
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" style="background: #007aff;" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>
				
		    </div>
		  </div>
		</div>
	</body>
</html>