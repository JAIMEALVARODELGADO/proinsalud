<?
session_register('num_cita');
$num_cita=$idcita;
?>
<html>
<head>
<script language="Javascript">
	function salir()
	{
		uno.target='menu';
		uno.action='menu.php';
		uno.submit();
		
		uno.target='area';
		uno.action='blanco.php';
		uno.submit();	
	}
</script>
<?
	
	echo"<form name=uno method=post>
	<body onload='salir()'>
	</body>
	</form>";

?>
</html>
