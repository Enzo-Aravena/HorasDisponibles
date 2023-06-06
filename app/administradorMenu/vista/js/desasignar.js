$( document ).ready(function() {

	cargarMenu();
	cargarPerfiles();

	$("#AsignadoCorrecto").hide();

	$('#desasignar').on("click",function(){
		var perfil= $('select[name=perfiles]').val();
		var menu= $('select[name=nombreMenu]').val();

		if (perfil === "0") 
		{
			$('#perfiles').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#perfiles').css({'color':'','background':'','border':''});
		}

		if (menu === "0") 
		{
			$('#nombreMenu').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#nombreMenu').css({'color':'','background':'','border':''});
		}


		if (perfil !== "0" && menu !== "0") {
			EliminarLazoEntreMenuYPerfil(menu);
		}else{
			$("#msgboxError").fadeTo(200,0.1,function()
			{ 				  
			  $(this).html('No se puede desasignar el perfil, Favor completar los campos en rojo').addClass('messageboxerror').fadeTo(1500,2);
			});	
		}

	});


	$("#cerrarMenu").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var volver = "";
		var volver = window.parent.$("#eliminarVinculo");
		$(volver).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

	$("#CloseSuccess").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var cerrar = window.parent.$("#eliminarVinculo");
		$(cerrar).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

});