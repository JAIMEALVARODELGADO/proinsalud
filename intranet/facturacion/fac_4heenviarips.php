<?
session_start();
session_register('gfactura');
session_register('giden_fac');
$gfactura=$factura;
$giden_fac=$iden_fac;
//echo "<br>".$iden_fac;
//echo "<br>".$factura;
//echo "<br>".$cpt;
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function envia(scrip_){
var url=scrip_;
  window.open(url,"fr02") 
}
</script>
</head>
<body>
<?
switch($cpt){
	case 'AF';
		?><script language='javascript'>envia('fac_4hemuestracons.php')</script><?;
		break;
	case 'AC';
		?><script language='javascript'>envia('fac_4hemuestracons.php')</script><?;
		break;
	case 'AP';
		?><script language='javascript'>envia('fac_4hemuestraproc.php')</script><?;
		break;
	case 'AM';
		?><script language='javascript'>envia('fac_4hemuestramedi.php')</script><?;
		break;
	case 'AT';
		?><script language='javascript'>envia('fac_4hemuestraotro.php')</script><?;
		break;
	case 'AU';
		?><script language='javascript'>envia('fac_4hemuestraurge.php')</script><?;
		break;
	case 'AH';
		?><script language='javascript'>envia('fac_4hemuestrahosp.php')</script><?;
		break;
	case 'AN';
		?><script language='javascript'>envia('fac_4hemuestrarnac.php')</script><?;
		break;
	
}
?>
</body>
</html>
