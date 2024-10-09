<?php

	session_register('paciente');	
	session_register('Gcod_mediconh');
	session_register('numcita');
	session_register('tiespe');
	session_register('concontrol');
	session_register('Gareanh');

	$gcod_usu=$paciente;
	$gcod_cit=$numcita;

?>
<html>
<head>
<script language="JavaScript">
	function salirMicro(nivelMicro)
	{		
		if(nivelMicro==1)
		{    
			uno.action='medica0.php';
			uno.target='';
			uno.submit();
		}
		if(nivelMicro==2)
		{    
			uno.action='frm_fact.php';
			uno.target='';
			uno.submit();
		}
	}
</script>
</head>	

<?php	
	echo"<form name=uno method=post>";
	echo"<input type='hidden' name='CodigoMedMicro'>";
	echo"<input type hidden name='controlEdutar'>";
	
//	echo 'ControlEdutar '.$controlEdutar.'<br>';
//	echo 'CodigoMedMicro '.$CodigoMedMicro.'<br>';
	
	
	
	if(empty($gnumhistohc)){
		$fechalar=date('ymdHis');
		$fechaini=date('Y-m-d');
		$horaini=date('H:i:s');
		$numhistohc=$gcod_mediconh.$fechalar;
		$gnumhistohc=$numhistohc;
	}
	
		
	$controlArchivoMicro=0;	
	$archivoMicro1='tmp/9CMICR'.$numcita.'-'.$gcod_usu.'.txt';

	if($controlEdutar==1){
		if(file_exists($archivoMicro1)){
		
			$contadorTotal=0;
			$contador=0;
			$mediMicroeli = array();
			$mediMicroeli1 = array();		
			$fp = fopen ($archivoMicro1, "r" );
			while (( $data = fgetcsv ( $fp , 1000 , "\n" )) !== FALSE ){ 	
				$reg++;
				$i = 0;
				foreach($data as $dato){
					$campo[$i]=$dato;
					$i++ ;
				}
				$id12=$campo[0];
				$partesDeArray=explode("|", $id12);
				array_push($mediMicroeli1, $id12);
				if ($partesDeArray[1]=='codigo' && $partesDeArray[2]==$CodigoMedMicro){
					echo $partesDeArray[1].' '.$partesDeArray[2].'<br>';
					$localizado=$contador;
					$controlArchivoMicro=1;
				}
				
				$contador++;
				$contadorTotal++;
			}
			fclose ($fp);
			echo $controlArchivoMicro.'<br>';	
			
			if($controlArchivoMicro=1){

				unlink ($archivoMicro1);
				$hastaFinal=$localizado+9;
				$contadorTotal=$contadorTotal-1;
				
				$dosisMicro1=$dosisMicro.'-'.$unidadMicro;
				$dosisMicro=$dosisMicro1;
				$frecuenciaMicro1=$frecuenciaMicro.'-'.$unidadFrecueciaMicro;
				$frecuenciaMicro=$frecuenciaMicro1;
				$tiempoMicro1=$tiempoMicro.'-'.$unidTiempoAnti;
				$tiempoMicro=$tiempoMicro1;
				
				
				for($i=0;$i<=$contadorTotal;$i++){
					$porciones1 = explode("|", $mediMicroeli1[$i]);
					
					if($i>=$localizado && $i<=$hastaFinal){

						if($porciones1[1]=='codigo'){
							$a="9|";
							$a.="codigo|";
							$a.=$CodigoMedMicro."\n";
							$p=fopen($archivoMicro1,"a");
							if($p)
							{
								fputs($p,$a);
							}
						}

						if($porciones1[1]=='diagnosticoMicro'){	
							$a="9|";
							$a.="diagnosticoMicro|";
							$a.=$diagnosticoMicro.$claseDianostico."\n";
							$p=fopen($archivoMicro1,"a");
							if($p)
							{
								fputs($p,$a);
							}
						}
						
						if($porciones1[1]=='examenConfirmatorio'){	
							$a="9|";
							$a.="examenConfirmatorio|";
							$a.=$examenConfirmatorio."\n";
							$p=fopen($archivoMicro1,"a");
							if($p)
							{
								fputs($p,$a);
							}
						}
						
						if($porciones1[1]=='resultadoMicro'){
							$a="9|";
							$a.="resultadoMicro|";
							$a.=$resultadoMicro."\n";
							$p=fopen($archivoMicro1,"a");
							if($p)
							{
								fputs($p,$a);
							}
						}
						
						if($porciones1[1]=='nombreMicroAnte'){
							$a="9|";
							$a.="nombreMicroAnte|";
							$a.=$courseMicro_val.'-'.$nombreMicroAnte."\n";
							$p=fopen($archivoMicro1,"a");
							if($p)
							{
								fputs($p,$a);
							}
						}

						if($porciones1[1]=='dosisMicro'){					
							$a="9|";
							$a.="dosisMicro|";
							$a.=$dosisMicro."\n";
							$p=fopen($archivoMicro1,"a");
							if($p)
							{
								fputs($p,$a);
							}
						}

						if($porciones1[1]=='frecuenciaMicro'){
							$a="9|";
							$a.="frecuenciaMicro|";
							$a.=$frecuenciaMicro."\n";
							$p=fopen($archivoMicro1,"a");
							if($p)
							{
								fputs($p,$a);
							}
						}

						if($porciones1[1]=='tiempoMicro'){
							$a="9|";
							$a.="tiempoMicro|";
							$a.=$tiempoMicro."\n";
							$p=fopen($archivoMicro1,"a");
							if($p)
							{
								fputs($p,$a);
							}
						}

						if($porciones1[1]=='razondeCambio'){
							$a="9|";
							$a.="razondeCambio|";
							$a.=$razondeCambio."\n";
							$p=fopen($archivoMicro1,"a");
							if($p)
							{
								fputs($p,$a);
							}
						}
						
						if($porciones1[1]=='obsevaMicro'){	
							$a="9|";
							$a.="obsevaMicro|";
							$a.=$obsevaMicro."\n";
							$p=fopen($archivoMicro1,"a");
							if($p)
							{
								fputs($p,$a);
							}
						}
					}
					else{
						$a="9|";
						$a.=$porciones1[1]."|";
						$a.=$porciones1[2]."\n";
						$p=fopen($archivoMicro1,"a");
						if($p)
						{
							fputs($p,$a);
						}
					}
				}			
			}	
		}
    }
	 
	
	if($controlEdutar==0){	
		
		
		$dosisMicro1=$dosisMicro.'-'.$unidadMicro;
		$dosisMicro=$dosisMicro1;
		$frecuenciaMicro1=$frecuenciaMicro.'-'.$unidadFrecueciaMicro;
		$frecuenciaMicro=$frecuenciaMicro1;
		$tiempoMicro1=$tiempoMicro.'-'.$unidTiempoAnti;
		$tiempoMicro=$tiempoMicro1;
		
		$a="9|";
		$a.="codigo|";
		$a.=$CodigoMedMicro."\n";
		$p=fopen($archivoMicro1,"a");
		if($p)
		{
			fputs($p,$a);
		}
		
		$a="9|";
		$a.="diagnosticoMicro|";
		$a.=$diagnosticoMicro.$claseDianostico."\n";
		$p=fopen($archivoMicro1,"a");
		if($p)
		{
			fputs($p,$a);
		}
		
		$a="9|";
		$a.="examenConfirmatorio|";
		$a.=$examenConfirmatorio."\n";
		$p=fopen($archivoMicro1,"a");
		if($p)
		{
			fputs($p,$a);
		}
		
		$a="9|";
		$a.="resultadoMicro|";
		$a.=$resultadoMicro."\n";
		$p=fopen($archivoMicro1,"a");
		if($p)
		{
			fputs($p,$a);
		}
		
		$a="9|";
		$a.="nombreMicroAnte|";
		$a.=$courseMicro_val.'-'.$nombreMicroAnte."\n";
		$p=fopen($archivoMicro1,"a");
		if($p)
		{
			fputs($p,$a);
		}
		
		$a="9|";
		$a.="dosisMicro|";
		$a.=$dosisMicro."\n";
		$p=fopen($archivoMicro1,"a");
		if($p)
		{
			fputs($p,$a);
		}
		
		$a="9|";
		$a.="frecuenciaMicro|";
		$a.=$frecuenciaMicro."\n";
		$p=fopen($archivoMicro1,"a");
		if($p)
		{
			fputs($p,$a);
		}
		
		$a="9|";
		$a.="tiempoMicro|";
		$a.=$tiempoMicro."\n";
		$p=fopen($archivoMicro1,"a");
		if($p)
		{
			fputs($p,$a);
		}
		
		$a="9|";
		$a.="razondeCambio|";
		$a.=$razondeCambio."\n";
		$p=fopen($archivoMicro1,"a");
		if($p)
		{
			fputs($p,$a);
		}
	   
		$a="9|";
		$a.="obsevaMicro|";
		$a.=$obsevaMicro."\n";
		$p=fopen($archivoMicro1,"a");
		if($p)
		{
			fputs($p,$a);
		}
		
		echo"<input type='hidden' name='preclasemedi' value='$preclasemedi' >";
		echo"<input type='hidden' name='precodmedi' value='$precodmedi' >";
		echo"<input type='hidden' name='predesmedi' value='$predesmedi' >";
		echo"<input type='hidden' name='predosis' value='$predosis' >";
		echo"<input type='hidden' name='preunid' value='$preunid' >";
		echo"<input type='hidden' name='prefrecu' value='$prefrecu' >";
		echo"<input type='hidden' name='preunidfrecu' value='$preunidfrecu' >";
		echo"<input type='hidden' name='previa' value='$previa' >";
		echo"<input type='hidden' name='pretiempo' value='$pretiempo' >";
		echo"<input type='hidden' name='preobsemed' value='$preobsemed' >";
		echo"<input type='hidden' name='precanti' value='$precanti' >";
		echo"<input type='hidden' name='prediagmedi' value='$prediagmedi' >";
		echo"<input type='hidden' name='prejustifi' value='$prejustifi' >";
		echo"<input type='hidden' name='prepos' value='$prepos' >";
		
			
		
		$archivomedf='tmp/6HC'.$numcita.'-'.$paciente.'.txt';			
		$a="6|";$a.="clasemedi|";$a.="$preclasemedi\n";$p=fopen($archivomedf,"a");if($p){fputs($p,$a);}			
		$a="6|";$a.="codmedi|";$a.="$precodmedi\n";$p=fopen($archivomedf,"a");if($p){fputs($p,$a);}			
		$a="6|";$a.="desmedi|";$a.="$predesmedi\n";$p=fopen($archivomedf,"a");if($p){fputs($p,$a);}		
		$a="6|";$a.="dosis|";$a.="$predosis\n";$p=fopen($archivomedf,"a");if($p){fputs($p,$a);}
		$a="6|";$a.="unid|";$a.="$preunid\n";$p=fopen($archivomedf,"a");if($p){fputs($p,$a);}	
		$a="6|";$a.="frecu|";$a.="$prefrecu\n";$p=fopen($archivomedf,"a");if($p){fputs($p,$a);}	
		$a="6|";$a.="unidfrecu|";$a.="$preunidfrecu\n";$p=fopen($archivomedf,"a");if($p){fputs($p,$a);}
		$a="6|";$a.="via|";$a.="$previa\n";$p=fopen($archivomedf,"a");if($p){fputs($p,$a);}
		$a="6|";$a.="tiempo|";$a.="$pretiempo\n";$p=fopen($archivomedf,"a");if($p){fputs($p,$a);}
		$a="6|";$a.="obsemed|";$a.="$preobsemed\n";$p=fopen($archivomedf,"a");if($p){fputs($p,$a);}
		$a="6|";$a.="canti|";$a.="$precanti\n";$p=fopen($archivomedf,"a");if($p){fputs($p,$a);}		
		$a="6|";$a.="diagmedi|";$a.="$prediagmedi\n";$p=fopen($archivomedf,"a");if($p){fputs($p,$a);}
		$a="6|";$a.="justifi|";$a.="$prejustifi\n";$p=fopen($archivomedf,"a");if($p){fputs($p,$a);}
		$a="6|";$a.="pos|";$a.="$prepos\n";$p=fopen($archivomedf,"a");if($p){fputs($p,$a);}
		
		
	}	
	
	echo "<body onload='salirMicro(1)'>";
		
      

?>
</body>
</html>
