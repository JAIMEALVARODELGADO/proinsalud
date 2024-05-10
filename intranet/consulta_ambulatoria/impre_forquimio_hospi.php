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
		$bdesdis=mysql_query("SELECT insu_med.codi_ins, insu_med.desc_ins
		FROM insu_med WHERE (((insu_med.codi_ins)='$codi'))");
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
	
	/*
	$busu=mysql_query("SELECT encabesadohistoria.numc_ehi, encabesadohistoria.idus_ehi, encabesadohistoria.fnac_ehi,
	encabesadohistoria.feco_ehi, encabesadohistoria.nomb_ehi, municipio.NOMB_MUN, encabesadohistoria.sexo_ehi, 
	encabesadohistoria.fnac_ehi, areas.nom_areas, areas.cod_areas, consultaprincipal.radx_cpl, consultaprincipal.cod1_cpl, consultaprincipal.tidx_cpl, consultaprincipal.hosa_cpl, encabesadohistoria.cous_ehi, encabesadohistoria.telf_ehi, encabesadohistoria.origconsu_ehi AS oricon,
	consultaprincipal.cod1_cpl, consultaprincipal.inca_cpl, consultaprincipal.feinca_cpl,consultaprincipal.sire_cpl,consultaprincipal.sipi_cpl,
	encabesadohistoria.etni_ehi, encabesadohistoria.nedu_ehi, encabesadohistoria.ocup_ehi, encabesadohistoria.eciv_ehi, encabesadohistoria.dire_ehi, consultaprincipal.coti_cpl
	FROM ((encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) LEFT JOIN municipio ON encabesadohistoria.muat_ehi = municipio.CODI_MUN) INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas
	WHERE (((encabesadohistoria.numc_ehi)='$numhisto'))");
	*/

	$busu=mysql_query("SELECT encabesadoformula.numc_efo, encabesadoformula.serv_efo, encabesadoformula.feco_efo, 
	usuario.FNAC_USU, usuario.TRES_USU, usuario.CODI_USU, usuario.NROD_USU, usuario.REGI_USU,
	concat(usuario.PNOM_USU,' ',usuario.SNOM_USU,' ',usuario.PAPE_USU,' ',usuario.SAPE_USU) as nombre, usuario.SEXO_USU,
	medicos.cod_medi, medicos.nom_medi, medicos.reg_medi, destipos.nomb_des AS especialidad, contrato.CODI_CON, 
	contrato.NEPS_CON
	FROM (((encabesadoformula INNER JOIN usuario ON encabesadoformula.codi_usu = usuario.CODI_USU) INNER JOIN contrato ON encabesadoformula.codi_con = contrato.CODI_CON) INNER JOIN medicos ON encabesadoformula.cod_medi = medicos.cod_medi) LEFT JOIN destipos ON medicos.espe_med = destipos.codi_des
	WHERE (((encabesadoformula.numc_efo)='$numhisto'))");

	
	/*
	NROD_USU	
	servicio
	contingencia
	aseguradora
	nombre		nombres y apellidos
	cedula
	municipio
	Genero
	Dia
	mes
	año
	regimen
	telefono
	edad
	
	codigo medico
	nombre medico
	registro medico
	*/
	
	
	
	
	
	
	
	
	while($rusu=mysql_fetch_array($busu))
	{
		$area=$rusu['serv_efo'];
		$impre=1;
		if(strlen($area)==4 && substr($area,0,2)=='06')
		{
			$impre=2;
			$bar=mysql_query("select valo_des from destipos where codi_des='$area'");
			$rar=mysql_fetch_array($bar);
			$area=$rar['valo_des'];
		}
		
		$bas=mysql_query("SELECT * FROM `areas` WHERE `cod_areas` = '$area'");
		while ($ras=mysql_fetch_array($bas))
		{
			$nomarea=$ras['nom_areas'];
		}
		
		
		$vec[0]=$numhisto;
	$vec[1]=$rusu['feco_efo'];//$fecha
	$vec[2]=$nomarea;//nom_areas
	$vec[3]=$rusu['nombre'];//$nombre;
	$vec[4]=$rusu['SEXO_USU'];//$rowusu[sexo_usu];//$Sexo

	$vec[5]=strtoupper($rusu['NEPS_CON']);
	
	$vec[6]=$rusu['NROD_USU'];//$rowusu[nrod_usu];//$dentificacion//fnac_ehi
		
		$vec[8]=$rusu['NOMB_MUN'];	
		$vec[9]=$rusu['radx_cpl'];
	$vec[10]=$diag;
		$vec[11]=$rusu['tidx_cpl'];
		$vec[12]=$rusu['hosa_cpl'];
		$cous=$rusu['cous_ehi'];
		
		
		$codimedico=$rusu['cod_medi'];
		$nombmedico=$rusu['nom_medi'];
		$regimedico=$rusu['reg_medi'];
		$especialidad=$rusu['especialidad'];
		
		$fnaci=$rusu['FNAC_USU'];
	$vec[7]=calculaedad($fnaci);
		$vec[33]=$rusu['REGI_USU'];
		
		
		$vec[14]=$rusu['TRES_USU'];
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
		
		$vec[32]="ENFERMEDAD GENERAL";
		$vec[21]="PASTO";
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
				$fila=45;
			}
			else
			{
//cambio de tamaño e imagen				
				$pag=tituloformu($pdf,$fila,$vec,$pag,4,2);
				//$pdf->Image('img\piemed2.jpg',3,122,202,16,'','');
				$fila=$fila+40;
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
	if($med=='1')
	{
		$ciclo='';
		$boncoci=mysql_query("select * from medicamentos_oncologia where num_histo='$numhisto'");
		while($roncoci=mysql_fetch_array($boncoci))
		{			
			if($ciclo=='')$ciclo=$roncoci['ciclo'];
			$peso=$roncoci['peso'];
			$talla=$roncoci['talla'];
		}
		$bonco=mysql_query("select * from medicamentos_oncologia where num_histo='$numhisto'");
		$nonc=mysql_num_rows($bonco);
		if($nonc>0)
		{
			$fila=300;
			$pag=tituloformuonco($pdf,$fila,$vec,$pag,4,1);
			//$pdf->Image('img\pie_formuonco.jpg',3,260,202,16,'','');
			$fila=54;				
			
					
			$circor=sqrt(($peso*$talla)/3600);
			$sct=number_format ($circor , 2 , "." , "," );	
			
			
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(5,$fila);
			$pdf->Cell(50,5,'PESO: '.$peso,1,0,C);
			$pdf->Cell(50,5,'TALLA: '.$talla,1,0,C);
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
$pdf->Output();
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