<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>

<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" /> 

<!-- librería principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librería para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<SCRIPT LANGUAGE='JavaScript'>

function validar(){
if(form1.cod_medi.value=="" && form1.nom_medi.value==""){
  alert("Debe digitar almenos un parametro de busqueda");}
else{
  form1.submit();}
}

</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<form name="form1" method="POST" action="fac_muesmedic.php" target='fr02'>
<?
include('php/conexion.php');
?>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0">
  <tr><td class="Td0" align='center'>CODIGO DE CONSULTA PARA LOS MEDICOS</td></tr>
</table>
<br>
<center>
<table class="Tbl0" border='0'>
<tr>
  <td class="Td2" align='right' width='15%'><b>Código</td>
  <td class="Td2" align='left' width='15%'><input type='text' name='cod_medi' size='10'></td>
  <td class="Td2" align='right' width='15%'><b>Nombre</td>
  <td class="Td2" align='left' width='25%'><input type='text' name='nom_medi' size='30'></td>
  <td class="Td2" align='left' width='30%'><a href='#' onclick='validar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td>  
</tr>
</table>
</center>
<?
mysql_close();
?>
</form>
</body>
</html>
