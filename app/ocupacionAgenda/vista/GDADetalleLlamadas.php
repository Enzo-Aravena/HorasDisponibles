<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="../../../lib/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />   
	<link href="../../../lib/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/se7en-font.css" media="all" rel="stylesheet" type="text/css" />  
	<link href="../../../lib/css/style.css" media="all" rel="stylesheet" type="text/css" />
	<!-- bootstrap para subir archivo-->
	<link href="../../../lib/css/bootstrap-editable.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/jquery.fileupload-ui.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/datatables.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/datepicker.css" media="all" rel="stylesheet" type="text/css" />
	<link href="css/estiloCss.css" media="all" rel="stylesheet" type="text/css" />

	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<script src="../../../lib/js/jquery.dataTables.min.js" type="text/javascript"></script>	
	<script src="../../../lib/js/datatable-editable.js" type="text/javascript"></script>
	<script src="../../../lib/js/bootstrap-fileupload.js" type="text/javascript"></script>
		<script src="../../../lib/js/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="../../../lib/js/modernizr.custom.js"></script>

	<script src="../controlador/cliente/controladorOcupacionAgenda.js"></script>	
	<script src="js/ocupacionAgenda.js"></script>

	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
</head>
  <body>
    <div class="modal-shiftfix" id="detalle">
      <!-- Navigation -->
      <div class="navbar" style="height:8%;border:none;">
         <div class="container-fluid main-nav clearfix">
              <div class="nav-collapse">
                <ul class="nav" id="menu">
                </ul>           
              </div>
          </div>
      </div>

	    <div class="heading" style="    margin-left: 2%;"> 
	    	<img src="../../../lib/images/diary.png" width="26px">
				<label style="margin-left: 1%;">GDA Detalle de Llamadas </label>
	    </div>

			<div class="widget-content padded">

				<!-- INICIO FORM GROUP-->
				<div class="form-group">
					<!-- INICIO FECHAS-->
					<div class="col-md-4 bordes">
						<label class="control-label col-md-1" style="width: 24%;margin-top: 9px;">
						Seleccione fecha
						</label>
						<!-- INICIO FECHAS-->
						<div class="col-md-4">
							<div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy"  id="desde">
								<input class="form-control fechas" type="text" name="desde" placeholder="dd/mm/yyyy" style="cursor: pointer;" />
								<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
								</span>								
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy" id="hasta">
								<input class="form-control fechas" type="text" name="hasta" placeholder="dd/mm/yyyy" style="cursor: pointer;"/>
								<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
								</span>
							</div>
						</div>						
					</div>
					<!-- FIN FECHAS-->


					<div class="col-md-6 bordes" style="margin-left: 1%;width: 38%;">
						<label class="control-label col-md-1"  style="width: 9%;margin-top: 9px;">
							Semana
						</label>
						&nbsp;
						&nbsp;
						<label class="radio-inline" style="margin-right: 2px;">
							<input name="semana" type="radio" value="todo" checked>
							<span>Todos</span>
						</label>

						<label class="radio-inline" style="margin-right: 2px;">
							<input name="semana" type="radio" value="lunes">
							<span>Lunes</span>
						</label>
						
						<label class="radio-inline" style="margin-right: 2px;">
							<input name="semana" type="radio" value="martes">
							<span>Martes</span>
						</label>
						
						<label class="radio-inline" style="margin-right: 2px;">
							<input name="semana" type="radio" value="miercoles">
							<span>Miércoles</span>
						</label>
						
						<label class="radio-inline" style="margin-right: 2px;">
							<input name="semana" type="radio" value="jueves">
							<span>Jueves</span>
						</label>
						
						<label class="radio-inline" style="margin-right: 2px;">
							<input name="semana" type="radio" value="viernes">
							<span>Viernes</span>
						</label>

						<label class="radio-inline" style="margin-right: 2px;">
							<input name="semana" type="radio" value="sabado">
							<span>Sábado</span>
						</label>
						<p></p>
					</div>
					<!-- FIN FORM GROUP-->
					
				</div>
				<div style="width: 50%;">
				<br>
				<br>	
				</div>	
				<!-- INICIO FORM GROUP-->
				<div class="form-group">
					<div class="col-md-7 bordes">  <!-- style="width: 57%;" -->
							<label class="control-label col-md-1" style="width: 14%;margin-top: 9px;">
							Seleccione Centro
							</label>

							<label class="radio-inline" style="margin-right: 2px;">
								<input name="rdbBuscar" type="radio" value="todo" checked>
								<span>Todos</span>
							</label>

							<label class="radio-inline" style="margin-right: 2px;">
								<input name="rdbBuscar" type="radio" value="CU">
								<span>Carol Urzúa</span>
							</label>
							
							<label class="radio-inline" style="margin-right: 2px;">
								<input name="rdbBuscar" type="radio" value="CSH">
								<span>Cardenal Silva H.</span>
							</label>
							
							<label class="radio-inline" style="margin-right: 2px;">
								<input name="rdbBuscar" type="radio" value="CSM">
								<span>Cosam</span>
							</label>
							
							<label class="radio-inline" style="margin-right: 2px;">
								<input name="rdbBuscar" type="radio" value="LF">
								<span>La Faena</span>
							</label>
							
							<label class="radio-inline" style="margin-right: 2px;">
								<input name="rdbBuscar" type="radio" value="LH">
								<span>Lo Hermida</span>
							</label>

							<label class="radio-inline" style="margin-right: 2px;">
								<input name="rdbBuscar" type="radio" value="PGW">
								<span>Padre Gerardo W.</span>
							</label>
							
							<label class="radio-inline" style="margin-right: 2px;">
								<input name="rdbBuscar" type="radio" value="SL">
								<span>San Luís</span>
							</label>
							<p></p>
					</div>							
				</div>
				<!-- FIN FORM GROUP-->
				<div style="width: 50%;">
				<br>
				<br>	
				<br>
				</div>	
				<!-- INICIO FORM GROUP-->
				<div class="form-group">
					<div class="col-md-4">
					</div>
					<div class="col-md-3" style="margin-left: 1%;">
						
	                		<button style="width: 10em;" class="btn btn-primary" id="ejecutar">Buscar</button>	
	                	&nbsp;
	                		<img src="../../../lib/images/exportExcel.png" id="exportar">
			                <label for="excel" id="exportar">Exportar a Excel</label>	 
	                	
					</div>
				</div>
				<!--  FIN FORM GROUP-->	
					<div style="    width: 50%;">
				<br>
				<br>	
				<br>
				</div>
				<div class="form-group bordes" >

					aqui viene el grafico 

				</div>	
        <br><br>

				<div class="form-group bordes">

					aqui se cargan las tablas

				</div>	
				
			</div>
		</div>

	</body>
</html>