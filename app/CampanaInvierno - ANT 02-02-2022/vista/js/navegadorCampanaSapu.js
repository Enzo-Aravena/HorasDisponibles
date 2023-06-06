$( document ).ready(function() {

	if (screen.width == 1366) {
		$("#graficos").css({"width": "20%"});
	}


	obtenerSemanaEpidemiologica();
	$('#fecha1').datepicker();  
    $('#fecha2').datepicker();	
	$("#MostrarFormulario").hide();
	$("#visualizador").hide();
	$("#MostrarGrafico").hide();
	$("#MostrarTabla").hide();

//--------------  FORMULARIO INICIAL  ----------------------
	$('#OcultarFormulario').on("click",function(){		
		$("#OcultarFormulario").hide();
		$("#MostrarFormulario").show();
		$("#miFormulario").hide();
	});

	$('#MostrarFormulario').on("click",function(){
		$("#MostrarFormulario").hide();
		$("#OcultarFormulario").show();
		$("#miFormulario").show();
	});

//--------------  GRAFICO ----------------------

	$('#OcultarGrafico').on("click",function(){		
		$("#OcultarGrafico").hide();
		$("#MostrarGrafico").show();
		$("#graficos").hide();
	});

	$('#MostrarGrafico').on("click",function(){
		$("#MostrarGrafico").hide();
		$("#OcultarGrafico").show();
		$("#graficos").show();
	});


 //--------------  TABLA ----------------------
	$('#OcultarTabla').on("click",function(){		
		$("#OcultarTabla").hide();
		$("#MostrarTabla").show();
		$("#txtHint").hide();
		$("#formulariosTabla").hide();
	});

	$('#MostrarTabla').on("click",function(){
		$("#MostrarTabla").hide();
		$("#OcultarTabla").show();
		$("#txtHint").show();
		$("#formulariosTabla").show();
	});

	$("#Buscar").on("click",function(){
		var fecha1 = $('input[name=fecha1]').val();
		var fecha2 = $('input[name=fecha2]').val();
		if (fecha1 !== "") {
			if (fecha1 !== "" && fecha2 !== "" ) {	actualizar_tabla();	}else{	actualizar_tabla();	}
		}else{
			if (fecha2 !== "" && fecha1 === "") {	alert("No se puede buscar un rango sin la fecha inicial");	}
		}
	});

	//*****************************************************************
	$("#ExportarData").on("click",function(){
		$("#mensaje").empty();
	    var texto = "<h3> Descargando Archivo..  </h3>";
	    $("#mensaje").append(texto);
	    $("#myModal").modal();
		setTimeout(cuentaAtras, 1000);
		var fecha1 = $('input[name=fecha1]').val();
		var fecha2 = $('input[name=fecha2]').val();
		var centro = $("input[name='centro']:checked").val();
		var semana = $('select[name=semanas]').val();
		window.location = "../controlador/servidor/reporteExcelSapu.php?fecha1="+fecha1+"&fecha2="+fecha2+"&centro="+centro+"&semana="+semana;
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

function obtenerSemanaEpidemiologica(){
	var resultado= null;
	var url= "../controlador/servidor/controladorCampanaSapu.php";
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
				$('#semanas').empty();
				$("#semanas").append('<option value=0 selected="selected">______Total Acumulado 2019______</option>');
				for(var aux = 0 in resultado ){
					$("#semanas").append("<option value = " +resultado[aux].SEMANA_EPI+">"+resultado[aux].SEMANA+ " - " + resultado[aux].SEMANA_I+" - "+ resultado[aux].SEMANA_F +"</option>");
				}				
				camInvSapu();
			}, // End success
			error:function(error){			
				console.log("Error en la peticion");
			} // End error
		});//End ajax
}

function camInvSapu(){
	$("#loader").show();
	var V_SEMANAS = new Array();
	var V_CENTRO = new Array();
	var V_TOTAL_CESFAM = new Array();
	var V_TOTAL_SR = new Array();
	var V_TOTAL_CESFA_AA = new Array();
	var V_TOTAL_SR_AA = new Array();
	var FECHA = new Array();
	var FECHA_FINAL_EPI = new Array();
	var dia = $('input[name=visualizar_dia]').prop('checked'); 
	if(dia === true){	dia = 1;	}else{	dia = 0;	}
	var centro = ($("input[name='centro']:checked").val());
	var aux_centro =  obtener_centro($("input[name='centro']:checked").val());
	var sem = $('select[name=semanas]').val();
	if(sem == null){	var semana = 0;	}else{	var semana = $('#semanas').val().toString();	}
	var semanitas= $('select[name=semanas]').val();
	if (semanitas === null || semanitas[0] === "0") {	$("#visualizador").hide();	}else{	$("#visualizador").show();	}

	var data = {
		evento:"mostrarGrafico",
		centro: centro,
		semana: semana,
		dia:dia
	};

	$.getJSON("../controlador/servidor/controladorCampanaSapu.php",data, function(json) {
		var resultado = json;
		for(var aux = 0 in resultado ){
			V_SEMANAS.push([resultado[aux].SEMANA]);
			V_CENTRO.push([resultado[aux].CENTRO]);
			V_TOTAL_CESFAM.push(parseInt([resultado[aux].TOTAL_CESFAM]));
			V_TOTAL_SR.push(parseInt([resultado[aux].TOTAL_SR]));
			V_TOTAL_CESFA_AA.push(parseInt([resultado[aux].TOTAL_CESFAM_AA]));
			V_TOTAL_SR_AA.push(parseInt([resultado[aux].TOTAL_SR_AA]));
		}

		options.xAxis.categories = V_SEMANAS;

		var dato = {
			evento:"semana",
			semana: semana
		};
			
		$.getJSON("../controlador/servidor/controladorCampanaSapu.php",dato, function(json) {
			var resultado = json;
			for(var aux = 0 in resultado ){
				FECHA.push([resultado[aux].FECHA]);
				FECHA_FINAL_EPI.push([resultado[aux].FECHA_FINAL_EPI]);
			}

			if(semana==0){ 
				options.title.text = 'Total Acumulado Semanas Epidemiologica '+ aux_centro;
			}else{
				options.title.text ='Semanas Epidemiologica Entre '+FECHA+" * "+FECHA_FINAL_EPI+'  -> '+ aux_centro;
			}
			
			chart = new Highcharts.Chart(options);
			mostrar_tabla();
			visualizar_dia.onclick = function() {
				camInvSapu();
			}
		});

	});  // FIN GET PRINCIPAL


	var options = {
			chart: {
				renderTo: 'container',
				animation: {
					duration: 1500
				},
				type: 'areaspline',
				marginRight: 30,
				marginBottom: 80,
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
			xAxis: {
				categories: []
			},
			title: {
				text: [],
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
				valueDecimals: 2,
				formatter: function() {
					var s = '<b>'+ this.x +'</b>';
					var x =0;
					var xx =0;
					var V_aa = new Array();

					$.each(this.points, function(i, point) {
						if(x>=2){
							V_aa.push(point.y);
						}
						x++;
					});

					$.each(this.points, function(i, point) {
						var tempcolor = point.series.color;
						if(xx < 2){
							s += '<br/>'+ '<span style="color:'+ tempcolor+'">'+ point.series.name +': '+point.y +' ';
						}else{
							s +='<br/><span style="color:'+ point.series.color +'">\u25CF</span> ' + point.series.name +': '+point.y;
						}
						xx++;
					});
					return s;
				},
				shared: true
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
						id :1,	
						name: 'Total Protocolos Aplicados 2019',
						data: V_TOTAL_CESFAM,
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
						id :1,		
						name: 'Total Diagnosticos Agrupados de 1 al 6 2019',
						data: V_TOTAL_SR,
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
	}
}


function obtener_centro(centro) {
	var result
	switch (centro) { 
		case '8': result = 'SAPU CAROL URZUA';	break; 
		case '9': result = 'SAPU LA FAENA';	break; 
		case '11': result = 'SAPU SAN LUIS';	break; 
		case '10': result = ' SAPU LO HERMIDA';	break;
	   	default: result = 'TOTAL CENTROS';	break;
	}
	return  result
}

function mostrar_tabla() {
	var centro =($("input[name='centro']:checked").val());
	var sem = $('#semanas').val();
	if(sem == null){	var semana = 0;	}else{	var semana = $('#semanas').val().toString();}
	if (window.XMLHttpRequest) {xmlhttp = new XMLHttpRequest();} else { xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");	}
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
           	document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
        }
        $("#loader").hide();
    }
    xmlhttp.open("GET","../controlador/servidor/controladorCampanaSapu.php?evento=cargarTabla&centro="+centro+"&semana="+semana,true);
    xmlhttp.send();
}



function actualizar_tabla() {
	var fecha1 = $('input[name=fecha1]').val();
	var fecha2 = $('input[name=fecha2]').val();
	var centro = $("input[name='centro']:checked").val();
	if(fecha1){
		if(!fecha2){fecha2=fecha1;}
	}else{
		fecha1=0;
		fecha2=0;
	}

	if (window.XMLHttpRequest) {  xmlhttp = new XMLHttpRequest();} else {  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
		}
		$("#loader").hide();
	}
	xmlhttp.open("GET","../controlador/servidor/controladorCampanaSapu.php?evento=ActualizarTabla&fecha1="+fecha1+"&fecha2="+fecha2+"&centro="+centro,true);
	xmlhttp.send();
}
