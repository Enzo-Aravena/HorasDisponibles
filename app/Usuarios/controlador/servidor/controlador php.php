<?php
	require_once ("../../../../lib/conexion/conexion.php");
	require_once ("../../../../lib/conexion/conexionOracle.php");
	require_once("../../modelo/modeloUsuariosOmi.php");

	
	//oracle
	$bdato= new ConexionOracle();
	$conex = $bdato->ConectarOracle();
	/*************************/

	$bd = new Conexion();
	$conn = $bd->Conectar();
	$usuarios = new usuariosOmi();

	$evento = $_REQUEST['evento'];

	switch ($evento) {
	
	case 'buscarRut':

		$rut= $_REQUEST['rut'];
		$usuarios->setRut($rut);
		$data = $usuarios->bucarUsuarioOmiRut($conn);
			
			if($data[0]["data"] == "0"){
				echo "0";//No existe la wea
			}else{
				echo json_encode($data);
			}					
	break;


	case 'buscarUsuario':

		$usuario= $_REQUEST['usuario'];
		$usuarios->setUsuario($usuario);
		$data = $usuarios->bucarUsuarioOmiNombre($conn);
			
			if($data[0]["data"] == "0"){
				echo "0";//No existe la wea
			}else{
				echo json_encode($data);
			}					
	break;

	case 'cambiarEstado':

	$perId= $_REQUEST['perId'];
	$estado= $_REQUEST['estado'];
	
	$usuarios->setPerId($perId);
	$usuarios->setEstado($estado);

	$data = $usuarios->modificarEstadoUsuario($conex);
			
	echo $data;
	
	break;

	case 'cambiarEstado2':

		$perId= $_REQUEST['perId'];
		$estado= $_REQUEST['estado'];		
		$usuarios->setPerId($perId);
		$usuarios->setEstado($estado);

		$data = $usuarios->bucarUsuarioOmiRutSql($conn);
			
		echo $data;


	break;

	case 'modificarYvalidarClave':

		$username= $_REQUEST['username'];
		$perId= $_REQUEST['perId'];
		$pass= $_REQUEST['clave'];	

		$claves= base64_encode(sha1($pass, true));
		$usuarios->setUsuario($username);
		$datos = $usuarios->traerClaveOmi($conn);

		echo $datos;

		
	break;


	case 'cambiaClaveOmi':
			$perId= $_REQUEST['perId'];
			$pass= $_REQUEST['clave'];	
			$clavebd= $_REQUEST['clavebd'];	
			$claves= base64_encode(sha1($pass, true));
			$usuarios->setPerId($perId);
			$usuarios->setClave($claves);

			if ($claves != $clavebd) {
				$data = $usuarios->modificarClaveMysql($conn);
				echo json_encode($data);
				
			}else{				
				echo '[{"data":"1","clave":"0"}]';
			}		
	break;

	case 'modificarOracle':

	$perId= $_REQUEST['perId'];
	$pass= $_REQUEST['clave'];

	$claves= base64_encode(sha1($pass, true));



	$sql = "BEGIN PKG_UPDATE_PASSWORD.SP_UPDATE_PASSWORD(:perId,:clave); END;";
		$stmt = oci_parse($conex, $sql) or die or die('Error: EN EL PAQUETE'); 
		$perId = $perId;
		$clave = $claves;

		oci_bind_by_name($stmt,":perId",$perId,300);
		oci_bind_by_name($stmt,":clave",$clave,300);
		$Respuesta =  oci_execute($stmt , OCI_DEFAULT);
		$mensaje = "";
		if ($Respuesta == 0) {
			$mensaje = "incorrecto";
			echo $mensaje;
		}else{
			$mensaje = "correcto";
			echo  $mensaje;
		}
		
	break;


	default:
		print("Error al buscar Datos en la base de datos");
	break;
}




?>
