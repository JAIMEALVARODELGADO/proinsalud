<?
session_start();
$usucitas=$_SESSION['usucitas'];  


$usucitas='30738865';

?>
<html>
<head>

<script language="javascript">

	function salir()
	{
		uno.target='';
		uno.action='crea_agenmed0.php';
		uno.submit();
	}
	
	
</script>
</head>
<body onload='salir()'>

<?	
	/*		
	if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }	
	*/
	echo $accion.'<br>';
	$usucitas='3';
	echo"<form name=uno method=post>
	<input type=hidden name=areasel value='$areasel'>
	<input type=hidden name=medico value='$medico'>
	
	<input type=hidden name=anno value='$anno'>
	<input type=hidden name=mes value='$mes'>
	<input type=hidden name=areamun value='$areamun'>
	";
	
	include ('php/conexion1.php');
	$dateh=date("Y-m-d");
	
	if($accion==1) //editar
	{
		$horai=$hini1.':'.$mini1.':00';
		$horaf=$hfin1.':'.$mfin1.':00';
		
		$upd=mysql_query("UPDATE `horarios_agenda_med` SET `estado`='IN' WHERE `idenagen`='$idencam'");
		$ins=mysql_query("INSERT INTO `horarios_agenda_med` (`idenagen` ,`area` ,`medico` ,`hora_ini` ,`hora_fin` ,`intervalo` ,`pacxturno` ,`lun` ,`mar` ,`mie` ,`jue` ,`vie` ,`sab` ,`dom` ,`intervasem` ,`observacion` ,`direccion` ,`fvenci` ,`estado` ,`fcreacion` ,`usuario`)
		VALUES ('0', '$areasel', '$medico', '$horai','$horaf','$inter1','$pacxtur1','$lun1','$mar1','$mie1','$jue1','$vie1','$sab1','$dom1','$intersem1','$obse1','$direc1','$fechaven1', 'AC', '$dateh','$usucitas')");
	}
	if($accion==2) //nuevo
	{
		$horai=$hini.':'.$mini.':00';
		$horaf=$hfin.':'.$mfin.':00';
		$ins=mysql_query("INSERT INTO `horarios_agenda_med` (`idenagen` ,`area` ,`medico` ,`hora_ini` ,`hora_fin` ,`intervalo` ,`pacxturno` ,`lun` ,`mar` ,`mie` ,`jue` ,`vie` ,`sab` ,`dom` ,`intervasem` ,`observacion` ,`direccion` ,`fvenci` ,`estado` ,`fcreacion` ,`usuario`)
		VALUES ( '0', '$areasel', '$medico', '$horai','$horaf','$inter','$pacxtur','$lun','$mar','$mie','$jue','$vie','$sab','$dom','$intersem','$obse','$direc','$fechaven', 'AC', '$dateh','$usucitas')");
		
	}
	if($accion==3) //Eliminar
	{
		$upd=mysql_query("UPDATE `horarios_agenda_med` SET `estado`='EL', `usuario`='$usucitas' WHERE `idenagen`='$idencam'");
	}
	if($accion==4) //Eliminar
	{
		for($i=0;$i<$item;$i++)
		{
			$nomvar='identur'.$i;
			$identur=$$nomvar;
			$nomvar='turnos'.$i;
			$turnos=$$nomvar;
			$bt=mysql_query("select * from horarios_turnos_med  where cod_ar='$identur'");
			if(mysql_num_rows($bt)==0)
			{
				$in=mysql_query("insert into horarios_turnos_med (iden_mun, cod_ar, turnos) values ('0','$identur','$turnos')");
			}
			else
			{
				$upd=mysql_query("UPDATE `horarios_turnos_med` SET `turnos`='$turnos' WHERE `cod_ar`='$identur'");
			}		
		}
	
	}
	if($accion==5)
	{
		/*
		$ndias	//numero dias mes
		$nomvar='fechah'.$i; //fecha de creacion de horario
		$nomvar='horah'.$i.'-'.$n; //hora de creacion de horario
		$nomvar='check'.$i.'-'.$n; //confirmacion creacion horario (1=crear vacio=no crear)
		$areamun //area de creacion horario
		$medico	// medico de creacion de horario
		$nomvar='finturno'.$i; //numero de turnos por dias
		*/
		
		for($i=1;$i<=$ndias;$i++)
		{
			$nomvar='fechah'.$i;
			$fechah=$$nomvar;
			$nomvar='finturno'.$i;
			$finturno=$$nomvar;
			$nomvar='pacxturno'.$i;
			$pacxturno=$$nomvar;
			$nomvar='diasem'.$i;
			$diasem=$$nomvar;
			for($n=0;$n<$finturno;$n++)
			{
				$nomvar='horah'.$i.'-'.$n;
				$horah=$$nomvar;
				$nomvar='check'.$i.'-'.$n;
				$check=$$nomvar;
				
				
				
				
				if($check==1)
                {					
                       
					$cadexiste="select * from horarios where Cmed_horario='$medico' and Fecha_horario='$fechah' and Hora_horario='$horah'";
					//ECHO '<br>'.$cadexiste;
					$existe=Mysql_query($cadexiste);
					$numexis=Mysql_num_rows($existe);
					$horcit=substr($horah,11,5);
					if($numexis==0)
					{
						$numhor='';
						
						$feccrea=date("Y-m-d");
						$horcrea=date("H:i");

						$resulinser=Mysql_query("INSERT INTO `horarios` (`Cmed_horario` , `Cserv_horario` , `Fecha_horario` , `Hora_horario` , `Usado_horario` , `dia_horario` , `ID_horario` , `ncita_horario` , `oper_horario` ) 
						VALUES ('$medico','$areamun','$fechah','$horah','$pacxturno','$diasem','0','$pacxturno','$usucitas')");
						if(!resulinser)$estado='NO CREADO';
						$numhor=mysql_insert_id();
						
						$insegui=mysql_query("insert into horario_seguimiento (id, idhorario, mediage, areaage, fecage, horage, feccrea, horcrea, usuacrea)
						values ('0','$numhor','$medico','$areamun','$fechah','$horah','$feccrea','$horcrea','$usucitas')");
						
						$regcreados[$n][0]=$numhor;
						$regcreados[$n][1]=$medico;
						$regcreados[$n][2]=$nommed;
						$regcreados[$n][3]=$nomare;
						$regcreados[$n][4]=$fechah;
						$regcreados[$n][5]=$horcit;
						$regcreados[$n][6]=$diasem;
						$regcreados[$n][7]=$ncitados;
						$regcreados[$n][8]='CREADO';							

					}
					else
					{
						$regcreados[$n][0]='';
						$regcreados[$n][1]=$medico;
						$regcreados[$n][2]=$nommed;
						$regcreados[$n][3]=$nomare;
						$regcreados[$n][4]=$fechah;
						$regcreados[$n][5]=$horcit;
						$regcreados[$n][6]=$diasem;
						$regcreados[$n][7]=$ncitados;
						$regcreados[$n][8]='NO CREADO HORARIO YA EXISTE';		
					}

					$n=$n+1;
				}
				
			}
			
		}		
		
	}
	
	
	if($accion==6) //Modificar area de horario
	{
		
		
		$upd=mysql_query("UPDATE `horarios` SET `Cserv_horario`='$nuevarea' WHERE `ID_horario`='$numhor'");
		
		//echo "UPDATE `horarios` SET `Cserv_horario`='$nuevarea' WHERE `ID_horario`='$numhor'";
					
		
	
	}
	
	
	echo"</form>";
?>
</body>
</html>