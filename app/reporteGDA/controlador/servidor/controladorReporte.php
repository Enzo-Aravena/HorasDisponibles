<?php
	require_once ("../../../../lib/conexion/conexion.php");
	require_once("../../modelo/modeloReporteCentro.php");

	$bd = new Conexion();
	$reporte = new reporteGda();
	$conn = $bd->Conectar();
	$evento = $_REQUEST['evento'];
	switch ($evento) {
		case 'obtenerTabla':
			$fecha1 = $_REQUEST["fecha1"];
			$fecha2 = $_REQUEST["fecha2"];

			$fes1 = explode("/", $_REQUEST["fecha1"]);
			$fecha1= $fes1[2]."-".$fes1[1]."-".$fes1[0];

			if ($fecha2 != "") {
				$fes2 = explode("/", $_REQUEST["fecha2"]);
				$fecha2= $fes2[2]."-".$fes2[1]."-".$fes2[0];
			} else {
				$fecha2= $fecha1;
			}
			$reporte->setHoy($fecha1);
			$reporte->setHasta($fecha2);
			$data = $reporte->obtenerCargaDiariaGda($conn);
			echo json_encode($data);
		break;
		case 'exportarArchivo':
			$fecha1 = $_REQUEST["fecha1"];
			$fecha2 = $_REQUEST["fecha2"];
			$valFecha2= $fecha2;

			$fes1 = explode("/", $_REQUEST["fecha1"]);
			$fecha1= $fes1[2]."-".$fes1[1]."-".$fes1[0];

			if ($fecha2 != "") {
				$fes2 = explode("/", $fecha2);
				$fecha2= $fes2[2]."-".$fes2[1]."-".$fes2[0];
			} else {
				$fecha2= $fecha1;

			}
			$reporte->setHoy($fecha1);
			$reporte->setHasta($fecha2);
			$data = $reporte->exportarArchivoCiclos($conn);
			$columnas = array("CENTRO", "TIPO_CARGA", "CICLO", "ESTADO", "FECHAYHORACONTACTO", "FECHAYHORACANCELACION", "ESTABLECIMIENTOPACIENTE", "SECTORPACIENTE",
			 "IDCITAGDA", "FECHACITA","HORACITA", "NUMEROFICHA", "RUTPACIENTE", "NOMBREPACIENTE", "APELLIDOPATERNO", "APELLIDOMATERNO", "EDAD", "FONOCONTACTO", 
			 "FONOCONTACTO2", "ACCIONCITA", "PREVISION", "CONVENIO", "IDLLAMADA","CANCELADOPOR", "FECHAYHORAAGENDADO", "FONOCONTACTOCANCELACION", "FONOCONTACTO2CANCELACION",
			 "SMS_CANCELACION", "REAGENDADO", "HORACUPO", "SECTORCUPO_DESCRIPCIONLOCAL","PROFESIONALNOMBRES", "AGENDADOPOR", "AGENDADODESDE", "IDCUPOSISTEMA", 
			 "IDPACIENTESISTEMACLIENTE", "DETALLECUPO", "ID", "FECHA_CARGA_TABLA","FECHA_CARGA_OMI");

			header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
			if ($valFecha2 === "") {
				header('Content-Disposition: attachment; filename=Ciclos_GDA_'.$fecha1.'.xls');
			} else {
				header('Content-Disposition: attachment; filename=Ciclos_GDA_'.$fecha1.'_'.$fecha2.'.xls');
			}
			echo "<table  border='1' cellpadding='2' cellspacing='0'>";
				echo "<thead style='background: #0065D0;;color:white;'>";
				foreach($columnas as $clave => $valor){	echo "<th>".$valor."</th>";	}
				echo "</thead>";
				echo "<tbody>";
				$i = 2;
				foreach($data as $clave => $valor){
					echo "<tr>";
						echo "<td>".utf8_decode($valor['CENTRO'])."</td>";
						echo "<td>".$valor['TIPO_CARGA']."</td>";
						echo "<td>".$valor['CICLO']."</td>";
						echo "<td>".$valor['ESTADO']."</td>";
						echo "<td>".$valor['FECHAYHORACONTACTO']."</td>";
						echo "<td>".$valor['FECHAYHORACANCELACION']."</td>";
						echo "<td>".utf8_decode($valor['ESTABLECIMIENTOPACIENTE'])."</td>";
						echo "<td>".$valor['SECTORPACIENTE']."</td>";
						echo "<td>".$valor['IDCITAGDA']."</td>";
						echo "<td>".$valor['FECHACITA']."</td>";
						echo "<td>".$valor['HORACITA']."</td>";
						echo "<td>".$valor['NUMEROFICHA']."</td>";
						echo "<td>".$valor['RUTPACIENTE']."</td>";
						echo "<td>".utf8_decode($valor['NOMBREPACIENTE'])."</td>";
						echo "<td>".utf8_decode($valor['APELLIDOPATERNO'])."</td>";
						echo "<td>".utf8_decode($valor['APELLIDOMATERNO'])."</td>";
						echo "<td>".$valor['EDAD']."</td>";
						echo "<td>".$valor['FONOCONTACTO']."</td>";
						echo "<td>".$valor['FONOCONTACTO2']."</td>";
						echo "<td>".$valor['ACCIONCITA']."</td>";
						echo "<td>".$valor['PREVISION']."</td>";
						echo "<td>".$valor['CONVENIO']."</td>";
						echo "<td>".$valor['IDLLAMADA']."</td>";
						echo "<td>".$valor['CANCELADOPOR']."</td>";
						echo "<td>".$valor['FECHAYHORAAGENDADO']."</td>";
						echo "<td>".$valor['FONOCONTACTOCANCELACION']."</td>";
						echo "<td>".$valor['FONOCONTACTO2CANCELACION']."</td>";
						echo "<td>".$valor['SMS_CANCELACION']."</td>";
						echo "<td>".$valor['REAGENDADO']."</td>";
						echo "<td>".$valor['HORACUPO']."</td>";
						echo "<td>".$valor['SECTORCUPO_DESCRIPCIONLOCAL']."</td>";
						echo "<td>".utf8_decode($valor['PROFESIONALNOMBRES'])."</td>";
						echo "<td>".$valor['AGENDADOPOR']."</td>";
						echo "<td>".$valor['AGENDADODESDE']."</td>";
						echo "<td>".$valor['IDCUPOSISTEMA']."</td>";
						echo "<td>".$valor['IDPACIENTESISTEMACLIENTE']."</td>";
						echo "<td>".$valor['DETALLECUPO']."</td>";
						echo "<td>".$valor['ID']."</td>";
						echo "<td>".$valor['FECHA_CARGA_TABLA']."</td>";
						echo "<td>".$valor['FECHA_CARGA_OM']."</td>";
					echo "</tr>";
					$i++;
				}

				echo "</tbody>";
			echo "</table>";
		break;
		default:
			print("Error al buscar Datos en la base de datos");
		break;
	}


?>