<?php	
include ('php/conexion.php');
$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
$sql = "SELECT * from cut WHERE nomb_usua LIKE '%$q%' ORDER BY nomb_usua";
$rsd = mysql_query($sql);
IF ($rsd)
{
	WHILE($rs = mysql_fetch_array($rsd)) 
	{
		$cid = $rs[ide_usua];
		$cname = $rs[nomb_usua];
		ECHO "$cname|$cid\n";
	}
	echo "NO EXISTE";
}
?>
