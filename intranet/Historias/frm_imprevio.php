<?	
	//session_register('paciente');
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="JavaScript">
	function valida()
	{		
		/*
		uno.action='regresa.php';
		uno.target='area';
		uno.submit();
		*/
		
		/*uno.valregre.value='LP';
		uno.codusu.value=''
		uno.target='menu';
		uno.action='blanco.php';
		uno.submit();
		uno.target='titulo';
		uno.action='titulo.php';
		uno.submit();		
		uno.target='area';
		uno.action='regresa.php';
		uno.submit();*/		
		
		//uno.codusu.value=''
		uno.action='imprimirhiscro.php';
		uno.target='FR021';
		//uno.target='TOP';
		uno.submit();
	}
	function ver()
	{
		if(uno.ima.checked==true ||  uno.lab.checked==true || uno.rem.checked==true || uno.med.checked==true || uno.his.checked==true)
		{
			document.getElementById("vista").style.visibility="visible";			
		}
		else
		{
			document.getElementById("vista").style.visibility="hidden";				
		}
	}
</script>
</head>	
<body >
<?php	
	$paciente='';
	//ECHO $numhisto;
	echo"<form name=uno method=post>
	 <input type=hidden name=valregre>
	 <input type=hidden name=cod_usu value='$cod_usu'>
	<input type=hidden name=numhistohc value='$numhisto'>
	<input type=hidden name=marca>";	
	include('php/conexion2.php');	
	
	
	$bima=mysql_query("SELECT cups.codigo, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre
	FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
	WHERE (detareferencia.numc_dre='$numhisto') AND ((cups.grup_cup)='87')");
	//echo $bima;
	if(mysql_num_rows($bima)>0)$numima='SI';	
	
	
	$blab=mysql_query("SELECT cups.codigo, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre
	FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
	WHERE (((cups.grup_cup)='90') AND ((detareferencia.numc_dre)='$numhisto'))");	
	if(mysql_num_rows($blab)>0)$numlab='SI';

	
	$brem=mysql_query("SELECT cups.codigo, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre
	FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
	WHERE (detareferencia.numc_dre='$numhisto' AND cups.grup_cup<>'87' AND cups.grup_cup<>'90')");
	if(mysql_num_rows($brem)>0)$numrem='SI';
	
	
	
	
	$brem1=mysql_query("SELECT destipos.codi_des, destipos.nomb_des, detareferencia.numc_dre, detareferencia.cant_dre, detareferencia.ccie_dre, detareferencia.obsv_dre
	FROM destipos INNER JOIN detareferencia ON destipos.codi_des = detareferencia.codi_dre
	WHERE (((detareferencia.numc_dre)='$numhisto'))");	
	
	if(mysql_num_rows($brem1)>0)$numrem='SI';	
	$bmed=mysql_query("select * from medicamentosenv where numc_men='$numhisto'");
	if(mysql_num_rows($bmed)>0)$nummed='SI';
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
	echo"<tr>
	<th>HISTORIA</th>
	<td><input type=checkbox name='his' onclick='ver()' value=1></td>
	</tr>
	<table>
	<table align=center class='tbl' width=70% id='vista' style='visibility:hidden;'>
	<tr>
	<th align=center valign=top height=30><a><INPUT type=button class='boton' value=IMPRIMIR onClick='valida();'></th>
	</tr>";		
	echo"</table></form>";
?>
</body>
</html>