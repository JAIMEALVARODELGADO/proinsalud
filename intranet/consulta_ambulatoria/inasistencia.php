<html>
<head>
<script language="Javascript">
	function salir()
	{
		uno.target='';
		uno.action='regresa.php';
		uno.submit();		
	}
</script>
</head>
<body onload='salir()'>
<?
	include ('php/conexion1.php');
	echo"<form name=uno method=post>
	<input type=hidden name=valregre value='LP'>";	
	$sSQL="Update citas Set Esta_cita ='4' Where id_cita='$cita'";
	mysql_query($sSQL);	
	if($origmed==2)
	{
		$ssSQL="Update triage_urgencias Set paus_tri='S' Where iden_cita='$cita'";
		mysql_query($ssSQL);	
	}	
	echo"</form>";

?>
</body>
</html>
