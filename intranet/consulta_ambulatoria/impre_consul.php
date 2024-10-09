<?php
require('../Libreria/pdf/fpdf.php');

$pdf=new FPDF('P','mm','Letter');
$histo1='on';
if ($histo1=='on'){
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$fila=72;
$col=20;

$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');

include ('php/conexion1.php');


$resultado_sql41="SELECT numc_ehi,  nomb_ehi,  muat_ehi,  telf_ehi,  sexo_ehi,  fnac_ehi,  dire_ehi, cont_ehi,  idus_ehi,  cous_ehi,  feco_ehi   FROM encabesadohistoria where numc_ehi='$serie' ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41))
{ 
	$nombre=$rowp41["nomb_ehi"];
	$sexo=$rowp41["sexo_ehi"];
	$telefono=$rowp41["telf_ehi"];
	$direccion=$rowp41["dire_ehi"];
	$contrato=$rowp41["cont_ehi"];
	$id=$rowp41["idus_ehi"];
	$edad=$rowp41["fnac_ehi"];
	$cod_unico=$rowp41["cous_ehi"];

}

$resultado_sql41="SELECT encabesadohistoria.cont_ehi, contrato.NEPS_CON, encabesadohistoria.numc_ehi FROM encabesadohistoria INNER JOIN contrato ON encabesadohistoria.cont_ehi = contrato.CODI_CON WHERE (((encabesadohistoria.numc_ehi)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 

$contrato1=$rowp41["NEPS_CON"];
}





$nu=date("Y-m-d"); 
$ho=strftime("%I:%M:%S");	

$pdf->SetXY(5,15);
$pdf->Cell(40,5,"Nombre:",0);

$pdf->SetXY(18,15);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetXY(80,15);
$pdf->Cell(40,5,"Sexo:",0);

$pdf->SetXY(88,15);
$pdf->Cell(40,5,$sexo,0);

$pdf->SetXY(92,15);
$pdf->Cell(40,5,"Contrato:",0);

$pdf->SetXY(105,15);
$pdf->Cell(40,5,$contrato,0);

$pdf->SetXY(112,15);
$pdf->Cell(40,5,"Identificacion:",0);

$pdf->SetXY(130,15);
$pdf->Cell(40,5,$id,0);

$pdf->SetXY(150,15);
$pdf->Cell(40,5,"Edad:",0);

$pdf->SetXY(158,15);
$pdf->Cell(40,5,$edad,0);

$pdf->SetXY(180,15);
$pdf->Cell(40,5,$serie,0);



$pdf->SetXY(5,20);
$pdf->Cell(40,5,"Direccion:",0);
$pdf->SetFont('Arial','',6);
$pdf->SetXY(18,20);
$pdf->Cell(40,5,$direccion,0);
$pdf->SetFont('Arial','',6);
$pdf->SetXY(65,20);
$pdf->Cell(40,5,"Telefono:",0);

$pdf->SetXY(79,20);
$pdf->Cell(40,5,$telefono,0);


       
            
$resultado_sql41="SELECT numc_cpl, feca_cpl, hora_cpl, area_cpl, enac_cpl, motc_cpl, catr_cpl, hosa_cpl, come_cpl, coti_cpl, caex_cpl, tidx_cpl,fina_cpl, resi_cpl, radx_cpl, sire_cpl, tidx_cpl,codi_cpl, coan_cpl, hoci_cpl, cod1_cpl, sipi_cpl FROM consultaprincipal  where numc_cpl='$serie' ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$hosa=$rowp41["hosa_cpl"];
$hor=$rowp41["hora_cpl"];
$fechaco=$rowp41["feca_cpl"];
$enac=$rowp41["enac_cpl"];
$moco=$rowp41["motc_cpl"];
$causatrabajo=$rowp41["catr_cpl"];
$codmedico=$rowp41["come_cpl"];
$rsistema=$rowp41["resi_cpl"];
$rayudasdx=$rowp41["radx_cpl"];
$sinrespi=$rowp41["sire_cpl"];
$sinpiel=$rowp41["sire_cpl"];
$dxprin=$rowp41["cod1_cpl"];
$tidx_cpl=$rowp41["tidx_cpl"];
$contingencia=$rowp41["coti_cpl"];
$area1=$rowp41["area_cpl"];

}

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}


$resultado_sql41="SELECT cod_areas, nom_areas,  perm_are  FROM areas where cod_areas='$area1' ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$nomare=$rowp41["nom_areas"];
}

$pdf->SetXY(95,20);
$pdf->Cell(40,5,"Fecha Consulta:",0);

$pdf->SetXY(118,20);
$pdf->Cell(40,5,$fechaco,0);

$pdf->SetXY(135,20);
$pdf->Cell(40,5,"Hora Entrada:",0);

$pdf->SetXY(154,20);
$pdf->Cell(40,5,$hor,0);

$pdf->SetXY(168,20);
$pdf->Cell(40,5,"Hora Salida:",0);

$pdf->SetXY(184,20);
$pdf->Cell(40,5,$hosa,0);


$resultado_sql41="SELECT numc_aco,  noma_aco,  dire_aco,  tele_aco FROM acompanante  where numc_aco='$serie' ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$nomaco=$rowp41["noma_aco"];
$diraco=$rowp41["dire_aco"];
$telaco=$rowp41["tele_aco"];
}

$pdf->SetXY(5,25);
$pdf->Cell(40,5,"Acudiente:",0);

$pdf->SetXY(19,25);
$pdf->Cell(40,5,$nomaco,0);

$pdf->SetXY(60,25);
$pdf->Cell(40,5,"Direccion:",0);

$pdf->SetXY(73,25);
$pdf->Cell(40,5,$diraco,0);




$pdf->SetXY(120,25);
$pdf->Cell(40,5,"Telefono:",0);

$pdf->SetXY(135,25);
$pdf->Cell(40,5,$telaco,0);




$b="";
$tamaño=strlen($moco);
$fin=140;
$line=$tamaño/$fin;
$cont=0;

$pdf->SetXY(5,30);
$pdf->Cell(40,5,"Area:",0);

$pdf->SetXY(15,30);
$pdf->Cell(40,5,$area1,0);

$pdf->SetXY(20,30);
$pdf->Cell(40,5,$nomare,0);



$pdf->SetXY(5,35);
$pdf->Cell(40,5,"Motivo de la consulta:",0);

$col=5;
$fil=35;
if ($tamaño>140){
while($tamaño>$cont){ 
$b[]=substr($moco,$cont,$fin);
$fin1=$fin1+140;
$cont=$fin1;
}

foreach($b as $d) { 
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($d),0);

}

}
else{
$col=5;
$fil=40;
$d=$moco;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($d),0);
}

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Enfermedad Actual:',0);
$c="";
$tamaño1=strlen($enac);
$fin1=200;
$line1=$tamaño1/$fin1;
$cont1=0;
if ($tamaño1>140){

while($tamaño1>$cont1){ 
$c[]=substr($enac,$cont1,$fin1);
$fin2=$fin2+140;
$cont1=$fin2;
}


foreach($c as $f) { 
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($f),0);

}

}

else{
$d=$enac;
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($d),0);
}
$trau="Lo Referido";
$medi="Lo Referido";
$des="Lo ya referido anteriormente";
$resultado_sql41="SELECT antepatologicos.idus_apa, antepatologicos.codi_apa, antepatologicos.codp_apa, antepatologicos.feca_apa, antepatologicos.numc_apa, antepatologicos.obse_apa, cie_10.nom_cie10 FROM antepatologicos INNER JOIN cie_10 ON antepatologicos.codp_apa = cie_10.cod_cie10 WHERE (((antepatologicos.numc_apa)='$serie')) ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$nomc=$rowp41["nom_cie10"];
$codip=$rowp41["codi_apa"];
$Obser=$rowp41["obse_apa"];
$feac=$rowp41["feca_apa"];

if ($codip=="0801"){
$medi="S";
}

if ($codip=="0803"){
$trau="S";
}
$des=$des.";"." ".$nomc;

}

$qui="Lo Referido";
$resultado_sql41="SELECT antepatologicos.idus_apa, antepatologicos.codi_apa, antepatologicos.codp_apa, antepatologicos.feca_apa, antepatologicos.numc_apa, antepatologicos.obse_apa, mapipos.nomb_map FROM antepatologicos INNER JOIN mapipos ON antepatologicos.codp_apa = mapipos.codi_map WHERE (((antepatologicos.numc_apa)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$nomc=$rowp41["nomb_map"];
$codip=$rowp41["codi_apa"];
$Obser=$rowp41["obse_apa"];
$feac=$rowp41["feca_apa"];

if ($codip=="0802"){
$qui="S";
}
$des=$des.";"." ".$nomc;

}
$ocu="Lo Referido";
$tox="Lo Referido";
$fam="Lo Referido";
$resultado_sql41="SELECT antefamiliares.idus_afa, antefamiliares.codi_afa, antefamiliares.desc_afa, antefamiliares.feca_afa, antefamiliares.numc_afa FROM antefamiliares where numc_afa='$serie' ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 

$codip=$rowp41["codi_afa"];
$Obser=$rowp41["desc_afa"];
$feac=$rowp41["feca_afa"];


if ($codip=="0701"){
$ocu="S";
}

if ($codip=="0702"){
$tox="S";
}

if ($codip=="0703"){
$fam="S";
}

$des=$des.";"." ".$Obser;
}

if ($sexo=="m" or $sexo=="M"){
$gi="No Aplica";
}
else{
$gi="Lo Referido";


$resultado_sql41="SELECT antefemeninos.numc_afe, antefemeninos.fech_afe, antefemeninos.idus_afe, antefemeninos.feum_afe, antefemeninos.gest_afe, antefemeninos.part_afe, antefemeninos.cesa_afe, antefemeninos.abor_afe, antefemeninos.vivo_afe, antefemeninos.mort_afe, antefemeninos.otro_afe FROM antefemeninos WHERE (((antefemeninos.numc_afe)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 


$Obser=$rowp41["otro_afe"];
$feac=$rowp41["fech_afe"];
$g=$rowp41["gest_afe"];
$p=$rowp41["part_afe"];
$ce=$rowp41["cesa_afe"];
$a=$rowp41["abor_afe"];
$v=$rowp41["vivo_afe"];
$m=$rowp41["mort_afe"];
$fu=$rowp41["feum_afe"];
if ($Obser<>""){
$gi="S";
}

$des=$des.";"." ".$Obser;
}

}
$ultimo=0;
$resultado_sql41="SELECT antepatologicos.idus_apa, antepatologicos.feca_apa FROM antepatologicos WHERE (((antepatologicos.idus_apa)='$cod_unico'))ORDER BY antepatologicos.feca_apa DESC;";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
if ($ultimo<1){
$feac1=$rowp41["feca_apa"];
}
$ultimo=$ultimo+1;
}



$ultimo1=0;
$resultado_sql41="SELECT idus_afa, feca_afa FROM antefamiliares WHERE antefamiliares.idus_afa = '$cod_unico' ORDER  BY feca_afa DESC ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
if ($ultimo1<1){
$feac2=$rowp41["feca_afa"];
}
$ultimo1=$ultimo1+1;
}

if ($feac1>=$feac2){

$feac=$feac1;
}
else{
$feac=$feac2;

}

 $fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'ANTECEDENTES:',0);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Medicos:',0);
$pdf->SetXY($col+40,$fil);
$pdf->Cell(40,5,$medi,0);

$pdf->SetXY($col+65,$fil);
$pdf->Cell(40,5,'Ocupacionales:',0);
$pdf->SetXY($col+65+35,$fil);
$pdf->Cell(40,5,$ocu,0);


$pdf->SetXY($col+65+65,$fil);
$pdf->Cell(40,5,'Traumaticos:',0);
$pdf->SetXY($col+65+65+25,$fil);
$pdf->Cell(40,5,$trau,0);




$pdf->SetXY($col+65+65+45,$fil);
$pdf->Cell(40,5,'Fecha Actualizacion:',0);
$pdf->SetXY($col+65+65+45,$fil+5);
$pdf->Cell(40,5,$feac,0);



$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Quirurgicos:',0);
$pdf->SetXY($col+40,$fil);
$pdf->Cell(40,5,$qui,0);

$pdf->SetXY($col+65,$fil);
$pdf->Cell(40,5,'Toxico-Alergicos:',0);
$pdf->SetXY($col+65+35,$fil);
$pdf->Cell(40,5,$tox,0);

$pdf->SetXY($col+65+65,$fil);
$pdf->Cell(40,5,'Familiares:',0);
$pdf->SetXY($col+65+65+25,$fil);
$pdf->Cell(40,5,$fam,0);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Gineco-Obstetricos:',0);
$pdf->SetXY($col+40,$fil);
$pdf->Cell(40,5,$gi,0);

$pdf->SetXY($col+65,$fil);
$pdf->Cell(40,5,'F.U.M:',0);
$pdf->SetXY($col+65+11,$fil);
$pdf->Cell(40,5,$fu,0);

$pdf->SetXY($col+65+30,$fil);
$pdf->Cell(40,5,'G:',0);
$pdf->SetXY($col+65+30+5,$fil);
$pdf->Cell(40,5,$g,0);

$pdf->SetXY($col+65+30+10,$fil);
$pdf->Cell(40,5,'P:',0);
$pdf->SetXY($col+65+30+10+5,$fil);
$pdf->Cell(40,5,$p,0);


$pdf->SetXY($col+65+30+10+10,$fil);
$pdf->Cell(40,5,'C:',0);
$pdf->SetXY($col+65+30+10+10+5,$fil);
$pdf->Cell(40,5,$ce,0);

$pdf->SetXY($col+65+30+10+10+10,$fil);
$pdf->Cell(40,5,'A:',0);
$pdf->SetXY($col+65+30+10+10+10+5,$fil);
$pdf->Cell(40,5,$a,0);

$pdf->SetXY($col+65+30+10+10+10+10,$fil);
$pdf->Cell(40,5,'V:',0);
$pdf->SetXY($col+65+30+10+10+10+10+5,$fil);
$pdf->Cell(40,5,$v,0);



$pdf->SetXY($col+65+30+10+10+10+10+10,$fil);
$pdf->Cell(40,5,'M:',0);
$pdf->SetXY($col+65+30+10+10+10+10+10+5,$fil);
$pdf->Cell(40,5,$m,0);


$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Descripcion:',0);

///
$pdf->SetFont('Arial','',5);

$g="";
$tamaño2=strlen($des);
$fin2=200;
$line2=$tamaño1/$fin1;
$cont2=0;
if ($tamaño2>200){
while($tamaño2>$cont2){ 
$g[]=substr($des,$cont2,$fin2);
$fin3=$fin3+200;
$cont2=$fin3;
}


foreach($g as $fe) { 
$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($fe),0);

}

}

else{
$d=$enac;
$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($des),0);
}

////

$pdf->SetFont('Arial','',8);


$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Revision por Sistemas:',0);


$rs="";
$tamaño3=strlen($rsistema);
$fin3=140;
$line3=$tamaño3/$fin3;
$cont3=0;
if ($tamaño3>140){
while($tamaño3>$cont3){ 
$rs[]=substr($rsistema,$cont3,$fin3);
$fin4=$fin4+140;
$cont3=$fin4;
}


foreach($rs as $rev) { 
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($rev),0);

}

}

else{
$d=$enac;
$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($rsistema),0);
}
//

$resultado_sql41="SELECT examenfisico.numc_efi, examenfisico.tear_efi, examenfisico.fres_efi, examenfisico.fcar_efi, examenfisico.temp_efi, examenfisico.peso_efi, examenfisico.tall_efi, examenfisico.pcfa_efi, examenfisico.otrh_efi, examenfisico.tea2_efi FROM examenfisico WHERE (((examenfisico.numc_efi)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 

$ta1=$rowp41["tear_efi"];
$fr=$rowp41["fres_efi"];
$fc=$rowp41["fcar_efi"];
$t=$rowp41["temp_efi"];
$pe=$rowp41["peso_efi"];
$tal=$rowp41["tall_efi"];
$pc=$rowp41["pcfa_efi"];
$ta2=$rowp41["tea2_efi"];
$otro=$rowp41["otrh_efi"];

}

$resultado_sql41="SELECT complementoexfisico.code_cef, complementoexfisico.numc_cef, complementoexfisico.anor_cef, complementoexfisico.desc_cef FROM complementoexfisico WHERE (((complementoexfisico.numc_cef)='$serie')) ORDER BY complementoexfisico.code_cef ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$descri[]=$rowp41["anor_cef"];
$observa[]=$rowp41["desc_cef"];
}





$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'EXAMEN FISICO:',0);





$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'T.A:',0);

$pdf->SetXY($col+5,$fil);
$pdf->Cell(40,5,$ta1."/".$ta2,0);


$pdf->SetXY($col+30,$fil);
$pdf->Cell(40,5,'FR:',0);

$pdf->SetXY($col+30+5,$fil);
$pdf->Cell(40,5,$fr."/m",0);


$pdf->SetXY($col+30+20,$fil);
$pdf->Cell(40,5,'FC:',0);
$pdf->SetXY($col+30+20+5,$fil);
$pdf->Cell(40,5,$fc."/m",0);


$pdf->SetXY($col+30+20+20,$fil);
$pdf->Cell(40,5,'Tº:',0);
$pdf->SetXY($col+30+20+20+5,$fil);
$pdf->Cell(40,5,$t."ºc",0);

$pdf->SetXY($col+30+20+20+20,$fil);
$pdf->Cell(40,5,'Peso:',0);
$pdf->SetXY($col+30+20+20+20+8,$fil);
$pdf->Cell(40,5,$pe."Kg",0);

$pdf->SetXY($col+30+20+20+20+30,$fil);
$pdf->Cell(40,5,'Talla:',0);
$pdf->SetXY($col+30+20+20+20+30+8,$fil);
$pdf->Cell(40,5,$tal."cm",0);


$pdf->SetXY($col+30+20+20+20+20+30,$fil);
$pdf->Cell(40,5,'PC:',0);
$pdf->SetXY($col+30+20+20+20+20+30+5,$fil);
$pdf->Cell(40,5,$pc,0);

$pdf->SetXY($col+30+20+20+20+20+30+18,$fil);
$pdf->Cell(40,5,'IMC:',0);
/*
if ($area1<>"04"){
$imc=$pe/($tal*$tal)*10000;
}
*/
$pdf->SetXY($col+30+20+20+20+20+30+5+20,$fil);
$pdf->Cell(40,5,$imc,0);


$fil=$fil+5;

if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$pdf->SetXY($col+60,$fil);
$pdf->Cell(40,5,'Sintomatico Respiratorio:',0);
$pdf->SetXY($col+60+35,$fil);
$pdf->Cell(40,5,$sinrespi,0);


$pdf->SetXY($col+60+60,$fil);
$pdf->Cell(40,5,'Sintomatico de Piel:',0);
$pdf->SetXY($col+60+60+28,$fil);
$pdf->Cell(40,5,$sinpiel,0);

if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Complemento Examen Fisico:',0);

//////
$resultado_sql41="SELECT encabesadoformula.nufo_efo, encabesadoformula.numc_efo, encabesadoformula.coen_efo, encabesadoformula.obfo_efo FROM encabesadoformula WHERE (((encabesadoformula.numc_efo)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$med_control=$rowp41["coen_efo"];
$med_obser=$rowp41["obfo_efo"];
}



$otr="";
$otro=$otro.$med_obser;
$tamaño4=strlen($otro);
$fin4=140;
$line4=$tamaño4/$fin4;
$cont4=0;
$fin5="";
if ($tamaño4>=140){
while($tamaño4>$cont4){ 
$otr[]=substr($otro,$cont4,$fin4);
$fin5=$fin5+140;
$cont4=$fin5;
}


foreach($otr as $otri) { 
$fil=$fil+5;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($otri),0);

}

}
else{
$fil=$fil+3;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($otro),0);
}


$fil=$fil+5;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Reporte de Ayudas Diagnosticas:',0);
//
$pdf->SetFont('Arial','',6);
$ray="";
$tamaño5=strlen($rayudasdx);
$fin5=195;
$line5=$tamaño5/$fin5;
$cont5=0;
if ($tamaño5>195){
while($tamaño5>$cont5){ 
$ray[]=substr($rayudasdx,$cont5,$fin5);
$fin6=$fin6+195;
$cont5=$fin6;
}


foreach($ray as $rayu) { 

if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($rayu),0);

}

}
else{

if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($rayudasdx),0);
}
//
$pdf->SetFont('Arial','',8);
$fil=$fil+5;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Impresion Diagnostica:',0);

$pdf->SetXY($col+80,$fil);
$pdf->Cell(5,5,'Tp.Dx',0);

//if($area1=="04"){
$pdf->SetXY($col+90,$fil);
$pdf->Cell(40,5,'Observaciones Diagnosticos:',0);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$colb=$col+50;
$filb=$fil;
$resultado_sql441="SELECT numc_odx,  obser_odx  FROM obser_dx WHERE numc_odx='$serie'";
$verp441=mysql_query($resultado_sql441);
while($rowp441 = mysql_fetch_array($verp441)){ 
$obserdx=$rowp441["obser_odx"];

}

$line4="";
$tamaño4="";
$fin4="";
$otr="";
$tamaño4=strlen($obserdx);
$fin4=80;
$line4=$tamaño4/$fin4;
$cont4=0;
$fin5="";
if ($tamaño4>=80){
while($tamaño4>$cont4){ 
$otr[]=substr($obserdx,$cont4,$fin4);
$fin5=$fin5+80;
$cont4=$fin5;
}


foreach($otr as $otri) { 
$filb=$filb+5;
if ($filb>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}


$pdf->SetXY($colb+40,$filb);
$pdf->Cell(40,5,strtolower($otri),0);

}

}
else{
$filb=$filb+3;
if ($filb>=256){
$pdf->AddPage();
$filb=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$pdf->SetFont('Arial','',6);
$pdf->SetXY($colb+40,$filb);
$pdf->Cell(40,5,strtolower($obserdx),0);
$pdf->SetFont('Arial','',6);
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//}

$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}
if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'1:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci,0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci,0);

$pdf->SetXY($col+83,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(5,5,$tidx_cpl,0);


$resultado_sql41="SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, diagnosticos2.orde_die2, cie_10.nom_cie10 FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10 WHERE (((diagnosticos2.numc_di2)='$serie'))ORDER BY diagnosticos2.orde_die2;  ";
$verp41=mysql_query($resultado_sql41);
$codci2="";
$nomci2="";
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci2[]=$rowp41["codc_di2"];
$nomci2[]=$rowp41["nom_cie10"];
}

if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$pdf->SetFont('Arial','',8);
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'2:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci2[0],0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci2[0],0);

$pdf->SetFont('Arial','',8);

if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'3:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci2[1],0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci2[1],0);
$pdf->SetFont('Arial','',8);

if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'4:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci2[2],0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci2[2],0);
$pdf->SetFont('Arial','',8);


$resultado_sql41="SELECT consultapyp.codp_cpp, cie_10.nom_cie10, consultapyp.numc_cpp FROM consultapyp INNER JOIN cie_10 ON consultapyp.codp_cpp = cie_10.cod_cie10 WHERE (((consultapyp.numc_cpp)='$serie'));
 ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codcipyp[]=$rowp41["codp_cpp"];
$nomcipyp[]=$rowp41["nom_cie10"];
}
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Pyp:',0);
$pdf->SetXY($col+7,$fil);
$pdf->Cell(40,5,$codcipyp[0],0);
$pdf->SetXY($col+15,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomcipyp[0],0);
$pdf->SetFont('Arial','',8);



$fil=$fil+5;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Conducta:',0);
$medi="";
$resultado_sql41=" SELECT medicamentosenv.ccie_men, medicamentosenv.cmed_men, medicamentosenv.cant_men, medicamentosenv.obse_men, medicamentos2.nomb_mdi,  medicamentosenv.numc_men FROM medicamentosenv INNER JOIN medicamentos2 ON medicamentosenv.cmed_men = medicamentos2.codi_mdi WHERE (((medicamentosenv.numc_men)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$nomedi=$rowp41["nomb_mdi"];
$canmed=$rowp41["cant_men"];
$poso=$rowp41["obse_men"];
$conce1=$rowp41["conc_mdi"];
$medi=$medi.";".$nomedi.", ".$conce1.", ".$canmed.", ".$poso;
}

$fil=$fil+5;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Medicamentos:',0);
$pdf->SetFont('Arial','',6);

$medica="";
$tamaño6=strlen($medi);
$fin6=190;
$line6=$tamaño6/$fin6;
$cont6=0;
if ($tamaño6>190){
while($tamaño6>$cont6){ 
$medica[]=substr($medi,$cont6,$fin6);
$fin7=$fin7+190;
$cont6=$fin7;
}


foreach($medica as $medicam) { 

if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($medicam),0);

}

}
else{

if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($medi),0);
}

//

$pdf->SetFont('Arial','',8);
$fil=$fil+5;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Ayudas Dx:',0);

$ayuda="";
$resultado_sql41="SELECT ayudasdiagnosticas.ccie_adx, ayudasdiagnosticas.coda_adx, mapipos.nomb_map, ayudasdiagnosticas.proc_adx, ayudasdiagnosticas.desc_adx, ayudasdiagnosticas.esta_adx, ayudasdiagnosticas.numc_adx FROM ayudasdiagnosticas INNER JOIN mapipos ON ayudasdiagnosticas.coda_adx = mapipos.codi_map WHERE (((ayudasdiagnosticas.numc_adx)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$nomayu=$rowp41["nomb_map"];
$desayu=$rowp41["desc_adx"];

$ayuda=$ayuda.";".$nomayu.", ".$desayu;
}

$pdf->SetFont('Arial','',6);
//
$ayudx="";
$tamaño7=strlen($ayuda);
$fin7=190;
$line7=$tamaño7/$fin7;
$cont7=0;
if ($tamaño7>190){
while($tamaño7>$cont7){ 
$ayudx[]=substr($ayuda,$cont7,$fin7);
$fin8=$fin8+190;
$cont7=$fin8;
}


foreach($ayudx as $ayudx1) { 
if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($ayudx1),0);

}

}
else{
if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($ayuda),0);
}

$pdf->SetFont('Arial','',8);
$fil=$fil+5;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Referencia:',0);

$refe="";
$resultado_sql41="SELECT referencia.idre_ref, referencia.alse_ref, referencia.moti_ref, referencia.tere_ref, referencia.numc_ref, referencia.ccie_ref, destipos.nomb_des FROM referencia INNER JOIN destipos ON referencia.alse_ref = destipos.codi_des WHERE (((referencia.alse_ref)<>'0618' And (referencia.alse_ref)<>'0617') AND ((referencia.numc_ref)='$serie'))"; 
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$nomref=$rowp41["nomb_des"];
$moref=$rowp41["moti_ref"];
$teref=$rowp41["tere_ref"];

$refe=$refe.";".$nomref.", ".$moref.", ".$teref;
}

$pdf->SetFont('Arial','',6);
//
$ref="";
$tamaño8=strlen($refe);
$fin8=190;
$line8=$tamaño8/$fin8;
$cont8=0;
if ($tamaño8>190){
while($tamaño8>$cont8){ 
$ref[]=substr($refe,$cont8,$fin8);
$fin9=$fin9+190;
$cont8=$fin9;
}


foreach($ref as $refe) { 
if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}


$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($refe),0);

}

}
else{

if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($refe),0);
}

$pdf->SetFont('Arial','',8);



$fil=$fil+5;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Medicamento Especiales:',0);

$mees="";

$resultado_sql41="SELECT referencia.alse_ref, detareferencia.desc_dre, detareferencia.cant_dre, detareferencia.obsv_dre, detareferencia.codi_dre, medicamentos2.nomb_mdi, detareferencia.numc_dre FROM (detareferencia INNER JOIN referencia ON detareferencia.idre_dre = referencia.idre_ref) INNER JOIN medicamentos2 ON detareferencia.codi_dre = medicamentos2.codi_mdi WHERE (((detareferencia.numc_dre)='$serie'))"; 
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$motiare=$rowp41["desc_dre"];
$canare=$rowp41["cant_dre"];
$posoare=$rowp41["obsv_dre"];
$nommees=$rowp41["nomb_mdi"];

$mees=$mees.";".$nommees.", ".$canare.", ".$posoare." ,".$motiare;
}
$pdf->SetFont('Arial','',6);
$medesp="";
$tamaño9=strlen($mees);
$fin9=190;
$line9=$tamaño9/$fin9;
$cont9=0;
if ($tamaño9>190){
while($tamaño9>$cont9){ 
$medesp[]=substr($refe,$cont9,$fin9);
$fin10=$fin10+190;
$cont9=$fin10;
}


foreach($medesp as $medespe) { 
if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}


$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($medespe),0);

}

}
else{
if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($mees),0);
}

$pdf->SetFont('Arial','',8);

$fil=$fil+5;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Ayudas Especiales:',0);

$ayespe="";

$resultado_sql41="SELECT referencia.alse_ref, detareferencia.desc_dre, detareferencia.cant_dre, detareferencia.obsv_dre, detareferencia.codi_dre, detareferencia.numc_dre, mapipos.nomb_map FROM (detareferencia INNER JOIN referencia ON detareferencia.idre_dre = referencia.idre_ref) INNER JOIN mapipos ON detareferencia.codi_dre = mapipos.codi_map WHERE (((detareferencia.numc_dre)='$serie'))"; 
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$motiayre=$rowp41["desc_dre"];
$nomaes=$rowp41["nomb_map"];

$ayespe=$ayespe.";".$nomaes.", ".$motiayre;
}

$pdf->SetFont('Arial','',6);
$ayespesi="";
$tamaño10=strlen($ayespe);
$fin10=190;
$line10=$tamaño10/$fin10;
$cont10=0;
if ($tamaño10>190){
while($tamaño10>$cont10){ 
$ayespesi[]=substr($ayespe,$cont10,$fin10);
$fin11=$fin11+190;
$cont10=$fin11;
}


foreach($ayespesi as $ayespesia) { 
if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($ayespesia),0);
}
}
else{
if ($fil>=256){
$pdf->AddPage();
$fil=20;
$col=45;
if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}


$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($ayespe),0);
}
$pdf->SetFont('Arial','',7);


$resultado_sql41="SELECT medicos.cod_medi, medicos.nom_medi,medicos.reg_medi FROM medicos WHERE (((medicos.cod_medi)='$codmedico'));"; 
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$nommedico=$rowp41["nom_medi"];
$regmed=$rowp41["reg_medi"];
$codi_in=$rowp41["cod_medi"];
}

if ($vista==on){}
else{
$pdf->SetXY(5,251);
$pdf->Cell(40,5,$nommedico ,0);

$pdf->SetXY(160,251);
$pdf->Cell(40,5,$nombre,0);


$pdf->SetFont('Arial','',5);
$pdf->SetXY(5,254);
$pdf->Cell(40,5,"Firma y Nª Registro Medico ".$regmed." - ".$codi_in,0);

$pdf->SetXY(160,254);
$pdf->Cell(40,5,"Firma Del Usuario",0);
}

$pdf->SetXY(100,252);


if ($vista==on){
$pdf->SetFont('Arial','',14);
$pdf->SetXY(5,254);
$pdf->Cell(40,5,"Esta Impresion es sólo informativa y NO es válida como certificado Oficial",0);
}

}

//fin historia clinica


//formula
if ($medicamentos1=="on"){
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$fila=72;
$col=20;


$pdf->Image('img\formatos\enca_formula.JPG',1,0,210,0,'','');
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');


$pdf->SetXY(5,15);
$pdf->Cell(40,5,"Nombre:",0);

$pdf->SetXY(18,15);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetXY(80,15);
$pdf->Cell(40,5,"Sexo:",0);

$pdf->SetXY(88,15);
$pdf->Cell(40,5,$sexo,0);

$pdf->SetXY(92,15);
$pdf->Cell(40,5,"Contrato:",0);

$pdf->SetXY(105,15);
$pdf->Cell(40,5,$contrato,0);

$pdf->SetXY(112,15);
$pdf->Cell(40,5,"Identificacion:",0);

$pdf->SetXY(130,15);
$pdf->Cell(40,5,$id,0);

$pdf->SetXY(150,15);
$pdf->Cell(40,5,"Edad:",0);

$pdf->SetXY(158,15);
$pdf->Cell(40,5,$edad,0);

$pdf->SetXY(180,15);
$pdf->Cell(40,5,$serie,0);



$pdf->SetXY(5,20);
$pdf->Cell(40,5,"Direccion:",0);

$pdf->SetXY(18,20);
$pdf->Cell(40,5,$direccion,0);

$pdf->SetXY(65,20);
$pdf->Cell(40,5,"Telefono:",0);

$pdf->SetXY(79,20);
$pdf->Cell(40,5,$telefono,0);

$pdf->SetXY(105,20);
$pdf->Cell(40,5,$contrato1,0);

$pdf->SetXY(5,25);
$pdf->Cell(40,5,"Fecha Consulta:",0);

$pdf->SetXY(30,25);
$pdf->Cell(40,5,$fechaco,0);
if ($area1=="04"){
$pdf->Image('img\formatos\urgencias.JPG',180,25,15,0,'','');
}



$pdf->SetXY(5,30);
$pdf->Cell(40,5,"Area:",0);

$pdf->SetXY(15,30);
$pdf->Cell(40,5,$area1,0);

$pdf->SetXY(20,30);
$pdf->Cell(40,5,$nomare,0);


$col=5;
$fil=35;


$verp41=mysql_query("select  codi_des,codt_des, nomb_des, valo_des from destipos where codt_des='13' and valo_des='$contingencia'");

while($rowp41 = mysql_fetch_array($verp41)){ 
$conti=$rowp41["nomb_des"];

}

$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Contingencia:",0);
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$conti,0);
$fil=$fil+5;

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Diagnostico Principal:",0);
$pdf->SetXY($col+30,$fil);
$pdf->Cell(40,5,$dxprin,0);
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col+40,$fil);
//$pdf->Cell(40,5,$nomci,0);
$pdf->SetFont('Arial','',8);

$fil=$fil+6;
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Diagnosticos",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,"Medicamentos // Presentacion",1,1,'C');

//$pdf->SetXY($col+20+40,$fil);
//$pdf->Cell(40,4,"Presentacion",1,1,'C');

$pdf->SetXY($col+20+40+40,$fil);
$pdf->Cell(20,4,"Cantidad",1,1,'C');

$pdf->SetXY($col+20+40+40+20,$fil);
$pdf->Cell(80,4,"Posologia",1,1,'C');

$medi="";
$resultado_sql41=" SELECT medicamentosenv.ccie_men, medicamentosenv.cmed_men, medicamentosenv.cant_men, medicamentosenv.obse_men, medicamentos.nomb_mdi, medicamentos.conc_mdi , medicamentosenv.numc_men FROM medicamentosenv INNER JOIN medicamentos ON medicamentosenv.cmed_men = medicamentos.codi_mdi WHERE (((medicamentosenv.numc_men)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$nomedi=$rowp41["nomb_mdi"];
$canmed=$rowp41["cant_men"];
$poso=$rowp41["obse_men"];
$cxmed=$rowp41["ccie_men"];
$conce=$rowp41["conc_mdi"];
$fil=$fil+5;
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,$cxmed,1,1,'C');
$pdf->SetFont('Arial','',5);
$pdf->SetXY($col+20+40+40,$fil);
$pdf->Cell(20,4,$canmed,1,1,'C');
$pdf->SetFont('Arial','',7);
$pdf->SetXY($col+20+40+40+20,$fil);
$pdf->MultiCell(80,4,strtolower($poso),1,1,'J');
$pdf->SetFont('Arial','',5);


$fin6=0;
$ray="";
$uni=$nomedi." // ".$conce; 
$tamaño5=strlen($uni);
$fin5=75;
$line5=$tamaño5/$fin5;
$cont5=0;
if ($tamaño5>75){
while($tamaño5>$cont5){ 
$ray[]=substr($uni,$cont5,$fin5);
$fin6=$fin6+75;
$cont5=$fin6;
}


foreach($ray as $ra) { 
$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,$ra,1);
$fil=$fil+5;
$sale="ok";
}
if ($sale=="ok"){
$sale="fa";
$fil=$fil-5;
}

}
else{

//$fil=$fil+2;
$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,$uni,1);
}

//$pdf->SetXY($col+20+40,$fil);
//$pdf->Cell(40,4,$conce,1,1,'C');

$pdf->SetFont('Arial','',6);

}
//
$fil=$fil+5;


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Control en:",0);
$pdf->SetXY($col+12,$fil);
$pdf->Cell(40,5,$med_control,0);
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Observaciones:",0);

$pdf->SetFont('Arial','',6);
$me_obse="";
$tamaño10=strlen($med_obser);
$fin10=200;
$line10=$tamaño10/$fin10;
$cont10=0;
if ($tamaño10>200){
while($tamaño10>$cont10){ 
$me_obse[]=substr($med_obser,$cont10,$fin10);
$fin11=$fin11+200;
$cont10=$fin11;
}


foreach($me_obse as $me_obse) { 
$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$me_obse,0);
}
}
else{
$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$med_obser,0);
}
//

$fil=$fil+15;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$nommedico,0);

$pdf->SetXY($col+60,$fil);
$pdf->Cell(40,5,"________________________________",0);

$pdf->SetXY($col+60+50,$fil);
$pdf->Cell(40,5,"________________________________",0);


$pdf->SetXY($col+150,$fil);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetFont('Arial','',5);
$pdf->SetXY($col,$fil+3);
$pdf->Cell(40,5,"Firma y Nª Registro Medico ".$regmed." - ".$codi_in,0);

$pdf->SetXY($col+60,$fil+3);
$pdf->Cell(40,5,"Revisoria",0);

$pdf->SetXY($col+60+50,$fil+3);
$pdf->Cell(40,5,"Auditoria",0);

$pdf->SetXY($col+150,$fil+3);
$pdf->Cell(40,5,"Firma Del Usuario",0);
//finfor1
$fil=$fil+20;
$pdf->Image('img\PIE1.JPG',2,$fil,210,0,'','');

$fil=$fil+10;
$pdf->SetXY(0,$fil);
$pdf->Cell(40,5,"________________________________________________________________________________________________________________________________________________________________________________________________________________________________",0);

$fil=$fil+10;



$pdf->Image('img\formatos\enca_formula.JPG',1,$fil,210,0,'','');

$pdf->SetFont('Arial','',7);
$pdf->SetXY(5+$col,15+$fil);
$pdf->Cell(40,5,"Nombre:",0);

$pdf->SetXY(18+$col,15+$fil);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetXY(80+$col,15+$fil);
$pdf->Cell(40,5,"Sexo:",0);

$pdf->SetXY(88+$col,15+$fil);
$pdf->Cell(40,5,$sexo,0);

$pdf->SetXY(92+$col,15+$fil);
$pdf->Cell(40,5,"Contrato:",0);

$pdf->SetXY(105+$col,15+$fil);
$pdf->Cell(40,5,$contrato,0);

$pdf->SetXY(112+$col,15+$fil);
$pdf->Cell(40,5,"Identificacion:",0);

$pdf->SetXY(130+$col,15+$fil);
$pdf->Cell(40,5,$id,0);

$pdf->SetXY(150+$col,15+$fil);
$pdf->Cell(40,5,"Edad:",0);

$pdf->SetXY(158+$col,15+$fil);
$pdf->Cell(40,5,$edad,0);

$pdf->SetXY(180+$col,15+$fil);
$pdf->Cell(40,5,$serie,0);



$pdf->SetXY(5+$col,20+$fil);
$pdf->Cell(40,5,"Direccion:",0);

$pdf->SetXY(18+$col,20+$fil);
$pdf->Cell(40,5,$direccion,0);

$pdf->SetXY(65+$col,20+$fil);
$pdf->Cell(40,5,"Telefono:",0);

$pdf->SetXY(79+$col,20+$fil);
$pdf->Cell(40,5,$telefono,0);

$pdf->SetXY(105+$col,20+$fil);
$pdf->Cell(40,5,$contrato1,0);

$pdf->SetXY(5+$col,25+$fil);
$pdf->Cell(40,5,"Fecha Consulta:",0);

$pdf->SetXY(30+$col,25+$fil);
$pdf->Cell(40,5,$fechaco,0);

if ($area1=="04"){
$pdf->Image('img\formatos\urgencias.JPG',180+$col,25+$fil,15,0,'','');
}

$pdf->SetXY(5+$col,30+$fil);
$pdf->Cell(40,5,"Area:",0);

$pdf->SetXY(15+$col,30+$fil);
$pdf->Cell(40,5,$area1,0);

$pdf->SetXY(20+$col,30+$fil);
$pdf->Cell(40,5,$nomare,0);



$col=5+$col;
$fil=35+$fil;


$verp41=mysql_query("select  codi_des,codt_des, nomb_des, valo_des from destipos where codt_des='13' and valo_des='$contingencia'");

while($rowp41 = mysql_fetch_array($verp41)){ 
$conti=$rowp41["nomb_des"];

}

$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Contingencia:",0);
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$conti,0);
$fil=$fil+5;

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Diagnostico Principal:",0);
$pdf->SetXY($col+30,$fil);
$pdf->Cell(40,5,$dxprin,0);
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col+40,$fil);
//$pdf->Cell(40,5,$nomci,0);
$pdf->SetFont('Arial','',8);

$fil=$fil+6;
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Diagnosticos",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,"Medicamentos // Presentacion",1,1,'C');

$pdf->SetXY($col+20+40+40,$fil);
$pdf->Cell(20,4,"Cantidad",1,1,'C');

$pdf->SetXY($col+20+40+40+20,$fil);
$pdf->Cell(80,4,"Posologia",1,1,'C');

$medi="";
$resultado_sql41=" SELECT medicamentosenv.ccie_men, medicamentosenv.cmed_men, medicamentosenv.cant_men, medicamentosenv.obse_men, medicamentos.nomb_mdi, medicamentos.conc_mdi , medicamentosenv.numc_men FROM medicamentosenv INNER JOIN medicamentos ON medicamentosenv.cmed_men = medicamentos.codi_mdi WHERE (((medicamentosenv.numc_men)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$nomedi=$rowp41["nomb_mdi"];
$canmed=$rowp41["cant_men"];
$poso=$rowp41["obse_men"];
$cxmed=$rowp41["ccie_men"];
$conce=$rowp41["conc_mdi"];
$fil=$fil+5;

$pdf->SetFont('Arial','',6);
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,$cxmed,1,1,'C');
$pdf->SetFont('Arial','',5);
$pdf->SetXY($col+20+40+40,$fil);
$pdf->Cell(20,4,$canmed,1,1,'C');
$pdf->SetFont('Arial','',7);
$pdf->SetXY($col+20+40+40+20,$fil);
$pdf->MultiCell(80,4,strtolower($poso),1,1,'J');
$pdf->SetFont('Arial','',5);


$fin6=0;
$ray="";
$uni=$nomedi." // ".$conce; 
$tamaño5=strlen($uni);
$fin5=75;
$line5=$tamaño5/$fin5;
$cont5=0;
if ($tamaño5>75){
while($tamaño5>$cont5){ 
$ray[]=substr($uni,$cont5,$fin5);
$fin6=$fin6+75;
$cont5=$fin6;
}


foreach($ray as $ra) { 
$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,$ra,1);
$fil=$fil+5;
$sale="ok";
}
if ($sale=="ok"){
$sale="fa";
$fil=$fil-5;
}

}
else{

//$fil=$fil+2;
$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,$uni,1);
}

//$pdf->SetXY($col+20+40,$fil);
//$pdf->Cell(40,4,$conce,1,1,'C');

$pdf->SetFont('Arial','',6);

}
//

$fil=$fil+5;
$resultado_sql41="SELECT encabesadoformula.nufo_efo, encabesadoformula.numc_efo, encabesadoformula.coen_efo, encabesadoformula.obfo_efo FROM encabesadoformula WHERE (((encabesadoformula.numc_efo)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$med_control=$rowp41["coen_efo"];
$med_obser=$rowp41["obfo_efo"];
}

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Control en:",0);
$pdf->SetXY($col+12,$fil);
$pdf->Cell(40,5,$med_control,0);
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Observaciones:",0);

$pdf->SetFont('Arial','',6);
$me_obse="";
$tamaño10=strlen($med_obser);
$fin10=200;
$line10=$tamaño10/$fin10;
$cont10=0;
if ($tamaño10>200){
while($tamaño10>$cont10){ 
$me_obse[]=substr($med_obser,$cont10,$fin10);
$fin11=$fin11+200;
$cont10=$fin11;
}


foreach($me_obse as $me_obse) { 
$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$me_obse,0);
}
}
else{
$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$med_obser,0);
}


//
$fil=$fil+20;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$nommedico,0);

$pdf->SetXY($col+60,$fil);
$pdf->Cell(40,5,"________________________________",0);

$pdf->SetXY($col+60+50,$fil);
$pdf->Cell(40,5,"________________________________",0);


$pdf->SetXY($col+150,$fil);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetFont('Arial','',5);
$pdf->SetXY($col,$fil+3);
$pdf->Cell(40,5,"Firma y Nª Registro Medico ".$regmed." - ".$codi_in,0);

$pdf->SetXY($col+60,$fil+3);
$pdf->Cell(40,5,"Revisoria",0);

$pdf->SetXY($col+60+50,$fil+3);
$pdf->Cell(40,5,"Auditoria",0);

$pdf->SetXY($col+150,$fil+3);
$pdf->Cell(40,5,"Firma Del Usuario",0);
}//fin



///////////////////////////////////////////////////////////////////////////////////////formula especial
if ($medeespecial1=="on"){
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$fila=72;
$col=20;


$pdf->Image('img\formatos\enca_formulaes.JPG',1,0,210,0,'','');
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');


$pdf->SetXY(5,15);
$pdf->Cell(40,5,"Nombre:",0);

$pdf->SetXY(18,15);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetXY(80,15);
$pdf->Cell(40,5,"Sexo:",0);

$pdf->SetXY(88,15);
$pdf->Cell(40,5,$sexo,0);

$pdf->SetXY(92,15);
$pdf->Cell(40,5,"Contrato:",0);

$pdf->SetXY(105,15);
$pdf->Cell(40,5,$contrato,0);

$pdf->SetXY(112,15);
$pdf->Cell(40,5,"Identificacion:",0);

$pdf->SetXY(130,15);
$pdf->Cell(40,5,$id,0);

$pdf->SetXY(150,15);
$pdf->Cell(40,5,"Edad:",0);

$pdf->SetXY(158,15);
$pdf->Cell(40,5,$edad,0);

$pdf->SetXY(180,15);
$pdf->Cell(40,5,$serie,0);



$pdf->SetXY(5,20);
$pdf->Cell(40,5,"Direccion:",0);

$pdf->SetXY(18,20);
$pdf->Cell(40,5,$direccion,0);

$pdf->SetXY(65,20);
$pdf->Cell(40,5,"Telefono:",0);

$pdf->SetXY(79,20);
$pdf->Cell(40,5,$telefono,0);

$pdf->SetXY(105,20);
$pdf->Cell(40,5,$contrato1,0);

$pdf->SetXY(5,25);
$pdf->Cell(40,5,"Fecha Consulta:",0);

$pdf->SetXY(30,25);
$pdf->Cell(40,5,$fechaco,0);

if ($area1=="04"){
$pdf->Image('img\formatos\urgencias.JPG',180,25,15,0,'','');
}



$pdf->SetXY(5,30);
$pdf->Cell(40,5,"Area:",0);

$pdf->SetXY(15,30);
$pdf->Cell(40,5,$area1,0);

$pdf->SetXY(20,30);
$pdf->Cell(40,5,$nomare,0);

$col=5;
$fil=35;


$verp41=mysql_query("select  codi_des,codt_des, nomb_des, valo_des from destipos where codt_des='13' and valo_des='$contingencia'");

while($rowp41 = mysql_fetch_array($verp41)){ 
$conti=$rowp41["nomb_des"];

}

$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Contingencia:",0);
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$conti,0);
$fil=$fil+5;

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Diagnostico Principal:",0);
$pdf->SetXY($col+30,$fil);
$pdf->Cell(40,5,$dxprin,0);
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col+40,$fil);
//$pdf->Cell(40,5,$nomci,0);
$pdf->SetFont('Arial','',8);

$fil=$fil+6;
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Diagnosticos",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,"Medicamentos // Presentacion",1,1,'C');

$pdf->SetXY($col+20+40+40,$fil);
$pdf->Cell(20,4,"Cantidad",1,1,'C');

$pdf->SetXY($col+20+40+40+20,$fil);
$pdf->Cell(80,4,"Posologia",1,1,'C');

$medi="";
$resultado_sql41="SELECT conc_mdi,ccie_dre,referencia.alse_ref, detareferencia.desc_dre, detareferencia.cant_dre, detareferencia.obsv_dre, detareferencia.codi_dre, medicamentos.nomb_mdi, detareferencia.numc_dre FROM (detareferencia INNER JOIN referencia ON detareferencia.idre_dre = referencia.idre_ref) INNER JOIN medicamentos ON detareferencia.codi_dre = medicamentos.codi_mdi WHERE (((detareferencia.numc_dre)='$serie'))"; 
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$motiare=$rowp41["desc_dre"];
$canmed=$rowp41["cant_dre"];
$poso=$rowp41["obsv_dre"];
$nomedi=$rowp41["nomb_mdi"];
$cxmed=$rowp41["ccie_dre"];
$conce=$rowp41["conc_mdi"];



$fil=$fil+5;
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,$cxmed,1,1,'C');
$pdf->SetFont('Arial','',5);
$pdf->SetXY($col+20+40+40,$fil);
$pdf->Cell(20,4,$canmed,1,1,'C');
$pdf->SetFont('Arial','',7);
$pdf->SetXY($col+20+40+40+20,$fil);
$pdf->MultiCell(80,4,strtolower($poso),1,1,'J');
$pdf->SetFont('Arial','',5);


$fin6=0;
$ray="";
$uni=$nomedi." // ".$conce; 
$tamaño5=strlen($uni);
$fin5=75;
$line5=$tamaño5/$fin5;
$cont5=0;
if ($tamaño5>75){
while($tamaño5>$cont5){ 
$ray[]=substr($uni,$cont5,$fin5);
$fin6=$fin6+75;
$cont5=$fin6;
}


foreach($ray as $ra) { 
$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,$ra,1);
$fil=$fil+5;
$sale="ok";
}
if ($sale=="ok"){
$sale="fa";
$fil=$fil-5;
}

}
else{

//$fil=$fil+2;
$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,$uni,1);
}

//$pdf->SetXY($col+20+40,$fil);
//$pdf->Cell(40,4,$conce,1,1,'C');

$pdf->SetFont('Arial','',6);

}
//
$fil=$fil+5;
$resultado_sql41="SELECT encabesadoformula.nufo_efo, encabesadoformula.numc_efo, encabesadoformula.coen_efo, encabesadoformula.obfo_efo FROM encabesadoformula WHERE (((encabesadoformula.numc_efo)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$med_control=$rowp41["coen_efo"];
$med_obser=$rowp41["obfo_efo"];
}

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Control en:",0);
$pdf->SetXY($col+12,$fil);
$pdf->Cell(40,5,$med_control,0);
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Observaciones:",0);

$pdf->SetFont('Arial','',6);
$me_obse="";
$tamaño10=strlen($med_obser);
$fin10=200;
$line10=$tamaño10/$fin10;
$cont10=0;
if ($tamaño10>200){
while($tamaño10>$cont10){ 
$me_obse[]=substr($med_obser,$cont10,$fin10);
$fin11=$fin11+200;
$cont10=$fin11;
}


foreach($me_obse as $me_obse) { 
$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$me_obse,0);
}
}
else{
$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$med_obser,0);
}


//
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Motivo:",0);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->MultiCell(150,5,$motivo,0,1,'J');


$fil=$fil+10;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$nommedico,0);

$pdf->SetXY($col+60,$fil);
$pdf->Cell(40,5,"________________________________",0);

$pdf->SetXY($col+60+50,$fil);
$pdf->Cell(40,5,"________________________________",0);


$pdf->SetXY($col+150,$fil);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetFont('Arial','',5);
$pdf->SetXY($col,$fil+3);
$pdf->Cell(40,5,"Firma y Nª Registro Medico ".$regmed." - ".$codi_in,0);

$pdf->SetXY($col+60,$fil+3);
$pdf->Cell(40,5,"Revisoria",0);

$pdf->SetXY($col+60+50,$fil+3);
$pdf->Cell(40,5,"Auditoria",0);

$pdf->SetXY($col+150,$fil+3);
$pdf->Cell(40,5,"Firma Del Usuario",0);
//finfor1
$fil=$fil+15;
$pdf->Image('img\PIE1.JPG',2,$fil,210,0,'','');

$fil=$fil+10;
$pdf->SetXY(0,$fil);
$pdf->Cell(40,5,"________________________________________________________________________________________________________________________________________________________________________________________________________________________________",0);

$fil=$fil+10;



$pdf->Image('img\formatos\enca_formulaes.JPG',1,$fil,210,0,'','');

$pdf->SetFont('Arial','',7);
$pdf->SetXY(5+$col,15+$fil);
$pdf->Cell(40,5,"Nombre:",0);

$pdf->SetXY(18+$col,15+$fil);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetXY(80+$col,15+$fil);
$pdf->Cell(40,5,"Sexo:",0);

$pdf->SetXY(88+$col,15+$fil);
$pdf->Cell(40,5,$sexo,0);

$pdf->SetXY(92+$col,15+$fil);
$pdf->Cell(40,5,"Contrato:",0);

$pdf->SetXY(105+$col,15+$fil);
$pdf->Cell(40,5,$contrato,0);

$pdf->SetXY(112+$col,15+$fil);
$pdf->Cell(40,5,"Identificacion:",0);

$pdf->SetXY(130+$col,15+$fil);
$pdf->Cell(40,5,$id,0);

$pdf->SetXY(150+$col,15+$fil);
$pdf->Cell(40,5,"Edad:",0);

$pdf->SetXY(158+$col,15+$fil);
$pdf->Cell(40,5,$edad,0);

$pdf->SetXY(180+$col,15+$fil);
$pdf->Cell(40,5,$serie,0);



$pdf->SetXY(5+$col,20+$fil);
$pdf->Cell(40,5,"Direccion:",0);

$pdf->SetXY(18+$col,20+$fil);
$pdf->Cell(40,5,$direccion,0);

$pdf->SetXY(65+$col,20+$fil);
$pdf->Cell(40,5,"Telefono:",0);

$pdf->SetXY(79+$col,20+$fil);
$pdf->Cell(40,5,$telefono,0);

$pdf->SetXY(105+$col,20+$fil);
$pdf->Cell(40,5,$contrato1,0);

$pdf->SetXY(5+$col,25+$fil);
$pdf->Cell(40,5,"Fecha Consulta:",0);

$pdf->SetXY(30+$col,25+$fil);
$pdf->Cell(40,5,$fechaco,0);


if ($area1=="04"){
$pdf->Image('img\formatos\urgencias.JPG',180+$col,25+$fil,15,0,'','');
}

$pdf->SetXY(5+$col,30+$fil);
$pdf->Cell(40,5,"Area:",0);

$pdf->SetXY(15+$col,30+$fil);
$pdf->Cell(40,5,$area1,0);

$pdf->SetXY(20+$col,30+$fil);
$pdf->Cell(40,5,$nomare,0);

$col=5+$col;
$fil=35+$fil;


$verp41=mysql_query("select  codi_des,codt_des, nomb_des, valo_des from destipos where codt_des='13' and valo_des='$contingencia'");

while($rowp41 = mysql_fetch_array($verp41)){ 
$conti=$rowp41["nomb_des"];

}

$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Contingencia:",0);
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$conti,0);
$fil=$fil+5;

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Diagnostico Principal:",0);
$pdf->SetXY($col+30,$fil);
$pdf->Cell(40,5,$dxprin,0);
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col+40,$fil);
//$pdf->Cell(40,5,$nomci,0);
$pdf->SetFont('Arial','',8);

$fil=$fil+6;
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Diagnosticos",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,"Medicamentos // Presentacion",1,1,'C');

$pdf->SetXY($col+20+40+40,$fil);
$pdf->Cell(20,4,"Cantidad",1,1,'C');

$pdf->SetXY($col+20+40+40+20,$fil);
$pdf->Cell(80,4,"Posologia",1,1,'C');

$medi="";
$resultado_sql41="SELECT conc_mdi,ccie_dre,referencia.alse_ref, detareferencia.desc_dre, detareferencia.cant_dre, detareferencia.obsv_dre, detareferencia.codi_dre, medicamentos.nomb_mdi, detareferencia.numc_dre FROM (detareferencia INNER JOIN referencia ON detareferencia.idre_dre = referencia.idre_ref) INNER JOIN medicamentos ON detareferencia.codi_dre = medicamentos.codi_mdi WHERE (((detareferencia.numc_dre)='$serie'))"; 
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$motiare=$rowp41["desc_dre"];
$canmed=$rowp41["cant_dre"];
$poso=$rowp41["obsv_dre"];
$nomedi=$rowp41["nomb_mdi"];
$cxmed=$rowp41["ccie_dre"];
$conce=$rowp41["conc_mdi"];



$fil=$fil+5;
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,$cxmed,1,1,'C');
$pdf->SetFont('Arial','',5);
$pdf->SetXY($col+20+40+40,$fil);
$pdf->Cell(20,4,$canmed,1,1,'C');
$pdf->SetFont('Arial','',7);
$pdf->SetXY($col+20+40+40+20,$fil);
$pdf->MultiCell(80,4,strtolower($poso),1,1,'J');
$pdf->SetFont('Arial','',5);


$fin6=0;
$ray="";
$uni=$nomedi." // ".$conce; 
$tamaño5=strlen($uni);
$fin5=75;
$line5=$tamaño5/$fin5;
$cont5=0;
if ($tamaño5>75){
while($tamaño5>$cont5){ 
$ray[]=substr($uni,$cont5,$fin5);
$fin6=$fin6+75;
$cont5=$fin6;
}


foreach($ray as $ra) { 
$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,$ra,1);
$fil=$fil+5;
$sale="ok";
}
if ($sale=="ok"){
$sale="fa";
$fil=$fil-5;
}

}
else{

//$fil=$fil+2;
$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,$uni,1);
}

//$pdf->SetXY($col+20+40,$fil);
//$pdf->Cell(40,4,$conce,1,1,'C');

$pdf->SetFont('Arial','',6);

}
//
$fil=$fil+5;


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Control en:",0);
$pdf->SetXY($col+12,$fil);
$pdf->Cell(40,5,$med_control,0);


$fil=$fil+5;
$resultado_sql41="SELECT encabesadoformula.nufo_efo, encabesadoformula.numc_efo, encabesadoformula.coen_efo, encabesadoformula.obfo_efo FROM encabesadoformula WHERE (((encabesadoformula.numc_efo)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$med_control=$rowp41["coen_efo"];
$med_obser=$rowp41["obfo_efo"];
}

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Control en:",0);
$pdf->SetXY($col+12,$fil);
$pdf->Cell(40,5,$med_control,0);
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Observaciones:",0);

$pdf->SetFont('Arial','',6);
$me_obse="";
$tamaño10=strlen($med_obser);
$fin10=200;
$line10=$tamaño10/$fin10;
$cont10=0;
if ($tamaño10>200){
while($tamaño10>$cont10){ 
$me_obse[]=substr($med_obser,$cont10,$fin10);
$fin11=$fin11+200;
$cont10=$fin11;
}


foreach($me_obse as $me_obse) { 
$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$me_obse,0);
}
}
else{
$fil=$fil+3;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$med_obser,0);
}



//
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Motivo:",0);

//$pdf->MultiCell(200,5,$se,0,1,'J'); 

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->MultiCell(150,5,$motivo,0,1,'J');

$fil=$fil+10;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$nommedico,0);

$pdf->SetXY($col+60,$fil);
$pdf->Cell(40,5,"________________________________",0);

$pdf->SetXY($col+60+50,$fil);
$pdf->Cell(40,5,"________________________________",0);




$pdf->SetXY($col+150,$fil);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetFont('Arial','',5);
$pdf->SetXY($col,$fil+3);
$pdf->Cell(40,5,"Firma y Nª Registro Medico ".$regmed." - ".$codi_in,0);

$pdf->SetXY($col+60,$fil+3);
$pdf->Cell(40,5,"Revisoria",0);

$pdf->SetXY($col+60+50,$fil+3);
$pdf->Cell(40,5,"Auditoria",0);

$pdf->SetXY($col+150,$fil+3);
$pdf->Cell(40,5,"Firma Del Usuario",0);
}//fin
$codci2="";
$nomci2="";


////imagenologia

if ($imagenologia1=="on"){
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$fila=72;
$col=20;


$pdf->Image('img\formatos\enca_imageno.JPG',1,0,210,0,'','');
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');


$pdf->SetXY(5,15+10);
$pdf->Cell(40,5,"Nombre:",0);

$pdf->SetXY(18,15+10);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetXY(80,15+10);
$pdf->Cell(40,5,"Sexo:",0);

$pdf->SetXY(88,15+10);
$pdf->Cell(40,5,$sexo,0);

$pdf->SetXY(92,15+10);
$pdf->Cell(40,5,"Contrato:",0);

$pdf->SetXY(105,15+10);
$pdf->Cell(40,5,$contrato,0);

$pdf->SetXY(112,15+10);
$pdf->Cell(40,5,"Identificacion:",0);

$pdf->SetXY(130,15+10);
$pdf->Cell(40,5,$id,0);

$pdf->SetXY(150,15+10);
$pdf->Cell(40,5,"Edad:",0);

$pdf->SetXY(158,15+10);
$pdf->Cell(40,5,$edad,0);

$pdf->SetXY(180,15+10);
$pdf->Cell(40,5,$serie,0);



$pdf->SetXY(5,20+10);
$pdf->Cell(40,5,"Direccion:",0);

$pdf->SetXY(18,20+10);
$pdf->Cell(40,5,$direccion,0);

$pdf->SetXY(65,20+10);
$pdf->Cell(40,5,"Telefono:",0);

$pdf->SetXY(79,20+10);
$pdf->Cell(40,5,$telefono,0);

$pdf->SetXY(5,25+10);
$pdf->Cell(40,5,"Fecha Consulta:",0);

$pdf->SetXY(30,25+10);
$pdf->Cell(40,5,$fechaco,0);

if ($area1=="04"){
$pdf->Image('img\formatos\urgencias.JPG',180,25+10,15,0,'','');
}



$pdf->SetXY(5,30+10);
$pdf->Cell(40,5,"Area:",0);

$pdf->SetXY(15,30+10);
$pdf->Cell(40,5,$area1,0);

$pdf->SetXY(20,30+10);
$pdf->Cell(40,5,$nomare,0);



$col=5;
$fil=35+10;


$verp41=mysql_query("select  codi_des,codt_des, nomb_des, valo_des from destipos where codt_des='13' and valo_des='$contingencia'");

while($rowp41 = mysql_fetch_array($verp41)){ 
$conti=$rowp41["nomb_des"];

}

$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Contingencia:",0);
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$conti,0);
$fil=$fil+5;

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Diagnostico Principal:",0);
$pdf->SetXY($col+30,$fil);
$pdf->Cell(40,5,$dxprin,0);
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col+40,$fil);
$pdf->Cell(40,5,$nomci,0);
$pdf->SetFont('Arial','',8);
$fil=$fil+5;

$pdf->SetFont('Arial','',8);

$fil=$fil+6;
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Diagnosticos",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,"Ayuda",1,1,'C');

$pdf->SetXY($col+20+80,$fil);
$pdf->Cell(100,4,"Drescripcion",1,1,'C');

$resultado_sql41="SELECT ayudasdiagnosticas.numc_adx, ayudasdiagnosticas.ccie_adx, ayudasdiagnosticas.coda_adx, ayudasdiagnosticas.desc_adx, mapipos.nomb_map, mapipos.tipo_map FROM ayudasdiagnosticas INNER JOIN mapipos ON ayudasdiagnosticas.coda_adx = mapipos.codi_map WHERE (((ayudasdiagnosticas.numc_adx)='$serie')) and tipo_map='IMAGENOLOGIA'";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci1=$rowp41["ccie_adx"];
$nomap=$rowp41["nomb_map"];
$descrii=$rowp41["desc_adx"];
$tipo=$rowp41["tipo_map"];


$fil=$fil+5;
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,$codci1,1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->multiCell(80,4,$nomap,1,1,'J');

$pdf->SetXY($col+20+80,$fil);
$pdf->Cell(100,4,$descrii,1,1,'C');

}

$fil=$fil+10;
$pdf->SetFont('Arial','',8);
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Impresion Diagnostica:',0);


$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'1:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci,0);
$pdf->SetXY($col+12,$fil);

$pdf->Cell(40,5,$nomci,0);

$resultado_sql41="SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, diagnosticos2.orde_die2, cie_10.nom_cie10 FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10 WHERE (((diagnosticos2.numc_di2)='$serie'))ORDER BY diagnosticos2.orde_die2;  ";
$verp41=mysql_query($resultado_sql41);
$codci2="";
$nomci2="";
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci2[]=$rowp41["codc_di2"];
$nomci2[]=$rowp41["nom_cie10"];
}



$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'2:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci2[0],0);
$pdf->SetXY($col+12,$fil);

$pdf->Cell(40,5,$nomci2[0],0);





$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'3:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci2[1],0);
$pdf->SetXY($col+12,$fil);
$pdf->Cell(40,5,$nomci2[1],0);




$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'4:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci2[2],0);
$pdf->SetXY($col+12,$fil);
$pdf->Cell(40,5,$nomci2[2],0);
$pdf->SetFont('Arial','',6);


$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Enfermedad Actual:',0);
//

$c="";
$tamaño1=strlen($enac);
$fin1=120;
$line1=$tamaño1/$fin1;
$cont1=0;
if ($tamaño1>120){

while($tamaño1>$cont1){ 
$c[]=substr($enac,$cont1,$fin1);
$fin2=$fin2+120;
$cont1=$fin2;
}


foreach($c as $f) { 
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$f,0);

}

}

else{
$d=$enac;
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$d,0);
}
//

$fil=$fil+20;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$nommedico,0);

$pdf->SetXY($col+60,$fil);
$pdf->Cell(40,5,"________________________________",0);

$pdf->SetXY($col+60+50,$fil);
$pdf->Cell(40,5,"________________________________",0);




$pdf->SetXY($col+150,$fil);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetFont('Arial','',5);
$pdf->SetXY($col,$fil+3);
$pdf->Cell(40,5,"Firma y Nª Registro Medico ".$regmed." - ".$codi_in,0);

$pdf->SetXY($col+60,$fil+3);
$pdf->Cell(40,5,"Registro",0);

$pdf->SetXY($col+60+50,$fil+3);
$pdf->Cell(40,5,"Jefe Medico",0);

$pdf->SetXY($col+150,$fil+3);
$pdf->Cell(40,5,"Firma Del Usuario",0);

}
///fin 

//referencia

if ( $referencia1=="on"){

$refe="";
$resultado_sql412="SELECT referencia.idre_ref, referencia.alse_ref, referencia.moti_ref, referencia.tere_ref, referencia.numc_ref, referencia.ccie_ref, destipos.nomb_des FROM referencia INNER JOIN destipos ON referencia.alse_ref = destipos.codi_des WHERE (((referencia.alse_ref)<>'0618' And (referencia.alse_ref)<>'0617') AND ((referencia.numc_ref)='$serie'))"; 
$verp412=mysql_query($resultado_sql412);
while($rowp412 = mysql_fetch_array($verp412)){ 
$nomref1=$rowp412["nomb_des"];
$moref1=$rowp412["moti_ref"];
$teref1=$rowp412["tere_ref"];

$pdf->AddPage();
$pdf->SetFont('Arial','',8);

$fila=72;
$col=20;

$pdf->Image('img\formatos\enca_referencia.JPG',1,0,210,0,'','');
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');


$pdf->SetXY(5,15+10);
$pdf->Cell(40,5,"Nombre:",0);

$pdf->SetXY(18,15+10);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetXY(80,15+10);
$pdf->Cell(40,5,"Sexo:",0);

$pdf->SetXY(88,15+10);
$pdf->Cell(40,5,$sexo,0);

$pdf->SetXY(92,15+10);
$pdf->Cell(40,5,"Contrato:",0);

$pdf->SetXY(105,15+10);
$pdf->Cell(40,5,$contrato,0);

$pdf->SetXY(112,15+10);
$pdf->Cell(40,5,"Identificacion:",0);

$pdf->SetXY(130,15+10);
$pdf->Cell(40,5,$id,0);

$pdf->SetXY(150,15+10);
$pdf->Cell(40,5,"Edad:",0);

$pdf->SetXY(158,15+10);
$pdf->Cell(40,5,$edad,0);

$pdf->SetXY(180,15+10);
$pdf->Cell(40,5,$serie,0);



$pdf->SetXY(5,20+10);
$pdf->Cell(40,5,"Direccion:",0);

$pdf->SetXY(18,20+10);
$pdf->Cell(40,5,$direccion,0);

$pdf->SetXY(65,20+10);
$pdf->Cell(40,5,"Telefono:",0);

$pdf->SetXY(79,20+10);
$pdf->Cell(40,5,$telefono,0);

$pdf->SetXY(5,25+10);
$pdf->Cell(40,5,"Fecha Consulta:",0);

$pdf->SetXY(30,25+10);
$pdf->Cell(40,5,$fechaco,0);
if ($area1=="04"){
$pdf->Image('img\formatos\urgencias.JPG',180,25+10,15,0,'','');
}

$col=5;
$fil=30+10;

$verp41=mysql_query("select  codi_des,codt_des, nomb_des, valo_des from destipos where codt_des='13' and valo_des='$contingencia'");

while($rowp41 = mysql_fetch_array($verp41)){ 
$conti=$rowp41["nomb_des"];

}

$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Contingencia:",0);
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$conti,0);
$fil=$fil+5;

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Diagnostico Principal:",0);
$pdf->SetXY($col+30,$fil);
$pdf->Cell(40,5,$dxprin,0);
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col+40,$fil);
$pdf->Cell(40,5,$nomci,0);
$pdf->SetFont('Arial','',8);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Del Servicio:",0);

$verp41=mysql_query("select  cod_areas, nom_areas,  perm_are  from areas  where cod_areas='$area1'");
while($rowp41 = mysql_fetch_array($verp41)){ 
$ar=$rowp41["nom_areas"];

}

$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$ar,0);


$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Al Servicio de:',0);
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$nomref1,0);
//

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Enfermedad Actual:',0);
$c="";
$tamaño1=strlen($enac);
$fin1=140;
$line1=$tamaño1/$fin1;
$cont1=0;
$fin2="";
if ($tamaño1>140){
//$fil=$fil+5;
while($tamaño1>$cont1){ 
$c[]=substr($enac,$cont1,$fin1);
$fin2=$fin2+140;
$cont1=$fin2;
}


foreach($c as $f) { 
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$f,0);

}

}

else{
$d=$enac;
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$d,0);
}
//

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'EXAMEN FISICO:',0);





$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'T.A:',0);

$pdf->SetXY($col+5,$fil);
$pdf->Cell(40,5,$ta1."/".$ta2,0);


$pdf->SetXY($col+30,$fil);
$pdf->Cell(40,5,'FR:',0);

$pdf->SetXY($col+30+5,$fil);
$pdf->Cell(40,5,$fr."/m",0);


$pdf->SetXY($col+30+20,$fil);
$pdf->Cell(40,5,'FC:',0);
$pdf->SetXY($col+30+20+5,$fil);
$pdf->Cell(40,5,$fc."/m",0);


$pdf->SetXY($col+30+20+20,$fil);
$pdf->Cell(40,5,'Tº:',0);
$pdf->SetXY($col+30+20+20+5,$fil);
$pdf->Cell(40,5,$t."ºc",0);

$pdf->SetXY($col+30+20+20+20,$fil);
$pdf->Cell(40,5,'Peso:',0);
$pdf->SetXY($col+30+20+20+20+8,$fil);
$pdf->Cell(40,5,$pe."Kg",0);

$pdf->SetXY($col+30+20+20+20+30,$fil);
$pdf->Cell(40,5,'Talla:',0);
$pdf->SetXY($col+30+20+20+20+30+8,$fil);
$pdf->Cell(40,5,$tal."cm",0);


$pdf->SetXY($col+30+20+20+20+20+30,$fil);
$pdf->Cell(40,5,'PC:',0);
$pdf->SetXY($col+30+20+20+20+20+30+5,$fil);
$pdf->Cell(40,5,$pc,0);

$pdf->SetXY($col+30+20+20+20+20+30+18,$fil);
$pdf->Cell(40,5,'IMC:',0);

if ($area1<>"04"){
$imc=$pe/($tal*$tal)*10000;
}
$pdf->SetXY($col+30+20+20+20+20+30+5+20,$fil);
$pdf->Cell(40,5,$imc,0);


$fil=$fil+5;

if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$pdf->SetXY($col+60,$fil);
$pdf->Cell(40,5,'Sintomatico Respiratorio:',0);
$pdf->SetXY($col+60+35,$fil);
$pdf->Cell(40,5,$sinrespi,0);


$pdf->SetXY($col+60+60,$fil);
$pdf->Cell(40,5,'Sintomatico de Piel:',0);
$pdf->SetXY($col+60+60+28,$fil);
$pdf->Cell(40,5,$sinpiel,0);

if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Complemento Examen Fisico:',0);

//////
$resultado_sql41="SELECT encabesadoformula.nufo_efo, encabesadoformula.numc_efo, encabesadoformula.coen_efo, encabesadoformula.obfo_efo FROM encabesadoformula WHERE (((encabesadoformula.numc_efo)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$med_control=$rowp41["coen_efo"];
$med_obser=$rowp41["obfo_efo"];
}



$otr="";
$otro=$otro.$med_obser;
$tamaño4=strlen($otro);
$fin4=140;
$line4=$tamaño4/$fin4;
$cont4=0;
$fin5="";
if ($tamaño4>=140){
while($tamaño4>$cont4){ 
$otr[]=substr($otro,$cont4,$fin4);
$fin5=$fin5+140;
$cont4=$fin5;
}


foreach($otr as $otri) { 
$fil=$fil+5;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($otri),0);

}

}
else{
$fil=$fil+3;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($otro),0);
}



//
$fil=$fil+5;
$pdf->SetFont('Arial','',8);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Impresion Diagnostica:',0);
$codci2="";
$nomci2="";

$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'1:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci,0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci,0);

$resultado_sql41="SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, diagnosticos2.orde_die2, cie_10.nom_cie10 FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10 WHERE (((diagnosticos2.numc_di2)='$serie'))ORDER BY diagnosticos2.orde_die2;  ";
$verp41=mysql_query($resultado_sql41);
$codci2="";
$nomci2="";
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci2[]=$rowp41["codc_di2"];
$nomci2[]=$rowp41["nom_cie10"];
}


$pdf->SetFont('Arial','',8);
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'2:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci2[0],0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci2[0],0);

$pdf->SetFont('Arial','',8);



$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'3:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci2[1],0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci2[1],0);
$pdf->SetFont('Arial','',8);



$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'4:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci2[2],0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci2[2],0);
$pdf->SetFont('Arial','',8);





$fil=$fil+8;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Tratamiento Recibido:',0);
$pdf->SetFont('Arial','',6);
$fil=$fil+5;
$pdf->SetXY($col,$fil);
//////////////////////////////////////
//$pdf->MultiCell(150,5,$teref1,0,1,'J');

$aspgene="";
$tamañop1="";
$finp1="";
$contp1="";
$fin2p1="";

$aspgene=$teref1;
$apg="";
$tamañop1=strlen($aspgene);
$finp1=155;
$linep1=$tamañop1/$finp1;
$contp1=0;
if ($tamañop1>155){
while($tamañop1>$contp1){ 
$apg[]=substr($aspgene,$contp1,$finp1);
$fin2p1=$fin2p1+155;
$contp1=$fin2p1;
}

//$col=$col+40;
foreach($apg as $aspge) { 

if ($fil>=250){
$pdf->AddPage();
$fil=20;
$col=45;
$pdf->Image('img\formatos\enca_referencia.JPG',1,0,210,0,'','');
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$pdf->SetXY($col,$fil);
$pdf->Cell(165,3,$aspge,0);
$fil=$fil+3;

}

}

else{

if ($fil>=250){
$pdf->AddPage();
$fil=20;
$col=45;
$pdf->Image('img\formatos\enca_referencia.JPG',1,0,210,0,'','');
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$pdf->SetXY($col,$fil);
$pdf->Cell(165,3,$aspgene,0);
$fil=$fil+3;
}




/////////////////////////////////////////
$pdf->SetFont('Arial','',8);



$fil=$fil+8;

if ($fil>=250){
$pdf->AddPage();
$fil=20;

$pdf->Image('img\formatos\enca_referencia.JPG',1,0,210,0,'','');
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Motivo:',0);
$fil=$fil+5;
$pdf->SetFont('Arial','',6);
if ($fil>=250){
$pdf->AddPage();
$fil=20;

$pdf->Image('img\formatos\enca_referencia.JPG',1,0,210,0,'','');
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
///////////////////////////////////////////////////

$aspgene="";
$tamañop1="";
$finp1="";
$contp1="";
$fin2p1="";

$aspgene=$moref1;
$apg="";
$tamañop1=strlen($aspgene);
$finp1=155;
$linep1=$tamañop1/$finp1;
$contp1=0;
if ($tamañop1>155){
while($tamañop1>$contp1){ 
$apg[]=substr($aspgene,$contp1,$finp1);
$fin2p1=$fin2p1+155;
$contp1=$fin2p1;
}

//$col=$col+40;
foreach($apg as $aspge) { 

if ($fil>=250){
$pdf->AddPage();
$fil=20;

$pdf->Image('img\formatos\enca_referencia.JPG',1,0,210,0,'','');
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$pdf->SetXY($col,$fil);
$pdf->Cell(165,3,$aspge,0);
$fil=$fil+3;

}

}

else{

if ($fil>=250){
$pdf->AddPage();
$fil=20;
$col=45;
$pdf->Image('img\formatos\enca_referencia.JPG',1,0,210,0,'','');
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$pdf->SetXY($col,$fil);
$pdf->Cell(165,3,$aspgene,0);
$fil=$fil+3;
}

/////////////////////////////////////
$pdf->SetFont('Arial','',6);
$fil=$fil+20;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$nommedico,0);





$pdf->SetFont('Arial','',5);
$pdf->SetXY($col,$fil+3);
$pdf->Cell(40,5,"Firma y Nª Registro Medico ".$regmed." - ".$codi_in,0);

$pdf->SetXY($col+148,$fil+3);
$pdf->Cell(40,5,"Vo.Bo. Jefe Referencia-Contrareferencia",0);


}//while
}//if


// fin referencia

 


///laboratorio
if ($laboratorio1=="on"){
$pdf->AddPage();
$pdf->SetFont('Arial','',8);

$fila=72;
$col=20;

$pdf->Image('img\formatos\enca_laboratorio.JPG',1,0,210,0,'','');
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');


$pdf->SetXY(5,15+10);
$pdf->Cell(40,5,"Nombre:",0);

$pdf->SetXY(18,15+10);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetXY(80,15+10);
$pdf->Cell(40,5,"Sexo:",0);

$pdf->SetXY(88,15+10);
$pdf->Cell(40,5,$sexo,0);

$pdf->SetXY(92,15+10);
$pdf->Cell(40,5,"Contrato:",0);

$pdf->SetXY(105,15+10);
$pdf->Cell(40,5,$contrato,0);

$pdf->SetXY(112,15+10);
$pdf->Cell(40,5,"Identificacion:",0);

$pdf->SetXY(130,15+10);
$pdf->Cell(40,5,$id,0);

$pdf->SetXY(150,15+10);
$pdf->Cell(40,5,"Edad:",0);

$pdf->SetXY(158,15+10);
$pdf->Cell(40,5,$edad,0);

$pdf->SetXY(180,15+10);
$pdf->Cell(40,5,$serie,0);



$pdf->SetXY(5,20+10);
$pdf->Cell(40,5,"Direccion:",0);

$pdf->SetXY(18,20+10);
$pdf->Cell(40,5,$direccion,0);

$pdf->SetXY(65,20+10);
$pdf->Cell(40,5,"Telefono:",0);

$pdf->SetXY(79,20+10);
$pdf->Cell(40,5,$telefono,0);

$pdf->SetXY(5,25+10);
$pdf->Cell(40,5,"Fecha Consulta:",0);

$pdf->SetXY(30,25+10);
$pdf->Cell(40,5,$fechaco,0);

if ($area1=="04"){
$pdf->Image('img\formatos\urgencias.JPG',180,25+10,15,0,'','');
}



$col=5;
$fil=30+10;




$verp41=mysql_query("select  codi_des,codt_des, nomb_des, valo_des from destipos where codt_des='13' and valo_des='$contingencia'");

while($rowp41 = mysql_fetch_array($verp41)){ 
$conti=$rowp41["nomb_des"];

}

$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Contingencia:",0);
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$conti,0);


$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Del Servicio:",0);

$verp41=mysql_query("select  cod_areas, nom_areas,  perm_are  from areas  where cod_areas='$area1'");
while($rowp41 = mysql_fetch_array($verp41)){ 
$ar=$rowp41["nom_areas"];

}

$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$ar,0);


$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Tipo Procedimiento:',0);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Fecha Toma de Muestra:',0);


$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Hora:',0);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Lugar:',0);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'EXAMENES SOLICITADOS:',0);

//
$fil=$fil+6;
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Diagnosticos",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,"Ayuda",1,1,'C');

$pdf->SetXY($col+20+80,$fil);
$pdf->Cell(85,4,"Drescripcion",1,1,'C');

$pdf->SetXY($col+20+80+85,$fil);
$pdf->Cell(20,4,"Preparacion",1,1,'C');

$resultado_sql41="SELECT cod_pre, nom_pre, ayudasdiagnosticas.numc_adx, ayudasdiagnosticas.ccie_adx, ayudasdiagnosticas.coda_adx, ayudasdiagnosticas.desc_adx, mapipos.nomb_map, mapipos.tipo_map FROM ayudasdiagnosticas INNER JOIN mapipos ON ayudasdiagnosticas.coda_adx = mapipos.codi_map INNER JOIN preparacion ON prepa = cod_pre WHERE (((ayudasdiagnosticas.numc_adx)='$serie')) and (tipo_map='LABORATORIOS' or tipo_map='procedimientos')";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci1=$rowp41["ccie_adx"];
$nomap=$rowp41["nomb_map"];
$descrii=$rowp41["desc_adx"];
$tipo=$rowp41["tipo_map"];
$prepa=$rowp41["cod_pre"];

$fil=$fil+5;
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,$codci1,1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,$nomap,1,1,'C');

$pdf->SetXY($col+20+80,$fil);
$pdf->Cell(85,4,$descrii,1,1,'C');

$pdf->SetXY($col+20+80+85,$fil);
$pdf->Cell(20,4,$prepa,1,1,'C');

}
$resultado_sql41p="SELECT cod_pre, nom_pre, ayudasdiagnosticas.numc_adx, ayudasdiagnosticas.ccie_adx, ayudasdiagnosticas.coda_adx, ayudasdiagnosticas.desc_adx, mapipos.nomb_map, mapipos.tipo_map FROM ayudasdiagnosticas INNER JOIN mapipos ON ayudasdiagnosticas.coda_adx = mapipos.codi_map INNER JOIN preparacion ON prepa = cod_pre WHERE (((ayudasdiagnosticas.numc_adx)='$serie')) and (tipo_map='LABORATORIOS' or tipo_map='procedimientos' ) GROUP BY cod_pre";
$verp41p=mysql_query($resultado_sql41p);
while($rowp41p = mysql_fetch_array($verp41p)){ 
$codprepa=$rowp41p['cod_pre'];
$deprepaa=$rowp41p['nom_pre'];
$deprepa=$deprepaa;


$fil=$fil+6;
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Preparaciones: ".$codprepa,1,1,'C');
///////inicio preparacion

$c="";
$tamaño1=strlen($deprepa);
$fin1=200;
$fin2=0;
$line1=$tamaño1/$fin1;
$cont1=0;
if ($tamaño1>200){

while($tamaño1>$cont1){ 
$c[]=substr($deprepa,$cont1,$fin1);
$fin2=$fin2+200;
$cont1=$fin2;
}


foreach($c as $f) { 
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($f),0);

}

}

else{
$d=$deprepa;
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($d),0);
}

}

////////////////////////////fin preparacion




$fil=$fil+5;

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Diagnostico Principal:",0);
$pdf->SetXY($col+30,$fil);
$pdf->Cell(40,5,$dxprin,0);
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col+40,$fil);
$pdf->Cell(40,5,$nomci,0);
$pdf->SetFont('Arial','',8);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Sintomas y Signos:',0);
$c="";
$tamaño1=strlen($enac);
$fin1=120;
$line1=$tamaño1/$fin1;
$cont1=0;
if ($tamaño1>120){
//$fil=$fil+5;
while($tamaño1>$cont1){ 
$c[]=substr($enac,$cont1,$fin1);
$fin2=$fin2+120;
$cont1=$fin2;
}
//$pdf->SetXY(10,30);
//$pdf->MultiCell(200,5,$se,0,1,'J'); 
//$pdf->Cell(40,5,$b,0);

foreach($c as $f) { 
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$f,0);

}

}

else{
$d=$enac;
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$d,0);
}
//
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Medicamentos:",0);

$fil=$fil+6;
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Diagnosticos",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,4,"Medicamentos",1,1,'C');

$pdf->SetXY($col+20+40,$fil);
$pdf->Cell(40,4,"Presentacion",1,1,'C');

$pdf->SetXY($col+20+40+40,$fil);
$pdf->Cell(20,4,"Cantidad",1,1,'C');

$pdf->SetXY($col+20+40+40+20,$fil);
$pdf->Cell(80,4,"Posologia",1,1,'C');

$medi="";
$resultado_sql41=" SELECT medicamentosenv.ccie_men, medicamentosenv.cmed_men, medicamentosenv.cant_men, medicamentosenv.obse_men, medicamentos.nomb_mdi, medicamentos.conc_mdi , medicamentosenv.numc_men FROM medicamentosenv INNER JOIN medicamentos ON medicamentosenv.cmed_men = medicamentos.codi_mdi WHERE (((medicamentosenv.numc_men)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$nomedi=$rowp41["nomb_mdi"];
$canmed=$rowp41["cant_men"];
$poso=$rowp41["obse_men"];
$cxmed=$rowp41["ccie_men"];
$conce=$rowp41["conc_mdi"];
$fil=$fil+5;
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,$cxmed,1,1,'C');
$pdf->SetFont('Arial','',5);
//$pdf->SetXY($col+20,$fil);
//$pdf->Cell(40,4,$nomedi,1,1,'C');

///////
//$pdf->Cell(40,4,$nomedi,1,1,'J');

$fin6=0;
$ray="";
$tamaño5=strlen($nomedi);
$fin5=25;
$line5=$tamaño5/$fin5;
$cont5=0;
if ($tamaño5>25){
while($tamaño5>$cont5){ 
$ray[]=substr($nomedi,$cont5,$fin5);
$fin6=$fin6+25;
$cont5=$fin6;
}


foreach($ray as $ra) { 
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,4,$ra,1);
$fil=$fil+5;
$sale="ok";
}
if ($sale=="ok"){
$sale="fa";
$fil=$fil-5;
}

}
else{

//$fil=$fil+2;
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,4,$nomedi,1);
}


//////







$pdf->SetXY($col+20+40+40,$fil);
$pdf->Cell(20,4,$canmed,1,1,'C');

$pdf->SetXY($col+20+40,$fil);
$pdf->Cell(40,4,$conce,1,1,'C');
$pdf->SetFont('Arial','',7);
$pdf->SetXY($col+20+40+40+20,$fil);
$pdf->MultiCell(80,4,$poso,1,1,'J');
$pdf->SetFont('Arial','',6);

}



$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Motivo de Consulta",0);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->MultiCell(150,5,$motivo,0,1,'J');


$fil=$fil+25;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Recibi Explicación sobre los Procedimientos a Realizar:  [S] [N]",0);


$fil=$fil+10;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$nommedico,0);

$pdf->SetXY($col+60,$fil);
$pdf->Cell(40,5,"________________________________",0);








$pdf->SetFont('Arial','',5);
$pdf->SetXY($col,$fil+3);
$pdf->Cell(40,5,"Firma y Nª Registro Medico ".$regmed." - ".$codi_in,0);

$pdf->SetXY($col+60,$fil+3);
$pdf->Cell(40,5,"Firma y Codigo del Personal de Laboratorio",0);

$pdf->SetXY($col+150,$fil+3);
$pdf->Cell(40,5,"Recibi el servicio Arriba Expresado",0);




//
}

//

if ($ordeapoyo1=="on"){
$pdf->AddPage();
$pdf->SetFont('Arial','',8);

$fila=72;
$col=20;

$pdf->Image('img\formatos\enca_apoyo.JPG',1,0,210,0,'','');
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');


$pdf->SetXY(5,15+10);
$pdf->Cell(40,5,"Nombre:",0);

$pdf->SetXY(18,15+10);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetXY(80,15+10);
$pdf->Cell(40,5,"Sexo:",0);

$pdf->SetXY(88,15+10);
$pdf->Cell(40,5,$sexo,0);

$pdf->SetXY(92,15+10);
$pdf->Cell(40,5,"Contrato:",0);

$pdf->SetXY(105,15+10);
$pdf->Cell(40,5,$contrato,0);

$pdf->SetXY(112,15+10);
$pdf->Cell(40,5,"Identificacion:",0);

$pdf->SetXY(130,15+10);
$pdf->Cell(40,5,$id,0);

$pdf->SetXY(150,15+10);
$pdf->Cell(40,5,"Edad:",0);

$pdf->SetXY(158,15+10);
$pdf->Cell(40,5,$edad,0);

$pdf->SetXY(180,15+10);
$pdf->Cell(40,5,$serie,0);



$pdf->SetXY(5,20+10);
$pdf->Cell(40,5,"Direccion:",0);

$pdf->SetXY(18,20+10);
$pdf->Cell(40,5,$direccion,0);

$pdf->SetXY(65,20+10);
$pdf->Cell(40,5,"Telefono:",0);

$pdf->SetXY(79,20+10);
$pdf->Cell(40,5,$telefono,0);

$pdf->SetXY(5,25+10);
$pdf->Cell(40,5,"Fecha Consulta:",0);

$pdf->SetXY(30,25+10);
$pdf->Cell(40,5,$fechaco,0);

if ($area1=="04"){
$pdf->Image('img\formatos\urgencias.JPG',180,25+10,15,0,'','');
}


$col=5;
$fil=30+10;




$verp41=mysql_query("select  codi_des,codt_des, nomb_des, valo_des from destipos where codt_des='13' and valo_des='$contingencia'");

while($rowp41 = mysql_fetch_array($verp41)){ 
$conti=$rowp41["nomb_des"];

}

$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Contingencia:",0);
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$conti,0);


$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Del Servicio:",0);

$verp41=mysql_query("select  cod_areas, nom_areas,  perm_are  from areas  where cod_areas='$area1'");
while($rowp41 = mysql_fetch_array($verp41)){ 
$ar=$rowp41["nom_areas"];

}

$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$ar,0);


$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Tipo Procedimiento:',0);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Fecha Toma de Muestra:',0);


$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Hora:',0);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Lugar:',0);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'EXAMENES SOLICITADOS:',0);

//
$fil=$fil+6;
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Diagnosticos",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,"Ayuda",1,1,'C');

$pdf->SetXY($col+20+80,$fil);
$pdf->Cell(100,4,"Drescripcion",1,1,'C');

$resultado_sql41="SELECT ayudasdiagnosticas.numc_adx, ayudasdiagnosticas.ccie_adx, ayudasdiagnosticas.coda_adx, ayudasdiagnosticas.desc_adx, mapipos.nomb_map, mapipos.tipo_map FROM ayudasdiagnosticas INNER JOIN mapipos ON ayudasdiagnosticas.coda_adx = mapipos.codi_map WHERE (((ayudasdiagnosticas.numc_adx)='$serie')) and tipo_map='Especialidades'";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci1=$rowp41["ccie_adx"];
$nomap=$rowp41["nomb_map"];
$descrii=$rowp41["desc_adx"];
$tipo=$rowp41["tipo_map"];


$fil=$fil+5;
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,$codci1,1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,$nomap,1,1,'C');

$pdf->SetXY($col+20+80,$fil);
$pdf->Cell(100,4,$descrii,1,1,'C');

}

$fil=$fil+5;

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Diagnostico Principal:",0);
$pdf->SetXY($col+30,$fil);
$pdf->Cell(40,5,$dxprin,0);
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col+40,$fil);
$pdf->Cell(40,5,$nomci,0);
$pdf->SetFont('Arial','',8);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Sintomas y Signos:',0);
$c="";
$tamaño1=strlen($enac);
$fin1=120;
$line1=$tamaño1/$fin1;
$cont1=0;
if ($tamaño1>120){
//$fil=$fil+5;
while($tamaño1>$cont1){ 
$c[]=substr($enac,$cont1,$fin1);
$fin2=$fin2+120;
$cont1=$fin2;
}


foreach($c as $f) { 
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$f,0);

}

}

else{
$d=$enac;
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$d,0);
}
//
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Medicamentos:",0);

$fil=$fil+6;
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Diagnosticos",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,4,"Medicamentos",1,1,'C');

$pdf->SetXY($col+20+40,$fil);
$pdf->Cell(40,4,"Presentacion",1,1,'C');

$pdf->SetXY($col+20+40+40,$fil);
$pdf->Cell(20,4,"Cantidad",1,1,'C');

$pdf->SetXY($col+20+40+40+20,$fil);
$pdf->Cell(80,4,"Posologia",1,1,'C');

$medi="";
$resultado_sql41=" SELECT medicamentosenv.ccie_men, medicamentosenv.cmed_men, medicamentosenv.cant_men, medicamentosenv.obse_men, medicamentos.nomb_mdi, medicamentos.conc_mdi , medicamentosenv.numc_men FROM medicamentosenv INNER JOIN medicamentos ON medicamentosenv.cmed_men = medicamentos.codi_mdi WHERE (((medicamentosenv.numc_men)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$nomedi=$rowp41["nomb_mdi"];
$canmed=$rowp41["cant_men"];
$poso=$rowp41["obse_men"];
$cxmed=$rowp41["ccie_men"];
$conce=$rowp41["conc_mdi"];
$fil=$fil+5;
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,$cxmed,1,1,'C');
$pdf->SetFont('Arial','',5);
//$pdf->SetXY($col+20,$fil);
//$pdf->Cell(40,4,$nomedi,1,1,'C');
///////
//$pdf->Cell(40,4,$nomedi,1,1,'J');

$fin6=0;
$ray="";
$tamaño5=strlen($nomedi);
$fin5=25;
$line5=$tamaño5/$fin5;
$cont5=0;
if ($tamaño5>25){
while($tamaño5>$cont5){ 
$ray[]=substr($nomedi,$cont5,$fin5);
$fin6=$fin6+25;
$cont5=$fin6;
}


foreach($ray as $ra) { 
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,4,$ra,1);
$fil=$fil+5;
$sale="ok";
}
if ($sale=="ok"){
$sale="fa";
$fil=$fil-5;
}

}
else{

//$fil=$fil+2;
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,4,$nomedi,1);
}


//////






$pdf->SetXY($col+20+40+40,$fil);
$pdf->Cell(20,4,$canmed,1,1,'C');

$pdf->SetXY($col+20+40,$fil);
$pdf->Cell(40,4,$conce,1,1,'C');
$pdf->SetFont('Arial','',7);
$pdf->SetXY($col+20+40+40+20,$fil);
$pdf->MultiCell(80,4,$poso,1,1,'J');
$pdf->SetFont('Arial','',6);

}


$fil=$fil+20;


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$nommedico,0);

$pdf->SetXY($col+150,$fil);
$pdf->Cell(40,5,$nombre,0);




$pdf->SetFont('Arial','',5);
$pdf->SetXY($col,$fil+3);
$pdf->Cell(40,5,"Firma y Nª Registro Medico ".$regmed." - ".$codi_in,0);


$pdf->SetXY($col+150,$fil+3);
$pdf->Cell(40,5,"Recibi el servicio Arriba Expresado",0);

//
}
//
//terapias



if ( $ayudasespe1=="on"){

$refe="";
$resultado_sql412="SELECT referencia.idre_ref, referencia.alse_ref, referencia.moti_ref, referencia.tere_ref, referencia.numc_ref, referencia.ccie_ref, destipos.nomb_des FROM referencia INNER JOIN destipos ON referencia.alse_ref = destipos.codi_des WHERE (((referencia.alse_ref)='0617') AND ((referencia.numc_ref)='$serie'))"; 
$verp412=mysql_query($resultado_sql412);
while($rowp412 = mysql_fetch_array($verp412)){ 
$nomref1=$rowp412["nomb_des"];
$moref1=$rowp412["moti_ref"];
$teref1=$rowp412["tere_ref"];

$pdf->AddPage();
$pdf->SetFont('Arial','',8);

$fila=72;
$col=20;

$pdf->Image('img\formatos\enca_ayurefe.JPG',1,0,210,0,'','');
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');


$pdf->SetXY(5,15+10);
$pdf->Cell(40,5,"Nombre:",0);

$pdf->SetXY(18,15+10);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetXY(80,15+10);
$pdf->Cell(40,5,"Sexo:",0);

$pdf->SetXY(88,15+10);
$pdf->Cell(40,5,$sexo,0);

$pdf->SetXY(92,15+10);
$pdf->Cell(40,5,"Contrato:",0);

$pdf->SetXY(105,15+10);
$pdf->Cell(40,5,$contrato,0);

$pdf->SetXY(112,15+10);
$pdf->Cell(40,5,"Identificacion:",0);

$pdf->SetXY(130,15+10);
$pdf->Cell(40,5,$id,0);

$pdf->SetXY(150,15+10);
$pdf->Cell(40,5,"Edad:",0);

$pdf->SetXY(158,15+10);
$pdf->Cell(40,5,$edad,0);

$pdf->SetXY(180,15+10);
$pdf->Cell(40,5,$serie,0);



$pdf->SetXY(5,20+10);
$pdf->Cell(40,5,"Direccion:",0);

$pdf->SetXY(18,20+10);
$pdf->Cell(40,5,$direccion,0);

$pdf->SetXY(65,20+10);
$pdf->Cell(40,5,"Telefono:",0);

$pdf->SetXY(79,20+10);
$pdf->Cell(40,5,$telefono,0);

$pdf->SetXY(5,25+10);
$pdf->Cell(40,5,"Fecha Consulta:",0);

$pdf->SetXY(30,25+10);
$pdf->Cell(40,5,$fechaco,0);

if ($area1=="04"){
$pdf->Image('img\formatos\urgencias.JPG',180,25+10,15,0,'','');
}





$col=5;
$fil=30+10;




$verp41=mysql_query("select  codi_des,codt_des, nomb_des, valo_des from destipos where codt_des='13' and valo_des='$contingencia'");

while($rowp41 = mysql_fetch_array($verp41)){ 
$conti=$rowp41["nomb_des"];

}

$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Contingencia:",0);
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$conti,0);
$fil=$fil+5;

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Diagnostico Principal:",0);
$pdf->SetXY($col+30,$fil);
$pdf->Cell(40,5,$dxprin,0);
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col+40,$fil);
$pdf->Cell(40,5,$nomci,0);
$pdf->SetFont('Arial','',8);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Del Servicio:",0);

$verp41=mysql_query("select  cod_areas, nom_areas,  perm_are  from areas  where cod_areas='$area1'");
while($rowp41 = mysql_fetch_array($verp41)){ 
$ar=$rowp41["nom_areas"];

}

$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$ar,0);


$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Al Servicio de:',0);
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$nomref1,0);
//

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Enfermedad Actual:',0);
$c="";
$tamaño1=strlen($enac);
$fin1=120;
$line1=$tamaño1/$fin1;
$cont1=0;
if ($tamaño1>120){
//$fil=$fil+5;
while($tamaño1>$cont1){ 
$c[]=substr($enac,$cont1,$fin1);
$fin2=$fin2+120;
$cont1=$fin2;
}
//$pdf->SetXY(10,30);
//$pdf->MultiCell(200,5,$se,0,1,'J'); 
//$pdf->Cell(40,5,$b,0);

foreach($c as $f) { 
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$f,0);

}

}

else{
$d=$enac;
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$d,0);
}




//
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'EXAMEN FISICO:',0);





$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'T.A:',0);

$pdf->SetXY($col+5,$fil);
$pdf->Cell(40,5,$ta1."/".$ta2,0);


$pdf->SetXY($col+30,$fil);
$pdf->Cell(40,5,'FR:',0);

$pdf->SetXY($col+30+5,$fil);
$pdf->Cell(40,5,$fr."/m",0);


$pdf->SetXY($col+30+20,$fil);
$pdf->Cell(40,5,'FC:',0);
$pdf->SetXY($col+30+20+5,$fil);
$pdf->Cell(40,5,$fc."/m",0);


$pdf->SetXY($col+30+20+20,$fil);
$pdf->Cell(40,5,'Tº:',0);
$pdf->SetXY($col+30+20+20+5,$fil);
$pdf->Cell(40,5,$t."ºc",0);

$pdf->SetXY($col+30+20+20+20,$fil);
$pdf->Cell(40,5,'Peso:',0);
$pdf->SetXY($col+30+20+20+20+8,$fil);
$pdf->Cell(40,5,$pe."Kg",0);

$pdf->SetXY($col+30+20+20+20+30,$fil);
$pdf->Cell(40,5,'Talla:',0);
$pdf->SetXY($col+30+20+20+20+30+8,$fil);
$pdf->Cell(40,5,$tal."cm",0);


$pdf->SetXY($col+30+20+20+20+20+30,$fil);
$pdf->Cell(40,5,'PC:',0);
$pdf->SetXY($col+30+20+20+20+20+30+5,$fil);
$pdf->Cell(40,5,$pc,0);

$pdf->SetXY($col+30+20+20+20+20+30+18,$fil);
$pdf->Cell(40,5,'IMC:',0);

if ($area1<>"04"){
$imc=$pe/($tal*$tal)*10000;
}
$pdf->SetXY($col+30+20+20+20+20+30+5+20,$fil);
$pdf->Cell(40,5,$imc,0);


$fil=$fil+5;

if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$pdf->SetXY($col+60,$fil);
$pdf->Cell(40,5,'Sintomatico Respiratorio:',0);
$pdf->SetXY($col+60+35,$fil);
$pdf->Cell(40,5,$sinrespi,0);


$pdf->SetXY($col+60+60,$fil);
$pdf->Cell(40,5,'Sintomatico de Piel:',0);
$pdf->SetXY($col+60+60+28,$fil);
$pdf->Cell(40,5,$sinpiel,0);

if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Complemento Examen Fisico:',0);

//////
$resultado_sql41="SELECT encabesadoformula.nufo_efo, encabesadoformula.numc_efo, encabesadoformula.coen_efo, encabesadoformula.obfo_efo FROM encabesadoformula WHERE (((encabesadoformula.numc_efo)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$med_control=$rowp41["coen_efo"];
$med_obser=$rowp41["obfo_efo"];
}



$otr="";
$otro=$otro.$med_obser;
$tamaño4=strlen($otro);
$fin4=140;
$line4=$tamaño4/$fin4;
$cont4=0;
$fin5="";
if ($tamaño4>=140){
while($tamaño4>$cont4){ 
$otr[]=substr($otro,$cont4,$fin4);
$fin5=$fin5+140;
$cont4=$fin5;
}


foreach($otr as $otri) { 
$fil=$fil+5;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($otri),0);

}

}
else{
$fil=$fil+3;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($otro),0);
}


//
$fil=$fil+5;
$pdf->Cell(40,5,'Ayudas Especiales:',0);

$fil=$fil+6;
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Diagnosticos",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,"Ayuda",1,1,'C');

$pdf->SetXY($col+20+80,$fil);
$pdf->Cell(100,4,"Motivo",1,1,'C');



$resultado_sql41="SELECT referencia.alse_ref, detareferencia.desc_dre, detareferencia.cant_dre, detareferencia.obsv_dre, detareferencia.codi_dre, detareferencia.numc_dre, mapipos.nomb_map FROM (detareferencia INNER JOIN referencia ON detareferencia.idre_dre = referencia.idre_ref) INNER JOIN mapipos ON detareferencia.codi_dre = mapipos.codi_map WHERE (((detareferencia.numc_dre)='$serie'))"; 
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$motiayre=$rowp41["desc_dre"];
$nomaes=$rowp41["nomb_map"];
$codci13=$rowp41["codi_dre"];



$fil=$fil+5;
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,$codci13,1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(80,4,$nomaes,1,1,'C');

$pdf->SetXY($col+20+80,$fil);
$pdf->Cell(100,4,$motiayre,1,1,'C');

}






//
$fil=$fil+5;
$pdf->SetFont('Arial','',8);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Impresion Diagnostica:',0);


$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'1:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci,0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci,0);

$resultado_sql41="SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, diagnosticos2.orde_die2, cie_10.nom_cie10 FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10 WHERE (((diagnosticos2.numc_di2)='$serie'))ORDER BY diagnosticos2.orde_die2;  ";
$verp41=mysql_query($resultado_sql41);
$codci2="";
$nomci2="";
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci2[]=$rowp41["codc_di2"];
$nomci2[]=$rowp41["nom_cie10"];
}


$pdf->SetFont('Arial','',8);
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'2:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci2[0],0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci2[0],0);

$pdf->SetFont('Arial','',8);



$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'3:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci2[1],0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci2[1],0);
$pdf->SetFont('Arial','',8);



$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'4:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci2[2],0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci2[2],0);
$pdf->SetFont('Arial','',7);


$fil=$fil+20;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$nommedico,0);

$pdf->SetFont('Arial','',5);
$pdf->SetXY($col,$fil+3);
$pdf->Cell(40,5,"Firma y Nª Registro Medico ".$regmed." - ".$codi_in,0);

$pdf->SetXY($col+148,$fil+3);
$pdf->Cell(40,5,"Vo.Bo. Jefe Referencia-Contrareferencia",0);


}//while
}//if

////
if ( $terapia1=="on"){

$refe="";
$resultado_sql412="SELECT referencia.idre_ref, referencia.alse_ref, referencia.moti_ref, referencia.tere_ref, referencia.numc_ref, referencia.ccie_ref, destipos.nomb_des FROM referencia INNER JOIN destipos ON referencia.alse_ref = destipos.codi_des WHERE referencia.alse_ref='0614' AND referencia.numc_ref='$serie'"; 
$verp412=mysql_query($resultado_sql412);
while($rowp412 = mysql_fetch_array($verp412)){ 
$nomref1=$rowp412["nomb_des"];
$moref1=$rowp412["moti_ref"];
$teref1=$rowp412["tere_ref"];

$pdf->AddPage();
$pdf->SetFont('Arial','',8);

$fila=72;
$col=20;

$pdf->Image('img\formatos\enca_fisica.JPG',1,0,210,0,'','');
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');


$pdf->SetXY(5,15+10);
$pdf->Cell(40,5,"Nombre:",0);

$pdf->SetXY(18,15+10);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetXY(80,15+10);
$pdf->Cell(40,5,"Sexo:",0);

$pdf->SetXY(88,15+10);
$pdf->Cell(40,5,$sexo,0);

$pdf->SetXY(92,15+10);
$pdf->Cell(40,5,"Contrato:",0);

$pdf->SetXY(105,15+10);
$pdf->Cell(40,5,$contrato,0);

$pdf->SetXY(112,15+10);
$pdf->Cell(40,5,"Identificacion:",0);

$pdf->SetXY(130,15+10);
$pdf->Cell(40,5,$id,0);

$pdf->SetXY(150,15+10);
$pdf->Cell(40,5,"Edad:",0);

$pdf->SetXY(158,15+10);
$pdf->Cell(40,5,$edad,0);

$pdf->SetXY(180,15+10);
$pdf->Cell(40,5,$serie,0);



$pdf->SetXY(5,20+10);
$pdf->Cell(40,5,"Direccion:",0);

$pdf->SetXY(18,20+10);
$pdf->Cell(40,5,$direccion,0);

$pdf->SetXY(65,20+10);
$pdf->Cell(40,5,"Telefono:",0);

$pdf->SetXY(79,20+10);
$pdf->Cell(40,5,$telefono,0);

$pdf->SetXY(5,25+10);
$pdf->Cell(40,5,"Fecha Consulta:",0);

$pdf->SetXY(30,25+10);
$pdf->Cell(40,5,$fechaco,0);

if ($area1=="04"){
$pdf->Image('img\formatos\urgencias.JPG',180,25+10,15,0,'','');
}





$col=5;
$fil=30+10;




$verp41=mysql_query("select  codi_des,codt_des, nomb_des, valo_des from destipos where codt_des='13' and valo_des='$contingencia'");

while($rowp41 = mysql_fetch_array($verp41)){ 
$conti=$rowp41["nomb_des"];

}

$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Contingencia:",0);
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$conti,0);
$fil=$fil+5;

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Diagnostico Principal:",0);
$pdf->SetXY($col+30,$fil);
$pdf->Cell(40,5,$dxprin,0);
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col+40,$fil);
$pdf->Cell(40,5,$nomci,0);
$pdf->SetFont('Arial','',8);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Del Servicio:",0);

$verp41=mysql_query("select  cod_areas, nom_areas,  perm_are  from areas  where cod_areas='$area1'");
while($rowp41 = mysql_fetch_array($verp41)){ 
$ar=$rowp41["nom_areas"];

}

$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$ar,0);


$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Al Servicio de:',0);
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$nomref1,0);
//

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Enfermedad Actual:',0);
$c="";
$tamaño1=strlen($enac);
$fin1=120;
$line1=$tamaño1/$fin1;
$cont1=0;
if ($tamaño1>120){
//$fil=$fil+5;
while($tamaño1>$cont1){ 
$c[]=substr($enac,$cont1,$fin1);
$fin2=$fin2+120;
$cont1=$fin2;
}
//$pdf->SetXY(10,30);
//$pdf->MultiCell(200,5,$se,0,1,'J'); 
//$pdf->Cell(40,5,$b,0);

foreach($c as $f) { 
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$f,0);

}

}

else{
$d=$enac;
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$d,0);
}




//
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'EXAMEN FISICO:',0);





$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'T.A:',0);

$pdf->SetXY($col+5,$fil);
$pdf->Cell(40,5,$ta1."/".$ta2,0);


$pdf->SetXY($col+30,$fil);
$pdf->Cell(40,5,'FR:',0);

$pdf->SetXY($col+30+5,$fil);
$pdf->Cell(40,5,$fr."/m",0);


$pdf->SetXY($col+30+20,$fil);
$pdf->Cell(40,5,'FC:',0);
$pdf->SetXY($col+30+20+5,$fil);
$pdf->Cell(40,5,$fc."/m",0);


$pdf->SetXY($col+30+20+20,$fil);
$pdf->Cell(40,5,'Tº:',0);
$pdf->SetXY($col+30+20+20+5,$fil);
$pdf->Cell(40,5,$t."ºc",0);

$pdf->SetXY($col+30+20+20+20,$fil);
$pdf->Cell(40,5,'Peso:',0);
$pdf->SetXY($col+30+20+20+20+8,$fil);
$pdf->Cell(40,5,$pe."Kg",0);

$pdf->SetXY($col+30+20+20+20+30,$fil);
$pdf->Cell(40,5,'Talla:',0);
$pdf->SetXY($col+30+20+20+20+30+8,$fil);
$pdf->Cell(40,5,$tal."cm",0);


$pdf->SetXY($col+30+20+20+20+20+30,$fil);
$pdf->Cell(40,5,'PC:',0);
$pdf->SetXY($col+30+20+20+20+20+30+5,$fil);
$pdf->Cell(40,5,$pc,0);

$pdf->SetXY($col+30+20+20+20+20+30+18,$fil);
$pdf->Cell(40,5,'IMC:',0);

if ($area1<>"04"){
$imc=$pe/($tal*$tal)*10000;
}
$pdf->SetXY($col+30+20+20+20+20+30+5+20,$fil);
$pdf->Cell(40,5,$imc,0);


$fil=$fil+5;

if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}
$pdf->SetXY($col+60,$fil);
$pdf->Cell(40,5,'Sintomatico Respiratorio:',0);
$pdf->SetXY($col+60+35,$fil);
$pdf->Cell(40,5,$sinrespi,0);


$pdf->SetXY($col+60+60,$fil);
$pdf->Cell(40,5,'Sintomatico de Piel:',0);
$pdf->SetXY($col+60+60+28,$fil);
$pdf->Cell(40,5,$sinpiel,0);

if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Complemento Examen Fisico:',0);

//////
$resultado_sql41="SELECT encabesadoformula.nufo_efo, encabesadoformula.numc_efo, encabesadoformula.coen_efo, encabesadoformula.obfo_efo FROM encabesadoformula WHERE (((encabesadoformula.numc_efo)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$med_control=$rowp41["coen_efo"];
$med_obser=$rowp41["obfo_efo"];
}



$otr="";
$otro=$otro.$med_obser;
$tamaño4=strlen($otro);
$fin4=140;
$line4=$tamaño4/$fin4;
$cont4=0;
$fin5="";
if ($tamaño4>=140){
while($tamaño4>$cont4){ 
$otr[]=substr($otro,$cont4,$fin4);
$fin5=$fin5+140;
$cont4=$fin5;
}


foreach($otr as $otri) { 
$fil=$fil+5;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($otri),0);

}

}
else{
$fil=$fil+3;
if ($fil>=256){
$pdf->AddPage();
$fil=20;

if($area1=="04"){
$pdf->Image('img\formatos\enca_urg.JPG',1,0,210,0,'','');
}
else
{
$pdf->Image('img\formatos\enca_histo.JPG',1,0,210,0,'','');
}
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
}

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,strtolower($otro),0);
}

//
$fil=$fil+5;
$pdf->SetFont('Arial','',8);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Impresion Diagnostica:',0);


$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'1:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci,0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci,0);

$resultado_sql41="SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, diagnosticos2.orde_die2, cie_10.nom_cie10 FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10 WHERE (((diagnosticos2.numc_di2)='$serie'))ORDER BY diagnosticos2.orde_die2;  ";
$verp41=mysql_query($resultado_sql41);
$codci2="";
$nomci2="";
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci2[]=$rowp41["codc_di2"];
$nomci2[]=$rowp41["nom_cie10"];
}


$pdf->SetFont('Arial','',8);
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'2:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci2[0],0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci2[0],0);

$pdf->SetFont('Arial','',8);



$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'3:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci2[1],0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci2[1],0);
$pdf->SetFont('Arial','',8);



$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'4:',0);
$pdf->SetXY($col+4,$fil);
$pdf->Cell(40,5,$codci2[2],0);
$pdf->SetXY($col+12,$fil);
$pdf->SetFont('Arial','',6);
$pdf->Cell(40,5,$nomci2[2],0);
$pdf->SetFont('Arial','',8);





$fil=$fil+8;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Tratamiento Recibido:',0);
$pdf->SetFont('Arial','',6);
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->MultiCell(150,5,$teref1,0,1,'J');
//$pdf->>MultiCell(200,5,$teref1,0,1,'J');
$pdf->SetFont('Arial','',8);


$fil=$fil+8;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Motivo - Numero de Sesiones Ordenadas:',0);
$fil=$fil+5;
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col,$fil);
$pdf->MultiCell(150,5,$moref1,0,1,'J');
$pdf->SetFont('Arial','',6);

$fil=$fil+20;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$nommedico,0);





$pdf->SetFont('Arial','',5);
$pdf->SetXY($col,$fil+3);
$pdf->Cell(40,5,"Firma y Nª Registro Medico ".$regmed." - ".$codi_in,0);

$pdf->SetXY($col+148,$fil+3);
$pdf->Cell(40,5,"Vo.Bo. Jefe Referencia-Contrareferencia",0);


}//while
}//if

//fin



if ($favigi1=="on"){
$pdf->AddPage();
$pdf->SetFont('Arial','',8);

$fila=72;
$col=20;

$pdf->Image('img\formatos\enca_farvigi.JPG',1,0,210,0,'','');
$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');


$pdf->SetXY(5,15+10);
$pdf->Cell(40,5,"Nombre:",0);

$pdf->SetXY(18,15+10);
$pdf->Cell(40,5,$nombre,0);

$pdf->SetXY(80,15+10);
$pdf->Cell(40,5,"Sexo:",0);

$pdf->SetXY(88,15+10);
$pdf->Cell(40,5,$sexo,0);

$pdf->SetXY(92,15+10);
$pdf->Cell(40,5,"Contrato:",0);

$pdf->SetXY(105,15+10);
$pdf->Cell(40,5,$contrato,0);

$pdf->SetXY(112,15+10);
$pdf->Cell(40,5,"Identificacion:",0);

$pdf->SetXY(130,15+10);
$pdf->Cell(40,5,$id,0);

$pdf->SetXY(150,15+10);
$pdf->Cell(40,5,"Edad:",0);

$pdf->SetXY(158,15+10);
$pdf->Cell(40,5,$edad,0);

$pdf->SetXY(180,15+10);
$pdf->Cell(40,5,$serie,0);



$pdf->SetXY(5,20+10);
$pdf->Cell(40,5,"Direccion:",0);

$pdf->SetXY(18,20+10);
$pdf->Cell(40,5,$direccion,0);

$pdf->SetXY(65,20+10);
$pdf->Cell(40,5,"Telefono:",0);

$pdf->SetXY(79,20+10);
$pdf->Cell(40,5,$telefono,0);

$pdf->SetXY(5,25+10);
$pdf->Cell(40,5,"Fecha Consulta:",0);

$pdf->SetXY(30,25+10);
$pdf->Cell(40,5,$fechaco,0);
if ($area1=="04"){
$pdf->Image('img\formatos\urgencias.JPG',180,25+10,15,0,'','');
}



$pdf->SetXY(5,30+10);
$pdf->Cell(40,5,"Area:",0);

$pdf->SetXY(15,30+10);
$pdf->Cell(40,5,$area1,0);

$pdf->SetXY(20,30+10);
$pdf->Cell(40,5,$nomare,0);

$col=5;
$fil=35+10;




$verp41=mysql_query("select  codi_des,codt_des, nomb_des, valo_des from destipos where codt_des='13' and valo_des='$contingencia'");

while($rowp41 = mysql_fetch_array($verp41)){ 
$conti=$rowp41["nomb_des"];

}

$resultado_sql41="SELECT cod_cie10,  nom_cie10  FROM cie_10 WHERE cod_cie10='$dxprin'  ";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci=$rowp41["cod_cie10"];
$nomci=$rowp41["nom_cie10"];
}


$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Contingencia:",0);
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,5,$conti,0);


$fil=$fil+10;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'REACCION ADVERSA MEDICAEMNTO:',0);
$pdf->SetFont('Arial','',6);
//

$resultado_sql41="SELECT nomm_fav,  tipr_fav,  cond_fav,  nom1_fav,  tip1_fav,  con1_fav,  numc_fav   FROM farmvigilancia WHERE numc_fav='$serie'";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$codci1=$rowp41["nomm_fav"];
$nomap=$rowp41["tipr_fav"];
$descrii=$rowp41["cond_fav"];

$codci12=$rowp41["nom1_fav"];
$nomap2=$rowp41["tip1_fav"];
$descrii2=$rowp41["con1_fav"];

}



$fil=$fil+6;
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Medicamento",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(180,4,$codci1,1,1,'J');


$fil=$fil+5;

$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Tipo Reaccion",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(180,4,$nomap,1,1,'J');

$fil=$fil+5;

$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Conducta",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(180,4,$descrii,1,1,'J');



$pdf->SetFont('Arial','',7);
$fil=$fil+10;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'FALLA TERAPEUTICA:',0);
$pdf->SetFont('Arial','',6);
//
$fil=$fil+6;
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Medicamento",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(180,4,$codci12,1,1,'J');


$fil=$fil+5;

$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Tipo Reaccion",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(180,4,$nomap2,1,1,'J');

$fil=$fil+5;

$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Conducta",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(180,4,$descrii2,1,1,'J');

$fil=$fil+10;

$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Diagnostico Principal:",0);
$pdf->SetXY($col+30,$fil);
$pdf->Cell(40,5,$dxprin,0);
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col+40,$fil);
$pdf->Cell(40,5,$nomci,0);
$pdf->SetFont('Arial','',8);

$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,'Sintomas y Signos:',0);
$c="";
$tamaño1=strlen($enac);
$fin1=120;
$line1=$tamaño1/$fin1;
$cont1=0;
if ($tamaño1>120){
//$fil=$fil+5;
while($tamaño1>$cont1){ 
$c[]=substr($enac,$cont1,$fin1);
$fin2=$fin2+120;
$cont1=$fin2;
}


foreach($c as $f) { 
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$f,0);

}

}

else{
$d=$enac;
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$d,0);
}
//
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Medicamentos:",0);

$fil=$fil+6;
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,"Diagnosticos",1,1,'C');

$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,4,"Medicamentos",1,1,'C');

$pdf->SetXY($col+20+40,$fil);
$pdf->Cell(40,4,"Presentacion",1,1,'C');

$pdf->SetXY($col+20+40+40,$fil);
$pdf->Cell(20,4,"Cantidad",1,1,'C');

$pdf->SetXY($col+20+40+40+20,$fil);
$pdf->Cell(80,4,"Posologia",1,1,'C');

$medi="";
$resultado_sql41=" SELECT medicamentosenv.ccie_men, medicamentosenv.cmed_men, medicamentosenv.cant_men, medicamentosenv.obse_men, medicamentos.nomb_mdi, medicamentos.conc_mdi , medicamentosenv.numc_men FROM medicamentosenv INNER JOIN medicamentos ON medicamentosenv.cmed_men = medicamentos.codi_mdi WHERE (((medicamentosenv.numc_men)='$serie'))";
$verp41=mysql_query($resultado_sql41);
while($rowp41 = mysql_fetch_array($verp41)){ 
$nomedi=$rowp41["nomb_mdi"];
$canmed=$rowp41["cant_men"];
$poso=$rowp41["obse_men"];
$cxmed=$rowp41["ccie_men"];
$conce=$rowp41["conc_mdi"];
$fil=$fil+5;
$pdf->SetFont('Arial','',6);
$pdf->SetXY($col,$fil);
$pdf->Cell(20,4,$cxmed,1,1,'C');
$pdf->SetFont('Arial','',5);
$pdf->SetXY($col+20+40+40,$fil);
$pdf->Cell(20,4,$canmed,1,1,'C');

$pdf->SetFont('Arial','',7);
$pdf->SetXY($col+20+40+40+20,$fil);
$pdf->MultiCell(80,4,$poso,1,1,'J');
$pdf->SetFont('Arial','',5);
//$pdf->SetXY($col+20,$fil);
//$pdf->Cell(40,4,$nomedi,1,1,'C');

///////
//$pdf->Cell(40,4,$nomedi,1,1,'J');

$fin6=0;
$ray="";
$tamaño5=strlen($nomedi);
$fin5=25;
$line5=$tamaño5/$fin5;
$cont5=0;
if ($tamaño5>25){
while($tamaño5>$cont5){ 
$ray[]=substr($nomedi,$cont5,$fin5);
$fin6=$fin6+25;
$cont5=$fin6;
}


foreach($ray as $ra) { 
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,4,$ra,1);
$fil=$fil+5;
$sale="ok";
}
if ($sale=="ok"){
$sale="fa";
$fil=$fil-5;
}

}
else{

//$fil=$fil+2;
$pdf->SetXY($col+20,$fil);
$pdf->Cell(40,4,$nomedi,1);
}


//////





$pdf->SetXY($col+20+40,$fil);
$pdf->Cell(40,4,$conce,1,1,'C');

$pdf->SetFont('Arial','',6);

}



$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,"Motivo de Consulta",0);
$fil=$fil+5;
$pdf->SetXY($col,$fil);
$pdf->MultiCell(150,5,$moco,0,1,'J');




$fil=$fil+25;
$pdf->SetXY($col,$fil);
$pdf->Cell(40,5,$nommedico,0);

$pdf->SetXY($col+60,$fil);
$pdf->Cell(40,5,"________________________________",0);


$pdf->SetXY($col+150,$fil);
$pdf->Cell(40,5,"________________________________",0);

$pdf->SetFont('Arial','',5);
$pdf->SetXY($col,$fil+3);
$pdf->Cell(40,5,"Firma y Nª Registro Medico ".$regmed." - ".$codi_in,0);

$pdf->SetXY($col+60,$fil+3);
$pdf->Cell(40,5,"Firma y Codigo del Personal de Farmacia",0);

$pdf->SetXY($col+150,$fil+3);
$pdf->Cell(40,5,"Firma Del Usuario",0);
}


$pdf->Output();
?> 

 