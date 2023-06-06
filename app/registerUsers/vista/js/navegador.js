$( document ).ready(function() {	

	var test = location.search.replace('?', '').split('&');
	
	//extrae el rut 
	var parameter = test[0]; 
	var radio =parameter.split('=');
	var rut = radio[1];

	if (rut === "undefined" || rut === undefined) 
	{
		//oculta el cargando 
		$('#loader').hide('slow');
		$("#modificano").hide();
		$('#datos').append("<div id='dat' style='margin-left: 26%;margin-top: 13%;/* display: none; */'>"
			+"<label style='color: blue;font-size: 2em;text-align: center;'>"
		  	+" No se puede modificar, Seleccione un usuario . </label>"
		  	+"<br><img src='../../../lib/images/attention.png' style='margin-left: 30%;width: 8%;'>"
		  	+"<br><br>"
		  +"<button class='btn btn-primary' style='margin-left: 24%;margin-top: 2%;    width: 20%;' id='cerrarMenu'> Aceptar </button> "
		+"</div>"); 

	}else{
		buscarPerfil();
		cargarCentros();
	    redirectTraerData(rut);
	    $('#loader').fadeIn('slow');
	}

	$("#cerrarMenu").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var volver = window.parent.$("#modificarUsu");
		$(volver).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

	$("#cerrar").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var volver = window.parent.$("#modificarUsu");
		$(volver).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});


	$('#loader').hide();
	
});
