<?php
include('php/funciones.php');
include('php/conexion.php');
//include('php/texto.php');
ob_end_clean();
include('fpdf.php');
function linea($col_,$fil_,$cant_,$car_,&$pdf)
{
  for($n=0;$n<$cant_;$n++){
    $pdf->SetXY($col_+$n,$fil_);
	$pdf->Cell(1,4,$car_,0);
  }
}

function cuadro($col1_,$fil1_,$col2_,$fil2_,&$pdf)
{
  for($n=$col1_;$n<$col2_;$n++){
    $pdf->SetXY($n,$fil1_);
	$pdf->Cell(1,3,'_',0);
  }
  for($n=$col1_;$n<$col2_;$n++){
    $pdf->SetXY($n,$fil2_);
	$pdf->Cell(1,3,'_',0);
  }
  for($n=$fil1_+2;$n<=$fil2_;$n++){
    $pdf->SetXY($col1_,$n);
	$pdf->Cell(1,3,'|',0);
  }
  for($n=$fil1_+2;$n<=$fil2_;$n++){
    $pdf->SetXY($col2_,$n);
	$pdf->Cell(1,3,'|',0);
  }
}

function imprecuadro($col_,$fil_,$texto_,&$pdf){
  $cols_=strlen($texto_);
  for($c_==0;$c_<$cols_;$c_++){
    $pdf->SetXY($col_,$fil_);
    $pdf->Cell(3,3,substr($texto_,$c_,1),1,4,'C');
    $col_=$col_+3;
  }
}



$pdf=new FPDF('P','mm','Letter');
$pdf->AddPage();
$consemp="SELECT * FROM empresa";
$consemp=mysql_query($consemp);
$rowemp=mysql_fetch_array($consemp);

$consulta="SELECT usu.codi_usu,usu.tdoc_usu,usu.nrod_usu,usu.pnom_usu,usu.snom_usu,usu.pape_usu,usu.sape_usu,usu.fnac_usu,usu.sexo_usu,usu.dire_usu,usu.tres_usu,usu.mres_usu,
    ef.nume_fac,mun.nomb_mun,
    rec.resp_rec,rec.radant_rec,rec.iden_fac,rec.nume_rec,rec.codi_usu,rec.cond_rec,rec.natu_rec,rec.desot_rec,rec.direoc_rec,rec.fechoc_rec,rec.horaoc_rec,rec.munioc_rec,rec.zonaoc_rec
    FROM fr_reclamacion AS rec
    INNER JOIN encabezado_factura AS ef ON ef.iden_fac=rec.iden_fac
    INNER JOIN usuario AS usu ON usu.codi_usu=rec.codi_usu
    INNER JOIN municipio AS mun ON mun.codi_mun=rec.munioc_rec
    WHERE rec.iden_rec='$iden_rec1'";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);


$pdf->Image('icons\FURIPSPAG1.JPG',15,10,185,250);

$pdf->SetFont('Arial','',7);
$fila=33;
if($row[resp_rec]<>''){    
    $pdf->SetXY(118,$fila);
    $pdf->Cell(4,4,"X",0,3,'R');
}
$fila=$fila+7;
$pdf->SetXY(45,$fila);
$pdf->Cell(20,4,$row[radant_rec],0,3,'L');

$pdf->SetXY(150,$fila);
$pdf->Cell(20,4,$row[nume_fac],0,3,'L');
$fila=$fila+9;
imprecuadro(40,$fila,$rowemp[razo_emp],$pdf);
$fila=$fila+4;
imprecuadro(40,$fila,$rowemp[codp_emp],$pdf);
imprecuadro(127,$fila,$rowemp[nite_emp],$pdf);
$fila=$fila+5;
imprecuadro(40,$fila,substr($rowemp[dire_emp],0,51),$pdf);
$fila=$fila+4;
imprecuadro(40,$fila,"NARIÑO",$pdf);
imprecuadro(127,$fila,"52",$pdf);
imprecuadro(152,$fila,$rowemp[tele_emp],$pdf);
$fila=$fila+4;
imprecuadro(40,$fila,"PASTO",$pdf);
imprecuadro(153,$fila,"001",$pdf);
$fila=$fila+8;
$pdf->SetXY(20,$fila);
$pdf->Cell(85,3,$row[pape_usu],1,3,'C');
$pdf->SetXY(114,$fila);
$pdf->Cell(82,3,$row[sape_usu],1,3,'C');
$fila=$fila+7;
$pdf->SetXY(20,$fila);
$pdf->Cell(85,3,$row[pnom_usu],1,3,'C');
$pdf->SetXY(114,$fila);
$pdf->Cell(82,3,$row[snom_usu],1,3,'C');
switch($row[tdoc_usu]){
    case 'CC':
        $col=50;
        break;
    case 'CE':
        $col=54;
        break;
    case 'PA':
        $col=58;
        break;
    case 'TI':
        $col=62;
        break;
    case 'RC':
        $col=67;
        break;
    case 'AS':
        $col=71;
        break;
    case 'MS':
        $col=75;
        break;        
}
$fila=$fila+6;
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
imprecuadro(127,$fila,$row[nrod_usu],$pdf);
$fila=$fila+5;
$fnac_usu=cambiafechadmy($row[fnac_usu]);
$fnac_usu=substr($fnac_usu,0,2).substr($fnac_usu,3,2).substr($fnac_usu,6,4);
imprecuadro(49,$fila,$fnac_usu,$pdf);
if($row[sexo_usu]=='F'){$col=107;}
else{$col=116;}
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
$fila=$fila+4;
imprecuadro(49,$fila,$row[dire_usu],$pdf);
$consdep="SELECT codi_mun,nomb_mun,depa_mun,nomb_dep
FROM municipio 
INNER JOIN departamento ON codi_dep=depa_mun
WHERE nomb_mun='$row[mres_usu]'";
$consdep=mysql_query($consdep);
$rowdep=mysql_fetch_array($consdep);
$mun=substr($rowdep[codi_mun],strlen($rowdep[depa_mun]),3);
$fila=$fila+4;
imprecuadro(40,$fila,$rowdep[nomb_dep],$pdf);
imprecuadro(132,$fila,$rowdep[depa_mun],$pdf);
imprecuadro(158,$fila,$row[tres_usu],$pdf);
$fila=$fila+5;
imprecuadro(40,$fila,$rowdep[nomb_mun],$pdf);
imprecuadro(132,$fila,$mun,$pdf);
switch($row[cond_rec]){
    case '1':
        $col=58;
        break;
    case '2':
        $col=88;
        break;
    case '3':
        $col=119;
        break;
    case '4':
        $col=154;
        break;
}
$fila=$fila+4;

//Datos del sitio donde ocurrio el evento
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
switch($row[natu_rec]){
    case '01':
        $col=62;
        $fila=$fila+13;
        break;
    case '02':
        $col=62;
        $fila=$fila+17;
        break;
    case '03':
        $col=93;
        $fila=$fila+17;
        break;
    case '04':
        $col=127;
        $fila=$fila+17;
        break;
    case '05':
        $col=127;
        $fila=$fila+21;
        break;
    case '06':
        $col=62;
        $fila=$fila+21;
        break;
    case '07':
        $col=93;
        $fila=$fila+21;
        break;
    case '08':
        $col=158;
        $fila=$fila+21;
        break;
    case '09':
        $col=62;
        $fila=$fila+26;
        break;
    case '10':
        $col=62;
        $fila=$fila+30;
        break;
    case '11':
        $col=158;
        $fila=$fila+26;
        break;
    case '12':
        $col=93;
        $fila=$fila+30;
        break;
    case '13':
        $col=62;
        $fila=$fila+26;
        break;    
    case '15':
        $col=127;
        $fila=$fila+26;
        break;    
    case '16':
        $col=158;
        $fila=$fila+17;
        break;
    case '17':
        $col=27;
        $fila=$fila+34;
        break;
}
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');

$fila=143;

$fila=$fila+4;
imprecuadro(53,$fila,$row[direoc_rec],$pdf);
$fechoc_rec=cambiafechadmy($row[fechoc_rec]);
$fechoc_rec=substr($fechoc_rec,0,2).substr($fechoc_rec,3,2).substr($fechoc_rec,6,4);
$fila=$fila+5;
imprecuadro(53,$fila,$fechoc_rec,$pdf);
imprecuadro(118,$fila,$row[horaoc_rec],$pdf);

$consdep="SELECT codi_mun,nomb_mun,depa_mun,nomb_dep
FROM municipio 
INNER JOIN departamento ON codi_dep=depa_mun
WHERE codi_mun='$row[munioc_rec]'";
$consdep=mysql_query($consdep);
$rowdep=mysql_fetch_array($consdep);
$mun=substr($rowdep[codi_mun],strlen($rowdep[depa_mun]),3);
$fila=$fila+4;
imprecuadro(40,$fila,$rowdep[nomb_dep],$pdf);
imprecuadro(132,$fila,$rowdep[depa_mun],$pdf);
$fila=$fila+4;
imprecuadro(40,$fila,$rowdep[nomb_mun],$pdf);
imprecuadro(132,$fila,$mun,$pdf);
if($row[zonaoc_rec]=='U'){$col=163;}
else{$col=172;}
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');

$fila=$fila+11;
$pdf->SetXY(15,$fila);
$pdf->MultiCell(185,3,$row[desot_rec],0,'J');
//imprecuadro(36,$fila,$row[desot_rec],$pdf);


//Datos del vehiculo
$consveh="SELECT veh.iden_veh,veh.iden_rec,veh.estase_veh,veh.marca_veh,veh.placa_veh,veh.tipo_veh,veh.codi_con,veh.poliza_veh,veh.finipol_veh,veh.ffinpol_veh,veh.inter_veh,veh.exced_veh,veh.placaseg_veh,veh.tdocseg_veh,veh.ndocseg_veh,veh.placater_veh,veh.tdocter_veh,veh.ndocter_veh,
con.codase_con,con.neps_con
FROM fr_vehiculo AS veh 
INNER JOIN contrato AS con ON con.codi_con=veh.codi_con
WHERE iden_rec='$iden_rec1'";
//echo $consveh;
$consveh=mysql_query($consveh);
$rowveh=mysql_fetch_array($consveh);
$finipol_veh='';
$ffinpol_veh='';
if($rowveh[finipol_veh]<>'0000-00-00'){$finipol_veh=cambiafechadmy($rowveh[finipol_veh]);}
if($rowveh[ffinpol_veh]<>'0000-00-00'){$ffinpol_veh=cambiafechadmy($rowveh[ffinpol_veh]);}
switch($rowveh[estase_veh]){
    case '1':
        $col=67;
        break;
    case '2':
        $col=93;
        break;
    case '3':
        $col=123;
        break;
    case '4':
        $col=145;
        break;
    case '5':
        $col=171;
        break;    
}
$fila=$fila+20;
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
$fila=$fila+4;
$pdf->SetXY(23,$fila);
$pdf->Cell(80,3,$rowveh[marca_veh],1,3,'L');
imprecuadro(136,$fila,$rowveh[placa_veh],$pdf);
switch($rowveh[tipo_veh]){
    case '3':
        $col=54;
        $fila=$fila+5;
        break;
    case '4':
        $col=72;
        $fila=$fila+5;
        break;
    case '5':
        $col=88;
        $fila=$fila+5;
        break;
    case '6':
        $col=123;
        $fila=$fila+5;
        break;
    case '7':
        $col=180;
        $fila=$fila+5;
        break;
    case '8':
        $col=76;
        $fila=$fila+9;
        break;
    case '9':
        $col=106;
        $fila=$fila+9;
        break;
}
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
$fila=208;
$pdf->SetXY(53,$fila);
$pdf->Cell(105,3,$rowveh[neps_con],1,3,'L');
$fila=$fila+5;
imprecuadro(36,$fila,$rowveh[poliza_veh],$pdf);
if($rowveh[inter_veh]=='1'){$col=175;}
else{$col=193;}
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
$finipol_veh=substr($finipol_veh,0,2).substr($finipol_veh,3,2).substr($finipol_veh,6,4);
$ffinpol_veh=substr($ffinpol_veh,0,2).substr($ffinpol_veh,3,2).substr($ffinpol_veh,6,4);
$fila=$fila+4;
imprecuadro(36,$fila,$finipol_veh,$pdf);
imprecuadro(79,$fila,$ffinpol_veh,$pdf);
if($rowveh[exced_veh]=='1'){$col=175;}
else{$col=193;}
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');

//Datos del propietario del vehiculo
$conspro="SELECT tdoc_pro,ndoc_pro,pape_pro,sape_pro,pnom_pro,snom_pro,dire_pro,tele_pro,mres_pro
FROM fr_propietario 
WHERE iden_rec='$iden_rec1'";
$conspro=mysql_query($conspro);
$rowpro=mysql_fetch_array($conspro);
$fila=$fila+8;
$pdf->SetXY(19,$fila);
$pdf->Cell(85,3,$rowpro[pape_pro],1,3,'L');
$pdf->SetXY(114,$fila);
$pdf->Cell(85,3,$rowpro[sape_pro],1,3,'L');
$fila=$fila+6;
$pdf->SetXY(19,$fila);
$pdf->Cell(85,3,$rowpro[pnom_pro],1,3,'L');
$pdf->SetXY(114,$fila);
$pdf->Cell(85,3,$rowpro[snom_pro],1,3,'L');
switch($rowpro[tdoc_pro]){
    case 'CC':
        $col=50;
        break;
    case 'CE':
        $col=55;
        break;
    case 'PA':
        $col=59;
        break;
    case 'NI':
        $col=63;
        break;
    case 'TI':
        $col=67;
        break;
    case 'RC':
        $col=71;
        break;    
}
$fila=$fila+7;
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
imprecuadro(127,$fila,$rowpro[ndoc_pro],$pdf);
$fila=$fila+4;
imprecuadro(49,$fila,$rowpro[dire_pro],$pdf);
$consdep="SELECT codi_mun,nomb_mun,depa_mun,nomb_dep
FROM municipio 
INNER JOIN departamento ON codi_dep=depa_mun
WHERE codi_mun='$rowpro[mres_pro]'";
$consdep=mysql_query($consdep);
$rowdep=mysql_fetch_array($consdep);
$mun=substr($rowdep[codi_mun],strlen($rowdep[depa_mun]),3);
$fila=$fila+5;
imprecuadro(45,$fila,$rowdep[nomb_dep],$pdf);
imprecuadro(127,$fila,$rowdep[depa_mun],$pdf);
imprecuadro(153,$fila,$rowpro[tele_pro],$pdf);
$fila=$fila+4;
imprecuadro(45,$fila,$rowdep[nomb_mun],$pdf);
imprecuadro(127,$fila,$mun,$pdf);

//Datos de la atencion
$consate="SELECT aten.fecing_ate,aten.horing_ate,aten.fecsal_ate,aten.horsa_ate,aten.diapri_ate,aten.diaas1_ate,aten.diaas2_ate,aten.dxprieg_ate,aten.dxaseg1_ate,aten.dxaseg2_ate,aten.cod_medi,aten.totfac_ate,aten.totrec_ate,aten.totftra_ate,aten.totrtra_ate,aten.foli_ate,
med.pnom_medi,med.snom_medi,med.pape_medi,med.sape_medi,med.tido_medi,med.ced_medi,med.reg_medi
FROM fr_atencion AS aten
INNER JOIN medicos AS med ON med.cod_medi=aten.cod_medi
WHERE iden_rec='$iden_rec1'";
//echo $consate;
$consate=mysql_query($consate);
$rowate=mysql_fetch_array($consate);
$fila=$fila+5;
imprecuadro(183,$fila,$rowate[foli_ate],$pdf);

//---------Segunda pagina
$pdf->AddPage();
$pdf->Image('icons\FURIPSPAG2.JPG',15,10,185,250);

//Datos del conductor
$conscdtor="SELECT pape_con,sape_con,pnom_con,snom_con,tdoc_con,ndoc_con,dire_con,muni_con,tele_con
FROM fr_conductor WHERE iden_rec='$iden_rec1'";
$conscdtor=mysql_query($conscdtor);
$rowcdtor=mysql_fetch_array($conscdtor);
$fila=33;
$pdf->SetXY(20,$fila);
$pdf->Cell(80,3,$rowcdtor[pape_con],1,3,'L');
$pdf->SetXY(115,$fila);
$pdf->Cell(80,3,$rowcdtor[sape_con],1,3,'L');
$fila=$fila+7;
$pdf->SetXY(20,$fila);
$pdf->Cell(80,3,$rowcdtor[pnom_con],1,3,'L');
$pdf->SetXY(115,$fila);
$pdf->Cell(80,3,$rowcdtor[snom_con],1,3,'L');
switch($rowcdtor[tdoc_con]){
    case 'CC':
        $col=49;
        break;
    case 'CE':
        $col=54;
        break;
    case 'PA':
        $col=59;
        break;
    case 'TI':
        $col=63;
        break;
    case 'RC':
        $col=67;
        break;
    case 'AS':
        $col=71;
        break;    
}
$fila=$fila+6;
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
imprecuadro(127,$fila,$rowcdtor[ndoc_con],$pdf);
$fila=$fila+5;
imprecuadro(49,$fila,$rowcdtor[dire_con],$pdf);

$consdep="SELECT codi_mun,nomb_mun,depa_mun,nomb_dep
FROM municipio 
INNER JOIN departamento ON codi_dep=depa_mun
WHERE codi_mun='$rowcdtor[muni_con]'";
$consdep=mysql_query($consdep);
$rowdep=mysql_fetch_array($consdep);
$mun=substr($rowdep[codi_mun],strlen($rowdep[depa_mun]),3);
$fila=$fila+5;
imprecuadro(45,$fila,$rowdep[nomb_dep],$pdf);
imprecuadro(127,$fila,$rowdep[depa_mun],$pdf);
imprecuadro(153,$fila,$rowcdtor[tele_con],$pdf);
$fila=$fila+4;
imprecuadro(45,$fila,$rowdep[nomb_mun],$pdf);
imprecuadro(153,$fila,$mun,$pdf);

//Datos de la remision
$consrem="SELECT tipo_rem,fech_rem,hsal_rem,nomb_rem,cargo_rem,ipsrec_rem,direips_rem,fing_rem,hing_rem,nomrec_rem,carrec_rem,munrec_rem
FROM fr_remision
WHERE iden_rec='$iden_rec1'";
//echo $consrem;
$consrem=mysql_query($consrem);
if(mysql_num_rows($consrem)<>0){
    $rowrem=mysql_fetch_array($consrem);
    $fech_rem='';
    $fing_rem='';
    if($rowrem[fech_rem]<>'0000-00-00' and $rowrem[fech_rem]<>''){$fech_rem=cambiafechadmy($rowrem[fech_rem]);}
    if($rowrem[fing_rem]<>'0000-00-00' and $rowrem[fing_rem]<>''){$fing_rem=cambiafechadmy($rowrem[fing_rem]);}
    $fila=$fila+9;
    $fech_rem=substr($fech_rem,0,2).substr($fech_rem,3,2).substr($fech_rem,6,4);
    imprecuadro(45,$fila,$fech_rem,$pdf);
    $fila=$fila+5;
    imprecuadro(45,$fila,$rowemp[razo_emp],$pdf);
    $fila=$fila+4;
    imprecuadro(45,$fila,$rowrem[nomb_rem],$pdf);
    imprecuadro(140,$fila,$rowrem[cargo_rem],$pdf);
    $fila=$fila+5;
    imprecuadro(45,$fila,substr($rowemp[dire_emp],0,51),$pdf);
    $fila=$fila+4;
    imprecuadro(45,$fila,"NARIÑO",$pdf);
    imprecuadro(127,$fila,"52",$pdf);
    imprecuadro(152,$fila,$rowemp[tele_emp],$pdf);
    $fila=$fila+5;
    imprecuadro(45,$fila,"PASTO",$pdf);
    imprecuadro(127,$fila,"001",$pdf);
    $fila=$fila+4;
    $fing_rem=substr($fing_rem,0,2).substr($fing_rem,3,2).substr($fing_rem,6,4);
    imprecuadro(45,$fila,$fing_rem,$pdf);
    $fila=$fila+5;
    imprecuadro(45,$fila,$rowrem[ipsrec_rem],$pdf);
    $fila=$fila+5;
    imprecuadro(45,$fila,$rowrem[nomrec_rem],$pdf);
    imprecuadro(140,$fila,$rowrem[carrec_rem],$pdf);
    $fila=$fila+4;
    imprecuadro(45,$fila,$rowrem[direips_rem],$pdf);

    $consdep="SELECT codi_mun,nomb_mun,depa_mun,nomb_dep
    FROM municipio 
    INNER JOIN departamento ON codi_dep=depa_mun
    WHERE codi_mun='$rowrem[munrec_rem]'";
    $consdep=mysql_query($consdep);
    $rowdep=mysql_fetch_array($consdep);
    $mun=substr($rowdep[codi_mun],strlen($rowdep[depa_mun]),3);
    $fila=$fila+5;
    imprecuadro(45,$fila,$rowdep[nomb_dep],$pdf);
    imprecuadro(127,$fila,$rowdep[depa_mun],$pdf);
    //imprecuadro(153,$fila,$rowrem[telrec_rem],$pdf);
    $fila=$fila+4;
    imprecuadro(45,$fila,$rowdep[nomb_mun],$pdf);
    imprecuadro(153,$fila,$mun,$pdf);
}

$fila=119;
//echo $fila;
//Datos del traslado
$constra="SELECT tdoc_tra,ndoc_tra,pape_tra,sape_tra,pnom_tra,snom_tra,placa_tra,recini_tra,recfin_tra,tipser_tra,zona_tra
FROM fr_transporte
WHERE iden_rec='$iden_rec1'";
//echo $constra;
$constra=mysql_query($constra);
if(mysql_num_rows($constra)){
    $rowtra=mysql_fetch_array($constra);
    $fila=$fila+13;
    imprecuadro(66,$fila,$rowtra[placa_tra],$pdf);
    $fila=$fila+8;
    $pdf->SetXY(19,$fila);
    $pdf->Cell(80,3,$rowtra[pape_tra],1,3,'L');
    $pdf->SetXY(115,$fila);
    $pdf->Cell(80,3,$rowtra[sape_tra],1,3,'L');
    $fila=$fila+7;
    $pdf->SetXY(19,$fila);
    $pdf->Cell(80,3,$rowtra[pnom_tra],1,3,'L');
    $pdf->SetXY(115,$fila);
    $pdf->Cell(80,3,$rowtra[snom_tra],1,3,'L');
    switch($rowtra[tdoc_tra]){
        case 'CC':
            $col=49;
            break;
        case 'CE':
            $col=54;
            break;
        case 'PA':
            $col=59;
            break;
    }
    $fila=$fila+6;
    $pdf->SetXY($col,$fila);
    $pdf->Cell(3,3,"X",0,3,'C');
    imprecuadro(127,$fila,$rowtra[ndoc_tra],$pdf);
    $fila=$fila+5;
    imprecuadro(45,$fila,$rowtra[recini_tra],$pdf);
    imprecuadro(131,$fila,$rowtra[recfin_tra],$pdf);
    if($rowtra[tipser_tra]=='1'){$col=67;}
    else{$col=102;}
    $fila=$fila+5;
    $pdf->SetXY($col,$fila);
    $pdf->Cell(3,3,"X",0,3,'C');
    if($rowtra[zona_tra]=='U'){$col=167;}
    else{$col=176;}
    $pdf->SetXY($col,$fila);
    $pdf->Cell(3,3,"X",0,3,'C');
}

//Datos de la atencion
//$fila=$fila+9;
$fila=172;
$fecing_ate=cambiafechadmy($rowate[fecing_ate]);
$fecing_ate=substr($fecing_ate,0,2).substr($fecing_ate,3,2).substr($fecing_ate,6,4);
$fecsal_ate=cambiafechadmy($rowate[fecsal_ate]);
$fecsal_ate=substr($fecsal_ate,0,2).substr($fecsal_ate,3,2).substr($fecsal_ate,6,4);
imprecuadro(35,$fila,$fecing_ate,$pdf);
imprecuadro(84,$fila,$rowate[horing_ate],$pdf);
imprecuadro(131,$fila,$fecsal_ate,$pdf);
imprecuadro(179,$fila,$rowate[horsa_ate],$pdf);
$fila=$fila+4;
imprecuadro(54,$fila,$rowate[diapri_ate],$pdf);
imprecuadro(153,$fila,$rowate[dxprieg_ate],$pdf);
$fila=$fila+5;
imprecuadro(54,$fila,$rowate[diaas1_ate],$pdf);
imprecuadro(153,$fila,$rowate[dxaseg1_ate],$pdf);
$fila=$fila+4;
imprecuadro(54,$fila,$rowate[diaas2_ate],$pdf);
imprecuadro(153,$fila,$rowate[dxaseg2_ate],$pdf);
$fila=$fila+9;
$pdf->SetXY(19,$fila);
$pdf->Cell(80,3,$rowate[pnom_medi],1,3,'L');
$pdf->SetXY(114,$fila);
$pdf->Cell(80,3,$rowate[snom_medi],1,3,'L');
$fila=$fila+6;
$pdf->SetXY(19,$fila);
$pdf->Cell(80,3,$rowate[pape_medi],1,3,'L');
$pdf->SetXY(114,$fila);
$pdf->Cell(80,3,$rowate[sape_medi],1,3,'L');
switch($rowate[tido_medi]){
    case 'CC':
        $col=49;
        break;
    case 'CE':
        $col=54;
        break;
    case 'PA':
        $col=59;
        break;
}
$fila=$fila+7;
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
imprecuadro(127,$fila,$rowate[ced_medi],$pdf);
$fila=$fila+5;
imprecuadro(127,$fila,$rowate[reg_medi],$pdf);
$fila=$fila+16;
$pdf->SetXY(92,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
$pdf->SetXY(110,$fila);
$pdf->Cell(25,3,$rowate[totfac_ate],0,3,'R');
$pdf->SetXY(140,$fila);
$pdf->Cell(25,3,$rowate[totrec_ate],0,3,'R');
$fila=$fila+3;
$pdf->SetXY(92,$fila);
/*$pdf->Cell(3,3,"X",0,3,'C');
$pdf->SetXY(110,$fila);
$pdf->Cell(25,3,$rowate[totftra_ate],0,3,'R');
$pdf->SetXY(140,$fila);
$pdf->Cell(25,3,$rowate[totrtra_ate],0,3,'R');*/
$fila=$fila+21;
$pdf->SetXY(20,$fila);
$pdf->Cell(60,3,"JAIME ALBERTO ARTEAGA CORAL",0,3,'L');

$pdf->Output();
 
mysql_free_result($consulta);
mysql_free_result($consemp);
mysql_free_result($consdep);
mysql_free_result($consveh);
mysql_free_result($conspro);
mysql_free_result($consate);
mysql_free_result($conscdtor);
mysql_free_result($consrem);
mysql_free_result($constra);
mysql_close();

?> 