<?php
session_register('Gsexo');
session_register('Gbanderaref');
session_register('Gcontme');
session_register('gauditor');
set_time_limit(0);
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
    //TAMIZAJES
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
<html><head><title>Antecedentes</title>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="JavaScript1.2" src="style1.js"></script>
		<script language=JavaScript>
		function buscaring(ing)
		{		
			form21.ingreso.value=ing;
			form21.action='historico2.php';
			form21.submit();
		}
		
		function cambio()
		{
			
			form21.target='';
			form21.action='historico2.php';
			form21.submit();		
		}
		function cambio1(k)
		{
			form21.ubica.value=k;			
			form21.target='';
			form21.action='historico2.php';
			form21.submit();		
		}
		function imprelab(k)
		{
			form21.fecdia.value=k;
			form21.target='TOP';
			form21.action='impr_ayudas0.php';
			form21.submit();			
		}
		function impreayu(k)
		{
			form21.fecdia.value=k;
			form21.target='TOP';
			form21.action='impr_ayudas2.php';
			form21.submit();			
		}
		function impre(evo)
		{
			//alert(evo);
			//form21.iden_evo.value=evo;			
			//form21.target='TOP';
			//form21.action='imprehis.php';
			//form21.submit();
			url='imprehis.php?iden_evo='+evo;
			window.open(url,'nuevo');
			//alert(url);
		}
		function foco()
		{			
			j=form21.ubica.value;					
			if(j!=form21.fin.value)
			{
				j=form21.ubica.value;	
			}
			else
			{
				j=form21.ubica.value;
			}			
			
		}
                
    //////Promocion y Prevencion
    function VerHistoria(hist,pagina) 
    {        
        var miForm = document.forms[0];
        
        miForm.num_hist.value= hist;//tip_hist        
        miForm.action = pagina;//'historia_alteracionesAdulto/frm_impreprov.php';        
        miForm.target = "_PARENT";
        miForm.method = "POST";
        miForm.submit();
        
    }
	
	/*
	function bushis(op,num,con)
	{		
		form21.concon.value=con;
		form21.numhisto.value=num;
		form21.his.value='1';		
		if(form21.concon.value=='1')
		{
			
			form21.action='../consulta_ambulatoria/impre_histo.php';
		}
		if(form21.concon.value=='2')
		{
			form21.action='../consulta_ambulatoria/impre_histo_espe.php';
		}
		form21.target='TOP';
		form21.submit();
	}
	*/
	
	
		</script>
</head>
<body>
<form name="form21" method="POST" action="pasoserie.php">

<?php
echo $numhisto;
echo"<input type=hidden name=ingreso value=$ingreso>";
ECHO"<input type=hidden name=areac value=$areac>";
ECHO"<input type=hidden name=cedula value=$cedula>";
ECHO"<input type=hidden name=his value=$his>";

ECHO"<input type=hidden name=concon value='$concon'>";
ECHO"<input type=hidden name=histor>";

$Gcontme="verdadero";
$Gbanderaref="false";
include ('../Libreria/Php/conexiones_g.php');
include ('../Libreria/Php/sql.php');
base_proinsalud(); 



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
	


$busu="select * from usuario where NROD_USU='$cedula'";
//echo $busu;
$busu=mysql_query($busu);
while($row16=mysql_fetch_array($busu))
{
	$Gideusu=$row16['CODI_USU'];
	//echo $Gideusu;
}
//echo 'usuario '.$Gideusu;
//echo $areac;
if ($areac==01 )
{	
	 
	 echo "<input type='hidden' name='num_hist' id='num_hist' value=''>";            
	//$bcon=mysql_query("Select nom_areas, numc_ehi, feca_cpl, nom_medi from areas, consultaprincipal, encabesadohistoria, medicos 
	//where cod_areas=area_cpl and numc_ehi=numc_cpl and come_cpl=cod_medi and cous_ehi='$Gideusu' order by feca_cpl desc");
	$sql = "SELECT consultaprincipal.feca_cpl, consultaprincipal.numc_cpl, medicos.nom_medi, consultaprincipal.cod_actpyp, areas.nom_areas, consultaprincipal.vers_apli
        FROM areas INNER JOIN (medicos INNER JOIN ((encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) INNER JOIN usuario ON encabesadohistoria.cous_ehi = usuario.CODI_USU) ON medicos.cod_medi = consultaprincipal.come_cpl) ON areas.cod_areas = consultaprincipal.area_cpl
        WHERE (((usuario.CODI_USU)='$Gideusu')) ORDER BY consultaprincipal.feca_cpl desc;";        
        $bcon = mysql_query($sql);
	if (mysql_num_rows($bcon)==0 || empty($Gideusu))
	{
		 echo "<center><h3>No hay Historico de Este usuario</h3></center>";
	}
	  else
	{	
		
		
		
		echo"	
		<center>
		<table border='0' cellspacing='10'>		
		<tr height='16'>
		<td align='center' ><font face='Arial' size='2'><b>Elegir</b></font></td>
		<td align='center'><font size='2' face='Arial'><b>Fecha</b></font></td>
		<td><font size='2' face='Arial'><b>Medico</b></font></td>
		<td><font size='2' face='Arial'><b>Area</b></font></td>
		</tr>
		<tr>
		<td colspan=4><HR width=100%></td>
		</tr>";	
		
		while ($row=mysql_fetch_array($bcon))
		{
			$numcon=trim($row['numc_cpl']);
			$fecha=$row['feca_cpl'];
			$medico=$row['nom_medi'];
			$area=$row['nom_areas'];
			$codpyp = $row['cod_actpyp'];
			$version = $row['vers_apli'];
			
			$histo1='on';            
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
							   AND numc_ctrl = '$numcon'";
					$res_summed = mysql_query($sql_summed);
					
					if(mysql_num_rows($res_summed)>0)//mysql_num_rows($res_summed)>0);                                            
					{
						$impres_sume= "<br/><a href='javascript:void(0);' onclick='VerHistoria(\"$numcon\",\"$pagina_sume\")'>Nota de Enfermeria</a>";
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
					$link = "<a href='javascript:void(0);' onclick='VerHistoria(\"$numcon\",\"$pagina\")'>
					<img src='img/feed_go.png' border='0' />
					</a>
					</td>";           
				}
			}
			else
			{
				$besp=mysql_query("SELECT medicos.cod_medi, destipos.nomb_des, destipos.homo3_des
				FROM medicos INNER JOIN destipos ON medicos.espe_med = destipos.codi_des
				WHERE (((medicos.cod_medi)='$cmedi'))");
				$nesp=mysql_fetch_array($besp);
				$tiespe=$nesp['homo3_des'];
				if($tiespe=='2' && $ticon=='2')$con='2';
				else $con='1';	
				$nom_def = "";
				//echo $version.' ';
				if($version=='5503')
				{
					$link = "<a href='../consulta_ambulatoria/impre_histo.php?numhisto=$numcon&his=1' target='TOP'><img src='img/feed_go.png' border='0'></a>";
					
				}
				
				if($version=='5510')
				{
					$link = "<a href='../consulta_ambulatoria/impre_consul.php?serie=$numcon&histo1=$histo1' target='TOP'><img src='img/feed_go.png' border='0'></a>";
				}
					
				
				
				
				//$link = "<a href='#' onclick='bushis(\"$apli\",\"$nhisto\", \"$con\")'><img src='img/feed_go.png' border='0'></a>";
			}
			echo "<tr>
			<td>$link</td>
			<td>$fecha</td>
			<td>$medico</td>	
			<td>$area<br/>$nom_def</td>
			</tr>";			
		}
		echo"</table>";
                
	}	
}
else
{
		$entra=0;
		$busing="SELECT ingreso_hospitalario.id_ing, ingreso_hospitalario.fecin_ing
		FROM ingreso_hospitalario
		WHERE (((ingreso_hospitalario.codius_ing)='$Gideusu'))";
		//echo $busing;
		$busing=mysql_query($busing);
		if(mysql_num_rows($busing)>0)
		{
			echo"<table align=center CELLSPACING=15 >
			<tr>
			<td align=center colspan='8'>SELECCION</td>
			<td></td>
			<td align=center>NUMERO DE INGRESO</td>
			<td align=center>FECHA DE INGRESO</td>
			</tr>";		
		
			while($row18=mysql_fetch_array($busing))
			{
				//echo $ingre . "<br/>";
				$ingre=$row18['id_ing'];
				$fechain=substr($row18['fecin_ing'],0,10);		
				echo "
				<tr>
				<td align=center><a href='#' onclick='buscaring($ingre)'><b><img src='img/feed_go.png' border=0 title='Ingresar'></a></td>
				<td align=center><a href='imprehis.php?ingreso=$ingre' target='nuevo'><img src='img/490350572448179138.png' border=0 title='Mirar todas las evoluciones' width='30' hight='30'></a></td>
				<td align=center><a href='imprimir2_.php?codusu=$Gideusu&ingreso=$ingre' target='nuevo'><img src='img/682273389326331766.png' border=0 title='Laboratorios' width='30' hight='30'></a></td>
				<td align=center><a href='terapia_impre1.php?ingreso=$ingre' target='nuevo'><img src='img/1292362969.png' border=0 title='Terapias' width='30' hight='30'></a></td>
				<td align=center><a href='imagen311.php?ingreso=$ingre' target='nuevo'><img src='img/755178201993025257.png' border=0 title='Imagenologia' width='30' hight='30'></a></td>
				<td align=center><a href='notas_enf.php?ingreso=$ingre&selec=O' target='nuevo'><img src='img/16555969002088794786.png' border=0 title='Notas de Enfermeria' width='30' hight='30'></a></td>
				<td align=center><a href='notas_enf.php?ingreso=$ingre&selec=S' target='nuevo'><img src='img/1435164290367675234.png' border=0 title='Signos vitales' width='30' hight='30'></a></td>";
				$sql_evo = "SELECT hist_evo.iden_evo, hist_evo.id_ing FROM hist_evo INNER JOIN encabesadoformula ON hist_evo.iden_evo = encabesadoformula.numc_efo
				WHERE (((hist_evo.id_ing) = '$ingre'))";
				$res_evo = mysql_query($sql_evo);				
				if(mysql_num_rows($res_evo)>0)
				{
					while($row_evo = mysql_fetch_array($res_evo))
					{
						$idevo = $row_evo['iden_evo'];
					}
					$formula = "<a href='../uci/form_amb/imprimir_med.php?iden_evo=$idevo' target='_PARENT'>FORMULA</a>";
				}
				else
					$formula = "";
				
				$sql_orden="SELECT hist_var.fech_var
				FROM (hist_evo 
				INNER JOIN hist_var ON hist_evo.iden_evo = hist_var.iden_evo) 
				INNER JOIN ingreso_hospitalario ON hist_evo.id_ing = ingreso_hospitalario.id_ing
				WHERE hist_evo.id_ing='$ingre'";
				//echo "<br>".$sql_orden;				
				$res_orden=mysql_query($sql_orden);
				if(mysql_num_rows($res_orden)>0){					
					$ordenes= "<a href='ord_med.php?cedula=$cedula&id_ing=$ingre' target='_self'><img src='img/feed_magnify.png' border=0 title='Ordenes'></a>";					
				}
				else{
					$ordenes="<img src='img/feed_magnify.png' border=0 title='Ordenes'>";
				}


				echo "				
				<td>$ordenes</td>
				<td>$formula</td>
				<td align=center>$ingre</td>
				<td align=center>$fechain</td>
				</tr>";			
			}
			echo "</table>";
			if(!empty($ingreso))
			{
				
				$link=Mysql_connect("localhost","root","");
				if(!$link)echo"no hay conexion";
				Mysql_select_db('proinsalud',$link);		
				$usu=mysql_query("SELECT ingreso_hospitalario.id_ing, usuario.NROD_USU
				FROM ingreso_hospitalario INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU
				WHERE (((ingreso_hospitalario.id_ing)='$ingreso'))");	
				$rowusu=mysql_fetch_array($usu);
				$usuar=$rowusu[NROD_USU];	
				$medi=mysql_query("SELECT medicos.nom_medi, Max(hist_evo.cod_medi) AS MxDecod_medi
				FROM hist_evo INNER JOIN medicos ON hist_evo.cod_medi = medicos.cod_medi
				WHERE (((hist_evo.id_ing)='$ingreso'))
				GROUP BY medicos.nom_medi
				ORDER BY medicos.nom_medi");	
				echo "		
				<table width=90%>	  
				  <tr>         
					 <td align=center>MEDICO <select name=medico onchange='cambio()'>
					 <option value=0>Todos</option>";
					 while($rowmed=mysql_fetch_array($medi))
					 {
						$codmed=$rowmed[MxDecod_medi];
						$nommed=$rowmed[nom_medi];
						echo"<option value=$codmed>$nommed</option>";
					 }
					 echo"</select>		 
					 </th>		 	  
				  </tr>
					</table>";
					?>
						<script languaje=havascript>			
						form21.medico.value="<?echo $medico;?>";
						</script>
					<?
					echo "
					<br><br>
				<table width=90% align=center >	  
				  <tr>         
					 <td width=10% align=center><B></B></td>
					 <td width=10% align=center><B></B></td>   
					 <td width=20% align=center><B></B></td>
					 <td width=20% align=center></td>
					 <td width=40% align=center></td>
				  </tr>
				";
				if($medico==0)
				{
					$cad="SELECT Max(hist_evo.fech_evo) AS MxDefech_evo, hist_evo.id_ing
					FROM hist_evo
					GROUP BY hist_evo.fech_evo, hist_evo.id_ing
					HAVING (((hist_evo.id_ing)='$ingreso'))
					ORDER BY Max(hist_evo.fech_evo) DESC , hist_evo.fech_evo DESC;";
				}
				else
				{
					$cad="SELECT Max(hist_evo.fech_evo) AS MxDefech_evo, hist_evo.id_ing
					FROM hist_evo
					where (((hist_evo.cod_medi)='$medico'))
					GROUP BY hist_evo.fech_evo, hist_evo.id_ing
					HAVING (((hist_evo.id_ing)='$ingreso')) 
					ORDER BY Max(hist_evo.fech_evo) DESC , hist_evo.fech_evo DESC;";		
				}	
				$resul=Mysql_query($cad,$link);
				if(!$resul)echo 'no hay consulta';
				$num=Mysql_num_rows($resul);	
				$n=0;
				while($row = mysql_fetch_array($resul))
				{		
					$fech_evo=trim($row['MxDefech_evo']);
					//$hora_evo=$row['hora_evo'];	
					//$nom_medi=$row['nom_medi'];
					//$iden_evo=$row['iden_evo'];
					
					ECHO"
					<tr><td colspan=5><hr align='tr' noshade color='#D0D0D0'></td></tr>
					<tr><td align=center height=25>";
					$nomvar='selec'.$n;
					$selec=$$nomvar;
					if($n==$ubica and $selec==1)
					{
						echo"<input type=checkbox name='$nomvar' value=1 checked onclick='cambio1($n)'>";
					}
					else		
					{
						echo"<input type=checkbox name='$nomvar' value=1 onclick='cambio1($n)'>";
					}	
					$fecev=substr($fech_evo,0,4).'/'.substr($fech_evo,5,2).'/'.substr($fech_evo,8,2);
					
					$fact2="SELECT factura.num_fac, factura.fec_ent, factura.cod_usu
					FROM factura WHERE (((factura.fec_ent)='$fecev') AND ((factura.cod_usu)='$usuar'))";
					$fact=mysql_query($fact2,$link);
					$numresfac=Mysql_num_rows($fact);
					
					
					$imag2="SELECT lectura_imagen.codi_usu, lectura_imagen.fech_lec, lectura_imagen.lect_lec, cups.descrip
					FROM lectura_imagen INNER JOIN cups ON lectura_imagen.copr_lec = cups.codigo
					WHERE (((lectura_imagen.codi_usu)='$Gideusu') AND ((lectura_imagen.fech_lec)='$fech_evo') AND ((lectura_imagen.esta_lec)='CU'))";
					$imag=mysql_query($imag2);
					$numresima=Mysql_num_rows($imag);
					
					
					echo"</td>		
					<td bgcolor=#FFFFFF><b>$fech_evo</td>";		
					if($numresfac==0 and $numresima==0)
					{
						echo"<td bgcolor='#FFFFFF' colspan=3></td>";
					}		
					if($numresfac>0 and $numresima==0)
					{
						echo"<td colspan=1 bgcolor=#FFFFFF>	<a href='#' onclick='imprelab(\"$fech_evo\")'><b>Resultados Laboratorio</b></a></td>";
						echo"<td bgcolor='#FFFFFF' colspan=2></td>";
					}			
					if($numresfac==0 and $numresima>0)
					{
						echo"<td bgcolor='#FFFFFF' colspan=1></td>";
						echo"<td colspan=2 bgcolor=#FFFFFF>	<a href='#' onclick='impreayu(\"$fech_evo\")'><b>Resultados Imageneologia</b></a></td>";
						echo"<td bgcolor='#FFFFFF' colspan=1></td>";
					}
					if($numresfac>0 and $numresima>0)
					{
						
						echo"<td colspan=1 bgcolor=#FFFFFF>	<a href='#' onclick='imprelab(\"$fech_evo\")'><b>Resultados Laboratorio</b></a></td>";
						echo"<td colspan=2 bgcolor=#FFFFFF>	<a href='#' onclick='impreayu(\"$fech_evo\")'><b>Resultados Imageneologia</b></a></td>";
						echo"<td bgcolor='#FFFFFF' colspan=1></td>";
					}		
					echo"</tr>";
					//echo"<tr><td colspan=5><hr align='tr' noshade></td></tr>";
					
					if($n==$ubica and $selec==1)
					{
						if($medico==0)
						{
							$resu=mysql_query("SELECT hist_evo.iden_evo,hist_evo.cama_evo, hist_evo.subj_evo, hist_evo.obje_evo, hist_evo.anal_evo, hist_evo.plan_evo, hist_evo.fech_evo, hist_evo.id_ing, hist_evo.hora_evo, medicos.nom_medi
							FROM hist_evo INNER JOIN medicos ON hist_evo.cod_medi = medicos.cod_medi
							WHERE (((hist_evo.fech_evo)='$fech_evo') AND ((hist_evo.id_ing)='$ingreso'))");
							
						}
						else
						{
							$resu=mysql_query("SELECT hist_evo.iden_evo,hist_evo.cama_evo, hist_evo.subj_evo, hist_evo.obje_evo, hist_evo.anal_evo, hist_evo.plan_evo, hist_evo.fech_evo, hist_evo.id_ing, hist_evo.hora_evo, medicos.nom_medi
							FROM hist_evo INNER JOIN medicos ON hist_evo.cod_medi = medicos.cod_medi
							WHERE (((hist_evo.fech_evo)='$fech_evo') AND ((hist_evo.id_ing)='$ingreso')) and (((hist_evo.cod_medi)='$medico'))");
						}			
						while($rowresu=mysql_fetch_array($resu))
						{				
							$hora=$rowresu[hora_evo];
							$medi=$rowresu[nom_medi];				
							$sub=$rowresu[subj_evo];
							$obj=$rowresu[obje_evo];
							$ana=$rowresu[anal_evo];
							$pla=$rowresu[plan_evo];
							$cama=$rowresu['cama_evo'];
							$iden_evo=$rowresu[iden_evo];
							$bare=mysql_query("SELECT destipos.codi_des, destipos_1.nomb_des
							FROM destipos INNER JOIN destipos AS destipos_1 ON destipos.val2_des = destipos_1.codi_des
							WHERE (((destipos.codi_des)='$cama'))");
							$areaus='';
							while($rare=mysql_fetch_array($bare))
							{
								$areaus=$rare['nomb_des'];				
							}
							echo "	
							<tr><td height=20></td></tr>				
							<tr><td></td><td  colspan=4><hr align='tr' noshade></td></tr>				
							<tr><td></td><td><b>$hora</b></td><td colspan=2><b>Dr. $medi</b></td><td colspan=2><b>$areaus</b></td></tr>				
							<tr><td></td><td colspan=4><hr align='tr' noshade></td></tr>
							<td height=20></td></tr>				
							<tr><td></td><td valign='TOP'>SUBJETIVO</td><td colspan=3><b>$sub</b></td></tr>
							<tr><td height=10></td></tr>
							<tr><td><td valign='TOP'>OBJETIVO</td></td><td colspan=3><b>$obj</b></td></tr>
							<tr><td height=10></td></tr>
							<tr><td><td valign='TOP'>ANALISIS</td></td><td colspan=3><b>$ana</b></td></tr>
							<tr><td height=10></td></tr>
							<tr><td><td valign='TOP'>PLAN</td></td><td colspan=3><b>$pla</b></td></tr>
							<tr><td height=10></td></tr>
							<tr><td><td></td></td><td colspan=2><a href='#' onclick='impre($iden_evo)'><b>Ver evolcin completa</b></a></td></tr>
							<tr><td height=20></td></tr>";
						}
					}
					$n=$n+1;
				}
				echo"
				 <input type=hidden name=ubica value=$ubica>
				 <input type=hidden name=fin value=$fin>
				 <input type=hidden name=fecdia value=$fecdia>
				 <input type=hidden name=usuar value=$usuar>
				 <input type=hidden name=iden_evo>
				 
				</td></tr></table>";
			}
		}	
		else
		{
			echo "<center><h3>No hay Historico de Este usuario</h3></center>";
		}

}
function convertir($str)
{
	$legalChars = "%[^0-9\-\. ]%";
	$str=preg_replace($legalChars,"",$str);
	return $str;
}	
?>
</table>


</form>
</center>
</center>
</body>
</html>