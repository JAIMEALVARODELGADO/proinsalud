<?php
 
include ('php/conexion1.php');
$q = strtoupper($_GET["q"]);
$sql = mysql_query("select * from cups where descrip LIKE '%$q%' and esta_cup='AC' ORDER BY descrip");
if(mysql_num_rows($sql)>0)
{
	WHILE($rs = mysql_fetch_array($sql)) 
	{
		$cid = $rs['codigo'];
		$cname = $rs['descrip'];
		ECHO "$cname|$cid\n";
	}	
}
else
{
	echo "NO EXISTE";
}
?>























