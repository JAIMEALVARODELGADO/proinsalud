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
	$ver=200;
    for($n=0;$n<$fin;$n++)
    {
		if($tipoconsul==1)
		{		 
			$nomvar='fecbus'.$n;
			$fecbus=$$nomvar;
			$nomvar='horbus'.$n;
			$horbus=$$nomvar;
			$nomvar='codisol'.$n;
			$codisol=$$nomvar;
			$nomvar='funbus'.$n;
			$funbus=substr($$nomvar,0,20);
			$nomvar='camaac'.$n;
			$camaac=$$nomvar;
			$nomvar='pacbus'.$n;
			$pacbus=substr($$nomvar,0,30);
			$nomvar='probus'.$n;
			$probus=substr($$nomvar,0,45);
			$nomvar='canbus'.$n;
			$canbus=$$nomvar;
			$nomvar='serbus'.$n;
			$serbus=substr($$nomvar,0,30);		
			$nomvar='obsbus'.$n;
			
			if($opcion==4)
			{
				$obsbus=substr($$nomvar,0,60);				
				if($ver>=180)
				{
					$ver=$n % 40;
					$pag=$pag+1;
					$pdf->AddPage();
					$reng=0;
					
					$pdf->SetFillColor(230); 
					$pdf->SetDrawColor(100);
					$pdf->SetFont('Arial','B',9);
					$pdf->SetXY(5,10);
					$pdf->Cell(275,4,$nominfo, 0, 0,C);
					$pdf->SetFont('Arial','B',7);
					$pdf->SetXY(5,14);
					$pdf->Cell(275,4,'PERIODO:   '.$fecini.'   '.$fecfin, 0, 0,C);
					$pdf->SetFont('Arial','B',7);
					$pdf->SetXY(5,18);
					$pdf->Cell(275,4,'FECHA Y HORA DE IMPRESION   '.$fecdig.'   '.$hora, 0, 0,C);			
					
					$pdf->Rect(5, 24, 270,4,F);
					$pdf->SetFont('Arial','B',7);
					$pdf->SetXY(5,24);
					$pdf->SetXY(5,24);
					$pdf->Cell(14,4,'FECHA', 1, 0,C);
					$pdf->Cell(9,4,'HORA', 1, 0,C);
					$pdf->Cell(34,4,'SERVICIO', 1, 0,C);
					$pdf->Cell(9,4,'CAMA', 1, 0,C);
					$pdf->Cell(34,4,'NOMBRE FUNCIONARIO', 1, 0,C);
					$pdf->Cell(34,4,'NOMBRE DEL PACIENTE', 1, 0,C);
					$pdf->Cell(45,4,'PRODUCTO FARMACEUTICO', 1, 0,C);
					$pdf->Cell(13,4,'CANTIDAD', 1, 0,C);
					$pdf->Cell(45,4,'OBSERVACIONES', 1, 0,C);
					$pdf->Cell(33,4,'FIRMA FUNCIONARIO', 1, 0,C);
					
					$ver=30;				
					$pdf->Text(130, 205,'PAGINA: '.$pag);
				}


				$pdf->SetXY(5,$ver);
				$pdf->MultiCell(14,4,$fecbus,0,C,0);
				$finy=$pdf->GetY();
				$pdf->SetXY(19,$ver);
				$pdf->MultiCell(9,4,$horbus,0,C,0);
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();
				$pdf->SetXY(28,$ver);
				$pdf->MultiCell(34,4,$serbus,0,C,0);
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();
				$pdf->SetXY(62,$ver);
				$pdf->MultiCell(9,4,$camaac,0,C,0);
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();
				$pdf->SetXY(71,$ver);
				$pdf->MultiCell(34,4,$funbus,0,C,0);
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();
				$pdf->SetXY(105,$ver);
				$pdf->MultiCell(34,4,$pacbus,0,C,0);
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();
				$pdf->SetXY(139,$ver);
				$pdf->MultiCell(45,4,$probus,0,C,0);
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();
				$pdf->SetXY(184,$ver);
				$pdf->MultiCell(13,4,$canbus,0,C,0);
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();
				$pdf->SetXY(197,$ver);
				$pdf->MultiCell(45,4,$obsbus,0,C,0);
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();
				$pdf->SetXY(242,$ver);
				$pdf->MultiCell(45,4,$obsbus,0,C,0);


				$firma="../firmas/".$codisol.".jpg";
				if(file_exists($firma)){
				  $pdf->Image($firma,243,$ver,33,10,'','');
				}

				if($pdf->GetY()>$finy)$finy=$pdf->GetY();

				$pdf->Rect(5, $ver, 14, $finy-$ver);
				$pdf->Rect(19, $ver, 9, $finy-$ver);
				$pdf->Rect(28, $ver, 34, $finy-$ver);
				$pdf->Rect(62, $ver, 9, $finy-$ver);
				$pdf->Rect(71, $ver, 34, $finy-$ver);
				$pdf->Rect(105, $ver, 34, $finy-$ver);
				$pdf->Rect(139, $ver, 45, $finy-$ver);
				$pdf->Rect(284, $ver, 13, $finy-$ver);
				$pdf->Rect(197, $ver, 45, $finy-$ver);
				$pdf->Rect(242, $ver, 33, $finy-$ver);
				$pdf->Rect(5, $ver, 270, $finy-$ver);
				$ver=$finy;
				

			}
			else
			{
				$obsbus=substr($$nomvar,0,60);				
				if($ver>=180)
				{
					$ver=$n % 40;
					$pag=$pag+1;
					$pdf->AddPage();
					$reng=0;
					
					$pdf->SetFillColor(230); 
					$pdf->SetDrawColor(100);
					$pdf->SetFont('Arial','B',9);
					$pdf->SetXY(5,10);
					$pdf->Cell(275,4,$nominfo, 0, 0,C);
					$pdf->SetFont('Arial','B',7);
					$pdf->SetXY(5,14);
					$pdf->Cell(275,4,'PERIODO:   '.$fecini.'   '.$fecfin, 0, 0,C);
					$pdf->SetFont('Arial','B',7);
					$pdf->SetXY(5,18);
					$pdf->Cell(275,4,'FECHA Y HORA DE IMPRESION   '.$fecdig.'   '.$hora, 0, 0,C);			
					
					$pdf->Rect(5, 24, 270,4,F);
					$pdf->SetFont('Arial','B',7);
					$pdf->SetXY(5,24);
					$pdf->Cell(14,4,'FECHA', 1, 0,C);
					$pdf->Cell(9,4,'HORA', 1, 0,C);
					$pdf->Cell(39,4,'SERVICIO', 1, 0,C);
					$pdf->Cell(9,4,'CAMA', 1, 0,C);				
					$pdf->Cell(39,4,'NOMBRE FUNCIONARIO', 1, 0,C);
					$pdf->Cell(39,4,'NOMBRE DEL PACIENTE', 1, 0,C);
					$pdf->Cell(54,4,'PRODUCTO FARMACEUTICO', 1, 0,C);
					$pdf->Cell(13,4,'CANTIDAD', 1, 0,C);
					$pdf->Cell(54,4,'OBSERVACIONES', 1, 0,C);
					$ver=30;				
					$pdf->Text(130, 205,'PAGINA: '.$pag);
				
				}
				$firma="../firmas/".$codisol.".jpg";
				if(file_exists($firma))
				{
					//$ver=$ver+10;
					//$espa=14;
				}
				else 			
				{
					//$ver=$ver+4;
					//$espa=4;
				}
				
				$pdf->SetDrawColor(200);
				$pdf->SetFont('Arial','',7);						
				$pdf->SetXY(5,$ver);
				$pdf->MultiCell(14,4,$fecbus,0,C,0);
				$finy=$pdf->GetY();
				$pdf->SetXY(19,$ver);
				$pdf->MultiCell(9,4,$horbus,0,C,0);
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();
				$pdf->SetXY(28,$ver);
				$pdf->MultiCell(39,4,$serbus,0,C,0);
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();			
				$pdf->SetXY(67,$ver);
				$pdf->MultiCell(9,4,$camaac,0,C,0);
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();			
				$pdf->SetXY(76,$ver);
				$pdf->MultiCell(39,4,$funbus,0,C,0);
				
				/*
				$firma="../firmas/".$codisol.".jpg";
				if(file_exists($firma)){
				  $pdf->Image($firma,80,$ver,35,10,'','');
				}
				*/
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();
				$pdf->SetXY(115,$ver);
				$pdf->MultiCell(39,4,$pacbus,0,C,0);
				
				
				
				
				
				
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();
				$pdf->SetXY(154,$ver);
				$pdf->MultiCell(54,4,$probus,0,C,0);
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();
				$pdf->SetXY(208,$ver);
				$pdf->MultiCell(13,4,$canbus,0,C,0);
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();
				$pdf->SetXY(221,$ver);
				$pdf->MultiCell(54,4,$obsbus,0,C,0);
				if($pdf->GetY()>$finy)$finy=$pdf->GetY();		
				
				
				$pdf->Rect(5, $ver, 14, $finy-$ver);
				$pdf->Rect(19, $ver, 9, $finy-$ver);
				$pdf->Rect(28, $ver, 39, $finy-$ver);			
				$pdf->Rect(67, $ver, 9, $finy-$ver);			
				$pdf->Rect(76, $ver, 39, $finy-$ver);
				$pdf->Rect(115, $ver, 39, $finy-$ver);
				$pdf->Rect(154, $ver, 54, $finy-$ver);
				$pdf->Rect(208, $ver, 13, $finy-$ver);
				$pdf->Rect(221, $ver, 54, $finy-$ver);			
				$ver=$finy;
			}	
		}
		
		
		
		
		
		
		
		
		if($tipoconsul==2)
		{	 
			
			ECHO"MMMMM";
			$nomvar='pacbus'.$n;
			$pacbus=substr($$nomvar,0,30);
			$nomvar='probus'.$n;
			$probus=substr($$nomvar,0,55);
			$nomvar='canbus'.$n;
			$canbus=$$nomvar;
			$nomvar='serbus'.$n;
			$serbus=substr($$nomvar,0,30);				
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
				$pdf->Cell(205,4,'PERIODO:   '.$fecini.'   '.$fecfin, 0, 0,C);
				$pdf->SetFont('Arial','B',7);
				$pdf->SetXY(5,18);
				$pdf->Cell(205,4,'FECHA Y HORA DE IMPRESION   '.$fecdig.'   '.$hora, 0, 0,C);			
				
				
				$pdf->SetFont('Arial','B',7);
				$pdf->SetXY(5,24);
				$pdf->Cell(40,4,'SERVICIO', 0, 0,C);
				$pdf->Cell(60,4,'NOMBRE DEL PACIENTE', 0, 0,C);
				$pdf->Cell(95,4,'PRODUCTO FARMACEUTICO', 0, 0,C);
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
			$pdf->Cell(60,4,$pacbus, 0, 0,L);
			$pdf->Cell(85,4,$probus, 0, 0,L);
			$pdf->Cell(14,4,$canbus, 0, 0,C);
			$ver=$ver+4;
		}
    }       
    ob_end_clean();
    $pdf->Output();
	
	
	
	
	
	
	
	function parrafo($variable,$pdf,$fila,$ini,$ancho,$marco,$inter)
	{
		
		//$pdf->Cell(5,10,'AAA', 0, 0,C);
		
		$tok = strtok ($variable,"\n");
		$n=0;
		while ($tok) 
		{	
			$vec1[$n]=$tok;
			$tok = strtok ("\n");		
			$n++;	
		}
		$fin=$n;
		$n=0;
		for($j=0;$j<$fin;$j++)
		{
			$frase=$vec1[$j];
			$tok = strtok ($frase," ");		
			while ($tok) 
			{	
				$vec[$n]=$tok;
				$tok = strtok (" ");		
				$n++;	
			}
			$vec[$n]="\n";
			$n++;
		}
		$linea=' ';	
		if($marco>=1)
		{
			$an=2;
			$we=$ancho-4;
		}
		else
		{
			$an=0;
			$we=$ancho;
		}
		$pdf->SetXY($ini+$an,$fila);
		$fila1=$fila;
		$lar=$pdf->GetStringWidth($linea);	
		$linea=$vec[0];
		$linea1=$vec[0];
		if($marco>=1)
		{
			$pdf->Line($ini, $fila, $ini+$ancho, $fila);
		}
		for($i==1;$i<$n;$i++)
		{
			$palabra=$vec[$i];
			$linea1=$linea1.' '.$palabra;
			$lar=$pdf->GetStringWidth($linea1);	
			if($lar<$we && $palabra!="\n")
			{
				$linea=$linea.' '.$palabra;
			}
			else
			{		
				if($palabra!="\n")
				{
					titulo($pdf,$fila);
					$linea=ltrim($linea);
					$cuenta=strlen($linea);
					$pdf->SetXY($ini+$an,$fila);
					if($cuenta>0)
					{
						$lar=$pdf->GetStringWidth($linea);
						$espacio=($we-$lar)/$cuenta;
						for($k=0;$k<$cuenta;$k++)
						{
							$car=$linea[$k];
							$lar=$pdf->GetStringWidth($car);
							$pdf->Cell($lar+$espacio,4,$car,0,0,C);						
						}
						
					}
					if($marco==2)$pdf->Line($ini, $fila, $ini+$ancho, $fila);
					if($marco>=1)
					{
						$pdf->Line($ini, $fila, $ini, $fila+4);					
						$pdf->Line($ini+$ancho, $fila, $ini+$ancho, $fila+4);
					}					
					$linea=$palabra;
					$linea1=$palabra;
					$fila=$fila+4;
					titulo($pdf,$fila);
					$pdf->SetXY($ini+$an,$fila);
				}
				else
				{
					if($marco==2)$pdf->Line($ini, $fila, $ini+$ancho, $fila);
					if($marco>=1)$pdf->SetXY($ini+1,$fila);
					else $pdf->SetXY($ini-1,$fila);
					$linea=ltrim($linea);
					$pdf->Cell($we,4,$linea,0,0,L);	
					$fila=$fila+4+$inter;
					$pdf->SetXY($ini+$an,$fila);
					if($marco>=1)
					{
						$pdf->Line($ini, $fila-(4+$inter), $ini, $fila);
						$pdf->Line($ini+$ancho, $fila-(4+$inter), $ini+$ancho, $fila);
					}
				}
			}		
		}
		if($marco>=1)
		{
			$pdf->Line($ini, $fila, $ini+$ancho, $fila);
		}	
			
	}
	
	
	function titulo(&$pdf_,&$fila_)
	{
		if($fila_>248)
		{
			$pdf_->AddPage();
			$fila_=16;
			$pdf_->Image('img\enca_epic.JPG',1,0,210,0,'','');
			//$pdf_->Image('img\controlado.png',205,100,7,30,'','');
			$pdf_->Image('img\PIE1.JPG',2,265,210,0,'','');
		}
	}
	
	
	
?>

