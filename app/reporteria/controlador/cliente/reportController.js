function uploadData(uno,dos,tres,cuatro,cinco,seis){
	//function uploadData(){
	var resultado = null;
	var url= "../controlador/servidor/reportController.php";
	var type= "POST";
	
	$.ajax({
		url:url,
		type:type,
		data:new FormData($("#detalle")[0]),uno,dos,tres,cuatro,cinco,seis,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend:function(){
			console.log("Peticion Recibida");
		},
		success:function(response){
			resultado = response;

			if (response === "0") {
				alert("El archivo procesado no tiene Rut para procesar.");
			}else{
				$("#tabla_resultados").empty();
				$("#tabla_resultados").append(response);
				exportar();	
			}
		},
		error:function(e){
			console.log("Error de la peticion");
		}
	});
}



//FUNCION DE LIBRERIA
//download();
/*function download(){
	Exporter.export(dataTable, 'archivo.xls', 'Courses');return false;
}*/


//FUNCION QUE EXPORTA DESDE JAVASCRIPT LOS DATOS SOLICITADOS
function exportar(){
        var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
        var table = 'dataTable';
        var name = 'reportería';
        if (!table.nodeType) table = document.getElementById(table)
         var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
         window.location.href = uri + base64(format(template, ctx))
}