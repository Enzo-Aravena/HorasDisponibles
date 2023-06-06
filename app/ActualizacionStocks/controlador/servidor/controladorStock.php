<?php
	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modeloStockFarmacia.php");

	session_start();
	//CONEXION DB PAGINA RC
	$bdata = new Conexion();
	$conn = $bdata->Conectar();

	$modeloStock = new ModeloStock();

	$profesional =  $_SESSION['nombre'];
	$usuario =  $_SESSION['username'];
	$fecha_log = date("Y-m-d G:i:s");


	$evento = $_REQUEST['evento'];

	switch ($evento) {

	case 'select':		
		$data = $modeloStock->uploadSelectData($conn);
		echo json_encode($data);
	break;	

	case 'obtenerDatosTabla':
		$medicamento = $_REQUEST['medicamento'];
		$almacen = $_REQUEST['almacen'];
		$arreglo = array();
		$arregl = '';

		foreach ($medicamento as $key) {
			array_push($arreglo, "'".$key."'");
		}

		$codigoMaterial = implode(",", $arreglo);
		$modeloStock->setMedicamento($medicamento);
		$modeloStock->setAlmacen($almacen);
		$modeloStock->setMaximo($codigoMaterial);
		$data = $modeloStock->obtenerTablaAModificar($conn);
		echo json_encode($data);
	break;
	
	case 'actualizarStockFarmacia':		
		$cambios = $_REQUEST['cambios'];

		$modeloStock->setId($cambios);
		$data = $modeloStock->actualizarStcokEnFarmacia($conn);
		echo json_encode($data);


		//METODO QUE CARGA EL LOG DEL INGRESO DEL STOCK
		$modeloStock->setUsuario($usuario);
		$modeloStock->setProfesional($profesional);
		$modeloStock->setId($cambios);
		$modeloStock->setFechaSubida($fecha_log);
		$data = $modeloStock->IngresoLogActualizacionStock($conn);
		//echo json_encode($data);*/
	break;

	default:
		print("Error al buscar Datos en la base de datos");
	break;
}

?>