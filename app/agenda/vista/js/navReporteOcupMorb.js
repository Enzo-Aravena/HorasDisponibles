$( document ).ready(function() {
	$("#semana").empty();
	$("#mes").empty();
	//variables globales
	var cont =  52;
	var o = 1;
	var perMeses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Dciembre"];
	var weeks = '';
	var mesis = '';

	//carga lassemanas automaticamente
	weeks = weeks + '<option value="0">Seleccione Semana</option>';
	for (var i = 1; i <= cont ; i++) {
		weeks = weeks + '<option value='+i+'>Semana '+i+'</option>';
	}
	$("#semana").append(weeks);
	
	mesis = mesis + '<option value="0" >Selecciones Mes</option>';
	for (var aux in perMeses) {
		mesis = mesis + '<option value='+o+'>'+perMeses[aux]+'</option>';
		o++;
	}
	$("#mes").append(mesis);
});

	var meses = new Array ("01","02","03","04","05","06","07","08","09","10","11", "12");
	var fecha_actual_1 = new Date();
	var fecha_actual_7 = new Date();
	var diasrestados7 = 7;
	var diasrestados1 = 1;
	fecha_actual_7.setDate(fecha_actual_7.getDate() - diasrestados7);
	fecha_actual_1.setDate(fecha_actual_1.getDate() - diasrestados1);

window.onload=getReporte;
function getReporte(){
	window.parent.$("#loader").show();
	var fecha_ayer = fecha_actual_1.getDate() + "/" + meses[fecha_actual_1.getMonth()] + "/" + fecha_actual_1.getFullYear();
	var fecha_7_menos = fecha_actual_7.getDate() + "/" + meses[fecha_actual_7.getMonth()] + "/" + fecha_actual_7.getFullYear();
	var V_ID_FECHASEMANA = new Array();
	var V_CENTRO = new Array();
	var V_FECHA_INICIAL = new Array();
	var V_FECHA_FINAL = new Array();
	var V_TOTAL_MORBI_OFERTADO = new Array();
	var V_TOTAL_PRO_TEORICA_SEMANAL = new Array();

	var centro = $("input[name='centro']:checked").val();
	var semestre = $('select[name=semestre]').val();
	var semana = $('select[name=semana]').val();
	var mes = $('select[name=mes]').val();
	var anio= $('select[name=anio]').val();

	var aux_centro = obtenerCentro(centro);
	var idsemana1 = 0;
	var idsemana2 = 0;

	var data = {
		evento:"graficoOcupMorb",
		centro:centro,
		semestre:semestre,
		semana:semana,
		mes:mes,
		anio:anio
	};

    $.getJSON("../controlador/servidor/morbilidadController.php",data, function(json) {
    	var resultado = json;

    	for(var aux = 0 in resultado){

			V_ID_FECHASEMANA.push([resultado[aux].SEMANA_EPIDEMIOLOGICA]);
			V_CENTRO.push([resultado[aux].CENTRO]);
			V_FECHA_INICIAL.push([resultado[aux].FECHASEMANA_INICIAL]);
			V_FECHA_FINAL.push([resultado[aux].FECHASEMANA_FINAL]);
			V_TOTAL_PRO_TEORICA_SEMANAL.push([parseInt(resultado[aux].TOTAL_MORBI_OFERTADO)]);
			V_TOTAL_MORBI_OFERTADO.push([parseInt(resultado[aux].TOTAL_PROGRAMACION_TEORICA_SEMANAL)]);
		}

			if(centro==0) {
			options.xAxis.categories = V_CENTRO;

			}else{
			options.xAxis.categories = V_ID_FECHASEMANA;
			}

			if(semestre!=0 || mes!=0){
				if(semestre==1){
					idsemana1 = 1;
					idsemana2 = 26;
				}
				if(semestre==2){
					idsemana1 = 27;
					idsemana2 = 52;
				}

				switch(mes) {
					case '1':
					idsemana1 = 1;
					idsemana2 = 5;
					break;
					case '2':
					idsemana1 = 6;
					idsemana2 = 9;
					break;
					case '3':
					idsemana1 = 10;
					idsemana2 = 13;
					break;
					case '4':
					idsemana1 = 14;
					idsemana2 = 17;
					break;
					case '5':
					idsemana1 = 18;
					idsemana2 = 22;
					break;
					case '6':
					idsemana1 = 23;
					idsemana2 = 26;
					break;
					case '7':
					idsemana1 = 27;
					idsemana2 = 31;
					break;
					case '8':
					idsemana1 = 32;
					idsemana2 = 35;
					break;
					case '9':
					idsemana1 = 36;
					idsemana2 = 39;
					break;
					case '10':
					idsemana1 = 40;
					idsemana2 = 44;
					break;
					case '11':
					idsemana1 = 45;
					idsemana2 = 48;
					break;
					case '12':
					idsemana1 = 49;
					idsemana2 = 52;
					break;
				}
				
				options.subtitle.text = 'Semanas Epidemiologica '+idsemana1+' al ' +idsemana2+ ' desde '+V_FECHA_INICIAL[0]+' --> '+ V_FECHA_FINAL[0]+' --> '+aux_centro;
			}else{
				idsemana1 = semana;
				options.subtitle.text = 'Semana Epidemiologica '+idsemana1+ ' desde '+V_FECHA_INICIAL[0]+' --> '+ V_FECHA_FINAL[0]+' --> '+aux_centro;
			}
			chart = new Highcharts.Chart(options);
			
			mostrarTabla();
	});

	var options = {
			chart: {
				renderTo: 'contenedor',
				animation: {
					duration: 1500
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
				relativeTo: ''
				}
			},
			xAxis: {
				categories: []
			},
			title: {
	            text: []
	        },
			subtitle: {
				text:  [],
				align: 'center',
				y: 20,
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
				shared: true,
				valueSuffix: ''
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
			itemWidth: 500,
			align: 'center',
			verticalAlign: 'top',
			borderWidth: 0.5,
			backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
			shadow: true
	        },

			series:
			[
				{
					name: 'TOTAL PROGRAMACION TEORICA SEMANAL',
					data: V_TOTAL_PRO_TEORICA_SEMANAL	,
					color: {
					linearGradient : {
						x1: 0,
						y1: 0,
						x2: 0,
						y2: 1
					},
					stops : [
						[0, Highcharts.Color('#0066CC').setOpacity(1).get('rgba')],
						[1, Highcharts.Color('#66B2FF').setOpacity(1).get('rgba')],
					]
					},
					fillColor : {
						linearGradient : {
							x1: 0,
							y1: 0,
							x2: 0,
							y2: 1
						},
						stops : [
							[0, Highcharts.Color('#0066CC').setOpacity(0.5).get('rgba')],
							[1, Highcharts.Color('#66B2FF').setOpacity(0).get('rgba')],
						]
					}
				},
				{
					name: 'TOTAL MORBILIDAD OFERTADO',
					data: V_TOTAL_MORBI_OFERTADO,
					color: {
					linearGradient : {
							x1: 0,
							y1: 0,
							x2: 0,
							y2: 1
						},
						stops : [
							[0, Highcharts.Color('#6600CC').setOpacity(1).get('rgba')],
							[1, Highcharts.Color('#B266FF').setOpacity(1).get('rgba')],
						]
					},
					fillColor : {
						linearGradient : {
							x1: 0,
							y1: 0,
							x2: 0,
							y2: 1
						},
						stops : [
							[0, Highcharts.Color('#6600CC').setOpacity(0.5).get('rgba')],
							[1, Highcharts.Color('#B266FF').setOpacity(0).get('rgba')],
						]
					}
				}
			]
	} // FIN GRAFICO
}// fin funcion 


function obtenerCentro(centro) {
	switch (centro) { 
	   	case '1': 
	      	nombre = 'CAROL URZUA';
	    break ;
	   	case '2': 
	      	nombre = 'LA FAENA';
	    break ;
	   	case '3': ;
	      	nombre = 'SAN LUIS';
	    break ;
	   	case '4': 
	      	nombre = 'LO HERMINDA';
	    break ;
	   	case '5': 
	      	nombre = 'CARDENAL SILVA.H';
	    break ;
	   	case '12': 
	      	nombre = 'PADRE GERARDO.W';
	    break ;

	   	default: 
	      	nombre = 'TOTAL CENTROS';
		break;
	}
	return  nombre;
}


function mostrarTabla(){
	$("#tabla_ocupacion").empty();
	var centro = $("input[name='centro']:checked").val();
	var semestre = $('select[name=semestre]').val();
	var semana = $('select[name=semana]').val();
	var mes = $('select[name=mes]').val();
	var anio= $('select[name=anio]').val();

	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var resultado = JSON.parse(xmlhttp.responseText);

			$("#tabla_ocupacion").empty();

			if (resultado.data  === "0" || resultado == 0 || resultado == undefined || resultado == "undefined" ) {
				tabla = tabla +"<tr>";
				tabla = tabla +"<th>CENTRO</th>";
				tabla = tabla +"<th>MORBILIDAD <br>TELEFONICA OFERTADO</th>";
				tabla = tabla +"<th>MORBILIDAD <br>SOME OFERTADO</th>";
				tabla = tabla +"<th>TOTAL PROGRAMACION <br>TEORICA SEMANAL</th>";
				tabla = tabla +"<th>TOTAL MORBILIDAD <br>OFERTADO</th>";
				tabla = tabla +"<th colspan='2'>DELTA <br>(Respecto de Programacion)</th>";
				tabla = tabla +"<th>MORBILIDAD <br>EFECTIVA</th>";
				tabla = tabla +"<th colspan='2'>DELTA <br>(Respecto de Programacion)</th>";
				tabla = tabla +"</tr>";

				for(var aux in resultado){
					tabla = tabla + "<tr>";
					tabla = tabla + "<td colspan=10> No se han encontrado resultados asociados a la busqueda.</td>";
					tabla = tabla + "</tr>";
				}

				window.parent.$("#loader").hide();

			}else{
				var tabla = "";

				tabla = tabla +"<tr>";
				tabla = tabla +"<th>CENTRO</th>";
				tabla = tabla +"<th>MORBILIDAD <br>TELEFONICA OFERTADO</th>";
				tabla = tabla +"<th>MORBILIDAD <br>SOME OFERTADO</th>";
				tabla = tabla +"<th>TOTAL PROGRAMACION <br>TEORICA SEMANAL</th>";
				tabla = tabla +"<th>TOTAL MORBILIDAD <br>OFERTADO</th>";
				tabla = tabla +"<th colspan='2'>DELTA <br>(Respecto de Programacion)</th>";
				tabla = tabla +"<th>MORBILIDAD <br>EFECTIVA</th>";
				tabla = tabla +"<th colspan='2'>DELTA <br>(Respecto de Programacion)</th>";
				tabla = tabla +"</tr>";

				for(var aux in resultado){
					tabla = tabla + "<tr>";
					tabla = tabla + "<td >" + resultado[aux].CENTRO+"</td>";
					tabla = tabla + "<td >" + resultado[aux].MORBI_TELEFONICA_OFERTADO+"</td>";
					tabla = tabla + "<td >" + resultado[aux].MORBI_SOME_OFERTADO+"</td>";
					tabla = tabla + "<td >" + resultado[aux].TOTAL_PROGRAMACION_TEORICA_SEMANAL+"</td>";
					tabla = tabla + "<td >" + resultado[aux].TOTAL_MORBI_OFERTADO+"</td>";
					tabla = tabla + "<td >" + resultado[aux].DELTA_RESPECTO_DE_PROGRAMACION_A_N+"</td>";
					tabla = tabla + "<td >" + resultado[aux].DELTA_RESPECTO_DE_PROGRAMACION_A_P+"%</td>";
					tabla = tabla + "<td >" + resultado[aux].MORBI_EFECTIVA+"</td>";
					tabla = tabla + "<td >" + resultado[aux].DELTA_RESPECTO_DE_PROGRAMACION_B_N+"</td>";
					tabla = tabla + "<td >" + resultado[aux].DELTA_RESPECTO_DE_PROGRAMACION_B_P+"%</td>";
					tabla = tabla + "</tr>";
				}

				window.parent.$("#loader").hide();
			}			

			$("#tabla_ocupacion").append(tabla);
			
		}
		else{
			console.log("Error ..");
		}
	}
	xmlhttp.open("GET","../controlador/servidor/morbilidadController.php?evento=tablaOcupMorb"+"&centro="+centro+"&semestre="+semestre+"&semana="+semana+"&mes="+mes+"&anio="+anio,true);
	xmlhttp.send();
}