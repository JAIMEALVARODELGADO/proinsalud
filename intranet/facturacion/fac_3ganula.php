<?php
session_start();
?>
<html>
<head>
<title>FACTURACION</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<form name="form1" method="POST" action="fac_3ganula.php" >
<body >
<table class='Tbl0'><td class="Td0" align='center'>ANULACION DE FACTURA</td></table>
<?
include('php/conexion.php');
//echo date("H",time());
$fecha=time();
$fech_anu=date("Y-m-d",$fecha);
$hora=date ("H:i:s",$fecha);
$fech_anu=$fech_anu.' '.$hora;

$consnd="SELECT codi_emp,numerond_emp FROM empresa";
$consnd=mysql_query($consnd);
$rownd=mysql_fetch_array($consnd);
$numerond=$rownd[numerond_emp];
//echo $numerond;

$sql="INSERT INTO anulafac (iden_anu ,iden_fac ,desc_anu,fech_anu,usua_anu,numerond_anu)VALUES (0, '$id_fac', '$motivo','$fech_anu','$Gidusufac','$numerond')";
//echo "<br>".$sql;
mysql_query($sql);
$sql="UPDATE encabezado_factura SET anul_fac ='S' WHERE iden_fac = '$id_fac'";
//echo "<br>".$sql;
mysql_query($sql);
if(mysql_affected_rows()==1){
	$numerond++;
	$sql="UPDATE empresa SET numerond_emp='$numerond' WHERE codi_emp=$rownd[codi_emp]";	
	//echo $sql;
	mysql_query($sql);
}
  
if($duplica=='on'){
    $consultaef="SELECT * FROM encabezado_factura WHERE iden_fac='$id_fac'";
    //echo "<br>".$consultaef;
    $consultaef=mysql_query($consultaef);
    $rowef=mysql_fetch_array($consultaef);    
    $ingreso=$rowef[id_ing];
    if(empty($rowef[id_ing])){$ingreso='null';}
    /*$guarda="INSERT INTO encabezado_factura (iden_fac,id_ing,nume_fac,pref_fac,tipo_fac,feci_fac,fecf_fac,rela_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,vtot_fac,pcop_fac,vcop_fac,pdes_fac,cmod_fac,vnet_fac,esta_fac,enti_fac,anul_fac,usua_fac,frea_fac,nauto_fac)
    VALUES (0,$ingreso,'','','$rowef[tipo_fac]','$rowef[feci_fac]','$rowef[fecf_fac]','',$rowef[codi_usu],'$rowef[codi_con]',$rowef[iden_ctr],'$rowef[cod_cie10]','$rowef[area_fac]',$rowef[vtot_fac],$rowef[pcop_fac],$rowef[vcop_fac],$rowef[pdes_fac],$rowef[cmod_fac],$rowef[vnet_fac],'1','$rowef[enti_fac]','N','$Gidusufac','$fech_anu','$rowef[nauto_fac]')";*/
    $guarda="INSERT INTO encabezado_factura (iden_fac,id_ing,nume_fac,pref_fac,tipo_fac,feci_fac,fecf_fac,rela_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,vtot_fac,pcop_fac,vcop_fac,pdes_fac,cmod_fac,vnet_fac,esta_fac,enti_fac,anul_fac,usua_fac,frea_fac,nauto_fac)
    VALUES (0,$ingreso,'','','$rowef[tipo_fac]','$rowef[feci_fac]','$rowef[fecf_fac]','',$rowef[codi_usu],'$rowef[codi_con]',$rowef[iden_ctr],'$rowef[cod_cie10]','$rowef[area_fac]',$rowef[vtot_fac],$rowef[pcop_fac],$rowef[vcop_fac],$rowef[pdes_fac],$rowef[cmod_fac],$rowef[vnet_fac],'1','$rowef[enti_fac]','N','$rowef[usua_fac]','$fech_anu','$rowef[nauto_fac]')";
    //echo "<br>".$guarda;
    //echo "<br>".mysql_affected_rows();
    $guarda=mysql_query($guarda);
    $nue_iden_fac=mysql_insert_id();
    $consultadf="SELECT * FROM detalle_factura WHERE iden_fac='$id_fac'";
    $consultadf=mysql_query($consultadf);
    while($rowdf=mysql_fetch_array($consultadf)){
        //echo "<br>".$rowdf[iden_dfa];
        $guarda="INSERT INTO detalle_factura(iden_dfa,tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,cod_medi)
        VALUES (0,'$rowdf[tipo_dfa]','$nue_iden_fac','$rowdf[iden_tco]','$rowdf[desc_dfa]',$rowdf[cant_dfa],$rowdf[valu_dfa],'1','$rowdf[nauto_dfa]','$rowdf[cod_medi]')";
        //echo "<br>".$guarda;        
        mysql_query($guarda);
        //echo "<br>".mysql_affected_rows();
        $nue_iden_dfa=mysql_insert_id();    
        if($rowdf[tipo_dfa]=='P'){
            $consultagr="SELECT * FROM grupoxdeta WHERE iden_dfa=$rowdf[iden_dfa]";
            //echo "<br>".$consultagr;
            $consultagr=mysql_query($consultagr);
            if(mysql_num_rows($consultagr)<>0){
                while($rowgr=mysql_fetch_array($consultagr)){
                    //echo "<BR>".$rowgr[iden_gxd];
                    $guarda="INSERT INTO grupoxdeta(iden_gxd,iden_dfa,iden_gxc,valo_gxd)
                        VALUES (0,$nue_iden_dfa,$rowgr[iden_gxc],$rowgr[valo_gxd])";
                    //$consultagr=mysql_query($consultagr);
                    $guarda=mysql_query($guarda);
                    //echo "<br>".mysql_affected_rows();
                }
            }
            mysql_free_result($consultagr);
        }
    }
    mysql_free_result($consultaef);
    mysql_free_result($consultadf);
}
mysql_close();
echo "<body onload='location.href=\"fac_3lisfacanu.php?cod_usu=$nrod_usu\"'>";
?>
</form>
</body>
</html>