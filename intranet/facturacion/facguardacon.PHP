<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/conexion.php');
//$consulta=mysql_query("SELECT codi_con FROM contrato WHERE codi_con='$codi_con' or nit_con='$nit_con'");
$consulta=mysql_query("SELECT codi_con FROM contrato WHERE codi_con='$codi_con'");
if($vcod==1){
  $consulta=mysql_query("SELECT codi_con FROM contrato WHERE codi_con='$codi_con'");
  if(mysql_num_rows($consulta)<>0){
    $msgcod="EL CODIGO YA EXISTE";
  }
  $consulta=mysql_query("SELECT codi_con FROM contrato WHERE nit_con='$nit_con'");
  if(mysql_num_rows($consulta)<>0){
    $msgnit="EL NIT YA EXISTE";
  }
}
/*if($vcod==2){
  $consulta=mysql_query("SELECT codi_con FROM contrato WHERE nit_con='$nit_con'");
  if(mysql_num_rows($consulta)<>0){
    $msgnit="El NIT ya existe";
  }
}*/
echo "<body onload='location.href=\"fac_creacon.php?msgcod=$msgcod&codi_con=$codi_con&msgnit=$msgnit&nit_con=$nit_con\"'>";
/*if(mysql_num_rows($consulta)==0){
  mysql_query("INSERT INTO contrato (codi_con,nit_con,neps_con,ceps_con,dire_con,tele_con,repr_con,pers_con,chab_con,ctri_con,tpen_con,clas_con)
               VALUES ('$codi_con','$nit_con','$neps_con','$ceps_con','$dire_con','$tele_con','$repr_con','$pers_con','$chab_con','$ctri_con','$tpen_con','$clas_con')");
}*/
mysql_close();
?>

</body>
</html>