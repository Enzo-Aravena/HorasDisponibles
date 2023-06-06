<?php
class ModificarEstado{
	private $rutUser;
	private $estado;

	public function getRutUser(){
		return $this->rutUser;
	}

	public function setRutUser($rutUser){
		$this->rutUser = $rutUser;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado=$estado;
	}


	public function llamarEstado($bd){
		$i=0;
		$data = Array();
		$sql = "call SeleccionarEstado";
		$sql.= "('{$this->getRutUser()}') ";
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
				"estado" 		=> $fila[0]				
				);//end array
			
			$i++;
			}//end while
		}//fin else
		return $data;

	}



	public function modificarEstadoUsuario($bd){
		$i=0;
		$data = Array();
		$sql = "call modificarEstado";
		$sql.= "('{$this->getRutUser()}','{$this->getEstado()}') ";
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

	
 
	
}	// finb clase principal


?>