<?php
session_start();
//session_register('gclase');
//session_register('gcod');
//session_register('gnom');
if ($control==1){
  $gclase=$clase;
  $gcod=$cod;
  $gnom=$nom;
}
//echo "<br>".$gclase."<br>".$gcod."<br>".$gnom;
?>

<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language="javaScript">
function eliminar(codeli)
{
if (confirm("Desea Eliminar el registro?\n"+codeli))
{
    location.href='eliminamapii.php?cod_mapi='+codeli;
}
}
</script>

</head>
<body>
<form name="form1" method="POST" action="busq_mapii.php" target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>PROCEDIMIENTOS E INSUMOS INSTITUCIONALES</td></tr></table>
<?php
//echo "$cod";
include('php/conexion.php');
$condicion="esta_cup='AC' AND ";
if(!empty($gclase)){
  $condicion=$condicion."clas_map='$gclase' AND ";}
if(!empty($gcod)){
  //$condicion=$condicion."codi_map LIKE '%$gcod%' AND ";}
  $condicion=$condicion."codi_cup LIKE '%$gcod%' AND ";}
if(!empty($gnom)){
  $condicion=$condicion."desc_map LIKE '%$gnom%' AND ";}
if(!empty($condicion)){
  $condicion=substr($condicion,0,(strlen($condicion)-5));
}
//echo $condicion;
	
if(!empty($condicion)){
	$consulta="SELECT iden_map, codi_map, desc_map, nivl_map, cconcir_map, clas_map , soat_map, iss1_map, iss4_map, form_map,valsoa_map,valiss_map,codi_cup,esta_cup
	FROM mapii 
	INNER JOIN cups ON cups.codigo=mapii.codi_map
	WHERE $condicion ORDER BY desc_map";}
else{
  $consulta="SELECT iden_map, codi_map, desc_map, nivl_map, cconcir_map, clas_map , soat_map, iss1_map, iss4_map, form_map,valsoa_map,valiss_map,codi_cup,esta_cup
  INNER JOIN cups ON cups.codigo=mapii.codi_map
  FROM mapii  ORDER BY desc_map";}
//echo $consulta;  
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0) {
  echo "<table class='Tbl0'>";
  echo "<th class='Th0' width='8%' colspan='2'>OP</th>
        <th class='Th0' width='10%'>CODIGO</font></th>
	<th class='Th0' width='32%'>DESCRIPCION</font></th>
	<th class='Th0' width='4%'>NIVEL</font></th>
	<th class='Th0' width='10%'>COD.CONTABLE</font></th>		
	<th class='Th0' width='8%'>SOAT</font></th>
	<th class='Th0' width='8%'>ISS01</font></th>
	<th class='Th0' width='10%'>Vr SOAT</font></th>
	<th class='Th0' width='10%'>Vr ISS01</font></th>
  <th class='Th0' width='10%'>Estado</font></th>";
  while($row=mysql_fetch_array($consulta)){
    echo "<tr>";
    echo "<td class='Td4'><a href='#' onclick='javascript:eliminar($row[codi_map])'><img src='icons/feed_delete.png' border='0' alt='Eliminar'></a></td>";
    echo "<td class='Td4'><a href='fac_editamapii.php?iden_map=$row[iden_map]'><img src='icons/feed_edit.png' border='0' alt='Editar'></a></td>";
    echo "<td class='Td2'>$row[codi_cup]</td>";
    echo "<td class='Td2'>$row[desc_map]</td>";
    echo "<td class='Td2'>$row[nivl_map]</td>";
    echo "<td class='Td2'>$row[cconcir_map]</td>";
    //echo "<td class='Td2'>$row[clas_map]</td>";
    echo "<td class='Td2'>$row[soat_map]</td>";
    echo "<td class='Td2'>$row[iss1_map]</td>";
    echo "<td class='Td2' align='right'>".number_format($row[valsoa_map])."</td>";
    echo "<td class='Td2' align='right'>".number_format($row[valiss_map])."</td>";    
    echo "<td class='Td2' align='right'>".$row[esta_cup]."</td>";    
    echo"</tr>";
  }
  echo "</table>";
  echo "<table class='Tbl2'>";
  echo "<tr>";
  echo "<td class='Td1'>".$_pagi_navegacion."</td>";
  echo "</tr>";
  echo "</table>";
}
else{
  echo "<center>";
  echo "<p class=Msg>No existen registros para esta busqueda</p>";
  echo "</center>";
}
mysql_close();
?>
</body>
</html>