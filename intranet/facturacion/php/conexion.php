<?php
  //$conexion = mysql_connect("localhost","root","");
  $conexion = mysql_connect("192.168.4.12","root","");
  //$conexion = mysql_connect("192.168.4.20","root","");
	 if(!$conexion)
	  {
	  	echo "Error de conexion a la base de datos, Intente mas tarde.";
		exit();
	  }
	  //mysql_set_charset('utf8',$conexion);
	 mysql_set_charset('latin1',$conexion);
	 mysql_select_db("proinsalud",$conexion);	 
	 
?>