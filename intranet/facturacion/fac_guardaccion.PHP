<html>
<head>
<title>PROGRAMA DE FACTURACIN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/funciones.php');
include('php/conexion.php');
if($vcod==1){
  $consulta=mysql_query("SELECT nume_ctr FROM contratacion WHERE nume_ctr='$nume_ctr'");
  if(mysql_num_rows($consulta)<>0){
    $msgcod="EL NUMERO YA EXISTE";
  }
  echo "<body onload='location.href=\"fac_creaccion.php?msgcod=$msgcod&nume_ctr=$nume_ctr\"'>";
}
else{
  $fini_ctr=cambiafecha($fini_ctr);
  $ffin_ctr=cambiafecha($ffin_ctr);
  if(empty($rmon_ctr)){$rmon_ctr="N";}
  if(empty($rcop_ctr)){$rcop_ctr="N";}
  if(empty($rcuo_ctr)){$rcuo_ctr="N";}
  if(empty($rord_ctr)){$rord_ctr="N";}
  if(empty($rfdo_ctr)){$rfdo_ctr="N";}
  if(empty($rfca_ctr)){$rfca_ctr="N";}
  if(empty($rdgr_ctr)){$rdgr_ctr="N";}
  $consulta=mysql_query("SELECT nume_ctr FROM contratacion WHERE nume_ctr='$nume_ctr'");
  if(mysql_num_rows($consulta)==0){
      $sql="INSERT INTO contratacion (iden_ctr,nume_ctr,codi_con,fini_ctr,ffin_ctr,mont_ctr,rmon_ctr,rcop_ctr,rcuo_ctr,rord_ctr,rfdo_ctr,rfca_ctr,rdgr_ctr,moda_ctr,ccon_ctr,debi_ctr,pctg_ctr,tari_ctr,tpor_crt,obse_ctr,esta_ctr,fmpr_ctr,fmme_ctr,fmin_ctr,rcod_ctr)
               VALUES (0,'$nume_ctr','$codi_con','$fini_ctr','$ffin_ctr',$mont_ctr,'$rmon_ctr','$rcop_ctr','$rcuo_ctr','$rord_ctr','$rfdo_ctr','$rfca_ctr','$rdgr_ctr','$moda_ctr','$ccon_ctr','$debi_ctr','$pctg_ctr',$tari_ctr,'$tpor_crt','$obse_ctr','$esta_ctr','$fmpr_ctr','$fmme_ctr','$fmin_ctr','$rcod_ctr')";
      //echo $sql;
      mysql_query($sql);
      $iden_ctr=mysql_insert_id();			   
  }
}
mysql_close();
//echo "<body onload='location.href=\"fac_muesccion.php?codi_con=$codi_con\"'>";
echo "<body onload='location.href=\"fac_creaactxcon.php?iden_ctr=$iden_ctr\"'>";
?>
</body>
</html>