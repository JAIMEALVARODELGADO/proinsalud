<?
set_time_limit (10000);
require('fpdf.php');
//session_register('cuentas');
//session_register('codusu');
//session_register('Gcod_medico');

function impresion(&$pdf,$link,$cedula,$fechaimp){
	/*
	$cadusu="SELECT usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, contrato.NEPS_CON, usuario.TPAF_USU, usuario.NROD_USU, ingreso_hospitalario.id_ing
	FROM ingreso_hospitalario INNER JOIN ((usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON) ON ingreso_hospitalario.codius_ing = usuario.CODI_USU
	WHERE (((usuario.NROD_USU)='$cedula'))";
	*/
	
	
	
	
	$cadusu="SELECT usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, contrato.NEPS_CON, usuario.TPAF_USU, usuario.NROD_USU, ingreso_hospitalario.id_ing
	FROM (ingreso_hospitalario INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU) INNER JOIN contrato ON ingreso_hospitalario.contra_ing = contrato.CODI_CON
	WHERE (((usuario.NROD_USU)='$cedula'))";

	$resulusu=Mysql_query($cadusu,$link);
	while($row = mysql_fetch_array($resulusu))
	{
		$cedula=$row['NROD_USU'];
		$nom1=$row['PNOM_USU'];
		$nom2=$row['SNOM_USU'];
		$ape1=$row['PAPE_USU'];		
		$ape2=$row['SAPE_USU'];	
		$contra=strtoupper($row['NEPS_CON']);		
		$clase=$row['TPAF_USU'];
	}	
	$pagina=1;
	
    $fecdig=(date("Y-m-d"));
    $hora=(date("H-i"));
	
	$nombre=$nom1.' '.$nom2.' '.$ape1.' '.$ape2;
	$vec[0]=$cedula;
	$vec[1]=$nombre;
	$vec[2]=$contra;
	
	$pos=251;
	$pag=titulo($pdf,$pos,$vec,$pag);
	
	
	$resu=mysql_query("SELECT terapia_evolucion.diag_ter, usuario.NROD_USU, terapia_evolucion.fech_ter, terapia_evolucion.id_ing, cie_10.nom_cie10, terapia_evolucion.tipo_ter, terapia_evolucion.iden_ter, terapia_evolucion.cama_ter, terapia_evolucion.nota_ter, terapia_evolucion.hora_ter, medicos.nom_medi, medicos.cod_medi, medicos.reg_medi, destipos.nomb_des AS espe
	FROM ((((terapia_evolucion INNER JOIN medicos ON terapia_evolucion.medi_ter = medicos.cod_medi) INNER JOIN cie_10 ON terapia_evolucion.diag_ter = cie_10.cod_cie10) INNER JOIN ingreso_hospitalario ON terapia_evolucion.id_ing = ingreso_hospitalario.id_ing) INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU) LEFT JOIN destipos ON medicos.espe_med = destipos.codi_des
	WHERE (((usuario.NROD_USU)='$cedula') AND ((terapia_evolucion.fech_ter)='$fechaimp'))");
	while($rowresu=mysql_fetch_array($resu))
	{	
		$fecha=$rowresu[fech_ter];
		$hora=$rowresu[hora_ter];
		$nommedi=$rowresu[nom_medi];	
		$codmedi=$rowresu[cod_medi];
		$regmedi=$rowresu[reg_medi];
		$nota=$rowresu[nota_ter];
		$cama=$rowresu['cama_ter'];
		$diagno=$rowresu['diag_ter'];
		$tipo_ter=$rowresu['tipo_ter'];
		$nomcie=$rowresu['nom_cie10'];
		
		
		$nomespecialidad=$rowresu['espe'];
		
		$iden_evo=$rowresu[iden_ter];
		if($tipo_ter=='TR')$dester='TERAPIA RESPIRATORIA';
		if($tipo_ter=='TF')$dester='TERAPIA FISICA';
		if($tipo_ter=='TO')$dester='TERAPIA OCUPACIONAL';
		if($tipo_ter=='FO')$dester='FONOAUDIOLOGIA';					
		$bdiag=mysql_query("select * from cie_10 where cod_cie10 ='$diagno'");
		while($rdia=mysql_fetch_array($bdiag))
		$nomcie=$rdia['nom_cie10'];		
		$bare=mysql_query("SELECT destipos.codi_des, destipos.nomb_des AS ncama, destipos_1.nomb_des AS narea
		FROM destipos INNER JOIN destipos AS destipos_1 ON destipos.val2_des = destipos_1.codi_des
		WHERE (((destipos.codi_des)='$cama'))");
		$areaus='';
		$camaus='';
		while($rare=mysql_fetch_array($bare))
		{
			$areaus=$rare['narea'];		
			$camaus=$rare['ncama'];	
		}		
		$pdf->Text(10, $pos,'Evolucion No.:');
		$pdf->Text(34, $pos,$iden_evo);
$pag=titulo($pdf,$pos,$vec,$pag);		
		$pdf->SetFont('Arial','',8);
		$pag=titulo($pdf,$pos,$vec,$pag);
		$pos=$pos+3;
$pag=titulo($pdf,$pos,$vec,$pag);
		$pdf->SetXY(10, $pos);
		$pdf->Cell(14,5,'FECHA', 1, 0,C);
		$pdf->Cell(14,5,'HORA', 1, 0,C);	
		$pdf->Cell(50,5,'MEDICO', 1, 0,C);
		$pdf->Cell(52,5,'SERVICIO', 1, 0,C);
		$pdf->Cell(14,5,'CAMA', 1, 0,C);
		$pdf->Cell(50,5,'TIPO', 1, 0,C);		
		$pos=$pos+5;
		$pag=titulo($pdf,$pos,$vec,$pag);
		$pdf->SetXY(10, $pos);
$pag=titulo($pdf,$pos,$vec,$pag);		
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(14,5,$fecha,1,0,C);
		$pdf->Cell(14,5,$hora,1,0,C);
		$pdf->Cell(50,5,$nommedi,1,0,C);					
		$pdf->Cell(52,5,$areaus,1,0,C);
		$pdf->Cell(14,5,$camaus,1,0,C);
		$pdf->Cell(50,5,$dester,1,0,C);	
		$pos=$pos+10;
$pag=titulo($pdf,$pos,$vec,$pag);		
		$pdf->SetXY(10, $pos);					
		$pdf->Cell(25,5,'DIAGNOSTICO:', 0, 0,L);
		$pdf->Cell(170,5,$nomcie, 0, 0,L);					
		$pos=$pos+5;
$pag=titulo($pdf,$pos,$vec,$pag);		
		$pdf->SetXY(10, $pos);					
		$pdf->Cell(25,5,'EVOLUCION:', 0, 0,L);
		$pdf->MultiCell(0,5,$nota, 0, J,0);	
		$pag=titulo($pdf,$pos,$vec,$pag);
		
		
		
		
		$pos=$pdf->GetY();
		$pag=titulo($pdf,$pos,$vec,$pag);	
		$firma="../firmas/".$codmedi.".jpg";
		if(file_exists($firma)){
		  $pdf->Image($firma,30,$pos,50,15,'','');
		}
		
		$pos=$pos+15;
		$pag=titulo($pdf,$pos,$vec,$pag);		
		
		
		
		$pdf->SetXY(35,$pos);
		$pdf->Cell(45,5,$nommedi,0,0,L);
		
		
		$pag=titulo($pdf,$pos,$vec,$pag);	
		if(!empty($nomespecialidad))
		{
			$pos=$pos+4;
			$pag=titulo($pdf,$pos,$vec,$pag);
			$pdf->SetXY(35,$pos);
			
			$pdf->Cell(45,5,$nomespecialidad,0,0,L);
		}
		
		if(!empty($regmedi))
		{
			$pos=$pos+4;
			$pag=titulo($pdf,$pos,$vec,$pag);	
			$pdf->SetXY(35,$pos);
			$pdf->Cell(45,5,'Registro medico: '.$regmedi,0,0,L);
		}	
		
		
		//$fila=$fila+30;
		$pos=$pos+10;	
		$pag=titulo($pdf,$pos,$vec,$pag);		
	}	
	$num=$pdf->GetY();
	$num=$num+50;		
}

function titulo(&$pdf_,&$fila_,$vec_,$pag){
if($fila_>250){
	$pag=$pag+1;
	
	
	$hor=10;
	$ver=-23;	
	
	$cedula=$vec_[0];
	$nombre=$vec_[1];
	$contra=$vec_[2];
	
	
	$pdf_->AddPage();
	$pdf_->SetFont('Arial','B',7);
	/*
	$pdf_->Rect($hor+0,$ver+26, 195, 14);
	$pdf_->Image('img/logo.png',$hor+2,$ver+27);
	$pdf_->SetFont('Arial','B',11);
	$pdf_->Text($hor+24,$ver+32, 'Profesionales de la');
	$pdf_->Text($hor+31,$ver+37, 'Salud S.A.');
	$pdf_->SetFont('Arial','B',14);
	//$pdf->Text($hor+85, $ver+31, 'FORMULA M�DICA');
	$pdf_->Text($hor+82, $ver+35, 'FISIOTERAPIA');
	$pdf_->SetFont('Arial','B',6);
	$pdf_->Text($hor+140, $ver+29, 'C�DIGO:');
	$pdf_->SetFont('Arial','',6);
	$pdf_->Text($hor+137, $ver+32, ' FRTER - 05');
	$pdf_->SetFont('Arial','B',6);
	$pdf_->Text($hor+140, $ver+36, 'VERSI�N:');
	$pdf_->SetFont('Arial','',6);
	$pdf_->Text($hor+143, $ver+39, '00');
	$pdf_->SetFont('Arial','B',6);
	$pdf_->Text($hor+170, $ver+28.5, 'Fecha de elaboraci�n:');
	$pdf_->SetFont('Arial','',6);
	$pdf_->Text($hor+168, $ver+30.5, '29 de Abril de 2011');
	$pdf_->SetFont('Arial','B',6);
	$pdf_->Text($hor+169, $ver+34, 'Fecha de actualizaci�n:');
	$pdf_->SetFont('Arial','',6);
	$pdf_->Text($hor+171, $ver+36, '29 de Abril de 2011');
	$pdf_->Text($hor+176, $ver+39.5, 'Hoja: 1 de: 1');	
	$pdf_->Line($hor+15, $ver+26,$hor+15 , $ver+40);
	$pdf_->Line($hor+65, $ver+26,$hor+65 , $ver+40);
	$pdf_->Line($hor+135, $ver+26,$hor+135 , $ver+40);
	$pdf_->Line($hor+157, $ver+26,$hor+157 , $ver+40);
	$pdf_->Line($hor+135, $ver+33,$hor+157 , $ver+33);
	$pdf_->Line($hor+157, $ver+31.5,$hor+195 , $ver+31.5);
	$pdf_->Line($hor+157, $ver+37.5,$hor+195 , $ver+37.5);
	*/
	
	$fila_=0;
	$formato='FRFTR-04';
	$imaenca="../funciones_php/img/logo_encabezado.JPG";
	include ('../funciones_php/formatos.php');
	
	$hor=10;
	$ver=27;
	$pdf_->SetXY($hor, $ver);
	$pdf_->SetFont('Arial','',8);
	$pdf_->Cell(70,2,$cedula, 0, 0,C);	
	$pdf_->Cell(70,2,$nombre, 0, 0,C);
	$pdf_->Cell(70,2,$contra, 0, 1,C);	
	$pdf_->Cell(70,1,'____________________', 0, 0,C);	
	$pdf_->Cell(70,1,'________________________________________', 0, 0,C);
	$pdf_->Cell(70,1,'_____________________', 0, 1,C);	
	$pdf_->Cell(70,7,'Numero de identificacion', 0, 0,C);	
	$pdf_->Cell(70,7,'Nombres y apellidos', 0, 0,C);
	$pdf_->Cell(70,7,'Contrato', 0, 0,C);
	$ver=230; 
/*	
	$pdf_->Rect($hor,$ver+40, 195, 7);
	$pdf_->Line($hor+65,$ver+40,$hor+65,$ver+47);
	$pdf_->Line($hor+140,$ver+40,$hor+140,$ver+47);
	$pdf_->Text($hor+20, $ver+43,'ELABORADO POR:');
	$pdf_->Text($hor+19, $ver+45.5,'Grupo Terapia Respiratoria');
	$pdf_->Text($hor+85, $ver+43,'REVISADO POR:');
	$pdf_->Text($hor+79, $ver+45.5,'Cordinador del S.G.C');
	$pdf_->Text($hor+160, $ver+43,'APROBADO POR:');
	$pdf_->Text($hor+160, $ver+45.5,'Gerente General');
	*/
	$fila_=40;
	
  
  }
  return $pag;
}


$link=Mysql_connect("localhost","root","");
Mysql_select_db('proinsalud',$link);	
$pdf=new FPDF('P','mm','letter');
if(!empty($ingreso)){
	$consulta=mysql_query("SELECT evo.fech_evo,usu.nrod_usu 
	FROM hist_evo AS evo 
	INNER JOIN usuario AS usu ON usu.codi_usu=evo.codi_usu
	WHERE evo.id_ing=$ingreso GROUP BY evo.fech_evo");
	if(mysql_num_rows($consulta)){
		while($row=mysql_fetch_array($consulta)){
			$fechaimp=$row[fech_evo];
			$cedula=$row[nrod_usu];
			//$pdf->AddPage();
			impresion($pdf,$link,$cedula,$fechaimp);
		}
	}
	mysql_free_result($consulta);
}
else{
	impresion($pdf,$link,$cedula,$fechaimp);
}

$pdf->Output();	
mysql_close();	

?>