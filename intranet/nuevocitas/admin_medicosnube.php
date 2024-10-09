<?
session_start();
$usucitas=$_SESSION['usucitas'];  
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<script language="javascript">
	
	
		function actualiza()
		{
			uno.target='';
			uno.action='admin_medicosnube.php';
			uno.submit();	
		}
		function actualiza2()
		{
			uno.nuevomed.value='1';
			uno.target='';
			uno.action='admin_medicosnube.php';
			uno.submit();	
		}
		function editareg(ide)
		{
			uno.idmodi.value=ide;
			uno.target='';
			uno.action='admin_medicosnube.php';
			uno.submit();
		}
		function nuevohorario()
		{
			uno.nuevohor.value='1';
			uno.target='';
			uno.action='admin_medicosnube.php';
			uno.submit();
		}
		function nuevomedico()
		{
			uno.nuevomed.value='1';
			uno.target='';
			uno.action='admin_medicosnube.php';
			uno.submit();
		}
		function guardaedit(ide)
		{
			uno.accion.value=1;
			uno.target='';
			uno.action='admin_medicosnube.php';
			uno.submit();
		}
		function guardanuehor()
		{
			uno.accion.value=2;
			uno.target='';
			uno.action='admin_medicosnube.php';
			uno.submit();
		}
		function guardanuemed()
		{
			uno.accion.value=3;
			uno.target='';
			uno.action='admin_medicosnube.php';
			uno.submit();
		}
		
		
		
	</script>
	<style>
	.boton_primary
	{
		font=-family: arial,tahoma;
		font-size: 10pt;
		text-decoration: none;
		background:#007BFF;
		font-weight: 500;
		color: #FFFFFF;
		border: 0px;
		padding: .3em .3em;
		border-radius:5px;
	}
	.boton_primary:hover 
	{
		background:#0069D9;
		color: #FFFFFF;
		font-weight: 500;
	}
	.boton_succes
	{
		font=-family: arial,tahoma;
		font-size: 10pt;
		text-decoration: none;
		background:#28A745;
		font-weight: 500;
		color: #FFFFFF;
		border: 0px;
		padding: .3em .3em;
		border-radius:5px;
	}
	.boton_succes:hover 
	{
		background:#218838;
		color: #FFFFFF;
		font-weight: 500;
	}
	.boton_danger
	{
		font=-family: arial,tahoma;
		font-size: 10pt;
		text-decoration: none;
		background:#DC3545;
		font-weight: 500;
		color: #FFFFFF;
		border: 0px;
		padding: .3em .3em;
		border-radius:5px;
	}
	.boton_danger:hover 
	{
		background:#C82333;
		color: #FFFFFF;
		font-weight: 500;
	}
	
	.boton_warning
	{
		font=-family: arial,tahoma;
		font-size: 10pt;
		text-decoration: none;
		background:#FFC107;
		font-weight: 500;
		color: #000000;
		border: 0px;
		padding: .3em .3em;
		border-radius:5px;
	}
	.boton_warning:hover 
	{
		background:#E0A800;
		color: #000000;
		font-weight: 500;
	}
	
	</style>
	<!--
	azul Primary
	007BFF 0069D9
	verde Succes
	28A745 218838
	rojo Danger	
	DC3545 C82333
	amarillo warning	
	FFC107 E0A800
	
	-->
	
</head>
<body>

<form name="uno" method="post">

<?	
    // 192.168.4.20/intraweb/intranet/nuevocitas/admin_medicosnube.php
	
	echo "<input type='hidden' name='idmodi'>";
	echo "<input type='hidden' name='nuevohor'>";
	echo "<input type='hidden' name='nuevomed'>";
	echo "<input type='hidden' name='accion'>";
	
	
	
	$usucitas='12991944';
	if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
    $fecha_hoy=date("Y-m-d");
    //onload="setScrollPos('conte')"
 
    include ('php/conexion1.php');
	$mensaje='';
	if($accion=='1')
	{
		//MODIFICAR HORARIO
		//
		
		
		if($diaed=='0')$ndia='Domingo';
		if($diaed=='1')$ndia='Lunes';
		if($diaed=='2')$ndia='Martes';
		if($diaed=='3')$ndia='Miercoles';
		if($diaed=='4')$ndia='Jueves';
		if($diaed=='5')$ndia='Viernes';
		if($diaed=='6')$ndia='Sabado';
		$upd=mysql_query("UPDATE citasonline_horasmed SET dia='$diaed',nomdia='$ndia',horaini='$horainied',horafin='$horafined',
		intervalo='$intervaloed',estado='$estadoed' WHERE id_horario='$id_horarioed'");
	}
	if($accion=='2')
	{
		//INSERTAR NUEVO HORARIO
		if($dian=='0')$ndian='Domingo';
		if($dian=='1')$ndian='Lunes';
		if($dian=='2')$ndian='Martes';
		if($dian=='3')$ndian='Miercoles';
		if($dian=='4')$ndian='Jueves';
		if($dian=='5')$ndian='Viernes';
		if($dian=='6')$ndian='Sabado';
		$ins=mysql_query("INSERT into citasonline_horasmed (id_horario,id_med,dia,nomdia,horaini,horafin,intervalo,estado)
		VALUES (NULL, '$mediseln','$dian','$ndian','$horainin','$horafinn','$intervalon','$estadon')");
	}
	if($accion=='3')
	{
		//CREAR NUEVO MEDICO
		$bmedexis=mysql_query("SELECT * FROM citasOnline_medicos WHERE codigo_med='$medinmed' && area_med='$areanmed'");
		if(mysql_num_rows($bmedexis)==0)
		{
			$bmed=mysql_query("SELECT * FROM medicos WHERE cod_medi='$medinmed'");
			$rmed=mysql_fetch_array($bmed);
			$nommed=$rmed['nom_medi'];
			$bar=mysql_query("SELECT * FROM areas WHERE cod_areas='$areanmed'");
			$rar=mysql_fetch_array($bar);
			$nomar=$rar['nom_areas'];
			$ins=mysql_query("INSERT into citasOnline_medicos (id_med, codigo_med, nombre_med, area_med, nom_area)
			VALUES (NULL, '$medinmed','$nommed','$areanmed','$nomar')");
		}
		else
		{
			$mensaje="EL MEDICO SELECCIONADO YA EXISTE";
			$nuevomed=1;
			
		}
	}
	
	
    echo"
	<br><br>
    <table width='100%'>
    <tr><td>
	
    <table align=center class='tbl' width=50%>
    <tr><th>GESTION MEDICOS ONLINE</th></tr>
    </table>
    <br>";
	
	if($mensaje!='')
	{
		echo"
		<table align=center width=50%>
		<tr><td align=center>$mensaje</td></tr>
		</table>
		<br>";
	}
    
	if($nuevomed != '1')
	{
		echo"
		<table class='tbl' align=center width=50%>
		<tr>
		<th>AREA</th>
		<th>MEDICO</th>
		<<th rowspan=2>
			<center><input class='boton_primary' type=button onclick='nuevomedico()' value='Nuevo médico' ></center>
		</th>
		</tr>
		
		<tr>
		<th>
			<select name=areasel class='caja' onchange=actualiza()>
			<option value=''></option>";
			$busarea=mysql_query("SELECT citasonline_medicos.area_med, citasonline_medicos.nom_area
			FROM citasonline_medicos
			GROUP BY citasonline_medicos.area_med, citasonline_medicos.nom_area
			ORDER BY citasonline_medicos.nom_area");
			while($resarea=mysql_fetch_array($busarea))
			{
				$coda=$resarea['area_med'];
				$noma=$resarea['nom_area'];
				if($coda==$areasel)echo"<option selected value='$coda'>$noma</option>";
				else echo"<option value='$coda'>$noma</option>";
			}
			
		echo"
		</th>
		<th>
			<select name=medisel class='caja' onchange=actualiza()>
			<option value=''></option>";
			$busmed=mysql_query("SELECT citasonline_medicos.id_med, citasonline_medicos.nombre_med
			FROM citasonline_medicos
			WHERE (((citasonline_medicos.area_med)='$areasel'))
			ORDER BY citasonline_medicos.nombre_med");
			while($resmed=mysql_fetch_array($busmed))
			{
				$codm=$resmed['id_med'];
				$nomm=$resmed['nombre_med'];
				if($codm==$medisel)echo"<option selected value='$codm'>$nomm</option>";
				else echo"<option value='$codm'>$nomm</option>";
			}
		echo"
		</th>
		</tr>
		</table>";
		
		if($areasel != '' && $medisel != '')
		{
			echo "<br>
			<table class='tbl' align=center width=50%>
			<tr>		
			<th>DIA</th>
			<th>HORA INICIO</th>
			<th>HORA FIN</th>
			<th>INTERVALO</th>
			<th>ESTADO</th>
			<th>ACCION</th>
			</tr>";
			$bhor=mysql_query("SELECT citasonline_horasmed.id_horario, citasonline_horasmed.dia, citasonline_horasmed.nomdia, 
			citasonline_horasmed.horaini, citasonline_horasmed.horafin, citasonline_horasmed.intervalo, citasonline_horasmed.estado
			FROM citasonline_horasmed
			WHERE (((citasonline_horasmed.id_med)='$medisel'))");
			while($rhor=mysql_fetch_array($bhor))
			{
				$id_horario=$rhor['id_horario'];
				$dia=$rhor['dia'];
				$nomdia=$rhor['nomdia'];
				$horaini=substr($rhor['horaini'],0,5);
				$horafin=substr($rhor['horafin'],0,5);
				$intervalo=$rhor['intervalo'];
				$estado=$rhor['estado'];
				if($estado=='AC')$esta="ACTIVO";
				if($estado=='IN')$esta="INACTIVO";
				if($id_horario != $idmodi)
				{
					echo "
					<tr>			
					<td align=center>$nomdia</td>
					<td align=center>$horaini</td>
					<td align=center>$horafin</td>
					<td align=center>$intervalo</td>
					<td align=center>$esta</td>
					<td align=center>
					<input class='boton_primary' type=button onclick='editareg($id_horario)' value='Editar' >
					</td>
					</tr>";
				}
				else
				{
					$sel1='';$sel2='';
					if($estado=='AC')$sel1="selected";
					if($estado=='IN')$sel2="selected";
					echo "
					<input type=hidden name=mediseled value='$medisel'>
					<input type=hidden name=id_horarioed value='$id_horario'>
					<tr>			
					<td align=center>
						<select class='caja' name='diaed'>
						<option value='0'>DOMINGO</option>
						<option value='1'>LUNES</option>
						<option value='2'>MARTES</option>
						<option value='3'>MIERCOLES</option>
						<option value='4'>JUEVES</option>
						<option value='5'>VIERNES</option>
						<option value='6'>SABADO</option>
					</td>
					
					<td align=center><input type=time class='caja' size=2 name=horainied value='$horaini'></td>
					<td align=center><input type=time class='caja' size=2 name=horafined value='$horafin'></td>
					<td align=center><input type=text class='caja' size=2 name=intervaloed value='$intervalo'></td>
					<td align=center>
						<select class='caja' name='estadoed'>
						<option $sel1 value='AC'>ACTIVO</option>
						<option $sel2 value='IN'>INACTIVO</option>
						</select>
					</td>
					<script>
						uno.diaed.value=$dia;
					</script>
					<td align=center>
					<input class='boton_succes' type=button onclick='guardaedit($id_horario)' value='Guardar' >
					<input class='boton_danger' type=button onclick='actualiza()' value='Cancelar' >
					</td>
					</tr>";
				}
			}
			if($nuevohor=='1')
			{
				echo "
				<input type=hidden name=mediseln value='$medisel'>
				<tr>			
				<td align=center>
					<select class='caja' name='dian'>
					<option value='0'>DOMINGO</option>
					<option value='1'>LUNES</option>
					<option value='2'>MARTES</option>
					<option value='3'>MIERCOLES</option>
					<option value='4'>JUEVES</option>
					<option value='5'>VIERNES</option>
					<option value='6'>SABADO</option>
				</td>
				<td align=center><input type=time class='caja' size=2 name=horainin></td>
				<td align=center><input type=time class='caja' size=2 name=horafinn></td>
				<td align=center><input type=text class='caja' size=2 name=intervalon></td>
				<td align=center>
					<select class='caja' name='estadon'>
					<option value='AC'>ACTIVO</option>
					<option value='IN'>INACTIVO</option>
					</select>
				</td>
				<td align=center>
				<input class='boton_succes' type=button onclick='guardanuehor()' value='Guardar' >
				</td>
				</tr>";
				
			}
			else
			{
				echo"<tr>
				<td align=center colspan=6>
				<BR>
				<input class='boton_primary' type=button onclick='nuevohorario()' value='Nuevo horario' >
				<BR>
				</td>
				</tr>";
			}
			echo"</table>";
		}
		
	}
	else
	{
		
		echo"
		<table class='tbl' align=center width=50%>
		<tr>
		<th>AREA</th>
		<th>MEDICO</th>
		
		</tr>
		
		<tr>
		<td align=center height=40>
			<select name=areanmed class='caja' onchange=actualiza2()>
			<option value=''></option>";
			$bare=mysql_query("SELECT areas.equi_area, areas_1.nom_areas
			FROM areas INNER JOIN areas AS areas_1 ON areas.equi_area = areas_1.cod_areas
			WHERE (((areas.tipo_areas)='1') AND ((areas.equi_area)<>''))
			GROUP BY areas.equi_area, areas_1.nom_areas
			ORDER BY areas_1.nom_areas");
			while($rare=mysql_fetch_array($bare))
			{
				$codare=$rare['equi_area'];
				$nomare=$rare['nom_areas'];
				if($codare==$areanmed)echo"<option selected value='$codare'>$nomare</option>";
				else echo"<option value='$codare'>$nomare</option>";
			}
			
		echo"
		</td>
		<td  align=center>
			
			<select name=medinmed class='caja'>
			<option value=''></option>";
			$bmed=mysql_query("SELECT medicos.nom_medi, medicos.cod_medi
			FROM medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar
			WHERE (((areas_medic.areas_ar)='$areanmed')) and (((areas_medic.areas_ar)<>'')) AND medicos.esta_medi='A' AND areas_medic.esta_ar='A'  order by medicos.nom_medi");
			
			
			
			while($rmed=mysql_fetch_array($bmed))
			{
				$codmed=$rmed['cod_medi'];
				$nommed=$rmed['nom_medi'];
				if($codmed==$medinmed)echo"<option selected value='$codmed'>$nommed</option>";
				else echo"<option value='$codmed'>$nommed</option>";
			}
		echo"
		</td>
		</tr>
		<tr>
			<th align=center colspan=2>
			<center><input class='boton_succes' type=button onclick='guardanuemed()' value='Guardar'>
			<input class='boton_danger' type=button onclick='actualiza()' value='Cancelar'>
			</center>
			</th>
		</tr>
		</table>";
	}
	echo"
	</td></tr>
	</table>";
	
?>

</form>
</body>
</html>