<?php

 class ModeloGRafico{

	
 	private $hoy;
 	private $desde;
 	private $hasta;
 	private $centro;
 	private $semana;
 	private $anio;



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

 	public function getCentro(){
 		return $this->centro;
 	}

 	public function setCentro($centro){
 		return $this->centro = $centro;
 	}

 	public function getSemana(){
 		return $this->semana;
 	}

 	public function setSemana($semana){
 		return $this->semana = $semana;
 	}

 	public function getAnio(){
 		return $this->anio;
 	}

 	public function setAnio($anio){
 		return $this->anio = $anio;
 	}


 	public function OBTENERGRAFICO($bd){		
	$i=0;
	$data = Array();
	$sql="CALL OBTENER_DATOS_GRAFICO('{$this->getDesde()}','{$this->getHasta()}')";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"							=>"1",
				"FECHAOFERTA"       			=> $fila[0],
				"CENTRO"       					=> $fila[1],
				"OFERTADO_MORBT"				=>$fila[2],
				"AGENDADOS_FINAL_MORBT"			=>$fila[3],
				"AGENDADOS_CONFIRMADO_MORBT"	=>$fila[4],	
				"BLOQUES_NO_AGENDADOS_MORBT"	=>$fila[5],
				"OFERTADO_MORBI"				=>$fila[6],
				"AGENDADOS_MORBI"				=>$fila[7],
				"AGENDADOS_CONFIRMADO_MORBI"	=>$fila[8],
				"BLOQUES_NO_AGENDADOS_MORBI"	=>$fila[9]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}



public function OBTENER_DATOS_TABLA($bd){		
	$i=0;
	$data = Array();
	$sql="CALL OBTENER_DATOS_TABLA('{$this->getDesde()}','{$this->getHasta()}')";
	//$sql = "call OBTENER_DATOS_TABLA('2019-04-16','2019-04-17');";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"							=>"1",
				"FECHAOFERTA"       			=> $fila[0],
				"CENTRO"       					=> $fila[1],
				"OFERTADO_MORBT"				=>$fila[2],
				"AGENDADOS_MORBT_TELEFONICA" 	=>$fila[3],
				"AGENDADOS_MESON_MORBT" 		=>$fila[4],
				"AGENDADOS_FINAL_MORBT"			=>$fila[5],
				"AGENDADOS_CONFIRMADO_MORBT"	=>$fila[6],
				"BLOQUES_NO_AGENDADOS_MORBT"	=>$fila[7],
				"AGENDA_FINAL_PROCENTAJE_MORBT"	=>$fila[8],
				"AGENDADOS_PORCENTAJE_MORBT"	=>$fila[9],
				"INASISTENTE_PORCENTAJE_MORBT"	=>$fila[10],
				"OFERTADO_MORBI" 				=>$fila[11],
				"AGENDADOS_MORBI" 				=>$fila[12],
				"AGENDADOS_MORBI_FORZADOS" 		=>$fila[13],
				"AGENDADOS_CONFIRMADO_MORBI" 	=>$fila[14],
				"BLOQUES_NO_AGENDADOS_MORBI" 	=>$fila[15],
				"AGENDA_FINAL_PROCENTAJE_MORBI"	=>$fila[16],
				"AGENDADOS_PORCENTAJE_MORBI"	=>$fila[17],
				"INASISTENTE_PORCENTAJE_MORBI"	=>$fila[18]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}



//call OBTENER_DATOS_POR_DIA('2018-10-18','2018-10-18',3);
	public function OBTENER_DATOS_POR_DIA($bd){		
	$i=0;
	$data = Array();
	$sql="CALL OBTENER_DATOS_POR_DIA('{$this->getDesde()}','{$this->getHasta()}',{$this->getCentro()})";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"							=>"1",
				"FECHAOFERTA"       			=> $fila[0],
				"CENTRO"       					=> $fila[1],
				"OFERTADO_MORBT"				=>$fila[2],
				"AGENDADOS_FINAL_MORBT"			=>$fila[3],
				"AGENDADOS_CONFIRMADO_MORBT"	=>$fila[4],	
				"BLOQUES_NO_AGENDADOS_MORBT"	=>$fila[5],
				"OFERTADO_MORBI"				=>$fila[6],
				"AGENDADOS_MORBI"				=>$fila[7],
				"AGENDADOS_CONFIRMADO_MORBI"	=>$fila[8],
				"BLOQUES_NO_AGENDADOS_MORBI"	=>$fila[9]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}

///CALL OBTENER_VALORES_POR_DIA('2018-10-18');

public function OBTENER_VALORES_POR_DIA($bd){		
	$i=0;
	$data = Array();
	$sql="CALL OBTENER_VALORES_POR_DIA({$this->getDesde()})";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"							=>"1",
				"FECHAOFERTA"       			=> $fila[0],
				"CENTRO"       					=> $fila[1],
				"OFERTADO_MORBT"				=>$fila[2],
				"AGENDADOS_FINAL_MORBT"			=>$fila[3],
				"BLOQUES_NO_AGENDADOS_MORBT"	=>$fila[4],	
				"AGENDADOS_CONFIRMADO_MORBT"	=>$fila[5],
				"OFERTADO_MORBI"				=>$fila[6],
				"AGENDADOS_MORBI"				=>$fila[7],
				"AGENDADOS_CONFIRMADO_MORBI"	=>$fila[8],
				"BLOQUES_NO_AGENDADOS_MORBI"	=>$fila[9]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}


public function OBTENER_VALORES_POR_DIA_CENTRO($bd){		
	$i=0;
	$data = Array();
	$sql="CALL OBTENER_VALORES_POR_DIA_CENTRO({$this->getDesde()},{$this->getCentro()})";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"							=>"1",
				"FECHAOFERTA"       			=> $fila[0],
				"CENTRO"       					=> $fila[1],
				"OFERTADO_MORBT"				=>$fila[2],
				"AGENDADOS_FINAL_MORBT"			=>$fila[3],
				"BLOQUES_NO_AGENDADOS_MORBT"	=>$fila[4],	
				"AGENDADOS_CONFIRMADO_MORBT"	=>$fila[5],
				"OFERTADO_MORBI"				=>$fila[6],
				"AGENDADOS_MORBI"				=>$fila[7],
				"AGENDADOS_CONFIRMADO_MORBI"	=>$fila[8],
				"BLOQUES_NO_AGENDADOS_MORBI"	=>$fila[9]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}


/*********************************** TABLA GRAFICO *********************************************/
public function OBTENER_TABLA_TODO($bd){	
	$semana = $this->getSemana();
	switch($semana)
		{
			case 0:		$nombre="Semanal";		break;
			case 1:		$nombre="Lunes";		break;
			case 2:		$nombre="Martes";		break;
			case 3:		$nombre="Miercoles";	break;
			case 4:		$nombre="Jueves";		break;
			case 5:		$nombre="Viernes";		break;
			case 6:		$nombre="Sabado";		break;
			case 7:		$nombre="Domingo";		break;			
			default: 	$nombre="Semanal";		break;
		}



	$i=0;
	$data = Array();
	$sql="CALL OBTENER_TABLA_TODO('{$this->getDesde()}','{$this->getHasta()}')";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i] = Array(
				"data"							=>"1",
				"FECHAOFERTA"       			=>$nombre,
				"CENTRO"       					=> $fila[1],
				"OFERTADO_MORBT"				=>$fila[2],
				"AGENDADOS_MORBT_TELEFONICA" 	=>$fila[3],
				"AGENDADOS_MESON_MORBT" 		=>$fila[4],
				"AGENDADOS_FINAL_MORBT"			=>$fila[5],
				"AGENDADOS_CONFIRMADO_MORBT"	=>$fila[6],
				"BLOQUES_NO_AGENDADOS_MORBT"	=>$fila[7],
				"AGENDA_FINAL_PROCENTAJE_MORBT"	=>$fila[8],
				"AGENDADOS_PORCENTAJE_MORBT"	=>$fila[9],
				"INASISTENTE_PORCENTAJE_MORBT"	=>$fila[10],
				"OFERTADO_MORBI" 				=>$fila[11],
				"AGENDADOS_MORBI" 				=>$fila[12],
				"AGENDADOS_MORBI_FORZADOS" 		=>$fila[13],
				"AGENDADOS_CONFIRMADO_MORBI" 	=>$fila[14],
				"BLOQUES_NO_AGENDADOS_MORBI" 	=>$fila[15],
				"AGENDA_FINAL_PROCENTAJE_MORBI"	=>$fila[16],
				"AGENDADOS_PORCENTAJE_MORBI"	=>$fila[17],
				"INASISTENTE_PORCENTAJE_MORBI"	=>$fila[18]
				
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}


public function OBTENER_TABLA_CENTRO($bd){	
	$semana = $this->getSemana();
	switch($semana)
		{
			case 0:		$nombre="Semanal";		break;
			case 1:		$nombre="Lunes";		break;
			case 2:		$nombre="Martes";		break;
			case 3:		$nombre="Miercoles";	break;
			case 4:		$nombre="Jueves";		break;
			case 5:		$nombre="Viernes";		break;
			case 6:		$nombre="Sabado";		break;
			case 7:		$nombre="Domingo";		break;			
			default: 	$nombre="Semanal";		break;
		}

	$centro = $this->getCentro();
	switch($centro)
		{
			case 3:		$center="SAN LUIS";			break;
			case 1:		$center="CAROL URZUA";		break;
			case 2:		$center="LA FAENA";			break;
			case 4:		$center="LO HERMIDA";		break;
			case 5:		$center="CARDENAL S.H";		break;
			case 12:	$center="PADRE G.W";		break;
			case 13:	$center="LAS TORRES";		break;
			default: 	$center="Todos";			break;
		}

	$i=0;
	$data = Array();
	$sql="CALL OBTENER_TABLA_CENTRO('{$this->getDesde()}','{$this->getHasta()}',{$this->getCentro()})";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i] = Array(
				"data"							=>"1",
				"FECHAOFERTA"       			=>$nombre,
				"CENTRO"       					=> $center,
				"OFERTADO_MORBT"				=>$fila[2],
				"AGENDADOS_MORBT_TELEFONICA" 	=>$fila[3],
				"AGENDADOS_MESON_MORBT" 		=>$fila[4],
				"AGENDADOS_FINAL_MORBT"			=>$fila[5],
				"AGENDADOS_CONFIRMADO_MORBT"	=>$fila[6],
				"BLOQUES_NO_AGENDADOS_MORBT"	=>$fila[7],
				"AGENDA_FINAL_PROCENTAJE_MORBT"	=>$fila[8],
				"AGENDADOS_PORCENTAJE_MORBT"	=>$fila[9],
				"INASISTENTE_PORCENTAJE_MORBT"	=>$fila[10],
				"OFERTADO_MORBI" 				=>$fila[11],
				"AGENDADOS_MORBI" 				=>$fila[12],
				"AGENDADOS_MORBI_FORZADOS" 		=>$fila[13],
				"AGENDADOS_CONFIRMADO_MORBI" 	=>$fila[14],
				"BLOQUES_NO_AGENDADOS_MORBI" 	=>$fila[15],
				"AGENDA_FINAL_PROCENTAJE_MORBI"	=>$fila[16],
				"AGENDADOS_PORCENTAJE_MORBI"	=>$fila[17],
				"INASISTENTE_PORCENTAJE_MORBI"	=>$fila[18]
				
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}


public function OBTENER_TABLA_DIA_TODOCENTRO($bd){		
	$semana = $this->getSemana();
	switch($semana)
		{
			case 0:		$nombre="Semanal";		break;
			case 1:		$nombre="Lunes";		break;
			case 2:		$nombre="Martes";		break;
			case 3:		$nombre="Miercoles";	break;
			case 4:		$nombre="Jueves";		break;
			case 5:		$nombre="Viernes";		break;
			case 6:		$nombre="Sabado";		break;
			case 7:		$nombre="Domingo";		break;			
			default: 	$nombre="Semanal";		break;
		}


		$centro = $this->getCentro();
	switch($centro)
		{
			case 3:		$center="SAN LUIS";			break;
			case 1:		$center="CAROL URZUA";		break;
			case 2:		$center="LA FAENA";			break;
			case 4:		$center="LO HERMIDA";		break;
			case 5:		$center="CARDENAL S.H";		break;
			case 12:	$center="PADRE G.W";		break;
			case 13:	$center="LAS TORRES";		break;
			default: 	$center="Todos";			break;
		}

	$i=0;
	$data = Array();
	$sql="CALL OBTENER_TABLA_DIA_TODOCENTRO({$this->getDesde()})";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i] = Array(
				"data"							=>"1",
				"FECHAOFERTA"       			=>$nombre,
				"CENTRO"       					=> $center,
				"OFERTADO_MORBT"				=>$fila[2],
				"AGENDADOS_MORBT_TELEFONICA" 	=>$fila[3],
				"AGENDADOS_MESON_MORBT" 		=>$fila[4],
				"AGENDADOS_FINAL_MORBT"			=>$fila[5],
				"AGENDADOS_CONFIRMADO_MORBT"	=>$fila[6],
				"BLOQUES_NO_AGENDADOS_MORBT"	=>$fila[7],
				"AGENDA_FINAL_PROCENTAJE_MORBT"	=>$fila[8],
				"AGENDADOS_PORCENTAJE_MORBT"	=>$fila[9],
				"INASISTENTE_PORCENTAJE_MORBT"	=>$fila[10],
				"OFERTADO_MORBI" 				=>$fila[11],
				"AGENDADOS_MORBI" 				=>$fila[12],
				"AGENDADOS_MORBI_FORZADOS" 		=>$fila[13],
				"AGENDADOS_CONFIRMADO_MORBI" 	=>$fila[14],
				"BLOQUES_NO_AGENDADOS_MORBI" 	=>$fila[15],
				"AGENDA_FINAL_PROCENTAJE_MORBI"	=>$fila[16],
				"AGENDADOS_PORCENTAJE_MORBI"	=>$fila[17],
				"INASISTENTE_PORCENTAJE_MORBI"	=>$fila[18]
				
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}


public function OBTENER_TODO_FILTRO($bd){	

	$centro = $this->getCentro();
	switch($centro)
		{
			case 3:		$center="SAN LUIS";			break;
			case 1:		$center="CAROL URZUA";		break;
			case 2:		$center="LA FAENA";			break;
			case 4:		$center="LO HERMIDA";		break;
			case 5:		$center="CARDENAL S.H";		break;
			case 12:	$center="PADRE G.W";		break;
			case 13:	$center="LAS TORRES";		break;
			default: 	$center="Todos";			break;
		}	

			$semana = $this->getSemana();
	switch($semana)
		{
			case 0:		$nombre="Semanal";		break;
			case 1:		$nombre="Lunes";		break;
			case 2:		$nombre="Martes";		break;
			case 3:		$nombre="Miercoles";	break;
			case 4:		$nombre="Jueves";		break;
			case 5:		$nombre="Viernes";		break;
			case 6:		$nombre="Sabado";		break;
			case 7:		$nombre="Domingo";		break;			
			default: 	$nombre="Semanal";		break;
		}



	$i=0;
	$data = Array();
	$sql="CALL OBTENER_TODO_FILTRO({$this->getDesde()},{$this->getCentro()})";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i] = Array(
				"data"							=>"1",
				"FECHAOFERTA"       			=>$nombre,
				"CENTRO"       					=>$center,
				"OFERTADO_MORBT"				=>$fila[2],
				"AGENDADOS_MORBT_TELEFONICA" 	=>$fila[3],
				"AGENDADOS_MESON_MORBT" 		=>$fila[4],
				"AGENDADOS_FINAL_MORBT"			=>$fila[5],
				"AGENDADOS_CONFIRMADO_MORBT"	=>$fila[6],
				"BLOQUES_NO_AGENDADOS_MORBT"	=>$fila[7],
				"AGENDA_FINAL_PROCENTAJE_MORBT"	=>$fila[8],
				"AGENDADOS_PORCENTAJE_MORBT"	=>$fila[9],
				"INASISTENTE_PORCENTAJE_MORBT"	=>$fila[10],
				"OFERTADO_MORBI" 				=>$fila[11],
				"AGENDADOS_MORBI" 				=>$fila[12],
				"AGENDADOS_MORBI_FORZADOS" 		=>$fila[13],
				"AGENDADOS_CONFIRMADO_MORBI" 	=>$fila[14],
				"BLOQUES_NO_AGENDADOS_MORBI" 	=>$fila[15],
				"AGENDA_FINAL_PROCENTAJE_MORBI"	=>$fila[16],
				"AGENDADOS_PORCENTAJE_MORBI"	=>$fila[17],
				"INASISTENTE_PORCENTAJE_MORBI"	=>$fila[18]
				);
		  $i++;
		}//end while
	}//fin else

	return $data;
}

/************************* INICIO SP AGENDADOS MORBILIDAD MENSUAL ****************************/
public function OBTENER_GRAFICO_MORB_MENSUAL($bd){
	$i=0;
	$data = Array();
	$sql="CALL OBTENER_GRAFICO_MORB_MENSUAL({$this->getCentro()},'{$this->getDesde()}')";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"				   =>"1",
				"AGENDADOS_MORBT"      => $fila[0],
				"AGENDADOS_MORBI"      => $fila[1],
				"AGENDADOS_FINAL"	   =>$fila[2]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}


// ***************  RELLENO TABLA PRINCIPAL

public function TABLA_MORB_QUERY_UNO_SL($bd){
	$i=0;
	$data = Array();
	$sql="CALL TABLA_MORB_QUERY_UNO_SL('{$this->getDesde()}')";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"				   			=>"1",
				"centro"						=> $fila[0],
				"anho"							=> $fila[1],
				"agendados_morbt"				=> $fila[2],
				"agendados_morbi"				=> $fila[3],
				"total_agendados"				=> $fila[4],
				"porcentaje_agendados_morbt"	=> $fila[5],
				"porcentaje_agendados_morbi"	=> $fila[6],
				"porcentaje_total_agendados_1"	=> $fila[7],
				"porcentaje_total_agendados_2"	=> $fila[8],
				"porcentaje_total_agendados_3"	=> $fila[9],
				"porcentaje_total_agendados_4"	=> $fila[10],
				"porcentaje_total_agendados_5"	=> $fila[11],
				"porcentaje_total_agendados_6"	=> $fila[12],
				"porcentaje_total_agendados_7"	=> $fila[13],
				"porcentaje_total_agendados_8"	=> $fila[14],
				"porcentaje_total_agendados_9"	=> $fila[15],
				"porcentaje_total_agendados_10"	=> $fila[16],
				"porcentaje_total_agendados_11"	=> $fila[17],
				"porcentaje_total_agendados_12"	=> $fila[18]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}

public function TABLA_MORB_QUERY_DOS_CU($bd){
	$i=0;
	$data = Array();
	$sql="CALL TABLA_MORB_QUERY_DOS_CU('{$this->getDesde()}')";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"				   			=>"1",
				"centro"						=> $fila[0],
				"anho"							=> $fila[1],
				"agendados_morbt"				=> $fila[2],
				"agendados_morbi"				=> $fila[3],
				"total_agendados"				=> $fila[4],
				"porcentaje_agendados_morbt"	=> $fila[5],
				"porcentaje_agendados_morbi"	=> $fila[6],
				"porcentaje_total_agendados_1"	=> $fila[7],
				"porcentaje_total_agendados_2"	=> $fila[8],
				"porcentaje_total_agendados_3"	=> $fila[9],
				"porcentaje_total_agendados_4"	=> $fila[10],
				"porcentaje_total_agendados_5"	=> $fila[11],
				"porcentaje_total_agendados_6"	=> $fila[12],
				"porcentaje_total_agendados_7"	=> $fila[13],
				"porcentaje_total_agendados_8"	=> $fila[14],
				"porcentaje_total_agendados_9"	=> $fila[15],
				"porcentaje_total_agendados_10"	=> $fila[16],
				"porcentaje_total_agendados_11"	=> $fila[17],
				"porcentaje_total_agendados_12"	=> $fila[18]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}


public function TABLA_MORB_QUERY_TRES_LF($bd){
	$i=0;
	$data = Array();
	$sql="CALL TABLA_MORB_QUERY_TRES_LF('{$this->getDesde()}')";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"				   			=>"1",
				"centro"						=> $fila[0],
				"anho"							=> $fila[1],
				"agendados_morbt"				=> $fila[2],
				"agendados_morbi"				=> $fila[3],
				"total_agendados"				=> $fila[4],
				"porcentaje_agendados_morbt"	=> $fila[5],
				"porcentaje_agendados_morbi"	=> $fila[6],
				"porcentaje_total_agendados_1"	=> $fila[7],
				"porcentaje_total_agendados_2"	=> $fila[8],
				"porcentaje_total_agendados_3"	=> $fila[9],
				"porcentaje_total_agendados_4"	=> $fila[10],
				"porcentaje_total_agendados_5"	=> $fila[11],
				"porcentaje_total_agendados_6"	=> $fila[12],
				"porcentaje_total_agendados_7"	=> $fila[13],
				"porcentaje_total_agendados_8"	=> $fila[14],
				"porcentaje_total_agendados_9"	=> $fila[15],
				"porcentaje_total_agendados_10"	=> $fila[16],
				"porcentaje_total_agendados_11"	=> $fila[17],
				"porcentaje_total_agendados_12"	=> $fila[18]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}


public function TABLA_MORB_QUERY_CUATRO_LH($bd){
	$i=0;
	$data = Array();
	$sql="CALL TABLA_MORB_QUERY_CUATRO_LH('{$this->getDesde()}')";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"				   			=>"1",
				"centro"						=> $fila[0],
				"anho"							=> $fila[1],
				"agendados_morbt"				=> $fila[2],
				"agendados_morbi"				=> $fila[3],
				"total_agendados"				=> $fila[4],
				"porcentaje_agendados_morbt"	=> $fila[5],
				"porcentaje_agendados_morbi"	=> $fila[6],
				"porcentaje_total_agendados_1"	=> $fila[7],
				"porcentaje_total_agendados_2"	=> $fila[8],
				"porcentaje_total_agendados_3"	=> $fila[9],
				"porcentaje_total_agendados_4"	=> $fila[10],
				"porcentaje_total_agendados_5"	=> $fila[11],
				"porcentaje_total_agendados_6"	=> $fila[12],
				"porcentaje_total_agendados_7"	=> $fila[13],
				"porcentaje_total_agendados_8"	=> $fila[14],
				"porcentaje_total_agendados_9"	=> $fila[15],
				"porcentaje_total_agendados_10"	=> $fila[16],
				"porcentaje_total_agendados_11"	=> $fila[17],
				"porcentaje_total_agendados_12"	=> $fila[18]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}


public function TABLA_MORB_QUERY_CINCO_CSH($bd){
	$i=0;
	$data = Array();
	$sql="CALL TABLA_MORB_QUERY_CINCO_CSH('{$this->getDesde()}')";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"				   			=>"1",
				"centro"						=> $fila[0],
				"anho"							=> $fila[1],
				"agendados_morbt"				=> $fila[2],
				"agendados_morbi"				=> $fila[3],
				"total_agendados"				=> $fila[4],
				"porcentaje_agendados_morbt"	=> $fila[5],
				"porcentaje_agendados_morbi"	=> $fila[6],
				"porcentaje_total_agendados_1"	=> $fila[7],
				"porcentaje_total_agendados_2"	=> $fila[8],
				"porcentaje_total_agendados_3"	=> $fila[9],
				"porcentaje_total_agendados_4"	=> $fila[10],
				"porcentaje_total_agendados_5"	=> $fila[11],
				"porcentaje_total_agendados_6"	=> $fila[12],
				"porcentaje_total_agendados_7"	=> $fila[13],
				"porcentaje_total_agendados_8"	=> $fila[14],
				"porcentaje_total_agendados_9"	=> $fila[15],
				"porcentaje_total_agendados_10"	=> $fila[16],
				"porcentaje_total_agendados_11"	=> $fila[17],
				"porcentaje_total_agendados_12"	=> $fila[18]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}


public function TABLA_MORB_QUERY_SEIS_PGW($bd){
	$i=0;
	$data = Array();
	$sql="CALL TABLA_MORB_QUERY_SEIS_PGW('{$this->getDesde()}')";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"				   			=>"1",
				"centro"						=> $fila[0],
				"anho"							=> $fila[1],
				"agendados_morbt"				=> $fila[2],
				"agendados_morbi"				=> $fila[3],
				"total_agendados"				=> $fila[4],
				"porcentaje_agendados_morbt"	=> $fila[5],
				"porcentaje_agendados_morbi"	=> $fila[6],
				"porcentaje_total_agendados_1"	=> $fila[7],
				"porcentaje_total_agendados_2"	=> $fila[8],
				"porcentaje_total_agendados_3"	=> $fila[9],
				"porcentaje_total_agendados_4"	=> $fila[10],
				"porcentaje_total_agendados_5"	=> $fila[11],
				"porcentaje_total_agendados_6"	=> $fila[12],
				"porcentaje_total_agendados_7"	=> $fila[13],
				"porcentaje_total_agendados_8"	=> $fila[14],
				"porcentaje_total_agendados_9"	=> $fila[15],
				"porcentaje_total_agendados_10"	=> $fila[16],
				"porcentaje_total_agendados_11"	=> $fila[17],
				"porcentaje_total_agendados_12"	=> $fila[18]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}


//CREAR SP  VALIDACION NUEVO CESFAM LAS TORRES EN DB_TIC
/*public function TABLA_MORB_QUERY_SEIS_LASTORRES($bd){
	$i=0;
	$data = Array();
	$sql="CALL TABLA_MORB_QUERY_SEIS_LASTORRES('{$this->getDesde()}')";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"				   			=>"1",
				"centro"						=> $fila[0],
				"anho"							=> $fila[1],
				"agendados_morbt"				=> $fila[2],
				"agendados_morbi"				=> $fila[3],
				"total_agendados"				=> $fila[4],
				"porcentaje_agendados_morbt"	=> $fila[5],
				"porcentaje_agendados_morbi"	=> $fila[6],
				"porcentaje_total_agendados_1"	=> $fila[7],
				"porcentaje_total_agendados_2"	=> $fila[8],
				"porcentaje_total_agendados_3"	=> $fila[9],
				"porcentaje_total_agendados_4"	=> $fila[10],
				"porcentaje_total_agendados_5"	=> $fila[11],
				"porcentaje_total_agendados_6"	=> $fila[12],
				"porcentaje_total_agendados_7"	=> $fila[13],
				"porcentaje_total_agendados_8"	=> $fila[14],
				"porcentaje_total_agendados_9"	=> $fila[15],
				"porcentaje_total_agendados_10"	=> $fila[16],
				"porcentaje_total_agendados_11"	=> $fila[17],
				"porcentaje_total_agendados_12"	=> $fila[18]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}*/

public function TABLA_MORB_QUERY_SIETE($bd){
	$i=0;
	$data = Array();
	$sql="CALL TABLA_MORB_QUERY_SIETE('{$this->getDesde()}')";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"				   			=>"1",
				"centro"						=> $fila[0],
				"anho"							=> $fila[1],
				"agendados_morbt"				=> $fila[2],
				"agendados_morbi"				=> $fila[3],
				"total_agendados"				=> $fila[4],
				"porcentaje_agendados_morbt"	=> $fila[5],
				"porcentaje_agendados_morbi"	=> $fila[6],
				"porcentaje_total_agendados_1"	=> $fila[7],
				"porcentaje_total_agendados_2"	=> $fila[8],
				"porcentaje_total_agendados_3"	=> $fila[9],
				"porcentaje_total_agendados_4"	=> $fila[10],
				"porcentaje_total_agendados_5"	=> $fila[11],
				"porcentaje_total_agendados_6"	=> $fila[12],
				"porcentaje_total_agendados_7"	=> $fila[13],
				"porcentaje_total_agendados_8"	=> $fila[14],
				"porcentaje_total_agendados_9"	=> $fila[15],
				"porcentaje_total_agendados_10"	=> $fila[16],
				"porcentaje_total_agendados_11"	=> $fila[17],
				"porcentaje_total_agendados_12"	=> $fila[18]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}

/**************************** FIN SP AGENDADOS MORBILIDAD MENSUAL ****************************/

/**************************** INICIO SP ÀRA REPORTE OCUPACION MORBILIDAD ********************************/

public function OBTENER_REPORTE_GRAFICO_OCMOB_UNO($bd){
	$i=0;
	$data = Array();
	$sql="CALL OBTENER_REPORTE_GRAFICO_OCMOB_UNO({$this->getAnio()},{$this->getDesde()},{$this->getHasta()})";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"				   					=>"1",
				"SEMANA_EPIDEMIOLOGICA"					=> $fila[0],
				"CENTRO"								=> $fila[1],
				"FECHASEMANA_INICIAL"					=> $fila[2],
				"FECHASEMANA_FINAL"						=> $fila[3],
				"TOTAL_MORBI_OFERTADO"					=> $fila[4],
				"TOTAL_PROGRAMACION_TEORICA_SEMANAL"	=> $fila[5]
				);				
		  $i++;
		}//end while
	}//fin else
	return $data;
}

public function OBTENER_REPORTE_GRAFICO_OCMOB_DOS($bd){
	$i=0;
	$data = Array(); //{$this->getAnio(),{$this->getDesde()},{$this->getHasta()},{$this->getCentro()}
	$sql="CALL OBTENER_REPORTE_GRAFICO_OCMOB_DOS({$this->getAnio()},{$this->getDesde()},{$this->getHasta()},{$this->getCentro()})";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"				   					=>"1",
				"SEMANA_EPIDEMIOLOGICA"					=> $fila[0],
				"CENTRO"								=> $fila[1],
				"FECHASEMANA_INICIAL"					=> $fila[2],
				"FECHASEMANA_FINAL"						=> $fila[3],
				"TOTAL_MORBI_OFERTADO"					=> $fila[4],
				"TOTAL_PROGRAMACION_TEORICA_SEMANAL"	=> $fila[5]
				);				
		  $i++;
		}//end while
	}//fin else
	return $data;
}

// TABLA
public function OBTENER_REPORTE_TABLA_OCMOB_UNO($bd){
	$i=0;
	$data = Array();
	$sql="CALL OBTENER_REPORTE_TABLA_OCMOB_UNO({$this->getAnio()},{$this->getDesde()},{$this->getHasta()})";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"				   					=>"1",
				"CENTRO"								=> $fila[0],
				"MORBI_TELEFONICA_OFERTADO"				=> $fila[1],
				"MORBI_SOME_OFERTADO"					=> $fila[2],
				"TOTAL_PROGRAMACION_TEORICA_SEMANAL"	=> $fila[3],
				"TOTAL_MORBI_OFERTADO"					=> $fila[4],
				"DELTA_RESPECTO_DE_PROGRAMACION_A_N"	=> $fila[5],
				"DELTA_RESPECTO_DE_PROGRAMACION_A_P"	=> $fila[6],
				"MORBI_EFECTIVA"						=> $fila[7],
				"DELTA_RESPECTO_DE_PROGRAMACION_B_N"	=> $fila[8],
				"DELTA_RESPECTO_DE_PROGRAMACION_B_P"	=> $fila[9]
				);				
		  $i++;
		}//end while
	}//fin else
	return $data;
}


//
public function OBTENER_REPORTE_TABLA_OCMOB_DOS($bd){
	$i=0;
	$data = Array();
	$sql="CALL OBTENER_REPORTE_TABLA_OCMOB_DOS({$this->getAnio()},{$this->getDesde()},{$this->getHasta()},{$this->getCentro()})";
	$resultado = mysqli_query($bd,$sql);
	$count = mysqli_num_rows($resultado);
	if ($count == "0") {
		$data = array(
			"data" =>"0"
		);
	}else{
		while ($fila = mysqli_fetch_row($resultado)) {	
				$data[$i] = Array(
				"data"				   					=>"1",
				"CENTRO"								=> $fila[0],
				"MORBI_TELEFONICA_OFERTADO"				=> $fila[1],
				"MORBI_SOME_OFERTADO"					=> $fila[2],
				"TOTAL_PROGRAMACION_TEORICA_SEMANAL"	=> $fila[3],
				"TOTAL_MORBI_OFERTADO"					=> $fila[4],
				"DELTA_RESPECTO_DE_PROGRAMACION_A_N"	=> $fila[5],
				"DELTA_RESPECTO_DE_PROGRAMACION_A_P"	=> $fila[6],
				"MORBI_EFECTIVA"						=> $fila[7],
				"DELTA_RESPECTO_DE_PROGRAMACION_B_N"	=> $fila[8],
				"DELTA_RESPECTO_DE_PROGRAMACION_B_P"	=> $fila[9]
				);				
		  $i++;
		}//end while
	}//fin else
	return $data;
}

/**************************** INICIO SP ÀRA REPORTE OCUPACION MORBILIDAD ********************************/

} // fin clase menu


?>