<?
session_register('gcod_mapi');
session_register('gdes_mapi');
session_register('gclas_pro');
session_register('iden_fac');
//session_register('gtipo_dfa');
if($control==2){
  $gcod_mapi=$cod_mapi;
  $gdes_mapi=$des_mapi;
  $gclas_pro=$clas_pro;
  //$gtipo_dfa=$tipo_dfa;
}
?>

<SCRIPT LANGUAGE=JavaScript>
function validar(){
  form1.control.value='2';
  form1.submit();
}

function vaciar(){
form1.cod_mapi.value='';
form1.des_mapi.value='';
}


</script>

<html>
<head>
<title>PROGRAMA DE FACTURACIÓN - PROFACTU</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<form name="form1" method="POST" action="fac_2buscamap.php" target='fr02'>
<body>
<table class="Tbl0"><tr><td class="Td0" align='center'>BUSQUEDA DE MANUAL DE ACTIVIDADES PROCEDIMIENTOS E INSUMOS INSTITUCIONALES </td></tr></table><br>
<?
include('php/conexion.php');
?>
<center><table class="Tbl0">
<tr>
  <td class='Td2' align='right'><b>Código:</td>
  <td class='Td2'><input type="text" name="cod_mapi" size="14" maxlength="14" onFocus="vaciar()" value=<?echo $gcod_mapi;?>></td>
  <td class='Td2' align='right'><b>Nombre: </td>
  <td class='Td2' ><input type="text" name="des_mapi" size="15" onFocus="vaciar()" value=<?echo $gdes_mapi;?>>
  <td class='Td2' align='right'><b>Clase: </td>
  <td class='Td2' >
    <?
	if($tipo_dfa=='P'){
      echo "<select name='clas_pro'><option value=''>";
      $consclas=mysql_query("SELECT  dt.nomb_des, dt.codi_des  FROM destipos as dt WHERE dt.codt_des='18'");
       while($rowclas = mysql_fetch_array($consclas)){
         echo "<option value='$rowclas[codi_des]'>$rowclas[nomb_des]";}
	  echo "</select>";
	}
	?>
  <td class="Td2" align='left' width='10%'><a href='#' onclick='validar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td>
</tr></table>
<?
	include('php/conexion.php');
	$condicion="";
	switch ($tipo_dfa){
	  case 'P':
	    $condicion="ef.iden_fac='$iden_fac' AND ";
	    if(!empty($gcod_mapi)){
	      $condicion=$condicion."map.codi_map  LIKE '%$gcod_mapi%' AND ";}
	    if(!empty($gdes_mapi)){
	      $des_mapi=trim($gdes_mapi);
	      $condicion=$condicion."map.desc_map  LIKE '%$gdes_mapi%' AND ";}
	    if(!empty($gclas_pro)){
	      $condicion=$condicion."map.clas_map  = '$gclas_pro' AND ";}
	    if(!empty($condicion)){
	      $condicion=substr($condicion,0,(strlen($condicion)-5));}
	    if(!empty($condicion)){
	      $consultaact="SELECT map.codi_map as codi_, map.desc_map as desc_ FROM mapii AS map 
	      INNER JOIN tarco AS trc ON trc.iden_map = map.iden_map 
          INNER JOIN contratacion as con ON con.iden_ctr=trc.iden_ctr 
		  INNER JOIN encabezado_factura AS ef ON ef.iden_ctr=con.iden_ctr WHERE $condicion";}
	    break;
	  case 'I':
	    $condicion="ef.iden_fac='$iden_fac' AND ";
        if(!empty($gcod_mapi)){
	      $condicion=$condicion."ins.codnue LIKE '%$gcod_mapi%' AND ";}
	    if(!empty($gdes_mapi)){
	      $des_mapi=trim($gdes_mapi);
	      $condicion=$condicion."ins.desc_ins LIKE '%$gdes_mapi%' AND ";}
	    if(!empty($condicion)){
	      $condicion=substr($condicion,0,(strlen($condicion)-5));}
	    if(!empty($condicion)){
	      $consultaact="SELECT ins.codnue as codi_, ins.desc_ins as desc_ FROM insu_med AS ins
	      INNER JOIN tarco AS trc ON trc.iden_map = ins.codnue
          INNER JOIN contratacion as con ON con.iden_ctr=trc.iden_ctr 
		  INNER JOIN encabezado_factura AS ef ON ef.iden_ctr=con.iden_ctr WHERE $condicion";}
		break;
	  case 'M':
        $condicion="ef.iden_fac='$iden_fac' AND ";
	    if(!empty($gcod_mapi)){
	      $condicion=$condicion."mdi.codi_mdi LIKE '%$gcod_mapi%' AND ";}
	    if(!empty($gdes_mapi)){
	      $des_mapi=trim($gdes_mapi);
	      $condicion=$condicion."mdi.nomb_mdi LIKE '%$gdes_mapi%' AND ";}
	    if(!empty($condicion)){
	      $condicion=substr($condicion,0,(strlen($condicion)-5));}
	    if(!empty($condicion)){
		  $consultaact="SELECT mdi.codi_mdi as codi_,CONCAT(mdi.nomb_mdi,' ',mdi.noco_mdi) as desc_ FROM medicamentos2 AS mdi
	      INNER JOIN tarco AS trc ON trc.iden_map = mdi.codi_mdi
          INNER JOIN contratacion as con ON con.iden_ctr=trc.iden_ctr 
		  INNER JOIN encabezado_factura AS ef ON ef.iden_ctr=con.iden_ctr WHERE $condicion";}		
		break;
	}
	//echo "<BR>consulta:  $consultaact<BR><BR><BR>";
	if(!empty($consultaact)){
	  $consultaact=mysql_query($consultaact);
	  if(mysql_num_rows($consultaact)!=0){ 
	    echo "<table class='Tbl0'>";
	    echo "<th class='Th0' width='10%'>OPCIONES</th>
	          <th class='Th0' width='15%'>CODIGO</font></th>
		      <th class='Th0' width='70%'>DESCRIPCION</font></th>";
	    while($row=mysql_fetch_array($consultaact)){
		  echo "<tr>";	 
  		  echo "<td><input name=codchk type=checkbox onclick=\"location.href='fac_2detfactu.php?cod_map=$row[codi_]&tipo_dfa=$tipo_dfa'\"></td>";
		  echo "<td class='Td2'>$row[codi_]</td>";
		  echo "<td class='Td2'>$row[desc_]</td>";
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
	}
	else{
	  echo "<center>";
	  echo "<p class=Msg>Actividades No Contratadas</p>";
	  echo "</center>";
	}
	echo "<input type='hidden' name='control'>";
	echo "<input type='hidden' name='tipo_dfa' value='$tipo_dfa'>";
	  ?>
	  <br>
	  <a href='fac_2detfactu.php?tipo_dfa=<?echo $tipo_dfa;?>'><img src='icons/feed.png' border='0' alt='Regresar' width=20 height=20>Regresar</a>
	  <?
	//echo $vcodi;
	mysql_close();
?>
</form>
</body>
</html>