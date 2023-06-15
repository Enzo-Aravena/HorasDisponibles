<?php
session_start();
require_once("../../../../lib/WebServices/lib/nusoap.php");
	$cliente = new nusoap_client("http://infosalud.cormup.cl/saludCormup/lib/WebServices/ws_login.php?wsdl");
	//$cliente = new nusoap_client("http://localhost/saludCormupV2-Desarrollo/lib/WebServices/ws_login.php?wsdl");
	$datUuario = $_GET['username'];
	$parameter = array('nombre'=> $datUuario);
	$datos = $cliente->call('obtenerNombreUsuario',$parameter);
	$data =json_decode($datos);


foreach ($data as $fila) {
		$nombre = $fila->nombre;
		$perf = $fila->perfil;
		$sexo = $fila->sexo;
		$cent = $fila->centro;
		$test = $fila->clave;
	
	}	

	$_SESSION["nombre"]		= $nombre;
	$_SESSION["perfil"]		= $perf;
	$_SESSION["sexo"]	 	= $sexo;
	$_SESSION["centro"] 	= $cent;
	$_SESSION["clave"] 		= $test;
	$_SESSION['username'] 	= $datUuario;



	//echo  $_SESSION["nombre"]." ".$_SESSION["perfil"]." ".$_SESSION["sexo"]." ".$_SESSION["centro"]." ".$_SESSION["clave"]." ".$_SESSION['usuario'];
	header("Location: ../../../menuSistema/vista/menusistema.php");

?>
