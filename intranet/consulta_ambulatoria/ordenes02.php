<?
	session_register('paciente');
	session_register('Gareanh');
	session_register('datos');
	session_register('Gcontratonh');
	session_register('numcita');
	session_register('Gcod_mediconh'); 
	//ECHO $Gcontratonh;
	if(empty($paciente))
	{
		echo"<br><br><table align=center class='tbl'>
		<tr><th>POR SEGURIDAD SU SESIÓN SE CERRÓ. CIERRE E INGRESE NUEVAMENTE AL PROGRAMA</th></tr>
		</table>";
		exit;
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; ISO-8859-1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
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
$().ready(function() {	
		$("#course2").autocomplete("autocomp3.php", {
		width: 340,		
		minChars: 2,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220
		});	
		$("#course2").result(function(event, data, formatted) {
		$("#course_val2").val(data['1']);
		$("#course_val3").val(data['2']);
		$("#course_esta").val(data['3']);
		});
	});
</script>
<script language="JavaScript">
	function salida()
	{	
		uno.target='';
		uno.action='medica0.php';
		uno.submit();	
	}	
	function elimina(n)
	{	
		uno.itemeli.value=n;		
		uno.target='';
		uno.action='eliminareg.php';
		uno.submit();	
	}		
	function busqueda()
	{	
		uno.codorden.value='';
		uno.desorden.value='';
		uno.obseorden.value='';
		uno.cantorden.value='';
		uno.target='';
		uno.action='ordenes0.php';
		uno.submit();	
	}	
	function valida(ope)
	{		
		
		if(uno.desorden.value=='')
		{
			alert("Seleccione la orden medica");
			uno.desorden.focus();
			return;
		}		
		if(uno.codorden.value=='')
		{
			alert("Seleccione la orden medica");
			uno.desorden.focus();
			return;
		}
		
		if(uno.autovigen.value=='S')
		{
			if(uno.obseorden.value=='')
			{
				alert("Digite la observacion");
				uno.obseorden.focus();
				return;
			}
		}


		
		if(uno.diagorden.value=='')
		{
			alert("Seleccione el diagnostico");
			uno.diagorden.focus();
			return;
		}
		/*
		if(uno.codorden.value=='0634')
		{	
			
			if(uno.cama.value=='0')
			{
				alert("Seleccione la  cama");
				uno.cama.focus();
				return;
			}		
		}
		*/
		uno.claseorden.value=ope;
		
		uno.action='formujusti_captura.php';
		uno.target='';
		uno.submit();	
	}
	function mensa()
	{
		//alert(uno.justi.value);
		if(uno.desorden.value!='')
		{
			uno.obseorden.focus();
		}		
		if(uno.mensaje.value==1)
		{
			alert("Se requiere diligenciar el modulo de diagnosticos");
			return;
		}
		
		if(uno.justi.value=='SI')
		{
			if (confirm("HAY UNA ORDEN VIGENTE\n\nFecha:             "+uno.fecante.value+"\nMedico:          "+uno.medante.value+"\nArea:               "+uno.areante.value+"\nDiagnostico:  "+uno.cieante.value
			+"\n\nSI DECIDE ACEPTAR, DEBE JUSTIFICAR LA ORDEN EN EL CAMPO DE OBSERVACIONES"
			)) 
			{		 
				uno.autovigen.value='S';
			}
			else
			{		 
				uno.codorden.value='';
				uno.desorden.value='';
				uno.claseorden.value='';
				uno.pos.value='';
				uno.vigencia.value='';
				uno.nivel.value='';				
			}
		}		
		
	}
	function disparo()
	{		
		uno.obseorden.focus();
		
	}
	function vercama()
	{		
		if(uno.codorden.value=='0634')
		{			
			uno.cama.style.visibility='visible';
			document.getElementById('cam').innerHTML=' CAMA: ';
		}
		else
		{			
			uno.cama.style.visibility='hidden';	
			document.getElementById('cam').innerHTML='';			
		}
	}
	function salto()
	{
		if (event.keyCode == 13)
        {			
			uno.opcup.value=1;			
			uno.action='ordenes0.php';
			uno.target='';			
			uno.submit();		
		}
	}
	function actualizar()
	{
		if(uno.codorden.value!='')
		{
			uno.target='';
			uno.action='ordenes0.php';
			uno.submit();	
		}		
	}
	function borrar()
	{
		uno.codorden.value='';
	}
</script>


</head>	
<body onload='mensa()'>
<?
	//echo $paciente;
	echo"<form name=uno method=post>
	<input type=hidden name=claseorden>
	<input type=hidden name=codiprg value='5'>
	<input type=hidden name=itemeli>
	<input type=hidden name=opcup>
	<input type=hidden name=autovigen>
	
	<BR><BR>
	<table align=center width=80%>";
	$archivo2='tmp/4HC'.$numcita.'-'.$paciente.'.txt';
	if(file_exists($archivo2)  || $Gcod_mediconh=='98396211')
	{
		echo"<input type=hidden name=mensaje value=0>";
		include ('php/conexion1.php');		
		
		$busorden=mysql_query("SELECT detareferencia.codi_dre, usuario.CODI_USU, referencia.fech_ref, referencia.asol_ref, referencia.msol_ref, detareferencia.ccie_dre, medicos.nom_medi, areas.nom_areas, cie_10.nom_cie10
		FROM (((detareferencia INNER JOIN (referencia INNER JOIN (usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) ON referencia.cuco_ref = ucontrato.IDEN_UCO) ON detareferencia.idre_dre = referencia.idre_ref) LEFT JOIN areas ON referencia.asol_ref = areas.cod_areas) LEFT JOIN medicos ON referencia.msol_ref = medicos.cod_medi) LEFT JOIN cie_10 ON detareferencia.ccie_dre = cie_10.cod_cie10
		WHERE (((detareferencia.codi_dre)='$codorden') AND ((usuario.CODI_USU)='$paciente'))
		ORDER BY referencia.fech_ref");
		
		$num=mysql_num_rows($busorden);
		$jus="NO";
		$fecante='';
		$medante='';
		$areante='';
		$cieante='';
		if($num>0)
		{		
			$rord=mysql_fetch_array($busorden);
			$fecante=$rord['fech_ref'];
			$medante=$rord['nom_medi'];
			$areante=$rord['nom_areas'];
			$cieante=$rord['nom_cie10'];
			$dias=cuentadias($fecante);			
			if(cuentadias($fecante)<$vigencia)
			{
				$jus="SI";					
			}			
		}
		echo"<input type=hidden name=fecante value='$fecante'>";
		echo"<input type=hidden name=medante value='$medante'>";
		echo"<input type=hidden name=areante value='$areante'>";
		echo"<input type=hidden name=cieante value='$cieante'>";
		echo"<input type=hidden name=justi value='$jus'>";
		
		
		//echo 'DIAS '.$dias.' - FECHA '.$fecante.' - VIGENCIA '.$vigencia;
		
			
		echo"		
		<TR><TD>
		<table align=center class='tbl' width=100%>
		<tr><th>ORDENES MEDICAS Y REMISIONES</th></tr>
		</table>
		<br><br>";
		
		echo"		
		<table align=center class='tbl' width=100%>";
		$archivo2='tmp/4HC'.$numcita.'-'.$paciente.'.txt';	
		if(file_exists($archivo2))
		{
			$fp = fopen ($archivo2, "r" );
			$reg1=0;
			while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
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
		/*
		if($tipoorden==1)
		{
		*/
			
			if($opcup==1)
			{
				$largo=strlen($codorden);
				if($largo==4)
				{
					$sql=mysql_query("SELECT destipos.codi_des AS cod, destipos.nomb_des AS des, esta_especialidad.esta_esp AS niv
					FROM destipos INNER JOIN esta_especialidad ON destipos.codi_des = esta_especialidad.codi_esp
					WHERE (((destipos.codi_des) = '$codorden') AND ((destipos.codt_des)='06'))");				
				}
				else
				{
					$sql=mysql_query("select codigo AS cod,descrip AS des, nive_cup AS niv from cups where nive_cup<>0 and codigo = '$codorden'");
				}
				IF (mysql_num_rows($sql)>0)
				{
					WHILE($rs = mysql_fetch_array($sql)) 
					{
						$cid = $rs['cod'];
						$cname = $rs['des'];
						$nive = $rs['niv'];	
						$lar=strlen($cid);
						$cad='';
						if($lar==4 || $lar==6)
						{
							if($lar==4)
							{
								$cname="REMISION A ".$cname;
								$clase='2';
							}
							else
							{
								$clase='1';
							}
							
							$ini=substr($cid,0,2);
							if($ini!='89')
							{								
								if($nive<3 || $nive=='1402')
								{
									$nive='CITAS';									
								}
								else			
								{
									$nive='REFERENCIA';
								}
								$cname=strtoupper($cname);
								//ECHO "$cname|$cid|$nive|$clase\n";								
								$desorden=$cname;
								$nivel=$nive;
								$claseorden=$clase;
							}
						}
					}	
				}
				
				$bdes=mysql_query("select * from cups where codigo='$codorden'");
				while($rdes=mysql_fetch_array($bdes))
				{
					$desorden=$rdes['descrip'];
				}			
			}
			if(empty($cantorden))$cantorden=1;
			ECHO"<tr>
			<th>CODIGO CUPS</th>
			<th>DESCRIPCION ORDEN</th>
			<th>OBSERVACION</th>
			<th>CANTIDAD</th>
			</tr>			
			<tr>
			<input type=hidden id='course_opc' name=claseorden value=$claseorden>
			<input type=hidden id='posord' name=pos value=$pos>
			<input type=hidden id='vigen' name=vigencia value=$vigencia>
			
			<td align=center><input type='text' class=caja id='course_val' name='codorden' size=6 onkeypress='salto()'  value='$codorden'></td>
			<td align=center valign='TOP'><textarea onPaste='return false' id='course' class='caja' name='desorden' onKeypress='borrar()' onBlur=actualizar() rows=2 cols=68>$desorden</textarea> ";
			if($Gcontratonh=='002')ECHO"<input type=text onPaste='return false' class=caja name=nivel id='course_niv' size=12 onfocus='disparo()' value='$nivel'></span></td>";
			ECHO"
			<td align=center><textarea onPaste='return false' class='caja' name='obseorden' rows=2 cols=68>$obseorden</textarea></td>
			<td align=center><input type=text onPaste='return false' class='caja' name='cantorden' size=4 value='$cantorden'></td>			
			</tr>			
			
			<tr><th colspan=4>DIAGNOSTICO <select class='caja' name=diagorden>
			<option value=''></option>
			<option value=$cod>$map</option>
			<option value=$cod1>$map1</option>
			<option value=$cod2>$map2</option>
			<option value=$cod3>$map3</option>
			</select>
			</td>
			</tr>
			<tr><th colspan=4 align=center valign=top height=20><INPUT type=button class='boton' value= GUARDAR onClick='valida(1);'></th></tr>	
			</tr>";
		
		echo"</table>
		<br><br>
		<table align=center class='tbl' width=100%>";		
		$archivo='tmp/5HC'.$numcita.'-'.$paciente.'.txt';	
		if(file_exists($archivo))
		{
			echo"<tr>
			<th align=center>ELIMINAR</th>
			<th align=center>DIAGNOSTICO</th>
			<th>CODIGO</th>
			<th>DESCRIPCION</th>";
			IF($Gcontratonh=='002')ECHO"<th>DESTINO</th>";
			ECHO"
			<th>OBSERVACION</th>";
			if($Gareanh=='04')
			{
				echo"<th>CAMA</th>";
			}
			echo"</tr>";			
			$fp = fopen ($archivo, "r" );
			$reg=0;
			$cont=0;
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
					$bcodor=mysql_query("select codi_cup from cups where codigo='$codorden'");
					if(mysql_num_rows($bcodor)>0)
					{
						$rcodor=mysql_fetch_array($bcodor);
						$codor=$rcodor['codi_cup'];
					}
					else
					{
						$codor=$codorden;
					}
					echo"<tr>
					<td align=center><a href='#' onclick='elimina($cont)'><img src='img/eli.png' border=0></a></td>
					<td align=center>$diagorden</td>
					<td align=center>$codor</td>
					<td>$desorden</td>";
					IF($Gcontratonh=='002')ECHO"<td>$nivel-$claseorden</td>";
					ECHO"
					<td>$obseorden</td>";
					if($Gareanh=='04')
					{
						echo"<td align=center>$cama</td>";
					}
					echo"</tr>";
					$cont=$cont+1;
				}				
			}
		}
		echo"<input type=hidden name=variables value='8'>";
		ECHO"</TABLE>";
		$archivo='tmp/5HC'.$numcita.'-'.$paciente.'.txt';	
		if(file_exists($archivo))
		{
			echo"<br><br><table align=center class='tbl' width=100%>
			<tr><th colspan=2 align=center valign=top height=20><INPUT type=button class='boton' value= FINALIZAR onClick='salida()'></th></tr>	
			</table>";
		}
	}	
	else
	{
		echo"<input type=hidden name=mensaje value=1>";
	}
	echo"</td></tr></table></form>";
	function cuentadias($fant)
	{
		$anoj=substr($fant,0,4);
		$mesj=substr($fant,5,2);
		$diaj=substr($fant,8,2)+$tiempo;		
		$numant=gmmktime ( 00, 00, 00, $mesj, $diaj, $anoj);			
		$hoy=date('Y-m-d');
		$anoh=substr($hoy,0,4);
		$mesh=substr($hoy,5,2);
		$diah=substr($hoy,8,2)+$tiempo;	
		$numhoy=gmmktime ( 00, 00, 00, $mesh, $diah, $anoh);
		$difer=$numhoy-$numant;
		$dias=$difer/86400;
		return $dias;
	}
?>
</body>
</html>