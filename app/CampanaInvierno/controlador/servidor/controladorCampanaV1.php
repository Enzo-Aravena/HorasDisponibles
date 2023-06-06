<?php
set_time_limit(300);
require_once ("../../../../lib/conexion/conexionCampanaInvierno.php");
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

		if($dia == 1 ){
			if ($centro ==0) {
				/*$modelo->setSemana($semana);
				$data =  $modelo->CAMIN_OBTENER_GRAFICO_DIA_SI($conn);
				echo json_encode($data);*/

				$i = 0;
			$data = Array();
			$sql= "SELECT SUBSTRING(CAM.DIA_SEMANA,1,3) AS 'SEMANA',
			  							CAM.CENTRO				 		 AS 'CENTRO',
										SUM(CAM.1_1)  					 AS 'TOTAL_CESFAM',
										SUM(CAM.2_1)  					 AS 'TOTAL_SR',
							 		(SELECT SUM(CAM1.1_1)
										FROM CAMPANA_RESUMEN CAM1 
										WHERE CAM1.SEMANA_EPIDEMIOLOGICA in(CAM.SEMANA_EPIDEMIOLOGICA) AND 
								        CAM1.ANNO = 2018 AND CAM1.DIA_SEMANA_COD = CAM.DIA_SEMANA_COD) AS 'TOTAL_CESFAM_AA',
									(SELECT	SUM(CAM1.2_1)
										FROM CAMPANA_RESUMEN CAM1 
										WHERE CAM1.SEMANA_EPIDEMIOLOGICA in(CAM.SEMANA_EPIDEMIOLOGICA) AND 
								        CAM1.ANNO = 2018  AND CAM1.DIA_SEMANA_COD = CAM.DIA_SEMANA_COD) AS 'TOTAL_SR_AA'
							FROM CAMPANA_RESUMEN CAM where CAM.ANNO = 2019 AND CAM.SEMANA_EPIDEMIOLOGICA in ($semana) AND  CAM.SEMANA_EPIDEMIOLOGICA IS NOT NULL
									GROUP BY CAM.FECHA ORDER BY CAM.FECHA,CAM.CENTRO_ORDENADO ASC";
			$resultado = mysqli_query($conn,$sql);
			$count = mysqli_num_rows($resultado);
			if ($count == "0") {
				$data[0] = array(
					"data" =>"0"
				);
			}else{
				while ($fila = mysqli_fetch_row($resultado)) {
					$data[$i]= Array(
						"data" => "1",
						"SEMANA" => utf8_encode($fila[0]),
						"CENTRO" => utf8_encode($fila[1]),
						"TOTAL_CESFAM" => utf8_encode($fila[2]),
						"TOTAL_SR" => utf8_encode($fila[3]),
						"TOTAL_CESFAM_AA" => utf8_encode($fila[4]),
						"TOTAL_SR_AA" => utf8_encode($fila[5])
					); // End Array
					$i++;
				}// end while
			}// end else
			echo json_encode($data);


			}else{
				/*$modelo->setSemana($semana);
				$modelo->setCentro($centro);
				$data =  $modelo->CAMIN_OBTENER_GRAFICO_DIA_SI_CENTRO_DOS($conn);
				echo json_encode($data);*/

				$i = 0;
			$data = Array();
			$sql= "SELECT SUBSTRING(CAM.DIA_SEMANA,1,3) AS 'SEMANA',
			  							CAM.CENTRO				 		 AS 'CENTRO',
										SUM(CAM.1_1)  					 AS 'TOTAL_CESFAM',
										SUM(CAM.2_1)  					 AS 'TOTAL_SR',
							 		(SELECT SUM(CAM1.1_1)
										FROM CAMPANA_RESUMEN CAM1 
										WHERE CAM1.SEMANA_EPIDEMIOLOGICA in(CAM.SEMANA_EPIDEMIOLOGICA) AND 
									 CAM1.CENTRO_ID = CAM.CENTRO_ID AND CAM1.ANNO = 2018 AND 
									 CAM1.DIA_SEMANA_COD = CAM.DIA_SEMANA_COD) AS 'TOTAL_CESFAM_AA',
									(SELECT	SUM(CAM1.2_1)
										FROM CAMPANA_RESUMEN CAM1 
										WHERE CAM1.SEMANA_EPIDEMIOLOGICA in(CAM.SEMANA_EPIDEMIOLOGICA) AND 
									 CAM1.CENTRO_ID = CAM.CENTRO_ID AND CAM1.ANNO = 2018  AND 
									 CAM1.DIA_SEMANA_COD = CAM.DIA_SEMANA_COD) AS 'TOTAL_SR_AA'
							FROM CAMPANA_RESUMEN CAM where CAM.ANNO = 2019 AND CAM.SEMANA_EPIDEMIOLOGICA in ($semana) AND 									 CAM.SEMANA_EPIDEMIOLOGICA IS NOT NULL AND CAM.CENTRO_ID = $centro
									GROUP BY CAM.FECHA ORDER BY CAM.FECHA,CAM.CENTRO_ORDENADO ASC";
			$resultado = mysqli_query($conn,$sql);
			$count = mysqli_num_rows($resultado);
			if ($count == "0") {
				$data[0] = array(
					"data" =>"0"
				);
			}else{
				while ($fila = mysqli_fetch_row($resultado)) {
					$data[$i]= Array(
						"data" => "1",
						"SEMANA" => utf8_encode($fila[0]),
						"CENTRO" => utf8_encode($fila[1]),
						"TOTAL_CESFAM" => utf8_encode($fila[2]),
						"TOTAL_SR" => utf8_encode($fila[3]),
						"TOTAL_CESFAM_AA" => utf8_encode($fila[4]),
						"TOTAL_SR_AA" => utf8_encode($fila[5])
					); // End Array
					$i++;
				}// end while
			}// end else
			echo json_encode($data);


			}
		}else{
			if($semana == 0 ){
			    if ($centro ==0) {
		    		/*$data =  $modelo->CAMIN_OBTENER_GRAFICO_DIA_SI_TRES($conn);
					echo json_encode($data);*/

					$i = 0;
			$data = Array();
			$sql= "SELECT CONCAT('Semana ',CAM.SEMANA_EPIDEMIOLOGICA) AS 'SEMANA',
			  							 CAM.CENTRO				 		 AS 'CENTRO',
										 SUM(CAM.1_1)  					 AS 'TOTAL_CESFAM',
										 SUM(CAM.2_1)  					 AS 'TOTAL_SR',
								    (SELECT SUM(CAM1.1_1)
								     FROM CAMPANA_RESUMEN CAM1 
									 WHERE CAM1.SEMANA_EPIDEMIOLOGICA in (CAM.SEMANA_EPIDEMIOLOGICA) AND 
										  CAM1.ANNO = 2018 )AS 'TOTAL_CESFAM_AA',
								    (SELECT	SUM(CAM1.2_1)
									 FROM CAMPANA_RESUMEN CAM1 
									 WHERE CAM1.SEMANA_EPIDEMIOLOGICA in (CAM.SEMANA_EPIDEMIOLOGICA) AND 
										   CAM1.ANNO = 2018 ) AS 'TOTAL_SR_AA'
									 FROM CAMPANA_RESUMEN CAM where CAM.ANNO = 2019 AND CAM.SEMANA_EPIDEMIOLOGICA IS NOT NULL
									 GROUP BY CAM.SEMANA_EPIDEMIOLOGICA ORDER BY CAM.SEMANA_EPIDEMIOLOGICA,CAM.CENTRO_ORDENADO ASC";
			$resultado = mysqli_query($conn,$sql);
			$count = mysqli_num_rows($resultado);
			if ($count == "0") {
				$data[0] = array(
					"data" =>"0"
				);
			}else{
				while ($fila = mysqli_fetch_row($resultado)) {
					$data[$i]= Array(
						"data" => "1",
						"SEMANA" => utf8_encode($fila[0]),
						"CENTRO" => utf8_encode($fila[1]),
						"TOTAL_CESFAM" => utf8_encode($fila[2]),
						"TOTAL_SR" => utf8_encode($fila[3]),
						"TOTAL_CESFAM_AA" => utf8_encode($fila[4]),
						"TOTAL_SR_AA" => utf8_encode($fila[5])
					); // End Array
					$i++;
				}// end while
			}// end else
			echo json_encode($data);


			    }else{
					/*$modelo->setCentro($centro);
					$data =  $modelo->CAMIN_OBTENER_GRAFICO_DIA_SI_TRES_CENTRO($conn);
					echo json_encode($data);*/

					$i = 0;
			$data = Array();
			$sql= "SELECT CONCAT('Semana ',CAM.SEMANA_EPIDEMIOLOGICA) AS 'SEMANA',
			  							 CAM.CENTRO				 		 AS 'CENTRO',
										 SUM(CAM.1_1)  					 AS 'TOTAL_CESFAM',
										 SUM(CAM.2_1)  					 AS 'TOTAL_SR',
								    (SELECT SUM(CAM1.1_1)
								     FROM CAMPANA_RESUMEN CAM1 
									 WHERE CAM1.SEMANA_EPIDEMIOLOGICA in (CAM.SEMANA_EPIDEMIOLOGICA) AND 
										   CAM1.CENTRO_ID = CAM.CENTRO_ID AND CAM1.ANNO = 2018 )AS 'TOTAL_CESFAM_AA',
								    (SELECT	SUM(CAM1.2_1)
									 FROM CAMPANA_RESUMEN CAM1 
									 WHERE CAM1.SEMANA_EPIDEMIOLOGICA in (CAM.SEMANA_EPIDEMIOLOGICA) AND 
										   CAM1.CENTRO_ID = CAM.CENTRO_ID AND CAM1.ANNO = 2018 ) AS 'TOTAL_SR_AA'
									 FROM CAMPANA_RESUMEN CAM where CAM.ANNO = 2019 AND CAM.CENTRO_ID = $centro AND CAM.SEMANA_EPIDEMIOLOGICA IS NOT NULL
									 GROUP BY CAM.SEMANA_EPIDEMIOLOGICA ORDER BY CAM.SEMANA_EPIDEMIOLOGICA,CAM.CENTRO_ORDENADO ASC";
			$resultado = mysqli_query($conn,$sql);
			$count = mysqli_num_rows($resultado);
			if ($count == "0") {
				$data[0] = array(
					"data" =>"0"
				);
			}else{
				while ($fila = mysqli_fetch_row($resultado)) {
					$data[$i]= Array(
						"data" => "1",
						"SEMANA" => utf8_encode($fila[0]),
						"CENTRO" => utf8_encode($fila[1]),
						"TOTAL_CESFAM" => utf8_encode($fila[2]),
						"TOTAL_SR" => utf8_encode($fila[3]),
						"TOTAL_CESFAM_AA" => utf8_encode($fila[4]),
						"TOTAL_SR_AA" => utf8_encode($fila[5])
					); // End Array
					$i++;
				}// end while
			}// end else
			echo json_encode($data);


			    }
	 		}else{
				if ($centro ==0) {
					/* $modelo->setSemana($semana);
					$data =  $modelo->CAMIN_OBTENER_GRAFICO_DIA_SI_QUINTO($conn);
					echo json_encode($data);*/

					$i = 0;
			$data = Array();
			$sql= "SELECT CONCAT('Semana ',CAM.SEMANA_EPIDEMIOLOGICA) AS 'SEMANA',
			  							 CAM.CENTRO				 		 AS 'CENTRO',
										 SUM(CAM.1_1)  					 AS 'TOTAL_CESFAM',
										 SUM(CAM.2_1)  					 AS 'TOTAL_SR',
								    (SELECT SUM(CAM1.1_1)
								     FROM CAMPANA_RESUMEN CAM1 
									 WHERE CAM1.SEMANA_EPIDEMIOLOGICA in (CAM.SEMANA_EPIDEMIOLOGICA) AND 
										  CAM1.ANNO = 2018 )AS 'TOTAL_CESFAM_AA',
								    (SELECT	SUM(CAM1.2_1)
									 FROM CAMPANA_RESUMEN CAM1 
									 WHERE CAM1.SEMANA_EPIDEMIOLOGICA in (CAM.SEMANA_EPIDEMIOLOGICA) AND 
										   CAM1.ANNO = 2018 ) AS 'TOTAL_SR_AA'
									 FROM CAMPANA_RESUMEN CAM where CAM.ANNO = 2019 AND CAM.SEMANA_EPIDEMIOLOGICA in ($semana) AND CAM.SEMANA_EPIDEMIOLOGICA IS NOT NULL
									 GROUP BY CAM.SEMANA_EPIDEMIOLOGICA ORDER BY CAM.SEMANA_EPIDEMIOLOGICA,CAM.CENTRO_ORDENADO ASC";
			$resultado = mysqli_query($conn,$sql);
			$count = mysqli_num_rows($resultado);
			if ($count == "0") {
				$data[0] = array(
					"data" =>"0"
				);
			}else{
				while ($fila = mysqli_fetch_row($resultado)) {
					$data[$i]= Array(
						"data" => "1",
						"SEMANA" => utf8_encode($fila[0]),
						"CENTRO" => utf8_encode($fila[1]),
						"TOTAL_CESFAM" => utf8_encode($fila[2]),
						"TOTAL_SR" => utf8_encode($fila[3]),
						"TOTAL_CESFAM_AA" => utf8_encode($fila[4]),
						"TOTAL_SR_AA" => utf8_encode($fila[5])
					); // End Array
					$i++;
				}// end while
			}// end else
			echo json_encode($data);



				}else{
					/*$modelo->setSemana($semana);
					$modelo->setCentro($centro);
					$data =  $modelo->CAMIN_OBTENER_GRAFICO_DIA_SI_QUINTO_ALL($conn);
					echo json_encode($data);*/

					$i = 0;
			$data = Array();
			$sql= "SELECT CONCAT('Semana ',CAM.SEMANA_EPIDEMIOLOGICA) AS 'SEMANA',
			  							 CAM.CENTRO				 		 AS 'CENTRO',
										 SUM(CAM.1_1)  					 AS 'TOTAL_CESFAM',
										 SUM(CAM.2_1)  					 AS 'TOTAL_SR',
								    (SELECT SUM(CAM1.1_1)
								     FROM CAMPANA_RESUMEN CAM1 
									 WHERE CAM1.SEMANA_EPIDEMIOLOGICA in (CAM.SEMANA_EPIDEMIOLOGICA) AND 
										   CAM1.CENTRO_ID = CAM.CENTRO_ID AND CAM1.ANNO = 2018 )AS 'TOTAL_CESFAM_AA',
								    (SELECT	SUM(CAM1.2_1)
									 FROM CAMPANA_RESUMEN CAM1 
									 WHERE CAM1.SEMANA_EPIDEMIOLOGICA in (CAM.SEMANA_EPIDEMIOLOGICA) AND 
										   CAM1.CENTRO_ID = CAM.CENTRO_ID AND CAM1.ANNO = 2018 ) AS 'TOTAL_SR_AA'
									 FROM CAMPANA_RESUMEN CAM where CAM.ANNO = 2019 AND CAM.SEMANA_EPIDEMIOLOGICA in ($semana) AND CAM.SEMANA_EPIDEMIOLOGICA IS NOT NULL AND CAM.CENTRO_ID = $centro 
									 GROUP BY CAM.SEMANA_EPIDEMIOLOGICA ORDER BY CAM.SEMANA_EPIDEMIOLOGICA,CAM.CENTRO_ORDENADO ASC";
			$resultado = mysqli_query($conn,$sql);
			$count = mysqli_num_rows($resultado);
			if ($count == "0") {
				$data[0] = array(
					"data" =>"0"
				);
			}else{
				while ($fila = mysqli_fetch_row($resultado)) {
					$data[$i]= Array(
						"data" => "1",
						"SEMANA" => utf8_encode($fila[0]),
						"CENTRO" => utf8_encode($fila[1]),
						"TOTAL_CESFAM" => utf8_encode($fila[2]),
						"TOTAL_SR" => utf8_encode($fila[3]),
						"TOTAL_CESFAM_AA" => utf8_encode($fila[4]),
						"TOTAL_SR_AA" => utf8_encode($fila[5])
					); // End Array
					$i++;
				}// end while
			}// end else
			echo json_encode($data);


				}      
	    	}
		}
	break;

	case 'semana':

		$semana = $_REQUEST['semana'];
		$modelo->setSemana($semana);
		$data = $modelo->OBTENER_SEMANA_EPIDEMIOLOGICA($conn);
		echo json_encode($data);
	break;
	
	case 'cargarTabla':


	    $centro = $_GET['centro'];
		$semana = $_GET['semana'];

		$ate = array('TOTAL ATENCIONES (CONTIENE LAS RESPIRATORIAS)','TOTAL ATENCIONES POR CAUSA SISTEMA RESPIRATORIO','ASMA','EPOC ','INFLUENZA','IRA ALTA ','NEUMONIA','SBO','SBOR ','OTRAS RESPIRATORIAS','OTRAS MORBILIDADE');

		echo "<table class='table table-bordered ' style='width:70%;'>";
		echo "<tr>";
			echo "<th class='tituloPrincipal'>ATENCIONES CESFAM ENTRE 14/02/2020 -  12 DE FEBRERO 2020 </th>";
			echo "<th class='tituloPrincipal'>- 1 AÑO</th>";
			echo "<th class='tituloPrincipal'>1 A 4 AÑOS</th>";
			echo "<th class='tituloPrincipal'>5 A 14 AÑOS</th>";
			echo "<th class='tituloPrincipal'>15 A 64 AÑOS</th>";
			echo "<th class='tituloPrincipal'>65 AÑOS Y +</th>";
		echo "</tr>";

		//foreach ($arreglos as $key => $value) {
			for ($x = 1; $x <= 8; $x++) {
				echo "<tr>";
				if ($x == 1 || $x == 2) {
					echo "<td style='background: yellow; border-style: inset;border-width: 2px;font-weight: bolder;'>".$ate[$x-1]."</td>";
					echo "<td style='background: yellow; border-style: inset;border-width: 2px;font-weight: bolder;'>".$x."</td>";
					echo "<td style='background: yellow; border-style: inset;border-width: 2px;font-weight: bolder;'>".$x."</td>";
					echo "<td style='background: yellow; border-style: inset;border-width: 2px;font-weight: bolder;'>".$x."</td>";
					echo "<td style='background: yellow; border-style: inset;border-width: 2px;font-weight: bolder;'>".$x."</td>";
					echo "<td style='background: yellow; border-style: inset;border-width: 2px;font-weight: bolder;'>".$x."</td>";
				}else{
					echo "<td style='background: white; border-style: inset;border-width: 2px;font-weight: bolder;'>".$ate[$x-1]."</td>";
					echo "<td style='background: white; border-style: inset;border-width: 2px;font-weight: bolder;'>".$x."</td>";
					echo "<td style='background: white; border-style: inset;border-width: 2px;font-weight: bolder;'>".$x."</td>";
					echo "<td style='background: white; border-style: inset;border-width: 2px;font-weight: bolder;'>".$x."</td>";
					echo "<td style='background: white; border-style: inset;border-width: 2px;font-weight: bolder;'>".$x."</td>";
					echo "<td style='background: white; border-style: inset;border-width: 2px;font-weight: bolder;'>".$x."</td>";
				}

				
				
				echo "</tr>";
			}
		//}
	
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
			$modelo->setDesde($fecha1);
			$modelo->setHasta($fecha2);
			$data = $modelo->CAMIN_OBTENER_DATOS_TABLA_CINCO($conn);
		}else{
			$modelo->setDesde($fecha1);
			$modelo->setHasta($fecha2);
			$modelo->setCentro($centro);
			$data = $modelo->CAMIN_OBTENER_DATOS_TABLA_SEIS($conn);
		}
	
		$ate = array("Total Atenciones del CESFAM (contiene las respiratorias)", "Total Atenciones por causa Sistema Respiratorio", "Ira Alta (J00,J06)", "Influenza (J09,J11)",
			"Neumonía (J12,J18)","Bronquitis/Bronquiolitis aguda (J20,J21)","Crisis obstructiva bronquial (J40,J46)","Otras causas respiratorias (J22,J30,J39,J47,J60,J98)");

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
			}

			$ate = array("Total Atenciones del CESFAM (contiene las respiratorias)", "Total Atenciones por causa Sistema Respiratorio", "Ira Alta (J00,J06)", "Influenza (J09,J11)",
			"Neumonía (J12,J18)","Bronquitis/Bronquiolitis aguda (J20,J21)","Crisis obstructiva bronquial (J40,J46)","Otras causas respiratorias (J22,J30,J39,J47,J60,J98)");

			foreach($data as $clave => $valor)
			{
				 for ($x = 1; $x <= 8; $x++) {
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
	break;
	
	default:
		echo "Error...";
	break;
}


?>
