<?
session_start();
$usucitas=$_SESSION['usucitas'];    
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
function salir()
{		
    uno.action='asigrupo0.php';
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
    echo"<form name=uno method=post>";
    $dateh=date("Y-m-d");
    foreach($_POST as $nombre_campo => $valor)
    { 
       $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
       eval($asignacion); 
    } 	
    include ('php/conexion1.php');
    
    if($opc==1)
    {       
        mysql_query("INSERT INTO `proinsalud`.`grup_area` (`cogr_grar` ,`coar_grar` ,`codi_grar`)VALUES ('$grupo', '$codarea', NULL )");
    }
    if($opc==2)
    {
        for($n=0;$n<$finarasig;$n++)
        {            
            $nomvar='iden'.$n;
            $iden=$$nomvar;              
            $nomvar='estasig'.$n; 
            $estasig=$$nomvar;
            if($estasig==1)
            {
                mysql_query("DELETE FROM grup_area where codi_grar = '$iden'");
            }            
        }
    }     
    echo"
    <input type=hidden name=codarea value='$codarea'>
    <input type=hidden name=codmedi value='$grupo'>
    <input type=hidden name=nomarea value='$nomarea'>
    </form>";	
?>
</body>
</html>