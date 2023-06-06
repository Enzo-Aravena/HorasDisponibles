<?php

require_once ("../../../../lib/conexion/conexion.php");
require_once("../../modelo/modeloInaMed.php");

$bd = new Conexion();
$modelo = new claseInsumos();

$conn = $bd->Conectar();

$evento = $_REQUEST["evento"];

switch ($evento) {
	case 'cargarPacientes':
		$data = $modelo->mostrarPacientes($conn);
		echo json_encode($data);
	break;

	case 'cargarPacientesxParametro':
		$rut = $_REQUEST['rut'];
		$desde = $_REQUEST['desde'];
		$hasta = $_REQUEST['hasta'];

		if ($rut !== "" && $desde === "" && $hasta === "" ) {
			$modelo->setRut($rut);
			$modelo->setRut($rut);
			$modelo->setDesde($desde);
			$modelo->setHasta($hasta);
			$data = $modelo->mostrarPacientesBase($conn);
			echo json_encode($data);
		}else{
			if ($desde !== "" && $hasta === "") {
				$modelo->setRut($rut);
				$modelo->setRut($rut);
				$modelo->setDesde($desde);
				$modelo->setHasta($hasta);

				$data = $modelo->mostrarPacientesBase($conn);
				echo json_encode($data);
			}else{
				$modelo->setRut($rut);
				$modelo->setRut($rut);
				$modelo->setDesde($desde);
				$modelo->setHasta($hasta);
				$data = $modelo->mostrarPacientesBase($conn);
				echo json_encode($data);
			}
		}
	break;


	case 'cargarDatosNuevaFunction':
		$rut = $_REQUEST['rutPaciente'];
		$fecha1 = $_REQUEST['fecha1'];
		$fecha2 = $_REQUEST['fecha2'];
		$centro = $_REQUEST['centro'];
	
		if (empty($fecha1)) {
		    $fecha1 = "'".date("Y-m-d",  strtotime("Yesterday"))."'";
			$fecha2 = "'".date("Y-m-d", strtotime("Yesterday"))."'";
		}else{
			$fecha1= "'".$fecha1."'";
			if ($fecha2 == "" || $fecha2 == "undefined") {
				 $fecha2 = "'".date("Y-m-d", strtotime($fecha1))."'";
			} else {
				$fecha2= "'".$fecha2."'";
			}
		 }

		if ($rut == "") {
			$rut = "NULL"; 
		}else{
			$rut = "'".$rut."'";
			$fecha1 = "NULL";
			$fecha2 = "NULL";

		}
		if ($centro == "0") { $centro = "NULL"; }else{ $centro = $centro;}
		
		$modelo->setCentro($centro);
		$modelo->setRut($rut);
		$modelo->setDesde($fecha1);
		$modelo->setHasta($fecha2);
		$data = $modelo->mostrarPacientesPrueba($conn);
		echo json_encode($data);
	break;

	default:
		echo "Error ..";
	break;
}

?>