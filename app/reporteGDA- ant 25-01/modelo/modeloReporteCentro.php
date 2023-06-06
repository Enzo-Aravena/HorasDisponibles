<?php

 class reporteGda{

 	private $id;
 	private $centro;
 	private $ciclo;
 	private $hoy;
 	private $desde;
 	private $hasta;
 	private $descripcion;

 	public function getId(){
 		return $this->id;
 	}

 	public function setId($id){
 		return $this->id = $id;
 	}

 	public function getCentro(){
 		return $this->centro;
 	}

 	public function setCentro($centro){
 		return $this->centro = $centro;
 	}

 	public function getCiclo(){
 		return $this->ciclo;
 	}

 	public function setCiclo($ciclo){
 		return $this->ciclo = $ciclo;
 	}


 	public function getHoy(){
 		return $this->hoy;
 	}

 	public function setHoy($hoy){
 		return $this->hoy = $hoy;
 	}

 	public function getDesde(){
 		return $this->desde;
 	}

 	public function setDesde($desde){
 		return $this->desde = $desde;
 	}

 	public function getHasta(){
 		return $this->hasta;
 	}

 	public function setHasta($hasta){
 		return $this->hasta = $hasta;
 	}

 	public function getDescripcion(){
 		return $this->descripcion;
 	}

 	public function setDescripcion($descripcion){
 		return $this->descripcion = $descripcion;
 	}


 	public function celdaImagen($dato){
		if($dato == "CARGA CORRECTA"){
			$color = "<img src='../../../lib/images/correct.png'";//velde
		}else
			if ($dato == "PENDIENTE") {
				$color = "<img src='../../../lib/images/loading-mark.png'"; // amarillo
			}else{
				$color ="<img src='../../../lib/images/incorrect.png'";  // rojo
			}
		
		return $color;
	}


public function MostrarReporteDiario($bd){		
	$i=0;
	$data = Array();
	$sql="call SP_Resumen_Ciclos({$this->getCentro()},'{$this->getHoy()}')";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data[0] = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"		=>"1",
				"ciclo"       => $fila[0],
				"fecha"       => $fila[1],
				"Agendados"	=>$fila[2],
				"Cancelados"=>$fila[3],
				"estadoAgendado"=>strtolower($fila[4])." ".$this->celdaImagen($fila[4]),	
				"estadoCancelado"=>strtolower($fila[5])." ".$this->celdaImagen($fila[5])					
				);				
		  $i++;
		}//end while
			
		
		}//fin else
		return $data;
}


// SP que  llena los centros
public function buscarCentroUsuario($bd){		
	$i=0;
	$data = Array();
	$sql="call buscarCentroUsuario({$this->getCentro()})";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data[0]  = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
			$data[$i] = Array(
			"data"		=>"1",
			"nombre"	=>$fila[0]			
			);//end array
	  $i++;
	}//end while
	}//fin else
	return $data;
}


public function MostrarPorFecha($bd){		
	$i=0;
	$data = Array();
	$sql="call SP_Resumen_Ciclos({$this->getCentro()},'{$this->getDesde()}')";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data[0] = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"		=>"1",
				"ciclo"       => $fila[0],
				"fecha"       => $fila[1],
				"Agendados"	=>$fila[2],
				"Cancelados"=>$fila[3],
				"estadoAgendado"=>strtolower($fila[4])." ".$this->celdaImagen($fila[4]),	
				"estadoCancelado"=>strtolower($fila[5])." ".$this->celdaImagen($fila[5])					
				);		
	  $i++;
	}//end while
	}//fin else
	return $data;
}

public function exportarDatos($bd){		
	$i=0;
	$data = Array();
	$sql="call SP_Export_Ciclos('{$this->getHoy()}',{$this->getCentro()},{$this->getCiclo()})";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data[0] = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
			$data[$i] = Array(
			"data"	  		   =>"1",
			"fechaContacto"    => utf8_encode($fila[0]),
			"centro"		   => utf8_encode($fila[1]),
			"sector"		   => utf8_encode($fila[2]),
			"idCitaGda"		   => utf8_encode($fila[3]),
			"FechaCita"		   => utf8_encode($fila[4]),
			"horaCita"		   => utf8_encode($fila[5]),
			"numeroFicha"	   => utf8_encode($fila[6]),
			"rutPaciente"	   => utf8_encode($fila[7]),
			"nombrePaciente"   => utf8_encode($fila[8]),
			"apat"		       => utf8_encode($fila[9]),
			"amat"		       => utf8_encode($fila[10]),
			"edad"		       => utf8_encode($fila[11]),
			"fonoContacto"	   => utf8_encode($fila[12]),
			"fonoContacto2rio" => utf8_encode($fila[13]),
			"accionCita"	   => utf8_encode($fila[14]),
			"prevision"		   => utf8_encode($fila[15]),
			"Convenio"		   => utf8_encode($fila[16]),
			"idLlamada"		   => utf8_encode($fila[17]),
			"Reagendado"	   => utf8_encode($fila[18]),
			"horaCupo"		   => utf8_encode($fila[19]),
			"sectorCupo"	   => utf8_encode($fila[20]),
			"nomProfesional"   => utf8_encode($fila[21]),
			"agendadoPor"	   => utf8_encode($fila[22]),
			"agendadoDesde"	   => utf8_encode($fila[23]),
			"idCupoSistema"	   => utf8_encode($fila[24]),
			"idPacienSistCli"  => utf8_encode($fila[25]),
			"detalleCupo"	   => utf8_encode($fila[26])
			);//end array
	  $i++;
	}//end while
	}//fin else
	return $data;
}


public function EXPORTAR_CICLO($bd){		
	$i=0;
	$data = Array();
	$sql="call SP_Export_Ciclos({$this->getCentro()},{$this->getCiclo()},'{$this->getDesde()}')";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data[0] = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"		=>"1",
				"ciclo"       => $fila[0],
				"fecha"       => $fila[1],
				"Agendados"	=>$fila[2],
				"Cancelados"=>$fila[3],
				"estadoAgendado"=>strtolower($fila[4])." ".$this->celdaImagen($fila[4]),	
				"estadoCancelado"=>strtolower($fila[5])." ".$this->celdaImagen($fila[5])					
				);		
	  $i++;
	}//end while
	}//fin else
	return $data;
}



} // fin clase menu


?>