<!-- Muestra la información básica del usuario cuando es encontrado.-->
<html>
<head><title>Consulta de Epicrisis</title>

<SCRIPT LANGUAGE=JavaScript>
function validar2(){
window.open("dar_cita.php","fr2")
}
</SCRIPT>


<?
//Aqui cargo las funciones
include("funciones.php");
?>
</head>
<body>
<table width =100% align="center" border=0 cellpadding="0" cellspacing="1">
<tr>
  <td bgcolor='#0033FF' align='center'><font size=2 color='#ffffff'><b>IMAGENEOLOGIA</font></td>
</tr>
</table>
<br>
<?
include ('php/conexion2.php');
$consulta=mysql_query("SELECT  lectura_imagen.iden_lec, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, lectura_imagen.fech_lec, lectura_imagen.lect_lec, 
lectura_imagen.esta_lec, destipos.nomb_des, cups.descrip
FROM (destipos INNER JOIN (lectura_imagen INNER JOIN usuario ON lectura_imagen.codi_usu = usuario.CODI_USU) ON destipos.codi_des = lectura_imagen.arso_lec) INNER JOIN cups ON lectura_imagen.copr_lec = cups.codigo
WHERE (((usuario.NROD_USU)='$identificacion'))
ORDER BY lectura_imagen.fech_lec DESC;");

if(mysql_num_rows($consulta)==0){
   echo "<h2>Usuario no tiene registros de imageneología</h2>";
}
else{  
  $a=0;
  while($row=mysql_fetch_array($consulta)){
    $nombre=$row[PNOM_USU].' '.$row[SNOM_USU].' '.$row[PAPE_USU].' '.$row[SAPE_USU];
	$regis=$row[iden_lec];
	$fechal=$row[fech_lec];
	$lectura=$row[lect_lec];
	$estado=$row[esta_lec];
	$solici=$row[nomb_des];
	$descripcion=$row[descrip];
	
	if($a==0)
	{
		echo "<Table border=1 BgColor=#DFDFDF BorderColor=#E6E8FA width=100% align=center cellpadding=0 Cellspacing=0>";
		echo "<tr>";
		echo "<td>$identificacion  -  $nombre</td>";
		echo "</tr>";
		echo "</table>";
		echo "</br>";
		echo "<Table border=1 BgColor=#DFDFDF BorderColor=#E6E8FA width=100% align=center cellpadding=10 Cellspacing=0>";
		echo "<tr>";
		echo "<th>Opciones</th><th>Fecha</th><th>Nombre</th><th>Area</th><th>Estado</th>";
		echo "</tr>";
	}
	echo "<tr>";
    echo "<td bgcolor='#ffffff' align='center'><a href='his_imagen3.php?iden_lec=$regis'><img src='img/32px-Crystal_Clear_action_fileprint.png' height='25' width='25' alt='Visualizar' border=0></a></td>";
	echo "<td bgcolor='#ffffff'><font size=2>".cambiafechadmy($row[fech_lec])."</font></td>";
	echo "<td bgcolor='#ffffff'><font size=2>".$row[descrip]."</font></td>";
	echo "<td bgcolor='#ffffff'><font size=2>".$row[nomb_des]."</font></td>";	
	echo "<td bgcolor='#ffffff'>".$row[esta_lec]."</td>";	
	echo "</tr>";
	$a=$a+1;
  }
  echo "</table>";
}
?>
</body>
</html>