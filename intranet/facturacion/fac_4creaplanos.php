<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<form name='form1' method="POST" action='fac_4creaplanos.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>Generación de Archivos Planos de R I P S</td></tr></table>
<?
include('php/conexion.php');
include('php/funciones.php');
set_time_limit(0);
$condicion="";
if(!empty($factura)){
  $condicion=$condicion."ef.nume_fac='$factura' AND ";}
if(!empty($relacion)){
  $condicion=$condicion."ef.rela_fac='$relacion' AND ";}
if(!empty($pref_fac)){
  $condicion=$condicion."ef.pref_fac='$pref_fac' AND ";}
if(!empty($condicion)){$condicion=substr($condicion,0,strlen($condicion)-5);}
$consulta=mysql_query("SELECT codp_emp,razo_emp,nite_emp FROM empresa");
$row=mysql_fetch_array($consulta);
$codp_emp=$row[codp_emp];
$razo_emp=$row[razo_emp];
$nite_emp=$row[nite_emp];
$archivous='';
$archivoaf='';
$archivoad='';
$archivoac='';
$archivoap='';
$archivoau='';
$archivoah='';
$archivoan='';
$archivoam='';
$archivoat='';
$regus=0;
$regaf=0;
$regac=0;
$regap=0;
$regau=0;
$regah=0;
$regan=0;
$regam=0;
$regat=0;
$regad=0;
echo "<center><table class='Tbl0' border='0'>";
//Aqui genero AF
$consulta="SELECT ef.iden_fac,ef.pref_fac,ef.nume_fac,ef.fcie_fac,ef.feci_fac,ef.fecf_fac,ef.vcop_fac,ef.pdes_fac,ef.vtot_fac,ef.pcop_fac,ef.vnet_fac,ef.cmod_fac,us.tdoc_usu,us.nrod_usu,ccion.nume_ctr,con.ceps_con,con.neps_con
FROM encabezado_factura AS ef
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if (mysql_num_rows($consulta)>0){
  $regaf=mysql_num_rows($consulta);
  $shtml="";
  while ($row=mysql_fetch_array($consulta)){
	$shtml=$shtml.$codp_emp.",";
	$shtml=$shtml.$razo_emp.",";
	$shtml=$shtml."NI,";
	$shtml=$shtml.$nite_emp.",";
	//$shtml=$shtml.$row[nume_fac].",";
  $shtml=$shtml.$row[pref_fac].$row[nume_fac].",";
	$shtml=$shtml.cambiafechadmy($row[fcie_fac]).",";
	$shtml=$shtml.cambiafechadmy($row[feci_fac]).",";
  //$shtml=$shtml.$fecha_ini.",";
	$shtml=$shtml.cambiafechadmy($row[fecf_fac]).",";
	//$shtml=$shtml.$fecha_fin.",";        
	$shtml=$shtml.$row[ceps_con].",";
	$shtml=$shtml.$row[neps_con].",";
	$shtml=$shtml.$row[nume_ctr].",";
	$shtml=$shtml.",";
	$shtml=$shtml.",";
	$copago=$row[vcop_fac]+$row[cmod_fac];
	$shtml=$shtml.$copago.",";
	$shtml=$shtml."0,";
	$descuento=$row[vtot_fac]*($row[pdes_fac]/100);
	$shtml=$shtml.$descuento.",";
	$shtml=$shtml.$row[vnet_fac]."\r\n";
	//echo "<br>".$shtml;
  }
  $archivoaf='AF'.$relacion;
  $scarpeta=""; //carpeta donde guardar el archivo. 
  //debe tener permisos 775 por lo menos 
  $sfile="planos/AF".$relacion.".csv"; //ruta del archivo a generar 
  $fp=fopen($sfile,"w"); 
  fwrite($fp,$shtml); 
  fclose($fp);
  echo "<tr>
            <td class='Td2' width='5%' align='rigth'><a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a></td>
            <td class='Td2' width='95%' align='left'><a href='".$sfile."'><font color=#3300FF><b>Guardar AF</font></a></td>
        </tr>";  

}

//Aqui genero US
$consulta=mysql_query("SELECT us.tdoc_usu,us.nrod_usu,us.regi_usu,us.pape_usu,us.sape_usu,us.pnom_usu,us.snom_usu,us.fnac_usu,us.sexo_usu,us.mate_usu,us.zona_usu,
con.ceps_con
FROM usuario AS us 
INNER JOIN encabezado_factura AS ef ON ef.codi_usu=us.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion GROUP BY us.nrod_usu");
if (mysql_num_rows($consulta)>0){
  $regus=mysql_num_rows($consulta);
  $shtml="";
  while ($row=mysql_fetch_array($consulta)){
    $tpusu=$row[regi_usu];
	if($tpusu=='6'){$tpusu='1';}
	$shtml=$shtml.TRIM(str_replace("\r","",$row[tdoc_usu])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[nrod_usu])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[ceps_con])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$tpusu)).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[pape_usu])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[sape_usu])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[pnom_usu])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[snom_usu])).",";
	$unidad='';
	$edad=calculaedad2($row[fnac_usu],$unidad);
	$unidad=SUBSTR($unidad,0,1);
	switch ($unidad){
	  case 'A':
	    $unidad='1';
		break;
      case 'M':
	    $unidad='2';
		break;
      case 'D':
	    $unidad='3';
		break;
	}
	$shtml=$shtml.TRIM(str_replace("\r","",$edad)).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$unidad)).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[sexo_usu])).",";
	$dep=SUBSTR($row[mate_usu],0,2);
	$mun=SUBSTR($row[mate_usu],2,3);
	$shtml=$shtml.TRIM(str_replace("\r","",$dep)).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$mun)).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[zona_usu]))."\r\n";
	//echo "<br>".$shtml;
  }
  $archivous='US'.$relacion;
  $scarpeta=""; //carpeta donde guardar el archivo. 
  //debe tener permisos 775 por lo menos 
  $sfile="planos/US".$relacion.".csv"; //ruta del archivo a generar 
  $fp=fopen($sfile,"w"); 
  fwrite($fp,$shtml); 
  fclose($fp);
  echo "<tr>
            <td class='Td2' width='5%' align='rigth'><a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a></td>
            <td class='Td2' width='95%' align='left'><a href='".$sfile."'><font color=#3300FF><b>Guardar US</font></a></td>
        </tr>";  
}
$ad="";
//Aqui genero AC
/*$consulta="SELECT consu.codp_fco,consu.fcon_fco,consu.naut_fco,consu.ccon_fco,consu.fina_fco,consu.cext_fco,consu.dxpr_fco,consu.dxr1_fco,consu.dxr2_fco,consu.dxr3_fco,consu.tpdx_fco,consu.valo_fco,consu.cmod_fco,consu.neto_fco,
us.tdoc_usu,us.nrod_usu,
ef.pref_fac,ef.nume_fac
FROM fconsulta AS consu
INNER JOIN encabezado_factura AS ef ON ef.nume_fac=consu.numf_fco
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion";*/
$consulta="SELECT consu.codp_fco,consu.fcon_fco,consu.naut_fco,consu.ccon_fco,consu.fina_fco,consu.cext_fco,consu.dxpr_fco,consu.dxr1_fco,consu.dxr2_fco,consu.dxr3_fco,consu.tpdx_fco,consu.valo_fco,consu.cmod_fco,consu.neto_fco,
us.tdoc_usu,us.nrod_usu,
ef.pref_fac,ef.nume_fac
FROM fconsulta AS consu
INNER JOIN encabezado_factura AS ef ON ef.iden_fac=consu.iden_fac
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if (mysql_num_rows($consulta)>0){
  $regac=mysql_num_rows($consulta);
  $shtml="";
  while ($row=mysql_fetch_array($consulta)){
      //$shtml="";
      $shtml=$shtml.TRIM(str_replace("\r","",$row[pref_fac].$row[nume_fac])).",";      
	$shtml=$shtml.TRIM(str_replace("\r","",$codp_emp)).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[tdoc_usu])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[nrod_usu])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[fcon_fco])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[naut_fco])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[ccon_fco])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[fina_fco])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[cext_fco])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dxpr_fco])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dxr1_fco])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dxr2_fco])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dxr3_fco])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[tpdx_fco])).",";
        //$shtml=$shtml.TRIM(str_replace("\r","",$row[valo_fco])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[neto_fco])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[cmod_fco])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[neto_fco]))."\r\n";
	//echo "<br>".$shtml;
        
        $ad=$ad.TRIM(str_replace("\r","",$row[pref_fac].$row[nume_fac])).",";
        $ad=$ad.TRIM(str_replace("\r","",$codp_emp)).",";
        $ad=$ad.TRIM(str_replace("\r","",'01')).",";
        $ad=$ad.TRIM(str_replace("\r","",'1')).",";
        $ad=$ad.TRIM(str_replace("\r","",$row[neto_fco])).",";
        $ad=$ad.TRIM(str_replace("\r","",$row[neto_fco]));
        $ad=$ad."\r\n";
        $regad++;
  }
  $archivoac='AC'.$relacion;
  $scarpeta=""; //carpeta donde guardar el archivo. 
  //debe tener permisos 775 por lo menos 
  $sfile="planos/AC".$relacion.".csv"; //ruta del archivo a generar 
  $fp=fopen($sfile,"w"); 
  fwrite($fp,$shtml); 
  fclose($fp);
  echo "<tr>
            <td class='Td2' width='5%' align='rigth'><a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a></td>
            <td class='Td2' width='95%' align='left'><a href='".$sfile."'><font color=#3300FF><b>Guardar AC</font></a></td>
        </tr>";
}

//Aqui genero AP
/*$consulta="SELECT proc.regi_fpr,proc.fpro_fpr,proc.naut_fpr,proc.cpro_fpr,proc.ambi_fpr,proc.fina_fpr,proc.pers_fpr,proc.dxpr_fpr,proc.dxre_fpr,proc.cpli_fpr,proc.form_fpr,proc.valo_fpr,
us.tdoc_usu,us.nrod_usu,
ef.pref_fac,ef.nume_fac
FROM fprocedim AS proc
INNER JOIN encabezado_factura AS ef ON ef.nume_fac=proc.numf_fpr
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion";*/
$consulta="SELECT proc.regi_fpr,proc.fpro_fpr,proc.naut_fpr,proc.cpro_fpr,proc.ambi_fpr,proc.fina_fpr,proc.pers_fpr,proc.dxpr_fpr,proc.dxre_fpr,proc.cpli_fpr,proc.form_fpr,proc.valo_fpr,
us.tdoc_usu,us.nrod_usu,
ef.pref_fac,ef.nume_fac
FROM fprocedim AS proc
INNER JOIN encabezado_factura AS ef ON ef.iden_fac=proc.iden_fac
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if (mysql_num_rows($consulta)>0){
  $regap=mysql_num_rows($consulta);
  $shtml="";
  while ($row=mysql_fetch_array($consulta)){
        $shtml=$shtml.TRIM(str_replace("\r","",$row[pref_fac].$row[nume_fac])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$codp_emp)).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[tdoc_usu])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[nrod_usu])).",";
	$shtml=$shtml.$row[fpro_fpr].",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[naut_fpr])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[cpro_fpr])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[ambi_fpr])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[fina_fpr])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[pers_fpr])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dxpr_fpr])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dxre_fpr])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[cpli_fpr])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[form_fpr])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[valo_fpr]))."\r\n";
	//echo "<br>".$shtml;
        
        $ad=$ad.TRIM(str_replace("\r","",$row[pref_fac].$row[nume_fac])).",";
        $ad=$ad.TRIM(str_replace("\r","",$codp_emp)).",";
        $concepto=traeconcep($row[regi_fpr]);        
        $ad=$ad.TRIM(str_replace("\r","",$concepto)).",";
        $ad=$ad.TRIM(str_replace("\r","",'1')).",";
        $ad=$ad.TRIM(str_replace("\r","",$row[valo_fpr])).",";
        $ad=$ad.TRIM(str_replace("\r","",$row[valo_fpr]));
        $ad=$ad."\r\n";
        $regad++;
  }
  $archivoap='AP'.$relacion;
  $scarpeta=""; //carpeta donde guardar el archivo. 
  //debe tener permisos 775 por lo menos 
  $sfile="planos/AP".$relacion.".csv"; //ruta del archivo a generar 
  $fp=fopen($sfile,"w"); 
  fwrite($fp,$shtml); 
  fclose($fp);
  echo "<tr>
            <td class='Td2' width='5%' align='rigth'><a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a></td>
            <td class='Td2' width='95%' align='left'><a href='".$sfile."'><font color=#3300FF><b>Guardar AP</font></a></td>
        </tr>";
}

//Aqui genero AU
/*$consulta="SELECT urg.feci_fur,urg.hori_fur,urg.naut_fur,urg.cext_fur,urg.dxeg_fur,urg.dxre1_fur,urg.dxre2_fur,urg.dxre3_fur,urg.dest_fur,urg.ests_fur,urg.cmue_fur,urg.fece_fur,urg.hore_fur,
us.tdoc_usu,us.nrod_usu,
ef.pref_fac,ef.nume_fac
FROM furgencia AS urg
INNER JOIN encabezado_factura AS ef ON ef.nume_fac=urg.numf_fur
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion";*/
$consulta="SELECT urg.feci_fur,urg.hori_fur,urg.naut_fur,urg.cext_fur,urg.dxeg_fur,urg.dxre1_fur,urg.dxre2_fur,urg.dxre3_fur,urg.dest_fur,urg.ests_fur,urg.cmue_fur,urg.fece_fur,urg.hore_fur,us.tdoc_usu,us.nrod_usu,ef.pref_fac,ef.nume_fac
FROM furgencia AS urg
INNER JOIN encabezado_factura AS ef ON ef.iden_fac=urg.iden_fac
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if (mysql_num_rows($consulta)>0){
  $regau=mysql_num_rows($consulta);
  $shtml="";
  while ($row=mysql_fetch_array($consulta)){
        $shtml=$shtml.TRIM(str_replace("\r","",$row[pref_fac].$row[nume_fac])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$codp_emp)).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[tdoc_usu])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[nrod_usu])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[feci_fur])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[hori_fur])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[naut_fur])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[cext_fur])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dxeg_fur])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dxre1_fur])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dxre2_fur])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dxre3_fur])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dest_fur])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[ests_fur])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[cmue_fur])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[fece_fur])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[hore_fur]))."\r\n";
	//echo "<br>".$shtml;
  }
  $archivoau='AU'.$relacion;
  $scarpeta=""; //carpeta donde guardar el archivo. 
  //debe tener permisos 775 por lo menos 
  $sfile="planos/AU".$relacion.".csv"; //ruta del archivo a generar 
  $fp=fopen($sfile,"w"); 
  fwrite($fp,$shtml); 
  fclose($fp);
  echo "<tr>
            <td class='Td2' width='5%' align='rigth'><a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a></td>
            <td class='Td2' width='95%' align='left'><a href='".$sfile."'><font color=#3300FF><b>Guardar AU</font></a></td>
        </tr>";
}

//Aqui genero AH
/*$consulta="SELECT hos.via_fho,hos.feci_fho,hos.hori_fho,hos.naut_fho,hos.cext_fho,hos.dxin_fho,hos.dxeg_fho,hos.dxre1_fho,hos.dxre2_fho,hos.dxre3_fho,hos.comp_fho,hos.ests_fho,hos.cmue_fho,hos.fece_fho,hos.hore_fho,
us.tdoc_usu,us.nrod_usu,
ef.pref_fac,ef.nume_fac
FROM fhospital AS hos
INNER JOIN encabezado_factura AS ef ON ef.nume_fac=hos.numf_fho
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion";*/
$consulta="SELECT hos.via_fho,hos.feci_fho,hos.hori_fho,hos.naut_fho,hos.cext_fho,hos.dxin_fho,hos.dxeg_fho,hos.dxre1_fho,hos.dxre2_fho,hos.dxre3_fho,hos.comp_fho,hos.ests_fho,hos.cmue_fho,hos.fece_fho,hos.hore_fho,
us.tdoc_usu,us.nrod_usu,
ef.pref_fac,ef.nume_fac
FROM fhospital AS hos
INNER JOIN encabezado_factura AS ef ON ef.iden_fac=hos.iden_fac
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion";
//echo $consulta;
$consulta=mysql_query($consulta);

if (mysql_num_rows($consulta)>0){
  $regah=mysql_num_rows($consulta);
  $shtml="";
  while ($row=mysql_fetch_array($consulta)){
        $shtml=$shtml.TRIM(str_replace("\r","",$row[pref_fac].$row[nume_fac])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$codp_emp)).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[tdoc_usu])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[nrod_usu])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[via_fho])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[feci_fho])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[hori_fho])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[naut_fho])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[cext_fho])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dxin_fho])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dxeg_fho])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dxre1_fho])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dxre2_fho])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[dxre3_fho])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[comp_fho])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[ests_fho])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[cmue_fho])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[fece_fho])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[hore_fho]))."\r\n";
	//echo "<br>".$shtml;
  }
  $archivoah='AH'.$relacion;
  $scarpeta=""; //carpeta donde guardar el archivo. 
  //debe tener permisos 775 por lo menos 
  $sfile="planos/AH".$relacion.".csv"; //ruta del archivo a generar 
  $fp=fopen($sfile,"w"); 
  fwrite($fp,$shtml); 
  fclose($fp);
  echo "<tr>
            <td class='Td2' width='5%' align='rigth'><a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a></td>
            <td class='Td2' width='95%' align='left'><a href='".$sfile."'><font color=#3300FF><b>Guardar AH</font></a></td>
        </tr>";
}
//Aqui genero AN
/*$consulta="SELECT rnac.fnac_fna,rnac.hnac_fna,rnac.edge_fna,rnac.contr_fna,rnac.sexo_fna,rnac.peso_fna,rnac.diag_fna,rnac.cmue_fna,rnac.fmue_fna,rnac.hmue_fna,
us.tdoc_usu,us.nrod_usu,
ef.pref_fac,ef.nume_fac
FROM fnacidos AS rnac
INNER JOIN encabezado_factura AS ef ON ef.nume_fac=rnac.numf_fna
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion";*/
$consulta="SELECT rnac.fnac_fna,rnac.hnac_fna,rnac.edge_fna,rnac.contr_fna,rnac.sexo_fna,rnac.peso_fna,rnac.diag_fna,rnac.cmue_fna,rnac.fmue_fna,rnac.hmue_fna,
us.tdoc_usu,us.nrod_usu,
ef.pref_fac,ef.nume_fac
FROM fnacidos AS rnac
INNER JOIN encabezado_factura AS ef ON ef.iden_fac=rnac.iden_fac
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if (mysql_num_rows($consulta)>0){
  $regam=mysql_num_rows($consulta);
  $shtml="";
  while ($row=mysql_fetch_array($consulta)){
        $shtml=$shtml.TRIM(str_replace("\r","",$row[pref_fac].$row[nume_fac])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$codp_emp)).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[tdoc_usu])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[nrod_usu])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[fnac_fna])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[hnac_fna])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[edge_fna])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[contr_fna])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[sexo_fna])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[peso_fna])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[diag_fna])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[cmue_fna])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[fmue_fna])).",";
	$shtml=$shtml.TRIM(str_replace("\r","",$row[hmue_fna]))."\r\n";
	//echo "<br>".$shtml;
  }
  $archivoam='AN'.$relacion;
  $scarpeta=""; //carpeta donde guardar el archivo. 
  //debe tener permisos 775 por lo menos 
  $sfile="planos/AN".$relacion.".csv"; //ruta del archivo a generar 
  $fp=fopen($sfile,"w"); 
  fwrite($fp,$shtml); 
  fclose($fp);
  echo "<tr>
            <td class='Td2' width='5%' align='rigth'><a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a></td>
            <td class='Td2' width='95%' align='left'><a href='".$sfile."'><font color=#3300FF><b>Guardar AN</font></a></td>
        </tr>";
}
//Aqui genero AM
/*$consulta="SELECT mdi.regi_fme,mdi.naut_fme,mdi.codi_fme,mdi.tipo_fme,mdi.nomb_fme,mdi.form_fme,mdi.conc_fme,mdi.unid_fme,mdi.cant_fme,mdi.vuni_fme,mdi.vtot_fme,
us.tdoc_usu,us.nrod_usu,
ef.pref_fac,ef.nume_fac
FROM fmedicamento AS mdi
INNER JOIN encabezado_factura AS ef ON ef.nume_fac=mdi.numf_fme
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion";*/
$consulta="SELECT mdi.regi_fme,mdi.naut_fme,mdi.codi_fme,mdi.tipo_fme,mdi.nomb_fme,mdi.form_fme,mdi.conc_fme,mdi.unid_fme,mdi.cant_fme,mdi.vuni_fme,mdi.vtot_fme,
us.tdoc_usu,us.nrod_usu,
ef.pref_fac,ef.nume_fac
FROM fmedicamento AS mdi
INNER JOIN encabezado_factura AS ef ON ef.iden_fac=mdi.iden_fac
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if (mysql_num_rows($consulta)>0){
  $regam=mysql_num_rows($consulta);
  $shtml="";
  while ($row=mysql_fetch_array($consulta)){
        $nomb_fme=trim($row[nomb_fme]);        
        $nomb_fme=str_replace(",",".",$nomb_fme);
        $nomb_fme=ereg_replace('[[:space:]]+',' ',$nomb_fme); //Quito el enter(salto de linea
        //echo "<br>".$nomb_fme;
        if($row[cant_fme]>99999){
            //echo "<br>".$row[cant_fos];
            $cant=$row[cant_fme];
            while($cant>0){                
                if($cant>99999){$unidades=99999;}
                else{$unidades=$cant;}
                $shtml=$shtml.TRIM(str_replace("\r","",$row[pref_fac].$row[nume_fac])).",";
                $shtml=$shtml.TRIM(str_replace("\r","",$codp_emp)).",";
                $shtml=$shtml.TRIM(str_replace("\r","",$row[tdoc_usu])).",";
                $shtml=$shtml.TRIM(str_replace("\r","",$row[nrod_usu])).",";
                $shtml=$shtml.TRIM(str_replace("\r","",$row[naut_fme])).",";
                $shtml=$shtml.TRIM(str_replace("\r","",$row[codi_fme])).",";
                $shtml=$shtml.TRIM(str_replace("\r","",$row[tipo_fme])).",";
                $shtml=$shtml.TRIM(str_replace("\r","",$nomb_fme)).",";
                $shtml=$shtml.TRIM(str_replace("\r","",$row[form_fme])).",";
                $shtml=$shtml.TRIM(str_replace("\r","",$row[conc_fme])).",";
                $shtml=$shtml.TRIM(str_replace("\r","",$row[unid_fme])).",";
                $shtml=$shtml.TRIM(str_replace("\r","",$unidades)).",";
                $shtml=$shtml.TRIM(str_replace("\r","",$row[vuni_fme])).",";
                $shtml=$shtml.TRIM(str_replace("\r","",$unidades*$row[vuni_fme]))."\r\n";
                $cant=$cant-99999;
                //echo "<br>".$cant;
                //echo "<br>".$shtml;
            }
        }
        else{
            $shtml=$shtml.TRIM(str_replace("\r","",$row[pref_fac].$row[nume_fac])).",";
            $shtml=$shtml.TRIM(str_replace("\r","",$codp_emp)).",";
            $shtml=$shtml.TRIM(str_replace("\r","",$row[tdoc_usu])).",";
            $shtml=$shtml.TRIM(str_replace("\r","",$row[nrod_usu])).",";
            $shtml=$shtml.TRIM(str_replace("\r","",$row[naut_fme])).",";
            $shtml=$shtml.TRIM(str_replace("\r","",$row[codi_fme])).",";
            $shtml=$shtml.TRIM(str_replace("\r","",$row[tipo_fme])).",";
            $shtml=$shtml.TRIM(str_replace("\r","",$nomb_fme)).",";
            $shtml=$shtml.TRIM(str_replace("\r","",$row[form_fme])).",";
            $shtml=$shtml.TRIM(str_replace("\r","",$row[conc_fme])).",";
            $shtml=$shtml.TRIM(str_replace("\r","",$row[unid_fme])).",";
            $shtml=$shtml.TRIM(str_replace("\r","",$row[cant_fme])).",";
            $shtml=$shtml.TRIM(str_replace("\r","",$row[vuni_fme])).",";
            $shtml=$shtml.TRIM(str_replace("\r","",$row[vtot_fme]))."\r\n";
        }
        //echo "<br>".$shtml;
        
        $ad=$ad.TRIM(str_replace("\r","",$row[pref_fac].$row[nume_fac])).",";
        $ad=$ad.TRIM(str_replace("\r","",$codp_emp)).",";
        $concepto=traeconcep($row[regi_fme]);        
        $ad=$ad.TRIM(str_replace("\r","",$concepto)).",";
        $ad=$ad.TRIM(str_replace("\r","",$row[cant_fme])).",";
        $ad=$ad.TRIM(str_replace("\r","",$row[vuni_fme])).",";
        $total=$row[cant_fme]*$row[vuni_fme];       
        $ad=$ad.TRIM(str_replace("\r","",$total));
        $ad=$ad."\r\n";	
        $regad++;
  }
  //echo "<br>".$shtml;
  $archivoam='AM'.$relacion;
  $scarpeta=""; //carpeta donde guardar el archivo. 
  //debe tener permisos 775 por lo menos 
  $sfile="planos/AM".$relacion.".csv"; //ruta del archivo a generar 
  $fp=fopen($sfile,"w"); 
  fwrite($fp,$shtml); 
  fclose($fp);
  echo "<tr>
            <td class='Td2' width='5%' align='rigth'><a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a></td>
            <td class='Td2' width='95%' align='left'><a href='".$sfile."'><font color=#3300FF><b>Guardar AM</font></a></td>
        </tr>";
}
//Aqui genero AT
/*$consulta="SELECT otr.regi_fos,otr.naut_fos,otr.tpser_fos,otr.cods_fos,otr.noms_fos,otr.cant_fos,otr.vuni_fos,otr.vtot_fos,us.tdoc_usu,us.nrod_usu,ef.pref_fac,ef.nume_fac
FROM fotros_servicios AS otr
INNER JOIN encabezado_factura AS ef ON ef.nume_fac=otr.numf_fos
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion";*/
$consulta="SELECT otr.regi_fos,otr.naut_fos,otr.tpser_fos,otr.cods_fos,otr.noms_fos,otr.cant_fos,otr.vuni_fos,otr.vtot_fos,us.tdoc_usu,us.nrod_usu,ef.pref_fac,ef.nume_fac
FROM fotros_servicios AS otr
INNER JOIN encabezado_factura AS ef ON ef.iden_fac=otr.iden_fac
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if (mysql_num_rows($consulta)>0){
  $regat=mysql_num_rows($consulta);
  $shtml="";
  while ($row=mysql_fetch_array($consulta)){
        $noms_fos=trim($row[noms_fos]);
        $noms_fos=str_replace(",",".",$noms_fos);
        $noms_fos=ereg_replace('[[:space:]]+',' ',$noms_fos); //Quito el enter(salto de linea
        //echo "<br>".$noms_fos;
        if($row[cant_fos]>99999){
            //echo "<br>".$row[cant_fos];
            $cant=$row[cant_fos];
            while($cant>0){                
                if($cant>99999){$unidades=99999;}
                else{$unidades=$cant;}
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[pref_fac].$row[nume_fac])).",";        
                $shtml=$shtml.TRIM(str_replace("\r", "",$codp_emp)).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[tdoc_usu])).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[nrod_usu])).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[naut_fos])).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[tpser_fos])).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[cods_fos])).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$noms_fos)).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$unidades)).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[vuni_fos])).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$unidades*$row[vuni_fos]))."\r\n";
                $cant=$cant-99999;
                //echo "<br>".$cant;
                //echo "<br>".$shtml;
            }
        }
        else{
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[pref_fac].$row[nume_fac])).",";        
                $shtml=$shtml.TRIM(str_replace("\r", "",$codp_emp)).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[tdoc_usu])).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[nrod_usu])).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[naut_fos])).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[tpser_fos])).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[cods_fos])).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$noms_fos)).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[cant_fos])).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[vuni_fos])).",";
                $shtml=$shtml.TRIM(str_replace("\r", "",$row[vtot_fos]))."\r\n";
        }
	//echo "<br>".$shtml;
        
        $ad=$ad.TRIM(str_replace("\r","",$row[pref_fac].$row[nume_fac])).",";
        $ad=$ad.TRIM(str_replace("\r","",$codp_emp)).",";
        $concepto=traeconcep($row[regi_fos]);
        $ad=$ad.TRIM(str_replace("\r","",$concepto)).",";
        $ad=$ad.TRIM(str_replace("\r","",$row[cant_fos])).",";
        $ad=$ad.TRIM(str_replace("\r","",$row[vuni_fos])).",";        
        $ad=$ad.TRIM(str_replace("\r","",$row[vtot_fos]));
        $ad=$ad."\r\n";
        $regad++;
  }
  $archivoat='AT'.$relacion;
  $scarpeta=""; //carpeta donde guardar el archivo. 
  //debe tener permisos 775 por lo menos 
  $sfile="planos/AT".$relacion.".csv"; //ruta del archivo a generar 
  $fp=fopen($sfile,"w"); 
  fwrite($fp,$shtml); 
  fclose($fp);
  echo "<tr>
            <td class='Td2' width='5%' align='rigth'><a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a></td>
            <td class='Td2' width='95%' align='left'><a href='".$sfile."'><font color=#3300FF><b>Guardar AT</font></a></td>
        </tr>";
}

$archivoad='AD'.$relacion;
//Aqui genero CT
$shtml="";
if(!empty($archivous)){
  $shtml=$shtml.$codp_emp.",";
  $hoy=hoy();
  $shtml=$shtml.$hoy.",";
  $shtml=$shtml.$archivous.",";
  $shtml=$shtml.$regus."\r\n";
}
if(!empty($archivoaf)){
  $shtml=$shtml.$codp_emp.",";
  $hoy=hoy();
  $shtml=$shtml.$hoy.",";
  $shtml=$shtml.$archivoaf.",";
  $shtml=$shtml.$regaf."\r\n";
}

if(!empty($archivoad)){
  $shtml=$shtml.$codp_emp.",";
  $hoy=hoy();
  $shtml=$shtml.$hoy.",";
  $shtml=$shtml.$archivoad.",";
  $shtml=$shtml.$regad."\r\n";
}

if(!empty($archivoac)){
  $shtml=$shtml.$codp_emp.",";
  $hoy=hoy();
  $shtml=$shtml.$hoy.",";
  $shtml=$shtml.$archivoac.",";
  $shtml=$shtml.$regac."\r\n";
}
if(!empty($archivoap)){
  $shtml=$shtml.$codp_emp.",";
  $hoy=hoy();
  $shtml=$shtml.$hoy.",";
  $shtml=$shtml.$archivoap.",";
  $shtml=$shtml.$regap."\r\n";
}
if(!empty($archivoau)){
  $shtml=$shtml.$codp_emp.",";
  $hoy=hoy();
  $shtml=$shtml.$hoy.",";
  $shtml=$shtml.$archivoau.",";
  $shtml=$shtml.$regau."\r\n";
}
if(!empty($archivoah)){
  $shtml=$shtml.$codp_emp.",";
  $hoy=hoy();
  $shtml=$shtml.$hoy.",";
  $shtml=$shtml.$archivoah.",";
  $shtml=$shtml.$regah."\r\n";
}
if(!empty($archivoam)){
  $shtml=$shtml.$codp_emp.",";
  $hoy=hoy();
  $shtml=$shtml.$hoy.",";
  $shtml=$shtml.$archivoam.",";
  $shtml=$shtml.$regam."\r\n";
}
if(!empty($archivoat)){
  $shtml=$shtml.$codp_emp.",";
  $hoy=hoy();
  $shtml=$shtml.$hoy.",";
  $shtml=$shtml.$archivoat.",";
  $shtml=$shtml.$regat."\r\n";
}

$scarpeta=""; //carpeta donde guardar el archivo. 
//debe tener permisos 775 por lo menos 
$sfile="planos/CT".$relacion.".csv"; //ruta del archivo a generar 
$fp=fopen($sfile,"w"); 
fwrite($fp,$shtml); 
fclose($fp);
echo "<tr>
        <td class='Td2' width='5%' align='rigth'><a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a></td>
        <td class='Td2' width='95%' align='left'><a href='".$sfile."'><font color=#3300FF><b>Guardar CT</font></a></td>
    </tr>";

$scarpeta=""; //carpeta donde guardar el archivo. 
//debe tener permisos 775 por lo menos 
$sfile="planos/AD".$relacion.".csv"; //ruta del archivo a generar 
$fp=fopen($sfile,"w"); 
fwrite($fp,$ad); 
fclose($fp); 
echo "<tr>
        <td class='Td2' width='5%' align='rigth'><a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a></td>
        <td class='Td2' width='95%' align='left'><a href='".$sfile."'><font color=#3300FF><b>Guardar AD</font></a></td>
    </tr>";
echo "</table>";
/*echo "<br>".$archivous;
echo "<br>".$archivoaf;
echo "<br>".$archivoac;
echo "<br>".$archivoap;
echo "<br>".$archivoau;
echo "<br>".$archivoah;
echo "<br>".$archivoan;
echo "<br>".$archivoam;
echo "<br>".$archivoat;*/
mysql_free_result($consulta);
mysql_close();
?>
<!-- SCRIPT DE ESPERA -->
<!--<script language="javascript" type="text/javascript">
ap_showWaitMessage('waitDiv', 0);
</SCRIPT>-->
</body>
</html>

<?php
function traeconcep($regi_){    
    $cons_="SELECT detalle_factura.iden_dfa, destipos.valo_des AS concepto
    FROM ((detalle_factura INNER JOIN encabezado_factura ON detalle_factura.iden_fac = encabezado_factura.iden_fac) INNER JOIN tarco ON detalle_factura.iden_tco = tarco.iden_tco) INNER JOIN destipos ON tarco.tser_tco = destipos.codi_des
    WHERE (((detalle_factura.iden_dfa)='$regi_'))";
    //echo "<br>".$cons_;
    $cons_=mysql_query($cons_);    
    $row_=mysql_fetch_array($cons_);
    return($row_[concepto]);
}
?>