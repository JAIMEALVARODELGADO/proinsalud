<?
//session_register('paciente');
$codigousu=$paciente;
//$band=1;
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="JavaScript">
	
</script>
</head>	
<body>
<?	
$paciente='1068';
echo $codigo;
include('php/conexion1.php');
$bdescup=mysql_query("select * from cups where codigo='$codigo'");
$rdescu=mysql_fetch_array($bdescup);
$desclab=$rdescu['descrip'];
//1. Examenes Varios listado
$result2=Mysql_query("SELECT encabezado_labs.codi_usu, detalle_labs.codigo, encabezado_labs.cod_medi AS medsol, encabezado_labs.fche_labs, encabezado_labs.hrae_labs, detalle_labs.iden_labs, detalle_labs.obsv_dlab, detalle_labs.refe_dlab, detalle_labs.unid_dlab, detalle_labs.cod_medi, detalle_labs.estd_dlab
FROM (detalle_labs INNER JOIN cups ON detalle_labs.codigo = cups.codigo) INNER JOIN encabezado_labs ON detalle_labs.iden_labs = encabezado_labs.iden_labs
WHERE (((encabezado_labs.codi_usu)='$paciente') AND ((detalle_labs.codigo)='$codigo') AND ((encabezado_labs.fche_labs)>='$fechaini') AND ((detalle_labs.obsv_dlab) Is Not Null And (detalle_labs.obsv_dlab)<>'' And (detalle_labs.obsv_dlab)<>'f' And (detalle_labs.obsv_dlab)<>'F') AND ((detalle_labs.estd_dlab)='CU'))
ORDER BY encabezado_labs.fche_labs DESC , encabezado_labs.hrae_labs DESC");
echo"<table align=center width=80%>
<tr><td>";
$a=1;
if(mysql_num_rows($result2)>0)
{
	
	echo"<br><table align=center class='tbl' width=100%>
	<tr><th align=center>$codigo $desclab</th></tr>
	</table>
	<br>";
	
	echo"<table align=center class='tbl' width=100%>
	<tr>
	<th align=center>FECHA</th>
	<th align=center>HORA</th>
	<th align=center>MEDICO SOLICITANTE</th>
	<th align=center>OBSERVACIONES</th>
	<th align=center>UNIDADES</th>
	<th align=center>REFERENCIA</th>
	<th align=center>ESTADO</th>
	</tr>
	";
	while($rowm = mysql_fetch_array($result2))
	{ 
		$fecha='';
		$hora='';
		$medsol='';
		$obse='';
		$unid='';
		$refer='';
		$estado='';			
		$fecha=$rowm["fche_labs"];
		$hora=$rowm["hrae_labs"];
		$medsol=$rowm["medsol"];
		$obse=$rowm["obsv_dlab"];
		$unid=$rowm["unid_dlab"];
		$refer=$rowm["refe_dlab"];
		$estado=$rowm["estd_dlab"];
		$bmed=mysql_query("select * from medicos where cod_medi='$medsol'");
		$rmed=mysql_fetch_array($bmed);
		$medicosol=$rmed['nom_medi'];
		
		echo"<tr>
		<td>$fecha</td>
		<td>$hora</td>
		<td>$medicosol</td>
		<td>$obse</td>
		<td>$unid</td>
		<td>$refer</td>
		<td>$estado</td>
		<tr>
		";		
	}
	echo"</table>";
}
//$cont=$cont+10;
//impresion de datos Coprologicos
$result1=mysql_query("SELECT coprol.cod_examen, coprol.cod_usu, coprol.fec_rec, coprol.consistenc, coprol.bh, coprol.blastocyst, coprol.qc, coprol.QEColi, coprol.color, coprol.ch, coprol.chilomasti, coprol.ph, coprol.tz, coprol.trofozoito, coprol.moco, coprol.sangreocul, coprol.otros, coprol.azucaresre, coprol.leuc_cpr, coprol.hema_cpr, coprol.writh, coprol.levadura, coprol.neutrofilo, coprol.micelios, coprol.linfocitos, coprol.grasa_neut, coprol.eosinofilo, coprol.flora_bact, coprol.qh, coprol.qehistolyt, coprol.qn, coprol.qemana, coprol.observaciones, coprol.no, coprol.Val, coprol.esta_ord
FROM coprol
WHERE (((coprol.cod_examen)='$codigo') AND ((coprol.cod_usu)='$paciente') AND ((coprol.fec_rec)>='$fechaini') AND ((coprol.esta_ord)<>'EL')) order by coprol.fec_rec desc");

if(mysql_num_rows($result1)<>0)
{
	
	while($rowx = mysql_fetch_array($result1))
	{
		$fche_labs=$rowx["fec_rec"];
		$no=$rowx["no"];
		$val=$rowx["val"];
		$consistenc=$rowx["consistenc"];
		$blastocyst=$rowx["blastocyst"];
		$bh=$rowx["bh"];
		$qc=$rowx["qc"];
		$QEColi=$rowx["QEColi"];
		$color=$rowx["color"];
		$ch=$rowx["ch"];
		$chilomasti =$rowx["chilomasti"];
		$ph=$rowx["ph"];
		$tz=$rowx["tz"];
		$trofozoito=$rowx["trofozoito"];
		$moco=$rowx["moco"];
		$sangreocul=$rowx["sangreocul"];
		$otros=$rowx["otros"];
		$azucaresre=$rowx["azucaresre"];
		$writh=$rowx["writh"];
		$levadura=$rowx["levadura"];
		$neutrofilo=$rowx["neutrofilo"];
		$micelios=$rowx["micelios"];
		$linfocitos=$rowx["linfocitos"];
		$grasa_neut=$rowx["grasa_neut"];
		$eosinofilo=$rowx["eosinofilo"];
		$flora_bact=$rowx["flora_bact"];
		$qh=$rowx["qh"];
		$qehistolyt=$rowx["qehistolyt"];
		$qn=$rowx["qn"];
		$qemana=$rowx["qemana"];
		$leuc_cpr=$rowx["leuc_cpr"];
		$hema_cpr=$rowx["hema_cpr"];
		$observaciones=$rowx["observaciones"];
		//if de examenes Coprologicos
		echo"<br><table align=center class='tbl' width=100%>
		<tr><th align=center>$codigo $desclab ($fche_labs)</th></tr>
		</table>
		<br>";	
		echo"<table align=center class='tbl' width=100%>";
		//////////////////////CARACTERISTICAS DE LOS EXAMENES DATOS COPROSCOPICOS
		echo"<tr><th  colspan=6>COPROSCOPICO</th></tr>
		<tr>
		<th>PH</th>
		<td>$ph</td>
		<th>COLOR</th>
		<td>$color</td>
		<th>CONSISTENCIA</th>
		<td>$consistenc</td>		
		</tr>
		<tr>
		<th>SANGRE OCULTA</th>
		<td>$sangreocul</td>
		<th>AZU.REDUCTORES</th>
		<td>$azucaresre</td>
		<td>$val</td>
		<td>mg/l</td>		
		</tr>
		<tr>
		<th>LEUCOCITOS</th>
		<td>$leuc_cpr</td>
		<th>HEMATIES</th>
		<td  colspan=3>$hema_cpr</td>			
		</tr>
		<tr><th  colspan=6>COPROLOGICO</th></tr>
		<tr>
		<th>MOCO</th>
		<td>$moco</td>
		<th>LEVADURAS</th>
		<td>$levadura</td>			
		<th>MICELIOS</th>
		<td>$micelios</td>			
		</tr>
		<tr>
		<th>GRASAS NEUTRAS</th>
		<td>$grasa_neut</td>
		<th>FLORA BACTERIANA</th>
		<td colspan=3>$flora_bact</td>			
		</tr>
		<tr>
		<td  colspan=6>$qc $QEColi $qh $qehistolyt </td>				
		</tr>
		<tr>
		<td  colspan=6>$qn $qemana $bh $blastocyst </td>				
		</tr>
		<tr>
		<td  colspan=6>$ch $chilomasti $tz $trofozoito </td>				
		</tr>
		<tr>
		<th>Otros</th>
		<td>$otros</td>
		<td colspan=4>$no</th>			
		</tr>
		
		<tr>
		<th>Wright</th>
		<td colspan=5>$writh</td>		
		</tr>
		";
		$pwri=$writh;
		if($pwri!='Negativo')
		{
			
			echo"<tr>
			<th>Neutrofilos</th>
			<td>$neutrofilo %</td>
			<th>Linfoncito</th>
			<td>$linfocitos %</td>			
			<th>Eosinofilos</th>
			<td>$eosinofilo %</td>			
			</tr>";			
		}	
	}
}

// Impresion de Cuadro Hematico
$result2=mysql_query("SELECT cuadroh.iden_dlab, cuadroh.num_fac, cuadroh.cod_examch, cuadroh.fec_rec, cuadroh.fec_ent, cuadroh.cod_usu, cuadroh.hemoglobin, cuadroh.neutrofilos, cuadroh.hematrocit, cuadroh.cayados, cuadroh.vsg1h, cuadroh.linfocito, cuadroh.leococitos, cuadroh.eosinofilos, cuadroh.monocitos, cuadroh.basofilos, cuadroh.plaquetas, cuadroh.reticuloci, cuadroh.observacion
FROM cuadroh
WHERE (((cuadroh.cod_examch)='$codigo') AND ((cuadroh.fec_rec)>='$fechaini') AND ((cuadroh.cod_usu)='$paciente') AND ((cuadroh.esta_ord)<>'EL')) order by cuadroh.fec_rec desc");


 
if(mysql_num_rows($result2)<>0)
{
	while($rowy = mysql_fetch_array($result2))
	{
		$fec_rec=$rowy["fec_rec"];		
		$hemoglobin=$rowy["hemoglobin"];
		$neutrofilos=$rowy["neutrofilos"];
		$hematrocit=$rowy["hematrocit"];
		$cayados=$rowy["cayados"];
		$vsg1h=$rowy["vsg1h"];
		$linfocito=$rowy["linfocito"]; 
		$leococitos=$rowy["leococitos"];
		$eosinofilos=$rowy["eosinofilos"];
		$monocitos=$rowy["monocitos"];
		$basofilos=$rowy["basofilos"];
		$plaquetas=$rowy["plaquetas"];
		$reticuloci=$rowy["reticuloci"];
		$observacion=$rowy["observacion"];
		 
		echo"<br><table align=center class='tbl' width=100%>
		<tr><th align=center>$codigo $desclab ($fec_rec)</th></tr>
		</table>
		<br>";
		echo"<table align=center class='tbl' width=100%>";
		echo"
		<tr>
		<th>HEMOGLOBINA</th>
		<td>$hemoglobin</td>
		<td>gr / dl</td>
		<th>NEUTROFILOS</th>
		<td>$neutrofilos</td>
		<td>%</td>
		</tr>
		
		<tr>
		<th>CAYADOS</th>
		<td>$cayados</td>
		<td>%</td>
		<th>HEMATOCRITO</th>
		<td>$hematrocit</td>
		<td>%</td>
		</tr>
		
		<tr>
		<th>LINFONCITOS</th>
		<td>$linfocito</td>
		<td>%</td>
		<th>VSG1h</th>
		<td>$vsg1h</td>
		<td>m.m/h</td>
		</tr>
		
		<tr>
		<th>EOSINOFILOS</th>
		<td>$eosinofilos</td>
		<td>%</td>
		<th>LEUCOCITOS</th>
		<td>$leococitos</td>
		<td>/mm</td>
		</tr>
		
		<tr>
		<th>MONOCITOS</th>
		<td>$monocitos</td>
		<td>%</td>
		<th>PLAQUETAS</th>
		<td>$plaquetas</td>
		<td>/mm</td>
		<tr>
		</tr>
		
		<tr>
		<td colspan=3></td>
		<th>BASOFILOS</th>
		<td>$basofilos</td>
		<td>%</td>
		</tr>
		
		<tr>
		<td colspan=3></td>
		<th>RETICULOCITOS</th>
		<td>$reticuloci</td>
		<td>%</td>
		</tr>
		
		<tr>
		
		<th>OBSERVACIONES</th>
		<td colspan=5>$observacion</td>
		
		</tr>
		</table><br>
		
		";
	}
}

//impresion datos espermograma
$result3=mysql_query("SELECT `iden_dlab`, `fec_rec`, `fec_ent`, `cod_usu`, `cod_exames`, `fec_rec`, `hor_reco`, `min_rec`, `ph_exa`, `vol_exa`, `dis_visc`, `nor_visc`, `aum_visc`, `1cc_fila`, `3cc_fila`, `m3cc_fila`, `otro__fila`, `20m_licu`, 
`30m_licu`, `otro_licu`, `leoco_dir`, `hema_dir`, `bact_uno`, `tri_mas`, `trim_menos`, `koh_mas`, `koh_menos`, `movprog_mov`, `movpend_mov`, `inmo_mov`, `vivos_vit`, `mue_vit`, `recu_esperm`, `pmn0xc_gram`, `1-5xc_gram`, `neutr_wrig`, `linfo_wrig`,
`norm_morfo`, `micro_morfo`, `macro_morfo`, `enroll_morfo`,`amorf_morfo`,`scabe_morfo`,`scola_morfo`,`dcab_morfo`, `otro_morfo`
FROM esper
WHERE (((fec_rec)>='$fechaini') AND ((cod_usu)='$paciente') AND ((cod_exames)='$codigo') AND ((esta_ord)<>'EL')) order by fec_rec desc");






if(mysql_num_rows($result3)<>0)
{
	while($rowxxx = mysql_fetch_array($result3))
	{
		$fec_rec=$rowxxx["fec_rec"];
		$hor_reco=$rowxxx["hor_reco"];
		$min_rec=$rowxxx["min_rec"];
		$ph_exa=$rowxxx["ph_exa"];
		$vol_exa=$rowxxx["vol_exa"];
		$dis_visc=$rowxxx["dis_visc"];
		$nor_visc=$rowxxx["nor_visc"]; 
		$aum_visc=$rowxxx["aum_visc"];
		$cc1_fila=$rowxxx["1cc_fila"];
		$cc3_fila=$rowxxx["3cc_fila"];
		$m3cc_fila=$rowxxx["m3cc_fila"];
		$otro__fila=$rowxxx["otro__fila"];
		$m_licu20=$rowxxx["20m_licu"];
		$m_licu30=$rowxxx["30m_licu"];
		$otro_licu=$rowxxx["otro_licu"];
		$leoco_dir=$rowxxx["leoco_dir"];
		$hema_dir =$rowxxx["hema_dir"];
		$bact_uno=$rowxxx["bact_uno"];
		$tri_mas=$rowxxx["tri_mas"];
		$trim_menos=$rowxxx["trim_menos"];
		$koh_mas=$rowxxx["koh_mas"];
		$koh_menos=$rowxxx["koh_menos"];
		$movprog_mov=$rowxxx["movprog_mov"];
		$movpend_mov=$rowxxx["movpend_mov"];
		$inmo_mov=$rowxxx["inmo_mov"];
		$vivos_vit=$rowxxx["vivos_vit"];
		$mue_vit=$rowxxx["mue_vit"];
		$recu_esperm=$rowxxx["recu_esperm"];
		$pmn0xc_gram=$rowxxx["pmn0xc_gram"];
		$x15c_gram=$rowxxx["1-5xc_gram"];
		$neutr_wrig=$rowxxx["neutr_wrig"];
		$linfo_wrig=$rowxxx["linfo_wrig"];
		$norm_morfo=$rowxxx["norm_morfo"];
		$micro_morfo=$rowxxx["micro_morfo"];
		$macro_morfo=$rowxxx["macro_morfo"];
		$enroll_morfo=$rowxxx["enroll_morfo"];
		$amorf_morfo=$rowxxx["amorf_morfo"];
		$scabe_morfo=$rowxxx["scabe_morfo"];
		$scola_morfo=$rowxxx["scola_morfo"];
		$dcab_morfo=$rowxxx["dcab_morfo"];
		$otro_morfo=$rowxxx["otro_morfo"];

		
		echo"<br><table align=center class='tbl' width=100%>
		<tr><th align=center>$codigo $desclab ($fec_rec)</th></tr>
		</table>
		<br>";
		echo"<table align=center class='tbl' width=100%>";
		echo"
		<tr>
		<th>Fecha De Recoleccion</th>
		<td>$fec_rec</td>
		<th>Hora De Procesamiento</th>
		<td>$hor_reco : $min_rec</td>
		</tr>
		
		<tr>
		<th>CARACTERISTICAS</th>		
		</tr>
		
		<tr>
		<th>Ph</th>
		<td>$ph_exa</td>		
		<th>Volumen</th>
		<td>$vol_exa</td>		
		<th>Viscosidad</th>
		<td>$dis_visc</td>		
		<th>Disminuida</th>
		<td>$nor_visc $aum_visc</td>
		
		</tr>
		
		<tr>
		<th>Filancia</th>
		<td>$cc1_fila $cc3_fila $m3cc_fila $otro__fila</td>
		<th>Licuefacion</th>
		<td>$m_licu20 $m_licu30 $otro_licu</td>
		</tr>
		
		<tr>
		<th>DIRECTO</th>		
		</tr>
		
		<tr>
		<th>Leucocitos</th>
		<td>$leoco_dir xc</td>		
		<th>Hematitis</th>
		<td>$hema_dir xc</td>		
		<th>Bacterias</th>
		<td>$bact_uno</td>		
		</tr>
		
		<tr>
		<th>Tricomonas</th>
		<td>$tri_mas $trim_menos</td>
		<th>Koh</th>
		<td>$koh_mas $koh_menos</td>
		</tr>
		
		<tr>
		<th>MOVILIDAD</th>
		<th>Moviles Progresivos</th>
		<td>$movprog_mov</td>
		<th>Moviles Pendulantes</th>
		<td>$movpend_mov</td>
		<th>Inmoviles</th>
		<td>$inmo_mov</td>
		</tr>
		
		<tr>
		<th>VITALIDAD</th>
		<th>Vivos</th>
		<td>$vivos_vit %</td>
		<th>Muertos</th>
		<td>$mue_vit %</td>
		</tr>
		
		<tr>
		<th>RECUENTO ESPERMATICO</th>
		<td>$recu_esperm /mm3 (vr 15 000.000 - 45 0000.000)</td>
		</tr>

		<tr>
		<th>GRAM</th>
		<td>$pmn0xc_gram $x15c_gram</td>
		</tr>
		
		
		<tr>
		<th>WRIGTH</th>
		<th>Neutrofilos</th>
		<td>$neutr_wrig</td>
		<th>Linfoncitos</th>
		<td>$linfo_wrig</td>
		</tr>
		
		<tr>
		<th>MORFOLOGIA</th>
		</tr>
		<tr>
		<th>Normales</th>
		<td>$norm_morfo %</td>
		<th>Microcefalos</th>
		<td>$micro_morfo %</td>
		<th>Macrocefalos</th>
		<td>$macro_morfo %</td>
		<th>Enrollados</th>
		<td>$enroll_morfo %</td>
		</tr>
		
		<tr>
		<th>Amorfos</th>
		<td>$amorf_morfo %</td>
		<th>Sin Cabeza</th>
		<td>$scabe_morfo %</td>
		<th>Sin Cola</th>
		<td>$scola_morfo %</td>
		<th>Doble Cabeza</th>
		<td>$dcab_morfo %</td>
		</tr>
		
		<tr>
		<th>Otros</th>
		<td>$otro_morfo</td>
		</tr>
		
		</table><br>";	
		
	}
}

//examenes  frotis Vaginal
$result4=mysql_query("SELECT frotis.iden_dlab, frotis.cod_examen, frotis.fec_ent, frotis.fec_rec, frotis.cod_usu, frotis.ph, frotis.testaminas, frotis.koh, frotis.trichomava, frotis.pmn, frotis.celulasgui, frotis.levaduras, frotis.seudomicel, frotis.lactobacil, frotis.cocos, frotis.bacilos, frotis.cocobacilo, frotis.grampositi, frotis.gramnegati, frotis.granv, frotis.pmnxcamcer, frotis.diplointra, frotis.diploextra, frotis.observaciones
FROM frotis
WHERE (((frotis.cod_examen)='$codigo') AND ((frotis.fec_ent)>='$fechaini') AND ((frotis.cod_usu)='$paciente') AND ((frotis.esta_ord)<>'EL')) order by frotis.fec_rec desc");


if(mysql_num_rows($result4)<>0)
{
	while($rowxy= mysql_fetch_array($result4))
	{
		$ph=$rowxy["ph"];
		$testaminas=$rowxy["testaminas"];
		$koh=$rowxy["koh"];
		$trichomava=$rowxy["trichomava"];
		$pmn=$rowxy["pmn"];
		$celulasgui=$rowxy["celulasgui"];
		$levaduras=$rowxy["levaduras"];
		$seudomicel=$rowxy["seudomicel"];
		$lactobacil=$rowxy["lactobacil"];
		$cocos=$rowxy["cocos"];
		$bacilos=$rowxy["bacilos"];
		$cocobacilo=$rowxy["cocobacilo"];
		$grampositi=$rowxy["grampositi"];
		$gramnegati=$rowxy["gramnegati"];
		$granv=$rowxy["granv"];
		$pmnxcamcer=$rowxy["pmnxcamcer"];
		$diplointra=$rowxy["diplointra"];
		$diploextra=$rowxy["diploextra"];
		$observaciones=$rowxy["observaciones"];

		
		echo"<br><table align=center class='tbl' width=100%>
		<tr><th align=center>$codigo $desclab ($fec_rec)</th></tr>
		</table>
		<br><table align=center class='tbl' width=100%>
		<tr>
		<th>CARACTERISTICAS</th>
		</tr>
		<tr>
		<th>FRESCO</th>
		</tr>
		<tr>
		<th>PH</th>
		<td>$ph</td>
		<th>TEST DE AMINAS</th>
		<td>$testaminas</td>
		<th>K.O.H</th>
		<td>$koh</td>
		<th>TRICHOMA VAGINAL</th>
		<td>$trichomava</td>
		</tr>
		<tr>
		<th>GRAMA VAGINAL</th>
		</tr>
		
		<tr>
		<th>PMN (X CAMPO)</th>
		<td>$pmn XC</td>
		<th>CELULAS GUIAS</th>
		<td>$celulasgui</td>
		<th>LEVADURAS</th>
		<td>$levaduras</td>
		</tr>
		
		<tr>
		<th>SEUDOMICELIOS</th>
		<td>$seudomicel</td>
		<th>LACTOBACILOS</th>
		<td>$lactobacil</td>
		</tr>
		<tr>
		<th>FLORA PREDOMINANTE</th>
		</tr>
		
		<tr>
		<th>MORFOLOGIA</th>
		<td>$cocos $bacilos $cocobacilo $grampositi $gramnegati $granv</td>
		<th>LACTOBACILOS</th>
		<td>$lactobacil</td>
		</tr>
		
		<tr>
		<th>GRAMA CERVICAL</th>
		</tr>
		
		<tr>
		<th>PMN (X CAMPO)</th>
		<td>$pmnxcamcer XC</td>
		</tr>
		<tr>
		<th>DIPLOCOCOS GRAM NEGATIVOS INTRACELULARES</th>
		<td>$diplointra</td>
		</tr>
		<tr>
		<th>DIPLOCOCOS GRAM NEGATIVA ESTRACELULARES</th>
		<td>$diploextra</td>
		</tr>
		<tr>
		<th>OBSERVACIONES</th>
		<td>$observaciones</td>
		</tr>
		
		</table><br>";
	}
}

//impresion de HCG
$result6=mysql_query("SELECT hcg.iden_dlab, hcg.cod_examen, hcg.fec_rec, hcg.fec_ent, hcg.cod_usu, hcg.resul_exam, hcg.observaciones
FROM hcg
WHERE (((hcg.cod_examen)='$codigo') AND ((hcg.fec_rec)>='$fechaini') AND ((hcg.cod_usu)='$paciente') AND ((hcg.esta_ord)<>'EL')) order by hcg.fec_rec desc");


if(mysql_num_rows($result6)<>0)
{
	while($rowxxy= mysql_fetch_array($result6))
	{
		$resul_exam =$rowxxy["resul_exam"];
		$observaciones =$rowxxy["observaciones"];
		$fec_rec =$rowxxy["fec_rec"];
		
		echo"<br><table align=center class='tbl' width=100%>
		<tr><th align=center>$codigo $desclab ($fec_rec)</th></tr>
		</table>
		<br><table align=center class='tbl' width=100%>
		<tr>
		<th COLSPAN=2>CARACTERISTICAS</th>		
		<tr>
		<tr>
		<th>RESULTADOS</th>	
		<td>$resul_exam m UI/ml</td>
		<tr>
		
		<tr>
		<th>SEMANA</th><th>REFERENCIA</th>	
		</tr>
		
		<tr><th>3</th><td>5.8</td></tr>
		<tr><th>4</th><td>9.5 - 750</td></tr>
		<tr><th>5</th><td>217 - 7138</td></tr>
		<tr><th>6</th><td>158 - 31.795</td></tr>
		<tr><th>7</th><td>3.697 - 163.563</td></tr>
		
		<tr><th>8</th><td>32.065 - 149.571</td></tr>
		<tr><th>9</th><td>63.803 - 151.410</td></tr>
		<tr><th>10</th><td>46.509 - 186.977</td></tr>
		<tr><th>11</th><td>27.832 - 210.612</td></tr>
		<tr><th>12</th><td>13.950 - 62.530</td></tr>
		</table><br>	
		";

		
	}

		
		
}



//Impresion De Examenes Liquidos
$result7=mysql_query("SELECT labo_lqd.cod_usu, detalle_labs.codigo, labo_lqd.fech_lqd, labo_lqd.iden_dlab, labo_lqd.clas_lqd, labo_lqd.asp_lqd, labo_lqd.colr_lqd, labo_lqd.dens_lqd, labo_lqd.gbla_lqd, labo_lqd.groj_lqd, labo_lqd.norm_lqd, labo_lqd.cren_lqd, labo_lqd.ntro_lqd, labo_lqd.linf_lqd, labo_lqd.mono_lqd, labo_lqd.otro_lqd, labo_lqd.gram_lqd, labo_lqd.gluc_lqd, labo_lqd.prot_lqd, labo_lqd.ldho_lqd, labo_lqd.otrs_lqd, labo_lqd.obse_lqd
FROM labo_lqd INNER JOIN detalle_labs ON labo_lqd.iden_dlab = detalle_labs.iden_dlab
WHERE (((labo_lqd.cod_usu)='$paciente') AND ((detalle_labs.codigo)='$codigo') AND ((labo_lqd.fech_lqd)>='$fechaini') AND ((labo_lqd.esta_ord)<>'EL'))
ORDER BY labo_lqd.fech_lqd DESC");
if(mysql_num_rows($result7)<>0)
{
	while($rowz= mysql_fetch_array($result7))
	{
		$clas_lqd=$rowz["clas_lqd"];
		$asp_lqd=$rowz["asp_lqd"];
		$colr_lqd=$rowz["colr_lqd"];
		$dens_lqd=$rowz["dens_lqd"];
		$gbla_lqd=$rowz["gbla_lqd"];
		$groj_lqd=$rowz["groj_lqd"];
		$norm_lqd=$rowz["norm_lqd"];
		$cren_lqd=$rowz["cren_lqd"];
		$ntro_lqd=$rowz["ntro_lqd"];
		$linf_lqd=$rowz["linf_lqd"];
		$mono_lqd=$rowz["mono_lqd"];
		$otro_lqd=$rowz["otro_lqd"];
		$gram_lqd=$rowz["gram_lqd"];
		$gluc_lqd=$rowz["gluc_lqd"];
		$prot_lqd=$rowz["prot_lqd"];
		$ldho_lqd=$rowz["ldho_lqd"];
		$otrs_lqd=$rowz["otrs_lqd"];
		$obse_lqd=$rowz["obse_lqd"];

		echo"<br><table align=center class='tbl' width=100%>
		<tr><th align=center>$codigo $desclab ($fec_rec)</th></tr>
		</table>
		<br><table align=center class='tbl' width=100%>
		<tr>
		<th>Clase de Liquido</th><td>$clas_lqd</td>
		<th>Color</th><td>$colr_lqd</td>
		<th>Aspectos</th><td>$asp_lqd</td>
		<th>Densidad</th><td>$dens_lqd</td>
		</tr>
		
		<tr>
		<th>RECUENTO DE GLOBULOS</th>
		</tr>
		
		<tr>
		<th>R.Globulos Blancos</th><td>$gbla_lqd</td>
		<th>R.Globulos Rojos</th><td>$groj_lqd</td>
		<th>Normales</th><td>$norm_lqd</td>
		<th>Crenados</th><td>$cren_lqd</td>
		</tr>
		
		<tr>
		<th>DIFERENCIALES</th>
		</tr>
		
		<tr>
		<th>Neutrofilos</th><td>$ntro_lqd %</td>
		<th>Linfoncitos</th><td>$linf_lqd %</td>
		<th>Monocitos</th><td>$mono_lqd %</td>
		<th>Celulas indiferenciales</th><td>$otro_lqd %</td>
		</tr>
		
		<tr>
		<th>Gram</th><td>$gram_lqd</td>
		<th>Glucosa</th><td>$gluc_lqd</td>
		<th>Proteinas</th><td>$prot_lqd</td>
		<th>LDH</th><td>$ldho_lqd</td>
		</tr>

		<tr>
		<th>Otros Examenes</th><td colspan=7>$otrs_lqd</td>
		</tr>	
		<tr>
		<th>Observaciones</th><td colspan=7>$obse_lqd</td>
		</tr>	
		
		</table><br>
		";
	}
}
//impresion de Examenes Uruanalisis
$result8=mysql_query("SELECT uroana.iden_dla, uroana.cod_examen, uroana.fec_rec, uroana.ced_usu, uroana.fec_rec, uroana.fec_ent, uroana.ced_usu, uroana.aspectos, uroana.color, uroana.ph, uroana.densidad, uroana.albumina, uroana.valo_gluc, uroana.glucosa, uroana.cetonas, uroana.pigm_biliares, uroana.sangre, uroana.urobilinogeno, uroana.val_uru, uroana.nitritos, uroana.leucocitos, uroana.epiteliales, uroana.hermaties, uroana.valo_hem, uroana.cilidros, uroana.cristales, uroana.valo_cri, uroana.cris_uru2, uroana.moco, uroana.esc2, uroana.levadura, uroana.bacterias, uroana.esc, uroana.tricomonas, uroana.obervaciones, uroana.alt, uroana.con, uroana.esp
FROM uroana
WHERE (((uroana.cod_examen)='$codigo') AND ((uroana.fec_rec)>='$fechaini') AND ((uroana.ced_usu)='$paciente') AND ((uroana.esta_ord)<>'EL'))
ORDER BY uroana.fec_rec DESC");


if(mysql_num_rows($result8)!=0)
{

	while($rowr= mysql_fetch_array($result8))
	{
		$fec_rec=$rowr["fec_rec"];
		$aspectos=$rowr["aspectos"]; 
		$color=$rowr["color"];
		$ph=$rowr["ph"];
		$densidad=$rowr["densidad"];
		$albumina=$rowr["albumina"]; 
		$glucosa=$rowr["glucosa"];
		$cetonas=$rowr["cetonas"];
		$pigm_biliares=$rowr["pigm_biliares"];
		$sangre=$rowr["sangre"];
		$urobilinogeno=$rowr["urobilinogeno"]; 
		$val_uru=$rowr["val_uru"];
		$nitritos=$rowr["nitritos"];
		$leucocitos=$rowr["leucocitos"];
		$epiteliales=$rowr["epiteliales"]; 
		$hermaties=$rowr["hermaties"];
		$valo_hem=$rowr["valo_hem"];
		$cilidros=$rowr["cilidros"]; 
		$cristales=$rowr["cristales"];
		$valo_cri=$rowr["valo_cri"];;
		$cris_uru2=$rowr["cris_uru2"];;
		$moco=$rowr["moco"];
		$esc2=$rowr["esc2"];
		$levadura=$rowr["levadura"]; 
		$bacterias=$rowr["bacterias"]; 
		$esc=$rowr["esc"];
		$tricomonas=$rowr["tricomonas"]; 
		$obervaciones=$rowr["obervaciones"];
		$con=$rowr["con"]; 
		$esp=$rowr["esp"];
		$alt=$rowr["alt"];
		$valo_gluc=$rowr["valo_gluc"];

		echo"<br><table align=center class='tbl' width=100%>
		<tr><th align=center>$codigo $desclab ($fec_rec)</th></tr>
		</table>
		<br><table align=center class='tbl' width=100%>
		<tr>
		<th>ASPECTO</td><td>$aspectos</td>
		<th>LEUCOCITOS</td><td>$leucocitos ul</td><td>VN: 0 - 4/ul</td>
		</tr>
		
		<tr>
		<th>COLOR</td><td>$color</td>
		<th>EPITELIALES</td><td>$epiteliales ul</td><td>$alt</td>
		</tr>
		
		<tr>
		<th>PH</td><td>$ph</td>
		<th>HEMATIES</td><td>$hermaties $valo_hem</td><td>VN: 0 - 2/ul</td>
		</tr>
		
		<tr>
		<th>DENSIDAD</td><td>$densidad</td>
		<th>CILINDROS</td><td>$cilidros ul</td>
		</tr>
		
		<tr>
		<th>ALBUMINA</td><td>$albumina mg/dl</td>
		<th>CRISTALES</td><td>$cristales $cris_uru2 $valo_cri /ul</td>
		</tr>
		
		<tr>
		<th>GLUCOSA</td><td>$glucosa mg/dl</td>
		<th>MOCO</td><td>$moco $esc2</td>
		</tr>
		
		<tr>
		<th>CETONAS</td><td>$cetonas mg/dl</td>
		<th>LEVADURAS</td><td>$levadura</td>
		</tr>
		
		<tr>
		<th>PIGMENTOS BILIARES</td><td>$pigm_biliares</td>
		<th>BACTERIAS</td><td>$bacterias $esc</td>
		</tr>
		
		<tr>
		<th>SANGRE</td><td>$sangre mg/dl</td>
		<th>TRICOMONAS</td><td>$tricomonas</td>
		</tr>
		
		<tr>
		<th>UROBILINOGENO</td><td colspan=4>$urobilinogeno $val_uru</td>		
		</tr>
		
		<tr>
		<th>NITRITOS</td><td colspan=4>$nitritos</td>	
		</tr>
		
		<tr>
		<th>ESPERMATOZOIDES</td><td colspan=4>$esp</td>	
		</tr>
		
		<tr>
		<th>OBSERVACIONES</td><td colspan=4>$obervaciones</td>	
		</tr>
		
		<tr>
		<th>OTROS</td><td colspan=4>$con</td>	
		</tr>
		
		
		
		</table><br>
		";
	}
}

//Impresion de inmunologia

$result9=mysql_query("SELECT labo_inm.cod_usu, labo_inm.cod_exam, labo_inm.fec_rec, labo_inm.iden_dlab, labo_inm.inmu_rac, labo_inm.inmu_rau, labo_inm.inmu_pcc, labo_inm.inmu_pcu, labo_inm.inmu_asc, labo_inm.inmu_asu, labo_inm.inmu_tioc, labo_inm.inmu_tiou, labo_inm.inmu_tihc, labo_inm.inmu_tihu, labo_inm.inmu_pac, labo_inm.inmu_pau, labo_inm.inmu_pbc, labo_inm.inmu_pbu, labo_inm.inm_btc, labo_inm.inm_btu, labo_inm.inm_ptc, labo_inm.inm_ptu
FROM labo_inm
WHERE (((labo_inm.cod_usu)='$paciente') AND ((labo_inm.cod_exam)='$codigo') AND ((labo_inm.fec_rec)>='$fechaini') AND ((labo_inm.esta_ord)<>'EL')) order by labo_inm.fec_rec desc");




if(mysql_num_rows($result9)<>0)
{
	while($rowx=mysql_fetch_array($result9))
	{		
		$inmu_rac=$rowx["inmu_rac"];
		$inmu_rau=$rowx["inmu_rau"];
		$inmu_pcc=$rowx["inmu_pcc"];
		$inmu_pcu=$rowx["inmu_pcu"];
		$inmu_asc=$rowx["inmu_asc"];
		$inmu_asu=$rowx["inmu_asu"];
		$inmu_tioc=$rowx["inmu_tioc"];
		$inmu_tiou=$rowx["inmu_tiou"];
		$inmu_tihc=$rowx["inmu_tihc"];
		$inmu_tihu=$rowx["inmu_tihu"];
		$inmu_pac=$rowx["inmu_pac"];
		$inmu_pau=$rowx["inmu_pau"];
		$inmu_pbc=$rowx["inmu_pbc"];
		$inmu_pbu=$rowx["inmu_pbu"];
		$inm_btc=$rowx["inm_btc"];
		$inm_btu=$rowx["inm_btu"];
		$inm_ptc=$rowx["inm_ptc"];
		$inm_ptu=$rowx["inm_ptu"];
		
		echo"<br><table align=center class='tbl' width=100%>
		<tr><th align=center>$codigo $desclab ($fec_rec)</th></tr>
		</table>
		<br><table align=center class='tbl' width=100%>
		<tr>
		<th>RA</th><td>$inmu_rac $inmu_rau UI/ml</td>
		<th>PCR</th><td>$inmu_pcc $inmu_pcu mg/L</td>
		<th>ASTOS</th><td>$inmu_asc $inmu_asu</td>		
		</tr>
		
		<tr>
		<th>RA</th><td>$inmu_rac $inmu_rau UI/ml</td>
		<th>PCR</th><td colspan=3>$inmu_pcc $inmu_pcu mg/L</td>		
		</tr>
		
		<tr>
		<th>ANTIGENOS FEBRILES</th>		
		</tr>
		
		<tr>
		<th>Tifo O</th><td>$inmu_tioc $inmu_tiou</td>
		<th>Tifo H</th><td colspan=3>$inmu_tihc $inmu_tihu</td>		
		</tr>
		
		<tr>
		<th>Paratifo A</th><td>$inmu_pac $inmu_pau</td>
		<th>Paratifo B</th><td colspan=3>$inmu_pbc $inmu_pbu</td>		
		</tr>
		
		<tr>
		<th>Brucella abortus</th><td colspan=6>$inm_btc $inm_btu</td>
		</tr>
		
		<tr>
		<th>Proteus OX19</th><td colspan=6>$inm_ptc $inm_ptu</td>
		</tr>
		
		</table><br>";
		

	}
}

///impresion de bhc
$result10=mysql_query("SELECT * FROM labo_bhc WHERE cod_exam='$codigo' AND cod_usu='$paciente' AND fec_rec>='$fechaini' AND esta_ord <>'EL'
ORDER BY fec_rec DESC");

if(mysql_num_rows($result10)!=0)
{
	while($rowa=mysql_fetch_array($result10))
	{
	
		$num_fac=$rowa["num_fac"];
		$lab_bhc=$rowa["lab_bhc"];
		$fec_rec=$rowa["fec_rec"];
		echo"<br><table align=center class='tbl' width=100%>
		<tr><th align=center>$codigo $desclab ($fec_rec)</th></tr>
		</table>
		<br><table align=center class='tbl' width=100%>
		<tr>
		<th>Determinacion Cualitativa en suero de hormona Ganadotropina Canonica (HCG)</th>
		</tr>
		<tr>
		<td>$lab_bhc mUI/ml</td>
		</tr>
		<tr>
		<td>Nota: Tecnica Microelisa rapida sensibilidad 25 mIU/ml</th>
		</tr>
		</table>";


	}
}

///impresion de trimtropina
$result11=mysql_query("SELECT iden_dlab, lab_trim, fec_rec FROM labo_tri  WHERE cod_usu='$paciente' and cod_exam='$codigo' AND esta_ord <>'EL' order by fec_rec desc");

if(mysql_num_rows($result11)<>0)
{
	while($rowb=mysql_fetch_array($result11))
	{		
		$num_fac=$rowb["num_fac"];
		$lab_trim=$rowb["lab_trim"];
		$fec_rec=$rowb["fec_rec"];

		echo"<br><table align=center class='tbl' width=100%>
		<tr><th align=center>$codigo $desclab  (FECHA $fec_rec)</th></tr>
		</table>
		<br><table align=center class='tbl' width=100%>
		<tr>
		<th>Triponima I</th><td>$lab_trim</td><td>Sensibilidad 1 ng / ml</td>
		</tr>
		<tr>
		<td colspan=3>Nota: Tecnica Prueba Rapida de inmunocromotografia</td>
		</tr>		
		</table>";
	}
}

$conotrex=mysql_query("SELECT labo_oexa.iden_loex, labo_oexa.iden_dlab, labo_oexa.num_fac, labo_oexa.cod_loex, labo_oexa.cod_usu, labo_oexa.fec_recp, 
labo_oexa.fec_entr, labo_oexa.fsh_loex, labo_oexa.obs_fsh, labo_oexa.lsh_loex, labo_oexa.obs_lsh, labo_oexa.pgs_loex, labo_oexa.obs_pgs, labo_oexa.tst_loex, 
labo_oexa.obs_tst, labo_oexa.est_loex, labo_oexa.obs_est, labo_oexa.ige_loex, labo_oexa.obs_ige FROM labo_oexa
WHERE (((labo_oexa.cod_loex)='$codigo') AND ((labo_oexa.cod_usu)='$paciente') AND ((labo_oexa.fec_recp)>='$fechaini') AND ((labo_oexa.esta_ord)<>'EL')) order by labo_oexa.fec_recp desc");



if(mysql_num_rows($conotrex)<>0)
{
	while($rowcot=mysql_fetch_array($conotrex))
	{	
		$cod_loex=$rowcot[cod_loex];
		$fsh_loex=$rowcot[fsh_loex];
		$obs_fsh=$rowcot[obs_fsh];
		$lsh_loex=$rowcot[lsh_loex]; 
		$obs_lsh=$rowcot[obs_lsh];
		$pgs_loex=$rowcot[pgs_loex]; 
		$obs_pgs=$rowcot[obs_pgs];
		$tst_loex=$rowcot[tst_loex];
		$obs_tst=$rowcot[obs_tst];
		$est_loex=$rowcot[est_loex];
		$obs_est=$rowcot[obs_est];
		$ige_loex=$rowcot[ige_loex]; 
		$obs_ige=$rowcot[obs_ige];		
		if($cod_loex=='904105')
		{
			echo"<br><table align=center class='tbl'>
			<tr><th align=center>HORMONA FOLÍCULO ESTIMULANTE - FSH  (FECHA $fec_rec)</th></tr>
			</table>
			<br><table align=center class='tbl'>
			<tr>
			<th colspan=2>CARACTERISTICAS</th>
			</tr>
			<tr>
			<th>RESULTADOS</th><td>$fsh_loex</td>
			</tr>
			<tr>
			<th>Hombres</th><td>1-14</td>
			</tr>
			<tr>
			<th>Mujeres</th>
			</tr>
			<tr>
			<th>Fase Folicular</th><td>3.0 - 12.0</td>
			</tr>
			<tr>
			<th>Fase Ovulatoria</th><td>8.0 - 22 - 0</td>
			</tr>
			<tr>
			<th>Fase Luteal</th><td>2 - 12</td>
			</tr>
			<tr>
			<th>Post Menopausia</th><td>35 - 181</td>
			</tr>
			<tr>
			<th>OBSERVACIONES</th><td>$obs_fsh</td>
			</tr>
			</table><br>";		
		}		
		if($cod_loex=='904107')
		{
			echo"<br><table align=center class='tbl'>
			<tr><th align=center>HORMONA FOLÍCULO ESTIMULANTE - LSH  (FECHA $fec_rec)</th></tr>
			</table>
			<br><table align=center class='tbl'>
			<tr>
			<th colspan=2>CARACTERISTICAS</th>
			</tr>
			<tr>
			<th>RESULTADOS</th><td>$lsh_loex</td>
			</tr>
			<tr>
			<th>Hombres</th><td>1.7 - 8.6</td>
			</tr>
			<tr>
			<th>Mujeres</th>
			</tr>
			<tr>
			<th>Fase Folicular</th><td>2.4 - 12 - 6</td>
			</tr>
			<tr>
			<th>Fase Ovulatoria</th><td>14 - 96</td>
			</tr>
			<tr>
			<th>Fase Luteal</th><td>1.0 - 11.4</td>
			</tr>
			<tr>
			<th>Post Menopausia</th><td>7.7 - 59</td>
			</tr>
			<tr>
			<th>OBSERVACIONES</th><td>$obs_lsh</td>
			</tr>
			</table><br>";
			
		}
		
		if($cod_loex=='904510')
		{
			echo"<br><table align=center class='tbl'>
			<tr><th align=center>PROGESTERONA  (FECHA $fec_rec)</th></tr>
			</table>
			<br><table align=center class='tbl'>
			<tr>
			<th colspan=2>CARACTERISTICAS</th>
			</tr>
			<tr>
			<th>RESULTADOS</th><td>$pgs_loex</td>
			</tr>
			<tr>
			<th>Hombres</th><td>0.2 - 1.4</td>
			</tr>
			<tr>
			<th>Mujeres</th>
			</tr>
			<tr>
			<th>Fase Folicular</th><td>0.2 - 1.5</td>
			</tr>
			<tr>
			<th>Fase Ovulatoria</th><td>0.8 - 3.0</td>
			</tr>
			<tr>
			<th>Fase Luteal</th><td>1.7 - 2.7</td>
			</tr>
			<tr>
			<th>Post Menopausia</th><td>0.1 -0.8</td>
			</tr>
			<tr>
			<th>OBSERVACIONES</th><td>$obs_pgs</td>
			</tr>
			</table><br>";
		}		
		if($cod_loex=='904601')
		{
			echo"<br><table align=center class='tbl'>
			<tr><th align=center>TESTOSTERONA  (FECHA $fec_rec)</th></tr>
			</table>
			<br><table align=center class='tbl'>
			<tr>
			<th colspan=2>CARACTERISTICAS</th>
			</tr>
			<tr>
			<th>RESULTADOS</th><td>$tst_loex</td>
			</tr>
			<tr>
			<th>Hombres</th><td>2.8 - 8.0</td>
			</tr>
			<tr>
			<th>Mujeres</th><td>0.06 - 0.82</td>
			</tr>
			<tr>
			<th>1 año</th><td>0.12 - 0.21</td>
			</tr>
			<tr>
			<th>1 - 6 Años</th><td>0.03 - 0.32</td>
			</tr>
			<tr>
			<th>7 - 12 Años</th><td>0.03 - 0.68</td>
			</tr>
			<tr>
			<th>13 - 17 Años</th><td>0.28 - 11.1</td>
			</tr>
			<tr>
			<th>OBSERVACIONES</th><td>$obs_tst</td>
			</tr>
			</table><br>";
		}		
		if($cod_loex=='904503')
		{			
			echo"<br><table align=center class='tbl'>
			<tr><th align=center>ESTRADIOL  (FECHA $fec_rec)</th></tr>
			</table>
			<br><table align=center class='tbl'>
			<tr>
			<th colspan=2>CARACTERISTICAS</th>
			</tr>
			<tr>
			<th>RESULTADOS</th><td>$est_loex</td>
			</tr>
			<tr>
			<th>Hombres</th><td>7.63 - 42.6</td>
			</tr>
			<tr>
			<th>Mujeres</th><td>0.06 - 0.82</td>
			</tr>
			<tr>
			<th>Mujeres</th>
			</tr>
			<tr>
			<th>Fase Folicular</th><td>12.5 - 166</td>
			</tr>
			<tr>
			<th>Fase Ovulatoria</th><td>85.5 - 498</td>
			</tr>
			<tr>
			<th>Fase Luteal</th><td>43.8 - 211</td>
			</tr>
			<tr>
			<th>Post Menopausia</th><td>50 - 547</td>
			</tr>
			<tr>
			<th>OBSERVACIONES</th><td>$obs_est</td>
			</tr>
			</table><br>";
		}
		
		if($cod_loex=='906446')
		{
			echo"<br><table align=center class='tbl'>
			<tr><th align=center>ESTRADIOL  (FECHA $fec_rec)</th></tr>
			</table>
			<br><table align=center class='tbl'>
			<tr>
			<th colspan=2>CARACTERISTICAS</th>
			</tr>
			<tr>
			<th>RESULTADOS</th><td>$ige_loex</td>
			</tr>
			<tr>
			<th>Hombres</th><td>7.63 - 42.6</td>
			</tr>
			<tr>
			<th>Mujeres</th><td>0.06 - 0.82</td>
			</tr>
			<tr>
			<th>Mujeres</th>
			</tr>
			<tr>
			<th>Fase Folicular</th><td>12.5 - 166</td>
			</tr>
			<tr>
			<th>Fase Ovulatoria</th><td>85.5 - 498</td>
			</tr>
			<tr>
			<th>Fase Luteal</th><td>43.8 - 211</td>
			</tr>
			<tr>
			<th>Post Menopausia</th><td>50 - 547</td>
			</tr>
			<tr>
			<th>OBSERVACIONES</th><td>$obs_ige</td>
			</tr>
			</table><br>";				
		}	
	}
}



//impresion Examenes Varios ( 888)

$result12=mysql_query("SELECT dat_varios.iden_dlab, dat_varios.fec_rec, dat_varios.fec_ent, dat_varios.cod_usu, dat_varios.cod_examvr, dat_varios.datos
FROM dat_varios
WHERE (((dat_varios.fec_rec)>='$fechaini') AND ((dat_varios.cod_examvr)='$codigo') AND ((dat_varios.cod_usu)='$paciente') AND ((dat_varios.esta_ord)<>'EL')) order by dat_varios.fec_rec desc");

if(mysql_num_rows($result12)<>0)
{
	
	echo"<br><table align=center class='tbl' width=100%>
	<tr><th align=center>EXAMENES CUADRO DE VARIOS  (FECHA $fec_rec)</th></tr>
	</table>
	<br><table align=center class='tbl' width=100%>
	<tr>
	<th colspan=2>CARACTERISTICAS GENERALES - DATOS</th>
	";
	while($rowc=mysql_fetch_array($result12))

	{
	
		$num_fac=$rowc["num_fac"];
		$datos=$rowc["datos"];		
		$fec_rec=$rowc["fec_rec"];
		echo"<tr>
		<td>$fec_rec</td><td>$datos</td>	
		</tr>";
	}
	echo"</table>";
}
		
		
		
		
		
		/*
		
		$fila=$pdf->GetY()+10;		
		if($fila>=236)
		{
	
			$fila=increm($fila+4,$pdf,$cod,$nd_);
			

			$consultamed=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi, medicos.are_medi, Count(medicos.cod_medi) AS CuentaDecod_medi, detalle_labs.iden_labs
			FROM detalle_labs 
			INNER JOIN medicos ON detalle_labs.cod_medi = medicos.ced_medi
			WHERE detalle_labs.iden_labs='$iden_labs' AND detalle_labs.estd_dlab='CU'
			GROUP BY medicos.cod_medi, medicos.nom_medi, medicos.are_medi, detalle_labs.iden_labs");
			
			if(mysql_num_rows($consultamed)<>0)
			{
				$fila=40;
				$colm=20;
				while($rowmed=mysql_fetch_array($consultamed))
				{
				  
				  $nom_medi=$rowmed[nom_medi];
				  $reg_medi=$rowmed[reg_medi];
				  $cod_medi=$rowmed[cod_medi];
				  //******Revisar esta firma**************************
				  $firma="../firmas/".$rowmed[cod_medi].".jpg";
				 
				  //$pdf->SetXY($colm,$fila);
				  //$pdf->Cell(40,5,"Reg.". $firma,0);
				   
				 if(file_exists($firma))
				  {
					titulo($pdf,$fila,$nomimg);	
					$pdf->SetXY($colm,$fila);
					//$pdf->Cell(50,5,"Reg.".$colm.$firma,1);
					$pdf->Image($firma,$colm,$fila+10,35,25,'','');//15+fila manejan el abajo 
					$colm=$pdf->GetX()+40;//separacion de firmas
						
				  }
				}  
			}
		}
		
		
		else
		{
			$consultamed=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi, medicos.are_medi, Count(medicos.cod_medi) AS CuentaDecod_medi, detalle_labs.iden_labs
			FROM detalle_labs 
			INNER JOIN medicos ON detalle_labs.cod_medi = medicos.ced_medi
			WHERE detalle_labs.iden_labs='$iden_labs' AND detalle_labs.estd_dlab='CU'
			GROUP BY medicos.cod_medi, medicos.nom_medi, medicos.are_medi, detalle_labs.iden_labs");
			
			if(mysql_num_rows($consultamed)<>0)
			{
			
				$colm=30;
				while($rowmed=mysql_fetch_array($consultamed))
				{
				
				  $nom_medi=$rowmed[nom_medi];
				  $reg_medi=$rowmed[reg_medi];
				  $cod_medi=$rowmed[cod_medi];
				  $firma="../firmas/".$rowmed[cod_medi].".jpg";
				 
				  //$pdf->SetXY($colm,$fila);
				  //$pdf->Cell(40,5,"Reg.". $firma,0);
				   
				 if(file_exists($firma))
				  {
					titulo($pdf,$fila,$nomimg);	
					$pdf->SetXY($colm,$fila);
					//$pdf->Cell(50,5,"Reg.".$colm.$firma,1);
					$pdf->Image($firma,$colm,$fila+8,25,25,'','');//15+fila manejan el abajo 
					$colm=$pdf->GetX()+30;//separacion de firmas
						
				  }
				}  
			}
		
		
		
		}
		
		//$fhoy=date("Y-m-d"); 
		//$fila=$fila+8;
		titulo($pdf,$fila,$nomimg);
		//linea(100,$fila,50,"_",$pdf);
		//$fila=$fila+4;
		titulo($pdf,$fila,$nomimg);
		//$pdf->SetXY(120,$fila);
		//$pdf->Cell(40,5,$consultamed,0);
		//$pdf->Cell(40,5,"Bacteriolog@-".$fhoy,0);
		//$fila=$fila+4;
		//$pdf->SetXY(100,$fila);
		//$pdf->Cell(40,5,"Reg.".$reg_medi .'-'. $nom_esp,0);

	$pdf->Output();
*/
	function calculaedad2($fecha_,&$unidad_){
	  $ano_=substr($fecha_,0,4);
	  $mes_=substr($fecha_,5,2);
	  $dia_=substr($fecha_,8,2);
	  if($mes_==2){
		$diasmes_=28;}
	  else{
		if($mes_==1 || $mes_==3 || $mes_==5 || $mes_==7 || $mes_==8 || $mes_==10 || $mes_==12){
		  $diasmes_=31;}
		else{
		  $diasmes_=30;}
	  }
	  $anos_=date("Y")-$ano_;
	  $meses_=date("m")-$mes_;
	  $dias_=date("d")-$dia_;

	  if($dias_<0){
		if($meses_>0){$meses_=$meses_-1;}
		$dias_=$diasmes_+$dias_;
	  }

	  if($meses_<0){
		$meses_=12+$meses_;
		if(date("d")-$dia_<0){
		  $meses_=$meses_-1;}
		  $anos_=$anos_-1;
	  }
	  if($meses_==0 & date("d")-$dia_<0 & $anos_>0){
		if($anos_>0){$anos_=$anos_-1;}
		$meses_=11;
	  }

	  if($anos_<>0)
	  {
		$edad_=$anos_;
		if($edad_==1){
		  $unidad_="Año";}
		else{
		  $unidad_="Años";}
	  }
	  else
	  {
		if($meses_<>0){
		  $edad_=$meses_;
		  if($edad_==1){
			$unidad_="Mes";}
		  else{
			$unidad_="Meses";}
		}
		else{
		  $edad_=$dias_;
		  if($edad_==1){
			$unidad_="Día";}
		  else{
			$unidad_="Días";}
		}
	  }
		return($edad_);
	}


?>