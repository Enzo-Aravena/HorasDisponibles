function traeEstado(rutUser){
	var resultado = null;
	var url= "../controlador/servidor/controladorEstado.php";
	var type= "POST";
	var data= {
			evento:"trearEstado",
			rutUser:rutUser
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
				$('#loader').fadeIn('slow');
			  }
			  	else{
			  		for(var aux = 0 in resultado){	
			  		$('#estado').val(resultado[aux].estado);	
			  		}
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


function deshabilitarUsuario(rutUser,estado){
	var resultado = null;
	var url= "../controlador/servidor/controladorEstado.php";
	var type= "POST";
	var data= {
			evento:"cambiarEstado",
			rutUser:rutUser,
			estado:estado
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
			$("#msgboxError").empty();
			$("#msgboxOk").empty();
			var res = resultado[0].res;
			if (res === "0") { 
				$("#msgboxError").fadeTo(100,0.1,function()
				{ 					  
				  $(this).html('No ha cambiado el estado del usuario.').addClass('messageboxError').fadeTo(1500,2);
				});	
			}else{
				$("#msgboxOk").fadeTo(100,0.1,function()
				{ 					  
				  $(this).html('Se ha cambiado el estado del usuario.').addClass('messageboxOk').fadeTo(1500,2);
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


