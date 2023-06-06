$( document).ready(function() {
	$('#fecha1').datepicker();
    $('#fecha2').datepicker();

    $("input:radio[name=centro]").change(function(){
    	$("#mostrarTabla").empty();
    	window.parent.parent.$("#loader").show();
    	var centro = $("input[name='centro']:checked").val();
		var fecha1 = $('input[name=fecha1]').val();
		var fecha2 = $('input[name=fecha2]').val();
    	enviarDatosFormulario(fecha1,fecha2,centro);
    });

    var centro = $("input[name='centro']:checked").val();
	var fecha1 = $('input[name=fecha1]').val();
	var fecha2 = $('input[name=fecha2]').val();
    var fecha=new Date();
//	var ayer=new Date(fecha.getTime() - 48*60*60*1000); //ante ayer



	var ayer = new Date(fecha.getTime() - 24*60*60*1000); //ayer 
	var mes = 0;

	switch (ayer.getMonth()) {
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


	var ayers ="";
	if (ayer.getDate() < 9) {
		ayers = "0"+ ayer.getDate();
	}else{
		ayers = ayer.getDate();
	}

 	var fecha1 = ayers+"/"+mes+"/"+ayer.getFullYear();

 	$('input[name=fecha1]').val(fecha1);
	
 	//var fecha2 = ayer.getDate()+"/"+mes+"/"+ayer.getFullYear();
	
	enviarDatosFormulario(fecha1,fecha2,centro);

	if (screen.width == 1366) {
		$("#graficos").css({"width": "20%"});
	}else{
		$("#graficos").css({"width": ""});
	}

	
	$('#buscar').on("click",function(){
		$("#mostrarTabla").empty();		
		var fecha1 = $('input[name=fecha1]').val();
		var fecha2 = $('input[name=fecha2]').val();
		var centro = $("input[name='centro']:checked").val();

		if (fecha1 === "" && fecha2 ==="") {
			$("#mensaje").empty();
		    var texto = "<h3> Debe seleccionar un rango de fechas..  </h3>";
		    $("#mensaje").append(texto);
		    $("#myModal").modal();
		}else{
			window.parent.parent.parent.$("#loader").show();
			enviarDatosFormulario(fecha1,fecha2,centro);
		}

	});



	function enviarDatosFormulario(fecha1,fecha2,centro){
		var resultado = null;
		var url = "../controlador/servidor/controladorMorbSapu.php";
		var type = "POST";
			
		var data = {
			evento:"cargarTabla",
			fecha1:fecha1,
			fecha2:fecha2,
			centro:centro
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


	$("#ExportarData").on("click",function(){
		$("#mensaje").empty();
	    var centro = $("input[name='centro']:checked").val();
	    var fecha1 = $('input[name=fecha1]').val();
		var fecha2 = $('input[name=fecha2]').val();	
 		var texto = "<h3> Descargando Archivo..  </h3>";
	    $("#mensaje").append(texto);
	    $("#myModal").modal();
	    setTimeout(cuentaAtras, 1000);
	    //exportar();

		window.location = "../controlador/servidor/controladorMorbSapu.php?evento=exportarArchivo"+"&fecha1="+fecha1+"&fecha2="+fecha2+"&centro="+centro;
	});



	function exportar(){
	        var uri = 'data:application/vnd.ms-excel;base64,'
	        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
	        , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
	        , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
	        var table = 'dataTable';
	        var name = 'reportería';
	        if (!table.nodeType) table = document.getElementById(table)
	         var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
	         window.location.href = uri + base64(format(template, ctx))
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

/*
function enviarDatosFormulario(fecha1,fecha2,centro){
	//window.parent.parent.$("#loader").show();
	var centro = $("input[name='centro']:checked").val();
	var fecha1 = $('input[name=fecha1]').val();
	var fecha2 = $('input[name=fecha2]').val();
		
	var data = {
		evento:"cargarTabla",
		fecha1:fecha1,
		fecha2:fecha2,
		centro:centro
	};

	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("mostrarTabla").innerHTML = xmlhttp.responseText;
			$("#loader").hide();
		}
	}
	xmlhttp.open("GET","../controlador/servidor/controladorMorbSapu.php?evento=cargarTabla"+"&fecha1="+fecha1+"&fecha2="+fecha2+"&centro="+centro,true);
	xmlhttp.send();
	window.parent.parent.$("#loader").hide();


}*/