<html>
<head>
</head>
<body>
<?
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);
	$bper=mysql_query("select * from permisos_citas where esta_per='A'");
	
	$m=0;
	while($rper=mysql_fetch_array($bper))
	{
		$iden_per=$rper['iden_per'];
		$usua_per=$rper['usua_per'];
		$serv_per=$rper['serv_per'];
		$esta_per=$rper['esta_per'];
		$area_per=$rper['area_per'];
		$tipo=$rper['tipo_per'];

		if($tipo=='')
		{
			$nesta='N';
			if($esta_per=='A')$nesta='T';
			if($esta_per=='I')$nesta='N';
			$mod=mysql_query("UPDATE permisos_citas SET `tipo_per`='$nesta' WHERE `iden_per`='$iden_per'");		
		}


		$n=0;
		$buscon=mysql_query("SELECT * FROM `contrato` WHERE `ESTA_CON` = 'A' order by NEPS_CON");			
		while($rcon=mysql_fetch_array($buscon))
		{
			$codcon=$rcon['CODI_CON'];  
			$ingre=mysql_query("INSERT INTO `permisos_citascon` ( `iden_pco` , `iden_per` , `usua_pco` , `serv_pco` , `area_pco` , `cont_pco` , `esta_pco` , `cidi_pco`  ) 
			VALUES (0 ,'$iden_per', '$usua_per', '$serv_per', '$area_per', '$codcon', 'A', 'N')");
			if(!$ingre)echo"<BR><BR>INSERT INTO `permisos_citascon` ( `iden_pco` , `iden_per` , `usua_pco` , `serv_pco` , `area_pco` , `cont_pco` , `esta_pco` , `cidi_pco`  ) 
			VALUES (0 ,'$iden_per', '$usua_per', '$serv_per', '$area_per', '$codcon', 'A', 'N')<BR><BR>";
			$n++;
		}
		//echo $usua_per.' . '.$m.' --- '.$n.'<br>';
		$m++;
	}
	//echo"FIN";
	

?>

