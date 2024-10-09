<?
    session_start();
    $usucitas=$_SESSION['usucitas'];
?>
<HTML>
<HEAD>
<link rel="stylesheet" href="style.css" type="text/css"/>
<TITLE>res_genho.php</TITLE>
<SCRIPT LANGUAGE=JavaScript>  
</SCRIPT>
</HEAD>
<BODY>
<form name="US_Add"  action="ver_hor.php">
<?	
    if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
    include ('php/conexion1.php');
    foreach($_POST as $nombre_campo => $valor)
    { 
        $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
        eval($asignacion); 
    } 
    $n=1;	

    $busarea=mysql_query("select * from areas where cod_areas='$areasel'");
    while($rare=mysql_fetch_array($busarea))
    {
        $nomare=$rare['nom_areas'];
    }
    $feccrea=date("Y-m-d");
	$horcrea=date("H:i");
    for($i=1;$i<$finmed;$i++)
    {
        $nomvar='selec'.$i;
        $selec=$$nomvar;
        $nomvar='codmedi'.$i;
        $medico=$$nomvar;		
        if($selec==1)
        {
            $busmed=mysql_query("select * from medicos where cod_medi='$medico'");
            while($rmed=mysql_fetch_array($busmed))
            {
                    $nommed=$rmed['nom_medi'];
            }
           
            $anoini=substr($fechaini,0,4);
            $mesini=substr($fechaini,5,2);
            $diaini=substr($fechaini,8,2);
            $anofin=substr($fechafin,0,4);
            $mesfin=substr($fechafin,5,2);
            $diafin=substr($fechafin,8,2);
            $valfecini=$anoini.'-'.$mesini.'-'.$diaini;
            $valfecfin=$anofin.'-'.$mesfin.'-'.$diafin;
            $valhoraini=$anoini.'-'.$mesini.'-'.$diaini.' '.$horaini.':'.$minuini.':'.'00';
            $valhorafin=$anofin.'-'.$mesfin.'-'.$diafin.' '.$horafin.':'.$minufin.':'.'00';
            $dateini = gmmktime ( 00, 00, 00, $mesini, $diaini, $anoini);
            $datefin= gmmktime ( 00, 00, 00, $mesfin, $diafin, $anofin);	
            $diaprog=$dateini;	
            while($diaprog<=$datefin)
            {			
                
                $timeini=$diaprog+($horaini*3600)+($minuini*60);
                $timefin=$diaprog+($horafin*3600)+($minufin*60);		
                $cita=$timeini;
                While($cita<$timefin)
                {				
                    $hora1=gmdate ( "H:i:s", $cita);
                    $hora='0001-01-01 '.$hora1;
                    $fecha=gmdate ( "Y-m-d", $cita);
                    $numdia=gmdate ( "w", $cita);
                    $guarde=0;
                    
                    //echo $dia1.' - '.$dia2.' - '.$dia3.' - '.$dia4.' - '.$dia5.' - '.$dia6.' - '.$dia7.' -- '.$numdia.'<br>';
                    if($dia1==$numdia)
                    {				
                            $diasem="Lunes";
                            $guarde=1;
                    }
                    if($dia2==$numdia)
                    {				
                            $diasem="Martes";
                            $guarde=1;
                    }
                    if($dia3==$numdia)
                    {				
                            $diasem="Mircoles";
                            $guarde=1;
                    }
                    if($dia4==$numdia)
                    {				
                            $diasem="Jueves";
                            $guarde=1;
                    }
                    if($dia5==$numdia)
                    {				
                            $diasem="Viernes";
                            $guarde=1;
                    }
                    if($dia6==$numdia)
                    {				
                            $diasem="Sabado";
                            $guarde=1;
                    }
                    if($dia7==$numdia)
                    {				
                            $diasem="Domingo";
                            $guarde=1;
                    }
                     //echo $diasem.' ';
                    if($guarde==1)
                    {					
                       
                        $cadexiste="select * from horarios where Cmed_horario='$medico' and Fecha_horario='$fecha' and Hora_horario='$hora'";
						//ECHO '<br>'.$cadexiste;
                        $existe=Mysql_query($cadexiste);
                        $numexis=Mysql_num_rows($existe);
                        $horcit=substr($hora,11,5);
                        if($numexis==0)
                        {
                            $numhor='';

                            $resulinser=Mysql_query("INSERT INTO `horarios` (    `Cmed_horario` , `Cserv_horario` , `Fecha_horario` , `Hora_horario` , `Usado_horario` , `dia_horario` , `ID_horario` , `ncita_horario` , `oper_horario` ) 
                            VALUES ('$medico','$areasel','$fecha','$hora','$ncitados','$diasem','0','$ncitados','$usucitas')");
                            if(!resulinser)$estado='NO CREADO';
                            $numhor=mysql_insert_id();
							
							$insegui=mysql_query("insert into horario_seguimiento (id, idhorario, mediage, areaage, fecage, horage, feccrea, horcrea, usuacrea)
							values ('0','$numhor','$medico','$areasel','$fecha','$hora','$feccrea','$horcrea','$usucitas')");
							
                            $regcreados[$n][0]=$numhor;
                            $regcreados[$n][1]=$medico;
                            $regcreados[$n][2]=$nommed;
                            $regcreados[$n][3]=$nomare;
                            $regcreados[$n][4]=$fecha;
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
                            $regcreados[$n][4]=$fecha;
                            $regcreados[$n][5]=$horcit;
                            $regcreados[$n][6]=$diasem;
                            $regcreados[$n][7]=$ncitados;
                            $regcreados[$n][8]='NO CREADO HORARIO YA EXISTE';		
                        }

                        $n=$n+1;
                    }
                    $cita=($intervalo*60)+$cita;				
                }		
                $diaprog=$diaprog+86400;
            }
        }
    }
    $fin=$n;	
    echo"
    <table class='tbl' align=center>
    <tr><th>GENERACION DE HORARIOS</th></tr>
    </TABLE>
    <br>
    <table class='tbl' align=center>";

    if($fin>1)
    {
        echo"<tr>
        <th>REGISTRO</td>
        <th>COD MEDICO</td>
        <th>NOMBRE MEDICO</td>
        <th>AREA</td>
        <th>FECHA</td>
        <th>HORA</td>
        <th>DIA</td>
        <th>CITAS X HORARIO</td>
        <th>OBSERVACION</td>
        </tr>";
        for($n=1;$n<$fin;$n++)
        {

            $reghor=$regcreados[$n][0];
            $codmed=$regcreados[$n][1];
            $nommed=$regcreados[$n][2];
            $nomare=$regcreados[$n][3];
            $fechor=$regcreados[$n][4];
            $horhor=$regcreados[$n][5];
            $diahor=$regcreados[$n][6];
            $ncihor=$regcreados[$n][7];
            $estado=$regcreados[$n][8];
            echo"
            <tr>				
            <td align=center>$reghor</td>
            <td align=center>$codmed</td>
            <td>$nommed</td>
            <td>$nomare</td>
            <td align=center>$fechor</td>
            <td align=center>$horhor</td>
            <td align=center>$diahor</td>
            <td align=center>$ncihor</td>	
            <td>$estado</td>			
            </tr>";				
        }
    }
    else
    {
        echo"<tr>
        <td>NO SE CREARON HORARIOS</th>
        </tr>";		
    }
?>







</form>




</BODY>
</HTML> 