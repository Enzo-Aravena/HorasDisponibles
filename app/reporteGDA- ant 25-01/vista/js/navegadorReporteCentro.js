$( document ).ready(function() {
window.parent.$("#loader").show();
 $( ".datepicker" ).datepicker();
 $("#popup").hide();
 $("#cerrar").hide();
var centro= $('#centro').val();

var hoy= new Date();
var dd = hoy.getDate();
var mm = hoy.getMonth()+1; //hoy es 0!
var yyyy = hoy.getFullYear();
if(dd<10) {dd='0'+dd} 

if(mm<10) {mm='0'+mm} 
fechaHoy = yyyy+'-'+mm+'-'+dd;
fechasDefecto = dd+'/'+mm+'/'+yyyy;

$('input[name=desde]').val(fechasDefecto);
var centroRef = $('select[name=centroRef]').val(centro);

// metodo que carga el centro del usuario
if (centro == 7 ) {
	centro  = 1;
	cargaCesfam(centro);
	//carga los ciclos gda
	cargarCicloDiario(centro,fechaHoy);
}else{
	cargaCesfam(centro);
	//carga los ciclos gda
	cargarCicloDiario(centro,fechaHoy);
}






 	$('#ejecutar').on("click",function(){
 		window.parent.$("#loader").show();
		//$('#loader').fadeIn('slow');
	 	var centroRef = $('select[name=centroRef]').val();
	 	var centro= $('#centro').val();
	 	var Fdesde = $('input[name=desde]').val();
		var testo = Fdesde.split("/");
		var desde = testo[2]+ "-" + testo[1]+ "-" +testo[0];

		if (desde !== "undefined-undefined-") {
			if (centroRef !== "0") {
				var centro = centroRef;
				cargaElCicloPorUnaFecha(centro,desde);
			}else{
				cargaElCicloPorUnaFecha(centro,desde);
				
			}
		}else{

			if (centroRef != "0") {
				var hoy= new Date();
				var dd = hoy.getDate();
				var mm = hoy.getMonth()+1;
				var yyyy = hoy.getFullYear();
				if(dd<10) {dd='0'+dd} 

				if(mm<10) {mm='0'+mm}
				desde = yyyy+'-'+mm+'-'+dd;
				var centro = centroRef;
				cargaElCicloPorUnaFecha(centro,desde);
			}else{
				cargaElCicloPorUnaFecha(centro,desde);				
			}

		}

	});


	$('#descargar').click(function(){
		var radio = $('input:radio[name=obtener]:checked').val();	 

		if (radio === undefined || radio ==="undefined" || radio === "") {
			$("#mensaje").empty();
		    var texto = "<h3>No se ha seleccionado ningun archivo.  </h3>";
		    $("#mensaje").append(texto);
		    $("#myModal").modal();
		}else{
			var datos =  $("#datosDescarga").val();
			var p =  radio.split("_");
			var ciclo = p[0];
			var fecha = p[1];
			var agendado = p[2];
			var cancelados = p[3];
			var estAge = p[4];
			var estCance = p[5];
			var centro= $('select[name=centroRef]').val();
			
			fechas = fecha.split('/');
			fecha = fechas[2]+"/"+fechas[1]+"/"+fechas[0];

			if (agendado === "0" && cancelados === "0") {
				$("#mensaje").empty();
			    var texto = "<h3> No existen registros para descargar.  </h3>";
			    $("#mensaje").append(texto);
			    $("#myModal").modal();
			}else{
				$("#mensaje").empty();
			    var texto = "<h3> Descargando Archivo.. </h3>";
			    $("#mensaje").append(texto);
			    $("#myModal").modal();
			     setTimeout(cuentaAtras, 1000);

				window.location = "../controlador/servidor/reporteCiclos.php?centro="+centro+"&"+"ciclo="+ciclo+"&"+"fechaDato="+fecha;
			}

		}
	});	


	$("#abrirPopUp").click(function() {
		$("#manualUsuario").modal();
	});


});


// CODIGO QUE HACE UN CUENTA ATRAS Y CIERRA EL POPUP
  var contador = 6;
  function cuentaAtras() {
    if (contador==0) {
      	$("#myModal").modal('hide');
    } else {
      contador--;
      $("#myModal").modal({backdrop: 'static', keyboard: false});
      setTimeout(cuentaAtras, 1000);
    }
  }