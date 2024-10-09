<html>
<head><title>Buscar Area</title>
<script languaje="javascript">
function validar(form)
{
   window.open("per_nuevoare.php","fr04")
}
</script>


</head>
<body>

<table width =100% align="center" border=1 cellpadding="0" cellpacing="1">
<th><font size=2>Administracion de Areas</font></th>
</table>

<form name="per_buscaare" method="POST" action="per_muestraare.php" target="fr04">
<table border="1" width="80%" align="center" BorderColor=#FFFFFF bgcolor="#D0D0F0" cellpadding="0" Cellspacing="1">
  <tr>
  <td width="10%" align="right"><b><font size=2 face="arial">Codigo:</font></td>
  <td width="25%"><input type=text name="cod_areas" size=3 maxlength=3></td>
  <td width="10%" align="right"><b><font size=2 face="arial">Nombre:</font></td>
  <td width="25%"><input type=text name="nom_areas" size=20 maxlength=20></td>
  <td width="10%" align="right"><b><font size=2 face="arial">Orden:</font></td>
  <td width="20%"><select name="orden"><option value="cod_areas">Código
    <option value="nom_areas">Nombre
  </select>
  </td>  
  </tr>
</table>
<table align="center">
  <td width="25%" align="left"><input type="SUBMIT" name="btn1" value="Buscar"></td>
  <td width="25%" align="left"><input type="button" name="btn2" value="Nuevo" onclick="validar(this.form)"></td>
</table>
</form>
</body>
</html>

