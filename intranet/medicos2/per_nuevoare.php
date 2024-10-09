<html>
<head><title>Nueva Area</title>

<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function validar(form)
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
	if (form.cod_areas.value == "") { a += "Código\n"; }
	if (form.nom_areas.value == "") { a += "Nombre\n"; }
	if (form.tipo_areas.value == "") { a += "Tipo\n"; }
	if (form.clas_areas.value == "") { a += "Clase\n"; }
    if (a != "") 
    { alert(error + a);return true;}

form.submit()
}
</script>
</head>
<body >

<FORM METHOD="POST" name="per_nuevoare" action="per_guardaare.php"><br>
  <center><h2>Nueva Area</h2></center>
  <table border="1" width="70%" align="center" BorderColor=#FFFFFF bgcolor="#D0D0F0" cellpadding=0 Cellspacing=1>
  <tr>
  <td width="15%" align="right"><b><font size=2 face="arial">Código:</font></td>
  <td width="15%"><input type="text" name="cod_areas" size="3" maxlength="3" value="<?echo $cod_areas;?>"></td>
  <td width="15%" align="right"><b><font size=2 face="arial">Nombre:</font></td>
  <td width="55%"><input type="text" name="nom_areas" size="50" maxlength="50" value="<?echo $nom_areas;?>"></td>
  </tr>
  <tr>
  <td width="15%" align="right"><b><font size=2 face="arial">Tipo:</font></td>
  <td width="15%"><select name="tipo_areas"><option value=''>
    <?
	if($tipo_areas=='2'){
	  echo "<option value='1'>Asistencial";
      echo "<option value='2' selected='true'>Administrativosistencial";}
	else{
	  echo "<option value='1'>Asistencial";
      echo "<option value='2'>Administrativo";}	
	?>
    </select>
  </td>
  <td width="15%" align="right"><b><font size=2 face="arial">Clase:</font></td>
  <td width="55%"><select name="clas_areas"><option value=''>
    <?
	if($clas_areas=='E'){
	  echo "<option value='I'>Interno";
      echo "<option value='E' selected='true'>Externo";}
	else{
	  echo "<option value='I'>Interno";
      echo "<option value='E'>Externo";}	
	?>
    </select>
  </td>
  </tr>
  </table> 
</table>
<br><center><input type="button" name="btnnuevo" value="Guardar" onclick="validar(this.form)"></center>
</center>
<?
  echo "<br><center><b>$mensaje</center>";
?>
</body>
</html>