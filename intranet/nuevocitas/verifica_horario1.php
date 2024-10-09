<?     
    session_start();
    $usucitas=$_SESSION['usucitas'];  
    foreach($_POST as $nombre_campo => $valor)
    { 
       $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
       eval($asignacion); 
    } 
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
	
	//$pdf->AddPage();
    
    //$cad='';
	//if(!empty($municipio))$cad="AND ((municipio.CODI_MUN)='$municipio')";
    
 
 
	$cadmed=mysql_query("SELECT areas.nom_areas, medicos.cod_medi, medicos.nom_medi, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.ID_horario, horarios.Usado_horario, municipio.CODI_MUN, municipio.NOMB_MUN
	FROM ((horarios INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) INNER JOIN municipio ON areas.muni_area = municipio.CODI_MUN
	WHERE (((horarios.Fecha_horario)='$fechaini') AND ((municipio.CODI_MUN)='$municipio'))
	ORDER BY medicos.nom_medi, horarios.Fecha_horario, horarios.Hora_horario");
        
        
   
	
    
    $num=mysql_num_rows($cadmed);
    //$pdf->AddPage();
    $pdf->SetFont('Arial','B',7);
    $pdf->MultiCell(150,5,$impripor.' numero '.$imp, 0, 0,C); 
    
    
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
        $fechacita=$rcm['Fecha_horario'];
        $horacita=$rcm['Hora_horario'];
        $usado=$rcm['Usado_horario'];
        $horario=$rcm['ID_horario'];
		$codmuni=$rcm['CODI_MUN'];
		$nommuni=$rcm['NOMB_MUN'];
		
		
		
		if($impripor==1)$arere=$arereal;
		else $arere=$nomarea;
		
		
		$bnar=mysql_query("SELECT areas.cod_areas, areas.nom_areas, areas.equi_area, areas_1.nom_areas AS narea
		FROM areas INNER JOIN areas AS areas_1 ON areas.equi_area = areas_1.cod_areas
		WHERE (((areas.cod_areas)='$codarea'))");
		while($rnar=mysql_fetch_array($bnar))
        {
			$nomarea=$rnar['narea'];		
		}
        
        $bcit=mysql_query("SELECT citas.ID_horario, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, citas.Cotra_citas, contrato.NEPS_CON, citas.Tusua_citas, ucontrato.ESTA_UCO, usuario.TRES_USU, usuario.TEL2_USU 
        FROM contrato INNER JOIN ((usuario INNER JOIN citas ON usuario.CODI_USU = citas.Idusu_citas) INNER JOIN ucontrato ON (citas.Cotra_citas = ucontrato.CONT_UCO) AND (usuario.CODI_USU = ucontrato.CUSU_UCO)) ON contrato.CODI_CON = ucontrato.CONT_UCO
        WHERE (((citas.ID_horario)='$horario'))");
         
        if($usado==0)
        {
            while($rhm=mysql_fetch_array($bcit))
            { 
                $cedusu=$rhm['NROD_USU'];
                $nomusu=$rhm['PNOM_USU'].' '.$rhm['SNOM_USU'].' '.$rhm['PAPE_USU'].' '.$rhm['SAPE_USU'];
                $codcontrato=$rhm['Cotra_citas'];
                $nomcontrato=$rhm['NEPS_CON'];        
                $tipafi=$rhm['Tusua_citas'];
                $estacontra=$rhm['ESTA_UCO'];                
                $tel1=$rhm['TRES_USU'];
                $tel2=$rhm['TEL2_USU'];
            }
        }
        else
        {
            $cedusu='Libre';
            $nomusu='  '.$arere;
            $codcontrato='-';
            $nomcontrato='-';       
            $tipafi='-';
            $estacontra='-';
            $tel1='-';
            $tel2='-';
        }
        if($n%49==0 || $codmedico!=$cmed)
        {
            if($codmedico!=$cmed)
            {
                $cmed=$codmedico;
                //$n=0;
            }
            if($codarea!=$care)
            {
                $care=$codarea;
                //$n=0;
            }
            cabeza($pdf);
            $hor=10;
            $ver=20;
            $pdf->SetXY($hor, $ver);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(70,5,'FECHA Y HORA DE IMPRESION: '.$fecha.' '.$hora, 0, 0,L);	
            $ver=$ver+5;
            $pdf->SetXY($hor, $ver);
            $pdf->Cell(100,5,'MEDICO: '.$nommedico.'         '.$codmedico, 0, 0,L);
            $pdf->Cell(60,5,'AREA: '.$nomarea, 0, 0,L);
			$pdf->Cell(50,5,'MUNICIPIO: '.$nommuni, 0, 0,L);
            $pdf->Line($hor,$ver+7,$hor+195, $ver+7);                
            $ver=$ver+7;
            $pdf->SetFont('Arial','',7);
            $pdf->SetXY($hor, $ver);
            $pdf->Cell(22,5,'IDENTIFICACION', 0, 0,C);
            $pdf->Cell(75,5,'NOMBRE', 0, 0,C);
            $pdf->Cell(20,5,'TELEFONO 1', 0, 0,C);
            $pdf->Cell(16,5,'TELEFONO 2', 0, 0,C);
            $pdf->Cell(16,5,'FECHA', 0, 0,C);
            $pdf->Cell(14,5,'HORA', 0, 0,C);
            $pdf->Cell(14,5,'ESTADO', 0, 0,C);
            $pdf->Cell(20,5,'CONTRATO', 0, 0,C);
            $pdf->Line($hor,$ver+5,$hor+195, $ver+5); 
            $ver=$ver+10;
        }
        $horacita=substr($horacita,11,5);            
        $pdf->SetXY($hor, $ver);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(22,4,$cedusu, 0, 0,L);
        $pdf->Cell(75,4,$nomusu, 0, 0,L);
        $pdf->Cell(20,4,$tel1, 0, 0,L);
        $pdf->Cell(20,4,$tel2, 0, 0,L);
        $pdf->Cell(16,4,$fechacita, 0, 0,C);
        $pdf->Cell(12,4,$horacita, 0, 0,C);
        $pdf->Cell(12,4,$estacontra, 0, 0,C);
        $pdf->Cell(16,4,$codcontrato, 0, 0,C);            
        $ver=$ver+4;
        $n++;
    }
    
    
    $pdf->Output();
    function cabeza(&$pdf1)
    {
        $hor1=10;
        $ver1=-25;	
        $pdf1->AddPage();
        $pdf1->SetFont('Arial','B',7);
		/*
        $pdf1->Rect($hor1+0,$ver1+26, 195, 14);
        $pdf1->Image('img/logo.PNG',$hor1+2,$ver1+27);
        $pdf1->SetFont('Arial','B',11);
        $pdf1->Text($hor1+24,$ver1+32, 'Profesionales de la');
        $pdf1->Text($hor1+31,$ver1+37, 'Salud S.A.');
        $pdf1->SetFont('Arial','B',10);
        $pdf1->Text($hor1+78, $ver1+35, 'CANCELACION DE CITAS');
        $pdf1->SetFont('Arial','B',6);
        $pdf1->Text($hor1+140, $ver1+29, 'CÓDIGO:');
        $pdf1->SetFont('Arial','',6);
        $pdf1->Text($hor1+139, $ver1+32, 'FRASC - 05');
        $pdf1->SetFont('Arial','B',6);
        $pdf1->Text($hor1+140, $ver1+36, 'VERSIÓN:');
        $pdf1->SetFont('Arial','',6);
        $pdf1->Text($hor1+144, $ver1+39, '02');
        $pdf1->SetFont('Arial','B',6);
        $pdf1->Text($hor1+170, $ver1+28.5, 'Fecha de elaboración:');
        $pdf1->SetFont('Arial','',6);
        $pdf1->Text($hor1+168, $ver1+30.5, '18 de Abril de 2007');
        $pdf1->SetFont('Arial','B',6);
        $pdf1->Text($hor1+169, $ver1+34, 'Fecha de actualización:');
        $pdf1->SetFont('Arial','',6);
        $pdf1->Text($hor1+171, $ver1+36, '25 de Enero de 2012');
        $pdf1->Text($hor1+176, $ver1+39.5, 'HOJA:   DE');	
        $pdf1->Line($hor1+15, $ver1+26,$hor1+15 , $ver1+40);
        $pdf1->Line($hor1+65, $ver1+26,$hor1+65 , $ver1+40);
        $pdf1->Line($hor1+135, $ver1+26,$hor1+135 , $ver1+40);
        $pdf1->Line($hor1+157, $ver1+26,$hor1+157 , $ver1+40);
        $pdf1->Line($hor1+135, $ver1+33,$hor1+157 , $ver1+33);
        $pdf1->Line($hor1+157, $ver1+31.5,$hor1+195 , $ver1+31.5);
        $pdf1->Line($hor1+157, $ver1+37.5,$hor1+195 , $ver1+37.5);        
        $ver1=210;         
        $pdf1->Rect($hor1,$ver1+40, 195, 7);
        $pdf1->Line($hor1+65,$ver1+40,$hor1+65,$ver1+47);
        $pdf1->Line($hor1+140,$ver1+40,$hor1+140,$ver1+47);
        $pdf1->Text($hor1+20, $ver1+43,'ELABORADO POR:');
        $pdf1->Text($hor1+19, $ver1+45.5,'Subgerencia de salud');
        $pdf1->Text($hor1+85, $ver1+43,'REVISADO POR:');
        $pdf1->Text($hor1+79, $ver1+45.5,'Coordinador del S.G.C');
        $pdf1->Text($hor1+160, $ver1+43,'APROBADO POR:');
        $pdf1->Text($hor1+160, $ver1+45.5,'Gerente General');
		*/
    }
?>





