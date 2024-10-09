<?
session_register('Gcodmed1');
session_register('Gfeini1');
session_register('Gffini1');
session_register('Garea1');
session_register('Garea2');

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
font-size: 12px; 
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
<TITLE>Actualizar1.php</TITLE>
<script languaje="javascript">
function ConfirmarEnvio(form)
{
enviar = window.confirm('Se eliminaran los Horarios Seleccionados desea Continuar?');
(enviar)?form.submit():'return false';
}
</script>
</HEAD>



<BODY >


<?
function fechamsq($fecha,$ndias)
           
 
{

   
 
      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
            
 
              list($dia,$mes,$año)=split("/", $fecha);
            
 
      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
            
 
              list($dia,$mes,$año)=split("-",$fecha);
        $nueva = mktime(0,0,0, $mes,$dia,$año) + $ndias * 24 * 60 * 60;
      
         $nuevafecha=date("Y-m-d",$nueva);    
 
      return ($nuevafecha);  
            
}

?>


<?

//Conexion con la base
$con=mysql_connect("localhost","root","")or die (mysql_error()); 

//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud",$con) or die (mysql_error()); 

////ejecutamos la consulta para encontrar los registros segun el parametro


echo '<FORM METHOD="POST" ACTION="gene_elim.php"><br>';

//Creamos la sentencia SQL y la ejecutamos
/*
$Gcodmed1=$medicoe; 
$Gfeini1=$date23; 
$Garea1=$Garea2; 
$Gffini1=$date2;
*/

$finisql= fechamsq($Gfeini1,$cont);
$ffinsql= fechamsq($Gffini1,$cont);



$_pagi_sql="Select Cmed_horario,Cserv_horario ,Fecha_horario ,Hora_horario ,Usado_horario,dia_horario,ID_horario From horarios where Usado_horario=ncita_horario and Cmed_horario=$Gcodmed1 and Cserv_horario=$Garea2 and ((Fecha_horario>='$finisql')and (Fecha_horario<='$ffinsql')) order by Fecha_horario,Hora_horario";

$_pagi_cuantos = 9; 
include("paginator.inc.php");

//$result=mysql_query($sSQL);
//$medic=$medicoe;
//$arec=$areae;
$fini=$finisql;
$ffi=$ffinsql;
?>


<?


echo "<input type=hidden text name=rut1a value='$Gcodmed1'>";
echo "<input type=hidden text name=rut2a value='$Garea2'>";
echo "<input type=hidden text name=rut3a value='$fini'>";
echo "<input type=hidden text name=rut4a value='$ffi'>";
?>

<table width =100% align="center" border=1 cellpadding="0" cellpacing="1">
<td align="center"><b>Horarios</b></td>
</table>
<p>
<table width =100% align="center" border=1 cellpadding="0" cellpacing="1">
<th bgcolor="#8F8FBD">Elegir<th bgcolor="#8F8FBD">Hora</th><th bgcolor="#8F8FBD">Fecha</th><th bgcolor="#8F8FBD">Medico</th><th bgcolor="#8F8FBD">Dia</th><th bgcolor="#8F8FBD">Nº de Citas</th><th bgcolor="#8F8FBD">Area:</th>



<?

$marca="false";
$cont=0;
//seleccion[]
//Mostramos los registros
while($row = mysql_fetch_array($_pagi_result))
{

$valor=$row["ID_horario"];//recupera este
$nombre="mario";

$aDatos=array($valor=>$nombre); 
 
foreach($aDatos as $id=>$nombre) { 
 echo "<tr><td align=center><input type='checkbox' name='seleccion[]'  value='$id'  /> <br /></td>"; 
 } 

$hor=$row["Hora_horario"];
$ho=substr($hor,11);
echo '<td> <font size=2>'.$ho.'</font></td>';
echo '<td><font size=2>'.$row["Fecha_horario"].'</font></td>';
echo '<td><font size=2>'.$row["Cmed_horario"].'</font></td>';
echo '<td><font size=2>'.$row["dia_horario"].'</font></td>';
echo '<td><font size=2>'.$row["Usado_horario"].'</font></td>';
echo '<td><font size=2>'.$row["Cserv_horario"].'</font></td></tr>';

}

$x=0;
while($x<=$cont)
{
echo "<br>$matriz[$x] </br>";
$x=$x+1;
}

echo "<br>$elegi[1] </br>";


//mysql_free_result($result)

echo "</table>";

echo "<table width =100% align=center border=1 cellpadding=0 cellpacing=1><font size=2><b>".$_pagi_navegacion."</table>"; 
?>

<table width =80% align="center" border=1 cellpadding="0" cellpacing="1">
<tr>
<td>
<input type=checkbox name=todo  value="*" > <b>Eliminar Todos</b> 
</td>
</tr>
</table>

<br>
<br>
<input type="button" value="Eliminar" onClick="ConfirmarEnvio(this.form)">


</FORM>
</BODY>
</HTML> 