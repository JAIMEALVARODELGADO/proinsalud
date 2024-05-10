<?php
session_start();
include ('php/conexion1.php');
$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
$sql = "select codigo_ciuo, descri_ciuo from ciuo WHERE descri_ciuo LIKE '%$q%' ORDER BY descri_ciuo";
$rsd = mysql_query($sql);
IF ($rsd)
{
	WHILE($rs = mysql_fetch_array($rsd)) 
	{
		$cid = $rs['codigo_ciuo'];
		$cname = $rs['descri_ciuo'];		
		ECHO "$cname|$cid\n";		
	}
	echo "NO EXISTE";
}
?>
