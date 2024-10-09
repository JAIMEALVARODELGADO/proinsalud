<!-- Captura la identificación del usuario a buscar -->
<html>
<head><title>Buscar Usuario</title>

<script languaje="javascript">
function validar(form)
{
    if (form.identificacion.value == "") 
    { alert("Por favor ingrese la identificación"); return true; }

form.submit()
}
</script>

</head>
<body >
<table width =100% align="center" border=1 cellpadding="0" cellpacing="1">
<th ><font size=2>Verificar Derechos de Usuario</font></th>
</table>



<form name="cd_buscausuario" method="POST" action="cd_muestrausu.php" target="fr04">
<table border="1" width="100%" align="center" BorderColor=#FFFFFF bgcolor="#D0D0F0" cellpadding=0 Cellspacing=1>
  <td width="15%" align="right"><b><font size=2 face="arial">Identificación:</font></td>
  <td width="15%"><input type=text name="identificacion" size=20 maxlength=20>*</td>
  <td width="15%" align="right"><b><font size=2 face="arial">Contrato:</font></td>
  <td width="30%"><select name="contrato">
  <!-- Aqui se captura el contrato -->
  <?
    //Conexion con la base
    mysql_connect("localhost","root");
    //selección de la base de datos con la que vamos a trabajar 
    mysql_select_db("proinsalud"); 
    //Creamos la sentencia SQL y la ejecutamos
    $consulta=mysql_query("SELECT CODI_CON,NEPS_CON FROM contrato ORDER BY NEPS_CON");
    //Genero el combo de contratos
    while ($row=mysql_fetch_array($consulta)){
      echo "<option value=".$row['CODI_CON'].">".$row['NEPS_CON'];
    }
    mysql_free_result($consulta);
    mysql_close();
  ?>
  </select>
  </td>
  <td width="25%" align="left"><input type="button" name="btn1" value="Buscar" onclick="validar(this.form)"></td>
</tr>
</table>
</form>
</body>
</html>

