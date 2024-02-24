<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<form name='form1' method="POST" action='' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>Generación de Archivos Planos de F U R T R A N</td></tr></table>
<?
include('php/conexion.php');
include('php/funciones.php');
set_time_limit(0);
$consemp="SELECT * FROM empresa";
$consemp=mysql_query($consemp);
$rowemp=mysql_fetch_array($consemp);
$codp_emp=$rowemp[codp_emp];
$dire_emp=substr($rowemp[dire_emp],0,28);
$tele_emp=substr($rowemp[tele_emp],0,7);
$consulta="SELECT rec.radant_rec,rec.resp_rec,rec.tipeve_rec,rec.dire_rec,rec.muni_rec,rec.zona_rec,rec.fectra_rec,rec.hortra_rec,rec.codips_rec,rec.totfol_rec,
    vic.tdoc_vic,vic.ndoc_vic,vic.pnom_vic,vic.snom_vic,vic.pape_vic,vic.sape_vic
    FROM ft_reclamacion AS rec
    INNER JOIN ft_victima AS vic ON vic.iden_rec=rec.iden_rec
    WHERE rec.iden_rec='$iden_rec1'";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);

        
echo "<center><table class='Tbl0' border='0'>";
//Aqui genero archivo1
//Datos generales de la reclamacion
$shtml="";
while($row=mysql_fetch_array($consulta)){
    $shtml=$shtml.$row[radant_rec].",";
    $shtml=$shtml.$row[resp_rec].",";
    $shtml=$shtml.$rowemp[razo_emp].",";
    $shtml=$shtml.$codp_emp.",";
    $shtml=$shtml.",,,,,,";
    $shtml=$shtml."1,";
    $shtml=$shtml.",";
    $shtml=$shtml."AAK059,";
    $shtml=$shtml.$dire_emp.",";
    $shtml=$shtml.$tele_emp.",";
    $shtml=$shtml."52,";
    $shtml=$shtml."001,";
    $shtml=$shtml.$row[tdoc_vic].",";
    $shtml=$shtml.$row[ndoc_vic].",";
    $shtml=$shtml.$row[pnom_vic].",";
    $shtml=$shtml.$row[snom_vic].",";
    $shtml=$shtml.$row[pape_vic].",";
    $shtml=$shtml.$row[sape_vic].",";
    $shtml=$shtml.$row[tipeve_rec].",";
    $shtml=$shtml.$row[dire_rec].",";
    $depar='';
    $munic='';
    $munic=traemun2($row[muni_rec],&$depar);
    $shtml=$shtml.$depar.",";
    $shtml=$shtml.$munic.",";
    $shtml=$shtml.$row[zona_rec].',';
    $shtml=$shtml.cambiafechadmy($row[fectra_rec]).',';
    $shtml=$shtml.$row[hortra_rec].',';
    $shtml=$shtml.$row[codips_rec].',';
    $depar='';
    $munic='';
    $munic=traemun2($row[muni_rec],&$depar);
    $shtml=$shtml.$depar.",";
    $shtml=$shtml.$munic.",";
    $shtml=$shtml.$row[totfol_rec];
    $shtml=$shtml."\r\n";
    //echo "<br>".$shtml;
}
//echo $shtml;
$scarpeta=""; //carpeta donde guardar el archivo. 
//debe tener permisos 775 por lo menos 
$fecha=substr(hoy(),0,2).substr(hoy(),3,2).substr(hoy(),6,4);
$sfile="planos/FURTRAN".$codp_emp.$fecha.".csv"; //ruta del archivo a generar 
$fp=fopen($sfile,"w"); 
fwrite($fp,$shtml); 
fclose($fp);
echo "<tr>
        <td class='Td2' width='5%' align='rigth'><a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a></td>
        <td class='Td2' width='95%' align='left'><a href='".$sfile."'><font color=#3300FF><b>Guardar FURTRAN</font></a></td>
      </tr>";
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