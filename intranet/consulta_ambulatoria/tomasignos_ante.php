<?PHP
	session_register('paciente');
	session_register('numcita');
	session_register('Gcod_mediconh');
	if(empty($paciente))
	{
		/*
		echo"<br><br><table align=center class='tbl'>
		<tr><th>POR SEGURIDAD SU SESI�N SE CERR�. EIERRE E INGRESE NUEVAMENTE AL PROGRAMA</th></tr>
		</table>";
		exit;
		*/
	}
	//ECHO $Gcod_mediconh;
?>

<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="JavaScript">
	function valida(n)
	{
		 var vrfca=true;
		
			opciona = document.getElementsByName("chk_tpr");
			var tipopac=0;
			for(i=0; i<4; i++)
			{			
				if(opciona[i].checked)
				{				
					var tipopac=1;
				}	
			}
			if(tipopac==0)
			{
				alert("Seleccione tipo de Paciente( Materna,Nino, Adulto Mayor)");
				vrfca=false;
			}
			
			if(uno.motivo.value=='')
			{
				alert("Digite el motivo de consulta");
				uno.motivo.focus();
				vrfca=false;
			}
			if(uno.medio.value=='')
			{
				alert("Seleccione el medio de llegada");
				uno.medio.focus();
				vrfca=false;
			}
			if(uno.estado.value=='')
			{
				var mensaje1 = "estado";
				alert("Digite el estado de conciencia");
				uno.estado.focus();
				vrfca=false;
			}			  
				   
			opciona = document.getElementsByName("remitido");
			var ren=0;
			for(i=0; i<2; i++)
			{			
				if(opciona[i].checked)
				{				
					var ren=1;
				}
								
			}
			if(ren==0)
			{
				alert("Seleccione si es paciente remitido o no");
				vrfca=false;
			}		
			peso=uno.peso.value;
			if(peso!="")
			{	
				if(peso<=2.0 || peso>=200)
				{
					document.getElementById("peso").style.backgroundColor = "orange";
					alert("El rango de Peso es Menor a 2.0kg y menor a 45");
					vrfca=false;
									
				}
			}
			talla=uno.talla.value;
			if(talla!="")
			{
				if(talla<=15 || talla>=250)
				{
					document.getElementById("talla").style.backgroundColor = "orange";
					alert("El rango de talla es Menor a 15(cm) y mayor a 250.");
					vrfca=false;
					
				}
			}
			////TENSION ARTERIAL (1)
			ten1=uno.tenar1.value;
			if(ten1=="")
			{
				alert("La Tension Arterial del paciente NO puede ser vacia");
				vrfca=false;
			}
			var tend = parseInt(ten1);
			//alert(tend);
			if((tend<90) || (tend>140))
			{
					uno.tenar1.style.background= "orange";
					alert("Digite el valor de la tension arterial del paciente en los rangos D:90-140");
					vrfca=false;
			}
			else{uno.tenar1.style.background='#FFFFFF';}
		    
			/////TENSION ARTERIAL(2)
			ten2=uno.tenar2.value;
			if(ten2=="")
			{
				alert("La Tension Arterial del paciente NO puede ser vacia");
				vrfca=false;
			}
			var tend2 = parseInt(ten2);
			//alert(tend2);
			if((tend2<60) || (tend2>90))
			{
				uno.tenar2.style.background= "orange";
				alert("Digite el valor de la tension arterial del paciente en los rangos S:60-110");
				vrfca=false;
			}
			else{uno.tenar2.style.background='#FFFFFF';}
		    
			///////FRECUENCIA RESPIRATORIA
			freres=uno.freres.value;
			if(freres=="")
			{
				alert("La Frecuencia Respiratoria del paciente NO puede ser vacia");
				vrfca=false;
			}
			var fres = parseInt(freres);
			if((fres<12)||(fres>30))
			{
				uno.freres.style.background= "orange";
				alert("Digite el valor de la frecuencia respiratoria del paciente Entre 12-30");
				vrfca=false;
			}
			else{uno.freres.style.background='#FFFFFF';}
			
			//////FRECUENCIA CARDIACA
			
			fc=uno.fc.value;
			if(fc=="")
			{
				alert("La Frecuencia Cardiaca del paciente NO puede ser vacia");
				vrfca=false;
			}
			var fcard = parseInt(fc);
			if((fcard<50)||(fcard>150))
			{
				uno.fc.style.background= "orange";
				alert("Digite el valor de la frecuencia cardiaca del paciente, Entre 50 - 150");
				vrfca=false;
			}
			else{uno.fc.style.background='#FFFFFF';}
			
			///////temperatura
			
			temp=uno.tempe.value;
			if(temp=="")
			{
				alert("La Temperatura del paciente NO puede ser vacia");
				vrfca=false;
			}
			var tempt = parseInt(temp);
			if((tempt<35)||(tempt>39))
			{
				uno.tempe.style.background= "orange"
				alert("Digite el valor de la temperatura del paciente <35 o >39");
				vrfca=false;
			}
			else{uno.tempe.style.background='#FFFFFF';}
			///////////////pulso
			pulso=uno.pulso.value;
			if(pulso=="")
			{
				alert("La Saturacion de Oxigeno NO puede ser vacio");
				vrfca=false;
			}
			var pul=parseInt(pulso);
			if(pul>=90)
			{
				uno.pulso.style.background= "orange";
				alert("Digite saturacion de Oxigeno del paciente >90");
				vrfca=false;
			}
			else{uno.pulso.style.background='#FFFFFF';}
			////sintomas covid
			alert("MMM");
			f=uno.fincov.value;
			var anu=0;
			for(i=0;i<f;i++)
			{
				val="valor"+i;			
				opcion = document.getElementsByName(val);				
				if(opcion[0].checked)
				{				
					anu++;
				}
				if(opcion[1].checked)
				{				 
					anu++;
				}		
			}
			if(anu<f)
			{
				alert("Hay sintomas de covid 19 sin seleccionar");
				return;
			}
			
			
			////Nivel del dolor
			opciona = document.getElementsByName("chk_dlr");
			var dolor=0;
			fin=uno.finene.value;
			for(i=0; i<fin; i++)
			{			
				if(opciona[i].checked)
				{				
					var dolor=1;
				}
			}
			if(dolor==0)
			{
				alert("Seleccione el grado de dolor del Paciente");
				vrfca=false;
			}
			
			////ABUSO SEXUAL
			
			opciona = document.getElementsByName("chk_absx");
			var absx=0;
			for(i=0; i<3; i++)
			{			
				if(opciona[i].checked)
				{				
					var absx=1;
				}
			}
			if(absx==0)
			{
				alert("Seleccione si hubo Abuso Sexual ");
				vrfca=false;
			}
			////test de mancheter
			opciona = document.getElementsByName("chk_tmch");
			var tmch=0;
			for(i=0; i<5; i++)
			{			
				if(opciona[i].checked)
				{				
					var tmch=1;
				}
				
			}
			if(tmch==0)
			{
				alert("Seleccione el color de Test de Manchester");
				vrfca=false;
			}
			if(uno.destino.value=='')
			{
				alert("Seleccione el destino");
				uno.destino.focus();
				vrfca=false;
			}
			
			//alert(vrfca);
			if(vrfca == false)
			{
				if(confirm("¿HAY INFORMACION QUE NO ESTA DENTRO DE LOS RANGOS NORMALES DESEA CONTINUAR, ACEPTAR CANCELAR?")) 
				{
					//alert("aqui ya guarda");
					uno.action='almacena.php';
				    uno.target='';
					uno.submit();	
				}
				else{
				return 0;
				}
			
			}
			else
			{
				uno.action='almacena.php';
				uno.target='';
				uno.submit();	
			}
	}
	
	
	function salir1()
	{
		uno.target='area';
		uno.action='clasi_triage.php';
		uno.submit();	
	}
	function sumar()
	{
        uno.target='area';
		uno.action='tomasignos.php';
		uno.submit();	
    }
		
	function soloNumeros(e)
	{
		 var key = window.Event ? e.which : e.keyCode
		 return (key >= 48 && key <= 57)
	}

</script>
</head>	
<body>
<?PHP
	include ('php/conexion1.php');
	/*$bsig=mysql_query("select * from triage_urgencias where iden_cita='$numcita'");
	while($rsig=mysql_fetch_array($bsig))
	{
		$tenar1=$rsig['tear1_tri'];
		$tenar2=$rsig['tear2_tri'];
		$freres=$rsig['frre_tri'];		
		$fc=$rsig['frca_tri'];
		$tempe=$rsig['temp_tri'];
		$clasi=$rsig['clas2_tri'];	
		//$motivo=$rsig['moco_tri'];
		$medio=$rsig['mell_tri'];
		$estado=$rsig['esco_tri'];
		$observa=$rsig['obse_tri'];
		$remitido=$rsig['remi_tri'];		
		$peso=$rsig['peso_tri'];
		$talla=$rsig['talla_tri'];
		$pulso=$rsig['pulso_tri'];
		$gluco=$rsig['gluco_tri'];
		$fcf=$rsig['fcf_tri'];
		$clase=$rsig['clas_tri'];
	}*/
	$checA='';
	$checB='';
	$checC='';
	if($clasi=='AA')$checA="checked";
	if($clasi=='BB')$checB="checked";
	if($clasi=='CC')$checC="checked";
	if($clasi=='DD')$checD="checked";
	echo"<form name=uno method=post>
	<input type=hidden name=medi value='$Gcod_mediconh'>	
	<input type=hidden name=codiprg value='10'>	
	<table align=center class='tbl4' width=80% border=0>
	<tr>
	<th colspan=10 align=center height=50>HISTORIA CLINICA DE TRIAGE</th>
	</tr>";
	echo"<tr>";
	   
        echo"</td></tr></table>";
        //echo "MTV".$motivo;
        echo"<table align=center class='tbl4' width=80% border=1>";
        echo"<br>
		<tr>";
		$sql_tper=mysql_query("SELECT codi_des,nomb_des, valo_des,val2_des  FROM destipos WHERE codt_des='50' ORDER BY valo_des ");
		echo"<tr><td colspan=10 align=center>";
		while($rowtpr = mysql_fetch_array($sql_tper))
		{
			
			echo"<input  type=Radio name=chk_tpr  id='chk_tpr' value=$rowtpr[codi_des]>   $rowtpr[nomb_des]&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;";
		}
		echo "</td></tr>";
		
		echo"<tr><th><font face='verdana'><b>MOTIVO DE CONSULTA</th> 
		<td colspan=3 align=left>
                <textarea name=motivo value='$motivo' cols=50 rows=7>$motivo</textarea>
                
		</td></tr>
		<tr><th><font face='verdana'><b>Medio de llegada</th>
		<td align=left><select name=medio class='caja' value=$medio>
		<option value=0></option>
		<option value=1>Caminando</option>
		<option value=2>En ambulancia</option>
		<option value=3>Llegada vehiculo</option>
		<option value=4>Vehiculo policia</option>
		<option value=5>Otro</option>		
		</select></td>		
		<th><font face='verdana'><b>ESTADO DE CONCIENCIA</th>
		<td align=left><input type=text onPaste='return false' name=estado value='$estado'></td></tr>		
	
		<tr><th><font face='verdana'><b>PACIENTE REMITIDO</th>" ;
		if($remitido=='S')
		{
			echo"<td align=left colspan=3>SI <input type=radio checked name=remitido value='S'>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
			NO <input type=radio name=remitido value='N'></td>";	
		} 
		else if($remitido=='N')
		{
			echo"<td align=left colspan=3>SI <input type=radio name=remitido value='S'>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
			NO <input type=radio checked name=remitido value='N'></td>";	
		} 
		else
		{
			echo"<td align=left colspan=3>SI <input type=radio name=remitido value='S'>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
			NO <input type=radio name=remitido value='N'></td>";	
		} 
		echo"<tr></table>";
	echo"
	<table align=center class='tbl4' width=80% border=1>
	<tr><th colspan=10><b>SIGNOS VITALES</th></tr>	
	
	
	<tr>
	<th align=center width=10%><font face='verdana'><b>PESO(KG)</th>
	<th align=center width=10%><font face='verdana'><b>TALLA(CM)</th>	
	<th align=center width=10%><font face='verdana'><b>TENSION ARTERIAL</th>
	<th align=center width=10%><font face='verdana'><b>FRECUENCIA RES</th>
	<th align=center width=10%><font face='verdana'><b>FRECUENCIA CAR</th>
	<th align=center width=10%><font face='verdana'><b>TEMPERATURA</th>
	<th align=center width=10%><font face='verdana'><b>SATURACION O2</th>
	<th align=center width=10%><font face='verdana'><b>FREC CARD FETAL()</th>	
	</tr>
	
	<tr>	
	<td align=center width=10%><input type=text onPaste='return false' size=2 class='caja' id='peso'  name=peso value='$peso' onKeyPress='return soloNumeros(event)' ></td>
	<td align=center width=10%><input type=text onPaste='return false' size=2 class='caja' id='talla' name=talla value='$talla' onKeyPress='return soloNumeros(event)'></td>	
	<td align=center width=10%><input type=text onPaste='return false' size=2 class='caja' id='tenar1' name=tenar1 value='$tenar1' onKeyPress='return soloNumeros(event)'><input type=text onPaste='return false' size=2 class='caja' name=tenar2 value='$tenar2' onKeyPress='return soloNumeros(event)'></td>
	<td align=center width=10%><input type=text onPaste='return false' size=2 class='caja' id='freres' name=freres value='$freres' onKeyPress='return soloNumeros(event)'></td>	
	<td align=center width=10%><input type=text onPaste='return false' size=2 class='caja' id='fc' name=fc value='$fc' onKeyPress='return soloNumeros(event)'></td>
	<td align=center width=10%><input type=text onPaste='return false' size=2 class='caja' id='tempe' name=tempe value='$tempe' onKeyPress='return soloNumeros(event)'></td>	
	<td align=center width=10%><input type=text onPaste='return false' size=2 class='caja' id='pulso' name=pulso value='$pulso' onKeyPress='return soloNumeros(event)'></td>";
	if($clase=="MA")
	{
		
		echo"<td align=center width=10%><input type=text size=2 class='caja' name=fcf value='$fcf'></td>";
		$val=1;
	}
	else
	{
		echo"<td align=center width=10%>N / A</td>";
		$val=0;
	}
	echo"</tr></table>";
	/*///CATEGORIA
	echo"<table align=left class='tbl' width=80% border=0>";
	echo"<tr><th colspan=10 align=center height=50>CATEGORIAS</th></tr>";
	$sql_trg=mysql_query("SELECT nomb_des, valo_des FROM destipos WHERE codt_des='A8'");
	echo"<tr><td colspan=10>";
	while($rowmana = mysql_fetch_array($sql_trg))
	{
		echo"   $rowmana[nomb_des]<br>";
	}
	echo "</td></tr></table>";
		
	////DESCRIMINADORES
	echo"<table align=left class='tbl' width=80% border=1>";
	echo"<tr><th colspan=20 align=center>DISCRIMINADORES</th></tr>";
	echo"<tr><th colspan=20 align=center>Riesgo Vital</th></tr>";
	$sql_dsc=mysql_query("SELECT nomb_des, valo_des FROM destipos WHERE codt_des='A9' And valo_des='1' ");
	echo"<tr><td colspan=10>";
	while($rowdes = mysql_fetch_array($sql_dsc))
	{
		echo"   $rowdes[nomb_des]</option><br>";
	}
	echo "</td></tr></table>";
	
	//hemorragias
	echo"<table align=left class='tbl' width=80% border=1>";
	echo"<tr><th colspan=20 align=center>Hemorragia</th></tr>";
	$sql_dsc=mysql_query("SELECT nomb_des, valo_des,val2_des  FROM destipos WHERE codt_des='A9' And valo_des='3' ");
	echo"<tr><td colspan=10 align=left>";
	while($rowdes = mysql_fetch_array($sql_dsc))
	{
		echo"   $rowdes[nomb_des]</option><br>";
	}
	echo "</td></tr></table>";	
	
	//temperatura
	echo"<table align=left class='tbl' width=80% border=1>";
	echo"<tr><th colspan=20 align=center>Temperatura</th></tr>";
	$sql_dsc=mysql_query("SELECT nomb_des, valo_des,val2_des  FROM destipos WHERE codt_des='A9' And valo_des='4' ");
	echo"<tr><td colspan=10 align=left>";
	while($rowdes = mysql_fetch_array($sql_dsc))
	{
		echo"   $rowdes[nomb_des]</option><br>";
	}
	echo "</td></tr></table>";	
	
	//Agudeza Visual
	echo"<table align=left class='tbl' width=80% border=1>";
	echo"<tr><th colspan=20 align=center>Agudeza</th></tr>";
	$sql_dsc=mysql_query("SELECT nomb_des, valo_des,val2_des  FROM destipos WHERE codt_des='A9' And valo_des='5' ");
	echo"<tr><td colspan=10 align=left>";
	while($rowdes = mysql_fetch_array($sql_dsc))
	{
		echo"  $rowdes[nomb_des]</option><br>";
	}
	echo "</td></tr></table>";	*/
	
	
	//////////dolor
	
	echo"<table align=center class='tbl4' width=80% border=1>";
	echo"<tr><th colspan=6 align=center>Dolor</th></tr>";
	$sql_dsc=mysql_query("SELECT codi_des,nomb_des, valo_des,val2_des  FROM destipos WHERE codt_des='A9' And valo_des='2' And codi_des>='A919'ORDER BY homo_esp");
	echo"<tr>";
	$n=0;
	while($rowdes = mysql_fetch_array($sql_dsc))
	{
		ECHO"<td align=center>";
		$imagen=$rowdes[val2_des];
		echo"<img src='$imagen'> <br><br> <input  type=Radio name=chk_dlr  id='chk_dlr' value=$rowdes[codi_des]>&nbsp;&nbsp;&nbsp;$rowdes[nomb_des]";
		echo"</td>";
		$n++;
	}
	echo"<input type=hidden name=finene value=$n>";
	echo "</tr></table>";
	
	//abuso sexual
	echo"<table align=center class='tbl4' width=80% border=1>";
	echo"<tr><th colspan=20 align=center>Sospecha De Abuso Sexual</th></tr>";
	$sql_dsc=mysql_query("SELECT codi_des,nomb_des, valo_des,val2_des  FROM destipos WHERE codt_des='A6'");
	echo"<tr><td colspan=10 align=left>";
	while($rowdes = mysql_fetch_array($sql_dsc))
	{
		$imagenab=$rowdes[val2_des];
		echo" <input type=Radio name=chk_absx value=$rowdes[codi_des]>$rowdes[nomb_des]</option><br>";
	}
	
	echo "</td></tr></table>";	
	
	//sintomas covid 19	
	
	ECHO"<br>
	<table align=center width=80% class='tbl4'><tr>";
	$bfnac=mysql_query("SELECT * FROM destipos WHERE codi_des='E001'");
	$n=0;
	while($rfnac=mysql_fetch_array($bfnac))
	{
		$codi_des=$rfnac['codi_des'];
		$nomb_des=$rfnac['nomb_des'];
		
		$nomvar='codi'.$n;
		echo"<input type=hidden name=$nomvar value=$codi_des>";
		$nomvar='valor'.$n;
		$valor=$$nomvar;			
		if(empty($valor))
		{
			$bvir=mysql_query("SELECT * FROM sintomas_covid WHERE iden_cita='$numcita' AND cod_sintoma='$codi_des' and tipo_historia='C'");
			$rvir=mysql_fetch_array($bvir);
			$valor=$rvir['valor_sintoma'];			
		}
		$ch1='';$ch2='';
		if($valor=='S')$ch1='checked';
		if($valor=='N')$ch2='checked';
		echo"<td>$nomb_des</td>
		<td align=center> SI <input type=radio $ch1 name=$nomvar value='S'> </td>
		<td align=center> NO <input type=radio $ch2 name=$nomvar value='N'> </td>";
	}
	echo" 
	</tr></table>";
	
	
	
	ECHO"<br>
	<table align=center width=80% class='tbl4'><tr>";
	$bfnac=mysql_query("SELECT * FROM destipos WHERE codi_des='E002'");
	$n=1;
	while($rfnac=mysql_fetch_array($bfnac))
	{
		$codi_des=$rfnac['codi_des'];
		$nomb_des=$rfnac['nomb_des'];
		
		$nomvar='codi'.$n;
		echo"<input type=hidden name=$nomvar value=$codi_des>";
		$nomvar='valor'.$n;
		$valor=$$nomvar;			
		if(empty($valor))
		{
			$bvir=mysql_query("SELECT * FROM sintomas_covid WHERE iden_cita='$numcita' AND cod_sintoma='$codi_des' and tipo_historia='C'");
			$rvir=mysql_fetch_array($bvir);
			$valor=$rvir['valor_sintoma'];			
		}
		$ch1='';$ch2='';
		if($valor=='S')$ch1='checked';
		if($valor=='N')$ch2='checked';
		echo"<td>$nomb_des</td>
		<td align=center> SI <input type=radio $ch1 name=$nomvar value='S'> </td>
		<td align=center> NO <input type=radio $ch2 name=$nomvar value='N'> </td>";
	}
	echo" 
	</tr></table>
	<br>
	<table align=center width=80% class='tbl4'>
	<tr><th colspan=20 align=center>Sintomas de COVID-19</th></tr>
	<tr>
	<th>ITEM</th>
	<th> SI </th>
	<th> NO </th>
	<th>ITEM</th>
	<th> SI </th>
	<th> NO </th>
	<tr>";
	$bfnac=mysql_query("SELECT * FROM destipos WHERE codt_des='E0' AND codi_des<>'E001' AND codi_des<>'E002'");
	$n=2;
	while($rfnac=mysql_fetch_array($bfnac))
	{
		$codi_des=$rfnac['codi_des'];
		$nomb_des=$rfnac['nomb_des'];
		
		$nomvar='codi'.$n;
		echo"<input type=hidden name=$nomvar value=$codi_des>";		
		$nomvar='valor'.$n;
		$valor=$$nomvar;		
		if(empty($valor))
		{
			$bvir=mysql_query("SELECT * FROM sintomas_covid WHERE iden_cita='$numcita' AND cod_sintoma='$codi_des' and tipo_historia='C'");
			$rvir=mysql_fetch_array($bvir);
			$valor=$rvir['valor_sintoma'];			
		}
		$ch1='';$ch2='';
		if($valor=='S')$ch1='checked';
		if($valor=='N')$ch2='checked';
		
		if(($n) % 2==0)echo"<tr>";
		echo"<td>$nomb_des</td>
		<td align=center> <input type=radio $ch1 name=$nomvar value='S'> </td>
		<td align=center> <input type=radio $ch2 name=$nomvar value='N'> </td>";
		
		$n++;
	}
	ECHO"<TR>
	</table>";
	echo"<input type=hidden name=fincov value=$n>";
	
	
	
	//sistema triage
	echo"<table align=center class='tbl4' width=80% border=1>";
	echo"<tr><th colspan=20 align=center>SISTEMA DE TRIAGE DE MANCHESTER</th></tr>";
	$sql_dsc=mysql_query("SELECT codi_des,nomb_des, valo_des,val2_des  FROM destipos WHERE codt_des='B1'");
	echo"<tr><td colspan=10 align=center>";
	while($rowdes = mysql_fetch_array($sql_dsc))
	{
		$imagtch=$rowdes[val2_des];
		echo"<input type=Radio name=chk_tmch value=$rowdes[codi_des]><img width=50% src='$imagtch'></option></a></img><br>";
	}
	
	
	echo "</td></tr>";
	
	echo"<tr><th>DESTINO</TH>
	<td align=left><select name=destino class='caja'()'>
		<option value=0></option>
		<option value='U'>ATENCION DE URGENCIA</option>
		<option value='P'>CONSULTA PRIORITARIA</option>
		<option value='R'>REMISION A OTRA IPS</option>
	</select></td>		
	 
	 <br><tr><th><font face='verdana'><b>OBSERVACIONES</th> 
		<td colspan=3 align=left>
                <textarea name=observa value='$observa' cols=50 rows=7>$observa</textarea>
                
		</td></tr>
	
	<tr><th colspan=4 height=50><INPUT type=button  value='Guardar' onClick='valida($val)'>
	<INPUT type=button  value='Lista pacientes' onClick='salir1()'></th></tr>	
	</table>
	</td></tr></table>";
	echo "</td></tr></table>";	
	?>
		<script language=javascript>
		uno.estado.value="<?echo $estado;?>";	
		uno.medio.value="<?echo $medio;?>";		
		uno.destino.value="<?echo $destino;?>";	
		</script>
	<?
?>
</body>
</html>