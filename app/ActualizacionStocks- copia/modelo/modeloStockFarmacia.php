<?php

 class ModeloStock{
 	
 	
 	private $usuario;
	private $profesional;
 	private $codigo;
 	private $medicamento;
 	private $almacen;
 	private $maximo;
 	private $critico;
 	private $fechaSubida;


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
		$sql= "select distinct CODIGO_MATERIAL,NOMBRE_MATERIAL from z_parametros_stocks";
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


	public function actualizarStcokEnFarmacia($bd){
		$i=0;
		$sql="update z_parametros_stocks set MAXIMO = {$this->getMaximo()}, CRITICO = {$this->getCritico()} where CODIGO_MATERIAL = '{$this->getCodigo()}' and ALM_ID = {$this->getAlmacen()};";
		$resultado = mysqli_query($bd,$sql);
		return $resultado;
	}


	public function IngresoLogActualizacionStock($bd){
		$i=0;
		$sql=" call db_pagina_rc.IngresoLogActualizacionStock('{$this->getUsuario()}', '{$this->getProfesional()}',{$this->getMedicamento()},{$this->getAlmacen()},{$this->getMaximo()},{$this->getCritico()}, '{$this->getFechaSubida()}');";
		$resultado = mysqli_query($bd,$sql);
		return $resultado;
	}



 } // fin clase menu



?>
