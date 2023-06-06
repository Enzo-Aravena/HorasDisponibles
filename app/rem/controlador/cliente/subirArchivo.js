function uploadData(centro,serie,mes,anio,usuario,envio,mensaje){
	var nombre = usuario;

	var resultado = null;
	var url= "../controlador/servidor/subirArchivo.php";
	var type= "POST";
	
	$.ajax({
		url:url,
		type:type,
		data:new FormData($("#detalle")[0]),centro,serie,mes,anio,envio,mensaje,nombre,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){
			resultado = response;
			window.parent.$("#loader").hide();
			switch(resultado){
                case "1":
					document.getElementById("subirArchivo").value = "";
					/*$('select[name=centro]').val("0");
					$('select[name=serie]').val("0");
					$('select[name=mes]').val("0");
					$('select[name=anio]').val("2019");
					$('#mensaje').val("");*/
						window.parent.$("#loader").hide();
		
					$("#mensajePopup").empty();
					var texto = "<h3> Archivo Enviado Exitosamente!.. </h3>";
					$("#mensajePopup").append(texto);
					$("#myModal").modal();
                break;

                case "2":
            		window.parent.$("#loader").hide();
                	$("#mensajePopup").empty();
					var texto = "<h3> Error al Enviar archivo... </h3>";
					$("#mensajePopup").append(texto);
					$("#myModal").modal();
                break;

                case "3":
            		window.parent.$("#loader").hide();
                	$("#mensajePopup").empty();
					var texto = "<h3> Extension no Valida! Solo Archivos xlsm.. </h3>";
					$("#mensajePopup").append(texto);
					$("#myModal").modal();
                break;

                case "4":
            		window.parent.$("#loader").hide();
                	$("#mensajePopup").empty();
					var texto = "<h3> Nombres de Hojas Incorrectas, Por favor corregir </h3>";
					$("#mensajePopup").append(texto);
					$("#myModal").modal();
                break;

                case "5":
            		window.parent.$("#loader").hide();
                	$("#mensajePopup").empty();
					var texto = "<h3> Error al Validar Hojas, De todas Maneras se envio al area de Informatica para que Validen </h3>";
					$("#mensajePopup").append(texto);
					$("#myModal").modal();
                break;

                default:
            		window.parent.$("#loader").hide();
					$("#mensajePopup").empty();
					var texto = "<h3> Error al Validar Hojas, De todas Maneras se envio al area de Informatica para que Validen </h3>";
					$("#mensajePopup").append(texto);
					$("#myModal").modal();
                break;
            }

		},
		error:function(e){
			console.log("Error de la peticion");
		}
	});
}