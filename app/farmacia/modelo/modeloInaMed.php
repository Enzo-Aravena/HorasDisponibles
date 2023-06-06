<?php

class claseInsumos{

	private $rut;
	private $desde;
	private $hasta;
	private $centro;
	

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

	public function getCentro(){
		return $this->centro;
	}

	public function setCentro($centro){
		$this->centro = $centro;
	}


		public function mostrarPacientesPrueba($bd){
		$i = 0;
		$data = Array();
		$sql= "CALL db_pagina_rc.OMI_MED_PENDIENTES({$this->getCentro()}, {$this->getRut()},{$this->getDesde()},{$this->getHasta()});";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data[0]= Array(
				"data" => "0",
				"CENTRO_DISPENSACION" => "0",
				"CODIGO_MEDICAMENTO" => "0",
				"NOMBRE_MEDICAMENTO" => "0",
				"RUT_PACIENTE" => "0",
				"NOMBRE_PACIENTE" => "0",
				"INICIO_TRATAMINETO" => "0",
				"FECHA_ENTREGA" => "0",
				"TIPO_RECETA" => "0",
				"CANTIDAD_NO_DISPENSADA" => "0",
				"STOCK_INICIAL" => "0",
				"STOCK_FINAL" => "0"
			); // End Array
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i]= Array(
					"data" => "1",
					"CENTRO_DISPENSACION" => $fila[0],
					"CODIGO_MEDICAMENTO" => utf8_encode($fila[1]),
					"NOMBRE_MEDICAMENTO" => utf8_encode($fila[2]),
					"RUT_PACIENTE" => utf8_encode($fila[3]),
					"NOMBRE_PACIENTE" => utf8_encode($fila[4]),
					"INICIO_TRATAMINETO" => $fila[5],
					"FECHA_ENTREGA" => $fila[6],
					"TIPO_RECETA" => $fila[7],
					"CANTIDAD_NO_DISPENSADA" => $fila[8],
					"STOCK_INICIAL" => $fila[9],
					"STOCK_FINAL" => $fila[10]
				); // End Array
				$i++;
			}// end while
		}// end else
		return $data;

		//return $sql;

	}

}

?>