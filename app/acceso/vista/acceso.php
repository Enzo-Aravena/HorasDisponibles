<?php session_start();session_unset();session_destroy();?>
<!DOCTYPE html>
<html>
  <head>
  <title>Salud Cormup </title>
  <meta charset="UTF-8">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="../../../lib/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />   
    <link href="../../../lib/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../../lib/css/se7en-font.css" media="all" rel="stylesheet" type="text/css" />  
    <script src='../../../lib/jquery-3.2.1.min.js'></script>
    <?php include_once("../../../lib/components.php");?>
  <script src='../controlador/cliente/controladorPagina.js'></script>
  <script src='js/funcionPagina.js'></script>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
     <body class="login2">
      <div class="col-md-1">
        <ul class="nav" style="width: 5em;">
          <li>
           <!-- <a class="current" href="#" id="volver"> <span><img src="../../../lib/images/icon.png"></span>Volver</a> -->
          </li>
        </ul>
      </div>

    <!-- Login Screen -->
    <div class="login-wrapper">
    <a href="./"><img width="200" height="60" src="../../../lib/images/logo-login.png" /></a>
    <br>
    <h3> <b>Salud cormup 2.0</b></h3>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input class="form-control" placeholder="Usuario omi" id="user" type="text">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input class="form-control" placeholder="Clave"  id="pass" type="password">
          </div>
        </div>
      
      <button class="btn btn-primary" id="ejecutar">Login</button>	  
      <br>
      <br>
   		<span id="msgbox" style="display:none"></span>   
   		 <br>
   		<span id="intentos" style="display:none"> Intentos : 3</span>   
   		 <br>   
   </div>


  </body>

</html>