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
		width: 0,		
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
		if(ope==1)
		{			
			uno.claseorden.value=1;
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
		}
		if(ope==2)
		{			
			uno.claseorden.value=2;
			if(uno.codorden.value=='')
			{
				alert("Seleccione la orden medica");
				uno.desorden.focus();
				return;
			}
			if(uno.diagorden.value=='')
			{
				alert("Seleccione el diagnostico");
				uno.diagorden.focus();
				return;
			}
		}
		if(ope==3)
		{
			uno.claseorden.value=3;
			if(uno.codorden.value=='')
			{
				alert("Seleccione la orden medica");
				uno.desorden.focus();
				return;
			}
			if(uno.diagorden.value=='')
			{
				alert("Seleccione el diagnostico");
				uno.diagorden.focus();
				return;
			}
		}
		if(ope==4)
		{
			uno.claseorden.value=4;
			if(uno.cantorden.value=='')
			{
				alert("Seleccione el proximo control");
				uno.desorden.focus();
				return;
			}
			
			if(uno.codorden.value=='')
			{
				alert("Seleccione la orden medica");
				uno.desorden.focus();
				return;
			}
			
			if(uno.diagorden.value=='')
			{
				alert("Seleccione el diagnostico");
				uno.diagorden.focus();
				return;
			}
		}
		if(ope==5)
		{
			uno.claseorden.value=5;
			uno.codorden.value='0000000000';
			
		}
		uno.action='formujusti_captura.php';
		uno.target='';
		uno.submit();	
	}
	function mensa()
	{
			
		if(uno.abremod.value=='1')
		{
			document.getElementById('openModal').style.display = 'block';
		}
		else
		{
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
	
	
	
	
	function CloseModal() 
	{
		document.getElementById('openModal').style.display = 'none';
	}
	function cargamodal(n)
	{
		uno.abremod.value='1';
		uno.opcion.value=n;
		uno.target='';
		uno.action='ordenes0.php';
		uno.submit();
	}
	function obse()
	{
		$cant=uno.cantorden.value;
		if($cant==1)uno.obseorden.value='1 mes';
		if($cant>1)uno.obseorden.value=$cant+' meses';
	}
	cantorden
	
</script>
<style>

	.modalDialog {
	position: fixed;
	font-family: Arial, Helvetica, sans-serif;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background: rgba(0,0,0,0.8);
	z-index: 99999;
	display:none;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: auto;
	overflow: auto;
}
.modalDialog > div {
	width: 60%;
	position: relative;
	margin: 2% auto;
	padding: 5px 20px 13px 20px;
	border-radius: 10px;
	background: #fff;
	background: -moz-linear-gradient(#fff, #eee);
	background: -webkit-linear-gradient(#fff, #eee);
	background: -o-linear-gradient(#fff, #eee);
  -webkit-transition: opacity 400ms ease-in;
-moz-transition: opacity 400ms ease-in;
transition: opacity 400ms ease-in;
}
.close {
	background: #606061;
	color: #FFFFFF;
	line-height: 25px;
	position: absolute;
	right: -12px;
	text-align: center;
	top: -10px;
	width: 24px;
	text-decoration: none;
	font-weight: bold;
	-webkit-border-radius: 12px;
	-moz-border-radius: 12px;
	border-radius: 12px;
	-moz-box-shadow: 1px 1px 3px #000;
	-webkit-box-shadow: 1px 1px 3px #000;
	box-shadow: 1px 1px 3px #000;
}
.close:hover { background: #00d9ff; }
</style>

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
	
	<input type=hidden name=abremod value='$abremod'>
	<input type=hidden name=opcion value='$opcion'>
	
	<BR><BR>
	<center><table align=center width=80%>";
	$archivo2='tmp/4HC'.$numcita.'-'.$paciente.'.txt';
	if(file_exists($archivo2)  || $Gcod_mediconh=='98396211')
	{
		echo"<input type=hidden name=mensaje value=0>";
		include ('php/conexion1.php');		
		
		$consultamag="SELECT REGMAG_CON FROM contrato WHERE CODI_CON='$Gcontratonh'";
		$consultamag=mysql_query($consultamag);
		$rowmag=mysql_fetch_array($consultamag);
		$regmag_con=$rowmag[REGMAG_CON];

		
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
		<tr>
		<th width='50%'>ORDENES MEDICAS</th>
		<th>REFERENCIA Y CONTRAREFERENCIA</th>
		</tr>
		<tr>
		<th><INPUT type=button class='boton2' value= 'ORDENES' onClick='cargamodal(1)'></th>
		<th>
		<INPUT type=button class='boton2' value= 'REFERENCIA' onClick='cargamodal(2)'>
		<INPUT type=button class='boton2' value= 'CONTRAREFERENCIA' onClick='cargamodal(3)'>
		<INPUT type=button class='boton2' value= 'CONTROL' onClick='cargamodal(4)'>
		<INPUT type=button class='boton2' value= 'ALTA' onClick='cargamodal(5)'>
		</th>
		</table>
		<br><br>
		
		
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
			IF($regmag_con=='S')ECHO"<th>DESTINO</th>";
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
					$bcodor=mysql_query("select codi_cup from cups where codi_cup='$codorden' and esta_cup='AC'");
					if(mysql_num_rows($bcodor)>0)
					{
						$rcodor=mysql_fetch_array($bcodor);
						$codor=$rcodor['codi_cup'];
					}
					else
					{
						$codor=$codorden;
					}
					if(strlen($codorden)==4 && substr($codorden,0,2)=='06')
					{
						$bdtps=	MYSQL_QUERY("SELECT * FROM destipos WHERE codi_des='$codorden'");
						$rdtps=mysql_fetch_array($bdtps);
						$desorden=strtoupper($rdtps['nomb_des']);
						$nive=$rdtps['nive_cup'];
						
						if($nive<3 || $nive=='1402')
						{
							$nivel='CITAS';									
						}
						else			
						{
							$nivel='REFERENCIA';
						}
					}
					if($codorden=="0000000000")
					{
						$diagorden="";
						$codor="";
						$desorden="ALTA MEDICA";
						
						
					}
					echo"<tr>
					<td align=center><a href='#' onclick='elimina($cont)'><img src='img/eli.png' border=0></a></td>
					<td align=center>$diagorden</td>
					<td align=center>$codor</td>
					<td>$desorden</td>";
					IF($regmag_con=='S')ECHO"<td>$nivel-$claseorden</td>";
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
	
	// 3343 3351
	
	
	
	
	
	
	
	
	echo"
	<div id='openModal' class='modalDialog'>
	<div>
		<a href='#close' title='Close' class='close' onclick='javascript:CloseModal();'>X</a>";
		echo 
		
		"<BR><BR>
		<table align=center class='tbl' width=100%>
		<tr><th>";
		if($opcion==1)echo "ORDENES MEDICAS";
		if($opcion==2)echo "REFERENCIA MEDICA";
		if($opcion==3)echo "CONTRAREFERENCIA MEDICA";
		if($opcion==4)echo "CONTROL MEDICO";
		if($opcion==5)echo "ALTA MEDICA";
		echo"
		</th></tr>
		</table>
		<br><br>";
		
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
		
		if($opcion==1)
		{
			
			//<form name=uno method=post>
			echo"
			
			<BR><BR>
			<center><table align=center width=80%>";
			$archivo2='tmp/4HC'.$numcita.'-'.$paciente.'.txt';
			if(file_exists($archivo2)  || $Gcod_mediconh=='98396211' || $Gcod_mediconh=='1102008')
			{
				echo"<input type=hidden name=mensaje value=0>";
				include ('php/conexion1.php');		
				
				$consultamag="SELECT REGMAG_CON FROM contrato WHERE CODI_CON='$Gcontratonh'";
				$consultamag=mysql_query($consultamag);
				$rowmag=mysql_fetch_array($consultamag);
				$regmag_con=$rowmag[REGMAG_CON];

				
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
				";
				
				echo"		
				<table align=center class='tbl' width=100%>";
				
				
				/*if($tipoorden==1)
				{*/
				
					
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
						 $sql=mysql_query("select codi_cup AS cod,descrip AS des, nive_cup AS niv from cups where nive_cup<>0 and codi_cup = '$codorden' and esta_cup='AC'");
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
					
					$bdes=mysql_query("select * from cups where codi_cup='$codorden' and esta_cup='AC'");
					while($rdes=mysql_fetch_array($bdes))
					{
						$desorden=$rdes['descrip'];
					}			
				}
				if(empty($cantorden))$cantorden=1;
				ECHO"
				<input type=hidden id='course_opc' name=claseorden>
				<input type=hidden id='posord' name=pos>
				<input type=hidden id='vigen' name=vigencia>
				
				<input type='hidden' id='course_val' name='codorden'>
				<tr>
				<th>SERVICIO</th>
				<td valign='TOP'>
				<textarea onPaste='return false' id='course' class='caja' name='desorden' onKeypress='borrar()' placeholder='Digite el codigo o la descripcion del CUPS' rows=2 cols=68></textarea>
				</td>
				</tr>";
				
				echo"<input type=hidden name=nivel id='course_niv'>";
					
				echo"
				<tr>
				<th>OBSERVACION</th>
				<td><textarea onPaste='return false' class='caja' name='obseorden' rows=2 cols=68></textarea></td>
				</tr>
				<tr>
				<th>CANTIDAD</th>
				<td><input type=text onPaste='return false' class='caja' name='cantorden' size=4 value='$cantorden'></td>			
				</tr>			
				
				<tr>
				<th>DIAGNOSTICO</th> 
				<td>
				<select class='caja' name=diagorden>
				<option value=''></option>
				<option value=$cod>$map</option>
				<option value=$cod1>$map1</option>
				<option value=$cod2>$map2</option>
				<option value=$cod3>$map3</option>
				</select>
				</td>
				</tr>
				</table>";
			}
		}
		
		if($opcion=='2') //REFERENCIA
		{
			
			$besp=mysql_query("SELECT * FROM destipos WHERE valo_des='$Gareanh' AND codt_des='06'");
			$resp=mysql_fetch_array($besp);
			$espeordena=$resp['codi_des'];
			
			$med=mysql_query("SELECT espe_med FROM medicos WHERE medicos.cod_medi='$Gcod_mediconh'");
			$rowmed = mysql_fetch_array($med);
			$codespe=$rowmed['espe_med'];	
			if($codespe=='2655')$especi='2';
			else $especi='1';
			
			$bref=mysql_query("SELECT destipos.codi_des, destipos.nomb_des
			FROM destipos INNER JOIN esta_especialidad ON destipos.codi_des = esta_especialidad.codi_esp
			WHERE destipos.codt_des='06' ORDER BY destipos.nomb_des");
			/*
			insert into usutmp SELECT destipos.codi_des AS cod, CONCAT('REMISION ',destipos.nomb_des) AS des, 
			esta_especialidad.esta_esp AS niv, destipos.homo3_des AS posord, esta_especialidad.vige_esp as vigencia
			FROM destipos INNER JOIN esta_especialidad ON destipos.codi_des = esta_especialidad.codi_esp
			WHERE destipos.codt_des='06' ORDER BY destipos.nomb_des
			*/
			
			
			echo "<br><br>
			<table align=center class='tbl' width=80%>
			
			<tr>
				<td>SELECCIONE LA ESPECIALIDAD</td>
				<td>
				<select name=codorden class=caja>
				<option value=''></option>";
				while($rref=mysql_fetch_array($bref))
				{
					$cod=$rref['codi_des'];
					$desc=$rref['nomb_des'];
					
					$remmd='S';
					if($especi=="2")
					{
						$besta=mysql_query("SELECT remmedgen_esp FROM esta_especialidad WHERE codi_esp='$cid'");
						while($resta=mysql_fetch_array($besta))
						{
							$remmd=$resta[0];
						}
					}
					
					if($remmd=='S' && $espeordena!=$cod)echo"<option value='$cod'>$desc</option>";
				}
				echo"</select>
				</td>
			</tr>
			<tr>
				<th>OBSERVACION</th>
				<td><textarea onPaste='return false' class='caja' name='obseorden' rows=2 cols=68></textarea></td>
				</tr>
			<tr>
				<th>DIAGNOSTICO</th> 
				<td>
				<select class='caja' name=diagorden>
				<option value=''></option>
				<option value=$cod>$map</option>
				<option value=$cod1>$map1</option>
				<option value=$cod2>$map2</option>
				<option value=$cod3>$map3</option>
				</select>
				</td>
			</tr>
			</table>";
			
		}
		if($opcion=='3')	//CONTRAREFERENCIA
		{
			
			echo "<br><br>
			<table align=center class='tbl' width=80%>
			
			<tr>
			<td>SELECCIONE LA ESPECIALIDAD</td>
			<td>
			<select name=codorden class=caja>
			<option value=''></option>
			<option value='0664'>MEDICINA GENERAL</option>
			<option value='0645'>CRONICOS</option>
			<option value='0610'>MEDICINA FAMILIAR</option>
			<option value='0605'>MEDICINA INTERNA</option>
			</select>
			</td>
			</tr>
			<tr>
				<th>OBSERVACION</th>
				<td><textarea onPaste='return false' class='caja' name='obseorden' rows=2 cols=68></textarea></td>
				</tr>
			<tr>
				<th>DIAGNOSTICO</th> 
				<td>
				<select class='caja' name=diagorden>
				<option value=''></option>
				<option value=$cod>$map</option>
				<option value=$cod1>$map1</option>
				<option value=$cod2>$map2</option>
				<option value=$cod3>$map3</option>
				</select>
				</td>
			</tr>
			</table>";
			
		}
		if($opcion=='4')	//CONTROL
		{
			//$besp=mysql_query("SELECT * FROM destipos WHERE valo_des='$Gareanh' AND codt_des='06'");
			
			$besp=mysql_query("SELECT destipos.codi_des, areas.cod_areas, destipos.codt_des
			FROM destipos INNER JOIN areas ON destipos.valo_des = areas.equi_area
			WHERE (((areas.cod_areas)='$Gareanh') AND ((destipos.codt_des)='06'))");
			
			

			
			
			//echo "SELECT * FROM destipos WHERE valo_des='$Gareanh' AND codt_des='06'";
			
			$resp=mysql_fetch_array($besp);
			$especontrol=$resp['codi_des'];
			
			echo "<br><br>
			
			<input type=hidden name=codorden value='$especontrol'>
			codorden
			
			<table align=center class='tbl' width=80%>
			
			<tr>
			<td>CONTROL EN </td>
			<td>
			<select name=cantorden onchange='obse()' class=caja>
			<option value=''></option>
			<option value='1'>1</option>
			<option value='2'>2</option>
			<option value='3'>3</option>
			<option value='4'>4</option>
			<option value='5'>5</option>
			<option value='6'>6</option>
			<option value='7'>7</option>
			<option value='8'>8</option>
			<option value='9'>9</option>
			<option value='10'>10</option>
			<option value='11'>11</option>
			<option value='12'>12</option>
			<option value='18'>18</option>
			<option value='24'>24</option>
			</select> MESES
			</td>
			</tr>
			<tr>
				<th>OBSERVACION</th>
				<td><textarea onPaste='return false' class='caja' name='obseorden' rows=2 cols=68></textarea></td>
			</tr>
			<tr>
				<th>DIAGNOSTICO</th> 
				<td>
				<select class='caja' name=diagorden>
				<option value=''></option>
				<option value=$cod>$map</option>
				<option value=$cod1>$map1</option>
				<option value=$cod2>$map2</option>
				<option value=$cod3>$map3</option>
				</select>
				</td>
			</tr>
			</table>";
			
		}
		if($opcion=='5')	//ALTA
		{
			echo "
			<br><br>
			<input type=hidden name=codorden>
			<table align=center class='tbl' width=80%>
			
			<tr>
			<td>CONFIRMAR ALTA MEDICA</td>
			<td><input type=checkbox class=caja name='alta' value='1'></td>
			</tr>
			<tr>
				<th>OBSERVACION</th>
				<td><textarea onPaste='return false' class='caja' name='obseorden' rows=2 cols=68></textarea></td>
			</tr>
			</table>
			";
		}
		//valida(1)
		echo"
		<br><br>
		<table align=center class='tbl' width=100%>
		<tr><th>
		<input type=button class='boton2' value='GUARDAR' onclick='valida($opcion)'>
		<input type=button class='boton2' value='CANCELAR' onclick='javascript:CloseModal();'>
		
		</th></tr>
		</table>
		<br><br><br>";
		
	echo"
	</div>
	</div>	
	";
	
	
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