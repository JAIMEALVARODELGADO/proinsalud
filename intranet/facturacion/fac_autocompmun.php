<?php
session_start();
require('php/conexion.php');
$q = strtoupper($_GET["q"]);
if (!$q) RETURN;
$sql = "SELECT DISTINCT mun.codi_mun AS iden_,mun.nomb_mun AS desc_ FROM municipio AS mun
    WHERE mun.nomb_mun LIKE '%$q%' ORDER BY desc_";
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