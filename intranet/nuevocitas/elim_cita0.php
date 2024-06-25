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
			
                    val="uno.selhora"+p+i+".value=v";
                    eval(val);
			
		}
		uno.target='';
		uno.action='elim_cita0.php';
		uno.submit();
		
	}
	function elihoras(p,r,v)
	{		
		val="uno.selhora"+p+r+".value=v";
		eval(val);		
		uno.target='';
		uno.action='elim_cita0.php';
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
			alert("Seleccione el medico");
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
		uno.bot.disabled=true;
		uno.target='';
		uno.action='elim_cita1.php';
		uno.submit();
	}
	function validausu()
	{		
		fin=uno.finusu.value;		
		for(i=0;i<fin;i++)
		{
			if(eval("uno.selci"+i+".checked")==true)
			{
				if(eval("uno.tipoci"+i+".value")=='')
				{
					alert("Seleccione el tipo de eliminacion");
					eval("uno.tipoci"+i+".focus()");
					return;
				}
				if(eval("uno.tipsoli"+i+".value")=='')
				{
					alert("Seleccione el tipo de solicitud");
					eval("uno.tipsoli"+i+".focus()");
					return;
				}
				
				
				
				
				
				val=eval("uno.obseli"+i+".value");							
				
				if(val.length<5)
				{
					alert("digite la observacion (minimo 5 caracteres)");
					eval("uno.obseli"+i+".focus()");
					return;
				}
			}
		}
		uno.bot1.disabled=true;
		uno.target='';
		uno.action='elim_cita1.php';		
		uno.submit();
	}
	
	function valfec(n)
	{
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
		uno.action='elim_cita0.php';
		uno.submit();	
	}
	function salto()
	{
		uno.target='';
		uno.action='elim_cita0.php';
		uno.submit();
	}	
	function sale(n)
	{
		if(n==1)uno.bot1.focus();
		if(n==2)uno.bot2.focus();
	
	}
	function salto1()
	{
		if (event.keyCode == 13)
        {
			uno.escontra.value='';			
			uno.action='asigna0.php';
			uno.target='area';
			uno.submit();		
		}
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
    foreach($_POST as $nombre_campo => $valor)
    { 
       $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
       eval($asignacion); 
    } 
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
    <th>BUSCAR POR</th>
    <td align=center>
    <select name=tipbusca class='caja' onchange=salto()>
    <option value=''></option>
    <option value='1'>PACIENTE</option>
    <option value='2'>MEDICO</option>
    </select>	
    </th>
    </tr>	
    </table>";	
    ?>
        <script language=Javascript>
        uno.tipbusca.value="<?echo $tipbusca;?>";		
        </script>
    <?	
    if($tipbusca==1) //PACIENTE
    {			
        echo"<br>
        <table class='tbl' align=center width=100%>
        <tr>
        <th>DOCUMENTO</th>
        <th><td align=center><input type=text name=cedula class='caja' onkeypress='salto1()' onBlur='salto()' value='$cedula'></td>
        </tr>
        </table>";
        $bususu=mysql_query("select * from usuario where NROD_USU='$cedula'");
        while($rusu=mysql_fetch_array($bususu))
        {
            $nombre=$rusu['PNOM_USU'].' '.$rusu['SNOM_USU'].' '.$rusu['PAPE_USU'].' '.$rusu['SAPE_USU'];
            $codusua=$rusu['CODI_USU'];
        }
        if(empty($codusua))$codusua='-1';
        ECHO"
        <table align=center class='tbl' width=100%>
        <tr><th	>$nombre</th></tr>
        </table>
        <br>
        </table>
        <br>";
        $buscita=mysql_query("SELECT horarios.Fecha_horario, horarios.Hora_horario, citas.Esta_cita, citas.ID_horario, citas.id_cita, medicos.nom_medi, areas.nom_areas, horarios.dia_horario, citas.Esta_cita,horarios.Usado_horario, citas.iden_dre
        FROM (((horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) INNER JOIN permisos_citas ON areas.cod_areas = permisos_citas.serv_per
        WHERE (((horarios.Fecha_horario)>='$dateh') AND ((citas.Idusu_citas)='$codusua') AND ((citas.Clase_citas)<'6') AND ((permisos_citas.usua_per)='$usucitas') AND ((permisos_citas.esta_per)='A') AND ((citas.Esta_cita)='1'))
        ORDER BY horarios.Fecha_horario DESC , horarios.Hora_horario DESC;
        ");
		
		
        ECHO"
        <table align=center class='tbl'>
        <tr>
        <th>SELECCIONAR</th>
        <th>NOMBRE MEDICO</th>
        <th>AREA</th>
        <th>DIA</th>
        <th>FECHA</th>
        <th>HORA</th>
		<th>TIPO DE ELIMINACION</th>
		<th>TIPO DE SOLICITUD</th>
		<th>OBSERVACIONES</th>
        </tr>";
        $n=0;
        while($rcit=mysql_fetch_array($buscita))
        {
            $medicoc=$rcit['nom_medi'];
            $areac=$rcit['nom_areas'];
            $fechac=$rcit['Fecha_horario'];
            $horac=$rcit['Hora_horario'];
            $ncitac=$rcit['id_cita'];
            $id_horc=$rcit['ID_horario'];
			$numref=$rcit['iden_dre'];
            $diahor=$rcit['dia_horario'];			
            $horace=substr($horac,11,5);
            $Usado_horario=$rcit['Usado_horario'];
            $nomvar='usado'.$n;
            echo"<input type=hidden name='$nomvar' value='$Usado_horario'>";	
            $nomvar='nhorario'.$n;
            echo"<input type=hidden name='$nomvar' value='$id_horc'>";	
            $nomvar='numref'.$n;
            echo"<input type=hidden name='$nomvar' value='$numref'>";	
			$nomvar='ncitac'.$n;
            echo"<input type=hidden name='$nomvar' value='$ncitac'>";				
            $nomvar='selci'.$n;
            echo"
            <tr>
            <td align=center><input type=checkbox name='$nomvar' value='1'></th>
            <td>$medicoc</th>
            <td>$areac</th>
            <td>$diahor</th>
            <td>$fechac</th>
            <td align=center>$horace</th>";
			
			
			$sSQL2="Select cod_ticita ,des_ticita  From tip_cita WHERE  cod_ticita>=6 Order By cod_ticita";
			$result1=mysql_query($sSQL2);
			$nomvar='tipoci'.$n;
			echo "<td align=center><select class='caja' name=$nomvar>
			<option value=''></option>";
			while ($row1=mysql_fetch_array($result1))
			{
				echo '<option value='.$row1["cod_ticita"].'>'.$row1["des_ticita"]; 
			}
			
			$busti=mysql_query("Select cod_ticita ,des_ticita  From tip_cita  where cod_ticita<=5 AND estado<>'I' Order By cod_ticita");
			$nomvar='tipsoli'.$n;
			echo "<td align=center><select class='caja' name=$nomvar>";
			echo "<option value=''></option>";
			while ($row3=mysql_fetch_array($busti))
			{
				echo '<option value='.$row3["cod_ticita"].'>'.$row3["des_ticita"]; 
			}		
			echo"</td>";
		
		
			
			$nomvar='obseli'.$n;
			echo"</td>
			<td><textarea name=$nomvar class='caja' cols=40 rows=2>$obseli</textarea></td>			
			</tr>";
            $n++;			
        }		
        echo "<input type=hidden name=finusu value=$n>";
        ECHO"<br>
        <table align=center class='tbl'=100%>
        <tr><th colspan=3 align=center valign=top height=20><INPUT type=button class='boton' name='bot1' value='ACEPTAR' onClick='validausu();'></th></tr>	
        </table>
        </td></tr>
        </table>";
    }
    if($tipbusca==2) //MEDICO
    {	
        echo"<br>
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
            //if($areasel==$codare)echo"<option selected value=$codare>$nomare</option>";	
            //else echo"<option value=$codare>$nomare</option>";
			echo"<option value=$codare>$nomare</option>";
        }
        echo"</select></td>";
		?>
		<script language='Javascript'>
		uno.areasel.value="<?php echo $areasel;?>";
		</script>
		<?php
        $bmedi=mysql_query("SELECT medicos.nom_medi, medicos.cod_medi
        FROM medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar
        WHERE (((areas_medic.areas_ar)='$areasel')) and (((areas_medic.areas_ar)<>'')) order by medicos.nom_medi");
        echo"<td><select name=medico onchange='salto()'>
        <option value=''></option>";			
        while($rmedi=mysql_fetch_array($bmedi))
        {
            $codimed=$rmedi['cod_medi'];
            $nombmed=$rmedi['nom_medi'];			
            if($medico==$codimed)echo"<option selected value=$codimed>$nombmed</option>";
            else echo"<option value=$codimed>$nombmed</option>";			
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
        <input type="text" name="fechaini" class='caja' onfocus="sale(1)" size="10" onchange='valfec(1)' maxlength="10" value="<?echo $fechaini;?>" id="fini" <?echo $disp;?>>
        <input type="button" class='caja' id="lanzador1" name="bot1" value="..." <?echo $disp;?>/>
        <!-- script que define y configura el calendario--> 
        <script type="text/javascript"> 
        Calendar.setup({ 
        inputField     :    "fini",     // id del campo de texto 
        ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
        button     :    "lanzador1"     // el id del botn que lanzar el calendario 				
        }); 
        </script> 				
        <?			
        echo"</td>
        <th>FECHA FINAL</td>
        <td align=center>";
        ?>
        <input type="text" name="fechafin" onfocus="sale(2)" class='caja' size="10" onchange='valfec(2)' maxlength="10" value="<?echo $fechafin;?>" id="ffin" <?echo $disp;?>>
        <input type="button" class='caja' id="lanzador2" name="bot2" value="..." <?echo $disp;?>/>
        <!-- script que define y configura el calendario--> 
        <script type="text/javascript"> 
        Calendar.setup({ 
        inputField     :    "ffin",     // id del campo de texto 
        ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
        button     :    "lanzador2"     // el id del botn que lanzar el calendario 				
        }); 
        </script> 				
        <?		
        echo"</td>		
        </tr>		
        </table>
        <br>";
       
        $bfecdis=mysql_query("SELECT Max(horarios.Fecha_horario) AS MxDeFecha_horario, horarios.Fecha_horario
        FROM horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario
        WHERE (((horarios.Cmed_horario)='$medico') AND ((horarios.Cserv_horario)='$areasel') AND (Max(horarios.Fecha_horario))>='$fechaini' And (Max(horarios.Fecha_horario))<='$fechafin' AND ((horarios.ncita_horario)<>horarios.Usado_horario) AND ((citas.Clase_citas)<'6'))
        GROUP BY horarios.Fecha_horario");
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
            $bhordis=mysql_query("SELECT horarios.Fecha_horario, horarios.Fecha_horario, horarios.Hora_horario, citas.Esta_cita, citas.ID_horario, citas.id_cita, horarios.ncita_horario, horarios.Cmed_horario, horarios.Cserv_horario,horarios.Usado_horario, 
            usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, citas.iden_dre
            FROM (horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU
            WHERE (((horarios.Fecha_horario)='$Fecha_horario') AND ((citas.Esta_cita)<'6') AND ((horarios.Cmed_horario)='$medico') AND ((horarios.Cserv_horario)='$areasel') AND ((horarios.Usado_horario)<>horarios.ncita_horario))");
            $r=0;
            while($rhdis=mysql_fetch_array($bhordis))
            {				
                $estado=$rhdis['Esta_cita'];
                $Usado_horario=$rhdis['Usado_horario'];
                $Cmed_horario=$rhdis['Cmed_horario'];
                $Hora_horario=$rhdis['Hora_horario'];
                $Cserv_horario=$rhdis['Cserv_horario'];
                $ID_horario=$rhdis['ID_horario'];
                $id_cita=$rhdis['id_cita'];
                $ncita_horario=$rhdis['ncita_horario'];
				$numref=$rcit['iden_dre'];
                $hora=substr($Hora_horario,11,5);
                $cedusu=$rhdis['NROD_USU'];
                $nomusu=$rhdis['PNOM_USU'].' '.$rhdis['SNOM_USU'].' '.$rhdis['PAPE_USU'].' '.$rhdis['SAPE_USU'];
                $nomvar='usado'.$p.$r;
                echo"<input type=hidden name='$nomvar' value='$Usado_horario'>";
                $nomvar='nhorario'.$p.$r;
                echo"<input type=hidden name='$nomvar' value='$ID_horario'>";	
                $nomvar='id_cita'.$p.$r;				
                echo"<input type=hidden name=$nomvar value=$id_cita>";
                $nomvar='Usado_horario'.$p.$r;				
                echo"<input type=hidden name=$nomvar value=$Usado_horario>";
                $nomvar='ncita_horario'.$p.$r;
                echo"<input type=hidden name=$nomvar value=$ncita_horario>";
				$nomvar='numref'.$p.$r;
                $numref=$$nomvar;
                echo"<input type=hidden name=$nomvar value=$numref>";				
                $nomvar='idenhor'.$p.$r;
                $idenhor=$$nomvar;
                echo"<input type=hidden name=$nomvar value=$idenhor>";			
                $nomvar='selhora'.$p.$r;
                $selhora=$$nomvar;
                //background='img/elidia.png'
                echo"<input type=hidden name=$nomvar value=$selhora>";				
                if($selhora==1)echo"<td align=center bgcolor='#FFFFFF'><a href='#' onclick='elihoras($p,$r,0)' title='$cedusu - $nomusu'><font color='#bb0000'>$hora</a></td>";	
                else echo"<td align=center bgcolor='#FFFFFF'><a href='#' onclick='elihoras($p,$r,1)'title='$cedusu - $nomusu'><font color='#0000FF'>$hora</a></td>";				
                $r++;
            }
            $nomvar='fin'.$p;
            echo"<input type=hidden name=$nomvar value=$r>";
            echo"<tr>";
            $p++;
        }
        echo"<input type=hidden name=finalp value=$p>";
        echo"</tr></table></tr></table>
		<br>
		<table align=center class='tbl'=100%>
		<tr><td colspan=><textarea name=obselime class='caja' cols=100 rows=3>$obselime</textarea></td></tr>
		</table>
		
		";	
        ECHO"<br>
        <table align=center class='tbl'=100%>
        <tr><th colspan=3 align=center valign=top height=20><INPUT type=button class='boton' name='bot' value='ACEPTAR' onClick='valida();'></th></tr>	
        </table>
        </td></tr>
        </table>";
    }		
    echo"</form>";
?>
</body>
</html>