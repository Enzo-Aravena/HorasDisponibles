<?php

	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modificarEstado.php");

	$bd = new Conexion();
	$estado = new ModificarEstado(); 

	$conn = $bd->Conectar();
	$evento = $_REQUEST["evento"];

	switch ($evento) {

		case 'trearEstado':

			$rut = $_REQUEST["rutUser"];			
			$estado->setRutUser($rut);							
			$data = $estado->llamarEstado($conn);
			if ($data[0]["data"] == "0") {
				echo "0";
			}else{
				echo  json_encode($data);
			}				
		break;

		case 'cambiarEstado':
		
			$rut = $_REQUEST["rutUser"];			
			$tipoestado = $_REQUEST["estado"];
			$estado->setRutUser($rut);				
			$estado->setEstado($tipoestado);
			$data = $estado->modificarEstadoUsuario($conn);
			if ($data[0]["data"] == "0") {
				echo "0";
			}else{
				echo  json_encode($data);
			}	
		break;

		default:
			print("Error al intentar ingresar datos a la Base de datos");
		break;

	}
	








?>