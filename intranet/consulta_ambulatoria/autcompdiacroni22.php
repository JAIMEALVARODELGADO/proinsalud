<?php
	include ('php/conexion1.php');
	$q = strtoupper($_GET["q"]);
	IF (!$q) RETURN;
	$sqlwes14 = "SELECT DISTINCT CONCAT(cod_cie10,' ',nom_cie10) AS virnom_cie10, cod_cie10 FROM cie_10 WHERE CONCAT(cod_cie10,' ',nom_cie10) LIKE '%$q%' ORDER BY nom_cie10";
	$rsdwas14 = mysql_query($sqlwes14);
	IF ($rsdwas14)
	{
		WHILE($rswes14 = mysql_fetch_array($rsdwas14)) 
		{
			$codtras10 = $rswes14['cod_cie10'];
			$cnametra10 = $rswes14['virnom_cie10'];
			ECHO "$cnametra10|$codtras10\n";		
		}
	}
?>