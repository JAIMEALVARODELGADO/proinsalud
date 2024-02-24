<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/conexion.php');
$existe=0;
$consulta1=mysql_query("SELECT codigo  FROM cups WHERE codigo='$codi_map'");
/*if(mysql_num_rows($consulta1)==0){
    $existe=1;
	?>
	<script language="javaScript">
	   alert("El Código No Existe en el Tarifario CUPS");
	</script>
	<?
}
if(!empty($soat_map)){
	$consulta2=mysql_query("SELECT codi_tar FROM soat WHERE codi_tar='$soat_map'");
	if(mysql_num_rows($consulta2)==0){
	$existe=1;
	?>
    <script language="javaScript">
	   alert("El Código No Existe en el Tarifario SOAT");
   </script>
<?}
}
if(!empty($iss1_map)){
	$consulta3=mysql_query("SELECT codi_tar FROM iss1 WHERE codi_tar='$iss1_map'");
	if(mysql_num_rows($consulta3)==0){
	$existe=1;
	?>
    <script language="javaScript">
		alert("El Código No Existe en el Tarifario ISS - 2001");
	</script>
	<?}
}	 
if(!empty($iss4_map)){
	$consulta4=mysql_query("SELECT codi_tar FROM iss4 WHERE codi_tar='$iss4_map'");
	if(mysql_num_rows($consulta4)==0){
	$existe=1;
	?>
    <script language="javaScript">
	   alert("El Código No Existe en el Tarifario ISS - 2004");
    </script>
    <?
    }
}
if(!empty($mapi_map)){
	$consulta5=mysql_query("SELECT codi_map FROM mapipos WHERE codi_map='$mapi_map'");
	if(mysql_num_rows($consulta5)==0){
	$existe=1;
	?>
    <script language="javaScript">
	   alert("El Código No Existe en MAPIPOS");
   </script>
<?}
}*/
if ($existe==0){
	$sql_="UPDATE mapii SET
	codi_map='$codi_map',
	desc_map='$desc_map',
	nivl_map='$nivl_map',
	clas_map='$clas_map',
	soat_map='$soat_map',
	grusoa_map='$grusoa_map',
	valsoa_map='$valsoa_map',
	iss1_map='$iss1_map',
	uvriss_map=$uvriss_map,
	valiss_map=$valiss_map,
	iss4_map='$iss4_map',
	vris4_map='$vris4_map',
	form_map='$form_map',
	mapi_map='$mapi_map',
	grumap_map='$grumap_map',
	espe_map='$espe_map',
	nivmap_map='$nivmap_map',
	pos_map='$pos_map',
	cconcir_map='$cconcir_map',
	conane_map='$conane_map',
	conayu_map='$conayu_map',
	conder_map='$conder_map',
	conmat_map='$conmat_map' WHERE iden_map='$iden_map'";
	//echo $sql_;
	$sql_=mysql_query($sql_);
	//echo mysql_affected_rows();
	echo "<body onload='location.href=\"busq_mapii.php?cod=$codi_map\"'>";
}
else{
	?>
	<script language="javaScript">
	  history.go(-1);
	</script><?
}
mysql_close();
?>
</body>
</html>







