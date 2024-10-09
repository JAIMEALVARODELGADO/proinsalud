<?
session_register('Gnombre');
session_register('Gidenti');
session_register('Gtipoafi');
session_register('Gestado');
session_register('Gcodi');
session_register('Gcontra');
session_register('Gcodmed');
session_register('Gfeini');
session_register('Gffini');
session_register('Garea');
session_register('Ghora');
session_register('Gtodos');
session_register('Gar');
?> 

<HTML>

<style type="text/css"> 
<!-- 
BODY { 
color :#000000;
font-family: Verdana, Arial, Helvetica; 
font-size: 2px; 
background-color:#E6E8FA ; 
background-image: none; 
} 

A:link { TEXT-DECORATION: none; color: #386898 } 
A:visited { TEXT-DECORATION: none; color: #386898 } 
A:hover { TEXT-DECORATION: underline; color: #386898 }.texto_normal 
{ 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 2px; 
} 
.texto_mini 
{ 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 2px; 
} 
.texto_big 
{ 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 2px; 
font-weight: bold; 
} 
SELECT 
{ 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 10px; 
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




<HEAD>
<TITLE>lectura.php</TITLE>

</HEAD>
<BODY  >
<table width =100% align="center" border=1 cellpadding="0" cellpacing="1">
<th ><font size=2>Historico de Citas</font></th>
</table>
<table width =100% align="center" border=1 cellpadding="0" cellpacing="1">
<th bgcolor="#8F8FBD">
<font size=2>Hora</font></th>
<th bgcolor="#8F8FBD"><font size=2>Fecha</th>
<th bgcolor="#8F8FBD"><font size=2>Medico</th>
<th bgcolor="#8F8FBD"><font size=2>Nombre</th>
<th bgcolor="#8F8FBD"><font size=2>Servicio</th>
<th bgcolor="#8F8FBD"><font size=2>Estado</th>
<tr>
<?
echo '<FORM METHOD="POST" ACTION="asig_cita.php"><br>';

$x1=$Gcodmed; 
$x2=$Gfeini; 
$x3=$Garea; 
$x4=$Gtodos;
$x5=$Gffini;
$ced=$Gcodi;
$num="6";
$cont=0;

//Conexión a la base de datos 
$con = mysql_connect("localhost","root","") or die (mysql_error()); 
mysql_select_db("proinsalud",$con) or die (mysql_error()); 

//Sentencia sql (sin limit) 
$_pagi_sql = "SELECT nom_areas,nom_medi  ,citas.Clase_citas,horarios.Cserv_horario, horarios.Fecha_horario,horarios.Hora_horario,horarios.Cmed_horario, citas.Idusu_citas,citas.Esta_cita  
FROM horarios,citas,areas,medicos where Idusu_citas=$ced and Clase_citas<=$num and  horarios.ID_horario = citas.ID_horario and cod_areas=Cserv_horario and cod_medi =Cmed_horario order by  Fecha_horario DESC,Hora_horario"; 
$cont=0;
//cantidad de resultados por página (opcional, por defecto 20) 
$_pagi_cuantos = 25; 

//Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente 
include("paginator.inc.php"); 

//Leemos y escribimos los registros de la página actual 
while($row = mysql_fetch_array($_pagi_result)){ 
    
$valor=$row["ID_horario"];//recupera este
$nombre="mario";
$aDatos=array($valor=>$nombre); 
$h=substr($row["Hora_horario"],10);
//echo '<td>'.$row["Hora_horario"].'</td>';
echo '<td>'.$h.'</td>';


//echo '<td><font size=2>'.$row["Hora_horario"].'</font></td>'; //HORA
echo '<td><font size=2><b>'.$row["Fecha_horario"].'</b></font></td>';//FECHA
echo '<td><font size=2>'.$row["Cmed_horario"].'</font></td>';//MEDICO
echo '<td><font size=2>'.$row["nom_medi"].'</font></td>';          //CODIGO USUARIO
echo '<td><font size=2>'.$row["nom_areas"].'</font></td>';
if($row["Clase_citas"]==6)
{
	echo '<td><font size=2 color=red>Cita Eliminada</font></td>';
	
}
else
{

	echo '<td><font size=2></font></td>';

}
echo '</td></tr>';


} 

//Incluimos la barra de navegación 
echo "<table width =100% align=center border=1 cellpadding=0 cellpacing=1><font size=2><b>".$_pagi_navegacion."</table>"; 

?>
</table>
</BODY>
</HTML> 