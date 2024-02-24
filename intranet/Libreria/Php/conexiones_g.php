<?php
////////////////////////////////////CONXION AL LA BASE GENERAL DE DATOS COMO ROOT
  
  function base_general()
{
  //$conexion = mysql_connect("localhost","root","");
  $conexion = mysql_connect("192.168.4.12","root","");
	 if(!$conexion)
	  {
	  	echo "Error de conexion a la base de datos, Intente mas tarde.";
		exit();
	  }
	 mysql_select_db("general",$conexion);

 }
	 
  function base_proinsalud_1()
  {
	 //$conexion = mysql_connect("localhost","root","");
	 $conexion = mysql_connect("192.168.4.12","root","");
	 if(!$conexion)
	  {
	  	echo "Error de conexion a la base de datos, Intente mas tarde.";
		exit();
	  }
	 mysql_select_db("proinsalud_1",$conexion);
	 
	 
	} 
	 
	   function base_reportes()
  {
	 //$conexion = mysql_connect("localhost","root","");
	 $conexion = mysql_connect("192.168.4.12","root","");
	 if(!$conexion)
	  {
	  	echo "Error de conexion a la base de datos, Intente mas tarde.";
		exit();
	  }
	 mysql_select_db("reportes",$conexion);
	 
	 
	} 
	 
function base_proinsalud1(){
	//$conexion = mysql_connect("localhost","root","");
	$conexion = mysql_connect("192.168.4.12","root","");
	if(!$conexion){
	  	echo "Error de conexion a la base de datos, Intente mas tarde.";
		exit();
	}
	mysql_select_db("proinsalud_1",$conexion);	 	 
} 

function base_420(){
	$conexion = mysql_connect("192.168.4.20","root","");
	if(!$conexion){
	  	echo "Error de conexion a la base de datos, Intente mas tarde.";
		exit();
	}
	mysql_select_db("proinsalud",$conexion);	 	 
} 
	 
?>