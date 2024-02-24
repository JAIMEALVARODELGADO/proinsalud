<?php
session_register('codi_mapii');
session_register('codi_soat');
session_register('is1_mapi');
session_register('is4_mapi');

$codi_mapii=$cod_mapi;
$codi_soat=$soat_map;
$is1_mapi= $iss1_mapii;
$is4_mapi=$iss4_mapii;
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/conexion.php');
$existe=0;

$consulta1=mysql_query("SELECT codigo  FROM cups WHERE codigo='$cod_mapi'");
{
 if(mysql_num_rows($consulta1)==0){
	$existe=1;
	?>
       <script language="javaScript">
	   alert("El Código No Existe en el Tarifario CUPS");
	   </script>
	 <?}
}

$consulta2=mysql_query("SELECT codi_tar FROM soat WHERE codi_tar='$soat_map'");
{
 if(mysql_num_rows($consulta2)==0){
	$existe=1;
     ?>
       <script language="javaScript">
	   alert("El Código No Existe en el Tarifario SOAT");
	   </script>
	 <?}
}

$consulta3=mysql_query("SELECT codi_tar FROM iss1 WHERE codi_tar='$iss1_mapii'");
{
 if(mysql_num_rows($consulta3)==0){
	$existe=1;
     ?>
       <script language="javaScript">
	   alert("El Código No Existe en el Tarifario ISS - 2001");
	   </script>
	 <?}  
}
$consulta4=mysql_query("SELECT codi_tar FROM iss4 WHERE codi_tar='$iss4_mapii'");
{
 if(mysql_num_rows($consulta4)==0){
	$existe=1;
     ?>
       <script language="javaScript">
	   alert("El Código No Existe en el Tarifario ISS - 2004");
	   </script>
	 <?} 
}
$consulta5=mysql_query("SELECT codi_map FROM mapii WHERE codi_map ='$cod_mapi'");
  if(mysql_num_rows($consulta5)<>0){
	$existe=1;
     ?>
       <script language="javaScript">
	   alert("El Código CUPS ya se Registro");
	   </script>
	 <?} 
  if ($existe==0){
  mysql_query("INSERT INTO mapii(iden_map,codi_map,desc_map,nivl_map,cconcir_map,clas_map,soat_map,iss1_map,iss4_map,esta_map)
               VALUES (0,'$cod_mapi','$desc_mapii','$nivl_','$ccon_','$sclas_mapii','$soat_map','$iss1_mapii','$iss4_mapii','AC')");
  //session_unset();
  //echo "<body onload='location.href=\"busq_mapii.php?cod=$cod_mapi\"'>";
 }
 else{
 ?>
 <script language="javaScript">
	   //history.go(-1);
	   </script>
 <?}
 
mysql_close();
?>

</body>
</html>
