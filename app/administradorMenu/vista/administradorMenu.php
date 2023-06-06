<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />	
	<link href="css/estilospopup.css" media="all" rel="stylesheet" type="text/css" />
	<script src='../../../lib/jquery-3.2.1.min.js'></script>
	<!--  EXTRAE TODA LA DATA DL COMPONENTE PRINCIPAL-->
	<?php include_once("../../../lib/components.php");?>
	<script src="../controlador/cliente/controladorAcceso.js"></script>	
	<script src="js/administrar.js"></script>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">		
</head>
	<body>
		<div class="row">
		  <div class="col-md-12">
		    <div class="widget-container">
		      <div class="heading">
		        <i class="glyphicon glyphicon-cog"></i>
		        <label style="margin-left: 1%;"> Creacion Menu</label>
		      </div>
		       <div class="widget-content padded">
			        <div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-3">Seleccione el tipo de dato a buscar : </label>
							<div class="col-md-7">
								<label class="radio-inline a">
									<input checked="" name="rdbBuscar" type="radio" value="todo">
									<span> Todo</span>
								</label>			
								<label class="radio-inline">
									<input  name="rdbBuscar" type="radio" value="name">
									<span>Nombre</span>
								</label>								
							</div>
						</div>				        			        	
			          	<div class="form-group">
				            <label class="control-label col-md-2"> </label>
				            <div class="col-md-3">			        
				              <input class="form-control" placeholder="Buscar ..." type="text" id="buscar" name="buscar" autocomplete="off">      
				            </div>
							  <button class="btn btn-primary" id="ejecutar">Buscar</button>       	
							  <label id="valorRadio" > </label>     	
			          	</div>  				          
			        </div>

			        <br>
			        <br>
			        <div class="form-horizontal">
			        	<div class="form-group">
			        		<div class="col-md-2"></div>
				       		<div class="col-md-2">
				                <button class="btn btn-default" name="boton">
						       		<img src="../../../lib/images/menuPeque.png" width=15px>
						       		<label style="color:#007aff;" id="createMenu"> Agregar Menu</label>
						       	</button>            
				            </div>

				            <div class="col-md-2">
			                <button class="btn btn-default" name="boton" id="modificar">
					       	<img src="../../../lib/images/menuPeque.png" width="15px">
					       		<label style="color:#007aff;" id="modMenu"> Modificar Menu </label>		  		
					       	</button>
			            	</div>

			            	<div class="col-md-2">
			                <button class="btn btn-default" name="boton" id="perfiles">
					       	<img src="../../../lib/images/menuPeque.png" width="15px">
					       		<label style="color:#007aff;" id="perfiles"> Asignar Perfiles </label>
					       	</button>
			           		</div>

			           		<div class="col-md-2">
			                <button class="btn btn-default" name="boton" id="perfiles">
					       	<img src="../../../lib/images/menuPeque.png" width="15px">
					       		<label style="color:#007aff;" id="Desasignar"> Quitar Accesos </label>
					       	</button>
			            	</div>

			            	<div class="col-md-2">
			                	<button class="btn btn-default" name="boton" id="deleteMenu">
						       		<img src="../../../lib/images/menuPeque.png" width="15px">
						       		<label style="color:#007aff;" id="deleteMenu"> Borrar Menu </label>
					       		</button>
			            	</div>				            
			        	</div>

			        </div>
		        <br>
		        <br>
		        <div class="form-horizontal">
		        	<div class="form-group">
		          		<div class="col-md-1"></div>
		          		<div class="col-lg-9">	
		          			<label id="guardaDatos"></label>
			          		<div class="table-bordered" id="divTabla">
			          			<table class="table">
				          			<thead>
					                    <th class="check-header hidden-xs">
				                    	</th>
					                    <th>Nombre Menu</th>
					        			<th>Ruta del archivo</th>
					        			<th>Ruta de la Imagen</th>
					                  </thead>
					                <tbody id="tabla_resultados">
							       	</tbody>
				          		</table>
			          		</div>
		          		</div>   			
	          		</div>
	          	<!--	<div class="form-group">
	          			<div class="col-md-5"></div>
		          		<div class="col-lg-2">
			          		<div id="loader" class="loader">
								  <img style="width: 10%;margin-top: 6%;margin-left: 43%;" src="../../../lib/images/spinner.gif">  
							</div>
						</div>	
					</div>-->
		        	
		    </div>
		</div> <!-- DIV PRINCIPAL-->

	 <!-- Creacion y Modificacion de menu -->
		<div id="popup" class="black_overlay" style="display: none;height: 56em;opacity: 0.9;">
			<div >
		   		<div class="content-popup" style="height: 44em;">       
		        	<div class="dimensiones">
		        		<label class="tituloCabecera"> Menu </label> 
		        	 	<div class="close closePopup">
		        	 		<a href="#" id="close" class="images"><img src='../../../lib/images/close.png'></a>
		        		 </div>
		        		<iframe  class="iframe" style="width: 98%; height: 91%; margin-left: 1%;" id="contenidos"></iframe>
		        	</div>
		    	</div>
			</div>
		</div>
	<!-- Fin Creacion y modificacion menu-->

	<!-- Asignar perfiles en menu -->
	<div id="perfil" class="black_overlay" style="display: none;height: 56em;opacity: 0.9;">
		<div >
	   		<div class="content-popup" style="height: 44em;">       
	        	<div class="dimensionPerfiles" style="   width: 38%; height: 28em; margin-top: 3%; margin-left: 31%; margin-right: 13%; background-color: #007aff;">
	        		<label class="tituloCabecera">Asignar Menu </label> 
	        	 	<div class="close closePopup">
	        	 		<a href="#" id="cerrarPerf" class="images"><img src='../../../lib/images/close.png'></a>
	        		 </div>
	        		<iframe  class="iframe" style="width: 98%;height: 89%; margin-left: 1%;" id="asignarPerfiles"></iframe>
	        	</div>
	    	</div>
		</div>
	</div>
	<!-- Desasignar Perfiles -->

	<!-- desAsignar perfiles en menu -->
	<div id="eliminarVinculo" class="black_overlay" style="display: none;height: 56em;opacity: 0.9;">
		<div >
	   		<div class="content-popup" style="height: 44em;">       
	        	<div class="dimensionPerfiles" style="   width: 38%; height: 28em; margin-top: 3%; margin-left: 31%; margin-right: 13%; background-color: #007aff;">
	        		<label class="tituloCabecera">Desasignar Menu </label> 
	        	 	<div class="close closePopup">
	        	 		<a href="#" id="cerrarDes" class="images"><img src='../../../lib/images/close.png'></a>
	        		 </div>
	        		<iframe  class="iframe" style="width: 98%;height: 89%; margin-left: 1%;" id="desasignarPerfiles"></iframe>
	        	</div>
	    	</div>
		</div>
	</div>
	<!-- Desasignar Perfiles -->


	<!-- Asignar perfiles en menu -->
	<div id="eliminarMenu" class="black_overlay" style="display: none;height: 56em;opacity: 0.9;">
		<div >
	   		<div class="content-popup" style="height: 44em;">       
	        	<div class="dimensionPerfiles" style="   width: 27%; height: 19em; margin-top: 3%; margin-left: 36%; margin-right: 13%; background-color: #007aff;">
	        		<label class="tituloCabecera">Eliminar Menu </label> 
	        	 	<div class="close closePopup">
	        	 		<a href="#" id="cerrarDelete" class="images"><img src='../../../lib/images/close.png'></a>
	        		 </div>
	        		<iframe  class="iframe" style="width: 98%;height: 88%; margin-left: 1%;" id="borrarMenu"></iframe>
	        	</div>
	    	</div>
		</div>
	</div>
	<!-- Desasignar Perfiles -->
 
            
		        </div>
		    </div>
		  </div>
	</body>
</html>