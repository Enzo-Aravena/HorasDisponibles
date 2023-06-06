<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
	<meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<script src="../../../lib/jquery-1.12.4.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
	<!--  EXTRAE TODA LA DATA DL COMPONENTE PRINCIPAL-->
	<?php include_once("../../../lib/components.php");?>
	<script src="../../../lib/js/export.js"></script>	
	<script src="../../../lib/js/xlsx.full.min.js"></script>
    <script src="../../../lib/js/FileSaver.min.js"></script>
    <script src="../../../lib/js/tableexport.min.js"></script>
	<script src="../controlador/cliente/reportController.js"></script>	
	<script src="js/navReport.js"></script>
</head>
<body>
	<div class="widget-container padded">
		<div class="widget-content padded">
			<div class="form-horizontal"> &nbsp;</div>
    		<div class="form-horizontal">
    			<div class="col-md-2">
					<button class="btn btn-success" id="abrirPopUp">Manual de Usuario</button>
				</div>
    		</div>
			<div class="form-horizontal"> &nbsp; </div>

			<div class="form-horizontal">
				<div class="form-group">
					<h3> Carga de archivo</h3>
				</div>
				<form class="form-horizontal" enctype="multipart/form-data"  id="detalle">
					<div class="form-group">
	          			<label class="control-label col-md-2"> Seleccione Archivos a Subir: </label>
			            <div class="col-md-3">
			              	<input type="file" name="prueba"  id="subirArchivo"  class="form-control">
			            </div>
		          	</div>
	          	
		          	<div class="form-group">
		          		<div class="col-md-2"></div>
		          		<div class="col-md-5">
		          			<label class="checkbox-inline"><input type="checkbox" id="uno" name="uno">
			          			<span>CESFAM + SECTOR</span>
			          		</label><br>
			          		<label class="checkbox-inline"><input type="checkbox" id="dos" name="dos">
			          			<span>NOMBRE COMPLETO + SEXO + FECHA NACIMIENTO+ EDAD ACTUAL + NACIONALIDAD</span>
			          		</label><br>
			          		<label class="checkbox-inline"><input type="checkbox" id="tres" name="tres">
			          			<span> DIRECCION + TELEFONOS </span>
			          		</label><br>
			          		<label class="checkbox-inline"><input type="checkbox" id="cuatro" name="cuatro">
			          			<span> FECHA ULTIMO MOVIMIENTO EN FICHA </span>
			          		</label><br>
			          		<label class="checkbox-inline"><input type="checkbox" id="cinco" name="cinco">
			          			<span> EPISODIO DIABETES + EPISODIO HIPERTENSOS + EPISODIO DISLIPIDEMIA </span>
			          		</label><br>
			          		<label class="checkbox-inline"><input type="checkbox" id="seis" name="seis">
			          			<span> FECHA ULTIMO PROTOCOLO CARDIOVASCULAR </span>
			          		</label>
		          		</div>
		          	</div>
</form>

	          	<div class="form-group">
	          		<div class="col-md-2"></div>
	          		<div class="col-md-3">
	          			<button class="btn btn-primary" id="ejecutar">Cargar Archivo</button>
	          		</div>
	          	</div>
			</div>

			<div class="form-horizontal" id="resultadoCarga">
	          	<div class="form-group">
	          		<div class="col-lg-1"></div>
	          		<div class="col-lg-6">
	          			<label id="tabla_resultados"></label>
	          		</div>
	          	</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" style="background: #007aff;">
							<button type="button" class="close" data-dismiss="modal" id="close" style="color:white;">&times;</button>
							<h4 class="modal-title" style="color:white;">Reportería</h4>
						</div>
						<div class="modal-body" style="text-align: center;">
							<label class="control-label" id="mensaje">

							</label>
						</div>
						<div class="modal-footer">
							<button type="button" style="background: #007aff;" class="btn btn-default" data-dismiss="modal" id="cerrar">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- FIN Modal -->

		</div>
	</div><!-- DIV PRINCIPAL  -->
</body>
</html>
