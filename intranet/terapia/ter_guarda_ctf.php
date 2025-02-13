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
$sql_tf="";
$fin_historia_tcon="N";
if($fin_historia=='1'){
    $fin_historia_tcon='S';
    $sql_tf="UPDATE ter_historia SET esta_this='C' WHERE iden_this='$iden_this'";
}

$sql_="INSERT INTO ter_control(iden_tcon,iden_this,evolu_tcon,obser_tcon,codmedi_tcon,proced_tcon,fin_historia_tcon,resumen_tcon)
VALUES(0,'$iden_this','$evolu_','$obser_','$_SESSION[ter_codmedi]','$proced_','$fin_historia_tcon','$resumen')";
//echo "<br>".$sql_;
mysql_query($sql_);

if(mysql_affected_rows()==0){    
    $mensaje = "Error al guardar el registro";    
    $codigo = 0;
    // Crear un array con los datos
    $respuesta = array(
        "mensaje" => $mensaje,        
        "codigo" => $codigo
    );

    // Configurar la cabecera para indicar que la respuesta es JSON
    header('Content-Type: application/json');

    // Enviar la respuesta en formato JSON
    echo json_encode($respuesta);
}
else{    
    //$iden_tcon=mysql_insert_id();
    $sql_="UPDATE citas SET esta_cita='2' WHERE id_cita='$_SESSION[id_cita]'";
    //echo $sql_;
    mysql_query($sql_);
    if(!empty($sql_tf)){
        mysql_query($sql_tf);
    }

    $mensaje = "Registro guardado con exito";    
    $codigo = 1;
    // Crear un array con los datos
    $respuesta = array(
        "mensaje" => $mensaje,        
        "codigo" => $codigo
    );

    // Configurar la cabecera para indicar que la respuesta es JSON
    header('Content-Type: application/json');

    // Enviar la respuesta en formato JSON
    echo json_encode($respuesta);
}
?>

