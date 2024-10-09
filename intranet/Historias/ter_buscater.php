<html>
<head>
<title>Terapias</title>
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
	var error='';
	//form1.submit();
	if(document.form1.nrod_usu.value==''){
		error=error+'Numero de Identificacion\n';		
	}
	if(document.form1.tipo_ter.value==''){
		error=error+'Terapia\n';		
	}
	if(error!=''){
		alert("Debe digitar la siguiente informacion:\n"+error);
	}
	else{
		switch (document.form1.tipo_ter.value) {
			case '01':
				document.form1.action='ter_muestratfis.php';		
				document.form1.submit();
				break;
			case '02':
				document.form1.action='ter_muestratres.php';		
				document.form1.submit();
				break;
			default:
				// statements_def
				break;
		}
	}
}
</script>
</head>
<form name="form1" method="POST" action="" target='fr04'>
<body>
 <table class="Tbl0">
   <tr><td class='Td1' align='center'>Historial de Terapias</td></tr>
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
			<th class='Th0' align='left' width='5%'><b>Terapia:</td>
			<td class='Th0' align='left'  width='5%'><b><select name='tipo_ter'>
			<option value=''></option>
				<option value='01'>Fisica
				<option value='02'>Respiratoria
		    </select>
			</td>";
		  
 ?>
	<td class='Td2' width='15%' align='center' ><a href='#' onclick='verificar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td></tr>
	</table>
</form>
</body>
</html>