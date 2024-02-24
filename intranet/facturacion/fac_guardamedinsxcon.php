<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/funciones.php');
include('php/conexion.php');
for($i=0;$i<$cont;$i++){
  $nomvar='chkser'.$i;
  if($$nomvar=='on'){
    $ser_='codigoser'.$i;
	$val_='valor'.$i;
	$tser_='tser'.$i;
	$insert="INSERT INTO tarco(iden_tco,iden_map,iden_ctr,tser_tco,clas_tco,valo_tco,grqx_tco)
	values(0,'".$$ser_."',";
	$insert=$insert.$iden_ctr.',';
	$insert=$insert."'".$$tser_."',";
	$insert=$insert."'$claseser',";
	$insert=$insert.$$val_.",'')";
	//echo "<br>".$insert;
	mysql_query($insert);
  }
}
mysql_close();
echo "<body onload='location.href=\"fac_creamedinsxcon.php?iden_ctr=$iden_ctr\"'>";
?>
</body>
</html>