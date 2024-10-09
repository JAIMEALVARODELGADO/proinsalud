<?
session_start();
$usucitas=$_SESSION['usucitas'];  
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 
$dateh=date("Y-m-d");
$hora1=date("H-m-s");
// 192.168.4.20/intraweb/intranet/nuevocitas/info_reprogramadas.php
include ("php/conexion1.php");
set_time_limit (0);
?>
<html>
<head>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />  
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
	
	function generar()
	{
		uno.action='info_reprogramadas.php';
		uno.target='';
		uno.submit();
	}
	
	
</script>
</head>
<body>
	<form name="uno" method="post">

    
    
   

        <br>
        <br>
        <center><table class='tbl' align="center">
        <tr>
        <th>FECHA INICIAL</th>
        <td align=center>
        
        <input type="text" name="fechaini" class='caja' size="10" maxlength="10" value="<?echo $fechaini;?>" id="fini" <?echo $disp;?>>
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
        <input type="text" name="fechafin" class='caja' size="10" maxlength="10" value="<?echo $fechafin;?>" id="ffin" <?echo $disp;?>>
        <input type="button" class='caja' id="lanzador2" name="bot2" value="..." <?echo $disp;?>/>
        <!-- script que define y configura el calendario--> 
        <script type="text/javascript"> 
        Calendar.setup({ 
        inputField     :    "ffin",     // id del campo de texto 
        ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
        button     :    "lanzador2"     // el id del botn que lanzar el calendario 				
        }); 
        </script>
		</td>
		</tr>
		<tr>
		<td colspan="4" align="center"><input type="button" class="boton" value="Generar" onclick="generar()">
		</td></tr> 	
        </table>
		</center>
        <br>
		<?
		$n=1;
		if($fechaini!='' && $fechafin!='')
		{
			echo  "<table class='tbl' width='100%'>
			<tr>
			<th>No.</th>
			<th>NUM DOCUMENTO</th>
			<th>NOMBRE PACIENTE</th>
			<th>FECHA CITA</th>
			<th>FECHA DE CANCELACION</th>
			<th>FECHA NUEVA CITA</th>
			<th>FECHA ASIGNACION </th>
			<th>AREA</th>
			<th>MEDICO CITA CANCELADA</th>
			<th>MEDICO REPROGRAMACION</th>
			<th>TIPO DE CANCELACION</th>
			</tr>";
			
			$bfecdis=mysql_query("SELECT citas.Clase_citas, citas.Idusu_citas, vitacora.cserv_horario, vitacora.cmed_horario, vitacora.fecha_horario, 
			vitacora.hora_horario, vitacora.Fopera_Vitaco, vitacora.Hopera_Vitaco, vitacora.Operacio_Vitaco, citas.id_cita
			FROM citas INNER JOIN vitacora ON citas.id_cita = vitacora.Codci_Vitaco
			WHERE (((citas.Clase_citas)>='6') AND ((vitacora.Fopera_Vitaco)>='$fechaini' And (vitacora.Fopera_Vitaco)<='$fechafin') 
			AND ((vitacora.Operacio_Vitaco)='DELETE'))");
			/*
			echo "SELECT citas.Clase_citas, citas.Idusu_citas, vitacora.cserv_horario, vitacora.cmed_horario, vitacora.fecha_horario, 
			vitacora.hora_horario, vitacora.Fopera_Vitaco, vitacora.Hopera_Vitaco
			FROM citas INNER JOIN vitacora ON citas.id_cita = vitacora.Codci_Vitaco
			WHERE (((citas.Clase_citas)>='6') AND ((vitacora.Fopera_Vitaco)>='$fechaini') AND ((vitacora.Fopera_Vitaco)<='$fechafin'))";
			*/
			
			while($rfdis=mysql_fetch_array($bfecdis))
			{	
				$id_cita=$rfdis['id_cita'];
				$Clase_citas=$rfdis['Clase_citas'];
				$Idusu_citas=$rfdis['Idusu_citas'];
				$cserv_horario=$rfdis['cserv_horario'];
				$cmed_horario=$rfdis['cmed_horario'];
				$fecha_horario=$rfdis['fecha_horario'];
				$hora_horario=$rfdis['hora_horario'];
				$Fopera_Vitaco=$rfdis['Fopera_Vitaco'];
				$Hopera_Vitaco=$rfdis['Hopera_Vitaco'];
				
				$fechasig=date("Y-m-d",strtotime($Fopera_Vitaco."+ 15 days"));

				$bsig=mysql_query("SELECT vitacora.Fopera_Vitaco, vitacora.cmed_horario, vitacora.fecha_horario, citas.id_cita, vitacora.fecha_horario, citas.Fsolusu_citas
				FROM citas INNER JOIN vitacora ON citas.id_cita = vitacora.Codci_Vitaco
				WHERE (((vitacora.fecha_horario)>='$Fopera_Vitaco' And (vitacora.fecha_horario)<='$fechasig') AND ((citas.id_cita)>'$id_cita') AND 
				((citas.Clase_citas)<'6') AND ((citas.Idusu_citas)='$Idusu_citas') AND ((vitacora.cserv_horario)='$cserv_horario') AND 
				((vitacora.fecha_horario)=vitacora.Fopera_Vitaco) AND ((vitacora.Operacio_Vitaco)='Create_Cit'))
				ORDER BY vitacora.Fopera_Vitaco DESC");
				$fsol_nuevacita='';
				$med_nuevacita='';
				$fec_nuevacita='';
				$Fsolusu_citas='';
				while($rsig=mysql_fetch_array($bsig))
				{	
					$fsol_nuevacita=$rsig['Fopera_Vitaco'];
					$med_nuevacita=$rsig['cmed_horario'];
					$fec_nuevacita=$rsig['fecha_horario'];
					$Fsolusu_citas=$rsig['Fsolusu_citas'];
				}
				if($fec_nuevacita!='')
				{
					$busu=mysql_query("SELECT * FROM `usuario` WHERE `CODI_USU` = '$Idusu_citas'");
					$row=mysql_fetch_array($busu);
					$cedula=$row['NROD_USU'];
					$nomusu=$row['PNOM_USU'].' '.$row['SNOM_USU'].' '.$row['PAPE_USU'].' '.$row['SAPE_USU'];
					$bmedico=mysql_query("SELECT * FROM `medicos` WHERE `cod_medi` = '$cmed_horario'");
					$row=mysql_fetch_array($bmedico);
					$nommedi1=$row['nom_medi'];
					$barea=mysql_query("SELECT * FROM `areas` WHERE `cod_areas` = '$cserv_horario'");
					$row=mysql_fetch_array($barea);
					$nomarea=$row['nom_areas'];
					$bmedico2=mysql_query("SELECT * FROM `medicos` WHERE `cod_medi` = '$med_nuevacita'");
					$row=mysql_fetch_array($bmedico2);
					$nommedi2=$row['nom_medi'];
					
					$btcita=mysql_query("SELECT * FROM `tip_cita` WHERE `cod_ticita` = '$Clase_citas'");
					$row=mysql_fetch_array($btcita);
					$nclase_cita=$row['des_ticita'];
					
					
					
					echo"
					<tr>
					<td>$n</td>
					<td>$cedula</td>
					<td>$nomusu</td>
					<td>$fecha_horario</td>
					<td>$Fopera_Vitaco</td>
					<td>$fec_nuevacita</td>
					<td>$fsol_nuevacita</td>
					
					<td>$nomarea</td>
					<td>$nommedi1</td>
					<td>$nommedi2</td>
					<td>$nclase_cita</td>
					</tr>";
					$n++;
				}
			}
			echo "</table>";
		}
		$hora2=date("H-m-s");

			echo "inicio ".$hora1." - fin ".$hora2;
				
	
?>
</form>
</body>
</html>