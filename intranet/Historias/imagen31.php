<?php
session_start();
?>
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
if(isset($_POST['numidpac']))
{
	$nrod_usu = $_POST['numidpac'];	
	$ano_ini= date(Y)-1;
	$mes_ini= date(m);
	$dia_ini= date(d);	
	$flec_ini=$dia_ini ."/".$mes_ini."/".$ano_ini;	
	$flec_fin = date("d/m/Y");
}
base_proinsalud();
include('php/funciones.php');
if(!empty($gauditor)){
	$conauditor="SELECT ucontrato.IDEN_UCO
	FROM (usuario 
	INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) 
	INNER JOIN usuario_auditor ON ucontrato.CONT_UCO = usuario_auditor.codi_con
	WHERE usuario.NROD_USU='$nrod_usu' AND usuario_auditor.ide_usua='$gauditor' AND ucontrato.ESTA_UCO='AC'";
	//echo $conauditor;
	$conauditor=mysql_query($conauditor);
	if(mysql_num_rows($conauditor)==0){
		echo "<br><center><h2>El usuario no existe o el auditor no tiene acceso al contrato</h2></center>";
		exit();
	}
}
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
$consulta=mysql_query("SELECT u.nrod_usu,u.pnom_usu,u.snom_usu,u.pape_usu,u.sape_usu,l.iden_var,l.iden_lec,l.fech_lec,l.copr_lec,l.arch_lec,l.esta_lec,c.descrip FROM usuario AS u 
INNER JOIN lectura_imagen AS l ON u.codi_usu=l.codi_usu 
INNER JOIN cups as c ON l.copr_lec=c.codigo WHERE $condicion");

$num=mysql_num_rows($consulta);

while($row=mysql_fetch_array($consulta)){
  $nombre=$row[pnom_usu].' '.$row[snom_usu].' '.$row[pape_usu].' '.$row[sape_usu];
  $archivo='resultados/'.$row[arch_lec];
  $iden_lec=$row[iden_lec];
  $iden_var=$row[iden_var];
  
	$bmed=mysql_query("SELECT deta_rips.iden_der, enca_rips.meds_ecr, enca_rips.fech_ecr, enca_rips.hora_ecr, enca_rips.meds_ecr, enca_rips.area_ecr
	FROM medicos INNER JOIN (deta_rips INNER JOIN enca_rips ON deta_rips.iden_ecr = enca_rips.iden_ecr) 
	WHERE (((deta_rips.iden_der)='$iden_var'))");
	while($rmed=mysql_fetch_array($bmed))
	{
		$medico=$rmed['nom_medi'];
		$fechatoma=$rmed['fech_ecr'];
		
	}  
  echo "<tr>";
  //if(!empty($row[arch_lec])){
    echo "<td class='Td0' align='left'><a href='imagen311.php?iden_lec=$iden_lec' target='blank'><img src='img/img2.JPG' alt='Lectura' width='15' height='15'></a></td>";
 // }
//  else{
//    echo "<td class='Td0' align='left'></td>";
//  }
  echo "<td class='Td0' align='left'>$row[nrod_usu]</td>";
  echo "<td class='Td0' align='left'>$nombre</td>";
  echo "<td class='Td0' align='left'>".cambiafechadmy($fechatoma)."</td>";
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
