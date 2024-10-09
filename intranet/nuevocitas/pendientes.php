<?
session_start();
$usucitas=$_SESSION['usucitas'];
$areatra=$_SESSION['areatra'];
?>
<html>
<head>
<title>
CITAS PENDIENTES
</title>
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" />  
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<script language="javascript">
	function buscar()
	{             
		if(uno.fechaini.value > uno.fechafin.value)
		{
			alert("La fecha inicial no puede ser mayor que la fecha final");
			uno.fechaini.focus();
			return;
		}
		uno.action='pendientes.php';
		uno.target='';
		uno.submit();			
	}
	function alerta(n) 
	{
		var mensaje;
		var opcion = prompt("Introduzca la observacion:", "");	 
		if (opcion == null) 
		{		
			return;
		} 
		else 
		{		
			uno.obse.value=opcion;
			uno.opc.value='2';
			uno.idenp.value=n;
			uno.action='pendientes.php';
			uno.target='';
			uno.submit();
		}
	}
	function elimina(reg)
	{
		var respuesta = confirm("Eliminar Pendiente?");
        if (respuesta==false)return;
		uno.opc.value='3';
		uno.itemeli.value=reg;
		uno.action='pendientes.php';
		uno.target='';
		uno.submit();
	}
	   
	</script>
	<style type="text/css">
	a:link
	{
	text-decoration:none;
	}
	</style>
</head>
<body>
	<?
	$horaini=date("H:i:s");
	// 192.168.4.20/intraweb/intranet/nuevocitas/pendientes.php
	//include ('php/conexion1.php');
	set_time_limit(300);
	echo"<form name=uno method=post>
	<input type=hidden name=obse>
	<input type=hidden name=opc value=0>
	<input type=hidden name=idenp value=0>
	<input type=hidden name=itemeli value=0>";

	$usuario   = "root";
	$pass      = "";
	$conexion = mysql_connect("localhost",$usuario,$pass);
	if(!$conexion)
	{
		echo "Error de conexion a la base de datos, Intente mas tarde.";
		exit();
	}
	Mysql_select_db('general',$conexion);			
	$busu=mysql_query("SELECT * FROM cut where ide_usua='$usucitas'");
	while($rusu=mysql_fetch_array($busu))
	{
		$tipusu=$rusu['tip_usuario'];			
	}
					
				
	mysql_select_db("proinsalud",$conexion);
	$fec=date('d/m/Y');
	if($opc=='2')
	{
		$bob=mysql_query("SELECT * FROM citas_pendientes WHERE iden_pen='$idenp'");
		if(mysql_num_rows($bob)>0)
		{
			while($rob=mysql_fetch_array($bob))
			{
				$obseante=$rob['obse_pen'];		
			}
			$obsefin=$obseante.' - '.$obse.' '.$fec;
		}
		else
		{
			$obsefin=$obse.' '.$fec;
		}
		
		$upd=mysql_query("UPDATE citas_pendientes SET obse_pen='$obsefin' WHERE iden_pen='$idenp'");
	}
	if($opc=='3')
	{
		echo "item ".$itemeli.'<br>';
		$upd=mysql_query("UPDATE citas_pendientes SET esta_pen='I' WHERE iden_pen='$itemeli'");
		
	}

		echo "<br><table align=center class='tbl'>
		<tr>
		<th colspan=6>CONSULTA DE CITAS PENDIENTES</th>
		<TR>
		<tr>
		<th>FECHA INICIAL</th>
		<td>";
			?>
			<input type="text" name="fechaini" class='caja'  size="10" maxlength="10" value="<?echo $fechaini;?>" id="fini" <?echo $disp;?>>
			<input type="button" class='caja' id="lanzador1" name="bot1" value="..." <?echo $disp;?>/>
			<!-- script que define y configura el calendario--> 
			<script type="text/javascript"> 
			Calendar.setup({ 
			inputField     :    "fini",     // id del campo de texto 
			ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
			button     :    "lanzador1"     // el id del botón que lanzará el calendario 				
			}); 
			</script>
			<?
		echo"</td>
		<th>FECHA FINAL</th>
		<td>";
			?>
			<input type="text" name="fechafin" class='caja'  size="10" maxlength="10" value="<?echo $fechafin;?>" id="ffin" <?echo $disp;?>>
			<input type="button" class='caja' id="lanzador2" name="bot2" value="..." <?echo $disp;?>/>
			<!-- script que define y configura el calendario--> 
			<script type="text/javascript"> 
			Calendar.setup({ 
			inputField     :    "ffin",     // id del campo de texto 
			ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
			button     :    "lanzador2"     // el id del botón que lanzará el calendario 				
			}); 
			</script>
			<?
		echo"</td>
		<th>DOCUMENTO</th>
		<td><input type=text size=16 class=caja name=docum value='$docum'></td>
		</tr>
		<tr>
			<td align=center colspan=6><input type=button value='buscar' onclick='buscar()'></td>
		</tr>
		</table>
		<br>";	
		if($fechaini != '' && $fechafin != '')
		{		
			
			$cad=" And citas_pendientes.esta_pen='A'";;
			if($docum != '')
			{
				$bpac=mysql_query("SELECT * FROM usuario WHERE NROD_USU='$docum'");
				if(mysql_num_rows($bpac)>0)
				{
					while($rpac=mysql_fetch_array($bpac))
					{
						$codpac=$rpac['CODI_USU'];
						$nompac=$rpac['PNOM_USU'].' '.$rpac['SNOM_USU'].' '.$rpac['PAPE_USU'].' '.$rpac['SAPE_USU'];
						$cad=$cad." And citas_pendientes.paciente_pen='$codpac'";
						echo"<table align=center class='tbl'>
						<tr>
						<th>$nompac</th>
						</tr>
						</table>
						<br>";
					}	
				}
				else
				{
					echo"<table align=center class='tbl'>
					<tr>
					<th>PACIENTE NO ENCONTRADO</th>
					</tr>
					</table>
					<br>";
				}
			}
			
			echo"<table align=center class='tbl'>
			<tr>
			<th colspan=6>FILTROS</th>
			</tr>
			<th>AREA</th>
			<td><select name=areasel onchange='buscar()'>
			<option value=''></option>";
			$barea=mysql_query("SELECT citas_pendientes.area_pen, areas.nom_areas
			FROM (citas_pendientes INNER JOIN areas ON citas_pendientes.area_pen = areas.cod_areas) INNER JOIN citas_pendientes_deta ON citas_pendientes.iden_pen = citas_pendientes_deta.iden_pen
			WHERE (((citas_pendientes_deta.fecha_pende)>='$fechaini' And (citas_pendientes_deta.fecha_pende)<='$fechafin' $cad))
			GROUP BY citas_pendientes.area_pen, areas.nom_areas
			ORDER BY areas.nom_areas");
			
			
			while($rarea=mysql_fetch_array($barea))
			{
				$codare=$rarea['area_pen'];
				$nomare=$rarea['nom_areas'];
				if($codare==$areasel)echo"<option selected value='$codare'>$nomare</option>";
				else echo"<option value='$codare'>$nomare</option>";
			}
			if($areasel != '')
			{
				echo "</select></td>
				<th>MEDICO</th>
				<td><select name=medisel onchange='buscar()'>
				<option value=''></option>";
				
				
				$bmedi=mysql_query("SELECT citas_pendientes.medico_pen, medicos.nom_medi
				FROM (citas_pendientes LEFT JOIN medicos ON citas_pendientes.medico_pen = medicos.cod_medi) INNER JOIN citas_pendientes_deta ON citas_pendientes.iden_pen = citas_pendientes_deta.iden_pen
				WHERE (((citas_pendientes_deta.fecha_pende)>='$fechaini' And (citas_pendientes_deta.fecha_pende)<='$fechafin') AND ((citas_pendientes.area_pen)='$areasel')  $cad)
				GROUP BY citas_pendientes.medico_pen, medicos.nom_medi
				ORDER BY medicos.nom_medi");
				
				
				
				while($rmedi=mysql_fetch_array($bmedi))
				{
					$codmed=$rmedi['medico_pen'];
					$nommed=$rmedi['nom_medi'];
					if($codmed==$medisel)echo"<option selected value='$codmed'>$nommed</option>";
					else echo"<option value='$codmed'>$nommed</option>";
				}
				echo "</select></td>";
			
			}
			else
			{
				echo"<th>MEDICO</th>
				<td><input type=text size=30 disabled></td>";
			}
			
			
			if(empty($tipopen))$tipopen='1';
			$ch1='';$ch2='';$ch3='';
			if($tipopen=='1')$ch1='selected';
			if($tipopen=='2')$ch2='selected';
			if($tipopen=='3')$ch3='selected';
			
			
			echo"
			<th>MOSTRAR</th>
			<td>
			<select class='caja' onchange='buscar()' name=tipopen>
			<option $ch1 value='1'>PENDIENTES</option>
			<option $ch2 value='2'>ASIGNADAS</option>
			<option $ch3 value='3'>TODAS</option>
			</select>
			</td>
			</tr>
			</table>
			<br>";
					
			$consulta='';
			if($areasel != '')
			{
				if($areasel == '53')$consulta=$consulta." and area_pen='53' or area_pen='165'";
				else  $consulta=$consulta." and area_pen='$areasel'";		
			}
			
			if($medisel  != '')$consulta=$consulta." and medico_pen='$medisel'";		
			/*
			$bpen=mysql_query("SELECT citas_pendientes.iden_pen, citas_pendientes.fecha_pen, citas_pendientes.paciente_pen, citas_pendientes.contrato_pen, citas_pendientes.medico_pen, citas_pendientes.area_pen, citas_pendientes.tipo_pen, citas_pendientes.funcionario_pen, citas_pendientes.obse_pen
			FROM citas_pendientes
			WHERE (((citas_pendientes.fecha_pen)>='$fechaini' And (citas_pendientes.fecha_pen)<='$fechafin') $cad $consulta)
			ORDER BY citas_pendientes.fecha_pen");
			*/
			$bpende=mysql_query("SELECT citas_pendientes.iden_pen
			FROM citas_pendientes INNER JOIN citas_pendientes_deta ON citas_pendientes.iden_pen = citas_pendientes_deta.iden_pen
			WHERE (((citas_pendientes_deta.fecha_pende)>='$fechaini' And (citas_pendientes_deta.fecha_pende)<='$fechafin' $cad $consulta))
			GROUP BY citas_pendientes.iden_pen
			ORDER BY Max(citas_pendientes_deta.fecha_pende)");
			
			

			
			$numres=mysql_num_rows($bpende);		
			echo"<table align=center class='tbl' width=98%>
			<tr>
			<th colspan=15>Se encontraron $numres registros</th>		
			</tr>
			<tr>
			<th colspan=10>INFORMACION DE CITA PENDIENTE</th>
			<th colspan=4>INFORMACION DE ASIGNACION DE CITA</th>";
			if($tipusu=='02')echo"<th rowspan=2>Eliminar</th>";
			echo"</tr>
			<tr>
			<th>registro</th>
			<th>fecha</th>
			<th>Fecha estimada</th>
			<th>cedula</th>
			<th>nombre paciente</th>
			<th>contrato</th>
			<th>Medico</th>
			<th>area</th>
			<th>motivo</th>		
			<th>Funcionario</th>		
			<th>fecha</th>
			<th>hora</th>
			<th>Medico</th>	
			<th>Observacion</th>";			
			echo"</TR>";		
			$asig=0;		
			
			while($rcit=mysql_fetch_array($bpende))
			{
				$iden=$rcit['iden_pen'];
				$bpen=mysql_query("SELECT citas_pendientes.iden_pen, citas_pendientes.fecha_pen, citas_pendientes_deta.fecha_pende, 
				citas_pendientes.paciente_pen, citas_pendientes.contrato_pen, citas_pendientes.medico_pen, citas_pendientes.area_pen, 
				citas_pendientes.tipo_pen, citas_pendientes.funcionario_pen, citas_pendientes_deta.funcionario_pende, citas_pendientes.obse_pen,
				citas_pendientes.fechaEstimada
				FROM citas_pendientes INNER JOIN citas_pendientes_deta ON citas_pendientes.iden_pen = citas_pendientes_deta.iden_pen
				WHERE (((citas_pendientes.iden_pen)='$iden')) AND citas_pendientes.esta_pen='A'");

			
				$fecha_pende='';
				$nomusuariopende='';
				while($rcitas=mysql_fetch_array($bpen))
				{						
					$idenpen=$rcitas['iden_pen'];
					$fecha_pen=$rcitas['fecha_pen'];
					$fecha_pende=$fecha_pende.$rcitas['fecha_pende'].'; ';
					$codusu=$rcitas['paciente_pen'];				
					$codcontra=$rcitas['contrato_pen'];				
					$codmedicopen=$rcitas['medico_pen'];				
					$codareapen=$rcitas['area_pen'];
					$motivo=$rcitas['tipo_pen'];
					$codusuario=$rcitas['funcionario_pen'];
					$codusuariopende=$rcitas['funcionario_pende'];
					$observa=$rcitas['obse_pen'];
					$fechaEstimada=$rcitas['fechaEstimada'];
					
					
					Mysql_select_db('general',$conexion);			
					$busu=mysql_query("SELECT * FROM cut where ide_usua='$codusuariopende'");
					while($rusu=mysql_fetch_array($busu))
					{
						$nomusu=$rusu['nomb_usua'];			
					}
					$nomusuariopende=$nomusuariopende.$nomusu.'; ';
					
				Mysql_select_db('proinsalud',$conexion);
				}	
					
					
				$cedula='';			
				$nombre='';
				$nommedicopen='';
				$nomareapen='';
				$areaequi='';
				$nomcontra='';
				
				$busu=mysql_query("SELECT * FROM usuario WHERE CODI_USU='$codusu'");
				while($rusu=mysql_fetch_array($busu))
				{
					$cedula=$rusu['NROD_USU'];
					$nombre=$rusu['PNOM_USU'].' '.$rusu['SNOM_USU'].' '.$rusu['PAPE_USU'].' '.$rusu['SAPE_USU'];
				}
				$bmed=mysql_query("SELECT * FROM medicos WHERE cod_medi='$codmedicopen'");
				while($rmed=mysql_fetch_array($bmed))
				{
					$nommedicopen=$rmed['nom_medi'];					
				}
				
				$bare=mysql_query("SELECT * FROM areas WHERE cod_areas='$codareapen'");
				while($rare=mysql_fetch_array($bare))
				{
					$nomareapen=$rare['nom_areas'];
					$areaequi=$rare['equi_area'];					
				}
				
				$bcon=mysql_query("SELECT * FROM contrato WHERE CODI_CON='$codcontra'");
				while($rcon=mysql_fetch_array($bcon))
				{
					$nomcontra=$rcon['NEPS_CON'];			
				}				
				
				
				$fecha_asi='';
				$hora_asi='';
				$mediasig='';
				if($motivo=='O')$motivof='OFERTA';
				if($motivo=='P')$motivof='PACIENTE';
				
				
				//$basigna=mysql_query("SELECT citas.Idusu_citas, horarios.Fecha_horario, horarios.Hora_horario, medicos.nom_medi AS mednue, //areas.nom_areas
				//FROM ((citas LEFT JOIN horarios ON citas.ID_horario = horarios.ID_horario) LEFT JOIN medicos ON horarios.Cmed_horario = //medicos.cod_medi) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas
				//WHERE (((citas.Idusu_citas)='$codusu') AND ((horarios.Fecha_horario)>='$fecha_pen') AND ((citas.Clase_citas)<'6') AND //((areas.equi_area)='$areaequi'))");
				
				
				$basigna=mysql_query("SELECT citas.Idusu_citas, horarios.Fecha_horario, horarios.Hora_horario, medicos.nom_medi AS mednue, areas.nom_areas
				FROM citas LEFT JOIN ((horarios LEFT JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) LEFT JOIN areas ON horarios.Cserv_horario = areas.cod_areas) ON citas.ID_horario = horarios.ID_horario
				WHERE (((citas.Idusu_citas)='$codusu') AND ((horarios.Fecha_horario)>='$fecha_pen') AND ((citas.Clase_citas)<'6') AND ((areas.equi_area)='$areaequi'))");
				
				
				while($rasig=mysql_fetch_array($basigna))
				{
					$fecha_asi=$rasig['Fecha_horario'];
					$hora_asi=substr($rasig['Hora_horario'],11,5);
					$mediasig=$rasig['mednue'];
					$areanue=$rasig['nom_areas'];
					
				}
				
				if($fecha_asi!='')$color='#FFFFFF';
				else $color='#F9FEBB';
							
				if($tipopen=='1' && $fecha_asi=='')
				{
					$asig=$asig+1;
					echo"
					<tr>
					<td bgcolor=$color align=center>$idenpen</td>					
					<td bgcolor=$color align=center>$fecha_pende</td>
					<td bgcolor=$color align=center>$fechaEstimada</td>
					
					
					<td bgcolor=$color>$cedula</td>
					<td bgcolor=$color>$nombre</td>
					<td bgcolor=$color>$nomcontra</td>
					<td bgcolor=$color>$nommedicopen</td>
					<td bgcolor=$color>$nomareapen</td>
					<td bgcolor=$color align=center>$motivof</td>
					<td bgcolor=$color align=center>$nomusuariopende</td>			
					<td bgcolor=$color align=center>$fecha_asi</td>
					<td bgcolor=$color align=center>$hora_asi</td>
					<td bgcolor=$color>$mediasig</td>";
					if(empty($observa))echo"<td bgcolor=$color align=center> <a href='#' onclick='alerta($idenpen)'><font color='#999999'>Clic aqui<font></a></td>";
					else echo"<td bgcolor=$color><a href='#' onclick='alerta($idenpen)'>$observa</a></td>";
					if($tipusu=='02')echo"<td  bgcolor=$color align=center><input type=button class=boton onclick='elimina($idenpen)' value='X'></td>";
					echo"</tr>";
				}
				if($tipopen=='2' && $fecha_asi!='')
				{
					$asig=$asig+1;
					echo"
					<tr>
					<td bgcolor=$color align=center>$idenpen</td>
					<td bgcolor=$color align=center>$fecha_pen</td>
					<td bgcolor=$color align=center>$fechaEstimada</td>
					<td bgcolor=$color>$cedula</td>
					<td bgcolor=$color>$nombre</td>
					<td bgcolor=$color>$nomcontra</td>
					<td bgcolor=$color>$nommedicopen</td>
					<td bgcolor=$color>$nomareapen</td>
					<td bgcolor=$color align=center>$motivof</td>
					<td bgcolor=$color align=center>$nomusuariopende</td>			
					<td bgcolor=$color align=center>$fecha_asi</td>
					<td bgcolor=$color align=center>$hora_asi</td>
					<td bgcolor=$color>$mediasig</td>";
					if(empty($observa))echo"<td bgcolor=$color align=center> <a href='#' onclick='alerta($idenpen)'><font color='#999999'>Clic aqui<font></a></td>";
					else echo"<td bgcolor=$color><a href='#' onclick='alerta($idenpen)'>$observa</a></td>";
					if($tipusu=='02')echo"<td  bgcolor=$color align=center><input type=button class=boton onclick='elimina($idenpen)' value='X'></td>";
					echo"</tr>";
				}
				if($tipopen=='3')
				{					
					$asig=$asig+1;
					echo"
					<tr>
					<td bgcolor=$color align=center>$idenpen</td>
					<td bgcolor=$color align=center>$fecha_pen</td>
					<td bgcolor=$color align=center>$fechaEstimada</td>
					<td bgcolor=$color>$cedula</td>
					<td bgcolor=$color>$nombre</td>
					<td bgcolor=$color>$nomcontra</td>
					<td bgcolor=$color>$nommedicopen</td>
					<td bgcolor=$color>$nomareapen</td>
					<td bgcolor=$color align=center>$motivof</td>
					<td bgcolor=$color align=center>$nomusuariopende</td>			
					<td bgcolor=$color align=center>$fecha_asi</td>
					<td bgcolor=$color align=center>$hora_asi</td>
					<td bgcolor=$color>$mediasig</td>";
					if(empty($observa))echo"<td bgcolor=$color align=center> <a href='#' onclick='alerta($idenpen)'><font color='#999999'>Clic aqui<font></a></td>";
					else echo"<td bgcolor=$color><a href='#' onclick='alerta($idenpen)'>$observa</a></td>";
					if($tipusu=='02')echo"<td  bgcolor=$color align=center><input type=button class=boton onclick='elimina($idenpen)' value='X'></td>";
					echo"</tr>";
				}
				
			}
			$porasi=$numres-$asig;
			echo"
			<tr>
			<th colspan=14>asignadas: $asig por asignar:  $porasi</th>
			</tr>	
			</table>";
		}
		$horafin=date("H:i:s");
		//echo"<br><br>".$horaini." --- ".$horafin;
	?>
</body>
</html>


