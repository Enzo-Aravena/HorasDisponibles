<?php

	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modeloBuscadorSapu.php");

	$bd = new Conexion();
	$modelo = new buscadorSapu();

	$conn = $bd->Conectar();
	$evento = $_REQUEST['evento'];


	switch ($evento) {
		case 'buscarPaciente':
			$rut  	= $_REQUEST['rut'];
			$fecha  = $_REQUEST['fecha'];

			if ($fecha == "") {
				$fecha = "NULL";
			}else{
				$fecha = "'".$fecha."'";
			}

			$rut = "'".$rut."'";
			$modelo->setRut($rut);
			$modelo->setFecha($fecha);
			$data = $modelo->OBTENER_ATENCION_SAPU($conn);
			if ($data[0]["data"] == "0") {
				echo "0";
			}else{
				echo  json_encode($data);
			}
		break;
	}
?>