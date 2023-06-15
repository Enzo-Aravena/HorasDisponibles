function buscarUsuarioOmiPorRut(rutUsuario){
	$('#tabla_resultados').empty();	
	var resultado = null;
	var url = "../controlador/servidor/controladorUsuarios.php";
	var type = "POST";
	var data = {
		evento:"buscarRut",
		rut:rutUsuario		
	};

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){
			resultado = JSON.parse(response);
			$("#cuerpoUno").show();
			var tabla="";
			if (resultado != "" || resultado != "undefined" && resultado != "0") 
			{
				$("#botones").show();
				//limpia la tabla completa
				$('#tabla_resultados').empty();
					//recorre el json que trae desde el php y lo pinta en la pantalla
				for(var aux = 0 in resultado){
					let codigo = resultado[aux].perId+"_" + resultado[aux].rut+"_"+resultado[aux].idEstado+"_" + resultado[aux].idPerfil+"_"+resultado[aux].desblSapu;
					tabla = tabla + '<tr>';
					tabla = tabla + '<td>'+'<label class="radio-inline Mostrar"><input style="cursor: pointer;" checked name="obtener" type="radio" id="idButton'+aux+'" value="'+codigo+'"><span></span></label></td>';
					tabla = tabla + '<td>'+resultado[aux].rut+' </td>';
					tabla = tabla + '<td>'+resultado[aux].nombreCompleto+' </td>';
					tabla = tabla + '<td>'+resultado[aux].usuario+' </td>';
					tabla = tabla + '<td>'+resultado[aux].centro+' </td>';
					tabla = tabla + '<td>'+resultado[aux].estamento+' </td>';
					tabla = tabla + '<td>'+resultado[aux].estado+' </td>';
					tabla = tabla + '<td>'+resultado[aux].Perfil+' </td>';
					tabla = tabla + '<td>'+resultado[aux].idDesblSapu+' </td>';
					tabla = tabla + '</tr>';
				}
				$('#tabla_resultados').append(tabla);

				$('#otorgaAcceso').on("click",function(){
					var datos = $("#idButton0").val();
					let da = datos.split("_");

					let perfil = da[3];
					let estado = da[2];
					let desblSapu = da[4];
					
					if (perfil === "0") {
						$('select[name=cargoAsignar]').val("0");
					}else{
						$('select[name=cargoAsignar]').val(perfil);
					}

					if (estado === "0") {
						$('select[name=habilitarDeshabilitar]').val("99");
					}else{
						$('select[name=habilitarDeshabilitar]').val(estado);
					}

					if (desblSapu === "0") {
						$('select[name=habiDesblSapu]').val("99");
					}else{
						$('select[name=habiDesblSapu]').val(desblSapu);
					}
					
					document.getElementById("valor").value= "";
					$("#valor").val(datos);
					$('#myModal').modal();
				});
				
			}
			else{
				tabla = tabla + '<tr>';
				tabla = tabla + '<td colspan=7> No existe el/la Profesional en el Sistema</td>';
				tabla = tabla + '</tr>';
				$('#tabla_resultados').append(tabla);
			}
		},
		error:function(error){
			console.log("Error de la peticio");
			
		}
	});// fin ajax

}

function buscarUsuarioOmiPorNombre(usuario){
	$('#tabla_resultados').empty();	
	var resultado = null;
	var url = "../controlador/servidor/controladorUsuarios.php";
	var type = "POST";
	var data = {
		evento:"buscarUsuario",
		usuario:usuario		
	};

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){
			resultado = JSON.parse(response);
			$("#cuerpoUno").show();
			var tabla="";
			if (resultado != "" || resultado != "undefined" && resultado != "0") 
			{
				$("#botones").show(); 
				//limpia la tabla completa
				$('#tabla_resultados').empty();
					//recorre el json que trae desde el php y lo pinta en la pantalla
				for(var aux = 0 in resultado){
					let codigo = resultado[aux].perId+"_" + resultado[aux].rut+"_"+resultado[aux].idEstado+"_" + resultado[aux].idPerfil+"_"+resultado[aux].desblSapu;
					tabla = tabla + '<tr>';
					tabla = tabla + '<td>'+'<label class="radio-inline Mostrar"><input style="cursor: pointer;" checked name="obtener" type="radio" id="idButton'+aux+'" value="'+codigo+'"><span></span></label></td>';
					tabla = tabla + '<td>'+resultado[aux].rut+' </td>';
					tabla = tabla + '<td>'+resultado[aux].nombreCompleto+' </td>';
					tabla = tabla + '<td>'+resultado[aux].usuario+' </td>';
					tabla = tabla + '<td>'+resultado[aux].centro+' </td>';
					tabla = tabla + '<td>'+resultado[aux].estamento+' </td>';
					tabla = tabla + '<td>'+resultado[aux].estado+' </td>';
					tabla = tabla + '<td>'+resultado[aux].Perfil+' </td>';
					tabla = tabla + '<td>'+resultado[aux].idDesblSapu+' </td>';
					tabla = tabla + '</tr>';
				}
				$('#tabla_resultados').append(tabla);

				$('#otorgaAcceso').on("click",function(){
					var datos = $("#idButton0").val();
					let da = datos.split("_");

					let perfil = da[3];
					let estado = da[2];
					let desblSapu = da[4];
					
					if (perfil === "0") {
						$('select[name=cargoAsignar]').val("0");	
					}else{
						$('select[name=cargoAsignar]').val(perfil);
					}

					if (estado === "0") {
						$('select[name=habilitarDeshabilitar]').val("99");
					}else{
						$('select[name=habilitarDeshabilitar]').val(estado);
					}

					if (desblSapu === "0") {
						$('select[name=habiDesblSapu]').val("99");
					}else{
						$('select[name=habiDesblSapu]').val(desblSapu);
					}
					
					document.getElementById("valor").value= "";
					$("#valor").val(datos);
					$('#myModal').modal();
				});
				
			}
			else{
				tabla = tabla + '<tr>';
				tabla = tabla + '<td colspan=7> No existe el/la Profesional en el Sistema</td>';
				tabla = tabla + '</tr>';
				$('#tabla_resultados').append(tabla);
			}
		},
		error:function(error){
			console.log("Error de la peticio");
			
		}
	});// fin ajax

}
function ingresarModificacion(cargoAsignar,habilitarDeshabilitar,habiDesblSapu,perId,rut){
	var resultado = null;
	var rutUsuario = rut;
	var url = "../controlador/servidor/controladorUsuarios.php";
	var type = "POST";
	var data = {
		evento:"modificar",
		cargo:cargoAsignar,
		estado:habilitarDeshabilitar,
		habiDesblSapu:habiDesblSapu,
		perId:perId

	};

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){
			resultado = JSON.parse(response);

			if (resultado === "correcto") {
				$('#myModal').modal('hide');
				alert("Se han realizado los cambios correctamente!");
				buscarUsuarioOmiPorRut(rutUsuario);
			}else{
				alert("No se han podicdo realizar los cambios.");
			}
		},
		error:function(error){
			console.log("Error de la petición");
			
		}
	});// fin ajax
}