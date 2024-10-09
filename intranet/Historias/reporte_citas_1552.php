<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />  
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script>
<script language=javascript>
function cambio()
{
	if(uno.fecini.value=='')
	{
		alert("Digite la fecha de inicio del reporte");
		uno.fecini.focus();
		return;
	}
	if(uno.fecfin.value=='')
	{
		alert("Digite la fecha final del reporte");
		uno.fecfin.focus();
		return;
	}
	if(uno.contrato.value=='')
	{
		alert("Seleccione el contrato a reportar");
		uno.contrato.focus();
		return;
	}
	if(uno.tipoimpre.value=='')
	{
		alert("Seleccione el tipo de impresion del reporte");
		uno.tipoimpre.focus();
		return;
	}
	if(uno.tipoimpre.value=='1')
	{
		uno.action="reporte_citas_1552.php";
		uno.target='';
	}
	if(uno.tipoimpre.value=='2')
	{
		uno.action="reporte_citas_1552_pdf.php";
		uno.target='TOP';
	}
	if(uno.tipoimpre.value=='3')
	{
		uno.action="reporte_citas_1552_excel.php";
		uno.target='';
	}
	uno.submit();
}
</script>
</head>
<body onload='entra()'>
<style>
.sel{
font-size:12;
}
.tbl 
{
	border: 1px solid #bbbbff;
	border-collapse: collapse;
	empty-cells: show;
	background: #FFFFFF;
}
.tbl td 
{	
	border: 1px solid #bbbbff;
	font=-family: tahoma;
	color: #0240A3;
	font-size: 10pt;
	text-decoration: none;
	font-weight: 500;
	text-transform: uppercase;	
	padding:.3em .4em;	
}
.tbl th
{
	border: 1px solid #bbbbff;
	padding:.6em .8em;
	font=-family: tahoma;
	color: #0240A3;
	font-size: 10pt;
	text-decoration: none;
	font-weight: 700;
	text-transform: uppercase;
	background-Color:#E3E3ED;	
}

.tb2 
{
	border: 1px solid #bbbbff;
	border-collapse: collapse;
	empty-cells: show;
	background: #FFFFFF;

}
.tb2 td 
{	
	font=-family: tahoma;
	color: #0240A3;
	font-size: 8pt;
	text-decoration: none;
	font-weight: 500;
	text-transform: uppercase;
	border: 1px solid #ya sub;
	padding:.3em .4em;	
	background-Color:#F8F8F8;	
	
}
.tb2 th
{
	border: 1px solid #bbbbff;
	padding:.6em .8em;
	font=-family: tahoma;
	color: #0240A3;
	font-size: 8pt;
	text-decoration: none;
	font-weight: 700;
	text-transform: uppercase;	
}
.caja
{
	font-family: arial,tahoma;
	font-size: 10pt;
	color:#000088;
	font-weight: 500;
	text-transform:uppercase;
	background:#FFF;
}
</style>
<?
	// 192.168.4.20/intraweb/intranet/Historias/reporte_citas_1552.php
	foreach($_POST as $nombre_campo => $valor)
	{ 
	   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
	   eval($asignacion); 
	}
	 foreach($_GET as $nombre_campo => $valor)
	{ 
	   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
	   eval($asignacion); 
	}	
	set_time_limit (100);
    $fecha=date("Y-m-d");
	
	include ('php/conexion2.php');
	
	
	if(empty($fecini))$fecini=$fecha;
	if(empty($fecfin))$fecfin=$fecha;
	echo"<form name=uno method=post>
	
	<br>
	<table class='tbl' align=center>
	<tr>
	<th colspan=4>REPORTE RESOLUCION 1552</td>	
	</tr>	
	<tr>	
	<th>FECHA INICIO</td>
	<th>FECHA FINAL</td>
	<th>CONTRATO</td>
	<th>TIPO IMPRESION</td>	
	</tr>
	<tr>	
	<td>
	";	
	?>
		<input type="text" name="fecini" class='caja' size="10" maxlength="10" value="<?echo $fecini;?>" id="fini" <?echo $disp;?>>
		<input type="button" class='caja' id="lanzador1" value="..." <?echo $disp;?>/>
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField     :    "fini",     // id del campo de texto 
		ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
		button     :    "lanzador1"     // el id del botn que lanzar el calendario 				
		}); 
		</script> 				
	<?		
	echo"
	</td>	
	<td>";
	?>
		<input type="text" name="fecfin" class='caja' size="10" maxlength="10" value="<?echo $fecfin;?>" id="ffin" <?echo $disp;?>>
		<input type="button" class='caja' id="lanzador2" value="..." <?echo $disp;?>/>
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField     :    "ffin",     // id del campo de texto 
		ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
		button     :    "lanzador2"     // el id del botn que lanzar el calendario 				
		}); 
		</script> 				
	<?	
	$ch1='';$ch2='';$ch3='';
	if($tipoimpre=='1')$ch1="selected";
	if($tipoimpre=='2')$ch2="selected";
	if($tipoimpre=='3')$ch3="selected";
	if($contrato=='00')$ch4="selected";
	echo"</td>
	<td>
	<select class='caja' name=contrato>
	<option value=''></option>
	<option $ch4 value='00'>TODOS</option>";
	$bcontra=mysql_query("SELECT * FROM contrato WHERE ESTA_CON='A' ORDER BY NEPS_CON");
	while($rcontra=mysql_fetch_array($bcontra))
	{
		$cod=$rcontra['CODI_CON'];
		$nom=$rcontra['NEPS_CON'];
		if($contrato==$cod)echo"<option selected value='$cod'>$nom</option>";
		else echo"<option value='$cod'>$nom</option>";
	}
	echo"</select>
	</td>
	<td align=center>
	<select class='caja' name=tipoimpre>
	<option value=''></option>
	<option $ch1=''; value='1'>HTML</option>
	<option $ch2=''; value='2'>PDF</option>
	<option $ch3=''; value='3'>EXCEL</option>
	</select>
	</td>
	
	</tr>
	<tr><th colspan=4><input type=button value=buscar onclick='cambio()'>
	</td></tr>
	</table>
	<br>";
	
	if($tipoimpre==1)
	{
		if($contrato=='00')$cad="";
		else $cad="AND ((citas.Cotra_citas)='$contrato')";
		$bdatos=mysql_query("SELECT municipio.CODI_MUN, municipio.NOMB_MUN, usuario.NROD_USU, esta_cita.descrip_estaci, cups_citas_medicas.codi_cup, 
		cups_citas_medicas.Nombre, citas.Fsolusu_citas, citas.fecdeseada, horarios.Fecha_horario
		FROM ((((((horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) INNER JOIN destipos ON areas.codi_des = destipos.codi_des) INNER JOIN cups_citas_medicas ON destipos.codi_des = cups_citas_medicas.especialidad) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU) LEFT JOIN municipio ON areas.muni_area = municipio.CODI_MUN) INNER JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci
		WHERE (((horarios.Fecha_horario)>='$fecini' And (horarios.Fecha_horario)<='$fecfin') AND ((areas.arci_area)='5801') $cad)");
		if(mysql_num_rows($bdatos)>0)
		{
			echo"<table class='tbl' align=center>
			<tr>
			<th>C&Oacute;DIGO MUNICIPIO</th>
			<th>MUNICIPIO</th>
			<th>ID PACIENTE</th>
			<th>ESTADO CITA</th>
			<th>CODIGO DEL SERVICIO (CUPS)</th>
			<th>SERVICIO PRESTADO</th>
			<th>FECHA SOLICITUD</th>
			<th>FECHA DESEADA POR EL USUARIO</th>
			<th>FECHA ASIGNACI&Oacute;N</th>
			</tr>";
			while($rdatos=mysql_fetch_array($bdatos))
			{
				$codmuni=$rdatos['CODI_MUN'];
				$nommuni=$rdatos['NOMB_MUN'];
				$documen=$rdatos['NROD_USU'];
				$estado=$rdatos['descrip_estaci'];
				$codicup=$rdatos['codi_cup'];
				$nomcup=$rdatos['Nombre'];
				$fsolicitud=date("d/m/Y", strtotime($rdatos['Fsolusu_citas']));
				$fecdeseada=date("d/m/Y", strtotime($rdatos['fecdeseada']));
				$fechaatencion=date("d/m/Y", strtotime($rdatos['Fecha_horario']));
				
				

				echo"
				<tr>
				<td align=center>$codmuni</td>
				<td>$nommuni</td>
				<td>$documen</td>
				<td>$estado</td>
				<td align=center>$codicup</td>
				<td>$nomcup</td>
				<td align=center>$fsolicitud</td>
				<td align=center>$fecdeseada</td>
				<td align=center>$fechaatencion</td>
				</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo"<table class='tbl' align=center>
			<tr>
			<th colspan=2>NO SE ENCOTRARON REGISTROS PARA SU BUSQUEDA</td>	
			</tr>
			</table>";			
		}
	}
	echo"<form>
	<br><br><br>";
?>
</body>
</html>