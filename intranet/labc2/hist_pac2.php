<html>
<head>
<title></title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<SCRIPT LANGUAGE='JavaScript'>
//var x=screen.availWidth-350
//Windows.moveTo(x,60)

 function regresa()
 {
	
	form1.submit();
 }

</script>
<?php

$link=Mysql_connect("localhost","root","");
if(!$link)echo"no hay conexion";
Mysql_select_db('proinsalud',$link);

echo "<form name=form1 method=post action=hist_pac.php target=''>";
echo "<table border=0 class='Tbl1'>";
echo "<tr><td colspan=6 class='Td1'>Resultados de Examenes orden: $ord_lab<td></tr>";
echo "<input type=hidden name='ord_lab' value='$ord_lab'>";
echo"<input type=hidden name=codusu value='$codusu'>";
echo "<input type=hidden name='cod' value=$cod>";
echo "</table>";
		

$con_hemo=mysql_query("SELECT `iden_dlab`,`hemoglobin`, `neutrofilos`, `hematrocit`, `cayados`, `vsg1h`, `linfocito`, `leococitos`, `eosinofilos`, 
		   `monocitos`, `basofilos`, `plaquetas`, `reticuloci`, `observacion` 
			FROM `cuadroh` WHERE num_fac='$ord_lab'");
			
		if(mysql_num_rows($con_hemo)<>0)
		{
				while($rowch=mysql_fetch_array($con_hemo))
				{
					
					$hemo_ch=$rowch[hemoglobin];
					$hema_ch=$rowch[hematrocit];
					$vs_ch=$rowch[vsg1h];
					$leu_ch=$rowch[leococitos];
					$pla_ch=$rowch[plaquetas];
					$neu_ch=$rowch[neutrofilos];
					$lin_ch=$rowch[linfocito];
					$eos_ch=$rowch[eosinofilos];
					$mon_ch=$rowch[monocitos];
					$bas_ch=$rowch[basofilos];
					$ret_ch=$rowch[reticuloci];
					$cay_ch=$rowch[cayados];
					$obs_ch=$rowch[observacion];
				
				}
				
				echo"<table width=80% border=1  align='center' bordercolor=#BED1DB bgcolor=#FFFFFF>
				<tr><td class='Td1' align='center' colspan=10><STRONG>CUADRO HEMATICO</strong></td></tr>
				<tr>
				 <th colspan=10 bgcolor=#BED1DB>CARACTERISTICAS GENERALES</tr>";

				echo"
				<tr>
				 <td>Hemoglobina:<b> $hemo_ch gr/dl</td>
				 <td>Hematrocito:<b> $hema_ch</td>
				</tr>";
				
				echo"
				<tr>
				<td>Leucocitos:<b> $leu_ch /mm³</td>
	            <td>Plaquetas:<b> $pla_ch /mm³</td>
				</tr>";
				echo"
				<tr>
				<td>Neutrofilos:<b> $neu_ch%</td>
				<td>Linfoncitos:<b> $lin_ch%</td>
				</tr>";
				echo"  
				<tr>
				<td>Eosinofilos:<b> $eos_ch %</td>
				<td><div align=left>Monocitos:<b> $mon_ch %</td>
				</tr>  ";      
				echo"
				<tr >
				<td>Basofilos:<b>$bas_ch %</td>
				<td>Reticulocitos:<b>$ret_ch %</td>
				</tr> ";
				echo"
				<tr>
				<td>VSG1h :<b> $vs_ch m.m/h</td>
				<td>Cayados:<b> $cay_ch % </td>
				</tr>";
				echo"
				<tr >
				<td colspan=10><p><strong>OBSERVACIONES:</strong></p></td>
				</tr>";
				echo"
				<tr >
				<td colspan=10><p align=left><b>$obs_ch</textarea></p></td></tr></table>";
			

		}	

	$con_cop=mysql_query("SELECT `iden_cop`, `iden_dlab`, `num_fac`, `cod_examen`, `fec_rec`, `fec_ent`, `cod_usu`, 
		`consistenc`, `bh`, `blastocyst`, `qc`, `QEColi`, `color`, `ch`, `chilomasti`, `ph`, `tz`, `trofozoito`, 
		`moco`, `sangreocul`, `otros`, `azucaresre`, `writh`, `levadura`, `neutrofilo`, `micelios`, `linfocitos`,
		`grasa_neut`, `eosinofilo`, `flora_bact`, `qh`, `qehistolyt`, `qn`, `qemana`, `observaciones`, `no`, `val` 
		 FROM `coprol` WHERE num_fac='$ord_lab'");
		
	if(mysql_num_rows($con_cop)<>0)
	{	
		
		while($rowcp=mysql_fetch_array($con_cop))
		{
			$ph_cps=$rowcp[ph];
			$color_cps=$rowcp[color];
			$con_cps=$rowcp[consistenc];
			$san_cps=$rowcp['sangreocul'];
			$azu_cps=$rowcp[azucaresre];
			$val_cps=$rowcp['val'];
			$moc_cps=$rowcp[moco];
			$lev_cps=$rowcp[levadura];
			$codig_usu=$rowcp[cod_usu];
			$mic_cps=$rowcp[micelios];
			$gra_cps=$rowcp[grasa_neut];
			$flo_cps=$rowcp[flora_bact];
			$hom_cps=$rowcp[qn];
			$qeh_cps=$rowcp[qh];
			$qem_cps=$rowcp[qemana];
			$otrcpr_cps=$rowcp[otros];
			$bla_cps=$rowcp[blastocyst];
			$chi_cps=$rowcp[chilomasti];
			$tro_cps=$rowcp[trofozoito];
			$wri_cps=$rowcp[writh];
			$neu_cps=$rowcp[neutrofilo];
			$lin_cps=$rowcp[linfocitos];
			$eos_cps=$rowcp[eosinofilo];
		}
		echo "<table width=80% border=1  align='center' bordercolor=#BED1DB bgcolor=#FFFFFF>
			<tr><td class='Td1' align='center' colspan=10><STRONG>COPROSCOPICO/COPROLOGICO</strong></td></tr>
	   	    <tr><th colspan=4 bgcolor=#BED1DB><p>CARACTERISTICAS GENERALES</p></tr>";
	    echo"<tr><td colspan=4><div align=left><strong>COPROSCOPICO</strong></div></td></tr>";
		
		echo"
		<tr>
		<td>PH:<b>$ph_cps</td>
		<td>Color: <b>$color_cps </td>
		<td>Consistencia:<b> $con_cps</td>
		<td>Sangre Oculta: <b>$san_cps</td>
		</tr>";
			
		echo "
		<tr>
	    <td colspan='6'>Azucares Reductores:<b> $azu_cps mg/l</td></tr>";
	  
		echo" 
		<tr>
		<td colspan=6><div align=left><strong>COPROLOGICO</strong></div></td></tr>";
		
		echo"
		<tr>
		<td><div align=left>Moco:<b> $moc_cps</td>
		<td><div align=left>Levaduras:<b> $lev_cps</td>
		<td><div align=left>Micelios:<b> $mic_cps</td>
		<td><div align=left>Grasas Neutras :<b> $gra_cps</td>
		</tr>";
		
				
		echo "<tr>
		<td>Flora Bacteriana:<b> $flo_cps</td></div>
		<td>Quiste.E.coli:<b> $hom_cps</td></div>
		<td>Quiste.E. histolytica :<b> $qeh_cps </div></td>
		<td>Q.E.nana :<b> $qem_cps</div></td>
		</tr>
		<tr>
			<td>Otros:<b>$otrcpr_cps</td>
			<td>Blastocystis Hominis:<b> $bla_cps </div></td>
			<td><div align='left'>Chilomastix mesnilli:<b>$chi_cps</td>
			<td><div align='left'>Trofozoitos:<b>$tro_cps</td>
	    </tr>
		<tr>
			<td><div align='left'>Wright:<b>$wri_cps</td>
			<td><div align=left>Neutrofilos:<b>$neu_cps%</td>
			<td><div align=left>Linfoncitos:<b>$lin_cps%</td>
			<td><div align=left>Eosinofilos:<b>$eos_cps%</div></td>
		</tr>";
	}
	
	//////////////////////UROANALISIS
	
	$consuru=mysql_query("SELECT iden_dla , ced_usu , aspectos , color , ph , densidad , albumina , glucosa , cetonas ,
		pigm_biliares , sangre , urobilinogeno,val_uru,nitritos , leucocitos , epiteliales , hermaties ,valo_hem ,cilidros , cristales ,valo_cri,
		moco ,esc2, levadura , bacterias ,esc,esp ,tricomonas , obervaciones FROM uroana WHERE  num_fac ='$ord_lab'");
		
		//echo $consuru;
	if(mysql_num_rows($consuru)<>0)
	{	
		while($rowuru=mysql_fetch_array($consuru))
		{
			$asp_uru=$rowuru[aspectos];
			$leu_uru=$rowuru[leucocitos];
			$color_uru=$rowuru[color];
			$epi_uru=$rowuru[epiteliales];
			$ph_uru=$rowuru[ph];
			$her_uru=$rowuru[hermaties];
			$hem_uru=$rowuru[valo_hem];
			$den_uru=$rowuru[densidad];
			$cili_uru=$rowuru[cilidros];
			$cris_uru=$rowuru[cristales];
			$cri_uru=$rowuru[valo_cri];
			$alb_uru=$rowuru[albumina];
			$glu_uru=$rowuru[glucosa];
			$cet_uru=$rowuru[cetonas];
			$pig_uru=$rowuru[pigm_biliares];
			$san_uru=$rowuru[sangre];
			$val_uru=$rowuru[val_uru];
			$lev_uru=$rowuru[levadura];
			$obs_uru=$rowuru[obervaciones];
			$moco_uru=$rowuru[moco];
			$esc2_uru=$rowuru[esc2];
			$bac_uru=$rowuru[bacterias];
			$esc_uru=$rowuru[esc];
			$tri_uru=$rowuru[tricomonas];
			$uro_uru=$rowuru[urobilinogeno];
			$esp_uru=$rowuru[esp];
			$nit_uru=$rowuru[nitritos];
			
			
			
		}
		echo "<br><br><table width=80% align='center' border=1  bordercolor=#BED1DB bgcolor=#FFFFFF>
	  	 <tr><th class='Td1' colspan=4 bgcolor=#BED1DB><p>UROANALISIS</p></tr>";
	    
		echo"<tr>
			<div align=center><th bgcolor=#BED1DB><span class=Estilo32>Caracteres Generales</span></th></div>
			<div align=center> <th bgcolor=#BED1DB ><span class=Estilo32>Sedimentos </span></th></div></tr>";

		echo"<tr class=Estilo33><td><div align=left><span>Aspectos: <b>$asp_uru </span></div></td>
			<td ><div align=center class=Estilo33><div align=left><span >Leucocitos: <b>$leu_uru/ul</td>
		</tr>";
	
		
		echo"<tr class=Estilo33><td><div align=left><span>Color:<b> $color_uru </span></div></td>
			 <td><div align=left><span>C. Epiteliales <b>$epi_uru  $altas</span></div></td>
		  </tr>";

		echo"<tr class=Estilo33><td><div align=left><span >P.H: <b>$ph_uru</span></div></td>
				<td><div align=left><span class=Estilo33>Hematies: <b>$her_uru $hem_uru /ul</span></div></td>
		
        </tr>";

		echo"<tr class=Estilo33>
		  <td><div align=left><span class=Estilo33>Densidad:<b> $den_uru</span></div></td>
		  <td><div align=left><span class=Estilo33>Cilindros: <b>$cili_uru /ul</span></div></td>
		  </tr>";

		echo"<tr class=Estilo33><td><div align=left><span class=Estilo33>Albumina:<b>$alb_uru mg/dl</span></div></td>
				<td><div align=left><span class=Estilo33>Cristales:<b>$cris_uru $cri_uru /ul</span></div></td>
			  </tr>";

		echo"<tr class=Estilo33><td><div align=left><span class=Estilo4>Glucosa: <b>$glu_uru mg/dl</span></div></td>
	        <td><div align=left>Moco:<b> $moco_uru $esc2_uru</div></td>
        	</tr>";

		echo"<tr ><td><div align=left><span >Cetonas:<b>$cet_uru mg/dl</span></div></td>
				<td><div align=left>Levadura:<b> $lev_uru</span></div></td>
			</tr>";

		echo"<tr class=Estilo33><td><div align=left>Pigmentos Biliares<b> $pig_uru</span></div></td>
				<td><div align=left><span class=Estilo33>Bacterias <b>$bac_uru $esc_uru</span></div></td>
			</tr>";

		echo"<tr class=Estilo33><td><div align=left>Sangre <b>$san_uru mg/dl</span></div></td>
				<td><div align=left>Tricomonas: <b>$tri_uru</span></div></td>
			</tr>";

		echo"<tr class=Estilo33><td><div align=left>Urobilinogeno<b> $uro_uru $val_uru</span></div></td>
				
				<td>Espermatozoides: <b>$esp_uru<div align=center></div></td>
				
		 </tr>";
		echo"
		<tr>
		  <td><div align=left>Nitritos: <b>$nit_uru</div></td>
		  </tr>
			<tr><td><div align=left>Otros: <b>$con_uru</div></td>
				
		</tr>";

		 echo"<tr>
				<td colspan=5>
				  <p align=left ><strong>OBSERVACIONES:<b>$obs_uru</strong></p></td>
				 <tr>";
		
	}
	//////////////////////////////////////////////////FROTIS VAGINAL ///////////////
		
	  $confr=mysql_query("SELECT `iden_fro`, `iden_dlab`,  `ph`, 
		`testaminas`, `koh`, `trichomava`, `pmn`, `celulasgui`, `levaduras`, `seudomicel`, `lactobacil`, `cocos`, 
		`bacilos`, `cocobacilo`, `grampositi`, `gramnegati`, `granv`, `pmnxcamcer`, `diplointra`, `diploextra`,
		`observaciones` FROM frotis  WHERE num_fac ='$ord_lab'");
	
	if(mysql_num_rows($confr)<>0)
	{
		while($rowfv=mysql_fetch_array($confr))
		{
			$ph_ftv=$rowfv['ph'];
			$tea_ftv=$rowfv[testaminas];
			$koh_ftv=$rowfv[koh];
			$tcv_ftv=$rowfv[trichomava];
			$pmc_ftv=$rowfv['pmn'];
			$ceg_ftv=$rowfv[celulasgui];
			$lev_ftv=$rowfv[levaduras];
			$seu_ftv=$rowfv[seudomicel];
			$lac_ftv=$rowfv[lactobacil];
			$cocos=$rowfv[cocos];	
			$bacilos=$rowfv[bacilos];
			$cocobacilo=$rowfv[cocobacilo];
			$grampositi=$rowfv[grampositi];
			$gramnegati=$rowfv[gramnegati];
			$granv  =$rowfv[granv];
			$pmnxcamcer=$rowfv[pmnxcamcer];
			$dgni_ftv=$rowfv[diplointra];
			$dgne_ftv=$rowfv[diploextra];
			$obsfrt_ftv=$rowfv[observaciones];
	
		}
		echo "<br><br><table width=80% align='center' border=1  bordercolor=#BED1DB bgcolor=#FFFFFF>
	  	 <tr><th class='Td1' colspan=5 bgcolor=#BED1DB><p>FROTIS VAGINAL</p></tr>";
		
		echo " <tr>
		 <th colspan=5 bgcolor=#BED1DB>
		 <p class=Estilo9>CARACTERISTICAS</p>
	  	 </tr>";
	
		echo " 
			 <tr><td colspan=4 ><p align=left><strong>FRESCO</strong></p></td></tr>";
		echo "<tr>
			<td width=30%><div align=left class=Estilo9>PH: <b> $ph_ftv </td>
			
			<td width=30%><div align=left class=Estilo9>Test De Aminas: <b>$tea_ftv </td>
   		    <td width=30%><div align=left class=Estilo9>KOH: <b>$koh_ftv </td>
		
    		<td width=50%><div align=left class=Estilo9>Trichoma Vaginalis: <b> $tcv_ftv </div></td></tr>";
		echo "<tr>
        <td colspan=4><strong>GRAMA VAGINAL</strong></span> </td>
		</tr>
		<tr>
	        <td><div align=left>PMN(X CAMPO):<b>$pmc_ftv XC</div></td>
			<td class=Estilo9 ><div align=left>Celulas Guias: <b>$ceg_ftv </div></td>
			<td ><div align=left class=Estilo9>Seudomicelios: <b>$seu_ftv </div></td>
			<td><div align=left class=Estilo9>Lactobacilos:<b> $lac_ftv </div></td>
		</tr>
		<tr>
			<td><div align=left class=Estilo9 colspan=2>Levaduras: <td colspan=4><b>$lev_ftv </div></td>
		</tr>";
		
       echo "<tr>
			<td colspan=4 ><div align=left>
			<p><strong><span class=Estilo9>FLORA PREDOMINANTE </span></strong></p>
			</div></td></tr>
			<tr><td><div align=right class=Estilo9>MORFOLOGIA:</div></td>";
			
		if($cocos <>'')
			{ echo '<td><b>'.$cocos;}
		if($bacilos <>'')
			{ echo '<td><b> '.$bacilos;}
		if($cocobacilo <>'')
			{ echo '<td><b> '.$cocobacilo;}
			
			
		echo"</td></tr>
			<tr><td >&nbsp;</td>";
		
		if($grampositi <>'')
			{ echo'<td><b> '. $grampositi;}
		if($gramnegati <>'')
			{ echo '<td><b> '.$gramnegati;}
		if($granv <>'')
			{ echo '<td><b> '. $granv;}
			
			echo"<tr>
			<td colspan=4 ><div align=left>
			<p class=Estilo9><strong>GRAM CERVICAL</strong></p></div></td>
			</tr>";
			echo "<tr>
			<td>
			<div align=left class=Estilo9>PMN(X CAMPO): <b>$pmnxcamcer XC</span></td>
			<td colspan=2><div align=left>Diplococos Gram Negativos Intracelulares: <b>$dgni_ftv
            <td><span >Diplococos Gram Negativos Estracelulares: <b>$dgne_ftv</td>
           	</tr>";
			echo"<tr>
			<td><p align= right><strong>OBSERVACIONES:<td colspan=4> <b>$obsfrt_ftv</strong></p></td>
			</td></tr></table>";
			
	}
	////////////////////////////////////////CUADRO VARIOS///////////////////////////
	$consdv=mysql_query("SELECT datos FROM dat_varios WHERE num_fac ='$ord_lab'");
	
	if(mysql_num_rows($consdv)<>0)
	{
	
		while($rowdv=mysql_fetch_array($consdv))
		{
		
			$datos=$rowdv[datos];
			
		}
		
		echo "<br><br><table width=80% align='center' border=1  bordercolor=#BED1DB bgcolor=#FFFFFF>
		<tr><td class='Td1' align='center' colspan=5><STRONG>CUADRO DE VARIOS</strong></td></tr>";
		
		echo "<tr >
			    <td colspan=5 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr> ";

			 echo"<tr>
			        <td align=center><strong>DATOS </strong></td>
			         <td colspan=4><b>$datos</textarea></td>			        
			      </tr></table>";
	
	}
	////////////////////////////////bHCG//////////////////////////////////
	
	$consbhcg=mysql_query("SELECT lab_bhc  FROM  labo_bhc  WHERE num_fac ='$ord_lab'");
		
	if(mysql_num_rows($consbhcg)<>0)
	{
		while($rowhc=mysql_fetch_array($consbhcg))
		{
		
			$lab_bhc=$rowhc[lab_bhc];
						
		}
		
	
		echo "<br><br><table width=80% align='center' border=1  bordercolor=#BED1DB bgcolor=#FFFFFF>
		<tr><td class='Td1' align='center' colspan=5><STRONG>BHCG</strong></td></tr>";
		
		echo "
	  	 <tr><td bgcolor=#BED1DB colspan=5><strong>CARACTERISTICAS GENERALES</td></tr>";

		echo"
		  <tr><td></td><td align=center><b>Unidades</td></tr>"; 
		echo "
		  <tr >
			<td >Determinacion Cualitativa en suero de hormona Ganadotropina Corionica (HCG) </td>
			<td><b>$lab_bhc </span>mUI/ml</td> 
			</tr>";
		echo "
		  <tr>
			<td colspan=5><b>Nota:</td>
			</tr>"; 
		echo"
		<tr><td colspan=5>Tecnica Microelisa rapida sensibilidad 10 mIU/ml</td></tr></table>";
	}
	////////////////////////////////////////////////troponina///////////////////////////////
	
	
	$contp=mysql_query("SELECT iden_dlab,lab_trim FROM labo_tri  WHERE num_fac ='$ord_lab' ");
	if(mysql_num_rows($contp)<>0)
	{
		while($rowtp=mysql_fetch_array($contp))
		{
			$trim_tpn2=$rowtp[lab_trim];
		}
		echo "<br><br><table width=80% align='center' border=1  bordercolor=#BED1DB bgcolor=#FFFFFF>
		<tr><td class='Td1' align='center'><STRONG>TROPONINA</strong></td></tr>";
	
		echo "<br><br>
	  	     <tr>
             <td colspan=3 bgcolor=#BED1DB align=center><b>CARACTERISTICAS GENERALES </td></tr>";
		echo"
		  <tr>
			<td>Triponima I :<b>$trim_tpn2</td>
			
		  </tr>
		  <tr><td colspan=3 ><b>Nota</td></tr>
          <tr><td colspan='3' >Tecnica Prueba Rapida de Inmunocromotografia</td></tr></table>";
	}
	
	////////////////////////////////////////////////////////hcg//////////////////////////////////
	
	
	
	$conshc=mysql_query("SELECT resul_exam,  observaciones   FROM hcg  WHERE iden_dlab='$iden_labs'");
	if(mysql_num_rows($contp)<>0)	
	{
   	   while($rowhc=mysql_fetch_array($conshc))
		{
		
			$resul=$rowhc[resul_exam];
			$obs=$rowhc[observaciones];
			
		}
		
		
		echo "<br><br><table width=80% align='center' border=1  bordercolor=#BED1DB bgcolor=#FFFFFF>
		<tr><td class='Td1' align='center' colspan=2><STRONG>HCB -G</strong></td></tr>
		<tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "
		<tr><td colspan=2><div align='center'>Resultado: <b>$resul M UI / ml</td>
		<tr>";
	  
		echo"
		   <tr>
		   <td> <div align='left'><strong>Semana  </strong></div></td>
		   <td> <div align='left'><strong >V.    R  </strong></div></td></tr>
		   <tr><td>3 </td><td>5.8 -71.2</td></tr>
		   <tr><td>4 </td><td>9.5 - 750 </td></tr>
		   <tr><td>5 </td><td>217 - 7138 </td></tr>
		   <tr><td>6 </td><td>158 - 31.795</td></tr>
		   <tr><td>7 </td><td>3.697 - 163.563</td></tr>
		   <tr><td>8 </td><td>32.065 - 149.571</td></tr>
		   <tr><td>9 </td><td>63.803 - 151.410</td></tr>
		   <tr><td>10 </td><td>46. 509 - 186.977</td></tr>
		   <tr><td>12 </td><td>27.832 - 210.612</td></tr>
		   <tr><td>14 </td><td>13.950 - 62.530</td></tr>";
		
		echo"
		  <tr>
			<td colspan=2><div align=left>
				<p><strong>OBSERVACIONES: <b>$obs_hcg</strong></p>
			</div></td>
		  </tr></table>";
		
		
	
	}
	
	
?>
<table class='Tbl2' border=0>
    <tr>
	      <td align='center' width='45%'><a href='#' OnClick='regresa()'><img src='icons/regresar01.jpg' width='30' height='30' alt='Historico' ></a></td>
    </tr>
</table>

</form>
</body>
</html>