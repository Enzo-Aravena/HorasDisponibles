let fechaH= "";
$( document ).ready(function() {
	$( ".datepicker" ).datepicker();
	var hoy= new Date();
	var dd = hoy.getDate();
	var mm = hoy.getMonth()+1; //hoy es 0!
	var yyyy = hoy.getFullYear();
	if(dd<10) {dd='0'+dd}
	if(mm<10) {mm='0'+mm}
	fechaHoy = yyyy+'-'+mm+'-'+dd;
	let fechaEstructurada = dd+"/"+mm+"/"+yyyy;
	$("#fecha").text(fechaEstructurada);
	$('input[name=desde]').val(fechaEstructurada);
	let fecha1 = fechaEstructurada;
	let fecha2 = "";
	cargaDeCiclosDiaria(fecha1,fecha2);

	$("#exportInforme").hide();


	$('#BuscarPorFecha').on("click",function(){
		var fecha1 = $('input[name=desde]').val();
		var fecha2 = $('input[name=hasta]').val();
		var resultado = validate_fechaMayorQue(fecha1,fecha2);
		if (resultado ===  true) {
			if (fecha1 !== "" && fecha2 ==="") {
				cargaDeCiclosDiaria(fecha1,fecha2);
				$("#exportInforme").show();
			}else{
				$("#exportInforme").hide();
				alert("La segunda Fecha no puede ser menor que la primera");
			}	
		}else{
			if (fecha1 === "" && fecha2 ==="") {
				$("#exportInforme").hide();
				alert("Debe seleccionar al menos una fecha o un Rango de fechas..");
			}else{
				$("#exportInforme").show();
				cargaDeCiclosDiaria(fecha1,fecha2);
			}
		}
	});

	$('#exportInforme').on("click",function(){
		var fecha1 = $('input[name=desde]').val();
		var fecha2 = $('input[name=hasta]').val();
		var resultado = validate_fechaMayorQue(fecha1,fecha2);
		if (resultado ===  true) {
			if (fecha1 !== "" && fecha2 ==="") {
				window.location = "../controlador/servidor/controladorReporte.php?evento=exportarArchivo&fecha1="+fecha1+"&fecha2="+fecha2;
				$("#exportInforme").show();
			}else{
				$("#exportInforme").hide();
				alert("La segunda Fecha no puede ser menor que la primera");
			}	
		}else{
			if (fecha1 === "" && fecha2 ==="") {
				$("#exportInforme").hide();
				alert("Debe seleccionar al menos una fecha o un Rango de fechas..");
			}else{
				$("#exportInforme").show();
				window.location = "../controlador/servidor/controladorReporte.php?evento=exportarArchivo&fecha1="+fecha1+"&fecha2="+fecha2;
			}
		}
		/*if (fecha!== "") {
			var fe = fecha.split("/");
			var fechaHoy = fe[2]+"-"+fe[1]+"-"+fe[0];
			window.location = "../controlador/servidor/controladorReporte.php?evento=exportarArchivo&fecha="+fechaHoy;
		} else {
			alert("Se debe seleccionar una fecha para descargar el archivoW.");
		}*/
	});

	



});


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