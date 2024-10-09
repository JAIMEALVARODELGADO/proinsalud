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
$sql_="INSERT INTO tres_historia(iden_tre,codi_usu,cont_tre,tipo_tre,antper_tre,ayudxant_tre,descayu_tre,dxprinc_tre,tpdxpr_tre,cexter_tre,ambit_tre,fcard_tre,fres_tre,satur_tre,eval_tre,sesion_tre,tratam_tre,obse_tre,resp_tre,codmedi_tre,esta_tre)
values(0,'$row[idusu_citas]','$row[cotra_citas]','$tipo_','$antper_','$ayudxant_','$descayu_','$dxprinc_','$tpdxpr_','$cexter_','$ambit_','$fcard_','$fres_','$satur_','$eval_','$sesion_','$tratam_','$obse_','$resp_','$_SESSION[ter_codmedi]','A')";
$sql_=mysql_query($sql_);
$iden_tre=mysql_insert_id($sql_);
if($dxrela1_<>""){
    $sql_="INSERT INTO tres_dxhistoria(iden_trdxh,iden_tre,dxrel_trdxh) VALUES (0,'$iden_tre','$dxrela1_')";
    mysql_query($sql_);
}
if($dxrela2_<>""){
    $sql_="INSERT INTO tres_dxhistoria(iden_trdxh,iden_tre,dxrel_trdxh) VALUES (0,'$iden_tre','$dxrela2_')";
    mysql_query($sql_);
}
if($dxrela3_<>""){
    $sql_="INSERT INTO tres_dxhistoria(iden_trdxh,iden_tre,dxrel_trdxh) VALUES (0,'$iden_tre','$dxrela3_')";
    mysql_query($sql_);
}

mysql_query($sql_);

if(empty($_SESSION[asol_ref])){
    $sql_="UPDATE citas SET esta_cita='2' WHERE id_cita='$_SESSION[id_cita]'";
}
else{
    $sql_="UPDATE detareferencia SET marc_dre='1404' WHERE iden_dre='$_SESSION[id_cita]'";
}
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


