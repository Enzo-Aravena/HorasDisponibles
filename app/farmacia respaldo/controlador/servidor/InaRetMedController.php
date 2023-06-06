<?php

require_once ("../../../../lib/conexion/conexion.php");
require_once("../../modelo/modeloInaMed.php");
ini_set('memory_limit', '-1');
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
				//$data = $modelo->mostrarPacientesxFecha($conn);
				//echo json_encode($data);
			}else{

				$modelo->setRut($rut);
				$modelo->setRut($rut);
				$modelo->setDesde($desde);
				$modelo->setHasta($hasta);

				$data = $modelo->mostrarPacientesBase($conn);
				echo json_encode($data);
				//$data = $modelo->mostrarPacientesxRangoFecha($conn);
				//echo json_encode($data);
			}
		}
	break;

	default:
		echo "Error ..";
	break;
}

?>