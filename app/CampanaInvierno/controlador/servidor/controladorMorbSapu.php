<?php
	//error_reporting(0);
	set_time_limit(300);
	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modeloMorbSapu.php");
	require_once "../../../../lib/PHPExcel/PHPExcel.php";
	require_once "../../../../lib/PHPExcel/PHPExcel/IOFactory.php";

	$bd = new Conexion();
	$modelo = new claseMorbSapu();

	$conn = $bd->Conectar();
	$evento = $_REQUEST['evento'];


switch ($evento) {
	case 'cargarTabla':		

		$fecha1=  $_REQUEST['fecha1'];
		$fecha2=  $_REQUEST['fecha2'];
		$centro = $_REQUEST['centro'];

		$fechaTitulo = "";
		$fechaTitulo2 = "";
		$mesTitulo = "";
		$yearTitle = "";
		$mes2= "";
		
	
		if ( $fecha1 == "" || $fecha1 == 0 || isset($$fecha1) ) {
				$date1 = new DateTime('Today');
				if($date1->format('l') != 'Monday'){
		   		   $date1->modify('Last Monday');
				}

				$fecha1 = $date1->format('Y-m-d');
				$fecha2 = date("Y-m-d", strtotime("Tomorrow"));

				$pro = explode('-', $fecha1);
				$pro2 = explode('-', $fecha2);
				$fechaTitulo = $pro[2];
				$fechaTitulo2 = $pro2[2];
				$mesTitulo = $pro[1];
				$yearTitle = $pro[0];

				
			}else{
				$fes = explode("/", $fecha1);
				$fecha1 = $fes[2]."-".$fes[1]."-".$fes[0];
				$fechaTitulo = $fes[0];
				$mesTitulo = $fes[1];
				$yearTitle = $fes[2];
		
				if ( $fecha2 ==0 || $fecha2 == "") {
			 		$fecha2 = $fecha1;
				} else {
			 		$fes2 = explode("/", $fecha2);
					$fecha2 = $fes2[2]."-".$fes2[1]."-".$fes2[0];
					$fechaTitulo2 = $fes2[0];

					if ($fes2[1]=== "") {
						$mes2 = $mesTitulo;	
					}else{
						$mes2 = $fes2[1];
					}
					
			    }
			}


			//echo $fecha1." ".$fecha2." ".$centro;
			$modelo->setCentro($centro);
			$modelo->setDesde($fecha1);
			$modelo->setHasta($fecha2);
			$data = $modelo->obtenerDataFinal($conn);

			//echo json_encode($data);


			$titulos= array('Total Atenciones de Urgencia','Total Causas Sistema Respiratorio','Ira Alta (J00-J06)','Influenza (J09-J11)','Neumonía(J12-J18)','Bonquitis/Bronquiolitis Aguda (J20-J21)','Crisis Obstructiva Bronquial (J40-J46) (SBO)','Otra Causa Respiratoria(J22;J30-J39,J47,J60-J98)','Sospecha Coronavirus','Coronavirus (U07.1)','Total Causas Sistema Circulatorio','Infarto Agudo Miocardio','Accidente Vascular Encefalico','Crisis Hipertensiva','Arritmia Grave','Otras Causa Circulatorios','Total Traumatismos y Envenenamientos','Accidentes del Transito','Otras Causa Externas (desglosar) sub total','Otros traumatismos','Heridas por arma blanca','Heridas por arma de fuego','Mordedura de perro','Mordedura de gato','Mordedura de roedor o animal de abasto','Exposición a murcielago','Total Diarea Aguda', 'Diarea Aguda (A00-A09)','Total demás causas (Desglosar)','Diabetes descompensada','Violencia Intrafamiliar (VIF)','Violencia sexual','Otras violencias (No incluidas anteriormente)','Intento de suicidio','Descompensación Psiquiatrica','Anticoncepción de emergencia con entrega de PAE','Gastrointestinales otras','OTRA CAUSA (No especificada)');

			$mesHoy = $mesTitulo;
			$anio = date("Y");
			$dias = date("d");

			switch ($mesHoy) {
				case '01': $mes= "ENERO";break;
				case '02': $mes= "FEBRERO";break;
				case '03': $mes= "MARZO";break;
				case '04': $mes= "ABRIL";break;
				case '05': $mes= "MAYO";break;
				case '06': $mes= "JUNIO";break;
				case '07': $mes= "JULIO";break;
				case '08': $mes= "AGOSTO";break;
				case '09': $mes= "SEPTIEMBRE";break;
				case '10': $mes= "OCTUBRE";break;
				case '11': $mes= "NOVIEMBRE";break;
				case '12': $mes= "DICIEMBRE";break;
			}

			switch ($mes2) {
				case '01': $mesDos= "ENERO";break;
				case '02': $mesDos= "FEBRERO";break;
				case '03': $mesDos= "MARZO";break;
				case '04': $mesDos= "ABRIL";break;
				case '05': $mesDos= "MAYO";break;
				case '06': $mesDos= "JUNIO";break;
				case '07': $mesDos= "JULIO";break;
				case '08': $mesDos= "AGOSTO";break;
				case '09': $mesDos= "SEPTIEMBRE";break;
				case '10': $mesDos= "OCTUBRE";break;
				case '11': $mesDos= "NOVIEMBRE";break;
				case '12': $mesDos= "DICIEMBRE";break;
			}

			switch ($centro) {
				case 11: 
					if ($fechaTitulo != "" && $fechaTitulo2 != "") {
						//echo "<div class='form-horizontal'> <h4>Morbilidad Sapu correspondiente al SAPU S.L entre  ".$fechaTitulo." - ".$fechaTitulo2." de ".$mes." ".$yearTitle."</h4>  </div>";	
						echo "<div class='form-horizontal'> <h4>Morbilidad Sapu correspondiente al SAPU S.L entre  ".$fechaTitulo." de ".$mes." - ".$fechaTitulo2." de ".$mesDos." ".$yearTitle."</h4>  </div>";
					}else{
						echo "<div class='form-horizontal'> <h4>Morbilidad Sapu correspondiente al SAPU S.L del dia  ".$fechaTitulo." de ".$mes." ".$yearTitle."</h4>  </div>";
					}
				break;
				case 8: 
					if ($fechaTitulo != "" && $fechaTitulo2 != "") {
						//echo "<div class='form-horizontal'> <h4>Morbilidad Sapu correspondiente al SAPU C.U entre  ".$fechaTitulo." - ".$fechaTitulo2." de ".$mes." ".$yearTitle."</h4>  </div>";
						echo "<div class='form-horizontal'> <h4>Morbilidad Sapu correspondiente al SAPU C.U entre  ".$fechaTitulo." de ".$mes." - ".$fechaTitulo2." de ".$mesDos." ".$yearTitle."</h4>  </div>";
					}else{
						echo "<div class='form-horizontal'> <h4>Morbilidad Sapu correspondiente al SAPU C.U del dia  ".$fechaTitulo." de ".$mes." ".$yearTitle."</h4>  </div>";
					}
				break;
				case 9: 
					if ($fechaTitulo != "" && $fechaTitulo2 != "") {
						//echo "<div class='form-horizontal'> <h4>Morbilidad Sapu correspondiente al SAPU L.F entre  ".$fechaTitulo." - ".$fechaTitulo2." de ".$mes." ".$yearTitle."</h4> </div>";
						echo "<div class='form-horizontal'> <h4>Morbilidad Sapu correspondiente al SAPU L.F entre  ".$fechaTitulo." de ".$mes." - ".$fechaTitulo2." de ".$mesDos." ".$yearTitle."</h4>  </div>";
					}else{
						echo "<div class='form-horizontal'> <h4>Morbilidad Sapu correspondiente al SAPU L.F del dia  ".$fechaTitulo." de ".$mes." ".$yearTitle."</h4>  </div>";
					}
				break;
				case 10: 
					if ($fechaTitulo != "" && $fechaTitulo2 != "") {
						//echo "<div class='form-horizontal'> <h4>Morbilidad Sapu correspondiente al SAPU L.H entre  ".$fechaTitulo." - ".$fechaTitulo2." de ".$mes." ".$yearTitle."</h4>  </div>";
						echo "<div class='form-horizontal'> <h4>Morbilidad Sapu correspondiente al SAPU L.H entre  ".$fechaTitulo." de ".$mes." - ".$fechaTitulo2." de ".$mesDos." ".$yearTitle."</h4>  </div>";
					}else{
						echo "<div class='form-horizontal'> <h4>Morbilidad Sapu correspondiente al SAPU  L.H del dia  ".$fechaTitulo." de ".$mes." ".$yearTitle."</h4>  </div>";
					}
				break;
				default:
					if ($fechaTitulo != "" && $fechaTitulo2 != "") {
						//echo "<div class='form-horizontal'> <h4>Morbilidad Sapu Comunal entre  ".$fechaTitulo." - ".$fechaTitulo2." de ".$mes." ".$yearTitle."</h4> </div>";
						echo "<div class='form-horizontal'> <h4>Morbilidad Sapu Comunal entre  ".$fechaTitulo." de ".$mes." - ".$fechaTitulo2." de ".$mesDos." ".$yearTitle."</h4>  </div>";
					}else{
						echo "<div class='form-horizontal'> <h4>Morbilidad Sapu Comunal del dia  ".$fechaTitulo." de ".$mes." ".$yearTitle."</h4>  </div>";
					}
				break;
			}


			
			switch ($centro) {
				case 11: 
					$centro = "San Luis ";
				break;
				case 8: 
					$centro = "Carol Urzua ";
				break;
				case 9: 
					$centro = "La Faena";
				break;
				case 5: 
					$centro = "Lo Hermida ";
				break;
				default:
					$centro = "Comunal";
				break;
			}

			echo "<table id='dataTable'>";
			// TITULO PRINCIPAL
			echo "<tr>";				
				echo "<td colspan='1'style='background: #6F85FF;color: white;border:.5pt solid #666666;'> Atenciones SAPU ".$centro."</td>";
				echo "<td colspan='1' style='background: #6F85FF;color: white;border:.5pt solid #666666;text-align: center;'> Total </td>";
				echo "<td colspan='1' style='background: #6F85FF;color: white;border:.5pt solid #666666;text-align: center;'> -1 A&ntilde;o </td>";
				echo "<td colspan='1' style='background: #6F85FF;color: white;border:.5pt solid #666666;text-align: center;'> 1-4 A&ntilde;os </td>";
				echo "<td colspan='1' style='background: #6F85FF;color: white;border:.5pt solid #666666;text-align: center;'> 5-14 A&ntilde;os </td>";
				echo "<td colspan='1' style='background: #6F85FF;color: white;border:.5pt solid #666666;text-align: center;'> 15-64 A&ntilde;os </td>";
				echo "<td colspan='1' style='background: #6F85FF;color: white;border:.5pt solid #666666;text-align: center;'> 65 A&ntilde;os y + </td>";
			echo "</tr>";

			$cont = 1;

			if ($data[0] == "0") {
				echo "<tr>";
					echo "<td colspan='7'><h2>No hay registros en la fecha ingresada</h2></td>";
				echo "</tr>";
				echo "</table>";
			}else{
				foreach ($data as $clave => $valor) {
						for ($x = 1; $x <= 38; $x++) {
							if ($cont == 1 || $cont == 19) {
							echo "<tr>";
								echo "<td colspan='1' style='font-weight: bolder;background:yellow;border:.5pt solid;'>".$titulos[$x-1]."</td>";
								echo "<td colspan='1' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_1']."</td>";
								echo "<td colspan='1' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_2']."</td>";
								echo "<td colspan='1' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_3']."</td>";
								echo "<td colspan='1' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_4']."</td>";
								echo "<td colspan='1' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_5']."</td>";
								echo "<td colspan='1' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_6']."</td>";
							echo "</tr>";
							}else{
								if ($cont == 2 || $cont == 11 || $cont == 17 || $cont == 27 || $cont == 29 ) {
									echo "<tr>";
										echo "<td colspan='1' style='font-weight: bolder;background:#BAC4FF;'>".$titulos[$x-1]."</td>";
										echo "<td colspan='1' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_1']."</td>";
										echo "<td colspan='1' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_2']."</td>";
										echo "<td colspan='1' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_3']."</td>";
										echo "<td colspan='1' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_4']."</td>";
										echo "<td colspan='1' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_5']."</td>";
										echo "<td colspan='1' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_6']."</td>";
									echo "</tr>";
									}else{
										echo "<tr>";
											echo "<td colspan='1' style='border:.5pt solid;text-align: right;' >".$titulos[$x-1]."</td>";
											echo "<td colspan='1' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_1']."</td>";
												echo "<td colspan='1' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_2']."</td>";
												echo "<td colspan='1' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_3']."</td>";
												echo "<td colspan='1' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_4']."</td>";
												echo "<td colspan='1' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_5']."</td>";
												echo "<td colspan='1' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_6']."</td>";

										echo "</tr>";
									}
							}
							$cont = $cont+1;
						}// END FOR RECORRIDO
					}// END FOR EACH
			}

			echo "</table>";






		/*	echo "<table id='dataTable'>";
				echo "<tr>";

					switch($centro){
						case 11: 
							echo "<td colspan='1' style='background: #6F85FF;color: white; border-style: inset; border-width: 1px;'> Atenciones SAPU San Luis</td>";
						break;
						case 8: 
							echo "<td colspan='1' style='background: #6F85FF;color: white; border-style: inset; border-width: 1px;'> Atenciones SAPU Carol Urzua </td>";
						break;
						case 9: 
							echo "<td colspan='1' style='background: #6F85FF;color: white; border-style: inset; border-width: 1px;'> Atenciones SAPU La Faena</td>";
						break;
						case 10: 
							echo "<td colspan='1' style='background: #6F85FF;color: white; border-style: inset; border-width: 1px;'> Atenciones SAPU Lo Hermida</td>";
						break;
						default:
							echo "<td colspan='1' style='background: #6F85FF;color: white; border-style: inset; border-width: 1px;'> Atenciones SAPU Comunal </td>";
						break;
					}

					
					echo "<td colspan='2' style='background: #6F85FF;color: white; border:.5pt solid;' style='text-align: center;'> Total </td>";
					echo "<td colspan='2' style='background: #6F85FF;color: white; border:.5pt solid;' style='text-align: center;'> -1 A&ntilde;o </td>";
					echo "<td colspan='2' style='background: #6F85FF;color: white; border:.5pt solid;' style='text-align: center;'> 1-4 A&ntilde;os </td>";
					echo "<td colspan='2' style='background: #6F85FF;color: white; border:.5pt solid;' style='text-align: center;'> 5-14 A&ntilde;os </td>";
					echo "<td colspan='2' style='background: #6F85FF;color: white; border:.5pt solid;' style='text-align: center;'> 15-64 A&ntilde;os </td>";
					echo "<td colspan='2' style='background: #6F85FF;color: white; border:.5pt solid;' style='text-align: center;'> 65 A&ntilde;os y + </td>";
				echo "</tr>";
				$cont = 1;
				if ($data[0] == "0") {
					echo "<tr>";
						echo "<td colspan='7'><h2>No hay registros en la fecha ingresada</h2></td>";
					echo "</tr>";
					echo "</table>";
				}else{
					foreach ($data as $clave => $valor) {
						for ($x = 1; $x <= 36; $x++) {
							if ($cont == 1 || $cont == 19) {
							echo "<tr>";
								echo "<td colspan='1' style='font-weight: bolder;background:yellow;border:.5pt solid;'>".$titulos[$x-1]."</td>";
								echo "<td colspan='2' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_1']."</td>";
								echo "<td colspan='2' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_2']."</td>";
								echo "<td colspan='2' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_3']."</td>";
								echo "<td colspan='2' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_4']."</td>";
								echo "<td colspan='2' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_5']."</td>";
								echo "<td colspan='2' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_6']."</td>";
							echo "</tr>";
							}else{
								if ($cont == 2 || $cont == 11 || $cont == 17 || $cont == 27 || $cont == 29 ) {
									echo "<tr>";
										echo "<td colspan='1' style='font-weight: bolder;background:#BAC4FF;'>".$titulos[$x-1]."</td>";
										echo "<td colspan='2' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_1']."</td>";
										echo "<td colspan='2' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_2']."</td>";
										echo "<td colspan='2' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_3']."</td>";
										echo "<td colspan='2' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_4']."</td>";
										echo "<td colspan='2' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_5']."</td>";
										echo "<td colspan='2' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_6']."</td>";
									echo "</tr>";
									}else{
										echo "<tr>";
											echo "<td colspan='1' style='border:.5pt solid;text-align: right;' >".$titulos[$x-1]."</td>";
											echo "<td colspan='2' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_1']."</td>";
												echo "<td colspan='2' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_2']."</td>";
												echo "<td colspan='2' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_3']."</td>";
												echo "<td colspan='2' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_4']."</td>";
												echo "<td colspan='2' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_5']."</td>";
												echo "<td colspan='2' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_6']."</td>";

										echo "</tr>";
									}
							}
							$cont = $cont+1;
						}// END FOR RECORRIDO
					}// END FOR EACH

				} // END IF
			echo "</table>";*/



	break;

	case 'exportarArchivo':
		$fecha1=  $_REQUEST['fecha1'];
		$fecha2=  $_REQUEST['fecha2'];
		//print_r($fecha1);
	
		if ( $fecha1 == "" || $fecha1 == 0 || isset($$fecha1) ) {
				$date1 = new DateTime('Today');
				if($date1->format('l') != 'Monday'){
		   		   $date1->modify('Last Monday');
				}
				$fecha1 = $date1->format('Y-m-d');
				$fecha2 = date("Y-m-d", strtotime("Tomorrow"));
			}else{
				$fes = explode("/", $fecha1);
				$fecha1 = $fes[2]."-".$fes[1]."-".$fes[0];
		
				if ( $fecha2 ==0 || $fecha2 == "") {
			 		$fecha2 = $fecha1;
				} else {
			 		$fes2 = explode("/", $fecha2);
					$fecha2 = $fes2[2]."-".$fes2[1]."-".$fes2[0];
			    }
			}


			$centro = $_REQUEST['centro'];
			$modelo->setCentro($centro);
			$modelo->setDesde($fecha1);
			$modelo->setHasta($fecha2);
			$data = $modelo->obtenerDataFinal($conn);

			$titulos= array('Total Atenciones de Urgencia','Total Causas Sistema Respiratorio','Ira Alta (J00-J06)','Influenza (J09-J11)','Neumonía(J12-J18)','Bonquitis/Bronquiolitis Aguda (J20-J21)','Crisis Obstructiva Bronquial (J40-J46) (SBO)','Otra Causa Respiratoria(J22;J30-J39,J47,J60-J98)','Sospecha Coronavirus','Coronavirus (U07.1)','Total Causas Sistema Circulatorio','Infarto Agudo Miocardio','Accidente Vascular Encefalico','Crisis Hipertensiva','Arritmia Grave','Otras Causa Circulatorios','Total Traumatismos y Envenenamientos','Accidentes del Transito','Otras Causa Externas (desglosar) sub total','Otros traumatismos','Heridas por arma blanca','Heridas por arma de fuego','Mordedura de perro','Mordedura de gato','Mordedura de roedor o animal de abasto','Exposición a murcielago','Total Diarea Aguda', 'Diarea Aguda (A00-A09)','Total demás causas (Desglosar)','Diabetes descompensada','Violencia Intrafamiliar (VIF)','Violencia sexual','Otras violencias (No incluidas anteriormente)','Intento de suicidio','Descompensación Psiquiatrica','Anticoncepción de emergencia con entrega de PAE','Gastrointestinales otras','OTRA CAUSA (No especificada)');

			switch ($centro) {
				case 11: 
					$centro = "San Luis ";
				break;
				case 8: 
					$centro = "Carol Urzua ";
				break;
				case 9: 
					$centro = "La Faena";
				break;
				case 5: 
					$centro = "Lo Hermida ";
				break;
				default:
					$centro = "Comunal";
				break;
			}

			header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
			header('Content-Disposition: attachment; filename=Morbilidad Sapu '.$centro.'.xls');

			echo "<table id='dataTable'>";
			// TITULO PRINCIPAL
			echo "<tr>";				
				echo "<td colspan='1'style='background: #6F85FF;color: white;border:.5pt solid black;'> Atenciones SAPU ".$centro."</td>";
				echo "<td colspan='1' style='background: #6F85FF;color: white;border:.5pt solid black;text-align: center;'> Total </td>";
				echo "<td colspan='1' style='background: #6F85FF;color: white;border:.5pt solid black;text-align: center;'> -1 A&ntilde;o </td>";
				echo "<td colspan='1' style='background: #6F85FF;color: white;border:.5pt solid black;text-align: center;'> 1-4 A&ntilde;os </td>";
				echo "<td colspan='1' style='background: #6F85FF;color: white;border:.5pt solid black;text-align: center;'> 5-14 A&ntilde;os </td>";
				echo "<td colspan='1' style='background: #6F85FF;color: white;border:.5pt solid black;text-align: center;'> 15-64 A&ntilde;os </td>";
				echo "<td colspan='1' style='background: #6F85FF;color: white;border:.5pt solid black;text-align: center;'> 65 A&ntilde;os y + </td>";
			echo "</tr>";

			$cont = 1;

			if ($data[0] == "0") {
				echo "<tr>";
					echo "<td colspan='7'><h2>No hay registros en la fecha ingresada</h2></td>";
				echo "</tr>";
				echo "</table>";
			}else{
				foreach ($data as $clave => $valor) {
						for ($x = 1; $x <= 38; $x++) {
							if ($cont == 1 || $cont == 19) {
							echo "<tr>";
								echo "<td colspan='1' style='font-weight: bolder;background:yellow;border:.5pt solid;'>".$titulos[$x-1]."</td>";
								echo "<td colspan='1' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_1']."</td>";
								echo "<td colspan='1' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_2']."</td>";
								echo "<td colspan='1' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_3']."</td>";
								echo "<td colspan='1' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_4']."</td>";
								echo "<td colspan='1' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_5']."</td>";
								echo "<td colspan='1' style='font-weight: bolder;background:yellow;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_6']."</td>";
							echo "</tr>";
							}else{
								if ($cont == 2 || $cont == 11 || $cont == 17 || $cont == 27 || $cont == 29 ) {
									echo "<tr>";
										echo "<td colspan='1' style='font-weight: bolder;background:#BAC4FF;'>".$titulos[$x-1]."</td>";
										echo "<td colspan='1' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_1']."</td>";
										echo "<td colspan='1' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_2']."</td>";
										echo "<td colspan='1' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_3']."</td>";
										echo "<td colspan='1' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_4']."</td>";
										echo "<td colspan='1' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_5']."</td>";
										echo "<td colspan='1' style='font-weight: bolder;background:#BAC4FF;border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_6']."</td>";
									echo "</tr>";
									}else{
										echo "<tr>";
											echo "<td colspan='1' style='border:.5pt solid;text-align: right;' >".$titulos[$x-1]."</td>";
											echo "<td colspan='1' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_1']."</td>";
												echo "<td colspan='1' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_2']."</td>";
												echo "<td colspan='1' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_3']."</td>";
												echo "<td colspan='1' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_4']."</td>";
												echo "<td colspan='1' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_5']."</td>";
												echo "<td colspan='1' style='border:.5pt solid;text-align: center;width: 10%;'>".$valor[$x.'_6']."</td>";

										echo "</tr>";
									}
							}
							$cont = $cont+1;
						}// END FOR RECORRIDO
					}// END FOR EACH
			}

			echo "</table>";
	break;


	default:
		print_r("Error..");
	break;

}