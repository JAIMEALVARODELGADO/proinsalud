<?php
	require('fpdf.php');		
	set_time_limit (120);
	$pdf=new FPDF('P','mm','Letter');
	$pdf->SetFont('Arial','',8);
	include ('php/conexion1.php');
	

//$cod_medi='1103294';
$numtriage='';
$num_hist='';
$serie='';
$concon='1';
$tipo='1';
$histor='-1';
$valregre='';
$codusu='';
$marca='';
$his='1';

$conspac="SELECT usuario.NROD_USU, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario
FROM usuario INNER JOIN (citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON usuario.CODI_USU = citas.Idusu_citas
WHERE (((horarios.Fecha_horario)='$fecha_cita') AND ((horarios.Cmed_horario)='$cod_medi'))";
//echo "<br>".$conspac;
$conspac=mysql_query($conspac);
while($rowpac=mysql_fetch_array($conspac)){
	$cedula=$rowpac[NROD_USU];	
	$conshisto="SELECT encabesadohistoria.idus_ehi, consultaprincipal.numc_cpl, consultaprincipal.come_cpl
	FROM consultaprincipal INNER JOIN encabesadohistoria ON consultaprincipal.numc_cpl = encabesadohistoria.numc_ehi
	WHERE (((encabesadohistoria.idus_ehi)='$cedula') AND ((consultaprincipal.come_cpl)='$cod_medi'))";
	//echo "<br>".$conshisto;
	$conshisto=mysql_query($conshisto);
	while($rowhis=mysql_fetch_array($conshisto)){
		$numhisto=$rowhis[numc_cpl];		
		//echo "<br>".$numhisto;
	
	$bima="SELECT cups.codigo, cups.codi_cup, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre, detareferencia.dest_dre
	FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
	WHERE (((detareferencia.numc_dre)='$numhisto')) AND ((((cups.grup_cup)='87')) OR (((cups.grup_cup)='88')))";
	//echo $bima;
	$bima=mysql_query($bima);
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
		FROM medicamentos2 INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa
		WHERE (((medicamentos2.codi_mdi)='$codi'))");
		//$num=mysql_num_rows($bdesmed);
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
		$mat4[$i][7]=$tiem.' dias';
		$mat4[$i][8]=$cant;	
		$mat4[$i][9]=$via;
		$mat4[$i][10]=$obsmed;	
		
		$i++;
		$consomed=$consomed.' '.$desc.' '.$dosi.' '.$undo.' '.$frec.' '.$unfr.' '.$via.' '.$cant.'|| ';
	}
	$fin4=$i;
	/*
	$busu=mysql_query("SELECT encabesadohistoria.numc_ehi, encabesadohistoria.idus_ehi, encabesadohistoria.feco_ehi, encabesadohistoria.nomb_ehi, municipio.NOMB_MUN, encabesadohistoria.sexo_ehi, encabesadohistoria.fnac_ehi, contrato.NEPS_CON, areas.nom_areas,cod_areas,consultaprincipal.radx_cpl,consultaprincipal.cod1_cpl,consultaprincipal.tidx_cpl,consultaprincipal.hosa_cpl,encabesadohistoria.cous_ehi,encabesadohistoria.telf_ehi
	FROM (((encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) INNER JOIN contrato ON encabesadohistoria.cont_ehi = contrato.CODI_CON) INNER JOIN municipio ON encabesadohistoria.muat_ehi = municipio.CODI_MUN) INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas
	WHERE (((encabesadohistoria.numc_ehi)='$numhisto'))"); 
	*/	
	
	$busu="SELECT encabesadohistoria.numc_ehi, encabesadohistoria.idus_ehi, encabesadohistoria.feco_ehi, encabesadohistoria.nomb_ehi, municipio.NOMB_MUN, encabesadohistoria.sexo_ehi, encabesadohistoria.fnac_ehi, areas.nom_areas, areas.cod_areas, consultaprincipal.radx_cpl, consultaprincipal.cod1_cpl, consultaprincipal.tidx_cpl, consultaprincipal.hosa_cpl, encabesadohistoria.cous_ehi, encabesadohistoria.telf_ehi, encabesadohistoria.origconsu_ehi AS oricon,
	consultaprincipal.cod1_cpl, consultaprincipal.inca_cpl, consultaprincipal.feinca_cpl,consultaprincipal.sire_cpl,consultaprincipal.sipi_cpl	
	FROM ((encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) LEFT JOIN municipio ON encabesadohistoria.muat_ehi = municipio.CODI_MUN) INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas
	WHERE (((encabesadohistoria.numc_ehi)='$numhisto'))";
	//echo $busu;
	$busu=mysql_query($busu);		
	
	while($rusu=mysql_fetch_array($busu))
	{		
		$vec[0]=$numhisto;
		$vec[1]=$rusu['feco_ehi'];//$fecha
		$vec[2]=$rusu['nom_areas'];//nom_areas
		$vec[3]=$rusu['nomb_ehi'];//$nombre;
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
		$vec[22]=$rusu['inca_cpl']; 
		$vec[23]=$rusu['feinca_cpl']; 

		$vec[24]=$rusu['sire_cpl']; 
		$vec[25]=$rusu['sipi_cpl'];
		
		$origen=$rusu['oricon'];		
		$busori=mysql_query("select * from origen_consulta where codmuni_ori='$origen'");
		while($rori=mysql_fetch_array($busori))
		{
			$nomorigen=$rori['muni_ori'];
		}
		if($nomorigen=='' || $nomorigen==null || $nomorigen=='0')$vec[21]='PASTO';
		else $vec[21]=$nomorigen;
	}
	
	$bconcit=mysql_query("SELECT contrato.NEPS_CON, encabesadohistoria.numc_ehi
	FROM encabesadohistoria INNER JOIN contrato ON encabesadohistoria.cont_ehi = contrato.CODI_CON
	WHERE (((encabesadohistoria.numc_ehi)='$numhisto'))");
	while($rconcit=mysql_fetch_array($bconcit))
	{
		$vec[5]=strtoupper($rconcit['NEPS_CON']);//$rowusu[neps_con];//$contrato
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
		//for($i=0;$i<2;$i++)
		//{
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
			
		//}
	}
	
	if($lab=='1')
	{
		//for($i=0;$i<2;$i++)
		//{
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
			
		//}
	}
	
	if($rem=='1')
	{		
		//for($i=0;$i<2;$i++)
		//{
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
		//}
	}
	if($med=='1')
	{
		for($i=0;$i<2;$i++)
		{
			if($i==0 || $fila>120)
			{
				$fila=300;
				$pag=titulo($pdf,$fila,$vec,$pag,4,1);
				$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
				$fila=38;				
			}
			else
			{
				$pag=titulo($pdf,$fila,$vec,$pag,4,2);
				$pdf->Image('img\PIE1.JPG',2,123,210,0,'','');
				$fila=$fila+38;
			}
			$a1=8;			//DX
			$a2=14;			//CODIGO
			$a3=70;			//DESCRIPCION
			$a4=13;			//DOSIS
			$a5=22;			//FRECUENCIA
			$a6=18;			//VIA
			$a7=17;			//TIEMPO TTO
			$a8=7;			//C. PRESC
			$a9=27;			//C. PRESC
			$a10=12;			//C. DISP
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
			$pdf->Cell(15,5,$nuformu,0,0,C);
			$pdf->SetFont('Arial','',7);
			$fila=$fila+5;
			$pdf->SetXY(5,$fila);
			$pdf->Cell($a1,5,'DX',1,0,C);
			$pdf->Cell($a2,5,'CODIGO',1,0,C);
			$pdf->Cell($a3,5,'DESCRIPCION',1,0,C);
			$pdf->Cell($a4,5,'DOSIS',1,0,C);
			$pdf->Cell($a5,5,'FRECUENCIA',1,0,C);
			$pdf->Cell($a6,5,'VIA',1,0,C);			
			$pdf->Cell($a7,5,'TIEMPO TTO.',1,0,C);
			$pdf->Cell($a8+$a9,5,'CANTIDAD PRESCRITA',1,0,C);
			//$pdf->Cell($a9,5,'C. PRESC.',1,0,C);
			$pdf->Cell($a10,5,'C. DISP.',1,0,C);
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
					//$nvia="Intramuscular";
				}
				
				//$a1=8;$a2=14;$a3=84;$a4=14;$a5=22;$a6=19;$a7=19;$a8=15;$a9=12;
				
				$pdf->SetXY(5,$fila);
				$pdf->MultiCell($a1,5,$diag,0,C,0);
				$bajo1=$pdf->GetY();
				
				if(strlen($codi)>6)
				{
					$codi=substr($codi,5,7);				
				}
				$pdf->SetXY(5+$a1,$fila);
				$pdf->MultiCell($a2,5,$codi,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				
				$pdf->SetXY(5+$a1+$a2,$fila);
				$pdf->MultiCell($a3,5,$desc,0,L,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				
				$pdf->SetXY(5+$a1+$a2+$a3,$fila);
				$pdf->MultiCell($a4,5,$dosi.' '.$undo,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				
				$pdf->SetXY(5+$a1+$a2+$a3+$a4,$fila);
				if($frec=='')
				{
					$pdf->MultiCell($a5,5,$frec.' '.$unfr,0,C,0);
				}
				else
				{
					$pdf->MultiCell($a5,5,'Cada '.$frec.' '.$unfr,0,C,0);
				}
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				
				$pdf->SetXY(5+$a1+$a2+$a3+$a4+$a5,$fila);
				$pdf->MultiCell($a6,5,$nvia,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;		
				
				
				$pdf->SetXY(5+$a1+$a2+$a3+$a4+$a5+$a6,$fila);
				$pdf->MultiCell($a7,5,$tiem,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;				
				
				$pdf->SetXY(5+$a1+$a2+$a3+$a4+$a5+$a6+$a7,$fila);
				$pdf->MultiCell($a8,5,$cant,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				$bajo=$bajo1-$fila;	
				
				$canletras=convertir($cant);

				$pdf->SetXY(5+$a1+$a2+$a3+$a4+$a5+$a6+$a7+$a8,$fila);
				$pdf->MultiCell($a9,5,$canletras,0,C,0);
				$bajo2=$pdf->GetY();
				if($bajo2>$bajo1)$bajo1=$bajo2;
				$bajo=$bajo1-$fila;	



				
				
				$pdf->Rect(5, $fila, $a1, $bajo); 
				$pdf->Rect(5+$a1, $fila, $a2, $bajo); 
				$pdf->Rect(5+$a1+$a2, $fila, $a3, $bajo); 
				$pdf->Rect(5+$a1+$a2+$a3, $fila, $a4, $bajo); 
				$pdf->Rect(5+$a1+$a2+$a3+$a4, $fila, $a5, $bajo); 
				$pdf->Rect(5+$a1+$a2+$a3+$a4+$a5, $fila, $a6, $bajo);				
				$pdf->Rect(5+$a1+$a2+$a3+$a4+$a5+$a6, $fila, $a7, $bajo); 
				$pdf->Rect(5+$a1+$a2+$a3+$a4+$a5+$a6+$a7, $fila, $a8, $bajo);
				$pdf->Rect(5+$a1+$a2+$a3+$a4+$a5+$a6+$a7+$a8, $fila, $a9, $bajo);
				$pdf->Rect(5+$a1+$a2+$a3+$a4+$a5+$a6+$a7+$a8+$a9, $fila, $a10, $bajo); 				
				$fila=$fila+$bajo;				
				$pdf->SetXY(5,$fila);
				$pdf->SetFillColor(240);
				$pdf->SetFont('Arial','',7);
				$pdf->MultiCell(208,4,'   Observaciones:  '.$obsmed,1,L,1);
				$fila=$pdf->GetY();				
				
			}
			
			
			$fila=$fila+2;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(5,5,'Próxima consulta: '.$proxi,0,0,L);
			$pdf->SetXY(120,$fila);
			$pdf->Cell(5,5,'Repetir esta formula por '.$repi.' meses',0,0,L);			
			/*
			$fila=$fila+5;
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(210,5,'Recomendaciones: '.$obse,0,L,0);
			*/
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
			/*
			$pdf->Cell(10,5,'Anï¿½lisis',0,0,L);
			$pdf->SetXY(25,$fila);
			$pdf->MultiCell(190,4,$anal,0,L,0);
			*/
			
			
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
	
	
	
	
	
	
	
	
	
	$col=220;
	if($his=='1')
	{
		
		$bacud=mysql_query("select * from acompanante where numc_aco='$numhisto'");
		while($racud=mysql_fetch_array($bacud))
		{
			$nomacu=$racud['noma_aco'];
			$diracu=$racud['dire_aco'];
			$telacu=$racud['tele_aco'];
			$paracu=$racud['pare_aco'];
		}
		
		$busconsu=mysql_query("select * from consultaprincipal where numc_cpl='$numhisto'");
		while($rconsu=mysql_fetch_array($busconsu))
		{
			$motconsu=$rconsu['motc_cpl'];
			$enferact=$rconsu['enac_cpl'];
			$antefam=$rconsu['antefam_cpl'];
			$anteper=$rconsu['anteper_cpl'];
			$revisis=$rconsu['resi_cpl'];	
			$contrare=$rconsu['core_cpl'];
			$sintores=$rconsu['sire_cpl'];
			$sintopie=$rconsu['sipi_cpl'];
		}
		
		$fila=300;
		$pag=titulo($pdf,$fila,$vec,$pag,5,1);
		//$pdf->Image('img\PIE1.JPG',2,264,210,0,'','');
		$fila=$fila+40;	
                $h=2;		
		$fila=$pdf->GetY();
		$fila=$fila+$h+4;
		$pdf->SetXY(103,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(20,4,'ACUDIENTE: ',0,0,L);	
		
		$fila=$fila+4;
		$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(12,4,'Nombre:',0,0,L);	
		$pdf->Cell(45,4,$nomacu,0,0,L);
		$pdf->Cell(13,4,'Dirección:',0,0,L);
		$pdf->Cell(68,4,$diracu,0,0,L);
		$pdf->Cell(13,4,'Teléfono:',0,0,L);
		$pdf->Cell(15,4,$telacu,0,0,L);
		$pdf->Cell(17,4,'Parentesco:',0,0,L);
		$pdf->Cell(30,4,$paracu,0,0,L);
		
		
	$fila=$fila+$h+4;
	$pdf->SetXY(103,$fila);
	$pdf->SetFillColor($col);	
	$pdf->rect(5,$fila,205,4,F);
	$pdf->Cell(20,4,'CONSULTA ',0,0,L);
	$fila=$fila+6;
	$pdf->SetXY(5,$fila);
	$pdf->Cell(20,4,'Motivo de consulta:',0,0,L);	
	$pdf->SetXY(35,$fila);
	$pdf->MultiCell(180,4,$motconsu,0,L,0	);
	$fila=$pdf->GetY();

	$fila=$fila+$h;
	$pdf->SetXY(5,$fila);
	$pdf->Cell(20,4,'Enfermedad actual:',0,0,L);	
	$pdf->SetXY(35,$fila);
	$pdf->MultiCell(180,4,$enferact,0,L,0);	
	$fila=$pdf->GetY();
	//$pdf->SetDrawColor(150);
	//$pdf->line(5,$fila-0,210,$fila-0);
	//$pdf->line(5,$fila+5,210,$fila+5);
	$fila=$fila+$h5;
	$pdf->SetXY(5,$fila);
	$pdf->Cell(20,4,'Revisión por sistema:',0,0,L);
	$pdf->SetXY(35,$fila);
	$pdf->MultiCell(180,4,$revisis,0,L,0);
	$fila=$pdf->GetY();
		
		
		$fila=$pdf->GetY();
		$fila=$fila+4;
		$pdf->SetXY(100,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(20,4,'ANTECEDENTES:',0,0,L);
		
		$fila=$fila+4;
$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Personales:',0,0,L);	
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$anteper,0,L,0);	
		$fila=$pdf->GetY();
$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Planificación:',0,0,L);	
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$metodo,0,L,0);	
		$fila=$pdf->GetY();		
$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Familiares:',0,0,L);	
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$antefam,0,L,0);	
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
				
				$pdf->Cell(20,4,'Gineco-obstétricos:',0,0,L);	
				$pdf->SetXY(35,$fila);
				$pdf->MultiCell(180,4,$ante,0,L,0);	
				$fila=$pdf->GetY();
				$pdf->SetXY(35,$fila);
				$pdf->Cell(30,4,'FUM: '.$feculme	,0,0,L);
				$pdf->Cell(25,4,'Gestas: '.$gestas,0,0,L);
				$pdf->Cell(25,4,'Partos: '.$partos,0,0,L);
				$pdf->Cell(25,4,'Cesareas: '.$cesar,0,0,L);
				$pdf->Cell(25,4,'Abortos: '.$abor,0,0,L);
				$pdf->Cell(25,4,'Vivos: '.$vivos,0,0,L);
				$pdf->Cell(25,4,'Mortinatos: '.$morti,0,0,L);
				$fila=$fila+4;
			}
		}

$fila=$fila+$h;
						
		
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
			$otrohall=$rexaf['otrh_efi'];
			$icc=$rexaf['icc_efi'];	
			$imc=$rexaf['imc_efi'];			
			$fila=$pdf->GetY();
			$fila=$fila+$h+4;
			$pdf->SetXY(100,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->Cell(20,4,'EXAMEN FISICO:',0,0,L);
			$fila=$fila+$h+4;
			$pdf->SetXY(5,$fila);			
			$pdf->SetXY(5,$fila);
			if($tenci1!=''){$pdf->Cell(23,4,'T.A: '.$tenci1.'/'.$tenci2,0,0,L);}
			if($fres!=''){$pdf->Cell(23,4,'F.R: '.$fres,0,0,L);}
			if($fcar!=''){$pdf->Cell(23,4,'F.C: '.$fcar,0,0,L);}
			if($temp!=''){$pdf->Cell(23,4,'T: '.$temp,.0,0,L);}		
			if($peso!=''){$pdf->Cell(23,4,'Peso: '.$peso.' Kg.',0,0,L);}
			if($talla!=''){$pdf->Cell(23,4,'Talla: '.$talla.' Kg.',0,0,L);}	
			if($pcfa!=''){$pdf->Cell(23,4,'P.C: '.$pcfa,0,0,L);}			
			if($imc!=''){$pdf->Cell(23,4,'IMC: '.$imc,0,0,L);}		
			if($icc!=''){$pdf->Cell(23,4,'ICC: '.$icc,0,0,L);}	
		}		
		$bcomple=mysql_query("SELECT complementoexfisico.numc_cef, destipos.nomb_des, complementoexfisico.desc_cef
		FROM complementoexfisico INNER JOIN destipos ON complementoexfisico.code_cef = destipos.codi_des
		WHERE (((complementoexfisico.numc_cef)='$numhisto'));");
		$fila=$fila+4;

		while($rcom=mysql_fetch_array($bcomple))
		{
			$nomb_des=$rcom['nomb_des'];
			$desc_cef=$rcom['desc_cef'];			
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(180,4,$nomb_des.': '.$desc_cef,0,L,0);	
			$fila=$pdf->GetY();			
		}
		$pdf->SetXY(5,$fila);
$fila=$fila+$h;
		$pdf->Cell(20,4,'Otros hallazgos: ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$otrohall,0,L,0);
		$fila=$fila+$h+4;
		$fila=$pdf->GetY();
		$fila=$pdf->GetY();
		$fila=$fila+4;
		$pdf->SetXY(92,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(40,4,'INFORME PARACLINICOS:',0,0,L);
		$fila=$fila+5;		
		$pdf->SetXY(5,$fila);
		
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(180,4,$vec[9]	,0,L,0);
		$diag1=$vec[10];
		$bd1=mysql_query("select * from cie_10 where cod_cie10='$diag1'");
		while($rd1=mysql_fetch_array($bd1))
		{
			$desd1=$rd1['nom_cie10'];
		}
		
		
		
		
		$fila=$pdf->GetY();
$fila=$fila+$h;	
$pdf->SetXY(99,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
				$pdf->Cell(20,4,'DIAGNOSTICO ',0,0,L);
		//$pdf->SetDrawColor(150);
		//		$pdf->line(5,$fila-0,210,$fila-0);
		//		$pdf->line(5,$fila+5,210,$fila+5);
		$fila=$fila+4;
		if($vec[11]==1)$tidi='Impresión diagnóstica';
		if($vec[11]==2)$tidi='Confirmado nuevo';
		if($vec[11]==3)$tidi='Confirmado repetido';
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'tipo diagnóstico: ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->Cell(23,4,$tidi,0,0,L);
		$fila=$fila+4;
		
		
$fila=$fila+$h;		
		$pdf->SetXY(5,$fila);		
		$pdf->Cell(20,4,'Principal: ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$vec[10].' - '.$desd1,0,L,0);
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
			$pdf->Cell(20,4,'Relacionado '.$t.':',0,0,L);			
			$pdf->SetXY(35,$fila);
			$pdf->MultiCell(180,4,$codcie2.' - '.$desd2,0,L,0);
			$t++;
			$fila=$pdf->GetY();
		}
		
		
	$fila=$fila+$h;	
	if($sintores=='S')$sinres='SI';
	if($sintores=='N')$sinres='NO';	
	if($sintopie=='S')$sinpie='SI';
	if($sintopie=='N')$sinpie='NO';	
	$pdf->SetXY(5,$fila);
	$pdf->Cell(80,4,'Sintomótico respiratorio   '.$sinres,0,0,L);	
	$pdf->Cell(80,4,'Sintomático de piel   '.$sinpie,0,0,L);
	
	$fila=$fila+4;
	
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
	$fila=$fila+$h;
		
		$pdf->SetXY(92,$fila);
	$pdf->SetFillColor($col);	
	$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(20,4,'PLAN DE TRATAMIENTO ',0,0,L);
		//$pdf->SetDrawColor(150);
		//$pdf->line(5,$fila,210,$fila);
		//$pdf->line(5,$fila+5,210,$fila+5);
		$fila=$fila+6;

		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Medicamentos ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$consomed,0,L,0);
		$fila=$pdf->GetY();
$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Ayudas DX ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$consoayu,0,L,0);
		$fila=$pdf->GetY();
$fila=$fila+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Remisiones ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$consoref,0,L,0);
		
	$bfor=mysql_query("select * from encabesadoformula where numc_efo='$numhisto'");
	while($rfor=mysql_fetch_array($bfor))
	{
		$proxi=$rfor[coen_efo];
		$obse=$rfor[obfo_efo];
		$repi=$rfor[repi_efo];
	}	
		
		/*
		$fila=$pdf->GetY();
		$fila=$fila+$h;	
		$pdf->SetXY(98,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(20,4,'RECOMENDACIONES GENERALES ',0,0,L);
		*/
		$fila=$pdf->GetY();
		
		
		if($fila>=220)
		{
			$fila=300;
			$pag=titulo($pdf,$fila,$vec,$pag,5,1);		
		}
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Proxima consulta ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$proxi,0,L,0);
		
		
		$fila=$fila+4;
		if($fila>=240)
		{
			$fila=300;
			$pag=titulo($pdf,$fila,$vec,$pag,5,1);		
		}
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Recomendaciones: ',0,0,L);
		$pdf->SetXY(35,$fila);
		$pdf->MultiCell(180,4,$obse,0,L,0);
		
		
		//$pdf->MultiCell(205,4,$contrare,0,J,0);
		
		$fila=$pdf->GetY();
		$fila=$fila+2;
		if($fila>=240)
		{
			$fila=300;
			$pag=titulo($pdf,$fila,$vec,$pag,5,1);		
		}
		
		//$fila=$fila+10;
		$firma="../firmas/".$codimedico.".jpg";
		if(file_exists($firma)){
		  $pdf->Image($firma,30,$fila,50,15,'','');
		}
		
		//$fila=$pdf->GetY();
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
	
	
	
	
	
	
	
	
	if($forpos=='1')
	{
		$bushisjus=mysql_query("select * from form_nop where iden_med ='$numhisto'");
		while($rpos=mysql_fetch_array($bushisjus))
		{
			$idennop=$rpos['iden_nop'];
			$buscajusti="select * from form_nop where iden_nop ='$idennop'";
			$resuljusti=Mysql_query($buscajusti);
			while($rowjusti=mysql_fetch_array($resuljusti))
			{
				$codproducto=$rowjusti['cmed_nop'];	
				$codiusu=$rowjusti['codi_usu'];		
				$idenmed=$rowjusti['iden_med'];
				$fechasol=$rowjusti['fech_pos'];
				$medico=$rowjusti['cod_medico'];
				$codcie10=$rowjusti['cod_cie10'];
				$fechadiag=$rowjusti['fcdx_nop'];	
				$casoclinico=$rowjusti['cacl_nop'];		
				$dosis=$rowjusti['dosi_nop'];
				$unidosis=$rowjusti['unid_nop'];
				$cantidad=$rowjusti['cant_nop'];
				$tiempo=$rowjusti['tiem_nop'];
				$riesgo=$rowjusti['ries_nop'];
				$altera=$rowjusti['alte_nop'];
				$efecsec=$rowjusti['efes_nop'];
				$tiemres=$rowjusti['tres_nop'];
				$efecadver=$rowjusti['efad_nop'];
				$sopbiblio=$rowjusti['sbib_nop'];
				$reacciones=$rowjusti['reac_nop'];
				$efectividad=$rowjusti['efec_nop'];
				$resultados=$rowjusti['resu_nop'];
				$alternapos=$rowjusti['alpo_nop'];
				$alterproto=$rowjusti['prot_nop'];
				$nomejoria=$rowjusti['nome_nop'];
				$otro=$rowjusti['otro_nop'];
				$cual=$rowjusti['cual_nop'];
				
				
				$fecdesde=$rowjusti['fdes_nop'];
				$fechasta=$rowjusti['fhas_nop'];
				$tiempoesti=$rowjusti['ties_nop'];
				$resumen=$rowjusti['rehc_nop'];
				$justificacion=$rowjusti['just_nop']; //analisis
				$tipohis=$rowjusti['tihi_nop'];
				$tiponopos=$rowjusti['tinp_nop'];
				
				
			}	
			$cadusua="select * from usuario where CODI_USU='$codiusu'";
			$resulusua=Mysql_query($cadusua);
			while($rowusua=mysql_fetch_array($resulusua))
			{
				$ape1usu=$rowusua['PAPE_USU'];
				$ape2usu=$rowusua['SAPE_USU'];
				$nom1usu=$rowusua['PNOM_USU'];
				$nom2usu=$rowusua['SNOM_USU'];
				$cedula=$rowusua['NROD_USU'];
				$tdocusu=$rowusua['TDOC_USU'];
				$fnacusu=$rowusua['FNAC_USU'];
				$sexousu=$rowusua['SEXO_USU'];
				$direusu=$rowusua['DIRE_USU'];
				$teleusu=$rowusua['TRES_USU'];
				$ciudusu=$rowusua['MRES_USU'];
				$tipoafi=$rowusua['TPAF_USU'];
				$nombre=$ape1usu.' '.$ape2usu.' '.$nom1usu.' '.$nom2usu;
			}
			$anos=edad($fnacusu);
			$cadcontra="select contrato.NEPS_CON from contrato,ingreso_hospitalario where contrato.CODI_CON=ingreso_hospitalario.contra_ing and ingreso_hospitalario.codius_ing='$codiusu'";
			$resulcontra=Mysql_query($cadcontra);
			while($rowcontra=mysql_fetch_array($resulcontra))
			{
				$nomcontrato=$rowcontra['NEPS_CON'];
			}	
			
			$anos=edad($fnacusu);
			
			$cadmedico="select *from medicos where cod_medi='$medico'";
			$resulmedico=Mysql_query($cadmedico);
			while($rowmedico=mysql_fetch_array($resulmedico))
			{
				$nommedico=$rowmedico['nom_medi'];
				$especial=$rowmedico['espe_med'];
				$regmedico=$rowmedico['reg_medi'];
				$telemedico=$rowmedico['telf_medi'];
				$dirmedico=$rowmedico['dir__medi'];
				$ced_medi=$rowmedico['ced_medi'];
				$tipodocmedi=$rowmedico['tido_medi'];
			}
			$cadmedico="select *from destipos where codi_des='$especial'";
			$resulmedico=Mysql_query($cadmedico);
			while($rowmedico=mysql_fetch_array($resulmedico))
			{       
				$especialidad=$rowmedico['nomb_des'];		
			}
			
			$cadcie1="select nom_cie10 from cie_10 where cod_cie10='$codcie10'";
			$resulcie1=Mysql_query($cadcie1);
			while ($rowcie1=mysql_fetch_array($resulcie1))
			{
				$nomcie1=$rowcie1['nom_cie10'];
			}
			if($tiponopos=='M')
			{
				$cadmed="SELECT medicamentos2.codi_mdi, medicamentos2.ncsi_medi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa
				FROM forma_farmaceutica RIGHT JOIN medicamentos2 ON forma_farmaceutica.codi_ffa = medicamentos2.coff_mdi
				WHERE (((medicamentos2.codi_mdi)='$codproducto'))";
				$resulmed=Mysql_query($cadmed);
				while ($rowmed=mysql_fetch_array($resulmed))
				{
					$nompro=$rowmed['nomb_mdi'];
					$forma=$rowmed['desc_ffa'];
					$codint=$rowmed['ncsi_medi'];
					$nombcomer=$rowmed['noco_mdi'];
				}
			}
			if($tiponopos=='I')
			{
				$cadmed="SELECT insu_med.codi_ins, insu_med.codnue, insu_med.desc_ins
				FROM insu_med WHERE (((insu_med.codi_ins)='$codproducto'))";
				$resulmed=Mysql_query($cadmed);
				while ($rowmed=mysql_fetch_array($resulmed))
				{
					$nompro=$rowmed['desc_ins'];
					$codint=$rowmed['codnue'];
					$forma='';
					$nombcomer='';
				}
			}
			if($tiponopos=='P')
			{
				$cadmed="SELECT cups.codigo, cups.codi_cup, cups.descrip 
				FROM insu_med, cups WHERE (((cups.codigo)='$codproducto'))";
				$resulmed=Mysql_query($cadmed);
				while ($rowmed=mysql_fetch_array($resulmed))
				{
					$nompro=$rowmed['descrip'];
					$codint=$rowmed['codi_cup'];
					$forma='';
					$nombcomer='';
				}
			}
				
			
			$resriesgo1='';$resriesgo2='';
			if($riesgo=='S')$resriesgo1='X';
			else $resriesgo2='X';
			$resalterna='NO';
			if($alterna=='S')$resalterna='SI';	
			$resreacciones='';
			if($reacciones=='S')$resreacciones='X';
			$resefectividad='';
			if($efectividad=='S')$resefectividad='X';
			$resresultados='';
			if($resultados=='S')$resresultados='X';	
			$resalternapos='';
			if($alternapos=='S')$resalternapos='X';
			$resalterproto='';
			if($alterproto=='S')$resalterproto='X';
			$resnomejoria='';
			if($nomejoria=='S')$resnomejoria='X';
			$resotro='';
			if($otro=='S')$resotro='X';
			$diasol=substr($fechasol,8,2);
			$messol=substr($fechasol,5,2);
			$anosol=substr($fechasol,0,4);	
			$sexo1='';$sexo2='';
			if($sexousu=='M')$sexo2='X';
			if($sexousu=='F')$sexo1='X';
			
			$diades=substr($fecdesde,8,2);
			$mesdes=substr($fecdesde,5,2);
			$anodes=substr($fecdesde,0,4);	
			
			$diahas=substr($fechasta,8,2);
			$meshas=substr($fechasta,5,2);
			$anohas=substr($fechasta,0,4);	
			
			
				
			
			
			$pdf->AddPage();
			$fila_=0;			
						
			
			$pdf->Image('img\enca_justi.JPG',1,$fila_,210,0,'','');
			$pdf->Image('img\pie_justi.JPG',2,265,210,0,'','');
			$fila=18;				
			
			$pdf->SetFont('Arial','B',8);	
			$pdf->SetXY(5,$fila);
			$pdf->SetFillColor(223,239,255);
			$pdf->rect(5,$fila,105,4,F);
			$pdf->Cell(105,4,'Información de la solicitud',1,0,L);
			
			$pdf->Cell(105,4,'Favor leer cada uno de los encabezados y diligenciar',0,0,L);	
			
			$pdf->SetFont('Arial','',8);
			$fila=$fila+4;				
			$pdf->SetXY(5,$fila);
			$pdf->Cell(45,4,'Fecha de diligenciamiento',1,0,C);	
			$pdf->Cell(60,4,'Número de autorización',1,0,C);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(105,4,'puntualmente en cada campo la información solicitada.',0,0,L);
			$pdf->SetFont('Arial','',8);			
			$fila=$fila+4;	
			$pdf->SetXY(5,$fila);
			$pdf->Cell(15,4,$diasol,1,0,C);
			$pdf->Cell(15,4,$messol,1,0,C);	
			$pdf->Cell(15,4,$anosol,1,0,C);	
			
			$pdf->Cell(60,8,$idenmed,1,0,C);
			$pdf->SetFont('Arial','',6);			
			$pdf->Cell(105,4,'          *  CUPS: Clasificación única de procedimientos en salud',0,0,L);			
			$fila=$fila+4;
			$pdf->SetXY(110,$fila);
			$pdf->Cell(105,4,'             CUM: Clasificación única de medicamentos',0,0,L);
			
			
			//$fila=$fila+4;

			$pdf->SetFont('Arial','',6);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(15,4,'DD',1,0,C);
			$pdf->Cell(15,4,'MM',1,0,C);	
			$pdf->Cell(15,4,'AAAA',1,0,C);

			$fila=$fila+4;	
			
			$pdf->SetFont('Arial','B',8);	
			$pdf->SetXY(5,$fila);
			$pdf->SetFillColor(223,239,255);
			$pdf->rect(5,$fila,210,4,F);
			$pdf->Cell(210,4,'Información del usuario',1,0,L);	
			
			$pdf->SetFont('Arial','',8);	
			$fila=$fila+4;				
			$pdf->SetXY(5,$fila);
			$pdf->Cell(53,8,$ape1usu.' '.$ape2usu,1,0,C);	
			$pdf->Cell(52,8,$nom1usu.' '.$nom2usu,1,0,C);	
			
			
			$pdf->Cell(65,4,'Documento de identidad',1,0,C);
			$pdf->Cell(20,4,'Edad',1,0,C);
			$pdf->Cell(20,4,'Sexo',1,0,C);
			$fila=$fila+4;
			$pdf->SetXY(110,$fila);
			
			
			$pdf->Cell(15,4,$tdocusu,1,0,C);
			$pdf->Cell(50,4,$cedula,1,0,C);
			$pdf->Cell(20,4,$anos,1,0,C);			
			$pdf->Cell(10,4,$sexo1,1,0,C);
			$pdf->Cell(10,4,$sexo2,1,0,C);
			
			
			
			$fila=$fila+4;				
			$pdf->SetXY(5,$fila);
			$pdf->Cell(53,4,'Apellidos',1,0,C);	
			$pdf->Cell(52,4,'Nombre(s)',1,0,C);
			$pdf->Cell(15,4,'Tipo',1,0,C);
			$pdf->Cell(50,4,'Número',1,0,C);
			$pdf->Cell(20,4,'Años',1,0,C);
			$pdf->Cell(10,4,'F',1,0,C);
			$pdf->Cell(10,4,'M',1,0,C);
			
			$fila=$fila+4;				
			$pdf->SetXY(5,$fila);
			$pdf->Cell(75,4,'Dirección',1,0,C);	
			$pdf->Cell(30,4,'No. telefónico',1,0,C);
			$pdf->Cell(40,4,'Ciudad',1,0,C);
			$pdf->Cell(65,4,'Número de afiliación',1,0,C);
			
			$fila=$fila+4;				
			$pdf->SetXY(5,$fila);
			$pdf->Cell(75,4,$direusu,1,0,C);	
			$pdf->Cell(30,4,$teleusu,1,0,C);
			$pdf->Cell(40,4,$ciudusu,1,0,C);
			$pdf->Cell(65,4,$cedula,1,0,C);
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','B',8);	
			$pdf->SetXY(5,$fila);
			$pdf->SetFillColor(223,239,255);
			$pdf->rect(5,$fila,210,4,F);
			$pdf->Cell(210,4,'Medicamento, Procedimiento o Insumo NO POS solicitado',1,0,L);
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);	
			$pdf->SetXY(5,$fila);
			$pdf->Cell(150,4,'Principio activo del medicamento nombre genérico del procedimiento o insumo',1,0,L);			
			$pdf->Cell(60,4,'Concentración del medicamento',1,0,L);
			
						
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(150,4,$nompro,1,0,L);			
			$pdf->Cell(60,4,'',1,0,L);
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(55,4,'CUM o CUPS*',1,0,L);			
			$pdf->Cell(55,4,'Forma farmacéutica o Descripción',1,0,L);
			$pdf->Cell(50,4,'Días del tratamiento',1,0,L);
			$pdf->Cell(50,4,'Dosis por día',1,0,L);
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(55,4,$codint,1,0,L);			
			$pdf->Cell(55,4,$forma,1,0,L);
			$pdf->Cell(50,4,$tiempo,1,0,L);
			$pdf->Cell(50,4,$dosis.' '.$unidosis,1,0,L);
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','B',8);	
			$pdf->SetXY(5,$fila);
			$pdf->SetFillColor(223,239,255);
			$pdf->rect(5,$fila,210,4,F);
			$pdf->Cell(210,4,'Campos de diligenciamiento exclusivo del medico tratante',1,0,C);
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','I',8);	
			$pdf->SetXY(5,$fila);
			$pdf->SetFillColor(223,239,255);
			$pdf->rect(5,$fila,210,8,F);
			$pdf->MultiCell(210,4,'En su calidad de médico tratante del usuario anteriormente identificado, es necesario que diligencie completamente los siguientes campos de información del formato con el propósito de brindar la mayor cantidad de información posible al Comité Técnico Científico.',1,L,0);
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','B',8);	
			$pdf->SetXY(5,$fila);
			$pdf->SetFillColor(223,239,255);
			$pdf->rect(5,$fila,210,4,F);
			$pdf->Cell(210,4,'Campos de diligenciamiento exclusivo del medico tratante',1,0,L);
			
			$pdf->SetFont('Arial','',8);	
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(105,8,$nommedico,1,0,L);			
			$pdf->Cell(65,4,'Documento de identidad',1,0,L);
			$pdf->Cell(40,4,'Registro Médico',1,0,L);
			$fila=$fila+4;
			$pdf->SetXY(110,$fila);
			$pdf->Cell(15,4,$tipodocmedi,1,0,L);			
			$pdf->Cell(50,4,$ced_medi,1,0,L);
			$pdf->Cell(40,4,$regmedico,1,0,L);
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(105,4,'Nombre',1,0,L);			
			$pdf->Cell(15,4,'Tipo',1,0,L);
			$pdf->Cell(50,4,'Número',1,0,L);
			$pdf->Cell(40,4,'Número',1,0,L);
			
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(65,4,'Especialidad',1,0,L);			
			$pdf->Cell(65,4,'Dirección',1,0,L);
			$pdf->Cell(40,4,'Número telefónico',1,0,L);
			$pdf->Cell(40,4,'Ciudad',1,0,L);
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(65,4,$especialidad,1,0,L);			
			$pdf->Cell(65,4,$dirmedico,1,0,L);
			$pdf->Cell(40,4,$telemedico,1,0,L);
			$pdf->Cell(40,4,'',1,0,L);
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','B',8);	
			$pdf->SetXY(5,$fila);
			$pdf->SetFillColor(223,239,255);
			$pdf->rect(5,$fila,210,4,F);
			$pdf->Cell(210,4,'Medicamento o Procedimiento o Insumo equivalente en el POS (para efecto de recobro ante el FOSYGA)',1,0,L);
			
			$fila=$fila+4;
			$pdf->rect(5,$fila,75,8);
			$pdf->rect(80,$fila,40,8);
			$pdf->rect(120,$fila,40,8);
			
			$pdf->SetXY(5,$fila);
			$pdf->Cell(75,4,'Principio activo del medicamento nombre genérico',0,0,C);			
			$pdf->Cell(40,4,'Concentración del',0,0,C);
			$pdf->Cell(40,4,'Forma farmacética o',0,0,C);
			$pdf->Cell(30,8,'Días del tratamiento',1,0,C);
			$pdf->Cell(25,8,'Dosis por día',1,0,C);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(75,4,'del procedimiento o insumo',0,0,C);			
			$pdf->Cell(40,4,'medicamento',0,0,C);
			$pdf->Cell(40,4,'Descripción',0,0,C);
			
			for($j=0;$j<2;$j++)
			{
				$vede[$j][0]='';
				$vede[$j][1]='';
				$vede[$j][2]='';
			}
			
			$j=0;
			$busdet=mysql_query("select * from deta_pos where iden_nop='$idennop'");
			while($rdet=mysql_fetch_array($busdet))
			{
				$prindet=$rdet['papo_pos'];
				$dosisdet=$rdet['dopo_pos'];
				$can=$rdet['tepo_pos'];
				$vede[$j][0]=$prindet;
				$vede[$j][1]=$can;
				$vede[$j][2]=$dosisdet;
				$j++;		
			}
			for($j=0;$j<2;$j++)
			{
				$fila=$fila+4;
				$prindet=$vede[$j][0];
				$dosisdet=$vede[$j][1];
				$can=$vede[$j][2];
				$pdf->SetXY(5,$fila);
				$pdf->Cell(75,4,$prindet,1,0,C);			
				$pdf->Cell(40,4,'',1,0,C);
				$pdf->Cell(40,4,'',1,0,C);
				$pdf->Cell(30,4,$can,1,0,C);
				$pdf->Cell(25,4,$dosisdet,1,0,C);
			}
						
			$fila=$fila+4;
			$pdf->SetFont('Arial','B',8);	
			$pdf->SetXY(5,$fila);
			$pdf->SetFillColor(223,239,255);			
			$pdf->rect(5,$fila,90,16,F);
			$pdf->rect(95,$fila,120,8,F);			
			
			$pdf->rect(5,$fila,90,16);
			$pdf->rect(95,$fila,120,4);			
			
			$pdf->SetXY(95,$fila);
			$pdf->Cell(75,4,'Duración del tratamiento',0,0,C);
			$pdf->SetFont('Arial','',8);
			
			$pdf->SetFont('Arial','',8);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(90,4,'Diagnóstico, evolución, clasificación y estado de la patología (Realice',0,0,L);
			$pdf->Cell(45,4,'Desde',1,0,C);
			$pdf->Cell(45,4,'Hasta',1,0,C);
			$pdf->Cell(30,4,'Tiempo estimado',1,0,C);
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(90,4,'una descripción del estado actual y / o evolución de la enfermedad)',0,0,L);
			$pdf->Cell(15,4,$diades,1,0,C);
			$pdf->Cell(15,4,$mesdes,1,0,C);
			$pdf->Cell(15,4,$anodes,1,0,C);
			$pdf->Cell(15,4,$diahas,1,0,C);
			$pdf->Cell(15,4,$meshas,1,0,C);
			$pdf->Cell(15,4,$anohas,1,0,C);
			$pdf->Cell(30,4,$tiempoesti,1,0,C);
			
			$fila=$fila+4;
			$pdf->SetXY(95,$fila);
			$pdf->Cell(15,4,'DD',1,0,C);
			$pdf->Cell(15,4,'MM',1,0,C);
			$pdf->Cell(15,4,'AAAA',1,0,C);
			$pdf->Cell(15,4,'DD',1,0,C);
			$pdf->Cell(15,4,'MM',1,0,C);
			$pdf->Cell(15,4,'AA',1,0,C);
			$pdf->Cell(30,4,'Meses',1,0,C);
			
			
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','B',8);	
			$pdf->SetXY(5,$fila);
			$pdf->SetFillColor(223,239,255);
			$pdf->rect(5,$fila,70,4,F);
			$pdf->Cell(70,4,'Diagnóstico:',1,0,L);
			$pdf->Cell(140,4,'',1,0,L);
			$pdf->SetFont('Arial','B',8);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(210,4,$nomcie1,1,L,0);
			
			$fila=$pdf->GetY();
			$pdf->SetFont('Arial','B',8);	
			$pdf->SetXY(5,$fila);
			$pdf->SetFillColor(223,239,255);
			$pdf->rect(5,$fila,70,4,F);
			$pdf->Cell(70,4,'Resumen de la historia clínica:',1,0,L);
			$pdf->Cell(140,4,'',1,0,L);
			$pdf->SetFont('Arial','B',8);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(210,4,$resumen,1,L,0);				
				
			$fila=$pdf->GetY();
			
			$pdf->SetFont('Arial','B',8);	
			$pdf->SetXY(5,$fila);
			$pdf->SetFillColor(223,239,255);			
			$pdf->rect(5,$fila,70,8,F);
			$pdf->SetFont('Arial','B',8);
			
			$pdf->Cell(70,4,'Justificación del Medicamento, Procedimiento o',0,0,L);			
			$pdf->Cell(140,8,'?La NO utilización pone en riesgo inmininete la vida y salud del paciente? SI ['.$resriesgo1.' ] NO ['.$resriesgo2.' ]',1,0,L);
			$pdf->rect(5,$fila,70,8);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(70,4,'Insumo NO POS solicitado',0,0,L);
			
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(210,4,'Descripción: '.$justificacion,1,L,0);
			
			
			$fila=$pdf->GetY();
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(210,4,'Soporte Bibliografico: ',1,L,0);
			
			
			$fila=$fila+4;
			
			$pdf->SetFillColor(223,239,255);			
			$pdf->rect(5,$fila,210,28,F);
			$pdf->rect(5,$fila,210,28);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(210,4,'Apreciado usuario, esta solicitud debe ser radicada en su EPS o el servicio farmaceutico si está afiliado a Magisterio junto con los',0,0,L);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(210,4,'siguientes documentos soporte:',0,0,L);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(210,4,'1. Formula médica original completamente diligenciada, con firma y sello del médico tratante, legible.',0,0,L);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(210,4,'2. Fotocopia de la Epicrisis completa y actualizada.',0,0,L);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(210,4,'3. Fotocopia de cedula de ciudadania.',0,0,L);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(210,4,'EL COMITÉ TÉCNICO CIENTÍFICO NO PODRÁ ADELANTAR EL ESTUDIO DEL CASO SIN EL SUMINISTRO COMPLETO DE LA',0,0,C);
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(210,4,'INFORMACIÓN Y DOCUMENTACIÓN ANTERIORMENTE INDICADA.',0,0,C);
				
				
			$fila=$fila+10;
			
			$firma="../firmas/".$codimedico.".jpg";
			if(file_exists($firma))
			{
			  $pdf->Image($firma,5,$fila,50,15,'','');
			}
			
			$fila=$fila+10;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(45,5,'____________________________________',0,0,L);				
			$fila=$fila+4;
			$pdf->SetXY(5,$fila);				
			$pdf->Cell(45,5,'Firma y sello del médico tratante',0,0,L);
			$fila=$fila+4;	
			$pdf->SetXY(5,$fila);
			$pdf->Cell(45,5,'Documento de Identificación: '.$ced_medi,0,0,L);
		}
	}
	
	
	if($solqui==1)
	{		
		$bussol=mysql_query("select * from solicitud_quirofano where nhis_solquiro ='$numhisto'");
		while($rqui=mysql_fetch_array($bussol))		
		{			
			for($i=0;$i<2;$i++)
			{
				if($i==0 || $fila>130)
				{
					$fila=300;
					$pag=titulo($pdf,$fila,$vec,$pag,6,1);
					$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
					$fila=40;				
				}
				else
				{
					$pag=titulo($pdf,$fila,$vec,$pag,6,2);
					$pdf->Image('img\PIE1.JPG',2,123,210,0,'','');
					$fila=$fila+40;
				}					
				
				$idensol=$rqui['iden_solquiro'];			
				$busidensol="SELECT solicitud_quirofano.iden_solquiro, solicitud_quirofano.diag_solquiro, solicitud_quirofano.cups_solquiro, solicitud_quirofano.ticiru_solquiro, solicitud_quirofano.tianes_solquiro, solicitud_quirofano.fecsol_solquiro, solicitud_quirofano.horasol_solquiro, solicitud_quirofano.reayud_solquiro, solicitud_quirofano.sangre_solquiro, solicitud_quirofano.reequi_solquiro, solicitud_quirofano.duracion_solquiro, solicitud_quirofano.reseruci_solquiro, solicitud_quirofano.rematerial_solquiro, solicitud_quirofano.material_solquiro, solicitud_quirofano.origen_solquiro, encabesadohistoria.cous_ehi, encabesadohistoria.cont_ehi, consultaprincipal.come_cpl
				FROM (solicitud_quirofano INNER JOIN encabesadohistoria ON solicitud_quirofano.nhis_solquiro = encabesadohistoria.numc_ehi) INNER JOIN consultaprincipal ON solicitud_quirofano.nhis_solquiro = consultaprincipal.numc_cpl
				WHERE (((solicitud_quirofano.iden_solquiro)='$idensol'))";
				$resuljusti=Mysql_query($busidensol);
				while($rowsol=mysql_fetch_array($resuljusti))
				{
					$diag_solquiro=$rowsol['diag_solquiro'];		
					$cups_solquiro=$rowsol['cups_solquiro'];
					$ticiru_solquiro=$rowsol['ticiru_solquiro'];
					$tianes_solquiro=$rowsol['tianes_solquiro'];
					$fecsol_solquiro=$rowsol['fecsol_solquiro'];
					$horasol_solquiro=$rowsol['horasol_solquiro'];	
					$reayud_solquiro=$rowsol['reayud_solquiro'];		
					$sangre_solquiro=$rowsol['sangre_solquiro'];				
					$reequi_solquiro=$rowsol['reequi_solquiro'];
					$duracion_solquiro=$rowsol['duracion_solquiro'];
					$reseruci_solquiro=$rowsol['reseruci_solquiro'];
					$rematerial_solquiro=$rowsol['rematerial_solquiro'];
					$material_solquiro=$rowsol['material_solquiro'];
					$origen_solquiro=$rowsol['origen_solquiro'];					
					$cmedico=$rowsol['come_cpl'];	
				}
				$pdf->SetFont('Arial','B',8);
				if($ticiru_solquiro=='U')$desciru='URGENCIAS';
				if($ticiru_solquiro=='E')$desciru='ELECTIVA';
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'CIRUGIA',1,0,L);
				$pdf->Cell(135,4,$desciru,1,0,L);
				
				$banes=mysql_query("select * from destipos where codi_des='$tianes_solquiro'");
				$ranes=mysql_fetch_array($banes);
				$desanes=$ranes['nomb_des'];
				
				
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'ANESTESIA',1,0,L);
				$pdf->Cell(135,4,$desanes,1,0,L);
				
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'FECHA DE CIRUGIA',1,0,L);
				$pdf->Cell(135,4,$fecsol_solquiro,1,0,L);
				
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'HORA DE CIRUGIA',1,0,L);
				$pdf->Cell(135,4,$horasol_solquiro,1,0,L);
				
				$cadcie1=mysql_query("select * from cie_10 where cod_cie10='$diag_solquiro'");
				while ($rowcie1=mysql_fetch_array($cadcie1))
				{
					$nomcie1=$rowcie1['nom_cie10'];
				}
				
				$resulmed=Mysql_query("SELECT * FROM cups WHERE codigo='$cups_solquiro'");
				while ($rowmed=mysql_fetch_array($resulmed))
				{
					$nompro=$rowmed['descrip'];		
					$codcup=$rowmed['codi_cup'];		
				}
				
				
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'DIAGNOSTICO PREQUIRURGICO',1,0,L);
				$pdf->MultiCell(135,4,$diag_solquiro.' - '.$nomcie1,1,L,0);
				
				
				$fila=$fila+4;
				$fila1=$fila;
				$pdf->SetXY(65,$fila);				
				$pdf->MultiCell(135,4,$codcup.' - '.$nompro,1,L,0);
				$fila=$pdf->GetY();
				$file2=$fila-$fila1;
				$pdf->SetXY(15,$fila1);
				$pdf->Cell(50,$file2,'CIRUGIA',1,0,L);
				
				$resulmedico=Mysql_query("select * from medicos where cod_medi='$cmedico'");
				while($rowmedico=mysql_fetch_array($resulmedico))
				{
					$nommedico=$rowmedico['nom_medi'];
					$especial=$rowmedico['espe_med'];
					$regmedico=$rowmedico['reg_medi'];
					$telemedico=$rowmedico['telf_medi'];
					$dirmedico=$rowmedico['dir__medi'];
					$ced_medi=$rowmedico['ced_medi'];
					$tipodocmedi=$rowmedico['tido_medi'];
				}			
				
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'CIRUJANO',1,0,L);
				$pdf->Cell(135,4,$nommedico,1,0,L);				
				
				if($reayud_solquiro=='S')$reayu='SI';
				if($reayud_solquiro=='N')$reayu='NO';				
				
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'REQUIERE AYUDANTE',1,0,L);
				$pdf->Cell(135,4,$reayu,1,0,L);
				
				if($reequi_solquiro=='S')$reequi='SI';
				if($reequi_solquiro=='N')$reequi='NO';
				
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'REQUIERE EQUIPO RX',1,0,L);
				$pdf->Cell(135,4,$reequi,1,0,L);				
				
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'SANGRE',1,0,L);
				$pdf->Cell(135,4,$sangre_solquiro.' Unidades',1,0,L);				
								
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'DURACION',1,0,L);
				$pdf->Cell(135,4,$duracion_solquiro,1,0,L);
				
				if($reequi_solquiro=='S')$reeuci='SI';
				if($reequi_solquiro=='N')$reeuci='NO';
				
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'RESERVA UCI',1,0,L);
				$pdf->Cell(135,4,$reeuci,1,0,L);
				
				if($rematerial_solquiro=='S')$reemat='SI';
				if($rematerial_solquiro=='N')$reemat='NO';
				
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'REQUIERE MATERIAL ESPECIAL',1,0,L);
				$pdf->Cell(135,4,$reemat,1,0,L);
				
				$fila=$fila+4;
				$fila1=$fila;
				$pdf->SetXY(65,$fila);				
				$pdf->MultiCell(135,4,$material_solquiro.' - '.$nompro,1,L,0);
				$fila=$pdf->GetY();
				$file2=$fila-$fila1;
				$pdf->SetXY(15,$fila1);
				$pdf->Cell(50,$file2,'?CUAL?',1,0,L);
				
				$fila=$fila+5;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,5,'____________________________________',0,0,L);
				$pdf->SetXY(80,$fila);
				$pdf->Cell(50,5,'____________________________________',0,0,L);	
				$pdf->SetXY(145,$fila);
				$pdf->Cell(50,5,'____________________________________',0,0,L);
				
				$fila=$fila+5;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,5,'Vo. Bo. CIRUJANO',0,0,C);
				$pdf->SetXY(80,$fila);
				$pdf->Cell(50,5,'Vo. Bo. ANESTESIOLOGO',0,0,C);	
				$pdf->SetXY(145,$fila);
				$pdf->Cell(50,5,'AUTORIZADO',0,0,C);				
			}			
        }        
                    /////////FORMATO DE CONSENTIMIENTO INFORMADO
		for($i=0;$i<1;$i++)
		{
				if($i==0 || $fila>130)
				{
					$fila=300;
					$pag=titulo($pdf,$fila,$vec,$pag,21,1);
					$pdf->Image('img\PIE1.JPG',2,265,210,0,'','');
					$fila=40;				
				}
				else
				{
					$pag=titulo($pdf,$fila,$vec,$pag,21,2);
					$pdf->Image('img\PIE1.JPG',2,123,210,0,'','');
					$fila=$fila+40;
				}
				$busidensol="SELECT encabesadohistoria.nomb_ehi, encabesadohistoria.idus_ehi, solicitud_quirofano.cups_solquiro, solicitud_quirofano.ticiru_solquiro, 
				solicitud_quirofano.tianes_solquiro, solicitud_quirofano.fecsol_solquiro, solicitud_quirofano.horasol_solquiro, 
				solicitud_quirofano.reayud_solquiro, solicitud_quirofano.sangre_solquiro, solicitud_quirofano.reequi_solquiro, 
				solicitud_quirofano.duracion_solquiro, solicitud_quirofano.reseruci_solquiro, solicitud_quirofano.rematerial_solquiro,
				solicitud_quirofano.material_solquiro, solicitud_quirofano.origen_solquiro, encabesadohistoria.cous_ehi,
				solicitud_quirofano.cnsi_solquiro, solicitud_quirofano.risg_solquiro,  solicitud_quirofano.bnf_solquiro,solicitud_quirofano.cnsi_solquiro,
				encabesadohistoria.cont_ehi, consultaprincipal.come_cpl,consultaprincipal.come_cpl
				FROM (solicitud_quirofano INNER JOIN encabesadohistoria ON solicitud_quirofano.nhis_solquiro = encabesadohistoria.numc_ehi) INNER JOIN consultaprincipal ON solicitud_quirofano.nhis_solquiro = consultaprincipal.numc_cpl
				WHERE (((solicitud_quirofano.iden_solquiro)='$idensol'))";
				$resuljusti=Mysql_query($busidensol);
				while($rowsol=mysql_fetch_array($resuljusti))
				{
					$fecsol_solquiro=$rowsol['fecsol_solquiro'];
					$cups_solquiro=$rowsol['cups_solquiro'];	
					$risg_solquiro=$rowsol['risg_solquiro'];
					$material_solquiro=$rowsol['material_solquiro'];
                                        $beneficios=$rowsol['bnf_solquiro'];
					$consiste=$rowsol['cnsi_solquiro'];					
					$cmedico=$rowsol['come_cpl'];
					$nom_cinf=$rowsol['nomb_ehi'];
					$ident=$rowsol['idus_ehi'];
					$come_cpl =$rowsol['come_cpl'];
				}
				$medi_cin=mysql_query("SELECT  nom_medi, are_medi   FROM  medicos  WHERE  cod_medi='$come_cpl'");
				$row_cin=mysql_fetch_array($medi_cin);
				$nom_medi=$row_cin['nom_medi'];
				$are_medi=$row_cin['are_medi'];			
				$cups_cin=mysql_query("SELECT  codigo, codi_cup, descrip   FROM  cups   WHERE  codigo='$cups_solquiro'");
				$row_ccin=mysql_fetch_array($cups_cin);
				$nom_cups=$row_ccin['descrip'];
				$codi_cup=$row_ccin['codi_cup'];                               
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(15,$fila+2);
				//$pdf->MultiCell(205,4,$desinca,1,L,0);
				$pdf->MultiCell(180,4,'Yo,  '.$nom_cinf.' , Mayor de Edad, Identificado con C.C. No. '.$ident.'  y Como: Paciente_____, o como: Responsable _____,'
				. ' del o la Paciente________________________, identificado(a) con C.C. o T.I. No.______________, Autorizo al Dr.(a). '.$nom_medi.' , con profesion'
				. ' o Especialidad '. $are_medi . '  , para la realizacion del Procedimiento  '. $codi_cup.' - '.$nom_cups,0,1,0);
                $fila=$pdf->GetY()+4;                         
				$pdf->SetXY(15,$fila);						  
				$pdf->MultiCell(180,4,'Que Consiste en:   '.$consiste,0,1,0);				
				$fila=$pdf->GetY()+4;                         
				$pdf->SetXY(15,$fila);						  
				$pdf->MultiCell(180,4,'Teniendo en cuenta que he sido informado sobre los riesgos y beneficios que se puede presentar, siendo estos:',0,1,0);
                $fila=$pdf->GetY()+10;
				$pdf->SetXY(15,$fila);	
				$pdf->Cell(92,4,'RIESGOS',1,0,C);	
				$pdf->Cell(92,4,'BENEFICIOS',1,0,C);
				$fila=$fila+4;				
				$pdf->SetXY(15,$fila);
				$pdf->MultiCell(92,4,$risg_solquiro,0,1,0);			        
				$fila1=$pdf->GetY();					
				$pdf->SetXY(107,$fila);					
				$pdf->MultiCell(92,4,$beneficios,0,1,0);
				$fila2=$pdf->GetY();						   
				if($fila2>=$fila1)$alto=$fila2-$fila;	
				if($fila1>$fila2)$alto=$fila1-$fila;
					//$alto=$alto+10;	   
				$pdf->Rect(15, $fila, 92, $alto);
				$pdf->Rect(107, $fila, 92, $alto);
			    $fila=$fila+$alto+10;
			    $pdf->SetXY(15,$fila);					
				$pdf->MultiCell(180,4,$alto.' Comprendo y acepto que durante el procedimietno pueden aparecer circustancias imprevisibles o inesperadas que puedan requerir una extension del procedimiento original o la realizacion de otro procedimiento no mencionado arriba.',0,1,0);
				$fila=$pdf->GetY();
				$pdf->SetXY(15,$fila);
				$pdf->MultiCell(180,4,'Al firmar este documento reconozco que los he leido y explicado y que comprendo perfectamente su contenido.Se me han dado amplias oportunidades de formular preguntas y que todas las preguntas que he formulado han sido respondidas o explicadas en forma satisfactoria.',0,1,0);
				$fila=$pdf->GetY()+4;
				$pdf->SetXY(15,$fila);
				$pdf->MultiCell(180,4,'Acepto que la medicina no es una ciencia exacta y que no se me han garantizado los resultados que se esperaban de la intervesion quirurgica o procedimientos diagnosticados o terapeuticos, en el sentido de que la practica de la intervension o procedimiento que requiero compromete una actividad de medio, pero no de resultados.',0,1,0);
				$fila=$pdf->GetY();
				$pdf->SetXY(15,$fila);
				$pdf->MultiCell(180,4,'Comprendiendo estas limitaciones, doy mi consentimiento para la realizacion del procedimiento y firmo a Continuacion:',0,1,0);
				$sql_text= mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='D001'");
			    $row_text=mysql_fetch_array($sql_text);
			    $texto=$row_text[nomb_des];
			    $fila=$pdf->GetY()+10;
			    $pdf->SetXY(15,$fila);
			    $pdf->MultiCell(180,4,$texto,0,1,0);
			   
			$fila=$pdf->GetY()+10;

			$pdf->SetXY(15,$fila+2);	
			$pdf->Cell(20,4,'Firma Paciente:_______________________________________  C.C.No.     '.$ident.'         o Huella  _______________',0,0,L);
			// $fila=$pdf->GetY()+10;
			//$pdf->SetXY(15,$fila+2);	
			//$pdf->Cell(20,4,'C.C. No.'.$ident. ' De ____________________________                                         Huella _______________',0,0,L);
			$fila=$pdf->GetY()+10;
			$pdf->SetXY(15,$fila+2);	
			$pdf->Cell(20,4,'Testigo:_______________________________________   C.C. No.  _______________________  Parentesco   ______________',0,0,L);
			//$fila=$pdf->GetY()+10;
			//$pdf->SetXY(15,$fila+2);	
			//$pdf->Cell(20,4,'C.C. No.__________________Parentesco _______________',0,0,L);


			$fila=$pdf->GetY()+15;
			$pdf->SetXY(15,$fila);
			$pdf->Cell(45,5,'El paciente NO puede firmar por: _________________________________________________________________',0,0,L);
			 
			 
			$fila=$pdf->GetY()+10;
			$firma="../firmas/".$codimedico.".jpg";
			if(file_exists($firma))
			{
				$pdf->Image($firma,30,$fila,50,15,'','');
			}
			$fila=$fila+10;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,'____________________________________',0,0,L);
			$fila=$fila+4;
			$pdf->SetXY(25,$fila);
			$pdf->Cell(45,5,$nombmedico,0,0,L); 		   
			$pdf->SetXY(120,$fila);
			$pdf->Cell(150,5,'Registro medico: '.$regimedico,0,0,L);
        }
	}	
	//}
	
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
			
			/*
			$pdf->SetXY(5,$fila);
			$pdf->Cell(10,5,'Anï¿½lisis',0,0,L);
			$pdf->SetXY(25,$fila);
			$pdf->MultiCell(190,4,$anal,0,L,0);
			*/
			
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
			
			/*
			$pdf->SetXY(5,$fila);
			$pdf->Cell(10,5,'Anï¿½lisis',0,0,L);
			$pdf->SetXY(25,$fila);
			$pdf->MultiCell(190,4,$anal,0,L,0);
			*/
			
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
}
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
		$pdf_->Image('img\enca_formula.JPG',1,$fila_,210,0,'','');
		$pdf_->Image('img\controlado.png',203,100,7,30,'','');
	}
	if($m==5)	//historia
	{
		
		$formato='FRCME-01';
		$imaenca="../funciones_php/img/logo_encabezado.JPG";
		include ('../funciones_php/formatos.php');
		
		/*
		if($vec_[20]=='04')
		{
			$pdf_->Image('img\enca_histo.JPG',1,$fila_,210,0,'','');
			//$pdf_->Image('img\controlado.png',203,130,7,30,'','');
		}
		else
		{
			$pdf_->Image('img\enca_histo.JPG',1,$fila_,210,0,'','');
			//$pdf_->Image('img\controlado.png',203,100,7,30,'','');
		}		
		//$pdf_->Image('img\enca_histo.JPG',205,100,7,30,'','');
		*/
	}
	
	
	if($m==6)	//solicitud quirofano
	{
		$pdf_->Image('img\enca_quiro.JPG',1,$fila_,210,0,'','');
		$pdf_->Image('img\controlado.png',203,100,7,30,'','');
	}
	if($m==7)	//incapacidad
	{
		$pdf_->Image('img\enca_inca.JPG',1,$fila_,210,0,'','');
		$pdf_->Image('img\controlado.png',203,100,7,30,'','');
	}
	
	if($m==8)	//recomendaciones
	{
		
	}
	
	if($m==21)	//consentimiento informado
	{
		$pdf_->Image('img\enca_cinformado.jpg',1,$fila_,210,0,'','');
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
	$fila_=$fila_+3;
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
	$pdf_->SetXY(135,$fila_+20);
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
	$pdf_->Cell(20,5,$origencon,0);
	$col=200;
	$pdf_->SetFillColor($col);	
	$pdf_->rect(5,$fila_+32,205,5,F);
	
	if($m==8)
	{	
		$pdf_->SetXY(5,$fila_+32);		
		$pdf_->Cell(40,5,"Servicio: ".  $servicio,0);
		$pdf_->SetXY(150,$fila_+32);
                $pdf_->Cell(6,5,$tipodoc.':',0);
		$pdf_->SetXY(187,$fila_+32);
		$pdf_->Cell(40,5,"Hora: ".$horasa,0);
	}
	else
	{
		$pdf_->SetXY(5,$fila_+32);
		$pdf_->Cell(40,5,"Historia No. ".  $idenevo,0);
		$pdf_->SetXY(80,$fila_+32);
		$pdf_->Cell(40,5,"Servicio: ".  $servicio,0);
		$pdf_->SetXY(150,$fila_+32);
		$pdf_->Cell(40,5,"Fecha: ".$fecevo,0);
		$pdf_->SetXY(187,$fila_+32);
		$pdf_->Cell(40,5,"Hora: ".$horasa,0);
	}
	
	
	
	//$pdf_->line(5,$fila_+32,205,$fila_+32);
	//$pdf_->line(5,$fila_+37,205,$fila_+37);  
	if($m==5)$fila_=38;	
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
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en nï¿½meros enteros

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
	//5276036
	
//FUNCIONES PARA CONVERTIR NUMEROS A LETRAS	
	
	function unidad($numuero){
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

function decena($numdero){
	
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
			$numd = unidad($numdero);
	return $numd;
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