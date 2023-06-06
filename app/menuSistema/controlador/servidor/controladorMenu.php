<?php
	require_once("../../../../lib/WebServices/lib/nusoap.php");
	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/menu.php");

	$bd = new Conexion();
	$modelo = new Menu();

	$conn = $bd->Conectar();
	$evento = $_REQUEST['evento'];

	switch($evento){
		case "menu":
		$usuario = $_REQUEST['usuario'];
		$modelo->setUsuario($usuario);
		$data = $modelo->menuUsuario($conn);
		if ($data[0]["data"] == "0") {
			echo "0";
		}else{
			echo  json_encode($data);
		}		
		break;
		
		default:
			print("Error");
		break;
	}


?>