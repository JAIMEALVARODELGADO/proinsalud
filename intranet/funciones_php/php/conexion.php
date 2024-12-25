<?php
  $conexion = mysql_connect("localhost","root","");
  if(!$conexion)
	  {
	  	echo "Error de conexion a la base de datos, Intente mas tarde.";
		exit();
	  }
	 mysql_select_db("general",$conexion);


?>