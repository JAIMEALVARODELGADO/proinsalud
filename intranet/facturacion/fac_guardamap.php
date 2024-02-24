<?
include('php/conexion.php');
mysql_query("UPDATE medicos SET mapip_med=$mapip_med,mapic_med=$mapic_med WHERE cod_medi='$cod_medi'");
?>
<html>
<head>
<title></title>
</head>
<script language='javascript'>
function regresar(){
  window.open("fac_muesmedic.php?cod_medi='<?echo $cod_medi;?>'","fr02");
}
</script>
<body onload='regresar()'>
</body>
</html>
