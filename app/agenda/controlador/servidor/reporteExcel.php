<?php

	require_once ("../../../../lib/conexion/db_tic.php");
	require_once("../../modelo/modeloReporte.php");

	$bd = new Conexion();
	$modelo = new ModeloGRafico();

	$conn = $bd->Conectar();
	if ($_GET['fecha1']==0) {
				$date1 = new DateTime('Today');
					if($date1->format('l') != 'Monday'){
			   		   $date1->modify('Last Monday');
					}
					$fecha1 = $date1->format('Y-m-d');
					$fecha2 = date("Y-m-d", strtotime("Tomorrow"));


			}else{
					//$fecha1 = date("Y-m-d", strtotime($_GET['fecha1']));

					$fes = explode("/", $_GET['fecha1']);

					$fecha1 = $fes[2]."-".$fes[1]."-".$fes[0];
				
					if ($_GET['fecha2']==0) {
				 		$fecha2 = $fecha1;// date("Y-m-d", strtotime($_GET['fecha1']));
					} else {

				 		//$fecha2 = date("Y-m-d", strtotime($_GET['fecha2']));	 
				 		$fes2 = explode("/", $_GET['fecha2']);

						$fecha2 = $fes2[2]."-".$fes2[1]."-".$fes2[0];


				 		//echo $fecha2;
				    }
			}
		
	$semana = $_GET['semana'];
	$centro = $_GET['centro'];

	$titulosColumna = array('FECHA OFERTA','CENTRO','MORBT OFERTADO','MORBT AGENDADOS POR TELEFONICA','MORBT AGENDADOS POR MESON','MORBT TOTAL AGENDADOS','MORBT AGENDADOS CONFIRMADOS','MORBT AGENDA DISPONIBLE','MORBT % TOTAL AGENDADOS','MORBT % AGENDADOS CONFIRMADOS','MORBT % AGENDADOS INASISTENTES','MORBI OFERTADO','MORBI AGENDADOS','MORBI AGENDADOS FORZADOS','MORBI AGENDADOS CONFIRMADO','MORBI AGENDA DISPONIBLE','MORBI % TOTAL AGENDADOS','MORBI % CONFIRMADO','MORBI % INASISTENTES');
	
	switch($semana) {
		case 1: $semana_desc ='Lunes';break;
		case 2: $semana_desc ='Martes';break;
		case 3: $semana_desc ='Miercoles';break;
		case 4: $semana_desc ='Jueves';break;
		case 5: $semana_desc ='Viernes';break;
		case 6: $semana_desc ='Sabado';break;
		case 7: $semana_desc ='Domingo';break;
	}
	
	
	if ($semana == 0)
	{
		if ($centro ==0) {
			$modelo->setDesde($fecha1);
			$modelo->setHasta($fecha2);
			$data = $modelo->OBTENER_DATOS_TABLA($conn);
			//echo json_encode($data);
			//print_r($data);
		}else{
			$modelo->setDesde($fecha1);
			$modelo->setHasta($fecha2);
			$modelo->setCentro($centro);
			$data = $modelo->OBTENER_DATOS_POR_DIA($conn);
			//echo json_encode($data);
			//print_r($data);
		}
	}else{
		$arr = array();
		for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
			$dia=date("w", strtotime($i));
				if($dia==$semana)
				{
					array_push($arr,"'".date("Y-m-d",strtotime($i))."'");
				}
		}


		//echo $fecha1." ".$fecha2;

		if ($centro==0) {
			/*$modelo->setDesde($arr);
			$data = $modelo->OBTENER_VALORES_POR_DIA($conn);
			//echo json_encode($data);
			//print_r($data);	*/

			$i=0;
			$data = Array();

			
			$sql = "SELECT '$semana_desc' 		 AS 'FECHAOFERTA',
										CENTRO 							 AS 'CENTRO',
										SUM(OFERTADO_MORBT)  			 AS 'OFERTADO_MORBT',
										SUM(AGENDADOS_MORBT_TELEFONICA)  AS 'AGENDADOS_MORBT_TELEFONICA',
										SUM(AGENDADOS_MESON_MORBT)   	 AS 'AGENDADOS_MESON_MORBT',
										SUM(AGENDADOS_FINAL_MORBT)   	 AS 'AGENDADOS_FINAL_MORBT',								
										SUM(AGENDADOS_CONFIRMADO_MORBT)  AS 'AGENDADOS_CONFIRMADO_MORBT',
										SUM(BLOQUES_NO_AGENDADOS_MORBT)  AS 'BLOQUES_NO_AGENDADOS_MORBT',	
					round(SUM(AGENDADOS_FINAL_MORBT)/SUM(OFERTADO_MORBT)*100,1) AS 'AGENDA_FINAL_PROCENTAJE_MORBT',															
					round(SUM(AGENDADOS_CONFIRMADO_MORBT)/SUM(AGENDADOS_FINAL_MORBT)*100,1) AS 'AGENDADOS_PORCENTAJE_MORBT',
					round(((SUM(AGENDADOS_FINAL_MORBT)-SUM(AGENDADOS_CONFIRMADO_MORBT))/SUM(AGENDADOS_FINAL_MORBT))*100,1) AS 'INASISTENTE_PORCENTAJE_MORBT',
													SUM(OFERTADO_MORBI)  			 AS 'OFERTADO_MORBI',
													SUM(AGENDADOS_MORBI) 			 AS 'AGENDADOS_MORBI',
													SUM(AGENDADOS_MORBI_FORZADOS) 	 AS 'AGENDADOS_MORBI_FORZADOS',
													SUM(AGENDADOS_CONFIRMADO_MORBI)  AS 'AGENDADOS_CONFIRMADO_MORBI',
												    SUM(BLOQUES_NO_AGENDADOS_MORBI)	 AS 'BLOQUES_NO_AGENDADOS_MORBI',
					round(SUM(AGENDADOS_MORBI)/SUM(OFERTADO_MORBI)*100,1) AS 'AGENDA_FINAL_PROCENTAJE_MORBI',										
					round(SUM(AGENDADOS_CONFIRMADO_MORBI)/SUM(AGENDADOS_MORBI)*100,1) AS 'AGENDADOS_PORCENTAJE_MORBI',
					round(((SUM(AGENDADOS_MORBI)-SUM(AGENDADOS_CONFIRMADO_MORBI))/SUM(AGENDADOS_MORBI))*100,1) AS 'INASISTENTE_PORCENTAJE_MORBI'

					FROM agenda_ocupacion_morbilidad where FECHAOFERTA IN (".implode(',',$arr).") GROUP BY CENTRO 
					ORDER BY FECHAOFERTA,CENTRO_ORDENADO ASC";

			$resultado = mysqli_query($conn,$sql);
			$count = mysqli_num_rows($resultado);
			if ($count == "0") {
				$data = array(
					"data" =>"0"
				);
			}else{
				while ($fila = mysqli_fetch_row($resultado)) {	
						$data[$i] = Array(
						"data"							=>"1",
						"FECHAOFERTA"       			=> $fila[0],
						"CENTRO"						=> $fila[1],
						"OFERTADO_MORBT"				=>$fila[2],
						"AGENDADOS_MORBT_TELEFONICA"	=>$fila[3],
						"AGENDADOS_MESON_MORBT"			=>$fila[4],	
						"AGENDADOS_FINAL_MORBT"			=>$fila[5],
						"AGENDADOS_CONFIRMADO_MORBT"	=>$fila[6],
						"BLOQUES_NO_AGENDADOS_MORBT"	=>$fila[7],
						"AGENDA_FINAL_PROCENTAJE_MORBT"	=>$fila[8],
						"AGENDADOS_PORCENTAJE_MORBT"	=>$fila[8],
						"INASISTENTE_PORCENTAJE_MORBT"	=>$fila[8],
						"OFERTADO_MORBI"				=>$fila[8],
						"AGENDADOS_MORBI"				=>$fila[9],
						"AGENDADOS_MORBI_FORZADOS"		=>$fila[11],
						"AGENDADOS_CONFIRMADO_MORBI" 	=>$fila[12],
						"BLOQUES_NO_AGENDADOS_MORBI" 	=>$fila[13],
						"AGENDA_FINAL_PROCENTAJE_MORBI" =>$fila[14],
						"AGENDADOS_PORCENTAJE_MORBI" 	=>$fila[15],
						"INASISTENTE_PORCENTAJE_MORBI"  =>$fila[16]
						);				
				  $i++;
				}//end while
			}//fin else


		}else{
			/*$modelo->setDesde($$arr);
			$modelo->setCentro($centro);
			$data = $modelo->OBTENER_VALORES_POR_DIA_CENTRO($conn);
			//echo json_encode($data);
			//print_r($data);*/


			$sql = "SELECT  FECHAOFERTA 		 AS 'FECHAOFERTA',
								CENTRO 							 AS 'CENTRO',
								OFERTADO_MORBT  				 AS 'OFERTADO_MORBT',
								AGENDADOS_MORBT_TELEFONICA  	 AS 'AGENDADOS_MORBT_TELEFONICA',
								AGENDADOS_MESON_MORBT	 		 AS 'AGENDADOS_MESON_MORBT',
								AGENDADOS_FINAL_MORBT   	 AS 'AGENDADOS_FINAL_MORBT',	
								AGENDADOS_CONFIRMADO_MORBT       AS 'AGENDADOS_CONFIRMADO_MORBT',
								BLOQUES_NO_AGENDADOS_MORBT       AS 'BLOQUES_NO_AGENDADOS_MORBT',
			round(AGENDADOS_FINAL_MORBT/OFERTADO_MORBT*100,1) AS 'AGENDA_FINAL_PROCENTAJE_MORBT',									
			round((AGENDADOS_CONFIRMADO_MORBT/AGENDADOS_FINAL_MORBT)*100,1)	 AS 'AGENDADOS_PORCENTAJE_MORBT',
			round(((AGENDADOS_FINAL_MORBT-AGENDADOS_CONFIRMADO_MORBT)/AGENDADOS_FINAL_MORBT)*100,1) AS 'INASISTENTE_PORCENTAJE_MORBT',
											OFERTADO_MORBI		   			 AS 'OFERTADO_MORBI',
											AGENDADOS_MORBI	  	 			 AS 'AGENDADOS_MORBI',
											AGENDADOS_MORBI_FORZADOS 	     AS 'AGENDADOS_MORBI_FORZADOS',	
											AGENDADOS_CONFIRMADO_MORBI		 AS 'AGENDADOS_CONFIRMADO_MORBI',
										    BLOQUES_NO_AGENDADOS_MORBI		 AS 'BLOQUES_NO_AGENDADOS_MORBI',
			round(AGENDADOS_MORBI/OFERTADO_MORBT*100,1) AS 'AGENDA_FINAL_PROCENTAJE_MORBI',																	
			round((AGENDADOS_CONFIRMADO_MORBI/AGENDADOS_MORBI)*100,1)	 AS 'AGENDADOS_PORCENTAJE_MORBI',
			round(((AGENDADOS_MORBI-AGENDADOS_CONFIRMADO_MORBI)/AGENDADOS_MORBI)*100,1) AS 'INASISTENTE_PORCENTAJE_MORBI'
						FROM agenda_ocupacion_morbilidad where CENTRO_ID IN('".$centro."') AND FECHAOFERTA IN (".implode(',',$arr).") 
						ORDER BY FECHAOFERTA,CENTRO_ORDENADO ASC";

				$resultado = mysqli_query($conn,$sql);
				$count = mysqli_num_rows($resultado);
				if ($count == "0") {
					$data = array(
						"data" =>"0"
					);
				}else{
					while ($fila = mysqli_fetch_row($resultado)) {	
							$data[$i] = Array(
							"data"							=>"1",
							"FECHAOFERTA"       			=> $fila[0],
							"CENTRO"						=> $fila[1],
							"OFERTADO_MORBT"				=>$fila[2],
							"AGENDADOS_MORBT_TELEFONICA"	=>$fila[3],
							"AGENDADOS_MESON_MORBT"			=>$fila[4],	
							"AGENDADOS_FINAL_MORBT"			=>$fila[5],
							"AGENDADOS_CONFIRMADO_MORBT"	=>$fila[6],
							"BLOQUES_NO_AGENDADOS_MORBT"	=>$fila[7],
							"AGENDA_FINAL_PROCENTAJE_MORBT"	=>$fila[8],
							"AGENDADOS_PORCENTAJE_MORBT"	=>$fila[8],
							"INASISTENTE_PORCENTAJE_MORBT"	=>$fila[8],
							"OFERTADO_MORBI"				=>$fila[8],
							"AGENDADOS_MORBI"				=>$fila[9],
							"AGENDADOS_MORBI_FORZADOS"		=>$fila[11],
							"AGENDADOS_CONFIRMADO_MORBI" 	=>$fila[12],
							"BLOQUES_NO_AGENDADOS_MORBI" 	=>$fila[13],
							"AGENDA_FINAL_PROCENTAJE_MORBI" =>$fila[14],
							"AGENDADOS_PORCENTAJE_MORBI" 	=>$fila[15],
							"INASISTENTE_PORCENTAJE_MORBI"  =>$fila[16]
							);				
					  $i++;
					}//end while
				}//fin else

		}
	}

	/*******************************  REPORTE EXCEL  ****************************************************/
	header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
	header('Content-Disposition: attachment; filename=OcupacionMorbilidadDiaria.xls');

		echo "<table  border='1' cellpadding='2' cellspacing='0'>";
			echo "<thead style='background-color: green;color:white;'>";
			foreach($titulosColumna as $clave => $valor){
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
					echo "<td>".$valor['AGENDADOS_MORBT_TELEFONICA']."</td>";
					echo "<td>".$valor['AGENDADOS_MESON_MORBT']."</td>";
					echo "<td>".$valor['AGENDADOS_FINAL_MORBT']."</td>";
					echo "<td>".$valor['AGENDADOS_CONFIRMADO_MORBT']."</td>";
					echo "<td>".$valor['BLOQUES_NO_AGENDADOS_MORBT']."</td>";
					echo "<td>".$valor['AGENDA_FINAL_PROCENTAJE_MORBT']."</td>";
					echo "<td>".$valor['AGENDADOS_PORCENTAJE_MORBT']."</td>";
					echo "<td>".$valor['INASISTENTE_PORCENTAJE_MORBT']."</td>";
					echo "<td>".$valor['OFERTADO_MORBI']."</td>";
					echo "<td>".$valor['AGENDADOS_MORBI']."</td>";
					echo "<td>".$valor['AGENDADOS_MORBI_FORZADOS']."</td>";
					echo "<td>".$valor['AGENDADOS_CONFIRMADO_MORBI']."</td>";
					echo "<td>".$valor['BLOQUES_NO_AGENDADOS_MORBI']."</td>";
					echo "<td>".$valor['AGENDA_FINAL_PROCENTAJE_MORBI']."</td>";
					echo "<td>".$valor['AGENDADOS_PORCENTAJE_MORBI']."</td>";
					echo "<td>".$valor['INASISTENTE_PORCENTAJE_MORBI']."</td>";
				echo "</tr>";
				$i++;
			}

			echo "</tbody>";
			echo "</table>";

?>