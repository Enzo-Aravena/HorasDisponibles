<?php
	error_reporting(0);
	require_once ("../../../../lib/conexion/db_tic.php");
	require_once("../../modelo/modelo.php");
	$bd = new Conexion();
	$modelo = new ModeloGRafico();
	$conn = $bd->Conectar();
	$evento = $_REQUEST["evento"];

	switch($evento){
		case "todo":
			if ($_GET['fecha1']==0) {
				$date1 = new DateTime('Today');
					if($date1->format('l') != 'Monday'){	$date1->modify('Last Monday');	}
					$fecha1 = $date1->format('Y-m-d');
					$fecha2 = date("Y-m-d", strtotime("Tomorrow"));
			}else{
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

			if ($semana == 0)
			{
				if ($centro ==0) {
					$modelo->setDesde($fecha1);
					$modelo->setHasta($fecha2);
					$data = $modelo->OBTENER_DATOS_TABLA($conn);
					if ($data == "") {	echo "0";	}else{	echo  json_encode($data);	}
				}else{
					$modelo->setDesde($fecha1);
					$modelo->setHasta($fecha2);
					$modelo->setCentro($centro);
					$data = $modelo->OBTENER_DATOS_POR_DIA($conn);					
					if ($data == "") {	echo "0";	}else{	echo  json_encode($data);}
				}
			}else{
				$arreglo = array();
				for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
					$dia=date("w", strtotime($i));
					if($dia==$semana){	array_push($arreglo,"'".date("Y-m-d",strtotime($i))."'");	}
				}
				if ($centro==0) {
					$modelo->setDesde(implode(',',$arreglo));
					$data = $modelo->OBTENER_VALORES_POR_DIA($conn);
					if ($data == "") {	echo "0";	}else{	echo  json_encode($data);	}
				}else{
					$modelo->setDesde(implode(',',$arreglo));
					$modelo->setCentro($centro);
					$data = $modelo->OBTENER_VALORES_POR_DIA_CENTRO($conn);
					if ($data == "") {	echo "0";	}else{	echo  json_encode($data);	}
				}
			}
		break;

		case "table":
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
					$fecha2 = $fecha1;// date("Y-m-d", strtotime($_GET['fecha1']));
				} else {
					$fes2 = explode("/", $_GET['fecha2']);
					$fecha2 = $fes2[2]."-".$fes2[1]."-".$fes2[0];
				}
			}

			$semana = $_GET['semana'];
			$centro = $_GET['centro'];
			$acto = $_GET['acto'];

			if ($semana == 0) {
				if ($centro == 0) {
					$modelo->setSemana($semana);
					$modelo->setDesde($fecha1);
					$modelo->setHasta($fecha2);
					$data = $modelo->OBTENER_TABLA_TODO($conn);
				}else{
					$modelo->setDesde($fecha1);
					$modelo->setHasta($fecha2);
					$modelo->setCentro($centro);
					// SOO PARA SABER SI ES CUALQUIER DIA DE LA SEMANA
					$modelo->setSemana($semana);
					$data = $modelo->OBTENER_TABLA_CENTRO($conn);
				}
			}else{
				$arr = array();
				for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
					$dia=date("w", strtotime($i));
					if($dia==$semana){	array_push($arr,"'".date("Y-m-d",strtotime($i))."'");	}
				}

				if ($centro == 0) {
					$semana = $_GET['semana'];
					$modelo->setSemana($semana);
					$modelo->setDesde(implode(',',$arr));
					$data = $modelo->OBTENER_TABLA_DIA_TODOCENTRO($conn);
				}else{
					$semana = $_GET['semana'];
					$modelo->setSemana($semana);
					$modelo->setDesde(implode(',',$arr));
					$modelo->setCentro($centro);
					$data = $modelo->OBTENER_TODO_FILTRO($conn);
				}
			}

			if ($acto == 1) {
				if ($data == "") {	echo "0";	}else{	echo  json_encode($data);	}
			}else{
				if ($data == "") {	echo "0";	}else{	echo  json_encode($data);	}
			}
		break;

		case 'graficoMensual':
			$anio = $_GET['anio'];
			$centro = $_GET['centro'];
			$modelo->setDesde($anio);
			$modelo->setCentro($centro);
			$data = $modelo->OBTENER_GRAFICO_MORB_MENSUAL($conn);
			if ($data == "") {	echo "0";	}else{	echo  json_encode($data);	}
		break;

		case 'tablaMensual':
			$anio = $_REQUEST['anio'];
			$dataSanLuis = obtenerSl($anio);
			echo"<br>";
			echo "<table width='2400px'>";
			echo "<tr>";
			echo "<td colspan='2' class='dv-label_titulo' >". $anio ."</td>";
			echo "<td colspan='4' class='dv-label_titulo' >ENERO</td>";
			echo "<td colspan='4' class='dv-label_titulo' >FEBRERO</td>";
			echo "<td colspan='4' class='dv-label_titulo' >MARZO</td>";
			echo "<td colspan='4' class='dv-label_titulo' >ABRIL</td>";
			echo "<td colspan='4' class='dv-label_titulo' >MAYO</td>";
			echo "<td colspan='4' class='dv-label_titulo' >JUNIO</td>";
			echo "<td colspan='4' class='dv-label_titulo' >JULIO</td>";
			echo "<td colspan='4' class='dv-label_titulo' >AGOSTO</td>";
			echo "<td colspan='4' class='dv-label_titulo' >SEPTIEMBRE</td>";
			echo "<td colspan='4' class='dv-label_titulo' >OCTUBRE</td>";
			echo "<td colspan='4' class='dv-label_titulo' >NOVIEMBRE</td>";
			echo "<td colspan='4' class='dv-label_titulo' >DICIEMBRE</td>";
			echo "</tr>";
			
			echo "<tr>";
	    	echo "<td rowspan='3' class='dv-label_titulo'>SAN LUIS" ;
			echo "<td class='dv-label_telefonica'></td>";
			$x=0;
			while($x < 12) {
				echo "<td colspan='2' class='dv-label_telefonica' >LOCAL</td>";
				echo "<td colspan='2' class='dv-label_telefonica' >COMUNAL</td>";
				$x++;
			}
			echo "</tr>";
			echo "<tr>";
			echo "<td class='dv-label_telefonica'>MORBILIDAD TELEFONICA</td>";
			$x=1;

			foreach($dataSanLuis as $clave => $valor)
		 	{
		 		echo "<td class='dv-label_telefonica' >" . $valor["agendados_morbt"] . "</td>";
				echo "<td class='dv-label_telefonica' >" .  $valor['porcentaje_agendados_morbt']."%</td>";
				echo "<td rowspan='2' class='dv-label' >".$valor['total_agendados'] . "</td>";
				echo "<td rowspan='2' class='dv-label' >".$valor['porcentaje_total_agendados_'.$x]."%</td>";
				$x++;
		 	}

			echo "</tr>";
			echo "<tr>";
				echo "<td class='dv-label'>MEDICO MORBILIDAD</td>";
				foreach($dataSanLuis as $clave => $valor)
				{
					echo "<td class='dv-label'>".$valor["agendados_morbi"] . "</td>";
					echo "<td class='dv-label'>".$valor['porcentaje_agendados_morbi']."%</td>";
				}
			echo "</tr>";
			echo "<tr>";
	    	echo "<td rowspan='2' class='dv-label_titulo'>CAROL URZUA" ;
			echo "<td class='dv-label_telefonica'>MORBILIDAD TELEFONICA</td>";
			$x=1;
			$dataCarol = obtenerCU($anio);
			foreach($dataCarol as $clave => $valor)
		 	{
		 		echo "<td class='dv-label_telefonica' >" . $valor["agendados_morbt"] . "</td>";
				echo "<td class='dv-label_telefonica' >" .  $valor['porcentaje_agendados_morbt']."%</td>";
				echo "<td rowspan='2' class='dv-label' >".$valor['total_agendados'] . "</td>";
				echo "<td rowspan='2' class='dv-label' >".$valor['porcentaje_total_agendados_'.$x]."%</td>";
				$x++;
		 	}			    
			echo "</tr>";
			echo "<tr>";
				echo "<td class='dv-label'>MEDICO MORBILIDAD</td>";
				foreach($dataCarol as $clave => $valor)
				{
					echo "<td class='dv-label'>".$valor["agendados_morbi"] . "</td>";
					echo "<td class='dv-label'>".$valor['porcentaje_agendados_morbi']."%</td>";
				}
			echo "</tr>";
			
			echo "<tr>";
				echo "<td rowspan='2' class='dv-label_titulo'>LA FAENA" ;
				echo "<td class='dv-label_telefonica'>MORBILIDAD TELEFONICA</td>";
				$x=1;
				$dataLf = obtenerLF($anio);
				foreach($dataLf as $clave => $valor)
				{
					echo "<td class='dv-label_telefonica' >" . $valor["agendados_morbt"] . "</td>";
					echo "<td class='dv-label_telefonica' >" .  $valor['porcentaje_agendados_morbt']."%</td>";
					echo "<td rowspan='2' class='dv-label' >".$valor['total_agendados'] . "</td>";
					echo "<td rowspan='2' class='dv-label' >".$valor['porcentaje_total_agendados_'.$x]."%</td>";
					$x++;
				}	
			echo "</tr>";

			echo "<tr>";
			echo "<td class='dv-label'>MEDICO MORBILIDAD</td>";
				foreach($dataLf as $clave => $valor)
			 	{
			 		echo "<td class='dv-label'>".$valor["agendados_morbi"] . "</td>";
					echo "<td class='dv-label'>".$valor['porcentaje_agendados_morbi']."%</td>";
			 	}
			echo "</tr>";
			
			echo "<tr>";
				echo "<td rowspan='2' class='dv-label_titulo'>LO HERMIDA" ;
				echo "<td class='dv-label_telefonica'>MORBILIDAD TELEFONICA</td>";
				$x=1;
				$dataLh = obtenerLH($anio);
				foreach($dataLh as $clave => $valor)
				{
					echo "<td class='dv-label_telefonica' >" . $valor["agendados_morbt"] . "</td>";
					echo "<td class='dv-label_telefonica' >" .  $valor['porcentaje_agendados_morbt']."%</td>";
					echo "<td rowspan='2' class='dv-label' >".$valor['total_agendados'] . "</td>";
					echo "<td rowspan='2' class='dv-label' >".$valor['porcentaje_total_agendados_'.$x]."%</td>";
					$x++;
				}
			echo "</tr>";

			echo "<tr>";
				echo "<td class='dv-label'>MEDICO MORBILIDAD</td>";
				foreach($dataLh as $clave => $valor)
			 	{
			 		echo "<td class='dv-label'>".$valor["agendados_morbi"] . "</td>";
					echo "<td class='dv-label'>".$valor['porcentaje_agendados_morbi']."%</td>";
			 	}
			echo "</tr>";
			
			echo "<tr>";
				echo "<td rowspan='2' class='dv-label_titulo'>CARDENAL SILVA.H" ;
				echo "<td class='dv-label_telefonica'>MORBILIDAD TELEFONICA</td>";
				$x=1;
				$dataCsh = obtenerCSH($anio);
				foreach($dataCsh as $clave => $valor)
				{
					echo "<td class='dv-label_telefonica' >" . $valor["agendados_morbt"] . "</td>";
					echo "<td class='dv-label_telefonica' >" .  $valor['porcentaje_agendados_morbt']."%</td>";
					echo "<td rowspan='2' class='dv-label' >".$valor['total_agendados'] . "</td>";
					echo "<td rowspan='2' class='dv-label' >".$valor['porcentaje_total_agendados_'.$x]."%</td>";
					$x++;
				}
			echo "</tr>";

			echo "<tr>";
				echo "<td class='dv-label'>MEDICO MORBILIDAD</td>";
				foreach($dataCsh as $clave => $valor)
				{
					echo "<td class='dv-label'>".$valor["agendados_morbi"] . "</td>";
					echo "<td class='dv-label'>".$valor['porcentaje_agendados_morbi']."%</td>";
				}
			echo "</tr>";
			
			echo "<tr>";
				echo "<td rowspan='2' class='dv-label_titulo'>PADRE GERARDO.W" ;
				echo "<td class='dv-label_telefonica'>MORBILIDAD TELEFONICA</td>";
				$x=1;
				$dataPgw = obtenerPGW($anio);
				foreach($dataPgw as $clave => $valor)
				{
					echo "<td class='dv-label_telefonica' >" . $valor["agendados_morbt"] . "</td>";
					echo "<td class='dv-label_telefonica' >" .  $valor['porcentaje_agendados_morbt']."%</td>";
					echo "<td rowspan='2' class='dv-label' >".$valor['total_agendados'] . "</td>";
					echo "<td rowspan='2' class='dv-label' >".$valor['porcentaje_total_agendados_'.$x]."%</td>";
					$x++;
				}					    
			echo "</tr>";

			echo "<tr>";
				echo "<td class='dv-label'>MEDICO MORBILIDAD</td>";
				foreach($dataPgw as $clave => $valor)
				{
					echo "<td class='dv-label'>".$valor["agendados_morbi"] . "</td>";
					echo "<td class='dv-label'>".$valor['porcentaje_agendados_morbi']."%</td>";
				}
			echo "</tr>";

			echo "<tr>";
				echo "<td rowspan='2' class='dv-label_titulo'>LAS TORRES" ;
				echo "<td class='dv-label_telefonica'>MORBILIDAD TELEFONICA</td>";
				$x=1;
				$dataLasTorres = obtenerLasTorres($anio);
				foreach($dataLasTorres as $clave => $valor)
				{
					echo "<td class='dv-label_telefonica' >" . $valor["agendados_morbt"] . "</td>";
					echo "<td class='dv-label_telefonica' >" .  $valor['porcentaje_agendados_morbt']."%</td>";
					echo "<td rowspan='2' class='dv-label' >".$valor['total_agendados'] . "</td>";
					echo "<td rowspan='2' class='dv-label' >".$valor['porcentaje_total_agendados_'.$x]."%</td>";
					$x++;
				}					    
			echo "</tr>";

			echo "<tr>";
				echo "<td class='dv-label'>MEDICO MORBILIDAD</td>";
				foreach($dataLasTorres as $clave => $valor)
				{
					echo "<td class='dv-label'>".$valor["agendados_morbi"] . "</td>";
					echo "<td class='dv-label'>".$valor['porcentaje_agendados_morbi']."%</td>";
				}
			echo "</tr>";

			/// FIN CENTRO NUEVO

			

			echo "<tr>";
		    	echo "<td rowspan='2' class='dv-label_titulo'>TOTAL GENERAL" ;
				echo "<td class='dv-label_telefonica'>MORBILIDAD TELEFONICA</td>";
			 	$x=1;
				$dataSiete = obtenerSIETE($anio);
				foreach($dataSiete as $clave => $valor)
				{
					echo "<td class='dv-label_telefonica' >" . $valor["agendados_morbt"] . "</td>";
					echo "<td class='dv-label_telefonica' >" .  $valor['porcentaje_agendados_morbt']."%</td>";
					echo "<td rowspan='2' class='dv-label' >".$valor['total_agendados'] . "</td>";
					echo "<td rowspan='2' class='dv-label' >".$valor['porcentaje_total_agendados_'.$x]."%</td>";
					$x++;
				}
			echo "</tr>";

			echo "<tr>";
				echo "<td class='dv-label'>MEDICO MORBILIDAD</td>";
				foreach($dataSiete as $clave => $valor)
			 	{
			 		echo "<td class='dv-label'>".$valor["agendados_morbi"] . "</td>";
					echo "<td class='dv-label'>".$valor['porcentaje_agendados_morbi']."%</td>";
			 	}
			echo "</tr>";
			
			echo "</table>";
		break;

		case 'graficoOcupMorb':
			$centro = $_REQUEST['centro'];
			$semestre = $_REQUEST['semestre'];
			$semana = $_REQUEST['semana'];
			$mes = $_REQUEST['mes'];
			$anio = $_REQUEST['anio'];

			if($semestre!=0){
					if($semestre==1){
						$idsemana1 = 1;
						$idsemana2 = 26;
					}else{
						$idsemana1 = 27;
						$idsemana2 = 52;
					}
			}else
				if($mes!=0){
					switch($mes) {
						case 1:
							$idsemana1 = 1;
							$idsemana2 = 5;
						break;
						case 2:
							$idsemana1 = 6;
							$idsemana2 = 9;
						break;
						case 3:
							$idsemana1 = 10;
							$idsemana2 = 13;
						break;
						case 4:
							$idsemana1 = 14;
							$idsemana2 = 17;
						break;
						case 5:
							$idsemana1 = 18;
							$idsemana2 = 22;
						break;
						case 6:
							$idsemana1 = 23;
							$idsemana2 = 26;
						break;
						case 7:
							$idsemana1 = 27;
							$idsemana2 = 31;
						break;
						case 8:
							$idsemana1 = 32;
							$idsemana2 = 35;
						break;
						case 9:
							$idsemana1 = 36;
							$idsemana2 = 39;
						break;
						case 10:
							$idsemana1 = 40;
							$idsemana2 = 44;
						break;
						case 11:
							$idsemana1 = 45;
							$idsemana2 = 48;
						break;
						case 12:
							$idsemana1 = 49;
							$idsemana2 = 52;
						break;
					}
				}else{
					$idsemana1 = $semana;
					$idsemana2 = $semana;
				}
		
			if ($centro ==0) {
				$modelo->setAnio($anio);
				$modelo->setDesde($idsemana1);
				$modelo->setHasta($idsemana2);
				$data = $modelo->OBTENER_REPORTE_GRAFICO_OCMOB_UNO($conn);
				echo json_encode($data);
			}else{
				$modelo->setAnio($anio);
				$modelo->setDesde($idsemana1);
				$modelo->setHasta($idsemana2);
				$modelo->setCentro($centro);
				$data = $modelo->OBTENER_REPORTE_GRAFICO_OCMOB_DOS($conn);
				echo json_encode($data);
			}
		break;

		case 'tablaOcupMorb':
			$centro = $_REQUEST['centro'];
			$semestre = $_REQUEST['semestre'];
			$semana = $_REQUEST['semana'];
			$mes = $_REQUEST['mes'];
			$anio = $_REQUEST['anio'];

			if($semestre!=0){
				if($semestre==1){
					$idsemana1 = 1;
					$idsemana2 = 26;
				}else{
					$idsemana1 = 27;
					$idsemana2 = 52;
				}
			}else 
				if($mes!=0){
					switch($mes) {
						case 1:
							$idsemana1 = 1;
							$idsemana2 = 5;
						break;

						case 2:
							$idsemana1 = 6;
							$idsemana2 = 9;
						break;

						case 3:
							$idsemana1 = 10;
							$idsemana2 = 13;
						break;

						case 4:
							$idsemana1 = 14;
							$idsemana2 = 17;
						break;

						case 5:
							$idsemana1 = 18;
							$idsemana2 = 22;
						break;

						case 6:
							$idsemana1 = 23;
							$idsemana2 = 26;
						break;

						case 7:
							$idsemana1 = 27;
							$idsemana2 = 31;
						break;

						case 8:
							$idsemana1 = 32;
							$idsemana2 = 35;
						break;

						case 9:
							$idsemana1 = 36;
							$idsemana2 = 39;
						break;

						case 10:
							$idsemana1 = 40;
							$idsemana2 = 44;
						break;

						case 11:
							$idsemana1 = 45;
							$idsemana2 = 48;
						break;

						case 12:
							$idsemana1 = 49;
							$idsemana2 = 52;
						break;
					}
				}else{
					$idsemana1 = $semana;
					$idsemana2 = $semana;
				}
			if ($centro ==0){
				$modelo->setAnio($anio);
				$modelo->setCentro($centro);
				$modelo->setDesde($idsemana1);
				$modelo->setHasta($idsemana2);				
				$data = $modelo->OBTENER_REPORTE_TABLA_OCMOB_UNO($conn);
				echo json_encode($data);
			}else{
				$modelo->setAnio($anio);
				$modelo->setDesde($idsemana1);
				$modelo->setHasta($idsemana2);
				$modelo->setCentro($centro);
				$data = $modelo->OBTENER_REPORTE_TABLA_OCMOB_DOS($conn);
				echo json_encode($data);
			}
		break;

		default:
		print("Error");
		break;
	}



/************ METODOS QUE VAN AL MODELO A EXTRAER LOS ARRAYS PARA PREPARA LAS CONSULTAS ***********/
	function obtenerSl($anio){
		$bd = new Conexion();
		$modelo = new ModeloGRafico();
		$conn = $bd->Conectar();
		$i=0;
		$dataSl = Array();
		$sql="CALL TABLA_MORB_QUERY_UNO_SL(".$anio.")";
		$resultado = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$dataSl = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {	
				$dataSl[$i] = Array(
					"data"				   			=>"1",
					"centro"						=> $fila[0],
					"anho"							=> $fila[1],
					"agendados_morbt"				=> $fila[2],
					"agendados_morbi"				=> $fila[3],
					"total_agendados"				=> $fila[4],
					"porcentaje_agendados_morbt"	=> $fila[5],
					"porcentaje_agendados_morbi"	=> $fila[6],
					"porcentaje_total_agendados_1"	=> $fila[7],
					"porcentaje_total_agendados_2"	=> $fila[8],
					"porcentaje_total_agendados_3"	=> $fila[9],
					"porcentaje_total_agendados_4"	=> $fila[10],
					"porcentaje_total_agendados_5"	=> $fila[11],
					"porcentaje_total_agendados_6"	=> $fila[12],
					"porcentaje_total_agendados_7"	=> $fila[13],
					"porcentaje_total_agendados_8"	=> $fila[14],
					"porcentaje_total_agendados_9"	=> $fila[15],
					"porcentaje_total_agendados_10"	=> $fila[16],
					"porcentaje_total_agendados_11"	=> $fila[17],
					"porcentaje_total_agendados_12"	=> $fila[18]
				);
			  $i++;
			}//end while
		}//fin else
		return $dataSl;
	}

	function obtenerCU($anio){
		$bd = new Conexion();
		$modelo = new ModeloGRafico();
		$conn = $bd->Conectar();
		$i=0;
		$dataCu = Array();
		$sql="CALL TABLA_MORB_QUERY_DOS_CU(".$anio.")";
		$resultado = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$dataCu = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {	
				$dataCu[$i] = Array(
					"data"				   			=>"1",
					"centro"						=> $fila[0],
					"anho"							=> $fila[1],
					"agendados_morbt"				=> $fila[2],
					"agendados_morbi"				=> $fila[3],
					"total_agendados"				=> $fila[4],
					"porcentaje_agendados_morbt"	=> $fila[5],
					"porcentaje_agendados_morbi"	=> $fila[6],
					"porcentaje_total_agendados_1"	=> $fila[7],
					"porcentaje_total_agendados_2"	=> $fila[8],
					"porcentaje_total_agendados_3"	=> $fila[9],
					"porcentaje_total_agendados_4"	=> $fila[10],
					"porcentaje_total_agendados_5"	=> $fila[11],
					"porcentaje_total_agendados_6"	=> $fila[12],
					"porcentaje_total_agendados_7"	=> $fila[13],
					"porcentaje_total_agendados_8"	=> $fila[14],
					"porcentaje_total_agendados_9"	=> $fila[15],
					"porcentaje_total_agendados_10"	=> $fila[16],
					"porcentaje_total_agendados_11"	=> $fila[17],
					"porcentaje_total_agendados_12"	=> $fila[18]
				);
			  $i++;
			}//end while
		}//fin else
		return $dataCu;
	}


	function obtenerLF($anio){
		$bd = new Conexion();
		$modelo = new ModeloGRafico();
		$conn = $bd->Conectar();
		$i=0;
		$dataLf = Array();
		$sql="CALL TABLA_MORB_QUERY_TRES_LF(".$anio.")";
		$resultado = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$dataLf = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {	
				$dataLf[$i] = Array(
					"data"				   			=>"1",
					"centro"						=> $fila[0],
					"anho"							=> $fila[1],
					"agendados_morbt"				=> $fila[2],
					"agendados_morbi"				=> $fila[3],
					"total_agendados"				=> $fila[4],
					"porcentaje_agendados_morbt"	=> $fila[5],
					"porcentaje_agendados_morbi"	=> $fila[6],
					"porcentaje_total_agendados_1"	=> $fila[7],
					"porcentaje_total_agendados_2"	=> $fila[8],
					"porcentaje_total_agendados_3"	=> $fila[9],
					"porcentaje_total_agendados_4"	=> $fila[10],
					"porcentaje_total_agendados_5"	=> $fila[11],
					"porcentaje_total_agendados_6"	=> $fila[12],
					"porcentaje_total_agendados_7"	=> $fila[13],
					"porcentaje_total_agendados_8"	=> $fila[14],
					"porcentaje_total_agendados_9"	=> $fila[15],
					"porcentaje_total_agendados_10"	=> $fila[16],
					"porcentaje_total_agendados_11"	=> $fila[17],
					"porcentaje_total_agendados_12"	=> $fila[18]
				);
			  $i++;
			}//end while
		}//fin else
		return $dataLf;
	}

	function obtenerLH($anio){
		$bd = new Conexion();
		$modelo = new ModeloGRafico();
		$conn = $bd->Conectar();
		$i=0;
		$dataLh = Array();
		$sql="CALL TABLA_MORB_QUERY_CUATRO_LH(".$anio.")";
		$resultado = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$dataLh = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {	
				$dataLh[$i] = Array(
					"data"				   			=>"1",
					"centro"						=> $fila[0],
					"anho"							=> $fila[1],
					"agendados_morbt"				=> $fila[2],
					"agendados_morbi"				=> $fila[3],
					"total_agendados"				=> $fila[4],
					"porcentaje_agendados_morbt"	=> $fila[5],
					"porcentaje_agendados_morbi"	=> $fila[6],
					"porcentaje_total_agendados_1"	=> $fila[7],
					"porcentaje_total_agendados_2"	=> $fila[8],
					"porcentaje_total_agendados_3"	=> $fila[9],
					"porcentaje_total_agendados_4"	=> $fila[10],
					"porcentaje_total_agendados_5"	=> $fila[11],
					"porcentaje_total_agendados_6"	=> $fila[12],
					"porcentaje_total_agendados_7"	=> $fila[13],
					"porcentaje_total_agendados_8"	=> $fila[14],
					"porcentaje_total_agendados_9"	=> $fila[15],
					"porcentaje_total_agendados_10"	=> $fila[16],
					"porcentaje_total_agendados_11"	=> $fila[17],
					"porcentaje_total_agendados_12"	=> $fila[18]
				);
			  $i++;
			}//end while
		}//fin else

		return $dataLh;
	}

	function obtenerCSH($anio){
		$bd = new Conexion();
		$modelo = new ModeloGRafico();
		$conn = $bd->Conectar();

		$i=0;
		$dataCsh = Array();
		$sql="CALL TABLA_MORB_QUERY_CINCO_CSH(".$anio.")";
		$resultado = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$dataCsh = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {	
				$dataCsh[$i] = Array(
					"data"				   			=>"1",
					"centro"						=> $fila[0],
					"anho"							=> $fila[1],
					"agendados_morbt"				=> $fila[2],
					"agendados_morbi"				=> $fila[3],
					"total_agendados"				=> $fila[4],
					"porcentaje_agendados_morbt"	=> $fila[5],
					"porcentaje_agendados_morbi"	=> $fila[6],
					"porcentaje_total_agendados_1"	=> $fila[7],
					"porcentaje_total_agendados_2"	=> $fila[8],
					"porcentaje_total_agendados_3"	=> $fila[9],
					"porcentaje_total_agendados_4"	=> $fila[10],
					"porcentaje_total_agendados_5"	=> $fila[11],
					"porcentaje_total_agendados_6"	=> $fila[12],
					"porcentaje_total_agendados_7"	=> $fila[13],
					"porcentaje_total_agendados_8"	=> $fila[14],
					"porcentaje_total_agendados_9"	=> $fila[15],
					"porcentaje_total_agendados_10"	=> $fila[16],
					"porcentaje_total_agendados_11"	=> $fila[17],
					"porcentaje_total_agendados_12"	=> $fila[18]
				);
			  $i++;
			}//end while
		}//fin else

		return $dataCsh;
	}

	function obtenerPGW($anio){
		$bd = new Conexion();
		$modelo = new ModeloGRafico();
		$conn = $bd->Conectar();

		$i=0;
		$dataPgw = Array();
		$sql="CALL TABLA_MORB_QUERY_SEIS_PGW(".$anio.")";
		$resultado = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$dataPgw = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {	
				$dataPgw[$i] = Array(
					"data"				   			=>"1",
					"centro"						=> $fila[0],
					"anho"							=> $fila[1],
					"agendados_morbt"				=> $fila[2],
					"agendados_morbi"				=> $fila[3],
					"total_agendados"				=> $fila[4],
					"porcentaje_agendados_morbt"	=> $fila[5],
					"porcentaje_agendados_morbi"	=> $fila[6],
					"porcentaje_total_agendados_1"	=> $fila[7],
					"porcentaje_total_agendados_2"	=> $fila[8],
					"porcentaje_total_agendados_3"	=> $fila[9],
					"porcentaje_total_agendados_4"	=> $fila[10],
					"porcentaje_total_agendados_5"	=> $fila[11],
					"porcentaje_total_agendados_6"	=> $fila[12],
					"porcentaje_total_agendados_7"	=> $fila[13],
					"porcentaje_total_agendados_8"	=> $fila[14],
					"porcentaje_total_agendados_9"	=> $fila[15],
					"porcentaje_total_agendados_10"	=> $fila[16],
					"porcentaje_total_agendados_11"	=> $fila[17],
					"porcentaje_total_agendados_12"	=> $fila[18]
				);
			  $i++;
			}//end while
		}//fin else

		return $dataPgw;
	}


	function obtenerLasTorres($anio){
		$bd = new Conexion();
		$modelo = new ModeloGRafico();
		$conn = $bd->Conectar();

		$i=0;
		$dataLt = Array();
		$sql="CALL TABLA_MORB_QUERY_SEIS_LASTORRES(".$anio.")";
		$resultado = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$dataLt[$i] = array(
				"data" =>"0",
				"centro"						=> "0",
				"anho"							=> "0",
				"agendados_morbt"				=> "0",
				"agendados_morbi"				=> "0",
				"total_agendados"				=> "0",
				"porcentaje_agendados_morbt"	=> "0",
				"porcentaje_agendados_morbi"	=> "0",
				"porcentaje_total_agendados_1"	=> "0",
				"porcentaje_total_agendados_2"	=> "0",
				"porcentaje_total_agendados_3"	=> "0",
				"porcentaje_total_agendados_4"	=> "0",
				"porcentaje_total_agendados_5"	=> "0",
				"porcentaje_total_agendados_6"	=> "0",
				"porcentaje_total_agendados_7"	=> "0",
				"porcentaje_total_agendados_8"	=> "0",
				"porcentaje_total_agendados_9"	=> "0",
				"porcentaje_total_agendados_10"	=> "0",
				"porcentaje_total_agendados_11"	=> "0",
				"porcentaje_total_agendados_12"	=> "0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {	
				$dataLt[$i] = Array(
					"data"				   			=>"1",
					"centro"						=> $fila[0],
					"anho"							=> $fila[1],
					"agendados_morbt"				=> $fila[2],
					"agendados_morbi"				=> $fila[3],
					"total_agendados"				=> $fila[4],
					"porcentaje_agendados_morbt"	=> $fila[5],
					"porcentaje_agendados_morbi"	=> $fila[6],
					"porcentaje_total_agendados_1"	=> $fila[7],
					"porcentaje_total_agendados_2"	=> $fila[8],
					"porcentaje_total_agendados_3"	=> $fila[9],
					"porcentaje_total_agendados_4"	=> $fila[10],
					"porcentaje_total_agendados_5"	=> $fila[11],
					"porcentaje_total_agendados_6"	=> $fila[12],
					"porcentaje_total_agendados_7"	=> $fila[13],
					"porcentaje_total_agendados_8"	=> $fila[14],
					"porcentaje_total_agendados_9"	=> $fila[15],
					"porcentaje_total_agendados_10"	=> $fila[16],
					"porcentaje_total_agendados_11"	=> $fila[17],
					"porcentaje_total_agendados_12"	=> $fila[18]
				);
			  $i++;
			}//end while
		}//fin else

		return $dataLt;
	}

	function obtenerSIETE($anio){
		$bd = new Conexion();
		$modelo = new ModeloGRafico();
		$conn = $bd->Conectar();
		$i=0;
		$dataSete = Array();
		$sql="CALL TABLA_MORB_QUERY_SIETE(".$anio.")";
		$resultado = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$dataSete = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {	
				$dataSete[$i] = Array(
					"data"				   			=>"1",
					"centro"						=> $fila[0],
					"anho"							=> $fila[1],
					"agendados_morbt"				=> $fila[2],
					"agendados_morbi"				=> $fila[3],
					"total_agendados"				=> $fila[4],
					"porcentaje_agendados_morbt"	=> $fila[5],
					"porcentaje_agendados_morbi"	=> $fila[6],
					"porcentaje_total_agendados_1"	=> $fila[7],
					"porcentaje_total_agendados_2"	=> $fila[8],
					"porcentaje_total_agendados_3"	=> $fila[9],
					"porcentaje_total_agendados_4"	=> $fila[10],
					"porcentaje_total_agendados_5"	=> $fila[11],
					"porcentaje_total_agendados_6"	=> $fila[12],
					"porcentaje_total_agendados_7"	=> $fila[13],
					"porcentaje_total_agendados_8"	=> $fila[14],
					"porcentaje_total_agendados_9"	=> $fila[15],
					"porcentaje_total_agendados_10"	=> $fila[16],
					"porcentaje_total_agendados_11"	=> $fila[17],
					"porcentaje_total_agendados_12"	=> $fila[18]
				);
			  $i++;
			}//end while
		}//fin else
		return $dataSete;
	}


?> 
