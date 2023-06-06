<?php

	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modeloCuadroMando.php");

	$bd = new Conexion();
	$cuadroMando = new CuadroMandoGDA();

	$conn = $bd->Conectar();
	$evento = $_REQUEST["evento"];

	switch ($evento) {

		case "buscarTodo":
			
			$centro = $_REQUEST['centros'];
			$fechaHoy = $_REQUEST['fechaHoy'];

			$cuadroMando->setCentro($centro);
			$cuadroMando->setFechaHoy($fechaHoy);
			$data = $cuadroMando->CargarCuadroMando($conn);
			if ($data[0]["data"] == "0") {
				echo "0";
			}else{
				echo  json_encode($data);
			}				

		break;

		case 'mostrarDatos':

			$data = $cuadroMando->CargaEnvioDato($conn);
			if ($data[0]["data"] == "0") {
				echo "0";
			}else{
				echo  json_encode($data);
			}			
		break;
		
		default:
			print('Error al buscar Datos en la base de datos');
		break;
	}


?>