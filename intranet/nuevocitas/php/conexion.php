<?php
  $usuario   = "root";
  $pass      = "";
  //$conexion = mysql_connect("localhost",$usuario,$pass);
  $conexion = mysql_connect("192.168.4.20",$usuario,$pass);
  if(!$conexion)
  {
        echo "Error de conexion a la base de datos, Intente mas tarde.";
        exit();
  }
  mysql_select_db("general",$conexion);
?>




 