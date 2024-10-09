<?	
	session_register('paciente');
	//exit();
?>
<html> 
<head>
<title>INFORMACION USUARIOS *PROINSALUD* </title> 
<link rel="stylesheet" href="style.css" type="text/css"/>
 <script language='Javascript'>
function confirma(it,mt)
{
	//alert("envio");
	form1.it.value=it;
	form1.mcu.value=mt;
	//alert(form1.it.value);
	//alert(form1.mcu.value);
	form1.action='edi_orden.php';
	form1.submit();

}


</script>
</head> 
<body >
<form name="form1" method="POST"  action="adi_espe.php" target="fr2">  
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php	
	
	include ('php/conexion1.php');
	//$usu='2051';
	//$iden_uco='2051';
	$cons=mysql_query("SELECT encabesadoformula.codi_usu, encabesadoformula.feco_efo, medicos.nom_medi, areas.nom_areas, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa, medicamentosenv.dosis_med, medicamentosenv.undo_med, medicamentosenv.frec_med, medicamentosenv.unfr_med, medicamentosenv.via_med, medicamentosenv.tiem_med, medicamentosenv.fref_med, medicamentosenv.cant_men, medicamentosenv.obse_men
	FROM ((encabesadoformula INNER JOIN medicos ON encabesadoformula.cod_medi = medicos.cod_medi) INNER JOIN ((medicamentosenv INNER JOIN medicamentos2 ON medicamentosenv.cmed_men = medicamentos2.codi_mdi) INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa) ON encabesadoformula.numc_efo = medicamentosenv.numc_men) INNER JOIN (consultaprincipal INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas) ON encabesadoformula.numc_efo = consultaprincipal.numc_cpl
	WHERE (((encabesadoformula.codi_usu)='$paciente') AND ((consultaprincipal.numc_cpl) Is Not Null And (consultaprincipal.numc_cpl)<>''))
	ORDER BY encabesadoformula.feco_efo DESC");
	echo"
	<BR>
	<table class='tbl' align=center>
	<tr>
	<th colspan=6>HISTORICO DE MEDICAMENTOS FORMULADOS</th>
	
	</tr>
	
	";
	
	if(mysql_num_rows($cons)>0)
	{
		echo"<tr>
		<th>FECHA</th>
		<th>MEDICO</th>
		<th>SERVICIO</th>
		<th>MEDICAMENTO</th>
		<th>POSOLOGIA</th>
		<th>CANTIDAD</th>
		</tr>";
	
	}
	
	while ($rowmed=mysql_fetch_array($cons))
	{	
		$obse=$rowmed['obse_men'];		
		$codi_usu=$rowmed['codi_usu'];
		$feco_efo=$rowmed['feco_efo'];
		$nom_medi=$rowmed['nom_medi'];
		$nom_areas=$rowmed['nom_areas'];
		$nomb_mdi=$rowmed['nomb_mdi'];
		$noco_mdi=$rowmed['noco_mdi'];
		$desc_ffa=$rowmed['desc_ffa'];
		$dosis_med=$rowmed['dosis_med'];
		$undo_med=$rowmed['undo_med'];
		$frec_med=$rowmed['frec_med'];
		$unfr_med=$rowmed['unfr_med'];
		$via_med=$rowmed['via_med'];
		$tiem_med=$rowmed['tiem_med'];
		$cant_men=$rowmed['cant_men'];
		$bvia=mysql_query("select * from destipos where codi_des='$via_med'");
		$rvia=mysql_fetch_array($bvia);
		$via=$rvia['nomb_des'];
		$posolo=$dosis_med.' '.$undo_med.' cada '.$frec_med.' '.$unfr_med.' via '.$via;
		if(empty($dosis_med))
		{
			$posolo=$obse;		
		}
		
		echo"<tr>
		<td>$feco_efo</td>
		<td>$nom_medi</td>
		<td>$nom_areas</td>
		<td>$nomb_mdi $desc_ffa</td>
		<td>$posolo</td>
		<td align=center>$cant_men</td>
		
		
		<tr>";
		
	}
	
	
	/*
	
	echo"<table class='Tbl0' align=center>";
	echo"<tr><td class='Td1' align='center'><STRONG>PROCEDIMIENTOS REALIZADOS DE LABORATORIO</strong></td></tr>
	</table>";
	echo"<table class='Tbl0' border=0 align=center>
	<tr>
	<td class='Td1' colspan=4 align='center'><b>OPC</td>
	<td class='Td1' align='left'><b>Nº ORDEN</span></td>
	<td class='Td1' align='left'><b>FECHA DE REALIZACION</span></td>
	<td class='Td1' align='left'><b>MEDICO SOLICITANTE</span></td></tr>";
	$i=0;		
	while ($rowexa=mysql_fetch_array($cons))
	{				 
		$iden_dlab=$rowexa['iden_dlab'];
		$codusu=$rowexa['codi_usu'];
		$iden_labs=$rowexa['iden_labs'];
		$cod=$rowexa['codigo'];
		$nord_dlab=$rowexa['nord_dlab'];
		$nomvar='codusu'.$i;
		echo "<input type=hidden name=codusu value=$codusu>";
		$nomvar='iden_labs'.$i;
		echo "<input type=hidden name=iden_labs value=$iden_labs>";
		$nomvar='nord_dlab'.$i;
		echo "<input type=hidden name=nord_dlab value='$nord_dlab'>";
		$conex=mysql_query("SELECT detalle_labs.iden_labs,detalle_labs.nord_dlab
		FROM detalle_labs INNER JOIN cups ON detalle_labs.codigo = cups.codigo WHERE detalle_labs.iden_labs='$iden_labs'");
		$mcu=1;
		while ($rowdet=mysql_fetch_array($conex))
		{
			$desc=$rowdet['descrip'];
			$nord_dlab=$rowdet['nord_dlab'];
			$nord[$mcu]=$nord_dlab;			
			$nomvar='cod'.$i.$mcu;
			echo "<input type=hidden name='$nomvar' value='$cod'>";
			$nomvar='selec'.$i.$mcu;									
			echo "<input type=hidden name='$nomvar' value=1>";										
			$cql[$mcu]=$desc;						
			$mcu++;		
		}
		$i++;
		echo "</tr> \n";
		echo " 
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td class='Td1' width=2%><a href=../Historias/imprimir2_.php?codusu=$paciente&iden_labs=$iden_labs&nd_=$nord_dlab&band=1 target='fr01'><img src='icons/feed_magnify.png' border=0 width=17 height=17 alt='Imprimir' ></a>
		<td align='center'>$nord_dlab<input  type=hidden name=fac_num value='$rowx[num_fac]'></td>
		<td align='left'>$rowexa[fchr_labs] - $rowexa[hrae_labs]</td>";;
		$cons_medi=mysql_query("SELECT * FROM medicos WHERE cod_medi='$rowexa[cod_medi]'");
		$rowmedi = mysql_fetch_array($cons_medi);
		$medico=$rowmedi[nom_medi];
		echo"<td align='left'>$medico<input  type=hidden name=nom_medi value='$rowx[nom_med]'></td></tr>";
	}
	echo "<input type=hidden name=it>";
	echo "<input type=hidden name=mcu>";
*/	
?>
	
</form>
</body>
</html>