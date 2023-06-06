$( document ).ready(function() {
    $('#fnac').datepicker();
 	cargarPerfiles();
 	cargarCentros();


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


 $('#create').on("click",function(){
 		$("#msgboxError").fadeOut();

		var rut  = $('#rut').val();
		var nombre = $('#nombre').val();
		var centro = $('select[name=centro]').val();
		var estado= $('select[name=estado]').val();
		var apat = $('#apat').val();
		var usuario = $('#usuario').val();
		var tipoPerfil= $('select[name=tipoPerfil]').val();
		//var detallePerfil = $('#tipoPerfil option:selected').text();
		var sexo = $('select[name=sexo]').val();
		var amat = $('#amat').val();
		var clave= $('#clave').val();
		var reingClave =  $('#reingClave').val();


		var fecha = $('input[name=fnac]').val();
		var testo = fecha.split("/");
		var fnac = testo[2]+ "-" + testo[1]+ "-" +testo[0];


		if (rut === "") 
		{
			$('#rut').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#rut').css({'color':'','font-size':'','background':'','border':''});
		}
		if (nombre === "") 
		{
			$('#nombre').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#nombre').css({'color':'','font-size':'','background':'','border':''});
		}
		if (centro === "0") 
		{
			$('#centro').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#centro').css({'color':'','font-size':'','background':'','border':''});
		}
		if (estado === "0") 
		{
			$('#estado').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#estado').css({'color':'','font-size':'','background':'','border':''});
		}
		if (apat === "") 
		{
			$('#apat').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#apat').css({'color':'','font-size':'','background':'','border':''});
		}
		if (fnac === "undefined-undefined-") 
		{
			$('#fnac').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#fnac').css({'color':'','font-size':'','background':'','border':''});
		}
		if (usuario === "") 
		{
			$('#usuario').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#usuario').css({'color':'','font-size':'','background':'','border':''});
		}
		if (tipoPerfil === "0") 
		{
			$('#tipoPerfil').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#tipoPerfil').css({'color':'','font-size':'','background':'','border':''});
		}
		if (amat === "") 
		{
			$('#amat').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#amat').css({'color':'','font-size':'','background':'','border':''});
		}
		if (clave === "") 
		{
			$('#clave').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#clave').css({'color':'','font-size':'','background':'','border':''});
		}

		if (reingClave === "") 
		{
			$('#reingClave').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#reingClave').css({'color':'','font-size':'','background':'','border':''});
		}

		if (sexo === "0") 
		{
			$('#sexo').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#sexo').css({'color':'','font-size':'','background':'','border':''});
		}


		if (rut !== "") {
				// Validacion del Modulo 11
				var Fn = {
			    validaRut : function (rut) {
			        rut = rut.replace("‐","-");
			        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rut ))
			            return false;
			        var tmp     = rut.split('-');
			        var digv    = tmp[1]; 
			        var rut     = tmp[0];
			        if ( digv == 'K' ) digv = 'k' ;        
			        return (Fn.dv(rut) == digv );
			    },
			    dv : function(T){
			        var M=0,S=1;
			        for(;T;T=Math.floor(T/10))
			            S=(S+T%10*(9-M++%6))%11;
			        return S?S-1:'k';
			    }
			}
		       
		    if (Fn.validaRut( $("#rut").val() )){ 
		       	 //alert("El rut Ingresado es Válido");
		       	 console.log('rut valido');
		    } else {
		       	alert("El rut Ingresado No es Válido");
		       	$("#rut").val('');
		    } 

		}else{
			console.log("ctm");
		}
		


		if (clave === reingClave) {
			if (rut != "" && nombre != "" && centro!= "0" && estado!="0" && apat != "" != fnac != "" && usuario!="" && tipoPerfil!="0" && amat !=""  && clave !="" && sexo != "0" ) 
			{
				redirectToCreate(rut,nombre,centro,estado,apat,fnac,usuario,tipoPerfil,amat,clave,sexo);
			//alert("Paso la prueba");

			}else{
				$("#msgboxError").fadeTo(200,0.1,function()
				{ 				  
				  $(this).html('No se puede buscar, Favor completar los campos en rojo').addClass('messageboxerror').fadeTo(1500,2);
				});	

			}
		}else{
			$("#msgboxError").fadeTo(200,0.1,function()
			{ 				  
			  $(this).html('Las claves proporcionadas no son iguales, Reingrese sus claves').addClass('messageboxError').fadeTo(1500,2);
			});
			 $('#reingClave').val('');
			 $('#clave').val('');
			 $('#clave').css({'color':'red','border':'solid 1px red'});
			 $('#reingClave').css({'color':'red','border':'solid 1px red'});
			 $('#largo').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
			 $('#minuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
			 $('#mayuscula').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
			 $('#numero').css({'padding-left': '1px',' line-height':' 5px','color':' #ec3f41'});
			 
		}
	
	});


	
	// cerrar Datos 
	$("#cancelar").on("click",function(){
		//con este metodo obtienes el id del popup que te permite poder cerrar esto 
		var volver = window.parent.$("#popup");
		$(volver).fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});



	//Metodo que permite presionar el boton crear a traves del ENTER
	$("#rut").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#create").click();
		}
	});

	$("#nombre").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#create").click();
		}
	});

	$("#clave").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#create").click();
		}
	});

	$("#rut").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#create").click();
		}
	});

	$("#usuario").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#create").click();
		}
	});

	$("#amat").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#create").click();
		}
	});
    
});
