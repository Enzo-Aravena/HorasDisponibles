<?php
class claseDental{
	private $usuario;
	private $profesional;
	private $rutPaciente;
	private $dniPaciente;
	private $nombrePaciente;
	private $cantidadImagenes;
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

	public function getRutPaciente(){
		return $this->rutPaciente;
	}

	public function setRutPaciente($rutPaciente){
		$this->rutPaciente = $rutPaciente;
	}


	public function getDniPaciente(){
		return $this->dniPaciente;
	}

	public function setDniPaciente($dniPaciente){
		$this->dniPaciente = $dniPaciente;
	}

	public function getNombrePaciente(){
		return $this->nombrePaciente;
	}

	public function setNombrePaciente($nombrePaciente){
		$this->nombrePaciente = $nombrePaciente;
	}

	public function getCantidadImagenes(){
		return $this->cantidadImagenes;
	}

	public function setCantidadImagenes($cantidadImagenes){
		$this->cantidadImagenes = $cantidadImagenes;
	}


	public function getFechaSubida(){
		return $this->fechaSubida;
	}

	public function setFechaSubida($fechaSubida){
		$this->fechaSubida = $fechaSubida;
	}


	public function IngresoLogImagenDental($bd){
		$data = "";
		//USUARIO,PROFESIONAL,RUTPAC,DNIPAC,NOMPACIENTE,CANTIMAGENES,FECHACARGA
		$sql= "call IngresoLogImagenDental('{$this->getUsuario()}','{$this->getProfesional()}','{$this->getRutPaciente()}','{$this->getDniPaciente()}','{$this->getNombrePaciente()}',{$this->getCantidadImagenes()},'{$this->getFechaSubida()}')";
		$resultado = mysqli_query($bd,$sql);
		return $resultado;
	}


}





?>