<?php

 class usuariosOmi{

 	private $rut;
	private $usuario;
	private $estado;
	private $clave;
	private $perId;

	// GETTERS AND SETTERS
	//rut
	public function getRut(){
		return $this->rut;
	}


	public function setRut($rut){
		$this->rut=$rut;
	}


	
	//PERID
	public function getPerId(){
		return $this->perId;
	}


	public function setPerId($perId){
		$this->perId=$perId;
	}

	//nombre
	public function getEstado(){
		return $this->estado;
	}

	
	public function setEstado($estado){
		$this->estado=$estado;
	}

	//apat
	public function getClave(){
		return $this->clave;
	}

	
	public function setClave($clave){
		$this->clave=$clave;
	}

	//usuario
	public function getUsuario(){
		return $this->usuario;
	}


	public function setUsuario($usuario){
		$this->usuario=$usuario;
	}


 	public function celdaImagen($dato){
		if($dato == "0"){
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
		$sql="call SP_buscarProfesional_Rut";
		$sql.="('{$this->getRut()}')";
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
				"usuario" 				=> $fila[0],
				"nombreCompleto" 		=> $fila[1],
				"estamento" 			=> $fila[2],
				"rut"					=> $fila[3],
				"perId"					=> $fila[4],
				"centro" 				=> $fila[5],
				"tipoEst" 				=> $fila[6],
				"estado" 				=> $this->celdaImagen($fila[6])
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
				
				$data[$i] = Array(
				"data"			=>"1",
				"usuario" 				=> $fila[0],
				"nombreCompleto" 		=> $fila[1],
				"estamento" 			=> $fila[2],
				"rut"					=> $fila[3],
				"centro" 				=> $fila[4],
				"estado" 				=> $this->celdaImagen($fila[5])
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