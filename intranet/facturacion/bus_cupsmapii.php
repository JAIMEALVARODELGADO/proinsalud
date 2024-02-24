<?php
session_register('codi_mapii');
session_register('desc_map');
session_register('nive_map');
session_register('pos_map');
session_register('mapi_map');
session_register('grumap_map');
session_register('nivmap_map');
session_register('codi_soat');
session_register('grusoa_map');
session_register('valsoa_map');
session_register('is1_mapi');
session_register('uvriss_map');
session_register('valiss_map');
session_register('is4_mapi');
session_register('cconcir_map');
session_register('cconane_map');
session_register('cconayu_map');
session_register('cconder_map');
session_register('cconmat_map');
session_register('clas_map');
session_register('espe_map');
session_register('form_mapi');
if(!empty($cod_mapi)){
	$codi_mapii=$cod_mapi;}
if(!empty($nivl_)){
	$nive_map=$nivl_;}
if(!empty($pos_)){
	$pos_map=$pos_;}
if(!empty($mapi_)){
	$mapi_map=$mapi_;}
if(!empty($grumap_)){
	$grumap_map=$grumap_;}
if(!empty($nivmap_)){
	$nivmap_map=$nivmap_;}
if(!empty($soat_map)){
	$codi_soat=$soat_map;}
if(!empty($grusoa_)){
	$grusoa_map=$grusoa_;}
if(!empty($valsoa_)){
	$valsoa_map=$valsoa_;}
if(!empty($iss1_mapii)){
	$is1_mapi=$iss1_mapii;}
if(!empty($uvriss_)){
	$uvriss_map=$uvriss_;}
if(!empty($valiss_)){
	$valiss_map=$valiss_;}
if(!empty($iss4_mapii)){
	$is4_mapi=$iss4_mapii;}
if(!empty($cconcir_)){
	$cconcir_map=$cconcir_;}
if(!empty($cconane_)){
	$cconane_map=$cconane_;}
if(!empty($cconayu_)){
	$cconayu_map=$cconayu_;}
if(!empty($cconder_)){
	$cconder_map=$cconder_;}
if(!empty($cconmat_)){
	$cconmat_map=$cconmat_;}
if(!empty($clas_mapii)){
	$clas_map=$clas_mapii;}
if(!empty($espe_)){
	$espe_map=$espe_;}
if(!empty($control)){
	$codi_mapii=$cod_mapi;}
if(!empty($forma)){
	$form_mapi=$forma;}
if(!empty($desc_mapii)){
	$desc_map=$desc_mapii;}
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
  <td class="Td2" align='left' width='20%'><input type='text' name='cod_mapi' size='10' maxlength='14' onfocus='vaciar()' value=<?echo $codi_cup;?>></td>
  <td class="Td2" align='right' width='20%'><b>Descripción:</td>
  <td class="Td2" align='left' width='20%'><input type='text' name='desc_mapii' size='30' maxlength='30' onfocus='vaciar()' value='<?echo $desc_mapii;?>' ></td>
  <td class="Td2" align='left' width='10%'><a href='#' onclick='validar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td>
</tr>
</table>
</center>
<input type='hidden' name='control' value='1'>
<?

include('php/conexion.php');
//if ($clas_map=='0101' or $clas_map=='0102' or $clas_map=='0103' or $clas_map=='0104' or $clas_map=='0105' or $clas_map=='0106' or $clas_map=='0107' or $clas_map=='0108' or $clas_map=='0110' or $clas_map=='0114'){
$condicion="esta_cup='AC' AND ";
if(!empty($codi_mapii)){
  $condicion=$condicion."codi_cup LIKE '%$codi_mapii%' AND ";}
if(!empty($desc_mapii)){
  $desc_mapii=trim($desc_mapii);
  $condicion=$condicion."descrip  LIKE '%$desc_mapii%' AND ";}
if(!empty($condicion)){
  $condicion=substr($condicion,0,(strlen($condicion)-5));
}
//echo "condicion".$condicion;
//if(!empty($condicion)){
  $consulta="SELECT iden_tar, codigo,codi_cup, descrip FROM cups WHERE $condicion ORDER BY descrip";
//else{
//  $consulta="SELECT iden_tar, codigo, descrip FROM cups ORDER BY descrip";}
//echo $consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0) { 
  echo "<table class='Tbl0'>";
  echo "<th class='Th0' width='10%'>OPCIONES</th>
    <th class='Th0' width='15%'>CODIGO</font></th>
	  <th class='Th0' width='70%'>DESCRIPCION</font></th>";
	while($row=mysql_fetch_array($consulta)){
    echo "<tr>";
    $descp=trim($row[descrip]);
    echo "<td><label><input name=codichk type=checkbox onclick=\"location.href='fac_creamapii.php?codi_=$row[codigo]&codi_cup=$row[codi_cup]&desc_=$descp'\"></label></td>";
    echo "<td class='Td2'>$row[codi_cup]</td>";
    echo "<td class='Td2'>$row[descrip]</td>";
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