<?
session_register('Gidusulab'); 
?>
<html>
<head>
<title>RIPS</title>
</head>
<SCRIPT LANGUAGE='JavaScript'>
function enviar()
{		
		alert("Los Examenes Fueron Validados\n Puede Imprimirlos");
		form1.control.value=2
		form1.action='modi_labs.php';
		form1.target='';
		form1.submit();		
		
}
function enviar2()
{
		
		alert("Los Examenes No Han sido Previamente Analizados\n");
		form1.control.value=2
		form1.action='modi_labs.php';
		form1.target='frm12';
		form1.submit();		
	
}
</script>
<?
		
		$link=Mysql_connect("localhost","root","");
		if(!$link)echo"no hay conexion";
		Mysql_select_db('proinsalud',$link);
		//echo 'toy'.$iden_labs;
		
		echo"<form name='form1' method='POST' >";

		$fecha=time();
		$fec=date ("Y-m-d",$fecha);
		$hor=date ("H:i",$fecha);
		
		echo "<input type=hidden name='iden_labs' value='$iden_labs'>";
		
		$nomvar='codusu'.$it;
		$codusu=$$nomvar;	
		echo"<input type=hidden name='$nomvar' value='$codusu'>";
		
		$nomvar='iden_labs'.$it;
		//$iden_labs=$$nomvar;
		echo"<input type=hidden name='$nomvar' value='$iden_labs'>";
		
		
		$nomvar='num_ord'.$it;
		//$num_ord=$$nomvar;
		echo"<input type=hidden name='$nomvar' value='$nord_lab'>";
		
		
		echo "<input type=hidden name='iden_var' value='$iden_var'>";
		//echo "<input type=hidden name=codusu value=$codusu>";
		echo "<input type=hidden name='control' value=2>";
		echo "<input type=hidden name='codig_usu' value='$codig_usu'>";
		echo"<input type=hidden name='idein' value='$idein'>";
		echo"<input type=hidden name='esta_lab' value='0'>";
		
		echo "<input type=hidden name='idenevo' value='$idenevo'>";
		echo"<input type=hidden name='ide_cita' value='$ide_cita'>";
		//echo"<input type=hidden name=num_ord value=$num_ord >";
		echo"<input type=hidden name='obs_labs' value='$obs_labs'>";
		echo "<input type=hidden name='cod' value='$cod'>";
		echo "<input type=hidden name='nord_lab' value='$nord_lab'>";
		echo "<input type=hidden name='it' value='$it'>";

		//echo "<input type=hidden name=iden_labs value=$iden_labs>";
		echo"<input type=hidden name='esta_ncf' value='$esta_ncf'>";
		echo"<input type=hidden name='format' value='$format'>";
		echo"<input type=hidden name='mcu' value='$mcu'>";
		
		
		//echo "FORMATO".$format;
		
		$concam=mysql_query("SELECT caac_ing  FROM `ingreso_hospitalario` WHERE id_ing='$idein'");
		while($rowcam=mysql_fetch_array($concam))
		{	
			$cam=$rowcam['caac_ing'];
		}
		
		for($i=0;$i<$mcu;$i++)
		{
				$nomvar='selec'.$it.$i;
				$sel=$$nomvar;	
				
				
				$nomvar='cod'.$it.$i;
				$cod=$$nomvar;	
				
				$nomvar='obs'.$it.$i;
				$obs=$$nomvar;
				
				$nomvar='uni'.$it.$i;
				$unlabc=$$nomvar;
				
				$nomvar='ref'.$it.$i;
				$ref=$$nomvar;
				
				$nomvar='iden_dlab'.$it.$i;
				$iden_dlab=$$nomvar;



				
				$nomvar='selec'.$it.$i;
				echo"<input type=hidden name='$nomvar' value='$sel'>";
				
				$nomvar='cod'.$it.$i;
				echo"<input type=hidden name='$nomvar' value='$cod'>";
				
				$nomvar='obs'.$it.$i;
				echo"<input type=hidden name='$nomvar' value='$obs'>";
				
				$nomvar='uni'.$it.$i;
				echo"<input type=hidden name='$nomvar' value='$unlabc'>";
				
				$nomvar='ref'.$it.$i;
				echo"<input type=hidden name='$nomvar' value='$ref'>";	
				
				$nomvar='iden_dlab'.$it.$i;
				echo "<input type=hidden name='$nomvar' value='$iden_dlab'>";	
				

				if($sel==1)
				{
						
					$conex21=mysql_query("SELECT iden_dlab,codigo,estd_dlab FROM detalle_labs WHERE codigo='$cod' AND iden_dlab='$iden_dlab'");
					//echo $conex21;				
					
					while($rowm21=mysql_fetch_array($conex21))
					{
						$estd_dlab=$rowm21[estd_dlab];
						$iden_dlab=$rowm21[iden_dlab];
						
						if($estd_dlab=='PR')
						{
										
							//mysql_query("Update detalle_labs SET estd_dlab='CU',fech_dlab='$fec',hora_dlab='$hor' WHERE iden_dlab='$iden_dlab'");
							mysql_query("Update detalle_labs SET estd_dlab='CU',fech_dlab='$fec',hora_dlab='$hor' WHERE iden_dlab='$iden_dlab'");
							echo "<body onload='enviar()'>";
						}
						else
						{
						
							echo"<body onload='enviar2()'>";
						
						}
						//echo $conspr;
					} 
					   
					
				}
		
		}	
					
		
?>
<body onload='enviar()'>
</form>
</body>
</html>