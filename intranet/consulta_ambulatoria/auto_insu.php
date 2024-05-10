<?php
session_start();
session_register('datos');	
$link=Mysql_connect("localhost","root","");
if(!$link)echo"no hay conexion";
Mysql_select_db('proinsalud',$link);
$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
$sql = "SELECT DISTINCT desc_ins, codnue, pos_ins FROM insu_med WHERE esta_ins='A' AND desc_ins LIKE '%$q%' ORDER BY desc_ins";
echo $meneo;
$rsd = mysql_query($sql);
IF ($rsd)
{
	WHILE($rs = mysql_fetch_array($rsd)) 
	{
		$cid = $rs[codnue];
		$cname = $rs[desc_ins];
		$posins = $rs[pos_ins];
		ECHO "$cname|$cid|$posins\n";
	}
	echo "NO EXISTE";
}
?>
