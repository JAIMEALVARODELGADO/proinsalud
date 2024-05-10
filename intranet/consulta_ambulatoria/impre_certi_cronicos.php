<?	
	session_start();
	$codusu=$_SESSION[Gidusu_hist];
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="JavaScript">
	
	function busca()
	{		
		if(event.KeyCode==13)
		{
			uno.abremod.value=='1'
			uno.histor.value='';
			uno.action='impre_certi_cronicos.php';
			uno.target='';
			uno.submit();
		}
	}
	
	
	function imprimir(nhis)
	{
		uno.abremod.value=='1'
		uno.numhisto.value=nhis;
		uno.action='impre_certi_cronicos2.php';
		uno.target='TOP';
		uno.submit();
	}
	
	function abremodal() 
	{		
		if(uno.abremod.value=='1')
		{
			document.getElementById('openModal').style.display = 'block';
		}
	}

	function CloseModal() 
	{
		document.getElementById('openModal').style.display = 'none';
	}
	function cargamodal(n)
	{
		uno.abremod.value='1';
		uno.numhisto.value=n;
		uno.target='';
		uno.action='impre_certi_cronicos.php';
		uno.submit();
	}
	
</script>
</head>	
<body style='position:absolute;margin-top:10' onload="abremodal()">
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
}
.modalDialog > div {
	width: 700px;
	position: relative;
	margin: 10% auto;
	padding: 5px 20px 13px 20px;
	border-radius: 10px;
	background: #fff;
	background: -moz-linear-gradient(#fff, #999);
	background: -webkit-linear-gradient(#fff, #999);
	background: -o-linear-gradient(#fff, #999);
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

</style>
<?	
	
	if(empty($tipo))$tipo=1;
	echo"<form name=uno method=post>
	<input type=hidden name=numtriage>
	<input type=hidden name=num_hist>
	<input type=hidden name=serie>
	<input type=hidden name=ori value='1'>
	<input type=hidden name=concon value='$concon'>
	<input type=hidden name=numhisto value='$numhisto'>
	<input type=hidden name=abremod value='$abremod'>
	
	<br><br>
	<table align=center class='tbl' width='930'>
	<tr>
	<th colspan=2 align=center><H2>CERTIFICADO MEDICO PATOLOGIAS CRONICAS</H2></th>
	</tr>
	</table>
	
	
	
	<br><br>
	<table align=center class='tbl' width='930'>
	<tr>
	<th colspan=2 align=center>NUMERO DE CEDULA <input type=text class='caja' name=cedula size=20 onkeypress='busca()' value='$cedula'><font color='#E3E3ED'>...............</font> 
	</th>
	</tr>
	</table>";	
	include ('php/conexion1.php');
	echo"<input type=hidden name=histor>";	
	
	
	$bcod=mysql_query("select CODI_USU from usuario WHERE NROD_USU = '$cedula'");
	while($rcod=mysql_fetch_array($bcod))
	{
		$codigousu=$rcod['CODI_USU'];
		//echo "<input type=text name=cod_usu value='$codigousu'>";
		
	}
	if(!empty($codigousu))
	{		
		$busca=mysql_query("SELECT usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, consultaprincipal.numc_cpl, consultaprincipal.feca_cpl, consultaprincipal.hora_cpl, contrato.NEPS_CON, medicos.nom_medi, usuario.NROD_USU
		FROM ((encabesadohistoria INNER JOIN usuario ON encabesadohistoria.cous_ehi = usuario.CODI_USU) INNER JOIN contrato ON encabesadohistoria.cont_ehi = contrato.CODI_CON) INNER JOIN (consultaprincipal INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi) ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl
		WHERE (usuario.CODI_USU)='$codigousu' AND (consultaprincipal.certicronico_clp)='S'");				
		echo "
		<BR><BR>
		<table align=center class='tbl'>
		<tr>
		<th>No. HISTORIA</th>
		<th>FECHA</th>
		<th>HORA</th>
		<th>IDENTIFICACION</th>
		<th>NOMBRE PACIENTE</th>
		<th>CONTRATO</th>
		<th>MEDICO</th>
		</tr>";
		while($rus=mysql_fetch_array($busca))
		{
			$nombre=$rus['PNOM_USU'].' '.$rus['SNOM_USU'].' '.$rus['PAPE_USU'].' '.$rus['SAPE_USU'];
			$histo=$rus['numc_cpl'];
			$docum=$rus['NROD_USU'];
			$fecha=$rus['feca_cpl'];
			$hora=$rus['hora_cpl'];
			$contra=$rus['NEPS_CON'];
			$medico=$rus['nom_medi'];			
			echo"<tr>				
			<td align=center><a href='#' onclick='cargamodal(\"$histo\")' >$histo</a></td>
			<td align=center><a href='#' onclick='cargamodal(\"$histo\")'>$fecha</a></td>
			<td align=center><a href='#' onclick='cargamodal(\"$histo\")'>$hora</a></td>
			<td align=center><a href='#' onclick='cargamodal(\"$histo\")'>$docum</a></td>
			<td><a href='#' onclick='cargamodal(\"$histo\")'>$nombre</a></td>
			<td><a href='#' onclick='cargamodal(\"$histo\")'>$contra</a></td>
			<td><a href='#' onclick='cargamodal(\"$histo\")'>$medico</a></td>
			</tr>";		
		}
		echo"</table>";
		
	}
	else
	{
		echo"<br><center>USUARIO NO REGISTRADO</center>";
	}
	
	echo"</form>";
	?>
	<div id="openModal" class="modalDialog">
      <div>
       
		
		<a href="#close" title="Close" class="close" onclick="javascript:CloseModal();">X</a>
		<?php
		
		
		
		
		
		$anohoy=date('Y');
		$meshoy=date('m');
		$diahoy=date('d');
		
		$fecha=date('Y-m-d');
		$hora=date('H:i:s');
		
		if($meshoy=='01')$meshoy='Enero';
		if($meshoy=='02')$meshoy='Febrero';
		if($meshoy=='03')$meshoy='Marzo';
		if($meshoy=='04')$meshoy='Abril';
		if($meshoy=='05')$meshoy='Mayo';
		if($meshoy=='06')$meshoy='Junio';
		if($meshoy=='07')$meshoy='Julio';
		if($meshoy=='08')$meshoy='Agosto';
		if($meshoy=='09')$meshoy='Septiembre';
		if($meshoy=='10')$meshoy='Octubre';
		if($meshoy=='11')$meshoy='Noviembre';
		if($meshoy=='12')$meshoy='Diciembre';
	
		include('php/conexion1.php');
		set_time_limit (300);
		
	
		$busu=mysql_query("SELECT encabesadohistoria.numc_ehi, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, 
		consultaprincipal.come_cpl, medicos.nom_medi, medicos.reg_medi, consultaprincipal.cod1_cpl, cie_10.nom_cie10
		FROM (((encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) INNER JOIN usuario ON encabesadohistoria.cous_ehi = usuario.CODI_USU) INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi) INNER JOIN cie_10 ON consultaprincipal.cod1_cpl = cie_10.cod_cie10
		WHERE (((encabesadohistoria.numc_ehi)='$numhisto'))");
		while($rusu=mysql_fetch_array($busu))
		{
			$codigo_usu=$rusu['numc_ehi'];	
			$tipodoc=$rusu['TDOC_USU'];
			$documento=$rusu['NROD_USU'];
			$nombre=$rusu['PNOM_USU'].' '.$rusu['SNOM_USU'].' '.$rusu['PAPE_USU'].' '.$rusu['SAPE_USU'];
			$codmedico=$rusu['come_cpl'];
			$nommedico=$rusu['nom_medi'];
			$regmedico=$rusu['reg_medi'];
			$cod1_cpl=$rusu['cod1_cpl'];
			$nom_cie10=ucfirst(strtolower($rusu['nom_cie10']));		
			
			if($tipodoc=='CC')$tipo="cedula de ciudadania";      
			if($tipodoc=='TI')$tipo="tarjera de identidad";      
			if($tipodoc=='RC')$tipo="registro civil";     
			if($tipodoc=='CE')$tipo="cedula de extranjeria";      
			if($tipodoc=='PA')$tipo="pasaporte"; 
		}		
		
		echo"<table align=center width=100%>
		<tr>
			<td align=center colspan=2>A QUIEN INTERESE<BR><BR></td>
		</tr>
		
		<tr><td align=left colspan=2>El suscrito medico de PROINSALUD S.A. Consulta Externa certifica que: el señor(a) $nombre Identificado(a) 
			con $tipo No $documento de $ciudadexpe una vez revisado su historia clinica presenta a la fecha los siguientes Diagnosticos:<br><br></td>
		</tr>
		
		<tr>
			<td align=left>Diagnostico principal<br></td>
			<td>$nom_cie10<br></td>
		</tr>";
		
		$bdiag=mysql_query("SELECT diagnosticos2.codc_di2, cie_10.nom_cie10, diagnosticos2.orde_die2
		FROM diagnosticos2 INNER JOIN cie_10 ON diagnosticos2.codc_di2 = cie_10.cod_cie10
		WHERE (((diagnosticos2.numc_di2)='$numhisto'))
		ORDER BY diagnosticos2.orde_die2");
		$n=2;
		while($rdiag=mysql_fetch_array($bdiag))
		{
			$cod_diag=$rdiag['codc_di2'];	
			$nom_diag=ucfirst (strtolower ($rdiag['nom_cie10']));
			$orden=$rdiag['orde_die2'];
			
			if($orden=='R1')
			{
				echo"
				<tr>
					<td align=left>Diagnostico secundario<br></td>
					<td>$nom_diag<br></td>
				</tr>";	
				
			}
			if($orden=='R2')
			{
				echo"
				<tr>
					<td align=left>Otros diagnosticos<br></td>
					<td>$nom_diag<br></td>
				</tr>";	
				
				
			}


			if($orden=='R3' || $orden=='R4' || $orden=='R5')
			{
				echo"
				<tr>
					<td align=center><br></td>
					<td>$n $nom_diag<br></td>
				</tr>";
				$n++;
			}		
		}
		echo"		
		<tr>
		<td align=left colspan=2><br>Para constancia se firma a los $diahoy del mes de $meshoy del $anohoy</td>
		</tr>";
		
		echo"
		<tr>
			<td align=left><br>Nombre profesional</td>
			<td><br>$nommedico</td>
		</tr>
		
		<tr>
			<td align=left><br>Registro medico</td>
			<td><br>$regmedico</td>
		</tr>
		
		<tr>
			<td align=left><br>Firma</td>
			<td></td>
		</tr>
		
		
		<tr>
			<td align=center colspan=2>
			<br><input type=button class='boton' onclick='imprimir(\"$numhisto\")' value='IMPRIMIR'>&nbsp;&nbsp;&nbsp;&nbsp;<input type=button class='boton' onclick='javascript:CloseModal();' value='CERRAR'></td>
			<td></td>
		</tr>
				
		</table>";	
		
		
		
		
		
		
		
		
		?>
		
      </div>
    </div>

</body>
</html>