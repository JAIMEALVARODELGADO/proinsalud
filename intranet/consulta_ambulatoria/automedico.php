<?php
 
	include ('php/conexion1.php');
	$q = strtoupper($_GET["q"]);

	$sql = mysql_query("SELECT medicos.cod_medi, medicos.nom_medi, destipos.nomb_des
	FROM medicos INNER JOIN destipos ON medicos.espe_med = destipos.codi_des
	WHERE medicos.nom_medi LIKE '%$q%' AND medicos.esta_medi='A' AND destipos.codi_des<>'2655' AND destipos.homo3_des='2'
	ORDER BY medicos.pnom_medi, medicos.snom_medi, medicos.pape_medi, medicos.sape_medi, medicos.nom_medi");


	if(mysql_num_rows($sql)>0)
	{
		WHILE($rs = mysql_fetch_array($sql)) 
		{
			$cid = $rs['cod_medi'];
			$cname = $rs['nom_medi'].' ('.$rs['nomb_des'].')';
			ECHO "$cname|$cid\n";
		}	
	}
	else
	{
		echo "NO EXISTE";
	}
?>























