<?       
    require('fpdf.php');
    //$pdf=new FPDF('P','mm','Letter');
    $pdf=new FPDF('P','mm',array(215,260));
    $pdf->SetFont('Arial','',8);
    include ('php/conexion1.php');    
    set_time_limit (10000);
    $fecdig=(date("Y-m-d"));
    $hora=(date("H-i"));
    $fecha=date("Y-m-d");
    $hora=date("H:i:s");
    //$fechafin='2012-04-21';
    //$fechaini='2012-04-01';
    
    
    
	$cadmed=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi, horarios.Cserv_horario, areas.nom_areas, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, citas.Cotra_citas, contrato.NEPS_CON, horarios.Fecha_horario, horarios.Hora_horario, citas.Tusua_citas, ucontrato.ESTA_UCO, usuario.DCOT_USU 
	FROM contrato INNER JOIN (((usuario INNER JOIN ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) ON usuario.CODI_USU = citas.Idusu_citas) INNER JOIN ucontrato ON (usuario.CODI_USU = ucontrato.CUSU_UCO) AND (citas.Cotra_citas = ucontrato.CONT_UCO)) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) ON contrato.CODI_CON = ucontrato.CONT_UCO
	WHERE medicos.cod_medi='$codmedi' AND horarios.Fecha_horario='$fechaini' AND Clase_citas<'6' 
	ORDER BY horarios.Fecha_horario, horarios.Hora_horario");
	
    
    $num=mysql_num_rows($cadmed);    
    $cmed='0000';
    $care='0000';    
    $n=0;
    while($rcm=mysql_fetch_array($cadmed))
    {           
        $pdf->SetFont('Arial','B',7);
        $codmedico=$rcm['cod_medi']; 
        $nommedico=$rcm['nom_medi'];
        $codarea=$rcm['Cserv_horario'];
        $nomarea=$rcm['nom_areas'];
        $tipdoc=$rcm['TDOC_USU'];
        $cedusu=$rcm['NROD_USU'];
        $nomusu=$rcm['PNOM_USU'].' '.$rcm['SNOM_USU'].' '.$rcm['PAPE_USU'].' '.$rcm['SAPE_USU'];
        $codcontrato=$rcm['Cotra_citas'];
        $nomcontrato=$rcm['NEPS_CON'];
        $fechacita=$rcm['Fecha_horario'];
		$doccoti=$rcm['DCOT_USU'];
        $horacita=$rcm['Hora_horario'];
        $tipafi=$rcm['Tusua_citas'];
		$tipafi=substr($tipafi,0,1);
        $estacontra=$rcm['ESTA_UCO'];

		$bnar=mysql_query("SELECT areas.cod_areas, areas.nom_areas, areas.equi_area, areas_1.nom_areas AS narea
		FROM areas INNER JOIN areas AS areas_1 ON areas.equi_area = areas_1.cod_areas
		WHERE (((areas.cod_areas)='$codarea'))");
		while($rnar=mysql_fetch_array($bnar))
        {
			$nomarea=$rnar['narea'];		
		}
		
        if($n%49==0 || $codmedico!=$cmed)
        {
            	
			if($codmedico!=$cmed)
            {
                if($n!=0)
				{
					$pdf->SetXY(20, 235);
					//$pdf->SetXY(20, $ver);
					$pdf->SetFont('Arial','',11);
					$pdf->Cell(34,4,'Total : --------  '.$n, 0, 0,C);
				}
				$cmed=$codmedico;
                $n=0;
            }
            if($codarea!=$care)
            {
                if($n!=0)
				{
					$pdf->SetXY(20, 235);
					$pdf->SetFont('Arial','',11);
					$pdf->Cell(34,4,'Total : --------  '.$n, 0, 0,C);
				}
				$care=$codarea;
                $n=0;
            }
            cabeza($pdf);
            $hor=10;
            $ver=20;
            $pdf->SetXY($hor, $ver);
            $pdf->SetFont('Arial','',8);
            //$pdf->Cell(70,5,'FECHA Y HORA DE IMPRESION: '.$fecha.' '.$hora, 0, 0,L);	
            $ver=$ver+5;
            $pdf->SetXY($hor, $ver);
            $pdf->Cell(150,5,'MEDICO: '.$nommedico.'                                '.$codmedico, 0, 0,L);
            $pdf->Cell(70,5,'AREA: '.$nomarea, 0, 0,L);
            $pdf->Line($hor,$ver+7,$hor+195,$ver+7);                
            $ver=$ver+7;
            $pdf->SetFont('Arial','',7);
            $pdf->SetXY($hor, $ver);
            if($codarea==26 || $codarea==85 || $codarea==86)
            {  
                $pdf->Cell(30,5,'IDENTIFICACION', 0, 0,C);
                $pdf->Cell(80,5,'NOMBRE', 0, 0,C);
                $pdf->Cell(16,5,'CONT', 0, 0,C);
                $pdf->Cell(14,5,'HORA', 0, 0,C);
                $pdf->Cell(14,5,'EST', 0, 0,C);
                $pdf->Cell(56,5,'FIRMA', 0, 0,C);
                $ver=$ver+5;
                $pdf->SetXY($hor, $ver);
                $pdf->Cell(22,5,'FECHA DE LA CITA:  '.$fechacita, 0, 0,C);
            }
            else
            {  
                $pdf->Cell(30,5,'IDENTIFICACION', 0, 0,C);
                $pdf->Cell(80,5,'NOMBRE',0,0,C);
                $pdf->Cell(10,5,'T. USU',0,0,C);
                $pdf->Cell(16,5,'CONTRATO',0,0,C);
                $pdf->Cell(18,5,'FECHA',0,0,C);
                $pdf->Cell(14,5,'HORA',0,0,C);
                $pdf->Cell(12,5,'ESTADO',0,0,C);
                $pdf->Cell(20,5,'ID/COT',0,0,C);
            }
            $pdf->Line($hor,$ver+5,$hor+195,$ver+5); 
            $ver=$ver+10;
        }
        $horacita=substr($horacita,11,5); 
        if($codarea==26 || $codarea==85 || $codarea==86)
        {       
            $pdf->SetXY($hor, $ver);
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(30,5,$cedusu,0,0,L);
			$pdf->SetFont('Arial','',11);
            $pdf->Cell(80,5,$nomusu,0,0,L);
            $pdf->Cell(16,5,$codcontrato,0,0,C);
            $pdf->Cell(14,5,$horacita,0,0,C);
            $pdf->Cell(14,5,$estacontra,0,0,C);
            $pdf->Line(150, $ver+3,200,$ver+3);
        }
        else
        {       
            $pdf->SetXY($hor, $ver);
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(30,5,$cedusu,0,0,L);
			$pdf->SetFont('Arial','',11);
            $pdf->Cell(80,5,$nomusu,0,0,L);
            $pdf->Cell(10,5,$tipafi,0,0,C);
            $pdf->Cell(16,5,$codcontrato,0,0,C);
            $pdf->Cell(18,5,$fechacita,0,0,C);
            $pdf->Cell(14,5,$horacita,0,0,C);
            $pdf->Cell(12,5,$estacontra,0,0,C);
            $pdf->Cell(20,5,$doccoti,0,0,L);
        }
        
        $ver=$ver+5;
		if($ver>=230)
		{
			cabeza($pdf);
			$ver=20;
		}
        $n++;        
    }
	if($n>0)
	{
		$pdf->SetXY(20, 235);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(34,4,'Total : --------  '.$n, 0, 0,C);
	}
    $pdf->Output();
    function cabeza(&$pdf1)
    {
        $hor1=10;
        $ver1=-23;	
        $pdf1->AddPage();
        $pdf1->SetFont('Arial','B',7);
		
		
		
		
		
		$fila_=0;
		$pdf_=$pdf1;
		$imaenca="../funciones_php/img/logo_encabezado.JPG";
		$formato='FRASC-01';
		include ('../funciones_php/formatos.php');
		$fila_=$fila_+23;	
		
		/*
        $pdf1->Rect($hor1+0,$ver1+26, 195, 14);
        $pdf1->Image('img/logo.jpg',$hor1+2,$ver1+27);
        $pdf1->SetFont('Arial','B',11);
        $pdf1->Text($hor1+24,$ver1+32, 'Profesionales de la');
        $pdf1->Text($hor1+31,$ver1+37, 'Salud S.A.');
        $pdf1->SetFont('Arial','B',10);
        $pdf1->Text($hor1+67, $ver1+35, 'LISTA DE USUARIOS PROGRAMADOS');
        $pdf1->SetFont('Arial','B',6);
        $pdf1->Text($hor1+140, $ver1+29, 'CÓDIGO:');
        $pdf1->SetFont('Arial','',6);
        $pdf1->Text($hor1+139, $ver1+32, 'FRASC - 01');
        $pdf1->SetFont('Arial','B',6);
        $pdf1->Text($hor1+140, $ver1+36, 'VERSIÓN:');
        $pdf1->SetFont('Arial','',6);
        $pdf1->Text($hor1+144, $ver1+39, '03');
        $pdf1->SetFont('Arial','B',6);
        $pdf1->Text($hor1+170, $ver1+28.5, 'Fecha de elaboración:');
        $pdf1->SetFont('Arial','',6);
        $pdf1->Text($hor1+168, $ver1+30.5, '01 de Septiembre de 2003');
        $pdf1->SetFont('Arial','B',6);
        $pdf1->Text($hor1+169, $ver1+34, 'Fecha de actualización:');
        $pdf1->SetFont('Arial','',6);
        $pdf1->Text($hor1+171, $ver1+36, '25 de Enero de 2012');
        $pdf1->Text($hor1+176, $ver1+39.5, 'HOJA:   DE');	
        $pdf1->Line($hor1+15, $ver1+26,$hor1+15,$ver1+40);
        $pdf1->Line($hor1+65, $ver1+26,$hor1+65,$ver1+40);
        $pdf1->Line($hor1+135, $ver1+26,$hor1+135,$ver1+40);
        $pdf1->Line($hor1+157, $ver1+26,$hor1+157,$ver1+40);
        $pdf1->Line($hor1+135, $ver1+33,$hor1+157,$ver1+33);
        $pdf1->Line($hor1+157, $ver1+31.5,$hor1+195,$ver1+31.5);
        $pdf1->Line($hor1+157, $ver1+37.5,$hor1+195,$ver1+37.5);        
        $ver1=210;         
        $pdf1->Rect($hor1,$ver1+40, 195, 7);
        $pdf1->Line($hor1+65,$ver1+40,$hor1+65,$ver1+47);
        $pdf1->Line($hor1+140,$ver1+40,$hor1+140,$ver1+47);
        $pdf1->Text($hor1+20,$ver1+43,'ELABORADO POR:');
        $pdf1->Text($hor1+19,$ver1+45.5,'Subgerencia de salud');
        $pdf1->Text($hor1+85,$ver1+43,'REVISADO POR:');
        $pdf1->Text($hor1+79,$ver1+45.5,'Coordinador del S.G.C');
        $pdf1->Text($hor1+160,$ver1+43,'APROBADO POR:');
        $pdf1->Text($hor1+160,$ver1+45.5,'Gerente General');
		*/
    }
?>





