<?
	session_start();
	session_register('paciente');
	session_register('datos');
	session_register('tiespe');
	session_register('concontrol');
	session_register('numcita');
	/*
	if(empty($paciente))
	{
		echo"<br><br><table align=center class='tbl'>
		<tr><th>POR SEGURIDAD SU SESI�N SE CERR�. EIERRE E INGRESE NUEVAMENTE AL PROGRAMA</th></tr>
		</table>";
		exit;
	}
	*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready(function() {	
	$("#course").autocomplete("autocomp2.php", {
		width: 260,
		minChars: 3,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220	
	});	
	$("#course").result(function(event, data, formatted) {
		$("#course_val").val(data[1]);
	});
});
$().ready(function() {
	
	$("#course1").autocomplete("autocomp2.php", {
		width: 260,
		minChars: 3,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220	
	});	
	$("#course1").result(function(event, data, formatted) {
		$("#course_val1").val(data[1]);
	});
});
$().ready(function() {
	$("#course2").autocomplete("autocomp2.php", {
		width: 260,
		minChars: 3,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220	
	});	
	$("#course2").result(function(event, data, formatted) {
		$("#course_val2").val(data[1]);
	});
});
$().ready(function() {
	$("#course3").autocomplete("autocomp2.php", {
		width: 260,
		minChars: 3,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220	
	});	
	$("#course3").result(function(event, data, formatted) {
		$("#course_val3").val(data[1]);
	});
});
</script>
<script language="JavaScript">
	function valida()
	{
		opcion1 = document.getElementsByName("apgar1");
		var anu1=0;
		for(var i=0; i<5; i++)
		{			
			if(opcion1[i].checked)
			{				
				var anu1=1;
			}
		}
		if(anu1==0)
		{
			alert("Elija una opcion del item 1 del APGAR familiar");
			return;
		}	
		opcion2 = document.getElementsByName("apgar2");
		var anu2=0;
		for(var i=0; i<5; i++)
		{			
			if(opcion2[i].checked)
			{				
				var anu2=1;
			}
		}
		if(anu2==0)
		{
			alert("Elija una opcion del item 2 del APGAR familiar");
			return;
		}	
		opcion3 = document.getElementsByName("apgar3");
		var anu3=0;
		for(var i=0; i<5; i++)
		{			
			if(opcion3[i].checked)
			{				
				var anu3=1;
			}
		}
		if(anu3==0)
		{
			alert("Elija una opcion del item 3 del APGAR familiar");
			return;
		}	
		opcion4 = document.getElementsByName("apgar4");
		var anu4=0;
		for(var i=0; i<5; i++)
		{			
			if(opcion4[i].checked)
			{				
				var anu4=1;
			}
		}
		if(anu4==0)
		{
			alert("Elija una opcion del item 4 del APGAR familiar");
			return;
		}		
		opcion5 = document.getElementsByName("apgar5");
		var anu5=0;
		for(var i=0; i<5; i++)
		{			
			if(opcion5[i].checked)
			{				
				var anu5=1;
			}
		}
		if(anu5==0)
		{
			alert("Elija una opcion del item 5 del APGAR familiar");
			return;
		}	
		opciones1 = document.getElementsByName("phq1");
		var anues1=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones1[i].checked)
			{				
				var anues1=1;
			}
		}
		if(anues1==0)
		{
			alert("Elija una opcion del item 1 del PHQ familiar");
			return;
		}
		opciones2 = document.getElementsByName("phq2");
		var anues2=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones2[i].checked)
			{				
				var anues2=1;
			}
		}
		if(anues2==0)
		{
			alert("Elija una opcion del item 2 del PHQ familiar");
			return;
		}
		opciones3 = document.getElementsByName("phq3");
		var anues3=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones3[i].checked)
			{				
				var anues3=1;
			}
		}
		if(anues3==0)
		{
			alert("Elija una opcion del item 3 del PHQ familiar");
			return;
		}
		opciones4 = document.getElementsByName("phq4");
		var anues4=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones4[i].checked)
			{				
				var anues4=1;
			}
		}
		if(anues4==0)
		{
			alert("Elija una opcion del item 4 del PHQ familiar");
			return;
		}
		opciones5 = document.getElementsByName("phq5");
		var anues5=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones5[i].checked)
			{				
				var anues5=1;
			}
		}
		if(anues5==0)
		{
			alert("Elija una opcion del item 5 del PHQ familiar");
			return;
		}
		opciones6 = document.getElementsByName("phq6");
		var anues6=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones6[i].checked)
			{				
				var anues6=1;
			}
		}
		if(anues6==0)
		{
			alert("Elija una opcion del item 6 del PHQ familiar");
			return;
		}
		
		opciones7 = document.getElementsByName("phq7");
		var anues7=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones7[i].checked)
			{				
				var anues7=1;
			}
		}
		if(anues7==0)
		{
			alert("Elija una opcion del item 7 del PHQ familiar");
			return;
		}
		opciones8 = document.getElementsByName("phq8");
		var anues8=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones8[i].checked)
			{				
				var anues8=1;
			}
		}
		if(anues8==0)
		{
			alert("Elija una opcion del item 8 del PHQ familiar");
			return;
		}
		opciones9 = document.getElementsByName("phq9");
		var anues9=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones9[i].checked)
			{				
				var anues9=1;
			}
		}
		if(anues9==0)
		{
			alert("Elija una opcion del item 9 del PHQ familiar");
			return;
		}
		
		uno.action='almacena.php';
		uno.target='';
		uno.submit();
	}

	function phqconsolidar()
	{
		opciones1 = document.getElementsByName("phq1");
		var otroacum1 = 0;
		var otroacum2 = 0;
		var otroacum3 = 0;
		var otroacum4 = 0;
		var otroacum5 = 0;
		var otroacum6 = 0;
		var otroacum7 = 0;
		var otroacum8 = 0;
		var otroacum9 = 0;
		var anues1=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones1[i].checked)
			{				
				var anues1=1;
				otroacum1=i;
			}
		}
		opciones2 = document.getElementsByName("phq2");
		var anues2=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones2[i].checked)
			{				
				var anues2=1;
				otroacum2=i;
			}
		}
		opciones3 = document.getElementsByName("phq3");
		var anues3=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones3[i].checked)
			{				
				var anues3=1;
				otroacum3=i;
			}
		}
		opciones4 = document.getElementsByName("phq4");
		var anues4=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones4[i].checked)
			{				
				var anues4=1;
				otroacum4=i;
			}
		}
		opciones5 = document.getElementsByName("phq5");
		var anues5=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones5[i].checked)
			{				
				var anues5=1;
				otroacum5=i;
			}
		}
		opciones6 = document.getElementsByName("phq6");
		var anues6=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones6[i].checked)
			{				
				var anues6=1;
				otroacum6=i;
			}
		}
		opciones7 = document.getElementsByName("phq7");
		var anues7=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones7[i].checked)
			{				
				var anues7=1;
				otroacum7=i;
			}
		}
		opciones8 = document.getElementsByName("phq8");
		var anues8=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones8[i].checked)
			{				
				var anues8=1;
				otroacum8=i;
			}
		}
		opciones9 = document.getElementsByName("phq9");
		var anues9=0;
		for(var i=0; i<4; i++)
		{			
			if(opciones9[i].checked)
			{				
				var anues9=1;
				otroacum9=i;
			}
		}
		var total2 = otroacum1+otroacum2+otroacum3+otroacum4+otroacum5+otroacum6+otroacum7+otroacum8+otroacum9;
		uno.httotal2.value = total2;
		if(total2 >= 0 && total2 <= 4)
		{
			uno.phqpunta.value = total2;
			uno.phqseve.value =  'Ninguna o mínima';
			uno.phqacci.value =  'Control en 1 año';
			uno.phqfrec.value =  '12';
		}
		if(total2 >= 5 && total2 <= 9)
		{
			uno.phqpunta.value = total2;
			uno.phqseve.value =  'Leve';
			uno.phqacci.value =  'Seguimiento repita PHQ-9 en tres (3) meses )';
			uno.phqfrec.value =  '3';
		}
		if(total2 >= 10 && total2 <= 14)
		{
			uno.phqpunta.value = total2;
			uno.phqseve.value =  'Moderada';
			uno.phqacci.value =  'Consejeria y/o farmacoterapia, seguimiento en un (1) mes';
			uno.phqfrec.value =  '1';
		}
		if(total2 >= 15 && total2 <= 19)
		{
			uno.phqpunta.value = total2;
			uno.phqseve.value =  'Moderadamente severa';
			uno.phqacci.value =  'Tratamiento actuvo con farmacoterapia y/o Psicoterapia, solicita intervención en medicina familiar (Control en 12 meses)';
			uno.phqfrec.value =  '12';
		}
		if(total2 >= 20 && total2 <= 27)
		{
			uno.phqpunta.value = total2;
			uno.phqseve.value =  'Severa';
			uno.phqacci.value =  'Inicio inmediato de farmacoterapia y valoración por psiquiatría, solicite intervención en medicina familiar (Control en 12 meses)';
			uno.phqfrec.value =  '12';
		}
	}
	
	function consolidar()
	{
		var acumula1 = 0;
		var acumula2 = 0;
		var acumula3 = 0;
		var acumula4 = 0;
		var acumula5 = 0;
		
		var indica = 0;
		opcion1 = document.getElementsByName("apgar1");
		var anu1=0;
		for(var i=0; i<5; i++)
		{			
			if(opcion1[i].checked)
			{				
				var anu1=1;
				acumula1=i;
			}
		}
		opcion2 = document.getElementsByName("apgar2");
		var anu2=0;
		for(var i=0; i<5; i++)
		{			
			if(opcion2[i].checked)
			{				
				var anu2=1;
				acumula2=i;
			}
		}
		opcion3 = document.getElementsByName("apgar3");
		var anu3=0;
		for(var i=0; i<5; i++)
		{			
			if(opcion3[i].checked)
			{				
				var anu3=1;
				acumula3=i;				
			}
		}
		opcion4 = document.getElementsByName("apgar4");
		var anu4=0;
		for(var i=0; i<5; i++)
		{			
			if(opcion4[i].checked)
			{				
				var anu4=1;
				acumula4=i;
			}
		}
		opcion5 = document.getElementsByName("apgar5");
		var anu5=0;
		for(var i=0; i<5; i++)
		{			
			if(opcion5[i].checked)
			{				
				var anu5=1;
				acumula5=i;
			}
		}
		var total1 = acumula1+acumula2+acumula3+acumula4+acumula5;
		uno.httotal1.value = total1;
		if(total1 >= 0 && total1 <= 9)
		{
			uno.apgarpunta.value = total1;
			uno.apgarseve.value =  'Severa';
			uno.apgaracci.value =  'Solicite intervención en medicina familiar (control en 12 meses)';
			uno.apgarfrec.value =  '12';
		}
		if(total1 >= 10 && total1 <= 13)
		{
			uno.apgarpunta.value = total1;
			uno.apgarseve.value =  'Moderada';
			uno.apgaracci.value =  'Solicite apoyo psicológico (Control en 12 meses)';
			uno.apgarfrec.value =  '12';
		}
		if(total1 >= 14 && total1 <= 17)
		{
			uno.apgarpunta.value = total1;
			uno.apgarseve.value =  'Leve';
			uno.apgaracci.value =  'Brinde consejería, seguimiento. Repita APGAR en 3 meses';
			uno.apgarfrec.value =  '3';
		}
		if(total1 >= 18 && total1 <= 20)
		{
			uno.apgarpunta.value = total1;
			uno.apgarseve.value =  'Ninguna o mínima';
			uno.apgaracci.value =  'Control en un año';
			uno.apgarfrec.value =  '12';
		}
	}

	function salto(n)
	{
		if (event.keyCode == 13)
        {			
			uno.opcup.value=n;			
			uno.codd.value=uno.cod.value;			
			uno.codd1.value=uno.cod1.value;			
			uno.codd2.value=uno.cod2.value;			
			uno.codd3.value=uno.cod3.value;
			uno.action='diagnos0.php';
			uno.target='';			
			uno.submit();		
		}
	}
	
</script>
</head>	
<body>
<?php
$datos[0]='nom_cie10';
$datos[1]='cod_cie10';
$datos[2]='cie_10';
	$archivo='tmp/12HC'.$numcita.'-'.$paciente.'.txt';	
	if(file_exists($archivo))
	{
		$fp = fopen ($archivo, "r" );
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
	$sr1='';$sr2='';$sr3='';$sr4='';$sr5='';
	if($apgar1==1)$sr1="checked";
	if($apgar1==2)$sr2="checked";
	if($apgar1==3)$sr3="checked";
	if($apgar1==4)$sr4="checked";
	if($apgar1==5)$sr5="checked";
	$pr1='';$pr2='';$pr3='';$pr4='';$pr5='';
	if($apgar2==1)$pr1="checked";
	if($apgar2==2)$pr2="checked";
	if($apgar2==3)$pr3="checked";
	if($apgar2==4)$pr4="checked";
	if($apgar2==5)$pr5="checked";
	$ar1='';$ar2='';$ar3='';$ar4='';$ar5='';
	if($apgar3==1)$ar1="checked";
	if($apgar3==2)$ar2="checked";
	if($apgar3==3)$ar3="checked";
	if($apgar3==4)$ar4="checked";
	if($apgar3==5)$ar5="checked";
	$br1='';$br2='';$br3='';$br4='';$br5='';
	if($apgar4==1)$br1="checked";
	if($apgar4==2)$br2="checked";
	if($apgar4==3)$br3="checked";
	if($apgar4==4)$br4="checked";
	if($apgar4==5)$br5="checked";
	$cr1='';$cr2='';$cr3='';$cr4='';$cr5='';
	if($apgar5==1)$cr1="checked";
	if($apgar5==2)$cr2="checked";
	if($apgar5==3)$cr3="checked";
	if($apgar5==4)$cr4="checked";
	if($apgar5==5)$cr5="checked";
	$aph1='';$aph2='';$aph3='';$aph4='';
	if($phq1==1)$aph1="checked";
	if($phq1==2)$aph2="checked";
	if($phq1==3)$aph3="checked";
	if($phq1==4)$aph4="checked";
	$bph1='';$bph2='';$bph3='';$bph4='';
	if($phq2==1)$bph1="checked";
	if($phq2==2)$bph2="checked";
	if($phq2==3)$bph3="checked";
	if($phq2==4)$bph4="checked";
	$cph1='';$cph2='';$cph3='';$cph4='';
	if($phq3==1)$cph1="checked";
	if($phq3==2)$cph2="checked";
	if($phq3==3)$cph3="checked";
	if($phq3==4)$cph4="checked";
	$dph1='';$dph2='';$dph3='';$dph4='';
	if($phq4==1)$dph1="checked";
	if($phq4==2)$dph2="checked";
	if($phq4==3)$dph3="checked";
	if($phq4==4)$dph4="checked";
	$eph1='';$eph2='';$eph3='';$eph4='';
	if($phq5==1)$eph1="checked";
	if($phq5==2)$eph2="checked";
	if($phq5==3)$eph3="checked";
	if($phq5==4)$eph4="checked";
	$fph1='';$fph2='';$fph3='';$fph4='';
	if($phq6==1)$fph1="checked";
	if($phq6==2)$fph2="checked";
	if($phq6==3)$fph3="checked";
	if($phq6==4)$fph4="checked";
	$gph1='';$gph2='';$gph3='';$gph4='';
	if($phq7==1)$gph1="checked";
	if($phq7==2)$gph2="checked";
	if($phq7==3)$gph3="checked";
	if($phq7==4)$gph4="checked";
	$hph1='';$hph2='';$hph3='';$hph4='';
	if($phq8==1)$hph1="checked";
	if($phq8==2)$hph2="checked";
	if($phq8==3)$hph3="checked";
	if($phq8==4)$hph4="checked";
	$iph1='';$iph2='';$iph3='';$iph4='';
	if($phq9==1)$iph1="checked";
	if($phq9==2)$iph2="checked";
	if($phq9==3)$iph3="checked";
	if($phq9==4)$iph4="checked";

	if($opcup!='')
	{		
		if($opcup==0)$cod=$codd;
		if($opcup==1)$cod1=$codd1;
		if($opcup==2)$cod2=$codd2;
		if($opcup==3)$cod3=$codd3;
	}
	include ('php/conexion1.php');
	/*
	$bconti=mysql_query("select * from destipos where codt_des='13' order by codi_des");
	$bcausa=mysql_query("select * from destipos where codt_des='12' Order By codi_des");
	$bfinal=mysql_query("select * from destipos where codt_des='11' Order By codi_des");	
	*/
	echo"
	<form name=uno method=post>
	<input type=hidden name=codiprg value=12>";
/*
	<input type=hidden name=tiespe value='$tiespe'>
	<input type=hidden name=codd>
	<input type=hidden name=codd1>
	<input type=hidden name=codd2>
	<input type=hidden name=codd3>
	<input type=hidden name=opcup>
*/
	
	echo"
	
	<br>
	<table align=center width=80%  border=1>
	<tr><td>
	<table align=center class='tbl' border=1 width=100%>	
	<tr><th colspan='7'>APAGAR FAMILIAR Y SOPORTE DE AMIGOS</th>
	<td rowspan=17></td><th colspan='7'>CUESTIONARIO SOBRE LA SALUD DEL PACIENTE (PHQ-9)</th></tr>
	<tr>
	<td colspan='2' rowspan='2' border=1>Para cada pregunta seleciona una opción que parezca aplicar para Usted</td>
	<td align=center>Nunca</td>
	<td align=center>Casi Nunca</td>
	<td align=center>Algunas Veces</td>
	<td align=center>Casi Siempre</td>
	<td align=center>Siempre</td>
	<td colspan='2' rowspan='2' border=1>Durante las dos (2) ultimas semanas ¿Con que frecuencias ha sentido molestias por los siguientes problemas? seleccione su respuesta:</td>
	<td align=center>Nunca</td>
	<td align=center>Varios Días</td>
	<td align=center>Mas de la mitad de los días</td>
	<td align=center>Casi todos los días</td>
	</tr>
	<tr>
	<td align=center>0</td>
	<td align=center>1</td>
	<td align=center>2</td>
	<td align=center>3</td>
	<td align=center>4</td>
	<td align=center>0</td>
	<td align=center>1</td>
	<td align=center>2</td>
	<td align=center>3</td>
	</tr>
	<tr>
	<td>1</td>
	<td>Me satisface la ayuda que recibo de mi familia cuando tengo algún problema y/o necesidad?</td>
	<td><p align=center><input type=radio $sr1 name=apgar1 value=1 onClick='consolidar()'></p></td>
	<td><p align=center><input type=radio $sr2 name=apgar1 value=2 onClick='consolidar()'></p></td>
	<td><p align=center><input type=radio $sr3 name=apgar1 value=3 onClick='consolidar()'></p></td>
	<td><p align=center><input type=radio $sr4 name=apgar1 value=4 onClick='consolidar()'></p></td>
	<td><p align=center><input type=radio $sr5 name=apgar1 value=5 onClick='consolidar()'></p></td>
	<td>1</td>
	<td>Sentir poco placer o interés por hacer las cosas</td>
	<td><p align='center'><input type=radio $aph1 name=phq1 value=1 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $aph2 name=phq1 value=2 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $aph3 name=phq1 value=3 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $aph4 name=phq1 value=4 onClick='phqconsolidar()'></p></td>
	</tr>
	<tr>
	<td>2</td>
	<td>Me satisface como en mi familia hablamos y compartimos nuestros problemas?</td>
	<td><p align='center'><input type=radio $pr1 name=apgar2 value=1 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $pr2 name=apgar2 value=2 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $pr3 name=apgar2 value=3 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $pr4 name=apgar2 value=4 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $pr5 name=apgar2 value=5 onClick='consolidar()'></p></td>
	<td>2</td>
	<td>Sentirse desanimado(a), deprimido(a), o sin esperanza</td>
	<td><p align='center'><input type=radio $bph1 name=phq2 value=1 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $bph2 name=phq2 value=2 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $bph3 name=phq2 value=3 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $bph4 name=phq2 value=4 onClick='phqconsolidar()'></p></td>
	</tr>
	<tr>
	<td>3</td>
	<td>Me satisface como mi familia acepta y apoya mis ideas de comprender nuevas actividades?</td>
	<td><p align='center'><input type=radio $ar1 name=apgar3 value=1 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $ar2 name=apgar3 value=2 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $ar3 name=apgar3 value=3 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $ar4 name=apgar3 value=4 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $ar5 name=apgar3 value=5 onClick='consolidar()'></p></td>
	<td>3</td>
	<td>Presentar dificultad para dormir o dormir demasiado</td>
	<td><p align='center'><input type=radio $cph1 name=phq3 value=1 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $cph2 name=phq3 value=2 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $cph3 name=phq3 value=3 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $cph4 name=phq3 value=4 onClick='phqconsolidar()'></p></td>
	</tr>
	<tr>
	<td>4</td>
	<td>Me satisface como mi familia expresa afecto y responde a mis emociones tales como rabia, trisiteza, amor?</td>
	<td><p align='center'><input type=radio $br1 name=apgar4 value=1 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $br2 name=apgar4 value=2 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $br3 name=apgar4 value=3 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $br4 name=apgar4 value=4 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $br5 name=apgar4 value=5 onClick='consolidar()'></p></td>
	<td>4</td>
	<td>Sentirse cansado(a) o con poca energía</td>
	<td><p align='center'><input type=radio $dph1 name=phq4 value=1 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $dph2 name=phq4 value=2 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $dph3 name=phq4 value=3 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $dph4 name=phq4 value=4 onClick='phqconsolidar()'></p></td>
	</tr>
	<tr>
	<td>5</td>
	<td>Me satisface como compartimos en mi familia el tiempo para estar juntos, los espacios en la casa y el dinero?</td>
	<td><p align='center'><input type=radio $cr1 name=apgar5 value=1 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $cr2 name=apgar5 value=2 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $cr3 name=apgar5 value=3 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $cr4 name=apgar5 value=4 onClick='consolidar()'></p></td>
	<td><p align='center'><input type=radio $cr5 name=apgar5 value=5 onClick='consolidar()'></p></td>
	<td>5</td>
	<td>Sentir poco apetito o comer en exceso</td>
	<td><p align='center'><input type=radio $eph1 name=phq5 value=1 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $eph2 name=phq5 value=2 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $eph3 name=phq5 value=3 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $eph4 name=phq5 value=4 onClick='phqconsolidar()'></p></td>
	</tr>
	<tr>
	<td colspan=7>Puntaje: <input type=text readonly name=httotal1 value=$httotal1></td>
	<td>6</td>
	<td>Sentirse mal hacerca de si mismo(a) o tener un sentimiento de fracaso o abandono propio o de la familia </td>
	<td><p align='center'><input type=radio $fph1 name=phq6 value=1 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $fph2 name=phq6 value=2 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $fph3 name=phq6 value=3 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $fph4 name=phq6 value=4 onClick='phqconsolidar()'></p></td>
	</tr>
	<tr>
	<td align=center>Puntaje apgar</td>
	<td align=center>Severidad de la difución familiar</td>
	<td colspan='4' align=center>Acciones propuestas de tratamiento</td>
	<td align=center>Frecuencia en meses</td>	
	<td>7</td>
	<td>Dificultas para concentrarse en diferentes actividades tales como leer el periódico o la televisión</td>
	<td><p align='center'><input type=radio $gph1 name=phq7 value=1 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $gph2 name=phq7 value=2 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $gph3 name=phq7 value=3 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $gph4 name=phq7 value=4 onClick='phqconsolidar()'></p></td>
	</tr>
	<tr>
	<td><input type=text readonly size=3 name=apgarpunta value=$apgarpunta></td>
	<td><input type=text readonly size=32 name=apgarseve value=$apgarseve></td>
	<td colspan='4'><textarea readonly name=apgaracci cols=25 rows=4 event.returnValue = true;else event.returnValue = false>$apgaracci</textarea></td>
	<td><input type=text readonly size=9 name=apgarfrec value=$apgarfrec></td>	
	<td>8</td>
	<td>Moverse o hablar tan despacio que otras personas lo han notado, o por lo contrario, estar muy inquieto(a) que se mueve mas de lo normal</td>
	<td><p align='center'><input type=radio $hph1 name=phq8 value=1 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $hph2 name=phq8 value=2 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $hph3 name=phq8 value=3 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $hph4 name=phq8 value=4 onClick='phqconsolidar()'></p></td>
	</tr>
	<tr>
	<td colspan=7 rowspan=4></td>
	<td>9</td>
	<td>Pensamientos acerca de que sería mejor estar muerto(a) o de lastimarse de alguna forma</td>
	<td><p align='center'><input type=radio $iph1 name=phq9 value=1 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $iph2 name=phq9 value=2 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $iph3 name=phq9 value=3 onClick='phqconsolidar()'></p></td>
	<td><p align='center'><input type=radio $iph4 name=phq9 value=4 onClick='phqconsolidar()'></p></td>
	</tr>
	<tr>
	<td colspan=6>Puntaje: <input type=text readonly name=httotal2 value=$httotal2></td>
	</tr>
	<tr>
	<td align=center>Puntaje phq-9</td>
	<td align=center>Severidad de la depresión</td>
	<td align=center colspan='3'>Acciones propuestas de tratamiento</td>
	<td align=center>Frecuencia en meses</td>
	</tr>	
	<tr>
	<td><input type=text readonly size=3 name=phqpunta value=$phqpunta></td>
	<td><input type=text readonly size=32 name=phqseve value=$phqseve></td>
	<td colspan='3'><textarea readonly name=phqacci cols=25 rows=7 event.returnValue = true;else event.returnValue = false>$phqacci</textarea></td>
	<td><input type=text readonly size=7 name=phqfrec value=$phqfrec></td>	
	</tr>	
	</table>
	<br><BR>
	<table align=center class='tbl' width=100%>
		<tr><th align=center valign=top height=30><INPUT type=button class='boton' value=Guardar registro onClick='valida()'></th></tr>	
	</table>
	</table>
	</form>";
?>
</body>
</html>