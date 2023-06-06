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
			
		window.location = "../controlador/servidor/reportGDAllamadas.php?fecha1="+fecha1+"&fecha2="+fecha2+"&centro="+centro+"&semana="+semana;
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
    var rangoini = fecha1;
    var rangofin =  fecha2;
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
	var fecha1 = $('input[name=fecha1]').val();
	var fecha2 = $('input[name=fecha2]').val();
	var centro =$("input[name='centro']:checked").val();
	var semana =$("input[name='semana']:checked").val();

	var V_FECHA = [];
	var V_CENTRO = [];
	var V_OFERTADO_MORBT = [];
	var V_LLAMADAS_MORBT_TELEFONICA = [];
	var V_AGENDADOS_MORBT_TELEFONICA = [];
	var V_CANCELADOS_MORBT_TELEFONICA = [];
	var V_AGOTADOS = [];
	
	var data = {
		evento:"todo",
		fecha1: fecha1,
		fecha2: fecha2,
		centro:centro,
		semana:semana
	};

	$.getJSON("../controlador/servidor/gdaDetalleLlamController.php",data, function(json) {
		var resultado = json;
		for(var aux = 0 in resultado){
			V_FECHA.push([resultado[aux].FECHAOFERTA]);
			V_CENTRO.push([resultado[aux].CENTRO]);
			V_OFERTADO_MORBT.push([parseInt(resultado[aux].OFERTADO_MORBT)]);
			V_LLAMADAS_MORBT_TELEFONICA.push([parseInt(resultado[aux].LLAMADAS_MORBT_TELEFONICA)]);
			V_AGENDADOS_MORBT_TELEFONICA.push([parseInt(resultado[aux].AGENDADOS_MORBT_TELEFONICA)]);
			V_CANCELADOS_MORBT_TELEFONICA.push([parseInt(resultado[aux].CANCELADOS_MORBT_TELEFONICA)]);
			V_AGOTADOS.push([parseInt(resultado[aux].AGOTADOS)]);
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
					x: -5,
					y: 30
				},
				relativeTo: 'chart'
			}  
		},

		title:{
			text:''
		},
		xAxis: {
			categories: []
		},
		subtitle: {
			text:  [],
				align: 'center',
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
			itemWidth: 200,
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
				id : 2,
				name: 'OFERTADOS',
				data: V_OFERTADO_MORBT,
				color: '#008000',
				stack: 'OFERTADO'
			},
			
			{ 
				id : 2,
				name: 'LLAMADAS ',
				data: V_LLAMADAS_MORBT_TELEFONICA,
				color: '#9400D3',
				stack: 'AGENDA'
			},
			{ 
				id : 2,
				name: 'AGENDADOS',
				data: V_AGENDADOS_MORBT_TELEFONICA,
				color: '#0000FF',
				stack: 'ASISTIO'
			},
			{ 
				id : 2,
				name: 'CANCELADOS',
				data: V_CANCELADOS_MORBT_TELEFONICA,
				color: '#CC0000',
				stack: 'BLOQUES'
			},
			{ 
				id : 2,
				name: 'AGOTADOS',
				data: V_AGOTADOS,
				color: '#00CED1',
				stack: 'AGOTADOS'
			}
		]
	}
}

	function showTable(){
		var fecha1 = $('input[name=fecha1]').val();
		var fecha2 = $('input[name=fecha2]').val();
		var centro =($("input[name='centro']:checked").val());
		var semana =($("input[name='semana']:checked").val());

		$('#tabla_resultados').empty();
		var tabla ="";
		var cabecera ="";

		var data = {
			evento:"table",
			fecha1: fecha1,
			fecha2: fecha2,
			centro:centro,
			semana:semana
		};

		$.getJSON("../controlador/servidor/gdaDetalleLlamController.php",data, function(response) {
			var resultado = response;

			$('#tabla_resultados').empty();

			if (resultado.data  === "0" || resultado == 0 || resultado == undefined || resultado == "undefined" ) {
				$('#tabla_resultados').append("<tr>"
				+"<td colspan = 12> No se han encontrado resultados..</td>"
				+"</tr>");
			}else{
				for(var aux = 0 in resultado){
					$('#tabla_resultados').append("<tr>"
					+"<td  style='font-size:13.2px !important;'>"+resultado[aux].FECHAOFERTA+"</td>"
					+"<td  style='font-size:13.2px !important;'>"+resultado[aux].CENTRO+"</td>"
					+"<td  style='font-size:13.2px !important;'>"+resultado[aux].OFERTADO_MORBT+"</td>"
					+"<td  style='font-size:13.2px !important;'>"+resultado[aux].LLAMADAS_MORBT_TELEFONICA+"</td>"
					+"<td  style='font-size:13.2px !important;'>"+resultado[aux].AGENDADOS_MORBT_TELEFONICA+"</td>"
					+"<td  style='font-size:13.2px !important;'>"+resultado[aux].CANCELADOS_MORBT_TELEFONICA+"</td>"
					+"<td  style='font-size:13.2px !important;'>"+resultado[aux].CANCELADOS_MORBT_MESON+"</td>"
					+"<td  style='font-size:13.2px !important;'>"+resultado[aux].CANCELADOS_MORBT_PERSONA+"</td>"
					+"<td  style='font-size:13.2px !important;'>"+resultado[aux].PRIMERA_HORA_AGOTADOS+"</td>"
					+"<td  style='font-size:13.2px !important;'>"+resultado[aux].NUMERO_AGOTADOS+"</td>"
					+"<td  style='font-size:13.2px !important;'>"+resultado[aux].AGOTADOS+"</td>"
					+"<td  style='font-size:13.2px !important;'>"+resultado[aux].TASA_AGOTADOS+"</td>"
					+"</tr>");
				}// end for
			}

		});
	}
