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
// 192.168.4.20/intraweb/intranet/nuevocitas/pendientes_2.php
//include ('php/conexion1.php');
set_time_limit(300);
echo"<form name=uno method=post>
<input type=hidden name=obse>
<input type=hidden name=opc value=0>
<input type=hidden name=idenp value=0>";

$usuario   = "root";
$pass      = "";
$conexion = mysql_connect("localhost",$usuario,$pass);
if(!$conexion)
{
	echo "Error de conexion a la base de datos, Intente mas tarde.";
	exit();
}
mysql_select_db("proinsalud",$conexion);

/*
	$belim=mysql_query("SELECT * FROM citas_elim");
	while($relim=mysql_fetch_array($belim))
	{
		$elim="N";
		$reg="";
		$reg=$relim['registro'];
		$elim=$relim['eliminar'];
		if($elim=="S")
		{
			$upd=mysql_query("UPDATE citas_pendientes SET esta_pen='I' WHERE iden_pen='$reg'"); 
		}
	}
*/
	/*
	$bus=mysql_query("select * from detareferencia where marc_dre='1435'");
	while($res=mysql_fetch_array($bus))
	{
		$iden=$res['iden_dre'];
		$bus2=mysql_query("select * from detareferencia_cop where iden_dre='$iden'");
		while($res2=mysql_fetch_array($bus2))
		{
			$marc=$res2['marc_dre'];
			mysql_query("UPDATE detareferencia SET marc_dre='$marc' WHERE iden_dre='$iden'");
			
			
		}
		
		
		
	}
	*/
	

$vec[1]='16239';
	
	for($i=1;$i<2;$i++)
	{
		$idenp=$vec[$i];
		$bpen=mysql_query("SELECT * FROM citas_pendientes WHERE iden_pen='$idenp'");
		while($rpen=mysql_fetch_array($bpen))
		{		
		
		
			$reg=$rpen['iden_pen'];
			$fec=$rpen['fecha_pen'];		
			$cusu=$rpen['paciente_pen'];
			$contra=$rpen['contrato_pen'];
			$area=$rpen['area_pen'];
			echo $reg.'	-	';
			
			$anin=substr($fec,0,4);
			$mein=substr($fec,5,5);
			$anin=$anin-1;
			$fech=$anin.$mein;
			
			
			$buscuco=mysql_query("select * from ucontrato where CUSU_UCO='$cusu' and CONT_UCO='$contra'");
			while($rescuco=mysql_fetch_array($buscuco))
			{
				$codcuco=$rescuco['IDEN_UCO'];					
			}
			
			$bref=mysql_query("SELECT referencia.cuco_ref, areas.cod_areas, referencia.fech_ref, detareferencia.marc_dre, detareferencia.iden_dre
			FROM ((referencia INNER JOIN detareferencia ON referencia.idre_ref = detareferencia.idre_dre) INNER JOIN destipos ON detareferencia.alse_dre = destipos.codi_des) INNER JOIN areas ON destipos.valo_des = areas.cod_areas
			WHERE (((referencia.cuco_ref)='$codcuco') AND ((areas.cod_areas)='$area') AND ((referencia.fech_ref)>='$fech') AND ((referencia.fech_ref)<='$fec') AND ((detareferencia.marc_dre)='1402'))");
			while($rref=mysql_fetch_array($bref))
			{
				$cod1=$rref['iden_dre'];
				echo $cod1.'	_	';
				$upd=mysql_query("UPDATE detareferencia SET marc_dre='1435' WHERE iden_dre='$cod1'");
			}
			
			$bref2=mysql_query("SELECT referencia.cuco_ref, areas.cod_areas, referencia.fech_ref, detareferencia.marc_dre, detareferencia.iden_dre
			FROM ((referencia INNER JOIN detareferencia ON referencia.idre_ref = detareferencia.idre_dre) INNER JOIN destipos ON detareferencia.alse_dre = destipos.codi_des) INNER JOIN areas ON destipos.valo_des = areas.cod_areas
			WHERE (((referencia.cuco_ref)='$codcuco') AND ((areas.cod_areas)='$area') AND ((referencia.fech_ref)>='$fech') AND ((referencia.fech_ref)<='$fec') AND ((detareferencia.marc_dre)='1406')AND 
			((detareferencia.cant_dre)>(detareferencia.cant_cit)))");
			while($rref2=mysql_fetch_array($bref2))
			{
				$cod2=$rref2['iden_dre'];
				echo $cod2.'	+	';
				$upd=mysql_query("UPDATE detareferencia SET marc_dre='1435' WHERE iden_dre='$cod2'");
			}
			
			$bref3=mysql_query("SELECT referencia.cuco_ref, areas.cod_areas, referencia.fech_ref, detareferencia.marc_dre, detareferencia.alse_dre, detareferencia.iden_dre
			FROM ((referencia INNER JOIN detareferencia ON referencia.idre_ref = detareferencia.idre_dre) INNER JOIN cups_citas_medicas ON detareferencia.codi_dre = cups_citas_medicas.codigo) INNER JOIN (destipos INNER JOIN areas ON destipos.valo_des = areas.cod_areas) ON cups_citas_medicas.especialidad = destipos.codi_des 
			WHERE (((referencia.cuco_ref)='$codcuco') AND ((areas.cod_areas)='$area') AND ((referencia.fech_ref)>='$fech' And (referencia.fech_ref)<='$fec') AND ((detareferencia.marc_dre)='1402') AND ((detareferencia.alse_dre)=''))");
			while($rref3=mysql_fetch_array($bref3))
			{
				$cod3=$rref3['iden_dre'];
				echo $cod3.'	X	';
				$upd=mysql_query("UPDATE detareferencia SET marc_dre='1435' WHERE iden_dre='$cod3'");
			}
			
			
			$bref4=mysql_query("SELECT referencia.cuco_ref, areas.cod_areas, referencia.fech_ref, detareferencia.marc_dre, detareferencia.alse_dre, detareferencia.iden_dre
			FROM ((referencia INNER JOIN detareferencia ON referencia.idre_ref = detareferencia.idre_dre) INNER JOIN cups_citas_medicas ON detareferencia.codi_dre = cups_citas_medicas.codigo) INNER JOIN (destipos INNER JOIN areas ON destipos.valo_des = areas.cod_areas) ON cups_citas_medicas.especialidad = destipos.codi_des 
			WHERE (((referencia.cuco_ref)='$codcuco') AND ((areas.cod_areas)='$area') AND ((referencia.fech_ref)>='$fech' And (referencia.fech_ref)<='$fec') AND ((detareferencia.marc_dre)='1406') AND ((detareferencia.cant_dre)>(detareferencia.cant_cit)) AND ((detareferencia.alse_dre)=''))");
			while($rref4=mysql_fetch_array($bref4))
			{
				$cod4=$rref4['iden_dre'];
				echo $cod4.'	=	';
				$upd=mysql_query("UPDATE detareferencia SET marc_dre='1435' WHERE iden_dre='$cod4'");
			}
			$upd=mysql_query("UPDATE citas_pendientes SET esta_pen='I' WHERE iden_pen='$reg'");			
			echo "<br>";
		}
		
		
	}
	
/*
if($opc=='2')
{
	$upd=mysql_query("UPDATE citas_pendientes SET obse_pen='$obse' WHERE iden_pen='$idenp'"); 
}

	echo "<br><table align=center class='tbl'>
	<tr>
	<th colspan=4>CONSULTA DE CITAS PENDIENTES</th>
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
	</tr>
	<tr>
		<td align=center colspan=4><input type=button value='buscar' onclick='buscar()'></td>
	</tr>
	</table>
	<br>";	
	if($fechaini != '' && $fechafin != '')
	{		
		echo"<table align=center class='tbl'>
		<tr>
		<th colspan=4>FILTROS</th>
		</tr>
		<th>AREA</th>
		<td><select name=areasel onchange='buscar()'>
		<option value=''></option>";
		$barea=mysql_query("SELECT citas_pendientes.area_pen, areas.nom_areas
		FROM citas_pendientes INNER JOIN areas ON citas_pendientes.area_pen = areas.cod_areas
		WHERE (((citas_pendientes.fecha_pen)>='$fechaini' And (citas_pendientes.fecha_pen)<='$fechafin'))
		GROUP BY citas_pendientes.area_pen, areas.nom_areas");
		while($rarea=mysql_fetch_array($barea))
		{
			$codare=$rarea['area_pen'];
			$nomare=$rarea['nom_areas'];
			if($codare==$areasel)echo"<option selected value='$codare'>$nomare</option>";
			else echo"<option value='$codare'>$nomare</option>";
		}
		echo "</select></td>
		<th>MEDICO</th>
		<td><select name=medisel onchange='buscar()'>
		<option value=''></option>";
		$bmedi=mysql_query("SELECT citas_pendientes.medico_pen, medicos.nom_medi
		FROM citas_pendientes LEFT JOIN medicos ON citas_pendientes.medico_pen = medicos.cod_medi
		WHERE (((citas_pendientes.fecha_pen)>='$fechaini' And (citas_pendientes.fecha_pen)<='$fechafin'))
		GROUP BY citas_pendientes.medico_pen, medicos.nom_medi");
		while($rmedi=mysql_fetch_array($bmedi))
		{
			$codmed=$rmedi['medico_pen'];
			$nommed=$rmedi['nom_medi'];
			if($codmed==$medisel)echo"<option selected value='$codmed'>$nommed</option>";
			else echo"<option value='$codmed'>$nommed</option>";
		}
		echo "</select></td>
		<tr>
		</table>
		<br>";			
		$consulta='';
		if($areasel != '')$consulta=$consulta." and area_pen='$areasel'";
		if($medisel  != '')$consulta=$consulta." and medico_pen='$medisel'";		
		$bpen=mysql_query("SELECT citas_pendientes.iden_pen, 
		citas_pendientes.fecha_pen,
		citas_pendientes.paciente_pen, 
		usuario.NROD_USU, 
		CONCAT(usuario.PNOM_USU,' ',usuario.SNOM_USU,' ',usuario.PAPE_USU,' ',usuario.SAPE_USU) AS nombre, 
		citas_pendientes.contrato_pen, 
		contrato.NEPS_CON, 
		citas_pendientes.medico_pen, 
		medicos.nom_medi, 
		citas_pendientes.area_pen, 
		areas.nom_areas, 
		citas_pendientes.tipo_pen, 
		citas_pendientes.areatrabajo_pen, 
		destipos.nomb_des, 
		citas_pendientes.funcionario_pen, citas_pendientes.obse_pen
		FROM ((((citas_pendientes LEFT JOIN usuario ON citas_pendientes.paciente_pen = usuario.CODI_USU) LEFT JOIN medicos ON citas_pendientes.medico_pen = medicos.cod_medi) INNER JOIN contrato ON citas_pendientes.contrato_pen = contrato.CODI_CON) INNER JOIN areas ON citas_pendientes.area_pen = areas.cod_areas) INNER JOIN destipos ON citas_pendientes.areatrabajo_pen = destipos.codi_des
		WHERE citas_pendientes.fecha_pen>='$fechaini' And citas_pendientes.fecha_pen<='$fechafin' $consulta ORDER BY citas_pendientes.fecha_pen");		
		$numres=mysql_num_rows($bpen);		
		echo"<table align=center class='tbl' width=98%>
		<tr>
		<th colspan=12>Se encontraron $numres registros</th>		
		</tr>
		<tr>
		<th colspan=8>INFORMACION DE CITA PENDIENTE</th>
		<th colspan=4>INFORMACION DE ASIGNACION DE CITA</th>
		</tr>
		<tr>
		<th>fecha</th>
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
		<th>Observacion</th>
		</TR>";		
		$asig=0;		
		
		while($rcitas=mysql_fetch_array($bpen))
		{						
			$idenpen=$rcitas['iden_pen'];
			$fecha_pen=$rcitas['fecha_pen'];
			$codusu=$rcitas['paciente_pen'];
			$cedula=$rcitas['NROD_USU'];
			$nombre=$rcitas['nombre'];
			$codcontra=$rcitas['contrato_pen'];
			$nomcontra=$rcitas['NEPS_CON'];
			$codmedicopen=$rcitas['medico_pen'];
			$nommedicopen=$rcitas['nom_medi'];
			$codareapen=$rcitas['area_pen'];
			$nomareapen=$rcitas['nom_areas'];
			$motivo=$rcitas['tipo_pen'];
			$areatrabajo=$rcitas['areatrabajo_pen'];
			$nomareatra=$rcitas['nomb_des'];
			$codusuario=$rcitas['funcionario_pen'];
			$observa=$rcitas['obse_pen'];
			
			Mysql_select_db('general',$conexion);			
				$busu=mysql_query("SELECT * FROM cut where ide_usua='$codusuario'");
				while($rusu=mysql_fetch_array($busu))
				{
					$nomusu=$rusu['nomb_usua'];			
				}
				
			Mysql_select_db('proinsalud',$conexion);
			
			$fecha_asi='';
			$hora_asi='';
			$mediasig='';
			if($motivo=='O')$motivof='OFERTA';
			if($motivo=='P')$motivof='PACIENTE';
			$basigna=mysql_query("SELECT citas.Idusu_citas, horarios.Fecha_horario, horarios.Hora_horario, medicos.nom_medi AS mednue
			FROM (citas LEFT JOIN horarios ON citas.ID_horario = horarios.ID_horario) LEFT JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi
			WHERE (((citas.Idusu_citas)='$codusu') AND citas.Clase_citas < '6'  AND ((horarios.Fecha_horario)>='$fecha_pen') AND ((horarios.Cserv_horario)='$codareapen'))");
			while($rasig=mysql_fetch_array($basigna))
			{
				$fecha_asi=$rasig['Fecha_horario'];
				$hora_asi=substr($rasig['Hora_horario'],11,5);
				$mediasig=$rasig['mednue'];
				$asig=$asig+1;
			}
			if($fecha_asi!='')$color='#FFFFFF';
			else $color='#F9FEBB';
						
			echo"
			<tr>		
			<td bgcolor=$color align=center>$fecha_pen</td>
			<td bgcolor=$color>$cedula</td>
			<td bgcolor=$color>$nombre</td>
			<td bgcolor=$color>$nomcontra</td>
			<td bgcolor=$color>$nommedicopen</td>
			<td bgcolor=$color>$nomareapen</td>
			<td bgcolor=$color align=center>$motivof</td>
			<td bgcolor=$color align=center>$nomusu</td>			
			<td bgcolor=$color align=center>$fecha_asi</td>
			<td bgcolor=$color align=center>$hora_asi</td>
			<td bgcolor=$color>$mediasig</td>";
			if(empty($observa))echo"<td bgcolor=$color align=center> <a href='#' onclick='alerta($idenpen)'><font color='#999999'>Clic aqui<font></a></td>";
			else echo"<td bgcolor=$color>$observa</td>";
			//echo"<a href='#' style='text-decoration:none' onclick='alerta($idenpen)'><td bgcolor=$color align=center>$observa</td></a>";
			
			echo"</tr>";
		}
		$porasi=$numres-$asig;
		echo"
		<tr>
		<th colspan=12>asignadas: $asig por asignar:  $porasi</th>
		</tr>	
		</table>";
	}
	*/
?>
</body>
</html>




