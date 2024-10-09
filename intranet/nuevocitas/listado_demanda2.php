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
            if(uno.codarea.value=='')
			{
				alert("Seleccione el area");
				uno.nomarea.focus();
				return;			
			}
			
			if(uno.fechaini.value>uno.fechafin.value)
			{
				alert("La fecha de inicio no puede ser mayor a la fecha final");
				uno.fechaini.value=uno.fecrec.value
				uno.fechaini.focus();
				return;			
			}		
			 uno.action="listado_demanda.php";
            uno.target='';
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
    //onload="setScrollPos('conte')"
	//echo ' - '.$opcimenu;
	//ECHO $destino;
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
    if(empty($fechaini))$fechaini=$fechasig;
    if(empty($fechafin))$fechafin=$fechasig;  
    include ('php/conexion1.php');
    $busgru=mysql_query("SELECT * FROM grupos Order By nomb_gru");	//grupos
    echo"<form name=uno method=post>
    <input type=hidden name=fecrec value='$fechaini'>
    <input type=hidden name=titulo value='$titulo'>
    <input type=hidden name=opc>
    <input type=hidden name=opcimenu value='$opcimenu'>
    <br><br>
    <table align=center width='350'>
    <tr><td>
    <table align=center class='tbl' width=100%>
    <tr><th colspan=2 height=40>LISTADO DEMANDA INDUCIDA</th></tr>
    <tr><th height=30>  
	AREA</th>
	<td align=center><input type=text id='course1' class='caja' name='nomarea' size=40 value='$nomarea'></td>
	<input type='hidden' id='course_val1' name='codarea' value='$codarea'>
	</tr>";   
    
	echo"       
	<tr>
	<th height=30>FECHA</th>
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
    <tr><th colspan=2 align=center valign=top height=20><INPUT type=button class='boton' value='ACEPTAR' onClick='salir();'></th></tr>
	</table>
    </table><br>";
	$fecha=date("Y-m-d");
    $hora=date("H:i:s");  
	if($fechaini!='' && $fechafin!='' && $codarea!='')
	{
		$cadmed=mysql_query("SELECT medicos.cod_medi, medicos.espe_med, medicos.pnom_medi, medicos.pape_medi, medicos.nom_medi, horarios.Cserv_horario, areas.nom_areas, usuario.TRES_USU, usuario.TEL2_USU, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, citas.Cotra_citas, contrato.NEPS_CON, horarios.Fecha_horario, horarios.Hora_horario, citas.Tusua_citas, ucontrato.ESTA_UCO, usuario.DCOT_USU, usuario.CODI_USU
		FROM contrato INNER JOIN (((usuario INNER JOIN ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) ON usuario.CODI_USU = citas.Idusu_citas) INNER JOIN ucontrato ON (citas.Cotra_citas = ucontrato.CONT_UCO) AND (usuario.CODI_USU = ucontrato.CUSU_UCO)) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) ON contrato.CODI_CON = ucontrato.CONT_UCO
		WHERE horarios.Fecha_horario>='$fechaini' And horarios.Fecha_horario<='$fechafin' AND citas.Clase_citas<'6' and horarios.Cserv_horario='$codarea'
		ORDER BY medicos.nom_medi, horarios.Fecha_horario, horarios.Hora_horario");
		
		$num=mysql_num_rows($cadmed);
		if($num>0)
		{
			echo"<table align=center class='tbl' width=100%>
			<tr>
			<th>NRO.</th>
			<th>DOCUMENTO</th>
			<th>NOMBRE</th>
			<th>TELEFONO1</th>
			<th>TELEFONO2</th>
			<th>DUPLICADO</th>
			<th>FECHA</th>
			<th>HORA</th>
			<th>MEDICO</th>
			<th>MENSAJE</th>
			<th>CARACTERES</th>
			</tr>";
			$codusuario='';
			$n=0;
			while($rcm=mysql_fetch_array($cadmed))
			{           
				$codmedico=$rcm['cod_medi']; 
				$nommedico=$rcm['nom_medi'];
				$codarea=$rcm['Cserv_horario'];
				$nomarea=$rcm['nom_areas'];
				$tipdoc=$rcm['TDOC_USU'];
				$cedusu=$rcm['NROD_USU'];
				$nomusu=$rcm['PNOM_USU'].' '.$rcm['PAPE_USU'];
				$codcontrato=$rcm['Cotra_citas'];
				$nomcontrato=$rcm['NEPS_CON'];
				$fechacita=$rcm['Fecha_horario'];
				$doccoti=$rcm['DCOT_USU'];
				$horacita=$rcm['Hora_horario'];
				$tel1=$rcm['TRES_USU'];
				$tel2=$rcm['TEL2_USU'];
				$nommedi=$rcm['pnom_medi'].' '.$rcm['pape_medi'];
				$espe=$rcm['espe_med'];
				$codi_usu=$rcm['CODI_USU'];				
				if($codi_usu != $codusuario)
				{
					$n++;
					$ano=substr($fechacita,0,4);
					$mes=substr($fechacita,5,2);
					$dia=substr($fechacita,8,2);
					if($mes=='01')$dmes="ENE";
					if($mes=='02')$dmes="FEB";
					if($mes=='03')$dmes="MAR";
					if($mes=='04')$dmes="ABR";
					if($mes=='05')$dmes="MAY";
					if($mes=='06')$dmes="JUN";
					if($mes=='07')$dmes="JUL";
					if($mes=='08')$dmes="AGO";
					if($mes=='09')$dmes="SEP";
					if($mes=='10')$dmes="OCT";
					if($mes=='11')$dmes="NOV";
					if($mes=='12')$dmes="DIC";
					
					$hora=substr($horacita,11,2);
					$minu=substr($horacita,14,2);
					
					if($hora<12)$ampm="AM";
					if($hora>=12)$ampm="PM";
					$fec=$dia.'-'.$dmes.'-'.$ano;
					if($hora>12)$hora=$hora-12;
					$lar1=strlen($tel1);
					$lar2=strlen($tel2);
					if($lar1<10 && $lar2==10)
					{
						$telaux=$tel1;
						$tel1=$tel2;
						$tel2=$telaux;
					}
					
					if($lar1==10 && $lar2==10)
					{
						if($tel1 !=$tel2)
						{						
							$dup=2;
						}
						else
						{
							$dup=1;
							$tel2='';
						}
					}
					else $dup=1;
									
					for($i=0;$i<$dup;$i++)
					{
						$dupli='';
						if($i==0 && $dup==2)
						{
							$dupli='DUPLICADO A';
							$telaux=$tel2;
							$tel2='';
						}
						if($i==1 && $dup==2)
						{
							$tel1=$telaux;
							$tel2='';
							$dupli='DUPLICADO B';
							
						}
						
						if($espe=='2656')$mensaje="SR@ ".$nomusu." PROINSALUD SA LE RECUERDA QUE EL ".$fec." A LAS ".$hora.":".$minu." ".$ampm." TIENE CITA CON ENFERMERIA DE ".$nomarea;
						else $mensaje="SR@ ".$nomusu." PROINSALUD SA LE RECUERDA QUE EL ".$fec." A LAS ".$hora.":".$minu." ".$ampm." TIENE CITA CON EL DR@ ".$nommedi." DE ".$nomarea;
						
						$largo=strlen($mensaje);
						ECHO "
						<tr>
						<td align=center>$n</td>
						<td>$cedusu</td>
						<td>$nomusu</td>
						<td>$tel1</td>
						<td>$tel2</td>
						<td>$dupli</td>
						<td>$fechacita</td>
						<td>$horacita</td>
						<td>$nommedico</td>
						<td>$mensaje</td>
						<td>$largo</td>
						</tr>";
					}
				}
				$codusuario=$codi_usu;
			}
		}
		else
		{
			echo"<table align=center class='tbl' width=40%>
			<tr>
			<th>NO SE ENCONTRARON RESULTADOS</th>
			</tr>
			</table>";
		}
	}	
	
	
    echo"</form>";
?>
</body>
</html>