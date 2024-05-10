<?php
	session_register('paciente');	
	session_register('Gcod_mediconh');
	session_register('numcita');
	session_register('tiespe');
	session_register('concontrol');
	session_register('Gareanh');

	if(empty($paciente))
	{
		echo"<br><br><table align=center class='tbl'>
		<tr><th>POR SEGURIDAD SU SESIÆN SE CERRÆ. EIERRE E INGRESE NUEVAMENTE AL PROGRAMA/th></tr>
		</table>";
		exit;
	}
	$gcod_usu=$paciente;
?>


<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; ISO-8859-1"/>
	<meta http-equiv="Context-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
	
	<script language="JavaScript">
		
		function eliminarmedi(r)
		{	
			uno.itemelitre.value=r;
			uno.target='';
			uno.action='eliminareg.php';
			uno.submit();	
		}	
		
		function busqueda()
		{	
			uno.target='';
			uno.action='medica0.php';
			uno.submit();	
		}	
		
		function salida()
		{	
			uno.canti.disabled=false;
			uno.target='';	
			uno.action='contrare0.php';
			uno.submit();	
		}	
		
		function valida(wtr)
		{		
			
			if(uno.diagnosticoMicro.value=='')
			{
				alert("Digite el diagnostico infeccioso");
				uno.diagnosticoMicro.focus();
				return;
			}
			
			if(uno.claseDianostico.value=='')
			{
				alert("Seleccione la clase de diagnostico infeccioso");
				uno.claseDianostico.focus();
				return;
			}
			
			if(uno.examenConfirmatorio.value=='')
			{
					alert("Digite el origen de la muestra");
					uno.examenConfirmatorio.focus();
					return;
			}
			
			if(uno.resultadoMicro.value=='')
			{
					alert("Resultado de la muestra");
					uno.resultadoMicro.focus();
					return;
			}

			if(uno.razondeCambio.value=='')
			{
					alert("Digite la razon de cambio");
					uno.razondeCambio.focus();
					return;
			}
			
			if(uno.obsevaMicro.value=='')
			{
					alert("Digite la razon de cambio");
					uno.obsevaMicro.focus();
					return;
			}
			
			uno.CodigoMedMicro.value=wtr;
			uno.nivelMicro.value=1;
			uno.action='guardar_micro.php';
			uno.target='';
			uno.submit();	
		}
		
		function valida1()
		{		
			uno.action='medica0.php';
			uno.target='';
			uno.submit();	
		}

		function mensa()
		{
			if(uno.cuenta.value==1)
			{
				uno.cuenta.value=0;
				uno.target='';
				uno.action='medica0.php';
				uno.submit();	
			}
			else
			{
				if(uno.mensaje.value==1)
				{
					alert("Se requiere diligenciar el modulo de diagnosticos");
					uno.target='';
					uno.action='diagnos0.php';
					uno.submit();	
				}
			}
		}
		
		function cambiauni()
		{
			if(uno.unidad.value=='1')
			{
				uno.unid.value='UND';
				uno.canti.disabled=false;
				
				if(uno.dosis.value!='' && uno.frecu.value!='' && uno.tiempo.value!='' && uno.unidfrecu.value!='')
				{				
					dos=eval(uno.dosis.value);
					fr=uno.frecu.value;
					ti=uno.tiempo.value;
					uf=uno.unidfrecu.value;
					var ut=0;
					var tt=0;
					var ft=0;				
					if(uf=='Minutos')ut=1;
					if(uf=='Horas')ut=60;
					if(uf=='Dias')ut=1440;				
					tt=ti*1440;
					ft=ut*fr;				
					can=(tt/ft)*dos;			
					uno.canti.value=can;
				}
			}
			else
			{
				if(uno.unid.value=='UND')uno.unid.value='';
				uno.canti.disabled=false;
			}
		}
		
		function act()
		{
			uno.target='';
			uno.action='form_medicamentos.php';
			uno.submit();	
		}
	</script>
	
	
	<script type="text/javascript">
		$().ready(function() 
		{	
			$("#cieinfeccioso1").autocomplete("autcompdiacroni22.php", {
				width: 360,
				minChars: 3,
				autoFill: false,
				mustMatch: false,
				matchContains: false,
				scroll: true,
				scrollHeight: 220	
			});	
			$("#cieinfeccioso1").result(function(event, data, formatted) {
				$("#codinfeccioso_val1").val(data[1]);
			});
		});
	</script>
	
	
	<script type="text/javascript">
		$().ready
		(
			function() 
			{		
				$("#courseMicro").autocomplete("autocomp4.php", {
					minChars: 3,
					autoFill: false,
					mustMatch: false,
					matchContains: false,
					scroll: true,
					scrollHeight: 220
				});	
				$("#courseMicro").result(function(event, data, formatted) 
				{$("#courseMicro_val").val(data['1']);
					$("#justi").val(data['2']);
					$("#posmdi").val(data['3']);
					$("#uni").val(data['4']);
				});
			}	
		);
	</script>
	
	<script type="text/javascript">	
		$().ready
		(
			function() {	
				
				$("#examenConfirmatorio1").autocomplete("auto_muestra.php", {
				minChars: 3,
						autoFill: false,
						mustMatch: false,
						matchContains: false,
						scroll: true,
						scrollHeight: 220
						});	
				$("#examenConfirmatorio1").result(function(event, data, formatted) 
				{$("#examenConfirmatorio1_val").val(data['1']);
				});
			}	
		);
	</script>
	
	<script type="text/javascript">	
		$().ready
		(
			function() {	
				$("#resultadoMicro1").autocomplete("auto_resultado.php", {
					minChars: 3,
					autoFill: false,
					mustMatch: false,
					matchContains: false,
					scroll: true,
					scrollHeight: 220
				});	
				$("#resultadoMicro1").result(function(event, data, formatted) 
				{$("#resultadoMicro1_val").val(data['1']);
				});
			}	
		);
	</script>
	
</head>	

<body>

<div class="container p-3 my-3 border">



<?php
	date_default_timezone_set('America/Bogota');
	
	echo"<form name=uno method=post>";
	echo"<input type='hidden' name='CodigoMedMicro'>";	
	echo"<input type='hidden' name='nivelMicro' value='$nivelMicro' >";
	echo"<input type='hidden' name='courseMicro_val' id='courseMicro_val' >";
	echo"<input type='hidden' name='preclasemedi' value='$preclasemedi' >";
	echo"<input type='hidden' name='precodmedi' value='$precodmedi' >";
	echo"<input type='hidden' name='predesmedi' value='$predesmedi' >";
	echo"<input type='hidden' name='predosis' value='$predosis' >";
	echo"<input type='hidden' name='preunid' value='$preunid' >";
	echo"<input type='hidden' name='prefrecu' value='$prefrecu' >";
	echo"<input type='hidden' name='preunidfrecu' value='$preunidfrecu' >";
	echo"<input type='hidden' name='previa' value='$previa' >";
	echo"<input type='hidden' name='pretiempo' value='$pretiempo' >";
	echo"<input type='hidden' name='preobsemed' value='$preobsemed' >";
	echo"<input type='hidden' name='precanti' value='$precanti' >";
	echo"<input type='hidden' name='prediagmedi' value='$prediagmedi' >";
	echo"<input type='hidden' name='prejustifi' value='$prejustifi' >";
	echo"<input type='hidden' name='prepos' value='$prepos' >";

/*
	echo 'CodigoMedMicro '.$CodigoMedMicro.'<br>'; 
	echo 'nivelMicro '.$nivelMicro.'<br>';
	echo 'courseMicro_val '.$courseMicro_val.'<br>';
	echo 'preclasemedi '.$preclasemedi.'<br>';
	echo 'precodmedi '.$precodmedi.'<br>';
	echo 'predesmedi '.$predesmedi.'<br>';
	echo 'predosis '.$predosis.'<br>';
	echo 'preunid '.$preunid.'<br>';
	echo 'prefrecu '.$prefrecu.'<br>';
	echo 'preunidfrecu '.$preunidfrecu.'<br>';
	echo 'previa '.$previa.'<br>';
	echo 'pretiempo '.$pretiempo.'<br>';
	echo 'preobsemed '.$preobsemed.'<br>';
	echo 'precanti '.$precanti.'<br>';
	echo 'prediagmedi '.$prediagmedi.'<br>';
	echo 'prejustifi '.$prejustifi.'<br>';
	echo 'prepos '.$prepos.'<br>';
*/	
	
//	echo 'El CodigoMedMicro '.$CodigoMedMicro.'<br>'; 
//	echo 'El nivelMicro '.$nivelMicro.'<br>'; 
	
//	$CodigoMedMicro1=$CodigoMedMicro;
	
	include('php/conexion1.php');
	
	
	$consultaDestipos6 = mysql_query("select nomb_des from destipos where codi_des='$previa'");
	while($rowdest6 = mysql_fetch_array($consultaDestipos6))
	{
		$preunid6=$rowdest6['nomb_des'];
	}
	
	
	
	$cons=mysql_query("SELECT usuario.CODI_USU, usuario.NROD_USU, usuario.PNOM_USU,usuario.NEDU_USU,usuario.OCUP_USU,usuario.ETNI_USU,  
	usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU,
	usuario.DIRE_USU, usuario.TRES_USU, usuario.TPAF_USU, contrato.CODI_CON, contrato.NEPS_CON
	FROM usuario
	INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO
	INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
	WHERE ((usuario.CODI_USU)='$gcod_usu') AND  ucontrato.ESTA_UCO='AC'");
	while($rowcons = mysql_fetch_array($cons))
	{
		$cedula=$rowcons['NROD_USU'];
		$nom1usu=$rowcons['PNOM_USU'];   
		$nom2usu=$rowcons['SNOM_USU'];   
		$ape1usu=$rowcons['PAPE_USU'];   
		$ape2usu=$rowcons['SAPE_USU']; 
		$sexo=$rowcons['SEXO_USU'];
		$fecha_nacimi=$rowcons['FNAC_USU']; 	
		$eda=utf8_decode(ucfirst(calculaedad($rowcons['FNAC_USU']))); 
		$tipo=$rowcons['TPAF_USU'];
		$deireccion=$rowcons['DIRE_USU'];
		$telefono=$rowcons['TRES_USU'];		
		$codcontrato=$rowcons['CODI_CON'];		
		$contrato=$rowcons['NEPS_CON'];	
		$gene=$rowcons['SEXO_USU'];
		$escol=$rowcons['NEDU_USU'];
		$ocupa=$rowcons['OCUP_USU'];
		$raza1=$rowcons['ETNI_USU'];
	}
	
	if($sexo=='F')$sexovr1='Femenino';
	if($sexo=='M')$sexovr1='Masculino';
	$melo=0;
	$identifica33='Identificación: '.$cedula;
	$paciente33='Paciente: '.$nom1usu.' '.$nom2usu.' '.$ape1usu.' '.$ape2usu;
	$genero33='Genero: '.$sexovr1;
	$edad33= 'Fecha de Nacimiento '.$fecha_nacimi.'&nbsp;&nbsp;&nbsp;&nbsp;Edad: '.utf8_encode($eda);
	$contrato33='Contrato: '.$contrato; 
	$ffechaActual=date('Y-m-d');
	$fechaprescri33='Fecha de Prescripcion : '.$ffechaActual; 
	$controlArchivoTemp=0;
	
	$archivomicro='tmp/9CMICR'.$numcita.'-'.$paciente.'.txt';	
	if(file_exists($archivomicro)){
		$contador=0;
		$mediMicroeli = array();
		$archivoMicro='tmp/9CMICR'.$numcita.'-'.$gcod_usu.'.txt';
		if(file_exists($archivoMicro)){
			$fp = fopen ($archivoMicro, "r" );
			while (( $data = fgetcsv ( $fp , 1000 , "\n" )) !== FALSE ){ 	
				$reg++;
				$i = 0;
				foreach($data as $dato){
					$campo[$i]=$dato;
					$i++ ;
				}
				$id12=$campo[0];
				$partesDeArray=explode("|", $id12);
				if ($partesDeArray[1]=='codigo' && $partesDeArray[2]==$CodigoMedMicro){
					$localizado=$contador;
					$controlArchivoTemp=1;
				}
				array_push($mediMicroeli, $id12); 
				$contador++;
			}
			fclose ($fp);
			if($controlArchivoTemp==1){
				$totalArray=count($mediMicroeli);
				$hastaFinal=$localizado+9;

				for($i=0;$i<=$totalArray;$i++){
					if($i>=$localizado && $i<=$hastaFinal){
						$porciones1 = explode("|", $mediMicroeli[$i]);
						$$porciones1[1]=$porciones1[2];
						$melo=1;
					}
				}
			}	
		}
	}
	
	$diagnosticoMicro1=substr($diagnosticoMicro, 0, -1);
	$claseDianostico=substr($diagnosticoMicro, -1);
	$diagnosticoMicro=$diagnosticoMicro1;

	$partesDosis = explode("-", $dosisMicro);
	$partesFrecuencia = explode("-", $frecuenciaMicro);
	$partesTiempo = explode("-", $tiempoMicro);
	
	$dosisMicro=$partesDosis[0];
	$unidadMicro=$partesDosis[1];
	
	$frecuenciaMicro=$partesFrecuencia[0];
	$unidadFrecueciaMicro=$partesFrecuencia[1];

	$tiempoMicro=$partesTiempo[0];
	$unidTiempoAnti=$partesTiempo[1];

	echo "<input type hidden name='controlEdutar' value=$melo>";
	
//	echo $diagnosticoMicro1.'<br>';
//	echo $claseDianostico.'<br>';
	
	$archivo2='tmp/4HC'.$numcita.'-'.$paciente.'.txt';	
	if(file_exists($archivo2))
	{
		$fp = fopen ($archivo2, "r" );
		$reg1=0;
		while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) 
		{ 
			$reg1++;
			$j = 0;
			foreach($data as $dato)
			{
				$campo2[$j]=$dato;
				$j++ ;
			}
			$$campo2[1]=$campo2[2];					
		}
	}
	
	
	$diagnoprescri33='Diagnóstico Principal: '.$map;
	if($tipodiag==1)$tipTexDiag='Impresión Diagnostica';
	if($tipodiag==2)$tipTexDiag='Confirmado Nuevo';
	if($tipodiag==3)$tipTexDiag='Confirmado Repetido';
		
		
	$tipoprescri33='Tipo de Diagnóstico: '.$tipTexDiag;
	$titulo = utf8_decode(ucfirst("Formato de prescripción de antimicrobianos restringidos"));
	$titulo1 = utf8_decode(ucfirst("El diligenciamiento de éste formato es necesario para la dispensación del antimicrobiano de uso restringido, y corresponde a un documento adicional a la formulación."));
	?>	
	
	<table align=center class='tbl' width=100%>
		<tr>
			<th align=center height=30><b><h2><?php echo $titulo ?></h2></b></th>
		</tr>
		<tr>
			<th class='caja' align=center height=30><b><h3><?php echo $titulo1 ?></h3></b></th>
		</tr>
	</table>
	
	<input type=hidden name=itemelitre>
		
		


	<br>
	<center>
	<table align=center width=90% border 1>	
		<tr><td>
		<center>
			<table align=center width=94%>	
				<tr><td>	
					<br>
					<h3><b>Ambito</b></h3>
					Hospitalizacion ( )      &nbsp;&nbsp;&nbsp;              Ambito Ambulatorio  (X)<br>
					<br>
					<h3><b>Datos de Paciente</b></h3>
					<?php echo utf8_decode(ucfirst($paciente33)); ?><br>
					<?php echo utf8_decode(ucfirst($identifica33)); ?><br>
					Edad: &nbsp; <?php echo utf8_decode(ucfirst(utf8_encode($eda))); ?><br>
					<?php echo utf8_decode(ucfirst($contrato33)); ?><br>
					<?php echo utf8_decode(ucfirst($fechaprescri33)); ?><br>
					<br>
					<h3><b>Diagnostico actual de formulacion</b></h3>
					<?php echo utf8_decode(ucfirst($diagnoprescri33)); ?><br>
					<?php echo utf8_decode(ucfirst($tipoprescri33)); ?>
					<br><br>
				</td></tr>	
			</table>
		</center>
		</td></tr>
	</table>
	</center>
	
	<input type='hidden' id='uni' name='unidad' value='<?php $unidad ?>'>
	
	<br>
	
	<center>
	<table align=center width=90% border 1>	
		<tr><td>
		<center>
		<table align=center width=94%>	
			<tr><td>
				
<!--				
				<br>
				<h3><b><?php //echo utf8_decode(ucfirst("Tiempo de tratamiento:"))?> </b></h3> 
				<input type 'text' id='tiempoTratamiento' name='tiempoTratamiento' required>
				<br><br>
-->				
				
				<h3><b><?php echo utf8_decode(ucfirst("Diagnóstico Infeccioso:"))?> </b></h3> 
				<textarea onPaste='return false' id='cieinfeccioso1' name='diagnosticoMicro' rows=2 cols='100%' required><?php echo $diagnosticoMicro; ?></textarea>
				<br>
				<?php echo utf8_decode(ucfirst("Tipo de Diagnóstico:"))?>
				<br>
				<select class="form-control form-control-sm border-info" name="claseDianostico" required id="claseDianostico">
					<!-- <option value=""></option> -->
					<option value="1">Sospechoso</option>
					<option value="2">Confirmado</option>
				</select>
				<script>
					uno.claseDianostico.value="<?php echo $claseDianostico;?>"
				</script>		
				<br><br>
				<h3><b>Examen confirmatorio</b></h3>
				Origen/tipo de muestra: 
				<br>
				<textarea class="form-control form-control-sm border-info " onPaste='return false' id='resultadoMicro1' name='resultadoMicro' rows=2 cols='100%' required><?php echo $resultadoMicro; ?></textarea>
				<br>
				Resultado/Microorganismo: 
				<br>
				<textarea class="form-control form-control-sm border-info " onPaste='return false' id='examenConfirmatorio1' name='examenConfirmatorio' rows=2 cols='100%' required><?php echo $examenConfirmatorio; ?></textarea>
				<br><br>
				<h3><b>Tratamiento Antimicrobiano Actual</b></h3>
				Nombre y forma farmaceutica:
				<br>
				<textarea class='form-control form-control-sm border-info' onPaste='return false' id='courseMicro' name='nombreMicroAnte'  cols='100%' autofocus required><?php echo $nombreMicroAnte; ?></textarea>
				<br>
				Dosis:
				<br>
				<input type="text" name="dosisMicro" class="form-control form-control-sm border-info" value="<?php echo $dosisMicro ?>">
					<select class='form-control form-control-sm border-info' name="unidadMicro" id="unidadMicro">
						<option value=""></option>
						<option value="UND">UND</option>
						<option value="CC">CC</option>
						<option value="GOTAS">GOTAS</option>
						<option value="GR">GR</option>
						<option value="MG">MG</option>
						<option value="MCG">MCG</option>
						<option value="UI">UI</option>
						<option value="PUFF">PUFF</option>
					</select>
					<script>
						uno.unidadMicro.value="<?php echo $unidadMicro;?>"
					</script>
				<br>
				Frecuencia: 
				<br>
				<input type="text" name="frecuenciaMicro" class="form-control form-control-sm border-info" value="<?php echo $frecuenciaMicro ?>">
					<select class="form-control form-control-sm border-info" name="unidadFrecueciaMicro" id="unidadFrecueciaMicro">
						<option value=""></option>
						<option value="Minutos">Minutos</option>
						<option value="Horas">Horas</option>
						<option value="Dias">Dias</option>			
					</select>
					<script>
						uno.unidadFrecueciaMicro.value="<?php echo $unidadFrecueciaMicro;?>"
					</script>
				<br>
				Tiempo:
				<br>
					<input type="text" name="tiempoMicro" class="form-control form-control-sm border-info" value="<?php echo $tiempoMicro ?>">
					<select class="form-control form-control-sm border-info" name="unidTiempoAnti" id="unidTiempoAnti">
						<option value=""></option>
						<option value="Horas">Horas</option>
						<option value="Dias">Dias</option>
						<option value="Meses">Meses</option>			
					</select>
					<script>
						uno.unidTiempoAnti.value="<?php echo $unidTiempoAnti;?>"
					</script>
				<br><br>
				<h3><b><?php echo utf8_decode(ucfirst("Razón del cambio del tratamiento actual o de adición de un antimicrobiano nuevo:"))?> </b></h3>
				<textarea name="razondeCambio" rows=2 onPaste="return false" class="form-control form-control-sm border-info" rows=2 cols="100%"><?php echo $razondeCambio;?></textarea>
				<br><br>	
				<h3><b>Observaciones:</b></h3>
				<textarea name="obsevaMicro" rows=2 onPaste="return false" class="form-control form-control-sm border-info" rows=2 cols="100%"><?php echo $obsevaMicro;?></textarea>
				<br><br>
			</td></tr>
		</table> 
		</center>
		</tr></td>
	</table>
	</center>
	<br><br>
<?php		
	
	if($precodmedi>0){
	
		echo"<input type=hidden name=nivel>
		<center>
		<table align=center width=90% border=1>";	
		echo"<tr>
			<td class='Td1' align='center'><b>Producto Farmaceutico</b></th>
			<td class='Td1' align='center'><b>Dosis</b></th>
			<td class='Td1' align='center'><b>Frecuencia</b></th>
			<td class='Td1' align='center'><b>Via</b></th>
			<td class='Td1' align='center'><b>Tiempo</b></th>
			<td class='Td1' align='center'><b>Cantidad</b></th>
		</tr>";
		
		$nomdesmedi=substr($predesmedi,0,40);
//vich												
		echo"<tr>
			<td>$nomdesmedi</td>					
			<td>$predosis $preunid</td>
			<td>$prefrecu $preunidfrecu</td>
			<td>$preunid6</td>
			<td>$pretiempo Dias</td>
			<td align=center>$precanti</td>
		</tr>";
		echo"<input type=hidden name=variables value='$cont'>";
		echo"</table>";	
	}
	else{
		$archivomues='tmp/6HC'.$numcita.'-'.$paciente.'.txt';
		if(file_exists($archivomues)){
			echo"
			<center>
			<table align=center width=90% border=1>";
			echo"<tr>
			<td class='Td1'><b>Producto Farmaceutico</b></th>
			<td class='Td1'><b>Dosis</b></th>
			<td class='Td1'><b>Frecuencia</b></th>
			<td class='Td1'><b>Via</b></th>
			<td class='Td1'><b>Tiempo</b></th>
			<td class='Td1'><b>Cantidad</b></th>
			</tr>";
			$fp = fopen ($archivomues, "r" );
			$reg=0;
			$cont=0;
			while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) 
			{ 
				$reg++;
				$i = 0;
				foreach($data as $dato)
				{
					$campo[$i]=$dato;
					$i++ ;
				}
				$$campo[1]=$campo[2];
				if($codmedi===$CodigoMedMicro){
					if($reg % 14 == 0){
						$nvia='';
						if($clasemedi=='1')$tipo='MED';
						$bvia1=mysql_query("select * from destipos where codi_des='$via'");
						while($rvia1=mysql_fetch_array($bvia1))
						{
							$nvia=$rvia1['nomb_des'];
						}
						$desmedi=substr($desmedi,0,40);
												
						echo"<tr>
						<td>$desmedi</td>					
						<td>$dosis $unid</td>
						<td>$frecu $unidfrecu</td>
						<td>$nvia</td>
						<td>$tiempo Dias</td>
						<td align=center>$canti</td>
						</tr>";	
						$cont++;
					}
				}			
			}
			echo"</table></center>";
		}
	}
	
	$archivo2='tmp/5PC'.$numcita.'-'.$paciente.'.txt';	
	if(file_exists($archivo2)){
		$fp = fopen ($archivo2, "r" );
		$reg1=0;
		while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ){ 
			$reg1++;
			$j = 0;
			foreach($data as $dato)
			{
				$campo2[$j]=$dato;
				$j++ ;
			}
			$$campo2[1]=$campo2[2];					
		}
	}
		
//	echo $CodigoMedMicro.'<br>';	

?>

	<br>
	<center>
	<table align=center width=100% align='center'>	
		<tr align='center'><td align='center'>
			<?Php
				echo"<INPUT type='button' class='btn btn-outline-primary btn-sm' value='Adicionar' onClick='valida(\"$CodigoMedMicro\")'>&nbsp;&nbsp;&nbsp;";
			?>
			<INPUT type="button" class="btn btn-secundary btn-sm" value="Retornar" onClick="valida1()">
		</tr></td>
	</table>
	</center>
	<br><br>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	
	<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
	
	
	
<?PHP
	function calculaedad($fecha_){
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
			if(date("m")-$mes_==0 & date("d")-$dia_<0){$anos_=$anos_-1;}
				$meses_=11;
			}

			if($anos_<>0)
			{
				$edad_=$anos_;
				if($edad_==1){
					$unidad_=" Año";}
				else{
					$unidad_=" Años";}
			}
		else
		{
			if($meses_<>0){
				$edad_=$meses_;
				if($edad_==1){
					$unidad_=" Mes";}
				else{
				$unidad_=" Meses";}
			}
			else{
				$edad_=$dias_;
				if($edad_==1){
					$unidad_=" Día";}
				else{
				$unidad_=" Días";}
			}
	  }
	  return($edad_.$unidad_);
	}

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
			if(date("m")-$mes_==0 & date("d")-$dia_<0){$anos_=$anos_-1;}
				$meses_=11;
		}

		if($anos_<>0)
		{
			$edad_=$anos_;
			if($edad_==1){
				$unidad_=" Año";}
			else{
				$unidad_=" Años";}
		}
		else
		{
			if($meses_<>0){
			$edad_=$meses_;
			if($edad_==1){
				$unidad_=" Mes";}
			else{
				$unidad_=" Meses";}
			}
			else{
				$edad_=$dias_;
				if($edad_==1){
					$unidad_=" Día";}
				else{
					$unidad_=" Días";}
			}
		}
		return($edad_);
	}
	?>	
	
	

</body>
</form>
</html>