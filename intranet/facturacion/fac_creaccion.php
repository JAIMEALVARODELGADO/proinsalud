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
  if(form1.nume_ctr.value==""){error="Nmero\n";}
  if(form1.codi_con.value==""){error=error+"Entidad\n";}
  if(form1.fini_ctr.value==""){error=error+"Fecha inicial\n";}
  if(form1.ffin_ctr.value==""){error=error+"Fecha de finalizacin\n";}
  if(form1.mont_ctr.value==""){error=error+"Monto del contrato\n";}
  if(form1.moda_ctr.value==""){error=error+"Modalidad de contratacin\n";}
  if(form1.ccon_ctr.value==""){error=error+"Cdigo contable\n";}
  if(form1.debi_ctr.value==""){error=error+"Naturaleza de la cuenta\n";}
  if(form1.esta_ctr.value==""){error=error+"Estado\n";}
  if(form1.rcod_ctr.value==""){error=error+"Reportar con codificacin\n";}  
  if(error!=""){
    alert("Para continuar debe completar la siguiente informacin:\n"+error);}
  else{
    form1.submit();}
}

function valida2(op){
form1.vcod.value=op;
form1.submit();
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
<?php
include('php/conexion.php');
?>
<form method="post" name="form1" action="fac_guardaccion.php">
<center>
<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DE LA NUEVA CONTRATACION</td></tr></table>
<br>
<?php
include('fac_captuccion.php');
?>
<br>

<table class="Tbl2">
  <tr>
	<td class="Td1"><a href="#" onclick="javascript:validar()"><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align="top"> Guardar</a></td>
	<td class="Td1"><a href="fondo.php" onclick="javascript:history.go(-1)">Cancelar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align="top"></a></td>
  </tr>
</table>
<input type="hidden" name="vcod" value=0>
<?
//mysql_free_result($consulta);
mysql_close();
?>
</form>
</body>
</html>