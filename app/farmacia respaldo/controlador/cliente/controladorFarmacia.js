function cargaSelect(){
	var resultado= null;
	var url= "../controlador/servidor/controladorFarmacia.php";
	var type= "POST";
	var data= {
		evento :'select'
	};
		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("peticion recibida");
			},
			success:function(response){
				resultado = JSON.parse(response);

				 var select  = $('select[name=medicamento]').val();

				if (select === "Seleccione ...") {
					$('#medicamento').empty();
					$('#medicamento').append("<option value= '0'> Seleccione ...</option>");
					for(var aux = 0 in resultado){
						if (resultado[aux].material === null || resultado[aux].material === "null" ||resultado[aux].material === "undefined"
						|| resultado[aux].material === undefined || resultado[aux].material === "" ) {					 	
							console.log("Error de carga");
						}else{
								$('#medicamento').append("<option value = " +resultado[aux].codigo+">"+resultado[aux].material+"</option>");
						}
					}
				}else{
					$('#medicamento').empty();
					$('#medicamento').append("<option value= '0'> Seleccione ...</option>");
					for(var aux = 0 in resultado){
						if (resultado[aux].material === null || resultado[aux].material === "null" ||resultado[aux].material === "undefined"
						|| resultado[aux].material === undefined || resultado[aux].material === "" ) {
							console.log("Error de carga");
						}else{
								$('#medicamento').append("<option value = " +resultado[aux].codigo+">"+resultado[aux].material+"</option>");
						}
					}
				}
			}, // End success
			error:function(error){
				console.log("Error en la peticion");
			} // End error
		});//End ajax
}

