function redirectToCreate(rut,nombre,centro,estado,apat,fnac,usuario,tipoPerfil,amat,clave,sexo){
	var resultado = null;
	var url= "../controlador/servidor/controladorCrear.php";
	var type= "POST";
	var data= {
			evento:"create",
			rut:rut,
			nombre:nombre,
			centro:centro,
			estado:estado,
			apat:apat,
			fnac:fnac,
			usuario:usuario,
			tipoPerfil:tipoPerfil,
			amat:amat,
			clave:clave,
			sexo:sexo
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
				  $(this).html('Se ha creado el usuario correctamente.').addClass('messageboxOk').fadeTo(1500,2);
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


function cargarPerfiles(){
	$('#tipoPerfil').empty();
	var resultado = null;
	var url = "../controlador/servidor/controladorCrear.php";
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
	var url = "../controlador/servidor/controladorCrear.php";
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