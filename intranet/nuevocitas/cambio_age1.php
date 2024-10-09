<?
session_start();
$usucitas=$_SESSION['usucitas'];  
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
		uno.action='cambio_age0.php';
		uno.target='';
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
    foreach($_POST as $nombre_campo => $valor)
	{ 
	   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
	   eval($asignacion); 
	} 
	include ('php/conexion1.php');
	for($n=0;$n<$finmed;$n++)
	{
		$nomvar='id_hor'.$n;
		$id_hor=$$nomvar;		
		$nomvar='item'.$n;
		$item=$$nomvar;
		
		if($item==1)
		{
			mysql_query("Update horarios Set Cmed_horario='$medicodes', Fecha_horario='$fechades'  Where ID_horario='$id_hor'");
		}		
	}	
	echo"<form name=uno method=post>
	</form>";	
?>
</body>
</html>