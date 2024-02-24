<html>
<head>
<title>PROGRAMA DE FACTURACI�N</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function validar(){    
    document.form1.submit();    
}
</script>
</head>
<body>
<form name='form1' method="POST" action='fac_4hevalidarips.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>Listado de R I P S</td></tr></table>
<?php
include('php/conexion.php');
include('php/funciones.php');
$condicion="";
if(!empty($factura)){
  $condicion=$condicion."ef.nume_fac='$factura' AND ";}
if(!empty($relacion)){
  $condicion=$condicion."ef.rela_fac='$relacion' AND ";}
if(!empty($pref_fac)){
  $condicion=$condicion."ef.pref_fac='$pref_fac' AND ";}

if(!empty($condicion)){$condicion=substr($condicion,0,strlen($condicion)-5);}
//echo $condicion;
$consulta="SELECT ef.nume_fac,ef.id_ing,ef.feci_fac,ef.vnet_fac,ef.iden_fac,
 us.tdoc_usu,us.nrod_usu,us.pnom_usu,us.snom_usu,us.pape_usu,us.sape_usu
 FROM encabezado_factura AS ef
 INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
 WHERE $condicion ORDER BY ef.nume_fac";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
  echo "<table class='Tbl0' border='0'>";
  echo "<th class='Th0' width='10%'>Sel</th>
        <th class='Th0' width='10%'>Factura</th>
        <th class='Th0' width='10%'>Fecha Cierre</th>
	<th class='Th0' width='15%'>Identificaci�n</th>
	<th class='Th0' width='45%'>Nombre</th>
	<th class='Th0' width='10%'>Valor</th>";
  while($row=mysql_fetch_array($consulta)){
    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
        $nombre=$row[pnom_usu]." ".$row[snom_usu]." ".$row[pape_usu]." ".$row[sape_usu];
        echo "<tr>";
        echo "<td class='Td2' align='center' bgcolor='$color'><a href='fac_4hemuestracons.php?factura=$row[nume_fac]&iden_fac=$row[iden_fac]'><img src='icons/feed_edit.png' alt='Editar Rips'></a></td>";
        echo "<td class='Td2' align='left' bgcolor='$color'>$row[nume_fac]</td>";
        echo "<td class='Td2' align='left' bgcolor='$color'>".cambiafechadmy($row[feci_fac])."</td>";
        echo "<td class='Td2' align='left' bgcolor='$color'>$row[nrod_usu]</td>";
        echo "<td class='Td2' align='left' bgcolor='$color'>$nombre</td>";
        echo "<td class='Td2' align='right' bgcolor='$color'>$row[vnet_fac]</td>";
        echo"</tr>";
  }
  echo "</table>";
  //echo "<br><center><a href='#' onclick='submit()'><img src='icons/786925856.png' height='20' width='20' alt='Validar y generar archivos planos'>Validar y Generar Archivos Planos</a></center>";
  echo "<br><center><a href='#' onclick='validar()'><img src='icons/786925856.png' height='20' width='20' alt='Validar y generar archivos planos'>Validar y Generar Archivos Planos</a></center>";
  ?>
  <!--<br><center><button onclick='validar()' name='Validar'><img src='icons/786925856.png' height='20' width='20' alt='Validar y generar archivos planos'>Validar y Generar Archivos Planos</center>-->
  <?php
}
else{
  echo "<center>";
  echo "<p class=Msg>No existen registros para esta busqueda</p>";
  echo "</center>";
}
echo "<input type='hidden' name='pref_fac' value='$pref_fac'>";
echo "<input type='hidden' name='factura' value='$factura'>";
echo "<input type='hidden' name='relacion' value='$relacion'>";
mysql_free_result($consulta);
mysql_close();
?>
</form>
</body>
</html>

