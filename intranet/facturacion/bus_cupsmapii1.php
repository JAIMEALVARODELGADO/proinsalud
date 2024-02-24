<?php
session_register('codi_mapii');//codigo Cups
session_register('cod_con');
session_register('nive_map');
session_register('clas_map');
session_register('codi_soat');
session_register('is1_mapi');
session_register('is4_mapi');

if(!empty($ccon_)){
	$cod_con=$ccon_;}
if(!empty($nivl_)){
	$nive_map=$nivl_;}
if(!empty($sclas_mapii)){
	$clas_map=$sclas_mapii;}
if(!empty($cod_mapi)){
	$codi_mapii=$cod_mapi;}
if(!empty($soat_map)){
	$codi_soat=$soat_map;}
if(!empty($iss1_mapii)){
	$is1_mapi=$iss1_mapii;}
if(!empty($iss4_mapii)){
	$is4_mapi=$iss4_mapii;}
if(!empty($control)){
	$codi_mapii=$cod_mapi;}
	
  
?>

<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>

<SCRIPT LANGUAGE=JavaScript>
function validar(){
  form1.submit();
}

function vaciar(){
form1.cod_mapi.value='';
form1.desc_mapii.value='';
}

</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<form name="form1" method="POST" action="bus_cupsmapii.php" target='fr02'>
<body lang=ES  style='tab-interval:35.4pt'  >


<table class="Tbl0">
  <tr><td class="Td0" align='center'>BUSQUEDA CUPS</td></tr>
</table>
<br>
<center>
<table class="Tbl0">
<tr>
  <td class="Td2" align='right' width='20%'><b>Código:</td>
  <td class="Td2" align='left' width='20%'><input type='text' name='cod_mapi' size='10' maxlength='10' onfocus='vaciar()' value=<?echo $cod_mapi;?>></td>
  <td class="Td2" align='right' width='20%'><b>Descripción:</td>
  <td class="Td2" align='left' width='20%'><input type='text' name='desc_mapii' size='30' maxlength='30' onfocus='vaciar()' value='<?echo $desc_mapii;?>' ></td>
  <td class="Td2" align='left' width='10%'><a href='#' onclick='validar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td>
</tr>
</table>
</center>
<input type='hidden' name='control' value='1'>
<?

include('php/conexion.php');
echo $sclas_mapii;
echo $codi_mapii;
if ($clas_map=='0101' or $clas_map=='0102' or $clas_map=='0103' or $clas_map=='0104' or $clas_map=='0105' or $clas_map=='0106' or $clas_map=='0107' or $clas_map=='0108' or $clas_map=='0110' or $clas_map=='0114')
{
$condicion="";
if(!empty($codi_mapii)){
  $condicion=$condicion."codigo LIKE '%$codi_mapii%' AND ";}
if(!empty($desc_mapii)){
  $desc_mapii=trim($desc_mapii);
  $condicion=$condicion."descrip  LIKE '%$desc_mapii%' AND ";}
if(!empty($condicion)){
  $condicion=substr($condicion,0,(strlen($condicion)-5));
}

if(!empty($condicion)){
  $_pagi_sql="SELECT iden_tar, codigo, descrip FROM cups WHERE $condicion ORDER BY descrip";}
else{
  $_pagi_sql="SELECT iden_tar, codigo, descrip FROM cups ORDER BY descrip";}

$_pagi_cuantos = 15; 
include("php/paginator.inc.php"); 

if(mysql_num_rows($_pagi_result)!=0) {
  echo "<table class='Tbl0'>";
  echo "<th class='Th0' width='10%'>OPCIONES</th>
        <th class='Th0' width='15%'>CODIGO</font></th>
	    <th class='Th0' width='70%'>DESCRIPCION</font></th>";
	while($row=mysql_fetch_array($_pagi_result)){
    echo "<tr>";
	echo "<td><label><input name=codichk type=checkbox onclick=\"location.href='fac_creamapii.php?codi_mapii=$row[codigo]&des_mapi=$row[descrip]'\"></label></td>";
    echo "<td class='Td2'>$row[codigo]</td>";
    echo "<td class='Td2'>$row[descrip]</td>";
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
}
//medicamentos POS
//if ($clas_map=='0112')
//{
$condicion="pos_mdi='S' AND ";
if(!empty($codi_mapii)){
  $condicion=$condicion."codi_mdi LIKE '%$codi_mapii%' AND ";}
if(!empty($desc_mapii)){
  $desc_mapii=trim($desc_mapii);
  $condicion=$condicion."nomb_mdi LIKE '%$desc_mapii%' AND ";}
if(!empty($condicion)){
  $condicion=substr($condicion,0,(strlen($condicion)-5));
}

if(!empty($condicion)){
  $_pagi_sql="SELECT codi_mdi, nomb_mdi,pos_mdi  FROM medicamentos2 WHERE $condicion ORDER BY nomb_mdi";}
else{
  $_pagi_sql="SELECT codi_mdi, nomb_mdi FROM medicamentos2 ORDER BY nomb_mdi";}
//echo $_pagi_sql;
$_pagi_cuantos = 15; 
include("php/paginator.inc.php"); 

if(mysql_num_rows($_pagi_result)!=0) {
  echo "<table class='Tbl0'>";
  echo "<th class='Th0' width='10%'>OPCIONES</th>
        <th class='Th0' width='15%'>CODIGO</font></th>
	    <th class='Th0' width='70%'>DESCRIPCION</font></th>";
	while($row=mysql_fetch_array($_pagi_result)){
    echo "<tr>";
	echo "<td><label><input name=codichk type=checkbox onclick=\"location.href='fac_creamapii.php?codi_mapii=$row[codi_mdi]&des_mapi=$row[nomb_mdi]'\"></label></td>";
    echo "<td class='Td2'>$row[codi_mdi]</td>";
    echo "<td class='Td2'>$row[nomb_mdi]</td>";
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
  echo "<p class=Msg>El Medicamento NO esta en el Plan Obligatorio de Salud</p>";
  echo "</center>";
}
//}
//medicamentos NOPOS
//if ($clas_map=='0113')
//{
$condicion="pos_mdi='N' AND ";
if(!empty($codi_mapii)){
  $condicion=$condicion."codi_mdi LIKE '%$codi_mapii%' AND ";}
if(!empty($desc_mapii)){
  $desc_mapii=trim($desc_mapii);
  $condicion=$condicion."nomb_mdi LIKE '%$desc_mapii%' AND ";}
if(!empty($condicion)){
  $condicion=substr($condicion,0,(strlen($condicion)-5));
}

if(!empty($condicion)){
  $_pagi_sql="SELECT codi_mdi, nomb_mdi,pos_mdi  FROM medicamentos2 WHERE $condicion ORDER BY nomb_mdi";}
else{
  $_pagi_sql="SELECT codi_mdi, nomb_mdi FROM medicamentos2 ORDER BY nomb_mdi";}
//echo $_pagi_sql;
$_pagi_cuantos = 15; 
include("php/paginator.inc.php"); 

if(mysql_num_rows($_pagi_result)!=0) {
  echo "<table class='Tbl0'>";
  echo "<th class='Th0' width='10%'>OPCIONES</th>
        <th class='Th0' width='15%'>CODIGO</font></th>
	    <th class='Th0' width='70%'>DESCRIPCION</font></th>";
	while($row=mysql_fetch_array($_pagi_result)){
    echo "<tr>";
	echo "<td><label><input name=codichk type=checkbox onclick=\"location.href='fac_creamapii.php?codi_mapii=$row[codi_mdi]&des_mapi=$row[nomb_mdi]'\"></label></td>";
    echo "<td class='Td2'>$row[codi_mdi]</td>";
    echo "<td class='Td2'>$row[nomb_mdi]</td>";
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
  echo "<p class=Msg>El Medicamento esta en el Plan Obligatorio de Salud</p>";
  echo "</center>";
}
//}
//Verifica la tabla de Insumos
//if ($clas_map=='0109'  or $clas_map=='0111')
//{
$condicion="";
if(!empty($codi_mapii)){
  $condicion=$condicion."codi_ins  LIKE '%$codi_mapii%' AND ";}
if(!empty($desc_mapii)){
  $desc_mapii=trim($desc_mapii);
  $condicion=$condicion."desc_ins  LIKE '%$desc_mapii%' AND ";}
if(!empty($condicion)){
  $condicion=substr($condicion,0,(strlen($condicion)-5));
}

if(!empty($condicion)){
  $_pagi_sql="SELECT codi_ins, desc_ins   FROM insu_med WHERE $condicion ORDER BY desc_ins ";}
else{
  $_pagi_sql="SELECT codi_ins, desc_ins FROM insu_med ORDER BY desc_ins";}
//echo $_pagi_sql;
$_pagi_cuantos = 15; 
include("php/paginator.inc.php"); 

if(mysql_num_rows($_pagi_result)!=0) {
  echo "<table class='Tbl0'>";
  echo "<th class='Th0' width='10%'>OPCIONES</th>
        <th class='Th0' width='15%'>CODIGO</font></th>
	    <th class='Th0' width='70%'>DESCRIPCION</font></th>";
	while($row=mysql_fetch_array($_pagi_result)){
    echo "<tr>";
	echo "<td><label><input name=codichk type=checkbox onclick=\"location.href='fac_creamapii.php?codi_mapii=$row[codi_ins]&des_mapi=$row[desc_ins]'\"></label></td>";
    echo "<td class='Td2'>$row[codi_ins]</td>";
    echo "<td class='Td2'>$row[desc_ins]</td>";
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
  echo "<p class=Msg>Material o Insumo No Encotrado</p>";
  echo "</center>";
}
//}
mysql_close();
?>

</body>
</html>