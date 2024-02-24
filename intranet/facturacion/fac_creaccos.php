<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language="javaScript">
function validar(){
var error='';
    if(form1.codi_cdc.value==''){error=error+'Codigo del centro de costos\n'}
    if(form1.nomb_cdc.value==''){error=error+'Nombre del centro de costos\n'}
    if(error!=''){
        alert('Para guardar, debe completar la siguiente informacion\n'+error);
        return(false);
    }
    form1.submit();
}
</script>

<body>
<?
include('php/conexion.php');
?>
<form method="post" name="form1" action="fac_guardaccos.php">
<center>
<table class="Tbl0"><tr><td class="Td0" align='center'>INGRESO DE NUEVO CENTRO DE COSTOS</td></tr></table>
<br>
<table class="Tbl0" border='0'>
<tr>
  <td class="Td2" align='right'>Código: </td>
  <td class="Td2" align='left'><input type='text' name='codi_cdc' size='4' maxlength='4'></td>
</tr>
<tr>
  <td class="Td2" align='right'>Nombre</td>
  <td class="Td2" align='left'><input type='text' name='nomb_cdc' size='40' maxlength='40'></td>
</tr>
</table>

<br><br>
<table class="Tbl2">
	<tr>
	<td class="Td1"><a href="#" onclick="javascript:validar('<?echo $codi_cdc;?>')"><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align="top"> Guardar </a></td>
	<td class="Td1"><a href="fondo.php" onclick="javascript:history.go(-1)">Cancelar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align="top"></a></td>
</table>
<?
mysql_close();
?>
</form>
</body>
</html>