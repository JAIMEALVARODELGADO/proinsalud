<html>
<head><title>Consulta de Personas</title>
</head>
<body >

<FORM METHOD="POST" ><br>
<?
include ('php/funciones.php');
//Conexion con la base
include ('php/conexion.php');

$condicion="";
if(!empty($cod_medi)){
  $condicion=$condicion."cod_medi='$cod_medi' and ";
}
if(!empty($nom_medi)){
  $condicion=$condicion."nom_medi LIKE '%$nom_medi%' and ";
}
if(!empty($ced_medi)){
  $condicion=$condicion."ced_medi='$ced_medi'  and ";
}
if(!empty($esta_medi)){
  $condicion=$condicion."esta_medi='$esta_medi' and ";
}
if(substr($condicion,strlen($condicion)-5,5)==' and '){
   $condicion=substr($condicion,0,strlen($condicion)-5);
}
//Aqui realizo la consulta de los radicados
if(!empty($condicion)){
  $consulta=mysql_query("SELECT cod_medi,nom_medi,dir__medi,telf_medi,esta_medi FROM medicos WHERE $condicion ORDER BY '$orden'");}
else{
  $consulta=mysql_query("SELECT cod_medi,nom_medi,dir__medi,telf_medi,esta_medi FROM medicos ORDER BY '$orden'");}

?>
  <center><h2>Datos de la Persona</h2></center>
  <Table border="0" BgColor="#FFFFFF" BorderColor=#E6E8FA width="100%" align="center" cellpadding=0 Cellspacing=1>
  <th bgcolor="#D0D0F0" colspan=1>Codigo</th><th bgcolor="#D0D0F0">Nombre</th><th bgcolor="#D0D0F0">Dirección</th><th bgcolor="#D0D0F0">Teléfono</th><th bgcolor="#D0D0F0">Estado</th><th bgcolor="#D0D0F0" colspan='3'>Opciones</th></TR>
  <?  
  $colfondo="#D8E5F9";
  while($row=mysql_fetch_array($consulta)){
  $nom_est=estado(substr($row[esta_medi],0,1));
  echo "<tr>";
  echo "<td width='10%' align='left' bgcolor=$colfondo><font size=2>$row[cod_medi]</font></td>"; 
  echo "<td width='35%' align='left' bgcolor=$colfondo><font size=2>$row[nom_medi]</font></td>";
  echo "<td width='25%' align='left' bgcolor=$colfondo><font size=2>$row[dir__medi]</font></td>";
  echo "<td width='10%' align='left' bgcolor=$colfondo><font size=2>$row[telf_medi]</font></td>";
  echo "<td width='5%' align='left' bgcolor=$colfondo><font size=2>".$nom_est."</font></td>";
  echo "<td width='5%' align=center bgcolor=$colfondo><a href='per_muesaremed.php?cod_medi=$row[cod_medi]'><img hspace=5 width=25 height=25 src='imagenes\VIEWER6.ico' alt='Areas del Médico' border=0></a></td>";
  echo "<td width='5%' align=center bgcolor=$colfondo><a href='per_modiper.php?cod_medi=$row[cod_medi]'><img hspace=5 width=25 height=25 src='imagenes\Notepad Green.ico' alt='Modificar' border=0></a></td>";
  if($row[esta_medi]=='A'){
	echo "<td width='5%' align=center bgcolor=$colfondo><a href='per_estaper.php?cod_medi=$row[cod_medi]&esta_medi=$row[esta_medi]'><img hspace=5 width=22 height=22 src='imagenes\inactivar.ico' alt='Inctivar' border=0></a></td>";}
  else{
	echo "<td width='5%' align=center bgcolor=$colfondo><a href='per_estaper.php?cod_medi=$row[cod_medi]&esta_medi=$row[esta_medi]'><img hspace=5 width=22 height=22 src='imagenes\activar.ico' alt='Activar' border=0></a></td>";}  
  echo "</tr>";
  if ($colfondo=="#D8E5F9"){
    $colfondo="#FAFAD4";}
  else{
    $colfondo="#D8E5F9";}
  }
  mysql_free_result($consulta);
  mysql_close();
  ?>
  </table>
</body>
</html>