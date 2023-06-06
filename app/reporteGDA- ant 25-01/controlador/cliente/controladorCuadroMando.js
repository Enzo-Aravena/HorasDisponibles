function cargarCiclodeTodosLosCentros(todoCentro,fechaHoy){
	$('#tabla_resultados').empty();	
	var resultado = null;
	var url = "../controlador/servidor/controladorCuadroMando.php";
	var type = "POST";
	var data = {
		evento:"buscarTodo",	
		centros:todoCentro,
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

		$("#tabla_resultados").append("<tr>"
			+"<td  style ='text-align: center;font-size:8px;'> Estado</td>"	
			+"<td style ='text-align: center;font-size:8px;'> Age </td>"
			+"<td style ='text-align: center;font-size:8px;'> Can </td>"
			+"<td style ='text-align: center;font-size:8px;'> Age </td>"
			+"<td style ='text-align: center;font-size:8px;'> Can </td>"
			+"<td style ='text-align: center;font-size:8px;'> Age </td>"
			+"<td style ='text-align: center;font-size:8px;'> Can </td>"
			+"<td style ='text-align: center;font-size:8px;'> Age </td>"
			+"<td style ='text-align: center;font-size:8px;'> Can </td>"
			+"<td style ='text-align: center;font-size:8px;'> Age </td>"
			+"<td style ='text-align: center;font-size:8px;'> Can </td>"
			+"<td style ='text-align: center;font-size:8px;'> Total Age </td>"					
			+"<td style ='text-align: center;font-size:8px;'> Total Can </td>"
		+"</tr>");
			
		
			
		for(var aux = 0 in resultado){
			if (resultado[aux].centro === "null" || resultado[aux].centro === null || resultado[aux].centro === "undefined" || resultado[aux].centro ===undefined || resultado[aux].centro === "") {
				$("#tabla_resultados").append("<tr>"
				+"<td colspan='11'>No se encuentran cargados ninguno de los ciclos </td>"
				+"</tr>");
			}// fin if
			else{	
				var tr ="";			
				tr += "<tr>";
				tr += "<td style='width: 6%;font-size:8px;text-align: center;'>"+resultado[aux].centro+"</td>";
				tr += "<td style ='width: 6%;font-size:8px; text-align: center;background:"+resultado[aux].ciclo1.colorAgendado+";color: white;border:3px solid #FFF;'>" +resultado[aux].ciclo1.Agendado+"</td>";
				tr += "<td style ='width: 6%;font-size:8px; text-align: center;background:"+resultado[aux].ciclo1.colorCancelado+";color: white;border:3px solid #FFF;'>"+resultado[aux].ciclo1.Cancelado+"</td>";
				tr += "<td style ='width: 6%;font-size:8px; text-align: center;background:"+resultado[aux].ciclo2.colorAgendado+";color: white;border:3px solid #FFF;'>" +resultado[aux].ciclo2.Agendado+"</td>";
				tr += "<td style ='width: 6%;font-size:8px; text-align: center;background:"+resultado[aux].ciclo2.colorCancelado+";color: white;border:3px solid #FFF;'>"+resultado[aux].ciclo2.Cancelado+"</td>";
				tr += "<td style ='width: 6%;text-align: center;font-size:8px;background:"+resultado[aux].ciclo3.colorAgendado+";color: white;border:3px solid #FFF;'>" +resultado[aux].ciclo3.Agendado+"</td>";
				tr += "<td style ='width: 6%;text-align: center;font-size:8px;background:"+resultado[aux].ciclo3.colorCancelado+";color: white;border:3px solid #FFF;'>"+resultado[aux].ciclo3.Cancelado+"</td>";
				tr += "<td style ='width: 6%;text-align: center;font-size:8px;background:"+resultado[aux].ciclo4.colorAgendado+";color: white;border:3px solid #FFF;'>" +resultado[aux].ciclo4.Agendado+"</td>";
				tr += "<td style ='width: 6%;text-align: center;font-size:8px;background:"+resultado[aux].ciclo4.colorCancelado+";color: white;border:3px solid #FFF;'>"+resultado[aux].ciclo4.Cancelado+"</td>";
				tr += "<td style ='width: 6%;text-align: center;font-size:8px;background:"+resultado[aux].ciclo5.colorAgendado+";color: white;border:3px solid #FFF;'>" +resultado[aux].ciclo5.Agendado+"</td>";
				tr += "<td style ='width: 6%;text-align: center;font-size:8px;background:"+resultado[aux].ciclo5.colorCancelado+";color: white;border:3px solid #FFF;'>"+resultado[aux].ciclo5.Cancelado+"</td>";
				tr += "<td style ='width: 6%;text-align: center;font-size:8px;background:"+resultado[aux].Total.colorAgendado+";color: white;border:3px solid #FFF;'>" +resultado[aux].Total.Agendado+"</td>";
				tr += "<td style ='width: 6%;text-align: center;font-size:8px;background:"+resultado[aux].Total.colorCancelado+";color: white;border:3px solid #FFF;'>"+resultado[aux].Total.Cancelado+"</td>";
				tr += "</tr>";
				$("#tabla_resultados").append(tr);
			}
		}
		
		//$('#loader').hide();
		window.parent.$("#loader").hide();
	},
	error:function(error){
		console.log("Error de la peticio");
	}
});// fin ajax							
		
}

function cargarDatos(){
	$('#carga_Data').empty();	
	var resultado = null;
	var url = "../controlador/servidor/controladorCuadroMando.php";
	var type = "POST";
	var data = {
		evento:"mostrarDatos"
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
			var tabla ="";
		
			for(var aux = 0 in resultado){
			if (resultado[aux].nombre === "null" || resultado[aux].nombre === null || resultado[aux].nombre === "undefined" || resultado[aux].nombre ===undefined || resultado[aux].nombre === "") {
				$("#tabla_resultados").append("<tr>"
				+"<td colspan='11'>No se encuentran cargados ninguno de los ciclos </td>"
				+"</tr>");
			}// fin if
			else{
				
				
				tabla = tabla + '<tr>';
					tabla = tabla + '<td style="font-size:8px;">'+resultado[aux].nombre+' </td>';
					tabla = tabla + '<td style="font-size:8px;">'+resultado[aux].horaCarga+' </td>';
					tabla = tabla + '<td style="font-size:8px;">'+resultado[aux].totalProceso+' </td>';
					tabla = tabla + '<td style="font-size:8px;">'+resultado[aux].estado+'></td>';
				tabla = tabla + '</tr>';
			}	

		}// end  for

		$('#carga_Data').append(tabla);
	},
	error:function(error){
		console.log("Error de la peticio");
	}
});// fin ajax							
		
}
