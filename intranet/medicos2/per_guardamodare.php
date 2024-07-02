<?
//Conexion con la base
include ('php/conexion.php');
//selección de la base de datos con la que vamos a trabajar 
echo $cod_areas;
mysql_query("UPDATE areas SET nom_areas='$nom_areas',tipo_areas='$tipo_areas',clas_areas='$clas_areas' WHERE cod_areas='$cod_areas'");
?>
<!-- Regresa a la pagina anterior -->
<HTML>
<head>
<title>Regresa a la página anterior</title>
<Script Language="JavaScript">
function cargar(form)
{
  per_guardamodare.submit()
}
</Script>
</head>
<body bgcolor='#E6E8FA' onload='javascript:cargar()'>
<form name='per_guardamodare' method='post' action='per_muestraare.php'>
  <input type='hidden' name='cod_areas' value='<?echo $cod_areas;?>'>
  <input type='hidden' name='orden' value='cod_areas'>
</form>
</body>
</HTML>
