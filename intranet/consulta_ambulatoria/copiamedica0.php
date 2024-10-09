<?
	session_register('paciente');
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
		$("#course").autocomplete("autocomp4.php", {
		width: 260,	
		matchContains: true,
		mustMatch: true,
		selectFirst: false
		});	
		$("#course").result(function(event, data, formatted) {
		$("#course_val").val(data[1]);		
		$("#condi").val(data[2]);
		$("#justi").val(data[3]);
		});
	}
);
$().ready(function() {	
		$("#course2").autocomplete("autocomp2.php", {
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
		uno.action='medica0.php';
		uno.submit();	
	}	
	
	function valida(ope)
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
			alert("Seleccione el tipo de orden");
			return;
		}
		
		
		if(uno.desorden.value=='')
		{
			alert("Seleccione el medicamento o dispositivo");
			uno.desorden.focus();
			return;
		}
		
		if(uno.codorden.value=='')
		{
			alert("Seleccione el medicamento o dispositivo");
			uno.desorden.focus();
			return;
		}
		
		if(uno.obseorden.value=='')
		{
			alert("Digite la posologia u observacion");
			uno.obseorden.focus();
			return;
		}
		if(uno.canti.value=='')
		{
			alert("Digite la candidad a prescribir");
			uno.canti.focus();
			return;
		}
		
		if(uno.diagorden.value=='')
		{
			alert("Seleccione el diagnostico");
			uno.diagorden.focus();
			return;
		}
		uno.claseorden.value=ope;
		uno.action='almacena.php';
		uno.target='';
		uno.submit();	
	}
	function mensa()
	{
		if(uno.mensaje.value==1)
		{
			alert("Se requiere diligenciar el modulo de diagnosticos");
		}
	}
</script>
</head>	
<body onload='mensa()'>
<?
	echo"<form name=uno method=post>
	<input type=hidden name=claseorden>
	<input type=hidden name=codiprg value='6'>
	<BR><BR>
	<table align=center width=80%>";
	$archivo2='tmp/4HC'.$paciente.'.txt';
	if(file_exists($archivo2))
	{
		echo"<input type=hidden name=mensaje value=0>";
		include ('php/conexion1.php');
		if(empty($tipoorden))$tipoorden=1;
		
		echo"
		
		<TR><TD><table align=center class='tbl'>
		<tr><th class='caja' align=center height=30>TIPO DE ORDEN</th>
		<TD class='caja' align=center>";
		if($tipoorden==1)
		{
			echo"MEDICAMENTOS <input type=radio name=tipoorden checked value=1 onclick='busqueda()'>
			DISPOSITIVOS MEDICOS <input type=radio name=tipoorden value=2 onclick='busqueda()'>";
		}
		if($tipoorden==2)
		{
			echo"MEDICAMENTOS <input type=radio name=tipoorden value=1 onclick='busqueda()'>
			DISPOSITIVOS MEDICOS <input type=radio name=tipoorden checked value=2 onclick='busqueda()'>";
		}
		echo"</td></tr></table>
		<br><br>
		<table align=center class='tbl'><tr><td>";
		$archivo2='tmp/4HC'.$paciente.'.txt';	
		if(file_exists($archivo2))
		{
			$fp = fopen ($archivo2, "r" );
			$reg1=0;
			while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
			{ 
				$reg1++;
				$j = 0;
				foreach($data as $dato)
				{
					$campo2[$j]=$dato;
					$j++ ;
				}
				$$campo2[1]=$campo2[2];					
			}
		}			
		if($tipoorden==1)
		{			
			$datos[0]='desc_ins';
			$datos[1]='codi_ins';
			$datos[2]='insu_med';	
			echo $condicion.' '.$justificado;
			ECHO"<tr>
			<th>DESCRIPCION MEDICAMENTO</th>
			<th>POSOLOGIA</th>
			<th>CANTIDAD</th>
			</tr>			
			<tr>
			<td><textarea onPaste='return false' id='course' class='caja' name='desorden' rows=2 cols=68>$desorden</textarea></td>
			<td><textarea onPaste='return false' class='caja' name='obseorden' rows=2 cols=68>$obseorden</textarea></td>
			<td align=center><input type=text onPaste='return false' name=canti size=4></td></tr>			
			<input type='hidden' id='course_val' name='codorden' value='$codorden'>
			<input type='hidden' id='condi' name='condicion' value='$condicion'>
			<input type='hidden' id='justi' name='justificado' value='$justificado'>
			<tr><th colspan=3>DIAGNOSTICO <select class='caja' name=diagorden>
			<option value=''></option>
			<option value=$cod>$map</option>
			<option value=$cod1>$map1</option>
			<option value=$cod2>$map2</option>
			<option value=$cod3>$map3</option>
			</select>
			</td>
			</tr>
			<tr><th colspan=3 align=center valign=top height=20><INPUT type=button class='boton' value= AGREGAR onClick='valida(1);'></th></tr>	
			</tr>";
		}
		else
		{			
				
			ECHO"<tr>
			<th>DESCRIPCION DISPOSITIVO</th>
			<th>OBSERVACION</th>
			<th>CANTIDAD</th>
			</tr>			
			<tr>
			<td><textarea onPaste='return false' id='course2' class='caja' name='desorden' rows=2 cols=68>$desorden</textarea></td>
			<td><textarea onPaste='return false' class='caja' name='obseorden' rows=2 cols=68>$obseorden</textarea></td>
			<td><input type=text onPaste='return false' name=canti size=4></td></tr>			
			<input type='hidden' id='course_val2' name='codorden' value='$codorden'>
			<tr><th colspan=3>DIAGNOSTICO <select class='caja' name=diagorden>
			<option value=''></option>
			<option value=$cod>$map</option>
			<option value=$cod1>$map1</option>
			<option value=$cod2>$map2</option>
			<option value=$cod3>$map3</option>
			</select>
			</td>
			</tr>
			<tr><th colspan=3 align=center valign=top height=20><INPUT type=button class='boton' value= AGREGAR onClick='valida(2);'></th></tr>	
			";
		}
		echo"</table>
		<br><br>
		<table align=center class='tbl'><tr><td>
		";
		
		$archivo='tmp/6HC'.$paciente.'.txt';	
		if(file_exists($archivo))
		{
			echo"<tr>
			<th align=center>TIPO</th>
			<th align=center>DX</th>
			<th>DESCRIPCION</th>
			<th>POSOLOGIA / OBSERVACION</th>
			<th>CANTIDAD</th>
			</tr>";
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
				if($reg % 6 == 0)
				{
					if($claseorden=='1')$tipo='MED';
					if($claseorden=='2')$tipo='DIS';
					echo"<tr>
					<td align=center>$tipo</td>
					<td>$diagorden</td>
					<td>$desorden</td>					
					<td>$obseorden</td>
					<td align=center>$canti</td>
					</tr>";				
				}				
			}
		}
		
		echo"</table>";		
	}
	else
	{
		echo"<input type=hidden name=mensaje value=1>";
	}
	echo"</td></tr></table></form>";
?>
</body>
</html>