<?php
session_start();
session_register('datos');	
include ('php/conexion1.php');
$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
$sql = "SELECT DISTINCT $datos[0] AS $datos[0], $datos[1] FROM $datos[2] WHERE $datos[0] LIKE '%$q%' ORDER BY $datos[0]";

$rsd = mysql_query($sql);
IF ($rsd)
{
	WHILE($rs = mysql_fetch_array($rsd)) 
	{
		$cid = $rs[$datos[1]];
		$cname = $rs[$datos[0]];
		if($cid!='Z000' && $cid!='Z518' && $cid!='Z519')ECHO "$cname|$cid\n";		
	}
	

}
?>
