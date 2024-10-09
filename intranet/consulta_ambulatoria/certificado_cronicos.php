<?php
	session_start();
	$usuariocon=$_SESSION[Gidusuryc];
	/*
	if(empty($usuariocon))
	{
		echo"
		<br><br><br><br><br>
		<center>
		<h2><font color=#0240A3>
		Por seguridad el sistema cerrÃ³ su sesiÃ³n<br><br>
		Por favor cierre la aplicaciÃ³n e ingrese nuevamente.
		</font></h2>
		</center>";
		exit();
	}
	*/
    require('fpdf.php');
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
	date_default_timezone_set ("America/Bogota");
	
	$anohoy=date('Y');
	$meshoy=date('m');
	$diahoy=date('d');
	
	$fecha=date('Y-m-d');
	$hora=date('H:i:s');
	
	if($meshoy=='01')$meshoy='Enero';
	if($meshoy=='02')$meshoy='Febrero';
	if($meshoy=='03')$meshoy='Marzo';
	if($meshoy=='04')$meshoy='Abril';
	if($meshoy=='05')$meshoy='Mayo';
	if($meshoy=='06')$meshoy='Junio';
	if($meshoy=='07')$meshoy='Julio';
	if($meshoy=='08')$meshoy='Agosto';
	if($meshoy=='09')$meshoy='Septiembre';
	if($meshoy=='10')$meshoy='Octubre';
	if($meshoy=='11')$meshoy='Noviembre';
	if($meshoy=='12')$meshoy='Diciembre';
	
	$pdf=new FPDF('P','mm','Letter');
	
	$pdf->AddPage();
	include('php/conexion1.php');
	set_time_limit (300);
	$pdf->SetFont('Arial','',12);
	$numhisto='15012066141205150617';
	
	$busu=mysql_query("SELECT encabesadohistoria.numc_ehi, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, 
	consultaprincipal.come_cpl, medicos.nom_medi, medicos.reg_medi, consultaprincipal.cod1_cpl, cie_10.nom_cie10
	FROM (((encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) INNER JOIN usuario ON encabesadohistoria.cous_ehi = usuario.CODI_USU) INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi) INNER JOIN cie_10 ON consultaprincipal.cod1_cpl = cie_10.cod_cie10
	WHERE (((encabesadohistoria.numc_ehi)='$numhisto'))");
	while($rusu=mysql_fetch_array($busu))
	{
		$codigo_usu=$rusu['numc_ehi'];	
		$tipodoc=$rusu['TDOC_USU'];
		$documento=$rusu['NROD_USU'];
		$nombre=$rusu['PNOM_USU'].' '.$rusu['SNOM_USU'].' '.$rusu['PAPE_USU'].' '.$rusu['SAPE_USU'];
		$codmedico=$rusu['come_cpl'];
		$nommedico=$rusu['nom_medi'];
		$regmedico=$rusu['reg_medi'];
		$cod1_cpl=$rusu['cod1_cpl'];
		$nom_cie10=ucfirst(strtolower($rusu['nom_cie10']));		
		
		if($tipodoc=='CC')$tipo="cedula de ciudadania";      
		if($tipodoc=='TI')$tipo="tarjera de identidad";      
		if($tipodoc=='RC')$tipo="registro civil";     
		if($tipodoc=='CE')$tipo="cedula de extranjeria";      
		if($tipodoc=='PA')$tipo="pasaporte"; 
	}		
	
	$pdf->Image('img\cabeza_certicronicos.JPG',10,2,190,0,'','');
	
	$esp=7;
	$izq=30;
	$fila=35;
	
	$pdf->SetXY($izq,$fila);
	$pdf->Cell(160,5,'A QUIEN INTERESE',0,0,C);
	
	$fila=$fila+$esp+$esp;
	$pdf->SetXY($izq,$fila);
	$pdf->MultiCell(160,6, "El suscrito medico de PROINSALUD S.A. Consulta Externa certifica que: el señor(a) ".$nombre." Identificado(a) con ".$tipo." No. ".$documento." de ".$ciudadexpe." una vez revisado su historia cl�nica presenta a la fecha los siguientes Diagn�sticos:", 0,J,0);
	
	$fila=$pdf->GetY()+$esp;
	$pdf->SetXY($izq,$fila);
	
	$pdf->Cell(50,5,'Diagnostico principal ',0,0,L);
	$pdf->MultiCell(115,6,$nom_cie10, 0,L,0);
	
	$fila=$pdf->GetY()+$esp;
	$pdf->SetXY($izq,$fila);
	
	$bdiag=mysql_query("SELECT diagnosticos2.codc_di2, cie_10.nom_cie10, diagnosticos2.orde_die2
	FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10
	WHERE (((diagnosticos2.numc_di2)='$numhisto'))
	ORDER BY diagnosticos2.orde_die2");
	$n=2;
	while($rdiag=mysql_fetch_array($bdiag))
	{
		$cod_diag=$rdiag['codc_di2'];	
		$nom_diag=ucfirst (strtolower ($rdiag['nom_cie10']));
		$orden=$rdiag['orde_die2'];
		
		if($orden=='R1')
		{
			$fila=$pdf->GetY()+$esp;
			$pdf->SetXY($izq,$fila);
			
			$pdf->Cell(50,5,'Diagnnstico secundario ',0,0,L);
			$pdf->MultiCell(115,6,$nom_diag, 0,L,0);
		}
		if($orden=='R2')
		{
			$fila=$pdf->GetY()+$esp;
			$pdf->SetXY($izq,$fila);
			$pdf->Cell(55,5,'Otros diagnosticos             1',0,0,L);
			$pdf->MultiCell(115,6,$nom_diag, 0,L,0);
			
		}


		if($orden=='R3' || $orden=='R4' || $orden=='R5')
		{
			$fila=$pdf->GetY()+$esp;
			$pdf->SetXY($izq,$fila);
			$pdf->Cell(55,5,$n,0,0,R);
			$pdf->MultiCell(115,6,$nom_diag, 0,L,0);
			$n++;
		}		
	}	
	$fila=$pdf->GetY()+$esp;
	$pdf->SetXY($izq,$fila);
	$pdf->MultiCell(160,6,"Para constancia se firma a los ".$diahoy." del mes de ".$meshoy." del ".$anohoy, 0,L,0);
	
	$fila=$pdf->GetY()+$esp;
	$pdf->SetXY($izq,$fila);
	$pdf->Cell(50,5,'Nombre profesional',0,0,L);
	$pdf->MultiCell(115,6,$nommedico, 0,L,0);
	
	$fila=$pdf->GetY();
	$pdf->SetXY($izq,$fila);
	$pdf->Cell(50,5,'Registro medico',0,0,L);
	$pdf->MultiCell(115,6,$regmedico, 0,L,0);
	
	$fila=$pdf->GetY();
	$pdf->SetXY($izq,$fila);
	$pdf->Cell(50,5,'Firma',0,0,L);
	
	$firma="../firmas/".$codmedico.".jpg";
	if(file_exists($firma)){
	  $pdf->Image($firma,78,$fila,50,15,'','');
	}
	
	$pdf->Image('img\pie_certicronicos.JPG',10,260,190,0,'','');
	
	$pdf->Output();
	
	
?>
<html><head></head><body></body></html>