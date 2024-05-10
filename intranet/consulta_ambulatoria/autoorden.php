<?php
session_start();
session_register('Gcod_mediconh'); 
include ('php/conexion1.php');



$q = strtoupper($_GET["q"]);
if (!$q) RETURN;
$sql=mysql_query("select codi_cup AS cod,descrip AS des, nive_cup AS niv, pos_con AS posord, vige_cup as vigencia  
from cups where esta_cup='AC' AND nive_cup<>0 and CONCAT(codi_cup,' ',descrip) LIKE '%$q%' ORDER BY descrip");

/*
mysql_query("insert into usutmp SELECT destipos.codi_des AS cod, CONCAT('REMISION ',destipos.nomb_des) AS des, esta_especialidad.esta_esp AS niv, destipos.homo3_des AS posord, esta_especialidad.vige_esp as vigencia
FROM destipos INNER JOIN esta_especialidad ON destipos.codi_des = esta_especialidad.codi_esp
WHERE destipos.codt_des='06' ORDER BY destipos.nomb_des");
*/
//$sql = mysql_query("select * from usutmp where des LIKE '%$q%' ORDER BY des");


if(mysql_num_rows($sql)>0)
{
	WHILE($rs = mysql_fetch_array($sql)) 
	{
		$cid = $rs['cod'];
		$cname = $rs['des'];
		$nivel = $rs['niv'];
		$posord = $rs['posord'];
		$vigencia = $rs['vigencia'];
		$lar=strlen($cid);
		$cad='';
		if($lar==4 || $lar==6)
		{
			if($lar==4)
			{
				//$cname="REMISION A ".$cname;
				$clase='2';
			}
			else
			{
				$clase='1';
			}
			$ini=substr($cid,0,3);
			if($ini!='890')
			{
				$larniv=strlen($nivel);
				$ini2=substr($cid,0,2);
				if($larniv==1)
				{
					if($nivel<3)
					{
						$nive='CITAS';
						if($ini2<>'87' && $ini2<>'88' && $ini2<>'90')
						{
							$nive='REFERENCIA';
						}
					}
					else			
					{
						$nive='REFERENCIA';
					}
				}
				if($larniv==4)
				{
					
					if($nivel==1402)
					{
						$nive='CITAS';						
					}
					else			
					{
						$nive='REFERENCIA';
					}
				}
				$cname=$cid.' - '.strtoupper($cname)." (".$posord.") ";
				ECHO "$cname|$cid|$nive|$clase|$posord|$vigencia\n";
			}						
		}
	}	
}
else
{
	echo "NO EXISTE";
}
?>























