<?	
	session_start();
	session_register('datos');
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready(function() {	
	$("#course").autocomplete("auto_medico.php", {
		width: 260,
		minChars: 1,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220	
	});	
	$("#course").result(function(event, data, formatted) {
		$("#course_val").val(data[1]);
	});
});

</script>
<script language="JavaScript">
	function cambio()
	{
		uno.action='valfamilia_impre.php';
		uno.target='';
		uno.submit();
	}
	function cambio1()
	{		
		
		if(event.KeyCode==13)
		{
			alert(uno.codmedico.value);
			uno.action='valfamilia_impre.php';
			uno.target='';
			uno.submit();
		}
	}
	
</script>
</head>	
<body >
<style>
#conte {
overflow:auto;
height: 326px;
width: 930px;
padding:5px;
margin:0 auto;
background-color: #FFFFFF;
font-size: 8px;
}

</style> 
<?	


	include ('php/conexion1.php');
	$val1='';$val2='';
	if($buspor=='1')$val1='checked';	
	if($buspor=='2')$val2='checked';
	
	if(empty($tipo))$tipo=1;
	echo"<form name=uno method=post>	
	<br>
	<table align=center class='tbl' width='930'>
	<tr>
	<th align=center>RESULTADOS VALORACION FAMILIAR</th>
	</tr>
	<tr>
	<th align=center>BUSCAR POR: <font color='#E3E3ED'>...............</font>
	PACIENTE <input type=radio name=buspor $val1 onclick=cambio() value='1'><font color='#E3E3ED'>...............</font> 
	MEDICO <input type=radio name=buspor $val2 onclick=cambio() value='2'>
	</th>	
	</tr>
	</table>
	<br>";
	$num=0;
	if($buspor=='1')
	{
		echo"<table align=center class='tbl' width='930'>
		<tr>
		<th align=center>CEDULA DEL PACIENTE <font color='#E3E3ED'>...............</font><input type=text class='caja' name=cedula size=20 onkeypress='busca()' value='$cedula'></th>
		<tr>
		</table>";
		$bhis=mysql_query("SELECT usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, medicos.cod_medi, medicos.nom_medi, conambfam.fecha_cfa, conambfam.hora_cfa, conambfam.apgpun_cfa, conambfam.phqpun_cfa
		FROM (conambfam INNER JOIN usuario ON conambfam.codi_usu = usuario.CODI_USU) INNER JOIN medicos ON conambfam.cod_medi = medicos.cod_medi
		WHERE (((usuario.NROD_USU)='$cedula'))
		ORDER BY conambfam.fecha_cfa DESC , conambfam.hora_cfa DESC");
		$num=mysql_num_rows($bhis);
	}
	if($buspor=='2')
	{
		
		echo"<table align=center class='tbl' width='930'>
		<tr>		
		<input type='hidden' id='course_val' name='codmedico' value='$codmedico'>
		<th>NOMBRE DEL MEDICO <font color='#E3E3ED'>...............</font> 
		<input type=text name=nommedico id='course' class='caja' size=50 onkeyPress='cambio1()' value='$nommedico'> 
		<tr>
		</table>";
		$bhis=mysql_query("SELECT usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, 
		medicos.cod_medi, medicos.nom_medi, conambfam.fecha_cfa, conambfam.hora_cfa, conambfam.apgpun_cfa, conambfam.phqpun_cfa
		FROM (conambfam INNER JOIN usuario ON conambfam.codi_usu = usuario.CODI_USU) INNER JOIN medicos ON conambfam.cod_medi = medicos.cod_medi
		WHERE (((medicos.cod_medi)='$codmedico'))
		ORDER BY conambfam.fecha_cfa DESC , conambfam.hora_cfa DESC");
		$num=mysql_num_rows($bhis);
	}
	
	if($num>0)
	{
		
		echo"<br><table align=center class='tbl' width='930'>
		<tr>
		<th>CEDULA USUARIO</th>
		<th>NOMBRE USUARIO</th>
		<th>NOMBRE MEDICO</th>
		<th>FECHA</th>
		<th>HORA</th>
		<th>VALOR APGAR</th>
		<th>VALOR PHQ</th>
		</tr>";
		
		while($rbus=mysql_fetch_array($bhis))
		{
			$cedusu=$rbus['NROD_USU'];
			$nomusu=$rbus['PNOM_USU'].' '.$rbus['SNOM_USU'].' '.$rbus['PAPE_USU'].' '.$rbus['SAPE_USU'];
			$medico=$rbus['nom_medi'];
			$fecha=$rbus['fecha_cfa'];
			$hora=$rbus['hora_cfa'];
			$apg_cfa=$rbus['apgpun_cfa'];
			$phq_cfa=$rbus['phqpun_cfa'];
			
			echo"<tr>
			<td align=center>$cedusu</td>
			<td>$nomusu</td>
			<td>$medico</td>
			<td align=center>$fecha</td>
			<td align=center>$hora</td>
			<td align=center>$apg_cfa</td>
			<td align=center>$phq_cfa</td>
			</tr>";
			
			
		}
		echo "</table>";
	}
	
	
	
	echo"</form>";
?>
</body>
</html>