function MostrarGrafico(CENTRO,OFERTADO_MORBT,AGENDADOS_FINAL_MORBT,AGENDADOS_CONFIRMADO_MORBT,BLOQUES_NO_AGENDADOS_MORBT,OFERTADO_MORBI,AGENDADOS_MORBI,AGENDADOS_CONFIRMADO_MORBI,BLOQUES_NO_AGENDADOS_MORBI){

	Highcharts.chart('contenido', {

			    chart: {
			        type: 'column'
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

			    title: {
			        text: 'Ocupación Morbilidad Diaria'
			    },
			    subtitle: {
				        text: 'Total Semana Actual'
				},
			    xAxis: {
			        categories: CENTRO 
			    },

			    yAxis: {
			        allowDecimals: false,
			        min: 0,
			        title: {
			            text: ''
			        }
			    },

			    tooltip: {
			        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
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
                    data: OFERTADO_MORBI,
					color: '#32CD32',
					stack: 'OFERTADO'
				
				},
				{ 
					id : 1,
		 			name: 'MORBI AGENDADO',
                    data: AGENDADOS_MORBI,
					color: '#BA55D3',
					stack: 'AGENDA'
				},
				{ 
					id : 1,
		 			name: 'MORBI AGENDA CONFIRMADA',
                    data: AGENDADOS_CONFIRMADO_MORBI,
					color: '#4169E1',
					stack: 'ASISTIO'
				},
				{ 
					id : 1,
		 			name: 'MORBI AGENDA DISPONIBLE',
                    data: BLOQUES_NO_AGENDADOS_MORBI,
					color: '#FF3333',
					stack: 'BLOQUES'
				},
				{ 
					id : 2,
		 			name: 'MORBT OFERTADO ',
                    data: OFERTADO_MORBT,
					color: '#008000',
					stack: 'OFERTADO'
				},
				
				{ 
					id : 2,
		 			name: 'MORBT AGENDADO ',
                    data: AGENDADOS_FINAL_MORBT,
					color: '#9400D3',
					stack: 'AGENDA'
				},
				{ 
					id : 2,
		 			name: 'MORBT AGENDA CONFIRMADA ',
                    data: AGENDADOS_CONFIRMADO_MORBT,
					color: '#0000FF',
					stack: 'ASISTIO'
				},
				{ 
					id : 2,
		 			name: 'MORBT AGENDA DISPONIBLE ',
                    data: BLOQUES_NO_AGENDADOS_MORBT,
					color: '#CC0000',
					stack: 'BLOQUES'
				}]
	});


	function a(x) {
    // The following condition 
    // is the base case.
	    if ( ! x) {
	        return;
	    }
	    a(--x);
	}

		var chart = $('#contenido').highcharts(),
			    show = false;
		

		var aux = $('input[name=morbt]').prop('checked');
		if(aux == false ){
	    	elemId =1;
			$.each(chart.series, function (k, v) {
            console.log(v)
			if(v.options.id == elemId) {
	            chart.series[k].hide();
            }
			 	});
		} else {
			elemId =1;
			$.each(chart.series, function (k, v) {
            console.log(v)
				if(v.options.id == elemId) {
	               chart.series[k].show();
            	}
		 	});
		}


			/*    var $button = $('#button');
				$button.click(function () {
				    var series = chart.series[0];
				    if (series.visible) {
				        series.hide();
				        $button.html('Show series');
				    } else {
				        series.show();
				        $button.html('Hide series');
				    }
				});*/




				/*$('#acto_morbt').click(function () {
					var series = chart.series[0];
					/*var serie1 = chart.series[1];
					var serie2 = chart.series[2];
					var serie3 = chart.series[3];*/

				/*	 if (series.visible) {
						series.hide();
					/*	serie1.hide();
						serie2.hide();
						serie3.hide();*/
				/*	 }else{
					 	series.show();
					/*	serie1.show();
						serie2.show();
						serie3.show();*/
					// }


			/*	});*/


				/*    $('#acto_morbt').click(function () {



						var aux = $('input[name=morbt]').prop('checked');
						if(aux == false ){
				     		elemId =1;   		
							$.each(chart.series, function (k, v) {
							   if(v.options.id == elemId) {
							   		chart.series[k].hide();
							   		return false;							   	
				            	  }
						 	});
							 X= i;
							   a(X);


						} else {
							elemId =1;
							$.each(chart.series, function (k, v) {
							   if(v.options.id == elemId) {
					               chart.series[k].show();
				            	  }
					 		});
							X= elemId;
							  a(X);
						}
			});*/


	
		

} 

function MostrarGraficos(CENTRO,OFERTADO_MORBT,AGENDADOS_FINAL_MORBT,AGENDADOS_CONFIRMADO_MORBT,BLOQUES_NO_AGENDADOS_MORBT,OFERTADO_MORBI,AGENDADOS_MORBI,AGENDADOS_CONFIRMADO_MORBI,BLOQUES_NO_AGENDADOS_MORBI,FECHAOFERTA){

	Highcharts.chart('contenido', {

			    chart: {
			        type: 'column'
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

			    title: {
			        text: 'Ocupación Morbilidad Diaria'
			    },
			    subtitle: {
				        text: 'Total Semana Actual'
				},
			    xAxis: {
			        categories: FECHAOFERTA 
			    },

			    yAxis: {
			        allowDecimals: false,
			        min: 0,
			        title: {
			            text: ''
			        }
			    },

			    tooltip: {
			        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
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
                    data: OFERTADO_MORBI,
					color: '#32CD32',
					stack: 'OFERTADO'
				
				},
				{ 
					id : 1,
		 			name: 'MORBI AGENDADO',
                    data: AGENDADOS_MORBI,
					color: '#BA55D3',
					stack: 'AGENDA'
				},
				{ 
					id : 1,
		 			name: 'MORBI AGENDA CONFIRMADA',
                    data: AGENDADOS_CONFIRMADO_MORBI,
					color: '#4169E1',
					stack: 'ASISTIO'
				},
				{ 
					id : 1,
		 			name: 'MORBI AGENDA DISPONIBLE',
                    data: BLOQUES_NO_AGENDADOS_MORBI,
					color: '#FF3333',
					stack: 'BLOQUES'
				},
				{ 
					id : 2,
		 			name: 'MORBT OFERTADO ',
                    data: OFERTADO_MORBT,
					color: '#008000',
					stack: 'OFERTADO'
				},
				
				{ 
					id : 2,
		 			name: 'MORBT AGENDADO',
                    data: AGENDADOS_FINAL_MORBT,
					color: '#9400D3',
					stack: 'AGENDA'
				},
				{ 
					id : 2,
		 			name: 'MORBT AGENDA CONFIRMADA',
                    data: AGENDADOS_CONFIRMADO_MORBT,
					color: '#0000FF',
					stack: 'ASISTIO'
				},
				{ 
					id : 2,
		 			name: 'MORBT AGENDA DISPONIBLE ',
                    data: BLOQUES_NO_AGENDADOS_MORBT,
					color: '#CC0000',
					stack: 'BLOQUES'
				}]
	});
} 


function MostrarGraficosFecha(CENTRO,OFERTADO_MORBT,AGENDADOS_FINAL_MORBT,AGENDADOS_CONFIRMADO_MORBT,BLOQUES_NO_AGENDADOS_MORBT,OFERTADO_MORBI,AGENDADOS_MORBI,AGENDADOS_CONFIRMADO_MORBI,BLOQUES_NO_AGENDADOS_MORBI,FECHAOFERTA, desde){

	Highcharts.chart('contenido', {

			    chart: {
			        type: 'column'
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

			    title: {
			        text: 'Ocupación Morbilidad Diaria'
			    },
			    subtitle: {
				        text: desde
				},
			    xAxis: {
			        categories: FECHAOFERTA 
			    },

			    yAxis: {
			        allowDecimals: false,
			        min: 0,
			        title: {
			            text: ''
			        }
			    },

			    tooltip: {
			        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
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
                    data: OFERTADO_MORBI,
					color: '#32CD32',
					stack: 'OFERTADO'
				
				},
				{ 
					id : 1,
		 			name: 'MORBI AGENDADO',
                    data: AGENDADOS_MORBI,
					color: '#BA55D3',
					stack: 'AGENDA'
				},
				{ 
					id : 1,
		 			name: 'MORBI AGENDA CONFIRMADA',
                    data: AGENDADOS_CONFIRMADO_MORBI,
					color: '#4169E1',
					stack: 'ASISTIO'
				},
				{ 
					id : 1,
		 			name: 'MORBI AGENDA DISPONIBLE',
                    data: BLOQUES_NO_AGENDADOS_MORBI,
					color: '#FF3333',
					stack: 'BLOQUES'
				},
				{ 
					id : 2,
		 			name: 'MORBT OFERTADO ',
                    data: OFERTADO_MORBT,
					color: '#008000',
					stack: 'OFERTADO'
				},
				
				{ 
					id : 2,
		 			name: 'MORBT AGENDADO',
                    data: AGENDADOS_FINAL_MORBT,
					color: '#9400D3',
					stack: 'AGENDA'
				},
				{ 
					id : 2,
		 			name: 'MORBT AGENDA CONFIRMADA',
                    data: AGENDADOS_CONFIRMADO_MORBT,
					color: '#0000FF',
					stack: 'ASISTIO'
				},
				{ 
					id : 2,
		 			name: 'MORBT AGENDA DISPONIBLE ',
                    data: BLOQUES_NO_AGENDADOS_MORBT,
					color: '#CC0000',
					stack: 'BLOQUES'
				}]
	});
} 

function MostrarGraficosFechas(CENTRO,OFERTADO_MORBT,AGENDADOS_FINAL_MORBT,AGENDADOS_CONFIRMADO_MORBT,BLOQUES_NO_AGENDADOS_MORBT,OFERTADO_MORBI,AGENDADOS_MORBI,AGENDADOS_CONFIRMADO_MORBI,BLOQUES_NO_AGENDADOS_MORBI,FECHAOFERTA, desde,hasta){

	Highcharts.chart('contenido', {

			    chart: {
			        type: 'column'
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

			    title: {
			        text: 'Ocupación Morbilidad Diaria'
			    },
			    subtitle: {
				        text: desde+ " - "+hasta
				},
			    xAxis: {
			        categories: FECHAOFERTA 
			    },

			    yAxis: {
			        allowDecimals: false,
			        min: 0,
			        title: {
			            text: ''
			        }
			    },

			    tooltip: {
			        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
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
                    data: OFERTADO_MORBI,
					color: '#32CD32',
					stack: 'OFERTADO'
				
				},
				{ 
					id : 1,
		 			name: 'MORBI AGENDADO',
                    data: AGENDADOS_MORBI,
					color: '#BA55D3',
					stack: 'AGENDA'
				},
				{ 
					id : 1,
		 			name: 'MORBI AGENDA CONFIRMADA',
                    data: AGENDADOS_CONFIRMADO_MORBI,
					color: '#4169E1',
					stack: 'ASISTIO'
				},
				{ 
					id : 1,
		 			name: 'MORBI AGENDA DISPONIBLE',
                    data: BLOQUES_NO_AGENDADOS_MORBI,
					color: '#FF3333',
					stack: 'BLOQUES'
				},
				{ 
					id : 2,
		 			name: 'MORBT OFERTADO ',
                    data: OFERTADO_MORBT,
					color: '#008000',
					stack: 'OFERTADO'
				},
				
				{ 
					id : 2,
		 			name: 'MORBT AGENDADO',
                    data: AGENDADOS_FINAL_MORBT,
					color: '#9400D3',
					stack: 'AGENDA'
				},
				{ 
					id : 2,
		 			name: 'MORBT AGENDA CONFIRMADA',
                    data: AGENDADOS_CONFIRMADO_MORBT,
					color: '#0000FF',
					stack: 'ASISTIO'
				},
				{ 
					id : 2,
		 			name: 'MORBT AGENDA DISPONIBLE ',
                    data: BLOQUES_NO_AGENDADOS_MORBT,
					color: '#CC0000',
					stack: 'BLOQUES'
				}]
	});
} 


