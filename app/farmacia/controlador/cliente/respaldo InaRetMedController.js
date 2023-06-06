function cargarPacienteInasistente(){
	var resultado = null;
	var url= "../controlador/servidor/InaRetMedController.php";
	var type = "POST";
	var data = {
		evento:"cargarPacientes"
	};
	
	$.ajax({
		url: url,
		type: type,
		data: data,
		beforesend:function(){
			console.log("Peticion enviada");
		},//se ejecuta primero
		success:function(response){
			$('#tabla_resultados').empty();
			resultado = JSON.parse(response);
			if (resultado[0].data !== "0" ) {
				var cont =0;
				for(aux in resultado){
					cont = cont +1;
					var tabla = "";
					tabla = tabla + '<tr>';
						tabla = tabla + '<td>'+ cont +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].CENTRO_DISPENSACION +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].CODIGO_MEDICAMENTO +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].NOMBRE_MEDICAMENTO +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].RUT_PACIENTE +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].NOMBRE_PACIENTE +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].INICIO_TRATAMINETO +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].FECHA_ENTREGA +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].TIPO_RECETA +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].CANTIDAD_NO_DISPENSADA +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].STOCK_INICIAL +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].STOCK_FINAL +'</td>';				
					tabla = tabla + '</tr>';
					$("#tabla_resultados").append(tabla);
				} //END FOR

				//$('#tabla_resultados').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:15});
				$('#tabla_resultados').pageMe({
				    pagerSelector: '#myPager',
				    showPrevNext: true,
				    hidePageNumbers: false,
				    perPage: 4
	  			});
				window.parent.$("html,body").animate({ scrollTop: 0 }, 600);
				window.parent.parent.$("#loader").hide();
				$("#loader").hide();
				$("#example").tablesorter();
			}else{
				tabla = tabla + '<tr>';
				tabla = tabla + '<td colspan = 12> No se han encontrado resultados.. </td>';			
				tabla = tabla + '</tr>';
				$("#tabla_resultados").append(tabla);
				window.parent.parent.$("#loader").hide();
				window.parent.parent.$("#loader").hide();
				$("#loader").hide();
			}

			
		},//peticion completa con exito
		error:function(error){
			resultado = response;
			console.log("Error en Peticion");
		}//peticion con fallos
	});
}


function buscarPacienteDisp(buscar,desde, hasta){
	var resultado = null;
	var url= "../controlador/servidor/InaRetMedController.php";
	var type= "POST";
	var data = {
		evento:"cargarPacientesxParametro",
		rut:buscar,
		desde: desde,
		hasta: hasta
	};
	
	$.ajax({
		url: url,
		type: type,
		data: data,
		beforeSend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){
			$('#tabla_resultados').empty();
			resultado = JSON.parse(response);
			if (resultado[0].data !== "0" ) {
				var cont =0;
				for(aux in resultado){
					cont = cont +1;
					var tabla = "";
					tabla = tabla + '<tr>';
						tabla = tabla + '<td>'+ cont +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].CENTRO_DISPENSACION +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].CODIGO_MEDICAMENTO +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].NOMBRE_MEDICAMENTO +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].RUT_PACIENTE +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].NOMBRE_PACIENTE +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].INICIO_TRATAMINETO +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].FECHA_ENTREGA +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].TIPO_RECETA +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].CANTIDAD_NO_DISPENSADA +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].STOCK_INICIAL +'</td>';
						tabla = tabla + '<td>'+ resultado[aux].STOCK_FINAL +'</td>';				
					tabla = tabla + '</tr>';
					$("#tabla_resultados").append(tabla);
				}//END FOR


				if(resultado.length >15 ){
					$("#myPager").show();
				}else{
					$("#myPager").hide();
				}

				//$('#tabla_resultados').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:15});
				$('#tabla_resultados').pageMe({
				    pagerSelector: '#myPager',
				    showPrevNext: true,
				    hidePageNumbers: false,
				    perPage: 4
	  			});
				window.parent.$("html,body").animate({ scrollTop: 0 }, 600);
				window.parent.parent.$("#loader").hide();
				$("#example").tablesorter();
				$("#ExportarData").show();

			}else{
				$("#myPager").hide();
				tabla = tabla + '<tr>';
				tabla = tabla + '<td colspan = 12> No se han encontrado resultados.. </td>';			
				tabla = tabla + '</tr>';
				$("#tabla_resultados").append(tabla);
				window.parent.parent.$("#loader").hide();
				$("#ExportarData").hide();

			}

			
		},
		error:function(e){
			console.log("Error de la peticion");
		}
	});
}


