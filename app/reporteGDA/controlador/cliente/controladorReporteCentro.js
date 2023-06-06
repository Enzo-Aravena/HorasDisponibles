function cargaDeCiclosDiaria(fecha1,fecha2){
	var resultado = null;
	var url = "../controlador/servidor/controladorReporte.php";
	var type = "POST";
	var data = {
		evento:"obtenerTabla",
		fecha1:fecha1,
		fecha2:fecha2
	};
		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){
				if (fecha2 === "") {
					$("#fecha").text(fecha1);
				} else {
					$("#fecha").text(fecha1 +" - "+ fecha2);
				}
				resultado = JSON.parse(response);

				
				$('#Resultado').empty();
				let tabla= "";
				let arreglo = Array("CAROL URZUA","LA FAENA","SAN LUIS","LO HERMIDA","CARDENAL SILVA H.","PADRE GERARDO W","LAS TORRES","TOTAL");
				let cont = 1;
				
				if (resultado[1][0].OF_TOTAL  === "0") {
					tabla = tabla + "<tr>";
							tabla = tabla + "<td colspan= '14'> No se han encontrado resultados asociados a la fecha indicada</td>";		
				tabla = tabla + "</tr>";

				$("#exportInforme").hide();
				}else{


					$("#exportInforme").show();
					tabla = tabla + "<tr>";
							
							tabla = tabla + "<td>"+resultado[0][0].C+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[1][0].OF_CU+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[2][0].A_REAL_1+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[3][0].C_REAL_1+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[14][0].A_TOTAL_CICLO_1+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[15][0].C_TOTAL_CICLO_1+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[4][0].A_CICLO_1_1+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[5][0].C_CICLO_1_1+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[6][0].A_CICLO_2_1+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[7][0].C_CICLO_2_1+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[8][0].A_CICLO_3_1+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[9][0].C_CICLO_3_1+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[10][0].A_CICLO_4_1+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[11][0].C_CICLO_4_1+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[12][0].A_CICLO_5_1+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[13][0].C_CICLO_5_1+"</td>";		
				tabla = tabla + "</tr>";

				tabla = tabla + "<tr>";
							tabla = tabla + "<td>"+resultado[0][0].F+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[1][0].OF_LF+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[2][0].A_REAL_2+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[3][0].C_REAL_2+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[14][0].A_TOTAL_CICLO_2+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[15][0].C_TOTAL_CICLO_2+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[4][0].A_CICLO_1_2+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[5][0].C_CICLO_1_2+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[6][0].A_CICLO_2_2+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[7][0].C_CICLO_2_2+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[8][0].A_CICLO_3_2+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[9][0].C_CICLO_3_2+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[10][0].A_CICLO_4_2+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[11][0].C_CICLO_4_2+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[12][0].A_CICLO_5_2+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[13][0].C_CICLO_5_2+"</td>";
							
						tabla = tabla + "</tr>";
						tabla = tabla + "<tr>";
							tabla = tabla + "<td>"+resultado[0][0].SL+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[1][0].OF_SL+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[2][0].A_REAL_3+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[3][0].C_REAL_3+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[14][0].A_TOTAL_CICLO_3+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[15][0].C_TOTAL_CICLO_3+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[4][0].A_CICLO_1_3+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[5][0].C_CICLO_1_3+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[6][0].A_CICLO_2_3+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[7][0].C_CICLO_2_3+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[8][0].A_CICLO_3_3+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[9][0].C_CICLO_3_3+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[10][0].A_CICLO_4_3+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[11][0].C_CICLO_4_3+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[12][0].A_CICLO_5_3+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[13][0].C_CICLO_5_3+"</td>";
							
						tabla = tabla + "</tr>";
						tabla = tabla + "<tr>";
							tabla = tabla + "<td>"+resultado[0][0].LH+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[1][0].OF_LH+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[2][0].A_REAL_4+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[3][0].C_REAL_4+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[14][0].A_TOTAL_CICLO_4+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[15][0].C_TOTAL_CICLO_4+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[4][0].A_CICLO_1_4+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[5][0].C_CICLO_1_4+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[6][0].A_CICLO_2_4+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[7][0].C_CICLO_2_4+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[8][0].A_CICLO_3_4+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[9][0].C_CICLO_3_4+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[10][0].A_CICLO_4_4+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[11][0].C_CICLO_4_4+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[12][0].A_CICLO_5_4+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[13][0].C_CICLO_5_4+"</td>";
							
						tabla = tabla + "</tr>";
						tabla = tabla + "<tr>";
							tabla = tabla + "<td>"+resultado[0][0].CSH+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[1][0].OF_CSH+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[2][0].A_REAL_5+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[3][0].C_REAL_5+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[14][0].A_TOTAL_CICLO_5+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[15][0].C_TOTAL_CICLO_5+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[4][0].A_CICLO_1_5+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[5][0].C_CICLO_1_5+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[6][0].A_CICLO_2_5+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[7][0].C_CICLO_2_5+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[8][0].A_CICLO_3_5+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[9][0].C_CICLO_3_5+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[10][0].A_CICLO_4_5+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[11][0].C_CICLO_4_5+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[12][0].A_CICLO_5_5+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[13][0].C_CICLO_5_5+"</td>";
							
						tabla = tabla + "</tr>";
						tabla = tabla + "<tr>";
							tabla = tabla + "<td>"+resultado[0][0].PGW+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[1][0].OF_PGW+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[2][0].A_REAL_12+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[3][0].C_REAL_12+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[14][0].A_TOTAL_CICLO_12+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[15][0].C_TOTAL_CICLO_12+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[4][0].A_CICLO_1_12+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[5][0].C_CICLO_1_12+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[6][0].A_CICLO_2_12+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[7][0].C_CICLO_2_12+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[8][0].A_CICLO_3_12+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[9][0].C_CICLO_3_12+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[10][0].A_CICLO_4_12+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[11][0].C_CICLO_4_12+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[12][0].A_CICLO_5_12+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[13][0].C_CICLO_5_12+"</td>";
							
						tabla = tabla + "</tr>";
						tabla = tabla + "<tr>";
							tabla = tabla + "<td>"+resultado[0][0].LT+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[1][0].OF_LT+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[2][0].A_REAL_13+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[3][0].C_REAL_13+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[14][0].A_TOTAL_CICLO_13+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[15][0].C_TOTAL_CICLO_13+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[4][0].A_CICLO_1_13+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[5][0].C_CICLO_1_13+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[6][0].A_CICLO_2_13+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[7][0].C_CICLO_2_13+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[8][0].A_CICLO_3_13+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[9][0].C_CICLO_3_13+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[10][0].A_CICLO_4_13+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[11][0].C_CICLO_4_13+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[12][0].A_CICLO_5_13+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[13][0].C_CICLO_5_13+"</td>";
							
						tabla = tabla + "</tr>";
						tabla = tabla + "<tr>";
							tabla = tabla + "<td>"+resultado[0][0].TOTAL+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[1][0].OF_TOTAL+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[2][0].A_REAL_TOTAL+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[3][0].C_REAL_TOTAL+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[14][0].A_TOTAL_CICLO+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+ resultado[15][0].C_TOTAL_CICLO+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[4][0].A_CICLO_1+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[5][0].C_CICLO_1+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[6][0].A_CICLO_2+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[7][0].C_CICLO_2+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[8][0].A_CICLO_3+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[9][0].C_CICLO_3+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[10][0].A_CICLO_4+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[11][0].C_CICLO_4+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[12][0].A_CICLO_5+"</td>";
							tabla = tabla + "<td class='Cuerpo'>"+resultado[13][0].C_CICLO_5+"</td>";
							
						tabla = tabla + "</tr>";
				}
				$('#Resultado').append(tabla);
			},
			error:function(error){
				console.log("Error de la peticio");
			}
		});// fin ajax
}


function exportArchivoGda(fechaHoy){
	var resultado = null;
	var url = "../controlador/servidor/controladorReporte.php";
	var type = "POST";
	var data = {
		evento:"exportarArchivo",
		fecha:fechaHoy
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

				//$("#excel").empty();
				//$("#excel").append(resultado);
				

			},
			error:function(error){
				console.log("Error de la peticio");
			}
		});// fin ajax
}