<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html style="overflow: hidden;">
<head>
<meta charset="UTF-8">
	<link href="../../../lib/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />   
	<link href="../../../lib/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/se7en-font.css" media="all" rel="stylesheet" type="text/css" />  
	<link href="../../../lib/css/style.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/datepicker.css" media="all" rel="stylesheet" type="text/css" />

	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<script src="../../../lib/js/jquery.dataTables.min.js" type="text/javascript"></script>	
	<script src="../../../lib/js/jquery.inputmask.min.js" type="text/javascript"></script>
	<script src="../../../lib/js/datatable-editable.js" type="text/javascript"></script>
	<script src="../../../lib/js/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="../../../lib/js/modernizr.custom.js"></script>
	
	<script src="../controlador/cliente/searchtoModify.js"></script>
	<script src="js/navegador.js"></script>
	<script src="js/modifyUser.js"></script>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">	
</head>
	<body>
		<div class="container-fluid main-content"  style="margin-top: 2%;" id="modificarUsuario" data-role="popup" data-theme="a" class="ui-corner-all">
	      		<div class="row" id="modificano">
				  <div class="col-md-12">
				    <div class="widget-container">
				      <div class="heading">
				        <i class="fa fa-user"></i>
				        <label style="margin-left: 1%;"> Modificar Usuarios</label>
				      </div>
				      <div class="widget-content padded">
				        <div id="validate-form">
				          <fieldset>
				            <div class="row" id="ModificarData">
				            	<!-- PRIMERA COLUMNA-->
				            	<input type='hidden' value=<?php echo $_REQUEST['rut'];?> id='hrut' />
								<div class="col-md-4">
									<div class="form-group">
					                  <label for="rut">Rut</label>
					                  <input class="form-control" id="rut" name="rut" type="text" disabled>
					                </div>
					                <div class="form-group">
					                  <label for="nombre">Nombre</label>
					                  <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Ingrese Nombre" minlength="2">
					                </div>                
						        	<div class="form-group">
					                  <label for="username">Estado</label>
					                  <select class="form-control" name="estado" id="estado">
							              <option value="0"> Seleccione ... </option>
									      <option value="A">Activo</option>
									      <option value="B"> Bolqueado</option>      
						          	  </select>
					                </div>

					                <div class="form-group">
							            <label for="centro">Centro</label>
							          	  <select class="form-control"  name="centro" id="centro">
										</select>
							        </div>	

				             	 </div>
				             	 <!-- SEGUNDA COLUMNA-->
				             	 <div class="col-md-4">
				             	 	<div class="form-group">
					                  <label for="apat">Apellido Paterno</label><input class="form-control" id="apat" name="apat" type="text" placeholder="Ingrese Apellido Paterno" minlength="2">
					                </div>
					                <label for="fnac"> Fecha Nacimiento </label>	               
									<div class="form-group">
										<input class="form-control" id="fnac" name="fnac" type="text"  placeholder="dd/mm/yyyy" minlength="6" maxlength="10">
									</div>					             
					                
						       		 <div class="form-group">
						            	<label for="password">Tipo de perfil</label>
						          	    <select class="form-control"  name="tipoPerfil" id="tipoPerfil">
										</select>
						       		 </div>		                													         
				             	 </div>
				             	 <!-- TERCERA COLUMNA-->
				             	 <div class="col-md-4">
									<div class="form-group">
					                  <label for="amat">Apellido Materno</label><input class="form-control" id="amat" name="amat" type="text" placeholder="Ingrese Apellido Materno">
					                </div>
					                
					               <div class="form-group">
						            <label for="sexo">Sexo</label>
						              <select class="form-control" name="sexo" id="sexo">
							              <option value="0"> Seleccione ... </option>
									      <option value="F">Femenino</option>
									      <option value="M">Masculino </option>				    
						          	  </select>
						        	</div>	

						        	<div class="form-group">
					                  <label for="usuario">Usuario</label><input class="form-control" id="usuario" name="usuario" type="text" placeholder="Ingrese un usuario" disabled> 
					                </div>			               

				             	 </div>
				            </div>

				            <div style="margin-left: 70%;margin-top: 2%;">
				           		<button class="btn btn-primary" id="modificar">Modificar Usuario</button> 	
				           		<button class='btn btn-primary' style='width: 28%;' id='cerrar'> Cancelar </button>
				            </div>				          
				           
				            <span  id="msgboxError" style="color: red; margin-top: -2%;position: absolute;"> </span>
		       			   	<span  id="msgboxOk" style="color: green;margin-top: -2%;position: absolute;"> </span>
				          </fieldset>
				        </div>
				      </div>
				    </div>
				  </div>
				</div>
				<!-- Fin row -->

				<div id="datos">					
				</div>

				<div id="loader">
					<!--<span class="loader"></span>		-->
					<img src="../../../lib/images/loading.gif">				
				</div>
						

		</div>
	
	</body>
</html