function LoginUsuario(user,pass){
	var resultado = null;
	var url = "../controlador/servidor/serverController.php";
	var type = "POST";
	var data = {
		evento:"login",
		usuario:user,
		contrasena:pass 
	};
	
	$.ajax({
		url: url,
		type: type,
		data: data,
		beforesend:function(){
			console.log("Peticion enviada");
		},//se ejecuta primero
		success:function(response){
			switch(response){
				case "0":
						$("#msgbox").fadeTo(100,0.1,function()
						{ 					  
						  $(this).html('Usuario ingresado no existe , &nbsp; Acceso denegado...').addClass('messageboxerror').fadeTo(1500,2);
						});	
				break;				
				case "1":
					$("#msgbox").fadeTo(100,0.1,function()
					{ 					  
					  $(this).html('Bienvenido!!').addClass('messageboxok').fadeTo(1500,2);
					  $(location).attr('href',"../controlador/servidor/initSession.php?username="+user);
					});	
				break;				
				case "2":
					var intentos = parseInt($("intentos").children().val()); 
					if(intentos <= 0){
						$("#msgbox").fadeTo(100,0.1,function()
						{ 					  
						  $(this).html('Usuario bloqueado, favor contactarse con mesa de ayuda para re activar cuenta,Acceso denegado...').addClass('messageboxerror').fadeTo(1500,2);
						});						
						intentos = 0;
					}else{	
						intentos = intentos - 1;						
						$("#msgbox").fadeTo(100,0.1,function()
						{ 					  
						  $(this).html('Contraseña Incorrrecta, Acceso denegado...').addClass('messageboxerror').fadeTo(1500,2);
						});	
					}					
				break;
				case "3":
						$("#msgbox").fadeTo(100,0.1,function()
						{ 					  
						  $(this).html('El usuario se encuentra deshabilitado, favor contactese con mesa de ayuda').addClass('messageboxerror').fadeTo(1500,2);
						});										
				break;
				
				case "4":
						$("#msgbox").fadeTo(100,0.1,function()
						{ 					  
						  $(this).html('El usuario no tiene permisos para ingresar, favor contactese con mesa de ayuda').addClass('messageboxerror').fadeTo(1500,2);
						});										
				break;

				default:
					alert("Error ... contactese con mesa de ayuda");				
				break;
			}
			
			console.log("Peticion Recibida");
		},//peticion completa con exito
		error:function(error){
			resultado = response;
			console.log("Error en Peticion");
		}//peticion con fallos
	});
}