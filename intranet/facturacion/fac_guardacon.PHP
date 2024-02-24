<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/conexion.php');
$consulta="SELECT MAX(codi_con) AS codi_con FROM contrato";
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);
$codi_con=$row[codi_con];
$codi_con=STR_PAD($codi_con+1,3,"0",STR_PAD_LEFT);
//echo $codi_con;
//$consulta=mysql_query("SELECT codi_con FROM contrato WHERE codi_con='$codi_con' or nit_con='$nit_con'");
//$consulta=mysql_query("SELECT codi_con FROM contrato WHERE codi_con='$codi_con'");

if($vcod==1){
  $consulta=mysql_query("SELECT codi_con FROM contrato WHERE codi_con='$codi_con'");
  if(mysql_num_rows($consulta)<>0){
    $msgcod="EL CODIGO YA EXISTE";
  }
  $consulta=mysql_query("SELECT codi_con FROM contrato WHERE nit_con='$nit_con'");
  if(mysql_num_rows($consulta)<>0){
    $msgnit="EL NIT YA EXISTE";
  }
  echo "<body onload='location.href=\"fac_creacon.php?msgcod=$msgcod&codi_con=$codi_con&msgnit=$msgnit&nit_con=$nit_con\"'>";
}
else{
  $consulta=mysql_query("SELECT codi_con FROM contrato WHERE codi_con='$codi_con' or nit_con='$nit_con'");
  if(mysql_num_rows($consulta)==0){
    $sql="INSERT INTO contrato (codi_con,nit_con,neps_con,nomr_con,ceps_con,dire_con,tele_con,repr_con,pers_con,chab_con,ctri_con,tpen_con,clas_con,nref_con,cuen_con,esta_con,codi_cdc,vige_con,codase_con)
               VALUES ('$codi_con','$nit_con','$neps_con','$nomr_con','$ceps_con','$dire_con','$tele_con','$repr_con','$pers_con','$chab_con','$ctri_con','$tpen_con','$clas_con','','$cuen_con','$esta_con','$codi_cdc','$vige_con','$codase_con')";
    //echo "<br>".$sql;
    mysql_query($sql);
    //echo "<br>".mysql_affected_rows();
  }
}
mysql_close();
echo "<body onload='location.href=\"fac_muestracon.php?nit=$nit_con\"'>";
?>

</body>
</html>