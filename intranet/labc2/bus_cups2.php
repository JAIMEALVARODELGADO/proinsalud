<?php
session_start();
session_register('datos_');	


//$link=Mysql_connect("localhost","root","");
$link=Mysql_connect("192.168.4.12","root","");
if(!$link)echo"no hay conexion";
Mysql_select_db('proinsalud',$link);


$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
//$sql = "SELECT codigo,descrip FROM cups WHERE descrip LIKE '%$q%' AND esta_cup='AC'";
$sql = "SELECT codigo,nombre_cups FROM vista_cups WHERE nombre_cups LIKE '%$q%' AND esta_cup='AC'";
//echo $sql;
$rsd = mysql_query($sql);
IF ($rsd)
{
	WHILE($rs = mysql_fetch_array($rsd)) 
	{
		$cid = $rs[codigo];
		$cname = $rs[nombre_cups];
		ECHO "$cname|$cid\n";
	}
}
ECHO "NO EXISTE";
?><html><head></head><body></body></html>