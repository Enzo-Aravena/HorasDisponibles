/***********************  FUNCION PARA AGENDADOS MORBILIDAD MENSUAL  **********************/

window.onload=enviarAgendMorbMensual;
function enviarAgendMorbMensual(){

	$("#loader").show();
	
	var V_AGENDADOS_MORBT = new Array();
	var V_AGENDADOS_MORBI = new Array();
	var V_AGENDADOS_TOTAL = new Array();
	var dataSum = 0;
	var x = 0;
	var i = 0;
	var z = 0;
	var centro_aux = $('select[name=anio]').text();
	var anno_aux = $('select[name=centro]').text();


	var anio = $('select[name=anio]').val();
	var centro = $('select[name=centro]').val();


	var data = {
		evento:"graficoMensual",
		anio: anio,
		centro: centro
	};

	$.getJSON("../controlador/servidor/morbilidadController.php",data, function(json) {	
		var resultado = json;	

		for(var aux = 0 in resultado){
				V_AGENDADOS_MORBT.push(parseInt([resultado[aux].AGENDADOS_MORBT]));
				V_AGENDADOS_MORBI.push(parseInt([resultado[aux].AGENDADOS_MORBI]));
				V_AGENDADOS_TOTAL.push([parseInt(resultado[aux].AGENDADOS_FINAL)]);
		}

		$('#contenido').highcharts({
	        chart: {
	            zoomType: 'xy'
	        },
	        title: {
	            text: ''
	        },
	        subtitle: {
	            text:  '',
				 align: 'center',
	            y: 45,
				 style: {
					fontSize: '12px',
	                color: '#cc0066',
	                fontWeight: 'bold'
	            }
	        },
	        xAxis: [{
	            categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
	                'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
	            crosshair: true
	        }],
			 exporting: {
	           	enabled:false
	        },
	        yAxis: [{
			 gridLineWidth: 0,
	            title: {
	                text: '',
	            },
	            labels: {
	                format: '{value}',
	                style: {
	                    color: Highcharts.getOptions().colors[8]
	                }
	            },
	        }],
	        tooltip: {
	            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y:.0f}</b><br/>',
	            shared: true,
				
	        },
		    legend: {
				itemStyle: {
					  fontSize: '0.92em',
	          	},
				itemHoverStyle: {
	            	color: '#0000FF'
	            },
				itemWidth: 245,
	            align: 'center',
	            verticalAlign: 'top',
	            borderWidth: 0.5,
	            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
	            shadow: true
	        },
			tooltip: {
	            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y:.0f}</b><br/>',
	            shared: true
	        },
			plotOptions: {
	        series: {
	            shadow:false,
	            borderWidth:0,
	            dataLabels:{
	            enabled:true,
	            formatter:function() {
					if(i < V_AGENDADOS_TOTAL.length) {
							dataSum = 0;
	    					dataSum += V_AGENDADOS_MORBT[i];
							dataSum += V_AGENDADOS_MORBI[i];
							i+=1
							var pcnt = (this.y / dataSum) * 100;
							return Highcharts.numberFormat(pcnt) + '%';					 
					}else if (x < V_AGENDADOS_TOTAL.length){
	    					dataSum = V_AGENDADOS_TOTAL[x]
							var pcnt = (this.y / dataSum) * 100;
							x+=1
							return Highcharts.numberFormat(pcnt) + '%';		
					}else if (z < V_AGENDADOS_TOTAL.length){
	    					dataSum = V_AGENDADOS_TOTAL[z];
							var pcnt = (this.y / dataSum) * 100;
							z+=1
							return Highcharts.numberFormat(pcnt) + '%';			 
						 }
	                }
	            }
	        }
	    	},
	        series: [{
	            name: 'AGENDADOS TOTAL',
	            type: 'column',
	            data: V_AGENDADOS_TOTAL,
				color: '#A0A0A0',
	            tooltip: {
	                valueSuffix: ''
	            }

	        }, {
	            name: 'MORBILIDAD TELEFONICA',
	            type: 'spline',
	            data: V_AGENDADOS_MORBT,
				color: '#006600',
	            dashStyle: 'shortdot',
	            tooltip: {
	                valueSuffix: ''
	            }

	        }, {
	            name: 'MEDICO MORBILIDAD',
	            type: 'spline',
	            data: V_AGENDADOS_MORBI,
				color: '#0000ff',			
				dashStyle: 'shortdot',
	            tooltip: {
	                valueSuffix: ''
	            }
	        }]
	    });
	});
			
		mostrarTablaMensual();		
};
	
function mostrarTablaMensual() {	
	   	 $("#txtHint").empty();
		 var anio = $('select[name=anio]').val();
		  
       if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
               $("#loader").hide();
            }
        }
      xmlhttp.open("GET","../controlador/servidor/morbilidadController.php?evento=tablaMensual"+"&anio="+anio,true);
        xmlhttp.send();
}	