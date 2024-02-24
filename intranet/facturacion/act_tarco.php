<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />

</head>
<body>
<form name='form1' method="POST" action='fac_4heguardacon.php' target='fr02'>
<?
include('php/conexion.php');
include('php/funciones.php');
$consulta=mysql_query("SELECT iden_tco,iden_map,clas_tco FROM tarco WHERE clas_tco=''");
while($row=mysql_fetch_array($consulta)){
  $consultamed=mysql_query("SELECT codi_mdi FROM medicamentos2 WHERE codi_mdi='$row[iden_map]'");
  if(mysql_num_rows($consultamed)<>0){
    mysql_query("UPDATE tarco SET clas_tco='M' WHERE iden_tco=$row[iden_tco]");
  }
  else{
    mysql_query("UPDATE tarco SET clas_tco='I' WHERE iden_tco=$row[iden_tco]");
  }
}
?>

</form>
</body>
</html>
