<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<SCRIPT LANGUAGE=JavaScript>

function validar()
{
  form1.submit()
}

</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<form name="form1" method="POST" action="fac_muesccos.php" target='fr02'>
<?
include('php/conexion.php');
?>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0">
  <tr><td class="Td0" align='center'>CENTROS DE COSTOS</td></tr>
</table>
<br>
<center>
<table class="Tbl0" border="0">
<tr>
  <td class="Td2" align='right' width='10%'><b>Código:</td>
  <td class="Td2" align='left' width='5%'><input type='text' name='cod' size='4' maxlength='4'></td>
  <td class="Td2" align='right' width='5%'><b>Nombre:</td>
  <td class="Td2" align='left' width='15%'><input type='text' name='nom' size='30' maxlength='30'></td>
  <td class="Td2" align='left' width='5%'><a href='#' onclick='validar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td>
  <td class="Td2" align='left' width='60%'><a href='fac_creaccos.php' target='fr02'><img src='icons/feed_add.png' border='0' alt='Nuevo' width=20 height=20></a></td>
</tr>
</table>
</center>
<input type=hidden name=control value=1>
</form>
</body>
</html>
