<?
session_start();
session_register('iden_fac');
session_register('servi_');
$servi_=$servi_dfa;

if(empty($Gidusufac)){
  ?>
  <script language='javascript'>
  alert("La sesion ha finalizado, porfavor ingrese nuevamente a la aplicaci�n");
  window.top.close();
  </script>
  <?
}
else{
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<body>
<form name="form1" method="POST" action="fac_2factupre.php" target='fr02'>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/conexion.php');
include('php/funciones.php');
//echo "<br>".$iden_tco;
//$consultauf="SELECT area_fac FROM encabezado_factura WHERE iden_fac=$iden_fac";

$ingr_='41';
$ufun_='';
$subg_='';
$acti_='';
$sact_='';
$acumular='N';
$existe='N';
switch ($tipo_dfa){
  case 'P':
        /*$consulta="SELECT map.codi_map, map.desc_map as desc_,map.clas_map,map.ufun_map,map.subg_map,map.acti_map,map.sact_map,
                  tar.iden_tco as iden_, tar.valo_tco,des.val2_des
	          FROM tarco AS tar 
		  INNER JOIN mapii AS map ON map.iden_map=tar.iden_map 
                  INNER JOIN destipos AS des ON des.codi_des=map.clas_map
		  WHERE tar.iden_tco=$iden_tco";*/
        $consulta="SELECT map.codi_map, map.desc_map as desc_,map.clas_map,tar.iden_tco as iden_, tar.valo_tco,des.val2_des
        FROM tarco AS tar 
		    INNER JOIN mapii AS map ON map.iden_map=tar.iden_map 
        INNER JOIN destipos AS des ON des.codi_des=map.clas_map
		    WHERE tar.iden_tco=$iden_tco";
        //echo "<br>".$consulta;
        $consulta=mysql_query($consulta);
        if(mysql_num_rows($consulta)<>0){
                $existe='S';
                $rowcon=mysql_fetch_array($consulta);
                //$ufun_=$rowcon[ufun_map];
                //$subg_=$rowcon[subg_map];
                //$acti_=$rowcon[acti_map];
                //$sact_=$rowcon[sact_map];
        }
    break;
  case 'I':
    /*$consulta=mysql_query("SELECT ins.codnue,ins.desc_ins as desc_,tar.iden_tco as iden_, tar.valo_tco
    FROM tarco AS tar 
    INNER JOIN insu_med AS ins ON ins.codnue=tar.iden_map 
    WHERE tar.iden_tco=$iden_tco");*/
    $consulta=mysql_query("SELECT ins.codi_ins,ins.desc_ins as desc_,tar.iden_tco as iden_, tar.valo_tco
    FROM tarco AS tar 
    INNER JOIN insu_med AS ins ON ins.codi_ins=tar.iden_map 
    WHERE tar.iden_tco=$iden_tco");
    if(mysql_num_rows($consulta)<>0){            
      $existe='S';
      $rowcon=mysql_fetch_array($consulta);
    }
    $subg_='01';
	  break;
  case 'M':
	  $consulta="SELECT mdi.codi_mdi,CONCAT(mdi.nomb_mdi,' ',ff.desc_ffa,' ',mdi.noco_mdi) as desc_,tar.iden_tco as iden_, tar.valo_tco
    FROM tarco AS tar 
    INNER JOIN medicamentos2 AS mdi ON mdi.codi_mdi=tar.iden_map 
    INNER JOIN forma_farmaceutica AS ff ON ff.codi_ffa=mdi.coff_mdi
    WHERE tar.iden_tco=$iden_tco";
    //echo $consulta;
    $consulta=mysql_query($consulta);
	  if(mysql_num_rows($consulta)<>0){
      $existe='S';
      $rowcon=mysql_fetch_array($consulta);
	  }
    $subg_='01';
	  break;
}

//echo "<br>".$existe;
if($existe=='N'){
  ?>
  <script language="javaScript">
    alert("No existe el c�digo o la actividad no esta contratada");
  </script>
  <?
}
else{
  //Aqui busco la unidad funcional    
  //$row=mysql_fetch_array($consulta);
  //$acumular=$row[val2_des];
  //$fecservi_dfa=cambiafecha($fecservi_dfa);
  $acumular=$rowcon[val2_des];
  if(empty($valo_tco)){$valo_tco=0;}  
  //$consultadet="SELECT iden_dfa,cant_dfa FROM detalle_factura WHERE tipo_dfa='$tipo_dfa' AND iden_fac=$iden_fac AND iden_tco='$rowcon[iden_]'";
  $consultadet="SELECT iden_dfa,cant_dfa FROM detalle_factura WHERE tipo_dfa='$tipo_dfa' AND iden_fac='$iden_fac' AND iden_tco='$rowcon[iden_]' AND servi_dfa='$servi_dfa'";
  echo "<br>".$consultadet;
  $consultadet=mysql_query($consultadet);
  if(mysql_num_rows($consultadet)<>0 and $acumular<>'N'){
      $rowdet=mysql_fetch_array($consultadet);
      $can_fac=$can_fac+$rowdet[cant_dfa];
      mysql_query("UPDATE detalle_factura SET cant_dfa='$can_fac',valu_dfa='$valo_tco' WHERE  iden_dfa='$rowdet[iden_dfa]'");      
  }
  else{
      //echo "Insertando...";
      $ccont_=$ingr_.$ufun_.$subg_.$acti_.$sact_;      
      /*$inser_="INSERT INTO detalle_factura(iden_dfa,tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,cod_medi)
  			   VALUES(0,'$tipo_dfa','$iden_fac','$rowcon[iden_]','$rowcon[desc_]',$can_fac,$valo_tco,'1','$nauto_dfa','$cod_medi')";*/
      $inser_="INSERT INTO detalle_factura(iden_dfa,tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,cod_medi,servi_dfa)
           VALUES(0,'$tipo_dfa','$iden_fac','$rowcon[iden_]','$rowcon[desc_]',$can_fac,$valo_tco,'1','$nauto_dfa','$cod_medi','$servi_dfa')";
      //echo "<br>".$inser_;
      //$inser_=mysql_query($inser_);
      mysql_query($inser_);
      //echo "<br>".mysql_affected_rows();
  }
  $iden_dfa=mysql_insert_id();
  for($c=0;$c<$i;$c++){
    $var='codichk'.$c;
    if(!empty($$var)){
      $iden_gxc=$$var;
      $var='valorg'.$c;
      $valo_gxd=$$var;
      //echo "<br>INSERT  INTO grupoxdeta(iden_gxd, iden_dfa, iden_gxc,valo_gxd)
      //             VALUES(0,'$iden_dfa','$iden_gxc','$valo_gxd')";
      mysql_query("INSERT  INTO grupoxdeta(iden_gxd, iden_dfa, iden_gxc,valo_gxd)
                   VALUES(0,'$iden_dfa','$iden_gxc','$valo_gxd')");
      //echo mysql_affected_rows();
    }
  }
}		
mysql_free_result($consulta);
mysql_close();
echo "<body onload='location.href=\"fac_2detfactu.php\"'>";		
?>		
</form>
</body>
</html>
<?php
}
?>