<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="refresh" content="300" />
	<!--equivale a  5 minutos -->
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
	<link href="css/styles.css" media="all" rel="stylesheet" type="text/css" />
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<!--  EXTRAE TODA LA DATA DL COMPONENTE PRINCIPAL-->
  	<?php include_once("../../../lib/components.php");?>
	<script src="../controlador/cliente/controladorCuadroMando.js"></script>	
	<script src="js/navegadorRegistroClinico.js"></script>
	</head>
	<body>
		<div class="widget-container padded">
				<div class="widget-content padded">
				<label style="margin-left: 1%;"> <b> Ciclos Correspondientes al dia de hoy  <span id="mostrarFecha"></span> </b> </label>
				<br>
				<div class="row">
		          	<div class="col-lg-6">
			            <div class="widget-container fluid-height clearfix">
			              <div class="heading">
			              	<img style="width: 3%;" src="../../../lib/images/cargando.png">
			                Ciclos Gda
			              </div> 			             
			                <div class="table-responsive">
			                  <table class="table table-bordered">
			                   <thead class="tituloCabeceraExamen">     
			                      <th style="font-size:8px;" class="alineacionTabla"> Centro </th>           
			                      <th style="font-size:8px;" colspan="2">Ciclo 1</th>
			                      <th style="font-size:8px;" colspan="2">Ciclo 2</th>
			                      <th style="font-size:8px;" colspan="2">Ciclo 3</th>
			                      <th style="font-size:8px;" colspan="2">Ciclo 4</th>
			                      <th style="font-size:8px;" colspan="2">Ciclo 5</th>
			                      <th style="font-size:8px;" colspan="2"></th>
			                    </thead>
			                    <tbody class="cuerpoTabla"  id="tabla_resultados">
			                    </tbody>
			                  </table>		
			                </div>
			            </div>
			         </div>

			         <div class="col-lg-4">
			            <div class="widget-container fluid-height clearfix">
			              <div class="heading">
			              	<img style="width: 5%;" src="../../../lib/images/pentaho.ico">
			                Carga Procesos PENTAHO
			              </div>
			                <div class="table-responsive">
			                  <table class="table table-bordered">
			                   <thead class="tituloCabeceraExamen">     			                      
			                      <th style="font-size:8px;">Nombre</th>
			                      <th style="font-size:8px;">Hora</th>
			                      <th style="font-size:8px;">Total</th>
			                      <th style="font-size:8px;">Estado</th>
			                    </thead>
			                    <tbody class="cuerpoTabla"  id="carga_Data">
			                    </tbody>
			                  </table>
			                </div>
			            </div>
			         </div>
        </div>



				
		</div><!-- DIV PRINCIPAL  -->
</body>
</html>