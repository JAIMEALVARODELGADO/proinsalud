<?
    require('fpdf.php');
    ob_start();
    if($tipoconsul==1)$pdf=new FPDF('L','mm','letter');
	if($tipoconsul==2)$pdf=new FPDF('P','mm','letter');
    set_time_limit (1000);	
    $fecdig=(date("Y-m-d"));
    $hora=(date("H:i"));
    foreach($_POST as $nombre_campo => $valor)
    { 
       $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
       eval($asignacion); 
    }
    foreach($_GET as $nombre_campo => $valor)
    { 
       $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
       eval($asignacion); 
    }
    	
    $numpa=1+$fin/55;
    $numpag=floor ($numpa);    
    $reng=0;
    $pag=0;
    for($n=0;$n<$fin;$n++)
    {
		if($tipoconsul==1)
		{		 
			$nomvar='fecbus'.$n;
			$fecbus=$$nomvar;
			$nomvar='horbus'.$n;
			$horbus=$$nomvar;
			$nomvar='funbus'.$n;
			$funbus=substr($$nomvar,0,20);
			$nomvar='pacbus'.$n;
			$pacbus=substr($$nomvar,0,30);
			$nomvar='probus'.$n;
			$probus=substr($$nomvar,0,45);
			$nomvar='canbus'.$n;
			$canbus=$$nomvar;
			$nomvar='serbus'.$n;
			$serbus=substr($$nomvar,0,30);			
			$nomvar='camaac'.$n;
			$camaac=$$nomvar;
						
			if($n % 40==0)
			{
				$ver=$n % 40;
				$pag=$pag+1;
				$pdf->AddPage();
				$reng=0;	
				
				$pdf->SetFont('Arial','B',9);
				$pdf->SetXY(5,10);
				$pdf->Cell(275,4,$nominfo, 0, 0,C);
				$pdf->SetFont('Arial','B',7);
				$pdf->SetXY(5,14);
				$pdf->Cell(275,4,'PERIODO:   '.$fecini.' '.$horaini.':'.$minuini.'     '.$fecfin.' '.$horafin.':'.$minufin, 0, 0,C);
				$pdf->SetFont('Arial','B',7);
				$pdf->SetXY(5,18);
				$pdf->Cell(275,4,'FECHA Y HORA DE IMPRESION   '.$fecdig.'   '.$hora, 0, 0,C);			
				
								
				$pdf->SetFont('Arial','B',7);
				$pdf->SetXY(5,24);
				$pdf->Cell(15,4,'FECHA', 0, 0,C);
				$pdf->Cell(10,4,'HORA', 0, 0,C);
				$pdf->Cell(40,4,'SERVICIO', 0, 0,C);
				
				$pdf->Cell(10,4,'CAMA', 0, 0,C);
				
				$pdf->Cell(40,4,'NOMBRE FUNCIONARIO', 0, 0,C);
				$pdf->Cell(60,4,'NOMBRE DEL PACIENTE', 0, 0,C);
				$pdf->Cell(75,4,'PRODUCTO FARMACEUTICO', 0, 0,C);
				$pdf->Cell(14,4,'CANTIDAD', 0, 0,C);			
				$pdf->Line(5,23,275,23);
				$pdf->Line(5,29,275,29);
				$hor=5;
				$ver=30;				
				$pdf->Text(100, 205,'PAGINA: '.$pag.' DE '.$numpag);				
			}
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY($hor,$ver+4.3*$reng);		
			$pdf->Cell(15,4,$fecbus, 0, 0,C);			
			$pdf->Cell(10,4,$horbus, 0, 0,C);
			$pdf->Cell(40,4,$serbus, 0, 0,C);
			$pdf->Cell(10,4,$camaac, 0, 0,C);
			$pdf->Cell(40,4,$funbus, 0, 0,L);
			$pdf->Cell(60,4,$pacbus, 0, 0,L);
			$pdf->Cell(75,4,$probus, 0, 0,L);
			$pdf->Cell(14,4,$canbus, 0, 0,C);
			$ver=$ver+4;
		}
		
		if($tipoconsul==2)
		{	 
			
			$nomvar='pacbus'.$n;
			$pacbus=substr($$nomvar,0,30);
			$nomvar='probus'.$n;
			$probus=substr($$nomvar,0,55);
			$nomvar='canbus'.$n;
			$canbus=$$nomvar;
			$nomvar='serbus'.$n;
			$serbus=$$nomvar;
			$nomvar='camaac'.$n;
			$camaac=$$nomvar;
			
			
			$serbus=substr($serbus,0,30);		
			$probus=substr($probus,0,45);				
			if($n % 57==0)
			{
				$ver=$n % 57;
				$pag=$pag+1;
				$pdf->AddPage();
				$reng=0;	
				
				$pdf->SetFont('Arial','B',9);
				$pdf->SetXY(5,10);
				$pdf->Cell(205,4,$nominfo, 0, 0,C);
				$pdf->SetFont('Arial','B',7);
				$pdf->SetXY(5,14);
				$pdf->Cell(205,4,'PERIODO:   '.$fecini.' '.$horaini.':'.$minuini.'     '.$fecfin.' '.$horafin.':'.$minufin, 0, 0,C);
				$pdf->SetFont('Arial','B',7);
				$pdf->SetXY(5,18);
				$pdf->Cell(205,4,'FECHA Y HORA DE IMPRESION   '.$fecdig.'   '.$hora, 0, 0,C);			
				
				
				$pdf->SetFont('Arial','B',7);
				$pdf->SetXY(5,24);
				$pdf->Cell(50,4,'SERVICIO', 0, 0,C);
				$pdf->Cell(10,4,'CAMA', 0, 0,C);
				$pdf->Cell(60,4,'NOMBRE DEL PACIENTE', 0, 0,C);
				$pdf->Cell(75,4,'PRODUCTO FARMACEUTICO', 0, 0,C);
				$pdf->Cell(14,4,'CANTIDAD', 0, 0,C);			
				$pdf->Line(5,23,215,23);
				$pdf->Line(5,29,215,29);
				$hor=5;
				$ver=30;				
				$pdf->Text(100, 265,'PAGINA: '.$pag.' DE '.$numpag);				
			}
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY($hor,$ver+4.3*$reng);
			$pdf->Cell(50,4,$serbus, 0, 0,L);
			$pdf->Cell(10,4,$camaac, 0, 0,L);
			$pdf->Cell(60,4,$pacbus, 0, 0,L);
			$pdf->Cell(75,4,$probus, 0, 0,L);
			$pdf->Cell(14,4,$canbus, 0, 0,C);
			$ver=$ver+4;
		}
    }		
        
    ob_end_clean();
    $pdf->Output();
?>

