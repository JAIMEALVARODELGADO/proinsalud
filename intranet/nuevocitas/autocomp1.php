<?php	
include ('php/conexion1.php');
$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
$sql = "SELECT * from areas WHERE nom_areas LIKE '%$q%' ORDER BY nom_areas";
$rsd = mysql_query($sql);
IF ($rsd)
{
	WHILE($rs = mysql_fetch_array($rsd)) 
	{
		$cid = $rs[cod_areas];
		$cname = $rs[nom_areas];
		ECHO "$cname|$cid\n";
	}
	echo "NO EXISTE";
}
?>
