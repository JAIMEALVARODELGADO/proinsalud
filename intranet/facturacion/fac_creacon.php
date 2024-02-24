<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language="javaScript">
function validar(){
var error="";
  //if(form1.codi_con.value==""){error="Código\n";}
  if(form1.nit_con.value==""){error=error+"Nit\n";}
  if(form1.neps_con.value==""){error=error+"Nombre\n";}
  if(form1.ctri_con.value==""){error=error+"Clasificación tributaria\n";}
  if(form1.tpen_con.value==""){error=error+"Tipo de entidad\n";}
  if(form1.clas_con.value==""){error=error+"Clase de entidad\n";}
  if(error!=""){
    alert("Para continuar debe completar la siguiente información:\n"+error);}
  else{
    form1.submit();}
}

function valida2(op){
form1.vcod.value=op;
form1.submit();
}
function muestramsg(msg_){
    alert(msg_);
}
</script>

<body>
<?
include('php/conexion.php');
?>
<form method="post" name="form1" action="fac_guardacon.php">
<center>
<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DE LA NUEVA ENTIDAD</td></tr></table>
<br>
<?php
require('fac_captucon.php');
?>
<br>
<table class="Tbl2">
	<tr>
	<td class="Td1"><a href="#" onclick="javascript:validar()"><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align="top"> Guardar </a></td>
	<td class="Td1"><a href="fondo.php" onclick="javascript:history.go(-1)">Cancelar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align="top"></a></td>
</table>
<script language="javaScript">
    form1.codi_.disabled=true;
</script>
<input type="hidden" name="vcod" value=0>

<?
//mysql_free_result($consulta);
mysql_close();
?>
</form>
</body>
</html>