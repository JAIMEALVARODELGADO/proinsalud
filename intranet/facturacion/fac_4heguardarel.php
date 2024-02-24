<?
session_start();
//session_register('iden_fac');
//session_register('Gidusufac');
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIN</title>
<script language='javascript'>
function cargarrel(){
var t=setTimeout("alerta()",3000);
}
function alerta(){
  document.form1.submit();
}
</script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//include('php/funciones.php');
include('php/conexion.php');
$consultarel=mysql_query("SELECT codi_emp,rela_emp FROM empresa");
$rowrel=mysql_fetch_array($consultarel);
$grabados=0;
for($i=0;$i<$cont;$i++){
  $var='chkiden'.$i;
  if($$var=='on'){
      $var='iden_fac'.$i;
      $cons="UPDATE encabezado_factura SET rela_fac='$rowrel[rela_emp]' WHERE iden_fac=".$$var;
      //echo "<br>$cons";
      mysql_query($cons);
      $grabados++;
  }
}
if($grabados<>0){
  $nuevarel=str_pad($rowrel[rela_emp]+1,strlen($rowrel[rela_emp]),'0',STR_PAD_LEFT);
  mysql_query("UPDATE empresa SET rela_emp='$nuevarel' WHERE codi_emp=$rowrel[codi_emp]");
  echo "<br><br><br><br><br><br>
  <center><h3>Las Facturas se relacionaron con el numero: <font color='#CC0000'>$rowrel[rela_emp]</font></h3></center>";
}
mysql_close();
echo "<body onload='cargarrel()'>";
?>
<form name='form1' method="POST" action='fac_3infmuescuenta.php' target='fr02'>
    <input type='hidden' name='relacion' value='<?echo $rowrel[rela_emp];?>'>    
</form>
</body>
</html>