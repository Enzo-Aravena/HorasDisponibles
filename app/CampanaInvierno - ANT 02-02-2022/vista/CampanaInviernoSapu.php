<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
		<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">	
	<meta http-equiv="Expires" content="Mon, 26 Jul 1997 05:00:00 GMT">
	<meta http-equiv="Pragma" content="no-cache">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="../../../lib/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />   
	<link href="../../../lib/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/datepicker.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/se7en-font.css" media="all" rel="stylesheet" type="text/css" />  
	<link href="../../../lib/css/style.css" media="all" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" media="all" rel="stylesheet" type="text/css" />
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<script src="../../../lib/jquery-1.12.4.js"></script>
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script src="../../../lib/jquery-ui.js"></script>
  	<script src="../../../lib/highChart/highcharts.js"></script>
	<script src="../../../lib/highChart/data.js"></script>
	<script src="../../../lib/highChart/series-label.js"></script>
	<script src="../../../lib/highChart/exporting.js"></script>
	<script src="../../../lib/highChart/export-data.js"></script>
	<script src="../../../lib/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
	<script src="../../../lib/js/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="../../../lib/js/jquery.validate.js" type="text/javascript"></script>
	<script src="../../../lib/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../../../lib/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
	<script src="../../../lib/js/modernizr.custom.js" type="text/javascript"></script>
	<script src="../../../lib/js/date.js" type="text/javascript"></script>
	<script src="js/navegadorCampanaSapu.js"></script>
</head>
	<body>
	<div class="widget-container padded">
		<div class="widget-content padded">
						<div class="loader" id="loader">
							<img style="width: 10%;margin-top: 6%;margin-left: 43%;" src="../../../lib/images/spinner.gif">
						</div>
			
	        		<div class="form-horizontal" style="background: rgb(228, 228, 228);">
	        			<button type="button" class="btn btn-info" id="OcultarFormulario"> Ocultar Filtros </button>
	        			<button type="button" class="btn btn-info" id="MostrarFormulario"> Mostrar Filtros </button>
	        			<form class="form-horizontal">
					      	<div class="form-horizontal" id="miFormulario">
								<div class="col-md-13">
									<div class="form-group">
							        	<label class="control-label col-md-2" style="text-align: left;"> Semana Epidemiologica:</label>
								        <div class="col-md-3">
							            	<div class="col-md-12">
												<select class="form-control" name="semanas" id="semanas" size="5" multiple="MULTIPLE" style="height: 4.5em;" onChange="camInvSapu()">
												</select>
											</div>
								        </div>
								       
								        <div class="col-md-7">
									        <label class="control-label col-md-1" style="text-align: left;">
									        Centro
									    	</label>

									    	<div class="col-md-11">
										        <div class="col-md-12">
													<label class="radio-inline">
														<input name="centro" type="radio" id="stats-sites-0" value="0" onClick="camInvSapu()" checked>
														<span>Comunal</span>
													</label>

													<label class="radio-inline">
														<input name="centro" type="radio" id="stats-sites-3" value="11"  onClick="camInvSapu()">
														<span> SAPU S.L</span>
													</label>

													<label class="radio-inline">
														<input name="centro" type="radio"  id="stats-sites-1" value="8"  onClick="camInvSapu()">
														<span> SAPU C.U</span>
													</label>

													<label class="radio-inline">
														<input name="centro" type="radio" id="stats-sites-2" value="9" onClick="camInvSapu()">
														<span>SAPU L.F</span>
													</label>

													<label class="radio-inline">
														<input name="centro" type="radio" id="stats-sites-4" value="10"onClick="camInvSapu()">
														<span> SAPU L.H</span>
													</label>													
												</div>
											</div>

									        
										</div>
										<div class="col-md-1"></div>
							            <div class="col-md-2"  id="visualizador">
									        <label class="control-label col-md-4" style="text-align: left;">
									        Visualizar
									    	</label>
									    	<div class="col-md-8">
												<label class="checkbox-inline"><input type="checkbox" name="visualizar_dia" id="visualizar_dia" value="1"><span>POR DIA </span></label>
									        </div>
									        <div class="col-md-4">
									          
									        </div>
										</div>
									</div>
							    </div>	<!-- END FORM GROUP -->
						    </div>
						    	&nbsp;
			        	</form>
	        		</div>
	        		<div class="form-horizontal"> &nbsp;</div>

	        		<div class="form-horizontal" style="background: rgb(228, 228, 228);">
	        			<button type="button" class="btn btn-info" id="OcultarGrafico"> Ocultar Grafico </button>
	        			<button type="button" class="btn btn-info" id="MostrarGrafico"> Mostrar Grafico </button>
	        			<div class="form-group" id="graficos" >
			      			<div  class="col-md-1"></div>
				      		<div  class="col-md-10">
				      			<div id="container">
				            	</div>
				      		</div>
				      		<div  class="col-md-1"></div>
			      		</div> 
			      		&nbsp;     	
	        		</div>	

	        		<div class="form-horizontal"> &nbsp;</div>

	        		<div class="form-horizontal" style="background: rgb(228, 228, 228);">
	        			<button type="button" class="btn btn-info" id="OcultarTabla"> Ocultar Tabla </button>
	        			<button type="button" class="btn btn-info" id="MostrarTabla"> Mostrar Tabla </button>
	        			<div class="col-md-13" id="tabla">
	        				<div class="form-group" id="formulariosTabla">
						        	<label class="control-label col-md-1"> Seleccione Fecha :</label>
							        <div class="col-md-2">
						            	<div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy"  id="fecha1">
										 <input class="form-control" type="text" name="fecha1" style="height: 28px !important;" />
										   <span class="input-group-addon">
										   		<i class="fa fa-calendar"></i>
										   </span>								
									  	</div>
							        </div>
							        <div class="col-md-2">
						            	<div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy"  id="fecha2">
										 <input class="form-control" type="text" name="fecha2" style="height: 28px !important;" />
										   <span class="input-group-addon">
										   		<i class="fa fa-calendar"></i>
										   </span>								
									  	</div>
							        </div>
							        <div class="col-md-1">
							        	<button type="button" class="btn btn-primary" id="Buscar"> Buscar </button>
							        </div>
									<div class="col-md-1" id="ExportarData">
										<button class="btn btn-default" name="boton" style="width: 14em;">
											<i class="fa fa-download"></i>
											<label style="color:#007aff;" id="descargar"> Descargar Archivo </label>
										</button>
									</div>
						    </div>
	        			</div>
	        			<div class="form-group" >
			      			<div  class="col-md-1"></div>
				      		<div  class="col-md-8">
				      			<div id="txtHint"></div>				      			
				      		</div>
				      		<div  class="col-md-1"></div>
			      		</div>    
			      		&nbsp;



					<div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog"  style="    margin-left: -16%;">
							<div class="modal-content">
								<div class="modal-header" style="background: #007aff;">
									<button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
									<h4 class="modal-title" style="color:white;">Campaña Invierno</h4>
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

	        		</div>
		</div>
	</div>
</body>
</html>