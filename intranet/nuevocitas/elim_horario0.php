<?
session_start();
$usucitas=$_SESSION['usucitas'];  
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 
?>
<html>
<head>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />  
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
	function elidias(p,v)
	{
		val="uno.selfecha"+p+".value=v";
		eval(val);		
		val="uno.fin"+p+".value";
		f=eval(val);
		for(i=0;i<f;i++)
		{
			ncit="uno.Usado_horario"+p+i+".value";
			usad="uno.ncita_horario"+p+i+".value";
			if(eval(ncit)==eval(usad))
			{
				val="uno.selhora"+p+i+".value=v";
				eval(val);
			}
		}
		uno.target='';
		uno,action='genhor0.php';
		uno.submit();
		
	}
	function elihoras(p,r,v)
	{		
		val="uno.selhora"+p+r+".value=v";
		eval(val);		
		uno.target='';
		uno,action='genhor0.php';
		uno.submit();
		
	}
	function valida()
	{
		if(uno.areasel.value=='-1')
		{
			alert("Seleccione el area");
			uno.areasel.focus();
			return;
		}
				
		if(uno.medico.value=='')
		{
			alert("Seleccione el médico");
			return;
		}
		if(uno.fechaini.value=='')
		{
			alert("Seleccione La fecha inicial");
			uno.fechaini.focus();
			return;
		}
		if(uno.fechafin.value=='')
		{
			alert("Seleccione La fecha final");
			uno.fechafin.focus();
			return;
		}	
		
		uno.target='';
		uno.action='elim_horario1.php';
		uno.submit();
	}
	
	function valfec(n)
	{
		/*
		if(n==1)
		{
			if(uno.fechaini.value<uno.fecrec.value)
			{
				
				alert("La fecha de inicio no puede ser igual o anterior a la fecha actual");
				uno.fechaini.value=uno.fecrec.value
				uno.fechaini.focus();
				return;			
			}
			if(uno.fechaini.value>uno.fechafin.value)
			{
				alert("La fecha de inicio no puede ser mayor a la fecha final");
				uno.fechaini.value=uno.fecrec.value
				uno.fechaini.focus();
				return;			
			}		
		}
		*/
		if(n==2)
		{
			if(uno.fechafin.value<uno.fecrec.value)
			{
				alert("La fecha final no puede ser igual o anterior a la fecha actual");
				uno.fechafin.value=uno.fecrec.value
				uno.fechafin.focus();
				return;			
			}
			if(uno.fechaini.value>uno.fechafin.value)
			{
				alert("La fecha de inicio no puede ser mayor a la fecha final");
				uno.fechaini.value=uno.fecrec.value
				uno.fechaini.focus();
				return;			
			}	
			
		}
		uno.target='';
		uno.action='elim_horario0.php';
		uno.submit();	
	}
	function salto()
	{
		uno.target='';
		uno.action='elim_horario0.php';
		uno.submit();
	}	
	function sale(n)
	{
		if(n==1)uno.bot1.focus();
		if(n==2)uno.bot2.focus();
	
	}
	
	
</script>
</head>
<body style='position:absolute;margin-top:10'>
<style>
#conte {
overflow:auto;
height: 120px;
width: 300px;
padding:5px;
margin:0 auto;
background-color: #FFFFFF;
font-size: 8px;
}
.margen_izq {
margin-left:10px;
}
a{text-decoration:none} 
</style> 
<?	
	
	if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
	$dateh=date("Y-m-d");	
	$anoini=substr($dateh,0,4);
	$mesini=substr($dateh,5,2);
	$diaini=substr($dateh,8,2);
	$dateini = gmmktime ( 00, 00, 00, $mesini, $diaini, $anoini);	
	$diaprog=$dateini+86400;
	$fechasig=gmdate ( "Y-m-d", $diaprog);
//echo $fechasig;
	if(empty($fechaini))$fechaini=$fechasig;
	if(empty($fechafin))$fechafin=$fechasig;
	
	
	
	/*
	$busperm=mysql_query("SELECT permisos_citas.usua_per, areas.perm_are, permisos_citas.serv_per, permisos_citas.esta_per, areas.nom_areas, areas.tipo_areas
	FROM permisos_citas INNER JOIN areas ON permisos_citas.serv_per = areas.cod_areas
	WHERE (((permisos_citas.usua_per)='$usucitas') AND ((permisos_citas.esta_per)='A') AND ((areas.tipo_areas)<>'2'))");
	*/
	
	//onload="setScrollPos('conte')"
	include ('php/conexion1.php');
	$busarea=mysql_query("SELECT Max(permisos_citas.serv_per) AS codi, areas.nom_areas AS nomb
        FROM permisos_citas INNER JOIN areas ON permisos_citas.serv_per = areas.cod_areas
        WHERE (((permisos_citas.usua_per)='$usucitas') AND ((permisos_citas.esta_per)='A'))
        GROUP BY areas.nom_areas");
        echo"<form name=uno method=post>
        <input type=hidden name=fecrec value='$fechaini'>
        <table align=center>
        <tr><td>
	<table align=center class='tbl' width=100%>
	<tr><th>ELIMINAR HORARIOS DE CITAS MEDICAS</th></tr>
	</table>
	<br>

	<table class='tbl' align=center width=100%>
	<tr>
	<th>AREA</th>
	<th>MEDICO</th>
	</tr>
	<tr>
	
	<td valign=top><select name=areasel class='caja' onchange='salto()'>
	<option value='-1'></option>";
	while($resarea=mysql_fetch_array($busarea))	
	{		
            $codare=$resarea['codi'];
            $nomare=$resarea['nomb'];
			echo"<option value='$codare'>$nomare</option>";	
            //if($areasel==$codare)echo"<option selected value='$codare'>$nomare</option>";	
            //else echo"<option value='$codare'>$nomare</option>";	
				
	}
	
	echo"</select></td>";
	?>
		<script language='Javascript'>
		uno.areasel.value="<?php echo $areasel;?>";
		</script>
	<?php

	$bmedi=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi
	FROM (medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar) INNER JOIN areas ON areas_medic.areas_ar = areas.cod_areas
	WHERE (((areas.cod_areas)='$areasel') AND ((medicos.esta_medi)='A') AND ((areas_medic.esta_ar)='A'))
	GROUP BY medicos.cod_medi, medicos.nom_medi
	ORDER BY medicos.nom_medi");	
			
        echo"<td><select name=medico class='caja' onchange='salto()'>
        <option value=''></option>";			
        while($rmedi=mysql_fetch_array($bmedi))
        {
            $codimed=$rmedi['cod_medi'];
            $nombmed=$rmedi['nom_medi'];			
            if($medico==$codimed)echo"<option selected value='$codimed'>$nombmed</option>";
            else echo"<option value='$codimed'>$nombmed</option>";			
        }
        echo"</td>";		
	
	echo"<input type=hidden name=finmed value=$n>";
	echo"
	</td></tr>
	</table>
	<br>
	<br>
	<table class='tbl' align=center  width=100%>
	<tr>
	<th>FECHA INICIAL</th>
	<td align=center>";
	?>
	<input type="text" name="fechaini" onfocus="salto()" onchange="salto()" class='caja' size="10" maxlength="10" value="<?echo $fechaini;?>" id="fini" <?echo $disp;?>>
	<input type="button" class='caja' id="lanzador1" name="bot1" value="..." <?echo $disp;?>/>
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
	<th>FECHA FINAL</td>
	<td align=center>";
	?>
	<input type="text" name="fechafin" onfocus="salto()"  onchange="salto()" class='caja' size="10"  maxlength="10" value="<?echo $fechafin;?>" id="ffin" <?echo $disp;?>>
	<input type="button" class='caja' id="lanzador2" name="bot2" value="..." <?echo $disp;?>/>
	<!-- script que define y configura el calendario--> 
	<script type="text/javascript"> 
	Calendar.setup({ 
	inputField     :    "ffin",     // id del campo de texto 
	ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
	button     :    "lanzador2"     // el id del botón que lanzará el calendario 				
	}); 
	</script> 				
	<?		
	echo"</td>		
	</tr>		
	</table>
	<br>";
	
	$bfecdis=mysql_query("SELECT horarios.Fecha_horario
	FROM horarios
	WHERE (((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin') AND ((horarios.Usado_horario)>'0') AND ((horarios.Cmed_horario)='$medico') AND ((horarios.Cserv_horario)='$areasel'))
	GROUP BY horarios.Fecha_horario
	ORDER BY horarios.Fecha_horario");
	
	echo"<table align=center class='tbl' width=100%><tr>";
	$p=100;	
	while($rfdis=mysql_fetch_array($bfecdis))
	{
		$Fecha_horario=$rfdis['Fecha_horario'];		
		$nomvar='selfecha'.$p;
		$selfecha=$$nomvar;
		echo"<input type=hidden name=$nomvar value=$selfecha>";
		echo"<tr>";
		//background='img/elifecha.png'
		if($selfecha==1)echo"<th align=center><a href='#' onclick='elidias($p,0)' title='$Usado_horario'><font color='#0000FF'>$Fecha_horario</a></td>";
		else echo"<th align=center><a href='#' onclick='elidias($p,1)' title='$Usado_horario'><font color='#0000FF'>$Fecha_horario</a></td>";		
		$bhordis=mysql_query("SELECT horarios.Fecha_horario, horarios.Usado_horario, horarios.Cmed_horario, horarios.Hora_horario, horarios.Cserv_horario, horarios.ID_horario, horarios.ncita_horario
		FROM horarios WHERE (((horarios.Cserv_horario)='$areasel') AND ((horarios.Fecha_horario)='$Fecha_horario') AND ((horarios.Usado_horario)>='0') AND ((horarios.Cmed_horario)='$medico')) ORDER BY horarios.Fecha_horario,horarios.hORA_horario");
		$r=0;
		while($rhdis=mysql_fetch_array($bhordis))
		{
			$Usado_horario=$rhdis['Usado_horario'];
			$Cmed_horario=$rhdis['Cmed_horario'];
			$Hora_horario=$rhdis['Hora_horario'];
			$Cserv_horario=$rhdis['Cserv_horario'];
			$ID_horario=$rhdis['ID_horario'];
			$ncita_horario=$rhdis['ncita_horario'];
			$hora=substr($Hora_horario,11,5);
			$nomvar='Usado_horario'.$p.$r;
			echo"<input type=hidden name=$nomvar value=$Usado_horario>";
			$nomvar='ncita_horario'.$p.$r;
			echo"<input type=hidden name=$nomvar value=$ncita_horario>";			
			$nomvar='idenhor'.$p.$r;
			echo"<input type=hidden name=$nomvar value='$ID_horario'>";			
			$nomvar='selhora'.$p.$r;
			$selhora=$$nomvar;
			
			$cuentacit=mysql_query("select * from citas where ID_horario='$ID_horario' AND Clase_citas < '6'");
			$numcit=mysql_num_rows($cuentacit);
			
			// background='img/elidia.png'
			echo"<input type=hidden name=$nomvar value=$selhora>";						
			if($Usado_horario!=$ncita_horario || $numcit>0)
			{
				echo"<td align=center bgcolor='#FFFFFF'><a href='#' title='$Usado_horario'><font color='#999999'>$hora</a></td>";
			}
			else
			{
				if($selhora==1)echo"<td align=center bgcolor='#FFFFFF'><a href='#' onclick='elihoras($p,$r,0)' title='$Usado_horario'><font color='#bb0000'>$hora</a></td>";	
				else echo"<td align=center bgcolor='#FFFFFF'><a href='#' onclick='elihoras($p,$r,1)'title='$Usado_horario'><font color='#0000FF'>$hora</a></td>";
			}			
			$r++;
		}
		$nomvar='fin'.$p;
		echo"<input type=hidden name=$nomvar value=$r>";
		echo"<tr>";
		$p++;
	}
        echo"<input type=hidden name=finalp value=$p>";
	echo"</tr></table></tr></table>";
	ECHO"<br>
	<table align=center class='tbl'=100%>
	<tr><th colspan=3 align=center valign=top height=20><INPUT type=button class='boton' value='ACEPTAR' onClick='valida();'></th></tr>	
	</table>
	</td></tr>
	</table>	
	</form>";
?>
</body>
</html>