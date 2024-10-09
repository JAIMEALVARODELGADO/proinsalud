<?
session_register('Gfeini');
session_register('Gffini');
session_register('Gar');
session_register('Gmun');
session_register('Gcodmed');
?>

<html>
<head>
<SCRIPT LANGUAGE=JavaScript>
function fullwin(){
window.open("cd_frabuscar.html","Frm2")
}

function Muestra(){


texto = US_Add.date23.value
US_Add.date231.value=texto

texto2=US_Add.date2.value
US_Add.date2a.value=texto2



}
</SCRIPT>

<title>PROGRAMA PARA EL MANEJO DE CITAS MEDICAS</title>

<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="java/calendar/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<SCRIPT LANGUAGE=JavaScript>
function validar()
{

var texto = US_Add.areae.value



window.open("lis_serme.php?areae="+texto,"Frmh2a")  
form.submit()
}

</script>

<SCRIPT LANGUAGE=JavaScript>
function validar2()
{

var texto = US_Add.areae.value
var texto1 = US_Add.medicoe.value

window.open('res_seme.php?areae='+texto+texto1 ,"Frmh2a")  
form.submit()
}

</script>




</head>
<p>
<form name="US_Add" method="POST"  target="Frmh2a" >
<body lang=ES style='tab-interval:35.4pt' bgcolor="#E6E8FA">
<center>
<table width =100% align="center" border=1 cellpadding="0" cellpacing="1">
<th ><font size=2>Asignar Medico a una Area</font></th>
</table>
<br>
<table width =100% border="1">

<tr>

<td width=1% align="right"><b><font size=2>Area:</font> </b></td>
<td width=25%>
<?

//Conexion con la base
mysql_connect("localhost","root","");
//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud"); 
//Creamos la sentencia SQL y la ejecutamos
$sSQL="Select cod_areas,nom_areas From areas Order By nom_areas";
$result=mysql_query($sSQL);
echo '<select name="areae" align="left" onChange="Muestra();">';
//Generamos el menu desplegable
while ($row=mysql_fetch_array($result))
{

echo '<option value='.$row["cod_areas"].'>'.$row["nom_areas"]; 
}





?>



</select>
</td>
<td width=1% align="right">
<b><font size=2>Medico:</font></b>
</td>
<td width=25% align="left">
<?

//Creamos la sentencia SQL y la ejecutamos
$sSQL="Select nom_medi,ape_medi,cod_medi From medicos Order By nom_medi";
$result=mysql_query($sSQL);
echo '<select name="medicoe"  >';
//Generamos el menu desplegable
while ($row=mysql_fetch_array($result))

{
echo '<option value='.$row["cod_medi"].'>'.$row["nom_medi"] .$row["ape_medi"]; 
}





 
?>

</select>
</td>

</table>
</center>
<p>
<p>
<p>
<p>
<td width="5%" align="right"><input type="button" value="Grabar" onClick="validar2()"></td>
<td width="5%"><input type="button"  value="consultar area" onClick="validar()"></td>
</tr>
</table>
</center>



</form>
</body>

</html>
