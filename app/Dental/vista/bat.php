<?php 

	// LE DA UN MAXIMO DE EJECUCION 
	ini_set('max_execution_time', 3000);

	$ejecucion  = exec('StockCargaMedicamentos.bat');
	//	exec('c:\WINDOWS\system32\cmd.exe /c START C:\wamp\www\saludCormupV2-Desarrollo\app\Dental\vista\StockCargaMedicamentos.bat');	

 ?>