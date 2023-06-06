<?php

	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/createUser.php");

	$bd = new Conexion();
	$insertData = new InsertData(); 

	$conn = $bd->Conectar();
	$evento = $_REQUEST["evento"];

	switch ($evento) {

		case 'create':
				$ruts = $_REQUEST["rut"];
				$nombres= $_REQUEST["nombre"];
				$apats= $_REQUEST["apat"];
				$amats= $_REQUEST["amat"];
				$fnacs= $_REQUEST["fnac"];
				$sexos= $_REQUEST["sexo"];
				$centros= $_REQUEST["centro"];
				$usuarios= $_REQUEST["usuario"];
				$claves= $_REQUEST["clave"];
				$estados= $_REQUEST["estado"];
				$tipoPerfils= $_REQUEST["tipoPerfil"];

				$insertData->setRut($ruts);
				$insertData->setNombre($nombres);
				$insertData->setApat($apats);			
				$insertData->setAmat($amats);
				$insertData->setFnac($fnacs);
				$insertData->setSexoUsuario($sexos);
				$insertData->setCentro($centros);
				$insertData->setUsuario($usuarios);
				$insertData->setClave($claves);
				$insertData->setEstado($estados);
				$insertData->setTipoPerfil($tipoPerfils);
			

				$data = $insertData->insertarUsuario($conn);

			if ($data[0]["data"] == "0") {
				echo "0";
			}else{
				echo  json_encode($data);
			}	

		break;

		case 'perfiles':
			$data = $insertData->searchNamePerfiles($conn);
			if ($data[0]["data"] == "0") {
				echo "0";
			}else{
				echo  json_encode($data);
			}
			
		break;

		case 'centro':
			$data = $insertData->CargarCentros($conn);
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