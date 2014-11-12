<?php
  
  // 1# OBTENINEDO DATOS DE LOS CAMPOS DE "indice.php"
  $user = $_REQUEST['user'];
  $pwd = $_REQUEST['passwd'];

  
  // 2# CREANDO OBJETO DE "Metodos.php"
  include("Metodos.php");
  $obj = new herramientas();
  
  $conex = $obj->m_conexion();
  /*$obj->m_selecDB($conex,"DEPI");*/

  
  $cad = ("select * from usuario  where idU='$user' and password='$pwd' limit 1");
  
   $registro = $obj->m_query($cad);

  if(pg_num_rows($registro) == 1){
      //CREAR SESION
	  session_start();
	  $tupla = pg_fetch_object($registro);
    $_SESSION['idU']=$tupla->idU;
	  $_SESSION['nombre'] = $tupla->nombres." ".$tupla->appaterno." ".$tupla->apmaterno;
    $_SESSION['activo']="";
    $_SESSION['tipoU']=$tupla->tipoUser;
	  header("Location: bienvenido.php"); 
  }
  else 
	  header("Location: login.php?V=1");      
  

?>