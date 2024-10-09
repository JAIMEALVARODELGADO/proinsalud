<?php
	session_start();
	session_register('paciente');
	session_register('numcita');
	session_register('Gareanh');	
	if(empty($paciente))
	{
		echo"<br><br><table align=center class='tbl'>
		<tr><th>POR SEGURIDAD SU SESI�N SE CERR�. EIERRE E INGRESE NUEVAMENTE AL PROGRAMA</th></tr>
		</table>";
		exit;
	}	
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready(function() {
	$("#nomips1").autocomplete("buscaips.php", {
		width: 520,
		matchContains: true,
		mustMatch: true,
		selectFirst: false,
		scroll: true
	});
	$("#nomips1").result(function(event, data, formatted) {
		$("#codips1").val(data[1]);
		$("#codmun1").val(data['2']);
		$("#coddep1").val(data['3']);
		$("#desmun1").val(data['4']);
		$("#desdep1").val(data['5']);
	});
});
</script>
<script language="JavaScript">
	function cerrarconsul(opc)
	{
		if(opc==1)
		{
			uno.action='guardahisto.php';
		}
		if(opc==2)
		{
			uno.action='notifi_lesion0.php';
		}
		if(opc==3)
		{			
			if(uno.refer[0].checked==true && uno.refer[1].checked==true)
			{
				alert("Seleccione si el paciente viene remitido");
				uno.refer[0].focus();
				return;
			}
			
			if(uno.refer[0].checked==true)
			{
				if(uno.ipsremitente.value=='')
				{
					alert("Seleccione la IPS remitente");
					uno.ipsremitente.focus();
					return;
				}
				if(uno.referopo[0].checked==false && uno.referopo[1].checked==false)
				{
					alert("Seleccione si la referencia es oportuna");
					uno.referopo.focus();
					return;
				}
				if(uno.referper[0].checked==false && uno.referper[1].checked==false)
				{
					alert("Seleccione si la referencia es pertinente");
					uno.referper.focus();
					return;
				}
				if(uno.documcom[0].checked==false && uno.documcom[1].checked==false)
				{
					alert("Seleccione si la documentacion de la referencia esta completa");
					uno.documcom.focus();
					return;
				}
			}
			if(uno.arearemision.value=='')
			{
				alert("Seleccione el destino del paciente");
				uno.arearemision.focus();
				return;
			}
			if(uno.arearemision.value=='C504' && uno.cama.value=='0')
			{
				alert("Seleccione la cama");
				uno.cama.focus();
				return;
			}
			uno.bts.disabled=true;
			uno.action='guardahisto.php';
		}
		if(opc==4)
		{			
			if(uno.refer[0].checked==true && uno.refer[1].checked==true)
			{
				alert("Seleccione si el paciente viene remitido");
				uno.refer[0].focus();
				return;
			}
			
			if(uno.refer[0].checked==true)
			{
				if(uno.ipsremitente.value=='')
				{
					alert("Seleccione la IPS remitente");
					uno.ipsremitente.focus();
					return;
				}
				if(uno.referopo[0].checked==false && uno.referopo[1].checked==false)
				{
					alert("Seleccione si la referencia es oportuna");
					uno.referopo.focus();
					return;
				}
				if(uno.referper[0].checked==false && uno.referper[1].checked==false)
				{
					alert("Seleccione si la referencia es pertinente");
					uno.referper.focus();
					return;
				}
				if(uno.documcom[0].checked==false && uno.documcom[1].checked==false)
				{
					alert("Seleccione si la documentacion de la referencia esta completa");
					uno.documcom.focus();
					return;
				}
			}			
			if(uno.cama.value=='0')
			{
				alert("Seleccione la cama");
				uno.cama.focus();
				return;
			}
			uno.bts.disabled=true;
			uno.action='guardahisto.php';
		}
		if(opc==5)
		{			
			if(uno.refer[0].checked==true && uno.refer[1].checked==true)
			{
				alert("Seleccione si el paciente viene remitido");
				uno.refer[0].focus();
				return;
			}
			
			if(uno.refer[0].checked==true)
			{
				if(uno.ipsremitente.value=='')
				{
					alert("Seleccione la IPS remitente");
					uno.ipsremitente.focus();
					return;
				}
				if(uno.referopo[0].checked==false && uno.referopo[1].checked==false)
				{
					alert("Seleccione si la referencia es oportuna");
					uno.referopo.focus();
					return;
				}
				if(uno.referper[0].checked==false && uno.referper[1].checked==false)
				{
					alert("Seleccione si la referencia es pertinente");
					uno.referper.focus();
					return;
				}
				if(uno.documcom[0].checked==false && uno.documcom[1].checked==false)
				{
					alert("Seleccione si la documentacion de la referencia esta completa");
					uno.documcom.focus();
					return;
				}
			}
			if(uno.arearemision.value=='C509')
			{
				if(uno.cama.value=='0')
				{
					alert("Seleccione la cama");
					uno.cama.focus();
					return;
				}
			}			
			uno.bts.disabled=true;
			uno.action='guardahisto.php';
		}		
		uno.target='area';		
		uno.submit();		
	}
	function actualiza()
	{
		uno.action='busca_causa.php';
		uno.target='area';		
		uno.submit();		
	}	
</script>
</head>	
<?php
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
	echo"<form name=uno method=post>";
	//busca causa por todos los diagnosticos
	if($Gareanh=='4' || $Gareanh=='04')
	{		
		$re1='';$re2='';$ro1='';$ro2='';$rp1='';$rp2='';$dc1='';$dc2='';
		if($refer=='S')$re1='checked';
		if($refer=='N')$re2='checked';		
		if($referopo=='S')$ro1='checked';
		if($referopo=='N')$ro2='checked';		
		if($referper=='S')$rp1='checked';
		if($referper=='N')$rp2='checked';		
		if($documcom=='S')$dc1='checked';
		if($documcom=='N')$dc2='checked';		
		echo"
		<br><br><br><br><br><br><br>
<center>		
		<table align=center class='tbl'>
		<tr>
		<th colspan=2>INFORMACION DE LA REFERENCIA</th>
		</tr>
		<tr>
		<td>PACIENTE REMITIDO</td>
		<td>SI <input type=radio name=refer $re1 onchange='actualiza()' value='S'> NO <input type=radio $re2 name=refer  onchange='actualiza()' value='N'></td>
		</tr>";
		if(!empty($refer))
		{
			if($refer=='S')
			{
				echo "		
				<tr>
				<td>IPS REMITENTE</td>		
				<td><input type=text size=80 name=ipsremitente id='nomips1' value='$ipsremitente'></td>
				<input type=hidden name=codipsrem id='codips1' value='$codipsrem'>		
				<tr>
				</tr>		
				<td>REFERENCIA OPORTUNA</td>		
				<td>SI <input type=radio name=referopo $ro1 value='S'> NO <input type=radio name=referopo $ro2 value='N'></td>
				<tr>		
				</tr>		
				<td>REFERENCIA PERTINENTE</td>		
				<td>SI <input type=radio name=referper $rp1 value='S'> NO <input type=radio name=referper $rp2 value='N'></td>
				<tr>		
				</tr>		
				<td>DOCUMENTACION COMPLETA</td>		
				<td>SI <input type=radio name=documcom $dc1 value='S'> NO <input type=radio name=documcom $dc2 value='N'></td>
				</tr>		
				</table>";
			}		
			echo"			
			<br><br>
			<table align=center class='tbl'>
			<tr>
			<th>AREA DE REMISION DEL PACIENTE</th>
			</tr>
			<tr><td><select name=arearemision>
			<option value=''></option>
			<option value='C501'>CASA</option>
			<option value='C502'>POR DEFINIR CONDUCTA</option>
			<option value='C503'>OBSERVACION DE URGENCIAS</option>
			</select>
			</td>
			<tr><th align=center valign=top height=20><a><INPUT type=button name='bts' class='boton' value='aceptar' onClick='cerrarconsul(3)'></th></tr>	
			</table>";
		}		
	}	
	else if($Gareanh=='3' || $Gareanh=='03')
	{
		$re1='';$re2='';$ro1='';$ro2='';$rp1='';$rp2='';$dc1='';$dc2='';
		if($ipsremitente=='S')$re1='checked';
		if($ipsremitente=='N')$re2='checked';		
		if($referopo=='S')$ro1='checked';
		if($referopo=='N')$ro2='checked';		
		if($referper=='S')$rp1='checked';
		if($referper=='N')$rp2='checked';		
		if($documcom=='S')$dc1='checked';
		if($documcom=='N')$dc2='checked';
		$chref1=''; $chref2='';
		if($refer=='S')$chref1='checked';
		if($refer=='N')$chref2='checked';		
		$ch0='';$ch1='';$ch2='';
		if($arearemision=='')$ch0='selected';
		if($arearemision=='C504')$ch1='selected';
		if($arearemision=='C505')$ch2='selected';		
		echo"
		<br><br><br><br><br><br><br>
		<table align=center class='tbl'>
		<tr>
		<th colspan=2>INFORMACION DE LA REFERENCIA</th>
		</tr>
		<tr>
		<td>PACIENTE REMITIDO</td>
		<td>SI <input type=radio $chref1 name=refer  onchange='actualiza()' value='S'> NO <input type=radio $chref2 name=refer  onchange='actualiza()' value='N'></td>
		</tr>";
		if(!empty($refer))
		{
			if($refer=='S')
			{
				echo "		
				<tr>
				<td>IPS REMITENTE</td>		
				<td><input type=text size=80 name=ipsremitente id='nomips1' value='$ipsremitente'></td>
				<input type=hidden name=codipsrem id='codips1' value='$codipsrem'>		
				<tr>
				</tr>		
				<td>REFERENCIA OPORTUNA</td>		
				<td>SI <input type=radio name=referopo $ro1 value='S'> NO <input type=radio name=referopo $ro2 value='N'></td>
				<tr>		
				</tr>		
				<td>REFERENCIA PERTINENTE</td>		
				<td>SI <input type=radio name=referper $rp1 value='S'> NO <input type=radio name=referper $rp2 value='N'></td>
				<tr>		
				</tr>		
				<td>DOCUMENTACION COMPLETA</td>		
				<td>SI <input type=radio name=documcom $dc1 value='S'> NO <input type=radio name=documcom $dc2 value='N'></td>
				</tr>		
				</table>";
			}
			echo"		
			<br><br>
			<table align=center class='tbl'>
			<tr>
			<th>AREA DE REMISION DEL PACIENTE</th>
			<td><select name=arearemision onchange='actualiza()'>
			<option $ch0 value=''></option>
			<option $ch1 value='C504'>CIRUGIA</option>
			<option $ch2 value='C505'>REPROGRAMACION</option>
			</select>
			</td>
			</tr>";
			if($arearemision=='C504')
			{				
				$resulcama=mysql_query("select * from destipos where codt_des='19' and valo_des='0698'");
				//echo mysql_num_rows($resulcama);
				echo "<th>Numero de cama</th>";
				echo"<td><select name=cama>
				<option value=0></option>";	
				while($rowcama=mysql_fetch_array($resulcama))
				{
					$codcama=$rowcama['codi_des'];
					$nomcama=$rowcama['nomb_des'];					
					$compara=Mysql_query("SELECT destipos.codt_des, destipos.codi_des, destipos.valo_des, hist_traza.horas_tra
					FROM ((ingreso_hospitalario INNER JOIN destipos ON ingreso_hospitalario.caac_ing = destipos.codi_des) INNER JOIN hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing) INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU
					WHERE (((destipos.codt_des)='19') AND ((destipos.codi_des)='$codcama') AND ((destipos.valo_des)='0698') AND ((hist_traza.horas_tra)=-1))");
					$numigual=Mysql_num_rows($compara);					
					if($numigual==0)
					{						
						echo "<option value=$codcama>$nomcama</option>";
					}					
				}			
			}			
			echo"<tr>
			<th align=center height=20 colspan=2><a><INPUT type=button name='bts' class='boton' value='aceptar' onClick='cerrarconsul(3)'></th></tr>	
			</table>";
		}
	}
	else if($Gareanh=='219')
	{
		$re1='';$re2='';$ro1='';$ro2='';$rp1='';$rp2='';$dc1='';$dc2='';
		if($ipsremitente=='S')$re1='checked';
		if($ipsremitente=='N')$re2='checked';		
		if($referopo=='S')$ro1='checked';
		if($referopo=='N')$ro2='checked';		
		if($referper=='S')$rp1='checked';
		if($referper=='N')$rp2='checked';		
		if($documcom=='S')$dc1='checked';
		if($documcom=='N')$dc2='checked';
		$chref1=''; $chref2='';
		if($refer=='S')$chref1='checked';
		if($refer=='N')$chref2='checked';
		echo"
		<input type=hidden name=arearemision value='C508'>
		<br><br><br><br><br><br><br>
		<table align=center class='tbl'>
		<tr>
		<th colspan=2>INFORMACION DE LA REFERENCIA</th>
		</tr>
		<tr>
		<td>PACIENTE REMITIDO</td>
		<td>SI <input type=radio $chref1 name=refer  onchange='actualiza()' value='S'> NO <input type=radio $chref2 name=refer  onchange='actualiza()' value='N'></td>
		</tr>";
		if(!empty($refer))
		{
			if($refer=='S')
			{
				echo "		
				<tr>
				<td>IPS REMITENTE</td>		
				<td><input type=text size=80 name=ipsremitente id='nomips1' value='$ipsremitente'></td>
				<input type=hidden name=codipsrem id='codips1' value='$codipsrem'>		
				<tr>
				</tr>		
				<td>REFERENCIA OPORTUNA</td>		
				<td>SI <input type=radio name=referopo $ro1 value='S'> NO <input type=radio name=referopo $ro2 value='N'></td>
				<tr>		
				</tr>		
				<td>REFERENCIA PERTINENTE</td>		
				<td>SI <input type=radio name=referper $rp1 value='S'> NO <input type=radio name=referper $rp2 value='N'></td>
				<tr>		
				</tr>		
				<td>DOCUMENTACION COMPLETA</td>		
				<td>SI <input type=radio name=documcom $dc1 value='S'> NO <input type=radio name=documcom $dc2 value='N'></td>
				</tr>		
				</table>";
			}
			echo"		
			<br><br>
			<table align=center class='tbl'>";
			$resulcama=mysql_query("select * from destipos where codt_des='19' and valo_des='0669'");
			//echo mysql_num_rows($resulcama);
			echo "<th>Numero de cama</th>";
			echo"<td><select name=cama>
			<option value=0></option>";	
			while($rowcama=mysql_fetch_array($resulcama))
			{
				$codcama=$rowcama['codi_des'];
				$nomcama=$rowcama['nomb_des'];					
				$compara=Mysql_query("SELECT destipos.codt_des, destipos.codi_des, destipos.valo_des, hist_traza.horas_tra
				FROM ((ingreso_hospitalario INNER JOIN destipos ON ingreso_hospitalario.caac_ing = destipos.codi_des) INNER JOIN hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing) INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU
				WHERE (((destipos.codt_des)='19') AND ((destipos.codi_des)='$codcama') AND ((destipos.valo_des)='0669') AND ((hist_traza.horas_tra)=-1))");
				$numigual=Mysql_num_rows($compara);					
				if($numigual==0)
				{						
					echo "<option value=$codcama>$nomcama</option>";
				}					
			}						
			echo"<tr>
			<th align=center height=20 colspan=2><a><INPUT type=button name='bts' class='boton' value='aceptar' onClick='cerrarconsul(4)'></th></tr>	
			</table>";
		}
	}
	else if($Gareanh=='894')
	{
		$re1='';$re2='';$ro1='';$ro2='';$rp1='';$rp2='';$dc1='';$dc2='';
		if($ipsremitente=='S')$re1='checked';
		if($ipsremitente=='N')$re2='checked';		
		if($referopo=='S')$ro1='checked';
		if($referopo=='N')$ro2='checked';		
		if($referper=='S')$rp1='checked';
		if($referper=='N')$rp2='checked';		
		if($documcom=='S')$dc1='checked';
		if($documcom=='N')$dc2='checked';
		$chref1=''; $chref2='';
		if($refer=='S')$chref1='checked';
		if($refer=='N')$chref2='checked';
		$ch0='';$ch1='';$ch2='';
		if($arearemision=='')$ch0='selected';
		if($arearemision=='C501')$ch1='selected';
		if($arearemision=='C509')$ch2='selected';
		echo"
		<input type=hidden name=arearemision>
		<br><br><br><br><br><br><br>
		<table align=center class='tbl'>
		<tr>
		<th colspan=2>INFORMACION DE LA REFERENCIA</th>
		</tr>
		<tr>
		<td>PACIENTE REMITIDO</td>
		<td>SI <input type=radio $chref1 name=refer  onchange='actualiza()' value='S'> NO <input type=radio $chref2 name=refer  onchange='actualiza()' value='N'></td>
		</tr>";
		if(!empty($refer))
		{
			if($refer=='S')
			{
				echo "		
				<tr>
				<td>IPS REMITENTE</td>		
				<td><input type=text size=80 name=ipsremitente id='nomips1' value='$ipsremitente'></td>
				<input type=hidden name=codipsrem id='codips1' value='$codipsrem'>		
				<tr>
				</tr>		
				<td>REFERENCIA OPORTUNA</td>		
				<td>SI <input type=radio name=referopo $ro1 value='S'> NO <input type=radio name=referopo $ro2 value='N'></td>
				<tr>		
				</tr>		
				<td>REFERENCIA PERTINENTE</td>		
				<td>SI <input type=radio name=referper $rp1 value='S'> NO <input type=radio name=referper $rp2 value='N'></td>
				<tr>		
				</tr>		
				<td>DOCUMENTACION COMPLETA</td>		
				<td>SI <input type=radio name=documcom $dc1 value='S'> NO <input type=radio name=documcom $dc2 value='N'></td>
				</tr>		
				</table>";
			}
			echo"		
			<br><br>
			<table align=center class='tbl'>
			<tr>
			<th>AREA DE REMISION DEL PACIENTE</th>
			<td><select name=arearemision onchange='actualiza()'>
			<option $ch0 value=''></option>
			<option $ch1 value='C501'>CASA</option>
			<option $ch2 value='C509'>HOSPITALIZACION</option>
			</select>
			</td>
			</tr>
			<tr>";			
			
			if($arearemision=='C509')
			{				
				$resulcama=mysql_query("select * from destipos where codt_des='19' and valo_des='0692'");
				//echo mysql_num_rows($resulcama);
				echo "<th>Numero de cama</th>";
				echo"<td><select name=cama>
				<option value=0></option>";	
				while($rowcama=mysql_fetch_array($resulcama))
				{
					$codcama=$rowcama['codi_des'];
					$nomcama=$rowcama['nomb_des'];					
					$compara=Mysql_query("SELECT destipos.codt_des, destipos.codi_des, destipos.valo_des, hist_traza.horas_tra
					FROM ((ingreso_hospitalario INNER JOIN destipos ON ingreso_hospitalario.caac_ing = destipos.codi_des) INNER JOIN hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing) INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU
					WHERE (((destipos.codt_des)='19') AND ((destipos.codi_des)='$codcama') AND ((destipos.valo_des)='0692') AND ((hist_traza.horas_tra)=-1))");
					$numigual=Mysql_num_rows($compara);					
					if($numigual==0)
					{						
						echo "<option value=$codcama>$nomcama</option>";
					}					
				}			
			}			
			echo"</tr><tr>
			<th align=center height=20 colspan=2><a><INPUT type=button name='bts' class='boton' value='aceptar' onClick='cerrarconsul(5)'></th></tr>	
			</table>";
		}
	}
	
	
	else
	{
		$bucau=mysql_query("SELECT dx_svlce.iden_svl, dx_svlce.codi_svl, dx_svlce.desc_svl
		FROM dx_svlce WHERE (((dx_svlce.codi_svl)='$cod' Or (dx_svlce.codi_svl)='$cod1' Or (dx_svlce.codi_svl)='$cod2' Or (dx_svlce.codi_svl)='$cod3'))");
		//busca causa solo por el diagnostico principal
		//$bucau=mysql_query("SELECT dx_svlce.iden_svl, dx_svlce.codi_svl, dx_svlce.desc_svl
		//FROM dx_svlce WHERE (((dx_svlce.codi_svl)='$cod' Or (dx_svlce.codi_svl)='$cod1' Or (dx_svlce.codi_svl)='$cod2' Or (dx_svlce.codi_svl)='$cod3'))");
		if(mysql_num_rows($bucau)==0)
		{		
			echo"<body onload='cerrarconsul(1)'>
			</body>";
		}
		else
		{
			$bsig=mysql_query("select * from triage_urgencias where iden_cita='$numcita'");
			while($rsig=mysql_fetch_array($bsig))
			{			
				$remitido=$rsig['remi_tri'];			
			}
			if($remitido=='S')
			{			
				echo"<body onload='cerrarconsul(1)'>
				</body>";
			}
			else
			{			
				echo"<body onload='cerrarconsul(1)'>
				</body>";
			}
		}	
	}
	echo "</form>";
?>
</html>