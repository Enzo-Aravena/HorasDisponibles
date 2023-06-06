function buscarPacienteSapu(rutPaciente,desde){
	var resultado = null;
	var url = "../controlador/servidor/buscadorSapuController.php";
	var type = "POST";
	var data = {
		evento:"buscarPaciente",
		rut:rutPaciente,
		fecha:desde		
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
			$('#tabla_resultados').empty();
			$("#tablesContent").show();
			var tabla="";

			if (resultado  === "0") {
				tabla = tabla + '<tr>';
                	tabla = tabla + '<td colspan=33;> No se han encontrado resultados relacionados a la búsqueda. </td>';
                tabla = tabla + '</tr>';

			}else{
				resultado = JSON.parse(response);
				for(var aux = 0 in resultado){                
                    tabla = tabla + '<tr>';                    
	                    tabla = tabla + '<td>'+resultado[aux].CENTRO_ATENCION +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].NOMBRE_PROFESIONAL +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].PROFESION +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].RUT_PROFESIONAL +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].CENTRO_PACIENTE +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].SECTOR_PACIENTE +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].RUT_PACIENTE +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].NOMBRE_PACIENTE +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].SEXO +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].DOMICILIO +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].FECHA_NACIMIENTO +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].EDAD_VISITA_PACIENTE +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].RANGO_ETARIO_1 +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].RANGO_ETARIO_2 +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].EPISODIO +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].PROTOCOLO +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].FECHA_ATENCION +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].HORA_ATENCION +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].NUM_ATENCION_SAPU +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].TIPO_INSCRIPCION +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].MOTIVO_CONSULTA +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].EMBARAZADA +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].CONSTATACION_DE_LESIONES +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].ALCOHOLEMIA +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].REALIZA_REANIMACION +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].PACIENTE_FALLECIDO +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].NSP +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].derivacion_urgencia +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].derivacion_urgencia_otro +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].CAT_URGENCIA +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].DIAGNOSTICO +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].PAC_ID +' </td>';
	                    tabla = tabla + '<td>'+resultado[aux].TIPO_REGISTRO +' </td>';
                    tabla = tabla + '</tr>';

                }// END FOR
                
			}//END ELSE

			$('#tabla_resultados').append(tabla);

			$('#tabla_resultados').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:15});
				window.parent.$("html,body").animate({ scrollTop: 0 }, 600);
		},
		error:function(error){
			console.log("Error de la peticio");
			
		}
	});// fin ajax
}