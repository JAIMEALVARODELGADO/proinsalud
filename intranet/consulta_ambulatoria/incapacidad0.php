<?
	session_register('paciente');
	session_register('Gareanh');
	session_register('datos');
	session_register('Gcontratonh');
	session_register('numcita');
	session_register('Gcod_mediconh'); 
	
	foreach($_POST as $nombre_campo => $valor)
	{ 
	   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
	   eval($asignacion); 
	}
	foreach($_GET as $nombre_campo => $valor)
	{ 
	   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
	   eval($asignacion); 
	}
	session_register('munilabor'); 
	//ECHO $Gcontratonh;
	//$paciente=13616;
	//$numcita=4668864;
	//$Gcontratonh='135';
	/*
	BORRAR HISTORIA CONSULTA AMBULATORIA
	DELETE FROM encabesadohistoria WHERE numc_ehi = '98396211210502175331';
	DELETE FROM incapacidades WHERE numc_his = '98396211210502175331';
	DELETE FROM consultaprincipal  WHERE numc_cpl = '98396211210502175331';
	DELETE FROM encabesadoformula WHERE numc_efo = '98396211210502175331';
	DELETE FROM medicamentosenv WHERE numc_men = '98396211210502175331';
	DELETE FROM medicamentos_oncologia  WHERE num_histo = '98396211210502175331';
	DELETE FROM referencia WHERE numc_ref = '98396211210502175331';
	DELETE FROM detareferencia WHERE numc_dre  = '98396211210502175331';
	DELETE FROM conambfam WHERE iden_cpl = '98396211210502175331';
	*/
	
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

<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 



<script src="http://momentjs.com/downloads/moment.min.js"></script>
<script type="text/javascript">
	

	
	$().ready
	(
		function() 
		{		
			$("#autonomcol").autocomplete("autoestablecimiento.php", {
			width: 600,
			minChars: 3,
			autoFill: false,
			mustMatch: false,
			matchContains: false,
			scroll: true,
			scrollHeight: 220
			});	
			$("#autonomcol").result(function(event, data, formatted) 
			{$("#autocodcol").val(data['1']);
			});
		}	
	);		
	
	
	
	</script>	

<script language="JavaScript">
	function salida()
	{	
		uno.target='';
		uno.action='medica0.php';
		uno.submit();	
	}
	function valida()
	{		
		if(uno.tipoafi.value=='doc')
		{
			if(uno.depar.value=='')
			{
				alert("Seleccione el departamento");
				uno.depar.focus();
				return;
			}
			
			if(uno.munilabor.value=='')
			{
				alert("Seleccione el municipio");
				uno.munilabor.focus();
				return;
			}
			if(uno.colegio.value=='')
			{
				alert("Seleccione el plantel educativo");
				uno.colegio.focus();
				return;
			}	
			
			if(uno.areaespe.value=='')
			{
				alert("Seleccione el area o especealidad");
				uno.areaespe.focus();
				return;
			}		
			opcion = document.getElementsByName("jornada");
			var anu=0;
			for(var i=0; i<3; i++)
			{			
				if(opcion[0].checked)anu=1;
				if(opcion[1].checked)anu=1;
				if(opcion[2].checked)anu=1;
			}
			if(anu==0)
			{
				alert("Seleccione el tipo la jornada laboral");
				return;
			}
		}
		
		if(uno.diasinca.value=='')
		{
			alert("Ingrese el numero de dias de incapacidad");
			uno.diasinca.focus();
			return;
		}		
		if(uno.fecini.value=='')
		{			
			alert("Seleccione la fecha de inicio de incapacidad");
			uno.fecini.focus();
			return;
		}
		
		if(uno.diaginca.value=='')
		{			
			alert("Seleccione el diagnostico que genera la incapacidad");
			uno.diaginca.focus();
			return;
		}
		opcion = document.getElementsByName("tipolic");
		var anu=0;
		for(var i=0; i<3; i++)
		{			
			if(opcion[0].checked)anu=1;
			if(opcion[1].checked)anu=2;
			if(opcion[2].checked)anu=3;
		}
		if(anu==0)
		{
			alert("Seleccione el tipo de licencia o incapacidad");
			return;
		}
		
		if(anu==1 && uno.fecparto.value =='')
		{						
			alert("Seleccione la fecha probable de parto");
			uno.fecparto.focus();
			return;		
		}
		
		uno.action='almacena.php';
		uno.target='';
		uno.submit();	
	}
	
	
	function cambia()
	{
		//2021-03-05		
		
		fini = uno.fecini.value;
		diin = uno.diasinca.value;
		if(fini!='' && diin!='')
		{
			var anohoy = (new Date()).getFullYear();
			var meshoy = (new Date()).getMonth();
			var diahoy = (new Date()).getDate();
			
			var timestamp = new Date(anohoy, meshoy, diahoy);
			
			aini=fini.substr(0, 4);
			mini=fini.substr(5, 2)-1;
			dini=fini.substr(8, 2);
			mili = (diin-1)*24*60*60*1000;	
			var timini = new Date(aini, mini, dini);

			var diff = timestamp - timini;
			dias=diff/(1000*60*60*24);
			if(dias>30)
			{
				alert("LA FECHA DE INICIO NO PUEDE SER MAYOR A 30 DIAS CONTADOS A PARTIR DE LA FECHA ACTUAL");
				uno.fecini.value='';
				return;
			}
			var sum = timini/1 + mili/1;
			ffin = new Date(sum);
			var ano = ffin.getFullYear();
			var mes = ffin.getMonth() + 1;
			var dia = ffin.getDate();
			if(mes<10)mes='0'+mes;
			if(dia<10)dia='0'+dia;
			fechafin=ano + "-" + mes + "-" + dia;
			document.getElementById("fecf").innerHTML=fechafin;
			uno.fecfin.value=fechafin;
		}
		
	}
	
	function mensa()
	{			
		if(uno.mensaje.value==1)
		{
			alert("Se requiere diligenciar el modulo de diagnosticos");
			uno.target='';
			uno.action='diagnos0.php';
			uno.submit();	
		}
		document.getElementById("texto").innerHTML=uno.letras.value;
		document.getElementById("fecf").innerHTML=uno.fecfin.value;
	}
	function actualiza()
	{
		uno.auto.value='1';
		uno.target='';
		uno.action='incapacidad0.php';
		uno.submit();
	}
	
</script>


</head>	
<body>
<?
	
	
	// localhost/intranet/consulta_ambulatoria/incapacidad0.php;
	include ('php/conexion1.php');		
	$bafi=mysql_query("SELECT usuario.SEXO_USU, usuario.TPAF_USU, cotadicional.SITU_COT, usuario.CODI_USU, usuario.TPAF_USU
	FROM usuario LEFT JOIN cotadicional ON usuario.CODI_USU = cotadicional.CUSU_COT
	WHERE (((usuario.CODI_USU)='$paciente'))");
	$rafi=mysql_fetch_array($bafi);
	$sexousu=$rafi['SEXO_USU'];
	$tpafusu=$rafi['SITU_COT'];
	$tipafi=$rafi['TPAF_USU'];
	if($auto!='1')
	{
		$archivo2='tmp/incaHC'.$numcita.'-'.$paciente.'.txt';	
		if(file_exists($archivo2))
		{
			$fp = fopen ($archivo2, "r" );
			$reg1=0;
			while (( $data = fgetcsv ( $fp , 100000 , "|" )) !== FALSE ) 
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
	}
	
	echo"<form name=uno method=post>
	<input type=hidden name=auto>
	<input type=hidden name=codiprg value='inca'>	
	<BR><BR>
	<center><table align=center width=80%>";
	$archivo2='tmp/4HC'.$numcita.'-'.$paciente.'.txt';
	if(file_exists($archivo2)  || $Gcod_mediconh=='98396211')
	{
		echo"<input type=hidden name=mensaje value=0>";
		
		$consultamag="SELECT REGMAG_CON FROM contrato WHERE CODI_CON='$Gcontratonh'";
		$consultamag=mysql_query($consultamag);
		$rowmag=mysql_fetch_array($consultamag);
		$regmag_con=$rowmag[REGMAG_CON];		
		
		echo"		
		<TR><TD>
		<table align=center class='tbl' width=100%>
		<tr><th>INCAPACIDAD</th></tr>
		</table>
		<br><br>";		
		echo"		
		<table align=center class='tbl' border=1 width=100%>";
		$archivo2='tmp/4HC'.$numcita.'-'.$paciente.'.txt';	
		if(file_exists($archivo2))
		{
			$fp = fopen ($archivo2, "r" );
			$reg1=0;
			while (( $data = fgetcsv ( $fp , 100000 , "|" )) !== FALSE ) 
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
		/*if($tipoorden==1)
		{*/
		if($regmag_con=='S' && $tipafi=='C')echo"<input type=hidden name=tipoafi value='doc'>";
		else echo"<input type=hidden name=tipoafi value=''>";
		
		if($regmag_con=='S' && $tipafi=='C')
		{
			
			echo"
			<tr>
			<tr>
			<th colspan=4>INFORMACION LABORAL DEL PACIENTE</th>
			</tr>
			
			<th>DEPARTAMENTO</th>
			<th>MUNICIPIO</th>

			<th>PLANTEL EDUCATIVO</th>			
			<th>AREA ESPECIALIDAD</th>
			
			<th>JORNADA</th>
			</tr>
			<tr><td>";
			
			
			/*
			echo"<input type='hidden'  name='colegio' id='autocodcol'  value='$colegio'>";
			echo"<td><textarea class='form-control' cols='30' rows='2' name='nomcole' id='autonomcol'></textarea></td>";			
			echo"<input type='hidden' name='depar' id='autodeparlab' value='$depar'>";
			echo"<input type='hidden' name='muni' id='automunilab' value='$muni'>";
			echo"<td align=center><input type='text' disabled class='form-control' size=60 name='munideparlab' id='automundepar'   value='$munideparlab'></td>";
			*/
			
			
			if(empty($depar))$depar='52';
			$bdepar=mysql_query("SELECT * FROM departamento ORDER BY NOMB_DEP");
			echo"<select class=caja name='depar' onchange='actualiza()'>
			<option value=''></option>";
			while($rdepar=mysql_fetch_array($bdepar))
			{
				$codep=$rdepar['CODI_DEP'];
				$nom=$rdepar['NOMB_DEP'];
				if($codep==$depar)echo"<option selected value='$codep'>$nom</option>";
				else echo"<option value='$codep'>$nom</option>";
			}
			
			echo"
			</select>
			</td>
			<td>";
			
			$bmuni=mysql_query("SELECT * FROM municipio WHERE DEPA_MUN='$depar' ORDER BY NOMB_MUN");
			echo"<select class=caja name='munilabor' onchange='actualiza()'>
			<option value=''></option>";
			//if ($munilabor=='')$munilabor='52001';
			while($rmuni=mysql_fetch_array($bmuni))
			{
				$codm=$rmuni['CODI_MUN'];
				$nomm=$rmuni['NOMB_MUN'];
				if($codm==$munilabor)echo"<option selected value='$codm'>$nomm</option>";
				else echo"<option value='$codm'>$nomm</option>";
			}
			echo"
			</select>
			</td>
			
			
			
			
			
			
			<td>";
			
			$bcole=mysql_query("SELECT * FROM establecimientos_educativos where iden='$colegio'");
			while($rcole=mysql_fetch_array($bcole))
			{
				$nomcole=$rcole['nombre_establecimiento'];
			}
			echo"<input type='hidden'  name='colegio' id='autocodcol'  value='$colegio'>";
			echo"<textarea class='form-control' cols='30' rows='2' name='nomcole' id='autonomcol'>$nomcole</textarea>";
				
			echo"</td>";
			
			
			
			
			
			$bare=mysql_query("SELECT * FROM destipos WHERE codt_des='F0' order by nomb_des");			
			
			echo"
			
			<td>
			<select class='caja' name=areaespe>
			<option value=''></option>";
			while($rare=mysql_fetch_array($bare))
			{
				$care=$rare['codi_des'];
				$nare=$rare['nomb_des'];
				if($areaespe==$care)echo"<option selected value='$care'>$nare</option>";
				else echo"<option  value=$care>$nare</option>";
				
			}
			echo"</select>";

			$tl1='';$tl2='';$tl3='';
			if($jornada=='M')$tl1='checked';
			if($jornada=='T')$tl2='checked';
			if($jornada=='N')$tl3='checked';
			echo"
			</td>
			<td colspan=3>
			MAÑANA &nbsp;&nbsp; <input type=radio $tl1 name=jornada value='M'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			TARDE &nbsp;&nbsp; <input type=radio $tl2 name=jornada value='T'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			NOCHE &nbsp; <input type=radio $tl3 name=jornada value='N'>
			</td>
			</tr>
			</table>
			";
		}		
		echo"
		<br><br>
		<table align=center class='tbl' border=1 width=100%>
		<tr>
		
		<th colspan=4>INFORMACION DE LA INCAPACIDAD</th>
		</tr>
		<tr>
		<th>DIAS DE INCAPACIDAD</th>
		<th align='center'>FECHA INICIO INCAPACIDAD:</th>
		<th align='center'>FECHA FIN INCAPACIDAD</th>
		<th>DIAGNOSTICO</th>
		</tr>
		<tr>
		
		<td align=center><input type=text name=diasinca class='caja' id='numero' onblur='cambia()' size=2 value='$diasinca'> <span id='texto'></span></td>
		<input type=hidden name=letras value='$letras'>
		";
		
		
		?>
		<?php echo "<td align=center><input type=text name=fecini onchange='cambia()' id=fecini class='caja' size='14' value='$fecini' >";?>
		<img src='img/Calendar-32.png' width='16' height='16' alt='Calendario' id='lanzador3'/>
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField     :    "fecini",     // id del campo de texto 
		ifFormat     :     "%Y/%m/%d",     // formato de la fecha que se escriba en el campo de texto 
		button     :    "lanzador3"     // el id del botn que lanzar el calendario 
		}); 
		</script> 
		<script languaje='JAVASCRIPT'>uno.fecini.value="<?echo $fecini?>";</script>
		<?php
		echo" 		
		</td>
		<input type=hidden name=fecfin value='$fecfin'>		
		<td align=center><span id='fecf'></span></td>
		<td align=center> <select class='caja' name=diaginca>
		<option value=''></option>
		<option value=$cod>$map</option>
		<option value=$cod1>$map1</option>
		<option value=$cod2>$map2</option>
		<option value=$cod3>$map3</option>
		</select>
		</td>
		</tr>
		</table>";
		
		?>
		<script languaje='JAVASCRIPT'>uno.diaginca.value="<?echo $diaginca ?>";</script>
		<?php
		echo"
		<table align=center class='tbl' border=1 width=100%>
		<tr>
		<th>FECHA PROBABLE DE PARTO</th>
		<th align='center'>OBSERVACIONES DE LA INCAPACIDAD</th>
		<th align='center'>TIPO DE LICENCIA / INCAPACIDAD</th>		
		</tr>
		<tr>
		";
		?>
		<?php echo "<td align=center><input type=text name=fecparto id=fecparto class='caja' size='14' value='$fecparto'>";?>
		<img src='img/Calendar-32.png' width='16' height='16' alt='Calendario' id='lanzador4'/>
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField     :    "fecparto",     // id del campo de texto 
		ifFormat     :     "%Y/%m/%d",     // formato de la fecha que se escriba en el campo de texto 
		button     :    "lanzador4"     // el id del botn que lanzar el calendario 
		}); 
		</script> 
		<script languaje=javascript>uno.fecparto.value="<?echo $fecparto?>";</script>
		<?php
		$tl1='';$tl2='';$tl3='';
		if($tipolic=='LM')$tl1='checked';
		if($tipolic=='EC')$tl2='checked';
		if($tipolic=='AT')$tl3='checked';
		
		echo"
		
		</td>		
		<td><textarea class='caja' name=obseinca onPaste='return false' class='caja' cols=100 rows=2>$obseinca</textarea></td>
		<td>
		&nbsp;&nbsp;&nbsp;&nbsp; <input type=radio $tl1 name=tipolic value='LM'>&nbsp;&nbsp; LICENCIA DE MATERNIDAD<br>
		&nbsp;&nbsp;&nbsp;&nbsp; <input type=radio $tl2 name=tipolic value='EC'>&nbsp;&nbsp; ENFERMEDAD COMUN<br>
		&nbsp;&nbsp;&nbsp;&nbsp; <input type=radio $tl3 name=tipolic value='AT'>&nbsp;&nbsp; ACCIDENTE DE TRANSITO<br>
		&nbsp;&nbsp;&nbsp;&nbsp; <input type=radio $tl4 name=tipolic value='LA'>&nbsp;&nbsp; LICENCIA POR ABORTO<br>
		&nbsp;&nbsp;&nbsp;&nbsp; <input type=radio $tl5 name=tipolic value='LP'>&nbsp;&nbsp; LICENCIA POR PATERNIDAD
			</td>
		</td>
		</tr>
		</table><br><br>
		
		
		
		<tr><th colspan=4 align=center valign=top height=20><INPUT type=button class='boton' value= GUARDAR onClick='valida();'></th></tr>	
		</tr>";
	
		echo"</table>
		<br><br>";
		
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

<script>
document.getElementById("numero").addEventListener("keyup",function(e){
    document.getElementById("texto").innerHTML=NumeroALetras(this.value);
	uno.letras.value=NumeroALetras(this.value);
});
 
 
function Unidades(num){
 
  switch(num)
  {
    case 1: return "UNO";
    case 2: return "DOS";
    case 3: return "TRES";
    case 4: return "CUATRO";
    case 5: return "CINCO";
    case 6: return "SEIS";
    case 7: return "SIETE";
    case 8: return "OCHO";
    case 9: return "NUEVE";
  }
 
  return "";
}
 
function Decenas(num){
 
  decena = Math.floor(num/10);
  unidad = num - (decena * 10);
 
  switch(decena)
  {
    case 1:
      switch(unidad)
      {
        case 0: return "DIEZ";
        case 1: return "ONCE";
        case 2: return "DOCE";
        case 3: return "TRECE";
        case 4: return "CATORCE";
        case 5: return "QUINCE";
        default: return "DIECI" + Unidades(unidad);
      }
    case 2:
      switch(unidad)
      {
        case 0: return "VEINTE";
        default: return "VEINTI" + Unidades(unidad);
      }
    case 3: return DecenasY("TREINTA", unidad);
    case 4: return DecenasY("CUARENTA", unidad);
    case 5: return DecenasY("CINCUENTA", unidad);
    case 6: return DecenasY("SESENTA", unidad);
    case 7: return DecenasY("SETENTA", unidad);
    case 8: return DecenasY("OCHENTA", unidad);
    case 9: return DecenasY("NOVENTA", unidad);
    case 0: return Unidades(unidad);
  }
}//Unidades()

 
function DecenasY(strSin, numUnidades){
  if (numUnidades > 0)
    return strSin + " Y " + Unidades(numUnidades)
 
  return strSin;
}//DecenasY()

 
function Centenas(num){
 
  centenas = Math.floor(num / 100);
  decenas = num - (centenas * 100);
 
  switch(centenas)
  {
    case 1:
      if (decenas > 0)
        return "CIENTO " + Decenas(decenas);
      return "CIEN";
    case 2: return "DOSCIENTOS " + Decenas(decenas);
    case 3: return "TRESCIENTOS " + Decenas(decenas);
    case 4: return "CUATROCIENTOS " + Decenas(decenas);
    case 5: return "QUINIENTOS " + Decenas(decenas);
    case 6: return "SEISCIENTOS " + Decenas(decenas);
    case 7: return "SETECIENTOS " + Decenas(decenas);
    case 8: return "OCHOCIENTOS " + Decenas(decenas);
    case 9: return "NOVECIENTOS " + Decenas(decenas);
  }
 
  return Decenas(decenas);
}//Centenas()

 
function Seccion(num, divisor, strSingular, strPlural){
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  letras = "";
 
  if (cientos > 0)
    if (cientos > 1)
      letras = Centenas(cientos) + " " + strPlural;
    else
      letras = strSingular;
 
  if (resto > 0)
    letras += "";
 
  return letras;
}//Seccion()

 
function Miles(num){
  divisor = 1000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMiles = Seccion(num, divisor, "MIL", "MIL");
  strCentenas = Centenas(resto);
 
  if(strMiles == "")
    return strCentenas;
 
  return strMiles + " " + strCentenas;
 
  //return Seccion(num, divisor, "UN MIL", "MIL") + " " + Centenas(resto);

}//Miles()

 
function Millones(num){
  divisor = 1000000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMillones = Seccion(num, divisor, "UN MILLON", "MILLONES");
  strMiles = Miles(resto);
 
  if(strMillones == "")
    return strMiles;
 
  return strMillones + " " + strMiles;
 
  //return Seccion(num, divisor, "UN MILLON", "MILLONES") + " " + Miles(resto);

}//Millones()

 
function NumeroALetras(num,centavos){
  var data = {
    numero: num,
    enteros: Math.floor(num),
    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
    letrasCentavos: "",
  };
  if(centavos == undefined || centavos==false) {
    data.letrasMonedaPlural="DIAS";
    data.letrasMonedaSingular="DIA";
  }else{
    data.letrasMonedaPlural="CENTIMOS";
    data.letrasMonedaSingular="CENTIMO";
  }
 
  if (data.centavos > 0)
    data.letrasCentavos = "CON " + NumeroALetras(data.centavos,true);
 
  if(data.enteros == 0)
    return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
  if (data.enteros == 1)
    return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
  else
    return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
}//NumeroALetras()

</script>





