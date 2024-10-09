<?	//Cargo las funciones del programa
	require('fpdf.php');
	$pdf=new FPDF('L','mm','Letter');
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
	  if($fil>=250)
	  {
		$fil=22;
		$pdf->AddPage();
		$pdf->Image('imagenes\lista.JPG',1,0,265,0,'','');
		$pdf->Image('imagenes\PIE1.JPG',2,265,210,0,'','');
		//$pdf->SetXY(15,30);
		$pdf->SetFont('Arial','',8);
		
	  }
	  return ($fil);
	}
	
	$pdf->AddPage();
	
	//Consulto la información de la evolución}
	include('php/conexion.php');
	//include('php/funciones.php');
	
	$condicion="el.fchr_labs='$ffin' AND dl.estd_dlab='P'";
			
		if((!empty($grup_lab))) 
		{
			if($grup_lab=='4613')
			{
				$grup_lab2='4602 OR cp.grup_quim=4605 OR cp.grup_quim=4611)';
				$condicion=$condicion.' AND (cp.grup_quim='.$grup_lab2;
			}
			else
			{
				$condicion=$condicion.' AND cp.grup_quim='.$grup_lab;
			}
		}

	$consulta=mysql_query("SELECT el.iden_labs,dl.estd_dlab,
				us.NROD_USU,us.CODI_USU ,us.PNOM_USU, us.SNOM_USU, us.PAPE_USU, us.SAPE_USU,dl.nord_dlab 
				FROM detalle_labs AS dl
				INNER JOIN encabezado_labs as el ON el.iden_labs=dl.iden_labs
				INNER JOIN usuario AS us ON us.codi_usu=el.codi_usu 
				INNER JOIN cups AS cp ON dl.codigo=cp.codigo
				WHERE $condicion 
				GROUP BY dl.nord_dlab
				order by dl.nord_dlab");
	
	$fila=28;	
	
	
	if(empty($grup_lab))
	{
		$secc="TODAS LAS AREAS";
	}
	else
	{
		$area=mysql_query("SELECT codi_des,codt_des,nomb_des FROM destipos WHERE codi_des='$grup_lab'");
		$row_=mysql_fetch_array($area);
		$secc=$row_[nomb_des];
	}
	
	$pdf->SetXY(15,$fila);
	$pdf->Cell(40,5,'SECCION O AREA INTERNA: '.$secc,0);
	
	$pdf->SetXY(85,$fila);
	$pdf->Cell(40,5,'FECHA: '.$ffin,0);
	
	if(mysql_num_rows($consulta)<>0)
	{		
		
		
		$pdf->Image('imagenes\lista.JPG',1,0,210,0,'','');
		$pdf->Image('imagenes\PIE1.JPG',2,265,210,0,'','');
		
		$fila=$fila+4;
		$fila=increm($fila,$pdf);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"N°ORDEN",0);		
			$pdf->SetXY(30,$fila);
			$pdf->Cell(55,5,"IDENT",0);
			$pdf->SetXY(50,$fila);
			$pdf->Cell(40,5,"EXAM",0);
			$pdf->SetXY(143,$fila);
			/*$pdf->Cell(40,5,"EDAD",0);
			$pdf->SetXY(163,$fila);
			$pdf->Cell(40,5,"DG",0);*/
		
		
		$fila=increm($fila,$pdf);
		//$col=0;
		while($row_=mysql_fetch_array($consulta))
		{
			
			$nord_dlab=$row_[nord_dlab];
			$nrod_usu=$row_[NROD_USU];
			$nom_usu=$row_[PNOM_USU].' '.$row_[SNOM_USU].' '.$row_[PAPE_USU].' '.$row_[SAPE_USU];
			//$edad=calculaedad($row_[FNAC_USU]);
			//$dx=$row_[dxo_labs];
			$iden_labs=$row_[iden_labs];
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$fila=increm($fila,$pdf);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,$nord_dlab,0);

			$pdf->SetXY(30,$fila);
			$pdf->Cell(40,5,$nrod_usu,0);

			//$pdf->SetXY(50,$fila);
			//$pdf->Cell(40,5,$nom_usu,0);

		
			
			if(!empty($grup_lab))
				{
					$condicion2=$condicion2.' AND cp.grup_quim='.$grup_lab;
				
				}
				$conex=mysql_query("SELECT detalle_labs.iden_labs,detalle_labs.iden_dlab ,detalle_labs.codigo, cp.descrip, cp.prep_cup
						FROM detalle_labs AS detalle_labs
						INNER JOIN cups AS cp ON detalle_labs.codigo = cp.codigo
						WHERE detalle_labs.nord_dlab='$nord_dlab' AND detalle_labs.estd_dlab='P' $condicion2");	
			if(mysql_num_rows($conex)<>0)
			{
			    $col=30;
				$fila=$fila+6;
				while($rowcod_=mysql_fetch_array($conex))
				{
					$col=$col+18;
					$fila=$pdf->GetY();
					//
					$ncl=$rowcod_[prep_cup];
					//$exam_=substr($rowcod_[descrip],0,3);
					$pdf->SetXY($col,$fila);
					$pdf->SetFont('Arial','',6);
					$pdf->Cell(40,5,$ncl,0);
					linea($col+6,$fila,10,"_",$pdf);
					
				}
				
			}
			$fila=$pdf->GetY();
			$fila=increm($fila,$pdf);
		
		}
	}
		
			
	$pdf->SetFont('Arial','',6);
	$pdf->Output();
	//mysql_close();

	/*function calculaedad($fecha_){
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
	}*/

?>
