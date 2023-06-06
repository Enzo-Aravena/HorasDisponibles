<?php
class claseCargaDrogueria{
	private $usuario;
	private $profesional;
	private $archivo;
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

	public function getArchivo(){
		return $this->archivo;
	}

	public function setArchivo($archivo){
		$this->archivo = $archivo;
	}


	public function getFechaSubida(){
		return $this->fechaSubida;
	}

	public function setFechaSubida($fechaSubida){
		$this->fechaSubida = $fechaSubida;
	}


	public function IngresoLogCargaDrogueria($bd){
		$data = "";
		$sql = "CALL IngresoLogCargaDrogueria('{$this->getUsuario()}', '{$this->getProfesional()}', '{$this->getarchivo()}', '{$this->getFechaSubida()}');";
		$resultado = mysqli_query($bd,$sql);
		return $resultado;
	}


}





?>