<html>
<head>
	<title>FACTURACION</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<?
  include('php/conexion.php');
  include('php/funciones.php');
  $consultaef="SELECT nume_fac FROM encabezado_factura WHERE iden_fac=$iden_fac";
  //echo "<br>".$consultaef;
  $consultaef=mysql_query($consultaef);
  $rowef=mysql_fetch_array($consultaef);
  $nume_fac=$rowef[nume_fac];
  //echo "<br>".$relacion;
  //echo "<br>".$iden_fac;
  $sql="UPDATE encabezado_factura SET rela_fac='$relacion' WHERE iden_fac=$iden_fac";
  //echo "<br>".$sql;
  mysql_query($sql);
  mysql_close();
?>
<body onload='form1.submit()'>
<form name="form1" method="POST" action="fac_3lisfacanu.php">
<input type='hidden' name='num_fac' value='<?echo $nume_fac;?>'>
</form>
</body>
</html>