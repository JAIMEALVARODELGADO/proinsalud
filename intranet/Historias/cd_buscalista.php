<!-- Captura los parámetros a buscar -->
<html>
<head><title>Buscar Usuario</title>

<script languaje="javascript">
function validar(form)
{ var a=""
    if (form.identificacion.value == "" && form.pnombre.value == ""  && form.snombre.value == "" && form.papelli.value == "" && form.sapelli.value == ""){a+="1"}
    if (a!= "") 
    { alert("Por favor ingrese uno de los datos de los parámetros"); return true; }

form.submit()
}
</script>

</head>
<body >
<img src="imagenes/barrausuario.bmp">
<form name="cd_buscalista" method="POST" action="cd_listausu.php" target="fr04">
<b>Parámetros de Búsqueda</b>
<table border="1" width="100%" align="center" BorderColor=#FFFFFF bgcolor="#D0D0F0" cellpadding=0 Cellspacing=1>
<tr>
  <td width="25%" align="right"><b><font size=2 face="arial">Identificación:</font></td>
  <td width="25%"><input type=text name="identificacion" size=20 maxlength=20></td>
  <td width="25%" align="center"><input type="button" name="btn1" value="Buscar" onclick="validar(this.form)"></td>
</tr>
<tr>
  <td width="25%" align="right"><b><font size=2 face="arial">Primer Nombre</font></td>
  <td width="25%"><input type=text name="pnombre" size=20 maxlength=20></td>
  <td width="25%" align="right"><b><font size=2 face="arial">Segundo Nombre:</font></td>
  <td width="25%"><input type=text name="snombre" size=20 maxlength=20></td>
</tr>
<tr>
  <td width="25%" align="right"><b><font size=2 face="arial">Primer Apellido</font></td>
  <td width="25%"><input type=text name="papelli" size=20 maxlength=20></td>
  <td width="25%" align="right"><b><font size=2 face="arial">Segundo Nombre:</font></td>
  <td width="25%"><input type=text name="sapelli" size=20 maxlength=20></td>
</tr>
</table>
</form>
</body>
</html>

