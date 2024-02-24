<?
session_start();
session_register('$Gidusufac');
$_SESSION['iden_rec'];
if(empty($Gidusufac)){
  ?>
  <script language='javascript'>
  alert("La sesion ha finalizado, porfavor ingrese nuevamente a la aplicación");
  window.top.close();
  </script>
  <?
}
else{
?>
<html>
<head>
<title>PROGRAMA DE FACTURACION FORMATO FURTRAN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//include('php/funciones.php');
include('php/conexion.php');
$sql_="INSERT INTO ft_victima(iden_vic,iden_rec,tdoc_vic,ndoc_vic,pnom_vic,snom_vic,pape_vic,sape_vic)
VALUES (0,'$_SESSION[iden_rec]','$tdoc_vic','$ndoc_vic','$pnom_vic','$snom_vic','$pape_vic','$sape_vic')";
//echo "<br>".$sql_;
$sql_=mysql_query($sql_);
mysql_close();
echo "<body onload='location.href=\"fac_5creadetfurtran.php\"'>";
?>
</body>
</html>
<?php
}
?>