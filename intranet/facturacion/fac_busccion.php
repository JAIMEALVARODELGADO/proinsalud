<html>
<head>
<title>PROGRAMA DE FACTURACI�N</title>

<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" /> 

<!-- librer�a principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librer�a para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<SCRIPT LANGUAGE='JavaScript'>

function validar()
{
  if(form1.codi_con.value==""){
    alert("Debe seleccionar la entidad");
  }
  else{
    form1.submit();
  }
}

</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<form name="form1" method="POST" action="fac_muesccion.php" target='fr02'>
<?
include('php/conexion.php');
?>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0">
  <tr><td class="Td0" align='center'>CONTRATACION</td></tr>
</table>
<br>
<center>
<table class="Tbl0" border='0'>
<tr>
  <td class="Td2" align='right' width='20%'><b>Entidad</td>
  <td class="Td2" align='left' width='15%'><select name='codi_con'><option value=''>
  <?
    //$consultaent=mysql_query("SELECT codi_con,neps_con FROM contrato WHERE esta_con='A' ORDER BY neps_con");
    $consultaent=mysql_query("SELECT codi_con,neps_con FROM contrato ORDER BY neps_con");
	while($rowent=mysql_fetch_array($consultaent)){
	  echo "<option value='$rowent[codi_con]'>$rowent[neps_con]";
	}
  ?>
  </td>
  <td class="Td2" align='left' width='5%'><a href='#' onclick='validar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td>
  <td class="Td2" align='left' width='10%'><a href='fac_creaccion.php' target='fr02'><img src='icons/feed_add.png' border='0' alt='Crea Nueva Contrataci�n' width=20 height=20></a></td>
</tr>
</table>
</center>
<?
mysql_close();
?>
</form>
</body>
</html>
<html><head></head><body></body></html>