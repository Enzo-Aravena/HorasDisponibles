$( document ).ready(function() {	
	var ejemploRut = "(Ejemplo: 18985652-5)";
	$("#valorRadio").html(ejemploRut);
	$('#loader').hide();

	$("#botones").hide();
	$("#cuerpoUno").hide();
	$("#estados").hide();
	$("#Error").hide();
	
	$("#gestionClave").hide();


	$('#ejecutar').on("click",function(){
		$("#cuerpoUno").hide();
		//limpia la tabla
		$('#buscar').css({'color':'','border':''});
		$('#tabla_resultados').empty();
		var rdbBuscar= $('input:radio[name=rdbBuscar]:checked').val();
		var buscar= $('#buscar').val();
			if (rdbBuscar === "rut") {
				if (buscar !== "") {
					var Fn = {
					    validaRut : function (buscar) {
					        buscar = buscar.replace("‐","-");
					        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( buscar ))
					            return false;
					        var tmp     = buscar.split('-');
					        var digv    = tmp[1]; 
					        var buscar     = tmp[0];
					        if ( digv == 'K' ) digv = 'k' ;        
					        return (Fn.dv(buscar) == digv );
					    },
					    dv : function(T){
					        var M=0,S=1;
					        for(;T;T=Math.floor(T/10))
					            S=(S+T%10*(9-M++%6))%11;
					        return S?S-1:'k';
					    }
					}
				    if (Fn.validaRut( $("#buscar").val())){
				    	buscarUsuarioOmiPorRut(buscar);
				    }else{
				    	$("#cuerpoUno").show();
				    	$('#buscar').val('');
				    	$('#tabla_resultados').append("<tr>"+"<td class='check hidden-xs'><label>"
						+"<td colspan=7 > El rut ingresado no es válido, Ingrese el rut nuevamente ... </td>");
					}						
				}else{						
					$('#buscar').css({'color':'red','border':'solid 1px red'});
					$("#cuerpoUno").show();
					$('#tabla_resultados').append("<tr>"+"<td class='check hidden-xs'><label>"
					+"<td colspan=7 > Campo en blanco. Complete el campo vacío </td>");
				}// end if interno
			}else 								
				if (rdbBuscar === "username") {
					if (buscar !== "") {
						buscarUsuarioOmiPorNombre(buscar);
					}else{
					$("#cuerpoUno").show();
					$('#tabla_resultados').append("<tr>"+"<td class='check hidden-xs'><label>"
					+"<td colspan=7 > No se han encontrado registros ... </td>");
					}//end if interno
				}else{
					$("#cuerpoUno").show();
					$('#tabla_resultados').append("<tr>"+"<td class='check hidden-xs'><label>"
					+"<td colspan=7 > No se han encontrado registros ... </td>");
				}// end else
	});


	
	$('#cambiarEstado').on("click",function(){
		$("#mensaje").empty();

		var usuarioSesion= $("#usuario").val();

		$('#estado').css({'color':'','font-size':'','background':'','border':''});
			var datos= $('input:radio[name=obtener]:checked').val();
			if (datos === "undefined" || datos === undefined) {
				$("#habilitar").hide();
				$("#ModificacionExistosa").hide();
				$("#ModificacionError").hide();
				
				$("#Error").show();
				 //POPUP       	 	
			   		$('#estados').fadeIn('slow');
					$('.popup-overlay').fadeIn('slow');
					$('.popup-overlay').height($(window).height());				
					return false;
				// END POPUP		
			}else{
				$("#habilitar").show();
				$("#ModificacionExistosa").hide();
				$("#ModificacionError").hide();
				$("#Error").hide();
				var sd= datos.split("_");
				var estad = sd[2];
				$("#estado").val(estad);
				 //POPUP       	 	
			   		$('#estados').fadeIn('slow');
					$('.popup-overlay').fadeIn('slow');
					$('.popup-overlay').height($(window).height());				
					return false;
				// END POPUP		
			}
	});


	
	$("#modOk").click(function(){
		$('#estados').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

	$("#modError").click(function(){
		$('#estados').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});




	$("#Cancelar").click(function(){
		$('#estados').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

	$("#cerrado").click(function(){
		$('#estados').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

	$("#eerror").click(function(){
		$('#estados').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});


//ENVIA LOS DATOS PARA MODIFICAR
	$("#Aceptar").on("click",function(){
		var datos= $('input:radio[name=obtener]:checked').val();
		var usuarioSesion= $("#usuario").val();
		var sd= datos.split("_");
		var rut = sd[0];
		var perId = sd[3];
		var estad = sd[2];

		var estado = $("#estado").val();
		if (estado === "sele") {

			$('#estado').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#estado').css({'color':'','font-size':'','background':'','border':''});
		}

		if (estado !== "sele") {
			//OMI
			modificarEstadoUsuario(perId,estado);
			modificarEstadoUsuarioMysql(perId,estado,rut,usuarioSesion);
			InsertarLogUsuario(rut,usuarioSesion,estado);
		}else{
			console.log("No guardo nada");
			var mens = "no ha seleccionado nada, seleccione un estado";
			$("#mensaje").append("<label style='color: red;'>"+mens+"</label>");
		}


	});


/*************************************************************************************************************/

	$("#CerrarOk").click(function(){
		$('#ValidacionesClaves').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});



	$("#cerradoValiClave").click(function(){
		$('#ValidacionesClaves').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});


/************************************  Contraseña **********************************************************/


$('#cambiarClave').on("click",function(){
		$("#msjes").empty();
		$('#clave').css({'color':'','font-size':'','background':'','border':''});
		$('#reingClave').css({'color':'','font-size':'','background':'','border':''});
		$("#clave").val('');
		$("#reingClave").val('');
		$("#ErrorMoSeleccion").hide();

		$('#minuscula').css({'color':'black'});
		$('#mayuscula').css({'color':'black'});
		$('#numero').css({'color':'black'});
		$('#largo').css({'color':'black'});

		$('#estado').css({'color':'','font-size':'','background':'','border':''});
			var datos= $('input:radio[name=obtener]:checked').val();
			if (datos === "undefined" || datos === undefined) {
				$("#claves").hide();
				$("#ErrorMoSeleccion").show();
				 //POPUP       	 	
			   		$('#erroresClave').fadeIn('slow');
					$('.popup-overlay').fadeIn('slow');
					$('.popup-overlay').height($(window).height());				
					return false;
				// END POPUP		
			}else{
				$("#claves").show();
				$("#ErrorClave").hide();
				var sd= datos.split("_");
				var estad = sd[2];
				$("#ErrorMoSeleccion").hide();
				$("#estado").val(estad);
				 //POPUP       	 	
			   		$('#gestionClave').fadeIn('slow');
					$('.popup-overlay').fadeIn('slow');
					$('.popup-overlay').height($(window).height());				
					return false;
				// END POPUP		
			}
	});


	$('#AceptarSi').on("click",function(){
		$("#msjes").empty();

		var datos= $('input:radio[name=obtener]:checked').val();
		var usuarioSesion= $("#usuario").val();
		var sd= datos.split("_");
		var rut = sd[0];
		var username = sd[1];
		var perId = sd[3];
		var estado = 2;
		
		var clave = $("#clave").val();
		var reingclave = $("#reingClave").val();


		if (clave === "") {
			$('#clave').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#clave').css({'color':'','font-size':'','background':'','border':''});
		}

		if (reingclave === "") {
			$('#reingClave').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#reingClave').css({'color':'','font-size':'','background':'','border':''});
		}

		if (clave !== "" && reingclave !=="") {
			if (clave === reingclave) {
				modificarClaveUsuariMysql(username,perId,clave,rut);
				InsertarLogUsuario(rut,usuarioSesion,estado);

			}else{
				console.log("No guardo nada");
				var mens = "las claves ingresadas no son iguales.";
				$("#msjes").append("<label style='color: red;'>"+mens+"</label>");
			}
		}else{
				console.log("No guardo nada");
				var mens = "campos en blanco, complete los campos en rojo";
				$("#msjes").append("<label style='color: red;'>"+mens+"</label>");
		}	

	});


	$("#OkErrorClave").click(function(){
		$('#erroresClave').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});




	$("#cerradoClaveErrror").click(function(){
		$('#erroresClave').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});


	$("#Cancelara").click(function(){
		$('#gestionClave').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

	$("#cerradoa").click(function(){
		$('#gestionClave').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

	$("#cerrando").click(function(){
		$('#gestionClave').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});


		 $('#clave').keyup(function() {
	 	var clave = $('#clave').val();
	 	 if (clave.length  >= 6 && clave.length  <= 10 ) {
	 	  $('#largo').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      longitud = false;
	    } else {
	       $('#largo').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      longitud = true;
	    }

	    //Valida si es minusculas
	    if (clave.match(/[a-z]/)) {	 
	       $('#minuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      minuscula = true;
	    } else {
	      $('#minuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      minuscula = false;
	    }

	    // VALIDA SI HAY MAYUSCULAS
	    if (clave.match(/[A-Z]/)) {
	       $('#mayuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      mayuscula = true;
	    } else {
	      $('#mayuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      mayuscula = false;
	    }

	    // VALIDA SI EXISTEN NUMEROS EN EL CAMPO TEXTO
	    if (clave.match(/\d/)) {
	       $('#numero').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      numero = true;
	    } else {
	      $('#numero').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      numero = false;
	    }
	  });


	  $('#reingClave').keyup(function() {
		var reingClave= $('#reingClave').val();
		var clave = $('#clave').val();
	 	 if ((reingClave.length  >= 6 && reingClave.length  <= 10) && (clave.length  >= 6 && clave.length  <= 10 ) ) {
	 	  $('#largo').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      longitud = false;
	    } else {
	       $('#largo').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      longitud = true;
	    }

	    //Valida si es minusculas
	    if (reingClave.match(/[a-z]/)) {	 
	       $('#minuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      minuscula = true;
	    } else {
	      $('#minuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      minuscula = false;
	    }

	    // VALIDA SI HAY MAYUSCULAS
	    if (reingClave.match(/[A-Z]/)) {
	       $('#mayuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      mayuscula = true;
	    } else {
	      $('#mayuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      mayuscula = false;
	    }

	    // VALIDA SI EXISTEN NUMEROS EN EL CAMPO TEXTO
	    if (reingClave.match(/\d/)) {
	       $('#numero').css({'padding-left': '1px',' line-height':' 5px','color':' #3a7d34'});
	      numero = true;
	    } else {
	      $('#numero').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
	      numero = false;
	    }
	  });


/************************************  Contraseña **********************************************************/


		 
	//change
	$("input:radio[name=rdbBuscar]").change(function(){
 		 var valor=$("input:radio[name=rdbBuscar]:checked").val();
 		 if (valor === "rut") 
 		 {
 		 	$("#buscar").val('');
 		 	$("#buscar").prop('disabled', false);
 		 	var ejemploRut = "(Ejemplo: 18985652-5)";
 		 	$("#valorRadio").html(ejemploRut);
 		 }else{	 		 	
		 		$("#buscar").val('');
		 		$("#buscar").prop('disabled', false);
		 		var usuario = "(Ejemplo: amartinez)";
		 	    $("#valorRadio").html(usuario);
 		 } 		 	
	});


		 //Evento que permite ingresar con el ENTER una busqueda
	 $('#buscar').keypress(function(event){
	 	if ( event.which == 13 ) {
			$("#ejecutar").click();
		}
	 });


});