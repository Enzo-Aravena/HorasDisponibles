function buscarUsuarioOmiPorRut(buscar){
	$('#tabla_resultados').empty();	
	var resultado = null;
	var url = "../controlador/servidor/controladorUsuariosOMi.php";
	var type = "POST";
	var data = {
		evento:"buscarRut",
		rut:buscar		
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
				
					tabla = tabla + '<tr>';
					tabla = tabla + '<td>'+'<input style="cursor: pointer;" name="obtener" type="radio" id="idButton'+aux+'" value="'+resultado[aux].rut+'_'+resultado[aux].usuario+'_'+resultado[aux].tipoEst+"_"+resultado[aux].perId+'"><span></span></label></td>';
					tabla = tabla + '<td>'+resultado[aux].usuario+' </td>';
					tabla = tabla + '<td>'+resultado[aux].nombreCompleto+' </td>';
					tabla = tabla + '<td>'+resultado[aux].estamento+' </td>';
					tabla = tabla + '<td>'+resultado[aux].rut+' </td>';
					tabla = tabla + '<td>'+resultado[aux].centro+' </td>';
					tabla = tabla + '<td>'+resultado[aux].estado+' </td>';
					tabla = tabla + '</tr>';

				}	
				$('#tabla_resultados').append(tabla);

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


function buscarUsuarioOmiPorNombre(buscar){
	$('#tabla_resultados').empty();	
	var resultado = null;
	var url = "../controlador/servidor/controladorUsuariosOMi.php";
	var type = "POST";
	var data = {
		evento:"buscarUsuario",
		usuario:buscar		
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
				
					tabla = tabla + '<tr>';
					tabla = tabla + '<td>'+'<input style="cursor: pointer;" name="obtener" type="radio" id="idButton'+aux+'" value="'+resultado[aux].rut+'_'+resultado[aux].usuario+'_'+resultado[aux].tipoEst+'"><span></span></label></td>';
					tabla = tabla + '<td>'+resultado[aux].usuario+' </td>';
					tabla = tabla + '<td>'+resultado[aux].nombreCompleto+' </td>';
					tabla = tabla + '<td>'+resultado[aux].estamento+' </td>';
					tabla = tabla + '<td>'+resultado[aux].rut+' </td>';
					tabla = tabla + '<td>'+resultado[aux].centro+' </td>';
					tabla = tabla + '<td>'+resultado[aux].estado+' </td>';
					tabla = tabla + '</tr>';

				}	
				$('#tabla_resultados').append(tabla);

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


function modificarEstadoUsuario(perId,estado){
	var resultado = null;
	var url = "../controlador/servidor/controladorUsuariosOMi.php";
	var type = "POST";
	var data = {
		evento:"cambiarEstado",
		perId:perId,
		estado:estado		
	};

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){
			resultado= response;
		},
		error:function(error){
			console.log("Error de la peticio");		
		}
	});// fin ajax
}


function modificarEstadoUsuarioMysql(perId,estado,rut){
	var resultado = null;
	var buscar = rut;
	var url = "../controlador/servidor/controladorUsuariosOMi.php";
	var type = "POST";
	var data = {
		evento:"cambiarEstado2",
		perId:perId,
		estado:estado		
	};

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){
			resultado= response;

			if (resultado === "correcto") {
				$("#habilitar").hide();
				$("#ModificacionExistosa").show();
				$("#Error").hide();
				$("#ModificacionError").hide();		

				buscarUsuarioOmiPorRut(buscar);
				$("#buscar").val(buscar);

			}else{

				$("#habilitar").hide();
				$("#ModificacionExistosa").hide();
				$("#Error").hide();
				$("#ModificacionError").show();
			}
		},
		error:function(error){
			console.log("Error de la peticio");		
		}
	});// fin ajax

}

/********************** INSERTAR LOG USUARIO *******************************/
function InsertarLogUsuario(rut,usuarioSesion,estado){
	var resultado = null;
	var url = "../controlador/servidor/controladorUsuariosOMi.php";
	var type = "POST";
	var data = {
		evento:"guardarLogUsuario",
		rut:rut,
		usuarioSesion:usuarioSesion,
		estado:estado
	};

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){
			resultado= response;				
		},
		error:function(error){
			console.log("Error de la peticio");		
		}
	});// fin ajax
}

/*****************************************************/

function modificarClaveUsuariMysql(username,perId,clave,rut){
	var resultado = null;
	var perIds = perId;
	var buscar = rut;
	var claves = clave;
	var url = "../controlador/servidor/controladorUsuariosOMi.php";
	var type = "POST";
	var data = {
		evento:"modificarYvalidarClave",
		username:username,
		perId:perId,
		clave:clave		
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

			if (resultado[0].clave !=="" ) {

				var clavebd= resultado[0].clave;
				modificarClaveUsuario(perIds,claves,clavebd,buscar);	
			}else{
				//MOSTRAR MENSAJE : LA CLAVE NO PUEDE SER LA MISMA QUE LA ANTERIOR
				$("#msjes").empty();
				var mens = " La clave Ingresada no puede ser la misma que la anterior";
				$("#msjes").append("<label style='color: red;'>"+mens+"</label>");
			}
		},
		error:function(error){
			console.log("Error de la peticio");		
		}
	});// fin ajax
}




function modificarClaveUsuario(perIds,claves,clavebd,buscar){
	var vlavbd= clavebd;
	var buscar = buscar;
	var resultado = null;
	var url = "../controlador/servidor/controladorUsuariosOMi.php";
	var type = "POST";
	var data = {
		evento:"cambiaClaveOmi",
		perId:perIds,
		clave:claves,
		clavebd:clavebd		
	};

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){	
			resultado = response;

			if (resultado=== "1") {
				
				modificarClaveUsuarioOrcle(perIds,claves,buscar);	

				$('#gestionClave').fadeOut('slow');
			$('.popup-overlay').fadeOut('slow');
			return false;			

			}else{
				//MOSTRAR MENSAJE : LA CLAVE NO PUEDE SER LA MISMA QUE LA ANTERIOR
				$("#msjes").empty();
				var mens = " La clave Ingresada no puede ser la misma que la anterior";
				$("#msjes").append("<label style='color: red;'>"+mens+"</label>");

			}
		},
		error:function(error){
			console.log("Error de la peticio");		
		}
	});// fin ajax
}




function modificarClaveUsuarioOrcle(perIds,claves,buscar){
	var resultado = null;
	var buscar = buscar;
	var url = "../controlador/servidor/controladorUsuariosOMi.php";
	var type = "POST";
	var data = {
		evento:"modificarOracle",
		perId:perIds,
		clave:claves		
	};

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){	
			resultado= response;

			$("#textosValidacion").empty();


			if (resultado === "correcto") {
				
				buscarUsuarioOmiPorRut(buscar);

				$("#textosValidacion").append("<span> Se ha modificado la contraseña correctamente. </span>");
				//POPUP       	 	
			   		$('#ValidacionesClaves').fadeIn('slow');
					$('.popup-overlay').fadeIn('slow');
					$('.popup-overlay').height($(window).height());				
					return false;
				// END POPUP	

			}else{
				//MOSTRAR MENSAJE : LA CLAVE NO PUEDE SER LA MISMA QUE LA ANTERIOR

			}
		},
		error:function(error){
			console.log("Error de la peticio");		
		}
	});// fin ajax
}