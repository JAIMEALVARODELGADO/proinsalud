<?php
session_start();
session_register('datos');	

$link=Mysql_connect("localhost","root","");
if(!$link)echo"no hay conexion";
Mysql_select_db('proinsalud',$link);

$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
$sql = "SELECT DISTINCT $datos[0] AS $datos[0], $datos[1] FROM $datos[2] WHERE $datos[0] LIKE '%$q%'";
//echo $sql;
$rsd = mysql_query($sql);
IF ($rsd)
{
	WHILE($rs = mysql_fetch_array($rsd)) 
	{
		$cid = $rs[$datos[1]];
		$cname = $rs[$datos[0]];
		ECHO "$cname|$cid\n";
	}
}
echo "No Existe"
?><html><head></head><body></body></html>