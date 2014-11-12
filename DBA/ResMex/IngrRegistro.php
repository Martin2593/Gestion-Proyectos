<?php
  
 
  $user = $_REQUEST['user'];
  $passwd = $_REQUEST['passwd'];
  $rpasswd = $_REQUEST['rpasswd'];
  $nombre = $_REQUEST['nombre'];
  $appaterno = $_REQUEST['appaterno'];
  $apmeterno = $_REQUEST['apmeterno'];
  $tell = $_REQUEST['tell'];
  $TarCr = $_REQUEST['TarCr'];
  

  
  // 2# CREANDO OBJETO DE "Metodos.php"
  include("Metodos.php");
  $obj = new herramientas();
  
  $conex = $obj->m_conexion();  

  $sentencia = ("insert into (idU,passwd,nombres,appaterno,apmaterno,tell,TarCr,tipoU) usuario values ($user,$passwd,$nombre,$appaterno,$apmeterno,$tell,$TarCr,2)");
  
  $obj->m_query($sentencia);
  
  header("Location: login.php");      
  

?>