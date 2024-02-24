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

$consulta="SELECT rec.radant_rec,rec.resp_rec,rec.tipeve_rec,rec.dire_rec,rec.muni_rec,rec.zona_rec,rec.fectra_rec,rec.hortra_rec,rec.codips_rec,rec.totfol_rec
    FROM ft_reclamacion AS rec
    WHERE rec.iden_rec='$iden_rec1'";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);

$pdf->Image('icons\FURTRAN.JPG',15,10,185,250);

$pdf->SetFont('Arial','',7);
$fila=26;
if($row[resp_rec]<>''){    
    $pdf->SetXY(111,$fila);
    $pdf->Cell(4,4,"X",0,3,'R');
}
$pdf->SetXY(45,$fila);
$pdf->Cell(20,4,$row[radant_rec],0,3,'L');

$fila=$fila+14;
$pdf->SetXY(71,$fila);
$pdf->Cell(120,3,$rowemp[razo_emp],1,3,'L');
$fila=$fila+4;
imprecuadro(71,$fila,$rowemp[codp_emp],$pdf);
$fila=$fila+22;
$pdf->SetXY(103,$fila);
$pdf->Cell(4,4,"X",0,3,'R');
$fila=$fila+8;
imprecuadro(51,$fila,'AAK059',$pdf);
$fila=$fila+5;
$pdf->SetXY(76,$fila);
$pdf->Cell(120,3,$rowemp[dire_emp],1,3,'L');
$fila=$fila+4;
imprecuadro(58,$fila,$rowemp[tele_emp],$pdf);
$fila=$fila+4;
imprecuadro(38,$fila,'NARIÑO',$pdf);
imprecuadro(132,$fila,'52',$pdf);
$fila=$fila+5;
imprecuadro(38,$fila,'PASTO',$pdf);
imprecuadro(148,$fila,'001',$pdf);
$fila=$fila+19;
$consultavic="SELECT vic.tdoc_vic,vic.ndoc_vic,vic.pnom_vic,vic.snom_vic,vic.pape_vic,vic.sape_vic
    FROM ft_victima AS vic 
    WHERE vic.iden_rec='$iden_rec1'";
$consultavic=mysql_query($consultavic);
$cont_=1;
while($rowvic=mysql_fetch_array($consultavic)){
    $pdf->SetXY(16,$fila);
    $pdf->Cell(2,3,$cont_,0,3,'C');    
    $pdf->SetXY(19,$fila);
    $pdf->Cell(6,3,$rowvic[tdoc_vic],1,3,'L');
    imprecuadro(28,$fila,$rowvic[ndoc_vic],$pdf);
    $pdf->SetXY(68,$fila);
    $pdf->Cell(30,3,$rowvic[pnom_vic],1,3,'L');
    $pdf->SetXY(100,$fila);
    $pdf->Cell(30,3,$rowvic[snom_vic],1,3,'L');
    $pdf->SetXY(133,$fila);
    $pdf->Cell(30,3,$rowvic[pape_vic],1,3,'L');
    $pdf->SetXY(165,$fila);
    $pdf->Cell(30,3,$rowvic[sape_vic],1,3,'L');
    $fila=$fila+4;
    $cont_++;
}

$fila=138;
imprecuadro(30,$fila,$row[dire_rec],$pdf);

$consdep="SELECT codi_mun,nomb_mun,depa_mun,nomb_dep
FROM municipio 
INNER JOIN departamento ON codi_dep=depa_mun
WHERE codi_mun='$row[muni_rec]'";
$consdep=mysql_query($consdep);
$rowdep=mysql_fetch_array($consdep);
$mun=substr($rowdep[codi_mun],strlen($rowdep[depa_mun]),3);
$fila=$fila+5;
imprecuadro(30,$fila,$rowdep[nomb_dep],$pdf);
imprecuadro(136,$fila,$rowdep[depa_mun],$pdf);
if($row[zona_rec]=='U'){
    $col=161;}
else{
    $col=169;}
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,'X',0,3,'C');
$fila=$fila+4;
imprecuadro(30,$fila,$rowdep[nomb_mun],$pdf);
imprecuadro(136,$fila,$mun,$pdf);
$fectra_rec=cambiafechadmy($row[fectra_rec]);
$fectra_rec=substr($fectra_rec,0,2).substr($fectra_rec,3,2).substr($fectra_rec,6,4);
$fila=$fila+15;
imprecuadro(27,$fila,$fectra_rec,$pdf);
imprecuadro(75,$fila,$row[hortra_rec],$pdf);
$fila=$fila+4;
imprecuadro(59,$fila,$rowemp[razo_emp],$pdf);
$fila=$fila+4;
imprecuadro(31,$fila,$rowemp[nite_emp],$pdf);
imprecuadro(144,$fila,$rowemp[codp_emp],$pdf);
$fila=$fila+5;
imprecuadro(31,$fila,SUBSTR($rowemp[dire_emp],0,28),$pdf);
$fila=$fila+4;
imprecuadro(31,$fila,'NARIÑO',$pdf);
imprecuadro(128,$fila,'52',$pdf);
imprecuadro(152,$fila,SUBSTR($rowemp[tele_emp],0,7),$pdf);
$fila=$fila+4;
imprecuadro(31,$fila,'PASTO',$pdf);
imprecuadro(144,$fila,'001',$pdf);
$fila=$fila+26;
$pdf->SetXY(20,$fila);
$pdf->Cell(60,3,"JAIME ALBERTO ARTEAGA CORAL",0,3,'L');
$fila=$fila+46;
imprecuadro(184,$fila,$row[totfol_rec],$pdf);

$pdf->Output();
mysql_free_result($consulta);
mysql_close();
?> 