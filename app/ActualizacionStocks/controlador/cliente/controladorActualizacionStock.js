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
								$('#medicamento').append('<option value = ' +resultado[aux].codigo+'>'+resultado[aux].material+'</option>');
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
								$('#medicamento').append('<option value = ' +resultado[aux].codigo+'>'+resultado[aux].material+'</option>');
						}
					}
				}
				window.parent.$("#loader").hide();

				$('#medicamento').selectpicker();
			}, // End success
			error:function(error){
				console.log("Error en la peticion");
			} // End error
		});//End ajax
}


function ObtenerTabla(medicamento,almacen){
	var resultado= null;
	var medicamento= medicamento;
	var url= "../controlador/servidor/controladorStock.php";
	var type= "POST";
	var data= {
		evento :'obtenerDatosTabla',
		medicamento:medicamento,
		almacen:almacen
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
				$("#tabla_resultados").empty();
				if (resultado[0].data === "0" || resultado === "undefined" || resultado === undefined || resultado ==="") {
					tabla = tabla + '<tr>';
						tabla = tabla + '<td colspan= 5> No se han encontrado resultados asoociados a la busqueda </td>';
					tabla = tabla + '</tr>';
					$("#tabla_resultados").append(tabla);
				}else{
					$("#espacio").empty();
					if (medicamento.length >= 5 && medicamento.length <= 14) {
						$("#espacio").append("<br> <br> <br> <br>");
					}else{
						if (medicamento.length > 15 && medicamento.length <= 22)  {
							$("#espacio").append("<br> <br> <br> <br> <br> <br>  <br> <br> <br> <br> <br>");
						}else{
							if (medicamento.length > 23) {
								$("#espacio").append("<br> <br> <br> <br> <br> <br>  <br> <br> <br> <br> <br> <br> <br>");
							}else{
								$("#espacio").empty();
							}
							
						}

					}

					var tabla = "";
					var i = 1;
					for(var aux = 0 in resultado){
						tabla = tabla + '<tr>';
							tabla = tabla + '<td>'+i+' </td>';
							tabla = tabla + '<td>'+resultado[aux].NOMBRE_ALMACEN+' </td>';
							tabla = tabla + '<td>'+resultado[aux].CODIGO_MATERIAL+' <input type="hidden" name="codigo" class = "codigo"  id="idCodigo'+aux+'" value='+resultado[aux].CODIGO_MATERIAL+'></td>';
							tabla = tabla + '<td>'+resultado[aux].NOMBRE_MATERIAL+' </td>';
							tabla = tabla + '<td><input type="number" name="maximo"  class = "maximo" id="idmaximo'+aux+'" value='+resultado[aux].MAXIMO+'></td>';
							tabla = tabla + '<td><input type="number" name="critico" class = "critico"  id="idCritico'+aux+'" value='+resultado[aux].CRITICO+'></td>';
							//tabla = tabla + '<td><label for="idButton'+aux+'" class="btn btn-xs btn-primary botonRadio"> Modificar </label> </td>';
						tabla = tabla + '</tr>';

						i= i +1;
					} // END FOR
					$("#tabla_resultados").append(tabla);

					$("#botonModificar").show();
					
				}

				window.parent.$("#loader").hide();
				$("#tablaContent").show();

			}, // End success
			error:function(error){
				console.log("Error en la peticion");
			} // End error
		});//End ajax
}



function actualizarStock(cambios,medicamento,almacen){
	var resultado = null;
	var medicamento = medicamento;
	var almacen = almacen;

	var url = "../controlador/servidor/controladorStock.php";
	var type = "POST";
	
	var data = {
		evento:"actualizarStockFarmacia",
		cambios:cambios
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
				window.parent.$("#loader").hide();

				if (response == "true") {
					recargaPAgina(medicamento,almacen);
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



function recargaPAgina(medicamento,almacen){
	var resultado= null;
	var medicamento= medicamento;
	var url= "../controlador/servidor/controladorStock.php";
	var type= "POST";
	var data= {
		evento :'obtenerDatosTabla',
		medicamento:medicamento,
		almacen:almacen
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
				$("#tabla_resultados").empty();
				if (resultado[0].data === "0" || resultado === "undefined" || resultado === undefined || resultado ==="") {
					tabla = tabla + '<tr>';
						tabla = tabla + '<td colspan= 5> No se han encontrado resultados asoociados a la busqueda </td>';
					tabla = tabla + '</tr>';
					$("#tabla_resultados").append(tabla);
				}else{
					$("#espacio").empty();
					if (medicamento.length >= 5 && medicamento.length <= 14) {
						$("#espacio").append("<br> <br> <br> <br>");
					}else{
						if (medicamento.length > 15 && medicamento.length <= 22)  {
							$("#espacio").append("<br> <br> <br> <br> <br> <br>  <br> <br> <br> <br> <br>");
						}else{
							if (medicamento.length > 23) {
								$("#espacio").append("<br> <br> <br> <br> <br> <br>  <br> <br> <br> <br> <br> <br> <br>");
							}else{
								$("#espacio").empty();
							}
							
						}

					}

					var tabla = "";
					var i = 1;
					for(var aux = 0 in resultado){
						tabla = tabla + '<tr>';
							tabla = tabla + '<td>'+i+' </td>';
							tabla = tabla + '<td>'+resultado[aux].NOMBRE_ALMACEN+' </td>';
							tabla = tabla + '<td>'+resultado[aux].CODIGO_MATERIAL+' </td>';
							tabla = tabla + '<td>'+resultado[aux].NOMBRE_MATERIAL+' </td>';
							tabla = tabla + '<td><input type="number" name="maximo"  class = "maximo" id="idmaximo'+aux+'" value='+resultado[aux].MAXIMO+' disabled></td>';
							tabla = tabla + '<td><input type="number" name="critico" class = "critico"  id="idCritico'+aux+'" value='+resultado[aux].CRITICO+' disabled></td>';
							//tabla = tabla + '<td><label for="idButton'+aux+'" class="btn btn-xs btn-primary botonRadio"> Modificar </label> </td>';
						tabla = tabla + '</tr>';

						i= i +1;
					} // END FOR
					$("#tabla_resultados").append(tabla);

					$("#botonModificar").hide();
				}
				$("#medicamento").prop('disabled', false);
				window.parent.$("#loader").hide();
				$("#tablaContent").show();    			

			}, // End success
			error:function(error){
				console.log("Error en la peticion");
			} // End error
		});//End ajax
}