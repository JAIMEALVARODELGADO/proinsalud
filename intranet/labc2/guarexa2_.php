<?
session_register('Gidusulab'); 

if(empty($Gidusulab)){
  ?>
  <script language='javascript'>
   alert("Ha trascurrido mucho tiempo inactivo debe iniciar nuevamente");
   window.close();
  </script> 
   <?
}

?>
<html>
<head>
<title>RIPS</title>
</head>
<SCRIPT LANGUAGE='JavaScript'>
function enviar()
{		
		//alert("El número de Orden es:\n"+form1.iden_labs.value);
		form1.control.value=2
		form1.target='';
		form1.action='modi_labs.php';
		form1.submit();	
		
}
</script>
<?
		$link=Mysql_connect("localhost","root","");
		if(!$link)echo"no hay conexion";
		Mysql_select_db('proinsalud',$link);
		
		
		echo"<form name='form1' method='POST' >";

		$fecha=time();
		$fec=date ("Y-m-d",$fecha);
		$hor=date ("H:i",$fecha);
		
		echo "<input type=hidden name='iden_var' value='$iden_var'>";
		
		$nomvar='codusu'.$it;
		$codusu=$$nomvar;	
		echo"<input type=text name='$nomvar' value='$codusu'>";
		
		
		echo "<input type=hidden name='control' value=2>";
		echo "<input type=hidden name='iden_labs' value='$iden_labs'>";
		echo "<input type=hidden name='codig_usu' value='$codig_usu'>";
		echo"<input type=hidden name='idein' value='$idein'>";
		echo"<input type=hidden name='esta_lab' value='0'>";
		
		echo "<input type=hidden name='idenevo' value='$idenevo'>";
		echo"<input type=hidden name='ide_cita' value='$ide_cita'>";
		
			
		$nomvar='num_ord'.$it;
		//$num_ord=$$nomvar;
		echo"<input type=text name='$nomvar' value='$nord_lab'>";
		
		
		echo"<input type=hidden name=obs_labs value='$obs_labs'>";
		echo "<input type=hidden name=cod value='$cod'>";
		echo "<input type=hidden name=nord_lab value='$nord_lab'>";
		echo "<input type=hidden name=it value='$it'>";

		$nomvar='iden_labs'.$it;
		//$iden_labs=$$nomvar;
		echo"<input type=text name='$nomvar' value='$iden_labs'>";
		
		
		echo"<input type=hidden name=esta_ncf value='$esta_ncf'>";
		echo"<input type=hidden name=format value='$format'>";
		echo"<input type=hidden name=mcu value='$mcu'>";
		echo"<input type=hidden name=idenus value='$idenus'>";
	
		
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
				echo "<input type=text name='$nomvar' value='$iden_dlab'>";	
				

				if($sel==1)
				{
						
					$conex=mysql_query("SELECT iden_dlab,codigo FROM detalle_labs WHERE codigo='$cod' AND iden_dlab='$iden_dlab'");
					
					//echo $conex;
					
					if(mysql_num_rows($conex)<>0)
					{
					  
					  mysql_query("Update detalle_labs SET cod_medi='$Gidusulab',obsv_dlab='$obs',refe_dlab='$ref',unid_dlab='$unlabc' WHERE iden_dlab='$iden_dlab'");
					  $eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
                      VALUES ('$iden_labs','$nord_lab','$cod', '$fec', '$hor', '$idenus', 'IN', 'Modificado a la BD - $obs', '$Gidusulab')";	
					  mysql_query($eval);						  
					   
					}
					else
					{
					
					  mysql_query("INSERT INTO detalle_labs (iden_dlab, iden_labs, codigo,nord_dlab ,cod_medi, obsv_dlab, refe_dlab, unid_dlab,fech_dlab , hora_dlab,estd_dlab) 
					   VALUES (0, '$iden_labs', '$cod','$nord_lab','$Gidusulab', '$obs', '$ref', '$unlabc','$fec','$hor','PR')");
					   $eval="INSERT INTO `proinsalud`.`vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
                       VALUES ('$iden_labs','$nord_lab','$cod', '$fec', '$hor', '$idenus', 'IN', 'Insertado a la BD - $obs', '$Gidusulab')";	
					  mysql_query($eval);
					  // echo $con;
								
					}
				}
		
		}	
					
		
?>
<!--<body onload='enviar()'>-->
<body onload='enviar()'>
</form>
</body>
</html>