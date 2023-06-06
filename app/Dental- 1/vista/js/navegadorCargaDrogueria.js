$( document ).ready(function() {
  $("#resultadoCarga").hide();
  $("#close").show();
  $("#cerrar").show();

  $('#abrirPopUp').on("click",function(){
    $("#manualUsuario").modal();
  });

  $('#ejecutar').on("click",function(){
    var porTagName=document.getElementsByTagName("input")[0].value;

    if (porTagName === "") {
      $("#mensaje").empty();
      var texto = "<h3> No ha seleccionado un archivo. </h3>";
      $("#mensaje").append(texto);
      $("#myModal").modal({backdrop: 'static', keyboard: false});
    }else{
        if (ValidaArchivo(porTagName) === false) {
          $("#mensaje").empty();
          var texto = "<h3> La extension no es valida. </h3>";
          $("#mensaje").append(texto);
          $("#myModal").modal({backdrop: 'static', keyboard: false});
           document.getElementById("subirArchivo").value = "";
        }else{
          $.ajax({
            url : "../controlador/servidor/cargaDrogueriaController.php",
            method : "POST",
            data: new FormData($("#detalle")[0]),
            contentType:false,
            processData:false,
            beforeSend:function(response){
              console.log("Peticion Recibida");
            },
            success:function(response){
              $("#tabla_resultados").empty();
              resultado = response;
                switch(resultado){
                  case "1":
                    $("#tabla_resultados").empty();
                    $("#mensaje").empty();
                    $("#resultadoCarga").hide();
                    $("#close").hide();
                    $("#cerrar").hide();
                    var texto = "<h3> Archivo Cargado Exitosamente!......  </h3>";
                    $("#mensaje").append(texto);
                    $("#myModal").modal({backdrop: 'static', keyboard: false});
					window.location.href = 'bat.php';
				    //var wshShell = new ActiveXObject("WScript.Shell");
                    //wshShell.Run("bat.php");
                    setTimeout(cuentaAtras, 3000);
                  break;

                  case "2":
                    $("#mensaje").empty();
                    $("#resultadoCarga").hide();
                    $("#tabla_resultados").empty();
                    $("#close").show();
                    $("#cerrar").show();
                    var texto = "<h3> Error al cargar al archivo. </h3>";
                    $("#mensaje").append(texto);
                    $("#myModal").modal({backdrop: 'static', keyboard: false});
                  break;

                  case "3":
                    $("#mensaje").empty();
                    $("#resultadoCarga").hide();
                    $("#tabla_resultados").empty();
                    $("#close").show();
                    $("#cerrar").show();
                    var texto = "<h3> La extension no es valida. </h3>";
                    $("#mensaje").append(texto);
                    $("#myModal").modal({backdrop: 'static', keyboard: false});
                  break;

                  case "4":
                    $("#mensaje").empty();
                    $("#resultadoCarga").hide();
                    $("#tabla_resultados").empty();
                    $("#close").show();
                    $("#cerrar").show();
                    var texto = "<h3> El archivo ya fue cargado. </h3>";
                    $("#mensaje").append(texto);
                    $("#myModal").modal({backdrop: 'static', keyboard: false});
                  break;

                  default:
                    // MOSTRAR DATA EN BASE A LA DATA DE ERROR
                    $("#resultadoCarga").show();
                    var datos = JSON.parse(resultado);
                    var cont = 1;
                    for(aux in datos.filas){
                       var tabla = "";

                      if (datos.filas[aux].col2 === "-" && datos.filas[aux].col3 === "-" && datos.filas[aux].col4 === "-" && datos.filas[aux].col5 === "-" && datos.filas[aux].col6 === "-" ){
                      }else{
                        tabla = tabla + '<tr>';
                          tabla = tabla + '<td  class="text-center">'+datos.filas[aux].col1+'</td>';
                          if (datos.filas[aux].col2 === "-") {
                            tabla = tabla + '<td  class="text-center">'+datos.filas[aux].col2+'</td>';
                          }else{
                            tabla = tabla + '<td  class="text-center"  style= "color:red;">'+datos.filas[aux].col2+'</td>';
                          }

                          if (datos.filas[aux].col3 === "-") {
                            tabla = tabla + '<td  class="text-center">'+datos.filas[aux].col3+'</td>';
                          }else{
                            tabla = tabla + '<td  class="text-center" style = "color:red;">'+datos.filas[aux].col3+'</td>';
                          }

                          if (datos.filas[aux].col4 === "-") {
                            tabla = tabla + '<td  class="text-center">'+datos.filas[aux].col4+'</td>';
                          }else{
                            tabla = tabla + '<td  class="text-center" style = "color:red;">'+datos.filas[aux].col4+'</td>';
                          }

                          if (datos.filas[aux].col5 === "-") {
                            tabla = tabla + '<td  class="text-center">'+datos.filas[aux].col5+'</td>';
                          }else{
                            tabla = tabla + '<td  class="text-center" style = "color:red;">'+datos.filas[aux].col5+'</td>';
                          }

                          if (datos.filas[aux].col6 === "-") {  
                            tabla = tabla + '<td  class="text-center">'+datos.filas[aux].col6+'</td>';
                          }else{
                            tabla = tabla + '<td  class="text-center" style = "color:red;">'+datos.filas[aux].col6+'</td>';
                          }
                        tabla = tabla + '</tr>';
                      $("#tabla_resultados").append(tabla);

                      cont++;
                      }

                    }// END FOR*/
                  break;
                } // END SWITCH
            },
            error:function(e){
              console.log("Error en el sistema");
            }
          });
        }

    }
  });

});

  function ValidaArchivo(sender) {
    var valExtencion = new Array(".xlsx", ".xls");
    var archivo = sender;
    archivo = archivo.substring(archivo.lastIndexOf('.'));
    if (valExtencion.indexOf(archivo) < 0) {
      return false;
    }
    else{
      return true;
    } 
  }

// CODIGO QUE HACE UN CUENTA ATRAS Y REFRESCA LA APP
  var contador = 10;
  function cuentaAtras() {
    if (contador==0) {
        document.getElementById("subirArchivo").value = "";
        window.parent.document.getElementById('cargaDroguerias').contentWindow.location.reload(true);
    } else {
      contador--;
      setTimeout(cuentaAtras, 2000);

      $("#mensaje").empty();
      $("#close").hide();
      $("#cerrar").hide();
      var texto = "<h3>Espera mientras se procesa el archivo ... En unos segundos recibiras el informe por correo ..</h3>";
      $("#mensaje").append(texto);
      $("#myModal").modal({backdrop: 'static', keyboard: false});
    }
  }