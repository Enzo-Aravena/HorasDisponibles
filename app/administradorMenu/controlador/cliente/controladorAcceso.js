function searchAllMenu(){
	$('#tabla_resultados').empty();	
	var resultado = null;
	var url = "../controlador/servidor/controladorAcceso.php";
	var type = "POST";
	var data = {
		evento:"buscarTodoMenu",		
	};

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){
			resultado = JSON.parse(response);
			if (resultado != "" || resultado != "undefined") 
			{
				//limpia la tabla completa
				$('#tabla_resultados').empty();
				//recorre el json que trae desde el php y lo pinta en la pantalla
			for(var aux = 0 in resultado){
				$('#tabla_resultados').append("<tr>"+"<td class='check hidden-xs'><label class='radio'>"
				+"<input name='obtener' type='radio' id='idButton"+aux+"' value='"+resultado[aux].idMenu+"'><span></span></label></td>"
				+"<td id ='nombre'>"+resultado[aux].nombre+"</td>"					
				+"<td>"+resultado[aux].menu+"</td>"
				+"<td>"+resultado[aux].imagen+"</td>"						
				+"</tr>");
				}	
				//$('#loader').hide();
				window.parent.$("#loader").hide();
			}
			else{		
				$("#msgbox").fadeTo(100,0.1,function() //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('No se ha podido encontrar datos, Por favor comuniquese con el administrador del sistema').addClass('messageboxerror').fadeTo(1500,2);
				});					
			}
		},
		error:function(error){
			console.log("Error de la peticio");
			
		}
	});// fin ajax

}

function searchByName(rdbBuscar,buscar){
	$('#tabla_resultados').empty();
	var resultado = null;
	var url = "../controlador/servidor/controladorAcceso.php";
	var type = "POST";
	var data = {
		evento:"buscarNombre",	
		rdbBuscar:rdbBuscar,	
		buscar:buscar
	};

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){

			var resp= "No se han encontrado Resultados..";
			var test = response;		
			//var dd= "{"+'"data"'+":" +'"0"'+"}";

			if (response === "Error" || test=== "No se han encontrado Resultados asociados a la busqueda" 
				|| test === "{"+'"data"'+":" +'"0"'+"}")  {
				$('#tabla_resultados').append("<tr> <td></td> <td>"+resp+"</td>  <td></td> <td></td></tr>");
			}else{
					resultado = JSON.parse(response);
					$('#tabla_resultados').empty();
					for(var aux = 0 in resultado){
						$('#tabla_resultados').append("<tr>"+"<td class='check hidden-xs'><label>"
							+"<input name='obtener' type='radio' id='idButton"+aux+"' value='"+resultado[aux].idMenu+"'><span></span></label></td>"
							+"<td id ='nombre'>"+resultado[aux].nombre+"</td>"					
							+"<td>"+resultado[aux].menu+"</td>"
							+"<td>"+resultado[aux].imagen+"</td>"						
							+"</tr>");
						}	
					//$('#loader').hide();											
					window.parent.$("#loader").hide();
			}// fin else final 		
		},
		error:function(error){
			console.log("Error de la peticio");
			
		}
	});// fin ajax
}


function createNewMenu(nombre,detalleRuta,imagen){

	var resultado = null;
	var url = "../controlador/servidor/controladorAcceso.php";
	var type = "POST";
	var data = {
		evento:"create",
		nombre:nombre,
		detalleRuta:detalleRuta,
		imagen:imagen
	};

		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){
				resultado = JSON.parse(response);
				
				var final = resultado[0].res;
				$("#msgboxError").empty();
				$("#msgboxOk").empty();

				if (final === "0") { 


					$("#msgboxError").fadeTo(100,0.1,function()
					{ 					  
					  $(this).html('El nombre ingresado ya existe.').addClass('messageboxError').fadeTo(1500,2);
					});	

				}else{

					$("#Correcto").show();
					$("#PrincipalData").hide();

					/*
					$("#msgboxOk").fadeTo(100,0.1,function()
					{ 					  
					  $(this).html('Se ha creado el menu correctamente.').addClass('messageboxOk').fadeTo(1500,2);
					});	*/
				}
			},
			error:function(error){
				console.log("Error de la peticio");
				
				
			}
		});// fin ajax

}

// metodo que trae el dato desde la bd
function redirectTraerData(idMenu){

	var resultado = null;
	var url = "../controlador/servidor/controladorAcceso.php";
	var type = "POST";
	var data = {
		evento:"buscarYmod",
		idMenu:idMenu 
	};

		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){
				resultado = JSON.parse(response);

				var det= resultado[0].imagen;

				for(var aux = 0 in resultado){
					$('#nombre').val(resultado[aux].nombre);
					$('#detalleRuta').val(resultado[aux].menu);

					$('#idmenu').val(resultado[aux].idMenu);
					//valida si viene la imagen desde la base de datos
					if (resultado[aux].imagen === "") {							
						$('#estado').css({'background-image': 'url("../../../lib/images/incorrect.png")','background-repeat':' no-repeat','width':'20%','height':'15%'});
					}else{
						$('#mostrar').html(resultado[aux].imagen);//val(resultado[aux].imagen);	
						$('#estado').css({'background-image': 'url("../../../lib/images/correct.png")','background-repeat':' no-repeat','width':'20%'});
					}
					
				} // end for

				
			},
			error:function(error){
				console.log("Error de la peticio");
				
				
			}
		});// fin ajax
}


function modifyMenu(idMenu,nombre,detalleRuta,imagen){
	var resultado = null;
	var url = "../controlador/servidor/controladorAcceso.php";
	var type = "POST";
	var data = {
		evento:"modificar",
		nombre:nombre,
		detalleRuta:detalleRuta,
		imagen:imagen,
		idMenu:idMenu
	};

		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){
				resultado = JSON.parse(response);

				var final = resultado[0].res;
				$("#msgboxError").empty();
				$("#msgboxOk").empty();

				if (final === "0") { 


					$("#msgboxError").fadeTo(100,0.1,function()
					{ 					  
					  $(this).html('El nombre ingresado ya existe.').addClass('messageboxError').fadeTo(1500,2);
					});	

				}else{

					$("#MensajeModificacion").show();
					$("#dataPrincipal").hide();
					$("#contenido").hide();

					/*
					$("#msgboxOk").fadeTo(100,0.1,function()
					{ 					  
					  $(this).html('Se ha modificado el menu correctamente.').addClass('messageboxOk').fadeTo(1500,2);
					});	*/
				}
				
								
			},
			error:function(error){
				console.log("Error de la peticio");
				
				
			}
		});// fin ajax
}

function cargarMenu(){
	$('#nombreMenu').empty();
	var resultado = null;
	var url = "../controlador/servidor/controladorAcceso.php";
	var type = "POST";
	var data = {
		evento:"cargarData"
	};

		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){
				resultado = JSON.parse(response);
				$('#nombreMenu').append("<option value='0'> Seleccione ...</option>");
				for(var aux = 0 in resultado){
					$('#nombreMenu').append("<option value="+resultado[aux].idMenu+">"+resultado[aux].nombre+"</option>");				}
												
			},
			error:function(error){
				console.log("Error de la peticio");
				
				
			}
		});// fin ajax
}

function cargarPerfiles(){
	$('#perfiles').empty();
	var resultado = null;
	var url = "../controlador/servidor/controladorAcceso.php";
	var type = "POST";
	var data = {
		evento:"perfiles"
	};

		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){
				resultado = JSON.parse(response);
				$('#perfiles').append("<option value='0'> Seleccione ...</option>");
				for(var aux = 0 in resultado){
					if(resultado[aux].nombre === "null" || resultado[aux].nombre === null || resultado[aux].nombre === "undefined"){

					}else{
						$('#perfiles').append("<option value="+resultado[aux].id+">"+resultado[aux].nombre+"</option>");					
					}
					

				}
												
			},
			error:function(error){
				console.log("Error de la peticio");
				
				
			}
		});// fin ajax
}

function asignarMenuAPerfilSeleccionado(perfil,menu){
	var resultado = null;
	var url = "../controlador/servidor/controladorAcceso.php";
	var type = "POST";
	var data = {
		evento:"asignarPerfiles",
		perfil:perfil,
		menu:menu
	};

		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){
				resultado = JSON.parse(response);
				var res = resultado[0].res;
				$("#msgboxError").empty();
				$("#msgboxOk").empty();

				if (res === "0") { 
					$("#msgboxError").fadeTo(100,0.1,function()
					{ 					  
					  $(this).html('El menu seleccionado ya fue asignado al perfil solicitado.').addClass('messageboxError').fadeTo(1500,2);
					});	
				}else{
					$("#AsignadoCorrecto").show();
					$("#Principal").hide();

					/*
					$("#msgboxOk").fadeTo(100,0.1,function()
					{ 					  
					  $(this).html('Se ha creado el menu correctamente.').addClass('messageboxOk').fadeTo(1500,2);
					});	*/
				}															
			},
			error:function(error){
				console.log("Error de la peticio");
				
				
			}
		});// fin ajax
}


function eliminarMenu(idmenu){
	var resultado = null;
	var url = "../controlador/servidor/controladorAcceso.php";
	var type = "POST";
	var data = {
		evento:"eliminarMenu",
		idmenu:idmenu
	};

		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){
				resultado = response;
			
				$("#msgboxError").empty();
				$("#msgboxOk").empty();

				if (resultado !== "") { 
					$("#msgboxError").fadeTo(100,0.1,function()
					{ 					  
					  $(this).html('Error.').addClass('messageboxError').fadeTo(1500,2);
					});	
				}else{
					$("#EliminadoCorrecto").show();
					$("#Principal").hide();
					/*
					$("#msgboxOk").fadeTo(100,0.1,function()
					{ 					  
					  $(this).html('Se ha eliminado el menu correctamente.').addClass('messageboxOk').fadeTo(1500,2);
					});	*/
				}															
			},
			error:function(error){
				console.log("Error de la peticio");
				
				
			}
		});// fin ajax
}



//  Elimina el menu seleccionado  asignado al perfil solicitado
function EliminarLazoEntreMenuYPerfil(menu){
	var resultado = null;
	var url = "../controlador/servidor/controladorAcceso.php";
	var type = "POST";
	var data = {
		evento:"eliminarLazo",
		menu:menu
	};
		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){
				resultado = JSON.parse(response);
				var res = resultado[0].respuesta;
							
				$("#msgboxError").empty();
				$("#msgboxOk").empty();

				if (res !== "1") { 
					$("#msgboxError").fadeTo(100,0.1,function()
					{ 					  
					  $(this).html('Error:  No se pudo desasociar el menu al perfil indicado, ya que no existe.').addClass('messageboxError').fadeTo(1500,2);
					});	
				}else{

					$("#AsignadoCorrecto").show();
					$("#Principal").hide();
					/*$("#msgboxOk").fadeTo(100,0.1,function()
					{ 					  
					  $(this).html('Se ha desasignado el menu al perfil seleccionado.').addClass('messageboxOk').fadeTo(1500,2);
					});	*/
				}																	
			},
			error:function(error){
				console.log("Error de la peticio");
				
				
			}
		});// fin ajax
}