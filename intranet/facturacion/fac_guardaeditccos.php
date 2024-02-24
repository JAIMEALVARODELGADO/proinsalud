<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/conexion.php');
$sql_="UPDATE centros_costo SET nomb_cdc='$nomb_cdc' WHERE codi_cdc='$codi_cdc'";
$sql_=mysql_query($sql_);
echo "<body onload='location.href=\"fac_muesccos.php?cod=$codi_cdc\"'>";
mysql_close();
?>
</body>
</html>







