<?
//Conexion con la base
include ('php/conexion.php');
//selección de la base de datos con la que vamos a trabajar 
if($esta_medi=='A'){
  mysql_query("UPDATE medicos SET esta_medi='I' WHERE cod_medi=$cod_medi");}
else{
  mysql_query("UPDATE medicos SET esta_medi='A' WHERE cod_medi=$cod_medi");}
?>
<!-- Regresa a la pagina anterior -->
<HTML>
<head>
<title>Regresa a la página anterior</title>
<Script Language="JavaScript">
function cargar(form)
{
  per_estamed.submit()
}
</Script>
</head>
<body bgcolor='#E6E8FA' onload='javascript:cargar()'>
<form name='per_estamed' method='post' action='per_muestraper.php'>
  <input type='hidden' name='cod_medi' value='<?echo $cod_medi;?>'>
  <input type='hidden' name='orden' value='cod_medi'>
</form>
</body>
</HTML>
