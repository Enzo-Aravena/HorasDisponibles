function buscarPerfil(){
	$('#tipoPerfil').empty();
	var resultado = null;
	var url = "../controlador/servidor/controladorModificar.php";
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
					$("#msgboxError").fadeOut();
			$("#msgboxOk").fadeOut();
				resultado = JSON.parse(response);
				$('#tipoPerfil').append("<option value='0'> Seleccione ...</option>");
				for(var aux = 0 in resultado){
					if(resultado[aux].nombre === "null" || resultado[aux].nombre === null || resultado[aux].nombre === "undefined"){
						console.log("Error en la Carga de datos");
					}else{
						$('#tipoPerfil').append("<option value="+resultado[aux].id+">"+resultado[aux].nombre+"</option>");					
					}
					

				}
												
			},
			error:function(error){
				console.log("Error de la peticio");
				resultado = response;		
			}
		});// fin ajax
}

function cargarCentros(){
	$('#centro').empty();
	var resultado = null;
	var url = "../controlador/servidor/controladorModificar.php";
	var type = "POST";
	var data = {
		evento:"centro"
	};

		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){
					$("#msgboxError").fadeOut();
			$("#msgboxOk").fadeOut();
				resultado = JSON.parse(response);
				$('#centro').append("<option value='0'> Seleccione ...</option>");
				for(var aux = 0 in resultado){
					if(resultado[aux].nombre === "null" || resultado[aux].nombre === null || resultado[aux].nombre === "undefined"){

					}else{
						$('#centro').append("<option value="+resultado[aux].id+">"+resultado[aux].nombre+"</option>");					
					}
					

				}
												
			},
			error:function(error){
				console.log("Error de la peticio");
				resultado = response;		
			}
		});// fin ajax
}


function redirectTraerData(rut){
	var resultado = null;
	var url= "../controlador/servidor/controladorModificar.php";
	var type= "POST";
	var data= {
			evento:"searchData",
			rut:rut
	}; 

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){		
			$("#msgboxError").fadeOut();
			$("#msgboxOk").fadeOut();	
			 
			 resultado = JSON.parse(response);
			 if (response =="" || response === null || response === "undefined" || response === undefined)
			  {
			  	//oculta el cargando 
				$('#loader').hide();
			  }
			  	else{
				  	for(var aux = 0 in resultado){			 	
					 	$('#rut').val(resultado[aux].rut);
					 	$('#apat').val(resultado[aux].apat);
					 	$('#amat').val(resultado[aux].amat);
					 	$('#nombre').val(resultado[aux].nombre);
					 	$("#fnac").val(resultado[aux].fnac);
					 	$('#sexo').val(resultado[aux].sexo);
					 	$('#centro').val(resultado[aux].centro);
					 	$('#clave').val(resultado[aux].encriptacion);
					 	$('#reingClave').val(resultado[aux].encriptacion);
					 	$('#usuario').val(resultado[aux].usuario);
					 	$('#estado').val(resultado[aux].estado);
					 	$('#tipoPerfil').val(resultado[aux].idPerfil);			 	
					}// end for
			 	 }// end else

		},
		error:function(error){
			console.log("Error de la peticio");
			$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('No se pudieron cargar los datos del usuario seleccionado').addClass('messageboxerror').fadeTo(1500,2);
			});	
		}
	});// fin ajax
}


function redirectToModify(rut,nombre,centro,estado,apat,fnac,sexo,usuario,tipoPerfil,amat){
	var resultado = null;
	var url= "../controlador/servidor/controladorModificar.php";
	var type= "POST";
	var data= {
			evento:"modify",
			rut:rut,
			nombre:nombre,
			centro:centro,
			estado:estado,
			apat:apat,
			fnac:fnac,
			sexo:sexo,
			usuario:usuario,
			tipoPerfil:tipoPerfil,
			amat:amat
			
	};

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){
				$("#msgboxError").fadeOut();
			$("#msgboxOk").fadeOut();

			resultado = JSON.parse(response);
			$("#msgboxError").empty();
			$("#msgboxOk").empty();
			var res = resultado[0].res;


			if (res === "0") { 
				$("#msgboxError").fadeTo(100,0.1,function()
				{ 					  
				  $(this).html('El Usuario ingresado ya existe.').addClass('messageboxError').fadeTo(1500,2);
				});	
			}else{
				$("#msgboxOk").fadeTo(100,0.1,function()
				{ 					  
				  $(this).html('Se ha modificado el usuario correctamente.').addClass('messageboxOk').fadeTo(1500,2);
				});	
			}	

			
		},
		error:function(error){
			console.log("Error de la peticio");
			$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('No se pudieron ingresar los datos, verifique los datos').addClass('messageboxerror').fadeTo(1500,2);
			});	
		}
	});// fin ajax
}


function traerContrasenas(usuario){
	var resultado = null;
	var url= "../controlador/servidor/controladorModificar.php";
	var type= "POST";
	var data= {
			evento:"traerClave",
			usuario:usuario				
	};

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){
				$("#msgboxError").fadeOut();
			$("#msgboxOk").fadeOut();

			resultado = JSON.parse(response);

			if (response =="" || response === null || response === "undefined" || response === undefined)
			  {
			  	//oculta el cargando 
				$('#loader').hide();
			  }
			  	else{
				  	for(var aux = 0 in resultado){			 						 	
				  		var a = resultado[aux].Usuario;
				  		$("#usuarios").append("<span id='usersIn'>"+a+"</span>");
					 	$('#clave').val(resultado[aux].encriptacion);
					 	$('#reingClave').val(resultado[aux].encriptacion);			 	
					}// end for
			 	 }// end else

		},
		error:function(error){
			console.log("Error de la peticio");
			$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('No se pudieron ingresar los datos, verifique los datos').addClass('messageboxerror').fadeTo(1500,2);
			});	
		}
	});// fin ajax
}


function cambiarContraseña(clave,usuario){
	var resultado = null;
	var url= "../controlador/servidor/controladorModificar.php";
	var type= "POST";
	var data= {
			evento:"cambiarContrasena",
			clave:clave,
			usuario:usuario				
	};

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){
				$("#msgboxError").fadeOut();
			$("#msgboxOk").fadeOut();

			resultado = JSON.parse(response);
			var res = resultado[0].res;


			if (res === "0") { 
				$("#msgboxError").fadeTo(100,0.1,function()
				{ 					  
				  $(this).html('Error: No se puede cambiar la contraseña.').addClass('messageboxError').fadeTo(1500,2);
				});	
			}else{
				$("#msgboxOk").fadeTo(100,0.1,function()
				{ 					  
				  $(this).html('Se ha cambiado la contraseña correctamente.').addClass('messageboxOk').fadeTo(1500,2);
				});	
			}	
			

		},
		error:function(error){
			console.log("Error de la peticio");
			$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('No se pudieron ingresar los datos, verifique los datos').addClass('messageboxerror').fadeTo(1500,2);
			});	
		}
	});// fin ajax
}

