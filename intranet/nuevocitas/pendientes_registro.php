<?
session_start();
$usucitas=$_SESSION['usucitas'];
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
	
	//14967
	function actualiza()
	{
		uno.target='';
		uno.action='pendientes_registro.php';
		uno.submit();
		
	}
	function actualiza2()
	{
		if (event.keyCode == 13)
        {
			uno.target='';
			uno.action='pendientes_registro.php';
			uno.submit();
		}		
	}
	function guardar()
	{
		if(uno.fechaini.value=='')
		{
			alert("Digite la fecha del pendiente");
			uno.fechaini.focus();
			return;
		}
		
		if(uno.cedula.value=='')
		{
			alert("Digite el documento del paciente");
			uno.cedula.focus();
			return;
		}
		else 
		{
			if(uno.codusu.value=='')
			{
				alert("El documento del paciente no esta registrado");
				uno.cedula.focus();
				return;
			}
		}
		
		if(uno.contrato.value=='0')
		{
			alert("Seleccione el contrato del paciente");
			uno.contrato.focus();
			return;
		}
		if(uno.areasel.value=='0')
		{
			alert("Seleccione el area");
			uno.areasel.focus();
			return;
		}
		
		opcion = document.getElementsByName("tipo");
		var anu=0;
		for(var i=0; i<2; i++)
		{			
			if(opcion[0].checked)
			{				
				var anu=1;
			}
			if(opcion[1].checked)
			{				 
				var anu=1;
			}			
		}
		if(anu==0)
		{
			alert("Seleccione el tipo de pendiente");
			return;
		}	
		
		uno.guarda.value='2';
		uno.action='pendientes_registro.php';
		uno.target='';
		uno.submit();
	}
	
   
</script>
</head>
<body>
<?
// 192.168.4.12/intraweb/intranet/nuevocitas/pendientes_registro.php
//include ('php/conexion1.php');
	echo"<form name=uno method=post>";
	$usuario   = "root";
	$pass      = "";
	$conexion = mysql_connect("localhost",$usuario,$pass);
	if(!$conexion)
	{
		echo "Error de conexion a la base de datos, Intente mas tarde.";
		exit();
	}

	mysql_select_db("proinsalud",$conexion);
	
	//$guarda='4';
	/*
	if($guarda=='4')
	{
		
		$vec[0]='27422740';
		$vec[1]='30713084';
		$vec[2]='98339666';
		$vec[3]='79140661';
		$vec[4]='12998754';
		$vec[5]='12955920';
		$vec[6]='59794467';
		$vec[7]='12997833';
		$vec[8]='27456129';
		$vec[9]='87450788';
		$vec[10]='27456046';
		$vec[11]='30707285';
		$vec[12]='27398605';
		$vec[13]='27395496';
		$vec[14]='30717701';
		$vec[15]='30731747';
		$vec[16]='87431576';
		$vec[17]='27423306';
		$vec[18]='1087427086';
		$vec[19]='1085660213';
		$vec[20]='27279413';
			$vec[21]='52388839';
		$vec[22]='30739460';
		$vec[23]='27071982';
		$vec[24]='5274444';
		$vec[25]='27175106';
			$vec[26]='1316324';
		$vec[27]='5213399';
		$vec[28]='87246345';
		$vec[29]='5332758';
		$vec[30]='12960862';
			$vec[31]='27108853';
		$vec[32]='12959950';
		$vec[33]='5275829';
		$vec[34]='1868782';
		$vec[35]='27274742';
		$vec[36]='59794915';
		$vec[37]='5195863';
		$vec[38]='1900101';
		$vec[39]='30713417';
		$vec[40]='5283336';
		$vec[41]='27107668';
		$vec[42]='27107668';
		$vec[43]='5214546';
		$vec[44]='27399719';
		$vec[45]='5193066';
		$vec[46]='59793414';
		$vec[47]='27160409';
		$vec[48]='12987960';
		$vec[49]='27125912';
		$vec[50]='30709355';
		$vec[51]='14880554';
		$vec[52]='27548923';
		$vec[53]='27487285';
		$vec[54]='12963602';
		$vec[55]='12961847';
		$vec[56]='36995873';
		$vec[57]='27107853';
		$vec[58]='12967685';
		$vec[59]='12746858';
		$vec[60]='27125912';
		$vec[61]='5371624';
		$vec[62]='87451609';
		$vec[63]='27155876';
		$vec[64]='27529525';
		$vec[65]='12956053';
		for($i=1;$i<66;$i++)
		{
			$codusu='';
			$ced=$vec[$i];
			$busu=mysql_query("select CODI_USU FROM usuario WHERE NROD_USU='$ced'");
			while($rusu=mysql_fetch_array($busu))
			{
				$codusu=$rusu['CODI_USU'];
			}
			$fechaini='2019-10-22';
			$horaope='08:00';			
			$contrato='135';
			$medico='11031435';
			$areasel='53';
			$tipo='O';
			$usucitas='12991944';
			if($codusu!='')
			{
				$sql=mysql_query("insert into citas_pendientes 
				(iden_pen,fecha_pen,hora_pen,paciente_pen,contrato_pen,medico_pen,area_pen,tipo_pen,areatrabajo_pen,funcionario_pen, iden_dre) 
				values (NULL, '$fechaini','$horaope','$codusu','$contrato','$medico','$areasel','$tipo', '5801','$usucitas','')");
				if(!$sql)echo $i.' NO<br>';
			}
			else
			{
				echo $i.' '.$ced.'<br>';
			}			
		}	
			
	}	
	*/
	

	if($guarda=='2')
	{				
		$horaope=date("H").":".date("i");
		$sql=mysql_query("insert into citas_pendientes 
		(iden_pen,fecha_pen,hora_pen,paciente_pen,contrato_pen,medico_pen,area_pen,tipo_pen,areatrabajo_pen,funcionario_pen, iden_dre) 
		values (NULL, '$fechaini','$horaope','$codusu','$contrato','$medico','$areasel','$tipo', '5801','$usucitas','')");		
		$numid=Mysql_insert_id();
		mysql_query("insert into citas_pendientes_deta 
		(iden_pende, iden_pen,fecha_pende,hora_pende, tipo_pende, funcionario_pende) 
		values (NULL, '$numid', '$fechaini','$horaope','$tipo', '$usucitas')");
		
		$fechaini='';
		$cedula='';
		$codusu='';
		$contrato='';
		$areasel='';
		$medico='';
		$tipo='';
		
	}	
	if(empty($fechaini))$fechaini=date('Y-m-d');
	if(empty($cedula))$cedula='  ';
	
	$busu=mysql_query("SELECT CODI_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU
	FROM usuario WHERE NROD_USU='$cedula'");    
	while($rusu=mysql_fetch_array($busu))
	{
		$codusu=$rusu['CODI_USU'];
		$nombrepac=$rusu['PNOM_USU'].' '.$rusu['SNOM_USU'].' '.$rusu['PAPE_USU'].' '.$rusu['SAPE_USU'];
	}
	echo"
	<input type=hidden name=codusu value='$codusu'>
	<input type=hidden name=guarda value='0'>
	<br><table align=center class='tbl'>
	<tr>
	<th colspan=4>REGISTRO DE PENDIENTES</th>
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
	</tr>
	<tr>
	<td>DOCUMENTO DEL PACIENTE</td>
	<td><input type=text name=cedula class='caja' onkeypress='actualiza2()' value=$cedula>	
	</td>
	</tr>	
	<tr>
	<td>NOMBRE DEL PACIENTE</td>
	<td>$nombrepac	
	</td>
	</tr>";	
	$bcon=mysql_query("SELECT contrato.CODI_CON, contrato.NEPS_CON
	FROM ucontrato INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
	WHERE (((ucontrato.CUSU_UCO)='$codusu'))");
	
	
	echo"<tr>
	<td>CONTRATO DEL PACIENTE</td>	
	<td valign=top><select name=contrato class='caja' onchange='actualiza()'>
	<option value='0'></option>";       
	while($rescon=mysql_fetch_array($bcon))
	{
		$codcon=$rescon['CODI_CON'];
		$nomcon=$rescon['NEPS_CON'];		
					
			if($contrato==$codcon)echo"<option selected value=$codcon>$nomcon</option>";	
			else echo"<option value=$codcon>$nomcon</option>";	
		
	}
	echo"<select></td>
	</tr>";	
	$bare=mysql_query("SELECT * FROM `areas` WHERE `arci_area` LIKE '58%' ORDER BY nom_areas");
	echo"<tr>
	<td>AREA</td>
	<td valign=top><select name=areasel class='caja' onchange='actualiza()'>
	<option value='0'></option>";       
	while($resarea=mysql_fetch_array($bare))
	{
		$codare=$resarea['cod_areas'];
		$nomare=$resarea['nom_areas'];		
					
			if($areasel==$codare)echo"<option selected value=$codare>$nomare</option>";	
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
	<td>TIPO DE PENDIENTE</td>
	<td>OFERTA <input type=radio name=tipo value='O'>PACIENTE <input type=radio name=tipo value='P'>	
	</td>
	</tr>
	<tr>
	<td colspan=2 align=center><input type='button' class='caja' onclick='guardar()'  value='GUARDAR'>
	</tr>
	</table>";
?>
</body>
</html>




