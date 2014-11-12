<?php
  //ARCHIVO PHP QUE CONTIENE TOOS LOS METODOS A UTILIZAR

 class Herramientas{
  // VARIABLES A UTILIZAR
    var $a_error;
  
  // #1 CONEXION AL SERVIDOR
    function m_conexion(){
	   $conexion = pg_connect("host=localhost dbname=depi user=userdepi password=aDMIN12345");
	   return $conexion;
	} 
  


  // 3# REALIZAR UN QUERY
    function m_query($consulta){
	   return pg_query($consulta);
	}
  // 4# CERRAR CONEXION
    function m_cerrarConexion($conexion){
	   pg_close($conexion);
	}
	
  // 5# CHECANDO RESPUESTA
    function m_checkRequest($nombCampo,$valorInicio=0){
	   if(isset($_REQUEST[$nombCampo]))
	        return $_REQUEST[$nombCampo];
		else
		    return $valorInicio;
	}
	
  
  // 7# INTENTO DE LISTA DESPLEGABLE EXITOSO


	 function m_listaDespl($name,$columnas,$tabla,$condicion,$value, $contenido){
		$resultado =$this->m_query("select $columnas from $tabla $condicion");
		
		echo '<option value="">Elige</option>';	
		//echo "<option value='0' selected></option>";
		while($fila=pg_fetch_array($resultado)){
			 echo "<option value='".$fila[$value]."'>".$fila[$contenido]."</option>";
         }
	}

// 7# LISTA DESPLEGABLE EXITOSO (TODO CODIGO)
   function m_listaDespegable($name,$columnas,$tabla,$condicion,$value, $contenido){
		$resultado =$this->m_query("select $columnas from $tabla $condicion");
		
		echo "<select name='$name' id='$name' required=''>";
		echo '<option value="">Elige</option>';	
		while($fila=pg_fetch_array($resultado)){
			 echo "<option value='".$fila[$value]."'>".$fila[$contenido]."</option>";
         }
        echo "</select>";
	}
  
  // 8# GENERADOR DE CANTIDADES EN COMBO BOX
    function m_genValores($name, $columna, $tabla, $condicion, $bandera, $selected){
	
	    $cantidad = $this->m_query("select $columna from $tabla where $condicion");
		
		if($bandera == true)
		    echo "<select name='$name' onchange='submit()'>";			
		else
		    echo "<select name='$name'>";
		
		
		for($i=0; $i <= $cantidad; $i++){
		    if($selected == $i)
			    echo "<option value='".$i."' selected>".$i."</option>";
		    echo "<option value='".$i."'>".$i."</option>";
		}
		echo "</select>";
	}

  
   //9# IMPRESION DE TABLA SENSILL
	function m_tablaPrincipal($consulta,$tipo){
 	  $result=$this->m_query($consulta);
 	  echo "<center>";
 	  echo "<table width=90% class='tbl'>
 	    <tr>";
 	             echo "<td class='num'>No.</td>";
 	             echo "<td class='num'></td>";
 	             $posicion=0;
 	        	 while ($posicion < 1) { 
 	               echo "<td>",pg_field_name($result,1),"</td>";    
 	               $posicion++;
 	           }
 	             echo "<td>Status</td>";
 	    echo "</tr>"; 	    
 	    $cont = $main = 0;
 	    while ($registro = pg_fetch_array($result, null, PGSQL_NUM)) {
 	    	$key = $registro[0];
 	    	$cont=$cont+1;
 	    	if($cont/2 == 1){
                echo "<tr class='st2'>";
 	    	}else{
 	    		echo "<tr class='st1'>";
 	    	}
 	        
 	                echo "<th class='num'>",$cont,"</th>";
 	                echo "<th class='num'>";
 	                echo "<a href='eliminarproyecto.php?n=$key'><img src='imagenes/eliminar.png' height='23' width='23'/></a>";
 	                echo "</th>";
 	                echo "<th><a href='adondeir.php?p=$key&t=$tipo'>",$registro[1],"</a></th>";
 	                if($registro[2]==1){
 	                	echo "<th>Registrado</th>";          
 	                }else{
 	                	echo "<th>Registro Pendiente</th>";
 	                }
 	               /* for($i=0; $i<count($registro); $i++){         
 	                      echo "<td bgcolor='#088A29'>",$registro[1],"</td>";
 	                  }*/

 	        echo "</tr>"; } 
 	echo "</table>"; 
 	echo "<center>";
    pg_free_result($result);
    }
 
 // IMPRESION DE TABLA DOCENTES
	function m_tablaDocentes($consulta,$tipo){
 	  $result=$this->m_query($consulta);
 	  echo "<center>";
 	  echo "<table width=95% class='tbl'>
 	    <tr>";
 	             echo "<td class='num'>No.</td>";
 	             echo "<td class='num'></td>";
 	             echo "<td class='num'>Nombre Colaborador</td>";
 	             echo "<td class='num'>Institucion</td>";
 	             echo "<td class='num'>RFC</td>";
 	             echo "<td class='num'>Tiempo Completo</td>";
 	             echo "<td class='num'>Correo Electronico</td>";
 	             echo "<td class='num'>Nivel SNI</td>";
 	             echo "<td class='num'>PROMEP</td>";
 	             echo "<td class='num'>CVU</td>";
 	             
 	    echo "</tr>"; 	    
 	    $cont = $main = 0;
 	    while ($registro = pg_fetch_array($result, null, PGSQL_NUM)) {
 	    	$rfc = $registro[1];
 	    	$tipo = $registro[2];
 	    	
 	    	$cont=$cont+1;
 	    	if($cont%2 == 0){
                echo "<tr class='st2'>";
 	    	}else{
 	    		echo "<tr class='st1'>";
 	    	}
 	        
 	        echo "<th class='num'>",$cont,"</th>";
 	        echo "<th class='num'>";
 	        echo "<a href='eliminardocente.php?n=$rfc&t=$tipo'><img src='imagenes/eliminar.png' height='23' width='23'/></a>";
 	        echo "</th>";
            
            if($tipo == "I"){
            	$consulta = $this->m_query("select * from docente where rfc='$rfc';"); 
                $dato = pg_fetch_object($consulta);
                //$status = $dato->nombres;
                echo "<th>",$dato->nombres,"</th>";
                echo "<th>",$registro[3],"</th>";
 	            echo "<th>",$registro[1],"</th>";
 	            echo "<th>",$registro[6],"</th>";
 	            echo "<th>",$dato->correo1,"</th>";
 	            echo "<th>",$registro[7],"</th>";
 	            echo "<th>",$registro[8],"</th>";
 	            echo "<th>",$dato->cvu,"</th>";

            }else{
            	echo "<th>",$registro[4],"</th>";
            	echo "<th>",$registro[3],"</th>";
 	            echo "<th>",$registro[1],"</th>";
 	            echo "<th>",$registro[6],"</th>";
 	            echo "<th>",$registro[5],"</th>";
 	            echo "<th>",$registro[7],"</th>";
 	            echo "<th>",$registro[8],"</th>";
 	            echo "<th>",$registro[9],"</th>";
            }
 	        
 	        
 	                

 	        echo "</tr>"; } 
 	echo "</table>"; 
 	echo "<center>";
    pg_free_result($result);
    }


    // IMPRESION DE TABLA ALUMNO
	function m_tablaAlumnos($consulta,$tipo){
 	  $result=$this->m_query($consulta);
 	  echo "<center>";
 	  echo "<table width=95% class='tbl'>
 	    <tr>";
 	             echo "<td class='num'>No.</td>";
 	             echo "<td class='num'></td>";
 	             echo "<td class='num'>Numero Control </td>";
 	             echo "<td class='num'>Nombre</td>";
 	             echo "<td class='num'>Institucion</td>";
 	             echo "<td class='num'>Semestre</td>";
 	             echo "<td class='num'>Grado</td>";
 	             echo "<td class='num'>Correo</td>"; 
 	             
 	    echo "</tr>"; 	    
 	    $cont = $main = 0;
 	    while ($registro = pg_fetch_array($result, null, PGSQL_NUM)) {
 	    	$ncontrol = $registro[1];
 	    	
 	    	$cont=$cont+1;
 	    	if($cont%2 == 0){
                echo "<tr class='st2'>";
 	    	}else{
 	    		echo "<tr class='st1'>";
 	    	}
 	        
 	        echo "<th class='num'>",$cont,"</th>";
 	        echo "<th class='num'>";
 	        echo "<a href='eliminaralumno.php?n=$ncontrol&t=$tipo'><img src='imagenes/eliminar.png' height='23' width='23'/></a>";
 	        echo "</th>";
            
            
            	$consulta = $this->m_query("select * from alumno where no_control='$ncontrol';"); 
                $dato = pg_fetch_object($consulta);
                //$status = $dato->nombres;
                echo "<th>",$registro[1],"</th>";
                echo "<th>",$dato->nombre,"</th>";
 	            echo "<th></th>";
 	            echo "<th>",$dato->id_grado,"</th>";
 	            echo "<th></th>";
 	            echo "<th>",$dato->correo,"</th>";  
 	        
 	        echo "</tr>"; } 
 	echo "</table>"; 
 	echo "<center>";
    pg_free_result($result);
    }


    // IMPRESION DE TABLA OBJETIVOS
	function m_tablaObjetivo($consulta,$tipo){
 	  $result=$this->m_query($consulta);
 	  echo "<center>";
 	  echo "<table width=95% class='tbl'>
 	    <tr>";
 	             echo "<td class='num'>No.</td>";
 	             echo "<td class='num'></td>";
 	             echo "<td class='num'>Objetivo Especifico </td>";
 	             
 	    echo "</tr>"; 	    
 	    $cont = $main = 0;
 	    while ($registro = pg_fetch_array($result, null, PGSQL_NUM)) {
 	    	$objetivo = $registro[0];
 	    	
 	    	$cont=$cont+1;
 	    	if($cont%2 == 0){
                echo "<tr class='st2'>";
 	    	}else{
 	    		echo "<tr class='st1'>";
 	    	}
 	        
 	        echo "<th class='num'>",$cont,"</th>";
 	        echo "<th class='num'>";
 	        echo "<a href='eliminarobjetivo.php?n=$objetivo&t=$tipo'><img src='imagenes/eliminar.png' height='23' width='23'/></a>";
 	        echo "</th>";
            echo "<th>",$registro[2],"</th>";
                
 	        
 	        echo "</tr>"; } 
 	echo "</table>"; 
 	echo "<center>";
    pg_free_result($result);
    }

    // IMPRESION DE TABLA PRODUCTO
	function m_tablaProducto($consulta){
 	  $result=$this->m_query($consulta);
 	  echo "<center>";
 	  echo "<table width=95% class='tbl'>
 	    <tr>";
 	             echo "<td class='num'>No.</td>";
 	             echo "<td class='num'></td>";
 	             echo "<td class='num'>Meta </td>";
 	             echo "<td class='num'>Cantidad</td>";
 	             echo "<td class='num'>Fecha de Cumplimiento</td>";
 	             echo "<td class='num'>Onservaciones </td>";
 	             
 	    echo "</tr>"; 	    
 	    $cont = $main = 0;
 	    while ($registro = pg_fetch_array($result, null, PGSQL_NUM)) {
 	    	$producto = $registro[0];
 	    	
 	    	$cont=$cont+1;
 	    	if($cont%2 == 0){
                echo "<tr class='st2'>";
 	    	}else{
 	    		echo "<tr class='st1'>";
 	    	}
 	        
 	        echo "<th class='num'>",$cont,"</th>";
 	        echo "<th class='num'>";
 	        echo "<a href='eliminarproducto.php?n=$producto'><img src='imagenes/eliminar.png' height='23' width='23'/></a>";
 	        echo "</th>";
            echo "<th></th>";
            echo "<th>",$registro[3],"</th>";
            echo "<th>",$registro[4],"</th>";
            echo "<th>",$registro[5],"</th>";
                
 	        
 	        echo "</tr>"; } 
 	echo "</table>"; 
 	echo "<center>";
    pg_free_result($result);
    }

// IMPRESION DE TABLA PRODUCTO
	function m_tablaActividades($consulta){
 	  $result=$this->m_query($consulta);
 	  echo "<center>";
 	  echo "<table width=95% class='tbl'>
 	    <tr>";
 	             echo "<td class='num'>No.</td>";
 	             echo "<td class='num'></td>";
 	             echo "<td class='num'>Responsable Actividad </td>";
 	             echo "<td class='num'>Actividad</td>";
 	             echo "<td class='num'>Periodo Realizacion</td>";
 	             echo "<td class='num'>Resultado Entregable </td>";
 	             echo "<td class='num'>Partida Solicitada </td>";
 	             echo "<td class='num'>Monto Solicitado </td>";
 	             echo "<td class='num'>Institucion </td>";
 	             echo "<td class='num'>Descripcion de Bienes </td>";
 	             
 	    echo "</tr>"; 	    
 	    $cont = $main = 0;
 	    while ($registro = pg_fetch_array($result, null, PGSQL_NUM)) {
 	    	$actividad = $registro[0];
 	    	
 	    	$cont=$cont+1;
 	    	if($cont%2 == 0){
                echo "<tr class='st2'>";
 	    	}else{
 	    		echo "<tr class='st1'>";
 	    	}
 	        
 	        echo "<th class='num'>",$cont,"</th>";
 	        echo "<th class='num'>";
 	        echo "<a href='eliminaractividad.php?n=$actividad'><img src='imagenes/eliminar.png' height='23' width='23'/></a>";
 	        echo "</th>";
            echo "<th>",$registro[2],"</th>";
            echo "<th>",$registro[1],"</th>";
            echo "<th>",$registro[3]," - ",$registro[4],"</th>";
            $consulta = $this->m_query("select descrip from resultadoentregable where id_resulentreg='".$registro[5]."';"); 
                $dato = pg_fetch_object($consulta);
            echo "<th>",$dato->descrip,"</th>";
            $consulta = $this->m_query("select descrip from partida where id_partida='".$registro[6]."';"); 
                $dato = pg_fetch_object($consulta);
            echo "<th>",$dato->descrip,"</th>";            
            echo "<th>",$registro[9],"</th>";
            $consulta = $this->m_query("select siglas from institucionguber where id_institucionguber='".$registro[8]."';"); 
                $dato = pg_fetch_object($consulta);
            echo "<th>",$dato->siglas,"</th>";
            echo "<th>",$registro[11],"</th>";
                
 	        
 	        echo "</tr>"; } 
 	echo "</table>"; 
 	echo "<center>";
    pg_free_result($result);
    }



   //10# CHECADOR
     function m_checRequest($nombCampo,$valoInicio=0){
        if (isset($_REQUEST[$nombCampo]))
           return $_REQUEST[$nombCampo];
        else
          return $valoInicio;
     }


    




	
	 
 }
?>