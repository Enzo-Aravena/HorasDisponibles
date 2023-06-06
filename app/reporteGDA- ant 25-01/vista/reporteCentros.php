<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1 " />
	<link href="css/styles.css" media="all" rel="stylesheet" type="text/css" />
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<script src="../../../lib/jquery-1.12.4.js"></script>
	    <!--  EXTRAE TODA LA DATA DL COMPONENTE PRINCIPAL-->
  	<?php include_once("../../../lib/components.php");?>
	<script src="../controlador/cliente/controladorReporteCentro.js"></script>	
	<script src="js/navegadorReporteCentro.js"></script>
</head>
<body>
<div class="widget-container padded">
		<div class="heading"> 
			<img src="../../../lib/images/repote.png" width="26px">
			<label style="margin-left: 1%;">Ciclos GDA </label>
		</div>
	<div class="widget-content padded">
		<input type='hidden' value='<?php echo $_SESSION['centro'];?>' id='centro'>
		
		<div class="form-horizontal">
			<div class="col-md-8">
				<div class="form-group">
        			<label class="control-label col-md-4 texto">
        				Seleccione fecha
        			</label>
		            <div class="col-md-2">
		              <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy"  id="desde" style="padding: 0px !important;">
						 <input class="form-control" type="text" name="desde" placeholder="dd/mm/yyyy" autocomplete="off" />
						   <span class="input-group-addon">
						   		<i class="fa fa-calendar"></i>
						   </span>
					  </div>
		            </div>
		            
		            <div class="col-md-3">
	            	 	<select class="form-control" id="centroRef" name="centroRef">
							<option value="0"> Seleccione ...</option>
							<option value="3"> San Luis </option>
							<option value="1"> Carol Urzua </option>
							<option value="2"> La Faena </option>
							<option value="4"> Lo Hermida </option>
							<option value="5"> Cardenal Silva.H </option>
							<option value="12"> Padre Gerardo.W </option>
							<option value="13"> Las Torres </option>
						</select>
		            </div>
		            
		            <div class="col-md-3">
		             	<button class="btn btn-primary" style="width: 46%;" id="ejecutar">
		            	 	Buscar
		            	</button> 
		            </div>
		      	</div>
			</div>
		</div>
	<br>
	<br>
	<br>
		<div class="form-horizontal">
			<div class="col-md-8">
				<label>
					<strong>
						 Ciclos GDA Correspondiente al cesfam 
						 <b><label id="ciclos"></label></b>
					</strong>
				</label>
			</div>
		</div>
	<br>
	<br>	
		<div class="form-horizontal">
			<div class="col-md-6"></div>

			<div class="col-md-2">
				<button class="btn btn-success" id="abrirPopUp">Manual de Usuario</button>
			</div>
			
			<div class="col-md-2">
				<button class="btn btn-default" name="boton" style="width: 14em;">
					<i class="fa fa-download"></i>
					<label style="color:#007aff;" id="descargar"> Descargar Archivo </label>
				</button>
			</div>
		</div>
	<br>
	<br>
	<br>
		<div class="form-horizontal">
	    	<div class="form-group">
	      		<div class="col-md-1"></div>
	      		<div class="col-lg-9">	
	      			<label id="guardaDatos"></label>
	          		<div class="table-bordered" id="divTabla">
	          			<table class="table">
		          			<thead>
			                    <th> </th>
		            			<th>Ciclo</th>
		            			<th>Fecha</th>	
		            			<th>Agendados</th>
		            			<th>Cancelados</th>
		            			<th>Estado Agendados</th>
		            			<th>Estado Cancelados</th>
			                  </thead>
			                <tbody id="tabla_resultados">
					       	</tbody>
		          		</table>
	          		</div>
	      		</div>   			
	  		</div>
		</div>


  		<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" style="background: #007aff;">
							<button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
							<h4 class="modal-title" style="color:white;">Ciclos Gda</h4>
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

		
		<!-- Modal -->
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
								 - En el módulo de ciclos GDA usted podrá contemplar, la carga de los pacientes agendados en OMI por cada uno de los ciclos, como se aprecia en la imagen que se muestra a continuación:<br />
							</label>
							<br>
							<img src="../../../lib/images/manuales/ciclosGDA/inicio.png" width="850" />
						</div>
						<br>
						<div class="col-md-12">
							<label>
								- Para buscar otros días se debe, ir al campo fecha y seleccionar la que usted desee buscar,
							</label>
							<br>
							<img src="../../../lib/images/manuales/ciclosGDA/fecha.png" width="800" />									
						</div>
						<br>
						<div class="col-md-12">
							<label>
								- se puede ver otro centro, como se muestra en la imagen:
							</label>
							<br>
							<img src="../../../lib/images/manuales/ciclosGDA/centro.png" width="800" />							
						</div>
						<br>
						<div class="col-md-12">
							<label>
								-  Al descargar el archivo usted podrá encontrar el detalle de lo que ha filtrado en el portal 
							</label>
							<br>
							<img src="../../../lib/images/manuales/ciclosGDA/descarga.png" width="800" />
							
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" style="background: #007aff;" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>



	</div>
</div>
</body>
</html>