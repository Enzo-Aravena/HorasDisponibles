<?php

class ocupacionAgenda{

private $id;

public function getId(){
	return $this->id;
}

public function setId($id){
	return $this->id = $id;
}

function CargarSelectdata($bd){
	$i=0;
	$data = Array();
	$sql="call cargaSelectOcupacionAgenda()";
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
			"acto"			=>utf8_encode($fila[0]),
			"descripcion"   =>utf8_encode($fila[1])
			);//end array
	  $i++;
	}//end while
	}//fin else
	return $data;
}

function cargarMenuAgenda($bd){
	$i=0;
	$data = Array();
	$sql="call cargaMenuAgenda()";
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
			"nombre"    => $fila[0],						
			"url" 		=> $fila[1],
			"imagen"    => $fila[2]
			);//end array
	  $i++;
	}//end while
	}//fin else
	return $data;
}



function cargaDataGrafico($bd){
	$i=0;
	$data = Array();
	$sql="call ()";
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
			"nombre"    => $fila[0],						
			"url" 		=> $fila[1],
			"imagen"    => $fila[2]
			);//end array
	  $i++;
	}//end while
	}//fin else
	return $data;
}


/*

-- busca por toda la data

SELECT 'Semanal' AS 'FECHAOFERTA',
CENTRO 							 AS 'CENTRO',
ACTO 							 AS 'ACTO',
DESC_ACTO						 AS 'DESC_ACTO',
SUM(OFERTADO)  					 AS 'OFERTADO',
SUM(AGENDADOS)  				 AS 'AGENDADOS',
SUM(AGENDADOS_CONFIRMADO)  	 	 AS 'AGENDADOS_CONFIRMADO',
SUM(BLOQUES_NO_AGENDADOS)	 	 AS 'BLOQUES_NO_AGENDADOS',	
round(SUM(AGENDADOS)/SUM(OFERTADO)*100,1) 					 AS 'AGENDA_FINAL_PROCENTAJE',															
round(((SUM(AGENDADOS_CONFIRMADO)/SUM(AGENDADOS))*100),1) 	 AS 'CONFIRMADO_PORCENTAJE',
round(((SUM(AGENDADOS)-SUM(AGENDADOS_CONFIRMADO))/SUM(AGENDADOS))*100,1) AS 'INASISTENTES_PORCENTAJE'
FROM agenda_actos where FECHAOFERTA BETWEEN '2015-02-03' and '2015-02-13' and acto = 'MEDCR'
GROUP BY CENTRO ORDER BY FECHAOFERTA,CENTRO_ORDENADO ASC;

-- --------------------------------------------------------------------------------------------------
SELECT FECHAOFERTA				 AS 'FECHAOFERTA',
CENTRO 							 AS 'CENTRO',
ACTO 							 AS 'ACTO',
DESC_ACTO						 AS 'DESC_ACTO',
OFERTADO  						 AS 'OFERTADO',
AGENDADOS  						 AS 'AGENDADOS',
AGENDADOS_CONFIRMADO  		 	 AS 'AGENDADOS_CONFIRMADO',
BLOQUES_NO_AGENDADOS	 		 AS 'BLOQUES_NO_AGENDADOS',
round((AGENDADOS/OFERTADO)*100,1) 								 AS 'AGENDA_FINAL_PROCENTAJE',		
round(((AGENDADOS_CONFIRMADO/AGENDADOS)*100),1)			     AS 'CONFIRMADO_PORCENTAJE',
round(((AGENDADOS-AGENDADOS_CONFIRMADO)/AGENDADOS)*100,1) 		 AS 'INASISTENTES_PORCENTAJE'								
FROM agenda_actos where CENTRO_ID IN(1) AND FECHAOFERTA BETWEEN '2015-02-03' and '2015-02-13' and acto = 'MEDCR'
ORDER BY FECHAOFERTA,CENTRO_ORDENADO ASC      

-- -------------------------------------------------------------------------------------------------------
*/



 }// fin clase principal

 ?>