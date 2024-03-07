<html>
<head>
<title>Ayuda</title>
<SCRIPT LANGUAGE='JavaScript'>
function validar(){
if(form1.codi_.value=="" && form1.nombre_.value==""){
  alert("Debe digitar al menos un parametro de busqueda");}
else{
  form1.submit();}
}
</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<form name="form1" method="POST" action="fac_ayuda.php">
<?
include('php/conexion.php');
switch ($tipo_){
  case 'P':
    $consu_="PROCEDIMIENTOS";
	break;
  case 'D':
    $consu_="DIAGNOSTICOS";
	break;
  case 'M':
    $consu_="MEDICAMENTOS";
	break;
  case 'I':
    $consu_="INSUMOS";
	break;
}
?>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0">
  <tr><td class="Td0" align='center'>CONSULTA DE <?echo $consu_;?></td></tr>
</table>
<br>
<center>
<table class="Tbl0" border='0'>
<tr>
  <td class="Td2" align='right' width='15%'><b>C�digo</td>
  <td class="Td2" align='left' width='15%'><input type='text' name='codi_' size='10' value='<?echo $codi_;?>'></td>
  <td class="Td2" align='right' width='15%'><b>Nombre</td>
  <td class="Td2" align='left' width='30%'><input type='text' name='nombre_' size='20' maxlength='50' value='<?echo $nombre_;?>'></td>
  <td class="Td2" align='left' width='10%'><a href='#' onclick='validar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=18 height=18></a></td>  
</tr>
</table>
</center>
<?
//echo $tipo_;
//echo $codi_;
switch ($tipo_){
  case 'P':
    $condicion="esta_cup='AC' AND ";
    //if(!empty($codi_)){$condicion=$condicion."codi_map LIKE '%$codi_%' AND ";}
    if(!empty($codi_)){$condicion=$condicion."codi_cup LIKE '%$codi_%' AND ";}
    if(!empty($nombre_)){$condicion=$condicion."desc_map LIKE '%$nombre_%' AND ";}
    if(!empty($condicion)){$condicion=substr($condicion,0,strlen($condicion)-5);}

    //echo $condicion;
    $consulta="SELECT mapii.codi_map,cups.codi_cup AS codigo,mapii.desc_map AS nombre FROM 
    mapii INNER JOIN cups ON cups.codigo=mapii.codi_map WHERE $condicion ORDER BY nombre";
    //echo "<br>".$consulta;
    break;
  case 'D':
    $condicion='';
    if(!empty($codi_)){$condicion=$condicion."cod_cie10='$codi_' AND ";}
    if(!empty($nombre_)){$condicion=$condicion."nom_cie10 LIKE '%$nombre_%' AND ";}
    if(!empty($condicion)){$condicion=substr($condicion,0,strlen($condicion)-5);}
    $consulta="SELECT cod_cie10 AS codigo,nom_cie10 AS nombre FROM cie_10 WHERE $condicion ORDER BY nombre";
    break;
  case 'M':
    $condicion='';
    if(!empty($codi_)){$condicion=$condicion."ncsi_medi='$codi_' AND ";}
    if(!empty($nombre_)){$condicion=$condicion."nomb_mdi LIKE '%$nombre_%' AND ";}
    if(!empty($condicion)){$condicion=substr($condicion,0,strlen($condicion)-5);}
    //$consulta="SELECT ncsi_medi AS codigo,nomb_mdi AS nombre FROM medicamentos2 WHERE $condicion ORDER BY nombre";
    $consulta="SELECT cum_med AS codigo,nomb_mdi AS nombre FROM medicamentos2 WHERE $condicion ORDER BY nombre";
    break;
  case 'I':
    $condicion='';
    if(!empty($codi_)){$condicion=$condicion."codnue='$codi_' AND ";}
    if(!empty($nombre_)){$condicion=$condicion."desc_ins LIKE '%$nombre_%' AND ";}
    if(!empty($condicion)){$condicion=substr($condicion,0,strlen($condicion)-5);}
    $consulta="SELECT codnue AS codigo,desc_ins AS nombre FROM insu_med WHERE $condicion ORDER BY nombre";
    break;
}
//echo $consulta;
?>
<table class="Tbl0" border='0'>
<?
if(empty($codi_) and empty($nombre_)){
  echo "<th class='Th0' width='100%'><b>No Encontrado</td>";}
else{
  echo "<th class='Th0' width='10%'><b>C�digo</td>";
  echo "<th class='Th0' width='90%'><b>Nombre</td>";
  $consulta=mysql_query($consulta);
  while($row=mysql_fetch_array($consulta)){
    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
    echo "<tr>";
    echo "<td class='Td2' align='center' bgcolor='$color'>$row[codigo]";
    echo "<td class='Td2' align='left' bgcolor='$color'>$row[nombre]";
    echo "</tr>";
  }
}

mysql_close();
?>
</table>
<br><br><br>
<center><input type='button' name='cerrar' value='Cerrar' onclick='window.close()'></center>
<input type='hidden' name='tipo_' value='<?echo $tipo_;?>'>
</form>
</body>
</html>
