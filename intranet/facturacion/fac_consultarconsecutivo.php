<?php

include('php/conexion.php');

$data="";

//echo $_POST["id_consecutivo"];

$consultactivo="SELECT * FROM consecutivo WHERE id_consecutivo='$_POST[id_consecutivo]'";
//echo $consultactivo;
$consultactivo=mysql_query($consultactivo);
if(mysql_num_rows($consultactivo)<>0){
    $row=mysql_fetch_array($consultactivo);
    $consecutivo = new Consecutivo();
    $consecutivo->id_consecutivo = $row[id_consecutivo];
    $consecutivo->prefijo = $row[prefijo];
    $consecutivo->numero_fac = $row[numero_fac];
    $consecutivo->encabezado_fac = $row[encabezado_fac];
    $consecutivo->pie_fac = $row[pie_fac];
    $consecutivo->fecha_registro = $row[fecha_registro];
    $consecutivo->estado = $row[estado];

    $data = json_encode($consecutivo);

}
else{
    $data="Registro no encontrado";
}

echo $data;


class Consecutivo{
    public $id_consecutivo;
    public $prefijo;
    public $numero_fac;
    public $encabezado_fac;
    public $pie_fac;
    public $fecha_registro;
    public $estado;
}
?>