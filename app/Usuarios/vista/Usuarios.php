<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
	<link href="css/styles.css" media="all" rel="stylesheet" type="text/css" />
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
  	<?php include_once("../../../lib/components.php");?>
	<script src="../controlador/cliente/controladorUsuarios.js?id=1"></script>
	<script src="js/navegadorUsuarios.js?id=1"></script>
	<style>
		.Mostrar input[type="radio"]:checked + span:after {
			content: "";
			width: 8px;
			height: 8px;
			position: absolute;
			top: 6px;
			left: 5px !important;
			background-color: #007aff;
			border-radius: 50%;
			display: block;
		}
	</style>
	</head>
	<body>
	<div class="widget-container padded">
		<input type='hidden' value='<?php echo $_SESSION['username'];?>' id='usuario' /> 
		<div class="heading"> 
			<i class="glyphicon glyphicon-search"></i>
			<label>Asignación de permisos Usuarios </label>
		</div>
		<div class="widget-content padded" style="box-shadow:none;">
			<div class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-md-3">Seleccione el tipo de dato a buscar : </label>
					<div class="col-md-7">		
						<label class="radio-inline">
							<input style="cursor: pointer;" name="rdbBuscar" type="radio" value="rut" checked><span> Rut</span>
						</label>	
						<label class="radio-inline">
							<input style="cursor: pointer;" name="rdbBuscar" type="radio" value="username"><span> Usuario</span>
						</label>								
					</div>
				</div>				        			        	
				<div class="form-group">
					<label class="control-label col-md-2"> </label>
					<div class="col-md-3">
						<input class="form-control " id="rutUsuario" name="rutUsuario" tabindex="1" oninput="checkRut(this)" placeholder="12345678-1" type="text" maxlength="10">
						<input style="cursor: pointer;" class="form-control" placeholder="Buscar ..." type="text" id="buscar" autocomplete="off" name="buscar" minlength="2" maxlength="14" required>
					</div>          		   
					<button class="btn btn-primary" id="ejecutar">Buscar Usuario </button>
					<button class="btn btn-primary" id="ejecModalInfo">Informacion Sobre Perfiles </button>
				</div>  				          
			</div>
			<div class="form-horizontal" id="cuerpoUno">
				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-lg-7">
						<label id="guardaDatos"></label>
						<div class="table-bordered" id="divTabla">
							<table class="table">
								<thead id="cabecera">
									<th></th>
									<th>Rut</th>
									<th>Nombre Completo</th>
									<th>Usuario</th>
									<th>Centro</th>
									<th>Estamento</th>
									<th>Estado</th>
									<th>Perfil</th>
									<th>Acceso Desbloqueo Paciente</th>
								</thead>
								<tbody  id="tabla_resultados">
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>


			



			<div class="row" id="botones">
				<div class="col-md-6"></div>
				<div class="col-md-2">
					&nbsp;
				</div>
				<div class="col-md-1">
					<button class="btn btn-primary" id="otorgaAcceso"> Otorgar Acceso </button>
				</div>
			</div>
		</div>

		<!-- MODALES OTORGAMIENTO ACCESO  -->
		<div class="modal fade" id="myModal"   data-backdrop="static" data-keyboard="false" role="dialog" >
			<div class="modal-dialog" style="width: 845px !important;">
				<div class="modal-content">
					<div class="modal-header" style="background:#007aff;">
						<button type="button" id="cerrarPop" class="close" data-dismiss="modal" style="color:white;">&times;</button>
						<h4 class="modal-title" style="color:white;">Permisos Usuarios</h4>
					</div>
					<!-- START MODAL BODY-->
					<div class="modal-body" style="text-align: center;background-color: #fef9f4 !important;">
						<div class="row">
							<div class="form-horizontal">
								<div class="form-group">
									<b><h4><label> Asignacion de Permisos a usuarios </label></h4></b>
								</div>

								<input type="hidden" name="valor" id="valor">

								<div class="form-group">
									<label for="cargoAsignar" class="control-label col-md-4"> Cargo a asignar: </label>
									<div class="col-md-6">
										<select class="form-control" id="cargoAsignar" name="cargoAsignar">
											<option value="0">SELECCIONE</option>
											<option value="1">1.- DIRECTOR</option>
											<option value="2">2.- SUB DIRECTOR</option>
											<option value="3">3.- JEFE DE SOME</option>
											<option value="4">4.- JEFE DE SECTOR</option>
											<option value="5">5.- UNIDAD TECNICA</option>
											<option value="6">6.- QUIMICOS</option>
											<option value="7">7.- DROGUERIA</option>
											<option value="8">8.- MODULO DENTAL</option>
											<option value="9">9.- OTRO</option>
											<option value="10">10.- REGISTRO CLINICO</option>
											<option value="11">11.- COSAM</option>
											<option value="12">12.- ENFERMERA TURNO</option>
											<option value="99">99.- ADMINISTRADOR</option>
											<option value="100">QUITAR ACCESO</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="habilitarDeshabilitar" class="control-label col-md-4"> Habilitacion Sistemas : </label>
									<div class="col-md-6">
										<select class="form-control" id="habilitarDeshabilitar" name="habilitarDeshabilitar">
											<option value="99">SELECCIONE.. </option>
											<option value="1"> Habilitar </option>
											<option value="0"> Deshabilitar </option> 
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="habiDesblSapu" class="control-label col-md-4"> Desbloqueo Paciente SAPU: </label>
									<div class="col-md-6">
										<select class="form-control" id="habiDesblSapu" name="habiDesblSapu">
											<option value="99">SELECCIONE.. </option>
											<option value="1"> Habilitar </option>
											<option value="0"> Deshabilitar </option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END MODAL BODY-->
					<div class="modal-footer" style="background-color: #fef9f4 !important;">
						<div class="form-horizontal">
								<button type="button" class="btn btn-primary" id="Aceptar"> Aceptar </button>
								<button type="button" class="btn btn-primary" data-dismiss="modal"> Cancelar </button>
				
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- MODALES HABILITAR Y DESHABILITAR ACCESO A SISTEMAS  -->
		<div class="modal fade" id="Habilitar"   data-backdrop="static" data-keyboard="false" role="dialog" >
			<div class="modal-dialog" style="width: 845px !important;">
				<div class="modal-content">
					<div class="modal-header" style="background:#007aff;">
						<button type="button" id="cerrarPop" class="close" data-dismiss="modal" style="color:white;">&times;</button>
						<h4 class="modal-title" style="color:white;">Permisos Usuarios</h4>
					</div>
					<!-- START MODAL BODY-->
					<div class="modal-body" style="text-align: center;background-color: #fef9f4 !important;">
					</div>
					<!-- END MODAL BODY-->
					<div class="modal-footer" style="background-color: #fef9f4 !important;">
						<div class="form-horizontal">
								<button type="button" class="btn btn-primary" id="Aceptar"> Aceptar </button>
								<button type="button" class="btn btn-primary" data-dismiss="modal"> Cancelar </button>
				
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- MODAL INFORMATIVO ACCESOS CONTENIDO-->
		<div class="modal fade" id="informativo"   data-backdrop="static" data-keyboard="false" role="dialog" >
			<div class="modal-dialog" style="width: 7vh !important">
				<div class="modal-content">
					<div class="modal-header" style="background:#007aff;">
						<button type="button" id="cerrarPop" class="close" data-dismiss="modal" style="color:white;">&times;</button>
						<h4 class="modal-title" style="color:white;">Permisos Usuarios</h4>
					</div>
					<!-- START MODAL BODY-->
					<div class="modal-body" style="text-align: center;background-color: #fef9f4 !important;">
						<div class="row">
							<div class="form-horizontal">
								<div class="form-group">
									<h4><b>Modulos de accesos segun la siguiente tabla : </b> </h4>
								</div>
								<div class="form-group">
									<TABLE BORDER>
										<thead>
											<tr>
												<td>Perfil </td>
												<td> Módulos </td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1.- Director</td>
												<td>
													Auditoria, Ciclos GDA, Agenda, Extracciones, Reporte Morbilidad, Carga Archivos, Actualizacion Stock
												</td>
											</tr>
											<tr>
												<td>2.- SubDirector</td>
												<td>
													Auditoria, Ciclos GDA, Agenda, Extracciones, Reporte Morbilidad, Carga Archivos, Actualizacion Stock
												</td>
											</tr>
											<tr>
												<td>3.- Jefe de Some</td>
												<td>
													Ciclos GDA, Agenda, Extracciones
												</td>
											</tr>
											<tr>
												<td>4.- Jefe de Sector </td>
												<td>Ciclos GDA, Agenda </td>
											</tr>
											<tr>
												<td>5.- Unidad Tecnica</td>
												<td>
													Auditoria, Ciclos GDA, Agenda, Extracciones, Reporte Morbilidad, Carga Archivos, Actualizacion Stock
												</td>
											</tr>
											<tr>
												<td>6.- Quimico</td>
												<td> 
													Auditoria, Extracciones, Actualizacion Stock
												</td>
											</tr>
											<tr>
												<td> 7.- Drogueria </td>
												<td>
													Auditoria, Carga Archivos
												</td>
											</tr>
											<tr>
												<td>8.- Modulo Dental</td>
												<td>
													Carga Archivos
												</td>
											</tr>
											<tr>
												<td>9.- Otro</td>
												<td>Extracciones</td>
											</tr>
											<tr>
												<td>10.- Registro Clínico &nbsp;</td>
												<td> El control de todo </td>
											</tr>
											<!--<tr>
												<td>11.- COSAM </td>
												<td> Auditoría </td>
											</tr>-->
										</tbody>
									</TABLE>
								</div>
							</div>
						</div>
					
					</div>
					<!-- END MODAL BODY-->
					<div class="modal-footer" style="background-color: #fef9f4 !important;">
						<div class="form-horizontal">
								<button type="button" class="btn btn-primary" data-dismiss="modal"> Cerrar </button>
				
						</div>
					</div>
				</div>
			</div>
		</div>

    </div>

</body>
</html>