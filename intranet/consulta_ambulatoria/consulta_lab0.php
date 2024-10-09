<?	
	//session_register('paciente');
?>
<html> 
<head>
<title>INFORMACION USUARIOS *PROINSALUD* </title> 
 <script language='Javascript'>
</script>
</head> 
<body >
<form name="form1" method="POST"  action="adi_espe.php" target="fr2">  
<link rel="stylesheet" href="style.css" type="text/css"/>
<?php	
	echo"<input type=hidden name=iden_labs>
	<input type=hidden name=nd_>";
	$fechoy=date('Y-m-d');
	$ano=date('Y');
	$mesini=date('m');
	$diaini=date('d');
	$anoini=$ano-1;
	$fecini=$anoini.'-'.$mesini.'-'.$diaini;
	$paciente='1068';
	include ('php/conexion1.php');
	/*
	$cons=mysql_query("SELECT detalle_labs.codigo, cups.descrip
	FROM (encabezado_labs INNER JOIN detalle_labs ON encabezado_labs.iden_labs = detalle_labs.iden_labs) INNER JOIN cups ON detalle_labs.codigo = cups.codigo
	WHERE (((encabezado_labs.codi_usu)='$paciente') AND ((encabezado_labs.fche_labs)>='$fecini') AND ((detalle_labs.estd_dlab)='CU'))
	GROUP BY detalle_labs.codigo, cups.descrip ORDER BY cups.descrip");
	*/
	
	$cons=mysql_query("SELECT detalle_labs.codigo, cups.descrip, cups.codi_cup
	FROM (encabezado_labs INNER JOIN detalle_labs ON encabezado_labs.iden_labs = detalle_labs.iden_labs) INNER JOIN cups ON detalle_labs.codigo = cups.codigo
	WHERE (((encabezado_labs.codi_usu)='$paciente') AND ((encabezado_labs.fche_labs)>='$fecini') AND ((detalle_labs.estd_dlab)='CU') AND ((detalle_labs.obsv_dlab) Is Not Null And (detalle_labs.obsv_dlab)<>'' And (detalle_labs.obsv_dlab)<>'f' And (detalle_labs.obsv_dlab)<>'F'))
	GROUP BY detalle_labs.codigo, cups.descrip
	ORDER BY cups.descrip");
	$i=0;
	while($rlab=mysql_fetch_array($cons))
	{
		$labor[$i][0]=$rlab['codi_cup'];
		$labor[$i][1]=$rlab['descrip'];	
		$i=$i+1;
	}
	$result1=mysql_query("SELECT Max(coprol.cod_examen) AS codi, mapii.desc_map
	FROM coprol INNER JOIN mapii ON coprol.cod_examen = mapii.codi_map
	WHERE (((coprol.cod_usu)='$paciente') AND ((coprol.fec_rec)>='$fecini') AND ((coprol.esta_ord)<>'EL'))
	GROUP BY mapii.desc_map");
	while($rlab1=mysql_fetch_array($result1))
	{
		$labor[$i][0]=$rlab1['codi'];
		$labor[$i][1]=$rlab1['desc_map'];	
		$i=$i+1;
	}
	
	
	
	$result2=mysql_query("SELECT Max(cuadroh.cod_examch) AS codi, mapii.desc_map
	FROM cuadroh INNER JOIN mapii ON cuadroh.cod_examch = mapii.codi_map
	WHERE (((cuadroh.fec_rec)>='$fecini') AND ((cuadroh.cod_usu)='$paciente') AND ((cuadroh.esta_ord)<>'EL'))
	GROUP BY mapii.desc_map");
	
	while($rlab2=mysql_fetch_array($result2))
	{
		$labor[$i][0]=$rlab2['codi'];
		$labor[$i][1]=$rlab2['desc_map'].' ERROR';	
		$i=$i+1;
		
	}
	
	
	$result3=mysql_query("SELECT Max(esper.cod_exames) AS codi, mapii.desc_map
	FROM esper INNER JOIN mapii ON esper.cod_exames = mapii.codi_map
	WHERE (((esper.fec_rec)>='$fecini') AND ((esper.cod_usu)='$paciente') AND ((esper.esta_ord)<>'EL'))
	GROUP BY mapii.desc_map");
	while($rlab3=mysql_fetch_array($result3))
	{
		$labor[$i][0]=$rlab3['codi'];
		$labor[$i][1]=$rlab3['desc_map'];	
		$i=$i+1;
	}
	
	$result4=mysql_query("SELECT Max(frotis.cod_examen) AS codi, mapii.desc_map
	FROM frotis INNER JOIN mapii ON frotis.cod_examen = mapii.codi_map
	WHERE (((frotis.fec_ent)>='$fecini') AND ((frotis.cod_usu)='$paciente') AND ((frotis.esta_ord)<>'EL'))
	GROUP BY mapii.desc_map");
	while($rlab4=mysql_fetch_array($result4))
	{
		$labor[$i][0]=$rlab4['codi'];
		$labor[$i][1]=$rlab4['desc_map'];	
		$i=$i+1;
	}
	
	
	$result5=mysql_query("SELECT Max(hcg.cod_examen) AS codi, mapii.desc_map
	FROM hcg INNER JOIN mapii ON hcg.cod_examen = mapii.codi_map
	WHERE (((hcg.fec_rec)>='$fecini') AND ((hcg.cod_usu)='$paciente') AND ((hcg.esta_ord)<>'EL'))
	GROUP BY mapii.desc_map");
	while($rlab5=mysql_fetch_array($result5))
	{
		$labor[$i][0]=$rlab5['codi'];
		$labor[$i][1]=$rlab5['desc_map'];	
		$i=$i+1;
	}
	
	$result6=mysql_query("SELECT Max(detalle_labs.codigo) AS codi, mapii.desc_map
	FROM (labo_lqd INNER JOIN detalle_labs ON labo_lqd.iden_dlab = detalle_labs.iden_dlab) INNER JOIN mapii ON detalle_labs.codigo = mapii.codi_map
	WHERE (((labo_lqd.cod_usu)='$paciente') AND ((labo_lqd.fech_lqd)>='$fecini') AND ((labo_lqd.esta_ord)<>'EL'))
	GROUP BY mapii.desc_map");
	while($rlab6=mysql_fetch_array($result6))
	{
		$labor[$i][0]=$rlab6['codi'];
		$labor[$i][1]=$rlab6['desc_map'];	
		$i=$i+1;
	}
	
	$result7=mysql_query("SELECT Max(uroana.cod_examen) AS codi, mapii.desc_map
	FROM uroana INNER JOIN mapii ON uroana.cod_examen = mapii.codi_map
	WHERE (((uroana.fec_rec)>='$fecini') AND ((uroana.ced_usu)='$paciente') AND ((uroana.esta_ord)<>'EL'))
	GROUP BY mapii.desc_map");
	while($rlab7=mysql_fetch_array($result7))
	{
		$labor[$i][0]=$rlab7['codi'];
		$labor[$i][1]=$rlab7['desc_map'];	
		$i=$i+1;
	}
	
	$result8=mysql_query("SELECT Max(labo_inm.cod_exam) AS codi, mapii.desc_map
	FROM labo_inm INNER JOIN mapii ON labo_inm.cod_exam = mapii.codi_map
	WHERE (((labo_inm.cod_usu)='$paciente') AND ((labo_inm.fec_rec)>='$fecini') AND ((labo_inm.esta_ord)<>'EL'))
	GROUP BY mapii.desc_map");
	while($rlab8=mysql_fetch_array($result8))
	{		
		$labor[$i][0]=$rlab8['codi'];
		$labor[$i][1]=$rlab8['desc_map'];	
		$i=$i+1;
	}
	
	$result9=mysql_query("SELECT Max(labo_bhc.cod_exam) AS codi, mapii.desc_map
	FROM labo_bhc INNER JOIN mapii ON labo_bhc.cod_exam = mapii.codi_map
	WHERE (((labo_bhc.cod_usu)='$paciente') AND ((labo_bhc.fec_rec)>='$fecini') AND ((labo_bhc.esta_ord)<>'EL'))
	GROUP BY mapii.desc_map");
	while($rlab9=mysql_fetch_array($result9))
	{
		$labor[$i][0]=$rlab9['codi'];
		$labor[$i][1]=$rlab9['desc_map'];	
		$i=$i+1;
	}
	
	$result10=mysql_query("SELECT Max(labo_tri.cod_exam) AS codi, mapii.desc_map
	FROM labo_tri INNER JOIN mapii ON labo_tri.cod_exam = mapii.codi_map
	WHERE (((labo_tri.cod_usu)='$paciente') AND ((labo_tri.fec_rec)='$fecini') AND ((labo_tri.esta_ord)<>'EL'))
	GROUP BY mapii.desc_map");
	while($rlab10=mysql_fetch_array($result10))
	{
		$labor[$i][0]=$rlab10['codi'];
		$labor[$i][1]=$rlab10['desc_map'];	
		$i=$i+1;
	}
	
	$result11=mysql_query("SELECT Max(labo_oexa.cod_loex) AS codi, mapii.desc_map
	FROM labo_oexa INNER JOIN mapii ON labo_oexa.cod_loex = mapii.codi_map
	WHERE (((labo_oexa.cod_usu)='$paciente') AND ((labo_oexa.fec_recp)>='$fecini') AND ((labo_oexa.esta_ord)<>'EL'))
	GROUP BY mapii.desc_map");
	while($rlab11=mysql_fetch_array($result11))	
	{
		$labor[$i][0]=$rlab11['codi'];
		$labor[$i][1]=$rlab11['desc_map'];	
		$i=$i+1;
	}
	
	$result12=mysql_query("SELECT Max(dat_varios.cod_examvr) AS codi
	
	FROM dat_varios
	WHERE (((dat_varios.fec_rec)>='$fecini') AND ((dat_varios.cod_usu)='$paciente') AND ((dat_varios.esta_ord)<>'EL'))");
	while($rlab12=mysql_fetch_array($result12))
	{
		$labor[$i][0]=$rlab12['codi'];
		$labor[$i][1]='EXAMENES CUADRO DE VARIOS';	
		$i=$i+1;
	}
	$fin=$i;
	for($i=0;$i<$fin;$i++)
	{
		for($j=0;$j<$fin;$j++)
		{
			if($labor[$j][1]>$labor[$i][1])
			{			
				$aux1=$labor[$j][0];
				$aux2=$labor[$j][1];
				$labor[$j][0]=$labor[$i][0];
				$labor[$j][1]=$labor[$i][1];
				$labor[$i][0]=$aux1;
				$labor[$i][1]=$aux2;
			}
		}	
	}
	$cod='';
	echo"<table class='tbl' border=1>";	
	for($j=0;$j<$fin;$j++)
	{
		$codilab=$labor[$j][0];
		$desclab=$labor[$j][1];
		if($cod!=$codilab)
		{
			echo"<tr><td><a href=consulta_lab1.php?codigo=$codilab&fechaini=$fecini target='TOP'><img src='imagenes/next.jpg' border=0 width=17 height=17 alt='Imprimir' ></a></td>";		
			echo"<td>$codilab</td>
			<td colspan=4>$desclab</td>
			</tr>";	
			$cod=$codilab;
		}
	}	
	echo"</table>";
	
	
?>
	
</form>
</body>
</html>