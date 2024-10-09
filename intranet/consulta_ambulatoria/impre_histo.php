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
	// localhost/intranet/consulta_ambulatoria/impre_histo.php
	set_time_limit (120);
	
	//$numhisto='11022541210113104034';	
	//$inca=1;
	//$med1=1;


	set_time_limit (120);
	$pdf=new FPDF('P','mm','Letter');
	$pdf->SetFont('Arial','',8);
	include ('php/conexion1.php');
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
	$blab=mysql_query("SELECT cups.codigo, cups.codi_cup, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, 
	detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre, detareferencia.dest_dre,
	detareferencia.fecha_estimada,detareferencia.tipo_cita, detareferencia.cita_dre
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
		$idcitaasig=$rlab['tipo_cita'];
		$fecha_estimada=$rlab['fecha_estimada'];
		$cita_dre=$rlab['cita_dre'];
		$mat2[$i][0]=$codi;
		$mat2[$i][1]=$diag;
		$mat2[$i][2]=$desc;
		$mat2[$i][3]=$obse;
		$mat2[$i][4]=$cant;
		$mat2[$i][5]=$dest;
		$mat2[$i][6]=$idcitaasig;
		$mat2[$i][7]=$fecha_estimada;
		$mat2[$i][8]=$cita_dre;
		$mat2[$i][9]=$codigo;
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
		$mat4[$i][7]=$tiem;
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
	
	
	$busu=mysql_query("SELECT encabesadohistoria.numc_ehi, encabesadohistoria.idus_ehi, encabesadohistoria.fnac_ehi,
	encabesadohistoria.feco_ehi, encabesadohistoria.nomb_ehi, municipio.NOMB_MUN, encabesadohistoria.sexo_ehi, 
	encabesadohistoria.fnac_ehi, areas.nom_areas, areas.cod_areas, consultaprincipal.radx_cpl, consultaprincipal.cod1_cpl, consultaprincipal.tidx_cpl, consultaprincipal.hosa_cpl, encabesadohistoria.cous_ehi, encabesadohistoria.telf_ehi, encabesadohistoria.origconsu_ehi AS oricon,
	consultaprincipal.cod1_cpl, consultaprincipal.inca_cpl, consultaprincipal.feinca_cpl,consultaprincipal.sire_cpl,consultaprincipal.sipi_cpl,
	encabesadohistoria.etni_ehi, encabesadohistoria.nedu_ehi, encabesadohistoria.ocup_ehi, encabesadohistoria.eciv_ehi, encabesadohistoria.dire_ehi, consultaprincipal.coti_cpl
	FROM ((encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) LEFT JOIN municipio ON encabesadohistoria.muat_ehi = municipio.CODI_MUN) INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas
	WHERE (((encabesadohistoria.numc_ehi)='$numhisto'))");

	
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
		
		$edadinca=$rusu['fnac_ehi'];
		
		
		$bdoc=mysql_query("select TDOC_USU, FNAC_USU, REGI_USU from usuario where CODI_USU='$cous'");
		while($rdoc=mysql_fetch_array($bdoc))
		{
			$vec[13]=$rdoc[TDOC_USU];
			$fnaci=$rdoc['FNAC_USU'];
			//$vec[7]=calculaedad($fnaci);
			$vec[33]=$rdoc['REGI_USU'];
		}
		$vec[7]=$rusu['fnac_ehi'];
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
	}
	
	$bconcit=mysql_query("SELECT contrato.NEPS_CON, encabesadohistoria.numc_ehi
	FROM encabesadohistoria INNER JOIN contrato ON encabesadohistoria.cont_ehi = contrato.CODI_CON
	WHERE (((encabesadohistoria.numc_ehi)='$numhisto'))");
	while($rconcit=mysql_fetch_array($bconcit))
	{
		$vec[5]=strtoupper($rconcit['NEPS_CON']);//$rowusu[neps_con];//$contrato
	}	
	
	$bmed=mysql_query("SELECT consultaprincipal.numc_cpl, medicos.cod_medi, medicos.nom_medi, medicos.reg_medi, medicos.espe_med
	FROM consultaprincipal INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi
	WHERE (((consultaprincipal.numc_cpl)='$numhisto'))");
	while($rmer=mysql_fetch_array($bmed))
	{
		$codimedico=$rmer['cod_medi'];
		$nombmedico=$rmer['nom_medi'];
		$regimedico=$rmer['reg_medi'];
		$codespecia=$rmer['espe_med'];		
		$bespe=mysql_query("select nomb_des from destipos where codi_des='$codespecia'");
		$respe=mysql_fetch_array($bespe);
		$especialidad=$respe['nomb_des'];
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
			//$pdf->MultiCell(190,4,$vec[10].' - '.$desd1,0,L,0);
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
			$i=0;
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
				$tipo_cita=$mat2[$n][6];
				$fecha_estimada=$mat2[$n][7];
				$idcitaasig=$mat2[$n][8];
				$codigo=$mat2[$n][9];				
				
				$bprepa=mysql_query("SELECT preparacion_cups.codi_cup, preparacion.cod_pre, preparacion.nom_pre,
				preparacion_cups.genero
				FROM preparacion_cups INNER JOIN preparacion ON preparacion_cups.preparacion = preparacion.cod_pre
				WHERE (((preparacion_cups.codi_cup)='$codi'))");
				while($rprepa=mysql_fetch_array($bprepa))
				{					
					$prepa[$i][0]=$rprepa['cod_pre'];
					$prepa[$i][1]=$rprepa['nom_pre'];
					$prepa[$i][2]=$rprepa['genero'];
					$i++;
				}
				$mensacita='';
				if(!empty($idcitaasig))
				{
					$bciasi=mysql_query("SELECT citas.id_cita, horarios.Fecha_horario, horarios.Hora_horario, horarios.dia_horario
					FROM horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario
					WHERE (((citas.id_cita)='$idcitaasig'));");					
					$rciasi=mysql_fetch_array($bciasi);
					$feccita=$rciasi['Fecha_horario'];
					if($feccita>='2022-04-01')
					{
						$horcita=substr($rciasi['Hora_horario'],11,5);					
						$fectex=fechatexto($feccita);
						$mensacita="CITA ASIGNADA PARA LABORATORIO PARA EL ".$fectex." A LAS ".$horcita;
					}
				}
				if($fecha_estimada!="0000-00-00" && $fecha_estimada>="2022-04-01")
				{
					$fectex=fechatexto($fecha_estimada);					
					$mensacita="SOLICITE SU CITA CON LABORATORIO A PARTIR DEL ".$fectex;				
				}				
				
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
			$fini=$i;
			
			$diag1=$vec[10];
			$bd1=mysql_query("select * from cie_10 where cod_cie10='$diag1'");
			while($rd1=mysql_fetch_array($bd1))
			{
				$desd1=$rd1['nom_cie10'];
			}
			if($diag1=='B24X')$desd1='';
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
			$fila=$fila+10;
			$pdf->SetXY(5,$fila);
			if($mensacita!='')
			{
				$pdf->SetFont('Arial','',12);
				$pdf->Cell(205,5,$mensacita,0,0,C);
				$pdf->SetFont('Arial','',8);
			}
			for($j=0;$j<$fini;$j++)
			{
				for($k=0;$k<$fini;$k++)
				{
					if($prepa[$j][0]>=$prepa[$k][0])
					{
						$aux1=$prepa[$j][0];
						$aux2=$prepa[$j][1];
						$aux3=$prepa[$j][1];
						$prepa[$j][0]=$prepa[$k][0];
						$prepa[$j][1]=$prepa[$k][1];
						$prepa[$j][2]=$prepa[$k][2];
						$prepa[$k][0]=$aux1;
						$prepa[$k][1]=$aux2;
						$prepa[$k][2]=$aux3;
					}
				}				
			}
			if($fini>0)
			{
				$fila=$fila+10;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(10,5,'PREPARACION',0,0,L);
				$fila=$fila+6;
				$pre=0;
				for($j=0;$j<$fini;$j++)
				{
					$codpre=$prepa[$j][0];
					$nompre=$prepa[$j][1];
					$genpre=$prepa[$j][2];
					if($genpre=='F')$gen="MUJERES";
					else if($genpre=='M')$gen="HOMBRES";
					else $gen="HOMBRES y MUJERES";
					
						
					if($pre!=$codpre)
					{
						$pdf->SetXY(5,$fila);
						$pdf->MultiCell(190,4,$gen.' '.$nompre,0,L,0);
						
						$fila=$pdf->GetY();
						$fila=$fila+2;
						$pre=$codpre;
					}	
					
				}
			}
			
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
			if($diag1=='B24X')$desd1='';			
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
		//}
	}
	
	
	if($med=='1')
	{
		for($i=0;$i<2;$i++)
		{
			if($i==0 || $fila>115)
			{
//cambio de tamaño e imagen
				$fila=300;
				$pag=tituloformu($pdf,$fila,$vec,$pag,4,1);
				//$pdf->Image('img\piemed2.jpg',3,260,202,16,'','');
				$fila=40;
			}
			else
			{
//cambio de tamaño e imagen				
				$pag=tituloformu($pdf,$fila,$vec,$pag,4,2);
				//$pdf->Image('img\piemed2.jpg',3,122,202,16,'','');
				$fila=$fila+43;
			}
//fin cambio de imagen			
			
			
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
				$trasncri_efo=$rfor[trasncri_efo];
				$meditrans=$rfor[meditrans];
				$espetrans=$rfor[espetrans];
				$fecconsulta=$rfor[feco_efo];
			}	
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(15,$fila);
//			$pdf->Cell(15,5,$nuformu,0,0,C);
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
			$tto=0;
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
				if($tiem>$tto)$tto=$tiem;				
				$bvia1=mysql_query("select * from destipos where codi_des='$viaa'");
				while($rvia1=mysql_fetch_array($bvia1))
				{
					$nvia=$rvia1['nomb_des'];
					//$nvia="Intramuscular";
				}
				//$a1=8;$a2=14;$a3=84;$a4=14;$a5=22;$a6=19;$a7=19;$a8=15;$a9=12;
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
				$pdf->Rect(5+$a1+$a2+$a3+$a4+$a5+$a6+$a7+$a8, $fila, $a9, $bajo);
				$pdf->Rect(5+$a1+$a2+$a3+$a4+$a5+$a6+$a7+$a8+$a9, $fila, $a10, $bajo); 
				
				$fila=$fila+$bajo;				
				$pdf->SetXY(5,$fila);
				$pdf->SetFillColor(240);
				$pdf->SetFont('Arial','',7);
				$pdf->MultiCell(198,4,'   Observaciones:  '.$obsmed,1,L,1);
				$fila=$pdf->GetY();				
			}
			
			//-------------------------------------- CAMBIO RESTRICCION DE DESCRIPCION DE CONTENIDO DE DIAGNOSTICO ------------			
			if($i==1)
			{
				$subfila=$fila;
				$subfila=$subfila+2;
				$pdf->Image('img\parapaciente.jpg',179,$subfila,23,0,'','');
			}
			//_____________________________________ FIN CAMBIO DE RESTRICCION ----------------------------------------------------	
			$fila=$fila+2;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(198,5,'Control en: '.$proxi,1,0,L);
			
			$fila=$fila+5;
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(198,5,'Recomendaciones: '.$obse,1,L,0);
			
			
			/*
				$trasncri_efo=$rfor[trasncri_efo];
				$meditrans=$rfor[meditrans];
				$espetrans=$rfor[espetrans];
			
			*/
			
			
			if($trasncri_efo=='S')
			{
				$bmtra=mysql_query("SELECT * FROM medicos WHERE cod_medi='$meditrans'");
				$rmtra=mysql_fetch_array($bmtra);
				$medtra=$rmtra['nom_medi'];
				$betra=mysql_query("SELECT * FROM destipos WHERE codi_des='$espetrans'");
				$retra=mysql_fetch_array($betra);
				$espetra=$retra['nomb_des'];
				$fila=$pdf->GetY();
				$fila=$fila+6;
				$pdf->SetXY(5,$fila);
				$pdf->MultiCell(198,5,'TRANSCRIPCION DE FORMULA DEL DOCTOR: '.$medtra.' - '.$espetra,1,L,0);
			}
			$diag1=$vec[10];
			$bd1=mysql_query("select * from cie_10 where cod_cie10='$diag1'");
			while($rd1=mysql_fetch_array($bd1))
			{
				$desd1=$rd1['nom_cie10'];
//____________________________________ ESTA LINEA NUEVO REQUERIMIENTO -------------				
				$siimpime1=$rd1['imprimible_cie10'];
//------------------------------------ FIN NUEVO REQUERIMIENTO --------------------				
			}	

			$banal=mysql_query("select * from consulta_soap where numc_soap='$numhisto'");
			$ranal=mysql_fetch_array($banal);
			$anal=$ranal['anal_soap'];
			
			
			$fila=$pdf->GetY();
			$nentregas=$tto/30;
			$fini=$fecconsulta;
			if($nentregas>=2)
			{
				for($k=1;$k<=$nentregas;$k++)
				{
					
					$ffin=date("Y-m-d",strtotime($fini."+ 30 days"));				
					
					if($k==1)
					{					
						$fila=$fila+4;
						$pdf->SetXY(70,$fila);
						$pdf->Cell(45,5,'FECHA PARA LA RECEPCION DE SUS MEDICAMENTOS ',0,0,L);
						$fila=$fila+12;
					}
					
					
					$pdf->SetXY(15,$fila);
					$pdf->Cell(70,5,'ENTREGA No. '.$k.': desde '.$fini.' hasta '.$ffin,0,0,L);
					$pdf->Cell(60,5,'FIRMA.  __________________________________  ',0,0,L);
					$pdf->Cell(50,5,'C.C. No. ____________________________',0,0,L);
					//$fini=$ffin;
					$fini=date("Y-m-d",strtotime($ffin."+ 1 days"));
					$fila=$fila+10;
				}
			}
			
			
			
			
			
			//$fila=$pdf->GetY();
			$fila=$fila+3;
			
			
			
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
	if($med=='1')
	{
		$ciclo='';
		$boncoci=mysql_query("select * from medicamentos_oncologia where num_histo='$numhisto'");
		while($roncoci=mysql_fetch_array($boncoci))
		{			
			if($ciclo=='')$ciclo=$roncoci['ciclo'];			
		}
		$bonco=mysql_query("select * from medicamentos_oncologia where num_histo='$numhisto'");
		$nonc=mysql_num_rows($bonco);
		if($nonc>0)
		{
			$fila=300;
			$pag=tituloformuonco($pdf,$fila,$vec,$pag,4,1);
			//$pdf->Image('img\pie_formuonco.jpg',3,260,202,16,'','');
			$fila=54;				
			
			$bexafis=mysql_query("select * from examenfisico where numc_efi='$numhisto'");
			while($rexaf=mysql_fetch_array($bexafis))
			{			
				$peso=$rexaf['peso_efi'];
				$talla=$rexaf['tall_efi'];
				
				//$imccal=$peso/($talla*$talla);
				//$imc=number_format ($imccal , 2 , "." , "," );
				
				$circor=sqrt(($peso*$talla)/3600);
				$sct=number_format ($circor , 2 , "." , "," );
			}
			
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(50,5,'PESO: '.$peso,1,0,C);
			$pdf->Cell(50,5,'TALLA: '.$talla,1,0,C);
			//$pdf->Cell(50,5,'IMC: '.$imc,1,0,C);
			$pdf->Cell(50,5,'SCT: '.$sct,1,0,C);
			$pdf->Cell(50,5,'CICLO: '.$ciclo,1,0,C);

			
			while($ronco=mysql_fetch_array($bonco))
			{			
				$iden_formoncologia=$ronco['iden_formoncologia'];
				$num_histo=$ronco['num_histo'];
				$dosis_teorica=$ronco['dosis_teorica'];
				$unid_dt=$ronco['unid_dt'];
				$dosis_resultante=$ronco['dosis_resultante'];
				$unid_dr=$ronco['unid_dr'];
				$porcentaje_ajuste=$ronco['porcentaje_ajuste'];
				$dosis_definitiva=$ronco['dosis_definitiva'];
				$unid_dd=$ronco['unid_dd'];
				$via_administracion=$ronco['via_administracion'];
				$vehiculo=$ronco['vehiculo'];
				$volumen=$ronco['volumen'];
				$duracion_infusion=$ronco['duracion_infusion'];
				$frecuencia=$ronco['frecuencia'];
				$intervalo=$ronco['intervalo'];
				$duracion_tratamiento=$ronco['duracion_tratamiento'];
				$cod_mdi=$ronco['cod_mdi'];
				$cantidad=$ronco['cantidad'];
				$obsemed=$ronco['obsemed'];
				
				$bvia=mysql_query("select * from destipos where codi_des='$via_administracion'");
				$rdes=mysql_fetch_array($bvia);
				$via_admi=$rdes['nomb_des'];
				
				$bmeonco="SELECT medicamentos2.codi_mdi, medicamentos2.ncsi_medi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa
				FROM forma_farmaceutica RIGHT JOIN medicamentos2 ON forma_farmaceutica.codi_ffa = medicamentos2.coff_mdi
				WHERE (((medicamentos2.codi_mdi)='$cod_mdi'))";
				$rmedonco=Mysql_query($bmeonco);
				while ($rowmedon=mysql_fetch_array($rmedonco))
				{
					$nompronco=$rowmedon['nomb_mdi'].' '.$rowmedon['desc_ffa'];
					$codint=$rowmedon['ncsi_medi'];
					$nombcomer=$rowmedon['noco_mdi'];
				}
				$fila=$fila+8;
				$pdf->SetFont('Arial','',7);
				$pdf->SetXY(5,$fila);
				$pdf->Cell(33,10,'Fecha',1,0,C);
				$pdf->Cell(132,5,'Dosis',1,0,C);
				$pdf->Cell(33,10,'Via de Administración',1,0,C);
				$fila=$fila+5;
				$pdf->SetXY(38,$fila);
				$pdf->Cell(33,5,'Teorica',1,0,C);
				$pdf->Cell(33,5,'Resultante',1,0,C);
				$pdf->Cell(33,5,'% De Ajuste',1,0,C);
				$pdf->Cell(33,5,'Definitiva',1,0,C);
				
				$fila=$fila+5;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(33,5,$vec[1],1,0,C);
				$pdf->Cell(33,5,$dosis_teorica.' '.$unid_dt,1,0,C);
				$pdf->Cell(33,5,$dosis_resultante.' '.$unid_dr,1,0,C);
				$pdf->Cell(33,5,$porcentaje_ajuste,1,0,C);
				$pdf->Cell(33,5,$dosis_definitiva.' '.$unid_dd,1,0,C);
				$pdf->Cell(33,5,$via_admi,1,0,C);
				
				$fila=$fila+5;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(33,5,'Vehiculo',1,0,C);
				$pdf->Cell(33,5,'Volumen',1,0,C);
				$pdf->Cell(33,5,'Duración Infusión',1,0,C);
				$pdf->Cell(33,5,'Frecuencia',1,0,C);
				$pdf->Cell(33,5,'Intervalo',1,0,C);
				$pdf->Cell(33,5,'Duración del tratamiento',1,0,C);
				
				$fila=$fila+5;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(33,5,$vehiculo,1,0,C);
				$pdf->Cell(33,5,$volumen,1,0,C);
				$pdf->Cell(33,5,$duracion_infusion,1,0,C);
				$pdf->Cell(33,5,$frecuencia,1,0,C);
				$pdf->Cell(33,5,$intervalo,1,0,C);
				$pdf->Cell(33,5,$duracion_tratamiento,1,0,C);
				
				$fila=$fila+5;
				$pdf->SetXY(5,$fila);
				$pdf->Cell(33,5,'Medicamento',1,0,C);
				$pdf->SetFont('Arial','B',7);
				$pdf->Cell(165,5,$cod_mdi.' - '.$nompronco,1,0,L);
				$pdf->SetFont('Arial','',7);
				
				$fila=$fila+5;
				$pdf->SetXY(5,$fila);
				$pdf->MultiCell(198,5,'Observaciones: '.$obsemed,1,L,1);
				$fila=$pdf->GetY();
				
				$pdf->SetXY(5,$fila);
				$pdf->Cell(66,5,'Cantidad en números',1,0,C);
				$pdf->SetFont('Arial','B',7);
				$pdf->Cell(33,5,$cantidad,1,0,C);
				$pdf->SetFont('Arial','',7);
				
				$pdf->Cell(66,5,'Cantidad en letras',1,0,C);
				$pdf->SetFont('Arial','B',7);
				$canletras=convertir($cantidad);
				$pdf->Cell(33,5,$canletras,1,0,C);
				$pdf->SetFont('Arial','',7);
			}
			$fila=$fila+10;
			
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
	
		
//integracion impresion antimicrobianos	
/*	
	if($medMicro=='1'){

		$cadreport1="SELECT * FROM antimicrobianos WHERE antimicrobianos.numc_ehi='$numhisto'";
		$resreport1=Mysql_query($cadreport1);
		while($filrepor1=mysql_fetch_array($resreport1))		
		{
			$id_micro=$filrepor1['id_micro'];
			$codigoUsuarioMicro=$filrepor1['codi_usu'];
			$fecha_micro=$filrepor1['fecha_micro'];
			$hora_micro=$filrepor1['hora_micro'];
			$codi_mdi=$filrepor1['codi_mdi'];
			$ambito_micro=$filrepor1['ambito_micro'];
			$edad_micro=$filrepor1['edad_micro'];
			$codigoContratoMicro=$filrepor1['CODI_CON'];
			$cama_micro=$filrepor1['cama_micro'];
			$diagnoprin_micro=$filrepor1['diagnoprin_micro'];
			$cieinfexioso_micro=$filrepor1['cieinfexioso_micro'];
			$tipo_micro=$filrepor1['tipo_micro'];
			$resultado_micro=$filrepor1['resultado_micro'];
			$examenconfirma_micro=$filrepor1['examenconfirma_micro'];
			$codi_mdi_nombre=$filrepor1['tratamientoactual_micro'];
			$dosis_micro=$filrepor1['dosis_micro'];
			$unidad_micro=$filrepor1['unidad_micro'];
			$frecuencia_micro=$filrepor1['frecuencia_micro'];
			$unidadfrecu_micro=$filrepor1['unidadfrecu_micro'];
			$tiempo_micro=$filrepor1['tiempo_micro'];
			$tiempounidad_micro=$filrepor1['tiempounidad_micro'];
			$razoncambio_micro=$filrepor1['razoncambio_micro'];
			$observar_micro=$filrepor1['observar_micro'];
			$codigoMedicoMicro=$filrepor1['codmedico_micro'];
			$dosis=$dosis_micro.' '.$unidad_micro;
			$frecuencia=$frecuencia_micro.' '.$unidadfrecu_micro;
			$tiempo=$tiempo_micro.' '.$tiempounidad_micro;
			
			
			$cadcontratouno="SELECT nomb_mdi FROM medicamentos2 WHERE codi_mdi='$codi_mdi_nombre'";
			$rescontratouno=Mysql_query($cadcontratouno);
			while($filrepor53=mysql_fetch_array($rescontratouno))		
			{
				$tratamientoactual_micro=$filrepor53['nomb_mdi'];
			}
			
			$cadcontrato1="SELECT nom_cie10 FROM cie_10 WHERE cod_cie10='$cieinfexioso_micro'";
			$rescontrato1=Mysql_query($cadcontrato1);
			while($filreporre1=mysql_fetch_array($rescontrato1))		
			{
				$diagnoinfecioso=$filreporre1['nom_cie10'];
			}
			
			$cadcontrato2="SELECT NEPS_CON FROM contrato WHERE CODI_CON=$codigoContratoMicro";
			$rescontrato2=Mysql_query($cadcontrato2);
			while($filrepor2=mysql_fetch_array($rescontrato2))		
			{
				$eps=$filrepor2['NEPS_CON'];
			}
			
			$cadcontrato3="SELECT usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU FROM usuario WHERE codi_usu=$codigoUsuarioMicro";
			$rescontrato3=Mysql_query($cadcontrato3);
			while($filrepor3=mysql_fetch_array($rescontrato3))		
			{
				$identifica = $filrepor3['TDOC_USU'].' '.$filrepor3['NROD_USU'];
				$nombre=$filrepor3['PNOM_USU'].' '.$filrepor3['SNOM_USU'].' '.$filrepor3['PAPE_USU'].' '.$filrepor3['SAPE_USU'];
			}
			
			$cadcontrato4="SELECT nom_cie10 FROM cie_10 WHERE cod_cie10='$diagnoprin_micro'";
			$rescontrato4=Mysql_query($cadcontrato4);
			while($filrepor4=mysql_fetch_array($rescontrato4))		
			{
				$diagnoPrincipal=$filrepor4['nom_cie10'];
			}
			
			$cadcontrato5="SELECT nomb_mdi FROM medicamentos2 WHERE codi_mdi='$codi_mdi'";
			$rescontrato5=Mysql_query($cadcontrato5);
			while($filrepor5=mysql_fetch_array($rescontrato5))		
			{
				$medicamentoSolicitado=$filrepor5['nomb_mdi'];
			}
			
			$cadcontrato6="SELECT dosis_med, undo_med, frec_med, unfr_med, tiem_med  FROM medicamentosenv WHERE numc_men='$numhisto' AND  cmed_men='$codi_mdi'";
			$rescontrato6=Mysql_query($cadcontrato6);
			while($filrepor6=mysql_fetch_array($rescontrato6))		
			{
				$mSolDosis=$filrepor6['dosis_med'].' '.$filrepor6['undo_med'];
				$mSolFrecuencia=$filrepor6['frec_med'].' '.$filrepor6['unfr_med'];
				$mSolTiempo=$filrepor6['tiem_med'].' Dias';
			}
			
			$cadcontrato7="SELECT nom_medi FROM medicos WHERE cod_medi=$codigoMedicoMicro";
			$rescontrato7=Mysql_query($cadcontrato7);
			while($filrepo7=mysql_fetch_array($rescontrato7))		
			{
				$nommedico_micro = $filrepo7['nom_medi'];
			}
			
			$pdf->SetFont('Arial','',8);
		
			$pdf->AddPage('P', 'Letter');
			$pdf->SetFont('Arial','',8);
			$pdf->SetDrawColor(192);
			$fila=27;
			$col=5;
			$col=220;
			$fila=6;
			$pdf->Image('img\cabeza_micro1.jpg',3,$fila,210,0,'','');
			$fila=$pdf->GetY();
			$numpagtot1 = 1;
			$pdf->SetXY(194,24.4);
			$pdf->SetFont('Arial','',9);
			$fila=$fila+25;
			$pdf->SetXY(80,$fila);
			$pdf->SetFillColor($col);	
			$pdf->rect(5,$fila,205,4,F);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(66,4,'FORMATO DE PRESCRIPCIÓN DE ANTIMICROBIANOS RESTRINGIDOS' ,1,0,'C');	
			
			$fila=$fila+6;
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(220,4,"El diligenciamiento de éste formato es necesario para la dispensación del antimicrobiano de uso" ,0,0,'C');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(220,4,"restringido, y corresponde a un documento adicional a la formulación." ,0,0,'C');
			
			$filaInicial=$fila+7;
			$fila=$fila+8;
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4, "AMBITO:" ,0,0,'L');
			$fila=$fila+4;		
			
			if($ambito_micro=='A'){
				$pdf->SetFont('Arial','',9); 
				$pdf->SetXY(5,$fila);
				$pdf->Cell(128,4, "Ambularorio (X)       Hospitalizacón ( )"  ,0,0,'L');
				$fila=$fila+4;
			}	
			else if($ambito_micro=='H'){
				$pdf->SetFont('Arial','',9); 
				$pdf->SetXY(5,$fila);
				$pdf->Cell(128,4, "Ambularorio ( )       Hospitalización (X)"  ,0,0,'L');
				$fila=$fila+4;
			}
			
			$fila=$fila+2;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4, "DATOS DE PACIENTE:" ,0,0,'L');
			$fila=$fila+4;
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4, "NOMBRE: " ,0,0,'L');
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(20,$fila);
			$pdf->Cell(128,4, $nombre ,0,0,'L');
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(135,$fila);
			$pdf->Cell(75,4, "IDENTIFICACION: " ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(161,$fila);
			$pdf->Cell(75,4, $identifica ,0,0,'L');
			
			$fila=$fila+4;
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(75,4, "EDAD: " ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(16,$fila);
			$pdf->Cell(75,4, $edad_micro ,0,0,'L');
			
			if($ambito_micro=='H'){
				$pdf->SetFont('Arial','B',8);
				$pdf->SetXY(75,$fila);
				$pdf->Cell(75,4, "CAMA: " ,0,0,'L');
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(86,$fila);
				$pdf->Cell(75,4, $cama_micro ,0,0,'L');
			}
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(135,$fila);
			$pdf->Cell(75,4, "FECHA DE PRESCRIPCION: " ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(175,$fila);
			$pdf->Cell(75,4, $fecha_micro ,0,0,'L');
			$fila=$fila+4;
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(75,4, "E.P.S: " ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(15,$fila);
			$pdf->MultiCell(205,4,$eps,0,L,0);		
			$fila=$pdf->GetY();
			$filaFinal=$fila-$filaInicial; 
			$pdf->Rect(4, $filaInicial, 203, $filaFinal);
			
			
			$fila=$fila+2;
			$filaInicial=$fila;
			$fila=$fila+2;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4, "DIAGNOSTICOS:" ,0,0,'L');
			$fila=$fila+4;

			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(75,4, "DIAGNOSTICO PRINCIPAL:" ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(45,$fila);
			$pdf->MultiCell(205,4, $diagnoPrincipal ,0,L,0);		
			$fila=$pdf->GetY();
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4, "DIAGNOSTICO INFECCIOSO: " ,0,L,0);		
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(45,$fila);
			$pdf->MultiCell(205,4, $diagnoinfecioso ,0,L,0);		
			$fila=$pdf->GetY();
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4, "TIPO DE DIAGNOSTICO:" ,0,0,'L');
			if($tipo_micro==1){
				$pdf->SetFont('Arial','',8); 
				$pdf->SetXY(45,$fila);
				$pdf->Cell(128,4, "Sospechoso (X)       Confirmado ( )"  ,0,0,'L');
				$fila=$fila+4;
			}	
			else if($tipo_micro==2){
				$pdf->SetFont('Arial','',8); 
				$pdf->SetXY(45,$fila);
				$pdf->Cell(128,4, "Sospechoso ( )       Confirmado (X)"  ,0,0,'L');
				$fila=$fila+4;
			}
			
			$filaFinal=$fila-$filaInicial; 
			$pdf->Rect(4, $filaInicial, 203, $filaFinal);
			
			$fila=$fila+2;
			$filaInicial=$fila;
			$fila=$fila+2;
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4, "EXAMEN CONFIRMATORIO:" ,0,0,'L');
			$fila=$fila+4;
				
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4, "ORIGEN/TIPO DE MUESTRA: " ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(46,$fila);
			$pdf->Cell(128,4, $examenconfirma_micro ,0,0,'L');
			$fila=$fila+4;
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4, "RESULTADO/MICROORGANISMO: " ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(53,$fila);
			$pdf->Cell(128,4, $resultado_micro ,0,0,'L');
			$fila=$fila+4;
			$filaFinal=$fila-$filaInicial; 
			$pdf->Rect(4, $filaInicial, 203, $filaFinal);
			
			$fila=$fila+2;
			$filaInicial=$fila;
			$fila=$fila+2;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(128,4, "TRATAMIENTO ANTIMICROBIANO ACTUAL:" ,0,0,'L');
			$fila=$fila+4;
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(75,4, "NOMBRE:" ,0,0,'L');
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(20,$fila);
			$pdf->MultiCell(205,4, $tratamientoactual_micro ,0,L,0);		
			$fila=$pdf->GetY();		
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(75,4, "DOSIS:" ,0,0,'L');
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(17,$fila);
			$pdf->Cell(75,4, $dosis ,0,0,'L');

			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(75,$fila);
			$pdf->Cell(70,4, "FRECUENCIA: " ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(96,$fila);
			$pdf->Cell(70,4, $frecuencia ,0,0,'L');
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(135,$fila);
			$pdf->Cell(75,4, "TIEMPO DE TRATAMIENTO: " ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(175,$fila);
			$pdf->Cell(70,4, $tiempo ,0,0,'L');
			$fila = $fila+4;
			$filaFinal=$fila-$filaInicial; 
			$pdf->Rect(4, $filaInicial, 203, $filaFinal);
			
			$fila=$fila+2;
			$filaInicial=$fila;
			$fila=$fila+2;
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(205,4, "RAZÓN DEL CAMBIO DEL TRATAMIENTO ACTUAL O DE ADICIÓN DE UN ANTIMICROBIANO NUEVO: " ,0,0,'L');
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4,$razoncambio_micro,0,L,0);		
			$fila=$pdf->GetY();
			
			$fila=$fila+2;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(205,4, "ANTIBIOTICO SOLICITADO: " ,0,0,'L');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(75,4, "NOMBRE:" ,0,0,'L');
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(20,$fila);
			$pdf->MultiCell(205,4, $medicamentoSolicitado ,0,L,0);		
			$fila=$pdf->GetY();		
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(75,4, "DOSIS:" ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(17,$fila);
			$pdf->Cell(75,4, $mSolDosis ,0,0,'L');

			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(75,$fila);
			$pdf->Cell(70,4, "FRECUENCIA: " ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(96,$fila);
			$pdf->Cell(70,4, $mSolFrecuencia ,0,0,'L');
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(135,$fila);
			$pdf->Cell(75,4, "TIEMPO DE TRATAMIENTO: " ,0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(175,$fila);
			$pdf->Cell(70,4, $mSolTiempo ,0,0,'L');
			
			$fila=$fila+4;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(205,4, "OBSERVACIONES: " ,0,0,'L');
			$fila=$fila+4;
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,$fila);
			$pdf->MultiCell(205,4,$observar_micro,0,L,0);		
			$fila=$pdf->GetY();
			
			$filaFinal=$fila-$filaInicial; 
			$pdf->Rect(4, $filaInicial, 203, $filaFinal);
			
			$fila=$fila+6;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,6, "NOMBRE DEL MEDICO PRESCRIPTOR:" ,1,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(65,$fila);
			$pdf->Cell(142,6, $nommedico_micro ,1,0,'L');
			
			$fila=$fila+6;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,6, "VO. BO QUÍMICO FARMACÉUTICO:" ,1,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(65,$fila);
			$pdf->Cell(142,6, $soledad ,1,0,'L');
			
			$fila=$fila+6;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(60,6, "FECHA DE VO. BO." ,1,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(65,$fila);
			$pdf->Cell(142,6, $soledad ,1,0,'L');
			
			$fila=$fila+8;
			$pdf->SetFont('Arial','I',8);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(205,4, "Formato adaptado del documento oficial de los lineamientos dados por el Ministerio de Salud" ,0,1,'C');
		}
	}
*/	
//fin antimicrobianos	

	
	
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
			$metodo=$rconsu['mepl_cpl'];
			$vicviosexual=$rconsu['vicviosexual_clp'];
		}
		
		$bacud=mysql_query("select * from encabesadohistoria where numc_ehi='$numhisto'");
		while($racud=mysql_fetch_array($bacud))
		{
			$grupopobla=$racud['grupopobla'];
			$orisexual=$racud['orisexual'];
			$fechacon=$racud['feco_ehi'];
		}
		
		$bdes=mysql_query("SELECT * FROM destipos WHERE codi_des='$grupopobla'");
		$rdes=mysql_fetch_array($bdes);
		$nomgrupopobla=$rdes['nomb_des'];
		
		$bdes=mysql_query("SELECT * FROM destipos WHERE codi_des='$orisexual'");
		$rdes=mysql_fetch_array($bdes);
		$nomorisexual=$rdes['nomb_des'];
		
		$fila=300;
		$pag=titulo($pdf,$fila,$vec,$pag,5,1);
		//$pdf->Image('img\pie_histo.JPG',2,255,210,0,'','');
		$fila=$fila+40;	
                $h=2;		
		$fila=$pdf->GetY();
		if($fechacon>='2022-06-30')
		{
			$fila=$fila+$h+4;
			$pdf->SetXY(5,$fila);
			$pdf->Cell(80,4,'Grupo poblacional: '.$nomgrupopobla,0,0,L);
			$pdf->Cell(80,4,'Orientacion sexual: '.$nomorisexual,0,0,L);
			$pdf->Cell(65,4,'Victima de violencia sexual: '.$vicviosexual,0,0,L);
		}
		
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
		$fila=$fila+8;
		
		$bman=mysql_query("SELECT destipos.nomb_des, destipos.codi_des, sintomas_covid.valor_sintoma
		FROM sintomas_covid LEFT JOIN destipos ON sintomas_covid.cod_sintoma = destipos.codi_des
		WHERE sintomas_covid.num_histo = '$numhisto' AND tipo_historia='C' AND cod_sintoma='E001'");
		while($rman=mysql_fetch_array($bman))
		{
			$val_sintoma=$rman['valor_sintoma'];
			$nom_sintoma=$rman['nomb_des'];
			if($val_sintoma=='S')
			{
				$pdf->SetXY(5,$fila);
				$pdf->SetFont('Arial','',8);
				$pdf->MultiCell(190,5,$nom_sintoma,0,J,0);
				$fila=$pdf->GetY();					
				$fila=$fila+5;
			}
		}
		
		$bman=mysql_query("SELECT destipos.nomb_des, destipos.codi_des, sintomas_covid.valor_sintoma
		FROM sintomas_covid LEFT JOIN destipos ON sintomas_covid.cod_sintoma = destipos.codi_des
		WHERE sintomas_covid.num_histo = '$numhisto' AND tipo_historia='C' AND cod_sintoma='E002'");
		while($rman=mysql_fetch_array($bman))
		{
			$val_sintoma=$rman['valor_sintoma'];
			$nom_sintoma=$rman['nomb_des'];
			if($val_sintoma=='S')
			{
				$pdf->SetXY(5,$fila);
				$pdf->SetFont('Arial','',8);
				$pdf->MultiCell(190,5,$nom_sintoma,0,J,0);
				$fila=$pdf->GetY();					
				$fila=$fila+5;
			}
		}
		
		$bcovid=mysql_query("SELECT destipos.nomb_des, destipos.codi_des, sintomas_covid.valor_sintoma
		FROM sintomas_covid LEFT JOIN destipos ON sintomas_covid.cod_sintoma = destipos.codi_des
		WHERE sintomas_covid.num_histo = '$numhisto' AND tipo_historia='C' ORDER BY `codi_des` ASC");
		if(mysql_fetch_array($bcovid)>0)
		{
			$n=0;
			$m=0;
			while($rcovid=mysql_fetch_array($bcovid))	
			{
				$codsin=$rcovid['codi_des'];
				$nomsin=$rcovid['nomb_des'];
				$valsin=$rcovid['valor_sintoma'];
				if($codsin!='E001' && $codsin!='E002')
				{
					if($m==0)
					{
						$pdf->SetXY(5,$fila);					
						$pdf->SetXY(5,$fila);
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(20,4,'Sintomas COVID-19:',0,0,L);
						$fila=$fila+5;
						$pdf->SetXY(30,$fila);		
					}				
					if($n % 4==0)
					{
						$fila=$fila+5;
						$pdf->SetXY(30,$fila);
						$n=0;
					}
					if($valsin=='N')$val='NO';
					if($valsin=='S')$val='SI';
					$pdf->Cell(40,5,$nomsin.': '.$val,1,0,C);
					$n++;
					$m++;				
				}
			}
		}


	
		
	
	$fila=$fila+8;
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
			if($talla>3)$tal=$talla/100;
			$imc=$peso/($tal*$tal);
			
			if($imc<18.5)$desimg="Bajo Peso";
			if(($imc>=18.5) && ($imc<=24.9))$desimg="Peso Normal";
			if(($imc>=25) && ($imc<=29.9))$desimg="Sobre Peso";
			if($imc>=30)$desimg="Obesidad";
			
			$imc=number_format ($imc , 2 , "." , "," );
			$saox_tri=$rexaf['saox_tri'];	
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
			if($peso!=''){$pdf->Cell(26,4,'Peso: '.$peso.' Kg.',0,0,L);}
			if($talla!=''){$pdf->Cell(26,4,'Talla: '.$talla.' cm.',0,0,L);}
			if($pcfa!=''){$pdf->Cell(26,4,'P.C: '.$pcfa,0,0,L);}
			if($imc!=''){$pdf->Cell(39,4,'IMC: '.$imc.' '.$desimg,0,0,L);}
			if($icc!=''){$pdf->Cell(23,4,'ICC: '.$icc,0,0,L);}
			if($saox_tri!=''){$pdf->Cell(23,4,'SAT O2: '.$saox_tri,0,0,L);}
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
	if($fila>=230)
	{
		$fila=300;
		$pag=titulo($pdf,$fila,$vec,$pag,5,1);
	}	
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
		$trasncri_efo=$rfor[trasncri_efo];
		$meditrans=$rfor[meditrans];
		$espetrans=$rfor[espetrans];
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
		$pdf->Cell(45,5,$especialidad,0,0,L);
		$pdf->SetXY(130,$fila);
		$pdf->Cell(10,5,'C. C. No.',0,0,L);
		$fila=$fila+4;
		$pdf->SetXY(25,$fila);
		$pdf->Cell(45,5,'Registro medico: '.$regimedico,0,0,L);
			
		
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
				$losproce32='';
				if($i==0 || $fila>112)
				{
					$fila=300;
					$pag=titulo($pdf,$fila,$vec,$pag,6,1);
					//$pdf->Image('img\PIE2.JPG',2,265,210,0,'','');
					$fila=40;				
				}
				else
				{
					$pag=titulo($pdf,$fila,$vec,$pag,6,2);
					//$pdf->Image('img\PIE2.JPG',2,123,210,0,'','');
					$fila=$fila+40;
				}					
				$idensol=$rqui['iden_solquiro'];			
				$busidensol="SELECT solicitud_quirofano.iden_solquiro, solicitud_quirofano.diag_solquiro, solicitud_quirofano.cups_solquiro, solicitud_quirofano.ticiru_solquiro, solicitud_quirofano.tianes_solquiro, solicitud_quirofano.fecsol_solquiro, solicitud_quirofano.horasol_solquiro, solicitud_quirofano.reayud_solquiro, solicitud_quirofano.sangre_solquiro, solicitud_quirofano.reequi_solquiro,  reeco_solquiro,  solicitud_quirofano.duracion_solquiro, solicitud_quirofano.reseruci_solquiro, solicitud_quirofano.rematerial_solquiro, solicitud_quirofano.material_solquiro, 
				solicitud_quirofano.origen_solquiro, solicitud_quirofano.relacion_solquiro, encabesadohistoria.cous_ehi, encabesadohistoria.cont_ehi, consultaprincipal.come_cpl, solicitud_quirofano.material_solquiro, solicitud_quirofano.esindtitu_solquiro 
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
					$reeco_solquiro=$rowsol['reeco_solquiro'];
					$duracion_solquiro=$rowsol['duracion_solquiro'];
					$reseruci_solquiro=$rowsol['reseruci_solquiro'];
					$rematerial_solquiro=$rowsol['rematerial_solquiro'];
					$material_solquiro=$rowsol['material_solquiro'];
					$origen_solquiro=$rowsol['origen_solquiro'];
					$relbuscador15=$rowsol['relacion_solquiro'];
					$cmedico=$rowsol['come_cpl'];
					$esindtitu=$rowsol['esindtitu_solquiro'];
				}
				$pdf->SetFont('Arial','',8);
				
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'FECHA DE SOLICITUD: '.$vec[1],0,0,L);
				
				$pdf->SetXY(95,$fila);
				$pdf->Cell(50,4,'ASEGURADORA:   '.$vec[5],0,0,L);
				
				$fila=$fila+4;
				
				if($ticiru_solquiro=='U')$desciru='URGENCIAS';
				if($ticiru_solquiro=='E')$desciru='ELECTIVA';
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'CIRUGIA:                        '.$desciru,0,0,L);
/*				
				$banes=mysql_query("select * from destipos where codi_des='$tianes_solquiro'");
				$ranes=mysql_fetch_array($banes);
				$desanes=$ranes['nomb_des'];
				
				$pdf->SetXY(95,$fila);
				$pdf->Cell(50,4,'ANESTESIA:    '.$desanes,0,0,L);
*/
			
				$fila=$fila+4;
				
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'FECHA DE CIRUGIA:     '.$fecsol_solquiro  ,0,0,L);
				
				$pdf->SetXY(95,$fila);
				$pdf->Cell(50,4,'HORA DE CIRUGIA:     '.$horasol_solquiro  ,0,0,L);
				
				$pdf->SetXY(165,$fila);
				$pdf->Cell(50,4,'DURACION:  '.$duracion_solquiro	 ,0,0,L);
				
				
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
				$pdf->Cell(50,4,'DIAGNOSTICO PREQUIRURGICO:',0,0,L);
				$pdf->MultiCell(135,4,$diag_solquiro.' - '.$nomcie1,0,L,0);
				$fila=$pdf->GetY();
				
				$matetotal1='';
				$resulsoli1=Mysql_query("SELECT * FROM soliquiro_deta WHERE nhis_solquiro = '$numhisto' and codi_sqdet = '$relbuscador15'");
				while ($rowsol1=mysql_fetch_array($resulsoli1))
				{
					$cupssqdet = $rowsol1['cups_sqdet'];
					$matersqdet = $rowsol1['mater_sqdet'];
					$consissqdet = $rowsol1['consis_sqdet'];
					$riesgosqdet = $rowsol1['riesgo_sqdet'];
					$benefsqdet = $rowsol1['benef_sqdet'];
					
					$matetotal1=$matetotal1.' '.$matersqdet;
					
					$resulmed32=Mysql_query("SELECT * FROM cups WHERE codigo='$cupssqdet'");
					while ($rowmed32=mysql_fetch_array($resulmed32))
					{
						$nompro32=$rowmed32['descrip'];		
						$codcup32=$rowmed32['codi_cup'];
						$losproce32=$losproce32.' '.$codcup32.' - '.$nompro32;	
					}
				}	
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'CIRUGIA:',0,0,L);
				$pdf->SetXY(49,$fila);
				$pdf->MultiCell(155,4,$losproce32,0,L,0);
				$fila=$pdf->GetY();
//-------------------------				
				
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
				
				if($reayud_solquiro=='S')$reayu='SI';
				if($reayud_solquiro=='N')$reayu='NO';	
				
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'CIRUJANO:',0,0,L);
				$pdf->SetXY(49,$fila);
				$pdf->Cell(50,4,$nommedico,0,0,L);
				
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'REQUIERE AYUDANTE:',0,0,L);
				$pdf->SetXY(49,$fila);
				$pdf->Cell(50,4,$reayu,0,0,L);				
				
								
			//___________________________________________________________________	
				
//				
				$fila=$fila+4;
				if($tianes_solquiro=='S')$aneste1='SI';
				if($tianes_solquiro=='N')$aneste1='NO';
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'ANESTESIOLOGO:           '.$aneste1,0,0,L);
				$pdf->SetXY(150,$fila);
				
			//___________________________________________________________________	

				
				
				
//				$cadenitasan=str_replace(';','.     ',$sangre_solquiro);
					
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(135,4,'HEMODERIVADOS:',0,0,L);
//				$fila=$pdf->GetY();
				
				
				if($sangre_solquiro != '')
				{
					$cadenitasantre = explode(';', $sangre_solquiro);
					$misfin=count($cadenitasantre);
					for($a=0;$a<$misfin;$a++)
					{
						$pdf->SetXY(49,$fila);
						$pdf->MultiCell(135,4,$cadenitasantre[$a],0,L,0);
						$fila=$pdf->GetY();
					}
					$fila=$fila-4;
				}
				else{$fila=$fila+4;}
				if($reequi_solquiro=='S')$reequi='SI';
				if($reequi_solquiro=='N')$reequi='NO';
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'REQUIERE EQUIPO RX:',0,0,L);
				$pdf->SetXY(49,$fila);
				$pdf->Cell(50,4,$reequi,0,0,L);
				
				if($reseruci_solquiro=='S')$reeuci='SI';
				if($reseruci_solquiro=='N')$reeuci='NO';
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'RESERVA UCI:',0,0,L);
				$pdf->SetXY(49,$fila);
				$pdf->Cell(50,4,$reeuci,0,0,L);
				
				
				if($reeco_solquiro=='S')$reeeco='SI';
				if($reeco_solquiro=='N')$reeeco='NO';
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'REQUIERE ECOGRAFIA:',0,0,L);
				$pdf->SetXY(49,$fila);
				$pdf->Cell(50,4,$reeeco,0,0,L);
				
				if($rematerial_solquiro=='S')$reemat='SI';
				if($rematerial_solquiro=='N')$reemat='NO';
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'REQUIERE MATERIAL:',0,0,L);
				$pdf->SetXY(49,$fila);
				$pdf->Cell(50,4,$reemat,0,0,L);
				
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'¿CUAL?',0,0,L);
				$pdf->SetXY(48,$fila);				
				$pdf->MultiCell(155,4,$matetotal1,0,L,0);
				$fila=$pdf->GetY();
				if($esindtitu=='S')$esindtitu1='SI';
				if($esindtitu=='N')$esindtitu1='NO';	
//				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(50,4,'EL PROCEDIMIENTO SE PUEDE REALIZAR EN LA INSTITUCION:      '.$esindtitu1,0,0,L);
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);				
				$pdf->MultiCell(125,4,'REQUIERE CONDICIONES, INSUMOS Y/O EQUIPOS ESPECIALES:   '.$material_solquiro,0,L,0);
				$fila=$pdf->GetY();
				
				if($tianes_solquiro=='S')
				{
					$fila=$fila+6;
					$pdf->SetXY(15,$fila);
					$pdf->Cell(80,5,'TIPO DE ANESTESIA: ____________________________________________________________________________________________________',0,0,L);
					$fila=$fila+20;
				}		
				else{$fila=$fila+20;}	
				
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
			$bussol=mysql_query("select * from solicitud_quirofano where nhis_solquiro ='$numhisto'");
			while($rqui=mysql_fetch_array($bussol))		
			{
				$losproce32='';
				$idensol=$rqui['iden_solquiro'];
				
				if($i==0 || $fila>130)
				{
					$fila=300;
					$pag=titulo($pdf,$fila,$vec,$pag,21,1);
					$pdf->Image('img\PIE3.JPG',2,255,210,0,'','');
					$fila=40;				
				}
				else
				{
					$pag=titulo($pdf,$fila,$vec,$pag,21,2);
					$pdf->Image('img\PIE3.JPG',2,123,210,0,'','');
					$fila=$fila+40;
				}
				$busidensol="SELECT encabesadohistoria.nomb_ehi, encabesadohistoria.idus_ehi, solicitud_quirofano.cups_solquiro, solicitud_quirofano.ticiru_solquiro, 
				solicitud_quirofano.tianes_solquiro, solicitud_quirofano.fecsol_solquiro, solicitud_quirofano.horasol_solquiro, 
				solicitud_quirofano.reayud_solquiro, solicitud_quirofano.sangre_solquiro, solicitud_quirofano.reequi_solquiro, 
				solicitud_quirofano.duracion_solquiro, solicitud_quirofano.reseruci_solquiro, solicitud_quirofano.rematerial_solquiro,
				solicitud_quirofano.material_solquiro, solicitud_quirofano.origen_solquiro, encabesadohistoria.cous_ehi,
				solicitud_quirofano.cnsi_solquiro, solicitud_quirofano.risg_solquiro,  solicitud_quirofano.bnf_solquiro,solicitud_quirofano.cnsi_solquiro, solicitud_quirofano.relacion_solquiro,
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
					$relbuscador15=$rowsol['relacion_solquiro'];
				}
				$medi_cin=mysql_query("SELECT  nom_medi, are_medi   FROM  medicos  WHERE  cod_medi='$come_cpl'");
				$row_cin=mysql_fetch_array($medi_cin);
				$nom_medi=$row_cin['nom_medi'];
				$are_medi=$row_cin['are_medi'];			
				$cups_cin=mysql_query("SELECT  codigo, codi_cup, descrip   FROM  cups   WHERE  codigo='$cups_solquiro'");
				$row_ccin=mysql_fetch_array($cups_cin);
				$nom_cups=$row_ccin['descrip'];
				$codi_cup=$row_ccin['codi_cup'];                               
				
				
//--------------------------				
				$consissqdet='';
				$riesgosqdet='';
				$benefsqdet='';
				
				
				$resulsoli1=Mysql_query("SELECT * FROM soliquiro_deta WHERE nhis_solquiro = '$numhisto' and codi_sqdet = '$relbuscador15'");
				while ($rowsol1=mysql_fetch_array($resulsoli1))
				{
					$cupssqdet = $rowsol1['cups_sqdet'];
					$matersqdet = $rowsol1['mater_sqdet'];
					$consissqdet1 = $rowsol1['consis_sqdet'];
					$riesgosqdet1 = $rowsol1['riesgo_sqdet'];
					$benefsqdet1 = $rowsol1['benef_sqdet'];
					$consissqdet=$consissqdet.' '.$consissqdet1;
					$riesgosqdet=$riesgosqdet.' '.$riesgosqdet1;
					$benefsqdet=$benefsqdet.' '.$benefsqdet1;
					
					$resulmed32=Mysql_query("SELECT * FROM cups WHERE codigo='$cupssqdet'");
					while ($rowmed32=mysql_fetch_array($resulmed32))
					{
						$nompro32=$rowmed32['descrip'];		
						$codcup32=$rowmed32['codi_cup'];
						$losproce32=$losproce32.' '.$codcup32.' - '.$nompro32;	
					}
				}
//---------------------------	
				$pdf->SetFont('Arial','b',8);
				$pdf->SetXY(113,16.2);
				$pdf->Cell(92,4,'1            2',0,1,0);
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(15,$fila+2);
				//$pdf->MultiCell(205,4,$desinca,1,L,0);
				$pdf->MultiCell(180,4,'Yo,  '.$nom_cinf.' , Mayor de Edad, Identificado(a) con C.C. No. '.$ident.'  y Como: Paciente_____, o como: Responsable _____,'
				. ' del o la Paciente________________________, identificado(a) con C.C. o T.I. No.______________, Autorizo al Dr.(a). '.$nom_medi.' , con profesion'
				. ' o Especialidad '. $are_medi . '  , para la realizacion de los Procedimientos  '. $losproce32,0,1,0);
                $fila=$pdf->GetY()+1;                         
				$pdf->SetXY(15,$fila);						  
				$pdf->MultiCell(180,4,'Que Consiste en:   '.$consissqdet,0,1,0);				
				$fila=$pdf->GetY()+1;                         
				$pdf->SetXY(15,$fila);						  
				$pdf->MultiCell(180,4,'Teniendo en cuenta que he sido informado sobre los riesgos y beneficios que se puede presentar, siendo estos:',0,1,0);
                $fila=$pdf->GetY()+1;
				$pdf->SetXY(15,$fila);	
				$pdf->Cell(92,4,'RIESGOS',1,0,C);	
				$pdf->Cell(92,4,'BENEFICIOS',1,0,C);
				$fila=$fila+4;				
				$pdf->SetXY(15,$fila);
				$pdf->MultiCell(92,4,$riesgosqdet,0,1,0);			        
				$fila1=$pdf->GetY();					
				$pdf->SetXY(107,$fila);					
				$pdf->MultiCell(92,4,$benefsqdet,0,1,0);
				$fila2=$pdf->GetY();						   
				if($fila2>=$fila1)$alto=$fila2-$fila;	
				if($fila1>$fila2)$alto=$fila1-$fila;
					//$alto=$alto+10;	   
				$pdf->Rect(15, $fila, 92, $alto);
				$pdf->Rect(107, $fila, 92, $alto);
			    $fila=$fila+$alto+2;
			    $pdf->SetXY(15,$fila);					
				$pdf->MultiCell(180,4,'Comprendo y acepto que durante el procedimiento pueden aparecer circunstancias imprevisibles o inesperadas, que puedan requerir una extensión del procedimiento original o la realización de otro procedimiento no mencionado arriba.',0,1,0);
				$fila=$pdf->GetY();
				$fila=$fila+2;
				$pdf->SetXY(15,$fila);
				$pdf->MultiCell(180,4,'Al firmar este documento reconozco que los he leído o que me ha sido leído y explicado y que comprendo perfectamente su contenido. Se me han dado amplias oportunidades de formular preguntas y que todas las preguntas que he formulado han sido respondidas o explicadas en forma satisfactoria.',0,1,0);
				$fila=$pdf->GetY();
				$fila=$fila+2;
				$pdf->SetXY(15,$fila);
				$pdf->MultiCell(180,4,'Acepto que la medicina no es una ciencia exacta y que no se me han garantizado los resultados que se esperan de la intervención quirúrgica o procedimientos diagnósticos o terapéuticos, en el sentido de que la práctica de la intervención o procedimiento que requiero compromete una actividad de medios, pero no de resultados.',0,1,0);
				$fila=$pdf->GetY();
				$fila=$fila+2;
				$pdf->SetXY(15,$fila);
				$pdf->MultiCell(180,4,'Comprendiendo estas limitaciones, doy mi consentimiento de manera libre y voluntaria para la realización del procedimiento y firmo a continuación:',0,1,0);
				$sql_text= mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='D001'");
			    $row_text=mysql_fetch_array($sql_text);
			    $texto=$row_text[nomb_des];
			    $fila=$pdf->GetY()+3;
			    $pdf->SetXY(15,$fila);
			    $pdf->MultiCell(180,4,$texto,0,1,0);
				$fila=$pdf->GetY();
				$fila->$fila+2;	
				$pdf->Image('img\huella.jpg',97,$fila,18,27,'','');
				$fila->$fila+4;
				$pdf->SetXY(15,$fila);	
				$pdf->Cell(80,4,'Firma Paciente:_____________________________________',0,0,L);
				$pdf->SetXY(120,$fila);	
				$pdf->Cell(20,4,'Testigo:       _____________________________________',0,0,L);
				$fila=$fila+8;
				$pdf->SetXY(15,$fila);	
				$pdf->Cell(80,4,'C.C.No. '.$ident,0,0,L);
				$pdf->SetXY(120,$fila);	
				$pdf->Cell(20,4,'C.C. No.      _____________________________________',0,0,L);
				$fila=$fila+8;
				$pdf->SetXY(120,$fila);	
				$pdf->Cell(80,4,'Parentesco  _____________________________________',0,0,L);
				$fila=$pdf->GetY()+10;
				$firma="../firmas/".$codimedico.".jpg";
				if(file_exists($firma))
				{
					$pdf->Image($firma,30,$fila,50,15,'','');
				}
				$fila=$fila+10;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(45,5,'_______________________________________________________________',0,0,L);
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(45,5,$nombmedico,0,0,L); 		   
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(25,5,'C.C. Nro. '.$ced_medi,0,0,L);
				$fila=$fila+4;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(25,5,'Registro medico: '.$regimedico,0,0,L);
				$fila=$pdf->GetY()+10;
				$pdf->SetXY(15,$fila);
				$pdf->Cell(45,5,'El paciente NO puede firmar por: _______________________________________________________________________________________',0,0,L);
				
				
				
				
				//NEGACION DEL TRATAMIENTO
				
			
				
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

			}
		}
	}	
	//}
	
	
	if($inca==1)
	{
			$bin=mysql_query("SELECT incapacidades.id_inca, incapacidades.numc_his, incapacidades.tformato_inca, establecimientos_educativos.nom_depar, establecimientos_educativos.nom_muni, 
			establecimientos_educativos.nombre_establecimiento, establecimientos_educativos.cod_dane, incapacidades.ereaespe_inca, incapacidades.jornada_inca, incapacidades.numdias_inca, incapacidades.letdias_inca, incapacidades.fecini_inca, 
			incapacidades.fecfin_inca, incapacidades.dx_inca, incapacidades.obse_inca, incapacidades.tipo_inca, incapacidades.fecparto_inca, incapacidades.paciente_inca, incapacidades.tipodoc_inca, 
			incapacidades.docum_inca, incapacidades.nommedico_inca, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, incapacidades.sexo_inca, incapacidades.edad_inca, incapacidades.prorroga_inca, medicos.nom_medi, 
			incapacidades.medico_inca, medicos.reg_medi, contrato.NEPS_CON, incapacidades.tireg_inca, incapacidades.fecreg_inca, municipio.NOMB_MUN, departamento.NOMB_DEP
			FROM (((((incapacidades LEFT JOIN establecimientos_educativos ON incapacidades.estedu_inca = establecimientos_educativos.iden) LEFT JOIN usuario ON incapacidades.paciente_inca = usuario.CODI_USU) 
			LEFT JOIN medicos ON incapacidades.medico_inca = medicos.cod_medi) LEFT JOIN contrato ON incapacidades.contrato_inca = contrato.CODI_CON) LEFT JOIN municipio ON 
			incapacidades.munate_inca = municipio.CODI_MUN) LEFT JOIN departamento ON municipio.DEPA_MUN = departamento.CODI_DEP
			WHERE (((incapacidades.numc_his)='$numhisto') AND ((incapacidades.estado)<>'A'))");
			while($rin=mysql_fetch_array($bin))
			{
				$id_inca=$rin['id_inca'];
				$numc_his=$rin['numc_his'];
				$tformato_inca=$rin['tformato_inca'];
				$depar_inca=$rin['nom_depar']; //departamento donde labora
				$muni_inca=$rin['nom_muni'];  //municipio donde labora
				$estedu_inca=$rin['nombre_establecimiento'];
				$codigo_dane=$rin['cod_dane'];
				
				$ereaespe_inca=$rin['ereaespe_inca'];
				$jornada_inca=$rin['jornada_inca'];
				$numdias_inca=$rin['numdias_inca'];
				$letdias_inca=$rin['letdias_inca'];
				$fecini_inca=$rin['fecini_inca'];
				$fecfin_inca=$rin['fecfin_inca'];
				$dx_inca=$rin['dx_inca'];
				$obse_inca=$rin['obse_inca'];
				$tipo_inca=$rin['tipo_inca'];
				$fecparto_inca=$rin['fecparto_inca'];
				
				$paciente_inca=$rin['paciente_inca'];
				$tipodoc_inca=$rin['tipodoc_inca'];
				$docum_inca=$rin['docum_inca'];
				$nombre_inca=$rin['PNOM_USU'].' '.$rin['SNOM_USU'].' '.$rin['PAPE_USU'].' '.$rin['SAPE_USU'];
				$sexo_inca=$rin['sexo_inca'];
				$edad_inca=$rin['edad_inca'];
				$prorroga_inca=$rin['prorroga_inca'];
				$nommedi_inca=$rin['nom_medi'];
				$codmedi_inca=$rin['medico_inca'];
				if($codmedi_inca=='000000')$nommedi_inca=$rin['nommedico_inca'];
				$regmedi_inca=$rin['reg_medi'];
				$NEPS_CON=$rin['NEPS_CON'];
				$tireg_inca=$rin['tireg_inca'];
				$fecreg_inca=$rin['fecreg_inca'];
				$NOMB_MUN=$rin['NOMB_MUN'];	//departamento donde fue atendido
				$NOMB_DEP=$rin['NOMB_DEP'];	//municipio donde fue atendido
				
				$brarin=mysql_query("SELECT * FROM destipos WHERE codi_des='$ereaespe_inca'");
				$rrarin=$rin=mysql_fetch_array($brarin);
				$nomereaespe_inca=$rin['nomb_des'];
				
				$anoi=substr($fecini_inca,0,4);
				$mesi=substr($fecini_inca,5,2);
				$diai=substr($fecini_inca,8,2);
				$anof=substr($fecfin_inca,0,4);
				$mesf=substr($fecfin_inca,5,2);
				$diaf=substr($fecfin_inca,8,2);
				$anop=substr($fecparto_inca,0,4);
				$mesp=substr($fecparto_inca,5,2);
				$diap=substr($fecparto_inca,8,2);
								
			}		
			$bcole=mysql_query("SELECT * FROM establecimientos_educativos WHERE iden='$estedu_inca'");
			
			$pag=$pag+1;
			
			$pdf->AddPage();
			
			$fila=2;
			if($tformato_inca=='D') $pdf->Image('img\enca_inca.JPG',1,$fila,215,0,'','');
			if($tformato_inca=='O') $pdf->Image('img\enca_incaotro.JPG',1,$fila,215,0,'','');
			//$pdf->Image('img\controlado.png',203,100,7,30,'','');

			$pdf->line(0,140,2,140);

			
			$pdf->Image('img\pie_inca.JPG',2,120,210,0,'','');
			$fila=$fila+20;
			
			$pdf->SetXY(5,$fila);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(205,5,'HACE CONSTAR QUE',0,0,C);	
			$pdf->SetXY(173,$fila);
			$pdf->Cell(30,5,'No. '.$id_inca,1,0,C);	
			
			$fila=$fila+6;
					
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(10,$fila);
			$pdf->Cell(25,5,'DEPARTAMENTO:',0,0,L);	
			$pdf->Cell(70,5,'___________________________________________',0,0,L);			
			$pdf->Cell(28,5,'CIUDAD/MUNICIPIO:',0,0,L);	
			$pdf->Cell(73,5,'___________________________________________',0,0,L);
			
			$pdf->SetXY(38,$fila);
			$pdf->Cell(100,5,$NOMB_DEP,0,0,L);
			$pdf->Cell(136,5,$NOMB_MUN,0,0,L);
			
			//$nombre=$vec[3];
			
			$fila=$fila+5;
			$pdf->SetXY(10,$fila);
			$pdf->Cell(20,5,'EL SEÑOR(A):',0,0,L);	
			$pdf->Cell(140,5,'_______________________________________________________________________________________',0,0,L);			
			$pdf->Cell(20,5,'SEXO:     M           F',0,0,L);

			$pdf->SetXY(33,$fila);
			$pdf->Cell(136,5,$nombre_inca,0,0,L);	
			
			$mas=' ';$fem=' ';
			if($sexo_inca=='M')$mas='X';
			if($sexo_inca=='F')$fem='X';
			$pdf->SetXY(187,$fila);
			$pdf->Cell(4,4,$mas,1,0,L);
			$pdf->SetXY(197,$fila);
			$pdf->Cell(4,4,$fem,1,0,L);
			
			$fila=$fila+5;
			$pdf->SetXY(10,$fila);
			$pdf->Cell(20,5,'IDENTIFICADO(A) CON:      CC             CE             TI                NUMERO: _____________________________________  EDAD: ____________ AÑOS',0,0,L);	
			
			$cc=' ';$ce=' ';$ti=' ';
			if($tipodoc_inca=='CC')$cc='X';
			if($tipodoc_inca=='CE')$ce='X';
			if($tipodoc_inca=='TI')$ti='X';
			$pdf->SetXY(52,$fila);
			$pdf->Cell(4,4,$cc,1,0,L);	
			$pdf->SetXY(66,$fila);
			$pdf->Cell(4,4,$ce,1,0,L);	
			$pdf->SetXY(80,$fila);
			$pdf->Cell(4,4,$ti,1,0,L);
			
			$pdf->SetXY(105,$fila);
			$pdf->Cell(70,5,$docum_inca,0,0,L);

			$pdf->SetXY(180,$fila);
			$pdf->Cell(68,5,$edad_inca,0,0,L);			
	
			if($tformato_inca=='D')
			{
				$fila=$fila+5;
				$pdf->SetXY(10,$fila);
				$pdf->Cell(20,5,'PLANTEL EDUCATIVO:',0,0,L);
				
				$pdf->SetFont('Arial','U',8);
				$pdf->SetXY(42,$fila);				
				$pdf->MultiCell(138,5,'  '.$estedu_inca.' ('.$codigo_dane.')   ',0,L,0);
				$pdf->SetFont('Arial','',8);	
				$fila=$pdf->GetY();
				
				$pdf->SetXY(10,$fila);
				$pdf->Cell(20,5,'MUNICIPIO: ',0,0,L);
				
				$pdf->SetFont('Arial','U',8);

				$pdf->Cell(97,5,'  '.$muni_inca.'  ',0,0,L);
				$pdf->SetFont('Arial','',8);					
				
				//$estedu_inca=substr($estedu_inca,0,40);
				//if(!empty($codigo_dane))$estedu_inca=$estedu_inca." (".$codigo_dane.")";
				
				
				
				//$pdf->SetXY(42,$fila);
				//$pdf->Cell(118,5,$estedu_inca,0,0,L);
				//$pdf->Cell(136,5,$muni_inca,0,0,L);				
				$fila=$pdf->GetY();
				$fila=$fila+5;
				$pdf->SetXY(10,$fila);
				$pdf->Cell(20,5,'AREA ESPECIALIDAD: ______________________________________________________________  JORNADA:    Mañana         Tarde        Noche',0,0,L);
				
				$pdf->SetXY(45,$fila);
				$pdf->Cell(136,5,$nomereaespe_inca,0,0,L);	
				
				$ma=' ';$ta=' ';$no=' ';
				if($jornada_inca=='M')$ma='X';
				if($jornada_inca=='T')$ta='X';
				if($jornada_inca=='N')$no='X';
				$pdf->SetXY(169,$fila);
				$pdf->Cell(4,4,$ma,1,0,L);	
				$pdf->SetXY(183,$fila);
				$pdf->Cell(4,4,$ta,1,0,L);	
				$pdf->SetXY(198,$fila);
				$pdf->Cell(4,4,$no,1,0,L);
			}
			$fila=$fila+5;
			$pdf->SetXY(10,$fila);
			$pdf->Cell(20,5,'DIAS DE INCAPACIDAD: __________________________________________________________________________________ ',0,0,L);
			$pdf->SetXY(47,$fila);
			$pdf->Cell(20,5,$letdias_inca,0,0,L);
			$pdf->SetXY(175,$fila);
			$pdf->Cell(20,4,$numdias_inca,1,0,C);
			$pdf->Cell(20,5,'DIAS',0,0,L);
					
			$fila=$fila+5;
			$pdf->SetXY(134,$fila);			
			$pdf->SetFont('Arial','',6);		
			$pdf->Cell(8,4,'DIA',0,0,C);
			$pdf->Cell(8,4,'MES',0,0,C);
			$pdf->Cell(8,4,'AÑO',0,0,C);
			$pdf->SetXY(178,$fila);	
			$pdf->Cell(8,4,'DIA',0,0,C);
			$pdf->Cell(8,4,'MES',0,0,C);
			$pdf->Cell(8,4,'AÑO',0,0,C);
			$pdf->SetFont('Arial','',8);		
			$fila=$fila+3;
			
			$psi=' ';$pno=' ';
			if($prorroga_inca=='S')$psi='X';
			else $pno='X';
			
			$pdf->SetXY(10,$fila);
			$pdf->Cell(20,5,'PRORROGA:',0,0,L);
			$pdf->Cell(8,5,'SI',0,0,C);			
			$pdf->Cell(4,4,$psi,1,0,L);
			$pdf->Cell(8,5,'NO',0,0,C);			
			$pdf->Cell(4,4,$pno,1,0,L);
			$pdf->Cell(80,5,'PERIODO COMPRENDIDO:      DESDE',0,0,R);
			$pdf->Cell(8,4,$diai,1,0,C);
			$pdf->Cell(8,4,$mesi,1,0,C);
			$pdf->Cell(8,4,$anoi,1,0,C);
			$pdf->Cell(20,5,'HASTA',0,0,R);
			$pdf->Cell(8,4,$diaf,1,0,C);
			$pdf->Cell(8,4,$mesf,1,0,C);
			$pdf->Cell(8,4,$anof,1,0,C);
			
			$bd1=mysql_query("select * from cie_10 where cod_cie10='$dx_inca'");
			while($rd1=mysql_fetch_array($bd1))
			{
				$desd1=$rd1['nom_cie10'];
			}		
			
			$fila=$fila+5;
			$pdf->SetXY(10,$fila);			
			$pdf->Cell(50,5,'DIAGNOSTICO (Qué genera la incapacidad): _____________________________________________________________________________________',0,0,L);
			$pdf->SetXY(68,$fila);
			$pdf->Cell(8,4,$dx_inca.' - '.$desd1,0,0,L);
			
			$fila=$fila+5;
			$pdf->SetXY(60,$fila);			
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(8,4,'DIA',0,0,C);
			$pdf->Cell(8,4,'MES',0,0,C);
			$pdf->Cell(8,4,'AÑO',0,0,C);
			
			$pdf->SetFont('Arial','',8);
			$fila=$fila+3;
			$pdf->SetXY(10,$fila);
			
			$pdf->Cell(50,5,'FECHA PROBABLE DE PARTO:',0,0,l);
			$pdf->Cell(8,4,$diap,1,0,C);
			$pdf->Cell(8,4,$mesp,1,0,C);
			$pdf->Cell(8,4,$anop,1,0,C);
			$fila=$fila+5;
			$pdf->SetXY(10,$fila);
			$pdf->Cell(8,4,'ATENTAMENTE',0,0,L);
			
			$pdf->Rect(70, $fila, 83, 32);
			
			$pdf->Rect(156, $fila, 46, 32);
					
			$pdf->SetXY(70,$fila);
			$pdf->MultiCell(83,5,'OBSERVACIONES: '.$obse_inca,0,L,0);
			
			$lm='';$ec='';$at='';$la='';$lp='';$el='';$al='';
			if($tipo_inca=='LM')$lm='X';
			if($tipo_inca=='EC')$ec='X';
			if($tipo_inca=='AT')$at='X';
			if($tipo_inca=='LA')$la='X';
			if($tipo_inca=='LP')$lp='X';
			if($tipo_inca=='EL')$el='X';
			if($tipo_inca=='AL')$al='X';
			
			$fila1=$fila+2;
			$pdf->SetXY(157,$fila1);
			$pdf->Cell(4,4,$lm,1,0,C);
			$pdf->Cell(4,4,'LICENCIA DE MATERNIDAD',0,0,L);
			$fila1=$fila1+4;
			$pdf->SetXY(157,$fila1);
			$pdf->Cell(4,4,$ec,1,0,C);
			$pdf->Cell(4,4,'ENFERMEDAD COMUN',0,0,L);
			$fila1=$fila1+4;
			$pdf->SetXY(157,$fila1);
			$pdf->Cell(4,4,$at,1,0,C);
			$pdf->Cell(4,4,'ACCIDENTE DE TRANSITO',0,0,L);
			$fila1=$fila1+4;
			$pdf->SetXY(157,$fila1);
			$pdf->Cell(4,4,$la,1,0,C);
			$pdf->Cell(4,4,'LICENCIA POR ABORTO',0,0,L);
			$fila1=$fila1+4;
			$pdf->SetXY(157,$fila1);
			$pdf->Cell(4,4,$lp,1,0,C);
			$pdf->Cell(4,4,'LICENCIA POR PATERNIDAD',0,0,L);
			$fila1=$fila1+4;
			$pdf->SetXY(157,$fila1);
			$pdf->Cell(4,4,$el,1,0,C);
			$pdf->Cell(4,4,'ENFERMEDAD LABORAL',0,0,L);
			$fila1=$fila1+4;
			$pdf->SetXY(157,$fila1);
			$pdf->Cell(4,4,$al,1,0,C);
			$pdf->Cell(4,4,'ACCIDENTE DE TRABAJO',0,0,L);
		/*	
			if($tipolic=='EL')$r6="checked";
		if($tipolic=='AL')$r7="checked";
		*/	
			$bespe=mysql_query("SELECT medicos.cod_medi, destipos.nomb_des
			FROM medicos INNER JOIN destipos ON medicos.espe_med = destipos.codi_des
			WHERE (((medicos.cod_medi)='$codmedi_inca'))");	
			while($respe=mysql_fetch_array($bespe))
			{
				$nomespecialidad=$respe['nomb_des'];
			}	
			$fila=$fila+10;
			$firma="../firmas/".$codmedi_inca.".jpg";
			if(file_exists($firma)){
			  $pdf->Image($firma,10,$fila,50,15,'','');
			}
			
			$fila=$fila+12;
			$pdf->SetXY(10,$fila);
			$pdf->Cell(45,5,'____________________________________',0,0,L);
			
			$fila=$fila+4;
			$pdf->SetXY(10,$fila);
			$pdf->Cell(45,5,$nommedi_inca,0,0,L);
			if(!empty($nomespecialidad))
			{
				$fila=$fila+4;
				$pdf->SetXY(10,$fila);
				$pdf->Cell(45,5,'Especialidad: '.$nomespecialidad,0,0,L);
			}
			
			if(!empty($regmedi_inca))
			{
				$fila=$fila+4;
				$pdf->SetXY(10,$fila);
				$pdf->Cell(45,5,'Registro medico: '.$regmedi_inca,0,0,L);
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
			$trasncri_efo=$rfor[trasncri_efo];
			$meditrans=$rfor[meditrans];
			$espetrans=$rfor[espetrans];			
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
		$formato='FRHOS-69';
		$imaenca="../funciones_php/img/logo_encabezado.JPG";
		include ('../funciones_php/formatos.php');
		$fila_=$fila_+3;	
		
	}
	if($m==2)	//laboratorio
	{
		$formato='FRHOS-69';
		$imaenca="../funciones_php/img/logo_encabezado.JPG";
		include ('../funciones_php/formatos.php');
		$fila_=$fila_+3;
	}		
	if($m==3)	//remisiones
	{
		$formato='FRHOS-69';
		$imaenca="../funciones_php/img/logo_encabezado.JPG";
		include ('../funciones_php/formatos.php');
		$fila_=$fila_+3;
	}
	if($m==4)	//formula
	{
		//$pdf_->Image('img\enca_formula2.jpg',2,$fila_,202,0,'','');
		$formato='FRFAR-225';
		$imaenca="../funciones_php/img/logo_encabezado.JPG";
		include ('../funciones_php/formatos.php');
	}
	
	if($m==5)	//historia
	{
		if($vec_[20]=='04')
		{
			//$pdf_->Image('img\enca_histo.JPG',1,$fila_+2,210,0,'','');
			//$pdf_->Image('img\controlado.png',203,130,7,30,'','');
			//$pdf_->Image('img\pie_histo.JPG',2,255,210,0,'','');
			$formato='FRCME-01';
			$imaenca="../funciones_php/img/logo_encabezado.JPG";
			include ('../funciones_php/formatos.php');
		}
		else
		{
			//$pdf_->Image('img\enca_histo.JPG',1,$fila_,210,0,'','');
			//$pdf_->Image('img\controlado.png',203,100,7,30,'','');
			//$pdf_->Image('img\pie_histo.JPG',2,255,210,0,'','');
			$formato='FRCME-01';
			$imaenca="../funciones_php/img/logo_encabezado.JPG";
			include ('../funciones_php/formatos.php');
		}
		$fila_=$fila_+3;
		//$pdf_->Image('img\enca_histo.JPG',205,100,7,30,'','');
	}
	
	
	if($m==6)	//solicitud quirofano
	{
		//$pdf_->Image('img\enca_quiro1.JPG',1,$fila_+2,210,0,'','');
		//$pdf_->Image('img\controlado.png',203,100,7,30,'','');
		
		$formato='FRCIR-73';
		$imaenca="../funciones_php/img/logo_encabezado.JPG";
		include ('../funciones_php/formatos.php');
		$fila_=$fila_+3;
	}
	
	
	if($m==8)	//recomendaciones
	{
		
	}
	
	if($m==21)	//consentimiento informado
	{
		/*
		$pdf_->Image('img\enca_cinformado1.jpg',3,$fila_+2,210,0,'','');
		$pdf_->Image('img\controlado.png',203,100,7,30,'','');
		*/
		$formato='FRCIR-34';
		$imaenca="../funciones_php/img/logo_encabezado.JPG";
		include ('../funciones_php/formatos.php');
		$fila_=$fila_+3;
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
	
	
//	$pdf_->SetXY(5,$fila);
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
	/*
		$pdf_->SetXY(95,$filanu);
		$pdf_->Cell(20,5,"Etnia:",0);		
		$pdf_->SetXY(110,$filanu);
		$pdf_->Cell(20,5,$etnia,0);	
	*/	
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
		if($m==4){$fila_=0;}
		else{$fila_=0;}
	}
	else
	{			
		$fila_=144;
	}
	
	//$pdf_->Image('img\enca_formula2.jpg',2,$fila_,202,0,'','');
	
	
	$formato='FRFAR-225';
	$imaenca="../funciones_php/img/logo_encabezado.JPG";
	include ('../funciones_php/formatos.php');
	$fila_=$fila_+8;
	
	
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
	
	$pdf_->SetXY(5,$fila_+35);
	$pdf_->Cell(74,5,'Teléfono: '.$telefono,1,0,'C');
	$pdf_->Cell(74,5,'Edad: '.$edad,1,0,'C');
	

	return $pag;
	
}
//1447 144

function tituloformuonco(&$pdf_,&$fila_,&$vec_,&$pag,$m,$pos)
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
	//$pdf_->Image('img\enca_formuonco.jpg',5,$fila_,202,0,'','');
	$formato='FRQMT-13';
	$imaenca="../funciones_php/img/logo_encabezado.JPG";
	include ('../funciones_php/formatos.php');
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
	$fila_=$fila_+8;
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
	
	$pdf_->SetXY(5,$fila_+35);
	$pdf_->Cell(74,5,'Teléfono: '.$telefono,1,0,'C');
	$pdf_->Cell(74,5,'Edad: '.$edad,1,0,'C');
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
function fechatexto($fec)
{
	$ano=substr($fec,0,4);
	$mes=substr($fec,5,2);
	$dia=substr($fec,8,2);
	
	if($mes=='01')$nmoe="ENERO";
	if($mes=='02')$nmoe="FEBRERO";
	if($mes=='03')$nmoe="MARZO";
	if($mes=='04')$nmoe="ABRIL";
	if($mes=='05')$nmoe="MAYO";
	if($mes=='06')$nmoe="JUNIO";
	if($mes=='07')$nmoe="JULIO";	
	if($mes=='08')$nmoe="AGOSTO";
	if($mes=='09')$nmoe="SEPTIEMBRE";
	if($mes=='10')$nmoe="OCTUBRE";
	if($mes=='11')$nmoe="NOVIEMBRE";
	if($mes=='12')$nmoe="DICIEMBRE";
	
	$fecret=$dia.' DE '.$nmoe.' DE '.$ano;
	return $fecret;
	
}	
	
	
?>