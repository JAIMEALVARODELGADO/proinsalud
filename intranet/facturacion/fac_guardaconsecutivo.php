<?php

include('php/conexion.php');

$msj="";

//echo $_POST["prefijo"];

//echo $_POST["id_consecutivo"];

if($_POST["id_consecutivo"]<>""){
    $sql="UPDATE consecutivo SET
        prefijo = '$_POST[prefijo]',
        numero_fac = '$_POST[consecutivo]',
        encabezado_fac = '$_POST[encabezado]',
        pie_fac = '$_POST[pie]',
        estado = '$_POST[estado]'
        WHERE id_consecutivo = '$_POST[id_consecutivo]'";
    //echo $sql;
    mysql_query($sql);
}
else{
    $consultactivo="SELECT * FROM consecutivo WHERE prefijo='$_POST[prefijo]'";
    //echo $consultactivo;
    $consultactivo=mysql_query($consultactivo);
    if(mysql_num_rows($consultactivo)==0){
        $sql="INSERT INTO consecutivo (prefijo,numero_fac,encabezado_fac,pie_fac,estado)
        values('$_POST[prefijo]','$_POST[consecutivo]','$_POST[encabezado]','$_POST[pie]','A')";
        //echo $sql;
        mysql_query($sql);
        $msj="Registro guardado con éxito";
    }
    else{
        $msj="Registro duplicado";
    }
}

echo $msj;
?>