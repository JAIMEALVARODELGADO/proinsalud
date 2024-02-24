<?php
session_start();
define("base_de_datos", "consultorio_es");
require('inc/conections.Inc');

//$q = strtolower($_GET["q"]);
$q = strtoupper($_GET["q"]);

IF (!$q) RETURN;

$xcon=conectar_bd();

$sql = "SELECT DISTINCT $datos[0] AS $datos[0], $datos[1] FROM $datos[2] WHERE $datos[0] LIKE '%$q%'";
$rsd = mysql_query($sql);
IF ($rsd){
	WHILE($rs = mysql_fetch_array($rsd)) {
		$cid = $rs[$datos[1]];
		$cname = $rs[$datos[0]];
		ECHO "$cname|$cid\n";
	}
}
?>
<p><font color="#000000">no encontrado</font></p>