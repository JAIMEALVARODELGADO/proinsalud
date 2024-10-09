<?
	require('fpdf.php');
	include("funciones.php");
    $pdf=new FPDF('P','mm','letter');
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',9);

	$link=Mysql_connect("localhost","root","");
    if(!$link)echo"no hay conexion";
    Mysql_select_db('proinsalud',$link);

	$cad3="select l.fech_lec,l.lect_lec,u.nrod_usu,u.pnom_usu,u.snom_usu,u.pape_usu,u.sape_usu,c.descrip from lectura_imagen AS l 
	INNER JOIN usuario AS u ON u.codi_usu=l.codi_usu 
	INNER JOIN cups AS c ON c.codigo=l.copr_lec where l.iden_lec='$iden_lec'";
	$resul3=Mysql_query($cad3,$link);
	if(mysql_num_rows($resul3)<>0){
	  $row3=mysql_fetch_array($resul3);
      $pdf->Image('img/encabeza.png',20,2,180,25);
      $pdf->Line(0,30,215,30);
      $pdf->Text(20,40,'FECHA:');
      $pdf->Text(50,40,cambiafechadmy($row3[fech_lec]));
      $pdf->Text(20,45,'NOMBRE:');
      $pdf->Text(50,45,$row3[pnom_usu].' '.$row3[snom_usu].' '.$row3[pape_usu].' '.$row3[sape_usu]);
      $pdf->Text(20,50,'ESTUDIO:');
      $pdf->SetY(47);
      $pdf->SetX(49);
      $pdf->MultiCell(150, 5, $row3[descrip],0, J,0); 
      $ver=$pdf->GetY();
      $pdf->Text(20, $ver+5,'CEDULA:');
      $pdf->Text(50, $ver+5,$row3[nrod_usu]);
      $pdf->Text(90, $ver+15,'INFORME');		
      $pdf->SetY($ver+25);
      $pdf->SetX(20);
      $pdf->MultiCell(180, 5, $row3[lect_lec],0, J,0); 
	}	
	$ver=$pdf->GetY();
	$pdf->Text(20, $ver+25,'Atte.');
	$pdf->Text(20, $ver+55,'MEDICO RADIOLOGO');
    
    $pdf->Output();
	
	//echo "<body onload=window.open('imagen0.php?cuentas1=0','area')>";
	//echo "</body>";
	
	
?>
