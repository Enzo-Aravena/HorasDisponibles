$( document ).ready(function() {
	$("#desde").hide();
	$('#desde').datepicker();

	$("#tablesContent").hide();
	//EVENT CLICK
	$('#ejecutar').on("click",function(){
		$("#tablesContent").hide();
		var rdbBuscar = $("input:radio[name=rdbBuscar]:checked").val();	
		var rutPaciente = $("#rutPaciente").val();
		var desde = $('input[name=desde]').val();

		if(desde=== ""){
			desde= "";
		}else{
			var fn = desde.split("/");
			desde = fn[2]+"/"+fn[1]+"/"+fn[0];
		}

		if (rdbBuscar === "rut") {
			if (rutPaciente === "" && desde === "") {
				alert("Debe completar el campo!");
			}else{
				if (Fn.validaRut(rutPaciente) ){
					buscarPacienteSapu(rutPaciente,desde);
				}else{
					alert("El rut ingresado no es válido.");
				}
			}// END ELSE VALIDACION
		}else{
			if (rutPaciente === "" && desde === "") {
				alert("Debe completar el campo!");
			}else{
				buscarPacienteSapu(rutPaciente,desde);	
			}
			
		}
	});	

	// SI SE SELECCIONA RUT O FECHA ,MUESTRA AQUI
	$("input:radio[name=rdbBuscar]").change(function(){
		$("#tablesContent").hide();
 		 var valor=$("input:radio[name=rdbBuscar]:checked").val();
 		 if (valor === "rut"){
 		 	$("#rutPaciente").show();
 		 	$("#desde").hide();
 		 	$('input[name=desde]').val('');
 		 }else{	 		 	
 		 	$("#desde").show();
 		 	$("#rutPaciente").hide();
 		 	$("#rutPaciente").val('');
 		 } 		 	
	});

});

var Fn = {
    validaRut : function (rutPaciente) {
        rutPaciente = rutPaciente.replace("‐","-");
        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutPaciente ))
            return false;
        var tmp     = rutPaciente.split('-');
        var digv    = tmp[1]; 
        var rutPaciente     = tmp[0];
        if ( digv == 'K' ) digv = 'k' ;        
        return (Fn.dv(rutPaciente) == digv );
    },
    dv : function(T){
        var M=0,S=1;
        for(;T;T=Math.floor(T/10))
            S=(S+T%10*(9-M++%6))%11;
        return S?S-1:'k';
    }
}