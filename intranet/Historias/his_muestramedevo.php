<html>
<head><title>Consulta medicos que evolucionan</title>
<?
//Aqui cargo las funciones
//include("funciones.php");
include ('php/conexion2.php');
?>
</head>
<body >
<table bgcolor='#FFCC66' width='100%'><tr><td align='center'><b>Medicos que evolucionan al paciente</td></tr></table>
<br>
<?
$consulta=mysql_query("SELECT ih.id_ing,ih.caac_ing,
usu.nrod_usu,usu.pnom_usu,usu.snom_usu,usu.pape_usu,usu.sape_usu,
con.neps_con,
cam.nomb_des AS cama
FROM ingreso_hospitalario AS ih
INNER JOIN hist_traza AS tra ON tra.id_ing=ih.id_ing
INNER JOIN usuario AS usu ON usu.codi_usu=ih.codius_ing
INNER JOIN contrato AS con ON con.codi_con=ih.contra_ing
INNER JOIN destipos AS cam ON cam.codi_des=ih.caac_ing
WHERE ih.id_ing='$ingreso'");
$row=mysql_fetch_array($consulta);
$nombre=$row[pnom_usu]." ".$row[snom_usu]." ".$row[pape_usu]." ".$row[sape_usu];
echo "<Table border=0 BgColor=#ffffff BorderColor=#E6E8FA width=100% align=center cellpadding=0 Cellspacing=0>";
echo "<tr>";
echo "<td align='left'><b>Nombre del Paciente:</td>";
echo "<td align='left'><b>Cama:</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><font size='2'>$nombre</td>";
echo "<td align='left'><font size='2'>$row[cama]</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
if(mysql_num_rows($consulta)==0){
   echo "<center><h2>Usuario no Encontrado</h2></center>";
}
else{
  echo "<Table border=0 BgColor=#0099CC BorderColor=#E6E8FA width=100% align=center cellpadding=0 Cellspacing=0>";
  echo "<th width='60%'><font color='#ffffff'>Profesional</th>
        <th width='40%'><font color='#ffffff'>Especialidad</th>";
  $consultaevo=mysql_query("SELECT med.nom_medi,esp.nomb_des as especialidad
  FROM hist_evo AS evo
  INNER JOIN medicos AS med ON med.cod_medi=evo.cod_medi
  LEFT JOIN destipos AS esp ON esp.codi_des=med.espe_med
  WHERE evo.fech_evo='$fecha' and evo.id_ing=$ingreso");
  if(mysql_num_rows($consultaevo)<>0){
	while($rowevo=mysql_fetch_array($consultaevo)){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='#ffffff';}
	  echo "<tr>";
	  echo "<td align='left' bgcolor='$color'><font size=2>$rowevo[nom_medi]</font></td>";
	  echo "<td align='left' bgcolor='$color'><font size=2>$rowevo[especialidad]</font></td>";
	  echo "</tr>";
	}
  }
  echo "</table>";
}
?>
<br><center><input type='button' name='btn1' value='Cerrar' onclick='window.close()'></center>
</body>
</html>
