<html>
<head>
<title>PROGRAMA DE FACTURACI�N - PROFACTU</title>
<SCRIPT LANGUAGE=JavaScript>
function comprobar(){
    form1.submit();
}
	function envio()
	{
	    //form1.action='fac_2anteenca.php';
	    form1.action='fac_2encapre.php';
            form1.target='fr02';
            form1.submit();
	}
</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<form name="form1" method="POST" action="fac_2inicio.php" target='fr01'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0"><tr><td class="Td0" align='center'>FACTURACION - PROFACTU</td></tr></table><br>
<?
include('php/conexion.php');?>
<center><table class="Tbl0" border='0'>
	<tr>
	  <td class="Td2" align='right' width='40%'><b>Identificaci�n:</td>
	  <td class="Td2" align='left' width='10%'><input type='text' name='iden' size='10' maxlength='20' onblur='comprobar()' value=<? echo $iden; ?>></td>
	
	  <td class="Td2" align='right' width='10%'><b>Entidad:</td>
	  <td class="Td2" align='left' width='40%'>
	  
	  <select name='enti'><option value=''>
	  <?
		  $consulta=mysql_query("SELECT NROD_USU, CONT_UCO, NEPS_CON FROM usuario
                          INNER JOIN ucontrato ON CODI_USU = CUSU_UCO
                          INNER JOIN contrato ON CONT_UCO = CODI_CON
                          WHERE NROD_USU = '$iden'");
		  while($row=mysql_fetch_array($consulta)){
	      echo "<option value='$row[CONT_UCO]'>$row[NEPS_CON]";}
	  ?>
	  </select>
	  <script language='javascript'>form1.enti.value='<?echo $enti;?>';</script>
	  <a href='#' onclick='envio()' ><img src='icons/feed_add.png' border='0' alt='Continuar' width=20 height=20></a>
          </td>
	</tr>
</table></center>
</form>
</body>
</html>
<html><head></head><body></body></html>