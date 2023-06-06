$( document ).ready(function() {

	$('#estado').addClass("ImagenEstado");
	$("#Correcto").hide();
	$("#PrincipalData").show();

	$("#crearMenu").on("click",function(){
		var nombre = $("#nombre").val();
		var detalleRuta = $("#detalleRuta").val();
		var nomImagen = $("#imagen").val();
 
		//metodo para obtener el nombre de la imagen
		if (nomImagen === "") {
		}else{
			var img = nomImagen.split('\\');
			var imagen= img[2];
		}
	
		if (nombre === "") 
		{
			$('#nombre').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#nombre').css({'color':'','font-size':'','background':'','border':''});
		}

		if (detalleRuta === "") 
		{
			$('#detalleRuta').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#detalleRuta').css({'color':'','font-size':'','background':'','border':''});
		}

		if (imagen === "" || imagen === "undefined" || imagen === undefined) 
		{
			$('#estado').addClass("ImagenEstadoIncorrecto");
		}else{
			$('#estado').addClass("ImagenEstadoCorrecto");
		}


		if (nombre !==""  && detalleRuta !=="" && (imagen !="" || imagen === "undefined" || imagen === undefined)) {
			createNewMenu(nombre,detalleRuta,imagen);
		}else{
			$("#msgboxError").fadeTo(200,0.1,function()
			{ 				  
			  $(this).html('No se puede crear el menu, Favor completar los campos en rojo').addClass('messageboxerror').fadeTo(1500,2);
			});	
		}

	});

	// cerrar Datos 
	$("#CancelarrMenu").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var volver = window.parent.$("#popup");
		$(volver).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});


	$("#CloseSuccess").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var cerrar = window.parent.$("#popup");

		$(cerrar).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

});
