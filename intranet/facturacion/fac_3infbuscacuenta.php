<html>
<head>
<title>Cuenta de Cobro</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function buscar(){
  if(form1.relacion.value==''){
    alert("Debe digitar el numero de relación");
  }
  else{
    form1.submit();
  }
}
</script>
</head>
<body lang=ES  style='tab-interval:35.4pt'  >
<form name="form1" method="POST" action="fac_3infmuescuenta.php" target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>Cuenta de Cobro</td></tr></table>
<br><br><br>
<table class="Tbl0" border='0'>
  <tr>
    <td class="Td2" align='right' width='40%'>Relación:</td>
	<td class="Td2" align='left' width='20%'><input type='text' name='relacion'></td>
	<td class="Td2" align='left' width='40%'><a href='#' onclick='buscar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20>Buscar</a></td>
  </tr>
</table>
</form>
</body>
</html>
