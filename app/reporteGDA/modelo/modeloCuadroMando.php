<?php

 class CuadroMandoGDA{

 	private $id;
 	private $centro;
 	private $ciclo;
 	private $agendado;
 	private $cancelado;
 	private $fechaHoy;


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

 	public function getAgendado(){
 		return $this->agendado;
 	}

 	public function setAgendado($agendado){
 		return $this->agendado = $agendado;
 	}

 	public function getCancelado(){
 		return $this->cancelado;
 	}

 	public function setCancelado($cancelado){
 		return $this->cancelado = $cancelado;
 	}

	public function getFechaHoy(){
 		return $this->fechaHoy;
 	}

 	public function setFechaHoy($fechaHoy){
 		return $this->fechaHoy = $fechaHoy;
 	}
 	
	public function celdaColor($dato){
		if($dato == "CARGA CORRECTA"){
			$color = "green";//velde
		}else
			if ($dato == "PENDIENTE") {
				$color = "#E8CC05"; // amarillo
			}else{
				$color ="#E80505";  // rojo
			}
		
		return $color;
	}
	

 	//metodo que trae los datos de los centros y ciclos gda
	public function CargarCuadroMando($bd){
 		$i=0;
		$data = Array();
		$totales = Array(0,0,0,0,0,0,0,0,0,0,0,0);
		$sql="call SP_Resumen_Ciclos({$this->getCentro()},'{$this->getFechaHoy()}')";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		if ($count == "0") {
			$data = array(
				"data" =>"0"
			);  
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {
				$data[$i]["data"] = 1;
				//OBTENER LOS NOMBRES DE LOS CENTROS ATRAVES DE SU CODIGO
				switch($fila[0])
				{
					case "1":		$nombreCentro="CU";		break;
					case "2":		$nombreCentro="LF";		break;
					case "3":		$nombreCentro="SL";		break;
					case "4":		$nombreCentro="LH";		break;
					case "5":		$nombreCentro="CSH";	break;
					case "12":		$nombreCentro="PGW";	break;
					default: 		$nombreCentro="-";		break;
				}
				
				$data[$i]["centro"] = $nombreCentro;
				$data[$i]["ciclo1"]	= array(
					"Agendado"       => $fila[1],
				    "colorAgendado"  => $this->celdaColor($fila[2]),
					"Cancelado"      => $fila[3],
				    "colorCancelado" => $this->celdaColor($fila[4])
				);
				$data[$i]["ciclo2"]	= array(
					"Agendado"       => $fila[5],
				    "colorAgendado"  => $this->celdaColor($fila[6]),
					"Cancelado"      => $fila[7],
				    "colorCancelado" => $this->celdaColor($fila[8])
				);
				$data[$i]["ciclo3"]	= array(
					"Agendado"       => $fila[9],
				    "colorAgendado"  => $this->celdaColor($fila[10]),
					"Cancelado"      => $fila[11],
				    "colorCancelado" => $this->celdaColor($fila[12])
				);
				$data[$i]["ciclo4"]	= array(
					"Agendado"       => $fila[13],
				    "colorAgendado"  => $this->celdaColor($fila[14]),
					"Cancelado"      => $fila[15],
				    "colorCancelado" => $this->celdaColor($fila[16])
				);
				$data[$i]["ciclo5"]	= array(
					"Agendado"       => $fila[17],
				    "colorAgendado"  => $this->celdaColor($fila[18]),
					"Cancelado"      => $fila[19],
				    "colorCancelado" => $this->celdaColor($fila[20])
				);
				
				//echo $fila[20];
				
				$sumCentoAgen=($fila[1]+$fila[5]+$fila[9]+$fila[13]+$fila[17]); 
				$sumCentoCanc=($fila[3]+$fila[7]+$fila[11]+$fila[15]+$fila[19]); 
				
				$data[$i]["Total"]	= array(
					"Agendado"       => $sumCentoAgen,
				    "colorAgendado"  => "#9E9E9E",
					"Cancelado"      => $sumCentoCanc,
				    "colorCancelado" => "#9E9E9E"
				);
				
				
				$totales[0] =  ($totales[0] + $fila[1]		);
				$totales[1] =  ($totales[1] + $fila[3]		);
				$totales[2] =  ($totales[2] + $fila[5]		);
				$totales[3] =  ($totales[3] + $fila[7]		);
				$totales[4] =  ($totales[4] + $fila[9]		);
				$totales[5] =  ($totales[5] + $fila[11]		);
				$totales[6] =  ($totales[6] + $fila[13]		);
				$totales[7] =  ($totales[7] + $fila[15]		);
				$totales[8] =  ($totales[8] + $fila[17]		);
				$totales[9] =  ($totales[9] + $fila[19]		);
				$totales[10] = ($totales[10] + $sumCentoAgen);
				$totales[11] = ($totales[11] + $sumCentoCanc);
				
		  $i++;
		}//end while
			$data[$i]["centro"] = "Total";
			$data[$i]["ciclo1"]	= array(
				"Agendado"       => $totales[0],
			    "colorAgendado"  => "#9E9E9E",
				"Cancelado"      => $totales[1],
			    "colorCancelado" => "#9E9E9E"
			);
			$data[$i]["ciclo2"]	= array(
				"Agendado"       => $totales[2],
			    "colorAgendado"  => "#9E9E9E",
				"Cancelado"      => $totales[3],
			    "colorCancelado" => "#9E9E9E"
			);
			$data[$i]["ciclo3"]	= array(
				"Agendado"       => $totales[4],
			    "colorAgendado"  => "#9E9E9E",
				"Cancelado"      => $totales[5],
			    "colorCancelado" => "#9E9E9E"
			);
			$data[$i]["ciclo4"]	= array(
				"Agendado"       => $totales[6],
			    "colorAgendado"  => "#9E9E9E",
				"Cancelado"      => $totales[7],
			    "colorCancelado" => "#9E9E9E"
			);
			$data[$i]["ciclo5"]	= array(
				"Agendado"       => $totales[8],
			    "colorAgendado"  => "#9E9E9E",
				"Cancelado"      => $totales[9],
			    "colorCancelado" => "#9E9E9E"
			);
			
			$data[$i]["Total"]	= array(
				"Agendado"       => $totales[10],
			    "colorAgendado"  => "#9E9E9E",
				"Cancelado"      => $totales[11],
			    "colorCancelado" => "#9E9E9E"
			);
		
		
		}//fin else
		return $data;
	}


/*******************************  Carga Procesos PENTAHO **********************************************/

 	public function celdaImagen($dato){
		if($dato == "CARGA CORRECTA"){
			$color = "<img style='width:10%;' src='../../../lib/images/correct.png' ";//velde
		}else
			if ($dato == "PENDIENTE") {
				$color = "<img style='width:12%;' src='../../../lib/images/loading-mark.png' "; // amarillo
			}else{
				$color ="<img style='width:12%;' src='../../../lib/images/incorrect.png' ";  // rojo
			}
		
		return $color;
	}

	// Carga los estados envios carga
	function CargaEnvioDato($bd){
			$carga = "CARGA CORRECTA";
			$i = 0;
			$data = Array();
			$sql= "call CargarProcesosPentaho();";
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
						"nombre"		=> utf8_encode($fila[0]),
						"horaCarga" 	=> utf8_encode($fila[1]),
						"totalProceso"  => utf8_encode($fila[2]),
						"estado"		=>$carga." ".$this->celdaImagen($carga) //$fila[3]
					); // End Array
					$i++;
				}// end while
			}// end else
			return $data;
	}

	
	
	

 }// fin clase principal

 ?>