<?
	session_register('paciente');
	session_register('numcita');
	if(empty($paciente))
	{
		echo"<br><br><table align=center class='tbl'>
		<tr><th>POR SEGURIDAD SU SESIÓN SE CERRÓ. EIERRE E INGRESE NUEVAMENTE AL PROGRAMA</th></tr>
		</table>";
		exit;
	}
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready(function() {	
	$("#course_ocu").autocomplete("autoocupa.php", {
		width: 260,
		minChars: 1,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220	
	});	
	$("#course_ocu").result(function(event, data, formatted) {
		$("#course_valocu").val(data[1]);
	});
});
</script>
<script language="JavaScript">
	function valida()
	{
		if(uno.etnia.value=='')
		{
			alert("Seleccione la pertenencia etnica del paciente");
			uno.etnia.focus();
			return;
		}
		if(uno.ocupacion.value=='')
		{
			alert("Seleccione la ocupacion del paciente");
			uno.ocupacion.focus();
			return;
		}
		if(uno.escolaridad.value=='')
		{
			alert("Seleccione la escolaridad del paciente");
			uno.escolaridad.focus();
			return;
		}
		if(uno.estadocivil.value=='')
		{
			alert("Seleccione el estado civil del paciente");
			uno.estadocivil.focus();
			return;
		}
		if(uno.direccion.value=='')
		{
			alert("Digite la direccion de residencia del paciente");
			uno.direccion.focus();
			return;
		}
		
		
		if(uno.subjetivo.value=='')
		{
			alert("Digite el subjetivo");
			uno.motivo.focus();
			return;
		}
		if(uno.objetivo.value=='')
		{
			alert("Digite la objetivo");
			uno.motivo.focus();
			return;
		}
		
		
		uno.action='almacena.php';
		uno.target='';
		uno.submit();
	
	}
	
	
	function valtecla()
	{
		if(event.keyCode == 13)
		{
			event.returnValue = false
		}
		if (event.ctrlKey)
		{
			if (event.keyCode == 86) 
			{
				event.returnValue = false
			}
		}
	}
		
</script>
</head>	
<body oncontextmenu="return false;">
<?	
	include ('php/conexion1.php');
	$archivo='tmp/11HC'.$numcita.'-'.$paciente.'.txt';	
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
	$bfnac=mysql_query("select * from usuario where CODI_USU='$paciente'");
	while($rfnac=mysql_fetch_array($bfnac))
	{
		$fechanac=$rfnac['FNAC_USU'];	
		$etnia1=$rfnac['ETNI_USU']; 
		$escola1=$rfnac['NEDU_USU'];
		$ocupa1=$rfnac['OCUP_USU']; 
		$ecivil1=$rfnac['ECIV_USU']; 
		$direc1=$rfnac['DIRE_USU']; 
	}
	if(empty($etnia))$etnia=$etnia1;
	if(empty($ocupacion))$ocupacion=$ocupa1;
	if(empty($escolaridad))$escolaridad=$escola1;
	if(empty($estadocivil))$estadocivil=$ecivil1;
	if(empty($direccion))$direccion=$direc1;
	
	if(empty($motivo))
	{
		$edad=calcula_edad($fechanac);
		$bmot=mysql_query("select * from triage_urgencias where iden_cita ='$numcita'");
		while($rmot=mysql_fetch_array($bmot))
		{
			$motivo=$rmot['moco_tri'];	
		}
	}	
	echo"
	<form name=uno method=post>
	<input type=hidden name=edadpac value='$edad'>
	<input type=hidden name=codiprg value='11'>
	
	
	<br><br>";
	
	
		echo"
	<br>
	<table align=center class='tbl' width=100%>
	<tr><th colspan=10 align=center valign=top height=30>INFORMACION DEL PACIENTE</td></th>	
	<tr>	
	<th>PERTENENCIA ETNICA</td>
		<td><select name=etnia>
		<option value=''></option>";
		$betnia=mysql_query("select * from destipos where codt_des='75'");
		while($retnia=mysql_fetch_array($betnia))
		{
			$cod=$retnia['codi_des'];
			$nom=$retnia['nomb_des'];
			if($cod==$etnia) echo"<option selected value=$cod>$nom</option>";
			else echo"<option value=$cod>$nom</option>";			
		}
		echo"</select>
		</td>		
	<th>OCUPACION</td>
		<td colspan=3>";
		$bocupa=mysql_query("select codigo_ciuo, descri_ciuo from ciuo WHERE codigo_ciuo = '$ocupacion'");
		while($rocupa=mysql_fetch_array($bocupa))
		{
			$nomocupa=$rocupa['descri_ciuo'];
		}
		echo"
		<textarea name=nomocupa onPaste='return false' id='course_ocu' cols=60 rows=2>$nomocupa</textarea>		
		<input type=hidden id='course_valocu' name=ocupacion value=$ocupacion>		
		
		</td>
		</tr>
		<tr>
		<th>ESCOLARIDAD</td>
		<td>$escola 
		<select name=escolaridad>
		<option value=''></option>";
		$besco=mysql_query("select * from destipos where codt_des='76'");
		while($resco=mysql_fetch_array($besco))
		{
			$cod=$resco['codi_des'];
			$nom=$resco['nomb_des'];
			if($cod==$escolaridad) echo"<option selected value=$cod>$nom</option>";
			else echo"<option value=$cod>$nom</option>";
			
		}
		echo"</select>
		</td>
	<th>ESTADO CIVIL</td> 
		<td>
		<select name=estadocivil>
		<option value=''></option>";
		$beciv=mysql_query("select * from destipos where codt_des='A7'");
		while($reciv=mysql_fetch_array($beciv))
		{
			$cod=$reciv['codi_des'];
			$nom=$reciv['nomb_des'];
			if($cod==$estadocivil) echo"<option selected value=$cod>$nom</option>";
			else echo"<option value=$cod>$nom</option>";
			
		}
		echo"</select>
		</td>
	<th>DIRECCION</th>
		<td>
		<input type=text NAME=direccion size=50 value='$direccion'>
		</td>
	<tr>
	</table>";
	
	
	
	
	
	
	$subjetivo=str_replace( "Æ",chr(10),$subjetivo);
	$objetivo=str_replace( "Æ",chr(10),$objetivo);
	
	ECHO"<table align=center width=80%>
	<tr><td>
	<table align=center class='tbl' width=100%>
	<tr><th>ANAMNESIS</th></tr>
	</table>
	
	<BR><BR>
	
	<table align=center class='tbl'>	
	<tr><th>SUBJETIVO</td><td><textarea onPaste='return false' class='caja' name=subjetivo cols=120 rows=4 onKeypress='if (event.keyCode == 13) event.returnValue = false'>$subjetivo</textarea></td></tr>
	<tr><th>OBJETIVO</td><td><textarea onPaste='return false' class='caja' name=objetivo cols=120 rows=4 onKeypress='if (event.keyCode == 13) event.returnValue = false'>$objetivo</textarea></td></tr>
		
	<table>
	<br>
	<table align=center class='tbl' width=100%>
	<tr><th colspan=2 align=center valign=top height=30><a><INPUT type=button class='boton' value=Guardar registro onClick='valida();'></th></tr>	
	<table>
	</td></tr></table>
	
	";
	function calcula_edad($fecha_nac)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en nmeros enteros
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