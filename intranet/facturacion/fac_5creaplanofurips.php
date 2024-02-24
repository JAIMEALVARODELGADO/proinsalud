<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<form name='form1' method="POST" action='' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>Generación de Archivos Planos de F U R I P S</td></tr></table>
<?
include('php/conexion.php');
include('php/funciones.php');
set_time_limit(0);
$consemp="SELECT * FROM empresa";
$consemp=mysql_query($consemp);
$rowemp=mysql_fetch_array($consemp);

$codp_emp=$rowemp[codp_emp];

$consulta="SELECT usu.codi_usu,usu.tdoc_usu,usu.nrod_usu,usu.pnom_usu,usu.snom_usu,usu.pape_usu,usu.sape_usu,usu.fnac_usu,usu.sexo_usu,usu.dire_usu,usu.tres_usu,usu.mres_usu,
    ef.nume_fac,mun.nomb_mun,
    rec.resp_rec,rec.radant_rec,rec.iden_fac,rec.nume_rec,rec.codi_usu,rec.cond_rec,rec.natu_rec,rec.desot_rec,rec.direoc_rec,rec.fechoc_rec,rec.horaoc_rec,rec.munioc_rec,rec.zonaoc_rec
    FROM fr_reclamacion AS rec
    INNER JOIN encabezado_factura AS ef ON ef.iden_fac=rec.iden_fac
    INNER JOIN usuario AS usu ON usu.codi_usu=rec.codi_usu
    INNER JOIN municipio AS mun ON mun.codi_mun=rec.munioc_rec
    WHERE rec.iden_rec='$iden_rec1'";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);
$dire_usu=str_replace(',','-',$row[dire_usu]);
$depres='';
$mres_usu=traemun($row[mres_usu],&$depres);
$nume_fac=$row[nume_fac];


        
echo "<center><table class='Tbl0' border='0'>";
//Aqui genero archivo1
//Datos generales de la reclamacion
$shtml="";
$shtml=$shtml.$row[radant_rec].",";
$shtml=$shtml.$row[resp_rec].",";
$shtml=$shtml.$row[nume_fac].",";
$shtml=$shtml.$iden_rec1.",";
$shtml=$shtml.$codp_emp.",";
$shtml=$shtml.$row[pape_usu].",";
$shtml=$shtml.$row[sape_usu].",";
$shtml=$shtml.$row[pnom_usu].",";
$shtml=$shtml.$row[snom_usu].",";
$shtml=$shtml.$row[tdoc_usu].",";
$shtml=$shtml.$row[nrod_usu].",";
$shtml=$shtml.cambiafechadmy($row[fnac_usu]).",";
$shtml=$shtml.$row[sexo_usu].",";
$shtml=$shtml.$dire_usu.",";
$shtml=$shtml.$depres.",";
$shtml=$shtml.$mres_usu.",";
$shtml=$shtml.$row[tres_usu].",";
$shtml=$shtml.$row[cond_rec].",";
$shtml=$shtml.$row[natu_rec].",";
$shtml=$shtml.$row[desot_rec].",";
$shtml=$shtml.$row[direoc_rec].",";
$shtml=$shtml.cambiafechadmy($row[fechoc_rec]).",";
$shtml=$shtml.$row[horaoc_rec].",";
$munioc='';
$depa='';
$munioc=traemun2($row[munioc_rec],&$depa);
$shtml=$shtml.$depa.",";
$shtml=$shtml.$munioc.",";
$shtml=$shtml.$row[zonaoc_rec].",";

//Datos del vehiculo
$consveh="SELECT veh.iden_veh,veh.iden_rec,veh.estase_veh,veh.marca_veh,veh.placa_veh,veh.tipo_veh,veh.codi_con,veh.poliza_veh,veh.finipol_veh,veh.ffinpol_veh,veh.inter_veh,veh.exced_veh,veh.placaseg_veh,veh.tdocseg_veh,veh.ndocseg_veh,veh.placater_veh,veh.tdocter_veh,veh.ndocter_veh,
con.codase_con
FROM fr_vehiculo AS veh 
LEFT JOIN contrato AS con ON con.codi_con=veh.codi_con
WHERE iden_rec='$iden_rec1'";
//echo $consveh;
$consveh=mysql_query($consveh);
$rowveh=mysql_fetch_array($consveh);
$finipol_veh='';
$ffinpol_veh='';
if($rowveh[finipol_veh]<>'0000-00-00'){$finipol_veh=cambiafechadmy($rowveh[finipol_veh]);}
if($rowveh[ffinpol_veh]<>'0000-00-00'){$ffinpol_veh=cambiafechadmy($rowveh[ffinpol_veh]);}
$shtml=$shtml.$rowveh[estase_veh].",";
$shtml=$shtml.$rowveh[marca_veh].",";
$shtml=$shtml.$rowveh[placa_veh].",";
$shtml=$shtml.$rowveh[tipo_veh].",";
$shtml=$shtml.$rowveh[codase_con].",";
$shtml=$shtml.$rowveh[poliza_veh].",";
$shtml=$shtml.$finipol_veh.",";
$shtml=$shtml.$ffinpol_veh.",";
$shtml=$shtml.$rowveh[inter_veh].",";
$shtml=$shtml.$rowveh[exced_veh].",";
$shtml=$shtml.$rowveh[placaseg_veh].",";
$shtml=$shtml.$rowveh[tdocseg_veh].",";
$shtml=$shtml.$rowveh[ndocseg_veh].",";
$shtml=$shtml.$rowveh[placater_veh].",";
$shtml=$shtml.$rowveh[tdocter_veh].",";
$shtml=$shtml.$rowveh[ndocter_veh].",";

//Datos del propietario del vehiculo
$conspro="SELECT tdoc_pro,ndoc_pro,pape_pro,sape_pro,pnom_pro,snom_pro,dire_pro,tele_pro,mres_pro
FROM fr_propietario 
WHERE iden_rec='$iden_rec1'";
//echo "<br>".$conspro;
$conspro=mysql_query($conspro);
$rowpro=mysql_fetch_array($conspro);

$shtml=$shtml.$rowpro[tdoc_pro].",";
$shtml=$shtml.$rowpro[ndoc_pro].",";
$shtml=$shtml.$rowpro[pape_pro].",";
$shtml=$shtml.$rowpro[sape_pro].",";
$shtml=$shtml.$rowpro[pnom_pro].",";
$shtml=$shtml.$rowpro[snom_pro].",";
$shtml=$shtml.$rowpro[dire_pro].",";
$shtml=$shtml.$rowpro[tele_pro].",";
$muni='';
$depa='';
$muni=traemun2($rowpro[mres_pro],&$depa);
$shtml=$shtml.$depa.",";
$shtml=$shtml.$muni.",";

//Datos del conductor
$conscdtor="SELECT pape_con,sape_con,pnom_con,snom_con,tdoc_con,ndoc_con,dire_con,muni_con,tele_con
FROM fr_conductor WHERE iden_rec='$iden_rec1'";
//echo $conscdtor;
$conscdtor=mysql_query($conscdtor);
$rowcdtor=mysql_fetch_array($conscdtor);

$shtml=$shtml.$rowcdtor[pape_con].",";
$shtml=$shtml.$rowcdtor[sape_con].",";
$shtml=$shtml.$rowcdtor[pnom_con].",";
$shtml=$shtml.$rowcdtor[snom_con].",";
$shtml=$shtml.$rowcdtor[tdoc_con].",";
$shtml=$shtml.$rowcdtor[ndoc_con].",";
$shtml=$shtml.$rowcdtor[dire_con].",";
$muni='';
$depa='';
$muni=traemun2($rowcdtor[muni_con],&$depa);
$shtml=$shtml.$depa.",";
$shtml=$shtml.$muni.",";
$shtml=$shtml.$rowcdtor[tele_con].",";

//Datos de la remision
$consrem="SELECT tipo_rem,fech_rem,hsal_rem,nomb_rem,cargo_rem,ipsrec_rem,direips_rem,fing_rem,hing_rem,nomrec_rem,carrec_rem,munrec_rem
FROM fr_remision
WHERE iden_rec='$iden_rec1'";
//echo $consrem;
$consrem=mysql_query($consrem);
$rowrem=mysql_fetch_array($consrem);
$fech_rem='';
$fing_rem='';
if($rowrem[fech_rem]<>'0000-00-00' and $rowrem[fech_rem]<>''){$fech_rem=cambiafechadmy($rowrem[fech_rem]);}
if($rowrem[fing_rem]<>'0000-00-00' and $rowrem[fing_rem]<>''){$fing_rem=cambiafechadmy($rowrem[fing_rem]);}
$shtml=$shtml.$rowrem[tipo_rem].",";
$shtml=$shtml.$fech_rem.",";
$shtml=$shtml.$rowrem[hsal_rem].",";
if(mysql_num_rows($consrem)<>0){$shtml=$shtml.$codp_emp.",";}
else{$shtml=$shtml.",";}
$shtml=$shtml.$rowrem[nomb_rem].",";
$shtml=$shtml.$rowrem[cargo_rem].",";
$shtml=$shtml.$fing_rem.",";
$shtml=$shtml.$rowrem[hing_rem].",";
$shtml=$shtml.$rowrem[ipsrec_rem].",";
$shtml=$shtml.$rowrem[nomrec_rem].",";
$shtml=$shtml.$rowrem[carrec_rem].",";

//Datos del traslado
$constra="SELECT tdoc_tra,ndoc_tra,pape_tra,sape_tra,pnom_tra,snom_tra,placa_tra,recini_tra,recfin_tra,tipser_tra,zona_tra
FROM fr_transporte
WHERE iden_rec='$iden_rec1'";
//echo $constra;
$constra=mysql_query($constra);
$rowtra=mysql_fetch_array($constra);

$shtml=$shtml.$rowtra[placa_tra].",";
$shtml=$shtml.$rowtra[recini_tra].",";
$shtml=$shtml.$rowtra[recfin_tra].",";
$shtml=$shtml.$rowtra[tipser_tra].",";
$shtml=$shtml.$rowtra[zona_tra].",";

//Datos de la atencion
$consate="SELECT aten.fecing_ate,aten.horing_ate,aten.fecsal_ate,aten.horsa_ate,aten.diapri_ate,aten.diaas1_ate,aten.diaas2_ate,aten.dxprieg_ate,aten.dxaseg1_ate,aten.dxaseg2_ate,aten.cod_medi,aten.totfac_ate,aten.totrec_ate,aten.totftra_ate,aten.totrtra_ate,aten.foli_ate,
med.pnom_medi,med.snom_medi,med.pape_medi,med.sape_medi,med.tido_medi,med.ced_medi,med.reg_medi
FROM fr_atencion AS aten
INNER JOIN medicos AS med ON med.cod_medi=aten.cod_medi
WHERE iden_rec='$iden_rec1'";
//echo $consate;
$consate=mysql_query($consate);
$rowate=mysql_fetch_array($consate);

$shtml=$shtml.cambiafechadmy($rowate[fecing_ate]).",";
$shtml=$shtml.$rowate[horing_ate].",";
$shtml=$shtml.cambiafechadmy($rowate[fecsal_ate]).",";
$shtml=$shtml.$rowate[horsa_ate].",";
$shtml=$shtml.$rowate[diapri_ate].",";
$shtml=$shtml.$rowate[diaas1_ate].",";
$shtml=$shtml.$rowate[diaas2_ate].",";
$shtml=$shtml.$rowate[dxprieg_ate].",";
$shtml=$shtml.$rowate[dxaseg1_ate].",";
$shtml=$shtml.$rowate[dxaseg2_ate].",";
$shtml=$shtml.$rowate[pape_medi].",";
$shtml=$shtml.$rowate[sape_medi].",";
$shtml=$shtml.$rowate[pnom_medi].",";
$shtml=$shtml.$rowate[snom_medi].",";
$shtml=$shtml.$rowate[tido_medi].",";
$shtml=$shtml.$rowate[ced_medi].",";
$shtml=$shtml.$rowate[reg_medi].",";
$shtml=$shtml.$rowate[totfac_ate].",";
$shtml=$shtml.$rowate[totrec_ate].",";
$shtml=$shtml.$rowate[totftra_ate].",";
$shtml=$shtml.$rowate[totrtra_ate].",";
$shtml=$shtml.$rowate[foli_ate];
//echo "<br>".$shtml;
$scarpeta=""; //carpeta donde guardar el archivo. 
//debe tener permisos 775 por lo menos 
$fecha=substr(hoy(),0,2).substr(hoy(),3,2).substr(hoy(),6,4);
$sfile="planos/FURIPS1".$codp_emp.$fecha.".csv"; //ruta del archivo a generar 
$fp=fopen($sfile,"w"); 
fwrite($fp,$shtml); 
fclose($fp);
echo "<tr>
        <td class='Td2' width='5%' align='rigth'><a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a></td>
        <td class='Td2' width='95%' align='left'><a href='".$sfile."'><font color=#3300FF><b>Guardar FURIPS1</font></a></td>
      </tr>";


$shtml="";
$consultadet="SELECT * FROM fr_detalle_rec WHERE iden_rec='$iden_rec1' ORDER BY tipser_det,desc_det";
//echo $consultadet;
$consultadet=mysql_query($consultadet);
while($rowdet=mysql_fetch_array($consultadet)){
    $shtml=$shtml.$nume_fac.",";
    $shtml=$shtml.$iden_rec1.",";
    $shtml=$shtml.$rowdet[tipser_det].",";
    if($rowdet[tipser_det]<>'5'){$shtml=$shtml.$rowdet[codi_det].",";}
    else{$shtml=$shtml.",";}    
    $shtml=$shtml.$rowdet[desc_det].",";
    $shtml=$shtml.$rowdet[cant_det].",";
    $shtml=$shtml.$rowdet[valuni_det].",";
    $shtml=$shtml.$rowdet[valtot_det].",";
    $shtml=$shtml.$rowdet[valrec_det]."\r\n";    
}
$scarpeta=""; //carpeta donde guardar el archivo. 
//debe tener permisos 775 por lo menos 
$fecha=substr(hoy(),0,2).substr(hoy(),3,2).substr(hoy(),6,4);
$sfile="planos/FURIPS2".$codp_emp.$fecha.".csv"; //ruta del archivo a generar 
$fp=fopen($sfile,"w"); 
fwrite($fp,$shtml); 
fclose($fp);
echo "<tr>
        <td class='Td2' width='5%' align='rigth'><a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a></td>
        <td class='Td2' width='95%' align='left'><a href='".$sfile."'><font color=#3300FF><b>Guardar FURIPS2</font></a></td>
      </tr>";

echo "</table>";

mysql_free_result($consemp);
mysql_free_result($consulta);
mysql_free_result($consveh);
mysql_free_result($conspro);
mysql_free_result($conscdtor);
mysql_free_result($consrem);
mysql_free_result($constra);
mysql_free_result($consate);
mysql_free_result($consultadet);
mysql_close();
?>
<!-- SCRIPT DE ESPERA -->
<!--<script language="javascript" type="text/javascript">
ap_showWaitMessage('waitDiv', 0);
</SCRIPT>-->
</body>
</html>

<?php
function traemun($mres_,$depres){
    $cons_="SELECT codi_mun,depa_mun FROM municipio WHERE nomb_mun='$mres_'";
    $cons_=mysql_query($cons_);
    $row_=mysql_fetch_array($cons_);
    $codi_=substr($row_[codi_mun],strlen($row_[depa_mun]));
    $depres=$row_[depa_mun];    
    return($codi_);
}

function traemun2($mun_,$depa){    
    $cons_="SELECT codi_mun,depa_mun FROM municipio WHERE codi_mun='$mun_'";
    $cons_=mysql_query($cons_);
    $row_=mysql_fetch_array($cons_);
    $codi_=substr($row_[codi_mun],strlen($row_[depa_mun]));
    $depa=$row_[depa_mun];    
    return($codi_);
}
?>