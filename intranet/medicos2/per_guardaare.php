<HTML>
<head>
<title>Regresa a la página anterior</title>
</head>

<Script Language="JavaScript">
  function cargar(form)
  {
    per_regresaare.submit()
  }

  function cargar2(form)
  {
    per_guardaare.submit()
  }  
</Script>
  
<?
//Conexion con la base
include ('php/conexion.php');
//selección de la base de datos con la que vamos a trabajar 
$consulta=mysql_query("SELECT cod_areas FROM areas WHERE cod_areas=$cod_areas");
if(mysql_num_rows($consulta)<>0){
  $mensaje="Código Duplicado";
  regresarnuevo($cod_areas,$nom_areas,$tipo_areas,$clas_areas,$mensaje);}
else{
  mysql_query("INSERT INTO areas (cod_areas,nom_areas,tipo_areas,clas_areas) VALUES ('$cod_areas','$nom_areas','$tipo_areas','$clas_areas')");
  regresarnuevo2($cod_areas);}
?>

</HTML>


<?
function regresarnuevo($cod_,$nom_,$tip_,$cla_,$men_){
?>
  <body bgcolor='#E6E8FA' onload='javascript:cargar()'>
  <form name='per_regresaare' method='post' action='per_nuevoare.php'>
    <input type='hidden' name='cod_areas' value='<?echo $cod_;?>'>
	<input type='hidden' name='nom_areas' value='<?echo $nom_;?>'>
	<input type='hidden' name='tipo_areas' value='<?echo $tip_;?>'>
	<input type='hidden' name='clas_areas' value='<?echo $cla_;?>'>
	<input type='hidden' name='mensaje' value='<?echo $men_;?>'>
  </form>
  </body>
<?
}

function regresarnuevo2($cod_){
?>
<body bgcolor='#E6E8FA' onload='javascript:cargar2()'>
<form name='per_guardaare' method='post' action='per_muestraare.php'>
  <input type='text' name='cod_areas' value='<?echo $cod_;?>'>
  <input type='hidden' name='orden' value='cod_areas'>
</form>
</body>
<?
}
?>


