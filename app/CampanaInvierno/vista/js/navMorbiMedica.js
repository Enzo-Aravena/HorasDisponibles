$( document).ready(function() {
	$('#fecha1').datepicker();
    $('#fecha2').datepicker();
	$("#fecha2").datepicker({maxDate: '0'});
	if (screen.width == 1366) {	$("#graficos").css({"width": "20%"});	}else{	$("#graficos").css({"width": ""});}

	var fecha1 = $('input[name=fecha1]').val();
	var fecha2 = $('input[name=fecha2]').val();
	var fecha=new Date();
	var anteayer = new Date(fecha.getTime() - 48*60*60*1000); // valor correspondiente a 2 dias antes
	var ayer = new Date(fecha.getTime() - 24*60*60*1000); //valor correspondiente a 1 dia antes
	var mes = 0;

	// hoy
	switch (fecha.getMonth()) {
		case 0 :  mes = "01";	break;
		case 1 :  mes = "02";	break;
		case 2 :  mes = "03";	break;
		case 3 :  mes = "04";	break;
		case 4 :  mes = "05";	break;
		case 5 :  mes = "06";	break;
		case 6 :  mes = "07";	break;
		case 7 :  mes = "08";	break;
		case 8 :  mes = "09";	break;
		case 9 :  mes = "10";	break;
		case 10 : mes = "11";	break;
		case 11 : mes = "12";	break;
	}

	// valor correspondiente a 2 dias antes
	switch (anteayer.getMonth()) {
		case 0 :  mesAnteAyer = "01";	break;
		case 1 :  mesAnteAyer = "02";	break;
		case 2 :  mesAnteAyer = "03";	break;
		case 3 :  mesAnteAyer = "04";	break;
		case 4 :  mesAnteAyer = "05";	break;
		case 5 :  mesAnteAyer = "06";	break;
		case 6 :  mesAnteAyer = "07";	break;
		case 7 :  mesAnteAyer = "08";	break;
		case 8 :  mesAnteAyer = "09";	break;
		case 9 :  mesAnteAyer = "10";	break;
		case 10 : mesAnteAyer = "11";	break;
		case 11 : mesAnteAyer = "12";	break;
	}

	//valor correspondiente a 1 dia antes
	switch (ayer.getMonth()) {
		case 0 :  mesAyer = "01";	break;
		case 1 :  mesAyer = "02";	break;
		case 2 :  mesAyer = "03";	break;
		case 3 :  mesAyer = "04";	break;
		case 4 :  mesAyer = "05";	break;
		case 5 :  mesAyer = "06";	break;
		case 6 :  mesAyer = "07";	break;
		case 7 :  mesAyer = "08";	break;
		case 8 :  mesAyer = "09";	break;
		case 9 :  mesAyer = "10";	break;
		case 10 : mesAyer = "11";	break;
		case 11 : mesAyer = "12";	break;
	}

		
	var dia=fecha.getDate();
	var mes=mes;
	var anio=fecha.getFullYear();

	// LOGICA SI TOMA EL DIA LUNES MOSTRARA EL SABADO Y LUNES , SI ES OTRO DIA MUESTRA EL DIA ANTERIOR Y EL DE HOY
	function diaSemanaAyer(dia,mes,anio){
		//CREAMOS UN ARRAY PARA OBTENER EL DIA DE LA SEMANA
	    var dias=["dom", "lun", "mar", "mie", "jue", "vie", "sab"];
	    //INSTANCIAMOS LA FECHA
	    var dt = new Date(mes+' '+dia+', '+anio+' 12:00:00');
	    var ayers = "";
	    //HACEMOS LAS VALIDACION SI ES LUNES U OTRO DIA
	    if (dias[dt.getUTCDay()] === "lun") {
	    	if (anteayer.getDate() <= 9) {
	    		ayers = "0"+ anteayer.getDate();
	    	}else{
	    		ayers = anteayer.getDate();
	    	}
	    	var fechaDia =ayers+"/"+mesAnteAyer+"/"+anteayer.getFullYear();
	    }else{
	    	if (ayer.getDate() <= 9) {
	    		var ayers = "0"+ ayer.getDate();
	    	}else{
	    		ayers = ayer.getDate();
	    	}
	    	var fechaDia = ayers+"/"+mesAyer+"/"+ayer.getFullYear();
	    }

	   //RETORNAMOS LA FECHA QUE SE REQUIERE DEPENDIENDO DEL CASO
	    return fechaDia;
	};


	//EN FECHA 1 LLAMAMOS AL METODO DIASEMANA
	var fecha1 = diaSemanaAyer(dia, mes,anio);
	$('input[name=fecha1]').val(fecha1);
	enviarDatosFormulario(fecha1,fecha2);
	
	$('#buscar').on("click",function(){
		$("#mostrarTabla").empty();
		var fecha1 = $('input[name=fecha1]').val();
		var fecha2 = $('input[name=fecha2]').val();
		var resultado = validate_fechaMayorQue(fecha1,fecha2);
		if (resultado ===  true) {
			if (fecha1 !== "" && fecha2 ==="") {
				window.parent.parent.$("#loader").show();
				enviarDatosFormulario(fecha1,fecha2);
			}else{
				$("#mensaje").empty();
				var texto = "<h3> La fecha no puede ser menor que la primera ..  </h3>";
			    $("#mensaje").append(texto);
			    $("#myModal").modal();
			}	
		}else{
			if (fecha1 === "" && fecha2 ==="") {
				$("#mensaje").empty();
			    var texto = "<h3> Debe seleccionar un rango de fechas..  </h3>";
			    $("#mensaje").append(texto);
			    $("#myModal").modal();
			}else{ 
				window.parent.parent.$("#loader").show();
				enviarDatosFormulario(fecha1,fecha2);
			}
		}

	});


	$("#ExportarData").on("click",function(){
		$("#mensaje").empty();
		var fecha1 = $('input[name=fecha1]').val();
		var fecha2 = $('input[name=fecha2]').val();
		var resultado = validate_fechaMayorQue(fecha1,fecha2);
		if (resultado ===  true) {
			if (fecha1 !== "" && fecha2 ==="") {
				$("#mensaje").empty();
				var texto = "<h3> Descargando Archivo..  </h3>";
			    $("#mensaje").append(texto);
			    $("#myModal").modal();
			    $("#close").hide();
		      	$("#cerrar").hide();
			    setTimeout(cuentaAtras, 1000);
			    window.parent.$("html,body").animate({ scrollTop: 0 }, 600);
				window.location = "../controlador/servidor/controladorMorbMedicamento.php?evento=exportarArchivo"+"&fecha1="+fecha1+"&fecha2="+fecha2;

			}else{
				$("#mensaje").empty();
				var texto = "<h3> La fecha no puede ser menor que la primera ..  </h3>";
			    $("#mensaje").append(texto);
			    $("#myModal").modal();
			}		
		}else{
			if (fecha1 === "" && fecha2 ==="") {
				$("#mensaje").empty();
			    var texto = "<h3> Debe seleccionar un rango de fechas..  </h3>";
			    $("#mensaje").append(texto);
			    $("#myModal").modal();
			}else{
				$("#mensaje").empty();
				var texto = "<h3> Descargando Archivo..  </h3>";
			    $("#mensaje").append(texto);
			    $("#myModal").modal();
			    $("#close").hide();	    
		      	$("#cerrar").hide();
			    setTimeout(cuentaAtras, 1000);
				window.location = "../controlador/servidor/controladorMorbMedicamento.php?evento=exportarArchivo"+"&fecha1="+fecha1+"&fecha2="+fecha2;
			}
		}	    
	});


	function enviarDatosFormulario(fecha1,fecha2){
		var resultado = null;
		var url = "../controlador/servidor/controladorMorbMedicamento.php";
		var type = "POST";		
		var data = {
			evento:"cargarTabla",
			fecha1:fecha1,
			fecha2:fecha2		
		};

		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){
				$("#mostrarTabla").empty();
				$("#mostrarTabla").append(response);
				window.parent.parent.$("#loader").hide();
			},
			error:function(error){
				console.log("Error de la peticio");
				
			}
		});// fin ajax
	}


});

// CODIGO QUE HACE UN CUENTA ATRAS Y CIERRA EL POPUP
  var contador = 3;
  function cuentaAtras() {
    if (contador==0) {
      	$("#myModal").modal('hide');
    } else {
      contador--;
      $("#myModal").modal({backdrop: 'static', keyboard: false});
      setTimeout(cuentaAtras, 1000);
    }
  }


function validate_fechaMayorQue(fecha1,fecha2) {
   
    missinginfo = "";
    var rangoini = fecha1 		// document.getElementById('fec_inicio').value;
    var rangofin =  fecha2 		//document.getElementById('fec_fin').value; 
    valuesStart=rangoini.split("/");     
    valuesEnd=rangofin.split("/");
    if ((Date.parse(valuesStart[1]+'/'+valuesStart[0]+'/'+valuesStart[2])) > (Date.parse(valuesEnd[1]+'/'+valuesEnd[0]+'/'+valuesEnd[2]))) {
    	//la fecha de inicio es mayor a la de fin
    	return true;
    }else{
    	// la fecha de inicio es menor a la de fin
    	return false;
    }
}