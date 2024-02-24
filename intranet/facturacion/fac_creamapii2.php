<?php 
session_start();
session_register('codi_mapii');
session_register('cod_con');
session_register('nive_map');
session_register('clas_map');
session_register('codi_soat');
session_register('is1_mapi');
session_register('is4_mapi');
session_register('des_mapi');

if(!empty($codi_mapii)){$codi_=$codi_mapii;}
if(!empty($des_mapi)){$desc_=$des_mapi;}

if(!empty($codi_)){$codi_mapii=trim($codi_);}
if(!empty($desc_)){$des_mapi=trim($desc_);}

switch($vcod){
  case '2':
    if(!empty($codigo_)){$codi_soat=trim($codigo_);}
	break;
  case '3':
    if(!empty($codigo_)){$is1_mapi=trim($codigo_);}
	break;
  case '4':
    if(!empty($codigo_)){$is4_mapi=trim($codigo_);}
	break;
}


?>

<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language="javaScript">
function validar(){
var error="";  
  if(form1.cod_mapi.value==""){error="Código\n";} 
  if(form1.desc_mapii.value==""){error=error+"Descripción\n";} 
  if(form1.sclas_mapii.value==""){error=error+"Subclase\n";} 
  if(form1.ccon_.value==""){error=error+"Código Contable\n";} 
  if(error!=""){
    alert("Para continuar debe completar la siguiente información:\n"+error);}
  else{
    form1.action="facguardamapii.php";
	form1.submit();}
}

function valida2(op){

if(op==1)
{
  form1.vcod.value=op;
  form1.submit();}
else{
  form1.vcod.value=op;
  form1.action="bus_soamapii.php";
  form1.submit();}
}


function validaniv(niv){
form1.nivl_.value=niv;

}
function validaclase(){
if (form1.sclas_mapii.value=='0109' || form1.sclas_mapii.value=='0111' || form1.sclas_mapii.value=='0112' || form1.sclas_mapii.value=='0113' )
{
//alert(form1.sclas_mapii.value);
form1.soat_map.value='';
form1.iss1_mapii.value='';
form1.iss4_mapii.value='';
form1.soat_map.disabled=true;
form1.iss1_mapii.disabled=true;
form1.iss4_mapii.disabled=true;
}
else
{

form1.soat_map.disabled=false;
form1.iss1_mapii.disabled=false;
form1.iss4_mapii.disabled=false;
}

}
</script>

<body>
<?
include('php/conexion.php');
?>
<form method="post" name="form1" action="bus_cupsmapii.php">
<center>
<table class="Tbl0"><tr><td class="Td0" align='center'>INGRESO DE NUEVO PROCEDIMIENTO/INSUMO/MEDICAMENTOS</td></tr></table>
<br>
<table class="Tbl0">

<tr>
  <td class="Td2" align='right'>Clase </td>
  <td class="Td2" align='left'>
  <select name='sclas_mapii' onchange='validaclase()'><option value=''>
  <?
    $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='01'");
	while($row=mysql_fetch_array($consulta)){
	  echo "<option value='$row[codi_des]'>$row[nomb_des]";
	}
	?>
  </select></td>
</tr>
<tr>
  <td class="Td2" align='right'>Código</td>
  <td class="Td2" align='left'><input type='text' name='cod_mapi' size='10' maxlength='14' value=<?echo $codi_mapii?>>
  <a href='#' onclick= 'valida2(1)'><img src='icons/feed_magnify.png' border='0' alt='Busqueda Cups'></a></td>
</tr>

<tr>  
  <td class="Td2" align='right'>Nivel De Complejidad</td>
  <td class="Td2" align='left'><select name='nivl_'><option value=''>
      <option value='1'>I Nivel
      <option value='2'>II Nivel
      <option value='3'>III Nivel
      <option value='4'>IV nivel
    </select></td>
</tr>
<script language="javaScript">validaniv(<?echo $nive_map?>);</script>
<tr>
  <td class="Td2" align='right'>Descripción</td>
  <td class="Td2" align='left'><input type='text' name='desc_mapii' size='42' maxlength='50' value="<?echo $des_mapi;?>"></td>
</tr>


<script language="javaScript">
	form1.sclas_mapii.value='<?echo $clas_map;?>';
</script>

<tr>
  <td class="Td2" align='right'>Código Contable</td>
  <td class="Td2" align='left'><input type='text' name='ccon_' size='10' maxlength='10' value=<?echo $cod_con;?>>
  </td>
</tr>

<tr>
  <td class="Td2" align='right'>Código SOAT</td>
  <td class="Td2" align='left'><input type='text' name='soat_map' size='10' maxlength='10' value=<?echo $codi_soat;?>>
  <a id='btn1' href='#' onclick= 'valida2(2)'><img src='icons/feed_magnify.png' border='0' alt='Busqueda Soat'></a>&nbsp;
  <?
  include('php/conexion.php');
  $cons1=mysql_query("select desc_tar from soat WHERE codi_tar='$codi_soat'");
  while ($row = mysql_fetch_array($cons1)) {
  echo strtoupper($row[desc_tar]); }?></td>
</tr>

<tr>
  <td class="Td2" align='right'>Código ISS 2001</td>
  <td class="Td2" align='left'><input type='text' name='iss1_mapii' size='10' maxlength='10'value=<?echo $is1_mapi?>>
  <a href='#' onclick= 'valida2(3)'><img src='icons/feed_magnify.png' border='0' alt='Busqueda ISS 2001'></a>&nbsp;
  <?include('php/conexion.php');
  $cons2=mysql_query("select desc_tar from iss1 WHERE codi_tar='$is1_mapi'");
  while ($rowx = mysql_fetch_array($cons2)) {
  echo strtoupper($rowx[desc_tar]); }?></td>
  
</tr>

<tr>
  <td class="Td2" align='right'>Código ISS 2004</td>
  <td class="Td2" align='left'><input type='text' name='iss4_mapii' size='10' maxlength='10' value=<?echo $is4_mapi?>>
  <a href='#' onclick= 'valida2(4)'><img src='icons/feed_magnify.png' border='0' alt='Busqueda ISS 2004'></a>&nbsp;
  <?include('php/conexion.php');
  $cons3=mysql_query("select desc_tar from iss4 WHERE codi_tar='$is4_mapi'");
  while ($rowx = mysql_fetch_array($cons3)) {
  echo strtoupper($rowx[desc_tar]); }?></td>
</tr>

</table>
<br>

<table class="Tbl2">
	<tr>
	<td class="Td1"><a href="#" onclick="javascript:validar()"><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align="top"> Guardar </a></td>
	<td class="Td1"><a href="fondo.php" onclick="javascript:history.go(-1)">Cancelar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align="top"></a></td>
</table>
<input type="hidden" name="vcod" value=0>
<script language="javaScript">
validaclase();
</script>
<?
mysql_free_result($consulta);
mysql_close();
?>
</form>
</body>
</html>