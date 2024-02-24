<?session_start();?>
<HTML>
<HEAD>
	<?
	//coloco en una variable el nombre de la base de datos de la aplicación
    define("base_de_datos", "consultorio_es");
	require('inc/conections.Inc');
	?>
<link rel="stylesheet" type="text/css" href="css/estyles.css">
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready(function() {
	
	$("#course").autocomplete("get_list.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	
	$("#course").result(function(event, data, formatted) {
		$("#course_val").val(data[1]);
	});
});
</script>
<script language=javascript>
function visualizar(url){
  window.open(url,"Configuracion","width=300,height=500,scrollbars=yes")
}
</script>
</HEAD>
<BODY>
<?
$xcon=conectar_bd();
$datos[0]='nomb_usu';
$datos[1]='iden_usu';
$datos[2]='usuarios';


//area para procesar el formulario
IF ($oper==1){
	IF ($val){
		$sql="SELECT docu_usu, nomb_usu, nomb_ent, freg_cit, fech_age, hora_age, soli_cit, citas.iden_cit, citas.iden_age  FROM usuarios, entidades, citas, 
		agenda, medicos WHERE iden_ent=enti_usu AND usuarios.iden_usu=citas.iden_usu AND citas.iden_age=agenda.iden_age AND agenda.iden_med=medicos.iden_med 
		AND citas.iden_usu='$val' AND esta_cit='AC'";
		$res=mysql_query($sql);
		$con=mysql_num_rows($res);
		IF ($con>0){
			$resultado='Ok, la operacion tubo exito';
			$datos[3]=$val;
		}ELSE{
			$resultado='Error, el usuario no tiene citas pendientes';
		}
	}ELSE{
		$resultado='Error, debe ingresar un usuario a buscar';
	}
}

IF ($ok=='S'){
	$sql_0="UPDATE citas SET esta_cit='CA' WHERE iden_cit='$cit'";
	$res_0=mysql_query($sql_0);
	
	$sql_1="SELECT tusa_age, esta_age FROM agenda WHERE iden_age='$age'";
	$res_1=mysql_query($sql_1);
	$row_1=mysql_fetch_row($res_1);
	$dif=($row_1[0])-1;
	IF ($dif==0){
		$sql_0="UPDATE agenda SET esta_age='D', tusa_age=0 WHERE iden_age='$age'";
		$res_0=mysql_query($sql_0);
	}ELSE{
		$sql_0="UPDATE agenda SET tusa_age='$dif' WHERE iden_age='$age'";
		$res_0=mysql_query($sql_0);
	}
	$resultado2='Ok, La cita ha sido cancelada en el sistema.';
}

$pg='a06.php';
ECHO "<form name='AdmisionesCitas_Edit' action='AdmisionesCitas_Edit.php' method='post'>";
ECHO "<table class=tbl1>";
ECHO "<thead>";
ECHO "<tr>";
ECHO "<td align='left'>Opcion: Cancelar...</td>";
ECHO "<td align='right'><img src='img/ayuda.gif' width='15' height='15'  alt='Ayuda' OnClick=javascript:visualizar('help/ayuda_area.php?tema=".$pg."')></td>";
ECHO "</tr>";
ECHO "</thead>";
ECHO "<tbody>";
ECHO "<tr>";
ECHO "<td class='td_0' colspan='2'>&nbsp</td>";
ECHO "</tr>";
ECHO "<tr>";
ECHO "<td class='td_i2'><b>Usuario:</b> <br>a buscar</td>";
ECHO "<td class='td_d2'><input type='text' id='course' class='texto' name='usu' size='40' value='$usu'></td>";
ECHO "<input type='hidden' id='course_val' name='val' value='$val'>";
ECHO "</tr>";
ECHO "<input type='hidden' name='oper' value='1'>";
ECHO "<td class='td_i1'><input type='submit' class='boton' value='ENVIAR'></td>";
SWITCH (SUBSTR($resultado,0,1)){ //formatea el color del texto de acuerdo si el resultado es ok o error
	CASE 'E':
		ECHO "<td class='td_Er'><img src='img/info2.gif' width='18' height='18'> $resultado</td>";
		BREAK;
	CASE 'O':
		ECHO "<td class='td_Ok'><img src='img/info2.gif' width='18' height='18'> $resultado</td>";
		BREAK;
	DEFAULT:
		ECHO "<td class='td_In'><img src='img/info2.gif' width='18' height='18'> Resultado de las operaciones</td>";
		BREAK;
}
ECHO "</tr>";
ECHO "</tbody>";
ECHO "</table>";
ECHO "</form>";



IF ($con>0){
	//$res=mysql_query($sql);
	$row=mysql_fetch_row($res);
	ECHO "<form name='admisionesCitas_Edit' action='admisionesCitas_Edit.php' method='post'>";
	ECHO "<table class=tbl1>";
	ECHO "<thead>";
	ECHO "<tr>";
	ECHO "<td align='left' colspan='2'>Resultado...</td>";
	ECHO "</tr>";
	ECHO "</thead>";
	ECHO "<tbody>";
	ECHO "<tr>";
	ECHO "<td class='td_0' colspan='2'>&nbsp</td>";
	ECHO "</tr>";
	ECHO "<tr>";
	ECHO "<td class='td_i2'><b>Documento:</b> <br>de identificación</td>";
	ECHO "<td class='td_d2'><input type='text' class='texto' name='doc' size='15' value='$row[0]' READONLY></td>";
	ECHO "</tr>";
	ECHO "<tr>";
	ECHO "<td class='td_i1'><b>Nombre:</b> <br>completo del usuario</td>";
	ECHO "<td class='td_d1'><input type='text' class='texto' name='nom' size='40' value='$row[1]' READONLY></td>";
	ECHO "</tr>";
	ECHO "<tr>";
	ECHO "<td class='td_i2'><b>Entidad:</b> <br>responsable de pago</td>";
	ECHO "<td class='td_d2'><input type='text' class='texto' name='ent' size='45' value='$row[2]' READONLY></td>";
	ECHO "</tr>";
	ECHO "<tr>";
	ECHO "<td class='td_i1'><b>Fecha:</b> <br>de solicitud de la cita</td>";
	ECHO "<td class='td_d1'><input type='text' class='texto' name='freg' size='10' value='$row[3]' READONLY></td>";
	ECHO "</tr>";
	ECHO "<tr>";
	ECHO "<td class='td_i2'><b>Fecha:</b> <br>de la cita</td>";
	ECHO "<td class='td_d2'><input type='text' class='texto' name='fage' size='10' value='$row[4]' READONLY></td>";
	ECHO "</tr>";
	ECHO "<tr>";
	ECHO "<td class='td_i1'><b>Hora:</b> <br>de la cita</td>";
	ECHO "<td class='td_d1'><input type='text' class='texto' name='hora' size='6' value='$row[5]' READONLY></td>";
	ECHO "</tr>";
	ECHO "<tr>";
	ECHO "<td class='td_i2'><b>Solicitante:</b> <br>de la cita</td>";
	ECHO "<td class='td_d2'><input type='text' class='texto' name='soli' size='30' value='$row[6]' READONLY></td>";
	ECHO "</tr>";
	ECHO "<tr>";
	ECHO "<td class='td_i1'><b>Ok?:</b> <br>Confirma la Cancelación de la cita</td>";	
	ECHO "<td class='td_d1'><input type='checkbox' name='ok' value='S'></td>";
	ECHO "</tr>";
	ECHO "<tr>";
	ECHO "<tr>";
	ECHO "<input type='hidden' name='usu' value='$usu'>";
	ECHO "<input type='hidden' name='val' value='$val'>";
	ECHO "<input type='hidden' name='cit' value='$row[7]'>";
	ECHO "<input type='hidden' name='age' value='$row[8]'>";
	ECHO "<input type='hidden' name='oper' value='1'>";
	ECHO "<td class='td_i2' align='right'><input type='submit' class='boton' value='ENVIAR'></td>";
	SWITCH (SUBSTR($resultado2,0,1)){ //formatea el color del texto de acuerdo si el resultado es ok o error
		CASE 'E':
			ECHO "<td class='td_Er1'><img src='img/info2.gif' width='18' height='18'> $resultado2</td>";
			BREAK;
		CASE 'O':
			ECHO "<td class='td_Ok1'><img src='img/info2.gif' width='18' height='18'> $resultado2</td>";
			BREAK;
		DEFAULT:
			ECHO "<td class='td_In1'><img src='img/info2.gif' width='18' height='18'> Resultado de las operaciones</td>";
			BREAK;
	}
	ECHO "</tr>";
	ECHO "</tbody>";
	ECHO "</table>";
	ECHO "</form>";
}

desconectar_bd();
?>
</BODY>
</HTML>