<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<HEAD>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 

<!-- librera principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librera para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librera que declara la funcin Calendar.setup, que ayuda a generar un calendario en unas pocas lneas de cdigo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

 <TITLE>PACIENTES PENDIENTES DE TOMA DE MUESTRA</TITLE>
 <link rel="stylesheet" href="css/style.css" type="text/css" />
   <script language='Javascript'>
   function cambio(campo)
	{
		campo.select();
	}
	function abrecierra()
	{
		//alert("se fue");
		uno.action='cd_usuario2.php';
		uno.submit();
	}
	
	function ver1(form,a)
	{
	  form.cuentas1.value=(10/1)*a/1;	 
		alert(form.cuentas1.value);	  
	  form.action='cd_usuario2.php';
	  form.submit();
	}
	function enviar(valori,valorj)
	{
		uno.prim.value=valori;
		uno.segun.value=valorj;		
		uno.action='imagen1.php';
		uno.submit();
	}
	function busca()
		{
			//alert("toy");
			//uno.fin.value=fin;
			uno.action='cd_usuario2.php';
			uno.target='';
			uno.submit();
		}

	
	function busca2()
		{
			//alert("toy");
			//uno.fin.value=fin;
			uno.action='cd_usuario2.php';
			uno.target='';
			uno.submit();
		}
	function bus_ced()
	{
		uno.action='cd_usuario2.php';
		uno.target='';
		uno.submit();
	
	}
	function abrir2(fec_var,hor_var) {
		
		uno.ghor_.value=hor_var;
		uno.gfec_.value=fec_var;
		
		//alert(uno.gfec_.value);
		uno.submit();
	}
	function cargar()
	{
		//alert("se fue");
		uno.action='gen_rips_hospi.php';
		uno.submit();
	}
	function validar(i,j)
	{
		 if(event.keyCode==13)
		 {
			cual=eval("uno.num_fac"+i+j+".value");
			
			uno.action='cd_usuario2.php';
			uno.target='';
			uno.submit();
			//return true;
		 }
			
	}
	function prueba(i)
	{
		var nombre ="uno.norden"+i+".value";
		nord=eval(nombre)
		alert(nord)
		uno.norden.value=nord;
		uno.submit();
	}
	

    </script>
</HEAD>
<BODY >
<style>
.tm1{
color: #1D669E;

}
.tm
{
color:#1D669E;
}
.enlace {
border: 0;
padding: 0;
background-image: url('img/feed_go.png');
width:70%;
height:22;
background-repeat:no-repeat;
color: blue;
border-bottom: 1px solid blue;
TEXT-DECORATION: none;
}
</style>
<?    	
	
	$anno=date('Y');	
	$mes=date('m');	
	$dia=date('d');		
	echo "<div id='nav2'>
    <form name=uno method=post action=cd_usuario2.php target=''>
	<input type=hidden name=prim>
	<input type=hidden name=segun>";
	echo"<table class='Tbl1'><tr><th class='Th0'>PACIENTES PENDIENTES / TOMA DE MUESTRA</th></tr></table>";
	
	echo"<table align=center border=0>
	<tr>";	
	$fecha=time();
	$fecdia=date ("Y-m-d",$fecha);
	if(empty($fin))$fin=$fecdia;
	if(empty($ffin))$ffin=$fecdia;

	$link=Mysql_connect("localhost","root","");
	if(!$link){echo"no hay conexion";}
	Mysql_select_db('proinsalud',$link);
	
	?>
				<!-- fecha de recepcion de Muetras -->
				<tr><td   colspan=2><strong> Fecha Inicial:</strong></td><td colspan='3'>
						<!-- formulario con el campo de texto y el botn para lanzar el calendario--> 
						<?php    echo "<input type=text name=fin id=fin size='10' value= >";?>
						<input type="button" id="lanzador1" value="..." />
						<!-- script que define y configura el calendario--> 
						<script type="text/javascript"> 
					     Calendar.setup({ 
						inputField     :    "fin",     // id del campo de texto 
						ifFormat     :     "%Y/%m/%d",     // formato de la fecha que se escriba en el campo de texto 
						button     :    "lanzador1"     // el id del botn que lanzar el calendario 
						}); 
						</script> 
						
		
			<td   colspan=2><strong> Fecha Final:</strong></td><td colspan='3' >
						<!-- formulario con el campo de texto y el botn para lanzar el calendario--> 
						<?php echo "<input type=text name=ffin id=ffin size='10' value= >";?>
						<input type="button" id="lanzador2" value="..." />
						<!-- script que define y configura el calendario--> 
						<script type="text/javascript"> 
					     Calendar.setup({ 
						inputField     :    "ffin",     // id del campo de texto 
						ifFormat     :     "%Y/%m/%d",     // formato de la fecha que se escriba en el campo de texto 
						button     :    "lanzador2"     // el id del botn que lanzar el calendario 
						}); 
						</script> 
						<script language=javascript>uno.fin.value="<?echo $fin?>";</script>
						<script language=javascript>uno.ffin.value="<?echo $ffin?>";</script>
	<?
	if(empty($esta_ncf))$esta_ncf=0;
	echo"<td><strong>Area</td>
	<td  width=140 align=center>";
		echo"<select name='esta_ncf' onchange='busca()'>";
		echo "<option value='0'> </option>";
		echo "<option value='1'>Paciente Hospitalizado Autorizados</option>";
		echo "<option value='2'>Pacientes Citados</option>";
		echo  "</select></td></td>";
	echo "<td><b>Identificación<input type=text name=ced_usu value=$ced_usu></td></tr><tr><td><br></td></tr><tr></tr>";			
	
	?><script language='Javascript'>uno.esta_ncf.value="<?echo $esta_ncf?>";</script>
	
	
	<?
	
	if($esta_ncf=='1')
	{
		echo"<br><table class='Tbl2'border=0>
		<tr>         
		<th class='Th0'>SELECCIONAR</th>
		<th class='Th0'>DOCUMENTO</th>
		<th class='Th0'>NOMBRE</th>         
		<th class='Th0'>EDAD</th> 
		<th class='Th0'>EPS</th> 
		
		<th class='Th0'>AREA/OPCION</th>		 
		</TR>
		<tr>   	 
		<th height=12></th>
		</TR>";
		
		if($ced_usu!='')
		{
			$con_usu=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU
			FROM usuario WHERE usuario.NROD_USU='$ced_usu'");
			
			$rowx=mysql_fetch_array($con_usu);
			$cod_usu=$rowx[CODI_USU];
			
			//echo $cod_usu;
			
			$cons=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, Max( usuario.CODI_USU ) AS MáxDeCODI_USU,contrato.NEPS_CON, ingreso_hospitalario.fecin_ing, Max(usuario.CODI_USU) AS MáxDeCODI_USU,destipos.nomb_des AS cama, destipos_1.nomb_des AS area
			FROM usuario
			INNER JOIN ucontrato AS ucontrato ON usuario.CODI_USU=ucontrato.CUSU_UCO
			INNER JOIN contrato AS contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
			INNER JOIN ingreso_hospitalario AS ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing
			INNER JOIN hist_evo AS hist_evo ON hist_evo.id_ing = ingreso_hospitalario.id_ing
			INNER JOIN hist_var AS hist_var ON hist_evo.iden_evo = hist_var.iden_evo
			INNER JOIN hist_traza AS hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing
			INNER JOIN cups AS cups ON hist_var.iden_ser = cups.codigo
			INNER JOIN destipos AS destipos ON ingreso_hospitalario.caac_ing = destipos.codi_des
			INNER JOIN destipos AS destipos_1 ON destipos.val2_des = destipos_1.codi_des
			WHERE ucontrato.ESTA_UCO='AC' AND hist_traza.id_ing Is Not Null AND hist_traza.horas_tra=-1 AND hist_var.esta_var='SO' AND cups.tipo='1803' AND usuario.CODI_USU='$cod_usu'
			GROUP BY usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, ingreso_hospitalario.fecin_ing");
			
				//echo $cons;
				
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
							 
							if($valor2==1)
							{
								$nomvar2='codchk2'.$i.$j;
								echo "<td class='Td2'><input type=checkbox name='$nomvar2' value=1 checked onclick='abrir2(\"$fecha_vari\",\"$hora_vari\")'></td>";
							}
							else
							{
								$nomvar2='codchk2'.$i.$j;
								echo "<td class='Td2'><input type=checkbox  name='$nomvar2' value=1 onclick='abrir2(\"$fecha_vari\",\"$hora_vari\")'></td>";
							}
							
							
							
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
							echo "<td align='left' colspan=5><span class='tm1'>$fecha_vari -  $hora_vari</span></td>";
							
							echo "</tr>";
							
							
							
							
							if($valor2==1)
							{ 
								//echo $grup_lab;
								
								if(empty($grup_lab))
								{
									$consdes=mysql_query("SELECT usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON,ingreso_hospitalario.id_ing ,ingreso_hospitalario.fecin_ing,hist_var.iden_var,hist_var.fech_var,  cups.codigo,cups.descrip,  hist_evo.cod_medi, hist_evo.iden_evo ,hist_var.hora_var,hist_var.iden_var
									FROM usuario
									INNER JOIN ucontrato AS ucontrato ON usuario.CODI_USU=ucontrato.CUSU_UCO
									INNER JOIN contrato AS contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
									INNER JOIN ingreso_hospitalario AS ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing
									INNER JOIN hist_evo AS hist_evo ON hist_evo.id_ing = ingreso_hospitalario.id_ing
									INNER JOIN hist_var AS hist_var ON hist_evo.iden_evo = hist_var.iden_evo
									INNER JOIN hist_traza AS hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing
									INNER JOIN cups AS cups ON hist_var.iden_ser = cups.codigo
									WHERE hist_var.fech_var='$rot' AND usuario.NROD_USU='$rot2' AND cups.tipo='1803' AND hist_traza.horas_tra=-1 AND hist_var.esta_var='SO' AND ucontrato.ESTA_UCO='AC' 
									ORDER BY hist_var.fech_var desc");
																
									
									//echo $consdes;
									$mcu=1;
									echo "<tr><td align=left></td>";
									echo "<td ></td><td >";
									while($rowdes=mysql_fetch_array($consdes))
									{
									  $desc=$rowdes['descrip'];
									  $cod=$rowdes['codigo'];
									  $idein=$rowdes['id_ing'];
									  $iden_var=$rowdes['iden_var'];
									  //echo $iden_var;
									 // $idenevo=$rowdes['iden_evo'];
									  //echo  $idenevo;
									  //$iden_var=$rowdes['iden_var'];
									  
									  echo "$mcu. $desc<br>";
									  //echo "<td ></td>";
									  //echo "<td ></td>";
									  //echo "</tr>";
									  $nomvar='cod'.$mcu;							  
									  echo "<input type=hidden name=$nomvar value=$cod>";
									  $nomvar='selec'.$mcu;
									  echo "<input type=hidden name=$nomvar value=1>";
									  $mcu++;
									}				
									echo "</td>";
									//$varev=$$nomvar;
									$conord1=mysql_query("SELECT iden_labs,iden_evo, nord_lab,obs_labs   FROM encabezado_labs WHERE iden_evo='$iden_evo'");
									
									//echo "Por el if".$conord;
									if(mysql_num_rows($conord1)<>0)
									{
									  //echo 'toy';
									  $roword=mysql_fetch_array($conord1);
									  $num_ord=$roword[nord_lab];
									  $iden_labs=$roword[iden_labs];
									 // echo $num_ord;
									  $obs_labs=$roword[obs_labs];
									  echo "<td valign='TOP'><input type=text name=num_ord size=7 value=$num_ord disabled></td>";
									  echo "<input type=hidden name=num_ord  value=$num_ord>";
									  echo "<td valign='TOP' colspan=2><input type=text name=obs_labs size=40 value='$obs_labs' disabled>";
									  echo "<input type=hidden name=obs_labs size=40 value='$obs_labs'> <a href='#' onclick='cargar()'><img src=imagenes/1.png></a></td></tr>";  
									  echo "<input type=hidden name=mcu value=$mcu>";
									  echo "<input type=hidden name=idein value=$idein>";
									  echo "<input type=hidden name=iden_var value=$iden_var>";
									  echo "<input type=hidden name=idenevo value=$iden_evo>";
									  echo "<input type=hidden name=iden_labs value=$iden_labs>";
									
									}
									else
									{
									  echo "<td align=center><input type=text name=num_ord size=7>";
									  echo "<td colspan=2 align=center><input type=text name=obs_labs size=40>";
									  echo "<a href='#' onclick='cargar()'><img src=imagenes/1.png></a></td></tr>";  
									  echo "<input type=hidden name=mcu value=$mcu>";
									  echo "<input type=hidden name=idein value=$idein>";
									  echo "<input type=hidden name=idenevo value=$iden_evo>";
									  echo "<input type=hidden name=iden_var value=$iden_var>";
									  //echo "<input type=hidden name=iden_labs value=0>";
									
									}  
								}	
								else
								{
								
									$consdes=mysql_query("SELECT usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON,ingreso_hospitalario.id_ing ,ingreso_hospitalario.fecin_ing,hist_var.iden_var,hist_var.fech_var,  cups.codigo,cups.descrip,  hist_evo.cod_medi, hist_evo.iden_evo ,hist_var.hora_var,hist_var.iden_var
									FROM usuario
									INNER JOIN ucontrato AS ucontrato ON usuario.CODI_USU=ucontrato.CUSU_UCO
									INNER JOIN contrato AS contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
									INNER JOIN ingreso_hospitalario AS ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing
									INNER JOIN hist_evo AS hist_evo ON hist_evo.id_ing = ingreso_hospitalario.id_ing
									INNER JOIN hist_var AS hist_var ON hist_evo.iden_evo = hist_var.iden_evo
									INNER JOIN hist_traza AS hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing
									INNER JOIN cups AS cups ON hist_var.iden_ser = cups.codigo
									WHERE hist_var.fech_var='$rot' AND usuario.NROD_USU='$rot2' AND cups.tipo='1803' AND hist_traza.horas_tra=-1 AND hist_var.esta_var='SO' AND ucontrato.ESTA_UCO='AC' AND cups.grup_quim='$grup_lab'
									ORDER BY hist_var.fech_var desc");
																
									if(mysql_num_rows($consdes)<>0)
									{
										$mcu=1;
										while($rowdes=mysql_fetch_array($consdes))
										{
										  $desc=$rowdes['descrip'];
										  $cod=$rowdes['codigo'];
										  $idein=$rowdes['id_ing'];
										  //$idenevo=$rowdes['iden_evo'];
										  //echo $idenevo;
										  $iden_var=$rowdes['iden_var'];
										  //echo $iden_var;
										  echo "<tr><td align=left></td>";
										  echo "<td ></td>";
										  echo "<td class='tm'>$mcu. $desc<br></td>";
										  //echo "<td ></td>";
										  //echo "<td ></td>";
										  //echo "</tr>";
										  $nomvar='cod'.$mcu;							  
										  echo "<input type=hidden name=$nomvar value=$cod>";
										  $nomvar='selec'.$mcu;
										  echo "<input type=hidden name=$nomvar value=1>";
										 
									
										  $mcu++;
										}	
										
										$conord=mysql_query("SELECT iden_evo, nord_lab,obs_labs  FROM encabezado_labs WHERE iden_evo='$iden_evo'");
										//echo $conord;
										if(mysql_num_rows($conord)<>0)
										{
										  $roword=mysql_fetch_array($conord);
										  $num_ord=$roword[nord_lab];
										  $obs_labs=$roword[obs_labs];
										
												  
											echo "<td align=center><input type=text  size=7 value='$num_ord' disabled>";
											echo "<input type=hidden name=num_ord  value=$num_ord>"; 
											echo "<td colspan=2 align=center><input type=text name=obs_labs value='$obs_labs' size=40 disabled>";
											echo "<input type=hidden name=obs_labs size=40 value='$obs_labs'> <a href='#' onclick='cargar()'><img src=imagenes/1.png></a></td></tr>"; 
											echo "<input type=hidden name=mcu value=$mcu>";
											echo "<input type=hidden name=idein value=$idein>";
											echo "<input type=hidden name=idenevo value=$iden_evo>";
											echo "<input type=hidden name=iden_var value=$iden_var>";
											echo "<input type=hidden name=iden_labs value=$iden_labs>";
										}   
										else
										{
											echo "<td align=center><input type=text name=num_ord size=7>";
											echo "<td colspan=2 align=center><input type=text name=obs_labs size=40> 
											<a href='#' onclick='cargar()'><img src=imagenes/1.png></a></td></tr>"; 
											echo "<input type=hidden name=mcu value=$mcu>";
											echo "<input type=hidden name=idein value=$idein>";
											echo "<input type=hidden name=idenevo value=$iden_evo>";
											echo "<input type=hidden name=iden_var value=$iden_var>";
										}
									}
									else
									{
										  echo "<td colspan=6 align=center><FONT FACE='arial' SIZE=1 COLOR=red>HAY OTROS EXAMENES POR REALIZAR - VERIFIQUE</FONT></td></tr>";  
											
									}
								} 
								  
							  
							}
											
							$j++;
						}
						
					}		  	  
				
				$i++;
			}
			
		}	

	  else
	  {
	
			$cons=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, Max( usuario.CODI_USU ) AS MáxDeCODI_USU,contrato.NEPS_CON, ingreso_hospitalario.fecin_ing, Max(usuario.CODI_USU) AS MáxDeCODI_USU,destipos.nomb_des AS cama, destipos_1.nomb_des AS area
			FROM usuario
			INNER JOIN ucontrato AS ucontrato ON usuario.CODI_USU=ucontrato.CUSU_UCO
			INNER JOIN contrato AS contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
			INNER JOIN ingreso_hospitalario AS ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing
			INNER JOIN hist_evo AS hist_evo ON hist_evo.id_ing = ingreso_hospitalario.id_ing
			INNER JOIN hist_var AS hist_var ON hist_evo.iden_evo = hist_var.iden_evo
			INNER JOIN hist_traza AS hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing
			INNER JOIN cups AS cups ON hist_var.iden_ser = cups.codigo
			INNER JOIN destipos AS destipos ON ingreso_hospitalario.caac_ing = destipos.codi_des
			INNER JOIN destipos AS destipos_1 ON destipos.val2_des = destipos_1.codi_des
			WHERE ucontrato.ESTA_UCO='AC' AND hist_traza.id_ing Is Not Null AND hist_traza.horas_tra=-1 AND hist_var.esta_var='SO' AND cups.tipo='1803' 
			GROUP BY usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, ingreso_hospitalario.fecin_ing");
			
				//echo $cons;
				
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
							 
							if($valor2==1)
							{
								$nomvar2='codchk2'.$i.$j;
								echo "<td class='Td2'><input type=checkbox name='$nomvar2' value=1 checked onclick='abrir2(\"$fecha_vari\",\"$hora_vari\")'></td>";
							}
							else
							{
								$nomvar2='codchk2'.$i.$j;
								echo "<td class='Td2'><input type=checkbox  name='$nomvar2' value=1 onclick='abrir2(\"$fecha_vari\",\"$hora_vari\")'></td>";
							}
							
							
							
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
							echo "<td align='left' colspan=5><span class='tm1'>$fecha_vari -  $hora_vari</span></td>";
							
							echo "</tr>";
							
							
							
							
							if($valor2==1)
							{ 
								//echo $grup_lab;
								
								if(empty($grup_lab))
								{
									$consdes=mysql_query("SELECT usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON,ingreso_hospitalario.id_ing ,ingreso_hospitalario.fecin_ing,hist_var.iden_var,hist_var.fech_var,  cups.codigo,cups.descrip,  hist_evo.cod_medi, hist_evo.iden_evo ,hist_var.hora_var,hist_var.iden_var
									FROM usuario
									INNER JOIN ucontrato AS ucontrato ON usuario.CODI_USU=ucontrato.CUSU_UCO
									INNER JOIN contrato AS contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
									INNER JOIN ingreso_hospitalario AS ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing
									INNER JOIN hist_evo AS hist_evo ON hist_evo.id_ing = ingreso_hospitalario.id_ing
									INNER JOIN hist_var AS hist_var ON hist_evo.iden_evo = hist_var.iden_evo
									INNER JOIN hist_traza AS hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing
									INNER JOIN cups AS cups ON hist_var.iden_ser = cups.codigo
									WHERE hist_var.fech_var='$rot' AND usuario.NROD_USU='$rot2' AND cups.tipo='1803' AND hist_traza.horas_tra=-1 AND hist_var.esta_var='SO' AND ucontrato.ESTA_UCO='AC' 
									ORDER BY hist_var.fech_var desc");
																
									
									//echo $consdes;
									$mcu=1;
									echo "<tr><td align=left></td>";
									echo "<td ></td><td >";
									while($rowdes=mysql_fetch_array($consdes))
									{
									  $desc=$rowdes['descrip'];
									  $cod=$rowdes['codigo'];
									  $idein=$rowdes['id_ing'];
									  $iden_var=$rowdes['iden_var'];
									  //echo $iden_var;
									 // $idenevo=$rowdes['iden_evo'];
									  //echo  $idenevo;
									  //$iden_var=$rowdes['iden_var'];
									  
									  echo "$mcu. $desc<br>";
									  //echo "<td ></td>";
									  //echo "<td ></td>";
									  //echo "</tr>";
									  $nomvar='cod'.$mcu;							  
									  echo "<input type=hidden name=$nomvar value=$cod>";
									  $nomvar='selec'.$mcu;
									  echo "<input type=hidden name=$nomvar value=1>";
									  $mcu++;
									}				
									echo "</td>";
									//$varev=$$nomvar;
									$conord1=mysql_query("SELECT iden_labs,iden_evo, nord_lab,obs_labs   FROM encabezado_labs WHERE iden_evo='$iden_evo'");
									
									//echo "Por el if".$conord;
									if(mysql_num_rows($conord1)<>0)
									{
									  //echo 'toy';
									  $roword=mysql_fetch_array($conord1);
									  $num_ord=$roword[nord_lab];
									  $iden_labs=$roword[iden_labs];
									 // echo $num_ord;
									  $obs_labs=$roword[obs_labs];
									  echo "<td valign='TOP'><input type=text name=num_ord size=7 value=$num_ord disabled></td>";
									  echo "<input type=hidden name=num_ord  value=$num_ord>";
									  echo "<td valign='TOP' colspan=2><input type=text name=obs_labs size=40 value='$obs_labs' disabled>";
									  echo "<input type=hidden name=obs_labs size=40 value='$obs_labs'> <a href='#' onclick='cargar()'><img src=imagenes/1.png></a></td></tr>";  
									  echo "<input type=hidden name=mcu value=$mcu>";
									  echo "<input type=hidden name=idein value=$idein>";
									  echo "<input type=hidden name=iden_var value=$iden_var>";
									  echo "<input type=hidden name=idenevo value=$iden_evo>";
									  echo "<input type=hidden name=iden_labs value=$iden_labs>";
									
									}
									else
									{
									  echo "<td align=center><input type=text name=num_ord size=7>";
									  echo "<td colspan=2 align=center><input type=text name=obs_labs size=40>";
									  echo "<a href='#' onclick='cargar()'><img src=imagenes/1.png></a></td></tr>";  
									  echo "<input type=hidden name=mcu value=$mcu>";
									  echo "<input type=hidden name=idein value=$idein>";
									  echo "<input type=hidden name=idenevo value=$iden_evo>";
									  echo "<input type=hidden name=iden_var value=$iden_var>";
									  //echo "<input type=hidden name=iden_labs value=0>";
									
									}  
								}	
								else
								{
								
									$consdes=mysql_query("SELECT usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON,ingreso_hospitalario.id_ing ,ingreso_hospitalario.fecin_ing,hist_var.iden_var,hist_var.fech_var,  cups.codigo,cups.descrip,  hist_evo.cod_medi, hist_evo.iden_evo ,hist_var.hora_var,hist_var.iden_var
									FROM usuario
									INNER JOIN ucontrato AS ucontrato ON usuario.CODI_USU=ucontrato.CUSU_UCO
									INNER JOIN contrato AS contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
									INNER JOIN ingreso_hospitalario AS ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing
									INNER JOIN hist_evo AS hist_evo ON hist_evo.id_ing = ingreso_hospitalario.id_ing
									INNER JOIN hist_var AS hist_var ON hist_evo.iden_evo = hist_var.iden_evo
									INNER JOIN hist_traza AS hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing
									INNER JOIN cups AS cups ON hist_var.iden_ser = cups.codigo
									WHERE hist_var.fech_var='$rot' AND usuario.NROD_USU='$rot2' AND cups.tipo='1803' AND hist_traza.horas_tra=-1 AND hist_var.esta_var='SO' AND ucontrato.ESTA_UCO='AC' AND cups.grup_quim='$grup_lab'
									ORDER BY hist_var.fech_var desc");
																
									if(mysql_num_rows($consdes)<>0)
									{
										$mcu=1;
										while($rowdes=mysql_fetch_array($consdes))
										{
										  $desc=$rowdes['descrip'];
										  $cod=$rowdes['codigo'];
										  $idein=$rowdes['id_ing'];
										  //$idenevo=$rowdes['iden_evo'];
										  //echo $idenevo;
										  $iden_var=$rowdes['iden_var'];
										  //echo $iden_var;
										  echo "<tr><td align=left></td>";
										  echo "<td ></td>";
										  echo "<td class='tm'>$mcu. $desc<br></td>";
										  //echo "<td ></td>";
										  //echo "<td ></td>";
										  //echo "</tr>";
										  $nomvar='cod'.$mcu;							  
										  echo "<input type=hidden name=$nomvar value=$cod>";
										  $nomvar='selec'.$mcu;
										  echo "<input type=hidden name=$nomvar value=1>";
										 
									
										  $mcu++;
										}	
										
										$conord=mysql_query("SELECT iden_evo, nord_lab,obs_labs  FROM encabezado_labs WHERE iden_evo='$iden_evo'");
										//echo $conord;
										if(mysql_num_rows($conord)<>0)
										{
										  $roword=mysql_fetch_array($conord);
										  $num_ord=$roword[nord_lab];
										  $obs_labs=$roword[obs_labs];
										
												  
											echo "<td align=center><input type=text  size=7 value='$num_ord' disabled>";
											echo "<input type=hidden name=num_ord  value=$num_ord>"; 
											echo "<td colspan=2 align=center><input type=text name=obs_labs value='$obs_labs' size=40 disabled>";
											echo "<input type=hidden name=obs_labs size=40 value='$obs_labs'> <a href='#' onclick='cargar()'><img src=imagenes/1.png></a></td></tr>"; 
											echo "<input type=hidden name=mcu value=$mcu>";
											echo "<input type=hidden name=idein value=$idein>";
											echo "<input type=hidden name=idenevo value=$iden_evo>";
											echo "<input type=hidden name=iden_var value=$iden_var>";
											echo "<input type=hidden name=iden_labs value=$iden_labs>";
										}   
										else
										{
											echo "<td align=center><input type=text name=num_ord size=7>";
											echo "<td colspan=2 align=center><input type=text name=obs_labs size=40> 
											<a href='#' onclick='cargar()'><img src=imagenes/1.png></a></td></tr>"; 
											echo "<input type=hidden name=mcu value=$mcu>";
											echo "<input type=hidden name=idein value=$idein>";
											echo "<input type=hidden name=idenevo value=$iden_evo>";
											echo "<input type=hidden name=iden_var value=$iden_var>";
										}
									}
									else
									{
										  echo "<td colspan=6 align=center><FONT FACE='arial' SIZE=1 COLOR=red>HAY OTROS EXAMENES POR REALIZAR - VERIFIQUE</FONT></td></tr>";  
											
									}
								} 
								  
							  
							}
											
							$j++;
						}
						
					}		  	  
				
				$i++;
			}
				
		  }	
		
		
	}
	

	////LABORATORIOS ESPECIALES
	if($esta_ncf=='2')
	{
		
		echo"<br><table class='Tbl2'border=0>
		<tr>         
		<th class='Th0'>HORA</th>
		<th class='Th0'>DOCUMENTO</th>
		<th class='Th0'>NOMBRE</th>         
		<th class='Th0'>EDAD</th> 
		<th class='Th0'>EPS</th> 
		<th class='Th0'>OPCION</th>		 
		</TR>
		<tr>   	 
		<th height=12></th>
		</TR>";

		if($ced_usu!='')
		{
			$con_usu=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU
			FROM usuario WHERE usuario.NROD_USU='$ced_usu'");
			
			$rowx=mysql_fetch_array($con_usu);
			$cod_usu=$rowx[CODI_USU];
			
			$cad="SELECT FNAC_USU, Idusu_citas, NROD_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, codi_usu, cod_areas, nrod_usu, tpaf_usu, fecha_horario, hora_horario, id_cita, nom_areas, Hora_horario,contrato.NEPS_CON
			FROM citas 
			INNER JOIN ane_lab_cit As ane_lab_cit ON citas.id_cita = ane_lab_cit.cod_cita 
			INNER JOIN usuario AS usuario ON citas.Idusu_citas = usuario.CODI_USU
			INNER JOIN ucontrato AS ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO
			INNER JOIN contrato AS contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
			INNER JOIN horarios AS horarios ON citas.ID_horario = horarios.ID_horario
			INNER JOIN areas AS areas ON horarios.Cserv_horario = areas.cod_areas 
			WHERE cod_areas = '80' AND Clase_citas < '6' AND fecha_horario='$fin' AND fecha_horario<='$ffin' AND rips_citas='' AND usuario.CODI_USU='$cod_usu'
			ORDER BY horarios.Hora_horario  ";
	
			//echo $cad;
			echo"<tr bgcolor=#FEE9BC>";
			echo"<th class='Td0' align=center>$fec_hor</th>";
			echo"<input type=hidden name=norden value=$norden>";
			$resul=Mysql_query($cad,$link);
			if(!$resul)echo 'no hay consulta';
				$num=Mysql_num_rows($resul);	
			$i=0;	
			while($row = mysql_fetch_array($resul))
			{			
				$ide_cita=$row['id_cita'];
				$ingreso=$row['MxDeid_ing'];
				$codusu=$row['codi_usu'];	
				//echo $codusu;
				$cedula=$row['NROD_USU'];	
				$nombre=$row['PNOM_USU'].' '.$row['SNOM_USU'].' '.$row['PAPE_USU'].' '.$row['SAPE_USU'];
				$fnac=$row['FNAC_USU'];
				$edad=calcuedad($fnac);
				$codcontra=$row[''];
				$estado=$row['ESTA_UCO'];
				$ncontra=$row['NEPS_CON'];		
				$nom_medi=$row[''];		
				$fec_hor=substr($row['Hora_horario'],10,6);
				$nomarea=$row['nom_areas'];		
				$nomvar="selec".$i;		
				$seleccionar=$$nomvar;		
				$fecing=$fechaing.' '.$horain;		
				$nomvar='ncontra'.$i;
				echo "<input type=hidden name='$nomvar' value='$ncontra' onclick=activar($i)>";					
				$nomvar='nombre'.$i;
				echo "<input type=hidden name='$nomvar' value='$nombre' onclick=activar($i)>";		
				$nomvar='estado'.$i;
				echo "<input type=hidden name='$nomvar' value='$estado' onclick=activar($i)>";		
				$nomvar='cedula'.$i;
				echo "<input type=hidden name='$nomvar' value='$cedula'>";
				$nomvar='edad'.$i;
				echo "<input type=hidden name='$nomvar' value='$edad' onclick=activar($i)>";	
				$nomvar='norden'.$i;
				echo "<input type=hidden name='$nomvar'  onChange='prueba($i)' >";	
				
				echo"<tr bgcolor=#FEE9BC>";
				echo"<th class='Td0' align=center>$fec_hor</th>";
			
				echo"
				
				<th class='Td0'><b>$cedula</th>		
				<th class='Td0'><b>$nombre</th>
				<th class='Td0'><b>$edad</th>
				<th class='Td0'><b>$ncontra</th>";
				
				echo"<th class='Td0'><b><a href='ing_cups.php?codig_usu=$codusu&area=01&ide_cita=$ide_cita'><img src='imagenes/search.gif' width=15 alt='Rips'></a>
				<b><a href='rechazo_rips.php?codusu=$codusu&area=01&ide_cita=$ide_cita' target='' onclick=''><img src='imagenes/feed_error-1.png' width=15 alt='Rechazado'></a></th>	
				</tr>";	
				
			$i++;	
			}
		}
		
		else
		{
		
			$cad="SELECT FNAC_USU, Idusu_citas, NROD_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, codi_usu, cod_areas, nrod_usu, tpaf_usu, fecha_horario, hora_horario, id_cita, nom_areas, Hora_horario,contrato.NEPS_CON
			FROM citas 
			INNER JOIN ane_lab_cit As ane_lab_cit ON citas.id_cita = ane_lab_cit.cod_cita 
			INNER JOIN usuario AS usuario ON citas.Idusu_citas = usuario.CODI_USU
			INNER JOIN ucontrato AS ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO
			INNER JOIN contrato AS contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
			INNER JOIN horarios AS horarios ON citas.ID_horario = horarios.ID_horario
			INNER JOIN areas AS areas ON horarios.Cserv_horario = areas.cod_areas 
			WHERE cod_areas = '80' AND Clase_citas < '6' AND fecha_horario='$fin' AND fecha_horario<='$ffin' AND rips_citas=''
			ORDER BY horarios.Hora_horario  ";
	
			//echo $cad;
			echo"<tr bgcolor=#FEE9BC>";
			echo"<th class='Td0' align=center>$fec_hor</th>";
			echo"<input type=hidden name=norden value=$norden>";
			$resul=Mysql_query($cad,$link);
			if(!$resul)echo 'no hay consulta';
				$num=Mysql_num_rows($resul);	
			$i=0;	
			while($row = mysql_fetch_array($resul))
			{			
				$ide_cita=$row['id_cita'];
				$ingreso=$row['MxDeid_ing'];
				$codusu=$row['codi_usu'];	
				//echo $codusu;
				$cedula=$row['NROD_USU'];	
				$nombre=$row['PNOM_USU'].' '.$row['SNOM_USU'].' '.$row['PAPE_USU'].' '.$row['SAPE_USU'];
				$fnac=$row['FNAC_USU'];
				$edad=calcuedad($fnac);
				$codcontra=$row[''];
				$estado=$row['ESTA_UCO'];
				$ncontra=$row['NEPS_CON'];		
				$nom_medi=$row[''];		
				$fec_hor=substr($row['Hora_horario'],10,6);
				$nomarea=$row['nom_areas'];		
				$nomvar="selec".$i;		
				$seleccionar=$$nomvar;		
				$fecing=$fechaing.' '.$horain;		
				$nomvar='ncontra'.$i;
				echo "<input type=hidden name='$nomvar' value='$ncontra' onclick=activar($i)>";					
				$nomvar='nombre'.$i;
				echo "<input type=hidden name='$nomvar' value='$nombre' onclick=activar($i)>";		
				$nomvar='estado'.$i;
				echo "<input type=hidden name='$nomvar' value='$estado' onclick=activar($i)>";		
				$nomvar='cedula'.$i;
				echo "<input type=hidden name='$nomvar' value='$cedula'>";
				$nomvar='edad'.$i;
				echo "<input type=hidden name='$nomvar' value='$edad' onclick=activar($i)>";	
				$nomvar='norden'.$i;
				echo "<input type=hidden name='$nomvar'  onChange='prueba($i)' >";	
				
				echo"<tr bgcolor=#FEE9BC>";
				echo"<th class='Td0' align=center>$fec_hor</th>";
			
				echo"
				
				<th class='Td0'><b>$cedula</th>		
				<th class='Td0'><b>$nombre</th>
				<th class='Td0'><b>$edad</th>
				<th class='Td0'><b>$ncontra</th>";
				
				echo"<th class='Td0'><b><a href='ing_cups.php?codig_usu=$codusu&area=01&ide_cita=$ide_cita'><img src='imagenes/search.gif' width=15 alt='Rips'></a>
				<b><a href='rechazo_rips.php?codusu=$codusu&area=01&ide_cita=$ide_cita' target='' onclick=''><img src='imagenes/feed_error-1.png' width=15 alt='Rechazado'></a></th>	
				</tr>";	
				
			$i++;	
			}
		
		
		
		}
		
	}
	
	


	////////////////////////////////////////////////////////////////////////////////
	echo"</table>	
	<input type=hidden name=cuentas1 value=$cuentas1>
	<table class='Tbl2' border=0><tr>";
	$pagi=floor($n/10);
     if($n % 10==0)$pagi=$pagi-1;
	echo"
     <th class='Th0' height=15>";
     for ($j=0;$j<=$pagi;$j++)
     {
         $pag=$j+1;
         if (floor($cuentas1/10)==$j)
         {
             echo"<input type=button value=$pag disabled style='font-family: tahoma; font-size: 8 pt; color: #FFFFFF; font-weight: 900;  background-color: #BED1DB; border-color:#BED1DB;border-width:0;  width: 16 ;height:16'></font>";
         }
         else
         {
             echo"<input type=button value=$pag onclick='ver1(this.form,$j)' style='font-family: tahoma; font-size: 8 pt; color: #FFFFFF; font-weight: 900;  background-color: #BED1DB; border-color:#BED1DB;border-width:0;  width: 16 ;height:16'></font>";
         }
         if(($j+10)%43==0 && $j!=0)echo'<br>';
     }
	 $vec1=$vec;
	 echo"	
	</th></tr>	
	</table>
	<table class='Tbl2' border=0>
	<tr>
	<td align=center height=24><a href='blanco.php?' target=''><img src='icons/feed_delete.png' width=20 alt='Cancelar'><br><br><b>Cancelar</b></a></td>		
	</tr></table>	
	</div>";	
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
		 echo "<input type=hidden name=ctrl value=1>";
		 echo "<input type=hidden name=item1>";
		 echo "<input type=hidden name=item2>";
		 echo "<input type=hidden name=ser value=$ser>";
		 echo "<input type=hidden name=gfec_ value='$gfec_'>";	
		 echo "<input type=hidden name=ghor_ value='$ghor'>";
		 
		echo "<input type=hidden name=idfin>";
		 echo "<input type=hidden name=ide_cita>";	
		 echo "<input type=hidden name=codig_usu >";
		// echo "<input type=hidden name=esta_ncf>";
?>
</BODY>
</HTML>
