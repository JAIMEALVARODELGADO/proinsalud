<html>
<body>
<?
	
	//http://192.168.4.2/intraweb/intranet/consulta_ambulatoria/eli_his_pruebas.php
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);
	
	$buscahis=mysql_query("select * from encabesadohistoria where cous_ehi='260451'");
	$n1=0;$n2=0;$n3=0;$n4=0;$n5=0;$n6=0;$n7=0;$n8=0;$n9=0;$n10=0;$n11=0;$n12=0;$n13=0;
	while($rhis=mysql_fetch_array($buscahis))
	{
		$numhis=$rhis['numc_ehi'];
		$bnum=mysql_query("select * from consultaprincipal where numc_cpl='$numhis'");
		if(mysql_num_rows($bnum)>0)$n1=$n1+1;
		$bnum=mysql_query("select * from encabesadoformula where numc_efo='$numhis'");
		if(mysql_num_rows($bnum)>0)$n2=$n2+1;
		$bnum=mysql_query("select * from medicamentosenv where numc_men='$numhis'");
		if(mysql_num_rows($bnum)>0)$n3=$n3+1;
		$bnum=mysql_query("select * from acompanante where numc_aco='$numhis'");
		if(mysql_num_rows($bnum)>0)$n4=$n4+1;
		$bnum=mysql_query("select * from antefemeninos where numc_afe='$numhis'");
		if(mysql_num_rows($bnum)>0)$n5=$n5+1;
		$bnum=mysql_query("select * from consulta_soap where numc_soap='$numhis'");
		if(mysql_num_rows($bnum)>0)$n6=$n6+1;
		$bnum=mysql_query("select * from diagnosticos2 where numc_di2='$numhis'");
		if(mysql_num_rows($bnum)>0)$n7=$n7+1;		
		$bnum=mysql_query("select * from examenfisico where numc_efi='$numhis'");
		if(mysql_num_rows($bnum)>0)$n8=$n8+1;
		$bnum=mysql_query("select * from complementoexfisico where numc_cef='$numhis'");
		if(mysql_num_rows($bnum)>0)$n9=$n9+1;		
		$bnum=mysql_query("select * from referencia where numc_ref='$numhis'");
		if(mysql_num_rows($bnum)>0)$n10=$n10+1;
		$bnum=mysql_query("select * from detareferencia where numc_dre='$numhis'");
		if(mysql_num_rows($bnum)>0)$n11=$n11+1;
		$bnum=mysql_query("select * from form_nop where iden_med='$numhis'");
		if(mysql_num_rows($bnum)>0)$n12=$n12+1;
		$bnum=mysql_query("select * from encabesadohistoria where numc_ehi='$numhis'");
		if(mysql_num_rows($bnum)>0)$n13=$n13+1;
		
		mysql_query("delete from consultaprincipal where numc_cpl='$numhis'");
		mysql_query("delete from encabesadoformula where numc_efo='$numhis'");
		mysql_query("delete from medicamentosenv where numc_men='$numhis'");		
		mysql_query("delete from acompanante where numc_aco='$numhis'");
		mysql_query("delete from antefemeninos where numc_afe='$numhis'");
		mysql_query("delete from consulta_soap where numc_soap='$numhis'");
		mysql_query("delete from diagnosticos2 where numc_di2='$numhis'");		
		mysql_query("delete from examenfisico where numc_efi='$numhis'");
		mysql_query("delete from complementoexfisico where numc_cef='$numhis'");		
		mysql_query("delete from referencia where numc_ref='$numhis'");
		mysql_query("delete from detareferencia where numc_dre='$numhis'");
		mysql_query("delete from form_nop where iden_med='$numhis'");
		mysql_query("delete from encabesadohistoria where numc_ehi='$numhis'");
		
	}
	echo "<table align=center cellspan=5>
	<tr><td align=center colspan=2>Registros eliminados</td></tr>
	<tr><td>consultaprincipal</td><td>$n1</td></tr>
	<tr><td>encabesadoformula</td><td>$n2</td></tr>
	<tr><td>medicamentosenv</td><td>$n3</td></tr>
	<tr><td>acompanante</td><td>$n4</td></tr>
	<tr><td>antefemeninos</td><td>$n5</td></tr>
	<tr><td>consulta_soap</td><td>$n6</td></tr>
	<tr><td>diagnosticos2</td><td>$n7</td></tr>
	<tr><td>examenfisico</td><td>$n8</td></tr>
	<tr><td>complementoexfisico</td><td>$n9</td></tr>
	<tr><td>referencia</td><td>$n10</td></tr>
	<tr><td>detareferencia</td><td>$n11</td></tr>
	<tr><td>form_nop</td><td>$n12</td></tr>
	<tr><td>encabesadohistoria</td><td>$n13</td></tr>
	</table>";
	
?>
</body>
</html>
