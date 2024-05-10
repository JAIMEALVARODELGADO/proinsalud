<?
	session_register('paciente');
	session_register('numcita');
	session_register('Gcod_mediconh'); 
	session_register('Gareanh'); 
	/*
	if(empty($paciente))
	{
		echo"<br><br><table align=center class='tbl'>
		<tr><th>POR SEGURIDAD SU SESI�N SE CERR�. EIERRE E INGRESE NUEVAMENTE AL PROGRAMA</th></tr>
		</table>";
		exit;
	}
	*/
	//echo $Gareanh;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>

<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready
(
	function() 
	{		
		$("#course").autocomplete("autocomp4.php", {
		width: 500,
		minChars: 3,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220
		});	
		$("#course").result(function(event, data, formatted) 
		{$("#course_val").val(data['1']);
		$("#justi").val(data['2']);
		$("#posmdi").val(data['3']);
		$("#uni").val(data['4']);
		});
	}	
);
$().ready(function() {	
		$("#course2").autocomplete("auto_insu.php", {
		width: 600,
		minChars: 3,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220
		});	
		$("#course2").result(function(event, data, formatted) {
		$("#course_val2").val(data['1']);
		$("#posins").val(data['2']);
		});
	});
</script>
<script language="JavaScript">
	
	function elimina(h,n,m)
	{	
		uno.tipfor.value=h;
		uno.itemeli.value=n;
		uno.variables.value=m;
		uno.target='';
		uno.action='eliminareg.php';
		uno.submit();	
	}	
	
	function busqueda()
	{	
		uno.target='';
		uno.action='medica0.php';
		uno.submit();	
	}	
	function salida()
	{	
		uno.canti.disabled=false;
		uno.target='';	
		uno.action='contrare0.php';
		uno.submit();	
	}	
	function valida(ope)
	{		
		
		if(ope=='1' || ope=='2')
		{
			opcion = document.getElementsByName("tipomedi");
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
				alert("Seleccione el tipo de orden");
				return;
			}
			
			
			if(uno.desmedi.value=='')
			{
				alert("Seleccione el medicamento o dispositivo");
				uno.desmedi.focus();
				return;
			}
			
			if(uno.codmedi.value=='')
			{
				alert("Seleccione el medicamento o dispositivo");
				uno.desmedi.focus();
				return;
			}
			if(opcion[0].checked)
			{
				if(uno.dosis.value=='')
				{
					alert("Digite la dosis");
					uno.dosis.focus();
					return;
				}
				if(uno.unid.value=='')
				{
					alert("Seleccione la unidad de la dosis");
					uno.unid.focus();
					return;
				}
				if(uno.frecu.value=='')
				{
					alert("Digite la frecuencia");
					uno.frecu.focus();
					return;
				}
				if(uno.unidfrecu.value=='')
				{
					alert("Seleccione la unidad de la frecuencia");
					uno.unidfrecu.focus();
					return;
				}
				if(uno.tiempo.value=='')
				{
					alert("Digite el tiempo de tratamiento");
					uno.tiempo.focus();
					return;
				}		
			}	
			uno.canti.disabled=false;
			if(uno.canti.value=='')
			{
				alert("Digite la cantidad a prescribir");
				uno.canti.focus();
				uno.canti.disabled=false;
				return;
			}
			
			if(uno.diagmedi.value=='')
			{
				alert("Seleccione el diagnostico");
				uno.diagmedi.focus();
				return;
			}
			uno.action='formujusti_captura.php';
		}
		if(ope==3)
		{
			if(uno.cod_mdi.value==''){alert("Digite la descripcion del medicamento");return;}
			if(uno.cantidad.value==''){alert("Digite la cantidad ");return;}
			if(uno.dosis_teorica.value==''){alert("Digite la dosis teórica");return;}
			if(uno.unid_dt.value==''){alert("Seleccione la unidad de la dosis teorica");return;}
			if(uno.dosis_resultante.value==''){alert("Digite la dosis resultante");return;}
			if(uno.unid_dr.value==''){alert("Seleccione la unidad de la dosis resultante");return;}
			if(uno.porcentaje_ajuste.value==''){alert("Digite el porcentaje de ajuste");return;}
			if(uno.dosis_definitiva.value==''){alert("Digite la dosis definitiva");return;}
			if(uno.unid_dd.value==''){alert("Seleccione la unidad de la dosis definitiva");return;}
			if(uno.via_administracion.value==''){alert("Seleccione la via de administracion");return;}
			if(uno.vehiculo.value==''){alert("Digite el vehiculo");return;}
			if(uno.volumen.value==''){alert("Digite el volumen");return;}
			if(uno.duracion_infusion.value==''){alert("Digite la duracion de la infusion");return;}
			if(uno.frecuencia.value==''){alert("Digite la frecuencia");return;}
			if(uno.intervalo1.value==''){alert("Digite el intervalo");return;}
			if(uno.intervalo2.value==''){alert("Digite el intervalo");return;}			
			if(uno.duracion_tratamiento1.value==''){alert("Digite la duracion del tratamiento");return;}
			if(uno.duracion_tratamiento2.value==''){alert("Digite la duracion del tratamiento");return;}
			uno.action='almacena.php';
		}
		uno.clasemedi.value=ope;
		uno.target='';
		uno.submit();	
	}
	function mensa()
	{
		if(uno.cuenta.value==1)
		{
			uno.cuenta.value=0;
			uno.target='';
			uno.action='medica0.php';
			uno.submit();	
		}
		else
		{
			if(uno.mensaje.value==1)
			{
				alert("Se requiere diligenciar el modulo de diagnosticos");
				uno.target='';
				uno.action='diagnos0.php';
				uno.submit();	
			}
		}
	}
	function cambiauni()
	{
		if(uno.unidad.value=='1')
		{
			uno.unid.value='UND';
			uno.canti.disabled=true;
			
			if(uno.dosis.value!='' && uno.frecu.value!='' && uno.tiempo.value!='' && uno.unidfrecu.value!='')
			{				
				dos=eval(uno.dosis.value);
				fr=uno.frecu.value;
				ti=uno.tiempo.value;
				uf=uno.unidfrecu.value;
				var ut=0;
				var tt=0;
				var ft=0;				
				if(uf=='Minutos')ut=1;
				if(uf=='Horas')ut=60;
				if(uf=='Dias')ut=1440;				
				tt=ti*1440;
				ft=ut*fr;				
				can=(tt/ft)*dos;			
				uno.canti.value=can;
			}
		}
		else
		{
			if(uno.unid.value=='UND')uno.unid.value='';
			uno.canti.disabled=false;
		}
	}
	function calcula(n)
	{
		
		
		if(n==1)
		{			
			uno.unid_dr.value=uno.unid_dt.value;
			uno.unid_dd.value=uno.unid_dt.value;			
			if(uno.factor.value=='1')
			{
				uno.dosis_resultante.value=uno.dosis_teorica.value*uno.circorround.value;
			}
			if(uno.factor.value=='2')
			{
				uno.dosis_resultante.value=uno.dosis_teorica.value*uno.peso.value;
			}			
			
		}		
		if(n==2)
		{
			uno.dosis_definitiva.value=uno.dosis_resultante.value*uno.porcentaje_ajuste.value/100;
		}	
		
	}
	
	
</script>
</head>	
<body onload='mensa()'>
<?
	echo"<form name=uno method=post>
	<input type=hidden name=clasemedi>
	<input type=hidden name=codiprg value='6'>
	<input type=hidden name=itemeli>
	<input type=hidden name=cuenta value='$cuenta'>
	<input type=hidden name=variables>
	<input type=hidden name=tipfor>
	
	
	<BR><BR>
	<table align=center width=100%>";
	$archiex='tmp/3HC'.$numcita.'-'.$paciente.'.txt';	
	if(file_exists($archiex))
	{
		$fp = fopen ($archiex, "r" );
		$reg1=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{ 
			$reg1++;
			$j = 0;
			foreach($data as $dato)
			{
				$campoex[$j]=$dato;
				$j++ ;
			}
			$$campoex[1]=$campoex[2];					
		}
	}	
	
	$archivo2='tmp/4HC'.$numcita.'-'.$paciente.'.txt';
	//echo $cuenta;
	if(file_exists($archivo2) || $Gcod_mediconh=='98396211')
	{
		echo"<input type=hidden name=mensaje value=0>";
		include ('php/conexion1.php');
		if(empty($tipomedi))$tipomedi=1;
		if(empty($tipofor))$tipofor=1;
		
		echo"
		<tr><td>
		<table align=center class='tbl' width=100%>
		<tr><th>MEDICAMENTOS Y DISPOSITIVOS MEDICO-QUIRURGICOS</th></tr>
		</table>
		<br><br>
		
		<TR><TD>
		
		
		
		<TR><TD><table align=center class='tbl' width=100%>
		<tr><th class='caja' align=center height=30>TIPO DE FORMULA</th>
		<TD class='caja' align=center>";
		if($tipofor==1)
		{
			echo"FORMULA MEDICA <input type=radio name=tipofor checked value=1 onclick='busqueda()'>
			FORMULA MEDICA ONCOLOGICA<input type=radio name=tipofor value=2 onclick='busqueda()'>";
		}
		if($tipofor==2)
		{
			echo"FORMULA MEDICA <input type=radio name=tipofor value=1 onclick='busqueda()'>
			FORMULA MEDICA ONCOLOGICA <input type=radio name=tipofor checked value=2 onclick='busqueda()'>";
		}
		echo"</td></tr></table>
		
		
		
		<table align=center class='tbl' width=100%>
		<tr><th class='caja' align=center height=30>TIPO DE ORDEN</th>
		<TD class='caja' align=center>";
		if($tipomedi==1)
		{
			echo"MEDICAMENTOS <input type=radio name=tipomedi checked value=1 onclick='busqueda()'>
			DISPOSITIVOS MEDICOS <input type=radio name=tipomedi value=2 onclick='busqueda()'>";
		}
		if($tipomedi==2)
		{
			echo"MEDICAMENTOS <input type=radio name=tipomedi value=1 onclick='busqueda()'>
			DISPOSITIVOS MEDICOS <input type=radio name=tipomedi checked value=2 onclick='busqueda()'>";
		}
		echo"</td></tr></table>
		<br><br>
		<table align=center class='tbl'>";
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
		if($tipofor==1)
		{
			
			if($tipomedi==1)
			{
				ECHO"
				<input type='hidden' id='uni' name='unidad' value='$unidad'>
				<tr>
				<th>PRODUCTO FARMACEUTICO</th>
				<th>DOSIS</th>
				<th>FRECUENCIA</th>
				<th>VIA</th>
				<th>TIEMPO TTO</th>
				<th>OBSERVACION</th>
				<th>CANTIDAD</th>
				</tr>			
				<tr>
				<td align=center><textarea onPaste='return false' id='course'  class='caja' name='desmedi' rows=2 cols=50>$desmedi</textarea></td>			
				<td align=center><input type=text onPaste='return false' class='caja' onblur='cambiauni()' onFocus='cambiauni()' name=dosis  size=2 onKeypress='if ((event.keyCode > 47 && event.keyCode <58) || event.keyCode==46 || event.keyCode==47 ) event.returnValue = true;else event.returnValue = false' value='$dosis'>";
				echo"
				<select class='caja' name=unid onChange='cambiauni()'>
				<option value=''></option>
				<option value='UND'>UND</option>
				<option value='CC'>CC</option>
				<option value='GOTAS'>GOTAS</option>
				<option value='GR'>GR</option>
				<option value='MG'>MG</option>
				<option value='MCG'>MCG</option>
				<option value='UI'>UI</option>
				<option value='PUFF'>PUFF</option>			
				<option value='SOBRES'>SOBRES</option>
				<option value='APLICACION'>APLICACION</option>
				</select>";
				echo"
				</td>			
				<td align=center><input type=text onPaste='return false' class='caja' name=frecu onblur='cambiauni()' onFocus='cambiauni()' size=2 onKeypress='if (event.keyCode > 47 && event.keyCode <58 ) event.returnValue = true;else event.returnValue = false'>
				<select class='caja' name=unidfrecu onChange='cambiauni()'>
				<option value=''></option>
				<option value='Minutos'>Minutos</option>
				<option value='Horas'>Horas</option>
				<option value='Dias'>Dias</option>			
				</select>	
				</td>";
				$busvia=mysql_query("select * from destipos where codt_des='22' order by nomb_des");
				echo"<td align=center><select name=via class='caja'  onChange='cambiauni()'>
				<option value=''></option>";
				while($resvia=mysql_fetch_array($busvia))
				{
					$codv=$resvia['codi_des'];
					$nomv=$resvia['nomb_des'];
					echo"<option value=$codv>$nomv</option>";
				}
				echo"</select></td>
				<td align=center><input type=text onPaste='return false' onblur='cambiauni()' onFocus='cambiauni()' class='caja' name=tiempo size=2 onKeypress='if (event.keyCode > 47 && event.keyCode <58 ) event.returnValue = true;else event.returnValue = false'> DIAS</td>
				<td align=center><textarea onPaste='return false' class='caja' name='obsemed' rows=2 cols=50>$obsemed</textarea></td>	
				
				<td align=center><input type=text onPaste='return false' name=canti disabled  class='caja' size=2 onKeypress='if (event.keyCode > 47 && event.keyCode <58 ) event.returnValue = true;else event.returnValue = false'></td></tr>			
				<input type='hidden' id='course_val' name='codmedi' value='$codmedi'>
				<input type='hidden' id='justi' name='justifi' value='$justifi'>	
				<input type='hidden' id='posmdi' name='pos' value='$pos'>
				
				<tr><th colspan=7>DIAGNOSTICO <select class='caja' name=diagmedi  onChange='cambiauni()'>
				<option value=''></option>
				<option value=$cod>$map</option>
				<option value=$cod1>$map1</option>
				<option value=$cod2>$map2</option>
				<option value=$cod3>$map3</option>
				</select>
				</td>
				</tr>
				<tr><th colspan=7 align=center valign=top height=20><INPUT type=button class='boton' value= GUARDAR onClick='valida(1);'></th></tr>	
				";
				echo "<input type=hidden name=nivel>";
				
			}
			else
			{			
				$datos[0]='desc_ins';
				$datos[1]='codnue';
				$datos[2]='insu_med';				
				ECHO"<tr>
				<th>DISPOSITIVO</th>			
				<th>CANTIDAD</th>
				</tr>			
				<tr>
				<td align=center><textarea onPaste='return false' id='course2' class='caja' name='desmedi' rows=2 cols=68>$desmedi</textarea></td>
				<td align=center><input type=text onPaste='return false' name=canti size=4></td></tr>			
				<input type='hidden' id='course_val2' name='codmedi' value='$codmedi'>
				<input type='hidden' id='posins' name='pos' value='$pos'>
				<tr><th colspan=3>DIAGNOSTICO <select class='caja' name=diagmedi>
				
				
				<option value=''></option>
				<option value=$cod>$map</option>
				<option value=$cod1>$map1</option>
				<option value=$cod2>$map2</option>
				<option value=$cod3>$map3</option>
				</select>
				</td>
				</tr>
				<tr><th colspan=3 align=center valign=top height=20><INPUT type=button class='boton' value= GUARDAR onClick='valida(2);'></th></tr>";
			}
			
		}		
		if($tipofor==2)
		{
			$circor=sqrt(($peso*$talla)/3600);
			$circorround=number_format ($circor , 2 , "." , "," );
			
			
			
			ECHO"
			<input type=hidden name=peso value='$peso'>
			<input type=hidden name=circorround value='$circorround'>
			<table width=70% align=center>
			<tr><td>
			
			<table align=center width=100% class='tbl'>
			<th>PESO</th>
			<td align=center><font size=3><b>$peso</td>
			<th>TALLA</th>
			<td align=center><font size=3><b>$talla</td>
			<th>SCT</th>
			<td align=center><font size=3><b>$circorround</td>
			<th>CICLO</th>
			<td align=center>
			<input type=text class=caja size=3 name=ciclo onKeypress='if (event.keyCode > 47 && event.keyCode <58 ) event.returnValue = true;else event.returnValue = false' value='$ciclo'>
			
			</td>
			</tr>
			</table>
			<br><br>			
			
			<table align=center width=100% class='tbl'>
			<input type='hidden' id='uni' name='unidad' value='$unidad'>
			<tr>
			<th>MEDICAMENTO</th>
			<th>OBSERVACION</th>
			<th>CANTIDAD</th>
			</tr>
			<tr>
			<td align=center><textarea onPaste='return false' id='course'  class='caja' name='desmedi' rows=2 cols=50>$desmedi</textarea></td>
			<td align=center><textarea onPaste='return false' class='caja' name='obsemed' rows=2 cols=50>$obsemed</textarea></td>				
			<td align=center><input type=text onPaste='return false' name=cantidad class='caja' size=2 onKeypress='if (event.keyCode > 47 && event.keyCode <58 ) event.returnValue = true;else event.returnValue = false'></td></tr>			
			<input type='hidden' id='course_val' name='cod_mdi' value='$cod_mdi'>
			<input type='hidden' id='justi' name='justifi' value='$justifi'>	
			<input type='hidden' id='posmdi' name='pos' value='$pos'>
			</tr>
			</table>
			<br><br>
			
			<table align=center width=100% class='tbl'>			
			
			<tr>				
			<th colspan=5>DOSIS</th>			
			<th rowspan=2>VIA DE ADMINISTRACION</th>
			</tr>
			<tr>				
			<th>TEORICA</th>
			<th>FACTOR DE MULTIPLICACION</th>
			<th>RESULTANTE</th>
			<th>% DE AJUSTE</th>
			<th>DEFINITIVA</th>
			</tr>
			
			<tr>			
			<td align=center><input type=text onPaste='return false' class='caja' onblur='calcula(1)' onFocus='calcula(1)' name=dosis_teorica  size=2 onKeypress='if ((event.keyCode > 47 && event.keyCode <58) || event.keyCode==46 || event.keyCode==47 ) event.returnValue = true;else event.returnValue = false' value='$dosis_teorica'>
			<select class='caja' name=unid_dt onChange='calcula(1)'>
			<option value=''></option>
			<option value='UND'>UND</option>
			<option value='CC'>CC</option>
			<option value='GOTAS'>GOTAS</option>
			<option value='GR'>GR</option>
			<option value='MG'>MG</option>
			<option value='MCG'>MCG</option>
			<option value='UI'>UI</option>
			<option value='PUFF'>PUFF</option>			
			<option value='SOBRES'>SOBRES</option>
			<option value='APLICACION'>APLICACION</option>
			</select>
			</td>
			<td align=center>
			<select class='caja' name=factor onChange='calcula(1)'>
			<option value=''></option>
			<option value='1'>SCT</option>
			<option value='2'>PESO</option>
			</select>
			
			</td>
			<td align=center><input type=text onPaste='return false' class='caja' onblur='calcula(2)' onFocus='calcula(2)' name=dosis_resultante  size=2 onKeypress='if ((event.keyCode > 47 && event.keyCode <58) || event.keyCode==46 || event.keyCode==47 ) event.returnValue = true;else event.returnValue = false' value='$dosis_resultante'>
			<select class='caja' name=unid_dr onChange='calcula(2)'>
			<option value=''></option>
			<option value='UND'>UND</option>
			<option value='CC'>CC</option>
			<option value='GOTAS'>GOTAS</option>
			<option value='GR'>GR</option>
			<option value='MG'>MG</option>
			<option value='MCG'>MCG</option>
			<option value='UI'>UI</option>
			<option value='PUFF'>PUFF</option>			
			<option value='SOBRES'>SOBRES</option>
			<option value='APLICACION'>APLICACION</option>
			</select>
			</td>
			<td align=center><input type=text onPaste='return false' class='caja' onblur='calcula(2)' onFocus='calcula(2)' name=porcentaje_ajuste  size=2 onKeypress='if ((event.keyCode > 47 && event.keyCode <58) || event.keyCode==46 || event.keyCode==47 ) event.returnValue = true;else event.returnValue = false' value='$porcentaje_ajuste'></td>
			
						
			<td align=center><input type=text onPaste='return false' class='caja'  name=dosis_definitiva  size=2 onKeypress='if ((event.keyCode > 47 && event.keyCode <58) || event.keyCode==46 || event.keyCode==47 ) event.returnValue = true;else event.returnValue = false' value='$dosis_definitiva'>
			<select class='caja' name=unid_dd>
			<option value=''></option>
			<option value='UND'>UND</option>
			<option value='CC'>CC</option>
			<option value='GOTAS'>GOTAS</option>
			<option value='GR'>GR</option>
			<option value='MG'>MG</option>
			<option value='MCG'>MCG</option>
			<option value='UI'>UI</option>
			<option value='PUFF'>PUFF</option>			
			<option value='SOBRES'>SOBRES</option>
			<option value='APLICACION'>APLICACION</option>
			</select>
			</td>";
			
			$busvia=mysql_query("select * from destipos where codt_des='22' order by nomb_des");
			echo"<td align=center><select name=via_administracion class='caja'  onChange='cambiauni()'>
			<option value=''></option>";
			while($resvia=mysql_fetch_array($busvia))
			{
				$codv=$resvia['codi_des'];
				$nomv=$resvia['nomb_des'];
				echo"<option value=$codv>$nomv</option>";
			}
			
			
			echo"</select></td>
			</TR>
			</table>
			
			<br><br>
			<table align=center width=100% class='tbl'>
			<tr>
			<th>VEHICULO</th>
			<th>VOLUMEN TTO</th>
			<th>DURACION INFUSION</th>
			<th>FRECUENCIA</th>
			<th>INTERVALO</th>
			<th>DURACION TRATAMIENTO</th>
			</tr>
			
			<tr>
			<td align=center>
			<select name=vehiculo>
			<option value=''></option>
			<option value='SSN'>SSN</option>
			<option value='DEXTOSA AL 5%'>DEXTOSA AL 5%</option>
			<option value='LACTATO DE RINGER'>LACTATO DE RINGER</option>
			<option value='AGUA DESTILADA'>AGUA DESTILADA</option>
			<option value='NO APLICA'>NO APLICA</option>
			</select>
			</td>
			
			
			<td align=center>
			<select name=volumen>
			<option value=''></option>
			<option value='5'>5</option>
			<option value='10'>10</option>
			<option value='50'>50</option>
			<option value='100'>100</option>
			<option value='200'>200</option>
			<option value='250'>250</option>
			<option value='300'>300</option>
			<option value='400'>400</option>
			<option value='500'>500</option>
			<option value='NO APLICA'>NO APLICA</option>
			</select>
			</td>
			
			<td align=center>
			<select name=duracion_infusion>
			<option value=''></option>
			<option value='1 minutos'>1 minuto</option>
			<option value='5 minutos'>5 minutos</option>
			<option value='10 minutos'>10 minutos</option>
			<option value='15 minutos'>15 minutos</option>
			<option value='20 minutos'>20 minutos</option>
			<option value='30 minutos'>30 minutos</option>
			<option value='1 hora'>1  hora</option>
			<option value='2 horas'>2 horas</option>
			<option value='3 horas'>3 horas</option>
			<option value='4 horas'>4 horas</option>
			<option value='12 horas'>12 horas</option>
			<option value='24 horas'>24 horas</option>
			<option value='NO APLICA'>NO APLICA</option>
			</select>
			</td>
			
			<td align=center>
			<select name=frecuencia>
			<option value=''></option>
			<option value='4 horas'>4 horas</option>
			<option value='6 horas'>6 horas</option>
			<option value='8 horas'>8 horas</option>
			<option value='12 horas'>12 horas</option>
			<option value='24 horas'>24 horas</option>
			<option value='DOSIS UNICA'>DOSIS UNICA</option>
			</td>
			
			<td align=center>
			<select name=intervalo1>
			<option value=''></option>
			<option value='1'>1</option>
			<option value='1 a 2'>1 a 2</option>
			<option value='1 a 3'>1 a 3</option>
			<option value='1 a 4'>1 a 4</option>
			<option value='1 a 5'>1 a 5</option>
			</select>
			<select name=intervalo2>
			<option value='7 dias'>7 dias</option>
			<option value='14 dias'>14 dias</option>
			<option value='21 dias'>21 dias</option>
			<option value='28 dias'>28 dias</option>
			</select>
			</td>
			
			<td align=center><input ty++pe=text onPaste='return false' class='caja' name=duracion_tratamiento1 onblur='cambiauni()' onFocus='cambiauni()' size=20 onKeypress='if (event.keyCode > 47 && event.keyCode <58 ) event.returnValue = true;else event.returnValue = false'>
			<select name=duracion_tratamiento2>
			<option value='dias'>dias</option>
			<option value='meses'>meses</option>			
			</select>
			</td>
			</tr>
			
			<tr>
			<th colspan=6 align=center valign=top height=20><INPUT type=button class='boton' value= 'GUARDAR' onClick='valida(3)'></th>
			</tr>
			</table>";
		}
		
		
		echo"</table>
	
		<br><br>		
		";
		$archivo='tmp/6HC'.$numcita.'-'.$paciente.'.txt';	
		if(file_exists($archivo))
		{
			echo"
			<table align=center class='tbl'>
			<tr>
			<th align=center>ELIMINAR</th>
			<th align=center>TIPO</th>
			<th align=center>DX</th>			
			<th>PRODUCTO FARMACEUTICO</th>
			<th>DOSIS</th>
			<th>FRECUENCIA</th>
			<th>VIA</th>
			<th>TIEMPO TTO</th>
			<th>OBSERVACION</th>
			<th>CANTIDAD MENSUAL</th>
			</tr>";
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
				if($reg % 14 == 0)
				{
					$nvia='';
					if($clasemedi=='1')$tipo='MED';
					if($clasemedi=='2')$tipo='DIS';
					$bvia1=mysql_query("select * from destipos where codi_des='$via'");
					while($rvia1=mysql_fetch_array($bvia1))
					{
						$nvia=$rvia1['nomb_des'];
					}					
					echo"<tr>
					<td align=center><a href='#' onclick='elimina(1,$cont,14)'><img src='img/eli.png' border=0></a></td>
					<td align=center>$tipo</td>
					<td>$diagmedi</td>
					<td>$desmedi</td>					
					<td>$dosis $unid</td>
					<td>$frecu $unidfrecu</td>
					<td>$nvia</td>
					<td>$tiempo</td>
					<td>$obsemed</td>
					<td align=center>$canti</td>
					</tr>";	
					$cont++;
				}				
			}
			echo"</table>";	
		}
		
		
		
		$archivonco='tmp/medonco'.$numcita.'-'.$paciente.'.txt';
		if(file_exists($archivonco))
		{
			echo"<BR><BR>
			<table align=center class='tbl'>
			<tr>
			<th align=center>ELIMINAR</th>
			<th align=center>CODIGO</th>	
			<th>PRODUCTO FARMACEUTICO</th>
			<th>OBSERVACION</th>
			<th>CANTIDAD</th>
			<th>  TEORICA</th>
			<th>DOSIS RESULTANTE</th>
			<th>% DE AJUSTE</th>
			<th>DOSIS DEFINITIVA TTO</th>
			<th>VIA DE ADMINISTRACION</th>
			<th>VEHICULO</th>
			<th>VOLUMEN</th>
			<th>DURACION</th>
			<th>FRECUENCIA</th>
			<th>INTERVALO</th>
			<th>DURACION TRATAMIENTO</th>
			<th>CICLO</th>
			
			</tr>";
			$fp = fopen ($archivonco, "r" );
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
				if($reg % 19 == 0)
				{
					$nvia='';
					if($clasemedi=='1')$tipo='MED';
					if($clasemedi=='2')$tipo='DIS';
					$bvia1=mysql_query("select * from destipos where codi_des='$via_administracion'");
					while($rvia1=mysql_fetch_array($bvia1))
					{
						$nvia=$rvia1['nomb_des'];
					}					
					echo"<tr>
					<td align=center><a href='#' onclick='elimina(2,$cont,18)'><img src='img/eli.png' border=0></a></td>
					<td align=center>$cod_mdi</td>
					<td>$desmedi</td>
					<td>$obsemed</td>
					<td>$cantidad</td>					
					<td>$dosis_teorica $unid_dt</td>
					<td>$dosis_resultante $unid_dr</td>
					<td>$porcentaje_ajuste</td>
					<td>$dosis_definitiva $unid_dd</td>
					<td>$nvia</td>
					<td align=center>$vehiculo</td>
					<td align=center>$volumen</td>
					<td align=center>$duracion_infusion</td>
					<td align=center>$frecuencia</td>
					<td align=center>$intervalo</td>
					<td align=center>$duracion_tratamiento</td>
					<td align=center>$ciclo</td>
					</tr>";	
					$cont++;
					
				}				
			}
			echo"</table>";	
		}
		
		
		
				
		$archivo2='tmp/7HC'.$numcita.'-'.$paciente.'.txt';	
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
		
		echo"<INPUT type=hidden name='repetir' value=''>";
/*		
		echo"<br><br><table align=center class='tbl'>			
		<tr>
		<th align=center valign=top height=20>REPETIR FORMULA POR</th>
		<td align=center valign=top height=20><INPUT type=text onPaste='return false' class='caja' size=4 name='repetir' value='$repetir'> meses</td>
		</tr>	
			
		</table>";
		*/
		$archivo='tmp/6HC'.$numcita.'-'.$paciente.'.txt';	
		if(file_exists($archivo))
		{
			echo"<br><br><table align=center class='tbl' width=100%>			
			<tr><th colspan=2 align=center valign=top height=20><INPUT type=button class='boton' value= 'FINALIZAR' onClick='salida()'></th></tr>	
			</table>";		
		}
	}
	else
	{
		echo"<input type=hidden name=mensaje value=1>";
	}
	echo"</td></tr></table></form>";
?>
</body>
</html>