function cargaCesfam(centro){	
	var resultado = null;
	var url = "../controlador/servidor/controladorReporte.php";
	var type = "POST";
	var data = {
		evento:"buscarCentro",
		centro:centro
	};
		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){
				resultado = JSON.parse(response);		
				$('#ciclos').append("<b>"+resultado[0].nombre+"</b>");
				//$('#ciclos').text(nombreCentro);
			},
			error:function(error){
				console.log("Error de la peticio");
			}
		});// fin ajax
}

function cargarCicloDiario(centro,fechaHoy){	
	var resultado = null;
	var url = "../controlador/servidor/controladorReporte.php";
	var type = "POST";
	var centro = centro;
	var data = {
		evento:"cargaCicloDiarios",
		centro:centro,
		fechaHoy:fechaHoy
	};
		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){
			resultado = JSON.parse(response);	
			$('#tabla_resultados').empty();
			var i = 0;
			var tabla ="";
			var nombreCentro  = obtenerNombreCentro(centro);
			$('#ciclos').text(nombreCentro);
			if (resultado === 0) {
				$('#tabla_resultados').append("<tr>"+"<td colspan = 6> No se encontraron ciclos para el centro "+nombreCentro +"</td>"
					+"</tr>");
			} else {
				for(var aux = 0 in resultado){
					tabla = tabla + '<tr>';
					tabla = tabla + '<td class="check hidden-xs"><label class="radio">';
					tabla = tabla + '<input style="cursor: pointer;" name="obtener" type="radio" id="idButton'+aux+'" value="'+resultado[aux].ciclo+'_'+resultado[aux].fecha+'_'+resultado[aux].Agendados+'_'+resultado[aux].Cancelados+'_'+resultado[aux].estadoAgendado+'"><span></span></label>';
					tabla = tabla +' </td>';
					tabla = tabla + '<td>'+resultado[aux].ciclo+' </td>';
					tabla = tabla + '<td>'+resultado[aux].fecha+' </td>';
					tabla = tabla + '<td>'+resultado[aux].Agendados+' </td>';
					tabla = tabla + '<td>'+resultado[aux].Cancelados+' </td>';
					tabla = tabla + '<td>'+resultado[aux].estadoAgendado+' </td>';
					tabla = tabla + '<td>'+resultado[aux].estadoCancelado+' </td>';
					tabla = tabla + '</tr>';
				} // END FOR
			}
			$('#tabla_resultados').append(tabla);
			window.parent.$("#loader").hide();
			},
			error:function(error){
				console.log("Error de la peticio");
			}
		});// fin ajax
}

function cargaElCicloPorUnaFecha(centro,desde){
	var resultado = null;
	var centro = centro;
	var url = "../controlador/servidor/controladorReporte.php";
	var type = "POST";
	var data = {
		evento:"buscaPorUnaFecha",
		centro:centro,
		desde:desde
	};
		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){
				resultado = JSON.parse(response);
				//$("#cargas").empty();
				$('#tabla_resultados').empty();
				var i = 0;
				var tabla ="";
				var nombreCentro  = obtenerNombreCentro(centro);
				$('#ciclos').text(nombreCentro);
				if (resultado === 0) {
					$('#tabla_resultados').append("<tr>"+"<td colspan = 6> No se encontraron ciclos para el centro "+ nombreCentro +"</td>"
						+"</tr>");
				} else {
					for(var aux = 0 in resultado){
							tabla = tabla + '<tr>';
							tabla = tabla + '<td><label class="radio" for="idButton'+aux+'">';
							tabla = tabla + '<input style="cursor: pointer;" name="obtener" type="radio" id="idButton'+aux+'" value="'+resultado[aux].ciclo+'_'+resultado[aux].fecha+'_'+resultado[aux].Agendados+'_'+resultado[aux].Cancelados+'_'+resultado[aux].estadoAgendado+'"><span></span></label>';
							tabla = tabla +' </td>';
							tabla = tabla + '<td>'+resultado[aux].ciclo+' </td>';
							tabla = tabla + '<td>'+resultado[aux].fecha+' </td>';
							tabla = tabla + '<td>'+resultado[aux].Agendados+' </td>';
							tabla = tabla + '<td>'+resultado[aux].Cancelados+' </td>';
							tabla = tabla + '<td>'+resultado[aux].estadoAgendado+' </td>';
							tabla = tabla + '<td>'+resultado[aux].estadoCancelado+' </td>';
							tabla = tabla + '</tr>';
					} // END FOR
				}// END ELSE
				$('#tabla_resultados').append(tabla);
				window.parent.$("#loader").hide();
			},
			error:function(error){
				console.log("Error de la peticio");
			}
		});// fin ajax
}


function obtenerNombreCentro(centro){
	let texto = "";
	switch(centro){
		case "1":texto = "Carol Urzua";break;
		case "2":texto = "La Faena";break;
		case "3":texto = "San Luis";break;
		case "4":texto = "Lo Hermida";break;
		case "5":texto = "Cardenal Silva H";break;
		case "12":texto = "Padre Gerardo.W";break;
		case "13":texto = "Las Torres";break;
	}
	return texto;
}