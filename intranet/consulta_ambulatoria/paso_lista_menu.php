<?
	session_register('Gcod_mediconh');
	session_register('paciente');
	session_register('numcita');
	session_register('Gcontratonh');
	session_register('$Gareanh');
	
	
	if($opcion<3)
	{		
		$numcita=$_POST['cita'];
		$paciente=$codusu;	
		$Gcontratonh=$contra;	
		$Gareanh=$servicio;
	}
	else
	{		
		$paciente='';		
		$numcita='';		
		$Gcontratonh='';
	}
	$archivo='tmp/lista.txt';	
	$a="$numcita\n";
	$p=fopen($archivo,"a");
	if($p)
	{
		fputs($p,$a);
	}	
?>
<html>
<head>
<script language="Javascript">
	function salir(op)
	{		
		top.document.getElementById("marco").setAttribute("cols", "185,*"); 		
		if(op==1)
		{
			uno.target='area';
			uno.action='blanco.php';
			uno.submit();
			
			uno.target='menu';
			uno.action='menu.php';
			uno.submit();		
			
			uno.target='titulo';
			uno.action='titulo.php';
			uno.submit();
		}
		if(op==2)
		{			
			uno.target='area';
			uno.action='tomasignos.php';
			uno.submit();
			
			uno.target='menu';
			uno.action='blanco.php';
			uno.submit();		
			
			uno.target='titulo';
			uno.action='titulo.php';
			uno.submit();
		}
	}
</script>
<?	
	$varanesdolor=$_POST['contdolor'];
	if($Gareanh=='62' && $varanesdolor=='')$Gareanh='324';
	if($Gareanh=='62' && $varanesdolor=='1')$Gareanh='62';
	if($Gareanh=='324' && $varanesdolor=='')$Gareanh='324';
	if($Gareanh=='324' && $varanesdolor=='1')$Gareanh='62';
	
	if($Gareanh=='62')
	{	
		$archivo='tmp/HCDOLOR'.$numcita.'-'.$paciente.'.txt';		
		if(file_exists($archivo)==TRUE)
		{
			unlink ($archivo);
		}
		$varanesdolor=$_POST['contdolor'];
		if (isset($varanesdolor)) 
		{
			if($varanesdolor==1)
			{	
				$a="2|";
				$a.="varanesdolor|";
				$a.="$varanesdolor\n";
				$p=fopen($archivo,"a");
				if($p)
				{
					fputs($p,$a);
				}
			}
			else
			{
				echo 'Variable sin datos <br>';
			}	
		}
		else
		{
			echo 'Cuando no existe la variable <br>';
		}	
	}	
	echo"<form name=uno method=post>
	<body onload='salir($opcion)'>
	</body>
	</form>";

?>
</html>