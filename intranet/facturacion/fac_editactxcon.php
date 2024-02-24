<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function val_activa(estado_,activ_,iden_tco){
  var msg_="";  
  if(estado_=='AC'){msg_="INACTIVAR"}
  else{msg_="ACTIVAR"}  
  if(confirm("Desea "+msg_+" la actividad "+activ_+"?")){
    form1.control.value='3';
    form1.iden_tco.value=iden_tco;
    form1.estado.value=estado_;
    form1.action="fac_geditactxcon.php";
    form1.submit();
  }
}
function validacod(cont_,iden_){
  var nombre='';
  nombre='form1.codi_'+cont_+'.checked'
  if(eval(nombre)==true){
    nombre='form1.codi_'+cont_+'.value='+iden_;
	eval(nombre);	
	nombre='form1.tser_'+cont_+'.disabled=false';
	eval(nombre);
	nombre='form1.tser_'+cont_+'.disabled=false';
	eval(nombre);
	nombre='form1.valor_'+cont_+'.disabled=false';
	eval(nombre);
	nombre='form1.grqx_'+cont_+'.disabled=false';
	eval(nombre);
	nombre='form1.valor_'+cont_+'.focus()';
	eval(nombre);
  }
  else{
    nombre='form1.codi_'+cont_+'.value=""';
	eval(nombre);
	nombre='form1.tser_'+cont_+'.disabled=true';
	eval(nombre);
	nombre='form1.tser_'+cont_+'.disabled=true';
	eval(nombre);
	nombre='form1.valor_'+cont_+'.disabled=true';
	eval(nombre);
	nombre='form1.grqx_'+cont_+'.disabled=true';
	eval(nombre);
  }
}
function validatip(scla_,codscl_){
  var cadena="form1."+scla_+".value='"+codscl_+"'";
  eval(cadena);
}
function validaelim(){
  if(confirm("Recuerde: Si la actividad ya está facturada, no se eliminará\nDesea eliminar las actividades seleccionadas")){
    form1.control.value='2';
    form1.action="fac_geditactxcon.php";
    form1.submit();
  }
}
function validasubcl(){
  form1.action='fac_editactxcon.php';
  form1.submit();
}

</script>
</head>
<body>
<form name='form1' method='post' action='fac_geditactxcon.php'>
<table class="Tbl0"><tr><td class="Td0" align='center'>CONTRATO</td></tr></table>
<?
include('php/funciones.php');
include('php/conexion.php');
$consulta=mysql_query("SELECT con.neps_con,con.codi_con,
ccion.iden_ctr,ccion.nume_ctr,ccion.fini_ctr,ccion.ffin_ctr,ccion.mont_ctr,ccion.pctg_ctr,ccion.tari_ctr,ccion.tpor_crt
FROM contrato AS con
INNER JOIN contratacion AS ccion ON ccion.codi_con=con.codi_con
WHERE ccion.iden_ctr='$iden_ctr'");
$row=mysql_fetch_array($consulta);
$codi_con=$row[codi_con];
$tpor_crt=$row[tpor_crt];
$pctg_ctr=$row[pctg_ctr]/100;
echo "<table class='Tbl0'>";
echo "<th class='Th0' width='5%'>NRO</th>
	  <th class='Th0' width='30%'>ENTIDAD</th>
	  <th class='Th0' width='20%'>VIGENCIA</th>
	  <th class='Th0' width='5%'>MONTO</font></th>
	  <th class='Th0' width='40%'>CLAUSULAS</font></th>";
echo "<tr>";
echo "<td class='Td2'>$row[nume_ctr]</td>";
echo "<td class='Td2'>$row[neps_con]</td>";
echo "<td class='Td2'>".cambiafechadmy($row[fini_ctr])." - ".cambiafechadmy($row[ffin_ctr])."</td>";
echo "<td class='Td2'>$row[mont_ctr]</td>";
$tabla='';
$campo='';
$obser='';
if($row[tari_ctr]=='1'){
  $obser='Soat con ';
  $tabla='soat';
  $campo='soat_map';
}
if($row[tari_ctr]=='2'){
  $obser='ISS 2001 con ';
  $tabla='iss1';
  $campo='iss1_map';
}
if($row[tari_ctr]=='3'){
  $obser='ISS 2004 con ';
  $tabla='iss4';
  $campo='iss4_map';
}

if($row[tpor_crt]=='+'){$tipo='de Incremento';}
if($row[tpor_crt]=='-'){$tipo='de Descuento';}

$obser=$obser.'  '.$row[pctg_ctr].' % '.$tipo;

echo "<td class='Td2'>$obser</td>";
echo "</tr>";
echo "</table>";

echo "<table class='Tbl0'><tr><td class='Td0' align='center'>EDICION DE ACTIVIDADES DEL CONTRATO</td></tr></table>";

echo "<table class='Tbl0'><tr>";
echo "<td class='Td0' width='10%' align='right'>Código:</td>";
echo "<td class='Td0' width='15%' align='left'><input type='text' name='codigo' size='15' maxlength='15' value='$codigo'></td>";
echo "<td class='Td0' width='15%' align='right'>Descripción:</td>";
echo "<td class='Td0' width='20%' align='left'><input type='text' name='descrip' size='20' maxlength='50' value='$descrip'></td>";
echo "<td class='Td0' width='15%' align='right'>Clase de actividad:</td>";
echo "<td class='Td0' width='25%'><select name='sclase'><option value=''>Todas";
$consultasc=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='18'");
while($rowsc=mysql_fetch_array($consultasc)){
  echo "<option value='$rowsc[codi_des]'>$rowsc[nomb_des]";
}
echo "</select>";
echo "<a href='#' onclick='validasubcl()'><img hspace=0 width=20 height=20 src='icons/feed_magnify.png' alt='Buscar' border=0 align='top'></a></td>";
echo "</tr></table>";
?>
<script language='javascript'>
  form1.sclase.value='<?echo $sclase;?>'
  form1.tari_ctr.value='<?echo $tari_ctr;?>'
</script>
<?
//$condicion="map.clas_map<>''";
if(empty($sclase) and empty($descrip) and empty($codigo)){
  $sclase='1815';
  ?>
  <script language="javascript">form1.sclase.value='<?echo $sclase;?>'</script>
  <?
}
//$condicion="tar.iden_ctr=$iden_ctr AND map.clas_map<>''";
$condicion="tar.clas_tco='P' and tar.iden_ctr=".$iden_ctr;
if(!empty($sclase)){
  $condicion="tar.iden_ctr=$iden_ctr AND map.clas_map='$sclase'";
}
if(!empty($descrip)){
  $condicion=$condicion." and map.desc_map LIKE '%$descrip%'";
}
if(!empty($codigo)){
  //$condicion=$condicion." and map.codi_map LIKE '%$codigo%'";
  $condicion=$condicion." and cups.codi_cup LIKE '%$codigo%'";
}
$consulta="SELECT tar.iden_tco,tar.iden_map,tar.iden_ctr,tar.tser_tco,tar.valo_tco,tar.grqx_tco,tar.esta_tco,
map.codi_map,map.desc_map,cups.codi_cup
FROM tarco AS tar
INNER JOIN mapii AS map ON map.iden_map=tar.iden_map 
INNER JOIN cups ON cups.codigo=map.codi_map
WHERE $condicion";
//echo $consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
  echo "<table class='Tbl0'>";
  echo "<th class='Th0' colspan='2'>SEL</th>
    <th class='Th0'>ESTADO</th>
		<th class='Th0'>CODIGO</th>
	  <th class='Th0'>NOMBRE</th>
		<th class='Th0'>CLASE</th>
		<th class='Th0'>VALOR</th>
		<th class='Th0'>GRUPO</th>";
  $cont=0;
  while($row=mysql_fetch_array($consulta)){
	  $var='codi_'.$cont;
    echo "<tr>";
    echo "<td class='Td4'><input type='checkbox' name='$var' onclick=\"validacod('$cont','$row[iden_tco]')\" value=''></td>";
    echo "<td><a href='#' onclick='val_activa(\"$row[esta_tco]\",\"$row[desc_map]\",\"$row[iden_tco]\")' title='Activar/Inactivar'><img hspace=0 width=12 height=12 src='icons/feed_add.png' alt='Activar/Inactivar' border=0 align='top'></a>";
    echo "</td>";
    if($row[esta_tco]=='IN'){
      echo "<td class='Td0'>$row[esta_tco]</td>";}
    else{
      echo "<td class='Td2'>$row[esta_tco]</td>";}    
    echo "<td class='Td2'>$row[codi_cup]</td>";
    echo "<td class='Td2'>$row[desc_map]</td>";
	$var='tser_'.$cont;
	echo "<td class='Td2'><select name='$var' disabled='true'>";
	$consultatp=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='01'");
	while($rowtp=mysql_fetch_array($consultatp)){
	  echo "<option value='$rowtp[codi_des]'>$rowtp[nomb_des]";
	}
	echo "</td>";
	?>
	<script language='javascript'>
	  validatip('<?echo $var;?>','<?echo $row[tser_tco];?>');
	</script>
	<?	
	$var='valor_'.$cont;
	echo "<td class='Td2'><input type='text' name='$var' size='10' value='$row[valo_tco]' disabled='true' onKeypress='if (event.keyCode > 47 && event.keyCode <58 ||event.keyCode == 46) event.returnValue = true;else event.returnValue = false'></td>";
	$var='grqx_'.$cont;
	echo "<td class='Td2'><select name='$var' disabled='true'><option value=''>";
	//$consultagr=mysql_query("SELECT codi_gru,nomb_gru FROM grupos");    
        $consultagr=mysql_query("SELECT grup_gqx FROM grupoqx GROUP BY grup_gqx");
	while($rowgr=mysql_fetch_array($consultagr)){
	  echo "<option value='$rowgr[grup_gqx]'>$rowgr[grup_gqx]";
	}
	echo "</select></td>";
	?>
	<script language='javascript'>
	  validatip('<?echo $var;?>','<?echo $row[grqx_tco];?>');
	</script>
	<?	
    echo"</tr>";
	$cont++;
  }
  echo "</table>";
  echo "<table class='Tbl2'>";
  echo "<tr>";
  echo "<td class='Td1'><a href='#' onclick='javascript:form1.submit()'><img hspace=0 width=20 height=20 src='icons/feed_disk.png' alt='Guardar' border=0 align='top'>Guardar</a></td>";
  echo "<td class='Td1'><a href='#' onclick='validaelim()'><img hspace=0 width=20 height=20 src='icons/feed_delete.png' alt='Eliminar elementos seleccionados' border=0 align='top'>Eliminar elementos selecciondos</a></td>";
  echo "<td class='Td1'><a href='fac_muesccion.php?codi_con=<?echo $codi_con;?>'>Regresar<img hspace=0 width=20 height=20 src='icons/feed.png' alt='Cancelar' border=0 align='top'></a></td>";
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

<input type='hidden' name='numact' value='<?echo $cont;?>'>
<input type='hidden' name='iden_ctr' value='<?echo $iden_ctr;?>'>
<input type='hidden' name='codi_con' value='<?echo $codi_con;?>'>
<input type='hidden' name='iden_tco' value=''>
<input type='hidden' name='estado' value=''>
<input type='hidden' name='control' value='1'>
</form>
</body>
</html>