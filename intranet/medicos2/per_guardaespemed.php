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

<?php

//Conexion con la base
include ('php/conexion.php');
//selección de la base de datos con la que vamos a trabajar 
$consulta="SELECT id_mesp FROM medico_especialidad WHERE cod_medi='$cod_medi' and espe_medi='$espe_medi'";
//echo $consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)<>0){
  $mensaje="El médico ya registra esta especialidad";
  regresarnuevo($cod_medi,$espe_medi,$mensaje);}
else{
  mysql_query("INSERT INTO medico_especialidad(cod_medi,espe_medi) VALUES ('$cod_medi','$espe_medi')");
  regresarnuevo2($cod_medi);}
?>
</HTML>

<?php
function regresarnuevo($cod_,$car_,$men_){
?>
  <body bgcolor='#E6E8FA' onload='javascript:cargar()'>
  <form name='per_regresamed' method='post' action='per_nuevaespemed.php'>
    <input type='hidden' name='cod_medi' value='<?echo $cod_;?>'>
	<input type='hidden' name='areas_ar' value='<?echo $car_;?>'>
	<input type='hidden' name='mensaje' value='<?echo $men_;?>'>
  </form>
  </body>
<?php
}

function regresarnuevo2($cod_){
?>
<body bgcolor='#E6E8FA' onload='javascript:cargar2()'>
<form name='per_guardaarexmed' method='post' action='per_muesaremed.php'>
  <input type='hidden' name='cod_medi' value='<?echo $cod_;?>'>
</form>
</body>
<?php
}
?>