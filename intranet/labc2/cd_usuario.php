<!-- Captura la identificación del usuario a buscar -->
<html>
<head><title>Buscar Usuario</title>
<style type="text/css">
<!--
.Estilo30 {font-family: Arial, Helvetica, sans-serif; font-size: 11px}
.Estilo32 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }

-->
</style>
<script language="javascript">

function validar(form)
{
    if (form.cod_usu.value =="") 
    { alert("Por favor ingrese la identificación"); return true; }
	 if (form.contrato.value =="") 
    { alert("Por favor ingrese el Contrato"); return true; }
	
    form.contr.value=1;
	form.submit()
}
</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body >
  <form name="cd_usuario" method="POST" action="ing_cups.php" target="Fr04">
  
  <table class='Tbl0'>
   <tr><td class='Td1' align='center'><STRONG>INGRESO DE USUARIOS - LABORATORIO CLINICO</strong></td></tr>
   </table><br><br>
  <Table width="50%" border="0" align="center"><tr bgcolor=#FEE9BC>
  <td  class='Td1'><input name="imageField" type="image" src="icons/48px-User-info_svg.png" align="left" width="25" height="25" border="0"></td>
  <td class='Td1'><font bgcolor='#FEE9BC'><b>Identificación:</font></td>
  <input type=hidden name=fat value=3>
  <input type=hidden name=format value='3'>
  <td  class='Td1'><input type=text name="cod_usu" size=12 maxlength=20></td>
  <input type=hidden name="contr">
  <td class='Td1'><font bgcolor='#FEE9BC'><b>Orden:</font></td>
  <td  class='Td1'><input type=text name="num_ord" size=12 maxlength=20></td>
  <th class='Td1'><b>Contrato:</font></td>
  <th class='Td1'><select name="contrato">
  <option>  </option>
  <!-- Aqui se captura el contrato -->
  <?
  
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);
	
    $consulta=mysql_query("select codi_con,neps_con from contrato WHERE esta_con='A' order by neps_con");
    
    //Genero el combo de contratos
    while ($row=mysql_fetch_array($consulta)){
      echo "<option value=".$row['codi_con'].">".$row['neps_con'];
    }
    mysql_free_result($consulta);
    mysql_close();
  ?>
  </select>
  </td>
   <td class='Td1' colspan="2" width="15%" align="left"><input type="button" name="btn1" value="Buscar" onclick="validar(this.form)"></td></tr>
   </tr>
</table>
</form>
</body>
</html>
<html><head></head><body></body></html>