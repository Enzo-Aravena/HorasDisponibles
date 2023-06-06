let cont =0;
let dato = "";
let Fn = {
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
  window.parent.parent.$("#loader").show();
  $("#mostrarRut").show();
  $("#mostrarFecha").hide();
  $('#desde').datepicker();
  $('#hasta').datepicker();
  $('[data-toggle="tooltip"]').tooltip();
  //cargarPacienteInasistente();

  var centro = $("#centro").val();

  switch(centro){
    //LO HERMIDA FARMACIA
    case "4":centro = "3";break;
    //CARDENAL SILVA H. FARMACIA
    case "5":centro = "4";break;
    //CAROL URZUA FARMACIA
    case "1":centro = "6";break;
    //LA FAENA FARMACIA
    case "2":centro = "8";break;
    // SAN LUIS FARMACIA
    case "3":centro = "10";break;
    // COSAM FARMACIA
    case "6":centro = "36";break;
    //PADRE GERARDO W. FARMACIA
    case "12":centro = "103";break;
    //LAS TORRES. FARMACIA
    case "13":centro = "106";break;
  }


  buscarPacientesInasistentesMedicamentos();

  $('#ejecutar').on("click",function(){
    window.parent.parent.$("#loader").show();
    var centro= $('input:radio[name=rdbBuscar]:checked').val();
    var buscar = $('#rutPaciente').val();
    var desde = separar_fecha1();
    var hasta = separar_fecha2();
    var clickeado = $('input:radio[name=rdbBuscarPor]:checked').val();

    if (centro=== undefined) {
      alert("Debe seleccionar un centro para buscar."); 
    }else{
      //SI EL CENTRO NO ES UNDEFINED
      if (buscar !== "" && desde === "" && hasta === "") {
        if (Fn.validaRut(buscar)){
          buscarPacienteDisp(buscar,desde,hasta,centro);
        }else{
          window.parent.parent.$("#loader").hide();
          $("#mensaje").empty();
          var texto = "<h3>El rut ingresado no es válido, reingrese el rut del paciente. </h3>";
          $("#mensaje").append(texto);
          $("#myModal").modal();
        }
      }else{
        var resultado = validate_fechaMayorQue(desde,hasta);
        if (resultado ===  true) {
          buscarPacienteDisp(buscar,desde,hasta,centro);
        }else{
          if (buscar === "" && desde === "" && hasta ==="") {
            window.parent.parent.$("#loader").hide();
            $("#ExportarData").hide();
            $("#mensaje").empty();
            var texto = "<h3> Debe una fecha ..  </h3>";
            $("#mensaje").append(texto);
            $("#myModal").modal();
          }else{
            $("#ExportarData").show();
            buscarPacienteDisp(buscar,desde,hasta,centro);
          }
        }
      }//ELSE 
    }

    window.parent.parent.$("#loader").hide();

  });


  //EVENTO KEYPRESS QUE PERMITE BUSCAR UN RUT AL PRESIONAR ENTER    
    $("#rutPaciente").keypress(function( event ) {
      if ( event.which == 13 ) {
        $("#ejecutar").click();
      }
    });


  $("#abrirPopUp").click(function() {
    $("#manualUsuario").modal();
  });

  // VALIDA LOS CAMBIOS POR EL RUT Y/O LA FECHA
  $("input:radio[name=rdbBuscarPor]").change(function(){
    var valor=$("input:radio[name=rdbBuscarPor]:checked").val();
    if (valor === "rut"){
        $("#mostrarRut").show();
        $("#mostrarFecha").hide();
        $('input[name=desde]').val('');
        $('input[name=hasta]').val('');
    }else{
        $("#mostrarFecha").show();
        $("#mostrarRut").hide();
        $('#rutPaciente').val('');
    }
  });

  //descargar archivo ExCEL
  $('#descargar').on("click",function(){
    var buscar= $('#rutPaciente').val();
    var desde = separar_fecha1();
    var hasta = separar_fecha2();
    var centro= $('input:radio[name=rdbBuscar]:checked').val();

    if (centro === undefined) {
      alert("Debe seleccionar el centro para descargar el documento");
    }else{
      $("#mensaje").empty();
      var texto = "<h3> Descargando Archivo..  </h3>";
      $("#mensaje").append(texto);
      $("#myModal").modal();
      setTimeout(cuentaAtras, 1000);
      window.location = "../controlador/servidor/reporteRetMedController.php?rut="+buscar+"&fecha1="+desde+"&fecha2="+hasta+"&centro="+centro;  
    }

    
  });

});


//FUNCTION QUE BUSCA A LOS PACIENTES
function buscarPacientesInasistentesMedicamentos(){
  window.parent.$("#loader").show();
  var buscar= $('#rutPaciente').val();
  var desde = separar_fecha1();
  var hasta = separar_fecha2();
  var centro= "0";//$('input:radio[name=rdbBuscar]:checked').val();
  $.ajax({
    url : "../controlador/servidor/InaRetMedController.php?evento=cargarDatosNuevaFunction&rutPaciente="+buscar+"&fecha1="+desde+"&fecha2="+hasta+"&centro="+centro+"",
    method : "POST",
    contentType:false,
    processData:false,
    cache: false,
    beforeSend:function(response){
      console.log("Peticion Recibida");
    },
    success:function(response){
      var arreglo = new Array();
      $('#tabla_resultados').empty();
      let cadena = "";
      resultado = JSON.parse(response);
      for(aux in resultado){
        cont = cont +1;
        var arreglos = [cont,resultado[aux].CENTRO_DISPENSACION,resultado[aux].CODIGO_MEDICAMENTO,resultado[aux].NOMBRE_MEDICAMENTO,resultado[aux].RUT_PACIENTE,resultado[aux].NOMBRE_PACIENTE,resultado[aux].INICIO_TRATAMINETO,resultado[aux].FECHA_ENTREGA,resultado[aux].TIPO_RECETA,resultado[aux].CANTIDAD_NO_DISPENSADA,resultado[aux].STOCK_INICIAL,resultado[aux].STOCK_FINAL];
        arreglo.push(arreglos);
      }//END FOR

      var arreglos = arreglo;
      $('#example').dataTable().fnAddData(arreglos);
      $("#ExportarData").show();
      window.parent.parent.$("#loader").hide();
    },
    error:function(e){
      console.log("Error en el sistema");
    }
  });
}


//-------------------- Cierra el popup ----------------------
var contador = 3;
function cuentaAtras() {
  if (contador==0) {
  $("#myModal").modal('hide');
  } else {
  contador--;
  setTimeout(cuentaAtras, 2000);
  }
}
//------------------------------------------

function separar_fecha1() {
  var desde =$('input[name=desde]').val();
    if (desde !== "") {
      var ho = desde.split('/');
      var desde = ho[2]+"-"+ho[1]+"-"+ho[0];
    }else{
      var desde = desde;
    }
  return desde;
}

function separar_fecha2() {
  var hasta =$('input[name=hasta]').val();
    if (hasta !== "") {
      var ho = hasta.split('/');
      var hasta = ho[2]+"-"+ho[1]+"-"+ho[0];
    }else{
      var hasta = hasta;
    }
  return hasta;
}


function validate_fechaMayorQue(fecha1,fecha2) {
   
  missinginfo = "";
  var rangoini = fecha1 ;   // document.getElementById('fec_inicio').value;
  var rangofin =  fecha2 ;    //document.getElementById('fec_fin').value;

  if (rangoini === undefined || rangofin === undefined) {
    return true;
  }else{
    valuesStart=rangoini.split("/");     
    valuesEnd=rangofin.split("/"); 
    if ((Date.parse(valuesStart[1]+'/'+valuesStart[0]+'/'+valuesStart[2])) > (Date.parse(valuesEnd[1]+'/'+valuesEnd[0]+'/'+valuesEnd[2]))) {
      //la fecha de inicio es mayor a la de fin
      return true;
    }else{
      // la fecha de inicio es menor a la de fin
      return false;
    } 
  }  
}
