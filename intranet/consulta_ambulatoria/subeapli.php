<?
	
	if(isset($_POST['paciente']))
	{
		$paciente = $_POST['paciente'];
		echo $paciente;
	}
	
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>

</head>	
<body>
<?
	include ('php/conexion1.php');
	
	//$bushisto=mysql_query("select * from consultaprincipal where (cod_actpyp is NULL and antefam_cpl='' and anteper_cpl='')");//MARIO
	//echo mysql_num_rows($bushisto);
	//ECHO"<BR>";
	
	
	$bushisto=mysql_query("UPDATE consultaprincipal SET `vers_apli`='5510' WHERE (cod_actpyp is NULL and antefam_cpl='' and anteper_cpl='')");
	$bushisto=mysql_query("UPDATE consultaprincipal SET `vers_apli`='5503' WHERE (cod_actpyp is NULL and antefam_cpl<>'' AND anteper_cpl<>'')");
	
	
	//$bushisto=mysql_query("select * from consultaprincipal where (cod_actpyp is NULL and antefam_cpl<>'' AND anteper_cpl<>'')");//NUEVA
	
	echo "FINALIZA YA";
	
	//echo mysql_num_rows($bushisto)
	//if(mysql_num_rows($bushisto)>0)
?>
</body>
</html>