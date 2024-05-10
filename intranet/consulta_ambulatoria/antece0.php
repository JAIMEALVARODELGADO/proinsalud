<?
	session_register('paciente');
	session_register('numcita');
	session_register('Gcod_mediconh');
	if(empty($paciente))
	{
		echo"<br><br><table align=center class='tbl'>
		<tr><th>POR SEGURIDAD SU SESIÓN SE CERRÓ. EIERRE E INGRESE NUEVAMENTE AL PROGRAMA</th></tr>
		</table>";
		exit;
	}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />  
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<link rel="stylesheet" href="style.css" type="text/css"/> 
<script language="JavaScript">
function valida()
	{		
		if(uno.person.value=='')
		{
			alert("Digite los antecedentes personales del paciente");
			uno.person.focus();
			return;
		}		
		if(uno.familia.value=='')
		{
			alert("Digite los antecedentes familiares del paciente");
			uno.familia.focus();
			return;
		}
		if(uno.ginsi.value==1)
		{
			if(uno.gineco.value=='')
			{
				alert("Digite los antecedentes gineco-obstetricos del paciente");
				uno.gineco.focus();
				return;
			}
			if(uno.gestan.value=='')
			{
				alert("Digite el numero de gestas del paciente");
				uno.gestan.focus();
				return;
			}
			if(uno.partos.value=='')
			{
				alert("Digite el numero de partos del paciente");
				uno.partos.focus();
				return;
			}
			if(uno.cesareas.value=='')
			{
				alert("Digite el numero de cesareas del paciente");
				uno.cesareas.focus();
				return;
			}
			if(uno.abortos.value=='')
			{
				alert("Digite el numero de abortos del paciente");
				uno.abortos.focus();
				return;
			}
			if(uno.vivos.value=='')
			{
				alert("Digite el numero de hijos nacidos vivos del paciente");
				uno.vivos.focus();
				return;
			}
			if(uno.mortinatos.value=='')
			{
				alert("Digite el numero de mortinatos del paciente");
				uno.mortinatos.focus();
				return;
			}
			
		}
		uno.action='almacena.php';
		uno.target='';
		uno.submit();	
	}	
</script>
</head>	
<body>
<?
	include ('php/conexion1.php');
	$cadpac=mysql_query("select * from usuario where CODI_USU = '$paciente'");
	while($rpac=mysql_fetch_array($cadpac))
	{
		$sexo=$rpac['SEXO_USU'];
		$fnac=$rpac['FNAC_USU'];
		$edad=calcula_edad($fnac);
	}
	
	$archivodolor='tmp/HCDOLOR'.$numcita.'-'.$paciente.'.txt';	
	if(file_exists($archivodolor)==TRUE)
	{
		if(empty($nuecardiovasculares) || empty($nuepulmonar) || empty($nuequirurgicos) || empty($neofarmacos) || empty($nuetoxico) || empty($neotransfin) || empty($neootros))
		{
		
			$cadanteanes=mysql_query("SELECT anteced_aneste.id_anes, anteced_aneste.numcit_anes, anteced_aneste.numcon_anes, 
			anteced_aneste.patolo_anes, anteced_aneste.cardiovas_anes, anteced_aneste.pulmon_anes, anteced_aneste.quiru_anes, 
			anteced_aneste.farma_anes, anteced_aneste.toxico_anes, anteced_aneste.transfun_anes, anteced_aneste.gineco_anes, 
			anteced_aneste.otros_anes, anteced_aneste.metpla_anes, anteced_aneste.numero_cons
			FROM anteced_aneste INNER JOIN encabesadohistoria ON anteced_aneste.numcon_anes = encabesadohistoria.numc_ehi
			WHERE (((encabesadohistoria.cous_ehi)='$paciente'))");
			
			
			while($rpacanes=mysql_fetch_array($cadanteanes))
			{
				//$nuepatologicos8=$rpacanes['nuepatologicos'];
				$nuecardiovasculares8=$rpacanes['cardiovas_anes'];
				$nuepulmonar8=$rpacanes['pulmon_anes'];
				$nuequirurgicos8=$rpacanes['quiru_anes'];
				$neofarmacos8=$rpacanes['farma_anes'];
				$nuetoxico8=$rpacanes['toxico_anes'];
				$neotransfin8=$rpacanes['transfun_anes'];
				$neootros8=$rpacanes['otros_anes'];
				
				
			
			}
		}
	}	
	if(empty($person) || (empty($familia)))
	{
		
		$bfante=mysql_query("SELECT Max(consultaprincipal.iden_cpl) AS MáxDeiden_cpl
		FROM encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl
		WHERE (((encabesadohistoria.cous_ehi)='$paciente') AND ((consultaprincipal.codi_cpl)='1') AND ((consultaprincipal.anteper_cpl)<>'' And (consultaprincipal.anteper_cpl)<>'.'))");
		while($rfante=mysql_fetch_array($bfante))
		{
			$maxcon=$rfante['MáxDeiden_cpl'];			
		}
		$bante=mysql_query("SELECT consultaprincipal.iden_cpl, consultaprincipal.antefam_cpl, consultaprincipal.anteper_cpl
		FROM consultaprincipal WHERE (((consultaprincipal.iden_cpl)='$maxcon') AND consultaprincipal.antefam_cpl<>'')");
		while($rante=mysql_fetch_array($bante))
		{
			$antefam=$rante['antefam_cpl'];
			$anteper=$rante['anteper_cpl'];
			$metopla=$rante['mepl_cpl'];
		}		
	}
	if(empty($gineco))
	{	
		$bfgine=mysql_query("SELECT Max(antefemeninos.iden_afe) AS MáxDeiden_afe
		FROM encabesadohistoria INNER JOIN antefemeninos ON encabesadohistoria.numc_ehi = antefemeninos.numc_afe
		WHERE (((encabesadohistoria.cous_ehi)='$paciente') AND antefemeninos.ante_afe<>'')");
		
		while($rfgine=mysql_fetch_array($bfgine))
		{
			$maxfen=$rfgine['MáxDeiden_afe'];
		}	
		
		$bgine=mysql_query("SELECT antefemeninos.iden_afe, antefemeninos.ante_afe
		FROM antefemeninos WHERE (((antefemeninos.iden_afe)='$maxfen'))");
		while($rgine=mysql_fetch_array($bgine))
		{			
			$antefem=$rgine['ante_afe'];			
		}	
	}
	$archivo='tmp/2HC'.$numcita.'-'.$paciente.'.txt';		
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
	if(empty($person))$person=$anteper;
	if(empty($familia))$familia=$antefam;	
	if(empty($metodo))$metodo=$metopla;
	if(empty($gineco))$gineco=$antefem;
	
	$person=str_replace( "Æ",chr(10),$person);
	$familia=str_replace( "Æ",chr(10),$familia);
	$metodo=str_replace( "Æ",chr(10),$metodo);
	$gineco=str_replace( "Æ",chr(10),$gineco);
	
	echo"
	<form name=uno method=post>
	<input type=hidden name=codiprg value='2'>
	<br>	
	<center><table align=center width=70%>	
	<TR><TD>
	<table align=center class='tbl' width=100%>	
	<tr><th align=center colspan=2>ANTECEDENTES</th></tr>
	</table>
	<br><br>
	<table align=center class='tbl' width=100%>";
	
		
	if(file_exists($archivodolor)==TRUE)
	{
		//if(empty($nuepatologicos))$nuepatologicos=$nuepatologicos8;
		if(empty($nuecardiovasculares))$nuecardiovasculares=$nuecardiovasculares8;
		if(empty($nuepulmonar))$nuepulmonar=$nuepulmonar8;
		if(empty($nuequirurgicos))$nuequirurgicos=$nuequirurgicos8;
		if(empty($neofarmacos))$neofarmacos=$neofarmacos8;
		if(empty($nuetoxico))$nuetoxico=$nuetoxico8;
		if(empty($neotransfin))$neotransfin=$neotransfin8;
		if(empty($neootros))$neootros=$neootros8;
		
		//<tr><th width='18%'>PATOLOGICOS</td><td><textarea class='caja' name=nuepatologicos cols=120 rows=5 onKeypress='if (event.keyCode == 13) event.returnValue = false' placeholder='Negativo'>$nuepatologicos</textarea></td></tr>
		
		echo"
		
		<tr><th width=18%>CARDIOVASCULARES</td><td><textarea class='caja' name=nuecardiovasculares cols=120 rows=5 onKeypress='if (event.keyCode == 13) event.returnValue = false' placeholder='Negativo'>$nuecardiovasculares</textarea></td></tr>
		<tr><th width=18%>PULMONARES</td><td><textarea class='caja' name=nuepulmonar cols=120 rows=5 onKeypress='if (event.keyCode == 13) event.returnValue = false' placeholder='Negativo'>$nuepulmonar</textarea></td></tr>
		<tr><th width=18%>QUIRURGICOS-ANALGESICOS</td><td><textarea class='caja' name=nuequirurgicos cols=120 rows=5 onKeypress='if (event.keyCode == 13) event.returnValue = false' placeholder='Negativo'>$nuequirurgicos</textarea></td></tr>
		<tr><th width=18%>FARMACOLOGICOS</td><td><textarea class='caja' name=neofarmacos cols=120 rows=5 onKeypress='if (event.keyCode == 13) event.returnValue = false' placeholder='Negativo'>$neofarmacos</textarea></td></tr>
		<tr><th width=18%>TOXICO/ALERGICOS</td><td><textarea class='caja' name=nuetoxico cols=120 rows=5 onKeypress='if (event.keyCode == 13) event.returnValue = false' placeholder='Negativo'>$nuetoxico</textarea></td></tr>
		<tr><th width=18%>TRANFUNCIONALES</td><td><textarea class='caja' name=neotransfin cols=120 rows=5 onKeypress='if (event.keyCode == 13) event.returnValue = false' placeholder='Negativo'>$neotransfin</textarea></td></tr>";

//		<tr><th width='18%'>GINECOBSTETRICOS</td><td><textarea onPaste='return false' class='caja' name=neogineco cols=120 rows=5 onKeypress='if (event.keyCode == 13) event.returnValue = false'>$neogineco</textarea></td></tr>
		
		
		echo"
		<tr><th width=18%>OTROS</td><td><textarea onPaste='return false' class='caja' name=neootros cols=120 rows=5 onKeypress='if (event.keyCode == 13) event.returnValue = false' placeholder='Ninguno'>$neootros</textarea></td></tr>
		<input type=hidden name=person value='2'>
		<input type=hidden name=familia value='2'>
		<input type=hidden name=metodo value='2'>";
	}
	else
	{
		echo"<tr><th width=18%>PERSONALES<br><br>Patológicos, Quirúrgicos, traumáticos, toxicoalergicos</td><td><textarea onPaste='return false' class='caja' name=person cols=120 rows=5 onKeypress='if (event.keyCode == 13) event.returnValue = false'>$person</textarea></td></tr>";
		echo"<tr><th width=18%>FAMILIARES</td><td><textarea onPaste='return false' class='caja' name=familia cols=120 rows=5 onKeypress='if (event.keyCode == 13) event.returnValue = false'>$familia</textarea></td></tr>";
		echo"<tr><th width=18%>METODOS DE PLANIFICACION</td><td><textarea onPaste='return false' class='caja' name=metodo cols=120 rows=3 onKeypress='if (event.keyCode == 13) event.returnValue = false'>$metodo</textarea></td></tr>";
	}	
	echo"
	</table>";
	$pasa=0;
	if($sexo=='F' && $edad>=10)
	{
		//if($Gcod_mediconh=='98396211')
		//{
			$archivo='tmp/2HC'.$numcita.'-'.$paciente.'.txt';		
			if(file_exists($archivo))$si='S';
			else
			{
				$bmax=mysql_query("SELECT consultaprincipal.iden_cpl, antefemeninos.numc_afe, antefemeninos.gest_afe, antefemeninos.part_afe, antefemeninos.cesa_afe, antefemeninos.abor_afe, antefemeninos.vivo_afe, antefemeninos.mort_afe
				FROM encabesadohistoria INNER JOIN (antefemeninos INNER JOIN consultaprincipal ON antefemeninos.numc_afe = consultaprincipal.numc_cpl) ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl
				WHERE (((antefemeninos.gest_afe)<>'' And (antefemeninos.gest_afe)<>'.') AND ((encabesadohistoria.cous_ehi)='$paciente'))
				ORDER BY consultaprincipal.iden_cpl");				
				
				while($rfem=mysql_fetch_array($bmax))
				{					
					$maxcon=$rfem['iden_cpl'];
					$gestan=$rfem['gest_afe'];
					$partos=$rfem['part_afe'];
					$cesareas=$rfem['cesa_afe'];
					$abortos=$rfem['abor_afe'];
					$vivos=$rfem['vivo_afe'];
					$mortinatos=$rfem['mort_afe'];			
				}	
				
			}
		//}
			
		$pasa=1;
		echo"
		<table align=center class='tbl' width=100%>	
		<tr><th width=18%>GINECO-OBSTETRICOS<br><br> Menarquia, fecha ultima citologia</td>
		<td><textarea onPaste='return false' class='caja' name=gineco cols=120 rows=5 onKeypress='if (event.keyCode == 13) event.returnValue = false'>$gineco</textarea></td></tr>
		</table>
		<br><br>
		
		<table align=center class='tbl' width=100%>	
		<tr>
		<th>GESTAN</th>
		<th>PARTOS</th>
		<th>CESAREAS</th>
		<th>ABORTOS</th>
		<th>VIVOS</th>
		<th>MORTINATOS</th>
		<th>F.U.M.</th>
		</tr>
		<tr>
		<td align=center><input type=text onPaste='return false' class=caja size=4 name=gestan onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;' value='$gestan'></td>
		<td align=center><input type=text onPaste='return false' class=caja size=4 name=partos onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;' value='$partos'></td>
		<td align=center><input type=text onPaste='return false' class=caja size=4 name=cesareas onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;' value='$cesareas'></td>
		<td align=center><input type=text onPaste='return false' class=caja size=4 name=abortos onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;' value='$abortos'></td>
		<td align=center><input type=text onPaste='return false' class=caja size=4 name=vivos onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;' value='$vivos'></td>
		<td align=center><input type=text onPaste='return false' class=caja size=4 name=mortinatos onKeypress='if ((event.keyCode > 47 && event.keyCode <58))event.returnValue = true;else event.returnValue = false;' value='$mortinatos'></td>		
		<td align=center>";
		?>
			<input type="text" name="feulme" class='caja' size="10" maxlength="10" value="<?echo $feulme;?>" id="fini" <?echo $disp;?>>
			<input type="button" class='caja' id="lanzador1" value="..." <?echo $disp;?>/>
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
		</table>";		
	}
	echo"<input type=hidden name=ginsi value='$pasa'>";
	echo"
	<br><br>
	<table align=center class='tbl' width=100%>
	<tr><th colspan=3 align=center valign=top height=20><INPUT type=button class='boton' value='Guardar' onClick='valida();'></th></tr>	
	</table>
	</table>";
    function calcula_edad($fecha_nac)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en números enteros
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