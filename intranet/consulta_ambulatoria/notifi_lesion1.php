<?
	session_register('paciente');	
	session_register('Gcod_mediconh');
	session_register('numcita');	
?>
<html>
<head>
<script language="JavaScript">
function salir()
{
	uno.target='';
	uno.action='guardahisto.php';
	uno.submit()
}
</script>
</head>
<body onload='salir()'>
<?
	$archivo0='tmp/0HC'.$paciente.'.txt';		
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
		unlink ($archivo0);
	}	
	
	
	echo "<form name=uno method=post>";
	$sitiosi='';
	for($i=1;$i<=12;$i++)
	{		
		$sit='sitio'.$i;
		$sitio=$$sit;
		if($sitio!='')
		{			
			$sitiosi=$sitiosi.$sitio.',';
		}	
	}
	$natusi='';
	for($i=1;$i<=11;$i++)
	{		
		$nat='natu'.$i;
		$natu=$$nat;
		if($natu!='')
		{			
			$natusi=$natusi.$natu.',';
		}	
	}	
	include ('php/conexion1.php');
	$cadpac=mysql_query("INSERT INTO `notifica_lesion` ( `iden_not` , `nhis_not` , `desp_not` , `disc_not` , `gret_not` , `depa_not` , `muni_not` , `barr_not` , `dire_not` , `tele_not` , `fech_not` , `hora_not` , `remi_not` , `inte_not` , `luga_not` , `olug_not` , `acti_not` , `oact_not` , `meca_not` , `omec_not` , `alco_not` , `drog_not` , `quem_not` , `porc_not` , `titr_not` , `copa_not` , `usua_not` , `ousu_not` , `elem_not` , `cint_not` , `camo_not` , `cabi_not` , `chal_not` , `otle_not` , `ootl_not` , `ante_not` , `rela_not` , `orel_not` , `cont_not` , `sexo_not` , `inpr_not` , `antr_not` , `fapr_not` , `ofap_not` , `siti_not` , `osit_not` , `natu_not` , `onat_not` , `tima_not` , `tiag_not` , `otia_not` , `dest_not` , `odes_not` ) 
	VALUES ('0', '$numhisto', '$desplazado', '$discapacitado', '$grupoetnico', '$depar', '$municipio', '$barrio', '$direccion', '$telefono', '$fechaven', '$hora', '$remitido', '$intencionalidad', '$lugar_evento', '$otros1', '$actividad', '$otros2', '$mecanismo', '$otros3', '$alcohol', '$drogas', '$quemado', '$porce', '$tipotrans', '$contrapar', '$usuario', '$otros4', '$elementos', '$cinturon', '$cascomoto', '$cascobici', '$chaleco', '$otroelem', '$otros5', '$antecede', '$relacion', '$otros6', '$contexto', '$sexoagre', '$intentopre', '$antetrans', '$factopreci', '$otros7', '$sitiosi', '$otros8', '$natusi', '$otros9', '$tipomaltrato', '$tipoagresor', '$otros10', '$destino', '$otros11')");
	
	echo "INSERT INTO `notifica_lesion` ( `iden_not` , `nhis_not` , `desp_not` , `disc_not` , `gret_not` , `depa_not` , `muni_not` , `barr_not` , `dire_not` , `tele_not` , `fech_not` , `hora_not` , `remi_not` , `inte_not` , `luga_not` , `olug_not` , `acti_not` , `oact_not` , `meca_not` , `omec_not` , `alco_not` , `drog_not` , `quem_not` , `porc_not` , `titr_not` , `copa_not` , `usua_not` , `ousu_not` , `elem_not` , `cint_not` , `camo_not` , `cabi_not` , `chal_not` , `otle_not` , `ootl_not` , `ante_not` , `rela_not` , `orel_not` , `cont_not` , `sexo_not` , `inpr_not` , `antr_not` , `fapr_not` , `ofap_not` , `siti_not` , `osit_not` , `natu_not` , `onat_not` , `tima_not` , `tiag_not` , `otia_not` , `dest_not` , `odes_not` ) 
	VALUES ('0', '$numhisto', '$desplazado', '$discapacitado', '$grupoetnico', '$depar', '$municipio', '$barrio', '$direccion', '$telefono', '$fechaven', '$hora', '$remitido', '$intencionalidad', '$lugar_evento', '$otros1', '$actividad', '$otros2', '$mecanismo', '$otros3', '$alcohol', '$drogas', '$quemado', '$porce', '$tipotrans', '$contrapar', '$usuario', '$otros4', '$elementos', '$cinturon', '$cascomoto', '$cascobici', '$chaleco', '$otroelem', '$otros5', '$antecede', '$relacion', '$otros6', '$contexto', '$sexoagre', '$intentopre', '$antetrans', '$factopreci', '$otros7', '$sitiosi', '$otros8', '$natusi', '$otros9', '$tipomaltrato', '$tipoagresor', '$otros10', '$destino', '$otros11')";
	
	echo"<form>";	
?>
</body>
</html>