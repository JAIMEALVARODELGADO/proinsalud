<?
session_start();
    $usucitas=$_SESSION['usucitas'];
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 
//echo $opcimenu;
?>
<html>
<head>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" />  
  <script type="text/javascript" src="java/calendar/calendar.js"></script> 
  <script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script>
  <script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<link rel="stylesheet" href="style.css" type="text/css"/>
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
	
	function editar(n,iden)
	{
		if(n==1 && eval("uno.res"+iden+".value")=='')
		{
			alert("seleccione la opcion de confirmacion");
			eval ("uno.res"+iden+".focus");
			return;
		}
		if (confirm("Editar confirmacion de cita?") == true) 
		{
			uno.opcion.value=n;
			uno.iden_cita.value=iden;
			uno.action="confirmar_cita.php";
			uno.target='';
			uno.submit();	
		}
	}
    function actualiza()
	{	
		uno.action='confirmar_cita.php';
		uno.target='';
		uno.submit();			
	}
	function cambiavista()
	{		
		uno.fechaini.value='';
		uno.fechafin.value='';
		uno.area.value='';
		uno.medico.value='';
		uno.estado.value='';
		
		uno.action='confirmar_cita.php';
		uno.target='';
		uno.submit();			
	}
        
	
</script>
</head>
<body lang=ES style='tab-interval:35.4pt'>
<style>
#conte {
overflow:auto;
height: 300px;
width: 600px;
padding:5px;
margin:0 auto;
background-color: #FFFFFF;
font-size: 8px;
}
.margen_izq {
margin-left:10px;
}
</style> 
<form name="uno" method="post">
<?	
    // 192.168.4.20/intraweb/intranet/nuevocitas/confirmar_cita.php
	//onload="setScrollPos('conte')"
	set_time_limit(0);
	if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
	
	
	$fecha=date("Y-m-d H:i:s");
	include ('php/conexion1.php');
	//$usucitas='3';
	if($opcion==1)	//guardar confirmacion
	{
		$nomvar='res'.$iden_cita;
		$resultado=$$nomvar;
		$guar=mysql_query("UPDATE citas SET fecha_confirmacion='$fecha', resul_confirmacion='$resultado', funci_confirmacion='$usucitas' WHERE id_cita='$iden_cita'");
	}
	if($opcion==2)		//eliminar confirmacion
	{		
		$guar=mysql_query("UPDATE citas SET fecha_confirmacion='', resul_confirmacion='S/G', funci_confirmacion='' WHERE id_cita='$iden_cita'");
	}
	echo"<input type='hidden' name='opcion'>
	<input type='hidden' name='iden_cita'>";
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
    
	if(empty($estado))$estado=$cad2= " and citas.resul_confirmacion ='S/G'";
	else $cad2= " and citas.resul_confirmacion ='$estado'";
	$est1="";$est2="";$est3="";
	if($estado=="Confirmado")$est1="selected";
	if($estado=="No contesta")$est2="selected";
	if($estado=="Cancela cita")$est3="selected";
	$op1='';$op2='';
	if(empty($accion))$accion='1';
	if($accion=='1')$op1='checked';
	if($accion=='2')$op2='checked';	
	if($accion=='3')$op3='checked';	
	
	echo"<br><table align=center class='tbl' width=70%>
	<tr>
	<th><input type=radio name='accion' $op1 onclick='cambiavista()' value='1'> &nbsp;&nbsp; Confirmacion de cita</th>
	<th><input type=radio name='accion' $op2 onclick='cambiavista()' value='2'> &nbsp;&nbsp; Informe detallado</th>
	<th><input type=radio name='accion' $op3 onclick='cambiavista()' value='3'> &nbsp;&nbsp; Informe resumen</th>
	</tr>
	</table>";
	
	echo"<br><table align=center class='tbl' width=70%>	
	<tr>
	<th>Fecha inicial</th>
	<th>Fecha final</th>
	<th>Area</th>
	<th>Medico</th>
	<th>Estado</th>
	<th>Accion</th>
	</tr>
	<tr>
	<td align=center>";
		?>
		<input type="text" name="fechaini" class='caja' size="10" maxlength="10" value="<?echo $fechaini;?>" id="fini" <?echo $disp;?>>
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
	<td align=center>";
		?>
		<input type="text" name="fechafin" class='caja' size="10" maxlength="10" value="<?echo $fechafin;?>" id="ffin" <?echo $disp;?>>
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
	<td align=center>
		<select name=area onchange='actualiza()'>
		<option value=''></option>";
		$barea=mysql_query("SELECT horarios.Cserv_horario, areas.nom_areas
		FROM (horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas
		WHERE (((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin') $cad2)
		GROUP BY horarios.Cserv_horario, areas.nom_areas ORDER BY areas.nom_areas");
		while($rarea=mysql_fetch_array($barea))
		{
			$codarea=$rarea['Cserv_horario'];
			$nomarea=$rarea['nom_areas'];
			if($codarea!=$cod)
			if($area==$codarea)echo"<option selected value='$codarea'>$nomarea</option>";
			else echo"<option value='$codarea'>$nomarea</option>";
		}
		echo "</select>
	</td>
	<td align=center>
		<select name=medico onchange='actualiza()'>
		<option value=''></option>";
		$bmedi=mysql_query("SELECT horarios.Cmed_horario, medicos.nom_medi
		FROM (horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi
		WHERE (((horarios.Cserv_horario)='$area') AND ((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin') $cad2)
		GROUP BY horarios.Cmed_horario, medicos.nom_medi ORDER BY medicos.nom_medi");
		while($rmedi=mysql_fetch_array($bmedi))
		{
			$codmedi=$rmedi['Cmed_horario'];
			$nommedi=$rmedi['nom_medi'];
			if($medico==$codmedi)echo"<option selected value='$codmedi'>$nommedi</option>";
			else echo"<option value='$codmedi'>$nommedi</option>";
		}
		echo "</select>
	</td>";
	if($accion=='1')
	{
		echo"
		<td align=center>
		<select name=estado onchange='actualiza()'>
		<option value=''>Sin gestionar</option>
		<option $est1 value='Confirmado'>Confirmado</option>
		<option $est2 value='No contesta'>No contesta</option>
		<option $est3 value='Cancela cita'>Cancela cita</option>		
		</select>
		</td>";
	}
	else
	{
		echo "<input type=hidden name=estado>";	
		echo"<td></td>";
	}
	echo"
	<td><input type=button class=boton value='BUSCAR' onclick=actualiza()></td>
	<tr>
	</table>";
	if($accion=='1')
	{		
		if(!empty($fechaini) && !empty($fechafin) && !empty($area))
		{
			if(!empty($area))$cad=$cad." AND horarios.Cserv_horario='$area'";
			if(!empty($medico))$cad=$cad." AND horarios.Cmed_horario='$medico'";
			$buscit=mysql_query("SELECT citas.id_cita, horarios.Cmed_horario, medicos.nom_medi, horarios.Cserv_horario, areas.nom_areas, 
			horarios.Fecha_horario, horarios.Hora_horario, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, 
			usuario.SAPE_USU, usuario.TRES_USU, usuario.TEL2_USU, citas.Esta_cita, citas.fecha_confirmacion, citas.resul_confirmacion,
			citas.funci_confirmacion
			FROM (((horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi
			WHERE horarios.Fecha_horario>='$fechaini' And horarios.Fecha_horario<='$fechafin' AND citas.Clase_citas<'6' $cad2 $cad");
			echo "<br><br><table align=center class='tbl' width=70%>
			<tr>
				<th>Fecha y hora</th>
				<th>Area</th>
				<th>Medico</th>
				<th>Documento</th>
				<th>Nombre paciente</th>
				<th>Telefono paciente</th>
				<th>Estado</th>
				<th>Confirmacion</th>
				<th>Fecha confirmacion</th>
				<th>Funcionario confirmacion</th>
				<th>Accion</th>
			</tr>";
			include ('php/conexion.php'); 
			while($rcit=mysql_fetch_array($buscit))
			{
				$idencit=$rcit['id_cita'];
				$fechcit=$rcit['Fecha_horario'];
				$horacit=$rcit['Hora_horario'];
				$areacit=$rcit['nom_areas'];
				$medicit=$rcit['nom_medi'];
				$dusucit=$rcit['NROD_USU'];
				$nusucit=$rcit['PNOM_USU'].' '.$rcit['SNOM_USU'].' '.$rcit['PAPE_USU'].' '.$rcit['SAPE_USU'];
				$tel1cit=$rcit['TRES_USU'];
				$tel2cit=$rcit['TEL2_USU'];
				$estacit=$rcit['Esta_cita'];
				$fecconf=$rcit['fecha_confirmacion'];
				$resconf=$rcit['resul_confirmacion'];
				$funconf=$rcit['funci_confirmacion'];
				$hora=substr($horacit,11,5);
				if($estacit=='1')$estadoa='LIBRE';
				if($estacit=='2')$estadoa='ASIGNADA';
				
				echo "<tr>
				<td align=center>$fechcit &nbsp;&nbsp; $hora</td>
				<td align=center>$areacit</td>
				<td align=center>$medicit</td>
				<td align=center>$dusucit</td>
				<td align=center>$nusucit</td>
				<td align=center>$tel1cit - $tel2cit</td>
				<td align=center>$estadoa</td>";
				$fech=substr($fecconf,0,10);
				$hora=substr($fecconf,11,8);
				$fechsig=date("Y-m-d",strtotime($fech."+ 1 days"));
				$fechasig=$fechsig.' '.$hora;
				
				if($resconf=='S/G')
				{
					$nomvar='res'.$idencit;
					echo"
					<td align=center>
					<select name=$nomvar>
					<option value=''></option>
					<option value='Confirmado'>Confirmado</option>
					<option value='No contesta'>No contesta</option>
					<option value='Cancela cita'>Cancela cita</option>
					</select>
					</td>
					<td align=center></td>			
					<td align=center></td>
					<td align=center><input type=button onclick='editar(1,$idencit)' value=guardar></td>";
				}
				else
				{
					$bfun=mysql_query("SELECT * FROM cut WHERE ide_usua='$funconf'");
					$rfun=mysql_fetch_array($bfun);
					$nomfunconf=$rfun['nomb_usua'];
					echo"
					<td align=center>$resconf</td>
					<td align=center>$fecconf</td>			
					<td align=center>$nomfunconf</td>";
					if($fecha<=$fechasig)echo"<td align=center><input type=button onclick='editar(2,$idencit)' value='Eliminar novedad'></td>";
					else echo "<td></td>";
				}
				echo"</tr>";
			}
		}
	}
	if($accion==2)
	{
		if(!empty($fechaini) && !empty($fechafin))
		{
			$cad='';
			if(!empty($area))$cad=$cad." AND horarios.Cserv_horario='$area'";
			if(!empty($medico))$cad=$cad." AND horarios.Cmed_horario='$medico'";
			
			echo "<br><br><table align=center class='tbl' width=70%>
			<tr>
			<th>Fecha cita</th>
			<th>hora cita</th>
			<th>Area</th>
			<th>Medico</th>
			<th>Fecha confirmacion</th>
			<th>resultado confirmacion</th>
			<th>Funcionario</th>
			</tr>";
			$n=0;
			$totvconfi=0;$totvnocon=0;$totvcancela=0;$totvsinges=0;$tottot=0;
			$breg=mysql_query("SELECT horarios.Fecha_horario, horarios.Hora_horario, horarios.Cserv_horario, areas.nom_areas, horarios.Cmed_horario, 
			medicos.nom_medi, citas.fecha_confirmacion, citas.resul_confirmacion, cut.nomb_usua
			FROM (((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) 
			INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) INNER JOIN general.cut ON citas.funci_confirmacion = cut.ide_usua
			WHERE (((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin') AND ((citas.resul_confirmacion)<>'S/G'))
			ORDER BY horarios.Fecha_horario, horarios.Hora_horario");
			while($rreg=mysql_fetch_array($breg))
			{				
				$fecha=$rreg['Fecha_horario'];
				$hora=$rreg['Hora_horario'];
				$fecha_confir=$rreg['fecha_confirmacion'];
				$resultado=$rreg['resul_confirmacion'];
				$funcionario=$rreg['nomb_usua'];
				$area=$rreg['Cserv_horario'];
				$medico=$rreg['Cmed_horario'];
				$narea=$rreg['nom_areas'];
				$nmedico=$rreg['nom_medi'];
				
				$totmed=$vconfi+$vnocon+$vcancela+$vsinges;
				echo"
				<tr>
				
				<td align=center>$fecha</td>
				<td align=center>$hora</td>
				<td>$narea</td>
				<td>$nmedico</td>
				<td align=center>$fecha_confir</td>
				<td align=center>$resultado</td>
				<td align=center>$funcionario</td>
				</tr>
				";
				$n++;
			}
			echo"
			<tr>
			<th colspan=6>TOTAL CITAS GESTIONADAS</td>
			<th align=center>$n</td>
			</tr>";
				
		}
		
	}
	
	
	
	
	if($accion==3)
	{
		if(!empty($fechaini) && !empty($fechafin))
		{
			$cad='';
			if(!empty($area))$cad=$cad." AND horarios.Cserv_horario='$area'";
			if(!empty($medico))$cad=$cad." AND horarios.Cmed_horario='$medico'";
			
			
			echo "<br><br><table align=center class='tbl' width=70%>
			<tr>
			<th>Area</th>
			<th>Medico</th>
			<th>Fecha inicio</th>
			<th>Fecha fin</th>			
			<th>Confirmado</th>
			<th>No contesta</th>
			<th>Cancela cita</th>
			<th>Sin gestionar</th>
			<th>Total</th>
			</tr>";
			
			$totvconfi=0;$totvnocon=0;$totvcancela=0;$totvsinges=0;$tottot=0;
			$breg=mysql_query("SELECT horarios.Cserv_horario, areas.nom_areas, horarios.Cmed_horario, medicos.nom_medi
			FROM ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi
			WHERE (((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin')) $cad
			GROUP BY horarios.Cserv_horario, areas.nom_areas, horarios.Cmed_horario, medicos.nom_medi
			ORDER BY areas.nom_areas, medicos.nom_medi");
			while($rreg=mysql_fetch_array($breg))
			{				
				$area=$rreg['Cserv_horario'];
				$medico=$rreg['Cmed_horario'];
				$narea=$rreg['nom_areas'];
				$nmedico=$rreg['nom_medi'];
				
				$bconfi=mysql_query("SELECT Count(citas.resul_confirmacion) AS cuenta
				FROM citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario
				WHERE (((horarios.Cserv_horario)='$area') AND ((horarios.Cmed_horario)='$medico') AND ((citas.resul_confirmacion)='Confirmado') 
				AND ((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin'))");
				$rconfi=mysql_fetch_array($bconfi);
				$vconfi=$rconfi['cuenta'];
				
				$bnocon=mysql_query("SELECT Count(citas.resul_confirmacion) AS cuenta
				FROM citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario
				WHERE (((horarios.Cserv_horario)='$area') AND ((horarios.Cmed_horario)='$medico') AND ((citas.resul_confirmacion)='No contesta') 
				AND ((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin'))");
				
				$rnocon=mysql_fetch_array($bnocon);
				$vnocon=$rnocon['cuenta'];
				
				$bcancela=mysql_query("SELECT Count(citas.resul_confirmacion) AS cuenta
				FROM citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario
				WHERE (((horarios.Cserv_horario)='$area') AND ((horarios.Cmed_horario)='$medico') AND ((citas.resul_confirmacion)='Cancela cita') 
				AND ((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin'))");
				
				$rcancela=mysql_fetch_array($bcancela);
				$vcancela=$rcancela['cuenta'];
				
				$bsinges=mysql_query("SELECT Count(citas.resul_confirmacion) AS cuenta
				FROM citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario
				WHERE (((horarios.Cserv_horario)='$area') AND ((horarios.Cmed_horario)='$medico') AND ((citas.resul_confirmacion)='S/G') 
				AND ((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin'))");
				
				$rsinges=mysql_fetch_array($bsinges);
				$vsinges=$rsinges['cuenta'];
				
				$totmed=$vconfi+$vnocon+$vcancela+$vsinges;
				
				
				$totvconfi=$totvconfi+$vconfi;
				$totvnocon=$totvnocon+$vnocon;
				$totvcancela=$totvcancela+$vcancela;
				$totvsinges=$totvsinges+$vsinges;
				$tottot=$tottot+$totmed;
				
				
				$totmed=$vconfi+$vnocon+$vcancela+$vsinges;
				if($vconfi+$vnocon+$vcancela>0)
				{
					echo"
					<tr>
					<td>$narea</td>
					<td>$nmedico</td>
					<td align=center>$fechaini</td>
					<td align=center>$fechafin</td>
					<td align=center>$vconfi</td>
					<td align=center>$vnocon</td>
					<td align=center>$vcancela</td>
					<td align=center>$vsinges</td>
					<td align=center>$totmed</td>
					</tr>
					";
				}
				$n++;
			}
			
			echo"
			<tr>
			<th colspan=2>TOTAL</th>
			<th align=center>$fechaini</th>
			<th align=center>$fechafin</th>
			<th align=center>$totvconfi</th>
			<th align=center>$totvnocon</th>
			<th align=center>$totvcancela</th>
			<th align=center>$totvsinges</th>
			<th align=center>$tottot</th>
			</tr>";			
				
		}
		
	}
	
	
    
	
		
    
	
	echo"
     </table>
     </form>";
?>
</body>
</html>