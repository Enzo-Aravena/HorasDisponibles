<?php
	require_once ("../../../../lib/PHPExcel/PHPExcel.php");
	require_once ("../../../../lib/PHPExcel/PHPExcel/IOFactory.php");
	require_once ("../../../../lib/conexion/conexion.php");
	//require_once("../../modelo/modeloDrogueria.php");

	session_start();
	//$modelo = new claseCargaDrogueria(); 
	$bd = new Conexion();
	$conn 	= $bd->Conectar();
	$dir_subida = "tmp/";
	$dir_subida2 ="tmp/";
	$cambio = "";

	ini_set('max_execution_time', 300);
	$archivo=basename($_FILES['prueba']['name']);
	$ext=extension1($archivo); 
	$rutaDestino  = $dir_subida.$archivo;
	$rutaDestino2  = $dir_subida2.$archivo;
	$Errores["filas"] = array(); 
	$contadorErrores = 0;
	$uno 	= (isset($_REQUEST['uno']) ? "1" : "0");
	$dos 	= (isset($_REQUEST['dos']) ? "1" : "0");
	$tres 	= (isset($_REQUEST['tres']) ? "1" : "0");
	$cuatro = (isset($_REQUEST['cuatro']) ? "1" : "0");
	$cinco 	= (isset($_REQUEST['cinco']) ? "1" : "0");
	$seis   = (isset($_REQUEST['seis']) ? "1" : "0");
	$siete 	= (isset($_REQUEST['siete']) ? "1" : "0");
	//	echo $uno." ".$dos." ".$tres." ".$cuatro." ".$cinco." ".$seis." ".$siete;





/*	if(move_uploaded_file($_FILES['prueba']['tmp_name'], $rutaDestino)){
		//INICIALIZA EL ARCHIVO
		$objPHPExcel = PHPExcel_IOFactory::load($rutaDestino);
		//OBTIENE LA PESTAÑA VIGENTE
		$sheet = $objPHPExcel->getSheet(0);
		//OBTIENE TODAS LAS COLUMAS Y FILAS 
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		$cadena = "";
		$i = 0;
		$fila = 0;
		for ($row = 2; $row <= $highestRow; $row++){+

			$impteMl = $sheet->getCell("A".$row)->getValue();
			$auxError["col1"] = "'".$impteMl."'";
			array_push($Errores["filas"], $auxError);
			//print_r(json_encode($Errores));

		}//end for
	}else{
		echo "2"; // Error al cargar el archivo
		unlink($rutaDestino);
	}*/




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