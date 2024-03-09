<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function regresar(ret_){
    window.open(ret_,"fr02") 
}
</script>
</head>
<?
include('php/conexion.php');
//echo "<br>$tipo";
//echo "<br>$reg";
$retorna='';
switch ($tipo){
    case "C":
        $actualiza="DELETE FROM nrconsulta WHERE id_consulta='$reg'";
        $retorna="fac_3muestraripscons.php";
        break;
    case "P":
        $actualiza="DELETE FROM nrprocedimiento WHERE id_procedimiento='$reg'";
        $retorna="fac_3muestraripsproc.php";
        break;
    case "M":
        $actualiza="DELETE FROM nrmedicamento WHERE id_medicamento='$reg'";
        $retorna="fac_3muestraripsmedi.php";
        break;
    case "O":
        $actualiza="DELETE FROM nrotroservicios WHERE id_otros='$reg'";
        $retorna="fac_3muestraripsotro.php";
        break;
    case "U":
        $actualiza="DELETE FROM nrurgencias WHERE id_urgencias='$reg'";
        $retorna="fac_3muestraripsurge.php";
        break;
    case "H":
        $actualiza="DELETE FROM nrhospital WHERE id_hospital='$reg'";
        $retorna="fac_3muestraripshosp.php";
        break;
    case "N":
        $actualiza="DELETE FROM nrnacidos WHERE id_nacidos='$reg'";
        $retorna="fac_3muestraripsrnac.php";
        break;
}
//echo $actualiza;
mysql_query($actualiza);
mysql_close();
?>
<body onload="regresar('<?echo $retorna;?>')">
</body>
</html>
