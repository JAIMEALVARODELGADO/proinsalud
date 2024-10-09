<html>
<head><title>Consulta de Personas</title>
</head>
<body >

<FORM METHOD="POST" ><br>
<?php
include ('php/funciones.php');
//Conexion con la base
include ('php/conexion.php');

//numer_iden
//nombre
$condicion="";
if(!empty($numer_iden)){
  $condicion=$condicion."numer_iden='$numer_iden' and ";
}
if(!empty($nombre)){
  $condicion=$condicion."CONCAT(pnombre,' ',snombre,' ',papellido,' ',sapellido) LIKE '%$nombre%' and ";
}

if(substr($condicion,strlen($condicion)-5,5)==' and '){
   $condicion=substr($condicion,0,strlen($condicion)-5);
}
//echo $condicion;
//Aqui realizo la consulta de los radicados
if(!empty($condicion)){
  $consulta="SELECT id_persona,numer_iden,CONCAT(pnombre,' ',snombre,' ',papellido,' ',sapellido) AS nombre ,direccion,telefono FROM persona WHERE $condicion ORDER BY '$orden'";}
else{
  $consulta="SELECT id_persona,numer_iden,CONCAT(pnombre,' ',snombre,' ',papellido,' ',sapellido) AS nombre ,direccion,telefono FROM persona ORDER BY '$orden'";}

//echo $consulta;
$consulta=mysql_query($consulta);
?>
  <center><h2>Datos de la Persona</h2></center>
  <Table border="0" BgColor="#FFFFFF" BorderColor=#E6E8FA width="100%" align="center" cellpadding=0 Cellspacing=1>
  <th bgcolor="#D0D0F0">Identificaci�n</th>
  <th bgcolor="#D0D0F0">Nombre</th>
  <th bgcolor="#D0D0F0">Direcci�n</th>
  <th bgcolor="#D0D0F0">Tel�fono</th>
  <th bgcolor="#D0D0F0" colspan='3'>Opciones</th>


  <?php
  $colfondo="#D8E5F9";
  while($row=mysql_fetch_array($consulta)){
    echo "<tr>";
    echo "<td width='10%' align='left' bgcolor=$colfondo><font size=2>$row[numer_iden]</font></td>"; 
    echo "<td width='35%' align='left' bgcolor=$colfondo><font size=2>$row[nombre]</font></td>";
    echo "<td width='25%' align='left' bgcolor=$colfondo><font size=2>$row[direccion]</font></td>";
    echo "<td width='10%' align='left' bgcolor=$colfondo><font size=2>$row[telefono]</font></td>";    
    echo "<td width='5%' align=center bgcolor=$colfondo><a href='per_modipertmp.php?id_persona=$row[id_persona]'><img hspace=5 width=25 height=25 src='imagenes\Notepad Green.ico' alt='Modificar' border=0></a></td>";
    echo "</tr>";
    if ($colfondo=="#D8E5F9"){
      $colfondo="#CDD6E2";}
    else{
      $colfondo="#D8E5F9";}
  }
  mysql_free_result($consulta);
  mysql_close();
  ?>
  </table>
</body>
</html>