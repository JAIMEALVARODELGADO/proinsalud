<?     
	require('fpdf.php');
	$usucitas=$_SESSION['usucitas'];  
    foreach($_POST as $nombre_campo => $valor)
    { 
       $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
       eval($asignacion); 
    }     
    $pdf=new FPDF('L','mm','Letter');
    $pdf->SetFont('Arial','',8);
    include ('php/conexion1.php');    
    set_time_limit (10000);
	
	mysql_query("CREATE TEMPORARY TABLE `tempcitas` (
	`PNOM_USU` VARCHAR( 40 ) NULL ,
	`SNOM_USU` VARCHAR( 40 ) NULL ,
	`PAPE_USU` VARCHAR( 40 ) NULL ,
	`SAPE_USU` VARCHAR( 40 ) NULL ,
	`NROD_USU` VARCHAR( 20 ) NULL ,
	`DIRE_USU` VARCHAR( 50 ) NULL,
	`TRES_USU` VARCHAR( 20 ) NULL,
	`TEL2_USU` VARCHAR( 20 ) NULL,
	`Fsolusu_citas` DATE NULL,
	`Fecha_horario` DATE NULL	
	) ENGINE = MYISAM") ;
	
    $fecha=date("Y-m-d");
    $hora=date("H:i:s");   
	
	$cadcontra='';
	if($contra!='1')
	{
		$cadcontra=" and Cotra_citas='$contra'";
		$bcon=mysql_query("SELECT CODI_CON, NEPS_CON FROM contrato WHERE CODI_CON='$contra'");	
		$rcon=mysql_fetch_array($bcon);
		$descontra=$rcon['NEPS_CON'];
	}
	else $descontra="TODOS";
	for($n=0;$n<$fin;$n++)
	{		
		$nomvar='codarea'.$n;
		$codarea=$$nomvar;	
		$nomvar='selec'.$n;
		$selec=$$nomvar;		
		if($selec=='1')
		{
			$inscad=mysql_query("INSERT INTO tempcitas SELECT usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.NROD_USU, usuario.DIRE_USU, usuario.TRES_USU, usuario.TEL2_USU, citas.Fsolusu_citas, horarios.Fecha_horario
			FROM usuario INNER JOIN (citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON usuario.CODI_USU = citas.Idusu_citas
			WHERE (((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin') AND Cserv_horario='$codarea' $cadcontra) ORDER BY horarios.Fecha_horario");
		}			
	}
	$cadmed=mysql_query("SELECT * from tempcitas");
 
    $n=0;
    while($rcm=mysql_fetch_array($cadmed))
    {           
        
        $nombre=$rcm['PNOM_USU'].' '.$rcm['SNOM_USU'].' '.$rcm['PAPE_USU'].' '.$rcm['SAPE_USU']; 
		$cedusu=$rcm['NROD_USU'];
		$direccion=substr($rcm['DIRE_USU'],0,48);
		$telefonos=$rcm['TRES_USU'].'  '.$rcm['TEL2_USU'];
		$fecsoli=$rcm['Fsolusu_citas'];
		$feccita=$rcm['Fecha_horario'];
       
        if($n%42==0)
        {                
            $pdf->AddPage(); 
			$pdf->SetFont('Arial','B',7);
			$pdf->SetXY(5,7);
			$pdf->Cell(277,4,'INFORME DE CITAS ASIGNADAS DE ACUERDO A RESOLUCION No 1552 DE MAYO 14 DE 2013',0,0,C);
			$pdf->SetXY(5,11);
			$pdf->Cell(277,4,'PERIODO: '.$fechaini.' - '.$fechafin.'                 CONTRATO: '.$descontra,0,0,C);
			
			
			$pdf->SetFont('Arial','B',7);
			$pdf->Line(4,15,277,15); 
			$pdf->Line(4,22,277,22); 
            $pdf->SetXY(4,16);
            $pdf->Cell(60,4,'NOMBRE',0,0,C);
			$pdf->Cell(20,4,'CEDULA',0,0,C);
			$pdf->Cell(67,4,'DIRECCION',0,0,C);
			$pdf->Cell(31,4,'TELEFONOS',0,0,C);	
			$pdf->SetXY(182,15);
			$pdf->Cell(17,4,'FECHA DE',0,0,C);
			$pdf->Cell(17,4,'FECHA',0,0,C);
			$pdf->Cell(17,4,'FECHA',0,0,C);
			$pdf->SetXY(233,16);
			$pdf->Cell(25,4,'IPS',0,0,C);
			$pdf->Cell(20,4,'CODIGO',0,0,C);
			$pdf->SetXY(182,18);
			$pdf->Cell(17,4,'SOLICITUD',0,0,C);
			$pdf->Cell(17,4,'SOLICITADA',0,0,C);
			$pdf->Cell(17,4,'ASIGNADA',0,0,C);
            $fila=20; 
        }
		$pdf->SetFont('Arial','',7);
		$fila=$fila+4;
		$pdf->SetXY(4,$fila);
		$pdf->Cell(60,4,$nombre,0);
		$pdf->Cell(20,4,$cedusu,0);
		$pdf->Cell(67,4,$direccion,0);
		$pdf->Cell(31,4,$telefonos,0);
		$pdf->Cell(17,4,$fecsoli,0,0,C);
		$pdf->Cell(17,4,$feccita,0,0,C);
		$pdf->Cell(17,4,$feccita,0,0,C);
		$pdf->Cell(25,4,'PROINSALUD S.A.',0,0,C);
		$pdf->Cell(20,4,'520010066901',0,0,C);       
        $n++;
    }   
    $pdf->Output();
	
    
?>





