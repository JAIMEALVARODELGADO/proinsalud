<?php
session_start();
if($Gidusufac==''){
  ?>
  <script language='javascript'>
  alert("La sesion ha finalizado, porfavor ingrese nuevamente a la aplicación");
  window.top.close();
  </script>
  <?
}

include("fac_validmag.php");
SET_TIME_LIMIT(0);
?>
<html>
<head>
<title>PROGRAMA DE FACTURACION</title>


<SCRIPT LANGUAGE=JavaScript>
function validar(nfac_){
    if(confirm("Desea Generar "+nfac_+" Facturas?")){
        document.form1.submit();
    }
}
</script>

<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body lang=ES  style='tab-interval:35.4pt'>
<!-------------------------------------------- -->
<div ID="waitDiv" style="position:absolute;left:380;top:80;visibility:hidden">
<center>
<table border=0 cellpadding=0 cellspacing=0 width="250"><tr><td bgcolor="#000000">
<table cellpadding=2 cellspacing=1 border=0 width="100%"><tr><td bgcolor="#ffffff">
<center><font color="#0174DF" face="Verdana, Arial, Helvetica, sans-serif" size="3">Procesando la información...</font>
<br><img src="icons/espera.gif" height="40" width="40"><br>
<font size="2" color="#0174DF" face="Verdana, Arial, Helvetica, sans-serif">Espere por favor...</font></center>
</td>
</tr>
</table>
</td></tr>
</table>
</center>
</div>

<script>
    var DHTML = (document.getElementById || document.all || document.layers);
    function ap_getObj(name) {
      if (document.getElementById) {
        return document.getElementById(name).style;
      } else if (document.all) {
        return document.all[name].style;
      } else if (document.layers) {
        return document.layers[name];
      }
    }
    function ap_showWaitMessage(div,flag)  {
      if (!DHTML)
        return;
      var x = ap_getObj(div);
      x.visibility = (flag) ? 'visible':'hidden'
      if(! document.getElementById)
        if(document.layers)
          x.left=280/2;
//      return true;
    }
    ap_showWaitMessage('waitDiv', 1);

</SCRIPT>
<!---------------------------------------------->
<form name='form1' method="POST" action='fac_3infmuescuenta.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>Generando Facturas</td></tr></table><br>
<?
include('php/conexiones_g.php');
include('php/funciones.php');
base_proinsalud();
?>
<center><table class="Tbl0" border=1>	
<?php    
    //Aqui consulto el consecutivo de la cuenta de cobro
    $consultarel="SELECT codi_emp,rela_emp FROM empresa";
    $consultarel=mysql_query($consultarel);
    $rowrel=mysql_fetch_array($consultarel);            

    //Aqui Consulto la cotratracion (tarifario)          
    $nfacturas=0;
    $conscon="SELECT nit_con FROM contrato INNER JOIN contratacion on contratacion.codi_con=contrato.codi_con
    WHERE iden_ctr='$iden_ctr'";
    //echo "<br>".$conscon;
    $conscon=mysql_query($conscon);
    $rowcon=mysql_fetch_array($conscon);
    $enti_fac=$rowcon[nit_con];
    $fcie_fac=cambiafecha($fcie_fac);    

    //Aqui se realiza el proceso de facturar consulta externa
    if($chk_cextern=="on"){
        $condicion="usuario.codi_usu<>0 AND contrato.CODI_CON='002' AND factu_cpl<>'S' AND ";
        if(!empty($fechaini)){$condicion=$condicion."consultaprincipal.feca_cpl>='".cambiafecha($fechaini)."' AND ";}
        if(!empty($fechafin)){$condicion=$condicion."consultaprincipal.feca_cpl<='".cambiafecha($fechafin)."' AND ";}
        $condicion=substr($condicion,0,strlen($condicion)-5);            
        //echo "<br>".$condicion;
        fac_consultaext($condicion,$fcie_fac,$iden_ctr,$enti_fac,$Gidusufac,$rowrel[rela_emp]);
    }

    //Aqui se realiza el proceso de facturar laboratorio            
    if($chk_laborat=="on"){        
        $condicion="usuario.codi_usu<>0 AND contrato.CODI_CON='002' AND factu_dlab<>'S' AND (encabezado_labs.ambi_labs='1' OR encabezado_labs.ambi_labs='3') AND ";
        if(!empty($fechaini)){$condicion=$condicion."encabezado_labs.fche_labs>='".cambiafecha($fechaini)."' AND ";}
        if(!empty($fechafin)){$condicion=$condicion."encabezado_labs.fche_labs<='".cambiafecha($fechafin)."' AND ";}
        $condicion=$condicion."(detalle_labs.estd_dlab = 'CU' OR detalle_labs.estd_dlab = 'RE') ORDER BY encabezado_labs.iden_labs";
        //echo "<br>".$condicion;
        fac_laborat($condicion,$fcie_fac,$iden_ctr,$enti_fac,$Gidusufac,$rowrel[rela_emp]);
    }

    //Aqui se realiza el proceso de facturar imagenología                        
    if($chk_imageno=="on"){        
        $condicion="usuario.codi_usu<>0 AND enca_rips.cont_ecr='002' AND (ISNULL(deta_rips.factu_der) OR deta_rips.factu_der<>'S') AND (enca_rips.ambi_ecr='1' OR enca_rips.ambi_ecr='3') AND enca_rips.serv_ecr='0601' AND lectura_imagen.esta_lec='CU' AND ";
        if(!empty($fechaini)){$condicion=$condicion."lectura_imagen.fech_lec>='".cambiafecha($fechaini)." 00:00' AND ";}
        if(!empty($fechafin)){$condicion=$condicion."lectura_imagen.fech_lec<='".cambiafecha($fechafin)." 24:00' AND ";}
        $condicion=substr($condicion,0,strlen($condicion)-5);
        $condicion=$condicion." ORDER BY enca_rips.iden_ecr";                
        //echo "<br>".$condicion;
        fac_imagenologia($condicion,$fcie_fac,$iden_ctr,$enti_fac,$Gidusufac,$rowrel[rela_emp]);
    }

    //Aqui se realiza el proceso de facturar medicación                        
    if($chk_medicam=="on"){
        $condicion="formulamae.ccos_for='3' AND ((formulamae.tido_for)=1 Or (formulamae.tido_for)=2 Or (formulamae.tido_for)=6) AND formuladet.cdis_for>0 AND formuladet.factu_for<>'S' AND ((formulamae.scco_for)=4 Or (formulamae.scco_for)=5 Or (formulamae.scco_for)=12 Or (formulamae.scco_for)=15 Or (formulamae.scco_for)=16 Or (formulamae.scco_for)=17) AND ";
        if(!empty($fechaini)){$condicion=$condicion."formulamae.fdis_for>='".cambiafecha($fechaini)."' AND ";}
        if(!empty($fechafin)){$condicion=$condicion."formulamae.fdis_for<='".cambiafecha($fechafin)."' AND ";}
        $condicion=substr($condicion,0,strlen($condicion)-5);
        $condicion=$condicion." ORDER BY formulamae.nume_for";
        //echo "<br>".$condicion;
        fac_medicamen($condicion,$fcie_fac,$iden_ctr,$enti_fac,$Gidusufac,$rowrel[rela_emp]);
    }
  ?>
</table>
<?php 
    //echo "<br>".$error;
    //if($error==0){
        base_proinsalud();
        echo "Se generaron <b>".$nfacturas."</b> facturas, con la relación <b>".$rowrel[rela_emp]."</b>";
        $nuevarel=str_pad($rowrel[rela_emp]+1,strlen($rowrel[rela_emp]),'0',STR_PAD_LEFT);                
        mysql_query("UPDATE empresa SET rela_emp='$nuevarel' WHERE codi_emp=$rowrel[codi_emp]");
        echo "<input type='hidden' name='relacion' value='$rowrel[rela_emp]'>";
        echo "<br><br><a href='#' onclick='javascript:document.form1.submit()'>Crear la Cuenta de Cobro</a>";
    //}
?>

</form>

<?php
    mysql_close();
?>
</body>
<script language="javascript" type="text/javascript">
<!--
ap_showWaitMessage('waitDiv', 0);
//-->
</SCRIPT>
</html>

<?php
function fac_consultaext($condi_,$fcie_fac,$iden_ctr,$enti_fac,$usua_fac,$relacion){
    $hoy=cambiafecha(hoy());    
    /*$sql_="SELECT consultaprincipal.iden_cpl,consultaprincipal.feca_cpl AS fecha_con, encabesadohistoria.cous_ehi, encabesadohistoria.cont_ehi, consultaprincipal.cod1_cpl AS cod_cie10, consultaprincipal.come_cpl AS medico, medicos.nom_medi, medicos.cupmp_medi, medicos.cupmc_medi, consultaprincipal.numc_cpl, usuario.TDOC_USU, usuario.NROD_USU, consultaprincipal.area_cpl, areas.nom_areas AS AREA, consultaprincipal.fina_cpl, consultaprincipal.caex_cpl, consultaprincipal.tidx_cpl, consultaprincipal.coan_cpl AS CONSULTA_EN_AÑO, consultaprincipal.come_cpl, usuario.TPAF_USU, consultaprincipal.hora_cpl, areas.nom_areas, consultaprincipal.feca_cpl, consultaprincipal.codi_cpl, consultaprincipal.coan_cpl, consultaprincipal.fina_cpl, consultaprincipal.caex_cpl
    FROM medicos INNER JOIN ((((consultaprincipal INNER JOIN encabesadohistoria ON consultaprincipal.numc_cpl = encabesadohistoria.numc_ehi) INNER JOIN contrato ON encabesadohistoria.cont_ehi = contrato.CODI_CON) INNER JOIN usuario ON encabesadohistoria.cous_ehi = usuario.CODI_USU) INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas) ON medicos.cod_medi = consultaprincipal.come_cpl
    WHERE $condi_";*/
	$sql_="SELECT consultaprincipal.iden_cpl, consultaprincipal.feca_cpl AS fecha_con, encabesadohistoria.cous_ehi, encabesadohistoria.cont_ehi, consultaprincipal.cod1_cpl AS cod_cie10, consultaprincipal.come_cpl AS medico, medicos.nom_medi, medicos.cupmp_medi, medicos.cupmc_medi, consultaprincipal.numc_cpl, usuario.TDOC_USU, usuario.nrod_usu, consultaprincipal.area_cpl, areas.nom_areas AS AREA, consultaprincipal.fina_cpl, consultaprincipal.caex_cpl, consultaprincipal.tidx_cpl, consultaprincipal.coan_cpl AS CONSULTA_EN_AÑO, consultaprincipal.come_cpl, usuario.TPAF_USU, consultaprincipal.hora_cpl, areas.nom_areas, consultaprincipal.feca_cpl, consultaprincipal.codi_cpl, consultaprincipal.coan_cpl, consultaprincipal.fina_cpl, consultaprincipal.caex_cpl
	FROM (medicos INNER JOIN ((((consultaprincipal INNER JOIN encabesadohistoria ON consultaprincipal.numc_cpl = encabesadohistoria.numc_ehi) INNER JOIN contrato ON encabesadohistoria.cont_ehi = contrato.CODI_CON) INNER JOIN usuario ON encabesadohistoria.cous_ehi = usuario.CODI_USU) INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas) ON medicos.cod_medi = consultaprincipal.come_cpl) INNER JOIN cie_10 ON consultaprincipal.cod1_cpl = cie_10.cod_cie10
    WHERE $condi_";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);                        
    while($row=mysql_fetch_array($sql_)){        
        $feci_fac=$row[fecha_con];
        $fecf_fac=$row[fecha_con];                
        $cod_cie10=STRTOUPPER($row[cod_cie10]);        
        //$consarea="SELECT codi_des,nomb_des FROM destipos WHERE codt_des='06' and valo_des='$row[area_cpl]'";
        $consarea="SELECT areas.codi_des,areas.nom_areas FROM areas         
        WHERE cod_areas='$row[area_cpl]'";
        $consarea=mysql_query($consarea);
        $rowarea=mysql_fetch_array($consarea);
        $tipo_dfa="P";
        $iden_tco="";
        $desc_map="";
        $valo_tco="";
        $cups=validacons($row[come_cpl],$row[coan_cpl],$row[cupmp_medi],$row[cupmc_medi]);
        
        validactr($cups,$iden_ctr,$iden_tco,$desc_map,$valo_tco);

        $sql_fac="INSERT INTO encabezado_factura (iden_fac,nume_fac,pref_fac,tipo_fac,feci_fac,fecf_fac,fcie_fac,rela_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,vtot_fac,pcop_fac,vcop_fac,pdes_fac,cmod_fac,vnet_fac,esta_fac,enti_fac,anul_fac,usua_fac,frea_fac,nauto_fac)
        values(0,'','','2','$feci_fac','$fecf_fac','$fcie_fac','$relacion','$row[cous_ehi]','$row[cont_ehi]','$iden_ctr','$cod_cie10','$rowarea[codi_des]','$valo_tco',0,0,0,0,'$valo_tco','1','$enti_fac','N','$usua_fac','$hoy','')";
        //echo "<br><br>".$sql_fac;
        $sql_fac=mysql_query($sql_fac);
        $iden_fac=  mysql_insert_id();

        $sql_det="INSERT INTO detalle_factura (iden_dfa,tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,cod_medi) 
        values(0,'P','$iden_fac','$iden_tco','$desc_map','1','$valo_tco','1','','$row[come_cpl]')";
        //echo "<br>".$sql_det;
        //echo "<br>".$iden_tco." ".$desc_map." ".$valo_tco;
        $sql_det=mysql_query($sql_det);

        $consulta="SELECT codi_emp,pref2_emp,num2_fac FROM empresa";
        $consulta=mysql_query($consulta);
        $rowemp=mysql_fetch_array($consulta);  
        $sql="UPDATE encabezado_factura SET nume_fac='$rowemp[num2_fac]',pref_fac='$rowemp[pref2_emp]',esta_fac='2' WHERE iden_fac=$iden_fac";
        //echo "<br>".$sql;
        mysql_query($sql);
        if(mysql_affected_rows()==1){
            $nume_ant=$rowemp[num2_fac];
            $nume_fac=$rowemp[num2_fac]+1;
            $nume_fac=str_pad($nume_fac,strlen($rowemp[num2_fac]),"0",STR_PAD_LEFT);
            mysql_query("UPDATE empresa SET num2_fac='$nume_fac' WHERE codi_emp=$rowemp[codi_emp]");
            mysql_query("UPDATE consultaprincipal SET factu_cpl='S' WHERE iden_cpl=$row[iden_cpl]");
        }                
        $GLOBALS['nfacturas']++;
    }
}

function fac_laborat($condi_,$fcie_fac,$iden_ctr,$enti_fac,$usua_fac,$relacion){
    //echo "<br>".$condi_;
    //echo "<br>".$iden_ctr;
    //echo "<br>".$fcie_fac;
    $hoy=cambiafecha(hoy());
    $iden_labs="";
    $total=0;
    $sql_="SELECT detalle_labs.iden_dlab, encabezado_labs.iden_labs,encabezado_labs.iden_cita AS area,detalle_labs.fech_dlab, encabezado_labs.codi_usu, encabezado_labs.ctr_labs, encabezado_labs.dxo_labs AS cod_cie10, encabezado_labs.cod_medi,encabezado_labs.ambi_labs, detalle_labs.nord_dlab, usuario.TDOC_USU, usuario.nrod_usu, detalle_labs.codigo
    FROM (((detalle_labs INNER JOIN encabezado_labs ON detalle_labs.iden_labs = encabezado_labs.iden_labs) INNER JOIN usuario ON encabezado_labs.codi_usu = usuario.CODI_USU) INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
    WHERE $condi_";
    //echo "<br>".$sql_;            
    $sql_=mysql_query($sql_);                        
    while($row=mysql_fetch_array($sql_)){
        if($row[iden_labs]<>$iden_labs){            
            //Aqui creo el encabezado de la factura            
            $iden_labs=$row[iden_labs];
            $feci_fac=$row[fech_dlab];
            $fecf_fac=$row[fech_dlab];        
            $cod_cie10=STRTOUPPER($row[cod_cie10]);
            $area=$row[area];
                        
            //Aqui valido el servicio
            $consarea="SELECT codi_des,nomb_des FROM destipos WHERE codi_des='$area'";            
            $consarea=mysql_query($consarea);
            if(mysql_num_rows($consarea)==0){                            
                //Aqui traigo el servicio a partir de la identificacion de la cita
                $consarea="SELECT horarios.cserv_horario, areas.nom_areas, areas.codi_des, destipos.nomb_des
                FROM ((horarios INNER JOIN citas ON horarios.id_horario = citas.id_horario) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) LEFT JOIN destipos ON areas.codi_des = destipos.codi_des
                WHERE (((citas.id_cita)='$area'))";
                //echo "<br>".$consarea;
                $consarea=mysql_query($consarea);                
                $rowarea=mysql_fetch_array($consarea);                
                $area=$rowarea[codi_des];
            }
            
            $tipo_dfa="P";
            $sql_fac="INSERT INTO encabezado_factura (iden_fac,nume_fac,pref_fac,tipo_fac,feci_fac,fecf_fac,fcie_fac,rela_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,vtot_fac,pcop_fac,vcop_fac,pdes_fac,cmod_fac,vnet_fac,esta_fac,enti_fac,anul_fac,usua_fac,frea_fac,nauto_fac)
            values(0,'','','2','$feci_fac','$fecf_fac','$fcie_fac','$relacion','$row[codi_usu]','$row[ctr_labs]','$iden_ctr','$cod_cie10','$area','0',0,0,0,0,'0','1','$enti_fac','N','$usua_fac','$hoy','')";
            //echo "<br><br>".$sql_fac;
            $sql_fac=mysql_query($sql_fac);
            $iden_fac=  mysql_insert_id();
            //Aqui actualizo el numero de la factura
            $consulta="SELECT codi_emp,pref2_emp,num2_fac FROM empresa";
            $consulta=mysql_query($consulta);
            $rowemp=mysql_fetch_array($consulta);  
            $sql="UPDATE encabezado_factura SET nume_fac='$rowemp[num2_fac]',pref_fac='$rowemp[pref2_emp]',esta_fac='2' WHERE iden_fac=$iden_fac";
            //echo $sql;
            mysql_query($sql);
            if(mysql_affected_rows()==1){
                $nume_ant=$rowemp[num2_fac];
                $nume_fac=$rowemp[num2_fac]+1;
                $nume_fac=str_pad($nume_fac,strlen($rowemp[num2_fac]),"0",STR_PAD_LEFT);
                mysql_query("UPDATE empresa SET num2_fac='$nume_fac' WHERE codi_emp=$rowemp[codi_emp]");
            }
            $GLOBALS['nfacturas']++;
            $total=0;
        }
        //Aqui creo el detalle de la factura
        $cups=$row[codigo];
        $iden_tco="";
        $desc_map="";
        $valo_tco="";        
        validactr($cups,$iden_ctr,$iden_tco,$desc_map,$valo_tco);
        $sql_det="INSERT INTO detalle_factura (iden_dfa,tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,cod_medi) 
        values(0,'P','$iden_fac','$iden_tco','$desc_map','1','$valo_tco','1','','$row[cod_medi]')";
        //echo "<br>".$sql_det;                
        $sql_det=mysql_query($sql_det);
        
        //Aqui actualizo el total de la factura
        $total=$total+$valo_tco;
        $sql_tot="UPDATE encabezado_factura SET vtot_fac='$total',vnet_fac='$total' WHERE iden_fac=$iden_fac";
        //echo "<br>".$sql_tot;
        mysql_query($sql_tot);
        $sqlfac="UPDATE detalle_labs SET factu_dlab='S' WHERE iden_dlab=$row[iden_dlab]";
        mysql_query($sqlfac);
    }
}

function fac_imagenologia($condi_,$fcie_fac,$iden_ctr,$enti_fac,$usua_fac,$relacion){    
    $hoy=cambiafecha(hoy());    
    $iden_ecr="";
    $total=0;
    /*$sql_="SELECT usuario.codi_usu, usuario.nrod_usu, enca_rips.fech_ecr, enca_rips.iden_ecr,enca_rips.ambi_ecr, deta_rips.dxpr_der, enca_rips.serv_ecr, enca_rips.fasi_ecr, enca_rips.meds_ecr, deta_rips.codp_der, deta_rips.cant_der, enca_rips.cont_ecr, deta_rips.esta_der,deta_rips.factu_der, lectura_imagen.fech_lec, lectura_imagen.arso_lec, lectura_imagen.esta_lec    
    FROM ((deta_rips INNER JOIN enca_rips ON deta_rips.iden_ecr = enca_rips.iden_ecr) INNER JOIN lectura_imagen ON deta_rips.iden_der = lectura_imagen.iden_var) INNER JOIN usuario ON enca_rips.iden_uco = usuario.CODI_USU
    WHERE $condi_";     */
	$sql_="SELECT usuario.codi_usu, usuario.nrod_usu, enca_rips.fech_ecr, enca_rips.iden_ecr,enca_rips.ambi_ecr, deta_rips.dxpr_der, enca_rips.serv_ecr, enca_rips.fasi_ecr, enca_rips.meds_ecr, deta_rips.codp_der, deta_rips.cant_der, enca_rips.cont_ecr, deta_rips.esta_der,deta_rips.factu_der, lectura_imagen.fech_lec, lectura_imagen.arso_lec, lectura_imagen.esta_lec
    FROM (((deta_rips INNER JOIN enca_rips ON deta_rips.iden_ecr = enca_rips.iden_ecr) INNER JOIN lectura_imagen ON deta_rips.iden_der = lectura_imagen.iden_var) INNER JOIN usuario ON enca_rips.iden_uco = usuario.CODI_USU) INNER JOIN areas ON lectura_imagen.arso_lec = areas.cod_areas
	WHERE $condi_";
    //echo "<br><br>".$sql_;            
    $sql_=mysql_query($sql_);                        
    while($row=mysql_fetch_array($sql_)){        
        if($row[iden_ecr]<>$iden_ecr){
            //Aqui creo el encabezado de la factura            
            $iden_ecr=$row[iden_ecr];            
            $feci_fac=$row[fech_lec];            
            $fecf_fac=$row[fech_lec];
            $cod_cie10=STRTOUPPER($row[dxpr_der]);
            //if($row[ambi_ecr]=="1"){$area_fac="0601";}
            //else{$area_fac="0634";}
            $area=$row[arso_lec];                        
            $consarea="SELECT codi_des,nom_areas FROM areas WHERE cod_areas='$area'";        
            $consarea=mysql_query($consarea);
            $rowarea=mysql_fetch_array($consarea);
            $area_fac=$rowarea[codi_des];
            $tipo_dfa="P";
            $sql_fac="INSERT INTO encabezado_factura (iden_fac,nume_fac,pref_fac,tipo_fac,feci_fac,fecf_fac,fcie_fac,rela_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,vtot_fac,pcop_fac,vcop_fac,pdes_fac,cmod_fac,vnet_fac,esta_fac,enti_fac,anul_fac,usua_fac,frea_fac,nauto_fac)
            values(0,'','','2','$feci_fac','$fecf_fac','$fcie_fac','$relacion','$row[codi_usu]','$row[cont_ecr]','$iden_ctr','$cod_cie10','$area_fac','0',0,0,0,0,'0','1','$enti_fac','N','$usua_fac','$hoy','')";
            //echo "<br><br>".$sql_fac;
            $sql_fac=mysql_query($sql_fac);
            $iden_fac=  mysql_insert_id();
            //Aqui actualizo el numero de la factura
            $consulta="SELECT codi_emp,pref2_emp,num2_fac FROM empresa";
            $consulta=mysql_query($consulta);
            $rowemp=mysql_fetch_array($consulta);
            $sql="UPDATE encabezado_factura SET nume_fac='$rowemp[num2_fac]',pref_fac='$rowemp[pref2_emp]',esta_fac='2' WHERE iden_fac=$iden_fac";
            //echo $sql;
            mysql_query($sql);
            if(mysql_affected_rows()==1){
                $nume_ant=$rowemp[num2_fac];
                $nume_fac=$rowemp[num2_fac]+1;
                $nume_fac=str_pad($nume_fac,strlen($rowemp[num2_fac]),"0",STR_PAD_LEFT);
                mysql_query("UPDATE empresa SET num2_fac='$nume_fac' WHERE codi_emp=$rowemp[codi_emp]");
            }
            $GLOBALS['nfacturas']++;
            $total=0;
        }
        //Aqui creo el detalle de la factura
        $cups=$row[codp_der];
        $iden_tco="";
        $desc_map="";
        $valo_tco="";
        $cant_dfa=$row[cant_der];
        validactr($cups,$iden_ctr,$iden_tco,$desc_map,$valo_tco);
        $sql_det="INSERT INTO detalle_factura (iden_dfa,tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,cod_medi) 
        values(0,'P','$iden_fac','$iden_tco','$desc_map','$cant_dfa','$valo_tco','1','','$row[meds_ecr]')";
        //echo "<br>".$sql_det;                
        $sql_det=mysql_query($sql_det);
        
        //Aqui actualizo el total de la factura
        $total=$total+($cant_dfa*$valo_tco);
        $sql_tot="UPDATE encabezado_factura SET vtot_fac='$total',vnet_fac='$total' WHERE iden_fac=$iden_fac";
        //echo "<br>".$sql_tot;
        mysql_query($sql_tot);
        $sqlfac="UPDATE deta_rips SET factu_der='S' WHERE iden_der=$row[iden_der]";
        mysql_query($sqlfac);
    }
}

function fac_medicamen($condi_,$fcie_fac,$iden_ctr,$enti_fac,$usua_fac,$relacion){
    /*echo "<br>".$condi_;
    echo "<br>".$fcie_fac;
    echo "<br>".$iden_ctr;
    echo "<br>".$enti_fac;    
    echo "<br>".$usua_fac;*/
    base_formedica();
    $hoy=cambiafecha(hoy());    
    $nume_for="";
    $total=0;
    base_formedica();    
    /*$sql_="SELECT formulamae.nume_for, formulamae.fdis_for, formulamae.coduni_usu, formulamae.codi_usu, formulamae.ccos_for,formulamae.scco_for, formulamae.tido_for, formulamae.codi_medi,formuladet.regi_for, formuladet.codi_pro, formuladet.cdis_for
    FROM formulamae INNER JOIN formuladet ON formulamae.nume_for = formuladet.nume_for
    WHERE ".$condi_;*/
    $sql_="SELECT formulamae.nume_for, formulamae.fdis_for,formulamae.codi_medi, formulamae.coduni_usu, formulamae.codi_usu, formulamae.ccos_for, formulamae.scco_for,subcen.codi_des AS area, formulamae.tido_for, formulamae.codi_medi, formuladet.codi_pro, formuladet.cdis_for
    FROM (formulamae 
    INNER JOIN formuladet ON formulamae.nume_for = formuladet.nume_for) 
    INNER JOIN subcen ON formulamae.scco_for = subcen.codi
    WHERE ".$condi_;
    //echo "<br><br>".$sql_;            
    $sql_=mysql_query($sql_);    
    while($row=mysql_fetch_array($sql_)){
        base_proinsalud();
        if($row[nume_for]<>$nume_for){
            //Aqui creo el encabezado de la factura            
            $nume_for=$row[nume_for];
            $feci_fac=$row[fdis_for];
            $fecf_fac=$row[fdis_for];
            //$cod_cie10=STRTOUPPER($row[dxpr_der]);
            $cod_cie10='';            
            $area_fac=$row[area];
            if(empty($area_fac)){
                $area_fac=traeareamed($row[codi_medi]);
            }
            $cups=$row[codi_pro];
            $tipo_dfa='';
            $iden_tco='';        
            validamedctr($cups,$iden_ctr,$iden_tco,$desc_map,$valo_tco,$tipo_dfa);
            //echo "<br>".$cups." ".$iden_ctr." ".$iden_tco." ".$desc_map." ".$valo_tco." ",$tipo_dfa;
            $sql_fac="INSERT INTO encabezado_factura (iden_fac,nume_fac,pref_fac,tipo_fac,feci_fac,fecf_fac,fcie_fac,rela_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,vtot_fac,pcop_fac,vcop_fac,pdes_fac,cmod_fac,vnet_fac,esta_fac,enti_fac,anul_fac,usua_fac,frea_fac,nauto_fac)
            values(0,'','','2','$feci_fac','$fecf_fac','$fcie_fac','$relacion','$row[coduni_usu]','003','$iden_ctr','$cod_cie10','$area_fac','0',0,0,0,0,'0','1','$enti_fac','N','$usua_fac','$hoy','')";
            //echo "<br><br>".$sql_fac;
            $sql_fac=mysql_query($sql_fac);
            $iden_fac=  mysql_insert_id();
            //Aqui actualizo el numero de la factura
            $consulta="SELECT codi_emp,pref2_emp,num2_fac FROM empresa";
            $consulta=mysql_query($consulta);
            $rowemp=mysql_fetch_array($consulta);
            $sql="UPDATE encabezado_factura SET nume_fac='$rowemp[num2_fac]',pref_fac='$rowemp[pref2_emp]',esta_fac='2' WHERE iden_fac=$iden_fac";
            //echo $sql;
            mysql_query($sql);
            if(mysql_affected_rows()==1){
                $nume_ant=$rowemp[num2_fac];
                $nume_fac=$rowemp[num2_fac]+1;
                $nume_fac=str_pad($nume_fac,strlen($rowemp[num2_fac]),"0",STR_PAD_LEFT);
                mysql_query("UPDATE empresa SET num2_fac='$nume_fac' WHERE codi_emp=$rowemp[codi_emp]");
            }
            $GLOBALS['nfacturas']++;
            $total=0;
        }
        //Aqui creo el detalle de la factura
        $cups=$row[codi_pro];
        $iden_tco="";
        $desc_map="";
        $valo_tco="";
        $tipo_dfa="";
        $cant_dfa=$row[cdis_for];
        validamedctr($cups,$iden_ctr,$iden_tco,$desc_map,$valo_tco,$tipo_dfa);
        //echo "<br>".$cups." ".$iden_ctr." ".$iden_tco." ".$desc_map." ".$valo_tco." ",$tipo_dfa;
        $sql_det="INSERT INTO detalle_factura (iden_dfa,tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,cod_medi) 
        values(0,'$tipo_dfa','$iden_fac','$iden_tco','$desc_map','$cant_dfa','$valo_tco','1','','$row[meds_ecr]')";
        //echo "<br>".$sql_det;                
        $sql_det=mysql_query($sql_det);
        
        //Aqui actualizo el total de la factura
        $total=$total+($cant_dfa*$valo_tco);
        $sql_tot="UPDATE encabezado_factura SET vtot_fac='$total',vnet_fac='$total' WHERE iden_fac=$iden_fac";
        //echo "<br>".$sql_tot;
        mysql_query($sql_tot);
        base_formedica();        
        $sqlfac="UPDATE formuladet SET factu_for='S' WHERE regi_for=$row[regi_for]";
        mysql_query($sqlfac);
    }
}
?>
