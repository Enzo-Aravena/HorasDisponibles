$(document).ready(function() {
    $('#desde').datetimepicker();
	$("#mostrar").hide();
	$("#Mensaje").hide();
	$("#mostrarCampoDni").hide();

$("#desde").datetimepicker({
    onSelect: function() { 
        var dateObject = $(this).datetimepicker('getDate'); 
    }
});
	var permisos = $("#permisos").val();

	switch(permisos){
		case '7':
			$('#tabla1').hide();
			$('#tabla2').show();
			$("#tabla2").addClass("active").show(); 


			$("ul.nav li").removeClass("active");
			var href = "#tab2";
			$(href).addClass("active");
			$(".tab_content").hide();
			$(href).fadeIn();			
			$('[href="#tab2"]').tab('show');

		break;
		case '8':
			$('#tabla2').hide();
			$('#tabla1').show();

			$("ul.nav li").removeClass("active");
			var href = "#tab1";
			$(href).addClass("active");
			$(".tab_content").hide();
			$(href).fadeIn();			
			$('[href="#tab1"]').tab('show');
		break;
		default:
			$('#tabla2').show();
			$('#tabla1').show();

				//TAB CONTENT
			$(".tab_content").hide(); 
			$("ul.nav li:first").addClass("active").show(); 
			$(".tab_content:first").show();
			$("ul.nav li").click(function() {
				$("ul.nav li").removeClass("active");
				$(this).addClass("active");
				$(".tab_content").hide();
				var activeTab = $(this).find("a").attr("href");
				$(activeTab).fadeIn();
				return false;
			});	
			
		break;
	}


$('#abrirPopUp').on("click",function(){
		//alert("muestra");
		$("#manualUsuario").modal();
	});


/*REALIZA LA VALIDACION MIENTAS SE DIGITA EL RUT CONOCIDO COMO MODULO 11*/
$('#rut').keyup(function(){
	$("#validacionRut").empty();
	$("#validacion").empty();
	var rut = $("#rut").val();

	if(rut === ""){
		$("#validacionRut").empty();
		$('#rut').css({'color':'','border':''});
	}else{
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
			$('#rut').css({'color':'','border':''});
			var mje = "Rut valido";
			$("#validacionRut").html(mje);
		}else{
			var mje = "Rut incorrecto,Ingrese un rut Válido";
			$("#validacion").html(mje);
			$('#rut').css({'color':'red','border':'solid 1px red'});
		}
	}
});

/* VALIDACION DE DNI*/
$('#dni').keyup(function(){
	$("#validacionDni").empty();
	$("#validacionDniOk").empty();
	var rut = $('#dni').val();
	var dni = $('#dni').val();

	if(dni === ""){
		$("#validacionDni").empty();
		$('#dni').css({'color':'','border':''});
	}else{
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
	
		if (Fn.validaRut( $("#dni").val() )){
			//nose puede ingresar rut aqui
			$('#dni').css({'color':'red','border':'solid 1px red'});
			var mje = "No se puede ingresar el rut en la opcion de DNI";
			$("#validacionDni").html(mje);
			//$("#dni").val('');
		}else{
			if (dni.length < 7 ) {
				$('#dni').css({'color':'red','border':'solid 1px red'});
				var mje = "DNI incorrecto,Ingrese un DNI Válido";
				$("#validacionDni").html(mje);
			}else{
				$('#dni').css({'color':'','border':''});
				var mje = "DNI valido";
				$("#validacionDniOk").html(mje);
			}
		}
	}
	
});

/* VALIDACION DE NOMBRE*/
$('#nombre').keyup(function(){
	$("#validaNombre").empty();
	$("#validaNombreOk").empty();

	var nombre = $('#nombre').val();

	if (nombre < 7 ) {
		$('#nombre').css({'color':'red','border':'solid 1px red'});
		var mje = "Campo en blanco, complete el nombre";	
		$("#validaNombre").html(mje);
	}else{
		$('#nombre').css({'color':'','border':''});
    	var mje = "Nombre Valido";	
		$("#validaNombreOk").html(mje); 
	}
});



$('#ejecutar').on('click', function(){
	$("#validacionRut").empty();
	$("#validacion").empty();
	$("#validacionDni").empty();
	$("#validacionDniOk").empty();
	$("#validaNombre").empty();
	$("#validaNombreOk").empty();

	var rut = $("#rut").val();
 	var nombre = $("#nombre").val();
 	var img_select = $("#img_select").val();
 	var fecha = $('input[name=desde]').val();
 	var dni = $("#dni").val();

 	if (rut === "") {
		$('#rut').css({'color':'red','border':'solid 1px red'});
		var mje = "Rut incorrecto,Ingrese un rut Válido";	
		$("#validacion").html(mje);
	}else{
		$('#rut').css({'color':'','border':''});
    	var mje = "Rut valido";	
		$("#validacionRut").html(mje);   
	}

	if (dni === "" ) {
		$('#dni').css({'color':'red','border':'solid 1px red'});
		var mje = "DNI incorrecto,Ingrese un DNI Válido";	
		$("#validacionDni").html(mje);
	}else{
		$('#dni').css({'color':'','border':''});
    	var mje = "DNI valido";	
		$("#validacionDniOk").html(mje); 
	}

	if (nombre === "") {
		$('#nombre').css({'color':'red','border':'solid 1px red'});
		var mje = "Campo en blanco, complete el nombre";	
		$("#validaNombre").html(mje);
	}else{
		$('#nombre').css({'color':'','border':''});
    	var mje = "Nombre Valido";	
		$("#validaNombreOk").html(mje);
	}

	if (fecha === "") {
		$('#desde').css({'color':'red','border':'solid 1px red'});
		var mje = "campo en blanco,complete";	
		$("#validaFecha").html(mje);
	 			
	}else{
		$('#desde').css({'color':'','border':''});
		$("#validaFecha").empty();
	}

	if (img_select === "" ) {
		$('#img_select').css({'color':'red','border':'solid 1px red'});
		var mje = "No ha seleccionado nada, Seleccione Imagen a subir";	
		$("#ErrorArchivo").html(mje);
	}else{
		$('#img_select').css({'color':'','border':''});
		$("#ErrorArchivo").empty();
	}

	if ($("#mostrarCampoRut").is(":visible")) {
		if (rut === "" && nombre === "" && fecha === "" && img_select === "" ) {
			$('#desde').css({'color':'red','border':'solid 1px red'});
			$('#rut').css({'color':'red','border':'solid 1px red'});
			$('#nombre').css({'color':'red','border':'solid 1px red'});
			$('#img_select').css({'color':'red','border':'solid 1px red'});	

			$("#mensaje").empty();
			var texto = "<h3> Campos en blanco, por favor complete los datos solicitados. </h3>";
			$("#mensaje").append(texto);
			$("#myModal").modal();

		}else{
			if (rut !== "" && nombre !== "" && fecha !== "" && img_select !== "" ) {
				$('#rut').css({'color':'','border':''});
		    	$('#nombre').css({'color':'','border':''});
				$('#img_select').css({'color':'','border':''});
				$('#desde').css({'color':'','border':''});
				$('#upload_form').submit();
			}			
		}
	}else{
		if (dni === "" && nombre === "" && fecha === "" && img_select === "" ) {
			$('#desde').css({'color':'red','border':'solid 1px red'});
			$('#dni').css({'color':'red','border':'solid 1px red'});
			$('#nombre').css({'color':'red','border':'solid 1px red'});
			$('#img_select').css({'color':'red','border':'solid 1px red'});	

			$("#mensaje").empty();
			var texto = "<h3> Campos en blanco, por favor complete los datos solicitados. </h3>";
			$("#mensaje").append(texto);
			$("#myModal").modal();

		}else{
			if (dni !== "" && nombre !== "" && fecha !== "" && img_select !== "" ) {
				$('#dni').css({'color':'','border':''});
		    	$('#nombre').css({'color':'','border':''});
				$('#img_select').css({'color':'','border':''});
				$('#desde').css({'color':'','border':''});
				$('#upload_form').submit();
			}			
		}
	}
});


$('#upload_form').on('submit', function(e){
 	e.preventDefault();
 	 	$("#validacion").empty();
 	$("#ErrorArchivo").empty();
 	
 	var rut = $("#rut").val();
 	var nombre = $("#nombre").val();
 	var img_select = $("#img_select").val();
 	var fecha = $('input[name=desde]').val();
 	var f = $("#FechaS").val();
 	var dni = $("#dni").val();
	
 	if ($("#mostrarCampoRut").is(":visible")) {
 		$('#nombre').css({'color':'','border':''});
 		$('#rut').css({'color':'','border':''});
		$('#desde').css({'color':'','border':''});
		$('#img_select').css({'color':'','border':''});

 		if (rut === "") {
	 		$('#rut').css({'color':'red','border':'solid 1px red'});				
	 		var mje = "Rut incorrecto,Ingrese un rut Válido";	
			$("#validacion").html(mje);
	 		e.preventDefault();
	 	}else
	 		if (nombre === "") {
	 		$('#nombre').css({'color':'red','border':'solid 1px red'});
				
	 		var mje = "campo en blanco,complete";	
			$("#validaNombre").html(mje);
	 		e.preventDefault();
	 	}else
	 		if (fecha === "") {
	 			$('#desde').css({'color':'red','border':'solid 1px red'});
	 			var mje = "campo en blanco,complete";	
				$("#validaFecha").html(mje);
	 			
	 	}else
	 		if (img_select === "" ) {
	 			$('#img_select').css({'color':'red','border':'solid 1px red'});

	 			var mje = "No ha seleccionado nada, Seleccione Imagen a subir";	
				$("#ErrorArchivo").html(mje);
	 			e.preventDefault();
	 		}else{

	 			 $.ajax({

					url : "../controlador/servidor/dentalController.php",
					method : "POST",
					data: new FormData(this),f,
					contentType:false,
					processData:false,
					beforeSend:function(response){
						console.log("Peticion Recibida");
					},
					success:function(response){
						resultado = response;	

					if (resultado === "correcto") {

						$('#nombre').val('');
				 		$('#rut').val('');
						$('#desde').val('');
						$('input[type="text"]').val('');
						$('#desde').val("").datetimepicker("update");
						document.getElementById("img_select").value = "";
						$("#PesoArchivo").empty();
						$("#selectedFiles").empty();	
						$("#validacionMsje").empty();
						$("#validaNombre").empty();
						$("#ErrorArchivo").empty();
						$("#validacionDniOk").empty();
						$("#validaNombreOk").empty();
						$("#validacionRut").empty();

							$("#mensaje").empty();
							var texto = "<h3> Imagenes Subidas Correctamente. </h3>";
							$("#mensaje").append(texto);
							$("#myModal").modal();
						}else{
							$("#mensaje").empty();
							var texto = "<h3> Error al subir las imagenes. </h3>";
							$("#mensaje").append(texto);
							$("#myModal").modal();
						}

				},
					error:function(e){
						console.log("Error en el sistema");
					}
			 	});
	 		}

 	}else{
 		$('#nombre').css({'color':'','border':''});
 		$('#dni').css({'color':'','border':''});
		$('#desde').css({'color':'','border':''});
		$('#img_select').css({'color':'','border':''});

 		if (dni === "") {
	 		$('#dni').css({'color':'red','border':'solid 1px red'});
				
	 		var mjea = "DNI incorrecto, Ingrese un DNI valido";	
			$("#validacionMsje").html(mjea);
	 		e.preventDefault();
	 	}else
	 		if (nombre === "") {
	 		$('#nombre').css({'color':'red','border':'solid 1px red'});
				
	 		var mje = "campo en blanco,complete";	
			$("#validaNombre").html(mje);
	 		e.preventDefault();
	 	}else
	 		if (fecha === "") {
	 			$('#desde').css({'color':'red','border':'solid 1px red'});
	 	}else
	 		if (img_select === "" ) {
	 			$('#img_select').css({'color':'red','border':'solid 1px red'});
 
	 			var mje = "No ha seleccionado nada, Seleccione Imagen a subir";	
				$("#ErrorArchivo").html(mje);
	 			e.preventDefault();
	 		}else{

	 			 $.ajax({

					url : "../controlador/servidor/dentalController.php",
					method : "POST",
					data: new FormData(this),
					contentType:false,
					processData:false,
					beforeSend:function(response){
						console.log("Peticion Recibida");
					},
					success:function(response){
						resultado = response;	

					if (resultado === "correcto") {

							$('#nombre').val('');
					 		$('#rut').val('');
							$('#desde').val('');
							$("#selectedFiles").empty();
							$('input[type="text"]').val('');
							$('#desde').val("").datetimepicker("update");
							document.getElementById("img_select").value = "";
							$("#PesoArchivo").empty();
							$("#validacionMsje").empty();
							$("#validaNombre").empty();
							$("#ErrorArchivo").empty();
							$("#validacionDniOk").empty();
							$("#validaNombreOk").empty();
							$("#validacionRut").empty();

							$("#mensaje").empty();
							var texto = "<h3> Imagenes Subidas Correctamente. </h3>";
							$("#mensaje").append(texto);
							$("#myModal").modal();
						}else{
							$("#mensaje").empty();
							var texto = "<h3> Error al subir las imagenes. </h3>";
							$("#mensaje").append(texto);
							$("#myModal").modal();
						}

				},
					error:function(e){
						console.log("Error en el sistema");
					}
			 	});
	 		}
 	}
});


//Metodo que permite ejecutar el evento enter
$('#ejecutar').keypress(function(event){
 	if ( event.which == 13 ) {
		$("#ejecutar").click();
	}
});


//MODULO PREVISUALIZACION IMAGENES
	$("#img_select").on("change", handleFileSelect);
	 selDiv = $("#selectedFiles");




// MOSTRAR CAMPOS 
$("input:radio[name=rdbBuscar]").change(function(){
	var valor=$("input:radio[name=rdbBuscar]:checked").val();
	if (valor === "rutPaciente")
	{
		$("#mostrarCampoDni").hide();
		$("#mostrarCampoRut").show();
		$('#dni').val('');
		$('#nombre').val('');
		$('#img_select').val('');
		$('#rut').val('');
		$('input[name=desde]').val('');
	}else
	{
		$("#mostrarCampoRut").hide();
		$("#mostrarCampoDni").show();
		$('#dni').val('');
		$('#nombre').val('');
		$('#img_select').val('');
		$('#rut').val('');
		$('input[name=desde]').val('');
	}
});

});

	var selDiv = "";
	var storedFiles = [];

	function handleFileSelect(e) {
		$("#selectedFiles").empty();
		$("#ErrorArchivo").empty();
	    $("#PesoArchivo").empty();
	    $("#selectedFiles").empty();
		if(window.File && window.FileReader && window.FileList && window.Blob){

			if (this.files[0].size <= 1000000 ) {
				$("#PesoArchivo").html(this.files[0].size + ' bytes');	

				var files = e.target.files;
				var filesArr = Array.prototype.slice.call(files);
				var device = $(e.target).data("device");

				filesArr.forEach(function(f) {

					if (!f.type.match("image.*")) {
						return;
					}
					storedFiles.push(f);

					var reader = new FileReader();
					var html = "";
					reader.onload = function(e) {
						//METODO QUE MUESTRA LAS IMAGENES
						html = html + "<img src=\"" + e.target.result + "\"  style='width: 100px; height:100px;' class='selFile' >";
						$("#selectedFiles").append(html);
					}
					reader.readAsDataURL(f);
				});
			}else{
				$("#PesoArchivo").html(this.files[0].size + ' bytes');
				$("#ErrorArchivo").html("NO PUEDE SUBIR MAS DE 1 MEGA.");
				$('#img_select').val('');
			}// END IF INTERNO

		}else{
			var Fs = new ActiveXObject("Scripting.FileSystemObject");
		    var ruta = document.upload.file.value;
		    var archivo = Fs.getFile(ruta);
		    var size = archivo.size;
		    alert(size + " bytes");
		    
		}

	}