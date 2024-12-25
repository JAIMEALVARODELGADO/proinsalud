<?php
session_start();
include('php/conexion.php');
include('php/funciones.php');

//Aqui consulto los datos del usuario
$consulta="SELECT idusu_citas,cotra_citas FROM citas WHERE id_cita='$_SESSION[id_cita]'";
//echo $consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);

//Aqui consulto la historia para tomar la historia inicial
$consultahis="SELECT iden_this FROM ter_historia WHERE codi_usu='$row[idusu_citas]' and esta_this='A'";
echo "<br>".$consultahis;
$consultahis=mysql_query($consultahis);
$rowhis=mysql_fetch_array($consultahis);

$fecha_=cambiafecha(hoy());
$sql_="INSERT INTO ter_control(iden_tcon,iden_this,evolu_tcon,obser_tcon,codmedi_tcon,proced_tcon)
VALUES(0,'$rowhis[iden_this]','$evolu_','$obser_','$_SESSION[ter_codmedi]','$proced_')";
//echo "<br>".$sql_;
mysql_query($sql_);
$sql_="UPDATE citas SET esta_cita='2' WHERE id_cita='$_SESSION[id_cita]'";
mysql_query($sql_);
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