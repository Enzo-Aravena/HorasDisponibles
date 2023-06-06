function buscarPacienteDisp(buscar,desde,hasta,centro){
	window.parent.parent.$("#loader").show();
	var resultado = null;
	var url= "../controlador/servidor/InaRetMedController.php";
	var type= "POST";
	var data = {
		evento:"cargarDatosNuevaFunction",
		rutPaciente:buscar,
		fecha1:desde,
		fecha2:hasta,
		centro:centro
	};
	
	$.ajax({
		url: url,
		type: type,
		async: false,
		data: data,
		beforeSend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){
			
			$('#tabla_resultados').empty();
			var arreglo = new Array();
			let cadena = "";
			resultado = JSON.parse(response);
			if (resultado[0].data !== "0" ) {
				var cont =0;
				var dato = ""
				var giCount = 2;
				for(aux in resultado){
					cont = cont +1;
					var arreglos = [cont,resultado[aux].CENTRO_DISPENSACION,resultado[aux].CODIGO_MEDICAMENTO,resultado[aux].NOMBRE_MEDICAMENTO,resultado[aux].RUT_PACIENTE,resultado[aux].NOMBRE_PACIENTE,resultado[aux].INICIO_TRATAMINETO,resultado[aux].FECHA_ENTREGA,resultado[aux].TIPO_RECETA,resultado[aux].CANTIDAD_NO_DISPENSADA,resultado[aux].STOCK_INICIAL,resultado[aux].STOCK_FINAL];
					arreglo.push(arreglos);
				}//END FOR
				
				var arreglos = arreglo;
				var dataTable = $('#example').DataTable();
				dataTable.fnClearTable();
				$('#example').dataTable().fnAddData(arreglos);
								

				$("#ExportarData").show();
			}else{
				var arreglos = ["-",0,0,0,0,0,0,0,0,0,0,0];
		        arreglo.push(arreglos);
		        var dataTable = $('#example').DataTable();
		        dataTable.fnClearTable();
		        $('#example').dataTable().fnAddData(arreglos);
				$("#ExportarData").hide();
			}

			window.parent.parent.$("#loader").hide();
		},
		error:function(e){
			console.log("Error de la peticion");
		}
	});
}


