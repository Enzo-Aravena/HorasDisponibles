<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
		<meta http-equiv="cache-control" content="no-cache"/>
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
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
	<script src="../controlador/cliente/InaRetMedController.js"></script>
	<script src="js/navInaRetMedicamento.js"></script>
</head>
<body>
	<div class="widget-container padded">
		<div class="widget-content padded">
			<div class="form-horizontal"> &nbsp; </div>
			<div class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-md-1"> Buscar por </label>
					<div class="col-md-2">
						<label class="radio-inline">
							<input checked="" name="rdbBuscar" type="radio" value="rut">
							<span> Rut </span>
						</label>			
						<label class="radio-inline">
							<input name="rdbBuscar" type="radio" value="fecha">
							<span>Fecha</span>
						</label>							
					</div>

					<div class="col-md-3" id="mostrarRut">
						<label class="control-label col-md-2">Rut:</label>
			            <div class="col-md-7">
			            	<input class="form-control" placeholder="ingrese rut" type="text" id="rutPaciente">
			            </div>
					</div>

					<div class="col-md-5" id="mostrarFecha">
						<label class="control-label col-md-2">Fecha:</label>

						<div class="col-md-5">
							<div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy"  id="desde" >
								<input class="form-control" type="text" name="desde" autocomplete="off"/>
								<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
								</span>								
							</div>
						</div>
						<div class="col-md-5">
							<div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy"  id="hasta">
								<input class="form-control" type="text" name="hasta" autocomplete="off"/>
								<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
								</span>								
							</div>
						</div>

					</div>

					<div class="col-md-2">
						<button class="btn btn-primary" id="ejecutar">Buscar</button>
					</div>
				</div>				        			        	
	        </div>

	        <div class="form-horizontal">
	        	<div class="col-md-5"></div>
	        	<div class="col-md-2">
					<button class="btn btn-success" id="abrirPopUp">Manual de Usuario</button>
				</div>
				<div class="col-md-2" id= "ExportarData">
					<button class="btn btn-default" name="boton" style="width: 14em;">
						<i class="fa fa-download"></i>
						<label style="color:#007aff;" id="descargar"> Descargar Archivo </label>
					</button>
				</div>
	        </div>

	        <div class="form-horizontal"> &nbsp; <br> </div>
		   	
	        <div class="form-horizontal">
				<br>
				<br>
       			<table class="table table-bordered table-hover tablesorter" id="example">
					<thead>
		       			<th></th>
            			<th > Centro </th>
            			<th > Codigo </th>
            			<th > Medicamento </th>
            			<th > Rut Paciente </th>
            			<th > Nombre Paciente </th>
            			<th > Inicio TTO </th>
            			<th > Fecha entrega </th>
            			<th > Tipo receta </th>
            			<th > Cant no dispensada </th>
            			<th > Stock inicial </th>
            			<th > Stock final </th>
		       		</thead>
 					<tbody id="tabla_resultados">
		       		</tbody>
				</table>
		    </div>
		    <div class="form-horizontal">
		   		<div class="col-md-3"></div>
		   		<div class="col-md-6">
		    		<ul class="pagination pagination-lg pager" id="myPager"></ul>
		    	</div>
		   	</div>

		   	<div id="loader" class="loader">
				<img style="margin-left: 43%;margin-top: 2%;" src="../../../lib/images/spinner.gif">
			</div> 
		   	<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" style="background: #007aff;">
							<button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
							<h4 class="modal-title" style="color:white;">Inasistente Retiro Medicamentos</h4>
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
										 - En este módulo, se aprecian a todos los pacientes que no han asistido a buscar sus medicamentos, además de que si el tipo de receta es crónica o aguda.<br />
									</label>
									<br>
									<img src="../../../lib/images/manuales/inasistenteMedi/inicio.png" width="850" />
								</div>
								<br>
								<div class="col-md-12">
									<label>
										- Puede buscar por el rut del paciente
									</label>
									<br>
									<img src="../../../lib/images/manuales/inasistenteMedi/buscarporRut.png" width="800" />									
								</div>
								<br>
								<div class="col-md-12">
									<label>
										- Por la fecha o rango de fecha
									</label>
									<br>
									<img src="../../../lib/images/manuales/inasistenteMedi/fecha1.png" width="800" />
									<br>
									<img src="../../../lib/images/manuales/inasistenteMedi/fecha2.png" width="800" />
									
								</div>
								<br>
								<div class="col-md-12">
									<label>
										-  Al descargar el archivo usted podrá encontrar el detalle de lo que ha filtrado en el portal 
									</label>
									<br>
									<img src="../../../lib/images/manuales/inasistenteMedi/descarga.png" width="800" />
									
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" style="background: #007aff;" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
			</div>


	    </div>
	</div><!-- DIV PRINCIPAL  -->
</body>
</html>