<?php
session_start();
include('php/conexion.php');
?>
<html>
<head>
    <link rel="stylesheet" href="css/estilo_2.css">
</head>
<body bgcolor="#AAC1E9">
<br>
<?php
//echo $_SESSION[ter_codmedi];
$consmed="SELECT nom_medi FROM medicos WHERE cod_medi='$_SESSION[ter_codmedi]'";
//echo $consmed;
$consmed=mysql_query($consmed);
$rowmed=mysql_fetch_array($consmed);
echo "Usuario:";
echo "<br>".$rowmed[nom_medi];
echo "<br><br>";

?>
<a href='ter_inf_tf_param_atendidos.php' target='fr04' class='btnmenu'>Inf. Pacientes Atendidos</a>
<br><br><br><a href='ter_citados.php' target='fr02' class='btnmenu'>Salir</a>
</body>
</html>