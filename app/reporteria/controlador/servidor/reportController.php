<?php
	ini_set('max_execution_time', 300);
	require_once ("../../../../lib/PHPExcel/PHPExcel.php");
	require_once ("../../../../lib/PHPExcel/PHPExcel/IOFactory.php");
	require_once ("../../../../lib/conexion/conexion.php");
	
	$bd = new Conexion();
	$conn 	= $bd->Conectar();

	//VARIABLES QUE SE RECIBEN DESDE FRONT
	$archivo=basename($_FILES['prueba']['name']);
	$uno 	= (isset($_REQUEST['uno']) ? "1" : "0");
	$dos 	= (isset($_REQUEST['dos']) ? "1" : "0");
	$tres 	= (isset($_REQUEST['tres']) ? "1" : "0");
	$cuatro = (isset($_REQUEST['cuatro']) ? "1" : "0");
	$cinco 	= (isset($_REQUEST['cinco']) ? "1" : "0");
	$seis   = (isset($_REQUEST['seis']) ? "1" : "0");

	// VARIABLES LOCALES QUE SE USARAN	
	$dir_subida = "tmp/"; // CARPETA DONDE SE MOVERA EL ARCHIVO PARA PROCESAR
	$rutCompleto = "";
	$sql= "";
	$i = 0;
	$arreglo = array();
	$parametros = array();
	$data = Array();
	$titulo = array();

	$rutaDestino  = $dir_subida.$archivo;
	//PRIMERO SE LEE ELL ARCHIVO EXCEL
	if(move_uploaded_file($_FILES['prueba']['tmp_name'], $rutaDestino)){
		//INICIALIZA EL ARCHIVO
		$objPHPExcel = PHPExcel_IOFactory::load($rutaDestino);
		//OBTIENE LA HOJA VIGENTE
		$sheet = $objPHPExcel->getSheet(0);
		//OBTIENE TODAS LAS COLUMAS Y FILAS 
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		//RECORRE DESDE LA FILA 2 PARA LLENAR EL ARRAY
		for ($row = 2; $row <= $highestRow; $row++){
			//BUSCA DATOS EN LA COLUMNA/ CELDA A
			$rut = $sheet->getCell("A".$row)->getValue();
			//VALIDA QUE SOLO SE CARGUEN EN EL ARRAY LOS RUT Y NO LOS VACIOS
			if ($rut !== "") {
				$rutCompleto = $rut;
			}else{
				$error = 0;
			}
			//PUCHEA LA INFORMACION DENTRO DEL ARRAY
			array_push($arreglo, $rutCompleto);
		}//end for


			if (empty($arreglo)) {
				echo "0";
			}else{
				$sql .= "SELECT RUT, ";
				// LLENA LOS PARAMETROS EN BASE AL CHECK SELECCIONADO
				if ($uno === "1") {
					array_push($parametros, "CENTRO", "SECTOR");
				}

				if ($dos === "1") {
					array_push($parametros, "NOMBRE_COMPLETO","SEXO","FECHA_NACIMIENTO","EDAD_ACTUAL","NACIONALIDAD");
				}

				if ($tres === "1") {
					array_push($parametros, "DIRECCION", "TELEFONOS");
				}

				if ($cuatro === "1") {
					 array_push($parametros, "ULTIMO_MOV_FICHA");
				}

				if ($cinco === "1") {
					array_push($parametros, "EPIDODIO_DIABETES", "EPISODIO_HIPERTENSOS","EPISODIO_DISLIPIDEMIA");
				}

				if ($seis === "1") {
					array_push($parametros, "FECHA_ULT_PRT_CARDIOVASCULAR");
				}
			 
				//CONVIERTE LOS ARRAY A CADENAS DE CARACTERES
				$cadenaRut = implode("','",$arreglo);
				$cadenaParametros = implode(",",$parametros);
				//SE FINALIZA LA QUERY AQUI
				$sql .= $cadenaParametros." FROM pacientes_omi_info WHERE RUT IN ('".$cadenaRut."')";
				$resultado = mysqli_query($conn,$sql);
				$count = mysqli_num_rows($resultado);
				if ($count == "0") {
						$data[0] = array(
							"data" =>"0"
						);
					}else{
						// IMPRIME LOS DATOS EN BASE A LA CADENA SOLICITADA
						while ($fila = mysqli_fetch_assoc($resultado)) {
							$data[$i]= Array();

								array_push($data[$i],
									utf8_encode($fila['RUT'])
								);

								if ($uno === "1") {
									array_push($data[$i], 
										utf8_encode($fila['CENTRO']),
										utf8_encode($fila['SECTOR'])
									);
								}

								if ($dos === "1") {
									array_push($data[$i], 
										utf8_encode($fila['NOMBRE_COMPLETO']),
										utf8_encode($fila['SEXO']),
										utf8_encode($fila['FECHA_NACIMIENTO']),
										utf8_encode($fila['EDAD_ACTUAL']),
										utf8_encode($fila['NACIONALIDAD'])
									);						
								}

								if ($tres === "1") {
									array_push($data[$i], 
										utf8_encode($fila['DIRECCION']),
										utf8_encode($fila['TELEFONOS'])
									);
								}

								if ($cuatro === "1") {
									array_push($data[$i], 
										utf8_encode($fila['ULTIMO_MOV_FICHA'])
									);
								}

								if ($cinco === "1") {
									array_push($data[$i], 
										utf8_encode($fila['EPIDODIO_DIABETES']),
										utf8_encode($fila['EPISODIO_HIPERTENSOS']),
										utf8_encode($fila['EPISODIO_DISLIPIDEMIA'])
									);
								}

								if ($seis === "1") {
									array_push($data[$i], 
										utf8_encode($fila['FECHA_ULT_PRT_CARDIOVASCULAR'])
									);
								}
							$i++;
						}// end while
				}// END ELSE DE LA QUERY

				//LUEGO DE OBTENER LOS DATOS, SE PROCEDE A CREAR EL ARCHIVO PARA SER EXPORTADO
				if ($uno === "1") {
					array_push($titulo,"CESFAM","SECTOR");
				}
				if ($dos === "1") {
					array_push($titulo,"NOMBRE COMPLETO","SEXO","FECHA NACIMIENTO","EDAD ACTUAL","NACIONALIDAD");
				}
				if ($tres === "1") {
					array_push($titulo,"DIRECCION","TELEFONOS");
				}
				if ($cuatro === "1") {
					array_push($titulo,"FECHA ULTIMO MOVIMIENTO EN FICHA");
				}
				if ($cinco === "1") {
					array_push($titulo,"EPISODIO DIABETES","EPISODIO HIPERTENSOS","EPISODIO DISLIPIDEMIA");
				}
				if ($seis === "1") {
					array_push($titulo,"FECHA ULTIMO PROTOCOLO CARDIOVASCULAR");
				}


				// SE PROCEDE A CREAR LA TABLA QUE SE MOSTRARA EN PANTALLA Y QUE ADEMAS SERA EXPORTADA
				echo "<table class='table table-bordered ' style='width:100%;' id='dataTable'>";
					echo "<tr>";
					//CARGA LOS TITULOS DE MANERA DINAMICA, SI EL CHECK ESTA ENCENDIDO
					echo "<th style='background: #6F85FF;color: white;'> RUT </th>";
					foreach ($titulo as $key) {
						echo "<th style='background: #6F85FF;color: white;'>".$key." </th>";
					}
					echo "</tr>";

					//CARGA LOS DATOS DEL PACIENTE
					foreach($data as $clave => $valor){
						echo "<tr>";
						//SACAMOS EL OBJETO Y SOLO MUESTRA LO NECESARIO POR COLUMNA
						foreach ($valor as $key) {
							echo "<td style='text-align: center;'>".$key."</td>";
						}
						echo "</tr>";
					}
				echo "</table>";
			}
	}else{
		echo "2"; // Error al cargar el archivo
		//ELIMINA EL ARCHIVO DE LA CARPETA tmp
		unlink($rutaDestino);
	}

	

?>