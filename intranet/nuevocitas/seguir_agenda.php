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
    <script type="text/javascript">
    $().ready
    (
        function() 
        {		
            $("#course1").autocomplete("autocomp1.php", {          
            
            width: 260,
            minChars: 3,
            autoFill: false,
            mustMatch: false,
            matchContains: false,
            scroll: true,
            scrollHeight: 220            
            });	
            $("#course1").result(function(event, data, formatted) 
            {$("#course_val1").val(data['1']);
            });
        }	
    );
    $().ready
    (
        function() 
        {		
            $("#course").autocomplete("autocomp.php", {          
            
            width: 260,
            minChars: 3,
            autoFill: false,
            mustMatch: false,
            matchContains: false,
            scroll: true,
            scrollHeight: 220            
            });	
            $("#course").result(function(event, data, formatted) 
            {$("#course_val").val(data['1']);
            });
        }	
    );
    </script>

	<script language="javascript">
	function salir()
	{                
            if(uno.fechaini.value>uno.fechafin.value)
			{
				alert("La fecha de inicio no puede ser mayor a la fecha final");
				uno.fechaini.focus();
				return;			
			}		
			uno.entra.value='1';
            uno.action="seguir_agenda.php";
            uno.target="";
            uno.submit();			
	}
    
    function busca()
	{
		uno.codmedi.value='';
		uno.entra.value='0';
		uno.action="seguir_agenda.php";
		uno.target="";
		uno.submit();		
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
   
    $dateh=date("Y-m-d");
	$anoini=substr($dateh,0,4);
    $mesini=substr($dateh,5,2);
    $diaini=substr($dateh,8,2);	
    $dateini = gmmktime ( 00, 00, 00, $mesini, $diaini, $anoini);	
    $diaprog=$dateini+86400;
    $fechasig=gmdate ( "Y-m-d", $diaprog);
    if(empty($fechaini))$fechaini=$fechasig;
    if(empty($fechafin))$fechafin=$fechasig;  
    $usuario   = "root";
	$pass      = "";
	$conexion = mysql_connect("localhost",$usuario,$pass);
	if(!$conexion)
	{
		echo "Error de conexion a la base de datos, Intente mas tarde.";
		exit();
	}
	mysql_select_db("proinsalud",$conexion);
	if(empty($buspor))$buspor='1';
	$ch1="";$ch2="";
	if($buspor=='1')$ch1='checked';
	if($buspor=='2')$ch2='checked';
    echo"
	<form name=uno method=post>
	<input type=hidden name=entra value='0'>
    <br>    
    <table align=center class='tbl'>
    <tr><th colspan=6 >SEGUIMIENTO AGENDA <font color='#E3E3ED'> ------------------------------- </font> por medico<input type=radio $ch1 name=buspor onclick=busca() value='1'>
	<font color='#E3E3ED'> ---------- </font>por paciente<input type=radio $ch2 name=buspor onclick=busca() value='2'></th></tr>";
   
   
	echo"<tr>";
	if($buspor=='1')
	{
		echo"<th >MEDICO</th>
		<td align=center><input type=text id='course' class='caja' name='nommedi' size=40  value='$nommedi'></td>
		<input type='hidden' id='course_val' name='codmedi' value='$codmedi'>";
	}
	if($buspor=='2')
	{
		echo"<th>DOCUMENTO</th>
		<td align=center><input type=text class='caja' name='codmedi' size=40  value='$codmedi'></td>";
	}
	echo" 	
	<th >FECHA INICIAL</th>
	<td align=center>";
	?>
	<input type="text" name="fechaini" class='caja'  size="10" maxlength="10" value="<?echo $fechaini;?>" id="fini" <?echo $disp;?>>
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
	
	echo "</td>
	<th>FECHA INICIAL</th>
	<td align=center>";
	?>
	<input type="text" name="fechafin" class='caja' size="10" maxlength="10" value="<?echo $fechafin;?>" id="ffin" <?echo $disp;?>>
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
	<tr><th colspan=6 align=center valign=top><INPUT type=button class='boton' value='ACEPTAR' onClick='salir();'></th></tr>
	</table>
	<br>";
	if($entra=='1')
	{
		if($buspor=='1')
		{
			$bhor=mysql_query("SELECT horario_seguimiento.feccrea, horario_seguimiento.horcrea, horario_seguimiento.mediage, medicos.nom_medi, areas.nom_areas, horario_seguimiento.fecage, horario_seguimiento.horage, horario_seguimiento.usuacrea, horario_seguimiento.feceli, horario_seguimiento.horeli, horario_seguimiento.usuaeli, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, contrato.NEPS_CON, vitacora.Fopera_Vitaco, vitacora.Hopera_Vitaco, vitacora.Operacio_Vitaco, esta_cita.descrip_estaci, vitacora.Cod_oper_vitaco
			FROM ((horario_seguimiento INNER JOIN medicos ON horario_seguimiento.mediage = medicos.cod_medi) INNER JOIN areas ON horario_seguimiento.areaage = areas.cod_areas) LEFT JOIN ((((citas LEFT JOIN vitacora ON citas.id_cita = vitacora.Codci_Vitaco) LEFT JOIN contrato ON citas.Cotra_citas = contrato.CODI_CON) LEFT JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU) LEFT JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci) ON horario_seguimiento.idhorario = citas.ID_horario
			WHERE (((horario_seguimiento.mediage)='$codmedi') AND ((horario_seguimiento.fecage)>='$fechaini' And (horario_seguimiento.fecage)<='$fechafin')) ORDER BY horario_seguimiento.fecage DESC , horario_seguimiento.horage DESC");
		}
		if($buspor=='2')
		{
			$bhor=mysql_query("SELECT horario_seguimiento.feccrea, horario_seguimiento.horcrea, horario_seguimiento.mediage, medicos.nom_medi, areas.nom_areas, horario_seguimiento.fecage, horario_seguimiento.horage, horario_seguimiento.usuacrea, horario_seguimiento.feceli, horario_seguimiento.horeli, horario_seguimiento.usuaeli, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, contrato.NEPS_CON, vitacora.Fopera_Vitaco, vitacora.Hopera_Vitaco, vitacora.Operacio_Vitaco, esta_cita.descrip_estaci, vitacora.Cod_oper_vitaco
			FROM ((horario_seguimiento INNER JOIN medicos ON horario_seguimiento.mediage = medicos.cod_medi) INNER JOIN areas ON horario_seguimiento.areaage = areas.cod_areas) LEFT JOIN ((((citas LEFT JOIN vitacora ON citas.id_cita = vitacora.Codci_Vitaco) LEFT JOIN contrato ON citas.Cotra_citas = contrato.CODI_CON) LEFT JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU) LEFT JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci) ON horario_seguimiento.idhorario = citas.ID_horario
			WHERE (((horario_seguimiento.fecage)>='$fechaini' And (horario_seguimiento.fecage)<='$fechafin') AND ((usuario.NROD_USU)='$codmedi'))
			ORDER BY horario_seguimiento.fecage DESC , horario_seguimiento.horage DESC");
		}
		echo"<table align=center class='tbl'>";
		if(mysql_num_rows($bhor)>0)
		{
			echo"
			<tr>
			<th rowspan=2>MEDICO</th>	
			<th rowspan=2>AREA</th>
			<th colspan=5>DATOS DE CREACION DE AGENDA</th>
			<th colspan=3>DATOS DE ELIMINACION DE AGENDA</th>
			<th colspan=7>DATOS DE ASIGNACION DE CITA</th>
			<th rowspan=2>ESTADO</th>
			</tr>
			<tr>
			<th>FECHA AGENDA</th>	
			<th>HORA AGENDA</th>
			<th>FECHA CREACION</th>	
			<th>HORA CREACION</th>
			<th>FUNCIONARIO</th>
			
			<th>FECHA</th>	
			<th>HORA</th>
			<th>FUNCIONARIO</th>
			
			<th>DOC. PACIENTE</th>
			<th>NOMBRE PACIENTE</th>
			<th>CONTRATO</th>	
			<th>FECHA</th>	
			<th>HORA</th>	
			<th>TIPO OPERACION</th>				
			<th>FUNCIONARIO CITA</th>
			</tr>";
			
			while($rhor=mysql_fetch_array($bhor))
			{
				
				$medi=$rhor['nom_medi'];	
				$area=$rhor['nom_areas'];	
				$fechahor=$rhor['fecage'];	
				$horahor=$rhor['horage'];

				$fechacrea=$rhor['feccrea'];	
				$horacrea=$rhor['horcrea'];
				$operhor=$rhor['usuacrea'];
				
				
				
				$feceli=$rhor['feceli'];
				$horeli=$rhor['horeli'];
				$usuaeli=$rhor['usuaeli'];
				
				$docpac=$rhor['NROD_USU'];	
				$nompac=$rhor['PNOM_USU'].' '.$rhor['SNOM_USU'].' '.$rhor['PAPE_USU'].' '.$rhor['SAPE_USU'];	
				$contra=$rhor['NEPS_CON'];	
				$fecasig=$rhor['Fopera_Vitaco'];	
				$horasig=$rhor['Hopera_Vitaco'];	
				$opera=$rhor['Operacio_Vitaco'];	
				$estado=$rhor['descrip_estaci'];	
				$operacit=$rhor['Cod_oper_vitaco'];
				
				$hora=substr($horahor, 11,5);
				$ope='';
				if($opera=='Create_Cit')$ope="ASIGNACION";
				if($opera=='DELETE')$ope="CANCELACION";
					
				mysql_select_db("general",$conexion);
				$nomfunage='';
				$nomeli='';
				$nomfuncit='';
				$bfun1=mysql_query("select nomb_usua from cut where ide_usua='$operhor'");
				while($rfun1=mysql_fetch_array($bfun1))
				{
					$nomfunage=$rfun1['nomb_usua'];
				}
				$bfun2=mysql_query("select nomb_usua from cut where ide_usua='$usuaeli'");
				while($rfun2=mysql_fetch_array($bfun2))
				{
					$nomfuneli=$rfun2['nomb_usua'];
				}
				$bfun3=mysql_query("select nomb_usua from cut where ide_usua='$operacit'");
				while($rfun3=mysql_fetch_array($bfun3))
				{
					$nomfuncit=$rfun3['nomb_usua'];
				}
				
				mysql_select_db("proinsalud",$conexion);
				echo"
				<tr>
				<td>$medi</td>	
				<td>$area</td>
				<td>$fechahor</td>	
				<td>$horahor</td>					
				<td>$fechacrea</td>
				<td>$horacrea</td>
				<td>$nomfunage</td>
				<td>$feceli</td>
				<td>$horeli</td>
				<td>$nomfuneli</td>				
				<td>$docpac</td>
				<td>$nompac</td>
				<td>$contra</td>	
				<td>$fecasig</td>	
				<td>$horasig</td>	
				<td>$ope</td>					
				<td>$nomfuncit</td>
				<td>$estado</td>
				</tr>";
			}

		}
		else
		{
			echo"<tr><th>NO SE ENCUENTRA REGISTROS</th></tr>";
		}
		echo"</table>";
	}	
	echo"</form>";
?>
</body>
</html>