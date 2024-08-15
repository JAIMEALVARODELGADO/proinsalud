<?session_register('Gidusulab'); ?>
<html>
<head>
<script language='JavaScript'>
function enviar()
{	
	if(form1.evalua.value==1)
	{
		form1.target='';
		form1.action='gresul_.php';
		form1.submit();	
	}
	
	if(form1.evalua.value==2)
	{
		form1.target='';
		form1.action='ing_cups.php';
		form1.submit();	
	
	
	}
	if(form1.evalua.value==3)
	{
		form1.target='';
		form1.action='ing_cups2.php';
		form1.submit();	
	
	}
	
	if(form1.evalua.value==21)
	{
		form1.target='';
		form1.action='modi_labs.php';
		form1.submit();	
	}
}
function enviar2()
{
	form1.target='';
		form1.action='edit_examen.php';
		form1.submit();	

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
		echo $format;
		//echo $hor;
		//echo $Gidusulab;
		echo "<input type=hidden name=control value=2>";
		echo "<input type=hidden name=iden_uco value=$iden_uco>";
		echo"<input type=hidden name=idein value=$idein>";
		echo"<input type=text name=nord_lab value=$nord_lab>";
		
		$nomvar='codusu'.$it;
		$codusu=$$nomvar;	
		echo"<input type=hidden name=dx_ing value='$dx_ing'>";
		echo"<input type=text name=$nomvar value=$codusu>";
		echo "<input type=text name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=amb_usu  value='$amb_usu'>";
		echo"<input type=hidden name=fin_con  value='$fin_con'>";
		echo"<input type=hidden name=condu  value='$condu'>";
		echo"<input type=hidden name=progu  value='$progu'>";
		echo"<input type=hidden name=med_soli  value='$med_soli'>";
		echo"<input type=hidden name=fent value=$fent>";
		echo "<input type=hidden name=idenevo value=$idenevo>";
		echo"<input type=hidden name=ide_cita value=$ide_cita>";
		echo"<input type=hidden name=fin value=$fin>";
		
		$nomvar='iden_labs'.$it;
		$iden_labs=$$nomvar;
		echo"TOY1<input type=text name=$nomvar value=$iden_labs>";
		
		//echo"<input type=text name=iden_labs value=$iden_labs>";
		echo"<input type=text name=evalua value=$evalua>";
		
		$nomvar='num_ord'.$it;
		$num_ord=$$nomvar;
		echo"<input type=text name=$nomvar value=$num_ord>";

		
		echo "<input type=hidden name=obs_labs value='$obs_labs'>";
		echo "<input type=hidden name=it value=$it>";

		
	for($i=0;$i<$mcu;$i++)
	{
				$nomvar='selec'.$it.$i;
				$sel=$$nomvar;	
				
				
				$nomvar='cod'.$it.$i;
				$cod=$$nomvar;	
				
				$nomvar='obs'.$it.$i;
				$obs=$$nomvar;
				
				$nomvar='uni'.$it.$i;
				$unlabc=$$nomvar;
				
				$nomvar='ref'.$it.$i;
				$ref=$$nomvar;
				
				echo "<br>".$obs;
				echo "<br>".$unlabc;
				echo "<br>".$ref;
				
				echo "<br>".$cod;
				
				$nomvar='selec'.$it.$i;
				echo"<input type=hidden name=$nomvar value=$sel>";
				
				$nomvar='cod'.$it.$i;
				echo"<input type=hidden name=$nomvar value=$cod>";
				
				$nomvar='obs'.$it.$i;
				echo"<input type=hidden name=$nomvar value=$obs>";
				
				$nomvar='uni'.$it.$i;
				echo"<input type=hidden name=$nomvar value=$unlabc>";
				
				$nomvar='ref'.$it.$i;
				echo"<input type=hidden name=$nomvar value=$ref>";	
				
	}
		
		
		echo "<input type=hidden name=idein value=$idein>";
		echo"<input type=hidden name=mcu value=$mcu>";
	
	
	for($i=1;$i<$mcu;$i++)
		{
			$nomvar='selec'.$i;
			$sel=$$nomvar;	
			$nomvar='cod'.$i;
			$cod=$$nomvar;	
			$nomvar='obs'.$i;
			$obs=$$nomvar;
			$nomvar='uni'.$i;
			$unlabc=$$nomvar;
			$nomvar='ref'.$i;
			$ref=$$nomvar;
				
			$nomvar='selec'.$i;
			echo"<input type=hidden name=$nomvar value=$sel>";
			$nomvar='cod'.$i;
			echo"<br><input type=text name=$nomvar value=$cod>";
			$nomvar='obs'.$i;
			echo"<br><input type=hidden name=$nomvar value=$obs>";
			$nomvar='uni'.$i;
			echo"<br><input type=hidden name=$nomvar value=$unlabc>";
			$nomvar='ref'.$i;
			echo"<br><input type=hidden name=$nomvar value=$ref>";		
		}
	
	if($format==1)
	{
			
			//COMPROBACION DE ENVIO DE LAS VARIABLES
			
			$ph=$_POST["ph"];
			
			echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input type=text name=ph_uru value=$ph_uru>";
			echo"<input type=text name=asp_uru value='$asp_uru'>";
			echo"<input type=text name=leu_uru value=$leu_uru>";
			echo"<input type=text name=color_uru value=$color_uru>";
			echo"<input type=text name=epi_uru value=$epi_uru>";
			echo"<input type=text name=her_uru value=$her_uru>";
			echo"<input  type=text name=hem_uru  value='$hem_uru'>";
			echo"<input type=text name=den_uru value=$den_uru>";
			echo"<input type=text name=cili_uru value=$cili_uru>";
			echo"<input type=text name=alb_uru value=$alb_uru>";
			echo"<input type=text name=cris_uru value='$cris_uru'>";
			echo"<input type=text name=cris_uru2 value='$cris_uru2'>";
			echo"<input type=text name=cri_uru value='$cri_uru'>";
			echo"<input type=text name=glu_uru value=$glu_uru>";
			echo"<input type=text name=moco_uru value=$moco_uru>";
			echo"<input type=text name=esc2_uru value=$esc2_uru>";
			echo"<input type=text name=cet_uru value=$cet_uru>";
			echo"<input type=text name=lev_uru value=$lev_uru>";
			echo"<input type=text name=pig_uru value=$pig_uru>";
			echo"<input type=text name=bac_uru value=$bac_uru>";
			echo"<input type=text name=val_uru value='$val_uru' >";
			echo"<input type=text name=esc_uru value=$esc_uru>";
			echo"<input type=text name=san_uru value=$san_uru>";
			echo"<input type=text name=tri_uru value=$tri_uru>";
			echo"<input type=text name=uro_uru value=$uro_uru>";
			echo"<input type=text name=nit_uru value=$nit_uru>";
			echo"<input type=text name=obs_uru value='$obs_uru'>";
			echo"<input type=text name=alt_uru value=$alt_uru>";
			echo"<input type=text name=con_uru value=$con_uru>";
			echo"<input type=text name=esp_uru value=$esp_uru>";
			echo"<input type=text name=oglu_uro value=$oglu_uro>";
			
		if($funct==1)
		{
			mysql_query("update uroana set aspectos='$asp_uru' ,`color`='$color_uru', `ph`='$ph_uru', `densidad`='$den_uru', `albumina`='$alb_uru', `valo_gluc`='$oglu_uro',
			`glucosa`='$glu_uru', `cetonas`='$cet_uru', `pigm_biliares`='$pig_uru', `sangre`='$san_uru', `urobilinogeno`='$uro_uru',`val_uru`='$val_uro', `nitritos`='$nit_uru', 
			`leucocitos`='$leu_uru', `epiteliales`='$epi_uru', `hermaties`='$her_uru', `cilidros`='$cili_uru', `cristales`='$cris_uru',`cris_uru2`='$cris_uru2' ,`valo_cri`='$cri_uru',`moco`='$moco_uru', `esc2`='$esc2_uru',
			`levadura`='$lev_uru', `bacterias`='$bac_uru', `esc`='$esc_uru',`tricomonas`='$tri_uru', `obervaciones`='$obs_uru' WHERE iden_dla=$iden_labs");
			//echo $mqu;
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
                  VALUES ('$iden_labs','$nord_lab','907106', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Uroanalisis', '$Gidusulab')";	
            //echo $eval;  
            mysql_query($eval);
			echo "<body onload='enviar2()'>";
		}
		else
		{
			//echo $iden_labs;
			$cons=mysql_query("INSERT INTO `uroana` ( `iden_dla`, `num_fac`, `cod_examen`, `fec_rec` , `fec_ent` , `ced_usu` , `aspectos` , `color` , `ph` , `densidad` , `albumina` ,`valo_gluc`,`glucosa` , `cetonas` , `pigm_biliares` , `sangre` , `urobilinogeno` , `val_uru` , `nitritos` , `leucocitos` , `epiteliales` , `alt` , `hermaties` , `valo_hem` , `cilidros` , `cristales` , `valo_cri` , `cris_uru2` , `moco` , `esc2` , `levadura` , `bacterias` , `esc` , `tricomonas` , `obervaciones` , `con` , `esp` ) 
			VALUES ('$iden_labs','$num_ord','907106','$fec','$fent','$codig_usu','$asp_uru','$color_uru','$ph_uru','$den_uru','$alb_uru','$oglu_uro','$glu_uru', '$cet_uru','$pig_uru','$san_uru','$uro_uru','$val_uru','$nit_uru','$leu_uru','$epi_uru','$alt_uru','$her_uru','$hem_uru','$cili_uru','$cris_uru','$cri_uru','$cris_uru2' ,'$moco_uru','$esc2_uru','$lev_uru','$bac_uru','$esc_uru','$tri_uru','$obs_uru','$con_uru','$esp_uru')");
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
                VALUES ('$iden_labs','$nord_lab','907106', '$fec', '$hor', '$codig_usu', 'IN', 'Ingresado a la BD - Formato Uroanalisis', '$Gidusulab')";	
            mysql_query($eval);
			echo "<body onload='enviar()'>";
		}
	}

	if($format==2)
	{
		
		echo "<input type=text name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=co_ftv value=$co_ftv>";
		echo "<input type=hidden name=ba_ftv value=$ba_ftv>";
		echo "<input type=hidden name=coba_ftv value=$coba_ftv>";
		echo "<input type=hidden name=grap_ftv value=$grap_ftv>";
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
		if($funct==1)
		{
			mysql_query("UPDATE frotis SET  `ph`='$ph_ftv',`testaminas`='$tea_ftv',`koh`='$koh_ftv', `trichomava`='$tcv_ftv', `pmn`='$pmc_ftv', `celulasgui`='$ceg_ftv', `levaduras`='$lev_ftv',
			`seudomicel`='$seu_ftv', `lactobacil`='$lac_ftv', `cocos`='$coba_ftv', `bacilos`='$ba_ftv', `cocobacilo`='$coba_ftv', `grampositi`='$grap_ftv', `gramnegati`='$gran_ftv', `pmnxcamcer`='$pmc_ftv', 
			`diplointra`='$dgni_ftv', `diploextra`='$dgne_ftv', `observaciones`='$obsfrt_ftv' WHERE iden_dlab=$iden_labs");
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
                  VALUES ('$iden_labs','$nord_lab','901304', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Frotis', '$Gidusulab')";	
            //echo $eval;  
            mysql_query($eval);		
			echo "<body onload='enviar2()'>";
		}
		else
		{
			//mysql_query("insert into frotis values( '0',$iden_labs,'$fac_num',892901,'$fec','$fent','$codig_usu','$ph_ftv','$tea_ftv','$koh_ftv','$tcv_ftv','$pmc_ftv','$ceg_ftv','$lev_ftv', '$seu_ftv','$lac_ftv','$co_ftv','$ba_ftv','$coba_ftv','$grap_ftv','$gran_ftv','$granv_ftv','$pmnxcamcer','$dgni_ftv','$dgne_ftv','$obsfrt_ftv')");
			mysql_query("INSERT INTO `frotis` (`iden_dlab` , `num_fac` , `cod_examen` , `fec_ent` , `fec_rec` , `cod_usu` , `ph` , `testaminas` , `koh` , `trichomava` , `pmn` , `celulasgui` , `levaduras` , `seudomicel` , `lactobacil` , `cocos` , `bacilos` , `cocobacilo` , `grampositi` , `gramnegati` , `granv` , `pmnxcamcer` , `diplointra` , `diploextra` , `observaciones` ) 
						  VALUES ('$iden_labs', '$num_ord', '901304', '$fec', '$fent', '$codig_usu', '$ph_ftv', '$tea_ftv', '$koh_ftv', '$tcv_ftv', '$pmc_ftv', '$ceg_ftv', '$lev_ftv', '$seu_ftv', '$lac_ftv', '$co_ftv', '$ba_ftv', '$coba_ftv', '$grap_ftv', '$gran_ftv', '$granv_ftv', '$pmnxcamcer', '$dgni_ftv', '$dgne_ftv', '$obsfrt_ftv')");
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
                VALUES ('$iden_labs','$nord_lab','901304', '$fec', '$hor', '$codig_usu', 'IN', 'Ingresado a la BD - Formato Frotis', '$Gidusulab')";	
            mysql_query($eval);
			echo "<body onload='enviar()'>";	
		}
		
	
	}
	if($format==3)
	{
			echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input type=text name=con_cps value=$con_cps>";
			echo"<input type=text name=qc_cps  value=$qc_cps>";
			echo"<input type=text name=hom_cps value=$hom_cps>";
			echo"<input type=text name=qh_cps  value=$qh_cps>";
			echo"<input type=text name=qeh_cps value=$qeh_cps>";
			echo"<input type=text name=qn_cps  value=$qh_cps>";
			echo"<input type=text name=qem_cps value=$qem_cps>";
			echo"<input type=text name=bh_cps  value=$bh_cps>";
			echo"<input type=text name=bla_cps value=$bla_cps>";
			echo"<input type=text name=ch_cps  value=$ch_cps>";
			echo"<input type=text name=chi_cps value=$chi_cps>";
			echo"<input type=text name=tz_cps  value=$tz_cps>";
			echo"<input type=text name=tro_cps value=$tro_cps>";
			echo"<input type=text name=color_cps value=$color_cps>";
			echo"<input type=text name=ph_cps value=$ph_cps>";
			echo"<input type=text name=moc_cps value=$moc_cps>";
			echo"<input type=text name=san_cps value=$san_cps>";
			echo"<input type=text name=otrcpr_cps value=$otrcpr_cps >";
			echo"<input type=text name=azu_cps value=$azu_cps>";
			echo"<input type=text name=wri_cps value=$wri_cps>";
			echo"<input type=text name=lev_cps value=$lev_cps>";
			echo"<input type=text name=neu_cps value=$neu_cps>";
			echo"<input type=text name=mic_cps value=$mic_cps>";
			echo"<input type=text name=lin_cps value=$lin_cps>";
			echo"<input type=text name=gra_cps value=$gra_cps>";
			echo"<input type=text name=eos_cps value=$eos_cps>";
			echo"<input type=text name=flo_cps value='$flo_cps'>";
			echo"<input type=text name=no_cps value='$no_cps'>";
			echo"<input type=text name=val_cps value='$val_cps'>";
			echo"<input type=text name=leuc_cpr value='$leuc_cpr'>";
			echo"<input type=text name=hema_cpr value='$hema_cpr'>";
			
			if($funct==1)
			{
				mysql_query("UPDATE coprol SET consistenc ='$con_cps',blastocyst ='$bla_cps',`QEColi`='$hom_cps',color ='$color_cps',chilomasti ='$chi_cps',
				ph ='$ph_cps',trofozoito ='$tro_cps',moco ='$moc_cps',sangreocul ='$san_cps',otros ='$otrcpr_cps',azucaresre ='$azu_cps',leuc_cpr='$leuc_cpr',hema_cpr='$hema_cpr',writh ='$wri_cps',
				levadura ='$lev_cps',neutrofilo= '$neu_cps',micelios ='$mic_cps', `linfocitos`='$lin_cps',grasa_neut = '$gra_cps',eosinofilo =  '$eos_cps',
				flora_bact='$flo_cps',qehistolyt='$qeh_cps',qemana =  '$qem_cps' WHERE iden_dlab=$iden_labs");
				
				$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
                 VALUES ('$iden_labs','$nord_lab','907004', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Coprologico', '$Gidusulab')";	
				//echo $eval;  
				mysql_query($eval);			
				echo "<body onload='enviar2()'>";
			}
			else
			{
				mysql_query("INSERT INTO `coprol` ( `iden_dlab` , `num_fac` , `cod_examen` , `fec_rec` , `fec_ent` , `cod_usu` , `consistenc` , `bh` , `blastocyst` , `qc` , `QEColi` , `color` , `ch` , `chilomasti` , `ph` , `tz` , `trofozoito` , `moco` , `sangreocul` , `otros` , `azucaresre` ,`leuc_cpr`,`hema_cpr`, `writh` , `levadura` , `neutrofilo` , `micelios` , `linfocitos` , `grasa_neut` , `eosinofilo` , `flora_bact` , `qh` , `qehistolyt` , `qn` , `qemana` , `observaciones` , `no` , `val` ) 
				VALUES ($iden_labs,'$num_ord',907004,'$fec','$fent','$codig_usu','$con_cps','$bh_cps','$bla_cps','$qc_cps','$hom_cps','$color_cps','$ch_cps','$chi_cps','$ph_cps','$tz_cps','$tro_cps','$moc_cps','$san_cps','$otrcpr_cps','$azu_cps','$leuc_cpr','$hema_cpr','$wri_cps','$lev_cps','$neu_cps','$mic_cps','$lin_cps','$gra_cps','$eos_cps','$flo_cps','$qh_cps','$qeh_cps','$qn_cps','$qem_cps','$obs_cps','$no_cps','$val_cps')");
				//echo $vol;
				$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
                VALUES ('$iden_labs','$nord_lab','907004', '$fec', '$hor', '$codig_usu', 'IN', 'Ingresado a la BD - Formato Coprologico', '$Gidusulab')";	
				mysql_query($eval);
				
				echo "<body onload='enviar()'>";	
		
			}
		
			
	}
	if($format==4)
	{
			echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input type=text name=fent value=$fent>";
			echo"<input type=text name=hema_ch value='$hema_ch'>";
			echo"<input type=text name=hemo_ch value='$hemo_ch'>";
			echo"<input type=text name=vs_ch   value='$vs_ch'>";
			echo"<input type=text name=leu_ch  value='$leu_ch'>";
			echo"<input type=text name=pla_ch  value='$pla_ch'>";
			echo"<input type=text name=neu_ch  value='$neu_ch'>";
			echo"<input type=text name=cay_ch  value='$cay_ch'>";
			echo"<input type=text name=lin_ch  value='$lin_ch'>";
			echo"<input type=text name=eos_ch  value='$eos_ch'>";
			echo"<input type=text name=mon_ch  value='$mon_ch'>";
			echo"<input type=text name=bas_ch  value='$bas_ch'>";
			echo"<input type=text name=ret_ch  value='$ret_ch'>";
			echo"<input type=text name=vcm_ch value='$vcm_ch'>"; 
			echo"<input type=text name=hcm_ch value='$hcm_ch'>";
			echo"<input type=text name=chcm_ch value='$chcm_ch'>";
			echo"<input type=text name=ide_ch value='$ide_ch'> ";
			echo"<input type=text name=obs_ch  value='$obs_ch'>";
			
			if($funct==1)
			{
					mysql_query("UPDATE cuadroh SET `hemoglobin`='$hemo_ch',`neutrofilos`='$neu_ch',`hematrocit`= '$hema_ch',
					`cayados`= '$cay_ch', `vsg1h`= '$vs_ch', `linfocito`= '$lin_ch', `leococitos`= '$leu_ch', `eosinofilos`= '$eos_ch', 
					`monocitos`= '$mon_ch', `basofilos`= '$bas_ch', `plaquetas`='$pla_ch' , `reticuloci`='$ret_ch' ,`vcm_ch`='$vcm_ch', 
					`hcm_ch`='$hcm_ch', `chcm_ch`='$chcm_ch', `ide_ch`='$ide_ch' ,`observacion`='$obs_ch'
					 WHERE iden_dlab=$iden_labs");
					 $eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
					 VALUES ('$iden_labs','$nord_lab','902210', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato CHematico', '$Gidusulab')";	
					//echo $eval;  
					mysql_query($eval);
					echo "<body onload='enviar2()'>";
				//echo $cohemo;
			}
			else
			{
				echo $iden_labs;
				//mysql_query("insert into cuadroh values( 0,$iden_labs,'$fac_num',902209,'$fec','$fent','$codig_usu','$hemo_ch','$neu_ch','$hema_ch','$cay_ch','$vs_ch','$lin_ch','$leu_ch', '$eos_ch','$mon_ch','$bas_ch','$pla_ch','$ret_ch','$obs_ch')");	
				$vlch=mysql_query("INSERT INTO `cuadroh` ( `iden_dlab` , `num_fac` , `cod_examch` , `fec_rec` , 
				`fec_ent` , `cod_usu` , `hemoglobin` , `neutrofilos` , `hematrocit` , `cayados` , `vsg1h` , 
				`linfocito` , `leococitos` , `eosinofilos` , `monocitos` , `basofilos` , `plaquetas` , 
				`reticuloci` , `vcm_ch`, `hcm_ch`, `chcm_ch`, `ide_ch`, `observacion` ) 
				VALUES ( '$iden_labs', '$num_ord', '902210', '$fec', '$fent', '$codig_usu', '$hemo_ch', 
				'$neu_ch', '$hema_ch', '$cay_ch', '$vs_ch', '$lin_ch', '$leu_ch', '$eos_ch', '$mon_ch', 
				'$bas_ch', '$pla_ch', '$ret_ch', '$vcm_ch','$hcm_ch','$chcm_ch', '$ide_ch','$obs_ch')");
				//echo $vlch;
				$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
                VALUES ('$iden_labs','$nord_lab','902210', '$fec', '$hor', '$codig_usu', 'IN', 'Ingresado a la BD - Formato CHematico', '$Gidusulab')";	
				mysql_query($eval);
				echo "<body onload='enviar()'>";	
			}
	}
	if($format==5)
	{
		echo "<input type=text name=codig_usu value=$codig_usu>";
		echo "este es <input type=text name=datos value='$cdr_varios'>";
		echo $cdr_varios;
		if($funct==1)
		{
			$val=mysql_query("UPDATE `dat_varios` SET `datos` = '$cdr_varios' WHERE iden_dlab='$iden_labs'");
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
				 VALUES ('$iden_labs','$nord_lab','888888', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato CVarios', '$Gidusulab')";	
				//echo $eval;  
			mysql_query($eval);
			echo "<body onload='enviar2()'>";
			//echo $val;
		}
		else
		{
			
			mysql_query("INSERT INTO `dat_varios` ( `iden_dva` , `iden_dlab` , `num_fac` , `fec_rec` , `fec_ent` , `cod_usu` , `cod_examvr` , `datos` , `esta_ord` ) 
			VALUES ('', '$iden_labs', '$num_ord', '$fec', '$fent', '$codig_usu', '888888', '$cdr_varios', '')");
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
                VALUES ('$iden_labs','$nord_lab','888888', '$fec', '$hor', '$codig_usu', 'IN', 'Ingresado a la BD - Formato CVarios', '$Gidusulab')";	
			mysql_query($eval);
			//mysql_query("INSERT INTO `dat_varios` (`iden_dlab` , `num_fac` , `fec_rec` , `fec_ent` , `cod_usu` , `cod_examvr` , `datos` ) 
			//VALUES ('$iden_labs', '$num_ord', '$fec', '$fent', '$codig_usu', '888888', '$datos')");
			echo "<body onload='enviar()'>";	
		}
	}
	if($format==6)
	{
		echo "<input type=text name=codig_usu value=$codig_usu>";
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
				
				$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
				 VALUES ('$iden_labs','$nord_lab','906625', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Espermograma', '$Gidusulab')";	
				//echo $eval;  
				mysql_query($eval);
                 //echo $consulta;
                
                 mysql_query($consulta);
                
        
		echo "<body onload='enviar()'>";	
	}
	if($format==7)
	{
		echo "<input type=text name=codig_usu value=$codig_usu>";
		echo "<input type=hidden name=res_hcg value='$res_hcg'>";
		echo "<input type=hidden name=obs_hcg value='$obs_hcg'>";
		//mysql_query("insert into hcg values( 0,'$iden_labs','$fac_num',906625,'$fec','$fent','$codig_usu','$res_hcg','$obs_hcg')");
		
		mysql_query("INSERT INTO `hcg` (`iden_dlab` , `num_fac` , `cod_examen` , `fec_rec` , `fec_ent` , `cod_usu` , `resul_exam` , `observaciones` ) 
		VALUES ('$iden_labs', '$num_ord', '906625', '$fec', '$fent', '$codig_usu', '$res_hcg', '$obs_hcg')");
		
		$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','906625', '$fec', '$hor', '$codig_usu', 'CR', 'Insertado a la BD - Formato hcg', '$Gidusulab')";	
		//echo $eval;  
		mysql_query($eval);
		echo "<body onload='enviar()'>";
	}
	if($format==8)
	{
		echo "<input type=text name=codig_usu value=$codig_usu>";
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
		//mysql_query("INSERT INTO labo_inm VALUES( 0,$iden_labs,'$fac_num','906304','$codig_usu','$fec','$fent','$rac_inm','$rau_inm','$pcc_inm','$pcu_inm','$asc_inm','$asu_inm','$toc_inm','$tou_inm','$thc_inm','$thu_inm','$pac_inm','$pau_inm','$pbc_inm','$pbu_inm','$brc_inm','$bru_inm','$poc_inm','$pou_inm')");
		
		mysql_query("
		INSERT INTO `labo_inm` ( `iden_dlab` , `num_fac` , `cod_exam` , `cod_usu` , `fec_rec` , `fec_ent` , `inmu_rac` , `inmu_rau` , `inmu_pcc` , `inmu_pcu` , `inmu_asc` , `inmu_asu` , `inmu_tioc` , `inmu_tiou` , `inmu_tihc` , `inmu_tihu` , `inmu_pac` , `inmu_pau` , `inmu_pbc` , `inmu_pbu` , `inm_btc` , `inm_btu` , `inm_ptc` , `inm_ptu` ) 
		VALUES ('$iden_labs', '$num_ord', '906304', '$codig_usu', '$fec', '$fent', '$rac_inm', '$rau_inm', '$pcc_inm', '$pcu_inm', '$asc_inm', '$asu_inm', '$toc_inm', '$tou_inm', '$thc_inm', '$thu_inm', '$pac_inm', '$pau_inm', '$pbc_inm', '$pbu_inm', '$brc_inm', '$bru_inm', '$poc_inm', '$pou_inm')");
		
		$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','906304', '$fec', '$hor', '$codig_usu', 'CR', 'Insertado a la BD - Formato Inmunologia', '$Gidusulab')";	
		//echo $eval;  
		mysql_query($eval);
		echo "<body onload='enviar()'>";	
	
	}
	
	if($format==9)
	{
			
		if($funct==1)
		{
			echo "<input type=text name=codig_usu value='$codig_usu'>";
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
			
			$eva=("UPDATE labo_lqd SET 
			clas_lqd='$cli_lqd', asp_lqd='$asp_lqd',colr_lqd='$col_lqd' , dens_lqd='$den_lqd' , 
			gbla_lqd='$rec_globl' , groj_lqd= '$rec_glorj', norm_lqd='$vl_nor' , cren_lqd='$vl_cre' ,
			ntro_lqd='$dif_neut' ,linf_lqd='$dif_linf' , mono_lqd='$dif_mono' , otro_lqd='$dif_otr' ,
			gram_lqd='$dif_gram' ,ph_lqd='$ph_lqd', koh_lqd='$koh_lqd'  ,gluc_lqd='$glu_lqd',prot_lqd='$prote_lqd' , ldho_lqd='$ldn_lqd' , otrs_lqd='$otr_lqd' , obse_lqd='$obs_lqd'
			WHERE iden_dlab=$iden_labs");
            //echo $eva;
			mysql_query($eva);
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
				 VALUES ('$iden_labs','$nord_lab','Lqdos', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Liquidos', '$Gidusulab')";	
				//echo $eval;  
			mysql_query($eval);
			
			echo "<body onload='enviar2()'>";
		}
		else
		{
			
			echo "<input type=text name=codig_usu value='$codig_usu'>";
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
			echo "<input type=text name=glu_lqd value='$glu_lqd'>";
			
			echo "<input type=text name=dif_gram  value='$dif_gram'>";
            echo "<input type=text name=koh_lqd  value='$koh_lqd'>";
            echo "<input type=text name=ph_lqd  value='$ph_lqd'>";
                        
                        
			echo "<input type=text name=prote_lqd value='$prote_lqd'>";
			echo "<input type=text name=ldn_lqd value='$ldn_lqd'>";
			echo "<input type=text name=otr_lqd value='$otr_lqd'>";
			echo "<input type=text name=obs_lqd value='$obs_lqd'>";
			
			$evaluar="INSERT INTO labo_lqd (iden_dlab, num_fac , cod_usu , fech_lqd,
			clas_lqd , asp_lqd , colr_lqd , dens_lqd , gbla_lqd , groj_lqd , 
			norm_lqd , cren_lqd , ntro_lqd ,linf_lqd , mono_lqd , otro_lqd ,  
			gram_lqd , ph_lqd, koh_lqd, gluc_lqd,prot_lqd , ldho_lqd , otrs_lqd , obse_lqd, esta_ord) 
			VALUES ('$iden_labs', '$num_ord','$codig_usu' ,'$fec', '$cli_lqd', '$asp_lqd', '$col_lqd', '$den_lqd', 
			'$rec_globl', '$rec_glorj', '$vl_nor', '$vl_cre', '$dif_neut', '$dif_linf', '$dif_mono', 
			'$dif_otr', '$dif_gram','$ph_lqd' ,'$koh_lqd','$glu_lqd', '$prote_lqd', '$ldn_lqd', '$otr_lqd', '$obs_lqd',' ')";
			
            mysql_query($evaluar);
            //echo $evaluar;
         
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','Lqdos', '$fec', '$hor', '$codig_usu', 'CR', 'Insertado a la BD - Formato liquidos Biologicos', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			
			echo "<body onload='enviar()'>";
		}
	}
	
	
	if($format==10)
	{
		echo "<input type=text name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=bch_hcg value='$bch_hcg'>";
		//mysql_query("insert into labo_bhc values(0, $iden_labs,'$fac_num','904508','$codig_usu','$fec','$fent','$bch_hcg')");
		
		mysql_query("INSERT INTO `labo_bhc` (`iden_dlab` , `num_fac` , `cod_exam` , `cod_usu` , `fec_rec` , `fec_ent` , `lab_bhc` ) 
		VALUES ('$iden_labs', '$num_ord','904508' ,'$codig_usu', '$fec', '$fent', '$bch_hcg')");
		
		$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','904508', '$fec', '$hor', '$codig_usu', 'CR', 'Insertado a la BD - Formato Inmunologia', '$Gidusulab')";	
		//echo $eval;  
		mysql_query($eval);
		echo "<body onload='enviar()'>";	
	}
	if($format==11)
	{
		
		if($funct==1)
		{
			echo "<input type=text name=codig_usu value=$codig_usu>";
			$eva=mysql_query("UPDATE labo_tri SET lab_trim='$trim_tpn2' WHERE iden_dlab=$iden_labs");
			
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','903439', '$fec', '$hor', '$codig_usu', 'CR', 'Insertado a la BD - Labotri', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			
			echo "<body onload='enviar2()'>";
			
			
		}
		else
		{
			echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input type=hidden name=trim_tpn  value='$trim_tpn '>";
			//mysql_query("insert into labo_tri values( 0, $iden_labs,'$fac_num','903439','$codig_usu','$fect','$fent','$trim_tpn')");
			
			mysql_query("INSERT INTO `labo_tri` (`iden_dlab` , `num_fac` , `cod_exam` , `cod_usu` , `fec_rec` , `fec_ent` , `lab_trim` ) 
			VALUES ('$iden_labs', '$num_ord', '903439', '$codig_usu', '$fect', '$fent', '$trim_tpn')");
			
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','903439', '$fec', '$hor', '$codig_usu', 'CR', 'Insertado a la BD - Formato Labo_tri', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			
			echo "<body onload='enviar()'>";
			
		}
	
	}
	
	if($format==12)
	{
		if($funct==1)
		{
			//echo "<input type=text name=codig_usu value=$codig_usu>";
			echo "<input  type=text name='res_fsh' value='$res_fsh'>";
			echo "<input type=text name=obs_fsh value='$obs_fsh'>";
			$eva=mysql_query("UPDATE labo_oexa SET fsh_loex='$res_fsh',obs_fsh='$obs_fsh' WHERE iden_dlab='$iden_labs'AND cod_loex=904105");
			
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','904105', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes 904105', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			echo "<body onload='enviar2()'>";
		}
		else
		{
			echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input type=hidden name=res_fsh  value='$res_fsh'>";
			echo"<input type=hidden name=obs_fsh  value='$obs_fsh'>";			
			
			mysql_query("INSERT INTO `labo_oexa` ( `iden_dlab` , `num_fac`  ,`cod_loex` ,`cod_usu` , `fec_recp` , 
			`fec_entr` , `fsh_loex` , `obs_fsh`) 
			VALUES ('$iden_labs', '$num_ord','904105' ,'$codig_usu', '$fec', '$fec', '$res_fsh', '$obs_fsh')");
			//echo $col;
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','904105', '$fec', '$hor', '$codig_usu', 'CR', 'Insertado a la BD - Formato Otro examenes 904105', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			
			echo "<body onload='enviar()'>";
			
		}
	
	}
	
	if($format==13)
	{
		if($funct==1)
		{
			//echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input  type=text name=res_lsh  value='$res_lsh'>";
			echo"<input type=hidden name=obs_lsh  value='$obs_lsh'>";				
			$eva=mysql_query("UPDATE labo_oexa SET lsh_loex='$res_lsh',obs_lsh='$obs_lsh' WHERE iden_dlab='$iden_labs' AND cod_loex=904107");
			
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','904107', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes 904107', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			
			echo "<body onload='enviar2()'>";
		}
		else
		{
			echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input type=hidden name=res_lsh  value='$res_lsh'>";
			echo"<input type=hidden name=obs_lsh  value='$obs_lsh'>";			
			
			mysql_query("INSERT INTO `labo_oexa` (  `iden_loex` ,`iden_dlab` , `num_fac` ,`cod_loex` , `cod_usu` ,
			`fec_recp` , `fec_entr` ,`lsh_loex` , `obs_lsh`) 
			VALUES ('','$iden_labs', '$num_ord','904107' ,'$codig_usu', '$fec', '$fec', '$res_lsh', '$obs_lsh')");
			//echo $col;
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','904107', '$fec', '$hor', '$codig_usu', 'CR', 'Insertado a la BD - Formato Otro examenes 904107', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			echo "<body onload='enviar()'>";
			
		}
	
	}
	
	if($format==14)
	{
		if($funct==1)
		{
			//echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input  type=text name=res_pgt  value='$res_pgt'>";
			echo"<input type=hidden name=obs_pgs  value='$obs_pgs'>";
			$eva=mysql_query("UPDATE `labo_oexa` SET `pgs_loex` = '$res_pgt',`obs_pgs` = '$obs_pgs'  WHERE iden_dlab='$iden_labs' AND cod_loex=904510");
			
			$eval_="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','904510', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes 904107', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval_);
			
			
			echo "<body onload='enviar2()'>";
		}
		else
		{
			echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input type=hidden name=res_pgt  value='$res_pgt'>";
			echo"<input type=hidden name=obs_pgt  value='$obs_pgt'>";			
			
			mysql_query("INSERT INTO `labo_oexa` (  `iden_loex` ,`iden_dlab` , `num_fac`  ,`cod_loex`, `cod_usu` , 
			`fec_recp` ,`fec_entr` ,`pgs_loex` , `obs_pgs`) 
			VALUES ('','$iden_labs', '$num_ord','904510' ,'$codig_usu', '$fec', '$fec', '$res_pgt', '$obs_pgt')");
			//echo $col;
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','904510', '$fec', '$hor', '$codig_usu', 'CR', 'Insertado a la BD - Formato Otro examenes 904107', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			echo "<body onload='enviar()'>";
			
		}
	
	}
	
	if($format==15)
	{
		if($funct==1)
		{
			//echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input type=hidden name=res_tst  value='$res_tst'>";
			echo"<input type=hidden name=obs_tst  value='$obs_tst'>";
			$eva=mysql_query("UPDATE labo_oexa SET tst_loex='$res_tst',obs_tst='$obs_tst' WHERE iden_dlab='$iden_labs' AND cod_loex=904601");
			
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','904601', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes 904107', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			
			echo "<body onload='enviar2()'>";
		}
		else
		{
			echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input type=hidden name=res_tst  value='$res_tst'>";
			echo"<input type=hidden name=obs_est  value='$obs_est'>";			
			
			mysql_query("INSERT INTO `labo_oexa` (`iden_loex` ,`iden_dlab` , `num_fac`  ,`cod_loex`, `cod_usu` ,
			`fec_recp` ,`fec_entr` ,`tst_loex` , `obs_tst`) 
			VALUES ('','$iden_labs', '$num_ord','904601' ,'$codig_usu', '$fec', '$fec', '$res_tst', '$obs_est')");
			//echo $col;
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','904601', '$fec', '$hor', '$codig_usu', 'CR', 'Insertado a la BD - Formato Otro examenes 904601', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			echo "<body onload='enviar()'>";
			
		}
	
	}
	
	if($format==16)
	{
		if($funct==1)
		{
			//echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input type=hidden name=res_est  value='$res_est'>";
			echo"<input type=hidden name=obs_est  value='$obs_est'>";	
			$eva=mysql_query("UPDATE labo_oexa SET est_loex='$res_est',obs_est='$obs_est' WHERE iden_dlab='$iden_labs' and cod_loex=904503");
			
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','904503', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes 904503', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			
			echo "<body onload='enviar2()'>";
		}
		else
		{
			echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input type=hidden name=res_est  value='$res_est'>";
			echo"<input type=hidden name=obs_est  value='$obs_est'>";			
			
			mysql_query("INSERT INTO `labo_oexa` (`iden_loex` ,`iden_dlab` , `num_fac`  ,`cod_loex`, `cod_usu` ,
			`fec_recp` ,`fec_entr` ,`est_loex` , `obs_est`) 
			VALUES ('','$iden_labs', '$num_ord','904503' ,'$codig_usu', '$fec', '$fec', '$res_est', '$obs_est')");
			//echo $col;
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','904503', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes 904503', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			echo "<body onload='enviar()'>";
			
		}
	
	}
	
	if($format==17)
	{
		if($funct==1)
		{
			//echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input type=hidden name=res_ige  value='$res_ige'>";
			echo"<input type=hidden name=obs_ige  value='$obs_ige'>";	
			$eva=mysql_query("UPDATE labo_oexa SET ige_loex='$res_ige',obs_ige='$obs_ige' WHERE iden_dlab='$iden_labs' AND cod_loex=906446");
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','906446', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes 906446', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			
			echo "<body onload='enviar2()'>";
		}
		else
		{
			echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input type=hidden name=res_ige  value='$res_ige'>";
			echo"<input type=hidden name=obs_ige  value='$obs_ige'>";			
			
			mysql_query("INSERT INTO `labo_oexa` (`iden_loex` ,`iden_dlab` , `num_fac` ,`cod_loex`, `cod_usu` ,
			`fec_recp`,`fec_entr` ,`ige_loex` , `obs_ige`) 
			VALUES ('','$iden_labs', '$num_ord','906446' ,'$codig_usu', '$fec', '$fec', '$res_ige', '$obs_ige')");
			//echo $col;
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','906446', '$fec', '$hor', '$codig_usu', 'CR', 'Insertado a la BD - Formato Otro examenes 906446', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			echo "<body onload='enviar()'>";
			
		}
	
	}
	
	if($format==18)
	{
		echo "<input type=text name=codig_usu value=$codig_usu>";
		mysql_query("INSERT INTO `labo_oexa` (`iden_loex` ,`iden_dlab` , `num_fac` ,`cod_loex`, `cod_usu` ,
			`fec_recp`,`fec_entr` ,`hgc_loex` ) 
			VALUES ('','$iden_labs', '$num_ord','903427' ,'$codig_usu', '$fec', '$fec', 'HG')");
			//echo $col;
		$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','903427', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes 906446', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);	
		echo "<body onload='enviar()'>";
	}
	
	if($format==19)
	{
		echo "<input type=text name=fnd_mcn value=$fnd_mcn>";
		echo "<input type=text name=end_mcn value=$end_mcn>";
		echo "<input type=text name=fni_mcn value=$fni_mcn>";
		echo "<input type=text name=eni_mcn value=$eni_mcn>";
		echo "<input type=text name=obs_mcn value=$obs_mcn>";
		echo "<input type=text name=codig_usu value=$codig_usu>";
		
		mysql_query("INSERT INTO `labo_oexa` (`iden_loex` ,`iden_dlab` , `num_fac` ,`cod_loex`, `cod_usu` ,
			`fec_recp`,`fec_entr` ,`fnd_mcn`, `end_mcn`, `fni_mcn`, `eni_mcn`, `obs_mcn`) 
			VALUES ('','$iden_labs', '$num_ord','902219' ,'$codig_usu', '$fec', '$fec', '$fnd_mcn','$end_mcn','$fni_mcn','$eni_mcn','$obs_mcn')");
			//echo $col;
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','902219', '$fec', '$hor', '$codig_usu', 'CR', 'Insertado a la BD - Formato Otro examenes 902219', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			echo "<body onload='enviar()'>";
	}
	
	if($format==20)
	{
		echo "<input type=text name=gbl_esp value=$gbl_esp>";
		echo "<input type=text name=nume_esp value=$nume_esp>";
		echo "<input type=text name=hip_esp value=$hip_esp>";
		echo "<input type=text name=ani_esp value=$ani_esp>";
		echo "<input type=text name=mcr_esp value=$mcr_esp>";
		echo "<input type=text name=mic_esp value=$mic_esp>";
		echo "<input type=text name=pqu_esp value=$pqu_esp>";
		echo "<input type=text name=dic_esp value=$dic_esp>";
		echo "<input type=text name=esq_esp value=$esq_esp>";
		echo "<input type=text name=otr_mcn value=$otr_mcn>";
		echo "<input type=text name=org_esp value=$org_esp>";
		echo "<input type=text name=poli_esp value=$poli_esp>";
		echo "<input type=text name=obsv_esp value=$obsv_esp>";
		echo "<input type=text name=codig_usu value=$codig_usu>";
		echo "<input type=text name='chk_nn' value=$chk_nn>";
		
		if($funct==1)
		{
			echo"<input type=text name='tp_mues' value='$tp_mues'>";
			echo"<input type=text name='chk_nn' value='$chk_nn'>";			
			
			$eva=Mysql_query("UPDATE `labo_sgre` SET `gbl_esp`='$gbl_esp' , `nume_esp`='$nume_esp',`hip_esp`='$hip_esp' , `ani_esp`='$ani_esp' , `mcr_esp`='$mcr_esp' ,
			`mic_esp`='$mic_esp' , `pqu_esp`='$pqu_esp' , `dic_esp`='$dic_esp' , `esq_esp`='$esq_esp' , `otr_mcn`='$otr_mcn' ,`nnom_esp`='$chk_nn',
			`org_esp`='$org_esp' , `poli_esp`='$poli_esp' ,`pla_esp`='$pla_esp',`plaq_esp`='$plaq_esp' ,`obsv_esp`='$obsv_esp' WHERE iden_dlab='$iden_labs'");
			//echo $eva;
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','Labosa', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			 echo "<body onload='enviar2()'>";
		}
		
		else
		{		
						
			$inse=MYSQL_QUERY("INSERT INTO `labo_sgre` (  `iden_esp`,`iden_dlab` , `num_fac` , `cod_usu` , `fech_esp` , 
			`gbl_esp` , `nume_esp`,`nnom_esp`,`hip_esp` , `ani_esp` , `mcr_esp` , `mic_esp` , `pqu_esp` , `dic_esp` , `esq_esp` , `otr_mcn` ,
			`org_esp` , `poli_esp` ,`pla_esp`,`plaq_esp` ,`obsv_esp`,`esta_esp`) 
			VALUES ( null,'$iden_labs', '$num_ord', '$codig_usu', '$fec', '$gbl_esp', '$nume_esp','$chk_nn','$hip_esp', '$ani_esp', '$mcr_esp', 
			'$mic_esp', '$pqu_esp', '$dic_esp', '$esq_esp', '$otr_mcn', '$org_esp', '$poli_esp','$pla_esp','$plaq_esp' ,'$obsv_esp','')");
			//echo $inse;
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','Labosa', '$fec', '$hor', '$codig_usu', 'CR', 'Insertado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			echo "<body onload='enviar()'>";
		}
	}
	if($format==22)
	{
	
		if($funct==1)
		{
			echo"<input type=text name='tp_mues' value='$tp_mues'>";
			echo"<input type=text name='chk_' value='$chk_'>";			
			
			$eva=mysql_query("UPDATE labo_oexa SET khi_oex='$tp_mues', khv_oex ='$chk_' WHERE iden_dlab='$iden_labs' AND cod_loex=901305");
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','901305', '$fec', '$hor', '$codig_usu', 'CR', 'Insertado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			echo "<body onload='enviar2()'>";
		}
		else
		{	
			
			echo "<input type=text name=codig_usu value=$codig_usu>";
			echo"<input type=text name='tp_mues' value='$tp_mues'>";
			echo"<input type=text name='chk_' value='$chk_'>";

			mysql_query("INSERT INTO `labo_oexa` (  `iden_loex` ,`iden_dlab` , `num_fac` ,`cod_loex` , `cod_usu` ,
			`fec_recp` , `fec_entr` ,`khi_oex` , `khv_oex`) 
			VALUES ('','$iden_labs', '$num_ord','901305' ,'$codig_usu', '$fec', '$fec', '$tp_mues', '$chk_')");
			
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','901305', '$fec', '$hor', '$codig_usu', 'CR', 'insertado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			
			//echo $col;
			
			echo "<body onload='enviar()'>";
			
		}
	
	}
	if($format==23)
	{
		
		if($funct==1)
		{
			echo "<input type=text name='tpm_alch' value='$tpm_alch'>";
			for($mj=1;$mj<$ic;$mj++)
			{
				$nom_var='valo_mue'.$mj;
				$valo_mue=$$nom_var;
				$nom_var2='esta_mue'.$mj;
				$esta_mue=$$nom_var2;
				$nom_var4='ide_oex'.$mj;
				$ide_oex=$$nom_var4;
			
				$eva="UPDATE `labo_oex2` SET `tipo_mue` = '$tpm_alch',`esta_mue` = '$esta_mue',`valo_mue` = '$valo_mue' 
				WHERE `ide_oex2` ='$ide_oex'";
				$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
				VALUES ('$iden_labs','$nord_lab','Laboex', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
				//echo $eval;  
				mysql_query($eval);
				$sql=mysql_query($eva);
				//echo $eva;
		
			}
			echo "<body onload='enviar2()'>";
		
		}
	
		else
		{	
			echo"<input type=text name='vlt_chk' value='$vlt_chk'>";
			echo"<input type=text name='tpm_alch' value='$tpm_alch'>";
			echo"<input type=text name='chk1_alc' value='$chk1_alc'>";
			echo"este es <input type=text name='chk2_alc' value='$chk2_alc'>";
			echo"<input type=text name='chk3_alc' value='$chk3_alc'>";
			
					
			
			echo"<input type=text name='chk_1' value='$chk_1'>";
			echo"<input type=text name='tpm_neg1' value='$tpm_neg1'>";
			echo"<input type=text name='tpm_pos1' value='$tpm_pos1'>";
			
			echo"<input type=text name='chk_2' value='$chk_2'>";
			echo"<input type=text name='tpm_neg2' value='$tpm_neg2'>";
			echo"<input type=text name='tpm_pos2' value='$tpm_pos2'>";
			
			echo"<input type=text name='chk_3' value='$chk_3'>";
			echo"<input type=text name='tpm_neg3' value='$tpm_neg3'>";
			echo"<input type=text name='tpm_pos3' value='$tpm_pos3'>";
			
			//if($chk1_alc==1)
			//{
				if($chk_1=='N')
				{

					mysql_query("INSERT INTO `labo_oex2` (`iden_dlab`, `nume_fac`, `cod_exam`, `cod_usua`, `fech_recp`, `fech_entr`, `tipo_mue`, `num_mue`, `esta_mue`, `valo_mue`, `coco_grm`, `baci_grm`, `cbac_grm`, `gpos_grm`, `gneg_grm`, `gvar_grm`, `otro_grm`, `qbho_cpr`, `nobs_cpr`, `obse_cpr`, `est_oex2`) 
					VALUES ('$iden_labs', '$num_ord', '901101', '$codig_usu', '$fec', '$fec', '$tpm_alch', '1', 'N', '$tpm_neg1', '', '', '', '', '', '', '', '', '', '', '')");
					//echo $con1;
					$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
					VALUES ('$iden_labs','$nord_lab','901101', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
					//echo $eval;  
					mysql_query($eval);
				}
				if($chk_1=='P')
				{
					mysql_query("INSERT INTO `labo_oex2` (`iden_dlab`, `nume_fac`, `cod_exam`, `cod_usua`, `fech_recp`, `fech_entr`, `tipo_mue`, `num_mue`, `esta_mue`, `valo_mue`, `coco_grm`, `baci_grm`, `cbac_grm`, `gpos_grm`, `gneg_grm`, `gvar_grm`, `otro_grm`, `qbho_cpr`, `nobs_cpr`, `obse_cpr`, `est_oex2`) 
					VALUES ('$iden_labs', '$num_ord', '901101', '$codig_usu', '$fec', '$fec', '$tpm_alch', '1', 'P', '$tpm_neg1','', '', '', '', '', '', '', '', '', '', '')");
					//echo $con1;
					$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
					VALUES ('$iden_labs','$nord_lab','901101', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
					//echo $eval;  
					mysql_query($eval);
						
				}
				
			//}
			
			//if($chk2_alc==2)
			//{
			
				if($chk_2=='N')
				{
					mysql_query("INSERT INTO `labo_oex2` (`iden_dlab`, `nume_fac`, `cod_exam`, `cod_usua`, `fech_recp`, `fech_entr`, `tipo_mue`, `num_mue`, `esta_mue`, `valo_mue`, `coco_grm`, `baci_grm`, `cbac_grm`, `gpos_grm`, `gneg_grm`, `gvar_grm`, `otro_grm`, `qbho_cpr`, `nobs_cpr`, `obse_cpr`, `est_oex2`) 
					VALUES ('$iden_labs', '$num_ord', '901101', '$codig_usu', '$fec', '$fec', '$tpm_alch', '2', 'N', '$tpm_neg2','', '', '', '', '', '', '', '', '', '', '')");
					//echo "$col";
					$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
					VALUES ('$iden_labs','$nord_lab','901101', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
					//echo $eval;  
					mysql_query($eval);
				}
				if($chk_2=='P')
				{
					
					mysql_query("INSERT INTO `labo_oex2` ( `iden_dlab` , `nume_fac` , `cod_exam` , `cod_usua` , `fech_recp` , `fech_entr` , `tipo_mue` , `num_mue` , `esta_mue` , `valo_mue`,`coco_grm`, `baci_grm`, `cbac_grm`, `gpos_grm`, `gneg_grm`, `gvar_grm`, `otro_grm`, `qbho_cpr`, `nobs_cpr`, `obse_cpr`, `est_oex2`)  
					VALUES ('$iden_labs', '$num_ord', '901101', '$codig_usu', '$fec', '$fec', '$tpm_alch', '2', 'P', '$tpm_neg2','', '', '', '', '', '', '', '', '', '', '')");
					
					$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
					VALUES ('$iden_labs','$nord_lab','901101', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
					//echo $eval;  
					mysql_query($eval);
				
				}
				
			//}
				
					
			//if($chk3_alc==3)
			//{
				if($chk_3=='N')
				{

					mysql_query("INSERT INTO `labo_oex2` ( `iden_dlab` , `nume_fac` , `cod_exam` , `cod_usua` , `fech_recp` , `fech_entr` , `tipo_mue` , `num_mue` , `esta_mue` , `valo_mue` ,`coco_grm`, `baci_grm`, `cbac_grm`, `gpos_grm`, `gneg_grm`, `gvar_grm`, `otro_grm`, `qbho_cpr`, `nobs_cpr`, `obse_cpr`, `est_oex2`)  
					VALUES ('$iden_labs', '$num_ord', '901101', '$codig_usu', '$fec', '$fec', '$tpm_alch', '3', 'N', '$tpm_neg3', '', '', '', '', '', '', '', '', '', '', '')");
					$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
					VALUES ('$iden_labs','$nord_lab','901101', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
					//echo $eval;  
					mysql_query($eval);
				}

				if($chk_3=='P')
				{	
					mysql_query("INSERT INTO `labo_oex2` ( `iden_dlab` , `nume_fac` , `cod_exam` , `cod_usua` , `fech_recp` , `fech_entr` , `tipo_mue` , `num_mue` , `esta_mue` , `valo_mue`,`coco_grm`, `baci_grm`, `cbac_grm`, `gpos_grm`, `gneg_grm`, `gvar_grm`, `otro_grm`, `qbho_cpr`, `nobs_cpr`, `obse_cpr`, `est_oex2`)   
					VALUES ('$iden_labs', '$num_ord', '901101', '$codig_usu', '$fec', '$fec', '$tpm_alch', '3', 'P', '$tpm_neg3', '', '', '', '', '', '', '', '', '', '', '')");
					$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
					VALUES ('$iden_labs','$nord_lab','901101', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
					//echo $eval;  
					mysql_query($eval);
				
				}
				
				
			//}
			echo "<body onload='enviar()'>";	
				
		}
				
	}
	if($format==25)
	{
		if($funct==1)
		{
			echo"<input type=text name='col_mues' value='$col_mues'>";
			echo"<input type=text name='asp_mues' value='$asp_mues'>";
			 if($qui_eth=='on')
                        {
                            $qui_eth=1;
                            echo"<input type=text name='qui_eth' value='1'>";
                        }   
                        if($trz_amb=='on')
                        {
                            $trz_amb=1;
                            echo"<input type=text name='trz_amb' value='1'>";
                        }  
                        if($qui_etmb=='on')
                        {
                            $qui_etmb=1;
                            echo"<input type=text name='qui_etmb' value='1'>";
                        } 
                      
                        if($qui_gins=='on')
                        {
                            $qui_gins=1;
                            echo"<input type=text name='qui_gins' value='1'>";
                        }  
                        if($qui_exna=='on')
                        {
                            $qui_exna=1;
                            echo"<input type=text name='qui_exna' value='1'>";
                        }  
                        
						if($trz_gins=='on')
                        {
                           $trz_gins=1;
                            echo"<input type=text name='trz_gins' value='1'>";
                        }  
                        if($qui_blh=='on')
                        {
                           $qui_blh=1;
                            echo"<input type=text name='qui_blh' value='1'>";
                        } 
                        if($nsp_mues=='on')
                        {
                            $nsp_mues=1;
                            echo"<input type=text name='nsp_mues' value='1'>";
                        }  
			
			
			/*echo"<input type=text name='qui_eth' value='$qui_eth'>";
			echo"<input type=text name='trz_amb' value='$trz_amb'>";
			echo"<input type=text name='qui_etmb' value='$qui_etmb'>";
			echo"<input type=text name='qui_gins' value='$qui_gins'>";
			echo"<input type=text name='qui_exna' value='$qui_exna'>";
			echo"<input type=text name='trz_gins' value='$trz_gins'>";
			echo"<input type=text name='qui_blh' value='$qui_blh'>";
			echo"<input type=text name='otr_pst' value='$otr_pst'>";
			echo"<input type=text name='chk_' value='$chk_'>";
			echo"<input type=text name='nsp_mues' value='$nsp_mues'>";*/
			echo"<input type=text name='obs_mcn' value='$obs_mcn'>";
			
			
			$eva="UPDATE labo_oex2 SET tipo_mue='$col_mues',esta_mue='$asp_mues',valo_mue='$qui_eth',
			coco_grm='$trz_amb', baci_grm='$qui_etmb', cbac_grm='$qui_gins', gpos_grm='$qui_exna', 
			gneg_grm='$trz_gins', gvar_grm='$qui_blh',otro_grm='$otr_pst',qbho_cpr='$chk_',nobs_cpr='$nsp_mues',obse_cpr ='$obs_mcn'
			WHERE iden_dlab='$iden_labs' AND cod_exam='907002'";
			
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','907002', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			
			mysql_query($eva);
			//echo $eva;
			echo "<body onload='enviar2()'>";
		
		}
		else
		{
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
				
			$sql="INSERT INTO `labo_oex2` ( `iden_dlab` , `nume_fac` , `cod_exam` , `cod_usua` , `fech_recp` , `fech_entr` ,`tipo_mue`,`esta_mue`,`valo_mue`, `coco_grm`, `baci_grm`, `cbac_grm`, `gpos_grm`, `gneg_grm`, `gvar_grm`, `otro_grm`, `qbho_cpr`, `nobs_cpr`,`obse_cpr` ) 
					VALUES ('$iden_labs', '$num_ord', '907002', '$codig_usu', '$fec', '$fec', '$col_mues','$asp_mues','$qui_eth', '$trz_amb','$qui_etmb','$qui_gins','$qui_exna','$trz_gins','$qui_blh','$otr_pst','$chk_','$nsp_mues','$obs_mcn')";
			//echo $sql;
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','907002', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			mysql_query($sql);
			
			echo "<body onload='enviar()'>";    
		}
	 
	}
	if($format==26)
	{
		echo "<input type=text name=codig_usu value=$codig_usu>";
		mysql_query("INSERT INTO `labo_oexa` (`iden_loex` ,`iden_dlab` , `num_fac` ,`cod_loex`, `cod_usu` ,
			`fec_recp`,`fec_entr` ,`tsh_oexa` ) 
			VALUES ('','$iden_labs', '$num_ord','904903' ,'$codig_usu', '$fec', '$fec', 'TS')");
			//echo $col;
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','904903', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			echo "<body onload='enviar()'>";
	}
	
	if($format==24)
	{
		if($funct==1)
		{
			echo "<input type=text name='tpm_grm' value='$tpm_grm'>";
			echo "<input type=text name='chk_' value='$chk_'>";
			echo "<input type=text name='coc' value='$coc'>";
			echo "<input type=text name='bac' value='$bac'>";
			echo "<input type=text name='cba' value='$cba'>";
			echo "<input type=text name='gpos' value='$gpos'>";
			echo "<input type=text name='gneg' value='$gneg'>";
			echo "<input type=text name='gvar' value='$gvar'>";
			echo "<input type=text name='ov' value='$ov'>";
			echo "<input type=text name=otrvar  value=$otrvar>";
			$eva=mysql_query("UPDATE labo_oex2 SET tipo_mue='$tpm_grm',esta_mue='$chk_',
			coco_grm='$coc', baci_grm='$bac', cbac_grm='$cbac', gpos_grm='$gpos', gneg_grm='$gneg', gvar_grm='$gvar', otro_grm='$otrvar'
			WHERE iden_dlab='$iden_labs' AND cod_exam='901107'");
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','901107', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
		
			echo "<body onload='enviar2()'>";
		
		}
		else
		{
			echo "<input type=text name='tpm_grm' value='$tpm_grm'>";
			echo "<input type=text name='chk_' value='$chk_'>";
			echo "<input type=text name='coc' value='$coc'>";
			echo "<input type=text name='bac' value='$bac'>";
			echo "<input type=text name='cba' value='$cba'>";
			echo "<input type=text name='gpos' value='$gpos'>";
			echo "<input type=text name='gneg' value='$gneg'>";
			echo "<input type=text name='gvar' value='$gvar'>";
			echo "<input type=text name='ov' value='$ov'>";
			echo "<input type=text name=otrvar  value=$otrvar>";
		
		
			$sql="INSERT INTO `labo_oex2` ( `iden_dlab` , `nume_fac` , `cod_exam` , `cod_usua` , `fech_recp` , `fech_entr` , `tipo_mue`, `esta_mue` ,`coco_grm`, `baci_grm`, `cbac_grm`, `gpos_grm`, `gneg_grm`, `gvar_grm`, `otro_grm` ) 
					VALUES ('$iden_labs', '$num_ord', '901107', '$codig_usu', '$fec', '$fec', '$tpm_grm','$chk_','$coc', '$bac','$cba','$gpos','$gneg','$gvar','$otrvar')";
		
			mysql_query($sql);
			$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','901107', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
			//echo $eval;  
			mysql_query($eval);
			echo "<body onload='enviar()'>";    
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
			VALUES ('','$iden_labs', '$num_ord','E904004' ,'$codig_usu', '$fec', '$fec', 'PN')");
			//echo $col;
			
		echo "<body onload='enviar()'>";
	}
	
	if($format==21)
	{
		for($m=0;$m<$jl;$m++)
		{
	        $nomvar='vchk'.$m;
		    $vchk=$$nomvar;	
			
			if($vchk==1)
			{
				$nomvar='iden_dlab'.$m;
				$iden_dlab=$$nomvar;	
			  
				$nomvar='codigo'.$m;
				$codigo=$$nomvar;
					
				$nomvar='obsv_dlab'.$m;
				$obsv_dlab=$$nomvar;
				
				$nomvar='refe_dlab'.$m;
				$refe_dlab=$$nomvar;
				
				$nomvar='unid_dlab'.$m;
				$unid_dlab=$$nomvar;
					
				$nomvar='remi'.$m;
				$remi=$$nomvar;
				
				if($remi==1)
				{
					$conss="Update detalle_labs SET cod_medi='$Gidusulab',obsv_dlab='$obsv_dlab',refe_dlab='$refe_dlab',unid_dlab='$unid_dlab',estd_dlab ='RE',fech_dlab='$fec',hora_dlab='$hor'  
					WHERE iden_dlab='$iden_dlab'";
					mysql_query($conss);
					$eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
					VALUES ('$iden_labs','$nord_lab','$codigo', '$fec', '$hor', '$codig_usu', 'CR', 'Modificado a la BD - Formato Otro examenes LaboSangre', '$Gidusulab')";	
					//echo $eval;  
					mysql_query($eval);
				}
				
				else
				{
					$conss="Update detalle_labs SET cod_medi='$Gidusulab',obsv_dlab='$obsv_dlab',refe_dlab='$refe_dlab',unid_dlab='$unid_dlab' ,estd_dlab ='CU',fech_dlab='$fec',hora_dlab='$hor'
					WHERE iden_dlab='$iden_dlab'";
					//echo $conss;
					mysql_query($conss);
					
				}
				
				$prueba="INSERT INTO vitac_orden ( iden_vord ,iden_labs,iden_evo,nord_lab,cup_vord , fech_vord , hora_vord , codu_vord , eord_vord , dato_vord , resp_vord) 
				VALUES ('', '$iden_labs','$iden_dlab','$nord_lab', '$codigo', '$fec', '$hor', '$codig_usu', 'CR', '$obsv_dlab', '$Gidusulab')";
				mysql_query($prueba);
				
				//echo '<br>'.$conss.'<br>';
			}
		}			  
		echo "<body onload='enviar2()'>";
	}
?>

</form>
</body>
</html>
