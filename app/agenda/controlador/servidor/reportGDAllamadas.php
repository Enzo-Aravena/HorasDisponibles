<?php
	error_reporting(0);
	require_once ("../../../../lib/conexion/db_tic.php");
	require_once("../../modelo/modelogdaDetalleLlamadas.php");

	$bd = new Conexion();
	$modelo = new modeloGdaDetLlamadas();
	$conn = $bd->Conectar();

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

	
	$titulosColumnas = array('FECHA OFERTA','CENTRO','OFERTADOS','LLAMADAS TELEFONICA','AGENDADOS TELEFONICA','CANCELADOS TELEFONICA','CANCELADOS MESON','CANCELADOS PERSONAS','PRIMER AGOTADO','LLAMADAS AGOTADAS','AGOTADOS PAC','AGOTADOS / 10 OFERTADOS');

	
		if ($semana == 0)
		{
			if ($centro ==0) {
				$modelo->setDesde($fecha1);
				$modelo->setHasta($fecha2);
				$data = $modelo->OBTENER_TABLA_UNO($conn);
			}else{
				$modelo->setDesde($fecha1);
				$modelo->setHasta($fecha2);
				$modelo->setCentro($centro);
				$data = $modelo->OBTENER_TABLA_DOS($conn);
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
			}else{
				$modelo->setDesde(implode(',',$arreglo));
				$modelo->setCentro($centro);
				$data = $modelo->OBTENER_TABLA_CUATRO($conn);
			}
		}

	/*******************************  REPORTE EXCEL  ****************************************************/
	header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
	header('Content-Disposition: attachment; filename=GDA_Detalle_Llamadas_Diarias.xls');

		echo "<table  border='1' cellpadding='2' cellspacing='0'>";
			echo "<thead style='background-color: green;color:white;'>";
			foreach($titulosColumnas as $clave => $valor){
					echo "<th>".$valor."</th>";
			}
			echo "</thead>";
			echo "<tbody>";
			$i = 2;
			foreach($data as $clave => $valor){
				echo "<tr>";
					echo "<td>".$valor['FECHAOFERTA']."</td>";
					echo "<td>".$valor['CENTRO']."</td>";
					echo "<td>".$valor['OFERTADO_MORBT']."</td>";
					echo "<td>".$valor['LLAMADAS_MORBT_TELEFONICA']."</td>";
					echo "<td>".$valor['AGENDADOS_MORBT_TELEFONICA']."</td>";
					echo "<td>".$valor['CANCELADOS_MORBT_TELEFONICA']."</td>";
					echo "<td>".$valor['CANCELADOS_MORBT_MESON']."</td>";
					echo "<td>".$valor['CANCELADOS_MORBT_PERSONA']."</td>";
					echo "<td>".$valor['PRIMERA_HORA_AGOTADOS']."</td>";
					echo "<td>".$valor['NUMERO_AGOTADOS']."</td>";
					echo "<td>".$valor['AGOTADOS']."</td>";
					echo "<td>".$valor['TASA_AGOTADOS']."</td>";
				echo "</tr>";
				$i++;
			}

			echo "</tbody>";
			echo "</table>";

?>