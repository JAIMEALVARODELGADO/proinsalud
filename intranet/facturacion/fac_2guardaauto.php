<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<body>
<form name="form1" method="POST" action="fac_2detfactu.php" target='fr02'>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
include('php/conexion.php');
//include('php/funciones.php');

$sql_="UPDATE detalle_factura SET nauto_dfa='$nauto_dfa' WHERE iden_dfa='$iden_dfa'";
//echo $sql_;
mysql_query($sql_);
echo "<body onload='location.href=\"fac_2detfactu.php\"'>";
?>
</form>
</body>
</html>







