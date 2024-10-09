<?php
session_start();
//Conexion con la base
include ('php/conexion.php');
$q = strtoupper($_GET["q"]);
if (!$q) RETURN;
	$sql = "SELECT DISTINCT cie.cod_cie10 AS codi_,cie.nom_cie10 AS nomb_ FROM cie_10 AS cie
	WHERE cie.nom_cie10 LIKE '%$q%' ORDER BY cie.nom_cie10";
        //echo $sql;
$rsd = mysql_query($sql);
if($rsd){
	while($rs = mysql_fetch_array($rsd)){
		$cid = $rs[$datos[0]];
		$cname = $rs[$datos[1]];
		echo "$cname|$cid\n";
	}
}
?>
<p><font color="#000000">no encontrado</font></p>