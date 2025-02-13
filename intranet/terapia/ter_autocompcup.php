<?php
session_start();
//Conexion con la base
include ('php/conexion.php');
$q = strtoupper($_GET["q"]);
if (!$q) RETURN;
	//$sql = "SELECT DISTINCT cup.codigo AS codi_,cup.descrip AS nomb_ FROM cups AS cup
	//WHERE cup.descrip LIKE '%$q%' and  cup.esta_cup='AC' ORDER BY cup.descrip";
	$sql = "SELECT DISTINCT vista_cups.codigo AS codi_,vista_cups.nombre_cups AS nomb_ FROM vista_cups
	WHERE vista_cups.nombre_cups LIKE '%$q%' and  vista_cups.esta_cup='AC' ORDER BY vista_cups.nombre_cups";
    //echo $sql;
$rsd = mysql_query($sql);
if($rsd){
	while($rs = mysql_fetch_array($rsd)){
		$cid = $rs[$datos[0]];
		$cname = $rs[$datos[1]];		
		echo "$cname|$cid\n";
	}
}
?>
<p><font color="#000000">no encontrado</font></p><html><head></head><body></body></html>