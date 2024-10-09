<?	
	session_register('paciente');
	//exit();
?>
<html> 
<head>
<title>INFORMACION USUARIOS *PROINSALUD* </title> 
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
	$cons=mysql_query("SELECT el.iden_labs,dl.iden_dlab ,dl.estd_dlab,el.codi_usu,dl.codigo,dl.nord_dlab,
	el.fchr_labs, el.hrae_labs,el.cod_medi 
	FROM detalle_labs AS dl
	INNER JOIN encabezado_labs AS el ON el.iden_labs = dl.iden_labs
	WHERE el.codi_usu='$paciente' AND dl.estd_dlab<>'EL' 
	GROUP BY el.iden_labs order by el.fchr_labs DESC");
	echo"<table class='Tbl0' align=center>
	<tr><td class='Td1' align='center'><STRONG>PROCEDIMIENTOS REALIZADOS DE LABORATORIO</strong></td></tr>
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
?>
	
</form>
</body>
</html>