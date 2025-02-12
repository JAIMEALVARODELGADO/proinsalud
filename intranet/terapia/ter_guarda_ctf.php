<?php
session_start();
include('php/conexion.php');
include('php/funciones.php');

//Aqui consulto los datos del usuario
$consulta="SELECT idusu_citas,cotra_citas FROM citas WHERE id_cita='$_SESSION[id_cita]'";
//echo $consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);

$fecha_=cambiafecha(hoy());

//echo $fin_historia;
//echo "<br>".$resumen;
$fin_historia_tcon="N";
if($fin_historia=='on'){
    $fin_historia_tcon='S';
    $sql_tf="UPDATE ter_historia SET esta_this='C' WHERE iden_this='$rowhis[iden_this]'";
    mysql_query($sql_tf);
}

$sql_="INSERT INTO ter_control(iden_tcon,iden_this,evolu_tcon,obser_tcon,codmedi_tcon,proced_tcon,fin_historia_tcon,resumen_tcon)
VALUES(0,'$iden_this','$evolu_','$obser_','$_SESSION[ter_codmedi]','$proced_','$fin_historia_tcon','$resumen')";
//echo "<br>".$sql_;
mysql_query($sql_);

$sql_="UPDATE citas SET esta_cita='2' WHERE id_cita='$_SESSION[id_cita]'";
//echo $sql_;
//mysql_query($sql_);
?>
<html>
<head>
    <title>Terapia</title>
    <script language="JavaScript">
    function cargar(id_){
        if(confirm("Desea imprimir la historia con el último control?")){
            var url='ter_impretf.php?iden_this='+id_+'&ultimocontrol=1'
            window.open(url);
        }
        window.open('ter_citados.php','fr02');
    }
</script>
</head>
<body onload="cargar('<?php echo $iden_this?>')">

</body>
</html>