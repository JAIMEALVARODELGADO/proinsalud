<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" /> 
<!-- librería principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<!-- librería para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<SCRIPT LANGUAGE=JavaScript>
function validar(){
var error='';
  //if(form1.factura.value=='' && form1.nit.value=='' && form1.fechaini.value==''){
  if(form1.factura.value=='' && form1.fechaini.value==''){
      error='Debe digitar:\n El número de Factura o \n el rango de fechas de facturacion';
  }
  if(error!=''){alert(error);}
  else{
      form1.submit()
  }
}

</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<?
include('php/conexion.php');
?>
<form name="form1" method="POST" action="fac_4hegenerasiigo.php" target='fr02'>
<body lang=ES  style='tab-interval:35.4pt'>
<table class="Tbl0">
  <tr><td class="Td0" align='center'>TRASLADO A  S I I G O</td></tr>
</table>

<center>
<table class="Tbl0" border='0'>
<tr>
  <td class="Td2" align='right' width='10%'><b>Factura Nro:</td>
  <td class="Td2" align='left' width='10%'><input type='text' name='factura' size='15' maxlength='15' value='<?echo $factura;?>'></td>
  <td class="Td2" align='right' width='10%'><b>Entidad Pagadora:</td>
  <td class="Td2" align='left' width='15%'><select  multiple name='nit[]' style='height: 60pt'>
        <option value=''>
	<?
	$consultacon=mysql_query("SELECT con.nit_con,con.neps_con
	FROM contrato AS con WHERE con.nit_con<>'' ORDER BY con.neps_con");
	while($rowcon=mysql_fetch_array($consultacon)){
	  echo "<option value='$rowcon[nit_con]'>$rowcon[neps_con]";
	}
	?>
	</select>
  </td>
  <td class="Td2" align='right' width='10%'><b>Tipo de Factura:</td>
  <td class="Td2" align='left' width='10%'>
        <select name='tipo_fac'>
        <option value=''>
        <option value='1'>Contado
	<option value='2'>Crédito
	</select>
  </td>
  </tr>
  <tr>
  
<tr>
    <td class="Td2" align='right'><b>Prefijo:</td>
    <td class="Td2" align='left'><select name='pref_fac' >
		<option value="FE">FE</option>
        <option value="I">I</option>
		<option value="R">R</option>
        </select>
    </td>
    <td class="Td2" align='left' colspan='2'><input type="checkbox" name="chkcta"><b>Incluir facturas sin cuenta de cobro</td>
    <td class="Td2" align='right' width='10%'><b>Fecha Desde:</td>
    <td class="Td2" align='left' width='25%'><input type='text' id="fechaini" name='fechaini' size='10' maxlength='10' value='<?echo $fechaini;?>'>
      <input type="button" id="lanzador1" value="..." />
			<dd><dd><script type="text/javascript"> 
				  Calendar.setup({ 
				  inputField     :    "fechaini",     // id del campo de texto 
				  ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
				  button     :    "lanzador1"     // el id del botón que lanzará el calendario 
				  }); 
			 </script>
    </td>
</tr>
<tr>
    <td class="Td2" align='right' colspan='5'><b>Hasta:</td>
    <td class="Td2" align='left'><input type='text' id='fechafin' name='fechafin' size='10' maxlength='10' value='<?echo $fechafin;?>'>
        <input type="button" id="lanzador2" value="..." />
                          <dd><dd><script type="text/javascript"> 
                                    Calendar.setup({ 
                                    inputField     :    "fechafin",     // id del campo de texto 
                                    ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
                                    button     :    "lanzador2"     // el id del botón que lanzará el calendario 
                                    }); 
                           </script>
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
//mysql_free_result($consultarel);
mysql_close();
?>
</form>
</body>
</html>
