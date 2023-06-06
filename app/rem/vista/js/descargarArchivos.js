$(function(){
	$("#descargar").click(function(){
			
		var centro = $('select[name=centro]').val();
		var serie =  $('select[name=serie]').val();
		var mes =    $('select[name=mes]').val();
		var anio =   $('select[name=anio]').val();
		var fecha =  $('#fecha').val();
		var nombre = $('#nombre').val();
		
		$(location).attr('href','../controlador/servidor/downloadExcel.php?centro='+centro+'&serie='+serie+'&mes='+mes+'&anio='+anio);

	});
	
});

