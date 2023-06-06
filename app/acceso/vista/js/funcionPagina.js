$(function(){

	$("#ejecutar").on("click",function(){
		
		var user = $("#user").val();
		var pass = $("#pass").val();
		var res = null;
		
		if(user != '' && pass != ''){
			LoginUsuario(user,pass);
		}else{
			alert("Error...");
		}
	});
	
	$("#pass").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#ejecutar").click();
		}
	});
	
	$("#user").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#ejecutar").click();
		}
	});

	$("#volver").on("click",function(){
		var url = "http://srvrcapp/PaginaInicio/";
		$(location).attr('href',url);
	});

});