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
    /*case "O":
        $actualiza="DELETE FROM fotros_servicios WHERE regi_fos=$reg";
        $retorna="fac_4hemuestraotro.php";
        break;
    case "U":
        $actualiza="DELETE FROM furgencia WHERE regi_fur=$reg";
        $retorna="fac_4hemuestraurge.php";
        break;
    case "H":
        $actualiza="DELETE FROM fhospital WHERE regi_fho=$reg";
        $retorna="fac_4hemuestrahosp.php";
        break;*/
}
//echo $actualiza;
mysql_query($actualiza);
mysql_close();
?>
<body onload="regresar('<?echo $retorna;?>')">
</body>
</html>
