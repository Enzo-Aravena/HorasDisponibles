$( document ).ready(function() {

	var usua = $('#usuario').val();
	var usuario = usua.toLowerCase();
	var clave = $('#clave').val();		

	//cuando el dato es enviado
	//var url = "http://192.168.8.71/eXtplorer_2.1.13/index.php?usuario="+usuario+"&clave="+clave;

		//var url = "http://192.168.50.15/eXtplorer_2.1.12/index.php?usuario="+usuario+"&clave="+clave;
		var url = "http://infosalud.cormup.cl/eXtplorer_2.1.12/index.php?usuario="+usuario+"&clave="+clave;

	$("#contenido").attr("src",url);

});