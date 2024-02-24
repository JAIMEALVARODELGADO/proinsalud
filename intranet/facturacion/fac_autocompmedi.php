<?php
session_start();
require('php/conexion.php');
$q = strtoupper($_GET["q"]);
if (!$q) RETURN;
$sql = "SELECT DISTINCT med.cod_medi AS iden_,med.nom_medi AS desc_ FROM medicos AS med
    WHERE med.nom_medi LIKE '%$q%' AND med.esta_medi='A' ORDER BY desc_";
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