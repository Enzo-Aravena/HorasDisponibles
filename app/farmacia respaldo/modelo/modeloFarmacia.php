<?php

class claseFarmacia{

	private $codigo;
	private $material;
	private $centro;
	private $desde;
	private $hasta;
	private $critico;
	private $critico1;
	private $critico2;

	public function getCodigo(){
		return $this->codigo;
	}

	public function setCodigo($codigo){
		$this->codigo = $codigo;
	}

	public function getMaterial(){
		return $this->material;
	}

	public function setMaterial($material){
		$this->material = $material;
	}

	public function getCentro(){
		return $this->centro;
	}

	public function setCentro($centro){
		$this->centro = $centro;
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

	public function getCritico(){
		return $this->critico;
	}

	public function setCritico($critico){
		$this->critico = $critico;
	}


	public function getCritico1(){
		return $this->critico1;
	}

	public function setCritico1($critico1){
		$this->critico1 = $critico1;
	}

	public function getCritico2(){
		return $this->critico2;
	}

	public function setCritico2($critico2){
		$this->critico2 = $critico2;
	}
	

	// LLAMA A UN SP QUE CARGA LA DATA DEL CAMPO SELECT
	public function uploadSelectData($bd){
		$i = 0;
		$data = Array();
		$sql= "call uploadSelectData()";
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
					"codigo" => utf8_encode($fila[0]),
					"material" => utf8_encode($fila[1])
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}


	public function DATOS_FARMACIA_UNO($bd){

		$i = 0;
		$data = Array();
		$sql= "call DATOS_FARMACIA_UNO('{$this->getDesde()}','{$this->getHasta()}','{$this->getCritico1()}','{$this->getCritico2()}')";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0",
				"fecha" => "0",
				"centro" =>"0",
				"codigo" => "0",
				"material" =>"0",
				"stockInicial" => "0",
				"nDeIngresos" => "0",
				"totalDispensadas" => "0",
				"totalEgresos" => "0",
				"stockFinal" => "0",
				"maximo" => "0",
				"critico" => "0",
				"estado" => "0",
				"solicitar" => "0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i]= Array(
					"data" => "1",					
					"fecha" => $fila[0],
					"centro" =>utf8_encode($fila[1]),
					"codigo" => $fila[2],
					"material" => ucfirst(strtolower(utf8_encode($fila[3]))),
					"stockInicial" => $fila[4],
					"nDeIngresos" => $fila[5],
					"totalDispensadas" => $fila[6],
					"totalEgresos" => $fila[7],
					"stockFinal" => $fila[8],
					"maximo" => $fila[9],
					"critico" => $fila[10],
					"estado" => $fila[11],					
					"solicitar" => $fila[12]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}

	public function DATOS_FARMACIA_DOS($bd){
		$i = 0;
		$data = Array();
		$sql = "call DATOS_FARMACIA_DOS({$this->getCentro()},'{$this->getDesde()}','{$this->getHasta()}','{$this->getCritico1()}','{$this->getCritico2()}')";

		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0",
				"fecha" => "0",
				"centro" =>"0",
				"codigo" => "0",
				"material" =>"0",
				"stockInicial" => "0",
				"nDeIngresos" => "0",
				"totalDispensadas" => "0",
				"totalEgresos" => "0",
				"stockFinal" => "0",
				"maximo" => "0",
				"critico" => "0",
				"estado" => "0",
				"solicitar" => "0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i]= Array(
					"data" => "1",					
					"fecha" => $fila[0],
					"centro" =>utf8_encode($fila[1]),
					"codigo" => $fila[2],
					"material" => ucfirst(strtolower(utf8_encode($fila[3]))),
					"stockInicial" => $fila[4],
					"nDeIngresos" => $fila[5],
					"totalDispensadas" => $fila[6],
					"totalEgresos" => $fila[7],
					"stockFinal" => $fila[8],
					"maximo" => $fila[9],
					"critico" => $fila[10],
					"estado" => $fila[11],					
					"solicitar" => $fila[12]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}
	
	public function DATOS_FARMACIA_TRES($bd){
		$i = 0;
		$data = Array();
		//$sql = "call DATOS_FARMACIA_TRES('{$this->getCodigo()}','{$this->getDesde()}','{$this->getHasta()}','{$this->getCritico1()}','{$this->getCritico2()}')";

		$sql = "SELECT DATE_FORMAT(FECHA_CARGA, '%d/%m/%Y') AS 'FECHA', CENTRO AS 'CENTRO',IFNULL(CODIGO_MATERIAL,'-') as 'CODIGO',IFNULL(NOMBRE_MATERIAL,'-') AS 'MATERIAL',
			    IFNULL(STOCK_INICIAL ,'-')  AS 'STOCK_INICIAL',IFNULL(TOTAL_INGRESOS,'-')  AS 'TOTAL_INGRESOS',IFNULL(TOTAL_DISPENSADAS,'-')  AS 'TOTAL_DISPENSADAS',
			    IFNULL(TOTAL_EGRESOS,'-')  AS 'TOTAL_EGRESOS_OTROS',IFNULL(STOCK_FINAL,'-')   AS 'STOCK_FINAL',IFNULL(MAXIMO,'-')  AS 'MAXIMO',IFNULL(CRITICO,'-')  AS 'CRITICO',
			    IFNULL(ESTADO_SOLICITUD,'-') AS 'ESTADO_SOLICITUD',IFNULL(SOLICITAR,'-')  AS 'SOLICITAR' FROM OMI_MOVIMIENTOS_FARMACIA WHERE  CODIGO_MATERIAL in ({$this->getCodigo()})
			    AND FECHA_CARGA BETWEEN '{$this->getDesde()}' and '{$this->getHasta()}' AND ESTADO_SOLICITUD IN ('{$this->getCritico1()}','{$this->getCritico2()}') ORDER BY FECHA,CENTRO_ORDENADO, CODIGO ASC;";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0",
				"fecha" => "0",
				"centro" =>"0",
				"codigo" => "0",
				"material" =>"0",
				"stockInicial" => "0",
				"nDeIngresos" => "0",
				"totalDispensadas" => "0",
				"totalEgresos" => "0",
				"stockFinal" => "0",
				"maximo" => "0",
				"critico" => "0",
				"estado" => "0",
				"solicitar" => "0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i]= Array(
					"data" => "1",
					"fecha" => $fila[0],
					"centro" =>utf8_encode($fila[1]),
					"codigo" => $fila[2],
					"material" => ucfirst(strtolower(utf8_encode($fila[3]))),
					"stockInicial" => $fila[4],
					"nDeIngresos" => $fila[5],
					"totalDispensadas" => $fila[6],
					"totalEgresos" => $fila[7],
					"stockFinal" => $fila[8],
					"maximo" => $fila[9],
					"critico" => $fila[10],
					"estado" => $fila[11],				
					"solicitar" => $fila[12]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;	
	}

	public function DATOS_FARMACIA_CUATRO($bd){
		$i = 0;
		$data = Array();
		//$sql = "call DATOS_FARMACIA_CUATRO('{$this->getCodigo()}' ,{$this->getCentro()},'{$this->getDesde()}','{$this->getHasta()}','{$this->getCritico1()}','{$this->getCritico2()}' )";
		$sql = "SELECT DATE_FORMAT(FECHA_CARGA, '%d/%m/%Y') AS 'FECHA', CENTRO AS 'CENTRO',IFNULL(CODIGO_MATERIAL,'-') as 'CODIGO',IFNULL(NOMBRE_MATERIAL,'-') AS 'MATERIAL',
	    IFNULL(STOCK_INICIAL ,'-')  AS 'STOCK_INICIAL',IFNULL(TOTAL_INGRESOS,'-')  AS 'TOTAL_INGRESOS',IFNULL(TOTAL_DISPENSADAS,'-')  AS 'TOTAL_DISPENSADAS',
	    IFNULL(TOTAL_EGRESOS,'-')  AS 'TOTAL_EGRESOS_OTROS',IFNULL(STOCK_FINAL,'-')   AS 'STOCK_FINAL',IFNULL(MAXIMO,'-')  AS 'MAXIMO',IFNULL(CRITICO,'-')  AS 'CRITICO',
	    IFNULL(ESTADO_SOLICITUD,'-') AS 'ESTADO_SOLICITUD',IFNULL(SOLICITAR,'-')  AS 'SOLICITAR' FROM OMI_MOVIMIENTOS_FARMACIA WHERE CODIGO_MATERIAL in ({$this->getCodigo()}) AND 
	    CEN_ID IN ({$this->getCentro()}) AND FECHA_CARGA BETWEEN  '{$this->getDesde()}' and '{$this->getHasta()}'  AND ESTADO_SOLICITUD IN ('{$this->getCritico1()}','{$this->getCritico2()}') 
	    ORDER BY FECHA,CENTRO_ORDENADO, CODIGO ASC";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0",
				"fecha" => "0",
				"centro" =>"0",
				"codigo" => "0",
				"material" =>"0",
				"stockInicial" => "0",
				"nDeIngresos" => "0",
				"totalDispensadas" => "0",
				"totalEgresos" => "0",
				"stockFinal" => "0",
				"maximo" => "0",
				"critico" => "0",
				"estado" => "0",
				"solicitar" => "0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i]= Array(
					"data" => "1",
					"fecha" => $fila[0],
					"centro" =>utf8_encode($fila[1]),
					"codigo" => $fila[2],
					"material" => ucfirst(strtolower(utf8_encode($fila[3]))),
					"stockInicial" => $fila[4],
					"nDeIngresos" => $fila[5],
					"totalDispensadas" => $fila[6],
					"totalEgresos" => $fila[7],
					"stockFinal" => $fila[8],
					"maximo" => $fila[9],
					"critico" => $fila[10],
					"estado" => $fila[11],
					"solicitar" => $fila[12]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;	
	}



} // fin clase pricipal

?>