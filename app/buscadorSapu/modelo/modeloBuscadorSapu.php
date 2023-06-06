<?php


 class buscadorSapu{

 	private $rut;
 	private $fecha;


 	public function getRut(){
 		return $this->rut;
 	}

 	public function setRut($rut){
 		return $this->rut = $rut;
 	}

 	public function getFecha(){
 		return $this->fecha;
 	}

 	public function setFecha($fecha){
 		return $this->fecha = $fecha;
 	}


 	function OBTENER_ATENCION_SAPU($bd){
			$i=0;
			$data = Array();
			$sql = "CALL OBTENER_ATENCION_SAPU({$this->getFecha()},{$this->getRut()})";
			$resultado = mysqli_query($bd,$sql);

			if ($resultado === false) {
				$data[0] = Array(
					"data" 	=> "0"
				);
			}else{
				$count=mysqli_num_rows($resultado);
				if($count == "0"){
					$data[$i] = Array(
						"data" 	=> "0"
					);
				}else{
					while ($fila = mysqli_fetch_assoc($resultado)){
						$data[$i] = Array(
							"data" 	   					=> "1",
							"CENTRO_ATENCION"			=> utf8_encode($fila['CENTRO_ATENCION']),
							"NOMBRE_PROFESIONAL"		=> utf8_encode($fila['NOMBRE_PROFESIONAL']),
							"PROFESION"					=> utf8_encode($fila['PROFESION']),
							"RUT_PROFESIONAL"			=> utf8_encode($fila['RUT_PROFESIONAL']),
							"CENTRO_PACIENTE"			=> utf8_encode($fila['CENTRO_PACIENTE']),
							"SECTOR_PACIENTE"			=> utf8_encode($fila['SECTOR_PACIENTE']),
							"RUT_PACIENTE"				=> utf8_encode($fila['RUT_PACIENTE']),
							"NOMBRE_PACIENTE"			=> utf8_encode($fila['NOMBRE_PACIENTE']),
							"SEXO"						=> utf8_encode($fila['SEXO']),
							"DOMICILIO"					=> utf8_encode($fila['DOMICILIO']),
							"FECHA_NACIMIENTO"			=> utf8_encode($fila['FECHA_NACIMIENTO']),
							"EDAD_VISITA_PACIENTE"		=> utf8_encode($fila['EDAD_VISITA_PACIENTE']),
							"RANGO_ETARIO_1"			=> utf8_encode($fila['RANGO_ETARIO_1']),
							"RANGO_ETARIO_2"			=> utf8_encode($fila['RANGO_ETARIO_2']),
							"EPISODIO"					=> utf8_encode($fila['EPISODIO']),
							"PROTOCOLO"					=> utf8_encode($fila['PROTOCOLO']),
							"FECHA_ATENCION"			=> utf8_encode($fila['FECHA_ATENCION']),
							"HORA_ATENCION"				=> utf8_encode($fila['HORA_ATENCION']),
							"NUM_ATENCION_SAPU"			=> utf8_encode($fila['NUM_ATENCION_SAPU']),
							"TIPO_INSCRIPCION"			=> utf8_encode($fila['TIPO_INSCRIPCION']),
							"MOTIVO_CONSULTA"			=> utf8_encode($fila['MOTIVO_CONSULTA']),
							"EMBARAZADA"				=> utf8_encode($fila['EMBARAZADA']),
							"CONSTATACION_DE_LESIONES"	=> utf8_encode($fila['CONSTATACION_DE_LESIONES']),
							"ALCOHOLEMIA"				=> utf8_encode($fila['ALCOHOLEMIA']),
							"REALIZA_REANIMACION"		=> utf8_encode($fila['REALIZA_REANIMACION']),
							"PACIENTE_FALLECIDO"		=> utf8_encode($fila['PACIENTE_FALLECIDO']),
							"NSP"						=> utf8_encode($fila['NSP']),
							"derivacion_urgencia"		=> utf8_encode($fila['derivacion_urgencia']),
							"derivacion_urgencia_otro"	=> utf8_encode($fila['derivacion_urgencia_otro']),
							"CAT_URGENCIA"				=> utf8_encode($fila['CAT_URGENCIA']),
							"DIAGNOSTICO"				=> utf8_encode($fila['DIAGNOSTICO']),
							"PAC_ID"					=> utf8_encode($fila['PAC_ID']),
							"TIPO_REGISTRO"				=> utf8_encode($fila['TIPO_REGISTRO'])
						);//end array
						$i++;
					}
				}// END ELSE INTERNO
			}// END ELSE EXTERNO
			return $data;
		}

}//END CLASS

?>