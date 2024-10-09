<?
session_register('Gidusulab'); 
//echo 'toy'.$Gidusulab;
?>
<html>
<head>
<title>RIPS</title>
</head>
<SCRIPT LANGUAGE='JavaScript'>
function enviar()
{		
			//alert(form1.format.value);
			form1.target='';
			form1.action='ing_cups2.php';
			form1.submit();	
}
</script>
<form name="form1" method="POST" >
<?
		$link=Mysql_connect("localhost","root","");
		if(!$link)echo"no hay conexion";
		Mysql_select_db('proinsalud',$link);
		
		$fecha=time();
		$fec=date ("Y-m-d",$fecha);
		$hor=date ("H:i",$fecha);
		echo $mcu;
		//echo $hor;
		//echo $Gidusulab;
		echo "<input type=hidden name=iden_labs value=$iden_labs>";
		echo "<input type=hidden name=codusu value=$codusu>";
		echo "<input type=hidden name=control value=2>";
		echo "<input type=hidden name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=idein value=$idein>";
		echo"<input type=hidden name=codusu value=$codusu>";
		echo"<input type=hidden name=amb_usu  value='$amb_usu'>";
		echo"<input type=hidden name=fin_con  value='$fin_con'>";
		echo"<input type=hidden name=condu  value='$condu'>";
		echo"<input type=hidden name=progu  value='$progu'>";
		echo"<input type=hidden name=med_soli  value='$med_soli'>";
		echo"<input type=hidden name=fent value=$fent>";
		echo "<input type=hidden name=idenevo value=$idenevo>";
		echo"<input type=hidden name=ide_cita value=$ide_cita>";
		
		for($i=1;$i<$mcu;$i++)
		{
			$nomvar='selec'.$i;
			$sel=$$nomvar;	
			$nomvar='cod'.$i;
			$cod=$$nomvar;	
			$nomvar='obs'.$i;
			$obs=$$nomvar;
			$nomvar='uni'.$i;
			$unlabc=$$nomvar;
			$nomvar='ref'.$i;
			$ref=$$nomvar;
				
			$nomvar='selec'.$i;
			echo"<input type=hidden name=$nomvar value=$sel>";
			$nomvar='cod'.$i;
			echo"<br><input type=text name=$nomvar value=$cod>";
			$nomvar='obs'.$i;
			echo"<br><input type=hidden name=$nomvar value=$obs>";
			$nomvar='uni'.$i;
			echo"<br><input type=hidden name=$nomvar value=$unlabc>";
			$nomvar='ref'.$i;
			echo"<br><input type=hidden name=$nomvar value=$ref>";		
				
			$fecha=time();
			$fec=date (" Y/m/d",$fecha);
			$hor=date ("H:i",$fecha);
			$fech=$fec.''.$hor;
			
						
			if($sel==1)
			{
				$conprc=mysql_query("SELECT iden_dlab,  iden_labs,  codigo,  cod_medi,  obsv_dlab,  refe_dlab,  unid_dlab  
				FROM detalle_labs  WHERE iden_labs='$iden_labs' and codigo='$cod'");
				if(mysql_num_rows($conprc)==0){
					mysql_query("INSERT INTO detalle_labs (iden_dlab, iden_labs, codigo, cod_medi, obsv_dlab, refe_dlab, unid_dlab) 
					VALUES (0, '$iden_labs', '$cod', '$Gidusulab', '$obs', '$ref', '$unlabc')");
				}
				else{
				  $rowpr=mysql_fetch_array($conprc);
				  mysql_query("UPDATE detalle_labs SET iden_labs='$iden_labs',codigo='$cod',cod_medi='$Gidusulab',obsv_dlab='$obs',refe_dlab='$ref',unid_dlab='$unlabc'
				  WHERE iden_dlab=$rowpr[iden_dlab]");
				}
		
			}
					
				
			   
		}		
				
		
		echo"<input type=hidden name=esta_ncf value=$esta_ncf>";
		echo"<input type=hidden name=format value=$format>";
		echo"<input type=hidden name=mcu value=$mcu>";
		echo"<input type=hidden name=fin value=$fin>";
		echo"<input type=hidden name=iden_labs value=$iden_labs>";
		
		
		
		
?>
<body onload='enviar()'>
</form>
</body>
</html>