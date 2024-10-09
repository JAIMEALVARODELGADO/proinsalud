<?php
include ('php/conexion1.php');
$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
$sql = mysql_query("SELECT arc_ent.iden_ent, arc_ent.razs_ent, arc_ent.codi_mun, municipio.NOMB_MUN, 
departamento.CODI_DEP, departamento.NOMB_DEP
FROM (arc_ent LEFT JOIN municipio ON arc_ent.codi_mun = municipio.CODI_MUN) LEFT JOIN departamento ON municipio.DEPA_MUN = departamento.CODI_DEP
WHERE (((arc_ent.razs_ent) LIKE '%$q%')) ORDER BY arc_ent.razs_ent");
IF (mysql_num_rows($sql)>0)
{
	WHILE($rs = mysql_fetch_array($sql)) 
	{		
		$cid = $rs['iden_ent'];
		$cname = $rs['razs_ent'];
		$cmun = $rs['codi_mun'];
		$cdep = $rs['CODI_DEP'];
		$nmun = $rs['NOMB_MUN'];
		$ndep = $rs['NOMB_DEP'];
		ECHO "$cname|$cid|$cmun|$cdep|$nmun|$ndep\n";
	}	
}
else
{
	echo "NO EXISTE";
}
?>






















