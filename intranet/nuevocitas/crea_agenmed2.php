<?php
session_start();
    $usucitas=$_SESSION['usucitas'];

//echo $opcimenu;
?>

<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" />  
  <script type="text/javascript" src="java/calendar/calendar.js"></script> 
  <script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script>
  <script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

    <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type='text/javascript' src='js/jquery.autocomplete.js'></script>
    <script type="text/javascript">
    $().ready
    (
        function() 
        {		
            $("#course1").autocomplete("autocomp1.php", {          
            
            width: 260,
            minChars: 3,
            autoFill: false,
            mustMatch: false,
            matchContains: false,
            scroll: true,
            scrollHeight: 220            
            });	
            $("#course1").result(function(event, data, formatted) 
            {$("#course_val1").val(data['1']);
            });
        }	
    );
    $().ready
    (
        function() 
        {		
            $("#course").autocomplete("autocomp.php", {          
            
            width: 260,
            minChars: 3,
            autoFill: false,
            mustMatch: false,
            matchContains: false,
            scroll: true,
            scrollHeight: 220            
            });	
            $("#course").result(function(event, data, formatted) 
            {$("#course_val").val(data['1']);
            });
        }	
    );
    </script>

<script language="javascript">
	function salir()
	{                
            /*
			if(uno.fechaini.value>uno.fechafin.value)
			{
				alert("La fecha de inicio no puede ser mayor a la fecha final");
				uno.fechaini.value=uno.fecrec.value
				uno.fechaini.focus();
				return;			
			}
			*/			
			uno.opcion.value='1';
			uno.abremod.value='';
			//alert(destino);
            uno.action='crea_agenmed2.php';
            uno.target='';
            uno.submit();			
	}
    
    function salto(n)
	{		
            uno.opcion.value='0';
			uno.opc.value=n;
			uno.abremod.value='';			
            if(uno.nommedi.value=='')uno.codmedi.value='';
            if(uno.nomarea.value=='')uno.codarea.value='';
            uno.action='crea_agenmed2.php';
            uno.target='';
            uno.submit();			
	}
    function salto4(n)
	{		
            uno.abremod.value='';
			uno.opcion.value='0';
			uno.opc.value=n;              
            uno.action='crea_agenmed2.php';
            uno.target='';
            uno.submit();			
	}
	function salto2()
	{
		uno.abremod.value='';
		uno.action='crea_agenmed2.php';
		uno.target='';
		uno.submit();
	}
	
    function abremodal() 
	{		
		if(uno.abremod.value=='1')
		{
			document.getElementById('openModal').style.display = 'block';
		}
	}

	function CloseModal() 
	{
		document.getElementById('openModal').style.display = 'none';
	}
	function cargamodal(n,m)
	{
		uno.tipo.value=m;
		uno.abremod.value='1';
		uno.numhor.value=n;
		uno.target='';
		uno.action='crea_agenmed2.php';
		uno.submit();
	}
	
</script>
</head>
<body  onload="abremodal()">
<style>
.modalDialog {
	overflow:auto;
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
	width: 700px;
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
    //onload="setScrollPos('conte')"
	//echo $opcimenu;
	//ECHO $destino;
/*
if(empty($usucitas))
{
	echo" <table align=center class='tbl'>
	<tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
	</table>";
	exit;
}
*/
    $dateh=date("Y-m-d");	
    $anoini=substr($dateh,0,4);
    $mesini=substr($dateh,5,2);
    $diaini=substr($dateh,8,2);
    $dateini = gmmktime ( 00, 00, 00, $mesini, $diaini, $anoini);	
    $diaprog=$dateini+86400;
    $fechasig=gmdate ( "Y-m-d", $diaprog);
    //if(empty($fechaini))$fechaini=$fechasig;
    //if(empty($fechafin))$fechafin=$fechasig;  
    include ('php/conexion1.php');
    $busgru=mysql_query("SELECT * FROM grupos Order By nomb_gru");	//grupos
    echo"<form name=uno method=post>
    <input type=hidden name=abremod value='$abremod'>
	<input type=hidden name=numhor value='$numhor'>
    <input type=hidden name=opc value='$opc'>
    <input type=hidden name=opcion value='$opcion'>
	<input type=hidden name=tipo value='$tipo'>
    <br><br>
	
	
	
    <table align=center class='tbl' width='350'>
    
    <tr><th colspan=5 height=40>GENERACION DE AGENDA Y CAMBIO DE AREACAMBIO DE AGENDA</th></tr>
    <tr><th colspan=5 height=30>";
    if($impripor=='1')echo"GRUPO<input type=radio name=impripor checked value='1' onclick='salto4(1)'>";
    else echo"GRUPO<input type=radio name=impripor value='1' onclick='salto4(1)'>";
    if($impripor=='2')echo"AREA<input type=radio name=impripor checked value='2' onclick='salto4(2)'>";
    else echo"AREA<input type=radio name=impripor value='2' onclick='salto4(2)'>";
    if($impripor=='3')echo"MEDICO<input type=radio name=impripor checked value='3' onclick='salto4(3)'>";
    else echo"MEDICO<input type=radio name=impripor value='3' onclick='salto4(3)'>";
    echo"</th></tr>";
	
	
	if($impripor=='1')$impor='GRUPO';
	if($impripor=='2')$impor='AREA';
	if($impripor=='3')$impor='MEDICO';
	
	if($impripor=='1' || $impripor=='2' || $impripor=='3')
	{
		echo"<tr>
		<th>$impor</th>
		<th>AÑO</th>
		<th>MES</th>
		<th>DIA INICIAL</th>
		<th>DIA FINAL</th>		
		</tr>";
	}
	
	
	
    if($impripor=='1')
    {
        echo"
		<tr>
        <td align=center>   
        <select class='caja' name=grupo onchange='salto(3)'>
        <option value=''></option>";
        while($rgru=mysql_fetch_array($busgru))
        {
            $codgru=$rgru['codi_gru'];
            $nomgru=$rgru['nomb_gru'];
            if($codgru==$grupo)
            {
                echo"<option selected value='$codgru'>$nomgru</option>";
            }
            else
            {
                echo"<option value='$codgru'>$nomgru</option>";
            }
        }
        echo"</select>
        </td>"; 
    }
    if($impripor=='2')
    {
        echo"
		<tr>
        <td align=center><input type=text id='course1' class='caja' name='nomarea' onblur='salto(2)' onkeyup='salto1()' size=40 value='$nomarea'></td>
        <input type='hidden' id='course_val1' name='areasel' value='$areasel'>";
    }
    if($impripor=='3')
    {
        echo"
		<tr>
        <td align=center><input type=text id='course' class='caja' name='nommedi' size=40 onblur='salto(1)' onkeyup='salto1()' value='$nommedi'></td>
        <input type='hidden' id='course_val' name='medico' value='$medico'>";
    }
    if($impripor=='1' || $impripor=='2' || $impripor=='3')
    {
        echo"       
        
		<td>
		<select class=caja name=anno onchange='salto2()'>
		<option value=''></option>
		<option value='2020'>2020</option>
		<option value='2021'>2021</option>
		<option value='2022'>2022</option>
		<option value='2023'>2023</option>
		<select>
		</td>
		<td>
		<select class=caja name=mes onchange='salto2()'>
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
		$fecin=$anno.'-'.$mes.'-01';
		$ndias=date( 't', strtotime( $fecin ) ); //obtener numero de dias del mes
		
		echo"<td>
		<select name=diai class=caja onchange='salto2()'>
		<option value=''></option>";	
		for($n=1;$n<=$ndias;$n++)
		{
			if($n<10)$nn='0'.$n;
			else $nn=$n;
			if($nn==$diai)echo"<option selected value='$nn'>$nn</option>";
			else echo"<option value='$nn'>$nn</option>";	
		}
		echo"<select>		
		</td>
		<td>
		<select name=diaf class=caja onchange='salto2()'>
		<option value=''></option>";	
		for($n=$diai;$n<=$ndias;$n++)
		{
			if(strlen($n)==1)$nn='0'.$n;
			else $nn=$n;			
			if($nn==$diaf)echo"<option selected value='$nn'>$nn</option>";
			else echo"<option value='$nn'>$nn</option>";	
		}
		echo"<select>
		</td>		
        </tr>";
		
        
    
    }
	
	
	echo"<tr><th colspan=5 align=center valign=top height=20><INPUT type=button class='boton' value='ACEPTAR' onClick='salir();'></th></tr>
	</table>";
	?>
		<script language='Javascript'>
		uno.anno.value="<?php echo $anno;?>";
		uno.mes.value="<?php echo $mes;?>";
		</script>
	<?	
        
	if($opcion=='1')
	{
		if($impripor=='1')	//GRUPO
		{
			$buscar="SELECT areas_1.equi_area, areas_1.nom_areas, medicos.nom_medi, medicos.cod_medi
			FROM (areas_medic INNER JOIN ((areas INNER JOIN areas AS areas_1 ON areas.equi_area = areas_1.cod_areas) INNER JOIN grup_area ON areas_1.equi_area = grup_area.coar_grar) ON areas_medic.areas_ar = areas.cod_areas) INNER JOIN medicos ON areas_medic.cod_med_ar = medicos.cod_medi
			WHERE (((grup_area.cogr_grar)='$grupo') AND ((areas_medic.esta_ar)='A') AND ((medicos.esta_medi)='A') AND ((areas_medic.areas_ar)<>''))
			GROUP BY areas_1.equi_area, areas_1.nom_areas, medicos.nom_medi, medicos.cod_medi
			ORDER BY areas_1.nom_areas, medicos.nom_medi";
		}
		
		if($impripor=='2')	//AREA
		{
			$buscar="SELECT areas_1.equi_area, areas_1.nom_areas, medicos.nom_medi, medicos.cod_medi
			FROM (areas_medic INNER JOIN (areas INNER JOIN areas AS areas_1 ON areas.equi_area = areas_1.cod_areas) ON areas_medic.areas_ar = areas.cod_areas) INNER JOIN medicos ON areas_medic.cod_med_ar = medicos.cod_medi
			WHERE (((areas_1.equi_area)='$areasel') AND ((areas_medic.esta_ar)='A') AND ((medicos.esta_medi)='A') AND ((areas_medic.areas_ar)<>''))
			GROUP BY areas_1.equi_area, areas_1.nom_areas, medicos.nom_medi, medicos.cod_medi
			ORDER BY areas_1.nom_areas, medicos.nom_medi";
		}
		
		if($impripor=='3')	//MEDICO
		{
			$buscar="SELECT medicos.nom_medi, medicos.cod_medi, areas_1.nom_areas, areas.equi_area
			FROM ((areas_medic INNER JOIN areas ON areas_medic.areas_ar = areas.cod_areas) INNER JOIN medicos ON areas_medic.cod_med_ar = medicos.cod_medi) INNER JOIN areas AS areas_1 ON areas.equi_area = areas_1.cod_areas
			WHERE (((areas_medic.esta_ar)='A') AND ((medicos.esta_medi)='A') AND ((areas_medic.areas_ar)<>'') AND ((medicos.cod_medi)='$medico'))
			GROUP BY medicos.nom_medi, medicos.cod_medi, areas_1.nom_areas, areas.equi_area
			ORDER BY medicos.nom_medi";
		}
		
	}
	
	$cadb='';
	if($impripor=='1' && $grupo!='')$cadb='1'; 
	if($impripor=='2' && $areasel!='')$cadb='1';  
	if($impripor=='3' && $medico!='')$cadb='1';
	
	//echo $impripor.' '.$anno.' '.$mes.' '.$diai.' '.$diaf.' '.$cadb.'<br>';
	
	

	if($anno!='' && $mes!='' && $diai!='' && $diaf!='' && $cadb=='1' && $opcion=='1')
	{
		
		//echo"<br><br>$buscar<br><br>";
		$h=0;
		$bmax=mysql_query($buscar);
		while($rmax=mysql_fetch_array($bmax))
		{
			$areasel=$rmax['equi_area'];
			$nareasel=$rmax['nom_areas'];
			$medico=$rmax['cod_medi'];
			$nmedico=$rmax['nom_medi'];		
			
			
			$bss=mysql_query("SELECT * FROM horarios_agenda_med WHERE area='$areasel' AND medico='$medico' AND estado='AC'");
			if(mysql_num_rows($bss)>0)
			{
				
				$fecin=$anno.'-'.$mes.'-'.$diai;
				
				
				echo"<br><br><table align=left class='tbl'>
				<tr>
				<th>AREA</th>
				<td><font size=3 color='FF0000'><b>$nareasel</b></font></td>
				<th>MEDICO</th>
				<td><font size=3 color='FF0000'><b>$nmedico</b></font></td>
				</tr>
				</table><br><br>";
				
				echo"<table class='tbl6'>";
				
				for($i=$diai;$i<=$diaf;$i++)
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
						echo"<tr>";
						echo"<th width=80px NOWRAP><font size=2> $fechahor <br><br>$diasem</font></th>";
						
						$novedad='';
						$bnov=mysql_query("SELECT citas_novedades.obse_nov, areas.nom_areas
						FROM citas_novedades INNER JOIN areas ON citas_novedades.area_nov = areas.cod_areas
						WHERE (((citas_novedades.fecini_nov)<='$fechahor') AND ((citas_novedades.fecfin_nov)>='$fechahor') AND ((citas_novedades.medico_nov)='$medico'))");
						while($rnov=mysql_fetch_array($bnov))
						{
							$novedad=$rnov['obse_nov'];
							$area_nov=$rnov['nom_areas'];
							
						}
						echo "<td width=150px NOWRAP><font size=1> $novedad</font></td>";
						
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
								$ho=substr($horario,11,8);
								$horahor='0001-01-01 '.$ho;
								 
								$bhorcre=mysql_query("SELECT horarios.Cserv_horario, areas.nom_areas,horarios.ID_horario,horarios.Usado_horario, horarios.ncita_horario  
								FROM horarios INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas
								WHERE (((horarios.Fecha_horario)='$fechahor') AND ((horarios.Hora_horario)='$horahor') AND ((horarios.Cmed_horario)='$medico'))");
								if(mysql_num_rows($bhorcre)==0)
								{
									
									$nomvar='area_sel'.$h;
									echo "<input type=hidden name=$nomvar value='$areasel'>";
									$nomvar='medico_sel'.$h;
									echo "<input type=hidden name=$nomvar value='$medico'>";									
									$nomvar='diasem'.$h.'-'.$i;
									echo "<input type=hidden name=$nomvar value='$diasem'>";
									$nomvar='fechah'.$h.'-'.$i;
									echo "<input type=hidden name=$nomvar value='$fechahor'>";
									$nomvar='pacxturno'.$h.'-'.$i;
									echo "<input type=hidden name=$nomvar value='$pacxturno'>";
									$nomvar='horah'.$h.'-'.$i.'-'.$n;
									echo "<input type=hidden name=$nomvar value='$horahor'>";
									$nomvar='check'.$h.'-'.$i.'-'.$n;
									//echo "<td width=40 align=center><input type=checkbox name=$nomvar value='1'><input type=button name=$nomvar class='boton4' value='1 $hora'></td>";									
									echo "<td align=center bgcolor='#81F781'><font size=1>SIN CREAR</font><br><font size=3>$hora</font><br><input type=checkbox name=$nomvar value='1'></td>";
								}
								else
								{
									$bhcrea=mysql_fetch_array($bhorcre);
									$arecre=$bhcrea['Cserv_horario'];
									$nomare=$bhcrea['nom_areas'];
									$idhor=$bhcrea['ID_horario'];
									$Usado_horario=$bhcrea['Usado_horario'];
									$ncita_horario=$bhcrea['ncita_horario'];
									
									
									$cuentacit=mysql_query("select * from citas where ID_horario='$idhor' AND Clase_citas < '6'");
									$numcit=mysql_num_rows($cuentacit);
									
									
									if($arecre==$areasel)	//AREA==AREA SELECCIONADA
									{							
										if($Usado_horario!=$ncita_horario || $numcit>0)	//HORARIO ASIGNADO CITA
										{
											echo "<td align=center  bgcolor='#F5A9A9'><font size=1 color='#555555'>$nomare</font><br> <font color='#555555' size=3>$hora</font></td>";
										}
										else		//POR ASIGNAR CITA
										{
											echo "<td align=center bgcolor='#F7FE2E' ondblclick='cargamodal(\"$idhor\",1)'><font size=1>$nomare</font><br> <font size=3>$hora</font></td>";
										}
									}
									else
									{							
										if($Usado_horario!=$ncita_horario || $numcit>0) //HORARIO ASIGNADO CITA
										{
											echo "<td align=center bgcolor='F6CECE'><font color='#555555' size=1>$nomare</font><br><font color='#555555' size=3>$hora</font></td>";
										}
										else	//POR ASIGNAR CITA
										{
											echo "<td align=center bgcolor='#F3F781'  ondblclick='cargamodal(\"$idhor\",1)'><font size=1>$nomare</font><br> <font size=3>$hora</font></td>";
										}
									}
									
								}
								
								$tursig=$tursig+$interseg;
								$n++;
							}				
						}
						//echo $n.' ';						
						$nomvar='finn'.$h.'-'.$i;
						echo"<input type=hidden name=$nomvar value=$n>";
						echo"</tr>";						
					}
				}
				echo"</table><br><br>";
					
				echo"<table class='tbl'>
				<tr>
				<th><input type=button class=boton onclick='cargamodal(1,2)' value='GUARDAR'></th>
				</tr></table><br><br>";
				
			}			
			$h++;
		}
		
		echo"<input type=hidden name=finh value=$h>";
		
	}
?>
	<div id="openModal" class="modalDialog">
      <div>    
		
		<a href="#close" title="Close" class="close" onclick="javascript:CloseModal();">X</a>
		<?php
		
		if($tipo==1)
		{
			$bhora=mysql_query("SELECT horarios.ID_horario, areas.nom_areas, medicos.nom_medi, horarios.Fecha_horario, horarios.Hora_horario, horarios.ncita_horario, horarios.Usado_horario
			FROM (horarios INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas
			WHERE (((horarios.ID_horario)='$numhor'))");
			while($rhora=mysql_fetch_array($bhora))
			{
				$ID_horario=$rhora['ID_horario'];
				$nom_medi=$rhora['nom_medi']; 
				$nom_areas=$rhora['nom_areas']; 
				$ncita_horario=$rhora['ncita_horario']; 
				$Usado_horario=$rhora['Usado_horario'];
				$fecha_hor=$rhora['Fecha_horario'];
				$hora_hor=$rhora['Hora_horario'];
				$estado='ASIGNADO';
				if($ncita_horario-$Usado_horario==0)$estado='SIN ASIGNAR CITA';
				else $estado='';
				echo"
				<BR><BR>
				<table align=center class='tbl'>			
				<tr>
				<th>AREA ACTUAL</th><td>$nom_areas</td>
				</tr>
				<tr>
				<th>MEDICO</th><td>$nom_medi</td>
				</tr>
				<tr>
				<th>FECHA</th><td>$fecha_hor</td>
				</tr>
				<tr>
				<th>HORA</th><td>$hora_hor</td>
				</tr>
				<tr>
				<th>ESTADO</th><td>$estado</td>
				</tr>";
				if($ncita_horario-$Usado_horario==0)
				{
					$bar=mysql_query("SELECT areas_medic.areas_ar, areas.nom_areas, areas_medic.cod_ar
					FROM areas INNER JOIN areas_medic ON areas.cod_areas = areas_medic.areas_ar
					WHERE (((areas_medic.cod_med_ar)='$medico') AND ((areas.equi_area)='$areasel') AND ((areas_medic.esta_ar)='A'))");
													
					echo"<tr>
					<th>CAMBIAR AREA</th>
					<td><select class='caja' name=nuevarea>
					<option value=''></option>";
					while($rar=mysql_fetch_array($bar))
					{
						$car=$rar['areas_ar'];
						$nar=$rar['nom_areas'];
						
							if($car==$nuevarea)echo"<option selected value='$car'>$nar</option>";
							else echo"<option value='$car'>$nar</option>";
						
					}
					echo"</select>				
					</td>
					</tr>";
				}			
				echo"<tr>
				<th colspan=2><input type=button onclick='modihorario()' value='GUARDAR'></th>
				</tr></table>
				<BR><BR>";
			}
		}
		
		if($tipo==2)
		{			
			
			for($h=0;$h<$finh;$h++)
			{
				
				for($i=$diai;$i<=$diaf;$i++)
				{
					
					
					$nomvar='finn'.$h.'-'.$i;
					$finn=$$nomvar;
					
					//echo "mmmmm ".$finn.'<br>';
					
					
					for($n=0;$n<$finn;$n++)
					{
						$nomvar='area_sel'.$h;						
						$area_sel=$$nomvar;
						//echo "<input type=hidden name=$nomvar value='$area_sel'>";
						$nomvar='medico_sel'.$h;
						$medico_sel=$$nomvar;
						//echo "<input type=hidden name=$nomvar value='$medico_sel'>";									
						$nomvar='diasem'.$h.'-'.$i;
						$diasem=$$nomvar;
						//echo "<input type=hidden name=$nomvar value='$diasem'>";
						$nomvar='fechah'.$h.'-'.$i;
						$fechah=$$nomvar;
						//echo "<input type=hidden name=$nomvar value='$fechah'>";
						$nomvar='pacxturno'.$h.'-'.$i;
						$pacxturno=$$nomvar;
						//echo "<input type=hidden name=$nomvar value='$pacxturno'>";
						$nomvar='horah'.$h.'-'.$i.'-'.$n;
						$horah=$$nomvar;
						//echo "<input type=hidden name=$nomvar value='$horahor'>";
						$nomvar='check'.$h.'-'.$i.'-'.$n;
						$check=$$nomvar;
						//echo "<input type=hidden name=$nomvar value='$horahor'>";
						if($check=='1')echo $area_sel.' - '.$medico_sel.' - '.$diasem.' - '.$fechah.' - '.$pacxturno.' - '.$horah.' - '.$check.'<br>';
					}
					
				}
			}
		}	
			
			/*
			$bhora=mysql_query("SELECT horarios.ID_horario, areas.nom_areas, medicos.nom_medi, horarios.Fecha_horario, horarios.Hora_horario, horarios.ncita_horario, horarios.Usado_horario
			FROM (horarios INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas
			WHERE (((horarios.ID_horario)='$numhor'))");
			while($rhora=mysql_fetch_array($bhora))
			{
				$ID_horario=$rhora['ID_horario'];
				$nom_medi=$rhora['nom_medi']; 
				$nom_areas=$rhora['nom_areas']; 
				$ncita_horario=$rhora['ncita_horario']; 
				$Usado_horario=$rhora['Usado_horario'];
				$fecha_hor=$rhora['Fecha_horario'];
				$hora_hor=$rhora['Hora_horario'];
				$estado='ASIGNADO';
				if($ncita_horario-$Usado_horario==0)$estado='SIN ASIGNAR CITA';
				else $estado='';
				echo"
				<BR><BR>
				<table align=center class='tbl'>			
				<tr>
				<th>AREA ACTUAL</th><td>$nom_areas</td>
				</tr>
				<tr>
				<th>MEDICO</th><td>$nom_medi</td>
				</tr>
				<tr>
				<th>FECHA</th><td>$fecha_hor</td>
				</tr>
				<tr>
				<th>HORA</th><td>$hora_hor</td>
				</tr>
				<tr>
				<th>ESTADO</th><td>$estado</td>
				</tr>";
				if($ncita_horario-$Usado_horario==0)
				{
					$bar=mysql_query("SELECT areas_medic.areas_ar, areas.nom_areas, areas_medic.cod_ar
					FROM areas INNER JOIN areas_medic ON areas.cod_areas = areas_medic.areas_ar
					WHERE (((areas_medic.cod_med_ar)='$medico') AND ((areas.equi_area)='$areasel') AND ((areas_medic.esta_ar)='A'))");
													
					echo"<tr>
					<th>CAMBIAR AREA</th>
					<td><select class='caja' name=nuevarea>
					<option value=''></option>";
					while($rar=mysql_fetch_array($bar))
					{
						$car=$rar['areas_ar'];
						$nar=$rar['nom_areas'];
						
							if($car==$nuevarea)echo"<option selected value='$car'>$nar</option>";
							else echo"<option value='$car'>$nar</option>";
						
					}
					echo"</select>				
					</td>
					</tr>";
				}			
				echo"<tr>
				<th colspan=2><input type=button onclick='modihorario()' value='GUARDAR'></th>
				</tr></table>
				<BR><BR>";
			}
			
		}
		*/
		
		?>
		
      </div>
    </div>
	
	
	</form>

</body>
</html>

















