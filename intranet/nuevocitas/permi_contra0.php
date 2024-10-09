<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
function salir(id)
{		
	if(id=='1')
	{
		uno.action='permi_usua1.php';
		uno.target='';
		uno.submit();
	}
	if(id=='2')
	{
		uno.action='permi_usua0.php';
		uno.target='';
		uno.submit();
	}
}	
function habilita()
{
	
	mm=uno.fincon.value;
	
	if(uno.habil.checked==true)
	{
		for(i=0;i<mm;i++)
		{
			val="uno.estacon"+i+".checked=true";
			eval(val);	
			val="uno.cidicon"+i+".disabled=false";
			eval(val);	
		}
	
	}
	else
	{
		for(i=0;i<mm;i++)
		{
			val="uno.estacon"+i+".checked=false";
			eval(val);
			val="uno.cidicon"+i+".disabled=true";
			eval(val);			
		}
	
	}
}
function chequea(n)
{
	
	if(eval("uno.estacon"+n+".checked==true"))
	{
		eval("uno.cidicon"+n+".disabled=false");
	}
	else
	{
		eval("uno.cidicon"+n+".disabled=true");
	}
}
function marca()
{
	nn=uno.fincon.value;
	
	for(i=0;i<nn;i++)
	{
		
		if(eval("uno.estacon"+i+".checked==true"))
		{
			eval("uno.cidicon"+i+".disabled=false");
			
		}
		else
		{
			eval("uno.cidicon"+i+".disabled=false");
		}	
	}	
}
	
</script>
</head>
<body onload="marca()">
<?  
	set_time_limit(300);
	foreach($_POST as $nombre_campo => $valor)
	{ 
	   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
	   eval($asignacion); 
	} 
	include ('php/conexion1.php');
	echo "<form name=uno method=post>	
	<table class='tbl' align=center>
	<tr>
	
	<th>CONTRATO</th>
	<th><input type=checkbox name=habil value=1 onclick='habilita()'> HABILITAR</th>
	<th>CITAS DIRECTAS</th>
	</tr>";
	
	

	$bcon=mysql_query("SELECT contrato.CODI_CON, contrato.NEPS_CON
	FROM contrato WHERE (((contrato.ESTA_CON)='A')) ORDER BY contrato.NEPS_CON");
	$n=0;
	while($row=mysql_fetch_array($bcon))
	{
				
		$codcon=$row['CODI_CON'];
		$nomcon=$row['NEPS_CON'];		
		$estapermi='';
		$estacon='';
		$cidicon='';			
		$idenper='';
		$idenpco='';
		$bconco=mysql_query("SELECT permisos_citascon.esta_pco, permisos_citascon.cidi_pco
		FROM permisos_citascon
		WHERE (((permisos_citascon.usua_pco)='$emple') AND ((permisos_citascon.serv_pco)='$areasel') AND ((permisos_citascon.area_pco)='$areatra') AND ((permisos_citascon.cont_pco)='$codcon'))");
		$rconco=mysql_fetch_array($bconco);		
		$estacon=$rconco['esta_pco'];
		$cidicon=$rconco['cidi_pco'];
		$nomvar='codcon'.$n;
		echo"<input type=hidden name=$nomvar value='$codcon'>";	
		echo"<tr>";					
		echo"<td>$nomcon</td>";			
		
		$nomvar='estacon'.$n;
		if($estacon=='A')echo"<td align=center> <input type=checkbox checked name=$nomvar value='A' onclick='chequea($n)'></td>";
		else echo"<td align=center><input type=checkbox name=$nomvar value='A' onclick='chequea($n)'></td>";		
		
		$nomvar='cidicon'.$n;				
		if($cidicon=='A')echo"<td align=center> <input type=checkbox checked disabled name=$nomvar value='A'></td>";
		else echo"<td align=center><input type=checkbox disabled name=$nomvar value='A'></td>";
		echo"</tr>";
		$n++;		
	}
	echo"<input type=hidden name=fincon value='$n'>";
	for($n=0;$n<$finn;$n++)
	{
		$nomvar='codar'.$n;
		$codar=$$nomvar;
		echo"<input type=hidden name=$nomvar value='$codar'>";		
		$nomvar='tipoper'.$n;
		$tipoper=$$nomvar;
		echo"<input type=hidden name=$nomvar value='$tipoper'>";	
	}
	echo"
	<input type=hidden name=opcion value='2'>
	<input type=hidden name=areasel value='$areasel'>
	<input type=hidden name=finn value='$finn'>	
	<input type=hidden name=emple value='$emple'>
    <input type=hidden name=nomemple value='$nomemple'> 
	<input type=hidden name=areatra value='$areatra'>
	<tr><th colspan=3><INPUT type=button class='boton' value='GUARDAR' onClick='salir(1);'><INPUT type=button class='boton' value='CANCELAR' onClick='salir(2);'></th></tr>	
	</form>";	
?>
</body>
</html>