
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
session_register('Gmun');

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
<br>
<br>
<CENTER><h3>USUARIO AGREGADO AL LISTADO DE ESPERA DE URGENCIAS</H3> </CENTER>

<br>
<table width =100% align="center" border=1 cellpadding="0" cellpacing="1">
<th bgcolor="#8F8FBD">Usuario</th><th bgcolor="#8F8FBD">Hora</th><th bgcolor="#8F8FBD">Fecha</th><th bgcolor="#8F8FBD">Estado</th>


<?


function DiaSemana  ($fecha,$texto=1) 
  

{ 
    list($año,$mes,$dia) = explode("-",$fecha);
    $numerodiasemana = date('w', mktime(0,0,0,$mes,$dia,$ano));
     
      if ($texto == 0)
        return $numerodiasemana;
      
      switch($numerodiasemana)
      {
      case 0: return "Domingo";
        case 1: return "Lunes";
         case 2: return "Martes";
         case 3: return "Miércoles";
         case 4: return "Jueves";
         case 5: return "Viernes";
         case 6: return "Sábado";
      }
 } 


?>


<?


echo '<FORM METHOD="POST" ACTION="asig_cita.php"><br>';


$x1a=$Gcodmed; 
$x2a=$Gfeini;
$x3a=$Garea; 

$x5a=$Gfeini."-".$Gffini;



$diax=diasemana($x2a);


//Conexion con la base
$con=mysql_connect("localhost","root","")or die (mysql_error()); 

//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud",$con) or die (mysql_error()); 

?>



<?

$cedg=$Gcodi;
$controg=$Gcontra;
$tipotg=$Gtipoafi;

$dateh=date("Y")."-".date("m")."-".date("d");
$hor=date("h").":".date("i").":".date("s");
$esta="1";


mysql_query("INSERT INTO horarios ( Cmed_horario, Cserv_horario, Fecha_horario, Hora_horario, Usado_horario,ncita_horario,dia_horario)values ('$x1a','$x3a','$x2a','$x5a','0','1','$diax')");

$consulta2=mysql_query("SELECT MAX(id_horario) FROM horarios WHERE Cserv_horario='$x3a' and Cmed_horario='$x1a'");
  $row2=mysql_fetch_array($consulta2);
  $codigo_h=$row2['MAX(id_horario)'];
echo "<input type=text name=texto1 value=$codigo_h>";
mysql_query("insert into citas (ID_horario,Idusu_citas,Tusua_citas,Cotra_citas,Clase_citas,Fsolusu_citas,Esta_cita,Hora_cita ) values ('$codigo_h','$cedg','$tipotg','$controg','1','$dateh','$esta', '$hor')");

$lis=("select Esta_cita,Fecha_horario, Hora_horario , PNOM_USU,SNOM_USU,PAPE_USU,SAPE_USU from citas,horarios,usuario where citas.id_horario=horarios.id_horario and Idusu_citas= CODI_USU and Cserv_horario ='$x3a'and  Esta_cita= '1'order by  Hora_horario");

$lista=mysql_query($lis);

while ($rowq=mysql_fetch_array($lista)){

$nom=$rowq["PNOM_USU"];
$nom2=$rowq["SNOM_USU"];
$nom3=$rowq["PAPE_USU"];
$nom4=$rowq["SAPE_USU"];
$esta=$rowq["Esta_cita"];
$fex=$rowq["Fecha_horario"];
$hox=substr($rowq["Hora_horario"],10);

$nombre=$nom." ".$nom2." ".$nom3." ".$nom4;
echo "<tr>";
echo "<td>$nombre</td>";
echo "<td>$fex</td>";
echo "<td>$hox</td>";
echo "<td>$esta</td>";

echo "</tr>";

}

?>

</table>

<br>
<p>



</div>
</BODY>
</HTML> 