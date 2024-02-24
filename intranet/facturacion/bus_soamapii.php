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

switch($vcod){  
  case '2':
    $tabla='soat';
	if(!empty($soat_map)){
	  $codigo_=$soat_map;}
    elseif(!empty($codigo_)){
	  $codi_soat=$codigo_;
	  $desc_map='';}
	elseif(empty($codigo_) and !empty($codi_soat)){
	  $codigo_=$codi_soat;}
	if(!empty($descri_)){
	  $codi_soat='';
	  $codigo_='';}
	elseif(!empty($descri_)){
	 $descri_=$desc_map;}
	elseif(empty($descri_) and !empty($desc_map)){
	  $descri_=$desc_map;}
	break;
  case '3':
    $tabla='iss1';
	if(!empty($iss1_mapii)){
	  $codigo_=$iss1_mapii;}
    elseif(!empty($codigo_)){
	  $is1_mapi=$codigo_;
	  $desc_map='';}
	elseif(empty($codigo_) and !empty($is1_mapi)){
	  $codigo_=$is1_mapi;}
	  //validacion de la descripcion
	if(!empty($descri_)){
	  $is1_mapi='';
	  $codigo_='';}
	elseif(!empty($descri_)){
	 $descri_=$desc_map;}
	elseif(empty($descri_) and !empty($desc_map)){
	  $descri_=$desc_map;}
	break;
 case '4':
    $tabla='iss4';
	if(!empty($iss4_mapii)){
	  $codigo_=$iss4_mapii;}
    elseif(!empty($codigo_)){
	  $is4_mapi=$codigo_;
	  $desc_map='';}
	elseif(empty($codigo_) and !empty($is4_mapi)){
	  $codigo_=$is4_mapi;}
	if(!empty($descri_)){
	  $is4_mapi='';
	  $codigo_='';}
	elseif(!empty($descri_)){
	 $descri_=$desc_map;}
	elseif(empty($descri_) and !empty($desc_map)){
	  $descri_=$desc_map;}
	break;
}

?>
<html>
<head>
	<title>PROGRAMA DE FACTURACIÓN</title>

	<SCRIPT LANGUAGE=JavaScript>
		function validar(){
		form1.submit();}
	  
		function vaciar(){
		form1.codigo_.value='';
		form1.descri_.value='';}
	</script>

	<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<form name="form1" method="POST" action="bus_soamapii.php" target='fr02'>
<body lang=ES  style='tab-interval:35.4pt'  >


<table class="Tbl0">
  <tr><td class="Td0" align='center'>BUSQUEDA DE TARIFARIO</td></tr>
</table>
<br>
<center><table class="Tbl0">
	<tr>
	  <td class="Td2" align='right' width='20%'><b>Código:</td>
	  <td class="Td2" align='left' width='20%'><input type='text' name='codigo_' size='10' maxlength='10' onfocus='vaciar()' value=<?echo $codigo_;?>></td>
	  <td class="Td2" align='right' width='20%'><b>Descripción:</td>
	  <td class="Td2" align='left' width='20%'><input type='text' name='descri_' size='30' maxlength='30' onfocus='vaciar()' value=<?echo $descri_;?> ></td>
	  <td class="Td2" align='left' width='10%'><a href='#' onclick='form1.submit()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td>
	</tr>
</table></center>

<input type='hidden' name='control' value='1'>

<?
include('php/conexion.php');
$condicion="";
	if(!empty($codigo_)){
	  $condicion=$condicion."codi_tar LIKE '%$codigo_%' AND ";}
	if(!empty($descri_)){
	  $desc_tar =trim($desc_tar );
	  $condicion=$condicion."desc_tar  LIKE '%$descri_%' AND ";}
	if(!empty($condicion)){
	  $condicion=substr($condicion,0,(strlen($condicion)-5));}
	if(!empty($condicion)){
	  $_pagi_sql="SELECT  codi_tar, desc_tar, valr_tar FROM $tabla WHERE $condicion ORDER BY desc_tar";}
	else{
	  $_pagi_sql="SELECT codi_tar, desc_tar, valr_tar FROM $tabla ORDER BY desc_tar";}
	  
	  $_pagi_cuantos = 15; 
	  include("php/paginator.inc.php"); 

	if(mysql_num_rows($_pagi_result)!=0) 
	{ 
	  echo "<table class='Tbl0'>";
	  echo "<th class='Th0' width='10%'>OPCIONES</th>
	        <th class='Th0' width='15%'>CODIGO</font></th>
		    <th class='Th0' width='70%'>DESCRIPCION</font></th>";
	  while($row=mysql_fetch_array($_pagi_result))
	  {
		  echo "<tr>";
		  $descp=trim($row[desc_tar]);
		  echo "<td><input name=codchk type=checkbox onclick=\"location.href='fac_creamapii.php?codigo_=$row[codi_tar]&vcod=$vcod'\"></td>";
		  echo "<td class='Td2'>$row[codi_tar]</td>";
		  echo "<td class='Td2'>$row[desc_tar]</td>";
		  echo"</tr>";
	  }
		  echo "</table>";
  
	  echo "<table class='Tbl2'>";
	  echo "<tr>";
      echo "<td class='Td1'>".$_pagi_navegacion."</td>";
  
	  echo "</tr>";
      echo "</table>";
    }
	else
	{
	  echo "<center>";
	  echo "<p class=Msg>No existen registros para esta busqueda</p>";
	  echo "</center>";
	}
	echo "<input type='hidden' name='vcod' value='$vcod'>";
	//echo $vcodi;
	mysql_close();
?>

</body>
</html>