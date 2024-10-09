<?session_register('Gidusulab'); ?>
<html>
<head>
<title>RIPS</title>
</head>
<SCRIPT LANGUAGE='JavaScript'>

function regresar()
	{
		form1.action='cd_usuario2.php';
		form1.submit();	
					
	}
	

</script>
<form name="form1" method="POST" >
<?		


		mysql_connect("localhost","root",""); 
		mysql_select_db("PROINSALUD");
		$fecha=time();
		$fec=date ("Y-m-d",$fecha);
		$hor=date ("H:i",$fecha);

		
		
		echo "<input type=hidden name=iden_evo value=$iden_evo>";
		echo "<input type=hidden name=id_ing value=$id_ing>";
		echo "<input type=hidden name=hora value=$hora>";
		echo "<input type=hidden name=fech_qxf value=$fech_qxf>";
		echo "<input type=hidden name=codusu value=$codusu>";
		echo "<input type=hidden name=esta_ord value=$esta_ord>";
		echo "<input type=hidden name=datos value='$datos'>";
		
		echo "<input type=hidden name=it value=$it>";
		echo "<input type=hidden name=jt value=$jt>";
		echo "<input type=hidden name=mcu value=$mcu>";
		
		
		mysql_query("INSERT INTO `vitac_orden` ( `iden_labs`, `iden_evo`, `fech_vord`, `hora_vord`, `codu_vord`, `eord_vord`, `dato_vord`, `resp_vord`) 
			VALUES ('$id_ing', '$iden_evo', '$fech_qxf', '$hora', '$codusu', '$esta_ord', '$datos','$Gidusulab')");
		
		//echo $eval;
						
		
		for($i=1;$i<$mcu;$i++)
		{
			$nomvar='iden_var'.$it.$jt.$i;
			$iden_var=$$nomvar;	
					
			echo"<input type=hidden name=$nomvar value=$iden_var>";
			
			$consdes="SELECT cups.codigo,cups.descrip,hist_evo.id_ing,hist_var.iden_var,hist_var.iden_evo
			FROM cups AS cups
			INNER JOIN hist_var AS hist_var ON cups.codigo=hist_var.iden_ser
			INNER JOIN hist_evo AS hist_evo ON hist_var.iden_evo=hist_evo.iden_evo
			WHERE hist_var.iden_var ='$iden_var'";
			//echo $consdes;
			$consdes=mysql_query($consdes);
			//echo mysql_num_rows($consdes);
			if(mysql_num_rows($consdes)<>0)
			{
				while($row = mysql_fetch_array($consdes))
				{
					$iden_evo=$row[iden_evo];
					$cup_evo=$row[codigo];
			
					$sql="Update hist_var SET esta_var='$esta_ord' WHERE iden_var='$iden_var'";
					//echo $sql;
					mysql_query($sql);
				}	
				
				
			}	
			mysql_query("INSERT INTO `vitac_orden` ( `iden_labs`, `iden_evo`,`cup_vord` ,`fech_vord`, `hora_vord`, `codu_vord`, `eord_vord`, `dato_vord`, `resp_vord`) 
					VALUES ('$id_ing', '$iden_evo', '$cup_evo','$fech_qxf', '$hora', '$codusu', '$esta_ord', '$datos','$Gidusulab')");
			
		}
		
		
		echo "<body onload='regresar()'>";
		
		
?>		