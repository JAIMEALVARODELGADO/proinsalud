<?php
session_start();
$codiusua=$_SESSION['codiusua'];
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
}
 foreach($_GET as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
}
include ('php/conexion1.php');   

$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
if (strlen($q)>2)
{
    $sql = "select CODI_USU AS codunico, NROD_USU AS cedula, CONCAT(PNOM_USU,' ',SNOM_USU,' ',PAPE_USU,' ',SAPE_USU)  AS nombre FROM usuario where CONCAT(PNOM_USU,' ',SNOM_USU,' ',PAPE_USU,' ',SAPE_USU) LIKE '%$q%' OR CONCAT(PNOM_USU,' ',PAPE_USU,' ',SAPE_USU) LIKE '%$q%' ORDER BY CONCAT(PNOM_USU,' ',SNOM_USU,' ',PAPE_USU,' ',SAPE_USU)";
    $rsd = mysql_query($sql);
    IF ($rsd)
    {
        WHILE($rs = mysql_fetch_array($rsd)) 
        {
            $ccod = $rs[codunico];
            $cid = $rs[cedula];
            $cname = $rs[nombre];			
            ECHO "$cname|$cid|$ccod\n";
        }		
    }
    echo "-";
}
?>
