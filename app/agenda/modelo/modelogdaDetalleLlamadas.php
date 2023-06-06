<?php

class modeloGdaDetLlamadas{
	
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

 	/***************************************************************************************/
 	//					SP QUE CONTIENEN EL GRAFICO
 	/***************************************************************************************/

 	public function obtenerTodoElDetalleLlamadasGDA($bd){
		$i=0;
		$data = Array();
		$sql = "SELECT 'Semanal' AS 'FECHAOFERTA',
					CENTRO 							 AS 'CENTRO',
					SUM(OFERTADO_MORBT)  			 AS 'OFERTADO_MORBT',
					SUM(LLAMADAS_MORBT_TELEFONICA)   AS 'LLAMADAS_MORBT_TELEFONICA',
					SUM(AGENDADOS_MORBT_TELEFONICA)  AS 'AGENDADOS_MORBT_TELEFONICA',
					SUM(CANCELADOS_MORBT_TELEFONICA) AS 'CANCELADOS_MORBT_TELEFONICA',
					SUM(RUT_AGOTADOS)    			 AS 'AGOTADOS'
				FROM agenda_gda_detalle_llamadas where FECHAOFERTA BETWEEN '{$this->getDesde()}' and '{$this->getHasta()}'
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
					"CENTRO"       					=> $fila[1],
					"OFERTADO_MORBT"				=>$fila[2],
					"LLAMADAS_MORBT_TELEFONICA"		=>$fila[3],
					"AGENDADOS_MORBT_TELEFONICA"	=>$fila[4],	
					"CANCELADOS_MORBT_TELEFONICA"	=>$fila[5],
					"AGOTADOS"						=>$fila[6]
					);				
			  $i++;
			}//end while
		}//fin else

		return $data;
	}

	public function OBTENER_DATOS_POR_DIA($bd){
		$i=0;
		$data = Array();
		//$sql="CALL OBTENER_DATOS_POR_DIA('{$this->getDesde()}','{$this->getHasta()}',{$this->getCentro()})";

		$sql = "SELECT  FECHAOFERTA 			 AS 'FECHAOFERTA',
			  						CENTRO 							 AS 'CENTRO',
									OFERTADO_MORBT   			     AS 'OFERTADO_MORBT',
									LLAMADAS_MORBT_TELEFONICA        AS 'LLAMADAS_MORBT_TELEFONICA',							
									AGENDADOS_MORBT_TELEFONICA  	 AS 'AGENDADOS_MORBT_TELEFONICA',
									CANCELADOS_MORBT_TELEFONICA		 AS 'CANCELADOS_MORBT_TELEFONICA',								
									RUT_AGOTADOS    			 	 AS 'AGOTADOS'
			  	FROM agenda_gda_detalle_llamadas where CENTRO_ID IN({$this->getCentro()}) AND FECHAOFERTA BETWEEN '{$this->getDesde()}' and '{$this->getHasta()}'
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
					"CENTRO"       					=> $fila[1],
					"OFERTADO_MORBT"				=>$fila[2],
					"LLAMADAS_MORBT_TELEFONICA"		=>$fila[3],
					"AGENDADOS_MORBT_TELEFONICA"	=>$fila[4],	
					"CANCELADOS_MORBT_TELEFONICA"	=>$fila[5],
					"AGOTADOS"						=>$fila[6]
					);				
			  $i++;
			}//end while
		}//fin else

		return $data;
	}

	public function OBTENER_VALORES_POR_DIA($bd){
		$i=0;
		$data = Array();
		$sql = "SELECT FECHAOFERTA 		 AS 'FECHAOFERTA',
								CENTRO 				 			 AS 'CENTRO',
								SUM(OFERTADO_MORBT)  			 AS 'OFERTADO_MORBT',
								SUM(LLAMADAS_MORBT_TELEFONICA)   AS 'LLAMADAS_MORBT_TELEFONICA',
								SUM(AGENDADOS_MORBT_TELEFONICA)  AS 'AGENDADOS_MORBT_TELEFONICA',
								SUM(CANCELADOS_MORBT_TELEFONICA)  AS 'CANCELADOS_MORBT_TELEFONICA',
								SUM(RUT_AGOTADOS)    			 AS 'AGOTADOS'
			FROM agenda_gda_detalle_llamadas where FECHAOFERTA IN ({$this->getDesde()}) GROUP BY CENTRO 
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
					"CENTRO"       					=> $fila[1],
					"OFERTADO_MORBT"				=>$fila[2],
					"LLAMADAS_MORBT_TELEFONICA"		=>$fila[3],
					"AGENDADOS_MORBT_TELEFONICA"	=>$fila[4],	
					"CANCELADOS_MORBT_TELEFONICA"	=>$fila[5],
					"AGOTADOS"						=>$fila[6]
					);				
			  $i++;
			}//end while
		}//fin else

		return $data;
	}

	public function OBTENER_VALORES_POR_DIA_CENTRO($bd){
		$i=0;
		$data = Array();
		//$sql="CALL OBTENER_VALORES_POR_DIA({$this->getDesde()})";
		$sql = "SELECT  FECHAOFERTA 		 AS 'FECHAOFERTA',
								CENTRO 							 AS 'CENTRO',
								OFERTADO_MORBT   			     AS 'OFERTADO_MORBT',
								LLAMADAS_MORBT_TELEFONICA        AS 'LLAMADAS_MORBT_TELEFONICA',		
								AGENDADOS_MORBT_TELEFONICA  	 AS 'AGENDADOS_MORBT_TELEFONICA',
								CANCELADOS_MORBT_TELEFONICA   	 AS 'CANCELADOS_MORBT_TELEFONICA',
							    RUT_AGOTADOS    			 	 AS 'AGOTADOS'
			FROM agenda_gda_detalle_llamadas where CENTRO_ID IN({$this->getCentro()}) AND FECHAOFERTA IN ({$this->getDesde()}) 
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
					"CENTRO"       					=> $fila[1],
					"OFERTADO_MORBT"				=>$fila[2],
					"LLAMADAS_MORBT_TELEFONICA"		=>$fila[3],
					"AGENDADOS_MORBT_TELEFONICA"	=>$fila[4],	
					"CANCELADOS_MORBT_TELEFONICA"	=>$fila[5],
					"AGOTADOS"						=>$fila[6]
					);				
			  $i++;
			}//end while
		}//fin else

		return $data;
	}


	/***************************************************************************************/
 	//					SP QUE CARGA LA TABLA
 	/***************************************************************************************/

	public function OBTENER_TABLA_UNO($bd){
		$i=0;
		$data = Array();
		$sql = "SELECT 		'Semanal'						 AS 'FECHAOFERTA',
		  						CENTRO 							 AS 'CENTRO',
								SUM(OFERTADO_MORBT)  			 AS 'OFERTADO_MORBT',
								SUM(LLAMADAS_MORBT_TELEFONICA)   AS 'LLAMADAS_MORBT_TELEFONICA',	
								SUM(AGENDADOS_MORBT_TELEFONICA)  AS 'AGENDADOS_MORBT_TELEFONICA',								
								SUM(CANCELADOS_MORBT_TELEFONICA) AS 'CANCELADOS_MORBT_TELEFONICA',		
								SUM(CANCELADOS_MORBT_MESON)      AS 'CANCELADOS_MORBT_MESON',														
								SUM(CANCELADOS_MORBT_PERSONA)    AS 'CANCELADOS_MORBT_PERSONA',
								PRIMERA_HORA_AGOTADOS     		 AS 'PRIMERA_HORA_AGOTADOS',
								SUM(NUMERO_AGOTADOS)   			 AS 'NUMERO_AGOTADOS',
								SUM(RUT_AGOTADOS)    			 AS 'AGOTADOS',
								round((SUM(RUT_AGOTADOS)/(SUM(OFERTADO_MORBT)*10))*100,1) AS 'TASA_AGOTADOS' 
			FROM agenda_gda_detalle_llamadas where FECHAOFERTA BETWEEN '2019/06/05' and '2019/06/06'
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
					"CENTRO"       					=> strtolower($fila[1]),
					"OFERTADO_MORBT"				=>$fila[2],
					"LLAMADAS_MORBT_TELEFONICA"		=>$fila[3],
					"AGENDADOS_MORBT_TELEFONICA"	=>$fila[4],	
					"CANCELADOS_MORBT_TELEFONICA"	=>$fila[5],
					"CANCELADOS_MORBT_MESON"		=>$fila[6],
					"CANCELADOS_MORBT_PERSONA"		=>$fila[7],
					"PRIMERA_HORA_AGOTADOS"			=>$fila[8],
					"NUMERO_AGOTADOS"				=>$fila[9],
					"AGOTADOS"						=>$fila[10],
					"TASA_AGOTADOS"					=>$fila[11]
					);				
			  $i++;
			}//end while
		}//fin else

		return $data;
	}


	public function OBTENER_TABLA_DOS($bd){
		$i=0;
		$data = Array();
		$sql = "SELECT  FECHAOFERTA 			 				 AS 'FECHAOFERTA',
		  						CENTRO 							 AS 'CENTRO',
								OFERTADO_MORBT  				 AS 'OFERTADO_MORBT',
								LLAMADAS_MORBT_TELEFONICA        AS 'LLAMADAS_MORBT_TELEFONICA',	
								AGENDADOS_MORBT_TELEFONICA  	 AS 'AGENDADOS_MORBT_TELEFONICA',								
								CANCELADOS_MORBT_TELEFONICA 	 AS 'CANCELADOS_MORBT_TELEFONICA',		
								CANCELADOS_MORBT_MESON      	 AS 'CANCELADOS_MORBT_MESON',														
								CANCELADOS_MORBT_PERSONA    	 AS 'CANCELADOS_MORBT_PERSONA',
								PRIMERA_HORA_AGOTADOS       	 AS 'PRIMERA_HORA_AGOTADOS',
								NUMERO_AGOTADOS   			     AS 'NUMERO_AGOTADOS',
								RUT_AGOTADOS    			     AS 'AGOTADOS',
								round(TASA_AGOTADOS,1)			 AS 'TASA_AGOTADOS' 
		  FROM agenda_gda_detalle_llamadas where CENTRO_ID IN({$this->getCentro()}) AND FECHAOFERTA BETWEEN '{$this->getDesde()}' and '{$this->getHasta()}'
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
					"CENTRO"       					=> strtolower($fila[1]),
					"OFERTADO_MORBT"				=>$fila[2],
					"LLAMADAS_MORBT_TELEFONICA"		=>$fila[3],
					"AGENDADOS_MORBT_TELEFONICA"	=>$fila[4],	
					"CANCELADOS_MORBT_TELEFONICA"	=>$fila[5],
					"CANCELADOS_MORBT_MESON"		=>$fila[6],
					"CANCELADOS_MORBT_PERSONA"		=>$fila[7],
					"PRIMERA_HORA_AGOTADOS"			=>$fila[8],
					"NUMERO_AGOTADOS"				=>$fila[9],
					"AGOTADOS"						=>$fila[10],
					"TASA_AGOTADOS"					=>$fila[11]
					);				
			  $i++;
			}//end while
		}//fin else

		return $data;
	}


	public function OBTENER_TABLA_TRES($bd){

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
		$sql = "SELECT 'FECHAOFERTA' 		 AS 'FECHAOFERTA',
					CENTRO 							 AS 'CENTRO',
					SUM(OFERTADO_MORBT)  			 AS 'OFERTADO_MORBT',
					SUM(LLAMADAS_MORBT_TELEFONICA)   AS 'LLAMADAS_MORBT_TELEFONICA',	
					SUM(AGENDADOS_MORBT_TELEFONICA)  AS 'AGENDADOS_MORBT_TELEFONICA',								
					SUM(CANCELADOS_MORBT_TELEFONICA) AS 'CANCELADOS_MORBT_TELEFONICA',		
					SUM(CANCELADOS_MORBT_MESON)      AS 'CANCELADOS_MORBT_MESON',														
					SUM(CANCELADOS_MORBT_PERSONA)    AS 'CANCELADOS_MORBT_PERSONA',
					PRIMERA_HORA_AGOTADOS            AS 'PRIMERA_HORA_AGOTADOS',
					SUM(NUMERO_AGOTADOS)   			 AS 'NUMERO_AGOTADOS',
					SUM(RUT_AGOTADOS)    			 AS 'AGOTADOS',
					round((SUM(RUT_AGOTADOS)/(SUM(OFERTADO_MORBT)*10))*100,1) AS 'TASA_AGOTADOS'   
			FROM agenda_gda_detalle_llamadas where FECHAOFERTA IN ({$this->getDesde()}) GROUP BY CENTRO 
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
					"FECHAOFERTA"       			=> $nombre,
					"CENTRO"       					=> strtolower($fila[1]),
					"OFERTADO_MORBT"				=>$fila[2],
					"LLAMADAS_MORBT_TELEFONICA"		=>$fila[3],
					"AGENDADOS_MORBT_TELEFONICA"	=>$fila[4],	
					"CANCELADOS_MORBT_TELEFONICA"	=>$fila[5],
					"CANCELADOS_MORBT_MESON"		=>$fila[6],
					"CANCELADOS_MORBT_PERSONA"		=>$fila[7],
					"PRIMERA_HORA_AGOTADOS"			=>$fila[8],
					"NUMERO_AGOTADOS"				=>$fila[9],
					"AGOTADOS"						=>$fila[10],
					"TASA_AGOTADOS"					=>$fila[11]
					);				
			  $i++;
			}//end while
		}//fin else

		return $data;
	}


	public function OBTENER_TABLA_CUATRO($bd){
		$i=0;
		$data = Array();
		$sql = "SELECT  FECHAOFERTA 		 AS 'FECHAOFERTA',
								CENTRO 							 AS 'CENTRO',
								OFERTADO_MORBT  				 AS 'OFERTADO_MORBT',
								LLAMADAS_MORBT_TELEFONICA        AS 'LLAMADAS_MORBT_TELEFONICA',	
								AGENDADOS_MORBT_TELEFONICA  	 AS 'AGENDADOS_MORBT_TELEFONICA',								
								CANCELADOS_MORBT_TELEFONICA 	 AS 'CANCELADOS_MORBT_TELEFONICA',		
								CANCELADOS_MORBT_MESON      	 AS 'CANCELADOS_MORBT_MESON',														
								CANCELADOS_MORBT_PERSONA    	 AS 'CANCELADOS_MORBT_PERSONA',
								PRIMERA_HORA_AGOTADOS       	 AS 'PRIMERA_HORA_AGOTADOS',
								NUMERO_AGOTADOS   			     AS 'NUMERO_AGOTADOS',
								RUT_AGOTADOS    			     AS 'AGOTADOS',
								round(TASA_AGOTADOS,1)			 AS 'TASA_AGOTADOS' 
			FROM agenda_gda_detalle_llamadas where CENTRO_ID IN({$this->getCentro()}) AND FECHAOFERTA IN ({$this->getDesde()})
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
					"CENTRO"       					=> strtolower($fila[1]),
					"OFERTADO_MORBT"				=>$fila[2],
					"LLAMADAS_MORBT_TELEFONICA"		=>$fila[3],
					"AGENDADOS_MORBT_TELEFONICA"	=>$fila[4],	
					"CANCELADOS_MORBT_TELEFONICA"	=>$fila[5],
					"CANCELADOS_MORBT_MESON"		=>$fila[6],
					"CANCELADOS_MORBT_PERSONA"		=>$fila[7],
					"PRIMERA_HORA_AGOTADOS"			=>$fila[8],
					"NUMERO_AGOTADOS"				=>$fila[9],
					"AGOTADOS"						=>$fila[10],
					"TASA_AGOTADOS"					=>$fila[11]
					);				
			  $i++;
			}//end while
		}//fin else

		return $data;
	}


}

?>
