<HTML>
<head>
<title>Regresa a la página anterior</title>
</head>

<Script Language="JavaScript">
  function cargar(form)
  {
    per_regresamed.submit()
  }

  function cargar2(form)
  {
    per_guardaarexmed.submit()
  }  
</Script>

<?

//Conexion con la base
include ('php/conexion.php');
//selección de la base de datos con la que vamos a trabajar 
$consulta=mysql_query("SELECT cod_ar FROM areas_medic WHERE cod_med_ar=$cod_medi and areas_ar=$areas_ar");
if(mysql_num_rows($consulta)<>0){
  $mensaje="El médico ya esta incluido en esta area";
  regresarnuevo($cod_medi,$areas_ar,$mensaje);}
else{
  mysql_query("INSERT INTO areas_medic (areas_ar,cod_med_ar,cod_ar,esta_ar) VALUES ('$areas_ar','$cod_medi',0,'A')");
  
  regresarnuevo2($cod_medi);}
?>
</HTML>

<?
function regresarnuevo($cod_,$car_,$men_){
?>
  <body bgcolor='#E6E8FA' onload='javascript:cargar()'>
  <form name='per_regresamed' method='post' action='per_nuevaarexmed.php'>
    <input type='hidden' name='cod_medi' value='<?echo $cod_;?>'>
	<input type='hidden' name='areas_ar' value='<?echo $car_;?>'>
	<input type='hidden' name='mensaje' value='<?echo $men_;?>'>
  </form>
  </body>
<?
}

function regresarnuevo2($cod_){
?>
<body bgcolor='#E6E8FA' onload='javascript:cargar2()'>
<form name='per_guardaarexmed' method='post' action='per_muesaremed.php'>
  <input type='hidden' name='cod_medi' value='<?echo $cod_;?>'>
</form>
</body>
<?
}
?>