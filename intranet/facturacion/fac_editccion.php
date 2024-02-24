<html>
<head>
<title>PROGRAMA DE FACTURACIN</title>
</head>
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" /> 

<!-- librera principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librera para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librera que declara la funcin Calendar.setup, que ayuda a generar un calendario en unas pocas lneas de cdigo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language="javaScript">
function validar(){
var error="";
  if(form1.nume_ctr.value==""){error="Numero\n";}
  if(form1.codi_con.value==""){error=error+"Entidad\n";}
  if(form1.fini_ctr.value==""){error=error+"Fecha inicial\n";}
  if(form1.ffin_ctr.value==""){error=error+"Fecha de finalizacion\n";}
  if(form1.mont_ctr.value==""){error=error+"Monto del contrato\n";}
  if(form1.moda_ctr.value==""){error=error+"Modalidad de contratacion\n";}
  if(form1.ccon_ctr.value==""){error=error+"Codigo contable\n";}
  if(form1.debi_ctr.value==""){error=error+"Naturaleza de la cuenta\n";}
  if(form1.esta_ctr.value==""){error=error+"Estado\n";}
  if(form1.rcod_ctr.value==""){error=error+"Reportar con codificacion\n";}
  if(error!=""){
    alert("Para continuar debe completar la siguiente informacin:\n"+error);}
  else{
    form1.submit();}
}


function validalongitud(var_,numero){
  var longitud=eval("form1."+var_+".value.length");
  var nuevacad="";
  if(longitud>numero){
	nuevacad=eval("form1."+var_+".value").substr(0,numero);
	nuevacad=eval("form1."+var_+".value='"+nuevacad+"'");
  }
}
</script>

<body>
<?
include('php/funciones.php');
include('php/conexion.php');
?>
<form method="post" name="form1" action="fac_guardaeditccion.php">
<?
$consulta="SELECT con.nit_con,con.neps_con,con.dire_con,con.tele_con,con.pers_con, 
ccion.iden_ctr,ccion.nume_ctr,ccion.codi_con,ccion.fini_ctr,ccion.ffin_ctr,ccion.mont_ctr,ccion.rmon_ctr,ccion.rcop_ctr,ccion.rcuo_ctr,ccion.rord_ctr,ccion.rfdo_ctr,ccion.rfca_ctr,ccion.rdgr_ctr,ccion.moda_ctr,ccion.ccon_ctr,ccion.debi_ctr,ccion.obse_ctr,ccion.esta_ctr,ccion.pctg_ctr,ccion.tari_ctr,ccion.tpor_crt,
ccion.fmpr_ctr,ccion.fmme_ctr,ccion.fmin_ctr,ccion.rcod_ctr
FROM contrato AS con
INNER JOIN contratacion AS ccion ON ccion.codi_con=con.codi_con
WHERE iden_ctr='$iden_ctr'";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);
echo "<table class='Tbl0'>";
echo "<th class='Th0' width='15%'>NIT</th>
	  <th class='Th0' width='40%'>ENTIDAD</th>
	  <th class='Th0' width='15%'>CONTACTO</th>
	  <th class='Th0' width='15%'>TELEFONO</font></th>";
echo "<tr>";
echo "<td class='Td2'>$row[nit_con]</td>";
echo "<td class='Td2'>$row[neps_con]</td>";
echo "<td class='Td2'>$row[pers_con]</td>";
echo "<td class='Td2'>$row[tele_con]</td>";
echo "</tr>";
echo "</table>";
?>
<center>
<table class="Tbl0"><tr><td class="Td0" align='center'>MODIFICACION DEL CONTRATO</td></tr></table>
</center>
<br>
<?
include('fac_captuccion.php');

?>

<script language="javaScript">
  form1.nume_ctr.value='<?echo $row[nume_ctr];?>';
  form1.nume_ctr.disabled='true';
  form1.codi_con.value='<?echo $row[codi_con];?>';
  form1.codi_con.disabled=true;
  form1.fini_ctr.value='<?echo cambiafechadmy($row[fini_ctr]);?>';
  form1.ffin_ctr.value='<?echo cambiafechadmy($row[ffin_ctr]);?>';
  form1.mont_ctr.value='<?echo $row[mont_ctr];?>';  
  form1.moda_ctr.value='<?echo $row[moda_ctr];?>';
  form1.ccon_ctr.value='<?echo $row[ccon_ctr];?>';  
  form1.debi_ctr.value='<?echo $row[debi_ctr];?>';
  form1.obse_ctr.value='<?echo $row[obse_ctr];?>';  
  form1.pctg_ctr.value='<?echo $row[pctg_ctr];?>';  
  form1.esta_ctr.value='<?echo $row[esta_ctr];?>';
  form1.tari_ctr.value='<?echo $row[tari_ctr];?>';
  form1.tpor_crt.value='<?echo $row[tpor_crt];?>';  
  form1.rcod_ctr.value='<?echo $row[rcod_ctr];?>';  
</script>
<?
if($row[rmon_ctr]=='S'){
  ?>
  <script language="javaScript">form1.rmon_ctr.checked=true;</script>
  <?
}
if($row[rcop_ctr]=='S'){
  ?>
  <script language="javaScript">form1.rcop_ctr.checked=true;</script>
  <?
}
if($row[rcuo_ctr]=='S'){
  ?>
  <script language="javaScript">form1.rcuo_ctr.checked=true;</script>
  <?
}
if($row[rord_ctr]=='S'){
  ?>
  <script language="javaScript">form1.rord_ctr.checked=true;</script>
  <?
}
if($row[rfdo_ctr]=='S'){
  ?>
  <script language="javaScript">form1.rfdo_ctr.checked=true;</script>
  <?
}
if($row[rfca_ctr]=='S'){
  ?>
  <script language="javaScript">form1.rfca_ctr.checked=true;</script>
  <?
}
if($row[rdgr_ctr]=='S'){
  ?>
  <script language="javaScript">form1.rdgr_ctr.checked=true;</script>
  <?
}
if($row[fmpr_ctr]=='S'){
  ?>
  <script language="javaScript">form1.fmpr_ctr.checked=true;</script>
  <?
}
if($row[fmme_ctr]=='S'){
  ?>
  <script language="javaScript">form1.fmme_ctr.checked=true;</script>
  <?
}
if($row[fmin_ctr]=='S'){
  ?>
  <script language="javaScript">form1.fmin_ctr.checked=true;</script>
  <?
}
echo "<input type='hidden' name='iden_ctr' value='$iden_ctr'>";
//echo "<input type='text' name='codi_con' value='$row[codi_con]'>";
?>
  
<br>
<table class="Tbl2">
  <tr>
	<td class="Td1"><a href="#" onclick="javascript:validar()"><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align="top"> Guardar</a></td>
	<td class="Td1"><a href="#" onclick="javascript:history.go(-1)">Regresar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align="top"></a></td>
  </tr>
</table>

<?
mysql_free_result($consulta);
mysql_close();
?>
</form>
</body>
</html>