<?php

require_once ("../../../../lib/conexion/conexionCampanaInvierno.php");
require_once("../../modelo/modeloCampana.php");
require_once "../../../../lib/PHPExcel/PHPExcel.php";
require_once "../../../../lib/PHPExcel/PHPExcel/IOFactory.php";

	$bd = new Conexion();
	$modelo = new claseCampana();

	$conn = $bd->Conectar();

	$desde = $_REQUEST['fecha1'];
	$hasta = $_REQUEST['fecha2'];
	$centro = $_REQUEST['centro'];
	$semana = $_GET['semana'];

	if(empty($desde)){
		$fecha1 = 0;
	}else{
		$dato  = explode("/", $desde);
		$fecha1 = $dato[2]."-".$dato[1]."-".$dato[0];
	}

	if(empty($hasta)){
		$fecha2 = 0;
	}else{
		$dato  = explode("/", $hasta);
		$fecha2 = $dato[2]."-".$dato[1]."-".$dato[0];
	}	

	$fecha1_aux = date("d-m-Y", strtotime($_GET['fecha1']));
	$fecha2_aux = date("d-m-Y", strtotime($_GET['fecha2']));	

	if($semana == 0){
		$semana_aux = "TOTAL ACUMULADAS SEMANAS EPIDEMIOLOGICAS";
	}else{
		$semana_aux = "ATENCIONES SEMANAS EPIDEMIOLOGICAS $semana 2016";
	}

	if ($fecha1 == 0) {	 
		if($semana == 0 ){
			if ($centro ==0) {
				$data = json_encode($modelo->CAMIN_OBTENER_DATOS_TABLA_UNO($conn));
			}else{
				$modelo->setCentro($centro);
				$data = json_encode($modelo->CAMIN_OBTENER_DATOS_TABLA_EXCEL_DOS($conn));
			}// END ELSE CENTRO
		}else{
			if ($centro ==0) {
				$modelo->setSemana($semana);
				$data = json_encode($modelo->CAMIN_OBTENER_DATOS_TABLA_EXCEL_TRES($conn));
			}else{
				$modelo->setSemana($semana);
				$modelo->setCentro($centro);
				$data =json_encode($modelo->CAMIN_OBTENER_DATOS_TABLA_EXCEL_CUATRO($conn));
			}// END ELSE CENTRO

		} // END ELSE SEMANA
	}else{
		if ($centro ==0) {
			$modelo->setDesde($fecha1);
			$modelo->setHasta($fecha2);
			$data = json_encode($modelo->CAMIN_OBTENER_DATOS_TABLA_EXCEL_CINCO($conn));
		}else{
			$modelo->setDesde($fecha1);
			$modelo->setHasta($fecha2);
			$modelo->setCentro($centro);
			$data = json_encode($modelo->CAMIN_OBTENER_DATOS_TABLA_EXCEL_SEIS($conn));

		}// END ELSE CENTRO

	}//  END ELSE FECHA

		header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
		header('Content-Disposition: attachment; filename=ReporteCampanaInvierno.xls');


	if ($_GET['fecha1']==0) {	
		$titulosColumnas = array($semana_aux, 'CENTRO', 'TOTAL', '- 1 ANO','1 A 4 ANOS','5 A 14 ANOS','15 A 64 ANOS','65 ANOS Y +');
	}else{
		$titulosColumnas = array('ATENCIONES ENTRE '.$fecha1_aux. ' HASTA '.$fecha2_aux, 'CENTRO', 'TOTAL', '- 1 ANO','1 A 4 ANOS','5 A 14 ANOS','15 A 64 ANOS','65 ANOS Y +');
	}

	echo "<table  border='1' cellpadding='2' cellspacing='0'>";
	echo "<thead style='background-color: green;color:white;'>";
	
	foreach($titulosColumnas as $clave => $valor){
			echo "<th>".utf8_encode($valor)."</th>";
	}
	echo "</thead>";
	echo "<tbody>";

	$arreglo = json_decode($data);

	$i = 2;
	foreach ($arreglo as $obj) {
		echo "<tr>";
			echo "<td>".'Total Atenciones del CESFAM (contiene las respiratorias)'."</td>";
			echo "<td>".$obj->CENTRO."</td>";
			echo "<td>".$obj->{'1_1'}."</td>";
			echo "<td>".$obj->{'1_2'}."</td>";
			echo "<td>".$obj->{'1_3'}."</td>";
			echo "<td>".$obj->{'1_4'}."</td>";
			echo "<td>".$obj->{'1_5'}."</td>";
			echo "<td>".$obj->{'1_6'}."</td>";
		echo "</tr>";
				
		echo "<tr>";
			echo "<td>".'Total Atenciones por causa Sistema Respiratorio'."</td>";
			echo "<td>".$obj->CENTRO."</td>";
			echo "<td>".$obj->{'2_1'}."</td>";
			echo "<td>".$obj->{'2_2'}."</td>";
			echo "<td>".$obj->{'2_3'}."</td>";
			echo "<td>".$obj->{'2_4'}."</td>";
			echo "<td>".$obj->{'2_5'}."</td>";
			echo "<td>".$obj->{'2_6'}."</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>".'Ira Alta (J00,J06)'."</td>";
			echo "<td>".$obj->CENTRO."</td>";
			echo "<td>".$obj->{'3_1'}."</td>";
			echo "<td>".$obj->{'3_2'}."</td>";
			echo "<td>".$obj->{'3_3'}."</td>";
			echo "<td>".$obj->{'3_4'}."</td>";
			echo "<td>".$obj->{'3_5'}."</td>";
			echo "<td>".$obj->{'3_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td>".'Influenza (J09,J11)'."</td>";
			echo "<td>".$obj->CENTRO."</td>";
			echo "<td>".$obj->{'4_1'}."</td>";
			echo "<td>".$obj->{'4_2'}."</td>";
			echo "<td>".$obj->{'4_3'}."</td>";
			echo "<td>".$obj->{'4_4'}."</td>";
			echo "<td>".$obj->{'4_5'}."</td>";
			echo "<td>".$obj->{'4_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td>".'Neumonia (J12,J18)'."</td>";
			echo "<td>".$obj->CENTRO."</td>";
			echo "<td>".$obj->{'5_1'}."</td>";
			echo "<td>".$obj->{'5_2'}."</td>";
			echo "<td>".$obj->{'5_3'}."</td>";
			echo "<td>".$obj->{'5_4'}."</td>";
			echo "<td>".$obj->{'5_5'}."</td>";
			echo "<td>".$obj->{'5_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td>".'Bronquitis/Bronquiolitis aguda (J20,J21)'."</td>";
			echo "<td>".$obj->CENTRO."</td>";
			echo "<td>".$obj->{'6_1'}."</td>";
			echo "<td>".$obj->{'6_2'}."</td>";
			echo "<td>".$obj->{'6_3'}."</td>";
			echo "<td>".$obj->{'6_4'}."</td>";
			echo "<td>".$obj->{'6_5'}."</td>";
			echo "<td>".$obj->{'6_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
			echo "<td>".'Crisis obstructiva bronquial (J40,J46)'."</td>";
			echo "<td>".$obj->CENTRO."</td>";
			echo "<td>".$obj->{'7_1'}."</td>";
			echo "<td>".$obj->{'7_2'}."</td>";
			echo "<td>".$obj->{'7_3'}."</td>";
			echo "<td>".$obj->{'7_4'}."</td>";
			echo "<td>".$obj->{'7_5'}."</td>";
			echo "<td>".$obj->{'7_6'}."</td>";

		echo "</tr>";

		echo "<tr>";
			echo "<td>".'Otras causas respiratorias (J22,J30,J39,J47,J60,J98)'."</td>";
			echo "<td>".$obj->CENTRO."</td>";
			echo "<td>".$obj->{'8_1'}."</td>";
			echo "<td>".$obj->{'8_2'}."</td>";
			echo "<td>".$obj->{'8_3'}."</td>";
			echo "<td>".$obj->{'8_4'}."</td>";
			echo "<td>".$obj->{'8_5'}."</td>";
			echo "<td>".$obj->{'8_6'}."</td>";
		echo "</tr>";
		$i++;
	}

?>