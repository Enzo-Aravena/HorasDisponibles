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
		<?php include_once("../../../lib/components.php");?>
		<script src="../controlador/cliente/controladorReporteCentro.js?id=12"></script>	
		<script src="js/navegadorReporteCentro.js?id=12"></script>

		<style>
			.titulo{background-color: #0065d0;color: white;    text-align: center;}
			.citAnulado{color:white;background-color:#E67E22;text-align: center;}
			.AgeCan{color:white;background-color: #16a085; text-align: center;}
			.Cuerpo{text-align: center;}
		</style>
	</head>
	<body>
		<div class="widget-container padded">
			<div class="heading"> 
				<img src="../../../lib/images/repote.png" width="26px">
				<label style="margin-left: 1%;">Ciclos GDA </label>
			</div>

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
						<div class="col-md-2">
							<div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy"  id="hasta" style="padding: 0px !important;">
								<input class="form-control" type="text" name="hasta" placeholder="dd/mm/yyyy" autocomplete="off" />
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
							</div>
						</div>
						<button class="btn btn-primary" id="BuscarPorFecha">Buscar</button> 
						<button class="btn btn-primary" id="exportInforme">Exportar Informe</button> 
					</div>
				</div>
				
			</div>


			<div class="form-horizontal">
				<div class="form-group">
					<div class="col-md-1"></div>
					<div class="col-lg-9">	
						<label id="guardaDatos"></label>
						<div class="table-bordered" id="divTabla">
							<table class="table table-bordered">
								<thead>
									<tr class="titulo">
										<td ROWSPAN=2 style="text-align: left;">CESFAM</td>
										<td ROWSPAN=2>
											OFERTA <br>
											<label id="fecha" style="color: yellow;"></label>
										</td>
										<td colspan="2">TOTAL EFECTIVO	</td>
										<td colspan="2">TOTAL CICLOS</td> 
										<td colspan="2">CICLO 1</td> 
										<td colspan="2">CICLO 2</td>
										<td colspan="2">CICLO 3</td>
										<td colspan="2">CICLO 4</td>
										<td colspan="2">CICLO 5</td>
									</tr>
									<tr>
										<td class="citAnulado">CITADOS</td>
										<td class="citAnulado">ANULADOS</td>
										<td class="AgeCan">AGE</td>
										<td class="AgeCan">CAN</td>
										<td class="AgeCan">AGE</td>
										<td class="AgeCan">CAN</td>
										<td class="AgeCan">AGE</td>
										<td class="AgeCan">CAN</td>
										<td class="AgeCan">AGE</td>
										<td class="AgeCan">CAN</td>
										<td class="AgeCan">AGE</td>
										<td class="AgeCan">CAN</td>
										<td class="AgeCan">AGE</td>
										<td class="AgeCan">CAN</td>
									</tr>
								</thead>
								<tbody id="Resultado"></tbody>
							</table>
							<!--<div class="form-group">
								<div class="col-md-10"></div>
								<div class="col-lg-1">
									<button class="btn btn-primary" id="exportInforme">Exportar Informe</button> 
								</div>
							</div>-->
						</div>
					</div>
				</div>
			</div>



			<div id ="excel"></div>

		</div>
	</body>

</html>