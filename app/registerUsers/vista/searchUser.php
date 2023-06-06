<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
	<link href="../../../lib/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />   
	<link href="../../../lib/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="../../../lib/css/se7en-font.css" media="all" rel="stylesheet" type="text/css" />  
	<link href="../../../lib/css/style.css" media="all" rel="stylesheet" type="text/css" />
	<link href="css/style.css" media="all" rel="stylesheet" type="text/css" />
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<script src="../controlador/cliente/searchController.js"></script>	

	<script src="js/buscarUsuario.js"></script>

	<!--<script src="js/navegador.js"></script>-->
	</head>
	<body>
		<div class="widget-container padded">
				      <div class="heading"> 
				        <i class="glyphicon glyphicon-search"></i>
				        <label style="margin-left: 1%;">Buscar Usuarios </label>
				      </div>
				      <div class="widget-content padded">
				        <div class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-md-3">Seleccione el tipo de dato a buscar : </label>
								<div class="col-md-7">
								<label class="radio-inline">
									<input style="cursor: pointer;" checked="" name="rdbBuscar" type="radio" value="todo"><span> Todo</span>
								</label>		
								<label class="radio-inline">
									<input style="cursor: pointer;" name="rdbBuscar" type="radio" value="rut"><span> Rut</span>
								</label>	
								<label class="radio-inline">
									<input style="cursor: pointer;" name="rdbBuscar" type="radio" value="name"><span>Nombre</span>
								</label>
								<label class="radio-inline">
									<input style="cursor: pointer;" name="rdbBuscar" type="radio" value="username"><span> Usuario</span>
								</label>
								
								</div>
							</div>				        			        	
				          	<div class="form-group">
					            <label class="control-label col-md-2"> </label>
					            <div class="col-md-3">			        
					              <input style="cursor: pointer;" class="form-control" placeholder="Buscar ..." type="text" id="buscar" name="buscar">      
					            </div>
				          		   
								  <button class="btn btn-primary" id="ejecutar">Buscar</button> 
								  <label id="valorRadio" > </label>     		
				          	</div>  				          
				        </div>
				      </div>
				      <br>
				      <span id="msgbox" style="display:none"></span>   
				      <br>				     
				       <div class="widget-container fluid-height clearfix">
				       	<!-- Botones añadir usuarios-->
				       	<div class="row">
				       		<div class="col-md-6">
				            </div>
				       		<div class="col-md-1" style="margin-left: 2%;" >
				              <div class="widget-container fluid-height">
				                <button class="btn btn-default" name="boton" style="width: 11em;">
						       		<img src="../../../lib/images/add-user-symbol.png" style="width: 13%;"> 
						       		<label style="color:#007aff;" id="crearUsuario"> Crear Usuario</label>
						       	</button>
				              </div>				            
				            </div>
				            <div class="col-md-1" style="margin-left: 2%;" >
				              <div class="widget-container fluid-height">
				                <button class="btn btn-default" name="boton" style="width: 11em;">
						       	<img src="../../../lib/images/user-profile-edition.png" style="width: 13%;">
						       		<label style="color:#007aff;" id="modificarUsuario"> Modificar Usuario </label>		  		
						       	</button>
				              </div>
				            </div>
				            <div class="col-md-1" style="margin-left: 2%;">
				              <div class="widget-container fluid-height">
				                <button class="btn btn-default" name="boton" style="width: 15em;">
						       		<img src="../../../lib/images/user-profile-edition.png" style="width: 9%;"> 
						       		<label style="color:#007aff;" id="cambiarEstado"> Habilitar / Deshabilitar </label>
						       	</button>
				              </div>
				            </div>
				            <div class="col-md-1" style="margin-left: 5%;">
				              <div class="widget-container fluid-height">
				                <button class="btn btn-default" name="boton" style="width: 15em;">
						       		<img src="../../../lib/images/user-profile-edition.png" style="width: 9%;"> 
						       		<label style="color:#007aff;" id="cambiarClave"> Cambiar Contraseña </label>
						       	</button>
				              </div>
				            </div>
				       	</div>				       		
				       	 <!-- Contenido que lleva la table de busqueda-->
				       	<table class="table table-bordered table-striped" id="dataTable1">
				       		<thead>
				       			<th class="check-header hidden-xs">
                    			</th>
                    			<th>Rut</th>
				       			<th>Nombre</th>
			                    <th>Apellidos</th>
			                    <th style="width: 11%;">Fecha Nacimiento</th>      
			                    <th> Sexo</th>
			                    <th> tipo Perfil</th>
			                    <th>Centro</th>
			                    <th>Usuario</th>
			                    <th>Contraseña</th>
			                    <th>Estado</th>
			                    <th></th>
				       		</thead>
				       		<tbody id="tabla_resultados">	   			       							       								       			
				       		</tbody>
				       		</table>   				       		
              		   </div>

						<!-- Creacion y Modificacion de Usuarios -->
						<div id="popup" class="black_overlay" style="display: none;">
							<div >
						   		<div class="content-popup" style="height: 44em;">       
						        	<div class="dimensiones">
						        		<label class="tituloCabecera"> Creación Usuarios </label> 
						        	 	<div class="close closePopup">
						        	 		<a href="#" id="close" class="images"><img src='../../../lib/images/close.png'></a>
						        		 </div>
						        		<iframe  class="iframe" id="contenido"></iframe>
						        	</div>
						    	</div>
							</div>
						</div>
						<!-- Fin Creacion usuarios-->

						<!-- MODIFICACION -->
						<div id="modificarUsu" class="black_overlay" style="display: none;height: 56em;opacity: 0.9;">
							<div >
						   		<div class="content-popup" style="height: 44em;">       
						        	<div class="dimenModificar" style="    width: 62%;height: 39em; margin-top: 3%; margin-left: 18%;margin-right: 13%;background-color: #007aff;">
						        		<label class="tituloCabecera"> Modificar Usuarios </label> 
						        	 	<div class="close closePopup">
						        	 		<a href="#" id="cerrando" class="images"><img src='../../../lib/images/close.png'></a>
						        		 </div>
						        		<iframe  class="iframe" style="width: 98%; height: 91%; margin-left: 1%;" id="contenta"></iframe>
						        	</div>
						    	</div>
							</div>
						</div>
						<!-- Fin Creacion y modificacion menu-->

						<!-- Eliminar USuarios-->
						<div id="eliminarDato" class="black_overlay" style="display: none;">
							<div >
						   		<div class="content-popup" style="height: 44em;">       
						        	<div class="popupEliminar">
						        	 	<div class="close closePopup">
						        	 		<a href="#" id="cerrar" class="images"><img src='../../../lib/images/close.png'></a>
						        		 </div>
						        	  <iframe  class="iframe" id="detalle" style="width: 99%; height: 88%; margin-left: 1%;"></iframe>
						        	</div>
						    	</div>
							</div>
						</div>

						<!--Cambios de Estado Usuarios -->
						<div id="estados" class="black_overlay" style="display: none;">
							<div >
						   		<div class="content-popup" style="height: 44em;">       								
						        	<div class="popupHabilitar">
						        		<label class="tituloCabecera"> Habilitar/Deshabilitar Usuarios </label> 
						        	 	<div class="close closePopup">
						        	 		<a href="#" id="cerrado" class="images"><img src='../../../lib/images/close.png'></a>
						        		 </div>
						        	  <iframe  class="iframe" id="content" style="width: 99%; height: 88%; margin-left: 1%;">
						        	  </iframe>
						        	</div>
						    	</div>
							</div>
						</div>

						<!-- CAMBIAR CONTRASEÑA -->
						<div id="contraseña" class="black_overlay" style="display: none;">
							<div >
						   		<div class="content-popup" style="height: 44em;">       								
						        	<div class="popupClave">
						        		<label class="tituloCabecera"> Cambiar Contraseña Usuarios </label> 
						        	 	<div class="close closePopup">
						        	 		<a href="#" id="cerrandoClaves" class="images"><img src='../../../lib/images/close.png'></a>
						        		 </div>
						        	  <iframe  class="iframe" id="contenidoClave" style="width: 99%; height: 91%; margin-left: 1%;">
						        	  </iframe>
						        	</div>
						    	</div>
							</div>
						</div>

						<!-- loader -->
						<div id="loader">
							<!--<span class="loader"></span>		-->
							<img src="../../../lib/images/loading.gif">				
						</div>
						
					
		</div>
	</body>
</html>