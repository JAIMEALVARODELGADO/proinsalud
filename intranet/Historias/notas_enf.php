<?
//session_register('id_ing');
//session_register('Gcod_medico');
?>
<html>
<head>
	
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
	
</head>

<body bgcolor='#FFFFFF'>

<?
	set_time_limit (500);
	$fechaevo=date('Y-m-d');		
	$horaevo=date('H:i:s');		
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);

	/*$cadesta="SELECT notas_encabe.iden_not, notas_encabe.fech_not, notas_encabe.hora_not, notas_encabe.usua_not, notas_encabe.id_ing, notas_encabe.fech_not
	FROM (usuario INNER JOIN notas_encabe ON usuario.CODI_USU = notas_encabe.codi_usu) INNER JOIN notas_detalle ON notas_encabe.iden_not = notas_detalle.iden_not
	WHERE (((usuario.NROD_USU)='$cedula'))
	GROUP BY notas_encabe.iden_not, notas_encabe.fech_not, notas_encabe.hora_not, notas_encabe.usua_not, notas_encabe.id_ing, notas_detalle.clas_not, notas_encabe.fech_not
	HAVING (((notas_detalle.clas_not)='$selec') AND ((notas_encabe.fech_not)>='$fechai' And (notas_encabe.fech_not)<='$fechaf'))
	ORDER BY notas_encabe.iden_not DESC";*/
	
	$cadesta="SELECT notas_encabe.iden_not, notas_encabe.fech_not, notas_encabe.hora_not, notas_encabe.usua_not, notas_encabe.id_ing, notas_encabe.fech_not
	FROM (usuario INNER JOIN notas_encabe ON usuario.CODI_USU = notas_encabe.codi_usu) INNER JOIN notas_detalle ON notas_encabe.iden_not = notas_detalle.iden_not
	WHERE (((notas_encabe.id_ing)='$ingreso'))
	GROUP BY notas_encabe.iden_not, notas_encabe.fech_not, notas_encabe.hora_not, notas_encabe.usua_not, notas_encabe.id_ing, notas_detalle.clas_not, notas_encabe.fech_not
	HAVING ((notas_detalle.clas_not)='$selec') 
	ORDER BY notas_encabe.iden_not DESC";
	echo"
	<br>
	<table align=center cellspacing=5 border=0 width=100%> 	
	<tr>
	<td class='Th0' align=center><font face=arial size=2><b>NOTAS DE ENFERMERIA</td></tr>
	<tr><td><hr width='100%'></td>
	</tr></table>";
	
	
	echo"<br><table align=center>
	<tr>
	<td><font face=arial size=1 color='#000000'><b>$cedula</td><td width=30><td><font face=arial size=1 color='#000000'><b>$nombre</td>
	</tr>
	</table>";	
	$resulesta=Mysql_query($cadesta,$link);
	$numesta=Mysql_num_rows($resulesta);
	if($numesta>0)
	{
		echo"<form name=uno method=post>
		<input type=hidden name=reg>
		<input type=hidden name=iden>
		<input type=hidden name=cedula value='$cedula'>
		
		<table class='tbl2' WIDTH=100%>";
		if($selec=='S')
		{
			echo"
			<tr>
			<td align=center><font face=arial size=1><b>NUMERO</td>
			<td align=center><font face=arial size=1><b>FECHA Y HORA					
			<td align=center><font face=arial size=1><b>PRES_ARTERIAL</td>					
			<td align=center><font face=arial size=1><b>RESPIRAC.</td>					
			<td align=center><font face=arial size=1><b>PULSO</td>									
			<td align=center><font face=arial size=1><b>TEMPER.</td>							
			<td align=center><font face=arial size=1><b>F.C.F.</td>					
			<td align=center><font face=arial size=1><b>GLUC_PREP</td>									
			<td align=center><font face=arial size=1><b>GLUC_POSP</td>					
			<td align=center><font face=arial size=1><b>OXIM_CON O2</td>					
			<td align=center><font face=arial size=1><b>OXIM_SIN O2</td>		
			<tr align=center>
			<tr><td colspan=11><hr width='100%'></td></tr>";
		}
		if($selec=='O')
		{
			echo"
			<tr>
			<td align=center><font face=arial size=2><b>NUMERO</td>
			<td align=center><font face=arial size=2><b>FECHA Y HORA</td>
			<td align=center><font face=arial size=2><b>RESPONSABLE</td>
			<td align=center><font face=arial size=2><b>OBSERVACIÒN</td>					
			<tr align=center>";
		}
		$n=1;
	    while($rowevo=mysql_fetch_array($resulesta))
		{
			$numevo=$rowevo['iden_not'];	
			$fecha=$rowevo['fech_not'];
			$hora=$rowevo['hora_not'];
			$usuario=$rowevo['usua_not'];
			
			Mysql_select_db('general',$link);
			$cadusu="select * from cut where ide_usua='$usuario'";
			$resulusua=Mysql_query($cadusu,$link);
			 while($rowusu=mysql_fetch_array($resulusua))
			{
				$nomusua=$rowusu['nomb_usua'];
			}
			Mysql_select_db('proinsalud',$link);			
			$cad1="SELECT * FROM notas_encabe INNER JOIN notas_detalle ON notas_encabe.iden_not = notas_detalle.iden_not WHERE (((notas_encabe.iden_not)='$numevo'))
			GROUP BY notas_detalle.clas_not	HAVING (((notas_detalle.clas_not)='O'))";
			$res1=Mysql_query($cad1,$link);
			$num1=Mysql_num_rows($res1);
			$cad2="SELECT * FROM notas_encabe INNER JOIN notas_detalle ON notas_encabe.iden_not = notas_detalle.iden_not WHERE (((notas_encabe.iden_not)='$numevo'))
			GROUP BY notas_detalle.clas_not	HAVING (((notas_detalle.clas_not)='P'))";
			$res2=Mysql_query($cad2,$link);
			$num2=Mysql_num_rows($res2);			
			$cad3="SELECT * FROM notas_encabe INNER JOIN notas_detalle ON notas_encabe.iden_not = notas_detalle.iden_not WHERE (((notas_encabe.iden_not)='$numevo'))
			GROUP BY notas_detalle.clas_not	HAVING (((notas_detalle.clas_not)='M'))";
			$res3=Mysql_query($cad3,$link);
			$num3=Mysql_num_rows($res3);				
			$cad4="SELECT * FROM notas_encabe INNER JOIN notas_detalle ON notas_encabe.iden_not = notas_detalle.iden_not WHERE (((notas_encabe.iden_not)='$numevo'))
			GROUP BY notas_detalle.clas_not	HAVING (((notas_detalle.clas_not)='S'))";
			$res4=Mysql_query($cad4,$link);
			$num4=Mysql_num_rows($res4);			
			$hora=substr($hora,0,5);			
			if($selec=='O')
			{
				$cadO="SELECT notas_detalle.iden_not, notas_detalle.iddn_not, notas_encabe.fech_not, notas_encabe.hora_not, notas_detalle.obse_not, notas_detalle.clas_not, notas_encabe.usua_not
				FROM notas_detalle INNER JOIN notas_encabe ON notas_detalle.iden_not = notas_encabe.iden_not
				WHERE (((notas_detalle.iden_not)='$numevo') AND ((notas_detalle.clas_not)='O'))";
				$resulO=Mysql_query($cadO,$link);				
				while($rowO=mysql_fetch_array($resulO))
				{					
					$obseO=$rowO['obse_not'];
					$fec=$rowO['fech_not'];
					$hor=$rowO['hora_not'];
					$emple0=$rowO['usua_not'];
					$hor=substr($hor,0,5);
					Mysql_select_db('general',$link);
					$nemp=mysql_query("select nomb_usua from cut where ide_usua = '$emple0'");
					$remp=mysql_fetch_array($nemp);
					$nomemp=$remp['nomb_usua'];					
					echo"
					
					<tr><td colspan=3><hr width='100%'></td></tr>
					<tr valign='top'>
					<td align=center width=8%><font face=arial size=1><b>$numevo</font>					
					<td align=center width=16%><font face=arial size=1><b>$fec - $hor</td>
					<td align=center width=16%><font face=arial size=1><b>$nomemp</td>
					<td><font face=arial size=1><b>$obseO</td>
					</tr>
					<tr><td height=10></td></tr>					
					";
				}				
			}			
			if($selec=='S')
			{	
				$cadM="SELECT notas_encabe.iden_not, signos_vitales.fech_sig, signos_vitales.hora_sig, signos_vitales.pami_sig, signos_vitales.pama_sig,
				signos_vitales.resp_sig, signos_vitales.puls_sig, signos_vitales.temp_sig, signos_vitales.fcfe_sig,signos_vitales.glpr_sig,
				signos_vitales.glpo_sig,signos_vitales.oxco_sig,signos_vitales.oxso_sig,signos_vitales.empl_sig				
				FROM (notas_detalle INNER JOIN notas_encabe ON notas_detalle.iden_not = notas_encabe.iden_not) INNER JOIN signos_vitales ON notas_detalle.iddn_not = signos_vitales.iddn_not
				WHERE (((notas_encabe.iden_not)='$numevo'))";			
				$resulM=Mysql_query($cadM,$link);				
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
					$hora=substr($hora,0,5);
					Mysql_select_db('general',$link);
					$nemp=mysql_query("select nomb_usua from cut where ide_usua = '$emple'");
					$remp=mysql_fetch_array($nemp);
					$nomemp=$remp['nomb_usua'];
					Mysql_select_db('proinsalud',$link);					
					echo"<tr>
					<td align=center><font face=arial size=1><b>$numevo</font>					
					<td align=center><font face=arial size=1><b>$fecha - $hora</td>
					<td align=center><font face=arial size=1><b>$prearba // $prearal</td>
					<td align=center><font face=arial size=1><b>$respi</td>	
					<td align=center><font face=arial size=1><b>$pulso</td>	
					<td align=center><font face=arial size=1><b>$tempe</td>	
					<td align=center><font face=arial size=1><b>$frecu</td>	
					<td align=center><font face=arial size=1><b>$glpre</td>	
					<td align=center><font face=arial size=1><b>$glpos</td>
					<td align=center><font face=arial size=1><b>$oxcono</td>
					<td align=center><font face=arial size=1><b>$oxsino</td>					
					</tr>";					
				}
				echo"";	
			}			
			$n=$n++;
		}
		echo'</table>
		</form>
		</div>';		
	}	
	else
	{
	    echo"<div id='nav2'>
		<br><br><br><br><br><br>
		<table class='tbl1' border=0>
		<tr>		
		<td class='Td0' align=center>NO EXISTE HISTORICO DEL PACIENTE</td>		
		<tr></table>";
	}

mysql_close();
	
?>
</body>
</html>

