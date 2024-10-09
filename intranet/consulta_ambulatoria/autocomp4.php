<?php
session_register('Gcod_mediconh'); 
session_register('Gareanh'); 
session_register('Gcontratonh');

include ('php/conexion1.php');

$consultamag="SELECT REGMAG_CON FROM contrato WHERE CODI_CON='$Gcontratonh'";
$consultamag=mysql_query($consultamag);
$rowmag=mysql_fetch_array($consultamag);
$regmag_con=$rowmag[REGMAG_CON];


	if($Gareanh==4)
	{
		$codiclasi='3';
		if($regmag_con!='S') 
		{
			$contrato1='1'; //even_mdi evento 
		}
		else
		{
			$contrato1='3'; //magh_mdi magisterio hospitalario
		}		
	}	
	else
	{
		if($Gareanh=='84')
		{
			$codiclasi='3';
			if($regmag_con!='S') 
			{
				$contrato1='1'; //even_mdi evento
			}
			else
			{
				$contrato1='3'; //magh_mdi magisterio hospitalario
			}		
		}
		else
		{		
			$codiclasi='5';
			if($regmag_con!='S') 
			{
				$contrato1='4'; //evam_mdi evento ambulatorio (nueva eps municipios)
			}
			else
			{
				$contrato1='2'; //maga_mdi magisterio ambulatorio
			}
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
	//$sql = "SELECT nomb_des, codi_des FROM destipos Where codt_des='06' and nomb_des LIKE '%$q%' ORDER BY nomb_des";
	if($contrato1==1)$condi='even_mdi';
	if($contrato1==2)$condi='maga_mdi';
	if($contrato1==3)$condi='magh_mdi';
	if($contrato1==4)$condi='evam_mdi';
	
	$sql="SELECT medicamentos2.codi_mdi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa, clasificacion_lbm.just_cla, clasificacion_lbm.cond_cla, forma_farmaceutica.unid_ffa, medicamentos2.pos_mdi
	FROM (medicamentos2 INNER JOIN clasificacion_lbm ON medicamentos2.$condi = clasificacion_lbm.clas_cla) INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa
	WHERE (((medicamentos2.nomb_mdi) Like '%$q%') AND medicamentos2.$condi<>'11' AND 
	((clasificacion_lbm.area_cla)='$codiclasi') AND 
	((clasificacion_lbm.cntr_cla)='$contrato1') AND 
	((clasificacion_lbm.time_cla)='$especi') AND 
	((clasificacion_lbm.cump_cla)='S') AND (medicamentos2.habi_mdi='S'))
	ORDER BY medicamentos2.nomb_mdi";
	
	//echo $regmag_con.' '.$sql.'<br><br>';
	
	//SELECT medicamentos2.codi_mdi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa, forma_farmaceutica.unid_ffa, medicamentos2.pos_mdi, medicamentos2.evam_mdi
	//FROM medicamentos2 INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa
	//WHERE (((medicamentos2.nomb_mdi) Like "%$q%") AND ((medicamentos2.pos_mdi)='12') AND ((medicamentos2.evam_mdi)<>'11'));
	
	//$sql="SELECT medicamentos2.codi_mdi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa, clasificacion_lbm.just_cla, clasificacion_lbm.cond_cla, forma_farmaceutica.unid_ffa, medicamentos2.pos_mdi, medicamentos2.evam_mdi, clasificacion_lbm.area_cla, clasificacion_lbm.clas_cla, clasificacion_lbm.cntr_cla, clasificacion_lbm.time_cla, clasificacion_lbm.cump_cla
	//FROM (clasificacion_lbm INNER JOIN medicamentos2 ON clasificacion_lbm.clas_cla = medicamentos2.evam_mdi) INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa
	//WHERE (((medicamentos2.nomb_mdi) Like "%$q%") AND ((medicamentos2.evam_mdi)<>'11') AND ((clasificacion_lbm.area_cla)='$codiclasi') AND ((clasificacion_lbm.clas_cla)='$codiclasi') AND ((clasificacion_lbm.cntr_cla)='$contrato1') AND ((clasificacion_lbm.time_cla)='$especi') AND ((clasificacion_lbm.cump_cla)='S'))";
	
$rsd = mysql_query($sql);
IF ($rsd)
{	
	WHILE($rs = mysql_fetch_array($rsd)) 
	{		
		$cname = trim($rs['nomb_mdi']).' '.trim($rs['desc_ffa']);
		$ccod = trim($rs['codi_mdi']);
		$cjus = trim($rs['just_cla']);
		$posm = trim($rs['pos_mdi']);	
		$unid = trim($rs['unid_ffa']);
		
		if($posm=='12')$posmdi='S';
		else $posmdi='N';
		
		echo "$cname|$ccod|$cjus|$posmdi|$unid\n";
		
		
		
		if($especi==2 && $cjus=='S')
				{
			$bjus=mysql_query("SELECT usuario.CODI_USU, jusambulatoria_enca.prod_eju, jusambulatoria_enca.fjus_eju, jusambulatoria_enca.tiem_eju
			FROM jusambulatoria_enca INNER JOIN usuario ON jusambulatoria_enca.paci_eju = usuario.NROD_USU
			WHERE (((usuario.CODI_USU)='$paciente') AND ((jusambulatoria_enca.prod_eju)='$ccod')) ORDER BY jusambulatoria_enca.fjus_eju");		
			if(mysql_num_rows>0)
			{
				while($row=mysql_fetch_array($bjus))
				{
					$fecha=$row['fjus_eju'];	
					$tiempo=$row['tiem_eju'];
				}
				if(contar_dias($fecha)>$tiempo)
				{
					echo "$cname|$ccod|$cjus|$posmdi|$unid\n";
				}
			}			
		}	
		else	
		{		
			//echo "$cname|$ccod|$cjus|$posmdi|$unid\n";
		}
	}
	echo "NO EXISTE";
}
function contar_dias($fec)
{
	$fechact=date('Ymd');	
	$anoac=substr($fechact,0,4);
	$mesac=substr($fechact,4,2);
	$diaac=substr($fechact,6,2);
	$numactual=gmmktime ( 0, 0, 0, $mesac, $diaac, $anoac);
	$anoju=substr($fec,0,4);
	$mesju=substr($fec,4,2);
	$diaju=substr($fec,6,2);
	$numjusti=gmmktime ( 0, 0, 0, $mesju, $diaju, $anoju);	
	$difer=intval($numactual-$numjusti);
	return $difer;
}
?>
