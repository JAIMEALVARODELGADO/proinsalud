<html>
<head>
<title>PROGRAMA DE FACTURACIÓN - PROFACTU</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 
<!-- librería principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<!-- librería para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<SCRIPT LANGUAGE=JavaScript>
function validar(){
var error='';
if(form1.mapip_med.value==''){
  error=error+"La consulta de primera vez\n";}
if(form1.mapic_med.value==''){
  error=error+"La consulta de control\n";}
if(error!=''){
  alert("Debe seleccionar:\n\n"+error);
  return;
}
form1.submit();
}	
</script>
</head>

<form name="form1" method="POST" action="fac_guardamap.php" target='fr02'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0"><tr><td class="Td0" align='center'>EDITAR CODIGOS DE CONSULTA</td></tr></table><br>
<?
include('php/conexion.php');
$consmed=mysql_query("SELECT cod_medi,nom_medi,mapip_med,mapic_med FROM medicos WHERE cod_medi='$cod_medi'");
$rowmed=mysql_fetch_array($consmed);
?>
<center>
<table class="Tbl1" border="0">
	<tr>
	  <td class="Td2" align='right' width='5%'><b>Código:</td>
	  <td class="Td2" align='left' width='10%'><?echo $cod_medi;?></td>
	  <td class="Td2" align='right' width='5%'><b>Nombre:</td>
	  <td class="Td2" align='left' width='80%'><?echo $rowmed[nom_medi];?></td>
	</tr>
</table></center>
<br><br><br>
<center>

<table class="Tbl1" border="0">
	<tr>
	  <td class="Td2" align='right' width='20%'><b>Consulta de primera vez:</td>
	  <td class="Td2" align='left' width='80%'><select name='mapip_med'>
	    <option value=''>
	    <?
	      $consultamap=mysql_query("SELECT iden_map,desc_map FROM mapii WHERE desc_map LIKE '%consulta%' ORDER BY desc_map");
	      while($rowmap=mysql_fetch_array($consultamap)){
	        echo "<option value='$rowmap[iden_map]'>$rowmap[desc_map]";
          }
		?>
	    </select>
	  </td>
	</tr>
	<tr>
	  <td class="Td2" align='right' width='20%'><b>Consulta de control:</td>
	  <td class="Td2" align='left' width='80%'><select name='mapic_med'>
	    <option value=''>
	    <?
	      $consultamap=mysql_query("SELECT iden_map,desc_map FROM mapii WHERE desc_map LIKE '%consulta%' ORDER BY desc_map");
	      while($rowmap=mysql_fetch_array($consultamap)){
	        echo "<option value='$rowmap[iden_map]'>$rowmap[desc_map]";
          }
		?>
	    </select>
	  </td>
	</tr>
</table></center>
<input type='hidden' name='cod_medi' value='<?echo $cod_medi;?>'>
<script language='javascript'>
   form1.mapip_med.value='<?echo $rowmed[mapip_med]?>';
   form1.mapic_med.value='<?echo $rowmed[mapic_med]?>';
</script>
<table class="Tbl2">
	<tr>
	<td class="Td1"><a href="#" onclick="javascript:validar()"><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align="top"> Guardar </a></td>
	<td class="Td1"><a href="fondo.php" onclick="javascript:history.go(-1)">Cancelar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align="top"></a></td>
</table>
</form>
</body>
</html>
