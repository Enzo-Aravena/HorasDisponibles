<?php

require_once ("../../../../lib/PHPExcel/PHPExcel.php");
require_once ("../../../../lib/PHPExcel/PHPExcel/IOFactory.php");
require_once ("../../../../lib/conexion/conexion.php");
require_once("../../modelo/modeloFarmacia.php");

ini_set('memory_limit', '1G');

$bd = new Conexion();
$modelo = new claseFarmacia();

$conn = $bd->Conectar();
$evento = $_REQUEST["evento"];

switch ($evento) {
	case 'select':		
		$data = $modelo->uploadSelectData($conn);
		echo json_encode($data);
	break;
	case 'obtenerData':
		$fecha1 = $_REQUEST['fecha1'];
		$fecha2 = $_REQUEST['fecha2'];
		$centro = $_REQUEST['centro'];
		$critico = $_REQUEST['critico'];
		$medicamento = $_REQUEST['medicamento'];
	
		if (empty($fecha1)) {
		    $fecha1 = date("Y-m-d",  strtotime("Yesterday"));
			$fecha2 = date("Y-m-d", strtotime("Yesterday"));
		}else{
			$fecha1= $fecha1;
			
			if ($fecha2 == "" || $fecha2 == "undefined") {
				 $fecha2 = date("Y-m-d", strtotime($fecha1));
			} else {
				$fecha2= $fecha2;
			}
		 }


		if ($medicamento == "" || $medicamento == "undefined" || empty($medicamento)) {
		 	$medicamento = "0";
		}else{
		 	$medicamento = $medicamento;
		}

		if ($critico == "TOTAL") {
			$critico1 = "SI";
			$critico2 = "NO";
 		}else{
		 	$critico1 = $critico;
 		 	$critico2 = $critico;
 		}


		if ($medicamento == '0' ){
			if ($centro == 0){
				$modelo->setDesde($fecha1);
				$modelo->setHasta($fecha2);
				$modelo->setCritico1($critico1);
				$modelo->setCritico2($critico2);
				$data = $modelo->DATOS_FARMACIA_UNO($conn);
			}else{
				$modelo->setCentro($centro);
				$modelo->setDesde($fecha1);
				$modelo->setHasta($fecha2);
				$modelo->setCritico1($critico1);
				$modelo->setCritico2($critico2);
				$data = $modelo->DATOS_FARMACIA_DOS($conn);
			}//END ELSE INTERNO
		}else{
			if ($centro == 0){				
				$modelo->setCodigo($medicamento);
				$modelo->setCentro($centro);
				$modelo->setDesde($fecha1);
				$modelo->setHasta($fecha2);
				$modelo->setCritico1($critico1);
				$modelo->setCritico2($critico2);
				$data = $modelo->DATOS_FARMACIA_TRES($conn);
			}else{
			 	$modelo->setCentro($centro);
			 	$modelo->setCodigo($medicamento);
				$modelo->setDesde($fecha1);
				$modelo->setHasta($fecha2);
				$modelo->setCritico1($critico1);
				$modelo->setCritico2($critico2);
				$data = $modelo->DATOS_FARMACIA_CUATRO($conn);
			}//END ELSE INTERNO
		}// END ELSE

		echo json_encode($data);
	break;	

	default:
		echo "Error ..";
	break;

}

?>

