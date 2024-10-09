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
</script>

<?
include('php/conexion2.php');
?>
<form name="form1" method="POST" action="his_muestracens_contrato.php" target="fr04">
<table width =100% align="center" border=0 cellpadding="0" cellspacing="1">
<tr>
  <td bgcolor='#0033FF' align='center'><font size=2 color='#ffffff'><b>CENSO POR CONTRATO</font></td>
</tr>
</table>
<br>
<table border="0" width="100%" align="center" BorderColor=#FFFFFF bgcolor="#D0D0F0" cellpadding=0 Cellspacing=1>
  <td width="15%" align="right"><b><font size=2 face="arial">Contrato</font></td>
  <td width="15%"><select name='area'>
      <option value=''>
      <?
	    $consulta=mysql_query("SELECT codi_con,  neps_con   FROM contrato ORDER BY neps_con");
		while($row=mysql_fetch_array($consulta))
		{
		echo "<option value='$row[codi_con]'>$row[neps_con]";}
	  ?>
    </select>
  </td>
  
  <td width="25%" align="left"><input type="button" name="btn1" value="Buscar" onclick="validar()"></td>
</tr>
</table>
</form>
</body>
</html>

