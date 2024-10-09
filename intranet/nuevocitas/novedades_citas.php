<?
session_start();
$usucitas=$_SESSION['usucitas'];
?>
<HTML>
<TITLE>TURNOS CITAS</TITLE>
<head>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />  
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
	function guardar()
	{
		if(uno.fechanov.value=='')
		{
			alert("La fecha de la novedad no puede ir vacia");
			uno.fechanov.focus();
			return;
		}	
		if(uno.nomauto.value=='')
		{
			alert("El nombre de quien autoriza no puede ir vacio");
			uno.nomauto.focus();
			return;
		}
	
		
		if(uno.areasel.value=='0')
		{
			alert("El area no puede ir vacio");
			uno.areasel.focus();
			return;
		}	
		if(uno.medico.value=='0')
		{
			alert("El medico no puede ir vacio");
			uno.medico.focus();
			return;
		}	
		if(uno.novedad.value=='')
		{
			alert("La novedad no puede ir vacia");
			uno.novedad.focus();
			return;
		}	
		if(uno.fechaini.value=='')
		{
			alert("La fecha inicial no puede ir vacia");
			uno.fechaini.focus();
			return;
		}	
		if(uno.fechafin.value=='')
		{
			alert("La fecha final no puede ir vacia");
			uno.fechafin.focus();
			return;
		}
		
		if(uno.fechaini.value>uno.fechafin.value)
		{
			alert("La fecha de inicio no puede ser mayor a la fecha final");
			uno.fechaini.focus();
			return;
		}
		uno.guarda.value='2';
		uno.action='novedades_citas.php';
		uno.target='';
		uno.submit();
	}
	function actualiza()
	{
		if(uno.fechainic.value>uno.fechafinc.value)
		{
			alert("LA FECHA INICIAL NO PUEDE SER MAYOR QUE LA FECHA FINAL");
			return;
		}
		uno.target='';
		uno.action='novedades_citas.php';
		uno.submit();
		
	}
	function actualiza1()
	{
		uno.target='';
		uno.action='novedades_citas.php';
		uno.submit();
	}
	function actualiza2()
	{
		if(uno.fechainic.value>uno.fechafinc.value)
		{
			alert("LA FECHA INICIAL NO PUEDE SER MAYOR QUE LA FECHA FINAL");
			uno.fechafinc.focus();
			return;
		}
		uno.medicoc.value='';
		uno.target='';
		uno.action='novedades_citas.php';
		uno.submit();
		
	}
	function elimina(n)
	{
		var respuesta = confirm("Eliminar novedad?");
        if (respuesta==false)return;	
		uno.elireg.value='2';
		uno.ideneli.value=n;		
		uno.action='novedades_citas.php';
		uno.target='';
		uno.submit();
		
	}
	
	function seltipo(n)
	{
		uno.tipocon.value=n;
		uno.action='novedades_citas.php';
		uno.target='';
		uno.submit();
	}

</script>	
</head>
<BODY bgcolor=#EFF8FB>
<form name='uno' method='post'>
<?php
	// http://192.168.4.12/intraweb/intranet/nuevocitas/novedades_citas.php
	
	/*
		Fecha de realizada la novedad			
		Nombre quien autoriza la novedad
		Area
		Medico
		observacion
		Fecha inicial
		Fecha final
			id
			Fecha de registro de novedad
			Hora registro
			usuario registro
		
		
	
	*/
	
	
	foreach($_POST as $nombre_campo => $valor)
	{ 
		$asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
		eval($asignacion);		
	}
	foreach($_GET as $nombre_campo => $valor)
	{ 
		$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
		eval($asignacion);
	}
	
	$link=Mysql_connect("localhost","root","");
    if(!$link)echo"no hay conexion";
    Mysql_select_db('proinsalud',$link);		
	$fechasis=date('Y-m-d');
	$horasis=date('H:i:s');		
	
	echo"
	<input type=hidden name=tipocon value='$tipocon'>
	<input type=hidden name=guarda value='0'>
	<input type=hidden name=elireg value='0'>
	<input type=hidden name=ideneli value='0'>
	
	
	<table class='tbl' align=center>
	<tr>
	<th><input type='button' class='caja' onclick='seltipo(1)'  value='INGRESAR NOVEDADES'></th>
	<th><input type='button' class='caja' onclick='seltipo(2)'  value='CONSULTAR NOVEDADES'></th>
	<tr>
	</table>
	<br>";
	if($tipocon=='1')
	{
		if($guarda=='2')
		{
			$sql=mysql_query("INSERT INTO `citas_novedades` (
			`iden_nov`,`nomauto_nov`,`area_nov`,`medico_nov`,`obse_nov`,`fecini_nov`,`fecfin_nov`,`fecha_nov`,`fecreg_nov`,`horreg_nov`,`usuario_nov`)
			VALUES (NULL , '$nomauto', '$areasel', '$medico', '$novedad', '$fechaini', '$fechafin', '$fechanov', '$fechasis', '$horasis', '$usucitas')");
			$nomauto='';
			$areasel='';
			$medico='';
			$novedad='';
			$fechaini='';
			$fechafin='';
			$fechanov='';
		}	
		echo"		
		<table class='tbl' align=center>
		<tr>
		<th colspan=2 align=center><b>REGISTRO DE NOVEDADES CITAS MEDICAS</td>
		</tr>
		
		<tr>
		<th><b>FECHA NOVEDAD</th>
		<td>";
		?>	
		<input type="text" name="fechanov" class='caja' size="8" maxlength="10" value="<?echo $fechanov;?>" id="fnov" <?echo $disp;?>>
		<input type="button" class='caja' id="lanzador1" name="bot1" value="..." <?echo $disp;?>/>
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript">
		Calendar.setup({
		inputField     :    "fnov",     // id del campo de texto
		ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto
		button     :    "lanzador1"     // el id del botn que lanzar el calendario
		});
		</script>
		<?php	
		echo"</td>
		</tr>
		<tr>
		<td>NOMBRE QUIEN AUTORIZA</td>
		<td><input type=text name='nomauto' class=caja size=40 value='$nomauto'></td>
		</tr>";		
		$bare=mysql_query("SELECT * FROM `areas` WHERE `arci_area` LIKE '58%' ORDER BY nom_areas");
		echo"<tr>
		<td>AREA</td>
		<td valign=top><select name=areasel class='caja' onchange='actualiza1()'>
		<option value='0'></option>";       
		while($resarea=mysql_fetch_array($bare))
		{
			$codare=$resarea['cod_areas'];
			$nomare=$resarea['nom_areas'];		
						
				if($areasel===$codare)echo"<option selected value=$codare>$nomare</option>";	
				else echo"<option value=$codare>$nomare</option>";	
			
		}
		echo"<select></td>
		</tr>";
		
		$bmedi=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi, areas.cod_areas, medicos.esta_medi
		FROM (medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar) INNER JOIN areas ON areas_medic.areas_ar = areas.cod_areas
		WHERE (((areas.cod_areas)='$areasel') AND ((medicos.esta_medi)='A') AND ((areas_medic.esta_ar)='A') AND ((medicos.esta_medi)='A'))
		GROUP BY medicos.cod_medi, medicos.nom_medi, areas.cod_areas, medicos.esta_medi
		ORDER BY medicos.nom_medi");
		
		echo"<tr>
		<td>MEDICO</td>
		<td valign=top><select name=medico class='caja'>
		<option value='0'></option>";       
		while($rmed=mysql_fetch_array($bmedi))
		{
			$codmed=$rmed['cod_medi'];
			$nommed=$rmed['nom_medi'];
						
				if($medico==$codmed)echo"<option selected value=$codmed>$nommed</option>";	
				else echo"<option value=$codmed>$nommed</option>";	
			
		}
		echo"<select></td>
		</tr>
		
		<tr>
		<td>NOVEDAD</td>
		<td><TEXTAREA name='novedad' class='caja' cols=60 row=3>$novedad</textarea>
		</td>
		</tr>		
		
		<tr>
		<td>FECHA INICIO</td>
		<td>"
		?>
		<input type="text" name="fechaini" class='caja' size="8" maxlength="10" value="<?echo $fechaini;?>" id="fini" <?echo $disp;?>>
		<input type="button" class='caja' id="lanzador2" name="bot2" value="..." <?echo $disp;?>/>
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript">
		Calendar.setup({
		inputField     :    "fini",     // id del campo de texto
		ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto
		button     :    "lanzador2"     // el id del botn que lanzar el calendario
		});
		</script>
		<?php			
		echo"
		</tr>
		
		<tr>
		<td>FECHA FIN</td>
		<td>"
		?>
		<input type="text" name="fechafin" class='caja' size="8" maxlength="10" value="<?echo $fechafin;?>" id="ffin" <?echo $disp;?>>
		<input type="button" class='caja' id="lanzador3" name="bot3" value="..." <?echo $disp;?>/>
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript">
		Calendar.setup({
		inputField     :    "ffin",     // id del campo de texto
		ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto
		button     :    "lanzador3"     // el id del botn que lanzar el calendario
		});
		</script>
		<?php			
		echo"</td>
		</tr>		
		<tr>
		<td colspan=2 align=center><input type='button' class='caja' onclick='guardar()'  value='GUARDAR'>
		</tr>";
	}
	if($tipocon==2)
	{
		if($elireg=='2')
		{
			$eli=mysql_query("UPDATE citas_novedades SET estado_nov='E' WHERE iden_nov='$ideneli'");
		}
		
		
		echo"<table class='tbl' align=center>
		<tr>
		<th>FECHA INICIAL</th>
		<th>FECHA FINAL</th>
		<th>AREA</th>
		<th>MEDICO</th>
		</tr>		
		
		<tr>		
		<td>";
		if(empty($fechainic))$fechainic=$fechasis;
		if(empty($fechafinc))$fechafinc=$fechasis;
		?>
		<input type="text" name="fechainic" class='caja' size="8" maxlength="10" onchange='actualiza()' value="<?echo $fechainic;?>" id="fini" <?echo $disp;?>>
		<input type="button" class='caja' id="lanzador2" name="bot2" value="..." <?echo $disp;?>/>
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript">
		Calendar.setup({
		inputField     :    "fini",     // id del campo de texto
		ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto
		button     :    "lanzador2"     // el id del botn que lanzar el calendario
		});
		</script>
		<?php			
		echo"		
		</td><td>"
		?>
		<input type="text" name="fechafinc" class='caja' size="8" maxlength="10" onchange='actualiza()' value="<?echo $fechafinc;?>" id="ffin" <?echo $disp;?>>
		<input type="button" class='caja' id="lanzador3" name="bot3" value="..." <?echo $disp;?>/>
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript">
		Calendar.setup({
		inputField     :    "ffin",     // id del campo de texto
		ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto
		button     :    "lanzador3"     // el id del botn que lanzar el calendario
		});
		</script>
		<?php			
		echo"</td>";
		$bare=mysql_query("SELECT areas.cod_areas, areas.nom_areas
		FROM citas_novedades INNER JOIN areas ON citas_novedades.area_nov = areas.cod_areas
		WHERE (((citas_novedades.fecfin_nov)>='$fechainic') AND ((citas_novedades.fecini_nov)<='$fechafinc') AND ((citas_novedades.estado_nov)='A'))
		GROUP BY areas.cod_areas, areas.nom_areas
		ORDER BY areas.nom_areas");
		echo"		
		<td valign=top><select name=areaselc class='caja' onchange='actualiza2()'>
		<option value=''></option>";       
		while($resarea=mysql_fetch_array($bare))
		{
			$codare=$resarea['cod_areas'];
			$nomare=$resarea['nom_areas'];		
						
			if($areaselc==$codare)echo"<option selected value=$codare>$nomare</option>";	
			else echo"<option value=$codare>$nomare</option>";	
			
		}
		echo"<select></td>
		";
		
		$bmedi=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi
		FROM citas_novedades INNER JOIN medicos ON citas_novedades.medico_nov = medicos.cod_medi
		WHERE (((citas_novedades.area_nov)='$areaselc') AND ((citas_novedades.fecini_nov)<='$fechafinc') AND ((citas_novedades.fecfin_nov)>='$fechainic') AND ((citas_novedades.estado_nov)='A'))
		GROUP BY medicos.cod_medi, medicos.nom_medi
		ORDER BY medicos.nom_medi");
		
		echo"
		
		<td valign=top><select name=medicoc class='caja' onchange='actualiza()'>
		<option value=''></option>";       
		while($rmed=mysql_fetch_array($bmedi))
		{
			$codmed=$rmed['cod_medi'];
			$nommed=$rmed['nom_medi'];
						
				if($medicoc==$codmed)echo"<option selected value=$codmed>$nommed</option>";	
				else echo"<option value=$codmed>$nommed</option>";	
			
		}
		echo"<select></td>
		</tr>
		<tr><td colspan=4 align=center><input type='button' class='caja' onclick='actualiza()'  value='BUSCAR'></td>
		</tr>
		</table>
		<br>
		
		<table class='tbl' align=center>";
						
		$n=0;
		
		$dias=dias_pasados($fechainic,$fechafinc);		
		
		for($i=0;$i<=$dias;$i++)
		{
			$numseg = strtotime($fechainic)+(86400*$i);
			$diasig=date('Y-m-d', $numseg);
			
			$bnove=mysql_query("select * from citas_novedades where fecini_nov<='$diasig' AND fecfin_nov>='$diasig' AND estado_nov='A'");
			
			while($rnove=mysql_fetch_array($bnove))
			{
				
				$id=$rnove['iden_nov'];
				$nomauto=$rnove['nomauto_nov'];
				$arean=$rnove['area_nov'];
				$medin=$rnove['medico_nov'];
				$obsen=$rnove['obse_nov'];
				$fecinin=$rnove['fecini_nov'];
				$fecfinn=$rnove['fecfin_nov'];
				$fecnovn=$rnove['fecha_nov'];
				$fecregn=$rnove['fecreg_nov'];
				$horaregn=$rnove['horreg_nov'];
				$usuan=$rnove['usuario_nov'];
				
				$bare=mysql_query("SELECT * FROM areas where cod_areas='$arean'");
				while($rare=mysql_fetch_array($bare))
				{
					$nomare=$rare['nom_areas'];
				}
				$bmed=mysql_query("SELECT * FROM medicos where cod_medi='$medin'");
				while($rmed=mysql_fetch_array($bmed))
				{
					$nommed=$rmed['nom_medi'];
				}
				
				Mysql_select_db('general',$link);			
				$busu=mysql_query("SELECT * FROM cut where ide_usua='$usuan'");
				while($rusu=mysql_fetch_array($busu))
				{
					$nomusu=$rusu['nomb_usua'];
				}
				$btipusu=mysql_query("SELECT tip_usuario FROM cut WHERE ide_usua='$usucitas'");
				while($rtipusu=mysql_fetch_array($btipusu))
				{
					$tipusu=$rtipusu['tip_usuario'];
				}
				Mysql_select_db('proinsalud',$link);
				if($n==0)
				{
					echo"<tr>
					<th>REG.</th>
					<th>FECHA</th>				
					<th>AREA</th>
					<th>MEDICO</th>
					<th>NOVEDAD</th>					
					<th>NOMBRE AUTORIZA</th>
					<th>FECHA NOVEDAD</th>
					<th>FECHA INICIAL</th>
					<th>FECHA FINAL</th>
					<th>FECHA REGISTRO</th>
					<th>HORA REGISTRO</th>
					<th>FUNCIONARIO</th>";
					if($tipusu=='02')echo"<th>ELIMINAR</th>";
					echo"</tr>";
				}
				
				if($areaselc==$arean)
				{
					$col1="#72E5FF";
				}
				else
				{
					$col1="#FFFFFF";
				}
				if($medicoc==$medin)
				{
					$col2="#F7FF0F";
				}
				else
				{
					$col2="#FFFFFF";
				}				
				
				
				echo"<tr>
				<th align=center>$id</th>
				<td>$diasig</td>			
				<td bgcolor=$col1>$nomare</td>
				<td bgcolor=$col2>$nommed</td>
				<td>$obsen</td>				
				<th>$nomauto</th>
				<th align=center>$fecnovn</th>
				<th align=center>$fecinin</th>
				<th align=center>$fecfinn</th>
				<th align=center>$fecregn</th>
				<th align=center>$horaregn</th>
				<th>$nomusu</th>";
				if($tipusu=='02')echo"<td align=center><input type=button class=boton onclick=elimina($id) value='>>'></td>";
				echo "</tr>";
				$n++;
				
			}
		}		
	}
	
	function dias_pasados($fecha_comodin,$fechaini)
	{
		$dias = (strtotime($fecha_comodin)-strtotime($fechaini))/86400;
		$dias = abs($dias); $dias = floor($dias);
		return $dias;
	}
		
	
?>
</form>
</BODY>
</HTML>