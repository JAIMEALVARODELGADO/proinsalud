<?
session_start();
$Gidusufac=$_SESSION['Gidusufac'];
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
		uno.action='factura_respuesta.php';
		uno.target='';
		uno.submit();
	}
	function valida()
	{
		uno.action='factura_respuesta_g.php';
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
		uno.action='factura_respuesta.php';
		uno.target='';
		uno.submit();
			
	}
	function cargamodal()
	{
		if(uno.carga.value==1)document.getElementById("openModal").style.display = 'block';
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
	$fecha=date("Y-m-d");
    $hora=date("H-i");
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
	WHERE (((gestion_factura_enca.estado)='SO'))
	GROUP BY municipio.CODI_MUN, municipio.NOMB_MUN");
	
	
	echo"<table align=center class='tbl5' width=80%>		
	<tr>
	<th valign=center align=center hwight=40>MUNICIPIO &nbsp;&nbsp;&nbsp;&nbsp;
	<select class='caja' name=munisel onchange='buscamun()'>
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
	</tr>
	</table><br>";
	
	
	
	if($munisel!='')
	{
		//AND ((horarios.Fecha_horario)='$fecha')
		$cad='';
		if($munisel!='9999')$cad="AND ((areas.muni_area)='$munisel')";
		$cad=mysql_query("SELECT citas.id_cita, usuario.SEXO_USU, usuario.FNAC_USU, citas.Idusu_citas, citas.Esta_cita, usuario.NROD_USU, 
		citas.Cotra_citas, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, areas.nom_areas, medicos.nom_medi, 
		citas.Clase_citas, horarios.Cserv_horario, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, citas.Idusu_citas, 
		horarios.Cmed_horario, gestion_factura_enca.estado, citas.Clase_citas, areas.muni_area, gestion_factura_deta.fecha, 
		gestion_factura_deta.observacion
		FROM general.cut INNER JOIN ((((medicos INNER JOIN (usuario 
		INNER JOIN (horarios INNER JOIN citas ON (horarios.ID_horario = citas.ID_horario) AND (horarios.ID_horario = citas.ID_horario) 
		AND (horarios.ID_horario = citas.ID_horario)) ON usuario.CODI_USU = citas.Idusu_citas) ON medicos.cod_medi = horarios.Cmed_horario) 
		INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) INNER JOIN gestion_factura_enca 
		ON citas.id_cita = gestion_factura_enca.numero_cita) INNER JOIN gestion_factura_deta 
		ON gestion_factura_enca.id_enca = gestion_factura_deta.id_enca) ON cut.ide_usua = gestion_factura_deta.usuario
		WHERE (((citas.Esta_cita)<>'4')  AND ((gestion_factura_enca.estado)='SO') 
		AND ((citas.Clase_citas)<='5') $cad)
		ORDER BY horarios.Fecha_horario, horarios.Hora_horario");
		
		if(mysql_num_rows($cad)>0)
		{		
			echo"
			<table align=center class='tbl5' width=80%>			
			<tr>
			<th>IDENTIFICACION</th>
			<th>HORA</th>
			<th>FECHA</th>
			<th>NOMBRE PACIENTE</th>
			<th>NOMBRE MEDICO</th>	
			<th>AREA</th>	
			<th>EDAD</th>		
			<th>ESTADO</th>
			<th>ESTADO FACTURA</th>";
			echo"</tr>";
			$idcitaant='NOHABIL';	
			$n=0;			
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
				$estafac=$row['estado'];
				
				
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
				
				echo"<td align=center>$cedula</td>
				<td align=center>$hora</td>
				<td>$fechahorario</td>
				<td>$nombre</td>";
				echo"<td>$nommedi</td>";
				echo"<td>$nomarea</td>";
				echo"<td>$edadpac</td>";
				echo"<td>$descestdocita</td>";
				if(empty($estafac))$estafac="PE";
				if($estafac=="PE")$estado="PENDIENTE";
				if($estafac=="SO")$estado="SOLICITADO";
				if($estafac=="FA")$estado="FACTURADO";
				if($estafac=="FI")$estado="FINALIZADO";
				echo"<td align=center><a href='#' onclick='factura($idcita,\"$estafac\",\"$cedula\",\"$nombre\")'>$estado</td>";
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
		
		<h2>REGISTRO DE FACTURACION</h2>
		<br><br>
		<table align=center class='tbl5' border=0>
		";
		echo"<tr>
		<th>USUARIO: <b> $cedusel - $nombresel</b></td>
		</tr>
		</table>
		<br>
		<br>
		<table align=center class='tbl5' border=0>
		<tr>
		<td>CAMBIAR DE ESTADO</td>
		<td>";
		if($estadosel=='PE')echo"<input type=checkbox name=estadonuevo value='SO'> SOLICITAR FACTURACION";
		if($estadosel=='SO')echo"<input type=checkbox name=estadonuevo value='FA'> FACTURADO";
		if($estadosel=='FA')echo"<input type=checkbox name=estadonuevo value='FI'> FIRMA DE FACTURA";
		if($estadosel=='FI')echo"PROCESO FINALIZADO";
		ECHO"
		</td>
		</tr>";
		
		if($estadosel!='FI')
		{
			echo"
			<tr>
			<td>NUMERO DE FACTURA</td>
			<td><input type=text class='caja' name='numfactura' ></td>
			</tr>
			<tr>
			<td>OBSERVACION</td>
			<td><textarea class='caja' name='observa' cols='50' rows='2'></textarea></td>
			</tr>
			</table>
			<br><br>
			<table align=center class='tbl5' border=0>
			<tr><th>
			<input type=button class='botones' value='GUARDAR' onclick='valida()'>
			<input type=button class='botones' value='CANCELAR' onclick='javascript:CloseModal();'>
			</th></tr>
			</table>";
		}
		else
		{
			echo"
			</table>
			<br><br>
			<table align=center class='tbl5' border=0>
			<tr><th>			
			<input type=button class='botones' value='CANCELAR' onclick='javascript:CloseModal();'>
			</th></tr>
			</table>";
		}
		
		
		$bseg=mysql_query("SELECT gestion_factura_deta.fecha, gestion_factura_deta.estado, gestion_factura_deta.usuario, 
		gestion_factura_deta.observacion,cut.nomb_usua, gestion_factura_enca.num_factura
		FROM (gestion_factura_enca INNER JOIN gestion_factura_deta ON gestion_factura_enca.id_enca = gestion_factura_deta.id_enca) 
		INNER JOIN general.cut ON gestion_factura_deta.usuario = cut.ide_usua
		WHERE (((gestion_factura_enca.numero_cita)='$citasel')) ORDER BY fecha");
		
		
		$n=0;
		echo"
		<br><br>
		<table align=center class='tbl5' border=1>";
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
		
		
		echo"
		</table>
		<br><br><br><br><br>		
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