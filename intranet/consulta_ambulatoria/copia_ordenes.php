<?
	session_register('paciente');
	session_register('numcita');
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready
(
	function() 
	{		
		$("#course").autocomplete("autocomp2.php", {width: 260,	matchContains: true,mustMatch: true,selectFirst: false});	
		$("#course").result(function(event, data, formatted) {$("#course_val").val(data[1]);});
	}
);
$().ready(function() {	
		$("#course2").autocomplete("autocomp3.php", {
		width: 340,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
		});	
		$("#course2").result(function(event, data, formatted) {
		$("#course_val2").val(data['1']);
		});
	});
</script>
<script language="JavaScript">
	function busqueda()
	{	
		uno.target='';
		uno.action='ordenes0.php';
		uno.submit();	
	}	
	
	function valida()
	{		
		opcion = document.getElementsByName("tipoorden");
		var anu=0;
		for(var i=0; i<2; i++)
		{			
			if(opcion[0].checked)
			{				
				var anu=1;
			}
			if(opcion[1].checked)
			{				 
				var anu=1;
			}			
		}
		if(anu==0)
		{
			alert("Seleccione el tipo de diagnóstico");
			return;
		}
		
		
		if(uno.cod.value=='')
		{
			alert("Seleccione el diagnostico");
			uno.map.focus();
			return;
		}
		
		if(uno.obse.value=='')
		{
			alert("Digite la observacion");
			uno.obse.focus();
			return;
		}
		uno.action='almacena.php';
		uno.target='';
		uno.submit();
	
	}
</script>
</head>	
<body>
<?

	$archivo='tmp/5HC'.$numcita.'-'.$paciente.'.txt';	
	if(file_exists($archivo))
	{
		$fp = fopen ($archivo, "r" );
		$reg=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{ 
			$reg++;
			$i = 0;
			foreach($data as $dato)
			{
				$campo[$i]=$dato;
				$i++ ;
			}
			$$campo[1]=$campo[2];		
		}
	}
	include ('php/conexion1.php');
	if(empty($tipoorden))$tipoorden=1;
	
	echo"
	<form name=uno method=post>
	<BR><BR>
	<table align=center width=80%>
	<TR><TD><table align=center class='tbl'>
	<tr><th class='caja' align=center height=30>TIPO DE ORDEN</th>
	<TD class='caja' align=center>";
	if($tipoorden==1)
	{
		echo"ORDENES MEDICAS <input type=radio name=tipoorden checked value=1 onclick='busqueda()'>
		REMISIONES <input type=radio name=tipoorden value=2 onclick='busqueda()'>";
	}
	if($tipoorden==2)
	{
		echo"ORDENES MEDICAS <input type=radio name=tipoorden value=1 onclick='busqueda()'>
		REMISIONES <input type=radio name=tipoorden checked value=2 onclick='busqueda()'>";
	}
	echo"</td></tr></table>
	<br><br>
	<table><tr><td>";
	ECHO $tipoorden;
	if($tipoorden==1)
	{
		$datos[0]='desc_map';
		$datos[1]='codi_map';
		$datos[2]='mapii';		
		ECHO"<tr>
		<td><textarea onPaste='return false' id='course' class='caja' name='map' rows=2 cols=58>$map</textarea></td>
		<input type='hidden' id='course_val' name='cod' value='$cod'>
		<td><textarea onPaste='return false' class='caja' name='obse' rows=2 cols=58>$obse</textarea></td>
		</tr>";
	}
	else
	{
		ECHO"<tr>
		<td><textarea onPaste='return false' id='course2' class='caja' name='map' rows=2 cols=58>$map</textarea></td>
		<input type='hidden' id='course_val2' name='cod' value='$cod'>
		<td><textarea onPaste='return false' class='caja' name='obse' rows=2 cols=58>$obse</textarea></td>
		</tr>";
	
	}
	echo"
	</td></tr></table>
	</br></br>
	<table>";
	for($i=0;$i<$fin;$i++)
	{
		$nomvar='tipo'.$i;
		$tipo=$$nomvar;
		echo"<input type=hidden name='$nomvar' value='$tipo'>";
		$nomvar='codmap'.$i;
		$codmap=$$nomvar;
		echo"<input type=hidden name='$nomvar' value='$codmap'>";
		$nomvar='desmap'.$i;
		$desmap=$$nomvar;
		echo"<input type=hidden name='$nomvar' value='$desmap'>";
		$nomvar='obsemap'.$i;
		$obsemap=$$nomvar;
		echo"<input type=hidden name='$nomvar' value='$obsemap'>";
		
		
	}
	echo"
</td></tr></table>
	";
?>
</body>
</html>