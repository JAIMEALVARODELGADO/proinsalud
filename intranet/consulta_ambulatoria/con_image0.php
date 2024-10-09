<?	
	session_register('paciente');
	echo $paciente;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<HEAD>
<TITLE>Impresion de Imagenología</TITLE>
<link rel="stylesheet" href="style.css" type="text/css"/>
</HEAD>

<BODY >
<form name='form1' method='post' action='imagen31'>
<table class='tbl' align=center border=1>
<?
	$fechoy=date('Y-m-d');
	$ano=date('Y');
	$mesini=date('m');
	$diaini=date('d');
	$anoini=$ano-1;
	$fechaini=$anoini.'-'.$mesini.'-'.$diaini;
	
include('php/conexion1.php');
$consulta=mysql_query("SELECT Max(lectura_imagen.copr_lec) AS codi, mapii.desc_map
FROM mapii INNER JOIN lectura_imagen ON mapii.codi_map = lectura_imagen.copr_lec
WHERE (((lectura_imagen.codi_usu)='$paciente') AND ((lectura_imagen.fech_lec)>='$fechaini'))
GROUP BY mapii.desc_map	
ORDER BY Max(lectura_imagen.copr_lec) DESC");
if(mysql_num_rows($consulta)!=0)
{
	echo"
	<tr><th colspan=2 ALIGN=CENTER>LECTURA DE IMAGENOLOGIA DISPONIBLES</th></tr>
	<tr>
	<th>Opc</th>
	<th>DESCRIPCION</th>
	</tr>";
	while($row=mysql_fetch_array($consulta))
	{
		$codigo=$row['codi'];
		$descrip=$row['desc_map'];
		echo "<tr>";
		echo"<tr><td align=center><a href=con_image1.php?codigo=$codigo&fechaini=$fechaini target=''><img src='imagenes/next.jpg' border=0 width=17 height=17 alt='Imprimir' ></a></td>";
		echo "<td align='left'>$descrip</td>";
		echo "</tr>";
	}
}
else
{
	echo"<tr>	
	<td colspan=2>NO EXISTEN RESULTADOS DE IMAGENOLOGIA DISPONIBLES</th>
	</tr>";
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
