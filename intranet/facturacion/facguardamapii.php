<?php
session_register('codi_mapii');//codigo Cups
session_register('desc_map');
session_register('nive_map');
session_register('pos_map');
session_register('mapi_map');
session_register('grumap_map');
session_register('nivmap_map');
session_register('codi_soat');
session_register('grusoa_map');
session_register('valsoa_map');
session_register('is1_mapi');
session_register('uvriss_map');
session_register('valiss_map');
session_register('is4_mapi');
session_register('cconcir_map');
session_register('cconane_map');
session_register('cconayu_map');
session_register('cconder_map');
session_register('cconmat_map');
session_register('clas_map');
session_register('espe_map');
session_register('form_mapi');

$codi_mapii=$cod_mapi;
$desc_map=$desc_mapii;
$nive_map=$nivl_;
$pos_map=$pos_;
$mapi_map=$mapi_;
$grumap_map=$grumap_;
$nivmap_map=$nivmap_;
$codi_soat=$soat_map;
$grusoa_map=$grusoa_;
$valsoa_map=$valsoa_;
$is1_mapi=$iss1_mapii;
$uvriss_map=$uvriss_;
$valiss_map=$valiss_;
$is4_mapi=$iss4_mapii;
$cconcir_map=$cconcir_;
$cconane_map=$cconane_;
$cconayu_map=$cconayu_;
$cconder_map=$cconder_;
$cconmat_map=$cconmat_;
$clas_map=$clas_mapii;
$espe_map=$espe_;
$form_mapi=$forma;

?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/conexion.php');
$existe=0;
//if ($sclas_mapii=='0101' or $sclas_mapii=='0102' or $sclas_mapii=='0103' or $sclas_mapii=='0104' or $sclas_mapii=='0105' or $sclas_mapii=='0106' or $sclas_mapii=='0107' or $sclas_mapii=='0108' or $sclas_mapii=='0110' or $sclas_mapii=='0102' ){
    //$valicups
    if($valicups<>'on'){
	  $consulta1=mysql_query("SELECT codigo  FROM cups WHERE codigo='$cod_mapi'");
	  if(mysql_num_rows($consulta1)==0){
		  $existe=1;
		  ?>
	       <script language="javaScript">
		   alert("El Código No Existe en el Tarifario CUPS");
		   </script>
		  <?}
    }
	if(!empty($soat_map)){
		$consulta2=mysql_query("SELECT codi_tar FROM soat WHERE codi_tar='$soat_map'");
		if(mysql_num_rows($consulta2)==0){
		$existe=1;
		?>
	       <script language="javaScript">
		   alert("El Código No Existe en el Tarifario SOAT");
		   </script>
		<?}}	
	if(!empty($iss1_mapii)){
		$consulta3=mysql_query("SELECT codi_tar FROM iss1 WHERE codi_tar='$iss1_mapii'");
		if(mysql_num_rows($consulta3)==0){
		$existe=1;
		?>
	       <script language="javaScript">
		   alert("El Código No Existe en el Tarifario ISS - 2001");
		   </script>
		<?}}	 
	if(!empty($iss4_mapii)){
		$consulta4=mysql_query("SELECT codi_tar FROM iss4 WHERE codi_tar='$iss4_mapii'");
		if(mysql_num_rows($consulta4)==0){
		$existe=1;
		?>
	       <script language="javaScript">
		   alert("El Código No Existe en el Tarifario ISS - 2004");
		   </script>
		<?}}
	if(!empty($mapi_)){
		$consulta5=mysql_query("SELECT codi_map FROM mapipos WHERE codi_map='$mapi_'");
		if(mysql_num_rows($consulta5)==0){
		$existe=1;
		?>
	       <script language="javaScript">
		   alert("El Código No Existe en MAPIPOS");
		   </script>
		<?}}
	/*$consulta6=mysql_query("SELECT codi_map FROM mapii WHERE codi_map ='$cod_mapi'");
	if(mysql_num_rows($consulta6)<>0){
	    $existe=1;
		?>
	       <script language="javaScript">
		   alert("El Código CUPS ya se Registro");
		   </script>
		<?}*/
		
	if ($existe==0){
      if(empty($valsoa_)){$valsoa_=0;}
      if(empty($valiss_)){$valiss_=0;}
	  if(empty($uvriss_)){$uvriss_=0;}
	  $sqlinsert="INSERT INTO mapii
	  (codi_map,desc_map,nivl_map,clas_map,soat_map,grusoa_map,valsoa_map,iss1_map,uvriss_map,valiss_map,iss4_map,form_map,mapi_map,grumap_map,espe_map,nivmap_map,pos_map,cconcir_map,conane_map,conayu_map,conder_map,conmat_map,esta_map)
      VALUES('$cod_mapi','$desc_mapii','$nivl_','$clas_mapii','$soat_map','$grusoa_',$valsoa_,'$iss1_mapii',$uvriss_,$valiss_,'$iss4_mapii','$forma','$mapi_','$grumap_','$espe_','$nivmap_','$pos_','$cconcir_','$cconane_','$cconayu_','$cconder_','$cconmat_','AC')";
      //echo $sqlinsert;
      $sqlinsert=mysql_query($sqlinsert);
	  echo mysql_affected_rows();
      unset($_SESSION['codi_mapii']);
      unset($_SESSION['desc_map']);
      unset($_SESSION['nive_map']);
      unset($_SESSION['pos_map']);
      unset($_SESSION['mapi_map']);
      unset($_SESSION['grumap_map']);
      unset($_SESSION['nivmap_map']);
      unset($_SESSION['codi_soat']);
      unset($_SESSION['grusoa_map']);
      unset($_SESSION['valsoa_map']);
      unset($_SESSION['is1_mapi']);
      unset($_SESSION['uvriss_map']);
      unset($_SESSION['valiss_map']);
      unset($_SESSION['is4_mapi']);
      unset($_SESSION['cconcir_map']);
      unset($_SESSION['cconane_map']);
      unset($_SESSION['cconayu_map']);
      unset($_SESSION['cconder_map']);
      unset($_SESSION['cconmat_map']);
      unset($_SESSION['clas_map']);
      unset($_SESSION['espe_map']);
      unset($_SESSION['form_mapi']);
	  echo "<body onload='location.href=\"busq_mapii.php?cod=$cod_mapi\"'>";
    }
	else{
		?>
		<script language="javaScript">
		  //history.go(-1);
		</script><?}

mysql_close();
?>
</body>
</html>
