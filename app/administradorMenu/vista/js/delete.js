$( document ).ready(function() {

	var test = location.search.replace('?', '').split('&');

	var urlParameter = test[0];
	var parameter= urlParameter.split('=');
	var idMenu= parameter[1];

	$("#EliminadoCorrecto").hide();


	if (idMenu === "undefined") {
	console.log('El formulario se abrira sin data');
	$('#contenido').empty();

	$("#dataPrincipal").fadeOut();
		$('#contenido').append("<div id='loader' style= 'margin-left:4%;margin-top: 3%;'>"
		  +"<label style='color: blue;font-size: 1.5em;text-align: center;'>"
		  +"No se puede eliminar el menu, seleccione un menu. </label>"
		  +"<br><img src='../../../lib/images/attention.png' style='margin-left: 43%;width: 10%;'>"
		  +"<br><br>"
		  +"<button class='btn btn-primary' style='margin-left: 39%;margin-top: 2%;    width: 20%;' id='cerrarMenu'> Aceptar </button> "
		+"</div>"); 

}else{
	 console.log("El usuario selecciono un menu para borrar");
}

		// cerrar Datos 
	$("#cerrarMenu").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var volver = window.parent.$("#eliminarMenu");
		$(volver).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

	
	// cerrar Datos 
	$("#cerrandoMenu").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var volver = window.parent.$("#eliminarMenu");
		$(volver).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});


	 $('#eliminar').on("click",function(){
	 	eliminarMenu(idMenu);
	 });


	$('#close').click(function(){
		$('#popup').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

	$("#CloseSuccess").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var cerrar = window.parent.$("#eliminarMenu");

		$(cerrar).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
		searchAllMenu();
	});

});