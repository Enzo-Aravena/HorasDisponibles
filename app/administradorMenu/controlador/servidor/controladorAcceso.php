<?php
	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/createMenu.php");

	$bd = new Conexion();
	$insert = new createMenu();

	$conn = $bd->Conectar();
	$evento = $_REQUEST['evento'];


	switch ($evento) {
		case 'buscarTodoMenu':
			$data = $insert->BUSCAR_MENU($conn);
			echo json_encode($data);
			//var_dump($data);
			
		break;

		case 'buscarNombre':
			$buscar = $_REQUEST['buscar'];
			$seleccionar = $_REQUEST['rdbBuscar'];

			if (strlen($buscar) > 1) {
				if ($seleccionar == "name") {
					
					$insert->setNombre($buscar);
					$data = $insert->searchByNombreMenu($conn);
						if ($data == "0") {
						echo "No se han encontrado Resultados asociados a la busqueda";
						}else{
							echo  json_encode($data);	
						}

				}else{
					$data = $insert->BUSCAR_MENU($conn);
						if ($data[0]["data"] == "0") {
							echo "0";
						}else{
							echo json_encode($data);
						}		

				}

			}else{
				echo "Error";
			}

		break;	

		case 'create':

		 /* modificar el PROCESO  PARA QUE VALIDE SI EXISTE EL DATO*/
			$nombre = $_REQUEST['nombre'];
			$imagen = $_REQUEST['imagen'];
			$detalleRuta = $_REQUEST['detalleRuta'];

			$rutaImagen = "../../../lib/images/".$imagen;
			$insert->setNombre($nombre);
			$insert->setNomImagen($rutaImagen);
			$insert->setDetalleRuta($detalleRuta);
			$data = $insert->CreateToMenu($conn);

			if ($data[0]["data"] == "0") {
				echo "0";
			}else{
				echo  json_encode($data);
			}	

		break;

		case 'buscarYmod':                                                                                                                           

			$idMenu = $_REQUEST["idMenu"];			
			$insert->setIdMenu($idMenu);
			$data = $insert->TraerData($conn);

			if ($data[0]["data"] == "0") {
				echo "0";
			}else{
				echo  json_encode($data);
			}	
			
		break;

		case 'modificar':

			$nombre = $_REQUEST['nombre'];
			$imagen = $_REQUEST['imagen'];
			$detalleRuta = $_REQUEST['detalleRuta'];
			$idMenu = $_REQUEST['idMenu'];

			$rutaImagen = "../../../lib/images/".$imagen;
			$insert->setNombre($nombre);
			$insert->setNomImagen($rutaImagen);
			$insert->setDetalleRuta($detalleRuta);
			$insert->setIdMenu($idMenu);
			


			$data = $insert->modificarMenu($conn);		

			if ($data[0]["data"] == "0") {
				echo "0";
			}else{
				echo  json_encode($data);
			}	
	
		break;

		case 'cargarData':

		$data = $insert->searchNameMenu($conn);
		if ($data[0]["data"] == "0") {
			echo "0";
		}else{
			echo  json_encode($data);
		}
	
		break;

		case 'perfiles':
			$data = $insert->searchNamePerfiles($conn);
			if ($data[0]["data"] == "0") {
				echo "0";
			}else{
				echo  json_encode($data);
			}
			
		break;
		case 'asignarPerfiles':

		$perfil = $_REQUEST['perfil'];
		$menu = $_REQUEST['menu'];
		
		
		$insert->setIdMenu($menu);
		$insert->setPerfil($perfil);
		$data = $insert->insertNavMenu($conn);

		if ($data[0]["data"] == "0") {
			echo "0";
		}else{
			echo  json_encode($data);
		}	
			
		break;

		case 'eliminarMenu':
		$idMenu = $_REQUEST['idmenu'];
		
				
		$insert->setIdMenu($idMenu);
		$data = $insert->eliminarMenu($conn);

		break;

		case 'eliminarLazo':
		$menu = $_REQUEST['menu'];	
		
		$insert->setIdMenu($menu);
		$data = $insert->eliminarNavMenu($conn);

		if ($data[0]["data"] == "0") {
			echo "0";
		}else{
			echo  json_encode($data);
		}	
		
		break;
		
		default:
			print("Error al buscar Datos en la base de datos");
		break;
	}


?>