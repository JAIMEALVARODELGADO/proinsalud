<? session_register('Gidusulab'); ?>
<html>
<head>
<title></title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<SCRIPT LANGUAGE='JavaScript'>
	
	function buscar()
	{
		if (event.keyCode == 13)
		{
			form1.valida.value=2;
			form1.target='';
			form1.action='buscups2.php';
			form1.submit();
		}	
	}
	
		
	function crear(opc)
	{
		//alert(opc);
		if (event.keyCode == 13)
		{
			if(opc==1)
			{
				if(form1.refer.value=='' || form1.refer.value<=0)	
				{
					alert("Digite la cantidad")
					form1.refer.focus();
					return			
				}	
			}
						
			
			
			j=form1.fin.value;
			ref="form1.codcup"+j+".value=form1.codi_cup.value";
			eval(ref);			
			ref="form1.resul"+j+".value=form1.resul.value";
			eval(ref);
			ref="form1.obser"+j+".value=form1.obser.value";
			eval(ref);
			ref="form1.refer"+j+".value=form1.refer.value";
			eval(ref);


			ref="form1.selec"+j+".value=1";
			eval(ref);
			form1.fin.value=(form1.fin.value/1)+1/1
			
			form1.target='';
			form1.action='gen_rips_hospi.php';
			form1.submit();				
		}	
	}
	function verfin(p,q)
	{
		q.value=p.value;
	}
	
		
	function envio(ord,p,q)
	{		
	   	if(event.keyCode==13)
		{
			j=form1.mcu.value;
			k=form1.it.value;
					
			ref="form1.cod"+k+j+".value=form1.cod_cup.value";
			form1.mcu.value=(form1.mcu.value/1)+1/1;
			eval(ref);
			form1.cod_cup.value='';
			q.focus();
			
			form1.target='';
			form1.submit();
		}
	}
	
	function opcion()
	{
		
			form1.action='modi_labs.php';
			form1.submit();			
		
	
	}
	
	function guarda()
	{
			k=form1.it.value;
			con=form1.mcu.value;
			
			val=0;
			for(i=1;i<con;i++)
			{
				ref="form1.selec"+k+i+".checked"
				if(eval(ref)==true)
				{
					val=1;
				}

				ref="form1.obs"+k+i+".value"
				obs=eval(ref);
				if(obs=='' || obs<=0)	
				{
					alert("Digite la Observaci�n/Resultados")
					return			
				}
			
			}
			if(val==0)
			{
				alert("No existen procedimientos seleccionados");
			}
			else
			{
				form1.action='guarexa2_.php';
				form1.format.value=21;
				form1.submit();
			}
	}
	
	function gua_bd(oco)
	{
		form1.evalua.value=21;
		form1.format.value=oco;
		form1.action='guarda_formato.php';
		form1.submit();		
	
	}
	
	function evaluar()
	{
		if(form1.control.value==2)
		{
			form1.esta_lab.disabled=false;
			form1.botci.disabled=true;
		}
		else
		{
			form1.esta_lab.disabled=true;
			form1.botci.disabled=false;
		}
	}
	function valexm_()
	{
		form1.action='vldexam2_.php';
		form1.target='frm12';
		form1.submit();

					
	}
	function imprimir()
	{
		form1.action='imprimir_.php';
		form1.target='fr011';
		form1.submit();
	
	}
	
	function regresar2()
	{
		form1.action='list_trab.php';
		form1.hospit.value=1;
		form1.submit();
		
	}
	
</script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 
<!-- librer�a principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<!-- librer�a para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<!--<div id="header3">-->


  <table class="Tbl0">
   <tr><td class="Td1" align='center'><STRONG>INFORMACION DEL USUARIO</strong></td></tr>
 </table>

<body onload='evaluar()'>
<form name="form1" method="POST" >
<?
	
	include('php/funciones.php');
	//include('php/conexion.php');
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);
	
	
	echo "<input type=hidden name=num_ord value='$num_ord'>";
	echo "<input type=hidden name=obs_labs value='$obs_labs'>";
	echo "<input type=hidden name=iden_var value='$iden_var'>";
	echo "<input type=hidden name=cont_var value='$cont_var'>";
	
		$nomvar='codusu'.$it;
		$codusu=$$nomvar;	
		echo"<input type=hidden name='$nomvar' value='$codusu'>";
		
		$nomvar='iden_labs'.$it;
		$iden_labs=$$nomvar;
		echo"<input type=hidden name='$nomvar' value='$iden_labs'>";
		
		
		$nomvar='num_ord'.$it;
		$num_ord=$$nomvar;
		echo"<input type=hidden name='$nomvar' value='$num_ord'>";
	
	if(empty($fin))$fin=0;
	
	echo "<table class='Tbl0'>";
	echo "<tr><th class='Th0' width='15%'><strong>IDENTIFICACION</th>
		      <td class='Th0' width='50%'><strong>NOMBRE</td>
			  <td class='Th0' width='10%'><strong>EDAD</td>
			  <td class='Th0' width='10%'><strong>SEXO</td>
			  <td class='Th0' width='15%'><strong>CONTRATO</td></tr>";
	
	$conusu = mysql_query("SELECT NROD_USU,CODI_CON,CODI_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU,
					   TPAF_USU,CONT_UCO,NEPS_CON,IDEN_UCO,CUSU_UCO FROM usuario, ucontrato,contrato WHERE CODI_USU=CUSU_UCO AND CONT_UCO=CODI_CON 
					   AND CUSU_UCO ='$codusu'"); 
	
	$rowu = mysql_fetch_array($conusu);
	echo "<input type=hidden name=codig_usu value=$codusu>";
	$giden_uco=$rowu['IDEN_UCO'];
	echo "<tr><td class='Td4'>$rowu[NROD_USU]</td>";
	$nombre= $rowu[PNOM_USU]." ".$rowu[SNOM_USU]." ".$rowu[PAPE_USU]." ".$rowu[SAPE_USU];
	echo"<td class='Td4'>$nombre</td>";
	$edad=calculaedad($rowu['FNAC_USU']);
	echo"<td class='Td4'>$edad</td>
	   <td class='Td4'>$rowu[SEXO_USU]</td>
	   <td class='Td4'>$rowu[NEPS_CON]</td></tr>";	
		$contra=$rowu[CONT_UCO];
		echo "<input type=hidden name='contra' value='$contra'>";
		echo "<input type=hidden name='codarea' value='$codarea'>";
		echo "<input type=hidden name='idein' value='$idein'>";
		
		echo "<br><tr>
		<td class='Th0'><b>Dx</td>";
		$inf_enca=mysql_query("SELECT el.iden_labs, el.dxo_labs FROM encabezado_labs AS el WHERE el.iden_labs='$iden_labs'");
		$rowdx = mysql_fetch_array($inf_enca);
		$dx_pac=$rowdx[dxo_labs];
		
		$cadcie1=mysql_query("select nom_cie10 from cie_10 where cod_cie10='$dx_pac'");
		$rowdxp = mysql_fetch_array($cadcie1);
		$dxp_pac=$rowdxp[nom_cie10];
		
		echo"<td><font face=arial color=blue size=1>$dxp_pac</font></td>
		<td class='Th0'><b>Antecedentes</td>
		<td colspan=2 align='center'>
		<a href=# onclick=window.open('hist_pac.php?codusu=$codusu','Historico','width=600,height=300,scrollbars=YES')>
		<img src='icons/manito.jpg' width='30' height='20' alt='Historico'></a>
		</td></tr></table><br><br><br>";
		
		echo"<table class='Tbl2' border=1></table>";
		
	
		echo"<br><br> <table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>EXAMENES DE LABORATORIO</strong></td></tr>
		</table>";
		
		///////////////////////////////////XRA INGRESAR CODIGO CUPS///////////////////////////////////////////////////////////////////////////////////////	
	 echo "<br><table class='Tbl0' border=1>";
	 echo "<tr><td class='Th0' width='10%'><strong>SEL</td>
			  <td class='Th0' width='10%'><strong>Codigo</td>
		      <td class='Th0' width='80%'><strong>Estudio</td>
			  <td class='Th0' width='10%'><strong>Resultado</td>
			  <td class='Th0' width='10%'><strong>Unds</td>
			  <td class='Th0' width='10%'><strong>Referencia</td>
			  </tr>";	
	
	echo "<input type=hidden name='it' value='$it'>";
	for($m=1; $m<$mcu; $m++)
	{
		
	
		echo $codig;
		echo"<tr>";
		$nomvar='selec'.$it.$m;
		$selec=$$nomvar;
		
		if($m>0)
		{
			
			if($selec==1)
			{
					$nomvar='selec'.$it.$m;
					echo"<td align=center><input type=checkbox name='$nomvar' value=1 checked></td>";		
			}
			else
			{
					$nomvar='selec'.$it.$m;
					echo"<td align=center><input type=checkbox name='$nomvar' value=1></td>";		
			}
		}
		
		$nomvar='cod'.$it.$m;
		$cod=$$nomvar;	
		echo"<td width='15%'>$cod<input type=hidden name='$nomvar' value='$cod'></td>";
		
		$nomvar='iden_dlab'.$it.$m;
		$iden_dlab=$$nomvar;
		echo "<input type=hidden name='$nomvar' value='$iden_dlab'>";	
		
		
		
		if(empty($unlabcup))
		{
			$cadmed=mysql_query("select descrip,refe_cup,unlab_med  from cups where codigo='$cod'");
			while($rowmed=mysql_fetch_array($cadmed))
			{
					//$refercup=$rowmed[refe_cup];
					//echo 'toy'.$refercup;
					$unlabcup=$rowmed['unlab_med'];
			}
			
		}
	
		if(empty($refercup))
		{
			$cadmed=mysql_query("select descrip,refe_cup,unlab_med  from cups where codigo='$cod' ");
			while($rowmed=mysql_fetch_array($cadmed))
			{
					$refercup=$rowmed[refe_cup];
					//echo 'toy'.$refercup;
					//unlabcup$unlabcup=$rowmed['unlab_med'];
			}	
		}
		
		
		$cadmed=mysql_query("select descrip,refe_cup,unlab_med  from cups where codigo='$cod'");
		while($rowmed=mysql_fetch_array($cadmed))
		{
					$nombrecup=substr($rowmed['descrip'],0,40);
		}
		
		echo"<td width='15%'>$nombrecup<input type=hidden size=50 name='nombrecup' value='$nombrecup'></td>";
		
		$nomvar='obs'.$it.$m;
		$obsv=$$nomvar;
		//echo 'toy'.$obs;
		echo"<td width='15%'><input type=text name='$nomvar'  size='12' value='$obsv'></td>";
		
		$nomvar='uni'.$it.$m;
		$unlabcup=$$nomvar;
		echo"<td width='15%'><input type=text name='$nomvar' size='12' value='$unlabcup'></td>";
		
		$nomvar='ref'.$it.$m;
		$refercup=$$nomvar;
		echo"<td width='15%'><input type=text name='$nomvar' size='12' value='$refercup'></td>";
	
	}//fin for
	
	$nomvar='selec'.$it.$mcu;
	echo"<input type=hidden name='$nomvar' value='1'>";	
	
	echo"<input type=hidden name='mcu' value='$mcu'>";
	
	$nomvar='cod'.$it.$mcu;
	echo"<input type=hidden name='$nomvar'>";
	echo"<tr><td></td>";
	
	
	echo "<td><input type=text name=cod_cup  size='8'  onkeyDown='envio(1,this,codcp1)'  value='$cod_cup'>";
	$cad21=mysql_query("SELECT * FROM `cups` WHERE codigo='$cod_cup'");
	while($rowcie21=mysql_fetch_array($cad21))
	{
					$codcp1=$rowcie21['descrip'];
	}
	
	
	
	if($mcu>0)	
	{
	
		echo"<td align='left'><strong><input type=text name=codcp1 size='20' value='$codcp1' onkeyDown='buscar()'></td>";
		echo"<td width='15%'><strong><input type=text name=resul size='12'></td>";
		echo"<td width='15%'><strong><input type=text name=obser size='12'></td>";
		echo"<td width='15%'><strong><input type=text name=refer size='12'></td>";
		echo"</td></tr> ";
	}
	else
	{
	
		echo"<input type=hidden name=codcp1 value='$codcp1'> ";
	}
	echo "<tr><td colspan=6 align='right'><input type=button name=botci value=Guardar onClick='guarda()'><td></tr></table>";

	
?>
<?
///////////////////////////////////////////////////-///////////////////////////////////////////////////////////////////

	echo"<table class='Tbl0'>
    <tr><td class='Td1' align='center'><STRONG>FORMATOS DE PROCEDIMIENTOS DE LABORATORIO</strong></td></tr>
    </table>";
     
	//if(!empty($esta_lab))$esta_lab=0;
	echo"<br><table align=center><tr><td><b>FORMATO:</td>
	<td  width=80% align=center>";
	echo"<select name='esta_lab' onchange='opcion()' disabled>";
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
		
	echo  "</select></td></td></tr></table>";
				
	?><script language='javascript'>form1.esta_lab.value="<?echo $esta_lab?>";</script><?
	
	//echo $esta_lab;
	if($esta_lab==1)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>UROANALISIS</strong></td></tr>
		</table>";

	
		echo"<br><br><table width=50% height=20 border=1 align=center cellspacing=1 bordercolor=#BED1DB bgcolor=#FFFFFF>
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
			  
		echo"<td>Leucocitos:<input type=text name=leuc_cpr size=8></td>";
		echo"<td>Hematies:<input type=text name=hema_cpr size=8></td></tr>";		  
			
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
			  <td><div align=left>Micelios:
			  <select name=mic_cps >
			  <option> </option>
              <option>+</option>
	          <option>-</option>
              <option>Abundante</option>
              <option>Escaso</option>
              <option>Moderado</option>
              </select></td>
			  
			<td><div align=left>Grasas Neutras :
			  <select name=gra_cps>
              <option>-</option>
              <option>+</option>
              <option>++</option>
              <option>+++</option>
              <option>++++</option>
              </select></td></tr>
			  <tr>
			  <td>Flora Bacteriana:
			  <select name='flo_cps' >
              <option>-</option>
              <option>Aumentada</option>
              <option>Disminuida</option>
              <option>Lig/ Aumentada</option>
              <option>normal</option>
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
			<td><input  type='checkbox' name='bh_cps'  value='Blastocystis Hominis'>Blastocystis Hominis:<input name=bla_cps type=text  size=5></div></td>
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
		
		echo"
             <td><div align=left>Leucocitos:</td>
		     <td><input type=text name=leu_ch value='$leu_ch' size='7' maxlength='12'>/mm�</div></td>
             <td><div align=left>Plaquetas:</td>
             <td><input type=text name=pla_ch value='$pla_ch' size='7' maxlength='12'>/mm�</div></td></tr>";
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
				   <textarea name=obs_ch value='$obs_ch' cols=100 rows=3></textarea>
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
			         <td><textarea name=datos cols=120 rows=8></textarea></td>			        
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
                <option>+</option>
                <option>-</option>
              </select>
	          <input type=text name=trim_epm value='$trim_epm' size=5></td>
	        <td colspan=2>KOH 
            <select name=koh>
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
        <td><strong><div align=left>Diluci�n</div></td>
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
	  	 <tr><td colspan=7  bgcolor=#BED1DB colspan=3><strong>CARACTERISTICAS GENERALES</td></tr>";
		echo"<tr>
         <td colspan=7 bgcolor=#FFFFFF class=Estilo32>C&oacute;digo Del Examen:
          <input name=codl_examen type=text value='$codl_examen' size=7 maxlength=10>
         </td>
       </tr>";
     
	 
	echo"
       <tr bgcolor=#FFFFFF>
         <td colspan=2><div align=left><strong>Clse Liq: 
		 <input  type=text name=cli_lqd value='$cli_lqd' size=5></strong></div></td>
         <td ><div align=left><strong>Color:
		 <input type=text  name=col_lqd value='$col_lqd' size=5></strong></div></td>
         <td ><div align=left><strong>Ph:
		 <input  type=text name=ph_lqd value='$ph_lqd' size=5></strong></div></td>
         <td ><div align=left><strong>Aspectos: 
		 <input  type=text name=asp_lqd value='$asp_lqd' size=5></strong></div></td>
         <td  colspan=2><div align=left><strong>Densidad: 
		 <input type=text name=den_lqd  value='$den_lqd' size=5></strong></div></td>
       </tr>";
   	
    echo" 
       <tr>
         <td bgcolor=#BED1DB colspan=2 align=center><strong>Coagulo</strong></td>
         <td bgcolor=#BED1DB colspan=3 align=center><strong>Celulas</strong></td>
         <td bgcolor=#BED1DB colspan=2 align=center><strong>Hematies</strong></td>
       </tr>
       <tr>
         <td>Presente</td>
         <td>Ausente</td>
         <td colspan=3>&nbsp;</td>
         <td >Normales</td>
         <td >Crenados</td>
       </tr>
       <tr>
         <td>
           <input type=text name=pre_lqd value='$pre_lqd'  size='5'>
         </td>
         <td>
           <input type=text name=aus_lqd value='$aus_lqd'   size=5>
         </td>
         <td>
           <input type=text name=ce1_lqd value='$ce1_lqd' size=3>
         <span class=style1>/mm&sup3;</span></td>
         
		 <td colspan=2 align=center>
           <input type=text  name=ce2_lqd value='$ce2_lqd' size=3>
		
		 <span class=style1>/mm&sup3;</span></td>
         <td><span class=style2>
           
          <input type=text  name=hnor_lqd value='$hnor_lqd' size=5>
          
		</span></td>
         <td>
           <input type=text name=hcre_lqd  value='$hcre_lqd' size=5>
        </td>
       </tr>";
     
     echo"
       <tr>
         <td bgcolor=#BED1DB colspan=2 align=center><b>Pandy</td>
         <td bgcolor=#BED1DB colspan=2 align=center><b>Rivalta</td>
         <td bgcolor=#BED1DB colspan=3 align=center><b>Roper's ( Coagulo De Mucina) </strong></td>
       </tr>
       <tr>
         <td align=left>Positivo<input type=text name=pop_lqd   value='$pop_lqd' size='5'></td>
		 <td align=left>Negativo<input type=text name=pne_lqd   value='$pne_lqd' size=5></td>
         <td align=left>Positivo<input type=text name=rpos_lqd   value='$rpos_lqd' size=5></td>
         <td align=left>Negativo<input type=text name=rneg_lqd   value='$rneg_lqd' size=5></td>
         <td align=left>Bueno<input type=text name=rbu_lqd   value='$rbu_lqd' size=5></td>
		 <td align=left>Regular<input type=text name=rreg_lqd  value='$rreg_lqd' size=5></td>
         <td align=left>Malo <input type=text name=rmal_lqd  value='$rmal_lqd' size=5></td>
         </tr>
		 
		 <tr>
		 <td bgcolor=#BED1DB colspan=7 align=center><b>Viscosidad</td></tr>
		 <tr>
		 <td align=left>Normal <input  type=text name=vno_lqd  value='$vno_lqd' size=8></td>
         <td align=left>Aumentada <input  type=text name=vaum_lqd value='$vaum_lqd' size=8></td>
         <td colspan=5 align=left>Disminuida <input  type=text name=vdis_lqd value='$vdis_lqd' size=8></td></tr>";
	 
	  echo"
       <tr>
         <td colspan=2 align=left>Glucosa<input  type=text name=glu_lqd value='$glu_lqd' size=5></td>
         <td colspan=3 align=left>Proteinas<input type=text  name=pro_lqd value='$pro_lqd' size='5'>
		 <input type=text  name=prote_lqd value='$prote_lqd' size=5></td>
         <td colspan=2 align=left>Proteirraquia<input  type=text name=ldn_lqd value='$ldn_lqd' size=5></td>
         <tr><td bgcolor=#BED1DB colspan=7 align=center><b>LDH</td></tr>
         <td colspan=2  align=left>Acido Urico <input type=text  name=auri_lqd value='$auri_lqd' size=5></td>
         <td colspan=3  align=left>Amilasas<input type=text  name=amil_lqd value='$amil_lqd' size=5></td>
         <td colspan=2  align=left>Gram <input type=text  name=gram_lqd  value='$gram_lqd' size=5></td>
        </tr>";
	  
      echo"
       <tr>
         <td bgcolor=#BED1DB colspan=3 align=center><b>Wright</td>
         <td bgcolor=#BED1DB colspan=2 align=center><b>KOH</td>
         <td bgcolor=#BED1DB colspan=2 align=center><b>Tinta China </td>
       </tr>
       <tr>
         <td align=center>Neutrofilos</td>
         <td align=center>Linfoncitos</td>
         <td align=center>Celulas no diferenc </td>
         <td align=center>Positivo</td>
         <td align=center>Negativo</td>
         <td align=center>Positivo</td>
         <td align=center>Negativo</td>
       </tr>
       <tr>
         <td align=center><input type=text name=neut_lqd  value='$neut_lqd' size=5></td>
         <td align=center><input type=text name=linfo_lqd value='$linfo_lqd' size=5></td>
         <td align=center><input type=text name=celno_lqd  value='$celno_lqd' size=5></td>
         <td align=center><input type=text name=kposi_lqd  value='$kposi_lqd' size=5></td>
         <td align=center><input type=text name=kneg_lqd   value='$kneg_lqd' size=5></td>
         <td align=center><input type=text name=tpos_lqd  value='$tpos_lqd' size=5></td>
         <td align=center><input type=text name=tneg_lqd  value='$tneg_lqd' size=5></td>
       </tr>";
  

	 echo" 
       <tr>
         <td bgcolor=#BED1DB colspan=7 align=center><b>BK</td>
       </tr>

       <tr>
         <td colspan=4 class=Estilo30>No se observan b.a.a.r en 100 campos observados 
           
           <input name=nbbar_lqd type=checkbox  value='No se observan b.a.a.r en 100 campos Observados'>
         </td>
         <td colspan=3 class=Estilo30>Positivo para b.a.a.r 
          
           <input name=pbbar_lqd type=checkbox  value='Positivo para b.a.a.r'>
         </td>
       </tr>";
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
			<td>Triponima I :</td>
			<td colspan=2>
			  <select name=trim_tpn >
				<option>-</option>
				<option>Positivo</option>
				<option>Negativo</option>
			  </select>Sensibilidad 1 ng / ml
			</td>
		  </tr>
		  <tr><td colspan=3 ><b>Nota</td></tr>
          <tr><td colspan='3' >Tecnica Prueba Rapida de Inmunocromotografia</td></tr>";
		echo "<tr><td colspan=4><input type=button value=Guardar onClick=gua_bd(11)><td></tr></table>";
	}
	//////////////////////////////////OTROS FORMATOS
	if($esta_lab==12)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>HORMONA FOL�CULO ESTIMULANTE - FSH</strong></td></tr>
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
	
	
	if($esta_lab==13)
	{
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
	if($esta_lab==14)
	{
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
	
	if($esta_lab==15)
	{
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
		   <tr><td>1 A�o </td><td>0.12 - 0.21 </td></tr>
		   <tr><td>1 - 6 A�os</td><td>0.03 - 0.32</td></tr>
		   <tr><td>7 - 12 A�os</td><td>0.03 - 0.68</td></tr>
		   <tr><td>13 - 17 A�os</td><td>0.28 - 11.1</td></tr>";
		
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
	
	if($esta_lab==16)
	{
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
	if($esta_lab==17)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>ANT�GENOS IgE</strong></td></tr>
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
		   <tr><td>1 A�o </td><td>Hasta 15</td></tr>
		   <tr><td>1 - 5 A�os</td><td>Hasta 60</td></tr>
		   <tr><td>6 - 9 A�os</td><td>Hasta 90</td></tr>
		   <tr><td>10 - 15 A�os</td><td>Hasta 200</td></tr>
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
		<tr><td class='Td1' align='center'><STRONG>HORMONA GLICOSILADA</strong></td></tr>
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
		echo "<tr><td><div align='left'>Precisa Actuaci�n</td>";
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
		echo "<td>Reacci�n Leucocitaria</td>";
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
		echo "<td>Reacci�n Leucocitaria</td>";
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
		<tr><td colspan=9 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";		
	
	
		
		echo "<tr><td colspan=7><b>Globulos Blancos</td></tr>";
		echo"<tr><td colspan=2>En n�mero</td>";
		echo"<td><select name=gbl_esp>";
		echo "<option value='0'> </option>";
		echo "<option value='Aumentados'>Aumentados</option>";
		echo "<option value='Normales'>Normales</option>";
		echo "<option value='Disminuidos'>Disminuidos</option>";
		echo "</select></td>";
		echo "<td colspan=2>y en morfologia <input type=text name=nume_esp size=20 value='$nume_esp'></td>";
		echo"</tr>";
		
		echo"<tr><td colspan=7><b>Globulos Rojos</td></tr>";
		echo"<tr><td colspan=7>Normacitos Nomocromaticos";
		echo"<input type=checkbox name='chk_' value='1' onclick='prueba(this.checked)' ></td><tr>";
		echo"<tr><td >Hipocromia:</td>";
		echo"<td colspan=6><select name=hip_esp>";
		echo "<option value='0'> </option>";
		echo "<option value='Ligera'>Ligera</option>";
		echo "<option value='Moderada'>Moderada</option>";
		echo "<option value='Marcada'>Marcada</option>";
		echo "</select></td></tr>";
		echo"<tr><td>Anisocitosis:</td>";
		echo"<td colspan=6><select name=ani_esp>";
		echo "<option value='0'> </option>";
		echo "<option value='Ligera'>Ligera</option>";
		echo "<option value='Moderada'>Moderada</option>";
		echo "<option value='Marcada'>Marcada</option>";
		echo "</select></td></tr>";
		echo "<tr><td colspan=2></td><td colspan=2>Con Macrocitos:";
		echo"<select name=mcr_esp>";
		echo "<option value=''> </option>";
		echo "<option value='-'>-</option>";
		echo "<option value='+'>+</option>";
		echo "<option value='++'>++</option>";
		echo "<option value='+++'>+++</option>";
		echo "</select></td>";
		echo "<td colspan=2>Con Microcitos:";
		echo"<select name=mic_esp>";
		echo "<option value=''> </option>";
		echo "<option value='-'>-</option>";
		echo "<option value='+'>+</option>";
		echo "<option value='++'>++</option>";
		echo "<option value='+++'>+++</option>";
		echo "</select></td></tr>";
		
		echo"<tr><td>Poiquilocitosis:</td>";
		echo"<td colspan=6><select name=pqu_esp>";
		echo "<option value='0'> </option>";
		echo "<option value='Ligera'>Ligera</option>";
		echo "<option value='Moderada'>Moderada</option>";
		echo "<option value='Marcada'>Marcada</option>";
		echo "</select></td></tr>";
		echo "<tr><td colspan=2>Con Dianocitos:";
		echo"  <select name=dic_esp>";
		echo "<option value=''> </option>";
		echo "<option value='-'>-</option>";
		echo "<option value='+'>+</option>";
		echo "<option value='++'>++</option>";
		echo "<option value='+++'>+++</option>";
		echo "</select></td>";
		echo "<td colspan=2>Con Esquistocitos:";
		echo"<select name=esq_esp>";
		echo "<option value=''> </option>";
		echo "<option value='-'>-</option>";
		echo "<option value='+'>+</option>";
		echo "<option value='++'>++</option>";
		echo "<option value='+++'>+++</option>";
		echo "</select></td>";
		echo "<td colspan=2>Con :<input type=text name=otr_mcn size=7 value='$otr_mcn' maxlength='10'>";
		echo " <select name=org_esp>";
		echo "<option value=''> </option>";
		echo "<option value='-'>-</option>";
		echo "<option value='+'>+</option>";
		echo "<option value='++'>++</option>";
		echo "<option value='+++'>+++</option>";
		echo "</select></td></tr>";
		echo"<tr><td >Polimadrotofilica:</td>";
		echo"<td colspan=6><select name=poli_esp>";
		echo "<option value='0'> </option>";
		echo "<option value='Ligera'>Ligera</option>";
		echo "<option value='Moderada'>Moderada</option>";
		echo "<option value='Marcada'>Marcada</option>";
		echo "</select></td></tr>";
		echo"<tr><td>Observaciones</td>";
		echo "<td colspan=6><textarea name=obsv_esp  value='$obsv_esp' cols=60 rows=2></textarea></td>";
		echo "<tr><td colspan=6 align='center'><input type=button value=Guardar onClick='gua_bd(20)'><td></tr></table>";
		echo"<br>";
	
	}
	if($esta_lab==22)
	{
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>EXAMEN DIRECTO PARA HONGOS - KOH</strong></td></tr>
		</table>";
		echo"<br>
		<table class='Tbl0' border=1>
		<tr><td colspan=5 align='center' bgcolor=#BED1DB border=1><strong>CARACTERISTICAS GENERALES<td></tr>";	
		echo"<tr>";
		echo "<td colspan=2><b>Tipo de Muestra</td>";
		echo "<td colspan=3><input type=text name='tp_mues' value='$tp_mues' size=30></td></tr>";
		echo "<tr><td colspan=3>Positivo Para Estructuras Micoticas</td>";
		echo "<td colspan=2><input type=radio name='chk_' value='1'></td></tr>";
		echo "<tr><td colspan=3>Negativo Para Estructuras Micoticas</td>";
		echo "<td colspan=2><input type=radio name='chk_' value='2'></td></tr>";
		echo "<tr><td colspan=5 align='center'><input type=button value=Guardar onClick='gua_bd(22)'>";
		echo "</tr></table>";
	
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
		
		echo "<tr><td colspan=2>No.1 <input type=checkbox name='chk1_alc' value='1'></td>";
		echo "<td><input type=radio name='chk_1' value='N'> No se Observan BAAR en 100 campos Observados</td>";
		echo "<td colspan=2><input type=text name='tpm_neg1' value='$tpm_neg1' size=5></td>";
		echo"</tr>";
		echo "<tr><td colspan=2></td>";
		echo "<td><input type=radio name='chk_1' value='P'>Positivo Para BAAR en 100 campos Observados</td>";
		echo"</tr>";
		
		
		echo "<tr><td colspan=2>No.2 <input type=checkbox name='chk2_alc' value='2'></td>";
		echo "<td><input type=radio name='chk_2' value='N'>No se Observan BAAR en 100 campos Observados</td>";
		echo "<td colspan=2><input type=text name='tpm_neg2' value='$tpm_neg2' size=5></td>";
		echo"</tr>";
		echo "<tr><td colspan=2></td>";
		echo "<td ><input type=radio name='chk_2' value='P'>Positivo Para BAAR en 100 campos Observados</td>";
		echo"</tr>";
		
		
		echo "<tr><td colspan=2>No.3 <input type=checkbox name='chk3_alc' value='3'></td>";
		echo "<td><input type=radio name='chk_3' value='N'>No se Observan BAAR en 100 campos Observados</td>";
		echo "<td colspan=2><input type=text name='tpm_neg3' value='$tpm_neg3' size=5></td>";
		echo"</tr>";
		
		echo "<tr><td colspan=2></td>";
		echo "<td><input type=radio name='chk_3' value='P'>Positivo Para BAAR en 100 campos Observados</td>";
		echo "</tr>";
		echo "<tr><td colspan=5 align='center'><input type=button value=Guardar onClick='gua_bd(23)'>";
		echo "</tr></table>";
	
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
		echo "<td colspan=4 align='left'><input type=text name=otrvar size=20 maxlength=30></td></tr>";
		echo "<tr><td colspan=5 align='center'><input type=button value=Guardar onClick='gua_bd(24)'>";
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
		echo "<td ><input type=text name='tp_mues' value='$tp_mues' size=30></td>";
		echo "<td colspan=2><b>Aspecto</td>";
		echo "<td><input type=text name='tp_mues' value='$tp_mues' size=30></td></tr>";
		echo "<tr><td colspan=6><b>PARASITOLOGICO</td></tr>";
		
		echo "<tr><td><input type=checkbox name='chk_' value='1'></td>";
		echo "<td colspan=3>Quistes de entamocuba histolytica</td>";
		echo "<td align='center'><input type=checkbox name='chk_' value='1'></td>";
		echo "<td colspan=3>Trofozoitos de amebas</td></tr>";
		
		echo "<tr><td><input type=checkbox name='chk_' value='1'></td>";
		echo "<td colspan=3>Quistes de entomoeba Coli</td>";
		echo "<td align='center'><input type=checkbox name='chk_' value='1'></td>";
		echo "<td colspan=3>Quisites de giardia intestinal</td></tr>";
		
		echo "<tr><td><input type=checkbox name='chk_' value='1'></td>";
		echo "<td colspan=3>Quistes de endolimax nana</td>";
		echo "<td align='center'><input type=checkbox name='chk_' value='1'></td>";
		echo "<td colspan=3>Trofozoitos de giardia intestinalis</td></tr>";
		
		echo "<tr><td><input type=checkbox name='chk_' value='1'></td>";
		echo "<td colspan=3 >Quistes de Blastocystis Hominis</td>";
		echo "<td align='center'><input type=checkbox name='chk_' value='1'></td>";
		echo "<td colspan=3 >Otros </td></tr>";
		
		echo "<tr><td></td>";
		echo "<td colspan=3 ><input type=checkbox name='chk_' value='1'>1-5xC</td></tr>";
		echo "<tr><td align='center'></td>";
		echo "<td colspan=3 ><input type=checkbox name='chk_' value='1'>6-10xC</td></tr>";
		echo "<tr><td align='center'></td>";
		echo "<td colspan=3 ><input type=checkbox name='chk_' value='1'>>10xC</td></tr>";
		echo "<tr><td align='center'><input type=checkbox name='chk_' value='1'></td>";
		echo "<td colspan=6>No se observan parasitos intestinales en la muestra analizada</td></tr>";
		echo"<tr><td></td>";
		echo "<td colspan=6><b>Observaciones<br><textarea name=obs_mcn  value='$obs_mcn' cols=40 rows=2></textarea></td></tr>";
		echo "<tr><td colspan=6 align='center'><input type=button value=Guardar onClick='gua_bd()'></td></tr></table>";
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
		echo "<td >MUESTRA DE CORDON UMBILICAL<br>
			TECNICA: MICROELISA <br>
			LOTE DE REACTIVO: WV704/A <br>
			FECHA DE VENCIMIENTO: 18-01-2012</td></tr>";
	
		echo "<tr><td colspan=2 align='center'><input type=button value=Guardar onClick=gua_bd(25)><td></tr></table>";
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	 echo"<input type=hidden name=evalua>";
	 echo "<input type=hidden name=control value=$control>";
	 echo"<input type=hidden name=iden_labs value=$iden_labs>";
	echo "<input type=hidden name=cod value='$codusu'>";
	echo "<input type=hidden name=nord_lab value='$num_ord'>";
	 echo"<input type=hidden name=hospit value=1>";
	?>

<br><br>
<table class='Tbl2'>
    <tr>
       <td class='Td1' width='45%'><a href='#' onclick='imprimir()'><img  width=20 height=20 src='icons\imp02.png' alt='Imprimir' border=0 align='center'>Imprimir</a></td>
	   <td class='Td1' width='45%'><a href='#' onclick='valexm_()'><img  width=30 height=30 src='icons\firm1.png' alt='Validar' border=0 align='center'>Valida</a></td>
		</tr>
	   <tr><td class='Td1' colspan='2'> 
	   <?
		include('php/conexion2.php');
		$conusu=mysql_query("SELECT nomb_usua,ide_usua,tip_usuario FROM cut WHERE ide_usua='$Gidusulab'");
		$rowusu=mysql_fetch_array($conusu);
		$nombreusu=$rowusu[nomb_usua];
		$ide_usua=$rowusu[ide_usua];
		echo 'BACTERIOLOG@ <font face=arial color=red>'.$Gidusulab.' - '.$nombreusu ;
		echo "<input type=hidden name=idenus value='$ide_usua'>";
	
		?></td>
	   
    </tr>
</table>
 <input type='hidden' name='cont' value='<?echo $cont;?>'> 
 <input type='hidden' name='format'>
  <input type='hidden' name='valida'>


</form>
</body>
</html>
