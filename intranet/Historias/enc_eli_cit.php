<?
session_register('Ge_area2');

$Ge_area2=$area3;

?>
<html>
<head>



<title>PROGRAMA PARA EL MANEJO DE CITAS MEDICAS</title>

<title><h6>PROGRAMA PARA EL MANEJO DE CITAS MEDICAS</h6></title>


<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="java/calendar/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 



<SCRIPT LANGUAGE=JavaScript>

function Muestra(){


texto = US_Add.date23.value
US_Add.date231.value=texto

texto2=US_Add.date2.value
US_Add.date2a.value=texto2



}




function validar(form)
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
    
    if (form.date23.value == "") { a += " Fecha inicio\n"; }
    if (form.date2.value == "") { a += " Fecha final\n"; }
    if (form.idee2.value == "") { a += " Identificacion\n"; } 	
    







    if (a != "") { alert(error + a); return true;

 }

  
     form.submit()
}

</script>


</head>
<form name="US_Add" method="get" action="lis_cita_elimi.php" target="Frm2" >
<body lang=ES style='tab-interval:35.4pt' >
<center>
<table width =90%  >
<td width=50% align="right">
<b>Medico:</b>
</td>
<td width=50% align="left">

<?

$area=substr($Ge_area2,0,2);
$doc=substr($Ge_area2,2);
//Conexion con la base
mysql_connect("localhost","root","");

//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud"); 



echo '<select name="medicoe" >';


echo '<option value=1103>MEDICOS DE URGENCIAS '; 


?>

</select>

</td>
</tr>



<tr>
<td width=50% align="right" ><b>Fecha Inicio:</b></td>
<!-- formulario con el campo de texto y el botón para lanzar el calendario--> 
 
<td><input type="hidden" name="date23" id="date23" onChange="Muestra();" />

<?
echo "<input type=hidden name=areae value=$area>";
echo "<input type=hidden name=idee2  value=$doc >";
?>

<input type="text" SIZE="10" name="date231" id="date231" disabled>
<input type="button" id="lanzador1" value=">" /> *
</td>


<!-- script que define y configura el calendario--> 
<script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "date23",     // id del campo de texto 
     ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
</script> 

</tr>
<tr>
<td width=50% align="right"><b>Fecha Final:</b></td>  

<!-- formulario con el campo de texto y el botón para lanzar el calendario--> 

<td><input type="hidden" name="date2" id="campo_fecha" onChange="Muestra();" /> 
<input type="text" SIZE="10" name="date2a" id="date2a" disabled>
<input type="button" id="lanzador" value=">" /> *
</td>


<!-- script que define y configura el calendario--> 
<script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
</tr>
</table>
</center>
<br>


<td width="50%" align="right"><input type="button" value="ejecutar" onClick="validar(this.form)"></td>
<td width="50%"><input type=reset name="" value="Limpiar"></td>

</tr>
</table>
</center>
</form>



</form>





<?
//$x="JAMICHU";

//echo "<td bgcolor=$Color </td><input type=hidden text name=rut1 value='".$x."'></td>";


echo "<td bgcolor=$Color </td><input type=hidden text name=rut1 value='00'></td>";
echo $x;
echo $xy; 
?>


</body>

</html>
