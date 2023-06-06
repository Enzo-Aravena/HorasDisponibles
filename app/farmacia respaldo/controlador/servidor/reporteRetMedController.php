<?php
	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modeloInaMed.php");

	$bd = new Conexion();
	$modelo = new claseInsumos();
	$conn = $bd->Conectar();

	$rut = $_REQUEST['rut'];
	$desde = $_REQUEST['desde'];
	$hasta = $_REQUEST['hasta'];
	$fechaHoy = $_REQUEST['fechaHoy'];

	if ($rut === "" && $desde === "" && $hasta === "" ) {
		$data = $modelo->mostrarPacientes($conn);
	}else
		if ($rut !== "" && $desde === "" && $hasta === "" ) {
			$modelo->setRut($rut);
			$data = $modelo->mostrarPacientesxRut($conn);
		}else{
			if ($desde !== "" && $hasta === "") {
				$modelo->setDesde($desde);
				$data = $modelo->mostrarPacientesxFecha($conn);
			}else{
				$modelo->setDesde($desde);
				$modelo->setHasta($hasta);
				$data = $modelo->mostrarPacientesxRangoFecha($conn);
			}
		}

	/*******************************  REPORTE EXCEL  ****************************************************/
	header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
	header('Content-Disposition: attachment; filename=inasistentes_Retiro_Medicamentos_'.$fechaHoy.'.xls');

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
				echo "<td>".$valor["CENTRO_DISPENSACION"]."</td>";
				echo "<td>".$valor["CODIGO_MEDICAMENTO"]."</td>";
				echo "<td>".$valor["NOMBRE_MEDICAMENTO"]."</td>";
				echo "<td>".$valor["RUT_PACIENTE"]."</td>";
				echo "<td>".$valor["NOMBRE_PACIENTE"]."</td>";
				echo "<td>".$valor["INICIO_TRATAMINETO"]."</td>";
				echo "<td>".$valor["FECHA_ENTREGA"]."</td>";
				echo "<td>".$valor["TIPO_RECETA"]."</td>";
				echo "<td>".$valor["CANTIDAD_NO_DISPENSADA"]."</td>";
				echo "<td>".$valor["STOCK_INICIAL"]."</td>";
				echo "<td>".$valor["STOCK_FINAL"]."</td>";
			echo "</tr>";
			$i++;
		}
		echo "</tbody>";
		echo "</table>";
?>