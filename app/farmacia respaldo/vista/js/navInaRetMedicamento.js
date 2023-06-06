$( document ).ready(function() {
  $("#mostrarRut").show();
  $("#mostrarFecha").hide();
  $('#desde').datepicker();
  $('#hasta').datepicker();
  $('[data-toggle="tooltip"]').tooltip();
  cargarPacienteInasistente();

  $("#loader").show();

  $('#ejecutar').on("click",function(){

    window.parent.parent.$("#loader").show();
    var buscar= $('#rutPaciente').val();
    var desde = separar_fecha1();
    var hasta = separar_fecha2();

    if (buscar !== "") {
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

      if (Fn.validaRut( $("#rutPaciente").val())){
          buscarPacienteDisp(buscar,desde, hasta);
      }else{
        window.parent.parent.$("#loader").hide();
        $("#mensaje").empty();
        var texto = "<h3>rut invalido. </h3>";
        $("#mensaje").append(texto);
        $("#myModal").modal();

      }
    }else
      //AQUI DEBE COMENZAR LA LOGICA CONTINUAR AQUI
      var fecha1 = $('input[name=desde]').val();
      var fecha2 = $('input[name=hasta]').val();
      var resultado = validate_fechaMayorQue(fecha1,fecha2);

      if (resultado ===  true) {
        if (buscar === "" &&  fecha1 !== "" && fecha2 ==="") {
          buscarPacienteDisp(buscar,desde, hasta);
          $("#ExportarData").show();
        }else{
          window.parent.parent.$("#loader").hide();
          $("#ExportarData").hide();
          $("#mensaje").empty();
          var texto = "<h3> La fecha no puede ser menor que la primera ..  </h3>";
          $("#mensaje").append(texto);
          $("#myModal").modal();
        } 
      }else{
        if (buscar === "" && fecha1 === "" && fecha2 ==="") {
          window.parent.parent.$("#loader").hide();
          $("#ExportarData").hide();
          $("#mensaje").empty();
          var texto = "<h3> Debe una fecha ..  </h3>";
          $("#mensaje").append(texto);
          $("#myModal").modal();
        }else{
          $("#ExportarData").show();
          buscarPacienteDisp(buscar,desde, hasta);
        }
      }

        
       
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
  $("input:radio[name=rdbBuscar]").change(function(){
    var valor=$("input:radio[name=rdbBuscar]:checked").val();
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
    $("#mensaje").empty();
    var texto = "<h3> Descargando Archivo..  </h3>";
    $("#mensaje").append(texto);
    $("#myModal").modal();
    setTimeout(cuentaAtras, 1000);
    var hoy= new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth()+1; //hoy es 0!
    var yyyy = hoy.getFullYear();
    if(dd<10) {dd='0'+dd} 
    if(mm<10) {mm='0'+mm} 
    fechaHoy = yyyy+'/'+mm+'/'+dd;
    var buscar= $('#rutPaciente').val();
    var desde = separar_fecha1();
    var hasta = separar_fecha2();
    window.location = "../controlador/servidor/reporteRetMedController.php?rut="+buscar+"&desde="+desde+"&hasta="+hasta+"&fechaHoy="+fechaHoy;
  });

});

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
  var rangoini = fecha1 ;		// document.getElementById('fec_inicio').value;
  var rangofin =  fecha2 ;		//document.getElementById('fec_fin').value;
   
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

// INICIO FUNCION PAGINACION
$.fn.pageMe = function(opts){
  var $this = this,
      defaults = {
          perPage: 7,
          showPrevNext: false,
          numbersPerPage: 10,
          hidePageNumbers: false,
          showFirstLast: true
      },
      settings = $.extend(defaults, opts);

  var listElement = $this;
  var perPage = settings.perPage; 
  var children = listElement.children();
  var pager = $('.pagination');

  if (typeof settings.childSelector!="undefined") {
      children = listElement.find(settings.childSelector);
  }

  if (typeof settings.pagerSelector!="undefined") {
      pager = $(settings.pagerSelector);
  }

  var numItems = children.size();
  var numPages = Math.ceil(numItems/perPage);

  pager.data("curr",0);
  pager.empty();

  if (settings.showFirstLast){
      $('<li><a href="#" class="first_link"><</a></li>').appendTo(pager);
  }     
  if (settings.showPrevNext){
      $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
  }


  var curr = 0;
  while(numPages > curr && (settings.hidePageNumbers==false)){
      $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
      curr++;
  }

  if (settings.numbersPerPage>1) {
     $('.page_link').hide();
     $('.page_link').slice(pager.data("curr"), settings.numbersPerPage).show();
  }

  if (settings.showPrevNext){
      $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
  }
  if (settings.showFirstLast){
      $('<li><a href="#" class="last_link">></a></li>').appendTo(pager);
  }  

  pager.find('.page_link:first').addClass('active');
  pager.find('.prev_link').hide();

  if (numPages<=1) {
      pager.find('.next_link').hide();
  }
  pager.children().eq(2).addClass("active");

  children.hide();
  children.slice(0, perPage).show();

  pager.find('li .page_link').click(function(){
      var clickedPage = $(this).html().valueOf()-1;
      goTo(clickedPage,perPage);
      return false;
  });

  pager.find('li .first_link').click(function(){
      first();
      return false;
  });  

  pager.find('li .prev_link').click(function(){
    // llama a la funcion previous
      previous();
      return false;
  });

  pager.find('li .next_link').click(function(){
      // llama a la funcion next
      next();
      return false;
  });

  pager.find('li .last_link').click(function(){
      last();
      return false;
  });

  function previous(){
      var goToPage = parseInt(pager.data("curr")) - 1;
    if(goToPage == -1 || goToPage == -2 || goToPage == -3){
        console.log("omite la vuelta atras");
      }else{
      goTo(goToPage);
      }
  }

  function next(){
      goToPage = parseInt(pager.data("curr")) + 1;
      goTo(goToPage);
  }

  function first(){
      var goToPage = 0;
      goTo(goToPage);
  } 

  function last(){
      var goToPage = numPages-1;
      goTo(goToPage);
  } 

  function goTo(page){
      var startAt = page * perPage,
          endOn = startAt + perPage;

      children.css('display','none').slice(startAt, endOn).show();

      //si selecciona ir a la ultima pagina hace lo siguiente
      if (page>=1) {
          pager.find('.prev_link').show();
      }
      else {
          pager.find('.prev_link').hide();
      }

      //si selecciona el inicio hace lo siguiente
      if (page<=1) {
      pager.find('.prev_link').show();
    }
    else {
      pager.find('.prev_link').hide();
    }

    if (page < (numPages - settings.numbersPerPage)) {
          pager.find('.next_link').show();
      }
      else {
          pager.find('.next_link').hide();
      }

      pager.data("curr",page);

    if (settings.numbersPerPage > 1) {
        $('.page_link').hide();

        if (page < (numPages - settings.numbersPerPage)) {
            $('.page_link').slice(page, settings.numbersPerPage + page).show();
        }
        else {
            $('.page_link').slice(numPages-settings.numbersPerPage).show();
        }
    }

      pager.children().removeClass("active");
      pager.children().eq(page+2).addClass("active");
  }
};
// FIN FUNCION PAGINACION
