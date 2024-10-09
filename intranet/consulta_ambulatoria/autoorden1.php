<?php
session_start();
include ('php/conexion1.php');
$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
$sql = mysql_query("select codigo,descrip,nive_cup from cups where esta_cup='AC' AND nive_cup<>0 and descrip LIKE '%$q%' ORDER BY descrip");
IF (mysql_num_rows($sql)>0)
{
	WHILE($rs = mysql_fetch_array($sql)) 
	{
		$cid = $rs['codigo'];
		$cname = $rs['descrip'];
		$nive = $rs['nive_cup'];
		if($nive>2)$nive='REFERENCIA';
		else $nive='CITAS';
		ECHO "$cname|$cid|$nive\n";		
	}	
}
else
{
	echo "NO EXISTE";
}
?>