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
    
   
    $cadena='';
    if($tipoex=='B')
    {
        $cadena=$cadena." and basico='Basico'";
        $desob='BASICO';
    }
    if($tipoex=='E')
    {
        $cadena=$cadena." and especial='Especial'";
        $desob='ESPECIAL';
    }
    if($tipoex=='R')
    {
        $cadena=$cadena." and remitidos='Remitido'";
        $desob='REMITIDOS';
    }
    if($tipoex=='')
    {
        $cadena=$cadena." and remitidos='mmmm'";
        $desob='TODOS';
    }
    if($codmedi=='')
    {
        $cadmed=mysql_query("SELECT horarios.Fecha_horario, areas.cod_areas, medicos.cod_medi, ane_lab_cit.obser, citas.Idusu_citas, contrato.CODI_CON, medicos.cod_medi, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, areas.cod_areas, citas.Tusua_citas, horarios.Hora_horario, tip_cita.des_ticita, citas.id_cita, medicos.nom_medi, areas.nom_areas, contrato.NEPS_CON, citas.Cotra_citas
        FROM (((((ane_lab_cit INNER JOIN (citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON ane_lab_cit.cod_cita = citas.id_cita) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU) INNER JOIN tip_cita ON citas.Clase_citas = tip_cita.cod_ticita) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) INNER JOIN contrato ON citas.Cotra_citas = contrato.CODI_CON
        WHERE ((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin') AND ((areas.cod_areas)='80') $cadena"); 
        
       
    }
    else
    {
        $cadmed=mysql_query("SELECT horarios.Fecha_horario, areas.cod_areas, medicos.cod_medi, ane_lab_cit.obser, citas.Idusu_citas, contrato.CODI_CON, 
        medicos.cod_medi, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, areas.cod_areas, citas.Tusua_citas, 
        horarios.Hora_horario, tip_cita.des_ticita, citas.id_cita, medicos.nom_medi, areas.nom_areas, contrato.NEPS_CON, citas.Cotra_citas
        FROM (((((ane_lab_cit INNER JOIN (citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON ane_lab_cit.cod_cita = citas.id_cita) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU) INNER JOIN tip_cita ON citas.Clase_citas = tip_cita.cod_ticita) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) INNER JOIN contrato ON citas.Cotra_citas = contrato.CODI_CON
        WHERE ((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin') AND ((medicos.cod_medi)='$codmedi') $cadena");       
    }
    
   
    
    
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
        $horacita=$rcm['Hora_horario'];
        $tipafi=substr($rcm['Tusua_citas'],0,1);
        $estacontra=$rcm['ESTA_UCO'];   
        $obse=$rcm['obser'];  
        if($n%49==0 || $codmedico!=$cmed || $care!=$codarea)
        {
            if($codmedico!=$cmed)
            {
                $cmed=$codmedico;
                $n=0;
            }
            if($codarea!=$care)
            {
                $care=$codarea;
                $n=0;
            }
            cabeza($pdf);
            $hor=10;
            $ver=20;
            $pdf->SetXY($hor, $ver);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(140,5,'FECHA Y HORA DE IMPRESION: '.$fecha.' '.$hora, 0, 0,L);
            $pdf->Cell(70,5,'FECHA AGENDA: '.$fechaini.' '.$fechafin, 0, 0,L);
            $ver=$ver+5;
            $pdf->SetXY($hor, $ver);
            $pdf->Cell(90,5,'MEDICO: '.$nommedico.'                '.$codmedico, 0, 0,L);
            $pdf->Cell(50,5,'TIPO EXAMEN:  '.$desob, 0, 0,L);
            $pdf->Cell(60,5,'AREA: '.$nomarea, 0, 0,L);
            $pdf->Line($hor,$ver+7,$hor+195, $ver+7);                
            $ver=$ver+7;
            $pdf->SetFont('Arial','',7);
            $pdf->SetXY($hor, $ver);
            
            $pdf->Cell(22,5,'IDENTIFICACION', 0, 0,C);
            $pdf->Cell(55,5,'NOMBRE', 0, 0,C);
            $pdf->Cell(16,5,'TIPO USUARIO', 0, 0,C);
            $pdf->Cell(12,5,'CONT', 0, 0,C);
            $pdf->Cell(34,5,'OBSER', 0, 0,C);
            $pdf->Cell(10,5,'HC', 0, 0,C);
            $pdf->Cell(56,5,'FIRMA', 0, 0,C);
            $pdf->Line($hor,$ver+5,$hor+195, $ver+5); 
            $ver=$ver+10;
        }         
        $pdf->SetXY($hor, $ver);
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(22,4,$cedusu, 0, 0,L);
        $pdf->Cell(55,4,substr($nomusu,0,37), 0, 0,L);
        $pdf->Cell(16,4,$tipafi, 0, 0,C);
        $pdf->Cell(12,4,$codcontrato, 0, 0,C);
        $pdf->Cell(34,4,$obse, 0, 0,L);            
        $pdf->Cell(10,4,'( )', 0, 0,C);            
        $pdf->Line(162, $ver+3,205 , $ver+3);
        
        
        $ver=$ver+4;
        $n++;
        
    }
    $pdf->SetXY(20, 235);
    $pdf->Cell(14,4,'Total : --------  '.$n, 0, 0,C);
    $pdf->Output();
    function cabeza(&$pdf1)
    {
        $hor1=10;
        $ver1=-23;	
        $pdf1->AddPage();
        $pdf1->SetFont('Arial','B',7);
        $pdf1->Rect($hor1+0,$ver1+26, 195, 14);
        $pdf1->Image('img/logo.PNG',$hor1+2,$ver1+27);
        $pdf1->SetFont('Arial','B',11);
        $pdf1->Text($hor1+24,$ver1+32, 'Profesionales de la');
        $pdf1->Text($hor1+31,$ver1+37, 'Salud S.A.');
        $pdf1->SetFont('Arial','B',10);
        $pdf1->Text($hor1+67, $ver1+32, 'LISTA DE USUARIOS PROGRAMADOS');
        $pdf1->SetFont('Arial','B',10);
        $pdf1->Text($hor1+85, $ver1+38, 'LABORATORIO');
        $pdf1->SetFont('Arial','B',6);
        $pdf1->Text($hor1+140, $ver1+29, 'CÓDIGO:');
        $pdf1->SetFont('Arial','',6);
        $pdf1->Text($hor1+139, $ver1+32, 'FRLAB - 52');
        $pdf1->SetFont('Arial','B',6);
        $pdf1->Text($hor1+140, $ver1+36, 'VERSIÓN:');
        $pdf1->SetFont('Arial','',6);
        $pdf1->Text($hor1+144, $ver1+39, '00');
        $pdf1->SetFont('Arial','B',6);
        $pdf1->Text($hor1+170, $ver1+28.5, 'Fecha de elaboración:');
        $pdf1->SetFont('Arial','',6);
        $pdf1->Text($hor1+168, $ver1+30.5, '27 de Septiembre de 2007');
        $pdf1->SetFont('Arial','B',6);
        $pdf1->Text($hor1+169, $ver1+34, 'Fecha de actualización:');
        $pdf1->SetFont('Arial','',6);
        $pdf1->Text($hor1+171, $ver1+36, '27 de Septiembre de 2007');
        $pdf1->Text($hor1+176, $ver1+39.5, 'HOJA: 1  DE 1');	
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
        
    }
?>

