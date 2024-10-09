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
		uno.action='habilitaref0.php';
		uno.target='';
		uno.submit();			
	}		
</script>
</head>
<body onload='salir()'>
<?	
    /*
	if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
	*/
	echo"<form name=uno method=post>";
	$dateh=date("Y-m-d");
	$hor= date("H:i:s");
    include ('php/conexion1.php');	

	for($i=0;$i<$final;$i++)
	{
		$nomvar='ncanti'.$i;
		$ncanti=$$nomvar;
		$nomvar='numrefer'.$i;
		$numrefer=$$nomvar;
		$nomvar='nuevoesta'.$i;
		$nuevoesta=$$nomvar;
		$nomvar='sel'.$i;
		$sel=$$nomvar;
		
		if($sel==1)
		{
			if($i<$finparcial)
			{
				mysql_query("update detareferencia Set cant_dre='$ncanti', marc_dre='$nuevoesta' where iden_dre='$numrefer'");
			}
			else
			{
				
				$nomvar='nservi'.$i;
				$nservi=$$nomvar;
				mysql_query("update detareferencia Set cant_dre='$ncanti', marc_dre='$nuevoesta', alse_dre='$nservi' where iden_dre='$numrefer'");
			}
		
		}
		
	}
	//36990406	
    echo"</form>";
?>
</body>
</html>