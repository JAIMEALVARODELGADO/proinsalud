<?php

include('php/conexion.php');

$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
$sql = "SELECT descrip, codigo FROM cups  WHERE descrip LIKE '$q%' AND prmt_cup='13' AND esta_cup='AC'";
//echo $sql;
$rsd = mysql_query($sql);
if($rsd)
{
	while($rs = mysql_fetch_array($rsd)) 
	{
		$cod_cir = $rs[codigo];
                $ccomer = $rs[descrip];
		echo"$ccomer|$cod_cir|\n";
	}
}

?>