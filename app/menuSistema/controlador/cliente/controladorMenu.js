function redirectToMenu(usuario){
	var resultado = null;
	var url = "../controlador/servidor/controladorMenu.php";
	var type = "POST";
	var data = {
		evento:"menu",
		usuario:usuario
	};

	$.ajax({
		url:url,
		type:type,
		data:data,
		beforesend:function(){
			console.log("Peticion enviada");º
		},
		success:function(response){
			resultado = JSON.parse(response);

			if (resultado === 0) {
				alert("Su sesion ha caducado");
				$(location).attr('href',"../../../index.php");

			}else{
				$('#menu').empty();
					for(var aux = 0 in resultado){
						var menu = '';
						menu = menu + '<li>';
						menu = menu + '<a href="#" id="usuarios">';
						menu = menu + '<label id="link'+aux+'" class="mostrar" url="'+resultado[aux].url+'">';

						var validate = resultado[aux].imagen;
						var verf = validate.substring(0,5);
						if ( verf === "se7en" )
						{					
							menu = menu + '<span aria-hidden="true" class="'+resultado[aux].imagen+'"></span>';					
						}
						else{
							menu = menu + '<span aria-hidden="true"><img src="'+resultado[aux].imagen+'" style="margin-top: -7px;"></span>';			
						}	
							menu = menu + '<label id = "nombre'+aux+'">'+resultado[aux].nombre+'</label>';
							menu = menu + '<input type="hidden" id="showData" value="'+resultado[aux].url+'" />';
							menu = menu + '</label></a>';
							menu = menu + '</li>';			
							$('#menu').append(menu);
					}

					var url = 'index.php';
					$("#contenido").attr("src",url);
					$('#loader').hide();
					$('.mostrar').on("click",function(){

					var usuario = $('#usuario').val();
	
					if (usuario === "" ) {
						$("#contenido").attr("src",url);
						$(location).attr('href',"../../../index.php");
					}else{
						var url = "../../"+$('#'+this.id+' #showData').val();
						$("#contenido").attr("src",url);
					}


						
					});
			}

		},
		error:function(error){
			console.log("no se pudo ingresar a la pagina");
		}
	});



}