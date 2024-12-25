<?php

	//include ("php/conexion1.php");
	
	$sql= "SELECT * FROM documentos WHERE codigo='$formato'";
	
	$bdoc = mysql_query($sql);
	if (!$CONSULTA) 
	{
		$fila_=$fila_+1;
		$rdoc=mysql_fetch_array($bdoc);
		$version=$rdoc['version'];	
		$nombredoc=$rdoc['nombre'];
		$codigo=$rdoc['codigo'];
		$fecha_elaboracion=$rdoc['fechaElaboracion'];	
		$fecha_actualizacion=$rdoc['fechaUltimaRevision'];		
		$dia_elb=substr($fecha_elaboracion,8,2);
		$mes_elb=substr($fecha_elaboracion,5,2);
		$ano_elb=substr($fecha_elaboracion,0,4);
		
		if($mes_elb=='01')$nommes_ela="Enero";
		if($mes_elb=='02')$nommes_ela="Febrero";
		if($mes_elb=='03')$nommes_ela="Marzo";
		if($mes_elb=='04')$nommes_ela="Abril";
		if($mes_elb=='05')$nommes_ela="Mayo";
		if($mes_elb=='06')$nommes_ela="Junio";
		if($mes_elb=='07')$nommes_ela="Julio";
		if($mes_elb=='08')$nommes_ela="Agosto";
		if($mes_elb=='09')$nommes_ela="Septiembre";
		if($mes_elb=='10')$nommes_ela="Octubre";
		if($mes_elb=='11')$nommes_ela="Noviembre";
		if($mes_elb=='12')$nommes_ela="Diciembre";
		
		$fecha_elabora=$dia_elb." de ".$nommes_ela.' de '.$ano_elb; 
		
		$dia_act=substr($fecha_actualizacion,8,2);
		$mes_act=substr($fecha_actualizacion,5,2);
		$ano_act=substr($fecha_actualizacion,0,4);
		
		if($mes_act=='01')$nommes_act="Enero";
		if($mes_act=='02')$nommes_act="Febrero";
		if($mes_act=='03')$nommes_act="Marzo";
		if($mes_act=='04')$nommes_act="Abril";
		if($mes_act=='05')$nommes_act="Mayo";
		if($mes_act=='06')$nommes_act="Junio";
		if($mes_act=='07')$nommes_act="Julio";
		if($mes_act=='08')$nommes_act="Agosto";
		if($mes_act=='09')$nommes_act="Septiembre";
		if($mes_act=='10')$nommes_act="Octubre";
		if($mes_act=='11')$nommes_act="Noviembre";
		if($mes_act=='12')$nommes_act="Diciembre";
		$fecha_actualiza=$dia_act." de ".$nommes_act.' de '.$ano_act; 
		$pdf_->Image($imaenca,6,$fila_+1,17,20,'','');
		$pdf_->SetFont('Arial','',11);
		$pdf_->SetXY(23,$fila_+5);
		$pdf_->Cell(35,4,"Profesionales de la",0,0,C);
		$pdf_->SetXY(23,$fila_+10);
		$pdf_->Cell(35,4,"Salud S.A.",0,0,C);	
		
		
		//1882799
		
		$vec = explode(" ", $nombredoc);
		$finpal=count($vec);

		$frase1='';
		$frase='';
		$k=0;
		
		for($n=0;$n<$finpal;$n++)
		{
			if(!empty($vec[$n]))
			{
				
				$frase=$frase.$vec[$n].' ';
				$lar=$pdf_->GetStringWidth($frase);
				
				$largo=substr($lar,0,5);
				
				if($lar<92)
				{
					$frase1=$frase1.$vec[$n].' ';
				}
				else
				{
					$renglon[$k]=$frase1;
					$frase='';
					$frase1=$vec[$n].' ';
					$k++;
				}
			}
		}
		//$k=$k+1;
		$renglon[$k]=$frase1;	
		
		if($k==0)$ini=$fila_+7;
		if($k==1)$ini=$fila_+5;
		if($k==2)$ini=$fila_+3;
		if($k==3)$ini=$fila_+0;
		for($i=0;$i<$k+1;$i++)
		{
			$pdf_->SetXY(58,$ini+$i*5);
			$pdf_->Cell(92,4,$renglon[$i],0,0,C);
		}		
		$pdf_->SetFont('Arial','',8);
		$pdf_->SetXY(150,$fila_+2);
		$pdf_->Cell(19,4,"CODIGO",0,0,C);
		$pdf_->SetXY(150,$fila_+6);
		$pdf_->Cell(19,4,$codigo,0,0,C);

		$pdf_->SetXY(150,$fila_+11);
		$pdf_->Cell(19,4,"VERSION",0,0,C);
		$pdf_->SetXY(150,$fila_+14.2);
		$pdf_->Cell(19,4,$version,0,0,C);

		$pdf_->SetXY(169,$fila_);
		$pdf_->Cell(42,4,"FECHA DE ELABORACION",0,0,C);
		$pdf_->SetXY(169,$fila_+3);
		$pdf_->Cell(42,4,$fecha_elabora,0,0,C);		

		$pdf_->SetXY(169,$fila_+7);
		$pdf_->Cell(42,4,"FECHA DE ACTUALIZACION",0,0,C);
		$pdf_->SetXY(169,$fila_+10);
		$pdf_->Cell(42,4,$fecha_actualiza,0,0,C);

		$pdf_->SetXY(169,$fila_+14.5);
		$pdf_->Cell(42,4,"HOJA 1 DE 1",0,0,C);
		
		$pdf_->rect(5,$fila_,18,19,D);
		$pdf_->rect(23,$fila_,35,19,D);
		$pdf_->rect(58,$fila_,92,19,D);
		$pdf_->rect(150,$fila_,19,10,D);
		$pdf_->rect(150,$fila_+10,19,9,D);
		$pdf_->rect(169,$fila_,42,7,D);
		$pdf_->rect(169,$fila_+7,42,7,D);
		$pdf_->rect(169,$fila_+14,42,5,D);
		
		$pdf_->SetFont('Arial','B',35);
		$pdf_->SetTextColor(220, 220, 220);
		$pdf_->SetXY(5,$fila_+15);
		$pdf_->Cell(210,30,"COPIA CONTROLADA",0,0,C);
		$pdf_->SetFont('Arial','',8);
		$pdf_->SetTextColor(0,0,0);
		
		$horaimp=date("g:i a");
		$fechaimp=date('Y-m-d');
		$dia_imp=substr($fechaimp,8,2);
		$mes_imp=substr($fechaimp,5,2);
		$ano_imp=substr($fechaimp,0,4);
		
		
		if($mes_imp=='01')$nommes_imp="Enero";
		if($mes_imp=='02')$nommes_imp="Febrero";
		if($mes_imp=='03')$nommes_imp="Marzo";
		if($mes_imp=='04')$nommes_imp="Abril";
		if($mes_imp=='05')$nommes_imp="Mayo";
		if($mes_imp=='06')$nommes_imp="Junio";
		if($mes_imp=='07')$nommes_imp="Julio";
		if($mes_imp=='08')$nommes_imp="Agosto";
		if($mes_imp=='09')$nommes_imp="Septiembre";
		if($mes_imp=='10')$nommes_imp="Octubre";
		if($mes_imp=='11')$nommes_imp="Noviembre";
		if($mes_imp=='12')$nommes_imp="Diciembre";
		$fecha_impresion=$dia_imp." de ".$nommes_imp.' de '.$ano_imp;
		
		$pdf_->SetXY(5,20);
		$pdf_->Cell(207,4,"Fecha y hora de impresion: ".$fecha_impresion.' '.$horaimp,0,0,R);
		
	}
	
	
