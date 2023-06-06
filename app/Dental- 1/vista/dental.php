<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
	<link href="../../../lib/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/se7en-font.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/style.css" media="all" rel="stylesheet" type="text/css" />
	<link href="css/estilosDental.css" media="all" rel="stylesheet" type="text/css" />
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<script src="../../../lib/jquery-1.12.4.js"></script>
	<script src="../../../lib/jquery-ui.js"></script>
	<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/se7en-font.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/jquery.fancybox.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/fullcalendar.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/select2.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/datatables.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/timepicker.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/colorpicker.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/bootstrap-editable.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/daterange-picker.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/style.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/color/green.css" media="all" rel="alternate stylesheet" title="green-theme" type="text/css" />
	<link href="../../../lib/css/color/orange.css" media="all" rel="alternate stylesheet" title="orange-theme" type="text/css" />
	<link href="../../../lib/css/color/magenta.css" media="all" rel="alternate stylesheet" title="magenta-theme" type="text/css" />
	<link href="../../../lib/css/color/gray.css" media="all" rel="alternate stylesheet" title="gray-theme" type="text/css" />
	<script src="../../../lib/jquery-1.12.4.js"></script>
	<script src="../../../lib/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../../../lib/js/selectivizr-min.js" type="text/javascript"></script>
	<script src="../../../lib/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
	<script src="../../../lib/js/fullcalendar.min.js" type="text/javascript"></script>
	<script src="../../../lib/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="../../../lib/js/datatable-editable.js" type="text/javascript"></script>
	<script src="../../../lib/js/modernizr.custom.js" type="text/javascript"></script>
	<script src="../../../lib/js/select2.js" type="text/javascript"></script>
	<script src="../../../lib/js/bootstrap-timepicker.js" type="text/javascript"></script>
	<script src="../../../lib/js/bootstrap-colorpicker.js" type="text/javascript"></script>
	<script src="../../../lib/js/bootstrap-editable.min.js" type="text/javascript"></script>
	<script src="../../../lib/js/date.js" type="text/javascript"></script>
	<script src="../../../lib/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
	<script src="../../../lib/js/jquery.validate.js" type="text/javascript"></script>
	<script src="../../../lib/js/date.js" type="text/javascript"></script>
	<script src="js/navegadorDental.js"></script>
	</head>
	<body>
	<div class="widget-container padded">

		<input type='hidden' value='<?php echo $_SESSION['permisos'];?>' id='permisos'>		
      <div class="widget-content padded">
      		<ul class="nav nav-tabs">
		     	<li class="active" ><a data-toggle="tab" href="#tab1" id="tabla1"> <img src="../../../lib/images/examinating-tooth.png" width="23px">  Dental </a></li>
		        <li><a data-toggle="tab" href="#tab2" id="tabla2"><i class="glyphicon glyphicon-cloud-upload"></i> Drogueria </a></li>
		    </ul>


		     <div class="tab-content">
	        	<div class="tab_content" id="tab1">
	        		<div class="form-horizontal"> &nbsp;</div>
	        		<div class="form-horizontal">
	        			<div class="col-md-2">
							<button class="btn btn-success" id="abrirPopUp">Manual de Usuario</button>
						</div>
	        		</div>

	        		<div class="form-horizontal"> &nbsp;</div>
	        		<form class="form-horizontal" enctype="multipart/form-data"  id="upload_form">
        				<div class="form-horizontal"> &nbsp;</div>
						<div class="form-group">
							<label class="control-label col-md-2"> Seleccione:</label>
							<div class="col-md-7">
								<label class="radio-inline">
									<input checked="" name="rdbBuscar" type="radio" value="rutPaciente">
									<span> RUT</span>
								</label>
								<label class="radio-inline">
									<input  name="rdbBuscar" type="radio" value="esDni">
									<span>DNI</span>
								</label>
							</div>
						</div>


			          	<div class="form-group" id="mostrarCampoRut">
			          		<label class="control-label col-md-2"> Rut Paciente :</label>
				            <div class="col-md-3">
				              	<input style="cursor: pointer;" class="form-control" placeholder="ejemplo 12345678-9" type="text" id="rut" name="rut" maxlength="10" minlength="9" autocomplete="off">
				              	<label class="Error" id="validacion"></label>
				              	<label class="correct" id="validacionRut"></label>
				            </div>
			          	</div>

			          	<div class="form-group" id="mostrarCampoDni">
			          		<label class="control-label col-md-2"> DNI Paciente :</label>
				            <div class="col-md-3">
				              	<input style="cursor: pointer;" class="form-control" placeholder="ejemplo PP220651" type="text" id="dni" name="dni" maxlength="10" minlength="9" autocomplete="off">
				              	<label class="Error" id="validacionDni"></label>
				              	<label class="correct" id="validacionDniOk"></label>
				            </div>
			          	</div>

			          	<div class="form-group" id="mostrarCampoRut">
			          		<label class="control-label col-md-2"> Nombre Paciente :</label>
				            <div class="col-md-3">
				              	<input style="cursor: pointer;" class="form-control" placeholder="Ingrese Nombre Paciente ..." type="text" id="nombre" name="nombre" autocomplete="off">
				              	<label class="Error" id="validaNombre"></label>
				              	<label class="correct" id="validaNombreOk"></label>
				            </div>
			          	</div>

			          	<div class="form-group">
				            <label class="control-label col-md-2">Fecha Creacion </label>
				            <div class="col-md-3">
				            	<div class="input-group date" data-date-autoclose="true" data-date-format="dd-mm-yyyy" id="desde">
				            		<input class="form-control" data-format="dd-MM-yyyy hh:mm:ss" type="text" name="desde" id="FechaS" autocomplete="off">
				            			<span class="input-group-addon add-on"><i class="fa fa-calendar" id="FechasDe"></i></span>
				            		<label class="Error" id="validaFecha"></label>
				            		<label class="correct" id="validaFechaOk"></label>
				            	</div>
				            </div>
		          		</div>

			          	<div class="form-group">
		          			<label class="control-label col-md-2"> Seleccione Imagenes a Subir: </label>
				            <div class="col-md-3">
				              	<input type="file" data-device="desktop" name="images[]" id="img_select" multiple class='form-control' accept="image/*" required>
				              	<label class="Error" id="ErrorArchivo"></label>
				              	<label id="PesoArchivo"></label>
				              	<label class="Error" id="validaArchivo"></label>
			            		<label class="correct" id="validaArchivoOk"></label>
			            		 <div id="selectedFiles"></div>
				            </div>
			          	</div>
				    </form>
				    
			        <div class="form-horizontal">
			         	<div class="form-group">
			          		<div class="col-md-3"></div>
				            <div class="col-md-3">
				              	<button class="btn btn-primary" id="ejecutar">Cargar Imágenes</button>
				            </div>
			          	</div>
			        </div>

			        <!-- Modal -->
					<div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background: #007aff;">
									<h4 class="modal-title" style="color:white;">imagen Dental</h4>
									<button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
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
					<!-- FIN Modal -->

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
											 - El módulo de carga de imágenes dentales, consiste en subir las imágenes dentales de los pacientes, para ser visualizada en la plataforma de exámenes. En las cuales se deben llenar los campos que se aprecian a continuación.<br />
										</label>
										<br>
										<img src="../../../lib/images/manuales/dental/inicio.png" style="display:block;margin:auto;min-width: 20em;width: 35em;" />
									</div>
									<br>
									<div class="col-md-12">
										<label>
											- módulo puede cargar las imágenes dentales por RUT, DNI del paciente el cual se puede seleccionar con un radio
										</label>
										<br>
										<img src="../../../lib/images/manuales/dental/rut.png"  style="display:block;margin:auto;" />
										<br>
										<img src="../../../lib/images/manuales/dental/dni.png" style="display:block;margin:auto;" />
									</div>
									<br>
									<div class="col-md-12">
										<label>
											- Debe seleccionar una fecha para poder cargar las imagenes
										</label>
										<br>
										<img src="../../../lib/images/manuales/dental/fecha.png" style="display:block;margin:auto;min-width: 20em;width: 35em;" />
									</div>
									<br>
									<div class="col-md-12">
										<label>
											-  Al presionar el botón “Cargar Imágenes”, le aparecerá un mensaje que dirá lo siguiente: “Imágenes Subidas Correctamente”
										</label>
										<br>
										<img src="../../../lib/images/manuales/dental/carga.png" style="display:block;margin:auto;min-width: 20em;width: 35em;" />
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" style="background: #007aff;" class="btn btn-default" data-dismiss="modal">Cerrar</button>
								</div>
							</div>
						</div>
					</div>


		        	</div>

	        	<div class="tab_content" id="tab2">
	        		<iframe src="cargaDrogueria.php" id="cargaDroguerias" style="width: 99%;height: 70em;border: none;overflow: hidden;">
	           		</iframe>
	        	</div>
		    </div>



      	 
	</div>

</body>
</html>




