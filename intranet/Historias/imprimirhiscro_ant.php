<?php
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
	$gnumhistohc='';
	
	$fechaimpre=date('Y-m-d');
	
	$pdf=new FPDF('P','mm','Letter');
	$pdf->SetFont('Arial','',5);
	include ('php/conexion2.php');
	$bima=mysql_query("SELECT cups.codigo, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre
	FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
	WHERE (((detareferencia.numc_dre)='$numhistohc')) AND ((cups.grup_cup)='87')");
	if(mysql_num_rows($bima)>0)$numima='SI';
	$i=0;
	$consoayu='';
	
	while($rima=mysql_fetch_array($bima))
	{
		$codi=$rima['codigo'];
		$diag=$rima['ccie_dre'];
		$desc=$rima['descrip'];
		$obse=$rima['obsv_dre'];
		$cant=$rima['cant_dre'];
		$dest=$rima['dest_dre'];
		$mat1[$i][0]=$codi;
		$mat1[$i][1]=$diag;
		$mat1[$i][2]=$desc;
		$mat1[$i][3]=$obse;
		$mat1[$i][4]=$cant;
		$mat1[$i][5]=$dest;
		
		$i++;
		$consoayu=$consoayu.' '.$desc.' '.$cant.' || ';
	}
	$fin1=$i;
	$blab=mysql_query("SELECT cups.codi_cup, cups.codigo, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre, detareferencia.dest_dre
	FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
	WHERE (((detareferencia.numc_dre)='$numhistohc')) AND ((cups.grup_cup)='90')");
	if(mysql_num_rows($blab)>0)$numlab='SI';
	$i=0;
	while($rlab=mysql_fetch_array($blab))
	{
		$cod_c=$rlab['codi_cup'];
		$codi=$rlab['codigo'];
		$diag=$rlab['ccie_dre'];
		$desc=$rlab['descrip'];
		$obse=$rlab['obsv_dre'];
		$cant=$rlab['cant_dre'];
		$dest=$rlab['dest_dre'];
		$mat2[$i][0]=$codi;
		$mat2[$i][1]=$diag;
		$mat2[$i][2]=$desc;
		$mat2[$i][3]=$obse;
		$mat2[$i][4]=$cant;
		$mat2[$i][5]=$dest;
		$mat2[$i][6]=$cod_c;
		$i++;
		$consoayu= $consoayu.' '.$desc.' '.$cant.' || ';
	}
	$fin2=$i;

	$brem=mysql_query("SELECT cups.codigo, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre, detareferencia.dest_dre
	FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
	WHERE (((detareferencia.numc_dre)='$numhistohc')) AND ((cups.grup_cup)<>'87') AND ((cups.grup_cup)<>'90')");
	
	$i=0;
	if(mysql_num_rows($brem)>0)$numrem='SI';
	$consoref='';
	while($rrem=mysql_fetch_array($brem))
	{
		$codi=$rrem['codigo'];
		$diag=$rrem['ccie_dre'];
		$desc=$rrem['descrip'];
		$obse=$rrem['obsv_dre'];
		$cant=$rrem['cant_dre'];
		$dest=$rrem['dest_dre'];
		$mat3[$i][0]=$codi;
		$mat3[$i][1]=$diag;
		$mat3[$i][2]=$desc;
		$mat3[$i][3]=$obse;
		$mat3[$i][4]=$cant;	
		$mat3[$i][5]=$dest;
		$i++;
		$consoref=$consoref.' '.$desc.' '.$cant.' || ';
	}
	$brem1=mysql_query("SELECT destipos.codi_des, destipos.nomb_des, detareferencia.numc_dre, detareferencia.cant_dre, detareferencia.ccie_dre, detareferencia.obsv_dre, detareferencia.dest_dre
	FROM destipos INNER JOIN detareferencia ON destipos.codi_des = detareferencia.codi_dre
	WHERE (((detareferencia.numc_dre)='$numhistohc'))");	

	if(mysql_num_rows($brem1)>0)$numrem='SI';
	while($rrem1=mysql_fetch_array($brem1))
	{
		$codi=$rrem1['codi_des'];
		$diag=$rrem1['ccie_dre'];
		$desc=$rrem1['nomb_des'];
		$obse=$rrem1['obsv_dre'];
		$cant=$rrem1['cant_dre'];
		$dest=$rrem1['dest_dre'];
		$mat3[$i][0]=$codi;
		$mat3[$i][1]=$diag;
		$mat3[$i][2]=$desc;
		$mat3[$i][3]=$obse;
		$mat3[$i][4]=$cant;	
		$mat3[$i][5]=$dest;	
		$i++;
		$consoref=$consoref.' '.$desc.' '.$cant.' || ';
	}
	
	$fin3=$i;		
	$bmed=mysql_query("select * from medicamentosenv where numc_men='$numhistohc'");
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
		$via=$rmed['via_med'];			
		$cant=$rmed['cant_men'];
		$obsmed=$rmed['obse_men'];
		$codi=trim($codi);
		$desc='';
		$bdesmed=mysql_query("SELECT medicamentos2.codi_mdi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa
		FROM medicamentos2 INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa
		WHERE (((medicamentos2.codi_mdi)='$codi'))");
		while($rdesmed=mysql_fetch_array($bdesmed))
		{
			$desc=$rdesmed['nomb_mdi'].' '.$rdesmed['desc_ffa'];
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
	
	$busu=mysql_query("SELECT encabesadohistoria.numc_ehi, encabesadohistoria.idus_ehi, encabesadohistoria.feco_ehi, encabesadohistoria.nomb_ehi, municipio.NOMB_MUN, encabesadohistoria.sexo_ehi, encabesadohistoria.fnac_ehi, areas.nom_areas, areas.cod_areas, consultaprincipal.radx_cpl, consultaprincipal.cod1_cpl, consultaprincipal.tidx_cpl, consultaprincipal.hosa_cpl, encabesadohistoria.cous_ehi, encabesadohistoria.telf_ehi, encabesadohistoria.origconsu_ehi AS oricon
	FROM ((encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) LEFT JOIN municipio ON encabesadohistoria.muat_ehi = municipio.CODI_MUN) INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas
	WHERE (((encabesadohistoria.numc_ehi)='$numhistohc'))");

	while($rusu=mysql_fetch_array($busu))
	{
		$vec[0]=$numhistohc;
		$vec[1]=$rusu['feco_ehi'];//$fecha
		$vec[2]=$rusu['nom_areas'];//nom_areas
		$vec[3]=$rusu['nomb_ehi'];
        $vec[4]=$rusu['sexo_ehi'];//$rowusu[sexo_usu];//$Sexo		
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
		$vec[20]=$rusu['cod_areas'];		
		
		$origen=$rusu['oricon'];		
		$busori=mysql_query("select * from origen_consulta where codmuni_ori='$origen'");
		while($rori=mysql_fetch_array($busori))
		{
			$nomorigen=$rori['muni_ori'];
		}
		if($nomorigen=='' || $nomorigen==null || $nomorigen=='0')$vec[21]='PASTO';
		else $vec[21]=$nomorigen;
		$vectreacod=$rusu['cod1_cpl'];
	}
	
	$bconcit=mysql_query("SELECT contrato.NEPS_CON, encabesadohistoria.numc_ehi
	FROM encabesadohistoria INNER JOIN contrato ON encabesadohistoria.cont_ehi = contrato.CODI_CON
	WHERE (((encabesadohistoria.numc_ehi)='$numhistohc'))");
	while($rconcit=mysql_fetch_array($bconcit))
	{
		$vec[5]=strtoupper($rconcit['NEPS_CON']);//$rowusu[neps_con];//$contrato
			
	}	
	
	$bmed=mysql_query("SELECT consultaprincipal.numc_cpl, consultaprincipal.feca_cpl, medicos.cod_medi, medicos.nom_medi, medicos.reg_medi
	FROM consultaprincipal INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi
	WHERE (((consultaprincipal.numc_cpl)='$numhistohc'))");
	while($rmer=mysql_fetch_array($bmed))
	{
		$codimedico=$rmer['cod_medi'];
		$nombmedico=$rmer['nom_medi'];
		$regimedico=$rmer['reg_medi'];	
		$fechaDeControl=$rmer['feca_cpl'];		
	}
	
	
	$busconsu65=mysql_query("select cod1_cpl from consultaprincipal where numc_cpl='$numhistohc'");
	while($rconsu65=mysql_fetch_array($busconsu65))
	{
		$cod1cpl=$rconsu65['cod1_cpl'];
	}
	
	if($ima=='1')
	{
		for($i=0;$i<2;$i++)
		{
			if($i==0 || $fila>115)
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
			$pdf->Cell(75,5,'DESCRIPCION',1,0,C);
			$pdf->Cell(75,5,'OBSERVACION',1,0,C);
			$pdf->Cell(20,5,'DESTINO',1,0,C);
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
				$dest=$mat1[$n][5];	
				
				$pdf->SetXY(5,$fila);
				$pdf->MultiCell(10,5,$vectreacod,0,C,0);
				$bajo1=$pdf->GetY();				
				$pdf->SetXY(15,$fila);
				$pdf->MultiCell(22,5,$codi,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(35,$fila);
				$pdf->MultiCell(75,5,$desc,0,L,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(110,$fila);
				$pdf->MultiCell(75,5,$obse,0,L,0);				
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(184,$fila);
				$pdf->MultiCell(22,5,$dest,0,C,0);				
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(205,$fila);
				$pdf->MultiCell(10,5,$cant,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				$bajo=$bajo1-$fila;
				$pdf->Rect(5, $fila, 10, $bajo); 
				$pdf->Rect(15, $fila, 20, $bajo); 
				$pdf->Rect(35, $fila, 75, $bajo); 
				$pdf->Rect(110, $fila, 75, $bajo); 
				$pdf->Rect(185, $fila, 20, $bajo); 
				$pdf->Rect(205, $fila, 10, $bajo);				
				$fila=$fila+$bajo;
			}
			$diag1=$vec[10];
			$fila=$fila+4;		
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(10,5,'Diagnosticos:',0,0,L);	
			$pdf->SetXY(25,$fila);
			$pdf->MultiCell(190,4,' ',0,L,0);
			$fila=$pdf->GetY();						

			$cadcroimpre6="SELECT cod_cie10, nom_cie10 FROM cie_10 WHERE cod_cie10='$cod1cpl'";
			$resulcroimpre6=Mysql_query($cadcroimpre6);
			$numcroimpre6=Mysql_num_rows($resulcroimpre6);	
			if($numcroimpre6>0)
			{	
				while($rowcroimpre6=mysql_fetch_array($resulcroimpre6))
				{
					$vardescricie=$rowcroimpre6['nom_cie10'];
				}
				$fila=$fila+4;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(50,4,$cod1cpl.' - '.$vardescricie,0,0,L);
				$dbcroimpre7="SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, cie_10.nom_cie10
				FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10
				WHERE (((diagnosticos2.numc_di2)='$numhistohc'));";
				$resutcroimpre7=Mysql_query($dbcroimpre7);	
				while($rowcroimpre7=mysql_fetch_array($resutcroimpre7))
				{
					$vardescod7=$rowcroimpre7['codc_di2'];
					$vardescricie7=$rowcroimpre7['nom_cie10'];
					$fila=$fila+4;
					$pdf->SetXY(5,$fila);
					$pdf->Cell(50,4,$vardescod7.' - '.$vardescricie7,0,0,L);
				}
				$fila=$fila+4;
			}
			else
			{	
				$bdi2=mysql_query("SELECT numhisto,hipdx_crn,dxdb_crn,dxob_crn,dxhpl_crn
				FROM cr_diagnos 
				WHERE numhisto='$numhistohc'");
				$t=1;
				while($rd2=mysql_fetch_array($bdi2))
				{		
					$pdf->SetFont('Arial','',5);
					$desdies2=$rd2['hipdx_crn'];
					$bddiag=mysql_query("select * from cie_10 where cod_cie10='$desdies2'");
					while($rd1=mysql_fetch_array($bddiag))
					{
						$fila=$fila+2;
						$desd1=$rd1['nom_cie10'];
						$pdf->MultiCell($fila,3,'       ' .$desdies2.'-'.$desd1,0,L,0);				
						$fila=$pdf->GetY();
					}				
					
				}				
			}
			$banal=mysql_query("select * from consulta_soap where numc_soap='$numhistohc'");
			$ranal=mysql_fetch_array($banal);
			$anal=$ranal['anal_soap'];
			$pdf->SetXY(5,$fila);
			$pdf->Cell(10,5,'Analisis',0,0,L);
			$pdf->SetXY(25,$fila);
			$pdf->MultiCell(190,4,$anal,0,L,0);			
			$fila=$fila+10;
			$firma="../firmas/".$codimedico.".jpg";
			if(file_exists($firma))
			{
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
		for($i=0;$i<1;$i++)
		{
			if($i==0 || $fila>115)
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
			$pdf->Cell(75,5,'DESCRIPCION',1,0,C);
			$pdf->Cell(75,5,'OBSERVACION',1,0,C);
			$pdf->Cell(20,5,'DESTINO',1,0,C);
			$pdf->Cell(10,5,'CANT',1,0,C);
			$fila=$fila+5;
			for($n=0;$n<$fin2;$n++)
			{
				$codi='';
				$diag='';
				$desc='';
				$obse='';
				$cant='';
				$codig=$mat2[$n][6];
				$codi=$mat2[$n][0];
				$diag=$mat2[$n][1];
				$desc=$mat2[$n][2];
				$obse=$mat2[$n][3];
				$cant=$mat2[$n][4];
				$dest=$mat2[$n][5];	
				
				$pdf->SetXY(5,$fila);
				$pdf->MultiCell(10,5,$vectreacod,0,C,0);
				$bajo1=$pdf->GetY();				
				$pdf->SetXY(15,$fila);
				$pdf->MultiCell(22,5,$codig,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(35,$fila);
				$pdf->MultiCell(75,5,$desc,0,L,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(110,$fila);
				$pdf->MultiCell(75,5,$obse,0,L,0);				
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(184,$fila);
				$pdf->MultiCell(22,5,$dest,0,C,0);				
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(205,$fila);
				$pdf->MultiCell(10,5,$cant,0,C,0);
				
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				$bajo=$bajo1-$fila;
				
				$pdf->Rect(5, $fila, 10, $bajo); 
				$pdf->Rect(15, $fila, 20, $bajo); 
				$pdf->Rect(35, $fila, 75, $bajo); 
				$pdf->Rect(110, $fila, 75, $bajo); 
				$pdf->Rect(185, $fila, 20, $bajo); 
				$pdf->Rect(205, $fila, 10, $bajo);				
				$fila=$fila+$bajo;
			}
			$diag1=$vec[10];
			
			$fila=$fila+4;		
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(10,5,'Diagnosticos',0,0,L);	
			$pdf->SetXY(25,$fila);
			$pdf->MultiCell(190,4,' ',0,L,0);
			$fila=$pdf->GetY();						
			
			$cadcroimpre6="SELECT cod_cie10, nom_cie10 FROM cie_10 WHERE cod_cie10='$cod1cpl'";
			$resulcroimpre6=Mysql_query($cadcroimpre6);
			$numcroimpre6=Mysql_num_rows($resulcroimpre6);	
			if($numcroimpre6>0)
			{	
				while($rowcroimpre6=mysql_fetch_array($resulcroimpre6))
				{
					$vardescricie=$rowcroimpre6['nom_cie10'];
				}
				$fila=$fila+4;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(50,4,$cod1cpl.' - '.$vardescricie,0,0,L);
				$dbcroimpre7="SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, cie_10.nom_cie10
				FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10
				WHERE (((diagnosticos2.numc_di2)='$numhistohc'));";
				$resutcroimpre7=Mysql_query($dbcroimpre7);	
				while($rowcroimpre7=mysql_fetch_array($resutcroimpre7))
				{
					$vardescod7=$rowcroimpre7['codc_di2'];
					$vardescricie7=$rowcroimpre7['nom_cie10'];
					$fila=$fila+4;
					$pdf->SetXY(5,$fila);
					$pdf->Cell(50,4,$vardescod7.' - '.$vardescricie7,0,0,L);
				}
				$fila=$fila+4;
			}
			else
			{	
				$bdi2=mysql_query("SELECT numhisto,hipdx_crn,dxdb_crn,dxob_crn,dxhpl_crn
				FROM cr_diagnos WHERE numhisto='$numhistohc'");
				$t=1;
				while($rd2=mysql_fetch_array($bdi2))
				{				
					$pdf->SetFont('Arial','',5);
					$desdies2=$rd2['hipdx_crn'];
					$bddiag=mysql_query("select * from cie_10 where cod_cie10='$desdies2'");
					while($rd1=mysql_fetch_array($bddiag))
					{
						$fila=$fila+2;
						$desd1=$rd1['nom_cie10'];
						$pdf->MultiCell($fila,3,'       ' .$diag.'-'.$desd1,0,L,0);				
						$fila=$pdf->GetY();
					}				
				}	
			}
			$banal=mysql_query("select * from consulta_soap where numc_soap='$numhistohc'");
			$ranal=mysql_fetch_array($banal);
			$anal=$ranal['anal_soap'];
			$pdf->SetXY(5,$fila);
			$pdf->Cell(10,5,'Analisis',0,0,L);
			$pdf->SetXY(25,$fila);
			$pdf->MultiCell(190,4,$anal,0,L,0);
			
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
			if($i==0 || $fila>115)
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
			$pdf->Cell(75,5,'DESCRIPCION',1,0,C);
			$pdf->Cell(75,5,'OBSERVACION',1,0,C);
			$pdf->Cell(20,5,'DESTINO',1,0,C);
			$pdf->Cell(10,5,'CANT',1,0,C);
			$fila=$fila+5;
			for($n=0;$n<$fin3;$n++)
			{
				$codi='';
				$diag='';
				$desc='';
				$obse='';
				$cant='';
				$dest='';
				$codi=$mat3[$n][0];
				$diag=$mat3[$n][1];
				$desc=$mat3[$n][2];
				$obse=$mat3[$n][3];
				$cant=$mat3[$n][4];
				$dest=$mat3[$n][5];	
				$pdf->SetXY(5,$fila);
				$pdf->MultiCell(10,5,$vectreacod,0,C,0);
				$bajo1=$pdf->GetY();				
				$pdf->SetXY(15,$fila);
				$pdf->MultiCell(22,5,$codi,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(35,$fila);
				$pdf->MultiCell(75,5,$desc,0,L,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(110,$fila);
				$pdf->MultiCell(75,5,$obse,0,L,0);				
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(184,$fila);
				$pdf->MultiCell(22,5,$dest,0,C,0);				
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				$pdf->SetXY(205,$fila);
				$pdf->MultiCell(10,5,$cant,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				$bajo=$bajo1-$fila;
				$pdf->Rect(5, $fila, 10, $bajo); 
				$pdf->Rect(15, $fila, 20, $bajo); 
				$pdf->Rect(35, $fila, 75, $bajo); 
				$pdf->Rect(110, $fila, 75, $bajo); 
				$pdf->Rect(185, $fila, 20, $bajo); 
				$pdf->Rect(205, $fila, 10, $bajo); 				
				$fila=$fila+$bajo;
			}
			
			$diag1=$vec[10];
			$bd1=mysql_query("select * from cie_10 where cod_cie10='$diag'");
			while($rd1=mysql_fetch_array($bd1))
			{
				$desd1=$rd1['nom_cie10'];
			}	
			$fila=$fila+4;		
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(10,5,'Diagnosticos',0,0,L);	
			$pdf->SetXY(25,$fila);
			$pdf->MultiCell(190,4,' ',0,L,0);
			$fila=$pdf->GetY();						
			
			$cadcroimpre6="SELECT cod_cie10, nom_cie10 FROM cie_10 WHERE cod_cie10='$cod1cpl'";
			$resulcroimpre6=Mysql_query($cadcroimpre6);
			$numcroimpre6=Mysql_num_rows($resulcroimpre6);	
			if($numcroimpre6>0)
			{	
				while($rowcroimpre6=mysql_fetch_array($resulcroimpre6))
				{
					$vardescricie=$rowcroimpre6['nom_cie10'];
				}
				$fila=$fila+4;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(50,4,$cod1cpl.' - '.$vardescricie,0,0,L);
				$dbcroimpre7="SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, cie_10.nom_cie10
				FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10
				WHERE (((diagnosticos2.numc_di2)='$numhistohc'));";
				$resutcroimpre7=Mysql_query($dbcroimpre7);	
				while($rowcroimpre7=mysql_fetch_array($resutcroimpre7))
				{
					$vardescod7=$rowcroimpre7['codc_di2'];
					$vardescricie7=$rowcroimpre7['nom_cie10'];
					$fila=$fila+4;
					$pdf->SetXY(5,$fila);
					$pdf->Cell(50,4,$vardescod7.' - '.$vardescricie7,0,0,L);
				}
				$fila=$fila+4;
			}
			else
			{
				$bdi2=mysql_query("SELECT numhisto,hipdx_crn,dxdb_crn,dxob_crn,dxhpl_crn
				FROM cr_diagnos 
				WHERE numhisto='$numhistohc'");
				$t=1;
				while($rd2=mysql_fetch_array($bdi2))
				{				
					$pdf->SetFont('Arial','',5);
									$desdies2=$rd2['hipdx_crn'];
					$bddiag=mysql_query("select * from cie_10 where cod_cie10='$desdies2'");
									while($rd1=mysql_fetch_array($bddiag))
									{
											$fila=$fila+2;
											$desd1=$rd1['nom_cie10'];
											$pdf->MultiCell($fila,3,'       ' .$desdies2.'-'.$desd1,0,L,0);				
											$fila=$pdf->GetY();
									}				
					
				}
			}	
			$banal=mysql_query("select * from consulta_soap where numc_soap='$numhistohc'");
			$ranal=mysql_fetch_array($banal);
			$anal=$ranal['anal_soap'];
			$pdf->SetXY(5,$fila);
			$pdf->Cell(10,5,'Analisis',0,0,L);
			$pdf->SetXY(25,$fila);
			$pdf->MultiCell(190,4,$anal,0,L,0);
			
			
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
			if($i==0 || $fila>115)
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
			$pdf->Cell(9,5,'DX',1,0,C);
			$pdf->Cell(14,5,'CODIGO',1,0,C);
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
				$pdf->SetFont('Arial','',7);
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
				$pdf->MultiCell(9,5,$diag,0,C,0);
				$bajo1=$pdf->GetY();
				
				if(strlen($codi)>6)
				{
					$codi=substr($codi,5,7);				
				}
				$pdf->SetXY(9,$fila);
				$pdf->MultiCell(24,5,$codi,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				
				$pdf->SetXY(28,$fila);
				$pdf->MultiCell(84,5,$desc,0,L,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				
				$pdf->SetXY(112,$fila);
				$pdf->MultiCell(14,5,$dosi.' '.$undo,0,C,0);
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
				
				$pdf->SetXY(186,$fila);
				$pdf->MultiCell(15,5,$cant,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				$bajo=$bajo1-$fila;				
				
				$pdf->Rect(5, $fila, 9, $bajo); 
				$pdf->Rect(14, $fila, 14, $bajo); 
				$pdf->Rect(28, $fila, 84, $bajo); 
				$pdf->Rect(112, $fila, 14, $bajo); 
				$pdf->Rect(126, $fila, 22, $bajo); 
				$pdf->Rect(148, $fila, 19, $bajo);				
				$pdf->Rect(167, $fila, 19, $bajo); 
				$pdf->Rect(186, $fila, 15, $bajo); 
				$pdf->Rect(201, $fila, 12, $bajo); 				
				$fila=$fila+$bajo;
				$pdf->SetXY(5,$fila);
				$pdf->SetFillColor(240);
				$pdf->SetFont('Arial','',6);
				$pdf->MultiCell(208,4,'   Observaciones:  '.$obsmed,1,L,1);
				$fila=$pdf->GetY();				
				
			}
			$pdf->SetFont('Arial','',6);
			$bfor=mysql_query("select * from encabesadoformula where numc_efo='$numhistohc'");
			while($rfor=mysql_fetch_array($bfor))
			{
				$proxi=$rfor[coen_efo];
				$obse=$rfor[obfo_efo];
				$repi=$rfor[repi_efo];
			}	
			
			$fila=$fila+2;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(5,5,'Proxima consulta: '.$proxi,0,0,L);
			$pdf->SetXY(120,$fila);
			$pdf->Cell(5,5,'Repetir esta formula por '.$repi.' meses',0,0,L);			
			$fila=$fila+5;
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(210,5,'Recomendaciones: '.$obse,0,L,0);
			
			$diag1=$vec[10];
			$bd1=mysql_query("select * from cie_10 where cod_cie10='$diag1'");
			while($rd1=mysql_fetch_array($bd1))
			{
				$desd1=$rd1['nom_cie10'];
			}		
			$fila=$fila+4;		
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(10,5,'Diagnosticos',0,0,L);	
			$pdf->SetXY(25,$fila);
			$pdf->MultiCell(190,4,' ',0,L,0);
			$fila=$pdf->GetY();						
			
			$cadcroimpre6="SELECT cod_cie10, nom_cie10 FROM cie_10 WHERE cod_cie10='$cod1cpl'";
			$resulcroimpre6=Mysql_query($cadcroimpre6);
			$numcroimpre6=Mysql_num_rows($resulcroimpre6);	
			if($numcroimpre6>0)
			{	
				while($rowcroimpre6=mysql_fetch_array($resulcroimpre6))
				{
					$vardescricie=$rowcroimpre6['nom_cie10'];
				}
				$fila=$fila+4;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(50,4,$cod1cpl.' - '.$vardescricie,0,0,L);
				$dbcroimpre7="SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, cie_10.nom_cie10
				FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10
				WHERE (((diagnosticos2.numc_di2)='$numhistohc'));";
				$resutcroimpre7=Mysql_query($dbcroimpre7);	
				while($rowcroimpre7=mysql_fetch_array($resutcroimpre7))
				{
					$vardescod7=$rowcroimpre7['codc_di2'];
					$vardescricie7=$rowcroimpre7['nom_cie10'];
					$fila=$fila+4;
					$pdf->SetXY(5,$fila);
					$pdf->Cell(50,4,$vardescod7.' - '.$vardescricie7,0,0,L);
				}
				$fila=$fila+4;
			}
			else
			{
				$bdi2=mysql_query("SELECT numhisto,hipdx_crn,dxdb_crn,dxob_crn,dxhpl_crn FROM cr_diagnos WHERE numhisto='$numhistohc'");
				$t=1;
				while($rd2=mysql_fetch_array($bdi2))
				{				
					$pdf->SetFont('Arial','',5);
					$desdies2=$rd2['hipdx_crn'];
					$bddiag=mysql_query("select * from cie_10 where cod_cie10='$desdies2'");
					while($rd1=mysql_fetch_array($bddiag))
					{
						$fila=$fila+2;
						$desd1=substr($rd1['nom_cie10'],0,20);
						$pdf->MultiCell($fila,4,'       ' .$desdies2.'-'.$desd1,0,L,0);				
						$fila=$pdf->GetY();
					}				
					
				}		
            }
			$pdf->SetFont('Arial','',6);
			$banal=mysql_query("select * from consulta_soap where numc_soap='$numhistohc'");
			$ranal=mysql_fetch_array($banal);
			$anal=$ranal['anal_soap'];
			$pdf->SetXY(5,$fila);
			
			$fila=$pdf->GetY();
			$fila=$fila+2;
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
	

	
//vich
///--------------------------------------------------------iniciar impresion historia------------------------------------------	
	$col=220;
	if($his=='1')
	{
//para cambio 412		
		$destinoImpresor=0;
		$conUbicarAten=mysql_query("SELECT numhisto FROM cr_datoscronicos WHERE numhisto='$numhistohc'");
		$destinoImpresor=Mysql_num_rows($conUbicarAten);	
		if($destinoImpresor>0){
//fin
			$conPrincipal=Mysql_query("SELECT encabesadohistoria.numc_ehi, encabesadohistoria.nomb_ehi, consultaprincipal.feca_cpl, consultaprincipal.hora_cpl, consultaprincipal.area_cpl, encabesadohistoria.nomb_ehi, encabesadohistoria.telf_ehi, encabesadohistoria.dire_ehi, encabesadohistoria.sexo_ehi, encabesadohistoria.fnac_ehi, encabesadohistoria.cous_ehi, encabesadohistoria.etni_ehi, encabesadohistoria.nedu_ehi, encabesadohistoria.ocup_ehi, consultaprincipal.enac_cpl, consultaprincipal.motc_cpl, encabesadohistoria.eciv_ehi, 
			encabesadohistoria.dezpl_crn, consultaprincipal.cod1_cpl, consultaprincipal.tidx_cpl									
			FROM encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl
			WHERE (((encabesadohistoria.numc_ehi)='$numhistohc'));");
			while($rowconPrin = mysql_fetch_array($conPrincipal))
			{
				$numc_ehi=$rowconPrin['numc_ehi'];
				$nomb_ehi=$rowconPrin['nomb_ehi'];
				$feca_cpl=$rowconPrin['feca_cpl'];   
				$hora_cpl=$rowconPrin['hora_cpl']; 
				$area_cpl=$rowconPrin['area_cpl']; 
				$telf_ehi=$rowconPrin['telf_ehi']; 
				$dire_ehi=$rowconPrin['dire_ehi']; 
				$sexo_ehi=$rowconPrin['sexo_ehi']; 
				$fnac_ehi=$rowconPrin['fnac_ehi'];
				$cous_ehi=$rowconPrin['cous_ehi'];	
				$etni_ehi=$rowconPrin['etni_ehi']; 
				$nedu_ehi=$rowconPrin['nedu_ehi']; 
				$ocup_ehi=$rowconPrin['ocup_ehi']; 
				$enac_cpl=$rowconPrin['enac_cpl']; 
				$motc_cpl=$rowconPrin['motc_cpl'];
				$eciv_ehi=$rowconPrin['eciv_ehi'];
				$dezpl_crn=$rowconPrin['dezpl_crn'];
				$diagnoPrinci_crn=$rowconPrin['cod1_cpl'];
				$vartidx_cpl=$rowconPrin['tidx_cpl'];
			}
			if($dezpl_crn=='S'){
				$dezpl_crn1='SI';
			}	
			else {
				$dezpl_crn1='NO';
			}	
			
			if($sexo_ehi=='F'){
				$sexo_ehi1='Femenino';
				$dbgeneropas=2;
			}	
			if($sexo_ehi=='M'){
				$sexo_ehi1='Masculino';
				$dbgeneropas=1;
			}	
			
			if($eciv_ehi=='A701' && $sexo_ehi=='M')$estadoc1='Soltero';
			if($eciv_ehi=='A701' && $sexo_ehi=='F')$estadoc1='Soltera';
			if($eciv_ehi=='A702' && $sexo_ehi=='M')$estadoc1='Casado';
			if($eciv_ehi=='A702' && $sexo_ehi=='F')$estadoc1='Casada';
			if($eciv_ehi=='A703' && $sexo_ehi=='M')$estadoc1='Viudo';
			if($eciv_ehi=='A703' && $sexo_ehi=='F')$estadoc1='Viuda';
			if($eciv_ehi=='A704')$estadoc1='Union Libre';
			if($eciv_ehi=='A705' && $sexo_ehi=='M')$estadoc1='Divorciado';
			if($eciv_ehi=='A705' && $sexo_ehi=='F')$estadoc1='Divorciada';
			
			$conUsuario=Mysql_query("SELECT TDOC_USU, NROD_USU, FNAC_USU, TPAF_USU FROM usuario WHERE CODI_USU=$cous_ehi");
			while($rowconUsu = mysql_fetch_array($conUsuario))
			{
				$tdoc_usu=$rowconUsu['TDOC_USU'];
				$nrod_usu=$rowconUsu['NROD_USU'];
				$fnac_usu=$rowconUsu['FNAC_USU'];
				$tpaf_usu=$rowconUsu['TPAF_USU'];
				
			}
			
			if($tpaf_usu=='C')$tpaf_usu='Contributivo';
			elseif($tpaf_usu=='B')$tpaf_usu='Beneficiario';
			else $tpaf_usu='Beneficiario';
			
			$conAcusiente=Mysql_query("SELECT noma_aco, tele_aco, pare_aco FROM acompanante WHERE numc_aco ='$numhistohc'");
			while($rowconAcu = mysql_fetch_array($conAcusiente))
			{
				$noma_aco=$rowconAcu['noma_aco'];
				$tele_aco=$rowconAcu['tele_aco'];
				$pare_aco=$rowconAcu['pare_aco'];
			}
			
			$condatBas=Mysql_query("SELECT tipoconsulta_dat, tiempocons, ultimacon_dat, fechaprogra_dat, zona_dat, oriensex_dat, afiliacion, disfisica,  dismotora,  disauditiva,  disvisual, victima, tamizado FROM cr_datoscronicos WHERE numhisto='$numhistohc'");
			while($rowdatBas = mysql_fetch_array($condatBas))
			{
				$tipoconsulta_dat=$rowdatBas['tipoconsulta_dat'];
				$tiempocons=$rowdatBas['tiempocons'];
				$ultimacon_dat=$rowdatBas['ultimacon_dat'];
				$fechaprogra_dat=$rowdatBas['fechaprogra_dat'];
				$zona_dat=$rowdatBas['zona_dat'];
				$oriensex_dat=$rowdatBas['oriensex_dat'];
				$afiliacion=$rowdatBas['afiliacion'];
				$disfisica=$rowdatBas['disfisica'];
				$dismotora=$rowdatBas['dismotora'];
				$disauditiva=$rowdatBas['disauditiva'];
				$disvisual=$rowdatBas['disvisual'];
				$victima=$rowdatBas['victima'];
				$tamizado=$rowdatBas['tamizado'];
			}
			$discapacidadcro='';
			if($disfisica==1 || $dismotora==1 || $disauditiva==1 || $disvisual==1){
				if($disfisica==1)$discapacidadcro=$discapacidadcro.'  Física  ';
				if($dismotora==1)$discapacidadcro=$discapacidadcro.'  Motora  ';
				if($disauditiva==1)$discapacidadcro=$discapacidadcro.'  Auditiva  ';
				if($disvisual==1)$discapacidadcro=$discapacidadcro.'  Visual  ';
			}
			else{
				$discapacidadcro='Ninguna';
			}
			
			if($victima==1){
				$victima1='SI';
			}	
			else {
				$victima1='NO';
			}
			if($tamizado==1){
				$tamizado1='SI';
			}
			else {
				$tamizado1='NO';
			}
			if($tipoconsulta_dat==1)$tipoconsulta_dat1='Primera Consulta';
			if($tipoconsulta_dat==2)$tipoconsulta_dat1='Control Anual';
			if($tipoconsulta_dat==3)$tipoconsulta_dat1='Control';
			
			$conEscolaridad=Mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$nedu_ehi'");
			while($rowdatEsc = mysql_fetch_array($conEscolaridad))
			{
				$nombreescol1=$rowdatEsc['nomb_des'];
			}
			
			$conTrabajo=Mysql_query("SELECT DESC_OCU FROM ocupacion WHERE CODI_OCU='$ocup_ehi'");
			while($rowdatTra = mysql_fetch_array($conTrabajo))
			{
				$nombretrabajo1=$rowdatTra['DESC_OCU'];
			}
			
			if($etni_ehi="7501")$razaTexto="Indígena";
			if($etni_ehi="7502")$razaTexto="ROM (gitano)";
			if($etni_ehi="7503")$razaTexto="Raizal (Archipiélago San Andrés y Providencia)";
			if($etni_ehi="7504")$razaTexto="Palanquero de San Basilio";
			if($etni_ehi="7505")$razaTexto="Afrocolombiano(a) o Afro descendente";
			if($etni_ehi="7506")$razaTexto="Ninguna";
			
			$pdf->AddPage('P', 'Letter');
			$pdf->SetFont('Arial','',8);
			$pdf->SetDrawColor(192);
			$fila=27;
			$col=5;
			$col=220;
			$fila=6;
			$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
			$fila=$pdf->GetY();
			$numpagtot1 = 1;
			$pdf->SetXY(190,17.5);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
			$fila=$fila+20;
			$pdf->SetXY(88,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(35,4,utf8_decode('DATOS PERSONALES'),0,0,L);	
			$fila=$fila+8;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("INFORMACION BASICA") ,0,0,'L');
			$fila=$fila+4;
			
			$pdf->SetFont('Arial','',8); 
			$pdf->SetXY(5,$fila);
			$pdf->Cell(75,4,utf8_decode("NUMERO DE HISTORIA CLINICA: ".$numhistohc."      FECHA DE CONSULTA: ".$feca_cpl),0,0,'L');
			$pdf->SetXY(135,$fila);
			$pdf->Cell(128,4,utf8_decode("HORA DE CONSULTA  ".$hora_cpl)  ,0,0,'L');
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			
			$pdf->SetXY(5,$fila);
			$pdf->Cell(75,4,utf8_decode("TIEMPO DE ULTIMA CONSULTA: ".$tiempocons),0,0,'L'); 
			$pdf->SetXY(135,$fila);
			$pdf->Cell(128,4,utf8_decode("CONTROLES/CONSULTAS: ".$tipoconsulta_dat1) ,0,0,'L'); 
			
			$fila=$fila+4;
			
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("FECHA DE INGRESO AL PROGRAMA DE CRONICOS ".$fechaprogra_dat) ,0,0,'L'); 
			$pdf->SetXY(135,$fila);
			$pdf->Cell(75,4,utf8_decode("FECHA DE NACIMIENTO: ".$fnac_usu),0,0,'L');
			
			
			$fila=$fila+4;
			
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("TIPO DE IDENTIFICACION: ".$tdoc_usu) ,0,0,'L');
			$pdf->SetXY(135,$fila);
			$pdf->Cell(75,4,utf8_decode("NUMERO DE IDENTIFICACION: ".$nrod_usu),0,0,'L');
			$fila=$fila+4;
			

			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("NOMBRE DE PACIENTE: ".$nomb_ehi),0,0,'L');
			$pdf->SetXY(135,$fila);
			$pdf->Cell(75,4,utf8_decode("TELEFONO: ".strtoupper($telf_ehi)),0,0,'L');
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("DIRECCION: ".strtoupper($dire_ehi)),0,0,'L');
			$pdf->SetXY(135,$fila);
			$pdf->Cell(75,4,utf8_decode("GENERO: ".$sexo_ehi1),0,0,'L');
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("OCUPACION: ".$nombretrabajo1),0,0,'L'); //falta guardar
			$pdf->SetXY(135,$fila);
			
			$pdf->Cell(75,4,utf8_decode("EDAD: ".$fnac_ehi." Años"),0,0,'L'); 	
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("RAZA: ".$razaTexto),0,0,'L');
			$pdf->SetXY(135,$fila);
			$pdf->Cell(75,4,utf8_decode("ESTADO CIVIL: ".$estadoc1),0,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("ESCOLARIDAD: ".$nombreescol1),0,0,'L');
			$pdf->SetXY(135,$fila);
			$pdf->Cell(75,4,utf8_decode("ZONA: ".$zona_dat),0,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("AFILIACION:  ".$tpaf_usu),0,0,'L');
			$pdf->SetXY(135,$fila);
			$pdf->Cell(75,4,utf8_decode("REGIMEN DE AFILIACION: Excepción"),0,0,'L');

			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("DISCAPACIDAD: ".$discapacidadcro),0,0,'L');
			$pdf->SetXY(135,$fila);
			$pdf->Cell(128,4,utf8_decode("ORIENTACION SEXUAL:  ".$oriensex_dat),0,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("DESPLAZADO: ".$dezpl_crn1),0,0,'L');
			$pdf->SetXY(60,$fila);
			$pdf->Cell(128,4,utf8_decode("VICTIMA DE CONFLICO ARMADO:  ".$victima1),0,0,'L');
			$pdf->SetXY(135,$fila);
			$pdf->Cell(128,4,utf8_decode("TAMIZADO POR ENCUENTAS RVC:  ".$tamizado1),0,0,'L'); 
			 
			$fila=$fila+4;
			
			$fila=$fila+2;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("INFORMACION DEL ACUDIENTE") ,0,0,'L');
			$fila=$fila+4;
			
			
			$pdf->SetFont('Arial','',8);
			
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("ACUDIENTE:  ".$noma_aco)  ,0,0,'L');
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("PARENTEZCO: ".$pare_aco),0,0,'L');
			$pdf->SetXY(135,$fila);
			$pdf->Cell(75,4,utf8_decode("TELEFONO:  ".$tele_aco),0,0,'L');
			$fila=$fila+4;
			
			
			$filainicio=$fila;
			$texto12=$motc_cpl;
			$tamacel1=1;
			$filasFlotantes=4;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			$fila=$fila+2;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("ANAMNESIS") ,0,0,'L');
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->SetFont('Arial','',8);
			$pdf->MultiCell(205,4,"MOTIVO DE CONSULTA: ".utf8_decode(ucfirst($motc_cpl)) ,0,L,0);		
			$fila=$pdf->GetY();
			$fila=$fila+1;
			
		
			$filainicio=$fila;
			$texto12=$enac_cpl;
			$tamacel1=1;
			$filasFlotantes=4;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}		
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4,"ENFERMEDAD ACTUAL: ".utf8_decode(ucfirst($enac_cpl)),0,L,0);		
			$fila=$pdf->GetY();
			$fila=$fila+1;
			
			
			$hospiSiNO='NO';
			$ProstataNo='NO';
			$enfesexual='NO';
			//ANTECEDENTES	
		//---------------------------------------------------------------	
			
			$cad001="SELECT codi_des, obse_crn, tpan_crn, fech_crn FROM anteced_cronicos WHERE numhisto='$numhistohc'";
			$res001=Mysql_query($cad001);
			while($fil001=mysql_fetch_array($res001))		
			{
				$codi_des=$fil001['codi_des'];
				$obse_crn=$fil001['obse_crn'];
				$tpan_crn=$fil001['tpan_crn'];
				$fech_crn=$fil001['fech_crn'];
				if($codi_des=='P01')$p01='S';
				if($codi_des=='P02')$p02='S';
				if($codi_des=='P03')$p03='S';
				if($codi_des=='P04')$p04='S';
				if($codi_des=='P05')$p05='S';
				if($codi_des=='P06')$p06='S';
				if($codi_des=='P07')$p07='S';
				if($codi_des=='P08')$p08='S';
				if($codi_des=='P09')$p09='S';
				if($codi_des=='P10')$p10='S';
				if($codi_des=='P11')$p11='S';
				if($codi_des=='P12')$p12='S';
				if($codi_des=='P13')$p13='S';
				if($codi_des=='P14')$p14='S';
				if($codi_des=='P15')$p15='S';
				if($codi_des=='P16')$p16='S';
				if($codi_des=='P17')$p17='S';
				if($codi_des=='P18')$p18='S';
				if($codi_des=='P19')$p19='S';
				if($codi_des=='P20')$p20='S';
				if($codi_des=='P21')$p21='S';
				if($codi_des=='P22')$p22='S';
				if($codi_des=='P23')$p23='S';
				if($codi_des=='P24')$p24='S';
				if($codi_des=='P25')$p25=$obse_crn;
				if($codi_des=='P26')$p26=$obse_crn;
				
				if($codi_des=='F01')$f01='S';
				if($codi_des=='F02')$f02='S';
				if($codi_des=='F03')$f03='S';
				if($codi_des=='F04')$f04='S';
				if($codi_des=='F05')$f05='S';
				if($codi_des=='F06')$f06='S';
				if($codi_des=='F07')$f07='S';
				if($codi_des=='F08')$f08='S';
				if($codi_des=='F09')$f09='S';
				if($codi_des=='F10')$f10='S';
				if($codi_des=='F11')$f11='S';
				if($codi_des=='F12')$f12='S';
				if($codi_des=='F13')$f13='S';
				if($codi_des=='F14')$f14='S';
				if($codi_des=='F15')$f15='S';
				if($codi_des=='F16')$f16='S';
				
				if($codi_des=='F17')$f17=$obse_crn;
				if($codi_des=='H01'){
					$hospiSiNO='SI';
					$MotivoHospi=$obse_crn;
					$dias_hospita=$tpan_crn;
				}
				if($codi_des=='T01'){
					$ProstataNo="SI";
					$resultadoProstata=$obse_crn;
					$fechaProstata=$fech_crn;
				}	
				if($codi_des=='S01'){
					$enfesexual='SI';
					$obsenfsexual=$obse_crn;
				}
				
				if($codi_des=='M01')$m01=$obse_crn;
				
				if($codi_des=='Y01')$y01='S';
				if($codi_des=='Y02')$y02='S';
				if($codi_des=='Y03')$y03='S';
				if($codi_des=='Y04')$y04='S';
				if($codi_des=='Y05')$y05='S';
				if($codi_des=='Y06')$y06='S';
				if($codi_des=='Y07')$y07=$obse_crn;
				
			}
			
			if($p01=='S')$phipertension='SI'; else  $phipertension='NO';
			if($p02=='S')$pdiabetes='SI'; else  $pdiabetes='NO';
			if($p03=='S')$pdislipidemia='SI'; else  $pdislipidemia='NO';
			if($p04=='S')$pcoronaria='SI'; else  $pcoronaria='NO';
			if($p05=='S')$pcervix='SI'; else  $pcervix='NO';
			if($p06=='S')$pquirurgicos='SI'; else  $pquirurgicos='NO';
			if($p07=='S')$pfarmacologicos='SI'; else  $pfarmacologicos='NO';
			if($p08=='S')$pepoc='SI'; else $pepoc='NO';
			if($p09=='S')$personasma='SI'; else  $personasma='NO';
			if($p10=='S')$pvariam='SI'; else  $pvariam='NO';
			if($p11=='S')$pendocrina='SI'; else  $pendocrina='NO';
			if($p12=='S')$prenal='SI'; else  $prenal='NO';
			if($p13=='S')$pobesidad='SI'; else  $pobesidad='NO';
			if($p14=='S')$pcanmama='SI'; else  $pcanmama='NO';
			if($p15=='S')$palergicos='SI'; else  $palergicos='NO';
			if($p16=='S')$pvascular='SI'; else  $pvascular='NO';
			if($p17=='S')$pcerebral='SI'; else  $pcerebral='NO';
			if($p18=='S')$pcolon='SI'; else  $pcolon='NO';
			if($p19=='S')$pprostata='SI'; else  $pprostata='NO';
			if($p20=='S')$pgastrico='SI'; else  $pgastrico='NO';
			if($p21=='S')$ptraumaticos='SI'; else  $ptraumaticos='NO';
			if($p22=='S')$ptuberculosis='SI'; else  $ptuberculosis='NO';
			if($p23=='S')$pvacunas='SI'; else  $pvacunas='NO';
			if($p24=='S')$potro='SI'; else  $potro='NO';
			
			if($f01=='S')$farterial='SI'; else  $farterial='NO';
			if($f02=='S')$fdiabetes='SI'; else  $fdiabetes='NO';
			if($f03=='S')$fdislipid='SI'; else  $fdislipid='NO';
			if($f04=='S')$fefcardiovas='SI'; else  $fefcardiovas='NO';
			if($f05=='S')$fcancervix='SI'; else  $fcancervix='NO';
			if($f06=='S')$fiamvar='SI'; else  $fiamvar='NO';
			if($f07=='S')$fefendocrina='SI'; else  $fefendocrina='NO';
			if($f08=='S')$fobecida='SI'; else $fobecida='NO';
			if($f09=='S')$fenrenal='SI'; else  $fenrenal='NO';
			if($f10=='S')$fcanmama='SI'; else  $fcanmama='NO';
			if($f11=='S')$fenfvas='SI'; else  $fenfvas='NO';
			if($f12=='S')$fencerebral='SI'; else  $fencerebral='NO';
			if($f13=='S')$fcancolon='SI'; else  $fcancolon='NO';
			if($f14=='S')$fcanpors='SI'; else  $fcanpors='NO';
			if($f15=='S')$fcangastric='SI'; else  $fcangastric='NO';
			if($f16=='S')$fotros='SI'; else  $fotros='NO';
			
			$filainicio=$fila;
			$texto12='abc';
			$tamacel1=1;
			$filasFlotantes=40;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			$fila=$fila+2;
			$pdf->SetXY(88,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(35,4,utf8_decode('ANTECEDENTES'),0,0,L);	
			
			$fila=$fila+5;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("ANTECEDENTES PERSONALES") ,0,0,'L');
			$fila=$fila+5;
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Hipertension Arterial")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($phipertension)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" IAM ")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($pvariam)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Enf. Vascular"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($pvascular)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Diabetes")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($pdiabetes)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Enf. Endocrina")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($pendocrina)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Enf. Cerebral"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($pcerebral)  ,1,0,'L');

			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Dislipidemia")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($pdislipidemia)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Enf. Renal")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($prenal)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Cancer de Colon"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($pcolon)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Enf. Coronaria")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($pcoronaria)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Obesidad")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($pobesidad)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Cancer de prostata"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($pprostata)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Cancer de Cervix")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($pcervix)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Cancer de mama")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($pcanmama)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Cancer Gastrico"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($pgastrico)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Quirurgicos")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($pquirurgicos)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Alergicos")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($palergicos)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Traumaticos"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($ptraumaticos)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Farmacologicos")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($pfarmacologicos)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Vacunas")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($pvacunas)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Tuberculosis"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($ptuberculosis)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Epoc")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($pepoc)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Asma")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($personasma)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Otro"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($potro)  ,1,0,'L');
			$fila=$fila+6;
			
			$filainicio=$fila;
			$texto12=$p25;
			$tamacel1=1;
			$filasFlotantes=4;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}		
			
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4,"VACUNAS APLICADAS: ".utf8_decode(ucfirst($p25)),0,L,0);		
			$fila=$pdf->GetY();
			$fila=$fila+1;
			
		//FIN TEXT AREA	
			
			$filainicio=$fila;
			$texto12=$p26;
			$tamacel1=1;
			$filasFlotantes=4;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+10;
			}		
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4,"OBSERVACIONES: ".utf8_decode(ucfirst($p26)),0,L,0);		
			$fila=$pdf->GetY();
			$fila=$fila+1;
			
			
			$filainicio=$fila;
			$texto12='ACB';
			$tamacel1=1;
			$filasFlotantes=30;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filaflotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}		
			
			$fila=$fila+3;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("ANTECEDENTES FAMILIARES") ,0,0,'L');
			$fila=$fila+5;
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Hipertension Arterial")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($farterial)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Enfermedad Cardiovascular ")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($fefcardiovas)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Enfermedad Endocrina"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($fefendocrina)  ,1,0,'L');

			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Cancer de Mama")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($fcanmama)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Cancer de Colon ")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($fcancolon)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Diabetes"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($fdiabetes)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Cancer de Cervix")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($fcancervix)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Obecidad ")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($fobecida)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Enfermedad vascular"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($fenfvas)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Cancer de Prostata")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($fcanpors)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Dislipidemia")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($fdislipid)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" IAM"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($fiamvar)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Enfermedad Renal")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($fenrenal)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Enfermedad Cerebral")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($fencerebral)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Cancer Gastrico"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($fcangastric)  ,1,0,'L');
			
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Otros")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($fotros)  ,1,0,'L');
			
			$filainicio=$fila;
//			$texto12='En el siglo XVII, la sencillez y elegancia con que Isaac Newton había logrado explicar las leyes que rigen el movimiento de los cuerpos y el de los astros, unificando la física terrestre y la celeste, deslumbró hasta tal punto a sus contemporáneos que llegó a considerarse completada la mecánica. A finales del siglo XIX, sin embargo, era ya insoslayable la relevancia de algunos fenómenos que la física clásica no podía explicar. Correspondió a Albert Einstein superar tales carencias con la creación de un nuevo paradigma: la teoría de la relatividad, punto de partida de la física moderna.';
			$texto12=$f17;
			$filasFlotantes=4;
			$tamacel1=1;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			$fila=$fila+5;
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4,"OBSERVACIONES: ".utf8_decode(ucfirst($f17)) ,0,L,0);		
			$fila=$pdf->GetY();
			$fila=$fila+1;
			$filainicio=$fila;
			$texto12=$MotivoHospi;
			$filasFlotantes=16;
			$tamacel1=1;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			$fila=$fila+1;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("HOSPITALIZACION") ,0,0,'L');
			$fila=$fila+4;
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("¿USTED HA ESTADO HOSPITALIZADO (A)?  ".$hospiSiNO)  ,0,0,'L');
			
			$fila=$fila+4;
			
			if($hospiSiNO=='SI'){	
				$pdf->SetXY(5,$fila);
				$pdf->MultiCell(205,4, utf8_decode("¿PORQUE MOTIVO ESTUVO HOSPITALIZADO (A)? ".$MotivoHospi) ,0,L,0);		
				$fila=$pdf->GetY();
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("¿CUÁNTOS DÍAS ESTUVO HOSPITALIZADO?  ").$dias_hospita  ,0,0,'L');
				
				$fila=$fila+4;
			}
			
			
			
			if($dbgeneropas==1){
				$filainicio=$fila;
				$texto12=$resultadoProstata;
				$tamacel1=1;
				$filasFlotantes=12;
				if (empty($texto12)){$lineas=0;}
				else{largoTexto($texto12,$tamacel1);}
				$filasfinal=$filasFlotantes+$filainicio+$lineas; 
				if($filasfinal>255)
				{
					$pdf->AddPage('P', 'Letter');
					$pdf->SetFont('Arial','',8);
					$pdf->SetDrawColor(192);
					$fila=27;
					$col=5;
					$col=220;
					$fila=6;
					$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
					$fila=$pdf->GetY();
					$pdf->SetXY(190,17.5);
					$pdf->SetFont('Arial','',9);
					$numpagtot1 = $numpagtot1+1;
					$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
					$fila=$fila+13;
				}
				
				$fila=$fila+1;
				$pdf->SetFont('Arial','B',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(128,4,utf8_decode("TAMIZAJE DE PROSTATA") ,0,0,'L');
				$fila=$fila+4;
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("ANTÍGENO PROSTÁTICO ESPECÍFICO:  ".$ProstataNo )  ,0,0,'L');
				$fila=$fila+4;
				
				if($ProstataNo=='SI'){
					$pdf->SetFont('Arial','',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(60,4,utf8_decode("FECHA DE PSA:  ".$fechaProstata )  ,0,0,'L');
					$fila=$fila+4;
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(205,4, utf8_decode("RESULTADO: ".$resultadoProstata) ,0,L,0);		
					$fila=$pdf->GetY();
					$fila=$fila+1;
				}
			}
			
			
			
			$filainicio=$fila;
			$texto12=$obsenfsexual;
			$tamacel1=1;
			$filasFlotantes=12;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			$fila=$fila+1;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("ENFERMEDAD DE TRANSMISION SEXUAL") ,0,0,'L');
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			
			$pdf->Cell(60,4,utf8_decode("ENFERMEDAD DE TRANSMISIÓN SEXUAL:  ".$enfesexual )  ,0,0,'L');
			$fila=$fila+4;
			if($enfesexual=='SI'){
				$pdf->SetXY(5,$fila);
				$pdf->MultiCell(205,4, utf8_decode("¿CUAL? ".$obsenfsexual) ,0,L,0);		
				$fila=$pdf->GetY();
				$fila=$fila+1;
			}
			
			$cad002="SELECT * FROM antgine_cronicos WHERE numhisto='$numhistohc'";
			$res002=Mysql_query($cad002);
			while($fil002=mysql_fetch_array($res002))		
			{
				$plan_crn=$fil002['plan_crn'];
				$meno_crn=$fil002['meno_crn'];
				$mequcrm=$fil002['mequcrm'];
				$gest_crn=$fil002['gest_crn'];
				$part_crn=$fil002['part_crn'];
				$abor_crn=$fil002['abor_crn'];
				$cesa_crn=$fil002['cesa_crn'];
				$fcito_crn=$fil002['fcito_crn'];
				$vivosf_crn=$fil002['vivosf_crn'];
				$numerocom_crn=$fil002['numerocom_crn'];
				$fechaMamografia_crn=$fil002['fechaMamografia_crn'];
				$metpl_crn=$fil002['metpl_crn'];
				$tplan_crn=$fil002['tplan_crn'];
				$espermarca_crn=$fil002['espermarca_crn'];
			}
			
//			$dbgeneropas=2;

			if($plan_crn=='S')$plan_crn1='SI';
			if($plan_crn=='N')$plan_crn1='NO';
					
			if($dbgeneropas==2){
				$fila=$fila+1;
				$filasfinal=$fila+50;
				if($filasfinal>255)
				{
					$pdf->AddPage('P', 'Letter');
					$pdf->SetFont('Arial','',8);
					$pdf->SetDrawColor(192);
					$fila=27;
					$col=5;
					$col=220;
					$fila=6;
					$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
					$fila=$pdf->GetY();
					$pdf->SetXY(190,17.5);
					$pdf->SetFont('Arial','',9);
					$numpagtot1 = $numpagtot1+1;
					$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
					$fila=$fila+13;
				}		
				
				
				
					$fila=$fila+1;
					$pdf->SetFont('Arial','B',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(128,4,utf8_decode("ANTECEDENTES DE PLANIFICACION FAMILIAR" ) ,0,0,'L');
					$fila=$fila+4;
					$pdf->SetFont('Arial','',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(12,4,'Planificacion Familiar '. utf8_decode($plan_crn1).'               Metodo: '.utf8_decode($metpl_crn).'              Tiempo: '.utf8_decode($tplan_crn) ,0,0,L);
					$fila=$fila+4;
					$pdf->SetXY(5,$fila);
					$pdf->Cell(12,4,'FUM: 2022-04-05           Menopausia: '.utf8_decode($meno_crn).'             Menarquia: '.utf8_decode($mequcrm).'          Fecha de Citologia '.utf8_decode($fcito_crn). '                  Fecha de Mamografia '.$fechaMamografia_crn ,0,0,L);
					
					$fila=$fila+5;
					$pdf->SetFont('Arial','B',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(128,4,utf8_decode("A.G.O" ) ,0,0,'L');
					$pdf->SetFont('Arial','',8);
					
					$fila=$fila+4;
					$pdf->SetXY(5,$fila);
					$pdf->Cell(12,4,'Gestas: '.utf8_decode($gest_crn).'               Partos: '.utf8_decode($part_crn).'              Cesareas: '.utf8_decode($cesa_crn).'               Abortos: '.$abor_crn.'               Vivos '.utf8_decode($vivosf_crn) ,0,0,L);
					
					$fila=$fila+4;
					$pdf->SetXY(5,$fila);
					$pdf->Cell(12,4, utf8_decode('Numero de Compañeros: ').$numerocom_crn ,0,0,L);
					
					$pdf->SetXY(55,$fila);
					$fila=$fila+5;	
			}
			
			else{
				$fila=$fila+2;
				$filasfinal=$fila+40;
				if($filasfinal>255)
				{
					$pdf->AddPage('P', 'Letter');
					$pdf->SetFont('Arial','',8);
					$pdf->SetDrawColor(192);
					$fila=27;
					$col=5;
					$col=220;
					$fila=6;
					$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
					$fila=$pdf->GetY();
					$pdf->SetXY(190,17.5);
					$pdf->SetFont('Arial','',9);
					$numpagtot1 = $numpagtot1+1;
					$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
					$fila=$fila+13;
				}		
				
				$fila=$fila+1;
				$pdf->SetFont('Arial','B',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(128,4,utf8_decode("ANTECEDENTES DE PLANIFICACION FAMILIAR") ,0,0,'L');
				$fila=$fila+4;
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(12,4,'Planificacion Familiar '. utf8_decode($plan_crn1).'               Metodo: '.utf8_decode($metpl_crn).'              Tiempo: '.utf8_decode($tplan_crn) ,0,0,L);
				$fila=$fila+4;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(12,4,utf8_decode('ESPERMAQUIA: ').utf8_decode($espermarca_crn)  ,0,0,L);
				
				$fila=$fila+4;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(12,4, utf8_decode('Numero de compañeros Sexuales ').utf8_decode($numerocom_crn) ,0,0,L);
				
				$pdf->SetXY(55,$fila);
				$fila=$fila+5;
			}
			
			
			$filainicio=$fila;
			$texto12=$m01;
			$tamacel1=1;
			$filasFlotantes=4;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			$fila=$fila+1;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("MEDICAMENTOS EN USO") ,0,0,'L');
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4, utf8_decode($m01) ,0,L,0);		
			$fila=$pdf->GetY();
			$fila=$fila+1;
			
		
			$filainicio=$fila;
			$texto12=$y07;
			$tamacel1=1;
			$filasFlotantes=30;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			if($y01=='S')$testmori1='SI'; else  $testmori1='NO';
			if($y02=='S')$testmori2='SI'; else  $testmori2='NO';
			if($y03=='S')$testmori3='SI'; else  $testmori3='NO';
			if($y04=='S')$testmori4='SI'; else  $testmori4='NO';
			if($y05=='S')$testmori5='SI'; else  $testmori5='NO';
			if($y06=='S')$testmori6='SI'; else  $testmori6='NO';
			
			$fila=$fila+3;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("TEST DE MORISKY-GREEN-LEVINE") ,0,0,'L');
			$fila=$fila+5;
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(90,4,utf8_decode(" ¿Es descuidado con la hora de la Toma de Medicamentos?")  ,1,0,'L');
			$pdf->SetXY(95,$fila);
			$pdf->Cell(8,4,utf8_decode($testmori1)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(90,4,utf8_decode(" ¿Cuando se encuentra bien los deja de Tomar?")  ,1,0,'L');
			$pdf->SetXY(95,$fila);
			$pdf->Cell(8,4,utf8_decode($testmori2)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(90,4,utf8_decode(" ¿Si alguna Vez le caen mal los deja de Tomar?")  ,1,0,'L');
			$pdf->SetXY(95,$fila);
			$pdf->Cell(8,4,utf8_decode($testmori3)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(90,4,utf8_decode(" ¿Alergico a Medicamentos?")  ,1,0,'L');
			$pdf->SetXY(95,$fila);
			$pdf->Cell(8,4,utf8_decode($testmori4)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(90,4,utf8_decode(" ¿Hay Adherencia al Tratamiento?")  ,1,0,'L');
			$pdf->SetXY(95,$fila);
			$pdf->Cell(8,4,utf8_decode($testmori5)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(90,4,utf8_decode(" ¿Se Olvida alguna Vez de Tomar los Medicamentos?")  ,1,0,'L');
			$pdf->SetXY(95,$fila);
			$pdf->Cell(8,4,utf8_decode($testmori6)  ,1,0,'L');
			
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4, utf8_decode("¿Cuáles Medicamentos? ".$y07) ,0,L,0);		
			$fila=$pdf->GetY();
			$fila=$fila+1;
			
	//FIN ANTECEDENTES
			

	//FACTORES DE RIESGO

				

			$cad003="SELECT * FROM friesg_cronicos WHERE numhisto='$numhistohc'";
			$res003=Mysql_query($cad003);
			while($fil003=mysql_fetch_array($res003))		
			{
				$cgras_crn=$fil003['cgras_crn'];
				$cosal_crn=$fil003['cosal_crn'];
				$cfrut_crn=$fil003['cfrut_crn'];
				$cpsic_crn=$fil003['cpsic_crn'];
				$icsm_crn=$fil003['icsm_crn'];
				$efec_crn=$fil003['efec_crn'];
				$frec_crn=$fil003['frec_crn'];
				$nume_crn=$fil003['nume_crn'];
				$exhu_crn=$fil003['exhu_crn'];
				$anhu_crn=$fil003['anhu_crn'];
				$obri_crn=$fil003['obri_crn'];
				$esta_crn=$fil003['esta_crn	'];
				$oper_crn=$fil003['oper_crn'];
				$complicar_crn=$fil003['complicar_crn'];
				$complicer_crn=$fil003['complicer_crn'];
				$compliret_crn=$fil003['compliret_crn'];
				$complivas_crn=$fil003['complivas_crn'];
				$compliren_crn=$fil003['compliren_crn'];
				$complinin_crn=$fil003['complinin_crn'];
				$dejarfumar_crn=$fil003['dejarfumar_crn'];
			}
			$complicacioBlanda='';
			if($complicar_crn=='S')$complicacioBlanda=$complicacioBlanda.' Cadiacas,';
			if($complicer_crn=='S')$complicacioBlanda=$complicacioBlanda.' Cerebrales,';
			if($compliret_crn=='S')$complicacioBlanda=$complicacioBlanda.' Retinianas,';
			if($complivas_crn=='S')$complicacioBlanda=$complicacioBlanda.' Vascular periferico,';
			if($compliren_crn=='S')$complicacioBlanda=$complicacioBlanda.' Renales,';
			
			$complicacioBlanda1=substr($complicacioBlanda, 0, -1);
			
			
			if($cgras_crn=='S')$cgras_crn1='SI'; else $cgras_crn1='NO';
			if($cosal_crn=='S')$cosal_crn1='SI'; else $cosal_crn1='NO';
			if($cfrut_crn=='S')$cfrut_crn1='SI'; else $cfrut_crn1='NO';
			
			if($icsm_crn=='1')$fumaAbito='SI'; else $fumaAbito='NO';
			if($frec_crn=='S')$frec_crn1='SI'; else $frec_crn1='NO';	
			if($dejar_fumar=='S')$dejar_fumar1='SI'; else $dejar_fumar1='NO';	
			
			if($efec_crn=='1')$efec_crn1='No';
			if($efec_crn=='2')$efec_crn1='Ocasional';
			if($efec_crn=='3')$efec_crn1='Mes';
			if($efec_crn=='4')$efec_crn1='Quincenal';
			if($efec_crn=='5')$efec_crn1='Semanal';
			if($efec_crn=='6')$efec_crn1='Diario';
			
			if($cpsic_crn=='S')$cpsic_crn1='SI'; else $cpsic_crn1='NO';
					
			
			$cad004="SELECT * FROM cr_actividadf WHERE numhisto='$numhistohc'";
			$res004=Mysql_query($cad004);
			while($fil004=mysql_fetch_array($res004))		
			{
				$frecu_crn=$fil004['frecu_crn'];
				$camin_crn=$fil004['camin_crn'];
				$nadar_crn=$fil004['nadar_crn'];
				$bailar_crn=$fil004['bailar_crn'];
				$bici_crn=$fil004['bici_crn'];
				$durac_crn=$fil004['durac_crn'];
				$esta_crn=$fil004['esta_crn'];
				$oper_crn=$fil004['oper_crn'];
				$marcha_crn=$fil004['marcha_crn'];
				$trotar_crn=$fil004['trotar_crn'];
			}
			
			if($frecu_crn==1)$frecu_crn1='Sedentario';
			if($frecu_crn==2)$frecu_crn1='Diario';
			if($frecu_crn==3)$frecu_crn1='3 por semana';
			if($frecu_crn==4)$frecu_crn1='1 por semana';
			if($frecu_crn==5)$frecu_crn1='Quincenal';
			if($frecu_crn==6)$frecu_crn1='Mensual';
			
			if($camin_crn=='S')$camin_crn1='Caminar'; else $camin_crn1='';
			if($nadar_crn=='S')$nadar_crn1='Nadar'; else $nadar_crn1='';
			if($bailar_crn=='S')$bailar_crn1='Bailar'; else $bailar_crn1='';
			if($marcha_crn=='S')$marcha_crn1='Marcha'; else $marcha_crn1='';
			if($trotar_crn=='S')$trotar_crn1='Trotar'; else $trotar_crn1='';
			if($bici_crn=='S')$bici_crn1='Montar Bicicleta'; else $bici_crn1='';
			
			$actividadFisica= $camin_crn1.' '.$nadar_crn1.' '.$bailar_crn1.' '.$marcha_crn1.' '.$trotar_crn1.' '.$bici_crn1;
			
			if($durac_crn=='1')$duracion='0 - 15 Minutos';
			if($durac_crn=='2')$duracion='15 - 30 Minutos';
			if($durac_crn=='3')$duracion='30 Minitus - 1 Hora';
			if($durac_crn=='4')$duracion='Mas de 1 hora';

			
			
			$cad005="SELECT * FROM viole_cronicos WHERE numhisto='$numhistohc'";
			$res005=Mysql_query($cad005);
			while($fil005=mysql_fetch_array($res005))		
			{
				$tvio_des=$fil005['tvio_des'];
				$obs_viol=$fil005['obs_viol'];
				if($tvio_des=='8601')$tvio_des1='S';
				if($tvio_des=='8602')$tvio_des2='S';
				if($tvio_des=='8603')$tvio_des3='S';
				if($tvio_des=='8604')$tvio_des4='S';
				if($tvio_des=='8605')$tvio_des5='S';
				if($tvio_des=='8606')$tvio_des6='S';
				if($tvio_des=='8607')$tvio_des7=$obs_viol;
			}
			if($tvio_des1=='S'){
				$tvio_des11='SI';
			}	
			else{
				$tvio_des11='NO'; 
			}
			if($tvio_des2=='S'){
				$tvio_des12='SI';
			}	
			else{	
				$tvio_des12='NO';
			}			
			if($tvio_des3=='S'){
				$tvio_des13='SI';
			}
			else{	
				$tvio_des13='NO';
			}
			if($tvio_des4=='S'){
				$tvio_des14='SI';
			}
			else{	
				$tvio_des14='NO';
			}
			if($tvio_des5=='S'){
				$tvio_des15='SI';
			}
			else{	
				$tvio_des15='NO';
			}	
			if($tvio_des6=='S'){
				$tvio_des16='SI';
			}
			else{	
				$tvio_des16='NO';
			}
			
			$filainicio=$fila;
			$texto12='ABC';
			$tamacel1=1;
			$filasFlotantes=30;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			
			
			$fila=$fila+2;
			$pdf->SetXY(88,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(35,4,utf8_decode('FACTORES DE RIESGO MODIFICABLES'),0,0,L);	
			
			$fila=$fila+5;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("NUTRICION") ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$fila=$fila+4;
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("Consumo de grasas saturadas (Fritos, mantequilla, tocino, comidas rápidas, vísceras, chicharon, carnes fritas, carnes gordas por semana)  ".$cgras_crn1 )  ,0,0,'L');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("¿Agrega sal adicional a las comidas? ".$cosal_crn1 )  ,0,0,'L');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("¿Consume diariamente frutas y verduras?  ".$cfrut_crn1 )  ,0,0,'L');
			
			
			$filainicio=$fila;
			$texto12='ABC';
			$tamacel1=1;
			$filasFlotantes=24;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			$fila=$fila+5;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("ACTIVIDAD FISICA") ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$fila=$fila+4;
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("Actividad Física:  ".$frecu_crn1 )  ,0,0,'L');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("Tipos de actividad:  ".$actividadFisica )  ,0,0,'L');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("Duracion de la actividad física: ".$duracion )  ,0,0,'L');
			
			
			$filainicio=$fila;
			$texto12=$tvio_des7;
			$tamacel1=1;
			$filasFlotantes=24;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>245)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			$fila=$fila+5;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("HABITO DE FUMAR, CONSUMO DE ALCOHOL Y EXPOSICIÓN A TOXICOS ") ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$fila=$fila+4;
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("¿Fuma?  ".$fumaAbito )  ,0,0,'L');
			$fila=$fila+4;
			
			if($fumaAbito=='SI'){	
			
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("Número de cigarrillos al dia:  ".$nume_crn )  ,0,0,'L');
				$fila=$fila+4;
				
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("Ha intentado dejar el cigarrillo:  ".$frec_crn1 )  ,0,0,'L');
				$fila=$fila+4;
				
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("Le gustaría dejar el cigarrillo:  ".$dejar_fumar1 )  ,0,0,'L');
				$fila=$fila+4;
			
			}
			
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("Consumo de Alcohol:  ".$efec_crn1 )  ,0,0,'L');
			$fila=$fila+4;
			
			if($efec_crn1=='SI'){
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("Número de Años:  ".$exhu_crn )  ,0,0,'L');
				$fila=$fila+4;
			}
			
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("¿Consume sustancias psicoactivas?  ".$cpsic_crn1 )  ,0,0,'L');
			$fila=$fila+5;
			
			$filainicio=$fila;
			$texto12='ABC';
			$tamacel1=1;
			$filasFlotantes=24;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>253)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("VIOLENCIA INTRAFAMILIAR ") ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$fila=$fila+4;
			
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("¿Cuando tiene problemas es apoyado por su familia?  ".$tvio_des11 )  ,0,0,'L');
			$fila=$fila+4;
		
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("¿En la familia existen expresiones de afecto y cariño?   ".$tvio_des12 )  ,0,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("¿Se siente rechazado por alguien de su familia?   ".$tvio_des13 )  ,0,0,'L');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("¿Ha sido agredido físicamente por alguien de su familia?  ".$tvio_des14 )  ,0,0,'L');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("¿Ha tenido ideas o pensamientos suicidas?   ".$tvio_des15 )  ,0,0,'L');
			
			
			
			$filainicio=$fila;
			$texto12=$tvio_des7;
			$tamacel1=1;
			$filasFlotantes=4;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>253)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4, utf8_decode("Observación: ".$tvio_des7) ,0,L,0);		
			$fila=$pdf->GetY();
			$fila=$fila+1;
	// FIN FACTORES DE RIESGO MODIFICABLES		


	//REVISION POR SISTEMAS
			
			$cad006="SELECT codrevis FROM cr_revision WHERE numhisto='$numhistohc'";
			$res006=Mysql_query($cad006);
			while($fil006=mysql_fetch_array($res006))		
			{
				$codrevis=$fil006['codrevis'];
				
				if($codrevis=='8701')$codrevis1='S';
				if($codrevis=='8702')$codrevis2='S';
				if($codrevis=='8703')$codrevis3='S';
				if($codrevis=='8704')$codrevis4='S';
				if($codrevis=='8705')$codrevis5='S';
				if($codrevis=='8706')$codrevis6='S';
				if($codrevis=='8707')$codrevis7='S';
				if($codrevis=='8708')$codrevis8='S';
				if($codrevis=='8709')$codrevis9='S';
				if($codrevis=='8710')$codrevis10='S';
				if($codrevis=='8711')$codrevis11='S';
				if($codrevis=='8712')$codrevis12='S';
				if($codrevis=='8713')$codrevis13='S';
				if($codrevis=='8714')$codrevis14='S';
				if($codrevis=='8715')$codrevis15='S';
				if($codrevis=='8716')$codrevis16='S';
				if($codrevis=='8717')$codrevis17='S';
				if($codrevis=='8718')$codrevis18='S';
				if($codrevis=='8719')$codrevis19='S';
				if($codrevis=='8720')$codrevis20='S';
				if($codrevis=='8721')$codrevis21='S';
				if($codrevis=='8722')$codrevis22='S';
				if($codrevis=='8723')$codrevis23='S';
				if($codrevis=='8724')$codrevis24='S';
				if($codrevis=='8725')$codrevis25='S';
				if($codrevis=='8726')$codrevis26='S';
				if($codrevis=='8727')$codrevis27='S';
				if($codrevis=='8728')$codrevis28='S';
				if($codrevis=='8729')$codrevis29='S';
				if($codrevis=='8730')$codrevis30='S';
				if($codrevis=='8731')$codrevis31='S';
				if($codrevis=='8732')$codrevis32='S';
				if($codrevis=='8733')$codrevis33='S';
			}
			if($codrevis1=='S')$Cefalea='SI'; else $Cefalea='NO'; 
			if($codrevis2=='S')$Lipotimia='SI'; else $Lipotimia='NO';
			if($codrevis3=='S')$Sincope='SI'; else $Sincope='NO'; 		
			if($codrevis4=='S')$Vertigo='SI'; else $Vertigo='NO'; 
			if($codrevis5=='S')$Tinitus='SI'; else $Tinitus='NO';
			if($codrevis6=='S')$Fosfenos='SI'; else $Fosfenos='NO';
			if($codrevis7=='S')$Perdida='SI'; else $Perdida='NO'; 
			if($codrevis8=='S')$Fotofobia='SI'; else $Fotofobia='NO';
			if($codrevis9=='S')$Suduracion='SI'; else $Suduracion='NO';
			if($codrevis10=='S')$Epistaxis='SI'; else $Epistaxis='NO'; 
			if($codrevis11=='S')$Hipoacusia='SI'; else $Hipoacusia='NO';
			if($codrevis12=='S')$Palpitaciones='SI'; else $Palpitaciones='NO';
			if($codrevis13=='S')$Dolor='SI'; else $Dolor='NO'; 
			if($codrevis14=='S')$Edemas='SI'; else $Edemas='NO';
			if($codrevis15=='S')$Tos='SI'; else $Tos='NO';
			if($codrevis16=='S')$Disnea='SI'; else $Disnea='NO'; 
			if($codrevis17=='S')$Hemoptisis='SI'; else $Hemoptisis='NO';
			if($codrevis18=='S')$Ortopnea='SI'; else $Ortopnea='NO';
			if($codrevis19=='S')$Polidipsia='SI'; else $Polidipsia='NO'; 
			if($codrevis20=='S')$Poliuria='SI'; else $Poliuria='NO';
			if($codrevis21=='S')$Polaquiuria='SI'; else $Polaquiuria='NO';
			if($codrevis22=='S')$Nicturia='SI'; else $Nicturia='NO'; 
			if($codrevis23=='S')$Hematuria='SI'; else $Hematuria='NO';
			if($codrevis24=='S')$Disuria='SI'; else $Disuria='NO';
			if($codrevis25=='S')$Incontinencia='SI'; else $Incontinencia='NO'; 
			if($codrevis26=='S')$Neuropatico='SI'; else $Neuropatico='NO';
			if($codrevis27=='S')$Claudicacion='SI'; else $Claudicacion='NO';
			if($codrevis28=='S')$Ulcera ='SI'; else $Ulcera ='NO'; 
			if($codrevis29=='S')$Impotencia ='SI'; else $Impotencia ='NO';
			if($codrevis30=='S')$Peso='SI'; else $Peso='NO';
			if($codrevis31=='S')$Marcha='SI'; else $Marcha='NO'; 
			if($codrevis32=='S')$Equilibrio='SI'; else $Equilibrio='NO';
			if($codrevis33=='S')$Asintomatico='SI'; else $Asintomatico='NO';
			
			$cad007="SELECT * FROM cr_signos WHERE numhisto='$numhistohc'";
			$res007=Mysql_query($cad007);
			while($fil007=mysql_fetch_array($res007))		
			{
				$spiel_crn=$fil007['spiel_crn'];
				$sreps_crn=$fil007['sreps_crn'];
				$fcard_crn=$fil007['fcard_crn'];
				$fresp_crn=$fil007['fresp_crn'];
				$temp_crn=$fil007['temp_crn'];
				$tarts1_crn=$fil007['tarts1_crn'];
				$tarts2_crn=$fil007['tarts2_crn'];
				$tarta1_crn=$fil007['tarta1_crn'];
				$tarta2_crn=$fil007['tarta2_crn'];
				$tartp1_crn=$fil007['tartp1_crn'];
				$tartp2_crn=$fil007['tartp2_crn'];
				$peso_crn=$fil007['peso_crn'];
				$talla_crn=$fil007['talla_crn'];
				$imas_crn=$fil007['imas_crn'];
				$imco_crn=$fil007['imco_crn'];
				$perh_crn=$fil007['perh_crn'];
				$perm_crn=$fil007['perm_crn'];
				$esta_crn=$fil007['esta_crn'];
				$oper_crn=$fil007['oper_crn'];
				$snervioso_crn=$fil007['snervioso_crn'];
				$saturaciono_crn=$fil007['saturaciono_crn'];
			}	
			
			$clasificacionImc2='';
			if($imas_crn<18.5){
				$clasificacionImc2='Delgadez';
			}
			if($imas_crn>=18.5 && $imas_crn<25){
				$clasificacionImc2='Normal';
			}
			if($imas_crn>=25 && $imas_crn<30){
				$clasificacionImc2='Sobrepeso';
			}
			if($imas_crn>=30 && $imas_crn<35){
				$clasificacionImc2='Obesidad grado I';
			}
			if($imas_crn>=35 && $imas_crn<40){
				$clasificacionImc2='Obesidad grado II';
			}
			if($imas_crn>=40){
				$clasificacionImc2='Obesidad grado III';
			}
			
			
			
			if($spiel_crn=='S'){
				$spiel_crn1='SI';
			}
			else {
				$spiel_crn1='NO';
			}		
			if($sreps_crn=='S'){
				$sreps_crn1='SI'; 
			}	
			else{
				$sreps_crn1='NO';
			}
			if($snervioso_crn=='S'){
				$snervioso_crn1='SI'; 
			}	
			else {
				$snervioso_crn1='NO';
			}	
			$tencionderecha=$tarts1_crn.' - '.$tarts2_crn;		
			$tencionizq=$tarta1_crn.' - '.$tarta2_crn;
			$tencionpro=$tartp1_crn.' - '.$tartp2_crn;
			
			
			$filainicio=$fila;
			$texto12='ABC';
			$tamacel1=1;
			$filasFlotantes=30;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>250)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			$fila=$fila+2;
			$pdf->SetXY(88,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(35,4,utf8_decode('REVISION POR SISTEMAS '),0,0,L);	
			
			$fila=$fila+5;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("SINTOMÁTICOS") ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$fila=$fila+4;
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("Sintomático  Respiratorio: ".$sreps_crn1 )  ,0,0,'L');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("Sintomático de Piel ".$spiel_crn1 )  ,0,0,'L');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("Sintomático sistema nerviosos periferico  ".$snervioso_crn1 )  ,0,0,'L');
			
			
			$filainicio=$fila;
			$texto12='ABC';
			$tamacel1=1;
			$filasFlotantes=50;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>240)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			
			
			
			$fila=$fila+5;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("SINTOMAS") ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$fila=$fila+4;
			
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Cefalia")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($Cefalea)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Lipotimia ")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($Lipotimia)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Sincope"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($Sincope)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Vertigo")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($Vertigo)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Tinitus")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($Tinitus)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Fosfenos"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($Fosfenos)  ,1,0,'L');

			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Perdida de Visión")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($Perdida)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Fotofobia")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($Fotofobia)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Suduración"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($Suduracion)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Epistaxis")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($Epistaxis)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Hipoacusia")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($Hipoacusia)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Palpitaciones"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($Palpitaciones)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Dolor Precordial")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($Dolor)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Edemas")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($Edemas)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Tos"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($Tos)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Disnea")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($Disnea)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Hemoptisis")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($Hemoptisis)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Ortopnea"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($Ortopnea)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Polidepsia")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($Polidipsia)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Poliuria")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($Poliuria)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Polaquiuria"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($Polaquiuria)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Nicturia")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($Nicturia)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Hematuria")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($Hematuria)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Ortopnea"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($Ortopnea)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Incontinencia")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($Incontinencia)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Dolor Neuropatico")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($Neuropatico)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Claudicación "),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($Claudicacion)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Ulcera en pie")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($Ulcera)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Impotencia Sexual")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($Impotencia)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Perdida de Peso "),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($Peso)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Alteracion de la marcha")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($Marcha)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Alteraciones del equilibrio")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($Equilibrio)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Asintomatico "),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($Asintomatico)  ,1,0,'L');
			
			
			$filainicio=$fila;
			$texto12='ABC';
			$tamacel1=1;
			$filasFlotantes=30;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			
			$fila=$fila+5;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("SIGNOS VITALES") ,0,0,'L');
			$pdf->SetFont('Arial','',8);

			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("Frecuencia Cardiaca ".$fcard_crn.  "             Frecuencia Respiratoria ".$fresp_crn."             Temperatura ".$temp_crn."             Saturación de Oxigeno ".$saturaciono_crn    )  ,0,0,'L');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("Tension Arterial Derecho ".$tencionderecha.  "             Tension Artertial Izquierdo ".$tencionizq."             Tension Arterial Promedio ".$tencionpro    )  ,0,0,'L');
			
			$fila=$fila+5;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("MEDIDAS ANTROPOMETRICAS") ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("Peso ".$peso_crn.  "               Talla ".$talla_crn."                 IMC  ".$imas_crn."  Clasificación:  ".$clasificacionImc2."                      Perimetro Abdominal ".$imco_crn    )  ,0,0,'L');
			
			$fila=$fila+6;
			
		
		//EXAMEN FISICO
		//-----------------------------------------------------
				
			$cad008="SELECT codf_crn, obsf_crn FROM cr_exfisico WHERE numhisto='$numhistohc'";
			$res008=Mysql_query($cad008);
			while($fil008=mysql_fetch_array($res008))		
			{
				$obsf_crn='';
				$codf_crn=$fil008['codf_crn'];
				$obsf_crn=$fil008['obsf_crn'];
				if($codf_crn=='8801'){
					$codf_crn1='S';
					$obsefis1=$obsf_crn;
				}	
				if($codf_crn=='8802')
					{$codf_crn2='S';
					$obsefis2=$obsf_crn;
				}
				if($codf_crn=='8803'){
					$codf_crn3='S';
					$obsefis3=$obsf_crn;
				}
				if($codf_crn=='8804'){
					$codf_crn4='S';
					$obsefis4=$obsf_crn;
				}
				if($codf_crn=='8805'){
					$codf_crn5='S';
					$obsefis5=$obsf_crn;
				}
				if($codf_crn=='8806'){
					$codf_crn6='S';
					$obsefis6=$obsf_crn;
				}
				if($codf_crn=='8807'){
					$codf_crn7='S';
					$obsefis7=$obsf_crn;
				}
				if($codf_crn=='8808'){
					$codf_crn8='S';
					$obsefis8=$obsf_crn;
				}
				if($codf_crn=='8809'){
					$codf_crn9='S';
					$obsefis9=$obsf_crn;
				}
				if($codf_crn=='8810'){
					$codf_crn10='S';
					$obsefis10=$obsf_crn;
				}
				if($codf_crn=='8811'){
					$codf_crn11='S';
					$obsefis11=$obsf_crn;
				}
				if($codf_crn=='8812'){
					$codf_crn12='S';
					$obsefis12=$obsf_crn;
				}
				if($codf_crn=='8813'){
					$codf_crn13='S';
					$obsefis13=$obsf_crn;
				}	
			}
			if($codf_crn1=='S')$codfinf_crn1='NO'; else $codfinf_crn1='SI'; 
			if($codf_crn2=='S')$codfinf_crn2='NO'; else $codfinf_crn2='SI';
			if($codf_crn3=='S')$codfinf_crn3='NO'; else $codfinf_crn3='SI';
			if($codf_crn4=='S')$codfinf_crn4='NO'; else $codfinf_crn4='SI';
			if($codf_crn5=='S')$codfinf_crn5='NO'; else $codfinf_crn5='SI';
			if($codf_crn6=='S')$codfinf_crn6='NO'; else $codfinf_crn6='SI';
			if($codf_crn7=='S')$codfinf_crn7='NO'; else $codfinf_crn7='SI';
			if($codf_crn8=='S')$codfinf_crn8='NO'; else $codfinf_crn8='SI';
			if($codf_crn9=='S')$codfinf_crn9='NO'; else $codfinf_crn9='SI';
			if($codf_crn10=='S')$codfinf_crn10='NO'; else $codfinf_crn10='SI';
			if($codf_crn11=='S')$codfinf_crn11='NO'; else $codfinf_crn11='SI';
			if($codf_crn12=='S')$codfinf_crn12='NO'; else $codfinf_crn12='SI';
			if($codf_crn13=='S')$codfinf_crn13='NO'; else $codfinf_crn13='SI';
			
			
			$filainicio=$fila;
			$filaquieta=15;
			
			$tamacel1=1;
			$filasFlotantes=4;
			
			$texto12=$vparenthta_ant;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filaparcial20=$lineas; 

			$texto12=$vparendiab_ant;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filaparcial21=$lineas;
			
			$texto12=$vpareecoro_ant;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filaparcial22=$lineas;
			
			$texto12=$vparenacv_ant;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filaparcial23=$lineas;
			
			$texto12=$vasmacoro_ant;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filaparcial24=$lineas;
			
			$texto12=$vparencan_ant;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filaparcial25=$lineas;
			
			$texto12=$vparenecongen_ant;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filaparcial26=$lineas;
			
			$texto12=$vparenesiquiatri_ant;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filaparcial27=$lineas;
			
			$texto12=$vparenttbc_ant;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filaparcial28=$lineas;
			
	//		$texto12=$vvacunaant_ant;
	//		if (empty($texto12)){$lineas=0;}
	//		else{largoTexto($texto12,$tamacel1);}
	//		$filaparcial29=$lineas;
			
			$texto12=$votroparent_ant;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filaparcial30=$lineas;
			$filasFlotantes=4;
			$filasfinal=$filasFlotantes+$filainicio+$filaquieta+$filaparcial20+$filaparcial21+$filaparcial22+$filaparcial23+$filaparcial24+$filaparcial25+$filaparcial26+$filaparcial27+$filaparcial28+$filaparcial29+$filaparcial30;
			
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.jpg',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(194,24.4);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}		
			
			


			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,204,4,F);
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(204,4,utf8_decode("EXAMEN FISICO")  ,1,0,'C');

			$fila=$fila+6;
			
			
			$pdf->SetFont('Arial','B',8);
			
			$pdf->SetXY(5,$fila);
			$pdf->Cell(28,4,utf8_decode("")  ,1,0,'C');
			
			$pdf->SetXY(33,$fila);
			$pdf->Cell(15,4,utf8_decode("NORMAL")  ,1,0,'C');
			
			$pdf->SetXY(48,$fila);
			$pdf->Cell(161,4,utf8_decode("OBSERVACION"),1,0,'C');

			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			
			
			$pdf->SetXY(48,$fila);
			$pdf->MultiCell(161,4,utf8_decode($obsefis1),0,L,0);
			$fila62=$pdf->GetY();
			$pdf->SetXY(5,$fila);
			$pdf->Cell(28,4,utf8_decode(" Cabeza")  ,0,0,'L');
			$pdf->SetXY(33,$fila);
			$pdf->Cell(15,4,utf8_decode($codfinf_crn1)  ,0,0,'L');
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(5,$fila, 28, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(33,$fila, 15, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(48,$fila, 161, $filamarco1);
			$fila=$fila62;
			
			$pdf->SetXY(48,$fila);
			$pdf->MultiCell(161,4,utf8_decode($obsefis2),0,L,0);
			$fila62=$pdf->GetY();
			$pdf->SetXY(5,$fila);
			$pdf->Cell(28,4,utf8_decode(" Ojos")  ,0,0,'L');
			$pdf->SetXY(33,$fila);
			$pdf->Cell(15,4,utf8_decode($codfinf_crn2)  ,0,0,'L');
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(5,$fila, 28, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(33,$fila, 15, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(48,$fila, 161, $filamarco1);
			$fila=$fila62;
			
			$pdf->SetXY(48,$fila);
			$pdf->MultiCell(161,4,utf8_decode($obsefis3),0,L,0);
			$fila62=$pdf->GetY();
			$pdf->SetXY(5,$fila);
			$pdf->Cell(28,4,utf8_decode(" ORL")  ,0,0,'L');
			$pdf->SetXY(33,$fila);
			$pdf->Cell(15,4,utf8_decode($codfinf_crn3)  ,0,0,'L');
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(5,$fila, 28, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(33,$fila, 15, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(48,$fila, 161, $filamarco1);
			$fila=$fila62;
			
			
		
			$pdf->SetXY(48,$fila);
			$pdf->MultiCell(161,4,utf8_decode($obsefis4),0,L,0);
			$fila62=$pdf->GetY();
			$pdf->SetXY(5,$fila);
			$pdf->Cell(28,4,utf8_decode(" Cuello")  ,0,0,'L');
			$pdf->SetXY(33,$fila);
			$pdf->Cell(15,4,utf8_decode($codfinf_crn4)  ,0,0,'L');
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(5,$fila, 28, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(33,$fila, 15, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(48,$fila, 161, $filamarco1);
			$fila=$fila62;
			
			
			$pdf->SetXY(48,$fila);
			$pdf->MultiCell(161,4,utf8_decode($obsefis5),0,L,0);
			$fila62=$pdf->GetY();
			$pdf->SetXY(5,$fila);
			$pdf->Cell(28,4,utf8_decode(" Torax")  ,0,0,'L');
			$pdf->SetXY(33,$fila);
			$pdf->Cell(15,4,utf8_decode($codfinf_crn5)  ,0,0,'L');
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(5,$fila, 28, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(33,$fila, 15, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(48,$fila, 161, $filamarco1);
			$fila=$fila62;

			
			
			$pdf->SetXY(48,$fila);
			$pdf->MultiCell(161,4,utf8_decode($obsefis6),0,L,0);
			$fila62=$pdf->GetY();
			$pdf->SetXY(5,$fila);
			$pdf->Cell(28,4,utf8_decode(" Corazon")  ,0,0,'L');
			$pdf->SetXY(33,$fila);
			$pdf->Cell(15,4,utf8_decode($codfinf_crn6)  ,0,0,'L');
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(5,$fila, 28, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(33,$fila, 15, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(48,$fila, 161, $filamarco1);
			$fila=$fila62;

					
			$pdf->SetXY(48,$fila);
			$pdf->MultiCell(161,4,utf8_decode($obsefis7) ,0,L,0);
			$fila62=$pdf->GetY();
			$pdf->SetXY(5,$fila);
			$pdf->Cell(28,4,utf8_decode(" Pulmones")  ,0,0,'L');
			$pdf->SetXY(33,$fila);
			$pdf->Cell(15,4,utf8_decode($codfinf_crn7)  ,0,0,'L');
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(5,$fila, 28, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(33,$fila, 15, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(48,$fila, 161, $filamarco1);
			$fila=$fila62;

				
			$pdf->SetXY(48,$fila);
			$pdf->MultiCell(161,4,utf8_decode($obsefis8),0,L,0);
			$fila62=$pdf->GetY();
			$pdf->SetXY(5,$fila);
			$pdf->Cell(28,4,utf8_decode(" Abdomen")  ,0,0,'L');
			$pdf->SetXY(33,$fila);
			$pdf->Cell(15,4,utf8_decode($codfinf_crn8)  ,0,0,'L');
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(5,$fila, 28, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(33,$fila, 15, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(48,$fila, 161, $filamarco1);
			$fila=$fila62;

			$pdf->SetXY(48,$fila);
			$pdf->MultiCell(161,4,utf8_decode($obsefis9),0,L,0);
			$fila62=$pdf->GetY();
			$pdf->SetXY(5,$fila);
			$pdf->Cell(28,4,utf8_decode(" Genitourinario")  ,0,0,'L');
			$pdf->SetXY(33,$fila);
			$pdf->Cell(15,4,utf8_decode($codfinf_crn9)  ,0,0,'L');
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(5,$fila, 28, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(33,$fila, 15, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(48,$fila, 161, $filamarco1);
			$fila=$fila62;

			$pdf->SetXY(48,$fila);
			$pdf->MultiCell(161,4,utf8_decode($obsefis10),0,L,0);
			$fila62=$pdf->GetY();
			$pdf->SetXY(5,$fila);
			$pdf->Cell(28,4,utf8_decode(" Extremidades")  ,0,0,'L');
			$pdf->SetXY(33,$fila);
			$pdf->Cell(15,4,utf8_decode($codfinf_crn10)  ,0,0,'L');
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(5,$fila, 28, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(33,$fila, 15, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(48,$fila, 161, $filamarco1);
			$fila=$fila62;

				
			$pdf->SetXY(48,$fila);
			$pdf->MultiCell(161,4,utf8_decode($obsefis11),0,L,0);
			$fila62=$pdf->GetY();
			$pdf->SetXY(5,$fila);
			$pdf->Cell(28,4,utf8_decode(" Neurologico")  ,0,0,'L');
			$pdf->SetXY(33,$fila);
			$pdf->Cell(15,4,utf8_decode($codfinf_crn11)  ,0,0,'L');
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(5,$fila, 28, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(33,$fila, 15, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(48,$fila, 161, $filamarco1);
			$fila=$fila62;

			$pdf->SetXY(48,$fila);
			$pdf->MultiCell(161,4,utf8_decode($obsefis12),0,L,0);	
			$fila62=$pdf->GetY();
			$pdf->SetXY(5,$fila);
			$pdf->Cell(28,4,utf8_decode(" Musculoesqueletico")  ,0,0,'L');
			$pdf->SetXY(33,$fila);
			$pdf->Cell(15,4,utf8_decode($codfinf_crn12)  ,0,0,'L');
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(5,$fila, 28, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(33,$fila, 15, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(48,$fila, 161, $filamarco1);
			$fila=$fila62;

			
			
			$pdf->SetXY(48,$fila);
			$pdf->MultiCell(161,4,utf8_decode($obsefis13),0,L,0);
			$fila62=$pdf->GetY();
			$pdf->SetXY(5,$fila);
			$pdf->Cell(28,4,utf8_decode(" Piel")  ,0,0,'L');
			$pdf->SetXY(33,$fila);
			$pdf->Cell(15,4,utf8_decode($codfinf_crn13)  ,0,0,'L');
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(5,$fila, 28, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(33,$fila, 15, $filamarco1);
			$filamarco1=$fila62-$fila;	
			$pdf->Rect(48,$fila, 161, $filamarco1);
			$fila=$fila62;

			$fila=$fila+1;
			
	//FIN EXAMEN FISICO		
			

	//LECTURA DE AYUDAS				
			
			$cad009="SELECT * FROM cr_lectura WHERE numhisto='$numhistohc'";
			$res009=Mysql_query($cad009);
			while($fil009=mysql_fetch_array($res009))		
			{
				$resultados_lec=$fil009['resultados_lec'];
				$tfg_lec=$fil009['tfg_lec'];
				$clasificaciontfg_lec=$fil009['clasificaciontfg_lec'];
				$ckdip_lec=$fil009['ckdip_lec'];
				$clasifickdip_lec=$fil009['clasifickdip_lec'];
				$epoc_crn=$fil009['epoc_crn'];
				$disnea_crn=$fil009['disnea_crn'];
				$exacerbaciones_crn=$fil009['exacerbaciones_crn'];
				$valorfev_crn=$fil009['valorfev_crn'];
				$ejercicio_crn=$fil009['ejercicio_crn'];
				$ibodex_crn=$fil009['ibodex_crn'];
				$clasibodex_crn=$fil009['clasibodex_crn'];
				$ibode_crn=$fil009['ibode_crn'];
				$clasibode_crn=$fil009['clasibode_crn'];
				$valortfg_lec=$fil009['valortfg_lec'];
				
			}
			if($valortfg_lec==1){
				$valortfg_lec1='SI';
			}	
			else{
				$valortfg_lec1='NO';
			}
			
			$fila=$fila+4;
			$filainicio=$fila;
			$texto12=$resultados_lec;
			$tamacel1=1;
			$filasFlotantes=16;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,204,4,F);
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(204,4,utf8_decode("LECTURA DE AYUDAS DIAGNOSTICAS")  ,1,0,'C');

			$fila=$fila+6;
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4, utf8_decode("RESULTADOS: ".$resultados_lec) ,0,L,0);		
			$fila=$pdf->GetY();
			$fila=$fila+1;
			
			$filainicio=$fila;
			$texto12='ABC';
			$tamacel1=1;
			$filasFlotantes=12;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}

			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("TFG COMPARADA:  ".$valortfg_lec1. "              TFG  Cockroft :  ".$tfg_lec. "              Clasificacion :  ".$clasificaciontfg_lec            )  ,0,0,'L');
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("CKD:  ".$ckdip_lec. "               Clasificacion :  ".$clasifickdip_lec )  ,0,0,'L');
			$fila=$fila+5;
	//FIN AYUDAS 
			
	//DIAGNOSTICOS				
			$conciediaz=Mysql_query("SELECT nom_cie10 FROM cie_10 WHERE cod_cie10='$diagnoPrinci_crn'");
			while($ciefil01=mysql_fetch_array($conciediaz))		
			{	
				$diagnoPrinci_crn1=$ciefil01['nom_cie10'];
			}
			$diagnoPrinci_crn2=$diagnoPrinci_crn.' - '.$diagnoPrinci_crn1;
			if($vartidx_cpl==1)$vartidx_cpl1="Impresión Diagnóstica";
			if($vartidx_cpl==2)$vartidx_cpl1="Confirmado Nuevo";
			if($vartidx_cpl==3)$vartidx_cpl1="Confirmado Repetido";
			
			$conDiagnostico=Mysql_query("SELECT analisis_crn, hta_crn, hta_crn, ta_crn, compensahta, diabetes_crn, diabetescontrol_crn, indiceframin_crn, claframingra_crn  FROM cr_diagnos WHERE numhisto='$numhistohc'");
			while($cdiagl01=mysql_fetch_array($conDiagnostico))		
			{	
				$analisis_crn=$cdiagl01['analisis_crn'];
				$hta_crn=$cdiagl01['hta_crn'];
				$ta_crn=$cdiagl01['ta_crn'];
				$compensahta=$cdiagl01['compensahta'];
				$diabetes_crn=$cdiagl01['diabetes_crn'];
				$diabetescontrol_crn=$cdiagl01['diabetescontrol_crn'];
				$indiceframin_crn=$cdiagl01['indiceframin_crn'];
				$claframingra_crn=$cdiagl01['claframingra_crn'];
			}
			
			if($diabetescontrol_crn==1){
				$diabetescontrol_crn1='SI';
			}
			else{
				$diabetescontrol_crn1='NO';
			}
			
			$conDiagnosticoRel=Mysql_query("SELECT diagnosticos2.codc_di2, diagnosticos2.orde_die2, diagnosticos2.obse_die2, cie_10.nom_cie10 FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2=cie_10.cod_cie10 WHERE numc_di2='$numhistohc'");
			while($cdil3=mysql_fetch_array($conDiagnosticoRel))		
			{	
				$codc_di2=$cdil3['codc_di2'];
				$orde_die2=$cdil3['orde_die2'];
				$obse_die2=$cdil3['obse_die2'];
				$nom_cie10=$cdil3['nom_cie10'];
				if($orde_die2=='R1'){
					$diagRela1=$codc_di2.' - '.$nom_cie10;
					$observaRela1=$obse_die2;
				}
				if($orde_die2=='R2'){
					$diagRela2=$codc_di2.' - '.$nom_cie10;
					$observaRela2=$obse_die2;
				}
				if($orde_die2=='R3'){
					$diagRela3=$codc_di2.' - '.$nom_cie10;
					$observaRela3=$obse_die2;
				}
				if($orde_die2=='R4'){
					$diagRela4=$codc_di2.' - '.$nom_cie10;
					$observaRela4=$obse_die2;
				}
				if($orde_die2=='R5'){
					$diagRela5=$codc_di2.' - '.$nom_cie10;
					$observaRela5=$obse_die2;
				}
				if($orde_die2=='R6'){
					$diagRela6=$codc_di2.' - '.$nom_cie10;
					$observaRela6=$obse_die2;
				}
			}
			
			$fila=$fila+4;
			
			$filainicio=$fila;
			$texto12=$mothito;
			$tamacel1=1;
			$filasFlotantes=20;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,204,4,F);
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(204,4,utf8_decode("DIAGNOSTICOS")  ,1,0,'C');

			$fila=$fila+6;
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("DIAGNOTICO PRINCIPAL") ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4, utf8_decode("PRINCIPAL: ".$diagnoPrinci_crn2) ,0,L,0);		
			$fila=$pdf->GetY();
			$fila=$fila+1;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("TIPO DE DIAGNOSTICO:  ".$vartidx_cpl1 )  ,0,0,'L');
			$fila=$fila+4;
			
					

			if($diagRela1!='' || $diagRela2!='' || $diagRela3!='' || $diagRela4!='' || $diagRela5!='' || $diagRela6!=''){

				$pdf->SetFont('Arial','B',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(128,4,utf8_decode("DIAGNOSTICOS RELACIONADOS") ,0,0,'L');
				$pdf->SetFont('Arial','',8);
				$fila=$fila+4;
				
				if($diagRela1!=''){
					
					$filainicio=$fila;
					$texto12=$observaRela1;
					$tamacel1=1;
					$filasFlotantes=12;
					if (empty($texto12)){$lineas=0;}
					else{largoTexto($texto12,$tamacel1);}
					$filasfinal=$filasFlotantes+$filainicio+$lineas; 
					if($filasfinal>255)
					{
						$pdf->AddPage('P', 'Letter');
						$pdf->SetFont('Arial','',8);
						$pdf->SetDrawColor(192);
						$fila=27;
						$col=5;
						$col=220;
						$fila=6;
						$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
						$fila=$pdf->GetY();
						$pdf->SetXY(190,17.5);
						$pdf->SetFont('Arial','',9);
						$numpagtot1 = $numpagtot1+1;
						$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
						$fila=$fila+13;
					}
					
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(205,4, utf8_decode("RELACIONADO 1: ".$diagRela1) ,0,L,0);		
					$fila=$pdf->GetY();
					$fila=$fila+1;
					
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(205,4, utf8_decode("OBSERVACIONES: ".$observaRela1) ,0,L,0);		
					$fila=$pdf->GetY();
					$fila=$fila+1;
				}
				
				
				if($diagRela2!=''){
					$filainicio=$fila;
					$texto12=$observaRela2;
					$tamacel1=1;
					$filasFlotantes=12;
					if (empty($texto12)){$lineas=0;}
					else{largoTexto($texto12,$tamacel1);}
					$filasfinal=$filasFlotantes+$filainicio+$lineas; 
					if($filasfinal>255)
					{
						$pdf->AddPage('P', 'Letter');
						$pdf->SetFont('Arial','',8);
						$pdf->SetDrawColor(192);
						$fila=27;
						$col=5;
						$col=220;
						$fila=6;
						$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
						$fila=$pdf->GetY();
						$pdf->SetXY(190,17.5);
						$pdf->SetFont('Arial','',9);
						$numpagtot1 = $numpagtot1+1;
						$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
						$fila=$fila+13;
					}
					
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(205,4, utf8_decode("RELACIONADO 2: ".$diagRela2) ,0,L,0);		
					$fila=$pdf->GetY();
					$fila=$fila+1;
					
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(205,4, utf8_decode("OBSERVACIONES: ".$observaRela2) ,0,L,0);		
					$fila=$pdf->GetY();
					$fila=$fila+1;
				}
				
				if($diagRela3!=''){
					
					$filainicio=$fila;
					$texto12=$observaRela3;
					$tamacel1=1;
					$filasFlotantes=12;
					if (empty($texto12)){$lineas=0;}
					else{largoTexto($texto12,$tamacel1);}
					$filasfinal=$filasFlotantes+$filainicio+$lineas; 
					if($filasfinal>255)
					{
						$pdf->AddPage('P', 'Letter');
						$pdf->SetFont('Arial','',8);
						$pdf->SetDrawColor(192);
						$fila=27;
						$col=5;
						$col=220;
						$fila=6;
						$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
						$fila=$pdf->GetY();
						$pdf->SetXY(190,17.5);
						$pdf->SetFont('Arial','',9);
						$numpagtot1 = $numpagtot1+1;
						$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
						$fila=$fila+13;
					}
					
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(205,4, utf8_decode("RELACIONADO 3: ".$diagRela3) ,0,L,0);		
					$fila=$pdf->GetY();
					$fila=$fila+1;
					
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(205,4, utf8_decode("OBSERVACIONES: ".$observaRela3) ,0,L,0);		
					$fila=$pdf->GetY();
					$fila=$fila+1;
				}
				
				if($diagRela4!=''){
					$filainicio=$fila;
					$texto12=$observaRela4;
					$tamacel1=1;
					$filasFlotantes=12;
					if (empty($texto12)){$lineas=0;}
					else{largoTexto($texto12,$tamacel1);}
					$filasfinal=$filasFlotantes+$filainicio+$lineas; 
					if($filasfinal>255)
					{
						$pdf->AddPage('P', 'Letter');
						$pdf->SetFont('Arial','',8);
						$pdf->SetDrawColor(192);
						$fila=27;
						$col=5;
						$col=220;
						$fila=6;
						$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
						$fila=$pdf->GetY();
						$pdf->SetXY(190,17.5);
						$pdf->SetFont('Arial','',9);
						$numpagtot1 = $numpagtot1+1;
						$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
						$fila=$fila+13;
					}
					
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(205,4, utf8_decode("RELACIONADO 4: ".$diagRela4) ,0,L,0);		
					$fila=$pdf->GetY();
					$fila=$fila+1;
					
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(205,4, utf8_decode("OBSERVACIONES: ".$observaRela4) ,0,L,0);		
					$fila=$pdf->GetY();
					$fila=$fila+1;
				}
				
				if($diagRela5!=''){
					
					$filainicio=$fila;
					$texto12=$observaRela5;
					$tamacel1=1;
					$filasFlotantes=12;
					if (empty($texto12)){$lineas=0;}
					else{largoTexto($texto12,$tamacel1);}
					$filasfinal=$filasFlotantes+$filainicio+$lineas; 
					if($filasfinal>255)
					{
						$pdf->AddPage('P', 'Letter');
						$pdf->SetFont('Arial','',8);
						$pdf->SetDrawColor(192);
						$fila=27;
						$col=5;
						$col=220;
						$fila=6;
						$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
						$fila=$pdf->GetY();
						$pdf->SetXY(190,17.5);
						$pdf->SetFont('Arial','',9);
						$numpagtot1 = $numpagtot1+1;
						$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
						$fila=$fila+13;
					}
					
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(205,4, utf8_decode("RELACIONADO 5: ".$diagRela5) ,0,L,0);		
					$fila=$pdf->GetY();
					$fila=$fila+1;
					
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(205,4, utf8_decode("OBSERVACIONES: ".$observaRela5) ,0,L,0);		
					$fila=$pdf->GetY();
					$fila=$fila+1;
				}
				
				if($diagRela6!=''){	
					
					$filainicio=$fila;
					$texto12=$observaRela6;
					$tamacel1=1;
					$filasFlotantes=12;
					if (empty($texto12)){$lineas=0;}
					else{largoTexto($texto12,$tamacel1);}
					$filasfinal=$filasFlotantes+$filainicio+$lineas; 
					if($filasfinal>255)
					{
						$pdf->AddPage('P', 'Letter');
						$pdf->SetFont('Arial','',8);
						$pdf->SetDrawColor(192);
						$fila=27;
						$col=5;
						$col=220;
						$fila=6;
						$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
						$fila=$pdf->GetY();
						$pdf->SetXY(190,17.5);
						$pdf->SetFont('Arial','',9);
						$numpagtot1 = $numpagtot1+1;
						$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
						$fila=$fila+13;
					}
					
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(205,4, utf8_decode("RELACIONADO 6: ".$diagRela6) ,0,L,0);		
					$fila=$pdf->GetY();
					$fila=$fila+1;
					
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(205,4, utf8_decode("OBSERVACIONES: ".$observaRela6) ,0,L,0);		
					$fila=$pdf->GetY();
					$fila=$fila+1;
				}	
			}	
			
			$filainicio=$fila;
			$texto12=$analisis_crn;
			$tamacel1=1;
			$filasFlotantes=4;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			
			$fila=$fila+2;
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4, utf8_decode("ANALISIS: ".$analisis_crn) ,0,L,0);		
			$fila=$pdf->GetY();
			$fila=$fila+2;
			
			
			
			$filainicio=$fila;
			$texto12=$mothito;
			$tamacel1=1;
			$filasFlotantes=20;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("HTA:  ".$hta_crn. "               CATEGORIA TA :  ".$ta_crn. "               COMPENSACION HTA :  ".$compensahta )  ,0,0,'L');
			$fila=$fila+4;
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("DIABETES:  ".$diabetes_crn."             DIABETES CONTROLADA ".$diabetescontrol_crn1)  ,0,0,'L');
			$fila=$fila+4;
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("COMPLICACIONES Y LESIONES EN ORGANISMOS BLANCO CARDIACAS:  ".$complicacioBlanda1 )  ,0,0,'L');
			$fila=$fila+4;
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("INDICE DE FRAMINGHAM:  ".$indiceframin_crn. "%               CLASIFICACION :  ".$claframingra_crn )  ,0,0,'L');
			$fila=$fila+6;
	//FIN AYUDAS 	
			
			
			
	//coco		
			
			if($epoc_crn=='S')$epoc_crn1='Si';
			else $epoc_crn1='No';
			
			if($disnea_crn=='0')$disneatext_crn='Disnea sólo con ejercicio intenso.';
			if($disnea_crn=='1')$disneatext_crn='Disnea al andar rápido o al subir cuestas ligeras.';
			if($disnea_crn=='2')$disneatext_crn='Camina más lento que las personas de su edad o debe parar para recuperar el aliento al andar a su paso en llano.';
			if($disnea_crn=='3')$disneatext_crn='Tiene que parar tras andar 100 metros o después de andar pocos  minutos en llano.';
			if($disnea_crn=='4')$disneatext_crn='No puede salir de su casa o tiene disnea al vestirse.';
			
			if($exacerbaciones_crn=='1')$exacertext='0';
			if($exacerbaciones_crn=='2')$exacertext='1 a 2';
			if($exacerbaciones_crn=='3')$exacertext='> = 3';
			
			
			
	//EPOC
			$filainicio=$fila;
			$texto12=$mothito;
			$tamacel1=1;
			$filasFlotantes=40;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,204,4,F);
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(204,4,utf8_decode("EPOC")  ,1,0,'C');

			$fila=$fila+5;
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("EPOC:  ".$epoc_crn1)  ,0,0,'L');
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("DISNEA:  ".$disneatext_crn )  ,0,0,'L');
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("EXACERBACIONES GRAVES EN EL ULTIMO AÑO:  ".$exacertext )  ,0,0,'L');
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("VALOR FEV1:  ".$valorfev_crn )  ,0,0,'L');
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("EJERCICIO:  ".$ejercicio_crn )  ,0,0,'L');
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("INDICE BODEX:  ".$ibodex_crn."                CLASIFICACION:  ".$clasibodex_crn)  ,0,0,'L');
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode("INDICE BODE:  ".$ibode_crn."                CLASIFICACION:  ".$clasibode_crn)  ,0,0,'L');
			$fila=$fila+6;
		
//FIN EPOC

//TRATAMIENTO
	
			$conTratamiento=Mysql_query("SELECT endocrino, fechaendocri, minterna, fechainterna, cardiologia, fechacardio, oftamologia, fechaoftamolo, nefrologia, fechanefro, psicologia, fechapsicolo, nutricion, fechanutri, trabajosocial, fechatrabajo, familiar, famifecha, odontologia, fechaodon, observaciones, factorecomenda, fechacontrol, recomendaciones FROM cr_tratamiento WHERE numhisto='$numhistohc'");
			while($cdtrata201=mysql_fetch_array($conTratamiento))		
			{	
				$endocrino=$cdtrata201['endocrino'];
				$fechaendocri=$cdtrata201['fechaendocri'];
				$minterna=$cdtrata201['minterna'];
				$fechainterna=$cdtrata201['fechainterna'];
				$cardiologia=$cdtrata201['cardiologia'];
				$fechacardio=$cdtrata201['fechacardio'];
				$oftamologia=$cdtrata201['oftamologia'];
				$fechaoftamolo=$cdtrata201['fechaoftamolo'];
				$nefrologia=$cdtrata201['nefrologia'];
				$fechanefro=$cdtrata201['fechanefro'];
				$psicologia=$cdtrata201['psicologia'];
				$fechapsicolo=$cdtrata201['fechapsicolo'];
				$nutricion=$cdtrata201['nutricion'];
				$fechanutri=$cdtrata201['fechanutri'];
				$trabajosocial=$cdtrata201['trabajosocial'];
				$fechatrabajo=$cdtrata201['fechatrabajo'];
				$familiar=$cdtrata201['familiar'];
				$famifecha=$cdtrata201['famifecha'];
				$odontologia=$cdtrata201['odontologia'];
				$fechaodon=$cdtrata201['fechaodon'];
				$observacionestra=$cdtrata201['observaciones'];
				$factorecomenda=$cdtrata201['factorecomenda'];
				$fechacontrol=$cdtrata201['fechacontrol'];
				$recomendaciones=$cdtrata201['recomendaciones'];
			}
			
			$filainicio=$fila;
			$texto12=$mothito;
			$tamacel1=1;
			$filasFlotantes=50;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,204,4,F);
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(204,4,utf8_decode("TRATAMIENTO")  ,1,0,'C');

			$fila=$fila+5;
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("VALORACIONES POR PROFESIONALES DE SALUD") ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$fila=$fila+4;
			
			if($endocrino=='S'){ 
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("ENDOCRINOLOGIA, Fecha de ultima consulta ".$fechaendocri  )  ,0,0,'L');
				$fila=$fila+4;
			}
			
			if($minterna=='S'){ 
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("MEDINA INTERNA, Fecha de ultima consulta ".$fechainterna  )  ,0,0,'L');
				$fila=$fila+4;
			}	

			if($cardiologia=='S'){
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("CARDIOLOGIA, Fecha de ultima consulta ".$fechacardio  )  ,0,0,'L');
				$fila=$fila+4;
			}

			if($oftamologia=='S'){
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("OFTAMOLOGIA, Fecha de ultima consulta ".$fechaoftamolo  )  ,0,0,'L');
				$fila=$fila+4;
			}

			if($nefrologia=='S'){
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("NEFROLOGIA, Fecha de ultima consulta ".$fechanefro )  ,0,0,'L');
				$fila=$fila+4;
			}

			if($psicologia=='S'){	
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("PSICOLOGIA, Fecha de ultima consulta ".$fechapsicolo )  ,0,0,'L');
				$fila=$fila+4;
			}

			if($nutricion=='S'){
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("NUTRICIONAL, Fecha de ultima consulta ".$fechanutri )  ,0,0,'L');
				$fila=$fila+4;
			}	
				
			if($trabajosocial=='S'){
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("TRABAJO SOCIAL, Fecha de ultima consulta ".$fechatrabajo )  ,0,0,'L');
				$fila=$fila+4;
			}	
			
			if($familiar=='S'){
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("MEDICINA FAMILIAR, Fecha de ultima consulta ".$famifecha )  ,0,0,'L');
				$fila=$fila+4;
			}	
			
			if($odontologia=='S'){
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(60,4,utf8_decode("ODONTOLOGIA, Fecha de ultima consulta ".$fechaodon )  ,0,0,'L');
				$fila=$fila+4;
			}
			
			$filainicio=$fila;
			$texto12=$mothito;
			$tamacel1=1;
			$filasFlotantes=4;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}

			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4, utf8_decode("OBSERVACIONES: ".$observacionestra) ,0,L,0);		
			$fila=$pdf->GetY();
			$fila=$fila+2;
			
			$filainicio=$fila;
			$texto12="ABC";
			$tamacel1=1;
			$filasFlotantes=30;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			
			
		/*		
			$conciediaz=Mysql_query("SELECT codigofactor FROM cr_fprotectores WHERE numhisto='$numhistohc'");
			while($ciefil01=mysql_fetch_array($conciediaz))		
			{	
				$codigofactor=$ciefil01['codigofactor'];
				if($codigofactor==1){
					$pdf->SetFont('Arial','',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(60,4,utf8_decode(" Control periódico de peso")  ,1,0,'L');
					$fila=$fila+4;
				}
				if($codigofactor==2){
					$pdf->SetFont('Arial','',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(60,4,utf8_decode(" Estrategia 5 frutas y verduras al día")  ,1,0,'L');
					$fila=$fila+4;
				}
				if($codigofactor==3){
					$pdf->SetFont('Arial','',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(60,4,utf8_decode(" Dieta baja en grasa")  ,1,0,'L');
					$fila=$fila+4;
				}
				if($codigofactor==4){
					$pdf->SetFont('Arial','',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(60,4,utf8_decode(" Manejo del estrés y la ansiedad")  ,1,0,'L');
					$fila=$fila+4;
				}
				if($codigofactor==5){
					$pdf->SetFont('Arial','',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(60,4,utf8_decode(" Higuiene Oral")  ,1,0,'L');
					$fila=$fila+4;
				}
				if($codigofactor==6){
					$pdf->SetFont('Arial','',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(60,4,utf8_decode(" Actividad fisica")  ,1,0,'L');
					$fila=$fila+4;
				}
				if($codigofactor==7){
					$pdf->SetFont('Arial','',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(60,4,utf8_decode(" Dieta baja en sal")  ,1,0,'L');
					$fila=$fila+4;
				}
				if($codigofactor==8){
					$pdf->SetFont('Arial','',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(60,4,utf8_decode(" No consumo de alcohol")  ,1,0,'L');
					$fila=$fila+4;
				}
				if($codigofactor==9){
					$pdf->SetFont('Arial','',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(60,4,utf8_decode(" No consumo de tabaco")  ,1,0,'L');
					$fila=$fila+4;
				}
				if($codigofactor==10){
					$pdf->SetFont('Arial','',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(60,4,utf8_decode(" Dieta baja en azucar")  ,1,0,'L');
					$fila=$fila+4;
				}
				if($codigofactor==11){
					$pdf->SetFont('Arial','',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(60,4,utf8_decode(" Cumplir con las citas programadas")  ,1,0,'L');
					$fila=$fila+4;
				}
				if($codigofactor==12){
					$pdf->SetFont('Arial','',8);
					$pdf->SetXY(5,$fila);
					$pdf->Cell(60,4,utf8_decode(" Tomar sus medicamentos")  ,1,0,'L');
					$fila=$fila+4;
				}
			}
		*/	
			
			
			$fppeso='';
			$fpfruta='';
			$fpgrasa='';
			$fpestres='';
			$fphiegiene='';
			$fpactividad='';
			$fpsal='';
			$fpalcohol='';
			$fptabaco='';
			$fpazucar='';
			$fpcitas='';
			$fpmedicamentos='';
			
			$conciediaz=Mysql_query("SELECT codigofactor FROM cr_fprotectores WHERE numhisto='$numhistohc'");
			while($ciefil01=mysql_fetch_array($conciediaz))		
			{	
				$codigofactor=$ciefil01['codigofactor'];
				if($codigofactor==1)$fppeso='X'; 
				if($codigofactor==2)$fpfruta='X';
				if($codigofactor==3)$fpgrasa='X'; 
				if($codigofactor==4)$fpestres='X'; 
				if($codigofactor==5)$fphiegiene='X'; 
				if($codigofactor==6)$fpactividad='X'; 
				if($codigofactor==7)$fpsal='X';
				if($codigofactor==8)$fpalcohol='X'; 
				if($codigofactor==9)$fptabaco='X'; 
				if($codigofactor==10)$fpazucar='X'; 
				if($codigofactor==11)$fpcitas='X'; 
				if($codigofactor==12)$fpmedicamentos='X'; 
			}
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(204,4,utf8_decode("PROMOCION DE FACTORES PROTECTORES")  ,1,0,'C');

			$fila=$fila+4;
				
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Estrategia 5 frutas y verduras al día")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($fpfruta)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Dieta baja en grasa ")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($fpgrasa)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Manejo del estrés y la ansiedad"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($fpestres)  ,1,0,'L');
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Control periódico de peso")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($fppeso)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Higuiene Oral")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($fphiegiene)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Actividad física"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($fpactividad)  ,1,0,'L');


			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Dieta baja en sal")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($fpsal)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" No consumo de alcohol")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($fpalcohol)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" No consumo de tabaco"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($fptabaco)  ,1,0,'L');

			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,4,utf8_decode(" Dieta baja en azucar")  ,1,0,'L');
			$pdf->SetXY(65,$fila);
			$pdf->Cell(8,4,utf8_decode($fpazucar)  ,1,0,'L');
			
			$pdf->SetXY(73,$fila);
			$pdf->Cell(60,4,utf8_decode(" Cumplir con las citas programadas")  ,1,0,'L');
			$pdf->SetXY(133,$fila);
			$pdf->Cell(8,4,utf8_decode($fpcitas)  ,1,0,'L');
			
			$pdf->SetXY(141,$fila);
			$pdf->Cell(60,4,utf8_decode(" Tomar sus medicamentos"),1,0,'L');
			$pdf->SetXY(201,$fila);
			$pdf->Cell(8,4,utf8_decode($fpmedicamentos)  ,1,0,'L');

			$fila=$fila+5;
			
			
			$filainicio=$fila;
			$texto12=$factorecomenda;
			$tamacel1=1;
			$filasFlotantes=4;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4, utf8_decode("OTRAS OBSERVACIONES: ".$factorecomenda) ,0,L,0);		
			$fila=$pdf->GetY();
			$fila=$fila+1;
			
			
			$filainicio=$fila;
			$texto12=$fechacontrol;
			$tamacel1=1;
			$filasFlotantes=10;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			$fila=$fila+2;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4,utf8_decode("PROXIMO CONTROL") ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$fila=$fila+4;
			
			
			
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4, utf8_decode("PROXIMO CONTROL: ".$fechacontrol) ,0,L,0);		
			$fila=$pdf->GetY();
			$fila=$fila+1;
			
			
			$filainicio=$fila;
			$texto12=$recomendaciones;
			$tamacel1=1;
			$filasFlotantes=4;
			if (empty($texto12)){$lineas=0;}
			else{largoTexto($texto12,$tamacel1);}
			$filasfinal=$filasFlotantes+$filainicio+$lineas; 
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.JPG',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(190,17.5);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}
			
			
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4, utf8_decode("RECOMENDACIONES GENERALES: ".$recomendaciones) ,0,L,0);		
			$fila=$pdf->GetY();
			$fila=$fila+1;
			$fila=$fila+6;
			$tamacel1=1;
			$filainicio=$fila;
			$filasFlotantes=40;
			$filasfinal=$filasFlotantes+$filainicio;
			if($filasfinal>255)
			{
				$pdf->AddPage('P', 'Letter');
				$pdf->SetFont('Arial','',8);
				$pdf->SetDrawColor(192);
				$fila=27;
				$col=5;
				$col=220;
				$fila=6;
				$pdf->Image('img\encabezadonew.jpg',3,$fila,210,0,'','');
				$fila=$pdf->GetY();
				$pdf->SetXY(194,24.4);
				$pdf->SetFont('Arial','',9);
				$numpagtot1 = $numpagtot1+1;
				$pdf->Cell(128,4,$numpagtot1.'           4',0,0,'L');
				$fila=$fila+13;
			}

			$firma="../firmas/".$codimedico.".jpg";
			if(file_exists($firma))
			{
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
			
			
			
			
///---------------------------------------------------------------------------------------------------------hasta aqui nueva historia
		}	
		
		
		else{
		
			$bacud=mysql_query("select * from acompanante where numc_aco='$numhistohc'");
			while($racud=mysql_fetch_array($bacud))
			{
				$nomacu=$racud['noma_aco'];
				$diracu=$racud['dire_aco'];
				$telacu=$racud['tele_aco'];
				$paracu=$racud['pare_aco'];
			}
			
			$busconsu=mysql_query("select * from consultaprincipal where numc_cpl='$numhistohc'");
			while($rconsu=mysql_fetch_array($busconsu))
			{
				$motconsu=$rconsu['motc_cpl'];
				$enferact=$rconsu['enac_cpl'];
				$antefam=$rconsu['antefam_cpl'];
				$anteper=$rconsu['anteper_cpl'];
				$revisis=$rconsu['resi_cpl'];	
				$contrare=$rconsu['core_cpl'];
				$feca_cpl=$rconsu['feca_cpl'];
				$hora_cpl=$rconsu['hora_cpl'];
				$cod1cpl=$rconsu['cod1_cpl'];
			}
			
			$busehis=mysql_query("SELECT * FROM `encabesadohistoria` where `numc_ehi`='$numhistohc'");
			while($rhis=mysql_fetch_array($busehis))
			{
				$disca=$rhis['disca_crn'];
				if($disca==1)$discap='SI';else $discap='NO';
				$dezpl=$rhis['dezpl_crn'];
				if($dezpl==1)$dezpla='SI';else $dezpla='NO';
			}
					
			$busant=MYSQL_QUERY("SELECT * FROM anteced_cronicos WHERE numhisto='$numhistohc'");
			while($rantc=mysql_fetch_array($busant))
			{
				$codi_des=$rantc['codi_des'];
				$tpan_crn=$rantc['tpan_crn'];
				if($tpan_crn=='AP')
				{    
					$sqldes=mysql_query("SELECT * FROM destipos WHERE codi_des='$codi_des'");
					while($ranom=mysql_fetch_array($sqldes))
					{
						$nomant=$ranom[nomb_des];
					}
				}
			}
					
			$busgin=mysql_query("SELECT * FROM `antgine_cronicos` WHERE numhisto='$numhistohc'");
			while($rgin=mysql_fetch_array($busgin))
			{
				$fech_crn=$rgin['fech_crn']; 
				$meno_crn=$rgin['meno_crn'];
				$mequcrm=$rgin['mequcrm'];
				$gest_crn=$rgin['gest_crn'];
				$part_crn=$rgin['part_crn']; 
				$abor_crn=$rgin['abor_crn']; 
				$cesa_crn=$rgin['cesa_crn'];
				$plan_crn=$rgin['plan_crn'];
				$metpl_crn=$rgin['metpl_crn']; 
				$tplan_crn=$rgin['tplan_crn'];
				$fcito_crn=$rgin['fcito_crn']; 
				$rcito_crn=$rgin['rcito_crn'];
				$alerg_crn=$rgin['alerg_crn'];
			}
			
	///////////// FACTORES DE RIESGO
			
			$busfari=mysql_query("SELECT * FROM `friesg_cronicos` WHERE  numhisto='$numhistohc'");
			while($riesg=mysql_fetch_array($busfari))
			{
				$cgras_crn=$riesg['cgras_crn'];
				if($cgras_crn=='S')$cgras_crn='SI';else $cgras_crn='NO';
				$cosal_crn=$riesg['cosal_crn'];
				if($cosal_crn=='S')$cosal_crn='SI';else $cosal_crn='NO';
				$cfrut_crn=$riesg['cfrut_crn'];
				if($cfrut_crn=='S')$cfrut_crn='SI';else $cfrut_crn='NO';
				$cpsic_crn=$riesg['cpsic_crn'];
				if($cpsic_crn=='S')$cpsic_crn='SI';else $cpsic_crn='NO';
				$icsm_crn=$riesg['icsm_crn'];
				$efec_crn=$riesg['efec_crn'];
				if($efec_crn=='S')$efec_crn='SI';else $efec_crn='NO';
				$frec_crn=$riesg['frec_crn']; 
				$nume_crn=$riesg['nume_crn']; 
				$exhu_crn=$riesg['exhu_crn']; 
				if($exhu_crn=='S')$exhu_crn='SI';else $exhu_crn='NO';
				$anhu_crn=$riesg['anhu_crn']; 
				$obri_crn=$riesg['obri_crn'];
				$compliorbla1=$riesg['complicar_crn'];
				$compliorbla2=$riesg['complicer_crn'];
				$compliorbla3=$riesg['compliret_crn'];
				$compliorbla4=$riesg['complivas_crn'];
				$compliorbla5=$riesg['compliren_crn'];
				$compliorbla6=$riesg['complinin_crn'];
				
				
			}
			
	///////////// ACTIVIDAD FISICA
			
			$busactfi=mysql_query("SELECT * FROM `cr_actividadf` WHERE  numhisto='$numhistohc'");
			while($rwact=mysql_fetch_array($busactfi))
			{
				$camin_crn=$rwact['camin_crn'];
				$nadar_crn=$rwact['nadar_crn'];
				$bailar_crn=$rwact['bailar_crn'];
				$bici_crn=$rwact['bici_crn'];
				$frecu_crn=$rwact['frecu_crn'];
				$durac_crn=$rwact['durac_crn'];
				if(!empty($camin_crn))
				{
					$sqldt=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$camin_crn'");
					$rwact=mysql_fetch_array($sqldt);
					$camina=$rwact[nomb_des];
				} 
				if(!empty($nadar_crn))
				{
					$sqldt=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$nadar_crn'");
					$rwact=mysql_fetch_array($sqldt);
					$nadar=$rwact[nomb_des];
				}
				if(!empty($bailar_crn))
				{
					$sqldt=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$bailar_crn'");
					$rwact=mysql_fetch_array($sqldt);
					$bailar=$rwact[nomb_des];
				} 
				if(!empty($bici_crn))
				{
					$sqldt=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$bici_crn'");
					$rwact=mysql_fetch_array($sqldt);
					$bici=$rwact[nomb_des];
				}    
			}
					///signos vitales
					$busig=mysql_query("SELECT * FROM `cr_signos` WHERE  numhisto='$numhistohc'");
					while($rwsig=mysql_fetch_array($busig))
			{
				$spiel_crn=$rwsig['spiel_crn'];
				if($spiel_crn=='S')$spiel_crn='SI';else $spiel_crn='NO';
				$sreps_crn=$rwsig['sreps_crn'];
				if($sreps_crn=='S')$sreps_crn='SI';else $sreps_crn='NO';
				$fcard_crn=$rwsig['fcard_crn']; 
				$fresp_crn=$rwsig['fresp_crn']; 
				$temp_crn=$rwsig['temp_crn']; 
				$tarts1_crn=$rwsig['tarts1_crn']; 
				$tarts2_crn=$rwsig['tarts2_crn']; 
				$tarta1_crn=$rwsig['tarta1_crn']; 
				$tarta2_crn=$rwsig['tarta2_crn']; 
				$tartp1_crn=$rwsig['tartp1_crn']; 
				$tartp2_crn=$rwsig['tartp2_crn']; 
				$peso_crn=$rwsig['peso_crn']; 
				$talla_crn=$rwsig['talla_crn'];
				$inm=$rwsig['imas_crn'];
				$imco_crn=$rwsig['imco_crn']; 
				$perh_crn=$rwsig['perh_crn']; 
				$perm_crn=$rwsig['perm_crn'];
			}
					///diagnosticos
			$bdiag=mysql_query("SELECT * FROM cr_diagnos WHERE numhisto='$numhistohc'");
			while($rd2=mysql_fetch_array($bdiag))
			{
					  
				$hipdx_crn=$rd2['hipdx_crn']; 
				$clshi_crn=$rd2['clshi_crn'];
				$norhi_crn=$rd2['norhi_crn'];
				$dxdb_crn=$rd2['dxdb_crn'];
				$tipdb_crn=$rd2['tipdb_crn'];
				$nordb_crn=$rd2['nordb_crn'];
				$dxob_crn=$rd2['dxob_crn'];
				$mtob_crn=$rd2['mtob_crn']; 
				$dxhpl_crn=$rd2['dxhpl_crn'];
				$mthlp_crn=$rd2['mthlp_crn'];
			}
					
			$botto=mysql_query("SELECT * FROM cr_tratmto WHERE numhisto='$numhistohc'");
			while($rtto=mysql_fetch_array($botto))
			{
				$aspg=$rtto['aspg_crn']; 
				$sigst=$rtto['sigst_crn'];
				$proxi=$rtto['fecpx_crn'];
				$obserfinales=$rtto['obse_crn'];
			}    
						
			$fila=300;
			$pag=titulo($pdf,$fila,$vec,$pag,5,1);
					$pdf->Image('img\PIE1.JPG',2,264,210,0,'','');
			$fila=$fila+40;	
					$h=2;		
			$fila=$pdf->GetY();
			$fila=$fila+$h+4;
			$cons=mysql_query("SELECT usuario.CODI_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.DIRE_USU, usuario.TRES_USU, usuario.TPAF_USU, contrato.CODI_CON, contrato.NEPS_CON
			FROM usuario
			INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO
			INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
			WHERE ((usuario.CODI_USU)='$cod_usu') AND ucontrato.ESTA_UCO='AC'");
			//echo $cons;
			while($rowcons = mysql_fetch_array($cons))
			{
				$cedula=$rowcons[NROD_USU];
				$nom1usu=$rowcons['PNOM_USU'];   
				$nom2usu=$rowcons['SNOM_USU'];   
				$ape1usu=$rowcons['PAPE_USU'];   
				$ape2usu=$rowcons['SAPE_USU']; 
				$nombre=$nom1usu.' '.$nom2usu.' '.$ape1usu.' '. $ape2usu;
				$sexo=$rowcons['SEXO_USU']; 
				$eda=calculaedad($rowcons['FNAC_USU']); 
				$tipo=$rowcons['TPAF_USU'];
				$direccion=$rowcons['DIRE_USU'];
				$telefono=$rowcons['TRES_USU'];		
				$codcontrato=$rowcons['CODI_CON'];		
				$contrato=$rowcons['NEPS_CON'];			
			}
			
			$pdf->SetFont('Arial','',5);
			
			$pdf->SetXY(10,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(25,4,'CEDULA:  '.$cedula,0,0,L);	
			$pdf->SetXY(70,$fila);	
			$pdf->Cell(25,4,'FECHA/HORA: '.$feca_cpl.' '.$hora_cpl,0,0,L);	
			$pdf->SetXY(150,$fila);	
			$pdf->Cell(45,4,'HISTORIA CLINICA:  '.$numhistohc,0,0,L);	
				
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(12,4,'Nombre: '.$nombre,0,0,L);
			$pdf->SetXY(55,$fila);
			$pdf->Cell(13,4,'EPS: '.$contrato,0,0,L);
			$pdf->SetXY(95,$fila);
			$pdf->Cell(12,4,'Direccion: '.$direccion,0);
			$pdf->SetXY(155,$fila);
			$pdf->Cell(17,4,'Telefono: '.$telefono,0,0,L);
			$pdf->SetXY(185,$fila);
			$pdf->Cell(17,4,'Edad: '.$eda,0,0,L);
					
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(12,4,'Estado Civil: ',0,0,L);
			$pdf->SetXY(55,$fila);
			$pdf->Cell(13,4,'Raza: ',0,0,L);
			$pdf->SetXY(95,$fila);
			$pdf->Cell(12,4,'Ocupacion: ',0);
			$pdf->SetXY(155,$fila);
			$pdf->Cell(17,4,'Escolaridad: ',0,0,L);
			$pdf->SetXY(185,$fila);
			$pdf->Cell(17,4,'Genero: '.$sexo,0,0,L);
					
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(12,4,'DISCAPACIDAD: '.$discap,0,0,L);
			$pdf->SetXY(55,$fila);
			$pdf->Cell(13,4,'DESPLAZADO: '.$dezpla,0,0,L);

					
			$fila=$fila+$h+4;
			$pdf->SetXY(103,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->Cell(20,4,'ACUDIENTE O ACOMPANANTE ',0,0,L);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(12,4,'Nombre: '.$nomacu,0,0,L);
					$pdf->SetXY(55,$fila);
			$pdf->Cell(13,4,'Parentesco: '.$paracu,0,0,L);
			$pdf->SetXY(95,$fila);
			$pdf->Cell(12,4,'Telefono: '.$telacu,0);
					
			$fila=$fila+$h+4;
			$pdf->SetXY(103,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->Cell(20,4,'CONSULTA ',0,0,L);
			$fila=$fila+6;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(20,4,'Motivo de consulta:',0,0,L);	
			$pdf->SetXY(25,$fila);
			$pdf->MultiCell(180,4,$motconsu,0,L,0	);
			$fila=$pdf->GetY();

			$fila=$fila+$h;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(20,4,'Enfermedad actual:',0,0,L);	
			$pdf->SetXY(25,$fila);
			$pdf->MultiCell(180,4,$enferact,0,L,0);	
			$fila=$pdf->GetY();

			$comfila=240;
			if($fila>$comfila)
			{
				$pag=titulo($pdf,$fila,$vec,$pag,5,1);
				$fila=$pdf->GetY();
				$fila=$fila+$h+4;
			}	
			
			$fila=$pdf->GetY();
			$fila=$fila+2;
			$pdf->SetXY(100,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->Cell(20,4,'ANTECEDENTES',0,0,L);
			
			if($fila>$comfila)
			{
				$pag=titulo($pdf,$fila,$vec,$pag,5,1);
				$fila=$pdf->GetY();
				$fila=$fila+$h+4;
			}	
			
			$fila=$fila+4;
			$fila=$fila+$h;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(20,4,'Personales:',0,0,L);	
			$busantp=mysql_query("SELECT * FROM `anteced_cronicos` WHERE numhisto='$numhistohc' AND tpan_crn='AP'");
			while($rantc=mysql_fetch_array($busantp))
			{
				$obse_crn=$rantc['obse_crn'];
				$codi_des=$rantc['codi_des'];
				$sqldes=mysql_query("SELECT * FROM destipos WHERE codi_des='$codi_des'");
				while($ranom=mysql_fetch_array($sqldes))
				{
					$nomant=$ranom[nomb_des];
					$codant=$ranom[valo_des];
					$pdf->SetXY(20,$fila);
					$pdf->MultiCell(180,4,$nomant,0,L,0);	
					$fila=$fila+2;
				}
			}
				  
			$fila=$fila+$h;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(20,4,'A.G.O',0,0,L);
			$pdf->SetXY(20,$fila);
			$pdf->Cell(12,4,'Menarquia: '.$mequcrm,0,0,L);
			$pdf->SetXY(55,$fila);
			$pdf->Cell(13,4,'FUM: '.$fech_crn,0,0,L);
			$pdf->SetXY(75,$fila);
			$pdf->Cell(12,4,'Menopausia: '.$meno_crn,0);
			$pdf->SetXY(95,$fila);
			$pdf->Cell(17,4,'Planificacion: '.$plan_crn,0,0,L);
			$pdf->SetXY(115,$fila);
			$pdf->Cell(17,4,'Metodo: '.$metpl_crn,0,0,L);
			$pdf->SetXY(165,$fila);
			$pdf->Cell(17,4,'Tiempo: '.$tplan_crn,0,0,L);
					
			$fila=$fila+4;
			$pdf->SetXY(20,$fila);
			$pdf->Cell(12,4,'Gestas: '.$gest_crn,0,0,L);
			$pdf->SetXY(30,$fila);
			$pdf->Cell(13,4,'Partos: '.$part_crn,0,0,L);
			$pdf->SetXY(40,$fila);
			$pdf->Cell(12,4,'Cesareas: '.$cesa_crn,0,0,L);
			$pdf->SetXY(55,$fila);
			$pdf->Cell(17,4,'Abortos: '.$abor_crn,0,0,L);
			$pdf->SetXY(75,$fila);
			$pdf->Cell(17,4,'Fecha Citologia: '.$fcito_crn,0,0,L);
					$pdf->SetXY(100,$fila);
			$pdf->Cell(17,4,'Resultado: '.$rcito_crn,0,0,L);

			$fila=$pdf->GetY();	
			$fila=$fila+4;
			$fila=$fila+$h;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(20,4,'Familiares:',0,0,L);
			
			if($fila>$comfila)
			{
				$pag=titulo($pdf,$fila,$vec,$pag,5,1);
				$fila=$pdf->GetY();
				$fila=$fila+$h+4;
			}	
			
			$busantf=mysql_query("SELECT * FROM `anteced_cronicos` WHERE numhisto='$numhistohc' AND tpan_crn='AF'");
			while($rantf=mysql_fetch_array($busantf))
			{
				$codi_des=$rantf['codi_des'];
				$sqldes=mysql_query("SELECT * FROM destipos WHERE codi_des='$codi_des'");
				while($ranom=mysql_fetch_array($sqldes))
				{
					$nomantf=$ranom[nomb_des];
					$codantf=$ranom[valo_des];
					$pdf->SetXY(20,$fila);
					$pdf->MultiCell(180,4,$nomantf,0,L,0);	
					$fila=$fila+2;
				}
							
			}
					
			$pdf->SetXY(35,$fila);
			$pdf->MultiCell(180,4,$antefam,0,L,0);	
			$fila=$pdf->GetY();
			$fila=$fila+$h;
			if($vec[4]=='F')
			{
				$bfem=mysql_query("select * from antefemeninos where numc_afe='$numhistohc'");
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
					
					$pdf->Cell(20,4,'Gineco-obstetricos:',0,0,L);	
					$pdf->SetXY(35,$fila);
					$pdf->MultiCell(180,4,$ante,0,L,0);	
					$fila=$pdf->GetY();
					$pdf->SetXY(35,$fila);
					$pdf->Cell(30,4,'FUM: '.$fech_crn,0,0,L);
					$pdf->Cell(25,4,'Gestas: '.$gestas,0,0,L);
					$pdf->Cell(25,4,'Partos: '.$partos,0,0,L);
					$pdf->Cell(25,4,'Cesareas: '.$cesar,0,0,L);
					$pdf->Cell(25,4,'Abortos: '.$abor,0,0,L);
					$pdf->Cell(25,4,'Vivos: '.$vivos,0,0,L);
					$pdf->Cell(25,4,'Mortinatos: '.$morti,0,0,L);
					$fila=$fila+4;
				}
			}
			if($fila>$comfila)
			{
				$pag=titulo($pdf,$fila,$vec,$pag,5,1);
				$fila=$pdf->GetY();
				$fila=$fila+$h+4;
			}	
					
			$fila=$fila+$h;
			$fila=$pdf->GetY();
			$fila=$fila+3;
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(180,4,'Observaciones:'.$obse_crn,0,L,0);	
			$fila=$fila+2;
			$fila=$pdf->GetY();		
			
			if($fila>$comfila)
			{
				$pag=titulo($pdf,$fila,$vec,$pag,5,1);
				$fila=$pdf->GetY();
				$fila=$fila+$h+4;
			}	

			$pdf->SetXY(100,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->Cell(20,4,'Test De Morisky - Green - Livine',0,0,L);
			$fila=$fila+4;
			
			$sqldes=mysql_query("SELECT * FROM destipos WHERE codt_des='91'");
			while($rtesm=mysql_fetch_array($sqldes))
			{
				$codi_des=$rtesm['codi_des'];
				$bustest=mysql_query("SELECT * FROM `anteced_cronicos` WHERE numhisto='$numhistohc' AND tpan_crn='AM' AND codi_des='$codi_des'");
				if(mysql_num_rows($bustest)<>0)
				{
					$nomant=$rtesm[nomb_des];
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(180,4,$nomant.' SI',0,L,0);	
					$fila=$fila+2;
				}
				else
				{
					$nomant=$rtesm[nomb_des];
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(180,4,$nomant.' NO',0,L,0);	
					$fila=$fila+2;
				}
			
			}
			$pdf->SetXY(5,$fila);
			$fila=$fila+$h;
			$pdf->Cell(20,4,'Otros Cuales: '.$alerg_crn,0,0,L);
			$fila=$fila+$h;
			$fila=$pdf->GetY();
			
			if($fila>$comfila)
			{
				$pag=titulo($pdf,$fila,$vec,$pag,5,1);
				$fila=$pdf->GetY();
				$fila=$fila+$h+4;
			}	
			
			$fila=$fila+4;
			$pdf->SetXY(100,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->Cell(20,4,'FACTORES DE RIESGO MODIFICABLES',0,0,L);
			$fila=$pdf->GetY();
			$fila=$fila+4;
			
			$pdf->SetXY(100,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,50,6,F);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(20,4,'NUTRICION',0,0,L); 
			$pdf->SetXY(5,$fila);
			$pdf->Cell(175,4,'CONSUMO DE GRASA SATURADA: Fritos, Mantequilla, Tocino, Comidas Rapidas, Visceras, Chicharon, Carnes Fritas, Carnes Gordas( Por Semana) :'.$cgras_crn,0,L,0);	
			$fila=$fila+2;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(87,4,'Agrega Sal Adicional a las Comidas? :'.$cosal_crn,0,L,0);	
			$fila=$fila+2;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(81,4,'Consume Frutas Diariamente? :'.$cfrut_crn,0,L,0);	
			$fila=$pdf->GetY();
			$fila=$fila+4;
			
			if($fila>$comfila)
			{
				$pag=titulo($pdf,$fila,$vec,$pag,5,1);
				$fila=$pdf->GetY();
				$fila=$fila+$h+4;
			}	
			
			$pdf->SetXY(100,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->Cell(20,4,'ACTIVIDAD FISICA',0,0,L);
					$fila=$pdf->GetY();
			$fila=$fila+4;
					$pdf->SetXY(5,$fila);
			$pdf->Cell(12,4,'TIPO DE ACTIVIDAD: '.$camina.' '. $baila.' '.$bici.' '.$nadar.' ',0,0,L);
					$pdf->SetXY(65,$fila);
					$sqlfr=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$frecu_crn'");
					$rwfcr=mysql_fetch_array($sqlfr);
					$frecu=$rwfcr[nomb_des];
			$pdf->Cell(13,4,'FRECUENCIA ACTIVIDAD: '.$frecu,0,0,L);
					$sqldur=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$durac_crn'");
					$rwfdur=mysql_fetch_array($sqldur);
					$durac=$rwfdur[nomb_des];
			$pdf->SetXY(135,$fila);
			$pdf->Cell(12,4,'DURACION ACTIVIDAD: '.$durac,0);
			$fila=$pdf->GetY();
			$fila=$fila+4;
			if($fila>$comfila)
			{
				$pag=titulo($pdf,$fila,$vec,$pag,5,1);
				$fila=$pdf->GetY();
				$fila=$fila+$h+4;
			}	
			
			$pdf->SetXY(100,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->Cell(20,4,'EXPOSICION A TOXICOS',0,0,L);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(12,4,'CONSUME PSICOACTIVOS: '.$cpsic_crn,0,0,L);
			$pdf->SetXY(40,$fila);
			$pdf->Cell(13,4,'HABITOS DE FUMAR',0,0,L);
			$pdf->SetXY(60,$fila);
			$pdf->Cell(12,4,'Edad de Inicio de Consumo: '.$icsm_crn.' Anos',0,0,L);
			$pdf->SetXY(100,$fila);
			$pdf->Cell(17,4,'Conoce los efectos nocivos: '.$efec_crn,0,0,L);
			$sqlef=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$frec_crn'");
			$rwef=mysql_fetch_array($sqlef);
			$efec=$rwef[nomb_des];
			$pdf->SetXY(125,$fila);
			$pdf->Cell(17,4,'Frecuencia: '.$efec,0,0,L);
			$sqlnum=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$nume_crn'");
			$rwnum=mysql_fetch_array($sqlnum);
			$numci=$rwnum[nomb_des];
			$pdf->SetXY(160,$fila);
			$pdf->Cell(17,4,'Numero de Cigarrillos/dia: '.$numci,0,0,L);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(12,4,'EXPOSICION A HUMO DE LENA O CARBON: '.$exhu_crn,0,0,L);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(13,4,'No. DE ANOS: '.$anhu_crn ,0,0,L);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(12,4,'OBSERVACIONES: '.$obri_crn,0,0,L);
			$fila=$fila+4;
			
			if($fila>$comfila)
			{
				$pag=titulo($pdf,$fila,$vec,$pag,5,1);
				$fila=$pdf->GetY();
				$fila=$fila+$h+4;
			}	
			
			$pdf->SetXY(100,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->Cell(20,4,'VIOLENCIA INTRAFAMILIAR:',0,0,L);
			$sqlvl=mysql_query("SELECT * FROM destipos WHERE codt_des='86'");
			$fila=$fila+4;
			while($rwvio=mysql_fetch_array($sqlvl))
			{
				$codant=$rwvio[codi_des];
				$nomant=$rwvio[nomb_des];
				$busvio=mysql_query("SELECT * FROM `viole_cronicos` WHERE numhisto='$numhistohc' AND tvio_des='$codant'");
				if(mysql_num_rows($busvio)<>0)
				{
					$nomant=$rwvio[nomb_des];
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(180,4,$nomant.' SI',0,L,0);	
					$fila=$fila+2;
					if($fila>$comfila)
					{
						$pag=titulo($pdf,$fila,$vec,$pag,5,1);
						$fila=$pdf->GetY();
						$fila=$fila+$h+4;
					}	
				}
				else
				{
					$nomant=$rwvio[nomb_des];
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(180,4,$nomant.' NO',0,L,0);	
					$fila=$fila+2;
					if($fila>$comfila)
					{
						$pag=titulo($pdf,$fila,$vec,$pag,5,1);
						$fila=$pdf->GetY();
						$fila=$fila+$h+4;
					}	
				}
			}
			$busvio=mysql_query("SELECT * FROM `viole_cronicos` WHERE numhisto='$numhistohc'");
			
			$fila=$pdf->GetY();
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(12,4,'OBSERVACIONES: ',0,0,L);
			while($rviol=mysql_fetch_array($busvio))
			{        
				$pdf->MultiCell(190,2,$rviol[obs_viol],0,L,0);
			}
			
			if($fila>$comfila)
			{
				$pag=titulo($pdf,$fila,$vec,$pag,5,1);
				$fila=$pdf->GetY();
				$fila=$fila+$h+4;
			}			                    
			
			$fila=$pdf->GetY();
			$fila=$fila+$h+4;
			$fila=$pdf->GetY();
			$pdf->SetXY(100,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->Cell(20,4,'REVISION POR SISTEMAS:',0,0,L);
			$sqlrv=mysql_query("SELECT codi_des, nomb_des FROM destipos WHERE codt_des='87'");
					
			$fila=$fila+4;
			while($rvs=mysql_fetch_array($sqlrv))
			{
				$codant=$rvs[codi_des];
				$nomant=$rvs[nomb_des];
				
				$busrvs=mysql_query("SELECT * FROM `cr_revision` WHERE numhisto='$numhistohc' AND codrevis='$codant'");
				if(mysql_num_rows($busrvs)<>0)
				{
					$nomant=$rvs[nomb_des];
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(180,4,$nomant.' SI',0,L,0);	
					$fila=$fila+2;
					if($fila>$comfila)
					{
						$pag=titulo($pdf,$fila,$vec,$pag,5,1);
						$fila=$pdf->GetY();
						$fila=$fila+$h+4;
					}	
				}
				else
				{
					$nomant=$rvs[nomb_des];
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(180,4,$nomant.' NO',0,L,0);	
					$fila=$fila+2;
					if($fila>$comfila)
					{
						$pag=titulo($pdf,$fila,$vec,$pag,5,1);
						$fila=$pdf->GetY();
						$fila=$fila+$h+4;
					}
				}
			}
			
			$fila=$fila+$h+4;	
			$pdf->SetXY(100,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->Cell(20,4,'SIGNOS VITALES:',0,0,L);
			$fila=$pdf->GetY();
			$fila=$fila+$h+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(12,4,'SISTOMATICO RESPIRATORIO: '.$sreps_crn,0,0,L);
			$pdf->SetXY(50,$fila);
			$pdf->Cell(13,4,'SISTOMATICO DE PIEL: '.$spiel_crn,0,0,L);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(12,4,'F.C: '.$fcard_crn,0,0,L);
			$pdf->SetXY(90,$fila);
			$pdf->Cell(17,4,'F.R: '.$fresp_crn,0,0,L);
			$pdf->SetXY(100,$fila);
			$pdf->Cell(17,4,'T: '.$temp_crn,0,0,L);
			$pdf->SetXY(120,$fila);
			$pdf->Cell(17,4,'T/A Sentado: '.$tarts1_crn.'/'.$tarts2_crn,0,0,L);
			$pdf->SetXY(140,$fila);
			$pdf->Cell(17,4,'T/A Acostado: '.$tarta1_crn.'/'.$tarta2_crn,0,0,L);
			  
			$pdf->SetXY(160,$fila);
			$pdf->Cell(17,4,'T/A Pie: '.$tartp1_crn.'/'.$tartp2_crn,0,0,L);
			$fila=$pdf->GetY();
			$fila=$fila+$h+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(12,4,'Peso: '.$peso_crn,0,0,L);
			$pdf->SetXY(50,$fila);
			$pdf->Cell(13,4,'Talla: '.$talla_crn,0,0,L);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(13,4,'IMC: '.$inm,0,0,L);
			$pdf->SetXY(110,$fila);
			$pdf->Cell(12,4,'ICC: '.$imco_crn,0,0,L);
			$pdf->SetXY(140,$fila);
			$pdf->Cell(17,4,'Perimetro Abdominal: '.'      Hombre < de 90:  '.$perh_crn.'                 Mujeres < de 80:  '.$perm_crn,0,0,L);
			$fila=$pdf->GetY();
			$fila=$fila+$h+4;
			$pdf->SetXY(100,$fila);
			$pdf->SetFillColor($col);	
			
			if($fila>$comfila)
			{
				$pag=titulo($pdf,$fila,$vec,$pag,5,1);
				$fila=$pdf->GetY();
				$fila=$fila+$h+4;
			}
			
			$pdf->rect(5,$fila,205,4,F);
			$pdf->Cell(20,4,'EXAMEN FISICO:',0,0,L);
			$sqlex=mysql_query("SELECT codi_des, nomb_des FROM destipos WHERE codt_des='88'");
			$fila=$fila+4;
			while($rwfis=mysql_fetch_array($sqlex))
			{
				$codant=$rwfis[codi_des];
				$nomant=$rwfis[nomb_des];
				
				$busexfi=mysql_query("SELECT * FROM cr_exfisico WHERE  numhisto='$numhistohc' AND codf_crn='$codant'");
			
				$rexfis=mysql_fetch_array($busexfi);
				$nomant=$rwfis[nomb_des];
				$obsf_crn=$rexfis[obsf_crn];
				if(empty($obsf_crn))
				{
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(180,4,$nomant.'  NORMAL',0,L,0);	
					$fila=$fila+2;
				}
				else
				{
					$pdf->SetXY(5,$fila);
					$pdf->MultiCell(185,4,$nomant.'  '. $obsf_crn ,0,L,0);	
					$fila=$fila+2;
				}
			}
		   
			$fila=$fila+$h+4;
			$pdf->SetXY(100,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->Cell(20,4,'DIAGNOSTICOS:',0,0,L);	
			
			$cadcroimpre6="SELECT cod_cie10, nom_cie10 FROM cie_10 WHERE cod_cie10='$cod1cpl'";
			$resulcroimpre6=Mysql_query($cadcroimpre6);
			$numcroimpre6=Mysql_num_rows($resulcroimpre6);	
			if($numcroimpre6>0)
			{	
				while($rowcroimpre6=mysql_fetch_array($resulcroimpre6))
				{
					$vardescricie=$rowcroimpre6['nom_cie10'];
				}
				$fila=$fila+4;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(12,4,'Diagonostico Principal  '. $cod1cpl.' - '.$vardescricie,0,0,L);
				$fila=$fila+4;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(12,4,'Diagonosticos Relacionados:',0,0,L);
				$dbcroimpre7="SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, cie_10.nom_cie10
				FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10
				WHERE (((diagnosticos2.numc_di2)='$numhistohc'));";
				$resutcroimpre7=Mysql_query($dbcroimpre7);	
				while($rowcroimpre7=mysql_fetch_array($resutcroimpre7))
				{
					$vardescod7=$rowcroimpre7['codc_di2'];
					$vardescricie7=$rowcroimpre7['nom_cie10'];
					$fila=$fila+4;
					$pdf->SetXY(5,$fila);
					$pdf->Cell(12,4,$vardescod7.' - '.$vardescricie7,0,0,L);
				}
				if($fila>$comfila)
				{
					$pag=titulo($pdf,$fila,$vec,$pag,5,1);
					$fila=$pdf->GetY();
					$fila=$fila+$h+4;
				}
			}
			else
			{	
				$sql_diag=mysql_query("SELECT cr_diagnos.numhisto, cr_diagnos.hipdx_crn,clshi_crn,tipdb_crn,mtob_crn,mthlp_crn,dxob_crn FROM cr_diagnos 
				INNER JOIN destipos AS dest ON cr_diagnos.hipdx_crn=dest.valo_des
				WHERE numhisto='$numhistohc' AND dest.codt_des='93' ORDER BY dest.val2_des  ASC");
				while($rowdg=mysql_fetch_array($sql_diag))
				{
					$dxg=$rowdg[hipdx_crn];
					$clshi_crn=$rowdg[clshi_crn];
					$tipdb_crn=$rowdg[tipdb_crn];
					$mtob_crn=$rowdg[mtob_crn];
					$mthlp_crn=$rowdg[mthlp_crn];
					$sql_cie=mysql_query("SELECT cie_10.cod_cie10,cie_10.nom_cie10 FROM cie_10  WHERE cie_10.cod_cie10='$dxg'");
					$rescie=mysql_fetch_array($sql_cie);
					$codv=$rescie['cod_cie10'];
					$nomv=$rescie['nom_cie10'];
					$fila=$fila+4;
					$pdf->SetXY(5,$fila);
					$pdf->Cell(12,4,$codv.' - '.$nomv,0,0,L);
				}
				if($fila>$comfila)
				{
					$pag=titulo($pdf,$fila,$vec,$pag,5,1);
					$fila=$pdf->GetY();
					$fila=$fila+$h+4;
				}
			}
			
			if($fila>$comfila)
			{
				$pag=titulo($pdf,$fila,$vec,$pag,5,1);
				$fila=$pdf->GetY();
				$fila=$fila+$h+4;
			}
			
			$copactext1='';
			if($compliorbla1==1)$copactext1='CARDIACAS ';
			if($compliorbla2==1)$copactext1=$copactext1.' CEREBRALES ';
			if($compliorbla3==1)$copactext1=$copactext1.' RETINIANAS ';
			if($compliorbla4==1)$copactext1=$copactext1.' VASCULAR PERIFERICO ';
			if($compliorbla5==1)$copactext1=$copactext1.' RENALES ';
			if($compliorbla6==1)$copactext1='NINGUNO';
				
			if($copactext1!='')
			{
				$fila=$fila+4;	
				$pdf->SetXY(5,$fila);
				$pdf->Cell(12,4,'COMPLICACIONES Y LESIONES EN ORGANO BLANCO: '.$copactext1,0,0,L);
				if($fila>$comfila)
				{
					$pag=titulo($pdf,$fila,$vec,$pag,5,1);
					$fila=$pdf->GetY();
					$fila=$fila+$h+4;
				}
			}
								
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			if(!empty($hipdx_crn))
			{$pdf->SetXY(5,$fila);$pdf->Cell(12,4,'HIPERTENSION ARTERIAL: '.' Clasificacion  '.$clshi_crn,0,0,L);}
			if(!empty($dxdb_crn))
			{$pdf->SetXY(50,$fila);$pdf->Cell(12,4,'DIABETES MELLITUS : '.' Clasificacion  '.$tipdb_crn,0,0,L);}
			if(!empty($dxob_crn))
			{$pdf->SetXY(88,$fila);$pdf->Cell(12,4,'OBESIDAD : '.'  '.$mtob_crn,0,0,L);}
			if(!empty($dxhpl_crn))
			{$pdf->SetXY(145,$fila);$pdf->Cell(12,4,'HIPERLIPIDEMIA : '.'  '.$mthlp_crn,0,0,L);}
			$fila=$fila+4;
			$pdf->SetXY(90,$fila);$pdf->Cell(12,4,'CLASIFICACION RIESGO CARDIOVASCULAR: '.' Clasificacion  '.$dxob_crn,0,0,L);
			
			if($fila>$comfila)
			{
				$pag=titulo($pdf,$fila,$vec,$pag,5,1);
				$fila=$pdf->GetY();
				$fila=$fila+$h+4;
			}

			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
				   
			$pdf->SetXY(103,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->Cell(20,4,'CONDUCTA ',0,0,L);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(20,4,'Medicamentos ',0,0,L);
			$pdf->SetXY(35,$fila);
			$pdf->MultiCell(170,4,$consomed,0,L,0);
			$fila=$pdf->GetY();
			$fila=$fila+$h;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(20,4,'Ayudas DX ',0,0,L);
			$pdf->SetXY(35,$fila);
			$pdf->MultiCell(170,4,$consoayu,0,L,0);
			$fila=$pdf->GetY();
			$fila=$fila+$h;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(20,4,'Remisiones ',0,0,L);
			$pdf->SetXY(35,$fila);
			$pdf->MultiCell(170,4,$consoref,0,L,0);
			$fila=$fila+$h;
			if($fila>$comfila)
			{
				$pag=titulo($pdf,$fila,$vec,$pag,5,1);
				$fila=$pdf->GetY();
				$fila=$fila+$h+4;
			}
			$fila=$fila+6;
			$pdf->SetXY(90,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->Cell(10,4,'PROMOCION DE FACTORES PROTECTORES ',0,0,L);
					
			$fila=$fila+4;
			$botfpe=mysql_query("SELECT * FROM `cr_factores` WHERE numhisto='$numhistohc'");
			while($rowfp=mysql_fetch_array($botfpe))
			{
				$fila=$fila+4;
				$faprote_crn=$rowfp['facpro_crn'];
				$sql_rem=mysql_query("SELECT nomb_des  FROM destipos WHERE codi_des='$faprote_crn'");
				while($rowdfa=mysql_fetch_array($sql_rem))
				{
				  
					$valo_crn=$rowdfa['nomb_des'];
					$fila=$pdf->GetY();
					$fila=$fila+4;
					$pdf->SetXY(35,$fila+2);
					$pdf->Cell(20,4,$valo_crn,0,0,L);
					if($fila>$comfila)
					{
						$pag=titulo($pdf,$fila,$vec,$pag,5,1);
						$fila=$pdf->GetY();
						$fila=$fila+$h+4;
					}
				}
			}
			$fila=$fila+$h;
			$fila=$fila+4;
			$pdf->SetXY(100,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
					
			$pdf->Cell(10,4,'NO FARMACOLOGICOS ',0,0,L);
			
			$fila=$fila+$h+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(13,4,'Explicacion aspectos generales de la enfermedad: ',0,0,L);
			$pdf->SetXY(50,$fila);
			$pdf->MultiCell(150,4,$aspg,0,L,0);
			
			$fila=$fila+$h+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(13,4,'Informacion signos y sintomas de alarma: ',0,0,L);
			$pdf->SetXY(50,$fila);
			$pdf->MultiCell(150,4,$sigst,0,L,0);
			$fila=$fila+$h+4;
			$pdf->SetXY(5,$fila+2);
			$pdf->Cell(13,4,'OBSERVACIONES FINALES ',0,0,L);
			$pdf->SetXY(50,$fila+2);
			$pdf->MultiCell(150,4,$obserfinales,0,L,0);
			$fila=$pdf->GetY();
			
			if($fila>$comfila)
			{
				$pag=titulo($pdf,$fila,$vec,$pag,5,1);
				$fila=$pdf->GetY();
				$fila=$fila+$h+4;
			}

			$fila=$fila+$h+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(20,4,'Proxima consulta ',0,0,L);
			$pdf->SetXY(50,$fila+2);
			$pdf->MultiCell(150,4,$proxi,0,L,0);
			$fila=$fila+5;
			$firma="../firmas/".$codimedico.".jpg";
			if(file_exists($firma))
			{
				$pdf->Image($firma,30,$fila,40,15,'','');
			}
			$fila=$pdf->GetY();
			$fila=$fila+10;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,'____________________________________',0,0,L);
			$pdf->SetXY(130,$fila);
			$pdf->Cell(10,5,'____________________________________',0,0,L);	
			$fila=$fila+2;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,$nombmedico,0,0,L);
			$pdf->SetXY(130,$fila);
			$pdf->Cell(10,5,$vec[3],0,0,L);	
			$fila=$fila+2;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,'Registro medico: '.$regimedico,0,0,L);
			$pdf->SetXY(130,$fila);
			$pdf->Cell(10,5,'C. C. No.',0,0,L);	
		}

	
	}
	
//----------------------------------------------------------------frin imprimir historia----------------------------------------------------	
//vich

	
	
	
		
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
			$pdf_->Image('img\enca_imageno_cro.JPG',1,$fila_,210,0,'','');
			$pdf_->Image('img\controlado.png',203,100,7,30,'','');
		}
		if($m==2)
		{
			$pdf_->Image('img\enca_laboratorio_cro.JPG',1,$fila_,210,0,'','');
			$pdf_->Image('img\controlado.png',203,100,7,30,'','');
		}		
		if($m==3)
		{
			$pdf_->Image('img\enca_remision_cro.JPG',1,$fila_,210,0,'','');
			$pdf_->Image('img\controlado.png',203,100,7,30,'','');
		}
		if($m==4)
		{
			$pdf_->Image('img\enca_formula_cro.JPG',1,$fila_,210,0,'','');
			$pdf_->Image('img\controlado.png',203,100,7,30,'','');
		}
		if($m==5)
		{
			if($vec_[20]=='04')
			{
				$pdf_->Image('img\enca_histop.JPG',1,$fila_,200,0,'','');
				$pdf_->Image('img\controlado.png',203,130,7,30,'','');
			}
			else
			{
				$pdf_->Image('img\enca_histop.JPG',1,$fila_,200,0,'','');
				$pdf_->Image('img\controlado.png',203,100,7,30,'','');
			}
					return $pag;
			//$pdf_->Image('img\enca_histo.JPG',205,100,7,30,'','');
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
		$origencon=$vec_[21];//sede donde se realiza la consulta
		$pdf_->SetXY(95,$fila_+20);
		$pdf_->Cell(6,5,$tipodoc.':',0);
		$pdf_->SetXY(102,$fila_+20);
		$pdf_->Cell(20,5,$identificacion,0);		
		$pdf_->SetXY(5,$fila_+20);
		$pdf_->Cell(40,5,"Nombre:",0);
		$pdf_->SetXY(20,$fila_+20);
		$pdf_->Cell(40,5,$nombre,0);		
		$pdf_->SetXY(125,$fila_+20);
		$pdf_->Cell(25,5,"Genero:",0);
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
		$pdf_->Cell(40,5,"M. atencion:",0);
		$pdf_->SetXY(112,$fila_+25);
		$pdf_->Cell(40,5,$muniate,0);		
		$pdf_->SetXY(145,$fila_+25);
		$pdf_->Cell(20,5,"M. servicio:",0);
		$pdf_->SetXY(163,$fila_+25);
		$pdf_->Cell(20,5,'Paciente Cronico',0);
		$col=200;
		$pdf_->SetFillColor($col);	
		$pdf_->rect(5,$fila_+32,205,5,F);
		
		$pdf_->SetXY(5,$fila_+32);
		$pdf_->Cell(40,5,"Historia No. ".  $idenevo,0);
		$pdf_->SetXY(80,$fila_+32);
		$pdf_->Cell(40,5,"Servicio: Programa Paciente Cronico",0);
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
				$unidad_=" Ano";
			}
			else
			{
				$unidad_=" Anos";
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
					$unidad_=" Dia";
				}
				else
				{
					$unidad_=" Dias";
				}
			}
		}
		return($edad_.$unidad_);
	}

	function edad($fecha_nac)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en n�meros enteros

        $dia=date("j");
        $mes=date("n");
        $anno=date("Y");

        //descomponer fecha de nacimiento
        $dia_nac=substr($fecha_nac, 8, 2);
        $mes_nac=substr($fecha_nac, 5, 2);
        $anno_nac=substr($fecha_nac, 0, 4);


        if($mes_nac>$mes)
        {
            $calc_edad= $anno-$anno_nac-1;
        }
        else
        {
            if($mes==$mes_nac AND $dia_nac>$dia)
            {
                $calc_edad= $anno-$anno_nac-1;
            }
            else
            {
                $calc_edad= $anno-$anno_nac;
            }
        }
        return $calc_edad;
    }	
    
	function increm($fila,&$pdf,&$cous)
    {
		$fila=$fil+4;
		if($fil>=216)
		{
			$fil=40;
			$pdf->AddPage();

			$pdf->SetXY(15,30);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(40,5,'C.C: '.$cod,0);

			$con_usu=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU,usuario.DIRE_USU, usuario.TRES_USU ,usuario.MRES_USU,usuario.TPAF_USU 
			FROM usuario
			INNER JOIN ucontrato AS ucontrato ON ucontrato.CUSU_UCO=usuario.CODI_USU
			INNER JOIN contrato AS contrato ON contrato.CODI_CON=ucontrato.CONT_UCO
			WHERE usuario.NROD_USU='$cod'");

			$rowu=mysql_fetch_array($con_usu);
			$pdf->SetXY(35,30);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(40,5,'Nombre: '.$rowu['PNOM_USU'].' '.$rowu['SNOM_USU'].' '.$rowu['PAPE_USU'].' '.$rowu['SAPE_USU'],0);
	   
			//$pdf->Image('imagenes\du.JPG',5,10,204,0,'','');
			//$pdf->Image('imagenes\PIE1.JPG',5,254,204,0,'','');
			//$pdf->Image('imagenes\control.jpg',209,233,0,30,0,'','');
		}
		$pdf->SetFont('Arial','',10);
		return ($fil);
	}
	
	function largoTexto($texto12,$tamacel1)
	{
		GLOBAL $lineas;
		if($tamacel1==1)
		{	
			$conta12=strlen($texto12);
			$lineas1=floor($conta12/110.2);
			$lineas1++;
			$lineas=$lineas1*4;
			return $lineas;
		}
		if($tamacel1==2)
		{	
			$conta12=strlen($texto12);
			$lineas=floor($conta12/14);
			$lineas1++;
			$lineas=$lineas1*4;
			return $lineas;
		}
		if($tamacel1==3)
		{	
			$conta12=strlen($texto12);
			$lineas1=floor($conta12/85);
			$lineas1++;
			$lineas=$lineas1*4;
			return $lineas;
		}
		
		if($tamacel1==4)
		{	
			$conta12=strlen($texto12);
			$lineas1=floor($conta12/40);
			$lineas1++;
			$lineas=$lineas1*4;
			return $lineas;
		}
		
	}
    
?>