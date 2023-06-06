<?php
	require_once ("../PHPExcel/PHPExcel.php");
	require_once ("../PHPExcel/PHPExcel/IOFactory.php");

	$objPHPExcel = new PHPExcel();

	$data = $_REQUEST["data"];
	$titulo = $_REQUEST["titulo"];
	$titulosColumna = unserialize($_REQUEST["titulosColumna"]);	
	$valorCelda = $_REQUEST["valorCelda"];
	$contenidoCelda = $_REQUEST["contenidoCelda"];
	$letras = unserialize($_REQUEST["letra"]);
	$content = unserialize($_REQUEST["content"]);
	
	$arreglo = json_decode($data);

	date_default_timezone_set('America/Mexico_City');

	if (PHP_SAPI == 'cli'){
		die('Este archivo solo se puede ver desde un navegador web');
	}

	$objPHPExcel->getProperties()->setCreator("REGISTRO CLINICO")
		->setLastModifiedBy("REGISTRO CLINICO")
		->setTitle("Reporte Excel")
		->setSubject("Reporte Excel")
		->setDescription("Reporte Ocupacion Morbilidad")
		->setKeywords("Reporte Ocupacion Morbilidad")
		->setCategory("Reporte excel");

	

	/*********************************************************************************************/
	$newArray = array_combine($letras, $titulosColumna);
	$j = 0;
	$inicio =  reset($letras); // enero
	$fin =  end($letras);
	$rango =  $inicio.":".$fin;
	$l= 1;
	//carga de manera automatica la cabecera del archivo excel
	foreach ($newArray as $letra => $nombreCol) {
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra, $nombreCol,$j);      
	}

	$i = 2;
	foreach ($arreglo as $obj) {
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$i, utf8_encode($obj->FECHAOFERTA))
		->setCellValue('B'.$i, utf8_encode($obj->CENTRO))
		->setCellValue('C'.$i, utf8_encode($obj->OFERTADO_MORBT))
		->setCellValue('D'.$i, utf8_encode($obj->AGENDADOS_FINAL_MORBT))
		->setCellValue('E'.$i, utf8_encode($obj->AGENDADOS_CONFIRMADO_MORBT))
		->setCellValue('F'.$i, utf8_encode($obj->BLOQUES_NO_AGENDADOS_MORBT))
		->setCellValue('G'.$i, utf8_encode($obj->OFERTADO_MORBI))
		->setCellValue('H'.$i, utf8_encode($obj->AGENDADOS_MORBI))
		->setCellValue('I'.$i, utf8_encode($obj->AGENDADOS_CONFIRMADO_MORBI))
		->setCellValue('J'.$i, utf8_encode($obj->BLOQUES_NO_AGENDADOS_MORBI))
		->setCellValue('K'.$i, utf8_encode($obj->AGENDADOS_MORBT_TELEFONICA))
		->setCellValue('L'.$i, utf8_encode($obj->AGENDADOS_MESON_MORBT))
		->setCellValue('M'.$i, utf8_encode($obj->AGENDA_FINAL_PROCENTAJE_MORBT))
		->setCellValue('N'.$i, utf8_encode($obj->AGENDADOS_PORCENTAJE_MORBT))
		->setCellValue('O'.$i, utf8_encode($obj->INASISTENTE_PORCENTAJE_MORBT))
		->setCellValue('P'.$i, utf8_encode($obj->AGENDADOS_MORBI_FORZADOS))
		->setCellValue('Q'.$i, utf8_encode($obj->AGENDA_FINAL_PROCENTAJE_MORBI))
		->setCellValue('R'.$i, utf8_encode($obj->AGENDADOS_PORCENTAJE_MORBI))
		->setCellValue('S'.$i, utf8_encode($obj->INASISTENTE_PORCENTAJE_MORBI));
		$i++;
	}


/*

foreach ($letras as $valor ) {
	echo $valor."<br>";      
}

/*********************************************************************************************/
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
		//$objPHPExcel->getActiveSheet()->setAutoFilter($rango);
		//ajusta las celdas
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);	


		// RECORRE LA CELDA Y LAS VA ADJUNTANDO
		foreach ($content as $letrs => $value) {
	    	$objPHPExcel->getActiveSheet()->getColumnDimension($value)->setAutoSize(true);
		}


		$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);		
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle("Detalles");
		$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,1);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="aasdasd.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
?>