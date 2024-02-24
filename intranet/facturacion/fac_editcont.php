<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language="javaScript">
function validar(){
var error="";
  if(form1.nit_con.value==""){error=error+"Nit\n";}
  if(form1.neps_con.value==""){error=error+"Nombre\n";}
  if(form1.ctri_con.value==""){error=error+"Clasificación tributaria\n";}
  if(form1.tpen_con.value==""){error=error+"Tipo de entidad\n";}
  if(form1.clas_con.value==""){error=error+"Clase de entidad\n";}
  if(form1.codi_cdc.value==""){error=error+"Centro de Costos\n";}
  if(form1.esta_con.value==""){error=error+"Estado\n";}
  if(error!=""){
    alert("Para continuar debe completar la siguiente información:\n"+error);}
  else{
    form1.submit();}
}
function muestramsg(msg_){
    alert(msg_);
}
</script>

<body>
<?
include('php/conexion.php');
$consulta="SELECT ceps_con,nit_con,neps_con,nomr_con,dire_con,tele_con,repr_con,pers_con,chab_con,ctri_con,tpen_con,clas_con,esta_con,codi_cdc,vige_con,codase_con FROM contrato WHERE codi_con='$codi_con'";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);
?>
<form method="post" name="form1" action="fac_guardamodcon.php">
<center>
<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DE LA ENTIDAD</td></tr></table>
<br>
<?php
require('fac_captucon.php');
?>
<br>

<table class="Tbl2">
	<tr>
	<td class="Td1"><a href="#" onclick="javascript:validar()"><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align="top"> Guardar </a></td>
	<td class="Td1"><a href="#" onclick="javascript:history.go(-1)">Regresar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align="top"></a></td>
</table>

<script language="javaScript">
  form1.codi_.value='<?echo $codi_con;?>'
  form1.codi_.disabled=true;
  form1.nit_con.value='<?echo $row[nit_con];?>'
  form1.neps_con.value='<?echo $row[neps_con];?>'
  form1.neps_con.value='<?echo $row[neps_con];?>'
  form1.ceps_con.value='<?echo $row[ceps_con];?>'
  form1.dire_con.value='<?echo $row[dire_con];?>'
  form1.tele_con.value='<?echo $row[tele_con];?>'
  form1.repr_con.value='<?echo $row[repr_con];?>'
  form1.pers_con.value='<?echo $row[pers_con];?>'
  form1.chab_con.value='<?echo $row[chab_con];?>'
  form1.ctri_con.value='<?echo $row[ctri_con];?>';
  form1.tpen_con.value='<?echo $row[tpen_con];?>';
  form1.clas_con.value='<?echo $row[clas_con];?>';
  form1.codi_cdc.value='<?echo $row[codi_cdc];?>';
  form1.vige_con.value='<?echo $row[vige_con];?>';
  form1.nomr_con.value='<?echo $row[nomr_con];?>';
  form1.esta_con.value='<?echo $row[esta_con];?>';
  form1.codase_con.value='<?echo $row[codase_con];?>';
</script>

<input type='hidden' name='codi_con' size='3' maxlength='3' value='<?echo $codi_con;?>'>
<input type="hidden" name="nit_ant" value='<?echo $row[nit_con];?>'>

<?

mysql_free_result($consulta);
mysql_free_result($consultatp);
mysql_close();
?>
</form>
</body>
</html>