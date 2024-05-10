<?
	$conec = odbc_connect ("tera", "", "");
	$bced = odbc_exec ($conec, "select * from CIE10");		
	$nced=odbc_num_rows($bced);	
$i=0;	
	while($rced=odbc_fetch_array($bced))
	{
		$mat[$i][0]=$rced['CODIGO'];
		$mat[$i][1]=$rced['DESCRIPCION'];		
		$i++;
	}
	$fin=$i;
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);	
	for($i=0;$i<$fin;$i++)
	{
		$a1='';
		$a2='';		
		$a1=$mat[$i][0];
		$a2=$mat[$i][1];
		echo $a1.' - '.$a2.'<br>';		
		$cad="UPDATE `cie_10` SET `vile_cie` = 'S' WHERE `cod_cie10` = '$a1'";
		$resul=Mysql_query($cad,$link);
		if(!$resul) echo"error";		
	}
	
	
	
?>