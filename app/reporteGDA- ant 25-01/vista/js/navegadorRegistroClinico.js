$( document ).ready(function() {

var todoCentro= 0;
var hoy= new Date();
var dd = hoy.getDate();
var mm = hoy.getMonth()+1; //hoy es 0!
var yyyy = hoy.getFullYear();
if(dd<10) {dd='0'+dd} 

if(mm<10) {mm='0'+mm} 
fechaHoy = yyyy+'-'+mm+'-'+dd;

//fechaHoy ="2018-03-15";
window.parent.$("#loader").show();

//obtener la fecha del sistema
var x= hoy.getHours();
var y= hoy.getMinutes();
if (x >=10) { var b = x; }else{ var b=  "0"+ x; }
if (y >= 10) { 	var a = y; }else{	var a = "0" + y; }
if (b >=12 ) { 	var horaActualizacion = b+":"+a + " pm"; }else{	var horaActualizacion = b+":"+a+ " am"; }

//setInterval( "actualiza()", 600 ); // carga la pagina segundos

// array que busca las fechas 
var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
var FechaEscrita = hoy.getDate()+" de "+ meses[hoy.getMonth()] + " del "+ hoy.getFullYear();
$("#mostrarFecha").html(FechaEscrita + ", "+"Última Actualizacion : "+horaActualizacion);

// metodo que carga los datos de todos los ciclos
cargarCiclodeTodosLosCentros(todoCentro,fechaHoy);


//metodo que carga el mando 
cargarDatos();


$("#actualizar").on("click",function(){
	$("#tabla_resultados").empty();
	$('#loader').fadeIn('slow');
	var datosTabla = $("#tabla_resultados").val();
	if (datosTabla !== "" || datosTabla !== "undefined") {
		//ActualizarCuadroMando(todoCentro,fechaHoy);
		cargarCiclodeTodosLosCentros(todoCentro,fechaHoy);
		window.parent.$("#loader").show();
	}else{
		console.log("Error en la llamada de la funcion.");
	}

});


});