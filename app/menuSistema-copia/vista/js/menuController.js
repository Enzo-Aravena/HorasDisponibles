$(document).ready(function() {
	var sexo = $('#sexo').val();
	var usuario = $('#usuario').val();
	var nombre = $('#nombre').val();
	
	if (nombre === "" ) {
		$("#contenido").attr("src",url);
		$(location).attr('href',"../../../index.php");
	}else{
		redirectToMenu(usuario);
	}

	if (sexo === "F") {
		var tipo= '<img width="28" height="28" src="../../../lib/images/girl.png"/>';
		 $('#images').append(tipo);
	}else{
		var male= '<img width="28" height="28" src="../../../lib/images/boy.png"/>';
		//<img width="34" height="34" src="../../../lib/images/girl.png"/>
		 $('#images').append(male);
	}

	
	
	$("#logout").click(function(){
		var url = "http://192.168.8.71/eXtplorer_2.1.12/index.php?option=com_extplorer&action=logout";

	
		$("#contenido").attr("src",url);

		$(location).attr('href',"../../../index.php");
	});

});
