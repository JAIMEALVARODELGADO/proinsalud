<?php
	session_register('paciente');
	session_register('Gcod_mediconh');	
	session_register('Gareanh'); 
	session_register('Gcontratonh');
	session_register('numcita');
?>
<html>
<head>
<script language="JavaScript">
	function salir()
	{		
		uno.action='impre_histo0.php';
		uno.target='';
		uno.submit();
	}
</script>
</head>
<?php	
	$archivo12='tmp/5HC'.$numcita.'-'.$paciente.'.txt';	
	$nlab=0;
	if(file_exists($archivo12))
	{
		$fp = fopen ($archivo12, "r" );
		$reg1=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{ 
			$reg++;
			$i = 0;
			foreach($data as $dato)
			{
				$campo[$i]=$dato;
				$i++ ;
			}
			$$campo[1]=$campo[2];
			if($reg % 8 == 0)
			{
				$ini=substr($codorden,0,2);
				if($ini=='90')$nlab=1;; 
			}				
		}
	}
	$cantiexalab=$nlab; //cantidad de examenes de laboratorio 
	
	$archivo14='tmp/8HC'.$numcita.'-'.$paciente.'.txt';	
	if(file_exists($archivo14))
	{
		$fp = fopen ($archivo14, "r" );
		$reg=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{ 
			$reg++;
			$i = 0;
			foreach($data as $dato)
			{
				$campo[$i]=$dato;
				$i++ ;
			}
			$$campo[1]=$campo[2];		
		}
	}
	$tipoproxima=$tiproxi;
	$proxicontrol=$proxima; //numero dias proximo control
	
	
	$archivo12='tmp/5HC'.$numcita.'-'.$paciente.'.txt';	
	$nlab=0;
	$procontrol=0;
	if(file_exists($archivo12))
	{
		$fp = fopen ($archivo12, "r" );
		$reg1=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{ 
			$reg++;
			$i = 0;
			foreach($data as $dato)
			{
				$campo[$i]=$dato;
				$i++ ;
			}
			$$campo[1]=$campo[2];
			if($reg % 8 == 0)
			{
				
				if($claseorden=="4")
				{
					$proxicontrol=$cantorden*30;
					$tipoproxima='1';
				}
			}				
		}
	}
	
	/*
	echo "<input type=hidden name=procontrol value=$procontrol>"; //valida si se cito a control 0=no, 1=si
	echo "<input type=hidden name=clorden value=$clorden>"; // valida si hay referencia 0=no 1=si
	echo "<input type=hidden name=numlab value=$nlab>"; //	valida si hay ordenes de laboratorio 0=no 1=si
	*/
	
	
	function getRealIP() 
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))return $_SERVER['HTTP_CLIENT_IP'];
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))return $_SERVER['HTTP_X_FORWARDED_FOR'];
		return $_SERVER['REMOTE_ADDR'];
	}
	$ip=getRealIP();
	$tok = strtok ($ip,".");
	$n=0;
	while ($tok) 
	{	
		$tok = strtok (".");
		$vec[$n]=$tok;
		$n++;	
	}
	$rangoip=$vec[1];
	include ('php/conexion1.php');
	include ('../funciones_php/genera_cita.php');
	$busori=mysql_query("select * from origen_consulta where codi_ori='$rangoip'");
	$codimunicipio='52001';
	while($rusori=mysql_fetch_array($busori))
	{
		$codimunicipio=$rusori['codmuni_ori'];		
	}	
	$archivolis='tmp/lista.txt';		
	if(file_exists($archivolis))
	{
		$fp = fopen ($archivolis, "r" );
		$reg=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{ 
			$reg++;
			$i = 0;
			foreach($data as $dato)
			{
				$campo[$i]=$dato;
				$i++ ;
			}					
		}
		fclose ($fp);
	}	
	for($i=1;$i<=$reg;$i++)
	{
		if($campo[$i]!=$numcita)
		{
			$numc=$campo[$i];
			$a="$numc\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
		}
	}
	//$paciente='1177';	
	echo"<form name=uno method=p
	ost>";	
	$fechafin=date('Y-m-d');
	$horafin=date('H:i:s');	
	$archivo0='tmp/0HC'.$numcita.'-'.$paciente.'.txt';		
	if(file_exists($archivo0))
	{
		$fp = fopen ($archivo0, "r" );
		$reg=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{ 
			$reg++;
			$i = 0;
			foreach($data as $dato)
			{
				$campo[$i]=$dato;
				$i++ ;
			}
			$$campo[1]=$campo[2];		
		}
		fclose ($fp);
	}
	$mediconsulta=$Gcod_mediconh;
	
//para medicamentos antimicribianos
//	$medicoResponsable=$Gcod_mediconh;
//fin antimicrobianos	
	
	$archivo1='tmp/1HC'.$numcita.'-'.$paciente.'.txt';		
	if(file_exists($archivo1))
	{
		$fp = fopen ($archivo1, "r" );
		$reg=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{ 
			$reg++;
			$i = 0;
			foreach($data as $dato)
			{
				$campo[$i]=$dato;
				$i++ ;
			}
			$$campo[1]=$campo[2];		
		}
		fclose ($fp);
	}	
	$archivo2='tmp/2HC'.$numcita.'-'.$paciente.'.txt';		
	if(file_exists($archivo2))
	{
		$fp = fopen ($archivo2, "r" );
		$reg=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{ 
			$reg++;
			$i = 0;
			foreach($data as $dato)
			{
				$campo[$i]=$dato;
				$i++ ;
			}
			$$campo[1]=$campo[2];		
		}
		fclose ($fp);
	}	
	$archivo4='tmp/4HC'.$numcita.'-'.$paciente.'.txt';		
	if(file_exists($archivo4))
	{
		$fp = fopen ($archivo4, "r" );
		$reg=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{ 
			$reg++;
			$i = 0;
			foreach($data as $dato)
			{
				$campo[$i]=$dato;
				$i++ ;
			}
			$$campo[1]=$campo[2];		
		}
		fclose ($fp);
	}
	$archivo8='tmp/8HC'.$numcita.'-'.$paciente.'.txt';		
	if(file_exists($archivo8))
	{
		$fp = fopen ($archivo8, "r" );
		$reg=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{ 
			$reg++;
			$i = 0;
			foreach($data as $dato)
			{
				$campo[$i]=$dato;
				$i++ ;
			}
			$$campo[1]=$campo[2];		
		}
		fclose ($fp);
	}
    //ECHO 'CONTRA '.$contrarefe;
	//tabla Consultaprincipal
	$conti=substr($conti,2,2);
	$causa=substr($causa,2,2);
	$final=substr($final,2,2);	
	$pagi2=mysql_query("SELECT encabesadohistoria.feco_ehi, consultaprincipal.area_cpl, encabesadohistoria.cous_ehi
	FROM consultaprincipal INNER JOIN encabesadohistoria ON consultaprincipal.numc_cpl = encabesadohistoria.numc_ehi
	WHERE (((consultaprincipal.area_cpl)='$Gareanh') AND ((encabesadohistoria.cous_ehi)='$paciente'))");
	$valor=1;
	while($row = mysql_fetch_array($pagi2))
	{ 
		$ano=$row["feco_ehi"];
		$anoco=substr($ano,0,4);
		$anoac=substr($fechaini,0,4);
		if ($anoco==$anoac)
		{
			$valor=2;
		}		
	}
		
	$s1="SELECT horarios.Hora_horario, Cotra_citas
	FROM citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario
	WHERE (((citas.id_cita)='$numcita'))";
	$pag1=mysql_query($s1);
	while($roY1 = mysql_fetch_array($pag1))
	{ 
		$hoci=$roY1["Hora_horario"];
		$cont=$roY1["Cotra_citas"];
	}
	if($tiespe=='1')
	{
		$anoac=substr($fechafin,0,4);
		$busfec=mysql_query("SELECT Max(encabesadohistoria.feco_ehi) AS fecon
		FROM consultaprincipal INNER JOIN encabesadohistoria ON consultaprincipal.numc_cpl = encabesadohistoria.numc_ehi
		WHERE (((encabesadohistoria.cous_ehi)='$paciente') AND ((consultaprincipal.area_cpl)='$Garea'))");
		while($resfec=mysql_fetch_array($busfec))
		{
			$fecon=$resfec['fecon'];
		}
		$anocon=substr($fecon,0,4);
		if($anoac==$anocon)$primera='2';
		else $primera='1';		
	}	
	if($tiespe=='2')
	{
		if($concontrol=='1')$primera='1';
		if($concontrol=='2')$primera='2';
	}
	$primera='1';
	$contrarefe='';
	$guarare=$Gareanh;
	if($Gareanh=='0634')$guarare='04';
	if($Gareanh=='0664')$guarare='01';	
	$motivo=str_replace( "�",chr(10),$motivo);
	$enfeac=str_replace( "�",chr(10),$enfeac);
	$revisi=str_replace( "�",chr(10),$revisi);
	$informe=str_replace( "�",chr(10),$informe);	
	$person=str_replace( "�",chr(10),$person);
	$familia=str_replace( "�",chr(10),$familia);
	$metodo=str_replace( "�",chr(10),$metodo);
	$gineco=str_replace( "�",chr(10),$gineco);	
	$busar=mysql_query("select * from usuario where CODI_USU='$paciente'");	
	while($rdusu=mysql_fetch_array($busar))
	{
		$nombre=$rdusu['PNOM_USU'].' '.$rdusu['SNOM_USU'].' '.$rdusu['PAPE_USU'].' '.$rdusu['SAPE_USU'];
		$munate=$rdusu['MATE_USU'];
		$telefo=$rdusu['TRES_USU'];
		$sexo=$rdusu['SEXO_USU'];
		$fnac=$rdusu['FNAC_USU'];
		$dire=$rdusu['DIRE_USU'];
		$cous=$rdusu['CODI_USU'];
		$idus=$rdusu['NROD_USU'];
		$tipodoc=$rdusu['TDOC_USU'];			
		$feco=$fechaini;
	}	
	$edpac=calcula_edad($fnac);
	$uniedad=calculaedadund($fnac);
	if(empty($mediconsulta) || empty($cous))
	{
		echo"<br><br><table align=center class='tbl'>
		<tr><th>POR SEGURIDAD SU SESION TERMINO. <BR>PARA FINALIZAR LA CONSULTA, CIERRE E INGRESE NUEVAMENTE AL PROGRAMA</th></tr>
		</table>";			
	}
	else
	{
		if(empty($numhisto))
		{			
			$fechalar=date('ymdHis');
			$numhisto=$numhisto=$mediconsulta.$fechalar;
		}
		
		$inenca=mysql_query("insert into encabesadohistoria (numc_ehi,  nomb_ehi,  muat_ehi,  telf_ehi,  sexo_ehi,  fnac_ehi,  dire_ehi,  cont_ehi,  idus_ehi,  cous_ehi, feco_ehi, unid_ehi, origconsu_ehi, etni_ehi, nedu_ehi, ocup_ehi, eciv_ehi, grupopobla, orisexual ) 
		values ('$numhisto','$nombre','$munate','$telefo','$sexo','$edpac','$direccion','$cont','$idus','$cous', 
		'$fechafin','Años', '$codimunicipio', '$etnia', '$escolaridad', '$ocupacion', '$estadocivil', '$grupo_poblacional', '$orientacion_sexual')");

		if(!$inenca)
		{
			echo"<br><br><table align=center class='tbl'>
			<tr><th>ERROR EN LA CONECCION 1. <BR>PARA FINALIZAR LA CONSULTA, CIERRE E INGRESE NUEVAMENTE AL PROGRAMA</th></tr>
			</table>";
		}
		else
		{		
			$insconpri=mysql_query("insert into consultaprincipal (numc_cpl,  feca_cpl,  hora_cpl,  area_cpl,  
			enac_cpl,  motc_cpl,  catr_cpl,  hosa_cpl,  
			come_cpl,  coti_cpl,  caex_cpl,  tidx_cpl,  fina_cpl,  resi_cpl,  radx_cpl,  sire_cpl,  codi_cpl,  coan_cpl,  hoci_cpl,  cod1_cpl,  sipi_cpl, 
			antefam_cpl, anteper_cpl,antegin_cpl, mepl_cpl, core_cpl, vers_apli,inca_cpl,feinca_cpl,traslado_cpl, remitido_cpl, ipsref_cpl, refopor_cpl, refperti_cpl, doccomple_cpl, certicronico_clp, vicviosexual_clp) 
			values ('$numhisto','$fechafin','$horaini','$guarare','$enfeac','$motivo','$causatrab',
			'$horafin','$mediconsulta','$conti','$causa','$tipodiag','$final','$revisi','$informe',  '$sintorespi','$primera',   '$valor','$hoci','$cod','$sintopiel','$familia',
			'$person','$gineco','$metodo','$contrarefe','5503','$incadias','$incaini','$arearemision', '$refer','$codipsrem','$referopo','$referper','$documcom','$patolocronicas','$vicviolencia')");
			/*
			echo "insert into consultaprincipal (numc_cpl,  feca_cpl,  hora_cpl,  area_cpl,  
			enac_cpl,  motc_cpl,  catr_cpl,  hosa_cpl,  
			come_cpl,  coti_cpl,  caex_cpl,  tidx_cpl,  fina_cpl,  resi_cpl,  radx_cpl,  sire_cpl,  codi_cpl,  coan_cpl,  hoci_cpl,  cod1_cpl,  sipi_cpl, 
			antefam_cpl, anteper_cpl,antegin_cpl, mepl_cpl, core_cpl, vers_apli,inca_cpl,feinca_cpl,traslado_cpl, remitido_cpl, ipsref_cpl, refopor_cpl, refperti_cpl, doccomple_cpl, certicronico_clp, vicviosexual_clp) 
			values ('$numhisto','$fechafin','$horaini','$guarare','$enfeac','$motivo','$causatrab',
			'$horafin','$mediconsulta','$conti','$causa','$tipodiag','$final','$revisi','$informe',  '$sintorespi','$primera',   '$valor','$hoci','$cod','$sintopiel','$familia',
			'$person','$gineco','$metodo','$contrarefe','5503','$incadias','$incaini','$arearemision', '$refer','$codipsrem','$referopo','$referper','$documcom','$patolocronicas','$vicviolencia')<br>";
            
			*/
			
			$iden_cpl=  mysql_insert_id();
			if(!$insconpri)
			{
				mysql_query("DELETE FROM encabesadohistoria WHERE numc_ehi='$numhisto'");
				echo"<br><br><table align=center class='tbl'>
				<tr><th>ERROR EN LA CONECCION 2. <BR>PARA FINALIZAR LA CONSULTA, CIERRE E INGRESE NUEVAMENTE AL PROGRAMA</th></tr>
				</table>"; 
			}
			else
			{
				mysql_query("UPDATE usuario SET GPOBL_USU='$grupo_poblacional', OSEXUAL_USU=='$orientacion_sexual' WHERE CODI_USU='$cous'");
				
				$nomacu=$pnomacu.' '.$snomacu.' '.$papeacu.' '.$sapeacu;
				mysql_query("INSERT INTO `acompanante` ( `numc_aco` , `noma_aco` , `dire_aco` , `tele_aco` , `pare_aco` , `tdoc_aco` , `ndoc_aco` , `pnom_aco` , `snom_aco` , `pape_aco` , `saco_nom` , `munr_aco` ) 
				VALUES ('$numhisto', '$nomacu', '$direacu', '$teleacu', '$parenacu', '$tidoacu', '$nudoacu', '$pnomacu', '$snomacu', '$papeacu', '$sapeacu', '$muniacu')");
				mysql_query("insert into antefemeninos (numc_afe,  fech_afe,  idus_afe,  feum_afe,  gest_afe,  part_afe,  cesa_afe,  abor_afe,  vivo_afe,  mort_afe, ante_afe,  otro_afe) 
				values ('$numhisto','$fechafin', '$paciente', '$feulme','$gestan','$partos','$cesareas', '$abortos',  '$vivos',  '$mortinatos','$gineco',  '')");		
				mysql_query("insert into consulta_soap (numc_soap, subj_soap, obje_soap, anal_soap, plan_soap, exfi_soap) values ('$numhisto','', '', '$analpv', '', '')");
				if(!empty($cod1)) mysql_query("insert into diagnosticos2 (numc_di2,  codc_di2,  orde_die2, obse_die2 ) values ('$numhisto','$cod1','R1','$obse1')");
				if(!empty($cod2)) mysql_query("insert into diagnosticos2 (numc_di2,  codc_di2,  orde_die2, obse_die2 ) values ('$numhisto','$cod2','R2','$obse2')");
				if(!empty($cod3)) mysql_query("insert into diagnosticos2 (numc_di2,  codc_di2,  orde_die2, obse_die2  ) values ('$numhisto','$cod3','R3','$obse3')");
				$archivodolor='tmp/HCDOLOR'.$numcita.'-'.$paciente.'.txt';		
				if(file_exists($archivodolor)==FALSE)
				{
					$archivo3='tmp/3HC'.$numcita.'-'.$paciente.'.txt';		
					if(file_exists($archivo3))
					{
						$fp = fopen ($archivo3, "r" );
						$reg=0;
						while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
						{ 
							$reg++;
							$i = 0;
							foreach($data as $dato)
							{
								$campo[$i]=$dato;
								$i++ ;
							}
							$$campo[1]=$campo[2];		
						}
						fclose ($fp);
						unlink ($archivo3);
					}
					$otros=str_replace( "�",chr(10),$otros);	
					mysql_query("insert into examenfisico (numc_efi, tear_efi,  fres_efi,  fcar_efi,  temp_efi,  peso_efi,  tall_efi,  pcfa_efi,  otrh_efi, tea2_efi, icc_efi, imc_efi, saox_tri) values 
					('$numhisto','$tenar1','$freres','$fc','$tempe','$peso','$talla','$pc','$otros','$tenar2','$icc', '$imc', '$saox_tri')");
					for($i=0;$i<$fin;$i++)
					{				
						$nomvar='codiexa'.$i;
						$codiexa=$$nomvar;
						$nomvar='item'.$i;
						$item=$$nomvar;				
						$nomvar='obseexa'.$i;
						$obseexa=$$nomvar;
						if($item==1)
						{
							mysql_query("insert into complementoexfisico (code_cef,  numc_cef,  anor_cef,  desc_cef) values ('$codiexa','$numhisto','$nor','$obseexa')");
						}
					}
				}
				else
				{					
					$codprograma=1;
					$archivo='tmp/ex_comp'.$codprograma.'-'.$numcita.'-'.$paciente.'.txt';    
					if(file_exists($archivo))
					{
			//            $archivob='tmp/oft'.$codprograma.'-'.$Gcod_medico.'-'.$paciente.'.txt';
						$fp = fopen ($archivo, "r" );
						$reg=0;
						while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
						{ 
							$reg++;
							$i = 0;
							foreach($data as $dato)
							{
								$campo[$i]=$dato;
								$i++ ;
							}
							$$campo[1]=$campo[2];		
						}
						fclose ($fp);
						unlink($archivo);
					}					
					$archivo1='tmp/ex_fisi'.$codprograma.'-'.$numcita.'-'.$paciente.'.txt';
					if(file_exists($archivo1))
					{
			//          $archivob='tmp/oft'.$codprograma.'-'.$Gcod_medico.'-'.$paciente.'.txt';
						$fp = fopen ($archivo1, "r" );
						$reg=0;
						while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
						{ 
							$reg++;
							$i = 0;
							foreach($data as $dato)
							{
								$campo[$i]=$dato;
								$i++ ;
							}
							$$campo[1]=$campo[2];		
						}
						fclose ($fp);
						unlink($archivo1);
					}					
					$archivo2='tmp/conclu'.$codprograma.'-'.$numcita.'-'.$paciente.'.txt';
					if(file_exists($archivo2))
					{
			//            $archivob='tmp/oft'.$codprograma.'-'.$Gcod_medico.'-'.$paciente.'.txt';
						$fp = fopen ($archivo2, "r" );
						$reg=0;
						while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
						{ 
							$reg++;
							$i = 0;
							foreach($data as $dato)
							{
								$campo[$i]=$dato;
								$i++ ;
							}
							$$campo[1]=$campo[2];		
						}
						fclose ($fp);
						unlink($archivo2);
					}
					
					$hemocla_exc=$hemocla_exc.$factorrh_exc;
					
					$sql_ins1="INSERT INTO preanes_examencomple(iden_consulta,     hemoglo_exc,    glicemi_exc,   hemocla_exc,   hematoc_exc,    bun_exc,   protein_exc,   plaquet_exc,    creatin_exc,   albumin_exc,   tp_exc,   sodio_exc,   bilitot_exc,   tpt_exc,   potasio_exc,   bilidir_exc,   tiposan_exc,   calcio_exc,  vdrl_exc,   coagula_exc,   leucoci_exc,    prembar_exc,  rxfecha_exc,   rxdescrip_exc,   ecgfecha_exc,   ecgdescrip_exc,    ecofecha_exc,   ecodescrip_exc,   otrofecha_exc,   otrodescrip_exc,   numero_cons)
					VALUES('$iden_consulta', '$hemoglo_exc', '$glicemi_exc','$hemocla_exc','$hematoc_exc','$bun_exc', '$protein_exc','$plaquet_exc','$creatin_exc','$albumin_exc','$tp_exc','$sodio_exc','$bilitot_exc','$tpt_exc','$potasio_exc','$bilidir_exc','$tiposan_exc','$calcio_exc','$vdrl_exc','$coagula_exc','$leucoci_exc','$prembar_exc','$rxfecha_exc','$rxdescrip_exc','$ecgfecha_exc','$ecgdescrip_exc','$ecofecha_exc','$ecodescrip_exc','$otrofecha_exc','$otrodescrip_exc',  '$numhisto')";
					//echo $sql_ins1.'<br><br>';	
					mysql_query($sql_ins1);
					
					//echo $sql_ins1.'<br><br>';
					$presion_exf=$presions_exf.' / '.$presiond_exf;
					
					$sql_ins2="INSERT INTO preanes_examenfisico(iden_consulta,    peso_exf,     talla_exf,     tempera_exf,    saturo2_exf,     presion_exf,     frecard_exf,      freresp_exf,     estado_exf,     snc_exf,      dentsuperior_exf,     dentinferior_exf,     dentfija_exf,    dentmovil_exf,     dentparcial_exf,      denttotal_exf,       apertur_exf,    estadodien_exf,      imallam_exf,      dmentoh_exf,     movilid_exf,    anormali_exf,     torax_exf,      pulmones_exf,     corazon_exf,    abdomen_exf,     genitouri_exf,     extremi_exf,     otros_exf,    numero_cons, imc_exf, dimc_exf)
					VALUES('$iden_consulta', '$peso_exf',  '$talla_exf',  '$tempera_exf',  '$saturo2_exf',  '$presion_exf',  '$frecard_exf',  '$freresp_exf',  '$estado_exf',  '$snc_exf',   '$dentsuperior_exf',  '$dentinferior_exf',  '$dentfija_exf', '$dentmovil_exf', '$dentparcial_exf',   '$dentparcial_exf',   '$apertur_exf',  '$estadodien_exf',  '$imallam_exf',  '$dmentoh_exf',  '$movilid_exf',  '$anormali_exf',  '$torax_exf',  '$pulmones_exf',  '$corazon_exf',  '$abdomen_exf',  '$genitouri_exf',  '$extremi_exf',  '$otros_exf', '$numhisto', '$imc_exf', '$dimc_exf')";
					//echo $sql_ins2.'<br><br>';
					mysql_query($sql_ins2);
					
					$cirupro="";
					if($codigociru0!='')$cirupro=$cirupro.$codigociru0;
					if($codigociru1!='')$cirupro=$cirupro.','.$codigociru1;
					if($codigociru2!='')$cirupro=$cirupro.','.$codigociru2;
					if($codigociru3!='')$cirupro=$cirupro.','.$codigociru3;
					if($codigociru4!='')$cirupro=$cirupro.','.$codigociru4;

					$sql_ins3="INSERT INTO preanes_conclusion(iden_consulta,    estfisico_ccl,     clafuncional_ccl,     aptociru_ccl,       anestesia_ccl,    vario_ccl,    anestesia1_ccl,   reserva_ccl,  reservauci_ccl,    premedica_ccl,      programa_ccl,       anotacion_ccl,      reevaluar_ccl,    observa_ccl,     concent_ccl,   numero_cons, cirupro_cons, medicoproc_ccl)
					VALUES('$iden_consulta',  '$estfisico_ccl',  '$clafuncional_ccl',  '$aptociru_ccl',   '$anestesia_ccl', '$vario_ccl', '$anestesia1_ccl', '$reserva_ccl', '$reservauci_ccl',  '$premedica_ccl',  '$tprograma_ccl',   '$anotacion_ccl',   '$reevaluar_ccl',  '',  '$concent_ccl', '$numhisto', '$cirupro','$medicoproc_ccl')";
					//echo $sql_ins3.'<br><br>';
					mysql_query($sql_ins3);
					
					$sql_ins4="INSERT INTO anteced_aneste(numcit_anes, numcon_anes,     patolo_anes,        cardiovas_anes,        pulmon_anes,     quiru_anes,         farma_anes,    toxico_anes,    transfun_anes,    gineco_anes,   otros_anes,    metpla_anes)
					VALUES('$numcita',   '$numhisto',  '',  '$nuecardiovasculares', '$nuepulmonar',  '$nuequirurgicos',  '$neofarmacos', '$nuetoxico',    '$neotransfin',  '$neogineco',   '$neootros',  '$metodo')";
					//echo $sql_ins4.'<br><br>';
					mysql_query($sql_ins4);
					
				}
				//inca2991
				
				//mysql_query("insert into encabesadoformula(numc_efo,  coen_efo, obfo_efo ) values ('$numhisto','$Gcontrol','$Gobse')");
				/*
				$busar=mysql_query("select * from usuario where CODI_USU='$paciente'");
				while($rdusu=mysql_fetch_array($busar))
				{
					$nombre=$rdusu['PNOM_USU'].' '.$rdusu['SNOM_USU'].' '.$rdusu['PAPE_USU'].' '.$rdusu['SAPE_USU'];
					$munate=$rdusu['MATE_USU'];
					$telefo=$rdusu['TRES_USU'];
					$sexo=$rdusu['SEXO_USU'];
					$fnac=$rdusu['FNAC_USU'];
					$dire=$rdusu['DIRE_USU'];
					$cous=$rdusu['CODI_USU'];
					$idus=$rdusu['NROD_USU'];		
					$feco=$fechaini;
				}	
				$edpac=calcula_edad($fnac);
				$uniedad=calculaedadund($fnac);		
				$inenca=mysql_query("insert into encabesadohistoria (numc_ehi,  nomb_ehi,  muat_ehi,  telf_ehi,  sexo_ehi,  fnac_ehi,  dire_ehi,  cont_ehi,  idus_ehi,  cous_ehi, feco_ehi, unid_ehi, origconsu_ehi) values 
				('$numhisto','$nombre','$munate','$telefo','$sexo','$edpac','$dire','$cont','$idus','$cous','$fechafin','A�os', '$codimunicipio')");
				*/
				
				if(!$inenca)
				{
					mysql_query("insert into encabesadohistoria (numc_ehi,  nomb_ehi,  muat_ehi,  telf_ehi,  sexo_ehi,  fnac_ehi,  dire_ehi,  cont_ehi,  idus_ehi,  cous_ehi, feco_ehi, unid_ehi, origconsu_ehi , etni_ehi, nedu_ehi, ocup_ehi, eciv_ehi) 
					values ('$numhisto','$nombre','$munate','$telefo','$sexo','$edpac','$direccion','$cont','$idus','$cous','$fechafin','A�os', '$codimunicipio', '$etnia', '$escolaridad', '$ocupacion', '$estadocivil')");
				}
				$archivo5='tmp/5HC'.$numcita.'-'.$paciente.'.txt';
				echo"<br>";	
				$id=0;
				if(file_exists($archivo5))
				{		
					$fp = fopen ($archivo5, "r" );
					$reg=0;
					$arearemi='';		
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
						}
						$$campo[1]=$campo[2];
						
						if($reg % 8 == 0)
						{
							if($claseorden==1)$clor='O';
							if($claseorden==2)$clor='R';
							if($claseorden==3)$clor='R';
							if($claseorden==4)$clor='R';
							if($claseorden==5)$clor='A';	
							if($codorden!='0000000000')
							{
								$alservicio=$codorden;
								$esta='';
								$reauto='N';
								if($clor=='' || empty($clor))
								{
									if(strlen($codorden)>4)$clor='O';
								}							
								if($clor=='O')
								{					
									$bma=mysql_query("SELECT cups.grup_cup, cups.nive_cup, cups.codigo, destipos.val2_des AS esta
									FROM destipos INNER JOIN cups ON destipos.valo_des = cups.nive_cup
									WHERE (((cups.codi_cup)='$codorden') AND ((destipos.codt_des)='73') AND esta_cup='AC')");					
									while($rma=mysql_fetch_array($bma))
									{
										$grupo=$rma['grup_cup'];
										$esta=$rma['esta'];
										$codorden=$rma['codigo'];
										//$nivel=$rma['nive_cup'];
										if($grupo=='90')$alservicio='0631';
										if($grupo=='87' || $grupo=='88')$alservicio='0601';	
										if($grupo<>'87' && $grupo<>'88' && $grupo<>'90')
										{
											$alservicio='';
											$esta='1402';
										}
										echo '1 '.$codorden.'<br>';
									}
									echo '2 '.$codorden.'<br>';
								}
								else
								{
									$consultamag="SELECT REGMAG_CON FROM contrato WHERE CODI_CON='$cont'";
									$consultamag=mysql_query($consultamag);
									$rowmag=mysql_fetch_array($consultamag);
									$regmag_con=$rowmag[REGMAG_CON];
									if($regmag_con=='S')
									{
										$muncapita='';
										$bcapi=mysql_query("select * from municipio where CODI_MUN='$munate'");
										$rcapi=	mysql_fetch_array($bcapi);
										$muncapita=$rcapi['capita_fidu'];
										if($muncapita=='S')
										{
											$busesta=mysql_query("select * from esta_especialidad where codi_esp='$codorden'");
											$rma=mysql_fetch_array($busesta);
											$capita_espe=$rma['capita_espe'];
											if($capita_espe=='S')$esta='1402';
											else $esta='1401';
											
										}
										else 
										{	
											$esta='1401';
										}
									}									
									else $esta='1401';

									
								}
								$buco=mysql_query("select * from ucontrato where CUSU_UCO='$paciente' and CONT_UCO='$cont'");
								while($ruco=mysql_fetch_array($buco))
								{
									$contusua=$ruco['IDEN_UCO'];
								}
								if($id==0)
								{
									$codGareanh=$Gareanh;
									if(strlen($codGareanh)==4)
									{
										$busar=mysql_query("select codi_des from destipos where valo_des='$codGareanh' and codt_des='06'");
										//echo "<br>select codi_des from destipos where valo_des='$codGareanh' and codt_des='06'<br>";
										while($rusar=mysql_fetch_array($busar))
										{
											$codGareanh=$rusar['codi_des'];
										}						
									}
									$buscuco=mysql_query("select * from ucontrato where CUSU_UCO='$cous' and CONT_UCO='$cont'");
									while($rescuco=mysql_fetch_array($buscuco))
									{
										$codcuco=$rescuco['IDEN_UCO'];					
									}
									
									$insrefer=mysql_query("INSERT INTO `referencia` ( `idre_ref` , `alse_ref` , `moti_ref` , `tere_ref` , `numc_ref` , `ccie_ref` , `esta_ref` , `usua_ref` , `citas_ref` , `fevig_ref`, `cuco_ref` , `asol_ref` , `msol_ref` , `cext_ref` , `fech_ref` , `proc_ref`, `origen_ref` ) 
									VALUES (NULL ,'','','','$numhisto','$cod','1401','$mediconsulta','','0000-00-00','$codcuco','$codGareanh','$mediconsulta','$causa','$fechafin','$clor','$codimunicipio')");
									$numref=mysql_insert_id();
									$id=1;
									if($cantiexalab>0 && $claseorden==4 && $Gcontratonh=="135" && $codGareanh!='04')
									{
										//Funcion para 
										
										$valorcita=genCita($proxicontrol, $paciente, '13011947', '80', $Gcod_mediconh, $tiafilia, $Gcontratonh, $tipoproxima,$codimunicipio);
										$inicita=substr($valorcita,0,2);
										if($inicita=='ID')
										{
											$idcitasis=substr($valorcita,2,12);
										}									
										if($inicita=='FE')
										{
											$fecestima=substr($valorcita,2,12);
										}	
									}
								}							
								$consultamag="SELECT REGMAG_CON FROM contrato WHERE CODI_CON='$cont'";
								$consultamag=mysql_query($consultamag);
								$rowmag=mysql_fetch_array($consultamag);
								$regmag_con=$rowmag[REGMAG_CON];
								
								if($regmag_con=='S')$esta=$esta;
								else $esta='1401';
								$blas=mysql_query("SELECT grup_cup FROM cups
								WHERE codigo='$codorden' AND esta_cup='AC'");	
								$rlas=mysql_fetch_array($blas);
								$grulab=$rlas['grup_cup'];
								$iden_cita_lab='';
								$fecha_estimada_lab='';
								$tipo_sol_cita='';
								if($grulab==90)
								{
									$iden_cita_lab=$idcitasis;
									$fecha_estimada_lab=$fecestima;
									$tipo_sol_cita='S';
								}
								
								if($claseorden=="4")
								{
									$cantorden=1;
								}
								
								$insdetaref=mysql_query("INSERT INTO `detareferencia` ( `idre_dre` , `ccie_dre` , `desc_dre` , `codi_dre` , `cant_dre` ,  `marc_dre` , `numc_dre` , `tipo_dre` , `obsv_dre` , `iden_dre` , `modi_dre` , `alse_dre` , `tiso_dre`,`cita_dre`, `reci_dre`,`dest_dre`,`fecha_estimada`,`tipo_cita` ) 
								VALUES ('$numref','$diagorden', '','$codorden', '$cantorden', '$esta',  '$numhisto',  '', '$obseorden',NULL, '','$alservicio','$clor','$iden_cita_lab' ,'S', '$nivel','$fecha_estimada_lab','$tipo_sol_cita')");				
								$cuenta=strlen($codorden);
								if($cuenta<5)
								{					
									$borremi=mysql_query("select * from destipos where codi_des='$codorden'");
									while($rorremi=mysql_fetch_array($borremi))
									{					
										if($rorremi['homo2_des']=='F')
										{
											$arearemi=$codorden;
										}
									}
								}
							}
						}				
					}		
					fclose ($fp);
					unlink ($archivo5);		
				}
				/*
				if($arearemision=='C502' || $arearemision=='C503')
				{			
					//0668	observacion
					//0699	POR DEFINIR CONDUCTA
					//0634	Urgencias
					
					if($arearemision=='C502')$arearemi='0699';	//por definir conducta
					if($arearemision=='C503')$arearemi='04';	//observacion									
					if($arearemi!='0699') //cualquiera menos por definir conducta
					{						
						$cama='RE';
						$resul=Mysql_query("INSERT INTO `ingreso_hospitalario` ( `id_ing` , `codius_ing` , `fecin_ing` , `hora_ing` , `fecsa_ing` , `horsa_ing` , `consu_ing` , `ubica_ing` , `arerem_ing` , `cama_ing` , `contra_ing` , `caac_ing`) 
						VALUES ('','$paciente','$fechafin','$horafin','0000-00-00','00:00:00','$numhisto','04','04','','$cont','RE')");			
						$idingre=mysql_insert_id();				
						$resul2=Mysql_query("INSERT INTO `hist_traza` ( `iden_tra` , `id_ing` , `secu_tra` , `ubica_tra` , `fecin_tra` , `horin_tra` , `horas_tra` ) 
						VALUES ('0','$idingre','1','$arearemi','$fechafin','$horafin','-1')");			
					}
					else //por definir conducta
					{			
						if($arearemi=='0634')$arearemi='04';
						$cad=Mysql_query("INSERT INTO `ingreso_hospitalario` ( `id_ing` , `codius_ing` , `fecin_ing` , `hora_ing` , `fecsa_ing` , `horsa_ing` , `consu_ing` , `ubica_ing` , `arerem_ing` , `cama_ing` , `contra_ing` , `caac_ing`) 
						VALUES ('0', '$paciente', '$fechafin', '$horafin', '0000-00-00', '00:00:00','$numhisto','0699','04','','$cont', '01')");
						
						$idingre=mysql_insert_id();				
						$cad2=Mysql_query("INSERT INTO `hist_traza` ( `iden_tra` , `id_ing` , `secu_tra` , `ubica_tra` , `fecin_tra` , `horin_tra` , `horas_tra` ) 
						VALUES ('0','$idingre','1','$arearemi','$fechafin','$horafin','-1')");	
						
					}
				}
				*/

				if($arearemision=='C502' || $arearemision=='C503')
				{			
					//0668	observacion
					//0699	POR DEFINIR CONDUCTA
					//0634	Urgencias
					
					if($arearemision=='C502')$arearemi='0699';	//por definir conducta
					if($arearemision=='C503')$arearemi='04';	//observacion									
					if($arearemi!='0699') //cualquiera menos por definir conducta
					{						
						$cama='RE';
						$resul=mysql_query("INSERT INTO `ingreso_hospitalario` ( `id_ing` , `codius_ing` , `fecin_ing` , `hora_ing` , `fecsa_ing` , `horsa_ing` , `consu_ing` , `ubica_ing` , `arerem_ing` , `cama_ing` , `contra_ing` , `caac_ing`) 
						VALUES ('','$paciente','$fechafin','$horafin','0000-00-00','00:00:00','$numhisto','04','04','','$cont','RE')");			
						$idingre=mysql_insert_id();				
						$resul2=mysql_query("INSERT INTO `hist_traza` ( `iden_tra` , `id_ing` , `secu_tra` , `ubica_tra` , `fecin_tra` , `horin_tra` , `horas_tra` ) 
						VALUES ('0','$idingre','1','$arearemi','$fechafin','$horafin','-1')");	
						
						$sqlnut=mysql_query("INSERT INTO nutricion_sol_interconsulta (iden_ordennut,iden_var,numc_histo, codigo_ordennut, perdidapeso_ordennut,cuantos_ordennut,comidomenos_ordennut,esta_ordennut) 
						VALUES(null,'0',$numhisto,'0619','$perdidapeso','$cuantos','$comidomenos','PE')");
					}
					else //por definir conducta
					{			
						if($arearemi=='0634')$arearemi='04';
						$cad=Mysql_query("INSERT INTO `ingreso_hospitalario` ( `id_ing` , `codius_ing` , `fecin_ing` , `hora_ing` , `fecsa_ing` , `horsa_ing` , `consu_ing` , `ubica_ing` , `arerem_ing` , `cama_ing` , `contra_ing` , `caac_ing`) 
						VALUES ('0', '$paciente', '$fechafin', '$horafin', '0000-00-00', '00:00:00','$numhisto','0699','04','','$cont', '01')");
						
						$idingre=mysql_insert_id();				
						$cad2=Mysql_query("INSERT INTO `hist_traza` ( `iden_tra` , `id_ing` , `secu_tra` , `ubica_tra` , `fecin_tra` , `horin_tra` , `horas_tra` ) 
						VALUES ('0','$idingre','1','$arearemi','$fechafin','$horafin','-1')");	
						
					}	
					
				}








				
				if($arearemision=='C504')
				{					
					//0698	Quirofano					
					if($arearemision=='C504')$arearemi='0698';	//por definir conducta	
					if($arearemi=='0698') //quirofano
					{						
						$resul=Mysql_query("INSERT INTO `ingreso_hospitalario` ( `id_ing` , `codius_ing` , `fecin_ing` , `hora_ing` , `fecsa_ing` , `horsa_ing` , `consu_ing` , `ubica_ing` , `arerem_ing` , `cama_ing` , `contra_ing` , `caac_ing`) 
						VALUES ('','$paciente','$fechafin','$horafin','0000-00-00','00:00:00','$numhisto','0698','0698','','$cont','$cama')");			
						$idingre=mysql_insert_id();				
						$resul2=Mysql_query("INSERT INTO `hist_traza` ( `iden_tra` , `id_ing` , `secu_tra` , `ubica_tra` , `fecin_tra` , `horin_tra` , `horas_tra` ) 
						VALUES ('0','$idingre','1','$arearemi','$fechafin','$horafin','-1')");			
					}					
				}
				if($arearemision=='C508')
				{			
					
					//0669	HOSPITALIZACION UCIN
					
					if($arearemision=='C508')$arearemi='0669';	//por definir conducta	
					if($arearemi=='0669') //HOSPITALIZACION UCIN
					{						
						$resul=Mysql_query("INSERT INTO `ingreso_hospitalario` ( `id_ing` , `codius_ing` , `fecin_ing` , `hora_ing` , `fecsa_ing` , `horsa_ing` , `consu_ing` , `ubica_ing` , `arerem_ing` , `cama_ing` , `contra_ing` , `caac_ing`) 
						VALUES ('','$paciente','$fechafin','$horafin','0000-00-00','00:00:00','$numhisto','0698','0698','','$cont','$cama')");			
						$idingre=mysql_insert_id();				
						$resul2=Mysql_query("INSERT INTO `hist_traza` ( `iden_tra` , `id_ing` , `secu_tra` , `ubica_tra` , `fecin_tra` , `horin_tra` , `horas_tra` ) 
						VALUES ('0','$idingre','1','$arearemi','$fechafin','$horafin','-1')");			
					
						
					
					
					}					
				}
				/*
				if($arearemision=='2' || $arearemision=='3')
				{			
					//0668	observacion
					//0699	POR DEFINIR CONDUCTA
					//0634	Urgencias
					
					if($arearemision=='2')$arearemi='0699';	//por definir conducta
					if($arearemision=='3')$arearemi='04';	//observacion					
					if($arearemi!='0699') //cualquiera menos por definir conducta
					{						
						$cama='RE';
						$resul=Mysql_query("INSERT INTO `ingreso_hospitalario` ( `id_ing` , `codius_ing` , `fecin_ing` , `hora_ing` , `fecsa_ing` , `horsa_ing` , `consu_ing` , `ubica_ing` , `arerem_ing` , `cama_ing` , `contra_ing` , `caac_ing`) 
						VALUES ('','$paciente','$fechafin','$horafin','0000-00-00','00:00:00','$numhisto','04','04','','$cont','RE')");			
						$idingre=mysql_insert_id();				
						$resul2=Mysql_query("INSERT INTO `hist_traza` ( `iden_tra` , `id_ing` , `secu_tra` , `ubica_tra` , `fecin_tra` , `horin_tra` , `horas_tra` ) 
						VALUES ('0','$idingre','1','$arearemi','$fechafin','$horafin','-1')");			
					}					
					else //por definir conducta
					{			
						if($arearemi=='0634')$arearemi='04';
						$cad=Mysql_query("INSERT INTO `ingreso_hospitalario` ( `id_ing` , `codius_ing` , `fecin_ing` , `hora_ing` , `fecsa_ing` , `horsa_ing` , `consu_ing` , `ubica_ing` , `arerem_ing` , `cama_ing` , `contra_ing` , `caac_ing`) 
						VALUES ('0', '$paciente', '$fechafin', '$horafin', '0000-00-00', '00:00:00','$numhisto','0699','04','','$cont', '01')");
						
						$idingre=mysql_insert_id();				
						$cad2=Mysql_query("INSERT INTO `hist_traza` ( `iden_tra` , `id_ing` , `secu_tra` , `ubica_tra` , `fecin_tra` , `horin_tra` , `horas_tra` ) 
						VALUES ('0','$idingre','1','$arearemi','$fechafin','$horafin','-1')");	
						//echo"<br>INSERT INTO `hist_traza` ( `iden_tra` , `id_ing` , `secu_tra` , `ubica_tra` , `fecin_tra` , `horin_tra` , `horas_tra` ) 
						//VALUES ('0','$idingre','1','$arearemi','$fechafin','$horafin','-1')";
					}
				}
				*/			
				
				$archivo6='tmp/6HC'.$numcita.'-'.$paciente.'.txt';	
				if(file_exists($archivo6))
				{		
					$fp = fopen ($archivo6, "r" );
					$reg=0;
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
						}
						$$campo[1]=$campo[2];
						if($reg % 14 == 0)
						{
							mysql_query("insert into medicamentosenv (ccie_men,cmed_men,cant_men,obse_men,esta_men,numc_men,proc_men,dosis_med,undo_med,frec_med,unfr_med,via_med,tiem_med) values 
							('$diagmedi','$codmedi','$canti','$obsemed','1401','$numhisto','','$dosis','$unid','$frecu','$unidfrecu','$via','$tiempo')");
						}				
					}
					fclose ($fp);
					unlink ($archivo6);
				}
				
				$archivonco='tmp/medonco'.$numcita.'-'.$paciente.'.txt';
				if(file_exists($archivonco))
				{		
					$fp = fopen ($archivonco, "r" );
					$reg=0;
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
						}
						$$campo[1]=$campo[2];
						if($reg % 19 == 0)
						{
							mysql_query("INSERT INTO proinsalud.medicamentos_oncologia (iden_formoncologia ,num_histo ,dosis_teorica , unid_dt ,dosis_resultante ,unid_dr ,porcentaje_ajuste ,dosis_definitiva , unid_dd ,via_administracion ,vehiculo ,
							volumen ,duracion_infusion ,frecuencia ,intervalo ,duracion_tratamiento ,cod_mdi ,cantidad, obsemed)
							VALUES ( NULL , '$numhisto', '$dosis_teorica', '$unid_dt', '$dosis_resultante', '$unid_dr', '$porcentaje_ajuste', '$dosis_definitiva', '$unid_dd', '$via_administracion', '$vehiculo', 
							'$volumen', '$duracion_infusion', '$frecuencia', '$intervalo', '$duracion_tratamiento', '$cod_mdi', '$cantidad', '$obsemed')");
						}				
					}
					fclose ($fp);
					unlink ($archivonco);
				}
				$archivinca='tmp/incaHC'.$numcita.'-'.$paciente.'.txt';
				if(file_exists($archivinca))
				{		
					$fp = fopen ($archivinca, "r" );
					$reg=0;
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
						}
						$$campo[1]=$campo[2];
						if($reg % 14 == 0)
						{
							if($tipoafi=='doc')$tipocot='D';
							else $tipocot='O';							
							
							mysql_query("INSERT INTO `proinsalud`.`incapacidades` ( `id_inca` ,`numc_his` ,`tformato_inca` ,`depar_inca` ,`muni_inca` ,`estedu_inca` ,`ereaespe_inca` ,`jornada_inca` ,
							`numdias_inca` ,`letdias_inca` ,`fecini_inca` ,`fecfin_inca` ,`dx_inca` ,`obse_inca` ,`tipo_inca` ,`fecparto_inca`,
							`paciente_inca`,`tipodoc_inca`,`docum_inca`,`sexo_inca`,`edad_inca`,`prorroga_inca`,`medico_inca`,`contrato_inca`,`tireg_inca`,`fecreg_inca`,`munate_inca`)
							VALUES ( NULL, '$numhisto', '$tipocot', '$depar', '$munilabor', '$colegio', '$areaespe', '$jornada', '$diasinca', '$letras', '$fecini', '$fecfin', '$diaginca', 
							'$obseinca', '$tipolic', '$fecparto', '$cous','$tipodoc','$idus','$sexo','$edpac','','$mediconsulta','$cont','S','$feco','$codimunicipio')");
						}				
					}
					fclose ($fp);
					unlink ($archivinca);
				}
				
				
//guarda medicamentos antimicrobianos si existen				
/*				
				$archivomicro='tmp/9CMICR'.$numcita.'-'.$paciente.'.txt';
				
				if(file_exists($archivomicro))
				{		
					$fp = fopen ($archivomicro, "r" );
					$reg=0;
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
						}
						$$campo[1]=$campo[2];
						if($reg % 10 == 0)
						{
							$codiagnomicro=substr($diagnosticoMicro, 0, 4);
							$tipoMicro=substr($diagnosticoMicro, -1);
							$partesDosisMicro = explode("-", $dosisMicro);
							$partesFrecuenciaMicro = explode("-", $frecuenciaMicro);
							$partesTiempoMicro = explode("-", $tiempoMicro);
							$partesNombreMicroAnte = explode("-", $nombreMicroAnte);
							
							$dosisMicroPre=$partesDosisMicro[0];
							$unidadMicroPre=$partesDosisMicro[1];
							
							$frecuenciaMicroPre=$partesFrecuenciaMicro[0];
							$unidadFrecuMicroPre=$partesFrecuenciaMicro[1];
							
							$tiempoMicroPre=$partesTiempoMicro[0];
							$tiempoUniMicroPre=$partesTiempoMicro[1];
							
							$nombreMicroAnte=$partesNombreMicroAnte[0];
												
							mysql_query("INSERT INTO proinsalud.antimicrobianos (numc_ehi ,   iden_evo  ,codi_usu ,  fecha_micro ,hora_micro , codi_mdi ,ambito_micro ,edad_micro , CODI_CON ,cama_micro ,diagnoprin_micro ,cieinfexioso_micro ,tipo_micro ,  examenconfirma_micro ,  resultado_micro ,  tratamientoactual_micro ,dosis_micro ,      unidad_micro,     frecuencia_micro,     unidadfrecu_micro,        tiempo_micro,    tiempounidad_micro,    razoncambio_micro, observar_micro,    codmedico_micro,    tiempocontrol_micro)
							                                            VALUES ('$numhisto' ,    '0',   '$paciente', '$fechafin', '$horafin', '$codigo',     'A',  		'$edpac',   '$cont',     '0',      '$codPrincipal',  '$codiagnomicro', '$tipoMicro', '$examenConfirmatorio', '$resultadoMicro',   '$nombreMicroAnte',    '$dosisMicroPre', '$unidadMicroPre', '$frecuenciaMicroPre', '$unidadFrecuMicroPre', '$tiempoMicroPre', '$tiempoUniMicroPre',  '$razondeCambio',  '$obsevaMicro', '$medicoResponsable',           '0'      )");
						}				
					}
					fclose ($fp);
					unlink ($archivomicro);
				}
*/				
//	fin guardar medicamentos microbianos

				
				
				
				$archivomt='tmp/medtraHC'.$numcita.'-'.$paciente.'.txt';
				if(file_exists($archivomt))
				{
					$fp = fopen ($archivomt, "r" );
					$reg1=0;
					while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) 
					{ 
						$reg1++;
						$j = 0;
						foreach($data as $dato)
						{
							$campoex[$j]=$dato;
							$j++ ;
						}
						$$campoex[1]=$campoex[2];					
					}
				}		
				
				$archivo7='tmp/7HC'.$numcita.'-'.$paciente.'.txt';		
				if(file_exists($archivo7))
				{		
					$fp = fopen ($archivo7, "r" );
					$reg=0;
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++;
						}
						$$campo[1]=$campo[2];						
					}
					//mysql_query("insert into encabesadoformula (nufo_efo,numc_efo,coen_efo,obfo_efo,repi_efo,prog_efo) values ('0','$numhisto','$proxima','$recom','$repetir','')");		
					//mysql_query("insert into encabesadoformula (nufo_efo,numc_efo,coen_efo,obfo_efo,repi_efo,prog_efo,codi_usu,codi_con,serv_efo,cod_medi,feco_efo,hoco_efo) 
					//values ('0','$numhisto','$proxima','$recom','$repetir','5503','$paciente','$cont','$Gareanh','$mediconsulta','$fechafin','$horafin')");
					fclose ($fp);
					unlink ($archivo7);	
				}
				if ($cantorden!='')$proxima=$cantorden.' Meses';
				else $proxima='';
				$recom=str_replace( "�",chr(10),$recom);
				mysql_query("insert into encabesadoformula (nufo_efo,numc_efo,coen_efo,obfo_efo,repi_efo,prog_efo,codi_usu,codi_con,serv_efo,cod_medi,feco_efo,hoco_efo,trasncri_efo,meditrans,espetrans) 
				values ('0','$numhisto','$proxima','$recom','$repetir','5503','$paciente','$cont','$Gareanh','$mediconsulta','$fechafin','$horafin','$transcripcion','$medtratante','$espetratante')");
				$archivopos='tmp/posHC'.$numcita.'-'.$paciente.'.txt';	
				if(file_exists($archivopos))
				{	
					$fp = fopen ($archivopos, "r" );
					$reg=0;
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
						}
						$$campo[1]=$campo[2];
						if($reg % 18 == 0)
						{
							$analpv=str_replace( "�",chr(10),$analpv);
							$cad5=mysql_query("INSERT INTO `form_nop` ( `iden_nop` , `iden_med` ,`cod_medico`, `codi_usu` , `fech_pos` , `cod_cie10` , `dosi_nop`, `unid_nop`, `cmed_nop` , `tiem_nop` , `ries_nop`,
							`fdes_nop`, `fhas_nop`, `ties_nop`, `rehc_nop`, `just_nop`, `tihi_nop`, `tinp_nop`)
							VALUES ('0', '$numhisto', '$mediconsulta', '$paciente', '$fechafin', '$diagmedi', '$dosissoli', '$unidadpos', '$codmedi', '$diastrasoli', '$riesgo', 
							'$fecdesde','$fechasta','$tiempoesti','$analpv','$biblio','A','$tiponopos')");				
							$idennop=mysql_insert_id();
							if(trim($cproa)!='')
							{
								$cad6=mysql_query("INSERT INTO `deta_pos` ( `iden_pos` , `iden_nop` , `papo_pos` , `dopo_pos`, `tepo_pos` )
								VALUES ('', '$idennop', '$cproa', '$dosisequia', '$diastraequia')");
								
							}
							if(trim($cprob)!='')			
							{
								$cad7=mysql_query("INSERT INTO `deta_pos` ( `iden_pos` , `iden_nop` , `papo_pos` , `dopo_pos`, `tepo_pos` )
								VALUES ('', '$idennop', '$cprob', '$dosisequib', '$diastraequib')");
							}				
						}				
					}
					fclose ($fp);
					unlink ($archivopos);
				}
				
				
				$archivo19='tmp/cov-HC'.$numcita.'-'.$paciente.'.txt';	
				if(file_exists($archivo19))
				{
					$fp = fopen ($archivo19, "r" );
					$reg=0;
					$n=0;
					while (( $data = fgetcsv ( $fp ,0,"|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
							
						}
						$$campo[1]=$campo[2];
						if($reg % 2 == 0)
						{
							$cod='codi'.$n;
							$codi=$$cod;
							$val='valor'.$n;
							$valor=$$val;
							$incov=mysql_query("INSERT INTO `sintomas_covid` (`iden_sintomas` ,`iden_cita` ,`num_triaje` ,`num_histo` ,`cod_sintoma` ,`valor_sintoma`,`tipo_historia`)
							VALUES ( NULL , '$numcita', '0', '$numhisto' , '$codi', '$valor', 'C')");
							$n++;
						}		
					}
					fclose ($fp);
					unlink ($archivo19);	
				}	
				
				
				
				
								
				/*
				$archivopos='tmp/posHC'.$numcita.'-'.$paciente.'.txt';	
				if(file_exists($archivopos))
				{	
					$fp = fopen ($archivopos, "r" );
					$reg=0;
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
						}
						$$campo[1]=$campo[2];
						if($reg % 17 == 0)
						{
							$analpv=str_replace( "�",chr(10),$analpv);
							$cad5=mysql_query("INSERT INTO `form_nop` ( `iden_nop` , `iden_med` ,`cod_medico`, `codi_usu` , `fech_pos` , `cod_cie10` , `dosi_nop`, `cmed_nop` , `tiem_nop` , `ries_nop`,
							`fdes_nop`, `fhas_nop`, `ties_nop`, `rehc_nop`, `just_nop`, `tihi_nop`, `tinp_nop`)
							VALUES ('0', '$numhisto', '$mediconsulta', '$paciente', '$fechafin', '$diagmedi', '$dosissoli', '$codmedi', '$diastrasoli', '$riesgo', 
							'$fecdesde','$fechasta','$tiempoesti','$analpv','$biblio','A','$tiponopos')");				
							$idennop=mysql_insert_id();
							if(trim($cproa)!='')
							{
								$cad6=mysql_query("INSERT INTO `deta_pos` ( `iden_pos` , `iden_nop` , `papo_pos` , `dopo_pos`, `tepo_pos` )
								VALUES ('', '$idennop', '$cproa', '$dosisequia', '$diastraequia')");
								
							}
							if(trim($cprob)!='')			
							{
								$cad7=mysql_query("INSERT INTO `deta_pos` ( `iden_pos` , `iden_nop` , `papo_pos` , `dopo_pos`, `tepo_pos` )
								VALUES ('', '$idennop', '$cprob', '$dosisequib', '$diastraequib')");
							}				
						}				
					}
					fclose ($fp);
					unlink ($archivopos);
				}
				*/
				
				
//cambio de la solicitud quirofano				
				$sangreult='';
				$archivoquiro='tmp/ciruHC'.$numcita.'-'.$paciente.'.txt';	
				if(file_exists($archivoquiro))
				{		
					$fp = fopen ($archivoquiro, "r" );
					$reg=0;
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$sangreult='';
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
						}
						$$campo[1]=$campo[2];
						if($reg % 39 == 0)
						{			
							$regbuscador1=substr($campo[1], -3);
							$soliunidpro=${'soliunidpro'.$regbuscador1};
							$diagmedi= ${'diagmedi'.$regbuscador1};
							$codmedi= ${'codmedi'.$regbuscador1};
							$nomobrecup= ${'nomobrecup'.$regbuscador1};
							$cirugia= ${'cirugia'.$regbuscador1};
							$anestesia= ${'anestesia'.$regbuscador1};
							$fecciru= ${'fecciru'.$regbuscador1};
							$hora= ${'hora'.$regbuscador1};
							$minu= ${'minu'.$regbuscador1};
							$tiho= ${'tiho'.$regbuscador1};
							$requiayudante= ${'requiayudante'.$regbuscador1};
							$rinsumos= ${'consicion'.$regbuscador1};
							for($ies=0; $ies<10; $ies++) 
							{
								$sangre1 = ${'nomconthemoder'.$ies.$regbuscador1};		
								
								if($sangre1!='')	
								{
									$usangreuni1 = ${'conesteunid'.$ies.$regbuscador1};	
									
									$bdes=mysql_query("select nomb_mdi from medicamentos2 where codi_mdi='$sangre1'");
									$numbdes=mysql_num_rows($bdes);
									while($rdes=mysql_fetch_array($bdes))
									{
										$nomdt=$rdes['nomb_mdi'];
									}
									
									if($usangreuni1==''){$unitotal='';}
									else if($usangreuni1==1){$unitotal='Unidad';}	
									else if($usangreuni1>1){$unitotal='Unidades';}
									$sangreult1=$nomdt.' '.$usangreuni1.' '.$unitotal.';';
									$sangreult=$sangreult.$sangreult1;
								}					   
							}
							$requiequi= ${'requiequi'.$regbuscador1};
							$requieco= ${'requieco'.$regbuscador1};
							$duracion= ${'duracion'.$regbuscador1};
							$unidura= ${'unidura'.$regbuscador1};
							$resuci= ${'resuci'.$regbuscador1};
							$requimate= ${'resuci'.$regbuscador1};
							$proceinstitu= ${'proceinstitu'.$regbuscador1};
							if($tiho=='PM')$hora=$hora+12;
							$horasol=$hora.':'.$minu;				
							if($unidura=='MM')$dura=$duracion.' Minutos';
							if($unidura=='HH')$dura=$duracion.' Horas';	
							$cad5=mysql_query("INSERT INTO `solicitud_quirofano` ( `iden_solquiro` , `nhis_solquiro` , `diag_solquiro`, `cups_solquiro` ,  `nomcups_solquiro` ,  `ticiru_solquiro` , `tianes_solquiro` , `fecsol_solquiro`, `horasol_solquiro` , `reayud_solquiro` , `sangre_solquiro`, `reequi_solquiro`,  `reeco_solquiro`,   `duracion_solquiro`, `reseruci_solquiro`, `esindtitu_solquiro`, `rematerial_solquiro`, `material_solquiro`,`cnsi_solquiro`,`risg_solquiro`, `bnf_solquiro`, `origen_solquiro`, `relacion_solquiro` )				
																		  VALUES (         '0',        '$numhisto',     '$diagmedi',      '$codmedi',         '$nomobrecup',         '$cirugia',         '$anestesia',        '$fecciru',        '$horasol',      '$requiayudante',     '$sangreult',       '$requiequi',     '$requieco',           '$dura',            '$resuci',         '$requimate',        '$proceinstitu',       '$rinsumos',                '',             '',             '',               'CE',          '$soliunidpro'    )");	
						}				
					}
					fclose ($fp);
					unlink ($archivoquiro);

					$archivoquiroexps='tmp/ciruHCEXPS'.$numcita.'-'.$paciente.'.txt';
					if(file_exists($archivoquiroexps))
					{
						$fper1 = fopen ($archivoquiroexps, "r" );
						$reger1=0;						
						while (( $dataer1 = fgetcsv ( $fper1 , 0 , "|" )) !== FALSE ) 
						{ 
							$reger1++;
							$ier1 = 0;
							foreach($dataer1 as $datoer1)
							{
								$campoer1[$ier1]=$datoer1;
								$ier1++ ;
							}
							$$campoer1[1]=$campoer1[2];							
							if($reger1 % 8 == 0)
							{	
								$regbuscador2=substr($campoer1[1], -3);
								$soliunidprodosult=${'soliunidprodos'.$regbuscador2};
								$codmediultimo=${'codmedi'.$regbuscador2};
								
								$descupultimo=${'nomprocedi'.$regbuscador2};
								
								$materialultimo=${'material'.$regbuscador2};
								$consisteultimo=${'consiste'.$regbuscador2};
								$riesgoultimo=${'riesgo'.$regbuscador2};
								$beneficiosultimo=${'beneficios'.$regbuscador2};
								$tricad5=mysql_query("INSERT INTO `soliquiro_deta` (`nhis_solquiro`,`codi_sqdet`,`cups_sqdet` ,`descups_sqdet`,`mater_sqdet`,
								`consis_sqdet`,`riesgo_sqdet`,`benef_sqdet`)				
								VALUES ('$numhisto',    '$soliunidprodosult',  '$codmediultimo',  '$descupultimo',   '$materialultimo', '$consisteultimo',  '$riesgoultimo',   '$beneficiosultimo')");
							}	
						}	
						fclose ($fper1);	
						unlink ($archivoquiroexps);
					}		
				}
	
				$copiacirugen='tmp/copiaCIRUGENERAL'.$numcita.'-'.$paciente.'.txt';
				$copiaciruHC='tmp/copiaciruHC'.$numcita.'-'.$paciente.'.txt';
				$copiaciruHCEXP='tmp/copiaciruHCEXPS'.$numcita.'-'.$paciente.'.txt';
				$arcparaborrar1='tmp/ciruHCGen'.$numcita.'-'.$paciente.'.txt';
				if(file_exists($arcparaborrar1))
				{
					unlink ($arcparaborrar1);	
				}
				if(file_exists($copiacirugen))
				{
					unlink ($copiacirugen);	
				}
				if(file_exists($copiaciruHC))
				{
					unlink ($copiaciruHC);	
				}
				if(file_exists($copiaciruHCEXP))
				{
					unlink ($copiaciruHCEXP);	
				}
				$archivo27='tmp/CIRUGENERALTEMPO'.$numcita.'-'.$paciente.'.txt';
				if(file_exists($archivo27))
				{
					unlink ($archivo27);	
				}
				
				$archivo28='tmp/ciruHCTEMPO'.$numcita.'-'.$paciente.'.txt';
				if(file_exists($archivo28))
				{
					unlink ($archivo28);	
				}				
				$archivo29='tmp/ciruHCEXPSTEMPO'.$numcita.'-'.$paciente.'.txt';
				if(file_exists($archivo29))
				{
					unlink ($archivo29);	
				}				
				$archivo57='tmp/CIRUGENERAL'.$numcita.'-'.$paciente.'.txt';
				if(file_exists($archivo57))
				{
					unlink ($archivo57);	
				}				
				$archivo80='tmp/ARCONTROL'.$numcita.'-'.$paciente.'.txt';
				if(file_exists($archivo80))
				{
					unlink ($archivo80);	
				}				
				$archivo81='tmp/ARCONTROLEXP'.$numcita.'-'.$paciente.'.txt';
				if(file_exists($archivo81))
				{
					unlink ($archivo81);	
				}				
				$archivo82='tmp/nuevoarchivo'.$numcita.'-'.$paciente.'.txt';
				if(file_exists($archivo82))
				{
					unlink ($archivo82);	
				}				
				$archivo83='tmp/otronuerchivo'.$numcita.'-'.$paciente.'.txt';
				if(file_exists($archivo83))
				{
					unlink ($archivo83);	
				}
				
	
				
//fin cambio de solicitud informatica
				
				$archivofam='tmp/12HC'.$numcita.'-'.$paciente.'.txt';	
				if(file_exists($archivofam))
				{		
					$fp = fopen ($archivofam, "r" );
					$reg=0;
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
						}
						$$campo[1]=$campo[2];
						if($reg % 24 == 0)
						{			
							if($tiho=='PM')$hora=$hora+12;
							$horasol=$hora.':'.$minu;				
							if($unidura=='MM')$dura=$duracion.' Minutos';
							if($unidura=='HH')$dura=$duracion.' Horas';
							$cad5=mysql_query("INSERT INTO `conambfam` ( `iden_cpl` ,`codi_usu`, `codi_con`, `cod_medi`, `apgar1_cfa` , `apgar2_cfa` , `apgar3_cfa` , `apgar4_cfa`, `apgar5_cfa` , `apgpun_cfa` , `phq1_cfa`, `phq2_cfa`, `phq3_cfa`, `phq4_cfa`, `phq5_cfa`, `phq6_cfa`, `phq7_cfa`, `phq8_cfa`, `phq9_cfa`, `phqpun_cfa`,`fecha_cfa`, `hora_cfa`,`aplicacion_cfa`)				
							VALUES ('$numhisto', '$paciente', 	'$Gcontratonh',     '$Gcod_mediconh',	'$apgar1',     '$apgar2',    '$apgar3',       '$apgar4',    '$apgar5',    '$httotal1',   '$phq1',    '$phq2',    '$phq3',    '$phq4',    '$phq5',    '$phq6',    '$phq7',    '$phq8',    '$phq9',   '$httotal2', '$fechafin', '$horafin', '5503')");				
						}				
					}
					fclose ($fp);
					unlink ($archivofam);
				}              
                $archivo13='tmp/13HC'.$numcita.'-'.$paciente.'.txt';	
				if(file_exists($archivo13))
				{
					$fp = fopen ($archivo13, "r" );
					$reg=0;
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
						}
						$$campo[1]=$campo[2];
						//if($reg % 24 == 0)
						//{
						if(!empty($resumen)){
							$sql_="INSERT INTO refer_at910(iden_rat,servorig_rat,idenorig_rat,tipo_rat,infor_rat)
							VALUES(0,'CE','$iden_cpl','$tipo_ref','$resumen')";
							mysql_query($sql_);
						}
						//}
					}
					fclose ($fp);
					unlink ($archivo13);
				}
				$sSQL="Update citas Set Esta_cita ='2', numc_adx='$numhisto' Where id_cita='$numcita'";
				mysql_query($sSQL);
				echo"<input type=hidden name=numhisto value='$numhisto'> <form>";
				if(file_exists($archivolis))unlink ($archivolis);
				if(file_exists($archivo0))unlink ($archivo0);
				if(file_exists($archivo1))unlink ($archivo1);
				if(file_exists($archivo2))unlink ($archivo2);
				if(file_exists($archivo4))unlink ($archivo4);
				if(file_exists($archivo8))unlink ($archivo8);
				echo "<body onload='salir()'>
				</body>";
			}
		}
	}		
	function calcula_edad($fecha_nac)
    {
        //Esta función toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en números enteros
        $dia=date("d");
        $mes=date("m");
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
	function calculaedadund($fecha_)
	{
	$ano_=substr($fecha_,0,4);
	$mes_=substr($fecha_,5,2);
	$dia_=substr($fecha_,8,2);
	if($mes_==2)
	{
    $diasmes_=28;}
	else
	{
		if($mes_==1 || $mes_==3 || $mes_==5 || $mes_==7 || $mes_==8 || $mes_==10 || $mes_==12){
		$diasmes_=31;}
		else{$diasmes_=30;}
	}
	$anos_=date("Y")-$ano_;
	$meses_=date("m")-$mes_;
	$dias_=date("d")-$dia_;    
	if($dias_<0)
	{
		if($meses_>0){$meses_=$meses_-1;}
		$dias_=$diasmes_+$dias_;
	}
	if($meses_<0){
    $meses_=12+$meses_;
    if(date("d")-$dia_<0){
	$meses_=$meses_-1;}
	$anos_=$anos_-1;
	}
  if($meses_==0 & date("d")-$dia_<0 & $anos_>0){
    if(date("m")-$mes_==0 & date("d")-$dia_<0){$anos_=$anos_-1;}
     $meses_=11;
  }
  if($anos_<>0)
  {
    $edad_=$anos_;
    if($edad_==1){
      $unidad_=" A�o";}
    else{
      $unidad_=" A�os";}
  }
  else
  {
    if($meses_<>0){
      $edad_=$meses_;
      if($edad_==1){
        $unidad_=" Mes";}
      else{
        $unidad_=" Meses";}
    }
    else{
      $edad_=$dias_;
      if($edad_==1){
        $unidad_=" D�a";}
      else{
        $unidad_=" D�as";}
    }
  }
  //$edad_.$unidad_
  return($unidad_);  
}	
?>
</body>
</html>