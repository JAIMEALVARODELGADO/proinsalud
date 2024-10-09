<?	
	session_register('paciente');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<HEAD>
<TITLE>Impresion de Imagenología</TITLE>
<link rel="stylesheet" href="style.css" type="text/css"/>
</HEAD>

<BODY >
<form name='form1' method='post' action='imagen31'>
<table class='tbl' border=1 align=center><tr><th colspan=2 align=center>Lectura de Imagenología</th></tr>
<tr>
<th ALIGN=CENTER>Fecha</th>
<th ALIGN=CENTER>lectura</th>
</tr>
<?
echo $paciente;
include('php/conexion1.php');
$consulta=mysql_query("SELECT lectura_imagen.iden_lec, lectura_imagen.iden_var, lectura_imagen.codi_usu, lectura_imagen.fech_lec, lectura_imagen.naut_lec, lectura_imagen.copr_lec, lectura_imagen.arso_lec, lectura_imagen.fipr_lec, lectura_imagen.lect_lec, lectura_imagen.arch_lec, lectura_imagen.esta_lec, lectura_imagen.radi_lec, lectura_imagen.visb_lec
FROM lectura_imagen
WHERE (((lectura_imagen.codi_usu)='$paciente') AND ((lectura_imagen.fech_lec)>='$fechaini') and ((lectura_imagen.copr_lec)='$codigo'))");

while($row=mysql_fetch_array($consulta)){
  $fech_lec=$row['fech_lec'];
  $descrip=$row['lect_lec'];
  echo "<tr>";
  echo "<td>$fech_lec</td>";
  echo "<td align='left'>$descrip</td>";
  echo "</tr>";
}
?>
</table>
<?
mysql_free_result($consulta);
mysql_close();
?>
</form>
</BODY>
</HTML>


















