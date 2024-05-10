<?php
	include ('php/conexion1.php');
	$q = strtoupper($_GET["q"]);
	IF (!$q) RETURN;
	$sqlwes18 = "SELECT DISTINCT CONCAT(codi_des,' - ',nomb_des) AS nom_mezcla, codi_des FROM destipos WHERE CONCAT(codi_des,' ',nomb_des) LIKE '%$q%' AND codt_des='G1' ORDER BY nomb_des";
	$rsdwas18 = mysql_query($sqlwes18);
	IF ($rsdwas18)
	{
		WHILE($rswes18 = mysql_fetch_array($rsdwas18)) 
		{
			$codtras118 = $rswes18['codi_des'];
			$cnametra118 = $rswes18['nom_mezcla'];
			ECHO "$cnametra118|$codtras118\n";		
		}
		echo "NO EXISTE";
	}
?>