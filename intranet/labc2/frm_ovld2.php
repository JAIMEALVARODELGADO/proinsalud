<!-- Captura la identificación del usuario a buscar -->
<html>
<head><title>ESTADOS DE LAS ORDENES</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 

<!-- librera principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librera para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librera que declara la funcin Calendar.setup, que ayuda a generar un calendario en unas pocas lneas de cdigo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<script language="Javascript">
function busca()
{
	//uno.esta_ncf.value=1;
	uno.action='frm_ovld2.php';
	uno.target='';
	uno.submit();
}
</script>

</head>
<body bgcolor="#E6E8FA">
<!--<link rel="stylesheet" href="css/style.css" type="text/css">-->
<form name="uno" method="POST">

<table class='Tbl0' border='0'>
    <tr><td class='Td1' align='center'><STRONG>ORDENES DE LABORATORIO CUMPLIDAS</strong></td></tr>
</table>
<!--<Table width="40%" border="1" align="center" cellpadding=0 Cellspacing=1 BorderColor="#fffff" BgColor="D0D0F0">-->
<br>
<?
	$fecha=time();
	$fecdia=date ("Y-m-d",$fecha);
	if(empty($fin))$fin=$fecdia;
	if(empty($ffinal))$ffinal=$fecdia;
	if(empty($finicial))$finicial=$fecdia;
?>
<table border='0' width="60%" align='center'>
 <tr> 
	
	<td align="right"><B>Fecha Inicial:</td><td>
		<!-- formulario con el campo de texto y el botn para lanzar el calendario--> 
		<?php echo "<input type=text name=finicial id=finicial size='10' value= >";?>
		<input type="button" id="lanzador1" value="..." />
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField   :    "finicial",     // id del campo de texto 
		ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
		button       :    "lanzador1"     // el id del botn que lanzar el calendario 
		}); 
		</script> 
	</td>
	<script language=javascript>uno.finicial.value="<?echo $finicial?>";</script>
	
	<td align="right"><B>Fecha Final:</td><td>
		<!-- formulario con el campo de texto y el botn para lanzar el calendario--> 
		<?php echo "<input type=text name=ffinal id=ffinal size='10' value= >";?>
		<input type="button" id="lanzador2" value="..." />
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField   :    "ffinal",     // id del campo de texto 
		ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
		button       :    "lanzador2"     // el id del botn que lanzar el calendario 
		}); 
		</script> 
	</td>
	<script language=javascript>uno.ffinal.value="<?echo $ffinal?>";</script>
	
	
	<td><b>Identificación:</td><td><input type=text name=ced_usu value=<?echo $ced_usu;?>></td>
	<td><td><strong>Estado</td><td><select name='est_lab'>
	<option value='CU'>Cumplido</option>
	<option value='EL'>Eliminado</option>
	<option value='P'>Pendiente</option>
	<option value='RE'>Pendiente/Resultado(RE)</option>
	</td>
	<script language=javascript>uno.est_lab.value="<?echo $est_lab?>";</script>
	<td><input type=submit name='Buscar' value='Buscar' onclick='busca()'></td>
	</tr></table>
	
	<?
	
	include('php/conexion3.php');
	base_proinsalud();
	$condicion="((encabezado_labs.fchr_labs>='$finicial') AND (encabezado_labs.fchr_labs<='$ffinal'))";
	
	//echo 'estadoooo'.$est_lab;
	
	if($est_lab=='P') 
	{
			$condicion=$condicion." AND ((detalle_labs.estd_dlab='P') OR (detalle_labs.estd_dlab='PR'))";
	}	
	else
	{
	
		$condicion= $condicion. " AND (detalle_labs.estd_dlab='$est_lab')";
	
	
	}
	if((!empty($ced_usu))) 
	{
			$condicion=$condicion.' AND usuario.NROD_USU='.$ced_usu;
	}
	
	echo"<br><table class='Tbl0'border=1>
		<tr>         
		<th class='Th0'>FECHA</th>
		<th class='Th0'>ORDEN</th>
		<th class='Th0'>DOCUMENTO</th>
		<th class='Th0'>NOMBRE</th>
		<th class='Th0'>EXAMEN</th>
		<th class='Th0'>ESTADO</th>
		</TR>
		<tr>   	 
		<th height=12></th>
		</TR>";
	
	
	//echo $est_lab;
	
	$con_cum=mysql_query("SELECT encabezado_labs.fchr_labs,encabezado_labs.hrar_labs, encabezado_labs.resp_labs,detalle_labs.nord_dlab,encabezado_labs.codi_usu, encabezado_labs.iden_labs, detalle_labs.codigo  ,usuario.NROD_USU, usuario.PNOM_USU, usuario.PAPE_USU, encabezado_labs.cod_medi,detalle_labs.estd_dlab
	FROM (detalle_labs INNER JOIN encabezado_labs ON detalle_labs.iden_labs = encabezado_labs.iden_labs) 
	INNER JOIN usuario ON encabezado_labs.codi_usu = usuario.CODI_USU
	WHERE $condicion
	GROUP BY detalle_labs.nord_dlab, usuario.NROD_USU, usuario.PNOM_USU, usuario.PAPE_USU, encabezado_labs.cod_medi
	order by detalle_labs.nord_dlab ASC");
	
	//echo $con_cum;
	$cant=mysql_num_rows($con_cum);
	if(mysql_num_rows($con_cum)<>0)
	{
		while ($rowx=mysql_fetch_array($con_cum))
		{
			
			$nombre= "$rowx[PNOM_USU] $rowx[PAPE_USU]";
			$NROD_USU=$rowx[NROD_USU];
			$codusu=$rowx[codi_usu];
			$iden_labs=$rowx[iden_labs];
			$nord_dlab=$rowx[nord_dlab];
			$fchr_labs=$rowx[fchr_labs];
			$codi_ex=$rowx[codigo];
			$etado=$rowx[estd_dlab];
			$patiende=$rowx[resp_labs];
			$hora=$rowx[hrar_labs];
		
			echo "<tr>
				  <td class='Td0' width='10%'><strong>$fchr_labs/$hora</td>
				  <td class='Td0' width='5%'><strong>$nord_dlab</td>
				  <td class='Td0' width='8%'><strong>$NROD_USU</td>
				  <td class='Td0' width='10%'><strong>$nombre</td>";
				  
				  if($est_lab=='PR' OR $est_lab=='P' OR $est_lab=='EL' )
				  {
					$nom_cups=mysql_query("SELECT codigo,descrip FROM CUPS WHERE codigo='$codi_ex'");
					//echo $nom_cups;
					if(mysql_num_rows($nom_cups)<>0)	
					{
						$rowex_=mysql_fetch_array($nom_cups);
						$nomb_ex=$rowex_[descrip];
						echo"<td class='Td0' width='30%'>$nomb_ex</td>";
						base_general();
						$rece=mysql_query("SELECT ide_usua,nomb_usua FROM CUT WHERE ide_usua='$patiende'");
						$rowat_=mysql_fetch_array($rece);
						echo"<td class='Td0' width='30%'>$rowat_[nomb_usua]</td>";
						base_proinsalud();
					}
					else 
					{
						echo"<td class='Td0' width='30%'><font color=red>EL EXAMEN NO EXISTE/MAL INGRESADO</font></td>";
					}
				  }
				  else
				  {
					  echo"<td class='Td0' width='2%'>";
					  echo"<a href=imprimir2_.php?codusu=$codusu&iden_labs=$iden_labs&nd_=$nord_dlab&band=1 target='fr01'>
					  <img src='icons/feed_magnify.png' border=0 width=17 height=17 alt='Imprimir' ></a></td>";
				  }
		
					echo"<td class='Td0' width='5%'><strong>$etado</td>";
		
		
		}
	}
	else
	{
		echo "No Existen Ordenes Validas";
	
	}
		
	echo "<tr><th class='Th0' colspan=6>TOTAL: $cant</th></tr>";
	
	echo "</tr></table>";
	
	?>

</form>
</body>
</html>