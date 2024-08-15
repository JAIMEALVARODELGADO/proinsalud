<html>
<head>
<title></title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
	<script type="text/javascript">
	//alert('toy');
	$().ready(function() {	
		$("#course").autocomplete("bus_cie10.php", {
		width: 440,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
		});	
		$("#course").result(function(event, data, formatted) {
		$("#course_val").val(data['1']);
		});
	});
	
    $().ready(function() {	
		$("#course_").autocomplete("bus_cups2.php", {
		width: 640,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
		});	
		$("#course_").result(function(event, data, formatted) {
		$("#course_val_").val(data['1']);
		});
	});
	$().ready(function() {	
		$("#course_3").autocomplete("bus_medicos.php", {
		width: 640,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
		});	
		$("#course_3").result(function(event, data, formatted) {
		$("#course_val3").val(data['1']);
		});
	});
	</script>

<SCRIPT LANGUAGE='JavaScript'>

	function buscar()
	{
		//alert('toy');
		if (event.keyCode == 13)
		{
			form1.target='';
			form1.action='buscacup.php';
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
			//form1.producto1.value='';
			//form1.producto.value='';
			//form1.cantimed.value='';
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
			l=form1.jt.value;
			
			ref="form1.cod"+k+l+j+".value=form1.cod_cup.value";
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
		form1.action='gen_rips_hospi.php';
		form1.submit();			
	}
	
	
	function comprueba()
	{
		form1.action='gen_rips_hospi.php';
		form1.submit();			
	
	}
	
	function guarda()
	{
			con=form1.mcu.value;
			k=form1.it.value;
			l=form1.jt.value;
			
			if(form1.fent.value=='')	
			{
				alert("Seleccione Fecha del Procedimiento")
				form1.fent.focus();
				return	
			}
			if(form1.mine.value=='')	
			{
				alert("Seleccione Hora del Procedimiento")
				form1.mine.focus();
				return	
			}
			
			if(form1.fin_con.value=='')	
			{
				alert("Seleccione Finalidad del Procedimiento")
				form1.fin_con.focus();
				return	
			}
			if(form1.condu.value=='')	
			{
				alert("Seleccione Condición del Usuario")
				form1.condu.focus();
				return	
			}
			if(form1.progu.value=='')	
			{
				alert("Seleccione Programa")
				form1.progu.focus();
				return	
			}
			if(form1.med_soli.value=='')	
			{
				alert("Seleccione Médico Solicitante")
				form1.progu.focus();
				return	
			}
			
			if(form1.cod_cie.value=='')	
			{
				alert("Seleccione Dx de solicitud")
				form1.cod_cie.focus();
				return	
			}
			
			if(form1.num_ord.value=='')	
			{
				alert("Ingrese Número de Orden")
				form1.num_ord.focus();
				return	
			}
			
			if(form1.band.value==1)
			{
				alert("Ingrese Número de Orden que no exista")
				return	
			}
			
			val=0;
			for(i=1;i<con;i++)
			{
				ref="form1.selec"+k+l+i+".checked"
				if(eval(ref)==true)
				{
					val=1;
				}

							
			}
			if(val==0)
			{
				alert("No existen procedimientos seleccionados");
			}
			else
			{
			
				form1.action='guar_rips.php';
				form1.format.value=1;
				form1.submit();
			}
	}
	
	function gua_bd(oco)
	{
		form1.evalua.value=1;
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
	function regresar()
	{
		alert("El número de Factura no puede ser Vacio o"+"\n"+" Ya esta en la base de datos");
		form1.action='list_trab.php'
		
					
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
<!-- librería principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<!-- librería para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<!--<div id="header3">-->


  <table class="Tbl0">
   <tr><td class="Td1" align='center'><STRONG>INFORMACION DEL USUARIO</strong></td></tr>
 </table>


<form name="form1" method="POST" >
<?
	
	include('php/funciones.php');
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);

		
?>

	
 <?
	echo "<input type=hidden name=contrato value=$contrato>";
	echo "<input type=hidden name=obs_labs value='$obs_labs'>";
	echo "<input type=hidden name=iden_var value=$iden_var>";
	echo "<input type=hidden name=iden_labs value=$iden_labs>";
	

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
	echo "<input type=hidden name=codusu value=$codusu>";
	echo "<input type=hidden name=codig_usu value=$codusu>";
	$giden_uco=$rowu['IDEN_UCO'];
    echo "<tr><td class='Td4'>$rowu[NROD_USU]</td>";
	$nombre= $rowu[PNOM_USU]." ".$rowu[SNOM_USU]." ".$rowu[PAPE_USU]." ".$rowu[SAPE_USU];
	echo"<td class='Td4'>$nombre</td>";
	$edad=calculaedad($rowu['FNAC_USU']);
	echo"<td class='Td4'>$edad</td>
	   <td class='Td4'>$rowu[SEXO_USU]</td>
	   <td class='Td4'>$rowu[NEPS_CON]</td></tr></table>";	
		$contrato=$rowu[CONT_UCO];
		echo "<input type=hidden name=contrato value='$contrato'>";
		echo "<input type=hidden name=codarea value='$codarea'>";
		echo "<input type=hidden name=idein value=$idein>";
		echo "<br><br>";
?>
<?
	echo" <table class='Tbl0' >
   <tr><td class='Td1' align='center'><STRONG>INFORMACION DEL RIPS </strong></td></tr>
 </table>";
	

	
	$fecha=time();
	$fec=date ("Y-m-d",$fecha);
	$hor=date ("H:i",$fecha);
	

		
				echo "<br><br>";
		
				echo "<table class='Tbl0' border=1><tr>";?>
					 <td class='Th0'><strong>ENTREGA DE RESULTADOS</td><td>
					<!-- formulario con el campo de texto y el botón para lanzar el calendario--> 
					<?php echo "<input type=text name=fent id=fent size='10' value=$fec>*";?>
					<input type="button" id="lanzador2" value="..." />
					<!-- script que define y configura el calendario--> 
					<script type="text/javascript"> 
						Calendar.setup({ 
						inputField     :    "fent",     // id del campo de texto 
						ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
						button     :    "lanzador2"     // el id del botón que lanzará el calendario 
						}); 
					</script> 
							
			<?echo"<span class=Estilo6>Hora: <input type=text name=mine size=6 value=$hor></td>";?><?	
			
			
			echo"<td class='Th0' width='15%'><strong>FECHA</td>
			  <td  width='17%'>$fec - $hor</td></tr>";
			  
			  
			echo"<tr><td  width='9%' class='Th0' aling='right'><b>AMBITO</td>
			 <input type=hidden name=amb_usu value='2'>";
			echo" <td>HOSPITALARIO</TD>";
			
			echo "<td  width='5%' class='Th0' aling='right'><b>FINALIDAD</td>
			<td  width='35%'><input type=hidden name=fin_con size=2 maxlength=2  onBlur='verfin(this,opc_fin)' value='$fin_con'>";
			echo" <select name=opc_fin onchange='verfin(this,fin_con)'><option value=''></option>";
			$consulta=mysql_query("SELECT codi_des,codt_des,nomb_des,valo_des FROM `destipos` WHERE codt_des='33' order by nomb_des");
			while($rowa=mysql_fetch_array($consulta))
			{
				echo "<option value='$rowa[valo_des]'>$rowa[nomb_des]";
			}
			echo" </select></TD>";		
			?><script language="javaScript">form1.opc_fin.value='<?echo $fin_con;?>';</script><?

			echo"<tr><td  width='9%' class='Th0' aling='right'><b>C.USUARIO</td>
			<td> <input type=hidden name=condu size=2 maxlength=2  onBlur='verfin(this,opc_condu)' value='$condu'>";
			echo" <select name=opc_condu onchange='verfin(this,condu)'><option value=''></option>";
			$consulta=mysql_query("SELECT codi_des,codt_des,nomb_des,valo_des FROM `destipos` WHERE codt_des='34' order by nomb_des");
			while($rowa=mysql_fetch_array($consulta))
			{
				echo "<option value='$rowa[valo_des]'>$rowa[nomb_des]";
			}
			echo" </select></td>";	
			
			?><script language="javaScript">form1.opc_condu.value='<?echo $condu;?>';</script><?
			
			echo "<td  width='5%' class='Th0' aling='right'><b>PROGRAMA</td>
			<td  width='35%'><input type=hidden name=progu size=2 maxlength=2  onBlur='verfin(this,opc_progu)' value='$progu'>";
			echo" <select name=opc_progu onchange='verfin(this,progu)'><option value=''></option>";
			$consulta=mysql_query("SELECT codi_des,codt_des,nomb_des,valo_des FROM `destipos` WHERE codt_des='45' order by nomb_des");
			while($rowa=mysql_fetch_array($consulta))
			{
				echo "<option value='$rowa[valo_des]'>$rowa[nomb_des]";
			}
			echo" </select></td>";		
			?><script language="javaScript">form1.opc_progu.value='<?echo $progu;?>';</script><?
			echo "<tr>";
			echo "<td class='Th0' width='15%'><strong>MEDICO SOLICITANTE:</td>";
			/*echo "<td  width='40%'><input type=text name=med_soli size=10 maxlength=20  onBlur='verfin(this,opc_meds)' value='$med_soli'>";
			echo" <select name=opc_meds onchange='verfin(this,med_soli)'><option value=''></option>";
			$consulta=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi FROM medicos ORDER BY medicos.nom_medi");
			while($rowa=mysql_fetch_array($consulta))
			{
				echo "<option value='$rowa[cod_medi]'>$rowa[nom_medi]";
			}
			?><script language="javaScript">form1.opc_meds.value='<?echo $med_soli;?>';</script><?
			
			echo" </select></td>";*/
			//*********************
			echo "<td  width='40%'><input type=hidden id='course_val3' name=med_soli size=10 maxlength=20  onBlur='verfin(this,opc_meds)' value='$med_soli'>";
			echo "<input type=text id='course_3'  name='opc_meds' size=80 value='$opc_meds'>";
			//*********************





			echo "<td class='Th0'><b>Nº. ORDEN</td><td><input type=text name=num_ord size=10 maxlength=20 onblur='comprueba()' value=$num_ord></td>";
			
			if(!empty($num_ord))
			{
				$conod=mysql_query("select nord_dlab FROM detalle_labs WHERE nord_dlab='$num_ord'");
				if(mysql_num_rows($conod)<>0)
				{
					echo "<tr><td colspan=4 align='center'><font face=arial color=red><b>LA ORDEN YA EXISTE VERIFIQUE</td></tr>";
					echo "<input type=hidden name=band value=1>";
				}
				else
				{
					echo "<tr><td colspan=4 align='center'><font face=arial color=blue><b>PUEDE INGRESAR LA ORDEN</td></tr>";
					echo "<input type=hidden name=band value=0>";
				}
			
			}
			
		$resulcie1="SELECT Max(hist_evo.cod_cie10) AS MáxDecod_cie10, hist_evo.cod_cie10
		FROM hist_evo INNER JOIN ingreso_hospitalario ON hist_evo.id_ing = ingreso_hospitalario.id_ing
		WHERE (((ingreso_hospitalario.codius_ing)='$codusu'))
		GROUP BY hist_evo.cod_cie10";	
		//echo "<br>".$resulcie1;
		$resulcie1=mysql_query($resulcie1);

		$resulcie="SELECT Max(diax_evo.cod_cie10) AS MáxDecod_cie10, diax_evo.cod_cie10
		FROM ingreso_hospitalario INNER JOIN (hist_evo INNER JOIN diax_evo ON hist_evo.iden_evo = diax_evo.iden_evo) ON ingreso_hospitalario.id_ing = hist_evo.id_ing
		WHERE (((ingreso_hospitalario.codius_ing)='$codusu'))
		GROUP BY diax_evo.cod_cie10";
		//echo "<br>".$resulcie;
		$resulcie=mysql_query($resulcie);
		
		$j=0;
		while ($rowcie1=mysql_fetch_array($resulcie1))
		{
		   $cie[$j]=$rowcie1['cod_cie10'];	   
		   $j=$j+1;
		}
		while ($rowcie=mysql_fetch_array($resulcie))
		{
		   $cie[$j]=$rowcie['cod_cie10'];	  
		   $j=$j+1;
		}
		echo"<tr><td class='Th0'><B>DIAGNOSTICO:";
		echo"<td><select name=cod_cie value='$cod_cie'>";
		//<option value=0></option>
		for($r=0;$r<$j;$r++)
		{
		   $cie1=$cie[$r];	   
		   $cadcie1="select nom_cie10 from cie_10 where cod_cie10='$cie1'";
		   $resulcie1=Mysql_query($cadcie1,$link);
		   while ($rowcie1=mysql_fetch_array($resulcie1))
		   {
			   $nomcie1=$rowcie1['nom_cie10'];
		   }
		   if($cie10==$cie1)
		   {
				echo"<option selected value=$cie1>$cie1 $nomcie1</option>";
			}
			else
			{
				echo"<option value=$cie1>$cie1 $nomcie1</option>";
			}
		}
		echo"<select></td>";
			echo"</tr></table>";		
	
		
	
	?><script language="javaScript">form1.cod_cie.value='<?echo $cod_cie;?>';</script><?
	echo"<br><br> <table class='Tbl0'>
	<tr><td class='Td1' align='center'><STRONG>EXAMENES DE LABORATORIO</strong></td></tr>
	</table>";
	
	///////////////////////////////////XRA INGRESAR CODIGO CUPS///////////////////////////////////////////////////////////////////////////////////////	
	 echo "<br><table  width='80%' border=1>";
	echo "<tr><td class='Th0' width='5%'><strong>SEL</td>
			  <td class='Th0' width='5%'><strong>RMTD</td>
			  <td class='Th0' width='5%'><strong>CODIGO</td>
		      <td class='Th0' width='65%'><strong>ESTUDIO / PROCEDIMIENTO</td></tr>";
			
			  
	
	echo "<input type=hidden name=it value=$it>";
	echo "<input type=hidden name=jt value=$jt>";	
	for($m=1; $m<$mcu; $m++)
	{
	
	
		echo"<tr>";
		$nomvar='selec'.$it.$jt.$m;

		$selec=$$nomvar;
		
		if(empty($iden_evo))
		{
			$nomvar='iden_evo'.$it.$jt.$m;
			$iden_evo=$$nomvar;			
		}
		
		
	
		if($selec==1)
		{
				$nomvar='selec'.$it.$jt.$m;
				echo"<td align=center><input type=checkbox name=$nomvar value=1 checked></td>";		
		}
		else
		{
				$nomvar='selec'.$it.$jt.$m;
				echo"<td align=center><input type=checkbox name=$nomvar value=1></td>";		
		}
		
		$nomvar='chk_rem'.$it.$jt.$m;
		$chk_rem=$$nomvar;
		
		if($chk_rem==1)
		{
			echo"<td><input type=checkbox name=$nomvar value=1 checked></td>";
		}
		else
		{
		    echo"<td><input type=checkbox name=$nomvar value=1 ></td>";
		}
		
		
		$nomvar='cod'.$it.$jt.$m;
		$cod=$$nomvar;	
		
		
		echo"<td><input type=text name=$nomvar value=$cod></td>";
		
		//$cadmed="select descrip,refe_cup,unlab_med  from cups where codigo='$cod' AND artic_cup='19' AND esta_cup='AC'";
		$cadmed="select descrip,refe_cup,unlab_med  from cups where codigo='$cod' AND artic_cup='19'";
		//echo "<br>".$cadmed;
		$cadmed=mysql_query($cadmed);
		while($rowmed=mysql_fetch_array($cadmed))
		{
					$nombrecup=$rowmed['descrip'];
		}
		
		echo"<td><input type=text size=70 name=nombrecup value='$nombrecup'></td>";
		
		
	}//fin for
	
	echo "<input type='hidden' name='iden_evo' value='$iden_evo'>";
	
	$nomvar='selec'.$it.$jt.$mcu;
	echo"<input type=hidden name=$nomvar value='1'>";	
	
	$nomvar='cod'.$it.$jt.$mcu;
	echo"<input type=hidden name=$nomvar>";
	
	echo"<input type=hidden name=mcu value=$mcu>";
	
	echo"<tr><td></td>";
	$nomvar='chk_rem'.$it.$jt.$mcu;
	echo"<td><input type=checkbox name=$nomvar value=1></td>";
	
	//echo "<td><input type=text name=cod_cup    size=8 value='$cod_cup' onkeyDown='envio(1,this,codcp1)'>";
	echo "<td><input type=text id='course_val_' name='cod_cup' size=8 value='$cod_cup' onkeyDown='envio(1,this,codcp1)' disabled>";
	//echo "<td><input type=text id='course_val_' name='cod_cup' size=8 onkeyDown='envio(1,this,codcp1)' value='$cod_cup' disabled>";
	$cad21=mysql_query("SELECT * FROM cups WHERE codigo='$cod_cup'");
	while($rowcie21=mysql_fetch_array($cad21))
	{
					$codcp1=$rowcie21['descrip'];
	}
	
	
	
	if($mcu>0)	
	{
	
		//echo"<td align='left'><strong><input type=text name=codcp1 size=70 value='$codcp1' onkeyDown='buscar()'></td>";

		//*********************
		echo "<td align='left'><strong><input type=text id='course_'  name='codcp1' size=80 onkeyDown='envio(1,this,codcp1)'></td>";
		//*********************

		echo"</tr> ";
	}
	else
	{
	
		echo"<input type=hidden name=codcp1 value='$codcp1'> ";
	}
	echo "<tr><td colspan=6 align='right'><input type=button name=botci value=Guardar onClick='guarda()'><td></tr></table>";

	
		
	 echo"<input type=hidden name=evalua>";
	 echo "<input type=hidden name=control value=$control>";
	 echo"<input type=hidden name=iden_labs value=$iden_labs>";
	 echo "<input type=hidden name=cod value='$codusu'>";
	 echo"<input type=hidden name=hospit value=1>";
	?>

<br><br>
 <input type='hidden' name='cont' value='<?echo $cont;?>'> 
 <input type='hidden' name='format'>


</form>
</body>
</html>
<html><head></head><body></body></html>