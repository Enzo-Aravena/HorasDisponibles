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
	<link href="css/estilomorbSapu.css" media="all" rel="stylesheet" type="text/css" />
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
	<script src="js/navMorbiSapu.js"></script>
</head>
	<body>
	<div class="widget-container padded">
		<div class="widget-content padded">
			<div class="form-horizontal">
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
				        	<button type="button" class="btn btn-primary" id="buscar"> Buscar </button>
				        </div>
						<div class="col-md-1" id="ExportarData">
							<button class="btn btn-default" name="boton" style="width: 14em;">
								<i class="fa fa-download"></i>
								<label style="color:#007aff;" id="descargar"> Descargar Archivo </label>
							</button>
						</div>
				    </div>
    			</div>
			</div>

			<div class="form-horizontal">
				<div class="col-md-7">
			        <label class="control-label col-md-1" style="text-align: left;">
			        Centro
			    	</label>

			    	<div class="col-md-11">
				        <div class="col-md-12">
							<label class="radio-inline">
								<input name="centro" type="radio" id="stats-sites-0" value="0" checked>
								<span>Comunal</span>
							</label>

							<label class="radio-inline">
								<input name="centro" type="radio" id="stats-sites-3" value="11">
								<span> SAPU S.L</span>
							</label>

							<label class="radio-inline">
								<input name="centro" type="radio"  id="stats-sites-1" value="8">
								<span> SAPU C.U</span>
							</label>

							<label class="radio-inline">
								<input name="centro" type="radio" id="stats-sites-2" value="9" >
								<span>SAPU L.F</span>
							</label>

							<label class="radio-inline">
								<input name="centro" type="radio" id="stats-sites-4" value="10">
								<span> SAPU L.H</span>
							</label>
						</div>
					</div>
				</div>
			</div>

			<div class="form-horizontal"> &nbsp;</div>
			<div class="form-horizontal"> &nbsp;</div>
			
			
			<br>
			<div class="form-horizontal">
				<div class="form-group" >
	      			
		      		<div class="col-md-8">
		      			<div id="mostrarTabla"></div>
		      		</div>
		      		<div class="col-md-1"></div>
			    </div>   
			</div>

			<!-- MODAL -->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background: #007aff;">
					<!--	<button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>-->
						<h4 class="modal-title" style="color:white;">Morbilidad Sapu</h4>
					</div>
					<div class="modal-body" style="text-align: center;">
						<label class="control-label" id="mensaje">
						</label>
					</div>
					<div class="modal-footer">
					<!--	<button type="button" style="background: #007aff;" class="btn btn-default" data-dismiss="modal">Cerrar</button>-->
					<label>&nbsp;</label>
					</div>
				</div>
			</div>
		</div>
		<!-- MODAL -->	

		</div>


		


	</div>
</body>
</html>