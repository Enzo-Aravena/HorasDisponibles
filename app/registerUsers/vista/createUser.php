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
	<script src="../../../lib/js/datatable-editable.js" type="text/javascript"></script>
	<script src="../../../lib/js/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="../../../lib/js/modernizr.custom.js"></script>

	<script src="../controlador/cliente/createController.js"></script>	
	<script src="js/createUser.js"></script>

	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
</head>
	<body>
		<div class="container-fluid main-content" id="modificarUsuario" data-role="popup" data-theme="a" class="ui-corner-all">
	      		<div class="row">
				  <div class="col-md-12">
				    <div class="widget-container">
				      <div class="heading">
				        <i class="fa fa-users"></i>
				        <label style="margin-left: 1%;"> Crear Usuarios</label>
				      </div>
				      <div class="widget-content padded">
				        <div id="validate-form">
				          <fieldset>
				            <div class="row">
				            	<!-- PRIMERA COLUMNA-->
								<div class="col-md-4">
									<div class="form-group">
					                  <label for="rut">Rut</label>
					                  <input class="form-control" id="rut" name="rut" type="text" placeholder="Ingrese su rut" minlength="9"
					                  maxlength="10">
					                </div>
					                <div class="form-group">
					                  <label for="nombre">Nombre</label>
					                  <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Ingrese Nombre" minlength="2">
					                </div>

					                <div class="form-group">
					                  <label for="password">contraseña</label>
					                  <input class="form-control" id="clave" name="clave" type="password" placeholder="Ingrese su contraseña" minlength="6" maxlength="10">
					                </div>	                
						        	<div class="form-group">
					                  <label for="username">Estado</label>
					                  <select class="form-control" name="estado" id="estado">
							              <option value="0"> Seleccione ... </option>
									      <option value="A">Activo</option>
									      <option value="B"> Bolqueado</option>      
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
										<div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy"  id="fnac">
											 <input class="form-control" type="text" name="fnac" placeholder="dd/mm/yyyy"/>
											   <span class="input-group-addon">
											   		<i class="fa fa-calendar"></i>
											   </span>
											</input>
										 </div>
											 
									</div>

					                <div class="form-group">
					                  <label for="password">Repita contraseña</label><input class="form-control" id="reingClave" name="clave" type="password" placeholder="Repita su contraseña" minlength="6" maxlength="10">
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
					                  <label for="usuario">Usuario</label><input class="form-control" id="usuario" name="usuario" type="text" placeholder="Ingrese un usuario">
					                </div>	

					                <div class="form-group">
							            <label for="centro">Centro</label>
							          	  <select class="form-control"  name="centro" id="centro">
										</select>
							        </div>	

				             	 </div>
				            </div>	

				             <div id="pswd_info">								   
						    <ul>
						      <li id="minuscula" class="incorrecto"> Debe contener <strong> minúsculas </strong>
						      </li>
						      <li id="mayuscula" class="incorrecto"> Debe contener <strong>una Mayúscula</strong>
						      </li>
						      <li id="numero" class="incorrecto"> Debe contener <strong>un Número</strong>
						      </li>
						      <li id="largo" class="incorrecto"> Debe contener <strong>8 caracteres</strong>
						      </li>
						    </ul>
						  </div>
				            			          
				            <div style="margin-left: 37%;">
				            	 <button class="btn btn-primary" id="create">Crear Usuario</button> 	
				            	 <button class="btn btn-primary" id="cancelar" style="width: 16%;">Cancelar</button> 	
				            	 	<span  id="msgboxOk" style="color: green;"> </span>
				         			<span  id="msgboxError" style="color: red;"> </span>		            	
				            </div>
				          
		       			   
				          </fieldset>
				        </div>
				      </div>
				    </div>
				  </div>
				</div>
		</div>
	</body>
</html>