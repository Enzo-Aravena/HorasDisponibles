<?php

class Menu{
	private $usuario;

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}


	public function menuUsuario($bd){
		$i=0;
		$data = Array();
		$sql="call db_pagina_rc.redirectToMenu('{$this->getUsuario()}')";
		//$sql.= "('{$this->getUsuario()}')";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			
			while ($fila = mysqli_fetch_row($resultado)) {	
				
				$data[$i] = Array(
					"data" 		=> "1",				
					"nombre"    => utf8_encode($fila[0]),
					"url" 		=> utf8_encode($fila[1]),
					"imagen"    => utf8_encode($fila[2])
				);//end array
			
			$i++;
			}//end while
		}//fin else
		return $data;
	}
	

}


?>