<?
session_register('iden_fac');
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//include('php/funciones.php');
//include('php/conexion.php');

$archivo="tmp/af".$iden_qxf.$enti_fac.".txt";
$fp = fopen($archivo, 'w+');
$cadena="iden_ctr|$iden_ctr\n";
fwrite($fp, $cadena);
$cadena="tipo_fac|$tipo_fac\n";
fwrite($fp, $cadena);
$cadena="feci_fac|$feci_fac\n";
fwrite($fp, $cadena);
$cadena="fecf_fac|$fecf_fac\n";
fwrite($fp, $cadena);
$cadena="rela_fac|$rela_fac\n";
fwrite($fp, $cadena);
$cadena="codi_usu|$codi_usu\n";
fwrite($fp, $cadena);
$cadena="iden_ctr|$iden_ctr\n";
fwrite($fp, $cadena);
$cadena="cod_cie10|$cod_cie10\n";
fwrite($fp, $cadena);
$cadena="enti_fac|$enti_fac\n";
fwrite($fp, $cadena);
fclose($fp);

$archivo="tmp/qx".$iden_qxf.$enti_fac.".txt";
$fp = fopen($archivo, 'w+');
for($i=0;$i<$contc;$i++){
  $var="chkcir".$i;
  if($$var==on){
    $var="codigo".$i;
	$cadena="codigo|".$$var."\n";
	fwrite($fp, $cadena);
  }  
}
fclose($fp);
//mysql_close();
echo "<body onload='location.href=\"fac_3encab.php?iden_qxf=$iden_qxf\"'>";
?>

</body>
</html>