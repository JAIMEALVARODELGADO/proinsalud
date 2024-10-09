<?
	session_register('paciente');
	session_register('Gcod_mediconh');	
	session_register('Gareanh'); 
	session_register('Gcontratonh');
	session_register('numcita');
?>
<html>
<head>	
</head>
<?
	$fecjus=date('Y-m-d');		
	$hora=date('H:i:s');		
	echo"<form>";
	for($n=0;$n<$fin-1;$n++)
	{
		$nomvar='diagnos'.$n;
		$diagnos=$$nomvar;
		$nomvar='codproducto'.$n;
		$codproducto=$$nomvar;
		$nomvar='diastrasoli'.$n;
		$diastrasoli=$$nomvar;
		$nomvar='dosissoli'.$n;
		$dosissoli=$$nomvar;
		$nomvar='cproa'.$n;
		$cproa=$$nomvar;
		$nomvar='diastraequia'.$n;
		$diastraequia=$$nomvar;			
		$nomvar='dosisequia'.$n;
		$dosisequia=$$nomvar;
		$nomvar='cprob'.$n;
		$cprob=$$nomvar;
		$nomvar='diastraequib'.$n;
		$diastraequib=$$nomvar;			
		$nomvar='dosisequib'.$n;
		$dosisequib=$$nomvar;
		$nomvar='fecdesdea'.$n;
		$fecdesde=$$nomvar;
		$nomvar='fechasta'.$n;
		$fechasta=$$nomvar;
		$nomvar='tiempoesti'.$n;
		$tiempoesti=$$nomvar;
		$nomvar='resumen'.$n;
		$resumen=$$nomvar;
		$nomvar='riesgo'.$n;
		$riesgo=$$nomvar;
		$nomvar='tiponopos'.$n;
		$tiponopos=$$nomvar;
		$cad5=mysql_query("INSERT INTO `form_nop` ( `iden_nop` , `iden_med` ,`cod_medico`, `codi_usu` , `fech_pos` , `cod_cie10` , `dosi_nop`, `cmed_nop` , `tiem_nop` , `ries_nop`,
		`fdes_nop`, `fhas_nop`, `ties_nop`, `resu_nop`, `just_nop`, `tihi_nop`, `tinp_nop`)
		VALUES ('0', '$numhisto', '$Gcod_mediconh', '$paciente', '$fecjus', '$diagnos', '$dosissoli', '$codproducto', '$diastrasoli', '$riesgo', 
		'$fecdesde','$fechasta','$tiempoesti','$resumen','$analisis','A','$tiponopos')");
		$idennop=mysql_insert_id();		
		if(trim($principio1)!='')
		{
			$cad6=mysql_query("INSERT INTO `deta_pos` ( `iden_pos` , `iden_pos`, `cpro_nop` , `papo_pos` , `pspo_pos` , `prpo_pos` , `dopo_pos` , `capo_pos` , `tepo_pos` , `rcpp_pos` )
			VALUES ('', '$idennop', '$cproa', '$principio1', '$posologia1', '$presen1', '$dosisequia', '$canti1', '$diastraequia', '$resp1')");				
		}
		if(trim($principio1)!='')			
		{
			$cad7=mysql_query("INSERT INTO `deta_pos` ( `iden_pos` , `iden_nop` , `cpro_nop` , `papo_pos` , `pspo_pos` , `prpo_pos` , `dopo_pos` , `capo_pos` , `tepo_pos` , `rcpp_pos` )
			VALUES ('', '$idennop', '$idennop', '$cprob', '$principio2', '$posologia2', '$dosisequib', '$dosi2', '$canti2', '$diastraequib', '$resp2')");
		}				
	}			
	echo"</form>";
?>
</html>

