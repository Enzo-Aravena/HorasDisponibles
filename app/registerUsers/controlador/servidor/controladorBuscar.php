<?php

require_once ("../../../../lib/conexion/conexion.php");
require_once("../../modelo/personas.php");

$bd = new Conexion();
$personas = new Personas();

$conn = $bd->Conectar();
$evento = $_REQUEST["evento"];

switch ($evento) {

	case 'buscartodosUsuarios':
		$data = $personas->MostrarTodo($conn);
		if ($data[0]["data"] == "0") {
			echo "0";
		}else{
			echo  json_encode($data);
		}		
		
		
		break;

	case 'buscar':
		$buscar = $_REQUEST['buscar'];
		$seleccionar = $_REQUEST['rdbBuscar'];
		if (strlen($buscar) > 1) {
			if ($seleccionar == "name") {
					$personas->setNombre($buscar);
					$data = $personas->BuscarNombre($conn);			
					if ($data[0]["data"] == "0") {
						echo "0";
					}else{
						echo  json_encode($data);
					}		
			}// end name
			else
				if ($seleccionar == "rut") {
					$personas->setRut($buscar);
					$data= $personas->BuscarPorRut($conn);
						if ($data[0]['data'] =="0") {
							echo "0";
						}else{
							echo json_encode($data);
						}
				}// end rut
				else
					if ($seleccionar == "username") {
						$personas->setUsuario($buscar);
						$data= $personas->BuscarPorUsuario($conn);
							if ($data[0]['data'] =="0") {
								echo "0";
							}else{
								echo json_encode($data);
							}
					}// end username

		}else{			
			if ($seleccionar == "todo") {
								$personas->setUsuario($buscar);
								$data= $personas->MostrarTodo($conn);
								if ($data[0]['data'] =="0") {
										echo json_encode("0");
									}else{
										echo json_encode($data);
									}
			}//end Todo
			else{
				echo "error: No trae data al sistema";
			}
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