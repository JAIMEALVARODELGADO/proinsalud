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
<title>PROGRAMA DE FACTURACION FORMATO FURIPS</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/funciones.php');
include('php/conexion.php');
$fechoc_rec=cambiafecha($fechoc_rec);
$desot_rec=substr($desot_rec,0,250);
$sql_="INSERT INTO fr_reclamacion(iden_rec,resp_rec,radant_rec,iden_fac,codi_usu,cond_rec,natu_rec,desot_rec,direoc_rec,fechoc_rec,horaoc_rec,munioc_rec,zonaoc_rec,usua_rec)
VALUES (0,'$resp_rec','$radant_rec','$iden_fac','$codi_usu','$cond_rec','$natu_rec','$desot_rec','$direoc_rec','$fechoc_rec','$horaoc_rec','$munioc_rec','$zonaoc_rec','$Gidusufac')";
//echo "<br>".$sql_;
$sql_=mysql_query($sql_);
$iden_rec=mysql_insert_id();
$_SESSION['iden_rec']=$iden_rec;
if($natu_rec=='01'){
    $finipol_veh=cambiafecha($finipol_veh);
    $ffinpol_veh=cambiafecha($ffinpol_veh);
    $sql_="INSERT INTO fr_vehiculo(iden_veh,iden_rec,estase_veh,marca_veh,placa_veh,tipo_veh,codi_con,poliza_veh,finipol_veh,ffinpol_veh,inter_veh,exced_veh,placaseg_veh,tdocseg_veh,ndocseg_veh,placater_veh,tdocter_veh,ndocter_veh)
    VALUES(0,'$iden_rec','$estase_veh','$marca_veh','$placa_veh','$tipo_veh','$codi_con','$poliza_veh','$finipol_veh','$ffinpol_veh','$inter_veh','$exced_veh','$placaseg_veh','$tdocseg_veh','$ndocseg_veh','$placater_veh','$tdocter_veh','$ndocter_veh')";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
}
if(!empty($tdoc_pro)){
    $sql_="INSERT INTO fr_propietario(iden_pro,iden_rec,tdoc_pro,ndoc_pro,pape_pro,sape_pro,pnom_pro,snom_pro,dire_pro,tele_pro,mres_pro)
    VALUES(0,'$iden_rec','$tdoc_pro','$ndoc_pro','$pape_pro','$sape_pro','$pnom_pro','$snom_pro','$dire_pro','$tele_pro','$mres_pro')";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
}

if(!empty($tdoc_con)){
    $sql_="INSERT INTO fr_conductor(iden_con,iden_rec,pape_con,sape_con,pnom_con,snom_con,tdoc_con,ndoc_con,dire_con,muni_con,tele_con)
    VALUES(0,'$iden_rec','$pape_con','$sape_con','$pnom_con','$snom_con','$tdoc_con','$ndoc_con','$dire_con','$muni_con','$tele_con')";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
}

if(!empty($tipo_rem)){
    $fech_rem=cambiafecha($fech_rem);
    $fing_rem=cambiafecha($fing_rem);
    $sql_="INSERT INTO fr_remision(iden_rem,iden_rec,tipo_rem,fech_rem,hsal_rem,nomb_rem,cargo_rem,ipsrec_rem,direips_rem,fing_rem,hing_rem,nomrec_rem,carrec_rem,munrec_rem)
    VALUES(0,'$iden_rec','$tipo_rem','$fech_rem','$hsal_rem','$nomb_rem','$cargo_rem','$ipsrec_rem','$direips_rem','$fing_rem','$hing_rem','$nomrec_rem','$carrec_rem','$munrec_rem')";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
}

if(!empty($tipser_tra)){
    $sql_="INSERT INTO fr_transporte(iden_tra,iden_rec,tdoc_tra,ndoc_tra,pape_tra,sape_tra,pnom_tra,snom_tra,placa_tra,recini_tra,recfin_tra,tipser_tra,zona_tra)
    VALUES(0,'$iden_rec','$tdoc_tra','$ndoc_tra','$pape_tra','$sape_tra','$pnom_tra','$snom_tra','$placa_tra','$recini_tra','$recfin_tra','$tipser_tra','$zona_tra')";
    echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
}
$fecing_ate=cambiafecha($fecing_ate);
$fecsal_ate=cambiafecha($fecsal_ate);
$sql_="INSERT INTO fr_atencion(iden_ate,iden_rec,fecing_ate,horing_ate,fecsal_ate,horsa_ate,diapri_ate,diaas1_ate,diaas2_ate,dxprieg_ate,dxaseg1_ate,dxaseg2_ate,cod_medi,totfac_ate,totrec_ate,totftra_ate,totrtra_ate,foli_ate)
VALUES(0,'$iden_rec','$fecing_ate','$horing_ate','$fecsal_ate','$horsa_ate','$diapri_ate','$diaas1_ate','$diaas2_ate','$dxprieg_ate','$dxaseg1_ate','$dxaseg2_ate','$cod_medi','$totfac_ate','$totrec_ate','$totftra_ate','$totrtra_ate','$foli_ate')";
//echo "<br>".$sql_;
$sql_=mysql_query($sql_);

mysql_close();
echo "<body onload='location.href=\"fac_5creadetfurips.php\"'>";
?>

</body>
</html>
<?php
}
?>