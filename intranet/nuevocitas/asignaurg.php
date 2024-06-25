<?
session_start();
$usucitas=$_SESSION['usucitas'];
$_SESSION['areatra']=$areatra;
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 
?> 
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
	function salir()
	{		
		uno.action='asigna0.php';
		uno.target='';
		uno.submit();			
	}	
	function cambia()
	{		
		uno.accion.value=1;
		uno.action='asignaurg.php';
		uno.target='';
		uno.submit();			
	}			
</script>
</head>
<body>
<br>
<?
	$fechacorta=date("Y-m-d");
	$fechalarga=date("Y-m-d h:i:s");
    include ('php/conexion1.php');
	echo '<FORM name=uno METHOD="POST" ACTION="asig_cita.php">
	<input type=hidden name=accion><br>';
    $bcont=mysql_query("SELECT ucontrato.CONT_UCO, contrato.NEPS_CON
	FROM ucontrato INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
	WHERE (((ucontrato.CUSU_UCO)='$codusu'))");
	$num=mysql_num_rows($bcont);
	if($num==1)
	{
		echo '<br><br>';
		while($rcont=mysql_fetch_array($bcont))
		{
			$codcontra=$rcont['CONT_UCO'];		
		}
		$accion=1;
			
	}
	if($num==2)
	{
		echo "<table align=center class='tbl'>
		<tr><td>SELECCIONE EL CONTRATO <select name=codcontra onchange='cambia()'>
		<option value=''></''>";
		while($rcont=mysql_fetch_array($bcont))
		{
			$cod=$rcont['CONT_UCO'];		
			$nom=$rcont['NEPS_CON'];
			echo"<option value='$cod'>$nom</option>";
		}
		echo"</select>
		</td></tr>
		</table>";		
	}	
    if($accion==1)  
	{		
		ECHO $codcontra;
		$diasem=diasemana($fechacorta);	
		mysql_query("INSERT INTO horarios (Cmed_horario, Cserv_horario, Fecha_horario, Hora_horario, Usado_horario,ncita_horario,dia_horario)values 
		('1101','04','$fechacorta','$fechalarga','0','1','$diasem')");
		$id_horari=Mysql_insert_id();
		$inserta=mysql_query("INSERT INTO `citas` 
		(`id_cita` , `ID_horario` , `Idusu_citas` , `Tusua_citas` , `Cotra_citas` , `Clase_citas` , `Fsolusu_citas` , `Esta_cita` , `Hora_cita` , `bono_cita` , `REF` , `consul_cita` , `esta_tri` , `rips_citas` , `numc_adx`) 
		VALUES (NULL,	 '$id_horari',   '$codusu',      '$tipafi',      '$codcontra',       '1',        '$fechacorta',       '1',        '$fechalarga',     '',       NULL,      NULL,    '$clasifica',  NULL,        NULL)");
		$numcita=Mysql_insert_id();	
		$tri='3';
		echo '<br><br>';
		if($clasifica=='MA')
		{
			$clasi=$clasifica;
			$tri='2';
		}		
		$signos=mysql_query("INSERT INTO `triage_urgencias` ( `iden_tri` , `iden_cita`, `tear1_tri` , `tear2_tri` , `frre_tri` , `frca_tri` , `temp_tri` , `clas_tri`, `clas2_tri` , `usua_tri` ) 
		VALUES ('', '$numcita', '', '', '', '', '', '$clasi', '$tri', '$usucitas')"); 
		echo" <table align=center class='tbl'>
		<tr><td>LA CITA SE ASIGNO CORRECTAMENTE</th></tr>
		<tr><th align=center><INPUT type=button class='boton' value='aceptar' onClick='salir();'></th></tr>
		</table>";
	}
	echo"</form>";
	function DiaSemana  ($fecha,$texto=1) 
	{ 
		list($año,$mes,$dia) = explode("-",$fecha);
		$numerodiasemana = date('w', mktime(0,0,0,$mes,$dia,$ano));     
		if ($texto == 0)
		return $numerodiasemana;      
		switch($numerodiasemana)
		{
			case 0: return "Domingo";
			case 1: return "Lunes";
			case 2: return "Martes";
			case 3: return "Miércoles";
			case 4: return "Jueves";
			case 5: return "Viernes";
			case 6: return "Sábado";
		}
	}         
        
?>

</body>
</HTML>