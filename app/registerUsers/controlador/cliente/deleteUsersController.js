function eliminarUsuarios(rut){
	var resultado = null;
	var url= "../controlador/servidor/controladorCrear.php";
	var type= "POST";
	var data= {
			evento:"delete",
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