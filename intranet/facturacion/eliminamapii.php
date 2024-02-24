<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//echo "codigo $cod_mapi";
include('php/conexion.php');
	mysql_query("DELETE FROM mapii WHERE codi_map='$cod_mapi'");
    echo "<body onload='location.href=\"busq_mapii.php\"'>";
mysql_close();
?>

</body>
</html>

