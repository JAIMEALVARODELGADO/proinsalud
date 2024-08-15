<link rel="stylesheet" href="css/style.css" type="text/css" />
 
<?php
	
		include('php/conexion.php');
		include('php/funciones.php');
		function tiempoTranscurrido($horaini, $horafin)
			{
				/*$horaini = "08:00:00";
				$horafin = "09:40:00";*/
			
				$hini = explode(":",$horaini);
				$hfin = explode(":",$horafin);
				$horaInicio = mktime($hini[0],$hini[1],$hini[2],0,0,0); //hora, minutos, segundos, mes, dia, año
				
				$horaFin = mktime($hfin[0],$hfin[1],$hfin[2],0,0,0);
				$minutos = abs(($horaInicio - $horaFin)/60); 
				//echo $minutos;
				return $minutos;
			
			}
		echo"<table align='center' width=70%>";
		echo"<tr><th class=Th0 align='center' colspan=5><STRONG>INFORME DE POR EXAMENES</strong></td></tr>";
		
		
                $conspro="SELECT encabezado_labs.fchr_labs, encabezado_labs.fche_labs, encabezado_labs.hrar_labs, 
                encabezado_labs.hrae_labs, detalle_labs.nord_dlab, cups.descrip, detalle_labs.fech_dlab,detalle_labs.hora_dlab,
                encabezado_labs.fchr_labs, detalle_labs.estd_dlab, cups.codigo, detalle_labs.hora_dlab,  detalle_labs.obsv_dlab
                FROM (detalle_labs INNER JOIN encabezado_labs ON detalle_labs.iden_labs = encabezado_labs.iden_labs)
                INNER JOIN cups ON detalle_labs.codigo = cups.codigo
                WHERE (encabezado_labs.fchr_labs >= '$fecini_')AND (encabezado_labs.fchr_labs <= '$fecfin_')AND (cups.codigo = '$cod_')
                ORDER BY detalle_labs.estd_dlab";
                
                
                $consulpro=mysql_query($conspro);
                $total=mysql_num_rows($consulpro);
               
                
                echo"<tr><th class=Th0 align='left' colspan=5><STRONG>TOTAL DE EXAMENES:<font color=red size=2>$total</font></strong></td></tr>";		           
                echo"</table>";
                
                
                echo"<br><table align='center' width=70% border=1 >
		<tr>  
                <th class='Th0'>FECHA RECEPCION</th>
				<th class='Th0'>HORA RECEPCION</th>
				<th class='Th0'>FECHA ENTREGA</th>
				<th class='Th0'>HORA ENTREGA</th>
				<th class='Th0'>DURACION</th>
				<th class='Th0'>ORDEN</th>
				<th class='Th0'>EXAMEN</th>
				<th class='Th0'>RESULTADO</th>
				<th class='Th0'>ESTADO</th>
		</tr>";
                
               // echo $conspro.''.$cod_cir;
		
		if(mysql_num_rows($consulpro))
		{
			 while($rowcon=mysql_fetch_array($consulpro))
			  {
				  
                                  
                                  echo"<td>$rowcon[fchr_labs]</td>";
								  $feci=$rowcon[fchr_labs];
								  echo"<td>$rowcon[hrar_labs]</td>";
								  $horai=$rowcon[hrar_labs];
								  echo"<td>$rowcon[fech_dlab]</td>";
								  $fecf=$rowcon[fech_dlab];
								  echo"<td>$rowcon[hora_dlab]</td>";
								  $horaf=$rowcon[hora_dlab];
								  
								  $hi=substr($horai,0,2);
								  $mi=substr($horai,3,2);
								  $si=substr($horai,6,2);
								  $mei=substr($feci,5,2);
								  $di=substr($feci,8,2);
								  $ai=substr($feci,0,4);
								  //echo $hi.' '.$mi.' '.$si.' '.$mei.' '.$di.' '.$ai;
								  $numero1= gmmktime ( $hi, $mi, $si, $mei, $di, $ai);
								  //echo $numero1;
								  $hf=substr($horaf,0,2);
								  $mf=substr($horaf,3,2);
								  $sf=substr($horaf,6,2);
								  $mef=substr($fecf,5,2);
								  $df=substr($fecf,8,2);
								  $af=substr($fecf,0,4);
								  $numero2= gmmktime ( $hf, $mf, $sf, $mef, $df, $af);
								  //echo $numero2;
								  $minutos=(($numero2-$numero1)/60);
								  $minutos=$minutos/60;
								  $horas=explode(".",$minutos);
								  $horas=$horas[0];
								  $hm=($minutos-$horas)*60;
								 

								  echo"<td>$horas h $hm m</td>";
                                  echo"<td>$rowcon[nord_dlab]</td>";
                                  echo"<td>$rowcon[descrip]</td>";
                                  echo"<td>$rowcon[obsv_dlab]</td>";
                                  echo"<td>$rowcon[estd_dlab]</td>";
				  echo"</tr>";

			  }
			  
			  /*echo "<tr><td class='Td2' colspan=2 align='center'><br><br><b><font color=#3300FF>Los Archivos debe bajarse en Formato .txt</font></td></tr><tr><td class='Td2' width='10%' align='right'><a href='".$archivo."'><img hspace='8' width='20' height='20' src='imagenes\feed_disk.png' alt='Generar Archivo' border=0></a></td>
			  <td class='Td2' width='90%' align='left'><a href='".$archivo."'><font color=#3300FF>ARCHIVO DE PROCEDIMIENTOS</font></a></td><tr>";  */

		}
			echo "</table>";
			
	echo"<input type=hidden name='control' value=$control>";
	?>

</form>

</body>
</html>
