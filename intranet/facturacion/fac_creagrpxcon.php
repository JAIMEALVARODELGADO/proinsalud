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
	nombre='form1.valo_gxc'+cont_+'.focus()';
	eval(nombre);
  }
  else{
    nombre='form1.codi_'+cont_+'.value=""';
	eval(nombre);
  }
}

function validagrupo(){
  form1.action='fac_creagrpxcon.php';
  form1.submit();
}
function seleccionar(cont_){
var i,coman;
for(i=0;i<cont_;i++){
  if(form1.seltodo.checked==true){
    coman="form1.codi_"+i+".checked=true";
    eval(coman);
    coman="form1.codi_"+i+".value=form1.iden_gqx"+i+".value";
    eval(coman);
  }
  else{
    coman="form1.codi_"+i+".checked=false";
    eval(coman);
    coman="form1.codi_"+i+".value=''";
    eval(coman);
  }
  
}
}

function validaguarda(cont_){
var error="";
for(i=0;i<cont_;i++){
  coman="form1.codi_"+i+".checked";
  coman2="form1.valo_gxc"+i+".value";
  if(eval(coman)==true && (eval(coman2)=='' || eval(coman2)==0)){
    coman="form1.desc_gxc"+i+".value";
    error=error+eval(coman)+"\n";
  }
}
if(error!=""){
  alert("Los siguientes detalles no tienen valor: \n\n"+error);}
else{
  form1.submit();}
}
</script>
</head>
<body>
<form name='form1' method='post' action='fac_guardagruxcon.php'>
<table class="Tbl0"><tr><td class="Td0" align='center'>CONTRATO</td></tr></table>

<?
//echo $iden_ctr;
include('php/funciones.php');
include('php/conexion.php');
/*$consulta="SELECT con.neps_con,con.codi_con,
ccion.iden_ctr,ccion.nume_ctr,ccion.fini_ctr,ccion.ffin_ctr,ccion.mont_ctr,ccion.pctg_ctr,ccion.tari_ctr,ccion.tpor_crt
FROM contrato AS con
INNER JOIN contratacion AS ccion ON ccion.codi_con=con.codi_con
WHERE iden_ctr='$iden_ctr'";
echo $consulta;*/

$consulta=mysql_query("SELECT con.neps_con,con.codi_con,
ccion.iden_ctr,ccion.nume_ctr,ccion.fini_ctr,ccion.ffin_ctr,ccion.mont_ctr,ccion.pctg_ctr,ccion.tari_ctr,ccion.tpor_crt
FROM contrato AS con
INNER JOIN contratacion AS ccion ON ccion.codi_con=con.codi_con
WHERE iden_ctr=$iden_ctr");
$row=mysql_fetch_array($consulta);
$codi_con=$row[codi_con];
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
if(empty($tari_ctr)){$tari_ctr=$row[tari_ctr];}
if($pctg_ctr==""){$pctg_ctr=$row[pctg_ctr];}
$obser='';
if($tari_ctr=='1'){
  $obser='Soat con ';
}
if($tari_ctr=='2'){
  $obser='ISS 2001 con ';
}
if($tari_ctr=='3'){
  $obser='ISS 2004 con ';
}

if($tpor_crt=='+'){$tipo='de Incremento';}
if($tpor_crt=='-'){$tipo='de Descuento';}

$obser=$obser.'  '.$row[pctg_ctr].'%'.' '.$tipo;

echo "<td class='Td2'>$obser</td>";
echo "</tr>";
echo "</table>";
echo "<table class='Tbl0'><tr><td class='Td0' align='center'>ADICIONA GRUPOS Qx AL CONTRATO</td></tr></table>";

echo "<table class='Tbl0'><tr>";
echo "<td class='Td0' width='25%' align='right'>Grupo:</td>";
echo "<td class='Td0' width='25%'><select name='grupo'><option value=''>Todos";
$consultagr=mysql_query("SELECT iden_gqx,grup_gqx,desc_gqx FROM grupoqx GROUP BY grup_gqx");
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
$condicion='gru.grup_gqx<>""';
//$condicion=$condicion.'gxc.iden_gqx is Null';
if(!empty($grupo)){
  $condicion=$condicion." and gru.grup_gqx='".$grupo."'";
}
/*$consulta="SELECT gru.iden_gqx,gru.desc_gqx,gru.grup_gqx
FROM grupoqx AS gru
LEFT JOIN grupoxcont AS gxc on gxc.iden_gqx=gru.iden_gqx
WHERE $condicion";
echo $consulta;*/

/*$consulta=mysql_query("SELECT gru.iden_gqx,gru.desc_gqx,gru.grup_gqx
FROM grupoqx AS gru
LEFT JOIN grupoxcont AS gxc on gxc.iden_gqx=gru.iden_gqx and gxc.iden_gqx=$iden_ctr
WHERE $condicion");*/

$consulta=mysql_query("SELECT gru.iden_gqx,gru.desc_gqx,gru.grup_gqx
FROM grupoqx AS gru
WHERE $condicion");

if(mysql_num_rows($consulta)!=0){
  echo "<table class='Tbl0'>";
  echo "<th class='Th0' width='10%'>SEL</th>
        <th class='Th0' width='10%'>GRUPO</th>
	    <th class='Th0' width='60%'>DESCRIPCION</th>
		<th class='Th0' width='20%'>VALOR</th>";
  $cont=0;
  while($row=mysql_fetch_array($consulta)){
    //$consgup="SELECT iden_gxc FROM grupoxcont WHERE iden_ctr=$iden_ctr and iden_gqx=$row[iden_gqx]";
	//echo "<br>".$consgup;
    $consgup=mysql_query("SELECT iden_gxc FROM grupoxcont WHERE iden_ctr=$iden_ctr and iden_gqx=$row[iden_gqx]");
	if(mysql_num_rows($consgup)==0){
	  $var='iden_gqx'.$cont;
	  echo "<input type='hidden' name='$var' value='$row[iden_gqx]'>";
	  $var='codi_'.$cont;
      echo "<tr>";
      echo "<td class='Td4'><input type='checkbox' name='$var' onclick=\"validacod('$cont','$row[iden_gqx]')\" value=''></td>";
      echo "<td class='Td2' align='center'>$row[grup_gqx]</td>";
	  $var='desc_gxc'.$cont;
	  echo "<input type='hidden' name='$var' value='$row[desc_gqx]' size='20'>";
      echo "<td class='Td2'>$row[desc_gqx]</td>";
	  $var='valo_gxc'.$cont;
	  echo "<td class='Td2' align='center'><input type='text' name='$var' size='10' onKeypress='if (event.keyCode > 47 && event.keyCode <58 ||event.keyCode == 46) event.returnValue = true;else event.returnValue = false'></td>";
      echo"</tr>";
	  $cont++;
	}
  }
  echo "</table>";
  echo "<table class='Tbl2'>";
  echo "<tr>";
  echo "<td class='Td1' width='10%'><input type='checkbox' name='seltodo' onclick='seleccionar($cont)'>Seleccionar todos</td>";
  echo "<td class='Td1' width='45%'><a href='#' onclick='validaguarda($cont)'><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align='center'>Guardar</a></td>";
  echo "<td class='Td1' width='45%'><a href='fac_muesccion.php?codi_con=<?echo $codi_con;?>'>Regresar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align='center'></a></td>";
  echo "</tr>";
  echo "</table>";
  mysql_free_result($consgup);
}
else{
  echo "<center>";
  echo "<p class=Msg>No existen registros para esta busqueda</p>";
  echo "</center>";
}
mysql_free_result($consulta);
mysql_close();
?>
<script language='javascript'>
form1.seltodo.checked=true;
seleccionar('<?echo $cont;?>');
</script>
<input type='hidden' name='numact' value='<?echo $cont;?>'>
<input type='hidden' name='iden_ctr' value='<?echo $iden_ctr;?>'>
<input type='hidden' name='codi_con' value='<?echo $codi_con;?>'>
</form>
</body>
</html>