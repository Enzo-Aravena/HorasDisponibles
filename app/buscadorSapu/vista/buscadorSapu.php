<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">	
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<!--  EXTRAE TODA LA DATA DL COMPONENTE PRINCIPAL-->
  	<?php include_once("../../../lib/components.php");?>
	<script src="../controlador/cliente/bucadorSapuController.js"></script>
	<script src="js/navBuscadorSapu.js"></script>
	</head>
	<body>
		<div class="row">
			<div class="widget-container padded">
				<div class="widget-content padded">
					<div class="form-horizontal"> &nbsp;</div>
		    		<div class="form-horizontal">
					    <div class="form-group">
								<label class="control-label col-md-3">Seleccione el tipo de dato a buscar : </label>
								<div class="col-md-7">		
									<label class="radio-inline">
										<input style="cursor: pointer;" name="rdbBuscar" type="radio" value="rut" checked><span> Rut</span>
									</label>	
									<label class="radio-inline">
										<input style="cursor: pointer;" name="rdbBuscar" type="radio" value="fecha"><span> Fecha</span>
									</label>								
								</div>
						</div>				        			        	
				        <div class="form-group">
					            <label class="control-label col-md-2"> </label>
					            <div class="col-md-3">			        
					              	<input style="cursor: pointer;" class="form-control" placeholder="12345678-9" type="text" id="rutPaciente" autocomplete="off" name="rutPaciente" minlength="3" maxlength="11">

									<div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy"  id="desde">
										<input class="form-control" type="text" placeholder="dia/mes/año" name="desde" style="height: 28px !important;" autocomplete="off"/>
										<span class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</span>
									</div>
					            </div>
								<button class="btn btn-primary" id="ejecutar">Buscar</button>
				        </div>
		    		</div>
		    		<div class="form-horizontal" id="tablesContent">
		    			<div class="form-group" style="overflow-x:auto;">
			          			<table class="table table-bordered">
				          			<thead style="background-color:#007aff/* #900*/;color: white;">
										<th class="th-sm">CENTRO_ATENCION</th>
										<th class="th-sm">NOMBRE_PROFESIONAL</th>
										<th class="th-sm">PROFESION</th>
										<th class="th-sm">RUT_PROFESIONAL</th>
										<th class="th-sm">CENTRO_PACIENTE</th>
										<th class="th-sm">SECTOR_PACIENTE</th>
										<th class="th-sm">RUT_PACIENTE</th>
										<th class="th-sm">NOMBRE_PACIENTE</th>
										<th class="th-sm">SEXO</th>
										<th class="th-sm">DOMICILIO</th>
										<th class="th-sm">FECHA_NACIMIENTO</th>
										<th class="th-sm">EDAD_VISITA_PACIENTE</th>
										<th class="th-sm">RANGO_ETARIO_1</th>
										<th class="th-sm">RANGO_ETARIO_2</th>
										<th class="th-sm">EPISODIO</th>
										<th class="th-sm">PROTOCOLO</th>
										<th class="th-sm">FECHA_ATENCION</th>
										<th class="th-sm">HORA_ATENCION</th>
										<th class="th-sm">NUM_ATENCION_SAPU</th>
										<th class="th-sm">TIPO_INSCRIPCION</th>
										<th class="th-sm">MOTIVO_CONSULTA</th>
										<th class="th-sm">EMBARAZADA</th>
										<th class="th-sm">CONSTATACION_DE_LESIONES</th>
										<th class="th-sm">ALCOHOLEMIA</th>
										<th class="th-sm">REALIZA_REANIMACION</th>
										<th class="th-sm">PACIENTE_FALLECIDO</th>
										<th class="th-sm">NSP</th>
										<th class="th-sm">derivacion_urgencia</th>
										<th class="th-sm">derivacion_urgencia_otro</th>
										<th class="th-sm">CAT_URGENCIA</th>
										<th class="th-sm">DIAGNOSTICO</th>
										<th class="th-sm">PAC_ID</th>
										<th class="th-sm">TIPO_REGISTRO</th>
									</thead>
									<tbody  id="tabla_resultados">
							       	</tbody>
				          		</table>
		          		</div>
			        </div>	    		
		    	</div>
		    </div>
		</div>
			
	</body>
</html>