<?php

require_once ("../../../../lib/conexion/conexion.php");
require_once("../../modelo/DeleteUsers.php");

$bd = new Conexion();
$eliminar = new DeleteUsers();

$conn = $bd->Conectar();
$evento = $_REQUEST["evento"];

switch ($evento) {
	case '': 

	
	break;


	default:
		print("Error");
	break;
}


?>