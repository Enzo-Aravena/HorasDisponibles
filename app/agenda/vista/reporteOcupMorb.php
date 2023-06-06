<?php include_once("../../../lib/seguridad.php");?>
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
	<script src="js/navReporteOcupMorb.js"></script>
</head>
	<body>
		<form class="form-horizontal" id="reporte"style="background: #e4e4e4;">
			<div class="form-horizontal">&nbsp;</div>
			<div class="form-horizontal">
				<div class="col-md-13">
					<div class="form-group">
		            <label class="control-label col-md-1">Año :</label>
			            <div class="col-md-1">
			               <select class="form-control" style="height: 28px;" name="anio" id="anio" onchange="getReporte();">
								<option value="2015"> Año - 2015</option>
								<option value="2016"> Año - 2016</option>
								<option value="2017"> Año - 2017</option>
								<!--<option value="2018"> Año - 2018</option>
								<option value="2019"> Año - 2019</option>
								<option value="2020"> Año - 2020</option>
								<option value="2021"> Año - 2021</option>
								<option value="2022"> Año - 2022</option>-->
				            </select>
			            </div>
			            
			        	<label class="control-label col-md-1">Semestral :</label>
			            <div class="col-md-2">
			               	<select class="form-control" style="height: 28px;" name="semestre" id="semestre" onchange="getReporte();">
			                    <option value="1">Enero - Junio</option>
			                    <option value="2">Julio - Diciembre</option>
				            </select>
			        	</div>

			        	<label class="control-label col-md-2">Semana Epidemiologica :</label>
			        	<div class="col-md-2">
			               <select class="form-control" style="height: 28px;" name="semana" id="semana" onchange="getReporte();">
				           </select>
			            </div>
					</div>
				</div>
			</div>
			<div class="form-horizontal">
				<div class="col-md-13">
					<div class="form-group">
		            <label class="control-label col-md-1">Mensual :</labels>
			           <div class="col-md-2">
			               	<select class="form-control" style="height: 28px;" name="mes" id="mes" onchange="getReporte();">								
				            </select>
			        	</div>
			            
						<div class="col-md-5">			            	  
							<label class="control-label col-md-2" style="text-align: left;">Centro</label>
							<div class="col-md-12" style="border: 2px solid #5a5a5a;" >
								<input type="radio" name="centro" id="stats-sites-0" value="0" onClick="getReporte()" checked="CHECKED">&nbsp;<label for="stats-sites-0" style="font-size:11px">Todos</label>
								<input type="radio" name="centro" id="stats-sites-3" value="3" onClick="getReporte()">&nbsp;<label for="stats-sites-3" style="font-size:11px">San Luis</label>
								<input type="radio" name="centro" id="stats-sites-1" value="1" onClick="getReporte()">&nbsp;<label for="stats-sites-1" style="font-size:11px">Carol Urzua</label>
								<input type="radio" name="centro" id="stats-sites-2" value="2" onClick="getReporte()">&nbsp;<label for="stats-sites-2" style="font-size:11px">La Faena</label>
								<input type="radio" name="centro" id="stats-sites-4" value="4" onClick="getReporte()">&nbsp;<label for="stats-sites-4" style="font-size:11px">Lo Hermida</label>
								<input type="radio" name="centro" id="stats-sites-5" value="5" onClick="getReporte()">&nbsp;<label for="stats-sites-5" style="font-size:11px">Cardenal Silva.H</label>
								<input type="radio" name="centro" id="stats-sites-6" value="12" onClick="getReporte()">&nbsp;<label for="stats-sites-6" style="font-size:11px">Padre Gerardo.W</label>
								<!-- <input type="radio" name="centro" id="stats-sites-6" value="99" onClick="getReporte()">&nbsp;<label for="stats-sites-6" style="font-size:11px">Las Torres</label>-->
							</div>
						</div>

					</div>
				</div>
			</div>
		</form>
		<div class="form-horizontal">
			<div class="form-group">
				<div  class="col-md-1"></div>
				<div  class="col-md-8">
					<div id="contenedor">
		    	</div>
				</div>
				<div  class="col-md-1"></div>
			</div>      		
		</div> 
		<!-- ---------------------------------  FIN GRAFICO  --------------------------------------- -->
		<!-- ---------------------------------  INICIO TABLA DATA ---------------------------------- -->
		<div class="form-horizontal">
			<div class="form-group">
				<div  class="col-md-1"></div>
				<div class="col-lg-8">
	          		<div id="divTabla">
	          			<table class="responstable" id="tabla_ocupacion">
		          		</table>
	          		</div>
	      		</div>  
				<!--
				<div id="loader" style="margin-left: 40%;">
					<img style="width: 4%;margin-top: 2%;" src="../../../lib/images/loading.gif">
				</div> 
				-->
			</div>
		</div>
	</body>
</html>