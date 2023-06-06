<?php
	require_once ("../../../../lib/conexion/conexionCampanaInvierno.php");
	require_once("../../modelo/modeloCampanaSapu.php");
	require_once "../../../../lib/PHPExcel/PHPExcel.php";
	require_once "../../../../lib/PHPExcel/PHPExcel/IOFactory.php";

	$bd = new Conexion();
	$modelo = new claseCampanaSapu();
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
				$data = json_encode($modelo->OBTENER_REPORTE_EXCEL_UNO($conn));
			}else{
				$modelo->setCentro($centro);
				$data = json_encode($modelo->OBTENER_REPORTE_EXCEL_DOS($conn));
			}// END ELSE CENTRO
		}else{
			if ($centro ==0) {
				$modelo->setSemana($semana);
				$data = json_encode($modelo->OBTENER_REPORTE_EXCEL_TRES($conn));
			}else{
				$modelo->setSemana($semana);
				$modelo->setCentro($centro);
				$data =json_encode($modelo->OBTENER_REPORTE_EXCEL_CUATRO($conn));
			}// END ELSE CENTRO

		} // END ELSE SEMANA
	}else{
		if ($centro ==0) {
			$modelo->setDesde($fecha1);
			$modelo->setHasta($fecha2);
			$data = json_encode($modelo->OBTENER_REPORTE_EXCEL_CINCO($conn));
		}else{
			$modelo->setDesde($fecha1);
			$modelo->setHasta($fecha2);
			$modelo->setCentro($centro);
			$data = json_encode($modelo->OBTENER_REPORTE_EXCEL_SEIS($conn));

		}// END ELSE CENTRO

	}//  END ELSE FECHA


	/*******************************  REPORTE EXCEL  ****************************************************/
	header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
	header('Content-Disposition: attachment; filename=CampanaInviernoSapu.xls');

	if ($_GET['fecha1']==0) {
		$titulosColumnas = array($semana_aux, 'CENTRO', 'TOTAL', '- 1 ANO','1 A 4 ANOS','5 A 14 ANOS','15 A 64 ANOS','65 ANOS Y +');
	}else{
		$titulosColumnas = array('ATENCIONES ENTRE '.$fecha1_aux. ' HASTA '.$fecha2_aux, 'CENTRO', 'TOTAL', '- 1 ANO','1 A 4 ANOS','5 A 14 ANOS','15 A 64 ANOS','65 ANOS Y +');
	}

	$arreglo = json_decode($data);

	echo "<table  border='1' cellpadding='2' cellspacing='0'>";
	echo "<thead style='background-color: green;color:white;'>";
	foreach($titulosColumnas as $clave => $valor){
		echo "<th>".$valor."</th>";
	}
	echo "</thead>";
	echo "<tbody>";
	$i = 2;
	foreach ($arreglo as $obj) {
		echo "<tr>";		
				echo "<td>".'Total Protocolos Aplicados'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'1_1'}."</td>";
				echo "<td>".$obj->{'1_2'}."</td>";
				echo "<td>".$obj->{'1_3'}."</td>";
				echo "<td>".$obj->{'1_4'}."</td>";
				echo "<td>".$obj->{'1_5'}."</td>";
				echo "<td>".$obj->{'1_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'Total Diagnosticos Agrupados del 1 al 6'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'2_1'}."</td>";
				echo "<td>".$obj->{'2_2'}."</td>";
				echo "<td>".$obj->{'2_3'}."</td>";
				echo "<td>".$obj->{'2_4'}."</td>";
				echo "<td>".$obj->{'2_5'}."</td>";
				echo "<td>".$obj->{'2_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'01.Ira Alta'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'3_1'}."</td>";
				echo "<td>".$obj->{'3_2'}."</td>";
				echo "<td>".$obj->{'3_3'}."</td>";
				echo "<td>".$obj->{'3_4'}."</td>";
				echo "<td>".$obj->{'3_5'}."</td>";
				echo "<td>".$obj->{'3_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'02.Influenza'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'4_1'}."</td>";
				echo "<td>".$obj->{'4_2'}."</td>";
				echo "<td>".$obj->{'4_3'}."</td>";
				echo "<td>".$obj->{'4_4'}."</td>";
				echo "<td>".$obj->{'4_5'}."</td>";
				echo "<td>".$obj->{'4_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'03.Neumonia'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'5_1'}."</td>";
				echo "<td>".$obj->{'5_2'}."</td>";
				echo "<td>".$obj->{'5_3'}."</td>";
				echo "<td>".$obj->{'5_4'}."</td>";
				echo "<td>".$obj->{'5_5'}."</td>";
				echo "<td>".$obj->{'5_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'04.Bronquitis Aguda'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'6_1'}."</td>";
				echo "<td>".$obj->{'6_2'}."</td>";
				echo "<td>".$obj->{'6_3'}."</td>";
				echo "<td>".$obj->{'6_4'}."</td>";
				echo "<td>".$obj->{'6_5'}."</td>";
				echo "<td>".$obj->{'6_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'05.Sbo'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'7_1'}."</td>";
				echo "<td>".$obj->{'7_2'}."</td>";
				echo "<td>".$obj->{'7_3'}."</td>";
				echo "<td>".$obj->{'7_4'}."</td>";
				echo "<td>".$obj->{'7_5'}."</td>";
				echo "<td>".$obj->{'7_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'06.Otra Causa Respiratoria'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'8_1'}."</td>";
				echo "<td>".$obj->{'8_2'}."</td>";
				echo "<td>".$obj->{'8_3'}."</td>";
				echo "<td>".$obj->{'8_4'}."</td>";
				echo "<td>".$obj->{'8_5'}."</td>";
				echo "<td>".$obj->{'8_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'07.Iam'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'9_1'}."</td>";
				echo "<td>".$obj->{'9_2'}."</td>";
				echo "<td>".$obj->{'9_3'}."</td>";
				echo "<td>".$obj->{'9_4'}."</td>";
				echo "<td>".$obj->{'9_5'}."</td>";
				echo "<td>".$obj->{'9_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'08.Ave'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'10_1'}."</td>";
				echo "<td>".$obj->{'10_2'}."</td>";
				echo "<td>".$obj->{'10_3'}."</td>";
				echo "<td>".$obj->{'10_4'}."</td>";
				echo "<td>".$obj->{'10_5'}."</td>";
				echo "<td>".$obj->{'10_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'09.Crisis Hta'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'11_1'}."</td>";
				echo "<td>".$obj->{'11_2'}."</td>";
				echo "<td>".$obj->{'11_3'}."</td>";
				echo "<td>".$obj->{'11_4'}."</td>";
				echo "<td>".$obj->{'11_5'}."</td>";
				echo "<td>".$obj->{'11_6'}."</td>";
		echo "</tr>";

		echo "<tr>";		
				echo "<td>".'10.Arritmia'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'12_1'}."</td>";
				echo "<td>".$obj->{'12_2'}."</td>";
				echo "<td>".$obj->{'12_3'}."</td>";
				echo "<td>".$obj->{'12_4'}."</td>";
				echo "<td>".$obj->{'12_5'}."</td>";
				echo "<td>".$obj->{'12_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'11.Otras Causas Circulatorias'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'13_1'}."</td>";
				echo "<td>".$obj->{'13_2'}."</td>";
				echo "<td>".$obj->{'13_3'}."</td>";
				echo "<td>".$obj->{'13_4'}."</td>";
				echo "<td>".$obj->{'13_5'}."</td>";
				echo "<td>".$obj->{'13_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'12.Accidentes Del Transito'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'14_1'}."</td>";
				echo "<td>".$obj->{'14_2'}."</td>";
				echo "<td>".$obj->{'14_3'}."</td>";
				echo "<td>".$obj->{'14_4'}."</td>";
				echo "<td>".$obj->{'14_5'}."</td>";
				echo "<td>".$obj->{'14_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'13.Otros Traumatismos'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'15_1'}."</td>";
				echo "<td>".$obj->{'15_2'}."</td>";
				echo "<td>".$obj->{'15_3'}."</td>";
				echo "<td>".$obj->{'15_4'}."</td>";
				echo "<td>".$obj->{'15_5'}."</td>";
				echo "<td>".$obj->{'15_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'14.Heridas Por Arma Blanca'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'16_1'}."</td>";
				echo "<td>".$obj->{'16_2'}."</td>";
				echo "<td>".$obj->{'16_3'}."</td>";
				echo "<td>".$obj->{'16_4'}."</td>";
				echo "<td>".$obj->{'16_5'}."</td>";
				echo "<td>".$obj->{'16_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'15.Heridas Por Arma De Fuego'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'17_1'}."</td>";
				echo "<td>".$obj->{'17_2'}."</td>";
				echo "<td>".$obj->{'17_3'}."</td>";
				echo "<td>".$obj->{'17_4'}."</td>";
				echo "<td>".$obj->{'17_5'}."</td>";
				echo "<td>".$obj->{'17_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'16.Mordedura De Animal'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'18_1'}."</td>";
				echo "<td>".$obj->{'18_2'}."</td>";
				echo "<td>".$obj->{'18_3'}."</td>";
				echo "<td>".$obj->{'18_4'}."</td>";
				echo "<td>".$obj->{'18_5'}."</td>";
				echo "<td>".$obj->{'18_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'17.Vif'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'19_1'}."</td>";
				echo "<td>".$obj->{'19_2'}."</td>";
				echo "<td>".$obj->{'19_3'}."</td>";
				echo "<td>".$obj->{'19_4'}."</td>";
				echo "<td>".$obj->{'19_5'}."</td>";
				echo "<td>".$obj->{'19_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'18.Violencia Sexual'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'20_1'}."</td>";
				echo "<td>".$obj->{'20_2'}."</td>";
				echo "<td>".$obj->{'20_3'}."</td>";
				echo "<td>".$obj->{'20_4'}."</td>";
				echo "<td>".$obj->{'20_5'}."</td>";
				echo "<td>".$obj->{'20_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'19.Intento De Suicidio'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'21_1'}."</td>";
				echo "<td>".$obj->{'21_2'}."</td>";
				echo "<td>".$obj->{'21_3'}."</td>";
				echo "<td>".$obj->{'21_4'}."</td>";
				echo "<td>".$obj->{'21_5'}."</td>";
				echo "<td>".$obj->{'21_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'20.Descompensacion Psiquiatrica'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'22_1'}."</td>";
				echo "<td>".$obj->{'22_2'}."</td>";
				echo "<td>".$obj->{'22_3'}."</td>";
				echo "<td>".$obj->{'22_4'}."</td>";
				echo "<td>".$obj->{'22_5'}."</td>";
				echo "<td>".$obj->{'22_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'21.Diabetes Descompensada'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'23_1'}."</td>";
				echo "<td>".$obj->{'23_2'}."</td>";
				echo "<td>".$obj->{'23_3'}."</td>";
				echo "<td>".$obj->{'23_4'}."</td>";
				echo "<td>".$obj->{'23_5'}."</td>";
				echo "<td>".$obj->{'23_6'}."</td>";
		echo "</tr>";

		echo "<tr>";
				echo "<td>".'22.Diarreas'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'24_1'}."</td>";
				echo "<td>".$obj->{'24_2'}."</td>";
				echo "<td>".$obj->{'24_3'}."</td>";
				echo "<td>".$obj->{'24_4'}."</td>";
				echo "<td>".$obj->{'24_5'}."</td>";
				echo "<td>".$obj->{'24_6'}."</td>";
		echo "</tr>";

		echo "<tr>";		
				echo "<td>".'23.Otras Gastrointestinales'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'25_1'}."</td>";
				echo "<td>".$obj->{'25_2'}."</td>";
				echo "<td>".$obj->{'25_3'}."</td>";
				echo "<td>".$obj->{'25_4'}."</td>";
				echo "<td>".$obj->{'25_5'}."</td>";
				echo "<td>".$obj->{'25_6'}."</td>";
		echo "</tr>";

		echo "<tr>";		
				echo "<td>".'24.Otras Causas Externas'."</td>";
				echo "<td>".$obj->CENTRO."</td>";
				echo "<td>".$obj->{'26_1'}."</td>";
				echo "<td>".$obj->{'26_2'}."</td>";
				echo "<td>".$obj->{'26_3'}."</td>";
				echo "<td>".$obj->{'26_4'}."</td>";
				echo "<td>".$obj->{'26_5'}."</td>";
				echo "<td>".$obj->{'26_6'}."</td>";
		echo "</tr>";

		echo "<tr>";		
			echo "<td>".'25.Otros Procedimientos'."</td>";
			echo "<td>".$obj->CENTRO."</td>";
			echo "<td>".$obj->{'27_1'}."</td>";
			echo "<td>".$obj->{'27_2'}."</td>";
			echo "<td>".$obj->{'27_3'}."</td>";
			echo "<td>".$obj->{'27_4'}."</td>";
			echo "<td>".$obj->{'27_5'}."</td>";
			echo "<td>".$obj->{'27_6'}."</td>";
		echo "</tr>";
	}

?>