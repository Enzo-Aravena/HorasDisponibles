<?php
?>
<!DOCTYPE html>
<html>
<head>
<title>Prueba TIC SALUD</title>
<meta charset="UTF-8">
<!-- Revisar los iconos de imagenes-->	
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
	<link href="css/estilosRem.css" media="all" rel="stylesheet" type="text/css" />
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<script src="../../../lib/jquery-1.12.4.js"></script>
	<?php include_once("../../../lib/components.php");?>	
	<script src="../controlador/cliente/subirArchivo.js"></script>	
	<script src="js/subirAjax.js"></script>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
</head>
	<body>
		<div class="widget-container">
			
			<div class="heading">
				<i class="fa fa-cloud-upload"></i>Subir REM
			</div>
			<div class="widget-content padded">
				
				<form class="form-horizontal" enctype="multipart/form-data" id="detalle">
					<input type='hidden' name="usuario" value='<?php echo $_SESSION['username'];?>' id='usuario' /> 
					
					<input  class="form-control" type='hidden' value='' name="usuarioSesion" id='usuarioSesion' /> 
					<div class="form-group">
	          			<label class="control-label col-md-2"> Seleccione Archivos a Subir: </label>
			            <div class="col-md-3">
			              	<input type="file" name="prueba"  id="subirArchivo"  class="form-control">
			            </div>
		          	</div>
		          	<div class="form-group">
		          		<label class="control-label col-md-2"> Centro :</label>
			            <div class="col-md-3">
			              	<select class="form-control" name="centro" id="centro">
								<option value="0"> Seleccione ... </option>
								<option value="01.SANLUIS">SAN LUIS</option>
								<option value="02.CAROLURZUA">CAROL URZUA</option>
								<option value="03.LAFAENA">LA FAENA</option>
								<option value="04.LOHERMIDA">LO HERMIDA</option>
								<option value="05.CARDENALSILVAH">CARDENAL S.H</option>
								<option value="06.PADREGERARDOW">PADRE G.W</option>
								<!-- <option value="07.LASTORRES"> LAS TORRES </option> -->
							</select>
			            </div>
			        </div>

			        <div class="form-group">
			        	<label class="control-label col-md-2"> Serie :</label>
			        	<div class="col-md-3">
			        		<select class="form-control" name="serie" id="serie">
								<option value="0"> Seleccione ... </option>				
								<option value="A">SERIE A</option>
								<option value="B">SERIE B</option>
								<option value="D">SERIE D</option>
							</select>
			        	</div>
			        </div>

			        <div class="form-group">
			        	<label class="control-label col-md-2"> Mes :</label>
			        	<div class="col-md-3">
			        		<select class="form-control" name="mes" id="mes">
								<option value="0"> Seleccione ... </option>
								<option value="01.ENERO">ENERO</option>
								<option value="02.FEBRERO">FEBRERO</option>
								<option value="03.MARZO">MARZO</option>
								<option value="04.ABRIL">ABRIL</option>
								<option value="05.MAYO">MAYO</option>
								<option value="06.JUNIO">JUNIO</option>
								<option value="07.JULIO">JUNIO</option>  
								<option value="08.AGOSTO">AGOSTO</option>
								<option value="09.SEPTIEMBRE">SEPTIEMBRE</option>
								<option value="10.OCTUBRE">OCTUBRE</option>
								<option value="11.NOVIEMBRE">NOVIEMBRE</option>
								<option value="12.DICIEMBRE">DICIEMBRE</option>
							</select>
			        	</div>
			        </div>

			        <div class="form-group">
			        	<label class="control-label col-md-2"> Año :</label>
			        	<div class="col-md-3">
			        		<select class="form-control"  name="anio" id="anio">
								<option value="2019">2019</option>
								<option value="2020">2020</option>
								<option value="2021">2021</option>
							</select>
			        	</div>
			        </div>

			        <div class="form-group">
			            <label class="control-label col-md-2">Tipo de Envío : </label>
			            	<div class="col-md-7">
					              <label class="radio-inline">
					              	<input name="envio" type="radio"  id="Final" value="Final" checked="">
					              		<span> Final</span>
					              </label>

					              <label class="radio-inline">
					              	<input name="envio" type="radio" id="Correccion" value="Correccion">
					              		<span>Corrección</span>
					              </label>
			              
			                </div>
			        </div>

			        <div class="form-group">
						<label class="control-label col-md-2 tipo"> Comentario</label>
						<div class="col-md-3">
							<textarea class="form-control" rows="3" id="mensaje" name="mensaje"></textarea>
						</div>
					</div>
				</form>

				<div class="form-group">
					<div class="col-md-4"></div>
					<div class="col-md-">
						<input class="btn btn-primary" type="button" id='upload' value="Subir Archivo"/>	
					</div>
					
				</div>

				<div class="form-group">
					<div class="col-md-2"></div>
					<div class="col-md-5">
						<label id="resultadoCarga"></label>
					</div>
					
				</div>


				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header" style="background: #007aff;">
								<button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
								<h4 class="modal-title" style="color:white;">Envío Rem</h4>
							</div>
							<div class="modal-body" style="text-align: center;">
								<label class="control-label" id="mensajePopup">
								</label>
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