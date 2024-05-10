<?
	session_register('paciente');
	session_register('numcita');
	session_register('tiespe');
	//$tiespe=$_SESSION['tiespe'];
	
	//$tiespe=1;
	if(empty($paciente))
	{
		echo"<br><br><table align=center class='tbl'>
		<tr><th>POR SEGURIDAD SU SESION SE CANCELÓ. CIERRE E INGRESE NUEVAMENTE AL PROGRAMA</th></tr>
		</table>";
		exit;
	}
	
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>

<!-- SE ANEXAN PARA ANESTESIOLOGIA -->
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<!-- FIN ANEXO -->

<script language="JavaScript">

$().ready(function() {	
	$("#nombreciru0").autocomplete("autocups.php", {
		width: 0,
		minChars: 3,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220	
	});	
	$("#nombreciru0").result(function(event, data, formatted) {
		$("#codigociru0").val(data[1]);
		uno.nombreciru1.disabled=false;
	});
	
});
$().ready(function() {	
	$("#nombreciru1").autocomplete("autocups.php", {
		width: 0,
		minChars: 3,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220	
	});	
	$("#nombreciru1").result(function(event, data, formatted) {
		$("#codigociru1").val(data[1]);
		uno.nombreciru2.disabled=false;
	});
});
$().ready(function() {	
	$("#nombreciru2").autocomplete("autocups.php", {
		width: 0,
		minChars: 3,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220	
	});	
	$("#nombreciru2").result(function(event, data, formatted) {
		$("#codigociru2").val(data[1]);
		uno.nombreciru3.disabled=false;
	});
});
$().ready(function() {	
	$("#nombreciru3").autocomplete("autocups.php", {
		width: 0,
		minChars: 3,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220	
	});	
	$("#nombreciru3").result(function(event, data, formatted) {
		$("#codigociru3").val(data[1]);
		uno.nombreciru4.disabled=false;
	});
});
$().ready(function() {	
	$("#nombreciru4").autocomplete("autocups.php", {
		width: 0,
		minChars: 3,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220	
	});	
	$("#nombreciru4").result(function(event, data, formatted) {
		$("#codigociru4").val(data[1]);
	});
});

					
$().ready(function() {	
	$("#nommedpro").autocomplete("automedico.php", {
		width: 0,
		minChars: 3,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220	
	});	
	$("#nommedpro").result(function(event, data, formatted) {
		$("#codmedpro").val(data[1]);
	});
});


$().ready
(
	function() 
	{		
		$("#course").autocomplete("autoorden.php", {
		width: 340,		
		minChars: 2,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220	
				
		
		});	
		$("#course").result(function(event, data, formatted) {
		$("#course_val").val(data['1']);
		$("#course_niv").val(data['2']);
		$("#course_opc").val(data['3']);
		$("#posord").val(data['4']);
		$("#vigen").val(data['5']);
		});
	}
);




	function valida()
	{		
		if(uno.tiespe.value==1)
		{
			if(uno.tenar1.value=='' || uno.tenar2.value=='')
			{
				alert("Digite el el valor de la tension arterial");
				uno.tenar1.focus();
				return;
			}
			if(uno.freres.value=='')
			{
				alert("Digite el valor de la frecuencia respiratoria");
				uno.freres.focus();
				return;
			}
			if(uno.fc.value=='')
			{
				alert("Digite el valor de la frecuencia cardiaca");
				uno.fc.focus();
				return;
			}
			if(uno.tempe.value=='')
			{
				alert("Digite el valor de la temperatura");
				uno.tempe.focus();
				return;
			}
			if(uno.edadpac.value<=3)
			{
				if(uno.pc.value=='')
				{
					alert("Digite el valor del per�metro cefalico");
					uno.pc.focus();
					return;
				}
			}	
			if(uno.peso.value=='')
			{
				alert("Digite el valor del peso");
				uno.peso.focus();
				return;
			}
			if(uno.talla.value=='')
			{
				alert("Digite el valor de la talla");
				uno.talla.focus();
				return;
			}
		}
		else
		{
			if(uno.otros.value=='')
			{
				alert("Examen f�sico sin descripci�n");
				uno.otros.focus();
				return;
			}
		}
		
		uno.action='almacena.php';
		uno.target='';
		uno.submit();
	}
		
	function valida1()
	{
		if(uno.nombreciru0.value=='')uno.codigociru0.value='';
		if(uno.nombreciru1.value=='')uno.codigociru1.value='';
		if(uno.nombreciru2.value=='')uno.codigociru2.value='';
		if(uno.nombreciru3.value=='')uno.codigociru3.value='';
		if(uno.nombreciru4.value=='')uno.codigociru4.value='';
		if(uno.codigociru0.value && uno.codigociru1.value && uno.codigociru2.value && uno.codigociru3.value && uno.codigociru4.value)
		{
			alert("Seleccione la cirugia propuesta");
			uno.nombreciru0.focus();
		}		
		uno.action='almacena.php';		
		uno.target='';
		uno.submit();
	}
	
	function habilita(j)
	{		
		it="uno.item"+j+".checked";
		if(eval(it)==true)
		{
			des="uno.obseexa"+j+".disabled=false";
			eval(des)
		}
		else
		{
			des="uno.obseexa"+j+".disabled=true";
			eval(des)
		}
	
	}
	function calculaimc()
	{
		
		if(uno.peso.value!='' && uno.talla.value!='')
		{
			
			var imc_,red_,icc;
			imc_=uno.peso.value/(Math.pow((uno.talla.value)/100,2));
			red_=Math.round(imc_*1000)/1000;
			uno.imc.value=red_;
			if(imc_<18.5){enut_="Bajo Peso"};
			if((imc_>=18.5) & (imc_<=24.9)){enut_="Peso Normal"};
			if((imc_>=25) & (imc_<=29.9)){enut_="Sobre Peso"};
			if(imc_>=30){enut_="Obesidad"};
			uno.dimc.value=enut_;
			icc=red_+'<br>'+enut_;
			document.getElementById('imcval').innerHTML=icc;		
		}
		else
		{
			document.getElementById('imcval').innerHTML='';
		}
	}
	function calculaimc_exf()
	{
		
		if(uno.peso_exf.value!='' && uno.talla_exf.value!='')
		{
			
			var imc_,red_,icc;
			imc_=uno.peso_exf.value/(Math.pow((uno.talla_exf.value)/100,2));
			red_=Math.round(imc_*1000)/1000;
			uno.imc_exf.value=red_;
			if(imc_<18.5){enut_="Bajo Peso"};
			if((imc_>=18.5) & (imc_<=24.9)){enut_="Peso Normal"};
			if((imc_>=25) & (imc_<=29.9)){enut_="Sobre Peso"};
			if(imc_>=30){enut_="Obesidad"};
			uno.dimc_exf.value=enut_;
			icc=red_+'<br>'+enut_;
			document.getElementById('imcval').innerHTML=icc;		
		}
		else
		{
			document.getElementById('imcval').innerHTML='';
		}
	}
	
	
	function calculaicc()
	{
		if(uno.cintura.value!='' && uno.cadera.value!='')
		{
			var cad,cin;
			indice=uno.cintura.value/uno.cadera.value;
			
			valor=decimales(indice,3);
			uno.icc.value=valor
			document.getElementById('iccval').innerHTML=valor;		
		}
		else
		{
			document.getElementById('iccval').innerHTML='';
		}
	}
	function decimales(Numero, Decimales) 
	{
		var pot = Math.pow(10, Decimales);
		var num = parseInt(Numero * pot) / pot;
		var nume = num.toString().split('.'); 
		var entero = nume[0];
		var decima = nume[1]; 
		var fin;
		if (decima != undefined) 
		{
			fin = Decimales - decima.length;
		}
		else 
		{
			decima = '';
			fin = Decimales;
		} 
		for (i = 0; i < fin; i++)
		decima += String.fromCharCode(48); 
		var buffer = "";
		var marca = entero.length - 1;
		var chars = 1;
		while (marca >= 0) 
		{
			if ((chars % 4) == 0) 
			{
				buffer = "." + buffer;
			}
			buffer = entero.charAt(marca) + buffer;
			marca--;
			chars++;
		}
		if (decima != '')
			num = buffer + ',' + decima;
		else
			num = buffer;
		return num;
	}
</script>
</head>	
<body>
<?
	
	
	include ('php/conexion1.php');
	
	$cadarecita=mysql_query("SELECT citas.id_cita, horarios.Cserv_horario
	FROM citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario
	WHERE (((citas.id_cita)='$numcita'))");
	while($rdridc1=mysql_fetch_array($cadarecita))
	{
		$estserci12=$rdridc1['Cserv_horario'];
	}
	
	
	$archivodolor='tmp/HCDOLOR'.$numcita.'-'.$paciente.'.txt';		
	if(file_exists($archivodolor)==FALSE)
	{
	
		$beda=mysql_query("select FNAC_USU from usuario where CODI_USU = '$paciente'");
		$reda=mysql_fetch_array($beda);
		$fecna=$reda['FNAC_USU'];
		$edad=calcula_edad($fecna);
		
		$archivo='tmp/3HC'.$numcita.'-'.$paciente.'.txt';		
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
		else
		{
			$bsig=mysql_query("select * from triage_urgencias where iden_cita='$numcita'");
			while($rsig=mysql_fetch_array($bsig))
			{
				$tenar1=$rsig['tear1_tri'];
				$tenar2=$rsig['tear2_tri'];
				$freres=$rsig['frre_tri'];
				$fc=$rsig['frca_tri'];
				$tempe=$rsig['temp_tri'];
				$peso=$rsig['peso_tri'];
				$talla=$rsig['talla_tri'];
				$saox_tri=$rsig['saox_tri'];
				
				
			}
		}
		echo"
		<form name=uno method=post>
		<input type=hidden name='saox_tri' value='$saox_tri'>
		<input type=hidden name='tiespe' value='$tiespe'>
		<input type=hidden name=codiprg value='3'>	
		<center><table align=center width=90%>
		<tr><td>	
		<table align=center class='tbl' width=100%>
		<tr><th>EXAMEN FISICO</th></tr>
		</table>
		<br><br>
		<table align=center class='tbl' width=100%>
		<tr>	
		<th align=center>TENSION ARTERIAL</th>
		<th align=center>FRECUENCIA RESPIRATORIA</th>
		<th align=center>FRECUENCIA CARDIACA</th>
		<th align=center>TEMPERATURA</th>
		<th align=center>PERIMETRO CEFALICO</th>
		<th align=center>PESO</th>
		<th align=center>TALLA</th>
		<th align=center width=100>IMC</th>	
		<th align=center width=100>CINTURA</th>	
		<th align=center width=100>CADERA</th>	
		<th align=center width=100>ICC</th>	
		<tr>
		<td align=center><input type=text onPaste='return false' size=2 class='caja' name=tenar1 onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;' value='$tenar1' ><input type=text onPaste='return false' size=2 class='caja' name=tenar2 onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;' value='$tenar2'></td>
		<td align=center><input type=text onPaste='return false' size=2 class='caja' name=freres onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;' value='$freres'></td>	
		<td align=center><input type=text onPaste='return false' size=2 class='caja' name=fc onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;' value='$fc'></td>
		<td align=center><input type=text onPaste='return false' size=2 class='caja' name=tempe onKeypress='if ((event.keyCode > 47 && event.keyCode <58)||event.keyCode==46)event.returnValue = true;else event.returnValue = false;' value='$tempe'></td>";
		
		
		if($edad<=3)
		{
			echo"<td align=center><input type=text onPaste='return false' size=2 class='caja' name=pc onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;' value='$pc'></td>";
		}
		else
		{
			echo"<td align=center>No aplica</td>";
		}
		
		echo"<input type=hidden name=edadpac value=$edad>
		<td align=center><input type=text onPaste='return false' size=2 class='caja' name=peso onblur='calculaimc()' onKeypress='if ((event.keyCode > 47 && event.keyCode <58)||event.keyCode==46 ||event.keyCode==44)event.returnValue = true;else event.returnValue = false;' value='$peso'> Kgr.</td>
		<td align=center><input type=text onPaste='return false' size=2 class='caja' name=talla onblur='calculaimc()' onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;' value='$talla'> cm.</td>
		<input type=hidden name=imc value='$imc'>
		<input type=hidden name=dimc value='$dimc'>";
		if($edad>10)
		{
			echo"<td align=center width=100><span id='imcval'>$imc<br>$dimc</span></td>";
		}
		else
		{
			echo"<td align=center width=100>No aplica</td>";
		}
		
		echo"
		<td align=center><input type=text onPaste='return false' size=2 onblur='calculaicc()' class='caja' name=cintura onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;' value='$cintura'></td>
		<td align=center><input type=text onPaste='return false' size=2 onblur='calculaicc()' class='caja' name=cadera onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;' value='$cadera'></td>
		<td align=center width=100><span id='iccval'>$icc</span></td>
		<input type=hidden name=icc value='$icc'>
		
		</tr>
		</table>	
		<BR>";
		if($tiespe==1)
		{	
			ECHO"
			<table align=center class='tbl' width=100%>
			<tr>
			<th >DATOS</th>
			<th align=center>SELECCIONAR</th>
			<th align=center>DESCRIPCION DE LOS HALLAZGOS</th>";	
			$bitem=mysql_query("select * from destipos where codt_des='10' order by codi_des");
			$i=0;
			while($rit=mysql_fetch_array($bitem))
			{
				$coddes=$rit['codi_des'];
				$desc=$rit['nomb_des'];		
				echo"<tr>
				<td>$desc</td>";
				$nomvar='codiexa'.$i;
				echo"<input type=hidden name='$nomvar' value='$coddes'>";
				$nomvar='item'.$i;
				$item=$$nomvar;
				if($item==1)
				{
					echo"<td align=center><input type=checkbox name='$nomvar' checked onClick='habilita($i)' value='1' ></td>";
					$nomvar='obseexa'.$i;                                
					$obsee=$$nomvar;
									//echo $nomvar;
					echo"<td align=center><textarea onPaste='return false' name='$nomvar' class='caja' cols=100 rows=1>$obsee</textarea></td>";
				}
				else
				{
					echo"<td align=center><input type=checkbox name='$nomvar' onClick='habilita($i)' value='1' ></td>";
					$nomvar='obseexa'.$i;
					$obsee=$$nomvar;		
					echo"<td align=center><textarea onPaste='return false' name='$nomvar' disabled class='caja' cols=100 rows=1>$obsee</textarea></td>";
				}			
				echo"</tr>";
				$i=$i+1;
			}
			$otros=str_replace( "�",chr(10),$otros);
			echo"<input type=hidden name=fin value=$i>";
			echo"</table>
			<br><br>	
			<table align=center class='tbl' width=100%>	
			<tr><td>OTROS HALLAZGOS</td><td><textarea onPaste='return false' name=otros  class='caja' cols=120 rows=3 onKeypress='if (event.keyCode == 13) event.returnValue = false'>$otros</textarea></td></tr>
			
			<table>";
		}
		else
		{
			$otros=str_replace( "�",chr(10),$otros);
			echo"</table>
			<br>	
			<table align=center class='tbl'>	
			<tr><td>EXAMEN FISICO</td><td><textarea onPaste='return false' name=otros  class='caja' cols=140 rows=4>$otros</textarea></td></tr>
			<table>";
		}
		ECHO"<br>
		<table align=center class='tbl' width=100%>
		<tr><th colspan=2 align=center valign=top height=20><a><INPUT type=button class='boton' value='Guardar registro' onClick='valida();'></th></tr>	
		<table>
		</td></tr></table>
		";
		
	}	
	else
	{
// SE ANEXAN PARA ANESTESIOLOGIA	
		echo"<form name=uno method=post>
		<input type=hidden name='tiespe' value='$tiespe'>
		<input type=hidden name=codiprg value='3'>
		<input type=hidden name=imc_exf value='$imc_exf'>
		<input type=hidden name=dimc_exf value='$dimc_exf'>";
		
		$codprograma=1;
		$archivo='tmp/ex_fisi'.$codprograma.'-'.$numcita.'-'.$paciente.'.txt';
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
			
		$archivo1='tmp/ex_comp'.$codprograma.'-'.$numcita.'-'.$paciente.'.txt';
		if(file_exists($archivo1))
		{
			$fp1 = fopen ($archivo1, "r" );
			$reg=0;
			while (( $data = fgetcsv ( $fp1 , 1000 , "|" )) !== FALSE ) 
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

		$archivo2='tmp/conclu'.$codprograma.'-'.$numcita.'-'.$paciente.'.txt';
		if(file_exists($archivo2))
		{
			$fp2 = fopen ($archivo2, "r" );
			$reg=0;
			while (( $data = fgetcsv ( $fp2 , 1000 , "|" )) !== FALSE ) 
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

		?>
			<table align=center width=90%>
			<tr><td>	
			<table align=center class='tbl' width=100%>
			<tr><th>EXAMEN FISICO</th></tr>
			</table>
			<br>
			<table class='tbl' align=center>
				<tr>
					<th align="right">PESO:</th>
					<?php
					echo"
					<td align=left><input type=text onPaste='return false' size=2 class='caja' name='peso_exf' onblur='calculaimc_exf()' onKeypress='if ((event.keyCode > 47 && event.keyCode <58)||event.keyCode==46 ||event.keyCode==44)event.returnValue = true;else event.returnValue = false;' value='$peso_exf'> Kgr.</td>
					";
					?>
					
					<th align="right">TALLA:</th>
					<?php
					echo"
					<td align=left colspan='1'><input type=text onPaste='return false' size=2 class='caja' name='talla_exf' onblur='calculaimc_exf()' onKeypress='if ((event.keyCode > 47 && event.keyCode <58)||event.keyCode==46 ||event.keyCode==44)event.returnValue = true;else event.returnValue = false;' value='$talla_exf'> cm.</td>
					";
					?>
					<th align="right">IMC:</th>
					<?php
					echo"
					<td align=left colspan='1'><span id='imcval'>$imc $dimc</span></td>
					";
					?>
					<th align="right">TEMPERATURA:</th>
					<?php
					echo"
					<td align=left colspan='1'><input type=text onPaste='return false' size=2 class='caja' name='tempera_exf' onblur='calculaimc_exf()' onKeypress='if ((event.keyCode > 47 && event.keyCode <58)||event.keyCode==46 ||event.keyCode==44)event.returnValue = true;else event.returnValue = false;' value='$tempera_exf'></td>
					";
					?>
					
				</tr>
				<tr>

				<th align="right">SATURACI&OacuteN DE O2:</th>
				<?php
				echo"
				<td align=left><input type=text onPaste='return false' size=2 class='caja' name='saturo2_exf' onKeypress='if ((event.keyCode > 47 && event.keyCode <58)||event.keyCode==46 ||event.keyCode==44)event.returnValue = true;else event.returnValue = false;' value='$saturo2_exf'></td>
				";
				?>
				<th align="right">PRESI&OacuteN ARTERIAL:</th>
				<?php
					echo"
					<td align=left>SIST&OacuteLICA:<input type=text onPaste='return false' size=2 class='caja' name='presions_exf' onKeypress='if ((event.keyCode > 47 && event.keyCode <58)||event.keyCode==46 ||event.keyCode==44)event.returnValue = true;else event.returnValue = false;' value='$presions_exf'></td>
					";
				?>
				<?php
					echo"
					<td align=left colspan=2>DIAST&OacuteLICA:<input type=text onPaste='return false' size=2 class='caja' name='presiond_exf' onKeypress='if ((event.keyCode > 47 && event.keyCode <58)||event.keyCode==46 ||event.keyCode==44)event.returnValue = true;else event.returnValue = false;' value='$presiond_exf'></td>
					";
				?>

				<th align="right">FRECUENCIA CARDIACA:</th>
					<?php
					echo"
					<td align=left><input type=text onPaste='return false' size=2 class='caja' name='frecard_exf' onKeypress='if ((event.keyCode > 47 && event.keyCode <58)||event.keyCode==46 ||event.keyCode==44)event.returnValue = true;else event.returnValue = false;' value='$frecard_exf'></td>
					";
					?>
				</tr>
				
				<tr>
					<th align="right">FRECUENCIA RESPIRATORIA:</th>
					<?php
					echo"
					<td align=left colspan='6'><input type=text onPaste='return false' size=2 class='caja' name='freresp_exf' onKeypress='if ((event.keyCode > 47 && event.keyCode <58)||event.keyCode==46 ||event.keyCode==44)event.returnValue = true;else event.returnValue = false;' value='$freresp_exf'></td>
					";
					?>
				</tr>


				
				<tr>
					<th align="right">ESTADO GENERAL:</th>
					<?php
					echo"
					<td align='left' colspan='6'><textarea class='caja' name='estado_exf' rows=2 cols=200>$estado_exf</textarea></td>
					";
					?>
				</tr>

				<tr>
					<th align="right">S.N.C.</th>
					<?php
					echo"
					<td align='left' colspan='6'><textarea class='caja' name='snc_exf' rows=2 cols=200>$snc_exf</textarea></td>
					";
					?>
				</tr>
				
				<?php
					if($dentsuperior_exf=='S')$dentsuperior_exf1="checked";
					
					if($dentinferior_exf=='S')$dentinferior_exf1="checked";
					
					if($dentfija_exf=='S')$dentfija_exf1="checked";
					
					if($dentmovil_exf=='S')$dentmovil_exf1="checked";
					
					if($dentparcial_exf=='S')$dentparcial_exf1="checked";
					
					if($denttotal_exf=='S')$denttotal_exf1="checked";
					
				?>
				
				<tr>
					<th align="right">DENTADURA/PROTESIS:</th>
					
					<td colspan=7>
					<?php
					echo"
					SUPERIOR &nbsp <input type=checkbox name=dentsuperior_exf $dentsuperior_exf1 value='S'>
					&nbsp INFERIOR &nbsp <input type=checkbox name=dentinferior_exf $dentinferior_exf1 value='S'>
					&nbsp FIJA &nbsp <input type=checkbox name=dentfija_exf $dentfija_exf1 value='S'>
					&nbsp MOVIL &nbsp <input type=checkbox name=dentmovil_exf $dentmovil_exf1 value='S'>	
					&nbsp PARCIAL &nbsp <input type=checkbox name=dentparcial_exf $dentparcial_exf1 value='S'>
					&nbsp TOTAL &nbsp <input type=checkbox name=denttotal_exf $denttotal_exf1 value='S'>";
					?>	
					</td>
<!--					
					<td align="left" colspan='6'><select name="dentpro_exf" class='caja'>
						<option value="">
						<option value="SU">SUPERIOR
						<option value="IN">INFERIOR
						<option value="FI">FIJA
						<option value="MO">M&OacuteVIL
						<option value="PA">PARCIAL
						<option value="TO">TOTAL
						</select>
					</td>
-->					
					
				</tr>	
				<tr>
					<th align="right" >APERTURA BUCAL:</th>
					<td align="left"><select name="apertur_exf" class="caja">
								<option value="">
								<?php
								for($cont1=0;$cont1<=10;$cont1++)
								{
									echo "<option value=$cont1>$cont1";
								}
								?>
							</select>Cm
					</td>
					<th align="right">ESTADO DIENTES:</th>
					<?php
					echo"
					<td align='left' colspan='4'><input type='text' class='caja' name='estadodien_exf' value='$estadodien_exf' size='120' maxlength='30'></td>";
					?>
					</tr>
				<tr>
					<th align="right">I.MALLAMPATI</th>
					<td align="left"><select name="imallam_exf" class="caja">
								<option value="">
								<?php
								for($cont_=1;$cont_<=4;$cont_++)
								{
									echo "<option value=$cont_>$cont_";
								}
								?>
							</select>
					</td>
					<th align="left"  colspan="2">DISTANCIA MENTOTIROIDEA:</th>
					
					
					<?php
					echo"
					<td align='left'><input type='text' class='caja' name='dmentoh_exf' value='$dmentoh_exf' size='2' maxlength='2'> &nbsp cm </td>";
					?>
					
					<th align="right">MOVILIDAD CERVICAL:</th>
					<td align="left"><select name="movilid_exf" class="caja">
								<option value="">
								<option value="N">NORMAL
								<option value="D">DISMINUIDA
							</select>               
					</td>
				</tr>
				<tr>
					<th align="right">CUELLO / MAXILAR:</th>
					<?php
					echo"
					<td align='left' colspan='6'><input type='text' class='caja' name='anormali_exf' size='100' maxlength='150' value='$anormali_exf' placeholder='Normal'></td>";
					?>
				</tr>
				<tr>
					<th align="right">T&OacuteRAX:</th>
					<?php
					echo"
					<td align='left' colspan='6'><input type='text' class='caja' name='torax_exf' size='100' maxlength='150' value='$torax_exf' placeholder='Normal'></td>";
					?>
				</tr>
				<tr>
					<th align="right">PULMONES:</th>
					<?php
					echo"
					<td align='left' colspan='6'><input type='text' class='caja' name='pulmones_exf' size='100' maxlength='150' value='$pulmones_exf' placeholder='Normal'></td>";
					?>
				</tr>
				<tr>
					<th align="right">CORAZ&OacuteN:</th>
					<?php
					echo"
					<td align='left' colspan='6'><input type='text' class='caja' name='corazon_exf' size='100' maxlength='150' value='$corazon_exf' placeholder='Normal'></td>";
					?>
				</tr>
				<tr>
					<th align="right">ABDOMEN:</th>
					<?php
					echo"
					<td align='left' colspan='6'><input type='text' class='caja' name='abdomen_exf' size='80' maxlength='80' value='$abdomen_exf' placeholder='Normal'></td>";
					?>
				</tr>
				<tr>
					<th align="right">G&eacuteNITO-URINARIO:</th>
					<?php
					echo"
					<td align='left' colspan='6'><input type='text' class='caja' name='genitouri_exf' size='80' maxlength='80' value='$genitouri_exf' placeholder='Normal'></td>";
					?>
				</tr>
				<tr>
					<th align="right">EXTREMIDADES:</th>
					<?php
					echo"
					<td align='left' colspan='6'><input type='text' class='caja' name='extremi_exf' size='80' maxlength='80' value='$extremi_exf' placeholder='Normal'></td>";
					?>
				</tr>
				<tr>
					<th align="right">OTROS:</th>
					<?php
					echo"
					<td align='left' colspan='6'><textarea class='caja' name='otros_exf' rows='2' cols='100' placeholder='Ninguno'>$otros_exf</textarea></td>";
					?>
					
				</tr>
			</table>
			</td></tr>
			</table>
			
			
			
			
			
			
			
			
			
			<br>
			<table align=center width=90%>
			<tr><td>	
			<table align=center class='tbl' width=100%>
			<tr><th>EXAMEN COMPLEMENTARIO</th></tr>
			</table>
			<br><br>
			<table class='tbl' align=center>
				<tr>
					<th align="right">HEMOGLOBINA:</th> 
					<?php
					echo"
					<td align=left><input type=text onPaste='return false' size=2 name='hemoglo_exc' class='caja' onKeypress='if ((event.keyCode > 47 && event.keyCode <58)||event.keyCode==46 ||event.keyCode==44)event.returnValue = true;else event.returnValue = false;' value='$hemoglo_exc'></td>
					";
					?>
					
					
					
					<th align="right">GLICEMIA:</th>
<!--					<th align="right">HEMOGLOBINA:</th> -->
					<?php
					echo"
					<td align='left'><input type='text' name='glicemi_exc' value='$glicemi_exc' class='caja' size='3' maxlength='3' onKeypress='if ((event.keyCode <= 47 || event.keyCode >=58)) event.returnValue = false;'></td>
					";
					?>
					
					<th align="right">HEMOCLASIFICACI&OacuteN:</th>
					<td align="left">
					<select name="hemocla_exc" class="caja">
					<option value="">
					<option value="A">A
					<option value="B">B
					<option value="AB">AB
					<option value="O">O
					</select>
					<select name="factorrh_exc" class="caja">
					<option value="">
					<option value="+">POSITIVO
					<option value="-">NEGATIVO
					</select>
					</td>
				</tr>
				<tr>
					<th align="right">HEMATOCRITO:</th>
					<?php
					echo"
					<td align='left'><input type='text' name='hematoc_exc' value='$hematoc_exc' class='caja' size='10' maxlength='10'></td>";
					?>
					<th align="right">BUN:</th>
					<?php
					echo"
					<td align='left'><input type='text' name='bun_exc' size='2' value='$bun_exc' class='caja' maxlength='2'></td>";
					?>		
					
					<th align="right">PROTEINAS TOTAL:</th>
					<?php
					echo"
					<td align='left'><input type='text' class='caja' name='protein_exc' value='$protein_exc' size='10' maxlength='10'></td>";
					?>
				</tr>
				<tr>
					<th align="right">PLAQUETAS:</th>
					
					
					<?php
					echo"
					<td align='left'><input type='text' class='caja' name='plaquet_exc' value='$plaquet_exc' size='10' maxlength='10'></td>";
					?>
					<th align="right">CREATININA:</th>
					<?php
					echo"
					<td align='left'><input type='text' class='caja' name='creatin_exc' size='10' value='$creatin_exc' maxlength='10'></td>";
					?>
					<th align="right">ALBUMINA:</th>
					<?php
					echo"
					<td align='left'><input type='text' name='albumin_exc' value='$albumin_exc' class='caja' size='10' maxlength='10'></td>";
					?>
				</tr>
				<tr>
					<th align="right">T.P.:</th>
					<?php
					echo"
					<td align='left'><input type='text' name='tp_exc' value='$tp_exc' class='caja' size='10' maxlength='10'></td>";
					?>
					<th align="right">NA+:</th>
					<?php
					echo"
					<td align='left'><input type='text' name='sodio_exc' value='$sodio_exc'  class='caja' size='10' maxlength='10'></td>";
					?>
					<th align="right">BILIRUBINA TOTAL:</th>
					<?php
					echo"
					<td align='left'><input type='text' name='bilitot_exc' value='$bilitot_exc' class='caja' size='10' maxlength='10'></td>";
					?>
				</tr>
				<tr>
					<th align="right">T.P.T.:</th>
					<?php
					echo"
					<td align='left'><input type='text' name='tpt_exc' value='$tpt_exc' class='caja' size='10' maxlength='10'></td>";
					?>
					<th align="right">K+:</th>
					<?php
					echo"
					<td align='left'><input type='text' name='potasio_exc' value='$potasio_exc' class='caja' size='10' maxlength='10'></td>";
					?>
					<th align="right">BILIRUBINA DIRECTA:</th>
					<?php
					echo"
					<td align='left'><input type='text' name='bilidir_exc' value='$bilidir_exc' class='caja' size='10' maxlength='10'></td>";
					?>
				</tr>
				<tr>
					<th align="right">T. SANGR&IacuteA:</th>
					<?php
					echo"
					<td align='left'><input type='text' name='tiposan_exc' value='$tiposan_exc' class='caja' size='3' maxlength='3'></td>";
					?>
					
					<th align="right">CALCIO:</th>
					<?php
					echo"
					<td align='left'><input type='text' name='calcio_exc' value='$calcio_exc' class='caja' size='10' maxlength='10'></td>";
					?>
					
					<th align="right">V.D.R.L.:</th>
					<?php
					echo"
					<td align='left'><input type='text' name='vdrl_exc' value='$vdrl_exc' class='caja' size='10' maxlength='10'></td>";
					?>
				</tr>
				<tr>
					<th align="right">T. COAGULACI&OacuteN:</th>
					<?php
					echo"
					<td align='left'><input type='text' name='coagula_exc' value='$coagula_exc' class='caja' size='3' maxlength='3'></td>";
					?>
					<th align="right">LEUCOCITOS:</th>
					<?php
					echo"
					<td align='left'><input type='text' name='leucoci_exc' value='$leucoci_exc' class='caja' size='10' maxlength='10'></td>";
					?>
					<th align="right">P.EMBARAZO:</th>
					<?php
					echo"
					<td align='left'><input type='text' name='prembar_exc' value='$prembar_exc' size='10' class='caja' maxlength='10'></td>";
					?>
				</tr>
				<tr>
					<th align="center">AYUDA DIAGNOSTICA</th>
					<th align="center">FECHA</th>
					<th align="center" colspan='5'>DESCRIPCION</th>

				</tr>	
					
				
				<tr>
					<td align="center">RX:</td>
					<td align="left" colspan="5">
					<?php    echo "<input type=text name=rxfecha_exc id=rxfecha_exc size='14' class='caja' value= >";?>
					<img src='img/Calendar-32.png' width='16' height='16' alt='Calendario' id='lanzador1'/>
					<script type="text/javascript"> 
					 Calendar.setup({ 
					inputField     :    "rxfecha_exc",     // id del campo de texto 
					ifFormat     :     "%Y/%m/%d",     // formato de la fecha que se escriba en el campo de texto 
					button     :    "lanzador1"     // el id del botn que lanzar el calendario 
					}); 
					</script> 
					<script languaje=javascript>uno.rxfecha_exc.value="<?echo $rxfecha_exc?>";</script>
					
					<?php
					echo"<textarea name='rxdescrip_exc' class='caja' maxlength='255' cols=100 rows=2>$rxdescrip_exc</textarea>";
					?>
					
					</td>
				</tr>
				<tr>
					<td align="center">E.C.G.:</td>
						
						<?php echo "<td align='left' colspan='5'><input type=text name=ecgfecha_exc id=ecgfecha_exc name=ecgfecha_exc class='caja' size='14' value= >";?>
						<img src='img/Calendar-32.png' width='16' height='16' alt='Calendario' id='lanzador2'/>
						<script type="text/javascript"> 
						Calendar.setup({ 
						inputField     :    "ecgfecha_exc",     // id del campo de texto 
						ifFormat     :     "%Y/%m/%d",     // formato de la fecha que se escriba en el campo de texto 
						button     :    "lanzador2"     // el id del botn que lanzar el calendario 
						}); 
						</script> 
						<script type="text/javascript">uno.ecgfecha_exc.value="<?echo $ecgfecha_exc?>";</script>
						
						<?php
						echo"<textarea name='ecgdescrip_exc' class='caja' maxlength='255' cols=100 rows=2>$ecgdescrip_exc</textarea>";						
						?>
					</td>
				</tr>
				<tr>
					<td align="center">ECO:</td>
					<?php echo "<td align='left' colspan='5'><input type=text name=ecofecha_exc id=ecofecha_exc class='caja' size='14' value= >";?>
					<img src='img/Calendar-32.png' width='16' height='16' alt='Calendario' id='lanzador3'/>
					<script type="text/javascript"> 
					Calendar.setup({ 
					inputField     :    "ecofecha_exc",     // id del campo de texto 
					ifFormat     :     "%Y/%m/%d",     // formato de la fecha que se escriba en el campo de texto 
					button     :    "lanzador3"     // el id del botn que lanzar el calendario 
					}); 
					</script> 
					<script type="text/javascript">uno.ecofecha_exc.value="<?echo $ecofecha_exc?>";</script>
					<?php
					echo"<textarea name='ecodescrip_exc' class='caja' maxlength='255' cols=100 rows=2>$ecodescrip_exc</textarea>";	
					
					?>
					</td>
				</tr>
				<tr>
					<td align="center">OTRO:</td>
					<?php echo "<td align='left' colspan='5'><input type=text name=otrofecha_exc id=otrofecha_exc class='caja' size='14' value= >";?>
					<img src='img/Calendar-32.png' width='16' height='16' alt='Calendario' id='lanzador4'/>
					<script type="text/javascript"> 
					Calendar.setup({ 
					inputField     :    "otrofecha_exc",     // id del campo de texto 
					ifFormat     :     "%Y/%m/%d",     // formato de la fecha que se escriba en el campo de texto 
					button     :    "lanzador4"     // el id del botn que lanzar el calendario 
					}); 
					</script> 
					<script type="text/javascript">uno.otrofecha_exc.value="<?echo $otrofecha_exc?>";</script>
					
					<?php
					echo"<textarea name='otrodescrip_exc' class='caja' maxlength='255' cols=100 rows=2>$otrodescrip_exc</textarea>";					
					?>
					
					
					</td>
				</tr>
			</table>
			</td></tr>
			</table>
			
			<br>
			
			<br>
			<table align=center width=90%>
			<tr><td>	
			<table align=center class='tbl' width=100%>
			<tr><th>AYUDAS DIAGNOSTICAS</th></tr>
			</table>
			
			<table class='tbl' align=center>
			<?
			
			$fechoy=date('Y-m-d');
			$ano=date('Y');
			$mesini=date('m');																																																																																		
			$diaini=date('d');
			$anoini=$ano-1;
			$fechaini=$anoini.'-'.$mesini.'-'.$diaini;
			
			
			
			$cadima="SELECT `fech_lec` , `copr_lec` , `lect_lec` FROM `lectura_imagen` WHERE `codi_usu` = '$paciente' AND `esta_lec` = 'CU' AND `fech_lec` >= $fechaini";
			$resuima = mysql_query($cadima);
			$cuentaima = @mysql_num_rows($resuima);
			if($cuentaima!=0)
			{
				echo"<td class='estilo4' align=center><a href'#' onClick='abrecierra(1)'><img src='img/mas.png' border=0 width=12></td>";			

				
				echo"
				<tr><th colspan=3 ALIGN=CENTER>LECTURA DE IMAGENOLOGIA DISPONIBLES</th></tr>
				<tr>
				<td>Fecha</td>
				<td>Cups</td>
				<td>Lectura</td>
				</tr>";
				while($row = mysql_fetch_array($resuima))
				{
					$fechaima=$row['fech_lec'];
					$codigoima=$row['copr_lec'];
					$descripima=$row['lect_lec'];
					
					echo "<tr>";

					echo"<td align='left'>$fechaima</td>";
					echo"<td align='left'>$codigoima</td>";
					echo"<td align='left'>$descripima</td>";
					
					echo "</tr>";
				}
			}
			else
			{
				echo"<td class='estilo4' align=center><a href'#' onClick='abrecierra2()'><img src='img/menos.png' border=0 width=12></td>";
				echo"<tr>	
				<th colspan=2>NO EXISTEN RESULTADOS DE IMAGENOLOGIA DISPONIBLES</th>
				</tr>";
			}
			
			$cons=mysql_query("SELECT el.iden_labs,dl.iden_dlab ,dl.estd_dlab,el.codi_usu,dl.codigo,dl.nord_dlab,
			el.fchr_labs, el.hrae_labs,el.cod_medi 
			FROM detalle_labs AS dl
			INNER JOIN encabezado_labs AS el ON el.iden_labs = dl.iden_labs
			WHERE el.codi_usu='$paciente' AND dl.estd_dlab<>'EL' 
			GROUP BY el.iden_labs order by el.fchr_labs DESC");
			
			echo"<table class='tbl' align=center width=100%>
			<br>
			<tr><th align='center'><STRONG>PROCEDIMIENTOS REALIZADOS DE LABORATORIO</strong></th></tr>
			</table>";
			
			echo"<table class='tbl' border=0 align=center>
			<tr>
			<td class='Td1' align='center'><b>OPC</td>
			<td class='Td1' align='left'><b>Nro ORDEN</span></td>
			<td class='Td1' align='left'><b>FECHA DE REALIZACION</span></td>
			<td class='Td1' align='left'><b>MEDICO SOLICITANTE</span></td></tr>";
			$i=0;		
			while ($rowexa=mysql_fetch_array($cons))
			{				 
				$iden_dlab=$rowexa['iden_dlab'];
				$codusu=$rowexa['codi_usu'];
				$iden_labs=$rowexa['iden_labs'];
				$cod=$rowexa['codigo'];
				$nord_dlab=$rowexa['nord_dlab'];
				$nomvar='codusu'.$i;
				echo "<input type=hidden name=codusu value=$codusu>";
				$nomvar='iden_labs'.$i;
				echo "<input type=hidden name=iden_labs value=$iden_labs>";
				$nomvar='nord_dlab'.$i;
				echo "<input type=hidden name=nord_dlab value='$nord_dlab'>";
				$conex=mysql_query("SELECT detalle_labs.iden_labs,detalle_labs.nord_dlab
				FROM detalle_labs INNER JOIN cups ON detalle_labs.codigo = cups.codigo WHERE detalle_labs.iden_labs='$iden_labs'");
				$mcu=1;
				while ($rowdet=mysql_fetch_array($conex))
				{
					$desc=$rowdet['descrip'];
					$nord_dlab=$rowdet['nord_dlab'];
					$nord[$mcu]=$nord_dlab;			
					$nomvar='cod'.$i.$mcu;
					echo "<input type=hidden name='$nomvar' value='$cod'>";
					$nomvar='selec'.$i.$mcu;									
					echo "<input type=hidden name='$nomvar' value=1>";										
					$cql[$mcu]=$desc;						
					$mcu++;		
				}
				$i++;
				echo "</tr> \n";
				echo " 
				<tr>
				<td class='Td1' width=2%><a href=../Historias/imprimir2_.php?codusu=$paciente&iden_labs=$iden_labs&nd_=$nord_dlab&band=1 target='fr01'><img src='img/search.gif' border=0 width=17 height=17 alt='Imprimir' ></a>
				<td align='center'>$nord_dlab<input  type=hidden name=fac_num value='$rowx[num_fac]'></td>
				<td align='left'>$rowexa[fchr_labs] - $rowexa[hrae_labs]</td>";;
				$cons_medi=mysql_query("SELECT * FROM medicos WHERE cod_medi='$rowexa[cod_medi]'");
				$rowmedi = mysql_fetch_array($cons_medi);
				$medico=$rowmedi[nom_medi];
				echo"<td align='left'>$medico<input type=hidden name=nom_medi value='$rowx[nom_med]'></td></tr>";
			}
			echo '</table>';
			
			
		?>

		
		
		
		<br>
		<table align=center width=90%>
		<tr><td>	
		<table align=center class='tbl' width=100%>
		<tr><th>CONCLUSIONES</th></tr>
		</table>
		<br><br>
		<table class='tbl' align=center>
				<tr>
					<th align="right">ESTADO F&IacuteSICO: A.S.A.</th>
					<td align="left" class="caja">
						<select name="estfisico_ccl" class="caja">
						<option value="">
						<option value="1">1
						<option value="2">2
						<option value="3">3
						<option value="4">4
						<option value="5">5
						</select>
					</td>
					
				

		 
					<th align="right">CLASE FUNCIONAL:</th>
					<td align="left">
					<select name="clafuncional_ccl" class="caja">
						<option value="">
						<option value="UNO">I
						<option value="DOS">II
						<option value="TRES">III
						<option value="CUATRO">IV
						</select>		
					</td>

					
					
				</tr>
				
				
				
				
				
				<tr>
					<th align="right">APTO PARA CIRUG&IacuteA</th>
					<td align="left" colspan="3">
						<select name="aptociru_ccl" class="caja">
						<option value="">
						<option value="SI">SI
						<option value="NO">NO
						</select>
				</tr>
				<tr>
					<th align="right">ANESTESIA PROPUESTA:</th>
					<td align="left" colspan="3">
						<select name="anestesia_ccl" class="caja">
						<option value="">
						<option value="LOCAL">LOCAL
						<option value="REGIONAL">RAQUIDEO -REGIONAL
						<option value="GENERAL">GENERAL
						<option value="BLOQUEO">BLOQUEO
						<option value="SEDACION">SEDACION
						<option value="DISOCIATIVA">DISOCIATIVA
						<option value="PERIDURAL">PERIDURAL
						</select>
						
						<select name="vario_ccl" class="caja">
						<option value="">
						<option value="Y">Y
						<option value="O">O
						</select>
						
						<select name="anestesia1_ccl" class="caja">
						<option value="">
						<option value="LOCAL">LOCAL
						<option value="REGIONAL">RAQUIDEO -REGIONAL
						<option value="GENERAL">GENERAL
						<option value="BLOQUEO">BLOQUEO
						<option value="SEDACION">SEDACION
						<option value="DISOCIATIVA">DISOCIATIVA
						<option value="PERIDURAL">PERIDURAL
						</select>
					</td>	
				</tr>
				
				<?php
				$chk1='disabled';
				$chk2='disabled';
				$chk3='disabled';
				$chk4='disabled';
				if($codigociru0 != '')$chk1='';
				if($codigociru1 != '')$chk2='';
				if($codigociru2 != '')$chk3='';
				if($codigociru3 != '')$chk4='';
				
				$nombreciru0='';$nombreciru1='';$nombreciru2='';$nombreciru3='';$nombreciru4='';
				$bcup0=mysql_query("select * from cups where codigo='$codigociru0'");
				while($rcup0=mysql_fetch_array($bcup0))
				{
					$nombreciru0=$rcup0['descrip'];
				}
				$bcup1=mysql_query("select * from cups where codigo='$codigociru1'");
				while($rcup1=mysql_fetch_array($bcup1))
				{
					$nombreciru1=$rcup1['descrip'];
				}
				$bcup2=mysql_query("select * from cups where codigo='$codigociru2'");
				while($rcup2=mysql_fetch_array($bcup2))
				{
					$nombreciru2=$rcup2['descrip'];
				}
				$bcup3=mysql_query("select * from cups where codigo='$codigociru3'");
				while($rcup3=mysql_fetch_array($bcup3))
				{
					$nombreciru3=$rcup3['descrip'];
				}
				$bcup4=mysql_query("select * from cups where codigo='$codigociru4'");
				while($rcup4=mysql_fetch_array($bcup4))
				{
					$nombreciru4=$rcup4['descrip'];
				}
				?>
				
				<tr>
					<th align="right" rowspan=5>CIRUG&IacuteA PROPUESTA:</th>
					
					<td align="left" colspan="2">
						<textarea name="nombreciru0" id="nombreciru0" class="caja" cols=100 rows=2 ><?php echo $nombreciru0; ?></textarea>
						<input type="hidden" name="codigociru0" id="codigociru0" value="<?php echo $codigociru0; ?>">
					</td>	
				</tr>
					
					<tr>
						
						<td align="left" colspan="2">
							<textarea name="nombreciru1" id="nombreciru1" <?php echo $chk1; ?> class="caja" cols=100 rows=2 ><?php echo $nombreciru1; ?></textarea>
							<input type="hidden" name="codigociru1" id="codigociru1" value="<?php echo $codigociru1; ?>">
						</td>	
					</tr>
					<tr>					
						<td align="left" colspan="3">
							<textarea name="nombreciru2" id="nombreciru2" <?php echo $chk2; ?> class="caja" cols=100 rows=2 ><?php echo $nombreciru2; ?></textarea>
							<input type="hidden" name="codigociru2" id="codigociru2" value="<?php echo $codigociru2; ?>">
						</td>	
					</tr>
					<tr>					
						<td align="left" colspan="3">
							<textarea name="nombreciru3" id="nombreciru3" <?php echo $chk3; ?> class="caja" cols=100 rows=2 ><?php echo $nombreciru3; ?></textarea>
							<input type="hidden" name="codigociru3" id="codigociru3" value="<?php echo $codigociru3; ?>">
						</td>	
					</tr>
					<tr>					
						<td align="left" valign="middle" colspan="3">
							<textarea name="nombreciru4" id="nombreciru4" <?php echo $chk4; ?> class="caja" cols=100 rows=2 ><?php echo $nombreciru4; ?></textarea>
							<input type="hidden" name="codigociru4" id="codigociru4" value="<?php echo $codigociru4; ?>">
						</td>	
					</tr>
				
				
				
				
				
				
				
				
				
				
				
<!-- vich  -->				
				<tr>
					<th align="right">RESERVA SANGU&IacuteNEA:</th>
					<td align="left" colspan="3">
					
					
					
<!--					<select name="reserva_ccl" class="caja">	-->

					<?php
						echo"<input type=text onPaste='return false' size=60 class='caja' name='reserva_ccl' value='$reserva_ccl'>";
//							for($cont_=0;$cont_<=10;$cont_++){
//							echo "<option value=$cont_>$cont_";
//						}
					
					?>			
<!--					</select> UNIDADES   -->
					
					</td>
				</tr>
				
				<tr>
					<th align="right">RESERVA de UCI</th>
					<td align="left" colspan="3">
						<select name="reservauci_ccl" class="caja">
						<option value="">
						<option value="SI">SI
						<option value="NO">NO
						</select>
				</tr>


				<tr>
					<th align="right">PREMEDICACI&OacuteN:</th>
					<td align="left" colspan="3">
						<select name="premedica_ccl" class="caja">
						<option value="">
						<option value="SI">SI
						<option value="NO">NO
						</select>
					
					
					<?php
					ECHO"
					<input type='text' name='premedicatxt_ccl' class='caja' value='$premedicatxt_ccl' size='50' maxlength='50'></td>";
					?>
				
				
				</tr>
				<tr>
					<th align="right">PROGRAMAR:</th>
					<td align="left" colspan="3"><select name="tprograma_ccl" class="caja">
						<option value="">
						<option value="A">AMBULATORIO
						<option value="H">HOSPITALIZAR
						</select>
						
						<?php
						ECHO"
						<input type='text' name='anotacion_ccl' value='$anotacion_ccl' class='caja' size='50' maxlength='50'>";
						?>
					
					
					</td>
				</tr>
				<tr>
					<th align="right">REEVALUAR EN SALA DE CIRUG&IacuteA</th>
					<td align="left" colspan="3"><select name="reevaluar_ccl" class="caja">
							<option value="">
							<option value="SI">SI
							<option value="NO">NO
							</select>
						<?php
						ECHO"
						<input type='text' name='anotacion1_ccl' value='$anotacion1_ccl' class='caja' size='50' maxlength='50'>";
						?>
					</td>
				
				</tr>
				
				<tr>
					<th align="right">M&Eacute;DICO QUE REALIZA EL PROCEDIMIENTO</th>
					<td align="left" colspan="3">
					<?php
					
					echo"<input type='hidden' name='medicoproc_ccl' id='codmedpro' value='$medicoproc_ccl'>
					<input type='text' name='nommedpro' id='nommedpro' class='caja' size='70' value='$nommedpro'>";
					
					
					?>
					</select>
					</td>
					
				</tr>
				<!--
				<tr>
					<th align="left" colspan="4">OBSERVACIONES:</th>
				</tr>
				
				<tr>
					<td align="left" colspan="4">
					
					<?php
					/*
					ECHO"
					<textarea name='observa_ccl' rows='3' class='caja' cols='80'>$observa_ccl</textarea>";
					*/
					?>
					
					</td>
				</tr>
				-->
				
				<tr>
					<td align="left" colspan="4">SE EXPLICA ALTERNATIVAS Y RIESGOS ANEST&EacuteSICOS SIENDO ENTENDIDAS Y ACEPTADAS POR EL PACIENTE Y/O ACUDIENTE
					<select name="concent_ccl" class="caja">
					<option value="">
					<option value="SI">SI
					<option value="NO">NO
					</select>
					</td>
				</tr>
				
				
				<script languaje="javascript">
					document.uno.apertur_exf.value='<?php echo $apertur_exf;?>';	
					document.uno.imallam_exf.value='<?php echo $imallam_exf;?>';
					document.uno.movilid_exf.value='<?php echo $movilid_exf;?>';
					document.uno.hemocla_exc.value='<?php echo $hemocla_exc;?>';
					document.uno.factorrh_exc.value='<?php echo $factorrh_exc;?>';
					document.uno.estfisico_ccl.value='<?php echo $estfisico_ccl;?>';
					document.uno.clafuncional_ccl.value='<?php echo $clafuncional_ccl;?>';
					document.uno.aptociru_ccl.value='<?php echo $aptociru_ccl;?>';
					document.uno.anestesia_ccl.value='<?php echo $anestesia_ccl;?>';
					document.uno.vario_ccl.value='<?php echo $vario_ccl;?>';
					document.uno.anestesia1_ccl.value='<?php echo $anestesia1_ccl;?>';
					document.uno.premedica_ccl.value='<?php echo $premedica_ccl;?>';
					document.uno.tprograma_ccl.value='<?php echo $tprograma_ccl;?>';
					document.uno.reevaluar_ccl.value='<?php echo $reevaluar_ccl;?>';
					document.uno.concent_ccl.value='<?php echo $concent_ccl;?>';
					document.uno.reservauci_ccl.value='<?php echo $reservauci_ccl;?>';
					
				</script>
				
				
				
			</table>
		</td></tr>
		</table>
		<table align=center class='tbl1' width=100%>
			<tr><th colspan=2 align=center valign=top height=20><a><INPUT type="button" class='boton' value="Guardar" registro onClick='valida1();'></th></tr>
		</table>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>		
		<?php	
		
		
	}	
// FIN ANEXO		
		
	
	function calcula_edad($fecha_nac)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en n�meros enteros
        $dia=date("d");
        $mes=date("m");
        $anno=date("Y");
        //descomponer fecha de nacimiento
        $dia_nac=substr($fecha_nac, 8, 2);
        $mes_nac=substr($fecha_nac, 5, 2);
        $anno_nac=substr($fecha_nac, 0, 4);
        if($mes_nac>$mes)
        {
            $calc_edad= $anno-$anno_nac-1;
        }
        else
        {
            if($mes==$mes_nac AND $dia_nac>$dia)
            {
                $calc_edad= $anno-$anno_nac-1;
            }
            else
            {
                $calc_edad= $anno-$anno_nac;
            }
        }
        return $calc_edad;
    }
?>
</body>
</html>