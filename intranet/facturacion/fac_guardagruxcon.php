<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/funciones.php');
include('php/conexion.php');
for($cont=0;$cont<$numact;$cont++){
  $var='codi_'.$cont;
  if(!empty($$var)){
	$guarda="INSERT INTO grupoxcont(iden_gxc,iden_ctr,iden_gqx,desc_gxc,valo_gxc) values(0,";
	$guarda=$guarda.$iden_ctr.',';
	$var='codi_'.$cont;
	$guarda=$guarda."'".$$var."',";
	
	
	$var="desc_gxc".$cont;
	$guarda=$guarda."'".$$var."',";
	$var='valo_gxc'.$cont;
	$guarda=$guarda."'".$$var."'";
	$guarda=$guarda.')';
	echo "<br>".$guarda;
	mysql_query($guarda);
  }
}
mysql_close();
//echo $iden_ctr;
echo "<body onload='location.href=\"fac_muesccion.php?codi_con=$codi_con\"'>";

?>

</body>
</html>