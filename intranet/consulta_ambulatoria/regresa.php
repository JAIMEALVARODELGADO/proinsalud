<?		
	session_register('numcita');
	session_register('paciente');
	if (!empty($iden_ci))$numcita=$iden_ci;
	$archivo0='tmp/lista.txt';	
	if(file_exists($archivo0))
	{
		$fp = fopen ($archivo0, "r" );
		$reg=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{				
			foreach($data as $dato)
			{
				$campo[$reg]=$dato;
				//echo $dato;
				$reg++;
			}
			//echo $reg;
		}
		fclose ($fp);
		unlink ($archivo0);
	}		
	for($i=0;$i<$reg;$i++)
	{
		
		if($campo[$i]!=$numcita)
		{
			$numc=$campo[$i];
			$a="$numc\n";
			$p=fopen($archivo0,"a");
			if($p)
			{
				fputs($p,$a);
			}				
		}
	}
?>
<html>
<head>
<script language="Javascript">
	function salir()	
	{		
		alert(uno.valregre.value);
		if(uno.valregre.value=='LP')
		{
			uno.target='area';
			uno.action='lista_pacientes.php';
			uno.submit();
		}
		if(uno.valregre.value=='LT')
		{
			uno.target='area';
			uno.action='clasi_triage.php';
			uno.submit();
		}
		uno.target='titulo';
		uno.action='titulo.php';
		uno.submit();
		
		
	}	
</script>
</head>
<body onload='salir()'>
<?	
	$valregre=$_POST['valregre'];
	echo"<form name=uno method=post>
	<input type=hidden name=valregre value='$valregre'>";
	echo"</form>";
	$paciente='';

?>
</body>
</html>