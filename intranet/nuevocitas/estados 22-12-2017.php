<?
session_start();
    $usucitas=$_SESSION['usucitas'];
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 
//echo $opcimenu;
?>
<html>
<head>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" />  
  <script type="text/javascript" src="java/calendar/calendar.js"></script> 
  <script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script>
  <script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<link rel="stylesheet" href="style.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type='text/javascript' src='js/jquery.autocomplete.js'></script>
    

<script language="javascript">
	
    function cambio(n)
	{		
		uno.cambiocita.value=n;              
		uno.action='estados.php';
		uno.target='';
		uno.submit();			
	}
	function guarda_cam(n)
	{		
        if(uno.camcita.value=='2')cam="ATENDIDA";
		if(uno.camcita.value=='4')cam="INASISTENCIA";
		if (confirm("¿Cambiar estado de cita a "+cam+"?") == true) 
		{
			uno.numero_cam.value=n; 
			uno.modifica.value=1; 		
			uno.action='estados.php';
			uno.target='';
			uno.submit();	
		} 
		else
		{
			uno.action='estados.php';
			uno.target='';
			uno.submit();	
		}
	}
</script>
</head>
<body lang=ES style='tab-interval:35.4pt'>
<style>
#conte {
overflow:auto;
height: 300px;
width: 600px;
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
    
   echo "<form name='uno' method='post'>";
   echo"<input type=hidden name=modifica>
   <input type=hidden name=cambiocita>
   <input type=hidden name=numero_cam>
	<input type=hidden name=jornada value='$jornada'>   
    <input type=hidden name=jornada value='$jornada'>
	<input type=hidden name=fechaini value='$fechaini'>
	<input type=hidden name=fechafin value='$fechafin'>
	<input type=hidden name=codarea value='$codarea'>
	<input type=hidden name=codmedi value='$codmedi'>
	<input type=hidden name=impripor value='$impripor'>
	<input type=hidden name=grupo value='$grupo'>
	<input type=hidden name=contra value='$contra'>";
   
    include ('php/conexion1.php');  

	if($modifica==1 && ($camcita==2 || $camcita==4))
	{
		mysql_query("UPDATE citas SET Esta_cita='$camcita' WHERE id_cita='$numero_cam'");
	}
	
    set_time_limit (180);
    $fecdig=(date("Y-m-d"));
    $hora=(date("H-i")); 
    $fecha=date("Y-m-d");
    $hora=date("H:i:s");
    
	$cad='';
    if($contra<>'')$cad=" AND contrato.CODI_CON='$contra'";
	
	
	if ($jornada=='D')
    {
        $horai="0001-01-01 01:00:00";
        $horaf="0001-01-01 24:00:00";
    }

    if ($jornada=='M')
    {
        $horai="0001-01-01 01:00:00";
        $horaf="0001-01-01 12:59:00";
    }
    if ($jornada=='T')
    {
        $horai="0001-01-01 13:00:00";
        $horaf="0001-01-01 24:00:00";
    }
$fechaini='2015-12-01';
$fechafin='2015-12-04';
    if($impripor==1)
    {			
		$cadmed=mysql_query("SELECT medicos.cod_medi, areas_1.nom_areas, medicos.nom_medi, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, citas.Cotra_citas, contrato.NEPS_CON, horarios.Fecha_horario, horarios.Hora_horario, citas.Tusua_citas, ucontrato.ESTA_UCO, usuario.FNAC_USU, citas.Clase_citas, grup_area.cogr_grar, citas.Esta_cita, citas.id_cita
		FROM (((contrato INNER JOIN ((usuario INNER JOIN ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) ON usuario.CODI_USU = citas.Idusu_citas) INNER JOIN ucontrato ON (citas.Cotra_citas = ucontrato.CONT_UCO) AND (usuario.CODI_USU = ucontrato.CUSU_UCO)) ON contrato.CODI_CON = ucontrato.CONT_UCO) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) INNER JOIN areas AS areas_1 ON areas.equi_area = areas_1.cod_areas) INNER JOIN grup_area ON areas_1.equi_area = grup_area.coar_grar
		WHERE (((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin') AND ((horarios.Hora_horario)>='$horai' And (horarios.Hora_horario)<='$horaf') AND ((citas.Clase_citas)<'6') AND ((grup_area.cogr_grar)='$grupo') $cad)
		ORDER BY areas_1.nom_areas, medicos.nom_medi, horarios.Fecha_horario, horarios.Hora_horario");
		
    }    
    if($impripor==2)
    {
        $cmed='0000';
        $care='0000';
        $cadmed=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi, horarios.Cserv_horario, areas.nom_areas, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, citas.Cotra_citas, contrato.NEPS_CON, horarios.Fecha_horario, horarios.Hora_horario, citas.Tusua_citas, ucontrato.ESTA_UCO, usuario.FNAC_USU, citas.Esta_cita, citas.id_cita
        FROM contrato INNER JOIN (((usuario INNER JOIN ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) ON usuario.CODI_USU = citas.Idusu_citas) INNER JOIN ucontrato ON (citas.Cotra_citas = ucontrato.CONT_UCO) AND (usuario.CODI_USU = ucontrato.CUSU_UCO)) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) ON contrato.CODI_CON = ucontrato.CONT_UCO
        WHERE horarios.Cserv_horario='$codarea' AND horarios.Fecha_horario>='$fechaini' And horarios.Fecha_horario<='$fechafin' 
        AND horarios.Hora_horario>='$horai' And horarios.Hora_horario<='$horaf' AND Clase_citas<'6' $cad
        ORDER BY medicos.nom_medi, horarios.Fecha_horario, horarios.Hora_horario");
    }
	
    if($impripor==3)
    {
        $cadmed=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi, horarios.Cserv_horario, areas.nom_areas, 
		usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, 
		citas.Cotra_citas, contrato.NEPS_CON, horarios.Fecha_horario, horarios.Hora_horario, citas.Tusua_citas, 
		ucontrato.ESTA_UCO, usuario.FNAC_USU, citas.Esta_cita, citas.id_cita
        FROM contrato INNER JOIN (((usuario INNER JOIN ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) ON usuario.CODI_USU = citas.Idusu_citas) INNER JOIN ucontrato ON (usuario.CODI_USU = ucontrato.CUSU_UCO) AND (citas.Cotra_citas = ucontrato.CONT_UCO)) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) ON contrato.CODI_CON = ucontrato.CONT_UCO
        WHERE medicos.cod_medi='$codmedi' AND horarios.Fecha_horario>='$fechaini' And horarios.Fecha_horario<='$fechafin'
        AND horarios.Hora_horario>='$horai' And horarios.Hora_horario<='$horaf' AND Clase_citas<'6' $cad
        ORDER BY horarios.Fecha_horario, horarios.Hora_horario");
	}
    $num=mysql_num_rows($cadmed);
    
    $cmed='0000';
    $care='0000';
    echo "<table align=center width=70%>
	<tr><td><table>";
    $n=0;
	$med='';
    while($rcm=mysql_fetch_array($cadmed))
    {       
        $numcita=$rcm['id_cita']; 
		$codmedico=$rcm['cod_medi']; 
        $nommedico=$rcm['nom_medi'];
        $codarea=$rcm['Cserv_horario'];
        $nomarea=$rcm['nom_areas'];
        $tipdoc=$rcm['TDOC_USU'];
        $cedusu=$rcm['NROD_USU'];
        $nomusu=$rcm['PNOM_USU'].' '.$rcm['SNOM_USU'];
        $apeusu=$rcm['PAPE_USU'].' '.$rcm['SAPE_USU'];
        $codcontrato=$rcm['Cotra_citas'];
        $nomcontrato=$rcm['NEPS_CON'];
        $fechacita=$rcm['Fecha_horario'];
        $horacita=substr($rcm['Hora_horario'],11,5);
        $tipafi=$rcm['Tusua_citas'];
        $estacontra=$rcm['ESTA_UCO'];  
        $fecnac=$rcm['FNAC_USU']; 
		$estacita=$rcm['Esta_cita'];
		
		$bnar=mysql_query("SELECT areas.cod_areas, areas.nom_areas, areas.equi_area, areas_1.nom_areas AS narea
		FROM areas INNER JOIN areas AS areas_1 ON areas.equi_area = areas_1.cod_areas
		WHERE (((areas.cod_areas)='$codarea'))");
		while($rnar=mysql_fetch_array($bnar))
        {
			$nomarea=$rnar['narea'];		
		}			
        if($codmedico!=$med)
        {
            echo"</table> <br><table class='tbl' width=100%>
			<tr>
			<td>MEDICO: $nommedico</td>
			<td>CODIGO: $codmedico</td>
			<td>AREA: $nomarea</td>
			<td>FECHA CITA: $fechacita</td>
			</tr>
			</table>
			<br>
			<table class='tbl' width=100%>
			<tr>
			<th>FECHA</th>
			<th>HORA</th>
			<th>CONTRATO</th>
			<th>CEDULA</th>
			<th>NOMBRES</th>
			<th>APELLIDOS</th>
			<th>ESTADO CITA</th>
			<tr>";
			$med=$codmedico;
        }
		$escita=mysql_query("select * from esta_cita where cod_estaci='$estacita'");
		$rescita=mysql_fetch_array($escita);
		$estado_cita=$rescita['descrip_estaci'];
		

		echo"<tr>
		<td align=center>$fechacita</td>
		<td>$horacita</td>
		<td align=center>$nomcontrato</td>
		<td>$cedusu</td>
		<td>$nomusu</td>
		<td>$apeusu</td>";
		if($numcita != $cambiocita)
		{			
				if($estacita=='1')echo"<td><a href='#' onclick=cambio($numcita)>$estado_cita</a></td>";
				else echo"<td>$estado_cita</td>";
		}
		else
		{
			echo"
			<td><select name=camcita class=caja onchange='guarda_cam($numcita)'>
			<option value='0'>$estado_cita</option>
			<option value='2'>ATENDIDA</option>
			<option value='4'>INASISTENCIA</option>
			</select>
			<td>";
		}
		echo"</tr>";
        $n++;
    } 
echo"</td></tr></table>
</form>";	
?>
<body>
</html>




<html><head></head><body></body></html>