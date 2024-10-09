<html>
<head>
<title>LABORATORIO CLINICO</title>

<link rel="stylesheet" href="css/style.css" type="text/css" /> 
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>

<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 
<!-- librer�a principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<!-- librer�a para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<script type="text/javascript">
	$().ready(function() {
		$("#ccomer").autocomplete("bcup.php", {
		minChars: 3,
                max: 150,
                autoFill: false,
                mustMatch: false,
                matchContains: false,
                scroll: true,
                scrollHeight: 220

		});	
		$("#ccomer").result(function(event, data, formatted) {
		$("#cod_cir").val(data['1']);
		});
	});
</script>
<SCRIPT LANGUAGE=JavaScript>
function verificar()
{
	
	//alert('toy');
	var error='';
	if(form1.fecini_.value==''){
    error=error+"Fecha inicial\n";}
	if(form1.fecfin_.value==''){
    error=error+"Fecha Final\n";}
        if(form1.desc_.value==''){
    error=error+"Examen o Procedimiento\n";}
	if(error!=''){
    alert("Para continuar debe digitar la siguiente informacion\n"+error);}
	else
	{
		form1.submit();
		
	}
}
</script>
</head>
<form name="form1" method="POST" action="inf_labt.php" target='fr02'>
<body >
    
<br><br>
 <table width="90%" align='center'>
   <tr><td class="Th0" align='center'><STRONG>BUSQUEDA - INFORME EXAMENES</strong></td></tr>
 </table>
 <center>
 <?
	include('php/conexion.php');
	echo "<table  border='0' width='60%'>";
	echo "<br>";	  
        echo"<tr>
        <tr><td  align='right'><b>FECHA INICIAL: </td>
        <td align='left'><b><input type=text name=fecini_  id=fenti size='11' />";?>
        <input type="button" id="lanzador1" value="..." />
        <dd><dd><script type="text/javascript"> 
                  Calendar.setup({ 
                  inputField     :    "fenti",     // id del campo de texto 
                  ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
                  button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
                  }); 
         </script> 
        <?  
        echo"</td>";
        echo"
        <td align='left'><b>FECHA FINAL: </td>
        <td align='left' width='20%'><b><input type=text name=fecfin_  id=fentf size='11' />";?>
        <input type="button" id="lanzador2" value="..." />
        <dd><dd><script type="text/javascript"> 
                  Calendar.setup({ 
                  inputField     :    "fentf",     // id del campo de texto 
                  ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
                  button     :    "lanzador2"     // el id del bot�n que lanzar� el calendario 
                  }); 
         </script> 
        <?
        echo"</td>";
        echo"<td class=Th0 align=rigth><input id=cod_cir type=hidden name='cod_' size=4 maxlength=4></td>";
        echo"<td class=Th0 align='rigth'><b>EXAMEN<b><textarea id=ccomer name='desc_' rows=2 cols=50>$desc_</textarea></td></tr>";  
            
        	  
 ?>
<tr><td class='Td2'  colspan='6' align='center' ><a href='#' onclick='verificar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td></tr>
	</table>
</form>
</body>
</html>