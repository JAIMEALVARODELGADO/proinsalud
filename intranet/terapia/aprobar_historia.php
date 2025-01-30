<?php
session_start();
include('php/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
    if (isset($_POST['iden_this']) && $_POST['iden_this'] != '') {
        $iden_this = $_POST['iden_this'];
        $sql = "UPDATE ter_historia SET codigo_aprobador='$_SESSION[ter_codmedi_cit]' WHERE iden_this='$iden_this'";
        //echo $sql;
        mysql_query($sql);
        if(mysql_affected_rows()>0){
            echo 'Correcto: El registro se aprobó con éxito';
        } else {
            echo 'Error: No se pudo aprobar el registro';
        }        
    } else {
        echo 'Error: No se pudo aprobar el registro';
    }

}
?>