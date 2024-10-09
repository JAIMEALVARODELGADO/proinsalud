<!-- Captura la identificación del usuario a buscar  la epicrisis-->
<html>
<head><title>Buscar Epicrisis</title>

<script language="javascript">
function validar()
{
    if (form1.area.value == "") 
    { alert("Por favor ingrese el area"); return true; }

form1.submit()
}
function exportar()
{
	form1.target="";
	form1.action="censo_clinica.php";
	form1.submit();
}
</script>

<?
include('php/conexion2.php');
?>
<form name="form1" method="POST" action="his_muestracens.php" target="fr04">
<table width =100% align="center" border=0 cellpadding="0" cellspacing="1">
<tr>
  <td bgcolor='#0033FF' align='center'><font size=2 color='#ffffff'><b>C E N S O</font></td>
</tr>
</table>
<br>
<table border="0" width="100%" align="center" BorderColor=#FFFFFF bgcolor="#D0D0F0" cellpadding=0 Cellspacing=1>
  <td width="15%" align="right"><b><font size=2 face="arial">Area</font></td>
  <td width="15%"><select name='area'>
      <option value=''>
      <?
	   $consulta=mysql_query("SELECT codi_des,  codt_des,  nomb_des   FROM destipos WHERE codt_des='06' AND homo2_des='F' ORDER BY nomb_des");
		while($row=mysql_fetch_array($consulta)){
		
		echo "<option value='$row[codi_des]'>$row[nomb_des]";
		}
	  ?>
    </select>
  </td>
  <td width="25%" align="left"><input type="button" name="btn1" value="Buscar" onclick="validar()"></td>
  
   <td width="25%" align="left"><input type="button" name="btn1" value="Exportar a excel" onclick="exportar()"></td>
</tr>
</table>
</form>
</body>
</html>

