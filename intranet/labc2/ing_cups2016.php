<?session_register('datos');?>
<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
	<script type="text/javascript">
	//alert('toy');
	$().ready(function() {	
		$("#course").autocomplete("bus_cie10.php", {
		width: 340,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
		});	
		$("#course").result(function(event, data, formatted) {
		$("#course_val").val(data['1']);
		});
	});
	</script>
<SCRIPT LANGUAGE='JavaScript'>
function envio(p,q)
{		
	if(event.keyCode==13)
	{
			j=form1.fin.value;
			ref="form1.cod"+j+".value=form1.cod_cup.value";
			eval(ref);
			form1.fin.value=(form1.fin.value/1)+1/1;
			form1.cod_cup.value='';
			q.focus();
			form1.target='';
			form1.submit();
	}
}


function envio11()
{		
	    if(event.keyCode == 13)
		{
			form1.action='bus_medico.php';
			form1.submit();
		}
}


function envio21(ord,p,q)
{		
	   
		if(event.keyCode==113)
		{
			//alert("toy");
			//form1.ord.value=ord;
			form1.action='buscups.php';
			form1.submit();
		}
}




	function verfin(p,q)
	{
		q.value=p.value;
		//form1.fin_con.focus();
	}
	
	function pos(p,q)
	{
		
		if(event.keyCode == 13)
		{
			q.focus();
		}
	}
	
	function cambio(p,q)
	{
		if(p.value=='')
		{
			//alert("aquitoy");
			q.value='';
			q.focus();
		}
	}
	
	function compara(p,q)
	{
		q.value=p.value;
	}

	
	function guarda()
	{
			//alert(form1.format.value);
			con=form1.fin.value;
			
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
			
			if(form1.amb_usu.value=='')	
			{
				alert("Seleccione Ambito del Procedimiento")
				form1.amb_usu.focus();
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
			
			if(form1.cod_cie.value=='' && form1.cod_cie.value==0)	
			{
				alert("Seleccione Dx de solicitud")
				form1.progu.focus();
				return	
			}
			if(form1.des_cie10.value=='' && form1.des_cie10.value==0)
            {
                alert("Seleccione Dx de solicitud")
			    form1.progu.focus();
                return;
			}
			if(form1.num_ord.value=='')	
			{
				alert("Ingrese Numero de Orden")
				form1.num_ord.focus();
				return	
			}
			if(form1.band.value==1)
			{
				alert("Ingrese Numero de Orden que no Exista")
				return	
			}
						
			if(form1.eva_dx.value==1)
			{		
				alert("Ingrese Una Observación para el diagnostico PR01")
				return
			
			}
			if(form1.servi.value=='')	
			{
				alert("Seleccione el Servicio")
				form1.servi.focus();
				return	
			}
			
			val=0;
			for(i=0;i<con;i++)
			{
				ref="form1.selec"+i+".checked"
				if(eval(ref)==true)
				{
					val=1;
				}	
				//ref="form1.obs"+i+".value"
				//obs=eval(ref);
				//if(obs=='' || obs<=0)	
				//{
					//alert("Digite la Observación/Resultados")
					//return			
				//}
				
			
			}
			if(val==0)
			{
				alert("No existen procedimientos seleccionados");
			}
			
			else
			{
					form1.format.value=2;
					form1.action='guar_rips.php';
					form1.submit();
				
			}
	}
	
	function buscar()
	{
		if (event.keyCode == 13)
		{
			form1.target='';
			form1.action='buscups.php';
			form1.submit();
		}	
	}
	
	function crear(p,q)
	{
		
		if (event.keyCode == 13)
		{
			
			if(form1.cod_cup.value=='' || form1.cod_cup.value=='0')	
			{
				alert("Seleccione Procedimiento")
				form1.obs.focus();
				return			
			}
			if(form1.obs.value=='' || form1.obs.value<=0)	
			{
				alert("Digite la Observación")
				//form1.nomb_bact.focus();
				return			
			}	

			/*if(form1.nomb_bact.value=='' || form1.nomb_bact.value<=0)	
			{
				alert("Digite el Bacteriolog@")
				//form1.dx_.focus();
				return			
			}*/
			
			/*if((p.value)!=(q.value))
			{
				alert("El codigo no corresponde al Bacteriolog@");
				p.value='';
				q.value='';
				p.focus();
				return
			}*/
			
			j=form1.fin.value;
			ref="form1.codcup"+j+".value=form1.cod_cup.value";
			eval(ref);			
			ref="form1.obser"+j+".value=form1.obs.value";
			eval(ref);
			ref="form1.selec"+j+".value=1";
			eval(ref);
			ref="form1.unid"+j+".value=form1.uni_cup.value";
			eval(ref);
			//ref="form1.bact"+j+".value=form1.nomb_bact.value";
			//eval(ref);
			ref="form1.refex"+j+".value=form1.ref_bact.value";
			eval(ref);
			
			form1.fin.value=(form1.fin.value/1)+1/1
			
			form1.cod_cup.value='';
			form1.obs.value='';
			//form1.nomb_bact.value='';
			form1.nom_cup.value='';
			form1.uni_cup.value='';
			form1.ref_bact.value='';
			//form1.opc_bac.value='';
			form1.target='';
			form1.action='ing_cups.php';
			form1.submit();			
		}	
	}
	function opcion(p)
	{
		
			//form1.evalu.value=1;
			form1.action='ing_cups.php';
			form1.submit();			
		
	
	}
	function comprueba()
	{
		if(form1.num_ord.value=='' & form1.num_ord.value==0)
		{
		
			alert('La Orden no puede ser vacia o en cero ')
			return	

		
		}
		else
		{
			form1.action='ing_cups.php';
			form1.submit();			
		}
	
	}
	function comprueba2()
	{
		if(form1.obs_dx.value=='' & form1.obs_dx.value==0)
		{
		
			alert('La Observacion no puede ser vacia o en cero ')
			form1.eva_dx.value=1;
			return	

		
		}
		else
		{
			form1.eva_dx.value=0;
			form1.action='ing_cups.php';
			form1.submit();			
		}
	
	}
	
	function gua_bd(oco)
	{
		form1.evalua.value=2;
		form1.format.value=oco;
		form1.action='guarda_formato.php';
		form1.submit();		
	
	}
	
	function evaluar()
	{
		if(form1.control.value==2)
		{
			form1.esta_ncf.disabled=false;
			form1.botci.disabled=true;
		}
		else
		{
			form1.esta_ncf.disabled=true;
			form1.botci.disabled=false;
		}
	}
	function imprimir()
	{
		form1.action='imprimir_.php';
		form1.target='fr011';
		form1.submit();
	
	}
	
	function regresar2()
	{
		form1.action='cd_usuario2.php';
		form1.submit();
	}
	
	function verfin2(p,q)
	{	
		//alert("toy");
		if(event.keyCode == 13)
		{
			
			q.value=p.value;
			form1.action='ing_cups.php';
			form1.submit();
		}
	}
function agregar3()
{
		/*alert((form1.via_cir.value));*/
        valor=(document.documentElement.scrollTop+document.body.scrollTop);
        form1.scr.value=valor;
        if(form1.cod_cp.value=='')	
        {
                alert("Seleccione Codigo Cups")
                form1.cod_cp.focus();
                return			
        }

        if(form1.des_cup.value=='')	
        {
                alert("Digite Nombre Cups")
                form1.des_cup.focus();
                return			
        }
		
	
        ite=form1.h.value;
        //alert(ite);
        ref="form1.cod_cups"+ite+".value=form1.cod_cp.value";
        eval(ref);			
        ref="form1.nomb_cups"+ite+".value=form1.des_cup.value";
        eval(ref);
        ref="form1.seli_"+ite+".value=1";
        eval(ref);
        ref="form1.rmt_"+ite+".value=1";
        eval(ref);
		

        form1.h.value=(form1.h.value/1)+1/1
        form1.cod_cp.value='';
        form1.des_cup.value='';

        form1.target='';
        form1.action='ing_cups.php';
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
<body onload='evaluar()'>
		
 <?
	$datos[0]='nom_cie10';
	$datos[1]='cod_cie10';
	$datos[2]='cie_10';	
    

	include('php/funciones.php');
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);
	
	//ECHO $codig_usu;
	if(empty($fin))$fin=0;
	
	$csord=mysql_query("SELECT * FROM `detalle_labs` WHERE `nord_dlab`='$num_ord'");
	if(mysql_num_rows($csord)<>0)
	{
	
		echo "<p align='center'><b>EL NUMERO DE ORDEN YA EXISTE O PERTENECE A OTRO USUARIO</p>";
	
	
	}


	else
	{

		if($contr==1)
		{
			$conusu01 = mysql_query("SELECT NROD_USU,CODI_CON,CODI_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU,
						   TPAF_USU,CONT_UCO,NEPS_CON,IDEN_UCO,CUSU_UCO 
						   FROM usuario, ucontrato,contrato 
						   WHERE CODI_USU=CUSU_UCO AND CONT_UCO=CODI_CON AND NROD_USU ='$cod_usu' AND CODI_CON='$contrato' AND ESTA_UCO='AC'"); 
		
		if(mysql_num_rows($conusu01)<>0)
		{
			$rowus = mysql_fetch_array($conusu01);
			$codig_usu=$rowus[CODI_USU];
		
		echo"<input type=hidden name=fat value=$fat>";
		echo"<input type=hidden name=cod_usu value=$cod_usu>";
		echo"<input type=hidden name=contr value=$contr>";
		echo"<input type=hidden name=contrato value=$contrato>";
		echo"<input type=hidden name=bd value=$bd>";
		echo "<table class='Tbl0'>";
		echo "<tr><td class='Th0' width='15%'><strong>IDENTIFICACION</td>
				  <td class='Th0' width='50%'><strong>NOMBRE</td>
				  <td class='Th0' width='10%'><strong>EDAD</td>
				  <td class='Th0' width='10%'><strong>SEXO</td>
				  <td class='Th0' width='15%'><strong>CONTRATO</td></tr>";
		
		$conusu = mysql_query("SELECT NROD_USU,CODI_CON,CODI_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU,
						   TPAF_USU,CONT_UCO,NEPS_CON,IDEN_UCO,CUSU_UCO 
						   FROM usuario, ucontrato,contrato 
						   WHERE CODI_USU=CUSU_UCO AND CONT_UCO=CODI_CON 
						   AND CUSU_UCO ='$codig_usu' AND CODI_CON='$contrato' AND ESTA_UCO='AC'"); 
		
		
			$rowu= mysql_fetch_array($conusu);
			echo "<input type=hidden name=codig_usu value=$codig_usu>";
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

			
			echo" <table class='Tbl0' >
			<tr><td class='Td1' align='center'><STRONG>INFORMACION DEL RIPS</strong></td></tr>
			</table>";
			
			$fecha=time();
			$fec=date ("Y/m/d",$fecha);
			$hor=date ("H:i:s",$fecha);
			
			
			echo "<br><br>";
			echo "<table class='Tbl0'  border=1><tr>";?>
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
							
					<?echo"<span class=Estilo6>Hora: <input type=text name=mine size=6 value=$hor></td>";?>
							
			

					
		<?	
			
			
			echo"<td class='Th0' width='15%'><strong>FECHA</td>
			  <td  width='17%'>$fec - $hor</td></tr>";
			  
			echo"<tr><td  width='9%' class='Th0' aling='right'><b>AMBITO</td>
			<td  width='35%'><input type=text name=amb_usu  size=2 maxlength=2  onBlur='verfin(this,opc_amb)' value='$amb_usu'>";
			echo" <select name=opc_amb onchange='verfin(this,amb_usu)'><option value=''></option>";
			$consulta=mysql_query("SELECT codi_des,codt_des,nomb_des,valo_des FROM `destipos` WHERE codt_des='32' order by nomb_des");
			while($rowa=mysql_fetch_array($consulta))
			{
				echo "<option value='$rowa[valo_des]'>$rowa[nomb_des]";
			}
			echo" </select></TD>";		
		?>  	
			 <script language="javaScript">form1.opc_amb.value='<?echo $amb_usu;?>';</script>
			
		<?
			
			echo "<td  width='5%' class='Th0' aling='right'><b>FINALIDAD</td>
			<td  width='35%'><input type=text name=fin_con size=2 maxlength=2  onBlur='verfin(this,opc_fin)' value='$fin_con'>";
			echo" <select name=opc_fin onchange='verfin(this,fin_con)'><option value=''></option>";
			$consulta=mysql_query("SELECT codi_des,codt_des,nomb_des,valo_des FROM `destipos` WHERE codt_des='33' order by nomb_des");
			while($rowa=mysql_fetch_array($consulta))
			{
				echo "<option value='$rowa[valo_des]'>$rowa[nomb_des]";
			}
			echo" </select></TD>";		
		?>  	
			 <script language="javaScript">form1.opc_fin.value='<?echo $fin_con;?>';</script>

			 
		<?

			echo"<tr><td  width='9%' class='Th0' aling='right'><b>C.USUARIO</td>
			<td> <input type=text name=condu size=2 maxlength=2  onBlur='verfin(this,opc_condu)' value='$condu'>";
			echo" <select name=opc_condu onchange='verfin(this,condu)'><option value=''></option>";
			$consulta=mysql_query("SELECT codi_des,codt_des,nomb_des,valo_des FROM `destipos` WHERE codt_des='34' order by nomb_des");
			while($rowa=mysql_fetch_array($consulta))
			{
				echo "<option value='$rowa[valo_des]'>$rowa[nomb_des]";
			}
			echo" </select></td>";	
		?>  	
			 <script language="javaScript">form1.opc_condu.value='<?echo $condu;?>';</script>

			 
		<?
			
			echo "<td  width='5%' class='Th0' aling='right'><b>PROGRAMA</td>
			<td  width='35%'><input type=text name=progu size=2 maxlength=2  onBlur='verfin(this,opc_progu)' value='$progu'>";
			echo" <select name=opc_progu onchange='verfin(this,progu)'><option value=''></option>";
			$consulta=mysql_query("SELECT codi_des,codt_des,nomb_des,valo_des FROM `destipos` WHERE codt_des='45' order by nomb_des");
			while($rowa=mysql_fetch_array($consulta))
			{
				echo "<option value='$rowa[valo_des]'>$rowa[nomb_des]";
			}
			echo" </select></td>";		
		?>  	
			<script language="javaScript">form1.opc_progu.value='<?echo $progu;?>';</script>
			

			 
			 
			 
		<?
			echo "<tr>";
			echo "<td class='Th0' width='15%'><strong>MEDICO SOLICITANTE:</td>";
			echo "<td  width='40%'><input type=text name=med_soli size=10 maxlength=20  onBlur='verfin(this,opc_meds)' value='$med_soli'>";
			echo" <select name=opc_meds onchange='verfin(this,med_soli)'><option value=''></option>";
			
			$consulta=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi FROM medicos ORDER BY medicos.nom_medi");
			while($rowa=mysql_fetch_array($consulta))
			{
				echo "<option value='$rowa[cod_medi]'>$rowa[nom_medi]";
			}
			?><script language="javaScript">form1.opc_meds.value='<?echo $med_soli;?>';</script><?
			echo" </select></td>";
			
			if($bd==1)
			{
				echo "<td class='Th0'><b>Nº. ORDEN</td><td><input type=text name=num_ord onblur='comprueba()' value=$num_ord ></td>";
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
			}
			else
			{
				echo "<input type=hidden name=band value=0>";
				echo "<td class='Th0'><b>Nº. ORDEN</td><td><input type=hidden name=num_ord size=10 maxlength=20 value=$num_ord>$num_ord</td>";
			}
			
			echo "<tr><td  width='5%' class='Th0' aling='right'><b>DX</td>";
						
			$cadcie1=Mysql_query("select nom_cie10 from cie_10 where cod_cie10='$cod_cie'");
			 while ($rowcie1=mysql_fetch_array($cadcie1))
			   {
				   $desp=$rowcie1['nom_cie10'];
				 
			   }
			echo"<td><input type='text' id='course' class='texto' name='des_cie10' size='70' value='$desp'>
			<input type='text' id='course_val' name='cod_cie' value='$cod_cie' size=4 maxlength=4 onkeyDown='verfin2(this,des_cie10)'></td>";
			
			?><script language="javaScript">form1.cod_cie.value='<?echo $cod_cie;?>';</script><?
			
			if($cod_cie=='PR01')
			{
				echo"<tr>
				<td  width='5%' class='Th0' aling='right'><b>OBSERVACIONES</td>
				<td colspan=4><input type='text' name='obs_dx' size='120' maxlength=50  value='$obs_dx'  onblur='comprueba2()'>";
				echo " <input type='hidden' name='eva_dx' value=$eva_dx>";
				?><script language="javaScript">form1.obs_dx.value='<?echo $obs_dx;?>';</script><?
			}
			else
			{
			
				echo " <input type='hidden' name='eva_dx' value=0>";
			
			}
			echo"</td>";
			
			echo "<td  width='5%' class='Th0' aling='right'><b>SERVICIO</td>
			<td  width='35%'><input type=text name=servi size=2 maxlength=2  onBlur='verfin(this,opc_servi)' value='$servi'>";
			echo" <select name=opc_servi onchange='verfin(this,servi)'><option value=''></option>";
			$consultasr=mysql_query("SELECT codi_des,codt_des,nomb_des,valo_des FROM `destipos` WHERE codt_des='06' order by nomb_des");
			while($rowsr=mysql_fetch_array($consultasr))
			{
				echo "<option value='$rowsr[codi_des]'>$rowsr[nomb_des]";
			}
			echo" </select></td>";		
		 	
			?><script language="javaScript">form1.opc_servi.value='<?echo $servi;?>';</script><?
			
			
			echo"</tr></table>";		

			
			echo"<br><table class='Tbl0'>
			<tr><td class='Td1' align='center'><STRONG>RIPS PROCEDIMIENTOS DE LABORATORIO</strong></td></tr>
			</table>";
			
			
			if(empty($fin))$fin=0;
			//echo "<input type=hidden name=fin value=$fin>";
			   
			///////////////////////////////////XRA INGRESAR CODIGO CUPS///////////////////////////////////////////////////////////////////////////////////////
			
			echo "<br><table class='Tbl0' border=1>";
			echo "<tr><td class='Th0' width='5%'><strong>SEL</td>
					  <td class='Th0' width='5%'><strong>RMTD</td>
					  <td class='Th0' width='10%'><strong>CODIGO</td>
					  <td class='Th0' width='80%'><strong>ESTUDIO / PROCEDIMIENTO</td>";
                        echo"</tr>";
					
					  
			if(empty($h))$h=0;
                        for($j=0;$j<$h;$j++)
                        {

                                    echo "<tr>";
                                    echo "<td class='Td4'>";
                                    $nomvar='seli_'.$j;
                                    $seli_=$$nomvar;
                                    echo"<input type=checkbox name='$nomvar' value=1 checked>";
                                    echo"</td>";    
                                    $nomvar='rmt_'.$j;
                                    $rmt_=$$nomvar;
                                    echo"<input type=checkbox name='$nomvar' value=1 checked>";
                                    echo"</td>";               
                                    $nomvar='cod_cups'.$j;
                                    $cod_cups=$$nomvar;
                                    echo"<td align=rigth><input type=hidden name='$nomvar' value='$cod_cups'>$cod_cups</td>";	     
                                    $cons_cups=mysql_query("SELECT iden_tar, codigo, descrip FROM cups WHERE codigo='$cod_cups' and tipo='1801'");
                                    $rownom=mysql_fetch_array($cons_cups);
                                    $nomvar='nomb_cups'.$j;
                                    $nomb_cups=$rownom[descrip];
                                    echo"<td><input type=hidden name='$nomvar' value='$nomb_cups'>$nomb_cups</td>";

                                                       

                            }  
                            $cons_cups=mysql_query("SELECT iden_tar, codigo, descrip FROM cups WHERE codigo='$cod_cp' and tipo='1801'");
                            while ($rownom=mysql_fetch_array($cons_cups))
                            {
                                $des_cup=$rownom[descrip];
                            }
                            echo"</tr>";
                            echo"<tr><td class=Th0></td><td class=Th0></td>";
                            echo"<td class=Th0 align=rigth><input id=cod_cup type=text name='cod_cp' size=9 maxlength=9 onkeyDown='busqueda()' value='$cod_cp'></td>";
                            echo"<td class=Th0 align='rigth'><textarea id=nom_cup name='des_cup' rows=2 cols=50 onkeypress='pasar(3)'>$des_cup</textarea></td>";  

                           
                            echo"<td class=Th0><input type=button name='adiciona3' value='...' onclick='agregar3()'></td>";

                            echo"<input type=hidden name=h value='$h'>";	
                            echo "</tr></table>";

                            $nomvar='seli_'.$h;
                            echo "<input type=hidden name='$nomvar'>";
                            $nomvar='cod_cups'.$h;
                            echo "<input type=hidden name='$nomvar'>";
                            $nomvar='nomb_cups'.$h;
                            echo "<input type=hidden name='$nomvar'>";
                            
                        }

                }
         }
                                echo "<input type=hidden name=evalua>";
                                echo "<input type=hidden name=control value=$control>";
                                echo "<input type=hidden name=iden_labs value=$iden_labs>";
                                echo "<input type=hidden name=cod value=$codig_usu>";
                                echo "<input type=hidden name=nord_lab value=$num_ord>";
                                //echo "<input type=hidden name= value=$num_ord>";
	
	?>
<br><br>
<table class='Tbl2'>
    <tr>
    <td class='Td1' width='45%'><a href='#' onclick='regresar2()'><img  width=20 height=20 src='icons\regresar01.jpg' alt='Regresar' border=0 align='center'>Regresar</a></td>
     </tr>
</table>
 <input type='hidden' name='cont' value='<?echo $cont;?>'> 
 <input type='hidden' name='format'>

 


</form>
</body>
</html>
