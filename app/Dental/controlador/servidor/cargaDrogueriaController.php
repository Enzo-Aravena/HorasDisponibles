<?php
	require_once ("../../../../lib/PHPExcel/PHPExcel.php");
	require_once ("../../../../lib/PHPExcel/PHPExcel/IOFactory.php");
	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modeloDrogueria.php");
	$dir_subida = "C:\\pentaho\\data-integration\\app\\Stock\\CargaMedicamentos\\04.Pendiente/";
	$dir_subida2 ="C:\\pentaho\\data-integration\\app\\Stock\\CargaMedicamentos\\02.Carga/";
	session_start();
	$modelo = new claseCargaDrogueria(); 
	$bd = new Conexion();
	$conn 	= $bd->Conectar();
	// $dir_subida = "tmp/";
	// $dir_subida2 ="tmp/";
	$cambio = "";

	ini_set('max_execution_time', 300);
	$archivo=basename($_FILES['prueba']['name']);
	$ext=extension1($archivo); 
	$rutaDestino  = $dir_subida.$archivo;
	$rutaDestino2  = $dir_subida2.$archivo;
	$Errores["filas"] = array(); 
	$contadorErrores = 0;

	$profesional =  $_SESSION['nombre'];
	$usuario =  $_SESSION['username'];
	$fecha_log = date("Y-m-d G:i:s");

	if($ext=="xls"|| $ext=="XLS"|| $ext=="xlsx"|| $ext=="XLSX"){
		
		if (!file_exists($rutaDestino) && !file_exists($rutaDestino2)) {
			if(move_uploaded_file($_FILES['prueba']['tmp_name'], $rutaDestino)){

				//INICIALIZA EL ARCHIVO
				$objPHPExcel = PHPExcel_IOFactory::load($rutaDestino);
				//OBTIENE LA PESTAÑA VIGENTE
				$sheet = $objPHPExcel->getSheet(0);
				//OBTIENE TODAS LAS COLUMAS Y FILAS 
				$highestRow = $sheet->getHighestRow();
				$highestColumn = $sheet->getHighestColumn();
				$validaTexto = "";
				$cadena = "";
				$i = 0;
				$fila = 0;

				//VALIDACION COLUMNAS CABECERA
				$columA = trim($sheet->getCell("A1")->getValue());
				$columB = trim($sheet->getCell("B1")->getValue());
				$columC = trim($sheet->getCell("C1")->getValue());
				$columD = trim($sheet->getCell("D1")->getValue());
				$columE = trim($sheet->getCell("E1")->getValue());
				$columF = trim($sheet->getCell("F1")->getValue());
				$columG = trim($sheet->getCell("G1")->getValue());
				$columH = trim($sheet->getCell("H1")->getValue());
				$columI = trim($sheet->getCell("I1")->getValue());
				$columJ = trim($sheet->getCell("J1")->getValue());
				$columK = trim($sheet->getCell("K1")->getValue());
				$columL = trim($sheet->getCell("L1")->getValue());
				$columM = trim($sheet->getCell("M1")->getValue());
				$columN = trim($sheet->getCell("N1")->getValue());
				$columO = trim($sheet->getCell("O1")->getValue());

				//echo "A=".$columA.", B=".$columB.", C=".$columC.", D=".$columD.", E=".$columE.", F=".$columF.", G=".$columG.", H=".$columH.", I=".$columI.", J=".$columJ.", K=".$columK.", L=".$columL.", M=".$columM.", N=".$columN.", O=".$columO;

				if ($columA == "Material" && $columB == "Texto breve de material" && $columC == "Fe.contab." && $columD == "Cantidad" && $columE == "UME" &&
				$columF == "Impte.ML" && $columG == "Txt.cabec." && $columH == "Ce.coste" && $columI == "Lote" && $columJ == "Referencia" && $columK == "Hora" &&
				$columL == "Reserva" && $columM == "Usuario" && $columN == "CMv" && $columO == "Cliente") {
					 
					//RECORRE CADA UNO DE LOS CAMPOS QUE SON OBLIGATORIOS E IMPORTANTES	
					for ($row = 2; $row <= $highestRow; $row++){
						$txtMaterial= "";
						$material =$sheet->getCell("A".$row)->getValue();
							if($material == ""){
								$txtMaterial = $sheet->getCell("A".$row)->getValue();
								if(empty($txtMaterial) || $txtMaterial === "" || is_null($txtMaterial)){
									$txtMaterial = "-";
								}else{
									$txtMaterial = $sheet->getCell("A".$row)->getValue();
									$i++;
									$contadorErrores++;
								}
							}else{
								$txtMaterial = "-";
							}

							//VALIDACION CAMPO FECHA
							$fechas = $sheet->getCell("C".$row)->getValue();
							$valores = explode('.', $fechas);
							if(count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])){
								$fecha = "-";
							}else{
								$fecha =  $sheet->getCell("C".$row)->getValue();
								$i++;
								$contadorErrores++;	
							}

							//VALIDACION CAMPO CANTIDAD
							$valor = $sheet->getCell("D".$row)->getValue();
							if (is_float($valor) === true) {
								$cantid = "-";
							}else{
								$cantid = $sheet->getCell("D".$row)->getValue();
								$i++;
								$contadorErrores++;	
							}

							//VALIDACION CAMPO IMPORTE
							$impte  = $sheet->getCell("F".$row)->getValue();
							if (is_float($impte) === true) {
								$impteMl= '-';
							}else{
								$impteMl = $sheet->getCell("F".$row)->getValue();
								$i++;
								$contadorErrores++;	
							}

							//VALIDACION CAMPO TEXTO CABECERA
							// $txt = intval($sheet->getCell("G".$row)->getValue());
							$txt = trim(intval($sheet->getCell("G".$row)->getValue())); //CORRECCIÓN CAMPO VACÍO CON SÓLO ESPACIOS
							if(!intval($txt )  ){
								// $txtCabec = $sheet->getCell("G".$row)->getValue();
								$txtCabec = trim($sheet->getCell("G".$row)->getValue()); //CORRECCIÓN CAMPO VACÍO CON SÓLO ESPACIOS
								if(empty($txtCabec) || is_null($txtCabec)){
									$txtCabec = "-";
								}else{
									// $txtCabec = $sheet->getCell("G".$row)->getValue();;
									$txtCabec = trim($sheet->getCell("G".$row)->getValue()); //CORRECCIÓN CAMPO VACÍO CON SÓLO ESPACIOS
									$i++;
									$contadorErrores++;
								}
							}else{
								$txtCabec = "-";
							}

							//CENTRO COSTO QUE NO VENGA VACIA
							$txtCeCoste= "";
							$ceCoste = $sheet->getCell("H".$row)->getValue();
							if (empty($sheet->getCell("H".$row)->getValue())) {
								$txtCeCoste = $sheet->getCell("H".$row)->getValue();
								$i++;
								$contadorErrores++;
							}else{
								$txtCeCoste = "-";
							}

							//MANERA DE VALIDAR LA DATA 
							if(!intval($material ) == true || $fecha !== true || !floatval($valor) || !floatval($impte ) || !intval($txt ) || empty($txtCeCoste) ){
								$auxError["col1"] = $row;
								$auxError["col2"] = $txtMaterial;
								$auxError["col3"] = $fecha;
								$auxError["col4"] = $cantid;
								$auxError["col5"] = $impteMl;
								$auxError["col6"] = $txtCabec;
								$auxError["col7"] = $txtCeCoste;
								array_push($Errores["filas"], $auxError);
							}
					}// END FOR

					if ($contadorErrores == 0) {
						echo "1";				
						$modelo->setUsuario($usuario);
						$modelo->setProfesional($profesional);
						$modelo->setarchivo($archivo);
						$modelo->setFechaSubida($fecha_log);
						$data = $modelo->IngresoLogCargaDrogueria($conn);
					}else{
						unlink($rutaDestino);
						print_r(json_encode($Errores));
					}
				} else {
					echo "5"; // LAS COLUMNAS NO ESTABAN EN LA POSICION CORRECTA
					unlink($rutaDestino);
				}
			}//END IF
			else{
				echo "2"; // Error al cargar el archivo
				unlink($rutaDestino);
			}
		}//END IF
		else{		
			echo "4"; // EL archivo ya fue cargado
		}
	}//END IF
	else{	
		echo "3"; // Extension no valida!, Solo archivo xls 0 xlsx
		unlink($rutaDestino);
	}

	//obtiene la extension del archivo
	function extension1($filename)
	{
		$ext1= substr(strrchr($filename, '.'), 1);
		return $ext1;
	}   

	//FUNCION QUE VALIDA SI EL DATO ES FECHA
	function validaFecha($fecha){
		$valores = explode('.', $fecha);
		if(count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])){
			//echo "es fecha";
			return true;
		}else{
		 	//echo "no es fecha";
			return false;
		}
	}

?>