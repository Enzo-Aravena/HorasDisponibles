<?php 

	// LE DA UN MAXIMO DE EJECUCION 
	ini_set('max_execution_time', 3000);
	$ejecucion  = exec('StockCargaMedicamentos.bat');	
	//$ejecucion  = exec('c:\WINDOWS\system32\cmd.exe /c START C:\xampp\htdocs\saludCormup\app\Dental\vista\StockCargaMedicamentos.bat');
	
	//system("StockCargaMedicamentos.bat");
 	//echo $ejecucion;*/

 ?>