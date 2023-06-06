<?php

require_once ("../../../../lib/conexion/conexionCampanaInvierno.php");
require_once("../../modelo/modeloCampana.php");
require_once "../../../../lib/PHPExcel/PHPExcel.php";
require_once "../../../../lib/PHPExcel/PHPExcel/IOFactory.php";

	$bd = new Conexion();
	$modelo = new claseCampana();

	$conn = $bd->Conectar();

	$desde = $_REQUEST['fecha1'];
	$hasta = $_REQUEST['fecha2'];
	$centro = $_REQUEST['centro'];
	$semana = $_GET['semana'];

	if(empty($desde)){
		$fecha1 = 0;
	}else{
		$dato  = explode("/", $desde);
		$fecha1 = $dato[2]."-".$dato[1]."-".$dato[0];
	}

	if(empty($hasta)){
		$fecha2 = 0;
	}else{
		$dato  = explode("/", $hasta);
		$fecha2 = $dato[2]."-".$dato[1]."-".$dato[0];
	}	

	$fecha1_aux = date("d-m-Y", strtotime($_GET['fecha1']));
	$fecha2_aux = date("d-m-Y", strtotime($_GET['fecha2']));	

	if($semana == 0){
		$semana_aux = "TOTAL ACUMULADAS SEMANAS EPIDEMIOLOGICAS";
	}else{
		$semana_aux = "ATENCIONES SEMANAS EPIDEMIOLOGICAS $semana 2022";
	}

	if ($fecha1 == 0) {	 
		if($semana == 0 ){
			if ($centro ==0) {
				$data = json_encode($modelo->CAMIN_OBTENER_DATOS_TABLA_UNO($conn));
			}else{
				$modelo->setCentro($centro);
				$data = json_encode($modelo->CAMIN_OBTENER_DATOS_TABLA_EXCEL_DOS($conn));
			}// END ELSE CENTRO
		}else{
			if ($centro ==0) {
				$modelo->setSemana($semana);
				$data = json_encode($modelo->CAMIN_OBTENER_DATOS_TABLA_EXCEL_TRES($conn));
			}else{
				$modelo->setSemana($semana);
				$modelo->setCentro($centro);
				$data =json_encode($modelo->CAMIN_OBTENER_DATOS_TABLA_EXCEL_CUATRO($conn));
			}// END ELSE CENTRO

		} // END ELSE SEMANA
	}else{
		if ($centro ==0) {
			$modelo->setDesde($fecha1);
			$modelo->setHasta($fecha2);
			$data = json_encode($modelo->CAMIN_OBTENER_DATOS_TABLA_EXCEL_CINCO($conn));
		}else{
			$modelo->setDesde($fecha1);
			$modelo->setHasta($fecha2);
			$modelo->setCentro($centro);
			$data = json_encode($modelo->CAMIN_OBTENER_DATOS_TABLA_EXCEL_SEIS($conn));

		}// END ELSE CENTRO

	}//  END ELSE FECHA

	date_default_timezone_set('America/Mexico_City');

	// Se crea el objeto PHPExcel
	$objPHPExcel = new PHPExcel();

	// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("yop") //Autor
					->setLastModifiedBy("yop") //Ultimo usuario que lo modificó
					->setTitle("Reporte Excel con PHP y MySQL")
					->setSubject("Reporte Excel con PHP y MySQL")
					->setDescription("Reporte_Campana_Invierno")
					->setKeywords("Reporte_Campana_Invierno")
					->setCategory("Reporte excel");


	if ($_GET['fecha1']==0) {	
		$titulosColumnas = array($semana_aux, 'CENTRO', 'TOTAL', '- 1 AÑO','1 A 4 AÑOS','5 A 14 AÑOS','15 A 64 AÑOS','65 AÑOS Y +');
	}else{
		$titulosColumnas = array('ATENCIONES ENTRE '.$fecha1_aux. ' HASTA '.$fecha2_aux, 'CENTRO', 'TOTAL', '- 1 AÑO','1 A 4 AÑOS','5 A 14 AÑOS','15 A 64 AÑOS','65 AÑOS Y +');
	}

	//$subColum = array('Total Atenciones del CESFAM (contiene las respiratorias)','Total Atenciones por causa Sistema Respiratorio','Ira Alta (J00,J06)','Influenza (J09,J11)','Neumonía (J12,J18)','Bronquitis/Bronquiolitis aguda (J20,J21)','Crisis obstructiva bronquial (J40,J46)','Otras causas respiratorias (J22,J30,J39,J47,J60,J98)');	

	 $objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1',  $titulosColumnas[0])
			->setCellValue('B1',  $titulosColumnas[1])
			->setCellValue('C1',  $titulosColumnas[2])
			->setCellValue('D1',  $titulosColumnas[3])
			->setCellValue('E1',  $titulosColumnas[4])
			->setCellValue('F1',  $titulosColumnas[5])
			->setCellValue('G1',  $titulosColumnas[6])
			->setCellValue('H1',  $titulosColumnas[7]);

	$arreglo = json_decode($data);

	$i = 2;
	foreach ($arreglo as $obj) {


		$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A2',  'Total Atenciones del CESFAM (contiene las respiratorias)')
					->setCellValue('B2',  $obj->CENTRO)
					->setCellValue('C2',  $obj->{'1_1'})
					->setCellValue('D2',  $obj->{'1_2'})
					->setCellValue('E2',  $obj->{'1_3'})
					->setCellValue('F2',  $obj->{'1_4'})
					->setCellValue('G2',  $obj->{'1_5'})
					->setCellValue('H2',  $obj->{'1_6'})
					->setCellValue('A3',  'Total Atenciones por causa Sistema Respiratorio')
					->setCellValue('B3',  $obj->CENTRO)
					->setCellValue('C3',  $obj->{'2_1'})
					->setCellValue('D3',  $obj->{'2_2'})
					->setCellValue('E3',  $obj->{'2_3'})
					->setCellValue('F3',  $obj->{'2_4'})
					->setCellValue('G3',  $obj->{'2_5'})
					->setCellValue('H3',  $obj->{'2_6'})
					->setCellValue('A4',  'Ira Alta (J00,J06)')
					->setCellValue('B4',  $obj->CENTRO)
					->setCellValue('C4',  $obj->{'3_1'})
					->setCellValue('D4',  $obj->{'3_2'})
					->setCellValue('E4',  $obj->{'3_3'})
					->setCellValue('F4',  $obj->{'3_4'})
					->setCellValue('G4',  $obj->{'3_5'})
					->setCellValue('H4',  $obj->{'3_6'})
					->setCellValue('A5',  'Influenza (J09,J11)')
					->setCellValue('B5',  $obj->CENTRO)
					->setCellValue('C5',  $obj->{'4_1'})
					->setCellValue('D5',  $obj->{'4_2'})
					->setCellValue('E5',  $obj->{'4_3'})
					->setCellValue('F5',  $obj->{'4_4'})
					->setCellValue('G5',  $obj->{'4_5'})
					->setCellValue('H5',  $obj->{'4_6'})
					->setCellValue('A6',  'Neumonía (J12,J18)')
					->setCellValue('B6',  $obj->CENTRO)
					->setCellValue('C6',  $obj->{'5_1'})
					->setCellValue('D6',  $obj->{'5_2'})
					->setCellValue('E6',  $obj->{'5_3'})
					->setCellValue('F6',  $obj->{'5_4'})
					->setCellValue('G6',  $obj->{'5_5'})
					->setCellValue('H6',  $obj->{'5_6'})
					->setCellValue('A7',  'Bronquitis/Bronquiolitis aguda (J20,J21)')
					->setCellValue('B7',  $obj->CENTRO)
					->setCellValue('C7',  $obj->{'6_1'})
					->setCellValue('D7',  $obj->{'6_2'})
					->setCellValue('E7',  $obj->{'6_3'})
					->setCellValue('F7',  $obj->{'6_4'})
					->setCellValue('G7',  $obj->{'6_5'})
					->setCellValue('H7',  $obj->{'6_6'})
					->setCellValue('A8',  'Crisis obstructiva bronquial (J40,J46)')
					->setCellValue('B8',  $obj->CENTRO)
					->setCellValue('C8',  $obj->{'7_1'})
					->setCellValue('D8',  $obj->{'7_2'})
					->setCellValue('E8',  $obj->{'7_3'})
					->setCellValue('F8',  $obj->{'7_4'})
					->setCellValue('G8',  $obj->{'7_5'})
					->setCellValue('H8',  $obj->{'7_6'})
					->setCellValue('A9',  'Otras causas respiratorias (J22,J30,J39,J47,J60,J98)')
					->setCellValue('B9',  $obj->CENTRO)
					->setCellValue('C9',  $obj->{'8_1'})
					->setCellValue('D9',  $obj->{'8_2'})
					->setCellValue('E9',  $obj->{'8_3'})
					->setCellValue('F9',  $obj->{'8_4'})
					->setCellValue('G9',  $obj->{'8_5'})
					->setCellValue('H9',  $obj->{'8_6'});
		$i++;
	}

		/*********************************************************************************************/
			$estiloTituloColumnas = array(
        	'font' => array(
	        	'name'      => 'Calibri',
    	        'bold'      => false,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>9,
	            	'color'     => array(
    	            	'rgb' => 'FFFFFF'
        	       	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => '0070C0')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

		
			
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(
			array(
           		'font' => array(
               	'name'      => 'Calibri', 
				'size' =>8
               	
           	)
           
        ));
		 
		//$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A2:H".($i-1));
		$objPHPExcel->getActiveSheet()->getStyle('C2:H9')->getNumberFormat()->setFormatCode('#,##0');

		for($i = 'A'; $i <= 'H'; $i++){
		$objPHPExcel->setActiveSheetIndex(0)			
			->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('CAMPAÑA_INVIERNO');


		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,1);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Campana_Invierno"'.$fecha1.'__'.$fecha2.'".xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	

?>