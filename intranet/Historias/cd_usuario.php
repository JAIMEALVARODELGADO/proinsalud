<!-- Captura la identificación del usuario a buscar  la epicrisis-->
<html>
<head><title>Buscar Epicrisis</title>

<script language="javascript">
function validar()
{
	 if (form1.usu.value == "") 
    { alert("Por favor ingrese la Identificación"); return true; }

	if (form1.contrato.value == "") 
    { alert("Por favor ingrese el Contrato"); return true; }

   form1.submit()
}
</script>

<?
include('php/conexion2.php');
?>

<form name="form1" method="POST" action="actualiza.php" target="fr04">
<table width =100% align="center" border=0 cellpadding="0" cellspacing="1">
<tr>
  <td bgcolor='#0033FF' align='center'><font size=2 color='#ffffff'><b>LABORATORIO CLINICO</font></td>
</tr>
</table>
<br>
<table border="1" width="70%" align="center" BorderColor=#FFFFFF bgcolor="#D0D0F0" cellpadding=0 Cellspacing=1>
  <td width="25%" align="center"><b><font size=2 face="arial">Usuario</font>
  <input type=text name=usu></td>
  <td width="40%" align="center"><b><font size=2 face="arial">Contrato
  <select name='contrato'>
      <option value=''>
      <?
		$consulta=mysql_query("select codi_con,neps_con from contrato order by neps_con");
		while ($row=mysql_fetch_array($consulta))
		{
			echo "<option value=".$row['codi_con'].">".$row['neps_con'];
		}
	  ?>
    </select>
  </td>
  
  <td width="10%" align="center"><input type="button" name="btn1" value="Buscar" onclick="validar()"></td>
</tr>
</table>
</form>
</body>
</html>