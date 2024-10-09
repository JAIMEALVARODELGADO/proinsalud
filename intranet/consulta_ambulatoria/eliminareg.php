<?
	session_register('paciente');
	session_register('Gareanh');
	session_register('datos');
	session_register('numcita');
//Para antimicrobiano	
//	$gcod_usu=$paciente;
//Fin antimicrobiano
?>
<html>
<head>
<script language="JavaScript">
	function salir()
	{	
		progra=uno.prg.value;
		uno.target='';
		uno.action=progra;
		uno.submit();
		uno.target='menu';
		uno.action='menu.php';
		uno.submit();		
	}	
</script>
</head>
<body onload=salir()>
<?
		
	echo "<form name=uno method=post>";
	if ($codiprg==5)
	{
		$archivo='tmp/5HC'.$numcita.'-'.$paciente.'.txt';			
		echo"<input type=hidden name=prg value='ordenes0.php'>";
		
	}
	if ($codiprg==6)		
	{
		if($variables==14)$archivo='tmp/6HC'.$numcita.'-'.$paciente.'.txt';
		if($variables==19)$archivo='tmp/medonco'.$numcita.'-'.$paciente.'.txt';
		echo"<input type=hidden name=prg value='medica0.php'>";
	}
	if ($codiprg=="juntam")		
	{
		$archivo='tmp/juntam'.$numcita.'-'.$paciente.'.txt';			
		echo"<input type=hidden name=prg value='junta_medica.php'>";
		$variables=3;
	}
	
	
	if(file_exists($archivo))
	{			
		$fp = fopen ($archivo, "r" );
		$reg=0;
		$cont=0;
		$n=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{ 
			$reg++;
			$i = 0;
			foreach($data as $dato)
			{
				$campo[$i]=$dato;
				$i++ ;
			}
			$$campo[1]=$campo[2];
			
			$val1[$cont][$n]=$campo[0];
			$val2[$cont][$n]=$campo[1];
			$val3[$cont][$n]=$campo[2];
			
			$ar=$campo[0];
			$as=$campo[1];
			$ab=$campo[2];				
			$n++;
			if($reg % $variables == 0)
			{
				$cont++;
				$n=0;
			}					
		}
		fclose ($fp);
		unlink ($archivo);
	}	
	
	for($i=0;$i<$cont;$i++)
	{
		for($j=0;$j<$variables;$j++)
		{
			$va1=$val1[$i][$j].'|';
			$va2=$val2[$i][$j].'|';
			$va3=$val3[$i][$j];
// para medicamentos antimicrobianos			
			/*
			if($i==$itemeli){
				if($va2=='codmedi|'){
					$codigoEliminar=$va3;
				}
			}
			*/
// fin antimicrobianos
			if($i!=$itemeli)
			{
				$a="$va1";
				$a.="$va2";
				$a.="$va3\n";
				$p=fopen($archivo,"a");
				if($p)
				{
					fputs($p,$a);
				}
			}
		}	
	}


	//Para implementar microbianos 4.20	
	/*
		include('php/conexion1.php');
		$consuMicro1=mysql_query("select antimicrobiano_mdi from medicamentos2 where codi_mdi='$codigoEliminar'");
		while($rowcM1 = mysql_fetch_array($consuMicro1))
		{
			$antimicrobiano_mdi1=$rowcM1['antimicrobiano_mdi'];
		}
		if($antimicrobiano_mdi1=='S'){
			$contador=0;
			$mediMicroeli = array();
			$archivoMicro='tmp/9CMICR'.$numcita.'-'.$gcod_usu.'.txt';
			if(file_exists($archivoMicro)){
				$fp = fopen ($archivoMicro, "r" );
				while (( $data = fgetcsv ( $fp , 1000 , "\n" )) !== FALSE ){ 	
					$reg++;
					$i = 0;
					foreach($data as $dato){
						$campo[$i]=$dato;
						$i++ ;
					}
					$id12=$campo[0];
					$partesDeArray=explode("|", $id12);
					if ($partesDeArray[1]=='codigo' && $partesDeArray[2]==$codigoEliminar){
						$localizado=$contador;
					}
					array_push($mediMicroeli, $id12); 
					$contador++;
				}
				fclose ($fp);
				unlink ($archivoMicro);
				$totalArray=count($mediMicroeli);
				$hastaFinal=$localizado+9;
				for($i=0;$i<$totalArray;$i++){
					if($i>=$localizado && $i<=$hastaFinal){
						$coco=12;
					}
					else{
						$a=$mediMicroeli[$i]."\n";
						$p=fopen($archivoMicro,"a");
						if($p){
							fputs($p,$a);
						}
						
					}
				}
			}
		}
		echo "<body onload='salir(55)'>";
		echo "<input type='hidden' name='CodigoMedMicro' value=$codmedi>";
*/	
//Fin anexo microbianos
	
	echo"</form>";		
?>
</body>
</html>