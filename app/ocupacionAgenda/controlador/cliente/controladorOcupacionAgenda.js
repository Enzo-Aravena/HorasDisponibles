// metodo que carga el select box de los datos
function cargarSelect(){	
	var resultado = null;
	var url = "../controlador/servidor/controladorAgenda.php";
	var type = "POST";
	var data = {
		evento:"cargarSelect"
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
				$('#acto').empty();
				//CArga el seleccione por defecto antes de que se cargue toda la otra data
				$('#acto').append("<option> SELECCIONE ...</option>");
				for(var aux = 0 in resultado){
					if (resultado[aux].descripcion === null || resultado[aux].descripcion === "null" ||resultado[aux].descripcion === "undefined"  
					|| resultado[aux].descripcion === undefined || resultado[aux].descripcion === "" ) {					 	

						console.log("Error de carga");
					}else{
							$('#acto').append("<option value='"+resultado[aux].acto+"' >"+resultado[aux].descripcion+"</option>");
					}
				}


			},
			error:function(error){
				console.log("Error de la peticio");
				
			}
		});// fin ajax
}

function CargarMenu(){
	var resultado = null;
	var url = "../controlador/servidor/controladorAgenda.php";
	var type = "POST";
	var data = {
		evento:"menu"
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
		//alert(JSON.stringify(resultado));

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
					menu = menu + '<span aria-hidden="true"><img src="'+resultado[aux].imagen+'" style="margin-top: -15px;width: 26px;"></span>';			
				}	
					menu = menu + '<label id = "nombre'+aux+'">'+resultado[aux].nombre+'</label>';
					menu = menu + '<input type="hidden" id="showData" value="'+resultado[aux].url+'" />';
					menu = menu + '</label></a>';
					menu = menu + '</li>';			
					$('#menu').append(menu);



			}


			// estto valida las pantallas		
			$('.mostrar').on("click",function(){
				//valida el primer item
				var url = "../../"+$('#'+this.id+' #showData').val();
				$("#prueba").hide();
				$("#detalle").hide();
				$("#morbilidad").hide();

				if (url === "../../ocupacionAgenda/vista/ocupacionAgenda.php") {					
					$("#contenido").attr("src",url);
					$("#prueba").show();
				}	
				else
					//valida la segunda ruta
					if (url === "../../ocupacionAgenda/vista/ocupacionMorbilidad.php") {
					//	$("#morbilidad").show();
						$("#contenido").attr("src",url);
						$("#morbilidad").show();

					}else
						//validala tercera parte 
						if (url === "../../ocupacionAgenda/vista/GDADetalleLlamadas.php") {
						//	$("#detalla").show();
							$("#contenido").attr("src",url);
							$("#detalle").show();
						}
			});
						

		},
		error:function(error){
			console.log("no se pudo ingresar a la pagina");
		}
	});



}


function cargarDataPAntalla(){	
	var resultado = null;
	var url = "../controlador/servidor/controladorAgenda.php";
	var type = "POST";
	var data = {
		evento:"cargargrafico"
	};
		$.ajax({
			url:url,
			type:type,
			data:data,
			beforesend:function(){
				console.log("Peticion Recibida");
			},
			success:function(response){
			//	resultado = JSON.parse(response);	

			//$('#carga_dataGrafico').append();

				


			},
			error:function(error){
				console.log("Error de la peticio");
				
			}
		});// fin ajax
}
