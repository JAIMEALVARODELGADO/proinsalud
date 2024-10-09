<?php	
include ('php/conexion1.php');
$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;

$sql = "SELECT DISTINCT cod_areas, nom_areas FROM areas WHERE nom_areas LIKE '%$q%' ORDER BY nom_areas";

$rsd = mysql_query($sql);
$nu=mysql_num_rows($rsd);
IF ($nu>0)
{
	WHILE($rs = mysql_fetch_array($rsd)) 
	{
		$cid = $rs[cod_areas];
		$cname = $rs[nom_areas];
		ECHO "$cname|$cid\n";
	}	
}
else
{
	$cid = '0';
	$cname = 'NUEVO '.$q;
	ECHO "$cname|$cid\n";		
}

?>
