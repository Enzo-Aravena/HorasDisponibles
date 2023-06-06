<?php

require_once "../../../../lib/conexion/conexion.php";
require_once "../../../../lib/PHPExcel/PHPExcel.php";
require_once "../../../../lib/PHPExcel/PHPExcel/IOFactory.php";
require_once "../../modelo/modeloReporteCentro.php";

	$bd = new Conexion();
	$reporte = new reporteGda();
	$conn = $bd->Conectar();

	$centro = $_REQUEST['centro'];
	$ciclo  = $_REQUEST['ciclo'];
	$fecha  = $_REQUEST['fechaDato'];


	if ($centro !== "" && $ciclo !== "" && $fecha !== "") {
			
	$consulta="call SP_Export_Ciclos('".$fecha."',".$centro.",".$ciclo.")";

	$resultado = $conn->query($consulta);

	if($resultado->num_rows > 0 ){

	date_default_timezone_set('America/Mexico_City');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');


		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("yop") //Autor
					->setLastModifiedBy("yop") //Ultimo usuario que lo modificó
					->setTitle("Reporte Excel con PHP y MySQL")
					->setSubject("Reporte Excel con PHP y MySQL")
					->setDescription("Reporte Ocupacion Morbilidad")
					->setKeywords("Reporte Ocupacion Morbilidad")
					->setCategory("Reporte excel");

		$tituloReporte = "Reporte Ciclo GDA Agendados ";
		$titulosColumnas = array('AccionCita','FechayhoraCancelacion','FechayhoraContacto','EstablecimientoPaciente','SectorPaciente','Fechacita','HoraCita',
		'NumeroFicha','RutPaciente','NombrePaciente','ApellidoPaterno', 'ApellidoMaterno', 'EDAD','FonoContacto','FonoContacto2rio','FonoContactoCancelacion','FonoContacto2riaCancelacion',
		'Prevision','CanceladoPor','FechayHoraAgendado','SMS_Cancelacion','SectorCupo_DescripcionLocal','ProfesionalNombres','AgendadoPor','AgendadoDesde','IDCupoSistema','IDPacienteSistemaCliente',
		'ciclo');						

        $objPHPExcel->setActiveSheetIndex(0)
					//->setCellValue('A1',$tituloReporte)
        		    ->setCellValue('A1',  $titulosColumnas[0])
		            ->setCellValue('B1',  $titulosColumnas[1])
        		    ->setCellValue('C1',  $titulosColumnas[2])
            		->setCellValue('D1',  $titulosColumnas[3])
            		->setCellValue('E1',  $titulosColumnas[4])
					->setCellValue('F1',  $titulosColumnas[5])
					->setCellValue('G1',  $titulosColumnas[6])
					->setCellValue('H1',  $titulosColumnas[7])
					->setCellValue('I1',  $titulosColumnas[8])
					->setCellValue('J1',  $titulosColumnas[9])
					->setCellValue('K1',  $titulosColumnas[10])
					->setCellValue('L1',  $titulosColumnas[11])
					->setCellValue('M1',  $titulosColumnas[12])
					->setCellValue('N1',  $titulosColumnas[13])
					->setCellValue('O1',  $titulosColumnas[14])
					->setCellValue('P1',  $titulosColumnas[15])
					->setCellValue('Q1',  $titulosColumnas[16])
					->setCellValue('R1',  $titulosColumnas[17])
					->setCellValue('S1',  $titulosColumnas[18])
					->setCellValue('T1',  $titulosColumnas[19])
					->setCellValue('U1',  $titulosColumnas[20])
					->setCellValue('V1',  $titulosColumnas[21])
					->setCellValue('W1',  $titulosColumnas[22])
					->setCellValue('X1',  $titulosColumnas[23])
					->setCellValue('Y1',  $titulosColumnas[24])
					->setCellValue('Z1',  $titulosColumnas[25])
					->setCellValue('AA1',  $titulosColumnas[26])
					->setCellValue('AB1',  $titulosColumnas[27]);


		$i = 2;
		while ($fila = mysqli_fetch_row($resultado)) {	
		$objPHPExcel->setActiveSheetIndex(0)
		//utf8_encode($fila['proyecto']);		
        	    	->setCellValue('A'.$i,  utf8_encode($fila[0]))
					->setCellValue('B'.$i,  utf8_encode($fila[1]))
					->setCellValue('C'.$i,  utf8_encode($fila[2]))
					->setCellValue('D'.$i,  utf8_encode($fila[3]))
					->setCellValue('E'.$i,  utf8_encode($fila[4]))
					->setCellValue('F'.$i,  utf8_encode($fila[5]))
					->setCellValue('G'.$i,  utf8_encode($fila[6]))
					->setCellValue('H'.$i,  utf8_encode($fila[7]))
					->setCellValue('I'.$i,  utf8_encode($fila[8]))
					->setCellValue('J'.$i,  utf8_encode($fila[9]))
					->setCellValue('K'.$i,  utf8_encode($fila[10]))
					->setCellValue('L'.$i,  utf8_encode($fila[11]))
					->setCellValue('M'.$i,  utf8_encode($fila[12]))	
					->setCellValue('N'.$i,  utf8_encode($fila[13]))
					->setCellValue('O'.$i,  utf8_encode($fila[14]))
					->setCellValue('P'.$i,  utf8_encode($fila[15]))
					->setCellValue('Q'.$i,  utf8_encode($fila[16]))
					->setCellValue('R'.$i,  utf8_encode($fila[17]))
					->setCellValue('S'.$i,  utf8_encode($fila[18]))
					->setCellValue('T'.$i,  utf8_encode($fila[19]))
					->setCellValue('U'.$i,  utf8_encode($fila[20]))
					->setCellValue('V'.$i,  utf8_encode($fila[21]))
					->setCellValue('W'.$i,  utf8_encode($fila[22]))
					->setCellValue('X'.$i,  utf8_encode($fila[23]))
					->setCellValue('Y'.$i,  utf8_encode($fila[24]))
					->setCellValue('Z'.$i,  utf8_encode($fila[25]))
					->setCellValue('AA'.$i, utf8_encode($fila[26]))
					->setCellValue('AB'.$i, utf8_encode($fila[27]));	
			$i++;
		}		

		// Diseño de el excel 		
		$estiloTituloColumnas = array(
        	'font' => array(
	        	'name'      => 'Verdana',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>8,
	            	'color'     => array(
    	            	'rgb' => 'FFFFFF'
        	       	)

            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => '3A64FF')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,        			
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

        $estiloCeldas = array(
        	'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,        			
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

            $estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(
			array(
           		'font' => array(
               	'name'      => 'Arial',               
               	'color'     => array(
                   	'rgb' => '000000'
               	)
           	),
           		'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,        			
        			'rotation'   => 0
    		)
        ));


		// Agrega filtro a los titulos de la columnas
		$objPHPExcel->getActiveSheet()->setAutoFilter("A1:AB1");
		//ajusta las celdas
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);	

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);        		 
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);		
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);        
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);        
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);        
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);




		$objPHPExcel->getActiveSheet()->getStyle('A1:AB1')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A2:AB2".($i-1));

		//alinea las celdas
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);		

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle("Agendados y Cancelados_".$ciclo);

		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,1);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

		header('Content-Disposition: attachment;filename="CiclosGDA"'.$fecha."_".$centro."_"."Ciclo_".$ciclo.'".xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}
	else{		
		echo "<h2>No existen registros para Descargar ..  </h2> ";
		echo "<br> Seleccione Aqui para volver a los Ciclos GDA. <a href='../../vista/reporteCentros.php'> Volver atrás</a>";
	}

/**************************************  else final*************************************************/
	}else{
			print_r('ERRROR SE CAYO ESTA WEA ');
	}	



?>

