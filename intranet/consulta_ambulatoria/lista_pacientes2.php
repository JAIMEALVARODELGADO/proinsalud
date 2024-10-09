<?
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
//ECHO $Gareanh;

?>
<HTML>
<HEAD>
<meta http-equiv="Refresh" content="60">
<link rel="stylesheet" href="style.css" type="text/css"/>
<TITLE>AGENDA MEDICA</TITLE>
<SCRIPT LANGUAGE="JavaScript">
	//jlm.resizeTo(1000,600)
	//jlm.moveTo(centroAlto,centroAncho)

	function cambio()
	{
		top.document.getElementById("marco").setAttribute("cols", "0,*"); 
	}
	function salir(cit,usu,contr,op)
	{
		uno.opcion.value=op;
		uno.cita.value=cit;
		uno.codusu.value=usu;
		uno.contra.value=contr;
		
		//alert(uno.codusu.value);
		
		uno.target='area';
		uno.action='paso_lista_menu.php';
		uno.submit();	
		
	}
	function inasis(cit,usu)
	{
		var respuesta = confirm("¿Registrar consulta como inasistencia?");
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
		
		pagina = '../aiepi/historia_aiepi.php?cita='+cit+'&codusu='+usu+'&contra='+contr+'&medi='+medico+'&area='+area;	
		
		var ancho = screen.width;
		var alto  = screen.height;            
		window.open(pagina,"AIEPI","width="+ancho+",height="+alto+",left=340,top=150");   
	
	}
</script>
</head>
<body onload='cambio()'>

<?	
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
	$fecha=date("Y-m-d");
    $hora=date("H-i");
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
	<input type=hidden name=origmed=1>
	";	
	if ($Gareanh=="81")
	{
	    $cad=mysql_query("SELECT citas.id_cita, usuario.SEXO_USU, usuario.FNAC_USU, citas.Idusu_citas, citas.Esta_cita, esta_cita.descrip_estaci, usuario.NROD_USU, citas.Cotra_citas, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, areas.nom_areas, medicos.nom_medi, citas.Clase_citas, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, citas.Idusu_citas, horarios.Cmed_horario, citas.Clase_citas, horarios.Cserv_horario
		FROM (medicos INNER JOIN (usuario INNER JOIN (esta_cita INNER JOIN (horarios INNER JOIN citas ON (horarios.ID_horario = citas.ID_horario) AND (horarios.ID_horario = citas.ID_horario) AND (horarios.ID_horario = citas.ID_horario)) ON esta_cita.cod_estaci = citas.Esta_cita) ON usuario.CODI_USU = citas.Idusu_citas) ON medicos.cod_medi = horarios.Cmed_horario) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas
		WHERE (((citas.Clase_citas)<'6') AND ((citas.Esta_cita)<>'4') AND ((citas.Esta_cita)<>'2') AND ((horarios.Cserv_horario)='$Gareanh') AND ((horarios.Hora_horario)='$fecha') AND ((horarios.Cmed_horario)='$Gcod_mediconh'))
		ORDER BY horarios.Fecha_horario DESC , horarios.Hora_horario;");	
		
	}
	if ($Gareanh=="04")
	{				
		$cad=mysql_query("SELECT citas.id_cita, triage_urgencias.dest_tri, usuario.SEXO_USU, usuario.FNAC_USU, citas.Idusu_citas, citas.Esta_cita, esta_cita.descrip_estaci, usuario.NROD_USU, citas.Cotra_citas, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, areas.nom_areas, medicos.nom_medi, citas.Clase_citas, triage_urgencias.clas2_tri, triage_urgencias.usua2_tri, triage_urgencias.clas_tri, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, citas.Idusu_citas, citas.Esta_cita
		FROM triage_urgencias INNER JOIN (medicos INNER JOIN ((horarios INNER JOIN (usuario INNER JOIN (esta_cita INNER JOIN citas ON esta_cita.cod_estaci = citas.Esta_cita) ON usuario.CODI_USU = citas.Idusu_citas) ON horarios.ID_horario = citas.ID_horario) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) ON medicos.cod_medi = horarios.Cmed_horario) ON triage_urgencias.iden_cita = citas.id_cita
		WHERE (((triage_urgencias.dest_tri)='U') AND ((citas.Esta_cita)<>'4') AND ((citas.Esta_cita)<>'2') AND ((citas.Clase_citas)<'6') AND ((horarios.Cserv_horario)<='$Gareanh') AND ((horarios.Fecha_horario)='$fecha') AND ((horarios.Cmed_horario)='1101'))
		ORDER BY triage_urgencias.clas2_tri, triage_urgencias.clas_tri, horarios.Fecha_horario DESC , horarios.Hora_horario");				
		//$are='URGENCIAS';		
	}
	if ($Gareanh=="01")
	{
		$cad=mysql_query("SELECT citas.id_cita, usuario.SEXO_USU, usuario.FNAC_USU, citas.Idusu_citas, citas.Esta_cita, esta_cita.descrip_estaci, 
		usuario.NROD_USU, citas.Cotra_citas, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, areas.nom_areas, 
		medicos.nom_medi, citas.Clase_citas, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, 
		citas.Idusu_citas, citas.Esta_cita
		FROM medicos INNER JOIN (areas INNER JOIN (horarios INNER JOIN (usuario INNER JOIN (citas INNER JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci) ON usuario.CODI_USU = citas.Idusu_citas) ON horarios.ID_horario = citas.ID_horario) ON areas.cod_areas = horarios.Cserv_horario) ON medicos.cod_medi = horarios.Cmed_horario
		WHERE ((citas.Clase_citas)<'6')AND ((citas.Esta_cita)<>'4') AND ((citas.Esta_cita)<>'2') AND ((horarios.Cserv_horario)='$Gareanh') AND ((horarios.Fecha_horario)='$fecha') AND ((horarios.Cmed_horario)='$Gcod_mediconh')
		ORDER BY horarios.Fecha_horario DESC , horarios.Hora_horario");
		
		/*
		ECHO "SELECT citas.id_cita, usuario.SEXO_USU, citas.Idusu_citas, citas.Esta_cita, esta_cita.descrip_estaci, 
		usuario.NROD_USU, usuario.FNAC_USU, citas.Cotra_citas, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, 
		areas.nom_areas, medicos.nom_medi, citas.Clase_citas, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, 
		horarios.Cmed_horario, citas.Idusu_citas, citas.Esta_cita
		FROM medicos INNER JOIN (areas INNER JOIN (horarios INNER JOIN (usuario INNER JOIN (esta_cita INNER JOIN citas ON esta_cita.cod_estaci = citas.Esta_cita) ON usuario.CODI_USU = citas.Idusu_citas) ON horarios.ID_horario = citas.ID_horario) ON areas.cod_areas = horarios.Cserv_horario) ON medicos.cod_medi = horarios.Cmed_horario
		WHERE (((citas.Clase_citas)<='5') AND ((citas.Esta_cita)<>'4') AND ((citas.Esta_cita)<>'2') AND ((horarios.Cserv_horario)='$Gareanh') AND ((horarios.Fecha_horario)='$fecha') AND ((horarios.Cmed_horario)='$Gcod_mediconh'))
		ORDER BY horarios.Fecha_horario DESC , horarios.Hora_horario;
		";
		*/
		
		
		//$are='MEDICINA GENERAL';
	}
	if ($Gareanh<>"01" and $Gareanh<>"04" and $Gareanh<>"81")
	{
		$cad=mysql_query("SELECT citas.id_cita, usuario.SEXO_USU, citas.Idusu_citas, citas.Esta_cita, esta_cita.descrip_estaci, 
		usuario.NROD_USU, usuario.FNAC_USU, citas.Cotra_citas, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, 
		areas.nom_areas, medicos.nom_medi, citas.Clase_citas, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, 
		horarios.Cmed_horario, citas.Idusu_citas, citas.Esta_cita
		FROM medicos INNER JOIN (areas INNER JOIN (horarios INNER JOIN (usuario INNER JOIN (esta_cita INNER JOIN citas ON esta_cita.cod_estaci = citas.Esta_cita) ON usuario.CODI_USU = citas.Idusu_citas) ON horarios.ID_horario = citas.ID_horario) ON areas.cod_areas = horarios.Cserv_horario) ON medicos.cod_medi = horarios.Cmed_horario
		WHERE (((citas.Clase_citas)<'6') AND ((citas.Esta_cita)<>'4') AND ((citas.Esta_cita)<>'2') AND ((horarios.Cserv_horario)='$Gareanh') AND ((horarios.Fecha_horario)>='2012-10-01') AND ((horarios.Cmed_horario)='$Gcod_mediconh'))
		ORDER BY horarios.Fecha_horario DESC , horarios.Hora_horario;
		");		
		//$are='CONSULTA ESPECIALISTAS';
	}		
	if(mysql_num_rows($cad)>0)
	{		
		$busare=mysql_query("select * from areas where cod_areas='$Gareanh'");
		while($resare=mysql_fetch_array($busare))
		{
			$nare=$resare['nom_areas'];
		}		
		echo"<table align=center class='tbl' width=95%>		
		<tr>
		<th colspan=10 valign=center align=center hwight=40>LISTADO DE PACIENTES $nare</th>
		</tr>
		</table><br>
		<table align=center class='tbl' width=95%>			
		<tr>";
		if($espe!='2656')
		{
			echo"<th>CONSULTA</th>";
		}
		echo"
		<th>IDENTIFICACION</th>
		<th>HORA</th>
		<th>FECHA</th>
		<th>NOMBRE</th>	
		<th>EDAD</th>		
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
			
			if($espe!='2656')
			{
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
					if($ocupa=='SI' && $descestdocita!="EN ATENCION")
					{	
						$descestdocita='ACTIVAR';
					}					
					//if($idcitaant=='NOHABIL' && $ocupa=='NO' && $descestdocita=='ESPERA')
					//{
						if($clasitri=="1")
						{					
							if($anospac>=5)echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",1)' target='area'><img src='imagenes/next_rojo.jpg' border=0></a></td>";
							else echo"<td align=center><a href='#' onclick='aiepi($idcita,$codiusu,\"$contrato\",\"$Gcod_mediconh\",\"$Garea\",1)' target='area'><img src='imagenes/next_rojo.jpg' border=0></a></td>";
						}
						else if($clasitri=="2")
						{					
							if($anospac>=5) echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",1)' target='area'><img src='imagenes/next_naran.jpg' border=0></a></td>";
							else echo"<td align=center><a href='#' onclick='aiepi($idcita,$codiusu,\"$contrato\",\"$Gcod_mediconh\",\"$Garea\",1)' target='area'><img src='imagenes/next_naran.jpg' border=0></a></td>";
						}
						else
						{					
							if($anospac>=5) echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",1)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
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
					if($Gareanh==82)
					{
						if($anospac<5)echo"<td align=center><a href='#' onclick='aiepi($idcita,$codiusu,\"$contrato\",1)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
						else echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",1)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
					}
					
					else 
					{
						$busestado=mysql_query("SELECT ucontrato.CUSU_UCO, ucontrato.CONT_UCO, ucontrato.ESTA_UCO
						FROM ucontrato
						WHERE (((ucontrato.CUSU_UCO)='$codiusu') AND ((ucontrato.CONT_UCO)='$contrato'))");
						$ruco=mysql_fetch_array($busestado);
						if($ruco['ESTA_UCO']=='AC')
						{
							echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",1)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
						}
						else
						{
							if($ruco['ESTA_UCO']=='SU')$est='SUSPENDIDO';
							if($ruco['ESTA_UCO']=='RE')$est='RETIRADO';
							echo"<td align=center><img src='imagenes/next_no.jpg' border=0 title=$est></td>";
						}
					}
				}
			}
			echo"<td align=center>$cedula</td>
			<td align=center>$hora</td>
			<td>$fechahorario</td>
			<td>$nombre</td>
			<td>$edadpac</td>";
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
				<td align=center>$prioridad</td>";
				if($usuatri!='')
				{				
					//echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",2)' target='area'><img src='imagenes/ok.png' border=0 width=10></a></td>";
				}
				else
				{				
					//echo"<td align=center><a href='#' onclick='salir($idcita,$codiusu,\"$contrato\",2)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
				}
				if($espe!='2656')
				{
					echo"<td align=center><a href='#' onclick='inasis($idcita,$codiusu)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
				}
			}
			else
			{
				echo"<td align=center><a href='#' onclick='inasis($idcita,$codiusu)' target='area'><img src='imagenes/next.jpg' border=0></a></td>";
			}
			echo"</tr>";
			//$idcitaant=$idcita;
		}		
		echo"</	table>";
	}		
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
      $unidad_=" Año";}
    else{
      $unidad_=" Años";}
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
        $unidad_=" Día";}
      else{
        $unidad_=" Días";}
    }
  }
  return($edad_.$unidad_);  
}
	function edadpaciente($fecha_nac)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en números enteros
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


