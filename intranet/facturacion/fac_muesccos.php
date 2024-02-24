<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language="javaScript">
function eliminar(codi_){
    if (confirm("Desea Eliminar el registro?\n"+codi_)){
        location.href='fac_elimccos.php?codi_cdc='+codi_;
    }
}
</script>

</head>
<body>
<form name="form1" method="POST" action="busq_mapii.php" target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>CENTROS DE COSTOS</td></tr></table>
<?
//echo "$cod";
include('php/conexion.php');
$condicion="";
if(!empty($cod)){
    $condicion=$condicion."codi_cdc='$cod' AND ";}
if(!empty($nom)){
    $condicion=$condicion."nomb_cdc LIKE '%$nom%' AND ";}
if(!empty($condicion)){
    $condicion=substr($condicion,0,(strlen($condicion)-5));
}
//echo $condicion;

if(!empty($condicion)){
    $consulta="SELECT codi_cdc,nomb_cdc FROM centros_costo WHERE $condicion ORDER BY nomb_cdc";}
else{
    $consulta="SELECT codi_cdc,nomb_cdc FROM centros_costo ORDER BY nomb_cdc";}
//echo $consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0) {
    echo "<table class='Tbl0'>";
    echo "<th class='Th0' width='10%' colspan='2'>OP</th>
        <th class='Th0' width='10%'>CODIGO</font></th>
	<th class='Th0' width='80%'>NOMBRE</font></th>";
    while($row=mysql_fetch_array($consulta)){
        echo "<tr>";
        echo "<td class='Td4'><a href='#' onclick='javascript:eliminar(\"$row[codi_cdc]\")'><img src='icons/feed_delete.png' border='0' alt='Eliminar'></a></td>";
        echo "<td class='Td4'><a href='fac_editaccos.php?codi_cdc=$row[codi_cdc]'><img src='icons/feed_edit.png' border='0' alt='Editar'></a></td>";
        echo "<td class='Td2'>$row[codi_cdc]</td>";
        echo "<td class='Td2'>$row[nomb_cdc]</td>";
        echo"</tr>";
    }
    echo "</table>";
    echo "<table class='Tbl2'>";
    echo "<tr>";
    echo "<td class='Td1'></td>";
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