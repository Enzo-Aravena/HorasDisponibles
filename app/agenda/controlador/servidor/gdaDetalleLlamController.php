<?php
	error_reporting(0);
	require_once ("../../../../lib/conexion/db_tic.php");
	require_once("../../modelo/modelogdaDetalleLlamadas.php");

	$bd = new Conexion();
	$modelo = new modeloGdaDetLlamadas();

	$conn = $bd->Conectar();
	$evento = $_REQUEST["evento"];

	switch($evento){
		case "todo":
			if ($_GET['fecha1']==0) {
				$date1 = new DateTime('Today');
				if($date1->format('l') != 'Monday'){
					$date1->modify('Last Monday');
				}
				$fecha1 = $date1->format('Y-m-d');
				$fecha2 = date("Y-m-d", strtotime("Tomorrow"));
			}else{
				$fes = explode("/", $_GET['fecha1']);
				$fecha1 = $fes[2]."-".$fes[1]."-".$fes[0];
		
				if ($_GET['fecha2']==0) {
					$fecha2 = $fecha1;
				} else {
					$fes2 = explode("/", $_GET['fecha2']);
					$fecha2 = $fes2[2]."-".$fes2[1]."-".$fes2[0];
				}
			}
					
			$semana = $_GET['semana'];
			$centro = $_GET['centro'];

			if ($semana == 0)
			{
				if ($centro ==0) {
					$modelo->setDesde($fecha1);
					$modelo->setHasta($fecha2);
					$data = $modelo->obtenerTodoElDetalleLlamadasGDA($conn);

					if ($data == "") {
						echo "0";
					}else{
						echo  json_encode($data);
					}
				}else{
					$modelo->setDesde($fecha1);
					$modelo->setHasta($fecha2);
					$modelo->setCentro($centro);
					$data = $modelo->OBTENER_DATOS_POR_DIA($conn);

					if ($data == "") {
						echo "0";
					}else{
						echo  json_encode($data);
					}
				}
			}else{
				$arreglo = array();
				for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
					$dia=date("w", strtotime($i));
					if($dia==$semana)
					{
						array_push($arreglo,"'".date("Y-m-d",strtotime($i))."'");
					}
				}
				if ($centro==0) {
					$modelo->setDesde(implode(',',$arreglo));
					$data = $modelo->OBTENER_VALORES_POR_DIA($conn);
					if ($data == "") {
						echo "0";
					}else{
						echo  json_encode($data);
					}

				}else{
					$modelo->setDesde(implode(',',$arreglo));
					$modelo->setCentro($centro);
					$data = $modelo->OBTENER_VALORES_POR_DIA_CENTRO($conn);
					if ($data == "") {
						echo "0";
					}else{
						echo  json_encode($data);
					}
				}
			}

		break;

		case 'table':
			if ($_GET['fecha1']==0) {
				$date1 = new DateTime('Today');
				if($date1->format('l') != 'Monday'){
					$date1->modify('Last Monday');
				}
				$fecha1 = $date1->format('Y-m-d');
				$fecha2 = date("Y-m-d", strtotime("Tomorrow"));
			}else{
				$fes = explode("/", $_GET['fecha1']);
				$fecha1 = $fes[2]."-".$fes[1]."-".$fes[0];
		
				if ($_GET['fecha2']==0) {
					$fecha2 = $fecha1;
				} else {
					$fes2 = explode("/", $_GET['fecha2']);
					$fecha2 = $fes2[2]."-".$fes2[1]."-".$fes2[0];
				}
			}
					
			$semana = $_GET['semana'];
			$centro = $_GET['centro'];

			if ($semana == 0)
			{
				if ($centro ==0) {
					$modelo->setDesde($fecha1);
					$modelo->setHasta($fecha2);
					$data = $modelo->OBTENER_TABLA_UNO($conn);

					if ($data == "") {
						echo "0";
					}else{
						echo  json_encode($data);
					}
				}else{
					$modelo->setDesde($fecha1);
					$modelo->setHasta($fecha2);
					$modelo->setCentro($centro);
					$data = $modelo->OBTENER_TABLA_DOS($conn);

					if ($data == "") {
						echo "0";
					}else{
						echo  json_encode($data);
					}
				}
			}else{
				$arreglo = array();
				for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
					$dia=date("w", strtotime($i));
						if($dia==$semana)
						{
							array_push($arreglo,"'".date("Y-m-d",strtotime($i))."'");
						}
				}
				if ($centro==0) {
					$modelo->setSemana($semana);
					$modelo->setDesde(implode(',',$arreglo));
					$data = $modelo->OBTENER_TABLA_TRES($conn);
					if ($data == "") {
						echo "0";
					}else{
						echo  json_encode($data);
					}


				}else{
					$modelo->setDesde(implode(',',$arreglo));
					$modelo->setCentro($centro);
					$data = $modelo->OBTENER_TABLA_CUATRO($conn);
					if ($data == "") {
						echo "0";
					}else{
						echo  json_encode($data);
					}
				}
			}

		break;

		default:
			echo "Se ha ocurrido un error al cargar los datos";
		break;
	}


?>