<?
session_start();
$usucitas=$_SESSION['usucitas'];
$areatra=$_SESSION['areatra'];
?>

<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
	function salir()
	{		
		uno.action='asigna0.php';
		uno.target='area';
		uno.submit();			
	}		
</script>
</head>
<body onload='salir()'>
<?	
   	if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }	 
	include ('php/conexion1.php');
	$codcontra=substr($areas,0,3);
	$areasel=substr($areas,3,5);
	$bcon=mysql_query("select * from contrato where CODI_CON='$codcontra'");
	$numcon=mysql_num_rows($bcon);
	if($numcon==0 || $codcontra=='' || $codcontra=='0')
	{	
		echo" <table align=center class='tbl'>
		<tr><th>CITA NO ASIGNADA. POR FAVOR REINICIE LA APLICACION</th></tr>
		</table>";
		exit();		
	}
	$noguar=0;
	echo"<form name=uno method=post>";
	if(empty($usucitas))
	{
		echo" <table align=center class='tbl'>
		<tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
		</table>";
		exit();
	}
	$dateh=date("Y-m-d");
	foreach($_POST as $nombre_campo => $valor)
	{ 
	   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
	   eval($asignacion); 
	} 	
	$hor=date("H:i:s");		
	if($pendi1=='O')$pendi='O';
	if($pendi2=='P')$pendi='P';
	mysql_query("insert into citas_pendientes 
	(iden_pen,fecha_pen,hora_pen,paciente_pen,contrato_pen,medico_pen,area_pen,tipo_pen,areatrabajo_pen,funcionario_pen) 
	values (NULL, '$dateh','$hor','$codusu','$codcontra','$medico','$areasel','$pendi', '$areatra','$usucitas')");
	echo"<input type=hidden name=codusu value=$codusu>";
	echo"<input type=hidden name=tipafi value=$tipafi>";    
	echo"<input type=hidden name=clasifica value=$clasifica>";
	echo"<input type=hidden name=telres value=$telres>";
	echo"<input type=hidden name=tipafi value='$tipafi'>";
	echo"<input type=hidden name=tipafi value='$clasi'>";
	echo"<input type=hidden name=codcontra value='$codcontra'>";
	echo"<input type=hidden name=nocontra value=$nocontra>";
	echo"<input type=hidden name=mensaje value=$mensaje>";
	echo"<input type=hidden name=iden_uco value=$iden_uco>";
	echo"<input type=hidden name=viene value=$viene>";
	if($igual==1)
	{		 
		echo"<input type=hidden name=finsigue value='$j'>";
		echo"<input type=hidden name=igual value='$igual'>";
		echo"<input type=hidden name=medico value='$medico'>";
		echo"<input type=hidden name=mes value='$mes'>";	
		echo"<input type=hidden name=control value='$control'>";
		echo"<input type=hidden name=desareauto value='$desareauto'>";
		echo"<input type=hidden name=codareauto value='$codareauto'>";
		echo"<input type=hidden name=contrauto value='$contrauto'>";
		echo"<input type=hidden name=munate value=$munate>";
	}
	echo"</form>";
?>

</html>