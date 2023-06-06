$( document ).ready(function() {
	//$("#tablaContent").hide();
    $('#medicamento').select2();
    
    $("#tablaContent").hide();
    $("#botonModificar").hide();

	cargaSelect();
	window.parent.$("#loader").show();


	var centro = $("#centro").val();
	var permisos = $("#permisos").val();

	if (permisos === "10") {
		$("#almacen").prop('disabled', false);
	    $('select[name=almacen]').val(0);
	}else{
		switch(centro){
			// SAN LUIS
		    case "3":	    	
				$('select[name=almacen]').val(10);
				$("#almacen").prop('disabled', true);
		    break;
		    //CAROL URZUA
			case "1":		
				$('select[name=almacen]').val(6);
				$("#almacen").prop('disabled', true);
			break;
			//LA FAENA
			case "2":		
				/*$('select[name=almacen]').val(8);
				$("#almacen").prop('disabled', true);*/
				$('select[name=almacen]').val(8);
				let almacenDisp = '<option value="8"> LA FAENA FARMACIA </option><option value="36"> COSAM FARMACIA </option>';
				$("#almacen").empty();
				$("#almacen").append(almacenDisp);
			break;

			//LO HERMIDA
			case "4":			
				$('select[name=almacen]').val(3);
				$("#almacen").prop('disabled', true);
			break;

			//CARDENAL S.H
			case "5":			
				$('select[name=almacen]').val(4);
				$("#almacen").prop('disabled', true);
			break;

			//COSAM
			case "6":
				$('select[name=almacen]').val(36);
				$("#almacen").prop('disabled', true);
			break;

			// PADRE G. W
			case "12":
				$('select[name=almacen]').val(103);
				$("#almacen").prop('disabled', true);
			break;

			//LAS TORRES
			case "13":
				$('select[name=almacen]').val(106);
				$("#almacen").prop('disabled', true);
			break;

		
		    default:
		    	$("#almacen").prop('disabled', false);
		    	$('select[name=almacen]').val(0);
		    break;
		}
	}


	
    
      $('#abrirPopUp').on("click",function(){
	    //alert("muestra");
	    $("#manualUsuario").modal();
	  });


    $("#ejecutar").on("click", function(){
    	window.parent.$("#loader").show();
    	var medicamento = $('select[name=medicamento]').val();
    	//var medicamento = $('#medicamento').val().toString();
		var almacen = $('select[name=almacen]').val();

		if ((medicamento !== null ) && almacen !== "0") {
			ObtenerTabla(medicamento,almacen);
		}else{
			$("#tablaContent").hide();
			$("#botonModificar").hide();
			window.parent.$("#loader").hide();
			$("#mensaje").empty();
		    var texto = "<h3> medicamentos y/o almacen vacio, favor completar campos ..</h3>";
		    $("#mensaje").append(texto);
		    $("#myModal").modal();
		}
	
    });


	$("#modificarStock").on("click",function(){
		window.parent.$("#loader").show();
		var medicamento = $('select[name=medicamento]').val();
		var almacen = $('select[name=almacen]').val();
		var da  =  document.getElementsByName('critico');
		var valor = da.length;
		var array2= [];

		for(i= 0; i<valor;i++){
			var array= [];
			var codigo = document.getElementById("idCodigo"+i).value;
			var alm = document.getElementById('almacen').value;
			var maximo = document.getElementById('idmaximo'+i).value;
			var critico = document.getElementById('idCritico'+i).value;
			array2.push({"codigo":codigo,"almacen":alm,"maximo":maximo,"critico":critico });
		}

		var cambios = array2;

		if (medicamento === "" || almacen === "0") {
			$("#tablaContent").hide();
			$("#botonModificar").hide();
			window.parent.$("#loader").hide();
			$("#mensaje").empty();
		    var texto = "<h3> medicamentos y/o almacen vacio, favor completar campos ..</h3>";
		    $("#mensaje").append(texto);
		    $("#myModal").modal();

		}else{
			actualizarStock(cambios,medicamento,almacen);
		}		
	});

    // cierra el popup
	$('#close').click(function(){
		$('#popup').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

	 // cierra el popup
	$('#cerrar').click(function(){
		$('#popup').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

	 // cierra el popup
	$('#aceptar').click(function(){
		$('#popup').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});
	
	
	$('select[name=almacen]').change(function(){
		var tipoDato = $("select[name=almacen]").val();
		$("#tablaContent").hide();
		$("#botonModificar").hide();
	});

});