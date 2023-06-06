$( document ).ready(function() {
    $('#medicamento').select2();
    
cargaSelect();
    $("select").change(function(){
     	var medicamento= $('select[name=medicamento]').val();
	 	if (medicamento !=="0") {
			$("#codigo").prop('disabled', true);			
		}
		else{
			$("#codigo").prop('disabled', false);
		}
	});


      $('#abrirPopUp').on("click",function(){
	    //alert("muestra");
	    $("#manualUsuario").modal();
	  });



	// Valida si el select se le cambio la opcion original y deshabilita el campo codigo
    $("#codigo").change(function(){
     	var codigo= $('#codigo').val();
	 	if (codigo !=="") {
			$("#medicamento").prop('disabled', true);
		}
		else{
			$("#medicamento").prop('disabled', false);
		}
	});

    $("#ejecutar").on("click", function(){
    	var codigo = $('#codigo').val();
		var medicamento = $('select[name=medicamento]').val();
		var almacen = $('select[name=almacen]').val();
		var maximo = $('#maximo').val();
		var critico = $('#critico').val();

		if ( (codigo !== "" || medicamento !== "0") && almacen !== "0" && maximo !== "" && critico !== "") {
			actualizarStock(codigo,medicamento,almacen,maximo,critico);
		}else{
			$("#mensaje").empty();
		    var texto = "<h3> Error al tratar de ingresar los datos, campo en blanco..  </h3>";
		    $("#mensaje").append(texto);
		    $("#myModal").modal();
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

});