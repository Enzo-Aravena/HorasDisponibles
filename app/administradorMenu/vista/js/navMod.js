$(document).ready(function(){ 

$("#MensajeModificacion").hide();

//obtiene la variable enviada por URL
var test = location.search.replace('?', '').split('&');

var urlParameter = test[0];
var parameter= urlParameter.split('=');
var idMenu= parameter[1];

if (idMenu === "undefined") {
	console.log('El formulario se abrira sin data');

	$("#dataPrincipal").fadeOut();
		$('#contenido').append("<div id='loader' style= 'margin-left:4%;margin-top: 13%;'>"
		  +"<label style='color: blue;font-size: 2em;text-align: center;'>"
		  +"No se puede modificar el menu, seleccione un menu. </label>"
		  +"<br><img src='../../../lib/images/attention.png' style='margin-left: 43%;width: 10%;'>"
		  +"<br><br>"
		  +"<button class='btn btn-primary' style='margin-left: 39%;margin-top: 6%;    width: 20%;' id='cerrarMenus'> Aceptar </button> "
		+"</div>"); 

}else{
	 redirectTraerData(idMenu);
}


		$("#cerrarMenus").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var volver = "";
		var volver = window.parent.$("#popup");
		$(volver).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

		// cerrar Datos 
	$("#cerrarMenu").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var volver = "";
		var volver = window.parent.$("#popup");
		$(volver).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});


 	 $('#image').change(function(){
 	 	$('#mostrar').empty();
 	 	var imagen= $('#imagen').val();

 	 	if (imagen === "") {
 	 		$('#mostrar').empty();
 	 		$('#estado').css({'background-image': 'url("../../../lib/images/incorrect.png")','background-repeat':' no-repeat','width':'20%','height':'15%'});
 	 	}else{
 	 		$('#estado').css({'background-image': 'url("../../../lib/images/correct.png")','background-repeat':' no-repeat','width':'20%'});
 	 	}

 	 });

	$('#modificarMenu').on("click",function(){
 	 	var idmenu = $("#idmenu").val();
 	 	var nombre = $("#nombre").val();
		var detalleRuta =  $("#detalleRuta").val();
		var nomImagen = $("#imagen").val();

		
		//metodo para obtener el nombre de la imagen
		if (nomImagen === "") {

		}else{
			var img = nomImagen.split('\\');
			var imagen= img[2];
		
		}
		

		if (nombre === "") 
		{
			$('#nombre').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#nombre').css({'color':'','background':'','border':''});
		}

		if (detalleRuta === "") 
		{
			$('#detalleRuta').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#detalleRuta').css({'color':'','background':'','border':''});
		}

		if (imagen === "") 
		{
			$('#estado').css({'background-image': 'url("../../../lib/images/incorrect.png")','background-repeat':' no-repeat','width':'20%','height':'15%'});
		}else{
			$('#estado').css({'background-image': 'url("../../../lib/images/correct.png")','background-repeat':' no-repeat','width':'20%'});
		}


		if (nombre !==""  && detalleRuta !=="" && imagen !="") {
			modifyMenu(idMenu,nombre,detalleRuta,imagen);
		}else{
			$("#msgboxError").fadeTo(200,0.1,function()
			{ 				  
			  $(this).html('No se puede modificar el menu, Favor completar los campos en rojo').addClass('messageboxerror').fadeTo(1500,2);
			});	
		}

 	 });


	$("#CloseSuccess").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var cerrar = window.parent.$("#popup");
		searchAllMenu();
		$(cerrar).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});
	
});