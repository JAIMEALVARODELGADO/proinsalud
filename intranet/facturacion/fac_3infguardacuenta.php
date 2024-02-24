<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<script language='javascript'>
function cargarrel(){
var t=setTimeout("alerta()",3000);
}
function alerta(){
  form1.submit();
}
</script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/conexion.php');
include('php/funciones.php');
if($tipo=='C'){
    $frad_cco=cambiafecha($frad_cco);
    $consulta="UPDATE cuenta_cobro SET frad_cco='$frad_cco',esta_cco='C' WHERE iden_cco=$iden_cco";
    mysql_query($consulta);
    //echo $consulta;
}
else{
    $consulta=mysql_query("SELECT iden_cco FROM cuenta_cobro WHERE rela_cco='$relacion'");
    if(mysql_num_rows($consulta)<>0){
      $row=mysql_fetch_array($consulta);
      mysql_query("UPDATE cuenta_cobro SET nit_cco='$nit',cpto_cco='$concepto',anex_cco='$anexo',fech_cco='$fecha',nota_cco='$nota',resp_cco='$responsable' WHERE iden_cco=$row[iden_cco]");
    }
    else{
      mysql_query("INSERT INTO cuenta_cobro(rela_cco,nit_cco,cpto_cco,anex_cco,fech_cco,nota_cco,resp_cco,esta_cco)
      VALUES('$relacion','$nit','$concepto','$anexo','$fecha','$nota','$responsable','A')");
    }
    mysql_free_result($consulta);
}
echo "<br><br><br><br><br><br>
<center><h3>Las cuenta de cobro, fue guardada con exito</h3></center>";

mysql_close();
echo "<body onload='cargarrel()'>";
?>
<form name='form1' method="POST" action='fondo.php' target='fr02'>
</form>
</body>
</html>