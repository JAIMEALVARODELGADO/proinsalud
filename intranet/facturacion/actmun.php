<?php
//$conexion = mysql_connect("localhost","root","VJvj321");
$conexion = mysql_connect("localhost","root","");
mysql_select_db("proinsalud",$conexion);
$consulta="SELECT codi_usu,mate_usu FROM usuario WHERE LENGTH(mate_usu)=3";
$consulta=mysql_query($consulta);
while($row=mysql_fetch_array($consulta)){
    $mun='52'.TRIM($row[mate_usu]);
    //echo "<br>".$mun;
    $sql="UPDATE usuario SET mate_usu='$mun' WHERE codi_usu=$row[codi_usu]";
    //echo "<br>".$sql;
    mysql_query($sql);
}
mysql_free_result($consulta);
mysql_close();
?>
