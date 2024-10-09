<?php
session_start();
session_register('datos');	
include ('php/conexion1.php');
$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
$sql = "SELECT destipos.nomb_des, destipos.codi_des, esta_especialidad.esta_esp, destipos.codt_des
FROM destipos INNER JOIN esta_especialidad ON destipos.codi_des = esta_especialidad.codi_esp
WHERE (((destipos.nomb_des) Like '%$q%') AND ((destipos.codt_des)='06'))
ORDER BY destipos.nomb_des";
$rsd = mysql_query($sql);
IF ($rsd)
{	
	WHILE($rs = mysql_fetch_array($rsd)) 
	{		
		$cname = trim($rs['nomb_des']);
		$ccod = trim($rs['codi_des']);
		$homo = trim($rs['codt_des']);
		$estaes = $rs['esta_esp'];
		if($estaes=='1401')$nive='REFERENCIA';
		else $nive='CITAS';
		ECHO "$cname|$ccod|$homo|$nive\n";
	}
	echo "NO EXISTE";
}
?>