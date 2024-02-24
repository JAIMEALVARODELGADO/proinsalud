<?
session_start();
//session_register('iden_fac');
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<?
	//echo "<br>".$subtotal;
	//echo"<br>".$copago ;
	//echo"<br>".$descu ;
	//echo"<br>".$vlnet2 ;
    //echo"<br>".$vlcmod;
	
	include('php/conexion.php');
	include('php/funciones.php');
	//echo "<br>UPDATE encabezado_factura SET vtot_fac = $subtotal,pcop_fac = $copago,vcop_fac=$vlcopa,pdes_fac = $descu,cmod_fac=$vlcmod,vnet_fac = $vlnet2 WHERE iden_fac = $iden_fac";
	mysql_query("UPDATE encabezado_factura SET vtot_fac = $subtotal,pcop_fac = $copago,vcop_fac=$vlcopa,pdes_fac = $descu,cmod_fac=$vlcmod,vnet_fac = $vlnet2 WHERE iden_fac = $iden_fac");
	if($cerrarfac=='S'){
	  $consulta=mysql_query("SELECT codi_emp,pref_emp,nume_fac FROM empresa");
          $rowemp=mysql_fetch_array($consulta);
          $hoy=cambiafecha(hoy());
          mysql_query("UPDATE encabezado_factura SET nume_fac='$rowemp[nume_fac]',pref_fac='$rowemp[pref_emp]',fcie_fac='$hoy',esta_fac='2' WHERE iden_fac=$iden_fac");
          //echo mysql_affected_rows();
          $nume_ant=$rowemp[nume_fac];
          $nume_fac=$rowemp[nume_fac]+1;
          $nume_fac=str_pad($nume_fac,strlen($rowemp[nume_fac]),"0",STR_PAD_LEFT);
          mysql_query("UPDATE empresa SET nume_fac='$nume_fac' WHERE codi_emp=$rowemp[codi_emp]");
          mysql_free_result($consulta);
	}
	//echo "<br>afec: ".mysql_affected_rows();
	//echo "<body onload='location.href=\"fac_2finalfactu.php\" target=\"fr02\"'>";		
    mysql_close();
?>
<body onload="form1.submit()">
<form name="form1" method="POST" action="fac_2finalfactu.php" target='fr02'>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</form>
</body>
</html>
