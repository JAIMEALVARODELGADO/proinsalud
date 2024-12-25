<?php
//include ("php/conexion1.php");



function genCita($dias, $IDPaciente, $IDMedico, $IDServicio, $funcionario_pen, $Tusua_citas, $cotra_citas,$tiproxi,$municipio )
{// valida si alguien pulso el boton buscar

	include ("php/conexion1.php");

    $diferenciaDia = $dias - 8;// Diferencia de dia
	$fecha=time();
	$fechaActual=date ("Y-m-d",$fecha);//Fecha actual de sistema
	$horaActual =date('Y-m-d h:i:s a', time());//Hora actual de sistema
	$fechaEstimada=date("Y-m-d",strtotime($fechaActual."+ ".$diferenciaDia." days"));// Calculo de la fecha estimada, sumando la fecha actual más los dias determinados por el funcionario
	if($tiproxi=='0')
	{
		$valorpasa = 'FE'.$fechaActual;		
		return $valorpasa;
		
	}
	if($tiproxi=='1')
	{
	
		$sql= "SELECT dia FROM festivos WHERE dia='$fechaEstimada'";// SQL de insercion de consulta sobre fecha si es dia festivo o habil 	
		$consulta = mysql_query($sql);//ejecuta la consulta
		if (!$consulta) 
		{// pregunta si la consulta fallo
			echo 'No se logro ejecutar';
		}
		else 
		{
			//echo 'Se ejecuto correctamente';
			$j =0;   
			$i =0;
			while($j<=0)
			{
				while ($i <= 0)
				{
					//Procedimiento en el cual compara si la fecha estimada existe en la tabla festivos, en caso positivo aumenta un dia, por el contrario deja la fecha estimada tal cual
					$resultado=mysql_query("SELECT EXISTS (SELECT dia FROM festivos WHERE dia='$fechaEstimada');");
					$row=mysql_fetch_row($resultado);
					if ($row[0]=="1")
					{     
						$fechaEstimada=date("Y-m-d",strtotime($fechaEstimada."+ 1 days"));
					}
					else
					{
						//echo ("La fecha estimada es ");
						//echo $fechaEstimada;
						$i=1;         
					}
				}
				//$area='80';//$medico='13011947';
				//Procedimiento en el cual consulta de la tabla horarios si hay agenda disponible segun la fecha estimada
				$resultado=mysql_query("SELECT ID_horario, Hora_horario FROM horarios WHERE Fecha_horario='$fechaEstimada' AND Usado_horario>0 AND Cserv_horario='$IDServicio' AND Cmed_horario='$IDMedico'");
				$row=mysql_fetch_array($resultado);
				$idhorario=$row['ID_horario'];
				//Si hay diponibilidad en esa agenda actualiza el contador de horario reduciendolo
				if (!empty($row[0]) && $municipio=='52001')
				{    
					$dateTime2 = $fechaEstimada;
					$resultado=mysql_query("UPDATE horarios SET Usado_horario=Usado_horario-1 WHERE ID_horario='$idhorario' LIMIT 1;");
					$j=1;
					//echo ("La fecha para la cita de laboratorio es para: ");
					//echo$fechaEstimada;
					$resultado=mysql_query("INSERT INTO citas (ID_horario, Idusu_citas, Tusua_citas, Cotra_citas, Clase_citas, 
					Fsolusu_citas, Esta_cita, Hora_cita, bono_cita, REF, consul_cita, esta_tri, rips_citas, numc_adx, prog_citas, 
					iden_dre, 	conc_cita, obse_cita, primera_cita, usucamestado_citas,	tipo_consulta,	paciente_covid,	dosis_vacuna) 
					values ($idhorario, $IDPaciente, '$Tusua_citas', '$cotra_citas', '1','$fechaActual','1','$horaActual', '', '', '', 
					'P', NULL , NULL , '', '','0', '', '', NULL, 'P','E101', NULL)");
					
					$idCita=mysql_insert_id();
					$valorpasa = 'ID'.$idCita;
					return $valorpasa;
				}
				//En caso negativo suma un dia, adicionalmente pregunta si el dia adicionado es mayor al umbral de 4 dias antes de la cita de control, en caso positivo la cita es pendiente y datos se guardan en citas pendientes y citas pendientes deta, en caso contario retorna fecha estimada mas 1 dia
				else
				{
					$fechaEstimada=date("Y-m-d",strtotime($fechaEstimada."+ 1 days"));
					$fechaMaxima=date("Y-m-d",strtotime($fechaActual."+". $dias." days"));
					$fechaMaxima2=date("Y-m-d",strtotime($fechaMaxima."- 4 days")); 
					if ($fechaEstimada>$fechaMaxima2) 
					{
						$valorpasa = 'FE'.$fechaEstimada;						
						$resultado=mysql_query("INSERT INTO citas_pendientes (fecha_pen, hora_pen, paciente_pen, contrato_pen, medico_pen, area_pen, tipo_pen, areatrabajo_pen, funcionario_pen, iden_dre, esta_pen, obse_pen, fechaEstimada) values ('$fechaActual', '00:00', '$IDPaciente', '002', '$IDMedico','$IDServicio','O', '5801', ' $funcionario_pen',NULL,'A',NULL , '$fechaEstimada') ; ");
						$resultado=mysql_query("SET @iden_pen := 0;");
						$resultado=mysql_query(" SELECT @iden_pen :=LAST_INSERT_ID();");
						$resultado=mysql_query("INSERT INTO citas_pendientes_deta (iden_pen, fecha_pende, hora_pende, tipo_pende, funcionario_pende ) values ( @iden_pen, '$fechaActual','$horaActual', '0', '$funcionario_pen');");
						$miConsulta = mysql_query($conexion,$resultado);
						$j=1;
						return $valorpasa;
					}
					else
					{
						$j=0;
					}
				   
				}
			}               
		}
	}
}
function dif_fechas($fec1,$fec2)
{
	$dif=0;
	$fechasig=$fec1;
	while($fechasig!=$fec2)
	{
		$fechasig=date("Y-m-d",strtotime($fechasig."+ 1 days"));	
		$diasem= date('w', strtotime($fechasig));
		if($diasem!=0)$dif++;
	}	
	echo 'diferencia '.$dif;
	include ("php/conexion1.php");
	$bfes= mysql_query("SELECT Count(festivos_fias.fecha_festivo) AS CuentaDedia
	FROM festivos_fias
	WHERE (((festivos_fias.fecha_festivo)>='$fec1' And (festivos_fias.fecha_festivo)<='$fec2'))");
	$rfes=mysql_fetch_array($bfes);
	$ndiasfestivos=$rfes['CuentaDedia'];
	echo 'ndiasfestivos '.$ndiasfestivos;
	//return "$ndiasfestivos";
}
?>