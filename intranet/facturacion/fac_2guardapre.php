<?
session_start();
//session_register('gcotr');
session_register('iden_fac');
//echo "aqui toy".$Gidusufac; 
if(empty($Gidusufac)){
  ?>
  <script language='javascript'>
  alert("La sesion ha finalizado, porfavor ingrese nuevamente a la aplicación");
  window.top.close();
  </script>
  <?
}
else{
?>
<html>
<head>
<script language="JavaScript">
function cargafurips(idenfac_){
    alert(idenfac_);
    window.open("fac_5creafurips.php?iden_fac=idenfac_");
    //
    //,_blank
}
</script>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<body>
<form name="form1" method="POST" action="fac_2factupre.php" target='fr02'>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/conexion.php');
include('php/funciones.php');
$feci_fac=cambiafecha($feci_fac);
$fecf_fac=cambiafecha($fecf_fac);
$frea_fac=cambiafecha(hoy());
$existe=0;
if (!empty($cod_cie10)){
  $consulta1=mysql_query("SELECT cod_cie10 FROM cie_10 where cod_cie10='$cod_cie10'");
  if(mysql_num_rows($consulta1)==0){
    $existe=1;
	?>
	    <script language="javaScript">
		alert("No Existe el Diagnostico");
		history.go(-1);
		</script>
    <?
  }
}
if ($existe==0){
  $guarda="INSERT  INTO encabezado_factura(iden_fac,nume_fac,pref_fac,tipo_fac,feci_fac,fecf_fac,rela_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,vtot_fac, pcop_fac,vcop_fac,pdes_fac,cmod_fac,vnet_fac ,esta_fac,enti_fac,anul_fac,usua_fac,frea_fac,nauto_fac)
		                                   VALUES(0,'','','$tipo_fac','$feci_fac','$fecf_fac','$rela_fac','$codi_usu','$enti','$iden_ctr','$cod_cie10','$servicio',0,0,0,0,0,0,'1','$enti_fac','N','$Gidusufac','$frea_fac','$nauto_fac')";
  //echo $guarda;
  mysql_query($guarda);
  $iden_fac=mysql_insert_id();
  //echo "<br>Afectadas: ".mysql_affected_rows();
  
  //$enti_fac='860037013-6';//quitar  
  $consultacon="SELECT codase_con FROM contrato WHERE nit_con='$enti_fac'";
  //echo $consultacon;
  $consultacon=mysql_query($consultacon);
  $rowcon=mysql_fetch_array($consultacon);
  if(!empty($rowcon[codase_con])){
      
      ?>
        <script language="JavaScript">cargafurips(<?echo $iden_fac;?>);</script>
      <?
  }
  echo "<body onload='location.href=\"fac_2detfactu.php\"'>";
}
?>
</form>
</body>
</html>
<?php
}
?>
