<?php

 class usuariosOmi{

 	private $rut;
	private $usuario;
	private $estado;
	private $clave;
	private $perId;
	private $perfil;
	private $habilitarDesbl;
	
	// GETTERS AND SETTERS
	public function getRut(){
		return $this->rut;
	}

	public function setRut($rut){
		$this->rut=$rut;
	}

	public function getPerId(){
		return $this->perId;
	}

	public function setPerId($perId){
		$this->perId=$perId;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado=$estado;
	}
	
	public function getClave(){
		return $this->clave;
	}

	public function setClave($clave){
		$this->clave=$clave;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario=$usuario;
	}

	public function getPerfil(){
		return $this->perfil;
	}

	public function setPerfil($perfil){
		$this->perfil=$perfil;
	}

	public function getHabilitarDesbl(){
		return $this->habilitarDesbl;
	}

	public function setHabilitarDesbl($habilitarDesbl){
		$this->habilitarDesbl=$habilitarDesbl;
	}


 	public function celdaImagen($dato){
		if($dato == "1"){
			$color = "<img src='../../../lib/images/siAcudio.png'>"." Habilitado";//correcto
		}else{
			$color ="<img src='../../../lib/images/forbidden.gif'>"." Deshabilitado";  // incorrecto
		}					
		
		return $color;
	}


// SP que  llena los centros
public function bucarUsuarioOmiRut($bd){
		$i=0;
		$data = Array();
		$sql = "call db_pagina_rc.SP_buscarProfesional_Rut('{$this->getRut()}')";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			
			while ($fila = mysqli_fetch_row($resultado)) {	
				if ($fila[6] === NULL) {
					$estado = "0";
				}else{
					$estado = $fila[6];
				}

				if ($fila[7] === NULL) {
					$perfil = "No tiene Perfil asociado";
				}else{
					$perfil = $fila[7];
				}

				if ($fila[8] === NULL) {
					$idPerfilSelect = "0";
				}else{
					$idPerfilSelect = $fila[8];
				}

				if ($fila[9] === NULL) {
					$permisoSAPU = "0";
				}else{
					$permisoSAPU = $fila[9];
				}
				
				$data[$i] = Array(
				"data"			=>"1",
				"usuario" 				=> $fila[0],
				"nombreCompleto" 		=> $fila[1],
				"estamento" 			=> $fila[2],
				"rut"					=> $fila[3],
				"perId"					=> $fila[4],
				"centro" 				=> $fila[5],
				"tipoEst" 				=> $fila[6],
				"estado" 				=> $this->celdaImagen($estado),
				"Perfil"				=> $perfil,//$aa,
				"idPerfil"				=> $idPerfilSelect, //$bb,
				"idDesblSapu"				=> $this->celdaImagen($permisoSAPU),
				"idEstado"				=> $fila[6],
				"desblSapu"				=> $permisoSAPU
				);//end array
			
			$i++;
			}//end while
		}//fin else
		return $data;
	}

	// SP que  llena los centros
public function bucarUsuarioOmiNombre($bd){
		$i=0;
		$data = Array();
		$sql="call SP_buscarProfesional_User";
		$sql.="('{$this->getUsuario()}')";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			while ($fila = mysqli_fetch_row($resultado)) {	
				if ($fila[6] === NULL) {
					$estado = "0";
				}else{
					$estado = $fila[6];
				}

				if ($fila[7] === NULL) {
					$perfil = "No tiene Perfil asociado";
				}else{
					$perfil = $fila[7];
				}

				if ($fila[8] === NULL) {
					$idPerfilSelect = "0";
				}else{
					$idPerfilSelect = $fila[8];
				}

				if ($fila[9] === NULL) {
					$permisoSAPU = "0";
				}else{
					$permisoSAPU = $fila[9];
				}
				
				$data[$i] = Array(
					"data"			=>"1",
					"usuario" 				=> $fila[0],
					"nombreCompleto" 		=> $fila[1],
					"estamento" 			=> $fila[2],
					"rut"					=> $fila[3],
					"perId"					=> $fila[4],
					"centro" 				=> $fila[5],
					"tipoEst" 				=> $fila[6],
					"estado" 				=> $this->celdaImagen($estado),
					"Perfil"				=> $perfil,//$aa,
					"idPerfil"				=> $idPerfilSelect, //$bb,
					"idDesblSapu"				=> $this->celdaImagen($permisoSAPU),
					"idEstado"				=> $fila[6],
					"desblSapu"				=> $permisoSAPU
				);//end array
			
			$i++;
			}//end while
		}//fin else
		return $data;
	}

	function bucarUsuarioOmiRutSql($bd){
		$i=0;
		$data = Array();
		$sql="call SP_DESBLOQUEO_PROFESIONAL";
		$sql.="({$this->getPerId()},{$this->getEstado()})";
		$resultado = mysqli_query($bd,$sql);		
		if ($resultado == "0") {
			$mensaje = "incorrecto";
			return $mensaje;

		}else{
			$mensaje = "correcto";
			return $mensaje;

		}//fin else
	}


	function AsignacionPerfilEstado($bd){
		$data = Array();

		$perfil = $this->getPerfil();
		$estado = $this->getEstado();
		$habiDesblSapu = $this->getHabilitarDesbl();

		if ($perfil != "NULL" && $estado != "NULL" && $habiDesblSapu != "NULL") {
			//UPDATE z_usuarios_omi SET Cargos = 10 , Permiso_EXP = 1, DESBLOQUEO_SAPU = 1 where PER_ID = 113229
			$sql = "UPDATE z_usuarios_omi SET Cargos = $perfil , Permiso_EXP = $estado, DESBLOQUEO_SAPU = $habiDesblSapu where PER_ID = {$this->getPerId()}";
		}else
		if ($perfil != "NULL" && $estado != "NULL" && $habiDesblSapu == "NULL") {
			// UPDATE z_usuarios_omi SET Cargos = 10 , Permiso_EXP = 1 where PER_ID = 113229
			$sql = "UPDATE z_usuarios_omi SET Cargos = $perfil , Permiso_EXP = $estado where PER_ID = {$this->getPerId()}";
		}else 
		if ($perfil != "NULL" && $estado == "NULL" && $habiDesblSapu != "NULL") {
			// UPDATE z_usuarios_omi SET Cargos = 12 , DESBLOQUEO_SAPU = 1 where PER_ID = 113229
			$sql = "UPDATE z_usuarios_omi SET Cargos = $perfil , DESBLOQUEO_SAPU = $habiDesblSapu where PER_ID = {$this->getPerId()}";
		}else
		if ($perfil == "NULL" && $estado != "NULL" && $habiDesblSapu != "NULL") {
			// UPDATE z_usuarios_omi SET Permiso_EXP = 1, DESBLOQUEO_SAPU = 1 where PER_ID = 113229
			$sql = "UPDATE z_usuarios_omi SET Permiso_EXP = $estado, DESBLOQUEO_SAPU = $habiDesblSapu where PER_ID = {$this->getPerId()}";
		}else
		if ($habiDesblSapu != "NULL") {
			$sql = "UPDATE z_usuarios_omi SET  DESBLOQUEO_SAPU = $habiDesblSapu where PER_ID = {$this->getPerId()}";
		}else
		if ($estado != "NULL" ) {
			$sql = "UPDATE z_usuarios_omi SET Permiso_EXP = $estado where PER_ID = {$this->getPerId()}";
		}else{
			$sql = "UPDATE z_usuarios_omi SET Cargos = $perfil  where PER_ID = {$this->getPerId()}";
		}
		
		$resultado = mysqli_query($bd,$sql);		
		if ($resultado == "0") {
			$mensaje = "incorrecto";
			return $mensaje;

		}else{
			$mensaje = "correcto";
			return $mensaje;

		}//fin else

		//return $sql;
	}



/******************** INSERTA LOS LOG DE QUIEN REALIZO UNA MODIFICACION EN EL SISTEMA *************************/

		function InsertarLogUsuarios($bd){
		$i=0;
		$data = Array();
		$sql="call SP_INSERT_LOPD_USUARIOS_OMI";
		$sql.="('{$this->getUsuario()}',{$this->getEstado()},'{$this->getRut()}')";
		$resultado = mysqli_query($bd,$sql);
	}



	function modificarEstadoUsuario($bd){

		$sql = "BEGIN PKG_DESBLOQUEO_PROFESIONAL.SP_DESBLOQUEO_PROFESIONAL(:perId,:estado); END;";
		$stmt = oci_parse($bd, $sql) or die or die('Error: EN EL PAQUETE'); 
		$perId = $this->getPerId();
		$estado = $this->getEstado();

		oci_bind_by_name($stmt,":perId",$perId,300);
		oci_bind_by_name($stmt,":estado",$estado,300);
		$Respuesta =  oci_execute($stmt , OCI_DEFAULT);
		$mensaje = "";
		if ($Respuesta == 0) {
			$mensaje = "incorrecto";
			return $mensaje;
		}else{
			$mensaje = "correcto";
			return $mensaje;
		}
		
	}


	function traerClaveOmi($bd){
		$i=0;
		$data = Array();
		$sql = "call BuscarClavesOmi('{$this->getUsuario()}')";
		$resultado = mysqli_query($bd,$sql);
		$count = mysqli_num_rows($resultado);
		
		if ($count == "0") {
			$data[0] = array(
				"data" =>"0"
			);
		}else{
			
			while ($fila = mysqli_fetch_row($resultado)) {	
				
				$data[$i] = Array(
				"data"			=>"1",
				"clave" 	=> $fila[0]
				);//end array
			
			$i++;
			}//end while
		}//fin else
		return  json_encode($data);

	}



	function modificarClaveMysql($bd){
		$i=0;
		$data = Array();
		$sql="call SP_UPDATE_PASSWORD({$this->getPerId()},'{$this->getClave()}') ";
		$resultado = mysqli_query($bd,$sql);
		$resultado = mysqli_query($bd,$sql);		
		if ($resultado == "0") {
			$mensaje = 0;
			return $mensaje;

		}else{
			$mensaje = 1;
			return $mensaje;

		}//fin else

	}

	

} // fin clase menu


?>