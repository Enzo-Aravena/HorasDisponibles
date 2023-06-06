<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
	<link href="css/farmacia.css" media="all" rel="stylesheet" type="text/css" />
	
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<script src="../../../lib/jquery-1.12.4.js"></script>
	<!--  EXTRAE TODA LA DATA DL COMPONENTE PRINCIPAL-->
	<?php include_once("../../../lib/components.php");?>
	<!-- load jQuery and tablesorter scripts -->
	<script type="text/javascript" src="../../../lib/jquery/jquery.tablesorter.min.js"></script>
	<!-- tablesorter widgets (optional) -->
	<script type="text/javascript" src="../../../lib/jquery/jquery.tablesorter.widgets.js"></script>
	<script src="../controlador/cliente/controladorFarmacia.js?id=88"></script>
	<script src="js/navegadorFarmacia.js?id=88"></script>
</head>
<body>
	<div class="widget-container padded">
		<input type='hidden' value='<?php echo $_SESSION['permisos'];?>' id='permisos'>

		<div class="widget-content padded">
			<ul class="nav nav-tabs">
		     	<li><a data-toggle="tab" href="#tab1" id="tabla1"> <i> <img src="../../../lib/images/farmacias.png" width="18px;" ></i>  Farmacia </a></li>
		        <li><a data-toggle="tab" href="#tab2" id="tabla2" ><i class="glyphicon glyphicon-book"></i> inasistente retiro Medicamentos </a></li>
		    </ul>

		    <div class="tab-content">
	        	<div class="tab_content" id="tab1">
	        		<div class="form-horizontal"> &nbsp;</div>
	        		<div class="form-horizontal">
						<div class="col-md-13">
							<div class="form-group">
								<label class="control-label col-md-1"> Seleccione Fecha :</label>
								<div class="col-md-2">
									<div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy"  id="desde" >
										<input class="form-control" type="text" name="desde" style="height: 28px !important;" autocomplete="off"/>
										<span class="input-group-addon">
										<i class="fa fa-calendar"></i>
										</span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy"  id="hasta">
										<input class="form-control" type="text" name="hasta" style="height: 28px !important;" autocomplete="off"/>
										<span class="input-group-addon">
										<i class="fa fa-calendar"></i>
										</span>
									</div>
								</div>

						        <div class="col-md-3">
								        <label class="control-label col-md-3 texto" style="text-align: left;width: 32%;">
								        Medicamento
								    	</label>
								        <div class="col-md-8">
							              <select class="selectpicker" id="medicamento" name="medicamento" data-show-subtext="true" data-live-search="true" multiple></select>
								        </div>
								</div>

								<div class="col-md-1">
									<button class="btn btn-primary" id="ejecutar">Buscar</button>
								</div>

								<div class="col-md-2">
									<button class="btn btn-success" id="abrirPopUp">Manual de Usuario</button>
								</div>
							</div>
						</div>
					</div>

					<div class="form-horizontal">
						<div class="col-md-13">
							<div class="form-group">
								<div class="col-md-9">
									<label class="control-label col-md-1">Centro</label>
									<label class="radio-inline" style="margin-right: 7px !important;">
										<input name="rdbBuscar" type="radio" value="0" checked onClick="buscarData();">
										<span style="font-size: 14px;">Todos</span>
									</label>

									<label class="radio-inline">
										<input name="rdbBuscar" type="radio" value="3" onClick="buscarData();">
										<span style="font-size: 14px;">S.L</span>
									</label>

									<label class="radio-inline">
										<input name="rdbBuscar" type="radio" value="1" onClick="buscarData();">
										<span style="font-size: 14px;">C.U</span>
									</label>

									<label class="radio-inline">
										<input name="rdbBuscar" type="radio" value="2" onClick="buscarData();">
										<span style="font-size: 14px;">L.F</span>
									</label>

									<label class="radio-inline">
										<input name="rdbBuscar" type="radio" value="4" onClick="buscarData();">
										<span style="font-size: 14px;">L.H</span>
									</label>

									<label class="radio-inline">
										<input name="rdbBuscar" type="radio" value="5" onClick="buscarData();">
										<span style="font-size: 14px;">C.S.H</span>
									</label>

									<label class="radio-inline">
										<input name="rdbBuscar" type="radio" value="12" onClick="buscarData();">
										<span style="font-size: 14px;">P.G.W</span>
									</label>

									<label class="radio-inline">
										<input name="rdbBuscar" type="radio" value="13" onClick="buscarData();">
										<span style="font-size: 14px;">L.T</span>
									</label>
								</div>
							</div>
						</div>
					</div>

					<div class="form-horizontal">
						<div class="col-md-13">
							<div class="form-group">
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label col-md-3">Crítico</label>
										<div class="col-md-4">
											<label class="checkbox-inline"><input type="checkbox" id="criticoSi" name="criticoSi" onClick="buscarData();"><span>SI</span></label>
										</div>
									</div>
								</div>

								<div class="col-md-3" id="ExportarData">
									<button class="btn btn-default" name="boton" style="width: 14em;">
										<i class="fa fa-download"></i>
										<label style="color:#007aff;" id="descargar"> Descargar Archivo </label>
									</button>
								</div>
							</div>
						</div>
					</div>

					<div class="form-horizontal"></div>
					<br>
					<div class="form-horizontal">
						<br>
		       			<table  class="table table-bordered table-hover tablesorter" id="example">
				       		<thead>
				       			<th></th>
		            			<th>Fecha</th>
		            			<th>Centro</th>
		            			<th>Codigo</th>
		            			<th>Medicamento</th>
		            			<th>Stock Inicial</th>
		            			<th>Ingresos</th>
		            			<th>Dispensados</th>
		            			<th>Egresos</th>
		            			<th>Stock Final</th>
		            			<th>Máximo</th>
		            			<th>N Crítico</th>
		            			<th>Crítico</th>
		            			<th>Solicitar</th>
				       		</thead>
				       		<tbody id="tabla_resultados">
				       		</tbody>
				       	</table>
				    </div>

				   <!--<div class="form-horizontal">
				   		<div class="col-md-3"></div>
				   		<div class="col-md-6">
				    		<ul class="pagination pagination-lg pager" id="myPager"></ul>
				    	</div>
				   </div>-->

				   <!--- <table class="table table-striped table-bordered" id="tabla_resultados" style="width:100%"></table>-->

				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header" style="background: #007aff;">
								<button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
								<h4 class="modal-title" style="color:white;">Stock Farmacia</h4>
							</div>
							<div class="modal-body" style="text-align: center;">
								<label class="control-label" id="mensaje"></label>
							</div>
							<div class="modal-footer">
								<button type="button" style="background: #007aff;" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>
				<!-- MODAL QUE CORRESPONDE AL MANUAL DE USUARIO  -->
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
										 -Al ingresar al módulo de auditoria, se puede apreciar a la pestaña farmacia, se carga el stock de los medicamentos correspondientes al dia de ayer.<br />
									</label>
									<br>
									<img src="../../../lib/images/manuales/farmacia/inicio.png" width="850" />
								</div>
								<br>
								<div class="col-md-12">
									<label>
										- Al ingresar al modulo se puede buscar por una fecha o rango de fechas 
									</label>
									<br>
									<img src="../../../lib/images/manuales/farmacia/fecha1.png" width="600" />
									<br>
									<img src="../../../lib/images/manuales/farmacia/fecha2.png" width="600" />
									
								</div>
								<br>
								<div class="col-md-12">
									<label>
										- Usted puede filtrar un medicamento por el nombre o por el código
									</label>
									<br>
									<img src="../../../lib/images/manuales/farmacia/medicamento.png" width="600" />
									<br>
									<img src="../../../lib/images/manuales/farmacia/codigo.png" width="600" />
									
								</div>
								<br>
								<div class="col-md-12">
									<label>
										- Puede filtrar además por el centro al cual pertenece
									</label>
									<br>
									<img src="../../../lib/images/manuales/farmacia/centro.png" width="600" />
									
								</div>
								<br>
								<div class="col-md-12">
									<label>
										- Si el medicamento es crítico o no al hacer click en el ítem de crítico
									</label>
									<br>
									<img src="../../../lib/images/manuales/farmacia/critico.png" width="200" />
									
								</div>
								<br>
								<div class="col-md-12">
									<label>
										-  Al descargar el archivo usted podrá encontrar el detalle de lo que ha filtrado en el portal 
									</label>
									<br>
									<img src="../../../lib/images/manuales/farmacia/descarga.png" width="600" />
									
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" style="background: #007aff;" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>
	        </div>

			<div class="tab_content" id="tab2">
				<iframe src="inaRetMedicamento.php" style="width: 99%;height: 120em;border: none;overflow: hidden;">
				</iframe>
			</div>
			</div>
		</div>
	</div>
</body>
</html>					