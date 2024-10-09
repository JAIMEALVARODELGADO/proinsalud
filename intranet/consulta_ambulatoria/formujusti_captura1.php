<?php
	session_register('paciente');
	session_register('Gcod_mediconh');	
	session_register('Gareanh'); 
	session_register('Gcontratonh');
	session_register('numcita');
	//session_register('numcita');
	
	if(empty($paciente))
	{
		echo"<br><br><table align=center class='tbl'>
		<tr><th>POR SEGURIDAD SU SESIÓN TERMINÓ. <BR>PARA FINALIZAR LA CONSULTA, CIERRE E INGRESE NUEVAMENTE AL PROGRAMA</th></tr>
		</table>";		
	}	
 
?>
<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; ISO-8859-1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<TITLE>New Document</TITLE> 
	<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />  
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
		$("#nompro1").autocomplete("auto_justipro.php", {
		width: 500,
		minChars: 3,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220
		});	
		$("#nompro1").result(function(event, data, formatted) 
		{$("#codpro1").val(data['1']);
		$("#nuecod1").val(data['2']);
		});
	}	
);
$().ready
(
	function() 
	{		
		$("#nompro2").autocomplete("auto_justipro.php", {
		width: 500,
		minChars: 3,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220
		});	
		$("#nompro2").result(function(event, data, formatted) 
		{$("#codpro2").val(data['1']);
		$("#nuecod2").val(data['2']);
		});
	}	
);
</script>	
	<script language="JavaScript">
	function salir(n)
	{
		if(n==1)
		{
			uno.target='area';
			uno.action='almacena.php';			
			uno.submit();	
		}
		if(n==2)
		{
			if(uno.codiprg.value=='5')
			{
				if(uno.siquiro.value==21)
				{	
					var soliunidpro1=uno.soliunidpro.value;
					if(soliunidpro1==0)
					{

						if(uno.consis.value=='')
						{
							alert("Diligencie en que consiste el Procedimiento?");
							return;
						}
		 
						if(uno.ries.value=='')
						{
						   alert("Diligencie en que consisten los Riesgos?");
						   return;
						}
						if(uno.benef.value=='')
						{
							alert("Diligencie en que consisten los Beneficios?");
							return;
						}
						val=0;
						opcion = document.getElementsByName("cirugia");
						var validado='0';
						for(var i=0; i<2; i++)
						{
							if(opcion[i].checked)validado = '1';
												   
						}
												
						

/*						
						if(validado=='0'){val='1';document.getElementById('q1').style.color='#ff0000';}else{document.getElementById('q1').style.color='#000000';}				
						
						opcion = document.getElementsByName("anestesia");
						var validado='0';
						f=uno.finana.value;
						for(var i=0; i<f; i++)
						{
							if(opcion[i].checked)validado = '1';							 
						}				
						if(validado=='0'){val='1';document.getElementById('q2').style.color='#ff0000';}else{document.getElementById('q2').style.color='#000000';}				
*/						
						
						
						
						if(uno.fecciru.value=='') {val='1';document.getElementById('q3').style.color='#ff0000';}else{document.getElementById('q3').style.color='#000000';}					
									
						opcion = document.getElementsByName("cirugia");
						var validado='0';
						for(var i=0; i<2; i++)
						{
							if(opcion[i].checked)validado = '1';							 
						}				
						if(validado=='0'){val='1';document.getElementById('q3').style.color='#ff0000';}else{document.getElementById('q3').style.color='#000000';}
						
						
						if(uno.hora.value=='' || uno.minu.value=='' || uno.tiho.value=='') {val='1';document.getElementById('q4').style.color='#ff0000';}else{document.getElementById('q4').style.color='#000000';}
						opcion = document.getElementsByName("requiayudante");
						var validado='0';
						for(var i=0; i<2; i++)
						{
							if(opcion[i].checked)validado = '1';							 
						}				
						if(validado=='0'){val='1';document.getElementById('q5').style.color='#ff0000';}else{document.getElementById('q5').style.color='#000000';}
						
						
						
//						if(uno.sangre.value=='') {val='1';document.getElementById('q6').style.color='#ff0000';}else{document.getElementById('q6').style.color='#000000';}	
						
						
						opcion = document.getElementsByName("requiequi");
						var validado='0';
						for(var i=0; i<2; i++)
						{
							if(opcion[i].checked)validado = '1';							 
						}				
						if(validado=='0'){val='1';document.getElementById('q7').style.color='#ff0000';}else{document.getElementById('q7').style.color='#000000';}
						
						
						if(uno.duracion.value=='' || uno.unidura.value=='') {val='1';document.getElementById('q8').style.color='#ff0000';}else{document.getElementById('q8').style.color='#000000';}
						
						
						opcion = document.getElementsByName("resuci");
						var validado='0';
						for(var i=0; i<2; i++)
						{
							if(opcion[i].checked)validado = '1';							 
						}				
						if(validado=='0'){val='1';document.getElementById('q9').style.color='#ff0000';}else{document.getElementById('q9').style.color='#000000';}
						
						
						opcion = document.getElementsByName("requimate");
						var validado='0';
						for(var i=0; i<2; i++)
						{
							if(opcion[i].checked)validado = '1';							 
						}				
						if(validado=='0'){val='1';document.getElementById('q10').style.color='#ff0000';}else{document.getElementById('q10').style.color='#000000';}
						
						
						opcion = document.getElementsByName("requimate");
						var validado='0';
						for(var i=0; i<2; i++)
						{
							if(opcion[0].checked)validado = '2';
							if(opcion[1].checked)validado = '1';	
						}				
						if(validado=='0'){val='1';document.getElementById('q10').style.color='#ff0000';}else{document.getElementById('q10').style.color='#000000';}
																							
//						if(validado==2 && uno.material.value==''){val='1';document.getElementById('q11').style.color='#ff0000';}else{document.getElementById('q11').style.color='#000000';}																	
//						if (val=='1'){alert("Hay campos obligatorios pendientes por diligenciar");return;}
					}
					else if(soliunidpro1>0)
					{
/*
						if(uno.consis.value=='')
						{
							alert("Diligencie en que consiste el Procedimiento?");
							return;
						}
						if(uno.ries.value=='')
						{
						   alert("Diligencie en que consisten los Riesgos?");
						   return;
						}
						if(uno.benef.value=='')
						{
							alert("Diligencie en que consisten los Beneficios?");
							return;
						}
*/						
					}	
				}
			}
			uno.guardapos.value=1;
			uno.target='area';
			uno.action='almacena.php';			
			uno.submit();	
		}
		if(n==3)
		{
			uno.guardapos.value=0;
			uno.target='area';
			uno.action='almacena.php';
			uno.submit();	
		}
	}
	
	function habimate()
	{		
		opcion = document.getElementsByName("requimate");
		var validado='0';
		for(var i=0; i<2; i++)
		{
			if(opcion[0].checked)
			{
				validado = '1';
			}
			if(opcion[1].checked)
			{
				validado = '2';
			}					 
		}		
		if(validado=='1')
		{
			uno.material.disabled=false;
		}
		if(validado=='2')
		{
			uno.material.disabled=true;
		}		
	}
</script>
	</HEAD>
<BODY>


</style>
<?php 
    $fechci=time();
    $feccin=date ("Y-m-d",$fechci);
    $justi='tmp/4HC'.$numcita.'-'.$paciente.'.txt';	
	if(file_exists($justi))
	{
		$fp = fopen ($justi, "r" );
		$reg=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{ 
			$reg++;
			$i = 0;
			foreach($data as $dato)
			{
				$campo[$i]=$dato;
				$i++ ;
			}
			$$campo[1]=$campo[2];		
		}
	}
	include('php/conexion1.php');
	echo"<form name=uno method=post>
	<input type=hidden name=codiprg value='$codiprg'>
	<input type=hidden name=pideuni value='$pideuni'>
	<input type=hidden name=sachaitem>
	<input type=hidden name=guardapos value='0'>";
	
	$consultamag="SELECT REGMAG_CON FROM contrato WHERE CODI_CON='$Gcontratonh'";
	$consultamag=mysql_query($consultamag);
	$rowmag=mysql_fetch_array($consultamag);
	$regmag_con=$rowmag[REGMAG_CON];

	
	$buscc=mysql_query("select * from medicos where cod_medi='$Gcod_mediconh'");
	$resulcc=0;
	while($rcc=mysql_fetch_array($buscc))
	{		
		if($rcc['tido_medi']==NULL || $rcc['tido_medi']=='')$resulcc=1;
	}
	if($codiprg==5)
	{
		echo"
		<input type=hidden name=claseorden value='$claseorden'>
		<input type=hidden name=codorden value='$codorden'>
		<input type=hidden name=desorden value='$desorden'>
		<input type=hidden name=nivel value='$nivel'>
		<input type=hidden name=obseorden value='$obseorden'>
		<input type=hidden name=diagorden value='$diagorden'>
		<input type=hidden name=cantorden value='$cantorden'>
		<input type=hidden name=cama value='$cama'>
		<input type=hidden name=pos value='$pos'>
		<input type=hidden name=itemeliperdos value='$itemeliperdos'>
		<input type=hidden name=regresa value='ordenes0.php'>";		
		
		$busjus=mysql_query("SELECT form_nop.codi_usu, form_nop.cmed_nop, form_nop.fech_pos, form_nop.tiem_nop
		FROM form_nop WHERE ((form_nop.codi_usu='$paciente') AND (form_nop.cmed_nop='$codorden') AND (tinp_nop='P'))
		ORDER BY form_nop.fech_pos DESC");
		$entra=1;
		if(mysql_num_rows($busjus)>0)
		{
			$resjus=mysql_fetch_array($busjus);		
			$fechpos=$resjus['fech_pos'];
			$tiempo=$resjus['tiem_nop'];
			$anoj=substr($fechpos,0,4);
			$mesj=substr($fechpos,5,2);
			$diaj=substr($fechpos,8,2)+$tiempo;		
			$numjus=gmmktime ( 00, 00, 00, $mesj, $diaj, $anoj);			
			$hoy=date('Y-m-d');
			$anoh=substr($hoy,0,4);
			$mesh=substr($hoy,5,2);
			$diah=substr($hoy,8,2)+$tiempo;	
			$numhoy=gmmktime ( 00, 00, 00, $mesh, $diah, $anoh);
			if($numjus>=$numhoy)$entra=0;			
		}
		
		if($entra==1)
		{
			if($pos!='N')
			{
				$entra=0;
			}		
		}
		
		
		if($regmag_con=='S')
		{
			$entra=0;				
		}			

		
		$bustip=mysql_query("SELECT prmt_cup FROM cups where codigo='$codorden'");
		while($rtip=mysql_fetch_array($bustip))
		{
			$prmt_cup=$rtip['prmt_cup'];		
		}		
		
		
		$soli='N';
		echo"<input type=hidden name=sipos value=$entra>";
		echo"<input type=hidden name=siquiro value=$prmt_cup>";
		echo"<input type=hidden name=soliunidpro value='$soliunidpro'>";
		
		
		if($prmt_cup==21)
		{			
//			$nuevocontrol=1;
			if($soliunidpro==0 && $pideuni=='S')
			{
				echo"
				<br><br>
				<table class='tbl' align=center>
				<tr>
				<th colspan=2><b>SOLICITUD DE UNIDAD QUIRURGICA</td> 		
				</tr>
				<table class='tbl' width=50% align=center>
				<tr>
				<td id='q1'><b>CIRUGIA</td>
				<td>URGENCIAS <input type=radio name=cirugia value='U'> 
				ELECTIVA <input type=radio name=cirugia value='E'>
				</td>
				</tr>";
				
//				<tr><td colspan='2'><hr size='0.5' colorrgb='230,230,192'/></td></tr>
/*
				echo"
				<tr>
				<td id='q2'><b>ANESTESIA</td>
				<td>";
				$bdes=mysql_query("select * from destipos where codt_des='36'");
				$numbdes=mysql_num_rows($bdes);
				echo"<input type=hidden name=finana value='$numbdes'>";
				while($rdes=mysql_fetch_array($bdes))
				{
					$coddt=$rdes['codi_des'];
					$nomdt=$rdes['nomb_des'];
					echo" <input type=radio name=anestesia value='$coddt'> $nomdt<br>";			
				}

				echo"
				</td> 				
				</tr>
*/				
				echo"
				<tr>
				<td id='q3'><b>FECHA CIRUGIA</th>
				<td>";
				?>
					<input type="text" name="fecciru" class='caja' size="10" maxlength="10" value="<?echo $fecciru;?>" id="fini" <?echo $disp;?>>
					<input type="button" class='caja' id="lanzador1" value="..." <?echo $disp;?>/>
					<!-- script que define y configura el calendario--> 
					<script type="text/javascript"> 
					Calendar.setup({ 
					inputField     :    "fini",     // id del campo de texto 
					ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
					button     :    "lanzador1"     // el id del botón que lanzará el calendario 				
					}); 
					</script> 				
				<?php		
				echo"</td>
				</tr>
				
				<tr>
				<td id='q4'><b>HORA</td>
				<td>";
				echo"<select name=hora>
				<option value=''></option>";			
				for($i=0;$i<13;$i++)
				{
					if($i<10)$h='0'.$i;
					else $h=$i;
					echo "<option value='$h'>$h</option>"; 
				}
				echo"</select>
				<select name=minu>
				<option value=''></option>"; 
				for($j=0;$j<60;$j=$j+5)
				{
					if($j<10)$h='0'.$j;
					else $h=$j;
					echo "<option value='$h'>$h</option>"; 
				}
				echo"</select>
				<select name=tiho>
				<option value=''></option>
				<option value='AM'>AM</option>
				<option value='PM'>PM</option>
				</select>
				</td>
				</tr>
				
				<tr>
				<td id='q5'><b>REQUIERE AYUDANTE</td>
				<td>SI <input type=radio name=requiayudante value='S'> NO <input type=radio name=requiayudante value='N'></td>
				</tr>";
				
				//este es una entrada nueva 				
				
				echo"
				<tr>
				<td id='q6'><b>HEMODERIVADOS</td>
				<td>
				<table class='tbl' align=center>";
					$conthemoder=1;
					$bdeser=mysql_query("select * from medicamentos2 where CHAR_LENGTH(codi_mdi)=5");
					$numbdeser=mysql_num_rows($bdeser);
//					echo"<input type=hidden name=finana value='$numbdeser'>";
					while($rdeser=mysql_fetch_array($bdeser))
					{
						$tensor='nomconthemoder'.$conthemoder;
						echo"<tr>";
						$coddter=$rdeser['codi_mdi'];
						$nomdter=$rdeser['nomb_mdi'];
						
						echo" <td><input type='checkbox' name='$tensor' $coddter value='$coddter'> $nomdter </td>	
						<td>";
						
						$conunidad='conesteunid'.$conthemoder;
						
						echo"
						<select name='$conunidad'>
						<option value=''></option>"; 
						$tope='j'.$conthemoder;
						for($tope=0;$tope<10;$tope++)
						{				
							echo "<option value='$tope'>$tope</option>"; 
						}
						$conthemoder++;
						echo"</select> UNIDADES </td></tr>";		
					}
				echo"
				</table>
				</td>
				</tr>			
				<tr>
				<td id='q7'><b>REQUIERE EQUIPO RX</td>
				<td>SI <input type=radio name=requiequi value='S'> NO <input type=radio name=requiequi value='N'></td>
				</tr>
				
				<tr>
				<td id='q7'><b>REQUIERE ANESTESIA</td>
				<td>SI <input type=radio name=anestesia value='S'> NO <input type=radio name=anestesia value='N'></td>
				</tr>
				
				<tr>
				<td id='q7'><b>REQUIERE ECOGRAFIA</td>
				<td>SI <input type=radio name=requieco value='S'> NO <input type=radio name=requieco value='N'></td>
				</tr>
				
				
				
				
				
				
				
				<tr>
				<td id='q8'><b>DURACION</td>
				<td>
				<input type=text name=duracion size=2 onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;'>
				</select>
				<select name=unidura>
				<option value=''></option>
				<option value='MM'>MINUTOS</option>
				<option value='HH'>HORAS</option>
				</select>
				</tr>
				
				<tr>
				<td id='q9'><b>RESERVA DE UCI</td>
				<td>SI <input type=radio name=resuci value='S'> NO <input type=radio name=resuci value='N'></td>
				</tr>
				
				<tr>
				<td id='q9'><b>EL PROCEDIMIENTO SE PUEDE REALIZAR EN LA INSTITUCION:</td>
				<td>SI <input type=radio name=proceinstitu value='S'> NO <input type=radio name=proceinstitu value='N'></td>
				</tr>
				
				<tr>
				<td id='q11'><b>REQUIERE CONDICIONES, INSUMOS Y/O EQUIPOS ESPECIALES</td>
				<td><textarea name=consicion cols=40 rows=3></textarea></td>			
				</tr>
				
				<tr>
				<td id='q10'><b>REQUIERE MATERIAL</td>
				<td>SI <input type=radio name=requimate onclick='habimate()' value='S'> NO <input type=radio onclick='habimate()' name=requimate value='N'></td>			
				</tr>
				
				<tr>
				<td id='q11'><b>CUAL?</td>
				<td><textarea name=material disabled cols=40 rows=3></textarea></td>			
				</tr>";
				
				$soli='S';
							echo"<tr>
				<th colspan=2><b>CONSENTIMIENTO INFORMADO</b></td> 		
				</tr>";
							echo"<tr>
				<td>Fecha: $feccin</td> 		
				</tr>";
				$datpaci=mysql_query("SELECT NROD_USU,TDOC_USU,NROD_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU FROM USUARIO WHERE CODI_USU='$paciente'");
				$rowusuci=  mysql_fetch_array($datpaci);
				$nomb_=$rowusuci[PNOM_USU].' '.$rowusuci[SNOM_USU].' '.$rowusuci[PAPE_USU].' '.$rowusuci[SAPE_USU];
				$tipdo=$rowusuci[TDOC_USU];
				$numced=$rowusuci[NROD_USU];
				$datmed=mysql_query("SELECT cod_medi, ced_medi, nom_medi,are_medi  FROM medicos WHERE cod_medi='$Gcod_mediconh'");
				$rowmedci=  mysql_fetch_array($datmed);
				$nomciru=$rowmedci[nom_medi];
				$codciru=$rowmedci[cod_medi];
				$cedciru=$rowmedci[ced_medi];
				$profeci=$rowmedci[are_medi];
				$datciru=mysql_query("SELECT codigo,descrip FROM cups WHERE codigo='$codorden'");
				$rowcup=  mysql_fetch_array($datciru);
				$nomcup=$rowcup[descrip];
				
				echo"<tr>
				<td colspan=2>Yo, $nomb_, mayor de edad, identificado con $tipdo. No. $numced y como: Paciente_____, como Responsable___, "
				. "del o la paciente ______________ con C.C o TI No.__________________ Autorizo al Dr(a).  $nomciru, con Profesion o Especialidad, $profeci ,
					para la realizacion de los procedimiento $nomcup que consite en";
				echo"<textarea id='consis' class='caja' name=consis cols=60 rows=3></textarea></td> 		
				<tr><td colspan=2>Teniendo en cuenta que he sido informado claramente sobre los riesgos y beneficios que se pueden presentar, siendo estos:</td></tr>";
				
				echo"<tr><th>Riesgos</th><th>Beneficios</th></tr>";
				echo"<tr><td><textarea id='ries' class='caja' name=ries cols=60 rows=3></textarea></td>";
				echo"<td><textarea id='benef' class='caja' name=benef cols=60 rows=3></textarea></td></tr>";
				echo"<tr><td colspan=2>Comprendo y acepto que durante el procedimiento pueden aparecer circustancias imprevisibles o inesperadas que puedan requerir una
					extension del procedimiento original o la realizacion de otro procedimiento no mencionado arriba.</td></tr>";
				echo"<tr><td colspan=2>Al firmar este documento reconozco que los he leido y explicado y que comprendo perfectamente su contenido.Se me han dado amplias
					oportunidades de formular preguntas y que todas las preguntas que he formulado han sido respondidas o explicadas en forma satisfactoria";
				echo"<tr><td colspan=2>Acepto que la medicina no es una ciencia exacta y que no se me han garantizado los resultados que se esperaban de la intervesion
					quirurgica o procedimientos diagnosticados o terapeuticos, en el sentido de que la practica de la intervencion o procedimiento que requiero compromete
					una actividad de medio, pero no de resultados.<br>
					Comprendiendo estas limitaciones, doy mi consentimiento de manera libre y voluntaria para la realizacion del procedimiento y firmo a Continuacion";
				echo"</tr>";
				echo"<tr><td>Firma paciente:______________________________</td>
				<td>Firma Testigo:______________________________</td></tr>";
				echo"<tr><td>$nomb_</td> <td>Nombre ___________________ </td></tr>";
				echo"<tr><td>$tipdo  $numced</td><td>Cedula__________________ Parentesco_______________</td></tr>";
				echo"<tr><td>Firma Medico:______________________________</td></tr>";
				echo"<tr><td>$nomciru - $profeci </td></tr>";
				echo"<tr><td>RM:$codciru - $profeci </td></tr>";
				echo"<tr><td>El paciente no puede firmar por:__________________________________________</td></tr>";
			}
			
			
			
			
			
			
			
			
			
			
			
	


	
//  ESTE ES EL PROCEDIMIENTO QUE SE ESTA AJUSTANDO EN ESTE MOMENTO.			
			
			else if($soliunidpro>0 && $pideuni=='S')
			{
				
				$datciru=mysql_query("SELECT codigo,descrip FROM cups WHERE codigo='$codorden'");
				$rowcup=  mysql_fetch_array($datciru);
				$nomcup=$rowcup[descrip];
				
				
				
				$regbuscador1=$soliunidpro;
				$archivoquiro='tmp/ciruHC'.$numcita.'-'.$paciente.'.txt';
				if(file_exists($archivoquiro))
				{
					$fp = fopen ($archivoquiro, "r" );
					$reg=0;
					$cont=1;
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
						}
						$$campo[1]=$campo[2];
					}			
				}
				$soliunidpro=${'soliunidpro'.$regbuscador1};
				$diagmedi= ${'diagmedi'.$regbuscador1};
				$codmedi= ${'codmedi'.$regbuscador1};
				$nomobrecup= ${'nomobrecup'.$regbuscador1};
				$cirugia= ${'cirugia'.$regbuscador1};
				$anestesia= ${'anestesia'.$regbuscador1};
				$fecciru= ${'fecciru'.$regbuscador1};
				$hora= ${'hora'.$regbuscador1};
				$minu= ${'minu'.$regbuscador1};
				$tiho= ${'tiho'.$regbuscador1};
				$requiayudante= ${'requiayudante'.$regbuscador1};
//				$sangre= ${'sangre'.$regbuscador1};
				$unidura= ${'unidura'.$regbuscador1};
				
				$nomconthemoder1= ${'nomconthemoder1'.$regbuscador1};
				$conesteunid1= ${'conesteunid1'.$regbuscador1};
				$nomconthemoder2= ${'nomconthemoder2'.$regbuscador1};
				$conesteunid2= ${'conesteunid2'.$regbuscador1};
				$nomconthemoder3= ${'nomconthemoder3'.$regbuscador1};
				$conesteunid3= ${'conesteunid3'.$regbuscador1};
				$nomconthemoder4= ${'nomconthemoder4'.$regbuscador1};
				$conesteunid4= ${'conesteunid4'.$regbuscador1};
				$nomconthemoder5= ${'nomconthemoder5'.$regbuscador1};
				$conesteunid5= ${'conesteunid5'.$regbuscador1};
				$nomconthemoder6= ${'nomconthemoder6'.$regbuscador1};
				$conesteunid6= ${'conesteunid6'.$regbuscador1};
				$nomconthemoder7= ${'nomconthemoder7'.$regbuscador1};
				$conesteunid7= ${'conesteunid7'.$regbuscador1};
				$nomconthemoder8= ${'nomconthemoder8'.$regbuscador1};
				$conesteunid8= ${'conesteunid8'.$regbuscador1};
				$nomconthemoder9= ${'nomconthemoder9'.$regbuscador1};
				$conesteunid9= ${'conesteunid9'.$regbuscador1};
				$nomconthemoder10= ${'nomconthemoder10'.$regbuscador1};
				$conesteunid10= ${'conesteunid10'.$regbuscador1};
				
				$requiequi= ${'requiequi'.$regbuscador1};
				
				
				$requieco= ${'requieco'.$regbuscador1};
				
				$duracion= ${'duracion'.$regbuscador1};
				$proceinstitu= ${'proceinstitu'.$regbuscador1};
				$resuci= ${'resuci'.$regbuscador1};
				$requimate= ${'requimate'.$regbuscador1};
				$consicion= ${'consicion'.$regbuscador1};
				
				
				
				
				if($cirugia=='U')$cirugia11="checked";
				if($cirugia=='E')$cirugia12="checked";
				
				
				echo"
				
				<table class='tbl' width=50% align=center>
				<tr>
				<td id='q1'><b>CIRUGIA</td>
				<td>URGENCIAS <input type=radio name=cirugia $cirugia11 value='U'> 
				ELECTIVA <input type=radio name=cirugia $cirugia12 value='E'>
				</td>
				</tr>";
				
//				<tr><td colspan='2'><hr size='0.5' colorrgb='230,230,192'/></td></tr>
				
				
				
				
/*				
				echo"
				<tr>
				<td id='q2'><b>ANESTESIA</td>
				<td>";
				$bdes=mysql_query("select * from destipos where codt_des='36'");
				$numbdes=mysql_num_rows($bdes);
				echo"<input type=hidden name=finana value='$numbdes'>";
				while($rdes=mysql_fetch_array($bdes))
				{
					$coddt=$rdes['codi_des'];
					$nomdt=$rdes['nomb_des'];
					if($coddt==$anestesia)
					{
						$anestesia12="checked";
					}
					else
					{
						$anestesia12="";
					}	
					echo" <input type=radio name=anestesia $anestesia12 value='$coddt'> $nomdt<br>";			
				}
				echo"
				</td> 				
				</tr>
*/				
				
				
				echo"				
				<tr>
				<td id='q3'><b>FECHA CIRUGIA</th>
				<td>";
				?>
					<input type="text" name="fecciru" class='caja' size="10" maxlength="10" value="<?echo $fecciru;?>" id="fini" <?echo $disp;?>>
					<input type="button" class='caja' id="lanzador1" value="..." <?echo $disp;?>/>
					<!-- script que define y configura el calendario--> 
					<script type="text/javascript"> 
					Calendar.setup({ 
					inputField     :    "fini",     // id del campo de texto 
					ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
					button     :    "lanzador1"     // el id del botón que lanzará el calendario 				
					}); 
					</script> 				
				<?php		
				echo"</td>
				</tr>
				
				<tr>
				<td id='q4'><b>HORA</td>
				<td>";
				echo"<select name=hora>
				<option value=''></option>";			
				for($i=0;$i<13;$i++)
				{
					if($i<10)$h='0'.$i;
					else $h=$i;
					echo "<option value='$h'>$h</option>"; 
				}
				echo"</select>
				<script>
					uno.hora.value='$hora';
				</script>	
				
				
				
				
				
				<select name=minu>
				<option value=''></option>"; 
				for($j=0;$j<60;$j=$j+5)
				{
					if($j<10)$h='0'.$j;
					else $h=$j;
					echo "<option value='$h'>$h</option>"; 
				}
				echo"</select>
				<script>
					uno.minu.value='$minu';
				</script>	
				
				
				<select name=tiho>
				<option value=''></option>
				<option value='AM'>AM</option>
				<option value='PM'>PM</option>
				</select>
				</td>
				</tr>
				<script>
					uno.tiho.value='$tiho';
				</script>";
				
				if($requiayudante=='S')$requiayudante11="checked";
				if($requiayudante=='N')$requiayudante12="checked";
				echo"
				<tr>
				<td id='q5'><b>REQUIERE AYUDANTE</td>
				<td>SI <input type=radio name=requiayudante $requiayudante11 value='S'> NO <input type=radio name=requiayudante $requiayudante12 value='N'></td>
				</tr>";
				
				echo"
				<tr>
				<td id='q6'><b>HEMODERIVADOS</td>
				<td>
				<table class='tbl' align=center>";
					$conthemoder=1;
					$bdeser=mysql_query("select * from medicamentos2 where CHAR_LENGTH(codi_mdi)=5");
					$numbdeser=mysql_num_rows($bdeser);
//					echo"<input type=hidden name=finana value='$numbdeser'>";
					while($rdeser=mysql_fetch_array($bdeser))
					{
						$tensor='nomconthemoder'.$conthemoder;
						echo"<tr>";
						$coddter=$rdeser['codi_mdi'];
						$nomdter=$rdeser['nomb_mdi'];
						$nomconthemogen = ${'nomconthemoder'.$conthemoder};
						if($nomconthemogen==$coddter)
						{	
							$geconthemogen="checked";
						}
						else
						{
							$geconthemogen="";
						}	
						echo" <td><input type='checkbox' name='$tensor' $geconthemogen value='$coddter'> $nomdter </td>	
						<td>";
						$conunidad='conesteunid'.$conthemoder;
						$conestegen= ${'conesteunid'.$conthemoder};
						echo"
						<select name='$conunidad'>
						<option value=''></option>"; 
						$tope='j'.$conthemoder;
						for($tope=0;$tope<10;$tope++)
						{				
							echo "<option value='$tope'>$tope</option>"; 
						}
						$conthemoder++;
						echo"</select> UNIDADES </td></tr>
						<script>
							uno.$conunidad.value='$conestegen';
						</script>";		
					}
				echo"
				</table>
				</td>
				</tr>";			
				
				if($requiequi=='S')$requiequi11="checked";
				if($requiequi=='N')$requiequi12="checked";
				
				echo"
				<tr>
				<td id='q7'><b>REQUIERE EQUIPO RX</td>
				<td>SI <input type=radio name=requiequi $requiequi11 value='S'> NO <input type=radio name=requiequi $requiequi12 value='N'></td>
				</tr>";
				
				
				if($anestesia=='S')$anestesia11="checked";
				if($anestesia=='N')$anestesia12="checked";
				echo"
				<tr>
				<td id='q7'><b>REQUIERE ANESTESIA</td>
				<td>SI <input type=radio name=anestesia $anestesia11 value='S'> NO <input type=radio name=anestesia $anestesia12 value='N'></td>
				</tr>
				";
				
				
				
				
				if($requieco=='S')$requieco11="checked";
				if($requieco=='N')$requieco12="checked";
				
				echo"
				<tr>
				<td id='q7'><b>REQUIERE ECOGRAFIA</td>
				<td>SI <input type=radio name=requieco $requieco11 value='S'> NO <input type=radio name=requieco $requieco12 value='N'></td>
				</tr>
				
				
				<tr>
				<td id='q8'><b>DURACION</td>
				<td>
				<input type=text name=duracion value='$duracion' size=2 onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;'>
				</select>
				<select name=unidura>
				<option value=''></option>
				<option value='MM'>MINUTOS</option>
				<option value='HH'>HORAS</option>
				</select>
				<script>
					uno.unidura.value='$unidura';
				</script>
				</tr>";
				
				if($resuci=='S')$resuci11="checked";
				if($resuci=='N')$resuci12="checked";
				
				echo"
				<tr>
				<td id='q9'><b>RESERVA DE UCI</td>
				<td>SI <input type=radio name=resuci $resuci11 value='S'> NO <input type=radio name=resuci $resuci12 value='N'></td>
				</tr>";
				
				if($proceinstitu=='S')$proceinstitu11="checked";
				if($proceinstitu=='N')$proceinstitu12="checked";
				
				echo"
				
				<tr>
				<td id='q9'><b>EL PROCEDIMIENTO SE PUEDE REALIZAR EN LA INSTITUCION:</td>
				<td>SI <input type=radio name=proceinstitu $proceinstitu11 value='S'> NO <input type=radio name=proceinstitu $proceinstitu12 value='N'></td>
				</tr>
				
				<tr>
				<td id='q11'><b>REQUIERE CONDICIONES, INSUMOS Y/O EQUIPOS ESPECIALES</td>
				<td><textarea name=consicion cols=40 rows=3>$consicion</textarea></td>			
				</tr>";
				
				if($requimate=='S')$requimate11="checked";
				if($requimate=='N')$requimate12="checked";
				
				echo"
				
				
				<tr>
				<td id='q10'><b>REQUIERE MATERIAL</td>
				<td>SI <input type=radio name=requimate $requimate11 onclick='habimate()' value='S'> NO <input type=radio onclick='habimate()' name=requimate $requimate12 value='N'></td>			
				</tr>";
				
				
//				$regbuscador1=2;
//----------------------------------------------	
				$controtabla=0;
				$archivoquiroexps='tmp/ciruHCEXPS'.$numcita.'-'.$paciente.'.txt';
				
				if(file_exists($archivoquiroexps))
				{
					$fp = fopen ($archivoquiroexps, "r" );
					$reg=0;
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
						}
						$$campo[1]=$campo[2];
						
						if($reg % 8 == 0)
						{	
							$cont=substr($campo[1], -3);	
							$listo = ${'soliunidprodos'.$cont};
							if ($listo==$regbuscador1)
							{
								$controtabla++;
								$nomvariable=${'codmedi'.$cont};
								$trenomcup=${'nomprocedi'.$cont};
								$nomvarhm='materialultimo'.$nomvariable;
								${'materialultimo'.$nomvariable}=${'material'.$cont};		
								if($controtabla==1)	
								{
									echo"<tr><td id='q11 colspan=2'><b>CUAL?</td></tr>";
								}	
								
								echo"<tr><td>$trenomcup</td><td><textarea name='$nomvarhm' cols=40 rows=2>${'materialultimo'.$nomvariable}</textarea></td></tr>";
							}
						}	
					}			
				}
				
				
				echo"<tr><td>$nomcup</td><td><textarea name='Nuevocual' cols=40 rows=2></textarea></td></tr>";

//------------------------------------------------//------------------------------------------------				
				$soli='S';
				echo"<tr>
				<th colspan=2><b>CONSENTIMIENTO INFORMADO</b></td> 		
				</tr>";
							echo"<tr>
				<td>Fecha: $feccin</td> 		
				</tr>";
				$datpaci=mysql_query("SELECT NROD_USU,TDOC_USU,NROD_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU FROM USUARIO WHERE CODI_USU='$paciente'");
				$rowusuci=  mysql_fetch_array($datpaci);
				$nomb_=$rowusuci[PNOM_USU].' '.$rowusuci[SNOM_USU].' '.$rowusuci[PAPE_USU].' '.$rowusuci[SAPE_USU];
				$tipdo=$rowusuci[TDOC_USU];
				$numced=$rowusuci[NROD_USU];
				$datmed=mysql_query("SELECT cod_medi, ced_medi, nom_medi,are_medi  FROM medicos WHERE cod_medi='$Gcod_mediconh'");
				$rowmedci=  mysql_fetch_array($datmed);
				$nomciru=$rowmedci[nom_medi];
				$codciru=$rowmedci[cod_medi];
				$cedciru=$rowmedci[ced_medi];
				$profeci=$rowmedci[are_medi];
				echo"<tr>
				<td colspan=2>Yo, $nomb_, mayor de edad, identificado con $tipdo. No. $numced y como: Paciente_____, como Responsable___, "
				. "del o la paciente ______________ con C.C o TI No.__________________ Autorizo al Dr(a).  $nomciru, con Profesion o Especialidad, $profeci ,
					para la realizacion de los procedimiento";
					
				echo"<tr><th>Procedimiento</th><th>Descripcion</th></tr>";	
					
				if(file_exists($archivoquiroexps))
				{
					$fp = fopen ($archivoquiroexps, "r" );
					$reg=0;
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
						}
						$$campo[1]=$campo[2];
						
						if($reg % 8 == 0)
						{	
							$cont=substr($campo[1], -3);	
							$listo = ${'soliunidprodos'.$cont};
							if ($listo==$regbuscador1)
							{
								$controtabla++;
								$nomvariable=${'codmedi'.$cont};
								$trenomcup=${'nomprocedi'.$cont};
								$nomvarhm='consisteultimo'.$nomvariable;
								${'consisteultimo'.$nomvariable}=${'consiste'.$cont};		
								echo"<tr><td>$trenomcup</td><td><textarea name='$nomvarhm' cols=40 rows=2>${'consisteultimo'.$nomvariable}</textarea></td></tr>";
							}
						}	
					}			
				}
				
				echo"<tr><td>$nomcup</td><td><textarea name='Nuevoconsiste' cols=40 rows=2></textarea></td></tr>";
				
				echo"
				<tr><td colspan=2>Teniendo en cuenta que he sido informado claramente sobre los riesgos y beneficios que se pueden presentar, siendo estos:</td></tr>";
				echo"<tr><th colspan=2>Riesgos</th>";
				if(file_exists($archivoquiroexps))
				{
					$fp = fopen ($archivoquiroexps, "r" );
					$reg=0;
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
						}
						$$campo[1]=$campo[2];
						
						if($reg % 8 == 0)
						{	
							$cont=substr($campo[1], -3);	
							$listo = ${'soliunidprodos'.$cont};
							if ($listo==$regbuscador1)
							{
								$controtabla++;
								$nomvariable=${'codmedi'.$cont};
								$trenomcup=${'nomprocedi'.$cont};
								$nomvarhm='riesgoultimo'.$nomvariable;
								${'riesgoultimo'.$nomvariable}=${'riesgo'.$cont};		
								echo"<tr><td>$trenomcup</td><td><textarea name='$nomvarhm' cols=40 rows=2>${'riesgoultimo'.$nomvariable}</textarea></td></tr>";
							}
						}	
					}			
				}
				
				echo"<tr><td>$nomcup</td><td><textarea name='Nuevoriesgo' cols=40 rows=2></textarea></td></tr>";
				
				echo"<tr><th colspan=2>Beneficios</th></tr>";
				
				
				if(file_exists($archivoquiroexps))
				{
					$fp = fopen ($archivoquiroexps, "r" );
					$reg=0;
					while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
					{ 
						$reg++;
						$i = 0;
						foreach($data as $dato)
						{
							$campo[$i]=$dato;
							$i++ ;
						}
						$$campo[1]=$campo[2];
						
						if($reg % 8 == 0)
						{	
							$cont=substr($campo[1], -3);	
							$listo = ${'soliunidprodos'.$cont};
							if ($listo==$regbuscador1)
							{
								$controtabla++;
								$nomvariable=${'codmedi'.$cont};
								$trenomcup=${'nomprocedi'.$cont};
								$nomvarhm='beneficiosultimo'.$nomvariable;
								${'beneficiosultimo'.$nomvariable}=${'beneficios'.$cont};		
								echo"<tr><td>$trenomcup</td><td><textarea name='$nomvarhm' cols=40 rows=2>${'beneficiosultimo'.$nomvariable}</textarea></td></tr>";
							}
						}	
					}			
				}
				
				echo"<tr><td>$nomcup</td><td><textarea name='Nuevobeneficio' cols=40 rows=2></textarea></td></tr>";
				
				echo"<tr><td colspan=2>Comprendo y acepto que durante el procedimiento pueden aparecer circustancias imprevisibles o inesperadas que puedan requerir una
					extension del procedimiento original o la realizacion de otro procedimiento no mencionado arriba.</td></tr>";
				echo"<tr><td colspan=2>Al firmar este documento reconozco que los he leido y explicado y que comprendo perfectamente su contenido.Se me han dado amplias
					oportunidades de formular preguntas y que todas las preguntas que he formulado han sido respondidas o explicadas en forma satisfactoria";
				echo"<tr><td colspan=2>Acepto que la medicina no es una ciencia exacta y que no se me han garantizado los resultados que se esperaban de la intervesion
					quirurgica o procedimientos diagnosticados o terapeuticos, en el sentido de que la practica de la intervencion o procedimiento que requiero compromete
					una actividad de medio, pero no de resultados.<br>
					Comprendiendo estas limitaciones, doy mi consentimiento de manera libre y voluntaria para la realizacion del procedimiento y firmo a Continuacion";
				echo"</tr>";
				echo"<tr><td>Firma paciente:______________________________</td>
				<td>Firma Testigo:______________________________</td></tr>";
				echo"<tr><td>$nomb_</td> <td>Nombre ___________________ </td></tr>";
				echo"<tr><td>$tipdo  $numced</td><td>Cedula__________________ Parentesco_______________</td></tr>";
				echo"<tr><td>Firma Medico:______________________________</td></tr>";
				echo"<tr><td>$nomciru - $profeci </td></tr>";
				echo"<tr><td>RM:$codciru - $profeci </td></tr>";
				echo"<tr><td>El paciente no puede firmar por:__________________________________________</td></tr>";
				
				echo"<input type=hidden name=regbuscador1 value='$regbuscador1'>";		
			}
		}
		echo"<input type=hidden name=solquiro value='$soli'>";		
		if($opci==3 && $soli=='N')
		{
			echo"<body onload=salir(3)>";	
		}
		else
		{		
			echo"<tr><th colspan=2 align=center valign=top height=20><INPUT type=button class='boton' value= 'GUARDAR' onClick='salir(2)'><INPUT type=button class='boton' value= 'CANCELAR' onClick='salir(1)'></th></tr>";
		}	
	}
	echo"<br><br>";	

?>

</BODY>
</HTML>
