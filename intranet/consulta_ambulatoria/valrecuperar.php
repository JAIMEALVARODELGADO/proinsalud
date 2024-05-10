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
		uno.action='valfamilia1.php';		
		uno.target='';
		uno.submit();
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

/*
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

*/	
	
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
	$variable1=1;
	$cad2 = "SELECT conambfam.codi_usu, conambfam.apgar1_cfa, conambfam.apgar2_cfa, conambfam.apgar3_cfa, conambfam.apgar4_cfa, conambfam.apgar5_cfa, conambfam.apgar5_cfa, conambfam.apgpun_cfa,
			conambfam.phq1_cfa, conambfam.phq2_cfa,	conambfam.phq3_cfa, conambfam.phq4_cfa, conambfam.phq5_cfa, conambfam.phq6_cfa, conambfam.phq7_cfa, conambfam.phq8_cfa, conambfam.phq9_cfa,
			conambfam.phqpun_cfa, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU
			FROM conambfam INNER JOIN usuario ON conambfam.codi_usu = usuario.CODI_USU
			WHERE (((conambfam.codi_usu)=$variable1))";
	$resul2 = @Mysql_query($cad2);
	while($row2 = @mysql_fetch_array($resul2))
	{
		$varnom1=$row2['PNOM_USU'];
		$varnom2=$row2['SNOM_USU'];
		$varape1=$row2['PAPE_USU'];
		$varape2=$row2['SAPE_USU'];		
		$apgar1=$row2['apgar1_cfa'];
		$apgar2=$row2['apgar2_cfa'];
		$apgar3=$row2['apgar3_cfa'];
		$apgar4=$row2['apgar4_cfa'];
		$apgar5=$row2['apgar5_cfa'];
		$httotal1=$row2['apgpun_cfa'];	
		$phq1=$row2['phq1_cfa'];
		$phq2=$row2['phq2_cfa'];
		$phq3=$row2['phq3_cfa'];
		$phq4=$row2['phq4_cfa'];
		$phq5=$row2['phq5_cfa'];
		$phq6=$row2['phq6_cfa'];
		$phq7=$row2['phq7_cfa'];
		$phq8=$row2['phq8_cfa'];
		$phq9=$row2['phq9_cfa'];
		$httotal2=$row2['phqpun_cfa'];
	}
	echo"
	<br>
	<table align=center width=80%  border=1>
	<tr><td>
	
	
	
	<table align=center class='tbl' border=1 width=100%>
		<tr>
			<th colspan='7'>INFORMACIÓN DEL PACIENTE</th>
		</tr>
		<tr>
			<td>
			<p align=center>Primer Nombre</p>
			</td>
			<td>
				<p align=center>Segundo Nombre</p>
			</td>
			<td>
				<p align=center>Primer Apellido</p>
			</td>
			<td>
				<p align=center>Segundo Apellido</p>
			</td>
		</tr>
		<tr>
			<td>
			<p align=center>$varnom1</p>
			</td>
			<td>
				<p align=center>$varnom2</p>
			</td>
			<td>
				<p align=center>$varape1</p>
			</td>
			<td>
				<p align=center>$varape2</p>
			</td>
		</tr>
	</table>


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
						echo"<td><p align=center><input type=radio disabled $varcon1 name=$nomvari value=$i onClick='consolidar()'></p></td>";
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
							<td><input type=text readonly size=3 name=apgarpunta value=$httotal1></td>
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
						echo"<td><p align=center><input type=radio disabled $phqvarcon1 name=$phqnomvari value=$i onClick='phqconsolidar()'></p></td>";
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
							<td><input type=text readonly size=3 name=phqpunta value=$httotal2></td>
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
		<tr><th align=center valign=top height=30><INPUT type=button class='boton' value=Retornar registro onClick='valida()'></th></tr>	
	</table>
	</table>
	</form>";
?>
</body>
</html>