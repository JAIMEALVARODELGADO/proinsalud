<html>
<head><title>Buscar Usuario</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head><title>Generacin de Rips</title>
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 

<!-- librera principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librera para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librera que declara la funcin Calendar.setup, que ayuda a generar un calendario en unas pocas lneas de cdigo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<link rel="stylesheet" href="css/style.css" type="text/css" />
<style>

#divMenu {font-family:arial,helvetica; font-size:12pt; font-weight:bold}
#divMenu a{text-decoration:none;}
#divMenu a:hover{color:red;}
</style>

<script language="javascript">
function validar()
{
  
  var error='';
  if(form1.finicial.value==''){
    error=error+"Fecha inicial\n";}
  if(form1.ffinal.value==''){
    error=error+"Fecha Final\n";}
  if(error!=''){
    alert("Para continuar debe digitar la siguiente informacin\n"+error);}
  else{
    form1.action='inf_labprog.php'
	//form1.target='area';
	form1.submit();}
}

</script>
</head>
<body bgcolor="#E6E8FA">
<!--<link rel="stylesheet" href="css/style.css" type="text/css">-->
<form name='form1' method="POST" target="Fr04">

<table class='Tbl0' border='0'>
    <tr><td class='Td1' align='center'><STRONG>PROCEDIMIENTOS DE LABORATORIO X PROGRAMA</strong></td></tr>
</table>
<!--<Table width="40%" border="1" align="center" cellpadding=0 Cellspacing=1 BorderColor="#fffff" BgColor="D0D0F0">-->
<br>
<table border='0' width="50%" align='center'>
<tr>
    <td  width="20%" align='right'><b>Fecha Inicial:</b></td>
	<td  width="20%" align='left'>
	<!-- formulario con el campo de texto y el botn para lanzar el calendario--> 
    <? echo "<input type=text name=finicial value='".$finicial."' id=finicial size='10' maxlength='10' />*";?>
    <input type="button" id="lanzador1" value="..." />
    <!-- script que define y configura el calendario--> 
    <script type="text/javascript"> 
     Calendar.setup({ 
       inputField     :    "finicial",     // id del campo de texto 
       ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
       button     :    "lanzador1"     // el id del botn que lanzar el calendario 
     }); 
    </script> 
	</td>
	<td width="20%" align='right'><b>Fecha Final:</b></td>
	<td  width="20%" align='left'>
	<!-- formulario con el campo de texto y el botn para lanzar el calendario--> 
    <? echo "<input type=text name=ffinal value='".$ffinal."' id=ffinal size='10' maxlength='10' />*";?>
    <input type="button" id="lanzador2" value="..." />
    <!-- script que define y configura el calendario--> 
    <script type="text/javascript"> 
     Calendar.setup({ 
       inputField     :    "ffinal",     // id del campo de texto 
       ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
       button     :    "lanzador2"     // el id del botn que lanzar el calendario 
     }); 
    </script>
	</td>
	<?
		echo"<td class='Td2' width='5%' align='left'><strong>Programa</td><td  width=140 align=center>";
		echo"<select name='prog_lab'>";
		echo "<option value=''> </option>";
		echo "<option value='4'>Adulto Mayor</option>";
		echo "<option value='5'>HTA-DIAB-HIPER</option>";
		echo "<option value='6'>Obesidad</option>";
		echo  "</select></td>";
				
	?><script language=javascript>form1.prog_lab.value="<?echo $prog_lab?>";</script>
	
    <td align="left"><input type="button" name="btn1" value="Buscar" onclick="validar(this.form)"></td>
</tr>
</table>
</form>
</body>
</html>