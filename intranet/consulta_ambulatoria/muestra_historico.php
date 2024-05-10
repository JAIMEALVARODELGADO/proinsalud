<HTML>
<HEAD>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css" type="text/css"/>
<TITLE>CONDUCTA ULTIMOS 3 MESES</TITLE>
<SCRIPT LANGUAGE="JavaScript">

</script>
</head>
<body>
<form name='form1'>
<?php
error_reporting(E_ERROR | E_PARSE);
include ('php/conexion1.php');
	$encontrado=false;
	$consulta="SELECT MAX(consultaprincipal.iden_cpl) AS ult_iden_cpl
	FROM consultaprincipal INNER JOIN encabesadohistoria ON consultaprincipal.numc_cpl = encabesadohistoria.numc_ehi
	WHERE encabesadohistoria.cous_ehi='$codi_usu'";
	//echo "<br>".$consulta;
	$consulta=mysql_query($consulta);
	if(mysql_num_rows($consulta)<>0){
		$row=mysql_fetch_array($consulta);
		$ult_iden_cpl=$row[ult_iden_cpl];

		$fecha_ult_con="";
		$servicio='';
		$meses=0;
		$medico=traemed($ult_iden_cpl,$fecha_ult_con,$servicio,$meses);

		echo "<table align=center class='tbl' width=100%>		
			<tr>
				<th colspan=12 valign=center align=center hwight=40>ULTIMA CONSULTA</th>
			</tr>
			<tr>
			<th>Profesional:</th>
			<td>$medico<td>
			<th>Fecha:</th>
			<td>$fecha_ult_con<td>
			<th>Meses transcurridos desde la última consulta:</th>
			<td>$meses<td>
			<th>Servicio:</th>
			<td>$servicio<td>					
			</tr>
			</table>";
echo "<br>";

		echo "<table align=center class='tbl' width=100%>
			<tr>
				<th colspan=12 valign=center align=center hwight=40>CONDUCTAS ULTIMOS TRES MESES</th>
			</tr>
		</table><br>";

		//Aqui consulto la identificacion del paciente
		$conspac="SELECT nrod_usu FROM usuario WHERE codi_usu='$codi_usu'";
		$conspac=mysql_query($conspac);
		$rowpac=mysql_fetch_array($conspac);		

		//Aqui consulto los medicamentos dispensados		
		$consultamed="SELECT codi_usu,fdis_for,cdis_for,formedica.vista_formuladet.nomb_mdi,DATEDIFF(CURDATE(),fdis_for) AS dias FROM formedica.vista_formuladet INNER JOIN proinsalud.medicamentos2 ON codi_mdi=codi_pro WHERE DATEDIFF(CURDATE(),fdis_for)<120 AND codi_usu='$rowpac[nrod_usu]'";
		//echo "<br>".$consultamed;
		//echo "<br>".mysql_num_rows($consultamed);
		$consultamed=mysql_query($consultamed);		
		if(mysql_num_rows($consultamed)<>0){
			$encontrado=true;			
			echo "<table align=center class='tbl' width=100%>
					<tr>
						<th colspan=10 valign=center align=center hight=2>MEDICAMENTOS DISPENSADOS</th>
					</tr>
					</table>
					<table align='center' class='tbl' width='100%' border='1'>
					<tr>
					<th>FECHA</th>
					<th>TIEMPO TRANSCURRIDO</th>
					<th>MEDICAMENTO</th>
					<th>CANTIDAD</th>					
					</tr>";
			while($row=mysql_fetch_array($consultamed)){
				$meses=intval($row[dias]/30);
				if($meses>'1'){
					$meses=$meses.' Meses';}
				else{
					$meses=$meses.' Mes';}
				echo "<tr>";
				echo "<td>$row[fdis_for]</td>";
				echo "<td>".$meses." </td>";
				echo "<td>$row[nomb_mdi]</td>";
				echo "<td>$row[cdis_for]</td>";				
				echo "</tr>";
			}
			echo "</table>";
		}

		
		//Aqui consulto los laboratorios tomados
		$consultalab="SELECT CODI_USU,fchr_labs,DATEDIFF(CURDATE(),fchr_labs) AS dias,codi_cup,descrip FROM vista_detalle_labs
		WHERE DATEDIFF(CURDATE(),fchr_labs)<=120 AND CODI_USU='$codi_usu' ";
	//echo "<br>".$consultalab;
		$consultalab=mysql_query($consultalab);
		if(mysql_num_rows($consultalab)<>0){
			$encontrado=true;
			echo "<br><table align=center class='tbl' width=100%>
				<tr>
				<th colspan=10 valign=center align=center hight=40>LABORATORIOS TOMADOS</th>
				</tr>
				</table>
				<table align='center' class='tbl' width='100%' border='1'>
				<tr>				
				<th>FECHA</th>
				<th>TIEMPO TRANSCURRIDO</th>
				<th>PROCEDIMIENTO</th>				
				</tr>";
			while($row=mysql_fetch_array($consultalab)){
				$meses=intval($row[dias]/30);
				if($meses>'1'){
					$meses=$meses.' Meses';}
				else{
					$meses=$meses.' Mes';}
				echo "<tr>";
				echo "<td>$row[fchr_labs]</td>";
				echo "<td>$meses</td>";
				echo "<td>$row[descrip]</td>";				
				echo "</tr>";
			}
			echo "</table>";
		}

		//Aqui consulto las imagenes leidas
		$consultaimag="SELECT CODI_USU,fech_ecr,DATEDIFF(CURDATE(),fech_ecr) AS dias,codi_cup,descrip 
		FROM vista_lectura_imagen WHERE DATEDIFF(CURDATE(),fech_ecr)<=120 AND CODI_USU='$codi_usu' ";
		//echo "<br>".$consultaimag;
		$consultaimag=mysql_query($consultaimag);
		if(mysql_num_rows($consultaimag)<>0){
			$encontrado=true;
			echo "<br><table align=center class='tbl' width=100%>
				<tr>
				<th colspan=10 valign=center align=center hight=40>IMAGENES Dx TOMADAS</th>
				</tr>
				</table>
				<table align='center' class='tbl' width='100%' border='1'>
				<tr>				
				<th>FECHA</th>
				<th>TIEMPO TRANSCURRIDO</th>
				<th>PROCEDIMIENTO</th>				
				</tr>";
			while($row=mysql_fetch_array($consultaimag)){
				$meses=intval($row[dias]/30);
				if($meses>'1'){
					$meses=$meses.' Meses';}
				else{
					$meses=$meses.' Mes';}
				echo "<tr>";
				echo "<td>$row[fech_ecr]</td>";
				echo "<td>$meses</td>";
				echo "<td>$row[descrip]</td>";				
				echo "</tr>";
			}
			echo "</table>";
		}
		
		$consultaord="SELECT cous_ehi,codi_dre,feca_cpl,tiempo,actividad,estado,cant_dre AS cantidad,servicio FROM vista_detareferencia90_ord WHERE cous_ehi='$codi_usu' ORDER BY servicio";
		//ECHO "<br>".$consultaord;
		$consultaord=mysql_query($consultaord);		
		if(mysql_num_rows($consultaord)<>0){
			$encontrado=true;
			echo "<table align=center class='tbl' width=100%>
			<tr>
			<th colspan=10 valign=center align=center hwight=40>REMISIONES</th>
			</tr>
			</table>
			<table align='center' class='tbl' width='100%' border='1'>
			<tr>
			<th>FECHA</th>
			<th>TIEMPO TRANSCURRIDO</th>
			<th>SERVICIO</th>
			<th>CANTIDAD</th>
			<th>ESTADO</th>
			</tr>";			
			while($row=mysql_fetch_array($consultaord)){
				$meses=intval($row[tiempo]/30);
				if($meses>'1'){
					$meses=$meses.' Meses';}
				else{
					$meses=$meses.' Mes';}
				echo "<tr>";
				echo "<td>$row[feca_cpl]</td>";
				echo "<td>$meses</td>";
				echo "<td>$row[servicio]</td>";
				echo "<td>$row[cantidad]</td>";
				echo "<td>$row[estado]</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
	}
?>

<br><table align=center class='tbl0' width=50% border=0>
	<tr>
		<td align='center'><input type="button" name="Cerrar" value="Cerrar" OnClick="window.close()"/></td>
		<td align='center'><input type="button" name="Maximizar" value="Maximizar" OnClick="window.resizeTo(screen.availWidth, screen.availHeight)"/></td>
	</tr>
</table>
</form>
</body>
</html>

<?php
function traemed($ult_iden_cpl,&$fecha_ult_con,&$servicio,&$meses){
	$medico_='';
	$consulta_="SELECT consultaprincipal.iden_cpl, consultaprincipal.feca_cpl, medicos.nom_medi, areas.nom_areas,(DATEDIFF(CURDATE(),consultaprincipal.feca_cpl))/30 AS meses
	FROM ((consultaprincipal INNER JOIN encabesadohistoria ON consultaprincipal.numc_cpl = encabesadohistoria.numc_ehi) INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi) INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas
	WHERE (((consultaprincipal.iden_cpl)='$ult_iden_cpl'))";
	//echo "<br>".$consulta_;
	$consulta_=mysql_query($consulta_);
	if(mysql_num_rows($consulta_)<>0){		
		$row_=mysql_fetch_array($consulta_);
		$medico_=$row_[nom_medi];
		$fecha_ult_con=$row_[feca_cpl];
		$servicio=$row_[nom_areas];
		$meses=(integer) $row_[meses];		
	}
	//echo $medico_;
	return $medico_;
}
?>