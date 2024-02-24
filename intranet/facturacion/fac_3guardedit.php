<?
session_start();
session_register('iden_fac');
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<body>
<form name="form1" method="POST" action="fac_2factupre.php" target='fr02'>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/conexion.php');
include('php/funciones.php');
$iden_fac=$idefac;
$feci_fac=cambiafecha($feci_fac);
$fecf_fac=cambiafecha($fecf_fac);
//echo "<br>$idefac";
//echo "<br>$tipo_fac";
//echo "<br>$rela_fac";
mysql_query("UPDATE encabezado_factura SET tipo_fac= '$tipo_fac',rela_fac= '$rela_fac',feci_fac='$feci_fac',fecf_fac='$fecf_fac',nauto_fac='$nauto_fac' WHERE iden_fac='$idefac'");

//mysql_query("UPDATE detalle_factara SET nauto_dfa='$nauto_fac' WHERE iden_fac='$idefac'");
//$iden_fac=mysql_insert_id();
echo "<br>Afectadas: ".mysql_affected_rows();
echo "<body onload='location.href=\"fac_2detfactu.php\"'>";
?>
</form>
</body>
</html>







