<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<HEAD>
<TITLE>Impresion de Imagenología</TITLE>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</HEAD>

<script languaje='javascript'>
function imprimir(id_lectura) 
{
	var URL="imagen311.php?iden_lec="+id_lectura
	var titulo="Epicrisis" 
	var x=0 
	var y=0 
	var ancho=900
	var alto=700
	var herramientas=0
	var direccion=0
	var barras=1
	ventana= window.open(URL,titulo,"left="+x+",top="+y+",width="+ancho+",height="+alto+",toolbar="+herramientas+",location="+direccion+",scrollbars="+barras) 
} 

</script>

<BODY >
<form name='form1' method='post' action='imagen31' target='mainFrame'>
<table class='Tbl1'><th class='Th2'>Usuarios con Lectura de Imagenología</th></table>

<table class='Tbl1'>
<th class='Td1'>Opc</th>
<th class='Td1'>Identificación</th>
<th class='Td1'>Nombre</th>
<th class='Td1'>Fecha</th>
<th class='Td1' colspan='2'>Examen</th>
<th class='Td1' colspan='1'>Estado</th>
<?
include('php/conexion.php');
base_proinsalud();
include('php/funciones.php');
if(!empty($nrod_usu)){$condicion=$condicion."u.nrod_usu='$nrod_usu' and ";}
if(!empty($flec_ini)){
  $flec_ini=cambiafecha($flec_ini);
  $condicion=$condicion."l.fech_lec>='$flec_ini' and ";
}
if(!empty($flec_fin)){
  $flec_fin=cambiafecha($flec_fin);
  $condicion=$condicion."l.fech_lec<='$flec_fin' and ";
}
$condicion=substr($condicion,0,strlen($condicion)-5);
$consulta=mysql_query("SELECT u.nrod_usu,u.pnom_usu,u.snom_usu,u.pape_usu,u.sape_usu,l.iden_lec,l.fech_lec,l.copr_lec,l.arch_lec,l.esta_lec,c.descrip FROM usuario AS u 
INNER JOIN lectura_imagen AS l ON u.codi_usu=l.codi_usu 
INNER JOIN cups as c ON l.copr_lec=c.codigo WHERE $condicion");



$num=mysql_num_rows($consulta);

while($row=mysql_fetch_array($consulta)){
  $nombre=$row[pnom_usu].' '.$row[snom_usu].' '.$row[pape_usu].' '.$row[sape_usu];
  $archivo='resultados/'.$row[arch_lec];
  $iden_lec=$row[iden_lec];
  echo "<tr>";
  //if(!empty($row[arch_lec])){
    echo "<td class='Td0' align='left'><a href='imagen311.php?iden_lec=$iden_lec' target='blank'><img src='img/word.ico' alt='Lectura' width='30' height='30'></a></td>";
 // }
//  else{
//    echo "<td class='Td0' align='left'></td>";
//  }
  echo "<td class='Td0' align='left'>$row[nrod_usu]</td>";
  echo "<td class='Td0' align='left'>$nombre</td>";
  echo "<td class='Td0' align='left'>".cambiafechadmy($row[fech_lec])."</td>";
	$cocup=$row[copr_lec];
  $bcup=mysql_query("select codi_cup from cups where codigo='$cocup'");
  while($rcup=mysql_fetch_array($bcup))
  {
	  $codigocup=$rcup['codi_cup'];
  }
  echo "<td class='Td0' align='left'>$codigocup</td>";
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
