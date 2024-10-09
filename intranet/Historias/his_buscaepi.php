<!-- Captura la identificación del usuario a buscar  la epicrisis-->
<html>
<head><title>Buscar Epicrisis</title>

<script language="javascript">
function validar(form)
{
    if (form.identificacion.value == "") 
    { alert("Por favor ingrese la identificación"); return true; }

form.submit()
}
</script>

</head>
<body >
<table width =100% align="center" border=0 cellpadding="0" cellspacing="1">
<tr>
  <td bgcolor='#0033FF' align='center'><font size=2 color='#ffffff'><b>EPICRISIS</font></td>
</tr>
</table>

<form name="form1" method="POST" action="his_muestraepi.php" target="fr04">
<table border="0" width="100%" align="center" BorderColor=#FFFFFF bgcolor="#D0D0F0" cellpadding=0 Cellspacing=1>
  <td width="15%" align="right"><b><font size=2 face="arial">Identificación:</font></td>
  <td width="15%"><input type=text name="identificacion" size=20 maxlength=20>*</td>
  <td width="25%" align="left"><input type="button" name="btn1" value="Buscar" onclick="validar(this.form)"></td>
</tr>
</table>
</form>
</body>
</html>

