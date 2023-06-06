<?php include_once("../../../lib/seguridad.php"); ?>
<!DOCTYPE html>
<html>

<head>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
	<meta http-equiv="Expires" content="Mon, 26 Jul 1997 05:00:00 GMT">
	<meta http-equiv="Pragma" content="no-cache">
	<link href="../../../lib/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/datepicker.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/se7en-font.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/style.css" media="all" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" media="all" rel="stylesheet" type="text/css" />
	<script src='../../../lib/jquery-3.2.1.min.js'></script>

	<script src="../../../lib/jquery-1.12.4.js"></script>
	<script src="../../../lib/jquery-ui.js"></script>
	<script src="../../../lib/highChart/highcharts.js"></script>
	<script src="../../../lib/highChart/data.js"></script>
	<script src="../../../lib/highChart/series-label.js"></script>
	<script src="../../../lib/highChart/exporting.js"></script>
	<script src="../../../lib/highChart/export-data.js"></script>
	<script src="../../../lib/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
	<script src="../../../lib/js/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="../../../lib/js/jquery.validate.js" type="text/javascript"></script>
	<script src="../../../lib/js/date.js" type="text/javascript"></script>
	<script src="../../../lib/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../../../lib/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
	<script src="../../../lib/js/modernizr.custom.js" type="text/javascript"></script>
	<script src="../../../lib/js/date.js" type="text/javascript"></script>
	<script src="js/navegadorContenido.js"></script>
</head>

<body>
	<div class="widget-container padded">
		<div class="widget-content padded">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#tab1">Ocupación Morbilidad Diaria</a></li>
				<li><a data-toggle="tab" href="#tab2">GDA Detalle Llamadas Diarias </a></li>
				<li><a data-toggle="tab" href="#tab3">Agendados Morbilidad Mensual</a></li>
				<li><a data-toggle="tab" href="#tab4">Horas Disponibles</a></li>

			</ul>

			<div class="tab-content">
				<div class="tab_content" id="tab1">
					<div class="form-horizontal" id="miFormulario">
						<div class="form-horizontal"> &nbsp; </div>
						<div class="form-horizontal">
							<div class="col-md-13">
								<div class="form-group">
									<label class="control-label col-md-1"> Seleccione Fecha :</label>
									<div class="col-md-2">
										<div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy" id="fecha1">
											<input class="form-control" type="text" name="fecha1" style="height: 28px !important;" autocomplete="off" />
											<span class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</span>
										</div>
									</div>
									<div class="col-md-2">
										<div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy" id="fecha2">
											<input class="form-control" type="text" name="fecha2" style="height: 28px !important;" autocomplete="off" />
											<span class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</span>
										</div>
									</div>
									<div class="col-md-1">
										<button class="btn btn-primary" id="ejecutar">Buscar</button>
									</div>

									<div class="col-md-3">
										<label class="control-label col-md-4" style="text-align: left;">
											Acto Tabla
										</label>
										<div class="col-md-12">
											<label class="radio-inline"><input name="TABLA" type="radio" id="button_morbt" value="1" checked="CHECKED"><span>MORBT</span></label>
											<label class="radio-inline"><input name="TABLA" type="radio" id="button_morbi" value="2"><span>MORBI</span></label>
										</div>
									</div>

									<div class="col-md-1" id="ExportarData">
										<button class="btn btn-default" name="boton">
											<i class="fa fa-download"></i>
											<label style="color:#007aff;" id="descargar"> Descargar Archivo </label>
										</button>
									</div>
								</div>
							</div> <!-- END FORM GROUP -->
						</div>

						<div class="form-horizontal">
							<div class="col-md-13">
								<div class="form-group">
									<label class="control-label col-md-1" style="width: 4%;">
										Centro
									</label>
									<div class="col-md-6">
										<div class="col-md-12">
											<label class="radio-inline">
												<input name="centro" type="radio" id="stats-sites-0" value="0" onClick="getAjaxData()" checked>
												<span>Todos</span>
											</label>

											<label class="radio-inline">
												<input name="centro" type="radio" id="stats-sites-3" value="3" onClick="getAjaxData()">
												<span>S.L</span>
											</label>

											<label class="radio-inline">
												<input name="centro" type="radio" id="stats-sites-1" value="1" onClick="getAjaxData()">
												<span>C.U</span>
											</label>

											<label class="radio-inline">
												<input name="centro" type="radio" id="stats-sites-2" value="2" onClick="getAjaxData()">
												<span>L.F</span>
											</label>

											<label class="radio-inline">
												<input name="centro" type="radio" id="stats-sites-4" value="4" onClick="getAjaxData()">
												<span>L.H</span>
											</label>

											<label class="radio-inline">
												<input name="centro" type="radio" id="stats-sites-5" value="5" onClick="getAjaxData()">
												<span>C.S.H</span>
											</label>

											<label class="radio-inline">
												<input name="centro" type="radio" id="stats-sites-6" value="12" onClick="getAjaxData()">
												<span>P.G.W</span>
											</label>

											<label class="radio-inline">
												<input name="centro" type="radio" id="stats-sites-6" value="13" onClick="getAjaxData()">
												<span>L.T</span>
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<label class="control-label col-md-4" style="text-align: left;">
											Acto Grafico
										</label>
										<div class="col-md-8">
											<label class="checkbox-inline"><input type="checkbox" name="MORBT" id="acto_morbt" value="1" checked><span>MORBT</span></label>
											<label class="checkbox-inline"><input type="checkbox" name="MORBI" id="acto_morbi" value="2" checked><span>MORBI</span></label>
										</div>
									</div>

								</div>
							</div>
							<br>
						</div>

						<div class="form-horizontal" style="margin-top: -1.5%;">
							<div class="form-group">
								<div class="col-md-8">
									<label class="control-label col-md-1" style="text-align: left;">
										Semana
									</label>

									<div class="col-md-10">
										<label class="radio-inline">
											<input type="radio" name="semana" id="stats-sites-7" value="0" onClick="getAjaxData()" checked>
											<span style="font-size: 14px;">Todos</span>
										</label>

										<label class="radio-inline">
											<input type="radio" name="semana" id="stats-sites-8" value="1" onClick="getAjaxData()">
											<span>Lunes </span>
										</label>

										<label class="radio-inline">
											<input type="radio" name="semana" id="stats-sites-9" value="2" onClick="getAjaxData()">
											<span>Martes </span>
										</label>

										<label class="radio-inline">
											<input type="radio" name="semana" id="stats-sites-10" value="3" onClick="getAjaxData()">
											<span>Miercoles </span>
										</label>

										<label class="radio-inline">
											<input type="radio" name="semana" id="stats-sites-11" value="4" onClick="getAjaxData()">
											<span>Jueves </span>
										</label>

										<label class="radio-inline">
											<input type="radio" name="semana" id="stats-sites-12" value="5" onClick="getAjaxData()">
											<span>Viernes </span>
										</label>

										<label class="radio-inline">
											<input type="radio" name="semana" id="stats-sites-13" value="6" onClick="getAjaxData()">
											<span>Sabado </span>
										</label>
									</div>
								</div>

							</div>
							<div class="form-horizontal">
								<div class="form-group">
									<div class="col-md-2">
										<button class="btn btn-success" id="abrirPopUp">Manual de Usuario</button>
									</div>
								</div>
							</div>

						</div>
					</div>
					<!-- ---------------------------------  INICIO GRAFICO ------------------------------------ -->
					<div class="form-horizontal">
						<div class="form-group">
							<div class="col-md-1"></div>
							<div class="col-md-8">
								<div id="container">
								</div>
							</div>
							<div class="col-md-1"></div>
						</div>
					</div>
					<!-- ---------------------------------  FIN GRAFICO  --------------------------------------- -->
					<!-- ---------------------------------  INICIO TABLA DATA ---------------------------------- -->
					<div class="form-horizontal">
						<div class="form-group">
							<div class="col-md-1"></div>
							<div class="col-lg-8">
								<label id="guardaDatos"></label>
								<div id="divTabla">
									<table class="table" style="    width: 0;">
										<thead class='cabeceraPrincipal' id="tituloPrincipal">
										</thead>
										<thead class='cabeceraPrincipal' id="CabeceraTabla">
										</thead>
										<tbody id="tabla_resultados" style="padding: none !important;">
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background: #007aff;">
									<button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
									<h4 class="modal-title" style="color:white;">Ocupacion Morbilidad Diaria</h4>
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
											- Este módulo, muestra el total de atenciones que se realizaron en los cesfam de la comuna.<br />
										</label>
										<br>
										<img src="../../../lib/images/manuales/ocupacionMorb/inicio.png" width="850" />
									</div>
									<br>
									<div class="col-md-12">
										<label>
											- En este módulo, se pueden buscar por una fecha o por rangos de fecha
										</label>
										<br>
										<img src="../../../lib/images/manuales/ocupacionMorb/fecha1.png" width="800" />
										<br>
										<img src="../../../lib/images/manuales/ocupacionMorb/fecha2.png" width="800" />
									</div>
									<br>
									<div class="col-md-12">
										<label>
											- Se puede filtrar por el acto de la tabla, la cual se puede filtrar por MORBT y MORBI
										</label>
										<br>
										<img src="../../../lib/images/manuales/ocupacionMorb/actoTabla.png" width="800" />
									</div>
									<br>
									<div class="col-md-12">
										<label>
											- Se puede filtrar por el acto grafico, la cual se puede filtrar por MORBT y MORBI
										</label>
										<br>
										<img src="../../../lib/images/manuales/ocupacionMorb/actograf1.png" width="800" />
										<br>
										<img src="../../../lib/images/manuales/ocupacionMorb/actograf2.png" width="800" />

									</div>

									<div class="col-md-12">
										<label>
											- Se puede filtrar por centro
										</label>
										<br>
										<img src="../../../lib/images/manuales/ocupacionMorb/centro.png" width="800" />
									</div>

									<div class="col-md-12">
										<label>
											- se puede filtrar por semana o por dia
										</label>
										<br>
										<img src="../../../lib/images/manuales/ocupacionMorb/semana.png" width="800" />
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
					<iframe src="GDADetalleLlamadaDiaria.php" style="width: 99%;height: 90em;border: none;overflow: hidden;">
					</iframe>
				</div>


				<div class="tab_content" id="tab3">
					<iframe src="AgendadoMorbMensual.php" style="width: 99%;height: 90em;border: none;overflow: hidden;">
					</iframe>
				</div>


				<div>
					<div class="tab_content" id="tab4">

						<iframe src="HorasRest.php" style="width: 99%;height: 90em;border: none;overflow: hidden;">

						</iframe>
					</div>
					<div class="tab_content" id="tab5">

						<iframe src="HorasRestActo.php" style="width: 99%;height: 90em;border: none;overflow: hidden;">
						</iframe>
					</div>
				</div>

				<!--<div class="tab_content" id="tab3">
	        		<iframe src="reporteOcupMorb.php" style="width: 99%;height: 84em;border: none;overflow: hidden;">
	        		</iframe>
	        	</div>-->

			</div>
		</div>
	</div>
</body>

</html>