$( document ).ready(function() {
	$("#tabla_resultados").empty();

	$('#ejecutar').on("click",function(){
		$("#tabla_resultados").empty();
		var resultado = "";
	    var porTagName=document.getElementsByTagName("input")[0].value;
	    var uno    = ($('input[name=uno]').is(":checked")? "1":"0");
	    var dos    = ($('input[name=dos]').is(":checked")? "1":"0");
	    var tres   = ($('input[name=tres]').is(":checked")? "1":"0");
	    var cuatro = ($('input[name=cuatro]').is(":checked")? "1":"0");
	    var cinco  = ($('input[name=cinco]').is(":checked")? "1":"0");
	    var seis   = ($('input[name=seis]').is(":checked")? "1":"0");
	    if (porTagName === "") {
	      $("#mensaje").empty();
	      var texto = "<h3> No ha seleccionado un archivo. </h3>";
	      $("#mensaje").append(texto);
	      $("#myModal").modal({backdrop: 'static', keyboard: false});
	    }else{
	    	//AL VALIDAR LA FUNCION DEBE MOSTRAR SI ES TRUE O FALSE
	        if (ValidaArchivo(porTagName) === false) {
	          $("#mensaje").empty();
	          var texto = "<h3> La extension no es valida. </h3>";
	          $("#mensaje").append(texto);
	          $("#myModal").modal({backdrop: 'static', keyboard: false});
	           document.getElementById("subirArchivo").value = "";
	        }else{
	        	//VALIDA QUE NINGUNO DE LOS CHECK VENGA VACIO, SI NO VIENE VACIO QUE NO PROCESE LOS DATOS
	        	if (uno !== "0" || dos !== "0" || tres !== "0" || cuatro !== "0" || cinco !== "0" || seis !== "0") {
	        		uploadData(uno,dos,tres,cuatro,cinco,seis);	
	        	}else{
	        		alert("Debe seleccionar al menos 1 opcion.");
	        	}
	        }
	    }
	});

});// END FUNCTION PRINCIPAL

//FUNCION QUE VALIDA SI EL ARCHIVO CARGADO ES EXCEL
function ValidaArchivo(sender) {
	//CREA UN ARRAY CON LAS EXTENSIONES
	var valExtencion = new Array(".xlsx", ".xls");
	//OBTIENE EL REMITENTE DEL ARCHIVO EL NOMBRE Y DE DONDE VIENE
	var archivo = sender;
	// BUSCA LA EXTENSION DEL ARCHIVO YA SEA XLS O XLSX
	archivo = archivo.substring(archivo.lastIndexOf('.'));
	//VALIDA LA EXTENSION DEL ARCHIVO SUBIDO
	if (valExtencion.indexOf(archivo) < 0) {
		return false;
	}
	else{
		return true;
	} 
}