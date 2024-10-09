<html>
<head>
<title>PROGRAMA DE FACTURACI�N</title>
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" /> 
<!-- librer�a principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<!-- librer�a para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<SCRIPT LANGUAGE=JavaScript>
function recargar(){
  form1.action='fac_4hebuscarips2.php';
  form1.target='fr01';
  form1.submit();
}
function validar(){
var error='';
  if(form1.factura.value=='' && form1.relacion.value==''){error='Debe digitar:\n El n�mero de Factura o \n El n�mero de Relaci�n';}
  if(error!=''){alert(error);}
  else{form1.submit()}
}

</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<?
include('php/conexion.php');
?>
<form name="form1" method="POST" action="fac_4hemuestrarips.php" target='fr02'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0">
  <tr><td class="Td0" align='center'>R I P S</td></tr>
</table>
<br>
<center>
<table class="Tbl0" border='0'>
<tr>
  <td class="Td2" align='right' width='10%'><b>Factura Nro:</td>
  <td class="Td2" align='left' width='10%'><input type='text' name='factura' size='15' maxlength='15' value='<?echo $factura;?>'></td>
  <td class="Td2" align='right' width='20%'><b>Entidad Pagadora:</td>
  <td class="Td2" align='left' width='15%'><select name='nit' onchange='recargar()'>
    <option value=''>
	<?
	$consultacon=mysql_query("SELECT con.nit_con,con.neps_con
	FROM contrato AS con WHERE con.nit_con<>'' ORDER BY neps_con");
	while($rowcon=mysql_fetch_array($consultacon)){
	  echo "<option value='$rowcon[nit_con]'>$rowcon[neps_con]";
	}
	?>
	</select>
  </td>
  <td class="Td2" align='right' width='15%'><b>Relacion:</td>
  <td class="Td2" align='left' width='30%'><select name='relacion'>
    <option value=''>
	<?
	$consultarel=mysql_query("SELECT cco.iden_cco,cco.rela_cco FROM cuenta_cobro AS cco WHERE cco.nit_cco='$nit'");
	while($rowrel=mysql_fetch_array($consultarel)){
	  echo "<option value='$rowrel[rela_cco]'>$rowrel[rela_cco]";
	}
	?>
	</select>
  </td>
</tr>
<tr>
    <td class="Td2" align='right'><b>Prefijo:</td>
    <td class="Td2" align='left'><select name='pref_fac' >
    <?php
        $consultaconsec="select c.prefijo from consecutivo c WHERE c.estado ='A' ORDER BY prefijo";
        $consultaconsec=mysql_query($consultaconsec);
        while($row=mysql_fetch_array($consultaconsec)){
            echo "<option value='$row[prefijo]'>$row[prefijo]</option>";
        }
      ?>
      </select>
    </td>
</tr>
</table>
</center>
<script language='javascript'>
form1.nit.value='<?echo $nit;?>';
</script>
<center>
<a href='#' onclick='validar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20>Buscar</a>
</center>
<?
mysql_free_result($consultacon);
mysql_free_result($consultarel);
mysql_close();
?>
</form>
</body>
</html>
