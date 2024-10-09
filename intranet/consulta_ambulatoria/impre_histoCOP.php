<?
	
	require('fpdf.php');
	$pdf=new FPDF('P','mm','Letter');
	$pdf->SetFont('Arial','',8);
	include ('php/conexion1.php');
	$bima=mysql_query("SELECT ayudasdiagnosticas.desc_adx, ayudasdiagnosticas.ccie_adx, ayudasdiagnosticas.cant_adx, ayudasdiagnosticas.numc_adx, mapii.codi_map, mapii.desc_map, mapii.clas_map
	FROM ayudasdiagnosticas INNER JOIN mapii ON ayudasdiagnosticas.coda_adx = mapii.codi_map
	WHERE (((ayudasdiagnosticas.numc_adx)='$numhisto') AND ((mapii.clas_map)='1806'))");
	if(mysql_num_rows($bima)>0)$numima='SI';
	$i=0;
	$consoayu='';
	while($rima=mysql_fetch_array($bima))
	{
		$codi=$rima['codi_map'];
		$diag=$rima['ccie_adx'];
		$desc=$rima['desc_map'];
		$obse=$rima['desc_adx'];
		$cant=$rima['cant_adx'];
		$mat1[$i][0]=$codi;
		$mat1[$i][1]=$diag;
		$mat1[$i][2]=$desc;
		$mat1[$i][3]=$obse;
		$mat1[$i][4]=$cant;
		$i++;
		$consoayu=$consoayu.' '.$desc.' '.$cant.' || ';
	}
	$fin1=$i;
	$blab=mysql_query("SELECT ayudasdiagnosticas.desc_adx, ayudasdiagnosticas.ccie_adx, ayudasdiagnosticas.cant_adx, ayudasdiagnosticas.numc_adx, mapii.codi_map, mapii.desc_map, mapii.clas_map
	FROM ayudasdiagnosticas INNER JOIN mapii ON ayudasdiagnosticas.coda_adx = mapii.codi_map
	WHERE (((ayudasdiagnosticas.numc_adx)='$numhisto') AND ((mapii.clas_map)='1804'));");
	if(mysql_num_rows($blab)>0)$numlab='SI';
	$i=0;
	while($rlab=mysql_fetch_array($blab))
	{
		$codi=$rlab['codi_map'];
		$diag=$rlab['ccie_adx'];
		$desc=$rlab['desc_map'];
		$obse=$rlab['desc_adx'];
		$cant=$rlab['cant_adx'];
		$mat2[$i][0]=$codi;
		$mat2[$i][1]=$diag;
		$mat2[$i][2]=$desc;
		$mat2[$i][3]=$obse;
		$mat2[$i][4]=$cant;
		$i++;
		$consoayu=$consoayu.' '.$desc.' '.$cant.' || ';
	}
	$fin2=$i;	
	$brem=mysql_query("SELECT ayudasdiagnosticas.ccie_adx, ayudasdiagnosticas.desc_adx, ayudasdiagnosticas.cant_adx, ayudasdiagnosticas.numc_adx, mapii.codi_map, mapii.desc_map, mapii.clas_map
	FROM ayudasdiagnosticas INNER JOIN mapii ON ayudasdiagnosticas.coda_adx = mapii.codi_map
	WHERE (((ayudasdiagnosticas.numc_adx)='$numhisto') AND ((mapii.clas_map)<>'1804') AND ((mapii.clas_map)<>'1806'));");
	$i=0;
	if(mysql_num_rows($brem)>0)$numrem='SI';
	$consoref='';
	while($rrem=mysql_fetch_array($brem))
	{
		$codi=$rrem['codi_map'];
		$diag=$rrem['ccie_adx'];
		$desc=$rrem['desc_map'];
		$obse=$rrem['desc_adx'];
		$cant=$rrem['cant_adx'];
		$mat3[$i][0]=$codi;
		$mat3[$i][1]=$diag;
		$mat3[$i][2]=$desc;
		$mat3[$i][3]=$obse;
		$mat3[$i][4]=$cant;	
		$i++;
		$consoref=$consoref.' '.$desc.' '.$cant.' || ';
	}
	$brem1=mysql_query("SELECT ayudasdiagnosticas.numc_adx, ayudasdiagnosticas.cant_adx, destipos.codi_des, destipos.nomb_des, ayudasdiagnosticas.ccie_adx, ayudasdiagnosticas.desc_adx
	FROM destipos INNER JOIN ayudasdiagnosticas ON destipos.codi_des = ayudasdiagnosticas.coda_adx
	WHERE (((ayudasdiagnosticas.numc_adx)='$numhisto'))");	
	if(mysql_num_rows($brem1)>0)$numrem='SI';
	while($rrem1=mysql_fetch_array($brem1))
	{
		$codi=$rrem1['codi_des'];
		$diag=$rrem1['ccie_adx'];
		$desc=$rrem1['nomb_des'];
		$obse=$rrem1['desc_adx'];
		$cant=$rrem1['cant_adx'];
		$mat3[$i][0]=$codi;
		$mat3[$i][1]=$diag;
		$mat3[$i][2]=$desc;
		$mat3[$i][3]=$obse;
		$mat3[$i][4]=$cant;	
		$i++;
		$consoref=$consoref.' '.$desc.' '.$cant.' || ';
	}
	$fin3=$i;		
	$bmed=mysql_query("select * from medicamentosenv where numc_men='$numhisto'");
	if(mysql_num_rows($bmed)>0)$nummed='SI';
	$i=0;
	$consomed='';
	while($rmed=mysql_fetch_array($bmed))
	{
		$codi=$rmed['cmed_men'];
		$diag=$rmed['ccie_men'];
		$dosi=$rmed['dosis_med'];
		$undo=$rmed['undo_med'];
		$frec=$rmed['frec_med'];
		$unfr=$rmed['unfr_med'];
		$tiem=$rmed['tiem_med'];
		$obsmed=$rmed['obse_men'];
		$via=$rmed['via_med'];			
		$cant=$rmed['cant_men'];
		$codi=trim($codi);
		$desc='';
		$bdesmed=mysql_query("SELECT medicamentos2.codi_mdi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa
		FROM medicamentos2 INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa
		WHERE (((medicamentos2.codi_mdi)='$codi'))");
		//$num=mysql_num_rows($bdesmed);
		while($rdesmed=mysql_fetch_array($bdesmed))
		{
			$desc=$rdesmed['nomb_mdi'].' '.$rdesmed['noco_mdi'].' '.$rdesmed['desc_ffa'];
		}		
		$bdesdis=mysql_query("SELECT insu_med.codnue, insu_med.desc_ins
		FROM insu_med WHERE (((insu_med.codnue)='$codi'))");
		while($rdesdis=mysql_fetch_array($bdesdis))
		{
			$desc=$rdesdis['desc_ins'];
		}
		$mat4[$i][0]=$codi;
		$mat4[$i][1]=$diag;
		$mat4[$i][2]=$desc;		
		$mat4[$i][3]=$dosi;
		$mat4[$i][4]=$undo;		
		$mat4[$i][5]=$frec;
		$mat4[$i][6]=$unfr;
		$mat4[$i][7]=$tiem;		
		$mat4[$i][8]=$cant;	
		$mat4[$i][9]=$via;
		$mat4[$i][10]=$obsmed;
		$i++;
		$consomed=$consomed.' '.$desc.' '.$dosi.' '.$undo.' '.$frec.' '.$unfr.' '.$via.' '.$cant.'|| ';
	}
	$fin4=$i;
	$busu=mysql_query("SELECT encabesadohistoria.numc_ehi, encabesadohistoria.idus_ehi, encabesadohistoria.feco_ehi, encabesadohistoria.nomb_ehi, municipio.NOMB_MUN, encabesadohistoria.sexo_ehi, encabesadohistoria.fnac_ehi, contrato.NEPS_CON, areas.nom_areas,consultaprincipal.radx_cpl,consultaprincipal.cod1_cpl,consultaprincipal.tidx_cpl,consultaprincipal.hosa_cpl,encabesadohistoria.cous_ehi,encabesadohistoria.telf_ehi
	FROM (((encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) INNER JOIN contrato ON encabesadohistoria.cont_ehi = contrato.CODI_CON) INNER JOIN municipio ON encabesadohistoria.muat_ehi = municipio.CODI_MUN) INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas
	WHERE (((encabesadohistoria.numc_ehi)='$numhisto'))"); 
	while($rusu=mysql_fetch_array($busu))
	{
		$vec[0]=$numhisto;
		$vec[1]=$rusu['feco_ehi'];//$fecha
		$vec[2]=$rusu['nom_areas'];//nom_areas
		$vec[3]=$rusu['nomb_ehi'];//$nombre;
		$vec[4]=$rusu['sexo_ehi'];//$rowusu[sexo_usu];//$Sexo
		$vec[5]=strtoupper($rusu['NEPS_CON']);//$rowusu[neps_con];//$contrato		
		$vec[5]=strtoupper('Beneficiarios sin derecho contractual');
		$vec[6]=$rusu['idus_ehi'];//$rowusu[nrod_usu];//$dentificacion//fnac_ehi
		
		$vec[8]=$rusu['NOMB_MUN'];	
		$vec[9]=$rusu['radx_cpl'];
		$vec[10]=$rusu['cod1_cpl'];
		$vec[11]=$rusu['tidx_cpl'];
		$vec[12]=$rusu['hosa_cpl'];
		$cous=$rusu['cous_ehi'];
		$bdoc=mysql_query("select TDOC_USU, FNAC_USU from usuario where CODI_USU='$cous'");
		while($rdoc=mysql_fetch_array($bdoc))
		{
			$vec[13]=$rdoc[TDOC_USU];
			$fnaci=$rdoc['FNAC_USU'];
			$vec[7]=calculaedad($fnaci);
		}
		$vec[14]=$rusu['telf_ehi'];
	}
	
	$bmed=mysql_query("SELECT consultaprincipal.numc_cpl, medicos.cod_medi, medicos.nom_medi, medicos.reg_medi
	FROM consultaprincipal INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi
	WHERE (((consultaprincipal.numc_cpl)='$numhisto'))");
	while($rmer=mysql_fetch_array($bmed))
	{
		$codimedico=$rmer['cod_medi'];
		$nombmedico=$rmer['nom_medi'];
		$regimedico=$rmer['reg_medi'];		
	}

	if($ima=='1')
	{
		for($i=0;$i<2;$i++)
		{
			if($i==0 || $fila>130)
			{
				$fila=300;
				$pag=titulo($pdf,$fila,$vec,$pag,1,1);
				$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
				$fila=45;				
			}
			else
			{
				$pag=titulo($pdf,$fila,$vec,$pag,1,2);
				$pdf->Image('img\PIE1.JPG',2,123,210,0,'','');
				$fila=$fila+45;
			}			
			$pdf->SetXY(5,$fila);
			$pdf->Cell(10,5,'DX',1,0,C);
			$pdf->Cell(20,5,'CODIGO',1,0,C);
			$pdf->Cell(85,5,'DESCRIPCION',1,0,C);
			$pdf->Cell(85,5,'OBSERVACION',1,0,C);
			$pdf->Cell(10,5,'CANT',1,0,C);
			$fila=$fila+5;
			for($n=0;$n<$fin1;$n++)
			{
				$codi='';
				$diag='';
				$desc='';
				$obse='';
				$cant='';
				$codi=$mat1[$n][0];
				$diag=$mat1[$n][1];
				$desc=$mat1[$n][2];
				$obse=$mat1[$n][3];
				$cant=$mat1[$n][4];				
				$pdf->SetXY(5,$fila);
				$pdf->MultiCell(10,5,$diag,0,C,0);
				$bajo1=$pdf->GetY();				
				$pdf->SetXY(15,$fila);
				$pdf->MultiCell(22,5,$codi,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(35,$fila);
				$pdf->MultiCell(85,5,$desc,0,L,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(120,$fila);
				$pdf->MultiCell(85,5,$obse,0,L,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(205,$fila);
				$pdf->MultiCell(10,5,$cant,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				$bajo=$bajo1-$fila;
				$pdf->Rect(5, $fila, 10, $bajo); 
				$pdf->Rect(15, $fila, 20, $bajo); 
				$pdf->Rect(35, $fila, 85, $bajo); 
				$pdf->Rect(120, $fila, 85, $bajo); 
				$pdf->Rect(205, $fila, 10, $bajo);				
				$fila=$fila+$bajo;
			}
			
			
			$fila=$fila+10;
			$firma="../firmas/".$codimedico.".jpg";
			if(file_exists($firma)){
			  $pdf->Image($firma,30,$fila,50,15,'','');
			}
			
			$fila=$fila+10;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,'____________________________________',0,0,L);
			$pdf->SetXY(130,$fila);
			$pdf->Cell(10,5,'____________________________________',0,0,L);	
			$fila=$fila+4;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,$nombmedico,0,0,L);
			$pdf->SetXY(130,$fila);
			$pdf->Cell(10,5,$vec[3],0,0,L);	
			$fila=$fila+4;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,'Registro medico: '.$regimedico,0,0,L);
			$pdf->SetXY(130,$fila);
			$pdf->Cell(10,5,'C. C. No.',0,0,L);	
			
		}
	}
	
	if($lab=='1')
	{
		for($i=0;$i<2;$i++)
		{
			if($i==0 || $fila>130)
			{
				$fila=300;
				$pag=titulo($pdf,$fila,$vec,$pag,2,1);
				$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
				$fila=45;				
			}
			else
			{
				$pag=titulo($pdf,$fila,$vec,$pag,2,2);
				$pdf->Image('img\PIE1.JPG',2,123,210,0,'','');
				$fila=$fila+45;
			}
			
			$pdf->SetXY(5,$fila);
			$pdf->Cell(10,5,'DX',1,0,C);
			$pdf->Cell(20,5,'CODIGO',1,0,C);
			$pdf->Cell(85,5,'DESCRIPCION',1,0,C);
			$pdf->Cell(85,5,'OBSERVACION',1,0,C);
			$pdf->Cell(10,5,'CANT',1,0,C);
			$fila=$fila+5;
			for($n=0;$n<$fin2;$n++)
			{
				$codi='';
				$diag='';
				$desc='';
				$obse='';
				$cant='';
				$codi=$mat2[$n][0];
				$diag=$mat2[$n][1];
				$desc=$mat2[$n][2];
				$obse=$mat2[$n][3];
				$cant=$mat2[$n][4];
				
				
				
				$pdf->SetXY(5,$fila);
				$pdf->MultiCell(10,5,$diag,0,C,0);
				$bajo1=$pdf->GetY();
				
				$pdf->SetXY(15,$fila);
				$pdf->MultiCell(22,5,$codi,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				
				$pdf->SetXY(35,$fila);
				$pdf->MultiCell(85,5,$desc,0,L,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				
				$pdf->SetXY(120,$fila);
				$pdf->MultiCell(85,5,$obse,0,L,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				
				$pdf->SetXY(205,$fila);
				$pdf->MultiCell(10,5,$cant,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				$bajo=$bajo1-$fila;
				$pdf->Rect(5, $fila, 10, $bajo); 
				$pdf->Rect(15, $fila, 20, $bajo); 
				$pdf->Rect(35, $fila, 85, $bajo); 
				$pdf->Rect(120, $fila, 85, $bajo); 
				$pdf->Rect(205, $fila, 10, $bajo); 
				
				$fila=$fila+$bajo;
			}
			$fila=$fila+10;
			$firma="../firmas/".$codimedico.".jpg";
			if(file_exists($firma)){
			  $pdf->Image($firma,30,$fila,50,15,'','');
			}
			
			$fila=$fila+10;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,'____________________________________',0,0,L);
			$pdf->SetXY(130,$fila);
			$pdf->Cell(10,5,'____________________________________',0,0,L);	
			$fila=$fila+4;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,$nombmedico,0,0,L);
			$pdf->SetXY(130,$fila);
			$pdf->Cell(10,5,$vec[3],0,0,L);	
			$fila=$fila+4;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,'Registro medico: '.$regimedico,0,0,L);
			$pdf->SetXY(130,$fila);
			$pdf->Cell(10,5,'C. C. No.',0,0,L);	
			
		}
	}
	
	if($rem=='1')
	{		
		for($i=0;$i<2;$i++)
		{
			if($i==0 || $fila>130)
			{
				$fila=300;
				$pag=titulo($pdf,$fila,$vec,$pag,3,1);
				$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
				$fila=45;				
			}
			else
			{
				$pag=titulo($pdf,$fila,$vec,$pag,3,2);
				$pdf->Image('img\PIE1.JPG',2,123,210,0,'','');
				$fila=$fila+45;
			}			
			$pdf->SetXY(5,$fila);
			$pdf->Cell(10,5,'DX',1,0,C);
			$pdf->Cell(20,5,'CODIGO',1,0,C);
			$pdf->Cell(85,5,'DESCRIPCION',1,0,C);
			$pdf->Cell(85,5,'OBSERVACION',1,0,C);
			$pdf->Cell(10,5,'CANT',1,0,C);
			$fila=$fila+5;
			for($n=0;$n<$fin3;$n++)
			{
				$codi='';
				$diag='';
				$desc='';
				$obse='';
				$cant='';
				$codi=$mat3[$n][0];
				$diag=$mat3[$n][1];
				$desc=$mat3[$n][2];
				$obse=$mat3[$n][3];
				$cant=$mat3[$n][4];
				$pdf->SetXY(5,$fila);
				$pdf->MultiCell(10,5,$diag,0,C,0);
				$bajo1=$pdf->GetY();				
				$pdf->SetXY(15,$fila);
				$pdf->MultiCell(22,5,$codi,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(35,$fila);
				$pdf->MultiCell(85,5,$desc,0,L,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(120,$fila);
				$pdf->MultiCell(85,5,$obse,0,L,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(205,$fila);
				$pdf->MultiCell(10,5,$cant,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				$bajo=$bajo1-$fila;
				$pdf->Rect(5, $fila, 10, $bajo); 
				$pdf->Rect(15, $fila, 20, $bajo); 
				$pdf->Rect(35, $fila, 85, $bajo); 
				$pdf->Rect(120, $fila, 85, $bajo); 
				$pdf->Rect(205, $fila, 10, $bajo); 				
				$fila=$fila+$bajo;
			}
			
			$fila=$fila+10;
			$firma="../firmas/".$codimedico.".jpg";
			if(file_exists($firma)){
			  $pdf->Image($firma,30,$fila,50,15,'','');
			}
			
			
			$fila=$fila+10;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,'____________________________________',0,0,L);
			$pdf->SetXY(130,$fila);
			$pdf->Cell(10,5,'____________________________________',0,0,L);	
			
			$fila=$fila+4;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,$nombmedico,0,0,L);
			$pdf->SetXY(130,$fila);
			$pdf->Cell(10,5,$vec[3],0,0,L);	
			
			$fila=$fila+4;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,'Registro medico: '.$regimedico,0,0,L);
			$pdf->SetXY(130,$fila);
			$pdf->Cell(10,5,'C. C. No.',0,0,L);	
		}
	}
	if($med=='1')
	{
		for($i=0;$i<2;$i++)
		{
			if($i==0 || $fila>130)
			{
				$fila=300;
				$pag=titulo($pdf,$fila,$vec,$pag,4,1);
				$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
				$fila=45;				
			}
			else
			{
				$pag=titulo($pdf,$fila,$vec,$pag,4,2);
				$pdf->Image('img\PIE1.JPG',2,123,210,0,'','');
				$fila=$fila+45;
			}
			$pdf->SetFont('Arial','',7);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(8,5,'DX',1,0,C);
			$pdf->Cell(12,5,'CODIGO',1,0,C);
			$pdf->Cell(84,5,'DESCRIPCION',1,0,C);
			$pdf->Cell(14,5,'DOSIS',1,0,C);
			$pdf->Cell(22,5,'FRECUENCIA',1,0,C);
			$pdf->Cell(19,5,'VIA',1,0,C);			
			$pdf->Cell(19,5,'TIEMPO TTO.',1,0,C);
			$pdf->Cell(15,5,'C. PRESC.',1,0,C);
			$pdf->Cell(12,5,'C. DISP.',1,0,C);
			$fila=$fila+5;
			
			for($n=0;$n<$fin4;$n++)
			{
				$codi='';
				$diag='';
				$desc='';
				$obse='';
				$cant='';					
				$dosi='';
				$undo='';		
				$frec='';
				$unfr='';
				$tiem='';				
				$viaa='';
				$nvia='';
				$obsmed='';
				$codi=$mat4[$n][0];
				$diag=$mat4[$n][1];
				$desc=$mat4[$n][2];
				$dosi=$mat4[$n][3];
				$undo=$mat4[$n][4];
				$frec=$mat4[$n][5];		
				$unfr=$mat4[$n][6];		
				$tiem=$mat4[$n][7];		
				$cant=$mat4[$n][8];	
				$viaa=$mat4[$n][9];
				$obsmed=$mat4[$n][10];
				$bvia1=mysql_query("select * from destipos where codi_des='$viaa'");
				while($rvia1=mysql_fetch_array($bvia1))
				{
					$nvia=$rvia1['nomb_des'];
				}
				
				
				$pdf->SetXY(5,$fila);
				$pdf->MultiCell(8,5,$diag,0,C,0);
				$bajo1=$pdf->GetY();
				
				if(strlen($codi)>6)
				{
					$codi=substr($codi,5,7);				
				}
				$pdf->SetXY(13,$fila);
				$pdf->MultiCell(12,5,$codi,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				
				$pdf->SetXY(25,$fila);
				$pdf->MultiCell(60,5,$desc,0,L,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				
				$pdf->SetXY(112,$fila);
				$pdf->MultiCell(14,5,$dosi.' '.$undo,0,C,1);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				
				$pdf->SetXY(126,$fila);
				if($frec=='')
				{
					$pdf->MultiCell(22,5,$frec.' '.$unfr,0,C,0);
				}
				else
				{
					$pdf->MultiCell(22,5,'Cada '.$frec.' '.$unfr,0,C,0);
				}
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				
				$pdf->SetXY(147,$fila);
				$pdf->MultiCell(20,5,$nvia,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;		
				
				
				$pdf->SetXY(167,$fila);
				$pdf->MultiCell(19,5,$tiem,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;	


				$pdf->SetXY(167,$fila);
				$pdf->MultiCell(19,5,$obsmed,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;	
				
				
				
				$pdf->SetXY(186,$fila);
				$pdf->MultiCell(15,5,$cant,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				$bajo=$bajo1-$fila;
				
				
				$pdf->Rect(5, $fila, 8, $bajo); 
				$pdf->Rect(13, $fila, 12, $bajo); 
				$pdf->Rect(25, $fila, 60, $bajo); 
				$pdf->Rect(112, $fila, 14, $bajo); 
				$pdf->Rect(126, $fila, 22, $bajo); 
				$pdf->Rect(148, $fila, 19, $bajo);				
				$pdf->Rect(167, $fila, 19, $bajo); 
				$pdf->Rect(186, $fila, 15, $bajo); 
				$pdf->Rect(201, $fila, 12, $bajo); 				
				$fila=$fila+$bajo;
			}
			$pdf->SetFont('Arial','',8);
			$bfor=mysql_query("select * from encabesadoformula where numc_efo='$numhisto'");
			while($rfor=mysql_fetch_array($bfor))
			{
				$proxi=$rfor[coen_efo];
				$obse=$rfor[obfo_efo];
				$repi=$rfor[repi_efo];
			}			
			$fila=$fila+2;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(5,5,'Próxima consulta '.$proxi,0,0,L);
			$pdf->SetXY(120,$fila);
			$pdf->Cell(5,5,'Repetir esta formula por '.$repi.' meses',0,0,L);			
			$fila=$fila+5;
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(210,5,'Recomendaciones '.$obse,0,L,0);		

			
			$fila=$fila+10;
			$firma="../firmas/".$codimedico.".jpg";
			if(file_exists($firma)){
			  $pdf->Image($firma,30,$fila,50,15,'','');
			}

			
			$fila=$fila+10;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,'____________________________________',0,0,L);
			$pdf->SetXY(130,$fila);
			$pdf->Cell(10,5,'____________________________________',0,0,L);	
			$fila=$fila+4;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,$nombmedico,0,0,L);
			$pdf->SetXY(130,$fila);
			$pdf->Cell(10,5,$vec[3],0,0,L);	
			$fila=$fila+4;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,'Registro medico: '.$regimedico,0,0,L);
			$pdf->SetXY(130,$fila);
			$pdf->Cell(10,5,'C. C. No.',0,0,L);	
			
		}
	}
	
	$col=220;
	if($his=='1')
	{
		$busconsu=mysql_query("select * from consultaprincipal where numc_cpl='$numhisto'");
		while($rconsu=mysql_fetch_array($busconsu))
		{
			$motconsu=$rconsu['motc_cpl'];
			$enferact=$rconsu['enac_cpl'];
			$antefam=$rconsu['antefam_cpl'];
			$anteper=$rconsu['anteper_cpl'];
			$revisis=$rconsu['resi_cpl'];			
		}
		$fila=300;
		$pag=titulo($pdf,$fila,$vec,$pag,5,1);
		$pdf->Image('img\PIE1.JPG',2,264,210,0,'','');
		$fila=$fila+40;	
$h=2;		
			
		$fila=$pdf->GetY();
$fila=$fila+$h+5;
		$pdf->SetXY(100,$fila);
		
		//$pdf->SetDrawColor(150);
		//$pdf->line(5,$fila+0,210,$fila+0);
		//$pdf->line(5,$fila+5,210,$fila+5);
		
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,5,F);
		$pdf->Cell(20,5,'ANTECEDENTES:',0,0,L);
		
		$fila=$fila+5;
$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,5,'Personales:',0,0,L);	
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,5,$anteper,0,L,0);	
		$fila=$pdf->GetY();
$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,5,'Planificación:',0,0,L);	
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,5,$metodo,0,L,0);	
		$fila=$pdf->GetY();		
$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,5,'Familiares:',0,0,L);	
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,5,$antefam,0,L,0);	
		$fila=$pdf->GetY();
$fila=$fila+$h;
		if($vec[4]=='F')
		{
			$bfem=mysql_query("select * from antefemeninos where numc_afe='$numhisto'");
			while($rfem=mysql_fetch_array($bfem))
			{
				$feculme=$rfem['feum_afe'];
				$gestas=$rfem['gest_afe'];
				$partos=$rfem['part_afe'];
				$cesar=$rfem['cesa_afe'];
				$abor=$rfem['abor_afe'];
				$vivos=$rfem['vivo_afe'];
				$morti=$rfem['mort_afe'];
				$otro=$rfem['otro_afe'];
				$ante=$rfem['ante_afe'];
				$pdf->SetXY(5,$fila);
				$pdf->Cell(20,5,'Gineco-obstreticos:',0,0,L);	
				$pdf->SetXY(35,$fila);
				$pdf->MultiCell(180,5,$ante,0,L,0);	
				$fila=$pdf->GetY();
				$pdf->SetXY(35,$fila);
				$pdf->Cell(30,5,'FUM: '.$feculme	,0,0,L);
				$pdf->Cell(25,5,'Gestan: '.$gestas,0,0,L);
				$pdf->Cell(25,5,'Partos: '.$partos,0,0,L);
				$pdf->Cell(25,5,'Cesáreas: '.$cesar,0,0,L);
				$pdf->Cell(25,5,'Abortos: '.$abor,0,0,L);
				$pdf->Cell(25,5,'Vivos: '.$vivos,0,0,L);
				$pdf->Cell(25,5,'Mortinatos: '.$morti,0,0,L);
				$fila=$fila+5;
$fila=$fila+$h;
				$pdf->SetXY(103,$fila);
				$pdf->SetFillColor($col);	
				$pdf->rect(5,$fila,205,5,F);
				$pdf->Cell(20,5,'CONSULTA ',0,0,L);
				$fila=$fila+7;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(20,5,'Motivo la consulta:',0,0,L);	
				$pdf->SetXY(35,$fila);
				$pdf->MultiCell(180,5,$motconsu,0,L,0	);
				$fila=$pdf->GetY();
		
$fila=$fila+$h;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(20,5,'Enfermedad actual:',0,0,L);	
				$pdf->SetXY(35,$fila);
				$pdf->MultiCell(180,5,$enferact,0,L,0);	
				$fila=$pdf->GetY();
				//$pdf->SetDrawColor(150);
				//$pdf->line(5,$fila-0,210,$fila-0);
				//$pdf->line(5,$fila+5,210,$fila+5);
$fila=$fila+$h5;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(20,5,'Revisión por sistema::',0,0,L);
				$pdf->SetXY(35,$fila);
				$pdf->MultiCell(180,5,$revisis,0,L,0);
				$fila=$pdf->GetY();
$fila=$fila+$h;
			}			
		}
		$bexafis=mysql_query("select * from examenfisico where numc_efi='$numhisto'");
		while($rexaf=mysql_fetch_array($bexafis))
		{
			$tenci1=$rexaf['tear_efi'];
			$tenci2=$rexaf['tea2_efi'];
			$fres=$rexaf['fres_efi'];
			$fcar=$rexaf['fcar_efi'];
			$temp=$rexaf['temp_efi'];
			$peso=$rexaf['peso_efi'];
			$talla=$rexaf['tall_efi'];
			$pcfa=$rexaf['pcfa_efi'];
			$otrohall=$rexaf['otrh_efi'];
			
			
			$pdf->SetXY(5,$fila);
			$pdf->Cell(20,5,'Exámen físico:',0,0,L);
			$pdf->SetXY(35,$fila);
			$pdf->Cell(23,5,'T.A.: '.$tenci1.'/'.$tenci2,0,0,L);
			$pdf->Cell(23,5,'F.R.: '.$fres,0,0,L);
			$pdf->Cell(23,5,'F.C.: '.$fcar,0,0,L);
			$pdf->Cell(23,5,'Tº.: '.$temp,.0,0,L);			
			$pdf->Cell(23,5,'Peso: '.$peso.' Kg.',0,0,L);
			$pdf->Cell(23,5,'Talla: '.$talla.' Kg.',0,0,L);	
			$pdf->Cell(23,5,'P.C.: '.$pcfa,0,0,L);			
			$pdf->Cell(23,5,'IMC.: '.$imc,0,0,L);		
		}
		
		$bcomple=mysql_query("SELECT complementoexfisico.numc_cef, destipos.nomb_des, complementoexfisico.desc_cef
		FROM complementoexfisico INNER JOIN destipos ON complementoexfisico.code_cef = destipos.codi_des
		WHERE (((complementoexfisico.numc_cef)='$numhisto'));");
		$fila=$fila+5;

		while($rcom=mysql_fetch_array($bcomple))
		{
			$nomb_des=$rcom['nomb_des'];
			$desc_cef=$rcom['desc_cef'];			
			$pdf->SetXY(35,$fila);
			$pdf->MultiCell(180,5,$nomb_des.': '.$desc_cef,0,L,0);	
			$fila=$pdf->GetY();			
		}
		$pdf->SetXY(5,$fila);
$fila=$fila+$h;
		$pdf->Cell(20,5,'Otros hallazgos: ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,5,$otrohall,0,L,0);			
		
		$fila=$pdf->GetY();	
$fila=$fila+$h;		
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,5,'Informe paraclínicos: ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,5,$vec[9]	,0,L,0);
		$diag1=$vec[10];
		$bd1=mysql_query("select * from cie_10 where cod_cie10='$diag1'");
		while($rd1=mysql_fetch_array($bd1))
		{
			$desd1=$rd1['nom_cie10'];
		}
		$fila=$pdf->GetY();
$fila=$fila+$h;	
$pdf->SetXY(103,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,5,F);
				$pdf->Cell(20,5,'DIAGNOSTICO ',0,0,L);
		//$pdf->SetDrawColor(150);
		//		$pdf->line(5,$fila-0,210,$fila-0);
		//		$pdf->line(5,$fila+5,210,$fila+5);
		$fila=$fila+5;
		if($vec[11]==1)$tidi='Impresion diagnostica';
		if($vec[11]==2)$tidi='Confirmado nuevo';
		if($vec[11]==3)$tidi='Confirmado repetido';
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,5,'tipo diagnóstico: ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->Cell(23,5,$tidi,0,0,L);
		$fila=$fila+5;
		
		
$fila=$fila+$h;		
		$pdf->SetXY(5,$fila);		
		$pdf->Cell(20,5,'Principal: ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,5,$vec[10].' - '.$desd1,0,L,0);
		$fila=$pdf->GetY();
		$bdi2=mysql_query("SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, cie_10.nom_cie10
		FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10
		WHERE (((diagnosticos2.numc_di2)='$numhisto'))");
		$t=1;
		while($rd2=mysql_fetch_array($bdi2))
		{
			$codcie2=$rd2['codc_di2'];
			$desd2=$rd2['nom_cie10'];
			$pdf->SetXY(5,$fila);		
			$pdf->Cell(20,5,'Relacionado '.$t.':',0,0,L);			
			$pdf->SetXY(35,$fila);
			$pdf->MultiCell(180,5,$codcie2.' - '.$desd2,0,L,0);
			$t++;
			$fila=$pdf->GetY();
		}
$fila=$fila+$h;
		
		$pdf->SetXY(103,$fila);
	$pdf->SetFillColor($col);	
	$pdf->rect(5,$fila,205,5,F);
		$pdf->Cell(20,5,'CONDUCTA ',0,0,L);
		//$pdf->SetDrawColor(150);
		//$pdf->line(5,$fila,210,$fila);
		//$pdf->line(5,$fila+5,210,$fila+5);
		$fila=$fila+5;

		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,5,'Medicamentos ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,5,$consomed,0,L,0);
		$fila=$pdf->GetY();
$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,5,'Ayudas DX ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,5,$consoayu,0,L,0);
		$fila=$pdf->GetY();
$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,5,'Remisiones ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,5,$consoref,0,L,0);
		
		$fila=$fila+10;
		$firma="../firmas/".$codimedico.".jpg";
		if(file_exists($firma)){
		  $pdf->Image($firma,30,$fila,50,15,'','');
		}
		
		$fila=$fila+10;
		
		$pdf->SetXY(25,$fila);
		$pdf->Cell(45,5,'____________________________________',0,0,L);
		$pdf->SetXY(130,$fila);
		$pdf->Cell(10,5,'____________________________________',0,0,L);	
		$fila=$fila+4;
		$pdf->SetXY(25,$fila);
		$pdf->Cell(45,5,$nombmedico,0,0,L);
		$pdf->SetXY(130,$fila);
		$pdf->Cell(10,5,$vec[3],0,0,L);	
		$fila=$fila+4;
		$pdf->SetXY(25,$fila);
		$pdf->Cell(45,5,'Registro medico: '.$regimedico,0,0,L);
		$pdf->SetXY(130,$fila);
		$pdf->Cell(10,5,'C. C. No.',0,0,L);	


		
	}
	
	
	
	
	
	
	
	
	
	
		
	$pdf->Output();	

function titulo(&$pdf_,&$fila_,&$vec_,&$pag,$m,$pos)
{
	$pag=$pag+1;
	if($pos==1)
	{
		$pdf_->AddPage();
		$fila_=0;
	}
	else
	{			
		$fila_=135;
	}
	if($m==1)
	{
		$pdf_->Image('img\enca_imageno.JPG',1,$fila_,210,0,'','');
		$pdf_->Image('img\controlado.png',205,100,7,30,'','');
	}
	if($m==2)
	{
		$pdf_->Image('img\enca_laboratorio.JPG',1,$fila_,210,0,'','');
		$pdf_->Image('img\controlado.png',205,100,7,30,'','');
	}		
	if($m==3)
	{
		$pdf_->Image('img\enca_remision.JPG',1,$fila_,210,0,'','');
		$pdf_->Image('img\controlado.png',205,100,7,30,'','');
	}
	if($m==4)
	{
		$pdf_->Image('img\enca_formula.JPG',1,$fila_,210,0,'','');
		$pdf_->Image('img\controlado.png',205,100,7,30,'','');
	}
	if($m==5)
	{
		$pdf_->Image('img\enca_histo.JPG',1,$fila_,210,0,'','');
		$pdf_->Image('img\enca_histo.JPG',205,100,7,30,'','');
	}
	
	
	$idenevo=$vec_[0];
	$fecevo=$vec_[1];
	$servicio=$vec_[2];
	$nombre=$vec_[3];
	$sexo=$vec_[4];//$Sexo
	$contrato=$vec_[5];//$contrato
	$identificacion=$vec_[6];//$dentificacion		
	$edad=$vec_[7];//$edad=
	$muniate=$vec_[8];//$edad=
	$horasa=substr($vec_[12],0,5);//$hora de salida de consulta=
	$tipodoc=$vec_[13];//$tipo documento
	$telefono=$vec_[14];//$tipo documento
	$pdf_->SetXY(95,$fila_+20);
	$pdf_->Cell(6,5,$tipodoc.':',0);
	$pdf_->SetXY(102,$fila_+20);
	$pdf_->Cell(20,5,$identificacion,0);		
	$pdf_->SetXY(5,$fila_+20);
	$pdf_->Cell(40,5,"Nombre:",0);
	$pdf_->SetXY(20,$fila_+20);
	$pdf_->Cell(40,5,$nombre,0);		
	$pdf_->SetXY(125,$fila_+20);
	$pdf_->Cell(20,5,"sexo:",0);
	$pdf_->SetXY(133,$fila_+20);
	$pdf_->Cell(20,5,$sexo,0);		
	$pdf_->SetXY(145,$fila_+20);
	$pdf_->Cell(20,5,"Edad:",0);
	$pdf_->SetXY(155,$fila_+20);
	$pdf_->Cell(20,5,$edad,0);		
	
	
	$pdf_->SetXY(175,$fila_+20);
	$pdf_->Cell(20,5,"Telefono:",0);
	$pdf_->SetXY(190,$fila_+20);
	$pdf_->Cell(20,5,$telefono,0);		
	$pdf_->SetXY(5,$fila_+25);
	$pdf_->Cell(20,5,"Contrato:",0);
	$pdf_->SetXY(20,$fila_+25);
	$pdf_->Cell(20,5,$contrato,0);		
	$pdf_->SetXY(95,$fila_+25);
	$pdf_->Cell(40,5,"M. atención:",0);
	$pdf_->SetXY(112,$fila_+25);
	$pdf_->Cell(40,5,$muniate,0);		
	$pdf_->SetXY(145,$fila_+25);
	$pdf_->Cell(20,5,"M. servicio:",0);
	$pdf_->SetXY(163,$fila_+25);
	$pdf_->Cell(20,5,'PASTO',0);
$col=200;
	$pdf_->SetFillColor($col);	
	$pdf_->rect(5,$fila_+32,205,5,F);
	
	$pdf_->SetXY(5,$fila_+32);
	$pdf_->Cell(40,5,"Historia No. ".  $idenevo,0);
	$pdf_->SetXY(80,$fila_+32);
	$pdf_->Cell(40,5,"Servicio: ".  $servicio,0);
	$pdf_->SetXY(150,$fila_+32);
	$pdf_->Cell(40,5,"Fecha: ".$fecevo,0);
	$pdf_->SetXY(187,$fila_+32);
	$pdf_->Cell(40,5,"Hora: ".$horasa,0);
	
	
	
	//$pdf_->line(5,$fila_+32,205,$fila_+32);
	//$pdf_->line(5,$fila_+37,205,$fila_+37);  
	//$fila_=36;	
	return $pag;
}







	
	
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
		if($meses_>0){$meses_=$meses_-1;}
		$dias_=$diasmes_+$dias_;
	}
	if($meses_<0)
	{
		$meses_=12+$meses_;
		if(date("d")-$dia_<0)
	{
		$meses_=$meses_-1;}
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
			$unidad_=" Año";
		}
		else
		{
			$unidad_=" Años";
		}
	}
	else
	{
		if($meses_<>0)
		{
			$edad_=$meses_;
			if($edad_==1)
			{
				$unidad_=" Mes";
			}
			else
			{
				$unidad_=" Meses";
			}
		}
		else
		{
			$edad_=$dias_;
			if($edad_==1)
			{
				$unidad_=" Día";
			}
			else
			{
				$unidad_=" Días";
			}
		}
	}
	return($edad_.$unidad_);
}
	
	
	
	
?>