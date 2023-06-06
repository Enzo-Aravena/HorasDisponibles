$( document ).ready(function() {

	var test = location.search.replace('?', '').split('&');

	//metodo que extrae la data del primer parametro que es rut
	var urlParameter = test[0];
	var parameter= urlParameter.split('=');
	var rut= parameter[1];

	// metodo que extrae la data del segundo parametro que es el id de la clave
	var param = test[1];
	var id= param.split('=');
	var idclave= id[1];

	if (rut === "undefined" && idclave === "undefined" ) {
	console.log('El formulario se abrira sin data');

	}

	 $('#eliminar').on("click",function(){
	 	eliminarUsuarios(rut,idclave);
	 });


});