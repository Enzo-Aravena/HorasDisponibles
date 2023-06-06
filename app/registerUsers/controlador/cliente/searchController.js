function buscarTodo(){
	var resultado= null;
	var url= "../controlador/servidor/controladorBuscar.php";
	var type= "POST";
	var data= {
		evento :'buscartodosUsuarios'
	};
		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("peticion recibida");
			},
			success:function(response){	
				$("#msgboxError").fadeOut();
			$("#msgboxOk").fadeOut();			
				resultado = JSON.parse(response);
				if (resultado != "" || resultado != "undefined") 
				{
					//limpia la tabla completa
					$('#tabla_resultados').empty();
					//recorre el json que trae desde el php y lo pinta en la pantalla
					
				for(var aux = 0 in resultado){

					if (resultado[aux].estado === "A") {
						$('#tabla_resultados').append("<tr>"+"<td class='check hidden-xs'><label>"
						+"<input style='cursor: pointer;' name='obtener' type='radio' id='idButton"+aux+"' value='"+resultado[aux].rut+"_"+resultado[aux].usuario+"_"+resultado[aux].encriptacion+"'><span></span></label></td>"
						+"<td id='rut'>"+resultado[aux].rut+"</td>"
						+"<td>"+resultado[aux].nombre+"</td>"
						+"<td>"+resultado[aux].apellidos+"</td>"
						+"<td>"+resultado[aux].fnac+"</td>"
						+"<td>"+resultado[aux].sexo+"</td>"
						+"<td>"+resultado[aux].descripcion+"</td>"
						+"<td>"+resultado[aux].centro+"</td>"
						+"<td>"+resultado[aux].usuario+"<input type='hidden' name='usuario' id='tener"+aux+"' value='"+resultado[aux].usuario+"'> </td>"
						+"<td>"+resultado[aux].encriptacion+"</td>"
						+"<td>"+resultado[aux].estado+" "+"<img src='../../../lib/images/correct.png' style='margin-left: 16%;width: 20%;'></td>"						
						+"<td class='check hidden-xs'><input type='hidden' name='idclave' id='id"+aux+"' value='"+resultado[aux].id+"'></td>"
						+"</tr>");
					}else{
						$('#tabla_resultados').append("<tr>"+"<td class='check hidden-xs'><label>"
						+"<input style='cursor: pointer;' name='obtener' type='radio' id='idButton"+aux+"' value='"+resultado[aux].rut+"_"+resultado[aux].usuario+"_"+resultado[aux].encriptacion+"'><span></span></label></td>"
						+"<td id='rut'>"+resultado[aux].rut+"</td>"
						+"<td>"+resultado[aux].nombre+"</td>"
						+"<td>"+resultado[aux].apellidos+"</td>"
						+"<td>"+resultado[aux].fnac+"</td>"
						+"<td>"+resultado[aux].sexo+"</td>"
						+"<td>"+resultado[aux].descripcion+"</td>"
						+"<td>"+resultado[aux].centro+"</td>"
						+"<td>"+resultado[aux].usuario+"<input type='hidden' name='usuario' id='tener"+aux+"' value='"+resultado[aux].usuario+"'> </td>"
						+"<td>"+resultado[aux].encriptacion+"</td>"
						+"<td>"+resultado[aux].estado+" "+"<img src='../../../lib/images/incorrect.png' style='margin-left: 16%;width: 20%;'></td>"						
						+"<td class='check hidden-xs'><input type='hidden' name='idclave' id='id"+aux+"' value='"+resultado[aux].id+"'></td>"
						+"</tr>");
					}

					
				}


				}
				else{		
					$("#msgbox").fadeTo(100,0.1,function() //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('No se ha podido encontrar datos, Por favor comuniquese con el administrador del sistema').addClass('messageboxerror').fadeTo(1500,2);
					});					
				}

				$('#loader').hide();
			}, // End success
			error:function(error){
			//	resultado = response;
				console.log("Error en la peticion");
			} // End error
		});//End ajax

}



function redirectUser(rdbBuscar,buscar){
	var resultado= null;
	var url= "../controlador/servidor/controladorBuscar.php";
	var type= "POST";
	var data= {
		evento :'buscar',
		rdbBuscar:rdbBuscar,
		buscar:buscar
	};
		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("peticion recibida");
			},
			success:function(response){				
				resultado = JSON.parse(response);
					$("#msgboxError").fadeOut();
			$("#msgboxOk").fadeOut();
				if (resultado != "" || resultado != "undefined") 
				{
					//limpia la tabla completa
					$('#tabla_resultados').empty();
					//recorre el json que trae desde el php y lo pinta en la pantalla
				for(var aux = 0 in resultado){
					if (resultado[aux].estado === "A") {
						$('#tabla_resultados').append("<tr>"+"<td class='check hidden-xs'><label>"
						+"<input style='cursor: pointer;' name='obtener' type='radio' id='idButton"+aux+"' value='"+resultado[aux].rut+"_"+resultado[aux].usuario+"_"+resultado[aux].encriptacion+"'><span></span></label></td>"
						+"<td id='rut'>"+resultado[aux].rut+"</td>"
						+"<td>"+resultado[aux].nombre+"</td>"
						+"<td>"+resultado[aux].apellidos+"</td>"
						+"<td>"+resultado[aux].fnac+"</td>"
						+"<td>"+resultado[aux].sexo+"</td>"
						+"<td>"+resultado[aux].descripcion+"</td>"
						+"<td>"+resultado[aux].centro+"</td>"
						+"<td>"+resultado[aux].usuario+"<input type='hidden' name='usuario' id='tener"+aux+"' value='"+resultado[aux].usuario+"'> </td>"
						+"<td>"+resultado[aux].encriptacion+"</td>"
						+"<td>"+resultado[aux].estado+" "+"<img src='../../../lib/images/correct.png' style='margin-left: 16%;width: 20%;'></td>"						
						+"<td class='check hidden-xs'><input type='hidden' name='idclave' id='id"+aux+"' value='"+resultado[aux].id+"'></td>"
						+"</tr>");
					}else{
						$('#tabla_resultados').append("<tr>"+"<td class='check hidden-xs'><label>"
						+"<input style='cursor: pointer;' name='obtener' type='radio' id='idButton"+aux+"' value='"+resultado[aux].rut+"_"+resultado[aux].usuario+"_"+resultado[aux].encriptacion+"'><span></span></label></td>"
						+"<td id='rut'>"+resultado[aux].rut+"</td>"
						+"<td>"+resultado[aux].nombre+"</td>"
						+"<td>"+resultado[aux].apellidos+"</td>"
						+"<td>"+resultado[aux].fnac+"</td>"
						+"<td>"+resultado[aux].sexo+"</td>"
						+"<td>"+resultado[aux].descripcion+"</td>"
						+"<td>"+resultado[aux].centro+"</td>"
						+"<td>"+resultado[aux].usuario+"<input type='hidden' name='usuario' id='tener"+aux+"' value='"+resultado[aux].usuario+"'> </td>"
						+"<td>"+resultado[aux].encriptacion+"</td>"
						+"<td>"+resultado[aux].estado+" "+"<img src='../../../lib/images/incorrect.png' style='margin-left: 16%;width: 20%;'></td>"						
						+"<td class='check hidden-xs'><input type='hidden' name='idclave' id='id"+aux+"' value='"+resultado[aux].id+"'></td>"
						+"</tr>");
					}
					}			
				}
				else{		
					$("#msgbox").fadeTo(100,0.1,function() //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('No se ha podido encontrar datos, Por favor comuniquese con el administrador del sistema').addClass('messageboxerror').fadeTo(1500,2);
					});					
				}
				$('#loader').hide();
			}, // End success
			error:function(error){
			//	resultado = response;
				console.log("Error en la peticion");
			} // End error
		});//End ajax

}



/*
$(window).load(function() {
$(".loader").fadeOut("slow");
});
*/

