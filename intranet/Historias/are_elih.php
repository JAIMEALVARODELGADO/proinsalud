
<html>
<head>
<SCRIPT LANGUAGE=JavaScript>

function Muestra(){
var texto2 = US_Add.areae.value

window.open("enc_eli.php?area3="+texto2,"Frmh2a")
}
</SCRIPT>
<title><h6>PROGRAMA PARA EL MANEJO DE CITAS MEDICAS</h6></title>
</head>
<body  scroll = "no">

<form name="US_Add" method="get" action="enc_eli.php" target="Frmh2a" >
<IMG SRC="IMG/eli_HOR.BMP" width=100% >

<table width =97%  >
<tr>
<td></td>
</tr>

<tr>
<td>.</td>
</tr>
<tr>
<td>.</td>
</tr>
<tr>
<td>.</td>
</tr>

<tr>
<td></td>
</tr>

<tr>
<td></td>
</tr>

<tr>
<td></td>
</tr>
<tr>
<td></td>
</tr>

<tr>
<td width=50% align="right">
<b>Area:</b>
</td>
<td width=50% align="left">

<?
//Conexion con la base
mysql_connect("localhost","root","");

//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud"); 


//Creamos la sentencia SQL y la ejecutamos
$sSQL="Select cod_areas,nom_areas From areas Order By nom_areas";
$result=mysql_query($sSQL);

echo '<select name="areae" onChange="Muestra();" >';

//Generamos el menu desplegable
echo '<option >--------'; 
while ($row=mysql_fetch_array($result))
{echo '<option value='.$row["cod_areas"].'>'.$row["nom_areas"]; 

}
?>


</select>
</td>
</tr>
</form>
</body>
</html>
