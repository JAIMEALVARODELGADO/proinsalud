<?php
session_start();
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
	<title>FACTURACION</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<?
  include('php/conexion.php');
  include('php/funciones.php');
  if(!empty($fcie_fac)){$fcie_fac=cambiafecha($fcie_fac);}
  else{$fcie_fac=cambiafecha(hoy());}
  //echo "<br>".$iden_fac;
  //echo "<br>".$fcie_fac
  /*pcop_fac
  pdes_fac
  vcop_fac
  cmod_fac*/
  $consultaef="SELECT ef.pcop_fac,ef.vcop_fac,ef.pdes_fac,ef.cmod_fac FROM encabezado_factura AS ef WHERE ef.iden_fac=$iden_fac";
  //echo "<br>".$consultaef;
  $consultaef=mysql_query($consultaef);
  $rowef=mysql_fetch_array($consultaef);  
  $constot=mysql_query("SELECT SUM(cant_dfa*valu_dfa) as total FROM detalle_factura WHERE iden_fac=$iden_fac");
  $rowtot=mysql_fetch_array($constot);  
  $descuento=round(($rowtot[total]*($rowef[pdes_fac]/100)),0);
  
  if($pref_fac=="FE"){
	  $consulta="SELECT codi_emp,pref_emp,nume_fac FROM empresa";
  }elseif($pref_fac=="PGP"){
	  $consulta="SELECT codi_emp,pref3_emp AS pref_emp,num3_fac AS nume_fac FROM empresa";
  }
  else{//Tipo Interna
      $consulta="SELECT codi_emp,pref2_emp AS pref_emp,num2_fac AS nume_fac FROM empresa";
  }
  
  //echo "<br>".$consulta;
  $consulta=mysql_query($consulta);
  $rowemp=mysql_fetch_array($consulta);
  
  $hoy=cambiafecha(hoy());
  $vrneto=$rowtot[total]-$rowef[vcop_fac]-$rowef[cmod_fac]-$descuento;  
  $sql="UPDATE encabezado_factura SET nume_fac='$rowemp[nume_fac]',pref_fac='$rowemp[pref_emp]',fcie_fac='$fcie_fac',frea_fac='$hoy',esta_fac='2',
          vtot_fac=$rowtot[total],vnet_fac=$vrneto WHERE iden_fac=$iden_fac";
  //echo $sql; 
  mysql_query($sql);
  if(mysql_affected_rows()==1){
    $nume_ant=$rowemp[nume_fac];
    $nume_fac=$rowemp[nume_fac]+1;
    $nume_fac=str_pad($nume_fac,strlen($rowemp[nume_fac]),"0",STR_PAD_LEFT);
    if($pref_fac=="FE"){
        $sql="UPDATE empresa SET nume_fac='$nume_fac' WHERE codi_emp=$rowemp[codi_emp]";
    }elseif($pref_fac=="PGP"){
        $sql="UPDATE empresa SET num3_fac='$nume_fac' WHERE codi_emp=$rowemp[codi_emp]";
    }
    else{
        $sql="UPDATE empresa SET num2_fac='$nume_fac' WHERE codi_emp=$rowemp[codi_emp]";
    }
    mysql_query($sql);
  }
  mysql_free_result($constot);
  mysql_free_result($consulta);
  mysql_free_result($consultaef);
  mysql_close();
?>
<body onload='form1.submit()'>
<form name="form1" method="POST" action="fac_3lisfacanu.php">
<input type='hidden' name='num_fac' value='<?echo $nume_ant;?>'>
</form>
</body>
</html>
<?php
}
?>