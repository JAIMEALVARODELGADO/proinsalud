<html>
<head>
<title>PROGRAMA DE FACTURACIN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/funciones.php');
include('php/conexion.php');
$fini_ctr=cambiafecha($fini_ctr);
$ffin_ctr=cambiafecha($ffin_ctr);
if(empty($rmon_ctr)){$rmon_ctr="N";}
if(empty($rcop_ctr)){$rcop_ctr="N";}
if(empty($rcuo_ctr)){$rcuo_ctr="N";}
if(empty($rord_ctr)){$rord_ctr="N";}
if(empty($rfdo_ctr)){$rfdo_ctr="N";}
if(empty($rfca_ctr)){$rfca_ctr="N";}
if(empty($rdgr_ctr)){$rdgr_ctr="N";}
if(empty($fmpr_ctr)){$fmpr_ctr="N";}
if(empty($fmme_ctr)){$fmme_ctr="N";}
if(empty($fmin_ctr)){$fmin_ctr="N";}
mysql_query("UPDATE contratacion SET fini_ctr='$fini_ctr',ffin_ctr='$ffin_ctr',mont_ctr=$mont_ctr,rmon_ctr='$rmon_ctr',rcop_ctr='$rcop_ctr',
			rcuo_ctr='$rcuo_ctr',rord_ctr='$rord_ctr',rfdo_ctr='$rfdo_ctr',rfca_ctr='$rfca_ctr',rdgr_ctr='$rdgr_ctr',moda_ctr='$moda_ctr',
			ccon_ctr='$ccon_ctr',debi_ctr='$debi_ctr',pctg_ctr=$pctg_ctr,tari_ctr='$tari_ctr',tpor_crt='$tpor_crt',obse_ctr='$obse_ctr',esta_ctr='$esta_ctr',
			fmpr_ctr='$fmpr_ctr',fmme_ctr='$fmme_ctr',fmin_ctr='$fmin_ctr',rcod_ctr='$rcod_ctr'
            WHERE iden_ctr=$iden_ctr");
mysql_close();
echo "<body onload='location.href=\"fac_creaactxcon.php?iden_ctr=$iden_ctr\"'>";

?>

</body>
</html>