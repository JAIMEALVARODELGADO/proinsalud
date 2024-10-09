<?
//session_register('gcod_usu');
//session_register('gfac_num');

?>
<html>
<head>
<style type="text/css">
<!--
.Estilo11 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px; color: #333366;
}
.Estilo3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #333366;}
-->
</style>
<SCRIPT LANGUAGE='JavaScript'>
function enviar()
{
	form1.action='bus_labs.php';
    form1.submit();
}

function validag()
{
   form1.action='add_tabl.php';
   form1.submit();
}

function validacod()
{ 
  if(event.keyCode == 13)
  {
	form1.submit();
  }
}
function opcion()
{
	form1.action='edi_orden.php';
	form1.submit();		
}
	
function gua_bd(oco)
{
	form1.evalua.value=1;
	form1.format.value=oco;
	form1.action='guarda_formato2.php';
	form1.target='Fr04';
	form1.submit();		
	
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
</head>
<body>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<form name="form1" method="POST" action="edi_orden.php" >
<?

		$link=Mysql_connect("localhost","root","");
		if(!$link)echo"no hay conexion";
		Mysql_select_db('proinsalud',$link);
		
		echo "<input type=hidden name=nord_dlab value='$nord_dlab'>";
		echo "<input type=hidden name=iden_labs value=$iden_labs>";
		echo "<input type=hidden name=codusu value=$codusu>";
		
	
	/*$resultusu ="SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU,usuario.DIRE_USU, usuario.TRES_USU ,contrato.NEPS_CON
	FROM usuario
	INNER JOIN ucontrato AS ucontrato ON ucontrato.CUSU_UCO=usuario.CODI_USU
	INNER JOIN contrato AS contrato ON contrato.CODI_CON=ucontrato.CONT_UCO
	WHERE usuario.CODI_USU='$codusu' AND ucontrato.ESTA_UCO='AC'";*/
	
	$resultusu ="SELECT usuario.CODI_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.DIRE_USU, usuario.TRES_USU, ucontrato.CONT_UCO, contrato.NEPS_CON
	FROM (usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
	WHERE usuario.CODI_USU='$codusu' AND ucontrato.CONT_UCO='$codi_con' AND ucontrato.ESTA_UCO='AC'";

	//echo $resultusu;
	$resultusu =mysql_query($resultusu);
	while($rowusu=mysql_fetch_array($resultusu))
	{
		$edad=calculaedad($rowusu['FNAC_USU']);
		//echo $edad;
		$nombre= "$rowusu[PNOM_USU] $rowusu[SNOM_USU]  $rowusu[PAPE_USU]";
		$iden_uco="$rowusu[CODI_USU]";
		$sexo=" $rowusu[SEXO_USU]";
		$mres_usu ="$rowusu[MRES_USU]";
		$contrato="$rowusu[NEPS_CON]"; 
		$direc=$rowusu[DIRE_USU]." - ".$rowusu[TRES_USU];
		
		echo"<br><br><br><table class='Tbl2' border=0>
		<tr bgcolor=#BED1DB align='center'><td><b>$nombre</span>
		<td><b>$edad</td>
		<td><b>$direc</td>
		<td><b>$contrato</td></tr>";

		
	}
		
		$consulta="SELECT el.iden_labs, dl.estd_dlab,el.codi_usu,dl.codigo
			   FROM detalle_labs AS dl
			   INNER JOIN encabezado_labs AS el ON el.iden_labs = dl.iden_labs
			   WHERE dl.nord_dlab='$nord_dlab'AND (dl.estd_dlab='P' OR dl.estd_dlab='PR')";
		//echo $consulta;
		$consulta=mysql_query($consulta);
		
		echo "<table border=1 table class='Tbl0'><tr>";
	    echo "<td class='Estilo3' bgcolor=#BED1DB>CODIGO</td>
			  <td class='Estilo3' align='center' bgcolor=#BED1DB>DESCRIPCION</td>
			  </tr>";
				
		while ($rowdet=mysql_fetch_array($consulta))

		{
			//echo "<tr><td class='Estilo3'><input name=codchk type=checkbox onclick=\"location.href='qui_2edescir.php?cod1_cup=$row[codigo]'\"></td>";
			echo "<tr><td class='Estilo11'>$rowdet[codigo]</td>";
			$cod=$rowdet[codigo];
			$cons=mysql_query("SELECT codigo,descrip FROM CUPS WHERE codigo='$cod'");
			while ($rowd=mysql_fetch_array($cons))
			{
				$desc=$rowd[descrip];
				
			}
			$codigo=$rowdet[cod_usua];
			echo "<td class='Estilo11'>$desc</td>";
		}
	    echo "<tr><td class='Estilo11'><input type=text name='codi_cir' size=6 maxlength=6 onkeydown='validacod()' value=$codi_cir>";
		echo "<a href='#' onclick='enviar()'><img hspace=0 width=15 height=15 src='icons\bus.gif' alt='Buscar' border=0 align='center'></a></td>";
		echo "<td class='Estilo11'>";
		$consmap=mysql_query("SELECT codigo, descrip FROM cups WHERE codigo='$codi_cir'");
		$row=mysql_fetch_array($consmap);
	    echo "<input type=hidden name=nom_exa value='$row[descrip]'>$row[descrip]</td>";
		echo "</tr>";
		echo "<tr><td colspan='2' class='Estilo11' width='45%'><input type=button value='Guardar' onclick='validag()'></td></tr>";
		echo"</table>";
		
		
		/////////////////////////////////////////////////////////////////////////////FORMATOS
		
		echo "<table border=1 table class='Tbl0'><tr>";
		echo "<td colspan='2' bgcolor=#BED1DB>ADICIONAR FORMATO</td>";
	    echo "<td class='Estilo3' bgcolor=#BED1DB>";
		echo"<select name='esta_lab' onchange='opcion()'>";
		echo "<option value='0'> </option>";
		 $cons_lab=mysql_query("SELECT nomb_des,valo_des  FROM  destipos WHERE codt_des =51 Order by nomb_des");
		 if(mysql_num_rows($cons_lab)<>0)
			{
				
				
				while($rowvrf=mysql_fetch_array($cons_lab))
				{
					echo "<option value=$rowvrf[valo_des]>$rowvrf[nomb_des]</option>";
					//echo "valores<br>".$rowvrf[valo_des];
					//echo "nombre<br>".$rowvrf[nomb_des];
				}
			}
		echo"</tr></table>";
		?><script language='javascript'>form1.esta_lab.value="<?echo $esta_lab?>";</script><?
		
	if($esta_lab==1)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>UROANALISIS</strong></td></tr>
		</table>";

	
		echo"<br><br><table width=70% height=20 border=1 align=center cellspacing=1 bordercolor=#BED1DB bgcolor=#FFFFFF>
			<tr><div align=center><th height=20 colspan=2 bgcolor=#BED1DB><span class=Estilo32>Caracteres Generales</span></th></div>
			<div align=center> <th height=20 colspan=2 bgcolor=#BED1DB ><span class=Estilo32>Sedimentos </span></th></div></tr>";

		echo"<tr class=Estilo33><td width=55><div align=left><span>Aspectos: </span></div></td>
			<td width=25%>
				<select name=asp_uru>
				  <option>-</option>
				  <option>Limpido</option>
				  <option>Lig Turbio</option>
				  <option>Muy Turbio</option>
				  <option>Turbio</option>
				</select></td>
			<td width=25%><div align=center class=Estilo33><div align=left><span >Leucocitos</span></div></div></td>
			<td><input type=text name=leu_uru  value='$leu_uru' size='10' maxlength='12'>/ul</td>
		</tr>";

		echo"<tr class=Estilo33><td><div align=left><span>Color: </span></div></td>
			<td><span>
				<select name=color_uru >
				  <option>-</option>
				  <option>Ambar</option>
				  <option>Amarillo</option>
				  <option>Amarillo Intenso</option>
				  <option>Hematurico</option>
				  <option>Hidrulico</option>
				  <option>Naranja</option>
				</select>
			</span></td>
        
			<td><div align=left><span>C. Epiteliales </span></div></td>
			<td><input type=text name=epi_uru  value='$epi_uru' size='10' maxlength='12'>/ul
			<input type=checkbox name=alt_uru  value=altas>Altas</td>
		  </tr>";

		echo"<tr class=Estilo33><td><div align=left><span >P.H:</span></div></td>
			<td><select name=ph_uru>
			  <option>-</option>
			  <option>1.0</option>
			  <option>1.5</option>
			  <option>2.0</option>
			  <option>2.5</option>
			  <option>3.0</option>
			  <option>3.5</option>
			  <option>4.0</option>
			  <option>4.5</option>
			  <option>5.0</option>
			  <option>5.5</option>
			  <option>6.0</option>
			  <option>6.5</option>
			  <option>7.0</option>
			  <option>7.5</option>
			  <option>8.0</option>
			  <option>8.5</option>
			  <option>9.0</option>
			  <option>9.5</option>
			  <option>10.0</option>
			</select></td>
			<td><div align=left><span class=Estilo33>Hematies</span></div></td>
				<td><select name=her_uru >
				<option>-</option>
				<option>Eumorfos</option>
				<option>Dismorfos</option>
				<option>Eumorfos/Dismorfos</option>
				</select><input type=text name=hem_uru  value='$hem_uru' size='3' maxlength='12'>/ul</td>
        </tr>";

		echo"<tr class=Estilo33>
		  <td><div align=left><span class=Estilo33>Densidad</span></div></td>
		  <td><select name=den_uru >
			<option>-</option>
			<option>1000</option>
			<option>1005</option>
			<option>1010</option>
			<option>1015</option>
			<option>1020</option>
			<option>1025</option>
			<option>1030</option>
		  </select></td>
			<td><div align=left><span class=Estilo33>Cilindros</span></div></td>
			  <td><input type=text name=cili_uru  value='$cili_uru' size='10' maxlength='12'>/ul</td>
		  </tr>";

		echo"<tr class=Estilo33><td><div align=left><span class=Estilo33>Albumina:</span></div></td>
				<td><span class=Estilo33><input type=text name=alb_uru  value='$alb_uru' size='10' maxlength='12'>mg/dl</span></td>
				<td><div align=left><span class=Estilo33>Cristales</span></div></td>
				<td><select name=cris_uru >
				<option selected>-</option>
				<option>Ox De Calcio</option>
				<option>Acido Urico</option>
				<option>Fosfatos Amorfos</option>
				<option>Uratos Amorfos</option>
				<option>Otros</option>
			  </select>
			  <br><select name=cris_uru2>
			  <option> </option>
			  <option>Dihidratados</option>
			  <option>Mono Hidratados</option>
			  <option>Mono/Dihidratados</option>
			  </select>
			  <input  type=text name=cri_uru  value='$cri_uru ' size='9' maxlength='12'>/ul</td>
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
			  <option>-</option>
			  <option>+</option>
			  <option>++</option>
			  <option>+++</option>
			  <option>++++</option>
		   </select>
		   <select name=esc2_uru>
          <option> </option>
		  <option>Escaso</option>
		  </select></td>
		</tr>";

		echo"<tr ><td><div align=left><span >Cetonas</span></div></td>
				<td><input type=text  name=cet_uru value='$cet_uru' size='10' maxlength='12'>
				mg/dl</span></td>
				<td><div align=left>Levadura</span></div></td>
				<td><select name=lev_uru >
				  <option>-</option>
				  <option>+</option>
				  <option>++</option>
				  <option>+++</option>
				  <option>++++</option>
				</select></td>
		</tr>";

		echo"<tr class=Estilo33><td><div align=left>Pigmentos Biliares </span></div></td>
				<td><input type=text  name=pig_uru value='$pig_uru' size='10' maxlength='12'>
				</span></td>
				<td><div align=left><span class=Estilo33>Bacterias</span></div></td>
				<td><select name=bac_uru >
				 <option></option>
				  <option>-</option>
				  <option>+</option>
				  <option>++</option>
				  <option>+++</option>
				  <option>++++</option></select>
				  <select name=esc_uru>
				  <option> </option>
				  <option>Escasas</option></select>
				</td>
		</tr>";

		echo"<tr class=Estilo33><td><div align=left>Sangre</span></div></td>
				<td><input type=text  name=san_uru value='$san_uru' size='10' maxlength='10'>
				mg/dl</span></td>
				<td><div align=left>Tricomonas</span></div></td>
				<td><select name=tri_uru>
				  <option>-</option>
				  <option>+</option>
				  <option>++</option>
				  <option>+++</option>
				  <option>++++</option>
				</select></td>
		</tr>";

		echo"<tr class=Estilo33><td><div align=left>Urobilinogeno</span></div></td>
				<td><span class=Estilo33><div align=left>
				  <select name=uro_uru>
					<option>-</option>
					<option>Normal</option>
					<option>Otro</option>
				  </select> <input type=text name=val_uru size=3 maxlength='10'>
				</div></td>
				<td>Espermatozoides
				  <div align=center></div></td>
				<td><select name=esp_uru >
				  <option>-</option>
				  <option>+</option>
				  <option>++</option>
				  <option>+++</option>
				  <option>++++</option>
				</select></td>
		 </tr>";
		echo"
		<tr>
		  <td><div align=right>Nitritos</div></td>
		  <td><select name=nit_uru>
			<option>-</option>
			<option>Negativo</option>
			<option>Positivo</option>
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
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(1)><td></tr></table>";
	
	
	}
	////////////////FROTIS VAGINAL////////
	if($esta_lab==2)
	{
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
	              <option> 1.0</option>
	              <option> 2.0</option>
	              <option> 3.0</option>
	              <option> 4.0</option>
	              <option> 5.0</option>
	              <option> 6.0</option>
	              <option> 7.0</option>
	              <option> 8.0</option>
	              <option> 9.0</option>
	              <option> 10.0</option>
			</select></div></td>
			
			<td width=30%><div align=left class=Estilo9>Test De Aminas:
        	  <select name=tea_ftv>
					<option> </option>
	                <option>Negativo</option>
	                <option>Positivo</option>
	                <option>Otro</option>
	          </select></div></td>

   		    <td width=30%><div align=left class=Estilo9>KOH:	
			<select name=koh_ftv>
					<option> </option>
					<option>Negativo</option>
					<option>Positivo</option>
					<option>Otro</option>
			</select></div></td>
		
    		<td width=50%><div align=left class=Estilo9>Trichoma Vaginalis:
            <select name=tcv_ftv>
				<option> </option>
                <option>Negativo</option>
                <option>Positivo</option>
                <option>Otros</option>
            </select>
         
        </div></td></tr>";
		echo "<tr>
        <td colspan=4><strong>GRAMA VAGINAL</strong></span> </td>
		</tr>
		<tr>
        <td><div align=left>PMN(X CAMPO):
        <select name=pmc_ftv>
          <option>-</option>
          <option>0 - 1</option>
          <option>1- 5</option>
          <option>5 - 10</option>
          <option>&gt;10 </option>
        </select>XC</div></td>
		<td class=Estilo9 ><div align=left>Celulas Guias:
        		<select name=ceg_ftv>
				<option> </option>
	            <option>Negativo</option>
	            <option>Positivo</option>
	            <option>Otro</option>
        </select>
        </div></td>
		<td ><div align=left class=Estilo9>Seudomicelios:
          <select name=seu_ftv>
          <option>-</option>
		  <option>Negativo</option>
          <option>Abundante</option>
          <option>Escaso</option>
          <option>Moderado</option>
        </select>
		</div></td>
		<td><div align=left class=Estilo9>Lactobacilos:
            <select name=lac_ftv >
	        <option>-</option>
			<option>Negativo</option>
	        <option>Abundante</option>
	        <option>Escaso</option>
	        <option>Moderado</option>
          </select>
        </div></td></tr>
		<tr><td><div align=left class=Estilo9>Levaduras:
            <select name=lev_ftv >
			<option>-</option>
			<option>Negativo</option>
            <option>Abundante</option>
            <option>Escaso</option>
            <option>Moderado</option>
          </select>
        </div></td></tr>";
       echo "<tr>
			<td colspan=4 ><div align=left>
			<p><strong><span class=Estilo9>FLORA PREDOMINANTE </span></strong></p>
			</div></td></tr>
			<tr><td><div align=right class=Estilo9>MORFOLOGIA:</div>
			</div></td>
			<td class=Estilo9>
            <label><input name=co_ftv type=checkbox  value='Cocos'>Cocos</label></span></td>
			<td class=Estilo9>
            <label><input name=ba_ftv type=checkbox  value='Bacilos'>Bacilos</label></span></td>
            <td class=Estilo9>
		    <label><input name=coba_ftv type=checkbox  value='CocoBacilos'>Cocos Bacilos </label></td>
			</tr>
			<tr>
			<td >&nbsp;</td>
			<td class=Estilo9 >
			<label><input name=grap_ftv type=checkbox value='GramPositivos'>Gram Positivos</label></td>
			<td class=Estilo9> 
			<label><input name=gran_ftv type=checkbox value='GramNegativos'>Gram Negativos</label>  </td>
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
            <option>0-1</option>
            <option>1-5</option>
            <option>5-10</option>
            <option>&gt;10</option>
            </select>
		    <span class=Estilo9>XC</span></td>
			<td colspan=2>
			<div align=left>Diplococos Gram Negativos Intracelulares:
            <select name=dgni_ftv >
            <option>-</option>
            <option>Si</option>
            <option>No</option>
            </select></div></td>
			<td><span >Diplococos Gram Negativos Estracelulares:
            <select name=dgne_ftv>
              <option>-</option>
              <option>Si</option>
              <option>No</option>
            </select>
			</span></td>
           	</tr>";
			echo"<tr>
			<td><p align= right><strong>OBSERVACIONES:</strong></p></td>
			<td colspan=3>
			<p align=left>
			<textarea name=obsfrt_ftv value='$obsfrt_ftv' cols=80 rows=3></textarea></td>
			</tr>";
			echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(2)><td></tr></table>";
		}
	//////////////////////////////////////////////COPROSCOPICO
	if($esta_lab==3)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>COPROSCOPICO</strong></td></tr>
		</table>";
		echo "<br><br><table width=80% align='center' border=1  bordercolor=#BED1DB bgcolor=#FFFFFF>
	  	 <tr>
		 <th colspan=4 bgcolor=#BED1DB>
		 <p>CARACTERISTICAS GENERALES</p>
	  	 </tr>";
		 echo"<tr>
		 <td colspan=4><div align=left><strong>COPROSCOPICO</strong></div></td>
		 </tr>
		 <tr>
		 <td width=30%><div align=left>PH:
		 <select name=ph_cps>
			<option>-</option>
			<option>1.0</option>
			<option>1.5</option>
			<option>2.0</option>
			<option>2.5</option>
			<option>3.0</option>
			<option>3.5</option>
			<option>4.0</option>
			<option>4.5</option>
			<option>5.0</option>
			<option>5.5</option>
			<option>6.0</option>
			<option>6.5</option>
			<option>7.0</option>
			<option>7.5</option>
			<option>8.0</option>
			<option>8.5</option>
			<option>9.0</option>
			<option>9.5</option>
			<option>10</option>
		</select></td>
		<td><div align=left>Color:
			<select name=color_cps>
			<option> </option>
			<option>Amarilla</option>
			<option>Blanquesino</option>
			<option>Carmelita</option>
			<option>Negro</option>
			<option>Otro</option>
			<option>Verdoso</option>
			</select></td>
		<td><div align=left>Consistencia:
			<select name=con_cps>
			<option> </option>
			<option>Blanda</option>
			<option>Dura</option>
			<option>Liquida</option>
			<option>Semiliquida</option>
			<option>Diarreica</option>
			</select></td>
		<td><div align=left>Sangre Oculta:
			<select name=san_cps>
            <option>-</option>
            <option>Positivo</option>
            <option>Negativo</option>
			</select></td></tr>";
			
		echo "<tr>
		      <td colspan=2><div align=left>Azucares Reductores
              <select name=azu_cps>
              <option>-</option>
              <option>Positivo</option>
              <option>Negativo</option>
			  </select>
			  <select name=val_cps>
			  <option>-</option>
			  <option>0</option>
	          <option>250</option>
	          <option>550</option>
	          <option>700</option>
			  </select>mg/l</td>";
			  
		echo"<td>Leucocitos:
		 <select name=leuc_cpr>
                <option></option>
                <option>1-5XC</option>
                <option>5-10XC</option>
                <option>&gt;10XC</option>
              </select></td>";
		//<input type=text name=leuc_cpr size=8>
		echo"<td>Hematies:
		<select name=hema_cpr>
                <option></option>
                <option>1-5XC</option>
                <option>5-10XC</option>
                <option>&gt;10XC</option>
              </select></td>";
		//<input type=text name= size=8></td></tr>";	  
		
	  echo" <tr>
			  <td colspan=4><div align=left><strong>COPROLOGICO</strong></div></td></tr>
	  	    <tr>
			  <td><div align=left>Moco:
			  <select name=moc_cps >
              <option>-</option>
              <option>+</option>
              <option>++</option>
              <option>+++</option>
              <option>++++</option>
              </select></td>
			  <td><div align=left>Levaduras:
			  <select name=lev_cps >
			  <option>-</option>
              <option>+</option>
              <option>++</option>
              <option>+++</option>
              <option>++++</option>
              </select></td>
			  <td colspan=2><div align=left>Micelios:
			  <select name=mic_cps >
			  <option> </option>
              <option>+</option>
	          <option>-</option>
              <option>Abundante</option>
              <option>Escaso</option>
              <option>Moderado</option>
              </select></td>";
			  
			 /*echo"<td><div align=left></td></tr>";
			  /*<select name=gra_cps>
              <option>-</option>
              <option>+</option>
              <option>++</option>
              <option>+++</option>
              <option>++++</option>
              echo"
			  ";
			 echo"<td>Flora Bacteriana:
			  <select name='flo_cps' >
              <option>-</option>
              <option>Aumentada</option>
              <option>Disminuida</option>
              <option>Lig/ Aumentada</option>
              <option>normal</option>
            </select></td></div>*/
			echo"<tr><td>
			<input  type='checkbox' name='qc_cps' value='Quiste.E.coli'>Quiste.E.coli</td></div>";
			//<input  type=text name=hom_cps size=5>
			echo"<td>
            <input  type='checkbox' name='qh_cps' value='Quiste.E. histolytica'>Quiste.E. histolytica </div></td>";
            //<input  type=text name=qeh_cps size=5>
			echo"<td><div align='left'>
            <input  type='checkbox' name='qn_cps' value='Q.E.nana'>Q.E.nana </div></td>";
            //<input  type=text name=qem_cps size=5>
			echo"
			<td>Otros:<input type=text name=otrcpr_cps size=10></td></tr>";
			echo"<tr>
			<td ><input  type='checkbox' name='bh_cps'  value='Blastocystis Hominis'>Blastocystis Hominis:
			<select name=bla_cps>
                <option></option>
                <option>1-5XC</option>
                <option>5-10XC</option>
                <option>&gt;10XC</option>
              </select></td>";
			//<input name=bla_cps type=text  size=5></div></td>
			echo"<td><div align='left'>
			<input  type='checkbox' name='ch_cps' value='Chilomastix mesnilli'>Chilomastix mesnilli</div></td>";
			//<input  type=text name=chi_cps  size=5></td>
	
			echo"<td><div align='left'>
            <input  type='checkbox' name='tz_cps' value='Trofozoitos'>Trofozoitos:
		    <input  type=text name='tro_cps' size=5></div></td></tr>
			<tr>
			<td colspan=4><div align=left>
			<input type=checkbox name=no_cps value='No se observa parasitos intestinales en la muestra analizada'>
			No se observa parasitos intestinales en la muestra analizada</td></tr>
			<tr>
			<td><div align='left'>Wright
            <select name=wri_cps>
              <option>-</option>
              <option>Negativo</option>
              <option>Positivo</option>
			</select> </div></td>
			<td>
			<div align=left>Neutrofilos:
			<input  type=text name=neu_cps value='$neu_cps' size=10>%</td>
			<td>
			<div align=left>Linfoncitos:
			<input  type=text  name=lin_cps value='$lin_cps' size=10>%</td>
			<td><div align=left>Eosinofilos:
			<input name=eos_cps type=text value='$eos_cps' size=10>%</div></td></tr>";
			echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(3)><td></tr></table>";

	}
	/////////////////////CUADRO HEMATICO
	if($esta_lab==4)
	{
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
		
		echo"<tr>
             <td><div align=left>Leucocitos:</td>
		     <td><input type=text name=leu_ch value='$leu_ch' size='7' maxlength='12'>/mm³</div></td>
             <td><div align=left>Plaquetas:</td>
             <td><input type=text name=pla_ch value='$pla_ch' size='7' maxlength='12'>/mm³</div></td></tr>";
		echo"
             <tr><td><div align=left>Neutrofilos:</td>
            <td><input type=text name=neu_ch value='$neu_ch' size='7' maxlength='12'>%</span></div></td>
	        <td><div align=left>Linfoncitos:</td>
			<td><input type=text name=lin_ch value='$lin_ch' size='7' maxlength='12'>%</div></td> ";
    
 
		echo"  <td><div align=left>Eosinofilos:</td>
			 <td><input type=text name=eos_ch value='$eos_ch' size='7' maxlength='12'>%</div></td></tr>
			 <tr><td><div align=left>Monocitos</td>
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
        <td><input type=text name=vcm_ch value='$vcm_ch' size='7' maxlength='7'>um</div></td> 
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
				   <p align=center>
				   <textarea name=obs_ch value='$obs_ch' cols=100 rows=5></textarea>
				 </p></td></tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(4)><td></tr></table>";
	
	}
	
	//////////////CUADRO DE VARIOS
	
	if($esta_lab==5)
	{
		//ECHO $esta_lab;
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>CUADRO DE VARIOS</strong></td></tr>
		</table>";
		
		echo"<br><br><table width=60% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
				   <tr >
			       <td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr> ";

			 echo"<tr>
			        <td align=center><strong>DATOS </strong></td>
			         <td><textarea name='cdr_datos' cols=80 rows=10></textarea></td>			        
			      </tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(5)><td></tr></table>";
	
	}
	//////////////////ESPERMOGRAMA//////////////
	if($esta_lab==6)
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
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(6)><td></tr></table>";
	}
	///////////////////////////HCB - G
	if($esta_lab==7)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>HCB -G</strong></td></tr>
		</table>";
		
		echo"
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "
		<tr><td colspan=2><div align='center'>Resultado: 
        <input  type=text name='res_hcg' size='15' maxlength='15'>  m UI / ml</td>
		<tr>";
		$cdeshcg=mysql_query("SELECT codi_des,nomb_des,valo_des FROM DESTIPOS WHERE codt_des='54' and val2_des='HCG'");
		 echo"<tr>
		   <td> <div align='left'><strong>Semana  </strong></div></td>
		    <td> <div align='left'><strong >V.    R  </strong></div></td></tr>";
		while($rowcdes=mysql_fetch_array($cdeshcg))
		{
			$valo_des=$rowcdes[valo_des];
			$nomb_des=$rowcdes[nomb_des];
			
			echo"<tr><td>$valo_des</td><td>$nomb_des</td></tr>";
		}
	  
		/*echo"
		   <tr>
		   <td> <div align='left'><strong>Semana  </strong></div></td>
		   <td> <div align='left'><strong >V.    R  </strong></div></td></tr>
		   <tr><td>4 </td><td>196-3537</td></tr>
		   <tr><td>5 </td><td>1026-30964 </td></tr>
		   <tr><td>6 </td><td>4250-81172 </td></tr>
		   <tr><td>7-8 </td><td>6002-114430</td></tr>
		   <tr><td>9-10 </td><td>18344-98807</td></tr>
		   <tr><td>11-14 </td><td>21874-120766</td></tr>
		   <tr><td>15-22 </td><td>40106-57393</td></tr>
		   <tr><td>23-40 </td><td>2468-36142</td></tr>";*/
		
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
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(7)><td></tr></table>";
	}
	////////////////////////////////INMUNOLOGIA
	if($esta_lab==8)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>INMUNOLOGIA - ANTIGENOS FEBRILES</strong></td></tr>
		</table>";
		
		echo "<br><br><table align='center' width=400 border=1 bordercolor=#BED1DB bgcolor=#FFFFFF >
	  	 <tr><td bgcolor=#BED1DB colspan=3><strong>CARACTERISTICAS GENERALES</td></tr>";

		echo "<tr>
            
		    <td >RA</td>
		    <td >
                <select name=rac_inm>
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
		
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(8)><td></tr></table>";
		
	}
	//////////////////////////////LIQUIDOS BIOLOGICOS/////////////////////////////////////////////////
	if($esta_lab==9)
	{
		
		
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>LIQUIDOS BIOLOGICOS</strong></td></tr>
		</table>";
		echo "<br><br><table align='center' width=70% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF >
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
		 <tr>
		 <td align=left>GRAM </td>
		 <td><textarea name=dif_gram  value='$dif_gram' cols=30 rows=2></textarea></td>
         <td align=left>KOH </td>
		 <td><textarea name=koh_lqd  value='$koh_lqd' cols=30 rows=2></textarea></td></tr>
         <tr><td align=left>PH </td>
		 <td><textarea name=ph_lqd  value='$ph_lqd' cols=30 rows=2></textarea></td>
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
			   <textarea name=obs_lqd  value='$obs_lqd' cols=100 rows=6></textarea>
			</td></tr>";
		
	   echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(9)><td></tr></table>";
	}
	/////////////BCHG//////////
	
	if($esta_lab==10)
	{
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
			<td>
			  <select name=bch_hcg >
				<option>-</option>
				<option>Positivo</option>
				<option>Negativo</option>
			  </select>
			</span>mUI/ml</td> 
			</tr>";
		echo "
		  <tr>
			<td colspan=3><b>Nota:</td>
			</tr>"; 
		echo"
		<tr><td colspan=3>Tecnica Microelisa rapida sensibilidad 10 mIU/ml</td></tr>";
		
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(10)><td></tr></table>";
	
	}
	/////////////////////////tropoinina
	if($esta_lab==11)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>TROPONINA</strong></td></tr>
		</table>";
	
		echo "<br><br>
	  	 <table width=50% border=1 align=center  bordercolor=#BED1DB bgcolor=#FFFFFF >
           <tr>
             <td colspan=3 bgcolor=#BED1DB align=center><b>CARACTERISTICAS GENERALES </td></tr>";
		echo"
		  <tr>
			<td>TROPONINA:</td>
			<td colspan=2>
			  <select name=trim_tpn >
				<option>-</option>
				<option>Positivo</option>
				<option>Negativo</option>
			  </select>Sensibilidad 1 ng / ml
			</td>
		  </tr>
		  <tr><td colspan=3 ><b>Nota</td></tr>
          <tr><td colspan='3' >Hasta 0.034 ng/ml<br> Valor Critico  0.034 a 0.120<br>Metodo Quimioluminicencia</td></tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(11)><td></tr></table>";
	}
	//////////////////////////////////////HORMONA FOLÍCULO ESTIMULANTE
	if($esta_lab==12)
	{
		//echo"<font size=2 color=red>NO UTILIZAR AUN EN PRUEBAS</font>";
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>HORMONA FOLÍCULO ESTIMULANTE - FSH</strong></td></tr>
		</table>";
		
		echo"
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "
		<tr><td colspan=2><div align='center'>Resultado: 
        <input  type=text name='res_fsh' size='15' maxlength='15'></td>
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
			   <textarea name=obs_fsh  value='$obs_fsh' cols=60 rows=4></textarea>
			  </td>
		  </tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(12)><td></tr></table>";
	}
	/////////////////////////////////////HORMONA LUTEINIZANTE

	if($esta_lab==13)
	{
		//echo"<font size=2 color=red>NO UTILIZAR AUN EN PRUEBAS</font>";
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>HORMONA LUTEINIZANTE - LH</strong></td></tr>
		</table>";
		
		echo"
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "
		<tr><td colspan=2><div align='center'>Resultado: 
        <input  type=text name='res_lsh' size='15' maxlength='15'></td>
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
			   <textarea name=obs_lsh  value='$obs_lsh' cols=60 rows=4></textarea>
			  </td>
		  </tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(13)><td></tr></table>";
	}
	/////////////////////////////////////HORMONA LUTEINIZANTE

	if($esta_lab==14)
	{
		//echo"<font size=2 color=red>NO UTILIZAR AUN EN PRUEBAS</font>";
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>PROGESTERONA</strong></td></tr>
		</table>";
		
		echo"
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "
		<tr><td colspan=2><div align='center'>Resultado: 
        <input  type=text name='res_pgt' size='15' maxlength='15'></td>
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
			   <textarea name=obs_pgt  value='$obs_pgt' cols=60 rows=4></textarea>
			  </td>
		  </tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(14)><td></tr></table>";
	}
	/////////////////////////////////////TESTOSTERONA

	if($esta_lab==15)
	{
		//echo"<font size=2 color=red>NO UTILIZAR AUN EN PRUEBAS</font>";
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>TESTOSTERONA</strong></td></tr>
		</table>";
		
		echo"
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "
		<tr><td colspan=2><div align='center'>Resultado: 
        <input  type=text name='res_tst' size='15' maxlength='15'></td>
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
			   <textarea name=obs_tst  value='$obs_tst' cols=60 rows=4></textarea>
			  </td>
		  </tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(15)><td></tr></table>";
	}
	/////////////////////////////////////>ESTRADIOL
	if($esta_lab==16)
	{
		//echo"<font size=2 color=red>NO UTILIZAR AUN EN PRUEBAS</font>";
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>ESTRADIOL</strong></td></tr>
		</table>";
		
		echo"
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "
		<tr><td colspan=2><div align='center'>Resultado: 
        <input  type=text name='res_est' size='15' maxlength='15'></td>
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
			   <textarea name=obs_est  value='$obs_est' cols=60 rows=4></textarea>
			  </td>
		  </tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(16)><td></tr></table>";

	}
	/////////////////////////////////////ANTÍGENOS IgE
	if($esta_lab==17)
	{
		//echo"<font size=2 color=red>NO UTILIZAR AUN EN PRUEBAS</font>";
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>ANTÍGENOS IgE</strong></td></tr>
		</table>";
		
		echo"
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "
		<tr><td colspan=2><div align='center'>Resultado: 
        <input  type=text name='res_ige' size='15' maxlength='15'>UI / mL </td>
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
			   <textarea name=obs_ige  value='$obs_ige' cols=60 rows=4></textarea>
			  </td>
		  </tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(17)><td></tr></table>";
	}
	
	if($esta_lab==18)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>HEMOGLOBINA GLICOSILADA</strong></td></tr>
		</table>";
		
		echo"<br>
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "<tr><td ><div align='center'><b></td>";
		echo "<td ><div align='left'><b>Valores</td></tr>";
		echo "<tr><td><div align='left'>No Biabeticos</td>";
		echo "<td><div align='left'>4.0 - 6.0 </td></tr>";
		echo "<tr><td><div align='left'>Objetivo</td>";
		echo "<td><div align='left'>6.0 - 6.5 </td></tr>";
		echo "<tr><td><div align='left'>Buen Control</td>";
		echo "<td><div align='left'>6.5 - 8.0 </td></tr>";
		echo "<tr><td><div align='left'>Precisa Actuación</td>";
		echo "<td><div align='left'>>8.0 </td></tr>";
	
		echo "<tr><td colspan=2 align='center'><input type=button value=Guardar onClick=gua_bd(18)><td></tr></table>";
	
	}
	if($esta_lab==19)
	{
	
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>EOSINOFILOS - MOCO NASAL</strong></td></tr>
		</table>";
		echo"<br>
		<table width=60% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		<tr><td colspan=4 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
		
		echo"<tr><td>Fosa Nasal Derecha</td>";
		echo"<td><select name=fnd_mcn>";
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
		echo "<td colspan=2><textarea name=obs_mcn  value='$obs_mcn' cols=40 rows=2></textarea></td>";
		echo "<tr><td colspan=3 align='center'><input type=button value=Guardar onClick=gua_bd(19)><td></tr></table>";
		echo"<br>";

	}
	
	if($esta_lab==20)
	{
		
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
		echo"<td><select name=pla_esp>";
		echo "<option value='0'> </option>";
		echo "<option value='Aumentados'>Aumentados</option>";
		echo "<option value='Normales'>Normales</option>";
		echo "<option value='Disminuidos'>Disminuidos</option>";
		echo "</select></td>";
		echo "<td colspan=7><input type=text name=plaq_esp size=20 value='$plaq_esp'></td>";
		
		echo"<tr><td><b>Observaciones:</td>";
		echo "<td colspan=6><textarea name=obsv_esp  value='$obsv_esp' cols=60 rows=2></textarea></td>";
		echo "<tr><td colspan=6 align='center'><input type=button value=Guardar onClick=gua_bd(20)><td></tr></table>";
		echo"<br>";
	
	}	

	if($esta_lab==23)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>COLORACION ACIDO ALCOHOL RESISTENTE</strong></td></tr>
		</table>";
		echo"<br>
		<table class='Tbl0' border=1>
		<tr><td colspan=5 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
		echo"<tr>";
		echo "<td colspan=2><b>Tipo de Muestra</td>";
		echo "<td colspan=3><input type=text name='tpm_alch' value='$tpm_alch' size=30></td></tr>";
		
		echo "<tr><td colspan=4><b>MUESTRAS NEGATIVAS</td>";
		echo "<tr><td colspan=2>No.1 </td>";
		echo "<td colspan=2><input type=radio name='chk_1' value='N'> No se Observan BAAR en 100 campos Observados</td>";
		echo"</tr>";
		
		echo "<tr><td colspan=2>No.2 </td>";
		echo "<td colspan=2><input type=radio name='chk_2' value='N'>No se Observan BAAR en 100 campos Observados</td>";
		echo"</tr>";
		
		echo "<tr><td colspan=2>No.3 </td>";
		echo "<td colspan=2><input type=radio name='chk_3' value='N'>No se Observan BAAR en 100 campos Observados</td>";
		
		echo"</tr>";
		
		echo "<tr><td colspan=4><b>MUESTRAS POSITIVAS</td>";
		echo "<tr><td colspan=2>No.1 </td>";
		echo "<td><input type=radio name='chk_1' value='P'>Positivo Para BAAR en 100 campos Observados</td>";
		echo "<td><input type=text name='tpm_neg1' value='$tpm_neg1' size=5></td>";
		echo"</tr>";
		
		
		echo "<tr><td colspan=2>No.2</td>";
		echo "<td ><input type=radio name='chk_2' value='P'>Positivo Para BAAR en 100 campos Observados</td>";
		echo "<td><input type=text name='tpm_neg2' value='$tpm_neg2' size=5></td>";
		echo"</tr>";
		
		echo "<tr><td colspan=2>No.3</td>";
		echo "<td><input type=radio name='chk_3' value='P'>Positivo Para BAAR en 100 campos Observados</td>";
		echo "<td><input type=text name='tpm_neg3' value='$tpm_neg3' size=5></td>";
		echo "</tr>";
		
		echo "<tr><td colspan=5 align='center'><input type=button value=Guardar onClick='gua_bd(23)'>";
		echo "</tr></table>";
	
	}
	if($esta_lab==25)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>COPROLOGICO</strong></td></tr>
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
		
		echo "<tr><td><input type=checkbox name='qui_eth' value='1'></td>";
		echo "<td colspan=3>Quistes de Entamocuba Histolytica</td>";
		echo "<td align='center'><input type=checkbox name='trz_amb' value='1'></td>";
		echo "<td colspan=3>Trofozoitos de Amebas</td></tr>";
		
		echo "<tr><td><input type=checkbox name='qui_etmb' value='1'></td>";
		echo "<td colspan=3>Quistes de Entomoeba Coli</td>";
		echo "<td align='center'><input type=checkbox name='qui_gins' value='1'></td>";
		echo "<td colspan=3>Quisites de Giardia Intestinalis</td></tr>";
		
		echo "<tr><td><input type=checkbox name='qui_exna' value='1'></td>";
		echo "<td colspan=3>Quistes de Endolimax Nana</td>";
		echo "<td align='center'><input type=checkbox name='trz_gins' value='1'></td>";
		echo "<td colspan=3>Trofozoitos de Giardia Intestinalis</td></tr>";
		
		echo "<tr><td><input type=checkbox name='qui_blh' value='1'></td>";
		echo "<td colspan=3 >Quistes de Blastocystis Hominis</td>";
		echo "<td align='center'><input type=checkbox name='otr_pst1' value='1'></td>";
		echo "<td colspan=3 >Otros <input type=text name='otr_pst' ></td></tr>";
		
		echo "<tr><td></td>";
		echo "<td colspan=3 ><input type=radio name='chk_' value='1-5xC'>1-5xC</td></tr>";
		echo "<tr><td align='center'></td>";
		echo "<td colspan=3 ><input type=radio name='chk_' value='6-10xC'>6-10xC</td></tr>";
		echo "<tr><td align='center'></td>";
		echo "<td colspan=3 ><input type=radio name='chk_' value='>10xC'>>10xC</td></tr>";
		
		echo "<tr><td align='center'><input type=checkbox name='nsp_mues' value='1'></td>";
		echo "<td colspan=6>No se observan parasitos intestinales en la muestra analizada</td></tr>";
		echo"<tr><td></td>";
		echo "<td colspan=6><b>Observaciones<br><textarea name=obs_mcn  value='$obs_mcn' cols=40 rows=2></textarea></td></tr>";
		echo "<tr><td colspan=6 align='center'><input type=button value=Guardar onClick='gua_bd(25)'></td></tr></table>";
	
	
	}
	if($esta_lab==24)
	{
		
		//cambiar nombre variables
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
		echo "<tr><td>0-1xC <input type=radio name='chk_' value='0-1xC'></td>";
		echo "<td>1-5xC <input type=radio name='chk_' value='1-5xC'></td>";
		echo "<td>6-10xC <input type=radio name='chk_' value='6-10xC'></td>";
		echo "<td>>10xC <input type=radio name='chk_' value='10xC'></td></tr>";
		echo "<tr><td colspan=5><b>MORFOLOGIA BACTERIANA</td></tr>";
		echo "<tr><td align='center'>Cocos <input type=checkbox name='coc' value='1'></td>";
		echo "<td colspan=2 align='center'>Bacilos<input type=checkbox name='bac' value='1'></td>";
		echo "<td colspan=2 align='center'>CocoBacilos<input type=checkbox name='cba' value='1'></td></tr>";
		echo "<tr><td align='center'>Gram Positiva <input type=checkbox name='gpos' value='1'></td>";
		echo "<td colspan=2 align='center'>Gram Negativa<input type=checkbox name='gneg' value='1'></td>";
		echo "<td colspan=2 align='center'>Gram Variable<input type=checkbox name='gvar' value='1'></td></tr>";
		echo "<tr><td align='center'>Otros<input type=checkbox name='ov' value='1'></td>";
		echo "<td colspan=4 align='left'><textarea name=otrvar cols=80 rows=2></textarea></td></tr>";
		echo "<tr><td colspan=5 align='center'><input type=button value=Guardar onClick='gua_bd(24)'>";
		echo "</tr></table>";
	
	}
	if($esta_lab==26)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>TSH NEONATAL</strong></td></tr>
		</table>";
		
		echo"<br>
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		<tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 	echo "<tr>";
		$cdes=mysql_query("SELECT codi_des,nomb_des FROM DESTIPOS WHERE codi_des='5401'");
		$rowcdes=mysql_fetch_array($cdes);
		$tecnica=$rowcdes[nomb_des];
		echo "<td colspan=2>$tecnica</td></tr>";
	
		echo "<tr><td colspan=2 align='center'><input type=button value=Guardar onClick=gua_bd(26)><td></tr></table>";
	
	}
	if($esta_lab==27)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>Antigeno Prostatico Especifico</strong></td></tr>
		</table>";
		
		echo"<br>
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		<tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "<tr><td ><div align='center'><b></td>";
		echo "<td ><div align='left'><b>Valores</td></tr>";
		echo "<tr><td><div align='left'>Hombres 36-45 Años</td>";
		echo "<td><div align='left'>0.5 - 1.3 ng/ml </td></tr>";
		echo "<tr><td><div align='left'>Hombres 46-55 Años</td>";
		echo "<td><div align='left'>0.6 - 2.1 ng/ml </td></tr>";
		echo "<tr><td><div align='left'>Hombres 56-65 Años</td>";
		echo "<td><div align='left'>0.7 - 3.2 ng/ml </td></tr>";
		echo "<tr><td><div align='left'>Hombres 65-81 Años</td>";
		echo "<td><div align='left'>1.3 - 6.4 ng/ml </td></tr>";
	
		echo "<tr><td colspan=2 align='center'><input type=button value=Guardar onClick=gua_bd(27)><td></tr></table>";
	
	}
	if($esta_lab==28)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>PEPTIDO NATRIURETICO CEREBRAL (BNP)</strong></td></tr>
		</table>";
		
		echo"<br>
		<table width=40% border=1 bordercolor=#BED1DB bgcolor=#FFFFFF align='center'>
		   <tr><td colspan=2 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
	 
		echo "<tr><td ><div align='center'><b></td>";
		echo "<td ><div align='left'><b>Valores Referencia</td></tr>";
		echo "<tr><td><div align='left'>Menos de 50 Años</td><td>450 pg/ml</td></tr>";
		echo "<td><div align='left'>De 50 Años </td><td>900 pg/ml</td></tr>";
		echo "<tr><td><div align='left'>Mayores 75 Años </td><td> 1800 pg/ml</td>";
		echo"</tr>";
	
		echo "<tr><td colspan=2 align='center'><input type=button value=Guardar onClick=gua_bd(28)><td></tr></table>";
	
	}




	
		
		/////////////////////////////////////////
		
	//echo "<input type=text name='esta_lab'>";
		
	
	function calculaedad($fecha_nac)
    {
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
		
		
	echo"<input type=hidden name=evalua>";
	echo"<input type='hidden' name='format'>";
		
?>
	
	 <?
	 
	 
	 //echo"<td class='Estilo11' width='45%'><a href='#' onclick='imprimir($codigo,$gfac_num)'><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align='center'> Imprimir</a></td>";?>
   
	
	
</form>
</body>
</html>

<html><head></head><body></body></html>