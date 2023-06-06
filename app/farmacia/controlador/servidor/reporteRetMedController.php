<?php
	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modeloInaMed.php");
	//ini_set('memory_limit', '1024M');
	

	$bd = new Conexion();
	$modelo = new claseInsumos();
	$conn = $bd->Conectar();

	$rut = $_REQUEST['rut'];
	$fecha1 = $_REQUEST['fecha1'];
	$fecha2 = $_REQUEST['fecha2'];
	$centro = $_REQUEST['centro'];
	
	if (empty($fecha1)) {
	    $fecha1 = "'".date("Y-m-d",  strtotime("Yesterday"))."'";
		$fecha2 = "'".date("Y-m-d", strtotime("Yesterday"))."'";
	}else{
		$fecha1= "'".$fecha1."'";
		if ($fecha2 == "" || $fecha2 == "undefined") {
			 $fecha2 = "'".date("Y-m-d", strtotime($fecha1))."'";
		} else {
			$fecha2= "'".$fecha2."'";
		}
	 }

	if ($rut == "") {
		$rut = "NULL"; 
	}else{
		$rut = "'".$rut."'";
		$fecha1 = "NULL";
		$fecha2 = "NULL";

	}
	if ($centro == "0") { $centro = "NULL"; }else{ $centro = $centro;}
	
	$modelo->setCentro($centro);
	$modelo->setRut($rut);
	$modelo->setDesde($fecha1);
	$modelo->setHasta($fecha2);
	$data = $modelo->mostrarPacientesPrueba($conn);
	//echo json_encode($data);

	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
	header('Content-Disposition: attachment; filename=inasistentes_Retiro_Medicamentos.xls');

		echo "<table  border='1' cellpadding='2' cellspacing='0'>";
			echo "<thead style='background-color: green;color:white;'>";
				echo "<th> </th>";
				echo "<th> Centro </th>";
				echo "<th> Codigo </th>";
				echo "<th> Medicamento </th>";
				echo "<th> Rut Paciente </th>";
				echo "<th> Nombre Paciente </th>";
				echo "<th> Inicio TTO </th>";
				echo "<th> Fecha entrega </th>";
				echo "<th> Tipo receta </th>";
				echo "<th> Cant no dispensada </th>";
				echo "<th> Stock inicial </th>";
				echo "<th> Stock final </th>";
			echo "</thead>";
		echo "<tbody>";
		$i = 2;
		$contador = 0;
		foreach($data as $clave => $valor){
			$contador = $contador +1;
			echo "<tr>";
				echo "<td>".$contador."</td>";
				echo "<td>".utf8_decode($valor["CENTRO_DISPENSACION"])."</td>";
				echo "<td>".utf8_decode($valor["CODIGO_MEDICAMENTO"])."</td>";
				echo "<td>".utf8_decode($valor["NOMBRE_MEDICAMENTO"])."</td>";
				echo "<td>".utf8_decode($valor["RUT_PACIENTE"])."</td>";
				echo "<td>".utf8_decode($valor["NOMBRE_PACIENTE"])."</td>";
				echo "<td>".utf8_decode($valor["INICIO_TRATAMINETO"])."</td>";
				echo "<td>".utf8_decode($valor["FECHA_ENTREGA"])."</td>";
				echo "<td>".utf8_decode($valor["TIPO_RECETA"])."</td>";
				echo "<td>".utf8_decode($valor["CANTIDAD_NO_DISPENSADA"])."</td>";
				echo "<td>".utf8_decode($valor["STOCK_INICIAL"])."</td>";
				echo "<td>".utf8_decode($valor["STOCK_FINAL"])."</td>";
			echo "</tr>";
			$i++;
		}
		echo "</tbody>";
		echo "</table>";

		//print utf8_decode($tabla);
?>