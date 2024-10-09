<?PHP
    define("base_de_datos", "proinsalud");
	require('Libreria.Inc');
?>
<HTML>
<HEAD>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<script language="JavaScript" type="text/javascript">
		function imprimir()
		{
			document.all.item("noprint").style.visibility='hidden'
			window.print()
			document.all.item("noprint").style.visibility='visible'
		}
	</script>
</HEAD>
<BODY>
<?PHP
	$xcon=conectar_bd();
	ECHO "<form name=uno method=post>";
	ECHO "<input type=hidden name='sTop' value='$sTop'>";
	ECHO "<table align='center'>";
	ECHO "<tr><td align='center'><b>RESULTADO DE BUSQUEDA</b></td></tr>";
	ECHO "</table>";
	
	if($abox1=='' && $abox2=='' && $abox3=='' && $abox4=='' && $abox5=='' && $bbox1=='' && $bbox2=='' && $bbox3=='' && $cbox1=='' && $cbox2=='' && $dbox1=='' && $dbox2=='' && $dbox3=='' && $ebox1==''
	   && $ebox2=='' && $ebox3=='' && $ebox3=='' && $fbox1=='' && $fbox2=='' && $fbox3=='' && $gbox1=='' && $gbox2=='' && $gbox3=='' && $gbox4=='' && $gbox5=='' && $gbox6=='' && $hbox1==''
	   && $hbox2=='' && $ibox1=='' && $ibox2=='' && $ibox3=='' && $ibox4=='' && $ibox5=='' && $jbox1=='' && $jbox2=='' && $jbox3=='' && $jbox4=='')
	{
		echo 'no se encuentran parametros ENOS a buscar<br>';   
	}
	else
	{	
		$datehoy =date('Y-m-d'); 
		$where="WHERE (";
		if($tiposervicio==1 || $tiposervicio==2)
		{	
			if($varmunicipio=='52001')
			{
				if($tiposervicio==1){$where=$where."((consultaprincipal.area_cpl)='01') AND ";}
				else if($tiposervicio==2){$where=$where."((consultaprincipal.area_cpl)='04')  AND ";}
				else if($tiposervicio=='')
				{
					$where=$where."(((consultaprincipal.area_cpl)='01') OR ((consultaprincipal.area_cpl)='04'))  AND ";
					$varmunicipio=='52001';
				}
			}	
			if($fin!='' && $ffin!=''){$where=$where."((consultaprincipal.feca_cpl) Between '$fin' AND '$ffin') AND ";}
			else if($fin=='' || $ffin=='') {$where=$where."((consultaprincipal.feca_cpl) = '$datehoy') AND ";} 
			if($tipocontra==1){$where=$where."((encabesadohistoria.cont_ehi)='002') AND ";}
			else if($tipocontra==2){$where=$where."((encabesadohistoria.cont_ehi)<>'002') AND ";}
			if($varmunicipio!=''){$where=$where."((encabesadohistoria.origconsu_ehi)='$varmunicipio') AND ";}
		}
		else if($tiposervicio==3)
		{
			if($fin!='' && $ffin!=''){$where=$where."((hist_evo.fech_evo) Between '$fin' AND '$ffin') AND ";}
			else if($fin=='' || $ffin=='') {$where=$where."((hist_evo.fech_evo) = '$datehoy') AND ";} 
			if($tipocontra==1){$where=$where."((ingreso_hospitalario.contra_ing )='002') AND ";}
			else if($tipocontra==2){$where=$where."((ingreso_hospitalario.contra_ing )<>'002') AND ";}
		}	
		$where=$where.'(';
		if($abox1=='S'){$where=$where."((cie_10.grupo_vie10)='A01')  OR ";}
		if($abox2=='S'){$where=$where."((cie_10.grupo_vie10)='A02')  OR ";}
		if($abox3=='S'){$where=$where."((cie_10.grupo_vie10)='A03')  OR ";}
		if($abox4=='S'){$where=$where."((cie_10.grupo_vie10)='A04')  OR ";}
		if($abox5=='S'){$where=$where."(((cie_10.grupo_vie10)='A05') OR ((cie_10.cod_cie10)='A90X') OR ((cie_10.cod_cie10)='A91X') OR ((cie_10.cod_cie10)='B520') OR ((cie_10.cod_cie10)='B528') OR ((cie_10.cod_cie10)='B529'))  OR ";}
		if($bbox1=='S'){$where=$where."((cie_10.grupo_vie10)='B01')  OR ";}
		if($bbox2=='S'){$where=$where."((cie_10.grupo_vie10)='B02')  OR ";}
		if($bbox3=='S'){$where=$where."((cie_10.grupo_vie10)='B03')  OR ";}
		if($cbox1=='S'){$where=$where."((cie_10.grupo_vie10)='C01')  OR ";}
		if($cbox2=='S'){$where=$where."((cie_10.grupo_vie10)='C02')  OR ";}
		if($dbox1=='S'){$where=$where."((cie_10.grupo_vie10)='D01')  OR ";}
		if($dbox2=='S'){$where=$where."((cie_10.grupo_vie10)='D02')  OR ";}
		if($dbox3=='S'){$where=$where."((cie_10.grupo_vie10)='D03')  OR ";}
		if($ebox1=='S'){$where=$where."((cie_10.grupo_vie10)='E01' OR (cie_10.cod_cie10)='B060' OR (cie_10.cod_cie10)='B068' OR (cie_10.cod_cie10)='B069')  OR ";}
		if($ebox2=='S'){$where=$where."((cie_10.grupo_vie10)='E02')  OR ";}
		if($ebox3=='S'){$where=$where."((cie_10.grupo_vie10)='E03')  OR ";}
		if($ebox3=='S'){$where=$where."((cie_10.grupo_vie10)='E04')  OR ";}
		if($fbox1=='S'){$where=$where."((cie_10.grupo_vie10)='F01')  OR ";}
		if($fbox2=='S'){$where=$where."((cie_10.grupo_vie10)='F02')  OR ";}
		if($fbox3=='S'){$where=$where."((cie_10.grupo_vie10)='F03')  OR ";}
		if($gbox1=='S'){$where=$where."((cie_10.grupo_vie10)='G01')  OR ";}
		if($gbox2=='S'){$where=$where."((cie_10.grupo_vie10)='G02')  OR ";}
		if($gbox3=='S'){$where=$where."((cie_10.grupo_vie10)='G03')  OR ";}
		if($gbox4=='S'){$where=$where."((cie_10.grupo_vie10)='G04')  OR ";}
		if($gbox5=='S'){$where=$where."((cie_10.grupo_vie10)='G05')  OR ";}
		if($gbox6=='S'){$where=$where."((cie_10.grupo_vie10)='G06')  OR ";}
		if($hbox1=='S'){$where=$where."((cie_10.grupo_vie10)='H01')  OR ";}
		if($hbox2=='S'){$where=$where."((cie_10.grupo_vie10)='H02')  OR ";}
		if($ibox1=='S'){$where=$where."((cie_10.grupo_vie10)='I01')  OR ";}
		if($ibox2=='S'){$where=$where."((cie_10.grupo_vie10)='I02')  OR ";}
		if($ibox3=='S'){$where=$where."((cie_10.grupo_vie10)='I03')  OR ";}
		if($ibox4=='S'){$where=$where."((cie_10.grupo_vie10)='I04')  OR ";}
		if($ibox5=='S'){$where=$where."((cie_10.grupo_vie10)='I05')  OR ";}
		if($jbox1=='S'){$where=$where."((cie_10.grupo_vie10)='J01')  OR ";}
		if($jbox2=='S'){$where=$where."((cie_10.grupo_vie10)='J02')  OR ";}
		if($jbox3=='S'){$where=$where."((cie_10.grupo_vie10)='J03')  OR ";}
		if($jbox4=='S'){$where=$where."((cie_10.grupo_vie10)='J04')  OR ";}
		$where=substr($where, 0, -5);
		$where=$where.'))';
		if($tiposervicio==1 || $tiposervicio==2)
		{	
			$xsql="SELECT encabesadohistoria.idus_ehi, encabesadohistoria.nomb_ehi, encabesadohistoria.fnac_ehi, cie_10.cod_cie10, cie_10.nom_cie10, consultaprincipal.motc_cpl, consultaprincipal.feca_cpl, contrato.NEPS_CON, areas.nom_areas, municipio.NOMB_MUN
			FROM ((((encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas) INNER JOIN municipio ON encabesadohistoria.origconsu_ehi = municipio.CODI_MUN) INNER JOIN contrato ON encabesadohistoria.cont_ehi = contrato.CODI_CON) INNER JOIN cie_10 ON consultaprincipal.cod1_cpl = cie_10.cod_cie10
			$where";
			$xres=mysql_query($xsql);
			$c=mysql_num_rows($xres);
			IF ($c>0)
			{
				ECHO "<div id='noprint'>";
				ECHO "<table>";
				ECHO "<tr>";
				ECHO "<td><a href='#' OnClick='imprimir()'><img src='css/img/print2.gif' width='30' height='30'></a></td>";
				ECHO "<td><a href='#' OnClick='imprimir()'>Imprimir</a></td>";
				ECHO "</tr>";
				ECHO "</table>";
				ECHO "</div>";
				ECHO "<table class='tbl2'>";
				ECHO "<thead>";
				ECHO "<tr>";
				ECHO "<td class=td1 width=5%>Nro</td>";
				ECHO "<td class=td1 width=5%>IDEN</td>";
				ECHO "<td class=td1 width=20%>USUARIO</td>";
				ECHO "<td class=td1 width=5%>EDAD</td>";
				ECHO "<td class=td1 width=5%>CIE10</td>";
				ECHO "<td class=td1 width=20%>DESCRIPCION CIE10</td>";
				ECHO "<td class=td1 width=15%>MOTIVO CONSULTA</td>";
				ECHO "<td class=td1 width=7%>FECHA</td>";
				ECHO "<td class=td1 width=8%>CONTRATO</td>";
				ECHO "<td class=td1 width=5%>AREA</td>";
				ECHO "</tr>";
				ECHO "</thead>";
				ECHO "<tbody>";
				$conta=1;
				WHILE ($xrow=mysql_fetch_row($xres))
				{
					$fr=SUBSTR($xrow[6],8,2).$sep.SUBSTR($xrow[6],5,2).$sep.SUBSTR($xrow[6],0,4);
					ECHO "<tr>";
					ECHO "<td class=td0>$conta</td>";
					ECHO "<td class=td0>$xrow[0]</td>";
					ECHO "<td class=td0>$xrow[1]</td>";
					ECHO "<td class=td0 align='center'>$xrow[2]</td>";
					ECHO "<td class=td0>$xrow[3]</td>";
					ECHO "<td class=td0>$xrow[4]</td>";
					ECHO "<td class=td0>$xrow[5]</td>";
					ECHO "<td class=td0>$fr</td>";
					ECHO "<td class=td0>$xrow[7]</td>";
					ECHO "<td class=td0>$xrow[8]</td>";
					ECHO "</tr>";
					$conta++;
				}
				ECHO "</tbody>";
				ECHO "</table>";
			}
			ELSE
			{
				ECHO "<p>NO se encontraron registros con estas especificaciones</p>";
			}
		}
		else if($tiposervicio==3)
		{
			$xsql1="SELECT usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, cie_10.cod_cie10, cie_10.nom_cie10, hist_evo.subj_evo, hist_evo.plan_evo, hist_evo.cama_evo, hist_evo.fech_evo, contrato.NEPS_CON
			FROM (((hist_evo INNER JOIN ingreso_hospitalario ON hist_evo.id_ing = ingreso_hospitalario.id_ing) INNER JOIN cie_10 ON hist_evo.cod_cie10 = cie_10.cod_cie10) INNER JOIN usuario ON hist_evo.codi_usu = usuario.CODI_USU) INNER JOIN contrato ON ingreso_hospitalario.contra_ing = contrato.CODI_CON
			$where";
			$xres1=mysql_query($xsql1);
			$c1=mysql_num_rows($xres1);
			IF ($c1>0)
			{
				ECHO "<div id='noprint'>";
				ECHO "<table>";
				ECHO "<tr>";
				ECHO "<td><a href='#' OnClick='imprimir()'><img src='css/img/print2.gif' width='30' height='30'></a></td>";
				ECHO "<td><a href='#' OnClick='imprimir()'>Imprimir</a></td>";
				ECHO "</tr>";
				ECHO "</table>";
				ECHO "</div>";
				ECHO "<table class='tbl2'>";
				ECHO "<thead>";
				ECHO "<tr>";
				ECHO "<td class=td1 width=5%>Nro</td>";
				ECHO "<td class=td1 width=7%>FECHA</td>";
				ECHO "<td class=td1 width=5%>IDEN</td>";
				ECHO "<td class=td1 width=10%>USUARIO</td>";
				ECHO "<td class=td1 width=3%>EDAD</td>";
				ECHO "<td class=td1 width=5%>CIE10</td>";
				ECHO "<td class=td1 width=20%>DESCRIPCION CIE10</td>";
				ECHO "<td class=td1 width=25%>SUBJETIVO</td>";
				ECHO "<td class=td1 width=15%>PLAN</td>";
				ECHO "<td class=td1 width=5%>CAMA</td>";
				ECHO "<td class=td1 width=5%>CONTRATO</td>";
				ECHO "</tr>";
				ECHO "</thead>";
				ECHO "<tbody>";
				$conta=1;
				WHILE ($xrow1=mysql_fetch_row($xres1))
				{
					$nomusuario=$xrow1[1].' '.$xrow1[2].' '.$xrow1[3].' '.$xrow1[4];
					$fecha_nac=$xrow1[5];
					$fecha_evo=$xrow1[11];
					$edpac=calcula_edad($fecha_nac,$fecha_evo);
					ECHO "<tr>";
					ECHO "<td class=td0>$conta</td>";
					ECHO "<td class=td0>$fecha_evo</td>";
					ECHO "<td class=td0>$xrow1[0]</td>";
					ECHO "<td class=td0>$nomusuario</td>";
					ECHO "<td class=td0 align='center'>$edpac</td>";
					ECHO "<td class=td0>$xrow1[6]</td>";
					ECHO "<td class=td0>$xrow1[7]</td>";
					ECHO "<td class=td0>$xrow1[8]</td>";
					ECHO "<td class=td0>$xrow1[9]</td>";
					ECHO "<td class=td0>$xrow1[10]</td>";
					ECHO "<td class=td0>$xrow1[12]</td>";
					ECHO "</tr>";
					$conta++;
				}
				ECHO "</tbody>";
				ECHO "</table>";
			}
			ELSE
			{
				ECHO "<p>NO se encontraron registros con estas especificaciones</p>";
			}
		}
	}
	ECHO "</form>";
	desconectar_bd();
	
	function calcula_edad($fecha_nac,$fecha_evo)
    {
		$dia=substr($fecha_evo, 8, 2);
        $mes=substr($fecha_evo, 5, 2);
        $anno=substr($fecha_evo, 0, 4);
        $dia_nac=substr($fecha_nac, 8, 2);
        $mes_nac=substr($fecha_nac, 5, 2);
        $anno_nac=substr($fecha_nac, 0, 4);
        if($mes_nac>$mes)
        {
            $calc_edad= $anno-$anno_nac-1;
        }
        else
        {
            if($mes==$mes_nac AND $dia_nac>$dia)
            {
                $calc_edad= $anno-$anno_nac-1;
            }
            else
            {
                $calc_edad= $anno-$anno_nac;
            }
        }
        return $calc_edad;
    }
?>
</BODY>
</HTML>