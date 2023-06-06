<?php

require_once ("../../../../lib/conexion/conexion.php");
require_once("../../modelo/updateUser.php");

$bd = new Conexion();
$buscaryModificar = new BuscaryModificar();

$conn = $bd->Conectar();
$evento = $_REQUEST["evento"];

switch ($evento) {
	//metodo que busca traer la data del usuario
	case 'searchData': 

				$ruts = $_REQUEST["rut"];			
				$buscaryModificar->setRut($ruts);
				$data = $buscaryModificar->buscarUsuario($conn);

				if ($data[0]["data"] == "0") {
						echo "0";
					}else{
						echo  json_encode($data);
					}	
	
	break;

	case 'modify': 
				$ruts = $_POST["rut"];
				$nombres= $_POST["nombre"];
				$apats= $_POST["apat"];
				$amats= $_POST["amat"];
				$fnacs= $_POST["fnac"];
				$sexos= $_REQUEST["sexo"];
				$centros= $_POST["centro"];	
				$estados= $_POST["estado"];
				$tipoPerfils= $_POST["tipoPerfil"];

				$buscaryModificar->setRut($ruts);
				$buscaryModificar->setNombre($nombres);
				$buscaryModificar->setApat($apats);			
				$buscaryModificar->setAmat($amats);
				$buscaryModificar->setFnac($fnacs);
				$buscaryModificar->setSexo($sexos);
				$buscaryModificar->setCentro($centros);
				$buscaryModificar->setEstado($estados);
				$buscaryModificar->setTipoPerfil($tipoPerfils);

				$data = $buscaryModificar->modificarDataUsuario($conn);

				if ($data[0]["data"] == "0") {
				echo "0";
				}else{
					echo  json_encode($data);
				}					
	break;

	case 'traerClave':
	$usuarios= $_POST["usuario"];
	$buscaryModificar->setUsuario($usuarios);
	$data = $buscaryModificar->traerClaveUsuarios($conn);
	if ($data[0]["data"] == "0") {
	echo "0";
	}else{
		echo  json_encode($data);
	}	
	break;


	case 'cambiarContrasena':

	$usuarios= $_POST["usuario"];				
	$claves= $_POST["clave"];	
	$buscaryModificar->setUsuario($usuarios);
		$buscaryModificar->setClave($claves);
	$data = $buscaryModificar->cambiarContrasena($conn);

	if ($data[0]["data"] == "0") {
	echo "0";
	}else{
		echo  json_encode($data);
	}			
	break;

	case 'perfiles':

	$data = $buscaryModificar->MostrarPerfiles($conn);

	if ($data[0]["data"] == "0") {
	echo "0";
	}else{
		echo  json_encode($data);
	}		
	
	break;

	case 'centro':
	$data = $buscaryModificar->CargarCentros($conn);

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