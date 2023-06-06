$( document ).ready(function() {

	var permisos = $("#permisos").val();

	if (permisos == "7") {		 
		 $('#tabla2').hide(); 
	}else{
		 $('#tabla2').show(); 
	}

	/*var hoy= new Date();
	var dd = hoy.getDate();
	var mm = hoy.getMonth()+1; //hoy es 0!
	var yyyy = hoy.getFullYear();*/
	
	var hoy= new Date();
	var dd = hoy.getDate();
	var mm = hoy.getMonth(); //hoy es 0!
	var yyyy = hoy.getFullYear();


	if(dd === 1){
		if (mm === 1 || mm === 3 || mm === 5 || mm === 7 || mm === 8 || mm === 10 || mm === 12 ) {
				dd = 31;
				//var mm = hoy.getMonth()+1;
		}else{

			if (mm === 4 || mm === 6 || mm === 5 || mm === 9 || mm === 11) {
				dd = 30;
			}else{
				dd = 28;
			}
		}
	}else{
    	var hoy= new Date();
		var dd = hoy.getDate()-1;
		var mm = hoy.getMonth()+1;
		var yyyy = hoy.getFullYear();
    }

		
	if(dd<10) {dd='0'+dd} 

	if(mm<10) {mm='0'+mm} 
	fechaHoy = dd +'/'+ mm +'/'+ yyyy;

	$('input[name=desde]').val(fechaHoy);

	// carga el combo select 
	cargaSelect();
    $('#desde').datepicker();
    $('#hasta').datepicker();
    $('#medicamento').select2();

    //CARGA LOS PRIMEROS DATOS
    buscarData();

	$(".tab_content").hide(); 
	$("ul.nav li:first").addClass("active").show();
	$(".tab_content:first").show();
	$("ul.nav li").click(function() {
		$("ul.nav li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();
		var activeTab = $(this).find("a").attr("href");
		$(activeTab).fadeIn();
		return false;
	});	

     $("#abrirPopUp").click(function() {
     	//OPEN MODAL
		$("#manualUsuario").modal();
	});

    $('#ExportarData').on("click",function(){
    	$("#mensaje").empty();
	    var texto = "<h3> Descargando Archivo..  </h3>";
	    $("#mensaje").append(texto);
		$("#myModal").modal();
		setTimeout(cuentaAtras, 1000);
	    var array2= [];
		var centro= $('input:radio[name=rdbBuscar]:checked').val();
		var critico = $('input[name=criticoSi]').prop('checked');
		var medicamento= $('select[name=medicamento]').val();
		var Fdesde = $('input[name=desde]').val();
		var Fhasta = $('input[name=hasta]').val();

		if (medicamento === null) {
			medicamento = "0";
		}else{
			var valor = medicamento.length;
			for(i= 0; i<valor;i++){
				array2.push("'"+medicamento[i]+"'");
			}
			medicamento = array2;
		}

		if (critico === false) {
			critico = "TOTAL";
		}else{
			critico = "SI";
		}
		
		window.location = "../controlador/servidor/reporteFarmacia.php?fecha1="+Fdesde+"&fecha2="+Fhasta+"&medicamento="+medicamento+"&centro="+centro+"&critico="+critico;
		
    });

    
    $("#myTable").tablesorter({ sortList: [[0,0], [1,0]] });

    //VALIDA Y BUSCA POR UNA O DOS FECHAS
     $('#ejecutar').on("click",function(){ 
		var fecha1 = $('input[name=desde]').val();
		var fecha2 = $('input[name=hasta]').val();
		var resultado = validate_fechaMayorQue(fecha1,fecha2);

		if (resultado ===  true) {
			if (fecha1 !== "" && fecha2 ==="") {
				buscarData();
				$("#ExportarData").show();
			}else{
				$("#ExportarData").hide();
				$("#mensaje").empty();
				var texto = "<h3> La fecha no puede ser menor que la primera ..  </h3>";
				$("#mensaje").append(texto);
				$("#myModal").modal();
			}	
		}else{
			if (fecha1 === "" && fecha2 ==="") {
				$("#ExportarData").hide();
				$("#mensaje").empty();
				var texto = "<h3> Debe seleccionar un rango de fechas..  </h3>";
				$("#mensaje").append(texto);
				$("#myModal").modal();
			}else{
				$("#ExportarData").show();
				buscarData();
			}
		}

     });


}); //END JQUERY


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
    var rangoini = fecha1 		// document.getElementById('fec_inicio').value;
    var rangofin =  fecha2 		//document.getElementById('fec_fin').value;
     
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

function buscarData(){
	window.parent.$("#loader").show();
	var desde = separar_fecha1();
	var hasta = separar_fecha2();
	var centro= $('input:radio[name=rdbBuscar]:checked').val();
	var codigo= "";
	var critico =  $('input[name=criticoSi]').prop('checked'); //$('input:radio[name=critico]:checked').val();
	var medicamento = $('select[name=medicamento]').val();
	var array2= [];
	if (medicamento === null) {
		medicamento = "0";
	}else{
		var valor = medicamento.length;
		for(i= 0; i<valor;i++){
			array2.push("'"+medicamento[i]+"'");
		}
		medicamento = array2;
	}

	if (critico === false) {
		critico = "TOTAL";
	}else{
		critico = "SI";
	}

	var data = {
		evento:"obtenerData",
		desde: desde,
		hasta: hasta,
		centro:centro,
		codigo:codigo,
		critico:critico,
		medicamento: medicamento
	};

	$.ajax({
		url : "../controlador/servidor/controladorFarmacia.php?evento=obtenerData&fecha1="+desde+"&fecha2="+hasta+"&centro="+centro+"&codigo="+codigo+"&medicamento="+medicamento+"&critico="+critico+"",
		method : "POST",
		contentType:false,
		processData:false,
		cache: false,
		beforeSend:function(response){
			console.log("Peticion Recibida");
		},
		success:function(response){
			resultado =  JSON.parse(response);
			//$("#example").dataTable().fnDestroy();
			$('#tabla_resultados').empty();
			if (resultado === 0 || resultado[0].centro === "0") {
				$('#tabla_resultados').append("<tr>"
				+"<td colspan= 14> No se han encontrado Resultados ...</td>"
				+"</tr>");
				$("#myPager").hide();
				$("#ExportarData").hide();

				window.parent.$("#loader").hide();
			}else{
				
				$("#ExportarData").show();
				var i = 0;
				for(var aux = 0 in resultado){
					i= i+1;
						$('#tabla_resultados').append("<tr>"
							+"<td>"+i+"</td>"
							+"<td style='width: 8%;'>"+resultado[aux].fecha+"</td>"
							+"<td>"+resultado[aux].centro+"</td>"
							+"<td>"+resultado[aux].codigo+"</td>"
							+"<td style='width: 22%;'>"+resultado[aux].material+"</td>"
							+"<td>"+resultado[aux].stockInicial+"</td>"
							+"<td>"+resultado[aux].nDeIngresos+"</td>"
							+"<td>"+resultado[aux].totalDispensadas+"</td>"
							+"<td>"+resultado[aux].totalEgresos+"</td>"
							+"<td>"+resultado[aux].stockFinal+"</td>"
							+"<td>"+resultado[aux].maximo+"</td>"
							+"<td>"+resultado[aux].critico+"</td>"
							+"<td>"+resultado[aux].estado+"</td>"
							+"<td>"+resultado[aux].solicitar+"</td>"
						+"</tr>");
				}// end FOR
				
				if(resultado.length >15 ){
					$("#myPager").show();
				}else{
					$("#myPager").hide();
				}

				$('#tabla_resultados').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:15});
				window.parent.$("html,body").animate({ scrollTop: 0 }, 600);
				//$("#example").tablesorter();
			}
			window.parent.$("#loader").hide();
		},
		error:function(e){
			console.log("Error en el sistema");
		}
	});
}


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