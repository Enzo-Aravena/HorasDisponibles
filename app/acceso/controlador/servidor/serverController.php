<?php
require_once("../../../../lib/conexion/conexion.php");
require_once("../../../../lib/WebServices/lib/nusoap.php");
require_once("../../modelo/usuario.php");


$bd = new Conexion();
$modelo = new Usuario();
$conn = $bd->Conectar();

$evento = $_REQUEST["evento"];
switch($evento){
	case "login":
		$cliente = new nusoap_client("http://infosalud.cormup.cl/saludCormup/lib/WebServices/ws_login.php?wsdl");
		//$cliente = new nusoap_client("http://localhost/saludCormupV2-Desarrollo/lib/WebServices/ws_login.php?wsdl");
		$user = $_REQUEST["usuario"];
		$pass = $_REQUEST["contrasena"];
		$clave = base64_encode(sha1($pass, true));
		$parameter = array('nombre'=> $user);
		$datos = $cliente->call('obtenerDetalleUser',$parameter);
		$data =json_decode($datos);
		

		foreach ($data as $fila) {
			$test = $fila->clave;
			$est = $fila->estado;
			$perf = $fila->perfil;
			$perid = $fila->perId;
			$cargo = $fila->cargo;
		}

		if ($datos == "[]") {
			echo "0";//No existe usuario
		}else
			if ($clave != "") {
				$cleve = $test;
				if ($cleve == $clave) {

					//ESTADO 0 NO BLOQUEADO - 1 BLOQUEADO
					if ($est == 0) {
						if ($cargo == "1" || $cargo == "2" || $cargo == "3" || $cargo == "4" || $cargo == "5" || $cargo == "6" || $cargo == "7" || $cargo == "8" || $cargo == "9" || $cargo == "10" || $cargo == "11" || $cargo == "12" || $cargo == "99" ) {
							echo "1"; 

							//log usuario
							$parameter = array('nombre'=> $user);
							$service = $cliente->call('obtenerNombreUsuario',$parameter);
							$result =json_decode($service);

							foreach ($result as $filas) {
								$nombre = $filas->nombre;
								$perf = $filas->perfil;
								$sexo = $filas->sexo;
								$cent = $filas->centro;
								$test = $filas->clave;
								$permisoUser = $filas->permisos;
							}

							$modelo->setUsuario($user);
							$modelo->setNombreProfesional($nombre);
							$modelo->setCargo($cargo);
							$data = $modelo->IngresoLogUsuario($conn);						


						}else{
							echo "4";
						}
					}else{
						echo "3";
					}
				}else{
					echo "2";
				}
			}else{
				echo "5";
			}
	break;
	
	case "logout":
		header("Location: ../../../index.php");
	break;
	
	default:
		print("Error");
	break;
}

?>