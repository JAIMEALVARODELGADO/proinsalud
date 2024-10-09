<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<HEAD>
<TITLE>Impresion de Imagenología</TITLE>
<link rel="stylesheet" href="css/style.css" type="text/css" />

<script languaje=javascript>
function validar(){
  var error=0;
  if((form1.nrod_usu.value=="") && (form1.flec_ini.value=="") && (form1.flec_fin.value=="") ){error=1;}
  if(error==1){
    alert("Se debe diligenciar al menos un parámetro");
	return;
  }
  form1.submit();
}
	
</script>

</HEAD>
<BODY >
<form name='form1' method='post' action='imagen31.php' target='fra_im2'>
<table class='Tbl1'><tr><th class='Th1'>PARÁMETROS DE BUSQUEDA</th></tr></table>
<?
include('php/funciones.php');
$hoy=hoy();
?>

<table class='Tbl1'>
<tr>
  <td class='Td0' align='right' width='10%'>Identificación:</td>
  <td class='Td2' align='left' width='10%'><input type='text' name='nrod_usu' size='20' maxlength='20'></td>
  <td class='Td0' align='right' width='15%'>Fecha de lectura inicial:</td>
  <td class='Td2' align='left' width='10%'><input type='text' name='flec_ini' size='10' maxlength='10' value='<?echo $hoy;?>'></td>
  <td class='Td0' align='right' width='15%'>Fecha de lectura final:</td>
  <td class='Td2' align='left' width='10%'><input type='text' name='flec_fin' size='10' maxlength='10' value='<?echo $hoy;?>'></td>
  <td class='Td0' align='left' width='30%'><a href='#' onclick='validar()'><img src='img/feed_magnify-1.png'></a></td>
</tr>
</table>
</form>
</BODY>
</HTML>
