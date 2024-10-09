<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 

<!-- librera principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librera para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librera que declara la funcin Calendar.setup, que ayuda a generar un calendario en unas pocas lneas de cdigo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<TITLE>PACIENTES PENDIENTES DE TOMA DE MUESTRA</TITLE></head>
 <link rel="stylesheet" href="css/style.css" type="text/css" />
 
<script language='javascript'>

	function busca()
	{
		alert("toy");
		uno.action='list_ordenes.php';
		uno.target='';
		uno.submit();
	}
	function abrecierra()
	{
		//alert("se fue");
		uno.action='list_ordenes.php';
		uno.submit();
	}

	function cargar(it,jt,mt)
	{
		
		uno.it.value=it;
		//alert(uno.it.value);
		uno.mt.value=mt;
		uno.jt.value=jt;
		uno.action='gen_rips_hospi.php';
		uno.submit();
	}



</script>
<? 
    
	$link=Mysql_connect("localhost","root","");
	if(!$link){echo"no hay conexion";}
	Mysql_select_db('proinsalud',$link);
	
	
	$anno=date('Y');	
	$mes=date('m');	
	$dia=date('d');		
	echo "<div id='nav2'>
    <form name=uno method=post action=cd_usuario2.php target=''>
	<input type=hidden name=prim>
	<input type=hidden name=segun>";
	echo"<table class='Tbl1' border=0><tr><th class='Th0'>PACIENTES PENDIENTES / TOMA DE MUESTRA</th></tr></table>";
	
	echo"<table align=center border=1>
	<tr>";	
	$fecha=time();
	$fecdia=date ("Y/m/d",$fecha);
	if(empty($fin))$fin=$fecdia;
	if(empty($ffin))$ffin=$fecdia;

	
			
	if(empty($esta_ncf))$esta_ncf=0;
	
	echo "<td><b>Identificación:</td><td><input type=text name=ced_usu value=$ced_usu ></td>";
	echo"<td><strong>Area:</td>";
	echo "<td><select name='esta_ncf'>";
	echo "<option value='0'> </option>";
	echo "<option value='1'>Paciente Hospitalizado Autorizados</option>";
	echo "<option value='2'>Pacientes Citados</option>";
	echo "</select></td>";
	echo "<td><input type=button value=Buscar onclick='busca()'</td></tr><tr></tr>";	
	
	
	?><script language='Javascript'>uno.esta_ncf.value="<?echo $esta_ncf?>";</script>
	<?
		if($esta_ncf=='1' or $esta_ncf=='')
		{
			echo"<br><table class='Tbl2'border=1>
			<tr>         
				<th class='Th0'>SELECCIONAR</th>
				<th class='Th0'>DOCUMENTO</th>
				<th class='Th0'>NOMBRE</th>         
				<th class='Th0'>EDAD</th> 
				<th class='Th0'>EPS</th> 
				<th class='Th0'>AREA/OPCION</th>		 
			</tr>
			<tr><th height=12></th></tr>";
			///Busqueda sin Cedula
			if(empty($ced_usu))
			{
				$cons=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, Max( usuario.CODI_USU ) AS MáxDeCODI_USU,contrato.NEPS_CON, ingreso_hospitalario.fecin_ing, Max(usuario.CODI_USU) AS MáxDeCODI_USU
				FROM usuario
				INNER JOIN ucontrato AS ucontrato ON usuario.CODI_USU=ucontrato.CUSU_UCO
				INNER JOIN contrato AS contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
				INNER JOIN ingreso_hospitalario AS ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing
				INNER JOIN hist_evo AS hist_evo ON hist_evo.id_ing = ingreso_hospitalario.id_ing
				INNER JOIN hist_var AS hist_var ON hist_evo.iden_evo = hist_var.iden_evo
				INNER JOIN hist_traza AS hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing
				INNER JOIN cups AS cups ON hist_var.iden_ser = cups.codigo
				WHERE ucontrato.ESTA_UCO='AC' AND hist_traza.id_ing Is Not Null AND hist_traza.horas_tra=-1 AND hist_var.esta_var='SO' AND cups.tipo='1803'
				GROUP BY usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, ingreso_hospitalario.fecin_ing");
			
				echo $cons;
				
				$i=0;
				while ($rowx=mysql_fetch_array($cons))
				{
					$codusu=$rowx['CODI_USU'];
					$fnac=$rowx['FNAC_USU'];
					$neps_con=$rowx['NEPS_CON'];
					$iden_var=$rowx['iden_var'];
					$edad=calcuedad($fnac);
					$cod_usu=$rowx[NROD_USU];
					echo "<tr bgcolor=#FEE9BC>";
					$nomvar='codchk'.$i;
					$valor=$$nomvar;
				 
					if($valor==1)
					{
						$nomvar='codchk'.$i;
						echo "<td bgcolor=#FEE9BC><input type=checkbox name='$nomvar' value=1 checked onclick='abrecierra()'</td>";
					}
					else
					{
						$nomvar='codchk'.$i;
						echo "<td bgcolor=#FEE9BC><input type=checkbox  name='$nomvar' value=1 onclick='abrecierra()'</td>";
					}
						  
									  
					echo"<th class='Td0'>$rowx[NROD_USU]</td>";
					echo "<th class='Td0'>$rowx[PNOM_USU] $rowx[SNOM_USU] $rowx[PAPE_USU] $rowx[SAPE_USU]</td>";
					echo"<th class='Td0'>$edad</td>";
					echo"<th class='Td0'>$neps_con</td>";
					//echo"<th class='Td0'></td>";
					echo"<th class='Td0'>$rowx[cama] - $rowx[area]</td>";
					echo"</tr>";
				}


			}
			///Busqueda Con Cedula
			else
			{
				$cons=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, Max( usuario.CODI_USU ) AS MáxDeCODI_USU,contrato.NEPS_CON, ingreso_hospitalario.fecin_ing, Max(usuario.CODI_USU) AS MáxDeCODI_USU
				FROM usuario
				INNER JOIN ucontrato AS ucontrato ON usuario.CODI_USU=ucontrato.CUSU_UCO
				INNER JOIN contrato AS contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
				INNER JOIN ingreso_hospitalario AS ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing
				INNER JOIN hist_evo AS hist_evo ON hist_evo.id_ing = ingreso_hospitalario.id_ing
				INNER JOIN hist_var AS hist_var ON hist_evo.iden_evo = hist_var.iden_evo
				INNER JOIN hist_traza AS hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing
				INNER JOIN cups AS cups ON hist_var.iden_ser = cups.codigo
				WHERE ucontrato.ESTA_UCO='AC' AND hist_traza.id_ing Is Not Null AND hist_traza.horas_tra=-1 AND hist_var.esta_var='SO' AND cups.tipo='1803' AND usuario.NROD_USU='$ced_usu'
				GROUP BY usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, ingreso_hospitalario.fecin_ing");
			
				echo $cons;
				$i=0;
				while ($rowx=mysql_fetch_array($cons))
				{
					$codusu=$rowx['CODI_USU'];
					$fnac=$rowx['FNAC_USU'];
					$neps_con=$rowx['NEPS_CON'];
					$iden_var=$rowx['iden_var'];
					$edad=calcuedad($fnac);
					$cod_usu=$rowx[NROD_USU];
					echo "<tr bgcolor=#FEE9BC>";
					$nomvar='codchk'.$i;
					$valor=$$nomvar;
				 
					if($valor==1)
					{
						$nomvar='codchk'.$i;
						echo "<td bgcolor=#FEE9BC><input type=checkbox name='$nomvar' value=1 checked onclick='abrecierra()'</td>";
					}
					else
					{
						$nomvar='codchk'.$i;
						echo "<td bgcolor=#FEE9BC><input type=checkbox  name='$nomvar' value=1 onclick='abrecierra()'</td>";
					}
						  
									  
					echo"<th class='Td0'>$rowx[NROD_USU]</td>";
					echo "<th class='Td0'>$rowx[PNOM_USU] $rowx[SNOM_USU] $rowx[PAPE_USU] $rowx[SAPE_USU]</td>";
					echo"<th class='Td0'>$edad</td>";
					echo"<th class='Td0'>$neps_con</td>";
					//echo"<th class='Td0'></td>";
					echo"<th class='Td0'>$rowx[cama] - $rowx[area]</td>";
					echo"</tr>";
					$j=0;
					if($valor==1)
					{ 
						$consciru=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON,
						ingreso_hospitalario.fecin_ing, Max(usuario.CODI_USU) AS MáxDeCODI_USU,hist_var.iden_var,hist_var.fech_var,hist_evo.cod_medi,hist_var.hora_var,hist_var.iden_ser,cups.descrip,hist_var.iden_evo
						FROM usuario
						INNER JOIN ucontrato AS ucontrato ON usuario.CODI_USU=ucontrato.CUSU_UCO
						INNER JOIN contrato AS contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
						INNER JOIN ingreso_hospitalario AS ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing
						INNER JOIN hist_evo AS hist_evo ON hist_evo.id_ing = ingreso_hospitalario.id_ing
						INNER JOIN hist_var AS hist_var ON hist_evo.iden_evo = hist_var.iden_evo
						INNER JOIN hist_traza AS hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing
						INNER JOIN cups AS cups ON hist_var.iden_ser = cups.codigo
						WHERE ucontrato.ESTA_UCO='AC' AND hist_traza.id_ing Is Not Null AND hist_traza.horas_tra=-1 AND hist_var.esta_var='SO' AND cups.tipo='1803' AND usuario.NROD_USU='$cod_usu' 
						GROUP BY usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON, ingreso_hospitalario.fecin_ing, hist_var.fech_var
						ORDER BY hist_var.fech_var desc");
						
						//echo $consciru;
						
						while($rowciru=mysql_fetch_array($consciru))
						{
							 
							  $nomayuda=$rowciru['descrip'];
							  $registro=$rowciru['iden_var'];
							  $codayuda=$row3['iden_ser'];
							  $iden_evo=$rowciru['iden_evo'];
							
							  
							  $fecha_vari=$rowciru[fech_var];
							  $hora_vari=$rowciru[hora_var];
							  echo"<tr align='center' >";
							  $nomvar2='codchk2'.$i.$j;
							  $valor2=$$nomvar2;
							
							
								/*if($valor2==1)
								{
									$nomvar2='codchk2'.$i.$j;
									echo "<td class='Td2'><input type=checkbox name='$nomvar2' value=1 checked onclick='abrir2(\"$fecha_vari\",\"$hora_vari\",$i,$j)'></td>";
								}
								else
								{
									$nomvar2='codchk2'.$i.$j;
									echo "<td class='Td2'><input type=checkbox  name='$nomvar2' value=1 onclick='abrir2(\"$fecha_vari\",\"$hora_vari\",$i,$j)'></td>";
								}*/
								
								
								
								
								$nomvar2='fech'.$i.$j;
								echo "<input type=hidden name=$nomvar2 value=$fecha_vari>";
								
								$nomvar3='usu'.$i.$j;
								echo "<input type=hidden name=$nomvar3 value=$cod_usu>";
								
								$nom_var2='cod_medi'.$i.$j;
								echo "<input type=hidden name=$nom_var2 value=$rowciru[cod_medi]>";
								
								$nomvar='registro'.$i.$j;
								echo "<input type=hidden name='$nomvar' value='$registro'>";
								
								$nomvar='nomayuda'.$i.$j;
								echo "<input type=hidden name='$nomvar' value='$nomayuda'>";
								
								$nomvar='codayuda'.$i.$j;
								echo "<input type=hidden name='$nomvar' value='$codayuda'>";
								
								$nomvar='codusu'.$i.$j;
								echo "<input type=hidden name=codusu value=$rowx[CODI_USU]>";	
								
													
								$nomvar2='fech'.$i.$j;
								$rot=$$nomvar2;
								$nomvar3='usu'.$i.$j;
								$rot2=$$nomvar3;
								
								
								$nomvar2='num_fac'.$i.$j;
								
								
								$consdes=mysql_query("SELECT usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON,ingreso_hospitalario.id_ing ,ingreso_hospitalario.fecin_ing,hist_var.iden_var,hist_var.fech_var,  cups.codigo,cups.descrip,  hist_evo.cod_medi, hist_evo.iden_evo ,hist_var.hora_var,hist_var.iden_var
								FROM usuario
								INNER JOIN ucontrato AS ucontrato ON usuario.CODI_USU=ucontrato.CUSU_UCO
								INNER JOIN contrato AS contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
								INNER JOIN ingreso_hospitalario AS ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing
								INNER JOIN hist_evo AS hist_evo ON hist_evo.id_ing = ingreso_hospitalario.id_ing
								INNER JOIN hist_var AS hist_var ON hist_evo.iden_evo = hist_var.iden_evo
								INNER JOIN hist_traza AS hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing
								INNER JOIN cups AS cups ON hist_var.iden_ser = cups.codigo
								WHERE cups.tipo='1803' AND hist_traza.horas_tra=-1 AND hist_var.esta_var='SO' AND ucontrato.ESTA_UCO='AC' AND hist_var.iden_evo=$iden_evo
								ORDER BY hist_var.fech_var desc");
								
								$mcu=0;
								while($rowdes=mysql_fetch_array($consdes))
								{
									$desc=$rowdes['descrip'];
									$cod=$rowdes['codigo'];
									$nomvar='cod'.$i.$j.$mcu;
									echo "<input type=hidden name=$nomvar value=$cod>";
									$nomvar='selec'.$i.$j.$mcu;									
									echo "<input type=hidden name=$nomvar value=1>";
									$cql[$mcu]=$desc;
								   
							
								$mcu++;
								}
								echo "<td align='left' colspan=5><span class='tm1'><a href='#' onclick='cargar($i,$j,$mcu)'>$iden_evo - $fecha_vari -  $hora_vari</span></a></td></tr>";
								for($g=0;$g<$mcu;$g++)
								{
									$cql2=$cql[$g];
									echo "<tr><td class='Td2' colspan>$cql2</td></tr>";
								}
								echo "</tr>";
								
							
							$j++;
						}
					}
				   $i++;
				}
				echo "<input type=hidden name=it>";
				echo "<input type=hidden name=mt>";
				echo "<input type=hidden name=jt>";
			}
			
		}
		
	?>
	<?
	function calcuedad($fecha_nac)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en nmeros enteros

        $dia=date("j");
        $mes=date("m");
        $anno=date("Y");

        //descomponer fecha de nacimiento
        $dia_nac=substr($fecha_nac, 8, 2);
        $mes_nac=substr($fecha_nac, 5, 2);
        $anno_nac=substr($fecha_nac, 0, 4);


        if($mes_nac>$mes)
        {
            $calc_edad= $anno-$anno_nac-1;
        }
        else
        {
            if($mes==$mes_nac AND $dia_nac>$dia)
            {
                $calc_edad= $anno-$anno_nac-1;
            }
            else
            {
                $calc_edad= $anno-$anno_nac;
            }
        }
        return $calc_edad;
    }
	function estancia($fechaing,$horaing)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en nmeros enteros

        $anno=date('Y');	
		$mes=date('m');	
		$dia=date('d');	
		$hora=date('H');
		$minu=date('i');
		$segu=date('s');
		$numeroact= gmmktime ( $hora, $minu, $segu, $mes, $dia, $anno);//convierte a numero timestamp (int)

        //descomponer fecha de nacimiento
        $dia=substr($fechaing, 8, 2);
        $mes=substr($fechaing, 5, 2);
        $anno=substr($fechaing, 0, 4);		
		$segu=substr($horaing, 6, 2);
        $minu=substr($horaing, 3, 2);
        $hora=substr($horaing, 0, 2);
		$numeroing= gmmktime ( $hora, $minu, $segu, $mes, $dia, $anno);//convierte a numero timestamp (int)
		$difer=$numeroact-$numeroing;		
		$num1=floor($difer/60);
		$seg=$difer%60;	
		$num2=floor($num1/60);
		$min=$num1%60;		
		$dias=floor($num2/24);
		$horas=$num2%24;		
        $tiempo=$dias.' Dias  '.$horas.' Horas  ';
        return $tiempo;
    }
	
	
	
	
	?>
	</form>
<html>