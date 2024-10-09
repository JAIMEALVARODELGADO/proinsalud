<?PHP
session_start();
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
}
 foreach($_GET as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
}
$Gareanh=$_SESSION['Gareanh'];
$Gcod_mediconh=$_SESSION['Gcod_mediconh'];
$rango=$_SESSION['rangoip'];


//echo 'r '.$rango;
//echo $Gcod_mediconh.' '.$Gareanh;
//$Gareanh='61';
//$_SESSION['Gareanh']=$Gareanh;
//echo $Gcod_mediconh;

echo $Gareanh.' '.$Gcod_mediconh;

?>
<HTML>
<HEAD>
<meta http-equiv="Refresh" content="60">

<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" />  
  <script type="text/javascript" src="java/calendar/calendar.js"></script> 
  <script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script>
  <script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 


<link rel="stylesheet" href="style.css" type="text/css"/>
<TITLE>AGENDA MEDICA</TITLE>
<SCRIPT LANGUAGE="JavaScript">
	//jlm.resizeTo(1000,600)
	//jlm.moveTo(centroAlto,centroAncho)
	function cambio()
	{
		top.document.getElementById("marco").setAttribute("cols", "0,*"); 
	}
	function salir(cit,usu,contr,serv,op)
	{
		/*
		uno.opcion.value=op;
		alert("1");
		uno.cita.value=cit;
		alert("2");
		uno.codusu.value=usu;
		alert("3");
		uno.servicio.value=serv;
		alert("4");
		uno.contra.value=contr;
		alert("5");
		*/
		
		uno.opcion.value=op;
		uno.cita.value=cit;
		uno.codusu.value=usu;
		uno.servicio.value=serv;
		uno.contra.value=contr;
		uno.target='area';
		uno.action="paso_lista_menu.php";
		uno.submit();
		url_='muestra_historico.php?codi_usu='+usu;
		window.open(url_,'blank_','height=500,width=1300,top=250,left=200,status=no,directories=no,menubar=no,toolbar=no,location=no,titlebar=no');		
	}
	//para anestesiologia
	function salir8(cit,usu,contr,serv,op,vltresanes)
	{
		uno.opcion.value=op;
		uno.cita.value=cit;
		uno.codusu.value=usu;
		uno.servicio.value=serv;
		uno.contra.value=contr;
		uno.contdolor.value=vltresanes;
		
		//alert(uno.codusu.value);
		
		uno.target='area';
		uno.action='paso_lista_menu.php';
		uno.submit();
		url_='muestra_historico.php?codi_usu='+usu;
		//alert(url_);
		window.open(url_,'blank_','height=500,width=1300,top=250,left=200,status=no,directories=no,menubar=no,toolbar=no,location=no,titlebar=no');		
	}	
	
	function inasis(cit,usu)
	{
		var respuesta = confirm("�Registrar consulta como inasistencia?");
        if (respuesta==false)return;		
		uno.cita.value=cit;
		uno.codusu.value=usu;
		uno.target='';
		uno.action='inasistencia.php';
		uno.submit();			
	}
	function aiepi(cit,usu,contr,medico,area,op)
	{		
		/*uno.cita.value=cit;
		uno.codusu.value=usu;
		uno.contra.value=contr;
		uno.target='TOP';
		uno.action='../aiepi/historia_aiepi_index.php';
		uno.submit();*/
		
		uno.cita.value=cit;
		uno.codusu.value=usu;
		uno.contra.value=contr;	

// ________________________________________________ESTE AJUSTE SE REALIZA POR AIEPI NUEVA VERSION		
//		pagina = '../aiepi/historia_aiepi.php?cita='+cit+'&codusu='+usu+'&contra='+contr+'&medi='+medico+'&area='+area;	
		pagina = '../aiepispo/distribuye_aiepi.php?cita='+cit+'&codusu='+usu+'&contra='+contr+'&medi='+medico+'&area='+area;	
//		pagina = '../aiepispo/distribuye_aiepi.php?cita='+id_cita+'&codusu='+cod_pacie+'&contra='+cont_pacie+'&medi='+medico+'&area='+area;    		
//_________________________________________________HASTA AQUI AJUESTE AIEPI___________________		
		
		var ancho = screen.width;
		var alto  = screen.height;            
		window.open(pagina,"AIEPI","width="+ancho+",height="+alto+",left=340,top=150");	
	}
	function cronicos(cit,usu,contr,medico,area,op)
	{		
		//alert(medico);
		uno.cita.value=cit;
		uno.codusu.value=usu;
		uno.contra.value=contr;	
		
		pagina = '../pcronicos/revi_medica.php?cita='+cit+'&codusu='+usu+'&contra='+contr+'&medi='+medico+'&area='+area;	
		
		var ancho = screen.width;
		var alto  = screen.height;            
		window.open(pagina,"ERCV","width="+ancho+",height="+alto+",left=340,top=150");	
	}
	function veragenda()
	{
		if(uno.codmedi.value=='')
		{
			alert("Seleccione el médico");
			uno.nommedi.focus();
			return;			
		}
		
		if(uno.fechaini.value=='')
		{
			alert("Seleccione la fecha");
			uno.fechaini.focus();
			return;			
		}			
		uno.action='../nuevocitas/agendamed1.php';
		uno.target='TOP';
		uno.submit();			
		
	}
</script>
</head>
<body onload='cambio()'>

<?PHP	
	//echo $Gareanh;
	
	$archivo0='tmp/lista.txt';		
	if(file_exists($archivo0))
	{
		$fp = fopen ($archivo0, "r" );
		$reg=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{				
			foreach($data as $dato)
			{
				$campo[$reg]=$dato;
				//echo $dato;
				$reg++;
			}
			//echo $reg;
		}
		fclose ($fp);
	}
	//if($Gcod_mediconh=='98396211')$fecha='2014-01-01';
	//else 
	$fecha=date("Y-m-d");	
    $hora=date("H-i");
	include('php/conexion.php');
	$bage=mysql_query("SELECT menu.descr_men, menu.url_men, menu.img_men, menuxusu.ide_usua, menu.nivel_men, menu.depen_men, menu.ord_men
	FROM menu INNER JOIN menuxusu ON menu.codi_men = menuxusu.codi_men
	WHERE (((menuxusu.ide_usua)='$Gcod_mediconh') AND ((menu.codi_men)='410'))");
	$respu=0;
	while($rage=mysql_fetch_array($bage))
	{
		$respu=1;
	}
	
	
	include ('php/conexion1.php');
	$bes=mysql_query("select espe_med from medicos where cod_medi='$Gcod_mediconh'");
	while($res=mysql_fetch_array($bes))
	{
		$espe=$res['espe_med'];
	}
	echo"<form name=uno method=post>
	<input type=hidden name=cita>
	<input type=hidden name=codusu>
	<input type=hidden name=contra>
	<input type=hidden name=opcion>
	<input type=hidden name=servicio>
	<input type=hidden name=codmedi value='$Gcod_mediconh'>
	<input type=hidden name=origmed=1>";	
	//para anesteciologia
	echo"<input type=hidden name=contdolor>";
	//fin anesteciol	
	if ($Gareanh=="81") //Programa de hipertension
	{
	    $cad=mysql_query("SELECT citas.tipo_consulta, citas.id_cita, usuario.SEXO_USU, usuario.FNAC_USU, citas.Idusu_citas, citas.Esta_cita, 
		esta_cita.descrip_estaci, usuario.NROD_USU, usuario.TRES_USU, usuario.TEL2_USU, usuario.EMAI_USU, citas.Cotra_citas, usuario.PNOM_USU, 
		usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, areas.nom_areas, areas.equi_area, medicos.nom_medi, citas.Clase_citas, 
		horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, citas.Idusu_citas, 
		horarios.Cmed_horario, citas.Clase_citas, horarios.Cserv_horario
		FROM (medicos INNER JOIN (usuario INNER JOIN (esta_cita INNER JOIN (horarios INNER JOIN citas ON (horarios.ID_horario = citas.ID_horario) AND (horarios.ID_horario = citas.ID_horario) AND (horarios.ID_horario = citas.ID_horario)) ON esta_cita.cod_estaci = citas.Esta_cita) ON usuario.CODI_USU = citas.Idusu_citas) ON medicos.cod_medi = horarios.Cmed_horario) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas
		WHERE (((citas.Clase_citas)<'6') AND ((citas.Esta_cita)<>'4') AND ((citas.Esta_cita)<>'2') AND ((horarios.Hora_horario)='$fecha') AND ((horarios.Cmed_horario)='$Gcod_mediconh') and horarios.Cserv_horario='81')
		ORDER BY areas.nom_areas, horarios.Fecha_horario DESC , horarios.Hora_horario;");	
		
	}
	if ($Gareanh==="04")	// URGENCIAS
	{
		$cad=mysql_query("SELECT citas.tipo_consulta, citas.id_cita,triage_urgencias.mrsk_tri,triage_urgencias.dest_tri,triage_urgencias.tipo_tri, 
		usuario.SEXO_USU, usuario.FNAC_USU, usuario.TRES_USU, usuario.TEL2_USU, usuario.EMAI_USU, citas.Idusu_citas, citas.Esta_cita, 
		esta_cita.descrip_estaci, usuario.NROD_USU, citas.Cotra_citas, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, 
		areas.nom_areas, areas.equi_area, medicos.nom_medi, citas.Clase_citas, triage_urgencias.clas2_tri, triage_urgencias.usua2_tri, triage_urgencias.clas_tri, 
		horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, citas.Idusu_citas, citas.Esta_cita
		FROM triage_urgencias INNER JOIN (medicos INNER JOIN ((horarios INNER JOIN (usuario INNER JOIN (esta_cita INNER JOIN citas ON esta_cita.cod_estaci = citas.Esta_cita) ON usuario.CODI_USU = citas.Idusu_citas) ON horarios.ID_horario = citas.ID_horario) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) ON medicos.cod_medi = horarios.Cmed_horario) ON triage_urgencias.iden_cita = citas.id_cita
		WHERE (((triage_urgencias.dest_tri)='U') AND ((citas.Esta_cita)<>'4') AND ((citas.Esta_cita)<>'2') AND ((citas.Clase_citas)<'6') AND ((horarios.Cserv_horario)='$Gareanh') AND ((horarios.Fecha_horario)='$fecha') AND ((horarios.Cmed_horario)='1101'))
		ORDER BY triage_urgencias.clas2_tri, triage_urgencias.clas_tri, horarios.Fecha_horario DESC , horarios.Hora_horario");				
		//$are='URGENCIAS';		
	}
	if ($Gareanh=="01") //MEDICINA GENERAL
	{
		$cad=mysql_query("SELECT citas.tipo_consulta, citas.id_cita, usuario.SEXO_USU, usuario.FNAC_USU, citas.Idusu_citas, citas.Esta_cita, 
		esta_cita.descrip_estaci, 
		usuario.NROD_USU, citas.Cotra_citas, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, areas.nom_areas,  areas.equi_area, usuario.TRES_USU, usuario.TEL2_USU, usuario.EMAI_USU,
		medicos.nom_medi, citas.Clase_citas, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, 
		citas.Idusu_citas, citas.Esta_cita
		FROM medicos INNER JOIN (areas INNER JOIN (horarios INNER JOIN (usuario INNER JOIN (citas INNER JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci) ON usuario.CODI_USU = citas.Idusu_citas) ON horarios.ID_horario = citas.ID_horario) ON areas.cod_areas = horarios.Cserv_horario) ON medicos.cod_medi = horarios.Cmed_horario
		WHERE ((citas.Clase_citas)<'6')AND ((citas.Esta_cita)<>'4') AND ((citas.Esta_cita)<>'2') AND 
		((horarios.Fecha_horario)='$fecha') AND ((horarios.Cmed_horario)='$Gcod_mediconh')
		ORDER BY horarios.Fecha_horario DESC , horarios.Hora_horario, areas.nom_areas");
	}	
	if ($Gareanh=="03") // QUIROFANO
	{		
		$cad=mysql_query("SELECT citas.tipo_consulta, citas.id_cita, usuario.SEXO_USU, usuario.FNAC_USU, citas.Idusu_citas, citas.Esta_cita, 
		esta_cita.descrip_estaci, 
		usuario.NROD_USU, citas.Cotra_citas, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, areas.nom_areas, areas.equi_area, usuario.TRES_USU, usuario.TEL2_USU, usuario.EMAI_USU,
		medicos.nom_medi, citas.Clase_citas, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, 
		citas.Idusu_citas, citas.Esta_cita
		FROM medicos INNER JOIN (areas INNER JOIN (horarios INNER JOIN (usuario INNER JOIN (citas INNER JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci) ON usuario.CODI_USU = citas.Idusu_citas) ON horarios.ID_horario = citas.ID_horario) ON areas.cod_areas = horarios.Cserv_horario) ON medicos.cod_medi = horarios.Cmed_horario
		WHERE ((citas.Clase_citas)<'6')AND ((citas.Esta_cita)<>'4') AND ((citas.Esta_cita)<>'2') AND 
		((horarios.Fecha_horario)='$fecha') AND ((horarios.Cmed_horario)='1102')
		ORDER BY horarios.Fecha_horario DESC , horarios.Hora_horario, areas.nom_areas");	
	}	
	if ($Gareanh=="894") //QUIMIOTERAPIA
	{		
		$cad=mysql_query("SELECT citas.tipo_consulta, citas.id_cita, usuario.SEXO_USU, usuario.FNAC_USU, citas.Idusu_citas, citas.Esta_cita, 
		esta_cita.descrip_estaci, 
		usuario.NROD_USU, citas.Cotra_citas, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, areas.nom_areas, areas.equi_area, usuario.TRES_USU, usuario.TEL2_USU, usuario.EMAI_USU,
		medicos.nom_medi, citas.Clase_citas, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, 
		citas.Idusu_citas, citas.Esta_cita
		FROM medicos INNER JOIN (areas INNER JOIN (horarios INNER JOIN (usuario INNER JOIN (citas INNER JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci) ON usuario.CODI_USU = citas.Idusu_citas) ON horarios.ID_horario = citas.ID_horario) ON areas.cod_areas = horarios.Cserv_horario) ON medicos.cod_medi = horarios.Cmed_horario
		WHERE ((citas.Clase_citas)<'6')AND ((citas.Esta_cita)<>'4') AND ((citas.Esta_cita)<>'2') AND 
		((horarios.Fecha_horario)='$fecha') AND ((horarios.Cmed_horario)='1104')
		ORDER BY horarios.Fecha_horario DESC , horarios.Hora_horario, areas.nom_areas");
	}
	if ($Gareanh=="219") //UCI NEONATOS
	{		
		$cad=mysql_query("SELECT citas.tipo_consulta, citas.id_cita, usuario.SEXO_USU, usuario.FNAC_USU, citas.Idusu_citas, citas.Esta_cita, esta_cita.descrip_estaci, 
		usuario.NROD_USU, citas.Cotra_citas, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, areas.nom_areas, areas.equi_area, usuario.TRES_USU, usuario.TEL2_USU, usuario.EMAI_USU,
		medicos.nom_medi, citas.Clase_citas, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, 
		citas.Idusu_citas, citas.Esta_cita
		FROM medicos INNER JOIN (areas INNER JOIN (horarios INNER JOIN (usuario INNER JOIN (citas INNER JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci) ON usuario.CODI_USU = citas.Idusu_citas) ON horarios.ID_horario = citas.ID_horario) ON areas.cod_areas = horarios.Cserv_horario) ON medicos.cod_medi = horarios.Cmed_horario
		WHERE ((citas.Clase_citas)<'6')AND ((citas.Esta_cita)<>'4') AND ((citas.Esta_cita)<>'2') AND 
		((horarios.Fecha_horario)='$fecha') AND ((horarios.Cmed_horario)='1103')
		ORDER BY horarios.Fecha_horario DESC , horarios.Hora_horario, areas.nom_areas");	
	}
	if ($Gareanh==="004") //COVID
	{
		$cad=mysql_query("SELECT citas.tipo_consulta, citas.id_cita, usuario.SEXO_USU, usuario.FNAC_USU, citas.Idusu_citas, citas.Esta_cita, esta_cita.descrip_estaci, 
		usuario.NROD_USU, citas.Cotra_citas, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, areas.nom_areas, areas.equi_area, usuario.TRES_USU, usuario.TEL2_USU, usuario.EMAI_USU,
		medicos.nom_medi, citas.Clase_citas, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, 
		citas.Idusu_citas, citas.Esta_cita
		FROM medicos INNER JOIN (areas INNER JOIN (horarios INNER JOIN (usuario INNER JOIN (citas INNER JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci) ON usuario.CODI_USU = citas.Idusu_citas) ON horarios.ID_horario = citas.ID_horario) ON areas.cod_areas = horarios.Cserv_horario) ON medicos.cod_medi = horarios.Cmed_horario
		WHERE ((citas.Clase_citas)<'6')AND ((citas.Esta_cita)<>'4') AND ((citas.Esta_cita)<>'2') AND 
		((horarios.Fecha_horario)='$fecha') AND ((horarios.Cmed_horario)='$Gcod_mediconh') and horarios.Cserv_horario='004'
		ORDER BY horarios.Fecha_horario DESC , horarios.Hora_horario, areas.nom_areas");	
	}
	if ($Gareanh !=="01" && $Gareanh !=="04" && $Gareanh !=="81" && $Gareanh !=="03" && $Gareanh !=="219" && $Gareanh !=="894" && $Gareanh !=="004")
	{
		$cad=mysql_query("SELECT citas.tipo_consulta, citas.id_cita, usuario.SEXO_USU, citas.Idusu_citas, citas.Esta_cita, esta_cita.descrip_estaci, 
		usuario.NROD_USU, usuario.FNAC_USU, citas.Cotra_citas, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.TRES_USU, usuario.TEL2_USU, usuario.EMAI_USU,
		areas.nom_areas, areas.equi_area, medicos.nom_medi, citas.Clase_citas, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, 
		horarios.Cmed_horario, citas.Idusu_citas, citas.Esta_cita, citas.primera_cita
		FROM medicos INNER JOIN (areas INNER JOIN (horarios INNER JOIN (usuario INNER JOIN (esta_cita INNER JOIN citas ON 
		esta_cita.cod_estaci = citas.Esta_cita) ON usuario.CODI_USU = citas.Idusu_citas) ON horarios.ID_horario = citas.ID_horario) ON 
		areas.cod_areas = horarios.Cserv_horario) ON medicos.cod_medi = horarios.Cmed_horario		
		WHERE (((citas.Clase_citas)<'6') AND ((citas.Esta_cita)<>'4') AND ((citas.Esta_cita)<>'2') AND ((horarios.Fecha_horario)='$fecha') AND 
		((horarios.Cmed_horario)='$Gcod_mediconh'))
		ORDER BY horarios.Fecha_horario DESC , horarios.Hora_horario, areas.nom_areas;
		");
		//$are='CONSULTA ESPECIALISTAS';
	}
	echo"<table align=center class='tbl' width=95%>		
	<tr>";
	if($respu==0)
	{
		echo"<th colspan=10 valign=center align=center height=40>LISTADO DE PACIENTES</th>";		
	}
	else
	{
		echo"<th colspan=8 valign=center align=center width=70% height=40>LISTADO DE PACIENTES</th>";
		echo"<th colspan=2 valign=center width=30% height=40> VER AGENDA ";
		
		?>
        <input type="text" name="fechaini" class='caja'  size="10" maxlength="10" value="<?echo $fechaini;?>" id="fini" <?echo $disp;?>>
        <input type="button" class='caja' id="lanzador1" name="bot1" value="..." <?echo $disp;?>/>
        <!-- script que define y configura el calendario--> 
        <script type="text/javascript"> 
        Calendar.setup({ 
        inputField     :    "fini",     // id del campo de texto 
        ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
        button     :    "lanzador1"     // el id del botón que lanzará el calendario 				
        }); 
        </script> 				
        <?		
		echo"	
		<input type=button class=boton onclick='veragenda()' value='>>'></th>";
	}
	
	echo"</tr>
	</table><br>";
	//if(mysql_num_rows($cad)>0)
	//{
		//echo "aqui";
        $busare=mysql_query("select * from areas where cod_areas='$Gareanh'");
		while($resare=mysql_fetch_array($busare))
		{
			$nare=$resare['nom_areas'];
		}
		echo"<table align=center class='tbl' width=95%>			
		<tr>";
		if($espe!='2656')
		{
//para anesteciologia			
			if($Gareanh=='62' || $Gareanh=='324')
			{
				echo"<th>DOLOR</th>";
				echo"<th>ANESTESIA</th>";
			}	
	//fin anes			
			else
			{	
				echo"<th>CONSULTA</th>";
			}	
		}
		echo"
		<th>IDENTIFICACION</th>
		<th>AREA</th>
		<th>HORA</th>
		<th>FECHA</th>
		<th>NOMBRE</th>	
		<th>EDAD</th>
		<th>TELEFONO</th>
		<th>EMAIL</th>
		<th>CONTRATO</th>		
		<th>TIPO CONSULTA</th>
		<th>ESTADO</th>";
		if ($Gareanh=="04")
		{				
			echo"<th>PRIORIDAD</th>";
			if($espe!='2656')
			{
				echo"<th>INASISTENCIA</th>";
			}
		}
		else
		{
			echo"<th>INASISTENCIA</th>";
		}
		echo"</tr>";
		$idcitaant='NOHABIL';		
		while($row=mysql_fetch_array($cad))
		{			
			$idcita=$row['id_cita'];
			$sexo=$row['SEXO_USU'];
			$codiusu=$row['Idusu_citas'];
			$estacita=$row['Esta_cita'];
			$descestdocita=$row['descrip_estaci'];
			$cedula=$row['NROD_USU'];
			$contrato=$row['Cotra_citas'];
			$nombre=$row['PNOM_USU'].' '.$row['SNOM_USU'].' '.$row['PAPE_USU'].' '.$row['SAPE_USU'];
			$nomarea=$row['nom_areas'];		
			$equi_area=$row['equi_area'];		
			$nommedi=$row['nom_medi'];
			$clasecita=$row['Clase_citas'];
			$claseservicio=$row['Cserv_horario'];
			$fechahorario=$row['Fecha_horario'];
			$horahorario=$row['Hora_horario'];			
			$cmedhoario=$row['Cmed_horario'];
			$fnac=$row['FNAC_USU'];
			$edadpac=calculaedad($fnac);
			$anospac=edadpaciente($fnac);			
			$priori=$row['clas_tri'];
			$clasitri=$row['clas2_tri'];
			$usuatri=$row['usua2_tri'];
			$primera_cita=$row['primera_cita'];
			$cls_trg=$row['tipo_tri'];
			$mrsk_tri=$row['mrsk_tri'];
			$tipo_consulta=$row['tipo_consulta']; 
			$tel1usu=$row['TRES_USU'];
			$tel2usu=$row['TEL2_USU'];
			$emaiusu=$row['EMAI_USU'];
			
			
			if($tipo_consulta=='V')$tipo_consu='VIRTUAL';
			else $tipo_consu='';
			
			
			$bcon=mysql_query("select * from contrato where CODI_CON = '$contrato'");
			$rcon=mysql_fetch_array($bcon);
			$nomcontra=$rcon['NEPS_CON'];
			
			$hora=substr($horahorario,11,5);
			$aten=0;			
			for($t=1;$t<=8;$t++)
			{
				$archivo='tmp/'.$t.'HC'.$numcita.'-'.$codiusu.'.txt';
				if(file_exists($archivo))
				{
					$descestdocita="EN ATENCION";
				}		
			}			
			$archi='../aiepi/historia/tmp/AIEPI_INI'.$codiusu.'.txt';
//echo $archi;			
			if(file_exists($archi))
			{				
				$descestdocita="EN ATENCION";
			}
			echo"<tr>";
			
			//if($espe!='2656')
			//{
				if ($Gareanh=="04")
				{
					$ocupa='NO';				
					for($i=0;$i<$reg;$i++)
					{
						$nn=$campo[$i];
						//echo $nn.' - '.$idcita.'<br>';
						if($campo[$i]==$idcita)
						{
							$ocupa='SI';
						}
					}
					//if($ocupa=='SI' && $descestdocita!="EN ATENCION")
					//{	
						//$descestdocita='ACTIVAR';
					//}					
					//if($idcitaant=='NOHABIL' && $ocupa=='NO' && $descestdocita=='ESPERA')
					//{     
                                                //echo $clasitri;
						if($clasitri=="1")
						{					
							if($anospac>=5)echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",\"$claseservicio\",1)' target='area'><img src='imagenes/next_rojo.jpg' border=0></a></td>";
							else echo"<td align=center><a href='#' onclick='aiepi($idcita,$codiusu,\"$contrato\",\"$Gcod_mediconh\",\"$Garea\",1)' target='area'><img src='imagenes/next_rojo.jpg' border=0></a></td>";
						}
						else if($clasitri=="2")
						{					
							if($anospac>=5) echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",\"$claseservicio\",1)' target='area'><img src='imagenes/next_naran.jpg' border=0></a></td>";
							else echo"<td align=center><a href='#' onclick='aiepi($idcita,$codiusu,\"$contrato\",\"$Gcod_mediconh\",\"$Garea\",1)' target='area'><img src='imagenes/next_naran.jpg' border=0></a></td>";
						}
						else
						{					
							if($anospac>=5) echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",\"$claseservicio\",1)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
							else echo"<td align=center><a href='#' onclick='aiepi($idcita,$codiusu,\"$contrato\",\"$Gcod_mediconh\",\"$Garea\",1)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
						}
						$idcitaant='SIHABIL';
					//}
					/*
					else
					
					{					
						if($descestdocita=='EN ATENCION')
						{
							if($clasitri=="1")
							{					
								if($anospac>0)echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",1)' target='area'><img src='imagenes/next_rojo.jpg' border=0></a></td>";
								else echo"<td align=center><a href='#' onclick='aiepi($idcita,$codiusu,\"$contrato\",1)' target='area'><img src='imagenes/next_rojo.jpg' border=0></a></td>";
							}
							else if($clasitri=="2")
							{					
								if($anospac>0)echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",1)' target='area'><img src='imagenes/next_naran.jpg' border=0></a></td>";
								else echo"<td align=center><a href='#' onclick='aiepi($idcita,$codiusu,\"$contrato\",1)' target='area'><img src='imagenes/next_naran.jpg' border=0></a></td>";
							}
							else
							{					
								if($anospac>5)echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",1)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
								else echo"<td align=center><a href='#' onclick='aiepi($idcita,$codiusu,\"$contrato\",1)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
							}
							//$idcitaant='SIHABIL';
						}						
						else
						{
							if($clasitri=="1")
							{					
								echo"<td align=center><a href='#'><img src='imagenes/next_rojo_no.jpg' border=0></a></td>";
							}
							else if($clasitri=="2")
							{					
								echo"<td align=center><a href='#'><img src='imagenes/next_naran_no.jpg' border=0></a></td>";
							}
							else
							{					
								echo"<td align=center><a href='#'><img src='imagenes/next_no.jpg' border=0></a></td>";
							}
						}					
					}
					*/
				}
				else
				{
					if($equi_area==82)
					{						
						if($anospac<5 && $Gcod_mediconh!='19012098')
                        echo"<td align=center><a href='#' onclick='aiepi($idcita,$codiusu,\"$contrato\",1)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
						else echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",\"$claseservicio\",1)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
					}
					else if($equi_area=='01' && $anospac<5)
					{
						echo"<td align=center><a href='#' onclick='aiepi($idcita,$codiusu,\"$contrato\",\"$Gcod_mediconh\",\"$Garea\",1)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
					}
					
//vich
//cambio para cronicos					
					/*
					else if($equi_area=='763' || $equi_area=='81')
					{
						$medic_=$Gcod_mediconh;
						echo"<td align=center><a href='#' onclick='cronicos($idcita,$codiusu,\"$contrato\",\"$medic_\",1)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
					}
					*/
//fin cambio para cronicos					
					else 
					{                                            //echo "aqui contrato";
						$busestado=mysql_query("SELECT ucontrato.CUSU_UCO, ucontrato.CONT_UCO, ucontrato.ESTA_UCO
						FROM ucontrato
						WHERE (((ucontrato.CUSU_UCO)='$codiusu') AND ((ucontrato.CONT_UCO)='$contrato'))");
						$ruco=mysql_fetch_array($busestado);
						if($ruco['ESTA_UCO']=='AC')
						{
//se comenta codigo para cronicos
							
							if($primera_cita=='S')
							{								
								$medic_=$Gcod_mediconh;
								echo"<td align=center><a href='#' onclick='cronicos($idcita,$codiusu,\"$contrato\",\"$medic_\",1)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
							}
							else
							{
								
								//para anesteciologia				
								if($Gareanh=='62'  || $Gareanh=='324')
								{
									$varanesdolor='1';
									echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",\"$claseservicio\",1)' target='area'><img src='imagenes/ndolor.jpg' border=0></a></td>";
									echo"<td align=center><a href='#' onclick='salir8($idcita,$codiusu,\"$contrato\",\"$claseservicio\",1,\"$varanesdolor\")' target='area'><img src='imagenes/naneste.jpg' border=0></a></td>";
								}
								//fin aneste			
								else
								{	
									echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",\"$claseservicio\",1)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
								}
							}
							
//fin comentario para cronicos 							
						}
						else
						{
							if($ruco['ESTA_UCO']=='SU')$est='SUSPENDIDO';
							if($ruco['ESTA_UCO']=='RE')$est='RETIRADO';
//para anesteciologia				
							if($Gareanh=='62'  || $Gareanh=='324')
							{
								echo"<td align=center><img src='imagenes/next_no.jpg' border=0 title=$est></td>";
							}
//fin aneste
							echo"<td align=center><img src='imagenes/next_no.jpg' border=0 title=$est></td>";
						}
					}
				}
			//}
			//$tel1usu
			//$tel2usu
			//$emaiusu
			
			$btip=mysql_query("SELECT TPAF_USU FROM usuario WHERE CODI_USU='$codiusu'");
			$rtip=mysql_fetch_array($btip);
			$tipafi=$rtip['TPAF_USU'];
			echo"<td align=center>$idcita - $cedula</td>
			<td align=center>$nomarea</td>
			<td align=center>$hora</td>
			<td>$fechahorario</td>
			<td>$nombre</td>
			<td>$edadpac</td>
			<td>$tel1usu - $tel2usu</td>
			<td>$emaiusu</td>
			<td>$nomcontra - $tipafi</td>
			<td>$tipo_consu</td>";
			if ($Gareanh=="04")
			{
				if($ocupa=='SI' && $descestdocita!="EN ATENCION")
				{				
					$val='LP';
					echo"<td><a href='regresa.php?iden_ci=$idcita&valregre=$val'>$descestdocita</td>";
				}
				else
				{				
					echo"<td>$descestdocita</td>";
				}
			}
			else
			{				
				echo"<td>$descestdocita</td>";
			}			
			if ($Gareanh=="04")
			{				
				$prioridad='';
				if($priori=="MA")$prioridad="MATERNA";
				if($priori=="NI")$prioridad="MENOR";
				if($priori=="TE")$prioridad="TERCERA EDAD";
				if($priori=="TO")$prioridad="";
				$color="#FFFFFF";
				if($clasitri=="AA")
				{					
					$prioridad="<B>".$prioridad."</B>";		
				}
				if($clasitri=="BB")
				{					
					$prioridad="<B>".$prioridad."</B>";		
				}
				echo"
				<td align=center>$prioridad";
				if($mrsk_tri=="B101")
				{
					echo"<B><img width=15% height=15% src='img/formatos/rojo.jpg'></B></td>";		
				}
				if($mrsk_tri=='B102')
				{					
					echo"<B><img width=15% height=15% src='img/formatos/amarillo.jpg'></B></td>";		
				}
				if($mrsk_tri=="B103")
				{
					echo"<B><img width=15% height=15% src='img/formatos/amarillo.jpg'></B></td>";		
				}
				if($mrsk_tri=="B104")
				{
					echo"<B><img width=15% height=15% src='img/formatos/verde.jpg'></B></td>";		
				}
				if($mrsk_tri=="B105")
				{
					echo"<B><img width=15% height=15% src='img/formatos/azul.jpg'></B></td>";		
				}
				if($usuatri!='')
				{				
					//echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",2)' target='area'><img src='imagenes/ok.png' border=0 width=10></a></td>";
				}
				else
				{				
					//echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",2)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
				}
				//if($espe!='2656')
				//{
					echo"<td align=center><a href='#' onclick='inasis($idcita,$codiusu)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
				//}
			}
			else
			{
				echo"<td align=center><a href='#' onclick='inasis($idcita,$codiusu)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
			}
			echo"</tr>";
			//$idcitaant=$idcita;
		}		
		echo"</	table>";
	//}		
	function calculaedad($fecha_){
	$ano_=substr($fecha_,0,4);
	$mes_=substr($fecha_,5,2);
	$dia_=substr($fecha_,8,2);
	if($mes_==2)
	{
    $diasmes_=28;}
	else
	{
		if($mes_==1 || $mes_==3 || $mes_==5 || $mes_==7 || $mes_==8 || $mes_==10 || $mes_==12){
		$diasmes_=31;}
		else{$diasmes_=30;}
	}
	$anos_=date("Y")-$ano_;
	$meses_=date("m")-$mes_;
	$dias_=date("d")-$dia_;    
	if($dias_<0)
	{
		if($meses_>0){$meses_=$meses_-1;}
		$dias_=$diasmes_+$dias_;
	}
	if($meses_<0){
    $meses_=12+$meses_;
    if(date("d")-$dia_<0){
	$meses_=$meses_-1;}
	$anos_=$anos_-1;
	}
  if($meses_==0 & date("d")-$dia_<0 & $anos_>0){
    if(date("m")-$mes_==0 & date("d")-$dia_<0){$anos_=$anos_-1;}
     $meses_=11;
  }
  if($anos_<>0)
  {
    $edad_=$anos_;
    if($edad_==1){
      $unidad_=" A�o";}
    else{
      $unidad_=" A�os";}
  }
  else
  {
    if($meses_<>0){
      $edad_=$meses_;
      if($edad_==1){
        $unidad_=" Mes";}
      else{
        $unidad_=" Meses";}
    }
    else{
      $edad_=$dias_;
      if($edad_==1){
        $unidad_=" D�a";}
      else{
        $unidad_=" D�as";}
    }
  }
  return($edad_.$unidad_);  
}
	function edadpaciente($fecha_nac)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en n�meros enteros
        $dia=date("d");
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
?>
</body>
</html>


