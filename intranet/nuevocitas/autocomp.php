<?php	
include ('php/conexion1.php');
$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
$sql = "SELECT * from medicos WHERE nom_medi LIKE '%$q%' AND esta_medi='A' ORDER BY nom_medi";
$rsd = mysql_query($sql);
IF ($rsd)
{
	WHILE($rs = mysql_fetch_array($rsd)) 
	{
		$cid = $rs[cod_medi];
		$cname = $rs[nom_medi];
		ECHO "$cname|$cid\n";
	}
	echo "NO EXISTE";
}
?>