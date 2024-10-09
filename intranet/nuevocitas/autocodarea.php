<?php	
include ('php/conexion1.php');
$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
$sql = "SELECT * from areas WHERE cod_areas LIKE '%$q%' ORDER BY cod_areas";
$rsd = mysql_query($sql);
$nu=mysql_num_rows($rsd);
IF ($nu>0)
{
	WHILE($rs = mysql_fetch_array($rsd)) 
	{
		$cid = $rs[cod_areas];
		$cname = $rs[nom_areas];
		ECHO "$cid|$cname\n";
	}	
}
else
{
	$cid = 'NUEVO '.$q;
	$cname =$q;
	ECHO "$cid|$cname\n";		
}

?>
