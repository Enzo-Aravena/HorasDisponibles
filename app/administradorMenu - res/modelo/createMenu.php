<?php

 class CreateMenu{
 	//nombre,tipoPerfil,detalleRuta

 	private $nombre;
 	private $nomImagen;
 	private $detalleRuta;
 	private $idMenu;
 	private $perfil;


 	//Getters and setters

 	public function getIdMenu(){
 		return $this->idMenu;
 	}

 	public function setIdMenu($idMenu){
 		return $this->idMenu = $idMenu;
 	}

 	public function getPerfil(){
 		return $this->perfil;
 	}

 	public function setPerfil($perfil){
 		return $this->perfil = $perfil;
 	}

 	public function getNombre(){
 		return $this->nombre;
 	}

 	public function setNombre($nombre){
 		return $this->nombre = $nombre;
 	}

 	public function getNomImagen(){
 		return $this->nomImagen;
 	}

 	public function setNomImagen($nomImagen){
 		return $this->nomImagen = $nomImagen;
 	}

 	public function getDetalleRuta(){
 		return $this->detalleRuta;
 	}

 	public function setDetalleRuta($detalleRuta){
 		return $this->detalleRuta = $detalleRuta;
 	}



	 public function BUSCAR_MENU($bd){		
		$i=0;
		$data = Array();
		$sql="SELECT idMenu,nombreMenu ,url,imagen from menu   order by nombreMenu asc";
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
				"idMenu"	=>$fila[0],
				"nombre" 	=> $fila[1],
				"menu" 		=> $fila[2],
				"imagen" 	=> $fila[3]
				);//end array
		  $i++;
		}//end while
		}//fin else
		return $data;
	}

	 public function searchByNombreMenu($bd){		
		$i=0;
		$data = Array();
		$sql="call searchByNombreMenu('{$this->getNombre()}')";
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
				"nombre" 	=> $fila[0],
				"menu" 		=> $fila[1],
				"imagen" 	=> $fila[2]
				);//end array
		  $i++;
		}//end while
		}//fin else
		return $data;
	}


 	public function CreateToMenu($bd){
 		$i=0;
		$data = Array();
 		$sql = "call CreateToNewMenu";
 		$sql.="('{$this->getNombre()}','{$this->getDetalleRuta()}','{$this->getNomImagen()}')";
 		$resultado= mysqli_query($bd,$sql);
 		$count = mysqli_num_rows($resultado);
 		if ($count == "0") {
			$data = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"		=>"1",
				"res"	=>$fila[0]
				
				);//end array
		  $i++;
		}//end while
		}//fin else
		return $data;
 	}

 	
 	public function TraerData($bd){
 		$i=0;
		$data = Array();
		$sql="  call traerDataModificar({$this->getIdMenu()})";
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
				"idMenu"	=>$fila[0],
				"nombre" 	=> $fila[1],
				"menu" 		=> $fila[2],
				"imagen" 	=> $fila[3]
				);//end array
		  $i++;
		}//end while
		}//fin else
		return $data;
 	}

 	public function modificarMenu($bd){
		$i=0;
		$data = Array();
		$sql = "call ModifyMenu";
		$sql.= "('{$this->getNombre()}','{$this->getDetalleRuta()}','{$this->getNomImagen()}','{$this->getIdMenu()}') ";
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
				"res"	=>$fila[0]
				
				);//end array
		  $i++;
		}//end while
		}//fin else
		return $data;

	}


public function searchNameMenu($bd){
 		$i=0;
		$data = Array();
		$sql="call searchNameMenu()";
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
				"idMenu"	=>$fila[0],
				"nombre"	=>$fila[1]
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
				"nombre"	=>$fila[1]
				);//end array
		  $i++;
		}//end while
		}//fin else
		return $data;

}

public function insertNavMenu($bd){
 		$i=0;
		$data = Array();
		$sql="call insertarNavMenu({$this->getPerfil()},{$this->getIdMenu()})";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"	=>"1",
				"respuesta"	=>$fila[0]
				);//end array
		  $i++;
		}//end while
		}//fin else
		return $data;

}


public function eliminarNavMenu($bd){
 		$i=0;
		$data = Array();
		$sql="call eliminarNavMenu({$this->getIdMenu()})";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"	=>"1",
				"respuesta"	=>$fila[0]
				);//end array
		  $i++;
		}//end while
		}//fin else
		return $data;

}


public function eliminarMenu($bd){
 		$i=0;
		$data = Array();
		$sql="call eliminarMenu({$this->getIdMenu()})";
		$resultado = mysqli_query($bd,$sql);
		}

 } // fin clase menu


?>