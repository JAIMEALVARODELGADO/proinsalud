<!-- Programa que actualiza informacion de insumos-->
<html>
<head>
<?
//Aqui cargo las funciones de validacin de fechas
include("php/funciones.php");
?>
<title>Actualiza Insumos</title>
</head>
<body bgcolor="#E6E8FA">
<?
$iden_ctr=152;

mysql_connect("localhost","root","");
//seleccin de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud");
$consulta="SELECT tar.iden_tco,tar.iden_map,tar.valo_tco,map.soat_map,map.iden_map,map.valsoa_map
FROM tarco AS tar 
INNER JOIN mapii AS map ON map.iden_map=tar.iden_map
WHERE soat_map<>'' and valo_tco<>0 and tar.clas_tco='P' and tar.iden_ctr='152'";
echo $consulta;
$consulta=mysql_query($consulta);
echo "<table>";
while($row=mysql_fetch_array($consulta)){
	echo "<tr>";
	echo "<td>".$row[iden_tco]."</td>";
	echo "<td>".$row[soat_map]."</td>";
	echo "<td>".$row[valo_tco]."</td>";
	echo "<td>".$row[valsoa_map]."</td>";
	$sql="UPDATE tarco SET valo_tco=$row[valsoa_map] WHERE iden_tco=$row[iden_tco]";	
	//echo "<td>".$sql."</td>";
	mysql_query($sql);
	echo "</tr>";
}
echo "</table>";
mysql_close();
?>


</body>
</html>