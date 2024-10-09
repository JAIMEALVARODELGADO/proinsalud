<?session_register('gfac_num');
//echo $gfac_num;
?>
<html>
<head>
<title></title>

<script languaje="javascript">

function enviar()
{
	form1.action='pac_hosp.php';
	form1.submit();

}
</script>
</head>
<body>
<form name="form1" method="POST" action="pac_hosp.php" target='fr2'>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);

	echo "<input type=text name=itm value=$itm><br>";
	
	for($i=0; $i<$itm ;$i++)
	{
	$nom_var0='obs_'.$i;
	$obs_=$$nom_var0;	
	echo "<br>".$obs_;
	
	
	$nom_var1='ref_'.$i;
	$ref_=$$nom_var1;	
	echo "<br>".$ref_;
	
	$nom_var2='unid_'.$i;
	$uni_=$$nom_var2;
	echo "<br>".$uni_;
	
	}
	
	echo "<input type=text name=item1 value=$item1><br>";
	echo "<input type=text name=item2 value=$item2><br>";
	echo "<input type=text name=ser value=$ser><br>";
	echo "<input type=text name=cod_usu  value='$cod_usu'><br>";
	echo "<input type=text name=num_fac  value='$num_fac'><br>";
	echo "<input type=text name=gfec_ value='$gfec_'><br>";
	echo "<input type=text name=minr value='$ghor_'><br>";
	echo "<input type=text name=codi_medi  value='$codi_medi'><br>";
	echo "<input type=text name=obs_ value='$obs_'><br>";
	echo "<input type=text name=ref_  value='$ref_'><br>";
	echo "<input type=text name=uni_ value='$uni_'><br>";
	
	echo "<input type=text name=vadif value='$vadif'>";
	

	
	
	for($j=0; $j<$vadif ;$j++)
	{
	
	
	$nom_var3='codi_cir'.$j;
	$codi_cir=$$nom_var3;
	echo "<input type=text name=$nom_var3  value=$codi_cir>";
										
	$nom_var4='obs_exa'.$j;
	$obs_exa=$$nom_var4;
	echo "<input type=text name=$nom_var4 size=7   value='$obs_exa'>";
										
	$nom_var5='refe_cup'.$j;
	$refe_cup=$$rowp[refe_cup];
	echo "<input type=text name=$nom_var5 size=7 value ='$refe_cup'>";
										
	$nom_var6='unlab_med'.$j;
	$unlab_med=$$rowp[unlab_med];
	echo "<input type=text name=$nom_var6  size=7 value='$unlab_med'>";
	
	
	}
	
	
	echo "<body onload='enviar()'>";		
?>		

</form>
</body>
</html>