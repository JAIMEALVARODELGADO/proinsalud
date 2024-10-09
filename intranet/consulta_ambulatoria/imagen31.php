<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<HEAD>
<TITLE>Impresion de Imagenología</TITLE>
<link rel="stylesheet" href="../imagenologia/css/style.css" type="text/css" />
</HEAD>

<BODY >
<form name='form1' method='post' action='imagen31'>
<table class='Tbl1'><th class='Th2'>Usuarios con Lectura de Imagenología</th></table>

<table class='Tbl1' border='0'>
<th class='Td1'>Opc</th>
<th class='Td1'>Identificación</th>
<th class='Td1'>Nombre</th>
<th class='Td1'>Fecha</th>
<th class='Td1' colspan='2'>Examen</th>
<th class='Td1' colspan='1'>Estado</th>
<?

include('php/conexion.php');
$condicion="l.esta_lec='CU' and ";
if(!empty($nrod_usu)){$condicion=$condicion."u.nrod_usu='$nrod_usu' and ";}

$condicion=substr($condicion,0,strlen($condicion)-5);
$consulta=mysql_query("SELECT u.nrod_usu,u.pnom_usu,u.snom_usu,u.pape_usu,u.sape_usu,l.iden_lec,l.fech_lec,l.copr_lec,l.arch_lec,l.esta_lec,c.descrip,c.codi_cup 
FROM usuario AS u 
INNER JOIN lectura_imagen AS l ON u.codi_usu=l.codi_usu 
INNER JOIN cups as c ON l.copr_lec=c.codigo WHERE $condicion");
while($row=mysql_fetch_array($consulta)){
  $nombre=$row[pnom_usu].' '.$row[snom_usu].' '.$row[pape_usu].' '.$row[sape_usu];
  $archivo='../imagenologia/resultados/'.$row[arch_lec];
  echo "<tr>";
  //echo "<td class='Td0' align='left'><a href='#' onclick='imprimir($row[iden_lec])'><img src='img/feed_add.png' alt='Imprimir Lectura'></a></td>";
  echo "<td class='Td0' align='left'><a href='$archivo' target='blank'><img src='../imagenologia/img/word.ico' alt='Lectura' width='30' height='30' border='0'></a></td>";
  echo "<td class='Td0' align='left'>$row[nrod_usu]</td>";
  echo "<td class='Td0' align='left'>$nombre</td>";
  echo "<td class='Td0' align='left'>".$row[fech_lec]."</td>";
  echo "<td class='Td0' align='left'>$row[codi_cup]</td>";
  echo "<td class='Td0' align='left'>$row[descrip]</td>";
  echo "<td class='Td0' align='left'>$row[esta_lec]</td>";
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
