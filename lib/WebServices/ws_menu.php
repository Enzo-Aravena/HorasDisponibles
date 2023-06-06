<?php
include('lib/nusoap.php');
include('conexion.php');

$server = new soap_server;
//                      nombreWS               namespace
$server->configureWSDL('AdministradorMenu', 'urn:menu');   

if (!isset($HTTP_RAW_POST_DATA)) {
  $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}

function obtenerMenuPrincipal($usuario){
  $bd    = new Conexion();  
  $conn  = $bd->Conectar();
  $i=0;
  $data = Array();
  $query="";
  $datos = $conn->query("call redirectToMenu('$usuario')");
  $arreglo  = [];
  while ($fila = mysqli_fetch_array($datos)) {
        $data[$i] = Array(
          "data"    => "1",       
          "nombre"  => $fila[0],            
          "url"     => $fila[1],
          "imagen"  => $fila[2]
        );//end array
    $i++;
  }
  return json_encode($data);
}


//echo obtenerMenuPrincipal('mhen');

function mostrarMenu(){
  $bd    = new Conexion();  
  $conn  = $bd->Conectar();
  $i=0;
  $data = Array();
  $query="";
  $datos = $conn->query("SELECT idMenu,nombreMenu ,url,imagen from menu  order by nombreMenu asc");
  $arreglo  = [];
  while ($fila = mysqli_fetch_array($datos)) {
       $data[$i] = Array(
        "data"    =>"1",
        "idMenu"  =>$fila[0],
        "nombre"  => $fila[1],
        "menu"    => $fila[2],
        "imagen"  => $fila[3]
        );//end array
    $i++;
  }
  return json_encode($data);
}


function buscarMenuPorNombre($nombre){
  $bd    = new Conexion();  
  $conn  = $bd->Conectar();
  $i=0;
  $data = Array();
  $query="";
  $datos = $conn->query("call searchByNombreMenu('$nombre')");
  $arreglo  = [];
  while ($fila = mysqli_fetch_array($datos)) {
       $data[$i] = Array(
        "data"    =>"1",
        "nombre"  => $fila[0],
        "menu"    => $fila[1],
        "imagen"  => $fila[2]
        );//end array
    $i++;
  }
  return json_encode($data);
}


//echo buscarMenuPorNombre('subida rem');

function crearMenu($nombre,$ruta,$imagen){
  $bd    = new Conexion();  
  $conn  = $bd->Conectar();
  $i=0;
  $data = Array();
  $query="";
  $datos = $conn->query("call CreateToNewMenu('$nombre','$imagen','$ruta')");
  $arreglo  = [];
  $count = mysqli_num_rows($datos);
    if ($count == "0") {
      $data = array(
        "data" =>"0"
      );
    }else{
      while ($fila = mysqli_fetch_row($datos)) {  
        $data[$i] = Array(
        "data"    =>"1",
        "res"     =>$fila[0]
        );//end array
      $i++;
    }//end while
}
  return json_encode($data);
}


function buscarParaModificarMenu($idMenu){
  $bd    = new Conexion();  
  $conn  = $bd->Conectar();
  $i=0;
  $data = Array();
  $query="";
  $datos = $conn->query("call traerDataModificar('$idMenu')");
  $arreglo  = [];
  while ($fila = mysqli_fetch_array($datos)) {
       $data[$i] = Array(
        "data"    =>"1",
        "idMenu"  => $fila[0],
        "nombre"  => $fila[1],
        "menu"    => $fila[2],
        "imagen"  => $fila[3]
        );//end array
    $i++;
  }
  return json_encode($data);
}


 function modificarMenu($nombre,$ruta,$imagen,$idMenu){
  $bd    = new Conexion();  
  $conn  = $bd->Conectar();
  $i=0;
  $data = Array();
  $query="";
  $datos = $conn->query("call ModifyMenu('$nombre','$ruta','$imagen','$idMenu')");
  $arreglo  = [];
  $count = mysqli_num_rows($datos);
    if ($count == "0") {
      $data = array(
        "data" =>"0"
      );
    }else{
      while ($fila = mysqli_fetch_row($datos)) {  
        $data[$i] = Array(
        "data"    =>"1",
        "res"     =>$fila[0]
        );//end array
      $i++;
    }//end while
  }
   return json_encode($data);
  }


function buscarNombreMenu(){
  $bd    = new Conexion();  
  $conn  = $bd->Conectar();
  $i=0;
  $data = Array();
  $query="";
  $datos = $conn->query("call searchNameMenu()");
  $arreglo  = [];
  while ($fila = mysqli_fetch_array($datos)) {
      $data[$i] = Array(
        "data"    =>"1",
        "idMenu"  =>$fila[0],
        "nombre"  =>$fila[1]
      );//end array
    $i++;
  }
  return json_encode($data);
}

function buscarNombrePerfiles(){
  $bd    = new Conexion();  
  $conn  = $bd->Conectar();
  $i=0;
  $data = Array();
  $query="";
  $datos = $conn->query("call searchNamePerfiles()");
  $arreglo  = [];
  while ($fila = mysqli_fetch_array($datos)) {
      $data[$i] = Array(
        "data"    =>"1",
        "id"  =>$fila[0],
        "nombre"  =>$fila[1]
        );//end array
    $i++;
  }
  return json_encode($data);
}


 function insertarNavMenu($idPerfil,$idMenu){
  $bd    = new Conexion();  
  $conn  = $bd->Conectar();
  $i=0;
  $data = Array();
  $query="";
  $datos = $conn->query("call insertarNavMenu('$idPerfil','$idMenu')");
  $arreglo  = [];
  $count = mysqli_num_rows($datos);
    if ($count == "0") {
      $data = array(
        "data" =>"0"
      );
    }else{
      while ($fila = mysqli_fetch_row($datos)) {  
        $data[$i] = Array(
        "data"    =>"1",
        "res"     =>$fila[0]
        );//end array
      $i++;
    }//end while
  }
   return json_encode($data);
  }



function eliminarNavMenu($idMenu){
  $bd    = new Conexion();  
  $conn  = $bd->Conectar();
  $i=0;
  $data = Array();
  $query="";
  $datos = $conn->query("call eliminarNavMenu('$idMenu')");
  $count = mysqli_num_rows($resultado);
    if ($count == "0") {
      $data = array(
        "data" =>"0"
      );
    }else{
      while ($fila = mysqli_fetch_row($resultado)) {  
        $data[$i] = Array(
        "data"  =>"1",
        "respuesta" =>$fila[0]
        );//end array
      $i++;
    }//end while
    }//fin else
  return json_encode($data);
}

function eliminarMenu($idMenu){
  $bd    = new Conexion();  
  $conn  = $bd->Conectar();
  $i=0;
  $data = Array();
  $query="";
  $datos = $conn->query("call eliminarMenu('$idMenu')");
  
  return json_encode($data);
}



//                  nombreFuncion         parameter                         retorno data               nombreNamespace      acciondatonamespace+metodo        rpc  codifica   definicion metodo
$server->register('obtenerMenuPrincipal',array('usuario'=>'xsd:string'), array('return'=>'xsd:string'),'urn:menu','urn:menu#obtenerMenuPrincipal','rpc','encoded', 'AdministradorMenu');
$server->register('mostrarMenu',array(), array('return'=>'xsd:string'),'urn:menu','urn:menu#mostrarMenu','rpc','encoded', 'AdministradorMenu');
$server->register('buscarMenuPorNombre',array('nombre'=>'xsd:string'), array('return'=>'xsd:string'),'urn:menu','urn:menu#buscarMenuPorNombre','rpc','encoded', 'AdministradorMenu');

$server->register('crearMenu',array('nombre'=>'xsd:string','imagen'=>'xsd:string','ruta'=>'xsd:string'), array('return'=>'xsd:string'),'urn:menu','urn:menu#crearMenu','rpc','encoded', 'AdministradorMenu');

$server->register('buscarParaModificarMenu',array('idMenu'=>'xsd:string'), array('return'=>'xsd:string'),'urn:menu','urn:menu#buscarParaModificarMenu','rpc','encoded', 'AdministradorMenu');

$server->register('modificarMenu',array('nombre'=>'xsd:string','ruta'=>'xsd:string','imagen'=>'xsd:string','idMenu'=>'xsd:string'), array('return'=>'xsd:string'),'urn:menu','urn:menu#modificarMenu','rpc','encoded', 'AdministradorMenu');

$server->register('buscarNombreMenu',array(), array('return'=>'xsd:string'),'urn:menu','urn:menu#buscarNombreMenu','rpc','encoded', 'AdministradorMenu');
$server->register('buscarNombrePerfiles',array(), array('return'=>'xsd:string'),'urn:menu','urn:menu#buscarNombrePerfiles','rpc','encoded', 'AdministradorMenu');


$server->register('insertarNavMenu',array('idMenu'=>'xsd:string','idPerfil'=>'xsd:string'), array('return'=>'xsd:string'),'urn:menu','urn:menu#insertarNavMenu','rpc','encoded', 'AdministradorMenu');


$server->register('eliminarNavMenu',array('idMenu'=>'xsd:string'), array('return'=>'xsd:string'),'urn:menu','urn:menu#eliminarNavMenu','rpc','encoded', 'AdministradorMenu');


$server->register('eliminarMenu',array('idMenu'=>'xsd:string'), array('return'=>'xsd:string'),'urn:menu','urn:menu#eliminarMenu','rpc','encoded', 'AdministradorMenu');
$server->service($HTTP_RAW_POST_DATA);

?>
