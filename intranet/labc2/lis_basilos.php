<html>
<head>
<title>LABORATORIO CLINICO</title>
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
function verificar()
{
	
	//alert('toy');
	var error='';
	if(form1.fecini_.value==''){
    error=error+"Fecha inicial\n";}
	if(form1.fecfin_.value==''){
    error=error+"Fecha Final\n";}
	if(error!=''){
    alert("Para continuar debe digitar la siguiente informacion\n"+error);}
	else
	{
		form1.submit();
		
	}
}
</script>
</head>
<form name="form1" method="POST" action="inf_basilos.php" target='fr02'>
<body >
    
<br><br>
 <table width="90%" align='center'>
   <tr><td class="Th0" align='center'><STRONG>BUSQUEDA - INFORME BASILOSCOPIAS</strong></td></tr>
 </table>
 <center>
 <?
	include('php/conexion.php');
	echo "<table class='Tbl0' border='0'>";
	echo "<br>";	  
        echo"<tr>
        <tr><td class='Td2' align='right' width='12%'><b>FECHA INICIAL: </td>
        <td class='Td2' align='left'  width='20%'><b><input type=text name=fecini_  id=fenti size='11' />";?>
        <input type="button" id="lanzador1" value="..." />
        <dd><dd><script type="text/javascript"> 
                  Calendar.setup({ 
                  inputField     :    "fenti",     // id del campo de texto 
                  ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
                  button     :    "lanzador1"     // el id del bot?n que lanzar? el calendario 
                  }); 
         </script> 
        <?  
        echo"</td>";
        echo"
        <td class='Td2' align='left' width='12%'><b>FECHA FINAL: </td>
        <td class='Td2' align='left'  width='15%'><b><input type=text name=fecfin_  id=fentf size='11' />";?>
        <input type="button" id="lanzador2" value="..." />
        <dd><dd><script type="text/javascript"> 
                  Calendar.setup({ 
                  inputField     :    "fentf",     // id del campo de texto 
                  ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
                  button     :    "lanzador2"     // el id del bot?n que lanzar? el calendario 
                  }); 
         </script> 
        <?
        echo"</td></tr>";
		  
 ?>
<tr><td class='Td2'  colspan='4' align='center' ><a href='#' onclick='verificar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td></tr>
	</table>
</form>
</body>
</html>