<?php
class InsertData{
	private $rut;
	private $nombre;
	private $apat;
	private $amat;
	private $fnac;
	private $centro;
	private $usuario;
	private $clave;
	private $estado;
	private $tipoPerfil;
	private $sexoUsuario;

	/******  GETTERS AND SETTERS ********/

	//rut
	public function getRut(){
		return $this->rut;
	}


	public function setRut($rut){
		$this->rut=$rut;
	}

	//nombre
	public function getNombre(){
		return $this->nombre;
	}

	
	public function setNombre($nombre){
		$this->nombre=$nombre;
	}

	//apat
	public function getApat(){
		return $this->apat;
	}

	
	public function setApat($apat){
		$this->apat=$apat;
	}

	//amat
	public function getAmat(){
		return $this->amat;
	}

	
	public function setAmat($amat){
		$this->amat=$amat;
	}

	//fnac
	public function getFnac(){
		return $this->fnac;
	}

	public function setFnac($fnac){
		$this->fnac=$fnac;
	}

	//centro
	public function getCentro(){
		return $this->centro;
	}

	public function setCentro($centro){
		$this->centro=$centro;
	}

	//usuario
	public function getUsuario(){
		return $this->usuario;
	}


	public function setUsuario($usuario){
		$this->usuario=$usuario;
	}

	//clave
	public function getClave(){
		return $this->clave;
	}


	public function setClave($clave){
		$this->clave=$clave;
	}

	//estado
	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado=$estado;
	}

	//tipoPerfil
	public function getTipoPerfil(){
		return $this->tipoPerfil;
	}

	public function setTipoPerfil($tipoPerfil){
		$this->tipoPerfil=$tipoPerfil;
	}

	public function getSexoUsuario(){
		return $this->sexoUsuario;
	}

	public function setSexoUsuario($sexoUsuario){
		$this->sexoUsuario = $sexoUsuario;
	}


	public function insertarUsuario($bd){
		$i=0;
		$data = Array();
		$sql = "call crearUsuarios";
		$sql.= "('{$this->getRut()}','{$this->getNombre()}','{$this->getApat()}','{$this->getAmat()}','{$this->getFnac()}','{$this->getSexoUsuario()}','{$this->getCentro()}','{$this->getUsuario()}','{$this->getClave()}','{$this->getEstado()}','{$this->getTipoPerfil()}') ";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"			=>"1",
				"res" 			=> $fila[0]				
				);//end array
		  $i++;		
		}//end while
		}//fin else
		return $data;
	}

public function searchNamePerfiles($bd){
 		$i=0;
		$data = Array();
		$sql=" call searchNamePerfiles()";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"		=>"1",
				"id"	=>$fila[0],
				"nombre"	=> utf8_encode($fila[1])
				);//end array
		  $i++;
		}//end while
		}//fin else
		return $data;

}

public function CargarCentros($bd){
 		$i=0;
		$data = Array();
		$sql=" call CargarCentros()";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"		=>"1",
				"id"	=>$fila[0],
				"nombre"	=> utf8_encode($fila[1])
				);//end array
		  $i++;
		}//end while
		}//fin else
		return $data;

}



}// fin clase principal

?>