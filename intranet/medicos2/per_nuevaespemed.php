<html>
<head><title>Captura Especialidades del Médico</title>
<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function validar(form)
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
    if (form.espe_medi.value == "") { a += "Especialidad\n"; }
    if (a != "") 
    { alert(error + a);return true;}

form.submit()
}
function atras()
{
  history.go(-1)
}
</script>
</head>
<body >

<FORM name='per_nuevaespemed' method="POST" action='per_guardaespemed.php'><br>
<?
include ('php/funciones.php');
//Conexion con la base
include ('php/conexion.php');
$consulta="SELECT m.cod_medi,m.nom_medi,m.dir__medi,m.telf_medi FROM medicos m WHERE m.cod_medi='$cod_medi'";
//echo $consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);
?>
<table border="1" width="80%" align="center" BorderColor=#FFFFFF bgcolor="#D0D0F0" cellpadding=0 Cellspacing=1>
<tr>
  <td width="15%" align="right"><b><font size=2 face="arial">Codigo:</font></td>
  <td width="35%"><?echo $cod_medi;?></td>
  <td width="15%" align="right"><b><font size=2 face="arial">Nombre:</font></td>
  <td width="35%"><?echo $row[nom_medi];?></td>
</tr>
<tr>
  <td width="15%" align="right"><b><font size=2 face="arial">Dirección:</font></td>
  <td width="35%"><?echo $row['dir__medi'];?></td>
  <td width="15%" align="right"><b><font size=2 face="arial">Teléfono:</font></td>
  <td width="35%"><?echo $row[telf_medi];?></td>
</tr>

</table>
<input type='hidden' name='cod_medi' value='<?echo $row[cod_medi];?>'>
  <center><h2>Nueva Especialidad</h2></center>
  <Table border="0" BgColor="#FFFFFF" BorderColor=#E6E8FA width="80%" align="center" cellpadding=0 Cellspacing=1>
  <tr><th bgcolor="#D0D0F0">Seleccionar Especialidad</th><th bgcolor="#D0D0F0" colspan='2'>Opciones</th></tr>
  <tr><td bgcolor="#D0D0F0" align="center"><select name='espe_medi'><option value=""></option>>
  <?
  $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='26' ORDER BY nomb_des");
  while($row=mysql_fetch_array($consulta)){
    echo "<option value='$row[codi_des]'>".$row[nomb_des]."</option>";
  }
  mysql_free_result($consulta);
  mysql_close();
  ?>
  </td>
  <td bgcolor="#D0D0F0" align="center"><input type="button" name="btnguardarnuevo" value="Guardar" onclick="validar(this.form)"></td>
  <td bgcolor="#D0D0F0" align="center"><input type="button" name="regresar" value="Regresar" onclick="atras()"></td>
  </tr>
  </table>
  <br><center><b><?echo $mensaje;?></center>
</body>
</html>