<?php
  //$conexion = mysql_connect("localhost","root","");
  $conexion = mysql_connect("192.168.4.12","root","");
	 if(!$conexion)
	  {
	  	echo "Error de conexion a la base de datos, Intente mas tarde.";
		exit();
	  }
	 mysql_select_db("proinsalud",$conexion);
?>