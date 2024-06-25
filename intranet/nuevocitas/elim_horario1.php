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
        uno.action='elim_horario0.php';
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
    $dateh=date("Y-m-d");
	$horeli=date("H:i");
    foreach($_POST as $nombre_campo => $valor)
    { 
       $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
       eval($asignacion); 
    } 	
    include ('php/conexion1.php');  
     for($j=100;$j<$finalp;$j++)
    {			
        $nomvar='fin'.$j;
        $final=$$nomvar;        
        for($k=0;$k<$final;$k++)
        {			
            $nomvar='idenhor'.$j.$k;
            $idenhor=$$nomvar;
            $nomvar='selhora'.$j.$k;
            $selhora=$$nomvar;
            if($selhora==1)
            {
                echo $id_cita.' ';
                mysql_query("delete from horarios where ID_horario='$idenhor'");
				
				mysql_query("UPDATE horario_seguimiento SET feceli = '$dateh', horeli = '$horeli', usuaeli = '$usucitas'  where idhorario='$idenhor'");
				
            }
        }		
    }	
    echo"<form name=uno method=post>
    <input type=hidden name=codusu value='$codusu'>
    </form>";	
?>
</body>
</html>