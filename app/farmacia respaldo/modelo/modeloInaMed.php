<?php

class claseInsumos{

	private $rut;
	private $desde;
	private $hasta;
	

	public function getRut(){
		return $this->rut;
	}

	public function setRut($rut){
		$this->rut = $rut;
	}


	public function getDesde(){
		return $this->desde;
	}

	public function setDesde($desde){
		$this->desde = $desde;
	}

	public function getHasta(){
		return $this->hasta;
	}

	public function setHasta($hasta){
		$this->hasta = $hasta;
	}


	public function mostrarPacientesBase($bd){
		$i = 0;
		$data = Array();
		$rut = $this->getRut();
		$desde = $this->getDesde();
		$hasta = $this->getHasta();

		if ($rut !== "" && $desde === "" && $hasta === "" ) {
			$sql= "CALL db_pagina_rc.OMI_MED_PENDIENTES('{$this->getRut()}',NULL,NULL);";
		}else{
			if ($desde !== "" && $hasta === "") {
				
				$sql= "CALL db_pagina_rc.OMI_MED_PENDIENTES(NULL, '{$this->getDesde()}', NULL);";
			}else{

			$sql= "CALL db_pagina_rc.OMI_MED_PENDIENTES(NULL, '{$this->getDesde()}', '{$this->getHasta()}');";
			}
		}
	
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i]= Array(
					"data" => "1",
					"CENTRO_DISPENSACION" => utf8_encode($fila[0]),
					"CODIGO_MEDICAMENTO" => $fila[1],
					"NOMBRE_MEDICAMENTO" => utf8_encode($fila[2]),
					"RUT_PACIENTE" => $fila[3],
					"NOMBRE_PACIENTE" => utf8_encode($fila[4]),
					"INICIO_TRATAMINETO" => $fila[5],
					"FECHA_ENTREGA" => $fila[6],
					"TIPO_RECETA" => utf8_encode($fila[7]),
					"CANTIDAD_NO_DISPENSADA" => $fila[8],
					"STOCK_INICIAL" => $fila[9],
					"STOCK_FINAL" => $fila[10]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}




	public function mostrarPacientes($bd){
		$i = 0;
		$data = Array();
		$sql= "CALL db_pagina_rc.OMI_MED_PENDIENTES(NULL,NULL,NULL);";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i]= Array(
					"data" => "1",
					"CENTRO_DISPENSACION" => utf8_encode($fila[0]),
					"CODIGO_MEDICAMENTO" => utf8_encode($fila[1]),
					"NOMBRE_MEDICAMENTO" => utf8_encode($fila[2]),
					"RUT_PACIENTE" => utf8_encode($fila[3]),
					"NOMBRE_PACIENTE" => utf8_encode($fila[4]),
					"INICIO_TRATAMINETO" => utf8_encode($fila[5]),
					"FECHA_ENTREGA" => utf8_encode($fila[6]),
					"TIPO_RECETA" => utf8_encode($fila[7]),
					"CANTIDAD_NO_DISPENSADA" => utf8_encode($fila[8]),
					"STOCK_INICIAL" => utf8_encode($fila[9]),
					"STOCK_FINAL" => utf8_encode($fila[10])
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}

	public function mostrarPacientesxRut($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT CENTRO_DISPENSACION, CODIGO_MEDICAMENTO, NOMBRE_MEDICAMENTO, RUT_PACIENTE, NOMBRE_PACIENTE, INICIO_TRATAMINETO, FECHA_ENTREGA, TIPO_RECETA, CANTIDAD_NO_DISPENSADA, STOCK_INICIAL, STOCK_FINAL FROM db_pagina_rc.omi_medicamentos_pendientes where RUT_PACIENTE = '{$this->getRut()}'";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i]= Array(
					"data" => "1",
					"CENTRO_DISPENSACION" => utf8_encode($fila[0]),
					"CODIGO_MEDICAMENTO" => $fila[1],
					"NOMBRE_MEDICAMENTO" => utf8_encode($fila[2]),
					"RUT_PACIENTE" => $fila[3],
					"NOMBRE_PACIENTE" => utf8_encode($fila[4]),
					"INICIO_TRATAMINETO" => $fila[5],
					"FECHA_ENTREGA" => $fila[6],
					"TIPO_RECETA" => utf8_encode($fila[7]),
					"CANTIDAD_NO_DISPENSADA" => $fila[8],
					"STOCK_INICIAL" => $fila[9],
					"STOCK_FINAL" => $fila[10]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}


	public function mostrarPacientesxFecha($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT CENTRO_DISPENSACION, CODIGO_MEDICAMENTO, NOMBRE_MEDICAMENTO, RUT_PACIENTE, NOMBRE_PACIENTE, INICIO_TRATAMINETO, FECHA_ENTREGA, TIPO_RECETA, CANTIDAD_NO_DISPENSADA, STOCK_INICIAL, STOCK_FINAL FROM db_pagina_rc.omi_medicamentos_pendientes where FECHA_ENTREGA = '{$this->getDesde()}'";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i]= Array(
					"data" => "1",
					"CENTRO_DISPENSACION" => utf8_encode($fila[0]),
					"CODIGO_MEDICAMENTO" => $fila[1],
					"NOMBRE_MEDICAMENTO" => utf8_encode($fila[2]),
					"RUT_PACIENTE" => $fila[3],
					"NOMBRE_PACIENTE" => utf8_encode($fila[4]),
					"INICIO_TRATAMINETO" => $fila[5],
					"FECHA_ENTREGA" => $fila[6],
					"TIPO_RECETA" => utf8_encode($fila[7]),
					"CANTIDAD_NO_DISPENSADA" => $fila[8],
					"STOCK_INICIAL" => $fila[9],
					"STOCK_FINAL" => $fila[10]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}


	public function mostrarPacientesxRangoFecha($bd){
		$i = 0;
		$data = Array();
		$sql= "SELECT CENTRO_DISPENSACION, CODIGO_MEDICAMENTO, NOMBRE_MEDICAMENTO, RUT_PACIENTE, NOMBRE_PACIENTE, INICIO_TRATAMINETO, FECHA_ENTREGA, TIPO_RECETA, CANTIDAD_NO_DISPENSADA, STOCK_INICIAL, STOCK_FINAL FROM db_pagina_rc.omi_medicamentos_pendientes where FECHA_ENTREGA between '{$this->getDesde()}' and '{$this->getHasta()}'  limit 100";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i]= Array(
					"data" => "1",
					"CENTRO_DISPENSACION" => utf8_encode($fila[0]),
					"CODIGO_MEDICAMENTO" => $fila[1],
					"NOMBRE_MEDICAMENTO" => utf8_encode($fila[2]),
					"RUT_PACIENTE" => $fila[3],
					"NOMBRE_PACIENTE" => utf8_encode($fila[4]),
					"INICIO_TRATAMINETO" => $fila[5],
					"FECHA_ENTREGA" => $fila[6],
					"TIPO_RECETA" => utf8_encode($fila[7]),
					"CANTIDAD_NO_DISPENSADA" => $fila[8],
					"STOCK_INICIAL" => $fila[9],
					"STOCK_FINAL" => $fila[10]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;
	}



}

?>