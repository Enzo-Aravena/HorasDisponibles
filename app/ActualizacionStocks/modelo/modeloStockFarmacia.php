<?php

 class ModeloStock{
 	
 	
 	private $usuario;
 	private $id;
	private $profesional;
 	private $codigo;
 	private $medicamento;
 	private $almacen;
 	private $maximo;
 	private $critico;
 	private $fechaSubida;

 	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

 	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}
	public function getProfesional(){
		return $this->profesional;
	}

	public function setProfesional($profesional){
		$this->profesional = $profesional;
	}


 	public function getCodigo(){
 		return $this->codigo;
 	}

 	public function setCodigo($codigo){
 		return $this->codigo = $codigo;
 	}

 	public function getMedicamento(){
 		return $this->medicamento;
 	}

 	public function setMedicamento($medicamento){
 		return $this->medicamento = $medicamento;
 	}

 	public function getAlmacen(){
 		return $this->almacen;
 	}

 	public function setAlmacen($almacen){
 		return $this->almacen = $almacen;
 	}

 	public function getMaximo(){
 		return $this->maximo;
 	}

 	public function setMaximo($maximo){
 		return $this->maximo = $maximo;
 	}

 	public function getCritico(){
 		return $this->critico;
 	}

 	public function setCritico($critico){
 		return $this->critico = $critico;
 	}

 	public function getFechaSubida(){
		return $this->fechaSubida;
	}

	public function setFechaSubida($fechaSubida){
		$this->fechaSubida = $fechaSubida;
	}

 	
 	// LLAMA A UN SP QUE CARGA LA DATA DEL CAMPO SELECT
	public function uploadSelectData($bd){
		$i = 0;
		$data = Array();
		$sql= "select distinct CODIGO_MATERIAL,NOMBRE_MATERIAL from z_parametros_stocks order by NOMBRE_MATERIAL asc";
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


	public function obtenerTablaAModificar($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT NOMBRE_ALMACEN,CODIGO_MATERIAL, NOMBRE_MATERIAL, MAXIMO,CRITICO FROM z_parametros_stocks where CODIGO_MATERIAL in ({$this->getMaximo()}) and ALM_ID = {$this->getAlmacen()}";
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
					"NOMBRE_ALMACEN" => utf8_encode($fila[0]),
					"CODIGO_MATERIAL" => utf8_encode($fila[1]),
					"NOMBRE_MATERIAL" => utf8_encode($fila[2]),
					"MAXIMO" => utf8_encode($fila[3]),
					"CRITICO" => utf8_encode($fila[4])
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}

	public function actualizarStcokEnFarmacia($bd){
		$arreglo = $this->getId();
		// Muestra la actualizacion de stock
		foreach ($arreglo as $key => $value) {
			$sql="update z_parametros_stocks set MAXIMO =".$value["maximo"]." , CRITICO = ".$value["critico"]." where CODIGO_MATERIAL = '".$value["codigo"]."' and ALM_ID =".$value["almacen"]."";
			$resultado = mysqli_query($bd,$sql);
		}
		return $resultado;
	}

	public function IngresoLogActualizacionStock($bd){
		$i=1;
		$arreglo = $this->getId();
		foreach ($arreglo as $key => $value) {
			$sql = "INSERT INTO logCargaStock(usuario, profesional, medicamento, almacen, stockMaximo, stockCritico, fechaCarga) VALUES('{$this->getUsuario()}', '{$this->getProfesional()}','".$value["codigo"]."','".$value["almacen"]."','".$value["maximo"]."','".$value["critico"]."','{$this->getFechaSubida()}')";
			$resultado = mysqli_query($bd,$sql);
		}
	
		return $resultado;
	}

 } // fin clase menu

?>