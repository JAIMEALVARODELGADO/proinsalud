<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//echo "codigo $codi_cdc";
include('php/conexion.php');
$consulta="SELECT CODI_CDC FROM contrato WHERE CODI_CDC='$codi_cdc'";
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)<>0){
    ?>
    <script language="JavaScript">alert("El centro de costos YA fué utilizado, por lo tanto no puede eliminarse");</script>>
    <?
}
else{
    $sql_="DELETE FROM centros_costo WHERE codi_cdc='$codi_cdc'";
    mysql_query($sql_);
}
echo "<body onload='location.href=\"fac_muesccos.php\"'>";
mysql_free_result($consulta);
mysql_close();
?>
</body>
</html>

