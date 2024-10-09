
<meta http-equiv="Context-Type" content="text/html; charset=UTF-8">
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
			uno.action=uno.regresa.value;
			uno.submit();	
		}
		if(n==2)
		{
			if(uno.codiprg.value=='6')
			{
				
				val='0';				
				if(uno.diastrasoli.value==''){val='1';document.getElementById('n1').style.color='#ff0000';}else	{document.getElementById('n1').style.color='#000000';}				
				if(uno.dosissoli.value==''){val='1';document.getElementById('n2').style.color='#ff0000';}else	{document.getElementById('n2').style.color='#000000';}	
				if(uno.unidadpos.value==''){val='1';document.getElementById('n3').style.color='#ff0000';}else	{document.getElementById('n3').style.color='#000000';}	
				
				
				//if(uno.cproa.value==''){val='1';document.getElementById('n3').style.color='#ff0000';}else	{document.getElementById('n3').style.color='#000000';}	
				//if(uno.diastraequia.value==''){val='1';document.getElementById('n4').style.color='#ff0000';}else	{document.getElementById('n4').style.color='#000000';}	
				//if(uno.dosisequia.value==''){val='1';document.getElementById('n5').style.color='#ff0000';}else	{document.getElementById('n5').style.color='#000000';}	
				//if(uno.fecdesde.value==''){val='1';document.getElementById('n6').style.color='#ff0000';}else	{document.getElementById('n6').style.color='#000000';}		
				//if(uno.fechasta.value==''){val='1';document.getElementById('n7').style.color='#ff0000';}else	{document.getElementById('n7').style.color='#000000';}				
				//if(uno.tiempoesti.value==''){val='1';document.getElementById('n8').style.color='#ff0000';}else	{document.getElementById('n8').style.color='#000000';}	
				if(uno.biblio.value==''){val='1';document.getElementById('n11').style.color='#ff0000';}else	{document.getElementById('n11').style.color='#000000';}	
				
				opcion = document.getElementsByName("riesgo");
				 var validado='0';
				 for(var i=0; i<2; i++)
				 {
					 if(opcion[0].checked)
					 {
						 validado = '1';
					 }
					 if(opcion[1].checked)
					 {
						 validado = '1';
					 }					 
				 }				
				if(validado=='0'){val='1';document.getElementById('n10').style.color='#ff0000';}else	{document.getElementById('n10').style.color='#000000';}				
				if (val=='1'){alert("Hay campos obligatorios pendientes por diligenciar");return;}
			}
			if(uno.codiprg.value=='5')
			{
				if(uno.sipos.value==1)
				{
				
					val=0;
					if(uno.biblio.value==''){val='1';document.getElementById('n21').style.color='#ff0000';}else	{document.getElementById('n21').style.color='#000000';}	
					opcion = document.getElementsByName("riesgo");
					 var validado='0';
					 for(var i=0; i<2; i++)
					 {
						 if(opcion[0].checked)
						 {
							 validado = '1';
						 }
						 if(opcion[1].checked)
						 {
							 validado = '1';
						 }					 
					 }				
					if(validado=='0'){val='1';document.getElementById('n22').style.color='#ff0000';}else{document.getElementById('n22').style.color='#000000';}				
					if (val=='1'){alert("Hay campos obligatorios pendientes por diligenciar");return;}
				}
				//alert(uno.pideuni.value);
								
/*				
				if(uno.siquiro.value==21)
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
					
					
					if(ople[0].checked)
					{
					
					
						val=0;
						opcion = document.getElementsByName("cirugia");
						var validado='0';
						for(var i=0; i<2; i++)
						{
                                                    if(opcion[i].checked)validado = '1';
                                                   
						}
                                                
                                               
						if(validado=='0'){val='1';document.getElementById('q1').style.color='#ff0000';}else{document.getElementById('q1').style.color='#000000';}				
						
						
						opcion = document.getElementsByName("anestesia");
						var validado='0';
						f=uno.finana.value;
						for(var i=0; i<f; i++)
						{
							if(opcion[i].checked)validado = '1';							 
						}				
						if(validado=='0'){val='1';document.getElementById('q2').style.color='#ff0000';}else{document.getElementById('q2').style.color='#000000';}				
						
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
						
						if(uno.sangre.value=='') {val='1';document.getElementById('q6').style.color='#ff0000';}else{document.getElementById('q6').style.color='#000000';}	
						
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
																							
						if(validado==2 && uno.material.value==''){val='1';document.getElementById('q11').style.color='#ff0000';}else{document.getElementById('q11').style.color='#000000';}																	
						if (val=='1'){alert("Hay campos obligatorios pendientes por diligenciar");return;}
					}
				}
*/				
				
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
	
//vich
	
	function aparece()
	{
		ople = document.getElementsByName("pideuni");
		var vali='0';
		for(var i=0; i<2; i++)
		{
			if(ople[i].checked)vali = '1';							 
		}		
		if(vali=='0')
		{
			alert("Seleccione la opcion REQUIERE UNIDAD QUIRURGICA")
			return;
		}
		if(ople[1].checked)
		{
			uno.soliunidpro.disabled=true;
		}
		else
		{
			uno.soliunidpro.disabled=false;
		}
	}
	
	function aparece1()
	{
		uno.target='area';
		uno.action='almacena.php';			
		uno.submit();	
	}
	
	function aparece2()
	{
		ople = document.getElementsByName("pideuni");
		var vali='0';
		for(var i=0; i<2; i++)
		{
			if(ople[i].checked)vali = '1';							 
		}		
		if(vali=='0')
		{
			alert("Seleccione la opcion REQUIERE UNIDAD QUIRURGICA")
			return;
		}
		if(ople[1].checked)
		{
			uno.target='area';
			uno.action='almacena.php';				
			uno.submit();
		}
		else
		{
			uno.target='area';
			uno.action='formujusti_captura1.php';			
			uno.submit();	
		}
	}
	
	function prorelaciona(mp)
	{
		alert(mp);
		uno.sachaitem.value=mp;			
		uno.target='area';
		uno.action='formujusti_captura1.php';			
		uno.submit();
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
	
	$consultamag="SELECT REGMAG_CON FROM contrato WHERE CODI_CON='$Gcontratonh'";
	$consultamag=mysql_query($consultamag);
	$rowmag=mysql_fetch_array($consultamag);
	$regmag_con=$rowmag[REGMAG_CON];

	
	
	echo"<form name=uno method=post>
	<input type=hidden name=codiprg value='$codiprg'>
	<input type=hidden name=guardapos value='0'>";
	$buscc=mysql_query("select * from medicos where cod_medi='$Gcod_mediconh'");
	$resulcc=0;
	while($rcc=mysql_fetch_array($buscc))
	{		
		if($rcc['tido_medi']==NULL || $rcc['tido_medi']=='')$resulcc=1;
	}
	
	if($codiprg==6)
	{
		echo"
		<input type=hidden name=clasemedi value='$clasemedi'>
		<input type=hidden name=codmedi value='$codmedi'>
		<input type=hidden name=desmedi value='$desmedi'>
		<input type=hidden name=dosis value='$dosis'>
		<input type=hidden name=unid value='$unid'>
		<input type=hidden name=frecu value='$frecu'>
		<input type=hidden name=unidfrecu value='$unidfrecu'>
		<input type=hidden name=via value='$via'>
		<input type=hidden name=tiempo value='$tiempo'>
		<input type=hidden name=obsemed value='$obsemed'>
		<input type=hidden name=canti value='$canti'>
		<input type=hidden name=diagmedi value='$diagmedi'>
		<input type=hidden name=justifi value='$justifi'>
		<input type=hidden name=pos value='$pos'>
		<input type=hidden name=regresa value='medica0.php'>
		";
		
		$busjus=mysql_query("SELECT form_nop.codi_usu, form_nop.cmed_nop, form_nop.fech_pos, form_nop.tiem_nop
		FROM form_nop WHERE ((form_nop.codi_usu='$paciente') AND (form_nop.cmed_nop='$codmedi') AND (tinp_nop='M' or tinp_nop='I'))
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
			if($regmag_con=='S')
			{
				$entra=0;
			}
			else
			{
				if($pos!='N')
				{
					$entra=0;
				}			
			}		
		}
		$entra=0;
		if($entra==1)
		{
			$nomprodu='';
			$med=mysql_query("SELECT medicamentos2.codi_mdi, medicamentos2.nomb_mdi, forma_farmaceutica.desc_ffa, medicamentos2.noco_mdi,medicamentos2.ncsi_medi
			FROM medicamentos2 INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa
			WHERE (((medicamentos2.codi_mdi)='$codmedi'))");
			while($rnm=mysql_fetch_array($med))
			{
				$codsiigo=$rnm['ncsi_medi'];
				$nomprodu=$rnm['nomb_mdi'];
				$formafar=$rnm['desc_ffa'];
				$comcomer=$rnm['noco_mdi'];	
				echo"<input type=hidden name=tiponopos value='M'>";
			}
			if($nomprodu=='')
			{
				$dis=mysql_query("SELECT insu_med.codi_ins, insu_med.codnue, insu_med.desc_ins
				FROM insu_med
				WHERE (((insu_med.codi_ins)='$codmedi'))");
				while($rnd=mysql_fetch_array($dis))
				{
					$codsiigo=$rnd['codnue'];
					$nomprodu=$rnd['desc_ins'];		
				}
				echo"<input type=hidden name=tiponopos value='D'>";
			}			
			echo"
			<table class='tbl' align=center>
			<tr>
			<th><b>FORMATO DE JUSTIFICACION MEDICAMENTOS E INSUMOS</td> 		
			</tr>
			</table><br>
			<table class='tbl' align=center  width=50%>
			<tr>
			<th><b>$nomprodu $formafar</td> 		
			</tr>
			<tr>
			<th><b>INFORMACION DEL MEDICAMENTO O INSUMO SOLICITADO</td> 		
			</tr>		
			<tr>
			<td>
			<table class='tbl' align=center width=100%>
			<tr>
			<td id='n1' align=center>Dias de tratamiento</td><td  align=center><input type=text  name=diastrasoli class='caja' size='1' maxlength=3 onKeypress='if (event.keyCode > 47 && event.keyCode <58 ) event.returnValue = true;else event.returnValue = false'></td>
			<td id='n2' align=center>Dosis por d&iacutea</td><td align=center><input type=text name=dosissoli class='caja'></td>
			<td id='n3' align=center>Unidad</td><td align=center>
			<select class='caja' name=unidadpos onChange='cambiauni()'>
			<option value=''></option>
			<option value='UND'>UND</option>
			<option value='CC'>CC</option>
			<option value='GOTAS'>GOTAS</option>
			<option value='GR'>GR</option>
			<option value='MG'>MG</option>
			<option value='MCG'>MCG</option>
			<option value='UI'>UI</option>
			<option value='PUFF'>PUFF</option>			
			<option value='SOBRES'>SOBRES</option>
			</select>
			</tr>
			</table>
			</td>
			<tr>			
			<th><b>INFORMACION DEL MEDICAMENTO O INSUMO EQUIVALENTE EN EL POS</td> 		
			</tr>				
			<tr>
			<td>
			<table class='tbl' align=center  width=100%>
			<tr>		
			<td align=center>Principio activo del medicamento nombre gen&eacuterico insumo </td><td id='n4' align=center>D&iacuteas de tratamiento</td><td id='n5' align=center>Dosis por d&iacutea</td>
			</tr>
			<td align=center><textarea id='nompro1' class='caja' name=cproa cols=60 rows=2></textarea></td>
			<td align=center><input type=text name=diastraequia maxlength=3 class='caja' size=2 onKeypress='if (event.keyCode > 47 && event.keyCode <58 ) event.returnValue = true;else event.returnValue = false'></td>
			<td align=center><input type=text class='caja' name=dosisequia></td>			
			</tr>
			</tr>
			<td align=center><textarea id='nompro2' class='caja' name=cprob cols=60 rows=2></textarea></td>
			<td align=center><input type=text class='caja' name=diastraequib  maxlength=3 size=2 onKeypress='if (event.keyCode > 47 && event.keyCode <58 ) event.returnValue = true;else event.returnValue = false'></td>
			<td align=center><input type=text class='caja' name=dosisequib></td>			
			</tr>			
			</table>
			</td>
			</tr>
			<tr>
			<th><b>DIAGNOSTICO, EVOLUCION, CLASIFICACION Y ESTADO DE LA PATOLOGIA</td> 		
			</tr>	
			<tr>
			<td>
			<table class='tbl' align=center  width=100%>		
			<tr>
			
			<td id='n9' align=center>Resumen de la historia clinica (analisis)</td><td align=center>$analpv</td>
			</tr>
			<tr>
			<td id='n10' colspan=2  align=center>La NO utilizacion pone en riesgo inminente la vida y salud del paciente <font color='FFFFFF'>----------</font>
			SI <input type=radio value='S' name=riesgo>
			NO <input type=radio value='S' name=riesgo></td>
			
			
			</tr>
			<tr>
			<td id='n11' align=center>Justificaci&oacuten del Medicamento, Procedimiento &oacute Insumo NO POS solicitado</td><td align=center> <textarea name=biblio class='caja' cols=80 rows=4></textarea></td>
			</tr>
			</table>
			</td>
			</tr>
			
			";
			if($resulcc==1)
			{
				echo"				
				<tr>				
				<th><b>INFORMACION COMPLEMENTARIO DEL MEDICO</th> 		
				</tr>		
				<tr>
				<td>
				<table class='tbl' align=center  width=100%>
				<td  align=center>Tipo documento de identidad</td><td align=center>
				<select class=caja name=tipodoc>
				<option value=''></option>
				<option value='CC'>C&eacutedula de ciudadan&iacutea</option>
				<option value='CE'>C&eacutedula de extranger&iacutea</option>		
				</select></td>
				</tr>
				</td>
				</table>
				";
			}
			
			echo"<tr><th align=center valign=top height=20><INPUT type=button class='boton' value= 'Guardar' onClick='salir(2)'><INPUT type=button class='boton' value= 'Cancelar' onClick='salir(1)'></th></tr>";
			echo"</table>";			
		}
		else
		{
			
			echo"<body onload=salir(3)>";				
		}		
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
		if($entra==1)
		{
			$bdia=mysql_query("select * from cie_10 where cod_cie10='$diagorden'");
			$rdia=mysql_fetch_array($bdia);
			$descie=$rdia['nom_cie10'];
			echo"<input type=hidden name=tiponopos value='P'>";
			echo"
			<table class='tbl' align=center border=1>
			<tr>
			<th><b>FORMATO DE JUSTIFICACION PROCEDIMIENTOS</td> 		
			</tr>
			</table><br>
			<table class='tbl' align=center>
			<tr>
			<th colspan=2><b>$desorden </td> 		
			</tr>
			<tr>
			<th colspan=2><b>INFORMACION DEL PROCEDIMIENTO SOLICITADO</td> 		
			</tr>	
			<tr>
			<td>Diagn&oacutestico</td><td>$diagorden - $descie</td>
			</tr>
			<tr>";
			echo"<td id='n9'>Resumen de la historia clinica (analisis)</td><td>$analpv</td>";
			echo"</tr>
			<tr>
			<td id='n22' colspan=2>La NO utilizacion pone en riesgo inminente la vida y salud del paciente <font color='FFFFFF'>----------</font>
			SI <input type=radio value='S' name=riesgo>
			NO <input type=radio value='S' name=riesgo></td></td>
			</tr>
			<tr>
			<td id='n21' align=center>Justificaci&oacuten del Medicamento, Procedimiento &oacute Insumo NO POS solicitado:</td><td align=center> <textarea name=biblio class='caja' cols=80 rows=4></textarea></td>
			</tr>
			";
			if($resulcc==1)
			{
				echo"				
				<tr>
				<th colspan=2><b>INFORMACION COMPLEMENTARIO DEL MEDICO</th> 		
				</tr>		
				<tr>
				<td>Tipo documento de identidad</td><td>
				<select class='caja' name=tipodoc>
				<option value=''></option>
				<option value='CC'>C&eacutedula de ciudadan&iacutea</option>
				<option value='CE'>C&eacutedula de extranger&iacutea</option>		
				</select></td>
				</tr>";
			}
			$opci=2;
			echo"</table>";
		}
		else
		{			
			$opci=3;
		}
		$bustip=mysql_query("SELECT prmt_cup FROM cups where codigo='$codorden'");
		while($rtip=mysql_fetch_array($bustip))
		{
			$prmt_cup=$rtip['prmt_cup'];		
		}		
		$soli='N';
		echo"<input type=hidden name=sipos value=$entra>";
		echo"<input type=hidden name=siquiro value=$prmt_cup>";
		
		
		/*
		if($prmt_cup==21)
		{			
			$nuevocontrol=1;
			echo"
			<br><br>
			<table class='tbl' align=center>
			<tr>
			<th colspan=2><b>SOLICITUD DE UNIDAD QUIRURGICA</td> 		
			</tr>
			<tr>
			<th colspan=2><b>REQUIERE UNIDAD QUIRURGICA SI <input name=pideuni type=radio value='S' onClick='aparece()'> NO <input name=pideuni type=radio value='N' onClick='aparece()'></td> 		
			</tr>
			<table align=center class='tbl' width=80%>
			<br>";		
			$archivo57='tmp/CIRUGENERAL'.$numcita.'-'.$paciente.'.txt';
			if(file_exists($archivo57))
			{
				echo"<tr>
				<th align=center>ESTE PROCEDIMIENTO SE REALIZARA CONJUNTAMENTE CON</th>
				<td align=center>
				<select class='caja' name='soliunidpro' disabled>
				<option value=0>Ninguno</option>";
				//vich				
				$fp = fopen ($archivo57, "r" );
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
					if($reg % 3 == 0)
					{
						
						echo"<option value='$varserie57'>$desordengensan57</option>";
						$cont=$cont+1;
					}				
				}
				echo"</select>
				</td>
				</TABLE>
				<input type=hidden name=sachaitem>";
			}
			echo"
			<br>
			<table class='tbl' align=center>
			<tr><th colspan=2 align=center valign=top height=20><INPUT type=button class='boton' value= 'CONTINUAR' onClick='aparece2()'> <INPUT type=button class='boton' value= 'CANCELAR' onClick='aparece1()'></th></tr>";
			ECHO"</TABLE>";
			
			$soli='S';
				
		}
		*/
		
		
		if($nuevocontrol==0)
		{		
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
	}
	echo"<br><br>";	
?>

</BODY>
</HTML>
<html><head></head><body></body></html>