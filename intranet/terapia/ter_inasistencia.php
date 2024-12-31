<?php
include('php/conexion.php');
include('php/funciones.php');

echo "<br>".$tipo_inasistencia;
echo "<br>".$iden_cita;
echo "<br>".$resumen;
//Aqui cambio el estado de la cita
$sql_="UPDATE citas SET esta_cita='4' WHERE id_cita='$iden_cita'";
echo $sql_;
//mysql_query($sql_);
?>
<html>
<head>
    <title>Terapia</title>
<script language="JavaScript">
    function cargar(){
        window.open('ter_citados.php','fr02');
        //alert();
    }
</script>
</head>
<body onload='cargar_()'>

</body>
</html>


