<?php

require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/agenda.php");

	$bd = new Conexion();
	$agenda = new ocupacionAgenda();

	$conn = $bd->Conectar();
	$evento = $_REQUEST['evento'];


	switch ($evento) {

	case 'cargarSelect':
	$data = $agenda->CargarSelectdata($conn);
	if ($data[0]["data"] == "0") {
		echo "0";
	}else{
		echo  json_encode($data);
	}	
	break;


	case 'menu':
	$data = $agenda->cargarMenuAgenda($conn);
	if ($data[0]["data"] == "0") {
		echo "0";
	}else{
		echo  json_encode($data);
	}	
	break;

	case 'cargargrafico':

	$data = $agenda->cargaDataGrafico($conn);
	if ($data[0]["data"] == "0") {
		echo "0";
	}else{
		echo  json_encode($data);
	}	
	break;


	default:
		echo "No se puede cargar los datos en total";
	break;

	}


?>