<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="JavaScript">
function validar(){
var error='';
	if(document.uno.cod_medi.value==''){
		error='Codigo del medico\n';
	}
	if(document.uno.fecha_cita.value==''){
		error=error+'Fecha de la cita\n';
	}	
	if(error!=""){
		alert('Se debe compltara la siguiente informacion:\n'+error);	
	}
	else{
		document.uno.submit();
	}
}
</script>
</head>	
<body >
<style>


</style> 
<form name='uno' method='post' action='impre_histo_grupo.php'>
	<br><br>
	<table align=center class='tbl' width='930'>
	<!--<tr>-->
	<th colspan='2' align='center'>Codigo del Medico<input type='text' class='caja' name='cod_medi' size='20' onkeypress='busca()' value=''></th>
	<th colspan='2' align='center'>Fecha de la Cita (aaaa/mm/dd)<input type='text' class='caja' name='fecha_cita' size='10' maxlength='10' value=''></th>
	<!--</tr>-->
	</table>
	<center><input type='button' name='Buscar' value='Buscar' onclick='validar()'></center>
	<br>
	<br>
	<input type='text' disabled='true' size='150' value='Informe que permite generar las historias clinicas de los pacientes citados en una fecha determinada, de un profesional determinado'>
</form>

</body>
</html>