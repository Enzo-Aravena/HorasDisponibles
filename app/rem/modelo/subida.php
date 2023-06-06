<?php

class SubidaArchivo{
	private $fecha;
	private $nombreProf;
	private $usuario;
	private $nombreArchivOriginal;
	private $nombreArchivoServer;
	private $centro;
	private $serie;
	private $mes;
	private $anio;
	private $envio;
	private $mensaje;
	private $tipo;

	//GETTERS AND SETTERS
	public function getFecha(){
		return $this->fecha;
	}

	public function setFecha($fecha){
		$this->fecha = $fecha;
	}

	public function getNombreProf(){
		return $this->nombreProf;
	}

	public function setNombreProf($nombreProf){
		$this->nombreProf = $nombreProf;
	}


	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getNombreArchivOriginal(){
		return $this->nombreArchivOriginal;
	}

	public function setNombreArchivOriginal($nombreArchivOriginal){
		$this->nombreArchivOriginal = $nombreArchivOriginal;
	}


	public function getNombreArchivoServer(){
		return $this->nombreArchivoServer;
	}

	public function setNombreArchivoServer($nombreArchivoServer){
		$this->nombreArchivoServer = $nombreArchivoServer;
	}


	public function getCentro(){
		return $this->centro;
	}

	public function setCentro($centro){
		$this->centro= $centro;
	}

	public function getSerie(){
		return $this->serie;
	}

	public function setSerie($serie){
		$this->serie = $serie;
	}

	public function getMes(){
		return $this->mes;
	}

	public function setMes($mes){
		$this->mes= $mes;
	}

	public function getAnio(){
		return $this->anio;
	}

	public function setAnio($anio){
		$this->anio= $anio;
	}

	public function getEnvio(){
		return $this->envio;
	}

	public function setEnvio($envio){
		$this->envio = $envio;
	}

	public function getMensaje(){
		return $this->mensaje;
	}

	public function setMensaje($mensaje){
		$this->mensaje = $mensaje;
	}


	public function getTipo(){
		return $this->tipo;
	}

	public function setTipo($tipo){
		$this->tipo = $tipo;
	}

	public function RegistraSubidaRem($bd){
		$data = "";
		$sql= "call InsertToRem('{$this->getFecha()}','{$this->getNombreProf()}','{$this->getUsuario()}','{$this->getNombreArchivOriginal()}','{$this->getNombreArchivoServer()}','{$this->getCentro()}','{$this->getSerie()}','{$this->getMes()}','{$this->getAnio()}','{$this->getEnvio()}','{$this->getMensaje()}','{$this->getTipo()}')";
		$resultado = mysqli_query($bd,$sql);
		return $resultado;
	}

}

?>