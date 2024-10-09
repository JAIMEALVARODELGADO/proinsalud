<html>
<head><title>Buscar Personal</title>
<script languaje="javascript">
function validar(form)
{
   window.open("per_nuevoper.php","fr04")
}
</script>


</head>
<body>
<?
//Conexion con la base
include ('php/conexion.php');
//selección de la base de datos con la que vamos a trabajar 

?>

<table width =100% align="center" border=1 cellpadding="0" cellpacing="1">
<th ><font size=2>Administracion de Personal</font></th>
</table>

<form name="per_buscaper" method="POST" action="per_muestraper.php" target="fr04">
<table border="1" width="100%" align="center" BorderColor=#FFFFFF bgcolor="#D0D0F0" cellpadding=0 Cellspacing=1>
  <tr>
  <td width="15%" align="right"><b><font size=2 face="arial">Codigo:</font></td>
  <td width="20%"><input type=text name="cod_medi" size=20 maxlength=20></td>
  <td width="15%" align="right"><b><font size=2 face="arial">Nombre:</font></td>
  <td width="20%"><input type=text name="nom_medi" size=20 maxlength=20></td>
  <td width="15%" align="right"><b><font size=2 face="arial">Cédula:</font></td>
  <td width="15%"><input type=text name="ced_medi" size=10 maxlength=10></td>
  </tr>
  <tr>
  <td width="15%" align="right"><b><font size=2 face="arial">Estado:</font></td>
  <td width="20%"><select name="esta_medi"><option value=''>Todos
    <option value='A'>Activos
    <option value='I'>Inactivos
	</select></td>
  <td width="15%" align="right"><b><font size=2 face="arial">Ordenado Por:</font></td>
  <td width="15%"><select name="orden"><option value="nom_medi">Nombre
    <option value="cod_medi">Código
	</select></td>
  </tr>
  </table>
  <br>
  <center>
<table>
<td width="25%" align="left"><input type="SUBMIT" name="btn1" value="Buscar"></td>
<td width="25%" align="left"><input type="button" name="btn2" value="Nuevo" onclick="validar(this.form)"></td>
</table>
</center>
</form>
</body>
</html>
