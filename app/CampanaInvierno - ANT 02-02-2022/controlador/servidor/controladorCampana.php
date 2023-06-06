<?php
	set_time_limit(300);
	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modeloCampana.php");

	$bd = new Conexion();
	$modelo = new claseCampana();

	$conn = $bd->Conectar();
	$evento = $_REQUEST["evento"];

	switch ($evento) {
		case 'select':
			$data = $modelo->OBTENER_SEMANAS_EPIDEMIOLOGICA($conn);
			echo json_encode($data);
		break;

		case 'mostrarGrafico':
			$centro = $_REQUEST['centro'];
			$semana = $_REQUEST['semana'];
			$dia = $_REQUEST['dia'];
			$modelo->setCentro($centro);
			$modelo->setSemana($semana);
			$modelo->setDia($dia);
			$data = $modelo->OBTENER_MORBILIDAD_INVIERNO_GRAFICO($conn);
			echo json_encode($data);
		break;

		case 'semana':
			$semana = $_REQUEST['semana'];
			$modelo->setSemana($semana);
			$data = $modelo->OBTENER_SEMANA_EPIDEMIOLOGICA($conn);
			echo json_encode($data);
		break;

		case 'cargarTabla':
		    $centro = $_REQUEST['centro'];
			$semana = $_REQUEST['semana'];
			$modelo->setCentro($centro);
			$modelo->setSemana($semana);
			$data = $modelo->OBTENER_MORBILIDAD_INVIERNO_TABLA($conn);
			$ate = array('TOTAL ATENCIONES DE MORBILIDAD (CONTIENE LAS RESPIRATORIAS)','TOTAL ATENCIONES POR CAUSA SISTEMA RESPIRATORIO','IRA ALTA ','INFLUENZA','NEUMONIA','ASMA','EPOC ','SBOR (SINDROME BRONQUIAL OBSTRUCTIVO RECURRENTE)','SBO (SINDROME BRONQUIAL OBSTRUCTIVO) ','OTRAS RESPIRATORIAS','OTRAS MORBILIDADES');
			$fecha = mostrarSemana($semana);
			echo "<table  style='width:90%;'>";
			echo "<tr>";
				if($fecha[0]["FECHA"] == 0){
					echo "<th class='tituloPrincipal'>TOTAL ATENCIONES CESFAM 2020</th>";
				}else{
					echo "<th class='tituloPrincipal'>ATENCIONES CESFAM ENTRE ".$fecha[0]["FECHA"]." HASTA ".$fecha[0]["FECHA_FINAL_EPI"]." </th>";
				}
				echo "<th class='tituloPrincipal'>CENTRO </th>";
				echo "<th class='tituloPrincipal'>TOTAL </th>";
				echo "<th class='tituloPrincipal'>- 1 AÑO</th>";
				echo "<th class='tituloPrincipal'>1 A 4 AÑOS</th>";
				echo "<th class='tituloPrincipal'>5 A 14 AÑOS</th>";
				echo "<th class='tituloPrincipal'>15 A 64 AÑOS</th>";
				echo "<th class='tituloPrincipal'>65 AÑOS Y +</th>";
			echo "</tr>";

				foreach($data as $clave => $valor)
				{
					for ($x = 1; $x <= 11; $x++) {
					echo "<tr>";
						if ($x == 1 || $x == 2) {
							echo "<td style='background:yellow;border-style:inset;border-width:2px;'>".$ate[$x-1]."</td>";
							echo "<td style='background:yellow;border-style:inset;border-width:2px;'> ".$valor['CENTRO']." </td>";
							echo "<td style='background:yellow;border-style:inset;border-width:2px;text-align:center;'>".$valor[$x.'_1']."</td>";
							echo "<td style='background:yellow;border-style:inset;border-width:2px;text-align:center;'>".$valor[$x.'_2']."</td>";
							echo "<td style='background:yellow;border-style:inset;border-width:2px;text-align:center;'>".$valor[$x.'_3']."</td>";
							echo "<td style='background:yellow;border-style:inset;border-width:2px;text-align:center;'>".$valor[$x.'_4']."</td>";
							echo "<td style='background:yellow;border-style:inset;border-width:2px;text-align:center;'>".$valor[$x.'_5']."</td>";
							echo "<td style='background:yellow;border-style:inset;border-width:2px;text-align:center;'>".$valor[$x.'_6']."</td>";
						}else{
							echo "<td style='border-style: inset;border-width: 2px;'>".$ate[$x-1]."</td>";
							echo "<td style='border-style: inset;border-width: 2px;'> ".$valor['CENTRO']." </td>";
							echo "<td style='border-style: inset;border-width: 2px;text-align: center;'>".$valor[$x.'_1']."</td>";
							echo "<td style='border-style: inset;border-width: 2px;text-align: center;'>".$valor[$x.'_2']."</td>";
							echo "<td style='border-style: inset;border-width: 2px;text-align: center;'>".$valor[$x.'_3']."</td>";
							echo "<td style='border-style: inset;border-width: 2px;text-align: center;'>".$valor[$x.'_4']."</td>";
							echo "<td style='border-style: inset;border-width: 2px;text-align: center;'>".$valor[$x.'_5']."</td>";
							echo "<td style='border-style: inset;border-width: 2px;text-align: center;'>".$valor[$x.'_6']."</td>";
						}
					echo "</tr>";
					}// END FOR
				}
			echo "</table>";
		break;
		
		case 'ActualizarTabla':
			$desde = $_REQUEST['fecha1'];
			$hasta = $_REQUEST['fecha2'];
			$centro = $_REQUEST['centro'];
			$dato  = explode("/", $desde);
			$hastas  = explode("/", $hasta);
			if(empty($desde)){
				$fecha1 = 'NULL';
			}else{
				$dato  = explode("/", $desde);
				$fecha1 = $dato[2]."/".$dato[1]."/".$dato[0];
				$f1_Aux = $dato[0]."/".$dato[1]."/".$dato[2];
			}

			if(empty($hasta)){
				$fecha2 = 'NULL';
			}else{
				$dato  = explode("/", $hasta);
				$fecha2 = $dato[2]."/".$dato[1]."/".$dato[0];
				$f2_Aux = $dato[0]."/".$dato[1]."/".$dato[2];
			}

			$modelo->setCentro($centro);
			$modelo->setDesde($fecha1);
			$modelo->setHasta($fecha2);
			$data = $modelo->OBTENER_MORBILIDAD_INVIERNO_TABLA_UPDATE($conn);
			$ate = array('TOTAL ATENCIONES DE MORBILIDAD (CONTIENE LAS RESPIRATORIAS)','TOTAL ATENCIONES POR CAUSA SISTEMA RESPIRATORIO','IRA ALTA ','INFLUENZA','NEUMONIA','ASMA','EPOC ','SBOR (SINDROME BRONQUIAL OBSTRUCTIVO RECURRENTE)','SBO (SINDROME BRONQUIAL OBSTRUCTIVO) ','OTRAS RESPIRATORIAS','OTRAS MORBILIDADES');
			echo "<table style='width:90%;'>";
			echo "<tr>";
				if($fecha1 == NULL){
					echo "<th class='tituloPrincipal'>TOTAL ATENCIONES CESFAM 2020</th>";
				}else{
					echo "<th class='tituloPrincipal'> TOTAL ATENCIONES ENTRE ".$f1_Aux." HASTA ".$f2_Aux." </th>";
				}
				echo "<th class='tituloPrincipal'>CENTRO </th>";
				echo "<th class='tituloPrincipal'>TOTAL </th>";
				echo "<th class='tituloPrincipal'>- 1 AÑO</th>";
				echo "<th class='tituloPrincipal'>1 A 4 AÑOS</th>";
				echo "<th class='tituloPrincipal'>5 A 14 AÑOS</th>";
				echo "<th class='tituloPrincipal'>15 A 64 AÑOS</th>";
				echo "<th class='tituloPrincipal'>65 AÑOS Y +</th>";
			echo "</tr>";

				foreach($data as $clave => $valor)
				{
					for ($x = 1; $x <= 11; $x++) {
					echo "<tr>";
						if ($x == 1 || $x == 2) {
							echo "<td style='background:yellow;border-style:inset;border-width:2px;'>".$ate[$x-1]."</td>";
							echo "<td style='background:yellow;border-style:inset;border-width:2px;'> ".$valor['CENTRO']." </td>";
							echo "<td style='background:yellow;border-style:inset;border-width:2px;text-align:center;'>".$valor[$x.'_1']."</td>";
							echo "<td style='background:yellow;border-style:inset;border-width:2px;text-align:center;'>".$valor[$x.'_2']."</td>";
							echo "<td style='background:yellow;border-style:inset;border-width:2px;text-align:center;'>".$valor[$x.'_3']."</td>";
							echo "<td style='background:yellow;border-style:inset;border-width:2px;text-align:center;'>".$valor[$x.'_4']."</td>";
							echo "<td style='background:yellow;border-style:inset;border-width:2px;text-align:center;'>".$valor[$x.'_5']."</td>";
							echo "<td style='background:yellow;border-style:inset;border-width:2px;text-align:center;'>".$valor[$x.'_6']."</td>";
						}else{
							echo "<td style='border-style: inset;border-width: 2px;'>".$ate[$x-1]."</td>";
							echo "<td style='border-style: inset;border-width: 2px;'> ".$valor['CENTRO']." </td>";
							echo "<td style='border-style: inset;border-width: 2px;text-align: center;'>".$valor[$x.'_1']."</td>";
							echo "<td style='border-style: inset;border-width: 2px;text-align: center;'>".$valor[$x.'_2']."</td>";
							echo "<td style='border-style: inset;border-width: 2px;text-align: center;'>".$valor[$x.'_3']."</td>";
							echo "<td style='border-style: inset;border-width: 2px;text-align: center;'>".$valor[$x.'_4']."</td>";
							echo "<td style='border-style: inset;border-width: 2px;text-align: center;'>".$valor[$x.'_5']."</td>";
							echo "<td style='border-style: inset;border-width: 2px;text-align: center;'>".$valor[$x.'_6']."</td>";
						}
					echo "</tr>";

					}
				}
			echo "</table>";
		break;
		
		default:
			echo "Error...";
		break;
	}

	function mostrarSemana($semana){
		$modelo = new claseCampana();
		$bd = new Conexion();
		$conn = $bd->Conectar();
		$modelo->setSemana($semana);
		$data = $modelo->OBTENER_SEMANA_EPIDEMIOLOGICA($conn);
		return $data;
	}

?>
