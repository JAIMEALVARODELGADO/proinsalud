<?	
	session_register('paciente');
	session_register('gauditor');
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="JavaScript">
	function valida()
	{		
		//alert('si');
		uno.histor.value='-1';
		uno.action='impr_adicional.php';
		uno.target='';
		uno.submit();
		//alert(uno.concon.value)
		
		if(uno.imapro.value==1 || uno.labpro.value==1 || uno.rempro.value==1 || uno.lecpro.value==1)
		{		
			if(uno.areaanes.value!='62')
			{
				uno.action='../procedimientos/impre_procedimiento.php';
				uno.target='_blank';
				uno.submit();
			}
		}			
		
		if(uno.concon.value=='1')
		{			
			if(uno.areaanes.value=='62')
			{	
				uno.action='impre_histoanest1.php';
			}
			else
			{	
				uno.action='impre_histo.php';
			}	
		}
		if(uno.concon.value=='2')
		{
			if(uno.areaanes.value=='62')
			{
				uno.action='impre_histoanest1.php';
			}
			else
			{	
				uno.action='impre_histo_espe.php';
			}	
		}
		uno.target='TOP';
		uno.submit();
	}
	function busca()
	{		
		if(event.KeyCode==13)
		{
			uno.histor.value='';
			uno.action='impr_adicional.php';
			uno.target='';
			uno.submit();
		}
	}
	function ver()
	{		
		if(uno.ima.checked==true ||  uno.lab.checked==true || uno.rem.checked==true || uno.med.checked==true || uno.his.checked==true || uno.forpos.checked==true || uno.solqui.checked==true || uno.inca.checked==true || uno.reco.checked==true  || uno.conseinfanes.checked==true)
		{
			document.getElementById("vista").style.visibility="visible";			
		}
		else
		{
			document.getElementById("vista").style.visibility="hidden";				
		}		
	}
	function bushis(op,num,con,apli,usu)
	{		
		if(op==1)
		{			
			if(apli=='1')
			{				
				uno.concon.value=con;
				uno.histor.value='1';
				uno.numhisto.value=num;
				uno.action='impr_adicional.php';
				uno.target='';
				uno.submit();
			}
			if(apli=='2')
			{				
				uno.serie.value=num;
				uno.target='top';
				uno.action='impre_consul.php';
				uno.submit();
			}
			if(apli=='3')
			{				
				//alert(usu);
				window.open('../historias/frm_imprevio.php?numhisto='+num+'&cod_usu='+usu, "TOP", "Scrollbars=YES,height=700,width=700");
			}
			if(apli=='4')
			{				
				//alert(usu);
				window.open('../consulta/consulta/impre_histo0.php?numhisto='+num+'&cod_usu='+usu+'&regresa=S', "TOP", "Scrollbars=YES,height=700,width=700");
			}
		}
		if(op==2)
		{
			uno.numtriage.value=num;
			uno.action='impre_triage1.php';
			uno.target='top';
			uno.submit();
		}
	}
	function sale()
	{
		uno.histor.value='';
		uno.action='impr_adicional.php';
		uno.target='';
		uno.submit();
	}
	function VerHistoria(hist,pagina) 
    {        
       // var miForm = document.forms[0];        
        uno.num_hist.value= hist;//tip_hist        
        uno.action = pagina;//'historia_alteracionesAdulto/frm_impreprov.php';        
        uno.target = "_PARENT";
        uno.method = "POST";		
        uno.submit();        
    }
	function salir(his,tip) 
	{
		
		uno.numhisto.value=his;
		uno.target='TOP';
		if(tip=='CONSULTA')
		{
			uno.action="../salud_ocupacional/imprimirhis.php";
		}
		if(tip=='CONSULTA_FUN')
		{
			uno.action="../salud_ocupacional/imprimirhis_fun.php";			
		}
		if(tip=='EVOLUCION')
		{
			uno.action="../salud_ocupacional/imprimirevo.php";			
		}
		uno.submit();
	}
	
</script>
</head>	
<body >
<style>
#conte {
overflow:auto;
height: 326px;
width: 930px;
padding:5px;
margin:0 auto;
background-color: #FFFFFF;
font-size: 8px;
}

</style> 
<?	
	
	if(empty($tipo))$tipo=1;
	echo"<form name=uno method=post>
	<input type=hidden name=numtriage>
	<input type=hidden name=num_hist>
	<input type=hidden name=serie>
	<input type=hidden name=ori value='1'>
	<input type=hidden name=concon value='$concon'><input type=hidden name=numhisto value='$numhisto'>
	
	<br><br>
	<table align=center class='tbl' width='930'>
	<tr>
	<th colspan=2 align=center>NUMERO DE CEDULA <input type=text class='caja' name=cedula size=20 onkeypress='busca()' value='$cedula'><font color='#E3E3ED'>...............</font> 
	tipo de busqueda
	<select name=tipo class='caja' onchange='sale()'>";
	if($tipo==1)
	{
		echo"<option value=1 selected>CONSULTA</option>
		<option value=2>TRIAGE</option>
		<option value=3>HISTORIA LABORAL</option>
		";
	}
	else if($tipo==2)
	{
		echo"<option value=1>CONSULTA</option>
		<option value=2 selected>TRIAGE</option>
		<option value=3>HISTORIA LABORAL</option>";
	}	
	else if($tipo==3)
	{
		echo"<option value=1>CONSULTA</option>
		<option value=2>TRIAGE</option>
		<option value=3 selected>HISTORIA LABORAL</option>";
	}	
	ECHO"</select></th>
	</tr>
	</table>";	
	include ('php/conexion1.php');
	echo"<input type=hidden name=histor>";
	
	
	if(!empty($gauditor) && !empty($cedula))
	{
		$baudi=mysql_query("SELECT ucontrato.IDEN_UCO
		FROM (usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) INNER JOIN usuario_auditor ON ucontrato.CONT_UCO = usuario_auditor.codi_con
		WHERE (((usuario.NROD_USU)='$cedula') AND ((usuario_auditor.ide_usua)='$gauditor') AND ((ucontrato.ESTA_UCO)='AC'))");
		if(mysql_num_rows($baudi)==0)
		{
			ECHO "<br><center><h3>El usuario no existe o el auditor no tiene acceso al contrato</h3> </center>";
			exit();
		}
	}
	
	
	
	
	$bcod=mysql_query("select CODI_USU from usuario WHERE NROD_USU = '$cedula'");
	while($rcod=mysql_fetch_array($bcod))
	{
		$codigousu=$rcod['CODI_USU'];
		//echo "<input type=text name=cod_usu value='$codigousu'>";
	}
	if(!empty($codigousu))
	{
		if($tipo==1)
		{
			if($cedula!='')
			{
				$bushisto=mysql_query("SELECT encabesadohistoria.nomb_ehi, encabesadohistoria.idus_ehi, encabesadohistoria.cous_ehi, encabesadohistoria.numc_ehi, consultaprincipal.feca_cpl, consultaprincipal.hora_cpl, consultaprincipal.area_cpl, areas.nom_areas, medicos.nom_medi, consultaprincipal.codi_cpl, 
				consultaprincipal.come_cpl, consultaprincipal.inca_cpl, consultaprincipal.vers_apli, 
				consultaprincipal.cod_actpyp FROM ((encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) 
				 INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi) 
				 INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas WHERE (((encabesadohistoria.cous_ehi)='$codigousu'))
				ORDER BY consultaprincipal.feca_cpl DESC , consultaprincipal.hora_cpl DESC");
				
				$k=0;
				while($rhi=mysql_fetch_array($bushisto))
				{
					$nhisto=$rhi['numc_ehi'];
					$medico=$rhi['nom_medi'];
					$area=$rhi['nom_areas'];
					$fecha=$rhi['feca_cpl'];
					$hora=$rhi['hora_cpl'];
					$ticon=$rhi['codi_cpl'];
					$cmedi=$rhi['come_cpl'];
					$version=$rhi['vers_apli'];
					$codpyp=$rhi['cod_actpyp'];
					$nomusu=$rhi['nomb_ehi'];
					
					if($k==0)
					{						
						echo"<br>
						<center>$nomusu</center>
						<br>
						<table align=center>
						<tr><td>";
						echo"<div id='conte'>
						<table align=center class='tbl' width='900px'>";
						echo"						
						<tr>
						<th>HISTORIA</th>
						<th>FECHA</th>
						<th>HORA</th>
						<th>MEDICO</th>
						<th>AREA</th>
						<th>VERSION</th>
						</tr>";
					}
					if($codpyp!=NULL)
					{						
						$sql_actpyp = "SELECT pyp_programas.nom_pro, pyp_actividades.nom_act, pyp_actividades.cod_act
						FROM pyp_actividades INNER JOIN pyp_programas ON pyp_actividades.cod_pro = pyp_programas.cod_pro
						WHERE (((pyp_actividades.cod_act)='$codpyp'));";
						$pagina = actividad_pyp($codpyp);
						if($codpyp=="19" || $codpyp=="105")
						{							
							$pagina_sume = "../pyp/historia_planificacionFamiliar/frm_imprenotasum.php";
							$sql_summed = "SELECT numc_ctrl FROM ctrpla_pyp WHERE mosu_ctrl != 'NULL' 
									   AND numc_ctrl = '$nhisto'";
							$res_summed = mysql_query($sql_summed);
							
							if(mysql_num_rows($res_summed)>0)//mysql_num_rows($res_summed)>0);                                            
							{
								$impres_sume= "<br/><a href='javascript:void(0);' onclick='VerHistoria(\"$nhisto\",\"$pagina_sume\")'>Nota de Enfermeria</a>";
							}
							else
							{
								$impres_sume = "";
							}
						}
						
						$res_actpyp = mysql_query($sql_actpyp);
						while($row_actpyp = mysql_fetch_array($res_actpyp))
						{
							
							$nom_prg=$row_actpyp['nom_pro'];
							$nom_act=$row_actpyp['nom_act'];
							$nom_def = "<span style='font-size:9px'>$nom_prg<br/>$nom_act $impres_sume</span>";
							
							echo"
							<tr>
							<td><a href='#' onclick='VerHistoria(\"$nhisto\",\"$pagina\")'>$con - $nhisto</a></td>
							<td><a href='#' onclick='VerHistoria(\"$nhisto\",\"$pagina\")'>$fecha</a></td>
							<td><a href='#' onclick='VerHistoria(\"$nhisto\",\"$pagina\")'>$hora</a></td>
							<td><a href='#' onclick='VerHistoria(\"$nhisto\",\"$pagina\")'>$medico</a></td>
							<td><a href='#' onclick='VerHistoria(\"$nhisto\",\"$pagina\")'>$area</a></td>
							<td><a href='#' onclick='VerHistoria(\"$nhisto\",\"$pagina\")'>$vers</a></td>
							</tr>";
							
							/*
							$link = "<a href='javascript:void(0);' onclick='VerHistoria(\"$nhisto\",\"$pagina\")'>
							<img src='img/feed_go.png' border='0' />
							</a>
							</td>";
							*/ 
						}
					}
					else
					{						
						if($version=='5503')
						{
							$apli='1';
							$vers="NUEVA";
						}
						if($version=='5510')
						{
							$apli='2';
							$vers="ANTIGUA";
						}						
						if($version=='5502')
						{
							$apli='3';
							$vers="CRONICOS";
						}						
						if($version=='5513')
						{
							$apli='4';
							$vers="OFTALMOLOGIA";
						}
						$besp=mysql_query("SELECT medicos.cod_medi, destipos.nomb_des, destipos.homo3_des
						FROM medicos INNER JOIN destipos ON medicos.espe_med = destipos.codi_des
						WHERE (((medicos.cod_medi)='$cmedi'))");
						$nesp=mysql_fetch_array($besp);
						$tiespe=$nesp['homo3_des'];
						if($tiespe=='2' && $ticon=='2')$con='2';
						else $con='1';
						
						echo"
						<tr>
						<td><a href='#' onclick='bushis(1, \"$nhisto\", \"$con\", \"$apli\",\"$codigousu\")'>$con - $nhisto</a></td>
						<td><a href='#' onclick='bushis(1, \"$nhisto\", \"$con\", \"$apli\",\"$codigousu\")'>$fecha</a></td>
						<td><a href='#' onclick='bushis(1, \"$nhisto\", \"$con\", \"$apli\",\"$codigousu\")'>$hora</a></td>
						<td><a href='#' onclick='bushis(1, \"$nhisto\", \"$con\", \"$apli\",\"$codigousu\")'>$medico</a></td>
						<td><a href='#' onclick='bushis(1, \"$nhisto\", \"$con\", \"$apli\",\"$codigousu\")'>$area</a></td>
						<td><a href='#' onclick='bushis(1, \"$nhisto\", \"$con\", \"$apli\",\"$codigousu\")'>$vers</a></td>
						</tr>";
					}
					$k++;
				}
				echo"</table>
				</div>
				</td></tr>
				</table>
				<br>";
			}		
			
			
			if($numhisto!='' && $histor=='1')
			{			
				echo"
				<input type=hidden name=valregre>
				<input type=hidden name=codusu>
				<input type=hidden name=marca>";
				
				
				$bcontrol=mysql_query("select * from consultaprincipal where numc_cpl='$numhisto'");
				while($rcont=mysql_fetch_array($bcontrol))
				{				
					$incapa=$rcont['inca_cpl'];	
					$areaanes=$rcont['area_cpl'];	
				}
				echo"<input type=hidden name=areaanes value='$areaanes'>";
				
				
				$cadcro124="SELECT concent_ccl FROM preanes_conclusion WHERE numero_cons='$numhisto'";
				$resulcro124=Mysql_query($cadcro124);
				while($rcontpre12=mysql_fetch_array($rcontpre12))
				{
					$sigenconsinfo=$rcontpre12['concent_ccl'];
				}
				if($sigenconsinfo=='S')
				{
					$apareconinf=1;
				}
				else
				{
					$apareconinf=0;
				}	
				
				
				$breco=mysql_query("select * from encabesadoformula where numc_efo='$numhisto'");
				while($rreco=mysql_fetch_array($breco))
				{
					$recom=$rreco['obfo_efo'];				
				}
				
				$bima=mysql_query("SELECT cups.codigo, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre
				FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
				WHERE detareferencia.numc_dre='$numhisto' AND  (cups.grup_cup='87' Or cups.grup_cup='88')");
				if(mysql_num_rows($bima)>0)$numima='SI';			
				$blab=mysql_query("SELECT cups.codigo, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre
				FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
				WHERE (((cups.grup_cup)='90') AND ((detareferencia.numc_dre)='$numhisto'))");	
				if(mysql_num_rows($blab)>0)$numlab='SI';		
				$brem=mysql_query("SELECT cups.codigo, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre
				FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
				WHERE (((cups.grup_cup)<>'87' And (cups.grup_cup)<>'88' And (cups.grup_cup)<>'90') AND ((detareferencia.numc_dre)='$numhisto'))");
				if(mysql_num_rows($brem)>0)$numrem='SI';			
				$brem1=mysql_query("SELECT destipos.codi_des, destipos.nomb_des, detareferencia.numc_dre, detareferencia.cant_dre, detareferencia.ccie_dre, detareferencia.obsv_dre
				FROM destipos INNER JOIN detareferencia ON destipos.codi_des = detareferencia.codi_dre
				WHERE (((detareferencia.numc_dre)='$numhisto'))");	
				if(mysql_num_rows($brem1)>0)$numrem='SI';	
				$bmed=mysql_query("select * from medicamentosenv where numc_men='$numhisto'");
				if(mysql_num_rows($bmed)>0)$nummed='SI';
				$bpos=mysql_query("select * from form_nop where iden_med  ='$numhisto'");
				if(mysql_num_rows($bpos)>0)$numpos='SI';
				$bsq=mysql_query("select * from solicitud_quirofano where nhis_solquiro='$numhisto'");
				if(mysql_num_rows($bsq)>0)$numsol='SI';
				$numhisto_pro="1_".$numhisto;
				
								
				$bimap=mysql_query("SELECT cups.codigo, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre
				FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
				WHERE detareferencia.numc_dre='$numhisto_pro' AND  (cups.grup_cup='87' Or cups.grup_cup='88')");
				if(mysql_num_rows($bimap)>0)$numimapro='SI';	
				$blabp=mysql_query("SELECT cups.codigo, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre
				FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
				WHERE (((cups.grup_cup)='90') AND ((detareferencia.numc_dre)='$numhisto_pro'))");	
				if(mysql_num_rows($blabp)>0)$numlabpro='SI';	
				$bremp=mysql_query("SELECT cups.codigo, cups.descrip, cups.grup_cup, detareferencia.obsv_dre, detareferencia.ccie_dre, detareferencia.cant_dre, detareferencia.numc_dre
				FROM detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo
				WHERE (((cups.grup_cup)<>'87' And (cups.grup_cup)<>'88' And (cups.grup_cup)<>'90') AND ((detareferencia.numc_dre)='$numhisto_pro'))");
				if(mysql_num_rows($bremp)>0)$numrempro='SI';	
				$brem1p=mysql_query("SELECT destipos.codi_des, destipos.nomb_des, detareferencia.numc_dre, detareferencia.cant_dre, detareferencia.ccie_dre, detareferencia.obsv_dre
				FROM destipos INNER JOIN detareferencia ON destipos.codi_des = detareferencia.codi_dre
				WHERE (((detareferencia.numc_dre)='$numhisto_pro'))");		
				if(mysql_num_rows($brem1p)>0)$numrempro='SI';	
				$bsq=mysql_query("select * from procedimientos_medicos where numc_proc='$numhisto_pro'");
				if(mysql_num_rows($bsq)>0)$numproc='SI';
							
				
				$impre=0;
				echo"<table align=center class='tbl' width='930px'>
				<tr>
				<th colspan=2 align=center valign=top height=30>IMPRIMIR ISTORIA $numhisto</th>
				</tr>";	
				if($numima=="SI")
				{
					echo"<tr>
					<th>IMAGENOLOGIA</th>		
					<td><input type=checkbox name='ima' onclick='ver()' value=1></td>
					</tr>";	
				}
				else
				{
					echo"<tr>
					<th>IMAGENOLOGIA</th>		
					<td><input type=checkbox name='ima' onclick='ver()' disabled value=1></td>
					</tr>";	
				}
				if($numlab=="SI")
				{
					echo"<tr>
					<th>55LABORATORIOS</th>
					<td><input type=checkbox name='lab' onclick='ver()' value=1></td>
					</tr>";	
				}
				else
				{
					echo"<tr>
					<th>LABORATORIOS</th>
					<td><input type=checkbox name='lab' onclick='ver()' disabled value=1></td>
					</tr>";	
				}
				if($numrem=="SI")
				{
					echo"<tr>
					<th>OTRAS ORDENES</th>
					<td><input type=checkbox name='rem' onclick='ver()' value=1></td>
					</tr>";	
				}
				else
				{
					echo"<tr>
					<th>OTRAS ORDENES</th>
					<td><input type=checkbox name='rem' onclick='ver()' disabled value=1></td>
					</tr>";	
				}
				if($nummed=="SI")
				{
					echo"<tr>
					<th>MEDICAMENTOS</th>
					<td><input type=checkbox name='med' onclick='ver()' value=1></td>
					</tr>";	
				}	
				else
				{
					echo"<tr>
					<th>MEDICAMENTOS</th>
					<td><input type=checkbox name='med' onclick='ver()' disabled value=1></td>
					</tr>";	
				}
				if($numpos=="SI")
				{
					echo"<tr>
					<th>JUSTIFICACIONES</th>
					<td><input type=checkbox name='forpos' onclick='ver()' value=1></td>
					</tr>";	
				}
				else
				{
					echo"<tr>
					<th>JUSTIFICACIONES</th>
					<td><input type=checkbox name='forpos' onclick='ver()' disabled value=1></td>
					</tr>";	
				}
				if($numsol=="SI")
				{
					echo"<tr>
					<th>SOLICITUD DE QUIROFANO</th>
					<td><input type=checkbox name='solqui' onclick='ver()' value=1></td>
					</tr>";	
				}
				else
				{
					echo"<tr>
					<th>SOLICITUD DE QUIROFANO</th>
					<td><input type=checkbox name='solqui' onclick='ver()' disabled value=1></td>
					</tr>";	
				}
				
				if($incapa>0)
				{
					echo"<tr>
					<th>INCAPACIDAD</th>
					<td><input type=checkbox name='inca' onclick='ver()' value=1></td>
					</tr>";	
				}
				else	
				{
					echo"<tr>
					<th>INCAPACIDAD</th>
					<td><input type=checkbox name='inca' onclick='ver()' disabled value=1></td>
					</tr>";	
				}
				if($recom!="")
				{
					echo"<tr>
					<th>RECOMENDACIONES</th>
					<td><input type=checkbox name='reco' onclick='ver()' value=1></td>
					</tr>";	
				}
				else
				{
					echo"<tr>
					<th>RECOMENDACIONES</th>
					<td><input type=checkbox name='reco' onclick='ver()' disabled value=1></td>
					</tr>";	
				}
				echo "<tr>
				<th>HISTORIA</th>
				<td><input type=checkbox name='his' onclick='ver()' value=1></td>
				</tr>";				
				
				
				if($numimapro=="SI" || $numlabpro=="SI" || $numrempro=="SI" || $numproc=="SI")
				{
					echo"<br><br><th colspan=2>PROCEDIMIENTOS</th><br>";
				}	
				
				if($numimapro=="SI")
				{
					echo"<tr>
					<th>IMAGENOLOGIA</th>		
					<td><input type=checkbox name='imapro' onclick='ver()' value=1></td>
					</tr>";	
				}
				else
				{
					echo"<tr>
					<th>IMAGENOLOGIA</th>		
					<td><input type=checkbox name='imapro' onclick='ver()' disabled value=1></td>
					</tr>";	
				}
				if($numlabpro=="SI")
				{
					echo"<tr>
					<th>LABORATORIOS</th>
					<td><input type=checkbox name='labpro' onclick='ver()' value=1></td>
					</tr>";	
				}
				else
				{
					echo"<tr>
					<th>LABORATORIOS</th>
					<td><input type=checkbox name='labpro' onclick='ver()' disabled value=1></td>
					</tr>";	
				}
				if($numrempro=="SI")
				{
					echo"<tr>
					<th>OTRAS ORDENES</th>
					<td><input type=checkbox name='rempro' onclick='ver()' value=1></td>
					</tr>";	
				}
				else
				{
					echo"<tr>
					<th>OTRAS ORDENES</th>
					<td><input type=checkbox name='rempro' onclick='ver()' disabled value=1></td>
					</tr>";	
				}
				
				if($numproc=="SI")
				{
					echo"<tr>
					<th>HISTORIA DE PROCEDIMIENTOS</th>
					<td><input type=checkbox name='lecpro' onclick='ver()' value=1></td>
					</tr>";	
				}
				else
				{
					echo"<tr>
					<th>HISTORIA DE PROCEDIMIENTOS</th>
					<td><input type=checkbox name='lecpro' onclick='ver()' disabled value=1></td>
					</tr>";		
				}
				
				if($areaanes=='62' && $apareconinf==1)
				{	
					echo"<tr>
					<th>CONSETIMIENTO INFORMADO ANESTESIOLOGIA</th>
					<td><input type=checkbox name='conseinfanes' onclick='ver()' value=1></td>
					</tr>";	
				}
				else
				{
					echo"<tr>
					<th>CONSETIMIENTO INFORMADO ANESTESIOLOGIA</th>
					<td><input type=checkbox name='conseinfanes' onclick='ver()' disabled value=1></td>
					</tr>";		
				}
			
				echo"
				</table>
				<br>
				<table align=center class='tbl' width='930px' id='vista' style='visibility:hidden;'>
				<tr>
				
				
				<th align=center valign=top height=30><a><INPUT type=button class='boton' value=IMPRIMIR onClick='valida();'></th>
				</tr>";		
				echo"</table>";
				
			}		
		}	
		
		if($tipo==2)
		{
			echo"<br>
			<table align=center class='tbl' width='930px'>
			<tr>
			<th>HISTORIA</th>
			<th>FECHA</th>
			<th>HORA</th>
			<th>MEDICO</th>
			<th>CLASIFICACION</th>
			<th>OBSERVACION</th>
			</tr>";
			
			$bushisto=mysql_query("SELECT usuario.NROD_USU, triage_urgencias.iden_tri, triage_urgencias.fech_tri, triage_urgencias.hora_tri, medicos.nom_medi, triage_urgencias.clas2_tri, triage_urgencias.obse_tri
			FROM ((triage_urgencias INNER JOIN citas ON triage_urgencias.iden_cita = citas.id_cita) INNER JOIN medicos ON triage_urgencias.usua2_tri = medicos.cod_medi) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU
			WHERE (((usuario.NROD_USU)='$cedula'))
			ORDER BY triage_urgencias.fech_tri DESC , triage_urgencias.hora_tri DESC");
		
			
			while($rhi=mysql_fetch_array($bushisto))
			{
				$iden=$rhi['iden_tri'];
				$fecha=$rhi['fech_tri'];
				$hora=$rhi['hora_tri'];
				$medico=$rhi['nom_medi'];
				$clasi=$rhi['clas2_tri'];
				$obse=$rhi['obse_tri'];
				echo"
				<tr>
				<td><a href='#' onclick='bushis(2, \"$iden\", 0, 0)'>$iden</a></td>
				<td><a href='#' onclick='bushis(2, \"$iden\", 0, 0)'>$fecha</a></td>
				<td><a href='#' onclick='bushis(2, \"$iden\", 0, 0)'>$hora</a></td>
				<td><a href='#' onclick='bushis(2, \"$iden\", 0, 0)'>$medico</a></td>
				<td><a href='#' onclick='bushis(2, \"$iden\", 0, 0)'>$clasi</a></td>
				<td><a href='#' onclick='bushis(2, \"$iden\", 0, 0)'>$obse</a></td>
				";				
			}
		}		
		if($tipo==3) //HISTORIA LABORAL
		{
			$busca=mysql_query("SELECT usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, so_infpersonal.nhis_inf, so_infpersonal.fech_inf, so_infpersonal.hora_inf, so_infpersonal.tico_inf, contrato.NEPS_CON, medicos.nom_medi
			FROM ((so_infpersonal INNER JOIN usuario ON so_infpersonal.codi_usu = usuario.CODI_USU) INNER JOIN contrato ON so_infpersonal.cont_inf = contrato.CODI_CON) INNER JOIN medicos ON so_infpersonal.codi_med = medicos.cod_medi
			WHERE so_infpersonal.codi_usu='$codigousu'
			ORDER BY so_infpersonal.fech_inf DESC , so_infpersonal.hora_inf DESC");	
/*
			ECHO "SELECT usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, so_infpersonal.nhis_inf, so_infpersonal.fech_inf, so_infpersonal.hora_inf, so_infpersonal.tico_inf, contrato.NEPS_CON, medicos.nom_medi
			FROM ((so_infpersonal INNER JOIN usuario ON so_infpersonal.codi_usu = usuario.CODI_USU) INNER JOIN contrato ON so_infpersonal.cont_inf = contrato.CODI_CON) INNER JOIN medicos ON so_infpersonal.codi_med = medicos.cod_medi
			WHERE so_infpersonal.codi_usu='$codigousu'
			ORDER BY so_infpersonal.fech_inf DESC , so_infpersonal.hora_inf DESC";
*/			
			echo "
			<BR><BR>
			<table align=center class='tbl'>
			<tr>
			<th>No. HISTORIA</th>
			<th>TIPO CONSULTA</th>
			<th>FECHA</th>
			<th>HORA</th>
			<th>IDENTIFICACION</th>
			<th>NOMBRE PACIENTE</th>
			<th>CONTRATO</th>
			<th>MEDICO</th>
			</tr>";
			while($rus=mysql_fetch_array($busca))
			{
				$nombre=$rus['PNOM_USU'].' '.$rus['SNOM_USU'].' '.$rus['PAPE_USU'].' '.$rus['SAPE_USU'];
				$histo=$rus['nhis_inf'];
				$docum=$rus['NROD_USU'];
				$fecha=$rus['fech_inf'];
				$hora=$rus['hora_inf'];
				$contra=$rus['NEPS_CON'];
				$medico=$rus['nom_medi'];
				$tipocon=$rus['tico_inf'];				
				echo"<tr>
				<td align=center><a href='#' onclick='salir(\"$histo\",\"$tipocon\")' >$histo</a></td>
				<td align=center><a href='#' onclick='salir(\"$histo\",\"$tipocon\")'>$tipocon</a></td>
				<td align=center><a href='#' onclick='salir(\"$histo\",\"$tipocon\")'>$fecha</a></td>
				<td align=center><a href='#' onclick='salir(\"$histo\",\"$tipocon\")'>$hora</a></td>
				<td align=center><a href='#' onclick='salir(\"$histo\",\"$tipocon\")'>$docum</a></td>
				<td><a href='#' onclick='salir(\"$histo\",\"$tipocon\")'>$nombre</a></td>
				<td><a href='#' onclick='salir(\"$histo\",\"$tipocon\")'>$contra</a></td>
				<td><a href='#' onclick='salir(\"$histo\",\"$tipocon\")'>$medico</a></td>
				</tr>";		
			}
			echo"</table>";
		}
	}
	else
	{
		echo"<br><center>USUARIO NO REGISTRADO</center>";
	}
	
	echo"</form>";
	
	
function actividad_pyp($act_pyp)
{
     //PLANIFICACIN FAMILIAR
    if($act_pyp=="18" || $act_pyp=="20")
    {	
	   $pagina = "../pyp/historia_planificacionFamiliar/frm_impreprov.php";
        $pagadx = "../pyp/historia_planificacionFamiliar/frm_impreordenes.php";
    }
    //JOVEN
    if($act_pyp=="94")
    {
        $pagina = "../pyp/historia_alteracionesJoven/frm_impreprov.php";
        $pagadx = "../pyp/historia_alteracionesJoven/frm_impreordenes.php";
    }
	//PLANIFICACION FAMILIAR CONTROL POR MEDICO O ENFERMERA
    else if($act_pyp=="19" || $act_pyp=="105")
    {
        $pagina = "../pyp/historia_planificacionFamiliar/frm_imprecontrol.php";
        $pagadx = "../pyp/historia_planificacionFamiliar/frm_impreordenes.php";
		
    }
    //	TAMIZAJES
	//111 TAMIZAJE DE SENO 
    //112 TAMIZAJE DE PROSTATA
    //113 LECTURA DE CITOLOGÍA
	//95 CONTROL POR CONSULTA DEL JOVEN
    else if($act_pyp=="111" || $act_pyp=="112" || $act_pyp=="113" || $act_pyp=="95")
    {
        $pagina = "../pyp/historia_tamizajes/frm_impreprov.php";
        $pagadx = "../pyp/historia_tamizajes/frm_impreordenes.php";
    }
    switch ($act_pyp) 
    { 
        //ALTERACIONES DEL ADULTO MAYOR INICIAL, CONTROL
        case "22":
            $pagina = "../pyp/historia_alteracionesAdulto/frm_impreprov.php";
            $pagadx = "../pyp/historia_alteracionesAdulto/frm_impreordenes.php";
            break;
        case "23":
            $pagina = "../pyp/historia_alteracionesAdulto/frm_imprecontrol.php";                    
            $pagadx = "../pyp/historia_alteracionesAdulto/frm_impreordenes.php";
            break;

    }
    return $pagina;
    
}
?>
</body>
</html><html><head></head><body></body></html>