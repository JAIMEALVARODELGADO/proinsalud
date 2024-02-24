<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<script language='javascript'>
function mostrar(){
  alert("uno");
}
</script>
<body>
<table class='Tbl0'><tr><td class='Td0' align='center'>LISTADO DE MEDICOS</td></tr></table>
<?
include('php/funciones.php');
include('php/conexion.php');
$condicion="";
if(!empty($cod_medi)){
  $condicion=$condicion."cod_medi='$cod_medi' AND ";}
if(!empty($nom_medi)){
  $condicion=$condicion."nom_medi LIKE '%$nom_medi%' AND ";}
if(!empty($condicion)){
  $condicion=substr($condicion,0,(strlen($condicion)-5));
}
echo "<table class='Tbl0'>";
echo "<th class='Th0' width='5%'>Opc</th>
      <th class='Th0' width='15%'>CODIGO</th>
	  <th class='Th0' width='50%'>NOMBRE</th>
	  <th class='Th0' width='15%'>CONS.PRIM</th>
	  <th class='Th0' width='15%'>CONS.CONTR</th>";
$consultamed=mysql_query("SELECT cod_medi,nom_medi,mapip_med,mapic_med FROM medicos WHERE $condicion");
if(mysql_num_rows($consultamed)<>0){
  while($rowmed=mysql_fetch_array($consultamed)){
    echo "<tr>";
	echo "<td class='Td2'><a href='fac_editamap.php?cod_medi=$rowmed[cod_medi]'><img src='icons/feed_edit.png' border='0' alt='Editar Códigos de Consulta'></a></td>";
    echo "<td class='Td2'>$rowmed[cod_medi]</td>";
    echo "<td class='Td2'>$rowmed[nom_medi]</td>";
	if($rowmed[mapip_med]<>0){
	  $consultamap=mysql_query("SELECT desc_map FROM mapii WHERE iden_map=$rowmed[mapip_med]");
	  if(mysql_num_rows($consultamap)<>0){
	    $rowmap=mysql_fetch_array($consultamap);
		$consp=$rowmap[desc_map];
	  }
	}
	if($rowmed[mapic_med]<>0){
	  $consultamap=mysql_query("SELECT desc_map FROM mapii WHERE iden_map=$rowmed[mapic_med]");
	  if(mysql_num_rows($consultamap)<>0){
	    $rowmap=mysql_fetch_array($consultamap);
		$consc=$rowmap[desc_map];
	  }
	}
	echo "<td class='Td2'><a href='#' title='$consp'>$rowmed[mapip_med]</a></td>";
	echo "<td class='Td2'><a href='#' title='$consc'>$rowmed[mapic_med]</td>";
    echo "</tr>";
  }
}
else{
  echo "<center>";
  echo "<p class=Msg>No existen registros para esta busqueda</p>";
  echo "</center>";
}
echo "</table>";
mysql_free_result($consultamed);
mysql_close();
?>

</body>
</html>