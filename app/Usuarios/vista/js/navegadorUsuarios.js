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

$( document ).ready(function() {	
    $("#buscar").hide();
    $("#botones").hide();
    $("#cuerpoUno").hide();
    //$('#myModal').modal();
    //$('#informativo').modal();
    
    $('#ejecutar').on("click",function(){
        var valor=$("input:radio[name=rdbBuscar]:checked").val();
        var usuario = $('#buscar').val();
        var rutUsuario = $('#rutUsuario').val();
		$('#tabla_resultados').empty();
		var rdbBuscar= $('input:radio[name=rdbBuscar]:checked').val();
		if(valor === "rut") {
            if (Fn.validaRut( $("#rutUsuario").val())){ buscarUsuarioOmiPorRut(rutUsuario); }else{ alert("El Rut ingresado no es válido, Favor ingresar un nuevo Rut."); }
        } else {
            if (usuario !== "") {   buscarUsuarioOmiPorNombre(usuario); } else {    alert("No se ha ingresado un usuario para buscar, Favor ingrese un usuario.");  }
        }
	});

    //OTORGAR ACCESO  
    //$('#otorgaAcceso').on("click",function(){
        //var dato = $(".obtener",this).val();

        ////$('#myModal').modal();
	//});

    $('#ejecModalInfo').on("click",function(){
        $('#informativo').modal();
	});
    

    //REALIZA LA MODIFICACION
    $('#Aceptar').on("click",function(){
        var cargoAsignar = $('select[name=cargoAsignar]').val();
        var habilitarDeshabilitar = $('select[name=habilitarDeshabilitar]').val();
        var habiDesblSapu =  $('select[name=habiDesblSapu]').val();
        var datos = $("#valor").val();
        var val = datos.split("_");
        var perId = val[0];
        var rut = val[1];
        if (cargoAsignar !== "0" ||  habilitarDeshabilitar !=="99" ||  habiDesblSapu !=="99" ) {
            ingresarModificacion(cargoAsignar,habilitarDeshabilitar,habiDesblSapu,perId,rut);
        }else{
            alert("Debe seleccionar el permiso a asignar");
        }
        
    });


    


	//METODO QUE MUESTRA SI EL SELECCIONADO ES RUT O USUARIO 
	$("input:radio[name=rdbBuscar]").change(function(){
		var valor=$("input:radio[name=rdbBuscar]:checked").val();
        if(valor === "username") {
            $('#buscar').show();
            $('#rutUsuario').hide();
            document.getElementById("rutUsuario").value = "";
        } else {
            $('#rutUsuario').show();
            $("#buscar").hide();
            document.getElementById("buscar").value = "";
        }
  });



    /*$('#rutUsuario').keypress(function(event){
        if ( event.which == 13 ) {
            $("#ejecutar").click();
        }
    });

    $('#buscar').keypress(function(event){
        if ( event.which == 13 ) {
            $("#ejecutar").click();
        }
    });*/
/*
    $("#rutUsuario").on("keydown",function(e){
		if (!BlockKeys(/[0-9-Kk]/, e.key)) { return false; }
	});*/

    function BlockKeys(regexPermitido, key) {
        if (key != "Backspace" && key != " " && key != "Tab" && !key.match(regexPermitido)) {
            return false; //dont display key if it is a number
        }
        return true;
    }

});

function checkRut(rut) {
    // Despejar Puntos
    var valor = rut.value.replace('.','');
    // Despejar Guión
    valor = valor.replace('-','');
    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0,-1);
    dv = valor.slice(-1).toUpperCase();
    // Formatear RUN
    rut.value = cuerpo + '-'+ dv;    
    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}    
    // Calcular Dígito Verificador
    suma = 0;
    multiplo = 2;    
    // Para cada dígito del Cuerpo
    for(i=1;i<=cuerpo.length;i++) {    
        // Obtener su Producto con el Múltiplo Correspondiente
        index = multiplo * valor.charAt(cuerpo.length - i);        
        // Sumar al Contador General
        suma = suma + index;
        // Consolidar Múltiplo dentro del rango [2,7]
        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
    }
    
    // Calcular Dígito Verificador en base al Módulo 11
    dvEsperado = 11 - (suma % 11);    
    // Casos Especiales (0 y K)
    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;
    // Validar que el Cuerpo coincide con su Dígito Verificador
    if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }    
    // Si todo sale bien, eliminar errores (decretar que es válido)
    rut.setCustomValidity('');
}