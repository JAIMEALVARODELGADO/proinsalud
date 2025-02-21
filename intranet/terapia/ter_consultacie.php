<?php
//Conexion con la base
include ('php/conexion.php');

$cod_cie = $_POST['codigo_cie'];

$sql = "SELECT cie.nom_cie10 FROM cie_10 AS cie
	WHERE cie.cod_cie10 = '$cod_cie'";
//echo $sql;
$consultacie=mysql_query($sql);
if($row=mysql_fetch_array($consultacie)){
    echo $row['nom_cie10'];
}
else{
    echo "No existe el codigo CIE-10";
}

?>
