$( document ).ready(function() {

	$('#upload').on("click",function(){
		window.parent.$("#loader").show();
		var usuario = $('#usuario').val();
		var centro = $('select[name=centro]').val();
		var serie =  $('select[name=serie]').val();
		var mes =    $('select[name=mes]').val();
		var anio =   $('select[name=anio]').val();		
		var envio = $('input:radio[name=envio]:checked').val();
		var mensaje = $('#mensaje').val();
		var porTagName= $("#subirArchivo").val();

		if (centro === "0") 
		{
			$('#centro').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#centro').css({'color':'','border':''});
		}
		if (serie === "0") 
		{
			$('#serie').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#serie').css({'color':'','border':''});
		}
		if (mes === "0") 
		{
			$('#mes').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#mes').css({'color':'','border':''});
		}
		if (anio === "0") 
		{
			$('#anio').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#anio').css({'color':'','border':''});
		}

		if (mensaje === "") 
		{
			$('#mensaje').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#mensaje').css({'color':'','border':''});
		}

		if (porTagName === ""){
			$('#subirArchivo').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#subirArchivo').css({'color':'','border':''});	
		}



		if (porTagName === "" || centro === "0" || serie === "0" || mes === "0" || anio === "0" ||usuario == "" || envio== "" || mensaje === "") {
			window.parent.$("#loader").hide();
			$("#mensajePopup").empty();
		    var texto = "<h3> Campos en Blanco , complete los campos en rojo. </h3>";
	      	$("#mensajePopup").append(texto);
	      	$("#myModal").modal();    
	    }else{
	        if (ValidaArchivo(porTagName) === false) {
	        	window.parent.$("#loader").hide();
	          $("#mensajePopup").empty();
	          var texto = "<h3> La extension no es valida. Debe ser xlsm </h3>";
	          $("#mensajePopup").append(texto);
	          $("#myModal").modal();
	           document.getElementById("subirArchivo").value = "";
	       }else{
	       		if (centro !== "0" && serie !== "0" && mes !== "0" && anio !== "0" &&  usuario != "" && envio!= "" && mensaje != "") 
		 		{
					uploadData(centro,serie,mes,anio,usuario,envio,mensaje);
		 		}else{
		 			alert("ERROR: no se puede guardar el archivo, debe seleccionar cada una de las opciones"); 	 			
		 			$ ("#centro"). prop ('selectedIndex', 0);
		 	 		$ ("#serie"). prop ('selectedIndex',0 );
		 	 		$ ("#mes"). prop ('selectedIndex', 0);
		 	 		$ ("#anio"). prop ('selectedIndex', 0);
		 	 		window.parent.$("#loader").hide();		 
		 		}
	       }
		}

	});


	//Metodo que permite presionar el boton upload a traves del evento ENTER
	$("#centro").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#upload").click();
		}
	});
	
	$("#serie").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#upload").click();
		}
	});

	$("#mes").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#upload").click();
		}
	});

	$("#anio").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#upload").click();
		}
	});

	$("#envio").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#upload").click();
		}
	});

	$("#mensaje").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#upload").click();
		}
	});

});


function ValidaArchivo(sender) {
  var valExtencion = new Array(".xlsm");
  var archivo = sender;
  archivo = archivo.substring(archivo.lastIndexOf('.'));
  if (valExtencion.indexOf(archivo) < 0) {
    return false;
  }
  else return true;
}
