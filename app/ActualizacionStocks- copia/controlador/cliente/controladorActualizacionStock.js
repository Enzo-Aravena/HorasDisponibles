function cargaSelect(){
	var resultado= null;
	var url= "../controlador/servidor/controladorStock.php";
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

function actualizarStock(codigo,medicamento,almacen,maximo,critico){
	var resultado = null;
	var url = "../controlador/servidor/controladorStock.php";
	var type = "POST";
	
	var data = {
		evento:"actualizarStockFarmacia",
		codigo:codigo,
		medicamento:medicamento,
		almacen:almacen,
		maximo:maximo,
		critico:critico
	};
		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){	

				resultado = response;	

				$("#mensajeUno").empty();
				$("#cerrar").hide();
				$("#Aceptar").show();

				if (response == "1") {
					$("#mensaje").empty();
				    var texto = "<h3> Se ha actualizado el stock correctamente.  </h3>";
				    $("#mensaje").append(texto);
				    $("#myModal").modal();
					
					
					$('#maximo').val('');
					$('#critico').val('');
					return false;
				}else{

					$("#mensaje").empty();
				    var texto = "<h3>  No se ha podido actualizar el stock.  </h3>";
				    $("#mensaje").append(texto);
				    $("#myModal").modal();

					
					$('#maximo').val('');
					$('#critico').val('');
					return false;
				}
								
			},
			error:function(error){
				console.log("Error de la peticio");
				resultado = response;		
			}
		});// fin ajax
}