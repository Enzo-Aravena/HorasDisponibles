<?php
require_once("../../../../lib/WebServices/lib/nusoap.php");
$evento = $_REQUEST["evento"];

switch($evento){
	case "menu":

	//$cliente = new nusoap_client("http://saludcormup/saludCormupv2/lib/WebServices/ws_menu.php?wsdl");
	$cliente = new nusoap_client("http://infosalud.cormup.cl/saludCormup/lib/WebServices/ws_menu.php?wsdl");

	$user= $_REQUEST['usuario'];
	$parameter = array('usuario'=> $user);
	$data = $cliente->call('obtenerMenuPrincipal',$parameter);

		if ($data == "[]") {
			echo "0";
		}
		else{
			echo $data;
		}
	break;
	
	default:
		print("Error");
	break;
}


?>