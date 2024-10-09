<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<HTML>
<HEAD>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<meta http-equiv="Refresh" content="20">
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
   function env_ord(i,cod,cont,cita)
	{
		
		uno.codiusua.value=cod;
		uno.ctr.value=cont;
		uno.idcita.value=cita;
		uno.ite.value=i;
		uno.action='pagi_inter.php';
		uno.submit();
	}
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
	function abrir2(fec_var,hor_var,m,n) {
		
		uno.m.value=m;
		uno.n.value=n;
		uno.ghor_.value=hor_var;
		uno.gfec_.value=fec_var;
		uno.action='gen_rips_hospi.php';
		//alert(uno.gfec_.value);
		uno.submit();
	}
	function cargar(it,jt,mt)
	{
		uno.it.value=it;
		uno.jt.value=jt;
		uno.mcu.value=mt;
		//alert(uno.mt.value);
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
	
	function impri_ord(it,jt,mt)
	{
		uno.it.value=it;
		uno.jt.value=jt;
		uno.mcu.value=mt;
		//alert(uno.mt.value);
		uno.action='elim_ord.php';
		uno.submit();
	
	
	}
	
	function ord_imp(it,jt,mt)
	{
	
		uno.it.value=it;
		uno.jt.value=jt;
		uno.mcu.value=mt;
		//alert(uno.mt.value);
		uno.action='impr_ord0.php';
		uno.target='fr031';
		uno.submit();
	
	
	
	}
	function impr_piso(evol)
	{
		
		uno.iden_evo.value=evol;
		//alert(evol)
		uno.action='../uci/impr_ord.php';
		uno.target='fr031';
		uno.submit();
	
	
	
	}
	
	function carga2(are,idcta,vl)
	{
		if(idcta!='')
		{
			uno.ar_ci.value=are;
			uno.fin.value=vl;
			uno.idcita.value=idcta;
			uno.action='ing_infbd.php';
			uno.target='';
			uno.submit();
		
		}
		else
		alert('No se Agrego Cita');
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

	include('php/conexion.php');
	
		
	echo "<td><b>Identificacion:</td><td><input type=text name=ced_usu value=$ced_usu></td>";
	if(empty($esta_ncf))$esta_ncf=1;
	echo"<td><strong>Area:</td>
	<td  width=140 align=center>";
		echo "<select name='esta_ncf'>";
		echo "<option value='0'> </option>";
		echo "<option value='1'>Paciente Hospitalizado</option>";
		echo "<option value='2'>Pacientes Citados</option>";
		echo "<option value='3'>Programas Especificos</option>";
		echo "</select></td></td>";
	   			
	?><script language='Javascript'>uno.esta_ncf.value="<?echo $esta_ncf?>";</script>
	
	<!-- fecha de recepcion de Muetras -->
		<td   colspan=2><strong> Fecha:</strong></td><td colspan='3'>
		<!-- formulario con el campo de texto y el botn para lanzar el calendario--> 
		<?php    echo "<input type=text name=fin id=fin size='10' value= >";?>
		<input type="button" id="lanzador1" value="..." />
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField     :    "fin",     // id del campo de texto 
		ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
		button     :    "lanzador1"     // el id del botn que lanzar el calendario 
		}); 
		</script> 
		<script language=javascript>uno.fin.value="<?echo $fin?>";</script>

	
	<?
	 echo "<td><input type=button value=Buscar onclick='busca()'></td></tr>";
	 //echo $esta_ncf;
	if($esta_ncf=='1')
	{
		echo"<br><table class='Tbl2'border=0>
		<tr>         
		<th class='Th0'>SELECCIONAR</th>
		<th class='Th0'>DOCUMENTO</th>
		<th class='Th0'>NOMBRE</th>         
		<th class='Th0'>EDAD</th> 
		<th class='Th0'>EPS</th> 
		 
		</TR>
		<tr>   	 
		<th height=12></th>
		</TR>";
		//AND hist_var.esta_lis='0'
		//$condicion="ucontrato.ESTA_UCO='AC' AND hist_traza.id_ing Is Not Null AND hist_traza.horas_tra=-1 AND hist_var.esta_var='SO' AND cups.artic_cup='19'";
		$condicion="AND hist_traza.horas_tra=-1 AND hist_var.esta_var='SO' AND cups.artic_cup='19'";
		//$condicion="fech_var>='2017-08-31' AND esta_var='SO' AND artic_cup='19'";
		
		if((!empty($ced_usu))) 
		{
			$condicion=$condicion.' AND NROD_USU='.$ced_usu;
		}	
			$fecha=date("Y-m-d");
			$fech=date("Y-m-d",strtotime($fecha."- 180 days"));
		
			$cons="SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, 
			usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, Max( usuario.CODI_USU ) AS MxDeCODI_USU,
                  contrato.CODI_CON,contrato.NEPS_CON, ingreso_hospitalario.fecin_ing,hist_evo.iden_evo,hist_var.iden_var,hist_var.hora_var,hist_var.esta_lis 
			FROM usuario
			INNER JOIN ucontrato AS ucontrato ON usuario.CODI_USU=ucontrato.CUSU_UCO
			INNER JOIN contrato AS contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
			INNER JOIN ingreso_hospitalario AS ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing
			INNER JOIN hist_evo AS hist_evo ON hist_evo.id_ing = ingreso_hospitalario.id_ing
			INNER JOIN hist_var AS hist_var ON hist_evo.iden_evo = hist_var.iden_evo
			INNER JOIN hist_traza AS hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing
			INNER JOIN cups AS cups ON hist_var.iden_ser = cups.codigo
			WHERE ingreso_hospitalario.fecin_ing>='$fech' $condicion
			GROUP BY usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, ingreso_hospitalario.fecin_ing";
			
			
			/*$cons="SELECT usuario.CODI_USU, usuario.NROD_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.CODI_CON, contrato.NEPS_CON, ingreso_hospitalario.fecin_ing, hist_evo.iden_evo, hist_var.esta_var, hist_var.hora_var, hist_var.esta_lis, hist_traza.horas_tra, cups.artic_cup
			FROM ((((contrato INNER JOIN (usuario INNER JOIN ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) ON contrato.CODI_CON = ingreso_hospitalario.contra_ing) INNER JOIN hist_evo ON ingreso_hospitalario.id_ing = hist_evo.id_ing) INNER JOIN hist_var ON hist_evo.iden_evo = hist_var.iden_evo) INNER JOIN hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing) INNER JOIN cups ON hist_var.iden_ser = cups.codigo
			WHERE $condicion
			GROUP BY usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, ingreso_hospitalario.fecin_ing";*/
			/*$cons="SELECT CODI_USU,NROD_USU,PNOM_USU,SNOM_USU,PAPE_USU,SAPE_USU,FNAC_USU,NEPS_CON,iden_var,iden_evo,contra_ing,fech_var,hora_var,esta_var
			FROM vista_ordenes_hosp
			WHERE $condicion";*/
			//echo $cons;
			$cons=mysql_query($cons);
			$i=0;
			while ($rowx=mysql_fetch_array($cons))
			{
					  $codusu=$rowx['CODI_USU'];
					  $cod_usu=$rowx['CODI_USU'];
					  $fnac=$rowx['FNAC_USU'];
					  $neps_con=$rowx['NEPS_CON'];
					  $iden_var=$rowx['iden_var'];					  
					  $iden_evo1=$rowx['iden_evo'];
					  $ctr_usu=$rowx['contra_ing'];
					  $hor_usu=$rowx['hora_var'];
					  //echo $ctr_usu;
					  
					  $edad=calcuedad($fnac);
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
					  
					  $coning=mysql_query("SELECT id_ing FROM hist_evo where iden_evo=$iden_evo1");
					  $rowing=mysql_fetch_array($coning);
					  $idn_ing=$rowing['id_ing'];
					  //echo $idn_ing;
					
					  
					  echo"<th class='Td0'>$rowx[NROD_USU]</td>";
					  echo "<th class='Td0'>$rowx[PNOM_USU] $rowx[SNOM_USU] $rowx[PAPE_USU] $rowx[SAPE_USU]</td>";
					  echo"<th class='Td0'>$edad</td>";
					  echo"<th class='Td0'>$neps_con</td>";
					  //echo"<th class='Td0'></td>";
					 // echo"<th class='Td0'>$rowx[cama] - $rowx[area]</td>";
					  
				
					  echo"</tr>";
					 $j=0;
					if($valor==1)
					{ 
						
						$consciru="SELECT hist_var.iden_var,hist_var.hora_var,hist_var.fech_var,cups.descrip,hist_evo.iden_evo,hist_evo.cod_medi,hist_var.nord_var
						FROM  hist_var AS hist_var
						INNER JOIN hist_evo AS hist_evo ON hist_var.iden_evo=hist_evo.iden_evo
						INNER JOIN cups AS cups ON hist_var.iden_ser = cups.codigo						
						WHERE hist_evo.id_ing= $idn_ing AND hist_var.esta_var='SO' AND  cups.artic_cup ='19' 
						GROUP BY hist_var.iden_evo";
						//echo "<br>".$consciru;
						$consciru=mysql_query($consciru);
						
						
						while($rowciru=mysql_fetch_array($consciru))
						{
							 
							  $nomayuda=$rowciru['descrip'];
							  $registro=$rowciru['iden_var'];
							  $codayuda=$row3['iden_ser'];
							  $iden_evo=$rowciru['iden_evo'];		  
							  $fecha_vari=$rowciru[fech_var];
							  $hora_vari=$rowciru[hora_var];
							  //$nord_var =$rowciru[nord_var];
							  echo"<tr align='center' >";
							  $nomvar2='codchk2'.$i.$j;
							  $valor2=$$nomvar2;
							 
													
							
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
							
							$nomvar='ctr_usu'.$i.$j;
							echo "<input type=hidden name=ctr_usu value='$ctr_usu'>";
										
												
							$nomvar2='fech'.$i.$j;
							$rot=$$nomvar2;
							$nomvar3='usu'.$i.$j;
							$rot2=$$nomvar3;
							
							
							$nomvar2='num_fac'.$i.$j;
							
							echo "</tr>";
							
							$bord=mysql_query("SELECT Max(hist_var.nord_var) AS MxDenord_var, hist_var.nord_var
							FROM hist_var INNER JOIN cups ON hist_var.iden_ser = cups.codigo
							WHERE hist_var.iden_evo='$iden_evo' AND cups.artic_cup='19' AND hist_var.esta_var='SO'
							GROUP BY hist_var.nord_var");
							$mcu=1;
							while($rord=mysql_fetch_array($bord))
							{
								$nord_var=$rord[nord_var];
								//echo $nord_var;
								$nomvar='nord_var'.$i.$j.$mcu;
								$$nomvar=$nord_var;
								//echo "<input type=hidden name=$nomvar value=$nord_var>";
								
							}
							
							
							
							$consdes=mysql_query("SELECT cups.codigo,cups.descrip,hist_evo.id_ing,hist_var.iden_var
							FROM cups AS cups
							INNER JOIN hist_var AS hist_var ON cups.codigo=hist_var.iden_ser
							INNER JOIN hist_evo AS hist_evo ON hist_var.iden_evo=hist_evo.iden_evo
							WHERE hist_var.iden_evo=$iden_evo AND hist_var.esta_var='SO' AND cups.artic_cup='19'");
							 //echo $consdes;
							
							while($rowdes=mysql_fetch_array($consdes))
							{
								$desc=$rowdes['descrip'];
								$cod=$rowdes['codigo'];
								$idein=$rowdes['id_ing'];
								
								$iden_var=$rowdes['iden_var'];

								$nomvar='iden_evo'.$i.$j.$mcu;
								echo "<input type=hidden name=$nomvar value=$iden_evo>";
																
								$nomvar='cod'.$i.$j.$mcu;
								echo "<input type=hidden name=$nomvar value=$cod>";
								
								$nomvar='selec'.$i.$j.$mcu;									
								echo "<input type=hidden name=$nomvar value=1>";
								
								$nomvar='iden_var'.$i.$j.$mcu;									
								echo "<input type=hidden name=$nomvar value=$iden_var>";
								
								$nomvar='idein'.$i.$j.$mcu;									
								echo "<input type=hidden name=$nomvar value=$idein>";
								
								$cql[$mcu]=$desc;
						   
					
								$mcu++;
							}
								echo"<td colspan=2 align=right></td>";
									
									echo "<td align='left'><span class='tm1'><a href='#' onclick='cargar($i,$j,$mcu)'>$iden_evo - $fecha_vari -  $hora_vari</span></a></td>";
									echo"<th class='Td0'><a href='#' onclick='impr_piso($iden_evo)'><img src='icons/32px-Crystal_Clear_app_kjobviewer.png' border=0 width=20 height=20 alt='Imprimir' ></a></td></tr>";
									echo"<td align='left'><a href='#' onclick='impri_ord($i,$j,$mcu)'><img src='icons/btn_remove-selected_bg.gif' border=0 width=18 height=18 alt='Eliminar' ></a></td></tr>";
									//echo"<th class='Td0'><a href='#' onclick='impr_piso($iden_evo)'><img src='icons/32px-Crystal_Clear_app_kjobviewer.png' border=0 width=20 height=20 alt='Imprimir' ></a></td></tr>";
									//echo"<td align='left'><a href=elim_ord.php?iden_evo=$iden_evo&id_ing=$idn_ing&codusu=$codusu ><img src='icons/btn_remove-selected_bg.gif' border=0 width=18 height=18 alt='Eliminar' ></a></td></tr>";
									for($g=0;$g<$mcu;$g++)
									{
										$cql2=$cql[$g];
										echo "<tr><td colspan=2 align=right></td>";
										echo "<td colspan=4 align=left>$cql2 </td></tr>";
									}
									echo "</tr>";
									
							$j++;
					     //}
					}
						
				}		  	  
				
				$i++;
			}
				echo "<input type=hidden name=it>";
				echo "<input type=hidden name=mcu>";
				echo "<input type=hidden name=jt>";
			
		
    }		
	
		////////////////////////////////LABORATORIOS CITADOS
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
		$condicion=" ucontrato.ESTA_UCO='AC' AND areas.cod_areas = '80' AND citas.Clase_citas <'6'  AND ISNULL(citas.rips_citas) AND citas.Esta_cita <>'5' AND citas.prog_citas=''";
		
		if((!empty($ced_usu))) 
		{
			$condicion=$condicion.' AND usuario.NROD_USU='.$ced_usu;
		}	
					
			/*$cad="SELECT  usuario.codi_usu,usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU,citas.rips_citas, 
            usuario.CODI_USU,horarios.fecha_horario, horarios.hora_horario, citas.id_cita,citas.idusu_citas,citas.prog_citas,contrato.CODI_CON,contrato.NEPS_CON
			FROM ((ane_lab_cit 
            INNER JOIN (citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON ane_lab_cit.cod_cita = citas.id_cita) 
			INNER JOIN ((usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) 
			INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON) ON citas.Idusu_citas = usuario.CODI_USU) 
			INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas
			WHERE $condicion AND horarios.fecha_horario>='$fin' AND horarios.fecha_horario<='$fin'  
			ORDER BY horarios.Hora_horario";*/

			/*
			
			$cad="SELECT usuario.codi_usu, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, citas.rips_citas, usuario.CODI_USU, horarios.fecha_horario, horarios.hora_horario, citas.id_cita, citas.idusu_citas, citas.prog_citas, contrato.CODI_CON, contrato.NEPS_CON
			FROM contrato INNER JOIN (((ane_lab_cit INNER JOIN (citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON ane_lab_cit.cod_cita = citas.id_cita) INNER JOIN (usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) ON citas.Idusu_citas = usuario.CODI_USU) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) ON contrato.CODI_CON = citas.Cotra_citas
			WHERE $condicion AND horarios.fecha_horario='$fin'  
			ORDER BY horarios.Hora_horario";
			*/
			
			$cad="SELECT usuario.codi_usu, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, citas.rips_citas, usuario.CODI_USU, horarios.fecha_horario, horarios.hora_horario, citas.id_cita, citas.idusu_citas, citas.prog_citas, contrato.CODI_CON, contrato.NEPS_CON
FROM contrato INNER JOIN (((ane_lab_cit RIGHT JOIN (citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON ane_lab_cit.cod_cita = citas.id_cita) INNER JOIN (usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) ON citas.Idusu_citas = usuario.CODI_USU) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) ON contrato.CODI_CON = citas.Cotra_citas
			WHERE $condicion AND horarios.fecha_horario='$fin'  
			ORDER BY horarios.Hora_horario";
			//echo $cad;
			echo"<tr bgcolor=#FEE9BC>";
			echo"<th class='Td0' align=center>$fec_hor</th>";
			echo"<input type=hidden name=norden value=$norden>";
			$resul=Mysql_query($cad);
			//if(!$resul)echo 'no hay consulta';
			$num=Mysql_num_rows($resul);	
			$i=0;	
			/*while($row = mysql_fetch_array($resul))
			{			
				$ide_cita=$row['id_cita'];
				$ingreso=$row['MxDeid_ing'];
				$cod_usu=$row['codi_usu'];	
				//echo 'cita'.$ide_cita;
				$cedula=$row['NROD_USU'];	
				$nombre=$row['PNOM_USU'].' '.$row['SNOM_USU'].' '.$row['PAPE_USU'].' '.$row['SAPE_USU'];
				$fnac=$row['FNAC_USU'];
				$edad=calcuedad($fnac);
				$codi_con=$row['CODI_CON'];
				$estado=$row['ESTA_UCO'];
				$ncontra=$row['NEPS_CON'];		
				$nom_medi=$row[''];		
				$fec_hor=substr($row['Hora_horario'],10,6);
				$nomarea=$row['nom_areas'];		
				$nomvar="selec".$i;		
				$seleccionar=$$nomvar;		
				$fecing=$fechaing.' '.$horain;		
                                
                           	
                                
				$nomvar='ncontra'.$i;
				echo "<input type=hidden name='$nomvar' value='$ncontra'>";					
				$nomvar='nombre'.$i;
				echo "<input type=hidden name='$nomvar' value='$nombre'>";		
				$nomvar='estado'.$i;
				echo "<input type=hidden name='$nomvar' value='$estado'>";		
				$nomvar='cedula'.$i;
				echo "<input type=hidden name='$nomvar' value='$cedula'>";
				$nomvar='edad'.$i;
				echo "<input type=hidden name='$nomvar' value='$edad'>";	
				$nomvar='norden'.$i;
				echo "<input type=hidden name='$nomvar'>";	
				//$nomvar='id_cita'.$i;
				//echo "<input type=hidden name='$nomvar' value='$ide_cita'>";	
				/*
                    $cons_ref=mysql_query("SELECT detareferencia.codi_dre, cups.descrip, cups.codigo,referencia.codi_cita,detareferencia.tipo_dre,detareferencia.alse_dre
					FROM referencia INNER JOIN (detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo)
					ON referencia.idre_ref = detareferencia.idre_dre
					WHERE (((detareferencia.cita_dre)='$ide_cita'))
					GROUP BY detareferencia.codi_dre, cups.descrip, cups.codigo");
					
				//echo $cons_ref;
				$vl_ayd=0;
				while($rowdes=mysql_fetch_array($cons_ref))
				{
					$desc=$rowdes['descrip'];
					$cod=$rowdes['codigo'];
					$codi_cita=$rowdes['iden_cita'];
					$are_sol=$rowdes['alse_dre']; 
                                        //echo $are_sol;
					
					$area=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des=$are_sol");
					$sql_are=mysql_fetch_array($area);
					$nom=$sql_are[nomb_des];
				   
					$nomvar='selec'.$vl_ayd;									
                                        echo "<input type=hidden name=$nomvar value=1>";

					$nomvar='cod'.$vl_ayd;
					echo"<input type=text name=$nomvar value=$cod>";
					
					$nomvar='area'.$vl_ayd;
					echo"<input type=hidden name=$nomvar value=$are_sol>";

					

					 $vl_ayd++;
				}
				*/
				/*echo"<tr bgcolor=#FEE9BC>";
				//echo"<input type=text name=ide_cita value='$ide_cita'>";
				echo"<th class='Td0' align='center'><input type=text name=ide_cita value='$ide_cita'></th>";
				echo"<th class='Td0'><b><input type=text name='cod_usu' value='$cod_usu'>$cedula</th>		
				<th class='Td0'><b>$nombre</th>
				<th class='Td0'><b>$edad</th>
				<th class='Td0'><b><input type=hidden name=contrato value='$codi_con'>$ncontra</th>";
                 echo "<input type=hidden name=fin value='$vl_ayd'>";
				//echo "<a href='#' onclick='ord_imp($i,$j,$mcu)'>";
				echo"<th class='Td0'><b><a href='#' onclick='env_ord($i,$cod_usu,$codi_con,$ide_cita)'><img src='imagenes/search.gif' width=15 alt='Rips'></a></th>";
				//echo"<th class='Td0'><b><a href='ing_rip.php?codig_usu=$codusu&area=01&ide_cita=$ide_cita&contrato=$CODI_CON&contr=1&cod_usu=$cedula&bd=1'><img src='imagenes/search.gif' width=15 alt='Rips'></a>";
				echo"</tr>";
                                $i++;
				
		}
			
	}
        echo"</table>";*/
		//VERSION ANTIGUA
			while($row = mysql_fetch_array($resul))
			{					
				$ide_cita=$row['id_cita'];
				$ingreso=$row['MxDeid_ing'];
				$codusu=$row['codi_usu'];	
				$cod_usu=$row['codi_usu'];
				//echo 'cita'.$ide_cita;
				$cedula=$row['NROD_USU'];	
				$nombre=$row['PNOM_USU'].' '.$row['SNOM_USU'].' '.$row['PAPE_USU'].' '.$row['SAPE_USU'];
				$fnac=$row['FNAC_USU'];
				$edad=calcuedad($fnac);
				$CODI_CON=$row['CODI_CON'];
				$contr_=$row['CODI_CON'];
				//echo $codi_con;
				$estado=$row['ESTA_UCO'];
				$ncontra=$row['NEPS_CON'];		
				$nom_medi=$row[''];		
				$fec_hor=substr($row['Hora_horario'],10,6);
				$nomarea=$row['nom_areas'];		
				$nomvar="selec".$i;		
				$seleccionar=$$nomvar;		
				$fecing=$fechaing.' '.$horain;		
				$nomvar='ncontra'.$i;
				$rips_citas=$row['rips_citas'];
				
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
				echo"<th class='Td0' align=center>CITA:$ide_cita</th>";
				echo"<th class='Td0'><b>$cedula</th>		
				<th class='Td0'><b>$nombre</th>
				<th class='Td0'><b>$edad</th>
				<th class='Td0'><b>$ncontra</th>";
				
				$cons_ref="SELECT detareferencia.codi_dre, cups.descrip, cups.codigo,referencia.codi_cita,detareferencia.tipo_dre,detareferencia.alse_dre
				FROM referencia INNER JOIN (detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo)
				ON referencia.idre_ref = detareferencia.idre_dre
				WHERE (((detareferencia.cita_dre)='$ide_cita'))
				GROUP BY detareferencia.codi_dre, cups.descrip, cups.codigo";
				//echo "<br>".$cons_ref;
				$cons_ref=mysql_query($cons_ref);
				
				if(mysql_num_rows($cons_ref)<>0)
				{
					echo"<th class='Td0'><b><a href='ing_cups.php?codig_usu=$codusu&area=01&ide_cita=$ide_cita&contrato=$CODI_CON&contr=1&cod_usu=$cedula&bd=1'><img src='imagenes/search.gif' width=15 alt='Rips'></a>";
					echo"<th class='Td0'><b><a href='#' onclick='env_ord($i,$cod_usu,\"$contr_\",$ide_cita)'><img src='icons/bien.png' width=15 alt='con cita'></a>";
					
					//echo"<img src='icons/bien.png' width=15 alt='con cita'></th>";
					
				}	
				else
				{
					echo"<th class='Td0'><b><a href='ing_cups.php?codig_usu=$codusu&area=01&ide_cita=$ide_cita&contrato=$CODI_CON&contr=1&cod_usu=$cedula&bd=1'><img src='imagenes/search.gif' width=15 alt='Rips'></a>";
					echo"</tr>";	
                }

				$i++;
		}
			
	}
        /////////////////////////////////LABORATORIO PYP////////////////////////////////
	if($esta_ncf=='3')
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
		$condicion=" ucontrato.ESTA_UCO='AC' AND areas.cod_areas = '80' AND citas.Clase_citas < '6'  AND ISNULL(citas.rips_citas) AND citas.Esta_cita <>'5'";
		
		if((!empty($ced_usu))) 
		{
			$condicion=$condicion.' AND usuario.NROD_USU='.$ced_usu;
		}	
					
			$cad="SELECT  usuario.codi_usu,usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, 
                        usuario.CODI_USU,horarios.fecha_horario, horarios.hora_horario, citas.id_cita,citas.idusu_citas,citas.prog_citas,contrato.CODI_CON,contrato.NEPS_CON
			FROM ((ane_lab_cit 
                        INNER JOIN (citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON ane_lab_cit.cod_cita = citas.id_cita) 
			INNER JOIN ((usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) 
			INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON) ON citas.Idusu_citas = usuario.CODI_USU) 
			INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas
			WHERE $condicion AND horarios.fecha_horario>='$fin' AND horarios.fecha_horario<='$fin'  
			ORDER BY horarios.Hora_horario";
	
			//echo $cad;
			echo"<tr bgcolor=#FEE9BC>";
			echo"<th class='Td0' align=center>$fec_hor</th>";
			echo"<input type=hidden name=norden value=$norden>";
			$resul=Mysql_query($cad);
			//if(!$resul)echo 'no hay consulta';
			$num=Mysql_num_rows($resul);	
			$i=0;	
			while($row = mysql_fetch_array($resul))
			{			
				$ide_cita=$row['id_cita'];
				$ingreso=$row['MxDeid_ing'];
				$codusu=$row['codi_usu'];	
				//echo 'cita'.$codusu;
				$cedula=$row['NROD_USU'];	
				$nombre=$row['PNOM_USU'].' '.$row['SNOM_USU'].' '.$row['PAPE_USU'].' '.$row['SAPE_USU'];
				$fnac=$row['FNAC_USU'];
				$edad=calcuedad($fnac);
				$CODI_CON=$row['CODI_CON'];
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
                                $ex_pyp=$row[prog_citas];
                                //echo $ex_pyp;
                                if(($ex_pyp=='4'))
                                {   
                                    $idcit=("SELECT id_cita, consul_cita, descrip_estaci, Esta_cita, nom_areas, nom_medi, citas.Clase_citas, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, citas.Idusu_citas, citas.Esta_cita,referencia.codi_cita
                                    FROM esta_cita, horarios, citas, areas, medicos,referencia
                                    WHERE cod_estaci = citas.Esta_cita
                                    AND Idusu_citas ='$codusu'
                                    AND Esta_cita ='2'
                                    AND Cserv_horario ='82'
                                    AND horarios.ID_horario = citas.ID_horario
                                    AND cod_areas = Cserv_horario
                                    AND cod_medi = Cmed_horario
                                    AND referencia.codi_cita=citas.id_cita
                                    ORDER BY Fecha_horario DESC , Hora_horario");
                                 
                                    //echo $idcit;
                                    $ict=mysql_query($idcit);
                                    $rowct=mysql_fetch_array($ict);
                                    $idcta=$rowct[id_cita];
                                    //echo 'citas'.$idcta;
                                    
                                    echo"<th class='Td0' align=center><font face='arial' size='1' color=red> PYP!!!<font></th>";
                                    echo"<th class='Td0'><b>$cedula</th>		
                                    <th class='Td0'><b>$nombre</th>
                                    <th class='Td0'><b>$edad</th>
                                    <th class='Td0'><b>$ncontra</th>";
                                    
                                    $cons_ref=mysql_query("SELECT detareferencia.codi_dre, cups.descrip, cups.codigo,referencia.codi_cita
                                    FROM referencia INNER JOIN (detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo)
                                    ON referencia.idre_ref = detareferencia.idre_dre
                                    WHERE (((referencia.codi_cita)='$idcta') AND ((cups.tipo)='1803'))
                                    GROUP BY detareferencia.codi_dre, cups.descrip, cups.codigo");
									//echo $cons_ref;
                                    $vl_cit=0;
                                    while($rowdes=mysql_fetch_array($cons_ref))
                                    {
                                            $desc=$rowdes['descrip'];
                                            $cod=$rowdes['codigo'];
                                            $codi_cita=$rowdes['codi_cita'];

                                           
                                            $nomvar='selec'.$vl_cit;									
                                            echo "<input type=hidden name=$nomvar value=1>";

                                            $nomvar='cod'.$vl_cit;
                                            echo"<input type=hidden name=$nomvar value='$cod'>";


                                             $vl_cit++;
                                    }
                                    echo "<input type=hidden name=ide_cita value='$ide_cita'>";
                                    echo "<input type=hidden name=codig_usu value='$codusu'>";
                                    echo "<input type=hidden name=area value='01'>";
                                    echo "<input type=hidden name=contrato value='$CODI_CON'>";
                                    echo "<input type=hidden name=codig_usu value='$codusu'>";
                                    echo "<input type=hidden name=contr value='01'>";
                                    echo "<input type=hidden name=bd value='01'>";
                                    echo "<input type=hidden name=cod_usu value='$cedula'>";
                                    echo "<input type=hidden name=fin value='$vl_cit'>";
                                    
                                    
                                    //hay que pasarlo por submit/$idcta/$idcta,1,$vl_cit
                                    echo"<th class='Td0'><b> <a href='#' onclick='carga2(1,$idcta,$vl_cit)'><img src='imagenes/search.gif' width=15 alt='Rips'></a>";
                                    //echo"<th class='Td0'><b><a href='ing_infbd.php?codig_usu=$codusu&area=01&ide_cita=$idcta&contrato=$CODI_CON&contr=1&cod_usu=$cedula&bd=1&fin=$vl_cit'><img src='imagenes/search.gif' width=15 alt='Rips'></a>
                                    echo"</tr>";
                                }
                                echo"<tr bgcolor=#FEE9BC>";
                                if(($ex_pyp=='5'))
                                {   
                                    $idcit=("SELECT id_cita, consul_cita, descrip_estaci, Esta_cita, nom_areas, nom_medi, citas.Clase_citas, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, citas.Idusu_citas, citas.Esta_cita,enferm_cronicos.iden_cita
                                    FROM esta_cita, horarios, citas, areas, medicos, enferm_cronicos
                                    WHERE cod_estaci = citas.Esta_cita
                                    AND Idusu_citas ='$codusu'
                                    AND Esta_cita ='1'
                                    AND Cserv_horario ='81'
                                    AND horarios.ID_horario = citas.ID_horario
                                    AND cod_areas = Cserv_horario
                                    AND cod_medi = Cmed_horario
                                    AND enferm_cronicos.iden_cita=citas.id_cita
                                    ORDER BY Fecha_horario DESC , Hora_horario");
                                 
                                    //echo $idcit;
                                    $ict=mysql_query($idcit);
                                    $rowct=mysql_fetch_array($ict);
                                    $idcta=$rowct[iden_cita];
                                    
                                    
                                    echo"<th class='Td0' align=center><font face='arial' size='1' color=red> Cronicos!!!<font></th>";
                                    echo"<th class='Td0'><b>$cedula</th>		
                                    <th class='Td0'><b>$nombre</th>
                                    <th class='Td0'><b>$edad</th>
                                    <th class='Td0'><b>$ncontra</th>";
                                    
                                    $cons_ref=Mysql_query("SELECT cups.codigo, cups.descrip, enferm_cronicos.iden_cita
                                    FROM (enferm_cronicos INNER JOIN ayudasdiagnosticas ON enferm_cronicos.hist_crn = ayudasdiagnosticas.numc_adx
                                    INNER JOIN cups ON ayudasdiagnosticas.coda_adx = cups.codigo)
                                    WHERE enferm_cronicos.iden_cita ='$idcta' AND cups.tipo='1803'
                                    GROUP BY cups.descrip, cups.codigo");
                                    
                                    //echo $cons_ref;
                                    $vl_ayd=0;
                                    while($rowdes=mysql_fetch_array($cons_ref))
                                    {
                                            $desc=$rowdes['descrip'];
                                            $cod=$rowdes['codigo'];
                                            $codi_cita=$rowdes['iden_cita'];

                                           
                                            $nomvar='selec'.$vl_ayd;									
                                            echo "<input type=hidden name=$nomvar value=1>";

                                            $nomvar='cod'.$vl_ayd;
                                            echo"<input type=hidden name=$nomvar value=$cod>";


                                             $vl_ayd++;
                                    }
                                    echo "<input type=hidden name=ide_cita value='$ide_cita'>";
                                    echo "<input type=hidden name=codig_usu value='$codusu'>";
                                    echo "<input type=hidden name=area value='01'>";
                                    echo "<input type=hidden name=contrato value='$CODI_CON'>";
                                    echo "<input type=hidden name=codig_usu value='$codusu'>";
                                    echo "<input type=hidden name=contr value='01'>";
                                    echo "<input type=hidden name=bd value='01'>";
                                    echo "<input type=hidden name=cod_usu value='$cedula'>";
                                    echo "<input type=hidden name=fin2>";
                                    
                                    
                                    //hay que pasarlo por submit/$idcta/$idcta,2,$vl_ayd
                                    echo"<th class='Td0'><b> <a href='#' onclick='carga2(2,$idcta,$vl_ayd)'><img src='imagenes/search.gif' width=15 alt='Rips'></a>";
                                    //echo"<th class='Td0'><b><a href='ing_infbd.php?codig_usu=$codusu&area=01&ide_cita=$idcta&contrato=$CODI_CON&contr=1&cod_usu=$cedula&bd=1&fin=$vl_cit'><img src='imagenes/search.gif' width=15 alt='Rips'></a>
                                    echo"</tr>";
                                }
                              
			$i++;	
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
	<td align=center height=24><a href='fondo1.htm' target=''><img src='icons/feed_delete.png' width=20 alt='Cancelar'><br><br><b>Cancelar</b></a></td>		
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
		echo "<input type=hidden name=idcita>";
		echo "<input type=hidden name=ide_cita value='$ide_cita'>";
		echo "<input type=hidden name=m>";	
		echo "<input type=hidden name=n>";
        echo "<input type=hidden name=ite>";
		echo "<input type=hidden name=ar_ci>";
        echo "<input type=hidden name=codiusua>";
		echo "<input type=hidden name=ctr>";
		echo "<input type=hidden name=iden_evo>";
		// echo "<input type=hidden name=esta_ncf>";
?>
</BODY>
</HTML>