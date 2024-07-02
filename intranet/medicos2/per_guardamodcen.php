<?
//Conexion con la base
include ('php/conexion.php');
//selección de la base de datos con la que vamos a trabajar 
echo $codc_cco;
mysql_query("UPDATE centro_costo SET codc_cco='$codc_cco',nomb_cco='$nomb_cco',clas_cco='$clas_cco',esta_cco='$esta_cco' WHERE codi_cco=$codi_cco");
?>
<!-- Regresa a la pagina anterior -->
<HTML>
<head>
<title>Regresa a la página anterior</title>
<Script Language="JavaScript">
function cargar(form)
{
  per_guardamodcen.submit()
}
</Script>
</head>
<body bgcolor='#E6E8FA' onload='javascript:cargar()'>
<form name='per_guardamodcen' method='post' action='per_muestracen.php'>
  <input type='hidden' name='codi_cco' value='<?echo $codi_cco;?>'>
  <input type='hidden' name='orden' value='codi_cco'>
</form>
</body>
</HTML>
