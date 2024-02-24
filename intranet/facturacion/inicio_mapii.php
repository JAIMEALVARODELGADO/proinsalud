<?
session_register('gclase');
session_register('gcod');
session_register('gnom');
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<SCRIPT LANGUAGE=JavaScript>

function validar()
{
  form1.submit()

}
/*function vaciar(){
form1.clase.value='';
form1.cod.value='';
form1.nom.value='';
}*/

</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<form name="form1" method="POST" action="busq_mapii.php" target='fr02'>
<?
include('php/conexion.php');
?>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0">
  <tr><td class="Td0" align='center'>MANUAL DE ATENCION PROCEDIMIENTOS E INSUMOS INSTITUCIONALES</td></tr>
</table>
<br>
<center>
<table class="Tbl0" border="0">
<tr>
  <td class="Td2" align='right' width='10%'><b>Clase:</td>
  <td class="Td2" align='left' width='25%'><select name='clase' onFocus="vaciar()">
    <option value=''>
    <?
	  $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='18' order by nomb_des");
	  while($row=mysql_fetch_array($consulta)){
	    echo "<option value='$row[codi_des]'>$row[nomb_des]";
	  }
	?>
    
  </td>
  <td class="Td2" align='right' width='10%'><b>Código:</td>
  <td class="Td2" align='left' width='15%'><input type='text' name='cod' size='10' maxlength='10' onFocus="vaciar()"></td>
  <td class="Td2" align='right' width='10%'><b>Nombre:</td>
  <td class="Td2" align='left' width='10%'><input type='text' name='nom' size='30' maxlength='30' onFocus="vaciar()"></td>
  <td class="Td2" align='left' width='10%'><a href='#' onclick='validar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td>
  <td class="Td2" align='left' width='10%'><a href='fac_creamapii.php' target='fr02'><img src='icons/feed_add.png' border='0' alt='Nuevo' width=20 height=20></a></td>
</tr>
</table>
</center>
<input type=hidden name=control value=1>
</form>
</body>
</html>
