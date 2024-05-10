<?
$usucitas=$_SESSION['usucitas'];
?>


<HTML>
<HEAD>
<!--<meta http-equiv="Refresh" content="10"> -->
<link rel="stylesheet" href="style.css" type="text/css"/>
<TITLE>AGENDA MEDICA</TITLE>
<SCRIPT LANGUAGE="JavaScript">
	function buscamun()
	{
		uno.carga.value=0;
		uno.action='factura_reporte.php';
		uno.target='';
		uno.submit();
	}
	
	function CloseModal() 
	{
		uno.carga.value=0;
		document.getElementById('openModal').style.display = 'none';
	}
	function factura(idcita,estafac,cedula,nombre)
	{
		uno.citasel.value=idcita;
		uno.estadosel.value=estafac;
		uno.cedulasel.value=cedula;
		uno.nombresel.value=nombre;
		uno.carga.value=1;
		uno.action='factura_reporte.php';
		uno.target='';
		uno.submit();
			
	}
	function cargamodal()
	{
		if(uno.carga.value==1)document.getElementById("openModal").style.display = 'block';
	}
	function exportar()
	{
		uno.action='factura_reporte_excel.php';
		uno.target='';
		uno.submit();
	}
	
</script>
</head>
<style>

	.modalDialog {
	position: fixed;
	font-family: Arial, Helvetica, sans-serif;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background: rgba(0,0,0,0.8);
	z-index: 99999;
	display:none;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: auto;
	overflow: auto;
}
.modalDialog > div {
	width: 60%;
	position: relative;
	margin: 2% auto;
	padding: 5px 20px 13px 20px;
	border-radius: 10px;
	background: #fff;
	background: -moz-linear-gradient(#fff, #eee);
	background: -webkit-linear-gradient(#fff, #eee);
	background: -o-linear-gradient(#fff, #eee);
  -webkit-transition: opacity 400ms ease-in;
-moz-transition: opacity 400ms ease-in;
transition: opacity 400ms ease-in;
}
.close {
	background: #606061;
	color: #FFFFFF;
	line-height: 25px;
	position: absolute;
	right: -12px;
	text-align: center;
	top: -10px;
	width: 24px;
	text-decoration: none;
	font-weight: bold;
	-webkit-border-radius: 12px;
	-moz-border-radius: 12px;
	border-radius: 12px;
	-moz-box-shadow: 1px 1px 3px #000;
	-webkit-box-shadow: 1px 1px 3px #000;
	box-shadow: 1px 1px 3px #000;
}
.close:hover { background: #00d9ff; }

.botones {
  padding: 5px 10px;
  background-color: #007BFF;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 12px;
  font-weight: bold;
}

.botones:hover {
  background-color: #0059FF;
}

.botones:active {
  background-color: #0059FF;
}
</style>
<body onload="cargamodal()">

<?	
	
	
	
	// 192.168.4.20/intraweb/intranet/consulta_ambulatoria/factura_respuesta.php
	include ('php/conexion1.php');
	
	echo"
	<center>
	<form name=uno method=post>
	<input type=hidden name=citasel value='$citasel'>
	<input type=hidden name=estadosel>
	<input type=hidden name=carga value='$carga'>
	<input type=hidden name=nombresel>
	<input type=hidden name=cedulasel>";
	
	echo"<br><br><table align=center class='tbl5' width=80%>		
	<tr>
	<th colspan=10 valign=center align=center hwight=40>PACIENTES PARA FACTURAR CONSULTA</th>
	</tr>
	</table><br>";
	
	
	
	
	$bmun=mysql_query("SELECT municipio.CODI_MUN, municipio.NOMB_MUN
	FROM municipio INNER JOIN gestion_factura_enca ON municipio.CODI_MUN = gestion_factura_enca.municipio
	WHERE (((gestion_factura_enca.estado)<>'VA'))
	GROUP BY municipio.CODI_MUN, municipio.NOMB_MUN");
	
	if(empty($fecharep))$fecharep=date("Y-m-d");
	echo"<table align=center class='tbl5' width=80%>		
	<tr>
	<th valign=center align=center hwight=40>FECHA &nbsp;&nbsp;&nbsp;&nbsp;
	<input type='date' name='fecharep' value='$fecharep'></th>
	
	<th valign=center align=center hwight=40>MUNICIPIO &nbsp;&nbsp;&nbsp;&nbsp;
	<select class='caja' name=munisel>
	<option value=''></option>";
	while($rmun=mysql_fetch_array($bmun))
	{
		$codmuni=$rmun['CODI_MUN'];
		$nommuni=$rmun['NOMB_MUN'];
		if($munisel==$codmuni)echo"<option selected value='$codmuni'>$nommuni</option>";
		else echo"<option value='$codmuni'>$nommuni</option>";
	}
	if($munisel=='9999')echo"<option selected value='9999'>TODOS</option>";
	else echo"<option value='9999'>TODOS</option>";
	echo"	
	</select>
	</th>
	<th valign=center align=center hwight=40>
	<input type=button class='botones' value='BUSCAR' onclick='buscamun()'>
	</th>
	</tr>
	
	</table><br>";
	
	$fechaini=$fecharep.' 00:00:00';
	$fechafin=$fecharep.' 23:23:59';
	
	if($munisel!='')
	{
		//AND ((horarios.Fecha_horario)='$fecha')
		
		//2024-04-24 16:40:54
		$cadena='';
		if($munisel!='9999')$cadena="AND ((areas.muni_area)='$munisel')";
		$sql="SELECT citas.id_cita, gestion_factura_enca.id_enca, gestion_factura_enca.num_factura, min(gestion_factura_deta.fecha) AS MínDefecha1, 
		usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, areas.nom_areas, contrato.NEPS_CON, 
		municipio.NOMB_MUN, gestion_factura_enca.estado, esta_cita.descrip_estaci
		FROM ((((((gestion_factura_deta INNER JOIN gestion_factura_enca ON gestion_factura_deta.id_enca = gestion_factura_enca.id_enca) 
		INNER JOIN (citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON gestion_factura_enca.numero_cita = citas.id_cita) 
		INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU) 
		INNER JOIN contrato ON citas.Cotra_citas = contrato.CODI_CON) INNER JOIN municipio ON gestion_factura_enca.municipio = municipio.CODI_MUN) 
		INNER JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci
		WHERE (((gestion_factura_deta.fecha)>='$fechaini' And (gestion_factura_deta.fecha)<='$fechafin') $cadena)
		GROUP BY gestion_factura_enca.id_enca, gestion_factura_enca.num_factura, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, 
		usuario.PAPE_USU, usuario.SAPE_USU, areas.nom_areas, contrato.NEPS_CON, municipio.NOMB_MUN, gestion_factura_enca.estado, 
		esta_cita.descrip_estaci";
		
		$cad=mysql_query($sql);


		if(mysql_num_rows($cad)>0)
		{
			echo"
			<br>
			<input type=button class='botones' value='EXPORTAR A EXCEL' onclick='exportar()'>
			<br><br>
			<table align=center class='tbl5' width=80%>			
			<tr>
			<th>MUNICIPIO</th>
			<th>AREA</th>
			<th>PACIENTE</th>
			<th>CONTRATO</th>
			<th>ESTADO CONSULTA</th>
			<th>FACTURA</th>	
			<th>FECHA FACTURA</th>		
			<th>FUNCIONARIO FACTURA</th>
			<th>ESTADO FACTURA</th>";
			echo"</tr>";
			$idcitaant='NOHABIL';	
			$n=0;			
			while($row=mysql_fetch_array($cad))
			{	
				
				
				$idcita=$row['id_cita'];
				$iden=$row['id_enca'];
				$NOMB_MUN=$row['NOMB_MUN'];
				$nom_areas=$row['nom_areas'];
				$NEPS_CON=$row['NEPS_CON'];
				$num_factura=$row['num_factura'];
				$fecsol=$row['MínDefecha1'];
				$cedula=$row['NROD_USU'];
				$nombre=$row['PNOM_USU'].' '.$row['SNOM_USU'].' '.$row['PAPE_USU'].' '.$row['SAPE_USU'];				
				$estacita=$row['descrip_estaci'];
				$estafac=$row['estado'];
				$bfac=mysql_query("SELECT gestion_factura_enca.id_enca, gestion_factura_enca.num_factura, gestion_factura_deta.fecha, gestion_factura_deta.usuario, cut.nomb_usua
				FROM (gestion_factura_deta INNER JOIN gestion_factura_enca ON gestion_factura_deta.id_enca = gestion_factura_enca.id_enca) INNER JOIN general.cut ON gestion_factura_deta.usuario = cut.ide_usua
				WHERE (((gestion_factura_enca.id_enca)='$iden') AND ((gestion_factura_deta.estado)='FA'))");
				$factura='';
				$fechafac='';
				$nomusuario='';
				while($rfac=mysql_fetch_array($bfac))
				{
					$factura=$rfac['num_factura'];
					$fechafac=$rfac['fecha'];
					$nomusuario=$rfac['nomb_usua'];
					
				}
				
				
				
				$hora=substr($horahorario,11,5);
				
				if(($n+1)%2==0)$color="#EEEEEE";
				else $color="#FFFFFF";
				$n++;
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
				
				if(file_exists($archi))
				{
					
					$descestdocita="EN ATENCION";
				}
				echo"
				<tr bgcolor='$color'>
				
				";
				if(empty($estafac))$estafac="PE";
				if($estafac=="PE")$estado="PENDIENTE";
				if($estafac=="SO")$estado="SOLICITADO";
				if($estafac=="FA")$estado="FACTURADO";
				if($estafac=="FI")$estado="FINALIZADO";
				echo"<td align=center>$NOMB_MUN</td>
				<td align=center>$nom_areas</td>
				<td>$cedula - $nombre</td>
				<td>$NEPS_CON</td>";
				echo"<td>$estacita</td>";
				echo"<td>$factura</td>";
				echo"<td>$fechafac</td>";
				echo"<td>$nomusuario</td>";
				
				echo"<td align=center><a href='#' onclick='factura($iden,\"$estafac\",\"$cedula\",\"$nombre\")'>$estado</td>";
				echo"</tr>";
			}		
			echo"</table>";
		}
	}
	echo"
	<br><br><br><br><br><br>
	</center>
	
	<div id='openModal' class='modalDialog'>
	<div>
		<a href='#close' title='Close' class='close' onclick='javascript:CloseModal();'>X</a>";
		echo" 
		<br><br><br><br><br>
		<center>
		
		<h2>SEGUIMIENTO DE FACTURACION</h2>
		<br><br>
		<table align=center class='tbl5' border=0>
		";
		echo"<tr>
		<th>USUARIO: <b> $cedusel - $nombresel</b></td>
		</tr>
		</table>
		<br>
		<br>";
	
		
		$bseg=mysql_query("SELECT gestion_factura_deta.fecha, gestion_factura_deta.estado, gestion_factura_deta.usuario, 
		gestion_factura_deta.observacion,cut.nomb_usua, gestion_factura_enca.num_factura
		FROM (gestion_factura_enca INNER JOIN gestion_factura_deta ON gestion_factura_enca.id_enca = gestion_factura_deta.id_enca) 
		INNER JOIN general.cut ON gestion_factura_deta.usuario = cut.ide_usua
		WHERE (((gestion_factura_enca.id_enca)='$citasel')) ORDER BY fecha");
		
		
		$n=0;
		echo"
		<br><br>
		<table align=center class='tbl5' border=1>";
		$fecfac='';
		while($rseg=mysql_fetch_array($bseg))
		{
			if($n==0)
			{
				echo"
				<tr>
				<th colspan=5>SEGUIMIENTO</th>
				</tr>
				<tr>
				<th>FECHA Y HORA</th>
				<th>ESTADO</th>
				<th>OBSERVACION</th>
				<th>FUNCIONARIO</th>
				<th>NUMERO FACTURA</th>
				</tr>";
			}
			$cita=$rseg['numero_cita'];
			$fecha=$rseg['fecha'];
			$estado=$rseg['estado'];
			$obser=$rseg['observacion'];
			$usua=$rseg['nomb_usua'];
			$factu=$rseg['num_factura'];
			
			if($estado=="PE")$verestado="PENDIENTE";
			if($estado=="SO")$verestado="SOLICITADO";
			if($estado=="FA")$verestado="FACTURADO";
			if($estado=="FI")$verestado="FINALIZADO";			
			if($estado=='FI')$fecfac=substr($fecha,0,10);
			
			
			
			echo"
			<tr>
			<td>$fecha</td>
			<td>$verestado</td>
			<td>$obser</td>
			<td>$usua</td>
			<td>$factu</td>			
			</tr>";
			$n++;
		}
		
		
		
		echo"</table><br><br>";
		
		
		
		$carpeta=$fecfac.'_'.$citasel; //nombre carpeta
		$soportes=array();
		$j=0;
		$directorio = 'facturas/'.$carpeta."/";
		if(is_dir($directorio))
		{
			if ($handler = opendir($directorio)) 
			{
				while (false !== ($file = readdir($handler))) 
				{
					if($file!='.' && $file!='..')
					{
						$soportes[$j][0]=$idSolicitud."/".$file;
						$soportes[$j][1]=$file;
						$j++;
					}
				}
				closedir($handler);
			}
		}
		$finsop=$j;		
		for($j=0;$j<$finsop;$j++)
		{
			$file=$directorio.$soportes[$j][0];
			$nomfile=$soportes[$j][1];
			echo"<a href='$file' target='top'>$nomfile</a>&nbsp;&nbsp;&nbsp;&nbsp";
		}
		
		
		
		
		
		
		
		echo"<br><br><br><br><br>		
		</center>
		
	</div>
	</div>
	</div>
	
	
	
	";
	
	
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