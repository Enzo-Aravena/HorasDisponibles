<?php include_once("../../../lib/seguridad.php");
echo session_id();?>
<!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
	<link href="css/styles.css" media="all" rel="stylesheet" type="text/css" />
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<!--  EXTRAE TODA LA DATA DL COMPONENTE PRINCIPAL-->
  	<?php include_once("../../../lib/components.php");?>
	<script src="../controlador/cliente/controladorUsuariosOmi.js"></script>
	<script src="js/navegadorUsuariosOmi.js"></script>
	</head>
	<body>
	<div class="widget-container padded">
		<input type='hidden' value='<?php echo $_SESSION['username'];?>' id='usuario' /> 
      <div class="heading"> 
        <i class="glyphicon glyphicon-search"></i>
        <label>Buscar Usuarios </label>
      </div>
      <div class="widget-content padded" style="box-shadow:none;">
        <div class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-md-3">Seleccione el tipo de dato a buscar : </label>
				<div class="col-md-7">		
					<label class="radio-inline">
						<input style="cursor: pointer;" name="rdbBuscar" type="radio" value="rut" checked><span> Rut</span>
					</label>	
					<label class="radio-inline">
						<input style="cursor: pointer;" name="rdbBuscar" type="radio" value="username"><span> Usuario</span>
					</label>								
				</div>
			</div>				        			        	
          	<div class="form-group">
	            <label class="control-label col-md-2"> </label>
	            <div class="col-md-3">			        
	              <input style="cursor: pointer;" class="form-control" placeholder="Buscar ..." type="text" id="buscar" autocomplete="off" name="buscar" minlength="2" maxlength="14" required>
	            </div>
          		   
				  <button class="btn btn-primary" style="width: 8%;" id="ejecutar">Buscar</button> 
				  <label id="valorRadio" > </label>     		
          	</div>  				          
        </div>
    	<div class="form-horizontal" id="cuerpoUno">
			<div class="form-group">
          		<div class="col-md-2"></div>
          		<div class="col-lg-7">	
          			<label id="guardaDatos"></label>
	          		<div class="table-bordered" id="divTabla">
	          			<table class="table">
		          			<thead id="cabecera">
								<th></th>
								<th>usuario</th>
								<th>Apellidos y Nombre</th>
								<th>Estamento</th>
								<th>Rut</th>
								<th>Centro</th>
								<th>Estado</th>
							</thead>
							<tbody  id="tabla_resultados">
					       	</tbody>
		          		</table>
	          		</div>
          		</div>
          	</div>
    	</div>

		<div class="row" id="botones">
	   		<div class="col-md-6">
	        </div>
	        <div class="col-md-2">
	          <div class="widget-container fluid-height">
	            <button class="btn btn-default" name="boton" style="width: 15em;">
		       		<img src="../../../lib/images/user-profile-edition.png" style="width: 9%;"> 
		       		<label style="color:#007aff;" id="cambiarEstado"> Habilitar / Deshabilitar </label>
		       	</button>
	          </div>
	        </div>
	        <div class="col-md-1">
	          <div class="widget-container fluid-height">
	            <button class="btn btn-default" name="boton" style="width: 15em;">
		       		<img src="../../../lib/images/user-profile-edition.png" style="width: 9%;"> 
		       		<label style="color:#007aff;" id="cambiarClave"> Cambiar Contraseña </label>
		       	</button>
	          </div>
	        </div>
	   	</div>				       


      </div>

     	<div id="estados" class="black_overlay" style="display: none;">
        	<div>
            	<div class="content-popup">       
            	    <div class="dimensiones">
			        	<label class="tituloCabecera"> Cambiar estado Usuarios </label> 
		        	 	<div class="close closePopup" style="    opacity: unset;">
		        	 		<a href="#" id="cerrado" class="images"><img src='../../../lib/images/close.png' style="    margin-left: -67%;  margin-top: 42%;"></a>
		        		</div>
                      <div class="container-fluid main-content" data-role="popup" class="ui-corner-all">
                        <div class="row" style=" background: white;height: 18em;" id="habilitar">
                        	<br>
                        		<div class="form-group" style=" width: 80%; margin-left: 8%;">
				                  <label style="color: blue;font-size: 1.5em;text-align: center;">Modificacion estado Usuario OMI</label>				                 
						        </div>	
                        	<br>
                        	
                        		<div class="form-group" style=" width: 80%; margin-left: 8%;">
				                  <label for="username">Estado</label>
				                  <select class="form-control" name="estado" id="estado">
						              <option value="sele"> Seleccione ... </option>
								      <option value="0">Activo</option>
								      <option value="1"> Bloqueado</option>      
					          	  </select>
						        </div>	
						        <br>
						        <br>
                        		<div class="form-group" style=" width: 80%;">
				                   <button class="btn btn-primary" style="width: 8em;    margin-left: 32%;"  id="Aceptar">Si</button>   
                                  <button class="btn btn-primary" style="width: 8em;"  id="Cancelar">No</button>  
						        </div>	           

						        <span id="mensaje" style="margin-left: 4%;"></span>                      
                        </div>

                        <div class="row" style=" background: white;    height: 19em;    margin-top: -1%;" id="Error">
                        	<br>
                        	<br>
                        		<div class="form-group" style=" width: 80%; margin-left: 8%;">
				                  <label style="font-size: 2em;    color: blue;    text-align: center;">No se ha seleccionado al usuario</label>				                 
						        </div>	
						        <br>
						        <br>
                        		<div class="form-group" style=" width: 84%; margin-left: 36%;">
                                  <button class="btn btn-primary" style="width: 10em;"  id="eerror">Aceptar</button>  
						        </div>	                                 
                        </div>

                        <div class="row" style=" background: white;    height: 19em;    margin-top: -1%;" id="ModificacionExistosa">
                        	<br>
                        	<br>
                        		<div class="form-group" style=" width: 80%; margin-left: 8%;">
				                  <label style="font-size: 2em;    color: blue;    text-align: center;">
				                  	Se ha modificado Correctamente al usuario
				                  </label>				                 
						        </div>	
						        <br>
						        <br>
                        		<div class="form-group" style=" width: 84%; margin-left: 36%;">
                                  <button class="btn btn-primary" style="width: 10em;"  id="modOk">Aceptar</button>  
						        </div>	                                 
                        </div>

                        <div class="row" style=" background: white;    height: 19em;    margin-top: -1%;" id="ModificacionError">
                        	<br>
                        	<br>
                        		<div class="form-group" style=" width: 80%; margin-left: 8%;">
				                  <label style="font-size: 2em;    color: blue;    text-align: center;">
				                  	No se ha podido modificar al usuario
				                  </label>				                 
						        </div>	
						        <br>
						        <br>
                        		<div class="form-group" style=" width: 84%; margin-left: 36%;">
                                  <button class="btn btn-primary" style="width: 10em;"  id="modError">Aceptar</button>  
						        </div>	                                 
                        </div>

                      </div>
                    </div>
               </div>
            </div>
        </div>
      
      <!-- Fin modal validacion pacientes-->

      <div id="gestionClave" class="black_overlay" style="display: none;">
        	
            	<div class="content-popup">       
            	    <div class="dimensiones">
			        	<label class="tituloCabecera"> Cambiar contraseña Usuarios </label> 
		        	 	<div class="close closePopup" style="    opacity: unset;">
		        	 		<a href="#" id="cerradoa" class="images"><img src='../../../lib/images/close.png' style="    margin-left: -67%;  margin-top: 42%;"></a>
		        		</div>
                      <div class="container-fluid main-content" data-role="popup" class="ui-corner-all">
                        <div class="row" style=" background: white;    height: 33em;" id="claves">
                        	<div id="validate-form" style="margin-left: 8%;">
						          <fieldset>
						            <div class="row" id="ModificarData">			
						            <br>
						            Modificación Contraseña Usuarios
						            <br>
						            <br>		           
						            	<!-- PRIMERA COLUMNA-->
										<div class="col-md-9">
											<div class="form-group">
							                  <label for="clave">Contraseña</label>
							                  <input class="form-control" id="clave" name="clave" type="text" placeholder="contraseña">
							                </div>		                             
						             	</div>

						            </div>
						            <div class="row" id="ModificarData">
						            	<!-- PRIMERA COLUMNA-->
										<div class="col-md-9">
											<div class="form-group">
							                  <label for="reingClave">Reingrese Su Contraseña</label>
							                  <input class="form-control" id="reingClave" name="reingClave" type="text" placeholder="contraseña">
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
									      <li id="largo" class="incorrecto"> Debe contener <strong>6 caracteres</strong>
									      </li>
									    </ul>
								  	</div>
						            
						        <div style="margin-left: 17%;margin-top: 5%;">
						       		<button style="width: 30%;" class="btn btn-primary" id="AceptarSi">
						       		Aceptar
						       		</button>     		
						       		<button class='btn btn-primary' style='width: 28%;' id='Cancelara'> Cancelar </button>				       		
					       		</div>
					       		 <span id="msjes" style="margin-left: 4%;"></span>
					            </fieldset>

			        		</div>                        	
                        </div>
                        

                       </div>
               		</div>
           		</div>
     </div>


    <div id="erroresClave" class="black_overlay" style="display: none;">
		<div class="content-popup">       
		    <div class="dimensiones">
	        	<label class="tituloCabecera"> Cambiar contraseña Usuarios </label> 
	    	 	<div class="close closePopup" style="    opacity: unset;">
	    	 		<a href="#" id="cerradoClaveErrror" class="images"><img src='../../../lib/images/close.png' style="    margin-left: -67%;  margin-top: 42%;"></a>
	    		</div>
	          <div class="container-fluid main-content" data-role="popup" class="ui-corner-all">
	            
	             <div class="row" style=" background: white;    height: 19em;    margin-top: -1%;" id="ErrorMoSeleccion">
	            	<br>
	            	<br>
	            		<div class="form-group" style=" width: 80%; margin-left: 8%;">
		                  <label style="font-size: 2em;    color: blue;    text-align: center;">No se ha seleccionado al usuario</label>				                 
				        </div>	
				        <br>
				        <br>
	            		<div class="form-group" style=" width: 84%; margin-left: 36%;">
	                      <button class="btn btn-primary" style="width: 10em;"  id="OkErrorClave">Aceptar</button>  
				        </div>	                                 
	            </div>
	           </div>
	   		</div>
			</div>
     </div>
	
     <div id="ValidacionesClaves" class="black_overlay" style="display: none;">
        	<div>
            	<div class="content-popup">       
            	    <div class="dimensiones">
			        	<label class="tituloCabecera"> Cambiar estado Usuarios </label> 
		        	 	<div class="close closePopup" style="    opacity: unset;">
		        	 		<a href="#" id="cerradoValiClave" class="images"><img src='../../../lib/images/close.png' style="    margin-left: -67%;  margin-top: 42%;"></a>
		        		</div>
                      <div class="container-fluid main-content" data-role="popup" class="ui-corner-all">
                        <div class="row" style=" background: white;    height: 19em;    margin-top: -1%;" id="validacionClavesOk">
                        	<br>
                        	<br>
                        		<div class="form-group" style=" width: 80%; margin-left: 8%;">
				                  <label id="textosValidacion" style="font-size: 2em; color: blue; text-align: center;">
				                  	
				              	  </label>				                 
						        </div>	
						        <br>
						        <br>
                        		<div class="form-group" style=" width: 84%; margin-left: 36%;">
                                  <button class="btn btn-primary" style="width: 10em;"  id="CerrarOk">Aceptar</button>  
						        </div>	                                 
                        </div>

                        

                      </div>
                    </div>
               </div>
            </div>
        </div>


	</div>

</body>
</html>