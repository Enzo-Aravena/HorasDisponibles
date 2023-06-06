$( document ).ready(function() {

	//window.parent.$("#loader").show();

	$("#ejecutar").hide();
	$("#buscar").prop('disabled', true);
	searchAllMenu();
	 $('#ejecutar').on("click",function(){
	 	var rdbBuscar= $('input:radio[name=rdbBuscar]:checked').val();
		var buscar  = $('#buscar').val();
		if (rdbBuscar == "todo") {
			$('#loader').show();
				$('#buscar').val('');
				searchAllMenu();
			}else{
				if (buscar === "")
				{
					$('#buscar').css({'color':'red','border':'solid 1px red'});
				}else{
					$('#buscar').css({'color':'','font-size':'','background':'','border':''});
				}

				if (buscar !== "") {
					$('#tabla_resultados').empty();
					window.parent.$("#loader").show();
					searchByName(rdbBuscar,buscar);
				}else{
					$("#msgbox").fadeTo(200,0.1,function()
					{
					  $(this).html('No se puede buscar, Favor completar el campo en rojo').addClass('messageboxerror').fadeTo(1500,2);
					});
				}
			}
	 });

	  $("input:radio[name=rdbBuscar]").change(function(){
 		var valor=$("input:radio[name=rdbBuscar]:checked").val();
 		if (valor === "name")
 		{
 			$("#buscar").prop('disabled', false);
 			$("#ejecutar").show();
 			var nombre = "(Ejemplo: Agenda)";
 		    $("#valorRadio").html(nombre);
 		    $("#buscar").val('');
 		}else
 		{
 			window.parent.$("#loader").show();
 			$("#buscar").prop('disabled', true);
 			$("#valorRadio").empty();
 			$("#ejecutar").hide();
 			$("#buscar").val('');
 			searchAllMenu();
 		}
	 });

	 // metodo que permite ejecutar el eventro a traves de presionar enter
 	 $('#buscar').keypress(function(event){
	 	if ( event.which == 13 ) {
			$("#ejecutar").click();
		}
	 });

/**************** POPUP CREAR Y MODIFICAR  ***************/
	$('#createMenu').click(function(){
		$('#popup').fadeIn();
		$("#contenidos").attr("src","../../administradorMenu/vista/crearMenu.php");
		$('.popup-overlay').fadeIn();
		$('.popup-overlay').height($(window).height());
		return false;
	});

	$('#modMenu').click(function(){		
		var nombre = $('input:radio[name=obtener]:checked').val();
        $("#contenidos").attr("src","../../administradorMenu/vista/modificarMenu.php?nombre="+nombre);             
        $('#popup').fadeIn();
		$('.popup-overlay').fadeIn();
		$('.popup-overlay').height($(window).height());
		return false;	
	});

	//Metodo que cierra los popup`s  CREAR Y MODIFICAR 
	$('#close').click(function(){
		$('#popup').fadeOut();
		$('.popup-overlay').fadeOut();
		return false;
	});
/**************** FIN POPUP CREAR Y MODIFICAR  ***************/

/**************** POPUP ASIGNAR PERFILES  *******************/
	$('#perfiles').click(function(){		
        $("#asignarPerfiles").attr("src","../../administradorMenu/vista/asignar.php");
        $('#perfil').fadeIn();
		$('.popup-overlay').fadeIn();
		$('.popup-overlay').height($(window).height());
		return false;
	});

	$('#cerrarPerf').click(function(){
		$('#perfil').fadeOut();
		$('.popup-overlay').fadeOut();
		return false;
	});

/**************** FIN POPUP ASIGNAR PERFILES  ***************/

/**************** POPUP DESASIGNAR MENU  ***************/
	$('#Desasignar').click(function(){
        $("#desasignarPerfiles").attr("src","../../administradorMenu/vista/desasignarMenu.php");
        $('#eliminarVinculo').fadeIn();
		$('.popup-overlay').fadeIn();
		$('.popup-overlay').height($(window).height());
		return false;
	});

	$('#cerrarDes').click(function(){
		$('#eliminarVinculo').fadeOut();
		$('.popup-overlay').fadeOut();
		return false;
	});
/**************** FIN POPUP DESASIGNAR MENU  ***************/

/**************** POPUP ELIMINAR MENU  ***************/
$('#deleteMenu').click(function(){
		var nombre = $('input:radio[name=obtener]:checked').val();
        $("#borrarMenu").attr("src","../../administradorMenu/vista/eliminarMenu.php?nombre="+nombre);
        $('#eliminarMenu').fadeIn();
		$('.popup-overlay').fadeIn();
		$('.popup-overlay').height($(window).height());
	});

	// borrar menu
	$('#cerrarDelete').click(function(){
		$('#eliminarMenu').fadeOut();
		$('.popup-overlay').fadeOut();
		return false;
	});
/**************** FIN POPUP ELIMINAR MENU  ***************/

});