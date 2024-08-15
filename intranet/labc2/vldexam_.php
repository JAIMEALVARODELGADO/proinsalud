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
		form1.target='';
		form1.action='gresul_.php';
		form1.submit();	
		
}
function enviar2()
{
		
		alert("Los Examenes No Han sido Previamente Analizados\n");
		form1.control.value=2
		form1.target='';
		form1.action='gresul_.php';
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
		
		$nomvar='codusu'.$it;
		$codusu=$$nomvar;	
		echo"<input type=hidden name='$nomvar' value='$codusu'>";
		
		$nomvar='iden_labs'.$it;
		$iden_labs=$$nomvar;
		echo"<input type=hidden name='$nomvar' value='$iden_labs'>";
		
		
		$nomvar='num_ord'.$it;
		$num_ord=$$nomvar;
		echo"<input type=hidden name='$nomvar' value='$num_ord'>";
		
		
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
				
				//echo "<br>".$obs;
				//echo "<br>".$unlabc;
				//echo "<br>".$ref;
				
				//echo "<br>".$cod;
				
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
				

				if($sel==1)
				{
						
					$conex=mysql_query("SELECT iden_labs,codigo,iden_dlab,estd_dlab,etdv_dlab FROM detalle_labs WHERE iden_labs='$iden_labs' AND codigo='$cod'");
					
					while($rowm=mysql_fetch_array($conex))
					{
						$iden_dlab=$rowm[iden_dlab];
						$estd_dlab=$rowm[estd_dlab];
						
						//echo $estd_dlab;
						if($estd_dlab=='PR')
						{
										
							mysql_query("Update detalle_labs SET estd_dlab='CU',etdv_dlab='CU',fech_dlab='$fec',hora_dlab='$hor' WHERE iden_dlab='$iden_dlab'");
							//mysql_query("Update detalle_labs SET etdv_dlab='CU' WHERE iden_dlab='$iden_dlab'");
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