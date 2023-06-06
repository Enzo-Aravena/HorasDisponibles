<?php
	session_start();
	error_reporting(0);
	require_once ("../../../../lib/conexion/ConexionCrs.php");
	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modeloDental.php");


	$bd = new ConexionCrs();
	$bdConexion = new Conexion();
	$modelo = new claseDental();

	$conn 	= $bd->ConectarCrs();
	$conex = $bdConexion->Conectar();

	$archivo = $_FILES['images']['tmp_name'];

	//$archivo = (isset($_FILES['prueba'])) ? $_FILES['prueba'] : null;
	$rut = $_REQUEST['rut'];
	$dni = $_REQUEST['dni'];
	$fecha = $_REQUEST['desde'];
	$nombre = $_REQUEST['nombre'];
	$usuario = $_SESSION['username'];
	$profesional =  $_SESSION['nombre'];
	$fechaFinalBD = date("Y-m-d G:i:s");
	// asi obtengo el npmbre del archivo = $archivo['name'][0]
	$cantidadImagen = count($archivo);

	if ($rut !== "") {
		$fechas =  explode('-',$fecha);
		$hr = explode(' ',$fechas[2]);
		$fechaFinal = $hr[0]."-".$fechas[1]."-".$fechas[0]." ".$hr[1];
		
		if (isset($archivo)) {
			for ($x=0;$x<count($archivo); $x++){
				$data = addslashes(file_get_contents($archivo[$x]));
				$crear = $conn->query("INSERT INTO dental_imagenes (rutPaciente,nombrePaciente,imagen,fechaSubida) VALUES ('$rut','$nombre','$data','$fechaFinal')");
			}

		if ($crear) {
			echo "correcto";
		}else{
			echo "Error";
		}

		$modelo->setUsuario($usuario);
		$modelo->setProfesional($profesional);
		$modelo->setRutPaciente($rut);
		$modelo->setDniPaciente('');
		$modelo->setNombrePaciente($nombre);
		$modelo->setCantidadImagenes($cantidadImagen);
		$modelo->setFechaSubida($fechaFinal);
		$data = $modelo->IngresoLogImagenDental($conex);
		//echo json_encode($data);

		}else{
			echo "error";
		}
	}else{
		//echo "SUBE LA IMAGEN CON EL DNI";
		$fechas =  explode('-',$fecha);
		$hr = explode(' ',$fechas[2]);
		$fechaFinal = $hr[0]."-".$fechas[1]."-".$fechas[0]." ".$hr[1];
		
		if (isset($archivo)) {
			for ($x=0;$x<count($archivo); $x++){
				$data = addslashes(file_get_contents($archivo[$x]));
				$crear = $conn->query("INSERT INTO dental_imagenes (dniPaciente,nombrePaciente,imagen,fechaSubida) VALUES ('$dni','$nombre','$data','$fechaFinal')");
			}

			if ($crear) {
				echo "correcto";
			}else{
				echo "Error";
			}

			$modelo->setUsuario($usuario);
			$modelo->setProfesional($profesional);
			$modelo->setRutPaciente('');
			$modelo->setDniPaciente($dni);
			$modelo->setNombrePaciente($nombre);
			$modelo->setCantidadImagenes($cantidadImagen);
			$modelo->setFechaSubida($fechaFinal);
			$data = $modelo->IngresoLogImagenDental($conex);
			//echo json_encode($data);
		}else{
			echo "error";
		}
	}





?>