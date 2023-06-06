<?php
	require_once ("../../../../lib/conexion/conexion.php");
	require_once ("../../../../lib/conexion/conexionOracle.php");
	require_once("../../modelo/modeloUsuarios.php");

	$bd = new Conexion();
	$conn = $bd->Conectar();
	$usuarios = new usuariosOmi();

	$evento = $_REQUEST['evento'];

	switch ($evento) {
	
	case 'buscarRut':

		$rut= $_REQUEST['rut'];
		$usuarios->setRut($rut);
		$data = $usuarios->bucarUsuarioOmiRut($conn);
		if ($data[0]["data"] == "0") {
			echo "0";
		}else{
			echo  json_encode($data);
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

	case 'modificar':
		$cargo = $_REQUEST['cargo'];
		$estado = $_REQUEST['estado'];
		$habiDesblSapu = $_REQUEST['habiDesblSapu'];
		$perId = $_REQUEST['perId'];

		if ($cargo == "0") {	 $cargo = "NULL"; } else { $cargo = $cargo; }
		if ($estado == "99") {	 $estado = "NULL"; } else { $estado = $estado; }
		if ($habiDesblSapu == "99") {	$habiDesblSapu = "NULL";	} else {	$habiDesblSapu = $habiDesblSapu;}

		$usuarios->setPerfil($cargo);
		$usuarios->setEstado($estado);
		$usuarios->setHabilitarDesbl($habiDesblSapu);
		$usuarios->setPerId($perId);
		$data = $usuarios->AsignacionPerfilEstado($conn);

		echo json_encode($data);
	break;

	default:
		print("Error al buscar Datos en la base de datos");
	break;
}




?>
