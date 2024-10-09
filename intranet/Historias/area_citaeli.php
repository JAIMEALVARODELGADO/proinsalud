
<html>
<head>
<SCRIPT LANGUAGE=JavaScript>

function Muestra(){
var texto2 = US_Add.areae.value+US_Add.idee.value

window.open("enc_eli_cit.php?area3="+texto2,"Frma2")
}
</SCRIPT>
<title><h6>PROGRAMA PARA EL MANEJO DE CITAS MEDICAS</h6></title>
</head>
<body scroll = "no">

<form name="US_Add" method="post" action="enc_eli_cit.php" target="Frma2" >
<IMG SRC="IMG/eli_cita.BMP" width=100% >

<table width =97%  >
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
<td width=50% align="right">
<b>Identificacion:</b></td>
<td width=50% align="left"><input type="text" name="idee" onChange="Muestra();" ></td></tr>


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




echo '<select name="areae" onChange="Muestra();" >';

//Generamos el menu desplegable
echo '<option >--------'; 
echo '<option value=03>MEDICINA DE URGENCIAS'; 


?>


</select>
</td>
</tr>
</form>
</body>
</html>
