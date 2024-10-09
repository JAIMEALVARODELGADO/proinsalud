<html>
<head><title>Modifica Area</title>

<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function validar(form)
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
	if (form.nom_areas.value == "") { a += "Nombre\n"; }
	if (form.tipo_areas.value == "") { a += "Tipo\n"; }
	if (form.clas_areas.value == "") { a += "Clase\n"; }
    if (a != "") 
    { alert(error + a);return true;}

form.submit()
}

function atras()
{
  history.go(-1)
}
</script>
</head>
<body >

<FORM METHOD="POST" name="per_modiare" action="per_guardamodare.php"><br>
<?
//Conexion con la base
include ('php/conexion.php');
//selección de la base de datos con la que vamos a trabajar 
$consulta=mysql_query("SELECT nom_areas,tipo_areas,clas_areas FROM areas WHERE cod_areas=$cod_areas");
$row=mysql_fetch_array($consulta);
?>
  <center><h2>Modifica Area</h2></center>
  <table border="1" width="50%" align="center" BorderColor=#FFFFFF bgcolor="#D0D0F0" cellpadding=0 Cellspacing=1>
  <tr>
  <td width="15%" align="right"><b><font size=2 face="arial">Código:</font></td>
  <td width="15%"><input type="text" name="cod_areas" size="3" maxlength="3" value="<?echo $cod_areas;?>" disabled='true'></td>
  <td width="15%" align="right"><b><font size=2 face="arial">Nombre:</font></td>
  <td width="50%"><input type="text" name="nom_areas" size="50" maxlength="50" value="<?echo $row['nom_areas'];?>"></td>
  </tr>
  <tr>
  <td width="15%" align="right"><b><font size=2 face="arial">Tipo:</font></td>
  <td width="15%"><select name="tipo_areas"><option value=''>
    <?
	if($row['tipo_areas']=='2'){
	  echo "<option value='1'>Asistencial";
      echo "<option value='2' selected='true'>Administrativo";}
	else{
	  echo "<option value='1' selected='true'>Asistencial";
      echo "<option value='2'>Administrativo";}	
	?>
    </select>
  </td>
  <td width="15%" align="right"><b><font size=2 face="arial">Clase:</font></td>
  <td width="55%"><select name="clas_areas"><option value=''>
    <?
	if($row['clas_areas']=='E'){
	  echo "<option value='I'>Interno";
      echo "<option value='E' selected='true'>Externo";}
	else{
	  echo "<option value='I' selected='true'>Interno";
      echo "<option value='E'>Externo";}	
	?>
    </select>
  </td>
  </tr>  
  <input type="hidden" name="cod_areas" size="10" maxlength="10" value="<?echo $cod_areas;?>">
  </table> 
</table>

<br>
<table border="0" width="50%" align="center" cellpadding=0 Cellspacing=1>
  <tr>
    <td width="50%" align="center"><input type="button" name="btnnuevo" value="Guardar" onclick="validar(this.form)"></td>
    <td width="50%" align="center"><input type="button" name="regresar" value="Regresar" onclick="atras()"></td>
  </tr>
</table>

</body>
</html>