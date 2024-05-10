<?php
session_start();
session_register('datos');	
include ('php/conexion1.php');
$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
$sql = "SELECT municipio.CODI_MUN, municipio.NOMB_MUN, departamento.NOMB_DEP
FROM municipio INNER JOIN departamento ON municipio.DEPA_MUN = departamento.CODI_DEP WHERE municipio.NOMB_MUN LIKE '%$q%' ORDER BY municipio.NOMB_MUN";
echo $meneo;
$rsd = mysql_query($sql);
IF ($rsd)
{
	WHILE($rs = mysql_fetch_array($rsd)) 
	{
		$cid = $rs['CODI_MUN'];
		$cname = $rs['NOMB_MUN'].' ('.$rs['NOMB_DEP'].')';		
		ECHO "$cname|$cid\n";		
	}
	echo "NO EXISTE";
}
?>
