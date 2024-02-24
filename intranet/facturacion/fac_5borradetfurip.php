<?php
include('php/conexion.php');
$sql_="DELETE FROM fr_detalle_rec WHERE iden_det=$iden_det";
mysql_query($sql_);
?>
<html>
<head>
<title>PROGRAMA DE FACTURACION FORMATO FURIPS</title>
</head>
<body onload="location.href='fac_5creadetfurips.php'">
</body>
</html>
