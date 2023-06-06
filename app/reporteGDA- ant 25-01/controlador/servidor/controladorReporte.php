<?php
	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modeloReporteCentro.php");

	$bd = new Conexion();
	$reporte = new reporteGda();

	$conn = $bd->Conectar();
	$evento = $_REQUEST['evento'];


	switch ($evento) {
	
	case 'buscarCentro':

		$centro = $_REQUEST['centro'];
		$reporte->setCentro($centro);
		$data = $reporte->buscarCentroUsuario($conn);
		if ($data[0]["data"] == "0") {
			echo "0";
		}else{
			echo  json_encode($data);
		}		
		
		break;

	case 'buscarRangoFechas':
		$centro = $_REQUEST['centro'];
		$desde  = $_REQUEST['desde'];
		$hasta  = $_REQUEST['hasta'];
		$reporte->setCentro($centro);
		$reporte->setDesde($desde);
		$reporte->setHasta($hasta);
		$data = $reporte->BuscarPorRangoFechas($conn);
		if ($data[0]["data"] == "0") {
			echo "0";
		}else{
			echo  json_encode($data);
		}
	break;

	case 'cargaCicloDiarios':
		$centro = $_REQUEST['centro'];
		$fechaHoy  = $_REQUEST['fechaHoy'];
		$reporte->setCentro($centro);
		$reporte->setHoy($fechaHoy);
		$data = $reporte->MostrarReporteDiario($conn);
		if ($data[0]["data"] == "0") {
			echo "0";
		}else{
			echo  json_encode($data);
		}		
			
	break;
	
	case 'buscaPorUnaFecha':

		$centro = $_REQUEST['centro'];
		$desde  = $_REQUEST['desde'];
		$reporte->setCentro($centro);
		$reporte->setDesde($desde);
		$data = $reporte->MostrarPorFecha($conn);
		if ($data[0]["data"] == "0") {
			echo "0";
		}else{
			echo  json_encode($data);
		}		

	

	break;

	default:
		print("Error al buscar Datos en la base de datos");
	break;
}


?>