<?php
session_start();
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
include('php/funciones.php');
include('php/conexion.php');
for($cont=0;$cont<$numact;$cont++){
  $var='codi_'.$cont;
  if(!empty($$var)){
    //echo $$var;
	$guarda="INSERT INTO tarco(iden_tco,iden_map,iden_ctr,tser_tco,clas_tco,valo_tco,grqx_tco,esta_tco) values(0,".$$var.",";
	$guarda=$guarda.$_SESSION['giden_ctr'].',';
	$var="tser_".$cont;
	$guarda=$guarda."'".$$var."','P',";
	$var="valor_".$cont;
	$guarda=$guarda."'".$$var."',";
	$var='grqx_'.$cont;
	$guarda=$guarda."'".$$var."',";
	$guarda=$guarda."'AC'";
	$guarda=$guarda.')';
	//echo "<br>".$guarda;
	mysql_query($guarda);
  }
}
mysql_close();
//echo $iden_ctr;
echo "<body onload='location.href=\"fac_muesccion.php?codi_con=$codi_con\"'>";
?>
</body>
</html>