$(function (){
	$("#buscar").prop('disabled', true);
		$('#loader').hide();

		buscarTodo();

	$('#ejecutar').on("click",function(){
		//limpia la tabla
		$('#tabla_resultados').empty();
		var rdbBuscar= $('input:radio[name=rdbBuscar]:checked').val();
		var buscar= $('#buscar').val();
		
		if (rdbBuscar === "todo")
		{
			redirectUser(rdbBuscar,buscar);
		} else
			{			
				if (rdbBuscar === "rut") {
					if (buscar !== "") {
						redirectUser(rdbBuscar,buscar);
					}else{
						$('#tabla_resultados').append("<tr>"+"<td class='check hidden-xs'><label>"
							+"<td > No se han encontrado registros ... </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>");
					}// end if interno

				}else 
					
					if (rdbBuscar === "name") 
					{
						if (buscar !== "") {
							redirectUser(rdbBuscar,buscar);
						}else{
							$('#tabla_resultados').append("<tr>"+"<td class='check hidden-xs'><label>"
							+"<td > No se han encontrado registros ... </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>");
						}//end if interno
					}else 
						if (rdbBuscar === "username") {
							if (buscar !== "") {
								redirectUser(rdbBuscar,buscar);
							}else{
								$('#tabla_resultados').append("<tr>"+"<td class='check hidden-xs'><label>"
							+"<td > No se han encontrado registros ... </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>");
							}//end if interno
						}else{
							$('#tabla_resultados').append("<tr>"+"<td class='check hidden-xs'><label>"
							+"<td > No se han encontrado registros ... </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>");
						}// end else
			}// end Else principal
	});


	// Abre el popup que crea a los usuarios
	$('#crearUsuario').click(function(){
		$('#popup').fadeIn('slow');
		$("#contenido").attr("src","../../registerUsers/vista/createUser.php");
		$('.popup-overlay').fadeIn('slow');
		$('.popup-overlay').height($(window).height());
		return false;
	});


	//Metodo que cierra los popup`s del sistema
	$('#close').click(function(){
		$('#popup').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

	// Abre popup que modifica al usuario seleccionado
	$('#modificarUsuario').click(function(){		
		var datos = $('input:radio[name=obtener]:checked').val();

		if (datos == undefined || datos == "undefined") {
			 $("#contenta").attr("src","../../registerUsers/vista/modifyUsers.php?rut="+datos);      
	        $('#modificarUsu').fadeIn('slow');             	
			$('.popup-overlay').fadeIn('slow');
			$('.popup-overlay').height($(window).height());
		}else{
			var sd= datos.split("_");
			var rut = sd[0];

			 $("#contenta").attr("src","../../registerUsers/vista/modifyUsers.php?rut="+rut);      
	        $('#modificarUsu').fadeIn('slow');             	
			$('.popup-overlay').fadeIn('slow');
			$('.popup-overlay').height($(window).height());
		}
		
	});

	$('#cerrando').click(function(){
		$('#modificarUsu').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});



/*********************************************************************************************/
	// Abre popup que modifica LA CONTRASEÑA
	$('#cambiarClave').click(function(){	
		var datos = $('input:radio[name=obtener]:checked').val();

		if (datos == undefined || datos == "undefined") {
			$("#contenidoClave").attr("src","../../registerUsers/vista/confirmacion.php?usuario="+datos);
	        $('#contraseña').fadeIn('slow');             	
			$('.popup-overlay').fadeIn('slow');
			$('.popup-overlay').height($(window).height());
		}else{
			var sd= datos.split("_");
			var usuario = sd[0];

			$("#contenidoClave").attr("src","../../registerUsers/vista/confirmacion.php?usuario="+usuario);    
	        $('#contraseña').fadeIn('slow');             	
			$('.popup-overlay').fadeIn('slow');
			$('.popup-overlay').height($(window).height());
		}
		
	});

	//Metodo que cierra los popup`s del sistema
	$('#cerrandoClaves').click(function(){
		$('#contraseña').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});
/*********************************************************************************************/
	// Abre popup que elimina al usuario
	$('#eliminarUsuarios').click(function(){	
		var datos = $('input:radio[name=obtener]:checked').val();

		if (datos == undefined || datos == "undefined") {
		$("#detalle").attr("src","../../registerUsers/vista/eliminarUsuarios.php?rut="+datos+"&"+"clave="+datos);      
        $('#eliminarDato').fadeIn('slow');             	
		$('.popup-overlay').fadeIn('slow');
		$('.popup-overlay').height($(window).height());
		}else{
			var sd= datos.split("_");
			var rut = sd[0];
			var idclave = sd[1];

			$("#detalle").attr("src","../../registerUsers/vista/eliminarUsuarios.php?rut="+rut+"&"+"clave="+idclave);      
	        $('#eliminarDato').fadeIn('slow');             	
			$('.popup-overlay').fadeIn('slow');
			$('.popup-overlay').height($(window).height());
		}
	
		
	});

		//Metodo que cierra los popup eliminar del sistema
	$('#cerrar').click(function(){
		$('#eliminarDato').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});
	

	$('#cambiarEstado').click(function(){		
		var datos = $('input:radio[name=obtener]:checked').val();

		if (datos == undefined || datos == "undefined") {
			$("#content").attr("src","../../registerUsers/vista/deshabilitarUsuario.php?rut="+datos);      
		    $('#estados').fadeIn('slow');             	
			$('.popup-overlay').fadeIn('slow');
			$('.popup-overlay').height($(window).height());	
		}else{
			var sd= datos.split("_");
			var rut = sd[0];

			$("#content").attr("src","../../registerUsers/vista/deshabilitarUsuario.php?rut="+rut); 
		    $('#estados').fadeIn('slow');             	
			$('.popup-overlay').fadeIn('slow');
			$('.popup-overlay').height($(window).height());	
		}
	});
	

	$('#cerrado').click(function(){
		$('#estados').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});	
	

	//valida si el radio seleccionado muestra un mensaje u otro
	 $("input:radio[name=rdbBuscar]").change(function(){
	 		 var valor=$("input:radio[name=rdbBuscar]:checked").val();
	 		 if (valor === "rut") 
	 		 {
	 		 	$("#buscar").val('');
	 		 	$("#buscar").prop('disabled', false);
	 		 	var ejemploRut = "(Ejemplo: 18985652-5)";
	 		 	$("#valorRadio").html(ejemploRut);
	 		 }else
	 		 	if (valor === "name") 
	 		 	{
	 		 		$("#buscar").val('');
	 		 		$("#buscar").prop('disabled', false);
	 		 		var nombre = "(Ejemplo: maria)";
	 		 	    $("#valorRadio").html(nombre);

	 		 	}else 
	 		 		if (valor === "username") {
	 		 			$("#buscar").val('');
	 		 			$("#buscar").prop('disabled', false);
	 		 			var usuario = "(Ejemplo: amartinez)";
	 		 	        $("#valorRadio").html(usuario);
	 		 		}else{
	 		 				buscarTodo();
	 		 			$("#buscar").val('');
	 		 			$("#buscar").prop('disabled', true);
	 		 	        $("#valorRadio").empty();
						$("#valorRadio").empty();
						$("#valorRadio").empty();

	 		 		}
	 });


	 //Evento que permite ingresar con el ENTER una busqueda
	 $('#buscar').keypress(function(event){
	 	if ( event.which == 13 ) {
			$("#ejecutar").click();
		}
	 });
           

});

