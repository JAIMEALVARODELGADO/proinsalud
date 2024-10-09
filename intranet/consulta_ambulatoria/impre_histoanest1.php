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
	set_time_limit (120);
	
//	$numhisto='';
//	$numhisto='12991944180507155720';	
//	$his=1;
	
	set_time_limit (120);
	$pdf=new FPDF('P','mm','Letter');
	$pdf->SetFont('Arial','',8);
	
	$pdf->AliasNbPages();
	
	include ('php/conexion1.php');
	$consuanes=mysql_query("SELECT cirupro_cons FROM preanes_conclusion WHERE numero_cons='$numhisto'");
	while($rrowanetr=mysql_fetch_array($consuanes))
	{
		$varbuscod=$rrowanetr['cirupro_cons'];
	}
	
	$veccodigos = explode(",", $varbuscod);
	$salto = chr(13).chr(10);
	for($n=0;$n<5;$n++)
	{
		$codigo=$veccodigos[$n];
		if($codigo != '')
		{
			
			$consuanes1=mysql_query("SELECT codi_cup, descrip FROM cups WHERE codigo='$codigo'");
			while($rrowanetr1=mysql_fetch_array($consuanes1))
			{
				$cirupropus=$cirupropus.$rrowanetr1['codi_cup'].' - '.$rrowanetr1['descrip'].$salto;
			}
		}
		//else $cirupropus=$cirupropus.$dato." no ";
	}
	
	
	$bima=mysql_query("SELECT cups.codigo, cups.codi_cup, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre, detareferencia.dest_dre
	FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
	WHERE (((detareferencia.numc_dre)='$numhisto')) AND ((((cups.grup_cup)='87')) OR (((cups.grup_cup)='88')))");
	if(mysql_num_rows($bima)>0)$numima='SI';
	$i=0;
	$consoayu='';		
	while($rima=mysql_fetch_array($bima))
	{
		$codi=$rima['codi_cup'];
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
	$blab=mysql_query("SELECT cups.codigo, cups.codi_cup, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre, detareferencia.dest_dre
	FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
	WHERE (((detareferencia.numc_dre)='$numhisto')) AND ((cups.grup_cup)='90')");
	if(mysql_num_rows($blab)>0)$numlab='SI';
	$i=0;
	while($rlab=mysql_fetch_array($blab))
	{
		$codi=$rlab['codi_cup'];
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
		$i++;
		$consoayu= $consoayu.' '.$desc.' '.$cant.' || ';
	}
	$fin2=$i;
	$brem=mysql_query("SELECT cups.codigo, cups.codi_cup, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre, detareferencia.dest_dre
	FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
	WHERE (((detareferencia.numc_dre)='$numhisto')) AND ((cups.grup_cup)<>'87') AND ((cups.grup_cup)<>'88') AND ((cups.grup_cup)<>'90')");
	$i=0;
	if(mysql_num_rows($brem)>0)$numrem='SI';
	$consoref='';
	while($rrem=mysql_fetch_array($brem))
	{
		$codi=$rrem['codi_cup'];
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
	WHERE (((detareferencia.numc_dre)='$numhisto'))");	
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
	$bmed=mysql_query("select * from medicamentosenv where numc_men='$numhisto' order by LENGTH(cmed_men),cmed_men");
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
		FROM medicamentos2 LEFT JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa
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
	$busu=mysql_query("SELECT encabesadohistoria.numc_ehi, encabesadohistoria.idus_ehi, encabesadohistoria.unid_ehi, 
	encabesadohistoria.feco_ehi, encabesadohistoria.nomb_ehi, municipio.NOMB_MUN, encabesadohistoria.sexo_ehi, 
	encabesadohistoria.fnac_ehi, areas.nom_areas, areas.cod_areas, consultaprincipal.radx_cpl, consultaprincipal.cod1_cpl, consultaprincipal.tidx_cpl, consultaprincipal.hosa_cpl, encabesadohistoria.cous_ehi, encabesadohistoria.telf_ehi, encabesadohistoria.origconsu_ehi AS oricon,
	consultaprincipal.cod1_cpl, consultaprincipal.inca_cpl, consultaprincipal.feinca_cpl,consultaprincipal.sire_cpl,consultaprincipal.sipi_cpl,
	encabesadohistoria.etni_ehi, encabesadohistoria.nedu_ehi, encabesadohistoria.ocup_ehi, encabesadohistoria.eciv_ehi, encabesadohistoria.dire_ehi, consultaprincipal.coti_cpl
	FROM ((encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) LEFT JOIN municipio ON encabesadohistoria.muat_ehi = municipio.CODI_MUN) INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas
	WHERE (((encabesadohistoria.numc_ehi)='$numhisto'))");
	while($rusu=mysql_fetch_array($busu))
	{
		$vec[0]=$numhisto;
		$vec[1]=$rusu['feco_ehi'];
		$vec[2]=$rusu['nom_areas'];
		$vec[3]=$rusu['nomb_ehi'];
		$vec[4]=$rusu['sexo_ehi'];	
		$vec[6]=$rusu['idus_ehi'];
		
		$und=$rusu['unid_ehi'];
		if($und="Aï¿½os")$und="AÑOS";
		
		$vec[7]=$rusu['fnac_ehi'].' '.$und;
		$vec[8]=$rusu['NOMB_MUN'];	
		$vec[9]=$rusu['radx_cpl'];
		$vec[10]=$rusu['cod1_cpl'];
		$vec[11]=$rusu['tidx_cpl'];
		$vec[12]=$rusu['hosa_cpl'];
		$cous=$rusu['cous_ehi'];
		$bdoc=mysql_query("select TDOC_USU, FNAC_USU, REGI_USU from usuario where CODI_USU='$cous'");
		while($rdoc=mysql_fetch_array($bdoc))
		{
			$vec[13]=$rdoc[TDOC_USU];
			$fnaci=$rdoc['FNAC_USU'];
			$fechacon=$rusu['feco_ehi'];
			$vec[33]=$rdoc['REGI_USU'];
		}
		//$vec[7]=edad_dia_consulta($fnaci, $rusu['feco_ehi']);
		$vec[14]=$rusu['telf_ehi'];
		$vec[20]=$rusu['cod_areas'];
		$vec[22]=$rusu['inca_cpl']; 
		$vec[23]=$rusu['feinca_cpl']; 
		$vec[24]=$rusu['sire_cpl']; 
		$vec[25]=$rusu['sipi_cpl'];
		$vec[30]=$rusu['dire_ehi'];
		$contingencia=$rusu['coti_cpl'];
		$etni=$rusu['etni_ehi'];
		$nedu=$rusu['nedu_ehi'];
		$ocup=$rusu['ocup_ehi'];
		$eciv=$rusu['eciv_ehi'];
		$vec[31]=$etni;
		$bet=mysql_query("select nomb_des from destipos where codi_des='$etni'");
		while($ret=mysql_fetch_array($bet))
		{
			$vec[26]=strtoupper($ret['nomb_des']);
		}
		
		$bne=mysql_query("select nomb_des from destipos where codi_des='$nedu'");
		while($rne=mysql_fetch_array($bne))
		{
			$vec[27]=strtoupper($rne['nomb_des']);
		}
		
		$boc=mysql_query("select descri_ciuo from ciuo where codigo_ciuo='$ocup'");
		while($roc=mysql_fetch_array($boc))
		{
			$vec[28]=strtoupper(substr($roc['descri_ciuo'],0,43));
		}
		
		$bec=mysql_query("select nomb_des from destipos where codi_des='$eciv'");
		while($rec=mysql_fetch_array($bec))
		{
			$vec[29]=strtoupper($rec['nomb_des']);
		}
		$bcon=mysql_query("select nomb_des from destipos where codt_des='13' and valo_des='$contingencia'");
		while($rcon=mysql_fetch_array($bcon))
		{
			$vec[32]=strtoupper($rcon['nomb_des']);
		}
		$origen=$rusu['oricon'];		
		$busori=mysql_query("select * from origen_consulta where codmuni_ori='$origen'");
		while($rori=mysql_fetch_array($busori))
		{
			$nomorigen=$rori['muni_ori'];
		}
		if($nomorigen=='' || $nomorigen==null || $nomorigen=='0')$vec[21]='PASTO';
		else $vec[21]=$nomorigen;
		$fechaconsulta=$rusu['feco_ehi'];
		$identconsulta=$rusu['idus_ehi'];
		$nombreconsult=$rusu['nomb_ehi'];
	}
	$pdiaganesp=mysql_query("SELECT cod_cie10, nom_cie10 FROM cie_10 WHERE cod_cie10='$vec[10]'");
	while($rowdianes=mysql_fetch_array($pdiaganesp))
	{
		$desdiaanes=strtoupper($rowdianes['nom_cie10']);
	}
	
	$bconcit=mysql_query("SELECT contrato.NEPS_CON, encabesadohistoria.numc_ehi
	FROM encabesadohistoria INNER JOIN contrato ON encabesadohistoria.cont_ehi = contrato.CODI_CON
	WHERE (((encabesadohistoria.numc_ehi)='$numhisto'))");
	while($rconcit=mysql_fetch_array($bconcit))
	{
		$vec[5]=strtoupper($rconcit['NEPS_CON']);//$rowusu[neps_con];//$contrato
	}	
	
	$bmed=mysql_query("SELECT consultaprincipal.numc_cpl, medicos.cod_medi, medicos.nom_medi, medicos.reg_medi, medicos.espe_med, medicos.ced_medi
	FROM consultaprincipal INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi
	WHERE (((consultaprincipal.numc_cpl)='$numhisto'))");
	while($rmer=mysql_fetch_array($bmed))
	{
		$codimedico=$rmer['cod_medi'];
		$nombmedico=$rmer['nom_medi'];
		$regimedico=$rmer['reg_medi'];
		$codespecia=$rmer['espe_med'];	
		$cedmedico=$rmer['ced_medi'];			
		$bespe=mysql_query("select nomb_des from destipos where codi_des='$codespecia'");
		$respe=mysql_fetch_array($bespe);
		$especialidad=$respe['nomb_des'];
	}

	if($ima=='1')
	{
		$i=0;
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
			$pdf->MultiCell(10,5,$diag,0,C,0);
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
		$bd1=mysql_query("select * from cie_10 where cod_cie10='$diag1'");
		while($rd1=mysql_fetch_array($bd1))
		{
			$desd1=$rd1['nom_cie10'];
		}		
		$fila=$fila+4;		
		$pdf->SetXY(5,$fila);	
		$pdf->Cell(10,5,'Diagnósticos',0,0,L);	
		$pdf->SetXY(25,$fila);
		$fila=$pdf->GetY();						
		$bdi2=mysql_query("SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, cie_10.nom_cie10
		FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10
		WHERE (((diagnosticos2.numc_di2)='$numhisto'))");
		$t=1;
		while($rd2=mysql_fetch_array($bdi2))
		{				
			$desdies2=$rd2['codc_di2'].' - '.$rd2['nom_cie10'];
			$pdf->SetXY(25,$fila);				
			$pdf->MultiCell(190,4,$desdies2,0,L,0);				
			$fila=$pdf->GetY();
		}			
		$banal=mysql_query("select * from consulta_soap where numc_soap='$numhisto'");
		$ranal=mysql_fetch_array($banal);
		$anal=$ranal['anal_soap'];
		$fila=$fila+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(10,5,'Análisis',0,0,L);
		$pdf->SetXY(25,$fila);
		$pdf->MultiCell(190,4,$anal,0,L,0);
		$fila=$pdf->GetY();
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
	
	if($lab=='1')
	{
		$i=0;
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
			$codi=$mat2[$n][0];
			$diag=$mat2[$n][1];
			$desc=$mat2[$n][2];
			$obse=$mat2[$n][3];
			$cant=$mat2[$n][4];
			$dest=$mat2[$n][5];	
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(10,5,$diag,0,C,0);
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
		$bd1=mysql_query("select * from cie_10 where cod_cie10='$diag1'");
		while($rd1=mysql_fetch_array($bd1))
		{
			$desd1=$rd1['nom_cie10'];
		}		
		$fila=$fila+4;		
		$pdf->SetXY(5,$fila);	
		$pdf->Cell(10,5,'Diagnósticos',0,0,L);	
		$pdf->SetXY(25,$fila);
		$pdf->MultiCell(190,4,$vec[10].' - '.$desd1,0,L,0);
		$fila=$pdf->GetY();						
		$bdi2=mysql_query("SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, cie_10.nom_cie10
		FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10
		WHERE (((diagnosticos2.numc_di2)='$numhisto'))");
		$t=1;
		while($rd2=mysql_fetch_array($bdi2))
		{				
			$desdies2=$rd2['codc_di2'].' - '.$rd2['nom_cie10'];
			$pdf->SetXY(25,$fila);				
			$pdf->MultiCell(190,4,$desdies2,0,L,0);				
			$fila=$pdf->GetY();
		}			
		$banal=mysql_query("select * from consulta_soap where numc_soap='$numhisto'");
		$ranal=mysql_fetch_array($banal);
		$anal=$ranal['anal_soap'];
		$pdf->SetXY(5,$fila);
		$pdf->Cell(10,5,'Análisis',0,0,L);
		$pdf->SetXY(25,$fila);
		$pdf->MultiCell(190,4,$anal,0,L,0);
		$fila=$pdf->GetY();
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
		$fila=$fila+6;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(100,5,'Personal de laboratorio que lo atendió: ',0,0,L);
		$pdf->SetXY(130,$fila);
		$pdf->Cell(45,5,'Hora: ',0,0,L);
		$fila=$fila+5;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(130,5,'Cita asignada para el día: ',0,0,L);
	}
	
	if($rem=='1')
	{		
		$i=0;
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
			$pdf->MultiCell(10,5,$diag,0,C,0);
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
		$bd1=mysql_query("select * from cie_10 where cod_cie10='$diag1'");
		while($rd1=mysql_fetch_array($bd1))
		{
			$desd1=$rd1['nom_cie10'];
		}		
		$fila=$fila+4;		
		$pdf->SetXY(5,$fila);	
		$pdf->Cell(10,5,'Diagnósticos',0,0,L);	
		$pdf->SetXY(25,$fila);
		$pdf->MultiCell(190,4,$vec[10].' - '.$desd1,0,L,0);
		$fila=$pdf->GetY();						
		$bdi2=mysql_query("SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, cie_10.nom_cie10
		FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10
		WHERE (((diagnosticos2.numc_di2)='$numhisto'))");
		$t=1;
		while($rd2=mysql_fetch_array($bdi2))
		{				
			$desdies2=$rd2['codc_di2'].' - '.$rd2['nom_cie10'];
			$pdf->SetXY(25,$fila);				
			$pdf->MultiCell(190,4,$desdies2,0,L,0);				
			$fila=$pdf->GetY();
		}			
		$banal=mysql_query("select * from consulta_soap where numc_soap='$numhisto'");
		$ranal=mysql_fetch_array($banal);
		$anal=$ranal['anal_soap'];
		$pdf->SetXY(5,$fila);
		$pdf->Cell(10,5,'Análisis',0,0,L);
		$pdf->SetXY(25,$fila);
		$pdf->MultiCell(190,4,$anal,0,L,0);
		$fila=$pdf->GetY();
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
	
	
	if($med=='1')
	{
		for($i=0;$i<2;$i++)
		{
			if($i==0 || $fila>115)
			{
				$fila=300;
				$pag=tituloformu($pdf,$fila,$vec,$pag,4,1);
				$pdf->Image('img\piemed2.jpg',3,260,202,16,'','');
				$fila=35;				
			}
			else
			{
				$pag=tituloformu($pdf,$fila,$vec,$pag,4,2);
				$pdf->Image('img\piemed2.jpg',3,122,202,16,'','');
				$fila=$fila+38;
			}
			$a1=96;			//DESCRIPCION
			$a2=26;			// via
			$a3=7;			//C. PRESC NUMEROS
			$a4=26;			//C. PRESC LETRAS
			$a5=43;			//POSOLOGIA
			$pdf->SetFont('Arial','',8);
			$bfor=mysql_query("select * from encabesadoformula where numc_efo='$numhisto'");
			while($rfor=mysql_fetch_array($bfor))
			{
				$proxi=$rfor[coen_efo];
				$obse=$rfor[obfo_efo];
				$repi=$rfor[repi_efo];
				$nuformu=$rfor[nufo_efo];
			}	
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(15,$fila);
			$pdf->SetFont('Arial','',7);
			if($i==0){$fila=$fila+7;}
			else if($fila<130){$fila=$fila+7;}
			else {$fila=$fila+2;}
			$pdf->SetXY(5,$fila);
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell($a1,8,'Medicamentos (Nombre común internacional) / Concentración / Forma Farmacéutica',1,0,C);
			$pdf->Cell($a2,8,'Vía de administracion',1,0,C);			
			$pdf->Cell($a3+$a4,4,'Cantidad',1,0,C);			
			$pdf->Cell($a5,8,'Posología y duración de tratamiento',1,0,C);			
			$fila=$fila+4;
			$pdf->SetXY(5+$a1+$a2,$fila);
			$pdf->Cell($a3,4,'Nos.',1,0,C);	
			$pdf->Cell($a4,4,'Letras',1,0,C);
			$pdf->Image('img\caduca.jpg',204,$fila,8,75,'','');
			$fila=$fila+5;
			for($n=0;$n<$fin4;$n++)
			{
				$pdf->SetFont('Arial','',7);
				$codi='';
				$diag='';
				$desc='';
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
				$pdf->SetFont('Arial','',7);
				$pdf->MultiCell($a1,5,$codi.' - '.$desc,0,L,0);
				$pdf->SetFont('Arial','',7);
				$bajo1=$pdf->GetY();
				if(strlen($codi)>6)
				{
					$codi=substr($codi,5,7);				
				}
				$pdf->SetXY(5+$a1,$fila);
				$pdf->MultiCell($a2,5,$nvia,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				$pdf->SetXY(5+$a1+$a2,$fila);
				$pdf->MultiCell($a3,5,$cant,0,L,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				$pdf->SetXY(5+$a1+$a2+$a3,$fila);
				$canletras=convertir($cant);
				$bajo=$bajo1-$fila;	
				$pdf->MultiCell($a4,5,$canletras,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				$pdf->SetXY(5+$a1+$a2+$a3+$a4,$fila);
				if($frec=='')
				{
					$unifrec=$frec.' '.$unfr;
				}
				else
				{
					$unifrec='Cada '.$frec.' '.$unfr;
				}				
				
				if($tiem!='')
				{
					$tiempotra=' por '.$tiem.' dias';
				}
				
				$posolo=$dosi.' '.$undo.'  '.$unifrec.' '.$tiempotra;
				$pdf->MultiCell($a5,5,$posolo,1,L,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;	
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				$bajo=$bajo1-$fila;	
				$pdf->Rect(5, $fila, $a1, $bajo); 
				$pdf->Rect(5+$a1, $fila, $a2, $bajo); 
				$pdf->Rect(5+$a1+$a2, $fila, $a3, $bajo); 
				$pdf->Rect(5+$a1+$a2+$a3, $fila, $a4, $bajo); 
				$pdf->Rect(5+$a1+$a2+$a3+$a4, $fila, $a5, $bajo);
				$fila=$fila+$bajo;				
				$pdf->SetXY(5,$fila);
				$pdf->SetFillColor(240);
				$pdf->SetFont('Arial','',7);
				$pdf->MultiCell(198,4,'   Observaciones:  '.$obsmed,1,L,1);
				$fila=$pdf->GetY();				
			}
			if($i==1)
			{
				$subfila=$fila;
				$subfila=$subfila+2;
				$pdf->Image('img\parapaciente.jpg',179,$subfila,23,0,'','');
			}
			$fila=$fila+2;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(198,5,'Control en: '.$proxi,1,0,L);
			$fila=$fila+5;
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(198,5,'Recomendaciones: '.$obse,1,L,0);
			$diag1=$vec[10];
			$bd1=mysql_query("select * from cie_10 where cod_cie10='$diag1'");
			while($rd1=mysql_fetch_array($bd1))
			{
				$desd1=$rd1['nom_cie10'];
				$siimpime1=$rd1['imprimible_cie10'];
			}	
			$banal=mysql_query("select * from consulta_soap where numc_soap='$numhisto'");
			$ranal=mysql_fetch_array($banal);
			$anal=$ranal['anal_soap'];
			$fila=$pdf->GetY();
			$fila=$fila+6;
			$pdf->SetXY(5,$fila);
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
		$pag=0;
		$filafon=240;
		$busconsu=mysql_query("select * from consultaprincipal where numc_cpl='$numhisto'");
		while($rconsu=mysql_fetch_array($busconsu))
		{
			$motconsu=$rconsu['motc_cpl'];
			$enferact=$rconsu['enac_cpl'];
			$antefam=$rconsu['antefam_cpl'];
			$metodo=$rconsu['mepl_cpl'];
			$anteper=$rconsu['anteper_cpl'];
			$revisis=$rconsu['resi_cpl'];	
			$contrare=$rconsu['core_cpl'];
		}
		$fila=300;
		$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
		//$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			
//-------------------------------------------------------CONSULTA-------------------------------------------------	
		$h=0;		
		$fila=$pdf->GetY();
		$fila=$fila+$h+3;
		$pdf->SetXY(103,$fila);
		$pdf->SetFillColor($col);	
		$fila=$fila+$h+3;
		$pdf->SetXY(103,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(20,4,'CONSULTA',0,0,L);
		$fila=$fila+6;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Motivo de consulta:',0,0,L);	
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$motconsu,0,L,0);
		$fila=$pdf->GetY();
		$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Enfermedad actual:',0,0,L);	
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$enferact,0,L,0);	
		$fila=$pdf->GetY();
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			//$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
//-------------------------------------------------------FIN CONSULTA-----------------------------------------------------
		
		
		
//------------------------------------------------------ANTECEDENTES-------------------------------------------		
		$fila=$fila+3;
		$pdf->SetXY(100,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(20,4,'ANTECEDENTES:',0,0,L);
		$fila=$fila+5;
		$anteanestes=mysql_query("select * from anteced_aneste where numcon_anes='$numhisto'");
		while($rowanest=mysql_fetch_array($anteanestes))
		{
			//$vpatoloanes=$rowanest['patolo_anes'];
			$vcardiovasanes=$rowanest['cardiovas_anes'];
			$vpulmonanes=$rowanest['pulmon_anes'];
			$vquiruanes=$rowanest['quiru_anes'];
			$vfarmaanes=$rowanest['farma_anes'];
			$vtoxicoanes=$rowanest['toxico_anes'];
			$vtransfunanes=$rowanest['transfun_anes'];
			$vginecoanes=$rowanest['gineco_anes'];	
			$votrosanes=$rowanest['otros_anes'];
			$vmetplaanes=$rowanest['metpla_anes'];
		}
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}	
		$fila=$fila+$h;
		/*
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Patologicos:',0,0,L);	
		$pdf->SetXY(37,$fila);
		$pdf->MultiCell(180,4,$vpatoloanes,0,L,0);
		*/		
		$fila=$pdf->GetY();
		$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Cardiovasculares:',0,0,L);	
		$pdf->SetXY(37,$fila);
		$pdf->MultiCell(180,4,$vcardiovasanes,0,L,0);	
		$fila=$pdf->GetY();
		$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Pulmonares:',0,0,L);	
		$pdf->SetXY(37,$fila);
		$pdf->MultiCell(180,4,$vpulmonanes,0,L,0);	
		$fila=$pdf->GetY();
		$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Quirurgico-Anestesicos:',0,0,L);	
		$pdf->SetXY(37,$fila);
		$pdf->MultiCell(180,4,$vquiruanes,0,L,0);	
		$fila=$pdf->GetY();
		$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Farmacologicos:',0,0,L);	
		$pdf->SetXY(37,$fila);
		$pdf->MultiCell(180,4,$vfarmaanes,0,L,0);	
		$fila=$pdf->GetY();
		$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Toxico-Alergicos:',0,0,L);	
		$pdf->SetXY(37,$fila);
		$pdf->MultiCell(180,4,$vtoxicoanes,0,L,0);	
		$fila=$pdf->GetY();
		$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Transfuncionales:',0,0,L);	
		$pdf->SetXY(37,$fila);
		$pdf->MultiCell(180,4,$vtransfunanes,0,L,0);	
		$fila=$pdf->GetY();
		$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Otros:',0,0,L);	
		$pdf->SetXY(37,$fila);
		$pdf->MultiCell(180,4,$votrosanes,0,L,0);	
		$fila=$pdf->GetY();
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}	
		$fila=$fila+$h;
		$fila=$fila+$h;		
		$consultaef="select * from preanes_examenfisico where numero_cons='$numhisto'";
        $consultaef=mysql_query($consultaef);
		$rowexaf=mysql_fetch_array($consultaef);	
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		else
		{
			$fila=$pdf->GetY();	
		}
//-------------------------------------------------FIN ANTECEDENTES----------------------------------------


		
//--------------------------------------------------EXAMEN FISICO------------------------------------------		
		$fila=$fila+$h+3;
		$pdf->SetXY(100,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(20,4,'EXAMEN FISICO',0,0,L);
		$fila=$fila+$h+5;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(40,4,'Peso: '.$rowexaf[peso_exf],0,0,L);
		$pdf->Cell(40,4,'Talla: '.$rowexaf[talla_exf],0,0,L);
		$pdf->Cell(40,4,'Temperatura: '.$rowexaf[tempera_exf],0,0,L);
		$pdf->Cell(40,4,'IMC: '.$rowexaf[imc_exf].' '.$rowexaf[dimc_exf],0,0,L);
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(40,4,'Saturacion de O2: '.$rowexaf[saturo2_exf],0,0,L);
		$pdf->Cell(40,4,'Presion Arterial: '.$rowexaf[presion_exf],0,0,L);
		$pdf->Cell(40,4,'Frecuencia Cardiaca: '.$rowexaf[frecard_exf],0,0,L);
		$pdf->Cell(40,4,'Frecuencia Respiratoria: '.$rowexaf[freresp_exf],0,0,L);
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(200,4,'Estado General: '.$rowexaf[estado_exf],0,0,L);
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Sistema Nervioso Central: '.$rowexaf[snc_exf],0,J);
		$dentpro_='';
		if($rowexaf[dentsuperior_exf]=='S')$dentpro_= 'SUPERIOR, ';
		if($rowexaf[dentinferior_exf]=='S')$dentpro_= $dentpro_.'INFERIOR, ';
		if($rowexaf[dentfija_exf]=='S')$dentpro_= $dentpro_.'FIJA, ';
		if($rowexaf[dentmovil_exf]=='S')$dentpro_= $dentpro_.'MOVIL, ';
		if($rowexaf[dentparcial_exf]=='S')$dentpro_= $dentpro_.'PARCIAL, ';
		if($rowexaf[denttotal_exf]=='S')$dentpro_= $dentpro_.'TOTAL, ';
		$dentpro128=substr($dentpro_, 0, -2);	
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(130,4,'Dentadura: '.$dentpro128.'                   Apertura Bucal: '.$rowexaf[apertur_exf].' Cm',0,0,L);
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(120,4,'Estado de los Dientes: '.$rowexaf[estadodien_exf],0,0,L);
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(40,4,'I.Mallampati: '.$rowexaf[imallam_exf],0,0,L);
		$pdf->Cell(60,4,'Distancia Mentohioidea: '.$rowexaf[dmentoh_exf].' Cm',0,0,L);
		switch ($rowexaf[movilid_exf])
		{
			case 'N':
				$movilid_='Normal';
				break;
			case 'D':
				$movilid_='Disminuida';
				break;
		}
		$pdf->Cell(80,4,'Movilidad Cervical: '.$movilid_,0,0,L);
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Anormalidades del Cuello/Maxilar: '.$rowexaf[anormali_exf],0,J);
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Torax: '.$rowexaf[torax_exf],0,J);
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Pulmones: '.$rowexaf[pulmones_exf],0,J);
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Corazon: '.$rowexaf[corazon_exf],0,J);
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Abdomen: '.$rowexaf[abdomen_exf],0,J);
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Genitourinario: '.$rowexaf[genitouri_exf],0,J);
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Extremidades: '.$rowexaf[extremi_exf],0,J);
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Otros: '.$rowexaf[genitouri_exf],0,J);
		$fila=$fila+$h;		
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
//------------------------------------------------------FIN EXAMEN FISICO---------------------------------------------		

//---------------------------------------------------EXAMENES COMPLEMENTARIOS-----------------------------------------
		$consultaef="select * from preanes_examencomple where numero_cons='$numhisto'";
		$consultaef=mysql_query($consultaef);
		$rowexaf=mysql_fetch_array($consultaef);	
		$fila=$fila+3;
		$fila=$fila+$h+3;
		$pdf->SetXY(100,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(20,4,'EXAMENES COMPLEMENTARIOS',0,0,C);
		$fila=$fila+$h+6;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'Hemoglobina: '.$rowexaf[hemoglo_exc],1,0,L);
		$pdf->Cell(65,4,'Glicemia: '.$rowexaf[glicemi_exc],1,0,L);
		$pdf->Cell(65,4,'Hemoclasificacion: '.$rowexaf[hemocla_exc],1,0,L);
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'Hematocrito: '.$rowexaf[hematoc_exc],1,0,L);
		$pdf->Cell(65,4,'BUN: '.$rowexaf[bun_exc],1,0,L);
		$pdf->Cell(65,4,'Proteinas Total: '.$rowexaf[protein_exc],1,0,L);
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'Plaquetas: '.$rowexaf[plaquet_exc],1,0,L);
		$pdf->Cell(65,4,'Creatinina: '.$rowexaf[creatin_exc],1,0,L);
		$pdf->Cell(65,4,'Albumina: '.$rowexaf[albumin_exc],1,0,L);
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'Tiempo de Protombina '.$rowexaf[tp_exc],1,0,L);
		$pdf->Cell(65,4,'Na+: '.$rowexaf[sodio_exc],1,0,L);
		$pdf->Cell(65,4,'Bilirrubina Total: '.$rowexaf[bilitot_exc],1,0,L);
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'Tiempo Parcial de Tromboplastina: '.$rowexaf[tpt_exc],1,0,L);
		$pdf->Cell(65,4,'K+: '.$rowexaf[potasio_exc],1,0,L);
		$pdf->Cell(65,4,'Bilirrubina Directa: '.$rowexaf[bilidir_exc],1,0,L);
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'Tipo de Sangra: '.$rowexaf[tiposan_exc],1,0,L);
		$pdf->Cell(65,4,'Calcio: '.$rowexaf[calcio_exc],1,0,L);
		$pdf->Cell(65,4,'V.D.R.L : '.$rowexaf[vdrl_exc],1,0,L);
		switch ($rowexaf[prembar_exc]){
			case 'P':
				$prembar_='Positiva';
				break;
			case 'N':
				$prembar_='Negativa';
				break;
		}
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'T. Coagulacion: '.$rowexaf[coagula_exc],1,0,L);
		$pdf->Cell(65,4,'Leucocitos: '.$rowexaf[leucoci_exc],1,0,L);
		$pdf->Cell(65,4,'Prueba de Embarazo: '.$prembar_,1,0,L);
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
//---------------FIN EXAMEN COMPLEMENTARIO 1------------------		
		
		
//---------------EXAMEN COMPLEMENTARIO 2---------------------		
		$fila=$fila+$h+5;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'EXAMEN',1,0,C);
		$pdf->Cell(20,4,'FECHA',1,0,C);
		$pdf->MultiCell(160,4,'LECTURA',1,J);
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Rayos X: ',0,0,L);
		$pdf->Cell(20,4,$rowexaf[rxfecha_exc],0,0,L);
		$pdf->MultiCell(160,4,$rowexaf[rxdescrip_exc],0,J);
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'E.C.G:',0,0,L);
		$pdf->Cell(20,4,$rowexaf[ecgfecha_exc],0,0,L);
		$pdf->MultiCell(160,4,$rowexaf[ecgdescrip_exc],0,J);
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'ECO:',0,0,L);
		$pdf->Cell(20,4,$rowexaf[ecofecha_exc],0,0,L);
		$pdf->MultiCell(160,4,$rowexaf[ecodescrip_exc],0,J);
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'OTRO:',0,0,L);
		$pdf->Cell(20,4,$rowexaf[otrofecha_exc],0,0,L);
		$pdf->MultiCell(160,4,$rowexaf[otrodescrip_exc],0,J);
		$fila=$fila+$h;		
//----------------EXAMEN COMPLEMENTARIO2------------------
//-------------------------------------------------FIN EXAMEN COMPLEMENTARIO-------------------------------------
		
		
//------------------------------------------------------CONCLUSIONES----------------------------------------------		
		$consultaef="select * from preanes_conclusion where numero_cons='$numhisto'";
		$consultaef=mysql_query($consultaef);
		$rowexaf=mysql_fetch_array($consultaef);
		$fila=$pdf->GetY();
		$fila=$fila+$h+1;
		$pdf->SetXY(100,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(20,4,'CONCLUSIONES',0,0,C);
		if($rowexaf[clafuncional_ccl]=='UN')$clafun='I';
		if($rowexaf[clafuncional_ccl]=='DO')$clafun='II';
		if($rowexaf[clafuncional_ccl]=='TR')$clafun='III';
		if($rowexaf[clafuncional_ccl]=='CU')$clafun='IV';	
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'Estado Fisico: A.S.A. '.$rowexaf[estfisico_ccl],0,0,L);
		$pdf->Cell(65,4,'Clase Funcional: '.$clafun,0,0,L);
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		else
		{
			$fila=$fila+$h+4;
		}	
//------------------------------------------------------FIN CONCLUSIONES-----------------------------------------		
		
	
//------------------------------------------------------------PLAN-----------------------------------------------	
		$medicopro=$rowexaf[medicoproc_ccl];
		$pdf->SetXY(5,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(200,4,'       PLAN',0,0,C);
		if($rowexaf[aptociru_ccl]=='S')
		{
			$aptoanes='SI';
		}	
		else
		{
			$aptoanes='NO';
		}	
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'APTO PARA CIRUGIA: '.$aptoanes,0,0,L);
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		
		$fila=$fila+$h+4;
		$pdf->SetXY(10,$fila);
		$pdf->Cell(195,4,'1.Anestesia Propuesta: '.$rowexaf[anestesia_ccl].' '.$rowexaf[vario_ccl].' '.$rowexaf[anestesia1_ccl],0,0,L);
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		$fila=$fila+$h+4;
		$pdf->SetXY(10,$fila);
		$pdf->Cell(195,4,'2.Reserva Sanguinea: '.$rowexaf[reserva_ccl],0,0,L);
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		
		$fila=$fila+$h+4;
		$pdf->SetXY(10,$fila);
		$pdf->Cell(195,4,'3.Premedicacion: '.$rowexaf[premedica_ccl],0,0,L);
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		
		$fila=$fila+$h+4;
		$pdf->SetXY(10,$fila);
		$pdf->Cell(195,4,'4.Reserva UCI: '.$rowexaf[reservauci_ccl],0,0,L);
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		
		switch ($rowexaf[programa_ccl]){
			case 'A':
				$programa_='Ambulatorio';
				break;
			case 'H':
				$programa_='Hospitalizar';
				break;
		}
		$fila=$fila+$h+4;
		$pdf->SetXY(10,$fila);
		$pdf->Cell(195,4,'5.Programar: '.' '.$programa_.' '.$rowexaf[anotacion_ccl],0,0,L);
		
		
		
		
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		
		
		
		if($rowexaf[reevaluar_ccl]=='S')
		{
			$reevalanes='SI';
		}	
		else
		{
			$reevalanes='NO';
		}	
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(195,4,'RE-EVALUAR EN SALA DE CIRUGIA: '.$reevalanes,0,0,L);
		$fila=$fila+$h+4;
		//$pdf->SetXY(5,$fila);
		//$pdf->MultiCell(200,4,'Interconsultas y Observaciones: '.$rowexaf[observa_ccl],0,J);
		//$fila=$pdf->GetY();
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		$fila=$fila+$h+2;
		$pdf->SetXY(5,$fila);
		if($rowexaf[concent_ccl]=='S'){
			$pdf->Cell(3,4,'X',1,0,L);}
		else{
			$pdf->Cell(3,4,' ',1,0,L);}
		$pdf->MultiCell(200,4,'SE EXPLICA ALTERNATIVAS Y RIESGOS ANESTESICOS, SIENDO ENTENDIDAS Y ACEPTADAS POR EL PACIENTE Y/O ACUDIENTE',0,J);
		$fila=$fila+5;		
		$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);		
		$pdf->SetXY(5,$fila);		
		$fila=$pdf->GetY();
//---------------------------------------------------------------FIN PLAN--------------------------------------------------
		
//----------------------------------------------------------IMPRESION DIAGNOSTICA--------------------------------------------------		
		$fila=$fila+$h;	
		$pdf->SetXY(103,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(20,4,'IMPRESION	DIAGNOSTICA ',0,0,C);
		$fila=$fila+4;
		if($vec[11]==1)$tidi='Impresion diagnostica';
		if($vec[11]==2)$tidi='Confirmado nuevo';
		if($vec[11]==3)$tidi='Confirmado repetido';
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'tipo diagnostico: ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->Cell(23,4,$tidi,0,0,L);
		$fila=$fila+4;
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		$fila=$fila+$h;		
		$pdf->SetXY(5,$fila);		
		$pdf->Cell(20,4,'Principal: ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$vec[10].' - '.$desdiaanes,0,L,0);
		$fila=$pdf->GetY();
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}	
		$bdi2=mysql_query("SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, cie_10.nom_cie10
		FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10
		WHERE (((diagnosticos2.numc_di2)='$numhisto'))");
		$t=1;
		while($rd2=mysql_fetch_array($bdi2))
		{
			$codcie2=$rd2['codc_di2'];
			$desd2=$rd2['nom_cie10'];
			$pdf->SetXY(5,$fila);		
			$pdf->Cell(20,4,'Relacionado '.$t.':',0,0,L);			
			$pdf->SetXY(35,$fila);
			$pdf->MultiCell(180,4,$codcie2.' - '.$desd2,0,L,0);
			$t++;
			$fila=$pdf->GetY();
		}
        if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		
//---------------------------------------------------ANALISIS------------------------------------------		
		$fila=$fila+$h;
		$pdf->SetXY(103,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(20,4,'ANALISIS ',0,0,L);	
		$banal=mysql_query("select * from consulta_soap where numc_soap='$numhisto'");
		$ranal=mysql_fetch_array($banal);
		$anal=$ranal['anal_soap'];
		$fila=$fila+4;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(210,4,$anal,0,L,0);
        $fila=$pdf->GetY();        
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}	

//---------------------------------------------PLAN DE TRATAMIENTO----------------------------------------		
		$fila=$fila+$h;
		$pdf->SetXY(103,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(20,4,'PLAN DE TRATAMIENTO ',0,0,C);
		$fila=$fila+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Medicamentos ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$consomed,0,L,0);
		$fila=$pdf->GetY();
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Ayudas DX ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$consoayu,0,L,0);
		$fila=$pdf->GetY();
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Remisiones ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$consoref,0,L,0);
		$fila=$pdf->GetY();
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Proxima consulta ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$proxi,0,L,0);
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		else
		{
			$fila=$fila+4;
		}
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Recomendaciones: ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$obse,0,L,0);
		if($fila>$filafon)
		{
			$fila=300;
			$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
			$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
			$fila=15;
		}
		$fila=$pdf->GetY();
		$firma="../firmas/".$codimedico.".jpg";
		if(file_exists($firma)){
		  $pdf->Image($firma,30,$fila,50,15,'','');
		}
		$fila=$pdf->GetY();
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
//HASTA AQUI LA HISTORIA	

		
//	$impreconse=1;	
	/////////FORMATO DE CONSENTIMIENTO INFORMADO
	if($conseinfanes==1)
	{
			
		
		/*
		
		$pdf->Image('img\enca_cinformado1.jpg',3,$fila+2,210,0,'','');
		$pdf->Image('img\controlado.png',203,100,7,30,'','');
		$pdf->Image('img\pie_histoanes.JPG',2,255,210,0,'','');
		
		*/
		$fila=23;	
		$pdf->AddPage();
		$pdf_=$pdf;
		$formato='FRCIR-34';
		$imaenca="../funciones_php/img/logo_encabezado.JPG";
		include ('../funciones_php/formatos.php');
		//$fila_=$fila_+3;
		
		
		//$fila=$fila+20;				
		
		$pdf->SetFont('Arial','b',8);
	/*		
		$pdf->SetXY(113,16.2);
		$pdf->Cell(92,4,'12',0,1,0);
	*/		
		
		$pdf->SetFont('Arial','',8);
		$pdf->SetXY(10,$fila+2);
		
		$datoprest = explode("-", $fechaconsulta);
		
		if($datoprest[1]=='01')$varmes='Enero';
		if($datoprest[1]=='02')$varmes='Febrero';
		if($datoprest[1]=='03')$varmes='Marzo';
		if($datoprest[1]=='04')$varmes='Abril';
		if($datoprest[1]=='05')$varmes='Mayo';
		if($datoprest[1]=='06')$varmes='Junio';
		if($datoprest[1]=='07')$varmes='Julio';
		if($datoprest[1]=='08')$varmes='Agosto';
		if($datoprest[1]=='09')$varmes='Septiembre';
		if($datoprest[1]=='10')$varmes='Octubre';
		if($datoprest[1]=='11')$varmes='Noviembre';
		if($datoprest[1]=='12')$varmes='Diciembre';	
		
		if($datoprest[2]<10)
		{
			$vardia=substr($datoprest[2], -1);
		}
		else
		{
			$vardia=$datoprest[2];
		}		
		
		$pdf->MultiCell(190,4,'FECHA: '.$vardia.' de '.$varmes.' de '.$datoprest[0].' No. HISTORIA CLÍNICA: '.$identconsulta
		.' Dr. '.strtoupper($nombmedico).' solicita a: '.$nombreconsult.' con numero de Identificación '.$identconsulta 
		.' con historia clínica No. '.$identconsulta.' Que otorgue su conocimiento informado, en cumplimiento de la Ley 23 de 1981 y el Decreto 3380 de 1981 en su articulo' 
		.' 15 y 10 respectivamente y demás normas que lo modifiquen, sustituyan o complementen.',0,J,0);
		$fila=$pdf->GetY()+4;  
		$pdf->SetXY(10,$fila);	
		

		$consultaef="select * from preanes_conclusion where numero_cons='$numhisto'";
		$consultaef=mysql_query($consultaef);
		$rowexafis=mysql_fetch_array($consultaef);
		$tipoanes=$rowexafis['anestesia_ccl'].' '.$rowexafis['vario_ccl'].' '.$rowexafis['anestesia1_ccl'];
		$pdf->MultiCell(190,4, 'Anestesia: '.$tipoanes.' Procedimiento Quirúrgico: '.$cirupropus ,0,J,0);
		
		$fila=$pdf->GetY()+4;  
		$pdf->SetXY(10,$fila);
		
		$pdf->MultiCell(190,4,'1. Yo, en pleno uso de mis facultades mentales, declaro que he recibido una explicación clara y en lenguaje sencillo de todo lo que a'
		.' continuación se detalla en lenguaje técnico. He comprendido satisfactoriamente la naturaleza y propósito del procedimiento anestésico, así como la posibilidad de'
		.' cambio de técnica durante el mismo procedimiento quirúrgico si fuera estrictamente necesario. Se me ha dado la oportunidad de aclarar todas mis dudas.',0,J,0);
		$fila=$pdf->GetY()+1;                         
		$pdf->SetXY(10,$fila);						  
		$pdf->MultiCell(190,4,'Entiendo que el anestesiólogo empleara todos los medios a su alcance buscando seguridad para mí durante el acto anestésico. Sin embargo,' 
		.' soy conciente que no existen garantías absolutas de resultado con la anestesia seleccionada y se me han explicado los posibles riesgos relacionados con su'
		.' administración, los cuales asumo; como por ejemplo: complicaciones de la instrumentación y manejo de la vía aérea, efectos colaterales de medicamento, hipotermia,'
		.' escalofríos, hipertermia, alteraciones cognoscitivas, y psicomotoras, lesiones del sistema nervioso central y/o periférico, nauseas, vomito, mareo, somnolencia,' 
		.' dolor de cabeza, ronquera dolor de garganta, dolores musculares, lesión de labios y dientes, infecciones de la piel o sitios de inyección, hematomas, dolor en las'
		.' venas y arterias puncionales, daño de los ojos, daño de cuerdas vocales, recuerdos intraoperatorios, alergias, broncoaspiracion arritmias, broncoespasmos,' 
		.' laringoespasmos, infarto agudo al miocardio, convulsiones, trombosis, embolias, hematoma epidural, absceso epidural, cefalea postpuncion, lumbar, lumbalgia,'
		.' neurotoxicidad de anestésicos locales y agentes aditivos, limitación funcional, paro cardiorrespiratorio, inclusive la muerte. También, se me ha explicado los' 
		.' riesgos relacionados con las enfermedades preexistentes y su incidencia en el resultado final.',0,J,0);
		$fila=$pdf->GetY()+1;                         
		$pdf->SetXY(10,$fila);
		
		$pdf->MultiCell(190,4,'SI ______ NO ______ doy mi consentimiento para la aplicación de terapia transfuncional de los diferentes componentes sanguíneos si fuese'
		. 'necesario durante el procedimiento anestésico y quirúrgico, habiendo recibido explicación de la indicación y riesgo inherentes.',0,J,0);
		$fila=$pdf->GetY()+4;                         
		$pdf->SetXY(10,$fila);
		
		$pdf->MultiCell(190,4,'2. Certifico que el medico me ha preguntado y le he respondido con la verdad sobre mis enfermedades, de igual manera seguiré sus recomendaciones e indicaciones.',0,J,0);
		$fila=$pdf->GetY()+4;                         
		$pdf->SetXY(10,$fila);
		
		$pdf->MultiCell(190,4,'3. En caso que el paciente sea menor de 18 años, discapacitado mental, inconsciente y/o incapaz debe firmar el representante legal. Obrando como'
		.' representante del paciente en mención por lo cual declaro y acepto los rubros consignados en este documento.',0,J,0);
		$fila=$pdf->GetY()+8;                         
		$pdf->SetXY(10,$fila);
		
		$fila->$fila+2;	
		$pdf->Image('img\huella.jpg',97,$fila,18,27,'','');
		$fila->$fila+4;
		$pdf->SetXY(10,$fila);	
		$pdf->Cell(80,4,'Firma Paciente:_____________________________________',0,0,L);
		$pdf->SetXY(120,$fila);	
		$pdf->Cell(20,4,'Testigo:       ____________________________________',0,0,L);
		$fila=$fila+8;
		$pdf->SetXY(10,$fila);	
		$pdf->Cell(80,4,'C.C.No. ___________________________________________',0,0,L);
		$pdf->SetXY(120,$fila);	
		$pdf->Cell(20,4,'C.C. No.      _____________________________________',0,0,L);
		$fila=$fila+8;
		$pdf->SetXY(120,$fila);	
		$pdf->Cell(80,4,'Parentesco  _____________________________________',0,0,L);
		
		$fila=$fila+13;
		
		$pdf->SetXY(10,$fila);
		$pdf->Cell(100,5,'M&eacute;dico que valora',0,0,L);
		$pdf->Cell(100,5,'M&eacute;dico que realiza el procedimiento',0,0,L);
		
		
		$fila=$pdf->GetY()+13;
		$firma="../firmas/".$codimedico.".jpg";
		if(file_exists($firma))
		{
			$pdf->Image($firma,10,$fila,50,15,'','');
		}
		$bmedpro=mysql_query("SELECT * FROM medicos WHERE cod_medi='$medicopro'");
		while($rmedpro=mysql_fetch_array($bmedpro))
		{
			$codimedpro=$rmedpro['cod_medi'];
			$nombmedpro=$rmedpro['nom_medi'];
			$regimedpro=$rmedpro['reg_medi'];
			$codespepro=$rmedpro['espe_med'];	
			$cedmedipro=$rmedpro['ced_medi'];	
		}
		
		
		$firma="../firmas/".$codimedpro.".jpg";
		if(file_exists($firma))
		{
			$pdf->Image($firma,110,$fila,50,15,'','');
		}
		
		
		$fila=$fila+10;
		$pdf->SetXY(10,$fila);
		$pdf->Cell(100,5,'_______________________________________',0,0,L);
		$pdf->Cell(45,5,'_______________________________________',0,0,L);
		$fila=$fila+5;
		$pdf->SetXY(10,$fila);	
		$pdf->Cell(100,5,strtoupper($nombmedico),0,0,L);
		$pdf->Cell(100,5,strtoupper($nombmedpro),0,0,L);
		
		$fila=$fila+5;
		$pdf->SetXY(10,$fila);
		$pdf->Cell(100,5,"C.C. Nro. ".$cedmedico,0,0,L);
		$pdf->Cell(100,5,"C.C. Nro. ".$cedmedipro,0,0,L);
		
		
		
		$fila=$fila+5;
		$pdf->SetXY(10,$fila);
		$pdf->Cell(100,5,'Registro medico: '.$regimedico,0,0,L);
		$pdf->Cell(100,5,'Registro medico: '.$regimedpro,0,0,L);
		
		$fila=$pdf->GetY()+12;
		$pdf->SetXY(10,$fila);
		$pdf->Cell(45,5,'El paciente NO puede firmar por: _______________________________________________________________________________________',0,0,L);
		

		
//negacion de firmar el consentimiento
/*		
		$pdf->AddPage();
		$fila=4;
		$pdf->Image('img\enca_cinformado1.jpg',1,$fila+2,210,0,'','');
		$fila=$fila+30;
		$pdf->SetFont('Arial','B',8);

		$pdf->SetXY(111,17.2);
		$pdf->Cell(92,4,'2            2',0,1,0);
		
		$pdf->SetXY(15,$fila);
		$pdf->Cell(50,4,'NEGACION A RECIBIR EL TRATAMIENTO MEDICO Y/O QUIRURGICO:',0,0,L);
		
		$fila=$fila+8;
		$pdf->SetFont('Arial','',8);
		$pdf->SetXY(15,$fila);
		$pdf->MultiCell(180,4,'A pesar de la información recibida por el médico tratante, sobre los riesgos de no aceptar el  tratamiento médico quirúrgico propuesto, tomo mi decisión, libre y espontáneamente rechazando la propuesta sugerida  liberando en consecuencia de toda responsabilidad al médico tratante y a la Clínica Proinsalud S.A.',0,1,0);
		$fila=$pdf->GetY();
		
		$fila=$fila+8;
		$pdf->SetXY(15,$fila);	
		$pdf->Cell(80,4,'San Juan de Pasto, ___________________ (día )de ______________ (mes) de _______________(año)',0,0,L);
		$fila=$fila+10;
		
		$fila=$fila+8;
		$pdf->SetXY(15,$fila);
		$pdf->Cell(80,4,'_____________________________________________________',0,0,L);
		
		$pdf->SetXY(105,$fila);
		$pdf->Cell(80,4,'_____________________________________________________',0,0,L);
		
		$fila=$fila+6;
		$pdf->SetXY(15,$fila);
		$pdf->Cell(80,4,'Firma de usuario o acudiente',0,0,L);
		$pdf->SetXY(105,$fila);
		$pdf->Cell(80,4,'Firma y sello medico',0,0,L);
		
		$fila=$fila+14;
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(50,4,'Testigos',0,0,L);
		$pdf->SetFont('Arial','',8);
		$fila=$fila+14;
		
		$pdf->SetXY(15,$fila);
		$pdf->Cell(80,4,'_____________________________________________________',0,0,L);
		
		$pdf->SetXY(105,$fila);
		$pdf->Cell(80,4,'_____________________________________________________',0,0,L);
		
		$fila=$fila+4;
		$pdf->SetXY(15,$fila);
		$pdf->Cell(80,4,'C.C. N°',0,0,L);
		$pdf->SetXY(105,$fila);
		$pdf->Cell(80,4,'C.C. N°',0,0,L);
		
		$pdf->Image('img\controlado.png',203,100,7,30,'','');
		
		$fila=$fila+34;
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(50,4,'DESISTIMIENTO A RECIBIR EL TRATAMIENTO MEDICO Y/O QUIRURGICO:',0,0,L);
		
		$fila=$fila+8;
		$pdf->SetFont('Arial','',8);
		$pdf->SetXY(15,$fila);
		$pdf->MultiCell(180,4,'Considerando que puedo cambiar mi consentimiento, y a pesar de la información recibida por el médico tratante, sobre los riesgos de no aceptar el  tratamiento médico quirúrgico propuesto, tomo mi decisión, libre y espontáneamente rechazando la propuesta sugerida, liberando en consecuencia de toda responsabilidad al médico tratante y a la Clínica Proinsalud S.A.',0,1,0);
		$fila=$pdf->GetY();
		
		$fila=$fila+8;
		$pdf->SetXY(15,$fila);	
		$pdf->Cell(80,4,'San Juan de Pasto, ___________________ (día )de ______________ (mes) de _______________(año)',0,0,L);
		$fila=$fila+10;
		
		$fila=$fila+8;
		$pdf->SetXY(15,$fila);
		$pdf->Cell(80,4,'_____________________________________________________',0,0,L);
		
		$pdf->SetXY(105,$fila);
		$pdf->Cell(80,4,'_____________________________________________________',0,0,L);
		
		$fila=$fila+6;
		$pdf->SetXY(15,$fila);
		$pdf->Cell(80,4,'Firma de usuario o acudiente',0,0,L);
		$pdf->SetXY(105,$fila);
		$pdf->Cell(80,4,'Firma y sello medico',0,0,L);
		
		$fila=$fila+14;
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(50,4,'Testigos',0,0,L);
		$pdf->SetFont('Arial','',8);
		$fila=$fila+14;
		
		$pdf->SetXY(15,$fila);
		$pdf->Cell(80,4,'_____________________________________________________',0,0,L);
		
		$pdf->SetXY(105,$fila);
		$pdf->Cell(80,4,'_____________________________________________________',0,0,L);
		
		$fila=$fila+4;
		$pdf->SetXY(15,$fila);
		$pdf->Cell(80,4,'C.C. N°',0,0,L);
		$pdf->SetXY(105,$fila);
		$pdf->Cell(80,4,'C.C. N°',0,0,L);

		$pdf->Image('img\PIE3.JPG',2,255,210,0,'','');
*/
	
	
	}		
	
	
	
	
	if($inca==1)
	{
		for($i=0;$i<2;$i++)
		{
			if($i==0 || $fila>130)
			{
				$fila=300;
				$pag=titulo($pdf,$fila,$vec,$pag,7,1);
				$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
				$fila=45;				
			}
			else
			{
				$pag=titulo($pdf,$fila,$vec,$pag,7,2);
				$pdf->Image('img\PIE1.JPG',2,123,210,0,'','');
				$fila=$fila+45;
			}			
			$ndias=$vec[22];
			$fecini=$vec[23];
			$desinca="Incapacidad por ".$ndias." a partir de ".$fecini;			
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4,$desinca,1,L,0);
			$fila=$pdf->GetY();				
			$fila=$fila+5;
			
			
			$diag1=$vec[10];
			$bd1=mysql_query("select * from cie_10 where cod_cie10='$diag1'");
			while($rd1=mysql_fetch_array($bd1))
			{
				$desd1=$rd1['nom_cie10'];
			}		
			
			
			$fila=$fila+4;		
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(10,5,'Diagnósticos',0,0,L);	
			$pdf->SetXY(25,$fila);
			$pdf->MultiCell(190,4,$vec[10].' - '.$desd1,0,L,0);
			$fila=$pdf->GetY();						
			$bdi2=mysql_query("SELECT diagnosticos2.numc_di2, diagnosticos2.codc_di2, cie_10.nom_cie10
			FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10
			WHERE (((diagnosticos2.numc_di2)='$numhisto'))");
			$t=1;
			while($rd2=mysql_fetch_array($bdi2))
			{				
				$desdies2=$rd2['codc_di2'].' - '.$rd2['nom_cie10'];
				$pdf->SetXY(25,$fila);				
				$pdf->MultiCell(190,4,$desdies2,0,L,0);				
				$fila=$pdf->GetY();
			}			
			$banal=mysql_query("select * from consulta_soap where numc_soap='$numhisto'");
			$ranal=mysql_fetch_array($banal);
			$anal=$ranal['anal_soap'];
			
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
	if($reco==1)
	{
			
		$fila=300;	
		$pag=titulo($pdf,$fila,$vec,$pag,8,1);
		$fila=45;				
		
//		$pag=titulohis($pdf,$fila,$vec,$pag,5,1,$desdiaanes,$nombmedico,$cirupropus);
//		$pdf->Image('img/pie_histoanes.jpg',2,256,210,0,'','');
		
		$bfor=mysql_query("select * from encabesadoformula where numc_efo='$numhisto'");
		while($rfor=mysql_fetch_array($bfor))
		{				
			$obse=$rfor[obfo_efo];				
		}	
		
		$desobse="RECOMENDACIONES: ".$obse;
		
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(205,4,$desobse,0,L,0);
		$fila=$pdf->GetY();						
		
		$fila=$fila+5;
		
		
		
		$banal=mysql_query("select * from consulta_soap where numc_soap='$numhisto'");
		$ranal=mysql_fetch_array($banal);
		$anal=$ranal['anal_soap'];
		
		
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
	if($anexo==1)
	{
		$consanexo="SELECT refer_at910.idenorig_rat, consultaprincipal.numc_cpl, refer_at910.servorig_rat
		FROM consultaprincipal INNER JOIN refer_at910 ON consultaprincipal.iden_cpl = refer_at910.idenorig_rat
		WHERE (((consultaprincipal.numc_cpl)='$numhisto') AND ((refer_at910.servorig_rat)='CE'))";		
		$consanexo=mysql_query($consanexo);
		if(mysql_num_rows($consanexo)<>0){
			$rowane=mysql_fetch_array($consanexo);
			$servorig_rat='CE';
			$idenorig_rat=$rowane[idenorig_rat];			
			include('form_anexo910.php');
		}
	}
	
	
	$pdf->Output();	
	
	function titulo(&$pdf_,&$fila_,&$vec_,&$pag,$m,$pos)
	{
		$pag=$pag+1;
		if($pos==1)
		{
			$pdf_->AddPage();
			if($m==4){$fila_=4;}
			else{$fila_=0;}
		}
		else
		{			
			$fila_=144;
		}
		if($m==1)	//imagenologia
		{
			$pdf_->Image('img\enca_imageno.JPG',1,$fila_,210,0,'','');
			$pdf_->Image('img\controlado.png',203,100,7,30,'','');
		}
		if($m==2)	//laboratorio
		{
			$pdf_->Image('img\enca_laboratorio.JPG',1,$fila_,210,0,'','');
			$pdf_->Image('img\controlado.png',203,100,7,30,'','');
		}		
		if($m==3)	//remisiones
		{
			$pdf_->Image('img\enca_remision.JPG',1,$fila_,210,0,'','');
			$pdf_->Image('img\controlado.png',203,100,7,30,'','');
		}
		if($m==4)	//formula
		{
			$pdf_->Image('img\enca_formula2.jpg',2,$fila_,202,0,'','');
		}
		if($m==5)	//historia
		{
			if($vec_[20]=='04')
			{
				$pdf_->Image('img\enca_histo.JPG',1,$fila_+2,210,0,'','');
				$pdf_->Image('img\controlado.png',203,130,7,30,'','');
				$pdf_->Image('img\pie_histo.JPG',2,255,210,0,'','');
			}
			else
			{
				$pdf_->Image('img\enca_histo.JPG',1,$fila_,210,0,'','');
				$pdf_->Image('img\controlado.png',203,100,7,30,'','');
				$pdf_->Image('img\pie_histo.JPG',2,255,210,0,'','');
			}		
		}
		if($m==6)
		{
			$pdf_->Image('img\enca_quiro1.JPG',1,$fila_+2,210,0,'','');
			$pdf_->Image('img\controlado.png',203,100,7,30,'','');
		}
		if($m==7)
		{
			$pdf_->Image('img\enca_inca.JPG',1,$fila_,210,0,'','');
			$pdf_->Image('img\controlado.png',203,100,7,30,'','');
		}
		if($m==21)	//consentimiento informado
		{
			$fila_=$fila_+3;
			$pdf_->Image('img\enca_cinformado1.jpg',3,$fila_+2,210,0,'','');
			$pdf_->Image('img\controlado.png',203,100,7,30,'','');
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
		$pdf_->SetXY(137,$fila_+20);
		$pdf_->Cell(20,5,$sexo,0);
		$pdf_->SetXY(145,$fila_+20);
		$pdf_->Cell(20,5,"Edad:",0);
		$pdf_->SetXY(155,$fila_+20);
		$pdf_->Cell(20,5,$edad,0);		
		$pdf_->SetXY(175,$fila_+20);
		$pdf_->Cell(20,5,"Teléfono:",0);
		$pdf_->SetXY(190,$fila_+20);
		$pdf_->Cell(20,5,$telefono,0);		
		$pdf_->SetXY(5,$fila_+25);
		if($m == "4"){$pdf_->Cell(9,5,'Aseguradora:  ' . $contrato);}
		else{$pdf_->Cell(9,5,'Contrato:  ' . $contrato);}	
		$pdf_->SetXY(95,$fila_+25);
		$pdf_->Cell(40,5,"M. atención:",0);
		$pdf_->SetXY(112,$fila_+25);
		$pdf_->Cell(40,5,$muniate,0);		
		$pdf_->SetXY(145,$fila_+25);
		$pdf_->Cell(20,5,"M. servicio:",0);
		$pdf_->SetXY(163,$fila_+25);
		$pdf_->Cell(20,5,$origencon,0);
		$etnia=$vec_[26];	
		$nivel=$vec_[27];	
		$ocupa=$vec_[28];	
		$ecivil=$vec_[29];	
		$direccion=$vec_[30];
		$codetni=$vec_[31];
		$filanu=$fila_+30;	
		if($m==5)
		{		
			$pdf_->SetXY(5,$filanu);
			$pdf_->Cell(40,5,"Nivel educativo:",0);
			$pdf_->SetXY(28,$filanu);
			$pdf_->Cell(40,5,$nivel,0);	
			$pdf_->SetXY(95,$filanu);
			$pdf_->Cell(20,5,"Estado civil:",0);
			$pdf_->SetXY(110,$filanu);
			$pdf_->Cell(20,5,$ecivil,0);
			$filanu=$filanu+5;
			$pdf_->SetXY(5,$filanu);
			$pdf_->Cell(20,5,"Ocupacion:",0);
			$pdf_->SetXY(20,$filanu);
			$pdf_->Cell(20,5,$ocupa,0);
			$pdf_->SetXY(95,$filanu);
			$pdf_->Cell(20,5,"Direccion:",0);
			$pdf_->SetXY(110,$filanu);
			$pdf_->Cell(20,5,$direccion,0);
			$filanu=$filanu+5;
			$pdf_->SetXY(5,$filanu);
			$pdf_->Cell(20,5,"Etnia: ",0);		
			$pdf_->SetXY(30,$filanu);
			if($codetni=='7501')$pdf_->Cell(3,5,'X',0);
			$pdf_->Cell(20,5,'Indigena',0);
			if($codetni=='7502')$pdf_->Cell(3,5,'X',0);
			$pdf_->Cell(20,5,'ROM',0);
			if($codetni=='7503')$pdf_->Cell(3,5,'X',0);
			$pdf_->Cell(20,5,'Raizal',0);
			if($codetni=='7504')$pdf_->Cell(3,5,'X',0);
			$pdf_->Cell(26,5,'Palanquero',0);
			if($codetni=='7505')$pdf_->Cell(3,5,'X',0);
			$pdf_->Cell(30,5,'Afrocolombiano',0);
			if($codetni=='7506')$pdf_->Cell(3,5,'X',0);
			$pdf_->Cell(20,5,'Ninguno de los anteriores',0);
			$filanu=$filanu+5;
		}
		$filanu=$filanu+2;	
		$col=200;
		$pdf_->SetFillColor($col);	
		if($m==4)
		{	
			$pdf_->rect(5,$filanu,198,5,F);
		}
		else
		{
			$pdf_->rect(5,$filanu,205,5,F);
		}	
		
		if($m==8)
		{	
			$pdf_->SetXY(5,$filanu);		
			$pdf_->Cell(40,5,"Servicio: ".  $servicio,0);
			$pdf_->SetXY(150,$filanu);
			$pdf_->Cell(6,5,"Fecha: ".$fecevo.':',0);
			$pdf_->SetXY(187,$filanu);
			$pdf_->Cell(40,5,"Hora: ".$horasa,0);
		}
		else
		{
			if($m==4)
			{
				$pdf_->SetXY(5,$filanu);
				$pdf_->Cell(40,5,"Historia No. ".  $idenevo,0);
				$pdf_->SetXY(75,$filanu);
				$pdf_->Cell(40,5,"Servicio: ".  $servicio,0);
				$pdf_->SetXY(145,$filanu);
				$pdf_->Cell(10,5,"Fecha: ".$fecevo,0);
				$pdf_->SetXY(182,$filanu);
				$pdf_->Cell(10,5,"Hora: ".$horasa,0);
			}	
			else
			{	
				$pdf_->SetXY(5,$filanu);
				$pdf_->Cell(40,5,"Historia No. ".  $idenevo,0);
				$pdf_->SetXY(80,$filanu);
				$pdf_->Cell(40,5,"Servicio: ".  $servicio,0);
				$pdf_->SetXY(150,$filanu);
				$pdf_->Cell(40,5,"Fecha: ".$fecevo,0);
				$pdf_->SetXY(187,$filanu);
				$pdf_->Cell(40,5,"Hora: ".$horasa,0);
			}
		}
		if($m==5)$fila_=$filanu+6;	
		return $pag;	
	}




	function tituloformu(&$pdf_,&$fila_,&$vec_,&$pag,$m,$pos)
	{
		$pag=$pag+1;
		if($pos==1)
		{
			$pdf_->AddPage();
			if($m==4){$fila_=4;}
			else{$fila_=0;}
		}
		else
		{			
			$fila_=144;
		}
		
		$pdf_->Image('img\enca_formula2.jpg',2,$fila_,202,0,'','');
		
		$idenevo=$vec_[0];
		$fecevo=$vec_[1];
		$servicio=$vec_[2];
		$nombre=$vec_[3];
		$sexo=$vec_[4];//$Sexo
		$contrato=$vec_[5];//$contrato
		$identificacion=$vec_[6];//$dentificacion		
		$edad=$vec_[7];//$edad=
		$muniate=$vec_[8];//$edad=
		$diagprin=$vec_[10];//Diagnostico principal
		$horasa=substr($vec_[12],0,5);//$hora de salida de consulta=
		$tipodoc=$vec_[13];//$tipo documento
		$telefono=$vec_[14];//$tipo documento
		$origencon=$vec_[21];//sede donde se realiza la consulta
		$conting=$vec_[32];//sede donde se realiza la consulta
		$regi=$vec_[33];
		$ano=substr($fecevo,0,4);
		$mes=substr($fecevo,5,2);
		$dia=substr($fecevo,8,2);
		
		if($regi=='1')$regimen='CONTRIBUTIVO';
		if($regi=='2')$regimen='SUBSIDIADO';
		if($regi=='3')$regimen='VINCULADO';
		if($regi=='4')$regimen='PARTICULAR';
		if($regi=='5')$regimen='OTRO';
		if($regi=='6')$regimen='ESPECIAL';
		
		$es=1;
		$pdf_->SetXY(5,$fila_+16);
		$pdf_->Cell(61,3,"Servicio",1,0,'C');
		$pdf_->Cell($es,5,'',0,0,'C');
		$pdf_->Cell(28,3,"Diagnóstico principal",1,0,'C');
		$pdf_->Cell($es,5,'',0,0,'C');
		$pdf_->Cell(38,3,"Contingencia",1,0,'C');
		$pdf_->Cell($es,5,'',0,0,'C');
		$pdf_->Cell(68,3,"Aseguradora",1,0,'C');
		
		$pdf_->SetXY(5,$fila_+19);
		$pdf_->Cell(61,5,$servicio,1,0,'C');
		$pdf_->Cell($es,5,'',0,0,'C');
		$pdf_->Cell(28,5,$diagprin,1,0,'C');
		$pdf_->Cell($es,5,'',0,0,'C');
		$pdf_->Cell(38,5,$conting,1,0,'C');
		$pdf_->Cell($es,5,'',0,0,'C');
		$pdf_->Cell(68,5,$contrato,1,0,'C');
		
		$pdf_->SetXY(5,$fila_+26);
		$pdf_->Cell(74,3,'Nombres y apellidos del paciente',1,0,'C');
		$pdf_->Cell($es,3,'',0,0,'C');
		$pdf_->Cell(28,3,'Cédula de ciudadanía',1,0,'C');
		$pdf_->Cell($es,3,'',0,0,'C');
		$pdf_->Cell(39,3,'Municipio',1,0,'C');
		$pdf_->Cell($es,3,'',0,0,'C');
		$pdf_->Cell(10,3,'Género',1,0,'C');
		$pdf_->Cell($es,3,'',0,0,'C');
		$pdf_->Cell(6,3,'Día',1,0,'C');
		$pdf_->Cell(6,3,'Mes',1,0,'C');
		$pdf_->Cell(8,3,'Año',1,0,'C');
		$pdf_->Cell($es,3,'',0,0,'C');
		$pdf_->Cell(22,3,'Régimen',1,0,'C');
		
		$pdf_->SetXY(5,$fila_+29);
		$pdf_->Cell(74,5,$nombre,1,0,'C');
		$pdf_->Cell($es,5,'',0,0,'C');
		$pdf_->Cell(28,5,$identificacion,1,0,'C');
		$pdf_->Cell($es,5,'',0,0,'C');
		$pdf_->Cell(39,5,$origencon,1,0,'C');
		$pdf_->Cell($es,5,'',0,0,'C');
		$pdf_->Cell(10,5,$sexo,1,0,'C');
		$pdf_->Cell($es,5,'',0,0,'C');
		$pdf_->Cell(6,5,$dia,1,0,'C');
		$pdf_->Cell(6,5,$mes,1,0,'C');
		$pdf_->Cell(8,5,$ano,1,0,'C');
		$pdf_->Cell($es,5,'',0,0,'C');
		$pdf_->Cell(22,5,$regimen,1,0,'C');

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
	
	function edad($fecha_nac)
    {
        $dia=date("j");
        $mes=date("n");
        $anno=date("Y");
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

	
	
//FUNCIONES PARA CONVERTIR NUMEROS A LETRAS	
	
	function unidad($numuero)
	{
		switch ($numuero)
		{
			case 9:
			{
				$numu = "NUEVE";
				break;
			}
			case 8:
			{
				$numu = "OCHO";
				break;
			}
			case 7:
			{
				$numu = "SIETE";
				break;
			}		
			case 6:
			{
				$numu = "SEIS";
				break;
			}		
			case 5:
			{
				$numu = "CINCO";
				break;
			}		
			case 4:
			{
				$numu = "CUATRO";
				break;
			}		
			case 3:
			{
				$numu = "TRES";
				break;
			}		
			case 2:
			{
				$numu = "DOS";
				break;
			}		
			case 1:
			{
				$numu = "UNO";
				break;
			}		
			case 0:
			{
				$numu = "";
				break;
			}		
		}
		return $numu;	
	}

//vich
	function titulohis(&$pdf_,&$fila_,&$vec_,&$pag,$m,$pos,$desdiaanes,$nombmedico,$cirupropus)
	{
		if($fila_>240)
		{	
			$pag=$pag+1;
			if($pag==1)
			{
				$coco='{nb}';
//				$coco1 = $coco;
//				$coco2=$coco-1;
			}
			
			$pdf_->AddPage();
			$fila_=0;

			if($m==5)
			{
				/*
				$pdf_->Image('img\enca_histoanes1.JPG',1,$fila_,210,0,'','');
				$fila_=10;
				$pdf_->SetXY(187,$fila_);
				$pdf_->Cell(0,10,$pag.'             2',0,0,'C');
				*/
				
				
				$formato='FRCME-06';
				$imaenca="../funciones_php/img/logo_encabezado.JPG";
				include ('../funciones_php/formatos.php');
				$fila_=$fila_+16;
				
			}
			
			if($pag==1)
			{
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
				
				
				$fila_=$fila_+8;
				$pdf_->SetXY(5,$fila_);
				$pdf_->Cell(40,5,"FECHA: ".$fecevo,0);
				
		//		$pdf_->SetXY(5,$fila_);
		//		$pdf_->Cell(20,5,"Contrato:",0);
				
				$fila_=$fila_+4;
				$pdf_->SetXY(5,$fila_);
				$pdf_->Cell(100,5,"ENTIDAD: ".$contrato,0);	
				
				$fila_=$fila_+4;
				$pdf_->SetXY(5,$fila_);
				$pdf_->Cell(180,5,"NOMBRE: ".$nombre,0);



				$fila_=$fila_+4;
				$pdf_->SetXY(5,$fila_);
				$pdf_->Cell(180,5,"EDAD: ".$edad,0);
				
				
				$fila_=$fila_+4;
				$pdf_->SetXY(5,$fila_);
				$pdf_->Cell(180,5,"HISTORIA CLINICA: ".$identificacion,0);
				
				$fila_=$fila_+4;
				$pdf_->SetXY(5,$fila_);
				$pdf_->Cell(180,5,"PATOLOGIA PRINCIPAL: ".$desdiaanes,0);
				
				$fila_=$fila_+4;
				$pdf_->SetXY(5,$fila_);
				$pdf_->MultiCell(205,4,"CIRUGIA PROPUESTA: ".$cirupropus,0,L,0);
				$fila_=$pdf_->GetY();						
		
				
				//$fila_=$fila_+4;
				$pdf_->SetXY(5,$fila_);
				$pdf_->Cell(180,5,"VALORADO POR: Dr. ".strtoupper($nombmedico),0);
			}
			else
			{
				$fila_=$fila_+3;
			}	
			
	//		$pdf_->SetXY(95,$fila_);
	//		$pdf_->Cell(6,5,$tipodoc.':',0);

	//		$pdf_->SetXY(102,$fila_);
	//		$pdf_->Cell(20,5,$identificacion,0);		

	//		$pdf_->SetXY(5,$fila_);
	//		$pdf_->Cell(40,5,"Nombre:",0);
	//		$pdf_->SetXY(20,$fila_);
	//		$pdf_->Cell(40,5,$nombre,0);		

	//		$pdf_->SetXY(125,$fila_);
	//		$pdf_->Cell(20,5,"sexo:",0);
	//		$pdf_->SetXY(133,$fila_);
	//		$pdf_->Cell(20,5,$sexo,0);		

	//		$pdf_->SetXY(145,$fila_);
	//		$pdf_->Cell(20,5,"Edad:",0);
	//		$pdf_->SetXY(155,$fila_);
	//		$pdf_->Cell(20,5,$edad,0);		

	//		$pdf_->SetXY(175,$fila_);
	//		$pdf_->Cell(20,5,"Telefono:",0);
	//		$pdf_->SetXY(190,$fila_);
	//		$pdf_->Cell(20,5,$telefono,0);		
			
			
	/*		
			$fila_=$fila_+4;
			
			
			
			$pdf_->SetXY(95,$fila_);
			$pdf_->Cell(40,5,"M. atención:",0);
			$pdf_->SetXY(112,$fila_);
			$pdf_->Cell(40,5,$muniate,0);		
			$pdf_->SetXY(145,$fila_);
			$pdf_->Cell(20,5,"M. servicio:",0);
			$pdf_->SetXY(163,$fila_);
			$pdf_->Cell(20,5,'PASTO',0);

	//		$col=200;
	//		$pdf_->SetFillColor($col);	
	//		$pdf_->rect(5,$fila_+32,205,5,F);
			
			$fila_=$fila_+4;
			

			$pdf_->SetXY(5,$fila_);
			$pdf_->Cell(40,5,"Historia No. ".  $idenevo,0);
			$pdf_->SetXY(80,$fila_);
			$pdf_->Cell(40,5,"Servicio: ".  $servicio,0);
			
			
	//		$pdf_->SetXY(187,$fila_);
	//		$pdf_->Cell(40,5,"Hora: ".$horasa,0);
	*/		
	//		$fila_=$fila_+10;
			
			//$pdf_->line(5,$fila_+32,205,$fila_+32);
			//$pdf_->line(5,$fila_+37,205,$fila_+37);  
			//$fila_=36;	
			return $pag;
		}
	}


	function decena($numdero)
	{
	
		if ($numdero >= 90 && $numdero <= 99)
		{
			$numd = "NOVENTA ";
			if ($numdero > 90)
				$numd = $numd."Y ".(unidad($numdero - 90));
		}
		else if ($numdero >= 80 && $numdero <= 89)
		{
			$numd = "OCHENTA ";
			if ($numdero > 80)
				$numd = $numd."Y ".(unidad($numdero - 80));
		}
		else if ($numdero >= 70 && $numdero <= 79)
		{
			$numd = "SETENTA ";
			if ($numdero > 70)
				$numd = $numd."Y ".(unidad($numdero - 70));
		}
		else if ($numdero >= 60 && $numdero <= 69)
		{
			$numd = "SESENTA ";
			if ($numdero > 60)
				$numd = $numd."Y ".(unidad($numdero - 60));
		}
		else if ($numdero >= 50 && $numdero <= 59)
		{
			$numd = "CINCUENTA ";
			if ($numdero > 50)
				$numd = $numd."Y ".(unidad($numdero - 50));
		}
		else if ($numdero >= 40 && $numdero <= 49)
		{
			$numd = "CUARENTA ";
			if ($numdero > 40)
				$numd = $numd."Y ".(unidad($numdero - 40));
		}
		else if ($numdero >= 30 && $numdero <= 39)
		{
			$numd = "TREINTA ";
			if ($numdero > 30)
				$numd = $numd."Y ".(unidad($numdero - 30));
		}
		else if ($numdero >= 20 && $numdero <= 29)
		{
			if ($numdero == 20)
				$numd = "VEINTE ";
			else
				$numd = "VEINTI".(unidad($numdero - 20));
		}
		else if ($numdero >= 10 && $numdero <= 19)
		{
			switch ($numdero){
			case 10:
			{
				$numd = "DIEZ ";
				break;
			}
			case 11:
			{		 		
				$numd = "ONCE ";
				break;
			}
			case 12:
			{
				$numd = "DOCE ";
				break;
			}
			case 13:
			{
				$numd = "TRECE ";
				break;
			}
			case 14:
			{
				$numd = "CATORCE ";
				break;
			}
			case 15:
			{
				$numd = "QUINCE ";
				break;
			}
			case 16:
			{
				$numd = "DIECISEIS ";
				break;
			}
			case 17:
			{
				$numd = "DIECISIETE ";
				break;
			}
			case 18:
			{
				$numd = "DIECIOCHO ";
				break;
			}
			case 19:
			{
				$numd = "DIECINUEVE ";
				break;
			}
			}	
		}
		else
		{	
			$numd = unidad($numdero);
			return $numd;
		}
	}

	function centena($numc){
		if ($numc >= 100)
		{
			if ($numc >= 900 && $numc <= 999)
			{
				$numce = "NOVECIENTOS ";
				if ($numc > 900)
					$numce = $numce.(decena($numc - 900));
			}
			else if ($numc >= 800 && $numc <= 899)
			{
				$numce = "OCHOCIENTOS ";
				if ($numc > 800)
					$numce = $numce.(decena($numc - 800));
			}
			else if ($numc >= 700 && $numc <= 799)
			{
				$numce = "SETECIENTOS ";
				if ($numc > 700)
					$numce = $numce.(decena($numc - 700));
			}
			else if ($numc >= 600 && $numc <= 699)
			{
				$numce = "SEISCIENTOS ";
				if ($numc > 600)
					$numce = $numce.(decena($numc - 600));
			}
			else if ($numc >= 500 && $numc <= 599)
			{
				$numce = "QUINIENTOS ";
				if ($numc > 500)
					$numce = $numce.(decena($numc - 500));
			}
			else if ($numc >= 400 && $numc <= 499)
			{
				$numce = "CUATROCIENTOS ";
				if ($numc > 400)
					$numce = $numce.(decena($numc - 400));
			}
			else if ($numc >= 300 && $numc <= 399)
			{
				$numce = "TRESCIENTOS ";
				if ($numc > 300)
					$numce = $numce.(decena($numc - 300));
			}
			else if ($numc >= 200 && $numc <= 299)
			{
				$numce = "DOSCIENTOS ";
				if ($numc > 200)
					$numce = $numce.(decena($numc - 200));
			}
			else if ($numc >= 100 && $numc <= 199)
			{
				if ($numc == 100)
					$numce = "CIEN ";
				else
					$numce = "CIENTO ".(decena($numc - 100));
			}
		}
		else
			$numce = decena($numc);
		
		return $numce;	
	}

	function miles($nummero){
		if ($nummero >= 1000 && $nummero < 2000){
			$numm = "MIL ".(centena($nummero%1000));
		}
		if ($nummero >= 2000 && $nummero <10000){
			$numm = unidad(Floor($nummero/1000))." MIL ".(centena($nummero%1000));
		}
		if ($nummero < 1000)
			$numm = centena($nummero);
		
		return $numm;
	}

	function decmiles($numdmero){
		if ($numdmero == 10000)
			$numde = "DIEZ MIL";
		if ($numdmero > 10000 && $numdmero <20000){
			$numde = decena(Floor($numdmero/1000))."MIL ".(centena($numdmero%1000));		
		}
		if ($numdmero >= 20000 && $numdmero <100000){
			$numde = decena(Floor($numdmero/1000))." MIL ".(miles($numdmero%1000));		
		}		
		if ($numdmero < 10000)
			$numde = miles($numdmero);
		
		return $numde;
	}		

	function cienmiles($numcmero){
		if ($numcmero == 100000)
			$num_letracm = "CIEN MIL";
		if ($numcmero >= 100000 && $numcmero <1000000){
			$num_letracm = centena(Floor($numcmero/1000))." MIL ".(centena($numcmero%1000));		
		}
		if ($numcmero < 100000)
			$num_letracm = decmiles($numcmero);
		return $num_letracm;
	}	
	
	function millon($nummiero){
		if ($nummiero >= 1000000 && $nummiero <2000000){
			$num_letramm = "UN MILLON ".(cienmiles($nummiero%1000000));
		}
		if ($nummiero >= 2000000 && $nummiero <10000000){
			$num_letramm = unidad(Floor($nummiero/1000000))." MILLONES ".(cienmiles($nummiero%1000000));
		}
		if ($nummiero < 1000000)
			$num_letramm = cienmiles($nummiero);
		
		return $num_letramm;
	}	

	function decmillon($numerodm){
		if ($numerodm == 10000000)
			$num_letradmm = "DIEZ MILLONES";
		if ($numerodm > 10000000 && $numerodm <20000000){
			$num_letradmm = decena(Floor($numerodm/1000000))."MILLONES ".(cienmiles($numerodm%1000000));		
		}
		if ($numerodm >= 20000000 && $numerodm <100000000){
			$num_letradmm = decena(Floor($numerodm/1000000))." MILLONES ".(millon($numerodm%1000000));		
		}
		if ($numerodm < 10000000)
			$num_letradmm = millon($numerodm);
		
		return $num_letradmm;
	}

	function cienmillon($numcmeros){
		if ($numcmeros == 100000000)
			$num_letracms = "CIEN MILLONES";
		if ($numcmeros >= 100000000 && $numcmeros <1000000000){
			$num_letracms = centena(Floor($numcmeros/1000000))." MILLONES ".(millon($numcmeros%1000000));		
		}
		if ($numcmeros < 100000000)
			$num_letracms = decmillon($numcmeros);
		return $num_letracms;
	}	

	function milmillon($nummierod){
		if ($nummierod >= 1000000000 && $nummierod <2000000000){
			$num_letrammd = "MIL ".(cienmillon($nummierod%1000000000));
		}
		if ($nummierod >= 2000000000 && $nummierod <10000000000){
			$num_letrammd = unidad(Floor($nummierod/1000000000))." MIL ".(cienmillon($nummierod%1000000000));
		}
		if ($nummierod < 1000000000)
			$num_letrammd = cienmillon($nummierod);
		
		return $num_letrammd;
	}	
		
	function convertir($numero){
			   $numf = milmillon($numero);
			return $numf." ";
	}
	
?>