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

<SCRIPT LANGUAGE=JavaScript>

function validar()
{
  /*if(form1.nit.value=="" && form1.razons.value==""){
    alert("Debe digitar el nit o parte de la raz�n social a buscar");
  }
  else{*/
  form1.submit()
  //}
}

</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<form name="form1" method="POST" action="fac_muestracon.php" target='fr02'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0">
  <tr><td class="Td0" align='center'>ENTIDAD</td></tr>
</table>
<br>
<center>
<table class="Tbl0">
<tr>
  <td class="Td2" align='right' width='20%'><b>Nit:</td>
  <td class="Td2" align='left' width='20%'><input type='text' name='nit' size='10' maxlength='10'></td>
  <td class="Td2" align='right' width='20%'><b>Raz�n Social:</td>
  <td class="Td2" align='left' width='20%'><input type='text' name='razons' size='30' maxlength='30'></td>
  <td class="Td2" align='left' width='10%'><a href='#' onclick='validar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td>
  <td class="Td2" align='left' width='10%'><a href='fac_creacon.php' target='fr02'><img src='icons/feed_add.png' border='0' alt='Nuevo' width=20 height=20></a></td>
</tr>
</table>
</center>

</form>
</body>
</html>
