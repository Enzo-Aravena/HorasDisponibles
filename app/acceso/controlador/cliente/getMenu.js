function Menu(user){
	var resultado = null;
	var url = "../controlador/servidor/initSession.php";
	var type = "POST";
	var data = {
		evento:"menu",
		usuario:user,		
	};

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion enviada");
		},
		success:function(response){
			resultado = JSON.parse(response);
			var usuario = resultado.usuario
			var url= "../../"+resultado.url+"?usuario="+ usuario;
			$(location).attr('href',url);

			location.reload();
		},
		error:function(error){
			console.log("no se pudo ingresar a la pagina");
		}
	});
}