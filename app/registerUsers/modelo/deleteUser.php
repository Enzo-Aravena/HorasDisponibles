<?php

class DeleteUsers{	
/*	private $rut;
	

	// GETTERS AND SETTERS
	//rut
	public function getRut(){
		return $this->rut;
	}


	public function setRut($rut){
		$this->rut=$rut;
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
				"rut" 			=> $fila[0],
				"nombre" 		=> $fila[1],
				"apellidos" 	=> $fila[2],
				"fnac" 			=> $fila[3],
				"sexo" 			=> $fila[4],
				"descripcion" 	=> $fila[5],
				"centro" 		=> $fila[6],
				"usuario" 		=> $fila[7],
				"encriptacion" 	=> $fila[8],
				"estado" 		=> $fila[9],
				"id" 			=> $fila[10]
				);//end array
		  $i++;
		}//end while
		}//fin else
		return $data;
	}*/


}
?>