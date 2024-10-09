<?
SET_TIME_LIMIT(0);
?> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head><title>Cambio Cups</title>
<script language="javascript">
function valida()
{
  
	alert('toy');
	form1.control.value=1;
  	form1.submit();
}


</script>

</head>
<?php
echo "<body>";
echo "<form name=form1 method=post target=''>";
		include('php/conexion.php');
echo"<br><br>
<table width='70%'>
   <tr><td class='Th0' align='center'><STRONG>Cambio CUPS</strong></td></tr>
 </table>
<br><br>
<table align='center' width='40%' border='0'>";
	 echo"<td  width='4%' align='left'><input type=button value=enviar onClick='valida()'></td> </tr></table>";

	if($control==1)
	{

		echo"<br>";
		echo"<table width=70%>";
		echo"<tr><th class=Th0 align='center'><STRONG>LABORATORIOS ESPECIALES</strong></td></tr>";
		echo"</table>";
		
		$conspro=mysql_query("SELECT codigo	FROM cups WHERE esta_cup='IN'");
		
		if((mysql_num_rows($conspro)<>'0'))
		{
		    while($rowcon=mysql_fetch_array($conspro))
			  {
			      
				  
				  $codigo=$rowcon[codigo];
				  $cue_cod=strlen($codigo);
				 // echo $cue_cod.'<br>';
				  if($cue_cod=='5')
				  {
					$codigo1='0'.$codigo;
					//echo 'codigoo'.$codigo;
				  
					  //echo $codigo;
					$consu=mysql_query("SELECT iden_cups,tipo_cups FROM cups2 WHERE iden_cups='$codigo1'");
					//echo $consu;
					if((mysql_num_rows($consu)<>'0'))
					{
							while($row=mysql_fetch_array($consu))
							{
								$prmtz=$row[tipo_cups];
								$cod=$rowcon[codigo];
								echo 'tipo'.$prmtz.'<br>';
								
								$ins_=mysql_query("UPDATE `proinsalud`.`cups` SET prmt_cup='$prmtz', `esta_cup`='AC' WHERE codigo='$codigo'");		
								//echo 'aqui1'.$ins_.'<br>';
								//Echo "Los cambios se hicieron satisfactoriamente...";
							}
					}
				  }
				  else
				  {	
					$consu=mysql_query("SELECT iden_cups,tipo_cups FROM cups2 WHERE iden_cups='$codigo'");
					//echo $consu;
					if((mysql_num_rows($consu)<>'0'))
					{
							while($row=mysql_fetch_array($consu))
							{
								$prmtz=$row[tipo_cups];
								$cod=$rowcon[codigo];
								//echo 'tipo'.$prmtz.'<br>';
								
								$ins_=mysql_query("UPDATE `proinsalud`.`cups` SET prmt_cup='$prmtz', `esta_cup`='AC' WHERE codigo='$codigo'");		
								//echo 'aqui2'.$ins_.'<br>';
								//Echo "Los cambios se hicieron satisfactoriamente...";
							}
					}
				  }

			  }
			  
			
		}
	}	
	echo"<input type=text name='control' value=$control>";


echo"</form>";
?>
</body>
</html>