<?
require('code/Lib_SI.Inc');
?>
<htm> 
<head>
<title>Ingresar Solicitudes</title>
<script type="text/javascript" src="code\valid_Form.js"></script>
</head> 
<body bgcolor="#E6E8FA" OnLoad="this.document.SI_Add.srSolicitud.focus()"> 
<div id="sombra" style="position:relative;width:450;height:50;top:0;left:0;text-align:left;filter:shadow(color=#666699)"> <br> 
<font color=#FFFFDD size=3 face=arial><b>INGRESAR SOLICITUDES<br></DIV><br>
</font><br>
<?
$xcon=conectar_bd();
$xsql = "select * from usuarios where Cod_Usua = $Sesion[2] ";
$xres = mysql_query($xsql);
while($xrow = mysql_fetch_row($xres)) {
   $nom="$xrow[1] $xrow[2]";
   $Sesion[4]="$xrow[3]";
   $area="$xrow[4]";
}
mysql_free_result($xres);
desconectar_bd();
?>
<br>
<br>
<br>
<form name="SI_Add" method="POST" action="add_solicitudes.php">
<Table border="0" width="100%" cellpadding=0 Cellspacing=1>
<tr>
  <td width="50%" align="right"><b><font size=2 face="arial">Fecha:</font></td>
  <td width="50%"><b><input type=text name="srFecha" READONLY size=8 maxlength=8 value="<? echo $fecha=date("Y/m/d"); ?>"></td>
</tr>
<tr>
  <td width="50%" align="right"><b><font size=2 face="arial">Funcionario:</font></td>
  <td width="50%"><b><input type=text name="srFuncionario" READONLY size=30 maxlength=30 value="<? echo $nom; ?>" ></td>
</tr>
<tr>
  <td width="50%" align="right"><b><font size=2 face="arial">Area:</font></td>
  <td width="50%"><b><input type=text name="srArea" READONLY size=2 maxlength=2 value="<? echo $area; ?>"></td>
</tr>
<tr>
  <td width="50%" align="right"><b><font size=2 face="arial">Estado:</font></td>
  <td width="50%"><b><input type=text name="srEstado" READONLY size=2 maxlength=2 value="S"></td>
</tr>
<tr>
  <td width="50%" align="right"><b><font size=2 face="arial">Solicitud:</font></td>
  <td width="50%"><b><textarea name="srSolicitud" rows=3 cols=50 maxlength=200></textarea>*</td>
</tr>
<tr>
  <td width="50%" align="right"><b><font size=2 face="arial">Clase:</font></td>
  <td width="50%"><b><?PHP lista_desplegable("sq22", "general", "clase", "3", "2") ?>
  </td>
</tr>
</table>
<br>
<br>
<table border="0" width="100%" cellpadding=0 Cellspacing=1>
<tr>
  <td width="50%" align="right"><input type="button" value="Guardar" onClick="if(Verifica()) form.submit()"></td>
  <td width="50%"><input type=reset name="Btn2" value="Limpiar"></td>
</tr>
</table>
</form>
<br>
<Table border="0" width="50%" cellpadding=0 Cellspacing=1 align="Center">
<tr>
  <td width="50%" align="center"><font size=2 face="arial">los campos marcados con " * " son obligatorios</font></td>
</tr>
</table>
</body>
</html>