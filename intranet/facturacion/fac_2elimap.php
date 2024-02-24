<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
echo "codigo $iden_dfa";
include('php/conexion.php');
	mysql_query("DELETE FROM detalle_factura WHERE iden_dfa ='$iden_dfa'");
    echo "<body onload='location.href=\"fac_2detfactu.php\"'>";
mysql_close();
?>

</body>
</html>