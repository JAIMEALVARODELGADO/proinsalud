<?php
include('php/conexion.php');
$sql_="UPDATE fr_detalle_rec SET codi_det='$codi_det' WHERE iden_det=$iden_det";
//echo $sql_;
mysql_query($sql_);
?>
<html>
<head>
<title>PROGRAMA DE FACTURACION FORMATO FURIPS</title>
</head>
<body onload="location.href='fac_5creadetfurips.php'">
</body>
</html>
