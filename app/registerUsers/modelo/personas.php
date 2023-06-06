<?php

class Personas{	
	private $rut;
	private $nombre;
	private $apat;
	private $amat;
	private $fnac;
	private $usuario;

	// GETTERS AND SETTERS
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

	//usuario
	public function getUsuario(){
		return $this->usuario;
	}


	public function setUsuario($usuario){
		$this->usuario=$usuario;
	}



	//Metodo que busca un usuario
	public function BuscarNombre($bd){
		$i=0;
		$data = Array();
		$sql="call buscarPorNombre";
		$sql.="('{$this->getNombre()}')";
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
				"nombre" 		=> utf8_encode($fila[1]),
				"apellidos" 	=> utf8_encode($fila[2]),
				"fnac" 			=> utf8_encode($fila[3]),
				"sexo" 			=> utf8_encode($fila[4]),
				"descripcion" 	=> utf8_encode($fila[5]),
				"centro" 		=> utf8_encode($fila[6]),
				"usuario" 		=> utf8_encode($fila[7]),
				"encriptacion" 	=> utf8_encode($fila[8]),
				"estado" 		=> utf8_encode($fila[9])
				);//end array
			
			$i++;
			}//end while
		}//fin else
		return $data;
	}


//Busca por el rut  del  la persona
public function BuscarPorRut($bd){
		$i=0;
		$data = Array();
		$sql="call buscarPorRut";
		$sql.="('{$this->getRut()}')";
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
				"rut" 			=> utf8_encode($fila[0]),
				"nombre" 		=> utf8_encode($fila[1]),
				"apellidos" 	=> utf8_encode($fila[2]),
				"fnac" 			=> utf8_encode($fila[3]),
				"sexo" 			=> utf8_encode($fila[4]),
				"descripcion" 	=> utf8_encode($fila[5]),
				"centro" 		=> utf8_encode($fila[6]),
				"usuario" 		=> utf8_encode($fila[7]),
				"encriptacion" 	=> utf8_encode($fila[8]),
				"estado" 		=> utf8_encode($fila[9])
				);//end array
		  $i++;		
		}//end while
		}//fin else
		return $data;
	}



	public function BuscarPorUsuario($bd){
		$i=0;
		$data = Array();
		$sql="call buscarPorUsuario";
		$sql.="('{$this->getUsuario()}')";
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
				"rut" 			=> utf8_encode($fila[0]),
				"nombre" 		=> utf8_encode($fila[1]),
				"apellidos" 	=> utf8_encode($fila[2]),
				"fnac" 			=> utf8_encode($fila[3]),
				"sexo" 			=> utf8_encode($fila[4]),
				"descripcion" 	=> utf8_encode($fila[5]),
				"centro" 		=> utf8_encode($fila[6]),
				"usuario" 		=> utf8_encode($fila[7]),
				"encriptacion" 	=> utf8_encode($fila[8]),
				"estado" 		=> utf8_encode($fila[9])
				);//end array
		  $i++;
		}//end while
		}//fin else
		return $data;
	}


	// Busca todos los datos
	public function MostrarTodo($bd){		
		$i=0;
		$data = Array();
		$sql="call buscarTodo()";
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
				"rut" 			=> utf8_encode($fila[0]),
				"nombre" 		=> utf8_encode($fila[1]),
				"apellidos" 	=> utf8_encode($fila[2]),
				"fnac" 			=> utf8_encode($fila[3]),
				"sexo" 			=> utf8_encode($fila[4]),
				"descripcion" 	=> utf8_encode($fila[5]),
				"centro" 		=> utf8_encode($fila[6]),
				"usuario" 		=> utf8_encode($fila[7]),
				"encriptacion" 	=> utf8_encode($fila[8]),
				"estado" 		=> utf8_encode($fila[9]),
				"id" 			=> $fila[10]
				);//end array
		  $i++;
		}//end while
		}//fin else
		return $data;
	}


}
?>