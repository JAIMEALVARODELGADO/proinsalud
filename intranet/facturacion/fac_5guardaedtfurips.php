<?
session_start();
//session_register('$Gidusufac');
//$_SESSION['iden_rec'];
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
$sql_="UPDATE fr_reclamacion SET resp_rec='$resp_rec',radant_rec='$radant_rec',cond_rec='$cond_rec',natu_rec='$natu_rec',desot_rec='$desot_rec',direoc_rec='$direoc_rec',fechoc_rec='$fechoc_rec',horaoc_rec='$horaoc_rec',munioc_rec='$munioc_rec',zonaoc_rec='$zonaoc_rec'
WHERE iden_rec='$_SESSION[iden_rec]'";
//echo "<br>".$sql_;
$sql_=mysql_query($sql_);

if($natu_rec=='01'){
    $finipol_veh=cambiafecha($finipol_veh);
    $ffinpol_veh=cambiafecha($ffinpol_veh);
    $sql_="UPDATE fr_vehiculo SET estase_veh='$estase_veh',marca_veh='$marca_veh',placa_veh='$placa_veh',tipo_veh='$tipo_veh',codi_con='$codi_con',poliza_veh='$poliza_veh',finipol_veh='$finipol_veh',ffinpol_veh='$ffinpol_veh',inter_veh='$inter_veh',exced_veh='$exced_veh',placaseg_veh='$placaseg_veh',tdocseg_veh='$tdocseg_veh',ndocseg_veh='$ndocseg_veh',placater_veh='$placater_veh',tdocter_veh='$tdocter_veh',ndocter_veh='$ndocter_veh'
    WHERE iden_rec='$_SESSION[iden_rec]'";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
}
if(!empty($tdoc_pro)){
    $sql_="UPDATE fr_propietario SET tdoc_pro='$tdoc_pro',ndoc_pro='$ndoc_pro',pape_pro='$pape_pro',sape_pro='$sape_pro',pnom_pro='$pnom_pro',snom_pro='$snom_pro',dire_pro='$dire_pro',tele_pro='$tele_pro',mres_pro='$mres_pro'
    WHERE iden_rec='$_SESSION[iden_rec]'";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
}
else{
    $sql_="DELETE FROM fr_propietario WHERE iden_rec='$_SESSION[iden_rec]'";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
}

if(!empty($tdoc_con)){
    $sql_="UPDATE fr_conductor SET pape_con='$pape_con',sape_con='$sape_con',pnom_con='$pnom_con',snom_con='$snom_con',tdoc_con='$tdoc_con',ndoc_con='$ndoc_con',dire_con='$dire_con',muni_con='$muni_con',tele_con='$tele_con'
    WHERE iden_rec='$_SESSION[iden_rec]'";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
}
else{
    $sql_="DELETE FROM fr_conductor WHERE iden_rec='$_SESSION[iden_rec]'";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
}

if(!empty($tipo_rem)){
    $fech_rem=cambiafecha($fech_rem);
    $fing_rem=cambiafecha($fing_rem);
    $sql_="UPDATE fr_remision SET tipo_rem='$tipo_rem',fech_rem='$fech_rem',hsal_rem='$hsal_rem',nomb_rem='$nomb_rem',cargo_rem='$cargo_rem',ipsrec_rem='$ipsrec_rem',direips_rem='$direips_rem',fing_rem='$fing_rem',hing_rem='$hing_rem',nomrec_rem='$nomrec_rem',carrec_rem='$carrec_rem',munrec_rem='$munrec_rem'
    WHERE iden_rec='$_SESSION[iden_rec]'";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
}
else{
    $sql_="DELETE FROM fr_remision WHERE iden_rec='$_SESSION[iden_rec]'";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
}
if(!empty($tipser_tra)){
    $sql_="UPDATE fr_transporte SET tdoc_tra='$tdoc_tra',ndoc_tra='$ndoc_tra',pape_tra='$pape_tra',sape_tra='$sape_tra',pnom_tra='$pnom_tra',snom_tra='$snom_tra',placa_tra='$placa_tra',recini_tra='$recini_tra',recfin_tra='$recfin_tra',tipser_tra='$tipser_tra',zona_tra='$zona_tra'
    WHERE iden_rec='$_SESSION[iden_rec]'";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
}
else{
    $sql_="DELETE FROM fr_transporte WHERE iden_rec='$_SESSION[iden_rec]'";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
}
$fecing_ate=cambiafecha($fecing_ate);
$fecsal_ate=cambiafecha($fecsal_ate);
$sql_="UPDATE fr_atencion SET fecing_ate='$fecing_ate',horing_ate='$horing_ate',fecsal_ate='$fecsal_ate',horsa_ate='$horsa_ate',diapri_ate='$diapri_ate',diaas1_ate='$diaas1_ate',diaas2_ate='$diaas2_ate',dxprieg_ate='$dxprieg_ate',dxaseg1_ate='$dxaseg1_ate',dxaseg2_ate='$dxaseg2_ate',cod_medi='$cod_medi',foli_ate='$foli_ate'
WHERE iden_rec='$_SESSION[iden_rec]'";
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