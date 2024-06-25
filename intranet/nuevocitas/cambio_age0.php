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
	function sale(n)
	{
		if(n==1)uno.bot1.focus();
		if(n==2)uno.bot2.focus();	
	}
	function valida(n)
	{		
		if(n==1)
		{
			/*
			if(uno.fechaori.value<uno.fechahoy.value)
			{
				alert("La fecha de origen no puede ser menor que la fecha actual");
				uno.fechaori.value='';
				uno.bot1.focus();
			}
			*/
		}
		if(n==2)
		{			
			
			if(uno.fechades.value<uno.fechahoy.value)
			{
				alert("La fecha de destino no puede ser menor que la fecha actual");
				uno.fechades.value='';
				uno.bot2.focus();
			}
			
		}	
	}
	function salto()
	{
		uno.target='';
		uno.action='cambio_age0.php';
		uno.submit();	
	}
	function salir()
	{
		                
                if(uno.area.value=='')
                {
                    alert("Seleccione el area");
                    uno.area.focus()
                    return;
                }
                if(uno.medicoori.value=='')
                {
                    alert("Seleccione el médico origen");
                    uno.medicoori.focus()
                    return;
                }    
                if(uno.medicodes.value=='')
                {
                    alert("Seleccione el médico destino");
                    uno.medicodes.focus()
                    return;
                }
                if(uno.fechaori.value=='')
                {
                    alert("Seleccione la fecha origen");
                    uno.fechaori.focus()
                    return;
                }
                if(uno.fechades.value=='')
                {
                    alert("Seleccione la fecha destino");
                    uno.fechades.focus()
                    return;
                }
                
                
                uno.abre.value=1;
		uno.target='';
		uno.action='cambio_age0.php';
		uno.submit();	
	}
	function cambiar()
	{
		uno.target='';
		uno.action='cambio_age1.php';
		uno.submit();	
	}		
</script>
</head>
<body style='position:absolute;margin-top:10'>
<style>
#conte {
overflow:auto;
height: 200px;
width: 100%;
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
    if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
    $fecha_hoy=date("Y-m-d");
    //onload="setScrollPos('conte')"
    include ('php/conexion.php');
    $bususua=mysql_query("SELECT * FROM cut Order By nomb_usua");	//usuarios del sistema
    include ('php/conexion1.php');
    $busarea=mysql_query("SELECT Max(permisos_citas.serv_per) AS codi, areas.nom_areas AS nomb
    FROM permisos_citas INNER JOIN areas ON permisos_citas.serv_per = areas.cod_areas
    WHERE (((permisos_citas.usua_per)='$usucitas') AND ((permisos_citas.esta_per)='A'))
    GROUP BY areas.nom_areas");
        
    echo"<form name=uno method=post>
    <input type=hidden name=fechahoy value='$fecha_hoy'>
    <input type=hidden name=abre>
    <table align=center>
    <tr><td>
    <table align=center class='tbl' width=100%>
    <tr><th>CAMBIO DE AGENDA</th></tr>
    </table>
    <br>
    <table class='tbl' align=center width=100%>
    <tr>
    <th>AREA</th>
    <td>";
    echo"<select name=area class=caja onchange='salto()'>
    <option value=''></option>";
    while($rare=mysql_fetch_array($busarea))
    {
            $nomare=$rare['nomb'];
            $codare=$rare['codi'];
            if($codare===$area)echo"<option selected value='$codare'>$nomare</option>";
            else echo"<option value='$codare'>$nomare</option>";
    }	
    echo"</select>
    </td></tr>";
    if(!empty($area))
    {
        echo"
        <tr><th>MEDICO ORIGEN</th><td>";
        $n=0;
        $bmedi=mysql_query("SELECT medicos.nom_medi, medicos.cod_medi
        FROM medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar
        WHERE (((areas_medic.areas_ar)='$area')) order by medicos.nom_medi");
        echo"<select name=medicoori class=caja onchange='salto()'>
        <option value=''></option>";
        while($rmedi=mysql_fetch_array($bmedi))
        {
                $codimed=$rmedi['cod_medi'];
                $nombmed=$rmedi['nom_medi'];
                if($codimed==$medicoori)echo"<option selected value='$codimed'>$nombmed</option>";
                else echo"<option value='$codimed'>$nombmed</option>";
        }
        
        
        echo"</select></td></tr>";
        echo"
        <tr><th>MEDICO DESTINO</th><td>";
        $n=0;
        $bmedi1=mysql_query("SELECT medicos.nom_medi, medicos.cod_medi
        FROM medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar
        WHERE (((areas_medic.areas_ar)='$area')) order by medicos.nom_medi");
        echo"<select name=medicodes class=caja onchange='salto()'>
        <option value=''></option>";

        while($rmedi1=mysql_fetch_array($bmedi1))
        {
            $codimed1=$rmedi1['cod_medi'];
            $nombmed1=$rmedi1['nom_medi'];
            if($codimed1==$medicodes)echo"<option selected value='$codimed1'>$nombmed1</option>";
            else echo"<option value='$codimed1'>$nombmed1</option>";
        }
        
        echo"</select></td></tr>
        <tr>
        <th>FECHA ORIGEN</th>
        <td align=center>";
        ?>
        <input type="text" name="fechaori" class='caja' onfocus="sale(1)" onchange="valida(1)" size="10" maxlength="10" value="<?echo $fechaori;?>" id="fori" <?echo $disp;?>>
        <input type="button" class='caja' id="lanzador" name="bot1" value="..." <?echo $disp;?>/>
        <!-- script que define y configura el calendario--> 
        <script type="text/javascript"> 
        Calendar.setup({ 
        inputField     :    "fori",     // id del campo de texto 
        ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
        button     :    "lanzador"     // el id del botón que lanzará el calendario 				
        }); 
        </script> 				
        <?		
        echo"
        </td>
        </tr>
        <tr>
        <th>FECHA DESTINO</th>
        <td align=center>";

        ?>
        <input type="text" name="fechades" class='caja' onfocus="sale(2)" onchange="valida(2)" size="10" maxlength="10" value="<?echo $fechades;?>" id="fdes" <?echo $disp;?>>
        <input type="button" class='caja' id="lanzador1" name="bot2" value="..." <?echo $disp;?>/>
        <!-- script que define y configura el calendario--> 
        <script type="text/javascript"> 
        Calendar.setup({ 
        inputField     :    "fdes",     // id del campo de texto 
        ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
        button     :    "lanzador1"     // el id del botón que lanzará el calendario 				
        }); 
        </script> 
        
        <?		
        echo"
        </td>
        </tr>		
        <tr><th align=center height=20 colspan=2>
        <INPUT type=button class='boton' value='aceptar' onClick='salir();'>
        </th></tr>";	
    }	
    echo"</table>
    </table>";

    if($abre==1)
    {
        $bcit=mysql_query("SELECT horarios.Cmed_horario, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Usado_horario, citas.Clase_citas, citas.Esta_cita, 
        horarios.Hora_horario, citas.Idusu_citas, citas.id_cita, citas.ID_horario, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU
        FROM (citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU
        WHERE (((horarios.Cmed_horario)='$medicoori') AND ((horarios.Cserv_horario)='$area') AND ((horarios.Fecha_horario)='$fechaori') AND ((horarios.Usado_horario)<>horarios.ncita_horario) AND ((citas.Clase_citas)<='5') AND ((citas.Esta_cita)<>'2'))
        ORDER BY horarios.Fecha_horario, horarios.Hora_horario");
        if(mysql_num_rows($bcit)>0)
        {
            echo"<br><br><table align=center class='tbl' width=70%>
            <tr>
            <th width=10%>Seleccionar</th>
            <th width=10%>Hora</th>
            <th width=10%>Fecha</th>
            <th width=20%>Medico origen</th>
            <th width=20%>Medico Destino</th>
            <th width=10%>cedula</th>
            <th width=20%>Nombre paciente</th>
            </tr>
            </table>
            <div id='conte'>
            <table align=center class='tbl' width=70%>
            ";
            $bmed1=mysql_query("select * from medicos where cod_medi='$medicoori'");
            $rmed1=mysql_fetch_array($bmed1);
            $nomed1=$rmed1['nom_medi'];
            $bmed2=mysql_query("select * from medicos where cod_medi='$medicodes'");
            $rmed2=mysql_fetch_array($bmed2);
            $nomed2=$rmed2['nom_medi'];
            $i=0;
            while($rcit=mysql_fetch_array($bcit))
            {
                $codmed=$rcit['Cmed_horario'];
                $codarea=$rcit['Cserv_horario'];
                $fecha=$rcit['Fecha_horario'];
                $usado=$rcit['Usado_horario'];
                $clase=$rcit['Clase_citas'];
                $estado=$rcit['Esta_cita'];
                $hora=$rcit['Hora_horario'];
                $iduso=$rcit['Idusu_citas'];
                $idcita=$rcit['id_cita'];
                $idhorario=$rcit['ID_horario'];
                $cedula=$rcit['NROD_USU'];
                $nombrepac=$rcit['PNOM_USU'].' '.$rcit['SNOM_USU'].' '.$rcit['PAPE_USU'].' '.$rcit['SAPE_USU'];
                $hora=substr($hora,11,5);
                $nomvar='id_hor'.$i;
                echo"<input type=hidden name='$nomvar' value='$idhorario'>";
                $nomvar='item'.$i;
                echo"<tr>
                <td align=center width=10%><input type=checkbox checked name='$nomvar' value=1></td>
                <td width=10%>$hora</td>
                <td width=10%>$fecha</td>
                <td width=20%>$nomed1</td>
                <td width=20%>$nomed2</td>
                <td width=10%>$cedula</td>
                <td width=20%>$nombrepac</td>				
                </tr>";				
                $i=$i+1;
            }
            $finmed=$i;
            echo"<input type=hidden name=finmed value='$finmed'>";
            echo"
            </table>
            </div>";
            echo"<table align=center class='tbl' width=100%>
            <tr><th align=center height=20 colspan=2>
            <INPUT type=button class='boton' value='aceptar' onClick='cambiar();'>
            </th></tr>
            </table>";
        }

        else
        {
            echo"<br><br><table align=center class='tbl'>
            <tr>
            <th>EL MEDICO NO REGISTRA CITAS PROGRAMADAS PARA LA FECHA SELECIONADA</th>
            </tr>
            </table>";
        }	
    }
    echo"</form>";
?>
</body>
</html>