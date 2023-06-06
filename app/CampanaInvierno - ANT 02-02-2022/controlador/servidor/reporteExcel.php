<?php
	set_time_limit(300);
	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modeloCampana.php"); 
	
	
	$bd = new Conexion();
	$modelo = new claseCampana();
	$conn = $bd->Conectar();

	$desde = $_REQUEST['fecha1'];
	$hasta = $_REQUEST['fecha2'];
	$centro = $_REQUEST['centro'];
	$semana = $_GET['semana'];
	if ($semana == 0) {
		$sem_aux = 'NULL';
	}else{
		$sem_aux = $semana;
	}

	if(empty($desde)){
		$fecha1 = 'NULL';
		$f1_Aux = 0;
	}else{
		$dato  = explode("/", $desde);
		$fecha1 = $dato[2]."/".$dato[1]."/".$dato[0];
		$f1_Aux = $dato[0]."/".$dato[1]."/".$dato[2];
	}

	if(empty($hasta)){
		$fecha2 = 'NULL';
		$f2_Aux = 0;
	}else{
		$dato  = explode("/", $hasta);
		$fecha2 = $dato[2]."/".$dato[1]."/".$dato[0];
		$f2_Aux = $dato[0]."/".$dato[1]."/".$dato[2];
	}

	$modelo->setCentro($centro);
	$modelo->setSemana($sem_aux);
	$modelo->setDesde($fecha1);
	$modelo->setHasta($fecha2);
	$data = $modelo->OBTENER_MORBILIDAD_INVIERNO_TABLA_EXPORT($conn);

	header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
	header('Content-Disposition: attachment; filename=ReporteCampanaInvierno.xls');

	$ate = array('TOTAL ATENCIONES DE MORBILIDAD (CONTIENE LAS RESPIRATORIAS)','TOTAL ATENCIONES POR CAUSA SISTEMA RESPIRATORIO','IRA ALTA ','INFLUENZA','NEUMONIA','ASMA','EPOC ','SBOR (SINDROME BRONQUIAL OBSTRUCTIVO RECURRENTE)','SBO (SINDROME BRONQUIAL OBSTRUCTIVO) ','OTRAS RESPIRATORIAS','OTRAS MORBILIDADES');

			$fecha = mostrarSemana($semana);
			$arre = explode(',', $semana);
			echo "<table class='table table-bordered ' style='width:58%;'>";
			echo "<tr>";
				if (count($arre) === 1 && $f1_Aux === 0 && $f2_Aux === 0 ) {
					echo "<th style='background: #6F85FF;color: white;text-align: left;'>TOTAL ATENCIONES CESFAM 2020</th>";
				}else{
					if (count($arre) > 1 && $f1_Aux === 0 && $f2_Aux === 0) {
						echo "<th style='background: #6F85FF;color: white;text-align: left;'>ATENCIONES CESFAM ENTRE  ".$fecha[0]["FECHA"]." HASTA ".$fecha[0]["FECHA_FINAL_EPI"]." </th>";
					}else
						echo "<th style='background: #6F85FF;color: white;text-align: left;'>ATENCIONES CESFAM ENTRE ".$f1_Aux." HASTA ".$f2_Aux." </th>";
				}

				echo "<th style='background: #6F85FF;color: white;'>CENTRO </th>";
				echo "<th style='background: #6F85FF;color: white;'>TOTAL </th>";
				echo "<th style='background: #6F85FF;color: white;'>- 1 A".utf8_decode('Ñ')."O</th>";
				echo "<th style='background: #6F85FF;color: white;'>1 A 4 A".utf8_decode('Ñ')."OS</th>";
				echo "<th style='background: #6F85FF;color: white;'>5 A 14 A".utf8_decode('Ñ')."OS</th>";
				echo "<th style='background: #6F85FF;color: white;'>15 A 64 A".utf8_decode('Ñ')."OS</th>";
				echo "<th style='background: #6F85FF;color: white;'>65 A".utf8_decode('Ñ')."OS Y +</th>";
			echo "</tr>";

				foreach($data as $clave => $valor)
				{
					for ($x = 1; $x <= 11; $x++) {
					echo "<tr>";
						if ($x == 1 || $x == 2) {
							echo "<td style='background:yellow;'>".$ate[$x-1]."</td>";
							echo "<td style='background: yellow;text-align: center;'> ".$valor['CENTRO']." </td>";
							echo "<td style='background: yellow;text-align: center;'>".$valor[$x.'_1']."</td>";
							echo "<td style='background: yellow;text-align: center;'>".$valor[$x.'_2']."</td>";
							echo "<td style='background: yellow;text-align: center;'>".$valor[$x.'_3']."</td>";
							echo "<td style='background: yellow;text-align: center;'>".$valor[$x.'_4']."</td>";
							echo "<td style='background: yellow;text-align: center;'>".$valor[$x.'_5']."</td>";
							echo "<td style='background: yellow;text-align: center;'>".$valor[$x.'_6']."</td>";
						}else{
							echo "<td style='text-align: left;'>".$ate[$x-1]."</td>";
							echo "<td style='text-align: center;width: 5em;'> ".$valor['CENTRO']." </td>";
							echo "<td style='text-align: center;width: 5em;'>".$valor[$x.'_1']."</td>";
							echo "<td style='text-align: center;width: 5em;'>".$valor[$x.'_2']."</td>";
							echo "<td style='text-align: center;width: 5em;'>".$valor[$x.'_3']."</td>";
							echo "<td style='text-align: center;width: 5em;'>".$valor[$x.'_4']."</td>";
							echo "<td style='text-align: center;width: 5em;'>".$valor[$x.'_5']."</td>";
							echo "<td style='text-align: center;width: 5em;'>".$valor[$x.'_6']."</td>";
						}
					echo "</tr>";

					}
				}
			echo "</table>";


	

function mostrarSemana($semana){
		$modelo = new claseCampana();
		$bd = new Conexion();
		$conn = $bd->Conectar();
		$modelo->setSemana($semana);
		$data = $modelo->OBTENER_SEMANA_EPIDEMIOLOGICA($conn);
		return $data;
	}


?>