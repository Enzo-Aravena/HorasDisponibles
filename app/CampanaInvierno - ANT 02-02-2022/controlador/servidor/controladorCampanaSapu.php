<?php
set_time_limit(300);
require_once ("../../../../lib/conexion/conexionCampanaInvierno.php");
require_once("../../modelo/modeloCampanaSapu.php");

$bd = new Conexion();
$camSapu = new claseCampanaSapu();

$conn = $bd->Conectar();
$evento = $_REQUEST["evento"];

switch ($evento) {
	case 'select':
		$data = $camSapu->OBTENER_SEMANAS_EPIDEMIOLOGICA($conn);
		echo json_encode($data);
	break;

	case 'mostrarGrafico':
		$centro = $_REQUEST['centro'];
		$semana = $_REQUEST['semana'];
		$dia = $_REQUEST['dia'];

		if($dia == 1 ){
			if ($centro ==0) {
				$camSapu->setSemana($semana);
				$data = $camSapu->OBTENER_GRAFICO_UNO($conn);
				echo json_encode($data);
			}else{
				$camSapu->setSemana($semana);
				$camSapu->setCentro($centro);
				$data = $camSapu->OBTENER_GRAFICO_DOS($conn);
				echo json_encode($data);
			}
		}else{
			if($semana == 0 ){
				if ($centro ==0) {
					$data = $camSapu->OBTENER_GRAFICO_TRES($conn);
					echo json_encode($data);
				}else{
					$camSapu->setCentro($centro);
					$data = $camSapu->OBTENER_GRAFICO_CUATRO($conn);
					echo json_encode($data);
				}
			}else{	
				if ($centro ==0) {
					$camSapu->setSemana($semana);
					$data = $camSapu->OBTENER_GRAFICO_CINCO($conn);
					echo json_encode($data);
				}else{

					$camSapu->setSemana($semana);
					$camSapu->setCentro($centro);
					$data = $camSapu->OBTENER_GRAFICO_SEIS($conn);
					echo json_encode($data);				
				}
			}
		}// else principal
	break;

	case 'semana':
		$semana = $_REQUEST['semana'];
		$camSapu->setSemana($semana);
		$data = $camSapu->OBTENER_SEMANA_EPIDEMIOLOGICA($conn);
		echo json_encode($data);
	break;

	case 'cargarTabla':
		$centro = $_GET['centro'];
		$semana = $_GET['semana'];
		if($semana == 0){
			$semana_aux = "TOTAL ACUMULADAS SEMANAS EPIDEMIOLOGICAS";
		}

		if($semana == 0 ){
			if ($centro ==0) {
				$data = $camSapu->CAMIN_OBTENER_DATOS_TABLA_UNO($conn);
				//echo json_encode($data);
				//echo "PESCA EL 1";

			}else{
				$camSapu->setCentro($centro);
				$data = $camSapu->CAMIN_OBTENER_DATOS_TABLA_DOS($conn);
				//echo json_encode($data);
				//echo "PESCA EL 2";

			}
		}else{
			if ($centro ==0) {
				$camSapu->setSemana($semana);
				$data = $camSapu->CAMIN_OBTENER_DATOS_TABLA_TRES($conn);
				//echo json_encode($data);
			//	echo "PESCA EL 3";

			}else{
				//echo "PESCA EL 4";
				//echo $semana." ".$centro;
				$camSapu->setCentro($centro);
				$camSapu->setSemana($semana);
				$data = $camSapu->CAMIN_OBTENER_DATOS_TABLA_CUATRO($conn);
				//echo json_encode($data);
			}
		}


		$ate = array("Total Protocolos Aplicados", "Total Diagnosticos Agrupados del 1 al 6", "01.Ira Alta", "02.Influenza","03.Neumonia","04.Bronquitis Aguda","05.Sbo","06.Otra Causa Respiratoria","07.Iam","08.Ave","09.Crisis Hta",
						"10.Arritmia","11.Otras Causas Circulatorias","12.Accidentes Del Transito","13.Otros Traumatismos","14.Heridas Por Arma Blanca","15.Heridas Por Arma De Fuego","16.Mordedura De Animal","17.Vif","18.Violencia Sexual","19.Intento De Suicidio","20.Descompensacion Psiquiatrica","21.Diabetes Descompensada","22.Diarreas","23.Otras Gastrointestinales","24.Otras Causas Externas","25.Otros Procedimientos");

		echo "<table class='responstable' >";
		echo "<tr>";
		if($semana == 0){
		echo "<th>TOTAL SEMANAS EPIDEMIOLOGICAS 2019</th>";
		}else{
			echo "<th>SEMANAS EPIDEMIOLOGICAS $semana 2019</th>";
		}

		echo "<th>CENTRO</th>";
		echo "<th>TOTAL</th>";
		echo "<th>- 1 AÑO</th>";
		echo "<th>1 A 4 AÑOS</th>";
		echo "<th>5 A 14 AÑOS</th>";
		echo "<th>15 A 64 AÑOS</th>";
		echo "<th>65 AÑOS Y +</th>";
		echo "</tr>";

		if ($data[0] == "0") {
			echo "<tr>";
			echo "<td colspan='11'><h2>No hay registros en la fecha ingresada</h2></td>";
			echo "</tr>";
			echo "</table>";
		}else{
			foreach($data as $clave => $valor)
			{
				 for ($x = 1; $x <= 27; $x++) {
				 	echo "<tr>";
					echo "<td >".$ate[$x-1]."</td>"; //
					echo "<td >".$valor['CENTRO']."</td>";
					echo "<td >".$valor[$x.'_1']."</td>";
					echo "<td >".$valor[$x.'_2']."</td>";
					echo "<td >".$valor[$x.'_3']."</td>";
					echo "<td >".$valor[$x.'_4']."</td>";
					echo "<td >".$valor[$x.'_5']."</td>";
					echo "<td >".$valor[$x.'_6']."</td>";
					echo "</tr>";
				 }
			}

			echo "</table>";
		}

	break;
	
	case 'ActualizarTabla':
		$desde = $_REQUEST['fecha1'];
		$hasta = $_REQUEST['fecha2'];
		$centro = $_REQUEST['centro'];
		$dato  = explode("/", $desde);
		$hastas  = explode("/", $hasta);

		$fecha1 = $dato[2]."-".$dato[1]."-".$dato[0];
		$fecha2 = $hastas[2]."-".$hastas[1]."-".$hastas[0];
	
		if ($centro ==0) {
			$camSapu->setDesde($fecha1);
			$camSapu->setHasta($fecha2);
			$data = $camSapu->CAMIN_ACTUALIZAR_DATOS_TABLA_UNO($conn);
		}else{
			$camSapu->setDesde($fecha1);
			$camSapu->setHasta($fecha2);
			$camSapu->setCentro($centro);
			$data = $camSapu->CAMIN_ACTUALIZAR_DATOS_TABLA_DOS($conn);
		}


		$ate = array("Total Protocolos Aplicados", "Total Diagnosticos Agrupados del 1 al 6", "01.Ira Alta", "02.Influenza","03.Neumonia","04.Bronquitis Aguda","05.Sbo","06.Otra Causa Respiratoria","07.Iam","08.Ave","09.Crisis Hta",
		"10.Arritmia","11.Otras Causas Circulatorias","12.Accidentes Del Transito","13.Otros Traumatismos","14.Heridas Por Arma Blanca","15.Heridas Por Arma De Fuego","16.Mordedura De Animal","17.Vif","18.Violencia Sexual","19.Intento De Suicidio","20.Descompensacion Psiquiatrica","21.Diabetes Descompensada","22.Diarreas","23.Otras Gastrointestinales","24.Otras Causas Externas","25.Otros Procedimientos");
		//-------------------------------------------------------------------------------------------------------------------

		echo "<table class='responstable' >"; 
		echo "<tr>";
		echo "<th>ATENCIONES DESDE $desde HASTA $hasta </th>";
		echo "<th>CENTRO</th>";
		echo "<th>TOTAL</th>";
		echo "<th>- 1 AÑO</th>";
		echo "<th>1 A 4 AÑOS</th>";
		echo "<th>5 A 14 AÑOS</th>";
		echo "<th>15 A 64 AÑOS</th>";
		echo "<th>65 AÑOS Y +</th>";
		echo "</tr>";



		if ($data[0] == "0") {
			echo "<tr>";
			echo "<td colspan='11'><h2>No hay registros en la fecha ingresada</h2></td>";
			echo "</tr>";
			echo "</table>";
		}else{
			foreach($data as $clave => $valor)
			{
				for ($x = 1; $x <= 27; $x++) {
					echo "<tr>";
						echo "<td >".$ate[$x-1]."</td>"; //
						echo "<td >".$valor['CENTRO']."</td>";
						echo "<td >".$valor[$x.'_1']."</td>";
						echo "<td >".$valor[$x.'_2']."</td>";
						echo "<td >".$valor[$x.'_3']."</td>";
						echo "<td >".$valor[$x.'_4']."</td>";
						echo "<td >".$valor[$x.'_5']."</td>";
						echo "<td >".$valor[$x.'_6']."</td>";
					echo "</tr>";
				}
			}

			echo "</table>";
		}
	break;
	
	default:
		echo "Error...";
	break;
}


?>
