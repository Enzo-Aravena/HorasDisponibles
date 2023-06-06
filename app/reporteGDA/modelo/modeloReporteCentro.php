<?php

 class reporteGda{
 	private $hoy;
	private $hasta;

 	public function getHoy(){
 		return $this->hoy;
 	}

 	public function setHoy($hoy){
 		return $this->hoy = $hoy;
 	}

	 public function getHasta(){
		return $this->hasta;
	}

	public function setHasta($hasta){
		return $this->hasta = $hasta;
	}

	public function obtenerCargaDiariaGda($bd){
		$i=0;
		$data = Array();
		$arreglo =Array();
		$Oferta = Array();
		$totalAfecCitado = Array();
		$totalAfecCanc = Array();
		$totalCicloAgen = Array();
		$totalCicloCanc = Array();

		$ciclAge1 = Array();
		$ciclCan1 = Array();
		$ciclAge2 = Array();
		$ciclCan2 = Array();
		$ciclAge3 = Array();
		$ciclCan3 = Array();
		$ciclAge4 = Array();
		$ciclCan4 = Array();
		$ciclAge5 = Array();
		$ciclCan5 = Array();
		
		$sql="call db_pagina_rc.SP_Resumen_Carga_Ciclos_2('{$this->getHoy()}','{$this->getHasta()}')";
		//$sql="call db_pagina_rc.SP_Resumen_Carga_Ciclos('{$this->getHoy()}','{$this->getHasta()}')";
		$resultado = mysqli_query($bd,$sql);
	
		while ($fila = mysqli_fetch_assoc($resultado)) {

			$arreglo[$i] = Array(
				"C" => "CAROL URZUA",
				"F" => "LA FAENA",
				"SL" => "SAN LUIS",
				"LH" => "LO HERMIDA",
				"CSH" => "CARDENAL SILVA H.",
				"PGW" => "PADRE GERARDO W",
				"LT" => "LAS TORRES",
				"TOTAL" => "TOTAL"
			);

			$Oferta[$i] = array(
				"OF_CU" => $fila["OF_CU"],
				"OF_LF" => $fila["OF_LF"],
				"OF_SL" => $fila["OF_SL"],
				"OF_LH" => $fila["OF_LH"],
				"OF_CSH" => $fila["OF_CSH"],
				"OF_PGW" => $fila["OF_PGW"],
				"OF_LT" => $fila["OF_LT"],
				"OF_TOTAL" => $fila["OF_TOTAL"]
			);

			$totalAfecCitado[$i] = array(
				"A_REAL_1" =>$fila["A_REAL_1"],
				"A_REAL_2" =>$fila["A_REAL_2"],
				"A_REAL_3" =>$fila["A_REAL_3"],
				"A_REAL_4" =>$fila["A_REAL_4"],
				"A_REAL_5" =>$fila["A_REAL_5"],
				"A_REAL_12" =>$fila["A_REAL_12"],
				"A_REAL_13" =>$fila["A_REAL_13"],
				"A_REAL_TOTAL" =>$fila["A_REAL_TOTAL"]
			);

			$totalAfecCanc[$i] = array(
				"C_REAL_1" =>$fila["C_REAL_1"],
				"C_REAL_2" =>$fila["C_REAL_2"],
				"C_REAL_3" =>$fila["C_REAL_3"],
				"C_REAL_4" =>$fila["C_REAL_4"],
				"C_REAL_5" =>$fila["C_REAL_5"],
				"C_REAL_12" =>$fila["C_REAL_12"],
				"C_REAL_13" =>$fila["C_REAL_13"],
				"C_REAL_TOTAL" =>$fila["C_REAL_TOTAL"]
			);

			$ciclAge1[$i] = array(
				"A_CICLO_1_1" =>$fila["A_CICLO_1_1"],
				"A_CICLO_1_2" =>$fila["A_CICLO_1_2"],
				"A_CICLO_1_3" =>$fila["A_CICLO_1_3"],
				"A_CICLO_1_4" =>$fila["A_CICLO_1_4"],
				"A_CICLO_1_5" =>$fila["A_CICLO_1_5"],
				"A_CICLO_1_12" =>$fila["A_CICLO_1_12"],
				"A_CICLO_1_13" =>$fila["A_CICLO_1_13"],
				"A_CICLO_1" =>$fila["A_CICLO_1"]
			);

			$ciclCan1[$i] = array(
				"C_CICLO_1_1" =>$fila["C_CICLO_1_1"],
				"C_CICLO_1_2" =>$fila["C_CICLO_1_2"],
				"C_CICLO_1_3" =>$fila["C_CICLO_1_3"],
				"C_CICLO_1_4" =>$fila["C_CICLO_1_4"],
				"C_CICLO_1_5" =>$fila["C_CICLO_1_5"],
				"C_CICLO_1_12" =>$fila["C_CICLO_1_12"],
				"C_CICLO_1_13" =>$fila["C_CICLO_1_13"],
				"C_CICLO_1" =>$fila["C_CICLO_1"]
			);

			$ciclAge2[$i] = array(
				"A_CICLO_2_1" =>$fila["A_CICLO_2_1"],
				"A_CICLO_2_2" =>$fila["A_CICLO_2_2"],
				"A_CICLO_2_3" =>$fila["A_CICLO_2_3"],
				"A_CICLO_2_4" =>$fila["A_CICLO_2_4"],
				"A_CICLO_2_5" =>$fila["A_CICLO_2_5"],
				"A_CICLO_2_12" =>$fila["A_CICLO_2_12"],
				"A_CICLO_2_13" =>$fila["A_CICLO_2_13"],
				"A_CICLO_2" =>$fila["A_CICLO_2"]
			);

			$ciclCan2[$i] = array(
				"C_CICLO_2_1" =>$fila["C_CICLO_2_1"],
				"C_CICLO_2_2" =>$fila["C_CICLO_2_2"],
				"C_CICLO_2_3" =>$fila["C_CICLO_2_3"],
				"C_CICLO_2_4" =>$fila["C_CICLO_2_4"],
				"C_CICLO_2_5" =>$fila["C_CICLO_2_5"],
				"C_CICLO_2_12" =>$fila["C_CICLO_2_12"],
				"C_CICLO_2_13" =>$fila["C_CICLO_2_13"],
				"C_CICLO_2" =>$fila["C_CICLO_2"]
			);

			$ciclAge3[$i] = array(
				"A_CICLO_3_1" =>$fila["A_CICLO_3_1"],
				"A_CICLO_3_2" =>$fila["A_CICLO_3_2"],
				"A_CICLO_3_3" =>$fila["A_CICLO_3_3"],
				"A_CICLO_3_4" =>$fila["A_CICLO_3_4"],
				"A_CICLO_3_5" =>$fila["A_CICLO_3_5"],
				"A_CICLO_3_12" =>$fila["A_CICLO_3_12"],
				"A_CICLO_3_13" =>$fila["A_CICLO_3_13"],
				"A_CICLO_3" =>$fila["A_CICLO_3"]
			);

			$ciclCan3[$i] = array(
				"C_CICLO_3_1" =>$fila["C_CICLO_3_1"],
				"C_CICLO_3_2" =>$fila["C_CICLO_3_2"],
				"C_CICLO_3_3" =>$fila["C_CICLO_3_3"],
				"C_CICLO_3_4" =>$fila["C_CICLO_3_4"],
				"C_CICLO_3_5" =>$fila["C_CICLO_3_5"],
				"C_CICLO_3_12" =>$fila["C_CICLO_3_12"],
				"C_CICLO_3_13" =>$fila["C_CICLO_3_13"],
				"C_CICLO_3" =>$fila["C_CICLO_3"]
			);

			$ciclAge4[$i] = array(
				"A_CICLO_4_1" =>$fila["A_CICLO_4_1"],
				"A_CICLO_4_2" =>$fila["A_CICLO_4_2"],
				"A_CICLO_4_3" =>$fila["A_CICLO_4_3"],
				"A_CICLO_4_4" =>$fila["A_CICLO_4_4"],
				"A_CICLO_4_5" =>$fila["A_CICLO_4_5"],
				"A_CICLO_4_12" =>$fila["A_CICLO_4_12"],
				"A_CICLO_4_13" =>$fila["A_CICLO_4_13"],
				"A_CICLO_4" =>$fila["A_CICLO_4"]
			);

			$ciclCan4[$i] = array(
				"C_CICLO_4_1" =>$fila["C_CICLO_4_1"],
				"C_CICLO_4_2" =>$fila["C_CICLO_4_2"],
				"C_CICLO_4_3" =>$fila["C_CICLO_4_3"],
				"C_CICLO_4_4" =>$fila["C_CICLO_4_4"],
				"C_CICLO_4_5" =>$fila["C_CICLO_4_5"],
				"C_CICLO_4_12" =>$fila["C_CICLO_4_12"],
				"C_CICLO_4_13" =>$fila["C_CICLO_4_13"],
				"C_CICLO_4" =>$fila["C_CICLO_4"]
			);

			$ciclAge5[$i] = array(
				"A_CICLO_5_1" =>$fila["A_CICLO_5_1"],
				"A_CICLO_5_2" =>$fila["A_CICLO_5_2"],
				"A_CICLO_5_3" =>$fila["A_CICLO_5_3"],
				"A_CICLO_5_4" =>$fila["A_CICLO_5_4"],
				"A_CICLO_5_5" =>$fila["A_CICLO_5_5"],
				"A_CICLO_5_12" =>$fila["A_CICLO_5_12"],
				"A_CICLO_5_13" =>$fila["A_CICLO_5_13"],
				"A_CICLO_5" =>$fila["A_CICLO_5"]
			);

			$ciclCan5[$i] = array(
				"C_CICLO_5_1" =>$fila["C_CICLO_5_1"],
				"C_CICLO_5_2" =>$fila["C_CICLO_5_2"],
				"C_CICLO_5_3" =>$fila["C_CICLO_5_3"],
				"C_CICLO_5_4" =>$fila["C_CICLO_5_4"],
				"C_CICLO_5_5" =>$fila["C_CICLO_5_5"],
				"C_CICLO_5_12" =>$fila["C_CICLO_5_12"],
				"C_CICLO_5_13" =>$fila["C_CICLO_5_13"],
				"C_CICLO_5" =>$fila["C_CICLO_5"]
			);


			$totalCicloAgen[$i] = array(
				"A_TOTAL_CICLO_1" =>$fila["A_TOTAL_CICLO_1"],
				"A_TOTAL_CICLO_2" =>$fila["A_TOTAL_CICLO_2"],
				"A_TOTAL_CICLO_3" =>$fila["A_TOTAL_CICLO_3"],
				"A_TOTAL_CICLO_4" =>$fila["A_TOTAL_CICLO_4"],
				"A_TOTAL_CICLO_5" =>$fila["A_TOTAL_CICLO_5"],
				"A_TOTAL_CICLO_12" =>$fila["A_TOTAL_CICLO_12"],
				"A_TOTAL_CICLO_13" =>$fila["A_TOTAL_CICLO_13"],
				"A_TOTAL_CICLO" =>$fila["A_TOTAL_CICLO"]
			);

			$totalCicloCanc[$i] = array(
				"C_TOTAL_CICLO_1" =>$fila["C_TOTAL_CICLO_1"],
				"C_TOTAL_CICLO_2" =>$fila["C_TOTAL_CICLO_2"],
				"C_TOTAL_CICLO_3" =>$fila["C_TOTAL_CICLO_3"],
				"C_TOTAL_CICLO_4" =>$fila["C_TOTAL_CICLO_4"],
				"C_TOTAL_CICLO_5" =>$fila["C_TOTAL_CICLO_5"],
				"C_TOTAL_CICLO_12" =>$fila["C_TOTAL_CICLO_12"],
				"C_TOTAL_CICLO_13" =>$fila["C_TOTAL_CICLO_13"],
				"C_TOTAL_CICLO" =>$fila["C_TOTAL_CICLO"]
			);

			array_push($data,$arreglo,$Oferta,$totalAfecCitado,$totalAfecCanc,$ciclAge1,$ciclCan1,$ciclAge2,$ciclCan2,$ciclAge3,$ciclCan3,$ciclAge4,$ciclCan4,$ciclAge5,$ciclCan5,$totalCicloAgen,$totalCicloCanc) ;
		}
		return $data;
	}


	function exportarArchivoCiclos($bd){
		$i=0;
		$data = Array();
		//$sql="call db_pagina_rc.SP_Export_Carga_Ciclos('{$this->getHoy()}')";
		//$sql="call db_pagina_rc.SP_Export_Carga_Ciclos('2022-01-12')";
		$sql="call db_pagina_rc.SP_Export_Carga_Ciclos_2('{$this->getHoy()}','{$this->getHasta()}')";
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
					"CENTRO" => utf8_encode($fila[0]),
					"TIPO_CARGA" => utf8_encode($fila[1]),
					"CICLO" => utf8_encode($fila[2]),
					"ESTADO" => utf8_encode($fila[3]),
					"FECHAYHORACONTACTO" => utf8_encode($fila[4]),
					"FECHAYHORACANCELACION" => utf8_encode($fila[5]),
					"ESTABLECIMIENTOPACIENTE" => utf8_encode($fila[6]),
					"SECTORPACIENTE" => utf8_encode($fila[7]),
					"IDCITAGDA" => utf8_encode($fila[8]),
					"FECHACITA" => utf8_encode($fila[9]),
					"HORACITA" => utf8_encode($fila[10]),
					"NUMEROFICHA" => utf8_encode($fila[11]),
					"RUTPACIENTE" => utf8_encode($fila[12]),
					"NOMBREPACIENTE" => utf8_encode($fila[13]),
					"APELLIDOPATERNO" => utf8_encode($fila[14]),
					"APELLIDOMATERNO" => utf8_encode($fila[15]),
					"EDAD" => utf8_encode($fila[16]),
					"FONOCONTACTO" => utf8_encode($fila[17]),
					"FONOCONTACTO2" => utf8_encode($fila[18]),
					"ACCIONCITA" => utf8_encode($fila[19]),
					"PREVISION" => utf8_encode($fila[20]),
					"CONVENIO" => utf8_encode($fila[21]),
					"IDLLAMADA" => utf8_encode($fila[22]),
					"CANCELADOPOR" => utf8_encode($fila[23]),
					"FECHAYHORAAGENDADO" => utf8_encode($fila[24]),
					"FONOCONTACTOCANCELACION" => utf8_encode($fila[25]),
					"FONOCONTACTO2CANCELACION" => utf8_encode($fila[26]),
					"SMS_CANCELACION" => utf8_encode($fila[27]),
					"REAGENDADO" => utf8_encode($fila[28]),
					"HORACUPO" => utf8_encode($fila[29]),
					"SECTORCUPO_DESCRIPCIONLOCAL" => utf8_encode($fila[30]),
					"PROFESIONALNOMBRES" => utf8_encode($fila[31]),
					"AGENDADOPOR" => utf8_encode($fila[32]),
					"AGENDADODESDE" => utf8_encode($fila[33]),
					"IDCUPOSISTEMA" => utf8_encode($fila[34]),
					"IDPACIENTESISTEMACLIENTE" => utf8_encode($fila[35]),
					"DETALLECUPO" => utf8_encode($fila[36]),
					"ID" => utf8_encode($fila[37]),
					"FECHA_CARGA_TABLA" => utf8_encode($fila[38]),
					"FECHA_CARGA_OM" => utf8_encode($fila[39])				
				);		
				$i++;
			}//end while
		}//fin else
		return $data;
	}
 	
} // fin clase menu
?>