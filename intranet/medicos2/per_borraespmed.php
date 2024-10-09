<HTML>
<head>
<title>Regresa a la página anterior</title>
</head>

<Script Language="JavaScript">
  function cargar(form)
  {
    document.form1.submit()
  }

</Script>

<?php
//Conexion con la base
include ('php/conexion.php');
$sql="DELETE FROM medico_especialidad WHERE id_mesp='$id_mesp'";
//echo $sql;
mysql_query($sql);
regresar($cod_medi);
?>
</HTML>

<?php
function regresar($cod_){
?>
<body bgcolor='#E6E8FA' onload='javascript:cargar()'>
<form name='form1' method='post' action='per_muesaremed.php'>
  <input type='hidden' name='cod_medi' value='<?echo $cod_;?>'>
</form>
</body>
<?php
}
?>