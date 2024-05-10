<?php	

	session_register('paciente');
	session_register('concontrol');
	session_register('Gcod_mediconh');
	
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="JavaScript">
	function valida()
	{		
		document.getElementById("regre").style.visibility="visible";
		uno.valregre.value='LP';
		uno.target='';
		uno.action='regresa.php';
		uno.submit();		
		uno.codusu.value=''
		uno.target='menu';
		uno.action='blanco.php';
		uno.submit();
		uno.target='titulo';
		uno.action='titulo.php';
		uno.submit();
		if(uno.tipoanes.value==1)
		{
			uno.action='impre_histoanest1.php';
			uno.target='TOP';
			uno.submit();
		}
		else	
		{
			if(uno.concontrol.value==1)
			{		
				uno.action='impre_histo.php';
				uno.target='TOP';
				uno.submit();
			}
			else
			{
				uno.action='impre_histo_espe.php';
				uno.target='TOP';
				uno.submit();
			}
		}
	}
	function ver()
	{
//Se habilita en caso de error		
		if(uno.ima.checked==true ||  uno.lab.checked==true || uno.rem.checked==true || uno.med.checked==true || uno.his.checked==true || uno.forpos.checked==true || uno.solqui.checked==true || uno.inca.checked==true ||uno.reco.checked==true ||uno.anexo.checked==true)
		{
			document.getElementById("vista").style.visibility="visible";			
		}
		else
		{
			document.getElementById("vista").style.visibility="hidden";				
		}
// fin habilita


//cambio microbinaos
/*		
		if(uno.ima.checked==true ||  uno.lab.checked==true || uno.rem.checked==true || uno.med.checked==true || uno.his.checked==true || uno.forpos.checked==true || uno.solqui.checked==true || uno.inca.checked==true ||uno.reco.checked==true ||uno.anexo.checked==true ||uno.medMicro.checked==true)
		{
			document.getElementById("vista").style.visibility="visible";			
		}
		else
		{
			document.getElementById("vista").style.visibility="hidden";				
		}
*/		
//Fin cambio microbianos

		
		
	}
	function lista()
	{
		uno.valregre.value='LP';
		uno.target='';
		uno.action='regresa.php';
		uno.submit();	
	}	
</script>
</head>	
<body >
<?php	
	$paciente='';
	error_reporting(E_ERROR | E_PARSE);
	//ECHO $numhisto;
	echo"<form name=uno method=post>
	 <input type=hidden name=valregre>
	 <input type=hidden name=codusu>
	<input type=hidden name=numhisto value='$numhisto'>	
	<input type=hidden name=marca>";	
	include ('php/conexion1.php');	
	//192.168.4.12/intraweb/intranet/consulta_ambulatoria/impre_histo0.php
	
	//$numhisto='16011451220227204727';
	
	$cadcro4="SELECT id_anes FROM anteced_aneste WHERE numcon_anes='$numhisto'";
	$resulcro4=Mysql_query($cadcro4);
	$numcro4=Mysql_num_rows($resulcro4);
	
	if($numcro4>0)
	{	
		$tipoanes='1';
		$cadcro14="SELECT concent_ccl FROM preanes_conclusion WHERE numero_cons='$numhisto'";
		$resulcro14=Mysql_query($cadcro14);
		while($rcontpre1=mysql_fetch_array($resulcro14))
		{
			$sigenconsinfo=$rcontpre1['concent_ccl'];
		}
		if($sigenconsinfo=='S')
		{
			$apareconinf=1;
		}
		else
		{
			$apareconinf=0;
		}	
	}
	else
	{
		$tipoanes='0';
	}

	echo"<input type=hidden name=tipoanes value='$tipoanes'>";
		
	
	
	$bcontrol=mysql_query("select * from consultaprincipal where numc_cpl='$numhisto'");
	while($rcont=mysql_fetch_array($bcontrol))
	{
		$ticon=$rcont['codi_cpl'];
		$incapa=$rcont['inca_cpl'];
		
	}
	$breco=mysql_query("select * from encabesadoformula where numc_efo='$numhisto'");
	while($rreco=mysql_fetch_array($breco))
	{
		$recom=$rreco['obfo_efo'];
		
	}
	
	$banexo="SELECT consultaprincipal.numc_cpl, refer_at910.servorig_rat
	FROM consultaprincipal INNER JOIN refer_at910 ON consultaprincipal.iden_cpl = refer_at910.idenorig_rat
	WHERE (((consultaprincipal.numc_cpl)='$numhisto') AND ((refer_at910.servorig_rat)='CE'))";
	$banexo=mysql_query($banexo);
	if(mysql_num_rows($banexo)<>0){
		$ranexo=mysql_fetch_array($banexo);
		$servorig_rat=$ranexo[servorig_rat];		
	}


	$besp=mysql_query("SELECT medicos.cod_medi, destipos.nomb_des, destipos.homo3_des
	FROM medicos INNER JOIN destipos ON medicos.espe_med = destipos.codi_des
	WHERE (((medicos.cod_medi)='$Gcod_mediconh'))");
	$nesp=mysql_fetch_array($besp);
	$tiespe=$nesp['homo3_des'];
	if($tiespe=='2' && $ticon=='2')$con='2';
	else $con='1';		

	
	echo"<input type=hidden name=concontrol value='$con'>";
	$bima=mysql_query("SELECT cups.codigo, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre
	FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
	WHERE detareferencia.numc_dre='$numhisto' AND  (cups.grup_cup='87' Or cups.grup_cup='88')");
	if(mysql_num_rows($bima)>0)$numima='SI';	
	
	
	$blab=mysql_query("SELECT cups.codigo, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre
	FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
	WHERE (((cups.grup_cup)='90') AND ((detareferencia.numc_dre)='$numhisto'))");	
	if(mysql_num_rows($blab)>0)$numlab='SI';

//Antimicrobianos	
/*
	$blabMicro=mysql_query("SELECT id_micro FROM antimicrobianos WHERE numc_ehi='$numhisto'");	
	if(mysql_num_rows($blabMicro)>0)$numlabMicro='SI';
*/
//fin antimicrobianos
	
	
	$brem=mysql_query("SELECT cups.codigo, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre
	FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
	WHERE (((cups.grup_cup)<>'87' And (cups.grup_cup)<>'88' And (cups.grup_cup)<>'90') AND ((detareferencia.numc_dre)='$numhisto'))");
	if(mysql_num_rows($brem)>0)$numrem='SI';	
	
	
	$brem1=mysql_query("SELECT destipos.codi_des, destipos.nomb_des, detareferencia.numc_dre, detareferencia.cant_dre, detareferencia.ccie_dre, detareferencia.obsv_dre
	FROM destipos INNER JOIN detareferencia ON destipos.codi_des = detareferencia.codi_dre
	WHERE (((detareferencia.numc_dre)='$numhisto'))");	
	
	if(mysql_num_rows($brem1)>0)$numrem='SI';		
	$bmed=mysql_query("select * from medicamentosenv where numc_men='$numhisto'");
	
	
	if(mysql_num_rows($bmed)>0)$nummed='SI';
	
	$bpos=mysql_query("select * from form_nop where iden_med  ='$numhisto'");
	if(mysql_num_rows($bpos)>0)$numpos='SI';
	
	$bsq=mysql_query("select * from solicitud_quirofano where nhis_solquiro='$numhisto'");
	if(mysql_num_rows($bsq)>0)$numsolquiru='SI';
	
	$bin=mysql_query("select * from incapacidades where numc_his='$numhisto'");
	$numsolinca='';	
	$desin='';
	while($rin=mysql_fetch_array($bin))
	{
		if($rin['tformato_inca']=='O')
		{
			$numsolinca='SI';
			$desin='';
		}
		if($rin['tformato_inca']=='D')
		{
			$numsolinca='SI';
			$desin='';
		}
	}
	$impre=0;
	echo"<table align=center class='tbl' width=70%>
	<tr>
	<th colspan=2 align=center valign=top height=30>IMPRIMIR</th>
	</tr>";	
	if($numima=="SI")
	{
		echo"<tr>
		<th>IMAGENOLOGIA</th>		
		<td><input type=checkbox name='ima' onclick='ver()' value=1></td>
		</tr>";	
	}
	else
	{
		echo"<tr>
		<th>IMAGENOLOGIA</th>		
		<td><input type=checkbox name='ima' onclick='ver()' disabled value=1></td>
		</tr>";	
	}
	if($numlab=="SI")
	{
		echo"<tr>
		<th>LABORATORIOS</th>
		<td><input type=checkbox name='lab' onclick='ver()' value=1></td>
		</tr>";	
	}
	else
	{
		echo"<tr>
		<th>LABORATORIOS</th>
			<td><input type=checkbox name='lab' onclick='ver()' disabled value=1></td>
		</tr>";	
	}
	if($numrem=="SI")
	{
		echo"<tr>
		<th>OTRAS ORDENES</th>
		<td><input type=checkbox name='rem' onclick='ver()' value=1></td>
		</tr>";	
	}
	else
	{
		echo"<tr>
		<th>OTRAS ORDENES</th>
		<td><input type=checkbox name='rem' onclick='ver()' disabled value=1></td>
		</tr>";	
	}
	if($nummed=="SI")
	{
		echo"<tr>
		<th>MEDICAMENTOS</th>
		<td><input type=checkbox name='med' onclick='ver()' value=1></td>
		</tr>";	
	}	
	else
	{
		echo"<tr>
		<th>MEDICAMENTOS</th>
		<td><input type=checkbox name='med' onclick='ver()' disabled value=1></td>
		</tr>";	
	}
	
	
// Anexo de Antimicrobianos	
/*
	if($numlabMicro=="SI")
	{
		echo"<tr>
		<th>JUSTIFICACION MEDICAMENTOS ANTIMICROBIANOS</th>
		<td><input type=checkbox name='medMicro' onclick='ver()' value=1></td>
		</tr>";	
	}	
	else
	{
		echo"<tr>
		<th>JUSTIFICACION MEDICAMENTOS ANTIMICROBIANOS</th>
		<td><input type=checkbox name='medMicro' onclick='ver()' disabled value=1></td>
		</tr>";	
	}
*/	
//Fin Antimicrobianos	

	
	if($numpos=="SI")
	{
		echo"<tr>
		<th>JUSTIFICACIONES</th>
		<td><input type=checkbox name='forpos' onclick='ver()' value=1></td>
		</tr>";	
	}	
	else
	{
		echo"<tr>
		<th>JUSTIFICACIONES</th>
		<td><input type=checkbox name='forpos' onclick='ver()' disabled value=1></td>
		</tr>";	
	}	
	if($numsolquiru=="SI")
	{
		echo '2 '.$numsolquiru;
		echo"<tr>
		<th>SOLICITUD DE QUIROFANO</th>
		<td><input type=checkbox name='solqui' onclick='ver()' value=1></td>
		</tr>";	
	 }
	else
	{
		//echo '2 '.$numsolquiru;
		echo"<tr>
		<th>SOLICITUD DE QUIROFANO</th>		
		<td><input type=checkbox name='solqui' onclick='ver()' disabled value=1></td>
		</tr>";	
	}	
	if($numsolinca=='SI')
	{
		echo"<tr>
		<th>INCAPACIDAD</th>
		<td><input type=checkbox name='inca' onclick='ver()' value=1></td>
		</tr>";	
	}
	else
	{
		echo"<tr>
		<th>INCAPACIDAD $desin</th>
		<td><input type=checkbox name='inca' onclick='ver()' disabled value=1></td>
		</tr>";	
	}
	if($recom!="")
	{
		echo"<tr>
		<th>RECOMENDACIONES</th>
		<td><input type=checkbox name='reco' onclick='ver()' value=1></td>
		</tr>";	
	}
	else
	{
		echo"<tr>
		<th>RECOMENDACIONES</th>
		<td><input type=checkbox name='reco' onclick='ver()' disabled value=1></td>
		</tr>";	
	}	
	if(!empty($servorig_rat)){
		echo"<tr>
		<th>ANEXO TECNIO 9/10</th>
		<td><input type=checkbox name='anexo' onclick='ver()' value=1></td>
		</tr>";	
	}
	else{
		echo"<tr>
		<th>ANEXO TECNIO 9/10</th>
		<td><input type=checkbox name='anexo' onclick='ver()' disabled value=1></td>
		</tr>";		
	}	
		
	if($apareconinf=='1')
	{	
		echo"<tr>
		<th>CONSETIMIENTO INFORMADO ANESTESIOLOGIA</th>
		<td><input type=checkbox name='conseinfanes' onclick='ver()' value=1></td>
		</tr>";	
	}
	else
	{
		echo"<tr>
		<th>CONSETIMIENTO INFORMADO ANESTESIOLOGIA</th>
		<td><input type=checkbox name='conseinfanes' onclick='ver()' disabled value=1></td>
		</tr>";		
	}
	echo"<tr>
	<th>HISTORIA</th>
	<td><input type=checkbox name='his' onclick='ver()' value=1></td>
	</tr>
	<table>
	<table align=center class='tbl' width=70% id='vista' style='visibility:hidden;'>
	<tr>
	<th align=center valign=top height=30><a><INPUT type=button class='boton' value=IMPRIMIR onClick='valida();'></th>
	</tr>";		
	echo"</table>";
	echo"<table align=center class='tbl' width=70% id='regre' style='visibility:hidden;'>";
	echo"<tr>
	<th align=center valign=top height=30><a><INPUT type=button class='boton' value='LISTADO DE PACIENTES' onClick='lista();'></th>";
	echo"</tr>
	</table>	
	</form>";
	
	
?>
</body>
</html>












