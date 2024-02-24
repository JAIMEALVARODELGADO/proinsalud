<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function validacod(cont_,iden_){
  var nombre='';
  nombre='form1.codi_'+cont_+'.checked'
  if(eval(nombre)==true){
    nombre='form1.codi_'+cont_+'.value='+iden_;
	eval(nombre);	
	nombre='form1.valo_gxc'+cont_+'.disabled=false';
	eval(nombre);
	nombre='form1.valo_gxc'+cont_+'.focus()';
	eval(nombre);
  }
  else{
    nombre='form1.codi_'+cont_+'.value=""';
	eval(nombre);
	nombre='form1.valo_gxc'+cont_+'.disabled=true';
	eval(nombre);
  }
}

function validaelim(){
  if(confirm("Desea eliminar las actividades seleccionadas")){
    form1.control.value='2';
    //form1.action="fac_geditagrxcon.php";
    form1.submit();
  }
}

function validagrupo(){
  form1.action='fac_editgrpxcon.php';
  form1.submit();
}

</script>
</head>
<body>
<form name='form1' method='post' action='fac_geditagrxcon.php'>
<table class="Tbl0"><tr><td class="Td0" align='center'>CONTRATO</td></tr></table>
<?
include('php/funciones.php');
include('php/conexion.php');
$consulta=mysql_query("SELECT con.neps_con,con.codi_con,
ccion.iden_ctr,ccion.nume_ctr,ccion.fini_ctr,ccion.ffin_ctr,ccion.mont_ctr,ccion.pctg_ctr,ccion.tari_ctr,ccion.tpor_crt
FROM contrato AS con
INNER JOIN contratacion AS ccion ON ccion.codi_con=con.codi_con
WHERE iden_ctr='$iden_ctr'");
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

echo "<table class='Tbl0'><tr><td class='Td0' align='center'>EDICION DE GRUPOS QX</td></tr></table>";

echo "<table class='Tbl0'><tr>";
echo "<td class='Td0' width='25%' align='right'>Grupo:</td>";
echo "<td class='Td0' width='25%'><select name='grupo'><option value=''>Todos";
//$consultagr=mysql_query("SELECT codi_gru,nomb_gru FROM grupos");
$consultagr=mysql_query("SELECT grup_gqx FROM grupoqx GROUP BY grup_gqx");
while($rowgr=mysql_fetch_array($consultagr)){
  echo "<option value='$rowgr[grup_gqx]'>$rowgr[grup_gqx]";
}
echo "</select>";
echo "<a href='#' onclick='validagrupo()'><img hspace=0 width=20 height=20 src='icons\feed_magnify.png' alt='Buscar' border=0 align='top'></a></td>";
echo "</tr></table>";

?>
<script language='javascript'>
  form1.grupo.value='<?echo $grupo;?>'
</script>
<?
$condicion="iden_ctr=$iden_ctr and grup.grup_gqx<>''";
if(!empty($grupo)){
  $condicion="iden_ctr=$iden_ctr and grup.grup_gqx='$grupo'";
}
$consulta=mysql_query("SELECT gxc.iden_gxc,gxc.iden_ctr,gxc.iden_gxc,gxc.desc_gxc,gxc.valo_gxc,
grup.grup_gqx
FROM grupoxcont AS gxc
INNER JOIN grupoqx AS grup ON gxc.iden_gqx=grup.iden_gqx 
WHERE $condicion");

if(mysql_num_rows($consulta)!=0){
  echo "<table class='Tbl0'>";
  echo "<th class='Th0' width='10%'>SEL</th>
        <th class='Th0' width='10%'>GRUPO</th>
	    <th class='Th0' width='60%'>DESCRIPCION</th>
		<th class='Th0' width='20%'>VALOR</th>";
  $cont=0;
  while($row=mysql_fetch_array($consulta)){
	$var='codi_'.$cont;
    echo "<tr>";
    echo "<td class='Td4'><input type='checkbox' name='$var' onclick=\"validacod('$cont','$row[iden_gxc]')\" value=''></td>";
    echo "<td class='Td2' align='center'>$row[grup_gqx]</td>";
    echo "<td class='Td2'>$row[desc_gxc]</td>";
	$var='valo_gxc'.$cont;
	echo "<td class='Td2' align='center'><input type='text' name='$var' size='10' value='$row[valo_gxc]' disabled onKeypress='if (event.keyCode > 47 && event.keyCode <58 ||event.keyCode == 46) event.returnValue = true;else event.returnValue = false'></td>";
    echo "</tr>";
	$cont++;
  }
  echo "</table>";
  echo "<table class='Tbl2'>";
  echo "<tr>";
  echo "<td class='Td1'><a href='#' onclick='javascript:form1.submit()'><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align='top'>Guardar</a></td>";
  echo "<td class='Td1'><a href='#' onclick='validaelim()'><img hspace=0 width=20 height=20 src='icons\feed_delete.png' alt='Eliminar elementos seleccionados' border=0 align='top'>Eliminar elementos selecciondos</a></td>";
  echo "<td class='Td1'><a href='fac_muesccion.php?codi_con=<?echo $codi_con;?>'>Regresar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align='top'></a></td>";
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
<input type='hidden' name='control' value='1'>
</form>
</body>
</html>