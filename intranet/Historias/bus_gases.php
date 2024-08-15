<html>
<head>
<title>Gases Arteriales</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 
<!-- librer?a principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<!-- librer?a para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<!-- librer?a que declara la funci?n Calendar.setup, que ayuda a generar un calendario en unas pocas l?neas de c?digo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<SCRIPT LANGUAGE=JavaScript>
function verificar(){
	form1.submit();}
</script>
</head>
<form name="form1" method="POST" action="rev_gases.php" target='fr04'>
<body>
 <table class="Tbl0">
   <tr><td class='Td1' align='center'>Reporte de Gases Arteriales</td></tr>
 </table>
 <center>
 <?
	include('php/conexion.php');
    base_proinsalud();
	echo "<table class='Tbl0' border='0'>";
	echo "<br>
		  	<tr>
			<th class='Th0' align='right' width='5%'><b>Identificacion: </td>
			<th class='Th0' align='left'  width='5%'><b><input type=text name=nrod_usu size=20></td>
			<th class='Th0' align='left' width='5%'><b>Contrato:</td>";
			$concont=mysql_query("SELECT codi_con,neps_con FROM contrato ORDER BY neps_con");
			echo"
			<td class='Td2' align='left'  width='5%'><b><select name='codi_con'>";
			echo"<option value=''></option>";
			while ($rowcon = mysql_fetch_array($concont))
			{
				echo"<option value='$rowcon[codi_con]'>$rowcon[neps_con]";
			}
		    echo "</select>";
			echo"</td>";
		  
 ?>
	<td class='Td2' width='15%' align='center' ><a href='#' onclick='verificar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td></tr>
	</table>
</form>
</body>
</html>