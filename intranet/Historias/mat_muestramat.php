<html>
<head>
<title>Maternas</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 
<!-- librer?a principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<!-- librer?a para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<!-- librer?a que declara la funci?n Calendar.setup, que ayuda a generar un calendario en unas pocas l?neas de c?digo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<SCRIPT LANGUAGE=JavaScript>
function verificar(){
	form1.submit();}
</script>
</head>
<form name="form1" method="POST" action="mat_muestramat.php" target='fr04'>
<body>
 <table class="Tbl0">
   <tr><td class='Td1' align='center'>Listado de Maternas</td></tr>
 </table>
 
 <?
	include('php/conexion.php');
    base_proinsalud();
$condicion="";
if(!empty($nrod_usu)){
	$condicion=$condicion."usu.nrod_usu='$nrod_usu' AND ";
}
if(!empty($codi_con)){
	$condicion=$condicion."con.codi_con='$codi_con' AND ";
}
if(!empty($condicion)){
	$condicion=substr($condicion,0,(strlen($condicion)-5));
}
$conmat="SELECT mat.iden_mat,mat.fing_mat,usu.nrod_usu,concat(usu.pnom_usu,' ',snom_usu,' ',pape_usu,' ',sape_usu) AS nombre,
			con.neps_con
			FROM materna AS mat
			INNER JOIN usuario AS usu ON usu.codi_usu=mat.codi_usu
			INNER JOIN contrato AS con ON con.codi_con=mat.cont_mat";
$conmat=$conmat." WHERE ".$condicion." ORDER BY nombre";
$conmat=mysql_query($conmat);	
if(mysql_num_rows($conmat)<>0){
	echo "<table class='Tbl0' border='0'>";
	echo "<tr>
		<th class='Th0' align='center'><b>Opc</th>
		<th class='Th0' align='center'><b>Identificacion</th>
		<th class='Th0' align='center'><b>Nombre</th>
		<th class='Th0' align='center'><b>Contrato</th>
		<th class='Th0' align='center'><b>F.Ingreso Prog.</th>";
	echo "</tr>";
	while($rowmat=mysql_fetch_array($conmat)){
		echo "<tr>";
		echo "<td><a href='../hcmpv2/consultas_mat2.php?iden_mat=$rowmat[iden_mat]'><img src='img/feed_go.png' alt='Consultas de la Materna'></a></td>";
		echo "<td>$rowmat[nrod_usu]</td>";
		echo "<td>$rowmat[nombre]</td>";
		echo "<td>$rowmat[neps_con]</td>";
		echo "<td>$rowmat[fing_mat]</td>";
		echo "</tr>";
	}
	echo "</table>";
}
else{
	echo "<br><br><br><br><br>";
	echo "<center>No hay maternas registradas con estos parámetros</center>";
}			
mysql_free_result($conmat);
mysql_close();
 ?>		
</form>
</body>
</html>