<?php
$host="190.8.176.51";
$usua="proinsal_dev";
$pass="pr01nsal_dev";
$bdat="proinsal_apps_dev";

$db = new MySQLi($host, $usua, $pass, $bdat);

if($db->connect_error) {
    die('Error de conexion ('.$db->connect_errno.')'.$db->connect_errno);
}

echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL;
echo "Información del host: " . mysqli_get_host_info($enlace) . PHP_EOL;

mysqli_close($enlace);

?>