<?php
//	error_reporting(0);

	set_time_limit(300);
	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modeloMorbMedica.php");
	require_once "../../../../lib/PHPExcel/PHPExcel.php";
	require_once "../../../../lib/PHPExcel/PHPExcel/IOFactory.php";

	$bd = new Conexion();
	$modelo = new claseMorbMedica();

	$conn = $bd->Conectar();
	$evento = $_REQUEST['evento'];


$evento = $_REQUEST["evento"];

switch ($evento) {
	case 'cargarTabla':

		$fechaTitulo = "";
		$fechaTitulo2 = "";
		$mesTitulo = "";
		$yearTitle = "";
	
		$fecha1=  $_REQUEST['fecha1'];
		$fecha2=  $_REQUEST['fecha2'];
	
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
			$fechaTitulo = $fes[0]."-".$fes[1]."-".$fes[2];
			$mesTitulo = $fes[1];
			$yearTitle = $fes[2];
		
			if ($fecha2 ==0 || $fecha2 == "") {
		 		$fecha2 = $fecha1;
			} else {
		 		$fes2 = explode("/",$fecha2);
				$fecha2 = $fes2[2]."-".$fes2[1]."-".$fes2[0];
				$fechaTitulo2 = $fes2[0]."-".$fes2[1]."-".$fes2[2];
		    }
		}


		//echo $fecha1." ".$fechaTitulo;


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


			//echo $fecha1." ".$fecha2;

			// TITULO PRINCIPAL
				echo "<table>";
				echo "<tr>";
					if ($fechaTitulo != "" && $fechaTitulo2 != "") {
						echo "<td colspan='3' class='tituloPrincipal' >ATENCIONES : ENTRE ".$fechaTitulo." al ".$fechaTitulo2."</td>";
					//	echo "<td colspan='3' style='background: #6F85FF;color: white;'>ATENCIONES : ENTRE ".$fechaTitulo." al ".$fechaTitulo2."</td>";
					}else{
						echo "<td colspan='3' class='tituloPrincipal' >ATENCIONES : EL DIA ".$fechaTitulo." de ".$mes." ".$yearTitle."</td>";
					}
					echo "<td colspan='1' class='tituloPrincipal' style='width: 6em;text-align:center'> San Luis </td>";
					echo "<td colspan='1' class='tituloPrincipal' style='width: 6em;text-align:center'> Carol Urzua </td>";
					echo "<td colspan='1' class='tituloPrincipal' style='width: 6em;text-align:center'> La Faena </td>";
					echo "<td colspan='1' class='tituloPrincipal' style='width: 6em;text-align:center'> Lo Hermida </td>";
					echo "<td colspan='1' class='tituloPrincipal'> Cardenal Silva H. </td>";
					echo "<td colspan='1' class='tituloPrincipal'> Padre G. Whelan </td>";
					echo "<td colspan='1' class='tituloPrincipal'> Las Torres </td>";
					echo "<td colspan='1' class='tituloPrincipal'> Total comunal </td>";
				echo "</tr>";

				//LLENA LA PRIMERA COLUMNA DE LA CABECERA TITULO 2
				//$array = array(325,281,238,182,146,147,1,1.319); PERIODO ANTERIOR
				$array = array(132,270,228,177,143,144,185,1.279);

				$progSemanal = array(1623,1403,1191,910,730,735,6592);
				echo "<tr>";
				echo "<td colspan='3' class='tituloSecundario' style= 'font-weight: bolder;'>Programado diario (Estimacion total anual/ dias habiles)</td>";
				foreach ($array as $valor) {
				  echo "<td colspan='1' class='tituloSecundario2' style= 'font-weight: bolder;'>".$valor."</td>";
				}
				echo "</tr>";

					$sumatoriaTot = 0;
					$titulos = array('Total de Atenciones Realizadas','Total de Cupos con Acto Morbilidad (No Forzados)','Total de Cupos Enviados a GDA');
					$modelo->setDesde($fecha1);
					$modelo->setHasta($fecha2);	
					$fechas			= $modelo->obtenerTotalAtenciones($conn);				//Obtiene las fechas agrupadas por fecha
					$total 			= $modelo->obtenerTotalAtencionesValor($conn); 			//Total de Atenciones Realizadas
					$total2 		= $modelo->obtenerTotalCuposconActoMorb($conn); 		//Total de Cupos con Acto Morbilidad	
					$total3 		= $modelo->obtenerTotalCuposEnviadosGda($conn); 		//Total de Cupos Enviados a GDA
					$totales 		= $modelo->OBTENER_MORBILIDAD_DIARIA_TOTAL($conn);

					//var_dump($total);
					//echo $total;

					$disSem = 1;
					$sum = 0;
				echo "<tr>";
				$fila = 0;
				foreach ($fechas as $values) {
							
					$dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
					$dia = $dias[date('N', strtotime($values["fecha_cita"]))];
					if ($values["fecha_cita"] == 0) {
						echo "<td rowspan='4' class='cuerpo'>".$fecha1."</td>";
					}else{
						echo "<td rowspan='4' class='cuerpo'>".$values["fecha_cita"]."</td>";
					}
					
					echo "<td rowspan='4' class='cuerpo'>".$dia."</td>";
					//TITULOS
					foreach ($titulos as $val) {
						echo "<tr>";
						echo "<td colspan='1' class='cuerpo'>".$val."</td>";
						for($i=0; $i<8;$i++)
						{
							if ($val === "Total de Atenciones Realizadas") {
								$totAten = $total[$fila][$i]["ESTIMADO"];
								$largoAten = strlen((string)$totAten);

								if ($largoAten == 4) {
									$numUnAten= substr($totAten, 0,-3);
									$numDoAten= substr($totAten, 1);
									$finAten = $numUnAten.".".$numDoAten;
									echo "<td colspan='1' class='cuerpo2'>".$finAten."</td>";
								}else
									if ($largoAten == 5) {
										$numUnAtenc= substr($totAten, 0,-3);
										$numDoAtenc= substr($totAten, 2);
										$finaAtenc = $numUnAtenc.".".$numDoAtenc;
										echo "<td colspan='1' class='cuerpo2'>".$finaAtenc."</td>";
									}else
									{
										echo "<td colspan='1' class='cuerpo2'>".$total[$fila][$i]["ESTIMADO"]."</td>";
									}

								//echo "<td colspan='1' class='cuerpo2'>".$total[$fila][$i]["ESTIMADO"]."</td>";
								
							}else
								if ($val ==="Total de Cupos con Acto Morbilidad (No Forzados)") {

									$totAten = $total2[$fila][$i]["ESTIMADO"];
									$largoAten = strlen((string)$totAten);

									if ($largoAten == 4) {
										$numUnAten= substr($totAten, 0,-3);
										$numDoAten= substr($totAten, 1);
										$finAten = $numUnAten.".".$numDoAten;
										echo "<td colspan='1' class='cuerpo2'>".$finAten."</td>";
									}else
										if ($largoAten == 5) {
											$numUnAtenc= substr($totAten, 0,-3);
											$numDoAtenc= substr($totAten, 2);
											$finaAtenc = $numUnAtenc.".".$numDoAtenc;
											echo "<td colspan='1' class='cuerpo2'>".$finaAtenc."</td>";
										}else
										{
											echo "<td colspan='1' class='cuerpo2'>".$total2[$fila][$i]["ESTIMADO"]."</td>";
										}
									//echo "<td colspan='1' class='cuerpo2'>".$total2[$fila][$i]["ESTIMADO"]."</td>";
								}else{
									$totAten = $total3[$fila][$i]["ESTIMADO"];
									$largoAten = strlen((string)$totAten);

									if ($largoAten == 4) {
										$numUnAten= substr($totAten, 0,-3);
										$numDoAten= substr($totAten, 1);
										$finAten = $numUnAten.".".$numDoAten;
										echo "<td colspan='1' class='cuerpo2'>".$finAten."</td>";
									}else
										if ($largoAten == 5) {
											$numUnAtenc= substr($totAten, 0,-3);
											$numDoAtenc= substr($totAten, 2);
											$finaAtenc = $numUnAtenc.".".$numDoAtenc;
											echo "<td colspan='1' class='cuerpo2'>".$finaAtenc."</td>";
										}else
										{
											echo "<td colspan='1' class='cuerpo2'>".$total3[$fila][$i]["ESTIMADO"]."</td>";
										}

									//echo "<td colspan='1' class='cuerpo2'> </td>";
									//echo "<td colspan='1' class='cuerpo2'>".$total3[$fila][$i]["ESTIMADO"]."</td>";
								}
						}
							echo "</tr>";
					}

					$disSem = $disSem + 1;
					$fila++;
				}


				$titulosTotales = array('Programado por día habil elegido','Total de Atenciones Realizadas','Total de Cupos con Acto Morbilidad  (No Forzados)','Total de Cupos Enviados a GDA','% Atendidos / cupos disponibles','% Ofertados por telefono/cupos totales','Atendido/Programado');

				$filas = 0;
				$cont = 1;								
				foreach ($titulosTotales as $titTot) {
					echo "<tr>";
					echo "<td colspan='1'></td>";
					echo "<td colspan='1'></td>";
					if ($cont == 1 || $cont == 7 ) {
						echo "<td colspan='1' style='background: yellow; border-style: inset;border-width: 2px;font-weight: bolder;'>".$titTot."</td>";
					}else{
						echo "<td colspan='1' style = 'border-style: inset;border-width: 2px;'>".$titTot."</td>";
					}					
					for($i=0; $i<8;$i++){
						if ($cont == 1) {
							$num = $totales[$filas][$i]["CANTIDAD"];
							$numlength = strlen((string)$num);
							if ($numlength == 4) {
								$numUn= substr($num, 0,-3);
								$numDo= substr($num, 1);
								$fin = $numUn.".".$numDo;
								echo "<td colspan='1' style='font-weight: bolder;background: yellow; border-style: inset;border-width: 2px;text-align: center;'>".$fin."</td>";
							}else
								if ($numlength == 5) {
									$numUno= substr($num, 0,-3);
									$numDos= substr($num, 2);
									$fina = $numUno.".".$numDos;
									echo "<td colspan='1' style='font-weight: bolder;background: yellow; border-style: inset;border-width: 2px;text-align: center;'>".$fina."</td>";
								}else
									{
									echo "<td colspan='1' style='font-weight: bolder;background: yellow; border-style: inset;border-width: 2px;text-align: center;'>".$totales[$filas][$i]["CANTIDAD"]."</td>";
									}
						}else
							if ($cont == 7) {
								echo "<td colspan='1' style='font-weight: bolder;background: yellow; border-style: inset;border-width: 2px;text-align: center;'>".$totales[$filas][$i]["CANTIDAD"]." % </td>";
							}else{
								if ($cont == 5  || $cont == 6) {
									echo "<td colspan='1' style = 'border-style: inset;border-width: 2px;text-align: center;'>".$totales[$filas][$i]["CANTIDAD"]."%</td>";
								}else{

								$numeros = $totales[$filas][$i]["CANTIDAD"];
								$largoNum = strlen((string)$numeros);

								if ($largoNum == 4) {
									$numeroUn = substr($numeros, 0,-3);
									$numeroDo = substr($numeros, 1);
									$concat = $numeroUn.".".$numeroDo;
									echo "<td colspan='1' style = 'border-style: inset;border-width: 2px;text-align: center;'>".$concat."</td>";
								}else
									if ($largoNum == 5) {
										$numeroUno = substr($numeros, 0,-3);
										$numeroDos = substr($numeros, 2);
										$concate = $numeroUno.".".$numeroDos;
										echo "<td colspan='1' style = 'border-style: inset;border-width: 2px;text-align: center;'>".$concate."</td>";
									}else{
										echo "<td colspan='1' style = 'border-style: inset;border-width: 2px;text-align: center;'>".$totales[$filas][$i]["CANTIDAD"]."</td>";
									}
								}
							}

					}
					echo "</tr>";

					$cont = $cont +1;
					$filas = $filas+1;
				}
			
			//var_dump($totales);
			//var_dump($totales);
			echo "</table>";

	break;

	case 'exportarArchivo':
		$fechaTitulo = "";
		$fechaTitulo2 = "";
		$mesTitulo = "";
		$yearTitle = "";
	
		$fecha1=  $_REQUEST['fecha1'];
		$fecha2=  $_REQUEST['fecha2'];
	
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
			//$fechaTitulo = $fes[0];
			$fechaTitulo = $fes[0]."-".$fes[1]."-".$fes[2];
			$mesTitulo = $fes[1];
			$yearTitle = $fes[2];
		
			if ($fecha2 ==0 || $fecha2 == "") {
		 		$fecha2 = $fecha1;
			} else {
		 		$fes2 = explode("/",$fecha2);
				$fecha2 = $fes2[2]."-".$fes2[1]."-".$fes2[0];
				$fechaTitulo2 = $fes2[0]."-".$fes2[1]."-".$fes2[2];
		    }
		}





			header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
			header('Content-Disposition: attachment; filename=Morbilidad Medica.xls');

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

			// TITULO PRINCIPAL
			echo "<table>";
				echo "<tr>";
					if ($fechaTitulo != "" && $fechaTitulo2 != "") {
						echo "<td colspan='3' style='background: #6F85FF;color: white;' class='tituloPrincipal' >ATENCIONES : ENTRE ".$fechaTitulo." al ".$fechaTitulo2."</td>";
					//	echo "<td colspan='3' style='background: #6F85FF;color: white;'>ATENCIONES : ENTRE ".$fechaTitulo." al ".$fechaTitulo2."</td>";
					}else{
						echo "<td colspan='3' style='background: #6F85FF;color: white;' class='tituloPrincipal' >ATENCIONES : EL DIA ".$fechaTitulo." de ".$mes." ".$yearTitle."</td>";
					}
					echo "<td colspan='1' style='color: white;background: #6F85FF;width: 6em;text-align:center'> San Luis </td>";
					echo "<td colspan='1' style='color: white;background: #6F85FF;width: 6em;text-align:center'> Carol Urzua </td>";
					echo "<td colspan='1' style='color: white;background: #6F85FF;width: 6em;text-align:center'> La Faena </td>";
					echo "<td colspan='1' style='color: white;background: #6F85FF;width: 6em;text-align:center'> Lo Hermida </td>";
					echo "<td colspan='1' style='background: #6F85FF;color: white;'> Cardenal Silva H. </td>";
					echo "<td colspan='1' style='background: #6F85FF;color: white;'> Padre G. Whelan </td>";
					echo "<td colspan='1' style='background: #6F85FF;color: white;'> Las Torres </td>";
					echo "<td colspan='1' style='background: #6F85FF;color: white;'> Total comunal </td>";
				echo "</tr>";

				//LLENA LA PRIMERA COLUMNA DE LA CABECERA TITULO 2
				$array = array(132,270,228,177,143,144,185,1.279);

				$progSemanal = array(1623,1403,1191,910,730,735,6592);
				echo "<tr>";
				echo "<td colspan='3' style= 'background: #BAC4FF;font-weight: bolder;'> (Estimaci&oacute;n total anual/ d&iacute;as h&aacute;biles) </td>";
				foreach ($array as $valor) {
				  echo "<td colspan='1' style='background: #BAC4FF;text-align: center;font-weight: bolder;'>".$valor."</td>";
				}
				echo "</tr>";

					$sumatoriaTot = 0;
					$titulos = array('Total de Atenciones Realizadas','Total de Cupos con Acto Morbilidad (No Forzados)','Total de Cupos Enviados a GDA');
					$modelo->setDesde($fecha1);
					$modelo->setHasta($fecha2);
					$fechas			= $modelo->obtenerTotalAtenciones($conn);				//Obtiene las fechas agrupadas por fecha
					$total 			= $modelo->obtenerTotalAtencionesValor($conn); 			//Total de Atenciones Realizadas
					$total2 		= $modelo->obtenerTotalCuposconActoMorb($conn); 		//Total de Cupos con Acto Morbilidad	
					$total3 		= $modelo->obtenerTotalCuposEnviadosGda($conn); 		//Total de Cupos Enviados a GDA
					$total3 		= $modelo->obtenerTotalCuposEnviadosGda($conn); 		//Total de Cupos Enviados a GDA
					$totales 		= $modelo->OBTENER_MORBILIDAD_DIARIA_TOTAL($conn);
					$disSem = 1;
					$sum = 0;
				echo '<tr>';
				$fila = 0;
				foreach ($fechas as $values) {
					$dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
					$dia = $dias[date('N', strtotime($values["fecha_cita"]))];
					if ($values["fecha_cita"] == 0) {
						echo "<td rowspan='3'style= ''>".$fecha1."</td>";
					}else{
						echo "<td rowspan='3'style= ''>".$values["fecha_cita"]."</td>";
					}
					
					echo "<td rowspan='3' style= ''>".$dia."</td>";
					echo "<td colspan='1' style= ''>Total de Atenciones Realizadas</td>";
					for($i=0; $i<8;$i++)
						{
							$num = $total[$fila][$i]["ESTIMADO"];
							$numlength = strlen((string)$num);
							if ($numlength == 4) {
								$numUn= substr($num, 0,-3);
								$numDo= substr($num, 1);
								$fin = $numUn.".".$numDo;
								echo "<td colspan='1' style='text-align: center;'>".$fin."</td>";
							}else
								if ($numlength == 5) {
									$numUno= substr($num, 0,-3);
									$numDos= substr($num, 2);
									$fina = $numUno.".".$numDos;
									echo "<td colspan='1' style='text-align: center;'>".$fina."</td>";
								}else
									{
										echo "<td colspan='1' style='text-align: center;'>".$total[$fila][$i]["ESTIMADO"]."</td>";
									}
							//echo "<td colspan='1' style='text-align: center;'>".$total[$fila][$i]["ESTIMADO"]."</td>";					
						}

					echo '<tr>';
						echo "<td colspan='1' style= ''>Total de Cupos con Acto Morbilidad (No Forzados)</td>";
							for($i=0; $i<8;$i++)
						{
							$num = $total2[$fila][$i]["ESTIMADO"];
							$numlength = strlen((string)$num);
							if ($numlength == 4) {
								$numUn= substr($num, 0,-3);
								$numDo= substr($num, 1);
								$fin = $numUn.".".$numDo;
								echo "<td colspan='1' style='text-align: center;'>".$fin."</td>";
							}else
								if ($numlength == 5) {
									$numUno= substr($num, 0,-3);
									$numDos= substr($num, 2);
									$fina = $numUno.".".$numDos;
									echo "<td colspan='1' style='text-align: center;'>".$fina."</td>";
								}else
									{
										echo "<td colspan='1' style='text-align: center;'>".$total2[$fila][$i]["ESTIMADO"]."</td>";
									}
							//echo "<td colspan='1' style='text-align: center;'>".$total2[$fila][$i]["ESTIMADO"]."</td>";
						}
					echo '</tr>';
					echo '<tr>';
						echo "<td colspan='1' style= ''>Total de Cupos Enviados a GDA</td>";
							for($i=0; $i<8;$i++)
						{
							$num = $total3[$fila][$i]["ESTIMADO"];
							$numlength = strlen((string)$num);
							if ($numlength == 4) {
								$numUn= substr($num, 0,-3);
								$numDo= substr($num, 1);
								$fin = $numUn.".".$numDo;
								echo "<td colspan='1' style='text-align: center;'>".$fin."</td>";
							}else
								if ($numlength == 5) {
									$numUno= substr($num, 0,-3);
									$numDos= substr($num, 2);
									$fina = $numUno.".".$numDos;
									echo "<td colspan='1' style='text-align: center;'>".$fina."</td>";
								}else
									{
										echo "<td colspan='1' style='text-align: center;'>".$total3[$fila][$i]["ESTIMADO"]."</td>";
									}
							//echo "<td colspan='1' style='text-align: center;'>".$total3[$fila][$i]["ESTIMADO"]."</td>";

						}
					echo '</tr>';
					$disSem = $disSem + 1;
					$fila++;		
					
				}

				$titulosTotales = array('Programado por d&iacute;a habil elegido','Total de Atenciones Realizadas','Total de Cupos con Acto Morbilidad  (No Forzados)','Total de Cupos Enviados a GDA','% Atendidos / cupos disponibles','% Ofertados por telefono/cupos totales','Atendido/Programado');

				$filas = 0;
				$cont = 1;								
				foreach ($titulosTotales as $titTot) {
					echo "<tr>";
					echo "<td colspan='1'></td>";
					echo "<td colspan='1'></td>";
					if ($cont == 1 || $cont == 7 ) {
						echo "<td colspan='1' style='background: yellow;'>".$titTot."</td>";
					}else{
						echo "<td colspan='1' style = ''>".$titTot."</td>";
					}

					for($i=0; $i<8;$i++){
						if ($cont == 1) {
							$num = $totales[$filas][$i]["CANTIDAD"];
							$numlength = strlen((string)$num);
							if ($numlength == 4) {
								$numUn= substr($num, 0,-3);
								$numDo= substr($num, 1);
								$fin = $numUn.".".$numDo;
								echo "<td colspan='1' style='font-weight: bolder;background: yellow;text-align: center;'>".$fin."</td>";
							}else
								if ($numlength == 5) {
									$numUno= substr($num, 0,-3);
									$numDos= substr($num, 2);
									$fina = $numUno.".".$numDos;
									echo "<td colspan='1' style='font-weight: bolder;background: yellow; text-align: center;'>".$fina."</td>";
								}else
									{
									echo "<td colspan='1' style='font-weight: bolder;background: yellow; text-align: center;'>".$totales[$filas][$i]["CANTIDAD"]."</td>";
									}
						}else
							if ($cont == 7) {
								echo "<td colspan='1' style='font-weight: bolder;background: yellow; text-align: center;'>".$totales[$filas][$i]["CANTIDAD"]." % </td>";
							}else{
								if ($cont == 5  || $cont == 6) {
									echo "<td colspan='1' style = 'text-align: center;'>".$totales[$filas][$i]["CANTIDAD"]."%</td>";
								}else{

								$numeros = $totales[$filas][$i]["CANTIDAD"];
								$largoNum = strlen((string)$numeros);

								if ($largoNum == 4) {
									$numeroUn = substr($numeros, 0,-3);
									$numeroDo = substr($numeros, 1);
									$concat = $numeroUn.".".$numeroDo;
									echo "<td colspan='1' style = 'text-align: center;'>".$concat."</td>";
								}else
									if ($largoNum == 5) {
										$numeroUno = substr($numeros, 0,-3);
										$numeroDos = substr($numeros, 2);
										$concate = $numeroUno.".".$numeroDos;
										echo "<td colspan='1' style = 'text-align: center;'>".$concate."</td>";
									}else{
										echo "<td colspan='1' style = 'text-align: center;'>".$totales[$filas][$i]["CANTIDAD"]."</td>";
									}
								}
							}

					}
					echo "</tr>";

					$cont = $cont +1;
					$filas = $filas+1;
				}


			echo "</table>";
	break;

	default:
		print_r("Error..");
	break;

}
