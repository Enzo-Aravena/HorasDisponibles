$( document ).ready(function() {

	if (screen.width == 1366) {
		$("#graficos").css({"width": "20%"});
	}else{
		$("#graficos").css({"width": ""});
	}


	$("#manual").hide();
	$('#fecha1').datepicker();
    $('#fecha2').datepicker();
	obtenerSemanaEpidemiologica();
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


	$("#ExportarData").on("click",function(){

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

	//ABRIR POPUP
	$("#Informacion").on("click", function(){
		$('#manual').fadeIn('slow');		
		$('.popup-overlay').fadeIn('slow');
		$('.popup-overlay').height($(window).height());
		return false;
	});

	// CERRAR POPUP
	$('#close').click(function(){
		$('#manual').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

	// EVENTO ESCAPE
	$(document).on('keyup',function(evt) {
	    if (evt.keyCode == 27) {
	    $('#manual').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	    }
	});

	// CERRAR POPUP  
	$('#CerrarModal').click(function(){
		$('#manual').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});


	$("#Buscar").on("click",function(){
		var fecha1 = $('input[name=fecha1]').val();
		var fecha2 = $('input[name=fecha2]').val();
		var resultado = validate_fechaMayorQue(fecha1,fecha2);

		if (resultado ===  true) {
			if (fecha1 !== "" && fecha2 ==="") {
				actualizar_tabla();	
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
				actualizar_tabla();	
			}
		}
	});


	$("#visualizar_dia").on("click",function(){
		enviarDatosFormulario();
	});

});

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
	var url= "../controlador/servidor/controladorCampana.php";
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
				$('#semana').empty();

				$("#semana").append('<option value=0 selected="selected">______Total Acumulado 2019______</option>');

				for(var aux = 0 in resultado ){
					$("#semana").append("<option value = " +resultado[aux].SEMANA_EPI+">"+resultado[aux].SEMANA+ " - " + resultado[aux].SEMANA_I+" - "+ resultado[aux].SEMANA_F +"</option>");
				}
				
				enviarDatosFormulario();

			}, // End success
			error:function(error){			
				console.log("Error en la peticion");
			} // End error
		});//End ajax
}


function enviarDatosFormulario(){
	//window.parent.$("#loader").show();
	var V_SEMANA = new Array();
	var V_CENTRO = new Array();
	var V_TOTAL_CESFAM = new Array();
	var V_TOTAL_SR = new Array();
	var V_TOTAL_CESFAM_AA = new Array();
	var V_TOTAL_SR_AA = new Array();

	var FECHA = new Array();
	var FECHA_FINAL_EPI = new Array();
	var dia = $("input[name='visualizar_dia']:checked").val();

	if(dia !== undefined){
		dia = 1;
	}else{
		dia = 0;
	}

	var centro = ($("input[name='centro']:checked").val());
	var aux_centro =  obtener_centro($("input[name='centro']:checked").val());
	var sem = $('select[name=semana]').val();
	if(sem == null){
		var semana = 0;
	}
	else{
		var semana = $('#semana').val().toString();
	}

	var Semanas= $('select[name=semana]').val();
	 if (Semanas[0] === "0") {
		$("#visualizador").hide();
	}
	else{
		$("#visualizador").show();
	}

	var data = {
		evento:"mostrarGrafico",
		centro: centro,
		semana: semana,
		dia:dia
	};

	$.getJSON("../controlador/servidor/controladorCampana.php",data, function(json) {
		var resultado = json;

		for(var aux = 0 in resultado ){
			V_SEMANA.push([resultado[aux].SEMANA]);
			V_CENTRO.push([resultado[aux].CENTRO]);
			V_TOTAL_CESFAM.push(parseInt([resultado[aux].TOTAL_CESFAM]));
			V_TOTAL_SR.push(parseInt([resultado[aux].TOTAL_SR]));
			V_TOTAL_CESFAM_AA.push(parseInt([resultado[aux].TOTAL_CESFAM_AA]));
			V_TOTAL_SR_AA.push(parseInt([resultado[aux].TOTAL_SR_AA]));
		}

		options.xAxis.categories = V_SEMANA;

		var dato = {
			evento:"semana",
			semana: semana
		};
			
		$.getJSON("../controlador/servidor/controladorCampana.php",dato, function(json) {
			var resultado = json;

			for(var aux = 0 in resultado ){
				FECHA.push([resultado[aux].FECHA]);
				FECHA_FINAL_EPI.push([resultado[aux].FECHA_FINAL_EPI]);
			}

			if(semana==0){ 
				options.subtitle.text = 'Total Acumulado Semanas Epidemiologica '+ aux_centro;
			}else{
				options.subtitle.text ='Semanas Epidemiologica Entre '+FECHA+" * "+FECHA_FINAL_EPI+'  -> '+ aux_centro;
			}
			
			chart = new Highcharts.Chart(options);
			mostrar_tabla();

		
		});

	});  // FIN GET PRINCIPAL

   	var options = {
		chart: {
			renderTo: 'contenido',
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
		title:{
        text:''
    	},
		xAxis: {
			categories: []
		},
		subtitle: {
			text:  '',
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
					if(xx < 2){
						s += '<br/><span style="color:'+ point.series.color +'">\u25CF</span>'+ point.series.name +':'+point.y +'<span style="color:Red">('+Highcharts.numberFormat(((V_aa[xx]/point.y)*100),1)+'%)';
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
				fontSize: '0.92em'
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
		series: [
			{ 
				id :2,		
				name: 'Total Atenciones del CESFAM (contiene las respiratorias) 2018',
				data: V_TOTAL_CESFAM_AA,
				color: {
					linearGradient : {
						x1: 0,
						y1: 0,
						x2: 0,
						y2: 1
					},
					stops : [
						[0, Highcharts.Color('#0099CC').setOpacity(1).get('rgba')],
						[1, Highcharts.Color('#B2FF66').setOpacity(1).get('rgba')],
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
						[0, Highcharts.Color('#0099CC').setOpacity(0.5).get('rgba')],
						[1, Highcharts.Color('#B2FF66').setOpacity(0).get('rgba')],
					]
				}
        	},
			{
			 	id :1,	
				name: 'Total Atenciones del CESFAM (contiene las respiratorias) 2019',
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
				id :2,
				name: 'Total Atenciones por causa Sistema Respiratorio 2018',
				data: V_TOTAL_SR_AA,
				color: {
					linearGradient : {
						x1: 0,
						y1: 0,
						x2: 0,
						y2: 1
					},
					stops : [
						[0, Highcharts.Color('#CC0000').setOpacity(1).get('rgba')],
						[1, Highcharts.Color('#FF9999').setOpacity(1).get('rgba')],
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
						[0, Highcharts.Color('#CC0000').setOpacity(0.5).get('rgba')],
						[1, Highcharts.Color('#FF9999').setOpacity(0).get('rgba')],
					]
				}
        	},
        	{
				id :1,
				name: 'Total Atenciones por causa Sistema Respiratorio 2019',
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
		] // END SERIES
	}
}


function obtener_centro(centro) {
	var result
	switch (centro) { 
	   	case '1': 
	      	result = 'CAROL URZUA'
	      	break 
	   	case '2': 
	      	result = 'LA FAENA'
	      	break 
	   	case '3': 
	      	result = 'SAN LUIS'
	      	break 
	   	case '4': 
	      	result = 'LO HERMIDA'
	      	break 
	   	case '5': 
	      	result = 'CARDENAL SILVA.H'
	      	break 
	   	case '12': 
	      	result = 'PADRE GERARDO.W'
	      	break 

	   	default: 
	      	result = 'TOTAL CENTROS'
			
	}
	return  result
}		


function mostrar_tabla() {
		
	var centro =($("input[name='centro']:checked").val());
	var sem = $('#semana').val();
	if(sem == null){
		var semana = 0
	}
	else{
		var semana = $('#semana').val().toString();
	}

	if (window.XMLHttpRequest) {
           xmlhttp = new XMLHttpRequest();
    } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	        // var resultado  = JSON.parse(xmlhttp.responseText);
            document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
        }
     //   window.parent.$("#loader").hide();
    }
    xmlhttp.open("GET","../controlador/servidor/controladorCampana.php?evento=cargarTabla&centro="+centro+"&semana="+semana,true);
    xmlhttp.send();
}

function actualizar_tabla() {
	var fecha1 = $('input[name=fecha1]').val();
	var fecha2 = $('input[name=fecha2]').val();
	var centro = $("input[name='centro']:checked").val();
	if(fecha1){
		if(!fecha2){
			fecha2=fecha1;
		}
	}else{
		fecha1=0;
		fecha2=0;
	}

	if (window.XMLHttpRequest) {
	    xmlhttp = new XMLHttpRequest();
	} else {
	    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;

		}
	}
	xmlhttp.open("GET","../controlador/servidor/controladorCampana.php?evento=ActualizarTabla&fecha1="+fecha1+"&fecha2="+fecha2+"&centro="+centro,true);
	xmlhttp.send();
}
