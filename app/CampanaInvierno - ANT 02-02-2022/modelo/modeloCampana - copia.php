<?php

class claseCampana
{
	
	
	private $anio;
	private $centro;
	private $semana;
	private $desde;
	private $hasta;


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

	// LLAMA A UN SP QUE CARGA LA DATA DEL CAMPO SELECT
	public function OBTENER_SEMANAS_EPIDEMIOLOGICA($bd){
		$i = 0;
		$data = Array();
		$sql= "call OBTENER_SEMANAS_EPIDEMIOLOGICA(2020)";
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
		$sql= "SELECT 	(SELECT DATE_FORMAT(SE.FECHA, '%d-%m-%Y') FROM semana_epidemiologica SE where SE.SEMANA_EPI IN ({$this->getSemana()})  and ANNO = 2020 ORDER BY SE.FECHA ASC LIMIT 1) as 'FECHA',(SELECT DATE_FORMAT(SE.FECHA_FINAL_EPI, '%d-%m-%Y') FROM semana_epidemiologica SE where SE.SEMANA_EPI IN ({$this->getSemana()}) and ANNO = 2020 ORDER BY SE.FECHA DESC LIMIT 1) as 'FECHA_FINAL_EPI';";
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
	function obtenerDataFinal($bd){
		$i=0;
		$data = Array();
		$sql = "CALL OBTENER_MORBILIDAD_INVIERNO('2020/02/15', '2020/02/17', 0)";
		//$sql="CALL OBTENER_MORBILIDAD_INVIERNO('{$this->getDesde()}','{$this->getHasta()}',{$this->getCentro()})";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i] = array(
					"data" => "1",
					"1_1" =>$fila[0],
					"1_2" =>$fila[1],
					"1_3" =>$fila[2],
					"1_4" =>$fila[3],
					"1_5" =>$fila[4],
					"1_6" =>$fila[5],
					"2_1" =>$fila[6],
					"2_2" =>$fila[7],
					"2_3" =>$fila[8],
					"2_4" =>$fila[9],
					"2_5" =>$fila[10],
					"2_6" =>$fila[11],
					"3_1" =>$fila[12],
					"3_2" =>$fila[13],
					"3_3" =>$fila[14],
					"3_4" =>$fila[15],
					"3_5" =>$fila[16],
					"3_6" =>$fila[17],
					"4_1" =>$fila[18],
					"4_2" =>$fila[19],
					"4_3" =>$fila[20],
					"4_4" =>$fila[21],
					"4_5" =>$fila[22],
					"4_6" =>$fila[23],
					"5_1" =>$fila[24],
					"5_2" =>$fila[25],
					"5_3" =>$fila[26],
					"5_4" =>$fila[27],
					"5_5" =>$fila[28],
					"5_6" =>$fila[29],
					"6_1" =>$fila[30],
					"6_2" =>$fila[31],
					"6_3" =>$fila[32],
					"6_4" =>$fila[33],
					"6_5" =>$fila[34],
					"6_6" =>$fila[35],
					"7_1" =>$fila[36],
					"7_2" =>$fila[37],
					"7_3" =>$fila[38],
					"7_4" =>$fila[39],
					"7_5" =>$fila[40],
					"7_6" =>$fila[41],
					"8_1" =>$fila[42],
					"8_2" =>$fila[43],
					"8_3" =>$fila[44],
					"8_4" =>$fila[45],
					"8_5" =>$fila[46],
					"8_6" =>$fila[47],
					"9_1" =>$fila[48],
					"9_2" =>$fila[49],
					"9_3" =>$fila[50],
					"9_4" =>$fila[51],
					"9_5" =>$fila[52],
					"9_6" =>$fila[53],
					"10_1" =>$fila[54],
					"10_2" =>$fila[55],
					"10_3" =>$fila[56],
					"10_4" =>$fila[57],
					"10_5" =>$fila[58],
					"10_6" =>$fila[59],
					"11_1" =>$fila[60],
					"11_2" =>$fila[61],
					"11_3" =>$fila[62],
					"11_4" =>$fila[63],
					"11_5" =>$fila[64],
					"11_6" =>$fila[65]					
				);
		  $i++;
		}//end while
		}//fin else
		return $data;
	}

/**********************************************************************/




/** VALIDACION GRAFICO**/

	public function CAMIN_OBTENER_GRAFICO_DIA_SI($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT SUBSTRING(CAM.DIA_SEMANA,1,3) AS 'SEMANA',  CAM.CENTRO  AS 'CENTRO', SUM(CAM.1_1)  AS 'TOTAL_CESFAM',
                SUM(CAM.2_1)  AS 'TOTAL_SR', (SELECT SUM(CAM1.1_1)  FROM CAMPANA_RESUMEN CAM1 WHERE CAM1.SEMANA_EPIDEMIOLOGICA in(CAM.SEMANA_EPIDEMIOLOGICA) AND  
                CAM1.ANNO = 2018 AND CAM1.DIA_SEMANA_COD = CAM.DIA_SEMANA_COD) AS 'TOTAL_CESFAM_AA', (SELECT SUM(CAM1.2_1) FROM CAMPANA_RESUMEN CAM1 
                WHERE CAM1.SEMANA_EPIDEMIOLOGICA in(CAM.SEMANA_EPIDEMIOLOGICA) AND  CAM1.ANNO = 2018  AND CAM1.DIA_SEMANA_COD = CAM.DIA_SEMANA_COD) AS 'TOTAL_SR_AA'
            	FROM CAMPANA_RESUMEN CAM where CAM.ANNO = 2019 AND CAM.SEMANA_EPIDEMIOLOGICA in ({$this->getSemana()}) AND  CAM.SEMANA_EPIDEMIOLOGICA IS NOT NULL
            	GROUP BY CAM.FECHA ORDER BY CAM.FECHA,CAM.CENTRO_ORDENADO ASC";//"call CAMIN_OBTENER_GRAFICO_DIA_SI({$this->getSemana()})";
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

	public function CAMIN_OBTENER_GRAFICO_DIA_SI_CENTRO_DOS($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT SUBSTRING(CAM.DIA_SEMANA,1,3) AS 'SEMANA',CAM.CENTRO  AS 'CENTRO',SUM(CAM.1_1)  AS 'TOTAL_CESFAM',SUM(CAM.2_1) AS 'TOTAL_SR',(SELECT SUM(CAM1.1_1) FROM CAMPANA_RESUMEN CAM1 WHERE CAM1.SEMANA_EPIDEMIOLOGICA in(CAM.SEMANA_EPIDEMIOLOGICA) AND CAM1.CENTRO_ID = CAM.CENTRO_ID AND CAM1.ANNO = 2018 AND CAM1.DIA_SEMANA_COD = CAM.DIA_SEMANA_COD) AS 'TOTAL_CESFAM_AA',(SELECT SUM(CAM1.2_1)FROM CAMPANA_RESUMEN CAM1 WHERE CAM1.SEMANA_EPIDEMIOLOGICA in(CAM.SEMANA_EPIDEMIOLOGICA) AND CAM1.CENTRO_ID = CAM.CENTRO_ID AND CAM1.ANNO = 2018  AND CAM1.DIA_SEMANA_COD = CAM.DIA_SEMANA_COD) AS 'TOTAL_SR_AA'FROM CAMPANA_RESUMEN CAM where CAM.ANNO = 2019 AND  CAM.SEMANA_EPIDEMIOLOGICA in ({$this->getSemana()}) AND CAM.SEMANA_EPIDEMIOLOGICA IS NOT NULL AND CAM.CENTRO_ID = {$this->getCentro()} GROUP BY CAM.FECHA ORDER BY CAM.FECHA,CAM.CENTRO_ORDENADO ASC";
		//"call CAMIN_OBTENER_GRAFICO_DIA_SI_CENTRO_DOS({$this->getSemana()},{$this->getCentro()})";
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


	public function CAMIN_OBTENER_GRAFICO_DIA_SI_TRES($bd){
		$i = 0;
		$data = Array();
		$sql= "call CAMIN_OBTENER_GRAFICO_DIA_SI_TRES()";
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

	public function CAMIN_OBTENER_GRAFICO_DIA_SI_TRES_CENTRO($bd){
		$i = 0;
		$data = Array();
		$sql= "call CAMIN_OBTENER_GRAFICO_DIA_SI_TRES_CENTRO({$this->getCentro()})";
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

	public function CAMIN_OBTENER_GRAFICO_DIA_SI_QUINTO($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT CONCAT('Semana ',CAM.SEMANA_EPIDEMIOLOGICA) AS 'SEMANA', CAM.CENTRO AS 'CENTRO', SUM(CAM.1_1) AS 'TOTAL_CESFAM', SUM(CAM.2_1) AS 'TOTAL_SR', (SELECT SUM(CAM1.1_1)
                   FROM CAMPANA_RESUMEN CAM1 WHERE CAM1.SEMANA_EPIDEMIOLOGICA in (CAM.SEMANA_EPIDEMIOLOGICA) AND CAM1.ANNO = 2018 )AS 'TOTAL_CESFAM_AA', (SELECT SUM(CAM1.2_1)
                 FROM CAMPANA_RESUMEN CAM1 WHERE CAM1.SEMANA_EPIDEMIOLOGICA in (CAM.SEMANA_EPIDEMIOLOGICA) AND CAM1.ANNO = 2018 ) AS 'TOTAL_SR_AA' FROM CAMPANA_RESUMEN CAM where 
                 CAM.ANNO = 2019 AND CAM.SEMANA_EPIDEMIOLOGICA in ({$this->getSemana()}) AND CAM.SEMANA_EPIDEMIOLOGICA IS NOT NULL GROUP BY CAM.SEMANA_EPIDEMIOLOGICA ORDER BY CAM.SEMANA_EPIDEMIOLOGICA,CAM.CENTRO_ORDENADO ASC";
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

	public function CAMIN_OBTENER_GRAFICO_DIA_SI_QUINTO_ALL($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT CONCAT('Semana ',CAM.SEMANA_EPIDEMIOLOGICA) AS 'SEMANA', CAM.CENTRO  AS 'CENTRO',SUM(CAM.1_1)  AS 'TOTAL_CESFAM', SUM(CAM.2_1)  AS 'TOTAL_SR', (SELECT SUM(CAM1.1_1) FROM CAMPANA_RESUMEN CAM1 
		WHERE CAM1.SEMANA_EPIDEMIOLOGICA in (CAM.SEMANA_EPIDEMIOLOGICA) AND CAM1.CENTRO_ID = CAM.CENTRO_ID AND CAM1.ANNO = 2018 )AS 'TOTAL_CESFAM_AA', (SELECT SUM(CAM1.2_1) FROM CAMPANA_RESUMEN CAM1 WHERE CAM1.SEMANA_EPIDEMIOLOGICA 
		in (CAM.SEMANA_EPIDEMIOLOGICA) AND CAM1.CENTRO_ID = CAM.CENTRO_ID AND CAM1.ANNO = 2018 ) AS 'TOTAL_SR_AA' FROM CAMPANA_RESUMEN CAM where CAM.ANNO = 2019 AND CAM.SEMANA_EPIDEMIOLOGICA in ({$this->getSemana()}) 
		AND CAM.SEMANA_EPIDEMIOLOGICA IS NOT NULL AND CAM.CENTRO_ID = {$this->getCentro()}  GROUP BY CAM.SEMANA_EPIDEMIOLOGICA ORDER BY CAM.SEMANA_EPIDEMIOLOGICA,CAM.CENTRO_ORDENADO ASC";
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

//  ------------------------------------------------------
	public function CAMIN_OBTENER_DATOS_TABLA_UNO($bd){
		$i = 0;
		$data = Array();
		$sql= "CALL CAMIN_OBTENER_DATOS_TABLA_UNO()";
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
					"FECHA"=>$fila[0],
					"CENTRO"=>$fila[1],
					"1_1"=>$fila[2],
					"1_2"=>$fila[3],
					"1_3"=>$fila[4],
					"1_4"=>$fila[5],
					"1_5"=>$fila[6],
					"1_6"=>$fila[7],
					"2_1"=>$fila[8],
					"2_2"=>$fila[9],
					"2_3"=>$fila[10],
					"2_4"=>$fila[11],
					"2_5"=>$fila[12],
					"2_6"=>$fila[13],
					"3_1"=>$fila[14],
					"3_2"=>$fila[15],
					"3_3"=>$fila[16],
					"3_4"=>$fila[17],
					"3_5"=>$fila[18],
					"3_6"=>$fila[19],
					"4_1"=>$fila[20],
					"4_2"=>$fila[21],
					"4_3"=>$fila[22],
					"4_4"=>$fila[23],
					"4_5"=>$fila[24],
					"4_6"=>$fila[25],
					"5_1"=>$fila[26],
					"5_2"=>$fila[27],
					"5_3"=>$fila[28],
					"5_4"=>$fila[29],
					"5_5"=>$fila[30],
					"5_6"=>$fila[31],
					"6_1"=>$fila[32],
					"6_2"=>$fila[33],
					"6_3"=>$fila[34],
					"6_4"=>$fila[35],
					"6_5"=>$fila[36],
					"6_6"=>$fila[37],
					"7_1"=>$fila[38],
					"7_2"=>$fila[39],
					"7_3"=>$fila[40],
					"7_4"=>$fila[41],
					"7_5"=>$fila[42],
					"7_6"=>$fila[43],
					"8_1"=>$fila[44],
					"8_2"=>$fila[45],
					"8_3"=>$fila[46],
					"8_4"=>$fila[47],
					"8_5"=>$fila[48],
					"8_6"=>$fila[49]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}

	public function CAMIN_OBTENER_DATOS_TABLA_DOS($bd){
		$i = 0;
		$data = Array();
		$sql= "CALL CAMIN_OBTENER_DATOS_TABLA_DOS({$this->getCentro()})";
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
					"FECHA"=>$fila[0],
					"CENTRO"=>$fila[1],
					"1_1"=>$fila[2],
					"1_2"=>$fila[3],
					"1_3"=>$fila[4],
					"1_4"=>$fila[5],
					"1_5"=>$fila[6],
					"1_6"=>$fila[7],
					"2_1"=>$fila[8],
					"2_2"=>$fila[9],
					"2_3"=>$fila[10],
					"2_4"=>$fila[11],
					"2_5"=>$fila[12],
					"2_6"=>$fila[13],
					"3_1"=>$fila[14],
					"3_2"=>$fila[15],
					"3_3"=>$fila[16],
					"3_4"=>$fila[17],
					"3_5"=>$fila[18],
					"3_6"=>$fila[19],
					"4_1"=>$fila[20],
					"4_2"=>$fila[21],
					"4_3"=>$fila[22],
					"4_4"=>$fila[23],
					"4_5"=>$fila[24],
					"4_6"=>$fila[25],
					"5_1"=>$fila[26],
					"5_2"=>$fila[27],
					"5_3"=>$fila[28],
					"5_4"=>$fila[29],
					"5_5"=>$fila[30],
					"5_6"=>$fila[31],
					"6_1"=>$fila[32],
					"6_2"=>$fila[33],
					"6_3"=>$fila[34],
					"6_4"=>$fila[35],
					"6_5"=>$fila[36],
					"6_6"=>$fila[37],
					"7_1"=>$fila[38],
					"7_2"=>$fila[39],
					"7_3"=>$fila[40],
					"7_4"=>$fila[41],
					"7_5"=>$fila[42],
					"7_6"=>$fila[43],
					"8_1"=>$fila[44],
					"8_2"=>$fila[45],
					"8_3"=>$fila[46],
					"8_4"=>$fila[47],
					"8_5"=>$fila[48],
					"8_6"=>$fila[49]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}


	public function CAMIN_OBTENER_DATOS_TABLA_TRES($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT  CAM.FECHA AS 'FECHA','TODOS' AS 'CENTRO',REPLACE(FORMAT(SUM(CAM.1_1),0),',','.')	AS '1_1',REPLACE(FORMAT(SUM(CAM.1_2),0),',','.')	AS '1_2',
			REPLACE(FORMAT(SUM(CAM.1_3),0),',','.')	AS '1_3',REPLACE(FORMAT(SUM(CAM.1_4),0),',','.')	AS '1_4',REPLACE(FORMAT(SUM(CAM.1_5),0),',','.')	AS '1_5',
			REPLACE(FORMAT(SUM(CAM.1_6),0),',','.')	AS '1_6',REPLACE(FORMAT(SUM(CAM.2_1),0),',','.')	AS '2_1',REPLACE(FORMAT(SUM(CAM.2_2),0),',','.')	AS '2_2',
			REPLACE(FORMAT(SUM(CAM.2_3),0),',','.')	AS '2_3',REPLACE(FORMAT(SUM(CAM.2_4),0),',','.')	AS '2_4',REPLACE(FORMAT(SUM(CAM.2_5),0),',','.')	AS '2_5',
			REPLACE(FORMAT(SUM(CAM.2_6),0),',','.')	AS '2_6',REPLACE(FORMAT(SUM(CAM.3_1),0),',','.')	AS '3_1',REPLACE(FORMAT(SUM(CAM.3_2),0),',','.')	AS '3_2',
			REPLACE(FORMAT(SUM(CAM.3_3),0),',','.')	AS '3_3',REPLACE(FORMAT(SUM(CAM.3_4),0),',','.')	AS '3_4',REPLACE(FORMAT(SUM(CAM.3_5),0),',','.')	AS '3_5',
			REPLACE(FORMAT(SUM(CAM.3_6),0),',','.')	AS '3_6',REPLACE(FORMAT(SUM(CAM.4_1),0),',','.')	AS '4_1',REPLACE(FORMAT(SUM(CAM.4_2),0),',','.')	AS '4_2',
			REPLACE(FORMAT(SUM(CAM.4_3),0),',','.')	AS '4_3',REPLACE(FORMAT(SUM(CAM.4_4),0),',','.')	AS '4_4',REPLACE(FORMAT(SUM(CAM.4_5),0),',','.')	AS '4_5',
			REPLACE(FORMAT(SUM(CAM.4_6),0),',','.')	AS '4_6',REPLACE(FORMAT(SUM(CAM.5_1),0),',','.')	AS '5_1',REPLACE(FORMAT(SUM(CAM.5_2),0),',','.')	AS '5_2',
			REPLACE(FORMAT(SUM(CAM.5_3),0),',','.')	AS '5_3',REPLACE(FORMAT(SUM(CAM.5_4),0),',','.')	AS '5_4',REPLACE(FORMAT(SUM(CAM.5_5),0),',','.')	AS '5_5',
			REPLACE(FORMAT(SUM(CAM.5_6),0),',','.')	AS '5_6',REPLACE(FORMAT(SUM(CAM.6_1),0),',','.')	AS '6_1',REPLACE(FORMAT(SUM(CAM.6_2),0),',','.')	AS '6_2',
			REPLACE(FORMAT(SUM(CAM.6_3),0),',','.')	AS '6_3',REPLACE(FORMAT(SUM(CAM.6_4),0),',','.')	AS '6_4',REPLACE(FORMAT(SUM(CAM.6_5),0),',','.')	AS '6_5',
			REPLACE(FORMAT(SUM(CAM.6_6),0),',','.')	AS '6_6',REPLACE(FORMAT(SUM(CAM.7_1),0),',','.')	AS '7_1',REPLACE(FORMAT(SUM(CAM.7_2),0),',','.')	AS '7_2',
			REPLACE(FORMAT(SUM(CAM.7_3),0),',','.')	AS '7_3',REPLACE(FORMAT(SUM(CAM.7_4),0),',','.')	AS '7_4',REPLACE(FORMAT(SUM(CAM.7_5),0),',','.')	AS '7_5',
			REPLACE(FORMAT(SUM(CAM.7_6),0),',','.')	AS '7_6',REPLACE(FORMAT(SUM(CAM.8_1),0),',','.')	AS '8_1',REPLACE(FORMAT(SUM(CAM.8_2),0),',','.')	AS '8_2',
			REPLACE(FORMAT(SUM(CAM.8_3),0),',','.')	AS '8_3',REPLACE(FORMAT(SUM(CAM.8_4),0),',','.')	AS '8_4',REPLACE(FORMAT(SUM(CAM.8_5),0),',','.')	AS '8_5',
			REPLACE(FORMAT(SUM(CAM.8_6),0),',','.')	AS '8_6'FROM CAMPANA_RESUMEN CAM WHERE ANNO = 2019 AND CAM.SEMANA_EPIDEMIOLOGICA in ({$this->getSemana()}) AND CAM.SEMANA_EPIDEMIOLOGICA IS NOT NULL;";
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
					"FECHA"=>$fila[0],
					"CENTRO"=>$fila[1],
					"1_1"=>$fila[2],
					"1_2"=>$fila[3],
					"1_3"=>$fila[4],
					"1_4"=>$fila[5],
					"1_5"=>$fila[6],
					"1_6"=>$fila[7],
					"2_1"=>$fila[8],
					"2_2"=>$fila[9],
					"2_3"=>$fila[10],
					"2_4"=>$fila[11],
					"2_5"=>$fila[12],
					"2_6"=>$fila[13],
					"3_1"=>$fila[14],
					"3_2"=>$fila[15],
					"3_3"=>$fila[16],
					"3_4"=>$fila[17],
					"3_5"=>$fila[18],
					"3_6"=>$fila[19],
					"4_1"=>$fila[20],
					"4_2"=>$fila[21],
					"4_3"=>$fila[22],
					"4_4"=>$fila[23],
					"4_5"=>$fila[24],
					"4_6"=>$fila[25],
					"5_1"=>$fila[26],
					"5_2"=>$fila[27],
					"5_3"=>$fila[28],
					"5_4"=>$fila[29],
					"5_5"=>$fila[30],
					"5_6"=>$fila[31],
					"6_1"=>$fila[32],
					"6_2"=>$fila[33],
					"6_3"=>$fila[34],
					"6_4"=>$fila[35],
					"6_5"=>$fila[36],
					"6_6"=>$fila[37],
					"7_1"=>$fila[38],
					"7_2"=>$fila[39],
					"7_3"=>$fila[40],
					"7_4"=>$fila[41],
					"7_5"=>$fila[42],
					"7_6"=>$fila[43],
					"8_1"=>$fila[44],
					"8_2"=>$fila[45],
					"8_3"=>$fila[46],
					"8_4"=>$fila[47],
					"8_5"=>$fila[48],
					"8_6"=>$fila[49]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}


	public function CAMIN_OBTENER_DATOS_TABLA_CUATRO($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT CAM.FECHA AS 'FECHA',CAM.CENTRO AS 'CENTRO',REPLACE(FORMAT(SUM(CAM.1_1),0),',','.')	AS '1_1',REPLACE(FORMAT(SUM(CAM.1_2),0),',','.')	AS '1_2',REPLACE(FORMAT(SUM(CAM.1_3),0),',','.')	AS '1_3',
			REPLACE(FORMAT(SUM(CAM.1_4),0),',','.')	AS '1_4',REPLACE(FORMAT(SUM(CAM.1_5),0),',','.')	AS '1_5',REPLACE(FORMAT(SUM(CAM.1_6),0),',','.')	AS '1_6',REPLACE(FORMAT(SUM(CAM.2_1),0),',','.')	AS '2_1',
			REPLACE(FORMAT(SUM(CAM.2_2),0),',','.')	AS '2_2',REPLACE(FORMAT(SUM(CAM.2_3),0),',','.')	AS '2_3',REPLACE(FORMAT(SUM(CAM.2_4),0),',','.')	AS '2_4',REPLACE(FORMAT(SUM(CAM.2_5),0),',','.')	AS '2_5',
			REPLACE(FORMAT(SUM(CAM.2_6),0),',','.')	AS '2_6',REPLACE(FORMAT(SUM(CAM.3_1),0),',','.')	AS '3_1',REPLACE(FORMAT(SUM(CAM.3_2),0),',','.')	AS '3_2',REPLACE(FORMAT(SUM(CAM.3_3),0),',','.')	AS '3_3',
			REPLACE(FORMAT(SUM(CAM.3_4),0),',','.')	AS '3_4',REPLACE(FORMAT(SUM(CAM.3_5),0),',','.')	AS '3_5',REPLACE(FORMAT(SUM(CAM.3_6),0),',','.')	AS '3_6',REPLACE(FORMAT(SUM(CAM.4_1),0),',','.')	AS '4_1',
			REPLACE(FORMAT(SUM(CAM.4_2),0),',','.')	AS '4_2',REPLACE(FORMAT(SUM(CAM.4_3),0),',','.')	AS '4_3',REPLACE(FORMAT(SUM(CAM.4_4),0),',','.')	AS '4_4',REPLACE(FORMAT(SUM(CAM.4_5),0),',','.')	AS '4_5',
			REPLACE(FORMAT(SUM(CAM.4_6),0),',','.')	AS '4_6',REPLACE(FORMAT(SUM(CAM.5_1),0),',','.')	AS '5_1',REPLACE(FORMAT(SUM(CAM.5_2),0),',','.')	AS '5_2',REPLACE(FORMAT(SUM(CAM.5_3),0),',','.')	AS '5_3',
			REPLACE(FORMAT(SUM(CAM.5_4),0),',','.')	AS '5_4',REPLACE(FORMAT(SUM(CAM.5_5),0),',','.')	AS '5_5',REPLACE(FORMAT(SUM(CAM.5_6),0),',','.')	AS '5_6',REPLACE(FORMAT(SUM(CAM.6_1),0),',','.')	AS '6_1',
			REPLACE(FORMAT(SUM(CAM.6_2),0),',','.')	AS '6_2',REPLACE(FORMAT(SUM(CAM.6_3),0),',','.')	AS '6_3',REPLACE(FORMAT(SUM(CAM.6_4),0),',','.')	AS '6_4',REPLACE(FORMAT(SUM(CAM.6_5),0),',','.')	AS '6_5',
			REPLACE(FORMAT(SUM(CAM.6_6),0),',','.')	AS '6_6',REPLACE(FORMAT(SUM(CAM.7_1),0),',','.')	AS '7_1',REPLACE(FORMAT(SUM(CAM.7_2),0),',','.')	AS '7_2',REPLACE(FORMAT(SUM(CAM.7_3),0),',','.')	AS '7_3',
			REPLACE(FORMAT(SUM(CAM.7_4),0),',','.')	AS '7_4',REPLACE(FORMAT(SUM(CAM.7_5),0),',','.')	AS '7_5',REPLACE(FORMAT(SUM(CAM.7_6),0),',','.')	AS '7_6',REPLACE(FORMAT(SUM(CAM.8_1),0),',','.')	AS '8_1',
			REPLACE(FORMAT(SUM(CAM.8_2),0),',','.')	AS '8_2',REPLACE(FORMAT(SUM(CAM.8_3),0),',','.')	AS '8_3',REPLACE(FORMAT(SUM(CAM.8_4),0),',','.')	AS '8_4',REPLACE(FORMAT(SUM(CAM.8_5),0),',','.')	AS '8_5',
			REPLACE(FORMAT(SUM(CAM.8_6),0),',','.')	AS '8_6' FROM CAMPANA_RESUMEN CAM WHERE ANNO = 2019 AND CAM.SEMANA_EPIDEMIOLOGICA in ({$this->getSemana()}) AND CAM.SEMANA_EPIDEMIOLOGICA IS NOT NULL AND CAM.CENTRO_ID = {$this->getCentro()}";
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
					"FECHA"=>$fila[0],
					"CENTRO"=>$fila[1],
					"1_1"=>$fila[2],
					"1_2"=>$fila[3],
					"1_3"=>$fila[4],
					"1_4"=>$fila[5],
					"1_5"=>$fila[6],
					"1_6"=>$fila[7],
					"2_1"=>$fila[8],
					"2_2"=>$fila[9],
					"2_3"=>$fila[10],
					"2_4"=>$fila[11],
					"2_5"=>$fila[12],
					"2_6"=>$fila[13],
					"3_1"=>$fila[14],
					"3_2"=>$fila[15],
					"3_3"=>$fila[16],
					"3_4"=>$fila[17],
					"3_5"=>$fila[18],
					"3_6"=>$fila[19],
					"4_1"=>$fila[20],
					"4_2"=>$fila[21],
					"4_3"=>$fila[22],
					"4_4"=>$fila[23],
					"4_5"=>$fila[24],
					"4_6"=>$fila[25],
					"5_1"=>$fila[26],
					"5_2"=>$fila[27],
					"5_3"=>$fila[28],
					"5_4"=>$fila[29],
					"5_5"=>$fila[30],
					"5_6"=>$fila[31],
					"6_1"=>$fila[32],
					"6_2"=>$fila[33],
					"6_3"=>$fila[34],
					"6_4"=>$fila[35],
					"6_5"=>$fila[36],
					"6_6"=>$fila[37],
					"7_1"=>$fila[38],
					"7_2"=>$fila[39],
					"7_3"=>$fila[40],
					"7_4"=>$fila[41],
					"7_5"=>$fila[42],
					"7_6"=>$fila[43],
					"8_1"=>$fila[44],
					"8_2"=>$fila[45],
					"8_3"=>$fila[46],
					"8_4"=>$fila[47],
					"8_5"=>$fila[48],
					"8_6"=>$fila[49]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}


	public function CAMIN_OBTENER_DATOS_TABLA_CINCO($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT  CAM.FECHA AS 'FECHA','TODOS' AS 'CENTRO',REPLACE(FORMAT(SUM(CAM.1_1),0),',','.')	AS '1_1',REPLACE(FORMAT(SUM(CAM.1_2),0),',','.')	AS '1_2',REPLACE(FORMAT(SUM(CAM.1_3),0),',','.')	AS '1_3',REPLACE(FORMAT(SUM(CAM.1_4),0),',','.')	AS '1_4',REPLACE(FORMAT(SUM(CAM.1_5),0),',','.')	AS '1_5',
			REPLACE(FORMAT(SUM(CAM.1_6),0),',','.')	AS '1_6',REPLACE(FORMAT(SUM(CAM.2_1),0),',','.')	AS '2_1',REPLACE(FORMAT(SUM(CAM.2_2),0),',','.')	AS '2_2',REPLACE(FORMAT(SUM(CAM.2_3),0),',','.')	AS '2_3',REPLACE(FORMAT(SUM(CAM.2_4),0),',','.')	AS '2_4',REPLACE(FORMAT(SUM(CAM.2_5),0),',','.')	AS '2_5',REPLACE(FORMAT(SUM(CAM.2_6),0),',','.')	AS '2_6',REPLACE(FORMAT(SUM(CAM.3_1),0),',','.')	AS '3_1',REPLACE(FORMAT(SUM(CAM.3_2),0),',','.')	AS '3_2',
			REPLACE(FORMAT(SUM(CAM.3_3),0),',','.')	AS '3_3',REPLACE(FORMAT(SUM(CAM.3_4),0),',','.')	AS '3_4',REPLACE(FORMAT(SUM(CAM.3_5),0),',','.')	AS '3_5',REPLACE(FORMAT(SUM(CAM.3_6),0),',','.')	AS '3_6',REPLACE(FORMAT(SUM(CAM.4_1),0),',','.')	AS '4_1',REPLACE(FORMAT(SUM(CAM.4_2),0),',','.')	AS '4_2',
			REPLACE(FORMAT(SUM(CAM.4_3),0),',','.')	AS '4_3',REPLACE(FORMAT(SUM(CAM.4_4),0),',','.')	AS '4_4',REPLACE(FORMAT(SUM(CAM.4_5),0),',','.')	AS '4_5',REPLACE(FORMAT(SUM(CAM.4_6),0),',','.')	AS '4_6',REPLACE(FORMAT(SUM(CAM.5_1),0),',','.')	AS '5_1',REPLACE(FORMAT(SUM(CAM.5_2),0),',','.')	AS '5_2',
			REPLACE(FORMAT(SUM(CAM.5_3),0),',','.')	AS '5_3',REPLACE(FORMAT(SUM(CAM.5_4),0),',','.')	AS '5_4',REPLACE(FORMAT(SUM(CAM.5_5),0),',','.')	AS '5_5',REPLACE(FORMAT(SUM(CAM.5_6),0),',','.')	AS '5_6',REPLACE(FORMAT(SUM(CAM.6_1),0),',','.')	AS '6_1',REPLACE(FORMAT(SUM(CAM.6_2),0),',','.')	AS '6_2',
			REPLACE(FORMAT(SUM(CAM.6_3),0),',','.')	AS '6_3',REPLACE(FORMAT(SUM(CAM.6_4),0),',','.')	AS '6_4',REPLACE(FORMAT(SUM(CAM.6_5),0),',','.')	AS '6_5',REPLACE(FORMAT(SUM(CAM.6_6),0),',','.')	AS '6_6',REPLACE(FORMAT(SUM(CAM.7_1),0),',','.')	AS '7_1',REPLACE(FORMAT(SUM(CAM.7_2),0),',','.')	AS '7_2',
			REPLACE(FORMAT(SUM(CAM.7_3),0),',','.')	AS '7_3',REPLACE(FORMAT(SUM(CAM.7_4),0),',','.')	AS '7_4',REPLACE(FORMAT(SUM(CAM.7_5),0),',','.')	AS '7_5',REPLACE(FORMAT(SUM(CAM.7_6),0),',','.')	AS '7_6',REPLACE(FORMAT(SUM(CAM.8_1),0),',','.')	AS '8_1',REPLACE(FORMAT(SUM(CAM.8_2),0),',','.')	AS '8_2',
			REPLACE(FORMAT(SUM(CAM.8_3),0),',','.')	AS '8_3',REPLACE(FORMAT(SUM(CAM.8_4),0),',','.')	AS '8_4',REPLACE(FORMAT(SUM(CAM.8_5),0),',','.')	AS '8_5',REPLACE(FORMAT(SUM(CAM.8_6),0),',','.')	AS '8_6'  FROM CAMPANA_RESUMEN CAM WHERE CAM.FECHA BETWEEN '{$this->getDesde()}' and '{$this->getHasta()}' ";
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
					"FECHA"=>$fila[0],
					"CENTRO"=>$fila[1],
					"1_1"=>$fila[2],
					"1_2"=>$fila[3],
					"1_3"=>$fila[4],
					"1_4"=>$fila[5],
					"1_5"=>$fila[6],
					"1_6"=>$fila[7],
					"2_1"=>$fila[8],
					"2_2"=>$fila[9],
					"2_3"=>$fila[10],
					"2_4"=>$fila[11],
					"2_5"=>$fila[12],
					"2_6"=>$fila[13],
					"3_1"=>$fila[14],
					"3_2"=>$fila[15],
					"3_3"=>$fila[16],
					"3_4"=>$fila[17],
					"3_5"=>$fila[18],
					"3_6"=>$fila[19],
					"4_1"=>$fila[20],
					"4_2"=>$fila[21],
					"4_3"=>$fila[22],
					"4_4"=>$fila[23],
					"4_5"=>$fila[24],
					"4_6"=>$fila[25],
					"5_1"=>$fila[26],
					"5_2"=>$fila[27],
					"5_3"=>$fila[28],
					"5_4"=>$fila[29],
					"5_5"=>$fila[30],
					"5_6"=>$fila[31],
					"6_1"=>$fila[32],
					"6_2"=>$fila[33],
					"6_3"=>$fila[34],
					"6_4"=>$fila[35],
					"6_5"=>$fila[36],
					"6_6"=>$fila[37],
					"7_1"=>$fila[38],
					"7_2"=>$fila[39],
					"7_3"=>$fila[40],
					"7_4"=>$fila[41],
					"7_5"=>$fila[42],
					"7_6"=>$fila[43],
					"8_1"=>$fila[44],
					"8_2"=>$fila[45],
					"8_3"=>$fila[46],
					"8_4"=>$fila[47],
					"8_5"=>$fila[48],
					"8_6"=>$fila[49]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}

	public function CAMIN_OBTENER_DATOS_TABLA_SEIS($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT CAM.FECHA AS 'FECHA',CAM.CENTRO AS 'CENTRO',REPLACE(FORMAT(SUM(CAM.1_1),0),',','.')	AS '1_1',REPLACE(FORMAT(SUM(CAM.1_2),0),',','.')	AS '1_2',REPLACE(FORMAT(SUM(CAM.1_3),0),',','.')	AS '1_3',
			REPLACE(FORMAT(SUM(CAM.1_4),0),',','.')	AS '1_4',REPLACE(FORMAT(SUM(CAM.1_5),0),',','.')	AS '1_5',REPLACE(FORMAT(SUM(CAM.1_6),0),',','.')	AS '1_6',REPLACE(FORMAT(SUM(CAM.2_1),0),',','.')	AS '2_1',
			REPLACE(FORMAT(SUM(CAM.2_2),0),',','.')	AS '2_2',REPLACE(FORMAT(SUM(CAM.2_3),0),',','.')	AS '2_3',REPLACE(FORMAT(SUM(CAM.2_4),0),',','.')	AS '2_4',REPLACE(FORMAT(SUM(CAM.2_5),0),',','.')	AS '2_5',
			REPLACE(FORMAT(SUM(CAM.2_6),0),',','.')	AS '2_6',REPLACE(FORMAT(SUM(CAM.3_1),0),',','.')	AS '3_1',REPLACE(FORMAT(SUM(CAM.3_2),0),',','.')	AS '3_2',REPLACE(FORMAT(SUM(CAM.3_3),0),',','.')	AS '3_3',
			REPLACE(FORMAT(SUM(CAM.3_4),0),',','.')	AS '3_4',REPLACE(FORMAT(SUM(CAM.3_5),0),',','.')	AS '3_5',REPLACE(FORMAT(SUM(CAM.3_6),0),',','.')	AS '3_6',REPLACE(FORMAT(SUM(CAM.4_1),0),',','.')	AS '4_1',
			REPLACE(FORMAT(SUM(CAM.4_2),0),',','.')	AS '4_2',REPLACE(FORMAT(SUM(CAM.4_3),0),',','.')	AS '4_3',REPLACE(FORMAT(SUM(CAM.4_4),0),',','.')	AS '4_4',REPLACE(FORMAT(SUM(CAM.4_5),0),',','.')	AS '4_5',
			REPLACE(FORMAT(SUM(CAM.4_6),0),',','.')	AS '4_6',REPLACE(FORMAT(SUM(CAM.5_1),0),',','.')	AS '5_1',REPLACE(FORMAT(SUM(CAM.5_2),0),',','.')	AS '5_2',REPLACE(FORMAT(SUM(CAM.5_3),0),',','.')	AS '5_3',
			REPLACE(FORMAT(SUM(CAM.5_4),0),',','.')	AS '5_4',REPLACE(FORMAT(SUM(CAM.5_5),0),',','.')	AS '5_5',REPLACE(FORMAT(SUM(CAM.5_6),0),',','.')	AS '5_6',REPLACE(FORMAT(SUM(CAM.6_1),0),',','.')	AS '6_1',
			REPLACE(FORMAT(SUM(CAM.6_2),0),',','.')	AS '6_2',REPLACE(FORMAT(SUM(CAM.6_3),0),',','.')	AS '6_3',REPLACE(FORMAT(SUM(CAM.6_4),0),',','.')	AS '6_4',REPLACE(FORMAT(SUM(CAM.6_5),0),',','.')	AS '6_5',
			REPLACE(FORMAT(SUM(CAM.6_6),0),',','.')	AS '6_6',REPLACE(FORMAT(SUM(CAM.7_1),0),',','.')	AS '7_1',REPLACE(FORMAT(SUM(CAM.7_2),0),',','.')	AS '7_2',REPLACE(FORMAT(SUM(CAM.7_3),0),',','.')	AS '7_3',
			REPLACE(FORMAT(SUM(CAM.7_4),0),',','.')	AS '7_4',REPLACE(FORMAT(SUM(CAM.7_5),0),',','.')	AS '7_5',REPLACE(FORMAT(SUM(CAM.7_6),0),',','.')	AS '7_6',REPLACE(FORMAT(SUM(CAM.8_1),0),',','.')	AS '8_1',
			REPLACE(FORMAT(SUM(CAM.8_2),0),',','.')	AS '8_2',REPLACE(FORMAT(SUM(CAM.8_3),0),',','.')	AS '8_3',REPLACE(FORMAT(SUM(CAM.8_4),0),',','.')	AS '8_4',REPLACE(FORMAT(SUM(CAM.8_5),0),',','.')	AS '8_5',
			REPLACE(FORMAT(SUM(CAM.8_6),0),',','.')	AS '8_6' FROM CAMPANA_RESUMEN CAM WHERE CAM.FECHA BETWEEN '{$this->getDesde()}' and '{$this->getHasta()}' AND CAM.CENTRO_ID = {$this->getCentro()} ";
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
					"FECHA"=>$fila[0],
					"CENTRO"=>$fila[1],
					"1_1"=>$fila[2],
					"1_2"=>$fila[3],
					"1_3"=>$fila[4],
					"1_4"=>$fila[5],
					"1_5"=>$fila[6],
					"1_6"=>$fila[7],
					"2_1"=>$fila[8],
					"2_2"=>$fila[9],
					"2_3"=>$fila[10],
					"2_4"=>$fila[11],
					"2_5"=>$fila[12],
					"2_6"=>$fila[13],
					"3_1"=>$fila[14],
					"3_2"=>$fila[15],
					"3_3"=>$fila[16],
					"3_4"=>$fila[17],
					"3_5"=>$fila[18],
					"3_6"=>$fila[19],
					"4_1"=>$fila[20],
					"4_2"=>$fila[21],
					"4_3"=>$fila[22],
					"4_4"=>$fila[23],
					"4_5"=>$fila[24],
					"4_6"=>$fila[25],
					"5_1"=>$fila[26],
					"5_2"=>$fila[27],
					"5_3"=>$fila[28],
					"5_4"=>$fila[29],
					"5_5"=>$fila[30],
					"5_6"=>$fila[31],
					"6_1"=>$fila[32],
					"6_2"=>$fila[33],
					"6_3"=>$fila[34],
					"6_4"=>$fila[35],
					"6_5"=>$fila[36],
					"6_6"=>$fila[37],
					"7_1"=>$fila[38],
					"7_2"=>$fila[39],
					"7_3"=>$fila[40],
					"7_4"=>$fila[41],
					"7_5"=>$fila[42],
					"7_6"=>$fila[43],
					"8_1"=>$fila[44],
					"8_2"=>$fila[45],
					"8_3"=>$fila[46],
					"8_4"=>$fila[47],
					"8_5"=>$fila[48],
					"8_6"=>$fila[49]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}

	public function CAMIN_OBTENER_DATOS_TABLA_EXCEL_UNO($bd){
		$i = 0;
		$data = Array();
		$sql= "CALL CAMIN_OBTENER_DATOS_TABLA_EXCEL_UNO()";	
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
					"FECHA"=>$fila[0],
					"CENTRO"=>$fila[1],
					"U1_1"=>$fila[2],
					"1_2"=>$fila[3],
					"1_3"=>$fila[4],
					"1_4"=>$fila[5],
					"1_5"=>$fila[6],
					"1_6"=>$fila[7],
					"2_1"=>$fila[8],
					"2_2"=>$fila[9],
					"2_3"=>$fila[10],
					"2_4"=>$fila[11],
					"2_5"=>$fila[12],
					"2_6"=>$fila[13],
					"3_1"=>$fila[14],
					"3_2"=>$fila[15],
					"3_3"=>$fila[16],
					"3_4"=>$fila[17],
					"3_5"=>$fila[18],
					"3_6"=>$fila[19],
					"4_1"=>$fila[20],
					"4_2"=>$fila[21],
					"4_3"=>$fila[22],
					"4_4"=>$fila[23],
					"4_5"=>$fila[24],
					"4_6"=>$fila[25],
					"5_1"=>$fila[26],
					"5_2"=>$fila[27],
					"5_3"=>$fila[28],
					"5_4"=>$fila[29],
					"5_5"=>$fila[30],
					"5_6"=>$fila[31],
					"6_1"=>$fila[32],
					"6_2"=>$fila[33],
					"6_3"=>$fila[34],
					"6_4"=>$fila[35],
					"6_5"=>$fila[36],
					"6_6"=>$fila[37],
					"7_1"=>$fila[38],
					"7_2"=>$fila[39],
					"7_3"=>$fila[40],
					"7_4"=>$fila[41],
					"7_5"=>$fila[42],
					"7_6"=>$fila[43],
					"8_1"=>$fila[44],
					"8_2"=>$fila[45],
					"8_3"=>$fila[46],
					"8_4"=>$fila[47],
					"8_5"=>$fila[48],
					"8_6"=>$fila[49]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}

	public function CAMIN_OBTENER_DATOS_TABLA_EXCEL_DOS($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT CAM.FECHA AS 'FECHA',CAM.CENTRO AS 'CENTRO',SUM(CAM.1_1)	AS '1_1',SUM(CAM.1_2)	AS '1_2',SUM(CAM.1_3)	AS '1_3',SUM(CAM.1_4)	AS '1_4',SUM(CAM.1_5)	AS '1_5',SUM(CAM.1_6)	AS '1_6',SUM(CAM.2_1)	AS '2_1',SUM(CAM.2_2)	AS '2_2',SUM(CAM.2_3)	AS '2_3',SUM(CAM.2_4)	AS '2_4',SUM(CAM.2_5)	AS '2_5',SUM(CAM.2_6)	AS '2_6',SUM(CAM.3_1)	AS '3_1',SUM(CAM.3_2)	AS '3_2',SUM(CAM.3_3)	AS '3_3',SUM(CAM.3_4)	AS '3_4',SUM(CAM.3_5)	AS '3_5',SUM(CAM.3_6)	AS '3_6',SUM(CAM.4_1)	AS '4_1',SUM(CAM.4_2)	AS '4_2',SUM(CAM.4_3)	AS '4_3',SUM(CAM.4_4)	AS '4_4',SUM(CAM.4_5)	AS '4_5',SUM(CAM.4_6)	AS '4_6',SUM(CAM.5_1)	AS '5_1',SUM(CAM.5_2)	AS '5_2',SUM(CAM.5_3)	AS '5_3',SUM(CAM.5_4)	AS '5_4',SUM(CAM.5_5)	AS '5_5',SUM(CAM.5_6)	AS '5_6',SUM(CAM.6_1)	AS '6_1',SUM(CAM.6_2)	AS '6_2',SUM(CAM.6_3)	AS '6_3',SUM(CAM.6_4)	AS '6_4',SUM(CAM.6_5)	AS '6_5',SUM(CAM.6_6)	AS '6_6',SUM(CAM.7_1)	AS '7_1',SUM(CAM.7_2)	AS '7_2',SUM(CAM.7_3)	AS '7_3',
				SUM(CAM.7_4)	AS '7_4',SUM(CAM.7_5)	AS '7_5',SUM(CAM.7_6)	AS '7_6',SUM(CAM.8_1)	AS '8_1',SUM(CAM.8_2)	AS '8_2',SUM(CAM.8_3)	AS '8_3',SUM(CAM.8_4)	AS '8_4',SUM(CAM.8_5)	AS '8_5',SUM(CAM.8_6)	AS '8_6' FROM CAMPANA_RESUMEN CAM WHERE ANNO = 2019 AND CAM.SEMANA_EPIDEMIOLOGICA IS NOT NULL AND CAM.CENTRO_ID = {$this->getCentro()}";
		
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
					"FECHA"=>$fila[0],
					"CENTRO"=>$fila[1],
					"1_1"=>$fila[2],
					"1_2"=>$fila[3],
					"1_3"=>$fila[4],
					"1_4"=>$fila[5],
					"1_5"=>$fila[6],
					"1_6"=>$fila[7],
					"2_1"=>$fila[8],
					"2_2"=>$fila[9],
					"2_3"=>$fila[10],
					"2_4"=>$fila[11],
					"2_5"=>$fila[12],
					"2_6"=>$fila[13],
					"3_1"=>$fila[14],
					"3_2"=>$fila[15],
					"3_3"=>$fila[16],
					"3_4"=>$fila[17],
					"3_5"=>$fila[18],
					"3_6"=>$fila[19],
					"4_1"=>$fila[20],
					"4_2"=>$fila[21],
					"4_3"=>$fila[22],
					"4_4"=>$fila[23],
					"4_5"=>$fila[24],
					"4_6"=>$fila[25],
					"5_1"=>$fila[26],
					"5_2"=>$fila[27],
					"5_3"=>$fila[28],
					"5_4"=>$fila[29],
					"5_5"=>$fila[30],
					"5_6"=>$fila[31],
					"6_1"=>$fila[32],
					"6_2"=>$fila[33],
					"6_3"=>$fila[34],
					"6_4"=>$fila[35],
					"6_5"=>$fila[36],
					"6_6"=>$fila[37],
					"7_1"=>$fila[38],
					"7_2"=>$fila[39],
					"7_3"=>$fila[40],
					"7_4"=>$fila[41],
					"7_5"=>$fila[42],
					"7_6"=>$fila[43],
					"8_1"=>$fila[44],
					"8_2"=>$fila[45],
					"8_3"=>$fila[46],
					"8_4"=>$fila[47],
					"8_5"=>$fila[48],
					"8_6"=>$fila[49]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}

	public function CAMIN_OBTENER_DATOS_TABLA_EXCEL_TRES($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT CAM.FECHA AS 'FECHA',CAM.CENTRO AS 'CENTRO',SUM(CAM.1_1)	AS '1_1',SUM(CAM.1_2)	AS '1_2',SUM(CAM.1_3)	AS '1_3',SUM(CAM.1_4)	AS '1_4',SUM(CAM.1_5)	AS '1_5',SUM(CAM.1_6)	AS '1_6',SUM(CAM.2_1)	AS '2_1',SUM(CAM.2_2)	AS '2_2',SUM(CAM.2_3)	AS '2_3',SUM(CAM.2_4)	AS '2_4',SUM(CAM.2_5)	AS '2_5',SUM(CAM.2_6)	AS '2_6',SUM(CAM.3_1)	AS '3_1',SUM(CAM.3_2)	AS '3_2',SUM(CAM.3_3)	AS '3_3',SUM(CAM.3_4)	AS '3_4',SUM(CAM.3_5)	AS '3_5',SUM(CAM.3_6)	AS '3_6',SUM(CAM.4_1)	AS '4_1',SUM(CAM.4_2)	AS '4_2',SUM(CAM.4_3)	AS '4_3',SUM(CAM.4_4)	AS '4_4',SUM(CAM.4_5)	AS '4_5',SUM(CAM.4_6)	AS '4_6',SUM(CAM.5_1)	AS '5_1',SUM(CAM.5_2)	AS '5_2',SUM(CAM.5_3)	AS '5_3',SUM(CAM.5_4)	AS '5_4',SUM(CAM.5_5)	AS '5_5',SUM(CAM.5_6)	AS '5_6',SUM(CAM.6_1)	AS '6_1',SUM(CAM.6_2)	AS '6_2',SUM(CAM.6_3)	AS '6_3',SUM(CAM.6_4)	AS '6_4',SUM(CAM.6_5)	AS '6_5',SUM(CAM.6_6)	AS '6_6',SUM(CAM.7_1)	AS '7_1',SUM(CAM.7_2)	AS '7_2',SUM(CAM.7_3)	AS '7_3',
				SUM(CAM.7_4)	AS '7_4',SUM(CAM.7_5)	AS '7_5',SUM(CAM.7_6)	AS '7_6',SUM(CAM.8_1)	AS '8_1',SUM(CAM.8_2)	AS '8_2',SUM(CAM.8_3)	AS '8_3',SUM(CAM.8_4)	AS '8_4',SUM(CAM.8_5)	AS '8_5',SUM(CAM.8_6)	AS '8_6' FROM CAMPANA_RESUMEN CAM WHERE ANNO = 2019 AND CAM.SEMANA_EPIDEMIOLOGICA in ({$this->getSemana()}) AND	  CAM.SEMANA_EPIDEMIOLOGICA IS NOT NULL";
					$resultado = mysqli_query($bd,$sql);
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
					"FECHA"=>$fila[0],
					"CENTRO"=>$fila[1],
					"1_1"=>$fila[2],
					"1_2"=>$fila[3],
					"1_3"=>$fila[4],
					"1_4"=>$fila[5],
					"1_5"=>$fila[6],
					"1_6"=>$fila[7],
					"2_1"=>$fila[8],
					"2_2"=>$fila[9],
					"2_3"=>$fila[10],
					"2_4"=>$fila[11],
					"2_5"=>$fila[12],
					"2_6"=>$fila[13],
					"3_1"=>$fila[14],
					"3_2"=>$fila[15],
					"3_3"=>$fila[16],
					"3_4"=>$fila[17],
					"3_5"=>$fila[18],
					"3_6"=>$fila[19],
					"4_1"=>$fila[20],
					"4_2"=>$fila[21],
					"4_3"=>$fila[22],
					"4_4"=>$fila[23],
					"4_5"=>$fila[24],
					"4_6"=>$fila[25],
					"5_1"=>$fila[26],
					"5_2"=>$fila[27],
					"5_3"=>$fila[28],
					"5_4"=>$fila[29],
					"5_5"=>$fila[30],
					"5_6"=>$fila[31],
					"6_1"=>$fila[32],
					"6_2"=>$fila[33],
					"6_3"=>$fila[34],
					"6_4"=>$fila[35],
					"6_5"=>$fila[36],
					"6_6"=>$fila[37],
					"7_1"=>$fila[38],
					"7_2"=>$fila[39],
					"7_3"=>$fila[40],
					"7_4"=>$fila[41],
					"7_5"=>$fila[42],
					"7_6"=>$fila[43],
					"8_1"=>$fila[44],
					"8_2"=>$fila[45],
					"8_3"=>$fila[46],
					"8_4"=>$fila[47],
					"8_5"=>$fila[48],
					"8_6"=>$fila[49]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}

	public function CAMIN_OBTENER_DATOS_TABLA_EXCEL_CUATRO($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT CAM.FECHA AS 'FECHA',CAM.CENTRO AS 'CENTRO',SUM(CAM.1_1)	AS '1_1',SUM(CAM.1_2)	AS '1_2',SUM(CAM.1_3)	AS '1_3',SUM(CAM.1_4)	AS '1_4',SUM(CAM.1_5)	AS '1_5',SUM(CAM.1_6)	AS '1_6',SUM(CAM.2_1)	AS '2_1',SUM(CAM.2_2)	AS '2_2',SUM(CAM.2_3)	AS '2_3',SUM(CAM.2_4)	AS '2_4',SUM(CAM.2_5)	AS '2_5',SUM(CAM.2_6)	AS '2_6',SUM(CAM.3_1)	AS '3_1',SUM(CAM.3_2)	AS '3_2',SUM(CAM.3_3)	AS '3_3',SUM(CAM.3_4)	AS '3_4',SUM(CAM.3_5)	AS '3_5',SUM(CAM.3_6)	AS '3_6',SUM(CAM.4_1)	AS '4_1',SUM(CAM.4_2)	AS '4_2',SUM(CAM.4_3)	AS '4_3',SUM(CAM.4_4)	AS '4_4',SUM(CAM.4_5)	AS '4_5',SUM(CAM.4_6)	AS '4_6',SUM(CAM.5_1)	AS '5_1',SUM(CAM.5_2)	AS '5_2',SUM(CAM.5_3)	AS '5_3',SUM(CAM.5_4)	AS '5_4',SUM(CAM.5_5)	AS '5_5',SUM(CAM.5_6)	AS '5_6',SUM(CAM.6_1)	AS '6_1',SUM(CAM.6_2)	AS '6_2',SUM(CAM.6_3)	AS '6_3',SUM(CAM.6_4)	AS '6_4',SUM(CAM.6_5)	AS '6_5',SUM(CAM.6_6)	AS '6_6',SUM(CAM.7_1)	AS '7_1',SUM(CAM.7_2)	AS '7_2',SUM(CAM.7_3)	AS '7_3',					SUM(CAM.7_4)	AS '7_4',SUM(CAM.7_5)	AS '7_5',SUM(CAM.7_6)	AS '7_6',SUM(CAM.8_1)	AS '8_1',SUM(CAM.8_2)	AS '8_2',SUM(CAM.8_3)	AS '8_3',SUM(CAM.8_4)	AS '8_4',SUM(CAM.8_5)	AS '8_5',SUM(CAM.8_6)	AS '8_6' FROM CAMPANA_RESUMEN CAM WHERE ANNO = 2019 AND CAM.SEMANA_EPIDEMIOLOGICA in ({$this->getSemana()}) AND CAM.SEMANA_EPIDEMIOLOGICA IS NOT NULL AND CAM.CENTRO_ID = {$this->getCentro()}";
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
					"FECHA"=>$fila[0],
					"CENTRO"=>$fila[1],
					"1_1"=>$fila[2],
					"1_2"=>$fila[3],
					"1_3"=>$fila[4],
					"1_4"=>$fila[5],
					"1_5"=>$fila[6],
					"1_6"=>$fila[7],
					"2_1"=>$fila[8],
					"2_2"=>$fila[9],
					"2_3"=>$fila[10],
					"2_4"=>$fila[11],
					"2_5"=>$fila[12],
					"2_6"=>$fila[13],
					"3_1"=>$fila[14],
					"3_2"=>$fila[15],
					"3_3"=>$fila[16],
					"3_4"=>$fila[17],
					"3_5"=>$fila[18],
					"3_6"=>$fila[19],
					"4_1"=>$fila[20],
					"4_2"=>$fila[21],
					"4_3"=>$fila[22],
					"4_4"=>$fila[23],
					"4_5"=>$fila[24],
					"4_6"=>$fila[25],
					"5_1"=>$fila[26],
					"5_2"=>$fila[27],
					"5_3"=>$fila[28],
					"5_4"=>$fila[29],
					"5_5"=>$fila[30],
					"5_6"=>$fila[31],
					"6_1"=>$fila[32],
					"6_2"=>$fila[33],
					"6_3"=>$fila[34],
					"6_4"=>$fila[35],
					"6_5"=>$fila[36],
					"6_6"=>$fila[37],
					"7_1"=>$fila[38],
					"7_2"=>$fila[39],
					"7_3"=>$fila[40],
					"7_4"=>$fila[41],
					"7_5"=>$fila[42],
					"7_6"=>$fila[43],
					"8_1"=>$fila[44],
					"8_2"=>$fila[45],
					"8_3"=>$fila[46],
					"8_4"=>$fila[47],
					"8_5"=>$fila[48],
					"8_6"=>$fila[49]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}


	public function CAMIN_OBTENER_DATOS_TABLA_EXCEL_CINCO($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT CAM.FECHA AS 'FECHA',CAM.CENTRO AS 'CENTRO',SUM(CAM.1_1)	AS '1_1',SUM(CAM.1_2)	AS '1_2',SUM(CAM.1_3)	AS '1_3',SUM(CAM.1_4)	AS '1_4',SUM(CAM.1_5)	AS '1_5',SUM(CAM.1_6)	AS '1_6',SUM(CAM.2_1)	AS '2_1',SUM(CAM.2_2)	AS '2_2',SUM(CAM.2_3)	AS '2_3',SUM(CAM.2_4)	AS '2_4',SUM(CAM.2_5)	AS '2_5',SUM(CAM.2_6)	AS '2_6',SUM(CAM.3_1)	AS '3_1',SUM(CAM.3_2)	AS '3_2',SUM(CAM.3_3)	AS '3_3',SUM(CAM.3_4)	AS '3_4',SUM(CAM.3_5)	AS '3_5',SUM(CAM.3_6)	AS '3_6',SUM(CAM.4_1)	AS '4_1',SUM(CAM.4_2)	AS '4_2',SUM(CAM.4_3)	AS '4_3',SUM(CAM.4_4)	AS '4_4',SUM(CAM.4_5)	AS '4_5',SUM(CAM.4_6)	AS '4_6',SUM(CAM.5_1)	AS '5_1',SUM(CAM.5_2)	AS '5_2',SUM(CAM.5_3)	AS '5_3',SUM(CAM.5_4)	AS '5_4',SUM(CAM.5_5)	AS '5_5',SUM(CAM.5_6)	AS '5_6',SUM(CAM.6_1)	AS '6_1',SUM(CAM.6_2)	AS '6_2',SUM(CAM.6_3)	AS '6_3',SUM(CAM.6_4)	AS '6_4',SUM(CAM.6_5)	AS '6_5',SUM(CAM.6_6)	AS '6_6',SUM(CAM.7_1)	AS '7_1',SUM(CAM.7_2)	AS '7_2',SUM(CAM.7_3)	AS '7_3',					SUM(CAM.7_4)	AS '7_4',SUM(CAM.7_5)	AS '7_5',SUM(CAM.7_6)	AS '7_6',SUM(CAM.8_1)	AS '8_1',SUM(CAM.8_2)	AS '8_2',SUM(CAM.8_3)	AS '8_3',SUM(CAM.8_4)	AS '8_4',SUM(CAM.8_5)	AS '8_5',SUM(CAM.8_6)	AS '8_6' FROM CAMPANA_RESUMEN CAM WHERE CAM.FECHA BETWEEN '{$this->getDesde()}' and '{$this->getHasta()}' ";
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
					"FECHA"=>$fila[0],
					"CENTRO"=>$fila[1],
					"1_1"=>$fila[2],
					"1_2"=>$fila[3],
					"1_3"=>$fila[4],
					"1_4"=>$fila[5],
					"1_5"=>$fila[6],
					"1_6"=>$fila[7],
					"2_1"=>$fila[8],
					"2_2"=>$fila[9],
					"2_3"=>$fila[10],
					"2_4"=>$fila[11],
					"2_5"=>$fila[12],
					"2_6"=>$fila[13],
					"3_1"=>$fila[14],
					"3_2"=>$fila[15],
					"3_3"=>$fila[16],
					"3_4"=>$fila[17],
					"3_5"=>$fila[18],
					"3_6"=>$fila[19],
					"4_1"=>$fila[20],
					"4_2"=>$fila[21],
					"4_3"=>$fila[22],
					"4_4"=>$fila[23],
					"4_5"=>$fila[24],
					"4_6"=>$fila[25],
					"5_1"=>$fila[26],
					"5_2"=>$fila[27],
					"5_3"=>$fila[28],
					"5_4"=>$fila[29],
					"5_5"=>$fila[30],
					"5_6"=>$fila[31],
					"6_1"=>$fila[32],
					"6_2"=>$fila[33],
					"6_3"=>$fila[34],
					"6_4"=>$fila[35],
					"6_5"=>$fila[36],
					"6_6"=>$fila[37],
					"7_1"=>$fila[38],
					"7_2"=>$fila[39],
					"7_3"=>$fila[40],
					"7_4"=>$fila[41],
					"7_5"=>$fila[42],
					"7_6"=>$fila[43],
					"8_1"=>$fila[44],
					"8_2"=>$fila[45],
					"8_3"=>$fila[46],
					"8_4"=>$fila[47],
					"8_5"=>$fila[48],
					"8_6"=>$fila[49]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}


	public function CAMIN_OBTENER_DATOS_TABLA_EXCEL_SEIS($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT CAM.FECHA AS 'FECHA',CAM.CENTRO AS 'CENTRO',SUM(CAM.1_1)	AS '1_1',SUM(CAM.1_2)	AS '1_2',SUM(CAM.1_3)	AS '1_3',SUM(CAM.1_4)	AS '1_4',SUM(CAM.1_5)	AS '1_5',SUM(CAM.1_6)	AS '1_6',SUM(CAM.2_1)	AS '2_1',SUM(CAM.2_2)	AS '2_2',SUM(CAM.2_3)	AS '2_3',SUM(CAM.2_4)	AS '2_4',SUM(CAM.2_5)	AS '2_5',SUM(CAM.2_6)	AS '2_6',SUM(CAM.3_1)	AS '3_1',SUM(CAM.3_2)	AS '3_2',SUM(CAM.3_3)	AS '3_3',SUM(CAM.3_4)	AS '3_4',SUM(CAM.3_5)	AS '3_5',SUM(CAM.3_6)	AS '3_6',SUM(CAM.4_1)	AS '4_1',SUM(CAM.4_2)	AS '4_2',SUM(CAM.4_3)	AS '4_3',SUM(CAM.4_4)	AS '4_4',SUM(CAM.4_5)	AS '4_5',SUM(CAM.4_6)	AS '4_6',SUM(CAM.5_1)	AS '5_1',SUM(CAM.5_2)	AS '5_2',SUM(CAM.5_3)	AS '5_3',SUM(CAM.5_4)	AS '5_4',SUM(CAM.5_5)	AS '5_5',SUM(CAM.5_6)	AS '5_6',SUM(CAM.6_1)	AS '6_1',SUM(CAM.6_2)	AS '6_2',SUM(CAM.6_3)	AS '6_3',SUM(CAM.6_4)	AS '6_4',SUM(CAM.6_5)	AS '6_5',SUM(CAM.6_6)	AS '6_6',SUM(CAM.7_1)	AS '7_1',SUM(CAM.7_2)	AS '7_2',SUM(CAM.7_3)	AS '7_3',					SUM(CAM.7_4)	AS '7_4',SUM(CAM.7_5)	AS '7_5',SUM(CAM.7_6)	AS '7_6',SUM(CAM.8_1)	AS '8_1',SUM(CAM.8_2)	AS '8_2',SUM(CAM.8_3)	AS '8_3',SUM(CAM.8_4)	AS '8_4',SUM(CAM.8_5)	AS '8_5',SUM(CAM.8_6)	AS '8_6' FROM CAMPANA_RESUMEN CAM WHERE CAM.FECHA BETWEEN '{$this->getDesde()}' and '{$this->getHasta()}' AND CAM.CENTRO_ID = {$this->getCentro()}";
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
					"FECHA"=>$fila[0],
					"CENTRO"=>$fila[1],
					"1_1"=>$fila[2],
					"1_2"=>$fila[3],
					"1_3"=>$fila[4],
					"1_4"=>$fila[5],
					"1_5"=>$fila[6],
					"1_6"=>$fila[7],
					"2_1"=>$fila[8],
					"2_2"=>$fila[9],
					"2_3"=>$fila[10],
					"2_4"=>$fila[11],
					"2_5"=>$fila[12],
					"2_6"=>$fila[13],
					"3_1"=>$fila[14],
					"3_2"=>$fila[15],
					"3_3"=>$fila[16],
					"3_4"=>$fila[17],
					"3_5"=>$fila[18],
					"3_6"=>$fila[19],
					"4_1"=>$fila[20],
					"4_2"=>$fila[21],
					"4_3"=>$fila[22],
					"4_4"=>$fila[23],
					"4_5"=>$fila[24],
					"4_6"=>$fila[25],
					"5_1"=>$fila[26],
					"5_2"=>$fila[27],
					"5_3"=>$fila[28],
					"5_4"=>$fila[29],
					"5_5"=>$fila[30],
					"5_6"=>$fila[31],
					"6_1"=>$fila[32],
					"6_2"=>$fila[33],
					"6_3"=>$fila[34],
					"6_4"=>$fila[35],
					"6_5"=>$fila[36],
					"6_6"=>$fila[37],
					"7_1"=>$fila[38],
					"7_2"=>$fila[39],
					"7_3"=>$fila[40],
					"7_4"=>$fila[41],
					"7_5"=>$fila[42],
					"7_6"=>$fila[43],
					"8_1"=>$fila[44],
					"8_2"=>$fila[45],
					"8_3"=>$fila[46],
					"8_4"=>$fila[47],
					"8_5"=>$fila[48],
					"8_6"=>$fila[49]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}
} // END class

?>