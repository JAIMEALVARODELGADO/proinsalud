
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

.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 11px;  }
--> 
</style>


<HEAD>

<TITLE>Consultas Generales</TITLE>

</HEAD>
<BODY >
<CENTER><h5>LISTADO DE CITAS POR USUARIO</H5> </CENTER>
<?

//Conexion con la base
$con=mysql_connect("localhost","root","")or die (mysql_error()); 

//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud",$con) or die (mysql_error()); 



?>


<table width =100% align="center" border=1 cellpadding="0" cellpacing="1">
<th bgcolor="#BED1DB" class=Estilo7 width='10%'>IDENTIFICACION</th>
<th bgcolor="#BED1DB" class=Estilo7 width='30%'>USUARIO</th>
<th bgcolor="#BED1DB" class=Estilo7 width='20%'>CONTRATO</th>
<th bgcolor="#BED1DB" class=Estilo7 width='10%'>FECHA</th>
<th bgcolor="#BED1DB" class=Estilo7 width='10%'>HORA</th>
<th bgcolor="#BED1DB" class=Estilo7 width='20%'>MEDICO</th>


<?


echo '<FORM METHOD="POST" ACTION="asig_cita.php"><br>';


$x1a=$Gcodmed; 
$x2a=$Gfeini;
$x3a=$Garea; 

$x5a=$Gfeini."-".$Gffini;



?>



<?

$cedg=$Gcodi;
$controg=$Gcontra;
$tipotg=$Gtipoafi;

$dateh=date("Y")."-".date("m")."-".date("d");
$hor=date("h").":".date("i").":".date("s");
$esta="1";

$condicion=" ";
if(!empty($t0)){
	  $condicion=$condicion."medicos.cod_medi='$t0' AND ";}
if(!empty($t1)){
	  $condicion=$condicion."usuario.NROD_USU='$t1' AND ";}
if(!empty($t2)){
	  $condicion=$condicion."horarios.Fecha_horario>='$t2' AND ";}
if(!empty($t3)){
	  $condicion=$condicion."horarios.Fecha_horario<='$t3' AND ";}	
	  
 if(!empty($condicion)){
	  $condicion=substr($condicion,0,(strlen($condicion)-5));}
 if(!empty($condicion)){
	  $lis="select Clase_citas,NROD_USU, Esta_cita,Fecha_horario, Hora_horario , PNOM_USU,SNOM_USU,PAPE_USU,SAPE_USU, Cmed_horario ,nom_medi,NEPS_CON
				   from citas,horarios,usuario, medicos , contrato, ucontrato
				   WHERE citas.id_horario=horarios.id_horario and Idusu_citas= CODI_USU AND horarios.Cmed_horario = medicos.cod_medi AND
				   usuario.CODI_USU = ucontrato.CUSU_UCO AND ucontrato.CONT_UCO = contrato.CODI_CON			   
				   and $condicion and Clase_citas<=5 ORDER BY Fecha_horario desc";}
 else{
	  $lis="select Clase_citas,NROD_USU, Esta_cita,Fecha_horario, Hora_horario , PNOM_USU,SNOM_USU,PAPE_USU,SAPE_USU, nom_medi,NEPS_CON
				   from citas,horarios,usuario, medicos, contrato, ucontrato 
				   WHERE Clase_citas<=5 and citas.id_horario=horarios.id_horario and Idusu_citas= CODI_USU AND horarios.Cmed_horario = medicos.cod_medi AND
				   usuario.CODI_USU = ucontrato.CUSU_UCO AND ucontrato.CONT_UCO = contrato.CODI_CON ORDER by Fecha_horario desc";}
	  
//echo $lis;
//$lis=("select Clase_citas,NROD_USU, Esta_cita,Fecha_horario, Hora_horario , PNOM_USU,SNOM_USU,PAPE_USU,SAPE_USU 
//from citas,horarios,usuario where citas.id_horario=horarios.id_horario and Idusu_citas= CODI_USU and 
//Fecha_horario>='$t2' and Fecha_horario<='$t3' and Clase_citas<='5' and NROD_USU ='$t1'   order by  Hora_horario");

$lista=mysql_query($lis);

while ($rowq=mysql_fetch_array($lista)){

$nom=$rowq["PNOM_USU"];
$nom2=$rowq["SNOM_USU"];
$nom3=$rowq["PAPE_USU"];
$nom4=$rowq["SAPE_USU"];
$esta=$rowq["NROD_USU"];
$cont_usu=$rowq["NEPS_CON"];
$fex=$rowq["Fecha_horario"];
$nom_medi=$rowq["nom_medi"];
$hox=substr($rowq["Hora_horario"],10);

$nombre=$nom." ".$nom2." ".$nom3." ".$nom4;
echo "<tr>";
echo "<td class=estilo7>$esta</td>";
echo "<td class=estilo7>$nombre</td>";
echo "<td class=estilo7>$cont_usu</td>";
echo "<td class=estilo7>$fex</td>";
echo "<td class=estilo7>$hox</td>";
echo "<td class=estilo7>$nom_medi</td>";

echo "</tr>";

}

?>

</table>

<br>
<p>



</div>
</BODY>
</HTML> 