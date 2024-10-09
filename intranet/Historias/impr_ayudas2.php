<?
session_register('Gideusu');
session_register('id_ing');
?>


<html>
<HEAD>
<script languaje=havascript>
	

function changefocus(){

window.focus();

}

window.onload = changefocus;
window.onblur = changefocus;


</script>
	
</head>
<body>
<style>
.normal {
width: 80%;
border: 1px solid #888;
border-collapse: collapse;
}
.normal th, .normal td {
border: 1px solid #888;
empty-cells: inherit;

}
</style>
<?
	
	$anofac=substr($fecdia,0,4);
	$mesfac=substr($fecdia,5,2);
	$disfac=substr($fecdia,8,2);
	$fecha=$anofac.'/'.$mesfac.'/'.$disfac;
	echo"<form name='uno' method='post' action='impr_ayudas.php' target='TOP'>";
	$link=Mysql_connect("localhost","root","");
    if(!$link)echo"no hay conexion";
    Mysql_select_db('proinsalud',$link);
	
	$datos=mysql_query("SELECT usuario.CODI_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU
	FROM usuario
	WHERE (((usuario.CODI_USU)='$Gideusu'))");
	While($row10=mysql_fetch_array($datos))
	{
		$nombre=$row10['PNOM_USU'].' '.$row10['SNOM_USU'].' '.$row10['PAPE_USU'].' '.$row10	['SAPE_USU'];
		$cedu=$row10['NROD_USU'];		
	}
	echo"<br>
	<table align=center cellspacing=20>
	<tr>
	<td colspan=3 align=center><font size=3><b>RESULTADOS AYUDAS DIAGNOSTICAS $fecdia</td>
	
	</tr>
	<tr>
	<td><font size=2><b>$cedu</td>
	<td><font size=2><b>$nombre</td>	
	</tr>
	</table>
	<br>";
	
	echo"<table class='normal' align=center>";
	$imag2="SELECT lectura_imagen.codi_usu, lectura_imagen.fech_lec, lectura_imagen.lect_lec, cups.descrip
	FROM lectura_imagen INNER JOIN cups ON lectura_imagen.copr_lec = cups.codigo
	WHERE (((lectura_imagen.codi_usu)='$Gideusu') AND ((lectura_imagen.fech_lec)='$fecdia') AND ((lectura_imagen.esta_lec)='CU'))";	
	$imag=mysql_query($imag2);
	$n=0;	
	while($row=mysql_fetch_array($imag))
	{
		
		$nombcups=$row['descrip'];
		$lectura=$row['lect_lec'];
		echo"
		<tr>
		<td><font size=2>AYUDA DIAGNOSTICA</td>
		<td><font size=2><b>$nombcups</td></tr>
		<tr>
		<td><font size=2>LECTURA RADIOLOGO</td>
		<td><font size=2><b>$lectura</td>
		
		</tr>";
	}	
	echo"</table>";
	
?>
<body>
</html>