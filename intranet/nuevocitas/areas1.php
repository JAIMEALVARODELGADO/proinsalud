<?
session_start();
$usucitas=$_SESSION['usucitas'];
$areatra=$_SESSION['areatra'];
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
function salir()
{
	uno.target='';
	uno.action='areas0.php';
	uno.submit();
} 
</script>
</head>
<?	    
    include ('php/conexion1.php');
	$existe=0;
	IF(strlen($codigo)<4)$existe=1;
	$codnuevare=substr($codigo,6,3);	
	echo"<form name=uno method=post>";
	$bucodar=mysql_query("SELECT * from areas WHERE cod_areas = '$codnuevare' ORDER BY cod_areas");
	if(mysql_num_rows($bucodar)>0)$existe=2;
	$bucodar=mysql_query("SELECT * from areas WHERE nom_areas = '$narean' ORDER BY cod_areas");
	if(mysql_num_rows($bucodar)>0)$existe=3;
	$tok = strtok ($grusiigo,"-");
	$n=0;	
	while ($tok) 
	{		
		$vec[$n]=$tok;
		$tok = strtok ("-");
		$n++;	
	}
	$codsiigo=$vec[0];
	$nomsiigo=$vec[1];
	if($existe==0)
	{
		mysql_query("insert into areas (cod_areas, nom_areas, perm_are, tipo_areas, clas_areas, csii_area, nsii_area, arci_area, cidi_area, esta_area, grup_area, equi_area,muni_area) 
		values('$codnuevare', '$narean', '', '1', 'I', '$codsiigo', '$nomsiigo', '$grupocita', '', '', '$unifuncional','$areaprin','$municipio')");
		echo"<body onload='salir()'>
		</body>";
	}
	else
	{	
		if($existe==1)$mensa="CODIGO DE AREA MAL DIGITADO";
		if($existe==2)$mensa="CODIGO DE AREA YA EXISTE";
		if($existe==3)$mensa="NOMBRE DE AREA YA EXISTE";
		echo"
		<body>
		<table align=center class='tbl'>
		<tr>
		<th>ERROR AL CREAR AREA</td>
		</tr>
		<tr>
		<td align=center>$mensa</td>
		</tr>
		<tr>
		<td align=center><input type=button class=boton value='ACEPTAR' onclick=salir()></td>
		</tr>
		<table>
		</body>";		
	}
	echo "</form>";
    
?>

</html>