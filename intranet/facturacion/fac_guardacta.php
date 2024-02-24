<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/conexion.php');
$consulta="SELECT codi_cxs FROM cuentaxservicio WHERE codi_cxs='$codi_cxs'";
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)==0){
    $sql_="INSERT INTO cuentaxservicio(codi_cxs,ctamed_cxs,ctains_cxs) VALUES('$codi_cxs','$ctamed','$ctains')";
}
else{
    $sql_="UPDATE cuentaxservicio SET ctamed_cxs='$ctamed',ctains_cxs='$ctains' WHERE codi_cxs='$codi_cxs'";
}
$sql_=mysql_query($sql_);
echo "<body onload='location.href=\"fac_muescuentas.php\"'>";
?>
</body>
</html>