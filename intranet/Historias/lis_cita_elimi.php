<?
session_register('Gcocita');

?>
<HTML>
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
<TITLE>Actualizar1.php</TITLE>

<script languaje="javascript">
function ConfirmarEnvio(form)
{
enviar = window.confirm('Se eliminaran las Citas Seleccionados desea Continuar?');
(enviar)?form.submit():'return false';
}
</script>

</HEAD>
<BODY bgcolor="#E6E8FA">


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
mysql_connect("localhost","root","");

//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud"); 


////ejecutamos la consulta para encontrar los registros segun el parametro


echo '<FORM METHOD="POST" ACTION="gene_elim_cit.php"><br>';

//Creamos la sentencia SQL y la ejecutamos


///$finisql= fechamsq($date23,$cont);
///$ffinsql= fechamsq($date2,$cont);


$fec=fechamsq($date23,$cont);
$fec2=fechamsq($date2,$cont);
$cer="0";
$men="5";

$sSQL="SELECT citas.Clase_citas,id_cita,horarios.ID_horario,NROD_USU,horarios.Cserv_horario, horarios.Fecha_horario,horarios.Hora_horario,horarios.Cmed_horario, citas.Idusu_citas,citas.Esta_cita  
FROM citas, horarios,usuario where CODI_USU=Idusu_citas and citas.ID_horario=horarios.ID_horario and  NROD_USU=$idee2 and Cmed_horario=  $medicoe and Cserv_horario=$areae and Fecha_horario>='$fec' and Fecha_horario<='$fec2' and Usado_horario=$cer  and Clase_citas<=$men  order by horarios.Fecha_horario, horarios.Hora_horario";


$result=mysql_query($sSQL);



?>


<?
$variable = "hola";
?>

<table width =100% align="center" border=1 cellpadding="0" cellpacing="1">
<td align="center"><font size=2><b>Listado de Citas</b></td>
</table>
<p>
<table width =100% align="center" border=1 cellpadding="0" cellpacing="1">
<th bgcolor="#8F8FBD">Elegir<th bgcolor="#8F8FBD">Hora</th><th bgcolor="#8F8FBD">Fecha</th><th bgcolor="#8F8FBD">Medico</th><th bgcolor="#8F8FBD">Cedula</th><th bgcolor="#8F8FBD">Tipo de Eliminacion</th>



<?
$marca="false";
$cont=0;
//seleccion[]
//Mostramos los registros
while ($row=mysql_fetch_array($result))
{

$valor=$row["ID_horario"];//recupera este
$nombre="mario";

$aDatos=array($valor=>$nombre); 
 
foreach($aDatos as $id=>$nombre) { 
 echo "<tr><td align=center><input type='radio' name='seleccion2[]' value='$id'> <br /></td>"; 
 } 

$hor=$row["Hora_horario"];
$ho=substr($hor,11);

echo '<td> <font size=2>'.$ho.'</font></td>';
echo '<td><font size=2>'.$row["Fecha_horario"].'</font></td>';
echo '<td><font size=2>'.$row["Cmed_horario"].'</font></td>';

$Gcocita= $row["id_cita"];

echo '<td><font size=2>'.$row["NROD_USU"].'</font></td>';

$sSQL2="Select cod_ticita ,des_ticita  From tip_cita WHERE  cod_ticita>=6 Order By cod_ticita";
$result1=mysql_query($sSQL2);

echo '<td align=center><select name="tipoci">';

//Generamos el menu desplegable
while ($row1=mysql_fetch_array($result1))
{

echo '<option value='.$row1["cod_ticita"].'>'.$row1["des_ticita"]; 


}

echo '</td></tr>';


}


mysql_free_result($result)


?>
</table>
<P>

<BR>
<table width =80% align="center" border=0 cellpadding="0" cellpacing="1">
<tr><td><b>Notas de la eliminacion:</b></td></tr>
<tr>
<td><TEXTAREA COLS=50 ROWS=5 NAME="CODIGO"></TEXTAREA><td>
</tr>
</table>


<br>
<br>
<input type=button value="Eliminar" onClick="ConfirmarEnvio(this.form)">



</BODY>
</HTML> 