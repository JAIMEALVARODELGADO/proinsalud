<html>
<head>
<title>PROGRAMA DE FACTURACIÓN - FURTRAN</title>
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
function envio(apli){
    form1.action="fac_5muestrafurtran.php";
    form1.target='fr02';
    form1.submit();
}

function nuevo(){
    form1.action='fac_5creafurtran.php';
    form1.target='fr02';
    form1.submit();
}
</script>
</head>

<form name="form1" method="POST">
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0"><tr><td class="Td0" align='center'>FURTRAN</td></tr></table><br>
<?include('php/conexion.php');?>
<center><table class="Tbl1" border="0">
<tr>
    <td class="Td2" align='right' width='10%'><b>Numero de Reclamacion:</td>
    <td class="Td2" align='left' width='15%'><input type='text' name='numero_rec' size='7' maxlength='7'></td>
    <td class="Td2" align='right' width='10%'><b>Fecha:</td>
    <td class="Td2" align='left' width='15%'><input type='text' name='fecha_rec' size='10' maxlength='10'></td>
</tr>
<tr>
    <td class="Td2" align='center' colspan='3'><a href='#' onclick="envio()" ><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20>Buscar</a></td>
    <td class="Td2" align='center' colspan='3'><a href='#' onclick="nuevo()" ><img src='icons/feed_add.png' border='0' alt='Nuevo Recobro' width=20 height=20>Crear Nuevo Recobro</a></td>
</tr>
</table></center>
</form>
</body>
</html>
