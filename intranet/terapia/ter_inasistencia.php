<?php
session_start();

include('php/conexion.php');
include('php/funciones.php');

/*echo "<br>".$tipo_inasistencia;
echo "<br>".$iden_cita;
echo "<br>".$resumen;
echo "<br>".$_SESSION[ter_codmedi_cit];*/
//Aqui cambio el estado de la cita
$sql_="UPDATE citas SET esta_cita='4' WHERE id_cita='$iden_cita'";
//echo $sql_;
mysql_query($sql_);

$consultahis="SELECT th.iden_this FROM ter_historia th
WHERE th.codi_usu =
(SELECT c.Idusu_citas FROM citas c
WHERE c.id_cita ='$iden_cita')
AND esta_this ='A'";
//echo "<br>".$consultahis;

$consultahis=mysql_query($consultahis);
//echo "<br>encontrados".mysql_num_rows($consultahis)
if(mysql_num_rows($consultahis)<>0){
    $row=mysql_fetch_array($consultahis);
    $fecha_tcon=cambiafecha(hoy());
    //Aqui se crea la historia de control para el cierre
    $sql_="INSERT INTO ter_control(iden_this,fecha_tcon,evolu_tcon,obser_tcon,codmedi_tcon,proced_tcon,fin_historia_tcon,resumen_tcon)
        VALUES('$row[iden_this]','$fecha_tcon','','','$_SESSION[ter_codmedi_cit]','','S','$resumen')";
    //echo "<br>".$sql_;
    mysql_query($sql_);

    //Aqui se cierra la historia de primera vez
    $sql_="UPDATE ter_historia SET esta_this='C' WHERE iden_this='$row[iden_this]'";
    //echo "<br>".$sql_;
    mysql_query($sql_); 
}




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
<body onload='cargar()'>

</body>
</html>


