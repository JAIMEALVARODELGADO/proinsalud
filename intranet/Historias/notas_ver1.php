<?
session_register('ingreso');
session_register('codusu');
session_register('Gideusu');
session_register('Gcod_medico');


?>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" type="text/css"/>
	<script languaje=javascript>
	function valida(id,val)
	{
		uno.reg.value=id;
		uno.iden.value=val;
		uno.target='';
		uno.action='notas_ver1.php';
		uno.submit();
	}
	
	</script>
	<script language="JavaScript" src="overlib_mini.js"></script>
</head>

<body bgcolor='#CCCCCC'>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<?
	set_time_limit(0);
	if($iden==1)$concepto='OBSERVACIONES GENERALES';
	if($iden==2)$concepto='PROCEDIMIENTOS';
	if($iden==3)$concepto='DISPOSITIVOS';
	if($iden==4)$concepto='SIGNOS VITALES';
	$fechaevo=date('Y-m-d');		
	$horaevo=date('H:i:s');		
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);
	
	echo"<div id='nav2'>";
	
	if($iden==1)
	{
		$cadO="SELECT notas_detalle.iden_not, notas_detalle.iddn_not, notas_encabe.fech_not, notas_encabe.hora_not, notas_detalle.obse_not, notas_detalle.clas_not, notas_encabe.usua_not
		FROM notas_detalle INNER JOIN notas_encabe ON notas_detalle.iden_not = notas_encabe.iden_not
		WHERE (((notas_detalle.iden_not)='$reg') AND ((notas_detalle.clas_not)='O'))";
		$resulO=Mysql_query($cadO,$link);
		
		echo"<br><table align=center width=100%>			
		<tr><td class='Th0'><b>Observaciones generales</td></tr>
		</table>
		<br><br>
		<table width=100% align=center  class='tbl2'>
		<tr><td align=center><b>Fecha</td>
		<td align=center><b>Hora</td>
		<td align=center><b>Responsable</td>
		<td align=center><b>Descripcion</td>			
		</tr>";
		
		while($rowO=mysql_fetch_array($resulO))
		{
			$fechaO=$rowO['fech_not'];	
			$empleO=$rowO['usua_not'];	
			$horaO=$rowO['hora_not'];
			$obseO=$rowO['obse_not'];
			Mysql_select_db('general',$link);
			$nemp=mysql_query("select nomb_usua from cut where ide_usua = '$empleO'");
			$remp=mysql_fetch_array($nemp);
			$nomemp=$remp['nomb_usua'];
			echo"
			<tr><td class='Td0' height=20 width=12%>$fechaO</td>
			<td class='Td0' width=12%>$horaO</td>
			<td class='Td0' width=20%>$nomemp</td>			
			<td class='Td0'><p>$obseO</p></td>
			</tr>";
		}
		echo"</table>";	
	}
	
	
	
	
	if($iden==2)
	{
		$cadD="SELECT notas_encabe.fech_not, notas_encabe.hora_not, encab_proc.iden_ser, notas_encabe.usua_not, encab_proc.iden_enp
		FROM (notas_detalle INNER JOIN notas_encabe ON notas_detalle.iden_not = notas_encabe.iden_not) INNER JOIN encab_proc ON notas_detalle.iddn_not = encab_proc.iden_var
		WHERE (((notas_detalle.iden_not)='$reg') AND ((notas_detalle.clas_not)='P'))";		
		$resulD=Mysql_query($cadD,$link);
		echo"<table width=100% align=center  class='tbl2'>";
		while($rowD=mysql_fetch_array($resulD))
		{
			$fechaD=$rowD['fech_not'];	
			$horaD=$rowD['hora_not'];
			$procedD=$rowD['iden_ser'];	
			$usuaD=$rowD['usua_not'];	
			$regisD=$rowD['iden_enp'];	
			echo"<tr><td align=center><b>Fecha</td>
			<td align=center><b>Hora</td>
			<td align=center><b>procedimiento</td>
			<td align=center><b>Responsable</td>	
			<tr>";
			
			Mysql_select_db('general',$link);
			$cad3="select * from cut where ide_usua ='$usuaD'";
			$res3=Mysql_query($cad3,$link);
			while($rowemp=mysql_fetch_array($res3))
			{
				$nomusua=$rowemp['nomb_usua'];
			}
			Mysql_select_db('proinsalud',$link);
			$cad4="select * from cups where codigo ='$procedD'";
			$res4=Mysql_query($cad4,$link);
			while($rowemp4=mysql_fetch_array($res4))
			{
				$nomproced=$rowemp4['descrip'];
			}
			Mysql_select_db('general',$link);
			$nemp=mysql_query("select nomb_usua from cut where ide_usua = '$usuaD'");
			$remp=mysql_fetch_array($nemp);
			$nomemp=$remp['nomb_usua'];
			Mysql_select_db('proinsalud',$link);

			echo"<tr><td class='Td0' width=80><b>$fechaD</td>
			<td class='Td0'><b>$horaD</td>
			<td class='Td0'><b>$nomproced</td>
			<td class='Td0'><b>$nomemp</td>	
			<tr>";			

			$cad5="SELECT encab_proc.iden_enp, detalle_proced.codi_ins, detalle_proced.cant_dpr
			FROM encab_proc INNER JOIN detalle_proced ON encab_proc.iden_enp = detalle_proced.iden_enp
			WHERE (((encab_proc.iden_enp)='$regisD'))";
			$resul5=Mysql_query($cad5,$link);
			$numres=Mysql_num_rows($resul5);
			if($numres>0)
			{	
			    echo"<tr><td class='Th0' width=80><b></td>
				<td class='Th0'><b></td>				
				<td class='Th0'><b>dispositivo</td>
				<td class='Th0'><b>Cantidad solicitada</td><tr>";
				while($rowdis=mysql_fetch_array($resul5))
				{
					$dispo=$rowdis['codi_ins'];
					$canti=$rowdis['cant_dpr'];
					$busca1="select nomb_mdi from medicamentos2 where codi_mdi='$dispo'";
					$resbusca1=Mysql_query($busca1,$link);
					while($rowbus=mysql_fetch_array($resbusca1))
					{
						$desmed=$rowbus['nomb_mdi'];
					}
					$busca2="select desc_ins from insu_med where codi_ins='$dispo'";
					$resbusca2=Mysql_query($busca2,$link);
					while($rowbus2=mysql_fetch_array($resbusca2))
					{
						$desmed=$rowbus2['desc_ins'];
					}						
					echo"<tr>					
					<td></td>
					<td></td>
					<td class='Td0'>$desmed</td>
					<td class='Td0'>$canti</td>
					</tr>";
				}				
				
			}
			echo"<tr><td colspan=5 class='Td2'><hr size='1'></td></tr>";
		
		}
		echo"</table>";
	}
			
		
		
		
		
	if($iden==3)
	{	
		$cadM="SELECT notas_detalle.iden_not, notas_detalle.iddn_not, notas_encabe.fech_not, notas_encabe.hora_not, notas_encabe.usua_not, notas_detalle.clas_not, notas_encabe.usua_not, movi_ins.codi_ins, movi_ins.caso_mov
		FROM (notas_detalle INNER JOIN notas_encabe ON notas_detalle.iden_not = notas_encabe.iden_not) INNER JOIN movi_ins ON notas_detalle.iddn_not = movi_ins.idor_med
		WHERE (((notas_detalle.iden_not)='$reg') AND ((notas_detalle.clas_not)='M'))";
		$resulM=Mysql_query($cadM,$link);
		echo"<br><table align=center width=100%>			
		<tr><td class='Th0'><b>Dispositivos</td></tr>
		</table>
		<br><br>
		<table width=100% align=center  class='tbl2'>
		<tr><td align=center height=20><b>Fecha</td>
		<td align=center><b>Hora</td>
		<td align=center><b>Insumo</td>	
		<td align=center><b>Cantidad</td>	
		<td align=center><b>Responsable</td>			
		</tr>";
		
		
		while($rowM=mysql_fetch_array($resulM))
		{
			$fechaD=$rowM['fech_not'];	
			$horaD=$rowM['hora_not'];		
			$insumoD=$rowM['codi_ins'];
			$cantiD=$rowM['caso_mov'];
			$usuaD=$rowM['usua_not'];
			$busca1="select nomb_mdi from medicamentos2 where codi_mdi='$insumoD'";
			$resbusca1=Mysql_query($busca1,$link);
			while($rowbus=mysql_fetch_array($resbusca1))
			{
				$desmed=$rowbus['nomb_mdi'];
			}
			$busca2="select desc_ins from insu_med where codi_ins='$insumoD'";
			$resbusca2=Mysql_query($busca2,$link);
			while($rowbus2=mysql_fetch_array($resbusca2))
			{
				$desmed=$rowbus2['desc_ins'];
			}

			Mysql_select_db('general',$link);
			$nemp=mysql_query("select nomb_usua from cut where ide_usua = '$usuaD'");
			$remp=mysql_fetch_array($nemp);
			$nomemp=$remp['nomb_usua'];
			Mysql_select_db('proinsalud',$link);
			
			echo"
			
			
			
			<tr><td class='Td0' height=25>$fechaD</td>
			<td class='Td0'>$horaD</td>
			<td class='Td0'>$desmed</td>	
			<td class='Td0'>$cantiD</td>	
			<td class='Td0'>$nomemp</td>			
			</tr>";
		}		
	}
	
	if($iden==4)
	{	
		$cadM="SELECT notas_encabe.iden_not, signos_vitales.fech_sig, signos_vitales.hora_sig, signos_vitales.pami_sig, signos_vitales.pama_sig,
		signos_vitales.resp_sig, signos_vitales.puls_sig, signos_vitales.temp_sig, signos_vitales.fcfe_sig,signos_vitales.glpr_sig,
		signos_vitales.glpo_sig,signos_vitales.oxco_sig,signos_vitales.oxso_sig,signos_vitales.empl_sig
		
		FROM (notas_detalle INNER JOIN notas_encabe ON notas_detalle.iden_not = notas_encabe.iden_not) INNER JOIN signos_vitales ON notas_detalle.iddn_not = signos_vitales.iddn_not
		WHERE (((notas_encabe.iden_not)='$reg'))";
	
		$resulM=Mysql_query($cadM,$link);
		echo"<br><table align=center width=100%>			
		<tr><td class='Th0'><b>Registro de signos vitales</td></tr>
		</table>
		<br><br>
		<table width=100% align=center  class='tbl2'>
		<tr><td align=center  height=20><font size=1><b>FECHA</td>
		<td align=center><font size=1><b>HORA</td>		
		<td align=center><font size=1><b>PRES ARTERI	AL</td>
		<td align=center><font size=1><b>RESPIRAC.</td>
		<td align=center><font size=1><b>PULSO</td>
		<td align=center><font size=1><b>TEMPER.</td>
		<td align=center><font size=1><b>F. C. F.</td>
		<td align=center><font size=1><b>GLUC PREP</td>
		<td align=center><font size=1><b>GLUC POSP</td>
		<td align=center><font size=1><b>OXIM CON O2</td>
		<td align=center><font size=1><b>OXIM SIN O2</td>
		<td align=center><font size=1><b>RESPONSABLE</td>
		
		</tr>";
		
		while($rowO=mysql_fetch_array($resulM))
		{
			$fecha=$rowO['fech_sig'];	
			$hora=$rowO['hora_sig'];
			$prearba=$rowO['pami_sig'];
			$prearal=$rowO['pama_sig'];
			$respi=$rowO['resp_sig'];
			$pulso=$rowO['puls_sig'];
			$tempe=$rowO['temp_sig'];
			$frecu=$rowO['fcfe_sig'];			
			$glpre=$rowO['glpr_sig'];
			$glpos=$rowO['glpo_sig'];
			$oxcono=$rowO['oxco_sig'];
			$oxsino=$rowO['oxso_sig'];			
			$emple=$rowO['empl_sig'];
			
			Mysql_select_db('general',$link);
			$nemp=mysql_query("select nomb_usua from cut where ide_usua = '$emple'");
			$remp=mysql_fetch_array($nemp);
			$nomemp=$remp['nomb_usua'];
			Mysql_select_db('proinsalud',$link);
			
			echo"
			<tr><td class='Td0' align=center  height=25>$fecha</td>
			<td class='Td0' align=center>$hora</td>			
			<td class='Td0' align=center>$prearba // $prearal</td>
			<td class='Td0' align=center>$respi</td>			
			<td class='Td0' align=center>$pulso</td>
			<td class='Td0' align=center>$tempe</td>			
			<td class='Td0' align=center>$frecu</td>			
			<td class='Td0' align=center>$glpre</td>
			<td class='Td0' align=center>$glpos</td>
			<td class='Td0' align=center>$oxcono</td>
			<td class='Td0' align=center>$oxsino</td>			
			<td class='Td0' align=center>$nomemp</td>
			</tr>";
		}
		echo"</table>";	
	}
	
	echo"<br><br>
	
	<center><a href='notas_ver.php?cedula=$cedula' target='' ><img src='img/feed_go.png' width=20 title='Regresar'><br><br><b>Regresar</a></center>
	
	";
	
	echo"</div>";
	
?>
</body>
</html>

