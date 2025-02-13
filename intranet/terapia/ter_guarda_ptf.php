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
$sql_="INSERT INTO ter_historia(iden_this,codi_usu,cont_this,servrem_this,medrem_this,enfact_this,estfis_this,dxprinc_this,tpdxpr_this,cexter_this,ambit_this,calhum_this,crioter_this,contras_this,ultraso_this,estrasc_this,msedat_this,mdesco_this,pcasero_this,tecnic_this,sesion_this,codmedi_this,esta_this,numero_orden_this,tipoterapia_this)
VALUES(0,'$row[idusu_citas]','$row[cotra_citas]','$servrem_','$medrem_','$enfact_','$estfis_','$dxprinc_','$tpdxpr_','$cexter_','$ambit_','$calhum_','$crioter_','$contras_','$ultraso_','$estrasc_','$msedat_','$mdesco_','$pcasero_','$tecnic_','$sesion_','$_SESSION[ter_codmedi]','A','$numero_orden_this','$tipoterapia_')";
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
    $iden_this=mysql_insert_id();
    if($dxrel1_<>""){
        $sql_="INSERT INTO ter_dxhistoria(iden_dxh,iden_this,dxrel_dxh) VALUES (0,'$iden_this','$dxrel1_')";
        mysql_query($sql_);
    }
    if($dxrel2_<>""){
        $sql_="INSERT INTO ter_dxhistoria(iden_dxh,iden_this,dxrel_dxh) VALUES (0,'$iden_this','$dxrel2_')";
        mysql_query($sql_);
    }
    if($dxrel3_<>""){
        $sql_="INSERT INTO ter_dxhistoria(iden_dxh,iden_this,dxrel_dxh) VALUES (0,'$iden_this','$dxrel3_')";
        mysql_query($sql_);
    }
    $sql_="UPDATE citas SET esta_cita='2' WHERE id_cita='$_SESSION[id_cita]'";
    mysql_query($sql_);

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



