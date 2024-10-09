<?php
session_start();
session_register('datos_med');	


//$link=Mysql_connect("localhost","root","");
$link=Mysql_connect("192.168.4.12","root","");
if(!$link)echo"no hay conexion";
Mysql_select_db('proinsalud',$link);


$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
$sql = "SELECT cod_medi,nom_medi FROM medicos WHERE nom_medi LIKE '%$q%' AND esta_medi='A'";
//echo $sql;
$rsd = mysql_query($sql);
IF ($rsd)
{
	WHILE($rs = mysql_fetch_array($rsd)) 
	{
		$cid = $rs[cod_medi];
		$cname = $rs[nom_medi];
		ECHO "$cname|$cid\n";
	}
}
ECHO "NO EXISTE";
?><html><head></head><body></body></html>