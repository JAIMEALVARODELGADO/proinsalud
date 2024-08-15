<?
session_register('Gfeini');
session_register('Gffini');
session_register('Gar');
session_register('Gmun');
session_register('Gcodmed');
session_register('Garea');


$Garea="03"; 
?>

<html>
<style type="text/css"> 
<!-- 
BODY { 
color :#000000;
font-family: Verdana, Arial, Helvetica; 
font-size: 12px; 
background-color:#E6E8FA ; 
background-image: none; 
} 

A:link { TEXT-DECORATION: none; color: #386898 } 
A:visited { TEXT-DECORATION: none; color: #386898 } 
A:hover { TEXT-DECORATION: underline; color: #386898 }.texto_normal 
{ 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 12px; 
} 
.texto_mini 
{ 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 12px; 
} 
.texto_big 
{ 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 12px; 
font-weight: bold; 
} 
SELECT 
{ 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 9px; 
background-color: #F5F5F5; 
color: #000000; 
} 
TEXTAREA, .tabla_input 
{ 
font-family: Verdana,Arial,Helvetica, sans-serif; 
background-color: #F5F5F5; 
color: #000000; 
font-size: 12px; 
} 
.tabla_titulo 
{ 
color: #FFFFFF; 
background-color: #386898; 
background-image: none; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 1px; 
font-weight: bold; 
} 
.texto_titulo 
{ 
color: #FFFFFF; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 5px; 
font-weight: bold; 
TEXT-DECORATION: none; 
} 
A.texto_titulo:link, A.texto_titulo:visited 
{ 
color: #FFFFFF; 
TEXT-DECORATION: none; 
} 
A.texto_titulo:hover 
{ 
color: #FFFFFF; 
TEXT-DECORATION: underline; 
} 
.tabla_texto_1, .tabla_sombra_1 
{ 
color: #000000; 
background-color: #FFFFFF; 
background-image: none; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 11px; 
TEXT-DECORATION: none; 
} 
.texto_1, .sombra_1 
{ 
color: #000000; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 11px; 
TEXT-DECORATION: none; 
} 
A.texto_1:link, A.texto_1:visited, A.sombra_1:link, A.sombra_1:visited 
{ 
color: #A0E8FF; 
TEXT-DECORATION: none; 
} 
A.texto_1:hover, A.sombra_1:hover 
{ 
color: #A0E8FF; 
TEXT-DECORATION: underline; 
} 
.tabla_texto_2, .tabla_sombra_2 
{ 
color: #000000; 
background-color: #DDDDDD; 
background-image: none; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 11px; 
TEXT-DECORATION: none; 
} 
.texto_2, .sombra_2 
{ 
color: #000000; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 11px; 
TEXT-DECORATION: none; 
} 
A.texto_2:link, A.texto_2:visited, A.sombra_2:link, A.sombra_2:visited 
{ 
color: #306890; 
TEXT-DECORATION: none; 
} 
A.texto_2:hover, A.sombra_2:hover 
{ 
color: #306890; 
TEXT-DECORATION: underline; 
} 
.tabla_categorias 
{ 
color: #FFFFFF; 
background-color: #3F3F3F; 
background-image: none; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 12px; 
font-weight: bold; 
TEXT-DECORATION: none; 
} 
.texto_categorias 
{ 
color: #FFFFFF; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 12px; 
font-weight: bold; 
TEXT-DECORATION: none; 
} 
A.texto_categorias:link, A.texto_categorias:visited 
{ 
color: #FFFFFF; 
TEXT-DECORATION: none; 
} 
A.texto_categorias:hover 
{ 
color: #FFFFFF; 
TEXT-DECORATION: underline; 
} 
.tabla_boton 
{ 
background-color: #F5F5F5; 
color: #000000; 
border-bottom: e1e1e1 1px outset; 
border-left: ffffff 1px outset; 
border-right: e1e1e1 1px outset; 
border-top: ffffff 1px outset; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 10px; 
height: 20px; 
font-weight: bold; 
} 
--> 
</style>
<head>


<title>PROGRAMA PARA EL MANEJO DE CITAS MEDICAS</title>

<SCRIPT LANGUAGE=JavaScript>
function validar(form)
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
    
    if (form.date23a.value == "") { a += " Fecha Cita\n"; }
  
if (form.date2a.value == "") { a += " Hora Cita\n"; }
   

    if (a != "") { alert(error + a); return true;

 }

  
     form.submit()
}

</script>

</head>
<form name="US_Add" method="POST" action="frm_resul.php" target="Frmh4">
<body   scroll = "no">
<table width =100% border="1">
<?
//Conexion con la base
mysql_connect("localhost","root","");
//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud"); 
//Creamos la sentencia SQL y la ejecutamos

echo "<input type=hidden SIZE=28 name=areae value=$Garehci />";
?>
</select>

<td width=1% align="left">
<b><font size=1>Medico:</font></b>
</td>
<td width=25% align="left">
<?


echo '<select name="medicoe">';
//Generamos el menu desplegable
echo '<option value=1103>MEDICOS DE URGENCIA'; 

$nu=date("Y-m-d"); 
$ho=strftime("%H:%M:%S");
 
?>


</select>
</td>
</table>
<table border=1>


<?
echo "<td width=10% align=left ><b><font size=0>Fecha Cita:</font></b>";
echo "<input type=text SIZE=8 name=date23a value=$nu id=date23a  disabled/>";
echo "<input type=hidden SIZE=8 name=date23 value=$nu id=date23  />";

echo "<td width=10% align=left><b><font size=0>Hora Cita:</font></b>";
echo "<input type=text SIZE=8 name=date2 value=$ho id=date2 disabled />";
echo "<input type=hidden SIZE=8 name=date2a value=$ho id=date2a />";

echo "<input type=hidden SIZE=8 name=are value=$Garea id=are  />";





?>


</tr>
</table>
</center>

<table border=1 width="20%" >


<td width="3%" align="left"><input type="button" value="Guardar" onClick="validar(this.form)"></td>
<td width="3%" align="right"><input type=reset name="" value="Limpiar"></td>





</tr>
</table>
</center>



</form>
</body>

</html>
