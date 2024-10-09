<?
	session_register('Gidusu');
	require('fpdf.php');
	include('php/funciones.php');
    $pdf=new FPDF('P','mm','letter');
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',9);

	$link=Mysql_connect("localhost","root","");
    if(!$link)echo"no hay conexion";
	Mysql_select_db('general',$link);
	$busu=mysql_query("select * from cut where ide_usua='$Gidusu'");
	while($rusu=mysql_fetch_array($busu))
	{
		$nomusua=$rusu['nomb_usua'];
	}	
	$fecha=date('Y').'-'.date('m').'-'.date('d');
	$hora=date('H').':'.date('s');
    Mysql_select_db('proinsalud',$link);
	$cad3="select l.radi_lec,l.fech_lec,l.esta_lec,l.lect_lec,l.iden_var,u.nrod_usu,u.pnom_usu,u.snom_usu,u.pape_usu,u.sape_usu,c.descrip from lectura_imagen AS l 
	INNER JOIN usuario AS u ON u.codi_usu=l.codi_usu 
	INNER JOIN cups AS c ON c.codigo=l.copr_lec where l.iden_lec=$iden_lec";
	$resul3=Mysql_query($cad3,$link);
	if(mysql_num_rows($resul3)<>0){
	  $row3=mysql_fetch_array($resul3);	  
	  
	    $ver=-20;$hor=0;
		
		
		$fila_=0;
		$pdf_=$pdf;
		$imaenca="../funciones_php/img/logo_encabezado.JPG";
		$formato='FRIMA-02';
		include ('../funciones_php/formatos.php');
		$fila_=$fila_+23;	
		
		
		
		/*
	    $pdf->SetFont('Arial','B',7);
		$pdf->Rect($hor+0,$ver+26, 215, 14);
		$pdf->Image('img/logo.png',$hor+2,$ver+27);
		$pdf->SetFont('Arial','B',11);
		$pdf->Text($hor+24,$ver+32, 'Profesionales de la');
		$pdf->Text($hor+31,$ver+37, 'Salud S.A.');
		$pdf->SetFont('Arial','B',12);
		//$pdf->Text($hor+85, $ver+31, 'FORMULA MÉDICA');
		$pdf->Text($hor+80, $ver+31, 'REPORTE DE RESULTADOS');
		$pdf->Text($hor+90, $ver+37, 'DE IMAGENOLOGIA');
		$pdf->SetFont('Arial','B',6);
		$pdf->Text($hor+160, $ver+29, 'CÓDIGO:');
		$pdf->SetFont('Arial','',6);
		$pdf->Text($hor+160, $ver+32, 'FRIMA-02');
		$pdf->SetFont('Arial','B',6);
		$pdf->Text($hor+160, $ver+36, 'VERSIÓN:');
		$pdf->SetFont('Arial','',6);
		$pdf->Text($hor+164, $ver+39, '05');
		$pdf->SetFont('Arial','B',6);
		$pdf->Text($hor+182, $ver+28, 'FECHA DE ELABORACION:');
		$pdf->SetFont('Arial','',6);
		$pdf->Text($hor+183, $ver+30, '01 de Septiembre de 2003');
		$pdf->SetFont('Arial','B',6);
		$pdf->Text($hor+181, $ver+34, 'FECHA DE ACTUALIZACION:');
		$pdf->SetFont('Arial','',6);
		$pdf->Text($hor+185, $ver+36, '12 de Agosto de 2016');
		$pdf->Text($hor+188, $ver+39, 'HOJA: 1 DE: 1');
		$pdf->Line($hor+20, $ver+26,$hor+20 , $ver+40);
		$pdf->Line($hor+65, $ver+26,$hor+65 , $ver+40);
		$pdf->Line($hor+155, $ver+26,$hor+155 , $ver+40);
		$pdf->Line($hor+177, $ver+26,$hor+177 , $ver+40);
		$pdf->Line($hor+155, $ver+33,$hor+177 , $ver+33);
		$pdf->Line($hor+177, $ver+31,$hor+215 , $ver+31);
		$pdf->Line($hor+177, $ver+37,$hor+215 , $ver+37);
		*/
		$pdf->SetFont('Arial','',8);
		
		$radio=$row3[radi_lec];
		$estado=$row3[esta_lec];
		$iden_var=$row3[iden_var];	  
		$bmed=mysql_query("SELECT deta_rips.iden_der, enca_rips.fech_ecr, enca_rips.hora_ecr, enca_rips.meds_ecr, enca_rips.area_ecr
		FROM medicos INNER JOIN (deta_rips INNER JOIN enca_rips ON deta_rips.iden_ecr = enca_rips.iden_ecr)
		WHERE (((deta_rips.iden_der)='$iden_var'))");
		while($rmed=mysql_fetch_array($bmed))
		{
			$medico=$rmed['nom_medi'];
			$fechatoma=$rmed['fech_ecr'];
		}	  
	  $pdf->SetFont('Arial','B',9);	  
	  //$pdf->Image('img/encabeza.png',20,2,180,25);
      
	  $ver=27;
	  /*
	  if($estado!='CU')
	  {
			$pdf->SetFont('Arial','B',10);
			$pdf->Text(80,$ver,'INFORME PRELIMINAR');
			$ver=$ver+10;
	  }
	  */
	  $pdf->SetFont('Arial','B',9);
      $pdf->Text(20,$ver,'FECHA DE TOMA:');
      $pdf->Text(60,$ver,cambiafechadmy($fechatoma));
	  $ver=$ver+5;
      $pdf->Text(20,$ver,'NOMBRE:');
      $pdf->Text(60,$ver,$row3[pnom_usu].' '.$row3[snom_usu].' '.$row3[pape_usu].' '.$row3[sape_usu]);
	  $ver=$ver+5;
      $pdf->Text(20,$ver,'ESTUDIO:');  	  
	  $pdf->SetXY(59,$ver-4);
	  
	  //if($estado!='CU')$pdf->SetY(52);
	  //else 
      
	  $pdf->MultiCell(150, 5, $row3[descrip],0,J,0); 
      $ver=$pdf->GetY();
	  //$pdf->Text(20, $ver+5,'MEDICO SOLICITANTE:');
      //$pdf->Text(60, $ver+5,$medico);
	  //$ver=$ver+5;
      $pdf->Text(20, $ver+5,'CEDULA:');
      $pdf->Text(60, $ver+5,$row3[nrod_usu]);
      $pdf->Text(90, $ver+15,'INFORME');		
      $pdf->SetY($ver+25);
      $pdf->SetX(20);
      $pdf->MultiCell(180, 5, $row3[lect_lec],0, J,0); 
	}	
	$ver=$pdf->GetY();
	//$pdf->Text(20, $ver+25,'Atte.');
	
	$bradio=mysql_query("select * from medicos where cod_medi='$radio'");
	while($rradio=mysql_fetch_array($bradio))
	{
		$nomradio=$rradio['nom_medi'];
		$regradio=$rradio['reg_medi'];
		$obsradio=$rradio['obse_med'];
	}
	
	$ver=$ver+10;
	if($estado=='CU')
	{
		$firma="../firmas/".$radio.".jpg";
		
		if(file_exists($firma)){
		  $pdf->Image($firma,20,$ver+5,50,15,'','');
		}
		$ver=$ver+15;
	}
	/*
	Else
	{
		
		$pdf->Text(20, $ver,'INFORME PRELIMINAR');
		$ver=$ver+5;
		$pdf->Text(20, $ver,'No valido para impresión');
		$ver=$ver+10;
	}
	*/
	$pdf->Text(20, $ver,$nomradio);
	$pdf->Text(20, $ver+5,'MD. RADIOLOGO');
	$pdf->Text(20, $ver+10,'RM '.$regradio);
	$pdf->Text(20, $ver+15,$obsradio);	
	
	$ver=258;
    $pdf->SetFont('Arial','',6);
	$pdf->Text(20,$ver,'FECHA DE REGISTRO: '.cambiafechadmy($row3[fech_lec]).substr($row3[fech_lec],10,9));
		
    $pdf->SetFont('Arial','',8);
	

	$pdf->Output();
	
	//echo "<body onload=window.open('imagen0.php?cuentas1=0','area')>";
	//echo "</body>";
	
	
?>
