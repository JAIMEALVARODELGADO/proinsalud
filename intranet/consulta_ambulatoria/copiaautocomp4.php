<?php
session_start();
session_register('datos');
session_register('Gcod_mediconh'); 
session_register('Gareanh'); 
session_register('Gcontratonh');
$link=Mysql_connect("localhost","root","");
if(!$link)echo"no hay conexion";
Mysql_select_db('proinsalud',$link);


if($Gareanh==4)
{
	$codiclasi='4';
}
else
{
	$codiclasi='5';
}	
	if(trim($Gcontratonh)!='002') 
	{
		$contrato1='1';
	}
	else 
	{
		if($codiclasi=='5')
		{
			$contrato1='2';
		}
		else
		{
			$contrato1='3';
		}		
	}	
	$med=mysql_query("SELECT medicos.espe_med
	FROM medicos WHERE (((medicos.cod_medi)='$Gcod_mediconh'))");
	$rowmed = mysql_fetch_array($med);
	$codespe=$rowmed['espe_med'];	
	if($codespe=='2655')$especi='2';
	else $especi='1';
	$q = strtoupper($_GET["q"]);
	IF (!$q) RETURN;	
		if($contrato1==1)
		{
			$sql="SELECT medicamentos2.nomb_mdi, medicamentos2.codi_mdi, clasificacion_lbm.clas_cla, clasificacion_lbm.area_cla, clasificacion_lbm.cntr_cla, clasificacion_lbm.time_cla, clasificacion_lbm.cump_cla, clasificacion_lbm.just_cla, clasificacion_lbm.cond_cla
			FROM medicamentos2 INNER JOIN clasificacion_lbm ON medicamentos2.even_mdi = clasificacion_lbm.clas_cla
			WHERE (((medicamentos2.nomb_mdi) LIKE '%$q%') AND ((clasificacion_lbm.area_cla)='$codiclasi') AND ((clasificacion_lbm.cntr_cla)='$contrato1') AND ((clasificacion_lbm.time_cla)='$especi') AND ((clasificacion_lbm.cump_cla)='S'))
			ORDER BY medicamentos2.nomb_mdi";
		}	
		if($contrato1==2)
		{
			$sql="SELECT medicamentos2.nomb_mdi, medicamentos2.codi_mdi, clasificacion_lbm.clas_cla, clasificacion_lbm.area_cla, clasificacion_lbm.cntr_cla, clasificacion_lbm.time_cla, clasificacion_lbm.cump_cla, clasificacion_lbm.just_cla, clasificacion_lbm.cond_cla
			FROM medicamentos2 INNER JOIN clasificacion_lbm ON medicamentos2.maga_mdi = clasificacion_lbm.clas_cla
			WHERE (((medicamentos2.nomb_mdi) LIKE '%$q%') AND ((clasificacion_lbm.area_cla)='$codiclasi') AND ((clasificacion_lbm.cntr_cla)='$contrato1') AND ((clasificacion_lbm.time_cla)='$especi') AND ((clasificacion_lbm.cump_cla)='S'))
			ORDER BY medicamentos2.nomb_mdi";
		}
		if($contrato1==3)
		{
			$sql="SELECT medicamentos2.nomb_mdi, medicamentos2.codi_mdi, clasificacion_lbm.just_cla, clasificacion_lbm.cond_cla
			FROM medicamentos2 INNER JOIN clasificacion_lbm ON medicamentos2.magh_mdi = clasificacion_lbm.clas_cla
			WHERE (((medicamentos2.nomb_mdi) LIKE '%$q%') AND ((clasificacion_lbm.area_cla)='$codiclasi') AND ((clasificacion_lbm.cntr_cla)='$contrato1') AND ((clasificacion_lbm.time_cla)='$especi') AND ((clasificacion_lbm.cump_cla)='S'))
			ORDER BY medicamentos2.nomb_mdi";
		}
$rsd = mysql_query($sql);
IF ($rsd)
{	
	WHILE($rs = mysql_fetch_array($rsd)) 
	{		
		$cname = $rs['nomb_mdi'].' '.$rs['noco_mdi'].' '.$rs['desc_ffa'];
		$ccod = $rs['codi_mdi'];
		$cjus = $rs['just_cla'];
		$ccla = $rs['cond_cla'];
		ECHO "$cname|$ccod|$cjus|$ccla\n";
	}
	echo "NO EXISTE";
}

?>
