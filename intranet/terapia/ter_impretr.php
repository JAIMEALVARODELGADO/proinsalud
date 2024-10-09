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
/*
$pdf->Image('img/encabezadotr.jpg',5,5,207,20,'','');
$pdf->Image('img/pietr.png',5,265,207,10,'','');
*/
$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(192);
$pdf->SetFillColor(216,216,216);   

//Aqui consulto los datos de la usuaria y de la gestacion actual
$consulta="SELECT u.codi_usu,u.nrod_usu,concat(u.pnom_usu,' ',u.snom_usu,' ',u.pape_usu,' ',u.sape_usu) as nombre,u.sexo_usu,u.dire_usu,u.tres_usu,u.mres_usu,u.fnac_usu,u.regi_usu,
tre.fecha_tre,tre.tipo_tre,tre.antper_tre,tre.ayudxant_tre,tre.descayu_tre,tre.dxprinc_tre,tre.tpdxpr_tre,tre.cexter_tre,tre.ambit_tre,tre.fcard_tre,tre.fres_tre,tre.satur_tre,tre.eval_tre,tre.sesion_tre,tre.tratam_tre,tre.obse_tre,tre.resp_tre,tre.codmedi_tre,
con.neps_con
FROM tres_historia AS tre
INNER JOIN usuario AS u ON u.codi_usu=tre.codi_usu
INNER JOIN contrato AS con ON con.codi_con=tre.cont_tre
WHERE tre.iden_tre='$iden_tre'";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);

$fil_=27;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(80,5,"NUMERO DE IDENTIFICACION: ".$row[nrod_usu],1,0,'L');

$col_=$col_+82;
$pdf->SetXY($col_,$fil_);
$pdf->cell(20,5,"SEXO: ".$row[sexo_usu],1,0,'L');
$col_=$col_+22;
$pdf->SetXY($col_,$fil_);
$pdf->cell(103,5,"FECHA Y HORA DE ATENCION: ".$row[fecha_tre],1,0,'L');

$fil_=$fil_+9;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(170,5,"NOMBRES Y APELLIDOS: ".$row[nombre],1,0,'L');
$col_=$col_+177;
$pdf->SetXY($col_,$fil_);
$unidad='';
$edad=calculaedad3($row[fnac_usu],$row[fecha_tre],$unidad);
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

$fil_=$fil_+10;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(125,5,"ANTECEDENTES PERSONALES: ",0,0,'L');
$fil_=$fil_+5;
$pdf->SetXY($col_,$fil_);
$pdf->MultiCell(207,4,$row[antper_tre],1,'L','J');

$fil_=$pdf->GetY()+2;
$ayuda=trae_est($row[ayudxant_tre]);
$pdf->SetXY($col_,$fil_);
$pdf->Cell(70,5,"AYUDAS DIAGNOSTICAS ANTERIORES: ",0,0,'L');
$col_=$col_+72;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(18,5,$ayuda,1,0,'L');

$fil_=$fil_+6;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->MultiCell(207,4,$row[descayu_tre],1,'L','J');

$fil_=$pdf->GetY()+2;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(125,5,"DIAGNOSTICO: ",0,0,'L');

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
$pdf->cell(12,5,$row[dxprinc_tre],1,0,'L');
$desdia=traedx($row[dxprinc_tre]);
$col_=$col_+12;
$pdf->cell(150,5,$desdia,1,0,'L');
$desc=traetipdx($row[tpdxpr_tre]);
$col_=$col_+150;
$pdf->cell(44,5,$desc,1,0,'L');

$consdxr="SELECT dxr.dxrel_trdxh,cie.nom_cie10 FROM tres_dxhistoria AS dxr
    INNER JOIN cie_10 AS cie ON cie.cod_cie10=dxr.dxrel_trdxh
    WHERE dxr.iden_tre='$iden_tre'";
$consdxr=mysql_query($consdxr);
if(mysql_num_rows($consdxr)<>0){
    while($rowcie=mysql_fetch_array($consdxr)){
        $fil_=$fil_+6;
        $col_=5;
        $pdf->SetXY($col_,$fil_);
        $pdf->cell(12,5,$rowcie[dxrel_trdxh],1,0,'L');
        $col_=$col_+12;
        $pdf->cell(150,5,$rowcie[nom_cie10],1,0,'L');
    }
}

$fil_=$fil_+6;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(60,5,"EXAMEN FISICO RESPIRATORIO: ",0,0,'L');
$col_=$col_+70;
$pdf->SetXY($col_,$fil_);
$pdf->cell(9,5,'FC= ',0,0,'L');
$col_=$col_+9;
$pdf->SetXY($col_,$fil_);
$pdf->cell(9,5,$row[fcard_tre],1,0,'L');
$col_=$col_+20;
$pdf->SetXY($col_,$fil_);
$pdf->cell(9,5,'FR= ',0,0,'L');
$col_=$col_+9;
$pdf->SetXY($col_,$fil_);
$pdf->cell(9,5,$row[fres_tre],1,0,'L');
$col_=$col_+20;
$pdf->SetXY($col_,$fil_);
$pdf->cell(31,5,'Saturación de O2= ',0,0,'L');
$col_=$col_+31;
$pdf->SetXY($col_,$fil_);
$pdf->cell(12,5,$row[satur_tre].'%',1,0,'L');

$fil_=$fil_+6;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(31,5,'EVALUACION:',0,0,'L');
$fil_=$fil_+6;
$pdf->SetXY($col_,$fil_);
$pdf->MultiCell(207,4,$row[eval_tre],1,'L','J');

$fil_=$pdf->GetY()+2;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(31,5,'TRATAMIENTO:',0,0,'L');
$fil_=$fil_+6;
$pdf->SetXY($col_,$fil_);
$pdf->cell(15,5,'Código',1,0,'C');
$col_=$col_+12;
$pdf->cell(192,5,'Descripción',1,0,'C');

$fil_=$fil_+6;
$col_=5;
$pdf->SetXY($col_,$fil_);
$codi_cup='';
$desc=trae_cups($row[tratam_tre],$codi_cup);

//$pdf->cell(15,5,$row[tratam_tre],0,0,'C');
$pdf->cell(15,5,$codi_cup,0,0,'C');

$col_=$col_+15;
$pdf->SetFont('Arial','',7);
$pdf->MultiCell(192,4,$desc,1,'L','J');
$pdf->SetFont('Arial','',9);

$fil_=$pdf->GetY()+2;
//$fil_=$fil_+6;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(31,5,'OBSERVACIONES:',0,0,'L');
$fil_=$fil_+6;
$pdf->SetXY($col_,$fil_);
$pdf->MultiCell(207,4,$row[obse_tre],1,'L','J');

$fil_=$pdf->GetY()+2;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->cell(31,5,'RESPUESTA AL TRATAMIENTO:',0,0,'L');
$fil_=$fil_+6;
$pdf->SetXY($col_,$fil_);
$pdf->MultiCell(207,4,$row[resp_tre],1,'L','J');

$fil_=$pdf->GetY()+2;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(125,5,"Número de Sesiones: ".$row[sesion_tre],0,0,'L');

$medico=trae_medico($row[codmedi_tre]);
$fil_=$fil_+13;

$firma="../firmas/".$row[codmedi_tre].".jpg";
if(file_exists($firma)){
  $pdf->Image($firma,30,$fil_,50,15,'','');

}
$fil_=$fil_+15;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(80,5,$medico,0,0,'L');

$fil_=$fil_+5;
$col_=5;
$pdf->Line($col_,$fil_,$col_+90,$fil_);
$col_=$col_+116;
$pdf->Line($col_,$fil_,$col_+90,$fil_);

$fil_=$fil_+1;
$col_=5;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(90,5,"NOMBRE, FIRMA Y No DE REGISTRO TERAPISTA",0,0,'C');
$col_=$col_+116;
$pdf->SetXY($col_,$fil_);
$pdf->Cell(90,5,"FIRMA DEL PACIENTE",0,0,'C');

//*************************************************
//Aqui consulto la informacion del los controles
//Aqui consulto los datos de los controles
$fil_=260;
$consultatc="SELECT tre.fecha_tre,tre.tipo_tre,tre.antper_tre,tre.ayudxant_tre,tre.descayu_tre,tre.dxprinc_tre,tre.tpdxpr_tre,tre.cexter_tre,tre.ambit_tre,tre.fcard_tre,tre.fres_tre,tre.satur_tre,tre.eval_tre,tre.sesion_tre,tre.tratam_tre,tre.obse_tre,tre.resp_tre,tre.codmedi_tre
FROM tres_historia AS tre
WHERE tre.codi_usu='$row[codi_usu]' AND tre.iden_tre>'$iden_tre'";

$consultatc=mysql_query($consultatc);
while($rowtc=mysql_fetch_array($consultatc)){
    if($rowtc[tipo_tre]=='1'){break;}
    //encabezado($fil_,$pdf);
    $col_=5;
    //$fil_=$fil_+2;
    $fil_=increfila($fil_,5,$pdf);
    $pdf->SetXY($col_,$fil_);
    $pdf->cell(103,4,"FECHA Y HORA DE ATENCION: ".$rowtc[fecha_tre],1,0,'L',true);

    //$fil_=$fil_+7;
    $fil_=increfila($fil_,7,$pdf);
    $col_=5;
    $pdf->SetXY($col_,$fil_);
    $pdf->Cell(60,5,"EXAMEN FISICO RESPIRATORIO: ",0,0,'L');
    $col_=$col_+70;
    $pdf->SetXY($col_,$fil_);
    $pdf->cell(9,5,'FC= ',0,0,'L');
    $col_=$col_+9;
    $pdf->SetXY($col_,$fil_);
    $pdf->cell(9,5,$rowtc[fcard_tre],1,0,'L');
    $col_=$col_+20;
    $pdf->SetXY($col_,$fil_);
    $pdf->cell(9,5,'FR= ',0,0,'L');
    $col_=$col_+9;
    $pdf->SetXY($col_,$fil_);
    $pdf->cell(9,5,$rowtc[fres_tre],1,0,'L');
    $col_=$col_+20;
    $pdf->SetXY($col_,$fil_);
    $pdf->cell(31,5,'Saturación de O2= ',0,0,'L');
    $col_=$col_+31;
    $pdf->SetXY($col_,$fil_);
    $pdf->cell(12,5,$rowtc[satur_tre].'%',1,0,'L');

    //$fil_=$fil_+6;
    $fil_=increfila($fil_,6,$pdf);
    $col_=5;
    $pdf->SetXY($col_,$fil_);
    $pdf->cell(31,5,'EVALUACION:',0,0,'L');
    //$fil_=$fil_+6;
    $fil_=increfila($fil_,6,$pdf);
    $pdf->SetXY($col_,$fil_);
    $pdf->MultiCell(207,4,$rowtc[eval_tre],1,'L','J');

    //$lineas=getNumLines($rowtc[eval_tre],5);
    //NbLines()
    
    $fil_=$pdf->GetY();
    $fil_=increfila($fil_,2,$pdf);
    $col_=5;
    $pdf->SetXY($col_,$fil_);
    $pdf->cell(31,5,'TRATAMIENTO:',0,0,'L');
    $fil_=$fil_+6;
    $pdf->SetXY($col_,$fil_);
    $pdf->cell(15,5,'Código',1,0,'C');
    $col_=$col_+12;
    $pdf->cell(192,5,'Descripción',1,0,'C');

    //$fil_=$fil_+6;
    $fil_=increfila($fil_,6,$pdf);
    $col_=5;
    $pdf->SetXY($col_,$fil_);

    $codi_cup='';
    $desc=trae_cups($row[tratam_tre],$codi_cup);
    //$pdf->cell(15,5,$rowtc[tratam_tre],0,0,'C');
    $pdf->cell(15,5,$codi_cup,0,0,'C');    
    //$desc=trae_cups($rowtc[tratam_tre]);
    $col_=$col_+15;     
    $pdf->SetFont('Arial','',7);
    $pdf->MultiCell(192,4,$desc,1,'L','J');
    $pdf->SetFont('Arial','',9);

    $fil_=$pdf->GetY();
    $fil_=increfila($fil_,2,$pdf);
    $col_=5;
    $pdf->SetXY($col_,$fil_);
    $pdf->cell(31,5,'OBSERVACIONES:',0,0,'L');
    $fil_=$fil_+6;
    $pdf->SetXY($col_,$fil_);
    $pdf->MultiCell(207,4,$rowtc[obse_tre],1,'L','J');

    $fil_=$pdf->GetY();
    $fil_=increfila($fil_,2,$pdf);
    $col_=5;
    $pdf->SetXY($col_,$fil_);
    $pdf->cell(31,5,'RESPUESTA AL TRATAMIENTO:',0,0,'L');
    $fil_=$fil_+6;
    $pdf->SetXY($col_,$fil_);
    $pdf->MultiCell(207,4,$rowtc[resp_tre],1,'L','J');

    
    $medico=trae_medico($rowtc[codmedi_tre]);
    //$fil_=$fil_+13;
    $fil_=$pdf->GetY();
    $fil_=increfila($fil_,13,$pdf);
	
	
	
	$firma="../firmas/".$row[codmedi_tre].".jpg";
	if(file_exists($firma)){
	  $pdf->Image($firma,30,$fil_,50,15,'','');
	}
	$fil_=$fil_+15;
	
	
    $col_=5;
    $pdf->SetXY($col_,$fil_);
    $pdf->Cell(80,5,$medico,0,0,'L');

    //$fil_=$fil_+5;
    $fil_=increfila($fil_,5,$pdf);    
    $col_=5;
    $pdf->Line($col_,$fil_,$col_+90,$fil_);
    $col_=$col_+116;
    $pdf->Line($col_,$fil_,$col_+90,$fil_);

    //$fil_=$fil_+1;
	
	
	
	
	
    $col_=5;
    $pdf->SetXY($col_,$fil_);
    $pdf->Cell(90,5,"NOMBRE, FIRMA Y No DE REGISTRO TERAPISTA",0,0,'C');
    $col_=$col_+116;
    $pdf->SetXY($col_,$fil_);
    $pdf->Cell(90,5,"FIRMA DEL PACIENTE",0,0,'C');
    
    //$fil_=$fil_+8;
    $fil_=increfila($fil_,8,$pdf);
    $col_=5;
    $pdf->Line($col_,$fil_,$col_+206,$fil_);

    $fil_=increfila($fil_,2,$pdf);
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
		/*
        $pdf->Image('img/encabezadotr.jpg',5,5,207,20,'','');
        $pdf->Image('img/pietr.png',5,265,207,10,'','');
		*/
        $fila_=27;
    }   
    return($fila_);
}
?>
