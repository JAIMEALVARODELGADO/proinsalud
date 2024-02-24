<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language="javaScript">
function validar(){
var error="";
  if(form1.nomb_cdc.value==""){error=error+"Nombre\n";} 
  if(error!=""){
    alert("Para continuar debe completar la siguiente información:\n\n"+error);}
  else{
    form1.action="fac_guardaeditccos.php";
    form1.submit();}
}

</script>

<body>
<?
include('php/conexion.php');
$consulta="SELECT codi_cdc,nomb_cdc
FROM centros_costo WHERE codi_cdc='$codi_cdc'";
//echo $consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);
?>
<form method="post" name="form1" action="fac_muesccos.php">
<center>
<table class="Tbl0"><tr><td class="Td0" align='center'>EDITA CENTRO DE COSTOS</td></tr></table>
<br>

<table class="Tbl0" border='0'>
<tr>
  <td class="Td2" align='right'>Código: </td>
  <td class="Td2" align='left'><input type='text' name='codi_cdc' size='4' maxlength='4' value=<?echo $row[codi_cdc]?> disabled></td>
</tr>
<tr>
  <td class="Td2" align='right'>Nombre</td>
  <td class="Td2" align='left'><input type='text' name='nomb_cdc' size='40' maxlength='40' value='<?echo $row[nomb_cdc];?>'></td>
</tr>
</table>
<br><br><br>
<table class="Tbl2">
	<tr>
	<td class="Td1"><a href="#" onclick="javascript:validar()"><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align="top"> Guardar </a></td>
	<td class="Td1"><a href="fondo.php" onclick="javascript:history.go(-1)">Cancelar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align="top"></a></td>
</table>
<?
echo "<input type='hidden' name='codi_cdc' value='$codi_cdc'>";
mysql_free_result($consulta);
mysql_close();
?>
</form>
</body>
</html>