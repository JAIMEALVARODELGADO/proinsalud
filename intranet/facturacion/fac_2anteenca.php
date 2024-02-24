<?
session_start();
session_register('giden');
session_register('genti');
session_register('gtipo_fac');
session_register('grela_fac');
session_register('gfeci_fac');
session_register('gfecf_fac');
//session_register('gcotr');

include('php/funciones.php');

$giden=$iden;
$genti=$enti;
$gfeci_fac=hoy();
$gfecf_fac=hoy();
//$gcotr=$cotr;
?>
<html>
<head>
</head>
<body onload="location.href='fac_2encapre.php'">
</body>
</html>