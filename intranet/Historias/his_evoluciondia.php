<html>
<head><title>Consulta de Evoluciones</title>
<SCRIPT LANGUAGE=JavaScript>
function validar(){
var error='';
  if(form1.fecha.value==''){error='Fecha\n';}
  if(error!=''){
    alert("Debe digitar la siguiente información\n"+error);
  }
  else{
   form1.submit(); 
  }
}
function mostrar(fecha_,ingreso_){
var url="his_muestramedevo.php?fecha="+fecha_+"&ingreso="+ingreso_;
//alert(form1.evento.clientX);
  window.open(url,"ventana1","width=400,height=250,scrollbars=1,top=250,left=250") 
}
</SCRIPT>
<?
//Aqui cargo las funciones
include("funciones.php");
include ('php/conexion2.php');
if(empty($fecha)){$fecha=hoy();}
?>
</head>
<body >
<form name='form1' method="POST" action='his_evoluciondia.php'>
<table bgcolor='#FFCC66' width='100%'><tr><td align='center'><b>Evoluciones del Dia</td></tr></table>
<br>
<center>
<table>
  <tr>
    <td align='right'><b>Fecha: </td>
	<td align='left'><input type='text' name='fecha' size='10' value='<?echo $fecha;?>'></td>
    <td align='right'><b>Identificacion: </td>
	<td align='left'><input type='text' name='cedula' size='10' value='<?echo $cedula;?>'></td>
	<td align='left'><a href='#' onclick='validar()'><img src='img\feed_magnify.png' border=0></a></td>
  </tr>
</table>
</center>
<br>
<?
$fecha=cambiafecha($fecha);
$condicion='tra.horas_tra=-1 and ';
if(!empty($cedula)){
  $condicion=$condicion."usu.nrod_usu='$cedula' and ";
}
$condicion=substr($condicion,0,strlen($condicion)-5);
$consulta=mysql_query("SELECT ih.id_ing,ih.caac_ing,
usu.nrod_usu,usu.pnom_usu,usu.snom_usu,usu.pape_usu,usu.sape_usu,
tra.horas_tra,
con.neps_con,
cam.nomb_des AS cama
FROM ingreso_hospitalario AS ih
INNER JOIN hist_traza AS tra ON tra.id_ing=ih.id_ing
INNER JOIN usuario AS usu ON usu.codi_usu=ih.codius_ing
INNER JOIN contrato AS con ON con.codi_con=ih.contra_ing
INNER JOIN destipos AS cam ON cam.codi_des=ih.caac_ing
WHERE $condicion ORDER BY cama");

if(mysql_num_rows($consulta)==0){
   echo "<center><h2>Usuario no Encontrado</h2></center>";
}
else{
  echo "<Table border=0 BgColor=#0099CC BorderColor=#E6E8FA width=100% align=center cellpadding=0 Cellspacing=0>";
  echo "<th width='4%'><font color='#ffffff'>Opc</th>
        <th width='4%'><font color='#ffffff'>MGr</th>
        <th width='4%'><font color='#ffffff'>MEs</th>
        <th width='10%'><font color='#ffffff'>D.Identidad</th>
        <th width='43%'><font color='#ffffff'>Nombre</th>
		<th width='15%'><font color='#ffffff'>EPS</th>
		<th width='15%'><font color='#ffffff'>Servicio</th>
		<th width='5%'><font color='#ffffff'>Cama</th>";
  while($row=mysql_fetch_array($consulta)){
    $nombre=$row[pnom_usu].' '.$row[snom_usu].' '.$row[pape_usu].' '.$row[sape_usu];
	$mg="N";
	$me="N";
	if($color<>'#dddddd'){$color='#dddddd';}else{$color='#ffffff';}
	echo "<tr>";
	echo "<td align='center' bgcolor='$color'><a href='#' onclick='mostrar(\"$fecha\",\"$row[id_ing]\")'><img src='img\feed_magnify.png' width='15' height='15' alt='Mirar Profesionales que evolucionan al paciente' border='0'></a></td>";
	$consultaevo=mysql_query("SELECT evo.cod_medi,med.nom_medi,med.espe_med
	FROM hist_evo AS evo
	INNER JOIN medicos AS med ON med.cod_medi=evo.cod_medi
	WHERE evo.fech_evo='$fecha' and evo.id_ing=$row[id_ing]");
	if(mysql_num_rows($consultaevo)<>0){
	  while($rowevo=mysql_fetch_array($consultaevo)){
	    if($rowevo[espe_med]=='2655'){$mg='S';}
		if($rowevo[espe_med]<>'2655'){$me='S';}
	  }
	  if($mg=='S'){
	    echo "<td align='center' bgcolor='$color'><img src='icons\boton_verde.png' width='12' height='12' alt='Atendido por MG'></td>";}
	  else{
	    echo "<td align='center' bgcolor='$color'><img src='icons\boton_rojo.png' width='12' height='12' alt='No Atendido por MG'></td>";}
	  if($me=='S'){
	    echo "<td align='center' bgcolor='$color'><img src='icons\boton_verde.png' width='12' height='12' alt='Atendido por ME'></td>";}
	  else{
	    echo "<td align='center' bgcolor='$color'><img src='icons\boton_rojo.png' width='12' height='12' alt='No Atendido por ME'></td>";}
	}
	else{
	  echo "<td align='center' bgcolor='$color'><img src='icons\boton_rojo.png' width='12' height='12' alt='No Atendido por ME'></td>";
	  echo "<td align='center' bgcolor='$color'><img src='icons\boton_rojo.png' width='12' height='12' alt='No Atendido por MG'></td>";
	}
	echo "<td align='left' bgcolor='$color'><font size=2>$row[nrod_usu]</font></td>";
	echo "<td align='left' bgcolor='$color'><font size=2>$nombre</font></td>";
	echo "<td align='left' bgcolor='$color'><font size=2>$row[neps_con]</font></td>";
    $consultaser=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des = (SELECT valo_des FROM destipos WHERE codi_des='$row[caac_ing]')");
	$rowser=mysql_fetch_array($consultaser);
	$servicio=$rowser[nomb_des];
	echo "<td align='left' bgcolor='$color'><font size=2>$servicio</td>";
	echo "<td align='center' bgcolor='$color'><font size=2>$row[cama]</td>";
	echo "</tr>";
  }
  echo "</table>";
}
?>
</form>
</body>
</html>
