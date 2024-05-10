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
<body>	
<?php
// 192.168.4.20/intraweb/intranet/consulta_ambulatoria/actua_muni.php
	include ('php/conexion1.php');
	/*
	$m=0;
	$busori=mysql_query("SELECT * FROM medicos where (municipio_med='' Or municipio_med Is Null)");
	$n=0;
	while($rori=mysql_fetch_array($busori))
	{
		$cod_medi=$rori['cod_medi'];
		$nom_medi=$rori['nom_medi'];
		
		$bmun=mysql_query("SELECT empleados.cod_municipio, empleados.codigo
		FROM empleados	WHERE empleados.codigo='$cod_medi'");
		while($rmun=mysql_fetch_array($bmun))
		{
			$codmun=$rmun['cod_municipio'];
			$codemp=$rmun['codigo'];
			$upd=mysql_query("UPDATE medicos SET municipio_med='$codmun' where cod_medi='$codemp'");
			if($upd)$m++;
		}
		$n++;
		
	}
	echo $n.' '.$m;
	*/
	/*
	$busori=mysql_query("SELECT * FROM medicos where (municipio_med='' Or municipio_med Is Null)");
	$n=0;
	$m=0;
	echo "<table>
	<tr>
	<td align=center><b>Nro.<td>
	<td align=center><b>MEDICO<td>
	<td align=center><b>AREA<td>
	<td align=center><b>CODIGO<td>
	<td align=center><b>MUNICIPIO<td>
	</tr>";
	$n=1;
	while($rori=mysql_fetch_array($busori))
	{
		$cod_medi=$rori['cod_medi'];
		$nom_medi=$rori['nom_medi'];
		$are_medi=$rori['are_medi'];
		$bmun=mysql_query("SELECT * FROM municipio WHERE DEPA_MUN='52'");
		while($rmun=mysql_fetch_array($bmun))
		{
			$codmuni=$rmun['CODI_MUN'];
			$nommuni=$rmun['NOMB_MUN'];
			$pos = strpos($are_medi, $nommuni);
			
			if ($pos !== false) 
			{
				echo"
				<tr>
				<td>$n<td>
				<td>$nom_medi<td>
				<td>$are_medi<td>
				<td align=center>$codmuni<td>
				<td>$nommuni<td>
				</tr>";
				$upd=mysql_query("UPDATE medicos SET municipio_med='$codmuni' where cod_medi='$cod_medi'");
				$n++;
			} 

		}
	}
	*/
	
	
		
		
	
	
	
	$busori=mysql_query("SELECT encabesadohistoria.numc_ehi, consultaprincipal.come_cpl
	FROM encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl
	WHERE (((encabesadohistoria.feco_ehi)>='2021-01-01') AND ((encabesadohistoria.origconsu_ehi)='NOHAY'))");
	$n=0;
	$m=0;
	while($rori=mysql_fetch_array($busori))
	{
		$histo=$rori['numc_ehi'];
		$cmed=$rori['come_cpl'];
		$codmun='';
		$bmun=mysql_query("SELECT medicos.municipio_med, medicos.cod_medi
		FROM medicos WHERE (((medicos.cod_medi)='$cmed'))");
		while($rmun=mysql_fetch_array($bmun))
		{
			$codmun=$rmun['municipio_med'];
			if($codmun!='')
			{
				$upd=mysql_query("UPDATE encabesadohistoria SET origconsu_ehi='$codmun' where numc_ehi='$histo' ");
				$m++;
			}
		}
		$n++;		
	}
	echo 'Total vacios '.$n.' Total actualizados '.$m;;
	
	
?>
</body>
</html>







