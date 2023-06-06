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
	<script src="js/navegadorAgenMensual.js"></script>
	</head>
	<body>
			<form class="form-horizontal" id="Agendados">
				<div class="form-horizontal">&nbsp;</div>
				<div class="form-horizontal">
					<div  class="col-md-1"></div>
					<div class="col-md-13">
						<div class="form-group">
			            <label class="control-label col-md-1">Seleccione Fecha :</label>
				            <div class="col-md-2">
				               <select class="form-control" style="height: 28px;" name="anio" id="anio" onchange="enviarAgendMorbMensual();">
									<option value="2015"> Año - 2015</option>
									<option value="2016"> Año - 2016</option>
									<option value="2017"> Año - 2017</option>
									<option value="2018"> Año - 2018</option>
									<option value="2019" selected=""> Año - 2019</option>
									<!--<option value="2020" selected=""> Año - 2020</option>
									<option value="2021" selected=""> Año - 2021</option>-->
					            </select>
				            </div>
				            
				        	<label class="control-label col-md-2">Seleccione Centro :</label>
				            <div class="col-md-2">
				               	<select class="form-control" style="height: 28px;"name="centro" id="centro" onchange="enviarAgendMorbMensual();">
									<option value="1"selected>SAN LUIS</option>
									<option value="2">CAROL URZUA</option>
									<option value="3">LA FAENA</option>
									<option value="4">LO HERMIDA</option>
									<option value="5">CARDENAL S.H</option>
									<option value="12">PADRE G.W</option>
									<option value="13">LAS TORRES </option>
								</select>
				            </div>
						</div>
					</div>
				</div>
			</form>

			<div class="form-horizontal">
				<div class="form-group">
					<div  class="col-md-1"></div>
					<div  class="col-md-8">
						<div id="contenido">
			    	</div>
					</div>
					<div  class="col-md-1"></div>
				</div>      		
			</div> 
			<!-- ---------------------------------  FIN GRAFICO  --------------------------------------- -->
			<!-- ---------------------------------  INICIO TABLA DATA ---------------------------------- -->
			<div class="form-horizontal">
			<div class="form-group">			          		
				<div class="col-lg-12"  id="txtHint" style="overflow: auto;">			  	
				</div>

				<div id="loader" class="loader">
					<img style="margin-left: 43%;margin-top: 2%;" src="../../../lib/images/spinner.gif">
				</div> 
				
				</div>
			</div>
</body>
</html>