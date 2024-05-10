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
		if(uno.conti.value=='0')
		{
			alert("Seleccione la contingencia");
			uno.conti.focus();
			return;
		}
		if(uno.causa.value=='0')
		{
			alert("Seleccione la causa externa");
			uno.causa.focus();
			return;
		}
		
		
		opcion = document.getElementsByName("sintorespi");
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
			alert("Seleccione sintomatico respiratorio");
			return;
		}	
		
		opcion = document.getElementsByName("sintopiel");
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
			alert("Seleccione sintomatico de piel");
			return;
		}	
		
		
		
		
		if(uno.final.value=='0')
		{
			alert("Seleccione la finalidad");
			uno.final.focus();
			return;
		}		
		opcion = document.getElementsByName("tipodiag");
		var anu=0;
		for(var i=0; i<3; i++)
		{			
			if(opcion[0].checked)
			{				
				var anu=1;
			}
			if(opcion[1].checked)
			{				 
				var anu=1;
			}	
			if(opcion[2].checked)
			{				 
				var anu=1;
			}		
		}
		
		if(anu==0)
		{
			alert("Seleccione el tipo de diagn�stico");
			return;
		}

		opcionp = document.getElementsByName("patolocronicas");
		var anup=0;
		for(var i=0; i<3; i++)
		{			
			if(opcionp[0].checked)
			{				
				var anup=1;
			}
			if(opcionp[1].checked)
			{				 
				var anup=1;
			}			
		}
		if(anup ==0)
		{
			alert("Seleccione si el paciente presenta patologias cronicas");
			return;
		}
		
		opcionp = document.getElementsByName("vicviolencia");
		var anup=0;
		for(var i=0; i<3; i++)
		{			
			if(opcionp[0].checked)
			{				
				var anup=1;
			}
			if(opcionp[1].checked)
			{				 
				var anup=1;
			}			
		}
		if(anup ==0)
		{
			alert("Seleccione si el paciente es victima de violencia sexual");
			return;
		}
		
		
		
		
		if(uno.cod.value=='')
		{
			alert("Digite el diagnostico");
			uno.map.focus();
			return;
		}
		
		/*
		if(uno.obse.value=='' && uno.tiespe.value=='1')
		{
			alert("Digite la observacion");
			uno.obse.focus();
			return;
		}
		*/
		//if(uno.entra.value=='1')
		//{
			if(uno.analpv.value=='' || uno.analpv.value=='1')
			{
				alert("Digite el an�lisis");
				uno.analpv.focus();
				return;
			}
		//}
		uno.action='almacena.php';
		uno.target='';
		uno.submit();
	
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
	function salto2(n)
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
	
</script>
</head>	
<body>
<?php
//error_reporting(E_ERROR | E_PARSE);
$datos[0]='nom_cie10';
$datos[1]='cod_cie10';
$datos[2]='cie_10';
	
	$archivo='tmp/4HC'.$numcita.'-'.$paciente.'.txt';	
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
	
	include ('php/conexion1.php');
	if($opcup!='')
	{		
		if($opcup==0)
		{
			$bcie=mysql_query("select * from cie_10 where cod_cie10='$codd'");
			if(mysql_num_rows($bcie)=='0')
			{
				$cod='';
				$map='';
			}
			else
			{
				$cod=$codd;
			}
			
		}
		if($opcup==1)$cod1=$codd1;
		if($opcup==2)$cod2=$codd2;
		if($opcup==3)$cod3=$codd3;
	}
	
	include ('php/conexion1.php');
	$bconti=mysql_query("select * from destipos where codt_des='13' order by codi_des");
	$bcausa=mysql_query("select * from destipos where codt_des='12' Order By codi_des");
	$bfinal=mysql_query("select * from destipos where codt_des='11' Order By codi_des");	
	echo"
	<form name=uno method=post>
	<input type=hidden name=codiprg value='4'>
	<input type=hidden name=tiespe value='$tiespe'>
	<input type=hidden name=codd>
	<input type=hidden name=codd1>
	<input type=hidden name=codd2>
	<input type=hidden name=codd3>
	<input type=hidden name=opcup>
	<br>
	<center><table align=center width=90%>
	<tr><td>
	<table align=center class='tbl' width=100%>	
	<tr><th>DIAGNOSTICOS</th></tr>
	</table>
	<br><br>
	
	<table align=center class='tbl' width=100%>
	<tr>";
	/*
	<th align=center>CONTINGENCIA</td>
	<td><select class='caja' name=conti>
	<option value=0></option>";
	while($rconti=mysql_fetch_array($bconti))
	{
		$codc=$rconti['codi_des'];
		$nom=$rconti['nomb_des'];
		if($conti==$codc)
		{
			echo"<option value=$codc selected>$nom</option>";
		}
		else
		{
			echo"<option value=$codc>$nom</option>";
		}
	}
	echo"</select>	
	</td>
*/
	if(empty($causa))$causa='1213';
	echo"
	<th align=center>CAUSA EXTERNA</td>
	<td><select class='caja' name=causa>
	<option value=0></option>";
	while($rconti=mysql_fetch_array($bcausa))
	{
		$codca=$rconti['codi_des'];
		$nom=$rconti['nomb_des'];
		if($causa==$codca)
		{
			echo"<option value=$codca selected>$nom</option>";
		}
		else
		{
			echo"<option value=$codca>$codca $nom</option>";
		}
	}
	
	$sr1='';$sr2='';$sp1='';$sp2='';
	if($sintorespi=='S')$sr1='checked';
	if($sintorespi=='N')$sr2='checked';
	if($sintopiel=='S')$sp1='checked';
	if($sintopiel=='N')$sp2='checked';
	
	echo"</select>		
	
	
	</td>	
	
	<input type=hidden name=final value='10'>
	<input type=hidden name=conti value='1301'>
	
	
	<th align=center colspan=2>POSIBLE CAUSA RELACIONADA CON EL TRABAJO</td>	
	<td colspan=2><input type=checkbox name=causatrab value='s'>
	</tr>
	</table>
	<BR>
	<table align=center class='tbl' width=100%>
	<tr><th class='caja' align=center>SINTOMATICO RESPIRATORIO</th>
	<td align=center>SI <input type=radio $sr1 name=sintorespi value='S'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO <input type=radio $sr2 name=sintorespi value='N'></td>
	<th class='caja' align=center>SINTOMATICO DE PIEL</th>
	<td align=center>SI <input type=radio $sp1 name=sintopiel value='S'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO <input type=radio $sp2 name=sintopiel value='N'></td>
	</table>
	
	<BR>	
	<table align=center class='tbl' width=100%>
	<tr><th class='caja' align=center>TIPO DE DIANOSTICO</th>
	<TD class='caja' align=center>";
	if($tipodiag==1)
	{
		echo"Impresion diagnostica <input type=radio name=tipodiag checked value=1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Confirmado nuevo <input type=radio name=tipodiag value=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Confirmado repetido <input type=radio name=tipodiag value=3>";
	}
	else if($tipodiag==2)
	{
		echo"Impresion diagnostica <input type=radio name=tipodiag value=1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Confirmado nuevo <input type=radio name=tipodiag checked value=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Confirmado repetido <input type=radio name=tipodiag value=3>";
	}
	else if($tipodiag==3)
	{
		echo"Impresion diagnostica <input type=radio name=tipodiag value=1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Confirmado nuevo <input type=radio name=tipodiag value=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Confirmado repetido <input type=radio name=tipodiag checked value=3>";
	}
	else
	{
		echo"Impresion diagnostica <input type=radio name=tipodiag value=1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Confirmado nuevo <input type=radio name=tipodiag value=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Confirmado repetido <input type=radio name=tipodiag value=3>";
	}
	$map='';$map1='';$map2='';$map3='';
	$bd1=mysql_query("select * from cie_10 where cod_cie10='$cod' AND cod_cie10 <> 'Z000' AND cod_cie10 <> 'Z518' AND cod_cie10 <> 'Z519'");
	while($rd1=mysql_fetch_array($bd1))
	{
		$map=$rd1['nom_cie10'];
	}
	$bd2=mysql_query("select * from cie_10 where cod_cie10='$cod1' AND cod_cie10 <> 'Z000' AND cod_cie10 <> 'Z518' AND cod_cie10 <> 'Z519'");
	while($rd2=mysql_fetch_array($bd2))
	{
		$map1=$rd2['nom_cie10'];
	}
	$bd3=mysql_query("select * from cie_10 where cod_cie10='$cod2' AND cod_cie10 <> 'Z000' AND cod_cie10 <> 'Z518' AND cod_cie10 <> 'Z519'");
	while($rd3=mysql_fetch_array($bd3))
	{
		$map2=$rd3['nom_cie10'];
	}
	$bd4=mysql_query("select * from cie_10 where cod_cie10='$cod3' AND cod_cie10 <> 'Z000' AND cod_cie10 <> 'Z518' AND cod_cie10 <> 'Z519'");
	while($rd4=mysql_fetch_array($bd4))
	{
		$map3=$rd4['nom_cie10'];
	}	
	echo"</td>
	
	<th class='caja' align=center>PACIENTE PRESENTA PATOLOGIAS CRONICAS</th>
	
	<TD class='caja' align=center>";
	$pat1='';$pat2='';
	if($patolocronicas=='S')$pat1="checked";
	if($patolocronicas=='N')$pat2="checked";
	
	
	echo"
	SI <input type=radio name=patolocronicas $pat1 value='S'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	NO <input type=radio name=patolocronicas $pat2 value='N'>
	</td>
	
	<th class='caja' align=center>VICTIMA DE VIOLENCIA SEXUAL</th>";
	$vv1='';$vv2='';
	if($vicviolencia=='SI')$vv1='checked';
	if($vicviolencia=='NO')$vv2='checked';
	echo"
	<td>
	SI <input type=radio $vv1 name=vicviolencia value='SI'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	NO <input type=radio $vv2 name=vicviolencia value='NO'>
	</td>
	</tr></table>
	</br>";
	
	$entra=0;
	if($concontrol==1)$entra=1;
	if($concontrol==2)
	{
		if($tiespe=='1')$entra=1;
		if($tiespe=='2')$entra=0;
		
	}
	
	$analpv=str_replace( "�",chr(10),$analpv);
	echo"<input type=hidden name=entra value='$entra'>";
	//if($entra=='1')
	//{	
		echo"
		<br>
		<table align=center class='tbl' width=100%>
		<tr>
		<th>ANALISIS</th>
		<td align=center><textarea onPaste='return false' class='caja' name='analpv' rows=3 cols=100>$analpv</textarea></td>
		</tr>
		</table>";		
	//}
	
	echo"
	<br><table align=center class='tbl' width=100%>
	<tr><th></td><th class='caja' align=center>CODIGO</td>
	<th colspan=1 class='caja' align=center height=30>DIAGNOSTICO</th>
	<th class='caja' align=center>OBSERVACION</td></tr>
	<tr><th>PRINCIPAL</td>
	 <td><input type='text' class='caja' id='course_val'  size=4 MAXLENGTH=4 name='cod' onkeypress='salto(0)' onblur='salto2(0)' value='$cod'></td>
	<td> <textarea onPaste='return false' id='course' class='caja' name='map' rows=2 cols=58>$map</textarea></td>
     
	<td><textarea onPaste='return false' class='caja' name='obse' rows=2 cols=58>$obse</textarea></td>
	</tr>	
	<tr><th>RELACIONADO_1</td>
	<td><input type='text' class='caja' id='course_val1' size=4 MAXLENGTH=4 name='cod1' onkeypress='salto(1)' value='$cod1'></td>	
	<td><textarea onPaste='return false' id='course1' class='caja' name='map1' rows=2 cols=58>$map1</textarea></td>		
		
	<td><textarea onPaste='return false' class='caja' name='obse1' rows=2 cols=58>$obse1</textarea></td></tr>	
	<tr><th>RELACIONADO_2</td>
	<td><input type='text' class='caja' id='course_val2' size=4 MAXLENGTH=4 name='cod2' onkeypress='salto(2)' value='$cod2'></td>
	<td><textarea onPaste='return false' id='course2' class='caja' name='map2' rows=2 cols=58>$map2</textarea></td>		
			
	<td><textarea onPaste='return false' class='caja' name='obse2' rows=2 cols=58>$obse2</textarea></td></tr>	
	<tr><th>RELACIONADO_3</td>
	<td><input type='text' class='caja' id='course_val3'  size=4 MAXLENGTH=4 name='cod3' onkeypress='salto(3)' value='$cod3'></td>
	<td><textarea onPaste='return false' id='course3' class='caja' name='map3' rows=2 cols=58>$map3</textarea></td>		
			
	<td><textarea onPaste='return false' class='caja' name='obse3' rows=2 cols=58>$obse3</textarea></td></tr>	
	</table>
	</td></tr></table>
	<BR>
	<table>";	
	echo"	
	<br><BR>
	<table align=center class='tbl' width=100%>
	<tr><th colspan=2 align=center valign=top height=30><a ><INPUT type=button class='boton' value=Guardar registro onClick='valida();'></th></tr>	
	<table>
	</td></tr></table>
	</br>
	
	
	
	</form>";
?>
</body>
</html>