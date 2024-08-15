<html>
<head>
<title>Impresion de Ordenes Laboratorio</title>
   <script language='Javascript'>
function enviar()
	{
	
		form1.action='impre_ordenm.php';
		form1.target='fr031';
		form1.submit();
	
	
	
	}
	</script>
</head>
<form name="form1" method="POST" >
<?		


		mysql_connect("localhost","root",""); 
		mysql_select_db("PROINSALUD");

		echo "<input type=hidden name=it value=$it>";
		echo "<input type=hidden name=jt value=$jt>";
		echo "<input type=hidden name=mcu value=$mcu>";
		
		for($i=0;$i<$mcu;$i++)
		{
			$nomvar='iden_var'.$it.$jt.$i;
			$iden_var=$$nomvar;	
			
			$nomvar='iden_evo'.$it.$jt.$i;	
			$iden_evo=$$nomvar;
			
			
			
			$nomvar='idein'.$it.$jt.$i;	
			$idein=$$nomvar;

		}
		echo"<input type=text name=iden_evo value=$iden_evo>";
		echo"<input type=text name=id_ing value=$idein>";
		
		//echo "<body onload='location.href=\"../uci/impr_ord.php?iden_evo=$iden_evo\"'>";
		echo "<body onload='enviar()'>";
?>
</form>
</body>
</html>