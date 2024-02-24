<?
session_start();

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
include('php/funciones.php');
include('php/conexion.php');
$fectra_rec=cambiafecha($fectra_rec);
$sql_="UPDATE ft_reclamacion SET resp_rec='$resp_rec',radant_rec='$radant_rec',tipeve_rec='$tipeve_rec',dire_rec='$dire_rec',muni_rec='$muni_rec',zona_rec='$zona_rec',fectra_rec='$fectra_rec',hortra_rec='$hortra_rec',totfol_rec='$totfol_rec'
WHERE iden_rec='$_SESSION[iden_rec]'";
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