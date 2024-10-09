<?
    require('fpdf.php');
    $pdf=new FPDF('P','mm','letter');
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
    $fila=600;
	
	
	include ('php/conexion2.php');
	
	if($contrato=='00')$cad="";
	else $cad="AND ((citas.Cotra_citas)='$contrato')";
	$busca=mysql_query("SELECT municipio.CODI_MUN, municipio.NOMB_MUN, usuario.NROD_USU, esta_cita.descrip_estaci, cups_citas_medicas.codi_cup, 
	cups_citas_medicas.Nombre, citas.Fsolusu_citas, citas.fecdeseada, horarios.Fecha_horario
	FROM ((((((horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) INNER JOIN destipos ON areas.codi_des = destipos.codi_des) INNER JOIN cups_citas_medicas ON destipos.codi_des = cups_citas_medicas.especialidad) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU) LEFT JOIN municipio ON areas.muni_area = municipio.CODI_MUN) INNER JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci
	WHERE (((horarios.Fecha_horario)>='$fecini' And (horarios.Fecha_horario)<='$fecfin') AND ((areas.arci_area)='5801') $cad)");
	$m=1;	
	while($rini=mysql_fetch_array($busca))
	{
		if($fila>245)
		{
			$pdf->SetDrawColor(0, 0, 0);
			$pdf->AddPage();
			$fila=0;
			$fila_=$fila;
			$pdf_=$pdf;
			$formato='FASIS-103';
			$imaenca="../funciones_php/img/logo_encabezado.JPG";
			include ('../funciones_php/formatos.php');
			$fila=25;
			
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(40,6,'NIT PRESTADOR', 1, 0,C);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(40,6,'800.176.807-4', 1, 0,C);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(50,6,'NOMBRE_PRESTADOR', 1, 0,C);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(75,6,'PROFESIONALES DE LA SALUD S.A.', 1, 0,C);
			$fila=$fila+8;
			
			$pdf->SetFont('Arial','B',7);

		
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(16,4,'CODIGO MUNICIPIO',1,C,0);
			$pdf->SetXY(21,$fila);		
			$pdf->MultiCell(25,8,'MUNICIPIO',1,C,0);
			$pdf->SetXY(46,$fila);
			$pdf->MultiCell(15,4,'ID PACIENTE',1,C,0);
			$pdf->SetXY(61,$fila);
			$pdf->MultiCell(25,8,'ESTADO CITA',1,C,0);
			$pdf->SetXY(86,$fila);
			$pdf->MultiCell(15,4,'CODIGO SERVICIO',1,C,0);
			$pdf->SetXY(101,$fila);
			$pdf->MultiCell(55,8,'SERVICIO PRESTADO',1,C,0);
			$fila1=$pdf->GetY();
			$pdf->SetXY(156,$fila);
			$pdf->MultiCell(18,4,'FECHA SOLICITUD',1,C,0);
			$pdf->SetXY(174,$fila);
			$pdf->MultiCell(18,4,'FECHA DESEADA',1,C,0);
			$pdf->SetXY(192,$fila);		
			$pdf->MultiCell(18,4,'FECHA ASIGNACION',1,C,0);
			$fila=$fila1;
			$fila=$fila+4;
			
			
		}
		
		$codmuni=$rini['CODI_MUN'];
		$nommuni=$rini['NOMB_MUN'];
		$documen=$rini['NROD_USU'];
		$estado=$rini['descrip_estaci'];
		$codicup=$rini['codi_cup'];
		$nomcup=$rini['Nombre'];
		$fsolicitud=date("d/m/Y", strtotime($rini['Fsolusu_citas']));
		$fecdeseada=date("d/m/Y", strtotime($rini['fecdeseada']));
		$fechaatencion=date("d/m/Y", strtotime($rini['Fecha_horario']));
			
		$pdf->SetFont('Arial','',8);
		$pdf->SetDrawColor(190, 190, 190);
		
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(16,4,$codmuni,0,C,0);
		$pdf->SetXY(21,$fila);		
		$pdf->MultiCell(25,4,$nommuni,0,C,0);
		$pdf->SetXY(46,$fila);
		$pdf->MultiCell(15,4,$documen,0,C,0);
		$pdf->SetXY(61,$fila);
		$pdf->MultiCell(25,4,$estado,0,L,0);
		$pdf->SetXY(86,$fila);
		$pdf->MultiCell(15,4,$codicup,0,C,0);
		$pdf->SetXY(101,$fila);
		$pdf->MultiCell(55,4,$nomcup,1,L,0);
		$fila1=$pdf->GetY();
		$pdf->SetXY(156,$fila);
		$pdf->MultiCell(18,4,$fsolicitud,0,C,0);
		$pdf->SetXY(174,$fila);
		$pdf->MultiCell(18,4,$fecdeseada,0,C,0);
		$pdf->SetXY(192,$fila);		
		$pdf->MultiCell(18,4,$fechaatencion,0,C,0);
		
		$pdf_->rect(5,$fila,16,$fila1-$fila);
		$pdf_->rect(21,$fila,25,$fila1-$fila);
		$pdf_->rect(46,$fila,15,$fila1-$fila);
		$pdf_->rect(61,$fila,25,$fila1-$fila);
		$pdf_->rect(86,$fila,15,$fila1-$fila);
		$pdf_->rect(156,$fila,18,$fila1-$fila);
		$pdf_->rect(174,$fila,18,$fila1-$fila);
		$pdf_->rect(192,$fila,18,$fila1-$fila);
		
		
		$fila=$fila1;
	}   
    
    $pdf->Output();
?>

