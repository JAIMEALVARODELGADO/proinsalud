<?php

require('fpdf.php');

function increm($fil,&$pdf)
{
  $fil=$fil+4;
  if($fil>=234)
  {
    $fil=35;
	$pdf->AddPage();
	$pdf->Image('imagenes\du.JPG',5,10,204,0,'','');
    $pdf->Image('imagenes\PIE1.JPG',5,254,204,0,'','');
    $pdf->Image('imagenes\CONTROLADO.JPG',150,235,0,15,'','');
  }
  return ($fil);
}
session_register('nume_fact');
if(!empty($fac_num)){
  $nume_fact=$fac_num;}
//else{
  //$nume_fact=$fac_num;}
$pdf=new FPDF('P','mm','Letter');
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
$fila=62;
mysql_connect("localhost","root");
mysql_select_db("PROINSALUD"); 

	$fila_=0;
	$pdf_=$pdf;
	$imaenca="../funciones_php/img/logo_encabezado.JPG";
	$formato='FRLAB-05';
	include ('../funciones_php/formatos.php');
	$fila_=$fila_+23;	


$col=23;
//$pdf->Image('imagenes\du.JPG',5,10,204,0,'','');
//$pdf->Image('imagenes\PIE1.JPG',5,254,204,0,'','');
//$pdf->Image('imagenes\CONTROLADO.JPG',150,235,0,15,'','');
$nu=date("Y-m-d"); 
$ho=strftime("%I:%M:%S");
$cont=$cont+0;	


$inf=mysql_query("SELECT `cod_usu`,`num_fac`,`fec_rec` ,`fec_ent`,`minr`,`mine`, `cam_usu`,nom_med,cod_emp   FROM `factura` WHERE `cod_usu`='$cod' and `num_fac`='$nume_fact'");
while($row = mysql_fetch_array($inf))
{
$mine=$row ["mine"];
$minr=$row ["minr"];
$nom_med=$row["nom_med"];
$cod_emp=$row["cod_emp"];
$cam_usu=$row["cam_usu"];
}
	$pdf->SetXY(15,30);
	$pdf->Cell(40,5,'Fecha de Recepcion:',0);
	$pdf->SetXY(46,30);
	$pdf->Cell(40,5,$minr,0);

	$pdf->SetXY(80,30);
	$pdf->Cell(40,5,'Fecha de Entrega:',0);
	$pdf->SetXY(107,30);
	$pdf->Cell(40,5,$mine,0);
	
	///Fecha y hora   
	$pdf->SetXY(145,30);
	$pdf->Cell(40,5,"Fecha Creación:",0);
	  
	$pdf->SetXY(170,30);
	$pdf->Cell(40,5,$nu,0);


//selección de la base de datos con la que vamos a trabajar 
mysql_connect("localhost","root");
mysql_select_db("PROINSALUD"); 
//if fecha y encabezados
$result=mysql_query("SELECT `TDOC_USU`, `NROD_USU`, `PNOM_USU`, `SNOM_USU`, `PAPE_USU`, 
`SAPE_USU`,`SEXO_USU`,`MRES_USU`,`TPAF_USU` FROM `usuario` WHERE `NROD_USU`='$cod'");
$bandera="true";
while($row = mysql_fetch_array($result))

{ 

$cod=$row ["NROD_USU"];
$nom=$row ["PNOM_USU"];
$nom2=$row ["SNOM_USU"];
$ape=$row ["PAPE_USU"];
$ape2=$row["SAPE_USU"];
$tip=$row["TPAF_USU"];
$edad=$row["eda_usua"];
$genero=$row["SEXO_USU"];
$cod_muni=$row["MRES_USU"];

$nombre= $nom." ".$nom2." ".$ape." ".$ape2;
//$nombre=substr($nombre,0,20);

}
//if fecha y encabezados
if ($bandera=="true"){

/// Datos Del encabezado


$pdf->SetXY(15,35);
$pdf->Cell(40,5,"Cama:",0);

$concama=mysql_query("SELECT codi_des, codt_des,  nomb_des   FROM destipos WHERE codi_des='$cam_usu'");
while($rowdes=mysql_fetch_array($concama))
{
	$cama_sol=$rowdes["nomb_des"];
	$pdf->SetXY(30,35);
	$pdf->Cell(40,5,$cama_sol,0);
	}
		






/// Codigo Del Municpio

$pdf->SetXY(65,35);
$pdf->Cell(40,5,"Municipio:",0);

$pdf->SetXY(84,35);
$pdf->Cell(40,5,$cod_muni,0);

///Numero de factura
 
$pdf->SetXY(115,35);
$pdf->Cell(40,5,"N° De Factura:",0);

$pdf->SetXY(143,35);
 $pdf->Cell(40,5,$nume_fact,0);

///Numero De Orden
$pdf->SetXY(165,35);
$pdf->Cell(40,5,"N° De Orden:",0);

$pdf->SetXY(191,35);
$pdf->Cell(40,5,$nume_fact,0);

//Cedula Del usuario

$pdf->SetXY(15,40);
$pdf->Cell(40,5,"Identificación:",0);
$pdf->SetFont('Arial','',8);
$pdf->SetXY(41,40);
$pdf->Cell(40,5,$cod,0);

//Nombre Del usuario

$pdf->SetXY(65,40);
$pdf->Cell(40,5,"Nombres - Apellidos:",0);


$pdf->SetXY(103,40);
$pdf->Cell(40,5,$nombre,0);


//Genero Del Usuario

$pdf->SetXY(165,40);
$pdf->Cell(40,5,"Sexo:",0);

$pdf->SetXY(180,40);
$pdf->Cell(40,5,$genero,0);

//Tipo De Usuario

$pdf->SetXY(15,45);
$pdf->Cell(40,5,"Tp.Usuario:",0);
$pdf->SetXY(47,45);
$pdf->Cell(40,5,$tip,0);

//Empresa Remitente
$con_cont=mysql_query("SELECT factura.cod_emp, contrato.NEPS_CON
FROM factura INNER JOIN contrato ON factura.cod_emp = contrato.CODI_CON WHERE cod_usu='$cod' and num_fac='$nume_fact'");
$row_cont=mysql_fetch_array($con_cont);
$pdf->SetXY(65,45);
$pdf->Cell(40,5,"Contrato:",0);

$pdf->SetXY(83,45);
$pdf->SetFont('Arial','',8);
$pdf->Cell(40,5,$row_cont[NEPS_CON],0);
///Nombre Medico Remitente


$con_med=mysql_query("SELECT factura.num_fac, factura.nom_med, medicos.nom_medi FROM factura
INNER JOIN medicos ON factura.nom_med = medicos.cod_medi WHERE cod_usu='$cod' and num_fac='$nume_fact'");
$rowmed = mysql_fetch_array($con_med);
$pdf->SetXY(115,45);
$pdf->Cell(40,5,"Medico Remitente:",0);

$pdf->SetXY(151,45);
$pdf->SetFont('Arial','',8);
$pdf->Cell(40,5,$rowmed[nom_medi],0);
}
$pdf->SetFont('Arial','',11);
//1. Examenes Varios listado
$result=mysql_query("SELECT num_fac,cod_exame,nom_examen,obs_examen,uni_examen ,ref_examen 
FROM datos_inter WHERE num_fac ='$nume_fact'" );
$bandera="true";
$i=0;
$fila=49;

while($row= mysql_fetch_array($result))
{ 

if ($bandera=="true")
{
////ENCABEZADOS DATOS IMPORTANTES DE LOS EXAMENES

///// linea de Separacion - DATOS DE EXAMENES

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);

$fila=$fila+4;
$pdf->SetXY(15,$fila+2);
$pdf->Cell(40,5,"CODIGO",0);

$pdf->SetXY(35,$fila+2);
$pdf->Cell(101,5,"NOMBRE - EXAMEN",0,1,'C');

$pdf->SetXY(138,$fila+2);
$pdf->Cell(40,5,"RESUL",0);

$pdf->SetXY(165,$fila+2);
$pdf->Cell(40,5,"UNID",0);

$pdf->SetXY(180,$fila+2);
$pdf->Cell(40,5,"REFER",0);


$fila=$fila+8;
$bandera="false";

}
		$fila=$fila+8;
		$pdf->setxy(15,$fila);
		$pdf->cell(40,5,($row["cod_exame"]));
		
		$pdf->setxy(35,$fila);
		$pdf->cell(40,5,substr($row["nom_examen"],0,40));
		
		$pdf->setxy(138,$fila);
		$pdf->cell(40,5,substr($row["obs_examen"],0,40));
		
		
		$pdf->SetFont('Arial','',9);
		
		$pdf->setxy(165,$fila);
		$pdf->cell(40,5,substr($row["uni_examen"],0,40));
		
	
		$pdf->setxy(180,$fila);
		$pdf->cell(40,5,substr($row["ref_examen"],0,25));
	
		$pdf->SetFont('Arial','',11);
		
		
		}
//$cont=$cont+10;


//impresion de datos Coprologicos

$result1=mysql_query("SELECT `num_fac`, `cod_examen`, `fec_rec`, `fec_ent`, `cod_usu`, `consistenc`, `bh`,
`blastocyst`, `qc`, `QEColi`, `color`, `ch`, `chilomasti`, `ph`, `tz`, 
`trofozoito`, `moco`, `sangreocul`, `otros`, `azucaresre`, `writh`, `levadura`,
`neutrofilo`, `micelios`, `linfocitos`, `grasa_neut`, `eosinofilo`, `flora_bact`,
`qh`, `qehistolyt`, `qn`, `qemana`, `observaciones`, `no`, `val` FROM coprol where num_fac='$nume_fact'");
if(mysql_num_rows($result1)<>0)
{
while($rowx = mysql_fetch_array($result1))

{
$no=$rowx["no"];
$val=$rowx["val"];
$consistenc=$rowx["consistenc"];
$blastocyst=$rowx["blastocyst"];
$bh=$rowx["bh"];
$qc=$rowx["qc"];
$QEColi =$rowx["QEColi"];
$color  =$rowx["color"];
$ch=$rowx["ch"];
$chilomasti =$rowx["chilomasti"];
$ph =$rowx["ph"];
$tz =$rowx["tz"];
$trofozoito =$rowx["trofozoito"];
$moco =$rowx["moco"];
$sangreocul =$rowx["sangreocul"];
$otros =$rowx["otros"];
$azucaresre =$rowx["azucaresre"];
$writh   =$rowx["writh"];
$levadura =$rowx["levadura"];
$neutrofilo =$rowx["neutrofilo"];
$micelios =$rowx["micelios"];
$linfocitos =$rowx["linfocitos"];
$grasa_neut =$rowx["grasa_neut"];
$eosinofilo =$rowx["eosinofilo"];
$flora_bact =$rowx["flora_bact"];
$qh =$rowx["qh"];
$qehistolyt =$rowx["qehistolyt"];
$qn =$rowx["qn"];
$qemana =$rowx["qemana"];
$observaciones =$rowx["observaciones"];
 
//if de examenes Coprologicos
$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES DATOS COPROSCOPICOS",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);


//////////////////////CARACTERISTICAS DE LOS EXAMENES DATOS COPROSCOPICOS


$fila=increm($fila+2,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'COPROSCOPICO',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'PH:',0);

//resultados

$pdf->SetXY(25,$fila);
$pdf->Cell(40,5,$ph,0);

$pdf->SetXY(46,$fila);
$pdf->Cell(40,5,'COLOR:',0);

//resultados

$pdf->SetXY(64,$fila);
$pdf->Cell(40,5,$color,0);


$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,'CONSISTENCIA:',0);

//resultados
$pdf->SetXY(128,$fila);
$pdf->Cell(40,5,$consistenc,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'SANGRE OCULTA:',0);

//resultados

$pdf->SetXY(53,$fila);
$pdf->Cell(40,5,$sangreocul,0);



$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,'AZU.REDUCTORES:',0);

//resultados

$pdf->SetXY(133,$fila);
$pdf->Cell(40,5,$azucaresre ,0);

$pdf->SetXY(153,$fila);
$pdf->Cell(40,5,$val ,0);

$pdf->SetXY(162,$fila);
$pdf->Cell(40,5,'mg/l' ,0);

$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'COPROLOGICO',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'MOCO:',0);

//resultados

$pdf->SetXY(30,$fila);
$pdf->Cell(40,5,$moco,0);

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,'LEVADURAS:',0);
//resultados
$pdf->SetXY(77,$fila);
$pdf->Cell(40,5,$levadura,0);


$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,'MICELIOS:',0);

//resultados

$pdf->SetXY(113,$fila);
$pdf->Cell(40,5,$micelios,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'GRASAS NEUTRAS:',0);

//resultados

$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,$grasa_neut,0);

$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,'FLORA BACTERIANA:',0);

//resultados

$pdf->SetXY(135,$fila);
$pdf->Cell(40,5,$flora_bact,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,$qc,0);

//resultados



$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$QEColi,0);



$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,$qh,0);

//resultados

$pdf->SetXY(130,$fila);
$pdf->Cell(40,5,$qehistolyt,0);


$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,$qn,0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$qemana,0);


$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,$bh,0);

//resultados

$pdf->SetXY(130,$fila);
$pdf->Cell(40,5,$blastocyst,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,$ch,0);

//resultados

$pdf->SetXY(55,$fila);
$pdf->Cell(40,5,$chilomasti,0);



$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,$tz,0);

//resultados

$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,$trofozoito,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Otros:',0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$otros,0);

$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,$no,0);


$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Wright:',0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$writh,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Neutrofilos:',0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$neutrofilo,0);

$pdf->SetXY(55,$fila);
$pdf->Cell(40,5,'%',0);

$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,'Linfoncito:',0);

//resultados

$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,$linfocitos,0);


$pdf->SetXY(130,$fila);
$pdf->Cell(40,5,'%',0);


$pdf->SetXY(150,$fila);
$pdf->Cell(40,5,'Eosinofilos:',0);

//resultados

$pdf->SetXY(175,$fila);
$pdf->Cell(40,5,$eosinofilo,0);

$pdf->SetXY(185,$fila);
$pdf->Cell(40,5,'%',0);

}
}
// Impresion de Cuadro Hematico
$result2=mysql_query("SELECT `num_fac`, `cod_examch`, `fec_rec`, `fec_ent`, `cod_usu`, `hemoglobin`, `neutrofilos`, `hematrocit`, `cayados`, `vsg1h`, `linfocito`, `leococitos`, `eosinofilos`, `monocitos`, `basofilos`,
 `plaquetas`, `reticuloci`, `observacion`  FROM `cuadroh` where num_fac='$nume_fact'");
if(mysql_num_rows($result2)<>0)
{
 while($rowy = mysql_fetch_array($result2))

{
$hemoglobin=$rowy["hemoglobin"];
$neutrofilos=$rowy["neutrofilos"];
$hematrocit=$rowy["hematrocit"];
$cayados=$rowy["cayados"];
$vsg1h =$rowy["vsg1h"];
$linfocito =$rowy["linfocito"]; 
$leococitos=$rowy["leococitos"];
$eosinofilos =$rowy["eosinofilos"];
$monocitos =$rowy["monocitos"];
$basofilos =$rowy["basofilos"];
$plaquetas =$rowy["plaquetas"];
$reticuloci =$rowy["reticuloci"];
$observacion =$rowy["observacion"];
 

//If de cuadro hematico

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf);
$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,"EXAMENES CUADRO HEMATICO O HEMOGRAMA HEMATOCRITO Y LEOCOCITOS ",0);


$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'HEMOGLOBINA:',0);

$pdf->SetXY(72,$fila);
$pdf->Cell(40,5,'gr / dl',0);

//resultados
$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$hemoglobin,0);


$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,'NEUTROFILOS:',0);

//resultados
$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,$neutrofilos,0);

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,'%',0);


$fila=increm($fila,$pdf);
$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,'CAYADOS:',0);

//resultados
$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,$cayados,0);

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,'%',0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'HEMATOCRITO:',0);

//resultados

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$hematrocit,0);

$pdf->SetXY(72,$fila);
$pdf->Cell(40,5,'%',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,'LINFONCITOS:',0);

//resultados

$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,$linfocito,0);

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,'%',0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'VSG1h',0);

//resultados
$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$vsg1h,0);

$pdf->SetXY(72,$fila);
$pdf->Cell(40,5,'m.m/h',0);


$fila=increm($fila,$pdf);
$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,'EOSINOFILOS:',0);

//resultados

$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,$eosinofilos,0);

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,'%',0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'LEUCOCITOS:',0);

//resultados

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$leococitos,0);

$pdf->SetXY(72,$fila);
$pdf->Cell(40,5,'/mm³',0);


$fila=increm($fila,$pdf);
$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,'MONOCITOS:',0);

//resultados


$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,$monocitos,0);

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,'%',0);


$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'PLAQUETAS:',0);

//resultados

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$plaquetas,0);

$pdf->SetXY(72,$fila);
$pdf->Cell(40,5,'/mm³',0);


$fila=increm($fila,$pdf);
$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,'BASOFILOS:',0);

//resultados


$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,$basofilos,0);

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,'%',0);


$fila=increm($fila,$pdf);
$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,'RETICULOCITOS:',0);
//reticulos

$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,$reticuloci,0);

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,'%',0);



$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"OBSERVACIONES:",0);


$pdf->SetXY(55,$fila);
$pdf->multiCell(150,5,$observacion,0,'J');
$fila=$pdf->gety();

}
}

//impresion datos espermograma
$result3=mysql_query("SELECT `num_fac`, `fec_rec`, `fec_ent`, `cod_usu`, `cod_exames`, `fech_reco`, `hor_reco`, `min_rec`, `ph_exa`, `vol_exa`, `dis_visc`, `nor_visc`, `aum_visc`, `1cc_fila`, `3cc_fila`, `m3cc_fila`, `otro__fila`, `20m_licu`, 
`30m_licu`, `otro_licu`, `leoco_dir`, `hema_dir`, `bact_uno`, `tri_mas`, `trim_menos`, `koh_mas`, `koh_menos`, `movprog_mov`, `movpend_mov`, `inmo_mov`, `vivos_vit`, `mue_vit`, `recu_esperm`, `pmn0xc_gram`, `1-5xc_gram`, `neutr_wrig`, `linfo_wrig`,
`norm_morfo`, `micro_morfo`, `macro_morfo`, `enroll_morfo`,`amorf_morfo`,`scabe_morfo`,`scola_morfo`,`dcab_morfo`, `otro_morfo` FROM `esper` where num_fac='$nume_fact'");

if(mysql_num_rows($result3)<>0)
{
while($rowxxx = mysql_fetch_array($result3))

{
$fech_reco =$rowxxx["fech_reco"];
$hor_reco =$rowxxx["hor_reco"];
$min_rec =$rowxxx["min_rec"];
$ph_exa =$rowxxx["ph_exa"];
$vol_exa =$rowxxx["vol_exa"];
$dis_visc =$rowxxx["dis_visc"];
$nor_visc=$rowxxx["nor_visc"]; 
$aum_visc =$rowxxx["aum_visc"];
$cc1_fila =$rowxxx["1cc_fila"];
$cc3_fila =$rowxxx["3cc_fila"];
$m3cc_fila =$rowxxx["m3cc_fila"];
$otro__fila=$rowxxx["otro__fila"];
$m_licu20 =$rowxxx["20m_licu"];
$m_licu30 =$rowxxx["30m_licu"];
$otro_licu =$rowxxx["otro_licu"];
$leoco_dir =$rowxxx["leoco_dir"];
$hema_dir  =$rowxxx["hema_dir"];
$bact_uno =$rowxxx["bact_uno"];
$tri_mas  =$rowxxx["tri_mas"];
$trim_menos=$rowxxx["trim_menos"];
$koh_mas =$rowxxx["koh_mas"];
$koh_menos=$rowxxx["koh_menos"];
$movprog_mov =$rowxxx["movprog_mov"];
$movpend_mov =$rowxxx["movpend_mov"];
$inmo_mov =$rowxxx["inmo_mov"];
$vivos_vit =$rowxxx["vivos_vit"];
$mue_vit =$rowxxx["mue_vit"];
$recu_esperm =$rowxxx["recu_esperm"];
$pmn0xc_gram =$rowxxx["pmn0xc_gram"];
$x15c_gram =$rowxxx["1-5xc_gram"];
$neutr_wrig =$rowxxx["neutr_wrig"];
$linfo_wrig =$rowxxx["linfo_wrig"];
$norm_morfo =$rowxxx["norm_morfo"];
$micro_morfo =$rowxxx["micro_morfo"];
$macro_morfo =$rowxxx["macro_morfo"];
$enroll_morfo =$rowxxx["enroll_morfo"];
$amorf_morfo =$rowxxx["amorf_morfo"];
$scabe_morfo =$rowxxx["scabe_morfo"];
$scola_morfo =$rowxxx["scola_morfo"];
$dcab_morfo =$rowxxx["dcab_morfo"];
$otro_morfo =$rowxxx["otro_morfo"];

//if del espermograma

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES ESPERMOGRAMA ",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);


////DETALLES DE LOS EXAMENES - LABORATORIO CLINICO 

//$pdf->SetFont('times','B',8);
$fila=increm($fila+2,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'CARACTERISTICAS',0);

$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,'Fecha De Recoleccion:',0);

$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,$fech_reco,0);


$pdf->SetXY(130,$fila);
$pdf->Cell(40,5,'Hora De Procesamiento:',0);

$pdf->SetXY(180,$fila);
$pdf->Cell(40,5,$hor_reco,0);

$pdf->SetXY(190,$fila);
$pdf->Cell(40,5,$min_rec,0);
//resultados
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Ph:',0);


//resultados

$pdf->SetXY(25,$fila);
$pdf->Cell(40,5,$ph_exa,0);

//$pdf->SetXY(30,$fila);
//$pdf->Cell(40,5,'%',0);


$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,'Volumen:',0);

//resultados
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,$vol_exa,0);



$pdf->SetXY(93,$fila);
$pdf->Cell(40,5,'Viscosidad:',0);

//resultados

$pdf->SetXY(115,$fila);
$pdf->Cell(40,5,$dis_visc,0);


$pdf->SetXY(130,$fila);
$pdf->Cell(40,5,'Disminuida:',0);

//resultados

$pdf->SetXY(158,$fila);
$pdf->Cell(40,5,$nor_visc,0);

$pdf->SetXY(165,$fila);
$pdf->Cell(40,5,$aum_visc ,0);

/////////////////////////////////////////////////////////1ºcolumna//////////////////////////////

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Filancia:',0);

$pdf->SetXY(35,$fila);
$pdf->Cell(40,5,$cc1_fila);

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$cc3_fila);

$pdf->SetXY(55,$fila);
$pdf->Cell(40,5,$m3cc_fila );

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,$otro__fila);


$pdf->SetXY(93,$fila);
$pdf->Cell(40,5,'Licuefacion:',0);

$pdf->SetXY(118,$fila);
$pdf->Cell(40,5,$m_licu20,0);

$pdf->SetXY(125,$fila);
$pdf->Cell(40,5,$m_licu30,0);

$pdf->SetXY(135,$fila);
$pdf->Cell(40,5,$otro_licu,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'DIRECTO',0);


$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Leucocitos:');

//resultados

$pdf->SetXY(40,$fila);
$pdf->Cell(40,5,$leoco_dir ,0);

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,'xc',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'Hematitis:',0);

//resultados

$pdf->SetXY(95,$fila);
$pdf->Cell(40,5,$hema_dir,0);


$pdf->SetXY(105,$fila);
$pdf->Cell(40,5,'xc',0);


$pdf->SetXY(125,$fila);
$pdf->Cell(40,5,'Bacterias:',0);

//resultados 

$pdf->SetXY(150,$fila);
$pdf->Cell(40,5,$bact_uno,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Tricomonas:',0);

//resultados

$pdf->SetXY(40,$fila);
$pdf->Cell(40,5,$tri_mas,0);

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$trim_menos,0);



$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'Koh:',0);

//resultados

$pdf->SetXY(75,$fila);
$pdf->Cell(40,5,$koh_mas,0);

$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,$koh_menos,0);


//////////////////////////////////////////////////////////2º columna////////////////////////////////////////////


$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'MOVILIDAD',0);

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,'Moviles Progresivos:',0);

$pdf->SetXY(93,$fila);
$pdf->Cell(40,5,$movprog_mov,0);

$pdf->SetXY(105,$fila);
$pdf->Cell(40,5,'Moviles Pendulantes:',0);

$pdf->SetXY(145,$fila);
$pdf->Cell(40,5,$movpend_mov,0);

$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,'Inmoviles:',0);

$pdf->SetXY(180,$fila);
$pdf->Cell(40,5,$inmo_mov,0);

//////////////////////////////////////////////////////////2º columna////////////////////////////////////////////

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'VITALIDAD',0);



$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'Vivos:',0);

$pdf->SetXY(77,$fila);
$pdf->Cell(40,5,$vivos_vit ,0);

$pdf->SetXY(89,$fila);
$pdf->Cell(40,5,'%',0);

$pdf->SetXY(110,$fila);
$pdf->Cell(40,5,'Muertos:',0);

$pdf->SetXY(128,$fila);
$pdf->Cell(40,5,$mue_vit,0);

$pdf->SetXY(145,$fila);
$pdf->Cell(40,5,'%',0);

/////////////////////////////////////////////////////////3 columna ///////////////////////////////

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'RECUENTO ESPERMATICO:',0);

$pdf->SetXY(72,$fila);
$pdf->Cell(40,5,$recu_esperm,0);

$pdf->SetXY(85,$fila);
$pdf->Cell(40,5,'/mm3 (vr 15 000.000 - 45 0000.000)',0);

////////////////////////////////////////////////////////////3º columna///////////////////////////////////////////////

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'GRAM:',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,$pmn0xc_gram,0);

$pdf->SetXY(78,$fila);
$pdf->Cell(40,5,$x15c_gram,0);

/////////////////////////////////////////////////////////4° columna///////////////////////////////////////////////////
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'WRIGTH',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'Neutrofilos:',0);

$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,$neutr_wrig,0);

$pdf->SetXY(110,$fila);
$pdf->Cell(40,5,'Linfoncitos:',0);

$pdf->SetXY(133,$fila);
$pdf->Cell(40,5,$linfo_wrig ,0);

/////////////////////////////////////////////////////////5° columna///////////////////////////////////////////////////

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'MORFOLOGIA',0);

//titulo
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Normales:');

//resultados

$pdf->SetXY(35,$fila);
$pdf->Cell(40,5,$norm_morfo,0);

$pdf->SetXY(48,$fila);
$pdf->Cell(40,5,'%',0);
//titulo

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'Microcefalos:',0);


$pdf->SetXY(93,$fila);
$pdf->Cell(40,5,$micro_morfo,0);

$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,'%',0);

$pdf->SetXY(110,$fila);
$pdf->Cell(40,5,'Macrocefalos:',0);

//resultados 

$pdf->SetXY(139,$fila);
$pdf->Cell(40,5,$macro_morfo,0);


$pdf->SetXY(145,$fila);
$pdf->Cell(40,5,'%',0);

//resultados

$pdf->SetXY(155,$fila);
$pdf->Cell(40,5,'Enrollados:',0);


$pdf->SetXY(177,$fila);
$pdf->Cell(40,5,$enroll_morfo,0);


$pdf->SetXY(185,$fila);
$pdf->Cell(40,5,'%',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Amorfos:',0);

$pdf->SetXY(35,$fila);
$pdf->Cell(40,5,$amorf_morfo,0);


$pdf->SetXY(48,$fila);
$pdf->Cell(40,5,'%',0);


$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'Sin Cabeza:',0);

$pdf->SetXY(93,$fila);
$pdf->Cell(40,5,$scabe_morfo ,0);


$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,'%',0);


$pdf->SetXY(110,$fila);
$pdf->Cell(40,5,'Sin Cola:',0);

$pdf->SetXY(129,$fila);
$pdf->Cell(40,5,$scola_morfo,0);


$pdf->SetXY(140,$fila);
$pdf->Cell(40,5,'%',0);

$pdf->SetXY(155,$fila);
$pdf->Cell(40,5,'Doble Cabeza:',0);


$pdf->SetXY(185,$fila);
$pdf->Cell(40,5,$dcab_morfo,0);


$pdf->SetXY(190,$fila);
$pdf->Cell(40,5,'%',0);


//////////////////////////////////////////////////////////////6º COLUMNA//////////////////////////////////////

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Otros:');

//resultados
$pdf->SetXY(35,$fila);
$pdf->Cell(40,5,$otro_morfo,0);

}
}

//examenes  frotis Vaginal
$result4=mysql_query("SELECT `num_fac`, `cod_examen`, `fec_ent`, `fec_rec`, `cod_usu`, `ph`, `testaminas`, `koh`, `trichomava`, `pmn`, `celulasgui`, `levaduras`, `seudomicel`, `lactobacil`, `cocos`, `bacilos`, `cocobacilo`, `grampositi`, `gramnegati`, `granv`, 
`pmnxcamcer`, `diplointra`, `diploextra`, `observaciones` FROM `frotis` where num_fac='$nume_fact'");
if(mysql_num_rows($result4)<>0)
{
while($rowxy= mysql_fetch_array($result4))

{
$ph =$rowxy["ph"];
$testaminas =$rowxy["testaminas"];
$koh =$rowxy["koh"];
$trichomava =$rowxy["trichomava"];
$pmn =$rowxy["pmn"];
$celulasgui =$rowxy["celulasgui"];
$levaduras =$rowxy["levaduras"];
$seudomicel =$rowxy["seudomicel"];
$lactobacil =$rowxy["lactobacil"];
$cocos =$rowxy["cocos"];
$bacilos =$rowxy["bacilos"];
$cocobacilo =$rowxy["cocobacilo"];
$grampositi =$rowxy["grampositi"];
$gramnegati =$rowxy["gramnegati"];
$granv =$rowxy["granv"];
$pmnxcamcer =$rowxy["pmnxcamcer"];
$diplointra =$rowxy["diplointra"];
$diploextra =$rowxy["diploextra"];
$observaciones =$rowxy["observaciones"];


//if de Frotis Vaginal
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES FROTIS VAGINAL ",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);






////DETALLES DE LOS EXAMENES - LABORATORIO CLINICO 
$fila=increm($fila+2,$pdf);
//$pdf->SetFont('times','B',8);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'CARACTERISTICAS',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'FRESCO:',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'PH:',0);


//resultados

$pdf->SetXY(25,$fila);
$pdf->Cell(40,5,$ph,0);

//$pdf->SetXY(30,$fila);
//$pdf->Cell(40,5,'%',0);


$pdf->SetXY(40,$fila);
$pdf->Cell(40,5,'TEST DE AMINAS:',0);

//resultados

$pdf->SetXY(78,$fila);
$pdf->Cell(40,5,$testaminas,0);



$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,'K.O.H:',0);

//resultados

$pdf->SetXY(115,$fila);
$pdf->Cell(40,5,$koh,0);


$pdf->SetXY(135,$fila);
$pdf->Cell(40,5,'TRICHOMA VAGINAL:',0);

//resultados

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,$trichomava ,0);


/////////////////////////////////////////////////////////1ºcolumna//////////////////////////////
$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'GRAMA VAGINAL:',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'PMN (X CAMPO):',0);

//resultados

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$pmn,0);

$pdf->SetXY(63,$fila);
$pdf->Cell(40,5,'XC',0);


$pdf->SetXY(73,$fila);
$pdf->Cell(40,5,'CELULAS GUIAS:',0);

//resultados

$pdf->SetXY(110,$fila);
$pdf->Cell(40,5,$celulasgui,0);


$pdf->SetXY(135,$fila);
$pdf->Cell(40,5,'LEVADURAS:',0);

//resultados

$pdf->SetXY(163,$fila);
$pdf->Cell(40,5,$levaduras,0);

$fila=increm($fila+2,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'SEUDOMICELIOS:',0);

//resultados

$pdf->SetXY(53,$fila);
$pdf->Cell(40,5,$seudomicel,0);

$pdf->SetXY(85,$fila);
$pdf->Cell(40,5,'LACTOBACILOS:',0);

//resultados

$pdf->SetXY(125,$fila);
$pdf->Cell(40,5,$lactobacil,0);


//////////////////////////////////////////////////////////2º columna////////////////////////////////////////////


$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'FLORA PREDOMINANTE:',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'MORFOLOGIA:',0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$cocos,0);

$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,$bacilos,0);

$pdf->SetXY(75,$fila);
$pdf->Cell(40,5,$cocobacilo,0);

$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,$grampositi,0);

$pdf->SetXY(125,$fila);
$pdf->Cell(40,5,$gramnegati,0);

$pdf->SetXY(155,$fila);
$pdf->Cell(40,5,$granv,0);



////////////////////////////////////////////////////////////3º columna///////////////////////////////////////////////


$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'GRAMA CERVICAL:',0);

$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'PMN (X CAMPO):',0);

//resultados

$pdf->SetXY(55,$fila);
$pdf->Cell(40,5,$pmnxcamcer,0);

$pdf->SetXY(68,$fila);
$pdf->Cell(40,5,'XC',0);
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'DIPLOCOCOS GRAM NEGATIVOS INTRACELULARES:',0);

//resultados

$pdf->SetXY(130,$fila);
$pdf->Cell(40,5,$diplointra,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'DIPLOCOCOS GRAM NEGATIVA ESTRACELULARES:',0);

//resultados

$pdf->SetXY(130,$fila);
$pdf->Cell(40,5,$diploextra,0);



//////////////////////////////////////////////////////////////4º COLUMNA//////////////////////////////////////
$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'OBSERVACIONES:',0);


//resultados
$fila=increm($fila,$pdf);
$pdf->Cell(40,5,$observaciones,0);

}
}

//impresion de HCG
$result6=mysql_query("SELECT `num_fac`, `cod_examen`, `fec_rec`, `fec_ent`, `cod_usu`, `resul_exam`, `observaciones` FROM `hcg` where num_fac='$nume_fact'");

if(mysql_num_rows($result6)<>0)
{
while($rowxxy= mysql_fetch_array($result6))

{
 $resul_exam =$rowxxy["resul_exam"];
 $observaciones =$rowxxy["observaciones"];

 
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES HCG MUJERES EN EMBARAZO",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);

////DETALLES DE LOS EXAMENES - LABORATORIO CLINICO 
/////////////////////////////////////////////////////////1ºcolumna//////////////////////////////
$fila=increm($fila+2,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'CARACTERISTICAS',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'RESULTADOS:',0);


//resultados

$pdf->SetXY(55,$fila);
$pdf->Cell(40,5,$resul_exam,0);

$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,'m UI/ml',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'SEMANA',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'3',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'5.8',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'4',0);


$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'9.5 - 750',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'5',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'217 - 7138',0);

//resultados
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'6',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'158 - 31.795',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'7',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'3.697 - 163.563',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'8',0);


$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'32.065 - 149.571');

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'9',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'63.803 - 151.410');

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'10',0);

//resultados

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'46.509 - 186.977',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'12',0);


$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'27.832 - 210.612',0);

//resultados
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'14',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'13.950 - 62.530',0);

//////////////////////////////////////////////////////////////4º COLUMNA//////////////////////////////////////
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'OBSERVACIONES:',0);

//resultados
$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,$observaciones,0);
}
}
//Impresion De Examenes Liquidos
$result7=mysql_query("SELECT `num_fac`, `fec_rec`, `fec_ent`, `cod_usu`, `cod_examen`, `cli`, `col`, `ph`, `asp`, `den`, `pre`, `aus`, `ce1`, `ce2`, `hnor`, `hcre`, `pop`, `pne`, `rpos`, `rneg`, `rbu`, `rreg`, `rmal`, `vnor`, `vaum`, `vdis`, `glu`, `pro`, `prote`, `ldn`, `auri`, `amil`, `gram`, `neut`, `linfo`, `celno`, `kposi`, 
`kneg`, `tpos`, `tneg`, `nnbar`, `pnnbar` FROM `liquidos` where num_fac='$nume_fact'");

if(mysql_num_rows($result7)<>0)
{
while($rowz= mysql_fetch_array($result7))
{
$cli=$rowz["cli"];
$col =$rowz["col"];
$ph =$rowz["ph"];
$asp=$rowz["asp"];
$den =$rowz["den"];
$pre =$rowz["pre"];
$aus =$rowz["aus"];
$ce1 =$rowz["ce1"];
$ce2 =$rowz["ce2"];
$hnor =$rowz["hnor"];
$hcre =$rowz["hcre"];
$pop =$rowz["pop"];
$pne =$rowz["pne"];
$rpos =$rowz["rpos"];
$rneg =$rowz["rneg"];
$rbu =$rowz["rbu"];
$rreg =$rowz["rreg"];
$rmal =$rowz["rmal"];
$vnor =$rowz["vnor"];
$vaum =$rowz["vaum"];
$vdis =$rowz["vdis"];
$glu =$rowz["glu"];
$pro =$rowz["pro"];
$prote =$rowz["prote"];
$ldn =$rowz["ldn"];
$auri=$rowz["auri"];
$amil =$rowz["amil"];
$gram =$rowz["gram"];
$neut =$rowz["neut"];
$linfo =$rowz["linfo"];
$celno =$rowz["celno"];
$kposi =$rowz["kposi"];
$kneg =$rowz["kneg"];
$tpos =$rowz["tpos"];
$tneg =$rowz["tneg"];
$nnbar =$rowz["nnbar"];
$pnnbar =$rowz["pnnbar"];


$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES LIQUIDOS BIOLOGICOS ",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);


////DETALLES DE LOS EXAMENES - LABORATORIO CLINICO 
$fila=increm($fila+2,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"CLASE DE LIQUIDO:",0);

//resultados
$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,$cli,0);


$pdf->SetXY(70,$fila);
$pdf->Cell(40,5,"COLOR:",0);

//resultados

$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,$col,0);


$pdf->SetXY(110,$fila);
$pdf->Cell(40,5,"PH:",0);

//resultados
$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,$ph,0);

$pdf->SetXY(135,$fila);
$pdf->Cell(40,5,"Aspectos",0);

//resultados
$pdf->SetXY(155,$fila);
$pdf->Cell(40,5,$asp,0);


$pdf->SetXY(170,$fila);
$pdf->Cell(40,5,"DENSIDAD",0);

//resultados
$pdf->SetXY(195,$fila);
$pdf->Cell(40,5,$den,0);

/////////////////////////////////////////////////////////1ºcolumna//////////////////////////////
///

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"COAGULO",0);

$pdf->SetXY(95,$fila);
$pdf->Cell(40,5,"CELULAS",0);

$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,"HEMATIES",0);

//resultados
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"Presente:",0);

$pdf->SetXY(105,$fila);
$pdf->Cell(40,5,"/mm³",0);

//resultados
$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,'Normales',0);


$pdf->SetXY(99,$fila);
$pdf->Cell(40,5,$ce1,0);

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$pre,0);

$pdf->SetXY(180,$fila);
$pdf->Cell(40,5,$hnor,0);

////////////////////////////////////////
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"Ausente:",0);
$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,'Crenados',0);

$pdf->SetXY(99,$fila);
$pdf->Cell(40,5,$ce2,0);
//resultados
$pdf->SetXY(105,$fila);
$pdf->Cell(40,5,"/mm³",0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$aus,0);

$pdf->SetXY(180,$fila);
$pdf->Cell(40,5,$hcre,0);

//////////////////////////////////////////////////////////2º columna////////////////////////////////////////////

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"PANDY",0);

$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,"RIVALTA",0);

$pdf->SetXY(95,$fila);
$pdf->Cell(40,5,"ROPER'S(Coagulo de Mucina):",0);

$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,"VISCOSIDAD",0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Positivo:',0);

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$pop,0);

$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,'Positivo:',0);

$pdf->SetXY(79,$fila);
$pdf->Cell(40,5,$rpos,0);

$pdf->SetXY(95,$fila);
$pdf->Cell(40,5,'Bueno:',0);

$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,$rbu,0);


$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,'Normal:',0);

$pdf->SetXY(180,$fila);
$pdf->Cell(40,5,$vnor,0);


$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Negativo:',0);

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$pne,0);


$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,'Negativo:',0);


$pdf->SetXY(79,$fila);
$pdf->Cell(40,5,$rneg,0);


$pdf->SetXY(95,$fila);
$pdf->Cell(40,5,'Regular:',0);

$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,$rreg,0);

$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,'Aumentada:',0);

$pdf->SetXY(184,$fila);
$pdf->Cell(40,5,$vaum,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(95,$fila);
$pdf->Cell(40,5,'Malo:',0);


$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,$rmal,0);

$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,'Disminuida:',0);


$pdf->SetXY(184,$fila);
$pdf->Cell(40,5,$vdis,0);



$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"GLUCOSA",0);

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$glu,0);

$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,'PROTEINAS:',0);

$pdf->SetXY(86,$fila);
$pdf->Cell(40,5,$pro,0);

$pdf->SetXY(95,$fila);
$pdf->Cell(40,5,'PROTEINORRAQUIA:',0);

$pdf->SetXY(139,$fila);
$pdf->Cell(40,5,$prote,0);

$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,'LDH:',0);

$pdf->SetXY(170,$fila);
$pdf->Cell(40,5,$ldn,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'ACIDO URICO',0);


//resultados
$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$auri,0);


$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,'AMILIASAS:',0);

//resultados
$pdf->SetXY(84,$fila);
$pdf->Cell(40,5,$amil,0);

$pdf->SetXY(95,$fila);
$pdf->Cell(40,5,'GRAM',0);

//resultados
$pdf->SetXY(128,$fila);
$pdf->Cell(40,5,$gram,0);



//////////////////////////////////////////////////5º columna///////////////////////////////////////////////////
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"WRIGHT",0);

$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,"KOH",0);

$pdf->SetXY(95,$fila);
$pdf->Cell(40,5,'TINTA CHINA',0);

//resultados
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Neutrofilos:',0);

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$neut,0);

$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,"Positivos",0);

$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,$kposi,0);


$pdf->SetXY(95,$fila);
$pdf->Cell(40,5,'Positivo',0);

//resultados
$pdf->SetXY(128,$fila);
$pdf->Cell(40,5,$tpos,0);



$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"Linfoncitos:",0);

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$linfo,0);

$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,"Negativos",0);

$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,$kneg,0);

$pdf->SetXY(95,$fila);
$pdf->Cell(40,5,'Negativo',0);

//resultados
$pdf->SetXY(128,$fila);
$pdf->Cell(40,5,$tneg,0);
//resultados
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Celulas No Diferenciales:',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,$celno,0);


$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'BK:',0);

//resultados
$pdf->SetXY(35,$fila);
$pdf->Cell(40,5,$nnbar,0);

$pdf->SetXY(35,$fila);
$pdf->Cell(40,5,$pbbar,0);

}
}
//impresion de Examenes Uruanalisis
$result8=mysql_query("SELECT `num_fac`, `cod_examen`, `fec_rec`, `fec_ent`, `ced_usu`, `aspectos`, `color`, `ph`, `densidad`, `albumina`, `glucosa`, `cetonas`, `pigm_biliares`, `sangre`, `urobilinogeno`, `nitritos`, `leucocitos`, `epiteliales`, `hermaties`, `valo_hem`,`cilidros`, `cristales`, 
`moco`,`esc2`, `levadura`, `bacterias`,`esc`, `tricomonas`, `obervaciones`, `alt`, `con`, `esp` FROM `uroana` where num_fac='$nume_fact'");
if(mysql_num_rows($result8)<>0)
{

while($rowr= mysql_fetch_array($result8))
{
$aspectos =$rowr["aspectos"]; 
$color =$rowr["color"];
$ph =$rowr["ph"];
$densidad =$rowr["densidad"];
$albumina=$rowr["albumina"]; 
$glucosa=$rowr["glucosa"];
$cetonas=$rowr["cetonas"];
$pigm_biliares =$rowr["pigm_biliares"];
$sangre=$rowr["sangre"];
$urobilinogeno =$rowr["urobilinogeno"]; 
$nitritos =$rowr["nitritos"];
$leucocitos =$rowr["leucocitos"];
$epiteliales =$rowr["epiteliales"]; 
$hermaties =$rowr["hermaties"];
$valo_hem = $rowr["valo_hem"];
$cilidros =$rowr["cilidros"]; 
$cristales =$rowr["cristales"];
$moco =$rowr["moco"];
$esc =$rowr["esc"];
$levadura =$rowr["levadura"]; 
$bacterias =$rowr["bacterias"]; 
$esc2 =$rowr["esc2"];
$tricomonas =$rowr["tricomonas"]; 
$obervaciones =$rowr["obervaciones"];
$con =$rowr["con"]; 
$esp =$rowr["esp"];
$alt =$rowr["alt"];



$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES UROANALISIS",0);


$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);


////DETALLES DE LOS EXAMENES - LABORATORIO CLINICO 

$fila=increm($fila+2,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"ASPECTO:",0);

//resultados
$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$aspectos ,0);


$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"LEUCOCITOS:",0);

//resultados

$pdf->SetXY(127,$fila);
$pdf->Cell(40,5,$leucocitos,0);

$pdf->SetXY(139,$fila);
$pdf->Cell(40,5,'ul',0);

$pdf->SetXY(145,$fila);
$pdf->Cell(40,5,'VN: 0 - 4/ul',0);



$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"COLOR:",0);

//resultados
$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$color,0);


$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"C. EPITELIALES:",0);

//resultados

$pdf->SetXY(127,$fila);
$pdf->Cell(40,5,$epiteliales,0);

$pdf->SetXY(139,$fila);
$pdf->Cell(40,5,'ul',0);

$pdf->SetXY(145,$fila);
$pdf->Cell(40,5,$alt,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"PH:",0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$ph,0);


$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"HEMATIES:",0);

//resultados


$pdf->SetXY(127,$fila);
$pdf->Cell(40,5,$hermaties,0);

$pdf->SetXY(145,$fila);
$pdf->Cell(40,5,$valo_hem,0);

$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,'VN: 0 - 2/ul',0);


$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"DENSIDAD:",0);

//resultados
$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$densidad,0);


$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"CILINDROS:",0);

//resultados
$pdf->SetXY(127,$fila);
$pdf->Cell(40,5,$cilidros,0);

//resultados
$pdf->SetXY(139,$fila);
$pdf->Cell(40,5,'ul',0);

$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"ALBUMINA:",0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$albumina,0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'mg/dl',0);


////////////////////////////////////////////////////////////3º columna///////////////////////////////////////////////

$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"CRISTALES:",0);
//reticulos

$pdf->SetXY(127,$fila);
$pdf->Cell(40,5,$cristales,0);



$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"GLUCOSA:",0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$glucosa,0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'mg/dl',0);



$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"MOCO:",0);

//resultados
$pdf->SetXY(127,$fila);
$pdf->Cell(40,5,$moco,0);

$pdf->SetXY(139,$fila);
$pdf->Cell(40,5,$esc2,0);

//////////////////////////////////////////////////////////////4º COLUMNA//////////////////////////////////////


$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"CETONAS:",0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$cetonas,0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'mg/dl',0);


$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"LEVADURAS:",0);

//resultados
$pdf->SetXY(127,$fila);
$pdf->Cell(40,5,$levadura,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"PIGMENTOS BILIARES:",0);

//resultados
$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,$pigm_biliares ,0);

//$pdf->SetXY(203,$fila);
//$pdf->Cell(40,5,'mg/dl',0);

$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"BACTERIAS:",0);

//resultados
$pdf->SetXY(127,$fila);
$pdf->Cell(40,5,$bacterias,0);

$pdf->SetXY(135,$fila);
$pdf->Cell(40,5,$esc,0);

//////////////////////////////////////////////////5º columna///////////////////////////////////////////////////
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"SANGRE:",0);

//resultados
$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$sangre,0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'mg/dl',0);


$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"TRICOMONAS:",0);

//resultados
$pdf->SetXY(127,$fila);
$pdf->Cell(40,5,$tricomonas,0);



/////////////////////////////////////////////ULTIMA COLUMNA
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"UROBILINOGENO:",0);

//resultados
$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,$urobilinogeno,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"NITRITOS:",0);

//resultados
$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$nitritos,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"ESPERMATOZOIDES:",0);

//resultados
$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,$esp,0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"OTROS:",0);

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$con,0);


$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"OBSERVACIONES:",0);

//resultados
$pdf->SetXY(55,$fila);
$pdf->multiCell(150,5,$obervaciones,0,'J');
$fila=$pdf->gety();

}
}
//Impresion de inmunologia

$result9=mysql_query("SELECT `num_fac`,`inmu_rac`, `inmu_rau`, `inmu_pcc`, `inmu_pcu`, `inmu_asc`, `inmu_asu`, `inmu_tioc`, `inmu_tiou`, `inmu_tihc`, `inmu_tihu`, `inmu_pac`, `inmu_pau`, `inmu_pbc`,`inmu_pbu`,`inm_btc`, `inm_btu`, `inm_ptc`, `inm_ptu` FROM `labo_inm` where num_fac='$nume_fact'");
if(mysql_num_rows($result9)<>0)
{
while($rowx=mysql_fetch_array($result9))

{
	
	$inmu_rac=$rowx["inmu_rac"];
	$inmu_rau=$rowx["inmu_rau"];
	$inmu_pcc=$rowx["inmu_pcc"];
	$inmu_pcu=$rowx["inmu_pcu"];
	$inmu_asc=$rowx["inmu_asc"];
	$inmu_asu=$rowx["inmu_asu"];
	$inmu_tioc=$rowx["inmu_tioc"];
	$inmu_tiou=$rowx["inmu_tiou"];
	$inmu_tihc=$rowx["inmu_tihc"];
	$inmu_tihu=$rowx["inmu_tihu"];
	$inmu_pac=$rowx["inmu_pac"];
	$inmu_pau=$rowx["inmu_pau"];
	$inmu_pbc=$rowx["inmu_pbc"];
	$inmu_pbu=$rowx["inmu_pbu"];
	$inm_btc=$rowx["inm_btc"];
	$inm_btu=$rowx["inm_btu"];
	$inm_ptc=$rowx["inm_ptc"];
	$inm_ptu=$rowx["inm_ptu"];
	
			
//if de examenes Coprologicos
$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES INMUNOLOGICOS",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);


//////////////////////CARACTERISTICAS DE LOS EXAMENES DATOS COPROSCOPICOS


$fila=increm($fila+2,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'RA:',0);

//resultados

$pdf->SetXY(25,$fila);
$pdf->Cell(40,5,$inmu_rac,0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$inmu_rau,0);


$pdf->SetXY(55,$fila);
$pdf->Cell(40,5,'UI/ml',0);

//resultados

$pdf->SetXY(70,$fila);
$pdf->Cell(40,5,'PCR:',0);

$pdf->SetXY(82,$fila);
$pdf->Cell(40,5,$inmu_pcc,0);

$pdf->SetXY(105,$fila);
$pdf->Cell(40,5,$inmu_pcu,0);

$pdf->SetXY(118,$fila);
$pdf->Cell(40,5,'mg/L',0);

$pdf->SetXY(130,$fila);
$pdf->Cell(40,5,'ASTOS:',0);

$pdf->SetXY(150,$fila);
$pdf->Cell(40,5,$inmu_asc,0);

$pdf->SetXY(175,$fila);
$pdf->Cell(40,5,$inmu_asu,0);

/////////SEGUNDA FILA

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'ANTIGENOS FEBRILES:',0);

//resultados
$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Tifo O:' ,0);

$pdf->SetXY(30,$fila);
$pdf->Cell(40,5,$inmu_tioc,0);

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$inmu_tiou,0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'Tifo H:',0);

$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,$inmu_tihc,0);

$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,$inmu_tihu,0);

$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Paratifo A:',0);

$pdf->SetXY(38,$fila);
$pdf->Cell(40,5,$inmu_pac,0);

$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,$inmu_pau,0);


$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,'Paratifo B:',0);

$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,$inmu_pbc,0);

$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,$inmu_pbu,0);

$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Brucella abortus:',0);

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$inm_btc,0);

$pdf->SetXY(70,$fila);
$pdf->Cell(40,5,$inm_btu,0);

$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Proteus OX19:',0);


$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$inm_ptc,0);

$pdf->SetXY(70,$fila);
$pdf->Cell(40,5,$inm_ptu,0);

}
}

///impresion de bhc
$result10=mysql_query("SELECT `num_fac`, `lab_bhc` FROM `labo_bhc` where `num_fac`='$nume_fact'");
if(mysql_num_rows($result10)<>0)
{
while($rowa=mysql_fetch_array($result10))

{
	
	//$num_fac=$rowa["num_fac"];
	$lab_bhc=$rowa["lab_bhc"];
		
//if de examenes Coprologicos
$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES BHCG",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);


//////////////////////CARACTERISTICAS DE LOS EXAMENES DATOS COPROSCOPICOS


$fila=increm($fila+2,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Determinacion Cualitativa en suero de hormona Ganadotropina Canonica (HCG):',0);

//resultados
$fila=increm($fila+2,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,$lab_bhc,0);

//resultados

$pdf->SetXY(35,$fila);
$pdf->Cell(40,5,'mUI/ml ',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Nota: ',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Tecnica Microelisa rapida sensibilidad 25 mIU/ml',0);

}
}

///impresion de trimtropina
$result11=mysql_query("SELECT `num_fac`, `lab_trim` FROM `labo_tri` where num_fac='$nume_fact'");
if(mysql_num_rows($result11)<>0)
{
while($rowb=mysql_fetch_array($result11))

{
	
	$num_fac=$rowb["num_fac"];
	$lab_trim=$rowb["lab_trim"];
		
//if de examenes Coprologicos
$fila=increm($fila,$pdf);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES TRIPONINA I",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"_________________________________________________________________________________________",0);


//////////////////////CARACTERISTICAS DE LOS EXAMENES DATOS COPROSCOPICOS


$fila=increm($fila+2,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Triponima I : ',0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$lab_trim,0);

//resultados

$pdf->SetXY(70,$fila);
$pdf->Cell(40,5,'Sensibilidad 1 ng / ml  ',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Nota: ',0);

$fila=increm($fila,$pdf);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Tecnica Prueba Rapida de inmunocromotografia',0);

}
}

//impresion Examenes Varios ( 888)

$result12=mysql_query("SELECT `num_fac`, `fec_rec`, `fec_ent`, `cod_usu`, `cod_examvr`, `datos` FROM `dat_varios` where num_fac='$nume_fact'");
if(mysql_num_rows($result12)<>0)
{
while($rowc=mysql_fetch_array($result12))

{
	
	$num_fac=$rowc["num_fac"];
	$datos=$rowc["datos"];
	
	$fila=increm($fila,$pdf);

	$pdf->SetXY(15,$fila);
	$pdf->Cell(40,5,"_________________________________________________________________________________________",0);

	$fila=increm($fila+2,$pdf);
	$pdf->SetXY(80,$fila);
	$pdf->Cell(40,5,"EXAMENES CUADRO DE VARIOS",0);

	$pdf->SetXY(15,$fila);
	$pdf->Cell(40,5,"_________________________________________________________________________________________",0);
	
	$fila=increm($fila+2,$pdf);
	$pdf->SetXY(15,$fila);
	$pdf->Cell(40,5,'CARACTERISTICAS GENERALES - DATOS:',0);
	
	$fila=increm($fila,$pdf);
	
	//$a=substr($datos,0,150);

	  if($fil>=150)
  {
    $fil=35;
	$pdf->AddPage();
	$pdf->Image('imagenes\du.JPG',5,10,204,0,'','');
    $pdf->Image('imagenes\PIE1.JPG',5,254,204,0,'','');
    $pdf->Image('imagenes\CONTROLADO.JPG',150,235,0,15,'','');
  
  	$pdf->SetXY(15,$fila);
	$pdf->multiCell(200,5,$datos,0,1,'J');
  
  }
	else{
  	$pdf->SetXY(15,$fila);
	$pdf->multiCell(180,5,$datos,0,1,'J');
	}
	
	$tamaño=strlen($datos);
 $fin=40;
 $line=$tamaño/$fin;
	
	
}
}




//finalizacion
$fila=increm($fila,$pdf);
$fila=$pdf->GetY();
$fila=$fila+$line;
$pdf->SetXY(88,$fila+25);
$pdf->Cell(40,5,"______________________",0);

$fila=$pdf->GetY();
//$fila=increm($fila,$pdf);
$pdf->SetXY(90,$fila+5);
$pdf->Cell(40,5,"FIRMA BACTERIOLOGO",0);

unset($_SESSION['nume_fact']);

//$fila=$fila+4;


$pdf->Output();
?> 

 