$(document).ready(function(){
	$('#desde').datepicker();  
	$('#hasta').datepicker();

	cargarSelect();
	CargarMenu();


	cargarDataPAntalla();


$("#ejecutar").on("click",function(){
	// fecha inicio
	var Fdesde = $('input[name=desde]').val();
	var testo = Fdesde.split("/");
	var desde = testo[2]+ "-" + testo[1]+ "-" +testo[0];
	//fecha fin 
	var Fhasta = $('input[name=hasta]').val();
	var testo = Fhasta.split("/");
	var hasta = testo[2]+ "-" + testo[1]+ "-" +testo[0];

	var centro= $('input:radio[name=rdbBuscar]:checked').val();
	var diaSemana= $('input:radio[name=semana]:checked').val();
	var actos = $("#acto").val();

// VALIDACION DE UNA FECHA

//muestra todo el grafico sin filtro
if (desde === "undefined-undefined-"  && hasta ==="undefined-undefined-" && centro === "todo" && diaSemana === "todo" && actos === "SELECCIONE ...") {
	alert("Mostrar todos los datos del grafico en la pantalla");
}else
	//busca solo por una fecha
	if (desde !== "undefined-undefined-"  && hasta ==="undefined-undefined-" && centro === "todo" && diaSemana === "todo" && actos === "SELECCIONE ...") {
		alert("aqui busca por una fecha");
	}
	else
		//busca por fecha y centro 
		if (desde !== "undefined-undefined-"  && hasta === "undefined-undefined-" && centro !== "todo" && diaSemana === "todo" && actos === "SELECCIONE ...") {
			alert("aqui busca por una fecha y por el centro");		
		}else
			//busca por fecha, centro dia de semana
			if (desde !== "undefined-undefined-"  && hasta === "undefined-undefined-" && centro !== "todo" && diaSemana !== "todo" && actos === "SELECCIONE ...") {
				alert("MUESTRA la fecha, centro y dia semana");
			}
		else
			//busca por fecha, centro y acto
			if (desde !== "undefined-undefined-"  && hasta === "undefined-undefined-" && centro !== "todo" && diaSemana === "todo" && actos !== "SELECCIONE ...") {
				alert("MUESTRA la fecha, centro y el acto");
			}else
				// busca por una fehca, centro,diaSemana, y actos
				if (desde !== "undefined-undefined-"  && hasta === "undefined-undefined-" && centro !== "todo" && diaSemana !== "todo" && actos !== "SELECCIONE ...") {
					alert("MUESTRA la fecha, centro , el acto y dia semana");
				}else
					//BUSCA POR DOS FECHAS
					if (desde !== "undefined-undefined-"  && hasta !== "undefined-undefined-" && centro === "todo" && diaSemana === "todo" && actos === "SELECCIONE ...") {
						alert("busca por el rango de fechas "+desde	+" , "+ hasta);
					}
					else
					//busca rango fechas y centro 
					if (desde !== "undefined-undefined-"  && hasta !== "undefined-undefined-" && centro !== "todo" && diaSemana === "todo" && actos === "SELECCIONE ...") {
						alert("aqui busca por rango fechas y por el centro");		
					}
					else
						//busca por fecha, centro y acto
						if (desde !== "undefined-undefined-"  && hasta !== "undefined-undefined-" && centro !== "todo" && diaSemana === "todo" && actos !== "SELECCIONE ...") {
							alert("MUESTRA rango de fechas , centro y el acto");
						}else
							// busca por una fehca, centro,diaSemana, y actos
							if (desde !== "undefined-undefined-"  && hasta !== "undefined-undefined-" && centro !== "todo" && diaSemana !== "todo" && actos !== "SELECCIONE ...") {
								alert("MUESTRA rango de fechas , centro , acto y dia semana");
							}else{
								alert("No funciona esta wea");
								console.log("Error al ejecutar la consulta");
							}
});

	// EXPORTAR EXCEL
	$("#exportar").on("click",function(){
	// fecha inicio
	var Fdesde = $('input[name=desde]').val();
	var testo = Fdesde.split("/");
	var desde = testo[2]+ "-" + testo[1]+ "-" +testo[0];
	//fecha fin 
	var Fhasta = $('input[name=hasta]').val();
	var testo = Fhasta.split("/");
	var hasta = testo[2]+ "-" + testo[1]+ "-" +testo[0];

	var centro= $('input:radio[name=rdbBuscar]:checked').val();
	var diaSemana= $('input:radio[name=semana]:checked').val();
	var actos = $("#acto").val();

// VALIDACION DE UNA FECHA
	//muestra todo el grafico sin filtro
	if (desde === "undefined-undefined-"  && hasta ==="undefined-undefined-" && centro === "todo" && diaSemana === "todo" && actos === "SELECCIONE ...") {
		alert("Mostrar todos los datos del grafico en la pantalla");
	}else
		//busca solo por una fecha
		if (desde !== "undefined-undefined-"  && hasta ==="undefined-undefined-" && centro === "todo" && diaSemana === "todo" && actos === "SELECCIONE ...") {
			alert("aqui busca por una fecha");
		}
		else
			//busca por fecha y centro 
			if (desde !== "undefined-undefined-"  && hasta === "undefined-undefined-" && centro !== "todo" && diaSemana === "todo" && actos === "SELECCIONE ...") {
				alert("aqui busca por una fecha y por el centro");		
			}else
				//busca por fecha, centro dia de semana
				if (desde !== "undefined-undefined-"  && hasta === "undefined-undefined-" && centro !== "todo" && diaSemana !== "todo" && actos === "SELECCIONE ...") {
					alert("MUESTRA la fecha, centro y dia semana");
				}
			else
				//busca por fecha, centro y acto
				if (desde !== "undefined-undefined-"  && hasta === "undefined-undefined-" && centro !== "todo" && diaSemana === "todo" && actos !== "SELECCIONE ...") {
					alert("MUESTRA la fecha, centro y el acto");
				}else
					// busca por una fehca, centro,diaSemana, y actos
					if (desde !== "undefined-undefined-"  && hasta === "undefined-undefined-" && centro !== "todo" && diaSemana !== "todo" && actos !== "SELECCIONE ...") {
						alert("MUESTRA la fecha, centro , el acto y dia semana");
					}else
						//BUSCA POR DOS FECHAS
						if (desde !== "undefined-undefined-"  && hasta !== "undefined-undefined-" && centro === "todo" && diaSemana === "todo" && actos === "SELECCIONE ...") {
							alert("busca por el rango de fechas "+desde	+" , "+ hasta);
						}
						else
						//busca rango fechas y centro 
						if (desde !== "undefined-undefined-"  && hasta !== "undefined-undefined-" && centro !== "todo" && diaSemana === "todo" && actos === "SELECCIONE ...") {
							alert("aqui busca por rango fechas y por el centro");		
						}
						else
							//busca por fecha, centro y acto
							if (desde !== "undefined-undefined-"  && hasta !== "undefined-undefined-" && centro !== "todo" && diaSemana === "todo" && actos !== "SELECCIONE ...") {
								alert("MUESTRA rango de fechas , centro y el acto");
							}else
								// busca por una fehca, centro,diaSemana, y actos
								if (desde !== "undefined-undefined-"  && hasta !== "undefined-undefined-" && centro !== "todo" && diaSemana !== "todo" && actos !== "SELECCIONE ...") {
									alert("MUESTRA rango de fechas , centro , acto y dia semana");
								}else{
									console.log("Error, no se puede descargar la aplicacion");
								}
	});






});