<?php
session_register('Gidusulab'); ?>
<html>
<head>
</head>
<body>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<style type="text/css">
<!--
.Estilo4 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #333366; }-->
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 8px; font-weight: bold; color: #333366 }
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #333366; }
-->
</style>
<script language='javascript'>

function gua_bd(op,it)
{
	//alert(op);
	form1.ic.value=it;
	form1.jl.value=it;
	form1.format.value=op;
	form1.funct.value=1;
	form1.target='';
	form1.action='guarda_formato.php';
	form1.submit();	

}

function habilitar(pos) {
var comando='';
comando="form1.obsv_dlab"+pos+".disabled=false";
eval(comando);
comando="form1.refe_dlab"+pos+".disabled=false";
eval(comando);
comando="form1.unid_dlab"+pos+".disabled=false";
eval(comando);
comando="form1.remi"+pos+".disabled=false";
eval(comando);
}

function prueba(valor)
{
		if(document.getElementById("chk_nn").checked){
			document.getElementById("hbl_").disabled= true;
			document.getElementById("ani_").disabled= true;
			document.getElementById("macro_").disabled= true;
			document.getElementById("micro_").disabled= true;
			document.getElementById("poiq_").disabled= true;
			document.getElementById("dian_").disabled= true;
			document.getElementById("esqu_").disabled= true;
			document.getElementById("otr_").disabled= true;
			document.getElementById("poli_").disabled= true;
		}	
		else
		{
			document.getElementById("hbl_").disabled= false;
			document.getElementById("ani_").disabled= false;
			document.getElementById("macro_").disabled= false;
			document.getElementById("micro_").disabled= false;
			document.getElementById("poiq_").disabled= false;
			document.getElementById("dian_").disabled= false;
			document.getElementById("esqu_").disabled= false;
			document.getElementById("otr_").disabled= false;
			document.getElementById("poli_").disabled= false;
		
		}
	}
	
	function habilita(vl,dat)
	{
		if(document.getElementById("hbl_").checked)
		document.getElementById("hip_esp").disabled =false;
		else document.getElementById("hip_esp").disabled=true;
		if(document.getElementById("ani_").checked)
		document.getElementById("ani_esp").disabled =false;
		else document.getElementById("ani_esp").disabled=true;
		if(document.getElementById("macro_").checked)
		document.getElementById("mcr_esp").disabled =false;
		else document.getElementById("mcr_esp").disabled=true;
		if(document.getElementById("micro_").checked)
		document.getElementById("mic_esp").disabled =false;
		else document.getElementById("mic_esp").disabled=true;
		if(document.getElementById("poiq_").checked)
		document.getElementById("pqu_esp").disabled =false;
		else document.getElementById("pqu_esp").disabled=true;
		if(document.getElementById("dian_").checked)
		document.getElementById("dic_esp").disabled =false;
		else document.getElementById("dic_esp").disabled=true;
		if(document.getElementById("esqu_").checked)
		document.getElementById("esq_esp").disabled =false;
		else document.getElementById("esq_esp").disabled=true;
		if(document.getElementById("otr_").checked){
		document.getElementById("otr_mcn").disabled =false;
		document.getElementById("org_esp").disabled =false;
		}
		else
		{
			document.getElementById("otr_mcn").disabled=true;
			document.getElementById("org_esp").disabled =true;
		}
		if(document.getElementById("poli_").checked)
		document.getElementById("poli_esp").disabled =false;
		else document.getElementById("poli_esp").disabled=true;
	}


</script>
<form name='form1' target="fr2">
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
	include('php/funciones.php');
	include('php/conexion.php');
	//mysql_connect("localhost","root",""); 
	//mysql_select_db("proinsalud");
	
	
	//echo 'toy'.$opcex;
	echo"<input type=hidden name=cod value=$iden_uco>";
	echo"<input type=hidden name=codig_usu value=$iden_uco>";
	echo"<input type=hidden name=opcex value=$opcex>";
	echo"<input type=hidden name=iden_labs value=$iden_labs>";
	echo"<input type=hidden name=nord_lab value=$nord_lab>";
	
	echo "<table class='Tbl0'>";
	echo "<tr><td class='Th0' width='15%'><strong>IDENTIFICACION</td>
		      <td class='Th0' width='50%'><strong>NOMBRE</td>
			  <td class='Th0' width='10%'><strong>EDAD</td>
			  <td class='Th0' width='10%'><strong>SEXO</td>
			  <td class='Th0' width='15%'><strong>CONTRATO</td></tr>";
	
	$conusu =mysql_query("SELECT NROD_USU,CODI_CON,CODI_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU,
					   TPAF_USU,CONT_UCO,NEPS_CON,IDEN_UCO,CUSU_UCO FROM usuario, ucontrato,contrato WHERE CODI_USU=CUSU_UCO AND CONT_UCO=CODI_CON 
					   AND CUSU_UCO ='$iden_uco'");
	//echo $conusu;
	
	$rowu = mysql_fetch_array($conusu);
	echo "<input type=hidden name=iden_uco value=$iden_uco>";
	echo"<input type=hidden name=fac_num value='$fac_num'>";
	$giden_uco=$rowu['IDEN_UCO'];
	echo "<tr><td class='Td4'>$rowu[NROD_USU]</td>";
	echo"<input type=hidden name=area value=$area>";
	echo"<input type=hidden name=ide_cita value=$ide_cita>";
	$nombre= $rowu[PNOM_USU]." ".$rowu[SNOM_USU]." ".$rowu[PAPE_USU]." ".$rowu[SAPE_USU];
	echo"<td class='Td4'>$nombre</td>";
	$edad=calculaedad($rowu['FNAC_USU']);
	echo"<td class='Td4'>$edad</td>
	   <td class='Td4'>$rowu[SEXO_USU]</td>
	   <td class='Td4'>$rowu[NEPS_CON]</td></tr></table>";
	
	
	//////////////examenes quimicos
	
	if($opcex=='21')
	{
		
		//echo $iden_labs;
		echo"<table class='Tbl0' border=1>";
		echo "<br><tr>
		<td class='Th0' width=5%><strong><center>OP</strong></td>
		<td class='Th0' width=5%><strong><center>Codigo</strong></td>
		<td class='Th0'><strong><center>Nombre</strong></td>
		<td class='Th0'><strong><center>Observaciones</strong></td>
		<td class='Th0'><strong><center>unidades</strong></td>
		<td class='Th0'><strong><center>Referencia</strong></td>
		<td class='Th0'><strong><center>Bacteriolog@</strong></td></tr>";
		
		
		$conexa=mysql_query("SELECT dl.iden_dlab ,dl.iden_labs,dl.estd_dlab,dl.codigo,dl.nord_dlab,cp.descrip,
			dl.obsv_dlab, dl.refe_dlab,dl.unid_dlab,dl.cod_medi  
		    FROM detalle_labs AS dl
			INNER JOIN cups AS cp ON cp.codigo=dl.codigo
		    WHERE dl.iden_labs='$iden_labs'AND dl.estd_dlab<>'EL'");
		
		//echo $conexa;
		$jl=0;
		while($rowex = mysql_fetch_array($conexa))  
		{
		   $codigo=$rowex[codigo];
		   $descrp=$rowex[descrip];
		   $obsv_dlab=$rowex[obsv_dlab];
		   $refe_dlab=$rowex[refe_dlab];
		   $unid_dlab=$rowex[unid_dlab];
		   $estd_dlab=$rowex[estd_dlab];
		   $iden_dlab=$rowex[iden_dlab];
		   $estd_dlab=$rowex[estd_dlab];
		   $cod_bac=$rowex[cod_medi];
		   //echo $estd_dlab;
		   
		   		
		   $nomvar='iden_dlab'.$jl;
		   echo "<input type=hidden name=$nomvar value=$iden_dlab>";	
		  
		    $nomvar='codigo'.$jl;
			echo"<input type=hidden name=$nomvar value=$codigo>";
			
			//$nomvar='remi'.$jl;
			//echo"<input type=hidden name=$nomvar value=$estd_dlab>";
			
			$nomvar='vchk'.$jl;			
			echo "<tr>";
			//echo "<td class='Td4'><input type=checkbox name=$nomvar value=1  onclick='habilitar($jl)'>";
		   if($Gidusulab==$cod_bac)
			{
				echo "<td class='Td4'><input type=checkbox name=$nomvar value=1  onclick='habilitar($jl)'>";
			}
			else
			{
				echo "<td class='Td4'><input type=checkbox name=$nomvar value=1 disabled'>";
				
				
			}
			
			if($estd_dlab=='RE')
			{
				$nomvar='remi'.$jl;
				echo"<input type=checkbox name=$nomvar value='1' checked disabled></td>";
			}
			else
			{
				$nomvar='remi'.$jl;
				echo"<input type=checkbox name=$nomvar value='1' disabled></td>";
				
			
			}
			
			echo"<td><br><span class='Estilo7'>$codigo</span></td>";
		    echo "<td><br><span class='Estilo6'>$descrp</span></td>";
			
			
			
			$nomvar='obsv_dlab'.$jl;
			echo "<td><br><span class='Estilo7'><input type=text name='$nomvar' value='$obsv_dlab' disabled></span></td>";
			
			
			$nomvar='refe_dlab'.$jl;
			echo "<td><br><span class='Estilo7'><input type=text name='$nomvar'  value='$refe_dlab' disabled></span></td>";
			
			
			$nomvar='unid_dlab'.$jl;
		    echo "<td><br><span class='Estilo7'><input type=text name='$nomvar'  value='$unid_dlab' disabled></span></td>";
		
			$cons_medi=mysql_query("SELECT nom_medi  FROM medicos  WHERE ced_medi='$cod_bac'");
			$rowmedi = mysql_fetch_array($cons_medi);
			$medico=$rowmedi[nom_medi];
            echo "<td><span class='Estilo6'></a>$medico</td></tr>";
		   echo "<td><span class='Estilo6'></a></td></tr>";
		   
		$jl++;
		
		
		
		}  
		echo" <br><td colspan=7><input type=button value=Guardar onClick='gua_bd(21,$jl)'></tr>";
	}
	
	echo"<input type=hidden name=jl>";
	
	
	
	//////////////uroanalisis
	
	
	if($opcex=='1')
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>UROANALISIS</strong></td></tr>
		</table>";

		$consuru=mysql_query("SELECT iden_dla , ced_usu , aspectos , color , ph , densidad , albumina , valo_gluc,glucosa , cetonas ,
		pigm_biliares , sangre , urobilinogeno,val_uru,nitritos , leucocitos , epiteliales , hermaties ,valo_hem ,cilidros , cristales ,valo_cri,
		moco ,esc2, levadura , bacterias ,esc,esp ,tricomonas , obervaciones FROM uroana WHERE iden_dla=$iden_labs");
		
		//echo $consuru;
		
		while($rowuru=mysql_fetch_array($consuru))
		{
			
			$asp_uru=$rowuru[aspectos];
			$valo_gluc=$rowuru[valo_gluc]; 
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
		
		echo"<br><br><table width=50% height=20 border=1 align=center cellspacing=1 bordercolor=#BED1DB bgcolor=#FFFFFF>
			<tr><div align=center><th height=20 colspan=2 bgcolor=#BED1DB><span class=Estilo32>Caracteres Generales</span></th></div>
			<div align=center> <th height=20 colspan=2 bgcolor=#BED1DB ><span class=Estilo32>Sedimentos </span></th></div></tr>";

		echo"<tr class=Estilo33><td width=55><div align=left><span>Aspectos: </span></div></td>
			<td width=25%>
				<select name=asp_uru>
				  <option></option>
				  <option value='Limpido'>Limpido</option>
				  <option value='Lig Turbio'>Lig Turbio</option>
				  <option value='Muy Turbio'>Muy Turbio</option>
				  <option value='Turbio'>Turbio</option>
				</select></td>
			<td width=25%><div align=center class=Estilo33><div align=left><span >Leucocitos</span></div></div></td>
			<td><input type=text name=leu_uru  value='$leu_uru' size='10' maxlength='12'>/ul</td>
		</tr>";
	
		
		echo"<tr class=Estilo33><td><div align=left><span>Color: </span></div></td>
			<td><span>
				<select name=color_uru >
				  <option>-</option>
				  <option value='Ambar'>Ambar</option>
				  <option value='Amarillo'>Amarillo</option>
				  <option value='Amarillo Intenso'>Amarillo Intenso</option>
				  <option value='Hematurico'>Hematurico</option>
				  <option value='Hidrulico'>Hidrulico</option>
				  <option value='Naranja'>Naranja</option>
				</select>
			</span></td>
        
			<td><div align=left><span>C. Epiteliales </span></div></td>
			<td><input type=text name=epi_uru  value='$epi_uru' size='10' maxlength='12'>/ul
			<input type=checkbox name=alt_uru  value='$altas'>Altas</td>
		  </tr>";

		echo"<tr class=Estilo33><td><div align=left><span >P.H:</span></div></td>
			<td><select name=ph_uru>
			  <option>-</option>
			  <option value='1.0'>1.0</option>
			  <option value='1.5'>1.5</option>
			  <option value='2.0'>2.0</option>
			  <option value='2.5'>2.5</option>
			  <option value='3.0'>3.0</option>
			  <option value='3.5'>3.5</option>
			  <option value='4.0'>4.0</option>
			  <option value='4.5'>4.5</option>
			  <option value='5.0'>5.0</option>
			  <option value='5.5'>5.5</option>
			  <option value='6.0'>6.0</option>
			  <option value='6.5'>6.5</option>
			  <option value='7.0'>7.0</option>
			  <option value='7.5'>7.5</option>
			  <option value='8.0'>8.0</option>
			  <option value='8.5'>8.5</option>
			  <option value='9.0'>9.0</option>
			  <option value='9.5'>9.5</option>
			  <option value='10.0'>10.0</option>
			</select></td>
			<td><div align=left><span class=Estilo33>Hematies</span></div></td>
				<td><select name=her_uru >
				<option >-</option>
				<option value='Normales'>Normales</option>
				<option value='Crenados'>Crenados</option>
				<option value='Eumorfos'>Eumorfos</option>
				<option value='Dismorfos'>Dismorfos</option>
				</select><input type=text name=hem_uru  value='$hem_uru' size='3' maxlength='12'>/ul</td>
        </tr>";

		echo"<tr class=Estilo33>
		  <td><div align=left><span class=Estilo33>Densidad</span></div></td>
		  <td><select name=den_uru>
			<option>-</option>
			<option value='1000'>1000</option>
			<option value='1005'>1005</option>
			<option value='1010'>1010</option>
			<option value='1015'>1015</option>
			<option value='1020'>1020</option>
			<option value='1025'>1025</option>
			<option value='1030'>1030</option>
		  </select></td>
			<td><div align=left><span class=Estilo33>Cilindros</span></div></td>
			  <td><input type=text name=cili_uru  value='$cili_uru' size='10' maxlength='12'>/ul</td>
		  </tr>";

		echo"<tr class=Estilo33><td><div align=left><span class=Estilo33>Albumina:</span></div></td>
				<td><span class=Estilo33><input type=text name=alb_uru  value='$alb_uru' size='10' maxlength='12'>mg/dl</span></td>
				<td><div align=left><span class=Estilo33>Cristales</span></div></td>
				<td><select name=cris_uru>
				<option>-</option>
				<option value='Acido Urico'>Acido Urico</option>
				<option value='Fosfatos Amorfos'>Fosfatos Amorfos</option>
				<option value='Uratos Amorfos'>Uratos Amorfos</option>
				<option value='Otros'>Otros</option>
			  </select>
			  <input  type=text name=cri_uru  value='$cri_uru ' size='3' maxlength='12'>/ul</td>
		  </tr>";

		echo"<tr class=Estilo33><td><div align=left><span class=Estilo4>Glucosa</span></div></td>
				<td><span class=Estilo33>
				<select name=oglu_uro>
				<option value='-'>------</option>
				<option value='Normal'>Normal</option>
				<option value='Otro'>Otro</option>
				</select>				
				<input type=text  name=glu_uru value='$glu_uru' size='10' maxlength='12'>mg/dl
				</span></td>
			   
        <td><div align=left>Moco</div></td>
        <td>
			<select name=moco_uru>
			  <option> </option>
			  <option value='-'>-</option>
			  <option value='+'>+</option>
			  <option value='++'>++</option>
			  <option value='+++'>+++</option>
			  <option value='++++'>++++</option>
		   </select>
		   <select name=esc2_uru>
          <option> </option>
		  <option value='Escaso'>Escaso</option>
		  </select></td>
		</tr>";

		echo"<tr ><td><div align=left><span >Cetonas</span></div></td>
				<td><input type=text  name=cet_uru value='$cet_uru' size='10' maxlength='12'>
				mg/dl</span></td>
				<td><div align=left>Levadura</span></div></td>
				<td><select name=lev_uru >
				  <option value='-'>-</option>
				  <option value='+'>+</option>
				  <option value='++'>++</option>
				  <option value='+++'>+++</option>
				  <option value='++++'>++++</option>
				</select></td>
		</tr>";

		echo"<tr class=Estilo33><td><div align=left>Pigmentos Biliares </span></div></td>
				<td><input type=text  name=pig_uru value='$pig_uru' size='10' maxlength='12'>
				</span></td>
				<td><div align=left><span class=Estilo33>Bacterias</span></div></td>
				<td><select name=bac_uru >
				 <option></option>
				  <option value='-'>-</option>
				  <option value='+'>+</option>
				  <option value='++'>++</option>
				  <option value='+++'>+++</option>
				  <option value='++++'>++++</option></select>
				  <select name=esc_uru>
				  <option> </option>
				  <option value='Escasas'>Escasas</option></select>
				</td>
		</tr>";

		echo"<tr class=Estilo33><td><div align=left>Sangre</span></div></td>
				<td><input type=text  name=san_uru value='$san_uru' size='10' maxlength='10'>
				mg/dl</span></td>
				<td><div align=left>Tricomonas</span></div></td>
				<td><select name=tri_uru>
				  <option value='-'>-</option>
				  <option value='+'>+</option>
				  <option value='++'>++</option>
				  <option value='+++'>+++</option>
				  <option value='++++'>++++</option>
				</select></td>
		</tr>";

		echo"<tr class=Estilo33><td><div align=left>Urobilinogeno</span></div></td>
				<td><span class=Estilo33><div align=left>
				  <select name=uro_uru>
					<option value='-'>-</option>
					<option value='Normal'>Normal</option>
					<option value='Otro'>Otro</option>
				  </select> <input type=text name=val_uru value='$val_uru' size=3 maxlength='10'>
				</div></td>
				<td>Espermatozoides
				  <div align=center></div></td>
				<td><select name=esp_uru >
				  <option value='-'>-</option>
				  <option value='+'>+</option>
				  <option value='++'>++</option>
				  <option value='+++'>+++</option>
				  <option value='++++'>++++</option>
				</select></td>
		 </tr>";
		echo"
		<tr>
		  <td><div align=right>Nitritos</div></td>
		  <td><select name=nit_uru>
			<option>-</option>
			<option value='Negativo'>Negativo</option>
			<option value='Positivo'>Positivo</option>
			</select></td></tr>
			<tr><td><div align=right>Otros:</div></td>
				<td colspan=3><span class=Estilo4>
				  <input type=checkbox name=con_uru value='contaminacion por secrecion vaginal'>                   
				  contaminacion por secrecion vaginal</td>
		</tr>";

		 echo"<tr>
				<td height=60 colspan=5><p align=left class=Estilo32></p>
				  <p align=left ><strong>OBSERVACIONES:</strong></p>
				  <p align=center ><strong><span class=Estilo32>
				  <textarea name=obs_uru value='$obs_uru' cols=50 rows=7></textarea>
				  </span></strong></p><p align=center class=Estilo32>
				  <span ></span></p></td><tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(1,1)><td></tr></table>";
	
		?> <script language="javaScript">form1.asp_uru.value='<?echo $asp_uru;?>';</script><?
		?> <script language="javaScript">form1.color_uru.value='<?echo $color_uru;?>';</script><?
		?> <script language="javaScript">form1.ph_uru.value='<?echo $ph_uru;?>';</script><?
		?> <script language="javaScript">form1.her_uru.value='<?echo $her_uru;?>';</script><?
		?> <script language="javaScript">form1.den_uru.value='<?echo $den_uru;?>';</script><?
		?> <script language="javaScript">form1.cris_uru.value='<?echo $cris_uru;?>';</script><?
		?> <script language="javaScript">form1.moco_uru.value='<?echo $moco_uru;?>';</script><?
		?> <script language="javaScript">form1.esc2_uru.value='<?echo $esc2_uru;?>';</script><?
		?> <script language="javaScript">form1.lev_uru.value='<?echo $lev_uru;?>';</script><?
		?> <script language="javaScript">form1.bac_uru.value='<?echo $bac_uru;?>';</script><?
		?> <script language="javaScript">form1.esc_uru.value='<?echo $esc_uru;?>';</script><?
		?> <script language="javaScript">form1.tri_uru.value='<?echo $tri_uru;?>';</script><?
		?> <script language="javaScript">form1.uro_uru.value='<?echo $uro_uru;?>';</script><?
		?> <script language="javaScript">form1.esp_uru.value='<?echo $esp_uru;?>';</script><?
		?> <script language="javaScript">form1.nit_uru.value='<?echo $nit_uru;?>';</script><?
		?> <script language="javaScript">form1.obs_uru.value='<?echo $obs_uru;?>';</script><?
		?> <script language="javaScript">form1.oglu_uro.value='<?echo $valo_gluc;?>';</script><?
	}
	////////////////FROTIS VAGINAL////////
	if($opcex==2)
	{
		$confr=mysql_query("SELECT `iden_fro`, `iden_dlab`,  `ph`, 
		`testaminas`, `koh`, `trichomava`, `pmn`, `celulasgui`, `levaduras`, `seudomicel`, `lactobacil`, `cocos`, 
		`bacilos`, `cocobacilo`, `grampositi`, `gramnegati`, `granv`, `pmnxcamcer`, `diplointra`, `diploextra`,
		`observaciones` FROM frotis  WHERE iden_dlab=$iden_labs");
	
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
						
			$pmnxcamcer=$rowfv[pmnxcamcer];
			$dgni_ftv=$rowfv[diplointra];
			$dgne_ftv=$rowfv[diploextra];
			$obsfrt_ftv=$rowfv[observaciones];
	
		}
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>FROTIS VAGINAL</strong></td></tr>
		</table>";
		echo " <br><br>
	  	 <table width=70% align=center border=1  bordercolor=#BED1DB bgcolor=#FFFFFF >
	  	 <tr><th colspan=5 bgcolor=#BED1DB>
		 <p class=Estilo9>CARACTERISTICAS</p>
	  	 </tr>";
	
		echo " 
			 <tr><td colspan=4 ><p align=left><strong>FRESCO</strong></p></td></tr>";
		echo "<tr>
			<td width=30%><div align=left class=Estilo9>PH:            
			<select name=ph_ftv>
				  <option>  </option>
	              <option value='1.0'>1.0</option>
	              <option value='2.0'>2.0</option>
	              <option value='3.0'>3.0</option>
	              <option value='4.0'>4.0</option>
	              <option value='5.0'>5.0</option>
	              <option value='6.0'>6.0</option>
	              <option value='7.0'>7.0</option>
	              <option value='8.0'>8.0</option>
	              <option value='9.0'>9.0</option>
	              <option value='10.0'>10.0</option>
			</select></div></td>
			
			<td width=30%><div align=left class=Estilo9>Test De Aminas:
        	  <select name=tea_ftv>
					<option> </option>
	                <option value='Negativo'>Negativo</option>
	                <option value='Positivo'>Positivo</option>
	                <option value='Otro'>Otro</option>
	          </select></div></td>

   		    <td width=30%><div align=left class=Estilo9>KOH:	
			<select name=koh_ftv>
					<option> </option>
					<option value='Negativo'>Negativo</option>
					<option value='Positivo'>Positivo</option>
					<option value='Otro'>Otro</option>
			</select></div></td>
		
    		<td width=50%><div align=left class=Estilo9>Trichoma Vaginalis:
            <select name=tcv_ftv>
				<option> </option>
                <option value='Negativo'>Negativo</option>
                <option value='Positivo'>Positivo</option>
                <option value='Otros'>Otros</option>
            </select>
         
        </div></td></tr>";
		echo "<tr>
        <td colspan=4><strong>GRAMA VAGINAL</strong></span> </td>
		</tr>
		<tr>
        <td><div align=left>PMN(X CAMPO):
        <select name=pmc_ftv>
          <option>-</option>
          <option value='0-1'>0-1</option>
          <option value='1-5'>1-5</option>
          <option value='5-10'>5-10</option>
          <option value='>10'>>10 </option>
        </select>XC</div></td>
		<td class=Estilo9 ><div align=left>Celulas Guias:
        		<select name=ceg_ftv>
				<option> </option>
	            <option value='Negativo'>Negativo</option>
	            <option value='Positivo'>Positivo</option>
	            <option value='Otro'>Otro</option>
        </select>
        </div></td>
		<td ><div align=left class=Estilo9>Seudomicelios:
          <select name=seu_ftv>
          <option>-</option>
		  <option value='Negativo'>Negativo</option>
          <option value='Abundante'>Abundante</option>
          <option value='Escaso'>Escaso</option>
          <option value='Moderado'>Moderado</option>
        </select>
		</div></td>
		<td><div align=left class=Estilo9>Lactobacilos:
            <select name=lac_ftv >
	        <option>-</option>
			<option value='Negativo'>Negativo</option>
	        <option value='Abundante'>Abundante</option>
	        <option value='Escaso'>Escaso</option>
	        <option value='Moderado'>Moderado</option>
          </select>
        </div></td></tr>
		<tr><td><div align=left class=Estilo9>Levaduras:
            <select name=lev_ftv >
			<option>-</option>
			<option value='Negativo'>Negativo</option>
            <option value='Abundante'>Abundante</option>
            <option value='Escaso'>Escaso</option>
            <option value='Moderado'>Moderado</option>
          </select>
        </div></td></tr>";
       echo "<tr>
			<td colspan=4 ><div align=left>
			<p><strong><span class=Estilo9>FLORA PREDOMINANTE </span></strong></p>
			</div></td></tr>
			<tr><td><div align=right class=Estilo9>MORFOLOGIA:</div>
			</div></td>
			<td class=Estilo9>
            <label><input name=co_ftv type=checkbox  value='Coco'>Cocos</label></span></td>
			<td class=Estilo9>
            <label><input name=ba_ftv type=checkbox  value='Bacilos'>Bacilos</label></span></td>
            <td class=Estilo9>
		    <label><input name=coba_ftv type=checkbox  value='CocoBacilos'>Cocos Bacilos </label></td>
			</tr>
			<tr>
			<td >&nbsp;</td>
			<td class=Estilo9 >
			<label><input name=grap_ftv type=checkbox value='GramPositiva'>Gram Positiva</label></td>
			<td class=Estilo9> 
			<label><input name=gran_ftv type=checkbox value='GramNegativa'>Gram Negativo</label>  </td>
			<td class=Estilo9 >
			<label><input name=granv_ftv type=checkbox  value='Gram variables'>Gram variables</label></td> 
			</tr>";
			
			echo"<tr>
			<td colspan=4 ><div align=left>
			<p class=Estilo9><strong>GRAM CERVICAL</strong></p></div></td>
			</tr>";
			echo "<tr>
			<td>
			<div align=left class=Estilo9>PMN(X CAMPO):
		    <select name=pmnxcamcer>
            <option>-</option>
            <option value='0-1'>0-1</option>
            <option value='1-5'>1-5</option>
            <option value='5-10'>5-10</option>
            <option value='>10'>>10</option>
            </select>
		    <span class=Estilo9>XC</span></td>
			<td colspan=2>
			<div align=left>Diplococos Gram Negativos Intracelulares:
            <select name=dgni_ftv >
            <option>-</option>
            <option value='Si'>Si</option>
            <option value='No'>No</option>
            </select></div></td>
			<td><span >Diplococos Gram Negativos Estracelulares:
            <select name=dgne_ftv>
              <option>-</option>
              <option value='Si'>Si</option>
              <option value='No'>No</option>
            </select>
			</span></td>
           	</tr>";
			echo"<tr>
			<td><p align= right><strong>OBSERVACIONES:</strong></p></td>
			<td colspan=3>
			<p align=left>
			<textarea name=obsfrt_ftv value='$obsfrt_ftv' cols=80 rows=3></textarea></td>
			</tr>";
			echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(2,2)><td></tr></table>";

			?> <script language="javaScript">form1.ph_ftv.value='<?echo  $ph_ftv;?>';</script><?
			?> <script language="javaScript">form1.tea_ftv.value='<?echo $tea_ftv;?>';</script><?
			?> <script language="javaScript">form1.koh_ftv.value='<?echo $koh_ftv;?>';</script><?
			?> <script language="javaScript">form1.tcv_ftv.value='<?echo $tcv_ftv;?>';</script><?
			?> <script language="javaScript">form1.pmc_ftv.value='<?echo $pmc_ftv;?>';</script><?
			?> <script language="javaScript">form1.ceg_ftv.value='<?echo $ceg_ftv;?>';</script><?
			?> <script language="javaScript">form1.seu_ftv.value='<?echo $seu_ftv;?>';</script><?
			?> <script language="javaScript">form1.lac_ftv.value='<?echo $lac_ftv;?>';</script><?
			?> <script language="javaScript">form1.lev_ftv.value='<?echo $lev_ftv;?>';</script><?
			?> <script language="javaScript">form1.pmnxcamcer.value='<?echo $pmnxcamcer;?>';</script><?
			?> <script language="javaScript">form1.dgni_ftv.value='<?echo $dgni_ftv;?>';</script><?
			?> <script language="javaScript">form1.dgne_ftv.value='<?echo $dgne_ftv;?>';</script><?
			?> <script language="javaScript">form1.obsfrt_ftv.value='<?echo $obsfrt_ftv;?>';</script><?

	
	}
	//////////////////////////////////////////////COPROSCOPICO
	if($opcex==3)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>COPROSCOPICO</strong></td></tr>
		</table>";
		
		$concp=mysql_query("SELECT `iden_cop`, `iden_dlab`, `num_fac`, `cod_examen`, `fec_rec`, `fec_ent`, `cod_usu`, 
		`consistenc`, `bh`, `blastocyst`, `qc`, `QEColi`, `color`, `ch`, `chilomasti`, `ph`, `tz`, `trofozoito`, 
		`moco`, `sangreocul`, `otros`, `azucaresre`, `leuc_cpr`, `hema_cpr` ,`writh`, `levadura`, `neutrofilo`, `micelios`, `linfocitos`,
		`grasa_neut`, `eosinofilo`, `flora_bact`, `qh`, `qehistolyt`, `qn`, `qemana`, `observaciones`, `no`, `val` 
		 FROM `coprol` WHERE iden_dlab=$iden_labs");
		while($rowcp=mysql_fetch_array($concp))
		{
			$ph_cps=$rowcp[ph];
			$color_cps=$rowcp[color];
			$con_cps=$rowcp[consistenc];
			$san_cps=$rowcp['sangreocul'];
			$azu_cps=$rowcp[azucaresre];
			$leuc_cpr=$rowcp[leuc_cpr];
			$hema_cpr=$rowcp[hema_cpr];
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
		
		
		echo "<br><br><table width=80% align='center' border=1  bordercolor=#BED1DB bgcolor=#FFFFFF>
	  	 <tr><th colspan=4 bgcolor=#BED1DB><p>CARACTERISTICAS GENERALES</p></tr>";
		 echo"<tr><td colspan=4><div align=left><strong>COPROSCOPICO</strong></div></td></tr>
		 <tr><td width=30%><div align=left>PH:
		 <select name=ph_cps>
			<option>-</option>
			<option value='1.0'>1.0</option>
			<option value='1.5'>1.5</option>
			<option value='2.0'>2.0</option>
			<option value='2.5'>2.5</option>
			<option value='3.0'>3.0</option>
			<option value='3.5'>3.5</option>
			<option value='4.0'>4.0</option>
			<option value='4.5'>4.5</option>
			<option value='5.0'>5.0</option>
			<option value='5.5'>5.5</option>
			<option value='6.0'>6.0</option>
			<option value='6.5'>6.5</option>
			<option value='7.0'>7.0</option>
			<option value='7.5'>7.5</option>
			<option value='8.0'>8.0</option>
			<option value='8.5'>8.5</option>
			<option value='9.0'>9.0</option>
			<option value='9.5'>9.5</option>
			<option value='10'>10</option>
		</select></td>
		<td><div align=left>Color:
			<select name=color_cps>
			<option> </option>
			<option value='Amarilla'>Amarilla</option>
			<option value='Blanquesino'>Blanquesino</option>
			<option value='Carmelita'>Carmelita</option>
			<option value='Negro'>Negro</option>
			<option value='Otro'>Otro</option>
			<option value='Verdoso'>Verdoso</option>
			</select></td>
		<td><div align=left>Consistencia:
			<select name=con_cps>
			<option> </option>
			<option value='Blanda'>Blanda</option>
			<option value='Dura'>Dura</option>
			<option value='Liquida'>Liquida</option>
			<option value='Semiliquida'>Semiliquida</option>
			<option value='Diarreica'>Diarreica</option>
			</select></td>
		<td><div align=left>Sangre Oculta:
			<select name=san_cps>
            <option value='-'>-</option>
            <option value='Positivo'>Positivo</option>
            <option value='Negativo'>Negativo</option>
			</select></td></tr>";
			
		echo "<tr>
		      <td colspan=2><div align=left>Azucares Reductores
              <select name=azu_cps>
              <option value='-'>-</option>
              <option value='Positivo'>Positivo</option>
              <option value='Negativo'>Negativo</option>
			  </select>
			  <select name=val_cps>
			  <option value='-'>-</option>
			  <option value='0'>0</option>
	          <option value='250'>250</option>
	          <option value='550'>550</option>
	          <option value='700'>700</option>
			  </select>mg/l</td>";
		
		echo"<td>Leucocitos:<input type=text name=leuc_cpr size=8 value='$leuc_cpr'>/mm³</td>";
		echo"<td>Hematies:<input type=text name=hema_cpr size=8 value='$hema_cpr'>/ul</td></tr>";	
		
	  echo" <tr>
			  <td colspan=4><div align=left><strong>COPROLOGICO</strong></div></td></tr>
	  	    <tr>
			  <td><div align=left>Moco:
			  <select name=moc_cps >
              <option value='-'>-</option>
              <option value='+'>+</option>
              <option value='++'>++</option>
              <option value='+++'>+++</option>
              <option value='++++'>++++</option>
              </select></td>
			  <td><div align=left>Levaduras:
			  <select name=lev_cps >
			  <option value='-'>-</option>
              <option value='+'>+</option>
              <option value='++'>++</option>
              <option value='+++'>+++</option>
              <option value='++++'>++++</option>
              </select></td>
			  <td><div align=left>Micelios:
			  <select name=mic_cps >
			  <option value=''></option>
              <option value='+'>+</option>
	          <option value='-'>-</option>
              <option value='Abundante'>Abundante</option>
              <option value='Escaso'>Escaso</option>
              <option value='Moderado'>Moderado</option>
              </select></td>
			  
			<td><div align=left>Grasas Neutras :
			  <select name=gra_cps>
              <option value='-'>-</option>
              <option value='+'>+</option>
              <option value='++'>++</option>
              <option value='+++'>+++</option>
              <option value='++++'>++++</option>
              </select></td></tr>
			  <tr>
			  <td>Flora Bacteriana:
			  <select name='flo_cps' >
              <option value='-'>-</option>
              <option value='Aumentada'>Aumentada</option>
              <option value='Disminuida'>Disminuida</option>
              <option value='Lig/Aumentada'>Lig/Aumentada</option>
              <option value='normal'>normal</option>
            </select></td></div>
			<td>
			<input  type='checkbox' name='qc_cps' value='Quiste.E.coli'>Quiste.E.coli:
			<input  type=text name=hom_cps size=5></td></div>
			<td>
            <input  type='checkbox' name='qh_cps' value='Quiste.E. histolytica'>Quiste.E. histolytica :
            <input  type=text name=qeh_cps size=5></div></td>
			<td><div align='left'>
            <input  type='checkbox' name='qn_cps' value='Q.E.nana'>Q.E.nana : 
            <input  type=text name=qem_cps size=5></div></td>
			<tr>
			<td>Otros:<input type=text name=otrcpr_cps size=10></td>
			<td><input  type='checkbox' name='bh_cps'  value='Blastocystis Hominis'>Blastocystis Hominis:
			<input name=bla_cps type=text  size=5></div></td>
			<td><div align='left'>
			<input  type='checkbox' name='ch_cps' value='Chilomastix mesnilli'>Chilomastix mesnilli:
			<input  type=text name=chi_cps  size=5></td>
			<td><div align='left'>
            <input  type='checkbox' name='tz_cps' value='Trofozoitos'>Trofozoitos:
		    <input  type=text name='tro_cps' size=5></div></td></tr>
			<tr>
			<td colspan=4><div align=left>
			<input type=checkbox name=no_cps value='No se observa parasitos intestinales en la muestra analizada'>
			No se observa parasitos intestinales en la muestra analizada</td></tr>
			<tr>
			<td><div align='left'>Wright
            <select name=wri_cps>
              <option value='-'>-</option>
              <option value='Negativo'>Negativo</option>
              <option value='Positivo'>Positivo</option>
			</select> </div></td>
			<td>
			<div align=left>Neutrofilos:
			<input  type=text name=neu_cps value='$neu_cps' size=10>%</td>
			<td>
			<div align=left>Linfoncitos:
			<input  type=text  name=lin_cps value='$lin_cps' size=10>%</td>
			<td><div align=left>Eosinofilos:
			<input name=eos_cps type=text value='$eos_cps' size=10>%</div></td></tr>";
			echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(3,3)><td></tr></table>";
		
		    ?> <script language="javaScript">form1.ph_cps.value='<?echo  $ph_cps;?>';</script><?
			?> <script language="javaScript">form1.color_cps.value='<?echo $color_cps;?>';</script><?
			?> <script language="javaScript">form1.con_cps.value='<?echo $con_cps;?>';</script><?
			?> <script language="javaScript">form1.san_cps.value='<?echo $san_cps;?>';</script><?
			?> <script language="javaScript">form1.azu_cps.value='<?echo $azu_cps;?>';</script><?
			?> <script language="javaScript">form1.val_cps.value='<?echo $val_cps;?>';</script><?
			?> <script language="javaScript">form1.moc_cps.value='<?echo $moc_cps;?>';</script><?
			?> <script language="javaScript">form1.lev_cps.value='<?echo $lev_cps;?>';</script><?
			?> <script language="javaScript">form1.gra_cps.value='<?echo $gra_cps;?>';</script><?
			?> <script language="javaScript">form1.flo_cps.value='<?echo $flo_cps;?>';</script><?
			?> <script language="javaScript">form1.hom_cps.value='<?echo $hom_cps;?>';</script><?
			?> <script language="javaScript">form1.qeh_cps.value='<?echo $qeh_cps;?>';</script><?
			?> <script language="javaScript">form1.qem_cps.value='<?echo $qem_cps;?>';</script><?
			?> <script language="javaScript">form1.mic_cps.value='<?echo $mic_cps;?>';</script><?
			?> <script language="javaScript">form1.otrcpr_cps.value='<?echo $otrcpr_cps;?>';</script><?
			?> <script language="javaScript">form1.bla_cps.value='<?echo $bla_cps;?>';</script><?
			?> <script language="javaScript">form1.chi_cps.value='<?echo $chi_cps;?>';</script><?
			?> <script language="javaScript">form1.tro_cps.value='<?echo $tro_cps;?>';</script><?
			?> <script language="javaScript">form1.wri_cps.value='<?echo $wri_cps;?>';</script><?
			?> <script language="javaScript">form1.neu_cps.value='<?echo $neu_cps;?>';</script><?
			?> <script language="javaScript">form1.lin_cps.value='<?echo $lin_cps;?>';</script><?
			?> <script language="javaScript">form1.eos_cps.value='<?echo $eos_cps;?>';</script><?
			
	}
	/////////////////////CUADRO HEMATICO
	if($opcex==4)
	{
		$conch=mysql_query("SELECT `iden_dlab`,
		`hemoglobin`, `neutrofilos`, `hematrocit`, `cayados`, `vsg1h`, `linfocito`, `leococitos`, `eosinofilos`, 
		`monocitos`, `basofilos`, `plaquetas`, `reticuloci`, `vcm_ch`, `hcm_ch`, `chcm_ch`, `ide_ch`,`observacion` 
		 FROM `cuadroh` WHERE iden_dlab=$iden_labs");
		
		while($rowch=mysql_fetch_array($conch))
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
			$vcm_ch=$rowch["vcm_ch"];
			$hcm_ch=$rowch["hcm_ch"];
			$chcm_ch=$rowch["chcm_ch"];
			$ide_ch=$rowch["ide_ch"];
			$obs_ch=$rowch[observacion];
		
		}
		
		
		
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>CUADRO HEMATICO</strong></td></tr>
		</table>";
		echo"<br><br>
		<table width=70% border=1  align='center' bordercolor=#BED1DB bgcolor=#FFFFFF>
		<tr>
		 <th colspan=10 bgcolor=#BED1DB>CARACTERISTICAS GENERALES</tr>";

		echo"
		<tr>
         <td>Hemoglobina:</td>
         <td><input type=text name=hemo_ch value='$hemo_ch' size='7' maxlength='12'>
		 <input name=hemo1 type=hidden value='gr/dl'>gr/dl</td>
         <td><div align=left>Hematrocito:</td>
         <td><input type=text name=hema_ch value='$hema_ch' size='7' maxlength='12'>%</div></td>
         <td>VSG1h :</td>
         <td><input  type=text name=vs_ch value='$vs_ch' size='7' maxlength='12'>m.m/h</div></tr>";
		
		echo"
             <td><div align=left>Leucocitos:</td>
		     <td><input type=text name=leu_ch value='$leu_ch' size='7' maxlength='12'>/mm³</div></td>
             <td><div align=left>Plaquetas:</td>
             <td><input type=text name=pla_ch value='$pla_ch' size='7' maxlength='12'>/mm³</div></td></tr>";
		echo"
             <tr ><td><div align=left>Neutrofilos:</td>
            <td><input type=text name=neu_ch value='$neu_ch' size='7' maxlength='12'>%</span></div></td>
	        <td><div align=left>Linfoncitos:</td>
			<td><input type=text name=lin_ch value='$lin_ch' size='7' maxlength='12'>%</div></td> ";
    
 
		echo"  <td><div align=left>Eosinofilos:</td>
			 <td><input type=text name=eos_ch value='$eos_ch' size='7' maxlength='12'>%</div></td>
			 <td><div align=left>Monocitos</td>
			 <td><input type=text name=mon_ch value='$mon_ch' size='7' maxlength='12'>%</div></tr>  ";      
    

		echo"
		<tr >
        <td><div align=left>Basofilos:</td>
        <td><input type=text name=bas_ch value='$bas_ch' size='7' maxlength='12'>%</div></td>
        <td><div align=left>Reticulocitos:</td>
        <td><input type=text name=ret_ch value='$ret_ch' size='7' maxlength='12'>%</div></td> 
		<td><div align=left>Cayados:</td>
        <td><input type=text name=cay_ch value='$cay_ch' size='7' maxlength='12'>% </div></td></tr> ";

		echo"<td><div align=left>VCM:</td>
        <td><input type=text name=vcm_ch value='$vcm_ch' size='7' maxlength='7' >um</div></td> 
		<td><div align=left>HCM:</td>
        <td><input type=text name=hcm_ch value='$hcm_ch' size='7' maxlength='7'>pg</div></td> ";

		echo"<td><div align=left>CHCM:</td>
        <td><input type=text name=chcm_ch value='$chcm_ch' size='7' maxlength='7'>g/dL</div></td></tr> 
		<tr><td><div align=left>IDE:</td>
        <td><input type=text name=ide_ch value='$ide_ch' size='7' maxlength='7'>%</div></td></tr> ";
		
		echo"
		  <tr >
			<td colspan=10><div align=left >
				<p><strong>OBSERVACIONES:</strong></p>
			</div></td>
		  </tr>";
		echo"
		  <tr >
			 <td colspan=10><div align=center>
				   <p align=center><textarea name=obs_ch value='$obs_ch' cols=100 rows=3>$obs_ch</textarea>
				 </p></td></tr>";
		echo "<tr><td colspan=10><input type=button value=Guardar onClick=gua_bd(4,4)><td></tr></table>";
	
	}
	
	//////////////CUADRO DE VARIOS
	
	if($opcex==5)
	{
		$consdv=mysql_query("SELECT datos FROM dat_varios WHERE iden_dlab='$iden_labs'");
		while($rowdv=mysql_fetch_array($consdv))
		{
		
			$cdr_varios=$rowdv[datos];
			
		}
		//ECHO $opcex;
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>CUADRO DE VARIOS</strong></td></tr>
		</table>";
		
		echo"<br><br><table width=60% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
				   <tr >
			       <td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr> ";

			 echo"<tr>
			        <td align=center><strong>DATOS </strong></td>
			         <td><textarea name=cdr_varios cols=120 rows=8 value='$cdr_varios'>$cdr_varios</textarea></td>			        
			      </tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(5,5)><td></tr></table>";
	
	}
	//////////////////ESPERMOGRAMA//////////////
	if($opcex==6)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>ESPERMOGRAMA</strong></td></tr>
		</table>";
		echo"<br><br><table width=80% border=2 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
				   <tr >
			       <td colspan=5 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr> ";

		echo"       
			<tr>
		   <td><strong>PH</strong>
                    <select name=ph_epm>
                    <option> </option>
	            <option>1.0</option>
	            <option>2.0</option>
	            <option>3.0</option>
	            <option>4.0</option>
	            <option>5.0</option>
	            <option>6.0</option>
	            <option>7.0</option>
	            <option>8.0</option>
	            <option>9.0</option>
	            <option>10.0</option>
              </select>
          </td>
	        <td><strong>Volumen</strong>
	        <input  type=text name=vol_epm value='$vol_epm' size=7>cc</td>
	        <td><strong>Viscocidad</strong>
	        <td colspan=2><input type=text name=vis_epm value='$vis_epm' size=7>Disminuida
			<input  type=text name=nor_epm value= '$nor_epm' size=7>Normal
	        <input  type=text name=aum_epm value= '$aum_epm' size=7>Aumentada</td>
        </tr>";
        
		echo "<tr>
			<td><strong>Filancia</strong></td>
			<td><input type=checkbox name=uc_epm value='1cc'>1cc</td>
			<td><input type=checkbox name=tc_epm value='3cc'>3cc</td>
                        <td><input type=checkbox name=m3_epm value='>3cc'>>&gt;3cc</td>
			<td><input type=checkbox name=otr_epm value='otro'>Otro</td></tr>
			<tr class=Estilo30><td><strong>Licuefaccion</strong></td>
			<td><input type=checkbox name=vm_epm value='20''>20'</td>
			<td width=51><input type=checkbox name=tm_epm value='30''>30'</td>
			<td width=113><input type=checkbox name=otr2_epm value='otro''>Otro</td>
			</tr>";
	
		echo"
        <tr class=Estilo30>
			<td width=105 rowspan=2><strong>Directo:</strong></td>
			<td width=137>Leucocitos
			<input  type=text name= leu_epm value='$leu_epm' size=5>XC</td>
			<td width=109>Hematies
			<input  type=text name=hema_epm value='$hema_epm' size=5>XC</td>
			<td width=116 colspan=2>Bacterias
			  <select name=bac_epm>
			    <option> </option>
                            <option>-</option>
                            <option>+</option>
			    <option>++</option>
			    <option>+++</option>
			    <option>++++</option>
	          </select>
			</td>
		</tr>";
        
		echo"<tr>
	        <td colspan=2>Tricomonas
	          <select name=tri_epm>
                <option> </option>
                <option>+</option>
                <option>-</option>
              </select>
	          <input type=text name=trim_epm value='$trim_epm' size=5></td>
	        <td colspan=2>KOH 
            <select name=koh>
            <option> </option>
            <option>+</option>
            <option>-</option>
          </select>
             <input type=text name=kohm_epm value='$kohm_epm' size=5></td>           
          	</tr>";
	  
		echo"
        <tr>
			<td ><strong>Movilidad</strong></td>
	        <td >Moviles Progresivos
	        <input  type=text name=mvpr_epm value='$mvpr_epm' size=5>%</td>
	        <td>Moviles Pendulantes 
			<input  type=text name=mvpe_epm value='$mvpe_epm' size=5>%</td>
	        <td colspan=2>Inmoviles
	        <input  type=text name=inm_epm value='$inm_epm' size=5> % </td>    
        </tr>";
	
		echo"
        <tr>
			<td width=154><strong>Vitalidad</strong></td>
			<td>Vivos 
			<input type=text name=viv_epm value='$viv_epm' size=5> %</td>    
			<td colspan=3>Muertos
			<input type=text name=mue_epm value='$mue_epm' size=5> %</td>
        </tr>";
	
		echo"
        <tr>
			<td><strong>Recuento Espermatico</strong> </td>
			<td colspan=4><input type=text name=rec_epm value='$rec_epm'> /mm&sup3; (Vr 15.000.000 - 45.000.000) </td>
        </tr> ";
      
		echo"
        <tr >
			<td width=35><strong>GRAM</strong>
			 <td colspan=4>PMN  
			  <select name=pmn_epm>
                <option> </option>
                <option>0XC</option>
                <option>1-5XC</option>
                <option>6-10XC</option>
                <option>&gt;10XC</option>
              </select>
		  <input  type=text name=pc_epm value='$pc_epm' size=5></td>
	    </td></tr>";
	
		echo"
        <tr>
	        <td><strong>WRIGTH</strong></td>
	        <td colspan=2>Neutrofilos
	        <input  type=text name=neu_epm value='$neu_epm' size=15> </td>
			<td colspan=2>Linfoncitos
	        <input  type=text name=lin_epm value='$lin_epm' size=15></td>  
	    </tr>";
	
		echo"
        <tr>
	        <td rowspan=3><strong>Morfologias:</strong></td>
	        <td >Normales:
	        <input  type=text name=nor2_epm value='$nor2_epm' size=7>%</td>
	        <td >Microcefalos:
	        <input  type=text name=micro_epm value='$micro_epm' size=7></td>
	        <td>Macrocefalos:
	        <input  type=text name=macro_epm value='$macro_epm' size=7></td>
	        <td >Enrollados:
	        <input  type=text name=enro_epm value='$enro_epm' size=7></td>
        </tr>";
		echo"
        <tr>
	        <td >Amorfos
	        <input type=text name=amor_epm value='$amor_epm' size=7></td>
	        <td >Sin Cabeza
	        <input type=text name=sinca_epm value='$sinca_epm' size=7></td>
	        <td >Sin Cola
	        <input type=text name=sinco_epm  value='$sinco_epm' size=7></td>
	        <td >Doble Cabeza
	        <input type=text name=dobc_epm value='$dobc_epm' size=7></td>
        </tr>";
		echo" <tr>
	        <td>Otros</td>
	        <td colspan=3 ><input type=text name=otro3_epm value='$otro3_epm' size=25></td>
	        </tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(6,6)><td></tr></table>";
	}
	///////////////////////////HCB - G
	if($opcex==7)
	{
		
		$conshc=mysql_query("SELECT resul_exam,  observaciones   FROM hcg  WHERE iden_dlab='$iden_labs'");
		while($rowhc=mysql_fetch_array($conshc))
		{
		
			$resul=$rowhc[resul_exam];
			$obs=$rowhc[observaciones];
			
		}
		
		
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>HCB -G</strong></td></tr>
		</table>";
		
		echo"<br><br>
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "
		<tr><td colspan=2><div align='center'>Resultado: 
        <input  type=text name='res_hcg' size='15' maxlength='15'>  M UI / ml</td>
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
				<p><strong>OBSERVACIONES:</strong></p>
			</div></td>
		  </tr>";
		
		echo"
		  <tr >
			 <td colspan='2'>
			   <textarea name=obs_hcg  value='$obs_hcg' cols=60 rows=4></textarea>
			  </td>
		  </tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(7,7)><td></tr></table>";
	}
	////////////////////////////////INMUNOLOGIA
	if($opcex==8)
	{
		
		$coninm=mysql_query("SELECT iden_dlab,  num_fac,  cod_exam,  cod_usu,  fec_rec,  fec_ent,  inmu_rac,
		inmu_rau,  inmu_pcc,  inmu_pcu,  inmu_asc,  inmu_asu,  inmu_tioc,  inmu_tiou,  inmu_tihc,  inmu_tihu,  
		inmu_pac,  inmu_pau,  inmu_pbc,  inmu_pbu,  inm_btc,  inm_btu,  inm_ptc,  inm_ptu
		FROM labo_inm
		WHERE iden_dlab='$iden_labs'");
		while($rowim=mysql_fetch_array($coninm))
		{
		
			$inmu_rac  =$rowim[inmu_rac];
			$inmu_rau =$rowim[inmu_rau];
			$inmu_pcc =$rowim[inmu_pcc];
			$inmu_pcu  =$rowim[inmu_pcu];
			$inmu_asc =$rowim[inmu_asc];
			$inmu_asu =$rowim[inmu_asu];
			$inmu_tioc =$rowim[inmu_tioc];
			$inmu_tiou =$rowim[inmu_tiou];
			$inmu_tihc =$rowim[inmu_tihc];
			$inmu_tihu  =$rowim[inmu_tihu];
			$inmu_pac =$rowim[inmu_pac];
			$inmu_pau  =$rowim[inmu_pau];
			$inmu_pbc  =$rowim[inmu_pbc];
			$inmu_pbu  =$rowim[inmu_pbu];
			$inm_btc =$rowim[inm_btc];
			$inm_btu =$rowim[inm_btu];
			$inm_ptc  =$rowim[inm_ptc];
			$inm_ptu =$rowim[inm_ptu];
			
			
		}
		
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>INMUNOLOGIA - ANTIGENOS FEBRILES</strong></td></tr>
		</table>";
		
		echo "<br><br><table align='center' width=400 border=1 bordercolor=#BED1DB bgcolor=#FFFFFF >
	  	 <tr><td bgcolor=#BED1DB colspan=3><strong>CARACTERISTICAS GENERALES</td></tr>";

		echo "<tr>
            
		    <td >RA</td>
		    <td >
                <select name=rac_inm value=$inmu_rac>
                  <option>-</option>
                  <option>Positivo</option>
                  <option>Negativo</option>
            </select>
		    </span></td>
		    <td ><select name='rau_inm'>
		      <option> </option>
			  <option>8</option>
		      <option>16</option>
		      <option>32</option>
		      <option>64</option>
		      <option>128</option>
		      <option>256</option>
		      <option>512</option>
		      <option>1024</option>
		      <option>2048</option>
		      <option>4096</option>
	        </select>
		      ui/ml</td>
		   
		    </tr>";

	echo "<tr>
	  
		<td >PCR</td>
		<td >
		  <select name=pcc_inm>
            <option>-</option>
            <option>Positivo</option>
            <option>Negativo</option>
        </select>
		</span></td>
		<td><select name='pcu_inm'>
		  <option> </option>
		  <option>6</option>
		  <option>12</option>
		  <option>24</option>
		  <option>48</option>
		  <option>96</option>
		  <option>192</option>
		  <option>348</option>
          </select>
		  mg/l</td>
		
		</tr>
		";

	echo "<tr>
       
		<td>ASTOS</td>
		<td><div align=right>
		  <div align='left'>
		    <select name=asc_inm>
              <option>-</option>
              <option>Positivo</option>
              <option>Negativo</option>
            </select>
          </span></div>
		</div>		  
		  <div align='left'>
		    </span></div></td>
		<td><select name='asu_inm' >
		  <option> </option>
		  <option>200</option>
		  <option>400</option>
		  <option>800</option>
		  <option>1600</option>
	    </select></td>
		
		</tr>
		<tr >
        
        <td colspan=2 ><strong>ANTIGENOS FEBRILES : </span></td>
        <td><strong><div align=left>Dilución</div></td>
        </tr>";

	   
	echo"		
	<tr>
	  <td >Tifo O </td>
	  <td >
	    <select name=toc_inm>
          <option>-</option>
          <option>Positivo</option>
          <option>Negativo</option>
        </select>
	  </td>
	  <td >
	  <select name='tou_inm'>
		<option> </option>
		<option>1/40</option>
	    <option>1/80</option>
	    <option>1/160</option>
	    <option>1/320</option>
	    <option>&gt;1/320</option>
      </select></td>
	  </tr>
	<tr>
	
	  <td >Tifo H </td>
	  <td >
	    <select name=thc_inm>
          <option>-</option>
          <option>Positivo</option>
          <option>Negativo</option>
        </select>
	  </span></td>
	  <td ><select name='thu_inm'>
        <option> </option>
		<option>1/40</option>
		<option>1/80</option>
        <option>1/160</option>
        <option>1/320</option>
        <option>&gt;1/320</option>
      </select></td>
	  </tr>
	<tr>
	  
	  <td>Paratifo A </span></td>
	  <td>
	    <select name=pac_inm>
          <option>-</option>
          <option>Positivo</option>
          <option>Negativo</option>
        </select>
	  </span></td>
	  <td><select name='pau_inm'>
        <option></option>
		<option>1/40</option>
		<option>1/80 </option>
        <option>1/160</option>
        <option>1/320</option>
        <option>&gt;1/320</option>
      </select></td>
	  </tr>
	<tr>
	  	
		<td>Paratifo B </td>
		<td>
		  <select name=pbc_inm>
            <option>-</option>
            <option>Positivo</option>
            <option>Negativo</option>
        </select>
		</td>
		<td><select name='pbu_inm'>
          <option> </option>
		  <option>1/40</option>
		  <option>1/80</option>
          <option>1/160</option>
          <option>1/320</option>
          <option>&gt;1/320</option>
        </select></td>
		</tr>
	<tr>
	  
	  
	  <td>Brucella abortus</td>
	  <td>
	    <select name=brc_inm>
          <option>-</option>
          <option>Positivo</option>
          <option>Negativo</option>
        </select>
	 </td>
	  <td ><select name='bru_inm' >
        <option> </option>
		<option>1/40</option>
        <option>1/80</option>
        <option>1/160</option>
        <option>1/320</option>
        <option>&gt;1/320</option>
      </select></td>
	  </tr>
	<tr>
	  
	  
	  <td >Proteus OX19</td>
	  <td>
	    <select name=poc_inm>
          <option>-</option>
          <option>Positivo</option>
          <option>Negativo</option>
        </select>
	  </span></td>
	  <td><select name='pou_inm'>
        <option> </option>
		<option>1/40</option>
        <option>1/80</option>
        <option>1/160</option>
        <option>1/320</option>
        <option>&gt;1/320</option>
      </select></td>
	  </tr>";
		
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(8,8)><td></tr></table>";
		
	}
	//////////////////////////////LIQUIDOS BIOLOGICOS/////////////////////////////////////////////////
	if($opcex==9)
	{
		$conlqd=mysql_query("SELECT iden_dlab, num_fac , cod_usu , fech_lqd,
			clas_lqd , asp_lqd , colr_lqd , dens_lqd , gbla_lqd , groj_lqd , 
			norm_lqd , cren_lqd , ntro_lqd ,linf_lqd , mono_lqd , otro_lqd ,
			gram_lqd , gluc_lqd,prot_lqd , ldho_lqd , otrs_lqd ,gram_lqd, 
			ph_lqd,  koh_lqd, obse_lqd 
			FROM labo_lqd WHERE iden_dlab='$iden_labs'");
		
		while($rowlqd=mysql_fetch_array($conlqd))
		{
			$cli_lqd=$rowlqd[clas_lqd];
			$col_lqd=$rowlqd[colr_lqd];
			$asp_lqd=$rowlqd[asp_lqd];
			$den_lqd=$rowlqd[dens_lqd];
			$rec_globl=$rowlqd[gbla_lqd];
			$rec_glorj=$rowlqd[groj_lqd];
			$vl_nor=$rowlqd[norm_lqd];
			$vl_cre=$rowlqd[cren_lqd];
			$dif_neut=$rowlqd[ntro_lqd];
			$dif_linf=$rowlqd[linf_lqd];
			$dif_mono=$rowlqd[mono_lqd];
			$dif_otr=$rowlqd[otro_lqd];
			$dif_gram=$rowlqd[gram_lqd];
			$koh_lqd=$rowlqd[koh_lqd];
			$ph_lqd=$rowlqd[ph_lqd];
			$glu_lqd=$rowlqd[gluc_lqd];
			$prote_lqd=$rowlqd[prot_lqd];
			$ldn_lqd=$rowlqd[ldho_lqd];
			$otr_lqd=$rowlqd[otrs_lqd];
			$obs_lqd=$rowlqd[obse_lqd];
			

		}
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>LIQUIDOS BIOLOGICOS</strong></td></tr>
		</table>";
		echo "<br><br><table align='center' width=60% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF >
	  	 <tr><td colspan=6  bgcolor=#BED1DB colspan=3><strong>CARACTERISTICAS GENERALES</td></tr>";
		
		echo"
		<tr bgcolor=#FFFFFF>
        <td><div align=left>Clse Liq: </td>
		<td><select name=cli_lqd value='$cli_lqd'>
		<option> </option>
		<option value='Pleural'>Pleural</option>
        <option value='LCR'>LCR</option>
        <option value='Peritonial'>Peritonial</option>
        <option value='Pericardio'>Pericardio</option>
		<option value='Ascitivo'>Ascitivo</option>
        <option value='Sinovial'>Sinovial</option>
        </select></div></td>
		
         <td ><div align=left>Color:</td>
		<td><select name=col_lqd value='$col_lqd'>
		 <option> </option>
		 <option value='Amarillo'>Amarillo</option>
         <option value='Rojizo'>Rojizo</option>
         <option value='Rojo'>Rojo</option>
         <option value='Incoloro'>Incoloro</option>
		 </select></div></td></tr>
		 
		 
         <tr><td ><div align=left>Aspectos: </td>
		<td><select name=asp_lqd value='$asp_lqd'>
		 <option > </option>
		 <option value='Limpido'>Limpido</option>
         <option value='Lig.Turbio'>Lig.Turbio</option>
         <option value='Turbio'>Turbio</option>
		 <option value='Muy Turbio'>Muy Turbio</option>
		 </div></td>
		 
		 
		 <td><div align=left>Densidad: 
		 <td><select name=den_lqd  value='$den_lqd'>
		 <option > </option>
		 <option value='1.005'>1.005</option>
         <option value='1.010'>1.010</option>
         <option value='1.015'>1.015</option>
		 <option value='1.020'>1.020</option>
		 <option value='1.025'>1.025</option>
		 <option value='1.030'>1.030</option>
		 </div></td>
		</tr>";
  
	echo" 
       <tr>
         <td bgcolor=#BED1DB colspan=6 align=center><b>RECUENTO DE GLOBULOS</td>
       </tr>
       <tr>
         <td>Recuento de Globulos Blancos</td>
		 <td><input type=text name=rec_globl value='$rec_globl' size=10><b>/mm&sup3</td>
         <td>Recuento de Globulos Rojos</td>
         <td>
           <input type=text name=rec_glorj value='$rec_glorj' size=10><b>/mm&sup3
         </td>
	   </tr>
		 <tr><td>Normales</td>
		 <td><input type=text name=vl_nor value='$vl_nor' size=10>%</td>
		 <td>Crenados</td>
		 <td><input type=text name=vl_cre value='$vl_cre' size=10>%</td>
       </tr>";
     
     echo"
       <tr>
         <td bgcolor=#BED1DB colspan=6 align=center><b>DIFERENCIALES</td>
       </tr>
       <tr>
         <td align=left>Neutrofilos</td>
		 <td><input type=text name=dif_neut   value='$dif_neut' size=10>%</td>
		 <td align=left>Linfoncitos</td>
		 <td><input type=text name=dif_linf   value='$dif_linf' size=10>%</td></tr>
         <tr><td align=left>Monocitos
		 <td><input type=text name=dif_mono   value='$dif_mono' size=10>%</td>
         <td align=left>Otras Celulas</td>
		 <td><input type=text name=dif_otr   value='$dif_otr' size=10>%</td>
        </tr>
		<tr>
		 <td align=left>GRAM </td>
		 <td><textarea name=dif_gram  value='$dif_gram' cols=30 rows=2>$dif_gram</textarea></td>
                 <td align=left>KOH </td>
		 <td><textarea name=koh_lqd  value='$koh_lqd' cols=30 rows=2>$koh_lqd</textarea></td></tr>
                 <tr><td align=left>PH </td>
		 <td><textarea name=ph_lqd  value='$ph_lqd' cols=30 rows=2>$ph_lqd</textarea></td>
        
		 <td align=left>Glucosa</td>
		 <td><input  type=text name=glu_lqd value='$glu_lqd' size=10></td>
        </tr>";
	 
	  echo"
       <tr>
         
         <td align=left>Proteinas</td>
		 <td><input type=text  name=prote_lqd value='$prote_lqd' size=10></td>
         <td align=left>LDH</td>
		 <td align=left><input  type=text name=ldn_lqd value='$ldn_lqd' size=10></td>";
	
	 
      echo"
       <tr>
         <td bgcolor=#BED1DB colspan=6 align=center><b>OTROS EXAMENES</td>
			<tr><td colspan='4'>
			   <input type=text name=otr_lqd  value='$otr_lqd' size=100 maxlength=150></textarea>
			</td></tr>
        
       </tr>";
  

	 echo" 
       <tr>
         <td bgcolor=#BED1DB colspan=7 align=center><b>OBSERVACIONES</td>
       </tr>

       <tr><td colspan='4'>
			   <textarea name=obs_lqd  value='$obs_lqd' cols=100 rows=6>$obs_lqd</textarea>
			</td></tr>";
	  echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(9)><td></tr></table>";
	    
		?> <script language="javaScript">form1.cli_lqd.value='<?echo $cli_lqd;?>';</script><?
	    ?> <script language="javaScript">form1.col_lqd.value='<?echo $col_lqd;?>';</script><?
		?> <script language="javaScript">form1.den_lqd.value='<?echo $den_lqd;?>';</script><?
	    ?> <script language="javaScript">form1.asp_lqd.value='<?echo $asp_lqd;?>';</script><?
		

		
	}
	/////////////BCHG//////////
	
	if($opcex==10)
	{
			
		$consbhcg=mysql_query("SELECT lab_bhc  FROM  labo_bhc  WHERE iden_dlab='$iden_labs'");
		while($rowhc=mysql_fetch_array($consbhcg))
		{
		
			$lab_bhc=$rowhc[lab_bhc];
						
		}
		
		
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>BHCG</strong></td></tr>
		</table>";
		
		echo "<br><br><table align='center' width=50% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF >
	  	 <tr><td bgcolor=#BED1DB colspan=3><strong>CARACTERISTICAS GENERALES</td></tr>";

		echo"
		  <tr><td></td><td align=center><b>Unidades</td></tr>"; 
		echo "
		  <tr >
			<td >Determinacion Cualitativa en suero de hormona Ganadotropina Corionica (HCG) </td>
			<td><input type=text name=lab_bhc value='$lab_bhc'></span>mUI/ml</td> 
			</tr>";
		echo "
		  <tr>
			<td colspan=3><b>Nota:</td>
			</tr>"; 
		echo"
		<tr><td colspan=3>Tecnica Microelisa rapida sensibilidad 10 mIU/ml</td></tr>";
		
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(10,10)><td></tr></table>";
	
	}
	/////////////////////////tropoinina
	if($opcex=='11')
	{
		$contp=mysql_query("SELECT iden_dlab,lab_trim FROM labo_tri  WHERE  cod_usu='$iden_uco' and iden_dlab=$iden_labs");
		$rowtp=mysql_fetch_array($contp);
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>TROPONINA</strong></td></tr>
		</table>";
	
		echo "<br><br>
	  	 <table width=50% border=1 align=center  bordercolor=#BED1DB bgcolor=#FFFFFF >
           <tr>
             <td colspan=3 bgcolor=#BED1DB align=center><b>CARACTERISTICAS GENERALES </td></tr>";
		echo"
		  <tr>
			<td>Triponima I :</td>
			<td colspan=2>
			  <select name=trim_tpn2>
				<option>-</option>
				<option value=Positivo>Positivo</option>
				<option value=Negativo>Negativo</option>
			  </select>Sensibilidad 1 ng / ml
			</td>
		  </tr>
		  <tr><td colspan=3 ><b>Nota</td></tr>
          <tr><td colspan='3' >Tecnica Prueba Rapida de Inmunocromotografia</td></tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(11,11)><td></tr></table>";
		?><script language="javaScript">form1.trim_tpn2.value='<?echo $rowtp[lab_trim];?>';</script><?
	}
	//////////////////////////////////////////////////////////////////////////////////////////////

	if($opcex==12)
	{
	
	$conotrex=mysql_query("SELECT `iden_loex`, `iden_dlab`, `num_fac`, `cod_loex`, `cod_usu`, `fec_recp`, `fec_entr`, 
	`fsh_loex`, `obs_fsh`, `lsh_loex`, `obs_lsh`, `pgs_loex`, `obs_pgs`, `tst_loex`, `obs_tst`, `est_loex`, `obs_est`, 
	`ige_loex`, `obs_ige`,	`fnd_mcn`, `end_mcn`, `fni_mcn`, `eni_mcn`, `obs_mcn`,`khi_oex`,`khv_oex`,`esta_ord`
	FROM `labo_oexa` WHERE iden_dlab=$iden_labs");

	if(mysql_num_rows($conotrex)<>0)
	{

	while($rowcot=mysql_fetch_array($conotrex))

	{	
		$cod_loex=$rowcot[cod_loex];
		$fsh_loex=$rowcot[fsh_loex];
		$obs_fsh= $rowcot[obs_fsh];
		$lsh_loex=$rowcot[lsh_loex]; 
		$obs_lsh= $rowcot[obs_lsh];
		$pgs_loex=$rowcot[pgs_loex]; 
		$obs_pgs= $rowcot[obs_pgs];
		$tst_loex=$rowcot[tst_loex];
		$obs_tst= $rowcot[obs_tst];
		$est_loex=$rowcot[est_loex];
		$obs_est= $rowcot[obs_est];
		$ige_loex=$rowcot[ige_loex]; 
		$obs_ige= $rowcot[obs_ige];
		
		$fnd_mcn=$rowcot[fnd_mcn];
		$end_mcn=$rowcot[end_mcn];
		$fni_mcn=$rowcot[fni_mcn];
		$eni_mcn=$rowcot[eni_mcn];
		$obs_mcn=$rowcot[obs_mcn];
		
		
		$khi_oex=$rowcot[khi_oex];
		$khv_oex=$rowcot[khv_oex];
		
		if($cod_loex=='904105')
		{
			
			echo"<table class='Tbl0'>
			<tr><td class='Td1' align='center'><STRONG>HORMONA FOLÍCULO ESTIMULANTE - FSH</strong></td></tr>
			</table>";
			
			echo"
			<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
			   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
		 
			echo "
			<tr><td colspan=2><div align='center'>Resultado: 
			<input  type=text name='res_fsh' size='15' maxlength='15' value='$fsh_loex'></td>
			<tr>";
		  
			echo"
			   <tr>
			   <td> <div align='left'><strong>Hombres</strong></div></td>
			   <td> <div align='left'>1 - 14</div></td></tr>
			   
			   <tr><td colspan=2><div align='left'><strong>Mujeres</strong></div></td></tr>
			   <tr><td>Fase Folicular</td><td>3.0 - 12.0 </td></tr>
			   <tr><td>Fase Ovulatoria</td><td>8.0 - 22 - 0 </td></tr>
			   <tr><td>Fase Luteal</td><td>2 - 12</td></tr>
			   <tr><td>Post Menopausia</td><td>35 - 181</td></tr>";
			
			echo"
			  <tr>
				<td colspan=2><div align=left>
					<p><strong>OBSERVACIONES:</strong></p>
				</div></td>
			  </tr>";
			
			echo"
			  <tr >
				 <td colspan='2'>
				   <textarea name=obs_fsh  value='$obs_fsh' cols=60 rows=4>$obs_fsh</textarea>
				  </td>
			  </tr>";
			echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(12)><td></tr></table>";
			
		}
		
		if($cod_loex=='904107')
		{
			
			echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>HORMONA LUTEINIZANTE - LH</strong></td></tr>
		</table>";
		
		echo"
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "
		<tr><td colspan=2><div align='center'>Resultado: 
        <input  type=text name=res_lsh  value='$lsh_loex' size='15' maxlength='15'></td>
		<tr>";
	  
		echo"
		   <tr>
		   <td> <div align='left'><strong>Hombres</strong></div></td>
		   <td> <div align='left'>1.7 - 8.6</div></td></tr>
		   
		   <tr><td colspan=2><div align='left'><strong>Mujeres</strong></div></td></tr>
		   <tr><td>Fase Folicular</td><td>2.4 - 12-6 </td></tr>
		   <tr><td>Fase Ovulatoria</td><td>14 - 96</td></tr>
		   <tr><td>Fase Luteal</td><td>1.0 - 11.4</td></tr>
		   <tr><td>Post Menopausia</td><td>7.7 - 59</td></tr>";
		
		echo"
		  <tr>
			<td colspan=2><div align=left>
				<p><strong>OBSERVACIONES:</strong></p>
			</div></td>
		  </tr>";
		
		echo"
		  <tr >
			 <td colspan='2'>
			   <textarea name=obs_lsh  value='$obs_lsh' cols=60 rows=4>$obs_lsh</textarea>
			  </td>
		  </tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(13)><td></tr></table>";

		}
		
		if($cod_loex=='904510')
		{
			echo"<table class='Tbl0'>
			<tr><td class='Td1' align='center'><STRONG>PROGESTERONA</strong></td></tr>
			</table>";
			
			echo"
			<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
			   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
		 
			echo "
			<tr><td colspan=2><div align='center'>Resultado: 
			<input  type=text name='res_pgt' value='$pgs_loex' size='15' maxlength='15'></td>
			<tr>";
		  
			echo"
			   <tr>
			   <td> <div align='left'><strong>Hombres</strong></div></td>
			   <td> <div align='left'>0.2 - 1.4</div></td></tr>
			   
			   <tr><td colspan=2><div align='left'><strong>Mujeres</strong></div></td></tr>
			   <tr><td>Fase Folicular</td><td>0.2 - 1.5 </td></tr>
			   <tr><td>Fase Ovulatoria</td><td>0.8 - 3.0</td></tr>
			   <tr><td>Fase Luteal</td><td>1.7 - 2.7</td></tr>
			   <tr><td>Post Menopausia</td><td>0.1 -0.8</td></tr>";
			
			echo"
			  <tr>
				<td colspan=2><div align=left>
					<p><strong>OBSERVACIONES:</strong></p>
				</div></td>
			  </tr>";
			
			echo"
			  <tr >
				 <td colspan='2'>
				   <textarea name=obs_pgs  value='$obs_pgs' cols=60 rows=4>$obs_pgs</textarea>
				  </td>
			  </tr>";
			echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(14)><td></tr></table>";

		
		}
		
		if($cod_loex=='904601')
		{
			echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>TESTOSTERONA</strong></td></tr>
		</table>";
		
		echo"
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "
		<tr><td colspan=2><div align='center'>Resultado: 
        <input  type=text name='res_tst' value='$tst_loex' size='15' maxlength='15'></td>
		<tr>";
	  
		echo"
		   <tr>
		   <td> <div align='left'><strong>Hombres</strong></div></td>
		   <td> <div align='left'>2.8 - 8.0</div></td></tr>
		   
		   <tr><td><div align='left'><strong>Mujeres</strong></div></td>
		   <td><div align='left'>0.06 - 0.82</strong></div></td></tr>
		   <tr><td>1 Año </td><td>0.12 - 0.21 </td></tr>
		   <tr><td>1 - 6 Años</td><td>0.03 - 0.32</td></tr>
		   <tr><td>7 - 12 Años</td><td>0.03 - 0.68</td></tr>
		   <tr><td>13 - 17 Años</td><td>0.28 - 11.1</td></tr>";
		
		echo"
		  <tr>
			<td colspan=2><div align=left>
				<p><strong>OBSERVACIONES:</strong></p>
			</div></td>
		  </tr>";
		
		echo"
		  <tr >
			 <td colspan='2'>
			   <textarea name=obs_tst  value='$obs_tst' cols=60 rows=4>$obs_tst</textarea>
			  </td>
		  </tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(15)><td></tr></table>";
	
		
		}
		
		if($cod_loex=='904503')
		{
			echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>ESTRADIOL</strong></td></tr>
		</table>";
		
		echo"
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "
		<tr><td colspan=2><div align='center'>Resultado: 
        <input  type=text name='res_est' value='$est_loex' size='15' maxlength='15'></td>
		<tr>";
	  
		echo"
		   <tr>
		   <td> <div align='left'><strong>Hombres</strong></div></td>
		   <td> <div align='left'>7.63 - 42.6</div></td></tr>
		   
		   <tr><td colspan=2><div align='left'><strong>Mujeres</strong></div></td></tr>
		   <tr><td>Fase Folicular</td><td>12.5 - 166 </td></tr>
		   <tr><td>Fase Ovulatoria</td><td>85.5 - 498</td></tr>
		   <tr><td>Fase Luteal</td><td>43.8 - 211</td></tr>
		   <tr><td>Post Menopausia</td><td><50 -547</td></tr>";
		
		echo"
		  <tr>
			<td colspan=2><div align=left>
				<p><strong>OBSERVACIONES:</strong></p>
			</div></td>
		  </tr>";
		
		echo"
		  <tr >
			 <td colspan='2'>
			   <textarea name=obs_est  value='$obs_est' cols=60 rows=4>$obs_est</textarea>
			  </td>
		  </tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(16)><td></tr></table>";

			
		}
		
		if($cod_loex=='906446')
		{
		
			echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>ANTÍGENOS IgE</strong></td></tr>
		</table>";
		
		echo"
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "
		<tr><td colspan=2><div align='center'>Resultado: 
        <input  type=text name='res_ige' value='$ige_loex' size='15' maxlength='15' >UI / mL </td>
		<tr>";
	  
		echo"
		   <tr>
		   <td> <div align='left'><strong>Hombres</strong></div></td>
		   <td> <div align='left'>2.8 - 8.0</div></td></tr>
		   
		   <tr><td><div align='left'><strong>Neonatos</strong></div></td>
		   <td><div align='left'>Hasta 1.5<strong></div></td></tr>
		   <tr><td>1 Año </td><td>Hasta 15</td></tr>
		   <tr><td>1 - 5 Años</td><td>Hasta 60</td></tr>
		   <tr><td>6 - 9 Años</td><td>Hasta 90</td></tr>
		   <tr><td>10 - 15 Años</td><td>Hasta 200</td></tr>
		   <tr><td><b>Adultos</td><td>Hasta 100</td></tr>";
		
		echo"
		  <tr>
			<td colspan=2><div align=left>
				<p><strong>OBSERVACIONES:</strong></p>
			</div></td>
		  </tr>";
		
		echo"
		  <tr >
			 <td colspan='2'>
			   <textarea name=obs_ige  value='$obs_ige' cols=60 rows=4>$obs_ige</textarea>
			  </td>
		  </tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(17)><td></tr></table>";
	
	
		}
		if($cod_loex=='903427')
		{
			echo"<BR><BR><div align=center><b>ESTE FORMATO ES PRE- DEFINIDO";
			echo"<BR><BR><div align=center><b>CONTACTESE CON EL ADMINISTRADOR DEL SISTEMA";
		}
		
	
		if($cod_loex=='902219')
		{
		
			echo"<table class='Tbl0'>
			<tr><td class='Td1' align='center'><STRONG>EOSINOFILOS - MOCO NASAL</strong></td></tr>
			</table>";
			echo"<br>
			<table width=60% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
			<tr><td colspan=4 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
			
			echo"<tr><td>Fosa Nasal Derecha</td>";
			echo"<td><select name=fnd_mcn value=$fnd_mcn>";
			echo "<option value='0'> </option>";
			echo "<option value='Escasa'>Escasa</option>";
			echo "<option value='Moderada'>Moderada</option>";
			echo "<option value='Abundante'>Abundante</option>";
			echo "</select></td>";
			echo "<td>Reacción Leucocitaria</td>";
			echo"</tr>";
			echo"<tr><td>Eonosifolos</td>";
			echo "<td colspan=2><input type=text name=end_mcn size=10 value='$end_mcn' maxlength='10'>%</td>";
			echo "</tr>";
			
			echo"<tr><td>Fosa Nasal Izquierda</td>";
			echo"<td><select name=fni_mcn>";
			echo "<option value='0'> </option>";
			echo "<option value='Escasa'>Escasa</option>";
			echo "<option value='Moderada'>Moderada</option>";
			echo "<option value='Abundante'>Abundante</option>";
			echo "</select></td>";
			echo "<td>Reacción Leucocitaria</td>";
			echo"</tr>";
		
			echo"<tr><td>Eonosifolos</td>";
			echo "<td colspan=2><input type=text name=eni_mcn size=10 value='$eni_mcn' maxlength='10'>%</td>";
			echo "</tr>";
			
			echo"<tr><td>Observaciones</td>";
			echo "<td colspan=2><textarea name=obs_mcn  value='$obs_mcn' cols=40 rows=2>$obs_mcn</textarea></td>";
			echo "<tr><td colspan=3 align='center'><input type=button value=Guardar onClick=gua_bd(19)><td></tr></table>";
			echo"<br>";
			?>
				<script language="javaScript">form1.fnd_mcn.value='<?echo $rowcot[fnd_mcn];?>';</script>
				<script language="javaScript">form1.fni_mcn.value='<?echo $rowcot[fni_mcn];?>';</script>
			<?
				
		}
		if($cod_loex=='901305')
		{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center' ><STRONG>EXAMEN DIRECTO PARA HONGOS</strong></td></tr>
		</table>";
		
		echo"
		<table width=50% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		<tr><td colspan=5 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES</td></tr>";	
	 
		echo"<tr>";
			echo "<td colspan=2><b>Tipo de Muestra</td>";
			echo "<td colspan=3><input type=text name='tp_mues' value='$khi_oex' size=30></td></tr>";
			if($khv_oex==1)
			{
				echo "<tr><td colspan=3>Positivo Para Estructuras Micoticas</td>";
				echo "<td colspan=2><input type=radio name='chk_' value='1' checked></td></tr>";
				
				echo "<tr><td colspan=3>Negativo Para Estructuras Micoticas</td>";
				echo "<td colspan=2><input type=radio name='chk_' value='2' ></td></tr>";
			}
			else
			{
				echo "<tr><td colspan=3>Positivo Para Estructuras Micoticas</td>";
				echo "<td colspan=2><input type=radio name='chk_' value='1' ></td></tr>";
				
				echo "<tr><td colspan=3>Negativo Para Estructuras Micoticas</td>";
				echo "<td colspan=2><input type=radio name='chk_' value='2' checked></td></tr>";
			}
			echo "<tr><td colspan=5 align='center'><input type=button value=Guardar onClick='gua_bd(22)'>";
			echo "</tr></table>";
		
		}
		if($cod_loex=='901305')
		{
			echo"<table class='Tbl0'>
			<tr><td class='Td1' align='center' ><STRONG>TSH NEONATAL</strong></td></tr>
			</table>";
			
			
			echo"<BR><BR><div align=center><b>EL FORMATO TSH NEONATAL ES PRE- DEFINIDO";
			echo"<BR><BR><div align=center><b>POR FAVOR CONTACTESE CON EL ADMINISTRADOR DEL SISTEMA";
		
		}
		
		
	
	}
  }
}
$result20=mysql_query("SELECT `iden_dlab`, `gbl_esp`, `nume_esp`, `hip_esp`,`plaq_esp`,`pla_esp`,
`ani_esp`, `mcr_esp`, `mic_esp`, `pqu_esp`, `dic_esp`, `esq_esp`, `otr_mcn`, `org_esp`, `poli_esp`, `obsv_esp`, `esta_esp` 
FROM `labo_sgre` WHERE `iden_dlab`='$iden_labs'  AND `esta_esp`<>'EL'");

while($rowsgr= mysql_fetch_array($result20))

{
	$gbl_esp=$rowsgr["gbl_esp"];
	$nume_esp=$rowsgr["nume_esp"];
	$hip_esp=$rowsgr["hip_esp"];
	$ani_esp=$rowsgr["ani_esp"];
	$mcr_esp=$rowsgr["mcr_esp"];
	$mic_esp=$rowsgr["mic_esp"];
	$pqu_esp=$rowsgr["pqu_esp"];
	$dic_esp=$rowsgr["dic_esp"];
	$esq_esp=$rowsgr["esq_esp"];
	$otr_mcn=$rowsgr["otr_mcn"];
	$org_esp=$rowsgr["org_esp"];
	$poli_esp=$rowsgr["poli_esp"];
	$obsv_esp=$rowsgr["obsv_esp"];
	$plaq_esp=$rowsgr["plaq_esp"];
	$pla_esp=$rowsgr["pla_esp"];
	echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>EXTENDIDO DE SANGRE PERIFERICA</strong></td></tr>
		</table>";
		echo"<br>
		<table class='Tbl0' border=1>
		<tr><td colspan=8 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";		
	
		echo "<tr><td colspan=8><b>Globulos Blancos</td></tr>";
		echo"<tr>";
		echo"<td><select name=gbl_esp>";
		echo "<option value='0'> </option>";
		echo "<option value='Aumentados'>Aumentados</option>";
		echo "<option value='Normales'>Normales</option>";
		echo "<option value='Disminuidos'>Disminuidos</option>";
		echo "</select></td>";
		echo "<td colspan=7><input type=text name=nume_esp size=30 value='$nume_esp'></td>";
		echo"</tr>";
		
		echo"<tr><td colspan=8><b>Globulos Rojos</td></tr>";
		echo"<tr><td colspan=8>Normociticos Normocromicos";
		echo"<input type=checkbox name='chk_nn' value='1' onclick='prueba(this.checked)' ></td><tr>";
		echo"<tr>";
		echo"<td><input type=checkbox name='hbl_' value='1' onclick='habilita(this.checked,1)'>Hipocromia:";
		echo"<select name='hip_esp' disabled>";
		echo "<option value='0'> </option>";
		echo "<option value='Ligera'>Ligera</option>";
		echo "<option value='Moderada'>Moderada</option>";
		echo "<option value='Marcada'>Marcada</option>";
		echo "</select></td>";
		echo"<td><input type=checkbox name='ani_' value='1' onclick='habilita(this.checked,2)'>Anisocitosis:";
		echo"<select name=ani_esp disabled>";
		echo "<option value='0'> </option>";
		echo "<option value='Ligera'>Ligera</option>";
		echo "<option value='Moderada'>Moderada</option>";
		echo "<option value='Marcada'>Marcada</option>";
		echo "</select></td>";
		echo "<td><input type=checkbox name='macro_' value='1' onclick='habilita(this.checked,3)'>Con Macrocitos:";
		echo"<select name=mcr_esp disabled>";
		echo "<option value=''> </option>";
		echo "<option value='-'>-</option>";
		echo "<option value='+'>+</option>";
		echo "<option value='++'>++</option>";
		echo "<option value='+++'>+++</option>";
		echo "</select></td>";
		echo "<td colspan=2><input type=checkbox name='micro_' value='1' onclick='habilita(this.checked,4)'>Con Microcitos:";
		echo"<select name=mic_esp disabled>";
		echo "<option value=''> </option>";
		echo "<option value='-'>-</option>";
		echo "<option value='+'>+</option>";
		echo "<option value='++'>++</option>";
		echo "<option value='+++'>+++</option>";
		echo "</select></td></tr>";
		
		echo"<tr><td colspan=7><input type=checkbox name='poiq_' value='1' onclick='habilita(this.checked,5)'>Poiquilocitosis:";
		echo"<select name=pqu_esp disabled>";
		echo "<option value='0'> </option>";
		echo "<option value='Ligera'>Ligera</option>";
		echo "<option value='Moderada'>Moderada</option>";
		echo "<option value='Marcada'>Marcada</option>";
		echo "</select></td></tr>";
		echo "<tr><td><input type=checkbox name='dian_' value='1' onclick='habilita(this.checked,6)'>Con Dianocitos:";
		echo"<select name=dic_esp disabled>";
		echo "<option value=''> </option>";
		echo "<option value='-'>-</option>";
		echo "<option value='+'>+</option>";
		echo "<option value='++'>++</option>";
		echo "<option value='+++'>+++</option>";
		echo "</select></td>";
		echo "<td colspan=2><input type=checkbox name='esqu_' value='1' onclick='habilita(this.checked,7)'>Con Esquistocitos:";
		echo"<select name=esq_esp disabled>";
		echo "<option value=''> </option>";
		echo "<option value='-'>-</option>";
		echo "<option value='+'>+</option>";
		echo "<option value='++'>++</option>";
		echo "<option value='+++'>+++</option>";
		echo "</select></td>";
		echo "<td colspan=3><input type=checkbox name='otr_' value='1' onclick='habilita(this.checked,7)'>
		Con :<input type=text name=otr_mcn size=7 value='$otr_mcn' maxlength='10' disabled>";
		echo " <select name=org_esp disabled>";
		echo "<option value=''> </option>";
		echo "<option value='-'>-</option>";
		echo "<option value='+'>+</option>";
		echo "<option value='++'>++</option>";
		echo "<option value='+++'>+++</option>";
		echo "</select></td></tr>";
		echo"<tr><td><input type=checkbox name='poli_' value='1' onclick='habilita(this.checked,7)'>Policromatofilia:</td>";
		echo"<td colspan=7><select name='poli_esp' disabled>";
		echo "<option value='0'> </option>";
		echo "<option value='Ligera'>Ligera</option>";
		echo "<option value='Moderada'>Moderada</option>";
		echo "<option value='Marcada'>Marcada</option>";
		echo "</select></td></tr>";
		echo "<tr><td colspan=8><b>Plaquetas</td></tr>";
		echo"<tr>";
		echo"<td><select name='pla_esp'>";
		echo "<option value='0'> </option>";
		echo "<option value='Aumentados'>Aumentados</option>";
		echo "<option value='Normales'>Normales</option>";
		echo "<option value='Disminuidos'>Disminuidos</option>";
		echo "</select></td>";
		echo "<td colspan=7><input type=text name=plaq_esp size=20 value='$plaq_esp'></td>";
		
		echo"<tr><td><b>Observaciones:</td>";
		echo "<td colspan=6><textarea name=obsv_esp  value='$obsv_esp' cols=60 rows=2>$obsv_esp</textarea></td>";
		echo "<tr><td colspan=6 align='center'><input type=button value=Guardar onClick=gua_bd(20)><td></tr></table>";
		echo"<br>";
	}
	?>
		<script language="javaScript">form1.gbl_esp.value='<?echo $gbl_esp;?>';</script>
		<script language="javaScript">form1.hip_esp.value='<?echo $hip_esp;?>';</script>
		<script language="javaScript">form1.ani_esp.value='<?echo $ani_esp;?>';</script>
		<script language="javaScript">form1.mcr_esp.value='<?echo $mcr_esp;?>';</script>
		<script language="javaScript">form1.mic_esp.value='<?echo $mic_esp;?>';</script>
		<script language="javaScript">form1.pqu_esp.value='<?echo $pqu_esp;?>';</script>
		<script language="javaScript">form1.dic_esp.value='<?echo $dic_esp;?>';</script>
		<script language="javaScript">form1.esq_esp.value='<?echo $esq_esp;?>';</script>
		<script language="javaScript">form1.org_esp.value='<?echo $org_esp;?>';</script>
		<script language="javaScript">form1.poli_esp.value='<?echo $poli_esp;?>';</script>
		<script language="javaScript">form1.pla_esp.value='<?echo $pla_esp;?>';</script>
		<script language="javaScript">form1.plaq_esp.value='<?echo $plaq_esp;?>';</script>
	<?
	
	echo"</table>";
	if($oplb2==1)
	{	
		$consulta15=mysql_query("SELECT `iden_dlab` ,`tipo_mue` ,`num_mue` , `esta_mue` , `valo_mue`,`est_oex2` 
			FROM labo_oex2 WHERE `iden_dlab`='$iden_labs' AND `est_oex2`<>'EL'");

		if(mysql_num_rows($consulta15)<>0)
		{
		
		while($rowsgr= mysql_fetch_array($consulta15))
		{
			$tpm_alch=$rowsgr["tipo_mue"];
		}
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>COLORACION ACIDO ALCOHOL RESISTENTE</strong></td></tr>
		</table>";
		echo"<br>
		<table class='Tbl0' border=1>
		<tr><td colspan=5 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
		echo"<tr>";
		echo "<td colspan=2><b>Tipo de Muestra</td>";
		echo "<td colspan=3><input type=text name='tpm_alch' value='$tpm_alch' size=30></td></tr>";
		echo "<input type=hidden name=i value='$i'>";	
		for($m=1;$m<$i;$m++)
		{
			
			$nom_var='valo_mue'.$m;
			$valo_mue=$$nom_var;
			$nom_var2='esta_mue'.$m;
			$esta_mue=$$nom_var2;
			$nom_var3='num_mue'.$m;
			$num_mue=$$nom_var3;
			$nom_var4='ide_oex'.$m;
			$ide_oex=$$nom_var4;
			
			echo"<input type=hidden name='$nom_var4' value='$ide_oex'>";
			echo "<tr><td colspan=2>No.$num_mue <input type=checkbox name='chk1_alc' value='1' checked></td>";
			if($esta_mue=='N')
			{
				echo "<td><input type=radio name='$nom_var2' value='N' checked> No se Observan BAAR en 100 campos Observados</td>";
				echo "<tr><td colspan=2></td><td><input type=radio name='$nom_var2' value='P'>Positivo Para BAAR en 100 campos Observados</td>";
				echo "<td colspan=2><input type=text name='$nom_var' value='$valo_mue' size=5></td></tr>";
			
			}
			if($esta_mue=='P')
			{
				echo "<td><input type=radio name='$nom_var2' value='N'> No se Observan BAAR en 100 campos Observados</td>";
				echo "<tr><td colspan=2></td><td><input type=radio name='$nom_var2' value='P' checked>Positivo Para BAAR en 100 campos Observados</td>";
				echo "<td colspan=2><input type=text name='$nom_var' value='$valo_mue' size=5></td></tr>";
			
			}
		
		}
		
		echo "<tr><td colspan=5 align='center'><input type=button value=Guardar onClick='gua_bd(23,$i)'>";
		echo "</tr></table>";
		
	  }
	}
	//////////////////////////////////////////CONSULTA GRAM /////////////////////////
	if($oplb2==2)
	{
	 
		$cons_gram=mysql_query("SELECT `iden_dlab` ,`tipo_mue` ,`num_mue` , `esta_mue` ,
				`coco_grm`, `baci_grm`, `cbac_grm`, `gpos_grm`, `gneg_grm`, `gvar_grm`, `otro_grm`,`est_oex2`
				FROM labo_oex2 WHERE `iden_dlab`='$iden_labs' AND `est_oex2`<>'EL' AND cod_exam='901107'");
	
		if(mysql_num_rows($cons_gram)<>0)
		{
			
			while($rowsgrm= mysql_fetch_array($cons_gram))
			{
				$tpm_grm=$rowsgrm["tipo_mue"];
				$esta_mue=$rowsgrm["esta_mue"];
				$coco_grm=$rowsgrm["coco_grm"];
				$baci_grm=$rowsgrm["baci_grm"]; 
				$cbac_grm=$rowsgrm["cbac_grm"]; 
				$gpos_grm=$rowsgrm["gpos_grm"]; 
				$gneg_grm=$rowsgrm["gneg_grm"]; 
				$gvar_grm=$rowsgrm["gvar_grm"]; 
				$otro_grm=$rowsgrm["otro_grm"];
				
			}
		
			echo"<table class='Tbl0'>
			<tr><td class='Td1' align='center'><STRONG>COLORACION GRAM Y LECTURA PARA CUALQUIER MUESTRA</strong></td></tr>
			</table>";
			echo"<br>
			<table class='Tbl0' border=1>
			<tr><td colspan=5 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
			echo"<tr>";
			echo "<td colspan=2><b>Tipo de Muestra</td>";
			echo "<td colspan=3><input type=text name='tpm_grm' value='$tpm_grm' size=30></td></tr>";
			echo "<tr><td colspan=5><b>PMN</td></tr>";
			
			if($esta_mue=='0-1xC')
			{
				echo "<tr><td>0-1xC <input type=radio name='chk_' value='0-1xC' checked></td>";
				echo "<td>1-5xC <input type=radio name='chk_' value='1-5xC'>";
				echo "<td>6-10xC<input type=radio name='chk_' value='6-10xC'>";
				echo "<td>>10xC <input type=radio name='chk_' value='10xC'>";
			
			}
			if($esta_mue=='1-5xC')
			{
				echo "<tr><td>0-1xC <input type=radio name='chk_' value='0-1xC'></td>";
				echo "<td>1-5xC <input type=radio name='chk_' value='1-5xC' checked></td>";
				echo "<td>6-10xC <input type=radio name='chk_' value='6-10xC'></td>";
				echo "<td>>10xC <input type=radio name='chk_' value='10xC'>";
			
			}
			if($esta_mue=='6-10xC')
			{
				echo "<tr><td>0-1xC <input type=radio name='chk_' value='0-1xC'></td>";
				echo "<td>1-5xC <input type=radio name='chk_' value='1-5xC'>";
				echo "<td>6-10xC <input type=radio name='chk_' value='6-10xC' checked></td>";
				echo "<td>>10xC <input type=radio name='chk_' value='10xC'>";
			}
			if($esta_mue=='10xC')
			{
				echo "<tr><td>0-1xC <input type=radio name='chk_' value='0-1xC'></td>";
				echo "<td>1-5xC <input type=radio name='chk_' value='1-5xC'>";
				echo "<td>6-10xC <input type=radio name='chk_' value='6-10xC' checked></td>";
				echo "<td>>10xC <input type=radio name='chk_' value='10xC' checked></td></tr>";
			}
			
			echo "<tr><td colspan=5><b>MORFOLOGIA BACTERIANA</td></tr>";
			if($coco_grm==1)
				$var1=checked;
			if($baci_grm==1)
				$var2=checked;
			if($cbac_grm==1)
				$var3=checked;
			if($gpos_grm==1)
				$var4=checked;
			if($gneg_grm==1)
				$var5=checked;
			if($gvar_grm==1)
				$var6=checked;
			if($otro_grm!=' ')
				$var7=checked;
	
			echo "<tr><td align='center'>Cocos <input type=checkbox name='coc' value='1' $var1></td>";
			echo "<td colspan=2 align='center'>Bacilos<input type=checkbox name='bac' value='1' $var2></td>";
			echo "<td colspan=2 align='center'>CocoBacilos<input type=checkbox name='cba' value='1' $var3></td></tr>";
			echo "<tr><td align='center'>Gram Positiva <input type=checkbox name='gpos' value='1' $var4></td>";
			echo "<td colspan=2 align='center'>Gram Negativa<input type=checkbox name='gneg' value='1' $var5></td>";
			echo "<td colspan=2 align='center'>Gram Variable<input type=checkbox name='gvar' value='1' $var6></td></tr>";
			echo "<tr><td align='center'>Otros<input type=checkbox name='ov' value='1' $var7></td>";
			echo "<td colspan=4 align='left'><input type=text name=otrvar size=20 maxlength=30 value='$otro_grm'></td></tr>";
			echo "<tr><td colspan=5 align='center'><input type=button value=Guardar onClick='gua_bd(24)'>";
			echo "</tr></table>";
		
		}
	}
	
	if($oplb2==3)
	{
	 
		$cons_cpr=mysql_query("SELECT `iden_dlab`, `nume_fac`, `cod_exam`, `cod_usua`, `fech_recp`, 
		`fech_entr`, `tipo_mue`, `num_mue`, `esta_mue`, `valo_mue`, `coco_grm`, `baci_grm`, `cbac_grm`, 
		`gpos_grm`, `gneg_grm`, `gvar_grm`, `otro_grm`, `qbho_cpr`, `nobs_cpr`, `obse_cpr`, `est_oex2` 
		FROM `labo_oex2` WHERE `iden_dlab`='$iden_labs' AND `est_oex2`<>'EL' AND cod_exam='907002'");
	
		if(mysql_num_rows($cons_cpr)<>0)
		{
			
			while($rowscpr= mysql_fetch_array($cons_cpr))
			{
				$col_mues=$rowscpr["tipo_mue"];
				$asp_mues=$rowscpr["esta_mue"];
				$qui_eth=$rowscpr["valo_mue"];
				$trz_amb=$rowscpr["coco_grm"];
				$qui_etmb=$rowscpr["baci_grm"];
				$qui_gins=$rowscpr["cbac_grm"];
				$qui_exna=$rowscpr["gpos_grm"];
				$trz_gins=$rowscpr["gneg_grm"];
				$qui_blh=$rowscpr["gvar_grm"];
				$otr_pst=$rowscpr["otro_grm"];
				$chk_=$rowscpr["qbho_cpr"];
				$nsp_mues=$rowscpr["nobs_cpr"];
				$obs_mcn=$rowscpr["obse_cpr"];
				
			}
			
			if($qui_eth==1)
				$var1=checked;
			if($trz_amb==1)
				$var2=checked;
			if($qui_etmb==1)
				$var3=checked;
			if($qui_gins==1)
				$var4=checked;
			if($qui_exna==1)
				$var5=checked;
			if($trz_gins==1)
				$var6=checked;
			if($qui_blh !='')
				$var7=checked;
			if($chk_ =='1-5xC')	
				$var8=checked;
			if($chk_ =='6-10xC')
				$var9=checked;
			if($chk_ =='>10xC')
				$var10=checked;
			if($otr_pst!='')
				$var11=checked;
			if($nsp_mues=='1')
				$var12=checked;
			
				
			echo"<table class='Tbl0'>
			<tr><td class='Td1' align='center'><STRONG>FORMATO COPROLOGICO</strong></td></tr>
			</table>";
			echo"<br>
			<table class='Tbl0' border=1>
			<tr><td colspan=6 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
			echo"<tr>";
			echo "<td colspan=2><b>Color</td>";
			echo "<td ><input type=text name='col_mues' value='$col_mues' size=30></td>";
			echo "<td colspan=2><b>Aspecto</td>";
			echo "<td><input type=text name='asp_mues' value='$asp_mues' size=30></td></tr>";
			echo "<tr><td colspan=6><b>PARASITOLOGICO</td></tr>";
			
			echo "<tr><td><input type=checkbox name='qui_eth' $var1></td>";
			echo "<td colspan=3>Quistes de Entamocuba Histolytica</td>";
			echo "<td align='center'><input type=checkbox name='trz_amb' value='1' $var2></td>";
			echo "<td colspan=3>Trofozoitos de Amebas</td></tr>";
			
			echo "<tr><td><input type=checkbox name='qui_etmb' $var3></td>";
			echo "<td colspan=3>Quistes de Entomoeba Coli</td>";
			echo "<td align='center'><input type=checkbox name='qui_gins' $var4></td>";
			echo "<td colspan=3>Quisites de Giardia Intestinalis</td></tr>";
			
			echo "<tr><td><input type=checkbox name='qui_exna' $var5></td>";
			echo "<td colspan=3>Quistes de Endolimax Nana</td>";
			echo "<td align='center'><input type=checkbox name='trz_gins' value='1' $var6></td>";
			echo "<td colspan=3>Trofozoitos de Giardia Intestinalis</td></tr>";
			
			echo "<tr><td><input type=checkbox name='qui_blh' $var7></td>";
			echo "<td colspan=3 >Quistes de Blastocystis Hominis</td>";
			echo "<td align='center'><input type=checkbox name='otr_pst1'  $var12></td>";
			echo "<td colspan=3 >Otros <input type=text name='otr_pst' value=$otr_pst></td></tr>";
			
			echo "<tr><td></td>";
			echo "<td colspan=3 ><input type=radio name='chk_' value='1-5xC' $var8>1-5xC</td></tr>";
			echo "<tr><td align='center'></td>";
			echo "<td colspan=3 ><input type=radio name='chk_' value='6-10xC' $var9>6-10xC</td></tr>";
			echo "<tr><td align='center'></td>";
			echo "<td colspan=3 ><input type=radio name='chk_' value='>10xC' $var10>>10xC</td></tr>";
			
			echo "<tr><td align='center'><input type=checkbox name='nsp_mues'  $var12></td>";
			echo "<td colspan=6>No se observan parasitos intestinales en la muestra analizada</td></tr>";
			echo"<tr><td></td>";
			echo "<td colspan=6><b>Observaciones<br><textarea name=obs_mcn  value='$obs_mcn' cols=40 rows=2>$obs_mcn</textarea></td></tr>";
			echo "<tr><td colspan=6 align='center'><input type=button value=Guardar onClick='gua_bd(25)'></td></tr></table>";
		}
	}
	
echo" <input type=hidden name=format>";
echo" <input type=hidden name=funct>";
echo" <input type=hidden name=ic>";

?>

<?
if ($estado_usu=="I"){
  echo "<center><h2>Usuario No tiene FORMATO por Editar...</h2></center>";}
?>


	


</table>
</form>
</body>
</html>