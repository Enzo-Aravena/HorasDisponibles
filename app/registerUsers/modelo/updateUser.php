<?php
class BuscaryModificar{
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
	private $sexo;

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

	public function getReingClave(){
		return $this->reingClave;
	}

	public function setReingClave(){
		$this->reingClave = $reingClave;
	}

	public function getSexo(){
		return $this->sexo;
	}

	public function setSexo($sexo){
		$this->sexo = $sexo;
	}



//call updateUsuarios('189924658','maria','lopes','sadsa','1994-02-18','centro','mhenriquez','admin123','sadsad','A',1);

	public function buscarUsuario($bd){
		//call searchToData('18992465-8');
		$i=0;
		$data = Array();
		$sql = "call searchToData";
		$sql.= "('{$this->getRut()}')";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			
			while ($fila = mysqli_fetch_row($resultado)) {	
				
				$data[$i] = Array(
				"data"			=>"1",
				"rut" 			=> utf8_encode($fila[0]),				
				"apat" 			=> utf8_encode($fila[1]),
				"amat" 			=> utf8_encode($fila[2]),
				"nombre" 		=> utf8_encode($fila[3]),
				"fnac" 			=> utf8_encode($fila[4]),
				"sexo" 			=> utf8_encode($fila[5]),
				"centro" 		=> utf8_encode($fila[6]),
				"encriptacion" 	=> utf8_encode($fila[7]),
				"usuario" 		=> utf8_encode($fila[8]),
				"estado" 		=> utf8_encode($fila[9]),
				"idPerfil" 		=> utf8_encode($fila[10])

				);//end array
			
			$i++;
			}//end while
		}//fin else
		return $data;
	}



	public function modificarDataUsuario($bd){
		$i=0;
		$data = Array();
		$sql = "call updateUsuarios";
		$sql.= "('{$this->getRut()}','{$this->getNombre()}','{$this->getApat()}','{$this->getAmat()}','{$this->getFnac()}','{$this->getSexo()}','{$this->getCentro()}','{$this->getEstado()}','{$this->getTipoPerfil()}') ";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		
		if ($count == "0") {
			$data[0] = array(
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


	public function traerClaveUsuarios($bd){
		$i=0;
		$data = Array();
		$sql = "call traerClaveUsuarios";
		$sql.= "('{$this->getUsuario()}')";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			
			while ($fila = mysqli_fetch_row($resultado)) {	
				
				$data[$i] = Array(
				"data"			=>"1",
				"Usuario" 	=> $fila[0],
				"encriptacion" 	=> $fila[1]
				);//end array
			
			$i++;
			}//end while
		}//fin else
		return $data;
	}

	public function cambiarContrasena($bd){
		$i=0;
		$data = Array();
		$sql = "call cambiarClave";
		$sql.= "('{$this->getUsuario()}','{$this->getClave()}') ";
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

	public function MostrarPerfiles($bd){
		$i=0;
		$data = Array();
		$sql = "call searchNamePerfiles()";		
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

} //fin clase principal

?>