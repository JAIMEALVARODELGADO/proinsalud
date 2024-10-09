<HTML>
<HEAD>
 <link rel="stylesheet" href="style.css" type="text/css"/>
    <script languaje=havascript>
    function cambio()
	{
		uno.action='calendario.php';
		uno.submit();
	}
	function valida(a,m)
	{
		
		for(i=0;i<a;i++)
		{
			
			re='uno.ndispo'+i+'.value';
			po='uno.canres'+i+'.value';
			fo='uno.canres'+i+'.focus()';			
			if(eval(re)<eval(po))
			{
				alert('ERROR');
				eval(fo);
				return;
			}
			if(eval(po)=='' || eval(po)=='0')
			{
				alert('ERROR');
				eval(fo);
				return;
			}				
		}		
		uno.action='calendario.php';
		uno.submit();		
	}
	function borrar(cu)
	{
		num=uno.cont.value;
		if(cu < num)
		{		
			for(i=cu;i<num;i++)
			{
				z=i/1+1/1;
				de='uno.vecdia'+i+'.value=uno.vecdia'+z+'.value';
				eval(de);	
				disp='uno.ndispo'+i+'.value=uno.ndispo'+z+'.value';
				eval(disp);	
				reser='uno.canres'+i+'.value=uno.canres'+z+'.value';
				eval(reser);	
				serv='uno.servi'+i+'.value=uno.servi'+z+'.value';
				eval(serv);					
			}
		}		
		uno.cont.value=uno.cont.value/1-1/1;
		uno.action='calendario.php';
		uno.submit();
	
	}
	
	function calen(dia, dispo)
	{
		
		if(dia<10)dia='0'+dia
		uno.fechaele.value=uno.ano.value+'-'+uno.mes.value+'-'+dia;
		co=uno.cont.value;
		ref='uno.vecdia'+co+'.value=uno.fechaele.value';
		eval(ref);
		dis='uno.ndispo'+co+'.value=dispo';
		eval(dis);
		
		ser='uno.servi'+co+'.value=uno.servicio.value';
		eval(ser);
		
		uno.cont.value=uno.cont.value/1+1/1;
		uno.target='';
		uno.action='calendario.php';
		uno.submit();
	}
	
	
	
    </script>
</HEAD>
<BODY background='imagenes/fondo.PNG'>
<?
	if(empty($muestra))$muestra=0;	
	$link=Mysql_connect("localhost","root","VJvj321");
	if(!$link)echo"no hay conexion";	
	Mysql_select_db('proinsalud',$link);	
    echo"	
	<FORM NAME=uno METHOD=POST ACTION=par_tarifas1.php target=uno>";
	
	$fecha=date('Y-m-d');	
	if(empty($mes))$mes=(date("m"));
	if(empty($ano))$ano=(date("Y"));	
	$num=mktime(0,0,0,$mes,1,$ano);
	$pridia=(date("w",$num));
	$numdias=(date("t",$num));
	
	echo"		
	<td>
	<table class='tbl' align=center>
	<input type=hidden name=servicio value=$servicio>	
	<input type=hidden name=cedula value='$cedula' >
	<tr>";
   // echo"<td  align=center height=40>M</td>";
	echo"<td align=center colspan=4>
	<select name=mes onChange='cambio()'>";
	if($mes=='01') echo"<option value='01' selected>Enero</option>";
	else echo"<option value='01'>Enero</option>";
	if($mes=='02') echo"<option value='02' selected>Febrero</option>";
	else echo"<option value='02'>Febrero</option>";
	if($mes=='03') echo"<option value='03' selected>Marzo</option>";
	else echo"<option value='03'>Marzo</option>";
	if($mes=='04') echo"<option value='04' selected>Abril</option>";
	else echo"<option value='04'>Abril</option>";
	if($mes=='05') echo"<option value='05' selected>Mayo</option>";
	else echo"<option value='05'>Mayo</option>";
	if($mes=='06') echo"<option value='06' selected>Junio</option>";
	else echo"<option value='06'>Junio</option>";
	if($mes=='07') echo"<option value='07' selected>Julio</option>";
	else echo"<option value='07'>Julio</option>";
	if($mes=='08') echo"<option value='08' selected>Agosto</option>";
	else echo"<option value='08'>Agosto</option>";
	if($mes=='09') echo"<option value='09' selected>Septiembre</option>";
	else echo"<option value='09'>Septiembre</option>";
	if($mes=='10') echo"<option value='10' selected>Octubre</option>";
	else echo"<option value='10'>Octubre</option>";
	if($mes=='11') echo"<option value='11' selected>Noviembre</option>";
	else echo"<option value='11'>Noviembre</option>";
	if($mes=='12') echo"<option value='12' selected>Diciembre</option>";	
	else echo"<option value='12'>Diciembre</option>";	
	echo"</select>
	</td>";
	$an=(date("Y"));
	$ano1=$an+1;
	$ano2=$an+2;
	//echo"<td  align=center height=40>A</td>";
	echo"<td align=center colspan=3>
	<select name=ano onChange='cambio()'>";
	if($ano==$an)echo"<option value='$an' selected>$an</option>";
	else echo"<option value='$an'>$an</option>";
	if($ano==$ano1)echo"<option value='$ano1' selected>$ano1</option>";
	else echo"<option value='$ano1'>$ano1</option>";
	if($ano==$ano2)echo"<option value='$ano2' selected>$ano2</option>";
	else echo"<option value='$ano2'>$ano2</option>";	
	echo"</select>
	</td>
	</tr>
	<tr>
	<td>L</td>
	<td>M</td>
	<td>M</td>
	<td>J</td>
	<td>V</td>
	<td bgcolor>S</td>
	<td>D</td>
	</tr>";
	if($pridia==0)$pridia=7;
	$pridia=$pridia+1;
	echo $pridia;
	$nd=$pridia+$numdias;
	echo"<tr>";
	$k=1;
	for($i=1;$i<=$nd;$i++)
	{
		if($k>$numdias)break;
		if($i<$pridia-1)
		{
			echo"<td></td>";			
		}		
		else
		{				
			if($k<10)$di=$ano.'-'.$mes.'-0'.$k;
			else $di=$ano.'-'.$mes.'-'.$k;
			$bdi=mysql_query("SELECT Count(horarios.Cmed_horario) AS cuentadis
			FROM citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario
			WHERE (((horarios.Fecha_horario)='$dia') AND ((horarios.Usado_horario)='0') AND ((horarios.Cmed_horario)='$medico'))");			
			
			while($ndispo=mysql_fetch_array($bdi))
			{
				$cuentadispo=$ndispo['cuentadis'];
				
			}		
			
			if($di>=$fecha)
			{
				if($cuentadispo>0)
				{				
					$dispon=$cuentaserv-$cuentadispo;
					if((($pridia+$k-1)%(7)==0) || (($pridia+$k-2)%(7)==0))
					{
						$color=0;
						for($j=0;$j<=$cont;$j++)
						{
							$nomvar='vecdia'.$j;
							$fe=$$nomvar;
							$nomvar='servi'.$j;
							$ser=$$nomvar;
							if($fe==$di && $servicio==$ser)$color=1;							
						}							
						if($color==1)								
						{
							echo"<td align=center bgcolor='#FAFF9E'><font color='#FF0000'>$k</td>";
						}
						else
						{
							echo"<td align=center><a href='#' onclick='calen($k,$dispon)'><font color='#FF0000'>$k</a></td>";
						}						
					}
					else
					{
						$color=0;
						for($j=0;$j<=$cont;$j++)
						{
							$nomvar='vecdia'.$j;
							$fe=$$nomvar;
							$nomvar='servi'.$j;
							$ser=$$nomvar;
							if($fe==$di && $servicio==$ser)$color=1;
						}	
						if($color==1)
						{
							echo"<td align=center bgcolor='#FAFF9E'><font color='#0000FF'>$k</td>";
						}
						else
						{
							echo"<td align=center><a href='#' onclick='calen($k,$dispon)'><font color='#0000FF'>$k</a></td>";
						}													
					}
				}
				else
				{				
					echo"<td align=center><font color='#999999' size='2'>$k</td>";
				}
			}
			else
			{				
				echo"<td align=center><font color='#999999' size='2'>$k</td>";
			}
			
			$k++;
		}
		if($i%7==0)
		{
			echo"</tr>";
			echo"<tr>";
		}
	}
	echo"</table><br><br>";
	if(empty($cont))$cont=0;
	echo"<table class='tbl' align=center>
	<tr><td>Dia seleccionado</td><td>Servivio</td><td>disponible</td><td>reservas</td><td>quitar</td></tr>";
	for($k=0;$k<=$cont;$k++)
	{
		$nomvar='vecdia'.$k;
		$vecdia=$$nomvar;
		echo"<input type=hidden name=$nomvar value=$vecdia>";
		
		$nomvar='servi'.$k;
		$servi=$$nomvar;
		echo"<input type=hidden name=$nomvar value=$servi>";
		
		$nomvar='ndispo'.$k;
		$ndispo=$$nomvar;			
		echo"<input type=hidden name=$nomvar value=$ndispo>";
		$nomvar='canres'.$k;
		$canres=$$nomvar;			
		echo"<tr align=center>
		<td>$vecdia</td>
		<td>$servi</td>
		<td>$ndispo</td>";
		
		if($k<$cont)
		{
			echo"<td><input type=text size=1 name=$nomvar value=$canres></td>";
			echo"<td align=center><a href='#' onclick='borrar($k)'><img src='imagenes/cerrar.png' border=0 width=15 ></a></td>";
		}
		$nomvar='canres'.$cont;
		echo"</tr>
		
		<input type=hidden name=$nomvar>
		";					
	}	
	echo"<tr><td align=center><input type=button class='boton' value=Aceptar onclick=valida($cont,0)>
	</table>
	<input type=hidden name=fechaele>
	<input type=hidden name=cont value=$cont>
	
	
    </FORM>";
?>
</BODY>
</HTML>
