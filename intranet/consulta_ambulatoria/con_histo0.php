<?
	session_register('paciente');
	session_register('tiespe');
	if(isset($_POST['paciente']))
	{
		$paciente = $_POST['paciente'];
		echo $paciente;
	}
	
	
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="JavaScript">
	
	function cambia()
	{
		uno.action='con_histo0.php';
		uno.target='';
		uno.submit();
	}
	function bushis(ap,nhis,concon)
	{		
		
		if(ap==1)
		{
			alert(concon);	
			if(concon=='1')
			{			
				uno.numhisto.value=nhis;	
				uno.action='impre_histo.php';
			}
			if(concon=='2')
			{				
				uno.numhisto.value=nhis;
				uno.action='impre_histo_espe.php';
			}
		}
		if(ap==2)			
		{
			uno.serie.value=nhis;	
			uno.action='impre_consul.php';
		
		}		
		uno.target='';	
		uno.submit();
	}
	function busevo(evo)
	{
		uno.iden_evo.value=evo;			
		uno.target='TOP';
		uno.action='../uci/imprehis.php';
		uno.submit();	
	}
	function salir(his,tip) 
	{
		uno.numhisto.value=his;
		uno.target='TOP';
		if(tip=='CONSULTA')
		{
			uno.action="../salud_ocupacional/imprimirhis.php";
		}
		if(tip=='CONSULTA_FUN')
		{
			uno.action="../salud_ocupacional/imprimirhis_fun.php";
			
		}
		if(tip=='EVOLUCION')
		{
			uno.action="../salud_ocupacional/imprimirevo.php";
			
		}
		uno.submit();
	}
</script>
</head>	
<body>
<?
	include ('php/conexion1.php');
	if(empty($elige))$elige=0;
	echo"
	<form name=uno method=post>		
	<input type=hidden name='his' value=1>	
	<input type=hidden name='numhisto'>	
	<input type=hidden name='iden_evo'>
	<input type=hidden name='serie'>	
	
	<table align=center width=95%>
	<tr><td>	
	<table align=center class='tbl' width=100%>
	<tr><th>CONSULTA HISTORIA CLINICA</th></tr>
	</table>";
	/*
	echo"
	<table align=center class='tbl' width=100%>
	<tr><th align=center>HISTORIA: </th>	
	<td align=center><select name=elige class='caja' onchange='cambia()'>
	<option value=0>CONSULTA EXTERNA</option>
	<option value=1>HOSPITALIZACION</option>
	<option value=2>SALUD OCUPACIONAL</option>
	</select></td></tr></table>";
	*/
	$ch0='';$ch1='';$ch2='';
	if($elige=='0')$ch0='checked';
	if($elige=='1')$ch1='checked';
	if($elige=='2')$ch2='checked';
	echo"
	<table align=center class='tbl' width=100%>
	<tr><th align=center>HISTORIA: </th>	
	<td align=center>
	CONSULTA EXTERNA <input type=radio name=elige $ch0 class='caja' value=0 onclick='cambia()'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	HOSPITALIZACION <input type=radio name=elige $ch1 class='caja' value=1 onclick='cambia()'>;
	</td></tr></table>";
	
	echo"
	
	<br><br>";
	//SALUD OCUPACIONAL <input type=radio name=elige $ch2 class='caja' value=2 onclick='cambia()'>
	/*
	?>
		
		<script language=javascript>		
		uno.elige.value="<?echo $elige;?>";
		</script>
	<?
	*/
	if($elige==0)
	{
		$bushisto=mysql_query("SELECT encabesadohistoria.cous_ehi, encabesadohistoria.numc_ehi, consultaprincipal.feca_cpl, consultaprincipal.hora_cpl, areas.nom_areas, medicos.nom_medi, consultaprincipal.coan_cpl, consultaprincipal.come_cpl, consultaprincipal.vers_apli, consultaprincipal.codi_cpl
		FROM ((encabesadohistoria 
		INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi) INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas
		WHERE (((encabesadohistoria.cous_ehi)='$paciente'))
		ORDER BY consultaprincipal.feca_cpl DESC , consultaprincipal.hora_cpl DESC");
		if(mysql_num_rows($bushisto)>0)
		{
			echo"<br>
			<center>
			<table align=center border=1 class='tbl' width='90%'>
			<tr>
			<th>HISTORIA</th>
			<th>FECHA</th>
			<th>HORA</th>
			<th>MEDICO</th>
			<th>AREA</th>
			<th>ANALISIS</th>
			</tr>";		
			while($rhi=mysql_fetch_array($bushisto))
			{
				$nhisto=$rhi['numc_ehi'];
				$medico=$rhi['nom_medi'];
				$area=$rhi['nom_areas'];
				$fecha=$rhi['feca_cpl'];
				$hora=$rhi['hora_cpl'];
				$ticon=$rhi['codi_cpl'];
				$cmedi=$rhi['come_cpl'];
				$version=$rhi['vers_apli'];
				
				
				$bsoap=mysql_query("SELECT * FROM consulta_soap WHERE numc_soap='$nhisto'");
				while($rsoap=mysql_fetch_array($bsoap))
				{
					$analisis=$rsoap['anal_soap'];
				}	
				
				$bfor=mysql_query("select * from encabesadoformula where numc_efo='$nhisto'");
				while($rfor=mysql_fetch_array($bfor))
				{
					$proxi=$rfor['coen_efo'];
					$obse=$rfor['obfo_efo'];
					$repi=$rfor['repi_efo'];
				}	
				
				
				$besp=mysql_query("SELECT medicos.cod_medi, destipos.nomb_des, destipos.homo3_des
				FROM medicos INNER JOIN destipos ON medicos.espe_med = destipos.codi_des
				WHERE (((medicos.cod_medi)='$cmedi'))");
				$nesp=mysql_fetch_array($besp);
				$tiespe=$nesp['homo3_des'];
				if($tiespe=='2' && $ticon=='2')$con='2';
				else $con='1';	
				$conso='';				
				if($version=='5503')
				{
						$apli='1';					
				}
				if($version=='5510')
				{
					$apli='2';																
				}		
				
				echo"
				<tr>
				<td><a href='#' onclick='bushis(\"$apli\",\"$nhisto\", \"$con\")'>$nhisto</a></td>
				<td><a href='#' onclick='bushis(\"$apli\",\"$nhisto\", \"$con\")' style='text-decoration:none'><font color='#222222'>$fecha</a></td>
				<td><a href='#' onclick='bushis(\"$apli\",\"$nhisto\", \"$con\")' style='text-decoration:none'><font color='#222222'>$hora</a></td>
				<td><a href='#' onclick='bushis(\"$apli\",\"$nhisto\", \"$con\")' style='text-decoration:none'><font color='#222222'>$medico</a></td>
				<td><a href='#' onclick='bushis(\"$apli\",\"$nhisto\", \"$con\")' style='text-decoration:none'><font color='#222222'>$area</a></td>
				<td><a href='#' onclick='bushis(\"$apli\",\"$nhisto\", \"$con\")' style='text-decoration:none'><font color='#222222'>$analisis</a></td>				
				</tr>
				";			
			}
			echo"</table>
			</center>";
		}
	}	
	if($elige==1)
	{
		$bushisto=mysql_query("SELECT hist_evo.codi_usu, hist_evo.iden_evo, hist_evo.fech_evo, hist_evo.hora_evo, destipos_1.nomb_des AS nom_areas, medicos.nom_medi, 
		hist_evo.anal_evo
		FROM ((hist_evo INNER JOIN medicos ON hist_evo.cod_medi = medicos.cod_medi) INNER JOIN destipos ON hist_evo.cama_evo = destipos.codi_des) INNER JOIN destipos AS destipos_1 ON destipos.valo_des = destipos_1.codi_des
		WHERE (((hist_evo.codi_usu)='$paciente'))");
		if(mysql_num_rows($bushisto)>0)
		{
			echo"<br>
			<table align=center class='tbl' width='900px'>
			<tr>
			<th>HISTORIA</th>
			<th>FECHA</th>
			<th>HORA</th>
			<th>MEDICO</th>
			<th>AREA</th>
			<th>ANALISIS</th>
			</tr>";		
			while($rhi=mysql_fetch_array($bushisto))
			{
				$nhisto=$rhi['iden_evo'];
				$medico=$rhi['nom_medi'];
				$area=$rhi['nom_areas'];
				$fecha=$rhi['fech_evo'];
				$hora=$rhi['hora_evo'];
				$analisis=$rhi['anal_evo'];				
				echo"
				<tr>
				<td><a href='#' onclick='busevo(\"$nhisto\")'>$nhisto</a></td>
				<td><a href='#' onclick='busevo(\"$nhisto\")'>$fecha</a></td>
				<td><a href='#' onclick='busevo(\"$nhisto\")'>$hora</a></td>
				<td><a href='#' onclick='busevo(\"$nhisto\")'>$medico</a></td>
				<td><a href='#' onclick='busevo(\"$nhisto\")'>$area</a></td>
				<td><a href='#' onclick='busevo(\"$nhisto\")'>$analisis</a></td>				
				</tr>
				";			
			}
			echo"</table>";
		}
	
	}
	if($elige=='2')	//SALUD OCUPACIONAL
	{
		$busca=mysql_query("SELECT usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, so_infpersonal.nhis_inf, so_infpersonal.fech_inf, so_infpersonal.hora_inf, so_infpersonal.tico_inf, contrato.NEPS_CON, medicos.nom_medi
		FROM ((so_infpersonal INNER JOIN usuario ON so_infpersonal.codi_usu = usuario.CODI_USU) INNER JOIN contrato ON so_infpersonal.cont_inf = contrato.CODI_CON) INNER JOIN medicos ON so_infpersonal.codi_med = medicos.cod_medi
		WHERE so_infpersonal.codi_usu='$paciente'
		ORDER BY so_infpersonal.fech_inf DESC , so_infpersonal.hora_inf DESC");
		
		echo "
		<BR><BR>
		<table align=center class='tbl'>
		<tr>
		<th>No. HISTORIA</th>
		<th>TIPO CONSULTA</th>
		<th>FECHA</th>
		<th>HORA</th>
		<th>IDENTIFICACION</th>
		<th>NOMBRE PACIENTE</th>
		<th>CONTRATO</th>
		<th>MEDICO</th>
		</tr>
		
		";
		while($rus=mysql_fetch_array($busca))
		{
			$nombre=$rus['PNOM_USU'].' '.$rus['SNOM_USU'].' '.$rus['PAPE_USU'].' '.$rus['SAPE_USU'];
			$histo=$rus['nhis_inf'];
			$docum=$rus['NROD_USU'];
			$fecha=$rus['fech_inf'];
			$hora=$rus['hora_inf'];
			$contra=$rus['NEPS_CON'];
			$medico=$rus['nom_medi'];
			$tipocon=$rus['tico_inf'];
			
			
			echo"<tr>
			<td align=center><a href='#' onclick='salir(\"$histo\",\"$tipocon\")' >$histo</a></td>
			<td align=center><a href='#' onclick='salir(\"$histo\",\"$tipocon\")'>$tipocon</a></td>
			<td align=center><a href='#' onclick='salir(\"$histo\",\"$tipocon\")'>$fecha</a></td>
			<td align=center><a href='#' onclick='salir(\"$histo\",\"$tipocon\")'>$hora</a></td>
			<td align=center><a href='#' onclick='salir(\"$histo\",\"$tipocon\")'>$docum</a></td>
			<td><a href='#' onclick='salir(\"$histo\",\"$tipocon\")'>$nombre</a></td>
			<td><a href='#' onclick='salir(\"$histo\",\"$tipocon\")'>$contra</a></td>
			<td><a href='#' onclick='salir(\"$histo\",\"$tipocon\")'>$medico</a></td>
			</tr>";		
		}
		echo"</table>";
	}
?>
</body>
</html>
		
	