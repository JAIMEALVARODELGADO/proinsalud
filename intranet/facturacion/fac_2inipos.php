<?
session_start();
session_register('serv_fac');
session_register('esta_fac');
session_register('ord_fac');
$serv_fac='';
$esta_fac='';
$ord_fac='';
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN - PROFACTU</title>
<SCRIPT LANGUAGE=JavaScript>
	function comprobar()
	{
		form1.submit();
	}
	function envio()
	{
	    form1.action='fac_2posfa.php';
		form1.target='fr02';
		form1.submit();
	}
</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<form name="form1" method="POST" action="fac_2posfa.php" target='fr01'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0"><tr><td class="Td0" align='center'>FACTURACION - POSFACTU</td></tr></table><br>
<?include('php/conexion.php');?>
<center><table class="Tbl0">
	<tr>
	  <td class="Td2" align='right' width='10%'><b>Identificación:</td>
	  <td class="Td2" align='left' width='10%'><input type='text' name='nrod_usu' size='14' maxlength='20'></td>
	  <td class="Td2" align='right' width='10%'><b>Servicio:</td>
	  <td class="Td2" align='left' width='10%'>
	  <select name='serv'><option value=''>
	  <?
		  $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='06' and homo2_des='F' order by nomb_des ");
		  while($row=mysql_fetch_array($consulta)){
	      echo "<option value='$row[codi_des]'>$row[nomb_des]";}
	  ?>
	  </select></td>
	
	  <td class="Td2" align='right' width='10%'>Estado:</td>
	  <td class="Td2" align='left' width='10%'>
	  <select name='esta'><option value=''>
	  <option value='0'>Egresados
      <option value='-1'>En el Servicio
	  </select></td>
	  <td class="Td2" align='left' width='10%'><a href='#' onclick='envio()' ><img src='icons/feed_add.png' border='0' alt='Continuar' width=20 height=20></a></td>
	</tr>
</table></center>
</form>
</body>
</html>