<?php
	include ('php/conexion1.php');
	$q = strtoupper($_GET["q"]);
	IF (!$q) RETURN;
	$sqlwes14 = "SELECT DISTINCT CONCAT(codi_des,' - ',nomb_des) AS nom_mezcla, codi_des FROM destipos WHERE CONCAT(codi_des,' ',nomb_des) LIKE '%$q%' AND codt_des='G0' ORDER BY nomb_des";
	$rsdwas14 = mysql_query($sqlwes14);
	IF ($rsdwas14)
	{
		WHILE($rswes14 = mysql_fetch_array($rsdwas14)) 
		{
			$codtras110 = $rswes14['codi_des'];
			$cnametra110 = $rswes14['nom_mezcla'];
			ECHO "$cnametra110|$codtras110\n";		
		}
		echo "NO EXISTE";
	}
?>