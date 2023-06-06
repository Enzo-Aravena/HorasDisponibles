<?php
	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modeloFarmacia.php");


	//conexion a bd
	$bd = new Conexion();
	$conn = $bd->Conectar();
	$modelo = new claseFarmacia();
		$fecha1 = $_REQUEST['fecha1'];
		$fecha2 = $_REQUEST['fecha2'];
		$centro = $_REQUEST['centro'];
		$critico = $_REQUEST['critico'];
		$medicamento = $_REQUEST['medicamento'];
	
		if (empty($fecha1)) {
		    $fecha1 = date("Y-m-d",  strtotime("Yesterday"));
			$fecha2 = date("Y-m-d", strtotime("Yesterday"));
		}else{

			$fes = explode("/", $_GET['fecha1']);
			$fecha1= $fes[2]."-".$fes[1]."-".$fes[0];
			
			if ($fecha2 == "" || $fecha2 == "undefined") {
				 $fecha2 = $fecha1;
			} else {

				$FECH2 = explode("/", $_GET['fecha2']);
				$fecha2= $FECH2[2]."-".$FECH2[1]."-".$FECH2[0];
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
			}
		}else{
			if ($centro == 0){				
				$modelo->setCodigo($medicamento);
				$modelo->setCentro($centro);
				$modelo->setDesde($fecha1);
				$modelo->setHasta($fecha2);
				$modelo->setCritico1($critico1);
				$modelo->setCritico2($critico2);
				$data = $modelo->DATOS_FARMACIA_TRES($conn);
			}else {
			 	$modelo->setCentro($centro);
			 	$modelo->setCodigo($medicamento);
				$modelo->setDesde($fecha1);
				$modelo->setHasta($fecha2);
				$modelo->setCritico1($critico1);
				$modelo->setCritico2($critico2);
				$data = $modelo->DATOS_FARMACIA_CUATRO($conn);
			} 
		}


/*******************************  REPORTE EXCEL  ****************************************************/
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
	header('Content-Disposition: attachment; filename=ReporteFarmacia.xls');
		echo "<table  border='1' cellpadding='2' cellspacing='0'>";
		echo "<thead style='background-color: green;color:white;'>";
		echo "<th>FECHA</th>";
		echo "<th>CENTRO</th>";
		echo "<th>CODIGO</th>";
		echo "<th>MATERIAL</th>";
		echo "<th>STOCK_INICIAL</th>";
		echo "<th>TOTAL_INGRESOS</th>";
		echo "<th>TOTAL_DISPENSADAS</th>";
		echo "<th>TOTAL_EGRESOS</th>";
		echo "<th>STOCK_FINAL</th>";
		echo "<th>MAXIMO</th>";
		echo "<th>CRITICO</th>";
		echo "<th>ESTADO_SOLICITUD</th>";
		echo "<th>SOLICITAR</th>";
		echo "</thead>";
		echo "<tbody>";
		$i = 2;
		foreach($data as $clave => $valor){
			echo "<tr>";
				echo "<td>".$valor["fecha"]."</td>";
				echo "<td>".$valor["centro"]."</td>";
				echo "<td>".$valor["codigo"]."</td>";
				echo "<td>".utf8_decode($valor["material"])."</td>";
				echo "<td>".$valor["stockInicial"]."</td>";
				echo "<td>".$valor["nDeIngresos"]."</td>";
				echo "<td>".$valor["totalDispensadas"]."</td>";
				echo "<td>".$valor["totalEgresos"]."</td>";
				echo "<td>".$valor["stockFinal"]."</td>";
				echo "<td>".$valor["maximo"]."</td>";
				echo "<td>".$valor["critico"]."</td>";
				echo "<td>".$valor["estado"]."</td>";
				echo "<td>".$valor["solicitar"]."</td>";
			echo "</tr>";
			$i++;
		}
		echo "</tbody>";
		echo "</table>";
?>