<?php
session_start();
$usucitas=$_SESSION['usucitas'];
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 

?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
	function salto1()
	{
		uno.action='consu_medico.php';
        uno.target='';
        uno.submit();	
	}
    
	function busbene(id)
	{
		
		uno.cedula.value=id;		
		uno.action='asigna0.php';
        uno.target='area';
        uno.submit();	
	}
</script>
</head>
<body style='position:absolute;margin-top:10'>
<style>

</style> 
<?php	
    //onload="setScrollPos('conte')"
    set_time_limit(300);
	
    include ('php/conexion1.php');
	$busarea=mysql_query("SELECT horarios_agenda_med.area, areas.nom_areas
	FROM areas INNER JOIN horarios_agenda_med ON areas.cod_areas = horarios_agenda_med.area
	WHERE (((horarios_agenda_med.estado)='AC'))
	GROUP BY horarios_agenda_med.area, areas.nom_areas
	ORDER BY areas.nom_areas");
	$numrec=mysql_num_rows($busarea);
	 echo"<br><form name=uno method=post>
	 <table align=center width=30%>
    <tr><td>
    <table align=center class='tbl' width=100%>
    <tr><th colspan=2>BUSCA AGENDA MEDICO</th></tr>
	<tr><th width=50% align=center>AREA</td>";
	echo"<td align=center><select class=caja name=areamedica onchange='salto1()'>
	<option value=''></option>";	
	while($rare=mysql_fetch_array($busarea))
	{        
		
		$artra=$rare['area'];
		$nomareatra=$rare['nom_areas'];
		if($artra===$areamedica)echo"<option selected value='$artra'>$artra $nomareatra</option>";
		else echo"<option value='$artra'>$artra $nomareatra</option>";			
	}
	echo"</select>
	</td>		
	</tr>
    </table>";
	
	
	
	$busmed=mysql_query("SELECT horarios_agenda_med.medico, medicos.nom_medi
	FROM horarios_agenda_med INNER JOIN medicos ON horarios_agenda_med.medico = medicos.cod_medi
	WHERE (((horarios_agenda_med.area)='$areamedica') AND ((horarios_agenda_med.estado)='AC'))
	GROUP BY horarios_agenda_med.medico, medicos.nom_medi
	ORDER BY medicos.nom_medi");
	$numrec=mysql_num_rows($busmed);
	 echo"<br>
    <table align=center class='tbl' width=100%><tr>
	<th width=50% align=center>MEDICO</td>";
	echo"<td align=center><select class=caja name=medica onchange='salto1()'>
	<option value=''></option>";	
	while($rmed=mysql_fetch_array($busmed))
	{        
		
		$cmed=$rmed['medico'];
		$nmed=$rmed['nom_medi'];
		if($cmed==$medica)echo"<option selected value='$cmed'>$nmed</option>";
		else echo"<option value='$cmed'>$nmed</option>";			
	}
	echo"</select>
	</td>		
	</tr>
    </table>";
	
	$busage=mysql_query("SELECT horarios_agenda_med.medico, medicos.nom_medi, areas.nom_areas, horarios_agenda_med.hora_ini, horarios_agenda_med.hora_fin, 
	horarios_agenda_med.lun, horarios_agenda_med.mar, horarios_agenda_med.mie, horarios_agenda_med.jue, horarios_agenda_med.vie, horarios_agenda_med.sab, 
	horarios_agenda_med.direccion
	FROM (horarios_agenda_med INNER JOIN medicos ON horarios_agenda_med.medico = medicos.cod_medi) INNER JOIN areas ON horarios_agenda_med.area = areas.cod_areas
	WHERE (((horarios_agenda_med.medico)='$medica') AND ((horarios_agenda_med.estado)='AC'))
	ORDER BY medicos.nom_medi");
	$numrec=mysql_num_rows($busage);
	if($numrec>0)
	{
		echo"<br>
		<table align=center class='tbl' width=100%>
		<tr><th align=center>MEDICO</td>
		<th align=center>AREA</td>
		<th align=center>HORARIO</td>
		<th align=center>LUN</td>
		<th align=center>MAR</td>
		<th align=center>MIE</td>
		<th align=center>JUE</td>
		<th align=center>VIE</td>
		<th align=center>SAB</td>
		<th align=center>DIRECCION</td>
		</tr>
		";		
		while($rage=mysql_fetch_array($busage))
		{        
			
			$nom_medi=$rage['nom_medi'];
			$nom_areas=$rage['nom_areas'];
			$hora_ini=$rage['hora_ini'];
			$hora_fin=$rage['hora_fin'];
			$lun=$rage['lun'];
			$mar=$rage['mar'];
			$mie=$rage['mie'];
			$jue=$rage['jue'];
			$vie=$rage['vie'];
			$sab=$rage['sab'];
			$direccion=$rage['direccion'];
			
			$horario=substr($hora_ini,0,5).' a '.substr($hora_fin,0,5);
			
			if($lun=='1')$lun='X';
			if($mar=='1')$mar='X';
			if($mie=='1')$mie='X';
			if($jue=='1')$jue='X';
			if($vie=='1')$vie='X';
			if($sab=='1')$sab='X';
			echo"
			<tr>
			<td>$nom_medi</td>
			<td>$nom_areas</td>
			<td>$horario</td>
			<td>$lun</td>
			<td>$mar</td>
			<td>$mie</td>
			<td>$jue</td>
			<td>$vie</td>
			<td>$sab</td>
			<td>$direccion</td>
			</tr>";
					
		}		
		echo"</table>";
	}
	else
	{
		echo"<table align=center class='tbl' width=100%>
		<tr><th align=center>NO SE ENCONTRARON REGISTROS</td></tr>
		</table>";
		
	}
?>
</body>
</html><html><head></head><body></body></html>