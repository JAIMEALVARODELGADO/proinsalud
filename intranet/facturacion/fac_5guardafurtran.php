<?
session_start();
session_register('$Gidusufac');
$_SESSION['iden_rec'];
//echo $Gidusufac;
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
$codips_rec='520010066901';
$sql_="INSERT INTO ft_reclamacion(iden_rec,resp_rec,radant_rec,tipeve_rec,dire_rec,muni_rec,zona_rec,fectra_rec,hortra_rec,codips_rec,totfol_rec,usua_rec)
VALUES (0,'$resp_rec','$radant_rec','$tipeve_rec','$dire_rec','$muni_rec','$zona_rec','$fectra_rec','$hortra_rec','$codips_rec','$totfol_rec','$Gidusufac')";
//echo "<br>".$sql_;
$sql_=mysql_query($sql_);
$iden_rec=mysql_insert_id();
$_SESSION['iden_rec']=$iden_rec;
mysql_close();
echo "<body onload='location.href=\"fac_5creadetfurtran.php\"'>";
?>
</body>
</html>
<?php
}
?>