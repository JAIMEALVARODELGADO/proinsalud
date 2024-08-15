<?session_register('Gidusu');?>
<html>
<head>
<title>RIPS</title>
</head>

<SCRIPT LANGUAGE=JavaScript>

	function guarda()
	{
		var error='';
		//datos1=eval("form1.1.value");
		//datos2=eval("form1.2.value");
		//datos3=eval("form1.3.value");
		
		//if(datos1==''){
			//error=error+" Motivo de Rechazo1\n";}
		//if(datos2==''){
			//error=error+" Motivo de Rechazo2\n";}
		//if(datos3==''){
			//error=error+" Motivo de Rechazo3\n";}
			
		if(error!=''){
		alert('LA INFORMACION ES INCORRECTA O NO PUEDE DEJARLA VACIA \n'+error);
		return; }
		
		else{	
		//var mensaje = confirm("La informacion sera almacenada en la Base de Datos");
		//if(mensaje==false) return;
		form1.action='guar_rechaz.php';
		//form1.item.value=h;
		form1.submit();
		}
	}
</script>
	
<link rel="stylesheet" href="css/style.css" type="text/css" />

<form name="form1" method="POST" >
<body >
<?
		include('php/funciones.php');
		include('php/conexion.php');
		
		$link=Mysql_connect("localhost","root","");
		if(!$link){echo"no hay conexion";}
		Mysql_select_db('proinsalud',$link);
	
		echo"<input type=hidden name=area value=$area>";
		echo"<input type=hidden name=fec_pro value=$fec_pro>";
		echo"<input type=hidden name=amb_usu value=$amb_usu>";
		echo"<input type=hidden name=fin_con value=$fin_con>";
		echo"<input type=hidden name=codi_cir value=$codi_cir>";
		echo"<input type=hidden name=fin value=$fin>";
		echo "<input type=hidden name=codusu value=$codusu>";
		echo"<input type=hidden name=ide_cita value=$ide_cita>";
		
		echo"<table class='Tbl1'><tr><th class='Th0'>PACIENTE RECHAZADO </th></tr></table><br><br>";
		
		echo "<table class='Tbl0'>";
		echo "<tr><td class='Th0' width='15%'><strong>IDENTIFICACION</td>
		      <td class='Th0' width='50%'><strong>NOMBRE</td>
			  <td class='Th0' width='10%'><strong>EDAD</td>
			  <td class='Th0' width='10%'><strong>SEXO</td>
			  <td class='Th0' width='15%'><strong>CONTRATO</td></tr>";
	
			$conusu = mysql_query("SELECT NROD_USU,CODI_CON,CODI_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU,
							   TPAF_USU,CONT_UCO,NEPS_CON,IDEN_UCO,CUSU_UCO FROM usuario, ucontrato,contrato WHERE CODI_USU=CUSU_UCO AND CONT_UCO=CODI_CON 
							   AND CUSU_UCO ='$codusu'"); 
			
			$rowu = mysql_fetch_array($conusu);
			echo "<input type=hidden name=codusu value=$codusu>";
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
			
			echo "<table class='Tbl0'>";
			echo "<tr><td class='Th0' width='15%'><strong>MOTIVO DE RECHAZO</td></tr>";
			echo"<tr><td ><input type='radio' name=datos value='Falta De Preparación'>Falta De Preparación</td></tr>";
			echo"<tr><td><input type='radio' name=datos value='Mala Preparación'>Mala Preparación</td></tr>";
			echo "<tr><td><input type='radio' name=datos value='No Asistio'>No Asistio</td></tr></table>";
			
		//mysql_query("UPDATE citas SET Esta_cita='2' WHERE id_cita= '$ide_cita'") ;}

?>
<table class='Tbl2'>
    <tr>
      <td class='Td1' width='45%'><a href='list_trab.php' target=''><img hspace=0 width=15 height=15 src='img\feed_go-1.png' alt='Regresar' border=0 align='center'>Regresar</a></td>
	  <td class='Td1' width='45%'><a href='#' onclick='guarda()'><img hspace=0 width=15 height=15 src='img\f1eed_disk-1.png' alt='Guardar' border=0 align='center'>Guardar</a></td>
    </tr>
</table
</body>
</html>