<?

	//Cargo las funciones del programa
	require('fpdf.php');
	$pdf=new FPDF('P','mm','Letter');
	$pdf->SetFont('Arial','',6);
	function linea($col_,$fil_,$cant_,$car_,&$pdf)
	{
	  for($n=0;$n<$cant_;$n++){
		$pdf->SetXY($col_+$n,$fil_);
		$pdf->Cell(40,5,$car_,0);
	  }
	}
	function increm($fil,&$pdf)
	{
	  //$fil=$fil+4;
	  if($fil>=240)
	  {
		
		$pdf->AddPage();
		$fil=22;
		$pdf->Image('imagenes\Inf_espe.jpg',1,0,210,0,'','');
		$pdf->Image('imagenes\PIE1.JPG',2,265,210,0,'','');
		
		/*$pdf->SetXY(100,$fil);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(40,5,"Fecha: ".$finicial,0);	
		//$fila=$fila+4;
		$pdf->SetFont('Arial','',6);*/
		
	  }
	  return ($fil);
	}
	$fila=22;
	
	$pdf->AddPage();
	$pdf->SetXY(100,$fila);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(40,5,"Fecha: ".$finicial,0);	
	$fila=$fila+4;
	
	//Consulto la información de la evolución}
	include('php/conexion.php');
	//include('php/funciones.php');
	$consulta=mysql_query("SELECT  us.NROD_USU, us.CODI_USU, us.PNOM_USU, us.SNOM_USU, us.PAPE_USU, us.SAPE_USU,us.FNAC_USU,dl.nord_dlab,el.dxo_labs,el.iden_labs
				FROM detalle_labs AS dl
				INNER JOIN encabezado_labs AS el ON el.iden_labs = dl.iden_labs
				INNER JOIN usuario AS us ON us.codi_usu = el.codi_usu
				INNER JOIN cups AS cp ON dl.codigo = cp.codigo
				WHERE el.fchr_labs = '$finicial' AND el.fchr_labs ='$ffinal'
				AND cp.grup_quim ='4606'
				GROUP BY dl.nord_dlab
				ORDER BY dl.nord_dlab");
	
		
	if(mysql_num_rows($consulta)<>0)
	{		
		
		
		$pdf->Image('imagenes\Inf_espe.jpg',1,0,210,0,'','');
		$pdf->Image('imagenes\PIE1.JPG',2,265,210,0,'','');
				

		$fila=$fila+4;
		$fila=increm($fila,$pdf);
			
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"N°ORDEN",0);		
			$pdf->SetXY(30,$fila);
			$pdf->Cell(55,5,"IDENT",0);
			$pdf->SetXY(50,$fila);
			$pdf->Cell(40,5,"NOMBRE",0);
			$pdf->SetXY(143,$fila);
			$pdf->Cell(40,5,"EDAD",0);
			$pdf->SetXY(163,$fila);
			$pdf->Cell(40,5,"DG",0);
		
		//$fila=$pdf->GetY();
		$fila=increm($fila,$pdf);
		while($row_=mysql_fetch_array($consulta))
		{
			$nord_dlab=$row_[nord_dlab];
			$nrod_usu=$row_[NROD_USU];
			$nom_usu=$row_[PNOM_USU].' '.$row_[SNOM_USU].' '.$row_[PAPE_USU].' '.$row_[SAPE_USU];
			$edad=calculaedad($row_[FNAC_USU]);
			$dx=$row_[dxo_labs];
			$iden_labs=$row_[iden_labs];
			
			$fila=$fila+6;
			$pdf->SetFont('Arial','',8);
			$fila=increm($fila,$pdf);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,$nord_dlab,0);

			$pdf->SetXY(30,$fila);
			$pdf->Cell(40,5,$nrod_usu,0);

			$pdf->SetXY(50,$fila);
			$pdf->Cell(40,5,$nom_usu,0);

			
			$pdf->SetXY(143,$fila);
			$pdf->Cell(40,5,$edad,0);
			$pdf->SetFont('Arial','',6);
			
			$consucie=mysql_query("SELECT nom_cie10 FROM cie_10 where cod_cie10='$dx'");
			if(mysql_num_rows($consucie)<>0)
			{
			  $rowcie=mysql_fetch_array($consucie);
			  $pdf->SetXY(163,$fila);
			  $nom_cie=substr($rowcie[nom_cie10],0,25);
			  $pdf->SetFont('Arial','',6);
			  $pdf->Cell(40,5,$nom_cie,0);
			}
			
			$conscup=mysql_query("SELECT cups.descrip
			FROM detalle_labs AS detalle_labs
			INNER JOIN cups AS cups ON detalle_labs.codigo = cups.codigo
			INNER JOIN destipos AS destipos ON cups.grup_quim = destipos.codi_des
			WHERE detalle_labs.iden_labs = '$iden_labs'
			AND cups.grup_quim = '4606'
			GROUP BY cups.descrip");
			if(mysql_num_rows($conscup)<>0)
			{
			    
				while($rowcod_=mysql_fetch_array($conscup))
				{
					
					$fila=$fila+6;
					//$fila=increm($fila,$pdf);
					$pdf->SetXY(15,$fila);
					$pdf->SetFont('Arial','',6);
					$pdf->Cell(40,5,$rowcod_[descrip],0);
					linea(75,$fila,50,"_",$pdf);
					
					
				}
				
			}
			$fila=$fila+6;
			$fila=$pdf->GetY();
			$fila=increm($fila,$pdf);
		
		}
	}
		
			
	$pdf->SetFont('Arial','',6);
	$pdf->Output();
	//mysql_close();

	function calculaedad($fecha_){
	   $unidad_=" Años";
	  $ano_=substr($fecha_,0,4);
	  $mes_=substr($fecha_,5,2);
	  $dia_=substr($fecha_,8,2);
	  $edad_=date("Y")-$ano_;
	  if (date("m")<=$mes_){
		 $edad_=$edad_-1;
		if (date("m")==$mes_ and $dia_<=date("d")){
		  $edad_=$edad_+1;
		}
	  }
	  return($edad_.$unidad_);
	}

?>
