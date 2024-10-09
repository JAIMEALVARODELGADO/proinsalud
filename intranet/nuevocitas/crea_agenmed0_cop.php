<?
session_start();
$usucitas=$_SESSION['usucitas'];
/*  

*/ 
?>
<!DOCTYPE html>
<html lang="on">
<head>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />  
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
	/*
	function elidias(p,v)
	{
		val="uno.selfecha"+p+".value=v";
		eval(val);		
		val="uno.fin"+p+".value";
		f=eval(val);
		for(i=0;i<f;i++)
		{
			ncit="uno.Usado_horario"+p+i+".value";
			usad="uno.ncita_horario"+p+i+".value";
			if(eval(ncit)==eval(usad))
			{
				val="uno.selhora"+p+i+".value=v";
				eval(val);
			}
		}
		uno.target='';
		uno,action='genhor0.php';
		uno.submit();
		
	}
	function elihoras(p,r,v)
	{		
		val="uno.selhora"+p+r+".value=v";
		eval(val);		
		uno.target='';
		uno,action='genhor0.php';
		uno.submit();
		
	}
	function valida()
	{
		if(uno.areasel.value=='-1')
		{
			alert("Seleccione el area");
			uno.areasel.focus();
			return;
		}
				
		if(uno.medico.value=='')
		{
			alert("Seleccione el médico");
			return;
		}
		if(uno.fechaini.value=='')
		{
			alert("Seleccione La fecha inicial");
			uno.fechaini.focus();
			return;
		}
		if(uno.fechafin.value=='')
		{
			alert("Seleccione La fecha final");
			uno.fechafin.focus();
			return;
		}	
		
		uno.target='';
		uno.action='elim_horario1.php';
		uno.submit();
	}
	
	function valfec(n)
	{		
		if(n==2)
		{
			if(uno.fechafin.value<uno.fecrec.value)
			{
				alert("La fecha final no puede ser igual o anterior a la fecha actual");
				uno.fechafin.value=uno.fecrec.value
				uno.fechafin.focus();
				return;			
			}
			if(uno.fechaini.value>uno.fechafin.value)
			{
				alert("La fecha de inicio no puede ser mayor a la fecha final");
				uno.fechaini.value=uno.fecrec.value
				uno.fechaini.focus();
				return;			
			}	
			
		}
		uno.target='';
		uno.action='elim_horario0.php';
		uno.submit();	
	}
	*/
	function salto()
	{		
		uno.target='';
		uno.action='crea_agenmed0.php';
		uno.submit();
	}
	
	function editar(n)
	{
		uno.idencam.value=n;
		uno.target='';
		uno.action='crea_agenmed0.php';
		uno.submit();
	}
	function guardar1(n)
	{
		uno.idencam.value=n;
		uno.accion.value=1;
		uno.target='';
		uno.action='crea_agenmed1.php';
		uno.submit();
	}
	function guardar2()
	{
		uno.accion.value=2;
		uno.target='';
		uno.action='crea_agenmed1.php';
		uno.submit();
	}
	function eliminar(n)
	{
		uno.idencam.value=n;
		uno.accion.value=3;
		uno.target='';
		uno.action='crea_agenmed1.php';
		uno.submit();
	}
	function guardatur()
	{
		uno.accion.value=4;
		uno.target='';
		uno.action='crea_agenmed1.php';
		uno.submit();
	}
	function guardahorario()
	{
		uno.accion.value=5;
		uno.target='';
		uno.action='crea_agenmed1.php';
		uno.submit();
	}
	
	function showModal() 
	{
				
		document.getElementById('openModal').style.display = 'block';
	}

	function CloseModal() 
	{
		document.getElementById('openModal').style.display = 'none';
	}
</script>
</head>
<body style='position:absolute;margin-top:10' onload="javascript:showModal()">
<style>

	.modalDialog {
	position: fixed;
	font-family: Arial, Helvetica, sans-serif;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background: rgba(0,0,0,0.8);
	z-index: 99999;
	display:none;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: auto;
}
.modalDialog > div {
	width: 400px;
	position: relative;
	margin: 10% auto;
	padding: 5px 20px 13px 20px;
	border-radius: 10px;
	background: #fff;
	background: -moz-linear-gradient(#fff, #999);
	background: -webkit-linear-gradient(#fff, #999);
	background: -o-linear-gradient(#fff, #999);
  -webkit-transition: opacity 400ms ease-in;
-moz-transition: opacity 400ms ease-in;
transition: opacity 400ms ease-in;
}
.close {
	background: #606061;
	color: #FFFFFF;
	line-height: 25px;
	position: absolute;
	right: -12px;
	text-align: center;
	top: -10px;
	width: 24px;
	text-decoration: none;
	font-weight: bold;
	-webkit-border-radius: 12px;
	-moz-border-radius: 12px;
	border-radius: 12px;
	-moz-box-shadow: 1px 1px 3px #000;
	-webkit-box-shadow: 1px 1px 3px #000;
	box-shadow: 1px 1px 3px #000;
}
.close:hover { background: #00d9ff; }

</style> 
<?	
	
	// 192.168.4.20/intraweb/intranet/nuevocitas/crea_agenmed0.php
	
	/*
	
	if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
	
	$dateh=date("Y-m-d");	
	$anoini=substr($dateh,0,4);
	$mesini=substr($dateh,5,2);
	$diaini=substr($dateh,8,2);
	$dateini = gmmktime ( 00, 00, 00, $mesini, $diaini, $anoini);	
	$diaprog=$dateini+86400;
	$fechasig=gmdate ( "Y-m-d", $diaprog);
	if(empty($fechaini))$fechaini=$fechasig;
	if(empty($fechafin))$fechafin=$fechasig;
	*/
	/*
	foreach($_POST as $nombre_campo => $valor)
	{ 
	   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
	   eval($asignacion); 
	}
	*/
	echo"<form name=uno method=post>
	<input type=hidden name=idencam>
	<input type=hidden name=accion>";
	include ('php/conexion1.php');
	
	/*
	$busarea=mysql_query("SELECT areas.equi_area
	FROM areas_medic INNER JOIN areas ON areas_medic.areas_ar = areas.cod_areas
	WHERE (((areas.tipo_areas)='1') AND ((areas.equi_area)<>''))
	GROUP BY areas.equi_area
	ORDER BY Max(areas.nom_areas)");
	*/
	
	$busarea=mysql_query("SELECT areas.equi_area
	FROM areas
	WHERE (((areas.tipo_areas)='1') AND ((areas.equi_area)<>''))
	GROUP BY areas.equi_area");
	
	
	
	$j=0;
	while($resarea=mysql_fetch_array($busarea))	
	{
		$areaen=$resarea['equi_area'];
		 
		$busa=mysql_query("SELECT areas.cod_areas, areas.nom_areas
		FROM areas WHERE cod_areas='$areaen'");
		while($rar=mysql_fetch_array($busa))	
		{			
			$codare=$rar['cod_areas'];
            $nomare=$rar['nom_areas'];
		}
		$vec[$j][0]=$nomare;
		$vec[$j][1]=$codare;
		
		$j++;
	}
	$f=$j;
	for($i=0;$i<$f;$i++)
	{
		for($j=0;$j<$f;$j++)
		{
			$val=strcasecmp ($vec[$i][0], $vec[$j][0]);
			if($val<0)
			{
				$aux1=$vec[$i][0];
				$aux2=$vec[$i][1];				
				$vec[$i][0]=$vec[$j][0];
				$vec[$i][1]=$vec[$j][1];				
				$vec[$j][0]=$aux1;
				$vec[$j][1]=$aux2;
			}
		}
	}

	//asort($vec);
	

	$bmedi=mysql_query("SELECT medicos.nom_medi, medicos.cod_medi
	FROM medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar
	WHERE (((areas_medic.areas_ar)='$areasel')) and (((areas_medic.areas_ar)<>'')) AND medicos.esta_medi='A' AND areas_medic.esta_ar='A'  order by medicos.nom_medi");	
	
	echo "<table align=center class='tbl'>
	<tr>
	<th>AREA</th><td>
	<select name=areasel class='caja' onchange='salto()'>
	<option value='-1'></option>";
	for($i=0;$i<$j;$i++)	
	{		
		$nomare=$vec[$i][0];
		$codare=$vec[$i][1];						
		if($areasel==$codare)echo"<option selected value=$codare>$nomare</option>";	
		else echo"<option value=$codare>$nomare</option>";	
				
	}
	
	echo"
	</select>
	</tr>	
	<tr>
	<th>MEDICO</th><td>
	<select name=medico class='caja' onchange='salto()'>
	<option value=''></option>";			
	while($rmedi=mysql_fetch_array($bmedi))
	{
		$codimed=$rmedi['cod_medi'];
		$nombmed=$rmedi['nom_medi'];			
		if($medico==$codimed)echo"<option selected value=$codimed>$nombmed</option>";
		else echo"<option value=$codimed>$nombmed</option>";			
	}
	echo "</select>
	</td>
	</tr>
	<table><br>";	
	echo"<table align=center class='tbl'>
	<tr>
	<th>HORA INICIO</th>
	<th>HORA FIN</th>
	<th>INTERVALO</th>
	<th>PACIENTES POR TURNO</th>
	<th>LUN</th>
	<th>MAR</th>
	<th>MIE</th>
	<th>JUE</th>
	<th>VIE</th>
	<th>SAB</th>
	<th>DOM</th>
	<th>REPITE AGENDA</th>
	<th>OBSERVACIONES</th>
	<th>DIRECCION</th>
	<th>VEC VENCIMIENTO</th>
	<th>ACCION</th>
	</tr>";
	
	$bage=mysql_query("select * from horarios_agenda_med where area='$areasel' and medico='$medico' and estado='AC' ORDER BY hora_ini, hora_fin");
	$nen=mysql_num_rows($bage);
	if($nen>0)
	{
		$n=0;
		while($rage=mysql_fetch_array($bage))
		{
			$idenagen1=$rage['idenagen'];
			$area1=$rage['area'];
			$medico1=$rage['medico'];
			$hora_ini1=$rage['hora_ini'];
			$hora_fin1=$rage['hora_fin'];
			$intervalo1=$rage['intervalo'];
			$pacxturno1=$rage['pacxturno'];
			$lun1=$rage['lun'];
			$mar1=$rage['mar'];
			$mie1=$rage['mie'];
			$jue1=$rage['jue'];
			$vie1=$rage['vie'];
			$sab1=$rage['sab'];
			$dom1=$rage['dom'];
			$intervasem1=$rage['intervasem'];
			$observacion1=$rage['observacion'];
			$direccion1=$rage['direccion'];
			$fvenci1=$rage['fvenci'];
			$estado1=$rage['estado'];
			$fcreacion1=$rage['fcreacion'];
			$usuario1=$rage['usuario'];
			
			$hini1=substr($hora_ini1,0,2);
			$mini1=substr($hora_ini1,3,2);
			$hfin1=substr($hora_fin1,0,2);
			$mfin1=substr($hora_fin1,3,2);
			
			if($idenagen1==$idencam)
			{
				$ch11='';$ch21='';$ch31='';$ch41='';$ch51='';$ch61='';$ch71='';
				if($lun1=='1')$ch11='checked';
				if($mar1=='1')$ch21='checked';
				if($mie1=='1')$ch31='checked';
				if($jue1=='1')$ch41='checked';
				if($vie1=='1')$ch51='checked';
				if($sab1=='1')$ch61='checked';
				if($dom1=='1')$ch71='checked';
				$sel11='';$sel21='';$sel31='';
				if($intervasem1=='1')$sel11='selected';
				if($intervasem1=='2')$sel21='selected';
				if($intervasem1=='3')$sel31='selected';
				
				
				echo"
				<tr>
				<td align=center><input type=text size=2 class='caja' name=hini1 value='$hini1'> <input type=text size=2 class='caja' name=mini1 value='$mini1'></td>
				<td align=center><input type=text size=2 class='caja' name=hfin1 value='$hfin1'> <input type=text size=2 class='caja' name=mfin1 value='$mfin1'></td>
				<td align=center><input type=text size=2 class='caja' name=inter1 value='$intervalo1'></td>
				<td align=center><input type=text size=2 class='caja' name=pacxtur1 value='$pacxturno1'></td>
				<td align=center><input type=checkbox class='caja' $ch11 name=lun1 value='1'></td>
				<td align=center><input type=checkbox class='caja' $ch21 name=mar1 value='1'></td>
				<td align=center><input type=checkbox class='caja' $ch31 name=mie1 value='1'></td>
				<td align=center><input type=checkbox class='caja' $ch41 name=jue1 value='1'></td>
				<td align=center><input type=checkbox class='caja' $ch51 name=vie1 value='1'></td>
				<td align=center><input type=checkbox class='caja' $ch61 name=sab1 value='1'></td>
				<td align=center><input type=checkbox class='caja' $ch71 name=dom1 value='1'></td>
				
				<td align=center><select class='caja' name=intersem1>
				<option value='0'></option>
				<option $sel11 value='1'>SEMANAL</option>
				<option $sel21 value='2'>QUINCENAL</option>
				<option $sel31 value='3'>MENSUAL</option>
				</select>
				</td>
				<td align=center><TEXTAREA name='obse1' class='caja' class='caja' cols=60 row=2>$observacion1</textarea></td>
				<td align=center><TEXTAREA name='direc1' class='caja' class='caja' cols=30 row=2>$direccion1</textarea></td>
				<td align=center>";
				?>
				<input type="text" name="fechaven1"  class='caja' size="10"  maxlength="10" value="<?echo $fvenci1;?>" id="fven01" <?echo $disp;?>>
				<input type="button" class='caja' id="lanzador01" name="bot01" value="..." <?echo $disp;?>/>
				<!-- script que define y configura el calendario--> 
				<script type="text/javascript"> 
				Calendar.setup({ 
				inputField     :    "fven01",     // id del campo de texto 
				ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
				button     :    "lanzador01"     // el id del botón que lanzará el calendario 				
				}); 
				</script> 				
				<?		
				echo"</td>
				<th><a href='#' onclick='guardar1($idenagen1)'> Guardar </a></th>
				</tr>";
			
			}
			else
			{
				if($intervasem1=='1')$inters='SEMANAL';
				if($intervasem1=='2')$inters='QUINCENAL';
				if($intervasem1=='3')$inters='MENSUAL';
				
				$lu='';$ma='';$mi='';$ju='';$vi='';$sa='';$do='';
				
				if($lun1=='1')$lu='X';
				if($mar1=='1')$ma='X';
				if($mie1=='1')$mi='X';
				if($jue1=='1')$ju='X';
				if($vie1=='1')$vi='X';
				if($sab1=='1')$sa='X';
				if($dom1=='1')$do='X';
				
				echo"<tr>
				<td align=center>$hini1 : $mini1</th>
				<td align=center>$hfin1 : $mfin1</th>
				<td align=center>$intervalo1</th>
				<td align=center>$pacxturno1</th>
				<td align=center>$lu</th>
				<td align=center>$ma</th>
				<td align=center>$mi</th>
				<td align=center>$ju</th>
				<td align=center>$vi</th>
				<td align=center>$sa</th>
				<td align=center>$do</th>
				<td align=center>$inters</th>
				<td align=center>$observacion1</th>
				<td align=center>$direccion1</th>
				<td align=center>$fvenci1</th>
				<th align=center><a href='#' onclick='editar($idenagen1)'> EDITAR </a> -------- <a href='#' onclick='eliminar($idenagen1)'> ELIMINAR </a></th>
				</tr>";
			}
		}		
	}
	/*
	echo"<tr>
	<th>HORAS SEMANALES CONTRATADAS</th><td><input type=text class='caja' name=horcon value='$horcon'></td>
	</tr>
	<tr>
	<th>TOTAL TURNOS SEMANA</th><td><input type=text class='caja' name=tottur value='$tottur'></td>
	</tr>
	*/
	
	
	if(empty($idencam))
	{
		$ch1='';$ch2='';$ch3='';$ch4='';$ch5='';$ch6='';$ch7='';
		if($lun=='1')$ch1='checked';
		if($mar=='1')$ch2='checked';
		if($mie=='1')$ch3='checked';
		if($jue=='1')$ch4='checked';
		if($vie=='1')$ch5='checked';
		if($sab=='1')$ch6='checked';
		if($dom=='1')$ch7='checked';
		$sel1='';$sel2='';$sel3='';
		if($intersem=='1')$sel1='selected';
		if($intersem=='2')$sel2='selected';
		if($intersem=='3')$sel3='selected';
		
		echo"
		<tr>
		<td colspan=16 height=40></td>
		</tr>
		<tr>
		<td align=center><input type=text size=2 class='caja' name=hini value='$hini'> <input type=text size=2 class='caja' name=mini value='$mini'></td>
		<td align=center><input type=text size=2 class='caja' name=hfin value='$hfin'> <input type=text size=2 class='caja' name=mfin value='$mfin'></td>
		<td align=center><input type=text size=2 class='caja' name=inter value='$inter'></td>
		<td align=center><input type=text size=2 class='caja' name=pacxtur value='$pacxtur'></td>
		<td align=center><input type=checkbox class='caja' $ch1 name=lun value='1'></td>
		<td align=center><input type=checkbox class='caja' $ch2 name=mar value='1'></td>
		<td align=center><input type=checkbox class='caja' $ch3 name=mie value='1'></td>
		<td align=center><input type=checkbox class='caja' $ch4 name=jue value='1'></td>
		<td align=center><input type=checkbox class='caja' $ch5 name=vie value='1'></td>
		<td align=center><input type=checkbox class='caja' $ch6 name=sab value='1'></td>
		<td align=center><input type=checkbox class='caja' $ch7 name=dom value='1'></td>
		
		<td align=center><select class='caja' name=intersem>
		<option value='0'></option>
		<option $sel1 value='1'>SEMANAL</option>
		<option $sel2 value='2'>QUINCENAL</option>
		<option $sel3 value='3'>MENSUAL</option>
		</select>
		</td>
		<td align=center><TEXTAREA name='obse' class='caja' class='caja' cols=60 row=2>$obse</textarea></td>
		<td align=center><TEXTAREA name='direc' class='caja' class='caja' cols=30 row=2>$direc</textarea></td>
		<td align=center>";
		?>
		<input type="text" name="fechaven" class='caja' size="10"  maxlength="10" value="<?echo $fechaven;?>" id="fven" <?echo $disp;?>>
		<input type="button" class='caja' id="lanzador0" name="bot0" value="..." <?echo $disp;?>/>
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField     :    "fven",     // id del campo de texto 
		ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
		button     :    "lanzador0"     // el id del botón que lanzará el calendario 				
		}); 
		</script> 				
		<?		
		echo"</td>
		<th><a href='#' onclick='guardar2()'> Guardar </a></th>
		</tr>";
	}
	echo"</table><br><br>";
	
	
	/*
	$bage=mysql_query("SELECT areas_medic.areas_ar, areas.nom_areas, areas_medic.cod_ar, horarios_turnos_med.turnos
	FROM (areas INNER JOIN areas_medic ON areas.cod_areas = areas_medic.areas_ar) LEFT JOIN horarios_turnos_med ON areas_medic.cod_ar = horarios_turnos_med.cod_ar
	WHERE (((areas_medic.cod_med_ar)='$medico') AND ((areas.equi_area)='$areasel') AND ((areas_medic.esta_ar)='A'))");
	echo"<table align=center class='tbl'>
	<tr>
	<th>CODIGO</th>
	<th>NOMBRE AREA</th>
	<th>NUMERO TURNOS</th>
	";
	$n=0;
	while($rage=mysql_fetch_array($bage))
	{
		$care=$rage['areas_ar'];
		$nare=$rage['nom_areas'];
		$identur=$rage['cod_ar'];
		$turnos=$rage['turnos'];
		
		
		$nomvar='identur'.$n;
		echo "<input type=hidden name='$nomvar' value='$identur'>";
		$nomvar='turnos'.$n;
		echo"<tr>
		<td align=center>$care</td>
		<td>$nare</td>
		<td align=center><input type=text size=2 class=caja onblur='cuenta()' name='$nomvar' value='$turnos'></td>
		</tr>";
		$n++;
		
	}
	echo "
	
	<input type=hidden name=item value=$n>
	
	<tr>
	<td colspan=2 align=center>TOTAL TURNOS</td><td align=center> <input size=2 class=caja3 onfocus='foco()' type=text name=total value=$total></td>
	</tr>
	
	<tr>
	<td colspan=3 align=center><input type=button class=boton name=guar onclick=guardatur() value='GUARDAR'></td>
	</tr>";
	
	echo"</table>
	<br><br>";
	*/
	
	
	echo"<table align=center class='tbl'>
	<tr><Th colspan=2>GENERAR HORARIOS</th><tr>
	<tr>
	<th>AÑO</th>
	<th>MES</th>
	<th>AREA</th>
	</tr>
	
	<tr>
	<td>
	<select class=caja name=anno onchange=salto()>
	<option value=''></option>
	<option value='2020'>2020</option>
	<option value='2021'>2021</option>
	<option value='2022'>2022</option>
	<option value='2023'>2023</option>
	<select>
	</td>
	<td>
	<select class=caja name=mes onchange=salto()>
	<option value=''></option>
	<option value='01'>ENERO</option>
	<option value='02'>FEBRERO</option>
	<option value='03'>MARZO</option>
	<option value='04'>ABRIL</option>
	<option value='05'>MAYO</option>
	<option value='06'>JUNIO</option>
	<option value='07'>JULIO</option>
	<option value='08'>AGOSTO</option>
	<option value='09'>SEPTIEMBRE</option>
	<option value='10'>OCTUBRE</option>
	<option value='11'>NOVIEMBRE</option>
	<option value='12'>DICIEMBRE</option>
	<select>
	</td>";
	$bage=mysql_query("SELECT areas_medic.areas_ar, areas.nom_areas, areas_medic.cod_ar
FROM areas INNER JOIN areas_medic ON areas.cod_areas = areas_medic.areas_ar
WHERE (((areas_medic.cod_med_ar)='$medico') AND ((areas.equi_area)='$areasel') AND ((areas_medic.esta_ar)='A'));
");
	
	echo"<td><select name=areamun class=caja onchange='salto()'>
	<option value=''></option>";
	while($rage=mysql_fetch_array($bage))
	{
		$care=$rage['areas_ar'];
		$nare=$rage['nom_areas'];
		if($care==$areamun)echo"<option selected value='$care'>$nare</option>";
		else echo"<option value='$care'>$nare</option>";		
	}
	echo"</select>	
	</td>
	
	
	
	</tr>
	</table>";
	?>
		<script language='Javascript'>
		uno.anno.value="<?php echo $anno;?>";
		uno.mes.value="<?php echo $mes;?>";
		</script>
	<?	
	
	if($anno!='' && $mes!='' && $areamun!='')
	{
	
		$fecin=$anno.'-'.$mes.'-01';
		$ndias=date( 't', strtotime( $fecin ) ); //obtener numero de dias del mes
		//echo "<table align=center>
		//<tr><td>";		
		
		echo"<input type=hidden name=ndias value='$ndias'>";
		for($i=1;$i<=$ndias;$i++)
		{
			if($i<10)$d='0'.$i;
			else $d=$i;		
			$diasem=date("w", mktime(0, 0, 0, $mes, $d, $anno)); //obtiene dia de la semana
			if($diasem==0)$nomdia='dom';
			if($diasem==1)$nomdia='lun';
			if($diasem==2)$nomdia='mar';
			if($diasem==3)$nomdia='mie';
			if($diasem==4)$nomdia='jue';
			if($diasem==5)$nomdia='vie';
			if($diasem==6)$nomdia='sab';
			
			if($diasem==0)$diasem='domingo';
			if($diasem==1)$diasem='lunes';
			if($diasem==2)$diasem='martes';
			if($diasem==3)$diasem='miercoles';
			if($diasem==4)$diasem='jueves';
			if($diasem==5)$diasem='viernes';
			if($diasem==6)$diasem='sabado';
			
			$fechahor=$anno.'-'.$mes.'-'.$d;
			$bs=mysql_query("SELECT * FROM horarios_agenda_med WHERE area='$areasel' AND medico='$medico' AND $nomdia='1' AND estado='AC' ORDER BY hora_ini");
			$tursig=0;
			if(mysql_num_rows($bs)>0)
			{
				echo"<table align=left class='tbl6'>
				<tr>
				<th width=50>$fechahor</th>		
				<th width=40>$nomdia</th>";
				$n=0;
				while($rs=mysql_fetch_array($bs))
				{
					$hora_ini=$rs['hora_ini'];
					$hora_fin=$rs['hora_fin'];
					$intervalo=$rs['intervalo'];
					$pacxturno=$rs['pacxturno'];
					$intervasem=$rs['intervasem'];
					$observacion=$rs['observacion'];
					
					$hori=substr($hora_ini,0,2);
					$mini=substr($hora_ini,3,2);
					$segi=substr($hora_ini,6,2);
					$horf=substr($hora_fin,0,2);
					$minf=substr($hora_fin,3,2);
					$segf=substr($hora_fin,6,2);
					$interseg=$intervalo*60;
					
					$turini=gmmktime ( $hori, $mini, $segi, $mes, $d, $anno);	//convertir fecha a timestamp
					$turfin=gmmktime ( $horf, $minf, $segf, $mes, $d, $anno);
					$dif=$turfin-$turini;
					$tursig=$turini;
					
					while($tursig<$turfin)
					{
						$horario=gmdate ( "Y-m-d,H:i:s", $tursig);
						$hora=substr($horario,11,5);
						$h=substr($horario,11,8);
						$horahor='0001-01-01 '.$h;
						 
						$bhorcre=mysql_query("SELECT horarios.Cserv_horario, areas.nom_areas
						FROM horarios INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas
						WHERE (((horarios.Fecha_horario)='$fechahor') AND ((horarios.Hora_horario)='$horahor') AND ((horarios.Cmed_horario)='$medico'))");
						if(mysql_num_rows($bhorcre)==0)
						{
							
							$nomvar='diasem'.$i;
							echo "<input type=hidden name=$nomvar value='$diasem'>";
							$nomvar='fechah'.$i;
							echo "<input type=hidden name=$nomvar value='$fechahor'>";
							$nomvar='pacxturno'.$i;
							echo "<input type=hidden name=$nomvar value='$pacxturno'>";
							$nomvar='horah'.$i.'-'.$n;
							echo "<input type=hidden name=$nomvar value='$horahor'>";
							$nomvar='check'.$i.'-'.$n;
							echo "<td width=40 align=center><input type=checkbox name=$nomvar value='1'> $hora</td>";
						}
						else
						{
							$bhcrea=mysql_fetch_array($bhorcre);
							$arecre=$bhcrea['Cserv_horario'];
							$nomare=$bhcrea['nom_areas'];
							
							
							
							if($arecre==$areamun)
							{							
								echo "<td width=40 align=center><input type=checkbox disabled title='$nomare' name=$nomvar value='$hora'> <font color='#FF0000'>$hora</font></td>";
							}
							else
							{							
								echo "<td width=40 align=center><input type=checkbox disabled title='$nomare' name=$nomvar value='$hora'> <font color='#999999'>$hora</font></td>";
							}
						}
						
						$tursig=$tursig+$interseg;
						$n++;
					}				
				}
				$bnov=mysql_query("SELECT citas_novedades.obse_nov, areas.nom_areas
				FROM citas_novedades INNER JOIN areas ON citas_novedades.area_nov = areas.cod_areas
				WHERE (((citas_novedades.fecini_nov)<='$fechahor') AND ((citas_novedades.fecfin_nov)>='$fechahor') AND ((citas_novedades.medico_nov)='$medico'))");
				while($rnov=mysql_fetch_array($bnov))
				{
					$novedad=$rnov['obse_nov'];
					$area_nov=$rnov['nom_areas'];
					echo "<th>$novedad</th>";
				}
				
				echo"</tr>
				</table><br><br><br>";
				$nomvar='finturno'.$i;
				echo"<input type=hidden name=$nomvar value=$n>";
				
				
			}
		}
		//echo"</td></tr></table>";
		//$bhor=
		echo"<table align=center class='tbl'>
		<tr>
		<th><input type=button onclick='guardahorario()' value='GUARDAR'></th>
		</tr></table>";
	}	
	
?>

	<a href="#openModal">Lanzar el modal</a>


	


    <div id="openModal" class="modalDialog">
      <div>
       
		
		<a href="#close" title="Close" class="close" onclick="javascript:CloseModal();">X</a>
		
        <h2>Mi modal</h2>
        <p>Este es un ejemplo de modal, creado gracias al poder de CSS3.</p>
        <p>Puedes hacer un montón de cosas aquí, como alertas o incluso crear un formulario de registro aquí mismo.</p>
      </div>
    </div>
  
	</form>

</body>
</html>




























