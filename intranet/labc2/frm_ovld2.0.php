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
	if(empty($ffin))$ffin=$fecdia;
?>
<table border='0' width="60%" align='center'>
 <tr> 
	
	<td align="right"><B>Fecha Solicitud:</td><td>
		<!-- formulario con el campo de texto y el botn para lanzar el calendario--> 
		<?php echo "<input type=text name=ffin id=ffin size='10' value= >";?>
		<input type="button" id="lanzador2" value="..." />
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField   :    "ffin",     // id del campo de texto 
		ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
		button       :    "lanzador2"     // el id del botn que lanzar el calendario 
		}); 
		</script> 
	</td>
	<script language=javascript>uno.ffin.value="<?echo $ffin?>";</script>
	<td><b>Identificación:</td><td><input type=text name=ced_usu value=<?echo $ced_usu;?>></td>
	<td><td><strong>Estado</td><td><select name='est_lab'>
	<option value='CU'>Cumplido</option>
	<option value='PR'>En Proceso</option>
	<option value='EL'>Eliminado</option>
	<option value='P'>Pendiente</option>
	</td>
	<script language=javascript>uno.est_lab.value="<?echo $est_lab?>";</script>
	<td><input type=submit name='Buscar' value='Buscar' onclick='busca()'></td>
	</tr></table>
	
	<?
	$link=Mysql_connect("localhost","root","");
	if(!$link){echo"no hay conexion";}
	Mysql_select_db('proinsalud',$link);
	
	$condicion="((detalle_labs.estd_dlab='$est_lab') AND (encabezado_labs.fchr_labs='$ffin'))";
	if((!empty($ced_usu))) 
	{
			$condicion=$condicion.' AND usuario.NROD_USU='.$ced_usu;
	}	

	echo"<br><table class='Tbl0'border=1>
		<tr>         
		<th class='Th0'>ORDEN</th>
		<th class='Th0'>DOCUMENTO</th>
		<th class='Th0'>NOMBRE</th>
		<th class='Th0'>OP</th>
		</TR>
		<tr>   	 
		<th height=12></th>
		</TR>";
	
	
	
	$con_cum=mysql_query("SELECT detalle_labs.nord_dlab,encabezado_labs.codi_usu, encabezado_labs.iden_labs  ,usuario.NROD_USU, usuario.PNOM_USU, usuario.PAPE_USU, encabezado_labs.cod_medi
	FROM (detalle_labs INNER JOIN encabezado_labs ON detalle_labs.iden_labs = encabezado_labs.iden_labs) 
	INNER JOIN usuario ON encabezado_labs.codi_usu = usuario.CODI_USU
	WHERE $condicion
	GROUP BY detalle_labs.nord_dlab, usuario.NROD_USU, usuario.PNOM_USU, usuario.PAPE_USU, encabezado_labs.cod_medi
	order by detalle_labs.nord_dlab ASC");
	
	//echo $con_cum;
	
	if(mysql_num_rows($con_cum)<>0)
	{
		while ($rowx=mysql_fetch_array($con_cum))
		{
			
			$nombre= "$rowx[PNOM_USU] $rowx[PAPE_USU]";
			$NROD_USU=$rowx[NROD_USU];
			$codusu=$rowx[codi_usu];
			$iden_labs=$rowx[iden_labs];
			$nord_dlab=$rowx[nord_dlab];
		
			echo "<tr><td class='Td0' width='10%'><strong>$nord_dlab</td>
				  <td class='Td0' width='10%'><strong>$NROD_USU</td>
				  <td class='Td0' width='30%'><strong>$nombre</td>
				  <td class='Td0' width='2%'>
				  <a href=imprimir2_.php?codusu=$codusu&iden_labs=$iden_labs&nd_=$nord_dlab&band=1 target='fr01'>
				  <img src='icons/feed_magnify.png' border=0 width=17 height=17 alt='Imprimir' ></a></td>";
				
		
		
		
		
		}
	}
	else
	{
		echo "No Existen Ordenes Validas";
	
	}
		
	
	
	echo "</tr></table>";
	
	?>

</form>
</body>
</html>