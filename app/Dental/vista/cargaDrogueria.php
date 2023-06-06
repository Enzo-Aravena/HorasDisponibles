<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
		<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<script src="../../../lib/jquery-1.12.4.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
	<!--  EXTRAE TODA LA DATA DL COMPONENTE PRINCIPAL-->
	<?php include_once("../../../lib/components.php");?>
	<!-- load jQuery and tablesorter scripts -->
	<script type="text/javascript" src="../../../lib/jquery/jquery.tablesorter.min.js"></script>
	<!-- tablesorter widgets (optional) -->
	<script type="text/javascript" src="../../../lib/jquery/jquery.tablesorter.widgets.js"></script>
	<script src="js/navegadorCargaDrogueria.js"></script>
</head>
<body>
	<div class="widget-container padded" style="box-shadow: none !important;">
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
					<h3> Carga de archivo a Droguería</h3>
				</div>
				<form class="form-horizontal" enctype="multipart/form-data"  id="detalle">
					<div class="form-group">
	          			<label class="control-label col-md-2"> Seleccione Archivos a Subir: </label>
			            <div class="col-md-3">
			              	<input type="file" name="prueba"  id="subirArchivo"  class="form-control">
						</div>
						<span class="position-relative" style="display: inline-block;position: relative;">
						<div id="mostrarMas" class="more d-flex justify-content-center align-items-center p-2" data-toggle="tooltip" data-placement="bottom" title="Click para ver mas">
							<img src="../../../lib/images/info.png" style="min-width: 21px;width:21px;"/>
						</div>
						<div class="position-absolute d-none recuadro" id="recuadroData" style="padding: 10px;border: 1px solid black;position: absolute;">
							<br>
							<div class="form-horizontal">
								<h4><b><span>Estructura Columnas archivo Excel: </span></b><h4>
							</div>
							<div class="form-horizontal">
								<div class="table-bordered">
									<table class="table">
									<thead>
										<th class="text-center" style="border: 1px solid;"> Material</th>
										<th class="text-center" style="border: 1px solid;"> Texto breve de material</th>
										<th class="text-center" style="border: 1px solid;"> Fe.contab.</th>
										<th class="text-center" style="border: 1px solid;"> Cantidad</th>
										<th class="text-center" style="border: 1px solid;"> UME</th>
										<th class="text-center" style="border: 1px solid;"> Impte.ML</th>
										<th class="text-center" style="border: 1px solid;"> Txt.cabec.</th>
										<th class="text-center" style="border: 1px solid;"> Ce.coste</th>
										<th class="text-center" style="border: 1px solid;"> Lote</th>
										<th class="text-center" style="border: 1px solid;"> Referencia</th>
										<th class="text-center" style="border: 1px solid;"> Hora</th>
										<th class="text-center" style="border: 1px solid;"> Reserva</th>
										<th class="text-center" style="border: 1px solid;"> Usuario</th>
										<th class="text-center" style="border: 1px solid;"> CMv</th>
										<th class="text-center" style="border: 1px solid;"> Cliente</th>
									</thead>
									<tbody>
									</tbody>
									</table>
								</div>
							</div>
						</div>
					</span>
						
			            
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
	          		<h4><label class="control-label col-md-6" style="color:red;">  Se encontraron los siguientes errores en el archivo excel, favor corregir y volver a subir el archivo</label></h4>
	          	</div>
	          	<div class="form-group">
	          		<div class="col-lg-1"></div>
	          		<div class="col-lg-6">
	          			<div class="table-bordered">
							<table class="table">
							<thead>
								<th class="text-center">Nº Fila</th>
								<th class="text-center">Codigo Material</th>
								<th class="text-center">Fe.contab</th>
								<th class="text-center">Cantidad</th>
								<th class="text-center">Impte.ML</th>
								<th class="text-center">Txt.cabec.</th>
								<th class="text-center">Ce.coste</th>
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
							<button type="button" class="close" data-dismiss="modal" id="close" style="color:white;">&times;</button>
							<h4 class="modal-title" style="color:white;">Carga droguería</h4>
						</div>
						<div class="modal-body" style="text-align: center;">
							<h3><label class="control-label" id="mensaje">

							</label>
							</h3>
						</div>
						<div class="modal-footer">
							<button type="button" style="background: #007aff;" class="btn btn-default" data-dismiss="modal" id="cerrar">Cerrar</button>
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
									 - En el módulo de carga de archivos de droguería tiene  el objetivo de cargar el stock actualizado, para luego ser procesado internamente para luego ser cargado en OMI.<br />
								</label>
								<br>
								<img src="../../../lib/images/manuales/drogueria/inicio.png" style="display:block;margin:auto;min-width: 20em;width: 35em;" />
							</div>
							<br>
							<div class="col-md-12">
								<label>
									-Cuando se selecciona un archivo debe tener el nombre “OMI ” y la fecha la cual se sube el archivo , como por ejemplo, 06052019, solo se admiten archivos Excel de tipo XLSX. De lo contrario no podrá ser ingresado al sistema.
								</label>
								<br>
								<img src="../../../lib/images/manuales/drogueria/cargarArchivo.png"  style="display:block;margin:auto;min-width: 20em;width: 35em;" />
							</div>
							<br>
							<div class="col-md-12">
								<label>
									- Luego de  hacer click subir Archivo,  se procesa el archivo y valida que cada uno de los datos ingresados estén correctos, si estos fueron validados correctamente le mostrara el mensaje.
								</label>
								<br>
								<img src="../../../lib/images/manuales/drogueria/carga.png" style="display:block;margin:auto;min-width: 20em;width: 35em;" />
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
