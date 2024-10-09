<?     
    session_start();
    $usucitas=$_SESSION['usucitas'];  
    foreach($_POST as $nombre_campo => $valor)
    { 
       $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
       eval($asignacion); 
    } 
    require('fpdf.php');
    $pdf=new FPDF('L','mm','Letter');
    //$pdf=new FPDF('L','mm',array(215,260));
    $pdf->SetFont('Arial','',8);
    include ('php/conexion1.php');    
    set_time_limit (10000);
    $fecdig=(date("Y-m-d"));
    $hora=(date("H-i")); 
    $fecha=date("Y-m-d");
    $hora=date("H:i:s");
    
	$cad='';
    if($contra<>'')$cad=" AND contrato.CODI_CON='$contra'";
	
	
	if ($jornada=='D')
    {
        $horai="0001-01-01 01:00:00";
        $horaf="0001-01-01 24:00:00";
    }

    if ($jornada=='M')
    {
        $horai="0001-01-01 01:00:00";
        $horaf="0001-01-01 12:59:00";
    }
    if ($jornada=='T')
    {
        $horai="0001-01-01 13:00:00";
        $horaf="0001-01-01 24:00:00";
    }

    if($impripor==1)
    {
     /*   
        $cadmed=mysql_query("SELECT areas.nom_areas, medicos.cod_medi, medicos.nom_medi, horarios.Cserv_horario, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, citas.Cotra_citas, contrato.NEPS_CON, horarios.Fecha_horario, horarios.Hora_horario, citas.Tusua_citas, ucontrato.ESTA_UCO, grup_area.cogr_grar, usuario.FNAC_USU
        FROM (contrato INNER JOIN (((usuario INNER JOIN ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) ON usuario.CODI_USU = citas.Idusu_citas) INNER JOIN ucontrato ON (usuario.CODI_USU = ucontrato.CUSU_UCO) AND (citas.Cotra_citas = ucontrato.CONT_UCO)) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) ON contrato.CODI_CON = ucontrato.CONT_UCO) INNER JOIN grup_area ON areas.cod_areas = grup_area.coar_grar
        WHERE (((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin') AND ((horarios.Hora_horario)>='$horai' And (horarios.Hora_horario)<='$horaf') AND ((grup_area.cogr_grar)='$grupo') AND Clase_citas<'6' $cad) 
        ORDER BY areas.nom_areas, medicos.nom_medi, horarios.Fecha_horario, horarios.Hora_horario");
    */
		$cadmed=mysql_query("SELECT medicos.cod_medi, areas_1.nom_areas, medicos.nom_medi, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, citas.Cotra_citas, contrato.NEPS_CON, horarios.Fecha_horario, horarios.Hora_horario, citas.Tusua_citas, ucontrato.ESTA_UCO, usuario.FNAC_USU, citas.Clase_citas, grup_area.cogr_grar
		FROM (((contrato INNER JOIN ((usuario INNER JOIN ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) ON usuario.CODI_USU = citas.Idusu_citas) INNER JOIN ucontrato ON (citas.Cotra_citas = ucontrato.CONT_UCO) AND (usuario.CODI_USU = ucontrato.CUSU_UCO)) ON contrato.CODI_CON = ucontrato.CONT_UCO) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) INNER JOIN areas AS areas_1 ON areas.equi_area = areas_1.cod_areas) INNER JOIN grup_area ON areas_1.equi_area = grup_area.coar_grar
		WHERE (((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin') AND ((horarios.Hora_horario)>='$horai' And (horarios.Hora_horario)<='$horaf') AND ((citas.Clase_citas)<'6') AND ((grup_area.cogr_grar)='$grupo') $cad)
		ORDER BY areas_1.nom_areas, medicos.nom_medi, horarios.Fecha_horario, horarios.Hora_horario");
	
	
	}    
    if($impripor==2)
    {
        $cmed='0000';
        $care='0000';
        $cadmed=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi, horarios.Cserv_horario, areas.nom_areas, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, citas.Cotra_citas, contrato.NEPS_CON, horarios.Fecha_horario, horarios.Hora_horario, citas.Tusua_citas, ucontrato.ESTA_UCO, usuario.FNAC_USU
        FROM contrato INNER JOIN (((usuario INNER JOIN ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) ON usuario.CODI_USU = citas.Idusu_citas) INNER JOIN ucontrato ON (citas.Cotra_citas = ucontrato.CONT_UCO) AND (usuario.CODI_USU = ucontrato.CUSU_UCO)) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) ON contrato.CODI_CON = ucontrato.CONT_UCO
        WHERE horarios.Cserv_horario='$codarea' AND horarios.Fecha_horario>='$fechaini' And horarios.Fecha_horario<='$fechafin' 
        AND horarios.Hora_horario>='$horai' And horarios.Hora_horario<='$horaf' AND Clase_citas<'6' $cad
        ORDER BY medicos.nom_medi, horarios.Fecha_horario, horarios.Hora_horario");
        
        
    }
    if($impripor==3)
    {
        $cadmed=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi, horarios.Cserv_horario, areas.nom_areas, usuario.TDOC_USU, usuario.SEXO_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, citas.Cotra_citas, contrato.NEPS_CON, horarios.Fecha_horario, horarios.Hora_horario, citas.Tusua_citas, ucontrato.ESTA_UCO, usuario.FNAC_USU
        FROM contrato INNER JOIN (((usuario INNER JOIN ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) ON usuario.CODI_USU = citas.Idusu_citas) INNER JOIN ucontrato ON (usuario.CODI_USU = ucontrato.CUSU_UCO) AND (citas.Cotra_citas = ucontrato.CONT_UCO)) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) ON contrato.CODI_CON = ucontrato.CONT_UCO
        WHERE medicos.cod_medi='$codmedi' AND horarios.Fecha_horario>='$fechaini' And horarios.Fecha_horario<='$fechafin'
        AND horarios.Hora_horario>='$horai' And horarios.Hora_horario<='$horaf' AND Clase_citas<'6' $cad
        ORDER BY horarios.Fecha_horario, horarios.Hora_horario");
    }
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
        $nomusu=$rcm['PNOM_USU'].' '.$rcm['SNOM_USU'];
        $apeusu=$rcm['PAPE_USU'].' '.$rcm['SAPE_USU'];
        $codcontrato=$rcm['Cotra_citas'];
        $nomcontrato=$rcm['NEPS_CON'];
        $fechacita=$rcm['Fecha_horario'];
        $horacita=$rcm['Hora_horario'];
        $tipafi=$rcm['Tusua_citas'];
        $estacontra=$rcm['ESTA_UCO'];  
        $fecnac=$rcm['FNAC_USU'];  
		$sexo=$rcm['SEXO_USU']; 
        if($n%12==0 || $codmedico!=$cmed)
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
            $pdf->AddPage();
            $pdf->Image('img/enca_rips2.JPG',5,10,269,0,'','');
            $pdf->Image('img/PIE3.JPG',5,194,269,0,'','');           
            $hor=10;
            $ver=20;
            $pdf->SetXY(238,38);
            $pdf->Cell(40,5,$fecdig,0);
            $pdf->SetXY(255,38);
            $pdf->Cell(40,5,$hora,0);
            $pdf->SetXY(34,38);
            $pdf->Cell(40,5,$nommedico,0);		  
            $pdf->SetXY(90,38);
            $pdf->Cell(40,5,$codmedico,0);
            $pdf->SetXY(155,38);
            $pdf->Cell(40,5,$nomarea,0);
            $pdf->SetXY(130,38);
            $pdf->Cell(40,5,$fechacita,0);
            $fila=72;   
            
        }
        $edad=calculaedad($fecnac);
        $horacita=substr($horacita,11,5);            
        //$pdf->Image('img/cuerpo2.JPG',95,$fila,180,9,'','');
        $pdf->SetXY(4,$fila+2);
        $pdf->Cell(40,5,$horacita,0);
        $pdf->SetXY(14,$fila+2);
        $pdf->Cell(40,5,substr($codcontrato,1),0);
        $pdf->SetXY(19,$fila+2);
        $pdf->Cell(40,5,$cedusu,0);
        $pdf->SetXY(48,$fila);
        $pdf->Cell(40,5,$nomusu,0);
        $pdf->SetXY(48,$fila+4);
        $pdf->Cell(40,5,$apeusu,0);
        $pdf->SetXY(92,$fila+2);
        $pdf->Cell(40,5,substr($tipafi,0,1),0);
        //$pdf->SetXY(113,$fila+2);
        //$pdf->Cell(40,5,$fecnac,0);
        $pdf->SetXY(100,$fila+2);
        $pdf->Cell(40,5,$edad,0);
		$pdf->SetXY(110,$fila+2);
        $pdf->Cell(40,5,$sexo,0);
		$pdf->Image('img/cuerpo1.JPG',115,$fila,140,9,'','');
        $fila=$fila+10;
        $n++;
    }   
    $pdf->Output();
    
    
    

function calculaedad($fecha_)
{
    $ano_=substr($fecha_,0,4);
    $mes_=substr($fecha_,5,2);
    $dia_=substr($fecha_,8,2);
    if($mes_==2)
    {
        $diasmes_=28;    
    }
    else
    {
        if($mes_==1 || $mes_==3 || $mes_==5 || $mes_==7 || $mes_==8 || $mes_==10 || $mes_==12)
        {
            $diasmes_=31;
        }
        else
        {
            $diasmes_=30;        
        }
    }
    $anos_=date("Y")-$ano_;
    $meses_=date("m")-$mes_;
    $dias_=date("d")-$dia_;    
    if($dias_<0)
    {
        if($meses_>0)
        {
            $meses_=$meses_-1;
        }
        $dias_=$diasmes_+$dias_;
    }
    if($meses_<0)
    {
        $meses_=12+$meses_;
        if(date("d")-$dia_<0)
        {
            $meses_=$meses_-1;        
        }
        $anos_=$anos_-1;
    }
    if($meses_==0 & date("d")-$dia_<0 & $anos_>0)
    {
        if(date("m")-$mes_==0 & date("d")-$dia_<0){$anos_=$anos_-1;}
        $meses_=11;
    }
    if($anos_<>0)
    {
        $edad_=$anos_;
        if($edad_==1)
        {
            $unidad_=" A";        
        }
        else
        {
            $unidad_=" A";        
        }
    }
    else
    {
        if($meses_<>0)
        {
            $edad_=$meses_;
            if($edad_==1){
            $unidad_=" M";}
            else{
            $unidad_=" M";}
        }
        else
        {
            $edad_=$dias_;
            if($edad_==1)
            {
                $unidad_=" D";       
            }
            else
            {
                $unidad_=" D";
            }
        }
    }
    return($edad_.$unidad_);  
}
    
    
    
   
?>





