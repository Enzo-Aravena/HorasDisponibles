<?php 
	error_reporting(0);
	session_start();
	require_once ("../../../../lib/conexion/conexion.php");
	require('../../../../lib/class.phpmailer.php');
	require('../../../../lib/class.smtp.php');
	require_once ("../../../../lib/PHPExcel/PHPExcel/IOFactory.php");
	require_once("../../modelo/subida.php");
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time', 300);
	$bd = new Conexion();
	$subidaArchivo = new SubidaArchivo(); 
	$conn 	= $bd->Conectar();


	// fecha
	date_default_timezone_set("America/Santiago");
	$fecha_log = date("d-m-Y G:i:s");
	$fecha = date("d-m-Y_G-i-s");
	// end fecha

	$centro 	= $_POST['centro'];
	$serie 		= $_POST['serie'];
	$mes 		= $_POST['mes'];
	$anio 		= $_POST['anio'];
	$usuario 	= $_POST['usuario'];
	$envio      = $_POST['envio'];
	$mensaje 	= $_POST['mensaje'];
	$profesional =  $_SESSION['nombre'];
	$fechaFinalBD = date("Y-m-d G:i:s");
		
	$nombre_nuevo = "REM_";
	$nombre_nuevo .= $serie;
	$nombre_nuevo .= "_";
	$nombre_nuevo.= $mes;
	$nombre_nuevo .= "_";
	$nombre_nuevo .= $anio;
	$nombre_nuevo .= "_";
	$nombre_nuevo .= $centro;
	$nombre_nuevo .= "_";
	$nombre_nuevo .= $envio;
	$nombre_nuevo .= "_ENVIADO_";
	$nombre_nuevo .= $fecha;
	$nombre_nuevo .= ".xlsm";
	$dir_subida = 'tmp/';

	$rutaFinal = $dir_subida.$nombre_nuevo;

	$archivo = (isset($_FILES['prueba'])) ? $_FILES['prueba'] : null;

	$resultado= 0;
	$nombreArcOriginal = $archivo['name'];

	if (!empty($archivo)) {
		if(move_uploaded_file($_FILES['prueba']['tmp_name'], $rutaFinal)){

				$objPHPExcel = PHPExcel_IOFactory::load($rutaFinal);
				//obtenemos las Sheets
				$Sheet=$objPHPExcel->getSheetNames();

				if($serie=='A'){
					if($Sheet[0] == 'NOMBRE'){				
					}else{
						$resultado = 4;
					}

					if($Sheet[1] == 'A01'){
					}else{
						$resultado = 4;
					}

					if($Sheet[2] == 'A02'){
					}else{
						$resultado = 4;
					}
					if($Sheet[3] == 'A03'){
					}else{
						$resultado = 4;
					}
					if($Sheet[4] == 'A04'){
					}else{
						$resultado = 4;
					}
					
					if (isset($Sheet[5])) {
						if($Sheet[5] == 'A05'){
						}else{
							$resultado = 4;	
						}
					}else{
						$resultado = 5;
					}

					if (isset($Sheet[6])) {
						if($Sheet[6] == 'A06'){
						}else{
							$resultado = 4;	
						}
					}else{
						$resultado = 5;
					}

					if(isset($Sheet[6])){
						if($Sheet[6] == 'A06'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if(isset($Sheet[7])){
						if($Sheet[7] == 'A07'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if(isset($Sheet[8])){
						if($Sheet[8] == 'A08'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if(isset($Sheet[9])){
						if($Sheet[9] == 'A09'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if(isset($Sheet[10])){
						if($Sheet[10] == 'A11'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if(isset($Sheet[11])){
						if($Sheet[11] == 'A19a'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}

					
					if (isset($Sheet[12])) {
					
						if($Sheet[12] == 'A19b'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if (isset($Sheet[13])) {
					
						if($Sheet[13] == 'A21'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if (isset($Sheet[14])) {
					
						if($Sheet[14] == 'A23'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if (isset($Sheet[15])) {
					
						if($Sheet[15] == 'A24'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if (isset($Sheet[16])) {
					
						if($Sheet[16] == 'A25'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if (isset($Sheet[17])) {
					
						if($Sheet[17] == 'A26'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if (isset($Sheet[18])) {
					
						if($Sheet[18] == 'A27'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if (isset($Sheet[19])) {
					
						if($Sheet[19] == 'A28'){	
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if (isset($Sheet[20])) {
					
						if($Sheet[20] == 'A29'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if (isset($Sheet[21])) {
					
						if($Sheet[21] == 'A30'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if (isset($Sheet[22])) {
					
						if($Sheet[22] == 'A31'){
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
					if (isset($Sheet[23])) {
					
						if($Sheet[23] == 'Contro'){	
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}

					if (isset($Sheet[24])) {
					
						if($Sheet[24] == 'MACROS'){	
						}else{
							$resultado = 4;
						}
					}else{
						$resultado = 5;
					}
				}

				if($serie=='B'){
									
					if($Sheet[0] == 'NOMBRE'){
					}else{
						$resultado = 4;
					}
					if($Sheet[1] == 'BM18'){
					}else{
						$resultado = 4;
					}
					if($Sheet[2] == 'BM18A'){
					}else{
						$resultado = 4;
					}
					if($Sheet[3] == 'Control'){	
					}else{
						$resultado = 4;
					}
					if($Sheet[4] == 'MACROS'){	
					}else{
						$resultado = 4;
					}
																																																																																																																																	
				}	

				if($serie=='D'){
									
					if($Sheet[0] == 'NOMBRE'){
					}else{
						$resultado = 4;
					}
					if($Sheet[1] == 'D15'){
					}else{
						$resultado = 4;
					}
					if($Sheet[2] == 'D16'){
					}else{
						$resultado = 4;
					}
					if($Sheet[3] == 'Control'){	
					}else{
						$resultado = 4;
					}
					if($Sheet[4] == 'MACROS'){	
					}else{
						$resultado = 4;
					}
				}
					
				if ($resultado == 0 ) {
					$mail = new PHPMailer();

					$body = "Detalles del Envio:\n\n<br><br>";
					$body .= "Enviado por: " . $profesional . "\n<br><br>";
					$body .= "Nombre Archivo Original: " .$archivo['name']."\n<br><br>";
					$body .= "Nombre Archivo Servidor: " .$nombre_nuevo. "\n<br><br>";
					$body .= "Comentarios: " . $mensaje . "\n\n<br><br>";
					$body .= "Fecha Envio " . $fecha_log . "\n\n<br>";
					$body .= "Equipo Informatico Salud<br>";
					$body .= "Corporación Municipal de Desarrollo Social de Peñalolen";


					$mail->IsSMTP(); 

					// la dirección del servidor, p. ej.: smtp.servidor.com
					$mail->Host = "aspmx.l.google.com";

					// dirección remitente, p. ej.: no-responder@miempresa.com
					//$mail->From = "tic.salud@cormup.cl";
					$mail->From = "mhenriquez.henriquez@cormup.cl";

					// nombre remitente, p. ej.: "Servicio de envío automático"
					$mail->FromName = "Equipo Informatico Salud";

					// asunto y cuerpo alternativo del mensaje
					$mail->Subject = "REM SERIE ".$serie." ".$mes." ".$anio." ".$centro." ".$envio;
					//$mail->AltBody = ""; 

					// si el cuerpo del mensaje es HTML
					$mail->MsgHTML($body);


					// podemos hacer varios AddAdress
					$mail->AddAddress("mhenriquez.henriquez@cormup.cl","prueba");//"tic.salud@cormup.cl", "Tic.Salud");
					$mail->SMTPOptions = array(
						'ssl' => array(
							'verify_peer' => false,
							'verify_peer_name' => false,
							'allow_self_signed' => true
						)
					);	
					$mail->Send();

					$subidaArchivo->setFecha($fechaFinalBD);
					$subidaArchivo->setNombreProf($profesional);
					$subidaArchivo->setUsuario($usuario);
					$subidaArchivo->setNombreArchivOriginal($nombreArcOriginal);
					$subidaArchivo->setNombreArchivoServer($nombre_nuevo);
					$subidaArchivo->setCentro($centro);
					$subidaArchivo->setSerie($serie);
					$subidaArchivo->setMes($mes);
					$subidaArchivo->setAnio($anio);
					$subidaArchivo->setEnvio($envio);
					$subidaArchivo->setMensaje($mensaje);
					$subidaArchivo->setTipo("Subido Correctamente");
					$data = $subidaArchivo->RegistraSubidaRem($conn);
					//echo $data;

					$resultado=1;
				}else{
					if ($resultado == 5) {
						$mail = new PHPMailer();
						$body = "Detalles del Envio:\n\n<br><br>";
						$body .= "Enviado por: " . $profesional . "\n<br><br>";
						$body .= "Nombre Archivo Original: " .$archivo['name']."\n<br><br>";
						$body .= "Nombre Archivo Servidor: " .$nombre_nuevo. "\n<br><br>";
						$body .= "Comentarios: " . $mensaje . "\n\n<br><br>";
						$body .= "Fecha Envio " . $fecha_log . "\n\n<br>";
						$body .= "Equipo Informatico Salud<br>";
						$body .= "Corporación Municipal de Desarrollo Social de Peñalolen";


						$mail->IsSMTP(); 

						// la dirección del servidor, p. ej.: smtp.servidor.com
						$mail->Host = "aspmx.l.google.com";

						// dirección remitente, p. ej.: no-responder@miempresa.com
						//$mail->From = "tic.salud@cormup.cl";
						$mail->From = "mhenriquez.henriquez@cormup.cl";

						// nombre remitente, p. ej.: "Servicio de envío automático"
						$mail->FromName = "Equipo Informatico Salud";

						// asunto y cuerpo alternativo del mensaje
						$mail->Subject = "REM SERIE ".$serie." ".$mes." ".$anio." ".$centro." ".$envio."_VALIDAR TIC";
						//$mail->AltBody = ""; 

						// si el cuerpo del mensaje es HTML
						$mail->MsgHTML($body);


						// podemos hacer varios AddAdress
						$mail->AddAddress("mhenriquez.henriquez@cormup.cl","prueba");//"tic.salud@cormup.cl", "Tic.Salud");
						$mail->SMTPOptions = array(
							'ssl' => array(
								'verify_peer' => false,
								'verify_peer_name' => false,
								'allow_self_signed' => true
							)
						);	
						$mail->Send();

						$subidaArchivo->setFecha($fechaFinalBD);
						$subidaArchivo->setNombreProf($profesional);
						$subidaArchivo->setUsuario($usuario);
						$subidaArchivo->setNombreArchivOriginal($nombreArcOriginal);
						$subidaArchivo->setNombreArchivoServer($nombre_nuevo);
						$subidaArchivo->setCentro($centro);
						$subidaArchivo->setSerie($serie);
						$subidaArchivo->setMes($mes);
						$subidaArchivo->setAnio($anio);
						$subidaArchivo->setEnvio($envio);
						$subidaArchivo->setMensaje($mensaje);
						$subidaArchivo->setTipo("Subido con Errores, problema de la serie del rem ingresado");
						$data = $subidaArchivo->RegistraSubidaRem($conn);

						$resultado=5;

					}else{
						unlink($rutaFinal);
					}		
				}
		}else{
			$resultadoado = 2;
		}	
	}else{
		$resultadoado = 3;
	}


	echo $resultado;

?>