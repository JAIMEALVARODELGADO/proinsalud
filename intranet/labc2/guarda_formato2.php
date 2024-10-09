<?session_register('Gidusulab'); ?>
<html>
<head>
<script language='JavaScript'>
function enviar(val)
{	
	if(val==1)
	{
		alert("YA EXISTE UN FORMATO PARA ESA ORDEN")
		form1.target='';
		form1.action='edi_orden.php';
		form1.submit();	
	}
	else
	{
		alert("EL FORMATO SE AGREGO CORRECTAMENTE")
		form1.target='';
	    form1.action='edi_orden.php';
		form1.submit();	
	}
}

</script>
</head>

<?
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);
	
	echo"<form name=form1 method=POST>";
	
	$fecha=time();
	$fec=date ("Y/m/d",$fecha);
	$hor=date ("H:i",$fecha);
	//echo $format;
	
	echo "<input type=hidden name=nord_dlab value='$nord_dlab'>";
	echo "<input type=hidden name=iden_labs value=$iden_labs>";
	echo "<input type=hidden name=codusu value=$codusu>";
		
	
	if($format==1)
	{
			
			//COMPROBACION DE ENVIO DE LAS VARIABLES
			
			$ph=$_POST["ph"];
			
			echo "<input type=hidden name=codig_usu value=$codig_usu>";
			echo"<input type=hidden name=ph_uru value=$ph_uru>";
			echo"<input type=hidden name=asp_uru value='$asp_uru'>";
			echo"<input type=hidden name=leu_uru value=$leu_uru>";
			echo"<input type=hidden name=color_uru value=$color_uru>";
			echo"<input type=hidden name=epi_uru value=$epi_uru>";
			echo"<input type=hidden name=her_uru value=$her_uru>";
			echo"<input  type=hidden name=hem_uru  value='$hem_uru'>";
			echo"<input type=hidden name=den_uru value=$den_uru>";
			echo"<input type=hidden name=cili_uru value=$cili_uru>";
			echo"<input type=hidden name=alb_uru value=$alb_uru>";
			echo"<input type=hidden name=cris_uru value='$cris_uru'>";
			echo"<input type=hidden name=cris_uru2 value='$cris_uru2'>";
			echo"<input type=hidden name=cri_uru value='$cri_uru'>";
			echo"<input type=hidden name=glu_uru value=$glu_uru>";
			echo"<input type=hidden name=moco_uru value=$moco_uru>";
			echo"<input type=hidden name=esc2_uru value=$esc2_uru>";
			echo"<input type=hidden name=cet_uru value=$cet_uru>";
			echo"<input type=hidden name=lev_uru value=$lev_uru>";
			echo"<input type=hidden name=pig_uru value=$pig_uru>";
			echo"<input type=hidden name=bac_uru value=$bac_uru>";
			echo"<input type=hidden name=val_uru value='$val_uru' >";
			echo"<input type=hidden name=esc_uru value=$esc_uru>";
			echo"<input type=hidden name=san_uru value=$san_uru>";
			echo"<input type=hidden name=tri_uru value=$tri_uru>";
			echo"<input type=hidden name=uro_uru value=$uro_uru>";
			echo"<input type=hidden name=nit_uru value=$nit_uru>";
			echo"<input type=hidden name=obs_uru value='$obs_uru'>";
			echo"<input type=hidden name=alt_uru value=$alt_uru>";
			echo"<input type=hidden name=con_uru value=$con_uru>";
			echo"<input type=hidden name=esp_uru value=$esp_uru>";
			echo"<input type=text name=oglu_uro value=$oglu_uro>";
			
			$cex_uro=mysql_query("SELECT `iden_dla`,`num_fac` FROM `uroana` WHERE num_fac='$nord_dlab' AND iden_dla='$iden_labs' AND `esta_ord`<>'EL'");
			
			if(mysql_num_rows($cex_uro)==0)
			{
				$cons=mysql_query("INSERT INTO `uroana` ( `iden_dla`, `num_fac`, `cod_examen`, `fec_rec` , `fec_ent` , `ced_usu` , `aspectos` , `color` , `ph` , `densidad` , `albumina` , `valo_gluc`,`glucosa` , `cetonas` , `pigm_biliares` , `sangre` , `urobilinogeno` , `val_uru` , `nitritos` , `leucocitos` , `epiteliales` , `alt` , `hermaties` , `valo_hem` , `cilidros` , `cristales` , `valo_cri` , `cris_uru2` , `moco` , `esc2` , `levadura` , `bacterias` , `esc` , `tricomonas` , `obervaciones` , `con` , `esp` ) 
				VALUES ('$iden_labs','$nord_dlab','907106','$fec','$fent','$codusu','$asp_uru','$color_uru','$ph_uru','$den_uru','$alb_uru','$oglu_uro','$glu_uru', '$cet_uru','$pig_uru','$san_uru','$uro_uru','$val_uru','$nit_uru','$leu_uru','$epi_uru','$alt_uru','$her_uru','$hem_uru','$cili_uru','$cris_uru','$cri_uru','$cris_uru2' ,'$moco_uru','$esc2_uru','$lev_uru','$bac_uru','$esc_uru','$tri_uru','$obs_uru','$con_uru','$esp_uru')");
			
				echo "<body onload='enviar()'>";
			}
			else
			{
				//echo "EL EXAMEN YA TIENE FORMATO DE UROANALISIS";
				echo "<body onload='enviar(1)'>";
			
			}
			
			
	}
	

	if($format==2)
	{
		
		echo"<input type=hidden name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=co_ftv value=$co_ftv>";
		echo"<input type=hidden name=ba_ftv value=$ba_ftv>";
		echo"<input type=hidden name=coba_ftv value=$coba_ftv>";
		echo"<input type=hidden name=grap_ftv value=$grap_ftv>";
		echo"<input type=hidden name=gran_ftv value=$gran_ftv>";
		echo"<input type=hidden name=granv_ftv value='$granv_ftv'>";
		echo"<input type=hidden name=ph_ftv value=$ph_ftv>";
		echo"<input type=hidden name=tea_ftv value=$tea_ftv>";
		echo"<input type=hidden name=koh_ftv value=$koh_ftv>";
		echo"<input type=hidden name=tcv_ftv value=$tcv_ftv>";
		echo"<input type=hidden name=pmc_ftv value='$pmc_ftv'>";
		echo"<input type=hidden name=ceg_ftv value=$ceg_ftv>";
		echo"<input type=hidden name=lev_ftv value=$lev_ftv>";
		echo"<input type=hidden name=seu_ftv value=$seu_ftv>";
		echo"<input type=hidden name=lac_ftv value=$lac_ftv>";
		echo"<input type=hidden name=mor_ftv value=$mor_ftv>";
		echo"<input type=hidden name=pmnxcamcer value='$pmnxcamcer'>";
		echo"<input type=hidden name=dgni_ftv value=$dgni_ftv>";
		echo"<input type=hidden name=dgne_ftv value=$dgne_ftv>";
		echo"<input type=hidden name=obsfrt_ftv value='$obsfrt_ftv'>";
		
		$cex_fro=mysql_query("SELECT iden_dlab,  num_fac  FROM frotis WHERE num_fac='$nord_dlab' AND iden_dlab='$iden_labs' AND `esta_ord`<>'EL'");
		
		if(mysql_num_rows($cex_fro)==0)
		{
			mysql_query("INSERT INTO `frotis` (`iden_dlab` , `num_fac` , `cod_examen` , `fec_ent` , `fec_rec` , `cod_usu` , `ph` , `testaminas` , `koh` , `trichomava` , `pmn` , `celulasgui` , `levaduras` , `seudomicel` , `lactobacil` , `cocos` , `bacilos` , `cocobacilo` , `grampositi` , `gramnegati` , `granv` , `pmnxcamcer` , `diplointra` , `diploextra` , `observaciones` ) 
					  VALUES ('$iden_labs', '$nord_dlab', '901304', '$fec', '$fent', '$codig_usu', '$ph_ftv', '$tea_ftv', '$koh_ftv', '$tcv_ftv', '$pmc_ftv', '$ceg_ftv', '$lev_ftv', '$seu_ftv', '$lac_ftv', '$co_ftv', '$ba_ftv', '$coba_ftv', '$grap_ftv', '$gran_ftv', '$granv_ftv', '$pmnxcamcer', '$dgni_ftv', '$dgne_ftv', '$obsfrt_ftv')");

			echo "<body onload='enviar()'>";	
		}

		else
		{
			//echo "EL EXAMEN YA TIENE ESTE FORMATO FROTIS ";
			echo "<body onload='enviar(1)'>";
		}
			
		
	
	}
	if($format==3)
	{
			echo "<input type=hidden name=codig_usu value=$codig_usu>";
			echo"<input type=hidden name=con_cps value=$con_cps>";
			echo"<input type=hidden name=qc_cps  value=$qc_cps>";
			echo"<input type=hidden name=hom_cps value=$hom_cps>";
			echo"<input type=hidden name=qh_cps  value=$qh_cps>";
			echo"<input type=hidden name=qeh_cps value=$qeh_cps>";
			echo"<input type=hidden name=qn_cps  value=$qh_cps>";
			echo"<input type=hidden name=qem_cps value=$qem_cps>";
			echo"<input type=hidden name=bh_cps  value=$bh_cps>";
			echo"<input type=hidden name=bla_cps value=$bla_cps>";
			echo"<input type=hidden name=ch_cps  value=$ch_cps>";
			echo"<input type=hidden name=chi_cps value=$chi_cps>";
			echo"<input type=hidden name=tz_cps  value=$tz_cps>";
			echo"<input type=hidden name=tro_cps value=$tro_cps>";
			echo"<input type=hidden name=color_cps value=$color_cps>";
			echo"<input type=hidden name=ph_cps value=$ph_cps>";
			echo"<input type=hidden name=moc_cps value=$moc_cps>";
			echo"<input type=hidden name=san_cps value=$san_cps>";
			echo"<input type=hidden name=otrcpr_cps value=$otrcpr_cps >";
			echo"<input type=hidden name=azu_cps value=$azu_cps>";
			echo"<input type=hidden name=wri_cps value=$wri_cps>";
			echo"<input type=hidden name=lev_cps value=$lev_cps>";
			echo"<input type=hidden name=neu_cps value=$neu_cps>";
			echo"<input type=hidden name=mic_cps value=$mic_cps>";
			echo"<input type=hidden name=lin_cps value=$lin_cps>";
			echo"<input type=hidden name=gra_cps value=$gra_cps>";
			echo"<input type=hidden name=eos_cps value=$eos_cps>";
			echo"<input type=hidden name=flo_cps value='$flo_cps'>";
			echo"<input type=hidden name=no_cps value='$no_cps'>";
			echo"<input type=hidden name=val_cps value='$val_cps'>";
			echo"<input type=text name=leuc_cpr value='$leuc_cpr'>";
			echo"<input type=text name=hema_cpr value='$hema_cpr'>";
			
			$cex_cop=mysql_query("SELECT iden_dlab, num_fac  FROM coprol  WHERE num_fac='$nord_dlab' AND iden_dlab='$iden_labs' AND `esta_ord`<>'EL'");
			if(mysql_num_rows($cex_cop)==0)
			{
				mysql_query("INSERT INTO `coprol` ( `iden_dlab` , `num_fac` , `cod_examen` , `fec_rec` , `fec_ent` , `cod_usu` , `consistenc` , `bh` , `blastocyst` , `qc` , `QEColi` , `color` , `ch` , `chilomasti` , `ph` , `tz` , `trofozoito` , `moco` , `sangreocul` , `otros` , `azucaresre` ,`leuc_cpr`,`hema_cpr` ,`writh` ,`levadura` , `neutrofilo` , `micelios` , `linfocitos` , `grasa_neut` , `eosinofilo` , `flora_bact` , `qh` , `qehistolyt` , `qn` , `qemana` , `observaciones` , `no` , `val` ) 
				VALUES ($iden_labs,'$nord_dlab',907004,'$fec','$fent','$codig_usu','$con_cps','$bh_cps','$bla_cps','$qc_cps','$hom_cps','$color_cps','$ch_cps','$chi_cps','$ph_cps','$tz_cps','$tro_cps','$moc_cps','$san_cps','$otrcpr_cps','$azu_cps','$leuc_cpr','$hema_cpr','$wri_cps','$lev_cps','$neu_cps','$mic_cps','$lin_cps','$gra_cps','$eos_cps','$flo_cps','$qh_cps','$qeh_cps','$qn_cps','$qem_cps','$obs_cps','$no_cps','$val_cps')");
				
				echo "<body onload='enviar()'>";	
			}
			else
			{
				//echo "EL EXAMEN YA TIENE ESTE FORMATO COPROANALIS/COPROSCOPICO ";
				echo "<body onload='enviar(1)'>";
			
			}
		
	}
	
	if($format==4)
	{
			echo "<input type=hidden name=codig_usu value=$codig_usu>";
			echo"<input type=hidden name=fent value=$fent>";
			echo"<input type=hidden name=hema_ch value='$hema_ch'>";
			echo"<input type=hidden name=hemo_ch value='$hemo_ch'>";
			echo"<input type=hidden name=vs_ch   value='$vs_ch'>";
			echo"<input type=hidden name=leu_ch  value='$leu_ch'>";
			echo"<input type=hidden name=pla_ch  value='$pla_ch'>";
			echo"<input type=hidden name=neu_ch  value='$neu_ch'>";
			echo"<input type=hidden name=cay_ch  value='$cay_ch'>";
			echo"<input type=hidden name=lin_ch  value='$lin_ch'>";
			echo"<input type=hidden name=eos_ch  value='$eos_ch'>";
			echo"<input type=hidden name=mon_ch  value='$mon_ch'>";
			echo"<input type=hidden name=bas_ch  value='$bas_ch'>";
			echo"<input type=hidden name=ret_ch  value='$ret_ch'>";
			echo"<input type=text name=vcm_ch value='$vcm_ch'>"; 
			echo"<input type=text name=hcm_ch value='$hcm_ch'>";
			echo"<input type=text name=chcm_ch value='$chcm_ch'>";
			echo"<input type=text name=ide_ch value='$ide_ch'> ";
			echo"<input type=hidden name=obs_ch  value='$obs_ch'>";
			
			$cex_che=mysql_query("SELECT iden_dlab, num_fac  FROM cuadroh WHERE num_fac='$nord_dlab' AND iden_dlab='$iden_labs' AND `esta_ord`<>'EL'");
			
			if(mysql_num_rows($cex_che)==0)
			{
				$vlch=mysql_query("INSERT INTO `cuadroh` ( `iden_dlab` , `num_fac` , `cod_examch` , 
				`fec_rec` , `fec_ent` , `cod_usu` , `hemoglobin` , `neutrofilos` , `hematrocit` , 
				`cayados` , `vsg1h` , `linfocito` , `leococitos` , `eosinofilos` , `monocitos` , 
				`basofilos` , `plaquetas` , `reticuloci` , `vcm_ch`, `hcm_ch`, `chcm_ch`, `ide_ch`, `observacion` ) 
				VALUES ( '$iden_labs', '$nord_dlab', '902210', '$fec', '$fent', '$codig_usu', 
				'$hemo_ch', '$neu_ch', '$hema_ch', '$cay_ch', '$vs_ch', '$lin_ch', '$leu_ch', 
				'$eos_ch', '$mon_ch', '$bas_ch', '$pla_ch', '$ret_ch',  '$vcm_ch','$hcm_ch','$chcm_ch', '$ide_ch','$obs_ch')");
			
				echo "<body onload='enviar()'>";	
			}
			else
			{
				//echo "EL EXAMEN YA TIENE ESTE FORMATO CUADRO HEMATICO ";
				echo "<body onload='enviar(1)'>";
			}
			
	}
	if($format==5)
	{
		echo "<input type=hidden name=codig_usu value=$codig_usu>";
		echo "<input type=hidden name=cdr_datos value='$cdr_datos'>";
		
		
		mysql_query("INSERT INTO `dat_varios` (`iden_dlab` , `num_fac` , `fec_rec` , `fec_ent` , `cod_usu` , `cod_examvr` , `datos` ) 
			VALUES ('$iden_labs', '$nord_dlab', '$fec', '$fent', '$codig_usu', '888888', '$cdr_datos')");
			echo "<body onload='enviar()'>";	
		

	}
	if($format==6)
	{
		echo "<input type=hidden name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=ph_epm value=$ph_epm>";
		echo "<input type=hidden name=vol_epm  value=$vol_epm>";
		echo "<input type=hidden name=vis_epm  value=$vis_epm>";
		echo "<input type=hidden name=nor_epm  value=$nor_epm>";
		echo "<input type=hidden name=aum_epm  value=$aum_epm>";
		echo"<input type=hidden name=uc_epm    value=$uc_epm>";
		echo"<input type=hidden name=tc_epm    value=$tc_epm>";
		echo"<input type=hidden name=m3_epm    value='$m3_epm'>";
		echo"<input type=hidden name=otr_epm   value=$otr_epm>";
		echo"<input type=hidden name=vm_epm    value=$vm_epm>";
		echo"<input type=hidden name=tm_epm    value=$tm_epm>";
		echo"<input type=hidden name=otr2_epm  value=$otr2_epm>";
		echo"<input type=hidden name=leu_epm   value=$leu_epm>";
		echo"<input type=hidden name=hema_epm  value=$hema_epm>";
		echo"<input type=hidden name=bac_epm   value=$bac_epm>";
		echo"<input type=hidden name=trim_epm  value=$trim_epm>";
		echo"<input type=hidden name=trime_epm value=$trime_epm>";
        echo"<input type=hidden name=koh value=$koh>";
		echo"<input type=hidden name=kohm_epm  value='$kohm_epm'>";
		echo"<input type=hidden name=mvpr_epm  value=$mvpr_epm>";
		echo"<input type=hidden name=mvpe_epm  value=$mvpe_epm>";
		echo"<input type=hidden name=inm_epm   value='$inm_epm'>";
		echo"<input type=hidden name=viv_epm   value=$viv_epm>";
		echo"<input type=hidden name=mue_epm   value=$mue_epm>";
		echo"<input type=hidden name=rec_epm   value=$rec_epm>";
		echo"<input type=hidden name=pmn_epm   value=$pmn_epm>";
		echo"<input type=hidden name=pc_epm    value='$pc_epm'>";
		echo"<input type=hidden name=neu_epm   value='$neu_epm'>";
		echo"<input type=hidden name=lin_epm   value=$lin_epm>";
		echo"<input type=hidden name=nor2_epm  value=$nor2_epm>";
		echo"<input type=hidden name=micro_epm value=$micro_epm>";
		echo"<input type=hidden name=macro_epm value='$macro_epm'>";
		echo"<input type=hidden name=enro_epm  value=$enro_epm>";
		echo"<input type=hidden name=amor_epm  value=$amor_epm>";
		echo"<input type=hidden name=sinca_epm value=$sinca_epm>";
		echo"<input type=hidden name=sinco_epm value='$sinco_epm'>";
		echo"<input type=hidden name=dobc_epm  value=$dobc_epm>";
		echo"<input type=hidden name=otro3_epm value=$otro3_epm>";
		
		
		$cex_esp=mysql_query("SELECT iden_dlab, num_fac  FROM esper WHERE num_fac='$nord_dlab' AND iden_dlab='$iden_labs' AND `esta_ord`<>'EL'");
			
		if(mysql_num_rows($cex_esp)==0)
		{
			$consulta="INSERT INTO `esper` ( `iden_esp` , `iden_dlab` , `num_fac` , `fec_rec` , `fec_ent` , `cod_usu` , `cod_exames` , `fech_reco` , `hor_reco` , `min_rec` ,
                        `ph_exa` , `vol_exa` , `dis_visc` , `nor_visc` , `aum_visc` , `1cc_fila` , `3cc_fila` ,
                        `m3cc_fila` , `otro__fila` , `20m_licu` , `30m_licu` , `otro_licu` , `leoco_dir` , 
                        `hema_dir` , `bact_uno` , `tri_mas` , `trim_menos` , `koh_mas` , `koh_menos` , `movprog_mov` ,`movpend_mov` , 
                        `inmo_mov` , `vivos_vit` , `mue_vit` , `recu_esperm` , `pmn0xc_gram` , `1-5xc_gram` , `neutr_wrig` , `linfo_wrig` ,
                        `norm_morfo` , `micro_morfo` , `macro_morfo` , `enroll_morfo` , `amorf_morfo` ,
                        `scabe_morfo` , `scola_morfo` , `dcab_morfo` , `otro_morfo` , `esta_ord` ) 
                         VALUES (NULL , '$iden_labs', '$num_ord', '$fec', '$fec', '$codig_usu', '907201', '$fec', '$hor', '$hor', 
                        '$ph_epm', '$vol_epm', '$vis_epm', '$nor_epm', '$aum_epm', '$uc_epm', '$tc_epm',
                        '$m3_epm', '$otr_epm', '$vm_epm', '$tm_epm', '$otr2_epm', '$leu_epm',
                        '$hema_epm', '$bac_epm','$tri_epm', '$trim_epm', '$koh','$kohm_epm','$mvpr_epm', '$mvpe_epm',
                        '$inm_epm', '$viv_epm', '$mue_epm', '$rec_epm', '$pc_epm', '$pmn_epm', '$neu_epm', '$lin_epm', 
                        '$nor2_epm', '$micro_epm', '$macro_epm', '$enro_epm', '$amor_epm', 
                        '$sinca_epm', '$sinco_epm', '$dobc_epm', '$otro3_epm','')";
                        mysql_query($consulta);
			echo "<body onload='enviar()'>";
		}
		else
		{
		
			//echo "EL EXAMEN YA TIENE ESTE FORMATO ESPERMOGRAMA ";
			echo "<body onload='enviar()'>";
		
		}
		
			
	}
	if($format==7)
	{
		echo "<input type=hidden name=codig_usu value=$codig_usu>";
		echo "<input type=hidden name=res_hcg value='$res_hcg'>";
		echo "<input type=hidden name=obs_hcg value='$obs_hcg'>";
		
		$cex_hcg=mysql_query("SELECT `iden_dlab` , `num_fac`  FROM hcg WHERE num_fac='$nord_dlab' AND iden_dlab='$iden_labs' AND `esta_ord`<>'EL'");
		
		if(mysql_num_rows($cex_hcg)==0)
		{
			mysql_query("INSERT INTO `hcg` (`iden_dlab` , `num_fac` , `cod_examen` , `fec_rec` , `fec_ent` , `cod_usu` , `resul_exam` , `observaciones` ) 
			VALUES ('$iden_labs', '$nord_dlab', '906625', '$fec', '$fent', '$codig_usu', '$res_hcg', '$obs_hcg')");

			echo "<body onload='enviar()'>";
		}
		
		else
		{
		
			//echo "EL EXAMEN YA TIENE ESTE FORMATO HCG-B ";
			echo "<body onload='enviar(1)'>";
		
		}
	}
	if($format==8)
	{
		echo "<input type=hidden name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=rac_inm value='$rac_inm'>";
		echo"<input type=hidden name=rau_inm value='$rau_inm'>";
		echo"<input type=hidden name=pcc_inm value='$pcc_inm'>";
		echo"<input type=hidden name=pcu_inm value='$pcu_inm'>";
		echo"<input type=hidden name=asc_inm value='$asc_inm'>";
		echo"<input type=hidden name=asu_inm value='$asu_inm'>";
		echo"<input type=hidden name=toc_inm value='$toc_inm'>";
		echo"<input type=hidden name=tou_inm value='$tou_inm'>";
		echo"<input type=hidden name=thc_inm value='$thc_inm'>";
		echo"<input type=hidden name=thu_inm value='$thu_inm'>";
		echo"<input type=hidden name=pac_inm value='$pac_inm'>";
		echo"<input type=hidden name=pbc_inm value='$pbc_inm'>";
		echo"<input type=hidden name=pbu_inm value='$pbu_inm'>";
		echo"<input type=hidden name=brc_inm value='$brc_inm'>";
		echo"<input type=hidden name=bru_inm value='$bru_inm'>";
		echo"<input type=hidden name=poc_inm value='$poc_inm'>";
		echo"<input type=hidden name=pou_inm value='$pou_inm'>";      
		
		$cex_inm=mysql_query("SELECT `iden_dlab` , `num_fac`   FROM labo_inm WHERE num_fac='$nord_dlab' AND iden_dlab='$iden_labs' AND `esta_ord`<>'EL'");
		
		if(mysql_num_rows($cex_inm)==0)
		{
			mysql_query("
			INSERT INTO `labo_inm` ( `iden_dlab` , `num_fac` , `cod_exam` , `cod_usu` , `fec_rec` , `fec_ent` , `inmu_rac` , `inmu_rau` , `inmu_pcc` , `inmu_pcu` , `inmu_asc` , `inmu_asu` , `inmu_tioc` , `inmu_tiou` , `inmu_tihc` , `inmu_tihu` , `inmu_pac` , `inmu_pau` , `inmu_pbc` , `inmu_pbu` , `inm_btc` , `inm_btu` , `inm_ptc` , `inm_ptu` ) 
			VALUES ('$iden_labs', '$nord_dlab', '906304', '$codig_usu', '$fec', '$fent', '$rac_inm', '$rau_inm', '$pcc_inm', '$pcu_inm', '$asc_inm', '$asu_inm', '$toc_inm', '$tou_inm', '$thc_inm', '$thu_inm', '$pac_inm', '$pau_inm', '$pbc_inm', '$pbu_inm', '$brc_inm', '$bru_inm', '$poc_inm', '$pou_inm')");
			
			echo "<body onload='enviar()'>";
		}
		else
		{
			//echo "EL EXAMEN YA TIENE ESTE FORMATO INMUNOLOGICOS ";
			echo "<body onload='enviar(1)'>";
		
		}
			
	
	}
	
	if($format==9)
	{
			echo "<input type=hidden name=codig_usu value='$codig_usu'>";
			echo "<input type=text name=cli_lqd value='$cli_lqd'>";
			echo "<input type=text name=col_lqd value='$col_lqd'>";
			echo "<input type=text name=asp_lqd value='$asp_lqd'>";
			echo "<input type=text name=den_lqd value='$den_lqd'>";
			echo "<input type=text name=rec_globl value='$rec_globl'>";
			echo "<input type=text name=rec_glorj value='$rec_glorj'>";
			echo "<input type=text name=vl_nor value='$vl_nor'>";
			echo "<input type=text name=vl_cre value='$vl_cre'>";
			echo "<input type=text name=dif_neut value='$dif_neut'>";
			
			echo "<input type=text name=dif_linf value='$dif_linf'>";
			echo "<input type=text name=dif_mono value='$dif_mono'>";
			echo "<input type=text name=dif_otr value='$dif_otr'>";
			echo "<input type=text name=dif_gram value='$dif_gram'>";
			echo "<input type=text name=glu_lqd value='$glu_lqd'>";
			
			
			echo "<input type=text name=prote_lqd value='$prote_lqd'>";
			echo "<input type=text name=ldn_lqd value='$ldn_lqd'>";
			echo "<input type=text name=otr_lqd value='$otr_lqd'>";
			echo "<input type=text name=obs_lqd value='$obs_lqd'>";
			
			$cex_lqd=mysql_query("SELECT `iden_dlab` , `num_fac`   FROM  labo_lqd WHERE num_fac='$nord_dlab' AND iden_dlab='$iden_labs'");
			
			if(mysql_num_rows($cex_lqd)==0)
			{
		
			$revisa=("
			INSERT INTO labo_lqd (iden_dlab, num_fac , cod_usu , fech_lqd,
			clas_lqd , asp_lqd , colr_lqd , dens_lqd , gbla_lqd , groj_lqd , 
			norm_lqd , cren_lqd , ntro_lqd ,linf_lqd , mono_lqd , otro_lqd ,
			gram_lqd , gluc_lqd,prot_lqd , ldho_lqd , otrs_lqd , obse_lqd ) 
			VALUES ('$iden_labs', '$nord_dlab','$codig_usu' ,'$fec', '$cli_lqd', '$asp_lqd', '$col_lqd', '$den_lqd', 
			'$rec_globl', '$rec_glorj', '$vl_nor', '$vl_cre', '$dif_neut', '$dif_linf', '$dif_mono', 
			'$dif_otr', '$dif_gram', '$glu_lqd', '$prote_lqd', '$ldn_lqd', '$otr_lqd', '$obs_lqd')");
			echo $revisa;
				//echo "<body onload='enviar()'>";
			}
			
			else
			{
				//echo "EL EXAMEN YA TIENE ESTE FORMATO LIQUIDOS ";
				echo "<body onload='enviar(1)'>";
			
			}
			
			
	}
	if($format==10)
	{
		echo "<input type=hidden name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=bch_hcg value='$bch_hcg'>";
		
		
		$cex_bhc=mysql_query("SELECT `iden_dlab` , `num_fac` FROM labo_bhc WHERE num_fac='$nord_dlab' AND iden_dlab='$iden_labs'");
	
		if(mysql_num_rows($cex_bhc)==0)
		{
			mysql_query("INSERT INTO `labo_bhc` (`iden_dlab` , `num_fac` , `cod_exam` , `cod_usu` , `fec_rec` , `fec_ent` , `lab_bhc` ) 
			VALUES ('$iden_labs', '$nord_dlab','904508' ,'$codig_usu', '$fec', '$fent', '$bch_hcg')");
			echo "<body onload='enviar()'>";	
		}
		
		else
			{
				//echo "EL EXAMEN YA TIENE ESTE FORMATO BHC ";
				echo "<body onload='enviar(1)'>";
			
			}
	}
	if($format==11)
	{
		echo "<input type=hidden name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=trim_tpn  value='$trim_tpn '>";
		
		$cex_tri=mysql_query("SELECT `iden_dlab` , `num_fac` FROM trim_tpn WHERE num_fac='$nord_dlab' AND iden_dlab='$iden_labs'");
		if(mysql_num_rows($cex_bhc)==0)
		{
			mysql_query("INSERT INTO `labo_tri` (`iden_dlab` , `num_fac` , `cod_exam` , `cod_usu` , `fec_rec` , `fec_ent` , `lab_trim` ) 
			VALUES ('$iden_labs', '$nord_dlab', '903439', '$codig_usu', '$fect', '$fent', '$trim_tpn')");
			echo "<body onload='enviar()'>";
		}
		
		else
			{
				//echo "EL EXAMEN YA TIENE ESTE FORMATO TRMP ";
				echo "<body onload='enviar(1)'>";
				
			
			}	
		
	}
	
	if($format==12)
	{
		
		echo "<input type=hidden name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=res_fsh  value='$res_fsh'>";
		echo"<input type=hidden name=obs_fsh  value='$obs_fsh'>";
		
		//$cex_oext=mysql_query("SELECT `iden_dlab` , `num_fac` FROM labo_oexa WHERE iden_dlab='$iden_labs' AND cod_loex=904105");
	
		//if(mysql_num_rows($cex_oext)==0)
		//{
						
			mysql_query("INSERT INTO `labo_oexa` ( `iden_dlab` , `num_fac`  ,`cod_loex` ,`cod_usu` , `fec_recp` , 
			`fec_entr` , `fsh_loex` , `obs_fsh`) 
			VALUES ('$iden_labs', '$num_ord','904105' ,'$codig_usu', '$fec', '$fec', '$res_fsh', '$obs_fsh')");
			//echo $col;
			
			echo "<body onload='enviar()'>";
			
		/*}
		else
		{
		
			echo "<body onload='enviar(1)'>";
		
		
		}*/
	
	}
	
	if($format==13)
	{
		
		echo "<input type=text name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=res_lsh  value='$res_lsh'>";
		echo"<input type=hidden name=obs_lsh  value='$obs_lsh'>";		
	
		//$cex_oext=mysql_query("SELECT `iden_dlab` , `num_fac` FROM labo_oexa WHERE iden_dlab='$iden_labs' AND cod_loex=904107");
	
		/*if($funct==1)
		{*/
			
			mysql_query("INSERT INTO `labo_oexa` (  `iden_loex` ,`iden_dlab` , `num_fac` ,`cod_loex` , `cod_usu` ,
			`fec_recp` , `fec_entr` ,`lsh_loex` , `obs_lsh`) 
			VALUES ('','$iden_labs', '$num_ord','904107' ,'$codig_usu', '$fec', '$fec', '$res_lsh', '$obs_lsh')");
			//echo $col;
			
			echo "<body onload='enviar()'>";
			
		/*}
		else
		{		
			echo "<body onload='enviar(1)'>";
	
		}*/
	
	}
	
	if($format==14)
	{
		echo "<input type=text name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=res_pgt  value='$res_pgt'>";
		echo"<input type=hidden name=obs_pgt  value='$obs_pgt'>";	
		
		$cex_oext=mysql_query("SELECT `iden_dlab` , `num_fac` FROM labo_oexa WHERE iden_dlab='$iden_labs' AND cod_loex=904510");
	
	
		if(mysql_num_rows($cex_oext)==0)
		{
					
			mysql_query("INSERT INTO `labo_oexa` (  `iden_loex` ,`iden_dlab` , `num_fac`  ,`cod_loex`, `cod_usu` , 
			`fec_recp` ,`fec_entr` ,`pgs_loex` , `obs_pgs`) 
			VALUES ('','$iden_labs', '$num_ord','904510' ,'$codig_usu', '$fec', '$fec', '$res_pgt', '$obs_pgt')");
			//echo $col;
			
			echo "<body onload='enviar()'>";
			
		}
		else
		{
		
			echo "<body onload='enviar(1)'>";
		
		
		}
	
	}
	
	if($format==15)
	{
		echo "<input type=text name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=res_tst  value='$res_tst'>";
		echo"<input type=hidden name=obs_est  value='$obs_est'>";
		
		$cex_oext=mysql_query("SELECT `iden_dlab` , `num_fac` FROM labo_oexa WHERE iden_dlab='$iden_labs' AND cod_loex=904601");
	
		if(mysql_num_rows($cex_oext)==0)
		{
			mysql_query("INSERT INTO `labo_oexa` (`iden_loex` ,`iden_dlab` , `num_fac`  ,`cod_loex`, `cod_usu` ,
			`fec_recp` ,`fec_entr` ,`tst_loex` , `obs_tst`) 
			VALUES ('','$iden_labs', '$num_ord','904601' ,'$codig_usu', '$fec', '$fec', '$res_tst', '$obs_est')");
			//echo $col;
			
			echo "<body onload='enviar()'>";
			
		}
		else
		{
		
			echo "<body onload='enviar(1)'>";
		
		
		}
	
	}
	
	if($format==16)
	{
		echo "<input type=text name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=res_est  value='$res_est'>";
		echo"<input type=hidden name=obs_est  value='$obs_est'>";			
			
		$cex_oext=mysql_query("SELECT `iden_dlab` , `num_fac` FROM labo_oexa WHERE iden_dlab='$iden_labs' AND cod_loex=904503");
	
		if(mysql_num_rows($cex_oext)==0)
		{
						
			mysql_query("INSERT INTO `labo_oexa` (`iden_loex` ,`iden_dlab` , `num_fac`  ,`cod_loex`, `cod_usu` ,
			`fec_recp` ,`fec_entr` ,`est_loex` , `obs_est`) 
			VALUES ('','$iden_labs', '$num_ord','904503' ,'$codig_usu', '$fec', '$fec', '$res_est', '$obs_est')");
			//echo $col;
			
			echo "<body onload='enviar()'>";
			
		}
		else
		{
		
			echo "<body onload='enviar(1)'>";
		
		
		}
	
	}
	
	if($format==17)
	{
		
		echo "<input type=text name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=res_ige  value='$res_ige'>";
		echo"<input type=hidden name=obs_ige  value='$obs_ige'>";
		
		$cex_oext=mysql_query("SELECT `iden_dlab` , `num_fac` FROM labo_oexa WHERE iden_dlab='$iden_labs' AND cod_loex=906446 ");
	
		
		if(mysql_num_rows($cex_oext)==0)
		{
				
			mysql_query("INSERT INTO `labo_oexa` (`iden_loex` ,`iden_dlab` , `num_fac` ,`cod_loex`, `cod_usu` ,
			`fec_recp`,`fec_entr` ,`ige_loex` , `obs_ige`) 
			VALUES ('','$iden_labs', '$num_ord','906446' ,'$codig_usu', '$fec', '$fec', '$res_ige', '$obs_ige')");
			//echo $col;
			
			echo "<body onload='enviar()'>";
			
		}
		else
		{
		
			echo "<body onload='enviar(1)'>";
		
		
		}
	
	}
	if($format==18)
	{
		$cex_oext=mysql_query("SELECT `iden_dlab` , `num_fac` FROM labo_oexa WHERE iden_dlab='$iden_labs' AND cod_loex='903427'");
		if(mysql_num_rows($cex_oext)==0)
		{
			echo "<input type=text name=codig_usu value=$codig_usu>";
			mysql_query("INSERT INTO `labo_oexa` (`iden_loex` ,`iden_dlab` , `num_fac` ,`cod_loex`, `cod_usu` ,
				`fec_recp`,`fec_entr` ,`hgc_loex` ) 
				VALUES ('','$iden_labs', '$num_ord','903427' ,'$codig_usu', '$fec', '$fec', 'HG')");
				//echo $col;
			
		echo "<body onload='enviar()'>";
		}
		else
		{
		
			echo "<body onload='enviar(1)'>";
		
		
		}
	}
	if($format==19)
	{
		echo "<input type=hidden name=fnd_mcn value=$fnd_mcn>";
		echo "<input type=hidden name=end_mcn value=$end_mcn>";
		echo "<input type=hidden name=fni_mcn value=$fni_mcn>";
		echo "<input type=hidden name=eni_mcn value=$eni_mcn>";
		echo "<input type=hidden name=obs_mcn value=$obs_mcn>";			
			
		$cex_oext=mysql_query("SELECT `iden_dlab` , `num_fac` FROM labo_oexa WHERE iden_dlab='$iden_labs' AND cod_loex=902219");
	
		if(mysql_num_rows($cex_oext)==0)
		{
						
			mysql_query("INSERT INTO `labo_oexa` (`iden_loex` ,`iden_dlab` , `num_fac` ,`cod_loex`, `cod_usu` ,
			`fec_recp`,`fec_entr` ,`fnd_mcn`, `end_mcn`, `fni_mcn`, `eni_mcn`, `obs_mcn`) 
			VALUES ('','$iden_labs', '$num_ord','902219' ,'$codig_usu', '$fec', '$fec', '$fnd_mcn','$end_mcn','$fni_mcn','$eni_mcn','$obs_mcn')");
				//echo $col;
			
			echo "<body onload='enviar()'>";
			
		}
		else
		{
		
			echo "<body onload='enviar(1)'>";
		
		
		}
	
	}
	if($format==22)
	{
		echo "<input type=hidden name=codig_usu value=$codig_usu>";
		echo"<input type=hidden  name='tp_mues' value='$tp_mues'>";
		echo"<input type=hidden  name='chk_' value='$chk_'>";		
			
		$cex_oext=mysql_query("SELECT `iden_dlab` , `num_fac` FROM labo_oexa WHERE iden_dlab='$iden_labs' AND cod_loex='901305'");
	
		if(mysql_num_rows($cex_oext)==0)
		{
						
			mysql_query("INSERT INTO `labo_oexa` (  `iden_loex` ,`iden_dlab` , `num_fac` ,`cod_loex` , `cod_usu` ,
			`fec_recp` , `fec_entr` ,`khi_oex` , `khv_oex`) 
			VALUES ('','$iden_labs', '$num_ord','901305' ,'$codig_usu', '$fec', '$fec', '$tp_mues', '$chk_')");
			//echo $col;
			
			echo "<body onload='enviar()'>";
			
		}
		else
		{
		
			echo "<body onload='enviar(1)'>";
		
		
		}
	
	}
	if($format==20)
	{
		echo "<input type=hidden name=gbl_esp value=$gbl_esp>";
		echo "<input type=hidden name=nume_esp value=$nume_esp>";
		echo "<input type=hidden name=hip_esp value=$hip_esp>";
		echo "<input type=hidden name=ani_esp value=$ani_esp>";
		echo "<input type=hidden name=mcr_esp value=$mcr_esp>";
		echo "<input type=hidden name=mic_esp value=$mic_esp>";
		echo "<input type=hidden name=pqu_esp value=$pqu_esp>";
		echo "<input type=hidden name=dic_esp value=$dic_esp>";
		echo "<input type=hidden name=esq_esp value=$esq_esp>";
		echo "<input type=hidden name=otr_mcn value=$otr_mcn>";
		echo "<input type=hidden name=org_esp value=$org_esp>";
		echo "<input type=hidden name=poli_esp value=$poli_esp>";
		echo "<input type=hidden name=obsv_esp value=$obsv_esp>";
		echo "<input type=hidden name=codusu value=$codusu>";
		echo "<input type=hidden name='chk_nn' value=$chk_nn>";
		echo "<input type=hidden name=nord_dlab value='$nord_dlab'>";
		echo "<input type=hidden name=iden_labs value=$iden_labs>";
		echo "<input type=hidden name=codusu value=$codusu>";

		
		$cex_sang=mysql_query("SELECT `iden_dlab` , `num_fac` FROM labo_sgre WHERE iden_dlab='$iden_labs'");
	
		if(mysql_num_rows($cex_sang)==0)
		{
			$rte=mysql_query("INSERT INTO `labo_sgre` (  `iden_esp`,`iden_dlab` , `num_fac` , `cod_usu` , `fech_esp` , 
			`gbl_esp` , `nume_esp`,`nnom_esp`,`hip_esp` , `ani_esp` , `mcr_esp` , `mic_esp` , `pqu_esp` , `dic_esp` , `esq_esp` , `otr_mcn` ,
			`org_esp` , `poli_esp` ,`pla_esp`,`plaq_esp` ,`obsv_esp`,`esta_esp`) 
			VALUES ( null,'$iden_labs', '$nord_dlab', '$codusu', '$fec', '$gbl_esp', '$nume_esp','$chk_nn','$hip_esp', '$ani_esp', '$mcr_esp', 
			'$mic_esp', '$pqu_esp', '$dic_esp', '$esq_esp', '$otr_mcn', '$org_esp', '$poli_esp','$pla_esp','$plaq_esp' ,'$obsv_esp','')");
			//echo $rte;
			echo "<body onload='enviar()'>";
		}
		else
		{
		
			echo "<body onload='enviar(1)'>";
		
		
		}
	
	}
	if($format==23)
	{
			
			echo"<input type=hidden name='vlt_chk' value='$vlt_chk'>";
			echo"<input type=hidden name='tpm_alch' value='$tpm_alch'>";
			echo"<input type=hidden name='chk1_alc' value='$chk1_alc'>";
			echo"<input type=hidden name='chk2_alc' value='$chk2_alc'>";
			echo"<input type=hidden name='chk3_alc' value='$chk3_alc'>";
			echo"<input type=hidden name='chk_1' value='$chk_1'>";
			echo"<input type=hidden name='tpm_neg1' value='$tpm_neg1'>";
			echo"<input type=hidden name='tpm_pos1' value='$tpm_pos1'>";
			echo"<input type=hidden name='chk_2' value='$chk_2'>";
			echo"<input type=hidden name='tpm_neg2' value='$tpm_neg2'>";
			echo"<input type=hidden name='tpm_pos2' value='$tpm_pos2'>";
			echo"<input type=hidden name='chk_3' value='$chk_3'>";
			echo"<input type=hidden name='tpm_neg3' value='$tpm_neg3'>";
			echo"<input type=hidden name='tpm_pos3' value='$tpm_pos3'>";
			
			$cex_oext=mysql_query("SELECT `iden_dlab` ,`tipo_mue` ,`num_mue` , `esta_mue` , `valo_mue`,`est_oex2` 
			FROM labo_oex2 WHERE `iden_dlab`='$iden_labs' AND est_oex2<>'EL'");
			if(mysql_num_rows($cex_oext)==0)
			{
					if($chk_1=='N')
					{

						mysql_query("INSERT INTO `labo_oex2` ( `iden_dlab` , `nume_fac` , `cod_exam` , `cod_usua` , `fech_recp` , `fech_entr` , `tipo_mue` , `num_mue` , `esta_mue` , `valo_mue` ) 
						VALUES ('$iden_labs', '$nord_dlab', '901101', '$codusu', '$fec', '$fec', '$tpm_alch', '1', 'N', '$tpm_neg1')");
						
					}
					if($chk_1=='P')
					{
						mysql_query("INSERT INTO `labo_oex2` ( `iden_dlab` , `nume_fac` , `cod_exam` , `cod_usua` , `fech_recp` , `fech_entr` , `tipo_mue` , `num_mue` , `esta_mue` , `valo_mue` ) 
						VALUES ('$iden_labs', '$nord_dlab', '901101', '$codusu', '$fec', '$fec', '$tpm_alch', '1', 'P', '$tpm_neg1')");
				
					
					}
				
				
				
					if($chk_2=='N')
					{
						mysql_query("INSERT INTO `labo_oex2` ( `iden_dlab` , `nume_fac` , `cod_exam` , `cod_usua` , `fech_recp` , `fech_entr` , `tipo_mue` , `num_mue` , `esta_mue` , `valo_mue` ) 
						VALUES ('$iden_labs', '$nord_dlab', '901101', '$codusu', '$fec', '$fec', '$tpm_alch', '2', 'N', '$tpm_neg2')");
						//echo "$col";
					}
					if($chk_2=='P')
					{
						
						mysql_query("INSERT INTO `labo_oex2` ( `iden_dlab` , `nume_fac` , `cod_exam` , `cod_usua` , `fech_recp` , `fech_entr` , `tipo_mue` , `num_mue` , `esta_mue` , `valo_mue` ) 
						VALUES ('$iden_labs', '$nord_dlab', '901101', '$codusu', '$fec', '$fec', '$tpm_alch', '2', 'P', '$tpm_neg2')");
			
					
					}
				
					
				
					if($chk_3=='N')
					{

						mysql_query("INSERT INTO `labo_oex2` ( `iden_dlab` , `nume_fac` , `cod_exam` , `cod_usua` , `fech_recp` , `fech_entr` , `tipo_mue` , `num_mue` , `esta_mue` , `valo_mue` ) 
					VALUES ('$iden_labs', '$nord_dlab', '901101', '$codusu', '$fec', '$fec', '$tpm_alch', '3', 'N', '$tpm_neg3')");
					}
					if($chk_3=='P')
					{
						mysql_query("INSERT INTO `labo_oex2` ( `iden_dlab` , `nume_fac` , `cod_exam` , `cod_usua` , `fech_recp` , `fech_entr` , `tipo_mue` , `num_mue` , `esta_mue` , `valo_mue` ) 
						VALUES ('$iden_labs', '$nord_dlab', '901101', '$codusu', '$fec', '$fec', '$tpm_alch', '3', 'P', '$tpm_neg3')");
			
					
					}
				
				echo "<body onload='enviar()'>";
			}
			else
			{
				echo "<body onload='enviar(1)'>";
			
			}
	}
	if($format==24)
	{
		$cex_gram=mysql_query("SELECT `iden_dlab` ,`tipo_mue` ,`num_mue` , `esta_mue` , `valo_mue`,`est_oex2` 
			FROM labo_oex2 WHERE `iden_dlab`='$iden_labs' AND cod_exam='901107'");
	
		if(mysql_num_rows($cex_gram)==0)
		{
			echo "<input type=hidden name=codig_usu value=$codig_usu>";
			echo "<input type=hidden name='tpm_grm' value='$tpm_grm'>";
			echo "<input type=hidden name='chk_' value='$chk_'>";
			echo "<input type=hidden name='coc' value='$coc'>";
			echo "<input type=hidden name='bac' value='$bac'>";
			echo "<input type=hidden name='cba' value='$cba'>";
			echo "<input type=hidden name='gpos' value='$gpos'>";
			echo "<input type=hidden name='gneg' value='$gneg'>";
			echo "<input type=hidden name='gvar' value='$gvar'>";
			echo "<input type=hidden name='ov' value='$ov'>";
			echo "<input type=hidden name=otrvar  value=$otrvar>";

			$sql=mysql_query("INSERT INTO `labo_oex2` ( `iden_dlab` , `nume_fac` , `cod_exam` , `cod_usua` , `fech_recp` , `fech_entr` , `tipo_mue`, `esta_mue` ,`coco_grm`, `baci_grm`, `cbac_grm`, `gpos_grm`, `gneg_grm`, `gvar_grm`, `otro_grm` ) 
					VALUES ('$iden_labs', '$num_ord', '901107', '$codusu', '$fec', '$fec', '$tpm_grm','$chk_','$coc', '$bac','$cba','$gpos','$gneg','$gvar','$otrvar')");
		
				//echo $col;
			
			echo "<body onload='enviar()'>";
		}
		else
		{
		
			echo "<body onload='enviar(1)'>";
		
		
		}
	}
	if($format==25)
	{
		//$cex_copr=mysql_query("SELECT `iden_dlab` ,`tipo_mue` ,`num_mue` , `esta_mue` , `valo_mue`,`est_oex2` 
			//FROM labo_oex2 WHERE `iden_dlab`='$iden_labs' AND cod_exam='907002' AND est_oex2<>'EL'");
	
		//if(mysql_num_rows($cex_copr)==0)
		//{
			echo"<input type=text name='col_mues' value='$col_mues'>";
			echo"<input type=text name='asp_mues' value='$asp_mues'>";
			echo"<input type=text name='qui_eth' value='$qui_eth'>";
			echo"<input type=text name='trz_amb' value='$trz_amb'>";
			echo"<input type=text name='qui_etmb' value='$qui_etmb'>";
			echo"<input type=text name='qui_gins' value='$qui_gins'>";
			echo"<input type=text name='qui_exna' value='$qui_exna'>";
			echo"<input type=text name='trz_gins' value='$trz_gins'>";
			echo"<input type=text name='qui_blh' value='$qui_blh'>";
			echo"<input type=text name='otr_pst' value='$otr_pst'>";
			echo"<input type=text name='chk_' value='$chk_'>";
			echo"<input type=text name='nsp_mues' value='$nsp_mues'>";
			echo"<input type=text name='obs_mcn' value='$obs_mcn'>";

			$sql_="INSERT INTO `labo_oex2` ( `iden_dlab` , `nume_fac` , `cod_exam` , `cod_usua` , `fech_recp` , `fech_entr` ,`tipo_mue`,`esta_mue`,`valo_mue`, `coco_grm`, `baci_grm`, `cbac_grm`, `gpos_grm`, `gneg_grm`, `gvar_grm`, `otro_grm`, `qbho_cpr`, `nobs_cpr`,`obse_cpr` ) 
					VALUES ('$iden_labs', '$num_ord', '907002', '$codusu', '$fec', '$fec', '$col_mues','$asp_mues','$qui_eth', '$trz_amb','$qui_etmb','$qui_gins','$qui_exna','$trz_gins','$qui_blh','$otr_pst','$chk_','$nsp_mues','$obs_mcn')";
		
			
			$sql=mysql_query($sql_);
		
				//echo $col;
			
			echo "<body onload='enviar()'>";
		/*}
		else
		{
		
			echo "<body onload='enviar(1)'>";
		
		
		}*/
	}
	
	if($format==26)
	{
		$cex_oext=mysql_query("SELECT `iden_dlab` , `num_fac` FROM labo_oexa WHERE iden_dlab='$iden_labs' AND cod_loex='904903' and esta_ord='EL'");
		if(mysql_num_rows($cex_oext)<>0)
		{
			echo "<input type=text name=codig_usu value=$codig_usu>";
			mysql_query("INSERT INTO `labo_oexa` (`iden_loex` ,`iden_dlab` , `num_fac` ,`cod_loex`, `cod_usu` ,
				`fec_recp`,`fec_entr` ,`tsh_oexa` ) 
				VALUES ('','$iden_labs', '$num_ord','904903' ,'$codig_usu', '$fec', '$fec', 'TS')");
				//echo $col;
			
		echo "<body onload='enviar()'>";
		}
		else
		{
		
			echo "<body onload='enviar(1)'>";
		
		
		}
	}
	 if($format==27)
	{
		echo "<input type=text name=codig_usu value=$codig_usu>";
		mysql_query("INSERT INTO `labo_oexa` (`iden_loex` ,`iden_dlab` , `num_fac` ,`cod_loex`, `cod_usu` ,
			`fec_recp`,`fec_entr` ,`tsh_oexa` ) 
			VALUES ('','$iden_labs', '$num_ord','906610' ,'$codig_usu', '$fec', '$fec', 'AP')");
			//echo $col;
			
			echo "<body onload='enviar()'>";
	}
	if($format==28)
	{
		    
            echo "<input type=text name=codig_usu value=$codig_usu>";
			mysql_query("INSERT INTO `labo_oexa` (`iden_loex` ,`iden_dlab` , `num_fac` ,`cod_loex`, `cod_usu` ,
				`fec_recp`,`fec_entr` ,`tsh_oexa` ) 
				VALUES ('','$iden_labs', '$nord_dlab','E904004' ,'$codusu', '$fec', '$fec', 'PN')");
				//echo $col;
			
			echo "<body onload='enviar()'>";
		
	}
	

	?>
	

</form>
</body>
</html>
