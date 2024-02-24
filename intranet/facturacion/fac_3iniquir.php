<?
session_start();
//session_register('serv_fac');
//session_register('esta_fac');
//session_register('fecha_ini');
//session_register('fecha_fin');
?>
<html>
<head>
<title>PROGRAMA DE FACTURACI�N</title>
<SCRIPT LANGUAGE='JavaScript'>
function validar(){
var error='';
  if(form1.fechaini.value=='' && 
     form1.fechafin.value=='' &&
	 form1.identif.value=='' &&
	 form1.contra.value==''){error='1';}
  if(error!=''){
    alert("Para continuar debe diligenciar alguno de los par�metros de b�squeda");}
  else{
    form1.submit();}  
}
</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body lang=ES  style='tab-interval:35.4pt'  >
<form name="form1" method="POST" action="fac_3quirof.php" target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>FACTURACION DE QUIROFANO</td></tr></table><br>
<?
include('php/conexion.php');
include('php/funciones.php');
?>
<center><table class="Tbl0" border='0'>
	<tr>
	  <td class="Td2" align='right' width='10%'><b>Fecha Inicial:</td>
	  <td class="Td2" align='left' width='10%'><input type='text' name='fechaini' size='10' maxlength='10' value='<?echo hoy();?>'></td>
	  <td class="Td2" align='right' width='10%'><b>Fecha Final:</td>
	  <td class="Td2" align='left' width='10%'><input type='text' name='fechafin' size='10' maxlength='10' value='<?echo hoy();?>'></td>
	  <td class="Td2" align='right' width='10%'><b>Identificacion:</td>
	  <td class="Td2" align='left' width='10%'><input type='text' name='identif' size='13 ' maxlength='20'></td>
	  <td class="Td2" align='right' width='10%'><b>Contrato:</td>
	  <td class="Td2" align='left' width='20%'> 
	  <select name='contra'><option value=''>
	  <?
	    $consultacon=mysql_query("SELECT con.codi_con,con.neps_con FROM contrato AS con WHERE esta_con='A' ORDER BY con.neps_con");
		while($rowcon=mysql_fetch_array($consultacon)){
		  echo "<option value='$rowcon[codi_con]'>$rowcon[neps_con]";
		}
	  ?>
	  </select></td>
	  <td class="Td2" align='left' width='10%'><a href='#' onclick='validar()' ><img src='icons/feed_add.png' border='0' alt='Continuar' width='20' height='20'></a></td>
	</tr>
</table></center>
</form>
</body>
</html>