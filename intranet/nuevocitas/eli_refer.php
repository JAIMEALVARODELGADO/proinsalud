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
        uno.action='asignapaso.php';
        uno.target='';
        uno.submit();			
    }		
</script>
</head>
<body onload='salir()'>
<?	
    //$idendetarefer='2632958';
	
	if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
	
    $dateh=date("Y-m-d");
	$horeli=date("H:i");
    
    include ('php/conexion1.php');  
     
				
	mysql_query("UPDATE detareferencia SET marc_dre = '1405', usuacance = '$usucitas'  where iden_dre='$idendetarefer'");
    
	echo"<form name=uno method=post>
		<input type=hidden name=codusu value=$codusu>";
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
    echo"</form>";	
?>
</body>
</html>