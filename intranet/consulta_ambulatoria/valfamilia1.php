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
//		uno.action='prueba.php';
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
			uno.phqacci.value =  'Tratamiento actuvo con farmacoterapia y/o Psicoterapia, solicite intervención en medicina familiar (Control en 12 meses)';
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
$httotal1 = 0;
$httotal2 = 0;

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
	$num=0;
	$bante=mysql_query("SELECT conambfam.apgpun_cfa, conambfam.phqpun_cfa, Max(conambfam.fecha_cfa) AS MaxDefecha_cfa
	FROM conambfam WHERE (((conambfam.codi_usu)='$paciente')) GROUP BY conambfam.apgpun_cfa, conambfam.phqpun_cfa");	
	while($rante=mysql_fetch_array($bante))
	{
		$apgpun_cfa=$rante['apgpun_cfa'];
		$phqpun_cfa=$rante['phqpun_cfa'];
		$fecha_cfa=$rante['MaxDefecha_cfa'];	
		$num++;
	}
	
	if($apgpun_cfa>=0 && $apgpun_cfa<10)$dias1=365;
	if($apgpun_cfa>=10 && $apgpun_cfa<14)$dias1=365;
	if($apgpun_cfa>=14 && $apgpun_cfa<18)$dias1=90;
	if($apgpun_cfa>=18 && $apgpun_cfa<=20)$dias1=365;
	
	if($phqpun_cfa>=0 && $phqpun_cfa<5)$dias2=365;
	if($phqpun_cfa>=5 && $phqpun_cfa<10)$dias2=90;
	if($phqpun_cfa>=10 && $phqpun_cfa<15)$dias2=30;
	if($phqpun_cfa>=15 && $phqpun_cfa<20)$dias2=365;
	if($phqpun_cfa>=20 && $phqpun_cfa<=27)$dias2=365;
	
	if($dias1<$dias2)$proximo=$dias1;
	else $proximo=$dias2;
	
	$seg=$proximo*3600*24;	
	
	$fecha=$fecha_cfa." 00:00:00";
	$segundos=$seg + strtotime($fecha);	
		
	$siguiente_evaluacion=gmstrftime ("%Y-%m-%d",$segundos);
	echo"
	<br>
	<center>
	<table align=center class='tbl' border=1 width=80%>
	<tr>
	<th colspan=4>VALORACION ANTERIOR</th>
	<tr>";
	if($num>0)
	{
		echo"<tr>
		<th>APGAR FAMILIAR Y SOPORTE DE AMIGOS</th>
		<th>CUESTIONARIO SOBRE LA SALUD DEL PACIENTE (PHQ-9)</th>
		<th>FECHA EVALUACION</th>
		<th>FECHA PROXIMA EVALUACION</th>
		</tr>
		<tr>	
		<td align=center>$apgpun_cfa</td>
		<td align=center>$phqpun_cfa</td>
		<td align=center>$fecha_cfa</td>
		<td align=center>$siguiente_evaluacion</td>
		</tr>";
	}	
	else
	{
		echo"
		<tr>
		<th colspan=4>NO SE ENCONTRO VALORACIONES ANTERIORES</th>
		<tr>";
	}
		
	echo"</table>
	
	<br>
	<table align=center width=80%  border=1>
	<tr><td>
	<table align=center class='tbl' border=1 width=100%>	
		<tr>
			<th colspan='7'>APAGAR FAMILIAR Y SOPORTE DE AMIGOS</th>
		</tr>
		<tr>
			<td colspan='2' border=1>Para cada pregunta seleciona una opción que parezca aplicar para Usted</td>
			<td>
				<p align=center>Nunca</p>
				<p align=center>0</p>
			</td>
			<td>
				<p align=center>Casi Nunca</p>
				<p align=center>1</p>		
			</td>
			<td>
				<p align=center>Algunas Veces</p>
				<p align=center>2</p>
			</td>
			<td>
				<p align=center>Casi Siempre</p>
				<p align=center>3</p>
			</td>
			<td>
				<p align=center>Siempre</p>
				<p align=center>4</p>
			</td>
		</tr>
		<tr>";
		$n=1;
		$cad="SELECT * FROM destipos WHERE codt_des = 'C0' or codt_des = 'C1'";
		$resul1 = @Mysql_query($cad);
		while($row1 = @mysql_fetch_array($resul1))
		{
			$varcodtde1=$row1['codt_des'];
			if($varcodtde1 == 'C0')	
			{
				$varnomdes1=$row1['nomb_des'];
				echo"
				<tr>
					<td>$n</td>
					<td>$varnomdes1</td>";
					$nomvari='apgar'.$n;
					$nomvari1=${'apgar'.$n};
					for($i = 1;$i<=5;$i++)
					{
						if($nomvari1==$i)
						{	
							$varcon1="checked";
						}
						else
						{
							$varcon1=" ";
						}
						echo"<td><p align=center><input type=radio $varcon1 name=$nomvari value=$i onClick='consolidar()'></p></td>";
					}		
					$n++;
				echo"</tr>";
			}
			if($varcodtde1 == 'C1')	
			{
				$apgaracci=$row1['nomb_des'];
				$varran1=$row1['homo_esp'];
				$varran2=$row1['homo2_des'];
				$apgarseve=$row1['valo_des'];
				$apgarfrec=$row1['val2_des'];
				if($httotal1>=$varran1 && $httotal1<=$varran2)	
				{
					echo"
					<tr>
						<td colspan=7>Puntaje: <input type=text readonly name=httotal1 value=$httotal1></td>
					</tr>
					</table>
					<table  align=center class='tbl' border=1 width=100%>
						<tr>
							<td align=center>Puntaje apgar</td>	
							<td align=center>Severidad de la difución familiar</td>
							<td align=center>Acciones propuestas de tratamiento</td>
							<td align=center>Frecuencia en meses</td>	
						</tr>
						<tr>
							<td><input type=text readonly size=3 name=apgarpunta value=$apgarpunta></td>
							<td><textarea readonly name=apgarseve cols=30 rows=1 event.returnValue = true;else event.returnValue = false>$apgarseve</textarea></td>
							<td><textarea readonly name=apgaracci cols=65 rows=2 event.returnValue = true;else event.returnValue = false>$apgaracci</textarea></td>
							<td><input type=text readonly size=9 name=apgarfrec value=$apgarfrec></td>	
						</tr>
					</table>";
				}
			}	
		}   
//INCIO DE FORMULARIO PHQ 
		echo"
		<table align=center class='tbl' border=1 width=100%>
		<tr><th colspan='7'>CUESTIONARIO SOBRE LA SALUD DEL PACIENTE (PHQ-9)</th></tr>
		<tr>
			<td colspan='2' border=1>Durante las dos (2) ultimas semanas ¿Con que frecuencias ha sentido molestias por los siguientes problemas? seleccione su respuesta:</td>
			<td>
				<p align=center>Nunca</p>
				<p align=center>0</p>
			</td>
			<td>
				<p align=center>Varios Días</p>
				<p align=center>1</p>		
			</td>
			<td>
				<p align=center>Mas de la mitad de los días</p>
				<p align=center>2</p>
			</td>
			<td>
				<p align=center>Casi todos los días</p>
				<p align=center>3</p>
			</td>
		</tr>";
		
		$p=1;
		$cad="SELECT * FROM destipos WHERE codt_des = 'C2' or codt_des = 'C3'";
		$resul1 = @Mysql_query($cad);
		while($row1 = @mysql_fetch_array($resul1))
		{
			$varcodtde1=$row1['codt_des'];
			if($varcodtde1 == 'C2')	
			{
				$phqvarnomdes1=$row1['nomb_des'];
				echo"
				<tr>
					<td>$p</td>
					<td>$phqvarnomdes1</td>";
					$phqnomvari='phq'.$p;
					$phqnomvari1=${'phq'.$p};
					for($i = 1;$i<=4;$i++)
					{
						if($phqnomvari1==$i)
						{	
							$phqvarcon1="checked";
						}
						else
						{
							$phqvarcon1=" ";
						}
						echo"<td><p align=center><input type=radio $phqvarcon1 name=$phqnomvari value=$i onClick='phqconsolidar()'></p></td>";
					}		
					$p++;
				echo"</tr>";
			}
			if($varcodtde1 == 'C3')	
			{
				$phqacci=$row1['nomb_des'];
				$phqvarran1=$row1['homo_esp'];
				$phqvarran2=$row1['homo2_des'];
				$phqseve=$row1['valo_des'];
				$phqfrec=$row1['val2_des'];
				if($httotal2>=$phqvarran1 && $httotal2<=$phqvarran2)	
				{
					echo"
					<tr>
						<td colspan=7>Puntaje: <input type=text readonly name=httotal2 value=$httotal2></td>
					</tr>
					</table>
					
					
					<table align=center class='tbl' border=1 width=100%>
						<tr>
							<td align=center>Puntaje phq-9</td>
							<td align=center>Severidad de la depresión</td>
							<td align=center>Acciones propuestas de tratamiento</td>
							<td align=center>Frecuencia en meses</td>
						</tr>	
						<tr>
							<td><input type=text readonly size=3 name=phqpunta value=$phqpunta></td>
							<td><textarea readonly name=phqseve cols=30 rows=1 event.returnValue = true;else event.returnValue = false>$phqseve</textarea></td>
							<td><textarea readonly name=phqacci cols=65 rows=3 event.returnValue = true;else event.returnValue = false>$phqacci</textarea></td>
							<td><input type=text readonly size=7 name=phqfrec value=$phqfrec></td>	
						</tr>
					</table>";
				}
			}	
		}   
	echo"
	<table align=center class='tbl' width=100%>
		<tr><th align=center valign=top height=30><INPUT type=button class='boton' value=Guardar registro onClick='valida()'></th></tr>	
	</table>
	</table>
	</form>";
?>
</body>
</html>