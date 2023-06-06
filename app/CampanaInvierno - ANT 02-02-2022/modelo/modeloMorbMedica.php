<?php

class claseMorbMedica
{

	private $desde;
	private $hasta;

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



	function obtenerTotalAtenciones($bd){
		$i=0;$j= 0;
		$cuerpo = Array();
		$sql="SELECT 
	   SEPI.FECHA 			  		AS 'FECHA_CITA',
	   CEN.ID_CENTRO_ORDENADO 		AS 'ID_CENTRO',
	   CEN.NOM_CENTRO 				AS 'CENTRO',
       (SELECT COUNT(*) FROM DB_PAGINA_RC.MORBILIDAD_MEDICA MOR WHERE CEN.ID_CENTRO = MOR.CENTRO_ID AND MOR.FECHA_CITA = SEPI.FECHA AND MOR.ES_FORZADA = 0) AS 'ESTIMADO' 
	    FROM
			DB_PAGINA_RC.CENTRO CEN,
				DB_PAGINA_RC.SEMANA_EPIDEMIOLOGICA SEPI 
	    WHERE 
			  SEPI.FECHA BETWEEN '{$this->getDesde()}' and '{$this->getHasta()}'
		  AND CEN.ID_CENTRO IN (1,2,3,4,5,12,13) AND SEPI.DIA_SEMANA_COD IN (2,3,4,5,6,7)
	    GROUP BY SEPI.FECHA 
	    ORDER BY SEPI.FECHA,CEN.ID_CENTRO_ORDENADO";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$cuerpo = array(
				"data" =>"0",
				"fecha_cita"					=> "0",
				"CENTRO_ORDENADO"				=> "0",
				"CENTRO"						=> "0",
				"ESTIMADO"						=> "0"
			);
		}else{
		while ($fila = mysqli_fetch_row($resultado)) {
				$cuerpo[$i] = Array(
					"data"				   			=>"1",
					"fecha_cita"					=> $fila[0],
					"CENTRO_ORDENADO"				=> $fila[1],
					"CENTRO"						=> $fila[2],
					"ESTIMADO"						=> $fila[3]
				);				
			$i++;
		}//end while
		}//fin else

		return $cuerpo;
	}


	function obtenerTotalAtencionesValor($bd){
		$i = 0;
		$totalEstimado = 0;
		//'2019-06-17' and '2019-06-22'
		$cuerpo = Array();
		$cuerpo2 = Array();

		$sql="SELECT 
		  SEPI.FECHA  	AS 'FECHA_CITA',
		  CEN.ID_CENTRO_ORDENADO AS 'ID_CENTRO',
		  CEN.NOM_CENTRO AS 'CENTRO',
		      (SELECT COUNT(*) FROM DB_PAGINA_RC.MORBILIDAD_MEDICA MOR WHERE CEN.ID_CENTRO = MOR.CENTRO_ID AND MOR.FECHA_CITA = SEPI.FECHA AND MOR.CUMPLE_CRITERIOS = 'SI' ) AS 'ESTIMADO' 
		   FROM
		DB_PAGINA_RC.CENTRO CEN,
		DB_PAGINA_RC.SEMANA_EPIDEMIOLOGICA SEPI 
		   WHERE 
		 SEPI.FECHA BETWEEN '{$this->getDesde()}' and '{$this->getHasta()}'
		 AND CEN.ID_CENTRO IN (1,2,3,4,5,12,13) AND SEPI.DIA_SEMANA_COD IN (2,3,4,5,6,7)
		   GROUP BY SEPI.FECHA,CEN.ID_CENTRO_ORDENADO 
		   ORDER BY SEPI.FECHA,CEN.ID_CENTRO_ORDENADO";

		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$cuerpo = array(
				"data" =>"0",
				"fecha_cita"					=> "0",
				"CENTRO_ORDENADO"				=> "0",
				"CENTRO"						=> "0",
				"ESTIMADO"						=> "0"
			);
		}else{
			$cotador = 0;
			while ($fila = mysqli_fetch_row($resultado)) {

				$cuerpo[$i] = Array(
					"data"	=>"1",
					"fecha_cita"	=> $fila[0],
					"CENTRO_ORDENADO"	=> $fila[1],
					"CENTRO"	=> $fila[2],
					"ESTIMADO"	=> $fila[3]
				);

				if($i == 6){
					$totalEstimado = $totalEstimado + $fila[3];
					$cuerpo[$i+1] = Array(
						"data"	=>"1",
						"ESTIMADO"	=> $totalEstimado
					);
					array_push($cuerpo2,$cuerpo);
					$i = 0;
					$totalEstimado = 0;
				}else{
					$totalEstimado = $totalEstimado + $fila[3];
					$i++;
				}
			}//end while
		}//fin else

		return $cuerpo2;
	}


	function obtenerTotalCuposconActoMorb($bd){
		$i = 0;
		$totalEstimado = 0;
		$cuerpo = Array();
		$cuerpo2 = Array();

		$sql="SELECT 
			SEPI.FECHA  	AS 'FECHA_CITA',
			CEN.ID_CENTRO_ORDENADO AS 'ID_CENTRO',
			CEN.NOM_CENTRO AS 'CENTRO',
			(SELECT COUNT(*) FROM DB_PAGINA_RC.MORBILIDAD_MEDICA MOR WHERE CEN.ID_CENTRO = MOR.CENTRO_ID AND MOR.FECHA_CITA = SEPI.FECHA AND MOR.ES_FORZADA = 0) AS 'ESTIMADO' 
			FROM
			DB_PAGINA_RC.CENTRO CEN,
			DB_PAGINA_RC.SEMANA_EPIDEMIOLOGICA SEPI 
			WHERE 
			SEPI.FECHA between '{$this->getDesde()}' and '{$this->getHasta()}'
			AND CEN.ID_CENTRO IN (1,2,3,4,5,12,13) AND SEPI.DIA_SEMANA_COD IN (2,3,4,5,6,7)
			GROUP BY SEPI.FECHA,CEN.ID_CENTRO_ORDENADO 
			ORDER BY SEPI.FECHA,CEN.ID_CENTRO_ORDENADO";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$cuerpo = array(
				"data" =>"0",
				"fecha_cita"					=> "0",
				"CENTRO_ORDENADO"				=> "0",
				"CENTRO"						=> "0",
				"ESTIMADO"						=> "0"
			);
		}else{

			while ($fila = mysqli_fetch_row($resultado)) {	

				$cuerpo[$i] = Array(
					"data"	=>"1",
					"fecha_cita"	=> $fila[0],
					"CENTRO_ORDENADO"	=> $fila[1],
					"CENTRO"	=> $fila[2],
					"ESTIMADO"	=> $fila[3]
				);	

				if($i == 6){
					$totalEstimado = $totalEstimado + $fila[3];

					$cuerpo[$i+1] = Array(
						"data"	=>"1",
						"ESTIMADO"	=> $totalEstimado
					);	

					array_push($cuerpo2,$cuerpo);
					$i = 0;
					$totalEstimado = 0;
				}else{
					$totalEstimado = $totalEstimado + $fila[3];
					$i++;
				}
				

			}//end while
		}//fin else

		return $cuerpo2;
	}

	function obtenerTotalCuposEnviadosGda($bd){
		$i = 0;
		$totalEstimado = 0;
		$cuerpo = Array();
		$cuerpo2 = Array();

		$sql=" SELECT 
	   SEPI.FECHA 			  		AS 'FECHA_CITA',
	   CEN.ID_CENTRO_ORDENADO 		AS 'ID_CENTRO',
	   CEN.NOM_CENTRO 				AS 'CENTRO',
       (SELECT COUNT(*) FROM DB_PAGINA_RC.MORBILIDAD_MEDICA MOR WHERE CEN.ID_CENTRO = MOR.CENTRO_ID AND MOR.FECHA_CITA = SEPI.FECHA  AND MOR.CITA_ENVIADA_TELEFONICA = 'SI') AS 'ESTIMADO' 
	    FROM
			DB_PAGINA_RC.CENTRO CEN,
				DB_PAGINA_RC.SEMANA_EPIDEMIOLOGICA SEPI 
	    WHERE 
			  SEPI.FECHA BETWEEN  '{$this->getDesde()}' and '{$this->getHasta()}'
		  AND CEN.ID_CENTRO IN (1,2,3,4,5,12,13) AND SEPI.DIA_SEMANA_COD IN (2,3,4,5,6,7)
	    GROUP BY SEPI.FECHA,CEN.ID_CENTRO_ORDENADO 
	    ORDER BY SEPI.FECHA,CEN.ID_CENTRO_ORDENADO";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$cuerpo = array(
				"data" =>"0",
				"fecha_cita"					=> "0",
				"CENTRO_ORDENADO"				=> "0",
				"CENTRO"						=> "0",
				"ESTIMADO"						=> "0"
			);
		}else{

			while ($fila = mysqli_fetch_row($resultado)) {	

				$cuerpo[$i] = Array(
					"data"	=>"1",
					"fecha_cita"	=> $fila[0],
					"ID_CENTRO"	=> $fila[1],
					"CENTRO"	=> $fila[2],
					"ESTIMADO"	=> $fila[3]
				);	

				if($i == 6){
					$totalEstimado = $totalEstimado + $fila[3];

					$cuerpo[$i+1] = Array(
						"data"	=>"1",
						"ESTIMADO"	=> $totalEstimado
					);	

					array_push($cuerpo2,$cuerpo);
					$i = 0;
					$totalEstimado = 0;
				}else{
					$totalEstimado = $totalEstimado + $fila[3];
					$i++;
				}
				

			}//end while
		}//fin else

		return $cuerpo2;
	}

	function OBTENER_MORBILIDAD_DIARIA_TOTAL($bd){
		$i=0;
		$cuerpo = Array();
		$cuerpo2 = Array();
		$sql = "call db_pagina_rc.OBTENER_MORBILIDAD_DIARIA_TOTAL('{$this->getDesde()}', '{$this->getHasta()}')";
		//$sql = "call db_pagina_rc.OBTENER_MORBILIDAD_DIARIA_TOTAL_PRUEBA('{$this->getDesde()}', '{$this->getHasta()}')";
		
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$cuerpo = array(
				"data" =>"0",
				"CANTIDAD" 	=> 	"0"
			);
		}else{
		while ($fila = mysqli_fetch_row($resultado)) {
				$cuerpo[$i] = Array(
					"data"		=>"1",
					"CANTIDAD"	=> $fila[0]
				);

				if ($i == 7){
					$cuerpo[$i+1] = Array();
					array_push($cuerpo2,$cuerpo);
					$i = 0;
				}else{
					$i++;
				}

		}//end while
		}//fin else

		return $cuerpo2;
	}
	

}

?>