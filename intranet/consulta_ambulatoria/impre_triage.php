<html>
<head>
<script language="Javascript">	
</script>
<?	
	include ('php/conexion1.php');
	$bdat=mysql_query("SELECT usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, contrato.NEPS_CON, 
	triage_urgencias.iden_tri, triage_urgencias.iden_cita, triage_urgencias.tear1_tri, triage_urgencias.tear2_tri, triage_urgencias.frre_tri, triage_urgencias.frca_tri,	
	triage_urgencias.temp_tri, triage_urgencias.clas_tri, triage_urgencias.clas2_tri, triage_urgencias.usua_tri, triage_urgencias.usua2_tri, triage_urgencias.fech_tri, 
	triage_urgencias.hora_tri, triage_urgencias.moco_tri, triage_urgencias.mell_tri, triage_urgencias.esco_tri, triage_urgencias.dest_tri, triage_urgencias.obse_tri
	FROM ((triage_urgencias INNER JOIN citas ON triage_urgencias.iden_cita = citas.id_cita) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU) INNER JOIN contrato ON citas.Cotra_citas = contrato.CODI_CON");
	while($rdat=mysql_fetch_array($bdat))
	{
		$cedula=$rdat['NROD_USU'];	//Cedula paciente
		$nombre=$rdat['PNOM_USU'].' '.$rdat['SNOM_USU'].' '.$rdat['PAPE_USU'].' '.$rdat['SAPE_USU'];	//nombre paciente
		$contrato=$rdat['NEPS_CON'];	//contrato del paciente
		$iden_tri=$rdat['iden_tri'];	//identificador de tabla triage_urgencias
		$iden_cita=$rdat['iden_cita'];	//identificador tabla citas
		$tear1_tri=$rdat['tear1_tri'];	//tension arterial
		$tear2_tri=$rdat['tear2_tri'];	//tension arterial
		$frre_tri=$rdat['frre_tri'];	//frecuencia respiratoria
		$frca_tri=$rdat['frca_tri'];	//frecuencia cardiaca
		$temp_tri=$rdat['temp_tri'];	//temperatura
		$clas_tri=$rdat['clas_tri'];	//clasificacion primaria	*	
		$clas2_tri=$rdat['clas2_tri'];	//clasificacion triage 		*
		$usua_tri=$rdat['usua_tri'];	//funcionario clasificacion primaria	
		$usua2_tri=$rdat['usua2_tri'];	//funcionario clasificacion triage
		$fech_tri=$rdat['fech_tri'];	//fecha triage
		$hora_tri=$rdat['hora_tri'];	//hora perfecto
		$moco_tri=$rdat['moco_tri'];	//motivo de consulta
		$mell_tri=$rdat['mell_tri'];	//medio de llegada		*
		$esco_tri=$rdat['esco_tri'];	//estado de conciencia	
		$dest_tri=$rdat['dest_tri'];	//destino de salida		*
		$obse_tri=$rdat['obse_tri'];	//observaciones
		echo"
		<table align=center width=100% class='tbl3'>
			<tr>
			<td align=center rowspan=5 width=8%><img src='img/proinsalud.GIF' width=60%></td>
			<td align=center rowspan=5 width=15%><font FACE=Arial size=2><B>Profesionales de la Salud S.A.</B></font></td>
			<td align=center rowspan=5 width=39%><font FACE=Arial size=2><B>CONTROL DE TRANSFUSIONES SANGUINEAS</B></font></td>
			<td align=center rowspan=2 width=8%><font FACE=Arial size=1><B>CODIGO:</B><BR>FRLAB-34</font></td>
			<td align=center rowspan=1 width=25%><font FACE=Arial size=1><B>FECHA DE ELABORACION</B></font></td>
			</tr>
			<tr>
			<td align=center rowspan=1><font FACE=Arial size=1>08 de MARZO de 2007</font></td>
			</tr>
			<tr>
			<td align=center rowspan=3><font FACE=Arial size=1><B>VERSION:</B><BR>00</font></td>
			<td align=center rowspan=1><font FACE=Arial size=1><B>FECHA DE ACTUALIZACION</B></font></td>
			</tr>
			<tr>
			<td align=center rowspan=1><font FACE=Arial size=1>08 de MARZO de 2007</font></td>
			</tr>
			<tr>
			<td align=center rowspan=1><font FACE=Arial size=1><B>HOJA</B> 1 <B>DE</B>1</font></td>
			</tr>
			</table>
			";
			if($mell_tri==1)$mediolle='CAMINANDO';
			if($mell_tri==2)$mediolle='EN AMBULANCIA';
			if($mell_tri==3)$mediolle='LLEGADA VEHICULO';
			if($mell_tri==4)$mediolle='VEHICULO POLICIA';
			if($mell_tri==5)$mediolle='OTRO';			
			if($mell_tri=='U')$mediolle='ATENCION DE URGENCIA';
			if($mell_tri=='P')$mediolle='CONSULTA PRIORITARIA';
			if($mell_tri=='R')$mediolle='REMISION A OTRA IPS';
			
			
			
			echo"
			<table>
			<tr>
			<td>fecha y hora de atencion: $fech_tri $hora_tri</td>
			</tr>
			<tr>
			<td>Identificacion: $cedula</td>
			<td>Nombre: $nombre</td>
			<td>Contrato: $contrato</td>
			</tr>
			
			</table>
			
			
			
			";
			
			
			
			echo"
			<br>
		<table align=center width=100% class='tbl4'>
			
			<tr>
			<td class='enlace' align=center>ELABORADO POR<BR>Grupo de Laboratorio</td>
			<td class='enlace' align=center>REVISADO POR<BR>Jefe de Control y Aseguramiento de S.G:C:</td>
			<td class='enlace' align=center>APROBADO POR<BR>Gerente General</td>
			</tr>			
		</table>";
		
		
		
	}
?>
</html>












	