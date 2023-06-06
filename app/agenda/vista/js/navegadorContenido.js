$( document ).ready(function() {
	$('#fecha1').datepicker();  
    $('#fecha2').datepicker();

    $("#descargar").click(function() {
    	$("#mensaje").empty();
	    var texto = "<h3> Descargando Archivo..  </h3>";
	    $("#mensaje").append(texto);
		$("#myModal").modal();
		setTimeout(cuentaAtras, 1000);
	    var fecha1 = $('input[name=fecha1]').val();
		var fecha2 = $('input[name=fecha2]').val();
		var centro =($("input[name='centro']:checked").val());
		var semana =($("input[name='semana']:checked").val());
		window.location = "../controlador/servidor/reporteExcel.php?fecha1="+fecha1+"&fecha2="+fecha2+"&centro="+centro+"&semana="+semana;
	});

    $(".tab_content").hide(); 
	$("ul.nav li:first").addClass("active").show(); 
	$(".tab_content:first").show();
	$("ul.nav li").click(function() {
		$("ul.nav li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();
		var activeTab = $(this).find("a").attr("href");
		$(activeTab).fadeIn();
		return false;
	});	


	$('#ejecutar').on("click",function(){
		var fecha1 = $('input[name=fecha1]').val();
		var fecha2 = $('input[name=fecha2]').val();
		var resultado = validate_fechaMayorQue(fecha1,fecha2);
		if (resultado ===  true) {
			if (fecha1 !== "" && fecha2 ==="") {
				getAjaxData();
				$("#ExportarData").show();
			}else{
				$("#ExportarData").hide();
				$("#mensaje").empty();
				var texto = "<h3> La fecha no puede ser menor que la primera ..  </h3>";
				$("#mensaje").append(texto);
				$("#myModal").modal();
			}
		}else{
			if (fecha1 === "" && fecha2 ==="") {
				$("#ExportarData").hide();
				$("#mensaje").empty();
				var texto = "<h3> Debe seleccionar un rango de fechas..  </h3>";
				$("#mensaje").append(texto);
				$("#myModal").modal();
			}else{
				$("#ExportarData").show();
				getAjaxData();
			}
		}
	});

	$('#abrirPopUp').on("click",function(){
		$("#manualUsuario").modal();
	});

});

//-------------------- Cierra el popup ----------------------
var contador = 3;
function cuentaAtras() {
  if (contador==0) {
	$("#myModal").modal('hide');
  } else {
	contador--;
	setTimeout(cuentaAtras, 2000);
  }
}
//------------------------------------------

function validate_fechaMayorQue(fecha1,fecha2) {
    missinginfo = "";
    var rangoini = fecha1; 		// document.getElementById('fec_inicio').value;
    var rangofin =  fecha2; 		//document.getElementById('fec_fin').value;
	valuesStart=rangoini.split("/");     
	valuesEnd=rangofin.split("/");
    if ((Date.parse(valuesStart[1]+'/'+valuesStart[0]+'/'+valuesStart[2])) > (Date.parse(valuesEnd[1]+'/'+valuesEnd[0]+'/'+valuesEnd[2]))) {
    	return true;
    }else{
    	return false;
    } 
}

window.onload=getAjaxData;
function getAjaxData(){
	//window.parent.$("#loader").show();
	var fecha1 = $('input[name=fecha1]').val();
	var fecha2 = $('input[name=fecha2]').val();
	var centro =$("input[name='centro']:checked").val();
	var semana =$("input[name='semana']:checked").val();

	var V_FECHA = [];
	var V_CENTRO = [];
	var V_OFERTADO_MORBT = [];
	var V_AGENDADOS_FINAL_MORBT = [];
	var V_AGENDADOS_CONFIRMADO_MORBT = [];
	var V_BLOQUES_NO_AGENDADOS_MORBT = [];
	var V_OFERTADO_MORBI = [];
	var V_AGENDADOS_MORBI = [];
	var V_AGENDADOS_CONFIRMADO_MORBI = [];
	var V_BLOQUES_NO_AGENDADOS_MORBI = [];

	var data = {
		evento:"todo",
		fecha1: fecha1,
		fecha2: fecha2,
		centro:centro,
		semana:semana
	};

	$.getJSON("../controlador/servidor/morbilidadController.php",data, function(json) {
		var resultado = json;
		for(var aux = 0 in resultado){
			V_FECHA.push([resultado[aux].FECHAOFERTA]);
			V_CENTRO.push([resultado[aux].CENTRO]);
			V_OFERTADO_MORBT.push([parseInt(resultado[aux].OFERTADO_MORBT)]);
			V_AGENDADOS_FINAL_MORBT.push([parseInt(resultado[aux].AGENDADOS_FINAL_MORBT)]);
			V_AGENDADOS_CONFIRMADO_MORBT.push([parseInt(resultado[aux].AGENDADOS_CONFIRMADO_MORBT)]);
			V_BLOQUES_NO_AGENDADOS_MORBT.push([parseInt(resultado[aux].BLOQUES_NO_AGENDADOS_MORBT)]);
			V_OFERTADO_MORBI.push([parseInt(resultado[aux].OFERTADO_MORBI)]);
			V_AGENDADOS_MORBI.push([parseInt(resultado[aux].AGENDADOS_MORBI)]);
			V_AGENDADOS_CONFIRMADO_MORBI.push([parseInt(resultado[aux].AGENDADOS_CONFIRMADO_MORBI)]);
			V_BLOQUES_NO_AGENDADOS_MORBI.push([parseInt(resultado[aux].BLOQUES_NO_AGENDADOS_MORBI)]);
		}

		if(semana==0) {
			if(centro==0) {
				options.xAxis.categories = V_CENTRO;
				}else{
				options.xAxis.categories = V_FECHA;
			}
		}else{
				if(centro==0) {
				options.xAxis.categories = V_CENTRO;
				}else{
				options.xAxis.categories = V_FECHA;
			}
		}

		if(fecha1==0){ 
			options.subtitle.text = 'Total Semana Actual';
		}else{
			if(fecha2==0){ 
				options.subtitle.text = fecha1;
			}else{
				options.subtitle.text =fecha1+' - '+fecha2;
			}
		}
			
		chart = new Highcharts.Chart(options);
		showTable();
		if(V_FECHA==0) {
				$.each(chart.series, function (k, v) {
				console.log(v)
				chart.series[k].hide();
				});
		}else{
			var MT = $('input[name=MORBI]').prop('checked');
			var MI = $('input[name=MORBT]').prop('checked');
			if(MT == false){
				hide_MORBT();
			};
			if(MI == false){
				hide_MORBI();
			};
		}

		function hide_MORBT() {
			var aux = $('input[name=MORBT]').prop('checked');
			if(aux == false ){
					elemId =2;
					$.each(chart.series, function (k, v) {
					console.log(v);
				if(v.options.id == elemId) {
					chart.series[k].hide();
					}
				});
			} else {
				elemId =2;
					$.each(chart.series, function (k, v) {
					console.log(v);
				if(v.options.id == elemId) {
					chart.series[k].show();
					}
			});
			}
		}
	
		function hide_MORBI() {	
			var aux = $('input[name=MORBI]').prop('checked');
			if(aux == false ){
					elemId =1;
					$.each(chart.series, function (k, v) {
					console.log(v);
				if(v.options.id == elemId) {
					chart.series[k].hide();
					}
				});
			} else {
				elemId =1;
					$.each(chart.series, function (k, v) {
					console.log(v);
				if(v.options.id == elemId) {
					chart.series[k].show();
					}
			});
			}
		}

		acto_morbt.onclick = function() {
			hide_MORBT();
				var aux_morbi = $('input[name=MORBI]').prop('checked');
				var aux_morbt = $('input[name=MORBT]').prop('checked');
					if(aux_morbt == false && aux_morbi == true  ){
						$("#button_morbi").attr('checked', true);
					}else{
						$("#button_morbt").attr('checked', true);
					}
			showTable();
		}

		acto_morbi.onclick = function() {
			hide_MORBI();
				var aux_morbi = $('input[name=MORBI]').prop('checked');
				var aux_morbt = $('input[name=MORBT]').prop('checked');
					if(aux_morbt == false && aux_morbi == true  ){
						$("#button_morbi").attr('checked', true);
					}else{
						$("#button_morbt").attr('checked', true);
					}
			showTable();
		}

		button_morbt.onclick = function() {showTable();}
		button_morbi.onclick = function() {showTable();}
	});

	var options = {
		chart: {
			renderTo: 'container',
				animation: {
					duration: 1300
			},
			type: 'column',
			marginRight: 30,
			marginBottom: 65,
			width: 1170,
			zoomType: 'x',
			resetZoomButton: {
				position: {
					align: 'right',
					verticalAlign: 'top',
					x: -8,
					y: 31
				},
				relativeTo: 'chart'
			}  
		},
		xAxis: {
				categories: []
		},title: {
			text: 'Ocupación Morbilidad Diaria'
		},
		subtitle: {
			text:  [],
				align: 'center',
			y: 61,
				style: {
				fontSize: '14px',
				color: '#cc0066',
				fontWeight: 'bold'
			}
		},
		yAxis: {
			title: {
				text: ''
			},
			plotLines: [{
				value: 0,
				width: 0,
				color: '#808080'
			}]
		},
		tooltip: {
		pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
		},
			exporting: {
			enabled:false			        
		},		
		legend: {
			itemStyle: {
				fontSize: '0.92em',
			},
			itemHoverStyle: {
				color: '#0000FF'
			},
			itemWidth: 270,
			align: 'center',
			verticalAlign: 'top',
			borderWidth: 0.5,
			backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
			shadow: true
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				pointPadding: 0.03,
				dataLabels: {
					enabled: true,
						rotation: -90,
					color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
					style: {
						textShadow: '0 0 3px black'
					}
				}
			}
		},
		series: [
			{ 
				id : 1,
				name: 'MORBI OFERTADO ',
				data: V_OFERTADO_MORBI,
				color: '#32CD32',
				stack: 'OFERTADO'
			},
			{ 
				id : 1,
				name: 'MORBI AGENDADO',
				data: V_AGENDADOS_MORBI,
				color: '#BA55D3',
				stack: 'AGENDA'
			},
			{ 
				id : 1,
				name: 'MORBI AGENDA CONFIRMADA',
				data: V_AGENDADOS_CONFIRMADO_MORBI,
				color: '#4169E1',
				stack: 'ASISTIO'
			},
			{ 
				id : 1,
				name: 'MORBI CUPOS SIN UTILIZAR',
				data: V_BLOQUES_NO_AGENDADOS_MORBI,
				color: '#FF3333',
				stack: 'BLOQUES'
			},
			{ 
				id : 2,
				name: 'MORBT OFERTADO ',
				data: V_OFERTADO_MORBT,
				color: '#008000',
				stack: 'OFERTADO'
			},
			{ 
				id : 2,
				name: 'MORBT AGENDADO ',
				data: V_AGENDADOS_FINAL_MORBT,
				color: '#9400D3',
				stack: 'AGENDA'
			},
			{ 
				id : 2,
				name: 'MORBT AGENDA CONFIRMADA ',
				data: V_AGENDADOS_CONFIRMADO_MORBT,
				color: '#0000FF',
				stack: 'ASISTIO'
			},
			{ 
				id : 2,
				name: 'MORBT CUPOS SIN UTILIZAR ',
				data: V_BLOQUES_NO_AGENDADOS_MORBT,
				color: '#CC0000',
				stack: 'BLOQUES'
			}
		]
	}
}
	
	
function showTable() {
	var fecha1 = $('input[name=fecha1]').val();
	var fecha2 = $('input[name=fecha2]').val();
	var centro =($("input[name='centro']:checked").val());
	var semana =($("input[name='semana']:checked").val());
	var acto =($("input[name='TABLA']:checked").val());

	$('#tabla_resultados').empty();
	$('#tituloPrincipal').empty();
	$('#CabeceraTabla').empty();
	var tabla ="";
	var cabecera ="";

	var data = {
		evento:"table",
		fecha1: fecha1,
		fecha2: fecha2,
		centro:centro,
		semana:semana,
		acto:acto
	};
	
	$.getJSON("../controlador/servidor/morbilidadController.php",data, function(response) {
		var resultado = response;
		if (resultado.data  === "0" || resultado == 0 || resultado == undefined || resultado == "undefined" ) {
			$('#tituloPrincipal').append("<th colspan=11 style='text-align: center;'> OCUPACION MORBILIDAD - MORBT </th>");
			//creacion titulo cabecera
			cabecera = cabecera + '<th class="interior"> Fecha </th>';
			cabecera = cabecera + '<th class="interior" style="font-size: 10.2px !important;"> Centro </th>';
			cabecera = cabecera + '<th class="interior" style="background-color: #008000;color: white;"> Ofertados </th>';
			cabecera = cabecera + '<th class="interior"> Agendados por Telefónica </th>';
			cabecera = cabecera + '<th class="interior"> Agendados por Mesón </th>';
			cabecera = cabecera + '<th class="interior" style="background-color: #9400D3;color: white;"> Total Agendados </th>';
			cabecera = cabecera + '<th class="interior" style="background-color: #0000FF;color: white;"> Agendados Confirmados </th>';
			cabecera = cabecera + '<th class="interior" style="background-color: #CC0000;color: white;"> Cupos sin Utilizar </th>';
			cabecera = cabecera + '<th style = "border: 1px solid #000;font-size: 11.7px !important;text-align: center;background-color: #ccffcc;"> % Total Agendados </th>';
			cabecera = cabecera + '<th style = "border: 1px solid #000;font-size: 11.7px !important;text-align: center;background-color: #ccffcc;"> % Agendados Confirmados </th>';
			cabecera = cabecera + '<th style = "border: 1px solid #000;font-size: 11.7px !important;text-align: center;background-color: #ccffcc;"> % Agendados Inasistentes </th>';
			$('#CabeceraTabla').append(cabecera);

			tabla = tabla + '<tr>';
				tabla = tabla + '<td colspan = 11 class="interior"> no se han encontrado resultados.. </td>';
			tabla = tabla + '</tr>';
			$('#tabla_resultados').append(tabla);

		}else{
			if (acto == 1) {
				$('#tituloPrincipal').append("<th colspan=11 style='text-align: center;'> OCUPACION MORBILIDAD - MORBT </th>");
				//creacion titulo cabecera
				cabecera = cabecera + '<th class="interior"> Fecha </th>';
				cabecera = cabecera + '<th class="interior" style="font-size: 10.2px !important;"> Centro </th>';
				cabecera = cabecera + '<th class="interior" style="background-color: #008000;color: white;"> Ofertados </th>';
				cabecera = cabecera + '<th class="interior"> Agendados por Telefónica </th>';
				cabecera = cabecera + '<th class="interior"> Agendados por Mesón </th>';
				cabecera = cabecera + '<th class="interior" style="background-color: #9400D3;color: white;"> Total Agendados </th>';
				cabecera = cabecera + '<th class="interior" style="background-color: #0000FF;color: white;"> Agendados Confirmados </th>';
				cabecera = cabecera + '<th class="interior" style="background-color: #CC0000;color: white;"> Cupos sin Utilizar </th>';
				cabecera = cabecera + '<th style = "border: 1px solid #000;font-size: 11.7px !important;text-align: center;background-color: #ccffcc;"> % Total Agendados </th>';
				cabecera = cabecera + '<th style = "border: 1px solid #000;font-size: 11.7px !important;text-align: center;background-color: #ccffcc;"> % Agendados Confirmados </th>';
				cabecera = cabecera + '<th style = "border: 1px solid #000;font-size: 11.7px !important;text-align: center;background-color: #ccffcc;"> % Agendados Inasistentes </th>';
				$('#CabeceraTabla').append(cabecera);

				for(var aux = 0 in resultado){
					tabla = tabla + '<tr>';
						tabla = tabla + '<td  class="interior">'+resultado[aux].FECHAOFERTA+' </td>';
						tabla = tabla + '<td  class="interior" >'+resultado[aux].CENTRO+' </td>';
						tabla = tabla + '<td  class="interior">'+resultado[aux].OFERTADO_MORBT+' </td>';
						tabla = tabla + '<td  class="interior">'+resultado[aux].AGENDADOS_MORBT_TELEFONICA+' </td>';
						tabla = tabla + '<td  class="interior">'+resultado[aux].AGENDADOS_MESON_MORBT+' </td>';
						tabla = tabla + '<td  class="interior">'+resultado[aux].AGENDADOS_FINAL_MORBT+' </td>';
						tabla = tabla + '<td  class="interior">'+resultado[aux].AGENDADOS_CONFIRMADO_MORBT+' </td>';
						tabla = tabla + '<td  class="interior">'+resultado[aux].BLOQUES_NO_AGENDADOS_MORBT+' </td>';
						tabla = tabla + '<td  style = "border: 1px solid #000;font-size: 11.7px !important;text-align: center;background-color: #ccffcc;">'+resultado[aux].AGENDA_FINAL_PROCENTAJE_MORBT+' % </td>';
						tabla = tabla + '<td  style = "border: 1px solid #000;font-size: 11.7px !important;text-align: center;background-color: #ccffcc;">'+resultado[aux].AGENDADOS_PORCENTAJE_MORBT+' % </td>';
						tabla = tabla + '<td  style = "border: 1px solid #000;font-size: 11.7px !important;text-align: center;background-color: #ccffcc;">'+resultado[aux].INASISTENTE_PORCENTAJE_MORBT+' % </td>';
					tabla = tabla + '</tr>';
				}
				$('#tabla_resultados').append(tabla);

			}else{
				$('#tituloPrincipal').append("<th colspan=11 style='text-align: center;'> OCUPACION MORBILIDAD - MORBI </th>");
				//creacion titulo cabecera
				cabecera = cabecera + '<th class="interiorDos"> Fecha </th>';
				cabecera = cabecera + '<th class="interiorDos" style="font-size: 10.2px !important;"> Centro </th>';
				cabecera = cabecera + '<th class="interiorDos" style="background-color: #32CD32;color: white;"> Ofertados </th>';
				cabecera = cabecera + '<th class="interiorDos" style="background-color: #BA55D3;color: white;"> Agendados </th>';
				cabecera = cabecera + '<th class="interiorDos"> Agendados Forzados </th>';
				cabecera = cabecera + '<th class="interiorDos" style="background-color: #4169E1;color: white;"> Agendados Confirmados </th>';
				cabecera = cabecera + '<th class="interiorDos" style="background-color: #FF3333;color: white;"> Cupos sin Utilizar </th>';
				cabecera = cabecera + '<th style = "border: 1px solid #000;font-size: 11.7px !important;text-align: center;background-color: #ccffcc;"> % Total Agendados </th>';
				cabecera = cabecera + '<th style = "border: 1px solid #000;font-size: 11.7px !important;text-align: center;background-color: #ccffcc;"> % Agendados Confirmados </th>';
				cabecera = cabecera + '<th style = "border: 1px solid #000;font-size: 11.7px !important;text-align: center;background-color: #ccffcc;"> % Agendados Inasistentes </th>';
				$('#CabeceraTabla').append(cabecera);

				for(var aux = 0 in resultado){
					tabla = tabla + '<tr>';
						tabla = tabla + '<td  class="interiorDos">'+resultado[aux].FECHAOFERTA+' </td>';
						tabla = tabla + '<td  class="interiorDos">'+resultado[aux].CENTRO+' </td>';
						tabla = tabla + '<td  class="interiorDos">'+resultado[aux].OFERTADO_MORBI+' </td>';
						tabla = tabla + '<td  class="interiorDos">'+resultado[aux].AGENDADOS_MORBI+' </td>';
						tabla = tabla + '<td  class="interiorDos">'+resultado[aux].AGENDADOS_MORBI_FORZADOS+' </td>';
						tabla = tabla + '<td  class="interiorDos">'+resultado[aux].AGENDADOS_CONFIRMADO_MORBI+' </td>';
						tabla = tabla + '<td  class="interiorDos">'+resultado[aux].BLOQUES_NO_AGENDADOS_MORBI+' </td>';
						tabla = tabla + '<td  style = "border: 1px solid #000;font-size: 11.7px !important;text-align: center;background-color: #ccffcc;">'+resultado[aux].AGENDA_FINAL_PROCENTAJE_MORBI+' % </td>';
						tabla = tabla + '<td  style = "border: 1px solid #000;font-size: 11.7px !important;text-align: center;background-color: #ccffcc;">'+resultado[aux].AGENDADOS_PORCENTAJE_MORBI+' % </td>';
						tabla = tabla + '<td  style = "border: 1px solid #000;font-size: 11.7px !important;text-align: center;background-color: #ccffcc;">'+resultado[aux].INASISTENTE_PORCENTAJE_MORBI+' % </td>';
					tabla = tabla + '</tr>';
				}

				$('#tabla_resultados').append(tabla);
			}
		}
	});

	//window.parent.$("#loader").hide();
}


