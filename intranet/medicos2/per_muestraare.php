<html>
<head><title>Consulta de Areas</title>
</head>
<body >

<FORM METHOD="POST" ><br>
<?
include ('php/funciones.php');
//Conexion con la base
include ('php/conexion.php');
//selección de la base de datos con la que vamos a trabajar 
//mysql_select_db("proinsalud");
$condicion="";
if(!empty($cod_areas)){
  $condicion=$condicion."cod_areas=$cod_areas and ";
}
if(!empty($nom_areas)){
  $condicion=$condicion."nom_areas LIKE '%$nom_areas%'";
}
if(substr($condicion,strlen($condicion)-5,5)==' and '){
   $condicion=substr($condicion,0,strlen($condicion)-5);
}
//Aqui realizo la consulta de las especialidades
if(!empty($condicion)){
  $consulta=mysql_query("SELECT cod_areas,nom_areas,tipo_areas,clas_areas FROM areas WHERE $condicion ORDER BY $orden");}
else{
  $consulta=mysql_query("SELECT cod_areas,nom_areas,tipo_areas,clas_areas FROM areas ORDER BY $orden");}
?>
  <center><h2>Areas</h2></center>
  <Table border="0" BgColor="#FFFFFF" BorderColor=#E6E8FA width="80%" align="center" cellpadding=0 Cellspacing=1>
  <th bgcolor="#D0D0F0" colspan=1>Codigo</th><th bgcolor="#D0D0F0">Nombre</th><th bgcolor="#D0D0F0">Tipo</th><th bgcolor="#D0D0F0">Clase</th><th bgcolor="#D0D0F0" colspan='3'>Opciones</th></TR>
  <?  
  $colfondo="#D8E5F9";
  while($row=mysql_fetch_array($consulta)){
    echo "<tr>";
	$nom_tip=tipo_are($row[tipo_areas]);
	$nom_cla=clas_are($row[clas_areas]);
    echo "<td width='10%' align='left' bgcolor=$colfondo><font size=2>$row[cod_areas]</font></td>"; 
    echo "<td width='50%' align='left' bgcolor=$colfondo><font size=2>$row[nom_areas]</font></td>";
    echo "<td width='15%' align='left' bgcolor=$colfondo><font size=2>$nom_tip</font></td>"; 
    echo "<td width='15%' align='left' bgcolor=$colfondo><font size=2>$nom_cla</font></td>";	
    echo "<td width='10%' align=center bgcolor=$colfondo><a href='per_modiare.php?cod_areas=$row[cod_areas]'><img hspace=5 width=25 height=25 src='imagenes\Notepad Green.ico' alt='Modificar' border=0></a></td>";
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