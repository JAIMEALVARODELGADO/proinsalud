<?
//Conexion con la base
include ('php/conexion.php');
//selección de la base de datos con la que vamos a trabajar 
if($esta_ar=='A'){
  mysql_query("UPDATE areas_medic SET esta_ar='I' WHERE cod_ar=$cod_ar");}
else{
  mysql_query("UPDATE areas_medic SET esta_ar='A' WHERE cod_ar=$cod_ar");}
?>
<!-- Regresa a la pagina anterior -->
<HTML>
<head>
<title>Regresa a la página anterior</title>
<Script Language="JavaScript">
function cargar(form)
{
  per_estarexmed.submit()
}
</Script>
</head>
<body bgcolor='#E6E8FA' onload='javascript:cargar()'>
<form name='per_estarexmed' method='post' action='per_muesaremed.php'>
  <input type='hidden' name='cod_medi' value='<?echo $cod_medi;?>'>
</form>
</body>
</HTML>
