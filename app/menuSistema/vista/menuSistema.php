<?php include_once("../../../lib/seguridad.php");?>
<!DOCTYPE html>
<html ><!--style="    overflow: hidden;">-->
	<head>
		<title>Salud Cormup</title>
		<meta charset="UTF-8">
			<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">
		<!-- Revisar los iconos de imagenes-->
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    	<link rel="icon" href="favicon.ico" type="image/x-icon">
		 <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/se7en-font.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/isotope.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/jquery.fancybox.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/fullcalendar.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/wizard.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/select2.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/morris.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/datatables.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/datepicker.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/timepicker.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/colorpicker.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/bootstrap-switch.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/bootstrap-editable.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/daterange-picker.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/typeahead.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/summernote.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/ladda-themeless.min.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/social-buttons.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/pygments.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/style.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/color/green.css" media="all" rel="alternate stylesheet" title="green-theme" type="text/css" />
		 <link href="../../../lib/css/color/orange.css" media="all" rel="alternate stylesheet" title="orange-theme" type="text/css" />
		 <link href="../../../lib/css/color/magenta.css" media="all" rel="alternate stylesheet" title="magenta-theme" type="text/css" />
		 <link href="../../../lib/css/color/gray.css" media="all" rel="alternate stylesheet" title="gray-theme" type="text/css" />
		 <link href="../../../lib/css/jquery.fileupload-ui.css" media="screen" rel="stylesheet" type="text/css" />
		 <link href="css/style.css" media="all" rel="stylesheet" type="text/css" />
		 <link href="../../../lib/css/dropzone.css" media="screen" rel="stylesheet" type="text/css" />
		 <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
		 <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
		 <script src="../../../lib/js/bootstrap.min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/raphael.min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/selectivizr-min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/jquery.mousewheel.js" type="text/javascript"></script>
		 <script src="../../../lib/js/jquery.vmap.min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/jquery.vmap.sampledata.js" type="text/javascript"></script>
		 <script src="../../../lib/js/jquery.vmap.world.js" type="text/javascript"></script>
		 <script src="../../../lib/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
		 <script src="../../../lib/js/fullcalendar.min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/gcal.js" type="text/javascript"></script>
		 <script src="../../../lib/js/jquery.dataTables.min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/datatable-editable.js" type="text/javascript"></script>
		 <script src="../../../lib/js/jquery.easy-pie-chart.js" type="text/javascript"></script>
		 <script src="../../../lib/js/excanvas.min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/jquery.isotope.min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/isotope_extras.js" type="text/javascript"></script>
		 <script src="../../../lib/js/modernizr.custom.js" type="text/javascript"></script>
		 <script src="../../../lib/js/jquery.fancybox.pack.js" type="text/javascript"></script>
		 <script src="../../../lib/js/select2.js" type="text/javascript"></script>
		 <script src="../../../lib/js/styleswitcher.js" type="text/javascript"></script>
		 <script src="../../../lib/js/wysiwyg.js" type="text/javascript"></script>
		 <script src="../../../lib/js/typeahead.js" type="text/javascript"></script>
		 <script src="../../../lib/js/summernote.min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/jquery.inputmask.min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/jquery.validate.js" type="text/javascript"></script>
		 <script src="../../../lib/js/bootstrap-fileupload.js" type="text/javascript"></script>
		 <script src="../../../lib/js/bootstrap-datepicker.js" type="text/javascript"></script>
		 <script src="../../../lib/js/bootstrap-timepicker.js" type="text/javascript"></script>
		 <script src="../../../lib/js/bootstrap-colorpicker.js" type="text/javascript"></script>
		 <script src="../../../lib/js/bootstrap-switch.min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/typeahead.js" type="text/javascript"></script>
		 <script src="../../../lib/js/spin.min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/ladda.min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/moment.js" type="text/javascript"></script>
		 <script src="../../../lib/js/mockjax.js" type="text/javascript"></script>
		 <script src="../../../lib/js/bootstrap-editable.min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/xeditable-demo-mock.js" type="text/javascript"></script>
		 <script src="../../../lib/js/xeditable-demo.js" type="text/javascript"></script>
		 <script src="../../../lib/js/address.js" type="text/javascript"></script>
		 <script src="../../../lib/js/daterange-picker.js" type="text/javascript"></script>
		 <script src="../../../lib/js/date.js" type="text/javascript"></script>
		 <script src="../../../lib/js/morris.min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/skycons.js" type="text/javascript"></script>
		 <script src="../../../lib/js/fitvids.js" type="text/javascript"></script>
		 <script src="../../../lib/js/jquery.sparkline.min.js" type="text/javascript"></script>
		 <script src="../../../lib/js/dropzone.js" type="text/javascript"></script>
		 <script src="../../../lib/js/main.js" type="text/javascript"></script>
		 <script src="../../../lib/js/respond.js" type="text/javascript"></script>
		<script src="../controlador/cliente/controladorMenu.js"></script>		
		<script src="js/menuController.js"></script>			
		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
		
	</head>
	<body class="page-header-fixed bg-1">
		
		     <!-- Navigation -->
     <div id='contenedor'>
			<div class="navbar navbar-fixed-top scroll-hide">
		        <div class="container-fluid top-bar" style="height: 40px;">
		          <div class="pull-right">
		            <ul class="nav navbar-nav pull-right">
		            	<!--Trae la data para poder recibir el menu-->
		            	<input type='hidden' value='<?php echo $_SESSION['username'];?>' id='usuario' /> 
						<input type='hidden' value='<?php echo $_SESSION['sexo'];?>' id='sexo'>
						<input type='hidden' value='<?php echo $_SESSION['nombre'];?>' id='nombre'>
						<input type='hidden' value='<?php echo $_SESSION['perfil'];?>' id='perfil'>		
						<input type='hidden' value='<?php echo $_SESSION['centro'];?>' id='centro'>		
						<input type='hidden' value='<?php echo $_SESSION['clave'];?>' id='clave'>
						<input type='hidden' value='<?php echo $_SESSION['permisos'];?>' id='permisos'>
						
		            	<!--<input type='text' value= id='sexo' /> -->	                        
		              <li class="dropdown messages hidden-xs">		         
		              </li>
		              <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
		              	<label id="images"> </label>
		                <?php echo $_SESSION["nombre"] ?></a>
		              </li>
						<li class="dropdown user hidden-xs">
						<div class="dropdown-toggle" id="logout" style="margin-top: 0.7em;">
							<img style="cursor: pointer;" width="22" height="22" src="../../../lib/images/shut-down-icon.png" />
						</div>	
						</li>

		            </ul>
		          </div>
		          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>		          
		        </div>
		        <div class="container-fluid main-nav clearfix" style="height: 65px;    line-height: 0.5;">
		          <div class="nav-collapse">
		            <ul class="nav" id="menu">
		            </ul>		        
		          </div>
		          <div class="form-group">
	          			<div class="col-md-6"></div>
		          		<div class="col-lg-2">
			          		<div id="loader" class="loader">
								<img  style="width: 10%;margin-top: 6%;margin-left: 39%;" src="../../../lib/images/spinner.gif">
							</div>
						</div>	
					</div>	
		        </div>
	      </div>

	      <div id="show"></div>
			<div class="widget-container stats-container"><br>
				<iframe id="contenido" src="" style="width: 100%;  height: 1000em;border: none;    margin-top: -1%;">
     			</iframe>
		    </div>
		</div> 	

	</body>
</html>