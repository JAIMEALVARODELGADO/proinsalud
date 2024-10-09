<?		
session_register('usucitas');
session_register('Garea');
?>
<html>
<head>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />  
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
	function salto2()
	{
		uno.target='';
		uno.action='elim_horario0.php';
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
		uno.action='elim_horario1.php';
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
		uno.action='elim_horario0.php';
		uno.submit();
	
	}
	
	function calen(dia, m)
	{
		uno.seleccion.value='';
		alert(dia);	
		ref='uno.vecdia.value=uno.fechaele.value';
		eval(ref);		
		uno.target='';
		uno.action='elim_horario0.php';
		uno.submit();
	}
	function calen1(dia, m)
	{
		
		alert(dia);
		uno.cont.value=uno.cont.value/1+1/1;
		uno.fechaele.value=dia;			
		ref='uno.vecdia.value=uno.fechaele.value';
		eval(ref);		
		uno.target='';
		uno.action='elim_horario0.php';
		uno.submit();
	}
	
	
	function busdia(num,hor,usa)
	{
		uno.valusado.value=usa;		
		uno.seleccion.value=num;
		uno.horaele.value=hor;
		uno.target='';
		uno.action='elim_horario0.php';
		uno.submit();
	}
	
</script>
</head>
<body style='position:absolute;margin-top:10'>
<style>
#conte {
overflow:auto;
height: 108px;
width: 600px;
padding:5px;
margin:0 auto;
background-color: #FFFFFF;
font-size: 8px;
}
.margen_izq {
margin-left:10px;
}

 
a{text-decoration:none} 




</style> 
<?	
	//onload="setScrollPos('conte')"
	include ('php/conexion1.php');	
	$busarea=mysql_query("Select cod_areas,nom_areas From areas Order By nom_areas");
	$fecano=date("Y");
	$fecmes=date("m");
	$fecdia=date("d");
	$ffano=$fecano-1;
	$fechlim=$ffano.'-'.$fecmes.'-'.$fecdia;
	$busperm=mysql_query("SELECT permisos_citas.usua_per, areas.perm_are, permisos_citas.serv_per, permisos_citas.esta_per, areas.nom_areas, areas.tipo_areas
	FROM permisos_citas INNER JOIN areas ON permisos_citas.serv_per = areas.cod_areas
	WHERE (((permisos_citas.usua_per)='$usucitas') AND ((permisos_citas.esta_per)='A') AND ((areas.tipo_areas)<>'2'))");	
	echo"<td><table align=center>
	<tr><td>";
	echo"<form name=uno method=post>";
	echo"<input type=hidden name=tipafi value='$tipafi'>";
	echo"<input type=hidden name=codcontra value='$codcontra'>";
	if($areatrabajo!='1')
	{	
		echo"<br><br>
		<table align=center class='tbl' width=100%>
		<tr><th>ELIMINAR HORARIOS</th></tr>
		</table>
		<br>
		<table class='tbl' align=center width=100%>
		<tr>
		<th>AREA</th>
		<th>MEDICO</th>
		</tr>		
		<tr>
		<td align=center><select name=area class='caja' onchange='salto2()'>
		<option value='0'></option>";	
		$n=0;
		while($rareper=mysql_fetch_array($busperm))
		{		
			$codare=$rareper['serv_per'];
			$nomare=$rareper['nom_areas'];
			$permi=$rareper['perm_are'];
			if($permi=='N')
			{			
				if($area==$codare)echo"<option selected value=$codare>$nomare</option>";	
				else echo"<option value=$codare>$nomare</option>";	
			}		
		}
		echo"<select></td>";
		if(empty($area))$area=$codare;
		$bmedi=mysql_query("SELECT medicos.nom_medi, medicos.cod_medi
		FROM medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar
		WHERE (((areas_medic.areas_ar)='$area')) order by medicos.nom_medi");
			echo"<td align=center><select name=medico class='caja' onchange='salto2()'>
			<option value=''></option>";			
			while($rmedi=mysql_fetch_array($bmedi))
			{
				$codimed=$rmedi['cod_medi'];
				$nombmed=$rmedi['nom_medi'];			
				if($medico==$codimed)echo"<option selected value=$codimed>$nombmed</option>";
				else echo"<option value=$codimed>$nombmed</option>";			
			}
			echo"
		</tr></table>";
		if($medico!='')
		{			
			$fecha=date('Y-m-d');	
			if(empty($mes))$mes=(date("m"));
			if(empty($ano))$ano=(date("Y"));	
			$num=mktime(0,0,0,$mes,1,$ano);
			$pridia=(date("w",$num));
			$numdias=(date("t",$num));
			echo"<br>
			<table width=100%>
			<tr><td>";
				echo"				
				<table class='tbl2' align=center>
				<input type=hidden name=servicio value=$servicio>	
				<input type=hidden name=cedula value='$cedula' >
				<tr>";
			   // echo"<td  align=center height=40>M</td>";
				echo"<td align=center colspan=4>
				<select name=mes class='caja' onChange='salto2()'>";
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
				<select name=ano  class='caja' onChange='salto2()'>";
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
				<td>Lun</td>
				<td>Mar</td>
				<td>Mie</td>
				<td>Jue</td>
				<td>Vie</td>
				<td bgcolor>Sab</td>
				<td>Dod</td>
				</tr>";
				if($pridia==0)$pridia=7;
				$pridia=$pridia+1;
				//echo $pridia;
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
						FROM horarios LEFT JOIN citas ON horarios.ID_horario = citas.ID_horario
						WHERE (((horarios.Cmed_horario)='$medico') AND ((horarios.Cserv_horario)='$area') AND ((horarios.Fecha_horario)='$di') AND ((citas.ID_horario) is NULL))");
						while($ndispo=mysql_fetch_array($bdi))
						{
							$cuentadispo=$ndispo['cuentadis'];
						}						
						if($di>=$fecha)
						{							
							if($cuentadispo>0)
							{							
								if((($pridia+$k-1)%(7)==0) || (($pridia+$k-2)%(7)==0))
								{									
									$color=0;														
									if($vecdia==$di)$color=1;														
									if($color==1)								
									{
										//echo"<td align=center bgcolor='#FAFF9E'><font color='#FF0000'>$k</td>";
										echo"<td align=center bgcolor='#FAFF9E'><a href='#' onclick='calen1(\"$di\",0)' title='$cuentadispo'><font color='#FF0000'>$k</a></td>";
									}
									else
									{										
										echo"<td align=center><a href='#' onclick='calen(\"$di\",1)' title='$cuentadispo'><font color='#FF0000'>$k</a></td>";
									}						
								}
								else
								{									
									$color=0;														
									if($vecdia==$di)$color=1;
									if($color==1)
									{
										//echo"<td align=center bgcolor='#FAFF9E'><font color='#0000FF'>$k</td>";
										echo"<td align=center bgcolor='#FAFF9E'><a href='#' onclick='calen1(\"$di\",0)' title='$cuentadispo'><font color='#0000FF'>$k</a></td>";
									}
									else
									{
										echo"<td align=center><a href='#' onclick='calen(\"$di\",1)' title='$cuentadispo'><font color='#0000FF'>$k</a></td>";
									}													
								}
							}
							else
							{				
								echo"<td align=center><font color='#888888' size='2'>$k</td>";
							}
						}
						else
						{				
							echo"<td align=center><font color='#888888' size='2'>$k</td>";
						}						
						$k++;
					}
					if($i%7==0)
					{
						echo"</tr>";
						echo"<tr>";
					}
				}		
				$aele=substr($vecdia,0,4);
				$mele=substr($vecdia,5,2);
				$dele=substr($vecdia,8,2);
				$timnum=gmmktime ( 0, 0, 0, $mele, $dele, $aele);
				$ds=getdate ($timnum);
				$diasem=$ds['wday'];
				if($diasem==0)$dise='LUNES';
				if($diasem==1)$dise='MARTES';
				if($diasem==2)$dise='MIERCOLES';
				if($diasem==3)$dise='JUEVES';
				if($diasem==4)$dise='VIERNES';
				if($diasem==5)$dise='SABADO';
				if($diasem==6)$dise='DOMINGO';
				echo"</table>				
				<td/></tr>
			</table>
			
				
				
				
				
				
				
				
			
				<br><table class='tbl2' align=center>";
				if(empty($cont))$cont=0;
				for($k=0;$k<$cont;$k++)
				{
					$nomvar='vecdia'.$k;
					$vecdia=$$nomvar
					echo"<input type=hidden name=$nomvar value=$vecdia>";
					$nomvar='valval'.$k;
					$valval=$$nomvar
					echo"<input type=hidden name=$nomvar value=$valval>";
					
					
					
					if($valval==1)
					{
					
						echo"<tr><td align=center colspan=6>FECHA: $dise $vecdia<font color='#FFFFFF'>------------------</font>HORA: $horaele</td></tr>";
						if(empty($cont))$cont=0;
						//echo $vecdia;		
						$bdispo=mysql_query("SELECT horarios.Fecha_horario, horarios.Usado_horario, horarios.Cmed_horario, horarios.Hora_horario, horarios.Cserv_horario, horarios.ID_horario
						FROM horarios WHERE (((horarios.Fecha_horario)='$vecdia') AND ((horarios.Usado_horario)>0) AND ((horarios.Cmed_horario)='$medico'));");
						$n=0;
						echo"<tr>";
						while($rdispo=mysql_fetch_array($bdispo))
						{
							$Fecha_horario=$rdispo['Fecha_horario'];
							$Usado_horario=$rdispo['Usado_horario'];
							$Cmed_horario=$rdispo['Cmed_horario'];
							$Hora_horario=$rdispo['Hora_horario'];
							$Cserv_horario=$rdispo['Cserv_horario'];
							$ID_horario=$rdispo['ID_horario'];
							$hora=substr($Hora_horario,11,5);
							if($n % 6==0)echo"</tr><tr>";					
							$chor=mysql_query("select * from citas where ID_horario='$ID_horario'");
							$nhor=mysql_fetch_array($chor);
							if($nhor==0)
							{
								
								
								$color1=0;														
								if($seleccion==$ID_horario)$color1=1;					
								if($color1==1)
								{
									echo"<td align=center bgcolor='#FAFF9E'><font color='#0000FF'>$hora</td>";
								}
								else
								{
									echo"<input type=hidden name=$nomvar>";
									$titu=$Usado_horario.' turnos disponibles';
									echo"<td align=center><a href='#' onclick='busdia($ID_horario,\"$hora\",\"$Usado_horario\")' title='$titu'><font color='#0000FF'>$hora</a></td>";
								}
							
							
							
							}
							else
							{
								echo"<td align=center><font color='#888888'>$hora</td>";
							}	
						
						
						
							/*
							if($seleccion==$ID_horario)echo"<td><input type=radio checked name=seleccion value='$ID_horario' onclick='busdia($ID_horario,\"$hora\")'>$hora</td>";		
							else echo"<td><input type=radio name=seleccion value='$ID_horario' onclick='busdia(\"$hora\")'>$hora</td>";	
							*/
							$n++;	
						}
					}				
				}
			echo"</tr>";
			echo"</table>";
			echo"<td/><tr/></table>";
			
			
		}
		echo"<input type=hidden name=cont value=$cont>
		</tr>		
		</table>
		<br>
		<table align=center class='tbl' width=100%>
		<tr><th align=center height=20>";
		if($n>0)echo"<INPUT type=button class='boton' value='aceptar' onClick='valida();'>";
		echo"</th></tr>		
		</table>
		</td></tr>
		</table>";
	}
	echo "</form>";
	
	function calculaedad($fecha_)
	{
		$ano_=substr($fecha_,0,4);
		$mes_=substr($fecha_,5,2);
		$dia_=substr($fecha_,8,2);
		if($mes_==2)
		{
			$diasmes_=28;
		}
		else
		{
			if($mes_==1 || $mes_==3 || $mes_==5 || $mes_==7 || $mes_==8 || $mes_==10 || $mes_==12)
			{
				$diasmes_=31;
			}
			else
			{
				$diasmes_=30;			
			}
		}
		$anos_=date("Y")-$ano_;
		$meses_=date("m")-$mes_;
		$dias_=date("d")-$dia_;    
		if($dias_<0)
		{
			if($meses_>0)
			{
				$meses_=$meses_-1;
			}
			$dias_=$diasmes_+$dias_;
		}
		if($meses_<0)
		{
			$meses_=12+$meses_;
			if(date("d")-$dia_<0)
			{
				$meses_=$meses_-1;
			}
			$anos_=$anos_-1;
		}
		if($meses_==0 & date("d")-$dia_<0 & $anos_>0)
		{
			if(date("m")-$mes_==0 & date("d")-$dia_<0)
			{
				$anos_=$anos_-1;
			}
			$meses_=11;
		}
		if($anos_<>0)
		{
			$edad_=$anos_;
			if($edad_==1)
			{
				$unidad_=" Año";
			}
			else
			{
				$unidad_=" Años";
			}
		}
		else
		{
			if($meses_<>0)
			{
				$edad_=$meses_;
				if($edad_==1)
				{
					$unidad_=" Mes";
				}
				else
				{
					$unidad_=" Meses";
				}
			}
			else
			{
				$edad_=$dias_;
				if($edad_==1)
				{
					$unidad_=" Día";
				}
				else
				{
					$unidad_=" Días";
				}
			}
		}
		return($edad_.$unidad_);  
	}
?>
</body>
</html>

	




