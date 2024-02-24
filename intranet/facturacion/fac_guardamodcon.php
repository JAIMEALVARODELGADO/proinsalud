<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/conexion.php');
$encontrado=0;
if($nit_con<>$nit_ant){
  $consulta=mysql_query("SELECT nit_con FROM contrato WHERE nit_con='$nit_con'");
  if(mysql_num_rows($consulta)>0){
    $encontrado=1;
  }
}
if($encontrado==0){
  $sql_="UPDATE contrato SET nit_con='$nit_con',neps_con='$neps_con',nomr_con='$nomr_con',ceps_con='$ceps_con',dire_con='$dire_con',tele_con='$tele_con',repr_con='$repr_con',pers_con='$pers_con',chab_con='$chab_con',ctri_con='$ctri_con',tpen_con='$tpen_con',clas_con='$clas_con',esta_con='$esta_con',codi_cdc='$codi_cdc',vige_con='$vige_con',codase_con='$codase_con'
               WHERE codi_con='$codi_con'";
  //echo $sql_;
  mysql_query($sql_);
  $sql_="UPDATE encabezado_factura SET enti_fac='$nit_con'
               WHERE enti_fac='$nit_ant'";
  mysql_query($sql_);  
  $sql_="UPDATE cuenta_cobro SET nit_cco='$nit_con'
               WHERE nit_cco='$nit_ant'";
  mysql_query($sql_);
  echo "<body onload='location.href=\"fac_muestracon.php?nit=$nit_con\"'>";
}
mysql_close();
?>
<center>
<p class=Msg>El NIT <?echo $nit_con;?> ya existe </p>
</center>
<br><center><a href="#" onclick="javascript:history.go(-1)"><b>Regresar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align="top"></a></center>
</body>
</html>