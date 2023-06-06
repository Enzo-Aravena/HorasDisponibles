$(function (){

		$('#modificar').on("click",function(){
			$("#msgboxError").fadeOut();
			

		var rut  = $('#rut').val();
		var nombre = $('#nombre').val();
		var centro = $('select[name=centro]').val();
		var estado= $('select[name=estado]').val();
		var apat = $('#apat').val();
		var usuario = $('#usuario').val();
		var tipoPerfil= $('select[name=tipoPerfil]').val();
		var sexo = $('select[name=sexo]').val();
		var amat = $('#amat').val();
		var fecha= $('input[name=fnac]').val();
		var d=new Date(fecha.split("/").reverse().join("-"));
		var dd=d.getDate()+1;
		var mm=d.getMonth()+1;

		if (dd>10) 
		{
			var dia = dd;
		}else{
			var dia = "0" + dd;
		}

		//valida si el mes ingresado es mayor a 10 si es asi no le agrega un cero
		if (mm>10) 
		{
			var mes=mm;
		}else{
			var mes= "0" + mm;
		}
		
		var yy=d.getFullYear();
		var  fnac  =yy+"-"+mes+"-"+dia;

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
		if (fecha === "") 
		{
			$('#fnac').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#fnac').css({'color':'','font-size':'','background':'','border':''});
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

		if (sexo === "0") 
		{
			$('#sexo').css({'color':'red','border':'solid 1px red'});
		}else{
			$('#sexo').css({'color':'','font-size':'','background':'','border':''});
		}


			if (rut != "" && nombre != "" && centro!= "0" && estado!="0" && apat != "" != fnac != "" && usuario!="" && tipoPerfil!="0" && amat !="" &&sexo != "0") 
			{
				redirectToModify(rut,nombre,centro,estado,apat,fnac,sexo,usuario,tipoPerfil,amat);

			}else{
				$("#msgbox").fadeTo(200,0.1,function()
				{ 				  
				  $(this).html('No se puede buscar, Favor completar los campos en rojo').addClass('messageboxerror').fadeTo(1500,2);
				});	

			}

	
	});


	//Metodo que permite presionar el boton crear a traves del ENTER
	$("#nombre").keypress(function( event ) {
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