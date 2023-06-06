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
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

	<!-- (Optional) Latest compiled and minified JavaScript translation files -->
	<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>-->
	
	<script src="../controlador/cliente/controladorActualizacionStock.js"></script>
	<script src="js/navActualizacionStock.js"></script>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		

	<style type="text/css">
		.bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    	    width: 50em !important;
    	}
	</style>
</head>
	<body>
		<input type='hidden' value='<?php echo $_SESSION['centro'];?>' id='centro'>
		<input type='hidden' value='<?php echo $_SESSION['permisos'];?>' id='permisos'>
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
		    		<br>
		    		<div class="form-horizontal"> &nbsp;</div>
				       	<div class="form-horizontal">
				       		<div class="row">
				       			<div class="col-md-6">
			       					<div class="form-group">			            	  
								        <label class="control-label col-md-3">Medicamento  </label>
								        <div class="col-md-8" class="medicina">
										<select class="selectpicker" id="medicamento" name="medicamento" data-show-subtext="true" data-live-search="true" multiple>
										</select>
								        </div>
							    	</div>
				       			</div>
				       					       					       		
				       			<div class="col-md-3">
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
								              	<option value="103"> PADRE GERARDO W FARMACIA </option>
												<option value="106"> LAS TORRES FARMACIA </option>
								              	<option value="36"> COSAM FARMACIA </option>
					            			</select>
							            </div>
							        </div>	
				       			</div>	
				       			<div class="col-md-1">
				       				<button type="button" class="btn btn-primary" id="ejecutar"> Buscar </button>
				       			</div>
				       		</div>			       		
				       	</div>
		    		<br>
			       	<br>
			       	<br>
			       	<div class="form-horizontal" id="espacio"> &nbsp;</div>

			       	<div class="form-horizontal" id="tablaContent">
			       		<table class="table table-bordered table-striped" ><!--id="datatable-editable">.-->
							<thead>
								<th> </th>
								<th>Almacen</th>
								<th>Código</th>
								<th>Medicamento</th>
								<th>Stock Máximo</th>
								<th>Stock Crítico</th>
								<!--<th></th>-->
							</thead>
							<tbody id="tabla_resultados">
							</tbody>
              			</table>

			       	</div>
			       	<div class="form-horizontal" id="botonModificar">
			       		<div class="col-md-9"></div>
			       		<div class="col-md-1">
		       				<button type="button" class="btn btn-primary" id="modificarStock"> Modificar </button>
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
									<img src="../../../lib/images/manuales/ActualizacionStock/inicio.png" style="display:block;margin:auto;min-width: 20em;width: 50em;" />
								</div>
								<br>
								<div class="col-md-12">
									<label>
										- Para modificar el stock de los medicamentos de su centro debe seleccionar los medicamentos buscando en el seleccionador y buscar el que necesite modificar, sin mensionar que su centro aparecerá por defecto. Como se muestra en la siguiente imagen:
									</label>
									<br>
									<img src="../../../lib/images/manuales/ActualizacionStock/medicamento.png"  style="display:block;margin:auto;min-width: 20em;width: 43em;" />
								</div>
								<br>
								<div class="col-md-12">
									<label>										
										- Al presionar el boton buscar, muestra el resultado de los medicamentos buscados asociados a su centro, como se muestra en la imagen:
									</label>
									<br>
									<img src="../../../lib/images/manuales/ActualizacionStock/resultado.png" style="display:block;margin:auto;min-width: 20em;width: 46em;" />
								</div>
								<br>
								<div class="col-md-12">
									<label>
										- Al presionar el botón Modificar, el sistema procesa y actualiza los datos ingresados en el sistema que podrán ser vistos al día siguiente de haber ingresado los datos y  se muestra finalmente el mensaje que se refleja en la siguiente imagen:
									</label>
									<br>
									<img src="../../../lib/images/manuales/ActualizacionStock/correcto.png" style="display:block;margin:auto;min-width: 20em;width: 35em;" />
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