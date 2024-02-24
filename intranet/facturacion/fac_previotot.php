<?php
require('fpdf.php');
include('php/funciones.php');
include('php/conexion.php');
include('php/conexiones_g.php');
include('funciones_impre.php');
set_time_limit(0);

$pdf=new FPDF('P','mm','Letter');
$pdf->SetFont('Arial','',7);
$fila=0;
$col=20;
$pag_=1;
 
$conenca=mysql_query("SELECT codi_emp, nume_fac, nite_emp,razo_emp, dire_emp, tele_emp, enca_emp, pie_emp 
                      FROM empresa WHERE nite_emp='800176807-4'");
$rowenca=mysql_fetch_array($conenca);
$razo_emp=$rowenca[razo_emp];
$nite_emp=$rowenca[nite_emp];
$dire_emp=$rowenca[dire_emp];
$tele_emp=$rowenca[tele_emp];
$enca_emp=$rowenca[enca_emp];

//$num_fac='';

$condicion="fa.esta_fac<>'3' AND ";
if($abierta=='on'){
    $condicion=$condicion."fa.esta_fac='1' AND ";
}
if($cerrada=='on'){
    $condicion=$condicion."fa.esta_fac='2' AND ";
}
if($abierta=='on' and $cerrada=='on'){
    $condicion="(fa.esta_fac='1' OR fa.esta_fac='2') AND ";    
}
if(!empty($fac1)){
  $condicion=$condicion."fa.nume_fac>='$fac1' AND ";}
if(!empty($fac2)){
  $condicion=$condicion."fa.nume_fac<='$fac2' AND ";}  
if(!empty($fec1)){
  //$fec1=cambiafecha($fec1);
  $condicion=$condicion."fa.fcie_fac>='$fec1' AND ";}
if(!empty($fecini1)){
  //$fecini1=cambiafecha($fecini1);
  $condicion=$condicion."fa.feci_fac>='$fecini1' AND ";}  
if(!empty($fecini2)){
  //$fecini2=cambiafecha($fecini2);
  $condicion=$condicion."fa.feci_fac<='$fecini2' AND ";}
if(!empty($fecfin1)){
  //$fecfin1=cambiafecha($fecfin1);
  $condicion=$condicion."fa.fecf_fac>='$fecfin1' AND ";}
if(!empty($fecfin2)){
  //$fecfin2=cambiafecha($fecfin2);
  $condicion=$condicion."fa.fecf_fac<='$fecfin2' AND ";}
  
if(!empty($fec2)){
  //$fec2=cambiafecha($fec2);
  $condicion=$condicion."fa.fcie_fac<='$fec2' AND ";}  
if(!empty($identifica)){
  $condicion=$condicion."us.nrod_usu='$identifica' AND ";}
if(!empty($contrato)){
  $condicion=$condicion."con.codi_con='$contrato' AND ";}  
//echo "<br>".$anulada;
if($anulada=='on'){
  $condicion=$condicion."fa.anul_fac='S' AND ";}
if(!empty($entidad)){
  $condicion=$condicion."fa.enti_fac='$entidad' AND ";}
if(!empty($servic)){
  $condicion=$condicion."fa.area_fac='$servic' AND ";}
if(!empty($relac)){
  $condicion=$condicion."fa.rela_fac='$relac' AND ";}
if(!empty($nrocontr)){
  $condicion=$condicion."fa.iden_ctr='$nrocontr' AND ";}  
if(!empty($condicion)){
  $condicion=substr($condicion,0,(strlen($condicion)-5));
}
//echo $condicion;
$consultafac="SELECT fa.iden_fac
 FROM encabezado_factura AS fa 
 INNER JOIN usuario AS us ON us.codi_usu=fa.codi_usu
 INNER JOIN contratacion AS ctr ON ctr.iden_ctr=fa.iden_ctr
 INNER JOIN contrato AS con ON con.codi_con=ctr.codi_con  
 WHERE $condicion";    
//echo $consultafac;
$impretot_="S";
$consultafac=mysql_query($consultafac);
while ($rowfac=mysql_fetch_array($consultafac)){    
    imprefac($rowfac[iden_fac],$pdf);
}

$pdf->Output();
mysql_close();

