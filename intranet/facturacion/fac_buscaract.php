<html>
<head><title>Busca Procedimientos</title>
<script language='javascript'>
  var x=screen.availWidth-400;
  window.moveTo(x,200);

function cerrar(){
  window.close();
}
</script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<body>
<form name='form1' action='fac_buscaract'>
<table class="Tbl0"><tr><td class="Td0" align='center'>BUSQUEDA DE PROCEDIMIENTOS <?echo $tarifario;?></td></tr></table>
<table class="Tbl0" border='0'>
<th class='Th0' width='15%'>Código</th>
<th class='Th0' width='70%'>Nombre</th>
<th class='Th0' width='15%'></th>
<tr>
  <td class="Td2" align='center'><input type="text" name="codigo" size="8" maxlength="10" value='<?echo $codigo;?>'></td>
  <td class="Td2" align='center'><input type="text" name="nombre" size="40" maxlength="40" value='<?echo $nombre;?>'></td>
  <td class="Td2" align='center'><input type="submit" value="Buscar"></td>
</tr>
</table>
<?
//Conexion con la base
include ('php/conexion.php');
$condicion="";
if(!empty($codigo)){
  if($tarifario=='cups'){$condicion=$condicion."codigo like '%$codigo%' and ";}
  if($tarifario=='soat'){$condicion=$condicion."codi_tar like '%$codigo%' and ";}
  if($tarifario=='iss_1'){$condicion=$condicion."codi_tar like '%$codigo%' and ";}
  if($tarifario=='iss_4'){$condicion=$condicion."codi_tar like '%$codigo%' and ";}
}
if(!empty($nombre)){
  if($tarifario=='cups'){$condicion=$condicion."descrip like '%$nombre%'";}
  if($tarifario=='soat'){$condicion=$condicion."desc_tar like '%$nombre%'";}
  if($tarifario=='iss_1'){$condicion=$condicion."desc_tar like '%$nombre%'";}
  if($tarifario=='iss_4'){$condicion=$condicion."desc_tar like '%$nombre%'";}
}
if(substr($condicion,strlen($condicion)-5,5)==' and '){
   $condicion=substr($condicion,0,strlen($condicion)-5);
}
if(!empty($condicion)){
  //echo $tarifario;
  if($tarifario=='cups'){$consulta="SELECT codi_cup as codi_cup,codigo as codigo ,descrip as descrip FROM cups WHERE $condicion ORDER BY descrip";}
  if($tarifario=='soat'){$consulta="SELECT codi_tar as codigo,desc_tar as descrip FROM soat WHERE $condicion ORDER BY desc_tar";}
  if($tarifario=='iss_1'){$consulta="SELECT codi_tar as codigo,desc_tar as descrip FROM iss1 WHERE $condicion ORDER BY desc_tar";}
  if($tarifario=='iss_4'){$consulta="SELECT codi_tar as codigo,desc_tar as descrip FROM iss4 WHERE $condicion ORDER BY desc_tar";}
  $consulta=mysql_query($consulta);
  echo "<br>";
  echo "<table class='Tbl0' border='0'>";
  //echo "<th bgcolor=#D0D0F0><font size='2'>Código</font></th><th bgcolor=#D0D0F0><font size='2'>Nombre</font></th>";
  $colfondo="#CCCCCC";  
  echo "<th>Codigo</th>"; 
  echo "<th>CUPS</th>";
  echo "<th>Descriocuion</th>";
  while($row=mysql_fetch_array($consulta)){
    echo "<tr>";    
    echo "<td width=10% align=left bgcolor=$colfondo><font size='2' face=arial>".$row['codigo']."</font></td>";
    echo "<td width=10% align=left bgcolor=$colfondo><font size='2' face=arial>".$row['codi_cup']."</font></td>";
    echo "<td width=80% align=left bgcolor=$colfondo><font size='1' face=arial>".$row['descrip']."</font></td>";
    echo "</tr>";
    if ($colfondo=="#CCCCCC"){
      $colfondo="#DFDFDF";}
    else{
      $colfondo="#CCCCCC";}
  }
  echo "</table>";
  mysql_free_result($consulta);
}
echo "<input type='hidden' name='tarifario' value='$tarifario'>";
mysql_close();
?>
<br>
<center><input type="button" value="Cerrar" onclick='cerrar()'></center>

</form>
</body>
</html>
