<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
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
	<link href="css/estilosCamInvierno.css" media="all" rel="stylesheet" type="text/css" />
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
	<script src="js/navegadorCampana.js"></script>
</head>
	<body>
	<div class="widget-container padded">
		<div class="widget-content padded">

			<ul class="nav nav-tabs">
		     	<li class="active" ><a data-toggle="tab" href="#tab1">Campaña Invierno</a></li>
		   	<!--<li><a data-toggle="tab" href="#tab2" >Campaña Invierno Sapu</a></li>-->
		        <li><a data-toggle="tab" href="#tab3" >Morbilidad Médica</a></li>
		        <li><a data-toggle="tab" href="#tab4" >Morbilidad Sapu</a></li>
		    </ul>

		    <div class="tab-content">
	        	<div class="tab_content" id="tab1">
	        		<br>
	        		<div class="form-horizontal" style="background: rgb(228, 228, 228);">
	        			<button type="button" class="btn btn-info" id="OcultarFormulario"> Ocultar Filtros </button>
	        			<button type="button" class="btn btn-info" id="MostrarFormulario"> Mostrar Filtros </button>
	        			<button type="button" class="btn btn-success" id="Informacion"> Manual Usuario </button>
	        			<form class="form-horizontal">
					      	<div class="form-horizontal" id="miFormulario">
								<div class="col-md-13">
									<div class="form-group">
							        	<label class="control-label col-md-2" style="text-align: left;width: 10%;"> Semana Epidemiologica :</label>
								        <div class="col-md-3">
							            	<div class="col-md-12">
												<select class="form-control" name="semana" id="semana" size="5" multiple="MULTIPLE" style="height: 4.5em;" onChange="enviarDatosFormulario()">
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
														<input name="centro" type="radio" id="stats-sites-0" value="0" onClick="enviarDatosFormulario()" checked>
														<span>Todos</span>
													</label>

													<label class="radio-inline">
														<input name="centro" type="radio" id="stats-sites-3" value="3" onClick="enviarDatosFormulario()">
														<span>S.L</span>
													</label>

													<label class="radio-inline">
														<input name="centro" type="radio"  id="stats-sites-1" value="1" onClick="enviarDatosFormulario()">
														<span>C.U</span>
													</label>

													<label class="radio-inline">
														<input name="centro" type="radio" id="stats-sites-2" value="2" onClick="enviarDatosFormulario()">
														<span>L.F</span>
													</label>

													<label class="radio-inline">
														<input name="centro" type="radio" id="stats-sites-4" value="4" onClick="enviarDatosFormulario()">
														<span>L.H</span>
													</label>

													<label class="radio-inline">
														<input name="centro" type="radio" id="stats-sites-5" value="5" onClick="enviarDatosFormulario()">
														<span>C.S.H</span>
													</label>

													<label class="radio-inline">
														<input name="centro" type="radio" id="stats-sites-6" value="12" onClick="enviarDatosFormulario()">
														<span>P.G.W</span>
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
	        			<div class="form-group" id="graficos">
			      			<div  class="col-md-1"></div>
				      		<div  class="col-md-8">
				      			<div id="contenido">
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
	        		</div>

	        		<div class="modal fade" id="myModal" role="dialog" >
						<div class="modal-dialog" style=" margin-left: -16%;">
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


	        		<!-------------------------------------------------------------- INICIO  MODAL -------------------------------------------------------------->
						<div id="manual" class="black_overlay" style="display: none;">
							<div >
						   		<div class="content-popup" style="height: 44em;">       
						        	<div class="dimensiones">
						        		<label class="tituloCabecera"> Manual Usuarios </label> 
						        	 	<div class="cerrar" style="opacity: 1;float: right;font-size: 26px;font-weight: bold;line-height: 1; margin-right: 2%;">
						        	 		<a href="#" id="close"><img src='../../../lib/images/close.png'></a>
						        		</div>
						        		<div class="form-group" style="background: white;">
						        			<div style="margin-left: 2%;">
						        				<br>
						        				<label>Demanda de Morbilidad Respiratoria en  los Centros</label>
						        				<br>
						        				<label> Al ingresar, los datos visualizados en el gráfico y en la tabla corresponden al total acumulado 2016.</label>
						        				<br>

						        				<div style="height:400px; overflow:auto;">
						        					<div class="col-md-12">
						        						<h3>Filtros:</h3>
						        						<label>
						        							 .- El usuario podra selecionar mas de 1 semana Epidemiologica, Visualizando el total de las semana seleccionadas en el gráfico y en la tabla<br />
															 .- Al seleecionar mas de 1 semana Epidemiologica se habilita el boton "visualizar por dia", Desglosando las semanas seleccionadas a dias.
						        						</label>
						        						<br>
						        						<img src="../../../lib/images/filtros2.png" width="850" />
						        					</div>
						        					<br>
						        					<div class="col-md-12">
						        						<h3>Gráfico:</h3>
						        						<label>
						        							.- Se muestra la evolución de los datos segun los filtros seleccionados.<br />
															.- Al pasar el mouse por los puntos del Gráfico, Se Observa en N por año y en rojo el porcentaje,<br />
															   lo cual indica la cantidad de atenciones por causa respiratoria en base al total de atenciones.<br />    
														 	.- El titulo cambia segun los filtros aplicados.<br />
														    .- Opción para exportar el gráfico.<br />
															.- Si se requiere visualizar solo 2016 es necesario pinchar los titulos para que estos se oculten las lineas.<br />
						        						</label>
						        						<br>
						        						<div class="col-md-12">
						        							<label>Grafico Semanal</label>
						        							<img src="../../../lib/images/grafico.png" width="850" />
						        						</div>
						        						<br>
						        						<div class="col-md-12">
						        							<label>Grafico Diario</label>
						        							<img src="../../../lib/images/grafico2.png" width="850" />						        							
						        						</div>
						        					</div>
						        					<br>
						        					<div class="col-md-12">
						        						<h3>Tabla:</h3>
						        						<label>
						        							.- Se visualiza el total de de los datos segun los filtro seleccionados<br />
													    	.- Opción para exportar la tabla<br />
															.- El usuario puede seleccionar un dia o un rango, lo cual aparecera un mensaje con la opcion de visualizar<br /> 
															los datos en la tabla o exportarlos directamente
						        						</label>
						        						<br>

						        						<div class="col-md-12">
						        							<label>Grafico Semanal</label>
						        							<img src="../../../lib/images/tabla.png" width="850" />
						        						</div>
						        						<br>
						        						<div class="col-md-12">
						        							<label>Grafico Diario</label>
						        							<img src="../../../lib/images/tabla2.png" width="850" />
						        						</div>
						        						<br>
						        					</div>
						        					<br>
						        					<div class="col-md-12">
						        						<br><br>
						        						<div class="col-md-5"></div>
						        						<div class="col-md-6">
						        							<button type="button" class="btn btn-primary" id="CerrarModal"> Cerrar </button><span>(o presione ESC o click en la X)</span>
						        						</div>
						        						<br>
						        					</div>

						        				</div>
	
						        			</div>
						        		</div>
						        		
						        	</div>
						    	</div>
							</div>
						</div>
					<!-------------------------------------------------------------- FIN  MODAL -------------------------------------------------------------->


	        	</div>

	       <!-- 	<div class="tab_content" id="tab2">	           		
	           		<iframe src="CampanaInviernoSapu.php" style="width: 99%;height: 110em;border: none;overflow: hidden;">
	           		</iframe>
	        	</div>-->

	        	<div class="tab_content" id="tab3">	           		
	           		<iframe src="morbilidadMedica.php" style="width: 99%;height: 205em;border: none;overflow: hidden;">
	           		</iframe>	        		
	        	</div>

	        	<div class="tab_content" id="tab4">	           		
	           		<iframe src="morbilidadSapu.php" style="width: 99%;height: 205em;border: none;overflow: hidden;">
	           		</iframe>	        		
	        	</div>
		    </div>
		</div>
	</div>
</body>
</html>