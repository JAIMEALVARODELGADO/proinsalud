<?php
require('fpdf.php');
include('php/funciones.php');
include('php/conexion.php');

$pdf=new FPDF('P','mm','Letter');
$pdf->AddPage();

$pdf_=$pdf;
$fila_=0;
$formato='FRHOS-20';
$imaenca="../funciones_php/img/logo_encabezado.JPG";
include ('../funciones_php/formatos.php');
//$fila_=$fila_+3;

//$pdf->Image('img/encabezadotf.jpg',5,5,207,20,'','');
//$pdf->Image('img/pietf.png',5,265,207,10,'','');
$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(192);
$pdf->SetFillColor(216,216,216);

//Aqui consulto los datos de la usuaria y de la gestacion actual
$consulta="SELECT u.nrod_usu,concat(u.pnom_usu,' ',u.snom_usu,' ',u.pape_usu,' ',u.sape_usu) as nombre,u.sexo_usu,u.dire_usu,u.tres_usu,u.mres_usu,u.fnac_usu,u.regi_usu,
his.fecha_this,his.medrem_this,his.enfact_this,his.estfis_this,his.dxprinc_this,his.tpdxpr_this,his.calhum_this,his.crioter_this,his.contras_this,his.ultraso_this,his.estrasc_this,his.msedat_this,his.mdesco_this,his.pcasero_this,his.tecnic_this,his.sesion_this,his.codmedi_this,
serv.nomb_des,
con.neps_con
FROM ter_historia AS his
INNER JOIN usuario AS u ON u.codi_usu=his.codi_usu
INNER JOIN contrato AS con ON con.codi_con=his.cont_this
INNER JOIN destipos AS serv ON serv.codi_des=his.servrem_this
WHERE his.iden_this='$iden_this'";
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);

$fil_=25;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(80,5,"NUMERO DE IDENTIFICACION: ".$row[nrod_usu],1,0,'L');

$col_=$col_+82;
$pdf->SetXY($col_,$fil_);
$pdf->cell(20,5,"SEXO: ".$row[sexo_usu],1,0,'L');
$col_=$col_+22;
$pdf->SetXY($col_,$fil_);
$pdf->cell(103,5,"FECHA Y HORA DE ATENCION: ".$row[fecha_this],1,0,'L');

$fil_=$fil_+9;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(170,5,"NOMBRES Y APELLIDOS: ".$row[nombre],1,0,'L');
$col_=$col_+177;
$pdf->SetXY($col_,$fil_);
$unidad='';
$edad=calculaedad3($row[fnac_usu],$row[fecha_this],$unidad);
$pdf->cell(30,5,"EDAD: ".$edad." ".$unidad,1,0,'L');

$fil_=$fil_+9;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(207,5,"DIRECCION Y TELEFONO: ".$row[dire_usu]." - ".$row[tres_usu]." - ".$row[tel2_usu],1,0,'L');

$fil_=$fil_+9;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(125,5,"OCUPACION: ",1,0,'L');
$col_=$col_+127;
$pdf->SetXY($col_,$fil_);
$pdf->cell(80,5,"ASEGURADORA: ".$row[neps_con],1,0,'L');

$fil_=$fil_+11;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(125,5,"Del Servicio de: ".$row[nomb_des],0,0,'L');
$col_=$col_+125;
$pdf->SetXY($col_,$fil_);
$pdf->cell(82,5,"Dr: ".$row[medrem_this],0,0,'L');

$fil_=$fil_+6;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(125,5,"Resumen de Enfermedad Actual: ",0,0,'L');
$fil_=$fil_+6;
$pdf->SetXY($col_,$fil_);
$pdf->MultiCell(207,5,$row[enfact_this],1,'L','J');

$fil_=$pdf->GetY()+6;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(125,5,"Estado Fisico(Datos Positivos): ",0,0,'L');
$fil_=$fil_+6;
$pdf->SetXY($col_,$fil_);
$pdf->MultiCell(207,5,$row[estfis_this],1,'L','J');

$fil_=$pdf->GetY()+6;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(125,5,"Impresión Diagnóstica: ",0,0,'L');

$fil_=$fil_+6;
$pdf->SetXY($col_,$fil_);
$pdf->cell(12,5,'Código',1,0,'C');
$col_=$col_+12;
$pdf->cell(150,5,'Nombre',1,0,'C');
$col_=$col_+150;
$pdf->cell(44,5,'Tipo',1,0,'C');

$col_=5;
$fil_=$fil_+6;
$pdf->SetXY($col_,$fil_);
$pdf->cell(12,5,$row[dxprinc_this],1,0,'L');
$desdia=traedx($row[dxprinc_this]);
$col_=$col_+12;
$pdf->cell(150,5,$desdia,1,0,'L');
$desc=traetipdx($row[tpdxpr_this]);
$col_=$col_+150;
$pdf->cell(44,5,$desc,1,0,'L');

$consdxr="SELECT dxr.dxrel_dxh,cie.nom_cie10 FROM ter_dxhistoria AS dxr
    INNER JOIN cie_10 AS cie ON cie.cod_cie10=dxr.dxrel_dxh
    WHERE dxr.iden_this='$iden_this'";
$consdxr=mysql_query($consdxr);
if(mysql_num_rows($consdxr)<>0){
    while($rowcie=mysql_fetch_array($consdxr)){
        $fil_=$fil_+6;
        $col_=5;
        $pdf->SetXY($col_,$fil_);
        $pdf->cell(12,5,$rowcie[dxrel_dxh],1,0,'L');
        $col_=$col_+12;
        $pdf->cell(150,5,$rowcie[nom_cie10],1,0,'L');
    }
}

$fil_=$fil_+6;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(125,5,"Conducta: ",0,0,'L');
$fil_=$fil_+6;
$pdf->SetXY($col_,$fil_);
$pdf->cell(65,5,'1. Modalidades Físicas Convencionales: ',0,0,'L');
$col_=$col_+66;
$pdf->SetXY($col_,$fil_);
if($row[calhum_this]=='S'){
    $pdf->cell(4,5,'X',1,0,'L');}
else{
    $pdf->cell(4,5,' ',1,0,'L');}
$col_=$col_+5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(25,5,'Calor Húmedo',0,0,'L');

$col_=$col_+35;
$pdf->SetXY($col_,$fil_);
if($row[crioter_this]=='S'){
    $pdf->cell(4,5,'X',1,0,'L');}
else{
    $pdf->cell(4,5,' ',1,0,'L');}
$col_=$col_+5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(25,5,'Crioterápia',0,0,'L');

$col_=$col_+35;
$pdf->SetXY($col_,$fil_);
if($row[contras_this]=='S'){
    $pdf->cell(4,5,'X',1,0,'L');}
else{
    $pdf->cell(4,5,' ',1,0,'L');}
$col_=$col_+5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(25,5,'Contraste',0,0,'L');

$col_=5;
$fil_=$fil_+6;
$pdf->SetXY($col_,$fil_);
$pdf->cell(30,5,'2. Ultrasonido: ',0,0,'L');
$col_=$col_+25;
$pdf->SetXY($col_,$fil_);
if($row[ultraso_this]=='S'){
    $pdf->cell(4,5,'X',1,0,'L');}
else{
    $pdf->cell(4,5,' ',1,0,'L');}
$col_=$col_+15;
$pdf->SetXY($col_,$fil_);
if($row[ultraso_this]=='N'){
    $pdf->cell(4,5,'X',1,0,'L');}
else{
    $pdf->cell(4,5,' ',1,0,'L');}
$col_=$col_-11;
$pdf->SetXY($col_,$fil_);
$pdf->cell(5,5,'Si',0,0,'L');
$col_=$col_+15;
$pdf->SetXY($col_,$fil_);
$pdf->cell(5,5,'No',0,0,'L');

$col_=110;
$pdf->SetXY($col_,$fil_);
$pdf->cell(65,5,'3. Estimulación Nerviosa Transcutánea: ',0,0,'L');
$col_=$col_+66;
$pdf->SetXY($col_,$fil_);
if($row[estrasc_this]=='S'){
    $pdf->cell(4,5,'X',1,0,'L');}
else{
    $pdf->cell(4,5,' ',1,0,'L');}

$col_=$col_+15;
$pdf->SetXY($col_,$fil_);
if($row[estrasc_this]=='N'){
    $pdf->cell(4,5,'X',1,0,'L');}
else{
    $pdf->cell(4,5,' ',1,0,'L');}
$col_=$col_-11;
$pdf->SetXY($col_,$fil_);
$pdf->cell(5,5,'Si',0,0,'L');
$col_=$col_+15;
$pdf->SetXY($col_,$fil_);
$pdf->cell(5,5,'No',0,0,'L'); 


$col_=5;
$fil_=$fil_+6;
$pdf->SetXY($col_,$fil_);
$pdf->cell(20,5,'4. Masaje: ',0,0,'L');
$col_=$col_+25;
$pdf->SetXY($col_,$fil_);
if($row[msedat_this]=='S'){
    $pdf->cell(4,5,'X',1,0,'L');}
else{
    $pdf->cell(4,5,' ',1,0,'L');}
$col_=$col_+5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(20,5,'Sedativo',0,0,'L');

$col_=$col_+30;
$pdf->SetXY($col_,$fil_);
if($row[mdesco_this]=='S'){
    $pdf->cell(4,5,'X',1,0,'L');}
else{
    $pdf->cell(4,5,' ',1,0,'L');}
$col_=$col_+5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(30,5,'Descontracturante',0,0,'L');

$col_=110;
$pdf->SetXY($col_,$fil_);
$pdf->cell(30,5,'5. Plan Casero: ',0,0,'L');
$col_=$col_+31;
$pdf->SetXY($col_,$fil_);
if($row[pcasero_this]=='S'){
    $pdf->cell(4,5,'X',1,0,'L');}
else{
    $pdf->cell(4,5,' ',1,0,'L');}

$col_=$col_+15;
$pdf->SetXY($col_,$fil_);
if($row[pcasero_this]=='N'){
    $pdf->cell(4,5,'X',1,0,'L');}
else{
    $pdf->cell(4,5,' ',1,0,'L');}
$col_=$col_-11;
$pdf->SetXY($col_,$fil_);
$pdf->cell(5,5,'Si',0,0,'L');
$col_=$col_+15;
$pdf->SetXY($col_,$fil_);
$pdf->cell(5,5,'No',0,0,'L'); 

$fil_=$fil_+6;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(125,5,"Técnicas Especiales: ",0,0,'L');
$fil_=$fil_+6;
$pdf->SetXY($col_,$fil_);
$pdf->MultiCell(207,5,$row[tecnic_this],1,'L','J');

$fil_=$pdf->GetY()+6;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(125,5,"Número de Sesiones: ",0,0,'L');

$fil_=232;

$firma="../firmas/".$row[codmedi_this].".jpg";
if(file_exists($firma)){
  $pdf->Image($firma,30,$fil_,50,15,'','');

}



$fil_=$fil_+15;


$medico=trae_medico($row[codmedi_this]);

$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(80,5,$medico,0,0,'L');

$fil_=252;
$col_=5;
$pdf->Line($col_,$fil_,$col_+80,$fil_);
$col_=$col_+126;
$pdf->Line($col_,$fil_,$col_+80,$fil_);

$fil_=253;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(80,5,"NOMBRE, FIRMA DEL MEDICO " ,0,0,'C');
$col_=$col_+126;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(80,5,"Vo.Bo. AUTORIZADO",0,0,'C');

//*************************************************
//Aqui consulto la informacion del los controles
//Aqui consulto los datos de los controles
$consultatc="SELECT tc.fecha_tcon,tc.evolu_tcon,tc.obser_tcon,tc.codmedi_tcon,tc.proced_tcon
FROM ter_control AS tc
INNER JOIN ter_historia AS his ON his.iden_this=tc.iden_this
WHERE tc.iden_this='$iden_this' ORDER BY tc.fecha_tcon DESC";
$consultatc=mysql_query($consultatc);
while($rowtc=mysql_fetch_array($consultatc)){    
    $fil_=increfila($fil_,2,$pdf);
    $col_=5;
    $pdf->SetXY($col_,$fil_);
    $pdf->SetFont('Arial','',11);
    $pdf->cell(100,4,"EVOLUCION POR FISIOTERAPIA",1,0,'C',true);
    $pdf->SetFont('Arial','',8);
    $col_=$col_+104;
    $pdf->SetXY($col_,$fil_);    
    $pdf->cell(103,4,"FECHA Y HORA DE ATENCION: ".$rowtc[fecha_tcon],1,0,'L',true);

    $fil_=increfila($fil_,5,$pdf);
    $col_=5;
    $pdf->SetXY($col_,$fil_);
    $pdf->Cell(125,4,"EVOLUCION: ",0,0,'L');
    $fil_=increfila($fil_,4,$pdf);
    $pdf->SetXY($col_,$fil_);
    $pdf->MultiCell(207,4,$rowtc[evolu_tcon],1,'L','J');

    $fil_=$pdf->GetY();
    $fil_=increfila($fil_,2,$pdf);
    $col_=5;
    $pdf->SetXY($col_,$fil_);
    $pdf->Cell(125,4,"OBSERVACIONES: ",0,0,'L');
    $fil_=increfila($fil_,4,$pdf);
    $pdf->SetXY($col_,$fil_);
    $pdf->MultiCell(207,5,$rowtc[obser_tcon],1,'L','J');

    $medico=trae_medico($rowtc[codmedi_tcon]);
    $fil_=$pdf->GetY();
    $fil_=increfila($fil_,10,$pdf);
	
	$firma="../firmas/".$rowtc[codmedi_tcon].".jpg";
	if(file_exists($firma)){
	  $pdf->Image($firma,30,$fil_,50,15,'','');

	}



$fil_=$fil_+15;
	
	
    $col_=5;
    $pdf->SetXY($col_,$fil_);
    $pdf->Cell(80,5,$medico,0,0,'L');

    $fil_=increfila($fil_,5,$pdf);
    $col_=5;
    $pdf->Line($col_,$fil_,$col_+80,$fil_);
    $col_=$col_+126;
    $pdf->Line($col_,$fil_,$col_+80,$fil_);

    $fil_=increfila($fil_,1,$pdf);
    $col_=5;
    $pdf->SetXY($col_,$fil_);
    $pdf->Cell(80,5,"NOMBRE, FIRMA DEL MEDICO".$row[codmedi_tcon],0,0,'C');
    $col_=$col_+126;
    $pdf->SetXY($col_,$fil_);
    $pdf->Cell(80,5,"FIRMA DEL USUARIO",0,0,'C');
    $fil_=increfila($fil_,6,$pdf);
    $col_=5;
    $pdf->Line($col_,$fil_,$col_+206,$fil_);
    //$fil_=increfila($fil_,5,$pdf);
}
$pdf->Output();


function increfila($fila_,$incremento,&$pdf){
    $fila_=$fila_+$incremento;
    if($fila_>=250){    
        $pdf->AddPage();
		
		$pdf_=$pdf;
		$fila_=0;
		$formato='FRHOS-20';
		$imaenca="../funciones_php/img/logo_encabezado.JPG";
		include ('../funciones_php/formatos.php');
		//$fila_=$fila_+3;
		
        //$pdf->Image('img/encabezadotf.jpg',5,5,207,20,'','');
        //$pdf->Image('img/pietr.png',5,265,207,10,'','');
        $fila_=25;
    }   
    return($fila_);
}
?>
