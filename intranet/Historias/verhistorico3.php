<?
session_register('Garehci');
session_register('Gideusu');
//echo "identificacion".$cedula;
?>
<html>
<style type="text/css"> 
<!-- 
SELECT 
{ 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 9px; 
background-color: #F5F5F5; 
color: #000000; 
} 
--> 
</style>

<head>
<SCRIPT LANGUAGE=JavaScript>

function Muestra()
{

	US_Add.submit();
}
</SCRIPT>

<!--Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="java/calendar/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<title><h6>PROGRAMA PARA EL MANEJO DE CITAS MEDICAS</h6></title>
</head>
<body  scroll = "no">
<BR>
<a href="verhistorico1.php" target='fr2'><font color="#FF6600"><b>Inicio</font></a>
<BR>
<BR>

<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="223" >
	<td bordercolor="#FFFFFF"><b>
    <font face="Arial" size="2">Historico de Conducta</font></b></td>
	
</table>
<br>
<form name="US_Add" method="post" action="verhistorico4.php" target="Frmh2a" >

<table width =20% border= "0" align="left" border=1>

<tr>
<td width=5% align="left" bgcolor="#FF9900">
<b><font size=1>Area:</font></b>
</td>
<td width=7% align="left">

<?
include('../Libreria/Php/funciones.php');
//include('../Libreria/Php/conexion.php');
//base_proinsalud();
//echo"are:$Garmov";
//Creamos la sentencia SQL y la ejecutamos
//$sSQL="SELECT areas.nom_areas, area_online.care_line FROM area_online INNER JOIN areas ON area_online.care_line = areas.cod_areas;  ";
//$result=mysql_query($sSQL);

echo "
<input type=hidden name=cedula value='$cedula'>
<select name=areac onChange='Muestra();' >";

//Generamos el menu desplegable
echo '<option >--------'; 
echo '<option value=01>HISTORIA CLINICA'; 
echo '<option value=02>EVOLUCIONES'; 
/*while ($row=mysql_fetch_array($result))
{

echo '<option value='.$row["care_line"].'>'.$row["nom_areas"];

}*/
?>

</select>
</td>
<tr>
<td>
</td>

</tr>
</table>

</form>
 
</body>
</html>
