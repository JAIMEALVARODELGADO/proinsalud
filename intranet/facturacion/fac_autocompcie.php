<?php
session_start();
require('php/conexion.php');
$q = strtoupper($_GET["q"]);
if (!$q) RETURN;
$sql = "SELECT DISTINCT cie.cod_cie10 AS iden_,cie.nom_cie10 AS desc_ FROM cie_10 AS cie		
    WHERE cie.nom_cie10 LIKE '%$q%' ORDER BY desc_";
//echo "<br>".$sql."<br>";
$rsd = mysql_query($sql);
if($rsd){
	while($rs = mysql_fetch_array($rsd)) {
		$cid = $rs[$datos[1]];		
		$cname = $rs[$datos[0]];
		echo "$cname|$cid|$cid1\n";
	}
}
?>
<p><font color="#000000">no encontrado</font></p>