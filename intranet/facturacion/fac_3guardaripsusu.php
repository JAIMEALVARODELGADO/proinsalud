<?php
session_start();
set_time_limit(60);
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function regresar(){
  window.open("fac_3muestraripsusua.php","fr02") 
}
</script>
</head>
<?php
include('php/conexion.php');
//include('php/funciones.php');


$consultausu="SELECT usu.tipodocumento ,usu.numdocumento FROM nrusuario usu
WHERE id_usuario='$id_usuario'";
//echo $consultausu;
$consultausu=mysql_query($consultausu);
$rowusu=mysql_fetch_array($consultausu);

$actualiza="UPDATE nrusuario SET id_usuario='$id_usuario',";
$actualiza=$actualiza."tipodocumento='$tipodocumento',";
$actualiza=$actualiza."numdocumento='$numdocumento',";
$actualiza=$actualiza."tipousuario='$tipousuario',";
$actualiza=$actualiza."fechanacimiento='$fechanacimiento',";
$actualiza=$actualiza."codsexo='$codsexo',";
$actualiza=$actualiza."codpaisresidencia='$codpaisresidencia',";
$actualiza=$actualiza."codmunicipioresidencia='$codmunicipioresidencia',";
$actualiza=$actualiza."codzonaresidencia='$codzonaresidencia',";
$actualiza=$actualiza."incapacidad='$incapacidad',";
$actualiza=$actualiza."codpaisorigen='$codpaisorigen'";
$actualiza=$actualiza." WHERE id_usuario='$id_usuario'";
//echo "<br>".$actualiza;
mysql_query($actualiza);

//aqui actualizo el tipo de documento y el número en las otras tablas de rips
if($rowusu[tipodocumento] <> $tipodocumento or $rowusu[numdocumento] <> $numdocumento){
    $actualiza="UPDATE nrconsulta SET tipodocumentoidentificacion='$tipodocumento'
    ,numdocumentoidentificacion='$numdocumento'
    WHERE iden_fac='$giden_fac'";
    //echo "<br>".$actualiza;
    mysql_query($actualiza);

    $actualiza="UPDATE nrprocedimiento SET tipodocumentoidentificacion='$tipodocumento'
    ,numdocumentoidentificacion='$numdocumento'
    WHERE iden_fac='$giden_fac'";
    //echo "<br>".$actualiza;
    mysql_query($actualiza);

    $actualiza="UPDATE nrmedicamento SET tipodocumentoidentificacion='$tipodocumento'
    ,numdocumentoidentificacion='$numdocumento'
    WHERE iden_fac='$giden_fac'";
    //echo "<br>".$actualiza;
    mysql_query($actualiza);

    $actualiza="UPDATE nrotroservicios SET tipodocumentoidentificacion='$tipodocumento'
    ,numdocumentoidentificacion='$numdocumento'
    WHERE iden_fac='$giden_fac'";
    //echo "<br>".$actualiza;
    mysql_query($actualiza);
}

mysql_free_result($consultausu);
mysql_close();
?>
<body onload='regresar()'>
</body>
</html>
