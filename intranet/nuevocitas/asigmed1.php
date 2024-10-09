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
    uno.action='asigmed0.php';
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
        mysql_query("INSERT INTO `proinsalud`.`areas_medic` (
        `areas_ar` ,`cod_med_ar` ,`cod_ar` ,`esta_ar`)
        VALUES ('$codarea', '$codmedi', NULL , 'A')");     
    }
    if($opc==2)
    {
        for($n=0;$n<$finarasig;$n++)
        {
            $nomvar='codar'.$n;
            $codar=$$nomvar;
            $nomvar='codmedico'.$n;
            $codmedico=$$nomvar;
            $nomvar='iden'.$n;
            $iden=$$nomvar;              
            $nomvar='estasig'.$n; 
            $estasig=$$nomvar;
            if($estasig==1)
            {
                mysql_query("update areas_medic set esta_ar='A' where `areas_ar` = '$codar' AND `cod_med_ar` = '$codmedico'");
            }
            else            
            {
                mysql_query("update areas_medic set esta_ar='I' where `areas_ar` = '$codar' AND `cod_med_ar` = '$codmedico'");
            }    
        }
    }     
    echo"
    <input type=hidden name=codarea value='$codarea'>
    <input type=hidden name=codmedi value='$codmedi'>
    <input type=hidden name=nomarea value='$nomarea'>
    <input type=hidden name=nommedi value='$nommedi'>
    </form>";	
?>
</body>
</html>