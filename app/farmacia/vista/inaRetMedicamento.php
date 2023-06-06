<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
		<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
	<link href="css/farmacia.css" media="all" rel="stylesheet" type="text/css" />
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<script src="../../../lib/jquery-1.12.4.js"></script>
	<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.21/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.21/datatables.min.js"></script>-->
	<!--  EXTRAE TODA LA DATA DL COMPONENTE PRINCIPAL-->
	<?php include_once("../../../lib/components.php");?>


	<script src="../controlador/cliente/InaRetMedController.js?id=2"></script>
	<script src="js/navInaRetMedicamento.js?id=2"></script>

	<style type="text/css">
		/*div.dataTables_wrapper div.dataTables_paginate ul.pagination {
		    margin: 2px 0;
		    white-space: nowrap;
		    width: 50em !important;
    		margin-left: -15em !important;
		}*/
	</style>
</head>
<body>
	<input type='hidden' value='<?php echo $_SESSION['centro'];?>' id='centro'>
	<div class="widget-container padded">
		<div class="widget-content padded">
			<div class="form-horizontal"> &nbsp; </div>
			<div class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-md-1"> Buscar por </label>
					<div class="col-md-2">
						<label class="radio-inline">
							<input checked="" name="rdbBuscarPor" type="radio" value="rut">
							<span> Rut </span>
						</label>			
						<label class="radio-inline">
							<input name="rdbBuscarPor" type="radio" value="fecha">
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
						<div class="col-md-13">
							<div class="form-group">
								<div class="col-md-7">
									<label class="control-label col-md-1">Centro</label>
									<!--<label class="radio-inline" style="margin-right: 7px !important;">
										<input name="rdbBuscar" type="radio" value="0" checked>
										<span style="font-size: 14px;">Todos</span>
									</label>-->

									<label class="radio-inline">
										<input name="rdbBuscar" type="radio" value="10">
										<span style="font-size: 14px;">S.L</span>
									</label>

									<label class="radio-inline">
										<input name="rdbBuscar" type="radio" value="6">
										<span style="font-size: 14px;">C.U</span>
									</label>

									<label class="radio-inline">
										<input name="rdbBuscar" type="radio" value="8">
										<span style="font-size: 14px;">L.F</span>
									</label>

									<label class="radio-inline">
										<input name="rdbBuscar" type="radio" value="3">
										<span style="font-size: 14px;">L.H</span>
									</label>

									<label class="radio-inline">
										<input name="rdbBuscar" type="radio" value="4">
										<span style="font-size: 14px;">C.S.H</span>
									</label>

									<label class="radio-inline">
										<input name="rdbBuscar" type="radio" value="103">
										<span style="font-size: 14px;">P.G.W</span>
									</label>
									<label class="radio-inline">
										<input name="rdbBuscar" type="radio" value="36">
										<span style="font-size: 14px;">COSAM</span>
									</label>

									<label class="radio-inline">
										<input name="rdbBuscar" type="radio" value="106">
										<span style="font-size: 14px;">L.T </span>
									</label>
								</div>
							</div>
						</div>
					</div>

	        <div class="form-horizontal">
	        	<div class="col-md-5"> 
	        		<!--<span>Importante: Si necesita mas de 1 mes de extracción , debe contactarse con registro clínico</span>-->
	        	</div>
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
		   	
	            <div class="container-fluid main-content">

        <!-- DataTables Example -->
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        	<thead>
       			<th>  </th>
    			<th> Centro </th>
    			<th> Codigo </th>
    			<th> Medicamento </th>
    			<th> Rut Paciente </th>
    			<th> Nombre Paciente </th>
    			<th> Inicio TTO </th>
    			<th> Fecha entrega </th>
    			<th> Tipo receta </th>
    			<th> Cant no dispensada </th>
    			<th> Stock inicial </th>
    			<th> Stock final </th>
       		</thead>
				<tbody id="tabla_resultados">
       		</tbody>
        
    	</table>

    	<!--<table class="table table-striped table-bordered" id="tabla_resultados" style="width:100%"></table>-->
      </div>


      	<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background: #007aff;">
						<button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
						<h4 class="modal-title" style="color:white;">Pacientes inasistente Retiro Medicamentos</h4>
					</div>
					<div class="modal-body" style="text-align: center;">
						<label class="control-label" id="mensaje"></label>
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