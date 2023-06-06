<?php

class claseCampana
{
	
	
	private $anio;
	private $centro;
	private $semana;
	private $desde;
	private $hasta;
	private $dia;


	public function getAnio(){
		return $this->anio;
	}

	public function setAnio($anio){
		$this->anio = $anio;
	}

	public function getCentro(){
		return $this->centro;
	}

	public function setCentro($centro){
		$this->centro = $centro;
	}

	public function getSemana(){
		return $this->semana;
	}

	public function setSemana($semana){
		$this->semana = $semana;
	}

	public function getDesde(){
		return $this->desde;
	}

	public function setDesde($desde){
		$this->desde = $desde;
	}

	public function getHasta(){
		return $this->hasta;
	}

	public function setHasta($hasta){
		$this->hasta = $hasta;
	}


	public function getDia(){
		return $this->dia;
	}

	public function setDia($dia){
		$this->dia = $dia;
	}

	public function OBTENER_SEMANAS_EPIDEMIOLOGICA($bd){
		$i = 0;
		$data = Array();
		$sql= "call OBTENER_SEMANAS_EPIDEMIOLOGICA(2023)";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i]= Array(
					"data" => "1",
					"SEMANA_EPI" => utf8_encode($fila[0]),
					"SEMANA" => utf8_encode($fila[1]),
					"SEMANA_I" => utf8_encode($fila[2]),
					"SEMANA_F" => utf8_encode($fila[3])
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}

	public function OBTENER_SEMANA_EPIDEMIOLOGICA($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT (SELECT DATE_FORMAT(SE.FECHA, '%d-%m-%Y') FROM semana_epidemiologica SE where
		SE.SEMANA_EPI IN ({$this->getSemana()}) and ANNO = 2023 ORDER BY SE.FECHA ASC LIMIT 1) as 
		'FECHA',(SELECT DATE_FORMAT(SE.FECHA_FINAL_EPI, '%d-%m-%Y')
		FROM semana_epidemiologica SE where SE.SEMANA_EPI IN ({$this->getSemana()}) and ANNO = 2023 
		ORDER BY SE.FECHA DESC LIMIT 1) as 'FECHA_FINAL_EPI'";

		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i]= Array(
					"data" => "1",
					"FECHA" => utf8_encode($fila[0]),
					"FECHA_FINAL_EPI" => utf8_encode($fila[1])
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}

/**********************************************************************/

	function OBTENER_MORBILIDAD_INVIERNO_GRAFICO($bd){
		$i = 0;
		$data = Array();

		$sem = $this->getSemana();

		if ($sem == "0") {
			//call db_pagina_rc.OBTENER_MORBILIDAD_INVIERNO_GRAFICO_UNO(0,null,0);
			$sql = "CALL OBTENER_MORBILIDAD_INVIERNO_GRAFICO({$this->getCentro()}, NULL, {$this->getDia()})";
			//$sql = "call db_pagina_rc.OBTENER_MORBILIDAD_INVIERNO_GRAFICO(0, NULL, 0)";
		}else{
			$sql = "CALL OBTENER_MORBILIDAD_INVIERNO_GRAFICO({$this->getCentro()}, '{$this->getSemana()}', {$this->getDia()})";
		}
		$resultado = mysqli_query($bd,$sql);
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
		return $data;
	}

	function OBTENER_MORBILIDAD_INVIERNO_TABLA($bd){
		$i=0;
		$data = Array();

		$semana = $this->getSemana();

		if($semana == "0"){
			$sql = "CALL OBTENER_MORBILIDAD_INVIERNO_TABLA({$this->getCentro()},NULL)";			
		}else{
			$sql = "CALL OBTENER_MORBILIDAD_INVIERNO_TABLA({$this->getCentro()},'{$this->getSemana()}')";
		}
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i] = array(
					"data" => "1",
					"CENTRO" =>$fila[0],
					"1_1" =>$fila[1],
					"1_2" =>$fila[2],
					"1_3" =>$fila[3],
					"1_4" =>$fila[4],
					"1_5" =>$fila[5],
					"1_6" =>$fila[6],
					"2_1" =>$fila[7],
					"2_2" =>$fila[8],
					"2_3" =>$fila[9],
					"2_4" =>$fila[10],
					"2_5" =>$fila[11],
					"2_6" =>$fila[12],
					"3_1" =>$fila[13],
					"3_2" =>$fila[14],
					"3_3" =>$fila[15],
					"3_4" =>$fila[16],
					"3_5" =>$fila[17],
					"3_6" =>$fila[18],
					"4_1" =>$fila[19],
					"4_2" =>$fila[20],
					"4_3" =>$fila[21],
					"4_4" =>$fila[22],
					"4_5" =>$fila[23],
					"4_6" =>$fila[24],
					"5_1" =>$fila[25],
					"5_2" =>$fila[26],
					"5_3" =>$fila[27],
					"5_4" =>$fila[28],
					"5_5" =>$fila[29],
					"5_6" =>$fila[30],
					"6_1" =>$fila[31],
					"6_2" =>$fila[32],
					"6_3" =>$fila[33],
					"6_4" =>$fila[34],
					"6_5" =>$fila[35],
					"6_6" =>$fila[36],
					"7_1" =>$fila[37],
					"7_2" =>$fila[38],
					"7_3" =>$fila[39],
					"7_4" =>$fila[40],
					"7_5" =>$fila[41],
					"7_6" =>$fila[42],
					"8_1" =>$fila[43],
					"8_2" =>$fila[44],
					"8_3" =>$fila[45],
					"8_4" =>$fila[46],
					"8_5" =>$fila[47],
					"8_6" =>$fila[48],
					"9_1" =>$fila[49],
					"9_2" =>$fila[50],
					"9_3" =>$fila[51],
					"9_4" =>$fila[52],
					"9_5" =>$fila[53],
					"9_6" =>$fila[54],
					"10_1" =>$fila[55],
					"10_2" =>$fila[56],
					"10_3" =>$fila[57],
					"10_4" =>$fila[58],
					"10_5" =>$fila[59],
					"10_6" =>$fila[60],
					"11_1" =>$fila[61],
					"11_2" =>$fila[62],
					"11_3" =>$fila[63],
					"11_4" =>$fila[64],
					"11_5" =>$fila[65],
					"11_6" =>$fila[66]					
				);
			  $i++;
			}//end while
		}//fin else
		return $data;
	}

	function OBTENER_MORBILIDAD_INVIERNO_TABLA_UPDATE($bd){
		$i=0;
		$data = Array();
		$sql="CALL OBTENER_MORBILIDAD_INVIERNO_TABLA_UPDATE({$this->getCentro()},'{$this->getDesde()}','{$this->getHasta()}')";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i] = array(
					"data" => "1",
					"CENTRO" =>$fila[0],
					"1_1" =>$fila[1],
					"1_2" =>$fila[2],
					"1_3" =>$fila[3],
					"1_4" =>$fila[4],
					"1_5" =>$fila[5],
					"1_6" =>$fila[6],
					"2_1" =>$fila[7],
					"2_2" =>$fila[8],
					"2_3" =>$fila[9],
					"2_4" =>$fila[10],
					"2_5" =>$fila[11],
					"2_6" =>$fila[12],
					"3_1" =>$fila[13],
					"3_2" =>$fila[14],
					"3_3" =>$fila[15],
					"3_4" =>$fila[16],
					"3_5" =>$fila[17],
					"3_6" =>$fila[18],
					"4_1" =>$fila[19],
					"4_2" =>$fila[20],
					"4_3" =>$fila[21],
					"4_4" =>$fila[22],
					"4_5" =>$fila[23],
					"4_6" =>$fila[24],
					"5_1" =>$fila[25],
					"5_2" =>$fila[26],
					"5_3" =>$fila[27],
					"5_4" =>$fila[28],
					"5_5" =>$fila[29],
					"5_6" =>$fila[30],
					"6_1" =>$fila[31],
					"6_2" =>$fila[32],
					"6_3" =>$fila[33],
					"6_4" =>$fila[34],
					"6_5" =>$fila[35],
					"6_6" =>$fila[36],
					"7_1" =>$fila[37],
					"7_2" =>$fila[38],
					"7_3" =>$fila[39],
					"7_4" =>$fila[40],
					"7_5" =>$fila[41],
					"7_6" =>$fila[42],
					"8_1" =>$fila[43],
					"8_2" =>$fila[44],
					"8_3" =>$fila[45],
					"8_4" =>$fila[46],
					"8_5" =>$fila[47],
					"8_6" =>$fila[48],
					"9_1" =>$fila[49],
					"9_2" =>$fila[50],
					"9_3" =>$fila[51],
					"9_4" =>$fila[52],
					"9_5" =>$fila[53],
					"9_6" =>$fila[54],
					"10_1" =>$fila[55],
					"10_2" =>$fila[56],
					"10_3" =>$fila[57],
					"10_4" =>$fila[58],
					"10_5" =>$fila[59],
					"10_6" =>$fila[60],
					"11_1" =>$fila[61],
					"11_2" =>$fila[62],
					"11_3" =>$fila[63],
					"11_4" =>$fila[64],
					"11_5" =>$fila[65],
					"11_6" =>$fila[66]					
				);
		  $i++;
		}//end while
		}//fin else
		return $data;
	}

	function OBTENER_MORBILIDAD_INVIERNO_TABLA_EXPORT($bd){
		$i=0;
		$data = Array();

		$centro = $this->getCentro();
		$Semana = $this->getSemana();
		$Desde = $this->getDesde();
		$Hasta = $this->getHasta();		

		if ($Semana == "NULL" && $Desde == "NULL" && $Hasta == "NULL") {
			$sql = "CALL OBTENER_MORBILIDAD_INVIERNO_TABLA_EXPORT({$this->getCentro()},NULL,NULL,NULL)";
			//$sql = "1";
		}else
			if ($Semana !== "NULL" && $Desde == "NULL" && $Hasta == "NULL") {
				$sql = "CALL OBTENER_MORBILIDAD_INVIERNO_TABLA_EXPORT({$this->getCentro()},'{$this->getSemana()}',NULL,NULL)";
				//$sql = "2";
			}else
				if ($Semana == "NULL" && $Desde !== "NULL" && $Hasta !== "NULL") {
					//$sql = "3";
					$sql = "CALL OBTENER_MORBILIDAD_INVIERNO_TABLA_EXPORT({$this->getCentro()},{$this->getSemana()},'{$this->getDesde()}','{$this->getHasta()}')";
				}else
				{
				$sql = "CALL OBTENER_MORBILIDAD_INVIERNO_TABLA_EXPORT({$this->getCentro()},'{$this->getSemana()}','{$this->getDesde()}','{$this->getHasta()}')";
				//$sql = "4";
				}

		//return $sql;		

		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i] = array(
					"data" => "1",
					"CENTRO" =>$fila[0],
					"1_1" =>$fila[1],
					"1_2" =>$fila[2],
					"1_3" =>$fila[3],
					"1_4" =>$fila[4],
					"1_5" =>$fila[5],
					"1_6" =>$fila[6],
					"2_1" =>$fila[7],
					"2_2" =>$fila[8],
					"2_3" =>$fila[9],
					"2_4" =>$fila[10],
					"2_5" =>$fila[11],
					"2_6" =>$fila[12],
					"3_1" =>$fila[13],
					"3_2" =>$fila[14],
					"3_3" =>$fila[15],
					"3_4" =>$fila[16],
					"3_5" =>$fila[17],
					"3_6" =>$fila[18],
					"4_1" =>$fila[19],
					"4_2" =>$fila[20],
					"4_3" =>$fila[21],
					"4_4" =>$fila[22],
					"4_5" =>$fila[23],
					"4_6" =>$fila[24],
					"5_1" =>$fila[25],
					"5_2" =>$fila[26],
					"5_3" =>$fila[27],
					"5_4" =>$fila[28],
					"5_5" =>$fila[29],
					"5_6" =>$fila[30],
					"6_1" =>$fila[31],
					"6_2" =>$fila[32],
					"6_3" =>$fila[33],
					"6_4" =>$fila[34],
					"6_5" =>$fila[35],
					"6_6" =>$fila[36],
					"7_1" =>$fila[37],
					"7_2" =>$fila[38],
					"7_3" =>$fila[39],
					"7_4" =>$fila[40],
					"7_5" =>$fila[41],
					"7_6" =>$fila[42],
					"8_1" =>$fila[43],
					"8_2" =>$fila[44],
					"8_3" =>$fila[45],
					"8_4" =>$fila[46],
					"8_5" =>$fila[47],
					"8_6" =>$fila[48],
					"9_1" =>$fila[49],
					"9_2" =>$fila[50],
					"9_3" =>$fila[51],
					"9_4" =>$fila[52],
					"9_5" =>$fila[53],
					"9_6" =>$fila[54],
					"10_1" =>$fila[55],
					"10_2" =>$fila[56],
					"10_3" =>$fila[57],
					"10_4" =>$fila[58],
					"10_5" =>$fila[59],
					"10_6" =>$fila[60],
					"11_1" =>$fila[61],
					"11_2" =>$fila[62],
					"11_3" =>$fila[63],
					"11_4" =>$fila[64],
					"11_5" =>$fila[65],
					"11_6" =>$fila[66]					
				);
			  	$i++;
			}//end while
		}//fin else

		return $data;
	}

/**********************************************************************/

} // END class

?>