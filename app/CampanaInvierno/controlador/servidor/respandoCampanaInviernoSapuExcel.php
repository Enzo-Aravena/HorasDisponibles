<?php
	require_once ("../../../../lib/conexion/conexionCampanaInvierno.php");
	require_once("../../modelo/modeloCampanaSapu.php");
	require_once "../../../../lib/PHPExcel/PHPExcel.php";
	require_once "../../../../lib/PHPExcel/PHPExcel/IOFactory.php";

	$bd = new Conexion();
	$modelo = new claseCampanaSapu();
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
		$semana_aux = "ATENCIONES SEMANAS EPIDEMIOLOGICAS $semana 2016";
	}



	if ($fecha1 == 0) {	 
		if($semana == 0 ){
			if ($centro ==0) {
				$data = json_encode($modelo->OBTENER_REPORTE_EXCEL_UNO($conn));
				//echo "MUESTRA EL 1";
			}else{
				$modelo->setCentro($centro);
				$data = json_encode($modelo->OBTENER_REPORTE_EXCEL_DOS($conn));
				//echo "MUESTRA EL 2";
			}// END ELSE CENTRO
		}else{
			if ($centro ==0) {
				$modelo->setSemana($semana);
				$data = json_encode($modelo->OBTENER_REPORTE_EXCEL_TRES($conn));
				//echo "MUESTRA EL 3";
			}else{
				$modelo->setSemana($semana);
				$modelo->setCentro($centro);
				$data =json_encode($modelo->OBTENER_REPORTE_EXCEL_CUATRO($conn));
				//echo "MUESTRA EL 4";
			}// END ELSE CENTRO

		} // END ELSE SEMANA
	}else{
		if ($centro ==0) {
			$modelo->setDesde($fecha1);
			$modelo->setHasta($fecha2);
			$data = json_encode($modelo->OBTENER_REPORTE_EXCEL_CINCO($conn));
			//echo "MUESTRA EL 5";
		}else{
			$modelo->setDesde($fecha1);
			$modelo->setHasta($fecha2);
			$modelo->setCentro($centro);
			$data = json_encode($modelo->OBTENER_REPORTE_EXCEL_SEIS($conn));
			//echo "MUESTRA EL 6";

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
        		    ->setCellValue('A2',  'Total Protocolos Aplicados')
					->setCellValue('B2',  $obj->CENTRO)
					->setCellValue('C2',  $obj->{'1_1'})
					->setCellValue('D2',  $obj->{'1_2'})
					->setCellValue('E2',  $obj->{'1_3'})
					->setCellValue('F2',  $obj->{'1_4'})
					->setCellValue('G2',  $obj->{'1_5'})
					->setCellValue('H2',  $obj->{'1_6'})
					->setCellValue('A3',  'Total Diagnosticos Agrupados del 1 al 6')
					->setCellValue('B3',  $obj->CENTRO)
					->setCellValue('C3',  $obj->{'2_1'})
					->setCellValue('D3',  $obj->{'2_2'})
					->setCellValue('E3',  $obj->{'2_3'})
					->setCellValue('F3',  $obj->{'2_4'})
					->setCellValue('G3',  $obj->{'2_5'})
					->setCellValue('H3',  $obj->{'2_6'})
					->setCellValue('A4',  '01.Ira Alta')
					->setCellValue('B4',  $obj->CENTRO)
					->setCellValue('C4',  $obj->{'3_1'})
					->setCellValue('D4',  $obj->{'3_2'})
					->setCellValue('E4',  $obj->{'3_3'})
					->setCellValue('F4',  $obj->{'3_4'})
					->setCellValue('G4',  $obj->{'3_5'})
					->setCellValue('H4',  $obj->{'3_6'})
					->setCellValue('A5',  '02.Influenza')
					->setCellValue('B5',  $obj->CENTRO)
					->setCellValue('C5',  $obj->{'4_1'})
					->setCellValue('D5',  $obj->{'4_2'})
					->setCellValue('E5',  $obj->{'4_3'})
					->setCellValue('F5',  $obj->{'4_4'})
					->setCellValue('G5',  $obj->{'4_5'})
					->setCellValue('H5',  $obj->{'4_6'})
					->setCellValue('A6',  '03.Neumonia')
					->setCellValue('B6',  $obj->CENTRO)
					->setCellValue('C6',  $obj->{'5_1'})
					->setCellValue('D6',  $obj->{'5_2'})
					->setCellValue('E6',  $obj->{'5_3'})
					->setCellValue('F6',  $obj->{'5_4'})
					->setCellValue('G6',  $obj->{'5_5'})
					->setCellValue('H6',  $obj->{'5_6'})
					->setCellValue('A7',  '04.Bronquitis Aguda')
					->setCellValue('B7',  $obj->CENTRO)
					->setCellValue('C7',  $obj->{'6_1'})
					->setCellValue('D7',  $obj->{'6_2'})
					->setCellValue('E7',  $obj->{'6_3'})
					->setCellValue('F7',  $obj->{'6_4'})
					->setCellValue('G7',  $obj->{'6_5'})
					->setCellValue('H7',  $obj->{'6_6'})
					->setCellValue('A8',  '05.Sbo')
					->setCellValue('B8',  $obj->CENTRO)
					->setCellValue('C8',  $obj->{'7_1'})
					->setCellValue('D8',  $obj->{'7_2'})
					->setCellValue('E8',  $obj->{'7_3'})
					->setCellValue('F8',  $obj->{'7_4'})
					->setCellValue('G8',  $obj->{'7_5'})
					->setCellValue('H8',  $obj->{'7_6'})
					->setCellValue('A9',  '06.Otra Causa Respiratoria')
					->setCellValue('B9',  $obj->CENTRO)
					->setCellValue('C9',  $obj->{'8_1'})
					->setCellValue('D9',  $obj->{'8_2'})
					->setCellValue('E9',  $obj->{'8_3'})
					->setCellValue('F9',  $obj->{'8_4'})
					->setCellValue('G9',  $obj->{'8_5'})
					->setCellValue('H9',  $obj->{'8_6'})
					->setCellValue('A10',  '07.Iam')
					->setCellValue('B10',  $obj->CENTRO)
					->setCellValue('C10',  $obj->{'9_1'})
					->setCellValue('D10',  $obj->{'9_2'})
					->setCellValue('E10',  $obj->{'9_3'})
					->setCellValue('F10',  $obj->{'9_4'})
					->setCellValue('G10',  $obj->{'9_5'})
					->setCellValue('H10',  $obj->{'9_6'})
					->setCellValue('A11',  '08.Ave')
					->setCellValue('B11',  $obj->CENTRO)
					->setCellValue('C11',  $obj->{'10_1'})
					->setCellValue('D11',  $obj->{'10_2'})
					->setCellValue('E11',  $obj->{'10_3'})
					->setCellValue('F11',  $obj->{'10_4'})
					->setCellValue('G11',  $obj->{'10_5'})
					->setCellValue('H11',  $obj->{'10_6'})
					->setCellValue('A12',  '09.Crisis Hta')
					->setCellValue('B12',  $obj->CENTRO)
					->setCellValue('C12',  $obj->{'11_1'})
					->setCellValue('D12',  $obj->{'11_2'})
					->setCellValue('E12',  $obj->{'11_3'})
					->setCellValue('F12',  $obj->{'11_4'})
					->setCellValue('G12',  $obj->{'11_5'})
					->setCellValue('H12',  $obj->{'11_6'})
					->setCellValue('A13',  '10.Arritmia')
					->setCellValue('B13',  $obj->CENTRO)
					->setCellValue('C13',  $obj->{'12_1'})
					->setCellValue('D13',  $obj->{'12_2'})
					->setCellValue('E13',  $obj->{'12_3'})
					->setCellValue('F13',  $obj->{'12_4'})
					->setCellValue('G13',  $obj->{'12_5'})
					->setCellValue('H13',  $obj->{'12_6'})
					->setCellValue('A14',  '11.Otras Causas Circulatorias')
					->setCellValue('B14',  $obj->CENTRO)
					->setCellValue('C14',  $obj->{'13_1'})
					->setCellValue('D14',  $obj->{'13_2'})
					->setCellValue('E14',  $obj->{'13_3'})
					->setCellValue('F14',  $obj->{'13_4'})
					->setCellValue('G14',  $obj->{'13_5'})
					->setCellValue('H14',  $obj->{'13_6'})
					->setCellValue('A15',  '12.Accidentes Del Transito')
					->setCellValue('B15',  $obj->CENTRO)
					->setCellValue('C15',  $obj->{'14_1'})
					->setCellValue('D15',  $obj->{'14_2'})
					->setCellValue('E15',  $obj->{'14_3'})
					->setCellValue('F15',  $obj->{'14_4'})
					->setCellValue('G15',  $obj->{'14_5'})
					->setCellValue('H15',  $obj->{'14_6'})
					->setCellValue('A16',  '13.Otros Traumatismos')
					->setCellValue('B16',  $obj->CENTRO)
					->setCellValue('C16',  $obj->{'15_1'})
					->setCellValue('D16',  $obj->{'15_2'})
					->setCellValue('E16',  $obj->{'15_3'})
					->setCellValue('F16',  $obj->{'15_4'})
					->setCellValue('G16',  $obj->{'15_5'})
					->setCellValue('H16',  $obj->{'15_6'})
					->setCellValue('A17',  '14.Heridas Por Arma Blanca')
					->setCellValue('B17',  $obj->CENTRO)
					->setCellValue('C17',  $obj->{'16_1'})
					->setCellValue('D17',  $obj->{'16_2'})
					->setCellValue('E17',  $obj->{'16_3'})
					->setCellValue('F17',  $obj->{'16_4'})
					->setCellValue('G17',  $obj->{'16_5'})
					->setCellValue('H17',  $obj->{'16_6'})
					->setCellValue('A18',  '15.Heridas Por Arma De Fuego')
					->setCellValue('B18',  $obj->CENTRO)
					->setCellValue('C18',  $obj->{'17_1'})
					->setCellValue('D18',  $obj->{'17_2'})
					->setCellValue('E18',  $obj->{'17_3'})
					->setCellValue('F18',  $obj->{'17_4'})
					->setCellValue('G18',  $obj->{'17_5'})
					->setCellValue('H18',  $obj->{'17_6'})
					->setCellValue('A19',  '16.Mordedura De Animal')
					->setCellValue('B19',  $obj->CENTRO)
					->setCellValue('C19',  $obj->{'18_1'})
					->setCellValue('D19',  $obj->{'18_2'})
					->setCellValue('E19',  $obj->{'18_3'})
					->setCellValue('F19',  $obj->{'18_4'})
					->setCellValue('G19',  $obj->{'18_5'})
					->setCellValue('H19',  $obj->{'18_6'})
					->setCellValue('A20',  '17.Vif')
					->setCellValue('B20',  $obj->CENTRO)
					->setCellValue('C20',  $obj->{'19_1'})
					->setCellValue('D20',  $obj->{'19_2'})
					->setCellValue('E20',  $obj->{'19_3'})
					->setCellValue('F20',  $obj->{'19_4'})
					->setCellValue('G20',  $obj->{'19_5'})
					->setCellValue('H20',  $obj->{'19_6'})
					->setCellValue('A21',  '18.Violencia Sexual')
					->setCellValue('B21',  $obj->CENTRO)
					->setCellValue('C21',  $obj->{'20_1'})
					->setCellValue('D21',  $obj->{'20_2'})
					->setCellValue('E21',  $obj->{'20_3'})
					->setCellValue('F21',  $obj->{'20_4'})
					->setCellValue('G21',  $obj->{'20_5'})
					->setCellValue('H21',  $obj->{'20_6'})
					->setCellValue('A22',  '19.Intento De Suicidio')
					->setCellValue('B22',  $obj->CENTRO)
					->setCellValue('C22',  $obj->{'21_1'})
					->setCellValue('D22',  $obj->{'21_2'})
					->setCellValue('E22',  $obj->{'21_3'})
					->setCellValue('F22',  $obj->{'21_4'})
					->setCellValue('G22',  $obj->{'21_5'})
					->setCellValue('H22',  $obj->{'21_6'})
					->setCellValue('A23',  '20.Descompensacion Psiquiatrica')
					->setCellValue('B23',  $obj->CENTRO)
					->setCellValue('C23',  $obj->{'22_1'})
					->setCellValue('D23',  $obj->{'22_2'})
					->setCellValue('E23',  $obj->{'22_3'})
					->setCellValue('F23',  $obj->{'22_4'})
					->setCellValue('G23',  $obj->{'22_5'})
					->setCellValue('H23',  $obj->{'22_6'})
					->setCellValue('A24',  '21.Diabetes Descompensada')
					->setCellValue('B24',  $obj->CENTRO)
					->setCellValue('C24',  $obj->{'23_1'})
					->setCellValue('D24',  $obj->{'23_2'})
					->setCellValue('E24',  $obj->{'23_3'})
					->setCellValue('F24',  $obj->{'23_4'})
					->setCellValue('G24',  $obj->{'23_5'})
					->setCellValue('H24',  $obj->{'23_6'})
					->setCellValue('A25',  '22.Diarreas')
					->setCellValue('B25',  $obj->CENTRO)
					->setCellValue('C25',  $obj->{'24_1'})
					->setCellValue('D25',  $obj->{'24_2'})
					->setCellValue('E25',  $obj->{'24_3'})
					->setCellValue('F25',  $obj->{'24_4'})
					->setCellValue('G25',  $obj->{'24_5'})
					->setCellValue('H25',  $obj->{'24_6'})
					->setCellValue('A26',  '23.Otras Gastrointestinales')
					->setCellValue('B26',  $obj->CENTRO)
					->setCellValue('C26',  $obj->{'25_1'})
					->setCellValue('D26',  $obj->{'25_2'})
					->setCellValue('E26',  $obj->{'25_3'})
					->setCellValue('F26',  $obj->{'25_4'})
					->setCellValue('G26',  $obj->{'25_5'})
					->setCellValue('H26',  $obj->{'25_6'})
					->setCellValue('A27',  '24.Otras Causas Externas')
					->setCellValue('B27',  $obj->CENTRO)
					->setCellValue('C27',  $obj->{'26_1'})
					->setCellValue('D27',  $obj->{'26_2'})
					->setCellValue('E27',  $obj->{'26_3'})
					->setCellValue('F27',  $obj->{'26_4'})
					->setCellValue('G27',  $obj->{'26_5'})
					->setCellValue('H27',  $obj->{'26_6'})
					->setCellValue('A28',  '25.Otros Procedimientos')
					->setCellValue('B28',  $obj->CENTRO)
					->setCellValue('C28',  $obj->{'27_1'})
					->setCellValue('D28',  $obj->{'27_2'})
					->setCellValue('E28',  $obj->{'27_3'})
					->setCellValue('F28',  $obj->{'27_4'})
					->setCellValue('G28',  $obj->{'27_5'})
					->setCellValue('H28',  $obj->{'27_6'});
	}

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
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A2:H".($i-1));
		$objPHPExcel->getActiveSheet()->getStyle('C2:H9')->getNumberFormat()->setFormatCode('#,##0');

		for($i = 'A'; $i <= 'H'; $i++){
		$objPHPExcel->setActiveSheetIndex(0)			
			->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('CAMPAÑA_INVIERNO');
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,1);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Campana_Invierno"'.$fecha1.'__'.$fecha2.'".xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;


?>