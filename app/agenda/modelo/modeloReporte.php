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


 	public function OBTENER_DATOS_TABLA($bd){		
	$i=0;
	$data = Array();
	$sql="SELECT 'Semanal'								 AS 'FECHAOFERTA',
			CENTRO 							 AS 'CENTRO',
		SUM(OFERTADO_MORBT)  			 AS 'OFERTADO_MORBT',
		SUM(AGENDADOS_MORBT_TELEFONICA)  AS 'AGENDADOS_MORBT_TELEFONICA',
		SUM(AGENDADOS_MESON_MORBT)   	 AS 'AGENDADOS_MESON_MORBT',
		SUM(AGENDADOS_FINAL_MORBT)   	 AS 'AGENDADOS_FINAL_MORBT',								
		SUM(AGENDADOS_CONFIRMADO_MORBT)  AS 'AGENDADOS_CONFIRMADO_MORBT',
		SUM(BLOQUES_NO_AGENDADOS_MORBT)  AS 'BLOQUES_NO_AGENDADOS_MORBT',	
		round(SUM(AGENDADOS_FINAL_MORBT)/SUM(OFERTADO_MORBT)*100,1) 	 AS 'AGENDA_FINAL_PROCENTAJE_MORBT',															
		round(SUM(AGENDADOS_CONFIRMADO_MORBT)/SUM(AGENDADOS_FINAL_MORBT)*100,1) AS 'AGENDADOS_PORCENTAJE_MORBT',
		round(((SUM(AGENDADOS_FINAL_MORBT)-SUM(AGENDADOS_CONFIRMADO_MORBT))/SUM(AGENDADOS_FINAL_MORBT))*100,1) AS 'INASISTENTE_PORCENTAJE_MORBT',
										SUM(OFERTADO_MORBI)  			 AS 'OFERTADO_MORBI',
										SUM(AGENDADOS_MORBI) 			 AS 'AGENDADOS_MORBI',
										SUM(AGENDADOS_MORBI_FORZADOS) 	 AS 'AGENDADOS_MORBI_FORZADOS',
										SUM(AGENDADOS_CONFIRMADO_MORBI)  AS 'AGENDADOS_CONFIRMADO_MORBI',
									    SUM(BLOQUES_NO_AGENDADOS_MORBI)	 AS 'BLOQUES_NO_AGENDADOS_MORBI',
		round(SUM(AGENDADOS_MORBI)/SUM(OFERTADO_MORBI)*100,1) AS 'AGENDA_FINAL_PROCENTAJE_MORBI',																							
		round(SUM(AGENDADOS_CONFIRMADO_MORBI)/SUM(AGENDADOS_MORBI)*100,1) AS 'AGENDADOS_PORCENTAJE_MORBI',
		round(((SUM(AGENDADOS_MORBI)-SUM(AGENDADOS_CONFIRMADO_MORBI))/SUM(AGENDADOS_MORBI))*100,1) AS 'INASISTENTE_PORCENTAJE_MORBI'
					FROM agenda_ocupacion_morbilidad where FECHAOFERTA BETWEEN '{$this->getDesde()}' and '{$this->getHasta()}'
					GROUP BY CENTRO ORDER BY FECHAOFERTA,CENTRO_ORDENADO ASC";
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
				"CENTRO"						=> $fila[1],
				"OFERTADO_MORBT"				=>$fila[2],
				"AGENDADOS_MORBT_TELEFONICA"	=>$fila[3],
				"AGENDADOS_MESON_MORBT"			=>$fila[4],	
				"AGENDADOS_FINAL_MORBT"			=>$fila[5],
				"AGENDADOS_CONFIRMADO_MORBT"	=>$fila[6],
				"BLOQUES_NO_AGENDADOS_MORBT"	=>$fila[7],
				"AGENDA_FINAL_PROCENTAJE_MORBT"	=>$fila[8],
				"AGENDADOS_PORCENTAJE_MORBT"	=>$fila[8],
				"INASISTENTE_PORCENTAJE_MORBT"	=>$fila[8],
				"OFERTADO_MORBI"				=>$fila[8],
				"AGENDADOS_MORBI"				=>$fila[9],
				"AGENDADOS_MORBI_FORZADOS"		=>$fila[11],
				"AGENDADOS_CONFIRMADO_MORBI" 	=>$fila[12],
				"BLOQUES_NO_AGENDADOS_MORBI" 	=>$fila[13],
				"AGENDA_FINAL_PROCENTAJE_MORBI" =>$fila[14],
				"AGENDADOS_PORCENTAJE_MORBI" 	=>$fila[15],
				"INASISTENTE_PORCENTAJE_MORBI"  =>$fila[16]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}



 	public function OBTENER_DATOS_POR_DIA($bd){		
	$i=0;
	$data = Array();
	$sql = "SELECT  FECHAOFERTA 			 				 AS 'FECHAOFERTA',
		  						CENTRO 							 AS 'CENTRO',
								OFERTADO_MORBT  				 AS 'OFERTADO_MORBT',
								AGENDADOS_MORBT_TELEFONICA  	 AS 'AGENDADOS_MORBT_TELEFONICA',
								AGENDADOS_MESON_MORBT	 		 AS 'AGENDADOS_MESON_MORBT',
								AGENDADOS_FINAL_MORBT       	 AS 'AGENDADOS_FINAL_MORBT',
								AGENDADOS_CONFIRMADO_MORBT       AS 'AGENDADOS_CONFIRMADO_MORBT',
								BLOQUES_NO_AGENDADOS_MORBT       AS 'BLOQUES_NO_AGENDADOS_MORBT',
round(AGENDADOS_FINAL_MORBT/OFERTADO_MORBT*100,1) AS 'AGENDA_FINAL_PROCENTAJE_MORBT',									
round((AGENDADOS_CONFIRMADO_MORBT/AGENDADOS_FINAL_MORBT)*100,1)	 AS 'AGENDADOS_PORCENTAJE_MORBT',
round(((AGENDADOS_FINAL_MORBT-AGENDADOS_CONFIRMADO_MORBT)/AGENDADOS_FINAL_MORBT)*100,1) AS 'INASISTENTE_PORCENTAJE_MORBT',
								OFERTADO_MORBI		   			 AS 'OFERTADO_MORBI',
								AGENDADOS_MORBI	  	 			 AS 'AGENDADOS_MORBI',
								AGENDADOS_MORBI_FORZADOS 	     AS 'AGENDADOS_MORBI_FORZADOS',	
								AGENDADOS_CONFIRMADO_MORBI		 AS 'AGENDADOS_CONFIRMADO_MORBI',
							    BLOQUES_NO_AGENDADOS_MORBI		 AS 'BLOQUES_NO_AGENDADOS_MORBI',
round(AGENDADOS_MORBI/OFERTADO_MORBT*100,1) AS 'AGENDA_FINAL_PROCENTAJE_MORBI',									
round((AGENDADOS_CONFIRMADO_MORBI/AGENDADOS_MORBI)*100,1)	 AS 'AGENDADOS_PORCENTAJE_MORBI',
round(((AGENDADOS_MORBI-AGENDADOS_CONFIRMADO_MORBI)/AGENDADOS_MORBI)*100,1) AS 'INASISTENTE_PORCENTAJE_MORBI'
	FROM agenda_ocupacion_morbilidad where CENTRO_ID IN('{$this->getCentro()}') AND FECHAOFERTA BETWEEN '{$this->getDesde()}' and '{$this->getHasta()}'
		  	ORDER BY FECHAOFERTA,CENTRO_ORDENADO ASC";

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
				"CENTRO"						=> $fila[1],
				"OFERTADO_MORBT"				=>$fila[2],
				"AGENDADOS_MORBT_TELEFONICA"	=>$fila[3],
				"AGENDADOS_MESON_MORBT"			=>$fila[4],	
				"AGENDADOS_FINAL_MORBT"			=>$fila[5],
				"AGENDADOS_CONFIRMADO_MORBT"	=>$fila[6],
				"BLOQUES_NO_AGENDADOS_MORBT"	=>$fila[7],
				"AGENDA_FINAL_PROCENTAJE_MORBT"	=>$fila[8],
				"AGENDADOS_PORCENTAJE_MORBT"	=>$fila[8],
				"INASISTENTE_PORCENTAJE_MORBT"	=>$fila[8],
				"OFERTADO_MORBI"				=>$fila[8],
				"AGENDADOS_MORBI"				=>$fila[9],
				"AGENDADOS_MORBI_FORZADOS"		=>$fila[11],
				"AGENDADOS_CONFIRMADO_MORBI" 	=>$fila[12],
				"BLOQUES_NO_AGENDADOS_MORBI" 	=>$fila[13],
				"AGENDA_FINAL_PROCENTAJE_MORBI" =>$fila[14],
				"AGENDADOS_PORCENTAJE_MORBI" 	=>$fila[15],
				"INASISTENTE_PORCENTAJE_MORBI"  =>$fila[16]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}


public function OBTENER_VALORES_POR_DIA($bd){		
	$i=0;
	$data = Array();

	$arr = $this->getDesde();
	$sql = "SELECT '$semana_desc' 		 AS 'FECHAOFERTA',
								CENTRO 							 AS 'CENTRO',
								SUM(OFERTADO_MORBT)  			 AS 'OFERTADO_MORBT',
								SUM(AGENDADOS_MORBT_TELEFONICA)  AS 'AGENDADOS_MORBT_TELEFONICA',
								SUM(AGENDADOS_MESON_MORBT)   	 AS 'AGENDADOS_MESON_MORBT',
								SUM(AGENDADOS_FINAL_MORBT)   	 AS 'AGENDADOS_FINAL_MORBT',								
								SUM(AGENDADOS_CONFIRMADO_MORBT)  AS 'AGENDADOS_CONFIRMADO_MORBT',
								SUM(BLOQUES_NO_AGENDADOS_MORBT)  AS 'BLOQUES_NO_AGENDADOS_MORBT',	
round(SUM(AGENDADOS_FINAL_MORBT)/SUM(OFERTADO_MORBT)*100,1) AS 'AGENDA_FINAL_PROCENTAJE_MORBT',															
round(SUM(AGENDADOS_CONFIRMADO_MORBT)/SUM(AGENDADOS_FINAL_MORBT)*100,1) AS 'AGENDADOS_PORCENTAJE_MORBT',
round(((SUM(AGENDADOS_FINAL_MORBT)-SUM(AGENDADOS_CONFIRMADO_MORBT))/SUM(AGENDADOS_FINAL_MORBT))*100,1) AS 'INASISTENTE_PORCENTAJE_MORBT',
								SUM(OFERTADO_MORBI)  			 AS 'OFERTADO_MORBI',
								SUM(AGENDADOS_MORBI) 			 AS 'AGENDADOS_MORBI',
								SUM(AGENDADOS_MORBI_FORZADOS) 	 AS 'AGENDADOS_MORBI_FORZADOS',
								SUM(AGENDADOS_CONFIRMADO_MORBI)  AS 'AGENDADOS_CONFIRMADO_MORBI',
							    SUM(BLOQUES_NO_AGENDADOS_MORBI)	 AS 'BLOQUES_NO_AGENDADOS_MORBI',
round(SUM(AGENDADOS_MORBI)/SUM(OFERTADO_MORBI)*100,1) AS 'AGENDA_FINAL_PROCENTAJE_MORBI',										
round(SUM(AGENDADOS_CONFIRMADO_MORBI)/SUM(AGENDADOS_MORBI)*100,1) AS 'AGENDADOS_PORCENTAJE_MORBI',
round(((SUM(AGENDADOS_MORBI)-SUM(AGENDADOS_CONFIRMADO_MORBI))/SUM(AGENDADOS_MORBI))*100,1) AS 'INASISTENTE_PORCENTAJE_MORBI'

			FROM agenda_ocupacion_morbilidad where FECHAOFERTA IN (".implode(',',$arr).") GROUP BY CENTRO 
			ORDER BY FECHAOFERTA,CENTRO_ORDENADO ASC";

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
				"CENTRO"						=> $fila[1],
				"OFERTADO_MORBT"				=>$fila[2],
				"AGENDADOS_MORBT_TELEFONICA"	=>$fila[3],
				"AGENDADOS_MESON_MORBT"			=>$fila[4],	
				"AGENDADOS_FINAL_MORBT"			=>$fila[5],
				"AGENDADOS_CONFIRMADO_MORBT"	=>$fila[6],
				"BLOQUES_NO_AGENDADOS_MORBT"	=>$fila[7],
				"AGENDA_FINAL_PROCENTAJE_MORBT"	=>$fila[8],
				"AGENDADOS_PORCENTAJE_MORBT"	=>$fila[8],
				"INASISTENTE_PORCENTAJE_MORBT"	=>$fila[8],
				"OFERTADO_MORBI"				=>$fila[8],
				"AGENDADOS_MORBI"				=>$fila[9],
				"AGENDADOS_MORBI_FORZADOS"		=>$fila[11],
				"AGENDADOS_CONFIRMADO_MORBI" 	=>$fila[12],
				"BLOQUES_NO_AGENDADOS_MORBI" 	=>$fila[13],
				"AGENDA_FINAL_PROCENTAJE_MORBI" =>$fila[14],
				"AGENDADOS_PORCENTAJE_MORBI" 	=>$fila[15],
				"INASISTENTE_PORCENTAJE_MORBI"  =>$fila[16]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}

public function OBTENER_VALORES_POR_DIA_CENTRO($bd){		
	$i=0;
	$data = Array();

	$arr = $this->getDesde();
	$sql = "SELECT  FECHAOFERTA 		 AS 'FECHAOFERTA',
								CENTRO 							 AS 'CENTRO',
								OFERTADO_MORBT  				 AS 'OFERTADO_MORBT',
								AGENDADOS_MORBT_TELEFONICA  	 AS 'AGENDADOS_MORBT_TELEFONICA',
								AGENDADOS_MESON_MORBT	 		 AS 'AGENDADOS_MESON_MORBT',
								AGENDADOS_FINAL_MORBT   	 AS 'AGENDADOS_FINAL_MORBT',	
								AGENDADOS_CONFIRMADO_MORBT       AS 'AGENDADOS_CONFIRMADO_MORBT',
								BLOQUES_NO_AGENDADOS_MORBT       AS 'BLOQUES_NO_AGENDADOS_MORBT',
round(AGENDADOS_FINAL_MORBT/OFERTADO_MORBT*100,1) AS 'AGENDA_FINAL_PROCENTAJE_MORBT',									
round((AGENDADOS_CONFIRMADO_MORBT/AGENDADOS_FINAL_MORBT)*100,1)	 AS 'AGENDADOS_PORCENTAJE_MORBT',
round(((AGENDADOS_FINAL_MORBT-AGENDADOS_CONFIRMADO_MORBT)/AGENDADOS_FINAL_MORBT)*100,1) AS 'INASISTENTE_PORCENTAJE_MORBT',
								OFERTADO_MORBI		   			 AS 'OFERTADO_MORBI',
								AGENDADOS_MORBI	  	 			 AS 'AGENDADOS_MORBI',
								AGENDADOS_MORBI_FORZADOS 	     AS 'AGENDADOS_MORBI_FORZADOS',	
								AGENDADOS_CONFIRMADO_MORBI		 AS 'AGENDADOS_CONFIRMADO_MORBI',
							    BLOQUES_NO_AGENDADOS_MORBI		 AS 'BLOQUES_NO_AGENDADOS_MORBI',
round(AGENDADOS_MORBI/OFERTADO_MORBT*100,1) AS 'AGENDA_FINAL_PROCENTAJE_MORBI',																	
round((AGENDADOS_CONFIRMADO_MORBI/AGENDADOS_MORBI)*100,1)	 AS 'AGENDADOS_PORCENTAJE_MORBI',
round(((AGENDADOS_MORBI-AGENDADOS_CONFIRMADO_MORBI)/AGENDADOS_MORBI)*100,1) AS 'INASISTENTE_PORCENTAJE_MORBI'
			FROM agenda_ocupacion_morbilidad where CENTRO_ID IN('{$this->getCentro()}') AND FECHAOFERTA IN (".implode(',',$arr).") 
			ORDER BY FECHAOFERTA,CENTRO_ORDENADO ASC";

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
				"CENTRO"						=> $fila[1],
				"OFERTADO_MORBT"				=>$fila[2],
				"AGENDADOS_MORBT_TELEFONICA"	=>$fila[3],
				"AGENDADOS_MESON_MORBT"			=>$fila[4],	
				"AGENDADOS_FINAL_MORBT"			=>$fila[5],
				"AGENDADOS_CONFIRMADO_MORBT"	=>$fila[6],
				"BLOQUES_NO_AGENDADOS_MORBT"	=>$fila[7],
				"AGENDA_FINAL_PROCENTAJE_MORBT"	=>$fila[8],
				"AGENDADOS_PORCENTAJE_MORBT"	=>$fila[8],
				"INASISTENTE_PORCENTAJE_MORBT"	=>$fila[8],
				"OFERTADO_MORBI"				=>$fila[8],
				"AGENDADOS_MORBI"				=>$fila[9],
				"AGENDADOS_MORBI_FORZADOS"		=>$fila[11],
				"AGENDADOS_CONFIRMADO_MORBI" 	=>$fila[12],
				"BLOQUES_NO_AGENDADOS_MORBI" 	=>$fila[13],
				"AGENDA_FINAL_PROCENTAJE_MORBI" =>$fila[14],
				"AGENDADOS_PORCENTAJE_MORBI" 	=>$fila[15],
				"INASISTENTE_PORCENTAJE_MORBI"  =>$fila[16]
				);				
		  $i++;
		}//end while
	}//fin else

	return $data;
}

}//end class