
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
<TITLE>Actualizar1.php</TITLE>
<script languaje="javascript">
function ConfirmarEnvio(form)
{
enviar = window.confirm('Se eliminaran los Horarios Seleccionados desea Continuar?');
(enviar)?form.submit():'return false';
}
</script>
</HEAD>

<BODY bgcolor="#E6E8FA">
<?

//Conexion con la base
mysql_connect("localhost","root","");

//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud"); 

echo '<FORM METHOD="POST" ACTION="gene_eliser.php"><br>';

//Creamos la sentencia SQL y la ejecutamos

$sSQL="SELECT cod_ar, cod_med_ar,areas_ar,nom_medi,ape_medi,nom_areas from  medicos,areas_medic,areas where cod_med_ar=cod_medi and areas_ar=cod_areas and cod_areas=$areae";

$result=mysql_query($sSQL);

?>




<table width =100% align="center" border=1 cellpadding="0" cellpacing="1">
<td align="center"><font size=2><b>Listado de Medicos por Area</b></td>
</table>
<p>
<table width =100% align="center" border=1 cellpadding="0" cellpacing="1">
<th bgcolor="#8F8FBD">Elegir<th bgcolor="#8F8FBD">Codigo Medico<th bgcolor="#8F8FBD">Codigo Area</th><th bgcolor="#8F8FBD">Nombre del Area</th><th bgcolor="#8F8FBD">Nombres</th>

<tr>

<?

//Mostramos los registros
while ($row=mysql_fetch_array($result))
{
$valor=$row["cod_ar"];//recupera este
$nombre="mario";

$aDatos=array($valor=>$nombre); 
 
foreach($aDatos as $id=>$nombre) { 
 echo "<tr><td align=center><input type='checkbox' name='seleccion[]'  value='$id'  /> <br /></td>"; 
 } 
echo '<td> <font size=2>'.$row["cod_med_ar"].'</font></td>';
echo '<td><font size=2>'.$row["areas_ar"].'</font></td>';
echo '<td><font size=2>'.$row["nom_areas"].'</font></td>';				
echo '<td><font size=2>'.$row["nom_medi"].'</font></td>';				
//echo '<td><font size=2>'.$row["ape_medi"].'</font></td>';				
//echo '<td><font size=2>'.$row["nom_areas"].'</font></td>';
				  
				  
echo '</td></tr>';

}


//mysql_free_result($result)


?>
</table>
<input type="button" value="Eliminar" onClick="ConfirmarEnvio(this.form)">

</BODY>
</HTML> 