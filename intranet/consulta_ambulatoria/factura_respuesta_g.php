<?
session_start();
$Gidusufac=$_SESSION['Gidusufac'];
?>
<HTML>
<HEAD>
<!--<meta http-equiv="Refresh" content="10"> -->
<link rel="stylesheet" href="style.css" type="text/css"/>
<TITLE>AGENDA MEDICA</TITLE>
<SCRIPT LANGUAGE="JavaScript">
	function salir()
	{
		uno.carga.value=0;
		uno.action='factura_respuesta.php';
		uno.target='';
		uno.submit();
	}
</script>
</head>
<body onload="salir()">

<?	
	
	
	
	// 192.168.4.20/intraweb/intranet/consulta_ambulatoria/factura_respuesta.php
	$fecha=date("Y-m-d");
    $hora=date("H-i");
	include ('php/conexion1.php');
	
	echo"
	<center>
	<form name=uno method=post>
	<input type=hidden name=carga value='$carga'>
	<input type=hidden name=munisel value='$munisel'>";
	
	
	echo"<br><br><table align=center class='tbl5' width=80%>		
	<tr>
	<th colspan=10 valign=center align=center hwight=40>LISTADO DE PACIENTES</th>
	</tr>
	</table><br>";
	$fecha=date("Y-m-d")." ". date("H").":".date("i").":".date("s");
	$bhis=mysql_query("SELECT * FROM gestion_factura_enca WHERE numero_cita='$citasel'");
	if(mysql_num_rows($bhis)==0)
	{	
		$insenca=mysql_query("INSERT INTO gestion_factura_enca(id_enca,numero_cita,estado,num_factura, municipio) VALUES (NULL,'$citasel','$estadonuevo','$numfactura', '$munisel')");
		$numreg=Mysql_insert_id();
	}
	else
	{
		
		$rhis=mysql_fetch_array($bhis);
		$numreg=$rhis['id_enca'];
		$updenca=mysql_query("UPDATE gestion_factura_enca SET estado='$estadonuevo', num_factura='$numfactura' WHERE id_enca='$numreg'");
	}
	
	
	$insdeta=mysql_query("INSERT INTO gestion_factura_deta (id_deta ,id_enca ,fecha ,estado ,observacion ,usuario)
	VALUES (NULL, '$numreg', '$fecha', '$estadonuevo', '$observa', '$Gidusufac')");
	
	
	
?>
<form>
</body>
</html>