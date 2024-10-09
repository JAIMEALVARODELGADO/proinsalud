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
	function busmedico()
	{
		uno.target='';
		uno.action='genhor0.php';
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
		f=uno.finmed.value;
		
		sihay=0;
		for(i=1;i<f;i++)
		{
			
			val="uno.selec"+i+".checked";
			if(eval(val)==true)sihay=1;		
		}
		
		if(sihay==0)
		{
			alert("Seleccione al menos un médico");
			return;
		}
		
		
		if(uno.dia1.checked==false && uno.dia2.checked==false && uno.dia3.checked==false && uno.dia4.checked==false && uno.dia5.checked==false && uno.dia6.checked==false && uno.dia7.checked==false)
		{
			alert("Seleccione al menos un dia de semana");
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
		
		if(uno.horaini.value=='' || uno.minuini.value=='')
		{
			alert("Digite la hora inicial");
			uno.horaini.focus();
			return;
		}
		
		if(uno.horafin.value=='' || uno.minufin.value=='')
		{
			alert("Digite la hora final");
			uno.horafin.focus();
			return;
		}		
		if(uno.intervalo.value=='')
		{
			alert("Digite el intervalo");
			uno.intervalo.focus();
			return;
		}
		if(uno.ncitados.value=='')
		{
			alert("Digite el numero de citas por turno");
			uno.ncitados.focus();
			return;
		}
		uno.bot.disabled=true;
		uno.target='';
		uno.action='genhor1.php';
		uno.submit();
	}
	function valhora(campo,n)
	{		
		if (!((campo.value.match(/^(0[0-9]|1[0-9]|2[0-3])$/)) && (campo.value!='')))
        {
			iden="hor"+n;
			document.getElementById(iden).style.backgroundColor = "#ff0000";
		    return;
        }	
		else
        {
			iden="hor"+n;
			document.getElementById(iden).style.backgroundColor = "#FFFFFF";
		    return;
        }			
	}
	function valminu(campo,n)
	{
		iden="min"+n;
		if (!((campo.value.match(/^([0-5][0-9])$/)) && (campo.value!='')))
        {
			document.getElementById(iden).style.backgroundColor = "#ff0000";
			return;
        }
		else
		{
			document.getElementById(iden).style.backgroundColor = "#FFFFFF";
			return;
        }
			
	}
	function sale(n)
	{
		if(n==1)uno.bot1.focus();
		if(n==2)uno.bot2.focus();
	
	}
	
	/*
	function saveScrollPos(object)	
	{		
		
	}
	function setScrollPos(elementId)
	{		
		document.getElementById(elementId).scrollTop = document.getElementById('scrollPos').value;
	}
	*/
</script>
</head>
<body style="position:absolute;margin-top: 10px">
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
</style>
<?	
    //onload="setScrollPos('conte')"
	
    if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }

    include ('php/conexion1.php');
   
    
    $busarea=mysql_query("SELECT Max(permisos_citas.serv_per) AS codi, areas.nom_areas AS nomb
    FROM permisos_citas INNER JOIN areas ON permisos_citas.serv_per = areas.cod_areas
    WHERE (((permisos_citas.usua_per)='$usucitas') AND ((permisos_citas.esta_per)='A'))
    GROUP BY areas.nom_areas");

    
    
    //ECHO $areasel;
    echo"<form name=uno method=post>
    <table align=center>
    <tr><td>
    <table align=center class='tbl' width=100%>
    <tr><th>GENERADOR DE HORARIOS CITAS MEDICAS</th></tr>
    </table>
    <br>
    <table class='tbl' align=center width=100%>
    <tr>
    <th>AREA</th>
    <th>MEDICO</th>
    </tr>
    <tr>
    <td valign=top><select name='areasel' class='caja' onchange='busmedico()'>
    <option value='-1'></option>";       
    while($resarea=mysql_fetch_array($busarea))
    {
        $codare=$resarea['codi'];
        $nomare=$resarea['nomb'];
		
		echo"<option value='$codare'>$nomare</option>";
        			
		//if($areasel==$codare)echo"<option selected value='$codare'>$nomare</option>";	
		//else echo"<option value='$codare'>$nomare</option>";		
		//echo"<option value='$codare'>$nomare</option>";
        
    }
    echo"<select></td>
    <td>";
	//echo $areasel;
	?>
		<script language='Javascript'>
		uno.areasel.value="<?php echo $areasel;?>";
		</script>
	<?php
    if(empty($areasel))$areasel='0';
    $bmedi=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi, areas.cod_areas, medicos.esta_medi
	FROM (medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar) INNER JOIN areas ON areas_medic.areas_ar = areas.cod_areas
	WHERE (((areas.cod_areas)='$areasel') AND ((medicos.esta_medi)='A') AND ((areas_medic.esta_ar)='A'))
	GROUP BY medicos.cod_medi, medicos.nom_medi, areas.cod_areas, medicos.esta_medi
	ORDER BY medicos.nom_medi");
    
    ECHO" <div id='conte'>";
    //onscroll='saveScrollPos(this);'
    echo"<table align=left class='tbl2' width=100%>";	
    $n=1;
    while($rmedi=mysql_fetch_array($bmedi))
    {
        $codimed=$rmedi['cod_medi'];
        $nombmed=$rmedi['nom_medi'];			
        echo"<tr>";
        $nomvar='codmedi'.$n;
        echo"<input type=hidden name=$nomvar value='$codimed'>";
        $nomvar='selec'.$n;
        echo"<td align=center><input class=caja type=CheckBox name='$nomvar' value=1></td>";
        echo"<td><font size=1>$nombmed<font></td>
        </tr>";			
        $n=$n+1;
    }	
    echo"<input type=hidden name=finmed value=$n>";
    echo"</table>	
    </div>
    </td></tr>
    </table>
    <br>
    <table class='tbl' align=center  width=100%>		
    <tr>";
    if($dia1==1)echo"<td><input class=caja type=CheckBox checked name='dia1' value=1> LUNES</td>";
    else echo"<td><input class=caja type=CheckBox name='dia1' value=1> LUNES</td>";
    if($dia2==1)echo"<td><input class=caja type=CheckBox checked name='dia2' value=2> MARTES</td>";
    else echo"<td><input class=caja type=CheckBox name='dia2' value=2> MARTES</td>";
    if($dia3==1)echo"<td><input class=caja type=CheckBox checked name='dia3' value=3> MIERCOLES</td>";
    else echo"<td><input class=caja type=CheckBox name='dia3' value=3> MIERCOLES</td>";
    if($dia4==1)echo"<td><input class=caja type=CheckBox checked name='dia4' value=4> JUEVES</td>";
    else echo"<td><input class=caja type=CheckBox name='dia4' value=4> JUEVES</td>";
    if($dia5==1)echo"<td><input class=caja type=CheckBox checked name='dia5' value=5> VIERNES</td>";
    else echo"<td><input class=caja type=CheckBox name='dia5' value=5> VIERNES</td>";
    if($dia6==1)echo"<td><input class=caja type=CheckBox checked name='dia6' value=6> SABADO</td>";
    else echo"<td><input class=caja type=CheckBox name='dia6' value=6> SABADO</td>";
    if($dia7==1)echo"<td><input class=caja type=CheckBox checked name='dia7' value=0> DOMINGO</td>";
    else echo"<td><input class=caja type=CheckBox name='dia7' value=0> DOMINGO</td>";
    echo"
    </tr>		
    </table>
    <br>
    <table class='tbl' align=center  width=100%>
    <tr>
    <th>FECHA INICIAL</th>
    <td align=center>";
    ?>
    <input type="text" name="fechaini" class='caja' onfocus="sale(1)" size="10" maxlength="10" value="<?echo $fechaini;?>"  id="fini"<?echo $disp;?>>
    <input type="button" class='caja' id="lanzador1" name="bot1" value="..." <?echo $disp;?>/>
    <!-- script que define y configura el calendario-->
    <script type="text/javascript"> 
    Calendar.setup({ 
    inputField:"fini",     // id del campo de texto 
    ifFormat:"%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
    button:"lanzador1"     // el id del botón que lanzará el calendario 				
    }); 
    </script> 
    <?			
    echo"</td>
    <th>FECHA FINAL</td>
    <td align=center>";
    ?>
    <input type="text" name="fechafin" onfocus="sale(2)" class='caja' size="10" maxlength="10" value="<?echo $fechafin;?>" id="ffin" <?echo $disp;?>>
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
    <br>
    <table class='tbl' align=center  width=100%>		
    <tr>
    <th>HORA INICIAL</td>
    <td align=center>	
    <input type=text name=horaini class=caja size=2 onBlur='valhora(this,1)' id='hor1' onKeypress='if ((event.keyCode > 47 && event.keyCode <58)) event.returnValue = true;else event.returnValue = false;' value='$horaini'>
    <input type=text name=minuini class=caja size=2 onblur='valminu(this,1)'id='min1' onKeypress='if ((event.keyCode > 47 && event.keyCode <58)) event.returnValue = true;else event.returnValue = false;' value='$minuini'>
    </td>
    <th>HORA FINAL</td>
    <td align=center>
    <input type=text name=horafin class=caja size=2 onBlur='valhora(this,2)' id='hor2' onKeypress='if ((event.keyCode > 47 && event.keyCode <58)) event.returnValue = true;else event.returnValue = false;' value='$horafin'>
    <input type=text name=minufin class=caja size=2 onblur='valminu(this,2)'id='min2' onKeypress='if ((event.keyCode > 47 && event.keyCode <58)) event.returnValue = true;else event.returnValue = false;' value='$minufin'>
    </td>
    </tr>		
    </table><br>
    <table class='tbl' align=center  width=100%>		
    <tr>
    <th>INTERVALO</td>
    <td align=center><input type=text name=intervalo class=caja size=2 onKeypress='if ((event.keyCode > 47 && event.keyCode <58) || event.keyCode == 46) event.returnValue = true;else event.returnValue = false;' value='$intervalo'></td>
    <th>CITAS POR HORARIO</td>
    <td align=center><input type=text name=ncitados class=caja size=2 onKeypress='if ((event.keyCode > 47 && event.keyCode <58)) event.returnValue = true;else event.returnValue = false;' value='$ncitados'></td>
    </tr>		
    </table>
    <br>
    <table align=center class='tbl' width=100%>
    <tr><th colspan=3 align=center valign=top height=20><INPUT type=button name='bot' class='boton' value='ACEPTAR' onClick='valida();'></th></tr>	
    </table>
    </td></tr>
    </table>	
    </form>";
?>
</body>
</html>