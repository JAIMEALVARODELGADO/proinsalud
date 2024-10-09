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
			
			opci=document.getElementsByName("transcripcion");
			if(opci[0].checked)
			{				
				if(uno.espetratante.value==''){alert("Seleccione la especialidad a la que transcribe");return;}	
				if(uno.medtratante.value==''){alert("Seleccione el medico al que transcribe");return;}
			}
			
			
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
			opci=document.getElementsByName("transcripcion");
			if(opci[0].checked)
			{				
				if(uno.espetratante.value==''){alert("Seleccione la especialidad a la que transcribe");return;}	
				if(uno.medtratante.value==''){alert("Seleccione el medico al que transcribe");return;}
			}
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
	function valida_onco()
	{
		uno.action='almacena.php';		
		uno.clasemedi.value=3;
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
			document.getElementById("dosismed").maxLength=1;
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
			document.getElementById("dosismed").maxLength=5;
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
	function abremodal() 
	{		
		if(uno.abremod.value=='1')
		{
			document.getElementById('openModal').style.display = 'block';
		}
	}
	function CloseModal() 
	{
		document.getElementById('openModal').style.display = 'none';
	}
	function cargamodal()
	{
		uno.abremod.value='1';
		uno.numhor.value='1';
		uno.target='';
		uno.action='medica0.php';
		uno.submit();
	}
	
	
</script>
</head>	

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
	width: 94%;
	position: relative;
	margin: 2% auto;
	padding: 5px 20px 13px 20px;
	border-radius: 10px;
	background: #fff;
	background: -moz-linear-gradient(#fff, #999);
	background: -webkit-linear-gradient(#fff, #999);
	background: -o-linear-gradient(#fff, #999);
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
<body onload="abremodal()">
<!--<body onload='mensa()'>-->
<?
	// UPDATE `horarios` SET `Fecha_horario` = '2023-05-16' WHERE `cmed_horario` ='12991944'
	
	echo"<form name=uno method=post>
	<input type=hidden name=clasemedi>
	<input type=hidden name=codiprg value='6'>
	<input type=hidden name=itemeli>
	<input type=hidden name=cuenta value='$cuenta'>
	<input type=hidden name=variables>
	<input type=hidden name=tipfor>
	<input type=hidden name=abremod value='$abremod'>
	<input type=hidden name=numhor value='$numhor'>
	
	
	<BR><BR>
	<center>
	<table align=center width=90%>";
	$archiex='tmp/3HC'.$numcita.'-'.$paciente.'.txt';	
	if(file_exists($archiex))
	{
		$fp = fopen ($archiex, "r" );
		$reg1=0;
		while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) 
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
		<tr>
		<th class='caja' align=center height=30 width=40%>TIPO DE FORMULA</th>
		<td class='caja' align=center>";
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
		<tr><th class='caja' align=center height=30 width=40%>TIPO DE ORDEN</th>
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
		
		if(empty($transcripcion))$transcripcion='N';
		$chk1='';$chk2='';
		if($transcripcion=='S')
		{
			$chk1="checked";
			$dis="";
		}
		if($transcripcion=='N')
		{
			$chk2="checked";
			$dis="disabled";
		}
		
		echo "
		</td></tr></table>
		<table align=center class='tbl' width=100%>
		<tr>
		<th class='caja' align=center height=30 width=40%>TRANSCRIPCION DE ESPECIALISTA</th>
		
		<td class='caja' align=center>SI &nbsp;&nbsp;<input type=radio $chk1 name=transcripcion value='S' onclick='busqueda()'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		NO &nbsp;&nbsp;<input type=radio $chk2 name=transcripcion value='N' onclick='busqueda()'></td>
		</tr>";
		echo"</td></tr></table><BR>
		
		<table align=center class='tbl' width=100%>
		<tr><th class='caja' align=center height=30 width=15%>ESPECIALIDAD</th>
		<td class='caja' align=center width=35%>
			
			<select class='caja' name=espetratante $dis onchange='busqueda()'>
			<option value=''></option>";
			$besp=mysql_query("SELECT destipos.codi_des, destipos.nomb_des FROM destipos 
			WHERE (((destipos.codt_des)='26') AND ((destipos.valo_des)='2611' Or (destipos.valo_des)='2630')) ORDER BY destipos.nomb_des");
			while($resp=mysql_fetch_array($besp))
			{
				$cesp=$resp['codi_des'];
				$nesp=$resp['nomb_des'];
				if($espetratante==$cesp)echo"<option selected value='$cesp'>$nesp</option>";
				else echo"<option value='$cesp'>$nesp</option>";
			}
			echo"
			</select>
		</td>
		<th class='caja' align=center height=30 width=15%>MEDICO</th>
		<td class='caja' align=center width=35%>
			<select class='caja' name=medtratante $dis onchange='busqueda()'>
			<option value=''></option>";
			$bmed=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi, medicos.espe_med, destipos.valo_des
			FROM medicos INNER JOIN destipos ON medicos.espe_med = destipos.codi_des
			WHERE (((medicos.espe_med)='$espetratante') AND ((destipos.valo_des)='2611' Or (destipos.valo_des)='2630'))
			ORDER BY medicos.nom_medi");
			while($rmed=mysql_fetch_array($bmed))
			{
				$cmed=$rmed['cod_medi'];
				$nmed=$rmed['nom_medi'];
				if($medtratante==$cmed)echo"<option selected value='$cmed'>$nmed</option>";
				else echo"<option value='$cmed'>$nmed</option>";
			}
			echo"
			</select>
		</td>
		</tr>
		</table>
		<br><br>
		<table align=center class='tbl' width='100%'>";
		$archivo2='tmp/4HC'.$numcita.'-'.$paciente.'.txt';	
		if(file_exists($archivo2))
		{
			$fp = fopen ($archivo2, "r" );
			$reg1=0;
			while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) 
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
				<td align=center><input type=text onPaste='return false' id='dosismed' class='caja' onblur='cambiauni()' onFocus='cambiauni()' name=dosis maxlength=2 size=2 onKeypress='if ((event.keyCode > 47 && event.keyCode <58) || event.keyCode==46 || event.keyCode==47 ) event.returnValue = true;else event.returnValue = false' value='$dosis'>";
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
			$bprot=mysql_query("select * from quimio_protoenca order by nom_proenca");
			
			
			ECHO"
			<input type=hidden name=peso value='$peso'>
			<input type=hidden name=circorround value='$circorround'>
			<center>
			<table width=100% align=center>
			<tr><td align=center>";
			/*
			ECHO "<table align=center width=70% class='tbl'>
			<th>PROTOCOLO</th>
			<td>
			<select name=protoco onchange='cargamodal()'>
			<option value=''></option>";
			while($rprot=mysql_fetch_array($bprot))
			{
				$cpro=$rprot['cod_proenca'];
				$npro=$rprot['nom_proenca'];
				if($cpro==$protoco)echo "<option selected value='$cpro'>$npro</option>";
				echo "<option value='$cpro'>$npro</option>";
			}
			echo"<select>
			</td>				
			</tr>
			</table>
			
			<br><br>";
			*/
			$cco1='';$cco2='';$cco3='';$cco4='';
			if($ciclo=='I')$cco1='selected';
			if($ciclo=='II')$cco2='selected';
			if($ciclo=='III')$cco3='selected';
			if($ciclo=='IV')$cco4='selected';
			
			echo"
			<table align=center width=70% class='tbl'>
			<th>PESO</th>
			<td align=center><font size=3><b>$peso</td>
			<th>TALLA</th>
			<td align=center><font size=3><b>$talla</td>
			<th>SCT</th>
			<td align=center><font size=3><b>$circorround</td>
			<th>CICLO</th>
			<td align=center>
			
			<!--
				<input type=text class=caja size=3 name=ciclo onKeypress='if (event.keyCode > 47 && event.keyCode <58 ) event.returnValue = true;else event.returnValue = false' value='$ciclo'>
			-->
			
			<select name=ciclo class=caja>
			<option value=''></option>
			<option $cco1 value='I'>I</option>
			<option $cco2 value='II'>II</option>
			<option $cco3 value='III'>III</option>
			<option $cco4 value='IV'>IV</option>
			</select>			
			
			</td>
			</tr>
			</table>
			<br><br>			
			
			<table align=center width=70% class='tbl'>
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
			
			<table align=center width=70% class='tbl'>			
			
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
				$nomv=strtoupper($resvia['nomb_des']);
				echo"<option value='$codv'>$nomv</option>";
			}
			
			
			echo"</select></td>
			</TR>
			</table>
			
			<br><br>
			<table align=center width=70% class='tbl'>
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
			</table>
			<div id='openModal' class='modalDialog'>
			<div>
			<a href='#close' title='Close' class='close' onclick='javascript:CloseModal();'>X</a>";
			ECHO"	
			<br><center><table align=center width=70% class='tbl'>
			<th>PESO</th>
			<td align=center><font size=3><b>$peso</td>
			<th>TALLA</th>
			<td align=center><font size=3><b>$talla</td>
			<th>SCT</th>
			<td align=center><font size=3><b>$circorround</td>
			</tr>
			</table></center>
			<br><br>
			<table align=center  class='tbl4'>
			<input type='hidden' id='uni' name='unidad' value='$unidad'>";
			$n=0;
			$bmpro=mysql_query("SELECT quimio_protoenca.cod_proenca, quimio_protoenca.nom_proenca, quimio_protodeta.cod_prodeta, quimio_protodeta.cod_medica, 
			quimio_protodeta.tipo_medica, quimio_protodeta.dosis_teorica, quimio_protodeta.dosis_total, quimio_protodeta.vehiculo, quimio_protodeta.und_dt, quimio_protodeta.volumen_tto,
			quimio_protodeta.tiempo_infusion, quimio_protodeta.cantidad, medicamentos2.nomb_mdi, forma_farmaceutica.desc_ffa, insu_med.desc_ins,
			quimio_protodeta.via,quimio_protodeta.frecuencia,quimio_protodeta.intervalo1,quimio_protodeta.intervalo2,quimio_protodeta.duracion_tto
			FROM (((quimio_protoenca INNER JOIN quimio_protodeta ON quimio_protoenca.cod_proenca = quimio_protodeta.cod_proenca) LEFT JOIN medicamentos2 ON quimio_protodeta.cod_medica = medicamentos2.codi_mdi) LEFT JOIN insu_med ON quimio_protodeta.cod_medica = insu_med.codi_ins) INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa
			WHERE (((quimio_protoenca.cod_proenca)='$protoco')) ORDER BY quimio_protodeta.tipo_medica");
			while($rmpro=mysql_fetch_array($bmpro))
			{
				$cod_proenca=$rmpro['cod_proenca'];
				$nom_proenca=$rmpro['nom_proenca'];
				$cod_prodeta=$rmpro['cod_prodeta'];
				$cod_medica=$rmpro['cod_medica'];
				$tipo_medica=$rmpro['tipo_medica'];
				$dosis_teorica=$rmpro['dosis_teorica'];
				$und_dt=$rmpro['und_dt'];
				$dosis_totalpro=$rmpro['dosis_total'];
				$vehiculopro= strtoupper($rmpro['vehiculo']);
				$volumen_tto= strtoupper($rmpro['volumen_tto']);
				$tiempo_infusionpro= strtoupper($rmpro['tiempo_infusion']);
				$cantidadpro=$rmpro['cantidad'];
				$nomb_mdipro= strtoupper($rmpro['nomb_mdi']);
				$desc_ffapro= strtoupper($rmpro['desc_ffa']);
				$desc_inspro= strtoupper($rmpro['desc_ins']);
				$via= strtoupper($rmpro['via']);
				$frecuencia= strtoupper($rmpro['frecuencia']);
				$intervalo1p= strtoupper($rmpro['intervalo1']);
				$intervalo2p= strtoupper($rmpro['intervalo2']);
				$duracion_tto= strtoupper($rmpro['duracion_tto']);
				
				if(empty($factor))$factor='1';
				if(empty($porcentaje_ajuste))$porcentaje_ajuste='100';
				$dosis_resultante=$dosis_teorica*$circorround;
				$dosis_definitiva=$dosis_resultante;
				$via_administracion=$via;
				
				
				if(strlen($cod_medica)==6)$nombrepro=$cod_medica.' - '.$nomb_mdipro." ".$desc_ffapro;
				else $nombrepro=$cod_medica.' - '.$desc_inspro;
				
				
				$nomvar='cod_medica'.$n;
				echo"<input type=hidden name=$nomvar value='$cod_medica'>";
				$nomvar='nombrepro'.$n;
				echo"<input type=hidden name=$nomvar value='$nombrepro'>";
				
				$nomvar='tipo_medica'.$n;
				echo"<input type=hidden name=$nomvar value='$tipo_medica'>";
				
				if($tipo_medica=='M')
				{	
					if(($n) % 3 == 0) echo"<tr>";
					echo "<td width=33%>
					<table align=center width=100% class='tbl'>";
					echo"
					<tr>
					<th colspan=2>$nombrepro</th>
					</tr>";
					$nomvar='dosis_teorica'.$n;
					echo"
					<tr>
					<th>DOSIS TEORICA</th>
					<td align=center>";
					echo"<input type=text onPaste='return false' class='caja' onblur='calcula(1)' onFocus='calcula(1)' name=$nomvar  size=2 onKeypress='if ((event.keyCode > 47 && event.keyCode <58) || event.keyCode==46 || event.keyCode==47 ) event.returnValue = true;else event.returnValue = false' value='$dosis_teorica'>";
					$nomvar='und_dt'.$n;
					echo "<input type=hidden name=$nomvar value='$und_dt'>";
					echo" $und_dt</td>";
					
					echo"
					</tr>
					<tr>
					<th>FACTOR DE MULTIPLICACION</th>
					<td align=center>";
					$nomvar='factor'.$n;
					$sc1='';$sc2='';                                                                                           
					if($factor=='1')$sc1='selected';
					if($factor=='2')$sc2='selected';
					echo"<select class='caja' name=$nomvar onChange='calcula(1)'>
					<option value=''></option>
					<option $sc1 value='1'>SCT</option>
					<option $sc2 value='2'>PESO</option>
					</select>
					</td>";
					
					$nomvar='dosis_resultante'.$n;
					echo"
					</tr>
					<tr>
						<th>DOSIS RESULTANTE</th>
						<td align=center>";
							echo"<input type=text onPaste='return false' class='caja' onblur='calcula(2)' onFocus='calcula(2)' name=$nomvar  size=2 onKeypress='if ((event.keyCode > 47 && event.keyCode <58) || event.keyCode==46 || event.keyCode==47 ) event.returnValue = true;else event.returnValue = false' value='$dosis_resultante'> mg</td>";
						$nomvar='porcentaje_ajuste'.$n;
						echo"
					</tr>
					<tr>
						<th>% DE AJUSTE</th>
						<td align=center>";
							echo"<input type=text onPaste='return false' class='caja' onblur='calcula(2)' onFocus='calcula(2)' name=$nomvar  size=2 onKeypress='if ((event.keyCode > 47 && event.keyCode <58) || event.keyCode==46 || event.keyCode==47 ) event.returnValue = true;else event.returnValue = false' value='$porcentaje_ajuste'>
							</td>
					</tr>
					<tr>";		
						$nomvar='dosis_definitiva'.$n;
							echo"
						<th>DOSIS DEFINITIVA</th>
						<td align=center><input type=text onPaste='return false' class='caja'  name=$nomvar  size=2 onKeypress='if ((event.keyCode > 47 && event.keyCode <58) || event.keyCode==46 || event.keyCode==47 ) event.returnValue = true;else event.returnValue = false' value='$dosis_definitiva'> mg
						</td>
					</tr>
					<tr>";		
						$nomvar='via_administracion'.$n;
						$busvia=mysql_query("select * from destipos where codt_des='22' order by codi_des");
						echo"
						<th>VIA DE ADMINISTRACION</th>
						<td align=center><select name=$nomvar class='caja'  onChange='cambiauni()'>
						<option value=''></option>";
						while($resvia=mysql_fetch_array($busvia))
						{
							$codv=$resvia['codi_des'];
							$nomv= strtoupper($resvia['nomb_des']);
							if($via_administracion==$codv)echo"<option selected value='$codv'>$nomv</option>";
							else echo"<option value='$codv'>$nomv</option>";
						}						
						echo"</select>";
						
						$busvia=mysql_query("select * from destipos where codt_des='F6' order by codi_des");
						$nomvar='vehiculopro'.$n;
						ECHO"</td>
					</tr>
					<tr>	
						<th>VEHICULO</th>							
						<td align=center>
						<select class=caja name=$nomvar>
						<option value=''></option>";
						while($resvia=mysql_fetch_array($busvia))
						{
							$codv=$resvia['codi_des'];
							$nomv= strtoupper($resvia['nomb_des']);
							if($vehiculopro==$nomv)echo"<option selected value='$nomv'>$nomv</option>";
							else echo"<option value='$nomv'>$nomv</option>";
						}						
						echo"</select>
						</td>
					</tr>
					<tr>";
						$busvia=mysql_query("select * from destipos where codt_des='F7' order by codi_des");
						$nomvar='volumen_tto'.$n;
						ECHO"
						
						<th>VOLUMEN TTO</th>							
						<td align=center>
						<select class=caja name=$nomvar>
						<option value=''></option>";
						while($resvia=mysql_fetch_array($busvia))
						{
							$codv=$resvia['codi_des'];
							$nomv= strtoupper($resvia['nomb_des']);
							if($volumen_tto==$nomv)echo"<option selected value='$nomv'>$nomv</option>";
							else echo"<option value='$nomv'>$nomv</option>";
						}						
						echo"</select>
						</td>
					</tr>
					<tr>";
						
						
						$busvia=mysql_query("select * from destipos where codt_des='F8' order by valo_des");
						$nomvar='tiempo_infusionpro'.$n;
						ECHO"
						<th>DURACION INFUSION</th>
						<td align=center>
						<select class=caja name=$nomvar>
						<option value=''></option>";
						while($resvia=mysql_fetch_array($busvia))
						{
							$codv=$resvia['codi_des'];
							$nomv= strtoupper($resvia['nomb_des']);
							if($tiempo_infusionpro==$nomv)echo"<option selected value='$nomv'>$nomv</option>";
							else echo"<option value='$nomv'>$nomv</option>";
						}						
						echo"</select>
						</td>
					</tr>
					<tr>";
						
						
						$busvia=mysql_query("select * from destipos where codt_des='F9' order by codi_des");
						$nomvar='frecuencia'.$n;
						ECHO"
						
						<th>FRECUENCIA</th>
						<td align=center>
						<select class=caja name=$nomvar>
						<option value=''></option>";
						while($resvia=mysql_fetch_array($busvia))
						{
							$codv=$resvia['codi_des'];
							$nomv= strtoupper($resvia['nomb_des']);
							if($frecuencia==$nomv)echo"<option selected value='$nomv'>$nomv</option>";
							else echo"<option value='$nomv'>$nomv</option>";
						}						
						echo"</select>
						</td>
					</tr>
					<tr>";
						
						
						$busvia=mysql_query("select * from destipos where codt_des='FA' order by codi_des");
						$nomvar='intervalo1p'.$n;
						ECHO"
						<th>INTERVALO</th>							
						<td align=center>						
						<select class=caja name=$nomvar>
						<option value=''></option>";
						while($resvia=mysql_fetch_array($busvia))
						{
							$codv=$resvia['codi_des'];
							$nomv= strtoupper($resvia['nomb_des']);
							if($intervalo1p==$nomv)echo"<option selected value='$nomv'>$nomv</option>";
							else echo"<option value='$nomv'>$nomv</option>";
						}						
						echo"</select>";
						
						
						$busvia=mysql_query("select * from destipos where codt_des='FB' order by codi_des");
						$nomvar='intervalo2p'.$n;
						ECHO"
						<select class=caja name=$nomvar>
						";
						while($resvia=mysql_fetch_array($busvia))
						{
							$codv=$resvia['codi_des'];
							$nomv= strtoupper($resvia['nomb_des']);
							if($intervalo2p==$nomv)echo"<option selected value='$nomv'>$nomv</option>";
							else echo"<option value='$nomv'>$nomv</option>";
						}						
						echo"</select>
						</td>
					</tr>
					<tr>
						<th>DURACION TRATAMIENTO</th>";
						$nomvar="duracion_tratamientopro1".$n;
						echo"<td align=center><input type=text size=2 class='caja' name=$nomvar size=20 onKeypress='if (event.keyCode > 47 && event.keyCode <58 ) event.returnValue = true;else event.returnValue = false' value='$duracion_tto'>
						";
						$nomvar="duracion_tratamientopro2".$n;
						echo"
						<select class=caja name=$nomvar>
						<option value='dias'>dias</option>
						<option value='meses'>meses</option>			
						</select>
						</td>
					</tr>
					<tr>
						<th>CANTIDAD</th>";
						$nomvar="cantidadpro".$n;
						echo"
						<td align=center><input type=text size=2 class='caja' name=$nomvar size=20 onKeypress='if (event.keyCode > 47 && event.keyCode <58 ) event.returnValue = true;else event.returnValue = false' value='$cantidadpro'>
						</td>
					</tr>
					<tr>
						<th>OBSERVACION</th>";
						$nomvar="obserpro".$n;
						echo"
						<td align=center><textarea name=$nomvar></textarea>
						</td>
					</tr>
					
					
					</table>
					</td>";
				}
				else
				{
					echo"
					<tr>
					<td colspan=2>$nombrepro</td>
					<td align=center>";
						$nomvar="cantidadpro".$n;
						echo"
						<input type=text size=2 class='caja' name=$nomvar size=20 onKeypress='if (event.keyCode > 47 && event.keyCode <58 ) event.returnValue = true;else event.returnValue = false' value='$cantidadpro'>
					</td>
					</tr>
					";
				}
				$n++;
			}
			echo"
			<tr>
			<td height=40 colspan=3>
				<center><INPUT type=button class='boton' value='GUARDAR' onClick='valida_onco();'></center>
			</td>
			</tr>
			</table>
			<br>
			<input type=hidden name=finonco value=$n>
			
			<br>
			</div>
			</div>";
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
			while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) 
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
			while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) 
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
					<td align=center><a href='#' onclick='elimina(2,$cont,19)'><img src='img/eli.png' border=0></a></td>
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
			while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) 
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