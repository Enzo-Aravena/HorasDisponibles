$( document ).ready(function() {

	var test = location.search.replace('?', '').split('&');
	var urlParameter = test[0];
	var parameter= urlParameter.split('=');
	var rutUser= parameter[1];	

	if (rutUser === "undefined" || rutUser === undefined) 
	{
		//oculta el cargando 
		$('#loader').hide('slow');
		$("#modificano").hide();
		$('#datos').append("<div id='dat' style='margin-left: 5%;margin-top: 7%;/* display: none; */'>"
			+"<label style='color: blue;font-size: 2em;text-align: center;'>"
		  	+" No se puede Habilitar / Deshabilitar. Seleccione un usuario </label>"
		  	+"<br><img src='../../../lib/images/attention.png' style='margin-left: 45%;width: 8%;'>"
		  	+"<br><br>"
		  +"<button class='btn btn-primary' style='margin-left: 40%;margin-top: 2%;    width: 20%;' id='cerrarMenu'> Aceptar </button> "
		+"</div>"); 

	}else{
		traeEstado(rutUser);
	}

	 $('#deshabilitar').on("click",function(){
	 	$("#msgboxError").fadeOut();
	 	var estado = $('#estado').val();

	 	if (estado === "0") 
		{
			$('#estado').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#estado').css({'color':'','font-size':'','background':'','border':''});
		}


		if (estado === "0") {
			$("#msgboxError").fadeTo(200,0.1,function()
				{ 				  
				  $(this).html('No se puede cambiar el estado del usuario, Favor completar los campos en rojo').addClass('messageboxerror').fadeTo(1500,2);
				});	

		}else{
			deshabilitarUsuario(rutUser,estado);
		}

	 
	 });

	$('#loader').hide();


		// cerrar Datos 
	$("#cerrarMenu").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var volver = window.parent.$("#estados");
		$(volver).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

	$("#cerrar").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var volver = window.parent.$("#estados");
		$(volver).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

});