$( document ).ready(function() {
	window.parent.parent.$("#loader").show();
	var permisos = $("#permisos").val();

	if (permisos == "7") {		 
		 $('#tabla2').hide(); 
	}else{
		 $('#tabla2').show(); 
	}

	var hoy= new Date();
	var dd = hoy.getDate();
	var mm = hoy.getMonth(); //hoy es 0!
	var yyyy = hoy.getFullYear();


	if(dd === 1){
		if (mm === 1 || mm === 3 || mm === 5 || mm === 7 || mm === 8 || mm === 10 || mm === 12 ) {
				dd = 31;
		}else{
			if (mm === 4 || mm === 6 || mm === 5 || mm === 9 || mm === 11) {
				dd = 30;
			}else{
				dd = 28;
			}
		}    	
    }else{
    	var hoy= new Date();
		var dd = hoy.getDate()-1;
		var mm = hoy.getMonth()+1;
		var yyyy = hoy.getFullYear();
    }
	
	if(dd<10) {dd='0'+dd} 

	if(mm<10) {mm='0'+mm} 
	fechaHoy = dd +'/'+ mm +'/'+ yyyy;

	$('input[name=desde]').val(fechaHoy);

	// carga el combo select 
	cargaSelect();
    $('#desde').datepicker();
    $('#hasta').datepicker();
    $('#medicamento').select2();

    //CARGA LOS PRIMEROS DATOS
    buscarData();

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

     $("#abrirPopUp").click(function() {
     	//OPEN MODAL
		$("#manualUsuario").modal();
	});

    $('#ExportarData').on("click",function(){
    	$("#mensaje").empty();
	    var texto = "<h3> Descargando Archivo..  </h3>";
	    $("#mensaje").append(texto);
		$("#myModal").modal();
		setTimeout(cuentaAtras, 1000);
	    var array2= [];
		var centro= $('input:radio[name=rdbBuscar]:checked').val();
		var critico = $('input[name=criticoSi]').prop('checked');
		var medicamento= $('select[name=medicamento]').val();
		var Fdesde = $('input[name=desde]').val();
		var Fhasta = $('input[name=hasta]').val();
		if (medicamento === null) {
			medicamento = "0";
		}else{
			var valor = medicamento.length;
			for(i= 0; i<valor;i++){		array2.push("'"+medicamento[i]+"'");}
			medicamento = array2;
		}

		if (critico === false) {critico = "TOTAL";	}else{	critico = "SI";	}		
		window.location = "../controlador/servidor/reporteFarmacia.php?fecha1="+Fdesde+"&fecha2="+Fhasta+"&medicamento="+medicamento+"&centro="+centro+"&critico="+critico;
    });

    
   

    //VALIDA Y BUSCA POR UNA O DOS FECHAS
     $('#ejecutar').on("click",function(){ 
     	window.parent.parent.$("#loader").show();
		var fecha1 = $('input[name=desde]').val();
		var fecha2 = $('input[name=hasta]').val();
		var resultado = validate_fechaMayorQue(fecha1,fecha2);

		if (resultado ===  true) {
			if (fecha1 !== "" && fecha2 ==="") {
				buscarData();
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
				window.parent.parent.$("#loader").hide();
			}else{
				$("#ExportarData").show();
				buscarData();
			}
		}
     });
}); //END JQUERY


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

function separar_fecha1() {
	var desde =$('input[name=desde]').val();
	if (desde !== "") {
		var ho = desde.split('/');
		var desde = ho[2]+"-"+ho[1]+"-"+ho[0];
	}else{
		var desde = desde;
	}
	return desde;
}

function separar_fecha2() {
	var hasta =$('input[name=hasta]').val();
	if (hasta !== "") {
		var ho = hasta.split('/');
		var hasta = ho[2]+"-"+ho[1]+"-"+ho[0];
	}else{
		var hasta = hasta;
	}
	return hasta;
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

function buscarData(){
	window.parent.parent.$("#loader").show();
	var desde = separar_fecha1();
	var hasta = separar_fecha2();
	var centro= $('input:radio[name=rdbBuscar]:checked').val();
	var codigo= "";
	var critico =  $('input[name=criticoSi]').prop('checked'); //$('input:radio[name=critico]:checked').val();
	var medicamento = $('select[name=medicamento]').val();
	var array2= [];
	if (medicamento === null) {
		medicamento = "0";
	}else{
		var valor = medicamento.length;
		for(i= 0; i<valor;i++){
			array2.push("'"+medicamento[i]+"'");
		}
		medicamento = array2;
	}

	if (critico === false) {
		critico = "TOTAL";
	}else{
		critico = "SI";
	}

	var data = {
		evento:"obtenerData",
		desde: desde,
		hasta: hasta,
		centro:centro,
		codigo:codigo,
		critico:critico,
		medicamento: medicamento
	};

	$.ajax({
		url : "../controlador/servidor/controladorFarmacia.php?evento=obtenerData&fecha1="+desde+"&fecha2="+hasta+"&centro="+centro+"&codigo="+codigo+"&medicamento="+medicamento+"&critico="+critico+"",
		method : "POST",
		contentType:false,
		//async: false,
		processData:false,
		cache: false,
		beforeSend:function(response){
			console.log("Peticion Recibida");
		},
		success:function(response){
			resultado =  JSON.parse(response);
			window.parent.parent.$("#loader").hide();
			$('#tabla_resultados').empty();
				var i = 0;
				$("#ExportarData").show();
				var arreglo = new Array();
				for(var aux = 0 in resultado){
					i= i+1;
					var arreglos = [i,resultado[aux].fecha,resultado[aux].centro,resultado[aux].codigo,resultado[aux].material,resultado[aux].stockInicial,resultado[aux].nDeIngresos,resultado[aux].totalDispensadas,resultado[aux].totalEgresos,resultado[aux].stockFinal,resultado[aux].maximo,resultado[aux].critico,resultado[aux].estado,resultado[aux].solicitar];
					arreglo.push(arreglos);
				}

				var resultadoBase = arreglo;
				var dataTable = $('#example').DataTable();
				dataTable.fnClearTable();
				$('#example').dataTable().fnAddData(resultadoBase);
			window.parent.parent.$("#loader").hide();
		},
		error:function(e){
			console.log("Error en el sistema");
		}
	});
}