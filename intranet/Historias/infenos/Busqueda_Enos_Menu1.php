<?PHP
    define("base_de_datos", "proinsalud");
	require('Libreria.Inc');
	$xcon=conectar_bd();
?>
<HTML>
<HEAD>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 
	<script type="text/javascript" src="java/calendar/calendar.js"></script> 
	<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
	<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
	<script language="JavaScript" type="text/javascript">
	function verconsulta()
	{
		varini=uno.fin.value;
		varfin=uno.ffin.value;
		if(varini!='' && varfin!='')
		{
			if(varini>varfin)
			{
				alert('La fecha inicial es mayor que fecha final');	
				return;
			}	
		}
		else if(varini!='' && varfin=='') 	
		{
			alert('la fecha Inicial no tienen datos');	
			return;
		}
		else if(varini=='' && varfin!='') 	
		{
			alert('La fecha Final tienen datos');	
			return;
		}
		document.getElementById('varmunicipio').disabled = false;
		uno.target='der';
		uno.action='Busqueda_Enos1.php';
		uno.submit();	
		
	}
		
	function A1()
	{	
		if (uno.abox0.checked)
		{	
			uno.abox1.checked = true;
			uno.abox2.checked = true;
			uno.abox3.checked = true;
			uno.abox4.checked = true;
			uno.abox5.checked = true;
		}
		else
		{	
			uno.abox1.checked = false;
			uno.abox2.checked = false;
			uno.abox3.checked = false;
			uno.abox4.checked = false;
			uno.abox5.checked = false;
		}	
	}
	function B1()
	{	
		if (uno.bbox0.checked)
		{	
			uno.bbox1.checked = true;
			uno.bbox2.checked = true;
			uno.bbox3.checked = true;
		}
		else
		{
			uno.bbox1.checked = false;
			uno.bbox2.checked = false;
			uno.bbox3.checked = false;			
		}	
	}
	function C1()
	{	
		if (uno.cbox0.checked)
		{	
			uno.cbox1.checked = true;
			uno.cbox2.checked = true;
		}
		else
		{
			uno.cbox1.checked = false;
			uno.cbox2.checked = false;
		}	
	}	
	function D1()
	{	
		if (uno.dbox0.checked)
		{	
			uno.dbox1.checked = true;
			uno.dbox2.checked = true;
			uno.dbox3.checked = true;
		}
		else
		{
			uno.dbox1.checked = false;
			uno.dbox2.checked = false;
			uno.dbox3.checked = false;
		}	
	}
	function E1()
	{	
		if (uno.ebox0.checked)
		{	
			uno.ebox1.checked = true;
			uno.ebox2.checked = true;
			uno.ebox3.checked = true;
		}
		else
		{
			uno.ebox1.checked = false;
			uno.ebox2.checked = false;
			uno.ebox3.checked = false;
		}	
	}
	function F1()
	{	
		if (uno.fbox0.checked)
		{	
			uno.fbox1.checked = true;
			uno.fbox2.checked = true;
			uno.fbox3.checked = true;
		}
		else
		{
			uno.fbox1.checked = false;
			uno.fbox2.checked = false;
			uno.fbox3.checked = false;
		}	
	}
	function G1()
	{	
		if (uno.gbox0.checked)
		{	
			uno.gbox1.checked = true;
			uno.gbox2.checked = true;
			uno.gbox3.checked = true;
			uno.gbox4.checked = true;
			uno.gbox5.checked = true;
			uno.gbox6.checked = true;
		}
		else
		{
			uno.gbox1.checked = false;
			uno.gbox2.checked = false;
			uno.gbox3.checked = false;
			uno.gbox4.checked = false;
			uno.gbox5.checked = false;
			uno.gbox6.checked = false;
		}	
	}
	function H1()
	{	
		if (uno.hbox0.checked)
		{	
			uno.hbox1.checked = true;
			uno.hbox2.checked = true;
		}
		else
		{
			uno.hbox1.checked = false;
			uno.hbox2.checked = false;
		}	
	}	
	function I1()
	{	
		if (uno.ibox0.checked)
		{	
			uno.ibox1.checked = true;
			uno.ibox2.checked = true;
			uno.ibox3.checked = true;
			uno.ibox4.checked = true;
			uno.ibox5.checked = true;
		}
		else
		{
			uno.ibox1.checked = false;
			uno.ibox2.checked = false;
			uno.ibox3.checked = false;
			uno.ibox4.checked = false;
			uno.ibox5.checked = false;
		}
	}
	function J1()
	{	
		if (uno.jbox0.checked)
		{	
			uno.jbox1.checked = true;
			uno.jbox2.checked = true;
		}
		else
		{
			uno.jbox1.checked = false;
			uno.jbox2.checked = false;
		}	
	}
	function recarga()
	{
		sctop = uno.sTop.value;
		scrollBy(0,sctop);
	}
	
	function vermuni()
	{
		uno.varmunicipio.value='52001';
		document.getElementById('varmunicipio').disabled = true;
	}
	function vermuni1()
	{
		document.getElementById('varmunicipio').disabled = false;
	}
	function vermuni2()
	{
		uno.varmunicipio.value='52001';
		document.getElementById('varmunicipio').disabled = true;
	}
	
	function munitres()
	{
		granopc3 = document.getElementsByName('tiposervicio');
		var idenbot1=-1;
		for(var j=0; j<3; j++)
		{			
			if(granopc3[j].checked)
			{				
				idenbot1=j;
			}
		}
		if(idenbot1==-1 || idenbot1==1 || idenbot1==2)
		{
			uno.varmunicipio.value='52001';
			document.getElementById('varmunicipio').disabled = true;
		}	
	}

	</script>
</HEAD>
<BODY onload='recarga()'>
<?PHP
ECHO "<form name=uno method=post>";
ECHO "<input type=hidden name='sTop'>";
ECHO "<table align='center'>";
ECHO "<tr><td align='center'><b>REPORTE ENOS</b></td></tr>";
ECHO "</table>";
ECHO "<table align='center' class='tbl3' width='95%'>";
ECHO "<tr><td height='4'></td></tr>";
ECHO "<tr><td align='center'><b>Servicio</b></td></tr>";
ECHO"<tr><td align=left>
	Consulta Externa <input type=radio name=tiposervicio value=1 checked onclick='vermuni1()'>
	Urgencias <input type=radio name=tiposervicio value=2 onclick='vermuni()'>
	Hospitalizacion <input type=radio name=tiposervicio value=3 onclick='vermuni2()'>
	</td></tr>";
ECHO "<tr><td height='4'></td></tr>";	
ECHO "</table>";
ECHO "<table align='center' class='tbl3' width='95%'>";
ECHO "<tr><td height='4'></td></tr>";
ECHO "<tr><td align='center'><b>Fechas de Busqueda</b></td></tr>";
?>
	<tr>
	<td align='left'>
		<img src='img/Calendar-32.png' width='26' height='16' alt='Calendario' id='lanzador1'/>Fecha Inicial: 
		<?php 
		echo "<input type=text name=fin id=fin size='13' value= >";?>
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField     :    "fin",     // id del campo de texto 
		ifFormat     :     "%Y/%m/%d",     // formato de la fecha que se escriba en el campo de texto 
		button     :    "lanzador1"     // el id del botn que lanzar el calendario 
		}); 
		</script> 
	</td>	
	</tr>
	<tr>
	<td align='left'>
		<img src='img/Calendar-32.png' width='26' height='16' alt='Calendario' id='lanzador2'/>Fecha Final:
		<?php echo "<input type=text name=ffin id=ffin size='13' value= >";?>
		
		<script type="text/javascript"> 
		 Calendar.setup({ 
		inputField     :    "ffin",     // id del campo de texto 
		ifFormat     :     "%Y/%m/%d",     // formato de la fecha que se escriba en el campo de texto 
		button     :    "lanzador2"     // el id del botn que lanzar el calendario 
		}); 
		</script> 
		<script languaje=javascript>uno.fin.value="<?echo $fin?>";</script>
		<script languaje=javascript>uno.ffin.value="<?echo $ffin?>";</script>
	</td>
	</tr>	
<?php
ECHO "<tr><td height='4'></td></tr>";
ECHO "</table>";
ECHO "<table align='center' class='tbl3' width='95%'>";
ECHO "<tr><td height='4'></td></tr>";
ECHO "<tr><td align='center'><b>Contrato</b></td></tr>";
ECHO"<tr><td align=left>Magisterio<input type=radio name=tipocontra value=1>
	Otros <input type=radio name=tipocontra value=2</td></tr>";
ECHO "<tr><td height='4'></td></tr>";	
ECHO "</table>";
ECHO "<table align='center' class='tbl3' width='95%'>";
ECHO "<tr><td height='4'></td></tr>";
ECHO "<tr><td align='center'><b>Municipio de Atencion</b></td></tr>";
ECHO "<tr><td height='7'></td></tr>";
ECHO"<tr><td align=left>Municipio:"; 
$bser2=mysql_query("SELECT CODI_MUN,NOMB_MUN FROM municipio WHERE DEPA_MUN='52' ORDER BY NOMB_MUN");
ECHO"<select style='width:160px' name=varmunicipio id='varmunicipio' onchange='munitres()'>";
while($rser2=mysql_fetch_array($bser2))
{
	$cser1=$rser2['CODI_MUN'];
	$nser1=$rser2['NOMB_MUN'];
	echo"<option value='$cser1'>$nser1</option>";
}
ECHO"</select>";
ECHO"<script>uno.varmunicipio.value='52001';</script></td>";
ECHO "</td></tr>";
ECHO "<tr><td height='4'></td></tr>";	
ECHO "</table>";
ECHO "<table align='center' class='tbl3' width='95%' align='left'>";
ECHO "<tr><td align='left'><input type='checkbox' name='abox0' value='S' onclick='A1()'><b>MATERNIDAD SEGURA</b></td></tr>";
ECHO "<tr><td><input type='checkbox' name='abox1' value='S'>1. Transtorno Hipertensivo</td></tr>";
ECHO "<tr><td><input type='checkbox' name='abox2' value='S'>2. Transtorno Hemorragico</td></tr>";
ECHO "<tr><td><input type='checkbox' name='abox3' value='S'>3. Complicaciones en el embarazo</td></tr>";
ECHO "<tr><td><input type='checkbox' name='abox4' value='S'>4. Sepsis Obstetrico</td></tr>";
ECHO "<tr><td><input type='checkbox' name='abox5' value='S'>5. Sepsis no Obstetrico</td></tr>";
ECHO "<tr><td height='4'></td></tr>";
ECHO "<tr><td align='left'><input type='checkbox' name='bbox0' value='S' onclick='B1()'><b>ENFERMEDADES CRONICAS NO TRANSMISIBLES</b></td></tr>";
ECHO "<tr><td><input type='checkbox' name='bbox1' value='S'>1. Inteneto de Suicidio</td></tr>";
ECHO "<tr><td><input type='checkbox' name='bbox2' value='S'>2. Violencia de Genero</td></tr>";
ECHO "<tr><td><input type='checkbox' name='bbox3' value='S'>3. Defectos Congentitos en Menor de un Año</td></tr>";
ECHO "<tr><td height='4'></td></tr>";
ECHO "<tr><td align='left'><input type='checkbox' name='cbox0' value='S' onclick='C1()'><b>CANCER</b></td></tr>";
ECHO "<tr><td><input type='checkbox' name='cbox1' value='S'>1. Cancer de Mama</td></tr>";
ECHO "<tr><td><input type='checkbox' name='cbox2' value='S'>2. Cancer de Cuello Uterino</td></tr>";
ECHO "<tr><td height='4'></td></tr>";
ECHO "<tr><td align='left'><input type='checkbox' name='dbox0' value='S' onclick='D1()'><b>LESION POR ARTEFACTO EXPOSIVO</b></td></tr>";
ECHO "<tr><td><input type='checkbox' name='dbox1' value='S'>1. Explosion de Fuegos Artificiales</td></tr>";
ECHO "<tr><td><input type='checkbox' name='dbox2' value='S'>2. Agresion con material explosivo</td></tr>";
ECHO "<tr><td><input type='checkbox' name='dbox3' value='S'>3. Contacto Traumatico con Material Ecplosivo, de Intencion no Determinada</td></tr>";
ECHO "<tr><td height='4'></td></tr>";
ECHO "<tr><td align='left'><input type='checkbox' name='ebox0' value='S' onclick='E1()'><b>INMUNOPREVENIBLES</b></td></tr>";
ECHO "<tr><td><input type='checkbox' name='ebox1' value='S'>1. Sarampion/Rubiola</td></tr>";
ECHO "<tr><td><input type='checkbox' name='ebox2' value='S'>2. Tetanos Neonatal</td></tr>";
ECHO "<tr><td><input type='checkbox' name='ebox3' value='S'>3. Paralisis Flacida Aguda</td></tr>";
ECHO "<tr><td height='4'></td></tr>";
ECHO "<tr><td align='left'><input type='checkbox' name='fbox0' value='S' onclick='F1()'><b>ITS</b></td></tr>";
ECHO "<tr><td><input type='checkbox' name='fbox1' value='S'>1. Hepatitis B</td></tr>";
ECHO "<tr><td><input type='checkbox' name='fbox2' value='S'>2. Sifilis Gestacional y Congenota</td></tr>";
ECHO "<tr><td><input type='checkbox' name='fbox3' value='S'>3. VIH</td></tr>";
ECHO "<tr><td height='4'></td></tr>";
ECHO "<tr><td align='left'><input type='checkbox' name='gbox0' value='S' onclick='G1()'><b>ENFERMEDADES TRANSMITIDAD POR VECTORES ETV</b></td></tr>";
ECHO "<tr><td><input type='checkbox' name='gbox1' value='S'>1. Chagas</td></tr>";
ECHO "<tr><td><input type='checkbox' name='gbox2' value='S'>2. Dengue</td></tr>";
ECHO "<tr><td><input type='checkbox' name='gbox3' value='S'>3. Chikungunya</td></tr>";
ECHO "<tr><td><input type='checkbox' name='gbox4' value='S'>4. Fiebre Amarilla</td></tr>";
ECHO "<tr><td><input type='checkbox' name='gbox5' value='S'>5. Malaria</td></tr>";
ECHO "<tr><td><input type='checkbox' name='gbox6' value='S'>6. Leiishmaniasis</td></tr>";
ECHO "<tr><td height='4'></td></tr>";
ECHO "<tr><td align='left'><input type='checkbox' name='hbox0' value='S' onclick='H1()'><b>MICOBACTERIAS</b></td></tr>";
ECHO "<tr><td><input type='checkbox' name='hbox1' value='S'>1. TBC</td></tr>";
ECHO "<tr><td><input type='checkbox' name='hbox2' value='S'>2. LEPRA</td></tr>";
ECHO "<tr><td height='4'></td></tr>";
ECHO "<tr><td align='left'><input type='checkbox' name='ibox0' value='S' onclick='I1()'><b>ZOONOCIS</b></td></tr>";
ECHO "<tr><td><input type='checkbox' name='ibox1' value='S'>1. Mordedura Perro</td></tr>";
ECHO "<tr><td><input type='checkbox' name='ibox2' value='S'>2. Accidente Ofidico</td></tr>";
ECHO "<tr><td><input type='checkbox' name='ibox3' value='S'>3. Encefalitis Equina</td></tr>";
ECHO "<tr><td><input type='checkbox' name='ibox4' value='S'>4. Leptospirosis</td></tr>";
ECHO "<tr><td><input type='checkbox' name='ibox5' value='S'>5. Brucelosis</td></tr>";
ECHO "<tr><td height='4'></td></tr>";
ECHO "<tr><td align='left'><input type='checkbox' name='jbox0' value='S' onclick='J1()'><b>ENFERMEDAD TRANSMITIDAS POR ALIMENTOS ETAS</b></td></tr>";
ECHO "<tr><td><input type='checkbox' name='jbox1' value='S'>1. Fiebre Tifoidea</td></tr>";
ECHO "<tr><td><input type='checkbox' name='jbox2' value='S'>2. ETA</td></tr>";
ECHO "<tr><td height='4'></td></tr>";
ECHO "</table>";
ECHO "<table align='center' width='95%'>";
ECHO "<tr><td height='4'></td></tr>";
ECHO "<tr><td align='center'><a href='#' onclick='verconsulta()' title='Consultar'><img src='img/lupa1.png' hspace=0 width=95 height=35 border='0'></a></td></tr>";
ECHO "<tr><td height='7'></td></tr>";
ECHO "</table>";
desconectar_bd();
?>
</FORM>
</BODY>
</HTML>