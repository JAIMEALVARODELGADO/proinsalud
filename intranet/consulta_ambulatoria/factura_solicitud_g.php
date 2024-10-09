<?
session_start();
$usucitas=$_SESSION['usucitas'];
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
		uno.action='factura_solicitud.php';
		uno.target='';
		uno.submit();
	}
</script>
</head>
<body onload="salir()">

<?	
	
	
	
	// 192.168.4.20/intraweb/intranet/consulta_ambulatoria/factura_solicitud.php
	$fecha=date("Y-m-d");
    $hora=date("H-i");
	include ('php/conexion1.php');
	
	echo"
	<center>
	<form name=uno method=post>
	<input type=hidden name=carga value='$carga'>
	<input type=hidden name=munisel value='$munisel'>";
	
	
	$fecha=date("Y-m-d")." ". date("H").":".date("i").":".date("s");
	$fechadir=date("Y-m-d");
	$bhis=mysql_query("SELECT * FROM gestion_factura_enca WHERE numero_cita='$citasel'");
	if(mysql_num_rows($bhis)==0)
	{	
		$insenca=mysql_query("INSERT INTO gestion_factura_enca(id_enca,numero_cita,estado,num_factura, municipio) VALUES (NULL,'$citasel','$estadonuevo','', '$munisel')");
		$numreg=Mysql_insert_id();
	}
	else
	{
		$rhis=mysql_fetch_array($bhis);
		$numreg=$rhis['id_enca'];
		$updenca=mysql_query("UPDATE gestion_factura_enca SET estado='$estadonuevo' WHERE id_enca='$numreg'");
	}
	
	
	if($estadonuevo=='FI')
	{
		$carpeta=$fechadir.'_'.$numreg;
		foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
		{
			echo "SI";
			//Validamos que el archivo exista
			if($_FILES["archivo"]["name"][$key]) {
			$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
			$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo

			$directorio = 'facturas/'.$carpeta.'/'; //Declaramos un  variable con la ruta donde guardaremos los archivos

			//Validamos si la ruta de destino existe, en caso de no existir la creamos
			if(!file_exists($directorio)){
			mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
			}

			$dir=opendir($directorio); //Abrimos el directorio de destino
			$target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo

			//Movemos y validamos que el archivo se haya cargado correctamente
			//El primer campo es el origen y el segundo el destino
			if(move_uploaded_file($source, $target_path)) {	
			   //echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
			} 
			else {	
			   echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
			}
			closedir($dir); //Cerramos el directorio de destino
			}
		}
		$updenca=mysql_query("UPDATE gestion_factura_enca SET directorio='$carpeta' WHERE id_enca='$numreg'");
	}	
	
	
	
	$insdeta=mysql_query("INSERT INTO gestion_factura_deta (id_deta ,id_enca ,fecha ,estado ,observacion ,usuario)
	VALUES (NULL, '$numreg', '$fecha', '$estadonuevo', '$observa', '$usucitas')");
	
	
	
?>
<form>
</body>
</html>