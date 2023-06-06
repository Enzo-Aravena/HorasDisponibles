$( document ).ready(function(){

	var test = location.search.replace('?', '').split('&');
	
	//splitea el dato para  extraer parte de la cadena
	var parameter = test[0]; 
	var radio =parameter.split('=');
	var usuario = radio[1];

	
	//traerContrasenas(usuario);


	if (usuario === "undefined" || usuario === undefined) 
	{
		//oculta el cargando 
		$('#loader').hide('slow');
		$("#modificano").hide();
		$('#datos').append("<div id='dat' style='margin-left: 1%;margin-top: 13%;/* display: none; */'>"
			+"<label style='color: blue;font-size: 2em;text-align: center;'>"
		  	+" No se puede modificar la contraseña, Seleccione un usuario . </label>"
		  	+"<br><img src='../../../lib/images/attention.png' style='margin-left: 46%;width: 8%;'>"
		  	+"<br><br>"
		  +"<button class='btn btn-primary' style='margin-left: 40%;margin-top: 2%;    width: 20%;' id='cerrarMenu'> Aceptar </button> "
		+"</div>"); 

	}else{
		traerContrasenas(usuario);
	}
	

	$("#cerrarMenu").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var volver = window.parent.$("#contraseña");
		$(volver).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});


	$("#cerrar").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var volver = window.parent.$("#contraseña");
		$(volver).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

	 $('#clave').keyup(function() {
	 	var clave = $('#clave').val();
	 	 if (clave.length  >= 6 && clave.length  <= 10 ) {
	 	  $('#largo').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      longitud = false;
	    } else {
	       $('#largo').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      longitud = true;
	    }

	    //Valida si es minusculas
	    if (clave.match(/[a-z]/)) {	 
	       $('#minuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      minuscula = true;
	    } else {
	      $('#minuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      minuscula = false;
	    }

	    // VALIDA SI HAY MAYUSCULAS
	    if (clave.match(/[A-Z]/)) {
	       $('#mayuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      mayuscula = true;
	    } else {
	      $('#mayuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      mayuscula = false;
	    }

	    // VALIDA SI EXISTEN NUMEROS EN EL CAMPO TEXTO
	    if (clave.match(/\d/)) {
	       $('#numero').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      numero = true;
	    } else {
	      $('#numero').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      numero = false;
	    }
	  });


	  $('#reingClave').keyup(function() {
		var reingClave= $('#reingClave').val();
		var clave = $('#clave').val();
	 	 if ((reingClave.length  >= 6 && reingClave.length  <= 10) && (clave.length  >= 6 && clave.length  <= 10 ) ) {
	 	  $('#largo').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      longitud = false;
	    } else {
	       $('#largo').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      longitud = true;
	    }

	    //Valida si es minusculas
	    if (reingClave.match(/[a-z]/)) {	 
	       $('#minuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      minuscula = true;
	    } else {
	      $('#minuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      minuscula = false;
	    }

	    // VALIDA SI HAY MAYUSCULAS
	    if (reingClave.match(/[A-Z]/)) {
	       $('#mayuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      mayuscula = true;
	    } else {
	      $('#mayuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      mayuscula = false;
	    }

	    // VALIDA SI EXISTEN NUMEROS EN EL CAMPO TEXTO
	    if (reingClave.match(/\d/)) {
	       $('#numero').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      numero = true;
	    } else {
	      $('#numero').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      numero = false;
	    }
	  });


	$('#aceptar').on("click",function(){
		$("#msgboxError").fadeOut();
		
		var usuario = $('#usersIn').text();
		var clave = $('#clave').val();
		var reingClave= $('#reingClave').val();


		if (clave === "") 
		{
			$('#clave').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#clave').css({'color':'','font-size':'','background':'','border':''});
		}

		if (reingClave === "") 
		{
			$('#reingClave').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#reingClave').css({'color':'','font-size':'','background':'','border':''});
		}


		if (clave !== "" && reingClave !== "") {
			if (clave === reingClave) {
				cambiarContraseña(clave,usuario);
			}else{
				$("#msgboxError").fadeTo(200,0.1,function()
				{ 				  
				  $(this).html('Las claves ingresadas no son válidas, reingrese las contraseñas').addClass('messageboxerror').fadeTo(1500,2);
				});	

				$('#clave').val('');
				$('#reingClave').val('');
				$('#clave').css({'color':'red','border':'solid 1px red'});
				$('#reingClave').css({'color':'red','border':'solid 1px red'});
			}
		}else{
			$("#msgboxError").fadeTo(200,0.1,function()
			{ 				  
			  $(this).html('No se puede modificar la contraseña, Favor completar los campos en rojo').addClass('messageboxerror').fadeTo(1500,2);
			});	
		}

		


	});
	


});