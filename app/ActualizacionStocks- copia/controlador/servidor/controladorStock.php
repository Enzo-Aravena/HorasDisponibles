<?php
	require_once ("../../../../lib/conexion/conexionDbAux.php");
	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modeloStockFarmacia.php");

	session_start();

	$bd = new ConexionDbAux();
	$conn = $bd->Conectar();


	$bdata = new Conexion();
	$conex = $bdata->Conectar();


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
	
	case 'actualizarStockFarmacia':
		$codigo = $_REQUEST['codigo'];
		$medicamento = $_REQUEST['medicamento'];
		$almacen = $_REQUEST['almacen'];
		$maximo = $_REQUEST['maximo'];
		$critico = $_REQUEST['critico'];


		if ($codigo == "" || $codigo == "undefined" || empty($codigo)) {
		 	$codigo = "0";		 
		 }else{
		 	$codigo = $codigo;		 	
		}

		if ($medicamento == "" || $medicamento == "undefined" || empty($medicamento)) {
		 	$medicamento = "0";
		}else{
		 	$medicamento = $medicamento;
		}


		if ($codigo == '0'){
				$cod = $medicamento;
		}else{ 
			 	$cod = $codigo;
		}

		$modeloStock->setCodigo($cod);
		$modeloStock->setAlmacen($almacen);
		$modeloStock->setMaximo($maximo);
		$modeloStock->setCritico($critico);
		$data = $modeloStock->actualizarStcokEnFarmacia($conn);
		echo $data;



		$modeloStock->setUsuario($usuario);
		$modeloStock->setProfesional($profesional);
		$modeloStock->setMedicamento($cod);
		$modeloStock->setAlmacen($almacen);
		$modeloStock->setMaximo($maximo);
		$modeloStock->setCritico($critico);
		$modeloStock->setFechaSubida($fecha_log);
		$data = $modeloStock->IngresoLogActualizacionStock($conex);

	break;

	default:
		print("Error al buscar Datos en la base de datos");
	break;
}




?>
