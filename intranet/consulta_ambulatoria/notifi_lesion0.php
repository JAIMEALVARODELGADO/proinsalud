
<?
	session_register('paciente');
	session_register('numcita');	
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script>

<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">

$().ready(function() {	
		$("#course2").autocomplete("autocomp6.php", {
		width: 340,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
		});	
		$("#course2").result(function(event, data, formatted) {
		$("#course_val2").val(data['1']);
		});
	});
</script>
<script language="JavaScript">


function cambia()
{
	uno.target='';
	uno.action='notifi_lesion0';
	uno.submit();
}
function otro1(p)
{	
	if(p==1)
	{
		if(uno.lugar_evento.value==8)
		{
			document.getElementById("ot1").style.display='block';
		}
		else
		{
			document.getElementById("ot1").style.display='none';
		}
		
	}
	if(p==2)
	{
		if(uno.actividad.value==98)
		{
			document.getElementById("ot2").style.display='block';
		}
		else
		{
			document.getElementById("ot2").style.display='none';
		}
		
	}
	if(p==3)
	{
		if(uno.mecanismo.value==5 || uno.mecanismo.value==12 || uno.mecanismo.value==24 || uno.mecanismo.value==26 || uno.mecanismo.value==27)
		{
			document.getElementById("ot3").style.display='block';
		}
		else
		{
			document.getElementById("ot3").style.display='none';
		}
		
	}
	if(p==4)
	{
		if(uno.usuario.value==8)
		{
			document.getElementById("ot4").style.display='block';
		}
		else
		{
			document.getElementById("ot4").style.display='none';
		}
		
	}
	if(p==5)
	{
		if(uno.otroelem.value=='SI')
		{
			document.getElementById("ot5").style.display='block';
		}
		else
		{
			document.getElementById("ot5").style.display='none';
		}
		
	}
	if(p==6)
	{
		if(uno.relacion.value==3)
		{
			document.getElementById("ot6").style.display='block';
		}
		else
		{
			document.getElementById("ot6").style.display='none';
		}
		
	}
	
	if(p==7)
	{
		if(uno.factopreci.value==98)
		{
			document.getElementById("ot7").style.display='block';
		}
		else
		{
			document.getElementById("ot7").style.display='none';
		}
		
	}
	if(p==8)
	{
		if(uno.sitio12.checked==true)
		{
			document.getElementById("ot8").style.display='block';
		}
		else
		{
			document.getElementById("ot8").style.display='none';
		}		
	}
	if(p==9)
	{
		if(uno.natu10.checked==true)
		{
			document.getElementById("ot9").style.display='block';
		}
		else
		{
			document.getElementById("ot9").style.display='none';
		}		
	}
	
	if(p==10)
	{
		if(uno.tipoagresor.value==8)
		{
			document.getElementById("ot10").style.display='block';
		}
		else
		{
			document.getElementById("ot10").style.display='none';
		}		
	}
	if(p==11)
	{
		if(uno.destino.value==11)
		{
			document.getElementById("ot11").style.display='block';
		}
		else
		{
			document.getElementById("ot11").style.display='none';
		}		
	}	
}
function salir()
{
	uno.target='';
	uno.action='notifi_lesion1.php';
	uno.submit();
	
}
function salir2()
{
	uno.target='';
	uno.action='guardahisto.php';
	no.submit();
}
function bfecha()
{
	
	if(uno.fechaven.value!='' && uno.hora.value!='' && uno.minu.value!='')
	{
		uno.target='';
		uno.action='notifi_lesion0.php';
		uno.submit();
	}

}
</script>
</head>	
<body>
<?	
	
	
	
	include ('php/conexion1.php');
	$bhorcit=mysql_query("SELECT citas.id_cita, horarios.Fecha_horario, horarios.Hora_horario
	FROM horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario
	WHERE (((citas.id_cita)='$numcita'))");
	while($rhorcit=mysql_fetch_array($bhorcit))
	{
		$feccit=$rhorcit['Fecha_horario'];
		$horcit=$rhorcit['Hora_horario'];
		
	}
	
	echo"<form name=uno method=post>
	<BR>";	
	echo"	<table align=center class='tbl2'>
	<tr>
	<th>EVENTO Fecha </td>
	";
	?>
		<td class="Td2"  align=center><input type="text" name="fechaven" size="10"  maxlength="10" value="<?echo $fechaven;?>" id="fnac_" <?echo $disp;?>>
		<input type="button" id="lanzador1" value="..." <?echo $disp;?>/>
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField:"fnac_",     // id del campo de texto 
		ifFormat:"%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
		button:"lanzador1"     // el id del botón que lanzará el calendario 				
		}); 
		</script> 			
	<?			
	echo" Hora <input type=text onPaste='return false' class='caja' size=1 name=hora  value='$hora'>
	<input type=text onPaste='return false' class='caja' size=1 name=minu  value='$minu'>
	<input type=button class='boton' value='ir' onclick='bfecha()'>
	</td>
	<tr>
	</table><br><br>";
	
	
	
	if($fechaven!='' && $hora!='' && $minu!='')
	{
	
	
		$anoini=substr($fechaven,0,4);
		$mesini=substr($fechaven,5,2);
		$diaini=substr($fechaven,8,2);
		$horini=$hora;
		$minini=$minu;
		
		
		$anofin=substr($feccit,0,4);
		$mesfin=substr($feccit,5,2);
		$diafin=substr($feccit,8,2);
		$horfin=substr($horcit,11,2);
		$minfin=substr($horcit,14,2);
		
		
		
		$dateini = gmmktime ( $horini, $minini, 0, $mesini, $diaini, $anoini);
		$datefin= gmmktime ( $horfin, $minfin, 0, $mesfin, $diafin, $anofin);	
		
		if($datefin-$dateini<=259200)
		{
			
		
			echo"<table align=center width=80% class='tbl2'>
			<tr>
			<tr><td align=center height=40 colspan=6>I - DATOS COMPLEMENTARIOS DEL PACIENTE</td></tr>
			<th>DESPLAZADO:</td><td> 
			<select class='caja' name=desplazado>
			<option value=''></option>
			<option value='S'>SI</option>
			<option value='N'>NO</option>
			</select>
			</th>	
			<th>DISCAPACITADO:</td><td> 
			<select class='caja' name=discapacitado>
			<option value=''></option>
			<option value='S'>SI</option>
			<option value='N'>NO</option>
			</select>
			</td>	
			<th>GRUPO ÉTNICO:</td><td>  
			<select class='caja' name=grupoetnico>
			<option value=''></option>
			<option value='1'>AFROCOLOMBIANO</option>
			<option value='2'>INDIGENA</option>
			<option value='3'>OTRO</option>
			<option value='4'>NINGUNO</option>
			</select>
			</td>
			<tr></table>
			<table align=center width=80% class='tbl2'>
			<tr><td height=40 align=center colspan=6>II - DATOS GENERALES DEL EVENTO (Para cada agrupación de datos debe seleccionar a mas grave)</td></tr>
			<tr>
			<th>DEPARTAMENTO</td>
			<th>MUNICIPIO</td>
			<th>BARRIO/ VEREDA</td>
			<th>DIRECCION</td>
			<th>TELEFONO</td>
			</tr>";	
			$bdepar=mysql_query("select * from departamento");
			echo"<tr><td align=center><select  class='caja' name=depar onchange=cambia()>
			<option value=''></option>";
			while($rdepar=mysql_fetch_array($bdepar))
			{
				$codidepar=$rdepar['CODI_DEP'];
				$nombdepar=$rdepar['NOMB_DEP'];
				if($codidepar==$depar)
				{
					echo"<option value='$codidepar' selected>$nombdepar</option>";
				}
				else
				{
					echo"<option value='$codidepar'>$nombdepar</option>";
				}	
			}
			echo"</select></td>";	
			$bmuni=mysql_query("select * from municipio where DEPA_MUN='$depar'");
			echo"<td><select class='caja' name=municipio onchange=cambia()>
			<option value=''>---------------------------------------------------------------</option>";
			while($rmuni=mysql_fetch_array($bmuni))
			{
				$codimun=$rmuni['CODI_MUN'];
				$nombmun=$rmuni['NOMB_MUN'];
				if($codimun==$municipio)
				{
					echo"<option value='$codimun' selected>$nombmun</option>";
				}
				else
				{
					echo"<option value='$codimun'>$nombmun</option>";
				}	
			}
			echo"</select></td>
			<td align=center><input type=text onPaste='return false'  class='caja' name=barrio value='$barrio'></td>
			<td align=center><input type=text onPaste='return false'  class='caja' name=direccion value='$direccion'></td>
			<td align=center><input type=text onPaste='return false'  class='caja' size=8 name=telefono value='$telefono'></td>
			</table>
			<table align=center width=80% class='tbl2'>
			<tr>	
			<th>Remitido</td>
			<th>INTENCIONALIDAD</td>
			<th>LUGAR DONDE OCURRIÓ LA LESIÓN</td>	
			</tr>
			<tr>
			<td align=center> 
			<select class='caja' name=remitido>
			<option value=''></option>
			<option value='S'>SI</option>
			<option value='N'>NO</option>
			</select>
			</td>
			<td align=center> 
			<select class='caja' name=intencionalidad>
			<option value=''></option>
			<option value='1'>No intencional (accidentes)</option>
			<option value='2'>Autoinfligida intencional (Suicidio)</option>
			<option value='3'>Violencia/ Agresión ó sospecha</option>
			<option value='9'>No sabe</option>
			</select>
			</td>	
			<td align=center> 
			<select class='caja' name=lugar_evento onchange='otro1(1)'>
			<option value=''></option>
			<option value='1'>Casa / hogar</option>
			<option value='2'>Escuela/ Lugar de estudio</option>
			<option value='3'>Calle / Vía Pública</option>
			<option value='4'>Trabajo</option>
			<option value='5'>Bar, cantina o similares</option>
			<option value='8'>Otro</option>
			<option value='9'>No se sabe</option>
			</select>
			<br>
			<input type=text onPaste='return false' name=otros1 style='display:none;' id='ot1' value=$otros1>
			</td>
			<tr>
			</table>
			<table align=center width=80% class='tbl2'>
			<tr>
			<th>ACTIVIDAD que realizaba cuando se lesionó</th>
			<th>MECANISMO / OBJETO DE LA LESIÓN (¿Cómo / Qué produjo la Lesión?)</th>
			<th>Uso de Alcohol En el lesionado</th>
			<th>Uso de Drogas En el lesionado</th>
			<th width=20%>PARA LOS QUEMADOS: Grado más grave</th>	
			</tr>
			<tr>
			<td align=center> 
			<select class='caja' name=actividad onchange='otro1(2)'>
			<option value=''></option>
			<option value='1'>Trabajo dependiente</option>
			<option value='2'>Oficio informal/ independiente</option>
			<option value='3'>Labores personales</option>
			<option value='4'>Estudiando</option>
			<option value='5'>Practicando Deporte</option>
			<option value='6'>Viajando</option>
			<option value='7'>Recreación/ descanso/ jugando</option>
			<option value='8'>Tomando licor</option>
			<option value='98'>Otra</option>
			<option value='99'>No se sabe</option>
			</select>
			<br>
			<input type=text onPaste='return false' name=otros2 style='display:none;' id='ot2' value='$otros2'>
			</td>
			<td align=center>
			<select class='caja' name=mecanismo onchange='otro1(3)'>
			<option value=''></option>
			<option value='1'>Lesión de Transporte
			<option value='2'>Agresión sexual
			<option value='3'>Caída Propia altura
			<option value='4'>Caída por escaleras
			<option value='5'>Otra Caída, altura ___ mts
			<option value='6'>Golpe / fuerza contundente
			<option value='7'>Corte / Puñalada
			<option value='8'>Objeto CortoContundente
			<option value='9'>Disparo de arma de fuego
			<option value='10'>Fuego/ llama/ humo
			<option value='11'>Líquido/ Objeto Caliente
			<option value='12'>Pólvora, cual__________
			<option value='13'>Estrangulado / Ahorcado
			<option value='14'>Inmersión / ahogado	
			<option value='15'>Asfixia por cuerpo extraño
			<option value='16'>Lesión por cuerpo extraño
			<option value='17'>Fármacos
			<option value='18'>Plaguicidas
			<option value='19'>Hidrocarburos
			<option value='20'>Otros Tóxicos
			<option value='21'>Minas/ Munición sin explotar
			<option value='22'>Otro artefacto explosivo
			<option value='23'>Mordedura de Persona
			<option value='24'>Animal, cual ____________
			<option value='25'>Electricidad 
			<option value='26'>Desastre natural, _________
			<option value='27'>Otro _________________
			<option value='28'>No se sabe	
			</select>
			<br><input type=text onPaste='return false' name=otros3 style='display:none;' id='ot3' value='$otros3'>
			</td>	
			<td align=center>
			<select class='caja' name=alcohol>
			<option value=''></option>
			<option value='1'>Si ha consumido
			<option value='2'>Sospecha de uso
			<option value='3'>No ha consumido
			<option value='9'>No se sabe	
			</select>
			</td>	
			<td align=center>
			<select class='caja' name=drogas>
			<option value=''></option>
			<option value='1'>Si ha consumido
			<option value='2'>Sospecha de uso
			<option value='3'>No ha consumido
			<option value='9'>No se sabe	
			</select>
			</td>	
			<td align=center>
			<select class='caja' name=quemado>
			<option value=''></option>
			<option value='1'>1
			<option value='2'>2
			<option value='3'>3	
			</select>
			<input type=text onPaste='return false' size=2 class='caja' name=porce value='$porce'>%
			</td>
			</tr>
			</table>	
			</table>
			<table align=center width=80% class='tbl2'>
			<tr><td height=40 align=center colspan=9>III  DATOS ESPECÍFICOS DEL EVENTO</td></tr>
			<tr>
			<th colspan=9>LESIÓN DE TRANSITO /TRANSPORTE</td>
			</tr><tr>
			<th rowspan=2>Tipo de transporte</td>
			<th rowspan=2>Contraparte</td>
			<th rowspan=2>Usuario</td>
			<th colspan=6>Elementos de seguridad?</td>
			</tr>
			<tr>
			<th>Elementos de seguridad?</td>
			<th>Cinturón</th>
			<th>Casco Moto</th>
			<th>Casco Bicicleta</th>
			<th>Chaleco</th>
			<th>Otro</th>
			</tr>
			<tr>	
			<td align=center>
			<select class='caja' name=tipotrans>
			<option value=''></option>
			<option value='1'>Peatón
			<option value='2'>Bicicleta
			<option value='3'>Motocicleta 
			<option value='4'>Automóvil 
			<option value='5'>Camioneta 
			<option value='6'>Camión
			<option value='7'>Bus/ microbús
			<option value='8'>Carreta / Animal
			<option value='9'>Taxi 
			<option value='10'>Otro 
			<option value='11'>No se sabe
			</select>
			</td>	
			<td align=center>
			<select class='caja' name=contrapar>
			<option value=''></option>
			<option value='1'>Peatón
			<option value='2'>Bicicleta
			<option value='3'>Motocicleta 
			<option value='4'>Automóvil 
			<option value='5'>Camioneta 
			<option value='6'>Camión
			<option value='7'>Bus/ microbús
			<option value='8'>Carreta / Animal
			<option value='9'>Taxi 
			<option value='10'>Objeto Fijo 
			<option value='11'>Sin Contraparte
			<option value='10'>Otro 
			<option value='11'>No se sabe
			</select>
			</td>		
			<td align=center>
			<select class='caja' name=usuario  onchange='otro1(4)'>
			<option value=''></option>
			<option value='1'>Peatón
			<option value='2'>Conductor 
			<option value='3'>Pasajero 
			<option value='8'>Otro_______
			<option value='9'>No se sabe	
			</select>
			<br>
			<input type=text onPaste='return false' name=otros4 style='display:none;' id='ot4' value='$otros4'>
			</td>	
			<td align=center>
			<select class='caja' name=elementos>
			<option value=''></option>
			<option value='SI'>SI
			<option value='NO'>NO
			<option value='N/S/A'>N/S/A	
			</select>
			</td>
			<td align=center>
			<select class='caja' name=cinturon>
			<option value=''></option>
			<option value='SI'>SI
			<option value='NO'>NO
			<option value='N/S/A'>N/S/A	
			</select>
			</td>	
			<td align=center>
			<select class='caja' name=cascomoto>
			<option value=''></option>
			<option value='SI'>SI
			<option value='NO'>NO
			<option value='N/S/A'>N/S/A	
			</select>
			</td>	
			<td align=center>
			<select class='caja' name=cascobici>
			<option value=''></option>
			<option value='SI'>SI
			<option value='NO'>NO
			<option value='N/S/A'>N/S/A	
			</select>
			</td>	
			<td align=center>
			<select class='caja' name=chaleco>
			<option value=''></option>
			<option value='SI'>SI
			<option value='NO'>NO
			<option value='N/S/A'>N/S/A	
			</select>
			</td>	
			<td align=center>
			<select class='caja' name=otroelem  onchange='otro1(5)'>
			<option value=''></option>
			<option value='SI'>SI
			<option value='NO'>NO
			<option value='N/S/A'>N/S/A 
			</select>
			<br>
			<input type=text onPaste='return false' name=otros5 style='display:none;' id='ot5' value='$otros5'>
			</td>	
			</tr>
			</table>
			<table align=center width=80% class='tbl2'>
			<tr><th colspan=4>VIOLENCIA INTERPERSONAL</th>
			<th colspan=3>INTENCIONAL AUTOINFLIGIDA</th>
			</tr>
			<tr>	
			<th>Antecedente previo de agresión</th>   
			<th>RELACIÓN DEL AGRESOR CON LA VICTIMA</th>   
			<th>CONTEXTO</th>
			<th>SEXO DE LOS AGRESORES</th>	
			<th>Intento prévio?</th>
			<th>Antecedente de Trastorno mental?</th>
			<th>FACTORES PRECIPITANTES</th>
			</tr>
			<tr>
			<td align=center>
			<select class='caja' name=antecede>
			<option value=''></option>
			<option value='SI'>SI
			<option value='NO'>NO
			<option value='N/S/A'>N/S	
			</select>
			</td>	
			<td align=center>
			<select class='caja' name=relacion  onchange='otro1(6)'>
			<option value=''></option>
			<option value='1'>Amigo/Conocido
			<option value='2'>Desconocido
			<option value='3'>Otro _________
			<option value='4'>No se sabe
			</select>
			<br>
			<input type=text onPaste='return false' name=otros6 style='display:none;' id='ot6' value='$otros6'>
			</td>	
			</td>	
			<td align=center>
			<select class='caja' name=contexto>
			<option value=''></option>
			<option value='1'>Riña / pelea
			<option value='2'>Robo
			<option value='3'>Agresión sexual 
			<option value='4'>Pandillas
			<option value='5'>Bala perdida 
			<option value='6'>No se sabe
			</select>
			</td>	
			<td align=center>
			<select class='caja' name=sexoagre>
			<option value=''></option>
			<option value='1'>Masculino 
			<option value='2'>Femenino 
			<option value='3'>Ambos 
			<option value='9'>No sabe
			</select>
			</td>		
			<td align=center>
			<select class='caja' name=intentopre>
			<option value=''></option>
			<option value='SI'>SI
			<option value='NO'>NO
			<option value='N/S'>N/S	
			</select>
			</td>	
			<td align=center>
			<select class='caja' name=antetrans>
			<option value=''></option>
			<option value='SI'>SI
			<option value='NO'>NO
			<option value='N/S'>N/S	
			</select>
			</td>	
			<td align=center>
			<select class='caja' name=factopreci onchange='otro1(7)'>
			<option value=''></option>
			<option value='1'>Conflicto con pareja o familia
			<option value='2'>Enfermedad física
			<option value='3'>Problemas financieros	
			<option value='4'>Problemas con la justicia
			<option value='5'>Muerte de pareja/ familiar
			<option value='6'>Abuso sexual o físico
			<option value='7'>Embarazo no deseado	
			<option value='8'>Problemas escolares
			<option value='98'>Otro __________
			<option value='99'>No se sabe
			</select>
			<br>
			<input type=text onPaste='return false' name=otros7 style='display:none;' id='ot7' value='$otros7'>
			</td>	
			</tr>	
			</table>	
			<table align=center width=80% class='tbl2'>
			<tr><td height=40 align=center colspan=9>IV  DATOS ESPECÍFICOS DEL EVENTO</td></tr>
			<tr></table>
			<table align=center width=80% class='tbl3'>
			<th>SITIO ANATOMICO AFECTADO</th>
			<th>NATURALEZA DE LA LESIÓN</th>
			<th>VIOLENCIA INTRAFAMILIAR</th>
			</tr>
			<tr>
			<td valign=top><input type=checkbox name=sitio1 value='1'>Sistémico (Intoxicación, Radiación, etc) – No aplican las otras.<br>
			<input type=checkbox name=sitio2 value='2'>Cráneo<br>
			<input type=checkbox name=sitio3 value='3'>Ojos<br>
			<input type=checkbox name=sitio4 value='4'>Maxilofacial / Nariz/ Oídos<br>
			<input type=checkbox name=sitio5 value='5'>Cuello<br>
			<input type=checkbox name=sitio6 value='6'>Tórax<br>
			<input type=checkbox name=sitio7 value='7'>Abdomen<br>
			<input type=checkbox name=sitio8 value='8'>Columna<br>
			<input type=checkbox name=sitio9 value='9'>Pelvis / genitales<br>
			<input type=checkbox name=sitio10 value='10'>Miembros Superiores<br>
			<input type=checkbox name=sitio11 value='11'>Miembros Inferiores<br>
			<input type=checkbox name=sitio12 value='98'  onclick='otro1(8)'>Otro
			<br>
			<input type=text onPaste='return false' name=otros8 style='display:none;' id='ot8' value='$otros8'>
			</td>	
			<td valign=top><input type=checkbox name=natu1 value='1'>Laceración, abrasión, lesión superficial<br>
			<input type=checkbox name=natu2 value='2'>Cortada, mordida, herida abierta<br>
			<input type=checkbox name=natu3 value='3'>Lesión profunda/ penetrante<br>
			<input type=checkbox name=natu4 value='4'>Esguince, luxación<br>
			<input type=checkbox name=natu5 value='5'>Fractura	<br>
			<input type=checkbox name=natu6 value='6'>Quemadura <br>
			<input type=checkbox name=natu7 value='7'>Contusión a órganos internos<br>
			<input type=checkbox name=natu8 value='8'>Lesión orgánica sistémica<br>
			<input type=checkbox name=natu9 value='9'>Trauma craneoencefálico<br>
			<input type=checkbox name=natu10  onclick='otro1(9)' value='98' >Otro<br>	
			<input type=checkbox name=natu11 value='99'>No se sabe
			<br>
			<input type=text onPaste='return false' name=otros9 style='display:none;' id='ot9' value='$otros9'>
			</td>	
			<td valign=top>
			<table align=center width=100% class='tbl3'>
			<tr><th>tipo maltrato</TH></tr>
			<tr>	
			<td align=center>
			<select class='caja' name=tipomaltrato>
			<option value=''></option>
			<option value='1'>Físico
			<option value='2'>Psicológico / verbal
			<option value='3'>Abuso Sexual	
			<option value='4'>Negligencia
			<option value='5'>Abandono
			<option value='6'>Institucional
			<option value='7'>Sin dato	
			</select>
			</td>	
			</tr>
			<tr><th>tipo agresor</TH></tr>
			<tr>
			<td align=center>
			<select class='caja' name=tipoagresor  onchange='otro1(10)'>
			<option value=''></option>
			<option value='1'>Padre
			<option value='2'>Madre
			<option value='3'>Padrastro	
			<option value='4'>Madrastra
			<option value='5'>Cónyuge/compañero
			<option value='6'>Hermano/a
			<option value='7'>Hijo	
			<option value='8'>Otro__________	
			</select>
			<br>
			<input type=text onPaste='return false' name=otros10 style='display:none;' id='ot10' value='$otros10'>
			</td>	
			</tr>	
			<tr><th>destino del paciente</TH></tr>
			<tr>
			<td align=center>
			<select class='caja' name=destino onchange='otro1(11)'>
			<option value=''></option>
			<option value='1'>Tratado y enviado a casa
			<option value='2'>Hospitalizado 
			<option value='3'>Fuga	
			<option value='4'>Alta voluntária 
			<option value='5'>Morgue (Muerto)
			<option value='6'>SAU - Fiscalía
			<option value='7'>CTI – Fiscalía
			<option value='8'>Comisaría de Familia	
			<option value='9'>ICBF	
			<option value='10'>URI - Fiscalía
			<option value='11'>Otro_________	
			</select>
			<br>
			<input type=text onPaste='return false' name=otros11 style='display:none;' id='ot11' value='$otros11'>
			</td>	
			</tr>		
			</tr>
			</table>	
			";
			?>
				<script language=JavaScript>
				uno.desplazado.value="<?echo $desplazado;?>";		
				uno.discapacitado.value="<?echo $discapacitado;?>";
				uno.grupoetnico.value="<?echo $grupoetnico;?>";	
				uno.remitido.value="<?echo $remitido;?>";	
				uno.intencionalidad.value="<?echo $intencionalidad;?>";		
				uno.lugar_evento.value="<?echo $lugar_evento;?>";
				uno.actividad.value="<?echo $actividad;?>";
				uno.mecanismo.value="<?echo $mecanismo;?>";
				uno.alcohol.value="<?echo $alcohol;?>";
				uno.drogas.value="<?echo $drogas;?>";
				uno.quemado.value="<?echo $quemado;?>";
				uno.tipotrans.value="<?echo $tipotrans;?>";
				uno.contrapar.value="<?echo $contrapar;?>";
				uno.usuario.value="<?echo $usuario;?>";	
				uno.elementos.value="<?echo $elementos;?>";		
				uno.cinturon.value="<?echo $cinturon;?>";
				uno.cascomoto.value="<?echo $cascomoto;?>";
				uno.cascobici.value="<?echo $cascobici;?>";
				uno.chaleco.value="<?echo $chaleco;?>";
				uno.otroelem.value="<?echo $otroelem;?>";		
				uno.antecede.value="<?echo $antecede;?>";
				uno.relacion.value="<?echo $relacion;?>";
				uno.contexto.value="<?echo $contexto;?>";
				uno.sexoagre.value="<?echo $sexoagre;?>";		
				uno.intentopre.value="<?echo $intentopre;?>";
				uno.antetrans.value="<?echo $antetrans;?>";
				uno.factopreci.value="<?echo $factopreci;?>";
				</script>
			<?
			echo"<BR><BR><BR><BR>
			<br><br>
			<table align=center class='tbl' width=100%>
			<tr><th colspan=3 align=center valign=top height=20><INPUT type=button class='boton' value='Guardar' onClick='salir();'></th></tr>	
			</table>";
		}
		else
		{
			echo"<body onload='salir2()'>";
		}
	}
		
	echo"<form>";
?>
</body>
</html>