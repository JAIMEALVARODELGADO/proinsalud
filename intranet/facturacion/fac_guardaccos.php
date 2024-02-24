<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<Script language='JavaScript'>
function error(){
    alert("El Codigo YA Existe");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css"/>
<?
include('php/conexion.php');
$consulta=mysql_query("SELECT codi_cdc FROM centros_costo WHERE codi_cdc='$codi_cdc'");
if(mysql_num_rows($consulta)<>0){
    ?><Script language="JavaScript">error();</Script><?
}
else{
    $sql="INSERT INTO centros_costo(codi_cdc,nomb_cdc)
          VALUES ('$codi_cdc','$nomb_cdc')";
    //echo "<br>".$sql;
    mysql_query($sql);
    //echo "<br>".mysql_affected_rows();
}
mysql_close();
echo "<body onload='location.href=\"fac_muesccos.php?cod=$codi_cdc\"'>";
?>
</body>
</html>